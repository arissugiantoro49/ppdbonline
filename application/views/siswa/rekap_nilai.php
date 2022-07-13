<style>
  #tbl_input {
    width: 50px;
    text-align: center;
  }

  #tbl_input2 {
    width: 100px;
    text-align: center;
  }

  #th_center>th {
    text-align: center;
  }

  .d-none {
    display: none;
  }

  .mr-1 {
    margin-right: 1rem;
  }

  .ml-2 {
    margin-left: 2rem;
  }
</style>

<?php
error_reporting(0);
$user = $user; ?>
<!-- Main content -->
<div class="content-wrapper">

  <!-- Content area -->
  <div class="content">

    <!-- Dashboard content -->
    <div class="row">
      <form action="./panel_siswa/ubah_nilai" enctype="multipart/form-data" method="post" id="ubah_nilai">
        <div class="col-md-7">
          <div class="panel panel-flat">
            <div class="panel-body">
              <fieldset class="content-group">
                <legend class="text-bold"><i class="icon-user"></i>
                  <span class="mr-1">BIODATA NILAI SISWA</span>
                  <?php
                  if ($this->input->get("edit") === "success") {
                    echo '<p class="badge bg-success">Berhasil mengubah biodata</p>';
                  }
                  ?>
                </legend>
                <div>
                  <button type="button" class="btn btn-warning" id="ubah">Ubah</button>
                  <button type="button" class="btn btn-secondary d-none" id="batal">Batal</button>
                  <button type="submit" class="btn btn-primary d-none" id="simpan">Simpan</button>
                  <button type="button" class="btn btn btn-default ml-2" data-toggle="modal" data-target="#modalDokumen">Lihat Dokumen</button>

                </div>
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
                        <p><strong>Dokumen Raport</strong></p>
                        <p id="info_dok_raport">Tidak ada</p>
                        <embed id="embed_dok_raport" width="100%">

                        <p style="margin-top: 2em"><strong>Dokumen USBN/UMBN</strong></p>
                        <p id="info_dok_usbn">Tidak ada</p>
                        <embed id="embed_dok_usbn" width="100%">

                        <p style="margin-top: 2em"><strong>Dokumen UAS</strong></p>
                        <p id="info_dok_uas">Tidak ada</p>
                        <embed id="embed_dok_uas" width="100%">

                        <p style="margin-top: 2em"><strong>Dokumen Prestasi</strong></p>
                        <p id="info_dok_prestasi">Tidak ada</p>
                        <embed id="embed_dok_prestasi" width="100%">
                      </div>
                    </div>
                  </div>
                </div>
                <script>
                  $('#modalDokumen').on('show.bs.modal', function(e) {
                    const fields = ["dok_raport", "dok_usbn", "dok_uas", "dok_prestasi"]

                    fields.forEach(v => {
                      $("#embed_" + v)[0].src = ""
                      $("#embed_" + v)[0].style.height = "";
                      $("#embed_" + v)[0].style.display = "none"
                      $("#info_" + v)[0].style.display = "none"
                    })

                    fetch("panel_siswa/data_nilai")
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
                <br>
                <div class="table-responsive">
                  <table class="table table-bordered table-striped">
                    <input type="hidden" name="no_pendaftaran" value="<?php echo $user->no_pendaftaran; ?>">
                    
                    <tr>
                      <th width="20%">Nilai Raport</th>
                      <th width="1%">:</th>
                      <td><input type="text" name="rata_rata_raport" class="form-control" value="<?= $nilai->rata_rata_raport ?>" disabled></td>
                    </tr>
                    <tr>
                      <th width="20%">Nilai USBN</th>
                      <th width="1%">:</th>
                      <td><input type="text" name="rata_rata_usbn" class="form-control" value="<?= $nilai->rata_rata_usbn ?>" disabled></td>
                    </tr>
                    <tr>
                      <th width="20%">Nilai UAS</th>
                      <th width="1%">:</th>
                      <td><input type="text" name="rata_rata_uas" class="form-control" value="<?= $nilai->rata_rata_uas ?>" disabled></td>
                    </tr>
                    <tr>
                      <th width="20%">Nilai Prestasi</th>
                      <th width="1%">:</th>
                      <td><input type="text" name="nilai_prestasi" class="form-control" value="<?= $nilai->nilai_prestasi ?>" disabled></td>
                    </tr>

                    <?php foreach ($nilai_ujian_seleksi->result() as $ujian) { ?>
                    <tr>
                      <th width="20%"><?= $ujian->nama ?></th>
                      <th width="1%">:</th>
                      <td><input type="text" class="form-control" value="<?= $ujian->nilai == null ? 0 : $ujian->nilai; ?>" disabled></td>
                    </tr>
                    <?php } ?>
                  </table>
                </div>
              </fieldset>
            </div>
          </div>
        </div>

        <div class="col-md-5">
          <div class="panel panel-flat">
            <div class="panel-body">
              <center>
                <img src="img/logo.png" alt="<?php echo $user->nama_lengkap; ?>" class="" width="176">
              </center>
              <br>
              <fieldset class="content-group">
                <hr style="margin-top:0px;">
                <b>Tanggal Daftar</b> : <br>
                <?php echo $this->lib_data->tgl_id(date('d-m-Y H:i:s', strtotime($user->tgl_siswa))); ?>
                <hr>
                <b>No. Pendaftaran : </b><?php echo $user->no_pendaftaran; ?>
              </fieldset>
            </div>
          </div>
        </div>

        <div class="col-md-5">
          <div class="panel panel-flat">
            <div class="panel-body">
              <fieldset class="content-group">
                <legend class="text-bold"><i class="icon-file-text"></i> Dokumen</legend>
                <div class="table-responsive">
                  <table class="table table-bordered table-striped">
                    <tr>
                      <th width="30%">Dokumen Raport <span class="text-danger">*</span></th>
                      <th width="1%">:</th>
                      <td>
                        <input type="file" name="dok_raport" class="form-control" accept="application/pdf, image/*" disabled>
                      </td>
                    </tr>
                    <tr>
                      <th width="30%"> Dokumen USBN/UMBN <span class="text-danger">*</span></th>
                      <th width="1%">:</th>
                      <td>
                        <input type="file" name="dok_usbn" accept="application/pdf, image/*" class="form-control" disabled>
                      </td>
                    </tr>
                    <tr>
                      <th width="30%">Dokumen UAS <span class="text-danger">*</span></th>
                      <th width="1%">:</th>
                      <td>
                        <input type="file" name="dok_uas" accept="application/pdf, image/*" class="form-control" disabled>
                      </td>
                    </tr>
                    <tr>
                      <th width="30%">Dokumen Prestasi</th>
                      <th width="1%">:</th>
                      <td>
                        <input type="file" name="dok_prestasi" accept="application/pdf, image/*" class="form-control" disabled>
                      </td>
                    </tr>
                  </table>
                </div>
              </fieldset>
            </div>
          </div>
        </div>


      </form>
    </div>
    <!-- /dashboard content -->

    <script>
      const form = document.forms["ubah_nilai"]

      function toggle() {
        btnUbah.classList.toggle("d-none")
        btnBatal.classList.toggle("d-none")
        btnSimpan.classList.toggle("d-none")

        const list = ["rata_rata_raport", "rata_rata_usbn", "rata_rata_uas", "nilai_prestasi", "dok_uas", "dok_usbn", "dok_raport", "dok_prestasi"]
        list.forEach(e => {
          form[e].toggleAttribute("disabled")
        })
      }

      const btnUbah = document.getElementById("ubah");
      const btnBatal = document.getElementById("batal");
      const btnSimpan = document.getElementById("simpan");

      btnUbah.onclick = toggle
      btnBatal.onclick = toggle
    </script>