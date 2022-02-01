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
          <h5 class="panel-title"><b>DATA SISWA</b></h5>
          <hr style="margin:0px;">
          <div class="heading-elements">
            <ul class="icons-list">
              <li><a data-action="collapse"></a></li>
            </ul> 
               <div class="input-group">
                <div class="input-group-addon"><i class="icon-calendar22"></i></div>
              <select class="form-control" name="thn" onchange="thn()">
                <?php for ($i = date('Y'); $i >= 2020; $i--) { ?>
                  <option value="<?php echo $i; ?>" <?php if ($v_thn == $i) {
                  echo "selected"; } ?>>Tahun <?php echo $i; ?></option>
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
                <th>No. Pendaftaran</th>
                <th>NISN</th>
                <th>NIK</th>
                <th>Nama Lengkap</th>
                <th class="text-center" width="130">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              foreach ($v_siswa->result() as $baris) { ?>
                <tr>
                  <td><?php echo $no++; ?></td>
                  <td><?php echo $baris->no_pendaftaran; ?></td>
                  <td><?php echo $baris->nisn; ?></td>
                  <td><?php echo $baris->nik; ?></td>
                  <td><?php echo $baris->nama_lengkap; ?></td>
                    <td align="center" style="white-space: nowrap;">
                    <button class="btn btn-primary d-none" class="btn btn-xs btn-default" title="Lihat dokumen" data-toggle="modal" data-target="#modalDokumen" data-no-pendaftaran="<?= $baris->no_pendaftaran ?>"><i class="icon-file-text2"></i></button>
                    
                 <!-- <button type="button" class="btn btn-warning" id="ubah">Ubah</button>
                  <button type="button" class="btn btn-secondary d-none" id="batal">Batal</button>
                  <button type="submit" class="btn btn-primary d-none" id="simpan">Simpan</button>
                -->
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
        window.location = "Panel_admin/ubah_siswa/thn/" + thn;
      }

      $('[name="thn"]').select2({
        placeholder: "- Tahun -"
      });
  
    </script>