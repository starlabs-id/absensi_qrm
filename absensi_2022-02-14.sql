# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.5.5-10.4.14-MariaDB)
# Database: absensi
# Generation Time: 2022-02-14 01:15:52 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table absen_lemburs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `absen_lemburs`;

CREATE TABLE `absen_lemburs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `lokasi_datang` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ttd` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jam_datang` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_datang` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hari_datang` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bulan_datang` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tahun_datang` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lokasi_pulang` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jam_pulang` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_pulang` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hari_pulang` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bulan_pulang` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tahun_pulang` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `validasi` enum('yes','no') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jam_validasi` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `validasi_by` int(11) DEFAULT NULL,
  `total_biaya_lembur` int(11) DEFAULT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `projek_id` bigint(20) unsigned NOT NULL,
  `absen_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `tukang_id` bigint(20) unsigned NOT NULL,
  `edit_by` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table absens
# ------------------------------------------------------------

DROP TABLE IF EXISTS `absens`;

CREATE TABLE `absens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `lokasi_datang` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ttd` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jam_datang` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_datang` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hari_datang` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bulan_datang` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tahun_datang` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lokasi_pulang` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jam_pulang` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_pulang` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hari_pulang` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bulan_pulang` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tahun_pulang` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `validasi` enum('yes','no') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jam_validasi` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `validasi_by` int(11) DEFAULT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `projek_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `tukang_id` bigint(20) unsigned NOT NULL,
  `edit_by` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table chat_details
# ------------------------------------------------------------

DROP TABLE IF EXISTS `chat_details`;

CREATE TABLE `chat_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `chat_id` bigint(20) unsigned DEFAULT NULL,
  `komentar` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pengirim` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table chats
# ------------------------------------------------------------

DROP TABLE IF EXISTS `chats`;

CREATE TABLE `chats` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `projek_id` bigint(20) unsigned DEFAULT NULL,
  `direktur_utama` int(11) DEFAULT NULL,
  `superadmin` int(11) DEFAULT NULL,
  `owner` int(11) DEFAULT NULL,
  `direktur_teknik` int(11) DEFAULT NULL,
  `admin_teknik` int(11) DEFAULT NULL,
  `pm` int(11) DEFAULT NULL,
  `marketing` int(11) DEFAULT NULL,
  `gm` int(11) DEFAULT NULL,
  `co_gm` int(11) DEFAULT NULL,
  `supervisor` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table detail_projeks
# ------------------------------------------------------------

DROP TABLE IF EXISTS `detail_projeks`;

CREATE TABLE `detail_projeks` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `projek_id` bigint(20) unsigned DEFAULT NULL,
  `uraian_pekerjaan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `volume_kontrak` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `harga_satuan` int(11) DEFAULT NULL,
  `volume_pekerjaan_hari_ini` int(11) DEFAULT NULL,
  `volume_dikerjakan` int(11) DEFAULT NULL,
  `prestasi_keuangan_hari_ini` int(11) DEFAULT NULL,
  `prestasi_fisik_hari_ini` int(11) DEFAULT NULL,
  `tanggal` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto_1` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto_2` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto_3` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto_4` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto_5` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto_6` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto_7` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto_8` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto_9` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto_10` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `edit_by` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table failed_jobs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table migrations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;

INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES
	(1,'2014_10_12_000000_create_users_table',1),
	(2,'2014_10_12_100000_create_password_resets_table',1),
	(3,'2019_08_19_000000_create_failed_jobs_table',1),
	(4,'2019_12_14_000001_create_personal_access_tokens_table',1),
	(5,'2022_02_10_030323_create_projeks_table',1),
	(6,'2022_02_10_032137_create_detail_projeks_table',1),
	(7,'2022_02_10_033438_create_tukangs_table',1),
	(8,'2022_02_10_034600_create_absens_table',1),
	(9,'2022_02_10_052414_create_absen_lemburs_table',1),
	(10,'2022_02_10_052932_create_shifts_table',1),
	(11,'2022_02_10_053856_create_chats_table',1),
	(12,'2022_02_10_054100_create_chat_details_table',1),
	(13,'2014_10_12_200000_add_two_factor_columns_to_users_table',2),
	(14,'2022_02_11_064443_create_permission_tables',3);

/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table model_has_permissions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `model_has_permissions`;

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table model_has_roles
# ------------------------------------------------------------

DROP TABLE IF EXISTS `model_has_roles`;

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `model_has_roles` WRITE;
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`)
VALUES
	(1,'App\\Models\\User',1),
	(1,'App\\Models\\User',3);

