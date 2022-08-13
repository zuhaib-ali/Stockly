-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 16, 2021 at 07:44 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stockly`
--

-- --------------------------------------------------------

--
-- Table structure for table `accountants`
--

CREATE TABLE `accountants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'accountant',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `accountants`
--

INSERT INTO `accountants` (`id`, `name`, `email`, `phone`, `address`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'accountant 1', 'accountatn1@gmail.com', '111-11111111', 'address 1', '$2y$10$F34tQB5sKQOernU0/1BvW.nxzr0RuFrsyTh4twj68bUgrS7jrIhl6', 'accountant', '2021-12-04 03:31:05', '2021-12-04 03:31:05'),
(2, 'accountant 2', 'accountatn2@gmail.com', '0333333333', 'accountant 2 address', '$2y$10$R58YfhCZHcTdXYRi/vVL3.rX9cVYPjUsJKuZFay9BtMglMYauZcYS', 'accountant', '2021-12-06 05:26:51', '2021-12-06 05:26:51');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'laptop', '2021-12-07 00:56:44', '2021-12-07 00:56:44'),
(2, 'shoes', '2021-12-07 01:02:08', '2021-12-07 01:02:08'),
(3, 'sweater/upper', '2021-12-07 01:02:46', '2021-12-07 01:02:46'),
(4, 'cars', '2021-12-07 01:05:53', '2021-12-07 01:05:53'),
(5, 'bikes', '2021-12-07 01:06:02', '2021-12-07 01:06:02'),
(6, 'trucks', '2021-12-07 01:06:13', '2021-12-07 01:06:13');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`category_id`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `name`, `email`, `address`, `phone`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 'HP', 'hp@gmail.com', 'Palo Alto, California', '01111111111', '[1]', '2021-12-07 00:55:21', '2021-12-07 00:56:44'),
(2, 'Dell', 'dell@gmail.com', '1 Dell Way, Round Rock, TX 78664', '02222222222', '[1]', '2021-12-07 00:55:48', '2021-12-07 00:56:51'),
(3, 'Honda', 'honda@gmail.com', 'Torrance, California', '0333333333', '[4,5,6]', '2021-12-07 01:01:14', '2021-12-07 01:06:13'),
(4, 'Nike', 'nike@gmail.com', 'Beaverton, OR', '04444444444', '[2,3]', '2021-12-07 01:01:48', '2021-12-07 01:02:46');

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
-- Table structure for table `investers`
--

CREATE TABLE `investers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cnic` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nominee_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nominee_cnic` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nominee_relationship` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cnic_front` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cnic_back` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `referral_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `terms_conditions` tinyint(1) NOT NULL,
  `accountant_id` tinyint(1) NOT NULL,
  `level` int(10) UNSIGNED DEFAULT NULL,
  `level_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `points` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `investers`
--

