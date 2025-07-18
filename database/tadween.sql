-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 18, 2025 at 08:57 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tadween`
--

-- --------------------------------------------------------

--
-- Table structure for table `blocked_users`
--

CREATE TABLE `blocked_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `blocked_user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `follows`
--

CREATE TABLE `follows` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `follower_id` bigint(20) UNSIGNED NOT NULL,
  `following_id` bigint(20) UNSIGNED NOT NULL,
  `is_pending` tinyint(1) NOT NULL DEFAULT 0,
  `is_seen` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `follows`
--

INSERT INTO `follows` (`id`, `follower_id`, `following_id`, `is_pending`, `is_seen`, `created_at`, `updated_at`) VALUES
(2, 3, 1, 0, 1, '2025-07-12 08:28:57', '2025-07-12 08:29:39'),
(3, 1, 3, 0, 1, '2025-07-18 07:53:46', '2025-07-18 07:57:05');

-- --------------------------------------------------------

--
-- Table structure for table `gifts`
--

CREATE TABLE `gifts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gifts`
--

INSERT INTO `gifts` (`id`, `name`, `price`, `created_at`, `updated_at`) VALUES
(1, 'gift1', 6.00, '2025-07-13 04:23:03', '2025-07-13 04:23:03'),
(2, 'gift2', 8.00, '2025-07-13 04:23:03', '2025-07-13 04:23:03'),
(3, 'gift3', 10.00, '2025-07-13 04:23:04', '2025-07-13 04:23:04'),
(4, 'gift4', 5.00, '2025-07-13 04:23:04', '2025-07-13 04:23:04'),
(5, 'gift5', 6.00, '2025-07-13 04:23:04', '2025-07-13 04:23:04'),
(6, 'gift6', 3.00, '2025-07-13 04:23:04', '2025-07-13 04:23:04'),
(7, 'gift7', 2.00, '2025-07-13 04:23:05', '2025-07-13 04:23:05'),
(8, 'gift8', 1.00, '2025-07-13 04:23:05', '2025-07-13 04:23:05'),
(9, 'gift9', 2.00, '2025-07-13 04:23:05', '2025-07-13 04:23:05'),
(10, 'gift10', 10.00, '2025-07-13 04:23:05', '2025-07-13 04:23:05'),
(11, 'gift11', 1.00, '2025-07-13 04:23:06', '2025-07-13 04:23:06'),
(12, 'gift12', 5.00, '2025-07-13 04:23:06', '2025-07-13 04:23:06'),
(13, 'gift13', 6.00, '2025-07-13 04:23:06', '2025-07-13 04:23:06'),
(14, 'gift14', 2.00, '2025-07-13 04:23:07', '2025-07-13 04:23:07'),
(15, 'gift15', 2.00, '2025-07-13 04:23:07', '2025-07-13 04:23:07'),
(16, 'gift16', 5.00, '2025-07-13 04:23:07', '2025-07-13 04:23:07'),
(17, 'gift17', 3.00, '2025-07-13 04:23:07', '2025-07-13 04:23:07'),
(18, 'gift18', 8.00, '2025-07-13 04:23:07', '2025-07-13 04:23:07'),
(19, 'gift19', 4.00, '2025-07-13 04:23:08', '2025-07-13 04:23:08'),
(20, 'gift20', 3.00, '2025-07-13 04:23:08', '2025-07-13 04:23:08'),
(21, 'gift21', 1.00, '2025-07-13 04:23:08', '2025-07-13 04:23:08'),
(22, 'gift22', 10.00, '2025-07-13 04:23:08', '2025-07-13 04:23:08'),
(23, 'gift23', 2.00, '2025-07-13 04:23:08', '2025-07-13 04:23:08'),
(24, 'gift24', 2.00, '2025-07-13 04:23:09', '2025-07-13 04:23:09'),
(25, 'gift25', 8.00, '2025-07-13 04:23:09', '2025-07-13 04:23:09'),
(26, 'gift26', 7.00, '2025-07-13 04:23:09', '2025-07-13 04:23:09'),
(27, 'gift27', 4.00, '2025-07-13 04:23:09', '2025-07-13 04:23:09'),
(28, 'gift28', 9.00, '2025-07-13 04:23:10', '2025-07-13 04:23:10'),
(29, 'gift29', 2.00, '2025-07-13 04:23:10', '2025-07-13 04:23:10'),
(30, 'gift30', 1.00, '2025-07-13 04:23:10', '2025-07-13 04:23:10'),
(31, 'gift31', 10.00, '2025-07-13 04:23:10', '2025-07-13 04:23:10'),
(32, 'gift32', 9.00, '2025-07-13 04:23:10', '2025-07-13 04:23:10'),
(33, 'gift33', 5.00, '2025-07-13 04:23:11', '2025-07-13 04:23:11'),
(34, 'gift34', 3.00, '2025-07-13 04:23:11', '2025-07-13 04:23:11'),
(35, 'gift35', 5.00, '2025-07-13 04:23:11', '2025-07-13 04:23:11');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) DEFAULT NULL,
  `collection_name` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `mime_type` varchar(255) DEFAULT NULL,
  `disk` varchar(255) NOT NULL,
  `conversions_disk` varchar(255) DEFAULT NULL,
  `size` bigint(20) UNSIGNED NOT NULL,
  `manipulations` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`manipulations`)),
  `custom_properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`custom_properties`)),
  `generated_conversions` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`generated_conversions`)),
  `responsive_images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`responsive_images`)),
  `order_column` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `model_type`, `model_id`, `uuid`, `collection_name`, `name`, `file_name`, `mime_type`, `disk`, `conversions_disk`, `size`, `manipulations`, `custom_properties`, `generated_conversions`, `responsive_images`, `order_column`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\Gift', 1, '3b2d5ef9-550e-4c3a-a2e0-a9a7104d8f33', 'icon', 'gift1', 'gift1.png', 'image/png', 'public', 'public', 305303, '[]', '[]', '[]', '[]', 1, '2025-07-13 04:23:03', '2025-07-13 04:23:03'),
(2, 'App\\Models\\Gift', 2, '83665948-2655-4286-9ab2-02bf14276908', 'icon', 'gift2', 'gift2.png', 'image/png', 'public', 'public', 124058, '[]', '[]', '[]', '[]', 1, '2025-07-13 04:23:03', '2025-07-13 04:23:03'),
(3, 'App\\Models\\Gift', 3, 'de421739-0076-45b4-ba82-4f7bbccaadf9', 'icon', 'gift3', 'gift3.png', 'image/png', 'public', 'public', 319979, '[]', '[]', '[]', '[]', 1, '2025-07-13 04:23:04', '2025-07-13 04:23:04'),
(4, 'App\\Models\\Gift', 4, 'd895ef1c-688c-4bc9-accc-cbf799e93593', 'icon', 'gift4', 'gift4.png', 'image/png', 'public', 'public', 334519, '[]', '[]', '[]', '[]', 1, '2025-07-13 04:23:04', '2025-07-13 04:23:04'),
(5, 'App\\Models\\Gift', 5, '2505f105-c4ec-49eb-a356-28b2d807d855', 'icon', 'gift5', 'gift5.png', 'image/png', 'public', 'public', 294546, '[]', '[]', '[]', '[]', 1, '2025-07-13 04:23:04', '2025-07-13 04:23:04'),
(6, 'App\\Models\\Gift', 6, '2728a534-5449-4ea8-98e2-2e73cb31959c', 'icon', 'gift6', 'gift6.png', 'image/png', 'public', 'public', 151645, '[]', '[]', '[]', '[]', 1, '2025-07-13 04:23:04', '2025-07-13 04:23:04'),
(7, 'App\\Models\\Gift', 7, 'f5b700cf-6c8b-4427-9840-b0ef34dd3a07', 'icon', 'gift7', 'gift7.png', 'image/png', 'public', 'public', 266462, '[]', '[]', '[]', '[]', 1, '2025-07-13 04:23:05', '2025-07-13 04:23:05'),
(8, 'App\\Models\\Gift', 8, '650c44f5-79e8-4e74-95a4-798e67381e29', 'icon', 'gift8', 'gift8.png', 'image/png', 'public', 'public', 385357, '[]', '[]', '[]', '[]', 1, '2025-07-13 04:23:05', '2025-07-13 04:23:05'),
(9, 'App\\Models\\Gift', 9, 'a09e8f9b-553e-41db-9969-9e8dd538ea39', 'icon', 'gift9', 'gift9.png', 'image/png', 'public', 'public', 264765, '[]', '[]', '[]', '[]', 1, '2025-07-13 04:23:05', '2025-07-13 04:23:05'),
(10, 'App\\Models\\Gift', 10, 'd9f6b22e-8ba4-4e8a-8a27-68dfc6b5a389', 'icon', 'gift10', 'gift10.png', 'image/png', 'public', 'public', 194969, '[]', '[]', '[]', '[]', 1, '2025-07-13 04:23:05', '2025-07-13 04:23:05'),
(11, 'App\\Models\\Gift', 11, '9739ff45-65a3-46ac-b750-430e116db5fb', 'icon', 'gift11', 'gift11.png', 'image/png', 'public', 'public', 174278, '[]', '[]', '[]', '[]', 1, '2025-07-13 04:23:06', '2025-07-13 04:23:06'),
(12, 'App\\Models\\Gift', 12, '560a54a7-65b5-4715-9e98-c286ad411b22', 'icon', 'gift12', 'gift12.png', 'image/png', 'public', 'public', 124058, '[]', '[]', '[]', '[]', 1, '2025-07-13 04:23:06', '2025-07-13 04:23:06'),
(13, 'App\\Models\\Gift', 13, '77664916-afda-4b25-b439-7e8b980d0b36', 'icon', 'gift13', 'gift13.png', 'image/png', 'public', 'public', 164802, '[]', '[]', '[]', '[]', 1, '2025-07-13 04:23:07', '2025-07-13 04:23:07'),
(14, 'App\\Models\\Gift', 14, '734aa124-115a-4c04-960a-48ce458b49a8', 'icon', 'gift14', 'gift14.png', 'image/png', 'public', 'public', 341098, '[]', '[]', '[]', '[]', 1, '2025-07-13 04:23:07', '2025-07-13 04:23:07'),
(15, 'App\\Models\\Gift', 15, '6d71ef2d-1da8-4af2-ab19-dfda1e10c791', 'icon', 'gift15', 'gift15.png', 'image/png', 'public', 'public', 329931, '[]', '[]', '[]', '[]', 1, '2025-07-13 04:23:07', '2025-07-13 04:23:07'),
(16, 'App\\Models\\Gift', 16, '2e83ddbc-99ff-4412-991e-86a03eb929d7', 'icon', 'gift16', 'gift16.png', 'image/png', 'public', 'public', 394726, '[]', '[]', '[]', '[]', 1, '2025-07-13 04:23:07', '2025-07-13 04:23:07'),
(17, 'App\\Models\\Gift', 17, 'b6297b8a-8ab7-48e0-aadf-b72e62a2ae29', 'icon', 'gift17', 'gift17.png', 'image/png', 'public', 'public', 633432, '[]', '[]', '[]', '[]', 1, '2025-07-13 04:23:07', '2025-07-13 04:23:07'),
(18, 'App\\Models\\Gift', 18, 'c9d1a550-403e-4818-958c-8e0d19a565b8', 'icon', 'gift18', 'gift18.png', 'image/png', 'public', 'public', 361220, '[]', '[]', '[]', '[]', 1, '2025-07-13 04:23:08', '2025-07-13 04:23:08'),
(19, 'App\\Models\\Gift', 19, 'ffe08e5a-7e5b-4f15-9380-fb2c07e11ea5', 'icon', 'gift19', 'gift19.png', 'image/png', 'public', 'public', 408132, '[]', '[]', '[]', '[]', 1, '2025-07-13 04:23:08', '2025-07-13 04:23:08'),
(20, 'App\\Models\\Gift', 20, '7671bf55-5f81-4c68-8715-1cf8ea6ffefe', 'icon', 'gift20', 'gift20.png', 'image/png', 'public', 'public', 289104, '[]', '[]', '[]', '[]', 1, '2025-07-13 04:23:08', '2025-07-13 04:23:08'),
(21, 'App\\Models\\Gift', 21, 'c095156d-f235-4ce2-844d-07687aa5856b', 'icon', 'gift21', 'gift21.png', 'image/png', 'public', 'public', 293486, '[]', '[]', '[]', '[]', 1, '2025-07-13 04:23:08', '2025-07-13 04:23:08'),
(22, 'App\\Models\\Gift', 22, '16221509-0fd2-4c5b-98ca-66796c782efc', 'icon', 'gift22', 'gift22.png', 'image/png', 'public', 'public', 233971, '[]', '[]', '[]', '[]', 1, '2025-07-13 04:23:08', '2025-07-13 04:23:08'),
(23, 'App\\Models\\Gift', 23, '55b05082-3ccf-4ac4-aac1-5b8d071827d3', 'icon', 'gift23', 'gift23.png', 'image/png', 'public', 'public', 319979, '[]', '[]', '[]', '[]', 1, '2025-07-13 04:23:09', '2025-07-13 04:23:09'),
(24, 'App\\Models\\Gift', 24, '80602019-f3a3-4bd2-bde8-5cd011ddebcd', 'icon', 'gift24', 'gift24.png', 'image/png', 'public', 'public', 375468, '[]', '[]', '[]', '[]', 1, '2025-07-13 04:23:09', '2025-07-13 04:23:09'),
(25, 'App\\Models\\Gift', 25, '26c53f46-739b-49a8-bb0e-5704e8470c49', 'icon', 'gift25', 'gift25.png', 'image/png', 'public', 'public', 353292, '[]', '[]', '[]', '[]', 1, '2025-07-13 04:23:09', '2025-07-13 04:23:09'),
(26, 'App\\Models\\Gift', 26, 'ce7a027e-1a6f-4733-ae22-cbc8e5c5efef', 'icon', 'gift26', 'gift26.png', 'image/png', 'public', 'public', 476720, '[]', '[]', '[]', '[]', 1, '2025-07-13 04:23:09', '2025-07-13 04:23:09'),
(27, 'App\\Models\\Gift', 27, '39d0c797-fe09-49d5-ae59-351ba92b5631', 'icon', 'gift27', 'gift27.png', 'image/png', 'public', 'public', 312711, '[]', '[]', '[]', '[]', 1, '2025-07-13 04:23:10', '2025-07-13 04:23:10'),
(28, 'App\\Models\\Gift', 28, '6e28089c-294c-4b19-978e-9ddd19b0ac60', 'icon', 'gift28', 'gift28.png', 'image/png', 'public', 'public', 346756, '[]', '[]', '[]', '[]', 1, '2025-07-13 04:23:10', '2025-07-13 04:23:10'),
(29, 'App\\Models\\Gift', 29, 'a01630e2-50da-4b63-9ff6-821dc4d02779', 'icon', 'gift29', 'gift29.png', 'image/png', 'public', 'public', 136891, '[]', '[]', '[]', '[]', 1, '2025-07-13 04:23:10', '2025-07-13 04:23:10'),
(30, 'App\\Models\\Gift', 30, '883cdec0-e794-4c05-8345-854dba6a206d', 'icon', 'gift30', 'gift30.png', 'image/png', 'public', 'public', 334519, '[]', '[]', '[]', '[]', 1, '2025-07-13 04:23:10', '2025-07-13 04:23:10'),
(31, 'App\\Models\\Gift', 31, 'a4b4a0a1-9bf6-4137-b58c-a0b23778246b', 'icon', 'gift31', 'gift31.png', 'image/png', 'public', 'public', 294546, '[]', '[]', '[]', '[]', 1, '2025-07-13 04:23:10', '2025-07-13 04:23:10'),
(32, 'App\\Models\\Gift', 32, 'e7f27863-155c-45bc-98f1-4b4bda97a119', 'icon', 'gift32', 'gift32.png', 'image/png', 'public', 'public', 151645, '[]', '[]', '[]', '[]', 1, '2025-07-13 04:23:10', '2025-07-13 04:23:10'),
(33, 'App\\Models\\Gift', 33, '622af633-0864-4559-91d7-407560f7bc48', 'icon', 'gift33', 'gift33.png', 'image/png', 'public', 'public', 266462, '[]', '[]', '[]', '[]', 1, '2025-07-13 04:23:11', '2025-07-13 04:23:11'),
(34, 'App\\Models\\Gift', 34, 'e233fe24-e4b2-478d-b6c3-b569a8b8ba7b', 'icon', 'gift34', 'gift34.png', 'image/png', 'public', 'public', 385357, '[]', '[]', '[]', '[]', 1, '2025-07-13 04:23:11', '2025-07-13 04:23:11'),
(35, 'App\\Models\\Gift', 35, '29e20dd4-8e3e-45e6-a84c-b81ad687675c', 'icon', 'gift35', 'gift35.png', 'image/png', 'public', 'public', 264765, '[]', '[]', '[]', '[]', 1, '2025-07-13 04:23:11', '2025-07-13 04:23:11');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sender_id` bigint(20) UNSIGNED NOT NULL,
  `receiver_id` bigint(20) UNSIGNED NOT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2018_11_06_222923_create_transactions_table', 1),
