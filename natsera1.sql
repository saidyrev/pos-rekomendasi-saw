-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 06, 2023 at 10:57 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `natsera1`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int UNSIGNED NOT NULL,
  `nama_kategori` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `created_at`, `updated_at`) VALUES
(1, 'Espresso Based', '2023-05-21 06:57:31', '2023-05-21 06:57:31'),
(2, 'Manual Brew', '2023-05-21 06:57:37', '2023-05-21 06:57:37'),
(3, 'Fresh Signature', '2023-05-21 06:57:44', '2023-05-21 06:57:44'),
(4, 'Best Signature', '2023-05-21 06:58:04', '2023-05-21 06:58:04'),
(5, 'Makanan', '2023-05-21 06:58:10', '2023-05-21 06:58:10');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2023_02_03_105518_create_sessions_table', 1),
(7, '2023_02_03_114253_create_kategori_table', 1),
(8, '2023_02_03_130826_create_produk_table', 1),
(9, '2023_02_06_085109_tambah_foreign_key_to_produk_table', 1),
(10, '2023_02_08_120340_create_pengaturan_table', 1),
(11, '2023_02_13_141615_create_penjualan_table', 1),
(12, '2023_02_13_141744_create_penjualan_detail_table', 1),
(13, '2023_05_08_134334_create_promos_table', 1),
(14, '2023_05_17_151112_add_tipe_bayar_to_penjualan_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengaturan`
--

CREATE TABLE `pengaturan` (
  `id_pengaturan` int UNSIGNED NOT NULL,
  `nama_kafe` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `instagram` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipe_nota` tinyint NOT NULL,
  `path_logo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengaturan`
--

INSERT INTO `pengaturan` (`id_pengaturan`, `nama_kafe`, `alamat`, `instagram`, `tipe_nota`, `path_logo`, `created_at`, `updated_at`) VALUES
(1, 'Cerita Kopi', 'Jl. Banua Anyar', '@ceritakopi.bdj', 1, '/img/logo.png', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `id_penjualan` int UNSIGNED NOT NULL,
  `id_promo` int DEFAULT NULL,
  `total_item` int NOT NULL,
  `total_harga` int NOT NULL,
  `diskon` tinyint NOT NULL DEFAULT '0',
  `bayar` int NOT NULL DEFAULT '0',
  `diterima` int NOT NULL DEFAULT '0',
  `id_user` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tipe_bayar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `tipe_transaksi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`id_penjualan`, `id_promo`, `total_item`, `total_harga`, `diskon`, `bayar`, `diterima`, `id_user`, `created_at`, `updated_at`, `tipe_bayar`, `tipe_transaksi`) VALUES
(7, NULL, 2, 30000, 0, 30000, 100000, 1, '2023-05-30 22:49:54', '2023-05-30 22:50:16', 'Tunai', 'Non Promo'),
(8, 1, 2, 23000, 23, 23000, 23000, 1, '2023-05-30 22:50:53', '2023-05-30 22:51:11', 'Non Tunai', 'Promo'),
(10, 1, 2, 23000, 23, 23000, 100000, 1, '2023-05-31 00:14:21', '2023-05-31 00:15:20', 'Tunai', 'Promo'),
(13, 2, 2, 20000, 20, 20000, 20000, 1, '2023-05-31 00:19:52', '2023-05-31 00:21:07', 'Non Tunai', 'Promo'),
(16, NULL, 1, 15000, 0, 15000, 15000, 1, '2023-06-04 08:14:43', '2023-06-04 08:15:28', 'Non Tunai', 'Non Promo'),
(17, NULL, 45, 900000, 0, 900000, 0, 2, '2023-06-04 14:16:43', '2023-06-04 14:17:24', 'Tunai', 'Non Promo'),
(18, 1, 2, 23000, 23, 23000, 23000, 1, '2023-06-04 16:59:22', '2023-06-04 17:01:36', 'Non Tunai', 'Promo'),
(19, NULL, 0, 0, 0, 0, 0, 3, '2023-06-04 17:31:42', '2023-06-04 17:31:42', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan_detail`
--

CREATE TABLE `penjualan_detail` (
  `id_penjualan_detail` int UNSIGNED NOT NULL,
  `id_penjualan` int NOT NULL,
  `id_produk` int NOT NULL,
  `harga_jual` int NOT NULL,
  `jumlah` int NOT NULL,
  `diskon` tinyint NOT NULL DEFAULT '0',
  `subtotal` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penjualan_detail`
--

INSERT INTO `penjualan_detail` (`id_penjualan_detail`, `id_penjualan`, `id_produk`, `harga_jual`, `jumlah`, `diskon`, `subtotal`, `created_at`, `updated_at`) VALUES
(7, 7, 2, 15000, 1, 0, 15000, '2023-05-30 22:50:02', '2023-05-30 22:50:02'),
(8, 7, 3, 15000, 1, 0, 15000, '2023-05-30 22:50:06', '2023-05-30 22:50:06'),
(9, 8, 2, 15000, 1, 23, 11500, '2023-05-30 22:51:03', '2023-05-30 22:51:11'),
(10, 8, 4, 15000, 1, 23, 11500, '2023-05-30 22:51:03', '2023-05-30 22:51:11'),
(11, 10, 2, 15000, 1, 23, 11500, '2023-05-31 00:14:49', '2023-05-31 00:15:20'),
(12, 10, 4, 15000, 1, 23, 11500, '2023-05-31 00:14:49', '2023-05-31 00:15:20'),
(15, 13, 5, 15000, 1, 20, 12000, '2023-05-31 00:21:00', '2023-05-31 00:21:00'),
(16, 13, 1, 10000, 1, 20, 8000, '2023-05-31 00:21:00', '2023-05-31 00:21:00'),
(17, 16, 4, 15000, 1, 0, 15000, '2023-06-04 08:14:50', '2023-06-04 08:14:50'),
(18, 17, 19, 20000, 45, 0, 900000, '2023-06-04 14:17:11', '2023-06-04 14:17:16'),
(19, 18, 2, 15000, 1, 23, 11500, '2023-06-04 17:00:58', '2023-06-04 17:01:36'),
(20, 18, 4, 15000, 1, 23, 11500, '2023-06-04 17:00:59', '2023-06-04 17:01:36');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int UNSIGNED NOT NULL,
  `id_kategori` int UNSIGNED NOT NULL,
  `kode_produk` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_produk` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_modal` int NOT NULL,
  `diskon` tinyint NOT NULL DEFAULT '0',
  `harga_jual` int NOT NULL,
  `daya_tahan` int NOT NULL,
  `stok` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `id_kategori`, `kode_produk`, `nama_produk`, `harga_modal`, `diskon`, `harga_jual`, `daya_tahan`, `stok`, `created_at`, `updated_at`) VALUES
(1, 1, 'P-CRP-000001', 'Espresso', 5000, 0, 10000, 25, 59, '2023-05-21 07:17:24', '2023-05-31 00:21:07'),
(2, 1, 'P-CRP-000002', 'Americanno', 5000, 0, 15000, 25, 96, '2023-05-21 07:17:56', '2023-06-04 17:01:36'),
(3, 1, 'P-CRP-000003', 'Long Black', 5000, 0, 15000, 25, 99, '2023-05-21 07:19:18', '2023-05-30 22:50:16'),
(4, 1, 'P-CRP-000004', 'Caffe Latte', 5000, 0, 15000, 25, 97, '2023-05-21 07:19:56', '2023-06-04 17:01:36'),
(5, 4, 'P-CRP-000005', 'Cerita', 5000, 0, 15000, 23, 99, '2023-05-24 10:45:46', '2023-05-31 00:21:07'),
(7, 1, 'P-CRP-000006', 'Cappucinno', 5000, 0, 15000, 29, 100, '2023-06-04 14:02:41', '2023-06-04 14:02:41'),
(8, 1, 'P-CRP-000008', 'Mochacino', 5000, 0, 15000, 30, 100, '2023-06-04 14:03:29', '2023-06-04 14:03:29'),
(9, 2, 'P-CRP-000009', 'Lungo', 5000, 0, 15000, 31, 100, '2023-06-04 14:04:17', '2023-06-04 14:04:17'),
(10, 2, 'P-CRP-000010', 'V60', 5000, 0, 15000, 32, 100, '2023-06-04 14:05:28', '2023-06-04 14:05:28'),
(11, 2, 'P-CRP-000011', 'Vietnam Drip', 5000, 0, 15000, 33, 100, '2023-06-04 14:06:12', '2023-06-04 14:06:12'),
(12, 2, 'P-CRP-000012', 'Aeropress', 5000, 0, 15000, 34, 100, '2023-06-04 14:06:47', '2023-06-04 14:06:47'),
(13, 2, 'P-CRP-000013', 'Tubruk', 5000, 0, 10000, 35, 100, '2023-06-04 14:08:40', '2023-06-04 14:08:40'),
(14, 4, 'P-CRP-000014', 'Red Eye', 5000, 0, 20000, 36, 100, '2023-06-04 14:09:32', '2023-06-04 14:09:32'),
(15, 4, 'P-CRP-000015', 'Black Eye', 5000, 0, 20000, 37, 100, '2023-06-04 14:11:00', '2023-06-04 14:11:00'),
(16, 3, 'P-CRP-000016', 'Karna', 5000, 0, 20000, 38, 100, '2023-06-04 14:12:17', '2023-06-04 14:12:17'),
(17, 3, 'P-CRP-000017', 'Kamu', 5000, 0, 20000, 39, 100, '2023-06-04 14:12:48', '2023-06-04 14:12:48');

-- --------------------------------------------------------

--
-- Table structure for table `promos`
--

CREATE TABLE `promos` (
  `id` bigint UNSIGNED NOT NULL,
  `id_produk1` int UNSIGNED NOT NULL,
  `id_produk2` int UNSIGNED NOT NULL,
  `nama_promo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `promos`
--

INSERT INTO `promos` (`id`, `id_produk1`, `id_produk2`, `nama_promo`, `status`, `harga`, `created_at`, `updated_at`) VALUES
(1, 2, 4, 'Promo Bulan Juni', 'ACTIVE', 23000, '2023-05-30 22:50:50', '2023-05-31 00:19:50'),
(2, 5, 1, 'Promo Awal Tahun', 'ACTIVE', 20000, '2023-05-31 00:16:16', '2023-05-31 00:19:40'),
(3, 1, 9, 'Promo', 'ACTIVE', 20000, '2023-06-04 17:21:29', '2023-06-04 17:21:29');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('Jgeny10reoen8U3qEmMmYGEisNZGkeyYUYg1lb58', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRXNGVzUwZUhjU291dHVRUEZYck0yeVIzMk1zSlFSRXR1cmJCR3BSRSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly9uYXRzZXJhLmNvbSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1684952598);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `level` tinyint NOT NULL,
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `level`, `foto`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', NULL, '$2y$10$/Ggpy.xY/bwAPsIDkAGoVeN1RRs44R1.bo3lYhaG7N32j4ECxX9ni', NULL, NULL, NULL, NULL, 1, '/img/logo-20230604150921.png', '2023-05-21 06:54:29', '2023-06-04 08:05:02'),
(2, 'Kasir 1', 'kasir1@gmail.com', NULL, '$2y$10$u7.zIDVIqSOz.bXTBL/NMOB/f.RcGHoKcCj8mds7u4UoQVk/kL51K', NULL, NULL, NULL, NULL, 2, '/img/user.jpg', '2023-05-21 06:54:29', '2023-06-04 08:40:01'),
(3, 'Kasir 2', 'kasir2@gmail.com', NULL, '$2y$10$9AMVkCVKwkiJc5ZrApDwueA7SsnNExjf4fkhg8r64OEtZZrXtbQEe', NULL, NULL, NULL, NULL, 2, '/img/logo-20230604155411.jpeg', '2023-06-04 06:41:16', '2023-06-04 07:54:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`),
  ADD UNIQUE KEY `kategori_nama_kategori_unique` (`nama_kategori`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pengaturan`
--
ALTER TABLE `pengaturan`
  ADD PRIMARY KEY (`id_pengaturan`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id_penjualan`);

--
-- Indexes for table `penjualan_detail`
--
ALTER TABLE `penjualan_detail`
  ADD PRIMARY KEY (`id_penjualan_detail`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD UNIQUE KEY `produk_kode_produk_unique` (`kode_produk`),
  ADD UNIQUE KEY `produk_nama_produk_unique` (`nama_produk`),
  ADD KEY `produk_id_kategori_foreign` (`id_kategori`);

--
-- Indexes for table `promos`
--
ALTER TABLE `promos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `promos_id_produk1_foreign` (`id_produk1`),
  ADD KEY `promos_id_produk2_foreign` (`id_produk2`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `pengaturan`
--
ALTER TABLE `pengaturan`
  MODIFY `id_pengaturan` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id_penjualan` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `penjualan_detail`
--
ALTER TABLE `penjualan_detail`
  MODIFY `id_penjualan_detail` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `promos`
--
ALTER TABLE `promos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_id_kategori_foreign` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `promos`
--
ALTER TABLE `promos`
  ADD CONSTRAINT `promos_id_produk1_foreign` FOREIGN KEY (`id_produk1`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `promos_id_produk2_foreign` FOREIGN KEY (`id_produk2`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
