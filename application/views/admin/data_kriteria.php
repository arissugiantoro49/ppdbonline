<!-- Main content -->

<div class="content-wrapper">
    <!-- Content area -->
    <div class="content">
        <?php
        echo $this->session->flashdata('msg');
        ?>
        <!-- Dashboard content -->
        <div class="row">
            <!-- Basic datatable -->
            <button class="btn btn-primary btn-xs" style="margin-left: 1em; display: none" id="tambahKriteria" data-toggle="modal" data-target="#modalTambahKriteria"><i class="icon-add"></i></button>
            <div class="panel panel-flat">
                <div class="panel-heading" style="padding-bottom:10px;">
                    <h5 class="panel-title"><b>DATA KRITERIA</b></h5>
                    <hr style="margin:0px;">
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                        </ul>
                    </div>
                </div>
                <div class="table-responsive" style="border-top:0;">
                    <table class="table datatable-basic table-sm table-striped" id="tabelKriteria" width="100%">
                        <thead>
                            <tr>
                                <th width="30px;">No</th>
                                <th>Nama Kriteria</th>
                                <th>Tipe</th>
                                <th>Bobot</th>
                                <th class="text-center" width="180">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($kriteria->result() as $baris) { ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $baris->nama_kriteria; ?> (C<?= $baris->id_kriteria ?>)</td>
                                    <td><?= $baris->tipe == 1? "Benefit" : "Cost"; ?></td>
                                    <td><?php echo $baris->bobot; ?></td>
                                    <td align="center" style="white-space: nowrap;">
                                        <button class="btn btn-warning btn-xs" data-id-kriteria="<?= $baris->id_kriteria ?>" data-nama-kriteria="<?= $baris->nama_kriteria;?>" data-tipe="<?= $baris->tipe ?>" data-bobot="<?= $baris->bobot ?>" onclick="editKriteria(this)"><i class="icon-pencil"></i></button>
                                        <!-- <a href="panel_admin/data_kriteria/hapus/<?php echo $baris->id_kriteria; ?>" class="btn btn-danger btn-xs" onclick="return confirm('Apakah anda yakin?')"><i class="icon-bin"></i></a> -->
                                    </td>
                                </tr>
                            <?php
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /basic datatable -->
        </div>
        <!-- /dashboard content -->

        <!-- Modal modalTambahKriteria -->
        <div class="modal fade" id="modalTambahKriteria">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTambahKriteriaLabel"><strong>Tambah Kriteria</strong></h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="panel_admin/data_kriteria/tambah" method="post" id="formTambahKriteria">
                            <label>Nama Kriteria</label>
                            <div class="input-group col-md-12">
                                <input type="text" class="form-control" name="nama_kriteria" placeholder="Nama Kriteria">
                            </div>
                            <label>Tipe Kriteria</label>
                            <div class="input-group col-md-12">
                                <select name="tipe" class="form-control" required>
                                    <option value="" disabled selected hidden>Pilih tipe kriteria</option>
                                    <option value="1">Benefit</option>
                                    <option value="0">Cost</option>
                                </select>
                            </div>
                            <label>Bobot</label>
                            <div class="input-group col-md-12">
                                <input type="number" class="form-control" name="bobot" placeholder="Nilai bobot kriteria">
                            </div>
                            <br>
                            <div style="display:flex;justify-content:flex-end">
                                <button type="submit" class="btn btn-primary btn-xs ">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Modal modalTambahKriteria -->

        <!-- Modal modalEditKriteria -->
        <div class="modal fade" id="modalEditKriteria">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalEditKriteriaLabel"><strong>Edit Kriteria</strong></h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="panel_admin/data_kriteria/edit" method="post" id="formEditKriteria">
                            <input type="hidden" name="id_kriteria">
                            <label>Nama Kriteria</label>
                            <div class="input-group col-md-12">
                                <input type="text" class="form-control" name="nama_kriteria" placeholder="Nama Kriteria">
                            </div>
                            <label>Tipe Kriteria</label>
                            <div class="input-group col-md-12">
                                <select name="tipe" class="form-control">
                                    <option value="" disabled selected hidden>Pilih tipe kriteria</option>
                                    <option value="1">Benefit</option>
                                    <option value="0">Cost</option>
                                </select>
                            </div>
                            <label>Bobot</label>
                            <div class="input-group col-md-12">
                                <input type="number" class="form-control" name="bobot" placeholder="Nilai bobot kriteria">
                            </div>
                            <br>
                            <div style="display:flex;justify-content:flex-end">
                                <button type="submit" class="btn btn-primary btn-xs ">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Modal modalEditKriteria -->

        <script>
            $("document").ready(function() {
                $("#tabelKriteria_filter.dataTables_filter").append($("#tambahKriteria"));
            });

            function editKriteria(btn) {
                const form = document.forms["formEditKriteria"];
                form["id_kriteria"].value = btn.dataset.idKriteria;
                form["nama_kriteria"].value = btn.dataset.namaKriteria;
                form["tipe"].value = btn.dataset.tipe;
                form["bobot"].value = btn.dataset.bobot;
                $('#modalEditKriteria').modal('show');
            }
        </script>