INSERT INTO `investers` (`id`, `first_name`, `last_name`, `username`, `email`, `phone`, `cnic`, `address`, `password`, `nominee_name`, `nominee_cnic`, `nominee_relationship`, `image`, `cnic_front`, `cnic_back`, `referral_code`, `terms_conditions`, `accountant_id`, `level`, `level_name`, `points`, `created_at`, `updated_at`) VALUES
(1, 'amir', 'ali', 'amir ali', 'amirali@email.com', '01111111111', '4320111111111', 'address 1', '$2y$10$gMvf6ZZ2AAjP/lFxSUkzoezPcfm4wtrLj37lEHLGC132quR8rAJVm', NULL, NULL, NULL, NULL, 'cnic_front.jpg', 'cnic_back.jpg', NULL, 1, 1, NULL, NULL, NULL, NULL, NULL),
(2, 'irfan', 'ali', 'irfan ali', 'irfanali@email.com', '02222222222', '4320111111112', 'address 2', '$2y$10$1Km03OrKiGlnvVav8LaX.eIk240evCzcF2E0OGVUHUY6BJedwfp1C', 'nomee for irfan ali', '1233455', 'brother', '1639393753_wallpapersden.com_76339-3840x2160.jpg', 'cnic_front.jpg', 'cnic_back.jpg', '1', 1, 1, NULL, NULL, NULL, NULL, '2021-12-15 23:58:23'),
(3, 'imran', 'ali', 'imran ali', 'imranali@email.com', '03333333333', '4320111111113', 'address 3', '$2y$10$Rq/LYi4HT5Sfd6o5EAudT.kxWDw0jNV0sQPrrl5dMDR/z.yHANsX2', NULL, NULL, NULL, NULL, 'front3.jpg', 'back3.jpg', '2', 1, 1, NULL, NULL, NULL, NULL, NULL),
(4, 'iqrar', 'ali', 'iqrar ali', 'iqrarali@email.com', '04444444444', '4320111111114', 'address 2', '$2y$10$Rqea6H7OiDhI93fdAo5mQOBMKFsRigP.DMi28DMMx1Qv7CrQVnLPu', 'nominee', '12345678', 'uncle', NULL, 'cnic_front.jpg', 'cnic_back.jpg', NULL, 1, 1, NULL, NULL, NULL, NULL, NULL);

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
(17, '2014_10_12_000000_create_users_table', 1),
(18, '2014_10_12_100000_create_password_resets_table', 1),
(19, '2019_08_19_000000_create_failed_jobs_table', 1),
(20, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(21, '2021_11_26_043657_create_categories_table', 1),
(22, '2021_11_26_043719_create_products_table', 1),
(23, '2021_11_26_081855_create_companies_table', 1),
(24, '2021_11_27_070845_create_product_images_table', 1),
(25, '2021_11_29_053928_create_sub_categories_table', 1),
(26, '2021_12_02_105715_create_settings_table', 1),
(29, '2021_12_03_050813_create_accountants_table', 2),
(58, '2021_12_07_045431_create_transactions_table', 8),
(62, '2021_12_03_115125_create_investers_table', 9);

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
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(10) UNSIGNED NOT NULL,
  `tax` int(10) UNSIGNED DEFAULT NULL,
  `company_id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `stock` int(10) UNSIGNED DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `image`, `name`, `price`, `tax`, `company_id`, `category_id`, `stock`, `description`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Dell', 19000, NULL, 2, 1, 1490, 'dell laptop 1', '2021-12-07 01:03:37', '2021-12-14 04:35:21'),
(2, NULL, 'CD 70', 80000, NULL, 3, 5, 492, 'honda bike 1', '2021-12-07 01:06:51', '2021-12-14 04:34:05'),
(3, NULL, 'Corolla GLI', 2500000, NULL, 3, 4, 999, 'honda card 1', '2021-12-07 01:07:34', '2021-12-14 04:35:21');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `image_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `filler` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `non_filler` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `investor` int(10) UNSIGNED NOT NULL,
  `product` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`product`)),
  `price` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`price`)),
  `quantity` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`quantity`)),
  `total` double NOT NULL,
  `payment_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment` int(10) UNSIGNED DEFAULT NULL,
  `accountant_id` int(10) UNSIGNED NOT NULL,
  `delivered` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`delivered`)),
  `deposited` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`deposited`)),
  `deposited_amount` double DEFAULT NULL,
  `is_deposited` tinyint(1) NOT NULL DEFAULT 0,
  `seen` tinyint(1) NOT NULL DEFAULT 0,
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `investor`, `product`, `price`, `quantity`, `total`, `payment_type`, `payment`, `accountant_id`, `delivered`, `deposited`, `deposited_amount`, `is_deposited`, `seen`, `transaction_id`, `created_at`, `updated_at`) VALUES
(1, 1, '[1]', '[19000]', '[2]', 38000, 'jazz_cash', 1, 1, '[1]', '[1]', 19000, 1, 1, '12345', '2021-12-14 03:44:29', '2021-12-16 00:27:23'),
(2, 1, '[1]', '[19000]', '[2]', 38000, 'meezan_bank', 1, 1, '[1]', '[1]', 19000, 1, 1, '12345', '2021-12-14 03:51:28', '2021-12-15 05:16:26'),
(5, 2, '[1]', '[19000]', '[2]', 38000, 'meezan_bank', 1, 1, '[1]', '[1]', 19000, 1, 1, '12345', '2021-12-14 04:33:36', '2021-12-15 05:14:50'),
(6, 3, '[2]', '[80000]', '[4]', 320000, 'meezan_bank', 1, 1, '[2]', '[2]', 160000, 1, 1, '12345', '2021-12-14 04:34:05', '2021-12-15 04:49:36'),
(7, 4, '[1,3]', '[19000,2500000]', '[2,2]', 5038000, 'jazz_cash', 1, 1, '[1,1]', '[1,1]', 2519000, 1, 1, '12345', '2021-12-14 04:35:21', '2021-12-16 00:28:24');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `phone`, `address`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'user-admin', 'admin@admin.com', NULL, '$2y$10$VNLIO9CjO6AZZgzmQPGb4Oz17ZHKBkcv2k3XVgLQmNEyLKKuzpc6S', NULL, NULL, 'admin', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accountants`
--
ALTER TABLE `accountants`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `accountants_email_unique` (`email`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `investers`
--
ALTER TABLE `investers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `investers_email_unique` (`email`),
  ADD UNIQUE KEY `investers_cnic_unique` (`cnic`),
  ADD UNIQUE KEY `investers_referral_code_unique` (`referral_code`);

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
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
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
-- AUTO_INCREMENT for table `accountants`
--
ALTER TABLE `accountants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `investers`
--
ALTER TABLE `investers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
