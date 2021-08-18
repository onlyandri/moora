-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 28, 2021 at 04:44 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pw2_5p52`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_adm`
--

CREATE TABLE `detail_adm` (
  `id_detail` int(11) NOT NULL,
  `id_kriteria` varchar(20) NOT NULL,
  `nama_detail` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_adm`
--

INSERT INTO `detail_adm` (`id_detail`, `id_kriteria`, `nama_detail`) VALUES
(5, 'K01', 'ijazah'),
(6, 'K01', 'CV'),
(7, 'K01', 'Document Penting');

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `kode_kriteria` varchar(20) NOT NULL,
  `nama_kriteria` varchar(20) NOT NULL,
  `bobot` float NOT NULL,
  `jenis_kriteria` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`kode_kriteria`, `nama_kriteria`, `bobot`, `jenis_kriteria`) VALUES
('K01', 'Administrasi', 2, 'Benefit'),
('K02', 'Kesehatan', 1, 'Benefit'),
('K03', 'Psikotest', 2, 'Benefit'),
('K04', 'Interview User', 2, 'Cost'),
('K05', 'Technical Test', 2, 'Benefit'),
('K06', 'Orientasi Kerja', 2, 'Benefit');

-- --------------------------------------------------------

--
-- Table structure for table `ms_pengguna`
--

CREATE TABLE `ms_pengguna` (
  `kode_pengguna` char(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `sandi_pengguna` varchar(100) NOT NULL,
  `nama_pengguna` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ms_pengguna`
--

INSERT INTO `ms_pengguna` (`kode_pengguna`, `username`, `sandi_pengguna`, `nama_pengguna`) VALUES
('HRD002', 'onlyandri97@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'andri'),
('HRD003', 'andri@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'ANDRI');

-- --------------------------------------------------------

--
-- Table structure for table `pelamar`
--

CREATE TABLE `pelamar` (
  `kode_pelamar` varchar(6) NOT NULL,
  `nama_pelamar` varchar(30) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `no_ktp` int(20) NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `status_perkawinan` varchar(20) NOT NULL,
  `agama` varchar(20) NOT NULL,
  `no_hp` float NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `pendidikan` varchar(20) NOT NULL,
  `tahun_lulus` int(10) NOT NULL,
  `nilai_ipk` float NOT NULL,
  `pengalaman` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelamar`
--

INSERT INTO `pelamar` (`kode_pelamar`, `nama_pelamar`, `tanggal_masuk`, `jabatan`, `no_ktp`, `jenis_kelamin`, `tanggal_lahir`, `status_perkawinan`, `agama`, `no_hp`, `alamat`, `pendidikan`, `tahun_lulus`, `nilai_ipk`, `pengalaman`) VALUES
('P002', 'Vicky Lukluil Mukaromah', '2021-02-02', 'Staff HRD', 0, 'Perempuan', '1999-02-03', 'Belum Menikah', '', 2147480000, 'Kedungwuni', 'S1 Komputer', 2021, 3, 1),
('P003', 'Intan Rizqa', '2021-01-01', 'Staff', 0, 'Laki-laki', '2021-01-04', 'Belum Menikah', '', 2147480000, 'Sidoarjo', 'S1 Komputer', 2021, 3.8, 2),
('P004', 'prilia citra sari ika putri', '2021-01-01', 'Admin', 0, 'Perempuan', '1997-02-05', 'Menikah', '', 2147480000, 'Podosugih Pekalongan', 'S1 Pendidikan', 2021, 3, 2),
('P005', 'Larasati', '2021-02-06', 'Help Desk', 0, 'Perempuan', '2000-02-03', 'Belum Menikah', '', 2147480000, 'Buaran Kota Pekalongan', 'S1 Ekonomi', 2021, 3.9, 2),
('P006', 'Safira Kusumaning Ayu', '2021-02-03', 'Operator', 0, 'Perempuan', '2021-02-06', 'Belum Menikah', '', 89010000000, 'Kajen', 'S1 Komputer', 2021, 3.8, 2),
('P007', 'Muhammad Zainal ', '2021-02-03', 'Operator', 0, 'Laki-laki', '1998-07-10', 'Belum Menikah', '', 9869970000000, 'Tirto', 'S1 Komputer', 2021, 3.7, 2),
('P008', 'Muhammad Arfa', '2021-02-03', 'Staff', 0, 'Laki-laki', '1999-02-09', 'Belum Menikah', '', 89010000000, 'Wiradesa', 'S1 Ekonomi', 2021, 3.9, 2),
('P009', 'andri', '2021-02-26', 'Section Head', 0, 'Laki-laki', '2021-02-26', 'belum kawin', '', 8212310000, 'pekalongan', 's1', 2021, 4, 12),
('P010', 'Sebastian steel', '2021-02-28', 'Admin', 0, 'Laki-laki', '2021-02-28', 'belum kawin', '', 82122200000, 'pekalongan', 's1', 2012, 4, 11),
('P011', 'sweinsteneiger', '2021-02-28', 'Staff', 0, 'Laki-laki', '2021-02-28', 'belum kawin', '', 82122200000, 'pekalongan', 's1', 2014, 1, 12);

-- --------------------------------------------------------

--
-- Table structure for table `penilaian`
--

CREATE TABLE `penilaian` (
  `kode_penilaian` int(11) NOT NULL,
  `tanggal_penilaian` date NOT NULL,
  `kode_pelamar` varchar(6) NOT NULL,
  `kode_kriteria` varchar(20) NOT NULL,
  `nilai` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penilaian`
--

INSERT INTO `penilaian` (`kode_penilaian`, `tanggal_penilaian`, `kode_pelamar`, `kode_kriteria`, `nilai`) VALUES
(673, '2021-02-28', 'P008', 'K01', 10),
(674, '2021-02-28', 'P008', 'K02', 1),
(675, '2021-02-28', 'P008', 'K03', 1),
(676, '2021-02-28', 'P008', 'K04', 1),
(677, '2021-02-28', 'P008', 'K05', 1),
(678, '2021-02-28', 'P008', 'K06', 1),
(679, '2021-02-28', 'P003', 'K01', 10),
(680, '2021-02-28', 'P003', 'K02', 1),
(681, '2021-02-28', 'P003', 'K03', 1),
(682, '2021-02-28', 'P003', 'K04', 1),
(683, '2021-02-28', 'P003', 'K05', 1),
(684, '2021-02-28', 'P003', 'K06', 1),
(685, '2021-02-28', 'P011', 'K01', 10),
(686, '2021-02-28', 'P011', 'K02', 1),
(687, '2021-02-28', 'P011', 'K03', 1),
(688, '2021-02-28', 'P011', 'K04', 1),
(689, '2021-02-28', 'P011', 'K05', 1),
(690, '2021-02-28', 'P011', 'K06', 1);

-- --------------------------------------------------------

--
-- Table structure for table `penilaian_adm`
--

CREATE TABLE `penilaian_adm` (
  `id_penilaian_adm` int(11) NOT NULL,
  `kode_pelamar` varchar(6) NOT NULL,
  `id_detail` int(11) NOT NULL,
  `nilai` int(11) NOT NULL,
  `tanggal_adm` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penilaian_adm`
--

INSERT INTO `penilaian_adm` (`id_penilaian_adm`, `kode_pelamar`, `id_detail`, `nilai`, `tanggal_adm`) VALUES
(195, 'P008', 5, 10, '2021-02-28'),
(196, 'P008', 6, 10, '2021-02-28'),
(197, 'P008', 7, 10, '2021-02-28'),
(198, 'P003', 5, 10, '2021-02-28'),
(199, 'P003', 6, 10, '2021-02-28'),
(200, 'P003', 7, 10, '2021-02-28'),
(201, 'P011', 5, 10, '2021-02-28'),
(202, 'P011', 6, 10, '2021-02-28'),
(203, 'P011', 7, 10, '2021-02-28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_adm`
--
ALTER TABLE `detail_adm`
  ADD PRIMARY KEY (`id_detail`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`kode_kriteria`);

--
-- Indexes for table `ms_pengguna`
--
ALTER TABLE `ms_pengguna`
  ADD PRIMARY KEY (`kode_pengguna`);

--
-- Indexes for table `pelamar`
--
ALTER TABLE `pelamar`
  ADD PRIMARY KEY (`kode_pelamar`);

--
-- Indexes for table `penilaian`
--
ALTER TABLE `penilaian`
  ADD PRIMARY KEY (`kode_penilaian`);

--
-- Indexes for table `penilaian_adm`
--
ALTER TABLE `penilaian_adm`
  ADD PRIMARY KEY (`id_penilaian_adm`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_adm`
--
ALTER TABLE `detail_adm`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `penilaian`
--
ALTER TABLE `penilaian`
  MODIFY `kode_penilaian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=691;

--
-- AUTO_INCREMENT for table `penilaian_adm`
--
ALTER TABLE `penilaian_adm`
  MODIFY `id_penilaian_adm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=204;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