(2, '2018_11_07_192923_create_transfers_table', 1),
(3, '2018_11_15_124230_create_wallets_table', 1),
(4, '2021_11_02_202021_update_wallets_uuid_table', 1),
(5, '2023_12_30_113122_extra_columns_removed', 1),
(6, '2023_12_30_204610_soft_delete', 1),
(7, '2024_01_24_185401_add_extra_column_in_transfer', 1),
(9, '2025_07_05_162353_create_media_table', 2),
(10, '2025_07_05_182425_create_gifts_table', 3),
(11, '2025_07_05_184111_create_user_gifts_table', 3),
(13, '2025_07_11_153238_add_withdraw_type_to_transactions_table', 4),
(14, '2025_07_11_162257_add_unique_user_gift_constraint_to_user_gifts_table', 5),
(15, '2025_07_12_072507_add_msg_column_to_user_gifts_table', 6),
(16, '2025_07_16_172702_add_price_column_to_user_gifts_table', 7),
(17, '2025_07_18_140933_add_is_visible_column_to_user_gifts_table', 8);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `notifier_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `notifiable_type` varchar(255) NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `notifier_id`, `type`, `notifiable_type`, `notifiable_id`, `is_read`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 'new_follow', 'App\\Models\\User', 3, 0, '2025-07-04 10:31:44', '2025-07-04 10:31:44'),
(2, 1, 3, 'new_follow', 'App\\Models\\User', 1, 0, '2025-07-12 08:28:57', '2025-07-12 08:28:57'),
(3, 3, 1, 'new_follow', 'App\\Models\\User', 3, 0, '2025-07-18 07:53:46', '2025-07-18 07:53:46');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `polls`
--

CREATE TABLE `polls` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `expires_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `option1_text` varchar(255) NOT NULL,
  `option1_votes` int(11) NOT NULL DEFAULT 0,
  `option2_text` varchar(255) NOT NULL,
  `option2_votes` int(11) NOT NULL DEFAULT 0,
  `option3_text` varchar(255) DEFAULT NULL,
  `option3_votes` int(11) NOT NULL DEFAULT 0,
  `option4_text` varchar(255) DEFAULT NULL,
  `option4_votes` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `poll_votes`
