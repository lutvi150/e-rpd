/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE TABLE `migrations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

CREATE TABLE `table_kegiatan` (
  `id_kegiatan` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `id_lembaga` bigint(20) DEFAULT NULL,
  `kode_kegiatan` varchar(255) NOT NULL,
  `uraian_kegiatan` text NOT NULL,
  `pagu_kegiatan` bigint(20) NOT NULL,
  `mulai_pelaksanaan` varchar(50) NOT NULL,
  `akhir_pelaksanaan` varchar(50) NOT NULL,
  `tahun_anggaran` varchar(5) NOT NULL,
  PRIMARY KEY (`id_kegiatan`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

CREATE TABLE `table_lembaga` (
  `id_lembaga` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `nama_lembaga` varchar(255) NOT NULL,
  `id_pengelola` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_lembaga`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

CREATE TABLE `table_rincian_kegiatan` (
  `id_rincian` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `id_kegiatan` int(11) NOT NULL,
  `kode_rincian` varchar(255) NOT NULL,
  `uraian_rincian_kegiatan` text NOT NULL,
  `pagu_rincian_kegiatan` int(11) NOT NULL,
  PRIMARY KEY (`id_rincian`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

CREATE TABLE `table_rincian_kegiatan_perbulan` (
  `id_rincian_kegiatan_perbulan` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `id_rincian_kegiatan` int(11) NOT NULL,
  `bulan` bigint(20) NOT NULL,
  `total_pagu_perbulan` bigint(20) NOT NULL,
  PRIMARY KEY (`id_rincian_kegiatan_perbulan`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

CREATE TABLE `table_rincian_kegiatan_perminggu` (
  `id_rincian_kegiatan_perminggu` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `id_rincian_kegiatan_perbulan` int(11) NOT NULL,
  `minggu` int(5) NOT NULL,
  `total_pagu_perminggu` bigint(20) NOT NULL,
  PRIMARY KEY (`id_rincian_kegiatan_perminggu`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `table_user` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `nama_user` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL,
  `last_login` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2022-12-26-094025', 'App\\Database\\Migrations\\TableUser', 'default', 'App', 1672063554, 1);
INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(2, '2022-12-26-115720', 'App\\Database\\Migrations\\TableLembaga', 'default', 'App', 1672063554, 1);
INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(3, '2022-12-26-115735', 'App\\Database\\Migrations\\TableKegiatan', 'default', 'App', 1672063554, 1);
INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(4, '2022-12-26-115743', 'App\\Database\\Migrations\\TableRincianKegiatan', 'default', 'App', 1672063554, 1),
(5, '2022-12-26-115753', 'App\\Database\\Migrations\\TableRincianPenarikan', 'default', 'App', 1672063554, 1),
(6, '2022-12-26-115804', 'App\\Database\\Migrations\\TableRincianPerbulan', 'default', 'App', 1672063554, 1),
(7, '2022-12-26-115825', 'App\\Database\\Migrations\\TableKalenderHarian', 'default', 'App', 1672063554, 1),
(8, '2022-12-26-115834', 'App\\Database\\Migrations\\TablePenarikanHarian', 'default', 'App', 1672063554, 1),
(9, '2023-02-23-074759', 'App\\Database\\Migrations\\TableRincianKegiatanPerbulan', 'default', 'App', 1677138595, 2),
(10, '2023-02-24-193523', 'App\\Database\\Migrations\\TableRincianPerminggu', 'default', 'App', 1677267442, 3);

INSERT INTO `table_kegiatan` (`id_kegiatan`, `id_lembaga`, `kode_kegiatan`, `uraian_kegiatan`, `pagu_kegiatan`, `mulai_pelaksanaan`, `akhir_pelaksanaan`, `tahun_anggaran`) VALUES
(1, 5, '2131.BGC.002.005.5A', 'Pelaksanaan Audit Internal', 86129000, '2', '12', '2023');
INSERT INTO `table_kegiatan` (`id_kegiatan`, `id_lembaga`, `kode_kegiatan`, `uraian_kegiatan`, `pagu_kegiatan`, `mulai_pelaksanaan`, `akhir_pelaksanaan`, `tahun_anggaran`) VALUES
(2, 5, '2132.BGC.002.005.5B', 'Bimtek dan Pendidikan Auditor', 118945000, '2', '11', '2023');
INSERT INTO `table_kegiatan` (`id_kegiatan`, `id_lembaga`, `kode_kegiatan`, `uraian_kegiatan`, `pagu_kegiatan`, `mulai_pelaksanaan`, `akhir_pelaksanaan`, `tahun_anggaran`) VALUES
(3, 5, '2131.BGC.002.005.5C', 'Workshop Penyusunan Pedoman-Pedoman SPI', 8355000, '3', '9', '2023');
INSERT INTO `table_kegiatan` (`id_kegiatan`, `id_lembaga`, `kode_kegiatan`, `uraian_kegiatan`, `pagu_kegiatan`, `mulai_pelaksanaan`, `akhir_pelaksanaan`, `tahun_anggaran`) VALUES
(4, 5, '2132/BGC.002.055.5D', 'Pelaksanaan Audit Kolaboratif/ Operasional', 12255000, '2', '8', '2023');

INSERT INTO `table_lembaga` (`id_lembaga`, `nama_lembaga`, `id_pengelola`) VALUES
(5, 'Satuan Pengawasan Internal', 2);
INSERT INTO `table_lembaga` (`id_lembaga`, `nama_lembaga`, `id_pengelola`) VALUES
(6, 'Satuan Pengawasan Internal 2', 2);


INSERT INTO `table_rincian_kegiatan` (`id_rincian`, `id_kegiatan`, `kode_rincian`, `uraian_rincian_kegiatan`, `pagu_rincian_kegiatan`) VALUES
(1, 1, '521211', 'Belanja Bahan', 8561000);
INSERT INTO `table_rincian_kegiatan` (`id_rincian`, `id_kegiatan`, `kode_rincian`, `uraian_rincian_kegiatan`, `pagu_rincian_kegiatan`) VALUES
(2, 1, '524114', 'Perjalanan Paket Meeting Dalam Kota', 2400000);
INSERT INTO `table_rincian_kegiatan` (`id_rincian`, `id_kegiatan`, `kode_rincian`, `uraian_rincian_kegiatan`, `pagu_rincian_kegiatan`) VALUES
(4, 1, '524119', 'Perjalanan Paket Meeting Luar Kota', 75168000);

INSERT INTO `table_rincian_kegiatan_perbulan` (`id_rincian_kegiatan_perbulan`, `id_rincian_kegiatan`, `bulan`, `total_pagu_perbulan`) VALUES
(1, 0, 1, 20);
INSERT INTO `table_rincian_kegiatan_perbulan` (`id_rincian_kegiatan_perbulan`, `id_rincian_kegiatan`, `bulan`, `total_pagu_perbulan`) VALUES
(2, 0, 1, 20);
INSERT INTO `table_rincian_kegiatan_perbulan` (`id_rincian_kegiatan_perbulan`, `id_rincian_kegiatan`, `bulan`, `total_pagu_perbulan`) VALUES
(3, 1, 1, 0);
INSERT INTO `table_rincian_kegiatan_perbulan` (`id_rincian_kegiatan_perbulan`, `id_rincian_kegiatan`, `bulan`, `total_pagu_perbulan`) VALUES
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



INSERT INTO `table_user` (`id`, `nama_user`, `email`, `password`, `role`, `last_login`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin', 'admin@gmail.com', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'administrator', '2022-12-26 08:16:10', '2022-12-26 08:16:10', '0000-00-00 00:00:00', NULL);
INSERT INTO `table_user` (`id`, `nama_user`, `email`, `password`, `role`, `last_login`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'Budi', 'budi@gmail.com', '48b02c9e85f934696778e9d1e84e697ca1ea6de02e07fc13173c1f1e98bbc60c', 'unit', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL);
INSERT INTO `table_user` (`id`, `nama_user`, `email`, `password`, `role`, `last_login`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 'Any', 'Any@gmail.com', '8aebbd3f4c921c9f3f35347a063fbedf8e26d9cdaf4faa8d5ad3eac8fe7cf7ac', 'unit', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL);
INSERT INTO `table_user` (`id`, `nama_user`, `email`, `password`, `role`, `last_login`, `created_at`, `updated_at`, `deleted_at`) VALUES
(4, 'Lara', 'laradev@gmail.com', '6835cfda39794eabd46b121b9a9c824cbfde09684a0afd939d65fb7c5ea1ba30', 'unit', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(5, 'Lara tes 2', 'larates2@gmail.com', '6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b', 'unit', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2023-02-23 08:03:26');


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;