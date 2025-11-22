/*
 Navicat Premium Dump SQL

 Source Server         : parkir-nirwana
 Source Server Type    : MySQL
 Source Server Version : 100522 (10.5.22-MariaDB)
 Source Host           : 147.93.97.74:3306
 Source Schema         : parkir

 Target Server Type    : MySQL
 Target Server Version : 100522 (10.5.22-MariaDB)
 File Encoding         : 65001

 Date: 22/11/2025 16:13:24
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tbl_admin
-- ----------------------------
DROP TABLE IF EXISTS `tbl_admin`;
CREATE TABLE `tbl_admin`  (
  `kd_admin` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `username_admin` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `password_admin` varchar(256) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_admin` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `email_admin` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `no_hp_admin` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `img_admin` varchar(256) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `level_admin` int NULL DEFAULT NULL,
  `create_date_admin` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`kd_admin`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tbl_admin
-- ----------------------------
INSERT INTO `tbl_admin` VALUES ('A001', 'jeffry', '$2y$10$2PEToBltjSYF859hzaFBNOdOrVXcxf.eF0jJl1ywSm3vPnolgIH9m', 'Jeffry Hanafi', 'jeffry@nirwana.com', '08111111', 'assets/dist/img/default.png', 1, '2025-01-31 12:34:51');
INSERT INTO `tbl_admin` VALUES ('A002', 'kaharode', '$2y$10$2PEToBltjSYF859hzaFBNOdOrVXcxf.eF0jJl1ywSm3vPnolgIH9m', 'La Ode Kaharuddin', 'laodekaharuddin651@gmail.com', '085215414285', 'assets/dist/img/default.png', 1, '2025-01-31 10:43:58');
INSERT INTO `tbl_admin` VALUES ('A003', 'pengawas', '$2y$10$q56BuYaEZ6DvhKASk6VUNOTTtW83MlUTFDWe3fxR/h9Pb15u/EQ3a', 'Pengawas', 'pengawas@nirwana.com', '085215414285', 'assets/dist/img/default.png', 4, '2025-11-12 16:09:46');
INSERT INTO `tbl_admin` VALUES ('A004', 'andika', '$2y$10$Dk1b79V6g4oqkkUYKD47..ggFpuyoBItNsXJSZIeH4CvhqPqy7Shm', 'La Ode Upin', 'penjaga@gmail.com', '085215414285', 'assets/dist/img/default.png', 2, '2025-11-12 16:19:51');
INSERT INTO `tbl_admin` VALUES ('A005', 'andika2', '$2y$10$WpEyhFu805LBU3KxHSIvDeHB6VTuwdCi/88T/LNu7S9SmzRcTO.2u', 'La Ode Upin', 'petugas.parkir@nirwana.com', '082147961561', 'assets/dist/img/default.png', 3, '2025-11-12 16:23:46');
INSERT INTO `tbl_admin` VALUES ('A006', 'azhar', '$2y$10$NHQB2I6ZMiNGGrOowo.tduZUpHyKKKDXrLMMWJsjjUKPEpgF1OLpK', 'La Ode Azhar', 'petugas@gmail.com', '082199621429', 'assets/dist/img/default.png', 2, '2025-11-18 14:52:36');
INSERT INTO `tbl_admin` VALUES ('A007', 'ashar', '$2y$10$MrHDsTnawRp.f2n036cs.eyoAPsKS7onQ80WHcBM22Na9i9UU4s2u', 'La Ode Ashar', 'petugas@gmail.com', '081342558053', 'assets/dist/img/default.png', 2, '2025-11-18 14:53:54');
INSERT INTO `tbl_admin` VALUES ('A008', 'andiy', '$2y$10$6YuxwOARwOCqzXhvYqtjOezMpXJQk5w0CfSCLJhkgDQK5sYDlnj.a', 'La Ode Andi', 'petugas@gmail.com', '085353995864', 'assets/dist/img/default.png', 2, '2025-11-18 14:55:47');
INSERT INTO `tbl_admin` VALUES ('A009', 'erwin', '$2y$10$i2qHRbId8A9MIacDtrkc5uyoMvk90/aN/sQQtgrbhlkE/4qyD0E/q', 'Erwin', 'petugas@gmail.com', '081344391026', 'assets/dist/img/default.png', 2, '2025-11-18 15:36:42');
INSERT INTO `tbl_admin` VALUES ('A010', 'zamil', '$2y$10$h3rbWRHTiaJN3Ulvf.ufF.fPZgK1hpX65DAQDR1r2SLEKhemgyrb2', 'Zamil', 'petugas@gmail.com', '088291243332', 'assets/dist/img/default.png', 2, '2025-11-18 16:02:46');
INSERT INTO `tbl_admin` VALUES ('A011', 'azlan', '$2y$10$s5qdGQfXc1iHtXiKjHMRYeRC6gHRJ3U3v4C7DnG5CSsuRig4vy85q', 'Azlan', 'petugas@gmail.com', '085241884128', 'assets/dist/img/default.png', 2, '2025-11-18 16:10:36');
INSERT INTO `tbl_admin` VALUES ('A012', 'kiman', '$2y$10$fj4eBqOUB/DCUhusLSimKOJyZscTI2nbqmhVTqPj97NDmx3BsZGcK', 'La Ode Ruskiman', 'petugas@gmail.com', '082249234549', 'assets/dist/img/default.png', 2, '2025-11-18 16:19:18');
INSERT INTO `tbl_admin` VALUES ('A013', 'sahrul', '$2y$10$KQTYv5C8y1UBzm0egVwJxOThavz0Rju7sUXF3oht82uYZgk8A4Wem', 'Sahrul Anas', 'penjaga@gmail.com', '085705225876', 'assets/dist/img/default.png', 2, '2025-11-18 18:13:07');
INSERT INTO `tbl_admin` VALUES ('A014', 'dafid', '$2y$10$TvlRhbUJFKvH9ompCv.QM.wCydFUCBp4AnXYDhWq2iTnT2Sh.x3w6', 'Dafid', 'penjaga@gmail.com', '085215414258', 'assets/dist/img/default.png', 2, '2025-11-19 13:18:02');
INSERT INTO `tbl_admin` VALUES ('A015', 'jeff_palang', '$2y$10$AHFIZ7ASn.SUKylRqerDcevZ7Uoq.PdjRBUNm7z0/jy484mUx3aSS', 'JEFFRY HANAFI', 'jeffryfikom19@gmail.com', '085285111435', 'assets/dist/img/default.png', 3, '2025-11-19 18:04:07');
INSERT INTO `tbl_admin` VALUES ('A016', 'yalin', '$2y$10$80gJEucnV38ag6WxjfTp.uz1fPeP8y3dBA/CMBNWou8gkhnAFbwHy', 'Yalin', 'penjaga@gmail.com', '085215414285', 'assets/dist/img/default.png', 2, '2025-11-22 10:07:53');
INSERT INTO `tbl_admin` VALUES ('A017', 'dafar', '$2y$10$2r6mdgilYRIU4Jml1YFYD.kpLgGSZz7dJFn.gHz61jy8yjgPISHyW', 'Dafar', 'penjaga@gmail.com', '085215414285', 'assets/dist/img/default.png', 2, '2025-11-22 14:04:00');

-- ----------------------------
-- Table structure for tbl_keluar
-- ----------------------------
DROP TABLE IF EXISTS `tbl_keluar`;
CREATE TABLE `tbl_keluar`  (
  `kd_keluar` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kd_masuk` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `kd_member` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tgl_jam_masuk` datetime NULL DEFAULT NULL,
  `tgl_jam_keluar` datetime NULL DEFAULT NULL,
  `lama_parkir_keluar` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tarif_keluar` int NULL DEFAULT NULL,
  `total_keluar` int NULL DEFAULT NULL,
  `status_keluar` int NULL DEFAULT NULL,
  `create_keluar` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`kd_keluar`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tbl_keluar
-- ----------------------------
INSERT INTO `tbl_keluar` VALUES ('K00000001', 'MG00000004', 'NULL', '2025-01-31 10:45:11', '2025-01-31 11:04:52', '0 Jam,19 Menit', 3000, 45000, 1, 'Petugas Parkir');
INSERT INTO `tbl_keluar` VALUES ('K00000002', 'MG00000005', 'NULL', '2025-01-31 10:46:45', '2025-01-31 12:01:05', '1 Jam,14 Menit', 3000, 6000, 1, 'Petugas Parkir');
INSERT INTO `tbl_keluar` VALUES ('K00000003', 'MG00000003', 'NULL', '2025-01-31 10:44:48', '2025-01-31 13:29:51', '2 Jam,45 Menit', 5000, 50000, 1, 'Rendra');
INSERT INTO `tbl_keluar` VALUES ('K00000004', 'MG00000010', 'NULL', '2025-02-02 03:37:51', '2025-02-02 15:32:00', '11 Jam,54 Menit', 3000, 3000, 1, 'Jeffry Hanafi');
INSERT INTO `tbl_keluar` VALUES ('K00000005', 'MG00000033', 'NULL', '2025-02-04 20:50:26', '2025-02-04 21:33:11', '0 Jam,42 Menit', 3000, 6000, 1, 'Rendra');
INSERT INTO `tbl_keluar` VALUES ('K00000006', 'MG00000037', 'NULL', '2025-02-04 21:19:22', '2025-02-04 21:43:21', '0 Jam,23 Menit', 5000, 5000, 1, 'La Ode Kaharuddin');
INSERT INTO `tbl_keluar` VALUES ('K00000007', 'MG00000032', 'NULL', '2025-02-04 20:46:16', '2025-02-04 21:43:56', '0 Jam,57 Menit', 5000, 5000, 1, 'La Ode Kaharuddin');
INSERT INTO `tbl_keluar` VALUES ('K00000008', 'Mg00000044', 'NULL', '2025-02-05 04:54:11', '2025-02-05 05:00:21', '0 Jam,6 Menit', 5000, 5000, 1, 'La Ode Kaharuddin');
INSERT INTO `tbl_keluar` VALUES ('K00000009', 'MG00000076', 'NULL', '2025-11-19 15:21:07', '2025-11-19 15:27:15', '0 Jam,6 Menit', 3000, 6000, 0, 'La Ode Upin');
INSERT INTO `tbl_keluar` VALUES ('K00000010', 'MG00000045', NULL, '2025-11-19 13:40:44', '2025-11-22 11:20:04', '69 Jam, 39 Menit', 3000, 6000, 1, 'JEFFRY HANAFI');
INSERT INTO `tbl_keluar` VALUES ('K00000011', 'MG00000352', NULL, '2025-11-22 08:20:15', '2025-11-22 11:22:36', '3 Jam, 2 Menit', 3000, 3000, 1, 'JEFFRY HANAFI');
INSERT INTO `tbl_keluar` VALUES ('K00000012', 'MG00000352', NULL, '2025-11-22 08:20:15', '2025-11-22 11:27:01', '3 Jam, 6 Menit', 3000, 3000, 1, 'JEFFRY HANAFI');
INSERT INTO `tbl_keluar` VALUES ('K00000013', 'MG00000352', NULL, '2025-11-22 08:20:15', '2025-11-22 11:27:18', '3 Jam, 7 Menit', 3000, 3000, 1, 'JEFFRY HANAFI');
INSERT INTO `tbl_keluar` VALUES ('K00000014', 'MG00000046', NULL, '2025-11-19 13:43:13', '2025-11-22 15:03:17', '73 Jam, 20 Menit', 5000, 25000, 1, 'JEFFRY HANAFI');
INSERT INTO `tbl_keluar` VALUES ('K00000015', 'MG00000047', NULL, '2025-11-19 13:45:34', '2025-11-22 15:04:55', '73 Jam, 19 Menit', 5000, 20000, 1, 'JEFFRY HANAFI');

-- ----------------------------
-- Table structure for tbl_kendaraan
-- ----------------------------
DROP TABLE IF EXISTS `tbl_kendaraan`;
CREATE TABLE `tbl_kendaraan`  (
  `kd_kendaraan` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_kendaraan` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `harga_kendaraan` int NULL DEFAULT NULL,
  `jenis_kendaraan` int NOT NULL,
  `create_by_kendaraan` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`kd_kendaraan`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tbl_kendaraan
-- ----------------------------
INSERT INTO `tbl_kendaraan` VALUES ('JK001', 'Motor', 3000, 1, 'owner', '2025-01-24 13:28:44');
INSERT INTO `tbl_kendaraan` VALUES ('JK002', 'mobil', 5000, 1, 'owner', '2025-01-24 13:35:37');
INSERT INTO `tbl_kendaraan` VALUES ('JK003', 'Pejalan Kaki', 2000, 1, 'admin', '2025-01-24 13:47:33');

-- ----------------------------
-- Table structure for tbl_masuk
-- ----------------------------
DROP TABLE IF EXISTS `tbl_masuk`;
CREATE TABLE `tbl_masuk`  (
  `kd_masuk` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kd_member` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kd_kendaraan` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `plat_masuk` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tgl_masuk` datetime NULL DEFAULT NULL,
  `status_masuk` int NULL DEFAULT NULL,
  `create_masuk` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `jml_org` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `kd_admin` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `status_karcis` int NULL DEFAULT NULL,
  PRIMARY KEY (`kd_masuk`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tbl_masuk
-- ----------------------------
INSERT INTO `tbl_masuk` VALUES ('MG00000003', 'NULL', 'JK002', 'DT  ', '2025-01-31 10:44:48', 2, 'La Ode Azhar', '10', 'A013', 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000004', 'NULL', 'JK001', 'DT  ', '2025-01-31 10:45:11', 2, 'La Ode Azhar', '15', 'A009', 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000005', 'NULL', 'JK001', 'DT  ', '2025-01-31 10:46:45', 2, 'La Ode Adihar', '2', 'A009', 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000010', 'NULL', 'JK001', 'DT  ', '2025-02-02 03:37:51', 2, 'La Ode Adihar', '1', 'A001', 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000032', 'NULL', 'JK002', 'DT  ', '2025-02-04 20:46:16', 2, 'La Ode Kaharuddin', '1', 'A002', 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000033', 'NULL', 'JK001', 'DT  ', '2025-02-04 20:50:26', 2, 'La Ode Kaharuddin', '2', 'A013', 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000037', 'NULL', 'JK002', 'DT  ', '2025-02-04 21:19:22', 2, 'La Ode Kaharuddin', '1', 'A002', 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000044', 'NULL', 'JK002', 'DT  ', '2025-02-05 04:54:11', 2, 'La Ode Kaharuddin', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000045', 'NULL', 'JK001', 'DT  ', '2025-11-19 13:40:44', 2, 'La Ode Andi', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000046', 'NULL', 'JK002', 'DT  ', '2025-11-19 13:43:13', 2, 'La Ode Andi', '5', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000047', 'NULL', 'JK002', 'DT  ', '2025-11-19 13:45:34', 2, 'La Ode Andi', '4', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000048', 'NULL', 'JK001', 'DT  ', '2025-11-19 13:46:51', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000049', 'NULL', 'JK002', 'DT  ', '2025-11-19 13:48:10', 1, 'Zamil', '7', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000050', 'NULL', 'JK001', 'DT  ', '2025-11-19 13:48:32', 1, 'La Ode Andi', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000051', 'NULL', 'JK002', 'DT  ', '2025-11-19 13:53:51', 1, 'La Ode Andi', '7', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000052', 'NULL', 'JK002', 'DT  ', '2025-11-19 13:54:37', 1, 'La Ode Andi', '6', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000053', 'NULL', 'JK001', 'DT  ', '2025-11-19 14:01:31', 1, 'Zamil', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000054', 'NULL', 'JK002', 'DT  ', '2025-11-19 14:01:57', 1, 'La Ode Andi', '5', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000055', 'NULL', 'JK001', 'DT  ', '2025-11-19 14:03:56', 1, 'Zamil', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000056', 'NULL', 'JK002', 'DT  ', '2025-11-19 14:04:04', 1, 'La Ode Andi', '4', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000057', 'NULL', 'JK002', 'DT  ', '2025-11-19 14:05:52', 1, 'La Ode Andi', '16', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000058', 'NULL', 'JK001', 'DT  ', '2025-11-19 14:07:21', 1, 'Zamil', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000059', 'NULL', 'JK001', 'DT  ', '2025-11-19 14:09:29', 1, 'Zamil', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000060', 'NULL', 'JK002', 'DT  ', '2025-11-19 14:11:29', 1, 'La Ode Andi', '6', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000061', 'NULL', 'JK002', 'DT  ', '2025-11-19 14:12:16', 1, 'La Ode Andi', '6', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000062', 'NULL', 'JK002', 'DT  ', '2025-11-19 14:15:25', 1, 'La Ode Andi', '5', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000063', 'NULL', 'JK002', 'DT  ', '2025-11-19 14:16:43', 1, 'La Ode Andi', '4', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000064', 'NULL', 'JK001', 'DT  ', '2025-11-19 14:19:40', 1, 'La Ode Andi', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000065', 'NULL', 'JK001', 'DT  ', '2025-11-19 14:20:25', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000066', 'NULL', 'JK001', 'DT  ', '2025-11-19 14:23:52', 1, 'Zamil', '3', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000067', 'NULL', 'JK001', 'DT  ', '2025-11-19 14:33:46', 1, 'Zamil', '4', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000068', 'NULL', 'JK001', 'DT  ', '2025-11-19 15:12:47', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000069', 'NULL', 'JK001', 'DT  ', '2025-11-19 15:13:36', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000070', 'NULL', 'JK001', 'DT  ', '2025-11-19 15:15:55', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000071', 'NULL', 'JK001', 'DT  ', '2025-11-19 15:19:26', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000072', 'NULL', 'JK001', 'DT  ', '2025-11-19 15:19:32', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000073', 'NULL', 'JK001', 'DT  ', '2025-11-19 15:19:39', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000074', 'NULL', 'JK001', 'DT  ', '2025-11-19 15:20:57', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000075', 'NULL', 'JK001', 'DT  ', '2025-11-19 15:21:02', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000076', 'NULL', 'JK001', 'DT  ', '2025-11-19 15:21:07', 2, 'Zamil', '2', 'A005', 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000077', 'NULL', 'JK001', 'DT  ', '2025-11-19 15:21:10', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000078', 'NULL', 'JK001', 'DT  ', '2025-11-19 15:21:15', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000079', 'NULL', 'JK001', 'DT  ', '2025-11-19 15:22:55', 1, 'Zamil', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000080', 'NULL', 'JK001', 'DT  ', '2025-11-19 15:22:59', 1, 'Zamil', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000081', 'NULL', 'JK001', 'DT  ', '2025-11-19 15:23:02', 1, 'Zamil', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000082', 'NULL', 'JK001', 'DT  ', '2025-11-19 15:34:14', 1, 'La Ode Andi', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000083', 'NULL', 'JK001', 'DT  ', '2025-11-19 15:34:25', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000084', 'NULL', 'JK001', 'DT  ', '2025-11-19 15:34:39', 1, 'La Ode Andi', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000085', 'NULL', 'JK001', 'DT  ', '2025-11-19 15:39:38', 1, 'Zamil', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000086', 'NULL', 'JK001', 'DT  ', '2025-11-19 15:40:14', 1, 'Zamil', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000087', 'NULL', 'JK001', 'DT  ', '2025-11-19 15:45:49', 1, 'La Ode Andi', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000088', 'NULL', 'JK001', 'DT  ', '2025-11-19 15:46:22', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000089', 'NULL', 'JK001', 'DT  ', '2025-11-19 15:47:36', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000090', 'NULL', 'JK001', 'DT  ', '2025-11-19 15:55:39', 1, 'Zamil', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000091', 'NULL', 'JK001', 'DT  ', '2025-11-19 15:57:04', 1, 'Zamil', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000092', 'NULL', 'JK002', 'DT  ', '2025-11-19 16:00:01', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000093', 'NULL', 'JK001', 'DT  ', '2025-11-19 16:01:05', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000094', 'NULL', 'JK001', 'DT  ', '2025-11-19 16:01:30', 1, 'La Ode Andi', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000095', 'NULL', 'JK001', 'DT  ', '2025-11-19 16:03:10', 1, 'La Ode Andi', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000096', 'NULL', 'JK001', 'DT  ', '2025-11-19 16:03:19', 1, 'La Ode Andi', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000097', 'NULL', 'JK001', 'DT  ', '2025-11-19 16:03:30', 1, 'La Ode Andi', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000098', 'NULL', 'JK001', 'DT  ', '2025-11-19 16:03:38', 1, 'La Ode Andi', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000099', 'NULL', 'JK001', 'DT  ', '2025-11-19 16:03:45', 1, 'La Ode Andi', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000100', 'NULL', 'JK001', 'DT  ', '2025-11-19 16:05:32', 1, 'La Ode Andi', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000101', 'NULL', 'JK001', 'DT  ', '2025-11-19 16:05:40', 1, 'La Ode Andi', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000102', 'NULL', 'JK001', 'DT  ', '2025-11-19 16:07:31', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000103', 'NULL', 'JK001', 'DT  ', '2025-11-19 16:07:39', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000104', 'NULL', 'JK001', 'DT  ', '2025-11-19 16:07:57', 1, 'Zamil', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000105', 'NULL', 'JK001', 'DT  ', '2025-11-19 16:08:02', 1, 'Zamil', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000106', 'NULL', 'JK002', 'DT  ', '2025-11-19 16:08:58', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000107', 'NULL', 'JK002', 'DT  ', '2025-11-19 16:09:38', 1, 'Zamil', '8', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000108', 'NULL', 'JK001', 'DT  ', '2025-11-19 16:10:38', 1, 'La Ode Andi', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000109', 'NULL', 'JK001', 'DT  ', '2025-11-19 16:10:43', 1, 'La Ode Andi', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000110', 'NULL', 'JK001', 'DT  ', '2025-11-19 16:10:47', 1, 'La Ode Andi', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000111', 'NULL', 'JK002', 'DT  ', '2025-11-19 16:12:16', 1, 'La Ode Andi', '6', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000112', 'NULL', 'JK002', 'DT  ', '2025-11-19 16:13:45', 1, 'La Ode Andi', '4', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000113', 'NULL', 'JK001', 'DT  ', '2025-11-19 16:14:39', 1, 'La Ode Andi', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000114', 'NULL', 'JK001', 'DT  ', '2025-11-19 16:14:46', 1, 'La Ode Andi', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000115', 'NULL', 'JK001', 'DT  ', '2025-11-19 16:14:57', 1, 'La Ode Andi', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000116', 'NULL', 'JK001', 'DT  ', '2025-11-19 16:15:11', 1, 'La Ode Andi', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000117', 'NULL', 'JK001', 'DT  ', '2025-11-19 16:16:37', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000118', 'NULL', 'JK001', 'DT  ', '2025-11-19 16:16:44', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000119', 'NULL', 'JK001', 'DT  ', '2025-11-19 16:16:54', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000120', 'NULL', 'JK001', 'DT  ', '2025-11-19 16:16:59', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000121', 'NULL', 'JK001', 'DT  ', '2025-11-19 16:17:15', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000123', 'NULL', 'JK001', 'DT  ', '2025-11-19 16:17:41', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000124', 'NULL', 'JK001', 'DT  ', '2025-11-19 16:21:34', 1, 'La Ode Andi', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000125', 'NULL', 'JK001', 'DT  ', '2025-11-19 16:22:22', 1, 'Zamil', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000126', 'NULL', 'JK001', 'DT  ', '2025-11-19 16:22:26', 1, 'Zamil', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000127', 'NULL', 'JK001', 'DT  ', '2025-11-19 16:22:29', 1, 'Zamil', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000128', 'NULL', 'JK001', 'DT  ', '2025-11-19 16:23:43', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000129', 'NULL', 'JK001', 'DT  ', '2025-11-19 16:24:06', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000130', 'NULL', 'JK001', 'DT  ', '2025-11-19 16:24:55', 1, 'Zamil', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000131', 'NULL', 'JK001', 'DT  ', '2025-11-19 16:25:56', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000132', 'NULL', 'JK001', 'DT  ', '2025-11-19 16:45:24', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000133', 'NULL', 'JK001', 'DT  ', '2025-11-20 13:38:19', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000134', 'NULL', 'JK001', 'DT  ', '2025-11-20 13:38:37', 1, 'Zamil', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000135', 'NULL', 'JK001', 'DT  ', '2025-11-20 13:39:32', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000136', 'NULL', 'JK001', 'DT  ', '2025-11-20 13:40:10', 1, 'Zamil', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000137', 'NULL', 'JK001', 'DT  ', '2025-11-20 13:40:27', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000138', 'NULL', 'JK001', 'DT  ', '2025-11-20 13:41:20', 1, 'Zamil', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000139', 'NULL', 'JK001', 'DT  ', '2025-11-20 13:41:54', 1, 'Zamil', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000140', 'NULL', 'JK001', 'DT  ', '2025-11-20 13:42:01', 1, 'Zamil', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000141', 'NULL', 'JK001', 'DT  ', '2025-11-20 13:42:34', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000142', 'NULL', 'JK001', 'DT  ', '2025-11-20 13:42:43', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000143', 'NULL', 'JK001', 'DT  ', '2025-11-20 13:42:48', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000144', 'NULL', 'JK001', 'DT  ', '2025-11-20 13:42:52', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000145', 'NULL', 'JK002', 'DT  ', '2025-11-20 13:43:44', 1, 'Zamil', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000146', 'NULL', 'JK001', 'DT  ', '2025-11-20 13:43:53', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000147', 'NULL', 'JK001', 'DT  ', '2025-11-20 13:43:57', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000148', 'NULL', 'JK002', 'DT  ', '2025-11-20 13:44:47', 1, 'Zamil', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000149', 'NULL', 'JK002', 'DT  ', '2025-11-20 13:44:53', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000150', 'NULL', 'JK002', 'DT  ', '2025-11-20 13:44:57', 1, 'Zamil', '3', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000151', 'NULL', 'JK002', 'DT  ', '2025-11-20 13:45:02', 1, 'Zamil', '4', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000152', 'NULL', 'JK002', 'DT  ', '2025-11-20 13:45:08', 1, 'Zamil', '5', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000153', 'NULL', 'JK002', 'DT  ', '2025-11-20 13:45:12', 1, 'Zamil', '6', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000154', 'NULL', 'JK002', 'DT  ', '2025-11-20 13:45:18', 1, 'Zamil', '7', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000155', 'NULL', 'JK002', 'DT  ', '2025-11-20 13:46:51', 1, 'Zamil', '6', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000156', 'NULL', 'JK001', 'DT  ', '2025-11-20 13:49:02', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000157', 'NULL', 'JK001', 'DT  ', '2025-11-20 13:49:08', 1, 'La Ode Kaharuddin', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000158', 'NULL', 'JK001', 'DT  ', '2025-11-20 13:49:09', 1, 'La Ode Kaharuddin', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000159', 'NULL', 'JK002', 'DT  ', '2025-11-20 14:29:10', 1, 'La Ode Kaharuddin', '5', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000160', 'NULL', 'JK001', 'DT  ', '2025-11-20 14:29:30', 1, 'La Ode Kaharuddin', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000161', 'NULL', 'JK002', 'DT  ', '2025-11-20 14:32:33', 1, 'La Ode Kaharuddin', '3', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000162', 'NULL', 'JK002', 'DT  ', '2025-11-20 14:34:19', 1, 'La Ode Kaharuddin', '4', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000163', 'NULL', 'JK001', 'DT  ', '2025-11-20 14:39:51', 1, 'Sahrul Anas', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000164', 'NULL', 'JK001', 'DT  ', '2025-11-20 14:45:13', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000165', 'NULL', 'JK001', 'DT  ', '2025-11-20 14:53:46', 1, 'Zamil', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000166', 'NULL', 'JK001', 'DT  ', '2025-11-20 14:59:34', 1, 'Zamil', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000167', 'NULL', 'JK002', 'DT  ', '2025-11-20 15:04:30', 1, 'Zamil', '3', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000168', 'NULL', 'JK002', 'DT  ', '2025-11-20 15:07:12', 1, 'Zamil', '9', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000169', 'NULL', 'JK001', 'DT  ', '2025-11-20 15:13:52', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000170', 'NULL', 'JK001', 'DT  ', '2025-11-20 15:13:57', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000171', 'NULL', 'JK001', 'DT  ', '2025-11-20 15:21:17', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000172', 'NULL', 'JK001', 'DT  ', '2025-11-20 15:25:35', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000173', 'NULL', 'JK002', 'DT  ', '2025-11-20 15:28:16', 1, 'Zamil', '3', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000174', 'NULL', 'JK001', 'DT  ', '2025-11-20 15:29:42', 1, 'Zamil', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000175', 'NULL', 'JK001', 'DT  ', '2025-11-20 15:30:13', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000176', 'NULL', 'JK001', 'DT  ', '2025-11-20 15:30:19', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000177', 'NULL', 'JK001', 'DT  ', '2025-11-20 15:30:29', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000178', 'NULL', 'JK001', 'DT  ', '2025-11-20 15:30:54', 1, 'Zamil', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000179', 'NULL', 'JK001', 'DT  ', '2025-11-20 15:31:00', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000180', 'NULL', 'JK001', 'DT  ', '2025-11-20 15:31:07', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000181', 'NULL', 'JK002', 'DT  ', '2025-11-20 15:32:47', 1, 'Zamil', '4', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000182', 'NULL', 'JK002', 'DT  ', '2025-11-20 15:39:29', 1, 'Zamil', '3', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000183', 'NULL', 'JK001', 'DT  ', '2025-11-20 15:45:21', 1, 'Zamil', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000184', 'NULL', 'JK001', 'DT  ', '2025-11-20 15:45:27', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000185', 'NULL', 'JK002', 'DT  ', '2025-11-20 15:47:59', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000186', 'NULL', 'JK001', 'DT  ', '2025-11-20 15:49:31', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000187', 'NULL', 'JK001', 'DT  ', '2025-11-20 15:49:43', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000188', 'NULL', 'JK001', 'DT  ', '2025-11-20 15:49:55', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000189', 'NULL', 'JK001', 'DT  ', '2025-11-20 16:05:12', 1, 'Zamil', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000190', 'NULL', 'JK001', 'DT  ', '2025-11-20 16:05:15', 1, 'Zamil', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000191', 'NULL', 'JK001', 'DT  ', '2025-11-20 16:06:33', 1, 'Zamil', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000192', 'NULL', 'JK001', 'DT  ', '2025-11-20 16:07:00', 1, 'Zamil', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000193', 'NULL', 'JK002', 'DT  ', '2025-11-20 16:09:45', 1, 'Zamil', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000194', 'NULL', 'JK001', 'DT  ', '2025-11-20 16:13:59', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000195', 'NULL', 'JK001', 'DT  ', '2025-11-20 16:20:33', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000196', 'NULL', 'JK001', 'DT  ', '2025-11-20 16:20:38', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000197', 'NULL', 'JK001', 'DT  ', '2025-11-20 16:28:35', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000198', 'NULL', 'JK001', 'DT  ', '2025-11-20 16:28:39', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000199', 'NULL', 'JK001', 'DT  ', '2025-11-20 16:39:07', 1, 'La Ode Kaharuddin', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000200', 'NULL', 'JK001', 'DT  ', '2025-11-20 16:48:41', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000201', 'NULL', 'JK001', 'DT  ', '2025-11-20 16:48:46', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000202', 'NULL', 'JK001', 'DT  ', '2025-11-20 16:50:50', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000203', 'NULL', 'JK001', 'DT  ', '2025-11-20 16:58:07', 1, 'La Ode Kaharuddin', '2', NULL, NULL);
INSERT INTO `tbl_masuk` VALUES ('MG00000204', 'NULL', 'JK001', 'DT  ', '2025-11-20 16:59:06', 1, 'La Ode Kaharuddin', '2', NULL, NULL);
INSERT INTO `tbl_masuk` VALUES ('MG00000205', 'NULL', 'JK001', 'DT  ', '2025-11-20 16:59:11', 1, 'La Ode Kaharuddin', '2', NULL, NULL);
INSERT INTO `tbl_masuk` VALUES ('MG00000206', 'NULL', 'JK001', 'DT  ', '2025-11-20 16:59:18', 1, 'La Ode Kaharuddin', '2', NULL, NULL);
INSERT INTO `tbl_masuk` VALUES ('MG00000207', 'NULL', 'JK001', 'DT  ', '2025-11-20 16:59:29', 1, 'La Ode Kaharuddin', '2', NULL, NULL);
INSERT INTO `tbl_masuk` VALUES ('MG00000208', 'NULL', 'JK001', 'DT  ', '2025-11-20 16:59:52', 1, 'La Ode Kaharuddin', '2', NULL, NULL);
INSERT INTO `tbl_masuk` VALUES ('MG00000209', 'NULL', 'JK001', 'DT  ', '2025-11-20 16:59:58', 1, 'La Ode Kaharuddin', '2', NULL, NULL);
INSERT INTO `tbl_masuk` VALUES ('MG00000210', 'NULL', 'JK001', 'DT  ', '2025-11-21 13:15:19', 1, 'Zamil', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000211', 'NULL', 'JK001', 'DT  ', '2025-11-21 13:15:52', 1, 'Zamil', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000212', 'NULL', 'JK002', 'DT  ', '2025-11-21 13:16:13', 1, 'Zamil', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000213', 'NULL', 'JK001', 'DT  ', '2025-11-21 13:16:44', 1, 'Zamil', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000214', 'NULL', 'JK001', 'DT  ', '2025-11-21 13:17:22', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000215', 'NULL', 'JK001', 'DT  ', '2025-11-21 13:18:02', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000216', 'NULL', 'JK001', 'DT  ', '2025-11-21 13:18:28', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000217', 'NULL', 'JK001', 'DT  ', '2025-11-21 13:18:58', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000218', 'NULL', 'JK001', 'DT  ', '2025-11-21 13:19:25', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000219', 'NULL', 'JK002', 'DT  ', '2025-11-21 13:19:48', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000220', 'NULL', 'JK002', 'DT  ', '2025-11-21 13:20:19', 1, 'Zamil', '3', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000222', 'NULL', 'JK002', 'DT  ', '2025-11-21 13:21:44', 1, 'Zamil', '5', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000223', 'NULL', 'JK003', 'DT  ', '2025-11-21 13:21:45', 1, 'La Ode Kaharuddin', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000224', 'NULL', 'JK002', 'DT  ', '2025-11-21 13:22:51', 1, 'Zamil', '6', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000225', 'NULL', 'JK002', 'DT  ', '2025-11-21 13:22:54', 1, 'Zamil', '6', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000226', 'NULL', 'JK001', 'DT  ', '2025-11-21 13:38:11', 1, 'La Ode Kaharuddin', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000227', 'NULL', 'JK001', 'DT  ', '2025-11-21 13:38:51', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000228', 'NULL', 'JK002', 'DT  ', '2025-11-21 14:10:49', 1, 'La Ode Kaharuddin', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000229', 'NULL', 'JK001', 'DT  ', '2025-11-21 14:19:28', 1, 'La Ode Kaharuddin', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000230', 'NULL', 'JK001', 'DT  ', '2025-11-21 14:20:18', 1, 'La Ode Kaharuddin', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000231', 'NULL', 'JK001', 'DT  ', '2025-11-21 14:29:56', 1, 'La Ode Kaharuddin', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000232', 'NULL', 'JK001', 'DT  ', '2025-11-21 14:41:00', 1, 'La Ode Andi', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000233', 'NULL', 'JK003', 'DT  ', '2025-11-21 15:02:06', 1, 'La Ode Kaharuddin', '3', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000234', 'NULL', 'JK001', 'DT  ', '2025-11-21 15:10:33', 1, 'La Ode Kaharuddin', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000235', 'NULL', 'JK001', 'DT  ', '2025-11-21 15:10:55', 1, 'La Ode Kaharuddin', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000236', 'NULL', 'JK001', 'DT  ', '2025-11-21 15:11:51', 1, 'La Ode Kaharuddin', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000237', 'NULL', 'JK001', 'DT  ', '2025-11-21 15:14:09', 1, 'La Ode Kaharuddin', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000238', 'NULL', 'JK001', 'DT  ', '2025-11-21 15:18:17', 1, 'La Ode Kaharuddin', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000239', 'NULL', 'JK001', 'DT  ', '2025-11-21 15:18:27', 1, 'La Ode Kaharuddin', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000240', 'NULL', 'JK001', 'DT  ', '2025-11-21 15:22:44', 1, 'La Ode Kaharuddin', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000241', 'NULL', 'JK001', 'DT  ', '2025-11-21 15:29:09', 1, 'La Ode Kaharuddin', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000242', 'NULL', 'JK001', 'DT  ', '2025-11-21 15:31:28', 1, 'La Ode Kaharuddin', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000245', 'NULL', 'JK001', 'DT  ', '2025-11-21 15:40:24', 1, 'La Ode Kaharuddin', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000246', 'NULL', 'JK001', 'DT  ', '2025-11-21 15:40:32', 1, 'La Ode Kaharuddin', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000247', 'NULL', 'JK001', 'DT  ', '2025-11-21 15:40:38', 1, 'La Ode Kaharuddin', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000248', 'NULL', 'JK001', 'DT  ', '2025-11-21 15:43:18', 1, 'La Ode Kaharuddin', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000249', 'NULL', 'JK001', 'DT  ', '2025-11-21 15:43:35', 1, 'La Ode Kaharuddin', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000250', 'NULL', 'JK001', 'DT  ', '2025-11-21 15:44:25', 1, 'La Ode Kaharuddin', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000251', 'NULL', 'JK001', 'DT  ', '2025-11-21 15:48:47', 1, 'La Ode Kaharuddin', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000252', 'NULL', 'JK001', 'DT  ', '2025-11-21 15:48:53', 1, 'La Ode Kaharuddin', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000253', 'NULL', 'JK002', 'DT  ', '2025-11-21 15:49:06', 1, 'La Ode Kaharuddin', '6', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000254', 'NULL', 'JK001', 'DT  ', '2025-11-21 15:51:35', 1, 'La Ode Kaharuddin', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000255', 'NULL', 'JK001', 'DT  ', '2025-11-21 15:52:18', 1, 'La Ode Kaharuddin', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000256', 'NULL', 'JK001', 'DT  ', '2025-11-21 15:52:32', 1, 'La Ode Kaharuddin', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000257', 'NULL', 'JK001', 'DT  ', '2025-11-21 15:52:51', 1, 'La Ode Kaharuddin', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000258', 'NULL', 'JK001', 'DT  ', '2025-11-21 15:55:31', 1, 'Zamil', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000259', 'NULL', 'JK001', 'DT  ', '2025-11-21 15:55:34', 1, 'Zamil', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000260', 'NULL', 'JK001', 'DT  ', '2025-11-21 15:55:37', 1, 'Zamil', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000261', 'NULL', 'JK001', 'DT  ', '2025-11-21 15:56:39', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000262', 'NULL', 'JK001', 'DT  ', '2025-11-21 15:58:35', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000263', 'NULL', 'JK001', 'DT  ', '2025-11-21 15:58:39', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000264', 'NULL', 'JK001', 'DT  ', '2025-11-21 15:59:24', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000265', 'NULL', 'JK001', 'DT  ', '2025-11-21 15:59:32', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000266', 'NULL', 'JK001', 'DT  ', '2025-11-21 16:01:25', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000267', 'NULL', 'JK001', 'DT  ', '2025-11-21 16:01:30', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000268', 'NULL', 'JK001', 'DT  ', '2025-11-21 16:06:53', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000269', 'NULL', 'JK001', 'DT  ', '2025-11-21 16:14:30', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000270', 'NULL', 'JK001', 'DT  ', '2025-11-21 16:18:00', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000271', 'NULL', 'JK001', 'DT  ', '2025-11-21 16:22:37', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000272', 'NULL', 'JK001', 'DT  ', '2025-11-21 16:22:50', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000273', 'NULL', 'JK001', 'DT  ', '2025-11-21 16:24:02', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000274', 'NULL', 'JK001', 'DT  ', '2025-11-21 16:24:23', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000275', 'NULL', 'JK001', 'DT  ', '2025-11-21 16:27:46', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000276', 'NULL', 'JK001', 'DT  ', '2025-11-21 16:27:50', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000277', 'NULL', 'JK002', 'DT  ', '2025-11-22 05:09:27', 1, 'La Ode Kaharuddin', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000278', 'NULL', 'JK002', 'DT  ', '2025-11-22 05:09:34', 1, 'La Ode Kaharuddin', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000279', 'NULL', 'JK001', 'DT  ', '2025-11-22 05:09:39', 1, 'La Ode Kaharuddin', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000280', 'NULL', 'JK001', 'DT  ', '2025-11-22 05:09:42', 1, 'La Ode Kaharuddin', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000281', 'NULL', 'JK001', 'DT  ', '2025-11-22 05:09:47', 1, 'La Ode Kaharuddin', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000282', 'NULL', 'JK001', 'DT  ', '2025-11-22 05:09:54', 1, 'La Ode Kaharuddin', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000283', 'NULL', 'JK001', 'DT  ', '2025-11-22 05:09:59', 1, 'La Ode Kaharuddin', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000284', 'NULL', 'JK001', 'DT  ', '2025-11-22 05:10:04', 1, 'La Ode Kaharuddin', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000285', 'NULL', 'JK002', 'DT  ', '2025-11-22 05:14:30', 1, 'La Ode Kaharuddin', '3', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000286', 'NULL', 'JK002', 'DT  ', '2025-11-22 05:14:36', 1, 'La Ode Kaharuddin', '4', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000287', 'NULL', 'JK002', 'DT  ', '2025-11-22 05:14:41', 1, 'La Ode Kaharuddin', '6', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000288', 'NULL', 'JK002', 'DT  ', '2025-11-22 05:14:46', 1, 'La Ode Kaharuddin', '7', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000289', 'NULL', 'JK002', 'DT  ', '2025-11-22 05:16:32', 1, 'La Ode Kaharuddin', '5', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000290', 'NULL', 'JK002', 'DT  ', '2025-11-22 05:17:09', 1, 'La Ode Kaharuddin', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000291', 'NULL', 'JK001', 'DT  ', '2025-11-22 05:18:29', 1, 'La Ode Kaharuddin', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000292', 'NULL', 'JK002', 'DT  ', '2025-11-22 05:27:56', 1, 'La Ode Kaharuddin', '5', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000293', 'NULL', 'JK001', 'DT  ', '2025-11-22 05:30:37', 1, 'La Ode Kaharuddin', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000294', 'NULL', 'JK001', 'DT  ', '2025-11-22 05:31:32', 1, 'La Ode Kaharuddin', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000295', 'NULL', 'JK001', 'DT  ', '2025-11-22 05:31:37', 1, 'La Ode Kaharuddin', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000296', 'NULL', 'JK001', 'DT  ', '2025-11-22 05:31:43', 1, 'La Ode Kaharuddin', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000297', 'NULL', 'JK001', 'DT  ', '2025-11-22 05:45:35', 1, 'La Ode Kaharuddin', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000298', 'NULL', 'JK002', 'DT  ', '2025-11-22 05:47:36', 1, 'La Ode Kaharuddin', '8', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000299', 'NULL', 'JK001', 'DT  ', '2025-11-22 05:48:23', 1, 'La Ode Kaharuddin', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000300', 'NULL', 'JK001', 'DT  ', '2025-11-22 05:51:08', 1, 'La Ode Kaharuddin', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000301', 'NULL', 'JK001', 'DT  ', '2025-11-22 06:01:17', 1, 'La Ode Kaharuddin', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000302', 'NULL', 'JK002', 'DT  ', '2025-11-22 06:11:24', 1, 'Zamil', '4', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000303', 'NULL', 'JK002', 'DT  ', '2025-11-22 06:14:36', 1, 'La Ode Kaharuddin', '6', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000304', 'NULL', 'JK002', 'DT  ', '2025-11-22 06:14:55', 1, 'La Ode Kaharuddin', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000305', 'NULL', 'JK001', 'DT  ', '2025-11-22 06:16:00', 1, 'La Ode Kaharuddin', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000306', 'NULL', 'JK001', 'DT  ', '2025-11-22 06:16:07', 1, 'La Ode Kaharuddin', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000307', 'NULL', 'JK001', 'DT  ', '2025-11-22 06:18:50', 1, 'La Ode Kaharuddin', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000308', 'NULL', 'JK002', 'DT  ', '2025-11-22 06:19:36', 1, 'La Ode Kaharuddin', '8', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000309', 'NULL', 'JK001', 'DT  ', '2025-11-22 06:23:09', 1, 'Azlan', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000310', 'NULL', 'JK001', 'DT  ', '2025-11-22 07:14:30', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000311', 'NULL', 'JK001', 'DT  ', '2025-11-22 07:15:37', 1, 'Zamil', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000312', 'NULL', 'JK001', 'DT  ', '2025-11-22 07:15:42', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000313', 'NULL', 'JK001', 'DT  ', '2025-11-22 07:15:46', 1, 'Zamil', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000314', 'NULL', 'JK001', 'DT  ', '2025-11-22 07:15:51', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000315', 'NULL', 'JK001', 'DT  ', '2025-11-22 07:15:53', 1, 'Zamil', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000316', 'NULL', 'JK001', 'DT  ', '2025-11-22 07:15:57', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000317', 'NULL', 'JK002', 'DT  ', '2025-11-22 07:19:43', 1, 'Zamil', '3', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000318', 'NULL', 'JK002', 'DT  ', '2025-11-22 07:22:05', 1, 'Zamil', '4', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000319', 'NULL', 'JK001', 'DT  ', '2025-11-22 07:23:50', 1, 'Zamil', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000320', 'NULL', 'JK001', 'DT  ', '2025-11-22 07:24:16', 1, 'Zamil', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000321', 'NULL', 'JK001', 'DT  ', '2025-11-22 07:24:30', 1, 'Zamil', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000322', 'NULL', 'JK001', 'DT  ', '2025-11-22 07:25:24', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000323', 'NULL', 'JK002', 'DT  ', '2025-11-22 07:26:46', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000324', 'NULL', 'JK001', 'DT  ', '2025-11-22 07:26:51', 1, 'Zamil', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000325', 'NULL', 'JK001', 'DT  ', '2025-11-22 07:28:30', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000326', 'NULL', 'JK002', 'DT  ', '2025-11-22 07:29:43', 1, 'Zamil', '4', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000327', 'NULL', 'JK001', 'DT  ', '2025-11-22 07:31:52', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000328', 'NULL', 'JK001', 'DT  ', '2025-11-22 07:31:58', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000329', 'NULL', 'JK001', 'DT  ', '2025-11-22 07:33:20', 1, 'Zamil', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000330', 'NULL', 'JK001', 'DT  ', '2025-11-22 07:33:32', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000331', 'NULL', 'JK001', 'DT  ', '2025-11-22 07:33:36', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000332', 'NULL', 'JK001', 'DT  ', '2025-11-22 07:33:41', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000333', 'NULL', 'JK002', 'DT  ', '2025-11-22 07:36:50', 1, 'Azlan', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000334', 'NULL', 'JK001', 'DT  ', '2025-11-22 07:37:33', 1, 'Azlan', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000335', 'NULL', 'JK002', 'DT  ', '2025-11-22 07:42:28', 1, 'Azlan', '5', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000336', 'NULL', 'JK001', 'DT  ', '2025-11-22 07:50:19', 1, 'Zamil', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000337', 'NULL', 'JK001', 'DT  ', '2025-11-22 07:51:37', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000338', 'NULL', 'JK001', 'DT  ', '2025-11-22 07:52:08', 1, 'Azlan', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000339', 'NULL', 'JK002', 'DT  ', '2025-11-22 07:57:55', 1, 'Zamil', '3', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000340', 'NULL', 'JK002', 'DT  ', '2025-11-22 08:02:14', 1, 'Zamil', '3', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000341', 'NULL', 'JK002', 'DT  ', '2025-11-22 08:02:30', 1, 'Zamil', '4', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000342', 'NULL', 'JK002', 'DT  ', '2025-11-22 08:03:27', 1, 'Zamil', '4', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000343', 'NULL', 'JK001', 'DT  ', '2025-11-22 08:06:57', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000344', 'NULL', 'JK001', 'DT  ', '2025-11-22 08:08:11', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000345', 'NULL', 'JK001', 'DT  ', '2025-11-22 08:09:18', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000346', 'NULL', 'JK001', 'DT  ', '2025-11-22 08:12:50', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000347', 'NULL', 'JK002', 'DT  ', '2025-11-22 08:13:21', 1, 'Zamil', '10', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000348', 'NULL', 'JK001', 'DT  ', '2025-11-22 08:14:48', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000349', 'NULL', 'JK002', 'DT  ', '2025-11-22 08:17:12', 1, 'Zamil', '5', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000350', 'NULL', 'JK002', 'DT  ', '2025-11-22 08:18:22', 1, 'Azlan', '4', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000351', 'NULL', 'JK001', 'DT  ', '2025-11-22 08:19:50', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000352', 'NULL', 'JK001', 'DT  ', '2025-11-22 08:20:15', 2, 'Azlan', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000353', 'NULL', 'JK001', 'DT  ', '2025-11-22 08:20:25', 1, 'Zamil', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000354', 'NULL', 'JK001', 'DT  ', '2025-11-22 08:21:09', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000355', 'NULL', 'JK001', 'DT  ', '2025-11-22 08:30:19', 1, 'Zamil', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000356', 'NULL', 'JK002', 'DT  ', '2025-11-22 08:35:47', 1, 'Azlan', '3', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000357', 'NULL', 'JK002', 'DT  ', '2025-11-22 08:44:31', 1, 'Zamil', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000358', 'NULL', 'JK001', 'DT  ', '2025-11-22 08:45:57', 1, 'Zamil', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000359', 'NULL', 'JK001', 'DT  ', '2025-11-22 08:52:16', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000360', 'NULL', 'JK001', 'DT  ', '2025-11-22 08:53:21', 1, 'Zamil', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000361', 'NULL', 'JK002', 'DT  ', '2025-11-22 09:09:40', 1, 'La Ode Kaharuddin', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000362', 'NULL', 'JK002', 'DT  ', '2025-11-22 09:09:44', 1, 'La Ode Kaharuddin', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000363', 'NULL', 'JK002', 'DT  ', '2025-11-22 09:09:52', 1, 'La Ode Kaharuddin', '3', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000364', 'NULL', 'JK002', 'DT  ', '2025-11-22 09:09:58', 1, 'La Ode Kaharuddin', '4', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000365', 'NULL', 'JK002', 'DT  ', '2025-11-22 09:10:05', 1, 'La Ode Kaharuddin', '5', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000366', 'NULL', 'JK002', 'DT  ', '2025-11-22 09:14:34', 1, 'Zamil', '16', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000367', 'NULL', 'JK001', 'DT  ', '2025-11-22 09:16:40', 1, 'La Ode Kaharuddin', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000368', 'NULL', 'JK001', 'DT  ', '2025-11-22 09:18:24', 1, 'La Ode Kaharuddin', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000369', 'NULL', 'JK001', 'DT  ', '2025-11-22 09:18:30', 1, 'La Ode Kaharuddin', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000370', 'NULL', 'JK001', 'DT  ', '2025-11-22 09:18:35', 1, 'La Ode Kaharuddin', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000371', 'NULL', 'JK001', 'DT  ', '2025-11-22 09:21:04', 1, 'La Ode Kaharuddin', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000372', 'NULL', 'JK001', 'DT  ', '2025-11-22 09:21:12', 1, 'La Ode Kaharuddin', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000373', 'NULL', 'JK001', 'DT  ', '2025-11-22 09:21:17', 1, 'La Ode Kaharuddin', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000374', 'NULL', 'JK001', 'DT  ', '2025-11-22 09:21:22', 1, 'La Ode Kaharuddin', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000375', 'NULL', 'JK001', 'DT  ', '2025-11-22 09:23:23', 1, 'Zamil', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000376', 'NULL', 'JK001', 'DT  ', '2025-11-22 09:26:50', 1, 'La Ode Upin', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000377', 'NULL', 'JK001', 'DT  ', '2025-11-22 09:30:25', 1, 'Dafid', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000378', 'NULL', 'JK001', 'DT  ', '2025-11-22 09:34:38', 1, 'La Ode Upin', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000379', 'NULL', 'JK001', 'DT  ', '2025-11-22 09:59:53', 1, 'La Ode Upin', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000380', 'NULL', 'JK001', 'DT  ', '2025-11-22 10:07:12', 1, 'La Ode Upin', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000381', 'NULL', 'JK001', 'DT  ', '2025-11-22 10:11:15', 1, 'Yalin', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000382', 'NULL', 'JK001', 'DT  ', '2025-11-22 10:11:27', 1, 'Yalin', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000383', 'NULL', 'JK002', 'DT  ', '2025-11-22 10:15:24', 1, 'La Ode Kaharuddin', '3', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000384', 'NULL', 'JK001', 'DT  ', '2025-11-22 10:16:27', 1, 'Yalin', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000385', 'NULL', 'JK001', 'DT  ', '2025-11-22 10:16:49', 1, 'Yalin', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000386', 'NULL', 'JK001', 'DT  ', '2025-11-22 10:17:07', 1, 'Yalin', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000387', 'NULL', 'JK001', 'DT  ', '2025-11-22 10:17:28', 1, 'Yalin', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000388', 'NULL', 'JK001', 'DT  ', '2025-11-22 10:17:38', 1, 'Yalin', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000389', 'NULL', 'JK001', 'DT  ', '2025-11-22 10:18:23', 1, 'Yalin', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000390', 'NULL', 'JK001', 'DT  ', '2025-11-22 10:19:23', 1, 'La Ode Kaharuddin', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000391', 'NULL', 'JK001', 'DT  ', '2025-11-22 10:20:11', 1, 'La Ode Kaharuddin', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000392', 'NULL', 'JK001', 'DT  ', '2025-11-22 10:27:04', 1, 'La Ode Kaharuddin', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000393', 'NULL', 'JK001', 'DT  ', '2025-11-22 10:33:38', 1, 'La Ode Kaharuddin', '5', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000394', 'NULL', 'JK001', 'DT  ', '2025-11-22 10:39:05', 1, 'La Ode Kaharuddin', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000395', 'NULL', 'JK001', 'DT  ', '2025-11-22 10:41:43', 1, 'Yalin', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000396', 'NULL', 'JK001', 'DT  ', '2025-11-22 10:41:56', 1, 'Yalin', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000397', 'NULL', 'JK001', 'DT  ', '2025-11-22 10:47:33', 1, 'La Ode Kaharuddin', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000398', 'NULL', 'JK001', 'DT  ', '2025-11-22 11:05:24', 1, 'Yalin', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000399', 'NULL', 'JK001', 'DT  ', '2025-11-22 11:05:35', 1, 'Yalin', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000400', 'NULL', 'JK001', 'DT  ', '2025-11-22 11:05:49', 1, 'Yalin', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000401', 'NULL', 'JK001', 'DT  ', '2025-11-22 11:08:15', 1, 'Yalin', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000402', 'NULL', 'JK001', 'DT  ', '2025-11-22 11:08:25', 1, 'Yalin', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000403', 'NULL', 'JK001', 'DT  ', '2025-11-22 11:08:38', 1, 'Yalin', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000404', 'NULL', 'JK001', 'DT  ', '2025-11-22 11:19:04', 1, 'Yalin', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000405', 'NULL', 'JK001', 'DT  ', '2025-11-22 11:19:17', 1, 'Yalin', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000406', 'NULL', 'JK001', 'DT  ', '2025-11-22 11:23:43', 1, 'Yalin', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000407', 'NULL', 'JK001', 'DT  ', '2025-11-22 11:24:12', 1, 'Yalin', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000408', 'NULL', 'JK001', 'DT  ', '2025-11-22 11:44:07', 1, 'Dafid', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000409', 'NULL', 'JK001', 'DT  ', '2025-11-22 11:51:45', 1, 'Dafid', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000410', 'NULL', 'JK001', 'DT  ', '2025-11-22 11:53:32', 1, 'Yalin', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000411', 'NULL', 'JK001', 'DT  ', '2025-11-22 11:53:56', 1, 'Yalin', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000412', 'NULL', 'JK002', 'DT  ', '2025-11-22 12:43:02', 1, 'Yalin', '11', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000413', 'NULL', 'JK002', 'DT  ', '2025-11-22 12:57:47', 1, 'La Ode Kaharuddin', '6', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000414', 'NULL', 'JK002', 'DT  ', '2025-11-22 13:09:39', 1, 'La Ode Kaharuddin', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000415', 'NULL', 'JK001', 'DT  ', '2025-11-22 13:24:35', 1, 'La Ode Kaharuddin', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000416', 'NULL', 'JK001', 'DT  ', '2025-11-22 13:26:25', 1, 'La Ode Kaharuddin', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000417', 'NULL', 'JK002', 'DT  ', '2025-11-22 13:37:50', 1, 'La Ode Kaharuddin', '4', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000418', 'NULL', 'JK002', 'DT  ', '2025-11-22 13:39:03', 1, 'La Ode Kaharuddin', '5', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000419', 'NULL', 'JK002', 'DT  ', '2025-11-22 13:39:20', 1, 'La Ode Kaharuddin', '4', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000420', 'NULL', 'JK002', 'DT  ', '2025-11-22 13:40:47', 1, 'La Ode Kaharuddin', '3', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000421', 'NULL', 'JK002', 'DT  ', '2025-11-22 13:41:49', 1, 'La Ode Kaharuddin', '7', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000422', 'NULL', 'JK002', 'DT  ', '2025-11-22 13:43:43', 1, 'La Ode Kaharuddin', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000423', 'NULL', 'JK001', 'DT  ', '2025-11-22 13:45:36', 1, 'La Ode Kaharuddin', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000424', 'NULL', 'JK002', 'DT  ', '2025-11-22 13:49:33', 1, 'La Ode Kaharuddin', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000425', 'NULL', 'JK001', 'DT  ', '2025-11-22 13:50:36', 1, 'La Ode Kaharuddin', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000426', 'NULL', 'JK002', 'DT  ', '2025-11-22 13:50:58', 1, 'La Ode Kaharuddin', '3', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000427', 'NULL', 'JK001', 'DT  ', '2025-11-22 13:56:45', 1, 'La Ode Kaharuddin', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000428', 'NULL', 'JK001', 'DT  ', '2025-11-22 13:57:11', 1, 'La Ode Kaharuddin', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000429', 'NULL', 'JK001', 'DT  ', '2025-11-22 13:57:50', 1, 'La Ode Kaharuddin', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000430', 'NULL', 'JK001', 'DT  ', '2025-11-22 14:00:25', 1, 'La Ode Kaharuddin', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000431', 'NULL', 'JK002', 'DT  ', '2025-11-22 14:01:18', 1, 'La Ode Kaharuddin', '4', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000432', 'NULL', 'JK001', 'DT  ', '2025-11-22 14:08:15', 1, 'Dafar', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000433', 'NULL', 'JK001', 'DT  ', '2025-11-22 14:10:19', 1, 'Dafar', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000434', 'NULL', 'JK002', 'DT  ', '2025-11-22 14:10:34', 1, 'Dafar', '9', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000435', 'NULL', 'JK003', 'DT  ', '2025-11-22 14:11:23', 1, 'Dafar', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000436', 'NULL', 'JK002', 'DT  ', '2025-11-22 14:12:14', 1, 'Dafar', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000437', 'NULL', 'JK001', 'DT  ', '2025-11-22 14:15:19', 1, 'La Ode Kaharuddin', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000438', 'NULL', 'JK001', 'DT  ', '2025-11-22 14:22:28', 1, 'La Ode Kaharuddin', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000439', 'NULL', 'JK001', 'DT  ', '2025-11-22 14:33:49', 1, 'La Ode Kaharuddin', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000440', 'NULL', 'JK001', 'DT  ', '2025-11-22 14:34:04', 1, 'La Ode Kaharuddin', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000441', 'NULL', 'JK001', 'DT  ', '2025-11-22 14:35:29', 1, 'La Ode Kaharuddin', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000442', 'NULL', 'JK001', 'DT  ', '2025-11-22 14:35:34', 1, 'La Ode Kaharuddin', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000443', 'NULL', 'JK001', 'DT  ', '2025-11-22 14:35:46', 1, 'La Ode Kaharuddin', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000444', 'NULL', 'JK001', 'DT  ', '2025-11-22 14:36:12', 1, 'La Ode Kaharuddin', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000445', 'NULL', 'JK001', 'DT  ', '2025-11-22 14:36:17', 1, 'La Ode Kaharuddin', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000446', 'NULL', 'JK001', 'DT  ', '2025-11-22 14:38:43', 1, 'La Ode Kaharuddin', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000447', 'NULL', 'JK001', 'DT  ', '2025-11-22 14:40:43', 1, 'La Ode Kaharuddin', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000448', 'NULL', 'JK001', 'DT  ', '2025-11-22 14:41:30', 1, 'La Ode Kaharuddin', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000449', 'NULL', 'JK001', 'DT  ', '2025-11-22 14:41:39', 1, 'La Ode Kaharuddin', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000450', 'NULL', 'JK002', 'DT  ', '2025-11-22 14:44:40', 1, 'La Ode Kaharuddin', '3', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000451', 'NULL', 'JK002', 'DT  ', '2025-11-22 14:47:30', 1, 'La Ode Kaharuddin', '4', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000452', 'NULL', 'JK002', 'DT  ', '2025-11-22 14:54:30', 1, 'La Ode Kaharuddin', '5', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000453', 'NULL', 'JK002', 'DT  ', '2025-11-22 14:56:03', 1, 'La Ode Kaharuddin', '5', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000454', 'NULL', 'JK001', 'DT  ', '2025-11-22 14:57:00', 1, 'La Ode Kaharuddin', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000455', 'NULL', 'JK001', 'DT  ', '2025-11-22 14:57:36', 1, 'La Ode Kaharuddin', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000456', 'NULL', 'JK001', 'DT  ', '2025-11-22 15:03:46', 1, 'La Ode Kaharuddin', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000457', 'NULL', 'JK002', 'DT  ', '2025-11-22 15:04:08', 1, 'La Ode Kaharuddin', '5', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000458', 'NULL', 'JK001', 'DT  ', '2025-11-22 15:04:20', 1, 'La Ode Kaharuddin', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000459', 'NULL', 'JK001', 'DT  ', '2025-11-22 15:05:13', 1, 'La Ode Kaharuddin', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000460', 'NULL', 'JK001', 'DT  ', '2025-11-22 15:05:17', 1, 'La Ode Kaharuddin', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000461', 'NULL', 'JK001', 'DT  ', '2025-11-22 15:05:21', 1, 'La Ode Kaharuddin', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000462', 'NULL', 'JK001', 'DT  ', '2025-11-22 15:06:01', 1, 'La Ode Kaharuddin', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000463', 'NULL', 'JK001', 'DT  ', '2025-11-22 15:06:16', 1, 'La Ode Kaharuddin', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000464', 'NULL', 'JK001', 'DT  ', '2025-11-22 15:06:20', 1, 'La Ode Kaharuddin', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000465', 'NULL', 'JK001', 'DT  ', '2025-11-22 15:06:23', 1, 'La Ode Kaharuddin', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000466', 'NULL', 'JK001', 'DT  ', '2025-11-22 15:06:42', 1, 'La Ode Kaharuddin', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000467', 'NULL', 'JK001', 'DT  ', '2025-11-22 15:06:46', 1, 'La Ode Kaharuddin', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000468', 'NULL', 'JK001', 'DT  ', '2025-11-22 15:06:49', 1, 'La Ode Kaharuddin', '1', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000469', 'NULL', 'JK001', 'DT  ', '2025-11-22 15:06:57', 1, 'La Ode Kaharuddin', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000470', 'NULL', 'JK001', 'DT  ', '2025-11-22 15:07:03', 1, 'La Ode Kaharuddin', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000471', 'NULL', 'JK001', 'DT  ', '2025-11-22 15:07:12', 1, 'La Ode Kaharuddin', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000472', 'NULL', 'JK001', 'DT  ', '2025-11-22 15:10:10', 1, 'La Ode Kaharuddin', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000473', 'NULL', 'JK001', 'DT  ', '2025-11-22 15:10:46', 1, 'La Ode Kaharuddin', '2', NULL, 1);
INSERT INTO `tbl_masuk` VALUES ('MG00000474', 'NULL', 'JK002', 'DT  ', '2025-11-22 15:13:01', 1, 'La Ode Kaharuddin', '4', NULL, 1);

-- ----------------------------
-- Table structure for tbl_member
-- ----------------------------
DROP TABLE IF EXISTS `tbl_member`;
CREATE TABLE `tbl_member`  (
  `kd_member` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kd_kendaraan` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `kd_kartu` varchar(256) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nama_member` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `plat_member` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `no_rangka_member` varchar(126) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `no_mesin_member` varchar(126) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `create_member` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`kd_member`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tbl_member
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_transaksi
-- ----------------------------
DROP TABLE IF EXISTS `tbl_transaksi`;
CREATE TABLE `tbl_transaksi`  (
  `id_trx` int NOT NULL AUTO_INCREMENT,
  `jenis_trx` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `keterangan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nominal` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tgl_trx` date NULL DEFAULT NULL,
  PRIMARY KEY (`id_trx`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tbl_transaksi
-- ----------------------------
INSERT INTO `tbl_transaksi` VALUES (6, 'pendapatan', 'Pendapatan Karcis', '733000', '2025-11-19');
INSERT INTO `tbl_transaksi` VALUES (8, 'pengeluaran', 'Biaya Gaji', '533000', '2025-11-19');
INSERT INTO `tbl_transaksi` VALUES (9, 'pendapatan', 'Pendapatan Karcis', '617000', '2025-11-20');
INSERT INTO `tbl_transaksi` VALUES (11, 'pengeluaran', 'Biaya Gaji', '492000', '2025-11-20');
INSERT INTO `tbl_transaksi` VALUES (12, 'pendapatan', 'Pendapatan Karcis', '470000', '2025-11-21');
INSERT INTO `tbl_transaksi` VALUES (13, 'pengeluaran', 'Biaya Gaji', '370000', '2025-11-21');
INSERT INTO `tbl_transaksi` VALUES (14, 'pengeluaran', 'Biaya Adm (Beli Kertas Print) ', '85000', '2025-11-22');

SET FOREIGN_KEY_CHECKS = 1;