--

CREATE TABLE `poll_votes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `poll_id` bigint(20) UNSIGNED NOT NULL,
  `option_selected` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `text` text DEFAULT NULL,
  `image` text DEFAULT NULL,
  `slug_id` varchar(255) NOT NULL,
  `post_type` enum('normal','poll') NOT NULL DEFAULT 'normal',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `text`, `image`, `slug_id`, `post_type`, `created_at`, `updated_at`) VALUES
(1, 1, 'test', '[]', 'b4c79b9c-97a6-42e4-aec1-fc9881ee5d86', 'normal', '2025-07-18 08:36:14', '2025-07-18 08:36:14'),
(2, 1, 'test', '[]', 'd873579b-d2a1-4c31-9900-d9a8d56953db', 'normal', '2025-07-18 08:36:21', '2025-07-18 08:36:21'),
(3, 1, 'test', '[]', 'c79db7eb-d419-4147-abec-6c7d84754cbc', 'normal', '2025-07-18 08:36:29', '2025-07-18 08:36:29'),
(4, 1, 'test', '[\"posts_images\\/1752838611_post_687a31d358f4b0.12886354.png\"]', 'd9607591-9e83-4dc6-ab31-2267b563590c', 'normal', '2025-07-18 08:36:51', '2025-07-18 08:36:51');

-- --------------------------------------------------------

--
-- Table structure for table `post_likes`
--

CREATE TABLE `post_likes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `replies`
--

