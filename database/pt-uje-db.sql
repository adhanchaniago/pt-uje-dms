/*
SQLyog Ultimate v12.5.1 (32 bit)
MySQL - 10.1.31-MariaDB : Database - rsunandportaldb
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `artikel` */

DROP TABLE IF EXISTS `artikel`;

CREATE TABLE `artikel` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `desc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `isi` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `gambar` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `url` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `profil_id` int(10) unsigned NOT NULL,
  `kategori_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `artikel_title_index` (`title`),
  KEY `artikel_desc_index` (`desc`),
  KEY `artikel_status_index` (`status`),
  KEY `artikel_profil_id_index` (`profil_id`),
  KEY `artikel_kategori_id_index` (`kategori_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `artikel` */

/*Table structure for table `hak_akses` */

DROP TABLE IF EXISTS `hak_akses`;

CREATE TABLE `hak_akses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `hak_akses` */

insert  into `hak_akses`(`id`,`title`,`status`,`created_at`,`updated_at`) values 
(1,'WebMaster',1,'2018-07-21 13:11:09','2018-07-21 13:11:09'),
(2,'Manager',1,'2018-07-21 13:11:09','2018-07-21 13:11:09'),
(3,'Editor',1,'2018-07-21 13:11:09','2018-07-21 13:11:09'),
(4,'User',1,'2018-07-21 13:11:09','2018-07-21 13:11:09'),
(5,'Pasien',1,'2018-07-21 13:11:09','2018-07-21 13:11:09');

/*Table structure for table `karir` */

DROP TABLE IF EXISTS `karir`;

CREATE TABLE `karir` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `peminatan_id` int(10) unsigned NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ktp` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tmp_lahir` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jekel` enum('Pria','Wanita') COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('Menikah','Belum Menikah') COLLATE utf8_unicode_ci NOT NULL,
  `agama` enum('Islam','Katolik','Protestan','Hindu','Budha','Konghucu','Lain-lain') COLLATE utf8_unicode_ci NOT NULL,
  `suku` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `telepon` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8_unicode_ci NOT NULL,
  `sma_asal` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nilai_rata` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `univ_asal` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `jurusan` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nilai_ipk` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `no_str` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `th_str` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lampiran` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `karir_email_unique` (`email`),
  UNIQUE KEY `karir_ktp_unique` (`ktp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `karir` */

/*Table structure for table `kategori` */

DROP TABLE IF EXISTS `kategori`;

CREATE TABLE `kategori` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `desc` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gambar` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `hak_akses_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `kategori` */

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(1,'2014_10_12_000000_create_users_table',1),
(2,'2014_10_12_100000_create_password_resets_table',1),
(3,'2016_12_28_110132_create_profil_table',1),
(4,'2016_12_28_110208_create_artikel_table',1),
(5,'2016_12_28_110232_create_kategori_table',1),
(6,'2016_12_28_110302_create_search_table',1),
(7,'2016_12_28_123952_create_hak_akses_table',1),
(8,'2017_01_31_080421_create_karir_table',1),
(9,'2017_01_31_080726_create_peminatan_table',1),
(10,'2017_02_13_041518_create_user_activation',1);

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `pelatihan` */

DROP TABLE IF EXISTS `pelatihan`;

CREATE TABLE `pelatihan` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `karir_id` int(10) unsigned NOT NULL,
  `nm_pelatihan` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lks_pelatihan` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `th_pelatihan` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `pelatihan` */

/*Table structure for table `peminatan` */

DROP TABLE IF EXISTS `peminatan`;

CREATE TABLE `peminatan` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nm_peminatan` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `peminatan_nm_peminatan_unique` (`nm_peminatan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `peminatan` */

/*Table structure for table `pengalaman` */

DROP TABLE IF EXISTS `pengalaman`;

CREATE TABLE `pengalaman` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `karir_id` int(10) unsigned NOT NULL,
  `nm_perusahaan` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `jbtn_perusahaan` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lmkrj_perusahaan` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `pengalaman` */

/*Table structure for table `profil` */

DROP TABLE IF EXISTS `profil`;

CREATE TABLE `profil` (
  `id` int(10) unsigned NOT NULL,
  `idkaryawan` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nama` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `alamat` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tlp` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `foto` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activity` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `profil_email_unique` (`email`),
  KEY `profil_nama_index` (`nama`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `profil` */

insert  into `profil`(`id`,`idkaryawan`,`email`,`nama`,`alamat`,`tlp`,`foto`,`activity`,`created_at`,`updated_at`) values 
(1,NULL,'arifbetainsan@gmail.com','Arif Beta Insan','komp. Nuansa Indah F29 Cengkeh','081372440122',' ','developing system','2018-07-21 13:11:09','2018-07-21 13:11:09'),
(2,NULL,'amistaff@gmail.com','AMI Staff','Cendana Mata Air thp 8 no 4 Lubuk begalung','081372440122','logo2.png','monitoring sistem','2018-07-21 13:11:09','2018-07-21 13:11:09'),
(3,NULL,'manage@gmail.com','Manager','','08126757366','logo2.png','monitoring sistem','2018-07-21 13:11:09','2018-07-21 13:11:09'),
(4,NULL,'author@rsp.unand.ac.id','RS UNAND','','','rsunand.jpg','monitoring sistem','2018-07-21 13:11:09','2018-07-21 13:11:09');

/*Table structure for table `search` */

DROP TABLE IF EXISTS `search`;

CREATE TABLE `search` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `desc` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `post_at` datetime NOT NULL,
  `url` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `kategori_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `search_title_index` (`title`),
  KEY `search_desc_index` (`desc`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `search` */

/*Table structure for table `user_activation` */

DROP TABLE IF EXISTS `user_activation`;

CREATE TABLE `user_activation` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `user_activation` */

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `last_login` datetime NOT NULL,
  `hak_akses_id` int(10) unsigned NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`username`,`password`,`status`,`last_login`,`hak_akses_id`,`remember_token`,`created_at`,`updated_at`) values 
(1,'webmaster','$2y$10$2KkPGLlCFuPfwDLzcUXI8.67lHTGVCdENyMeLsMy/aQQgbD.pp24q',1,'2018-07-21 13:11:09',1,NULL,'2018-07-21 13:11:10','2018-07-21 13:11:10'),
(2,'teknisi','$2y$10$nT3YkXGZDpsJRc3X3kPHtO1ShNDWfZqoIH6fMugXS93Tv00vd4IVO',1,'2018-07-21 13:11:10',3,NULL,'2018-07-21 13:11:10','2018-07-21 13:11:10'),
(3,'Andaniekaputra','$2y$10$olb9U8r3GTdZZVJYQG9Fw.wkOaxLo370sLuJBX1uabCX.5UELvpuS',1,'2018-07-21 13:11:10',3,NULL,'2018-07-21 13:11:10','2018-07-21 13:11:10'),
(4,'author@rsp.unand.ac.id','$2y$10$6M4zYw46whweT0HmMqMWWuwnHntEACkRKYMG3Z137alWRiuVyY71K',1,'2018-07-21 13:11:10',3,NULL,'2018-07-21 13:11:10','2018-07-21 13:11:10');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
