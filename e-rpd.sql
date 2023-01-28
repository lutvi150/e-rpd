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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

CREATE TABLE `table_kegiatan` (
  `id_kegiatan` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `kode_kegiatan` varchar(255) NOT NULL,
  `uraian_kegiatan` text NOT NULL,
  `pagu_kegiatan` bigint(20) NOT NULL,
  `mulai_pelaksanaan` varchar(50) NOT NULL,
  `akhir_pelaksanaan` varchar(50) NOT NULL,
  `tahun_anggaran` varchar(5) NOT NULL,
  PRIMARY KEY (`id_kegiatan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `table_lembaga` (
  `id_lembaga` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `nama_lembaga` varchar(255) NOT NULL,
  PRIMARY KEY (`id_lembaga`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `table_penarikan_perbulan` (
  `id_rincian_perbulan` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `rincian_harian` text NOT NULL,
  PRIMARY KEY (`id_rincian_perbulan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `table_rincian_kalender` (
  `id_rincian_perbulan` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `rincian_kelender` text NOT NULL,
  PRIMARY KEY (`id_rincian_perbulan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `table_rincian_kegiatan` (
  `id_rincian` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `id_kegiatan` int(11) NOT NULL,
  `kode_rincian` varchar(255) NOT NULL,
  `uraian_rincian_kegiatan` text NOT NULL,
  `pagu_rincian_kegiatan` int(11) NOT NULL,
  PRIMARY KEY (`id_rincian`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `table_rincian_penarikan` (
  `id_penarikan` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `id_rincian` int(11) NOT NULL,
  `detail_penarikan` text NOT NULL,
  `jumlah_penarikan` bigint(20) NOT NULL,
  PRIMARY KEY (`id_penarikan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `table_rincian_perbulan` (
  `id_rincian_perbulan` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `rincian_perbulan` text NOT NULL,
  PRIMARY KEY (`id_rincian_perbulan`)
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
  `delete_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2022-12-26-094025', 'App\\Database\\Migrations\\TableUser', 'default', 'App', 1672063554, 1),
(2, '2022-12-26-115720', 'App\\Database\\Migrations\\TableLembaga', 'default', 'App', 1672063554, 1),
(3, '2022-12-26-115735', 'App\\Database\\Migrations\\TableKegiatan', 'default', 'App', 1672063554, 1),
(4, '2022-12-26-115743', 'App\\Database\\Migrations\\TableRincianKegiatan', 'default', 'App', 1672063554, 1),
(5, '2022-12-26-115753', 'App\\Database\\Migrations\\TableRincianPenarikan', 'default', 'App', 1672063554, 1),
(6, '2022-12-26-115804', 'App\\Database\\Migrations\\TableRincianPerbulan', 'default', 'App', 1672063554, 1),
(7, '2022-12-26-115825', 'App\\Database\\Migrations\\TableKalenderHarian', 'default', 'App', 1672063554, 1),
(8, '2022-12-26-115834', 'App\\Database\\Migrations\\TablePenarikanHarian', 'default', 'App', 1672063554, 1);















INSERT INTO `table_user` (`id`, `nama_user`, `email`, `password`, `role`, `last_login`, `created_at`, `updated_at`, `delete_at`) VALUES
(1, 'Admin', 'admin@gmail.com', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'administrator', '2022-12-26 08:16:10', '2022-12-26 08:16:10', '0000-00-00 00:00:00', NULL);



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;