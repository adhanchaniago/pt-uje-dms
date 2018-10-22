/*
SQLyog Ultimate v12.5.1 (32 bit)
MySQL - 10.1.31-MariaDB : Database - pt-uje-db
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
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
  `status` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK2` (`user_id`),
  KEY `FK3` (`kebun_id`),
  KEY `FK4` (`pelabuhan_id`),
  CONSTRAINT `FK2` FOREIGN KEY (`user_id`) REFERENCES `tb_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK3` FOREIGN KEY (`kebun_id`) REFERENCES `tb_kebun` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK4` FOREIGN KEY (`pelabuhan_id`) REFERENCES `tb_pelabuhan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tb_jalan` */

insert  into `tb_jalan`(`id`,`user_id`,`kebun_id`,`pelabuhan_id`,`do_no`,`do_tanggal`,`partai`,`jenis`,`nominal`,`status`) values 
(3,1,1,1,'PDG/DO/CPO/08/2018/USM-PSB','2018-10-08',70000,'CPO',2500,1),
(4,1,1,1,'PDG/DO/CPO/10/2018/USM-PSB','2018-10-19',70000,'CPO',2500,0);

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Data for the table `tb_jalan_detail` */

insert  into `tb_jalan_detail`(`id`,`jalan_id`,`mobil_id`,`tanggal_berangkat`) values 
(7,3,2,'2018-10-18'),
(8,3,5,'2018-10-18'),
(9,3,6,'2018-10-18'),
(10,4,3,'2018-10-20'),
(11,4,5,'2018-10-20'),
(12,4,6,'2018-10-20');

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `tb_mobil` */

insert  into `tb_mobil`(`id`,`supir_id`,`plate`,`merk`,`jenis`,`gross`,`status`,`foto`) values 
(1,1,'BA8397QU','TRUCK HINO','FG8JKKB-GGJL',18800,0,'a9467b299c83240a7207.jpg'),
(2,2,'BA8514OU','TRUCK ISUZU','FVR 34 P',21500,0,'113b62c77ca4df2e0fa0.jpg'),
(3,3,'BA8525ZU','TRUCK NISSAN','CKA 12 H',18000,1,'b308c023345bd37d7704.jpg'),
(4,4,'BA8646AO','LIGHT TRUCK HINO','WU342R-HKMTJD3',17500,0,'1d008da989849643873c.jpg'),
(5,5,'BA8762AO','TRUCK NISSAN','CKA 87 H',18000,1,'96f50a7ac2d86749741d.jpg'),
(6,6,'BA9259AO','TRUCK ISUZU','FYZ 34 T',31000,1,'6a82ef987bfcdd80c39c.jpg');

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
  `muat_tanggal` date NOT NULL,
  `muat_total_muatan` int(11) NOT NULL,
  `muat_berat_keseluruhan` int(11) NOT NULL,
  `bongkar_tanggal` date NOT NULL,
  `bongkar_total_muatan` int(11) NOT NULL,
  `bongkar_berat_keseluruhan` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK7` (`jalan_detail_id`),
  CONSTRAINT `FK7` FOREIGN KEY (`jalan_detail_id`) REFERENCES `tb_jalan_detail` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `tb_spb` */

insert  into `tb_spb`(`id`,`jalan_detail_id`,`muat_tanggal`,`muat_total_muatan`,`muat_berat_keseluruhan`,`bongkar_tanggal`,`bongkar_total_muatan`,`bongkar_berat_keseluruhan`) values 
(5,7,'2018-10-19',17690,26250,'2018-10-30',17640,26130),
(6,8,'2018-10-19',17720,24670,'2018-10-30',17660,24740),
(7,9,'2018-10-19',18140,25390,'2018-10-30',18070,25280),
(8,10,'2018-10-22',17640,26130,'2018-10-25',17500,26250),
(9,11,'2018-10-22',17640,24740,'2018-10-26',17500,24670),
(10,12,'2018-10-22',17640,25280,'2018-10-26',17500,25390);

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
(1,'Zulfikar','pria','Padang','1973-04-20','KP. Kelawi RT. 005 RW. VI Padang','081212341234','1371091607730004','0324b7614f58876a972f.jpg','730408141784','0324b7614f58876a972f.jpg'),
(2,'Hendri','pria','Padang','1967-09-06','Jl. Belawan No. 14 Kampung Baru Tl. Bayur Padang','081372259425','1305021009720001','65861904ad7c6e135c93.jpg','670908140037','65861904ad7c6e135c93.jpg'),
(3,'Suardi M','pria','Binuang','1970-04-21','Binuang Kampuang Dalam No. 6 RT. 005 RW. 002 Pauh Padang','081267135533','1371082104700004','d684746fa0b1ceae9ee2.jpg','700408140060','d684746fa0b1ceae9ee2.jpg'),
(4,'Helmi Yanto Sofyan','pria','Tanjung Alam','1979-10-13','Marga Jaya RT. 001 RW. 001 Meraksa Aji Tulang Bawang','081345612145','1371111310790011','e58e3172f9a57c7d748c.jpg','791025320161','e58e3172f9a57c7d748c.jpg'),
(5,'Oyon Riza','pria','Sungai Penuh','1958-07-12','Kel. Sungai Beremas RT. 003 RW. 007 Gates Lubeg Padang','082385748484','1371061207580005','d757088cc4384bb33a9d.jpg','580708140322','d757088cc4384bb33a9d.jpg'),
(6,'Zulkifli','pria','Sungai Penuh','1958-04-23','Jl. Adinegoro RT. 002 RW. 001 Lubuk Buaya Padang','081378946549','1371112304580001','094a8613b2d69411314c.jpg','580408140565','094a8613b2d69411314c.jpg');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tb_user` */

insert  into `tb_user`(`id`,`username`,`password`,`hak_akses`,`status`,`nama`,`jenis_kelamin`,`tempat_lahir`,`tanggal_lahir`,`alamat`,`telepon`,`foto`) values 
(1,'admin','21232f297a57a5a743894a0e4a801fc3','admin',1,'Fransiska Karina','wanita','Padang','1985-07-18','Padang','081212344321','09c2e3b5209cbc0b8dce.jpg');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
