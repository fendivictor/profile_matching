/*
SQLyog Professional v12.5.1 (64 bit)
MySQL - 10.5.8-MariaDB : Database - spk_profile_matching
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `gap` */

DROP TABLE IF EXISTS `gap`;

CREATE TABLE `gap` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gap` double DEFAULT 0,
  `bobot` double DEFAULT 0,
  `keterangan` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `gap` */

insert  into `gap`(`id`,`gap`,`bobot`,`keterangan`) values 
(1,0,5,'Tidak Ada Selisih (kompetensi sesuai dengan yang dibutuhkan)'),
(2,1,4.5,'Kompetensi individu kelebihan 1 tingkat/level'),
(3,-1,4,'Kompetensi individu kekurangan 1 tingkat/level'),
(4,2,3.5,'Kompetensi individu kelebihan 2 tingkat/level'),
(5,-2,3,'Kompetensi individu kekurangan 2 tingkat/level'),
(6,3,2.5,'Kompetensi individu kelebihan 3 tingkat/level'),
(7,-3,2,'Kompetensi individu kekurangan 3 tingkat/level'),
(8,4,1.5,'Kompetensi individu kelebihan 4 tingkat/level'),
(9,-4,1,'Kompetensi individu kekurangan 4 tingkat/level');

/*Table structure for table `jenis_kriteria` */

DROP TABLE IF EXISTS `jenis_kriteria`;

CREATE TABLE `jenis_kriteria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jenis` varchar(30) DEFAULT '',
  `nilai_factor` double DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `jenis_kriteria` */

insert  into `jenis_kriteria`(`id`,`jenis`,`nilai_factor`) values 
(1,'Core Factor',60),
(2,'Secondary Factor',40);

/*Table structure for table `kriteria` */

DROP TABLE IF EXISTS `kriteria`;

CREATE TABLE `kriteria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_jenis_kriteria` int(11) DEFAULT NULL,
  `kriteria` varchar(30) DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `id_jenis_kriteria` (`id_jenis_kriteria`),
  CONSTRAINT `kriteria_ibfk_1` FOREIGN KEY (`id_jenis_kriteria`) REFERENCES `jenis_kriteria` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `kriteria` */

insert  into `kriteria`(`id`,`id_jenis_kriteria`,`kriteria`) values 
(1,1,'Nilai Akademik'),
(2,1,'Karya Siswa'),
(3,2,'Bahasa Inggris'),
(5,2,'Ekstra Kulikuler');

/*Table structure for table `level_user` */

DROP TABLE IF EXISTS `level_user`;

CREATE TABLE `level_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `level` varchar(20) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `level_user` */

insert  into `level_user`(`id`,`level`) values 
(1,'Admin'),
(2,'Kepala Sekolah');

/*Table structure for table `penilaian` */

DROP TABLE IF EXISTS `penilaian`;

CREATE TABLE `penilaian` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_siswa` int(11) DEFAULT NULL,
  `id_kriteria` int(11) DEFAULT NULL,
  `nilai` double DEFAULT 0,
  `nilai_profile` double DEFAULT 0,
  `nilai_ideal` double DEFAULT 0,
  `gap` double DEFAULT 0,
  `bobot` double DEFAULT 0,
  `nilai_factor` double DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `id_siswa` (`id_siswa`),
  KEY `id_kriteria` (`id_kriteria`),
  CONSTRAINT `penilaian_ibfk_1` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `penilaian_ibfk_2` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;

/*Data for the table `penilaian` */

insert  into `penilaian`(`id`,`id_siswa`,`id_kriteria`,`nilai`,`nilai_profile`,`nilai_ideal`,`gap`,`bobot`,`nilai_factor`) values 
(29,6,1,95,3,3,0,5,60),
(30,6,2,88,3,2,1,4.5,60),
(31,6,3,76,2,3,-1,4,40),
(32,6,5,1,1,2,-1,4,40),
(33,2,1,83,2,3,-1,4,60),
(34,2,2,0,1,2,-1,4,60),
(35,2,3,90,3,3,0,5,40),
(36,2,5,5,3,2,1,4.5,40),
(37,5,1,100,3,3,0,5,60),
(38,5,2,90,3,2,1,4.5,60),
(39,5,3,98,3,3,0,5,40),
(40,5,5,4,3,2,1,4.5,40),
(41,7,1,75,1,3,-2,3,60),
(42,7,2,0,1,2,-1,4,60),
(43,7,3,65,2,3,-1,4,40),
(44,7,5,0,1,2,-1,4,40),
(45,6326,1,77,1,3,-2,3,60),
(46,6326,2,0,1,2,-1,4,60),
(47,6326,3,80,3,3,0,5,40),
(48,6326,5,0,1,2,-1,4,40);

/*Table structure for table `profil_standar` */

DROP TABLE IF EXISTS `profil_standar`;

CREATE TABLE `profil_standar` (
  `id_kriteria` int(11) NOT NULL,
  `id_sub_kriteria` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_kriteria`),
  KEY `id_sub_kriteria` (`id_sub_kriteria`),
  CONSTRAINT `profil_standar_ibfk_1` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `profil_standar_ibfk_2` FOREIGN KEY (`id_sub_kriteria`) REFERENCES `sub_kriteria` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `profil_standar` */