/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table password_resets
# ------------------------------------------------------------

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table permissions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `permissions`;

CREATE TABLE `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`)
VALUES
	(6,'user-list','web','2022-02-11 08:07:32','2022-02-12 01:28:45'),
	(7,'user-add','web','2022-02-12 01:28:52','2022-02-12 01:28:52'),
	(8,'user-update','web','2022-02-12 01:28:57','2022-02-12 01:28:57'),
	(9,'user-delete','web','2022-02-12 01:29:02','2022-02-12 01:29:02');

/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table personal_access_tokens
# ------------------------------------------------------------

DROP TABLE IF EXISTS `personal_access_tokens`;

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table projeks
# ------------------------------------------------------------

DROP TABLE IF EXISTS `projeks`;

CREATE TABLE `projeks` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama_projek` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kode_projek` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `area_projek` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nomor_kontrak` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_kontrak` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `judul_kontrak` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nilai_kontrak` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `durasi_kontrak` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `durasi_projek` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lokasi` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pemberi_kerja` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pm` bigint(20) unsigned DEFAULT NULL,
  `marketing` bigint(20) unsigned DEFAULT NULL,
  `supervisor` bigint(20) unsigned DEFAULT NULL,
  `rencana_kerja` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `owner` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_mulai` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_selesai` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_volume_kontrak` int(20) DEFAULT NULL,
  `total_harga_satuan` int(11) DEFAULT NULL,
  `total_volume_pekerjaan_sebelumnya` int(11) DEFAULT NULL,
  `total_volume_pekerjaan_hari_ini` int(20) DEFAULT NULL,
  `total_prestasi_keuangan` int(11) DEFAULT NULL,
  `total_prestasi_fisik` int(11) DEFAULT NULL,
  `status` enum('closing','process') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `edit_by` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table role_has_permissions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `role_has_permissions`;

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table roles
# ------------------------------------------------------------

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`)
VALUES
	(1,'Superadmin','web','2022-02-11 08:09:35','2022-02-11 08:09:35');

/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table shifts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `shifts`;

CREATE TABLE `shifts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama_shift` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jam_masuk` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jam_pulang` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `edit_by` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table tukangs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tukangs`;

CREATE TABLE `tukangs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `biaya_harian` int(11) DEFAULT NULL,
  `projek_id` int(11) DEFAULT NULL,
  `biaya_lembur` int(11) DEFAULT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `edit_by` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_telp_hp` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ttd` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `foto`, `no_telp_hp`, `ttd`, `remember_token`, `created_at`, `updated_at`)
VALUES
	(1,'Kevin','admin@mail.com',NULL,'$2y$10$S5WiDcE/zz6MbY0co/dS0.iyajRsWRrTLm9Vfv1347Wz3/Gb1Q0I6',NULL,NULL,NULL,'081338639778',NULL,NULL,'2022-02-10 07:50:49','2022-02-12 02:40:50'),
	(3,'Bareel','superadmin@mail.com',NULL,'$2y$10$US.2COHH1Gvb/9JnjU8VzeJV1Rjpd9V1IGCNvXa/rV2qU1B9yRKKm',NULL,NULL,NULL,'087730786790',NULL,NULL,'2022-02-12 04:04:26','2022-02-12 04:04:26');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
