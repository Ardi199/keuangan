/*
 Navicat Premium Data Transfer

 Source Server         : local
 Source Server Type    : MySQL
 Source Server Version : 100427 (10.4.27-MariaDB)
 Source Host           : localhost:3306
 Source Schema         : keuangan

 Target Server Type    : MySQL
 Target Server Version : 100427 (10.4.27-MariaDB)
 File Encoding         : 65001

 Date: 11/10/2023 09:10:06
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for data_pengguna
-- ----------------------------
DROP TABLE IF EXISTS `data_pengguna`;
CREATE TABLE `data_pengguna`  (
  `ID_PENGGUNA` int NOT NULL AUTO_INCREMENT,
  `USERNAME` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `NAMA_PENGGUNA` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `PASSWORD` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `STATUS_USER` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `JENIS_USER` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`ID_PENGGUNA`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of data_pengguna
-- ----------------------------
INSERT INTO `data_pengguna` VALUES (1, 'ardi', 'ardi', 'ardi', '1', '0');

-- ----------------------------
-- Table structure for hutang
-- ----------------------------
DROP TABLE IF EXISTS `hutang`;
CREATE TABLE `hutang`  (
  `ID` int NOT NULL,
  `KETERANGAN` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `NOMINAL` double NULL DEFAULT NULL,
  `BUKTI` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `BULAN` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `STATUS` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `CREATED_AT` datetime NULL DEFAULT NULL,
  `UPDATED_AT` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of hutang
-- ----------------------------
INSERT INTO `hutang` VALUES (230001, 'Bayar kereta berangkat bani', 49000, 'BUKTI-230001.jpeg', NULL, 'Sudah di Bayar', '2023-07-24 11:01:02', '2023-07-29 07:34:22');
INSERT INTO `hutang` VALUES (230002, 'Bayar kereta pulang bani', 49000, 'BUKTI-230002.jpeg', NULL, 'Sudah di Bayar', '2023-07-24 11:01:26', '2023-07-29 07:34:19');
INSERT INTO `hutang` VALUES (230003, 'bimbim hutang', 5000, 'BUKTI-230003.jpeg', NULL, 'Sudah di Bayar', '2023-07-28 06:40:29', '2023-08-01 01:00:01');
INSERT INTO `hutang` VALUES (230004, 'hutang ke hafiz', 7000, 'BUKTI-230004.jpeg', NULL, 'Sudah di Bayar', '2023-07-31 02:28:30', '2023-08-01 12:59:58');
INSERT INTO `hutang` VALUES (230005, 'mamah hutang bensin', 15000, 'BUKTI-230005.jpeg', NULL, 'Sudah di Bayar', '2023-08-07 10:35:58', NULL);
INSERT INTO `hutang` VALUES (230006, 'a gilang belum bayar ayam geybok', 23000, 'BUKTI-230006.jpeg', NULL, 'Belum di Bayar', '2023-08-29 04:40:13', NULL);
INSERT INTO `hutang` VALUES (230007, 'pak canggih belum bayaar beli nasi kuning', 12000, 'BUKTI-230007.jpg', NULL, 'Belum di Bayar', '2023-08-29 04:40:46', NULL);

-- ----------------------------
-- Table structure for pemasukan
-- ----------------------------
DROP TABLE IF EXISTS `pemasukan`;
CREATE TABLE `pemasukan`  (
  `ID` int NOT NULL AUTO_INCREMENT,
  `NOMINAL` double NULL DEFAULT NULL,
  `KETERANGAN` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `BULAN` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `TANGGAL` datetime NULL DEFAULT NULL,
  `CREATED_AT` datetime NULL DEFAULT NULL,
  `UPDATED_AT` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 23 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pemasukan
-- ----------------------------
INSERT INTO `pemasukan` VALUES (17, 5273662, 'gaji', 'June', '2023-06-26 08:30:00', '2022-06-26 08:22:49', NULL);
INSERT INTO `pemasukan` VALUES (18, 2785112, 'Bonus', 'July', '2023-07-13 23:55:00', '2023-07-26 08:23:43', NULL);
INSERT INTO `pemasukan` VALUES (19, 5276562, 'Gaji', NULL, '2023-07-26 09:30:00', '2023-07-26 09:31:56', NULL);
INSERT INTO `pemasukan` VALUES (21, 5248020, 'gaji bulan agustus', NULL, '2023-08-25 08:30:00', '2023-08-28 08:27:11', NULL);
INSERT INTO `pemasukan` VALUES (22, 5250615, 'gaji bulan september', NULL, '2023-09-25 05:00:00', '2023-10-11 09:07:29', NULL);

-- ----------------------------
-- Table structure for rekap
-- ----------------------------
DROP TABLE IF EXISTS `rekap`;
CREATE TABLE `rekap`  (
  `ID` int NOT NULL AUTO_INCREMENT,
  `NOMINAL` double NULL DEFAULT NULL,
  `KETERANGAN` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `TANGGAL` datetime NULL DEFAULT NULL,
  `HARI` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `CREATED_AT` datetime NULL DEFAULT NULL,
  `UPDATED_AT` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 90 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of rekap
-- ----------------------------
INSERT INTO `rekap` VALUES (25, 10000, 'beli makan pagi nasi kuning', '2023-07-21 07:00:46', 'Friday', '2023-07-21 11:43:47', NULL);
INSERT INTO `rekap` VALUES (26, 5000, 'beli teh poci', '2023-07-21 12:21:38', 'Friday', '2023-07-21 12:55:13', NULL);
INSERT INTO `rekap` VALUES (27, 20000, 'beli chicken chef al', '2023-07-21 12:21:23', 'Friday', '2023-07-21 12:55:27', NULL);
INSERT INTO `rekap` VALUES (28, 50000, 'shopay', '2023-07-21 08:21:14', 'Friday', '2023-07-21 12:57:56', NULL);
INSERT INTO `rekap` VALUES (30, 293382, 'booking asyana', '2023-07-23 12:20:59', 'Sunday', '2023-07-23 01:22:14', NULL);
INSERT INTO `rekap` VALUES (32, 10000, 'beli makan pagi nasi kuning', '2023-07-24 07:00:00', 'Monday', '2023-07-24 07:58:09', NULL);
INSERT INTO `rekap` VALUES (34, 10000, 'beli makan siang di abi', '2023-07-24 12:00:00', 'Monday', '2023-07-24 11:18:40', NULL);
INSERT INTO `rekap` VALUES (39, 23000, 'Beli geybok makan malam', '2023-07-24 18:00:00', 'Monday', '2023-07-25 08:19:40', NULL);
INSERT INTO `rekap` VALUES (40, 10000, 'Beli makan pagi nasi kuning', '2023-07-25 07:00:00', 'Tuesday', '2023-07-25 08:26:18', NULL);
INSERT INTO `rekap` VALUES (41, 17000, 'Beli makan siang indomie', '2023-07-25 12:40:00', 'Tuesday', '2023-07-25 02:06:55', NULL);
INSERT INTO `rekap` VALUES (42, 35000, 'bensin motor', '2023-07-25 19:30:00', 'Tuesday', '2023-07-26 07:29:11', NULL);
INSERT INTO `rekap` VALUES (44, 7000, 'isi angin ban motor', '2023-07-25 19:30:00', 'Tuesday', '2023-07-26 07:30:06', NULL);
INSERT INTO `rekap` VALUES (45, 40500, 'beli makan malam kfc', '2023-07-25 20:00:00', 'Tuesday', '2023-07-26 07:30:34', NULL);
INSERT INTO `rekap` VALUES (46, 155000, 'beli cartridge dan liquid', '2023-07-25 21:00:00', 'Tuesday', '2023-07-26 07:31:17', NULL);
INSERT INTO `rekap` VALUES (47, 12000, 'beli makan di abi', '2023-07-26 07:20:00', 'Wednesday', '2023-07-26 09:16:23', NULL);
INSERT INTO `rekap` VALUES (48, 20000, 'beli makan siang baraya', '2023-07-26 12:40:00', 'Wednesday', '2023-07-26 01:11:58', '2023-07-26 01:50:30');
INSERT INTO `rekap` VALUES (49, 13000, 'nasi goreng makan malam', '2023-07-26 19:00:00', 'Wednesday', '2023-07-27 07:32:00', NULL);
INSERT INTO `rekap` VALUES (51, 10000, 'makan pagi abi', '2023-07-27 07:30:00', 'Thursday', '2023-07-27 07:34:34', NULL);
INSERT INTO `rekap` VALUES (52, 23000, 'beli makan siang blonde', '2023-07-27 12:30:00', 'Thursday', '2023-07-27 01:36:16', NULL);
INSERT INTO `rekap` VALUES (53, 20000, 'beli makan malam chicken chef al', '2023-07-27 18:50:00', 'Thursday', '2023-07-27 06:58:35', '2023-07-27 06:59:21');
INSERT INTO `rekap` VALUES (54, 10000, 'beli nasi kuning', '2023-07-28 07:00:00', 'Friday', '2023-07-28 07:18:12', NULL);
INSERT INTO `rekap` VALUES (55, 605000, 'tf ke ayang', '2023-07-28 08:55:00', 'Friday', '2023-07-28 08:56:51', NULL);
INSERT INTO `rekap` VALUES (56, 2500000, 'bayar bulanan mamah', '2023-07-28 09:00:00', 'Friday', '2023-07-28 08:59:23', '2023-07-31 02:23:23');
INSERT INTO `rekap` VALUES (57, 20000, 'beli baraya makan malam', '2023-07-28 18:20:00', 'Saturday', '2023-07-29 07:35:58', NULL);
INSERT INTO `rekap` VALUES (58, 91000, 'beli roti harvest', '2023-07-30 20:00:00', 'Monday', '2023-07-31 07:36:11', NULL);
INSERT INTO `rekap` VALUES (59, 13000, 'beli mie ayam', '2023-07-30 16:10:00', 'Monday', '2023-07-31 07:36:35', NULL);
INSERT INTO `rekap` VALUES (60, 10000, 'beli makan pagi nasi kuning', '2023-07-31 08:00:00', 'Monday', '2023-07-31 08:20:21', NULL);
INSERT INTO `rekap` VALUES (61, 23000, 'beli makan siang ayam geybok', '2023-07-31 12:30:00', 'Monday', '2023-07-31 02:04:04', NULL);
INSERT INTO `rekap` VALUES (62, 10000, 'beli nasi kuning', '2023-08-07 07:30:00', 'Monday', '2023-08-07 09:48:23', NULL);
INSERT INTO `rekap` VALUES (63, 130000, 'jahit baju seragam', '2023-08-06 16:30:00', 'Monday', '2023-08-07 09:49:08', NULL);
INSERT INTO `rekap` VALUES (64, 40000, 'beli chiclin di rest area', '2023-08-05 19:00:00', 'Monday', '2023-08-07 09:49:48', NULL);
INSERT INTO `rekap` VALUES (65, 8000, 'beli minuman mamah', '2023-08-05 19:00:00', 'Monday', '2023-08-07 09:50:17', NULL);
INSERT INTO `rekap` VALUES (66, 23000, 'beli makan siang ayam geybok', '2023-08-07 12:10:00', 'Monday', '2023-08-07 04:42:53', NULL);
INSERT INTO `rekap` VALUES (67, 10000, 'beli indomie kari ayam', '2023-08-07 17:00:00', 'Tuesday', '2023-08-08 03:44:21', NULL);
INSERT INTO `rekap` VALUES (68, 21000, 'beli ayam goreng', '2023-08-07 19:20:00', 'Tuesday', '2023-08-08 03:44:41', NULL);
INSERT INTO `rekap` VALUES (69, 7000, 'beli nasi kuning tanpa telor dadar', '2023-08-08 07:30:00', 'Tuesday', '2023-08-08 03:46:09', NULL);
INSERT INTO `rekap` VALUES (70, 7000, 'beli nasi kuning makan pagi', '2023-08-09 07:53:45', 'Thursday', '2023-08-10 02:53:17', NULL);
INSERT INTO `rekap` VALUES (71, 25000, 'beli makan ayam telor asin', '2023-08-09 11:30:00', 'Thursday', '2023-08-10 02:54:36', NULL);
INSERT INTO `rekap` VALUES (72, 20000, 'beli makan malam chef al', '2023-08-09 18:15:00', 'Thursday', '2023-08-10 02:55:00', NULL);
INSERT INTO `rekap` VALUES (73, 11000, 'beli makan pagi nasi uduk', '2023-08-10 07:30:00', 'Thursday', '2023-08-10 02:55:33', NULL);
INSERT INTO `rekap` VALUES (74, 10000, 'beli makan siang cilacap', '2023-08-10 11:10:00', 'Thursday', '2023-08-10 02:56:15', NULL);
INSERT INTO `rekap` VALUES (75, 10000, 'beli makan pagi di abi', '2023-08-21 07:30:00', 'Monday', '2023-08-21 09:58:17', NULL);
INSERT INTO `rekap` VALUES (76, 50000, 'beli jajan bani', '2023-08-19 11:30:00', 'Monday', '2023-08-21 09:58:56', NULL);
INSERT INTO `rekap` VALUES (77, 13000, 'beli nasi goreng', '2023-08-19 19:00:00', 'Monday', '2023-08-21 09:59:17', NULL);
INSERT INTO `rekap` VALUES (78, 30000, 'beli silverqueen', '2023-08-19 19:40:00', 'Monday', '2023-08-21 10:01:01', NULL);
INSERT INTO `rekap` VALUES (79, 7000, 'beli makan pagi nasi kuning tanpa telor', '2023-08-28 07:30:00', 'Monday', '2023-08-28 08:27:54', '2023-08-28 08:36:07');
INSERT INTO `rekap` VALUES (80, 601000, 'ngasih ayang', '2023-08-27 18:00:00', 'Monday', '2023-08-28 08:28:44', NULL);
INSERT INTO `rekap` VALUES (81, 160000, 'beli tiket pulang jakarta', '2023-08-27 17:00:00', 'Monday', '2023-08-28 08:29:34', '2023-08-28 08:30:21');
INSERT INTO `rekap` VALUES (82, 190000, 'beli tiket berangkat ke cirebon', '2023-08-27 17:00:00', 'Monday', '2023-08-28 08:29:58', NULL);
INSERT INTO `rekap` VALUES (83, 23000, 'beli geybok', '2023-08-28 12:10:00', 'Tuesday', '2023-08-29 03:38:12', NULL);
INSERT INTO `rekap` VALUES (84, 7000, 'beli nasi kuning', '2023-08-29 07:00:00', 'Tuesday', '2023-08-29 03:38:30', NULL);
INSERT INTO `rekap` VALUES (85, 20000, 'beli makan malam chef al', '2023-08-29 19:30:00', 'Wednesday', '2023-08-30 10:48:59', NULL);
INSERT INTO `rekap` VALUES (86, 10000, 'beli makan pagi di abi', '2023-08-30 07:20:00', 'Wednesday', '2023-08-30 10:49:40', NULL);
INSERT INTO `rekap` VALUES (87, 23000, 'beli mkan siang di trisakti', '2023-08-30 12:15:00', 'Wednesday', '2023-08-30 03:03:40', NULL);
INSERT INTO `rekap` VALUES (88, 12000, 'beli makan pagi di abi', '2023-09-15 07:30:00', 'Friday', '2023-09-15 06:55:17', NULL);
INSERT INTO `rekap` VALUES (89, 20000, 'beli makan siang ayam telor asin baraya', '2023-09-15 12:30:00', 'Friday', '2023-09-15 06:55:41', NULL);

-- ----------------------------
-- Table structure for test
-- ----------------------------
DROP TABLE IF EXISTS `test`;
CREATE TABLE `test`  (
  `ID` int NOT NULL AUTO_INCREMENT,
  `TEST` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of test
-- ----------------------------
INSERT INTO `test` VALUES (1, 'wws');

-- ----------------------------
-- Table structure for user_refresh_tokens
-- ----------------------------
DROP TABLE IF EXISTS `user_refresh_tokens`;
CREATE TABLE `user_refresh_tokens`  (
  `user_refresh_tokenID` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `urf_userID` int UNSIGNED NOT NULL,
  `urf_token` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `urf_ip` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `urf_user_agent` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `urf_created` datetime NOT NULL COMMENT 'UTC',
  PRIMARY KEY (`user_refresh_tokenID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = 'For JWT authentication process' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user_refresh_tokens
-- ----------------------------

SET FOREIGN_KEY_CHECKS = 1;
