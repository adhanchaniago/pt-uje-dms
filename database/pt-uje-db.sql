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
  `partai` float NOT NULL,
  `jenis` enum('CPO') NOT NULL,
  `nominal` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `dobel` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK2` (`user_id`),
  KEY `FK3` (`kebun_id`),
  KEY `FK4` (`pelabuhan_id`),
  CONSTRAINT `FK2` FOREIGN KEY (`user_id`) REFERENCES `tb_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK3` FOREIGN KEY (`kebun_id`) REFERENCES `tb_kebun` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK4` FOREIGN KEY (`pelabuhan_id`) REFERENCES `tb_pelabuhan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `tb_jalan` */

insert  into `tb_jalan`(`id`,`user_id`,`kebun_id`,`pelabuhan_id`,`do_no`,`do_tanggal`,`partai`,`jenis`,`nominal`,`status`,`dobel`) values 
(5,1,1,1,'PDG/DO/CPO/08/2018/USM-PSB','2018-11-06',70,'CPO',250,1,1),
(6,1,1,1,'PDG/DO/CPO/08/2018/USM-PSB','2018-11-06',70,'CPO',250,0,0);

/*Table structure for table `tb_jalan_detail` */

DROP TABLE IF EXISTS `tb_jalan_detail`;

CREATE TABLE `tb_jalan_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jalan_id` int(11) NOT NULL,
  `supir_mobil_id` int(11) NOT NULL,
  `tanggal_berangkat` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK5` (`jalan_id`),
  KEY `FK6` (`supir_mobil_id`),
  CONSTRAINT `FK20` FOREIGN KEY (`supir_mobil_id`) REFERENCES `tb_supir_mobil` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK5` FOREIGN KEY (`jalan_id`) REFERENCES `tb_jalan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

/*Data for the table `tb_jalan_detail` */

insert  into `tb_jalan_detail`(`id`,`jalan_id`,`supir_mobil_id`,`tanggal_berangkat`) values 
(14,5,9,'2018-11-07'),
(15,5,6,'2018-11-07'),
(16,5,4,'2018-11-07'),
(17,6,4,'2018-11-11');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tb_kebun` */

insert  into `tb_kebun`(`id`,`nama`,`alamat`,`telepon`,`email`,`toleransi`) values 
(1,'PT. AGRO MUKO','Bank Sumut Building, Lt.7, Jl. Imam Bonjol No. 18, Madras Hulu, Medan, Sumatera Utara','(061) 4152043','agromuko@gmail.com',0.2);

/*Table structure for table `tb_kendala` */

DROP TABLE IF EXISTS `tb_kendala`;

CREATE TABLE `tb_kendala` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bon_no` varchar(50) NOT NULL DEFAULT '-',
  `supir_mobil_id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `kendala` enum('ban','benen','baut roda','oli','selendang') NOT NULL,
  `biaya` int(11) NOT NULL,
  `keterangan` varchar(100) DEFAULT '-',
  PRIMARY KEY (`id`),
  KEY `FF99` (`supir_mobil_id`),
  CONSTRAINT `FF99` FOREIGN KEY (`supir_mobil_id`) REFERENCES `tb_supir_mobil` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `tb_kendala` */

insert  into `tb_kendala`(`id`,`bon_no`,`supir_mobil_id`,`tanggal`,`kendala`,`biaya`,`keterangan`) values 
(2,'-',4,'2018-10-30','oli',200000,'-'),
(3,'-',4,'2018-10-30','ban',3000000,'-'),
(4,'-',9,'2018-10-30','oli',150000,'-');

/*Table structure for table `tb_mobil` */

DROP TABLE IF EXISTS `tb_mobil`;

CREATE TABLE `tb_mobil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `plate` varchar(10) NOT NULL,
  `merk` varchar(100) NOT NULL,
  `jenis` varchar(100) NOT NULL,
  `gross` int(11) NOT NULL,
  `foto` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `tb_mobil` */

insert  into `tb_mobil`(`id`,`plate`,`merk`,`jenis`,`gross`,`foto`) values 
(2,'BA8514OU','TRUCK ISUZU','FVR 34 P',21500,'113b62c77ca4df2e0fa0.jpg'),
(3,'BA8525ZU','TRUCK NISSAN','CKA 12 H',18000,'b308c023345bd37d7704.jpg'),
(4,'BA8646AO','LIGHT TRUCK HINO','WU342R-HKMTJD3',17500,'1d008da989849643873c.jpg'),
(5,'BA8762AO','TRUCK NISSAN','CKA 87 H',18000,'96f50a7ac2d86749741d.jpg'),
(6,'BA9259AO','TRUCK ISUZU','FYZ 34 T',31000,'6a82ef987bfcdd80c39c.jpg'),
(8,'BA1111AO','TRUCK NISSAN','FVR 34 P',31000,'db0731021570fdf44d44.jpg'),
(9,'ba89789hg','hggjhg','jk',8767,'60d49db19dbafb089062.jpg');

/*Table structure for table `tb_pelabuhan` */

DROP TABLE IF EXISTS `tb_pelabuhan`;

CREATE TABLE `tb_pelabuhan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `telepon` varchar(13) NOT NULL,
  `email` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tb_pelabuhan` */

