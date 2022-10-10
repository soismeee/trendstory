-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 06, 2022 at 12:47 AM
-- Server version: 5.7.33
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `trendstory`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang_masuks`
--

CREATE TABLE `barang_masuks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `no_bm` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_bm` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detail_barang_masuks`
--

CREATE TABLE `detail_barang_masuks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bm_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `jumlah` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `galleries`
--

CREATE TABLE `galleries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `name_photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jenis_products`
--

CREATE TABLE `jenis_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jenis_products`
--

INSERT INTO `jenis_products` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Bagipant', '2022-05-10 18:02:20', '2022-05-10 18:02:20'),
(2, 'Celana Panjang', '2022-05-10 18:02:35', '2022-05-10 18:02:35'),
(3, 'Baju biasa', '2022-05-11 08:13:54', '2022-05-11 08:13:54'),
(4, 'Celana pendek', '2022-05-11 08:14:02', '2022-05-11 08:14:02'),
(5, 'Baju Polos', '2022-06-03 00:31:22', '2022-06-03 00:31:22');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_04_24_013612_create_jenis_products_table', 1),
(6, '2022_04_24_013723_create_products_table', 1),
(7, '2022_04_24_014057_create_transaksis_table', 1),
(8, '2022_05_10_083353_create_galleries_table', 1),
(9, '2022_06_05_124614_create_barang_masuks_table', 1),
(10, '2022_06_05_125218_create_detail_barang_masuks_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jenis_id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `detail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stok` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `satuan` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cover` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `jenis_id`, `nama`, `detail`, `stok`, `satuan`, `cover`, `color`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 'Celana Chino', 'ini adalah produk pertama kami yaaaaaaaaaaa berhasil ya', '12', 'potong', 'pakaian1.jpg', 'info', '3', '2022-05-10 18:03:09', '2022-05-26 06:45:39'),
(2, 1, 'kulot panjang', 'ini adalah produk kami yang ke empat', '30', 'lusin', 'pakaian6.jfif', 'info', '3', '2022-05-11 08:07:23', '2022-05-26 06:46:49'),
(3, 1, 'Kemeja polos', 'yeay ada produk lagi', '50', 'lusin', 'pakaian2.jfif', 'success', '2', '2022-05-11 08:07:56', '2022-06-03 01:00:00'),
(4, 2, 'celana pendek', 'harus banget beli nih', '23', 'potong', '', 'info', '3', '2022-05-11 08:08:25', '2022-05-11 08:08:25'),
(5, 4, 'celana trendy', 'ini adalah produk yang kesekian kalinya', '45', 'potong', '', 'info', '3', '2022-05-11 08:14:44', '2022-06-03 00:39:32'),
(6, 3, 'baju polos', 'heyyooo', '100', 'potong', '', 'danger', '4', '2022-05-11 08:15:12', '2022-05-11 08:15:12'),
(7, 4, 'celana pendek mas', 'baru mau lauching', '20', 'lusin', '', 'warning', '1', '2022-05-11 08:15:34', '2022-05-11 08:15:34'),
(8, 1, 'produk baru', 'ini adalah produk pertama kami', '20', 'lusin', '', 'success', '2', '2022-05-11 08:15:57', '2022-05-11 08:15:57'),
(9, 2, 'produk hangat', 'jsdfkhsdfsdf', '20', 'potong', '', 'success', '2', '2022-05-11 08:16:26', '2022-05-11 08:16:26'),
(10, 3, 'produk lama', 'aripkan produk', '40', 'lusin', '', 'danger', '4', '2022-05-11 08:16:42', '2022-05-11 08:16:42'),
(11, 1, 'produk baru 2', 'ini adalah produk pertama kami', '20', 'lusin', '', 'success', '2', '2022-05-11 08:15:57', '2022-05-11 08:15:57'),
(12, 3, 'coba', 'yaaa', '11', 'okey', '', 'danger', '4', '2022-05-26 06:07:18', '2022-05-26 21:07:47'),
(13, 5, 'Baju Polos Hitam', 'okeyyyyyyyyyyyyyy', '10', 'Pcs', NULL, 'success', '2', '2022-06-03 00:36:20', '2022-06-03 00:38:02');

-- --------------------------------------------------------

--
-- Table structure for table `transaksis`
--

CREATE TABLE `transaksis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `no_transaksi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaksis`
--

INSERT INTO `transaksis` (`id`, `user_id`, `product_id`, `no_transaksi`, `jumlah`, `created_at`, `updated_at`) VALUES
(1, 2, 2, 'TSP000001', '12', '2022-06-05 07:08:20', '2022-06-05 07:08:20'),
(2, 2, 1, 'TSP000002', '4', '2022-06-05 07:08:32', '2022-06-05 07:08:32');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aktif` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `username`, `role`, `alamat`, `aktif`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'positif vibes', 'admin@gmail.com', 'admin', '1', NULL, 'aktif', NULL, '$2y$10$Lr5ILLq7v26tcjJpRQuC3uHesuD4/I7ZQropx6lMhBXUa0sVUWj/O', NULL, '2022-05-10 01:43:04', '2022-05-10 01:43:04'),
(2, 'inka', 'inka@gmail.com', 'inka', '3', NULL, 'aktif', NULL, '$2y$10$aGgbOhxKLQkwVVnsmEeKZ.BfycFTKSJzX.RORr5Wewn2SJBa4Ewii', NULL, '2022-05-26 07:12:26', '2022-06-03 00:43:01'),
(3, 'karyawan', 'karyawan@gmail.com', 'karyawan', '2', NULL, 'aktif', NULL, '$2y$10$Qdn3BbO.RA920jvna5Z1VuIqldCNe56pRfHV1xBRCEC3BQMqQ9ABC', NULL, '2022-05-27 08:36:37', '2022-06-03 00:56:26'),
(4, 'bagas', 'bagas@gmail.com', 'bagas', '3', NULL, 'aktif', NULL, '$2y$10$fn.4tLvbpjCKWU8dTVL7TuzD5KxX6DeyrnVExtpFuNmDGoGIulTXe', NULL, '2022-05-27 08:47:29', '2022-06-03 00:49:38'),
(7, 'okee', 'okee@gmail.com', 'okee', '2', NULL, 'non-aktif', NULL, '$2y$10$83fWjvz0A4ImVu3BekmIFO1K/tcdByOBl8ofE8mon7dTeJXexakcG', NULL, '2022-05-28 08:43:13', '2022-05-28 08:44:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang_masuks`
--
ALTER TABLE `barang_masuks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_barang_masuks`
--
ALTER TABLE `detail_barang_masuks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `galleries`
--
ALTER TABLE `galleries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenis_products`
--
ALTER TABLE `jenis_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksis`
--
ALTER TABLE `transaksis`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `barang_masuks`
--
ALTER TABLE `barang_masuks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detail_barang_masuks`
--
ALTER TABLE `detail_barang_masuks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `galleries`
--
ALTER TABLE `galleries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jenis_products`
--
ALTER TABLE `jenis_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `transaksis`
--
ALTER TABLE `transaksis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
