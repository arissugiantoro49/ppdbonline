-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 01, 2021 at 06:21 AM
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
-- Table structure for table `tbl_komp`
--

CREATE TABLE `tbl_komp` (
  `id_komp` int(11) NOT NULL,
  `kompetensi` varchar(100) CHARACTER SET latin1 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_komp`
--

INSERT INTO `tbl_komp` (`id_komp`, `kompetensi`) VALUES
(1, 'IPA'),
(2, 'IPS');

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
(1, '<html>\r\n<head>\r\n	<title></title>\r\n</head>\r\n<body>\r\n<p><strong>*<em>catatan : </em></strong><br />\r\n<span style=\"font-size:11pt\"><span style=\"line-height:normal\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:10.0pt\">&nbsp; &nbsp; &nbsp; &nbsp; 1.&nbsp;Registrasi daftar ulang dilaksanakan pada tanggal 8 &ndash; 11 Juli 2021&nbsp;pukul 08.00 &ndash; 14.00.</span></span></span></span><br />\r\n<span style=\"font-size:11pt\"><span style=\"line-height:normal\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:10.0pt\">&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;2. Mencetak dan membawa Surat Pengumuman ini sebagai bukti&nbsp; lulus seleksi.</span></span></span></span><br />\r\n<span style=\"font-size:11pt\"><span style=\"line-height:normal\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:10.0pt\">&nbsp; &nbsp; &nbsp; &nbsp; 3.&nbsp;Harap Menghubungi Panitia PPDB -- Pak Aris ( 085648259815&nbsp;) untuk menerima Hasil Verifikasi data</span></span></span></span></p>\r\n</body>\r\n</html>\r\n', '2021-04-14 00:00:00');

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
  `matematika` int(11) DEFAULT NULL,
  `ipa` int(11) DEFAULT NULL,
  `bahasa_indonesia` int(11) DEFAULT NULL,
  `pai` int(11) DEFAULT NULL,
  `dokumen_kk` varchar(100) NOT NULL,
  `dokumen_akte_kelahiran` varchar(100) NOT NULL,
  `dokumen_skl` varchar(100) NOT NULL,
  `dokumen_kartu_bantuan` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_siswa`
--

INSERT INTO `tbl_siswa` (`id_siswa`, `no_pendaftaran`, `password`, `nis`, `nisn`, `nik`, `nama_lengkap`, `jk`, `tempat_lahir`, `tgl_lahir`, `agama`, `status_keluarga`, `anak_ke`, `jml_saudara`, `hobi`, `cita`, `paud`, `tk`, `alamat_siswa`, `jenis_tinggal`, `desa`, `kec`, `kab`, `prov`, `kode_pos`, `jarak`, `trans`, `no_hp_siswa`, `no_kk`, `kepala_keluarga`, `nama_ayah`, `nik_ayah`, `status_ayah`, `th_lahir_ayah`, `pdd_ayah`, `pekerjaan_ayah`, `penghasilan_ayah`, `nama_ibu`, `nik_ibu`, `status_ibu`, `th_lahir_ibu`, `pdd_ibu`, `pekerjaan_ibu`, `penghasilan_ibu`, `nama_wali`, `nik_wali`, `th_lahir_wali`, `pdd_wali`, `pekerjaan_wali`, `penghasilan_wali`, `no_hp_ortu`, `npsn_sekolah`, `nama_sekolah`, `status_sekolah`, `jenjang_sekolah`, `lokasi_sekolah`, `no_kks`, `no_pkh`, `no_kip`, `komp_ahli`, `tgl_siswa`, `status_verifikasi`, `status_pendaftaran`, `matematika`, `ipa`, `bahasa_indonesia`, `pai`, `dokumen_kk`, `dokumen_akte_kelahiran`, `dokumen_skl`, `dokumen_kartu_bantuan`) VALUES
(27, '2021-011', '2', '1', '1', '1', '1', '1', '1', '01-01-2010', 'Islam', 'Anak Kandung', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1990', 'SD/Sederajat', 'Tidak Bekerja', '< 500rb', '1', '1', '1', '1990', 'SD/Sederajat', 'Pensiunan', '< 500rb', '1', '1', '1990', 'SMA/Sederajat', 'Tidak Bekerja', '< 500rb', '1', '1', '1', 'NEGERI', '21', '1', '1', '1', '1', '1', '2021-10-01 05:26:52', '1', '1', 1, 1, 1, 1, '2021-011_kk.jpg', '2021-011_akte_kelahiran.pdf', '2021-011_skl.jpg', '2021-011_kartu_bantuan.png'),
(15, '2021-007', '3050489000', NULL, '3050489000', '3517184804060003', 'Siti Citra Aulia Aprina', 'Perempuan', 'JOMBANG', '02-02-1990', 'Islam', 'Anak Kandung', '1', '1', '1', '1', '1', '1', 'BRODOT', '1', 'klaci', 'perak', 'JOMBANG', 'jatim', '61462', '1', '1', '085648259815', '3517011206100006', 'jon', 'ss', '3517011206100006', '1', '1099', 'SD/Sederajat', 'Tidak Bekerja', '500-1jt', 'ibu', '3517011206100006', '1', '1900', 'SD/Sederajat', 'Pensiunan', '< 500rb', 'NOER YATIM WIBOWO', '3517182004770003', '1289', 'SD/Sederajat', 'Tidak Bekerja', '< 500rb', '09999', '000000', 'MI Umar Zahid Semelo', 'NEGERI', '21', '1', '-', '-', '-', NULL, '2021-06-24 06:37:40', '1', NULL, 34, 77, 77, 87, '', '', '', NULL),
(16, '2021-008', '0081048344', NULL, '0081048344', '3517016605200003', 'ENDAH NUR AHMADA', 'Laki-Laki', 'JOMBANG', '08-11-2010', 'Islam', 'Anak Kandung', '1', '1', '1', '1', '1', '1', 'PAGERWOJO', '1', 'Perak', 'Perak', 'JOMBANG', 'Jawa Timur', '61462', '2', '1', '085648259815', '3517012408200002', 'Khoirul Anam', 'Khoirul Anam', '3516012203840003', '1', '1984', 'SD/Sederajat', 'Buruh (Tani/Pabrik/Bangunan)', '< 500rb', 'Yessy Wicahya Ningdyah', '3517015608920002', '1', '1992', 'SD/Sederajat', 'Tidak Bekerja', '< 500rb', 'Khoirul Anam', '3516012203840003', '1984', 'SD/Sederajat', 'Tidak Bekerja', '< 500rb', '085648259815', '', 'MIS SAYID ABDURROHMAN II', 'SWASTA', '21', '1', '-', '-', '-', NULL, '2021-07-12 03:52:25', '1', 'lulus', 89, 98, 86, 86, '', '', '', NULL),
(18, '2021-010', '0053931646', NULL, '0053931646', '3517014205050003', 'PUTRI WARDATUZZAHRO\'', 'Perempuan', 'JOMBANG', '01-02-2007', 'Islam', 'Anak Kandung', '1', '2', '2', '3', '1', '1', 'Semelo', '1', 'Kayen', 'Bandarkedungmulyo', 'Jombang', 'Jawa Timur', '61462', '1', '2', '085648259815', '3517011206100006', 'Khoirul Anam', 'Khoirul Anam', '3516012203840003', '1', '1984', 'SMA/Sederajat', 'PNS Selain (Guru dan Dokter/Bidan/Perawat)', '< 500rb', 'Mutoharoh', '3517185308730001', '1', '1992', 'SMA/Sederajat', 'Tidak Bekerja', '< 500rb', 'Khoirul Anam', '3516012203840003', '1984', 'SMA/Sederajat', 'PNS Selain (Guru dan Dokter/Bidan/Perawat)', '< 500rb', '085648259815', '60717331', 'MI Umar Zahid Semelo', 'SWASTA', '21', '1', '-', '-', '-', NULL, '2021-08-26 23:59:56', '0', 'lulus', 67, 88, 89, 76, '', '', '', NULL);

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
(1, 'admin', 'admin', 'MTs Umar Zahid Semelo', 'Jln Masjid Jami\' Semelo, Dsn Semelo, Desa Kayen', 'madsauza@gmail.com-', 'http://mtsumarzahid.mysch.id/', '085648259815', 'Jombang', 'Syamsuddin, S,Pd.I', '-', '2021-2022', 'MTs. 003/13.17/PP.00/035/2021', 'MOHAMMAD THOLUTH, S.Pd.I', '-', 'admin', '2018-04-12 00:00:00');

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
(1, '<html>\n<head>\n	<title></title>\n</head>\n<body>\n<p style=\"margin-left:0in; margin-right:0in\"><u><strong><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\">Materi Tes Potensi Akademik</span></span></span></strong></u></p>\n\n<ol>\n	<li><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\">Bahasa Indonesia&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : 10 Soal</span></span></span></li>\n	<li><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\">Matematika&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : 10 Soal</span></span></span></li>\n	<li><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\">IPA&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : 10 Soal</span></span></span></li>\n	<li><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\">PAI&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : 20 Soal</span></span></span></li>\n</ol>\n\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong><u>Hari Tanggal tes : </u></strong></span></span><br />\n<span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\">&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;tanggal 10&nbsp;Juli 2021</span></span></p>\n\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong><u>Waktu Tes potensi Akademik :</u></strong></span></span><br />\n<span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\">&nbsp; &nbsp; &nbsp; &nbsp; Sesi 1&nbsp; : 07.00 - 09.00</span></span><br />\n<span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\">&nbsp; &nbsp; &nbsp; &nbsp; Sesi 2&nbsp; : 09.30 - 11.30</span></span></p>\n\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><strong><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\">*<em>catatan : </em></span></span></strong><br />\n<strong><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><em>jadwal ujian bisa berubah sewaktu - waktu&nbsp; Update infomasi di web PPDB </em></span></span><em><span style=\"font-size:11.0pt\">peserta ujian datang 15&nbsp; menit sebelum&nbsp;tes dimulai.</span></em></strong></p>\n</body>\n</html>\n', NULL, NULL);

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
(1, 'buka', '2021-08-27 10:53:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_komp`
--
ALTER TABLE `tbl_komp`
  ADD PRIMARY KEY (`id_komp`);

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
-- AUTO_INCREMENT for table `tbl_komp`
--
ALTER TABLE `tbl_komp`
  MODIFY `id_komp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `id_siswa` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
