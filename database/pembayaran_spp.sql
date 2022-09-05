-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 21, 2022 at 05:12 PM
-- Server version: 5.7.33
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pembayaran_spp`
--

-- --------------------------------------------------------

--
-- Table structure for table `jenis_pembayaran`
--

CREATE TABLE `jenis_pembayaran` (
  `id_jenis_pembayaran` int(11) NOT NULL,
  `nama_jenis` varchar(50) NOT NULL,
  `nominal` bigint(20) NOT NULL,
  `id_tahun_pelajaran` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis_pembayaran`
--

INSERT INTO `jenis_pembayaran` (`id_jenis_pembayaran`, `nama_jenis`, `nominal`, `id_tahun_pelajaran`) VALUES
(1, 'SPP2', 100000, 1),
(2, 'SPP1', 120000, 2),
(3, 'SPP22', 150000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE `jurusan` (
  `id_jurusan` int(11) NOT NULL,
  `nama_jurusan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`id_jurusan`, `nama_jurusan`) VALUES
(3, 'IPA'),
(4, 'IPS');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL,
  `nama_kelas` varchar(50) NOT NULL,
  `id_jurusan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`, `id_jurusan`) VALUES
(10, 'X A', 3),
(11, 'X B', 3),
(12, 'XI A', 3),
(13, 'X A', 4),
(14, 'X B', 4),
(15, 'X C', 4);

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `id_pembayaran_tahun_pelajaran` int(11) NOT NULL,
  `nominal` bigint(20) NOT NULL,
  `bukti_pembayaran` varchar(100) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '0 = proses 1 = berhasil 2 = gagal',
  `tanggal_pembayaran` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_siswa`, `id_pembayaran_tahun_pelajaran`, `nominal`, `bukti_pembayaran`, `status`, `tanggal_pembayaran`) VALUES
(1, 6, 54, 100000, NULL, 1, '2022-07-20'),
(2, 13, 54, 100000, NULL, 1, '2022-07-21'),
(3, 7, 55, 100000, NULL, 1, '2022-07-21'),
(6, 12, 54, 100000, NULL, 1, '2022-07-21'),
(7, 14, 54, 100000, NULL, 1, '2022-07-21');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran_tahun_pelajaran`
--

CREATE TABLE `pembayaran_tahun_pelajaran` (
  `id_pembayaran_tahun_pelajaran` int(11) NOT NULL,
  `id_jenis_pembayaran` int(11) NOT NULL,
  `id_tahun_pelajaran` int(11) NOT NULL,
  `bulan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembayaran_tahun_pelajaran`
--

INSERT INTO `pembayaran_tahun_pelajaran` (`id_pembayaran_tahun_pelajaran`, `id_jenis_pembayaran`, `id_tahun_pelajaran`, `bulan`) VALUES
(54, 1, 1, 7),
(55, 1, 1, 8);

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id_siswa` int(11) NOT NULL,
  `nis` int(11) NOT NULL,
  `nisn` bigint(20) NOT NULL,
  `nama_siswa` varchar(100) NOT NULL,
  `jenis_kelamin` varchar(1) NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `agama` varchar(20) NOT NULL,
  `nama_ayah` varchar(100) DEFAULT NULL,
  `nama_ibu` varchar(100) DEFAULT NULL,
  `alamat_orang_tua` varchar(256) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `id_tahun_pelajaran` int(11) NOT NULL,
  `tanggal_lahir` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `nis`, `nisn`, `nama_siswa`, `jenis_kelamin`, `tempat_lahir`, `agama`, `nama_ayah`, `nama_ibu`, `alamat_orang_tua`, `id_kelas`, `id_tahun_pelajaran`, `tanggal_lahir`) VALUES
(7, 10001, 10000001, 'Agung Kusaeri', 'L', 'Bandung', 'Islam', 'Abi', 'Umi', 'Bandung', 12, 2, '2000-07-08'),
(8, 10002, 10000002, 'Deni Muhammad Arifin', 'L', 'Purwakarta', 'Islam', 'Bayu', 'Ami', 'Bandung', 12, 2, '2000-07-15'),
(9, 10003, 10000003, 'Muhammad Saepul', 'L', 'Bandung', 'Islam', 'Dani', 'Ai Munah', 'Bandung', 12, 2, '2000-07-21'),
(12, 10004, 10000004, 'Muhammad', 'L', 'Bandung', 'Islam', 'Dandi', 'Airu', 'Bandung', 11, 2, '2000-07-21'),
(13, 100054, 10000005, 'Tedi Sopandi', 'L', 'Jakarta', 'Islam', 'Dana', 'Airin', 'Jakarta', 10, 2, '2000-07-21'),
(14, 10006, 123451235123, 'Mario Teguh', 'L', 'Bandung', 'Islam', 'Agay', 'Muti', 'Bandung', 15, 1, '2000-07-07');

