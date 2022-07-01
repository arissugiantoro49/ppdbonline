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
                    <h5 class="panel-title"><b>NILAI UJIAN</b></h5>
                    <hr style="margin:0px;">
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                        </ul>
                    </div>
                </div>
                <div style="overflow-x: auto">
                    <table class="table datatable-basic table-sm table-striped" width="100%" id="tabelSoal">
                        <thead>
                            <tr>
                                <th width="30px;">No.</th>
                                <th>NISN</th>
                                <th>Nama Siswa</th>
                                <th>Ujian</th>
                                <th>Nilai</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($nilai_ujian->result() as $baris) {
                            ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $baris->nisn; ?></td>
                                    <td><?= $baris->nama_lengkap; ?></td>
                                    <td><?= $baris->nama_ujian; ?></td>
                                    <td><?= $baris->nilai; ?></td>
                                    <td>
                                        <a href="panel_admin/nilai_ujian/hapus/<?php echo $baris->id_ikut_ujian; ?>" class="btn btn-danger" title="Hapus nilai" onclick="return confirm('Apakah anda yakin?')"><i class="icon-bin"></i></a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /basic datatable -->
        </div>
