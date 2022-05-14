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
        <div class="panel-heading" style="padding-bottom:10px;">
          <h5 class="panel-title"><b>Menentukan Nilai Alternatif</b></h5>
          <hr style="margin:0px;">
          <div class="heading-elements">
            <ul class="icons-list">
              <li><a data-action="collapse"></a></li>
            </ul>
          </div>
          <div class="col-md-3"  id="selectTahun" style="position: absolute; top: 0;left: 20em;"> 
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
        <div class="table-responsive" style="border-top:0;">
          <table class="table datatable-basic table-sm table-striped" id="tabelAlternatif" width="100%">
            <thead>
              <tr>
                <th width="30px;">No.</th>
                <th>Nama Alternatif</th>
                <th>C1</th>
                <th>C2</th>
                <th>C3</th>
                <th>C4</th>
                <th>C5</th>
              </tr>
            </thead>
            <tbody>
              <?php
              if ($total_siswa > 0) {
                $no = 1;
                foreach ($alternatif as $key => $value) { ?>
                  <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $value['nama']; ?></td>
                    <td><?= $value['c1']; ?></td>
                    <td><?= $value['c2']; ?></td>
                    <td><?= $value['c3']; ?></td>
                    <td><?= $value['c4']; ?></td>
                    <td><?= $value['c5']; ?></td>
                  </tr>
                <?php
                }
              } 
              ?>
            </tbody>
          </table>
        </div>
      </div>
      <!-- /basic datatable -->
    </div>
    
    <?php if ($total_siswa > 0) { ?>

    <div class="row">
      <!-- Basic datatable -->
      <div class="panel panel-flat">
        <div class="panel-heading" style="padding-bottom:10px;">
          <h5 class="panel-title"><b>Melakukan SQRT</b></h5>
          <hr style="margin:0px;">
          <div class="heading-elements">
            <ul class="icons-list">
              <li><a data-action="collapse"></a></li>
            </ul>
          </div>
        </div>
        <div class="table-responsive" style="border-top:0;">
          <table class="table datatable-basic table-sm table-striped" id="tabelSqrt" width="100%">
            <thead>
              <tr>
                <th width="30px;">No.</th>
                <th>Kode Kriteria</th>
                <th>Nilai SQRT</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              foreach ($sqrt as $key => $value) { ?>
                <tr>
                  <td><?= $no++; ?></td>
                  <td><?= strtoupper($key); ?></td>
                  <td><?= $value; ?></td>
                </tr>
              <?php
              } ?>
            </tbody>
          </table>
        </div>
      </div>
      <!-- /basic datatable -->
    </div>

    <div class="row">
      <!-- Basic datatable -->
      <div class="panel panel-flat">
        <div class="panel-heading" style="padding-bottom:10px;">
          <h5 class="panel-title"><b>Melakukan Normalisasi Matriks</b></h5>
          <hr style="margin:0px;">
          <div class="heading-elements">
            <ul class="icons-list">
              <li><a data-action="collapse"></a></li>
            </ul>
          </div>
        </div>
        <div class="table-responsive" style="border-top:0;">
          <table class="table datatable-basic table-sm table-striped" id="tabelNormalisasi" width="100%">
            <thead>
              <tr>
                <th width="30px;">No.</th>
                <th>Kode Alternatif</th>
                <th>C1</th>
                <th>C2</th>
                <th>C3</th>
                <th>C4</th>
                <th>C5</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              foreach ($normalisasi as $key => $value) { ?>
                <tr>
                  <td><?= $no++; ?></td>
                  <td>A<?= $key; ?></td>
                  <td><?= $value['c1']; ?></td>
                  <td><?= $value['c2']; ?></td>
                  <td><?= $value['c3']; ?></td>
                  <td><?= $value['c4']; ?></td>
                  <td><?= $value['c5']; ?></td>
                </tr>
              <?php
              } ?>
            </tbody>
          </table>
        </div>
      </div>
      <!-- /basic datatable -->
    </div>

    <div class="row">
      <!-- Basic datatable -->
      <div class="panel panel-flat">
        <div class="panel-heading" style="padding-bottom:10px;">
          <h5 class="panel-title"><b>Menghitung Nilai Matriks Ternormalisasi</b></h5>
          <hr style="margin:0px;">
          <div class="heading-elements">
            <ul class="icons-list">
              <li><a data-action="collapse"></a></li>
            </ul>
          </div>
        </div>
        <div class="table-responsive" style="border-top:0;">
          <table class="table datatable-basic table-sm table-striped" id="tabelTernormalisasi" width="100%">
            <thead>
              <tr>
                <th width="30px;">No.</th>
                <th>Kode Alternatif</th>
                <th>C1</th>
                <th>C2</th>
                <th>C3</th>
                <th>C4</th>
                <th>C5</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              foreach ($ternormalisasi as $key => $value) { ?>
                <tr>
                  <td><?= $no++; ?></td>
                  <td>A<?= $key; ?></td>
                  <td><?= $value['c1']; ?></td>
                  <td><?= $value['c2']; ?></td>
                  <td><?= $value['c3']; ?></td>
                  <td><?= $value['c4']; ?></td>
                  <td><?= $value['c5']; ?></td>
                </tr>
              <?php
              } ?>
            </tbody>
          </table>
        </div>
      </div>
      <!-- /basic datatable -->
    </div>

    <div class="row">
      <!-- Basic datatable -->
      <div class="panel panel-flat">
        <div class="panel-heading" style="padding-bottom:10px;">
          <h5 class="panel-title"><b>Melakukan Nilai Optimasi Setiap Alternatif</b></h5>
          <hr style="margin:0px;">
          <div class="heading-elements">
            <ul class="icons-list">
              <li><a data-action="collapse"></a></li>
            </ul>
          </div>
        </div>
        <div class="table-responsive" style="border-top:0;">
          <table class="table datatable-basic table-sm table-striped" id="tabelOptimasi" width="100%">
            <thead>
              <tr>
                <th width="30px;">No.</th>
                <th>Kode Alternatif</th>
                <th>Nilai Maximum</th>
                <th>Nilai Minimum</th>
                <th>Nilai Yi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              foreach ($optimasi as $key => $value) { ?>
                <tr>
                  <td><?= $no++; ?></td>
                  <td>A<?= $key; ?></td>
                  <td><?= $value['max']; ?></td>
                  <td><?= $value['min']; ?></td>
                  <td><?= $value['yi']; ?></td>
                </tr>
              <?php
              } ?>
            </tbody>
          </table>
        </div>
      </div>
      <!-- /basic datatable -->
    </div>

    <div class="row">
      <!-- Basic datatable -->
      <div class="panel panel-flat">
        <div class="panel-heading" style="padding-bottom:10px;">
          <h5 class="panel-title"><b>Menentukan Ranking Setiap Alternatif</b></h5>
          <hr style="margin:0px;">
          <div class="heading-elements">
            <ul class="icons-list">
              <li><a data-action="collapse"></a></li>
            </ul>
          </div>
        </div>
        <div class="table-responsive" style="border-top:0;">
          <table class="table datatable-basic table-sm table-striped" id="tabelSqrt" width="100%">
            <thead>
              <tr>
                <th width="30px;">No.</th>
                <th>Kode Alternatif</th>
                <th>Nilai Optimasi</th>
                <th>Ranking</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              foreach ($rank as $key => $value) { ?>
                <tr>
                  <td><?= $no++; ?></td>
                  <td>A<?= $key; ?></td>
                  <td><?= $value['optimasi']; ?></td>
                  <td><?= $value['rank']; ?></td>
                </tr>
              <?php
              } ?>
            </tbody>
          </table>
        </div>
      </div>
      <!-- /basic datatable -->
    </div>

    <?php } ?>

    <!-- /dashboard content -->

    <script>
      function thn() {
        var thn = $('[name="thn"]').val();
        window.location = "panel_admin/data_perhitungan/thn/" + thn;
      }

      $('[name="thn"]').select2({
        placeholder: "- Tahun -",
        minimumResultsForSearch: -1
      });

      $("document").ready(function () {
        $("#tabelAlternatif_filter.dataTables_filter").append($("#selectTahun"));
      });

    </script>