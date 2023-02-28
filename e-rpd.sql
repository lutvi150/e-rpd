-- phpMyAdmin SQL Dump
-- version 4.9.11
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 28, 2023 at 08:48 PM
-- Server version: 10.5.19-MariaDB-cll-lve-log
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `teamclov_demo_6`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2022-12-26-094025', 'App\\Database\\Migrations\\TableUser', 'default', 'App', 1672063554, 1),
(2, '2022-12-26-115720', 'App\\Database\\Migrations\\TableLembaga', 'default', 'App', 1672063554, 1),
(3, '2022-12-26-115735', 'App\\Database\\Migrations\\TableKegiatan', 'default', 'App', 1672063554, 1),
(4, '2022-12-26-115743', 'App\\Database\\Migrations\\TableRincianKegiatan', 'default', 'App', 1672063554, 1),
(5, '2022-12-26-115753', 'App\\Database\\Migrations\\TableRincianPenarikan', 'default', 'App', 1672063554, 1),
(6, '2022-12-26-115804', 'App\\Database\\Migrations\\TableRincianPerbulan', 'default', 'App', 1672063554, 1),
(7, '2022-12-26-115825', 'App\\Database\\Migrations\\TableKalenderHarian', 'default', 'App', 1672063554, 1),
(8, '2022-12-26-115834', 'App\\Database\\Migrations\\TablePenarikanHarian', 'default', 'App', 1672063554, 1),
(9, '2023-02-23-074759', 'App\\Database\\Migrations\\TableRincianKegiatanPerbulan', 'default', 'App', 1677138595, 2),
(10, '2023-02-24-193523', 'App\\Database\\Migrations\\TableRincianPerminggu', 'default', 'App', 1677267442, 3);

-- --------------------------------------------------------

--
-- Table structure for table `table_kegiatan`
--

