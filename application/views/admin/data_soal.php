<script type="text/javascript" src="assets/panel/ckeditor/ckeditor.js"></script>

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
                    <h5 class="panel-title"><b>DATA SOAL</b></h5>
                    <hr style="margin:0px;">
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                        </ul>
                    </div>
                </div>
                <div style="overflow-x: auto">
                    <button type="button" class="btn btn-sm btn-success" id="btnTambahSoal" data-toggle="modal" data-target="#modal-tambah-soal" style="margin-left: 1em">Tambah soal</button>
                    <table class="table datatable-basic table-sm table-striped" width="100%" id="tabelSoal">
                        <thead>
                            <tr>
                                <th width="30px;">No.</th>
                                <th>Kode</th>
                                <th>Soal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($soal->result() as $baris) {
                            ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td>SL<?php echo $baris->id_soal; ?></td>
                                    <td><?php echo $baris->soal; ?></td>
                                    <td>
                                        <button class="btn btn-primary" data-id-soal="<?= $baris->id_soal ?>" title="Detail soal" onclick="detailSoal(this)"><i class="icon-info22"></i></button>
                                        <button class="btn btn-warning" data-id-soal="<?= $baris->id_soal ?>" title="Edit soal" onclick="editSoal(this)"><i class="icon-pencil"></i></button>
                                        <a href="panel_admin/data_soal/hapus/<?php echo $baris->id_soal; ?>" class="btn btn-danger" title="Hapus soal" onclick="return confirm('Apakah anda yakin?')"><i class="icon-bin"></i></a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /basic datatable -->
        </div>

        <div class="modal fade" id="modal-detail-soal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                        </button>
                        <h4 class="modal-title">Detail Soal</h4>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-sm table-striped">
                                <tr>
                                    <th>Soal</th>
                                    <td id="detail_soal"></td>
                                </tr>
                                <tr>
                                    <th>Opsi A</th>
                                    <td id="detail_opsi_a"></td>
                                </tr>
                                <tr>
                                    <th>Opsi B</th>
                                    <td id="detail_opsi_b"></td>
                                </tr>
                                <tr>
                                    <th>Opsi C</th>
                                    <td id="detail_opsi_c"></td>
                                </tr>
                                <tr>
                                    <th>Opsi D</th>
                                    <td id="detail_opsi_d"></td>
                                </tr>
                                <tr>
                                    <th>Opsi E</th>
                                    <td id="detail_opsi_e"></td>
                                </tr>
                                <tr>
                                    <th>Jawaban</th>
                                    <td id="detail_jawaban"></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal-tambah-soal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                        </button>
                        <h4 class="modal-title">Tambah Soal</h4>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <form action="panel_admin/data_soal/tambah" enctype="multipart/form-data" method="POST">
                                <div class="col-md-12 form-group">
                                    <textarea id="soal" name="soal" required=""></textarea>
                                </div>
                                <div class="col-md-12 form-group">
                                    <label for="Media">Media :</label>
                                    <input type="file" name="media">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="A">Opsi A</label>
                                    <input type="text" name="opsi_a" class="form-control" placeholder="Jawaban A" required="">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="B">Opsi B</label>
                                    <input type="text" name="opsi_b" class="form-control" placeholder="Jawaban B" required="">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="C">Opsi C</label>
                                    <input type="text" name="opsi_c" class="form-control" placeholder="Jawaban C" required="">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="D">Opsi D</label>
                                    <input type="text" name="opsi_d" class="form-control" placeholder="Jawaban D" required="">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="E">Opsi E</label>
                                    <input type="text" name="opsi_e" class="form-control" placeholder="Jawaban E" required="">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="Jawaban">Jawaban</label>
                                    <select name="jawaban" id="" class="form-control" required="">
                                        <option value="" disabled selected>Pilih Jawaban...</option>
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                        <option value="D">D</option>
                                        <option value="E">E</option>
                                    </select>
                                    <input type="hidden" class="form-control">
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal-edit-soal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                        </button>
                        <h4 class="modal-title">Edit Soal</h4>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <form action="panel_admin/data_soal/edit" enctype="multipart/form-data" method="POST" id="formEditSoal">
                                <input type="hidden" name="id_soal">
                                <div class="col-md-12 form-group">
                                    <textarea id="soal_edit_textarea" name="soal" required=""></textarea>
                                </div>
                                <div class="col-md-12 form-group">
                                    <label for="Media">Media :</label>
                                    <input type="file" name="media">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="A">Opsi A</label>
                                    <input type="text" name="opsi_a" class="form-control" placeholder="Jawaban A" required="">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="B">Opsi B</label>
                                    <input type="text" name="opsi_b" class="form-control" placeholder="Jawaban B" required="">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="C">Opsi C</label>
                                    <input type="text" name="opsi_c" class="form-control" placeholder="Jawaban C" required="">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="D">Opsi D</label>
                                    <input type="text" name="opsi_d" class="form-control" placeholder="Jawaban D" required="">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="E">Opsi E</label>
                                    <input type="text" name="opsi_e" class="form-control" placeholder="Jawaban E" required="">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="Jawaban">Jawaban</label>
                                    <select name="jawaban" class="form-control" required="">
                                        <option value="" disabled selected>Pilih Jawaban...</option>
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                        <option value="D">D</option>
                                        <option value="E">E</option>
                                    </select>
                                    <input type="hidden" class="form-control">
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- /dashboard content -->
        <script async="defer">
            $(function() {
                CKEDITOR.replace('soal')
            })
            $(function() {
                CKEDITOR.replace('soal_edit_textarea')
            })
        </script>
        <script>
            $("document").ready(function() {
                $("#tabelSoal_filter.dataTables_filter").append($("#btnTambahSoal"));
                document.querySelector("#tabelSoal_wrapper .datatable-header").style.padding = "0 20px 0 20px";
            });

            function detailSoal(btn) {
                fetch("panel_admin/get_detail_soal/" + btn.dataset.idSoal).then(response => response.json()).then(result => {
                    document.getElementById("detail_soal").innerHTML = result.soal;
                    document.getElementById("detail_opsi_a").innerHTML = result.opsi_a;
                    document.getElementById("detail_opsi_b").innerHTML = result.opsi_b;
                    document.getElementById("detail_opsi_c").innerHTML = result.opsi_c;
                    document.getElementById("detail_opsi_d").innerHTML = result.opsi_d;
                    document.getElementById("detail_opsi_e").innerHTML = result.opsi_e;
                    document.getElementById("detail_jawaban").innerHTML = result.jawaban;
                    $('#modal-detail-soal').modal('show');
                });
            }

            function editSoal(btn) {
                fetch("panel_admin/get_detail_soal/" + btn.dataset.idSoal).then(response => response.json()).then(result => {
                    const form = document.forms["formEditSoal"];
                    form["id_soal"].value = result.id_soal;
                    CKEDITOR.instances['soal_edit_textarea'].setData(result.soal);
                    form["opsi_a"].value = result.opsi_a;
                    form["opsi_b"].value = result.opsi_b;
                    form["opsi_c"].value = result.opsi_c;
                    form["opsi_d"].value = result.opsi_d;
                    form["opsi_e"].value = result.opsi_e;
                    form["jawaban"].value = result.jawaban;
                    $('#modal-edit-soal').modal('show');
                });
            }
        </script>