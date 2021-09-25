-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 06, 2021 at 04:35 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qrcode_login`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

CREATE TABLE `absensi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `tgl` date NOT NULL,
  `kondisi_checkin` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_kerja_checkin` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `posisi_checkin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `checkin` time DEFAULT NULL,
  `kondisi_lapor_posisi_1` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_kerja_lapor_posisi_1` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `posisi_lapor_posisi_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lapor_posisi_1` time DEFAULT NULL,
  `kondisi_lapor_posisi_2` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_kerja_lapor_posisi_2` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `posisi_lapor_posisi_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lapor_posisi_2` time DEFAULT NULL,
  `kondisi_checkout` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_kerja_checkout` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `posisi_checkout` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `checkout` time DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `absensi`
--

INSERT INTO `absensi` (`id`, `user_id`, `tgl`, `kondisi_checkin`, `status_kerja_checkin`, `posisi_checkin`, `checkin`, `kondisi_lapor_posisi_1`, `status_kerja_lapor_posisi_1`, `posisi_lapor_posisi_1`, `lapor_posisi_1`, `kondisi_lapor_posisi_2`, `status_kerja_lapor_posisi_2`, `posisi_lapor_posisi_2`, `lapor_posisi_2`, `kondisi_checkout`, `status_kerja_checkout`, `posisi_checkout`, `checkout`, `created_at`, `updated_at`) VALUES
(14, 21, '2021-07-21', 'kurangsehat', 'wfh', 'Jl. Tamalate 1 No.2, Mappala, Kec. Rappocini, Kota Makassar, Sulawesi Selatan 90222, Indonesia', '23:08:21', 'kurangsehat', 'wfh', 'Jl. Tamalate 1 No.2, Mappala, Kec. Rappocini, Kota Makassar, Sulawesi Selatan 90222, Indonesia', '23:08:30', 'sehat', 'wfs', 'Jl. Tamalate 1 No.2, Mappala, Kec. Rappocini, Kota Makassar, Sulawesi Selatan 90222, Indonesia', '23:08:34', 'kurangsehat', 'wfo', 'Jl. Tamalate 1 No.2, Mappala, Kec. Rappocini, Kota Makassar, Sulawesi Selatan 90222, Indonesia', '23:08:40', '2021-07-21 07:08:21', '2021-07-21 07:08:40'),
(15, 21, '2021-07-22', 'kurangsehat', 'wfh', 'Jl. Tamalate 1 No.2, Mappala, Kec. Rappocini, Kota Makassar, Sulawesi Selatan 90222, Indonesia', '00:21:51', 'sakit', 'wfh', 'Jl. Tamalate 1 No.2, Mappala, Kec. Rappocini, Kota Makassar, Sulawesi Selatan 90222, Indonesia', '11:17:09', 'kurangsehat', 'wfo', 'Jl. Tamalate 1 No.2, Mappala, Kec. Rappocini, Kota Makassar, Sulawesi Selatan 90222, Indonesia', '11:17:14', 'sehat', 'wfs', 'Jl. Tamalate 1 No.2, Mappala, Kec. Rappocini, Kota Makassar, Sulawesi Selatan 90222, Indonesia', '11:17:20', '2021-07-21 08:21:51', '2021-07-21 19:17:20'),
(16, 22, '2021-07-22', 'sakit', 'wfo', 'Jl. Mahoni No.143, Kassi-Kassi, Kec. Rappocini, Kota Makassar, Sulawesi Selatan 90222, Indonesia', '14:11:01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-07-21 22:11:01', '2021-07-21 22:11:01');

-- --------------------------------------------------------

--
-- Table structure for table `admin_menu`
--

CREATE TABLE `admin_menu` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `icon` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(70) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_sub_menu_exist` int(11) NOT NULL,
  `access_role` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_menu`
--

INSERT INTO `admin_menu` (`id`, `icon`, `title`, `url`, `is_sub_menu_exist`, `access_role`, `created_at`, `updated_at`) VALUES
(1, 'fas fa-tachometer-alt', 'Dashboard', 'dashboard', 0, 2, '2021-07-19 02:11:25', '2021-07-19 02:11:25'),
(2, 'fas fa-users', 'Manajemen User', 'managementuser', 0, 1, NULL, NULL),
(3, 'fas fa-chart-area', 'Pelanggan', 'pelanggan', 0, 2, NULL, NULL),
(4, 'fas fa-truck', 'Suplier', 'suplier', 0, 2, NULL, NULL),
(5, 'fas fa-shopping-cart', 'Produk', 'produk', 1, 2, NULL, NULL),
(6, 'fas fa-layer-group', 'Stok', 'stok', 1, 2, NULL, NULL),
(7, 'fas fa-money-check-alt', 'Transaksi', 'transaksi', 0, 2, NULL, NULL),
(8, 'fas fa-file-word', 'Laporan', 'laporan', 1, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admin_sub_menu`
--