insert  into `profil_standar`(`id_kriteria`,`id_sub_kriteria`) values 
(1,1),
(2,7),
(3,9),
(5,13);

/*Table structure for table `siswa` */

DROP TABLE IF EXISTS `siswa`;

CREATE TABLE `siswa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(60) DEFAULT '',
  `email` varchar(60) DEFAULT '',
  `password` varchar(60) DEFAULT '',
  `telepon` varchar(20) DEFAULT '',
  `alamat` text DEFAULT NULL,
  `verifikasi` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6329 DEFAULT CHARSET=latin1;

/*Data for the table `siswa` */

insert  into `siswa`(`id`,`nama`,`email`,`password`,`telepon`,`alamat`,`verifikasi`) values 
(2,'Kiranah','','','',NULL,1),
(4,'savra','','','',NULL,1),
(5,'Uus Wati','','','',NULL,1),
(6,'savra','','','',NULL,1),
(7,'muhammad savra','','','',NULL,1),
(9,'Victor','admin@gmail.com','81dc9bdb52d04dc20036dbd8313ed055','08156647203','Pedawang RT3 RW3 No.560',0),
(6326,'Budi','','','',NULL,1),
(6328,'Victor','fendivictor@gmail.com','9996535e07258a7bbfd8b132435c5962','08156647203','Pedawang RT3 RW3 No.560',1);

/*Table structure for table `sub_kriteria` */

DROP TABLE IF EXISTS `sub_kriteria`;

CREATE TABLE `sub_kriteria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_kriteria` int(11) DEFAULT NULL,
  `sub_kriteria` varchar(60) DEFAULT '',
  `operator` enum('DIANTARA','KURANG DARI','KURANG DARI SAMA DENGAN','LEBIH DARI','LEBIH DARI SAMA DENGAN','SAMA DENGAN') DEFAULT NULL,
  `nilai_1` double DEFAULT 0,
  `nilai_2` double DEFAULT 0,
  `nilai_profile` double DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `id_kriteria` (`id_kriteria`),
  CONSTRAINT `sub_kriteria_ibfk_1` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

/*Data for the table `sub_kriteria` */

insert  into `sub_kriteria`(`id`,`id_kriteria`,`sub_kriteria`,`operator`,`nilai_1`,`nilai_2`,`nilai_profile`) values 
(1,1,'91 – 100','DIANTARA',91,100,3),
(2,1,'81 – 90','DIANTARA',81,90,2),
(3,1,'71 - 80','DIANTARA',71,80,1),
(4,2,'Jika skor >= 80','LEBIH DARI SAMA DENGAN',80,0,3),
(7,2,'Jika skor >= 50 && skor <= 79','DIANTARA',50,79,2),
(8,2,'Jika skor < 50','KURANG DARI',50,0,1),
(9,3,'Jika skor >= 80','LEBIH DARI SAMA DENGAN',80,0,3),
(10,3,'Jika skor >= 50 && skor <= 79','DIANTARA',50,79,2),
(11,3,'Jika skor < 50','KURANG DARI',50,0,1),
(12,5,'Jumlah prestasi >= 4','LEBIH DARI SAMA DENGAN',4,0,3),
(13,5,'Jumlah prestasi >= 2 && prestasi <= 3','DIANTARA',2,3,2),
(14,5,'Jumlah prestasi < 2','KURANG DARI',2,0,1);

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_level_user` int(11) DEFAULT NULL,
  `username` varchar(30) DEFAULT '',
  `password` varchar(60) DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `id_level_user` (`id_level_user`),
  CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_level_user`) REFERENCES `level_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `user` */

insert  into `user`(`id`,`id_level_user`,`username`,`password`) values 
(1,1,'admin','81dc9bdb52d04dc20036dbd8313ed055');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
