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
                <th>Nama Lengkap</th>
                <th>NISN</th>
                <th>Tanggal Lahir</th>
                <th>Kelas</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              $tabel_yi = $this->admin->get_tabel_yi($v_thn);
              foreach ($v_siswa->result() as $baris) { 
                if ($baris->status_pendaftaran == 'lulus') {  
                ?>
                <tr>
                  <td><?php echo $no++; ?></td>
                  <td><?php echo $baris->nama_lengkap; ?></td>
                  <td><?php echo $baris->nisn; ?></td>
                  <td><?php echo $baris->tgl_lahir; ?></td>
                  <td><?php 
                  $rank = $tabel_yi[$baris->id_siswa]['rank'];
                  if ($rank <= 15) echo 'A';
                  elseif ($rank <= 30) echo 'B';
                  elseif ($rank <= 45) echo 'C';
                  ?></td>
                </tr>
              <?php
              }} ?>
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