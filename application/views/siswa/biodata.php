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
      <form action="./panel_siswa/ubah_biodata" enctype="multipart/form-data" method="post" id="ubah_biodata">
        <div class="col-md-9">
          <div class="panel panel-flat">
            <div class="panel-body">
              <fieldset class="content-group">
                <legend class="text-bold"><i class="icon-user"></i>
                  <span class="mr-1">BIODATA SISWA</span>
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
                  <a href="panel_siswa/download_dokumen" class="btn btn-default" target="_blank">Download Dokumen</a>
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
                      const fields = ["dokumen_kk", "dokumen_akte_kelahiran", "dokumen_skl", "dokumen_kartu_bantuan"]

                      fields.forEach(v => {
                        $("#embed_" + v)[0].src = ""
                        $("#embed_" + v)[0].style.height = "";
                        $("#embed_" + v)[0].style.display = "none"
                        $("#info_" + v)[0].style.display = "none"
                      })

                      fetch("panel_siswa/dataku")
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
                    <tr>
                      <th width="20%">NO. PENDAFTARAN</th>
                      <th width="1%">:</th>
                      <td><input type="text" name="no_pendaftaran" class="form-control" value="<?php echo $user->no_pendaftaran; ?>" readonly></td>
                    </tr>
                    <tr>
                      <th>N.I.S.N</th>
                      <th>:</th>
                      <td><input type="text" name="nisn" class="form-control" value="<?php echo $user->nisn; ?>" disabled></td>
                    </tr>
                    <tr>
                      <th>NIK</th>
                      <th>:</th>
                      <td><input type="text" name="nik" class="form-control" value="<?php echo $user->nik; ?>" disabled></td>
                    </tr>
                    <tr>
                      <th>Nama Lengkap</th>
                      <th>:</th>
                      <td><input type="text" name="nama_lengkap" class="form-control" value="<?php echo $user->nama_lengkap; ?>" disabled></td>
                    </tr>
                    <tr>
                      <th>Jenis Kelamin</th>
                      <th>:</th>
                      <td>
                        <select class="form-control" name="jk" disabled>
                          <option value="Laki-Laki">Laki-Laki</option>
                          <option value="Perempuan">Perempuan</option>
                        </select>
                        <script>
                          document.forms["ubah_biodata"]["jk"].value = `<?php echo $user->jk; ?>`
                        </script>
                      </td>
                    </tr>
                    <tr>
                      <th>Tempat, Tgl Lahir</th>
                      <th>:</th>
                      <td>
                        <div style="display: flex;">
                          <input type="text" name="tempat_lahir" class="form-control mr-1" value="<?php echo $user->tempat_lahir; ?>" disabled>
                          <input type="date" name="tgl_lahir" class="form-control" value="<?php echo date('Y-m-d', strtotime($user->tgl_lahir)); ?>" disabled>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <th>Agama</th>
                      <th>:</th>
                      <td>
                        <select class="form-control" name="agama" disabled>
                          <option value="Islam">Islam</option>
                          <option value="Kristen">Kristen</option>
                          <option value="Katolik">Katolik</option>
                          <option value="Buddha">Buddha</option>
                          <option value="Hindu">Hindu</option>
                          <option value="Konghucu">Konghucu</option>
                          <option value="Lainnya">Lainnya</option>
                        </select>
                        <script>
                          document.forms["ubah_biodata"]["agama"].value = `<?php echo $user->agama; ?>`
                        </script>
                      </td>
                    </tr>
                    <tr>
                      <th>Status dalam Keluarga</th>
                      <th>:</th>
                      <td>
                        <select class="form-control" name="status_keluarga" disabled>
                          <option value="Anak Kandung">Anak Kandung</option>
                          <option value="Anak Angkat">Anak Angkat</option>
                        </select>
                        <script>
                          document.forms["ubah_biodata"]["status_keluarga"].value = `<?php echo $user->status_keluarga; ?>`
                        </script>
                      </td>
                    </tr>
                    <tr>
                      <th>Alamat</th>
                      <th>:</th>
                      <td>
                        <div style="display: flex; flex-wrap: wrap;">
                          <div class="form-group mr-1">
                            <label for="kab">Kab</label>
                            <input type="text" class="form-control" id="kab" name="kab" value="<?php echo $user->kab; ?>" disabled>
                          </div>
                          <div class="form-group mr-1">
                            <label for="kab">Kec</label>
                            <input type="text" class="form-control" id="kec" name="kec" value="<?php echo $user->kec; ?>" disabled>
                          </div>
                          <div class="form-group mr-1">
                            <label for="kab">Desa</label>
                            <input type="text" class="form-control" id="desa" name="desa" value="<?php echo $user->desa; ?>" disabled>
                          </div>
                          <div class="form-group mr-1">
                            <label for="kab">Jalan</label>
                            <input type="text" class="form-control" id="alamat_siswa" name="alamat_siswa" value="<?php echo $user->alamat_siswa; ?>" disabled>
                          </div>
                          <div class="form-group mr-1">
                            <label for="kab">Kode Pos</label>
                            <input type="text" class="form-control" id="kode_pos" name="kode_pos" value="<?php echo $user->kode_pos; ?>" disabled>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <th>No. Handphone</th>
                      <th>:</th>
                      <td>
                        <input type="text" name="no_hp_siswa" class="form-control" value="<?php echo $user->no_hp_siswa; ?>" disabled>
                      </td>
                    </tr>
                  </table>
                </div>
              </fieldset>
            </div>
          </div>
        </div>

        <div class="col-md-3">
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

        <div class="col-md-4">
          <div class="panel panel-flat">
            <div class="panel-body">
              <fieldset class="content-group">
                <legend class="text-bold"><i class="icon-user"></i> Data Ayah</legend>
                <div class="table-responsive">
                  <table class="table table-bordered table-striped">
                    <tr>
                      <th width="20%">Nama Lengkap</th>
                      <th width="1%">:</th>
                      <th>
                        <input oninput="copy2()" type="text" name="nama_ayah" class="form-control" value="<?php echo ucwords($user->nama_ayah); ?>" disabled>
                      </th>
                    </tr>
                    <tr>
                      <th width="20%">NIK Ayah</th>
                      <th width="1%">:</th>
                      <th>
                        <input type="text" name="nik_ayah" class="form-control" value="<?php echo ucwords($user->nik_ayah); ?>" disabled>
                      </th>
                    </tr>
                    <tr>
                      <th>Pendidikan</th>
                      <th>:</th>
                      <td>
                        <select class="form-control" name="pdd_ayah" disabled>
                          <option value="">Pilih Pendidikan Ayah</option>
                          <option value="SD/Sederajat">SD/Sederajat</option>
                          <option value="SMP/Sederajat">SMP/Sederajat</option>
                          <option value="SMA/Sederajat">SMA/Sederajat</option>
                          <option value="D1">D1</option>
                          <option value="D2">D2</option>
                          <option value="D3">D3</option>
                          <option value="D4/S1">D4/S1</option>
                          <option value="S2">S2</option>
                          <option value="S3">S3</option>
                          <option value="Tidak Berpendidikan Formal">Tidak Berpendidikan Formal</option>
                        </select>
                        <script>
                          document.forms["ubah_biodata"]["pdd_ayah"].value = "<?php echo $user->pdd_ayah ?>"
                        </script>
                      </td>
                    </tr>
                    <tr>
                      <th>Pekerjaan</th>
                      <th>:</th>
                      <td>
                        <select class="form-control" name="pekerjaan_ayah" disabled>
                          <option value="Tidak Bekerja">Tidak Bekerja</option>
                          <option value="Pensiunan">Pensiunan</option>
                          <option value="PNS Selain (Guru dan Dokter/Bidan/Perawat)">PNS Selain (Guru dan Dokter/Bidan/Perawat)</option>
                          <option value="PNS">PNS</option>
                          <option value="TNI/POLRI">TNI/POLRI</option>
                          <option value="Pegawai Swasta">Pegawai Swasta</option>
                          <option value="Wiraswasta">Wiraswasta</option>
                          <option value="Pengacara/Hakim/Jaksa/Notaris ">Pengacara/Hakim/Jaksa/Notaris </option>
                          <option value="Seniman/Pelukis/Artis/Sejenis">Seniman/Pelukis/Artis/Sejenis</option>
                          <option value="Dokter/Bidan/Perawat">Dokter/Bidan/Perawat</option>
                          <option value="Pilot/Pramugara">Pilot/Pramugara</option>
                          <option value="Pedagang">Pedagang</option>
                          <option value="Petani/Peternak">Petani/Peternak</option>
                          <option value="Nelayan">Nelayan</option>
                          <option value="Buruh (Tani/Pabrik/Bangunan)">Buruh (Tani/Pabrik/Bangunan)</option>
                          <option value="Sopir/Masinis/Kondektur">Sopir/Masinis/Kondektur</option>
                          <option value="Politikus">Politikus</option>
                          <option value="Lainnya">Lainnya</option>
                        </select>
                        <script>
                          document.forms["ubah_biodata"]["pekerjaan_ayah"].value = "<?php echo $user->pekerjaan_ayah ?>"
                        </script>
                      </td>
                    </tr>
                    <tr>
                      <th>Penghasilan</th>
                      <th>:</th>
                      <td>
                        <select class="form-control" name="penghasilan_ayah" disabled>
                          <option value="">Pilih Penghasilan Ayah</option>
                          <option value="< 500rb">&lt; 500rb</option>
                          <option value="500-1jt">500-1jt</option>
                          <option value="1jt-2jt">1jt-2jt</option>
                          <option value="2jt-3jt">2jt-3jt</option>
                          <option value="3jt-5t">3jt-5t</option>
                          <option value=">5jt">&gt;5jt</option>
                        </select>
                        <script>
                          document.forms["ubah_biodata"]["penghasilan_ayah"].value = "<?php echo $user->penghasilan_ayah ?>"
                        </script>
                      </td>
                    </tr>
                  </table>
                </div>
              </fieldset>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="panel panel-flat">
            <div class="panel-body">
              <fieldset class="content-group">
                <legend class="text-bold"><i class="icon-user"></i> Data Ibu</legend>
                <div class="table-responsive">
                  <table class="table table-bordered table-striped">
                    <tr>
                      <th width="20%">Nama Lengkap</th>
                      <th width="1%">:</th>
                      <td>
                        <input type="text" name="nama_ibu" class="form-control" value="<?php echo ucwords($user->nama_ibu); ?>" disabled>
                      </td>
                    </tr>
                    <tr>
                      <th width="20%">NIK Ibu</th>
                      <th width="1%">:</th>
                      <th>
                        <input type="text" name="nik_ibu" class="form-control" value="<?php echo ucwords($user->nik_ibu); ?>" disabled>
                      </th>
                    </tr>
                    <tr>
                      <th>Pendidikan</th>
                      <th>:</th>
                      <th>
                        <select class="form-control" name="pdd_ibu" disabled>
                          <option value="">Pilih Pendidikan ibu</option>
                          <option value="SD/Sederajat">SD/Sederajat</option>
                          <option value="SMP/Sederajat">SMP/Sederajat</option>
                          <option value="SMA/Sederajat">SMA/Sederajat</option>
                          <option value="D1">D1</option>
                          <option value="D2">D2</option>
                          <option value="D3">D3</option>
                          <option value="D4/S1">D4/S1</option>
                          <option value="S2">S2</option>
                          <option value="S3">S3</option>
                          <option value="Tidak Berpendidikan Formal">Tidak Berpendidikan Formal</option>
                        </select>
                        <script>
                          document.forms["ubah_biodata"]["pdd_ibu"].value = "<?php echo $user->pdd_ibu ?>"
                        </script>
                      </th>
                    </tr>
                    <tr>
                      <th>Pekerjaan</th>
                      <th>:</th>
                      <th>
                        <select class="form-control" name="pekerjaan_ibu" disabled>
                          <option value="Tidak Bekerja">Tidak Bekerja</option>
                          <option value="Pensiunan">Pensiunan</option>
                          <option value="PNS Selain (Guru dan Dokter/Bidan/Perawat)">PNS Selain (Guru dan Dokter/Bidan/Perawat)</option>
                          <option value="PNS">PNS</option>
                          <option value="TNI/POLRI">TNI/POLRI</option>
                          <option value="Pegawai Swasta">Pegawai Swasta</option>
                          <option value="Wiraswasta">Wiraswasta</option>
                          <option value="Pengacara/Hakim/Jaksa/Notaris ">Pengacara/Hakim/Jaksa/Notaris </option>
                          <option value="Seniman/Pelukis/Artis/Sejenis">Seniman/Pelukis/Artis/Sejenis</option>
                          <option value="Dokter/Bidan/Perawat">Dokter/Bidan/Perawat</option>
                          <option value="Pilot/Pramugara">Pilot/Pramugara</option>
                          <option value="Pedagang">Pedagang</option>
                          <option value="Petani/Peternak">Petani/Peternak</option>
                          <option value="Nelayan">Nelayan</option>
                          <option value="Buruh (Tani/Pabrik/Bangunan)">Buruh (Tani/Pabrik/Bangunan)</option>
                          <option value="Sopir/Masinis/Kondektur">Sopir/Masinis/Kondektur</option>
                          <option value="Politikus">Politikus</option>
                          <option value="Lainnya">Lainnya</option>
                        </select>
                        <script>
                          document.forms["ubah_biodata"]["pekerjaan_ibu"].value = "<?php echo $user->pekerjaan_ibu ?>"
                        </script>
                      </th>
                    </tr>
                    <tr>
                      <th>Penghasilan</th>
                      <th>:</th>
                      <th>
                        <select class="form-control" name="penghasilan_ibu" disabled>
                          <option value="">Pilih Penghasilan ibu</option>
                          <option value="< 500rb">&lt; 500rb</option>
                          <option value="500-1jt">500-1jt</option>
                          <option value="1jt-2jt">1jt-2jt</option>
                          <option value="2jt-3jt">2jt-3jt</option>
                          <option value="3jt-5t">3jt-5t</option>
                          <option value=">5jt">&gt;5jt</option>
                        </select>
                        <script>
                          document.forms["ubah_biodata"]["penghasilan_ibu"].value = "<?php echo $user->penghasilan_ibu ?>"
                        </script>
                      </th>
                    </tr>
                  </table>
                </div>
              </fieldset>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="panel panel-flat">
            <div class="panel-body">
              <fieldset class="content-group">
                <legend class="text-bold"><i class="icon-user"></i> Data wali</legend>
                <div class="table-responsive">
                  <table class="table table-bordered table-striped">
                    <tr>
                      <th width="20%">Nama Lengkap</th>
                      <th width="1%">:</th>
                      <td>
                        <input type="text" name="nama_wali" class="form-control" value="<?php echo ucwords($user->nama_wali); ?>" disabled>
                      </td>
                    </tr>
                    <tr>
                      <th width="20%">NIK wali</th>
                      <th width="1%">:</th>
                      <td>
                        <input type="text" name="nik_wali" class="form-control" value="<?php echo ucwords($user->nik_wali); ?>" disabled>
                      </td>
                    </tr>
                    <tr>
                      <th>Pendidikan</th>
                      <th>:</th>
                      <td>
                        <select class="form-control" name="pdd_wali" disabled>
                          <option value="">Pilih Pendidikan wali</option>
                          <option value="SD/Sederajat">SD/Sederajat</option>
                          <option value="SMP/Sederajat">SMP/Sederajat</option>
                          <option value="SMA/Sederajat">SMA/Sederajat</option>
                          <option value="D1">D1</option>
                          <option value="D2">D2</option>
                          <option value="D3">D3</option>
                          <option value="D4/S1">D4/S1</option>
                          <option value="S2">S2</option>
                          <option value="S3">S3</option>
                          <option value="Tidak Berpendidikan Formal">Tidak Berpendidikan Formal</option>
                        </select>
                        <script>
                          document.forms["ubah_biodata"]["pdd_wali"].value = "<?php echo $user->pdd_wali ?>"
                        </script>
                      </td>
                    </tr>
                    <tr>
                      <th>Pekerjaan</th>
                      <th>:</th>
                      <td>
                        <select class="form-control" name="pekerjaan_wali" disabled>
                          <option value="Tidak Bekerja">Tidak Bekerja</option>
                          <option value="Pensiunan">Pensiunan</option>
                          <option value="PNS Selain (Guru dan Dokter/Bidan/Perawat)">PNS Selain (Guru dan Dokter/Bidan/Perawat)</option>
                          <option value="PNS">PNS</option>
                          <option value="TNI/POLRI">TNI/POLRI</option>
                          <option value="Pegawai Swasta">Pegawai Swasta</option>
                          <option value="Wiraswasta">Wiraswasta</option>
                          <option value="Pengacara/Hakim/Jaksa/Notaris ">Pengacara/Hakim/Jaksa/Notaris </option>
                          <option value="Seniman/Pelukis/Artis/Sejenis">Seniman/Pelukis/Artis/Sejenis</option>
                          <option value="Dokter/Bidan/Perawat">Dokter/Bidan/Perawat</option>
                          <option value="Pilot/Pramugara">Pilot/Pramugara</option>
                          <option value="Pedagang">Pedagang</option>
                          <option value="Petani/Peternak">Petani/Peternak</option>
                          <option value="Nelayan">Nelayan</option>
                          <option value="Buruh (Tani/Pabrik/Bangunan)">Buruh (Tani/Pabrik/Bangunan)</option>
                          <option value="Sopir/Masinis/Kondektur">Sopir/Masinis/Kondektur</option>
                          <option value="Politikus">Politikus</option>
                          <option value="Lainnya">Lainnya</option>
                        </select>
                        <script>
                          document.forms["ubah_biodata"]["pekerjaan_wali"].value = "<?php echo $user->pekerjaan_wali ?>"
                        </script>
                      </td>
                    </tr>
                    <tr>
                      <th>Penghasilan</th>
                      <th>:</th>
                      <td>
                        <select class="form-control" name="penghasilan_wali" disabled>
                          <option value="">Pilih Penghasilan wali</option>
                          <option value="< 500rb">&lt; 500rb</option>
                          <option value="500-1jt">500-1jt</option>
                          <option value="1jt-2jt">1jt-2jt</option>
                          <option value="2jt-3jt">2jt-3jt</option>
                          <option value="3jt-5t">3jt-5t</option>
                          <option value=">5jt">&gt;5jt</option>
                        </select>
                        <script>
                          document.forms["ubah_biodata"]["penghasilan_wali"].value = "<?php echo $user->penghasilan_wali ?>"
                        </script>
                      </td>
                    </tr>
                  </table>
                </div>
              </fieldset>
            </div>
          </div>
        </div>


        <div class="col-md-6">
          <div class="panel panel-flat">
            <div class="panel-body">
              <fieldset class="content-group">
                <legend class="text-bold"><i class="icon-library2"></i> Data Sekolah</legend>
                <div class="table-responsive">
                  <table class="table table-bordered table-striped">
                    <tr>
                      <th width="30%">Nama Sekolah</th>
                      <th width="1%">:</th>
                      <td>
                        <input type="text" name="nama_sekolah" class="form-control" value="<?php echo $user->nama_sekolah; ?>" disabled>
                      </td>
                    </tr>
                    <tr>
                      <th width="30%">NPSN Sekolah</th>
                      <th width="1%">:</th>
                      <td>
                        <input type="text" name="npsn_sekolah" class="form-control" value="<?php echo $user->npsn_sekolah; ?>" disabled>
                      </td>
                    </tr>
                    <tr>
                      <th>Status Sekolah</th>
                      <th>:</th>
                      <td>
                        <select class="form-control" name="status_sekolah" disabled>
                          <option value="NEGERI">NEGERI</option>
                          <option value="SWASTA">SWASTA</option>
                        </select>
                        <script>
                          document.forms["ubah_biodata"]["status_sekolah"].value = "<?php echo $user->status_sekolah ?>"
                        </script>
                      </td>
                    </tr>
                  </table>
                </div>
              </fieldset>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="panel panel-flat">
            <div class="panel-body">
              <fieldset class="content-group">
                <legend class="text-bold"><i class="icon-profile"></i> Informasi Kepemilikan Kartu</legend>
                <div class="table-responsive">
                  <table class="table table-bordered table-striped">
                    <tr>
                      <th width="30%">No. KKS</th>
                      <th width="1%">:</th>
                      <td>
                        <input type="text" name="no_kks" class="form-control" value="<?php echo $user->no_kks; ?>" disabled>
                      </td>
                    </tr>
                    <tr>
                      <th width="30%">No. PKH</th>
                      <th width="1%">:</th>
                      <td>
                        <input type="text" name="no_pkh" class="form-control" value="<?php echo $user->no_pkh; ?>" disabled>
                      </td>
                    </tr>
                    <tr>
                      <th width="30%">No. KIP</th>
                      <th width="1%">:</th>
                      <td>
                        <input type="text" name="no_kip" class="form-control" value="<?php echo $user->no_kip; ?>" disabled>
                      </td>
                    </tr>
                  </table>
                </div>
              </fieldset>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="panel panel-flat">
            <div class="panel-body">
              <fieldset class="content-group">
                <legend class="text-bold"><i class="icon-file-text"></i> Dokumen</legend>
                <div class="table-responsive">
                  <table class="table table-bordered table-striped">
                    <tr>
                      <th width="30%">Kartu Keluarga <span class="text-danger">*</span></th>
                      <th width="1%">:</th>
                      <td>
                        <input type="file" name="dokumen_kk" class="form-control" accept="application/pdf, image/*" disabled>
                      </td>
                    </tr>
                    <tr>
                      <th width="30%">Akte Kelahiran <span class="text-danger">*</span></th>
                      <th width="1%">:</th>
                      <td>
                        <input type="file" name="dokumen_akte_kelahiran" accept="application/pdf, image/*" class="form-control" disabled>
                      </td>
                    </tr>
                    <tr>
                      <th width="30%">SKL <span class="text-danger">*</span></th>
                      <th width="1%">:</th>
                      <td>
                        <input type="file" name="dokumen_skl" accept="application/pdf, image/*" class="form-control" disabled>
                      </td>
                    </tr>
                    <tr>
                      <th width="30%">Kartu Bantuan</th>
                      <th width="1%">:</th>
                      <td>
                        <input type="file" name="dokumen_kartu_bantuan" accept="application/pdf, image/*" class="form-control" disabled>
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

      const form = document.forms["ubah_biodata"]

      function toggle() {
        btnUbah.classList.toggle("d-none")
        btnBatal.classList.toggle("d-none")
        btnSimpan.classList.toggle("d-none")

        const list = ["nisn", "nik", "nama_lengkap", "jk", "tempat_lahir", "tgl_lahir", "agama", "status_keluarga", "kab", "kec", "desa", "alamat_siswa", "kode_pos", "no_hp_siswa", "nama_ayah", "nik_ayah", "pdd_ayah", "pekerjaan_ayah", "penghasilan_ayah", "nama_ibu", "nik_ibu", "pdd_ibu", "pekerjaan_ibu", "penghasilan_ibu", "nama_wali", "nik_wali", "pdd_wali", "pekerjaan_wali", "penghasilan_wali", "nama_sekolah", "npsn_sekolah", "status_sekolah", "no_kks", "no_pkh", "no_kip", "dokumen_kk", "dokumen_akte_kelahiran", "dokumen_skl", "dokumen_kartu_bantuan"]
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