CREATE TABLE `table_kegiatan` (
  `id_kegiatan` int(5) UNSIGNED NOT NULL,
  `id_lembaga` bigint(20) DEFAULT NULL,
  `kode_kegiatan` varchar(255) NOT NULL,
  `uraian_kegiatan` text NOT NULL,
  `pagu_kegiatan` bigint(20) NOT NULL,
  `mulai_pelaksanaan` varchar(50) NOT NULL,
  `akhir_pelaksanaan` varchar(50) NOT NULL,
  `tahun_anggaran` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `table_kegiatan`
--

INSERT INTO `table_kegiatan` (`id_kegiatan`, `id_lembaga`, `kode_kegiatan`, `uraian_kegiatan`, `pagu_kegiatan`, `mulai_pelaksanaan`, `akhir_pelaksanaan`, `tahun_anggaran`) VALUES
(1, 5, '2131.BGC.002.005.5A', 'Pelaksanaan Audit Internal', 86129000, '2', '12', '2023'),
(2, 5, '2132.BGC.002.005.5B', 'Bimtek dan Pendidikan Auditor', 118945000, '2', '11', '2023'),
(3, 5, '2131.BGC.002.005.5C', 'Workshop Penyusunan Pedoman-Pedoman SPI', 8355000, '3', '9', '2023'),
(4, 5, '2132/BGC.002.055.5D', 'Pelaksanaan Audit Kolaboratif/ Operasional', 12255000, '2', '8', '2023');

-- --------------------------------------------------------

--
-- Table structure for table `table_lembaga`
--

CREATE TABLE `table_lembaga` (
  `id_lembaga` int(5) UNSIGNED NOT NULL,
  `nama_lembaga` varchar(255) NOT NULL,
  `id_pengelola` int(11) DEFAULT NULL,
  `status_verifikasi` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `table_lembaga`
--

INSERT INTO `table_lembaga` (`id_lembaga`, `nama_lembaga`, `id_pengelola`, `status_verifikasi`) VALUES
(5, 'Satuan Pengawasan Internal', 2, NULL),
(6, 'Satuan Pengawasan Internal 2', 2, NULL),
(8, 'LPM', 6, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `table_rincian_kegiatan`
--

CREATE TABLE `table_rincian_kegiatan` (
  `id_rincian` int(5) UNSIGNED NOT NULL,
  `id_kegiatan` int(11) NOT NULL,
  `kode_rincian` varchar(255) NOT NULL,
  `uraian_rincian_kegiatan` text NOT NULL,
  `pagu_rincian_kegiatan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `table_rincian_kegiatan`
--

INSERT INTO `table_rincian_kegiatan` (`id_rincian`, `id_kegiatan`, `kode_rincian`, `uraian_rincian_kegiatan`, `pagu_rincian_kegiatan`) VALUES
(1, 1, '521211', 'Belanja Bahan', 8561000),
(2, 1, '524114', 'Perjalanan Paket Meeting Dalam Kota', 2400000),
(4, 1, '524119', 'Perjalanan Paket Meeting Luar Kota', 75168000);

-- --------------------------------------------------------

--
-- Table structure for table `table_rincian_kegiatan_perbulan`
--

CREATE TABLE `table_rincian_kegiatan_perbulan` (
  `id_rincian_kegiatan_perbulan` int(5) UNSIGNED NOT NULL,
  `id_rincian_kegiatan` int(11) NOT NULL,
  `bulan` bigint(20) NOT NULL,
  `total_pagu_perbulan` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `table_rincian_kegiatan_perbulan`
--

INSERT INTO `table_rincian_kegiatan_perbulan` (`id_rincian_kegiatan_perbulan`, `id_rincian_kegiatan`, `bulan`, `total_pagu_perbulan`) VALUES
(1, 0, 1, 20),
(2, 0, 1, 20),
(3, 1, 1, 0),
(4, 2, 1, 0),
(5, 4, 1, 0),
(6, 1, 2, 4000000),
(7, 1, 12, 0),
(8, 2, 2, 300000),
(9, 1, 3, 0),
(10, 1, 4, 0),
(11, 1, 5, 0),
(12, 1, 6, 4561000),
(13, 1, 7, 0),
(14, 1, 8, 0),
(15, 1, 9, 0),
(16, 1, 10, 0),
(17, 1, 11, 0),
(18, 2, 11, 0),
(19, 1, 13, 0),
(20, 4, 2, 1200000),
(21, 2, 3, 200000),
(22, 2, 6, 400000),
(23, 2, 7, 300000),
(24, 2, 8, 600000),
(25, 2, 9, 300000),
(26, 2, 10, 300000),
(27, 4, 3, 2800000),
(28, 4, 6, 8500000),
(29, 4, 7, 14500000),
(30, 4, 8, 22500000),
(31, 4, 9, 8000000),
(32, 4, 10, 6000000),
(33, 4, 11, 1668000);

-- --------------------------------------------------------

--
-- Table structure for table `table_rincian_kegiatan_perhari`
--

CREATE TABLE `table_rincian_kegiatan_perhari` (
  `id_rincian_kegiatan_perhari` int(5) UNSIGNED NOT NULL,
  `id_rincian_kegiatan` int(11) NOT NULL,
  `bulan` varchar(5) NOT NULL,
  `rincian_perhari` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `table_rincian_kegiatan_perhari`
--

INSERT INTO `table_rincian_kegiatan_perhari` (`id_rincian_kegiatan_perhari`, `id_rincian_kegiatan`, `bulan`, `rincian_perhari`) VALUES
(1, 1, '2', '[{\"date\":\"1\",\"pagu\":\"1000000\"},{\"date\":\"2\",\"pagu\":\"0\"},{\"date\":\"3\",\"pagu\":\"0\"},{\"date\":\"6\",\"pagu\":\"9000\"},{\"date\":\"7\",\"pagu\":\"0\"},{\"date\":\"8\",\"pagu\":\"0\"},{\"date\":\"9\",\"pagu\":\"4000000\"},{\"date\":\"10\",\"pagu\":\"0\"},{\"date\":\"13\",\"pagu\":\"0\"},{\"date\":\"14\",\"pagu\":\"0\"},{\"date\":\"15\",\"pagu\":\"0\"},{\"date\":\"16\",\"pagu\":\"0\"},{\"date\":\"17\",\"pagu\":\"0\"},{\"date\":\"20\",\"pagu\":\"0\"},{\"date\":\"21\",\"pagu\":\"0\"},{\"date\":\"22\",\"pagu\":\"0\"},{\"date\":\"23\",\"pagu\":\"0\"},{\"date\":\"24\",\"pagu\":\"0\"},{\"date\":\"27\",\"pagu\":\"0\"},{\"date\":\"28\",\"pagu\":\"0\"}]');

-- --------------------------------------------------------

--
-- Table structure for table `table_rincian_kegiatan_perminggu`
--

CREATE TABLE `table_rincian_kegiatan_perminggu` (
  `id_rincian_kegiatan_perminggu` int(5) UNSIGNED NOT NULL,
  `id_rincian_kegiatan_perbulan` int(11) NOT NULL,
  `minggu` int(5) NOT NULL,
  `total_pagu_perminggu` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `table_rincian_kegiatan_perminggu`
--

INSERT INTO `table_rincian_kegiatan_perminggu` (`id_rincian_kegiatan_perminggu`, `id_rincian_kegiatan_perbulan`, `minggu`, `total_pagu_perminggu`) VALUES
(1, 6, 1, 0),
(2, 12, 1, 4651000),
(3, 6, 3, 0),
(4, 6, 2, 4000000),
(5, 12, 2, 0),
(6, 12, 3, 0),
(7, 8, 4, 300),
(8, 21, 2, 200),
(9, 23, 2, 300),
(10, 24, 1, 300),
(11, 24, 2, 300),
(12, 25, 1, 300),
(13, 26, 1, 300),
(14, 22, 2, 400),
(15, 6, 4, 0),
(16, 12, 4, 0),
(17, 26, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `table_user`
--

CREATE TABLE `table_user` (
  `id` int(5) UNSIGNED NOT NULL,
  `nama_user` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL,
  `last_login` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `table_user`
--

INSERT INTO `table_user` (`id`, `nama_user`, `email`, `password`, `role`, `last_login`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin', 'admin@gmail.com', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'administrator', '2022-12-26 08:16:10', '2022-12-26 08:16:10', '0000-00-00 00:00:00', NULL),
(2, 'Budi', 'budi@gmail.com', '48b02c9e85f934696778e9d1e84e697ca1ea6de02e07fc13173c1f1e98bbc60c', 'unit', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(3, 'Any', 'Any@gmail.com', '8aebbd3f4c921c9f3f35347a063fbedf8e26d9cdaf4faa8d5ad3eac8fe7cf7ac', 'unit', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(4, 'Lara', 'laradev@gmail.com', '6835cfda39794eabd46b121b9a9c824cbfde09684a0afd939d65fb7c5ea1ba30', 'unit', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(5, 'Lara tes 2', 'larates2@gmail.com', '6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b', 'unit', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2023-02-23 08:03:26'),
(6, 'Lisa', 'lpm@gmail.com', '0621abf144d39a66dfd2e152f75491d12d3ea8703e0ad394699384481e5e0290', 'unit', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `table_kegiatan`
--
ALTER TABLE `table_kegiatan`
  ADD PRIMARY KEY (`id_kegiatan`);

--
-- Indexes for table `table_lembaga`
--
ALTER TABLE `table_lembaga`
  ADD PRIMARY KEY (`id_lembaga`);

--
-- Indexes for table `table_rincian_kegiatan`
--
ALTER TABLE `table_rincian_kegiatan`
  ADD PRIMARY KEY (`id_rincian`);

--
-- Indexes for table `table_rincian_kegiatan_perbulan`
--
ALTER TABLE `table_rincian_kegiatan_perbulan`
  ADD PRIMARY KEY (`id_rincian_kegiatan_perbulan`);

--
-- Indexes for table `table_rincian_kegiatan_perhari`
--
ALTER TABLE `table_rincian_kegiatan_perhari`
  ADD PRIMARY KEY (`id_rincian_kegiatan_perhari`);

--
-- Indexes for table `table_rincian_kegiatan_perminggu`
--
ALTER TABLE `table_rincian_kegiatan_perminggu`
  ADD PRIMARY KEY (`id_rincian_kegiatan_perminggu`);

--
-- Indexes for table `table_user`
--
ALTER TABLE `table_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `table_kegiatan`
--
ALTER TABLE `table_kegiatan`
  MODIFY `id_kegiatan` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `table_lembaga`
--
ALTER TABLE `table_lembaga`
  MODIFY `id_lembaga` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `table_rincian_kegiatan`
--
ALTER TABLE `table_rincian_kegiatan`
  MODIFY `id_rincian` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `table_rincian_kegiatan_perbulan`
--
ALTER TABLE `table_rincian_kegiatan_perbulan`
  MODIFY `id_rincian_kegiatan_perbulan` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `table_rincian_kegiatan_perhari`
--
ALTER TABLE `table_rincian_kegiatan_perhari`
  MODIFY `id_rincian_kegiatan_perhari` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `table_rincian_kegiatan_perminggu`
--
ALTER TABLE `table_rincian_kegiatan_perminggu`
  MODIFY `id_rincian_kegiatan_perminggu` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `table_user`
--
ALTER TABLE `table_user`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
