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
          <h5 class="panel-title"><b>REKAPITULASI NILAI PENDAFTAR</b></h5>
          <hr style="margin:0px;">
          <div class="heading-elements">
            <ul class="icons-list">
              <li><a data-action="collapse"></a></li>
            </ul>
          </div>

          <br>
            <a href="panel_admin/rekap_nilai_admin" class="btn btn-danger"></a>
          <div class="col-md-3" style="float: right; margin-right: 0px;">
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
                <th>Rata rata nilai raport</th>
                <th>Rata rata nilai usbn</th>
                <th>Rata rata nilai uas</th>
                <th>Nilai Prestasi</th>
                <th>Nilai Ujian Seleksi</th>
               <!-- <th class="text-center" width="180">Aksi</th> -->
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
                    <?=  $baris->rata_rata_raport?>
                  <!-- <button type="button" class="btn btn-sm" data-toggle="modal" data-target="#modal-nilai-raport-<?= $baris->nisn ?>"><?php echo ($baris->matematika_raport + $baris->ipa_raport + $baris->bahasa_indonesia_raport + $baris->pai_raport) / 4; ?></button> -->
                  <!-- <div class="modal fade" id="modal-nilai-raport-<?= $baris->nisn ?>">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">
                        <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="gridSystemModalLabel">Detail Nilai Raport</h4>
                        </div>
                        <div class="modal-body">
                         <h6>Matematika : 
                          <?php echo ($baris->matematika_raport); ?> </h6>
                         <h6>Ilmu Pengetahuan Alam :  
                          <?php echo ($baris->ipa_raport ); ?> </h6>
                          <h6>Bahasa Indonesia : 
                          <?php echo ($baris->bahasa_indonesia_raport ); ?></h6>
                          <h6>Pendidikan Agama Islam : 
                          <?php echo ($baris->pai_raport ); ?> </h6>
                          <h6 class="modal-title" id="gridSystemModalLabel">Rata-rata :
                          <?php echo ($baris->matematika_raport + $baris->ipa_raport + $baris->bahasa_indonesia_raport + $baris->pai_raport) / 4; ?> </h6>
                        </div>
                      </div>
                    </div>
                  </div> -->
                  </td>
                  
                  <td>
                  <?=  $baris->rata_rata_usbn?>
                  <!-- <button type="button" class="btn btn-sm" data-toggle="modal" data-target="#modal-nilai-usbn-<?= $baris->nisn ?>"> <?php echo ($baris->matematika_usbn + $baris->ipa_usbn + $baris->bindo_usbn + $baris->pai_usbn) / 4; ?></button>
                  <div class="modal fade" id="modal-nilai-usbn-<?= $baris->nisn ?>">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">
                        <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="gridSystemModalLabel">Detail Nilai USBN/UMBN</h4>
                        </div>
                        <div class="modal-body">
                         <h6>Matematika : 
                          <?php echo ($baris->matematika_usbn); ?> </h6>
                         <h6>Ilmu Pengetahuan Alam :  
                          <?php echo ($baris->ipa_usbn ); ?> </h6>
                          <h6>Bahasa Indonesia : 
                          <?php echo ($baris->bindo_usbn ); ?></h6>
                          <h6>Pendidikan Agama Islam : 
                          <?php echo ($baris->pai_usbn ); ?> </h6>
                          <h6 class="modal-title" id="gridSystemModalLabel">Rata-rata :
                          <?php echo ($baris->matematika_usbn + $baris->ipa_usbn + $baris->bindo_usbn + $baris->pai_usbn) / 4; ?> </h6>
                        </div>
                      </div>
                    </div>
                  </div> -->
                  </td>
                   
                 <td>
                 <?=  $baris->rata_rata_uas?>
                  <!-- <button type="button" class="btn btn-sm" data-toggle="modal" data-target="#modal-nilai-uas-<?= $baris->nisn ?>"> <?php echo ($baris->matematika_uas + $baris->ipa_uas + $baris->bindo_uas + $baris->pai_uas) / 4; ?></button>
                  <div class="modal fade" id="modal-nilai-uas-<?= $baris->nisn ?>">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">
                        <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="gridSystemModalLabel">Detail Nilai Ujian Akhir Semester</h4>
                        </div>
                        <div class="modal-body">
                         <h6>Matematika : 
                          <?php echo ($baris->matematika_uas); ?> </h6>
                         <h6>Ilmu Pengetahuan Alam :  
                          <?php echo ($baris->ipa_uas ); ?> </h6>
                          <h6>Bahasa Indonesia : 
                          <?php echo ($baris->bindo_uas ); ?></h6>
                          <h6>Pendidikan Agama Islam : 
                          <?php echo ($baris->pai_uas ); ?> </h6>
                          <h6 class="modal-title" id="gridSystemModalLabel">Rata-rata :
                          <?php echo ($baris->matematika_uas + $baris->ipa_uas + $baris->bindo_uas + $baris->pai_uas) / 4; ?> </h6>
                        </div>
                      </div>
                    </div>
                  </div> -->
                  </td>
                  <td>
                 <?=  $baris->nilai_prestasi?>
                  <!-- <button type="button" class="btn btn-sm" data-toggle="modal" data-target="#modal-nilai-prestasi-<?= $baris->nisn ?>"> <?php echo ($baris->nilai_prestasi) ; ?></button>
                  <div class="modal fade" id="modal-nilai-prestasi-<?= $baris->nisn ?>">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">
                        <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="gridSystemModalLabel">Detail Nilai Prestasi</h4>
                        </div>
                        <div class="modal-body">
                         <h6>Nilai Prestasi : 
                         <?php echo ($baris->nilai_prestasi) ; ?> </h6>  
                        </div>
                      </div>
                    </div>
                  </div> -->
                  </td>

                  <td>
                  <button type="button" class="btn btn-sm" data-toggle="modal" data-target="#modal-nilai-seleksi-<?= $baris->nisn ?>"> <?= $baris->nilai_ujian_seleksi == null ? "Proses Ujian" : $baris->nilai_ujian_seleksi; ?></button>
                  <div class="modal fade" id="modal-nilai-seleksi-<?= $baris->nisn ?>">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">
                        <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="gridSystemModalLabel">Detail Nilai Ujian Seleksi</h4>
                        </div>
                        <div class="modal-body">
                         <h6>Nilai Ujian Seleksi : 
                         <?= $baris->nilai_ujian_seleksi == null ? "Proses Ujian" : $baris->nilai_ujian_seleksi; ?></h6>  
                        </div>
                      </div>
                    </div>
                  </div>
                  </td>
                   <!-- <td align="center" style="white-space: nowrap;">
                    <button class="btn btn-xs btn-default" title="Lihat dokumen" data-toggle="modal" data-target="#modalDokumen" data-no-pendaftaran="<?= $baris->no_pendaftaran ?>"><i class="icon-file-text2"></i></button>
                  </td> -->

                  <!-- <div class="modal fade" id="modalDokumen" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="modalDokumenLabel">Daftar Dokumen</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <p><strong>Raport</strong></p>
                          <p id="info_dok_raport">Tidak ada</p>
                          <embed id="embed_dok_raport" width="100%">

                          <p style="margin-top: 2em"><strong>USBN</strong></p>
                          <p id="info_dok_usbn">Tidak ada</p>
                          <embed id="embed_dok_usbn" width="100%">

                          <p style="margin-top: 2em"><strong>UAS</strong></p>
                          <p id="info_dok_uas">Tidak ada</p>
                          <embed id="embed_dok_uas" width="100%">

                          <p style="margin-top: 2em"><strong>Prestasi</strong></p>
                          <p id="info_dok_prestasi">Tidak ada</p>
                          <embed id="embed_dok_prestasi" width="100%">
                        </div>
                      </div>
                    </div>
                  </div>

                  <script>
                    $('#modalDokumen').on('show.bs.modal', function(e) {
                      const button = $(e.relatedTarget)
                      const no_pendaftaran = button.data('no-pendaftaran')
                      const fields = ["dok_raport", "dok_usbn", "dok_uas", "dok_prestasi"]

                      fields.forEach(v => {
                        $("#embed_" + v)[0].src = ""
                        $("#embed_" + v)[0].style.height = "";
                        $("#embed_" + v)[0].style.display = "none"
                        $("#info_" + v)[0].style.display = "none"
                      })

                      fetch("panel_admin/info_nilai_siswa/" + no_pendaftaran)
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
                  </script> -->
                  
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
        window.location = "panel_admin/rekap_nilai_admin/thn/" + thn;
      }

      $('[name="thn"]').select2({
        placeholder: "- Tahun -"
      });
      
    </script>