insert  into `tb_pelabuhan`(`id`,`nama`,`alamat`,`telepon`,`email`) values 
(1,'Port Of Teluk Bayur','Jalan Semarang No. 3 Teluk Bayur, Padang','081267131602','telukbayur@gmail.com');

/*Table structure for table `tb_spb` */

DROP TABLE IF EXISTS `tb_spb`;

CREATE TABLE `tb_spb` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jalan_detail_id` int(11) NOT NULL,
  `muat_no_spb` varchar(50) NOT NULL,
  `muat_tanggal` date NOT NULL,
  `muat_total_muatan` int(11) NOT NULL,
  `muat_berat_keseluruhan` int(11) NOT NULL,
  `bongkar_no_spb` varchar(50) NOT NULL,
  `bongkar_tanggal` date NOT NULL,
  `bongkar_total_muatan` int(11) NOT NULL,
  `bongkar_berat_keseluruhan` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK7` (`jalan_detail_id`),
  CONSTRAINT `FK7` FOREIGN KEY (`jalan_detail_id`) REFERENCES `tb_jalan_detail` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

/*Data for the table `tb_spb` */

insert  into `tb_spb`(`id`,`jalan_detail_id`,`muat_no_spb`,`muat_tanggal`,`muat_total_muatan`,`muat_berat_keseluruhan`,`bongkar_no_spb`,`bongkar_tanggal`,`bongkar_total_muatan`,`bongkar_berat_keseluruhan`) values 
(15,14,' 45/1/HHH/2018','2018-11-07',20000,30000,' 47/1/HHH/2018','2018-11-10',19000,29000),
(16,15,' 45/1/HHH/2018','2018-11-07',20000,30000,' 47/1/HHH/2018','2018-11-10',19000,29000),
(17,16,' 45/1/HHH/2018','2018-11-07',20000,30000,' 47/1/HHH/2018','2018-11-10',19000,29000);

/*Table structure for table `tb_supir` */

DROP TABLE IF EXISTS `tb_supir`;

CREATE TABLE `tb_supir` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `jenis_kelamin` enum('pria','wanita') NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` text NOT NULL,
  `telepon` varchar(13) NOT NULL,
  `ktp_no` varchar(16) NOT NULL,
  `ktp_img` varchar(100) NOT NULL,
  `sim_no` varchar(12) NOT NULL,
  `sim_img` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `tb_supir` */

insert  into `tb_supir`(`id`,`nama`,`jenis_kelamin`,`tempat_lahir`,`tanggal_lahir`,`alamat`,`telepon`,`ktp_no`,`ktp_img`,`sim_no`,`sim_img`) values 
(2,'Hendri','pria','Padang','1967-09-06','Jl. Belawan No. 14 Kampung Baru Tl. Bayur Padang','081372259425','1305021009720001','65861904ad7c6e135c93.jpg','670908140037','65861904ad7c6e135c93.jpg'),
(4,'Helmi Yanto Sofyan','pria','Tanjung Alam','1979-10-13','Marga Jaya RT. 001 RW. 001 Meraksa Aji Tulang Bawang','081345612145','1371111310790011','e58e3172f9a57c7d748c.jpg','791025320161','e58e3172f9a57c7d748c.jpg'),
(6,'Zulkifli','pria','Sungai Penuh','1958-04-23','Jl. Adinegoro RT. 002 RW. 001 Lubuk Buaya Padang','081378946549','1371112304580001','094a8613b2d69411314c.jpg','580408140565','094a8613b2d69411314c.jpg');

/*Table structure for table `tb_supir_mobil` */

DROP TABLE IF EXISTS `tb_supir_mobil`;

CREATE TABLE `tb_supir_mobil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `supir_id` int(11) NOT NULL,
  `mobil_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK15` (`supir_id`),
  KEY `FK16` (`mobil_id`),
  CONSTRAINT `FK15` FOREIGN KEY (`supir_id`) REFERENCES `tb_supir` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK16` FOREIGN KEY (`mobil_id`) REFERENCES `tb_mobil` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `tb_supir_mobil` */

insert  into `tb_supir_mobil`(`id`,`supir_id`,`mobil_id`,`status`) values 
(4,2,2,1),
(6,4,4,0),
(9,6,6,0);

/*Table structure for table `tb_user` */

DROP TABLE IF EXISTS `tb_user`;

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `hak_akses` enum('admin','pimpinan') NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `nama` varchar(100) NOT NULL,
  `jenis_kelamin` enum('pria','wanita') NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` text NOT NULL,
  `telepon` varchar(13) NOT NULL,
  `foto` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `tb_user` */

insert  into `tb_user`(`id`,`username`,`password`,`hak_akses`,`status`,`nama`,`jenis_kelamin`,`tempat_lahir`,`tanggal_lahir`,`alamat`,`telepon`,`foto`) values 
(1,'admin','21232f297a57a5a743894a0e4a801fc3','admin',1,'Fransiska Karina','wanita','Padang','1985-07-18','Padang','081212344321','09c2e3b5209cbc0b8dce.jpg'),
(2,'pimpinan','90973652b88fe07d05a4304f0a945de8','pimpinan',1,'Budi Harianto','pria','Padang','1979-08-21','Padang','081345671245','default.png');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