CREATE TABLE `replies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `reply_text` text DEFAULT NULL,
  `reply_image` varchar(255) DEFAULT NULL,
  `slug_id` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='References the parent reply for nested replies';

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `payable_type` varchar(255) NOT NULL,
  `payable_id` bigint(20) UNSIGNED NOT NULL,
  `wallet_id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('deposit','withdraw') NOT NULL,
  `withdraw_type` enum('transfer','send_gift') NOT NULL DEFAULT 'transfer',
  `amount` decimal(64,0) NOT NULL,
  `confirmed` tinyint(1) NOT NULL,
  `meta` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`meta`)),
  `uuid` char(36) NOT NULL,
  `capture_id` varchar(255) DEFAULT NULL,
  `payment_method` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT 'COMPLETED',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `payable_type`, `payable_id`, `wallet_id`, `type`, `withdraw_type`, `amount`, `confirmed`, `meta`, `uuid`, `capture_id`, `payment_method`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'App\\Models\\User', 1, 1, 'deposit', 'transfer', 2000, 1, '[]', '019802ac-1a37-71e8-a3e8-509c63a477c5', '32131026P2582773Y', 'paypal', 'COMPLETED', '2025-07-13 04:24:50', '2025-07-13 04:24:50', NULL),
(2, 'App\\Models\\User', 1, 1, 'withdraw', 'send_gift', -5, 1, '{\"reason_en\":\"Send a gift to <a class=\'text-orange-color text-reset text-decoration-none\' href=\'http:\\/\\/localhost:8000\\/rashed\'>Rashed<\\/a>\",\"reason_ar\":\"\\u0625\\u0631\\u0633\\u0627\\u0644 \\u0647\\u062f\\u064a\\u0629 \\u0625\\u0644\\u0649 <a class=\'text-orange-color text-reset text-decoration-none\' href=\'http:\\/\\/localhost:8000\\/rashed\'>Rashed<\\/a>\"}', '0198048b-3200-71ea-9165-9a714f2f75ee', NULL, NULL, 'COMPLETED', '2025-07-13 13:08:07', '2025-07-13 13:08:08', NULL),
(3, 'App\\Models\\User', 1, 1, 'withdraw', 'send_gift', -10, 1, '{\"reason_en\":\"Send a gift to <a class=\'text-orange-color text-reset text-decoration-none\' href=\'http:\\/\\/localhost:8000\\/rashed\'>Rashed<\\/a>\",\"reason_ar\":\"\\u0625\\u0631\\u0633\\u0627\\u0644 \\u0647\\u062f\\u064a\\u0629 \\u0625\\u0644\\u0649 <a class=\'text-orange-color text-reset text-decoration-none\' href=\'http:\\/\\/localhost:8000\\/rashed\'>Rashed<\\/a>\"}', '0198048b-3364-71b5-b3d1-5cab5df7423b', NULL, NULL, 'COMPLETED', '2025-07-13 13:08:08', '2025-07-13 13:08:08', NULL),
(6, 'App\\Models\\User', 1, 1, 'withdraw', 'send_gift', -10, 1, '{\"reason_en\":\"Send a gift to <a class=\'text-orange-color text-reset text-decoration-none\' href=\'http:\\/\\/localhost:8000\\/rashed\'>Rashed<\\/a>\",\"reason_ar\":\"\\u0625\\u0631\\u0633\\u0627\\u0644 \\u0647\\u062f\\u064a\\u0629 \\u0625\\u0644\\u0649 <a class=\'text-orange-color text-reset text-decoration-none\' href=\'http:\\/\\/localhost:8000\\/rashed\'>Rashed<\\/a>\"}', '01981449-242e-70d5-9e3a-08d8b76b525d', NULL, NULL, 'COMPLETED', '2025-07-16 14:29:54', '2025-07-16 14:29:54', NULL),
(7, 'App\\Models\\User', 1, 1, 'withdraw', 'send_gift', -5, 1, '{\"reason_en\":\"Send a gift to <a class=\'text-orange-color text-reset text-decoration-none\' href=\'http:\\/\\/localhost:8000\\/rashed\'>Rashed<\\/a>\",\"reason_ar\":\"\\u0625\\u0631\\u0633\\u0627\\u0644 \\u0647\\u062f\\u064a\\u0629 \\u0625\\u0644\\u0649 <a class=\'text-orange-color text-reset text-decoration-none\' href=\'http:\\/\\/localhost:8000\\/rashed\'>Rashed<\\/a>\"}', '01981449-2444-7284-ba87-fa865dea06b4', NULL, NULL, 'COMPLETED', '2025-07-16 14:29:54', '2025-07-16 14:29:54', NULL),
(8, 'App\\Models\\User', 1, 1, 'withdraw', 'send_gift', -8, 1, '{\"reason_en\":\"Send a gift to <a class=\'text-orange-color text-reset text-decoration-none\' href=\'http:\\/\\/localhost:8000\\/osama\'>Osama Mohammad<\\/a>\",\"reason_ar\":\"\\u0625\\u0631\\u0633\\u0627\\u0644 \\u0647\\u062f\\u064a\\u0629 \\u0625\\u0644\\u0649 <a class=\'text-orange-color text-reset text-decoration-none\' href=\'http:\\/\\/localhost:8000\\/osama\'>Osama Mohammad<\\/a>\"}', '01981466-6701-70db-98ee-256eb808e14e', NULL, NULL, 'COMPLETED', '2025-07-16 15:01:52', '2025-07-16 15:01:52', NULL),
(9, 'App\\Models\\User', 1, 1, 'withdraw', 'send_gift', -2, 1, '{\"reason_en\":\"Send a gift to <a class=\'text-orange-color text-reset text-decoration-none\' href=\'http:\\/\\/localhost:8000\\/rashed\'>Rashed<\\/a>\",\"reason_ar\":\"\\u0625\\u0631\\u0633\\u0627\\u0644 \\u0647\\u062f\\u064a\\u0629 \\u0625\\u0644\\u0649 <a class=\'text-orange-color text-reset text-decoration-none\' href=\'http:\\/\\/localhost:8000\\/rashed\'>Rashed<\\/a>\"}', '01981eda-7e46-73bf-8ac3-b108d81103cb', NULL, NULL, 'COMPLETED', '2025-07-18 15:44:52', '2025-07-18 15:44:52', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transfers`
--

CREATE TABLE `transfers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `from_id` bigint(20) UNSIGNED NOT NULL,
  `to_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('exchange','transfer','paid','refund','gift') NOT NULL DEFAULT 'transfer',
  `status_last` enum('exchange','transfer','paid','refund','gift') DEFAULT NULL,
  `deposit_id` bigint(20) UNSIGNED NOT NULL,
  `withdraw_id` bigint(20) UNSIGNED NOT NULL,
  `discount` decimal(64,0) NOT NULL DEFAULT 0,
  `fee` decimal(64,0) NOT NULL DEFAULT 0,
  `extra` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`extra`)),
  `uuid` char(36) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `role` enum('admin','user','supervisor') NOT NULL DEFAULT 'user',
  `is_ban` enum('yes','no') NOT NULL DEFAULT 'no',
  `account_privacy` enum('public','private') NOT NULL DEFAULT 'public',
  `terms_accepted` tinyint(1) NOT NULL DEFAULT 0,
  `last_activity` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `is_scheduled_for_deletion` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `remember_token`, `role`, `is_ban`, `account_privacy`, `terms_accepted`, `last_activity`, `created_at`, `updated_at`, `deleted_at`, `is_scheduled_for_deletion`) VALUES
(1, 'Osama Mohammad', 'osama', 'osama@gmail.com', NULL, '$2y$12$g4vqym4sQztws0iY8CZ0oeax2r9HrNk3phI60pzUr2GCUdR3nEW3u', NULL, 'user', 'no', 'private', 1, '2025-07-18 15:44:51', '2025-02-05 21:05:55', '2025-07-18 15:44:51', NULL, 0),
(2, 'tadween', 'admin', 'admin@gmail.com', NULL, '$2y$12$k9C6cfjNUCUvBmGEaf8StO8Cp8Np5b9j055CO/RuRtwY5.Mqur8r.', 'XpXxJ9fXQIAvrcXyitmOcRkA8vNhpGmfHR1K95s60fpQp4y8SnxGa58e4WUT', 'admin', 'no', 'public', 1, '2025-06-09 00:51:53', '2025-02-07 01:33:17', '2025-06-09 00:51:53', NULL, 0),
(3, 'Rashed', 'rashed', 'rashed@gmail.com', NULL, '$2y$12$S.Iy95OIfOxPVjBVhRB1aOjaAUXqqxymJJNyW1RSamVq7QhWvWI0e', 'LJoa0R5Bb7QPxtLaksUA38swXezrvD8xzlqv1UCcZox3tKYCanVzfmmB15RB', 'user', 'no', 'private', 1, '2025-07-18 15:44:57', '2025-07-01 16:35:06', '2025-07-18 15:44:57', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_gifts`
--

CREATE TABLE `user_gifts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sender_id` bigint(20) UNSIGNED NOT NULL,
  `receiver_id` bigint(20) UNSIGNED NOT NULL,
  `gift_id` bigint(20) UNSIGNED NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `visibility` enum('public','private','anonymous') NOT NULL DEFAULT 'public',
  `msg` varchar(255) DEFAULT NULL,
  `is_hidden` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_gifts`
--

INSERT INTO `user_gifts` (`id`, `sender_id`, `receiver_id`, `gift_id`, `price`, `visibility`, `msg`, `is_hidden`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 3, 4, 5.00, 'public', NULL, 0, '2025-07-13 13:08:08', '2025-07-18 15:44:18', NULL),
(2, 1, 3, 3, 6.00, 'public', NULL, 0, '2025-07-13 13:08:08', '2025-07-18 13:15:09', NULL),
(5, 1, 3, 3, 10.00, 'private', 'aaaa', 0, '2025-07-16 14:29:54', '2025-07-18 11:58:18', '2025-07-18 11:58:18'),
(6, 1, 3, 4, 5.00, 'anonymous', 'bbbb', 0, '2025-07-16 14:29:54', '2025-07-18 15:43:46', '2025-07-18 15:43:46'),
(7, 1, 1, 2, 8.00, 'public', 'cup', 0, '2025-07-16 15:01:52', '2025-07-16 15:01:52', NULL),
(8, 1, 3, 7, 2.00, 'public', 'الله يرزقك', 0, '2025-07-18 15:44:52', '2025-07-18 15:44:52', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_profiles`
--

CREATE TABLE `user_profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `background_image` varchar(255) DEFAULT NULL,
  `cover_image` varchar(255) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `gender` enum('male','female') DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_profiles`
--

INSERT INTO `user_profiles` (`id`, `user_id`, `date_of_birth`, `background_image`, `cover_image`, `bio`, `gender`, `country`, `city`, `created_at`, `updated_at`) VALUES
(1, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-01 16:35:06', '2025-07-01 16:35:06');

-- --------------------------------------------------------

--
-- Table structure for table `wallets`
--

CREATE TABLE `wallets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `holder_type` varchar(255) NOT NULL,
  `holder_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `uuid` char(36) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `meta` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`meta`)),
  `balance` decimal(64,0) NOT NULL DEFAULT 0,
  `decimal_places` smallint(5) UNSIGNED NOT NULL DEFAULT 2,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wallets`
--

INSERT INTO `wallets` (`id`, `holder_type`, `holder_id`, `name`, `slug`, `uuid`, `description`, `meta`, `balance`, `decimal_places`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'App\\Models\\User', 1, 'Default Wallet', 'default', '019802ac-18d4-701d-b103-c9559dfc4fea', NULL, '[]', 1960, 2, '2025-07-13 04:24:49', '2025-07-18 15:44:52', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blocked_users`
--
ALTER TABLE `blocked_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `blocked_users_user_id_blocked_user_id_unique` (`user_id`,`blocked_user_id`),
  ADD KEY `blocked_users_blocked_user_id_foreign` (`blocked_user_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `follows`
