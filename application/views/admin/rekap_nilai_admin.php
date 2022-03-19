<!-- Main content -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
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
          <h5 class="panel-title"><b>VERIFIKASI DATA PENDAFTARAN</b></h5>
          <hr style="margin:0px;">
          <div class="heading-elements">
            <ul class="icons-list">
              <li><a data-action="collapse"></a></li>
            </ul>
          </div>

          <br>
<a  href="panel_admin/edit_materi" class="btn btn-danger"><b>INFORMASI JADWAL UJIAN</b></a>
          <div class="col-md-3" style="float: right; margin-right: 25px;">
            <div class="input-group">
              <div class="input-group-addon"><i class="icon-calendar22"></i></div>
              <select class="form-control" name="thn" onchange="thn()">
                <?php for ($i = date('Y'); $i >= 2021; $i--) { ?>
                  <option value="<?php echo $i; ?>" <?php if ($v_thn == $i) {
                                                      echo "selected";
                                                    } ?>>Tahun <?php echo $i; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
        </div>
        <div class="table-responsive">
          <table class="table datatable-basic table-sm table-striped" width="100%">
            <thead>
              <tr>
                <th width="30px;">No.</th>
                <th>NISN</th>
                <th>Nama Lengkap</th>
                <th>Nilai Raport</th>
                <th>Nilai USBN/UMBN</th>
                <th>Nilai UAS</th>
                <th>Nilai Prestasi</th>
                <th>Nilai Ujian Seleksi</th>
                <th class="text-center" width="180">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              foreach ($v_siswa->result() as $baris) { ?>
                <tr>
                  <td><?php echo $no++; ?></td>
                  <td><?php echo $baris->nisn; ?></td>
                  <td><?php echo $baris->nama_lengkap; ?></td> 
                  <td>
                  <button type="button" class="btn btn-sm" data-toggle="modal" data-target="#modal-nilai-raport-<?= $baris->nisn ?>"><?php echo ($baris->matematika_raport + $baris->ipa_raport + $baris->bahasa_indonesia_raport + $baris->pai_raport) / 4; ?></button>
                  <div class="modal fade" id="modal-nilai-raport-<?= $baris->nisn ?>">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">
                        <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="gridSystemModalLabel">Detail Nilai Raport</h4>
                        </div>
                        <div class="modal-body">
                          test
                        </div>
                      </div>
                    </div>
                  </div>
                  </td>

                  <td>
                  <button type="button" class="btn btn-sm" data-toggle="popover" title="Nilai USBN/UMBN"
                  data-content="
                  Matematika: <?= $baris->matematika_usbn ?>, 
                  IPA: <?= $baris->ipa_usbn ?>, 
                  Bhs. Indonesia: <?= $baris->bindo_usbn ?>, 
                  PAI: <?= $baris->pai_usbn ?>"><?php echo ($baris->matematika_usbn + $baris->ipa_usbn + $baris->bindo_usbn + $baris->pai_usbn) / 4; ?></button>
                  </td>

                  <td>
                  <button type="button" class="btn btn-sm" data-toggle="popover" title="Nilai UAS"
                  data-content="
                  Matematika: <?= $baris->matematika_uas ?>, 
                  IPA: <?= $baris->ipa_uas ?>, 
                  Bhs. Indonesia: <?= $baris->bindo_uas ?>, 
                  PAI: <?= $baris->pai_uas ?>"><?php echo ($baris->matematika_uas + $baris->ipa_uas + $baris->bindo_uas + $baris->pai_uas) / 4; ?></button>
                  </td>

                  <td>
                  <button type="button" class="btn btn-sm" data-toggle="popover" title="Nilai Prestasi"
                  data-content="
                  Nilai Prestasi: <?= $baris->nilai_prestasi ?>, 
                 
            
                  ">
                  <?php echo ($baris->nilai_prestasi) / 4; ?></button>
                  </td>


                  <td align="center" style="white-space: nowrap;">
                    <button class="btn btn-xs btn-default" title="Lihat dokumen" data-toggle="modal" data-target="#modalDokumen" data-no-pendaftaran="<?= $baris->no_pendaftaran ?>"><i class="icon-file-text2"></i></button>
                    <a href="panel_admin/verifikasi/hapus/<?php echo $baris->no_pendaftaran; ?>" class="btn btn-danger btn-xs" title="Ubah" data-no-pendaftaran="<?= $baris->no_pendaftaran ?>" ><i class="icon-bin"></i></a>
                  </td>

                  <!-- Modal Dokumen -->
                  <div class="modal fade" id="modalDokumen" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="modalDokumenLabel">Daftar Dokumen</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <p><strong>Kartu Keluarga</strong></p>
                          <p id="info_dokumen_kk">Tidak ada</p>
                          <embed id="embed_dokumen_kk" width="100%">

                          <p style="margin-top: 2em"><strong>Akte Kelahiran</strong></p>
                          <p id="info_dokumen_akte_kelahiran">Tidak ada</p>
                          <embed id="embed_dokumen_akte_kelahiran" width="100%">

                          <p style="margin-top: 2em"><strong>SKL</strong></p>
                          <p id="info_dokumen_skl">Tidak ada</p>
                          <embed id="embed_dokumen_skl" width="100%">

                          <p style="margin-top: 2em"><strong>Kartu Bantuan</strong></p>
                          <p id="info_dokumen_kartu_bantuan">Tidak ada</p>
                          <embed id="embed_dokumen_kartu_bantuan" width="100%">
                        </div>
                      </div>
                    </div>
                  </div>

                  <script>
                    $('#modalDokumen').on('show.bs.modal', function(e) {
                      const button = $(e.relatedTarget)
                      const no_pendaftaran = button.data('no-pendaftaran')
                      const fields = ["dokumen_kk", "dokumen_akte_kelahiran", "dokumen_skl", "dokumen_kartu_bantuan"]

                      fields.forEach(v => {
                        $("#embed_" + v)[0].src = ""
                        $("#embed_" + v)[0].style.height = "";
                        $("#embed_" + v)[0].style.display = "none"
                        $("#info_" + v)[0].style.display = "none"
                      })

                      fetch("panel_admin/info_siswa/" + no_pendaftaran)
                        .then(response => response.json())
                        .then(result => {
                          fields.forEach(v => {
                            if (result[v] && result[v] !== "") {
                              $("#embed_" + v)[0].src = "uploads/dokumen/" + result[v]
                              if (result[v].split(".").pop() === "pdf") {
                                $("#embed_" + v)[0].style.height = "550px";
                              }
                              $("#embed_" + v)[0].style.display = "block"
                            } else {
                              $("#info_" + v)[0].style.display = "block"
                            }
                          })
                        })
                    })
                  </script>
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

    <script type="text/javascript">
      function thn() {
        var thn = $('[name="thn"]').val();
        window.location = "panel_admin/verifikasi/thn/" + thn;
      }

      $('[name="thn"]').select2({
        placeholder: "- Tahun -"
      });
      
    </script>