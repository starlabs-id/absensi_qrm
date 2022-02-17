-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 17 Feb 2022 pada 09.54
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `absensi_qrm`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `absens`
--

CREATE TABLE `absens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lokasi_datang` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude_datang` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude_datang` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ttd` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jam_datang` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_datang` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hari_datang` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bulan_datang` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tahun_datang` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lokasi_pulang` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude_pulang` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude_pulang` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `projek_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `tukang_id` bigint(20) UNSIGNED NOT NULL,
  `edit_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `absen_lemburs`
--

CREATE TABLE `absen_lemburs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lokasi_datang` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude_datang` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude_datang` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ttd` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jam_datang` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_datang` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hari_datang` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bulan_datang` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tahun_datang` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lokasi_pulang` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude_pulang` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude_pulang` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `projek_id` bigint(20) UNSIGNED NOT NULL,
  `absen_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `tukang_id` bigint(20) UNSIGNED NOT NULL,
  `edit_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `chats`
--

CREATE TABLE `chats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `projek_id` bigint(20) UNSIGNED DEFAULT NULL,
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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `chats`
--

INSERT INTO `chats` (`id`, `projek_id`, `direktur_utama`, `superadmin`, `owner`, `direktur_teknik`, `admin_teknik`, `pm`, `marketing`, `gm`, `co_gm`, `supervisor`, `created_at`, `updated_at`) VALUES
(1, 4, 4, 1, 13, NULL, 9, 11, 6, 10, NULL, 8, '2022-02-17 07:36:30', '2022-02-17 07:36:30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `chat_details`
--

CREATE TABLE `chat_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `chat_id` bigint(20) UNSIGNED DEFAULT NULL,
  `komentar` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pengirim` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_projeks`
--

CREATE TABLE `detail_projeks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `projek_id` bigint(20) UNSIGNED DEFAULT NULL,
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
  `edit_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_02_10_030323_create_projeks_table', 1),
