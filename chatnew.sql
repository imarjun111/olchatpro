-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.7.29-0ubuntu0.18.04.1 - (Ubuntu)
-- Server OS:                    Linux
-- HeidiSQL Version:             10.1.0.5464
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for caketest
CREATE DATABASE IF NOT EXISTS `caketest` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `caketest`;

-- Dumping structure for table caketest.admins
CREATE TABLE IF NOT EXISTS `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `f_name` varchar(50) DEFAULT NULL,
  `l_name` varchar(50) DEFAULT NULL,
  `address` text,
  `phone_number` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(120) DEFAULT NULL,
  `token` text,
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table caketest.admins: ~5 rows (approximately)
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` (`id`, `f_name`, `l_name`, `address`, `phone_number`, `email`, `username`, `password`, `token`, `created`, `modified`) VALUES
	(1, 'test', 'admin', 'jaipur,rajasthan', '963258741', 'admin@gmail.com', 'admin', '$2y$10$y.aSrGuRgcfvC/ImZ.wsxu25UzWnzZ0Pzx9WfQF6SP8MUgRXT2Bbi', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6IjEiLCJ1c2VyIjp7ImlkIjoiMSIsIm5hbWUiOiJ0ZXN0IiwicGFzc3dvcmQiOiIxMjM0NTYifSwiYXV0aG9ydXJpIjoiaHR0cDpcL1wvbG9jYWxob3N0XC9jYWtlbmV3dGVzdFwvIiwiZXhwIjoxODk4MTU0MDYyfQ.ZX9py5GvpEM9_WVLGAzb2QTpyhE_Gcy3NcufHsOj8vY', '2020-02-21 10:07:32', '2020-02-27 14:31:02'),
	(2, 'demo', 'admin', 'jaipur', '963258741', 'admin@gmail.com', 'demouser', '$2y$10$OxqCNkjhtHYy4FFM53kmzejhXxmmDQngtRSM4qk3wH7OaFzy0.rn2', NULL, '2020-02-21 10:59:20', '2020-02-21 10:59:20'),
	(3, 'test', 'admin', 'jaipur', '963258741', 'admin@gmail.com', 'test5', '$2y$10$X4diAMNAec2btlfwtsDzGOO86XHhzAzjA5NVmz4DmdV2P3ZODVHo.', NULL, '2020-02-21 11:13:06', '2020-02-21 11:13:06'),
	(4, 'test', 'demo', 'jaipur', '963258741', 'admin@gmail.com', 'utest', '$2y$10$myQrsRDJst/DHv8iK7eADuzXkM15Po/i5jqu7pQmHN76I5GYh/Gea', NULL, '2020-02-24 09:46:05', '2020-02-24 09:46:05'),
	(5, 'test', 'demo2', 'jaipur', NULL, 'admin@gmail.com', 'user11', '$2y$10$.lCw71j33S0sdfRA.mLtdu4XSQ4Do239Yyc5KXPKdQqh8KBsPyZdO', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6NSwidXNlciI6eyJpZCI6NSwidXNlcm5hbWUiOiJ1c2VyMTEifSwiYXV0aG9ydXJpIjoiaHR0cDpcL1wvbG9jYWxob3N0IiwiZXhwIjoxODk4NTA5OTAwfQ.METoRb0ZXMvbB2w-Q7WbU61UiZ22SxGuJyWIxk0ZWao', '2020-02-27 13:59:58', '2020-03-02 17:21:40');
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;

-- Dumping structure for table caketest.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(120) DEFAULT NULL,
  `email` varchar(120) DEFAULT NULL,
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table caketest.users: ~0 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
