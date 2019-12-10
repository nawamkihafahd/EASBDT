/*
SQLyog Ultimate v12.4.3 (64 bit)
MySQL - 5.7.20-log : Database - ektp
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`ektp` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `ektp`;

/*Table structure for table `alats` */

CREATE TABLE `alats` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ruang_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `proxy_user` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `proxy_pass` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mode` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `alats_ruang_id_foreign` (`ruang_id`),
  CONSTRAINT `alats_ruang_id_foreign` FOREIGN KEY (`ruang_id`) REFERENCES `ruangs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `alats` */

insert  into `alats`(`id`,`nama`,`ruang_id`,`created_at`,`updated_at`,`proxy_user`,`proxy_pass`,`mode`) values 
(1,'JusTap1',1,'2019-08-29 03:03:39','2019-10-16 09:24:45','ITS-558353-87d1f','cb98b','bpjs');

/*Table structure for table `bpjs` */

CREATE TABLE `bpjs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `pengguna_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `batas_pembayaran` date DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Unique_pengguna` (`pengguna_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `bpjs` */

insert  into `bpjs`(`id`,`pengguna_id`,`created_at`,`updated_at`,`batas_pembayaran`,`status`) values 
(1,4,'2019-10-14 11:54:14','2019-10-14 11:54:20','2019-09-17',0);

/*Table structure for table `globals` */

CREATE TABLE `globals` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `globals` */

/*Table structure for table `kartus` */

CREATE TABLE `kartus` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `pengguna_id` bigint(20) unsigned NOT NULL,
  `uid` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipe` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kartus_uid_unique` (`uid`),
  KEY `kartus_pengguna_id_foreign` (`pengguna_id`),
  CONSTRAINT `kartus_pengguna_id_foreign` FOREIGN KEY (`pengguna_id`) REFERENCES `penggunas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `kartus` */

insert  into `kartus`(`id`,`pengguna_id`,`uid`,`tipe`,`created_at`,`updated_at`) values 
(4,3,'042a3cfa122c80','KTP','2019-09-26 09:43:33','2019-10-11 01:33:11'),
(5,4,'990c4e98','KTP','2019-10-12 07:29:39','2019-10-12 07:29:39');

/*Table structure for table `kelaskereta_tiket` */

CREATE TABLE `kelaskereta_tiket` (
  `kelaskereta_id` bigint(20) NOT NULL,
  `tiket_id` bigint(20) NOT NULL,
  `nominal` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `kelaskereta_tiket` */

insert  into `kelaskereta_tiket`(`kelaskereta_id`,`tiket_id`,`nominal`) values 
(1,1,295000),
(2,1,350000),
(3,1,485000);

/*Table structure for table `kelaskeretas` */

CREATE TABLE `kelaskeretas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nama` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `kelaskeretas` */

insert  into `kelaskeretas`(`id`,`created_at`,`updated_at`,`nama`) values 
(1,'2019-10-16 08:25:53',NULL,'Ekonomi'),
(2,'2019-10-16 08:25:56',NULL,'Bisnis'),
(3,'2019-10-16 08:25:58',NULL,'Eksekutif');

/*Table structure for table `keretas` */

CREATE TABLE `keretas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nama` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kapasitas` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `keretas` */

insert  into `keretas`(`id`,`created_at`,`updated_at`,`nama`,`kapasitas`) values 
(1,NULL,NULL,'Dami',100),
(2,NULL,NULL,'Dummy',100);

/*Table structure for table `kotas` */

CREATE TABLE `kotas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nama` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `kotas` */

insert  into `kotas`(`id`,`created_at`,`updated_at`,`nama`) values 
(1,'2019-10-16 08:25:15',NULL,'Surabaya'),
(2,'2019-10-16 08:25:19',NULL,'Bandung'),
(3,'2019-10-16 08:25:21',NULL,'Jakarta'),
(4,'2019-10-16 08:25:24',NULL,'Yogyakarta');

/*Table structure for table `logs` */