-- --------------------------------------------------------

--
-- Table structure for table `tahun_pelajaran`
--

CREATE TABLE `tahun_pelajaran` (
  `id_tahun_pelajaran` int(11) NOT NULL,
  `tahun` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tahun_pelajaran`
--

INSERT INTO `tahun_pelajaran` (`id_tahun_pelajaran`, `tahun`) VALUES
(1, '2022/2023');

-- --------------------------------------------------------

--
-- Table structure for table `tenaga_kependidikan`
--

CREATE TABLE `tenaga_kependidikan` (
  `id_tenaga_kependidikan` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(256) NOT NULL,
  `jenis_kelamin` varchar(1) NOT NULL,
  `jabatan` varchar(30) NOT NULL,
  `no_induk` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tenaga_kependidikan`
--

INSERT INTO `tenaga_kependidikan` (`id_tenaga_kependidikan`, `nama`, `alamat`, `jenis_kelamin`, `jabatan`, `no_induk`) VALUES
(1, 'Setia Novanto1', 'jakarta1', 'P', 'Manager1', '1231241');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(256) NOT NULL,
  `level` enum('admin','bendahara','siswa') NOT NULL,
  `id_siswa` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `username`, `password`, `level`, `id_siswa`) VALUES
(1, 'admin', 'admin', '$2y$10$VWytB8VAKK7V3tm.CFlABO6IRKwzendGxm8WGEkcv5ImeGp4u5lWu', 'admin', NULL),
(3, 'Ade Arman', 'adearman', '$2y$10$qMJRJsUnakm5atSt/Y/8X.Q84bHZnaH6VZ6WgvF/7Qxj0Msg9zdlK', 'siswa', 6),
(4, 'Agung Kusaeri', 'agungkusaeri', '$2y$10$Z7UhlVlXgSbpU283jE8ZbeMNtvA.gkiD2sgjCF/8UMhHWSDJkZS6y', 'siswa', 7),
(5, 'Deni Muhammad Arifin', 'deni', '$2y$10$X/KoNIoGSRR38vUoPvfg5.8lusMb4GmB7X.BiH1121cq0eIxMLWhW', 'siswa', 8),
(6, 'Bendahara', 'bendahara', '$2y$10$AIHyHZBOb0EciZNzmfS8juLYhzK.poyuCaUXe4FgzFRLeaHkbLyO2', 'bendahara', NULL),
(7, 'Mario Teguh', 'mario', '$2y$10$ChVokRto6HjwgCXasmjmmOO9mzzsjcK6qYEmGwXWO3ZOr4ZsPxNze', 'siswa', 14);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jenis_pembayaran`
--
ALTER TABLE `jenis_pembayaran`
  ADD PRIMARY KEY (`id_jenis_pembayaran`);

--
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id_jurusan`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`),
  ADD KEY `id_jurusan` (`id_jurusan`),
  ADD KEY `id_jurusan_2` (`id_jurusan`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indexes for table `pembayaran_tahun_pelajaran`
--
ALTER TABLE `pembayaran_tahun_pelajaran`
  ADD PRIMARY KEY (`id_pembayaran_tahun_pelajaran`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id_siswa`),
  ADD UNIQUE KEY `nisn` (`nisn`);

--
-- Indexes for table `tahun_pelajaran`
--
ALTER TABLE `tahun_pelajaran`
  ADD PRIMARY KEY (`id_tahun_pelajaran`);

--
-- Indexes for table `tenaga_kependidikan`
--
ALTER TABLE `tenaga_kependidikan`
  ADD PRIMARY KEY (`id_tenaga_kependidikan`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jenis_pembayaran`
--
ALTER TABLE `jenis_pembayaran`
  MODIFY `id_jenis_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id_jurusan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pembayaran_tahun_pelajaran`
--
ALTER TABLE `pembayaran_tahun_pelajaran`
  MODIFY `id_pembayaran_tahun_pelajaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tahun_pelajaran`
--
ALTER TABLE `tahun_pelajaran`
  MODIFY `id_tahun_pelajaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tenaga_kependidikan`
--
ALTER TABLE `tenaga_kependidikan`
  MODIFY `id_tenaga_kependidikan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
