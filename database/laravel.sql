/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE TABLE `bank_sampah_pusat_accounts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `bank_sampah_pusat_accounts_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `bank_sampah_unit_accounts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `bank_sampah_unit_accounts_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `data_sampahs` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `poin` int DEFAULT NULL,
  `info` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `daur_ulangs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tanggal_daur_ulang` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `detail_daur_ulangs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `daur_ulang_id` bigint unsigned NOT NULL,
  `waste_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `berat` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `detail_daur_ulangs_daur_ulang_id_foreign` (`daur_ulang_id`),
  KEY `detail_daur_ulangs_waste_id_foreign` (`waste_id`),
  CONSTRAINT `detail_daur_ulangs_daur_ulang_id_foreign` FOREIGN KEY (`daur_ulang_id`) REFERENCES `daur_ulangs` (`id`) ON DELETE CASCADE,
  CONSTRAINT `detail_daur_ulangs_waste_id_foreign` FOREIGN KEY (`waste_id`) REFERENCES `data_sampahs` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `detail_penjualans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `penjualan_id` bigint unsigned NOT NULL,
  `waste_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `berat` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `detail_penjualans_penjualan_id_foreign` (`penjualan_id`),
  KEY `detail_penjualans_waste_id_foreign` (`waste_id`),
  CONSTRAINT `detail_penjualans_penjualan_id_foreign` FOREIGN KEY (`penjualan_id`) REFERENCES `penjualans` (`id`) ON DELETE CASCADE,
  CONSTRAINT `detail_penjualans_waste_id_foreign` FOREIGN KEY (`waste_id`) REFERENCES `data_sampahs` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `detail_setorans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `setoran_id` bigint unsigned NOT NULL,
  `waste_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `berat` decimal(8,2) NOT NULL,
  `poin` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `detail_setorans_setoran_id_foreign` (`setoran_id`),
  KEY `detail_setorans_waste_id_foreign` (`waste_id`),
  CONSTRAINT `detail_setorans_setoran_id_foreign` FOREIGN KEY (`setoran_id`) REFERENCES `setorans` (`id`) ON DELETE CASCADE,
  CONSTRAINT `detail_setorans_waste_id_foreign` FOREIGN KEY (`waste_id`) REFERENCES `data_sampahs` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `harga_sampah_units` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `waste_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `harga_sampah_units_waste_id_foreign` (`waste_id`),
  CONSTRAINT `harga_sampah_units_waste_id_foreign` FOREIGN KEY (`waste_id`) REFERENCES `data_sampahs` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `nasabahs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor_induk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nasabahs_nomor_induk_unique` (`nomor_induk`),
  UNIQUE KEY `nasabahs_username_unique` (`username`),
  UNIQUE KEY `nasabahs_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `penarikan_poins` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nasabah_id` bigint unsigned NOT NULL,
  `reward_item_id` bigint unsigned NOT NULL,
  `tanggal` date NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `penarikan_poins_nasabah_id_foreign` (`nasabah_id`),
  KEY `penarikan_poins_reward_item_id_foreign` (`reward_item_id`),
  CONSTRAINT `penarikan_poins_nasabah_id_foreign` FOREIGN KEY (`nasabah_id`) REFERENCES `nasabahs` (`id`) ON DELETE CASCADE,
  CONSTRAINT `penarikan_poins_reward_item_id_foreign` FOREIGN KEY (`reward_item_id`) REFERENCES `reward_items` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `penarikan_saldos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nasabah_id` bigint unsigned NOT NULL,
  `tanggal` date NOT NULL,
  `jumlah` int NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `penarikan_saldos_nasabah_id_foreign` (`nasabah_id`),
  CONSTRAINT `penarikan_saldos_nasabah_id_foreign` FOREIGN KEY (`nasabah_id`) REFERENCES `nasabahs` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `pengelolahs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `penjualans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tanggal_jual` date NOT NULL,
  `pembeli` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_harga` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `permintaan_pengangkutan` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `account_id` bigint unsigned NOT NULL,
  `account_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sampah` json NOT NULL,
  `total_berat` decimal(8,2) NOT NULL,
  `total_harga` decimal(10,2) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Menunggu Konfirmasi',
  `tanggal_pengambilan` date DEFAULT NULL,
  `waktu_pengambilan` time DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `permintaan_pengangkutan_account_id_foreign` (`account_id`),
  CONSTRAINT `permintaan_pengangkutan_account_id_foreign` FOREIGN KEY (`account_id`) REFERENCES `bank_sampah_unit_accounts` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `reward_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `poin` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `riwayat_setoran_sampah` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `setoran_id` bigint unsigned NOT NULL,
  `nasabah_id` bigint unsigned NOT NULL,
  `jumlah_setoran` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `riwayat_setoran_sampah_nasabah_id_foreign` (`nasabah_id`),
  KEY `riwayat_setoran_sampah_setoran_id_foreign` (`setoran_id`),
  CONSTRAINT `riwayat_setoran_sampah_nasabah_id_foreign` FOREIGN KEY (`nasabah_id`) REFERENCES `nasabahs` (`id`) ON DELETE CASCADE,
  CONSTRAINT `riwayat_setoran_sampah_setoran_id_foreign` FOREIGN KEY (`setoran_id`) REFERENCES `setorans` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `sampah_unit` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `account_id` bigint unsigned NOT NULL,
  `sampah` json NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sampah_unit_account_id_foreign` (`account_id`),
  CONSTRAINT `sampah_unit_account_id_foreign` FOREIGN KEY (`account_id`) REFERENCES `bank_sampah_unit_accounts` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `setorans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nasabah_id` bigint unsigned NOT NULL,
  `tanggal_setor` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `setorans_nasabah_id_foreign` (`nasabah_id`),
  CONSTRAINT `setorans_nasabah_id_foreign` FOREIGN KEY (`nasabah_id`) REFERENCES `nasabahs` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `waste_prices` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `waste_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `waste_prices_waste_id_foreign` (`waste_id`),
  CONSTRAINT `waste_prices_waste_id_foreign` FOREIGN KEY (`waste_id`) REFERENCES `data_sampahs` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;









