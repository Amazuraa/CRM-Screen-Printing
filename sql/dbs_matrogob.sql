-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 18, 2021 at 08:49 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dbs_matrogob`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bahan`
--

CREATE TABLE IF NOT EXISTS `tbl_bahan` (
`id_bahan` tinyint(4) NOT NULL,
  `nama_bahan` char(80) NOT NULL,
  `detail_bahan` text NOT NULL,
  `status_bahan` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_bahan`
--

INSERT INTO `tbl_bahan` (`id_bahan`, `nama_bahan`, `detail_bahan`, `status_bahan`) VALUES
(1, 'Daftar Bahan Kaos', '[\r\n {\r\n  "nama":"Cardet / CVC 24s",\r\n  "ukuran":"[\\"S\\",\\"M\\",\\"L\\",\\"XL\\",\\"XXL\\",\\"XXXL\\"]",\r\n  "harga":"[\\"28000\\",\\"28001\\",\\"28002\\",\\"28003\\",\\"28004\\",\\"28005\\"]"\r\n },\r\n {\r\n  "nama":"Combed 30s",\r\n  "ukuran":"[\\"S\\",\\"M\\",\\"L\\",\\"XL\\",\\"XXL\\",\\"XXXL\\"]",\r\n  "harga":"[\\"30000\\",\\"30000\\",\\"30000\\",\\"30000\\",\\"30000\\",\\"30000\\"]"\r\n },\r\n {\r\n  "nama":"Combed 24s",\r\n  "ukuran":"[\\"S\\",\\"M\\",\\"L\\",\\"XL\\",\\"XXL\\",\\"XXXL\\"]",\r\n  "harga":"[\\"32500\\",\\"32500\\",\\"32500\\",\\"32500\\",\\"32500\\",\\"32500\\"]"\r\n },\r\n {\r\n  "nama":"Combed 20s",\r\n  "ukuran":"[\\"S\\",\\"M\\",\\"L\\",\\"XL\\",\\"XXL\\",\\"XXXL\\"]",\r\n  "harga":"[\\"35000\\",\\"35000\\",\\"35000\\",\\"35000\\",\\"35000\\",\\"35000\\"]"\r\n },\r\n {\r\n  "nama":"Cardet / CVC 24s Panjang",\r\n  "ukuran":"[\\"S\\",\\"M\\",\\"L\\",\\"XL\\",\\"XXL\\",\\"XXXL\\"]",\r\n  "harga":"[\\"32000\\",\\"32000\\",\\"32000\\",\\"32000\\",\\"32000\\",\\"32000\\"]"\r\n },\r\n {\r\n  "nama":"Combed 30s-24s Panjang",\r\n  "ukuran":"[\\"S\\",\\"M\\",\\"L\\",\\"XL\\",\\"XXL\\",\\"XXXL\\"]",\r\n  "harga":"[\\"35000\\",\\"35000\\",\\"35000\\",\\"35000\\",\\"35000\\",\\"35000\\"]"\r\n },\r\n {\r\n  "nama":"Polo Lacoste",\r\n  "ukuran":"[\\"S\\",\\"M\\",\\"L\\",\\"XL\\",\\"XXL\\",\\"XXXL\\"]",\r\n  "harga":"[\\"55000\\",\\"55000\\",\\"55000\\",\\"55000\\",\\"55000\\",\\"55000\\"]"\r\n },\r\n {\r\n  "nama":"Sweater",\r\n  "ukuran":"[\\"S\\",\\"M\\",\\"L\\",\\"XL\\",\\"XXL\\",\\"XXXL\\"]",\r\n  "harga":"[\\"70000\\",\\"70000\\",\\"70000\\",\\"70000\\",\\"70000\\",\\"70000\\"]"\r\n }\r\n]', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_formula`
--

CREATE TABLE IF NOT EXISTS `tbl_formula` (
`id_formula` tinyint(4) NOT NULL,
  `nama_formula` char(80) NOT NULL,
  `biaya_formula` text NOT NULL,
  `posisi_formula` text NOT NULL,
  `sablon_formula` text NOT NULL,
  `status_formula` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_formula`
--

INSERT INTO `tbl_formula` (`id_formula`, `nama_formula`, `biaya_formula`, `posisi_formula`, `sablon_formula`, `status_formula`) VALUES
(1, 'Formula Biaya Baju', '[{"rincian":"Setting Design","biaya":"50000","rumus":"=,detail_biaya,#,beban_produksi"},{"rincian":"Afdruk","biaya":"5000","rumus":"=,detail_biaya,*,total_warna,#,beban_produksi"}, {"rincian":"Biaya Cuci Film","biaya":"5000","rumus":"=,detail_biaya,*,total_warna,#,beban_produksi" },{  "rincian":"Borongan Operator","biaya":"2000","rumus":"=,detail_biaya,*,jumlah_pesanan,#,biaya_borongan" },{"rincian":"Borongan Operasional","biaya":"1000", "rumus":"=,detail_biaya,*,jumlah_pesanan,#,biaya_borongan" }, {  "rincian":"Listrik Operasional",  "biaya":"500",  "rumus":"=,detail_biaya,*,total_warna,*,jumlah_pesanan,#,operasional_produksi" }, {  "rincian":"Maintenance",  "biaya":"500",  "rumus":"=,detail_biaya,*,jumlah_pesanan,#,operasional_produksi" }, {  "rincian":"Lainnya",  "biaya":"1000",  "rumus":"=,detail_biaya,*,jumlah_pesanan,#,operasional_produksi" }, {  "rincian":"Biaya Bahan Kaos",  "biaya":"0",  "rumus":"@,detail_biaya,total_bahan,#,beban_produksi" }, {  "rincian":"Biaya Polyfilm",  "biaya":"0",  "rumus":"@,detail_biaya,total_polyfilm,#,beban_produksi" }, {  "rincian":"Biaya Tinta Sablon",  "biaya":"0",  "rumus":"@,detail_biaya,total_tinta,*,jumlah_pesanan,#,beban_produksi" }]', '[ "Dada", "Logo Dada Kanan", "Logo Dada Kiri", "Punggung", "Lengan Kanan", "Lengan Kiri", "Lainnya"]', '[ {  "ukuran":"Logo (max 11.5x11.5 cm)",  "polyfilm":"1500",  "tinta":"[{\\"id\\":1,\\"nama\\":\\"Plastisol\\",\\"biaya\\":\\"300\\"},{\\"id\\":2,\\"nama\\":\\"Rubber\\",\\"biaya\\":\\"200\\"},{\\"id\\":3,\\"nama\\":\\"Discharge\\",\\"biaya\\":\\"1500\\"}]" }, {  "ukuran":"F5 (21x33 cm)",  "polyfilm":"3500",  "tinta":"[{\\"id\\":1,\\"nama\\":\\"Plastisol\\",\\"biaya\\":\\"600\\"},{\\"id\\":2,\\"nama\\":\\"Rubber\\",\\"biaya\\":\\"400\\"},{\\"id\\":3,\\"nama\\":\\"Discharge\\",\\"biaya\\":\\"2000\\"}]" }, {  "ukuran":"A3 (29x32 cm)",  "polyfilm":"7500",  "tinta":"[{\\"id\\":1,\\"nama\\":\\"Plastisol\\",\\"biaya\\":\\"1500\\"},{\\"id\\":2,\\"nama\\":\\"Rubber\\",\\"biaya\\":\\"600\\"},{\\"id\\":3,\\"nama\\":\\"Discharge\\",\\"biaya\\":\\"4000\\"}]" }, {  "ukuran":"A3+ (32x48 cm)",  "polyfilm":"7500",  "tinta":"[{\\"id\\":1,\\"nama\\":\\"Plastisol\\",\\"biaya\\":\\"2000\\"},{\\"id\\":2,\\"nama\\":\\"Rubber\\",\\"biaya\\":\\"1000\\"},{\\"id\\":3,\\"nama\\":\\"Discharge\\",\\"biaya\\":\\"5500\\"}]" }, {  "ukuran":"Fullbody",  "polyfilm":"35000",  "tinta":"[{\\"id\\":1,\\"nama\\":\\"Plastisol\\",\\"biaya\\":\\"25000\\"},{\\"id\\":2,\\"nama\\":\\"Rubber\\",\\"biaya\\":\\"18000\\"},{\\"id\\":3,\\"nama\\":\\"Discharge\\",\\"biaya\\":\\"0\\"}]" }]', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pelanggan`
--

CREATE TABLE IF NOT EXISTS `tbl_pelanggan` (
  `id_pelanggan` char(12) NOT NULL,
  `nama_pelanggan` char(80) NOT NULL,
  `telp_pelanggan` char(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pelanggan`
--

INSERT INTO `tbl_pelanggan` (`id_pelanggan`, `nama_pelanggan`, `telp_pelanggan`) VALUES
('PLG210101789', 'Budi', '6282110751455'),
('PLG210102789', 'Anto', '6281390908811'),
('PLGN73W101JV', 'Poi', '6282100009999');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_produksi`
--

CREATE TABLE IF NOT EXISTS `tbl_produksi` (
  `id_produksi` char(12) NOT NULL,
  `id_pelanggan` char(12) NOT NULL,
  `riwayat_produksi` text NOT NULL,
  `karyawan_produksi` text NOT NULL,
  `data_produksi` text NOT NULL,
  `status_produksi` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tinta`
--

CREATE TABLE IF NOT EXISTS `tbl_tinta` (
`id_tinta` tinyint(3) NOT NULL,
  `detail_tinta` char(80) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_tinta`
--

INSERT INTO `tbl_tinta` (`id_tinta`, `detail_tinta`, `status`) VALUES
(1, 'Plastisol', 1),
(2, 'Rubber', 1),
(3, 'Discarge', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaksi`
--

CREATE TABLE IF NOT EXISTS `tbl_transaksi` (
  `id_transaksi` char(12) NOT NULL,
  `id_pelanggan` char(12) NOT NULL,
  `data_transaksi` text NOT NULL,
  `data_biaya` text NOT NULL,
  `data_produksi` text NOT NULL,
  `id_produksi` tinytext NOT NULL,
  `status_transaksi` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
`id_user` tinyint(3) NOT NULL,
  `nama_user` char(80) NOT NULL,
  `telp_user` varchar(13) NOT NULL,
  `username` char(30) NOT NULL,
  `password` char(30) NOT NULL,
  `akses_user` char(30) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `nama_user`, `telp_user`, `username`, `password`, `akses_user`, `status`) VALUES
(1, 'John', '6282110751455', 'admin', 'admin', 'Admin', 1),
(2, 'Udin', '6288812349999', 'udin', 'udin', 'Pekerja', 1),
(3, 'Mooo', '088800001010', 'mooo', 'mooo', 'Pekerja', 1),
(4, 'Mon', '6288812349988', 'mon', 'mon', 'Pekerja', 1),
(5, 'Qwerty', '6288812349122', 'qwe', 'qwe', 'Pekerja', 1),
(6, 'Andi', '82100009999', 'andi', 'andi', 'Pekerja', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_config`
--

CREATE TABLE IF NOT EXISTS `tbl_user_config` (
`id_config` tinyint(3) NOT NULL,
  `user_akses` char(30) NOT NULL,
  `user_page` text NOT NULL,
  `user_gaji` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user_config`
--

INSERT INTO `tbl_user_config` (`id_config`, `user_akses`, `user_page`, `user_gaji`) VALUES
(1, 'Admin', '[{"Page":"Dashboard","Link":"Welcome/Dashboard"},{"Page":"Tenaga Kerja","Link":"Welcome/User"},{"Page":"Pemesanan","Link":"Welcome/Transaksi"},{"Page":"Produksi","Link":"Welcome/Produksi"},{"Page":"Pembukuan","Link":"Welcome/Pembukuan"}]', ''),
(2, 'Pekerja', '[{"Page":"Dashboard","Link":"Welcome/Dashboard"},{"Page":"Produksi","Link":"Welcome/Produksi"}]', '{"Insentif_Harian":"15000","Akomodasi_Harian":"20000","Tunjangan_Produksi":"15000"}');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_presensi`
--

CREATE TABLE IF NOT EXISTS `tbl_user_presensi` (
  `id_user` tinyint(3) NOT NULL,
  `data_presensi` text NOT NULL,
  `data_presensi_produksi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user_presensi`
--

INSERT INTO `tbl_user_presensi` (`id_user`, `data_presensi`, `data_presensi_produksi`) VALUES
(1, '[]', '[]'),
(2, '[]', '[]'),
(3, '[]', '[]'),
(4, '[]', '[]'),
(5, '[]', '[]'),
(6, '[]', '[]');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_bahan`
--
ALTER TABLE `tbl_bahan`
 ADD PRIMARY KEY (`id_bahan`);

--
-- Indexes for table `tbl_formula`
--
ALTER TABLE `tbl_formula`
 ADD PRIMARY KEY (`id_formula`);

--
-- Indexes for table `tbl_pelanggan`
--
ALTER TABLE `tbl_pelanggan`
 ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `tbl_produksi`
--
ALTER TABLE `tbl_produksi`
 ADD PRIMARY KEY (`id_produksi`);

--
-- Indexes for table `tbl_tinta`
--
ALTER TABLE `tbl_tinta`
 ADD PRIMARY KEY (`id_tinta`);

--
-- Indexes for table `tbl_transaksi`
--
ALTER TABLE `tbl_transaksi`
 ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
 ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `tbl_user_config`
--
ALTER TABLE `tbl_user_config`
 ADD PRIMARY KEY (`id_config`);

--
-- Indexes for table `tbl_user_presensi`
--
ALTER TABLE `tbl_user_presensi`
 ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_bahan`
--
ALTER TABLE `tbl_bahan`
MODIFY `id_bahan` tinyint(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_formula`
--
ALTER TABLE `tbl_formula`
MODIFY `id_formula` tinyint(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_tinta`
--
ALTER TABLE `tbl_tinta`
MODIFY `id_tinta` tinyint(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
MODIFY `id_user` tinyint(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tbl_user_config`
--
ALTER TABLE `tbl_user_config`
MODIFY `id_config` tinyint(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
