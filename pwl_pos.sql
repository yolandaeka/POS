-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 25, 2024 at 06:39 AM
-- Server version: 8.0.36
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pwl_pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_09_11_063430_create_m_level_table', 1),
(6, '2024_09_11_064644_create_m_kategoril_table', 2),
(7, '2024_09_11_065247_create_m_supplier_table', 3),
(8, '2024_09_11_072140_create_m_user_table', 4),
(9, '2024_09_11_072709_create_m_barang_table', 5),
(10, '2024_09_11_073655_create_t_penjualan_table', 6),
(11, '2024_09_11_074352_create_t_stok_table', 7),
(12, '2024_09_11_075429_create_t_penjualan_detail_table', 8);

-- --------------------------------------------------------

--
-- Table structure for table `m_barang`
--

CREATE TABLE `m_barang` (
  `barang_id` bigint UNSIGNED NOT NULL,
  `kategori_id` bigint UNSIGNED NOT NULL,
  `barang_kode` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `barang_nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_beli` int NOT NULL,
  `harga_jual` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `m_barang`
--

INSERT INTO `m_barang` (`barang_id`, `kategori_id`, `barang_kode`, `barang_nama`, `harga_beli`, `harga_jual`, `created_at`, `updated_at`) VALUES
(1, 1, 'BRG001', 'Televisi 32 Inch', 2500000, 3000000, NULL, NULL),
(2, 1, 'BRG002', 'Kulkas 2 Pintu', 3200000, 3800000, NULL, NULL),
(3, 3, 'BRG003', 'Setrika Listrik', 250000, 350000, NULL, NULL),
(4, 3, 'BRG004', 'Rice Cooker 1.8L', 400000, 500000, NULL, NULL),
(5, 3, 'BRG005', 'Vacuum Cleaner', 800000, 950000, NULL, NULL),
(6, 2, 'BRG006', 'Kaos Polos', 50000, 75000, NULL, NULL),
(7, 2, 'BRG007', 'Celana Jeans', 150000, 200000, NULL, NULL),
(8, 2, 'BRG008', 'Jaket Denim', 250000, 350000, NULL, NULL),
(9, 2, 'BRG009', 'Sepatu Sneakers', 300000, 400000, NULL, NULL),
(10, 2, 'BRG010', 'Kemeja Formal', 180000, 250000, NULL, NULL),
(11, 4, 'BRG011', 'Minuman Soda 1L', 8000, 12000, NULL, NULL),
(12, 4, 'BRG012', 'Keripik Kentang', 15000, 25000, NULL, NULL),
(13, 4, 'BRG013', 'Coklat Batang 100gr', 12000, 18000, NULL, NULL),
(14, 5, 'BRG014', 'Vitamin C 500mg', 25000, 35000, NULL, NULL),
(15, 5, 'BRG015', 'Masker Kesehatan 50 pcs', 50000, 75000, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_kategori`
--

CREATE TABLE `m_kategori` (
  `kategori_id` bigint UNSIGNED NOT NULL,
  `kategori_kode` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori_nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `m_kategori`
--

INSERT INTO `m_kategori` (`kategori_id`, `kategori_kode`, `kategori_nama`, `created_at`, `updated_at`) VALUES
(1, 'KAT001', 'Elektronik', NULL, NULL),
(2, 'KAT002', 'Pakaian', NULL, NULL),
(3, 'KAT003', 'Peralatan Rumah', NULL, NULL),
(4, 'KAT004', 'Makanan & Minuman', NULL, NULL),
(5, 'KAT005', 'Kesehatan', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_level`
--

CREATE TABLE `m_level` (
  `level_id` bigint UNSIGNED NOT NULL,
  `level_kode` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level_nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `m_level`
--

INSERT INTO `m_level` (`level_id`, `level_kode`, `level_nama`, `created_at`, `updated_at`) VALUES
(1, 'ADM', 'Administrator', NULL, NULL),
(2, 'MNG', 'Manager', NULL, NULL),
(3, 'STF', 'Staff/Kasir', NULL, NULL),
(5, 'CUS', 'Customer', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_supplier`
--

CREATE TABLE `m_supplier` (
  `supplier_id` bigint UNSIGNED NOT NULL,
  `supplier_kode` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `m_supplier`
--

INSERT INTO `m_supplier` (`supplier_id`, `supplier_kode`, `supplier_nama`, `supplier_alamat`, `created_at`, `updated_at`) VALUES
(1, 'SUP001', 'PT. Sumber Makmur', 'Jl. Melati No. 12, Jakarta', NULL, NULL),
(2, 'SUP002', 'CV. Maju Jaya', 'Jl. Merdeka No. 34, Bandung', NULL, NULL),
(3, 'SUP003', 'Toko Prima Sukses', 'Jl. Anggrek No. 56, Surabaya', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_user`
--

CREATE TABLE `m_user` (
  `user_id` bigint UNSIGNED NOT NULL,
  `level_id` bigint UNSIGNED NOT NULL,
  `username` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `m_user`
--

INSERT INTO `m_user` (`user_id`, `level_id`, `username`, `nama`, `password`, `created_at`, `updated_at`) VALUES
(1, 1, 'admin', 'Administrator', '$2y$12$7cWou.xvJwDqklCdH5QdCOZ7/Z6.zjeci2/.rbgYrDLYy4zuX8c9m', NULL, NULL),
(2, 2, 'manager', 'Manager', '$2y$12$mUq1xzRofQoGSlAD0PBXQ.WsgRoD.4RpF1dK/IMShmNR3G3IqEMVe', NULL, NULL),
(3, 3, 'staff', 'Staff/Kasir', '$2y$12$tafvccH4Rnp1fTD5kw5GgunBmorDmjAM9yT2mjQV2YXwhFZunXnwu', NULL, NULL),
(4, 5, 'customer-1', 'Pelanggan Perama', '$2y$12$wmdu9UvyENtYj61IYnnHwe8Rr1PeYNea9D/ZcumAsgdlS2AD0SymS', NULL, '2024-09-13 21:05:58'),
(5, 2, 'manager_dua', 'Manager 2', '$2y$12$q/FBO1XfaJD35o2AkPCJjegUn9mLOvDZQLRaGMZ1Sc2L/k5UpjH/q', '2024-09-18 06:13:34', '2024-09-18 06:13:34'),
(6, 2, 'manager22', 'Manager Dua Dua', '$2y$12$wPbhmD3Gj2pldfKV8U1YJeyl8WhTn9.2MSKEKD1iidoPVNkzFkGzq', '2024-09-18 07:34:28', '2024-09-18 07:34:28'),
(7, 2, 'manager33', 'Manager Tiga Tiga', '$2y$12$n63Mb/aaqZAU2tbnsTWc4.Bj4TZCnnz0kVYsAB8z7nHdSZaskoW/2', '2024-09-18 07:40:31', '2024-09-18 07:40:31'),
(8, 2, 'manager56', 'Manager55', '$2y$12$lT33yzQaCrs/ycUjhuqe1.ocNRO134F.zIWF1w9HNebAMKTZWa4Fi', '2024-09-18 07:47:40', '2024-09-18 07:47:40'),
(9, 2, 'manager12', 'Manager55', '$2y$12$S/6s4EbMpLS32Ze2R2ydGOgIDxRGzv8wcBv1Ppl3dxqVspKbY8xSG', '2024-09-18 07:52:16', '2024-09-18 07:52:16');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `t_penjualan`
--

CREATE TABLE `t_penjualan` (
  `penjualan_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `pembeli` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penjualan_kode` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penjualan_tanggal` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `t_penjualan`
--

INSERT INTO `t_penjualan` (`penjualan_id`, `user_id`, `pembeli`, `penjualan_kode`, `penjualan_tanggal`, `created_at`, `updated_at`) VALUES
(1, 3, 'Budi Santoso', 'PNJ001', '2024-09-14 09:00:00', NULL, NULL),
(2, 3, 'Andi Wijaya', 'PNJ002', '2024-09-14 09:30:00', NULL, NULL),
(3, 3, 'Siti Nurhaliza', 'PNJ003', '2024-09-14 10:00:00', NULL, NULL),
(4, 3, 'Teguh Prasetyo', 'PNJ004', '2024-09-14 10:30:00', NULL, NULL),
(5, 3, 'Maya Puspita', 'PNJ005', '2024-09-14 11:00:00', NULL, NULL),
(6, 3, 'Rahmat Hidayat', 'PNJ006', '2024-09-15 09:00:00', NULL, NULL),
(7, 3, 'Lina Suryani', 'PNJ007', '2024-09-15 09:30:00', NULL, NULL),
(8, 3, 'Hendro Wibowo', 'PNJ008', '2024-09-15 10:00:00', NULL, NULL),
(9, 3, 'Dewi Sri', 'PNJ009', '2024-09-15 10:30:00', NULL, NULL),
(10, 3, 'Asep Junaedi', 'PNJ010', '2024-09-15 11:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_penjualan_detail`
--

CREATE TABLE `t_penjualan_detail` (
  `detail_id` bigint UNSIGNED NOT NULL,
  `penjualan_id` bigint UNSIGNED NOT NULL,
  `barang_id` bigint UNSIGNED NOT NULL,
  `harga` int NOT NULL,
  `jumlah` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `t_penjualan_detail`
--

INSERT INTO `t_penjualan_detail` (`detail_id`, `penjualan_id`, `barang_id`, `harga`, `jumlah`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 3000000, 2, NULL, NULL),
(2, 1, 2, 3800000, 1, NULL, NULL),
(3, 1, 3, 350000, 3, NULL, NULL),
(4, 2, 4, 500000, 1, NULL, NULL),
(5, 2, 5, 950000, 2, NULL, NULL),
(6, 2, 6, 75000, 1, NULL, NULL),
(7, 3, 7, 200000, 3, NULL, NULL),
(8, 3, 8, 350000, 2, NULL, NULL),
(9, 3, 9, 400000, 1, NULL, NULL),
(10, 4, 10, 250000, 1, NULL, NULL),
(11, 4, 11, 12000, 3, NULL, NULL),
(12, 4, 12, 25000, 2, NULL, NULL),
(13, 5, 13, 18000, 2, NULL, NULL),
(14, 5, 14, 35000, 1, NULL, NULL),
(15, 5, 15, 75000, 2, NULL, NULL),
(16, 6, 1, 3000000, 3, NULL, NULL),
(17, 6, 2, 3800000, 1, NULL, NULL),
(18, 6, 3, 350000, 2, NULL, NULL),
(19, 7, 4, 500000, 2, NULL, NULL),
(20, 7, 5, 950000, 1, NULL, NULL),
(21, 7, 6, 75000, 2, NULL, NULL),
(22, 8, 7, 200000, 1, NULL, NULL),
(23, 8, 8, 350000, 1, NULL, NULL),
(24, 8, 9, 400000, 2, NULL, NULL),
(25, 9, 10, 250000, 2, NULL, NULL),
(26, 9, 11, 12000, 5, NULL, NULL),
(27, 9, 12, 25000, 1, NULL, NULL),
(28, 10, 13, 18000, 3, NULL, NULL),
(29, 10, 14, 35000, 2, NULL, NULL),
(30, 10, 15, 75000, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_stok`
--

CREATE TABLE `t_stok` (
  `stok_id` bigint UNSIGNED NOT NULL,
  `supplier_id` bigint UNSIGNED NOT NULL,
  `barang_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `stok_tanggal` datetime NOT NULL,
  `stok_jumlah` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `t_stok`
--

INSERT INTO `t_stok` (`stok_id`, `supplier_id`, `barang_id`, `user_id`, `stok_tanggal`, `stok_jumlah`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '2024-09-14 08:00:00', 50, NULL, NULL),
(2, 1, 2, 1, '2024-09-14 08:00:00', 40, NULL, NULL),
(3, 1, 3, 1, '2024-09-14 08:00:00', 100, NULL, NULL),
(4, 1, 4, 1, '2024-09-14 08:00:00', 75, NULL, NULL),
(5, 1, 5, 1, '2024-09-14 08:00:00', 60, NULL, NULL),
(6, 2, 6, 1, '2024-09-14 08:00:00', 200, NULL, NULL),
(7, 2, 7, 1, '2024-09-14 08:00:00', 150, NULL, NULL),
(8, 2, 8, 1, '2024-09-14 08:00:00', 120, NULL, NULL),
(9, 2, 9, 1, '2024-09-14 08:00:00', 80, NULL, NULL),
(10, 2, 10, 1, '2024-09-14 08:00:00', 100, NULL, NULL),
(11, 3, 11, 1, '2024-09-14 08:00:00', 500, NULL, NULL),
(12, 3, 12, 1, '2024-09-14 08:00:00', 300, NULL, NULL),
(13, 3, 13, 1, '2024-09-14 08:00:00', 250, NULL, NULL),
(14, 3, 14, 1, '2024-09-14 08:00:00', 400, NULL, NULL),
(15, 3, 15, 1, '2024-09-14 08:00:00', 600, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_barang`
--
ALTER TABLE `m_barang`
  ADD PRIMARY KEY (`barang_id`),
  ADD UNIQUE KEY `m_barang_barang_kode_unique` (`barang_kode`),
  ADD KEY `m_barang_kategori_id_index` (`kategori_id`);

--
-- Indexes for table `m_kategori`
--
ALTER TABLE `m_kategori`
  ADD PRIMARY KEY (`kategori_id`);

--
-- Indexes for table `m_level`
--
ALTER TABLE `m_level`
  ADD PRIMARY KEY (`level_id`),
  ADD UNIQUE KEY `m_level_level_kode_unique` (`level_kode`);

--
-- Indexes for table `m_supplier`
--
ALTER TABLE `m_supplier`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indexes for table `m_user`
--
ALTER TABLE `m_user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `m_user_username_unique` (`username`),
  ADD KEY `m_user_level_id_index` (`level_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `t_penjualan`
--
ALTER TABLE `t_penjualan`
  ADD PRIMARY KEY (`penjualan_id`),
  ADD KEY `t_penjualan_user_id_index` (`user_id`);

--
-- Indexes for table `t_penjualan_detail`
--
ALTER TABLE `t_penjualan_detail`
  ADD PRIMARY KEY (`detail_id`),
  ADD KEY `t_penjualan_detail_penjualan_id_index` (`penjualan_id`),
  ADD KEY `t_penjualan_detail_barang_id_index` (`barang_id`);

--
-- Indexes for table `t_stok`
--
ALTER TABLE `t_stok`
  ADD PRIMARY KEY (`stok_id`),
  ADD KEY `t_stok_supplier_id_index` (`supplier_id`),
  ADD KEY `t_stok_barang_id_index` (`barang_id`),
  ADD KEY `t_stok_user_id_index` (`user_id`);

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
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `m_barang`
--
ALTER TABLE `m_barang`
  MODIFY `barang_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `m_kategori`
--
ALTER TABLE `m_kategori`
  MODIFY `kategori_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `m_level`
--
ALTER TABLE `m_level`
  MODIFY `level_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `m_supplier`
--
ALTER TABLE `m_supplier`
  MODIFY `supplier_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `m_user`
--
ALTER TABLE `m_user`
  MODIFY `user_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_penjualan`
--
ALTER TABLE `t_penjualan`
  MODIFY `penjualan_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `t_penjualan_detail`
--
ALTER TABLE `t_penjualan_detail`
  MODIFY `detail_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `t_stok`
--
ALTER TABLE `t_stok`
  MODIFY `stok_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `m_user`
--
ALTER TABLE `m_user`
  ADD CONSTRAINT `m_user_level_id_foreign` FOREIGN KEY (`level_id`) REFERENCES `m_level` (`level_id`);

--
-- Constraints for table `t_penjualan`
--
ALTER TABLE `t_penjualan`
  ADD CONSTRAINT `t_penjualan_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `m_user` (`user_id`);

--
-- Constraints for table `t_penjualan_detail`
--
ALTER TABLE `t_penjualan_detail`
  ADD CONSTRAINT `t_penjualan_detail_barang_id_foreign` FOREIGN KEY (`barang_id`) REFERENCES `m_barang` (`barang_id`),
  ADD CONSTRAINT `t_penjualan_detail_penjualan_id_foreign` FOREIGN KEY (`penjualan_id`) REFERENCES `t_penjualan` (`penjualan_id`);

--
-- Constraints for table `t_stok`
--
ALTER TABLE `t_stok`
  ADD CONSTRAINT `t_stok_barang_id_foreign` FOREIGN KEY (`barang_id`) REFERENCES `m_barang` (`barang_id`),
  ADD CONSTRAINT `t_stok_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `m_supplier` (`supplier_id`),
  ADD CONSTRAINT `t_stok_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `m_user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