INSERT INTO `data_sampahs` (`id`, `kategori`, `jenis`, `foto`, `poin`, `info`, `created_at`, `updated_at`) VALUES
('B01M', 'Botol Kaca', 'Botol Markisa Bensin', NULL, 5, NULL, '2024-08-23 23:58:06', '2024-08-23 23:58:06');
INSERT INTO `data_sampahs` (`id`, `kategori`, `jenis`, `foto`, `poin`, `info`, `created_at`, `updated_at`) VALUES
('B02K', 'Botol Kaca', 'Botol Kecap/Bir', NULL, 4, NULL, '2024-08-23 23:58:06', '2024-08-23 23:58:06');
INSERT INTO `data_sampahs` (`id`, `kategori`, `jenis`, `foto`, `poin`, `info`, `created_at`, `updated_at`) VALUES
('B03M', 'Botol Kaca', 'Botol Marjan', NULL, 4, NULL, '2024-08-23 23:58:06', '2024-08-23 23:58:06');
INSERT INTO `data_sampahs` (`id`, `kategori`, `jenis`, `foto`, `poin`, `info`, `created_at`, `updated_at`) VALUES
('B04S', 'Botol Kaca', 'Botol Soda', NULL, 5, NULL, '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
('B05B', 'Botol Kaca', 'Botol Bir Guinness', NULL, 6, NULL, '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
('K01P', 'Kertas', 'Kertas Putih', NULL, 3, NULL, '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
('K02C', 'Kertas', 'Kertas Campur/warna', NULL, 2, NULL, '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
('K03B', 'Kertas', 'Kertas Buram', NULL, 3, NULL, '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
('K04K', 'Kertas', 'Kardus', NULL, 4, NULL, '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
('K05S', 'Kertas', 'Kertas Semen', NULL, 3, NULL, '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
('K06M', 'Kertas', 'Kertas Mikel', NULL, 2, NULL, '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
('K07C', 'Kertas', 'Cones', NULL, 2, NULL, '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
('L01T', 'Logam', 'Besi Tebal', NULL, 6, NULL, '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
('L02T', 'Logam', 'Besi Tipis', NULL, 5, NULL, '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
('L03K', 'Logam', 'Kaleng', NULL, 4, NULL, '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
('L04K', 'Logam', 'Kuningan', NULL, 7, NULL, '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
('L05T', 'Logam', 'Tembaga', NULL, 8, NULL, '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
('L06A', 'Logam', 'Aluminium Tebal', NULL, 5, NULL, '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
('L07A', 'Logam', 'Aluminium Tipis', NULL, 4, NULL, '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
('L08A', 'Logam', 'Aluminium Siku', NULL, 5, NULL, '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
('L09A', 'Logam', 'Aluminium Campur', NULL, 4, NULL, '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
('L10S', 'Logam', 'Besi Seng', NULL, 3, NULL, '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
('L11P', 'Logam', 'Perunggu', NULL, 7, NULL, '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
('M01J', 'Minyak', 'Minyak Jelantah', NULL, 4, NULL, '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
('P01B', 'Plastik', 'PP Gelas Bening Bersih', NULL, 5, NULL, '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
('P02B', 'Plastik', 'PP Gelas Bening Kotor', NULL, 4, NULL, '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
('P03W', 'Plastik', 'PP Gelas Warna', NULL, 3, NULL, '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
('P04C', 'Plastik', 'PP Cincin Gelas', NULL, 2, NULL, '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
('P05B', 'Plastik', 'PET Bening Bersih', NULL, 6, NULL, '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
('P06B', 'Plastik', 'PET Biru Muda Bersih', NULL, 5, NULL, '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
('P07K', 'Plastik', 'PET Kotor', NULL, 4, NULL, '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
('P08W', 'Plastik', 'PET Warna Bersih/Pisah', NULL, 4, NULL, '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
('P09C', 'Plastik', 'PET Warna Campur', NULL, 3, NULL, '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
('P10C', 'Plastik', 'PET Campur', NULL, 3, NULL, '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
('P11C', 'Plastik', 'Plastik HD Campur', NULL, 2, NULL, '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
('P12T', 'Plastik', 'HD Tutup Botol', NULL, 3, NULL, '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
('P13T', 'Plastik', 'HD Tutup Galon', NULL, 3, NULL, '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
('P14D', 'Plastik', 'Plastik Daun', NULL, 1, NULL, '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
('P15C', 'Plastik', 'Plastik PP Cetak', NULL, 4, NULL, '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
('P16C', 'Plastik', 'Plastik HD (Blow) Campur', NULL, 2, NULL, '2024-08-23 23:58:06', '2024-08-23 23:58:06');











INSERT INTO `harga_sampah_units` (`id`, `waste_id`, `price`, `created_at`, `updated_at`) VALUES
(1, 'P01B', '5000', '2024-08-23 23:58:06', '2024-08-23 23:58:06');
INSERT INTO `harga_sampah_units` (`id`, `waste_id`, `price`, `created_at`, `updated_at`) VALUES
(2, 'P02B', '4000', '2024-08-23 23:58:06', '2024-08-23 23:58:06');
INSERT INTO `harga_sampah_units` (`id`, `waste_id`, `price`, `created_at`, `updated_at`) VALUES
(3, 'P03W', '3500', '2024-08-23 23:58:06', '2024-08-23 23:58:06');
INSERT INTO `harga_sampah_units` (`id`, `waste_id`, `price`, `created_at`, `updated_at`) VALUES
(4, 'P04C', '2500', '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
(5, 'P05B', '6000', '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
(6, 'P06B', '5500', '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
(7, 'P07K', '5000', '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
(8, 'P08W', '4500', '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
(9, 'P09C', '4000', '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
(10, 'P10C', '3500', '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
(11, 'P11C', '3000', '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
(12, 'P12T', '2500', '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
(13, 'P13T', '2500', '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
(14, 'P14D', '1000', '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
(15, 'P15C', '4500', '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
(16, 'P16C', '3000', '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
(17, 'L01T', '7000', '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
(18, 'L02T', '6000', '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
(19, 'L03K', '5000', '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
(20, 'L04K', '8000', '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
(21, 'L05T', '9000', '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
(22, 'L06A', '6000', '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
(23, 'L07A', '5000', '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
(24, 'L08A', '6000', '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
(25, 'L09A', '5000', '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
(26, 'L10S', '4000', '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
(27, 'L11P', '8000', '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
(28, 'K01P', '3500', '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
(29, 'K02C', '3000', '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
(30, 'K03B', '3500', '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
(31, 'K04K', '4500', '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
(32, 'K05S', '3500', '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
(33, 'K06M', '2500', '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
(34, 'K07C', '2500', '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
(35, 'B01M', '6000', '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
(36, 'B02K', '5000', '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
(37, 'B03M', '5000', '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
(38, 'B04S', '6000', '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
(39, 'B05B', '7000', '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
(40, 'M01J', '3000', '2024-08-23 23:58:06', '2024-08-23 23:58:06');





INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(2, '0001_01_01_000001_create_cache_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(3, '0001_01_01_000002_create_jobs_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(4, '2024_07_04_135700_create_pengelolahs_table', 1),
(5, '2024_07_08_095203_create_bank_sampah_unit_accounts_table', 1),
(6, '2024_07_09_044437_create_sampah_unit_table', 1),
(7, '2024_07_09_134205_create_nasabahs_table', 1),
(8, '2024_07_09_134215_create_setorans_table', 1),
(9, '2024_07_10_165403_create_data_sampahs_table', 1),
(10, '2024_07_10_165437_create_detail_setorans_table', 1),
(11, '2024_07_17_051003_create_harga_sampah_units_table', 1),
(12, '2024_07_17_171751_create_permintaan_pengangkutan_table', 1),
(13, '2024_07_18_133132_create_bank_sampah_pusat_accounts_table', 1),
(14, '2024_07_19_051218_create_password_resets_table', 1),
(15, '2024_07_24_231222_create_penjualans_table', 1),
(16, '2024_07_27_154654_create_detail_penjualans_table', 1),
(17, '2024_07_28_062440_create_daur_ulangs_table', 1),
(18, '2024_07_28_062509_create_detail_daur_ulangs_table', 1),
(19, '2024_07_29_175603_create_waste_prices_table', 1),
(20, '2024_08_16_072958_create_reward_items_table', 1),
(21, '2024_08_16_151018_create_riwayat_setoran_sampahs_table', 1),
(22, '2024_08_20_072637_create_penarikan_poins_table', 1),
(23, '2024_08_20_072644_create_penarikan_saldos_table', 1);

INSERT INTO `nasabahs` (`id`, `nama`, `nomor_induk`, `username`, `email`, `password`, `alamat`, `foto`, `created_at`, `updated_at`) VALUES
(1, 'Hasta Wacana', '318996711900565159', 'namaga.zelda', 'kemal.ramadan@example.com', '$2y$12$MQN91c4S2gmh1oTjtKdz5.ajxBreXJKdzoEWQnTFYSH.zFt5nmZ6C', 'Ki. Moch. Toha No. 43, Metro 19466, Kaltim', 'https://via.placeholder.com/200x200.png/0022cc?text=people+Faker+suscipit', '2024-08-23 23:58:06', '2024-08-23 23:58:06');
INSERT INTO `nasabahs` (`id`, `nama`, `nomor_induk`, `username`, `email`, `password`, `alamat`, `foto`, `created_at`, `updated_at`) VALUES
(2, 'Tiara Mandasari', '206066274631981366', 'kadir66', 'gada.adriansyah@example.com', '$2y$12$BrpFli6UiEMfsBY1enPFnuDWcKSaxwJbMUXYS8xiF6V0snK4cDK3q', 'Jln. Hasanuddin No. 23, Jambi 26820, Sulteng', 'https://via.placeholder.com/200x200.png/00ee66?text=people+Faker+veniam', '2024-08-23 23:58:06', '2024-08-23 23:58:06');
INSERT INTO `nasabahs` (`id`, `nama`, `nomor_induk`, `username`, `email`, `password`, `alamat`, `foto`, `created_at`, `updated_at`) VALUES
(3, 'Ratih Hassanah S.Sos', '703489035295852232', 'devi.prakasa', 'jwidodo@example.org', '$2y$12$d8r0DxJ8Hhao.KcOpfB.H.n30SNH8szVwQ8HbYQ8KVppCliOUdJ1e', 'Gg. Radio No. 889, Sawahlunto 10951, NTB', 'https://via.placeholder.com/200x200.png/0044cc?text=people+Faker+itaque', '2024-08-23 23:58:06', '2024-08-23 23:58:06');
INSERT INTO `nasabahs` (`id`, `nama`, `nomor_induk`, `username`, `email`, `password`, `alamat`, `foto`, `created_at`, `updated_at`) VALUES
(4, 'Rahman Salahudin S.E.I', '131837739548825193', 'tpradipta', 'amalia53@example.org', '$2y$12$Teo/ImGZfI.QzbDfGNbG4.fDlDJg8iceRHqB3mz2Vun/iPhtZ3mgG', 'Gg. Peta No. 834, Parepare 37859, Aceh', 'https://via.placeholder.com/200x200.png/002222?text=people+Faker+quod', '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
(5, 'Ajeng Mulyani', '037306108581108714', 'mardhiyah.indra', 'laksita.victoria@example.org', '$2y$12$ufmg5JvgTU7lsi.LH0LaueMEJxV4PTe/yN8JMivJIM3VXEAXxWFVa', 'Psr. Bagas Pati No. 607, Palopo 69157, Sumsel', 'https://via.placeholder.com/200x200.png/009988?text=people+Faker+quo', '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
(6, 'Lukita Yoga Wibowo S.H.', '324249624289092399', 'ciaobella85', 'yjailani@example.net', '$2y$12$A/MxW0GQKerTmgfHEYvyNujy/pA5AUJUbfeCFsw2T4f4OxybyP/De', 'Psr. Batako No. 445, Palangka Raya 21022, Jabar', 'https://via.placeholder.com/200x200.png/003322?text=people+Faker+non', '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
(7, 'Hesti Ratna Winarsih', '105613349756822540', 'ega69', 'prasasta.kamila@example.org', '$2y$12$S5HJlgFXHsKRGo9cwofujuQo9dks1v0Yik0/FWD4CmjtDvnMAc2se', 'Gg. Rajawali Barat No. 138, Bekasi 56355, Sumut', 'https://via.placeholder.com/200x200.png/00eeee?text=people+Faker+repellendus', '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
(8, 'Qori Pratiwi M.Farm', '499430827526281876', 'wahyuni.maimunah', 'hakim.mulyanto@example.net', '$2y$12$/lMfsWiG0s6SEZFzhf0DhOgfqnlg458g.ZWSWf0xEvlHBwkc5dCvy', 'Ds. Kebonjati No. 824, Pontianak 75316, Kaltara', 'https://via.placeholder.com/200x200.png/000033?text=people+Faker+illo', '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
(9, 'Eko Gunarto', '809417142612681580', 'vnapitupulu', 'zamira79@example.com', '$2y$12$Pa8BvtCePYXHBh7PBfQMoOeG/fgQG89CyW6AGVg9VpbGK3HTfgtJm', 'Kpg. Jakarta No. 872, Madiun 39555, Jabar', 'https://via.placeholder.com/200x200.png/001166?text=people+Faker+ab', '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
(10, 'Wasis Warji Dongoran M.M.', '975991078349947816', 'paulin.widodo', 'ewastuti@example.net', '$2y$12$wopXNTyyMjxEAG58gCj7seh51cK55aSrKxbPtceMxcIRkiJ53nMAa', 'Dk. Antapani Lama No. 606, Pekalongan 41512, Jateng', 'https://via.placeholder.com/200x200.png/008833?text=people+Faker+totam', '2024-08-23 23:58:06', '2024-08-23 23:58:06');















INSERT INTO `reward_items` (`id`, `name`, `poin`, `created_at`, `updated_at`) VALUES
(1, 'Sabun Mandi', 20, '2024-08-23 23:58:06', '2024-08-23 23:58:06');
INSERT INTO `reward_items` (`id`, `name`, `poin`, `created_at`, `updated_at`) VALUES
(2, 'Sabun Cuci Piring', 15, '2024-08-23 23:58:06', '2024-08-23 23:58:06');
INSERT INTO `reward_items` (`id`, `name`, `poin`, `created_at`, `updated_at`) VALUES
(3, 'Detergen', 25, '2024-08-23 23:58:06', '2024-08-23 23:58:06');
INSERT INTO `reward_items` (`id`, `name`, `poin`, `created_at`, `updated_at`) VALUES
(4, 'Pasta Gigi', 10, '2024-08-23 23:58:06', '2024-08-23 23:58:06');











INSERT INTO `waste_prices` (`id`, `waste_id`, `price`, `created_at`, `updated_at`) VALUES
(1, 'P01B', '6000', '2024-08-23 23:58:06', '2024-08-23 23:58:06');
INSERT INTO `waste_prices` (`id`, `waste_id`, `price`, `created_at`, `updated_at`) VALUES
(2, 'P02B', '5000', '2024-08-23 23:58:06', '2024-08-23 23:58:06');
INSERT INTO `waste_prices` (`id`, `waste_id`, `price`, `created_at`, `updated_at`) VALUES
(3, 'P03W', '4000', '2024-08-23 23:58:06', '2024-08-23 23:58:06');
INSERT INTO `waste_prices` (`id`, `waste_id`, `price`, `created_at`, `updated_at`) VALUES
(4, 'P04C', '3000', '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
(5, 'P05B', '7000', '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
(6, 'P06B', '6500', '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
(7, 'P07K', '5500', '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
(8, 'P08W', '5000', '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
(9, 'P09C', '4500', '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
(10, 'P10C', '4000', '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
(11, 'P11C', '3500', '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
(12, 'P12T', '3000', '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
(13, 'P13T', '3000', '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
(14, 'P14D', '2000', '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
(15, 'P15C', '5000', '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
(16, 'P16C', '3500', '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
(17, 'L01T', '8000', '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
(18, 'L02T', '7000', '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
(19, 'L03K', '6000', '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
(20, 'L04K', '9000', '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
(21, 'L05T', '10000', '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
(22, 'L06A', '7000', '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
(23, 'L07A', '6000', '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
(24, 'L08A', '7000', '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
(25, 'L09A', '6000', '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
(26, 'L10S', '5000', '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
(27, 'L11P', '9000', '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
(28, 'K01P', '4000', '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
(29, 'K02C', '3500', '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
(30, 'K03B', '4000', '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
(31, 'K04K', '5000', '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
(32, 'K05S', '4000', '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
(33, 'K06M', '3000', '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
(34, 'K07C', '3000', '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
(35, 'B01M', '7000', '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
(36, 'B02K', '6000', '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
(37, 'B03M', '6000', '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
(38, 'B04S', '7000', '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
(39, 'B05B', '8000', '2024-08-23 23:58:06', '2024-08-23 23:58:06'),
(40, 'M01J', '4000', '2024-08-23 23:58:06', '2024-08-23 23:58:06');


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;