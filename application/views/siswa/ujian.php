<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<link href="assets/css/fontawesome/css/fontawesome.min.css" rel="stylesheet">

<!-- Main content -->
<div class="content-wrapper">
    <!-- Content area -->
    <div class="content">

        <!-- Dashboard content -->
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <fieldset class="content-group">
                            <legend class="text-bold"><i class="icon-pen"></i>
                                <span class="mr-1">Daftar Ujian Seleksi</span>
                            </legend>
                            <div class="table-responsive">
                                <table class="table table-bordered table-sm table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Ujian</th>
                                            <th>Jumlah Soal</th>
                                            <th>Durasi</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $no = 0;
                                            foreach($ujian->result() as $row) {
                                        ?>
                                        <tr>
                                            <td><?= ++$no ?></td>
                                            <td><?= $row->nama ?></td>
                                            <td><?= $row->jumlah_soal ?></td>
                                            <td><?= $row->durasi ?> Menit</td>
                                            <td>

                                                <?php
                                                    if ($row->status === null) {
                                                ?>
                                                <button type="button" class="btn btn-sm btn-primary" data-id-ujian="<?= $row->id_ujian ?>" data-nama-ujian="<?= $row->nama ?>" onclick="ikutUjian(this)"><i class="icon-redo2"></i> Ikut Ujian</button>
                                                <?php 
                                                    } elseif ($row->status === "progress") {
                                                ?>
                                                <a href="panel_siswa/ikut_ujian/<?= $row->id_ujian ?>" class="btn btn-sm btn-warning" data-id-ujian="<?= $row->id_ujian ?>" data-nama-ujian="<?= $row->nama ?>" style="padding-left: 0.7em;"><i class="icon-spinner fa-spin"></i> Sedang Ujian</a>
                                                <?php
                                                    } else {
                                                ?>
                                                <a href="panel_siswa/ikut_ujian/<?= $row->id_ujian ?>" class="btn btn-sm btn-success" data-id-ujian="<?= $row->id_ujian ?>" data-nama-ujian="<?= $row->nama ?>"><i class="icon-checkmark"></i> Sudah Ujian</a>
                                                <?php
                                                    }
                                                ?>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal-ikut-ujian">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                        </button>
                        <h4 class="modal-title" id="title-ikut-ujian"></h4>
                    </div>
                    <div class="modal-body">
                        <p id="text-ikut-ujian"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <a href="panel_siswa/ikut_ujian/" id="button-ikut-ujian" class="btn btn-primary">Mulai Mengejakan</a>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function ikutUjian(btn) {
                document.getElementById("title-ikut-ujian").textContent = btn.dataset.namaUjian;
                document.getElementById("text-ikut-ujian").textContent = "Anda akan mengerjakan ujian " + btn.dataset.namaUjian;
                document.getElementById("button-ikut-ujian").href = "panel_siswa/ikut_ujian/" + btn.dataset.idUjian;
                $('#modal-ikut-ujian').modal('show');
            }
        </script>
        <!-- /dashboard content -->