--
ALTER TABLE `follows`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `follows_unique_follower_following` (`follower_id`,`following_id`),
  ADD UNIQUE KEY `unique_follower_following` (`follower_id`,`following_id`),
  ADD KEY `follows_follower_id_foreign` (`follower_id`),
  ADD KEY `follows_following_id_foreign` (`following_id`),
  ADD KEY `idx_follower_id` (`follower_id`),
  ADD KEY `idx_following_id` (`following_id`);

--
-- Indexes for table `gifts`
--
ALTER TABLE `gifts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `media_uuid_unique` (`uuid`),
  ADD KEY `media_model_type_model_id_index` (`model_type`,`model_id`),
  ADD KEY `media_order_column_index` (`order_column`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_sender_id_foreign` (`sender_id`),
  ADD KEY `messages_receiver_id_foreign` (`receiver_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`),
  ADD KEY `notifications_user_id_foreign` (`user_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `polls`
--
ALTER TABLE `polls`
  ADD PRIMARY KEY (`id`),
  ADD KEY `polls_post_id_foreign` (`post_id`);

--
-- Indexes for table `poll_votes`
--
ALTER TABLE `poll_votes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `poll_votes_user_id_poll_id_unique` (`user_id`,`poll_id`),
  ADD KEY `poll_votes_poll_id_foreign` (`poll_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `posts_slug_id_unique` (`slug_id`),
  ADD KEY `posts_user_id_foreign` (`user_id`);

--
-- Indexes for table `post_likes`
--
ALTER TABLE `post_likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_likes_user_id_foreign` (`user_id`),
  ADD KEY `post_likes_post_id_foreign` (`post_id`);

--
-- Indexes for table `replies`
--
ALTER TABLE `replies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `replies_slug_id_unique` (`slug_id`),
  ADD KEY `replies_user_id_foreign` (`user_id`),
  ADD KEY `replies_post_id_foreign` (`post_id`),
  ADD KEY `replies_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `transactions_uuid_unique` (`uuid`),
  ADD KEY `transactions_payable_type_payable_id_index` (`payable_type`,`payable_id`),
  ADD KEY `payable_type_payable_id_ind` (`payable_type`,`payable_id`),
  ADD KEY `payable_type_ind` (`payable_type`,`payable_id`,`type`),
  ADD KEY `payable_confirmed_ind` (`payable_type`,`payable_id`,`confirmed`),
  ADD KEY `payable_type_confirmed_ind` (`payable_type`,`payable_id`,`type`,`confirmed`),
  ADD KEY `transactions_type_index` (`type`),
  ADD KEY `transactions_wallet_id_foreign` (`wallet_id`),
  ADD KEY `transactions_capture_id_index` (`capture_id`),
  ADD KEY `transactions_payment_method_index` (`payment_method`),
  ADD KEY `transactions_status_index` (`status`);

--
-- Indexes for table `transfers`
--
ALTER TABLE `transfers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `transfers_uuid_unique` (`uuid`),
  ADD KEY `transfers_deposit_id_foreign` (`deposit_id`),
  ADD KEY `transfers_withdraw_id_foreign` (`withdraw_id`),
  ADD KEY `transfers_from_id_index` (`from_id`),
  ADD KEY `transfers_to_id_index` (`to_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_gifts`
--
ALTER TABLE `user_gifts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_gifts_receiver_id_foreign` (`receiver_id`),
  ADD KEY `user_gifts_gift_id_foreign` (`gift_id`);

--
-- Indexes for table `user_profiles`
--
ALTER TABLE `user_profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_profiles_user_id_foreign` (`user_id`);

--
-- Indexes for table `wallets`
--
ALTER TABLE `wallets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `wallets_holder_type_holder_id_slug_unique` (`holder_type`,`holder_id`,`slug`),
  ADD UNIQUE KEY `wallets_uuid_unique` (`uuid`),
  ADD KEY `wallets_holder_type_holder_id_index` (`holder_type`,`holder_id`),
  ADD KEY `wallets_slug_index` (`slug`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blocked_users`
--
ALTER TABLE `blocked_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `follows`
--
ALTER TABLE `follows`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `gifts`
--
ALTER TABLE `gifts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `polls`
--
ALTER TABLE `polls`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `poll_votes`
--
ALTER TABLE `poll_votes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `post_likes`
--
ALTER TABLE `post_likes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `replies`
--
ALTER TABLE `replies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `transfers`
--
ALTER TABLE `transfers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_gifts`
--
ALTER TABLE `user_gifts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_profiles`
--
ALTER TABLE `user_profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `wallets`
--
ALTER TABLE `wallets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blocked_users`
--
ALTER TABLE `blocked_users`
  ADD CONSTRAINT `blocked_users_blocked_user_id_foreign` FOREIGN KEY (`blocked_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `blocked_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `follows`
--
ALTER TABLE `follows`
  ADD CONSTRAINT `follows_follower_id_foreign` FOREIGN KEY (`follower_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `follows_following_id_foreign` FOREIGN KEY (`following_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_receiver_id_foreign` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `messages_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `polls`
--
ALTER TABLE `polls`
  ADD CONSTRAINT `polls_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `poll_votes`
--
ALTER TABLE `poll_votes`
  ADD CONSTRAINT `poll_votes_poll_id_foreign` FOREIGN KEY (`poll_id`) REFERENCES `polls` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `poll_votes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `post_likes`
--
ALTER TABLE `post_likes`
  ADD CONSTRAINT `post_likes_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `post_likes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `replies`
--
ALTER TABLE `replies`
  ADD CONSTRAINT `replies_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `replies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `replies_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `replies_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_wallet_id_foreign` FOREIGN KEY (`wallet_id`) REFERENCES `wallets` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transfers`
--
ALTER TABLE `transfers`
  ADD CONSTRAINT `transfers_deposit_id_foreign` FOREIGN KEY (`deposit_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transfers_withdraw_id_foreign` FOREIGN KEY (`withdraw_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_gifts`
--
ALTER TABLE `user_gifts`
  ADD CONSTRAINT `user_gifts_gift_id_foreign` FOREIGN KEY (`gift_id`) REFERENCES `gifts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_gifts_receiver_id_foreign` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_gifts_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_profiles`
--
ALTER TABLE `user_profiles`
  ADD CONSTRAINT `user_profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