(6, '2022_02_10_032137_create_detail_projeks_table', 1),
(7, '2022_02_10_033438_create_tukangs_table', 1),
(8, '2022_02_10_034600_create_absens_table', 1),
(9, '2022_02_10_052414_create_absen_lemburs_table', 1),
(10, '2022_02_10_052932_create_shifts_table', 1),
(11, '2022_02_10_053856_create_chats_table', 1),
(12, '2022_02_10_054100_create_chat_details_table', 1),
(13, '2014_10_12_200000_add_two_factor_columns_to_users_table', 2),
(14, '2022_02_11_064443_create_permission_tables', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(1, 'App\\Models\\User', 3),
(2, 'App\\Models\\User', 4),
(4, 'App\\Models\\User', 13),
(5, 'App\\Models\\User', 5),
(5, 'App\\Models\\User', 6),
(6, 'App\\Models\\User', 9),
(7, 'App\\Models\\User', 10),
(9, 'App\\Models\\User', 11),
(10, 'App\\Models\\User', 8);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(6, 'user-list', 'web', '2022-02-11 00:07:32', '2022-02-11 17:28:45'),
(7, 'user-add', 'web', '2022-02-11 17:28:52', '2022-02-11 17:28:52'),
(8, 'user-update', 'web', '2022-02-11 17:28:57', '2022-02-11 17:28:57'),
(9, 'user-delete', 'web', '2022-02-11 17:29:02', '2022-02-11 17:29:02'),
(10, 'projek-list', 'web', '2022-02-16 05:23:38', '2022-02-16 05:23:38'),
(11, 'projek-add', 'web', '2022-02-16 05:23:44', '2022-02-16 05:23:44'),
(12, 'projek-update', 'web', '2022-02-16 05:23:51', '2022-02-16 05:23:51'),
(13, 'projek-delete', 'web', '2022-02-16 05:23:58', '2022-02-16 05:23:58'),
(14, 'projekdetail-list', 'web', '2022-02-16 05:24:18', '2022-02-16 05:24:18'),
(15, 'projekdetail-add', 'web', '2022-02-16 05:24:23', '2022-02-16 05:24:23'),
(16, 'projekdetail-update', 'web', '2022-02-16 05:24:30', '2022-02-16 05:24:30'),
(17, 'projekdetail-delete', 'web', '2022-02-16 05:24:35', '2022-02-16 05:24:35'),
(18, 'tukang-list', 'web', '2022-02-16 05:24:49', '2022-02-16 05:24:49'),
(19, 'tukang-add', 'web', '2022-02-16 05:24:55', '2022-02-16 05:24:55'),
(20, 'tukang-update', 'web', '2022-02-16 05:25:07', '2022-02-16 05:25:07'),
(21, 'tukang-delete', 'web', '2022-02-16 05:25:15', '2022-02-16 05:25:15'),
(22, 'absen-list', 'web', '2022-02-16 05:25:29', '2022-02-16 05:25:29'),
(23, 'absen-add', 'web', '2022-02-16 05:25:32', '2022-02-16 05:25:32'),
(24, 'absen-update', 'web', '2022-02-16 05:25:36', '2022-02-16 05:25:36'),
(25, 'absen-delete', 'web', '2022-02-16 05:25:40', '2022-02-16 05:25:40'),
(26, 'absenlembur-list', 'web', '2022-02-16 05:25:54', '2022-02-16 05:25:54'),
(27, 'absenlembur-add', 'web', '2022-02-16 05:26:06', '2022-02-16 05:26:06'),
(28, 'absenlembur-update', 'web', '2022-02-16 05:26:10', '2022-02-16 05:26:10'),
(29, 'absenlembur-delete', 'web', '2022-02-16 05:26:15', '2022-02-16 05:26:15'),
(30, 'chat-list', 'web', '2022-02-16 05:26:40', '2022-02-16 05:26:40'),
(31, 'chat-add', 'web', '2022-02-16 05:26:46', '2022-02-16 05:26:46'),
(32, 'chat-update', 'web', '2022-02-16 05:26:55', '2022-02-16 05:26:55'),
(33, 'chat-delete', 'web', '2022-02-16 05:27:02', '2022-02-16 05:27:02'),
(34, 'chatdetail-list', 'web', '2022-02-16 05:27:23', '2022-02-16 05:27:23'),
(35, 'chatdetail-add', 'web', '2022-02-16 05:27:28', '2022-02-16 05:27:28'),
(36, 'shift-list', 'web', '2022-02-16 05:27:43', '2022-02-16 05:27:43'),
(37, 'shift-add', 'web', '2022-02-16 05:27:47', '2022-02-16 05:27:47'),
(38, 'shift-update', 'web', '2022-02-16 05:27:51', '2022-02-16 05:27:51'),
(39, 'shift-delete', 'web', '2022-02-16 05:27:56', '2022-02-16 05:27:56'),
(41, 'role-list', 'web', '2022-02-16 05:32:52', '2022-02-16 05:33:01'),
(42, 'role-add', 'web', '2022-02-16 05:33:05', '2022-02-16 05:33:05'),
(43, 'role-update', 'web', '2022-02-16 05:33:19', '2022-02-16 05:33:19'),
(44, 'role-delete', 'web', '2022-02-16 05:33:24', '2022-02-16 05:33:24'),
(45, 'permission-list', 'web', '2022-02-16 05:33:36', '2022-02-16 05:33:36'),
(46, 'permission-add', 'web', '2022-02-16 05:33:39', '2022-02-16 05:33:39'),
(47, 'permission-update', 'web', '2022-02-16 05:33:49', '2022-02-16 05:33:49'),
(48, 'permission-delete', 'web', '2022-02-16 05:33:56', '2022-02-16 05:33:56'),
(49, 'validasi-update', 'web', '2022-02-16 05:46:23', '2022-02-16 05:46:23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `projeks`
--

CREATE TABLE `projeks` (
  `id` bigint(20) UNSIGNED NOT NULL,
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
  `pm` bigint(20) UNSIGNED DEFAULT NULL,
  `marketing` bigint(20) UNSIGNED DEFAULT NULL,
  `supervisor` bigint(20) UNSIGNED DEFAULT NULL,
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
  `total_pekerja` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `edit_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `projeks`
--

INSERT INTO `projeks` (`id`, `nama_projek`, `kode_projek`, `area_projek`, `nomor_kontrak`, `tanggal_kontrak`, `judul_kontrak`, `nilai_kontrak`, `durasi_kontrak`, `durasi_projek`, `lokasi`, `pemberi_kerja`, `pm`, `marketing`, `supervisor`, `rencana_kerja`, `owner`, `tanggal_mulai`, `tanggal_selesai`, `total_volume_kontrak`, `total_harga_satuan`, `total_volume_pekerjaan_sebelumnya`, `total_volume_pekerjaan_hari_ini`, `total_prestasi_keuangan`, `total_prestasi_fisik`, `status`, `total_pekerja`, `edit_by`, `created_at`, `updated_at`) VALUES
(3, 'Tol Bali Mandara', 'A', 'Bali', 'A', '2022-02-01', 'A', 'A', 'A', NULL, 'A', 'A', 11, 6, 8, 'A', '13', '2022-02-01', NULL, 10, 10, 10, 10, 10, 10, 'process', '15', 1, '2022-02-17 03:20:06', '2022-02-17 03:20:06'),
(4, 'Brantas', '002', 'Surabaya', 'B', '2022-02-17', 'B', 'B', 'B', NULL, 'B', 'B', 11, 5, 8, 'B', '13', '2022-02-17', NULL, 12, 12, 12, 12, 112, 12, 'process', '12', 1, '2022-02-17 05:45:50', '2022-02-17 05:45:50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Superadmin', 'web', '2022-02-11 00:09:35', '2022-02-11 00:09:35'),
(2, 'Direktur Utama', 'web', '2022-02-16 05:40:08', '2022-02-16 05:40:08'),
(3, 'Direktur Teknik', 'web', '2022-02-16 05:40:49', '2022-02-16 05:40:49'),
(4, 'Owner', 'web', '2022-02-16 05:41:27', '2022-02-16 05:41:27'),
(5, 'Marketing', 'web', '2022-02-16 05:42:08', '2022-02-16 05:42:08'),
(6, 'Admin Teknik', 'web', '2022-02-16 05:44:17', '2022-02-16 05:44:17'),
(7, 'GM', 'web', '2022-02-16 05:44:57', '2022-02-16 05:44:57'),
(8, 'Co GM', 'web', '2022-02-16 05:46:08', '2022-02-16 05:46:08'),
(9, 'PM', 'web', '2022-02-16 05:48:09', '2022-02-16 05:48:09'),
(10, 'Supervisor', 'web', '2022-02-16 05:52:48', '2022-02-16 05:52:48'),
(11, 'Karyawan', 'web', '2022-02-16 05:53:45', '2022-02-16 05:53:45');

-- --------------------------------------------------------

--
-- Struktur dari tabel `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(10, 2),
(10, 3),
(10, 4),
(10, 5),
(10, 6),
(10, 7),
(10, 8),
(10, 9),
(10, 10),
(10, 11),
(11, 1),
(11, 2),
(11, 3),
(11, 6),
(11, 7),
(11, 9),
(11, 10),
(12, 1),
(12, 2),
(12, 3),
(12, 6),
(12, 7),
(12, 9),
(12, 10),
(13, 1),
(13, 2),
(13, 3),
(13, 6),
(13, 7),
(13, 9),
(14, 1),
(14, 2),
(14, 3),
(14, 4),
(14, 5),
(14, 6),
(14, 7),
(14, 8),
(14, 9),
(14, 10),
(14, 11),
(15, 1),
(15, 2),
(15, 3),
(15, 6),
(15, 7),
(15, 9),
(15, 10),
(16, 1),
(16, 2),
(16, 3),
(16, 6),
(16, 7),
(16, 9),
(17, 1),
(17, 2),
(17, 3),
(17, 6),
(17, 7),
(17, 9),
(18, 1),
(18, 2),
(18, 3),
(18, 6),
(18, 7),
(18, 8),
(18, 9),
(18, 10),
(19, 1),
(19, 2),
(19, 3),
(19, 6),
(19, 7),
(19, 9),
(20, 1),
(20, 2),
(20, 3),
(20, 6),
(20, 7),
(20, 9),
(21, 1),
(21, 2),
(21, 3),
(21, 6),
(21, 7),
(21, 9),
(22, 1),
(22, 2),
(22, 3),
(22, 6),
(22, 7),
(22, 8),
(22, 9),
(22, 10),
(22, 11),
(23, 1),
(23, 2),
(23, 3),
(23, 11),
(24, 1),
(24, 2),
(24, 3),
(24, 11),
(25, 1),
(25, 2),
(25, 3),
(26, 1),
(26, 2),
(26, 3),
(26, 6),
(26, 7),
(26, 8),
(26, 9),
(26, 10),
(26, 11),
(27, 1),
(27, 2),
(27, 3),
(27, 11),
(28, 1),
(28, 2),
(28, 3),
(28, 11),
(29, 1),
(29, 2),
(29, 3),
(30, 1),
(30, 2),
(30, 3),
(30, 5),
(30, 6),
(30, 7),
(30, 8),
(30, 9),
(30, 10),
(31, 1),
(31, 2),
(31, 3),
(31, 6),
(31, 7),
(32, 1),
(32, 2),
(32, 3),
(32, 6),
(32, 7),
(33, 1),
(33, 2),
(33, 3),
(33, 7),
(34, 1),
(34, 2),
(34, 3),
(34, 5),
(34, 6),
(34, 7),
(34, 8),
(34, 9),
(34, 10),
(35, 1),
(35, 2),
(35, 3),
(35, 4),
(35, 5),
(35, 6),
(35, 7),
(35, 8),
(35, 9),
(35, 10),
(36, 1),
(36, 2),
(36, 3),
(36, 6),
(36, 9),
(37, 1),
(37, 2),
(37, 6),
(38, 1),
(38, 6),
(39, 1),
(39, 2),
(39, 6),
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(46, 1),
(47, 1),
(48, 1),
(49, 1),
(49, 2),
(49, 9);

-- --------------------------------------------------------

--
-- Struktur dari tabel `shifts`
--

CREATE TABLE `shifts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_shift` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jam_masuk` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jam_pulang` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `edit_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `shifts`
--

INSERT INTO `shifts` (`id`, `nama_shift`, `jam_masuk`, `jam_pulang`, `edit_by`, `created_at`, `updated_at`) VALUES
(2, 'Pagi', '08.00', '17.00', 1, '2022-02-17 06:55:23', '2022-02-17 06:55:23'),
(3, 'Siang', '13.00', '21.00', 1, '2022-02-17 06:55:46', '2022-02-17 06:55:46'),
(4, 'Malam', '00.00', '08.00', 1, '2022-02-17 06:56:33', '2022-02-17 06:56:33');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tukangs`
--

CREATE TABLE `tukangs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `biaya_harian` int(11) DEFAULT NULL,
  `projek_id` int(11) DEFAULT NULL,
  `biaya_lembur` int(11) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `edit_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `foto`, `no_telp_hp`, `ttd`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Kevin R', 'admin@mail.com', NULL, '$2y$10$KisUOW36KysS/0BKijXQde3MfACHo08vx39.5sUZeWCr/4W83gruW', NULL, NULL, 'sz0fnkw0xS9u1nOSGW0rM9fYKD9g7F2mwnrUfzGS.jpg', '081338639778', NULL, NULL, '2022-02-09 23:50:49', '2022-02-16 04:03:15'),
(3, 'Bareel', 'bareel@gmail.com', NULL, '$2y$10$US.2COHH1Gvb/9JnjU8VzeJV1Rjpd9V1IGCNvXa/rV2qU1B9yRKKm', NULL, NULL, NULL, '087730786790', NULL, NULL, '2022-02-11 20:04:26', '2022-02-14 02:12:22'),
(4, 'Yusuf Ali', 'yusufali@gmail.com', NULL, '$2y$10$dYsC1nS.Hcit06Re4T8z9OGfqfwbd1YIke4o0psWXKJ1uSfwMvvfO', NULL, NULL, NULL, '081237728888', NULL, NULL, '2022-02-16 05:54:43', '2022-02-16 05:54:43'),
(5, 'Ismed Andrian', 'ismedandrian@gmail.com', NULL, '$2y$10$emrs0inLJCMKRqf7cIkE1uLKKaKkEOIyThYDaqVEbOon0Fo97aKmq', NULL, NULL, NULL, '0811386959', NULL, NULL, '2022-02-16 06:03:31', '2022-02-16 06:03:31'),
(6, 'Andri', 'andri@gmail.com', NULL, '$2y$10$OrxrA8qRVUF3PHdCoL2g9Ow0ZbNwfGBer97RnSxwwVm4/GMsZvpKG', NULL, NULL, NULL, '081310106486', NULL, NULL, '2022-02-16 06:05:06', '2022-02-16 06:05:06'),
(8, 'Alit', 'alit.arc013@gmail.com', NULL, '$2y$10$IO9qr.ax/NGHzaSNTa55uumr6460K0sLCwd83T.XzQyUAZTa9ftAu', NULL, NULL, NULL, '081237846440', NULL, NULL, '2022-02-16 06:06:38', '2022-02-16 06:06:38'),
(9, 'Lintang', 'garbhadana@gmail.com', NULL, '$2y$10$8t6Qyj8yW2u4xmlxvEA1x.e0AiUALoKj75l0k2R9FGtNG1GYD4viy', NULL, NULL, NULL, '085847184272', NULL, NULL, '2022-02-16 06:08:17', '2022-02-16 06:08:17'),
(10, 'Rima', 'rimasilvia22@gmail.com', NULL, '$2y$10$isONkxEzVVfUAgbdHQAQVutrOIWaEyxhJGPVFuAud1YteNaR0/y5C', NULL, NULL, NULL, '08113934003', NULL, NULL, '2022-02-16 06:08:52', '2022-02-16 06:08:52'),
(11, 'Sukma', 'sukma.naindya0209@gmail.com', NULL, '$2y$10$FgJ5GRHfKZmsMkQG9HackOLDVCR7d64Q4gCj6s0cNIf2BX.GtdufW', NULL, NULL, NULL, '087863200314', NULL, NULL, '2022-02-16 06:14:41', '2022-02-16 06:14:41'),
(13, 'Luhut', 'opungluhut@gmail.com', NULL, '$2y$10$WfrWrXU..FVCviRY4/rqQ.PVDQYmgnM255liDt05/Jtdb9H6dqdeW', NULL, NULL, NULL, '081111111', NULL, NULL, '2022-02-16 06:32:16', '2022-02-16 06:32:16');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `absens`
--
ALTER TABLE `absens`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `absen_lemburs`
--
ALTER TABLE `absen_lemburs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `chat_details`
--
ALTER TABLE `chat_details`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `detail_projeks`
--
ALTER TABLE `detail_projeks`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indeks untuk tabel `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `projeks`
--
ALTER TABLE `projeks`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indeks untuk tabel `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indeks untuk tabel `shifts`
--
ALTER TABLE `shifts`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tukangs`
--
ALTER TABLE `tukangs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `absens`
--
ALTER TABLE `absens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `absen_lemburs`
--
ALTER TABLE `absen_lemburs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `chats`
--
ALTER TABLE `chats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `chat_details`
--
ALTER TABLE `chat_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `detail_projeks`
--
ALTER TABLE `detail_projeks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `projeks`
--
ALTER TABLE `projeks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `shifts`
--
ALTER TABLE `shifts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tukangs`
--
ALTER TABLE `tukangs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