CREATE TABLE `admin_sub_menu` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_menu` int(11) NOT NULL,
  `icon` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(70) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_sub_menu`
--

INSERT INTO `admin_sub_menu` (`id`, `id_menu`, `icon`, `title`, `url`, `created_at`, `updated_at`) VALUES
(1, 5, 'fas fa-shopping-cart', 'Kategori Produk', 'kategori-produk', NULL, NULL),
(2, 5, 'fas fa-shopping-cart', 'Satuan Produk', 'satuan-produk', NULL, NULL),
(3, 5, 'fas fa-shopping-cart', 'Produk', 'produk', NULL, NULL),
(4, 6, 'fas fa-layer-group', 'Stok Masuk', 'stok-masuk', NULL, NULL),
(5, 6, 'fas fa-layer-group', 'Stok Keluar', 'stok-keluar', NULL, NULL),
(6, 8, 'fas fa-file-word', 'Lapora Penjualan', 'laporan-penjualan', NULL, NULL),
(7, 8, 'fas fa-file-word', 'Laporan Stok Masuk', 'laporan-stok-masuk', NULL, NULL),
(8, 8, 'fas fa-file-word', 'Laporan Stok Keluar', 'laporan-stok-keluar', NULL, NULL);

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
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(9, '2014_10_12_000000_create_users_table', 1),
(10, '2014_10_12_100000_create_password_resets_table', 1),
(11, '2019_08_19_000000_create_failed_jobs_table', 1),
(12, '2021_07_07_041230_create_roles_table', 1),
(16, '2021_07_07_121245_create_absensi_models_table', 2),
(17, '2021_07_19_020921_create_admin_menu_table', 3),
(18, '2021_07_19_071932_create_admin_sub_menu_table', 4),
(19, '2021_07_27_113355_create_qrcode_table', 5),
(20, '2021_08_03_063818_create_pelanggan_table', 6);

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
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nohp` char(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `qrcode`
--

CREATE TABLE `qrcode` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `token` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`, `created_at`, `updated_at`) VALUES
(1, 'admin', NULL, NULL),
(2, 'pegawai', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `name`, `username`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(7, 1, 'admin', 'admin', 'admin@gmail.com', NULL, '$2y$10$Pl3aZNH4Isd9mI7Hzydloukw6EewXZUDCQQVhFjx3ffVRKItLieyK', NULL, '2021-07-18 22:26:58', '2021-07-18 22:26:58'),
(21, 2, 'ince samsul', 'incesamsul', 'incesamsul@mail.com', NULL, '$2y$10$RaWDbvsfzZFmCvOnzPOKCuyxUS0eRB2bxZlQ1ttMXgu/xsaZH1fUS', NULL, '2021-07-21 07:07:11', '2021-07-21 07:07:11'),
(22, 2, 'ashbar', 'ashbar', 'ashbar@mail.com', NULL, '$2y$10$OjdkkcaB3Xa3EY15bAGDGOePRn8DXMYkleyyYf0ZyO4O0p1D4PYfS', NULL, '2021-07-21 07:07:24', '2021-07-21 07:07:24'),
(23, 2, 'andi amaliah', 'andiamaliah', 'andiamaliah@mail.com', NULL, '$2y$10$pU5jYlYmzijecy4yjD9drO4D9WZOQs.eFswLkJzokEr/sovZCFub6', NULL, '2021-07-21 07:07:35', '2021-07-21 07:07:35'),
(24, 2, 'nensi', 'nensi', 'nensi@mail.com', NULL, '$2y$10$ztKELf5Pe0WKfhL2Vkx/KuIsnAlpIleBuaz8561BYxUQ/VpeP.awa', NULL, '2021-07-21 07:07:44', '2021-07-21 07:07:44'),
(25, 2, 'syarif', 'syarif', 'syarif@mail.com', NULL, '$2y$10$meIBt5ChUZkYLBUBrZE/eO/IvIlgYrxQRuy5/pDCo/j20ug3.fB1C', NULL, '2021-08-02 19:30:08', '2021-08-02 19:30:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_menu`
--
ALTER TABLE `admin_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_sub_menu`
--
ALTER TABLE `admin_sub_menu`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `qrcode`
--
ALTER TABLE `qrcode`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
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
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `admin_menu`
--
ALTER TABLE `admin_menu`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `admin_sub_menu`
--
ALTER TABLE `admin_sub_menu`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `qrcode`
--
ALTER TABLE `qrcode`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
