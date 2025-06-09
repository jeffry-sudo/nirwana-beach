-- MariaDB dump 10.19  Distrib 10.5.22-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: parkir
-- ------------------------------------------------------
-- Server version	10.5.22-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `tbl_admin`
--

DROP TABLE IF EXISTS `tbl_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_admin` (
  `kd_admin` varchar(50) NOT NULL,
  `username_admin` varchar(50) NOT NULL,
  `password_admin` varchar(256) NOT NULL,
  `nama_admin` varchar(100) DEFAULT NULL,
  `email_admin` varchar(50) DEFAULT NULL,
  `no_hp_admin` varchar(50) DEFAULT NULL,
  `img_admin` varchar(256) DEFAULT NULL,
  `level_admin` int(11) DEFAULT NULL,
  `create_date_admin` datetime DEFAULT NULL,
  PRIMARY KEY (`kd_admin`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_admin`
--

LOCK TABLES `tbl_admin` WRITE;
/*!40000 ALTER TABLE `tbl_admin` DISABLE KEYS */;
INSERT INTO `tbl_admin` VALUES ('A001','jeffry','$2y$10$2PEToBltjSYF859hzaFBNOdOrVXcxf.eF0jJl1ywSm3vPnolgIH9m','Jeffry Hanafi','jeffry@nirwana.com','08111111','assets/dist/img/default.png',1,'2025-01-31 12:34:51'),('A002','kaharode','$2y$10$2PEToBltjSYF859hzaFBNOdOrVXcxf.eF0jJl1ywSm3vPnolgIH9m','La Ode Kaharuddin','laodekaharuddin651@gmail.com','085215414285','assets/dist/img/default.png',1,'2025-01-31 10:43:58'),('A009','petugas_parkir','$2y$10$Qr1ao8CM5t.qH7WYzNVuO.MML0vYumIsvpGAmbZjX3upokF5Q9dui','Petugas Parkir','petugas.parkir@nirwana.com','1111111','assets/dist/img/default.png',3,'0000-00-00 00:00:00'),('A010','penjaga','$2y$10$GQgfOTEqCabarvWiTC9dO.7.nj5fjsELAeGdrEjo43al8x4iYMRO.','penjaga palang','penjaga@gmail.com','2222222222222','assets/dist/img/default.png',2,'0000-00-00 00:00:00'),('A011','adihar','$2y$10$vIrAJLbzdlivbwhfvs5/SemhUUYhvtb7ASPQj5BRMFYVd47aB6QZe','La Ode Adihar','laodekaharuddin651@gmail.com','082190500755','assets/dist/img/default.png',2,'0000-00-00 00:00:00'),('A012','dafid','$2y$10$oybqUrmcajvAe3cQ6HnJFeHmus6y73/QM5TcNqOiK7q2F7stH1chm','La Ode Muh. Warda hafid','laodekaharuddin651@gmail.com','085341527745','assets/dist/img/default.png',2,'0000-00-00 00:00:00'),('A013','endang','$2y$10$dXV5Oa.HzwcPXuLeMnU8Ye/.V2bBDaNuCk.D7AIpUu6VGfrs54dSm','Rendra','laodekaharuddin651@gmail.com','081377170746','assets/dist/img/default.png',3,'0000-00-00 00:00:00'),('A014','azhar','$2y$10$iZR9NTW5bPnuTBefzq2ds.l.nKNzPkx6qO0.g7XxgZNVkRtN53VB6','La Ode Azhar','laodekaharuddin651@gmail.com','085395661691','assets/dist/img/default.png',2,'0000-00-00 00:00:00'),('A015','andika','$2y$10$qSi.KVZuyYzlghLfjXCna.r2A2FU/76T8toMVDKaPd78rEYvGJBmO','La Ode Upin','laodekaharuddin651@gmail.com','082147961561','assets/dist/img/default.png',3,'0000-00-00 00:00:00'),('A016','pengawas','$2y$10$OvYp/QP99wTk1Mlfeho0sONJ0Y8Cso1lAwtCB64sNcdynfWjt.ir2','pengawas','pengawas@nirwana.com','11111','assets/dist/img/default.png',4,'2025-01-31 09:31:40'),('A017','lutan','$2y$10$DWDQbSwL.0IH/bwwRKfuZ.AOp5zN8YHbkf15UJtfdBxUmNszZzDCi','Lutan','laodekaharuddin651@gmail.com','085215414285','assets/dist/img/default.png',3,'2025-03-12 11:06:23');
/*!40000 ALTER TABLE `tbl_admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_keluar`
--

DROP TABLE IF EXISTS `tbl_keluar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_keluar` (
  `kd_keluar` varchar(50) NOT NULL,
  `kd_masuk` varchar(50) DEFAULT NULL,
  `kd_member` varchar(50) DEFAULT NULL,
  `tgl_jam_masuk` datetime DEFAULT NULL,
  `tgl_jam_keluar` datetime DEFAULT NULL,
  `lama_parkir_keluar` varchar(50) DEFAULT NULL,
  `tarif_keluar` int(11) DEFAULT NULL,
  `total_keluar` int(11) DEFAULT NULL,
  `status_keluar` int(11) DEFAULT NULL,
  `create_keluar` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`kd_keluar`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_keluar`
--

LOCK TABLES `tbl_keluar` WRITE;
/*!40000 ALTER TABLE `tbl_keluar` DISABLE KEYS */;
INSERT INTO `tbl_keluar` VALUES ('K00000001','MG00000004','NULL','2025-01-31 10:45:11','2025-01-31 11:04:52','0 Jam,19 Menit',3000,45000,1,'Petugas Parkir'),('K00000002','MG00000005','NULL','2025-01-31 10:46:45','2025-01-31 12:01:05','1 Jam,14 Menit',3000,6000,1,'Petugas Parkir'),('K00000003','MG00000003','NULL','2025-01-31 10:44:48','2025-01-31 13:29:51','2 Jam,45 Menit',5000,50000,1,'Rendra'),('K00000004','MG00000010','NULL','2025-02-02 03:37:51','2025-02-02 15:32:00','11 Jam,54 Menit',3000,3000,1,'Jeffry Hanafi'),('K00000005','MG00000033','NULL','2025-02-04 20:50:26','2025-02-04 21:33:11','0 Jam,42 Menit',3000,6000,1,'Rendra'),('K00000006','MG00000037','NULL','2025-02-04 21:19:22','2025-02-04 21:43:21','0 Jam,23 Menit',5000,5000,1,'La Ode Kaharuddin'),('K00000007','MG00000032','NULL','2025-02-04 20:46:16','2025-02-04 21:43:56','0 Jam,57 Menit',5000,5000,1,'La Ode Kaharuddin'),('K00000008','Mg00000044','NULL','2025-02-05 04:54:11','2025-02-05 05:00:21','0 Jam,6 Menit',5000,5000,1,'La Ode Kaharuddin');
/*!40000 ALTER TABLE `tbl_keluar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_kendaraan`
--

DROP TABLE IF EXISTS `tbl_kendaraan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_kendaraan` (
  `kd_kendaraan` varchar(50) NOT NULL,
  `nama_kendaraan` varchar(50) DEFAULT NULL,
  `harga_kendaraan` int(11) DEFAULT NULL,
  `jenis_kendaraan` int(11) NOT NULL,
  `create_by_kendaraan` varchar(50) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`kd_kendaraan`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_kendaraan`
--

LOCK TABLES `tbl_kendaraan` WRITE;
/*!40000 ALTER TABLE `tbl_kendaraan` DISABLE KEYS */;
INSERT INTO `tbl_kendaraan` VALUES ('JK001','Motor',3000,1,'owner','2025-01-24 13:28:44'),('JK002','mobil',5000,1,'owner','2025-01-24 13:35:37'),('JK003','Pejalan Kaki',2000,1,'admin','2025-01-24 13:47:33');
/*!40000 ALTER TABLE `tbl_kendaraan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_masuk`
--

DROP TABLE IF EXISTS `tbl_masuk`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_masuk` (
  `kd_masuk` varchar(50) NOT NULL,
  `kd_member` varchar(50) NOT NULL,
  `kd_kendaraan` varchar(50) DEFAULT NULL,
  `plat_masuk` varchar(50) DEFAULT NULL,
  `tgl_masuk` datetime DEFAULT NULL,
  `status_masuk` int(11) DEFAULT NULL,
  `create_masuk` varchar(50) DEFAULT NULL,
  `jml_org` varchar(50) DEFAULT NULL,
  `kd_admin` varchar(50) DEFAULT NULL,
  `status_karcis` int(11) DEFAULT NULL,
  PRIMARY KEY (`kd_masuk`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_masuk`
--

LOCK TABLES `tbl_masuk` WRITE;
/*!40000 ALTER TABLE `tbl_masuk` DISABLE KEYS */;
INSERT INTO `tbl_masuk` VALUES ('MG00000001','NULL','JK002','DT  ','2025-01-31 09:33:58',1,'La Ode Adihar','5',NULL,1),('MG00000002','NULL','JK001','DT  ','2025-01-31 10:03:32',1,'La Ode Adihar','2','A013',1),('MG00000003','NULL','JK002','DT  ','2025-01-31 10:44:48',2,'La Ode Azhar','10','A013',1),('MG00000004','NULL','JK001','DT  ','2025-01-31 10:45:11',2,'La Ode Azhar','15','A009',1),('MG00000005','NULL','JK001','DT  ','2025-01-31 10:46:45',2,'La Ode Adihar','2','A009',1),('MG00000006','NULL','JK001','DT  ','2025-01-31 17:55:45',1,'La Ode Adihar','2',NULL,1),('MG00000007','NULL','JK001','DT  ','2025-02-01 21:41:05',1,'Jeffry Hanafi','1',NULL,NULL),('MG00000008','NULL','JK003','DT  ','2025-02-01 21:41:46',1,'Jeffry Hanafi','1',NULL,NULL),('MG00000009','NULL','JK002','DT  ','2025-02-02 03:16:42',1,'La Ode Kaharuddin','10',NULL,NULL),('MG00000010','NULL','JK001','DT  ','2025-02-02 03:37:51',2,'La Ode Adihar','1','A001',1),('MG00000011','NULL','JK001','DT  ','2025-02-02 03:38:32',1,'La Ode Adihar','2',NULL,1),('MG00000012','NULL','JK002','DT  ','2025-02-02 03:39:41',1,'La Ode Kaharuddin','13',NULL,1),('MG00000013','NULL','JK002','DT  ','2025-02-02 03:40:11',1,'La Ode Kaharuddin','1',NULL,NULL),('MG00000014','NULL','JK003','DT  ','2025-02-02 03:40:26',1,'La Ode Adihar','1',NULL,NULL),('MG00000015','NULL','JK001','DT  ','2025-02-02 03:40:59',1,'La Ode Adihar','2',NULL,NULL),('MG00000016','NULL','JK002','DT  ','2025-02-02 03:41:46',1,'La Ode Kaharuddin','6',NULL,NULL),('MG00000017','NULL','JK002','DT  ','2025-02-02 03:45:14',1,'La Ode Azhar','3',NULL,NULL),('MG00000018','NULL','JK001','DT  ','2025-02-02 03:45:24',1,'La Ode Azhar','1',NULL,1),('MG00000019','NULL','JK001','DT  ','2025-02-04 18:53:36',1,'La Ode Kaharuddin','2',NULL,1),('MG00000020','NULL','JK001','DT  ','2025-02-04 19:19:22',1,'La Ode Kaharuddin','3',NULL,1),('MG00000021','NULL','JK002','DT  ','2025-02-04 19:23:52',1,'La Ode Kaharuddin','1',NULL,1),('MG00000022','NULL','JK003','DT  ','2025-02-04 19:53:16',1,'La Ode Kaharuddin','6',NULL,1),('MG00000023','NULL','JK002','DT  ','2025-02-04 19:55:36',1,'La Ode Kaharuddin','1',NULL,1),('MG00000024','NULL','JK002','DT  ','2025-02-04 20:04:55',1,'La Ode Kaharuddin','1',NULL,1),('MG00000025','NULL','JK002','DT  ','2025-02-04 20:06:25',1,'La Ode Kaharuddin','12',NULL,1),('MG00000026','NULL','JK002','DT  ','2025-02-04 20:13:53',1,'La Ode Kaharuddin','1',NULL,1),('MG00000027','NULL','JK003','DT  ','2025-02-04 20:14:30',1,'La Ode Kaharuddin','1',NULL,1),('MG00000028','NULL','JK002','DT  ','2025-02-04 20:18:00',1,'La Ode Kaharuddin','14',NULL,1),('MG00000029','NULL','JK001','DT  ','2025-02-04 20:21:47',1,'La Ode Kaharuddin','1',NULL,1),('MG00000030','NULL','JK001','DT  ','2025-02-04 20:40:22',1,'La Ode Kaharuddin','1',NULL,1),('MG00000031','NULL','JK002','DT  ','2025-02-04 20:45:40',1,'La Ode Kaharuddin','1',NULL,1),('MG00000032','NULL','JK002','DT  ','2025-02-04 20:46:16',2,'La Ode Kaharuddin','1','A002',1),('MG00000033','NULL','JK001','DT  ','2025-02-04 20:50:26',2,'La Ode Kaharuddin','2','A013',1),('MG00000034','NULL','JK002','DT  ','2025-02-04 20:57:57',1,'La Ode Kaharuddin','5',NULL,1),('MG00000035','NULL','JK002','DT  ','2025-02-04 20:59:11',1,'La Ode Kaharuddin','1',NULL,1),('MG00000036','NULL','JK002','DT  ','2025-02-04 21:18:22',1,'La Ode Kaharuddin','1',NULL,1),('MG00000037','NULL','JK002','DT  ','2025-02-04 21:19:22',2,'La Ode Kaharuddin','1','A002',1),('MG00000038','NULL','JK001','DT  ','2025-02-04 21:22:08',1,'La Ode Kaharuddin','1',NULL,1),('MG00000039','NULL','JK002','DT  ','2025-02-04 21:46:28',1,'La Ode Kaharuddin','15',NULL,1),('MG00000040','NULL','JK001','DT  ','2025-02-04 21:51:18',1,'La Ode Kaharuddin','1',NULL,1),('MG00000041','NULL','JK003','DT  ','2025-02-04 21:54:17',1,'La Ode Kaharuddin','1',NULL,1),('MG00000042','NULL','JK002','DT  ','2025-02-05 04:43:59',1,'La Ode Kaharuddin','1',NULL,1),('MG00000043','NULL','JK001','DT  ','2025-02-05 04:49:29',1,'La Ode Kaharuddin','1',NULL,1),('MG00000044','NULL','JK002','DT  ','2025-02-05 04:54:11',2,'La Ode Kaharuddin','1',NULL,1),('MG00000045','NULL','JK002','DT  ','2025-02-05 05:02:31',1,'La Ode Kaharuddin','1',NULL,1),('MG00000046','NULL','JK001','DT  ','2025-02-05 05:04:29',1,'La Ode Kaharuddin','1',NULL,1),('MG00000047','NULL','JK002','DT  ','2025-02-05 05:06:05',1,'La Ode Kaharuddin','1',NULL,1),('MG00000048','NULL','JK001','DT  ','2025-02-05 05:14:01',1,'La Ode Kaharuddin','1',NULL,1),('MG00000049','NULL','JK002','DT  ','2025-02-05 05:18:28',1,'La Ode Kaharuddin','10',NULL,1),('MG00000050','NULL','JK002','DT  ','2025-02-05 05:20:13',1,'La Ode Kaharuddin','1',NULL,0),('MG00000051','NULL','JK002','DT  ','2025-02-05 05:22:26',1,'La Ode Kaharuddin','1',NULL,0),('MG00000052','NULL','JK003','DT  ','2025-02-05 05:24:33',1,'La Ode Kaharuddin','1',NULL,0),('MG00000053','NULL','JK001','DT  ','2025-02-05 05:27:14',1,'La Ode Kaharuddin','2',NULL,0),('MG00000054','NULL','JK002','DT  ','2025-02-05 05:28:08',1,'La Ode Kaharuddin','1',NULL,0),('MG00000055','NULL','JK001','DT  ','2025-02-05 07:36:56',1,'La Ode Kaharuddin','1',NULL,0),('MG00000056','NULL','JK002','DT  ','2025-02-05 07:43:19',1,'La Ode Kaharuddin','1',NULL,0),('MG00000057','NULL','JK002','DT  ','2025-02-06 04:23:29',1,'La Ode Kaharuddin','1',NULL,1),('MG00000058','NULL','JK001','DT  ','2025-02-06 04:33:08',1,'La Ode Kaharuddin','1',NULL,1),('MG00000059','NULL','JK002','DT  ','2025-02-06 04:34:44',1,'La Ode Kaharuddin','12',NULL,1),('MG00000060','NULL','JK002','DT  ','2025-02-06 04:36:13',1,'La Ode Kaharuddin','15',NULL,1),('MG00000061','NULL','JK001','DT  ','2025-02-06 04:45:41',1,'La Ode Kaharuddin','1',NULL,1),('MG00000062','NULL','JK002','DT  ','2025-02-06 04:47:09',1,'La Ode Kaharuddin','1',NULL,1),('MG00000063','NULL','JK001','DT  ','2025-02-06 04:51:34',1,'La Ode Kaharuddin','1',NULL,1),('MG00000064','NULL','JK001','DT  ','2025-02-06 04:56:05',1,'La Ode Kaharuddin','1',NULL,1),('MG00000065','NULL','JK001','DT  ','2025-02-06 05:17:51',1,'La Ode Kaharuddin','1',NULL,1),('MG00000066','NULL','JK002','DT  ','2025-02-06 05:20:51',1,'La Ode Kaharuddin','1',NULL,1),('MG00000067','NULL','JK001','DT  ','2025-02-06 05:25:53',1,'La Ode Kaharuddin','1',NULL,1),('MG00000068','NULL','JK002','DT  ','2025-02-06 05:33:54',1,'La Ode Kaharuddin','1',NULL,1),('MG00000069','NULL','JK001','DT  ','2025-02-06 05:37:11',1,'La Ode Kaharuddin','2',NULL,1),('MG00000070','NULL','JK003','DT  ','2025-02-06 05:38:26',1,'La Ode Kaharuddin','15',NULL,1),('MG00000071','NULL','JK002','DT  ','2025-02-06 05:41:16',1,'La Ode Kaharuddin','20',NULL,1),('MG00000072','NULL','JK001','DT  ','2025-02-06 05:42:24',1,'La Ode Kaharuddin','1',NULL,1),('MG00000073','NULL','JK002','DT  ','2025-02-06 05:44:21',1,'La Ode Kaharuddin','1',NULL,1),('MG00000074','NULL','JK001','DT  ','2025-02-06 05:47:08',1,'La Ode Kaharuddin','1',NULL,1),('MG00000075','NULL','JK002','DT  ','2025-02-06 05:52:59',1,'La Ode Kaharuddin','1',NULL,1),('MG00000076','NULL','JK001','DT  ','2025-02-06 05:58:50',1,'La Ode Kaharuddin','1',NULL,1),('MG00000077','NULL','JK002','DT  ','2025-02-07 22:05:00',1,'La Ode Kaharuddin','1',NULL,1),('MG00000078','NULL','JK001','DT  ','2025-02-07 22:06:51',1,'La Ode Kaharuddin','1',NULL,1),('MG00000079','NULL','JK001','DT  ','2025-02-07 22:12:50',1,'La Ode Kaharuddin','2',NULL,1),('MG00000080','NULL','JK001','DT  ','2025-02-08 05:01:32',1,'La Ode Kaharuddin','1',NULL,1),('MG00000081','NULL','JK002','DT  ','2025-02-08 05:09:41',1,'La Ode Kaharuddin','1',NULL,1),('MG00000082','NULL','JK001','DT  ','2025-02-08 05:15:36',1,'La Ode Kaharuddin','1',NULL,1),('MG00000083','NULL','JK002','DT  ','2025-02-08 19:46:16',1,'La Ode Kaharuddin','1',NULL,1),('MG00000084','NULL','JK002','DT  ','2025-02-08 19:48:19',1,'La Ode Kaharuddin','1',NULL,1),('MG00000085','NULL','JK002','DT  ','2025-02-08 19:50:30',1,'La Ode Kaharuddin','1',NULL,1),('MG00000086','NULL','JK002','DT  ','2025-02-08 20:08:34',1,'La Ode Kaharuddin','1',NULL,1),('MG00000087','NULL','JK002','DT  ','2025-02-08 20:11:36',1,'La Ode Kaharuddin','1',NULL,1),('MG00000088','NULL','JK002','DT  ','2025-02-08 20:26:55',1,'La Ode Kaharuddin','1',NULL,1),('MG00000089','NULL','JK001','DT  ','2025-02-08 20:28:33',1,'La Ode Kaharuddin','1',NULL,1),('MG00000090','NULL','JK001','DT  ','2025-02-08 20:37:55',1,'La Ode Kaharuddin','1',NULL,1),('MG00000091','NULL','JK003','DT  ','2025-02-08 20:43:39',1,'La Ode Kaharuddin','1',NULL,1),('MG00000092','NULL','JK001','DT  ','2025-02-08 20:46:30',1,'La Ode Kaharuddin','2',NULL,1),('MG00000093','NULL','JK002','DT  ','2025-02-08 20:47:49',1,'La Ode Kaharuddin','12',NULL,1),('MG00000094','NULL','JK002','DT  ','2025-02-08 20:50:41',1,'La Ode Kaharuddin','1',NULL,1),('MG00000095','NULL','JK002','DT  ','2025-02-11 21:19:05',1,'La Ode Kaharuddin','1',NULL,1),('MG00000096','NULL','JK002','DT  ','2025-02-11 21:22:27',1,'La Ode Kaharuddin','1',NULL,1),('MG00000097','NULL','JK002','DT  ','2025-02-17 17:40:09',1,'La Ode Kaharuddin','15',NULL,1),('MG00000098','NULL','JK001','DT  ','2025-02-17 17:55:32',1,'La Ode Kaharuddin','1',NULL,1),('MG00000099','NULL','JK002','DT  ','2025-02-17 17:57:26',1,'La Ode Kaharuddin','1',NULL,NULL),('MG00000100','NULL','JK002','DT  ','2025-03-12 10:54:31',1,'La Ode Kaharuddin','15',NULL,1);
/*!40000 ALTER TABLE `tbl_masuk` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_member`
--

DROP TABLE IF EXISTS `tbl_member`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_member` (
  `kd_member` varchar(50) NOT NULL,
  `kd_kendaraan` varchar(50) DEFAULT NULL,
  `kd_kartu` varchar(256) DEFAULT NULL,
  `nama_member` varchar(100) DEFAULT NULL,
  `plat_member` varchar(50) DEFAULT NULL,
  `no_rangka_member` varchar(126) DEFAULT NULL,
  `no_mesin_member` varchar(126) DEFAULT NULL,
  `create_member` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`kd_member`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_member`
--

LOCK TABLES `tbl_member` WRITE;
/*!40000 ALTER TABLE `tbl_member` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_member` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_transaksi`
--

DROP TABLE IF EXISTS `tbl_transaksi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_transaksi` (
  `id_trx` int(11) NOT NULL AUTO_INCREMENT,
  `jenis_trx` varchar(20) DEFAULT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
  `nominal` varchar(100) DEFAULT NULL,
  `tgl_trx` date DEFAULT NULL,
  PRIMARY KEY (`id_trx`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_transaksi`
--

LOCK TABLES `tbl_transaksi` WRITE;
/*!40000 ALTER TABLE `tbl_transaksi` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_transaksi` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-06-09 13:40:18
