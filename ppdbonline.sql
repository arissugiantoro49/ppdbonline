-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 12, 2022 at 03:01 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ppdbonline`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_daftar_soal_ujian`
--

CREATE TABLE `tbl_daftar_soal_ujian` (
  `id_daftar_soal_ujian` int(11) NOT NULL,
  `id_ujian` int(11) NOT NULL,
  `id_soal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_daftar_soal_ujian`
--

INSERT INTO `tbl_daftar_soal_ujian` (`id_daftar_soal_ujian`, `id_ujian`, `id_soal`) VALUES
(1, 1, 1),
(8, 1, 2),
(9, 2, 3),
(10, 2, 2),
(11, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_dokumen`
--

CREATE TABLE `tbl_dokumen` (
  `id_dokumen` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `no_pendaftaran` int(11) NOT NULL,
  `nama_berkas` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ikut_ujian`
--

CREATE TABLE `tbl_ikut_ujian` (
  `id_ikut_ujian` int(11) NOT NULL,
  `id_ujian` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `waktu_mulai` datetime NOT NULL,
  `waktu_selesai` datetime NOT NULL,
  `nilai` int(11) DEFAULT NULL,
  `status` enum('progress','completed') NOT NULL DEFAULT 'progress'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_ikut_ujian`
--

INSERT INTO `tbl_ikut_ujian` (`id_ikut_ujian`, `id_ujian`, `id_siswa`, `waktu_mulai`, `waktu_selesai`, `nilai`, `status`) VALUES
(22, 1, 19, '2022-07-03 15:08:16', '2022-07-03 15:08:24', 100, 'completed');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jawaban_ujian_siswa`
--

CREATE TABLE `tbl_jawaban_ujian_siswa` (
  `id_jawaban_ujian_siswa` int(11) NOT NULL,
  `id_ikut_ujian` int(11) NOT NULL,
  `id_soal` int(11) NOT NULL,
  `jawaban` enum('A','B','C','D','E') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_jawaban_ujian_siswa`
--

INSERT INTO `tbl_jawaban_ujian_siswa` (`id_jawaban_ujian_siswa`, `id_ikut_ujian`, `id_soal`, `jawaban`) VALUES
(9, 17, 1, 'A'),
(10, 17, 2, 'B'),
(11, 17, 3, 'A'),
(12, 18, 1, 'D'),
(13, 18, 2, 'E'),
(15, 18, 3, 'D'),
(16, 19, 1, 'A'),
(17, 19, 2, 'B'),
(18, 19, 3, 'B'),
(19, 22, 1, 'A'),
(20, 22, 2, 'B'),
(21, 22, 3, 'C');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kriteria`
--

CREATE TABLE `tbl_kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `nama_kriteria` varchar(100) NOT NULL,
  `tipe` varchar(100) NOT NULL,
  `bobot` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_kriteria`
--

INSERT INTO `tbl_kriteria` (`id_kriteria`, `nama_kriteria`, `tipe`, `bobot`) VALUES
(1, 'Nilai Raport', '1', 10),
(2, 'Nilai USBN', '1', 10),
(3, 'Nilai UAS', '1', 10),
(4, 'Nilai Prestasi', '0', 10),
(5, 'Nilai Ujian Seleksi', '0', 20);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_nilai`
--

CREATE TABLE `tbl_nilai` (
  `id_nilai` int(20) NOT NULL,
  `no_pendaftaran` varchar(20) NOT NULL,
  `rata_rata_raport` int(11) NOT NULL,
  `rata_rata_usbn` int(11) NOT NULL,
  `rata_rata_uas` int(11) NOT NULL,
  `matematika_raport` int(20) NOT NULL,
  `ipa_raport` int(20) NOT NULL,
  `pai_raport` int(20) NOT NULL,
  `bahasa_indonesia_raport` int(20) NOT NULL,
  `dok_raport` varchar(100) NOT NULL,
  `matematika_usbn` int(20) NOT NULL,
  `ipa_usbn` int(20) NOT NULL,
  `bindo_usbn` int(20) NOT NULL,
  `pai_usbn` int(20) NOT NULL,
  `dok_usbn` varchar(100) NOT NULL,
  `matematika_uas` int(33) NOT NULL,
  `ipa_uas` int(33) NOT NULL,
  `bindo_uas` int(33) NOT NULL,
  `pai_uas` int(33) NOT NULL,
  `dok_uas` varchar(100) NOT NULL,
  `nilai_prestasi` int(50) NOT NULL,
  `dok_prestasi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_nilai`
--

INSERT INTO `tbl_nilai` (`id_nilai`, `no_pendaftaran`, `rata_rata_raport`, `rata_rata_usbn`, `rata_rata_uas`, `matematika_raport`, `ipa_raport`, `pai_raport`, `bahasa_indonesia_raport`, `dok_raport`, `matematika_usbn`, `ipa_usbn`, `bindo_usbn`, `pai_usbn`, `dok_usbn`, `matematika_uas`, `ipa_uas`, `bindo_uas`, `pai_uas`, `dok_uas`, `nilai_prestasi`, `dok_prestasi`) VALUES
(1, '2022-019', 30, 70, 54, 90, 95, 90, 86, '_dok_raport.png', 60, 80, 90, 50, '_dok_usbn.jpeg', 40, 90, 70, 90, '_dok_uas.jpeg', 77, '_dok_prestasi.png'),
(2, '2022-020', 12, 55, 66, 88, 79, 78, 76, '2022-020_dok_raport.jpeg', 80, 87, 76, 87, '2022-020_dok_usbn.jpeg', 90, 77, 90, 85, '2022-020_dok_uas.pdf', 78, '2022-020_dok_prestasi.pdf'),
(3, '2022-021', 65, 66, 66, 0, 0, 0, 0, '2022-021_dok_raport.pdf', 0, 0, 0, 0, '2022-021_dok_usbn.pdf', 0, 0, 0, 0, '2022-021_dok_uas.pdf', 66, '2022-021_dok_prestasi.pdf'),
(4, '2022-022', 66, 65, 66, 0, 0, 0, 0, '2022-022_dok_raport.pdf', 0, 0, 0, 0, '2022-022_dok_usbn.pdf', 0, 0, 0, 0, '2022-022_dok_uas.pdf', 66, '2022-022_dok_prestasi.pdf'),
(5, '2022-023', 88, 88, 88, 0, 0, 0, 0, '2022-023_dok_raport.pdf', 0, 0, 0, 0, '2022-023_dok_usbn.pdf', 0, 0, 0, 0, '2022-023_dok_uas.pdf', 44, '2022-023_dok_prestasi.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pdd`
--

CREATE TABLE `tbl_pdd` (
  `id_pdd` int(11) NOT NULL,
  `nama_pdd` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pdd`
--

INSERT INTO `tbl_pdd` (`id_pdd`, `nama_pdd`) VALUES
(1, 'SD/Sederajat'),
(2, 'SMP/Sederajat'),
(3, 'SMA/Sederajat'),
(4, 'D1'),
(5, 'D2'),
(6, 'D3'),
(7, 'D4/S1'),
(8, 'S2'),
(9, 'S3'),
(10, 'Tidak Berpendidikan Formal');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pekerjaan`
--

CREATE TABLE `tbl_pekerjaan` (
  `id_pekerjaan` int(11) NOT NULL,
  `nama_pekerjaan` varchar(100) DEFAULT NULL,
  `ket_pekerjaan` varchar(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pekerjaan`
--

INSERT INTO `tbl_pekerjaan` (`id_pekerjaan`, `nama_pekerjaan`, `ket_pekerjaan`) VALUES
(1, 'Tidak Bekerja', 'ayah'),
(2, 'Pensiunan', 'ayah'),
(3, 'PNS Selain (Guru dan Dokter/Bidan/Perawat)', 'ayah'),
(4, 'PNS', 'ayah'),
(5, 'TNI/POLRI', 'ayah'),
(6, 'Pegawai Swasta', 'ayah'),
(7, 'Wiraswasta', 'ayah'),
(8, 'Pengacara/Hakim/Jaksa/Notaris ', 'ayah'),
(9, 'Seniman/Pelukis/Artis/Sejenis\r\n', 'ayah'),
(10, 'Dokter/Bidan/Perawat', 'ayah'),
(11, 'Pilot/Pramugara', 'ayah'),
(12, 'Pedagang', 'ayah'),
(13, 'Petani/Peternak', 'ayah'),
(14, 'Nelayan', 'ayah'),
(15, 'Buruh (Tani/Pabrik/Bangunan)', 'ayah'),
(16, 'Sopir/Masinis/Kondektur', 'ayah'),
(17, 'Politikus', 'ayah'),
(18, 'Lainnya', 'ayah');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_penghasilan`
--

CREATE TABLE `tbl_penghasilan` (
  `id_penghasilan` int(10) NOT NULL,
  `nama_penghasilan` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_penghasilan`
--

INSERT INTO `tbl_penghasilan` (`id_penghasilan`, `nama_penghasilan`) VALUES
(1, '< 500rb'),
(2, '500-1jt'),
(3, '1jt-2jt'),
(4, '2jt-3jt'),
(5, '3jt-5t'),
(6, '>5jt');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pengumuman`
--

CREATE TABLE `tbl_pengumuman` (
  `id_pengumuman` int(10) NOT NULL,
  `ket_pengumuman` text,
  `tgl_pengumuman` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pengumuman`
--

INSERT INTO `tbl_pengumuman` (`id_pengumuman`, `ket_pengumuman`, `tgl_pengumuman`) VALUES
(1, '<html>\r\n<head>\r\n	<title></title>\r\n</head>\r\n<body class=\"vsc-initialized\">\r\n<p><strong>*<em>catatan : </em></strong><br />\r\n<span style=\"font-size:11pt\"><span style=\"line-height:normal\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:10.0pt\">&nbsp; &nbsp; &nbsp; &nbsp;<strong> 1.&nbsp;Registrasi daftar ulang dilaksanakan pada tanggal 8 &ndash; 11 Juli 2022&nbsp;pukul 08.00 &ndash; 14.00.</strong></span></span></span></span><br />\r\n<strong><span style=\"font-size:11pt\"><span style=\"line-height:normal\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:10.0pt\">&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;2. Mencetak dan membawa Surat Pengumuman ini sebagai bukti&nbsp; lulus seleksi.</span></span></span></span><br />\r\n<span style=\"font-size:11pt\"><span style=\"line-height:normal\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:10.0pt\">&nbsp; &nbsp; &nbsp; &nbsp; 3.&nbsp;Harap Menghubungi Panitia PPDB -- Pak Aris ( 085648259815&nbsp;) untuk menerima Hasil Verifikasi data</span></span></span></span></strong></p>\r\n</body>\r\n</html>\r\n', '2021-04-14 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_siswa`
--

CREATE TABLE `tbl_siswa` (
  `id_siswa` int(100) NOT NULL,
  `no_pendaftaran` varchar(20) NOT NULL,
  `password` text,
  `nis` varchar(10) DEFAULT NULL,
  `nisn` varchar(10) DEFAULT NULL,
  `nik` text,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `jk` varchar(12) DEFAULT NULL,
  `tempat_lahir` text,
  `tgl_lahir` varchar(10) DEFAULT NULL,
  `agama` varchar(30) DEFAULT NULL,
  `status_keluarga` varchar(30) DEFAULT NULL,
  `anak_ke` varchar(100) DEFAULT NULL,
  `jml_saudara` varchar(100) DEFAULT NULL,
  `hobi` varchar(100) DEFAULT NULL,
  `cita` varchar(100) DEFAULT NULL,
  `paud` varchar(100) DEFAULT NULL,
  `tk` varchar(100) DEFAULT NULL,
  `alamat_siswa` text,
  `jenis_tinggal` varchar(100) DEFAULT NULL,
  `desa` varchar(100) DEFAULT NULL,
  `kec` varchar(100) DEFAULT NULL,
  `kab` varchar(100) DEFAULT NULL,
  `prov` varchar(100) DEFAULT NULL,
  `kode_pos` varchar(100) DEFAULT NULL,
  `jarak` varchar(100) DEFAULT NULL,
  `trans` varchar(100) DEFAULT NULL,
  `no_hp_siswa` varchar(14) DEFAULT NULL,
  `no_kk` varchar(20) DEFAULT NULL,
  `kepala_keluarga` varchar(100) DEFAULT NULL,
  `nama_ayah` varchar(100) DEFAULT NULL,
  `nik_ayah` varchar(20) DEFAULT NULL,
  `status_ayah` varchar(100) DEFAULT NULL,
  `th_lahir_ayah` varchar(10) DEFAULT NULL,
  `pdd_ayah` varchar(100) DEFAULT NULL,
  `pekerjaan_ayah` varchar(100) DEFAULT NULL,
  `penghasilan_ayah` varchar(100) DEFAULT NULL,
  `nama_ibu` varchar(100) DEFAULT NULL,
  `nik_ibu` varchar(20) DEFAULT NULL,
  `status_ibu` varchar(100) DEFAULT NULL,
  `th_lahir_ibu` varchar(10) DEFAULT NULL,
  `pdd_ibu` varchar(100) DEFAULT NULL,
  `pekerjaan_ibu` varchar(100) DEFAULT NULL,
  `penghasilan_ibu` varchar(100) DEFAULT NULL,
  `nama_wali` varchar(100) DEFAULT NULL,
  `nik_wali` varchar(20) DEFAULT NULL,
  `th_lahir_wali` varchar(100) DEFAULT NULL,
  `pdd_wali` varchar(100) DEFAULT NULL,
  `pekerjaan_wali` varchar(100) DEFAULT NULL,
  `penghasilan_wali` varchar(100) DEFAULT NULL,
  `no_hp_ortu` varchar(14) DEFAULT NULL,
  `npsn_sekolah` varchar(100) DEFAULT NULL,
  `nama_sekolah` varchar(100) DEFAULT NULL,
  `status_sekolah` varchar(100) DEFAULT NULL,
  `jenjang_sekolah` varchar(100) DEFAULT NULL,
  `lokasi_sekolah` varchar(100) DEFAULT NULL,
  `no_kks` varchar(100) DEFAULT NULL,
  `no_pkh` varchar(100) DEFAULT NULL,
  `no_kip` varchar(100) DEFAULT NULL,
  `komp_ahli` varchar(100) DEFAULT NULL,
  `tgl_siswa` datetime DEFAULT NULL,
  `status_verifikasi` varchar(30) DEFAULT NULL,
  `status_pendaftaran` varchar(20) DEFAULT NULL,
  `dokumen_kk` varchar(100) NOT NULL,
  `dokumen_akte_kelahiran` varchar(100) NOT NULL,
  `dokumen_skl` varchar(100) NOT NULL,
  `dokumen_kartu_bantuan` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_siswa`
--

INSERT INTO `tbl_siswa` (`id_siswa`, `no_pendaftaran`, `password`, `nis`, `nisn`, `nik`, `nama_lengkap`, `jk`, `tempat_lahir`, `tgl_lahir`, `agama`, `status_keluarga`, `anak_ke`, `jml_saudara`, `hobi`, `cita`, `paud`, `tk`, `alamat_siswa`, `jenis_tinggal`, `desa`, `kec`, `kab`, `prov`, `kode_pos`, `jarak`, `trans`, `no_hp_siswa`, `no_kk`, `kepala_keluarga`, `nama_ayah`, `nik_ayah`, `status_ayah`, `th_lahir_ayah`, `pdd_ayah`, `pekerjaan_ayah`, `penghasilan_ayah`, `nama_ibu`, `nik_ibu`, `status_ibu`, `th_lahir_ibu`, `pdd_ibu`, `pekerjaan_ibu`, `penghasilan_ibu`, `nama_wali`, `nik_wali`, `th_lahir_wali`, `pdd_wali`, `pekerjaan_wali`, `penghasilan_wali`, `no_hp_ortu`, `npsn_sekolah`, `nama_sekolah`, `status_sekolah`, `jenjang_sekolah`, `lokasi_sekolah`, `no_kks`, `no_pkh`, `no_kip`, `komp_ahli`, `tgl_siswa`, `status_verifikasi`, `status_pendaftaran`, `dokumen_kk`, `dokumen_akte_kelahiran`, `dokumen_skl`, `dokumen_kartu_bantuan`) VALUES
(19, '2022-019', '0058538548', NULL, '0058538548', '3517186408060001', 'Aris Sugiantoro', 'Laki-Laki', 'Banyuwangi', '2010-09-01', 'Kristen', 'Anak Kandung', '2', '1', '2', '1', '1', '1', 'BARONGSAWAHAN', '1', 'klaci', 'Bandarkedungmulyo', 'JOMBANG', NULL, '61462', '1', '4', '085648259815', '3517010111070148', 'Samsul Mu\'In Thohar', 'Mukalil', '3516012203840003', '1', '1984', 'SMP/Sederajat', 'Pensiunan', '< 500rb', 'Yessy Wicahya Ningdyah', '3517011206100006', '2', '1900', 'SMP/Sederajat', 'Tidak Bekerja', '< 500rb', 'Mukalil', '3516012203840003', '1984', 'SD/Sederajat', NULL, '500-1jt', '085648259815', '000000', 'MIN 3 Jombang', 'NEGERI', '21', '1', '2', '-', '-', NULL, '2022-03-19 06:17:53', '1', 'lulus', '2022-019_kk.pdf', '2022-019_akte_kelahiran.pdf', '2022-019_skl.pdf', '2022-019_kartu_bantuan.pdf'),
(20, '2022-020', '123', NULL, '3050489000', '3517184804060003', 'ENDAH NUR AHMADA', 'Laki-Laki', 'Kediri', '01-01-2009', 'Islam', 'Anak Kandung', '2', '2', '3', '1', '1', '1', 'PAGERWOJO', '1', 'Perak', 'Bandarkedungmulyo', 'JOMBANG', 'Jawa Timur', '61461', '2', '2', '085648259815', '3517011206100006', 'Khoirul Anam', 'Khoirul Anam', '3517180104700005', '1', '1984', 'SD/Sederajat', 'Tidak Bekerja', '< 500rb', 'Mutoharoh', '3517011206100006', '1', '1992', 'SD/Sederajat', 'Tidak Bekerja', '< 500rb', 'Khoirul Anam', '3517180104700005', '1984', 'SD/Sederajat', NULL, '< 500rb', '', '60717531', 'MI Umar Zahid Semelo', 'SWASTA', '21', '1', '-', '-', '-', NULL, '2022-03-09 21:22:31', '1', 'lulus', '2022-020_kk.pdf', '2022-020_akte_kelahiran.pdf', '2022-020_skl.pdf', '2022-020_kartu_bantuan.pdf'),
(21, '2022-021', '2', NULL, '2', '345345', 'ARIL SETIYOBUDI', 'Laki-Laki', '1', '01-01-1990', 'Islam', 'Anak Kandung', '1', '1', '1', '1', '1', '1', 'Dusun Pojok RT 04 RW 02, Desa Sugihwaras', '1', '2', '2', 'Jombang', '2', '67153', '1', '4', '081333026995', '67', '4', '1', '2323232323232323', '1', '6', 'SD/Sederajat', 'Tidak Bekerja', '< 500rb', '1', '2323232323232323', '1', '1', 'SD/Sederajat', 'Pensiunan', '< 500rb', '1', '2323232323232323', '6', 'SD/Sederajat', NULL, '< 500rb', '081333026995', '7', 'MIN 3 Jombang23', 'SWASTA', '21', '1', '1', '1', '-', NULL, '2022-07-03 06:21:06', NULL, 'lulus', '2022-021_kk.pdf', '2022-021_akte_kelahiran.pdf', '2022-021_skl.pdf', '2022-021_kartu_bantuan.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_soal`
--

CREATE TABLE `tbl_soal` (
  `id_soal` int(11) NOT NULL,
  `kode` text NOT NULL,
  `soal` text NOT NULL,
  `media` varchar(100) NOT NULL,
  `opsi_a` text NOT NULL,
  `opsi_b` text NOT NULL,
  `opsi_c` text NOT NULL,
  `opsi_d` text NOT NULL,
  `opsi_e` text NOT NULL,
  `jawaban` enum('A','B','C','D','E') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_soal`
--

INSERT INTO `tbl_soal` (`id_soal`, `kode`, `soal`, `media`, `opsi_a`, `opsi_b`, `opsi_c`, `opsi_d`, `opsi_e`, `jawaban`) VALUES
(1, 'SL1', '<p>Apa kepanjangan SQL?</p>\r\n', '', 'Structured Query Language', 'Susu Qental Lumer', 'SiQiL', 'SaQinah L', 'Dahlah...', 'A'),
(2, 'SL2', '<p>Siapa pembuat bahasa pemrograman java?</p>\r\n', '', 'Bapakmu', 'James Gosling', 'Mbahmu', 'Doi', 'Eyang Sugiono', 'B'),
(3, 'SL3', '<p>Nullsafe operator diperkenalkan di php versi?</p>\r\n', '', '5.4', '7.0', '8.0', '7.2', '5.1', 'C');

--
-- Triggers `tbl_soal`
--
DELIMITER $$
CREATE TRIGGER `before_tbl_soal_insert` BEFORE INSERT ON `tbl_soal` FOR EACH ROW BEGIN
DECLARE num integer;
SET @num := (SELECT MAX(id_soal) FROM tbl_soal);

IF @num IS NULL THEN
  SET NEW.id_soal = 1;
  SET NEW.kode = CONCAT('SL', 1);
ELSE
  SET NEW.id_soal = @num + 1;
  SET NEW.kode = CONCAT('SL', @num + 1);
END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subkriteria`
--

CREATE TABLE `tbl_subkriteria` (
  `id_subkriteria` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_subkriteria`
--

INSERT INTO `tbl_subkriteria` (`id_subkriteria`, `id_kriteria`, `nama`) VALUES
(1, 1, 'Matematika'),
(2, 1, 'IPA'),
(3, 1, 'Bahasa Indonesia'),
(4, 1, 'PAI'),
(5, 2, 'Matematika'),
(6, 2, 'IPA'),
(7, 2, 'Bahasa Indonesia'),
(8, 2, 'PAI'),
(9, 3, 'Matematika'),
(10, 3, 'IPA'),
(11, 3, 'Bahasa Indonesia'),
(12, 3, 'PAI'),
(13, 4, 'Prestasi');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ujian`
--

CREATE TABLE `tbl_ujian` (
  `id_ujian` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `durasi` int(11) NOT NULL,
  `waktu` datetime NOT NULL,
  `tenggat_waktu` datetime NOT NULL,
  `tahun` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_ujian`
--

INSERT INTO `tbl_ujian` (`id_ujian`, `nama`, `durasi`, `waktu`, `tenggat_waktu`, `tahun`, `status`) VALUES
(1, 'Test 1', 30, '2022-07-13 00:00:00', '2022-07-13 01:00:00', 2022, 0),
(2, 'Test 2', 30, '2022-07-13 00:00:00', '2022-07-13 01:00:00', 2022, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` text,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `website` varchar(100) DEFAULT NULL,
  `telp` varchar(100) DEFAULT NULL,
  `kab_sekolah` varchar(100) DEFAULT NULL,
  `ketua_panitia` varchar(100) DEFAULT NULL,
  `nip_ketua` varchar(100) DEFAULT NULL,
  `th_pelajaran` varchar(100) DEFAULT NULL,
  `no_surat` varchar(100) DEFAULT NULL,
  `kepsek` varchar(100) DEFAULT NULL,
  `nip_kepsek` varchar(100) DEFAULT NULL,
  `level` varchar(10) DEFAULT NULL,
  `tgl_daftar` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `username`, `password`, `nama_lengkap`, `alamat`, `email`, `website`, `telp`, `kab_sekolah`, `ketua_panitia`, `nip_ketua`, `th_pelajaran`, `no_surat`, `kepsek`, `nip_kepsek`, `level`, `tgl_daftar`) VALUES
(1, 'admin', 'admin', 'MTs Umar Zahid Semelo Jombang', 'Jln Masjid Jami\' Semelo, Dsn Semelo, Desa Kayen', 'madsauza@gmail.com', 'http://mtsumarzahid.mysch.id/', '085648259815', 'Jombang', 'Syamsuddin, S,Pd.I', '-', '2022-2023', 'MTs. 003/13.17/PP.00/001/2022', 'Muhammad Tholud,S.Pd.I', '-', 'admin', '2018-04-12 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_verifikasi`
--

CREATE TABLE `tbl_verifikasi` (
  `id_verifikasi` int(10) NOT NULL,
  `isi` text,
  `ket` text,
  `tgl_verifikasi` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_verifikasi`
--

INSERT INTO `tbl_verifikasi` (`id_verifikasi`, `isi`, `ket`, `tgl_verifikasi`) VALUES
(1, '<html>\r\n<head>\r\n	<title></title>\r\n</head>\r\n<body class=\"vsc-initialized\">\r\n<p style=\"margin-left:0in; margin-right:0in\"><u><strong><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\">Materi Tes Potensi Akademik</span></span></span></strong></u></p>\r\n\r\n<ol>\r\n	<li><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\">Bahasa Indonesia&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : 10 Soal</span></span></span></li>\r\n	<li><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\">Matematika&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : 10 Soal</span></span></span></li>\r\n	<li><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\">IPA&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : 10 Soal</span></span></span></li>\r\n	<li><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\">PAI&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : 20 Soal</span></span></span></li>\r\n</ol>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong><u>Hari Tanggal tes : </u></strong></span></span><br />\r\n<span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\">&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;tanggal 17 Oktober 2021</span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong><u>Waktu Tes potensi Akademik :</u></strong></span></span><br />\r\n<span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\">&nbsp; &nbsp; &nbsp; &nbsp; Sesi 1&nbsp; : 07.00 - 09.00</span></span><br />\r\n<span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\">&nbsp; &nbsp; &nbsp; &nbsp; Sesi 2&nbsp; : 09.30 - 11.30</span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><strong><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\">*<em>catatan : </em></span></span></strong><br />\r\n<strong><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><em>jadwal ujian bisa berubah sewaktu - waktu&nbsp; Update infomasi di web PPDB </em></span></span><em><span style=\"font-size:11.0pt\">peserta ujian datang 15&nbsp; menit sebelum&nbsp;tes dimulai.</span></em></strong></p>\r\n</body>\r\n</html>\r\n', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_web`
--

CREATE TABLE `tbl_web` (
  `id_web` int(10) NOT NULL,
  `status_ppdb` varchar(30) DEFAULT NULL,
  `tgl_diubah` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_web`
--

INSERT INTO `tbl_web` (`id_web`, `status_ppdb`, `tgl_diubah`) VALUES
(1, 'buka', '2022-02-01 10:29:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_daftar_soal_ujian`
--
ALTER TABLE `tbl_daftar_soal_ujian`
  ADD PRIMARY KEY (`id_daftar_soal_ujian`);

--
-- Indexes for table `tbl_dokumen`
--
ALTER TABLE `tbl_dokumen`
  ADD PRIMARY KEY (`id_dokumen`);

--
-- Indexes for table `tbl_ikut_ujian`
--
ALTER TABLE `tbl_ikut_ujian`
  ADD PRIMARY KEY (`id_ikut_ujian`);

--
-- Indexes for table `tbl_jawaban_ujian_siswa`
--
ALTER TABLE `tbl_jawaban_ujian_siswa`
  ADD PRIMARY KEY (`id_jawaban_ujian_siswa`);

--
-- Indexes for table `tbl_kriteria`
--
ALTER TABLE `tbl_kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `tbl_nilai`
--
ALTER TABLE `tbl_nilai`
  ADD PRIMARY KEY (`id_nilai`);

--
-- Indexes for table `tbl_pdd`
--
ALTER TABLE `tbl_pdd`
  ADD PRIMARY KEY (`id_pdd`);

--
-- Indexes for table `tbl_pekerjaan`
--
ALTER TABLE `tbl_pekerjaan`
  ADD PRIMARY KEY (`id_pekerjaan`);

--
-- Indexes for table `tbl_penghasilan`
--
ALTER TABLE `tbl_penghasilan`
  ADD PRIMARY KEY (`id_penghasilan`);

--
-- Indexes for table `tbl_pengumuman`
--
ALTER TABLE `tbl_pengumuman`
  ADD PRIMARY KEY (`id_pengumuman`);

--
-- Indexes for table `tbl_siswa`
--
ALTER TABLE `tbl_siswa`
  ADD PRIMARY KEY (`id_siswa`) USING BTREE;

--
-- Indexes for table `tbl_soal`
--
ALTER TABLE `tbl_soal`
  ADD PRIMARY KEY (`id_soal`);
ALTER TABLE `tbl_soal` ADD FULLTEXT KEY `kode` (`kode`,`soal`,`opsi_a`,`opsi_b`,`opsi_c`,`opsi_d`,`opsi_e`);

--
-- Indexes for table `tbl_subkriteria`
--
ALTER TABLE `tbl_subkriteria`
  ADD PRIMARY KEY (`id_subkriteria`) USING BTREE,
  ADD KEY `id_kriteria` (`id_kriteria`);

--
-- Indexes for table `tbl_ujian`
--
ALTER TABLE `tbl_ujian`
  ADD PRIMARY KEY (`id_ujian`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `tbl_verifikasi`
--
ALTER TABLE `tbl_verifikasi`
  ADD PRIMARY KEY (`id_verifikasi`);

--
-- Indexes for table `tbl_web`
--
ALTER TABLE `tbl_web`
  ADD PRIMARY KEY (`id_web`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_daftar_soal_ujian`
--
ALTER TABLE `tbl_daftar_soal_ujian`
  MODIFY `id_daftar_soal_ujian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_dokumen`
--
ALTER TABLE `tbl_dokumen`
  MODIFY `id_dokumen` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_ikut_ujian`
--
ALTER TABLE `tbl_ikut_ujian`
  MODIFY `id_ikut_ujian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tbl_jawaban_ujian_siswa`
--
ALTER TABLE `tbl_jawaban_ujian_siswa`
  MODIFY `id_jawaban_ujian_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tbl_kriteria`
--
ALTER TABLE `tbl_kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_nilai`
--
ALTER TABLE `tbl_nilai`
  MODIFY `id_nilai` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_pdd`
--
ALTER TABLE `tbl_pdd`
  MODIFY `id_pdd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_pekerjaan`
--
ALTER TABLE `tbl_pekerjaan`
  MODIFY `id_pekerjaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_penghasilan`
--
ALTER TABLE `tbl_penghasilan`
  MODIFY `id_penghasilan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_pengumuman`
--
ALTER TABLE `tbl_pengumuman`
  MODIFY `id_pengumuman` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_siswa`
--
ALTER TABLE `tbl_siswa`
  MODIFY `id_siswa` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tbl_soal`
--
ALTER TABLE `tbl_soal`
  MODIFY `id_soal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_subkriteria`
--
ALTER TABLE `tbl_subkriteria`
  MODIFY `id_subkriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_ujian`
--
ALTER TABLE `tbl_ujian`
  MODIFY `id_ujian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_verifikasi`
--
ALTER TABLE `tbl_verifikasi`
  MODIFY `id_verifikasi` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_web`
--
ALTER TABLE `tbl_web`
  MODIFY `id_web` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_subkriteria`
--
ALTER TABLE `tbl_subkriteria`
  ADD CONSTRAINT `tbl_subkriteria_ibfk_1` FOREIGN KEY (`id_kriteria`) REFERENCES `tbl_kriteria` (`id_kriteria`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
