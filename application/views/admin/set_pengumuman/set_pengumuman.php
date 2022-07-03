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
          <h5 class="panel-title"><b>VERIFIKASI PENERIMAAN</b></h5>
          <hr style="margin:0px;">
          <div class="heading-elements">
            <ul class="icons-list">
              <li><a data-action="collapse"></a></li>
            </ul>
          </div>

          <br>
          <a href="panel_admin/edit_ket" class="btn btn-warning">EDIT KETERANGAN DI TERIMA</a>
          <div class="col-md-3" style="float:right;margin-right:25px;">
            <div class="input-group">
              <div class="input-group-addon"><i class="icon-calendar22"></i></div>
              <select class="form-control" name="thn" onchange="thn()">
                <?php for ($i = date('Y'); $i >= 2020; $i--) { ?>
                  <option value="<?php echo $i; ?>" <?php if ($v_thn == $i) {
                                                      echo "selected";
                                                    } ?>>Tahun <?php echo $i; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
        </div>
        <div class="table-responsive">
          <table class="table datatable-basic table-bordered" width="100%">
            <thead>
              <tr>
                <th width="30px;">No.</th>
                <th>No. Pendaftaran</th>
                <th>NISN</th>
                <th>NIK</th>
                <th>Nama Lengkap</th>
                <!-- <th>Rata-rata Nilai Rapor</th> -->
                <th>Nilai Akhir (Yi)</th>
                <th>Ranking</th>
                <th>Status Penerimaan</th>
                <th class="text-center" width="220">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $tabel_yi = $this->admin->get_tabel_yi($v_thn);

              $no = 1;
              foreach ($v_siswa->result() as $baris) { ?>
                <tr>
                  <td><?php echo $no++; ?></td>
                  <td><?php echo $baris->no_pendaftaran; ?></td>
                  <td><?php echo $baris->nisn; ?></td>
                  <td><?php echo $baris->nik; ?></td>
                  <td><?php echo $baris->nama_lengkap; ?></td>
                  <td><?= number_format((float) $tabel_yi[$baris->id_siswa]['optimasi'], 4, '.', '') ?></td>
                  <td>
                    <button type="button" class="btn btn-sm" data-nilai-c1="<?= $tabel_yi[$baris->id_siswa]['c1'] ?>" data-nilai-c5="<?= $tabel_yi[$baris->id_siswa]['c5'] ?>" data-nilai-yi="<?= number_format((float) $tabel_yi[$baris->id_siswa]['optimasi'], 4, '.', '') ?>" onclick="lihatDetailNilai(this)"><?= $tabel_yi[$baris->id_siswa]['rank'] ?></button>
                  </td>
                  <td align="center">
                    <?php if ($baris->status_pendaftaran == 'lulus') { ?>
                      <label class="label label-success">DiTerima di kelas
                        <?php
                        $rank = $tabel_yi[$baris->id_siswa]['rank'];
                        if ($rank <= 2) echo 'A';
                        elseif ($rank <= 4) echo 'B';
                        elseif ($rank <= 6) echo 'C';
                        ?>
                      </label>
                    <?php } elseif ($baris->status_pendaftaran == 'tidak lulus') { ?>
                      <label class="label label-danger">Tidak di Terima</label>
                    <?php } else { ?>
                      <label class="label label-warning">Proses</label>
                    <?php } ?>
                  </td>
                  <td align="center">
                    <?php if ($baris->status_pendaftaran == '') { ?>
                      <a href="panel_admin/set_pengumuman/tdk_lulus/<?php echo $baris->no_pendaftaran; ?>" class="btn btn-warning btn-xs" title="Tidak diterima" onclick="return confirm('Apakah Anda yakin?')"><i class="icon-cross3"></i> Tidak di Terima</a>
                      <a href="panel_admin/set_pengumuman/lulus/<?php echo $baris->no_pendaftaran; ?>" class="btn btn-success btn-xs" title="di Terima" onclick="return confirm('Apakah Anda yakin?')"><i class="icon-checkmark4"></i> di Terima</a>
                    <?php } else { ?>
                      <a href="panel_admin/set_pengumuman/batal/<?php echo $baris->no_pendaftaran; ?>" class="btn btn-danger btn-xs" title="Batalkan" onclick="return confirm('Apakah Anda yakin?')"><i class="icon-cross3"></i> Batal</a>
                    <?php } ?>
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

    <div class="modal fade" id="modalDetailNilai">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title" id="gridSystemModalLabel">Detail Prioitas Nilai</h4>
          </div>
          <div class="modal-body">
            <h6>1. Nilai Akhir (Yi) : <span id="nilaiYi"></span></h6>
            <h6>2. Nilai Ujian Seleksi (C5) : <span id="nilaiC5"></span></h6>
            <h6>3. Nilai Raport (C1) : <span id="nilaiC1"></span></h6>
          </div>
        </div>
      </div>
    </div>

    <script type="text/javascript">
      function thn() {
        var thn = $('[name="thn"]').val();
        window.location = "panel_admin/set_pengumuman/thn/" + thn;
      }

      $('[name="thn"]').select2({
        placeholder: "- Tahun -"
      });

      function lihatDetailNilai(btn) {
        document.getElementById("nilaiYi").textContent = btn.dataset.nilaiYi;
        document.getElementById("nilaiC5").textContent = btn.dataset.nilaiC5;
        document.getElementById("nilaiC1").textContent = btn.dataset.nilaiC1;
        $('#modalDetailNilai').modal('show');
      }
    </script>