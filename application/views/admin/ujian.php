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
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title"><b>UJIAN</b></h5>
                    <hr style="margin:0px;">
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                        </ul>
                    </div>
                </div>
                <div style="overflow-x: auto">
                    <button type="button" class="btn btn-sm btn-success" id="btnTambahUjian" data-toggle="modal" data-target="#modal-tambah-ujian" style="margin-left: 1em">Tambah ujian</button>
                    <table class="table datatable-basic table-sm table-striped" width="100%" id="tabelUjian">
                        <thead>
                            <tr>
                                <th width="30px;">No.</th>
                                <th>Nama</th>
                                <th>Jumlah soal</th>
                                <th>Durasi</th>
                                <th>Waktu</th>
                                <th>Tahun</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($ujian->result() as $baris) {
                            ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $baris->nama; ?></td>
                                    <td>0</td>
                                    <td><?php echo $baris->durasi; ?></td>
                                    <td><?php echo $baris->waktu; ?></td>
                                    <td><?php echo $baris->tahun; ?></td>
                                    <td>
                                        <button class="btn btn-primary" data-id-ujian="<?= $baris->id_ujian ?>" title="Daftar soal" onclick="daftarSoal(this)"><i class="icon-list2"></i></button>
                                        <button class="btn btn-warning" data-id-ujian="<?= $baris->id_ujian ?>" title="Edit ujian" onclick="editUjian(this)"><i class="icon-pencil"></i></button>
                                        <a href="panel_admin/ujian/hapus/<?php echo $baris->id_ujian; ?>" class="btn btn-danger" title="Hapus ujian" onclick="return confirm('Apakah anda yakin?')"><i class="icon-bin"></i></a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /basic datatable -->
        </div>

        <div class="modal fade" id="modal-daftar-soal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                        </button>
                        <h4 class="modal-title">Daftar Soal</h4>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-sm table-striped">
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal-tambah-ujian">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                        </button>
                        <h4 class="modal-title">Tambah Ujian</h4>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <form action="panel_admin/ujian/tambah" method="POST">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="NamaUjian">Nama Ujian :</label>
                                        <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama Ujian" required="">
                                    </div>
                                    <div class="form-group">
                                        <label for="tahun">Tahun :</label>
                                        <select name="tahun" class="form-control" required="">
                                            <option value="" selected disabled>Pilih Tahun...</option>
                                            <?php for ($i = date('Y'); $i >= 2020; $i--) { ?>
                                                <option value="<?php echo $i; ?>" <?php if ($v_thn == $i) {
                                                                                        echo "selected";
                                                                                    } ?>><?php echo $i; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="durasi">Durasi :</label>
                                        <input type="text" name="durasi" class="form-control" placeholder="Menit" required="">
                                    </div>
                                    <div class="form-group">
                                        <label for="waktu">Waktu :</label>
                                        <input type="datetime-local" class="form-control" placeholder="Waktu ujian" name="waktu">
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal-edit-ujian">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                        </button>
                        <h4 class="modal-title">Edit Ujian</h4>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <form action="panel_admin/ujian/edit" method="POST" id="formEditUjian">
                                <div class="box-body">
                                    <input type="hidden" name="id_ujian">
                                    <div class="form-group">
                                        <label>Nama Ujian :</label>
                                        <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama Ujian" required="">
                                    </div>
                                    <div class="form-group">
                                        <label for="tahun">Tahun :</label>
                                        <select name="tahun" class="form-control" required="">
                                            <option value="" selected disabled>Pilih Tahun...</option>
                                            <?php for ($i = date('Y'); $i >= 2020; $i--) { ?>
                                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="durasi">Durasi :</label>
                                        <input type="text" name="durasi" class="form-control" placeholder="Menit" required="">
                                    </div>
                                    <div class="form-group">
                                        <label for="waktu">Waktu :</label>
                                        <input type="datetime-local" class="form-control" placeholder="Waktu ujian" name="waktu">
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal-daftar-soal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                        </button>
                        <h4 class="modal-title">Daftar Soal</h4>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- /dashboard content -->
        <script>
            $("document").ready(function() {
                $("#tabelUjian_filter.dataTables_filter").append($("#btnTambahUjian"));
                document.querySelector("#tabelUjian_wrapper .datatable-header").style.padding = "0 20px 0 20px";
            });

            function daftarSoal(btn) {
                fetch("panel_admin/get_daftar_soal/" + btn.dataset.idUjian).then(response => response.json()).then(result => {

                });
                $('#modal-detail-soal').modal('show');
            }

            function editUjian(btn) {
                fetch("panel_admin/get_detail_ujian/" + btn.dataset.idUjian).then(response => response.json()).then(result => {
                    const form = document.forms["formEditUjian"];
                    form["id_ujian"].value = result.id_ujian;
                    form["nama"].value = result.nama;
                    form["durasi"].value = result.durasi;
                    form["waktu"].value = (new Date(result.waktu)).toISOString().substring(0, 16);
                    form["tahun"].value = result.tahun;
                    $('#modal-edit-ujian').modal('show');
                });
            }
        </script>