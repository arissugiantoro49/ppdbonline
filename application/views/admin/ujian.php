<link rel="stylesheet" href="assets/panel/css/ujian.css">
<script src="assets/panel/js/ujian.js"></script>
<link rel="stylesheet" href="assets/panel/selectize/css/selectize.css">
<script src="assets/panel/selectize/js/standalone/selectize.js"></script>
<link rel="stylesheet" href="assets/panel/toastify/toastify.css">
<script src="assets/panel/toastify/toastify.js"></script>
<script src="assets/panel/js/sweetalert2.all.min.js"></script>

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
                                <th>Waktu Mulai</th>
                                <th>Tenggat Waktu</th>
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
                                    <td><?php echo $baris->jumlah_soal; ?></td>
                                    <td><?php echo $baris->durasi; ?> Menit</td>
                                    <td><?php echo $baris->waktu; ?></td>
                                    <td><?php echo $baris->tenggat_waktu; ?></td>
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
                                        <label for="waktu">Waktu mulai:</label>
                                        <input type="datetime-local" class="form-control" placeholder="Waktu ujian" name="waktu">
                                    </div>
                                    <div class="form-group">
                                        <label for="waktu">Tenggat waktu:</label>
                                        <input type="datetime-local" class="form-control" placeholder="Tenggat waktu" name="tenggat_waktu">
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
                                        <label for="waktu">Waktu mulai:</label>
                                        <input type="datetime-local" class="form-control" placeholder="Waktu ujian" name="waktu">
                                    </div>
                                    <div class="form-group">
                                        <label for="waktu">Tenggat waktu:</label>
                                        <input type="datetime-local" class="form-control" placeholder="Tenggat waktu" name="tenggat_waktu">
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-success" >Submit</button>
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
                        <!-- <a data-toggle="modal" href="#modal-detail-soal" class="btn btn-primary"><i class="icon-info22"></i></a> -->
                        <div class="row">
                            <div class="col-md-11">
                                <select class="daftar-soal" id="select-soal"></select>
                            </div>
                            <div class="col-md-1">
                                <button class="form-control btn-success" type="button" onclick="tambahSoal()">+</button>
                            </div>
                        </div>
                        <br>
                        <div class="table-responsive">
                            <table id="tabelDaftarSoal" class="table table-striped"></table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal" id="modal-detail-soal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Detail Soal</h4>
                    </div>
                    <div class="container"></div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-sm">
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
                    <div class="modal-footer">
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
            let idUjian;
            const selectSoal = $('#select-soal').selectize({
                placeholder: 'Tambah soal...',
                valueField: 'id_soal',
                labelField: 'soal',
                searchField: ['kode', 'soal', 'opsi_a', 'opsi_b', 'opsi_c', 'opsi_d', 'opsi_e'],
                options: [],
                create: false,
                render: {
                    option: function(item) {
                        return '<div class="p-1">' +
                            '<span class="title">' +
                            '<span class="name">' + item.soal + '</span>' +
                            '<span class="by">' + item.kode + '</span>' +
                            '</span>' +
                            '<ul class="meta">' +
                            '<li class="watchers"><span></span>A: ' + item.opsi_a + '</li>' +
                            '<li class="forks"><span></span>B: ' + item.opsi_b + '</li>' +
                            '<li class="forks"><span></span>C: ' + item.opsi_c + '</li>' +
                            '<li class="forks"><span></span>D: ' + item.opsi_d + '</li>' +
                            '<li class="forks"><span></span>E: ' + item.opsi_e + '</li>' +
                            '</ul>' +
                            '<span class="description">Jawaban: ' + item.jawaban + '</span>' +
                            '</div>';
                    }
                },
                load: function(query, callback) {
                    if (!query.length) return callback();
                    $.ajax({
                        url: 'panel_admin/get_list_soal/' + encodeURIComponent(query),
                        type: 'GET',
                        error: function() {
                            callback();
                        },
                        success: function(res) {
                            res.forEach((v) => {
                                v.soal = getText(v.soal);
                            })
                            callback(res);
                        }
                    });
                }
            });

            function daftarSoal(btn) {
                columns = [{
                        sTitle: "No",
                        data: null
                    },
                    {
                        data: "id_daftar_soal_ujian",
                        visible: false
                    },
                    {
                        data: "id_soal",
                        visible: false
                    },
                    {
                        sTitle: "Kode",
                        data: "kode"
                    },
                    {
                        sTitle: "Soal",
                        data: "soal"
                    },
                    {
                        sTitle: "Aksi",
                        data: null
                    }
                ];
                dt = fnInitializeDataTable('panel_admin/get_daftar_soal_ujian/' + btn.dataset.idUjian, columns, "id_daftar_soal_ujian")
                idUjian = btn.dataset.idUjian;
                $('#modal-daftar-soal').modal('show');
            }

            function tambahSoal() {
                if (selectSoal[0].value === "") {
                    showToast(false, "Pilih soal terlebih dahulu");
                    return
                }
                let idSoal = selectSoal[0].value;
                fetch(`panel_admin/tambah_daftar_soal_ujian?id_ujian=${idUjian}&id_soal=${idSoal}`).then(response => response.json()).then(result => {
                    showToast(result.success, result.message);
                    if (result.success) {
                        selectSoal[0].selectize.clear();
                        dt.ajax.reload();
                    }
                });
            }

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

            function hapusSoal(btn) {
                Swal.fire({
                    title: 'Hapus soal?',
                    showCancelButton: true,
                    confirmButtonText: 'Hapus',
                    confirmButtonColor: '#dc3741',
                    cancelButtonText: `Batal`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch("panel_admin/hapus_daftar_soal_ujian/" + btn.dataset.idSoal).then(response => response.text()).then(result => {
                            dt.ajax.reload();
                            showToast(true, "Berhasil menghapus soal");
                        });
                    }
                })
            }

            function editUjian(btn) {
                fetch("panel_admin/get_detail_ujian/" + btn.dataset.idUjian).then(response => response.json()).then(result => {
                    const form = document.forms["formEditUjian"];
                    form["id_ujian"].value = result.id_ujian;
                    form["nama"].value = result.nama;
                    form["durasi"].value = result.durasi;
                    form["waktu"].value = (new Date(result.waktu)).toISOString().substring(0, 16);
                    form["tenggat_waktu"].value = (new Date(result.tenggat_waktu)).toISOString().substring(0, 16);
                    form["tahun"].value = result.tahun;
                    $('#modal-edit-ujian').modal('show');
                });
            }

            document.forms[0].addEventListener("submit", evt => {
                evt.preventDefault();
                if (new Date(document.forms[0]['waktu'].value) < new Date(document.forms[0]['tenggat_waktu'].value)) {
                    document.forms[0].submit();
                } else {
                    showToast(false, "Tenggat waktu harus lebih besar dari waktu mulai");
                }
            })

            document.forms[1].addEventListener("submit", evt => {
                evt.preventDefault();
                if (new Date(document.forms[1]['waktu'].value) < new Date(document.forms[1]['tenggat_waktu'].value)) {
                    document.forms[1].submit();
                } else {
                    showToast(false, "Tenggat waktu harus lebih besar dari waktu mulai");
                }
            })
        </script>