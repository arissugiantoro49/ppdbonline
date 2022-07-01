<?php
$nama_sekolah = $this->db->get('tbl_user')->row_array()["nama_lengkap"];

?>
<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <base href="<?php echo base_url(); ?>" />
    <title>Ujian <?= $ujian["nama"] ?> | PPDB MTs Umar Zahid Semelo</title>
    <link rel="icon" type="image/png" href="img/logo.png">
    <link href="assets/panel/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
    <link href="assets/panel/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="assets/panel/css/core.css" rel="stylesheet" type="text/css">
    <link href="assets/panel/css/components.css" rel="stylesheet" type="text/css">
    <link href="assets/panel/css/colors.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="assets/panel/js/plugins/loaders/pace.min.js"></script>
    <script type="text/javascript" src="assets/panel/js/core/libraries/jquery.min.js"></script>
    <script type="text/javascript" src="assets/panel/js/core/libraries/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/panel/js/plugins/loaders/blockui.min.js"></script>
    <script type="text/javascript" src="assets/panel/js/sweetalert2.all.min.js"></script>
</head>

<body class="navbar-bottom ">
    <div class="navbar navbar-inverse">
        <div class="navbar-header">
            <a class="navbar-brand" href="panel_siswa/">PPDB <label class="label label-success">MTs Umar Zahid Semelo</label> </a>
        </div>

        <div class="navbar-collapse collapse" id="navbar-mobile">
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown dropdown-user">
                    <a class="dropdown-toggle" data-toggle="dropdown">
                        <img src="img/logo.png" alt="foto">
                        <span><?= $user->nama_lengkap ?></span>
                        <i class="caret"></i>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-right">
                        <li><a href="panel_siswa"><i class="icon-home4"></i>Dashboard</a></li>
                        <li class="divider"></li>
                        <li><a href="panel_siswa/logout"><i class="icon-switch2"></i> Keluar</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>

    <div class="content" style="padding: 2em">
        <div class="container">

            <?php if ($ujian["status"] == "progress") { ?>
                <div class="row">
                    <div class="col-md-9" style="padding-left: 1.5em">
                        <h4><?= $ujian["nama"] ?></h4>
                    </div>
                    <div class="col-md-3" style="padding-left: 1em">
                        <ol class="breadcrumb" style="position: relative; top: 1em">
                            <li><a href="panel_siswa"><i class="icon-home2"></i> Panel</a></li>
                            <li><a href="panel_siswa/ujian"><i class="icon-pencil4"></i> Ujian</a></li>
                            <li class="active"><?= $ujian["nama"] ?></li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-9">
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h5 class="panel-title">Soal Nomor <span id="label_nomor_soal"></span></h5>
                                <hr style="margin:0px;">
                            </div>
                            <div class="panel-body">
                                <form>
                                    <p id="soal"></p>
                                    <div style="padding-left:1em">
                                        <input type="radio" id="opsi_a" name="jawaban" onclick="simpanJawaban()" value="A">
                                        <label for="opsi_a" id="label_opsi_a"></label><br>
                                        <input type="radio" id="opsi_b" name="jawaban" onclick="simpanJawaban()" value="B">
                                        <label for="opsi_b" id="label_opsi_b"></label><br>
                                        <input type="radio" id="opsi_c" name="jawaban" onclick="simpanJawaban()" value="C">
                                        <label for="opsi_c" id="label_opsi_c"></label><br>
                                        <input type="radio" id="opsi_d" name="jawaban" onclick="simpanJawaban()" value="D">
                                        <label for="opsi_d" id="label_opsi_d"></label><br>
                                        <input type="radio" id="opsi_e" name="jawaban" onclick="simpanJawaban()" value="E">
                                        <label for="opsi_e" id="label_opsi_e"></label>
                                    </div>
                                </form>
                            </div>
                            <div class="panel-footer" style="padding-left:1em; padding-right:1em;">
                                <button class="btn btn-primary" id="btnSoalSebelumnya" onclick="soalSebelumnya()">SEBELUMNYA</button>
                                <button class="btn btn-primary" style="float: right" id="btnSoalSelanjutnya" onclick="soalSelanjutnya()">SELANJUTNYA</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h5 class="panel-title">Sisa Waktu</h5>
                                <hr style="margin:0px;">
                            </div>
                            <div class="panel-body">
                                <div style="display:flex; justify-content: center; font-size: 2em;">
                                    <span><strong id="countdown">-</strong></span>
                                </div>
                            </div>
                            <div class="panel-footer" style="display: flex; justify-content:center;">
                                <button class="btn btn-danger" onclick="akhiriUjian()">SELESAI UJIAN</button>
                            </div>
                        </div>
                    </div>
                </div>

            <?php } else { ?>

                <div class="row">
                    <div class="col-md-12">
                        <h4 style="display: inline-block"><?= $ujian["nama"] ?></h4>
                        <ol class="breadcrumb" style="float:right; position: relative; top: 1em">
                            <li><a href="panel_siswa"><i class="icon-home2"></i> Panel</a></li>
                            <li><a href="panel_siswa/ujian"><i class="icon-pencil4"></i> Ujian</a></li>
                            <li class="active"><?= $ujian["nama"] ?></li>
                        </ol>
                    </div>
                    <div class="col-md-12">
                        <div class="panel panel-flat">
                            <div class="panel-body">
                                <div class="div" style="display: flex; flex-direction: column; justify-content: center; align-items: center">
                                    <img src="img/task-check.png" width="200px">
                                    <h1>Ujian telah selesai!</h1>
                                    <p>Anda telah menyelesaikan ujian <?= $ujian["nama"] ?> dengan nilai <strong><?= $ujian["nilai"] ?></strong></p>
                                </div>
                            </div>
                            <div class="panel-footer" style="padding-left:1em; padding-right:1em;">
                                <a href="panel_siswa/ujian" class="btn btn-primary" style="float: right"> <i class="icon-enter" style="transform: scaleX(-1);"></i> Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <div class="navbar navbar-default navbar-fixed-bottom footer" style="background-color:#275555ff;">
        <ul class="nav navbar-nav visible-xs-block">
            <li><a class="text-center collapsed" data-toggle="collapse" data-target="#footer"><i class="icon-circle-up2"></i></a></li>
        </ul>
        <div class="navbar-collapse collapse" id="footer">
            <div class="navbar-text" style="color: ivory; width: 100%">
                <span id="time"></span>
                <span style="float: right">
                    <label class="label label-danger" style="margin-bottom: -10px;"><?= $nama_sekolah ?></label>
                    <span>Copyright &copy; <?php echo date('Y'); ?></span>
                </span>
            </div>
        </div>
    </div>

    <script>
        <?php if ($ujian["status"] == "progress") { ?>
            let countDownDate = new Date("<?= $ujian["waktu_selesai"] ?>").getTime();
            let daftarSoal = <?= $ujian["daftar_soal"] ?>;

            var x = setInterval(function() {
                var now = new Date().getTime();

                var distance = countDownDate - now;

                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                hours = String(hours).padStart(2, '0');
                minutes = String(minutes).padStart(2, '0');
                seconds = String(seconds).padStart(2, '0');

                document.getElementById("countdown").innerHTML = hours + ":" + minutes + ":" + seconds;

                if (distance < 0) {
                    clearInterval(x);
                    document.getElementById("countdown").innerHTML = "00:00:00";
                    Swal.fire({
                        title: 'Waktu telah habis',
                        icon: 'info',
                        focusConfirm: false,
                        confirmButtonText: 'Oke',
                    }).then((result) => {
                        location.reload()
                    })
                }
            }, 1000);

            let indexSoal = 0;

            function soalSelanjutnya() {
                if (indexSoal < daftarSoal.length - 1) {
                    indexSoal++;
                    refreshSoal();
                }
            }

            function soalSebelumnya() {
                if (indexSoal != 0) {
                    indexSoal--;
                    refreshSoal();
                }
            }

            function simpanJawaban() {
                const idSoal = daftarSoal[indexSoal].id_soal;
                const jawaban = document.forms[0]["jawaban"].value;
                fetch(`panel_siswa/simpan_jawaban_soal/<?= $ujian["id_ujian"] ?>?id_soal=${idSoal}&jawaban=${jawaban}`).then(response => response.json()).then(result => {});
            }

            function refreshSoal() {
                const idSoal = daftarSoal[indexSoal].id_soal;
                fetch(`panel_siswa/get_jawaban_soal/<?= $ujian["id_ujian"] ?>?id_soal=${idSoal}`).then(response => response.json()).then(result => {
                    document.getElementById("label_nomor_soal").textContent = indexSoal + 1;
                    document.getElementById("soal").innerHTML = daftarSoal[indexSoal].soal;
                    document.getElementById("label_opsi_a").textContent = daftarSoal[indexSoal].opsi_a;
                    document.getElementById("label_opsi_b").textContent = daftarSoal[indexSoal].opsi_b;
                    document.getElementById("label_opsi_c").textContent = daftarSoal[indexSoal].opsi_c;
                    document.getElementById("label_opsi_d").textContent = daftarSoal[indexSoal].opsi_d;
                    document.getElementById("label_opsi_e").textContent = daftarSoal[indexSoal].opsi_e;

                    for (let i = 0; i < 5; i++) {
                        document.forms[0]["jawaban"][i].checked = false;
                    }

                    if (result.jawaban != null) {
                        document.forms[0]["jawaban"].value = result.jawaban;
                    }

                    document.getElementById("btnSoalSebelumnya").style.display = "block";
                    document.getElementById("btnSoalSelanjutnya").style.display = "block";

                    if (indexSoal == 0) {
                        document.getElementById("btnSoalSebelumnya").style.display = "none";
                    }
                    if (indexSoal == daftarSoal.length - 1) {
                        document.getElementById("btnSoalSelanjutnya").style.display = "none";
                    }
                });
            }

            refreshSoal();


        <?php } ?>

        function akhiriUjian() {
            Swal.fire({
                title: 'Anda yakin akan mengakhiri ujian ini?',
                icon: 'question',
                focusConfirm: false,
                confirmButtonText: 'Oke',
                showCancelButton: true,
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch("panel_siswa/akhiri_ujian/<?= $ujian["id_ujian"] ?>").then(response => response.text()).then(result => location.reload());
                }
            })
        }

        function startTime() {
            let date = new Date().toString();
            document.getElementById('time').innerHTML = date.slice(0, date.indexOf("GMT"));
            setTimeout(startTime, 1000);
        }
        startTime();
    </script>
</body>

</html>