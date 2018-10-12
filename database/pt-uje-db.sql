/*
SQLyog Professional v12.5.1 (64 bit)
MySQL - 10.1.36-MariaDB : Database - pt-uje-db
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`pt-uje-db` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `pt-uje-db`;

/*Table structure for table `tb_jalan` */

DROP TABLE IF EXISTS `tb_jalan`;

CREATE TABLE `tb_jalan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `kebun_id` int(11) NOT NULL,
  `pelabuhan_id` int(11) NOT NULL,
  `do_no` varchar(100) NOT NULL,
  `do_tanggal` date NOT NULL,
  `partai` int(11) NOT NULL,
  `jenis` enum('CPO') NOT NULL,
  `nominal` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK2` (`user_id`),
  KEY `FK3` (`kebun_id`),
  KEY `FK4` (`pelabuhan_id`),
  CONSTRAINT `FK2` FOREIGN KEY (`user_id`) REFERENCES `tb_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK3` FOREIGN KEY (`kebun_id`) REFERENCES `tb_kebun` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK4` FOREIGN KEY (`pelabuhan_id`) REFERENCES `tb_pelabuhan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_jalan` */

/*Table structure for table `tb_jalan_detail` */

DROP TABLE IF EXISTS `tb_jalan_detail`;

CREATE TABLE `tb_jalan_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jalan_id` int(11) NOT NULL,
  `mobil_id` int(11) NOT NULL,
  `tanggal_berangkat` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK5` (`jalan_id`),
  KEY `FK6` (`mobil_id`),
  CONSTRAINT `FK5` FOREIGN KEY (`jalan_id`) REFERENCES `tb_jalan` (`id`),
  CONSTRAINT `FK6` FOREIGN KEY (`mobil_id`) REFERENCES `tb_mobil` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_jalan_detail` */

/*Table structure for table `tb_kebun` */

DROP TABLE IF EXISTS `tb_kebun`;

CREATE TABLE `tb_kebun` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `telepon` varchar(13) NOT NULL,
  `email` varchar(50) NOT NULL,
  `toleransi` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_kebun` */

/*Table structure for table `tb_mobil` */

DROP TABLE IF EXISTS `tb_mobil`;

CREATE TABLE `tb_mobil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `supir_id` int(11) NOT NULL,
  `plate` varchar(10) NOT NULL,
  `merk` varchar(100) NOT NULL,
  `jenis` varchar(100) NOT NULL,
  `gross` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `foto` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK1` (`supir_id`),
  CONSTRAINT `FK1` FOREIGN KEY (`supir_id`) REFERENCES `tb_supir` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_mobil` */

/*Table structure for table `tb_pelabuhan` */

DROP TABLE IF EXISTS `tb_pelabuhan`;

CREATE TABLE `tb_pelabuhan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `telepon` varchar(13) NOT NULL,
  `email` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_pelabuhan` */

/*Table structure for table `tb_spb` */

DROP TABLE IF EXISTS `tb_spb`;

CREATE TABLE `tb_spb` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jalan_detail_id` int(11) NOT NULL,
  `muat_tanggal` date NOT NULL,
  `muat_total_muatan` int(11) NOT NULL,
  `muat_berat_keseluruhan` int(11) NOT NULL,
  `bongkar_tanggal` date NOT NULL,
  `bongkar_total_muatan` int(11) NOT NULL,
  `bongkar_berat_keseluruhan` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK7` (`jalan_detail_id`),
  CONSTRAINT `FK7` FOREIGN KEY (`jalan_detail_id`) REFERENCES `tb_jalan_detail` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_spb` */

/*Table structure for table `tb_supir` */

DROP TABLE IF EXISTS `tb_supir`;

CREATE TABLE `tb_supir` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `jenis_kelamin` enum('Pria','Wanita') NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` text NOT NULL,
  `telepon` varchar(13) NOT NULL,
  `ktp_no` varchar(16) NOT NULL,
  `ktp_img` varchar(100) NOT NULL,
  `sim_no` varchar(12) NOT NULL,
  `sim_img` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_supir` */

/*Table structure for table `tb_user` */

DROP TABLE IF EXISTS `tb_user`;

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `hak_akses` enum('Admin','Pimpinan') NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jenis_kelamin` enum('Pria','Wanita') NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` text NOT NULL,
  `telepon` varchar(13) NOT NULL,
  `foto` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_user` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