CREATE TABLE `logs` (
  `uid_kartu` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipe_kartu` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ruangan` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hasil` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `mode` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url_gambar` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `logs` */

insert  into `logs`(`uid_kartu`,`nama`,`tipe_kartu`,`ruangan`,`hasil`,`created_at`,`updated_at`,`mode`,`url_gambar`) values 
('def','test','KTM','LAB MI',2,'2019-09-09 03:54:37','2019-09-09 03:54:37',NULL,NULL),
('abc','Tak Dikenal','Tak Diketahui','LAB MI',0,'2019-09-09 03:54:38','2019-09-09 03:54:38',NULL,NULL),
('abc','test','KTM','LAB MI',2,'2019-09-09 03:57:44','2019-09-09 03:57:44',NULL,NULL),
('abc','test','KTM','LAB MI',1,'2019-09-09 03:57:52','2019-09-09 03:57:52',NULL,NULL),
('abc','test','KTM','LAB MI',1,'2019-09-09 03:58:19','2019-09-09 03:58:19',NULL,NULL),
('deg','test','KTM','LAB MI',2,'2019-09-09 03:58:24','2019-09-09 03:58:24',NULL,NULL),
('deg','test','KTM','LAB MI',1,'2019-09-09 03:58:27','2019-09-09 03:58:27',NULL,NULL),
('deg','test','KTM','LAB MI',1,'2019-09-09 03:58:29','2019-09-09 03:58:29',NULL,NULL),
('deg','test','KTM','LAB MI',1,'2019-09-09 03:58:59','2019-09-09 03:58:59',NULL,NULL),
('deg','test','KTM','LAB MI',0,'2019-09-09 04:00:23','2019-09-09 04:00:23',NULL,NULL),
('abc','Tak Dikenal','Tak Diketahui','LAB MI',0,'2019-09-16 11:04:20','2019-09-16 11:04:20',NULL,NULL),
('abc','Tak Dikenal','Tak Diketahui','LAB MI',0,'2019-09-16 11:04:20','2019-09-16 11:04:20',NULL,NULL),
('abc','Tak Dikenal','Tak Diketahui','LAB MI',0,'2019-09-16 11:04:33','2019-09-16 11:04:33',NULL,NULL),
('990c4e98','Tak Dikenal','Tak Diketahui','LAB MI',0,'2019-09-16 11:05:33','2019-09-16 11:05:33',NULL,NULL),
('990c4e98','Tak Dikenal','Tak Diketahui','LAB MI',0,'2019-09-16 11:05:38','2019-09-16 11:05:38',NULL,NULL),
('990c4e98','Tak Dikenal','Tak Diketahui','LAB MI',0,'2019-09-16 11:05:43','2019-09-16 11:05:43',NULL,NULL),
('990c4e98','Tak Dikenal','Tak Diketahui','LAB MI',0,'2019-09-16 11:05:48','2019-09-16 11:05:48',NULL,NULL),
('990c4e98','Tak Dikenal','Tak Diketahui','LAB MI',0,'2019-09-16 11:05:52','2019-09-16 11:05:52',NULL,NULL),
('042a3cfa122c80','Tak Dikenal','Tak Diketahui','LAB MI',0,'2019-09-16 11:07:37','2019-09-16 11:07:37',NULL,NULL),
('042a3cfa122c80','Tak Dikenal','Tak Diketahui','LAB MI',0,'2019-09-16 11:07:42','2019-09-16 11:07:42',NULL,NULL),
('042a3cfa122c80','Tak Dikenal','Tak Diketahui','LAB MI',0,'2019-09-16 11:07:47','2019-09-16 11:07:47',NULL,NULL),
('042a3cfa122c80','Tak Dikenal','Tak Diketahui','LAB MI',0,'2019-09-16 11:07:52','2019-09-16 11:07:52',NULL,NULL),
('042a3cfa122c80','Tak Dikenal','Tak Diketahui','LAB MI',0,'2019-09-16 11:07:57','2019-09-16 11:07:57',NULL,NULL),
('042a3cfa122c80','Tak Dikenal','Tak Diketahui','LAB MI',0,'2019-09-16 11:08:02','2019-09-16 11:08:02',NULL,NULL),
('042a3cfa122c80','Tak Dikenal','Tak Diketahui','LAB MI',0,'2019-09-16 11:08:07','2019-09-16 11:08:07',NULL,NULL),
('042a3cfa122c80','Tak Dikenal','Tak Diketahui','LAB MI',0,'2019-09-16 11:08:12','2019-09-16 11:08:12',NULL,NULL),
('042a3cfa122c80','Tak Dikenal','Tak Diketahui','LAB MI',0,'2019-09-16 11:08:17','2019-09-16 11:08:17',NULL,NULL),
('042a3cfa122c80','Tak Dikenal','Tak Diketahui','LAB MI',0,'2019-09-16 11:08:22','2019-09-16 11:08:22',NULL,NULL),
('042a3cfa122c80','Tak Dikenal','Tak Diketahui','LAB MI',0,'2019-09-16 11:09:18','2019-09-16 11:09:18',NULL,NULL),
('042a3cfa122c80','Tak Dikenal','Tak Diketahui','LAB MI',0,'2019-09-16 11:09:23','2019-09-16 11:09:23',NULL,NULL),
('042a3cfa122c80','Tak Dikenal','Tak Diketahui','LAB MI',0,'2019-09-16 11:09:28','2019-09-16 11:09:28',NULL,NULL),
('042a3cfa122c80','Tak Dikenal','Tak Diketahui','LAB MI',0,'2019-09-16 11:09:33','2019-09-16 11:09:33',NULL,NULL),
('042a3cfa122c80','Tak Dikenal','Tak Diketahui','LAB MI',0,'2019-09-16 11:09:38','2019-09-16 11:09:38',NULL,NULL),
('042a3cfa122c80','Tak Dikenal','Tak Diketahui','LAB MI',0,'2019-09-16 11:09:43','2019-09-16 11:09:43',NULL,NULL),
('042a3cfa122c80','Tak Dikenal','Tak Diketahui','LAB MI',0,'2019-09-16 11:09:49','2019-09-16 11:09:49',NULL,NULL),
('042a3cfa122c80','Tak Dikenal','Tak Diketahui','LAB MI',0,'2019-09-16 11:09:53','2019-09-16 11:09:53',NULL,NULL),
('042a3cfa122c80','Tak Dikenal','Tak Diketahui','LAB MI',0,'2019-09-16 11:12:55','2019-09-16 11:12:55',NULL,NULL),
('990c4e98','Tak Dikenal','Tak Diketahui','LAB MI',0,'2019-09-16 11:13:01','2019-09-16 11:13:01',NULL,NULL),
('990c4e98','Tak Dikenal','Tak Diketahui','LAB MI',0,'2019-09-16 11:28:34','2019-09-16 11:28:34',NULL,NULL),
('990c4e98','Tak Dikenal','Tak Diketahui','LAB MI',0,'2019-09-16 11:29:52','2019-09-16 11:29:52',NULL,NULL),
('990c4e98','Tak Dikenal','Tak Diketahui','LAB MI',0,'2019-09-16 11:30:13','2019-09-16 11:30:13',NULL,NULL),
('990c4e98','Tak Dikenal','Tak Diketahui','LAB MI',0,'2019-09-16 11:30:31','2019-09-16 11:30:31',NULL,NULL),
('990c4e98','Tak Dikenal','Tak Diketahui','LAB MI',0,'2019-09-16 11:30:45','2019-09-16 11:30:45',NULL,NULL),
('990c4e98','Tak Dikenal','Tak Diketahui','LAB MI',0,'2019-09-16 11:31:04','2019-09-16 11:31:04',NULL,NULL),
('042a3cfa122c80','test','KTP','LAB MI',2,'2019-09-16 11:32:35','2019-09-16 11:32:35',NULL,NULL),
('042a3cfa122c80','test','KTP','LAB MI',1,'2019-09-16 11:36:17','2019-09-16 11:36:17',NULL,NULL),
('04915162112a80','Tak Dikenal','Tak Diketahui','LAB MI',0,'2019-09-26 09:28:09','2019-09-26 09:28:09',NULL,NULL),
('04915162112a80','Tak Dikenal','Tak Diketahui','LAB MI',0,'2019-09-26 09:28:19','2019-09-26 09:28:19',NULL,NULL),
('04915162112a80','Tak Dikenal','Tak Diketahui','LAB MI',0,'2019-09-26 09:28:48','2019-09-26 09:28:48',NULL,NULL),
('042a3cfa122c80','Dhafa Hikmawan','KTP','LAB MI',2,'2019-09-26 09:31:12','2019-09-26 09:31:12',NULL,NULL),
('042a3cfa122c80','Dhafa Hikmawan','KTP','LAB MI',1,'2019-09-26 09:31:18','2019-09-26 09:31:18',NULL,NULL),
('042a3cfa122c80','Dhafa Hikmawan','KTP','LAB MI',1,'2019-09-26 09:31:35','2019-09-26 09:31:35',NULL,NULL),
('042a3cfa122c80','Dhafa Hikmawan','KTP','LAB MI',1,'2019-09-26 09:31:58','2019-09-26 09:31:58',NULL,NULL),
('042a3cfa122c80','Dhafa Hikmawan','KTP','LAB MI',1,'2019-09-26 09:32:18','2019-09-26 09:32:18',NULL,NULL),
('042a3cfa122c80','Dhafa Hikmawan','KTP','LAB MI',1,'2019-09-26 09:32:48','2019-09-26 09:32:48',NULL,NULL),
('8f4c6fdc','Tak Dikenal','Tak Diketahui','LAB MI',0,'2019-09-26 09:33:15','2019-09-26 09:33:15',NULL,NULL),
('8f4c6fdc','Tak Dikenal','Tak Diketahui','LAB MI',0,'2019-09-26 09:33:23','2019-09-26 09:33:23',NULL,NULL),
('042a3cfa122c80','Dhafa Hikmawan','KTP','LAB MI',1,'2019-09-26 09:33:32','2019-09-26 09:33:32',NULL,NULL),
('042a3cfa122c80','Dhafa Hikmawan','KTP','LAB MI',1,'2019-09-26 09:33:49','2019-09-26 09:33:49',NULL,NULL),
('042a3cfa122c80','Dhafa Hikmawan','KTP','LAB MI',1,'2019-09-26 09:34:11','2019-09-26 09:34:11',NULL,NULL),
('042a3cfa122c80','Dhafa Hikmawan','KTP','LAB MI',1,'2019-09-26 09:34:32','2019-09-26 09:34:32',NULL,NULL),
('042a3cfa122c80','Dhafa Hikmawan','KTP','LAB MI',1,'2019-09-26 09:34:49','2019-09-26 09:34:49',NULL,NULL),
('04915162112a80','Muhammad Abyan Dzaka','KTP','LAB MI',2,'2019-09-26 09:43:33','2019-09-26 09:43:33',NULL,NULL),
('04915162112a80','Muhammad Abyan Dzaka','KTP','LAB MI',1,'2019-09-26 09:45:27','2019-09-26 09:45:27',NULL,NULL),
('042a3cfa122c80','Muhammad Abyan Dzaka','KTP','LAB MI',2,'2019-09-26 09:47:30','2019-09-26 09:47:30',NULL,NULL),
('042a3cfa122c80','Muhammad Abyan Dzaka','KTP','LAB MI',1,'2019-09-26 09:47:56','2019-09-26 09:47:56',NULL,NULL),
('042a3cfa122c80','Muhammad Abyan Dzaka','KTP','LAB MI',1,'2019-09-26 09:48:41','2019-09-26 09:48:41',NULL,NULL),
('042a3cfa122c80','Muhammad Abyan Dzaka','KTP','LAB MI',1,'2019-09-26 09:50:11','2019-09-26 09:50:11',NULL,NULL),
('042a3cfa122c80','Muhammad Abyan Dzaka','KTP','LAB MI',1,'2019-09-26 09:50:30','2019-09-26 09:50:30',NULL,NULL),
('042a3cfa122c80','Muhammad Abyan Dzaka','KTP','LAB MI',1,'2019-09-26 09:51:14','2019-09-26 09:51:14',NULL,NULL),
('042a3cfa122c80','Muhammad Abyan Dzaka','KTP','LAB MI',1,'2019-09-26 09:51:52','2019-09-26 09:51:52',NULL,NULL),
('042a3cfa122c80','Muhammad Abyan Dzaka','KTP','LAB MI',1,'2019-09-26 09:53:14','2019-09-26 09:53:14',NULL,NULL),
('abc','Muhammad Abyan Dzaka','KTP','LAB MI',1,'2019-10-10 23:38:32','2019-10-10 23:38:32',NULL,NULL),
('abc','Muhammad Abyan Dzaka','KTP','LAB MI',1,'2019-10-10 23:38:50','2019-10-10 23:38:50',NULL,NULL),
('abc','Muhammad Abyan Dzaka','KTP','LAB MI',1,'2019-10-10 23:39:58','2019-10-10 23:39:58',NULL,NULL),
('abc','Muhammad Abyan Dzaka','KTP','LAB MI',1,'2019-10-10 23:40:02','2019-10-10 23:40:02',NULL,NULL),
('abc','Muhammad Abyan Dzaka','KTP','LAB MI',1,'2019-10-10 23:40:32','2019-10-10 23:40:32',NULL,NULL),
('abc','Muhammad Abyan Dzaka','KTP','LAB MI',1,'2019-10-10 23:40:35','2019-10-10 23:40:35',NULL,NULL),
('abc','Muhammad Abyan Dzaka','KTP','LAB MI',1,'2019-10-10 23:41:30','2019-10-10 23:41:30',NULL,NULL),
('def','Muhammad Abyan Dzaka','KTP','LAB MI',2,'2019-10-10 23:41:46','2019-10-10 23:41:46',NULL,NULL),
('def','Muhammad Abyan Dzaka','KTP','LAB MI',1,'2019-10-10 23:41:55','2019-10-10 23:41:55',NULL,NULL),
('abc','Tak Dikenal','Tak Diketahui','LAB MI',0,'2019-10-11 00:54:50','2019-10-11 00:54:50',NULL,NULL),
('def','Muhammad Abyan Dzaka','KTP','LAB MI',1,'2019-10-11 00:54:54','2019-10-11 00:54:54',NULL,NULL),
('def','Muhammad Abyan Dzaka','KTP','LAB MI',1,'2019-10-11 01:21:06','2019-10-11 01:21:06',NULL,NULL),
('def','Muhammad Abyan Dzaka','KTP','LAB MI',1,'2019-10-11 01:21:48','2019-10-11 01:21:48',NULL,NULL),
('042a3cfa122c80','Muhammad Abyan Dzaka','KTP','LAB MI',2,'2019-10-11 01:33:11','2019-10-11 01:33:11',NULL,NULL),
('042a3cfa122c80','Muhammad Abyan Dzaka','KTP','LAB MI',1,'2019-10-11 01:33:17','2019-10-11 01:33:17',NULL,NULL),
('042a3cfa122c80','Muhammad Abyan Dzaka','KTP','LAB MI',1,'2019-10-11 01:36:12','2019-10-11 01:36:12',NULL,NULL),
('042a3cfa122c80','Muhammad Abyan Dzaka','KTP','LAB MI',1,'2019-10-11 01:36:40','2019-10-11 01:36:40',NULL,NULL),
('990c4e98','Tak Dikenal','Tak Diketahui','LAB MI',0,'2019-10-11 01:39:18','2019-10-11 01:39:18',NULL,NULL),
('042a3cfa122c80','Muhammad Abyan Dzaka','KTP','LAB MI',1,'2019-10-11 01:39:22','2019-10-11 01:39:22',NULL,NULL),
('042a3cfa122c80','Muhammad Abyan Dzaka','KTP','LAB MI',1,'2019-10-11 07:55:44','2019-10-11 07:55:44',NULL,NULL),
('042a3cfa122c80','Muhammad Abyan Dzaka','KTP','LAB MI',1,'2019-10-11 08:21:29','2019-10-11 08:21:29',NULL,NULL),
('042a3cfa122c80','Muhammad Abyan Dzaka','KTP','LAB MI',1,'2019-10-11 08:21:32','2019-10-11 08:21:32',NULL,NULL),
('042a3cfa122c80','Muhammad Abyan Dzaka','KTP','LAB MI',1,'2019-10-11 09:37:45','2019-10-11 09:37:45',NULL,NULL),
('042a3cfa122c80','Muhammad Abyan Dzaka','KTP','LAB MI',1,'2019-10-11 09:41:11','2019-10-11 09:41:11',NULL,NULL),
('042a3cfa122c80','Muhammad Abyan Dzaka','KTP','LAB MI',1,'2019-10-11 22:44:33','2019-10-11 22:44:33',NULL,NULL),
('def','Tak Dikenal','Tak Diketahui','LAB MI',0,'2019-10-12 07:03:06','2019-10-12 07:03:06',NULL,NULL),
('def','Tak Dikenal','Tak Diketahui','LAB MI',0,'2019-10-12 07:03:43','2019-10-12 07:03:43',NULL,NULL),
('8f8c1888','Tak Dikenal','Tak Diketahui','LAB MI',0,'2019-10-12 07:14:16','2019-10-12 07:14:16',NULL,NULL),
('8f8c1888','Tak Dikenal','Tak Diketahui','LAB MI',0,'2019-10-12 07:14:19','2019-10-12 07:14:19',NULL,NULL),
('990c4e98','Tak Dikenal','Tak Diketahui','LAB MI',0,'2019-10-12 07:14:57','2019-10-12 07:14:57',NULL,NULL),
('042a3cfa122c80','Muhammad Abyan Dzaka','KTP','LAB MI',1,'2019-10-12 07:19:07','2019-10-12 07:19:07',NULL,NULL),
('042a3cfa122c80','Muhammad Abyan Dzaka','KTP','LAB MI',1,'2019-10-12 07:19:18','2019-10-12 07:19:18',NULL,NULL),
('042a3cfa122c80','Muhammad Abyan Dzaka','KTP','LAB MI',1,'2019-10-12 07:19:47','2019-10-12 07:19:47',NULL,NULL),
('042a3cfa122c80','Muhammad Abyan Dzaka','KTP','LAB MI',1,'2019-10-12 07:22:11','2019-10-12 07:22:11',NULL,NULL),
('042a3cfa122c80','Muhammad Abyan Dzaka','KTP','LAB MI',1,'2019-10-12 07:25:08','2019-10-12 07:25:08',NULL,NULL),
('042a3cfa122c80','Muhammad Abyan Dzaka','KTP','LAB MI',1,'2019-10-12 07:25:51','2019-10-12 07:25:51',NULL,NULL),
('042a3cfa122c80','Muhammad Abyan Dzaka','KTP','LAB MI',1,'2019-10-12 07:26:00','2019-10-12 07:26:00',NULL,NULL),
('990c4e98','Dhafa Hikmawan','KTP','LAB MI',2,'2019-10-12 07:29:39','2019-10-12 07:29:39',NULL,NULL),
('990c4e98','Dhafa Hikmawan','KTP','LAB MI',1,'2019-10-12 07:29:43','2019-10-12 07:29:43',NULL,NULL),
('042a3cfa122c80','Muhammad Abyan Dzaka','KTP','LAB MI',1,'2019-10-12 07:43:43','2019-10-12 07:43:43',NULL,NULL),
('042a3cfa122c80','Muhammad Abyan Dzaka','KTP','LAB MI',1,'2019-10-12 08:01:10','2019-10-12 08:01:10',NULL,NULL),
('990c4e98','Dhafa Hikmawan','KTP','LAB MI',1,'2019-10-12 08:01:24','2019-10-12 08:01:24',NULL,NULL),
('045e1db2a15780','Tak Dikenal','Tak Diketahui','LAB MI',0,'2019-10-12 08:05:39','2019-10-12 08:05:39',NULL,NULL),
('045e1db2a15780','Tak Dikenal','Tak Diketahui','LAB MI',0,'2019-10-12 08:05:44','2019-10-12 08:05:44',NULL,NULL),
('def','Tak Dikenal','Tak Diketahui','LAB MI',0,'2019-10-15 02:18:13','2019-10-15 02:18:13',NULL,NULL),
('def','Tak Dikenal','Tak Diketahui','LAB MI',0,'2019-10-15 02:18:35','2019-10-15 02:18:35',NULL,NULL),
('042a3cfa122c80','Muhammad Abyan Dzaka','KTP','LAB MI',1,'2019-10-15 02:18:56','2019-10-15 02:18:56',NULL,NULL),
('042a3cfa122c80','Muhammad Abyan Dzaka','KTP','LAB MI',1,'2019-10-15 02:19:23','2019-10-15 02:19:23',NULL,NULL),
('042a3cfa122c80','Muhammad Abyan Dzaka','KTP','LAB MI',1,'2019-10-15 02:19:45','2019-10-15 02:19:45',NULL,NULL),
('042a3cfa122c80','Muhammad Abyan Dzaka','KTP','LAB MI',1,'2019-10-15 02:20:47','2019-10-15 02:20:47',NULL,NULL),
('042a3cfa122c80','Muhammad Abyan Dzaka','KTP','LAB MI',1,'2019-10-15 02:21:19','2019-10-15 02:21:19',NULL,NULL),
('990c4e98','Dhafa Hikmawan','KTP','LAB MI',1,'2019-10-15 02:22:37','2019-10-15 02:22:37',NULL,NULL),
('990c4e98','Dhafa Hikmawan','KTP','LAB MI',1,'2019-10-15 02:23:18','2019-10-15 02:23:18',NULL,NULL),
('990c4e98','Dhafa Hikmawan','KTP','LAB MI',1,'2019-10-15 02:24:57','2019-10-15 02:24:57',NULL,NULL),
('990c4e98','Dhafa Hikmawan','KTP','LAB MI',1,'2019-10-15 02:25:38','2019-10-15 02:25:38',NULL,NULL),
('990c4e98','Dhafa Hikmawan','KTP','LAB MI',1,'2019-10-15 02:26:12','2019-10-15 02:26:12',NULL,NULL),
('990c4e98','Dhafa Hikmawan','KTP','LAB MI',1,'2019-10-15 02:26:26','2019-10-15 02:26:26',NULL,NULL),
('990c4e98','Dhafa Hikmawan','KTP','LAB MI',1,'2019-10-15 02:27:31','2019-10-15 02:27:31',NULL,NULL),
('990c4e98','Dhafa Hikmawan','KTP','LAB MI',1,'2019-10-15 02:27:36','2019-10-15 02:27:36',NULL,NULL),
('990c4e98','Dhafa Hikmawan','KTP','LAB MI',1,'2019-10-15 02:28:19','2019-10-15 02:28:19',NULL,NULL),
('990c4e98','Dhafa Hikmawan','KTP','LAB MI',1,'2019-10-15 02:28:39','2019-10-15 02:28:39',NULL,NULL),
('990c4e98','Dhafa Hikmawan','KTP','LAB MI',1,'2019-10-15 02:28:46','2019-10-15 02:28:46',NULL,NULL),
('990c4e98','Dhafa Hikmawan','KTP','LAB MI',1,'2019-10-15 02:28:51','2019-10-15 02:28:51',NULL,NULL),
('990c4e98','Dhafa Hikmawan','KTP','LAB MI',1,'2019-10-15 02:29:35','2019-10-15 02:29:35',NULL,NULL),
('990c4e98','Dhafa Hikmawan','KTP','LAB MI',1,'2019-10-15 02:43:50','2019-10-15 02:43:50',NULL,NULL),
('990c4e98','Dhafa Hikmawan','KTP','LAB MI',1,'2019-10-15 02:44:21','2019-10-15 02:44:21',NULL,NULL),
('990c4e98','Dhafa Hikmawan','KTP','LAB MI',1,'2019-10-15 02:44:47','2019-10-15 02:44:47',NULL,NULL),
('990c4e98','Dhafa Hikmawan','KTP','LAB MI',1,'2019-10-15 02:45:01','2019-10-15 02:45:01',NULL,NULL),
('990c4e98','Dhafa Hikmawan','KTP','LAB MI',1,'2019-10-15 02:56:46','2019-10-15 02:56:46',NULL,NULL),
('990c4e98','Dhafa Hikmawan','KTP','LAB MI',1,'2019-10-15 02:56:59','2019-10-15 02:56:59',NULL,NULL),
('990c4e98','Dhafa Hikmawan','KTP','LAB MI',1,'2019-10-15 03:21:53','2019-10-15 03:21:53',NULL,NULL),
('990c4e98','Dhafa Hikmawan','KTP','LAB MI',1,'2019-10-15 03:37:23','2019-10-15 03:37:23',NULL,NULL),
('990c4e98','Dhafa Hikmawan','KTP','LAB MI',1,'2019-10-15 03:57:05','2019-10-15 03:57:05',NULL,NULL),
('990c4e98','Dhafa Hikmawan','KTP','LAB MI',1,'2019-10-15 03:57:34','2019-10-15 03:57:34',NULL,NULL),
('990c4e98','Dhafa Hikmawan','KTP','LAB MI',1,'2019-10-15 03:58:29','2019-10-15 03:58:29',NULL,NULL),
('990c4e98','Dhafa Hikmawan','KTP','LAB MI',1,'2019-10-15 03:58:58','2019-10-15 03:58:58',NULL,NULL),
('990c4e98','Dhafa Hikmawan','KTP','LAB MI',1,'2019-10-15 03:59:35','2019-10-15 03:59:35',NULL,NULL),
('990c4e98','Dhafa Hikmawan','KTP','LAB MI',1,'2019-10-15 04:00:01','2019-10-15 04:00:01',NULL,NULL),
('990c4e98','Dhafa Hikmawan','KTP','LAB MI',1,'2019-10-15 04:00:25','2019-10-15 04:00:25',NULL,NULL),
('990c4e98','Dhafa Hikmawan','KTP','LAB MI',1,'2019-10-15 04:14:08','2019-10-15 04:14:08',NULL,NULL),
('990c4e98','Dhafa Hikmawan','KTP','LAB MI',1,'2019-10-15 04:14:48','2019-10-15 04:14:48',NULL,NULL),
('990c4e98','Dhafa Hikmawan','KTP','LAB MI',1,'2019-10-15 04:15:14','2019-10-15 04:15:14',NULL,NULL),
('990c4e98','Dhafa Hikmawan','KTP','LAB MI',1,'2019-10-15 04:15:20','2019-10-15 04:15:20',NULL,NULL),
('990c4e98','Dhafa Hikmawan','KTP','LAB MI',1,'2019-10-15 04:15:56','2019-10-15 04:15:56',NULL,NULL),
('990c4e98','Dhafa Hikmawan','KTP','LAB MI',1,'2019-10-15 04:16:28','2019-10-15 04:16:28',NULL,NULL),
('990c4e98','Dhafa Hikmawan','KTP','LAB MI',1,'2019-10-15 04:16:36','2019-10-15 04:16:36',NULL,NULL),
('990c4e98','Dhafa Hikmawan','KTP','LAB MI',1,'2019-10-15 04:17:01','2019-10-15 04:17:01',NULL,NULL),
('990c4e98','Dhafa Hikmawan','KTP','LAB MI',1,'2019-10-15 04:17:13','2019-10-15 04:17:13',NULL,NULL),
('990c4e98','Dhafa Hikmawan','KTP','LAB MI',1,'2019-10-15 04:17:28','2019-10-15 04:17:28',NULL,NULL),
('990c4e98','Dhafa Hikmawan','KTP','LAB MI',1,'2019-10-15 04:17:56','2019-10-15 04:17:56',NULL,NULL),
('990c4e98','Dhafa Hikmawan','KTP','LAB MI',1,'2019-10-15 04:23:59','2019-10-15 04:23:59',NULL,NULL),
('990c4e98','Dhafa Hikmawan','KTP','LAB MI',1,'2019-10-15 04:26:18','2019-10-15 04:26:18',NULL,NULL),
('990c4e98','Dhafa Hikmawan','KTP','LAB MI',1,'2019-10-15 04:48:28','2019-10-15 04:48:28',NULL,NULL),
('990c4e98','Dhafa Hikmawan','KTP','LAB MI',1,'2019-10-15 04:49:22','2019-10-15 04:49:22',NULL,NULL),
('990c4e98','Dhafa Hikmawan','KTP','LAB MI',1,'2019-10-15 04:49:43','2019-10-15 04:49:43',NULL,NULL),
('990c4e98','Dhafa Hikmawan','KTP','LAB MI',1,'2019-10-15 04:49:57','2019-10-15 04:49:57',NULL,NULL),
('990c4e98','Dhafa Hikmawan','KTP','LAB MI',1,'2019-10-15 06:19:58','2019-10-15 06:19:58',NULL,NULL),
('990c4e98','Dhafa Hikmawan','KTP','LAB MI',1,'2019-10-15 06:20:21','2019-10-15 06:20:21',NULL,NULL),
('990c4e98','Dhafa Hikmawan','KTP','LAB MI',1,'2019-10-15 06:20:53','2019-10-15 06:20:53',NULL,NULL),
('990c4e98','Dhafa Hikmawan','KTP','LAB MI',1,'2019-10-15 06:21:06','2019-10-15 06:21:06',NULL,NULL),
('990c4e98','Dhafa Hikmawan','KTP','LAB MI',1,'2019-10-15 06:23:07','2019-10-15 06:23:07',NULL,NULL),
('990c4e98','Dhafa Hikmawan','KTP','LAB MI',1,'2019-10-15 06:29:53','2019-10-15 06:29:53',NULL,NULL),
('990c4e98','Dhafa Hikmawan','KTP','LAB MI',1,'2019-10-15 09:54:56','2019-10-15 09:54:56',NULL,NULL),
('990c4e98','Dhafa Hikmawan','KTP','LAB MI',1,'2019-10-15 09:58:07','2019-10-15 09:58:07',NULL,NULL),
('990c4e98','Dhafa Hikmawan','KTP','LAB MI',1,'2019-10-15 10:05:28','2019-10-15 10:05:28',NULL,NULL),
('990c4e98','Dhafa Hikmawan','KTP','LAB MI',1,'2019-10-15 10:05:41','2019-10-15 10:05:41',NULL,NULL),
('990c4e98','Dhafa Hikmawan','KTP','LAB MI',1,'2019-10-15 10:05:59','2019-10-15 10:05:59',NULL,NULL),
('990c4e98','Dhafa Hikmawan','KTP','LAB MI',1,'2019-10-15 10:06:34','2019-10-15 10:06:34',NULL,NULL),
('990c4e98','Dhafa Hikmawan','KTP','LAB MI',1,'2019-10-15 10:06:47','2019-10-15 10:06:47',NULL,NULL),
('990c4e98','Dhafa Hikmawan','KTP','LAB MI',1,'2019-10-15 10:07:33','2019-10-15 10:07:33',NULL,NULL),
('990c4e98','Dhafa Hikmawan','KTP','LAB MI',1,'2019-10-15 10:12:57','2019-10-15 10:12:57',NULL,NULL),
('990c4e98','Dhafa Hikmawan','KTP','LAB MI',1,'2019-10-15 10:14:36','2019-10-15 10:14:36',NULL,NULL),
('990c4e98','Dhafa Hikmawan','KTP','LAB MI',1,'2019-10-15 10:15:02','2019-10-15 10:15:02',NULL,NULL),
('990c4e98','Dhafa Hikmawan','KTP','LAB MI',1,'2019-10-15 10:15:11','2019-10-15 10:15:11',NULL,NULL),
('990c4e98','Dhafa Hikmawan','KTP','LAB MI',1,'2019-10-15 10:15:18','2019-10-15 10:15:18',NULL,NULL),
('990c4e98','Dhafa Hikmawan','KTP','LAB MI',1,'2019-10-15 10:21:49','2019-10-15 10:21:49',NULL,NULL),
('042a3cfa122c80','Muhammad Abyan Dzaka','KTP','LAB MI',1,'2019-10-15 10:44:04','2019-10-15 10:44:04',NULL,NULL),
('042a3cfa122c80','Muhammad Abyan Dzaka','KTP','LAB MI',1,'2019-10-15 10:47:23','2019-10-15 10:47:23',NULL,NULL),
('042a3cfa122c80','Muhammad Abyan Dzaka','KTP','LAB MI',1,'2019-10-15 10:49:35','2019-10-15 10:49:35',NULL,NULL),
('042a3cfa122c80','Muhammad Abyan Dzaka','KTP','LAB MI',1,'2019-10-15 10:52:37','2019-10-15 10:52:37',NULL,NULL),
('042a3cfa122c80','Muhammad Abyan Dzaka','KTP','LAB MI',1,'2019-10-15 11:00:31','2019-10-15 11:00:31',NULL,NULL),
('042a3cfa122c80','Muhammad Abyan Dzaka','KTP','LAB MI',1,'2019-10-15 11:03:42','2019-10-15 11:03:42',NULL,NULL),
('042a3cfa122c80','Muhammad Abyan Dzaka','KTP','LAB MI',1,'2019-10-15 11:04:47','2019-10-15 11:04:47',NULL,NULL),
('042a3cfa122c80','Muhammad Abyan Dzaka','KTP','LAB MI',1,'2019-10-15 11:04:55','2019-10-15 11:04:55',NULL,NULL),
('990c4e98','Dhafa Hikmawan','KTP','LAB MI',1,'2019-10-15 11:07:26','2019-10-15 11:07:26',NULL,NULL),
('042a3cfa122c80','Muhammad Abyan Dzaka','KTP','LAB MI',1,'2019-10-15 11:07:37','2019-10-15 11:07:37',NULL,NULL),
('042a3cfa122c80','Muhammad Abyan Dzaka','KTP','LAB MI',1,'2019-10-15 11:11:38','2019-10-15 11:11:38',NULL,NULL),
('042a3cfa122c80','Muhammad Abyan Dzaka','KTP','LAB MI',1,'2019-10-15 11:16:00','2019-10-15 11:16:00',NULL,NULL),
('042a3cfa122c80','Muhammad Abyan Dzaka','KTP','LAB MI',1,'2019-10-15 11:22:22','2019-10-15 11:22:22',NULL,NULL),
('042a3cfa122c80','Muhammad Abyan Dzaka','KTP','LAB MI',1,'2019-10-15 11:23:36','2019-10-15 11:23:36',NULL,NULL),
('042a3cfa122c80','Muhammad Abyan Dzaka','KTP','LAB MI',1,'2019-10-15 11:23:48','2019-10-15 11:23:48',NULL,NULL),
('042a3cfa122c80','Muhammad Abyan Dzaka','KTP','LAB MI',1,'2019-10-15 11:32:24','2019-10-15 11:32:24',NULL,NULL),
('042a3cfa122c80','Muhammad Abyan Dzaka','KTP','LAB MI',1,'2019-10-15 11:36:03','2019-10-15 11:36:03',NULL,NULL),
('042a3cfa122c80','Muhammad Abyan Dzaka','KTP','LAB MI',1,'2019-10-15 11:39:12','2019-10-15 11:39:12',NULL,NULL),
('042a3cfa122c80','Muhammad Abyan Dzaka','KTP','LAB MI',1,'2019-10-15 11:46:05','2019-10-15 11:46:05',NULL,NULL),
('042a3cfa122c80','Muhammad Abyan Dzaka','KTP','LAB MI',1,'2019-10-15 11:47:30','2019-10-15 11:47:30',NULL,NULL),
('042a3cfa122c80','Muhammad Abyan Dzaka','KTP','LAB MI',1,'2019-10-15 11:53:13','2019-10-15 11:53:13',NULL,NULL),
('042a3cfa122c80','Muhammad Abyan Dzaka','KTP','LAB MI',1,'2019-10-15 11:54:15','2019-10-15 11:54:15',NULL,NULL),
('042a3cfa122c80','Muhammad Abyan Dzaka','KTP','LAB MI',1,'2019-10-15 12:00:21','2019-10-15 12:00:21',NULL,NULL),
('042a3cfa122c80','Muhammad Abyan Dzaka','KTP','LAB MI',1,'2019-10-15 12:02:10','2019-10-15 12:02:10',NULL,NULL),
('042a3cfa122c80','Muhammad Abyan Dzaka','KTP','LAB MI',1,'2019-10-15 12:02:22','2019-10-15 12:02:22',NULL,NULL),
('042a3cfa122c80','Muhammad Abyan Dzaka','KTP','LAB MI',1,'2019-10-15 12:27:19','2019-10-15 12:27:19',NULL,NULL),
('042a3cfa122c80','Muhammad Abyan Dzaka','KTP','LAB MI',1,'2019-10-15 12:28:36','2019-10-15 12:28:36',NULL,NULL),
('042a3cfa122c80','Muhammad Abyan Dzaka','KTP','LAB MI',1,'2019-10-15 12:31:31','2019-10-15 12:31:31',NULL,NULL),
('042a3cfa122c80','Muhammad Abyan Dzaka','KTP','LAB MI',1,'2019-10-15 12:32:45','2019-10-15 12:32:45',NULL,NULL),
('042a3cfa122c80','Muhammad Abyan Dzaka','KTP','LAB MI',1,'2019-10-15 12:37:30','2019-10-15 12:37:30',NULL,NULL),
('990c4e98','Dhafa Hikmawan','KTP','LAB MI',1,'2019-10-15 12:41:36','2019-10-15 12:41:36',NULL,NULL),
('990c4e98','Dhafa Hikmawan','KTP','LAB MI',1,'2019-10-15 12:45:46','2019-10-15 12:45:46',NULL,NULL),
('990c4e98','Dhafa Hikmawan','KTP','LAB MI',1,'2019-10-15 12:45:59','2019-10-15 12:45:59',NULL,NULL),
('990c4e98','Dhafa Hikmawan','KTP','LAB MI',1,'2019-10-15 12:46:10','2019-10-15 12:46:10',NULL,NULL),
('990c4e98','Dhafa Hikmawan','KTP','LAB MI',1,'2019-10-15 12:46:25','2019-10-15 12:46:25',NULL,NULL),
('990c4e98','Dhafa Hikmawan','KTP','LAB MI',1,'2019-10-15 12:55:42','2019-10-15 12:55:42',NULL,NULL),
('990c4e98','Dhafa Hikmawan','KTP','LAB MI',1,'2019-10-15 12:56:05','2019-10-15 12:56:05',NULL,NULL),
('990c4e98','Dhafa Hikmawan','KTP','LAB MI',1,'2019-10-15 12:56:16','2019-10-15 12:56:16',NULL,NULL),
('990c4e98','Dhafa Hikmawan','KTP','LAB MI',1,'2019-10-15 12:57:46','2019-10-15 12:57:46',NULL,NULL),
('990c4e98','Dhafa Hikmawan','KTP','LAB MI',1,'2019-10-15 12:57:59','2019-10-15 12:57:59',NULL,NULL),
('990c4e98','Dhafa Hikmawan','KTP','LAB MI',1,'2019-10-15 12:58:13','2019-10-15 12:58:13',NULL,NULL),
('990c4e98','Dhafa Hikmawan','KTP','LAB MI',1,'2019-10-15 13:00:05','2019-10-15 13:00:05',NULL,NULL),
('990c4e98','Dhafa Hikmawan','KTP','LAB MI',1,'2019-10-15 13:01:35','2019-10-15 13:01:35',NULL,NULL),
('990c4e98','Dhafa Hikmawan','KTP','LAB MI',1,'2019-10-15 13:01:55','2019-10-15 13:01:55',NULL,NULL),
('990c4e98','Dhafa Hikmawan','KTP','LAB MI',1,'2019-10-15 13:02:10','2019-10-15 13:02:10',NULL,NULL),
('990c4e98','Dhafa Hikmawan','KTP','LAB MI',1,'2019-10-15 13:02:24','2019-10-15 13:02:24',NULL,NULL),
('990c4e98','Dhafa Hikmawan','KTP','LAB MI',1,'2019-10-15 13:02:36','2019-10-15 13:02:36',NULL,NULL),
('042a3cfa122c80','Muhammad Abyan Dzaka','KTP','LAB MI',1,'2019-10-15 13:16:19','2019-10-15 13:16:19',NULL,NULL),
('042a3cfa122c80','Muhammad Abyan Dzaka','KTP','LAB MI',1,'2019-10-15 13:16:36','2019-10-15 13:16:36',NULL,NULL),
('042a3cfa122c80','Muhammad Abyan Dzaka','KTP','LAB MI',1,'2019-10-15 13:17:17','2019-10-15 13:17:17',NULL,NULL),
('042a3cfa122c80','Muhammad Abyan Dzaka','KTP','LAB MI',1,'2019-10-15 13:17:34','2019-10-15 13:17:34',NULL,NULL),
('042a3cfa122c80','Muhammad Abyan Dzaka','KTP','LAB MI',1,'2019-10-15 13:17:48','2019-10-15 13:17:48',NULL,NULL),
('042a3cfa122c80','Muhammad Abyan Dzaka','KTP','LAB MI',1,'2019-10-15 13:17:58','2019-10-15 13:17:58',NULL,NULL),
('042a3cfa122c80','Muhammad Abyan Dzaka','KTP','LAB MI',1,'2019-10-15 13:18:13','2019-10-15 13:18:13',NULL,NULL),
('042a3cfa122c80','Muhammad Abyan Dzaka','KTP','LAB MI',1,'2019-10-15 13:18:29','2019-10-15 13:18:29',NULL,NULL),
('042a3cfa122c80','Muhammad Abyan Dzaka','KTP','LAB MI',1,'2019-10-15 13:18:39','2019-10-15 13:18:39',NULL,NULL);

/*Table structure for table `migrations` */

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(1,'2014_10_12_000000_create_users_table',1),
(2,'2014_10_12_100000_create_password_resets_table',1),
(3,'2019_07_01_042551_create_pengguna_table',1),
(4,'2019_08_14_082253_create_logs_table',1),
(5,'2019_08_28_072503_create_kartus_table',1),
(6,'2019_08_28_072647_create_ruangs_table',1),
(7,'2019_08_28_072853_create_pendaftarans_table',1),
(8,'2019_08_28_073123_create_pengguna_ruang_table',1),
(9,'2019_08_28_073124_create_alats_table',1),
(10,'2019_08_28_073330_add_constraint_pengguna_ruang_table',1),
(11,'2019_08_28_073348_add_constraint_kartus_table',1),
(12,'2019_08_28_074036_add_constraint_pendaftarans_table',1),
(13,'2019_08_28_075354_create_constraint_alats_table',1),
(15,'2019_09_03_074958_add_proxy_to_alat',2),
(17,'2019_10_10_041406_add_mode_to_alats',4),
(18,'2019_10_10_041314_create_transaksis_table',5),
(19,'2019_10_10_042104_add_constraints_to_transaksis',6),
(20,'2019_10_11_221916_create_bpjs_table',7),
(21,'2019_10_11_222147_create_tikets_table',7),
(22,'2019_10_12_035620_create_keretas_table',7),
(23,'2019_10_14_042833_create_pasiens_table',7),
(24,'2019_10_14_065303_create_globals_table',8),
(25,'2019_10_14_065537_create_settings_table',9),
(26,'2019_10_16_010714_create_kelaskeretas_table',10),
(27,'2019_10_16_011119_create_kotas_table',10);

/*Table structure for table `pasiens` */

CREATE TABLE `pasiens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `diagnosa` text COLLATE utf8mb4_unicode_ci,
  `rs_rujukan` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `faskes_tingkat1` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pengguna_id` bigint(20) unsigned DEFAULT NULL,
  `nomor_antrian` int(10) unsigned DEFAULT NULL,
  `status` smallint(6) DEFAULT NULL,
  `rs_perujuk` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `pasiens` */

insert  into `pasiens`(`id`,`created_at`,`updated_at`,`diagnosa`,`rs_rujukan`,`faskes_tingkat1`,`pengguna_id`,`nomor_antrian`,`status`,`rs_perujuk`) values 
(8,'2019-10-15 10:21:49','2019-10-15 10:21:49',NULL,NULL,'RS Sip',4,1,-1,'RS Sip');

/*Table structure for table `password_resets` */

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `pendaftarans` */

CREATE TABLE `pendaftarans` (
  `uid` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipe` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alat_id` bigint(20) unsigned NOT NULL,
  `pengguna_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  KEY `pendaftarans_pengguna_id_foreign` (`pengguna_id`),
  KEY `pendaftarans_alat_id_foreign` (`alat_id`),
  CONSTRAINT `pendaftarans_alat_id_foreign` FOREIGN KEY (`alat_id`) REFERENCES `alats` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pendaftarans_pengguna_id_foreign` FOREIGN KEY (`pengguna_id`) REFERENCES `penggunas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `pendaftarans` */

/*Table structure for table `pengguna_ruang` */

CREATE TABLE `pengguna_ruang` (
  `pengguna_id` bigint(20) unsigned NOT NULL,
  `ruang_id` bigint(20) unsigned NOT NULL,
  KEY `pengguna_ruang_pengguna_id_foreign` (`pengguna_id`),
  KEY `pengguna_ruang_ruang_id_foreign` (`ruang_id`),
  CONSTRAINT `pengguna_ruang_pengguna_id_foreign` FOREIGN KEY (`pengguna_id`) REFERENCES `penggunas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pengguna_ruang_ruang_id_foreign` FOREIGN KEY (`ruang_id`) REFERENCES `ruangs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `pengguna_ruang` */

insert  into `pengguna_ruang`(`pengguna_id`,`ruang_id`) values 
(3,1),
(4,1),
(6,1);

/*Table structure for table `pengguna_tiket` */

CREATE TABLE `pengguna_tiket` (
  `pengguna_id` bigint(20) unsigned DEFAULT NULL,
  `tiket_id` bigint(20) unsigned DEFAULT NULL,
  `nomor_kursi` int(10) unsigned DEFAULT NULL,
  `check_in` tinyint(1) DEFAULT '0',
  `kelaskereta_id` bigint(20) unsigned DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `pengguna_tiket` */

insert  into `pengguna_tiket`(`pengguna_id`,`tiket_id`,`nomor_kursi`,`check_in`,`kelaskereta_id`) values 
(4,1,12,0,1);

/*Table structure for table `penggunas` */

CREATE TABLE `penggunas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_nik` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nrp` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nohp` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(75) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uid_kartu` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `penggunas_id_nik_unique` (`id_nik`),
  UNIQUE KEY `penggunas_nrp_unique` (`nrp`),
  UNIQUE KEY `penggunas_nohp_unique` (`nohp`),
  UNIQUE KEY `penggunas_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `penggunas` */

insert  into `penggunas`(`id`,`id_nik`,`name`,`nrp`,`jenis_kelamin`,`alamat`,`nohp`,`email`,`password`,`uid_kartu`,`status`,`created_at`,`updated_at`) values 
(3,'3215053001980003','Muhammad Abyan Dzaka','05111640007003','Laki-Laki','Perumahan puri kosambi blok W-29, Duren, Klari, Karawang.','085881751588','abyan.dzaka.if.its@gmail.com','$2y$10$PJcr3VhRwVTve2BQnN38kO4kQq.Ha7odXSxg8qyDPxUjcBUp5eD7u',NULL,0,'2019-09-26 09:40:25','2019-09-26 09:40:25'),
(4,'3573011807990004','Dhafa Hikmawan','05111640000124','Laki-Laki','Jl. Simpang Asahan 5','085853891701','nawamkihafahd@gmail.com','$2y$10$8jnp.ZAWOPG5FrNWoSQ9vOdkcKADeYtuO6UPTXn0WXJOL.hVBRKGW',NULL,0,'2019-10-11 22:36:55','2019-10-11 22:36:55'),
(6,'3578977654321111','Counter','05111640000122','Laki-Laki','Blok U 182','085853891702','rasp.d.a.a@gmail.com','$2y$10$zJAennH3YPXCcPHtmBO1m./5JTTS0FJyAsthGNCwjCvSvq.RlioVC',NULL,0,'2019-10-12 07:56:24','2019-10-12 07:56:24');

/*Table structure for table `ruangs` */

CREATE TABLE `ruangs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ruangs_nama_unique` (`nama`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `ruangs` */

insert  into `ruangs`(`id`,`nama`,`created_at`,`updated_at`) values 
(1,'LAB MI','2019-08-29 03:03:39','2019-08-29 03:03:39');

/*Table structure for table `settings` */

CREATE TABLE `settings` (
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `index_antrian` int(10) unsigned DEFAULT NULL,
  `nomor_antrian` int(10) unsigned DEFAULT NULL,
  `id_alat` bigint(20) unsigned DEFAULT NULL,
  `rs_nama` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `index_antrian_bpjs` int(10) unsigned DEFAULT NULL,
  `nomor_antrian_bpjs` int(10) unsigned DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `settings` */

insert  into `settings`(`created_at`,`updated_at`,`index_antrian`,`nomor_antrian`,`id_alat`,`rs_nama`,`index_antrian_bpjs`,`nomor_antrian_bpjs`) values 
(NULL,'2019-10-15 10:21:53',1,1,1,'RS Sip',0,0);

/*Table structure for table `tikets` */

CREATE TABLE `tikets` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kereta_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `kota_asal` bigint(20) unsigned DEFAULT NULL,
  `kota_tujuan` bigint(20) unsigned DEFAULT NULL,
  `tanggal_berangkat` datetime DEFAULT NULL,
  `check_in` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `tikets` */

insert  into `tikets`(`id`,`kereta_id`,`created_at`,`updated_at`,`kota_asal`,`kota_tujuan`,`tanggal_berangkat`,`check_in`) values 
(1,'1',NULL,NULL,1,2,'2019-10-17 10:09:32',0);

/*Table structure for table `transaksis` */

CREATE TABLE `transaksis` (
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `uid` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alat_id` bigint(20) unsigned NOT NULL,
  KEY `transaksis_alat_id_foreign` (`alat_id`),
  CONSTRAINT `transaksis_alat_id_foreign` FOREIGN KEY (`alat_id`) REFERENCES `alats` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `transaksis` */

/*Table structure for table `users` */

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`username`,`email`,`email_verified_at`,`password`,`remember_token`,`created_at`,`updated_at`) values 
(1,'Admin','admin','admin@gmail.com',NULL,'$2y$10$uPMSf0UjKUyU8GI3sL.1aueCnjEYMgZdiR4vYXNW5peCJsgUiT8Yy',NULL,'2019-08-29 03:03:39','2019-08-29 03:03:39');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
