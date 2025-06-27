-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 27, 2025 at 10:05 AM
-- Server version: 10.11.10-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u903879112_tadween`
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

--
-- Dumping data for table `blocked_users`
--

INSERT INTO `blocked_users` (`id`, `user_id`, `blocked_user_id`, `created_at`, `updated_at`) VALUES
(21, 28, 4, '2025-04-06 09:05:52', '2025-04-06 09:05:52');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('posts_page_1', 'O:42:\"Illuminate\\Pagination\\LengthAwarePaginator\":11:{s:8:\"\0*\0items\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:10:{i:0;O:15:\"App\\Models\\Post\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"posts\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:57;s:7:\"user_id\";i:6;s:4:\"text\";s:2:\"hi\";s:5:\"image\";s:2:\"[]\";s:7:\"slug_id\";s:36:\"55ca0971-6e7c-45b1-a905-1b62209cd1bd\";s:9:\"post_type\";s:6:\"normal\";s:10:\"created_at\";s:19:\"2025-02-08 09:51:18\";s:10:\"updated_at\";s:19:\"2025-02-08 09:51:18\";s:13:\"replies_count\";i:0;s:16:\"post_likes_count\";i:0;}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:57;s:7:\"user_id\";i:6;s:4:\"text\";s:2:\"hi\";s:5:\"image\";s:2:\"[]\";s:7:\"slug_id\";s:36:\"55ca0971-6e7c-45b1-a905-1b62209cd1bd\";s:9:\"post_type\";s:6:\"normal\";s:10:\"created_at\";s:19:\"2025-02-08 09:51:18\";s:10:\"updated_at\";s:19:\"2025-02-08 09:51:18\";s:13:\"replies_count\";i:0;s:16:\"post_likes_count\";i:0;}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:3:{s:4:\"user\";O:15:\"App\\Models\\User\":32:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"users\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:14:{s:2:\"id\";i:6;s:4:\"name\";s:6:\"Hussam\";s:8:\"username\";s:6:\"hussam\";s:5:\"email\";s:12:\"me@hussam.pw\";s:17:\"email_verified_at\";N;s:8:\"password\";s:60:\"$2y$12$./OypoGSu/oifB7osrzD9OBr6rcYxPQVdK3whdqYVIG84LpjOXPv6\";s:14:\"remember_token\";s:60:\"JWXST4M8TUvTasYQYAm6auy53MpH0ur4VNQ9Rr6H2aeLuHFgWUlF0rkTmnaa\";s:4:\"role\";s:4:\"user\";s:6:\"is_ban\";s:2:\"no\";s:15:\"account_privacy\";s:6:\"public\";s:14:\"terms_accepted\";i:1;s:13:\"last_activity\";s:19:\"2025-02-08 09:52:00\";s:10:\"created_at\";s:19:\"2025-02-08 09:48:53\";s:10:\"updated_at\";s:19:\"2025-02-08 09:52:00\";}s:11:\"\0*\0original\";a:14:{s:2:\"id\";i:6;s:4:\"name\";s:6:\"Hussam\";s:8:\"username\";s:6:\"hussam\";s:5:\"email\";s:12:\"me@hussam.pw\";s:17:\"email_verified_at\";N;s:8:\"password\";s:60:\"$2y$12$./OypoGSu/oifB7osrzD9OBr6rcYxPQVdK3whdqYVIG84LpjOXPv6\";s:14:\"remember_token\";s:60:\"JWXST4M8TUvTasYQYAm6auy53MpH0ur4VNQ9Rr6H2aeLuHFgWUlF0rkTmnaa\";s:4:\"role\";s:4:\"user\";s:6:\"is_ban\";s:2:\"no\";s:15:\"account_privacy\";s:6:\"public\";s:14:\"terms_accepted\";i:1;s:13:\"last_activity\";s:19:\"2025-02-08 09:52:00\";s:10:\"created_at\";s:19:\"2025-02-08 09:48:53\";s:10:\"updated_at\";s:19:\"2025-02-08 09:52:00\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:2:{s:17:\"email_verified_at\";s:8:\"datetime\";s:8:\"password\";s:6:\"hashed\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:2:{i:0;s:8:\"password\";i:1;s:14:\"remember_token\";}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:9:{i:0;s:4:\"name\";i:1;s:8:\"username\";i:2;s:4:\"role\";i:3;s:5:\"email\";i:4;s:8:\"password\";i:5;s:14:\"terms_accepted\";i:6;s:14:\"remember_token\";i:7;s:15:\"account_privacy\";i:8;s:13:\"last_activity\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:19:\"\0*\0authPasswordName\";s:8:\"password\";s:20:\"\0*\0rememberTokenName\";s:14:\"remember_token\";}s:12:\"userPostLike\";N;s:4:\"poll\";N;}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:5:{i:0;s:7:\"user_id\";i:1;s:4:\"text\";i:2;s:5:\"image\";i:3;s:7:\"slug_id\";i:4;s:9:\"post_type\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:1;O:15:\"App\\Models\\Post\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"posts\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:56;s:7:\"user_id\";i:6;s:4:\"text\";s:25:\"اهلا بكم #مسقط\";s:5:\"image\";s:2:\"[]\";s:7:\"slug_id\";s:36:\"d43d7f46-b8e4-4bce-bbed-6eea58d46ceb\";s:9:\"post_type\";s:6:\"normal\";s:10:\"created_at\";s:19:\"2025-02-08 09:49:36\";s:10:\"updated_at\";s:19:\"2025-02-08 09:49:36\";s:13:\"replies_count\";i:0;s:16:\"post_likes_count\";i:0;}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:56;s:7:\"user_id\";i:6;s:4:\"text\";s:25:\"اهلا بكم #مسقط\";s:5:\"image\";s:2:\"[]\";s:7:\"slug_id\";s:36:\"d43d7f46-b8e4-4bce-bbed-6eea58d46ceb\";s:9:\"post_type\";s:6:\"normal\";s:10:\"created_at\";s:19:\"2025-02-08 09:49:36\";s:10:\"updated_at\";s:19:\"2025-02-08 09:49:36\";s:13:\"replies_count\";i:0;s:16:\"post_likes_count\";i:0;}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:3:{s:4:\"user\";r:48;s:12:\"userPostLike\";N;s:4:\"poll\";N;}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:5:{i:0;s:7:\"user_id\";i:1;s:4:\"text\";i:2;s:5:\"image\";i:3;s:7:\"slug_id\";i:4;s:9:\"post_type\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:2;O:15:\"App\\Models\\Post\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"posts\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:55;s:7:\"user_id\";i:4;s:4:\"text\";s:8:\"نبدا\";s:5:\"image\";s:2:\"[]\";s:7:\"slug_id\";s:36:\"69994587-cd4f-46c2-99eb-65a2a0476cce\";s:9:\"post_type\";s:6:\"normal\";s:10:\"created_at\";s:19:\"2025-02-08 01:37:56\";s:10:\"updated_at\";s:19:\"2025-02-08 01:37:56\";s:13:\"replies_count\";i:2;s:16:\"post_likes_count\";i:2;}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:55;s:7:\"user_id\";i:4;s:4:\"text\";s:8:\"نبدا\";s:5:\"image\";s:2:\"[]\";s:7:\"slug_id\";s:36:\"69994587-cd4f-46c2-99eb-65a2a0476cce\";s:9:\"post_type\";s:6:\"normal\";s:10:\"created_at\";s:19:\"2025-02-08 01:37:56\";s:10:\"updated_at\";s:19:\"2025-02-08 01:37:56\";s:13:\"replies_count\";i:2;s:16:\"post_likes_count\";i:2;}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:3:{s:4:\"user\";O:15:\"App\\Models\\User\":32:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"users\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:14:{s:2:\"id\";i:4;s:4:\"name\";s:8:\"راشد\";s:8:\"username\";s:6:\"rashed\";s:5:\"email\";s:21:\"rashedlb606@gmail.com\";s:17:\"email_verified_at\";N;s:8:\"password\";s:60:\"$2y$12$uUFP23bPz6US2miPR7wle.NxXKMmfsu/8DuS2v5NXGrvzrE8XOaoa\";s:14:\"remember_token\";s:60:\"c9p81MyvUkNH4uNoTY4z7kRfJLvj3jwSLcnt9r2rdcj28mG0eC6mMckvbY8r\";s:4:\"role\";s:4:\"user\";s:6:\"is_ban\";s:2:\"no\";s:15:\"account_privacy\";s:6:\"public\";s:14:\"terms_accepted\";i:1;s:13:\"last_activity\";s:19:\"2025-02-08 05:51:40\";s:10:\"created_at\";s:19:\"2025-02-07 22:53:43\";s:10:\"updated_at\";s:19:\"2025-02-08 05:51:40\";}s:11:\"\0*\0original\";a:14:{s:2:\"id\";i:4;s:4:\"name\";s:8:\"راشد\";s:8:\"username\";s:6:\"rashed\";s:5:\"email\";s:21:\"rashedlb606@gmail.com\";s:17:\"email_verified_at\";N;s:8:\"password\";s:60:\"$2y$12$uUFP23bPz6US2miPR7wle.NxXKMmfsu/8DuS2v5NXGrvzrE8XOaoa\";s:14:\"remember_token\";s:60:\"c9p81MyvUkNH4uNoTY4z7kRfJLvj3jwSLcnt9r2rdcj28mG0eC6mMckvbY8r\";s:4:\"role\";s:4:\"user\";s:6:\"is_ban\";s:2:\"no\";s:15:\"account_privacy\";s:6:\"public\";s:14:\"terms_accepted\";i:1;s:13:\"last_activity\";s:19:\"2025-02-08 05:51:40\";s:10:\"created_at\";s:19:\"2025-02-07 22:53:43\";s:10:\"updated_at\";s:19:\"2025-02-08 05:51:40\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:2:{s:17:\"email_verified_at\";s:8:\"datetime\";s:8:\"password\";s:6:\"hashed\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:2:{i:0;s:8:\"password\";i:1;s:14:\"remember_token\";}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:9:{i:0;s:4:\"name\";i:1;s:8:\"username\";i:2;s:4:\"role\";i:3;s:5:\"email\";i:4;s:8:\"password\";i:5;s:14:\"terms_accepted\";i:6;s:14:\"remember_token\";i:7;s:15:\"account_privacy\";i:8;s:13:\"last_activity\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:19:\"\0*\0authPasswordName\";s:8:\"password\";s:20:\"\0*\0rememberTokenName\";s:14:\"remember_token\";}s:12:\"userPostLike\";N;s:4:\"poll\";N;}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:5:{i:0;s:7:\"user_id\";i:1;s:4:\"text\";i:2;s:5:\"image\";i:3;s:7:\"slug_id\";i:4;s:9:\"post_type\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:3;O:15:\"App\\Models\\Post\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"posts\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:54;s:7:\"user_id\";i:4;s:4:\"text\";s:19:\"حسبنا الله\";s:5:\"image\";s:2:\"[]\";s:7:\"slug_id\";s:36:\"843d6b02-313b-4333-99b5-a3403d9448c4\";s:9:\"post_type\";s:6:\"normal\";s:10:\"created_at\";s:19:\"2025-02-08 01:37:49\";s:10:\"updated_at\";s:19:\"2025-02-08 01:37:49\";s:13:\"replies_count\";i:0;s:16:\"post_likes_count\";i:0;}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:54;s:7:\"user_id\";i:4;s:4:\"text\";s:19:\"حسبنا الله\";s:5:\"image\";s:2:\"[]\";s:7:\"slug_id\";s:36:\"843d6b02-313b-4333-99b5-a3403d9448c4\";s:9:\"post_type\";s:6:\"normal\";s:10:\"created_at\";s:19:\"2025-02-08 01:37:49\";s:10:\"updated_at\";s:19:\"2025-02-08 01:37:49\";s:13:\"replies_count\";i:0;s:16:\"post_likes_count\";i:0;}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:3:{s:4:\"user\";r:242;s:12:\"userPostLike\";N;s:4:\"poll\";N;}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:5:{i:0;s:7:\"user_id\";i:1;s:4:\"text\";i:2;s:5:\"image\";i:3;s:7:\"slug_id\";i:4;s:9:\"post_type\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:4;O:15:\"App\\Models\\Post\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"posts\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:53;s:7:\"user_id\";i:4;s:4:\"text\";s:20:\"ان شاء الله\";s:5:\"image\";s:2:\"[]\";s:7:\"slug_id\";s:36:\"a0271b88-7bf3-4426-a2b9-ce804f874ef7\";s:9:\"post_type\";s:6:\"normal\";s:10:\"created_at\";s:19:\"2025-02-08 01:37:42\";s:10:\"updated_at\";s:19:\"2025-02-08 01:37:42\";s:13:\"replies_count\";i:0;s:16:\"post_likes_count\";i:0;}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:53;s:7:\"user_id\";i:4;s:4:\"text\";s:20:\"ان شاء الله\";s:5:\"image\";s:2:\"[]\";s:7:\"slug_id\";s:36:\"a0271b88-7bf3-4426-a2b9-ce804f874ef7\";s:9:\"post_type\";s:6:\"normal\";s:10:\"created_at\";s:19:\"2025-02-08 01:37:42\";s:10:\"updated_at\";s:19:\"2025-02-08 01:37:42\";s:13:\"replies_count\";i:0;s:16:\"post_likes_count\";i:0;}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:3:{s:4:\"user\";r:242;s:12:\"userPostLike\";N;s:4:\"poll\";N;}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:5:{i:0;s:7:\"user_id\";i:1;s:4:\"text\";i:2;s:5:\"image\";i:3;s:7:\"slug_id\";i:4;s:9:\"post_type\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:5;O:15:\"App\\Models\\Post\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"posts\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:52;s:7:\"user_id\";i:4;s:4:\"text\";s:14:\"اعلومكم\";s:5:\"image\";s:2:\"[]\";s:7:\"slug_id\";s:36:\"c3385a7b-cdfb-47aa-ae74-2c2d2eb85f7c\";s:9:\"post_type\";s:6:\"normal\";s:10:\"created_at\";s:19:\"2025-02-08 01:37:35\";s:10:\"updated_at\";s:19:\"2025-02-08 01:37:35\";s:13:\"replies_count\";i:0;s:16:\"post_likes_count\";i:0;}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:52;s:7:\"user_id\";i:4;s:4:\"text\";s:14:\"اعلومكم\";s:5:\"image\";s:2:\"[]\";s:7:\"slug_id\";s:36:\"c3385a7b-cdfb-47aa-ae74-2c2d2eb85f7c\";s:9:\"post_type\";s:6:\"normal\";s:10:\"created_at\";s:19:\"2025-02-08 01:37:35\";s:10:\"updated_at\";s:19:\"2025-02-08 01:37:35\";s:13:\"replies_count\";i:0;s:16:\"post_likes_count\";i:0;}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:3:{s:4:\"user\";r:242;s:12:\"userPostLike\";N;s:4:\"poll\";N;}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:5:{i:0;s:7:\"user_id\";i:1;s:4:\"text\";i:2;s:5:\"image\";i:3;s:7:\"slug_id\";i:4;s:9:\"post_type\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:6;O:15:\"App\\Models\\Post\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"posts\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:51;s:7:\"user_id\";i:4;s:4:\"text\";s:14:\"اخباركم\";s:5:\"image\";s:2:\"[]\";s:7:\"slug_id\";s:36:\"fa6c9720-c4c3-43ec-b088-99ed981c63bb\";s:9:\"post_type\";s:6:\"normal\";s:10:\"created_at\";s:19:\"2025-02-08 01:37:31\";s:10:\"updated_at\";s:19:\"2025-02-08 01:37:31\";s:13:\"replies_count\";i:0;s:16:\"post_likes_count\";i:0;}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:51;s:7:\"user_id\";i:4;s:4:\"text\";s:14:\"اخباركم\";s:5:\"image\";s:2:\"[]\";s:7:\"slug_id\";s:36:\"fa6c9720-c4c3-43ec-b088-99ed981c63bb\";s:9:\"post_type\";s:6:\"normal\";s:10:\"created_at\";s:19:\"2025-02-08 01:37:31\";s:10:\"updated_at\";s:19:\"2025-02-08 01:37:31\";s:13:\"replies_count\";i:0;s:16:\"post_likes_count\";i:0;}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:3:{s:4:\"user\";r:242;s:12:\"userPostLike\";N;s:4:\"poll\";N;}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:5:{i:0;s:7:\"user_id\";i:1;s:4:\"text\";i:2;s:5:\"image\";i:3;s:7:\"slug_id\";i:4;s:9:\"post_type\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:7;O:15:\"App\\Models\\Post\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"posts\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:50;s:7:\"user_id\";i:4;s:4:\"text\";s:17:\"كيف الحال\";s:5:\"image\";s:2:\"[]\";s:7:\"slug_id\";s:36:\"e173943c-2060-421d-ac78-30724b30489c\";s:9:\"post_type\";s:6:\"normal\";s:10:\"created_at\";s:19:\"2025-02-08 01:37:23\";s:10:\"updated_at\";s:19:\"2025-02-08 01:37:23\";s:13:\"replies_count\";i:0;s:16:\"post_likes_count\";i:0;}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:50;s:7:\"user_id\";i:4;s:4:\"text\";s:17:\"كيف الحال\";s:5:\"image\";s:2:\"[]\";s:7:\"slug_id\";s:36:\"e173943c-2060-421d-ac78-30724b30489c\";s:9:\"post_type\";s:6:\"normal\";s:10:\"created_at\";s:19:\"2025-02-08 01:37:23\";s:10:\"updated_at\";s:19:\"2025-02-08 01:37:23\";s:13:\"replies_count\";i:0;s:16:\"post_likes_count\";i:0;}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:3:{s:4:\"user\";r:242;s:12:\"userPostLike\";N;s:4:\"poll\";N;}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:5:{i:0;s:7:\"user_id\";i:1;s:4:\"text\";i:2;s:5:\"image\";i:3;s:7:\"slug_id\";i:4;s:9:\"post_type\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:8;O:15:\"App\\Models\\Post\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"posts\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:44;s:7:\"user_id\";i:1;s:4:\"text\";s:0:\"\";s:5:\"image\";s:245:\"[\"posts_images\\/1738946917_post_67a639652dd233.18533368.jpeg\",\"posts_images\\/1738946917_post_67a639652e5aa1.28055302.jpeg\",\"posts_images\\/1738946917_post_67a639652eb272.77683297.jpeg\",\"posts_images\\/1738946917_post_67a639652f0253.05012163.jpeg\"]\";s:7:\"slug_id\";s:36:\"dbf16b71-716d-4dcd-ad5f-45685823104f\";s:9:\"post_type\";s:6:\"normal\";s:10:\"created_at\";s:19:\"2025-02-07 16:48:37\";s:10:\"updated_at\";s:19:\"2025-02-07 16:48:37\";s:13:\"replies_count\";i:0;s:16:\"post_likes_count\";i:2;}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:44;s:7:\"user_id\";i:1;s:4:\"text\";s:0:\"\";s:5:\"image\";s:245:\"[\"posts_images\\/1738946917_post_67a639652dd233.18533368.jpeg\",\"posts_images\\/1738946917_post_67a639652e5aa1.28055302.jpeg\",\"posts_images\\/1738946917_post_67a639652eb272.77683297.jpeg\",\"posts_images\\/1738946917_post_67a639652f0253.05012163.jpeg\"]\";s:7:\"slug_id\";s:36:\"dbf16b71-716d-4dcd-ad5f-45685823104f\";s:9:\"post_type\";s:6:\"normal\";s:10:\"created_at\";s:19:\"2025-02-07 16:48:37\";s:10:\"updated_at\";s:19:\"2025-02-07 16:48:37\";s:13:\"replies_count\";i:0;s:16:\"post_likes_count\";i:2;}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:3:{s:4:\"user\";O:15:\"App\\Models\\User\":32:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"users\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:14:{s:2:\"id\";i:1;s:4:\"name\";s:5:\"ammar\";s:8:\"username\";s:5:\"ammar\";s:5:\"email\";s:15:\"ammar@gmail.com\";s:17:\"email_verified_at\";N;s:8:\"password\";s:60:\"$2y$12$k9C6cfjNUCUvBmGEaf8StO8Cp8Np5b9j055CO/RuRtwY5.Mqur8r.\";s:14:\"remember_token\";s:60:\"A06CCaFBIZ4xjdbJ8ACQO51Wmj1nseeYHDNG8FcF5dDtkq9paa2vQiVtAw7Z\";s:4:\"role\";s:4:\"user\";s:6:\"is_ban\";s:2:\"no\";s:15:\"account_privacy\";s:6:\"public\";s:14:\"terms_accepted\";i:1;s:13:\"last_activity\";s:19:\"2025-02-12 16:39:11\";s:10:\"created_at\";s:19:\"2025-02-06 03:05:55\";s:10:\"updated_at\";s:19:\"2025-02-12 16:39:11\";}s:11:\"\0*\0original\";a:14:{s:2:\"id\";i:1;s:4:\"name\";s:5:\"ammar\";s:8:\"username\";s:5:\"ammar\";s:5:\"email\";s:15:\"ammar@gmail.com\";s:17:\"email_verified_at\";N;s:8:\"password\";s:60:\"$2y$12$k9C6cfjNUCUvBmGEaf8StO8Cp8Np5b9j055CO/RuRtwY5.Mqur8r.\";s:14:\"remember_token\";s:60:\"A06CCaFBIZ4xjdbJ8ACQO51Wmj1nseeYHDNG8FcF5dDtkq9paa2vQiVtAw7Z\";s:4:\"role\";s:4:\"user\";s:6:\"is_ban\";s:2:\"no\";s:15:\"account_privacy\";s:6:\"public\";s:14:\"terms_accepted\";i:1;s:13:\"last_activity\";s:19:\"2025-02-12 16:39:11\";s:10:\"created_at\";s:19:\"2025-02-06 03:05:55\";s:10:\"updated_at\";s:19:\"2025-02-12 16:39:11\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:2:{s:17:\"email_verified_at\";s:8:\"datetime\";s:8:\"password\";s:6:\"hashed\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:2:{i:0;s:8:\"password\";i:1;s:14:\"remember_token\";}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:9:{i:0;s:4:\"name\";i:1;s:8:\"username\";i:2;s:4:\"role\";i:3;s:5:\"email\";i:4;s:8:\"password\";i:5;s:14:\"terms_accepted\";i:6;s:14:\"remember_token\";i:7;s:15:\"account_privacy\";i:8;s:13:\"last_activity\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:19:\"\0*\0authPasswordName\";s:8:\"password\";s:20:\"\0*\0rememberTokenName\";s:14:\"remember_token\";}s:12:\"userPostLike\";O:19:\"App\\Models\\PostLike\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:10:\"post_likes\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:5:{s:2:\"id\";i:4;s:7:\"user_id\";i:1;s:7:\"post_id\";i:44;s:10:\"created_at\";s:19:\"2025-02-07 16:49:06\";s:10:\"updated_at\";s:19:\"2025-02-07 16:49:06\";}s:11:\"\0*\0original\";a:5:{s:2:\"id\";i:4;s:7:\"user_id\";i:1;s:7:\"post_id\";i:44;s:10:\"created_at\";s:19:\"2025-02-07 16:49:06\";s:10:\"updated_at\";s:19:\"2025-02-07 16:49:06\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:2:{i:0;s:7:\"user_id\";i:1;s:7:\"post_id\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}s:4:\"poll\";N;}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:5:{i:0;s:7:\"user_id\";i:1;s:4:\"text\";i:2;s:5:\"image\";i:3;s:7:\"slug_id\";i:4;s:9:\"post_type\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:9;O:15:\"App\\Models\\Post\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"posts\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:39;s:7:\"user_id\";i:2;s:4:\"text\";s:17:\"favotite languge?\";s:5:\"image\";s:2:\"[]\";s:7:\"slug_id\";s:36:\"39c1a81b-c939-444e-91dd-6a5fa97aadb1\";s:9:\"post_type\";s:4:\"poll\";s:10:\"created_at\";s:19:\"2025-02-06 18:57:35\";s:10:\"updated_at\";s:19:\"2025-02-06 18:57:35\";s:13:\"replies_count\";i:0;s:16:\"post_likes_count\";i:1;}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:39;s:7:\"user_id\";i:2;s:4:\"text\";s:17:\"favotite languge?\";s:5:\"image\";s:2:\"[]\";s:7:\"slug_id\";s:36:\"39c1a81b-c939-444e-91dd-6a5fa97aadb1\";s:9:\"post_type\";s:4:\"poll\";s:10:\"created_at\";s:19:\"2025-02-06 18:57:35\";s:10:\"updated_at\";s:19:\"2025-02-06 18:57:35\";s:13:\"replies_count\";i:0;s:16:\"post_likes_count\";i:1;}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:3:{s:4:\"user\";O:15:\"App\\Models\\User\":32:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"users\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:14:{s:2:\"id\";i:2;s:4:\"name\";s:9:\"muna saif\";s:8:\"username\";s:4:\"muna\";s:5:\"email\";s:14:\"muna@gmail.com\";s:17:\"email_verified_at\";N;s:8:\"password\";s:60:\"$2y$12$6ZMS8zuIxEYjn2zk5w6aCuJxxSBk9EDcQY0ylzsuGeCMqLMHWIzXK\";s:14:\"remember_token\";s:60:\"bpIMChgiWLuYRY0k7nriGZfIAFkiU8Pv0cB2JjahlhHojmBQz8B85I00xyhj\";s:4:\"role\";s:4:\"user\";s:6:\"is_ban\";s:2:\"no\";s:15:\"account_privacy\";s:6:\"public\";s:14:\"terms_accepted\";i:1;s:13:\"last_activity\";s:19:\"2025-02-06 19:26:13\";s:10:\"created_at\";s:19:\"2025-02-06 13:53:46\";s:10:\"updated_at\";s:19:\"2025-02-06 19:26:13\";}s:11:\"\0*\0original\";a:14:{s:2:\"id\";i:2;s:4:\"name\";s:9:\"muna saif\";s:8:\"username\";s:4:\"muna\";s:5:\"email\";s:14:\"muna@gmail.com\";s:17:\"email_verified_at\";N;s:8:\"password\";s:60:\"$2y$12$6ZMS8zuIxEYjn2zk5w6aCuJxxSBk9EDcQY0ylzsuGeCMqLMHWIzXK\";s:14:\"remember_token\";s:60:\"bpIMChgiWLuYRY0k7nriGZfIAFkiU8Pv0cB2JjahlhHojmBQz8B85I00xyhj\";s:4:\"role\";s:4:\"user\";s:6:\"is_ban\";s:2:\"no\";s:15:\"account_privacy\";s:6:\"public\";s:14:\"terms_accepted\";i:1;s:13:\"last_activity\";s:19:\"2025-02-06 19:26:13\";s:10:\"created_at\";s:19:\"2025-02-06 13:53:46\";s:10:\"updated_at\";s:19:\"2025-02-06 19:26:13\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:2:{s:17:\"email_verified_at\";s:8:\"datetime\";s:8:\"password\";s:6:\"hashed\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:2:{i:0;s:8:\"password\";i:1;s:14:\"remember_token\";}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:9:{i:0;s:4:\"name\";i:1;s:8:\"username\";i:2;s:4:\"role\";i:3;s:5:\"email\";i:4;s:8:\"password\";i:5;s:14:\"terms_accepted\";i:6;s:14:\"remember_token\";i:7;s:15:\"account_privacy\";i:8;s:13:\"last_activity\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:19:\"\0*\0authPasswordName\";s:8:\"password\";s:20:\"\0*\0rememberTokenName\";s:14:\"remember_token\";}s:12:\"userPostLike\";N;s:4:\"poll\";O:15:\"App\\Models\\Poll\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"polls\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:13:{s:2:\"id\";i:12;s:7:\"post_id\";i:39;s:10:\"expires_at\";s:19:\"2025-02-06 22:21:23\";s:12:\"option1_text\";s:14:\"العربية\";s:13:\"option1_votes\";i:8;s:12:\"option2_text\";s:20:\"الانجليزية\";s:13:\"option2_votes\";i:3;s:12:\"option3_text\";N;s:13:\"option3_votes\";i:0;s:12:\"option4_text\";N;s:13:\"option4_votes\";i:0;s:10:\"created_at\";s:19:\"2025-02-06 18:57:35\";s:10:\"updated_at\";s:19:\"2025-02-06 19:21:23\";}s:11:\"\0*\0original\";a:13:{s:2:\"id\";i:12;s:7:\"post_id\";i:39;s:10:\"expires_at\";s:19:\"2025-02-06 22:21:23\";s:12:\"option1_text\";s:14:\"العربية\";s:13:\"option1_votes\";i:8;s:12:\"option2_text\";s:20:\"الانجليزية\";s:13:\"option2_votes\";i:3;s:12:\"option3_text\";N;s:13:\"option3_votes\";i:0;s:12:\"option4_text\";N;s:13:\"option4_votes\";i:0;s:10:\"created_at\";s:19:\"2025-02-06 18:57:35\";s:10:\"updated_at\";s:19:\"2025-02-06 19:21:23\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:1:{s:10:\"expires_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:10:{i:0;s:7:\"post_id\";i:1;s:10:\"expires_at\";i:2;s:12:\"option1_text\";i:3;s:12:\"option2_text\";i:4;s:12:\"option3_text\";i:5;s:12:\"option4_text\";i:6;s:13:\"option1_votes\";i:7;s:13:\"option2_votes\";i:8;s:13:\"option3_votes\";i:9;s:13:\"option4_votes\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:5:{i:0;s:7:\"user_id\";i:1;s:4:\"text\";i:2;s:5:\"image\";i:3;s:7:\"slug_id\";i:4;s:9:\"post_type\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}s:10:\"\0*\0perPage\";i:10;s:14:\"\0*\0currentPage\";i:1;s:7:\"\0*\0path\";s:32:\"http://localhost:8000/load-posts\";s:8:\"\0*\0query\";a:0:{}s:11:\"\0*\0fragment\";N;s:11:\"\0*\0pageName\";s:4:\"page\";s:10:\"onEachSide\";i:3;s:10:\"\0*\0options\";a:2:{s:4:\"path\";s:32:\"http://localhost:8000/load-posts\";s:8:\"pageName\";s:4:\"page\";}s:8:\"\0*\0total\";i:11;s:11:\"\0*\0lastPage\";i:2;}', 1739378951);

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
(20, 36, 28, 0, 0, '2025-04-04 23:29:27', '2025-04-04 23:35:15'),
(29, 28, 36, 0, 1, '2025-04-06 08:51:44', '2025-04-06 08:52:46');

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

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `sender_id`, `receiver_id`, `message`, `is_read`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 'hi', 0, '2025-02-07 14:02:56', '2025-02-07 14:02:56'),
(2, 1, 3, 'hello', 0, '2025-02-07 17:29:33', '2025-02-07 17:29:33'),
(3, 4, 1, 'سلام عليكم', 0, '2025-02-07 21:49:34', '2025-02-07 21:49:34'),
(4, 6, 4, 'اهلا', 0, '2025-02-08 06:52:19', '2025-02-08 06:52:19'),
(5, 6, 4, 'أهلا', 0, '2025-02-08 06:57:29', '2025-02-08 06:57:29'),
(6, 6, 4, 'اهلا', 0, '2025-02-08 06:57:40', '2025-02-08 06:57:40'),
(7, 6, 4, 'Hi', 0, '2025-02-08 06:58:05', '2025-02-08 06:58:05'),
(8, 8, 4, 'kjj', 0, '2025-02-08 11:40:08', '2025-02-08 11:40:08'),
(10, 4, 32, 'مرحبا', 0, '2025-03-07 17:30:55', '2025-03-07 17:30:55');

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_01_11_073136_create_posts_table', 1),
(5, '2025_01_12_185331_create_replies_table', 1),
(6, '2025_01_19_160123_create_post_likes_table', 1),
(7, '2025_01_23_031233_create_user_profiles_table', 1),
(8, '2025_01_25_052809_create_follows_table', 1),
(9, '2025_01_29_075913_create_notifications_table', 1),
(10, '2025_01_31_122118_create_messages_table', 1),
(11, '2025_02_05_154224_create_polls_table', 1),
(12, '2025_02_06_181520_create_poll_votes_table', 2);

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
(1, 1, 1, 'new_reply', 'App\\Models\\Post', 26, 0, '2025-02-06 07:30:23', '2025-02-06 07:30:23'),
(2, 1, 1, 'new_like', 'App\\Models\\Post', 26, 0, '2025-02-06 07:30:25', '2025-02-06 07:30:25'),
(3, 1, 1, 'new_reply', 'App\\Models\\Post', 27, 0, '2025-02-06 10:05:43', '2025-02-06 10:05:43'),
(4, 1, 2, 'mention', 'App\\Models\\Post', 34, 0, '2025-02-06 10:54:41', '2025-02-06 10:54:41'),
(5, 1, 2, 'new_reply', 'App\\Models\\Post', 33, 0, '2025-02-06 12:41:18', '2025-02-06 12:41:18'),
(6, 2, 2, 'new_reply', 'App\\Models\\Post', 35, 0, '2025-02-06 12:51:30', '2025-02-06 12:51:30'),
(7, 2, 2, 'new_reply', 'App\\Models\\Post', 35, 0, '2025-02-06 12:53:35', '2025-02-06 12:53:35'),
(8, 2, 2, 'new_reply', 'App\\Models\\Post', 35, 0, '2025-02-06 12:56:39', '2025-02-06 12:56:39'),
(9, 2, 2, 'new_reply', 'App\\Models\\Post', 35, 0, '2025-02-06 12:58:43', '2025-02-06 12:58:43'),
(10, 2, 2, 'new_reply', 'App\\Models\\Post', 35, 0, '2025-02-06 13:02:40', '2025-02-06 13:02:40'),
(11, 2, 2, 'new_reply', 'App\\Models\\Post', 35, 0, '2025-02-06 13:04:21', '2025-02-06 13:04:21'),
(12, 2, 2, 'new_reply', 'App\\Models\\Post', 35, 1, '2025-02-06 13:15:35', '2025-02-06 13:32:44'),
(13, 2, 2, 'new_like', 'App\\Models\\Post', 34, 0, '2025-02-06 13:36:50', '2025-02-06 13:36:50'),
(14, 1, 1, 'new_reply', 'App\\Models\\Post', 42, 0, '2025-02-07 13:12:32', '2025-02-07 13:12:32'),
(15, 1, 1, 'new_reply', 'App\\Models\\Post', 42, 0, '2025-02-07 13:15:04', '2025-02-07 13:15:04'),
(16, 1, 1, 'new_reply', 'App\\Models\\Post', 42, 0, '2025-02-07 13:16:17', '2025-02-07 13:16:17'),
(17, 1, 1, 'new_reply', 'App\\Models\\Post', 42, 0, '2025-02-07 13:17:29', '2025-02-07 13:17:29'),
(18, 1, 1, 'new_reply', 'App\\Models\\Post', 42, 0, '2025-02-07 13:34:26', '2025-02-07 13:34:26'),
(19, 1, 1, 'new_reply', 'App\\Models\\Post', 43, 0, '2025-02-07 13:45:06', '2025-02-07 13:45:06'),
(20, 1, 1, 'new_like', 'App\\Models\\Post', 43, 0, '2025-02-07 13:45:32', '2025-02-07 13:45:32'),
(21, 1, 1, 'new_reply', 'App\\Models\\Post', 43, 0, '2025-02-07 13:47:14', '2025-02-07 13:47:14'),
(22, 1, 1, 'new_like', 'App\\Models\\Post', 44, 0, '2025-02-07 13:49:06', '2025-02-07 13:49:06'),
(23, 1, 3, 'new_follow', 'App\\Models\\User', 1, 0, '2025-02-07 14:04:36', '2025-02-07 14:04:36'),
(24, 1, 1, 'new_like', 'App\\Models\\Post', 45, 0, '2025-02-07 17:27:00', '2025-02-07 17:27:00'),
(25, 1, 1, 'new_reply', 'App\\Models\\Post', 45, 1, '2025-02-07 17:27:23', '2025-02-07 17:28:44'),
(26, 1, 1, 'new_like', 'App\\Models\\Post', 27, 0, '2025-02-07 18:02:04', '2025-02-07 18:02:04'),
(27, 1, 1, 'new_reply', 'App\\Models\\Post', 47, 0, '2025-02-07 18:05:10', '2025-02-07 18:05:10'),
(28, 1, 4, 'new_like', 'App\\Models\\Post', 44, 0, '2025-02-07 22:10:32', '2025-02-07 22:10:32'),
(29, 1, 4, 'new_like', 'App\\Models\\Post', 44, 0, '2025-02-07 22:10:34', '2025-02-07 22:10:34'),
(30, 1, 4, 'new_like', 'App\\Models\\Post', 44, 0, '2025-02-07 22:10:37', '2025-02-07 22:10:37'),
(31, 1, 4, 'new_like', 'App\\Models\\Post', 44, 0, '2025-02-07 22:10:42', '2025-02-07 22:10:42'),
(32, 1, 4, 'new_like', 'App\\Models\\Post', 44, 0, '2025-02-07 22:10:43', '2025-02-07 22:10:43'),
(33, 2, 4, 'new_like', 'App\\Models\\Post', 39, 0, '2025-02-07 22:41:51', '2025-02-07 22:41:51'),
(34, 2, 4, 'new_like', 'App\\Models\\Post', 39, 0, '2025-02-07 22:41:52', '2025-02-07 22:41:52'),
(35, 2, 4, 'new_like', 'App\\Models\\Post', 39, 0, '2025-02-07 22:41:55', '2025-02-07 22:41:55'),
(36, 1, 4, 'new_follow', 'App\\Models\\User', 1, 0, '2025-02-07 22:56:32', '2025-02-07 22:56:32'),
(37, 1, 4, 'new_like', 'App\\Models\\Post', 44, 0, '2025-02-07 23:08:38', '2025-02-07 23:08:38'),
(38, 4, 4, 'new_like', 'App\\Models\\Post', 55, 0, '2025-02-07 23:40:58', '2025-02-07 23:40:58'),
(39, 2, 4, 'new_like', 'App\\Models\\Post', 39, 0, '2025-02-07 23:41:23', '2025-02-07 23:41:23'),
(40, 1, 4, 'new_like', 'App\\Models\\Post', 44, 0, '2025-02-07 23:42:26', '2025-02-07 23:42:26'),
(41, 2, 4, 'new_like', 'App\\Models\\Post', 39, 0, '2025-02-07 23:42:30', '2025-02-07 23:42:30'),
(42, 4, 4, 'new_reply', 'App\\Models\\Post', 55, 0, '2025-02-08 02:45:35', '2025-02-08 02:45:35'),
(43, 4, 4, 'new_reply', 'App\\Models\\Post', 55, 0, '2025-02-08 02:51:40', '2025-02-08 02:51:40'),
(44, 4, 3, 'new_like', 'App\\Models\\Post', 55, 0, '2025-02-08 07:26:41', '2025-02-08 07:26:41'),
(45, 6, 8, 'new_like', 'App\\Models\\Post', 57, 0, '2025-02-08 11:39:32', '2025-02-08 11:39:32'),
(46, 4, 8, 'new_follow', 'App\\Models\\User', 4, 0, '2025-02-08 11:39:55', '2025-02-08 11:39:55'),
(47, 6, 8, 'new_like', 'App\\Models\\Post', 57, 0, '2025-02-08 11:41:49', '2025-02-08 11:41:49'),
(48, 1, 1, 'new_like', 'App\\Models\\Post', 27, 0, '2025-02-12 13:55:15', '2025-02-12 13:55:15'),
(49, 4, 1, 'new_reply', 'App\\Models\\Post', 51, 0, '2025-02-12 14:20:16', '2025-02-12 14:20:16'),
(50, 6, 1, 'new_follow', 'App\\Models\\User', 6, 0, '2025-02-15 05:48:48', '2025-02-15 05:48:48'),
(51, 6, 1, 'new_follow', 'App\\Models\\User', 6, 0, '2025-02-15 05:53:20', '2025-02-15 05:53:20'),
(52, 4, 1, 'new_follow', 'App\\Models\\User', 4, 0, '2025-02-15 06:03:29', '2025-02-15 06:03:29'),
(53, 4, 1, 'new_follow', 'App\\Models\\User', 4, 0, '2025-02-15 06:05:41', '2025-02-15 06:05:41'),
(54, 1, 11, 'new_like', 'App\\Models\\Post', 44, 0, '2025-02-15 15:22:52', '2025-02-15 15:22:52'),
(55, 1, 11, 'new_like', 'App\\Models\\Post', 27, 0, '2025-02-15 15:22:56', '2025-02-15 15:22:56'),
(77, 1, 4, 'new_follow', 'App\\Models\\User', 1, 0, '2025-02-20 03:53:00', '2025-02-20 03:53:00'),
(78, 1, 4, 'new_follow', 'App\\Models\\User', 1, 0, '2025-02-20 03:54:58', '2025-02-20 03:54:58'),
(79, 4, 3, 'new_follow', 'App\\Models\\User', 4, 0, '2025-02-20 04:02:00', '2025-02-20 04:02:00'),
(80, 4, 3, 'new_follow', 'App\\Models\\User', 4, 0, '2025-02-20 04:39:52', '2025-02-20 04:39:52'),
(81, 4, 3, 'new_follow', 'App\\Models\\User', 4, 0, '2025-02-20 04:40:12', '2025-02-20 04:40:12'),
(82, 4, 3, 'new_follow', 'App\\Models\\User', 4, 0, '2025-02-20 04:40:34', '2025-02-20 04:40:34'),
(83, 4, 3, 'new_follow', 'App\\Models\\User', 4, 0, '2025-02-20 04:42:50', '2025-02-20 04:42:50'),
(84, 4, 3, 'new_follow', 'App\\Models\\User', 4, 0, '2025-02-20 04:43:24', '2025-02-20 04:43:24'),
(85, 4, 1, 'new_follow', 'App\\Models\\User', 4, 0, '2025-02-20 04:44:44', '2025-02-20 04:44:44'),
(86, 4, 1, 'new_follow', 'App\\Models\\User', 4, 0, '2025-02-20 04:45:31', '2025-02-20 04:45:31'),
(87, 4, 3, 'new_follow', 'App\\Models\\User', 4, 0, '2025-02-20 04:45:36', '2025-02-20 04:45:36'),
(88, 4, 3, 'new_follow', 'App\\Models\\User', 4, 0, '2025-02-20 04:46:15', '2025-02-20 04:46:15'),
(89, 4, 1, 'new_follow', 'App\\Models\\User', 4, 0, '2025-02-20 04:46:18', '2025-02-20 04:46:18'),
(90, 1, 4, 'new_follow', 'App\\Models\\User', 1, 0, '2025-02-20 05:03:18', '2025-02-20 05:03:18'),
(91, 1, 4, 'new_follow', 'App\\Models\\User', 1, 0, '2025-02-20 05:03:57', '2025-02-20 05:03:57'),
(92, 4, 16, 'new_follow', 'App\\Models\\User', 4, 0, '2025-02-20 16:27:58', '2025-02-20 16:27:58'),
(93, 4, 17, 'new_follow', 'App\\Models\\User', 4, 0, '2025-02-20 16:29:08', '2025-02-20 16:29:08'),
(94, 4, 18, 'new_follow', 'App\\Models\\User', 4, 0, '2025-02-20 16:30:29', '2025-02-20 16:30:29'),
(95, 4, 19, 'new_follow', 'App\\Models\\User', 4, 0, '2025-02-20 16:31:20', '2025-02-20 16:31:20'),
(96, 4, 20, 'new_follow', 'App\\Models\\User', 4, 0, '2025-02-20 16:33:57', '2025-02-20 16:33:57'),
(97, 4, 21, 'new_follow', 'App\\Models\\User', 4, 0, '2025-02-20 16:35:24', '2025-02-20 16:35:24'),
(98, 4, 22, 'new_follow', 'App\\Models\\User', 4, 0, '2025-02-20 16:36:27', '2025-02-20 16:36:27'),
(99, 4, 18, 'new_follow', 'App\\Models\\User', 4, 0, '2025-02-20 16:40:10', '2025-02-20 16:40:10'),
(100, 4, 19, 'new_follow', 'App\\Models\\User', 4, 0, '2025-02-20 16:40:16', '2025-02-20 16:40:16'),
(101, 4, 16, 'new_follow', 'App\\Models\\User', 4, 0, '2025-02-20 16:40:31', '2025-02-20 16:40:31'),
(102, 4, 20, 'new_follow', 'App\\Models\\User', 4, 0, '2025-02-20 16:40:46', '2025-02-20 16:40:46'),
(103, 4, 21, 'new_follow', 'App\\Models\\User', 4, 0, '2025-02-20 16:41:18', '2025-02-20 16:41:18'),
(104, 4, 22, 'new_follow', 'App\\Models\\User', 4, 0, '2025-02-20 16:41:34', '2025-02-20 16:41:34'),
(105, 4, 20, 'new_follow', 'App\\Models\\User', 4, 0, '2025-02-20 16:41:49', '2025-02-20 16:41:49'),
(106, 4, 17, 'new_follow', 'App\\Models\\User', 4, 0, '2025-02-20 16:43:38', '2025-02-20 16:43:38'),
(107, 4, 18, 'new_follow', 'App\\Models\\User', 4, 0, '2025-02-20 16:44:56', '2025-02-20 16:44:56'),
(108, 18, 4, 'new_follow', 'App\\Models\\User', 18, 0, '2025-02-20 16:45:28', '2025-02-20 16:45:28'),
(109, 18, 4, 'new_follow', 'App\\Models\\User', 18, 0, '2025-02-20 16:46:56', '2025-02-20 16:46:56'),
(110, 18, 4, 'new_follow', 'App\\Models\\User', 18, 0, '2025-02-20 16:47:58', '2025-02-20 16:47:58'),
(111, 4, 17, 'new_follow', 'App\\Models\\User', 4, 0, '2025-02-20 16:48:11', '2025-02-20 16:48:11'),
(112, 4, 19, 'new_follow', 'App\\Models\\User', 4, 0, '2025-02-20 16:48:15', '2025-02-20 16:48:15'),
(113, 4, 18, 'new_follow', 'App\\Models\\User', 4, 0, '2025-02-20 16:49:02', '2025-02-20 16:49:02'),
(114, 4, 18, 'new_follow', 'App\\Models\\User', 4, 0, '2025-02-20 16:52:54', '2025-02-20 16:52:54'),
(115, 4, 18, 'new_follow', 'App\\Models\\User', 4, 0, '2025-02-20 16:53:47', '2025-02-20 16:53:47'),
(116, 18, 4, 'new_follow', 'App\\Models\\User', 18, 0, '2025-02-20 16:54:31', '2025-02-20 16:54:31'),
(117, 4, 18, 'new_follow', 'App\\Models\\User', 4, 0, '2025-02-20 16:56:14', '2025-02-20 16:56:14'),
(119, 4, 18, 'new_follow', 'App\\Models\\User', 4, 0, '2025-02-20 16:57:45', '2025-02-20 16:57:45'),
(121, 4, 16, 'new_follow', 'App\\Models\\User', 4, 0, '2025-02-20 17:00:59', '2025-02-20 17:00:59'),
(122, 19, 16, 'new_follow', 'App\\Models\\User', 19, 0, '2025-02-20 17:03:53', '2025-02-20 17:03:53'),
(123, 4, 19, 'new_follow', 'App\\Models\\User', 4, 0, '2025-02-20 17:07:26', '2025-02-20 17:07:26'),
(124, 19, 4, 'new_follow', 'App\\Models\\User', 19, 0, '2025-02-20 17:09:19', '2025-02-20 17:09:19'),
(125, 19, 4, 'new_follow', 'App\\Models\\User', 19, 0, '2025-02-20 17:12:43', '2025-02-20 17:12:43'),
(126, 19, 4, 'new_follow', 'App\\Models\\User', 19, 0, '2025-02-20 17:14:41', '2025-02-20 17:14:41'),
(130, 8, 4, 'new_follow', 'App\\Models\\User', 8, 0, '2025-02-21 08:22:19', '2025-02-21 08:22:19'),
(131, 3, 4, 'new_follow', 'App\\Models\\User', 3, 0, '2025-02-21 08:22:42', '2025-02-21 08:22:42'),
(132, 8, 4, 'new_follow', 'App\\Models\\User', 8, 0, '2025-02-21 08:22:42', '2025-02-21 08:22:42'),
(133, 4, 21, 'new_follow', 'App\\Models\\User', 4, 0, '2025-02-21 08:24:02', '2025-02-21 08:24:02'),
(134, 21, 4, 'new_follow', 'App\\Models\\User', 21, 0, '2025-02-21 08:25:57', '2025-02-21 08:25:57'),
(135, 4, 21, 'new_follow', 'App\\Models\\User', 4, 0, '2025-02-21 08:27:05', '2025-02-21 08:27:05'),
(136, 4, 21, 'new_follow', 'App\\Models\\User', 4, 0, '2025-02-21 08:28:05', '2025-02-21 08:28:05'),
(137, 4, 21, 'new_follow', 'App\\Models\\User', 4, 0, '2025-02-21 08:28:29', '2025-02-21 08:28:29'),
(138, 4, 21, 'new_follow', 'App\\Models\\User', 4, 0, '2025-02-21 08:29:10', '2025-02-21 08:29:10'),
(139, 4, 21, 'new_follow', 'App\\Models\\User', 4, 0, '2025-02-21 08:29:47', '2025-02-21 08:29:47'),
(140, 4, 21, 'new_follow', 'App\\Models\\User', 4, 0, '2025-02-21 08:34:30', '2025-02-21 08:34:30'),
(141, 4, 21, 'new_follow', 'App\\Models\\User', 4, 0, '2025-02-23 09:22:31', '2025-02-23 09:22:31'),
(142, 4, 21, 'new_follow', 'App\\Models\\User', 4, 0, '2025-02-23 09:23:10', '2025-02-23 09:23:10'),
(143, 4, 21, 'new_follow', 'App\\Models\\User', 4, 0, '2025-02-23 09:25:47', '2025-02-23 09:25:47'),
(144, 4, 25, 'new_like', 'App\\Models\\Post', 55, 0, '2025-02-23 09:30:10', '2025-02-23 09:30:10'),
(145, 25, 26, 'new_follow', 'App\\Models\\User', 25, 0, '2025-02-23 09:32:52', '2025-02-23 09:32:52'),
(146, 25, 26, 'new_follow', 'App\\Models\\User', 25, 0, '2025-02-23 09:39:52', '2025-02-23 09:39:52'),
(147, 4, 26, 'new_follow', 'App\\Models\\User', 4, 0, '2025-02-23 10:01:44', '2025-02-23 10:01:44'),
(148, 26, 4, 'new_follow', 'App\\Models\\User', 26, 0, '2025-02-23 10:02:10', '2025-02-23 10:02:10'),
(149, 4, 26, 'new_follow', 'App\\Models\\User', 4, 0, '2025-02-23 10:02:43', '2025-02-23 10:02:43'),
(150, 4, 26, 'new_follow', 'App\\Models\\User', 4, 0, '2025-02-23 10:03:29', '2025-02-23 10:03:29'),
(151, 4, 26, 'new_follow', 'App\\Models\\User', 4, 0, '2025-02-23 10:03:49', '2025-02-23 10:03:49'),
(152, 4, 25, 'new_follow', 'App\\Models\\User', 4, 0, '2025-02-23 10:59:59', '2025-02-23 10:59:59'),
(153, 4, 26, 'new_follow', 'App\\Models\\User', 4, 0, '2025-02-23 11:00:31', '2025-02-23 11:00:31'),
(154, 4, 19, 'new_follow', 'App\\Models\\User', 4, 0, '2025-02-23 11:01:21', '2025-02-23 11:01:21'),
(155, 4, 21, 'new_follow', 'App\\Models\\User', 4, 0, '2025-02-23 11:01:40', '2025-02-23 11:01:40'),
(156, 19, 4, 'new_follow', 'App\\Models\\User', 19, 0, '2025-02-23 11:08:06', '2025-02-23 11:08:06'),
(157, 25, 4, 'new_follow', 'App\\Models\\User', 25, 0, '2025-02-23 11:08:20', '2025-02-23 11:08:20'),
(158, 26, 4, 'new_follow', 'App\\Models\\User', 26, 0, '2025-02-23 11:08:24', '2025-02-23 11:08:24'),
(159, 19, 4, 'new_follow', 'App\\Models\\User', 19, 0, '2025-02-23 11:08:27', '2025-02-23 11:08:27'),
(160, 4, 21, 'new_follow', 'App\\Models\\User', 4, 0, '2025-02-24 12:36:12', '2025-02-24 12:36:12'),
(161, 21, 4, 'new_follow', 'App\\Models\\User', 21, 0, '2025-02-24 12:37:24', '2025-02-24 12:37:24'),
(162, 4, 21, 'new_follow', 'App\\Models\\User', 4, 0, '2025-02-24 12:38:21', '2025-02-24 12:38:21'),
(163, 19, 4, 'new_follow', 'App\\Models\\User', 19, 0, '2025-02-27 10:36:36', '2025-02-27 10:36:36'),
(164, 4, 19, 'new_like', 'App\\Models\\Post', 55, 0, '2025-02-27 11:56:45', '2025-02-27 11:56:45'),
(165, 19, 4, 'new_follow', 'App\\Models\\User', 19, 0, '2025-02-27 11:57:07', '2025-02-27 11:57:07'),
(166, 27, 28, 'new_follow', 'App\\Models\\User', 27, 0, '2025-03-01 11:34:07', '2025-03-01 11:34:07'),
(167, 27, 28, 'new_like', 'App\\Models\\Post', 67, 0, '2025-03-01 11:34:09', '2025-03-01 11:34:09'),
(168, 27, 28, 'new_follow', 'App\\Models\\User', 27, 0, '2025-03-01 11:34:30', '2025-03-01 11:34:30'),
(169, 27, 28, 'new_follow', 'App\\Models\\User', 27, 0, '2025-03-01 11:34:31', '2025-03-01 11:34:31'),
(170, 28, 27, 'new_follow', 'App\\Models\\User', 28, 0, '2025-03-01 11:34:59', '2025-03-01 11:34:59'),
(171, 28, 27, 'new_like', 'App\\Models\\Post', 70, 0, '2025-03-01 11:35:22', '2025-03-01 11:35:22'),
(172, 27, 29, 'new_follow', 'App\\Models\\User', 27, 0, '2025-03-01 11:37:06', '2025-03-01 11:37:06'),
(173, 27, 29, 'new_follow', 'App\\Models\\User', 27, 0, '2025-03-01 11:37:45', '2025-03-01 11:37:45'),
(174, 28, 27, 'new_like', 'App\\Models\\Post', 74, 0, '2025-03-01 11:40:37', '2025-03-01 11:40:37'),
(175, 27, 29, 'new_follow', 'App\\Models\\User', 27, 0, '2025-03-01 11:40:41', '2025-03-01 11:40:41'),
(176, 29, 27, 'new_follow', 'App\\Models\\User', 29, 0, '2025-03-01 11:41:50', '2025-03-01 11:41:50'),
(177, 28, 29, 'new_like', 'App\\Models\\Post', 74, 0, '2025-03-01 11:42:15', '2025-03-01 11:42:15'),
(178, 28, 29, 'new_like', 'App\\Models\\Post', 74, 0, '2025-03-01 11:42:37', '2025-03-01 11:42:37'),
(179, 28, 27, 'new_like', 'App\\Models\\Post', 74, 0, '2025-03-01 11:44:16', '2025-03-01 11:44:16'),
(180, 28, 29, 'new_like', 'App\\Models\\Post', 70, 0, '2025-03-01 11:44:58', '2025-03-01 11:44:58'),
(181, 28, 29, 'new_like', 'App\\Models\\Post', 70, 0, '2025-03-01 11:45:28', '2025-03-01 11:45:28'),
(182, 28, 29, 'new_follow', 'App\\Models\\User', 28, 0, '2025-03-01 11:46:34', '2025-03-01 11:46:34'),
(183, 29, 28, 'new_follow', 'App\\Models\\User', 29, 0, '2025-03-01 11:47:00', '2025-03-01 11:47:00'),
(184, 29, 28, 'new_like', 'App\\Models\\Post', 76, 0, '2025-03-01 11:47:34', '2025-03-01 11:47:34'),
(185, 29, 28, 'new_like', 'App\\Models\\Post', 76, 0, '2025-03-01 11:47:48', '2025-03-01 11:47:48'),
(186, 29, 28, 'new_like', 'App\\Models\\Post', 75, 0, '2025-03-01 11:47:50', '2025-03-01 11:47:50'),
(187, 29, 28, 'new_like', 'App\\Models\\Post', 75, 0, '2025-03-01 11:48:14', '2025-03-01 11:48:14'),
(188, 29, 28, 'new_like', 'App\\Models\\Post', 75, 0, '2025-03-01 11:48:45', '2025-03-01 11:48:45'),
(189, 29, 28, 'new_like', 'App\\Models\\Post', 75, 0, '2025-03-01 11:49:09', '2025-03-01 11:49:09'),
(190, 28, 27, 'new_like', 'App\\Models\\Post', 74, 0, '2025-03-01 11:54:51', '2025-03-01 11:54:51'),
(191, 29, 27, 'new_like', 'App\\Models\\Post', 75, 0, '2025-03-01 11:55:07', '2025-03-01 11:55:07'),
(192, 4, 4, 'new_like', 'App\\Models\\Post', 54, 0, '2025-03-02 18:26:49', '2025-03-02 18:26:49'),
(193, 4, 4, 'new_like', 'App\\Models\\Post', 55, 0, '2025-03-02 18:27:01', '2025-03-02 18:27:01'),
(194, 29, 4, 'new_follow', 'App\\Models\\User', 29, 0, '2025-03-02 18:28:03', '2025-03-02 18:28:03'),
(195, 27, 29, 'new_like', 'App\\Models\\Post', 71, 0, '2025-03-02 18:28:14', '2025-03-02 18:28:14'),
(196, 27, 4, 'new_like', 'App\\Models\\Post', 71, 0, '2025-03-02 18:28:22', '2025-03-02 18:28:22'),
(197, 27, 29, 'new_like', 'App\\Models\\Post', 67, 0, '2025-03-02 18:28:36', '2025-03-02 18:28:36'),
(198, 27, 29, 'new_like', 'App\\Models\\Post', 73, 0, '2025-03-02 18:31:03', '2025-03-02 18:31:03'),
(199, 28, 4, 'new_follow', 'App\\Models\\User', 28, 0, '2025-03-02 18:32:46', '2025-03-02 18:32:46'),
(200, 27, 28, 'new_like', 'App\\Models\\Post', 67, 0, '2025-03-02 18:32:58', '2025-03-02 18:32:58'),
(201, 27, 28, 'new_like', 'App\\Models\\Post', 71, 0, '2025-03-02 18:33:00', '2025-03-02 18:33:00'),
(202, 27, 28, 'new_like', 'App\\Models\\Post', 67, 0, '2025-03-02 18:33:04', '2025-03-02 18:33:04'),
(203, 27, 28, 'new_like', 'App\\Models\\Post', 67, 0, '2025-03-02 18:33:13', '2025-03-02 18:33:13'),
(204, 27, 28, 'new_like', 'App\\Models\\Post', 71, 0, '2025-03-02 18:33:32', '2025-03-02 18:33:32'),
(205, 27, 28, 'new_like', 'App\\Models\\Post', 71, 0, '2025-03-02 21:34:25', '2025-03-02 21:34:25'),
(206, 27, 28, 'new_like', 'App\\Models\\Post', 67, 0, '2025-03-02 21:34:46', '2025-03-02 21:34:46'),
(207, 29, 28, 'new_like', 'App\\Models\\Post', 75, 0, '2025-03-02 21:34:50', '2025-03-02 21:34:50'),
(208, 29, 4, 'new_like', 'App\\Models\\Post', 75, 0, '2025-03-02 21:35:51', '2025-03-02 21:35:51'),
(209, 4, 28, 'new_follow', 'App\\Models\\User', 4, 0, '2025-03-02 21:36:04', '2025-03-02 21:36:04'),
(210, 27, 4, 'new_like', 'App\\Models\\Post', 67, 0, '2025-03-02 21:37:01', '2025-03-02 21:37:01'),
(211, 4, 28, 'new_follow', 'App\\Models\\User', 4, 0, '2025-03-02 21:37:09', '2025-03-02 21:37:09'),
(212, 27, 4, 'new_like', 'App\\Models\\Post', 67, 0, '2025-03-02 21:38:02', '2025-03-02 21:38:02'),
(213, 27, 4, 'new_like', 'App\\Models\\Post', 67, 0, '2025-03-02 21:38:32', '2025-03-02 21:38:32'),
(214, 27, 28, 'new_like', 'App\\Models\\Post', 67, 0, '2025-03-02 21:39:20', '2025-03-02 21:39:20'),
(215, 29, 4, 'new_like', 'App\\Models\\Post', 76, 0, '2025-03-02 21:41:47', '2025-03-02 21:41:47'),
(216, 29, 4, 'new_like', 'App\\Models\\Post', 75, 0, '2025-03-02 21:41:50', '2025-03-02 21:41:50'),
(217, 4, 28, 'new_follow', 'App\\Models\\User', 4, 0, '2025-03-02 21:41:53', '2025-03-02 21:41:53'),
(218, 4, 19, 'new_follow', 'App\\Models\\User', 4, 0, '2025-03-02 21:44:02', '2025-03-02 21:44:02'),
(219, 4, 19, 'new_follow', 'App\\Models\\User', 4, 0, '2025-03-02 21:44:35', '2025-03-02 21:44:35'),
(220, 28, 19, 'new_follow', 'App\\Models\\User', 28, 0, '2025-03-02 21:45:07', '2025-03-02 21:45:07'),
(221, 28, 28, 'new_like', 'App\\Models\\Post', 72, 0, '2025-03-02 21:45:26', '2025-03-02 21:45:26'),
(222, 28, 4, 'new_like', 'App\\Models\\Post', 72, 0, '2025-03-02 21:46:01', '2025-03-02 21:46:01'),
(223, 29, 4, 'new_like', 'App\\Models\\Post', 75, 0, '2025-03-02 21:47:40', '2025-03-02 21:47:40'),
(224, 4, 19, 'new_follow', 'App\\Models\\User', 4, 0, '2025-03-02 21:47:46', '2025-03-02 21:47:46'),
(225, 4, 19, 'new_follow', 'App\\Models\\User', 4, 0, '2025-03-02 21:48:56', '2025-03-02 21:48:56'),
(226, 4, 19, 'new_follow', 'App\\Models\\User', 4, 0, '2025-03-02 21:49:43', '2025-03-02 21:49:43'),
(227, 4, 19, 'new_follow', 'App\\Models\\User', 4, 0, '2025-03-02 21:50:04', '2025-03-02 21:50:04'),
(228, 21, 4, 'new_like', 'App\\Models\\Post', 84, 0, '2025-03-02 21:51:33', '2025-03-02 21:51:33'),
(229, 21, 4, 'new_like', 'App\\Models\\Post', 84, 0, '2025-03-02 21:54:39', '2025-03-02 21:54:39'),
(230, 4, 28, 'new_follow', 'App\\Models\\User', 4, 0, '2025-03-02 21:54:43', '2025-03-02 21:54:43'),
(231, 4, 30, 'new_follow', 'App\\Models\\User', 4, 0, '2025-03-03 20:00:36', '2025-03-03 20:00:36'),
(232, 21, 4, 'new_like', 'App\\Models\\Post', 84, 0, '2025-03-03 20:00:40', '2025-03-03 20:00:40'),
(233, 21, 4, 'new_like', 'App\\Models\\Post', 84, 0, '2025-03-03 20:01:21', '2025-03-03 20:01:21'),
(234, 4, 30, 'new_follow', 'App\\Models\\User', 4, 0, '2025-03-03 20:01:25', '2025-03-03 20:01:25'),
(235, 4, 30, 'new_follow', 'App\\Models\\User', 4, 0, '2025-03-03 20:03:06', '2025-03-03 20:03:06'),
(236, 4, 30, 'new_follow', 'App\\Models\\User', 4, 0, '2025-03-03 20:04:44', '2025-03-03 20:04:44'),
(237, 30, 4, 'new_follow', 'App\\Models\\User', 30, 0, '2025-03-03 20:04:57', '2025-03-03 20:04:57'),
(238, 28, 30, 'new_like', 'App\\Models\\Post', 74, 0, '2025-03-03 20:05:46', '2025-03-03 20:05:46'),
(239, 28, 30, 'new_follow', 'App\\Models\\User', 28, 0, '2025-03-03 20:06:47', '2025-03-03 20:06:47'),
(240, 21, 4, 'new_like', 'App\\Models\\Post', 84, 0, '2025-03-03 20:45:16', '2025-03-03 20:45:16'),
(241, 1, 4, 'new_like', 'App\\Models\\Post', 58, 0, '2025-03-03 20:45:50', '2025-03-03 20:45:50'),
(242, 1, 4, 'new_like', 'App\\Models\\Post', 27, 0, '2025-03-03 20:45:54', '2025-03-03 20:45:54'),
(243, 4, 12, 'new_follow', 'App\\Models\\User', 4, 0, '2025-03-03 20:46:00', '2025-03-03 20:46:00'),
(244, 29, 4, 'new_like', 'App\\Models\\Post', 75, 0, '2025-03-03 21:13:42', '2025-03-03 21:13:42'),
(245, 29, 4, 'new_like', 'App\\Models\\Post', 75, 0, '2025-03-03 21:14:16', '2025-03-03 21:14:16'),
(246, 4, 12, 'new_follow', 'App\\Models\\User', 4, 0, '2025-03-03 21:14:46', '2025-03-03 21:14:46'),
(247, 4, 4, 'new_like', 'App\\Models\\Post', 86, 0, '2025-03-03 21:15:00', '2025-03-03 21:15:00'),
(248, 31, 12, 'new_follow', 'App\\Models\\User', 31, 0, '2025-03-04 15:20:11', '2025-03-04 15:20:11'),
(249, 28, 4, 'new_like', 'App\\Models\\Post', 74, 0, '2025-03-05 21:25:06', '2025-03-05 21:25:06'),
(250, 28, 4, 'new_like', 'App\\Models\\Post', 69, 0, '2025-03-05 21:25:16', '2025-03-05 21:25:16'),
(251, 28, 4, 'new_like', 'App\\Models\\Post', 70, 0, '2025-03-05 21:27:42', '2025-03-05 21:27:42'),
(252, 21, 4, 'new_like', 'App\\Models\\Post', 84, 0, '2025-03-05 21:28:15', '2025-03-05 21:28:15'),
(253, 4, 32, 'new_follow', 'App\\Models\\User', 4, 0, '2025-03-07 17:21:15', '2025-03-07 17:21:15'),
(254, 21, 4, 'new_like', 'App\\Models\\Post', 84, 0, '2025-03-07 17:21:36', '2025-03-07 17:21:36'),
(255, 21, 4, 'new_like', 'App\\Models\\Post', 84, 0, '2025-03-07 17:21:46', '2025-03-07 17:21:46'),
(256, 21, 4, 'new_like', 'App\\Models\\Post', 84, 0, '2025-03-07 17:21:55', '2025-03-07 17:21:55'),
(257, 21, 4, 'mention', 'App\\Models\\Post', 90, 0, '2025-03-07 17:22:09', '2025-03-07 17:22:09'),
(258, 21, 32, 'new_like', 'App\\Models\\Post', 84, 0, '2025-03-07 17:27:26', '2025-03-07 17:27:26'),
(259, 4, 32, 'new_like', 'App\\Models\\Post', 90, 0, '2025-03-07 17:27:31', '2025-03-07 17:27:31'),
(260, 4, 32, 'new_like', 'App\\Models\\Post', 90, 0, '2025-03-07 17:28:06', '2025-03-07 17:28:06'),
(261, 32, 4, 'new_follow', 'App\\Models\\User', 32, 0, '2025-03-07 17:28:37', '2025-03-07 17:28:37'),
(262, 1, 4, 'new_like', 'App\\Models\\Post', 58, 0, '2025-03-07 17:29:04', '2025-03-07 17:29:04'),
(263, 1, 32, 'new_follow', 'App\\Models\\User', 1, 0, '2025-03-07 17:32:14', '2025-03-07 17:32:14'),
(264, 28, 32, 'new_like', 'App\\Models\\Post', 74, 0, '2025-03-07 17:32:19', '2025-03-07 17:32:19'),
(265, 28, 4, 'new_like', 'App\\Models\\Post', 69, 0, '2025-03-07 17:32:42', '2025-03-07 17:32:42'),
(266, 28, 4, 'new_like', 'App\\Models\\Post', 68, 0, '2025-03-07 17:32:44', '2025-03-07 17:32:44'),
(267, 28, 4, 'new_like', 'App\\Models\\Post', 68, 0, '2025-03-07 17:33:34', '2025-03-07 17:33:34'),
(268, 21, 4, 'new_like', 'App\\Models\\Post', 84, 0, '2025-03-07 17:33:45', '2025-03-07 17:33:45'),
(269, 28, 32, 'new_like', 'App\\Models\\Post', 68, 0, '2025-03-07 17:34:02', '2025-03-07 17:34:02'),
(270, 28, 32, 'new_like', 'App\\Models\\Post', 69, 0, '2025-03-07 17:34:03', '2025-03-07 17:34:03'),
(271, 29, 32, 'new_like', 'App\\Models\\Post', 76, 0, '2025-03-07 17:34:17', '2025-03-07 17:34:17'),
(272, 29, 32, 'new_like', 'App\\Models\\Post', 75, 0, '2025-03-07 17:34:18', '2025-03-07 17:34:18'),
(273, 32, 4, 'new_like', 'App\\Models\\Post', 91, 0, '2025-03-07 17:39:11', '2025-03-07 17:39:11'),
(274, 4, 32, 'new_like', 'App\\Models\\Post', 90, 0, '2025-03-07 17:39:20', '2025-03-07 17:39:20'),
(275, 4, 32, 'new_like', 'App\\Models\\Post', 92, 0, '2025-03-07 17:39:36', '2025-03-07 17:39:36'),
(276, 4, 4, 'new_like', 'App\\Models\\Post', 92, 0, '2025-03-07 17:39:45', '2025-03-07 17:39:45'),
(277, 28, 4, 'new_like', 'App\\Models\\Post', 72, 0, '2025-03-07 17:40:48', '2025-03-07 17:40:48'),
(278, 3, 4, 'new_follow', 'App\\Models\\User', 3, 0, '2025-03-07 17:41:39', '2025-03-07 17:41:39'),
(279, 3, 4, 'new_like', 'App\\Models\\Post', 94, 0, '2025-03-07 17:41:56', '2025-03-07 17:41:56'),
(280, 32, 32, 'new_like', 'App\\Models\\Post', 91, 0, '2025-03-07 17:42:18', '2025-03-07 17:42:18'),
(281, 3, 32, 'new_like', 'App\\Models\\Post', 94, 0, '2025-03-07 17:42:46', '2025-03-07 17:42:46'),
(282, 3, 32, 'new_like', 'App\\Models\\Post', 93, 0, '2025-03-07 17:42:47', '2025-03-07 17:42:47'),
(283, 4, 33, 'new_follow', 'App\\Models\\User', 4, 0, '2025-03-07 17:46:17', '2025-03-07 17:46:17'),
(284, 3, 4, 'new_like', 'App\\Models\\Post', 93, 0, '2025-03-07 17:46:53', '2025-03-07 17:46:53'),
(285, 3, 4, 'new_like', 'App\\Models\\Post', 94, 0, '2025-03-07 17:47:15', '2025-03-07 17:47:15'),
(286, 4, 4, 'new_like', 'App\\Models\\Post', 92, 0, '2025-03-07 17:47:23', '2025-03-07 17:47:23'),
(287, 4, 33, 'new_like', 'App\\Models\\Post', 96, 0, '2025-03-07 17:48:40', '2025-03-07 17:48:40'),
(288, 4, 33, 'new_reply', 'App\\Models\\Post', 96, 1, '2025-03-07 17:48:46', '2025-03-07 17:48:59'),
(289, 28, 4, 'new_like', 'App\\Models\\Post', 98, 0, '2025-03-07 17:52:06', '2025-03-07 17:52:06'),
(290, 4, 34, 'new_follow', 'App\\Models\\User', 4, 0, '2025-03-09 21:47:17', '2025-03-09 21:47:17'),
(291, 3, 4, 'new_like', 'App\\Models\\Post', 93, 0, '2025-03-09 21:47:34', '2025-03-09 21:47:34'),
(292, 3, 4, 'new_like', 'App\\Models\\Post', 94, 0, '2025-03-09 21:47:52', '2025-03-09 21:47:52'),
(293, 3, 4, 'new_like', 'App\\Models\\Post', 93, 0, '2025-03-09 21:48:03', '2025-03-09 21:48:03'),
(294, 4, 4, 'new_like', 'App\\Models\\Post', 100, 0, '2025-03-09 21:48:25', '2025-03-09 21:48:25'),
(295, 3, 4, 'new_like', 'App\\Models\\Post', 93, 0, '2025-03-09 21:48:42', '2025-03-09 21:48:42'),
(296, 3, 4, 'new_like', 'App\\Models\\Post', 94, 0, '2025-03-09 21:48:42', '2025-03-09 21:48:42'),
(297, 3, 4, 'new_like', 'App\\Models\\Post', 93, 0, '2025-03-09 21:49:28', '2025-03-09 21:49:28'),
(298, 3, 4, 'new_like', 'App\\Models\\Post', 94, 0, '2025-03-09 21:49:28', '2025-03-09 21:49:28'),
(299, 3, 4, 'new_like', 'App\\Models\\Post', 93, 0, '2025-03-10 14:01:28', '2025-03-10 14:01:28'),
(300, 3, 34, 'new_follow', 'App\\Models\\User', 3, 0, '2025-03-10 14:02:00', '2025-03-10 14:02:00'),
(301, 3, 4, 'new_like', 'App\\Models\\Post', 94, 0, '2025-03-10 14:02:05', '2025-03-10 14:02:05'),
(302, 4, 34, 'new_follow', 'App\\Models\\User', 4, 0, '2025-03-14 18:38:27', '2025-03-14 18:38:27'),
(303, 3, 4, 'new_like', 'App\\Models\\Post', 104, 0, '2025-03-14 18:39:43', '2025-03-14 18:39:43'),
(304, 3, 4, 'new_like', 'App\\Models\\Post', 103, 0, '2025-03-14 18:40:13', '2025-03-14 18:40:13'),
(305, 3, 4, 'new_like', 'App\\Models\\Post', 102, 0, '2025-03-14 18:40:14', '2025-03-14 18:40:14'),
(306, 4, 4, 'new_like', 'App\\Models\\Post', 54, 0, '2025-03-14 18:40:44', '2025-03-14 18:40:44'),
(307, 3, 4, 'new_like', 'App\\Models\\Post', 101, 0, '2025-03-14 18:41:43', '2025-03-14 18:41:43'),
(308, 3, 34, 'new_follow', 'App\\Models\\User', 3, 0, '2025-03-14 18:42:02', '2025-03-14 18:42:02'),
(309, 3, 4, 'new_like', 'App\\Models\\Post', 101, 0, '2025-03-14 18:42:08', '2025-03-14 18:42:08'),
(310, 3, 4, 'new_like', 'App\\Models\\Post', 101, 0, '2025-03-14 18:42:11', '2025-03-14 18:42:11'),
(311, 4, 12, 'new_follow', 'App\\Models\\User', 4, 0, '2025-03-14 18:54:24', '2025-03-14 18:54:24'),
(312, 3, 4, 'new_like', 'App\\Models\\Post', 101, 0, '2025-03-14 18:55:17', '2025-03-14 18:55:17'),
(313, 3, 4, 'new_like', 'App\\Models\\Post', 102, 0, '2025-03-14 18:55:17', '2025-03-14 18:55:17'),
(314, 3, 4, 'new_like', 'App\\Models\\Post', 104, 0, '2025-03-14 18:58:51', '2025-03-14 18:58:51'),
(315, 3, 4, 'new_like', 'App\\Models\\Post', 103, 0, '2025-03-14 19:02:10', '2025-03-14 19:02:10'),
(317, 36, 12, 'new_like', 'App\\Models\\Post', 106, 0, '2025-03-14 19:25:48', '2025-03-14 19:25:48'),
(318, 36, 12, 'new_like', 'App\\Models\\Post', 107, 0, '2025-03-14 19:28:56', '2025-03-14 19:28:56'),
(319, 36, 4, 'new_follow', 'App\\Models\\User', 36, 0, '2025-03-14 19:30:28', '2025-03-14 19:30:28'),
(320, 36, 12, 'new_follow', 'App\\Models\\User', 36, 0, '2025-03-14 19:37:55', '2025-03-14 19:37:55'),
(321, 36, 4, 'new_follow', 'App\\Models\\User', 36, 0, '2025-03-14 19:39:14', '2025-03-14 19:39:14'),
(322, 36, 12, 'new_like', 'App\\Models\\Post', 108, 0, '2025-03-14 19:41:00', '2025-03-14 19:41:00'),
(323, 36, 4, 'new_follow', 'App\\Models\\User', 36, 0, '2025-03-14 19:42:38', '2025-03-14 19:42:38'),
(325, 36, 12, 'new_like', 'App\\Models\\Post', 109, 0, '2025-03-14 20:07:19', '2025-03-14 20:07:19'),
(327, 36, 12, 'new_like', 'App\\Models\\Post', 112, 0, '2025-03-14 20:10:49', '2025-03-14 20:10:49'),
(328, 36, 4, 'new_follow', 'App\\Models\\User', 36, 0, '2025-03-14 20:11:37', '2025-03-14 20:11:37'),
(329, 36, 4, 'new_follow', 'App\\Models\\User', 36, 0, '2025-03-14 20:15:30', '2025-03-14 20:15:30'),
(330, 36, 4, 'new_follow', 'App\\Models\\User', 36, 0, '2025-03-14 20:17:51', '2025-03-14 20:17:51'),
(331, 36, 4, 'new_follow', 'App\\Models\\User', 36, 0, '2025-03-16 19:01:39', '2025-03-16 19:01:39'),
(332, 36, 12, 'new_like', 'App\\Models\\Post', 113, 0, '2025-03-16 19:02:17', '2025-03-16 19:02:17'),
(333, 36, 12, 'new_like', 'App\\Models\\Post', 114, 0, '2025-03-16 19:05:44', '2025-03-16 19:05:44'),
(334, 36, 4, 'new_follow', 'App\\Models\\User', 36, 0, '2025-03-16 19:07:17', '2025-03-16 19:07:17'),
(335, 36, 12, 'new_like', 'App\\Models\\Post', 115, 0, '2025-03-16 19:08:13', '2025-03-16 19:08:13'),
(336, 36, 4, 'new_follow', 'App\\Models\\User', 36, 0, '2025-03-16 19:08:53', '2025-03-16 19:08:53'),
(337, 36, 12, 'new_like', 'App\\Models\\Post', 116, 0, '2025-03-16 19:10:30', '2025-03-16 19:10:30'),
(338, 36, 12, 'new_like', 'App\\Models\\Post', 117, 0, '2025-03-16 19:13:32', '2025-03-16 19:13:32'),
(339, 36, 4, 'new_reply', 'App\\Models\\Post', 117, 0, '2025-03-17 16:08:12', '2025-03-17 16:08:12'),
(340, 28, 28, 'new_reply', 'App\\Models\\Post', 118, 0, '2025-03-26 15:52:52', '2025-03-26 15:52:52'),
(341, 28, 4, 'new_reply', 'App\\Models\\Post', 118, 0, '2025-03-26 15:53:46', '2025-03-26 15:53:46'),
(342, 4, 36, 'new_follow', 'App\\Models\\User', 4, 0, '2025-03-26 16:02:11', '2025-03-26 16:02:11'),
(343, 4, 36, 'new_follow', 'App\\Models\\User', 4, 0, '2025-03-26 16:05:10', '2025-03-26 16:05:10'),
(344, 36, 12, 'new_follow', 'App\\Models\\User', 36, 0, '2025-03-29 18:21:32', '2025-03-29 18:21:32'),
(345, 28, 36, 'new_follow', 'App\\Models\\User', 28, 0, '2025-04-04 23:29:27', '2025-04-04 23:29:27'),
(346, 28, 4, 'new_follow', 'App\\Models\\User', 28, 0, '2025-04-04 23:31:46', '2025-04-04 23:31:46'),
(347, 4, 36, 'new_follow', 'App\\Models\\User', 4, 0, '2025-04-04 23:35:05', '2025-04-04 23:35:05'),
(348, 28, 4, 'new_follow', 'App\\Models\\User', 28, 0, '2025-04-04 23:36:42', '2025-04-04 23:36:42'),
(349, 28, 4, 'new_like', 'App\\Models\\Post', 118, 0, '2025-04-04 23:37:05', '2025-04-04 23:37:05'),
(350, 28, 4, 'new_follow', 'App\\Models\\User', 28, 0, '2025-04-04 23:37:46', '2025-04-04 23:37:46'),
(351, 36, 4, 'new_follow', 'App\\Models\\User', 36, 0, '2025-04-04 23:41:14', '2025-04-04 23:41:14'),
(352, 36, 4, 'new_follow', 'App\\Models\\User', 36, 0, '2025-04-04 23:41:37', '2025-04-04 23:41:37'),
(353, 4, 36, 'new_follow', 'App\\Models\\User', 4, 0, '2025-04-04 23:42:28', '2025-04-04 23:42:28'),
(354, 4, 28, 'new_follow', 'App\\Models\\User', 4, 0, '2025-04-06 08:46:33', '2025-04-06 08:46:33'),
(355, 36, 28, 'new_follow', 'App\\Models\\User', 36, 0, '2025-04-06 08:51:44', '2025-04-06 08:51:44'),
(356, 36, 4, 'new_follow', 'App\\Models\\User', 36, 0, '2025-04-06 08:54:46', '2025-04-06 08:54:46'),
(357, 4, 36, 'new_follow', 'App\\Models\\User', 4, 0, '2025-04-06 10:31:43', '2025-04-06 10:31:43'),
(358, 4, 36, 'new_follow', 'App\\Models\\User', 4, 0, '2025-04-06 10:33:01', '2025-04-06 10:33:01'),
(359, 4, 36, 'new_follow', 'App\\Models\\User', 4, 0, '2025-04-06 10:36:05', '2025-04-06 10:36:05'),
(360, 4, 36, 'new_follow', 'App\\Models\\User', 4, 0, '2025-04-06 10:36:15', '2025-04-06 10:36:15'),
(361, 4, 36, 'new_follow', 'App\\Models\\User', 4, 0, '2025-04-06 10:59:21', '2025-04-06 10:59:21'),
(362, 4, 36, 'new_follow', 'App\\Models\\User', 4, 0, '2025-04-06 10:59:40', '2025-04-06 10:59:40'),
(363, 4, 36, 'new_follow', 'App\\Models\\User', 4, 0, '2025-04-06 11:00:19', '2025-04-06 11:00:19'),
(364, 4, 36, 'new_follow', 'App\\Models\\User', 4, 0, '2025-04-06 11:00:39', '2025-04-06 11:00:39'),
(365, 4, 36, 'new_follow', 'App\\Models\\User', 4, 0, '2025-04-06 11:01:08', '2025-04-06 11:01:08'),
(366, 4, 36, 'new_follow', 'App\\Models\\User', 4, 0, '2025-04-06 11:02:47', '2025-04-06 11:02:47'),
(367, 4, 36, 'new_follow', 'App\\Models\\User', 4, 0, '2025-04-06 11:02:50', '2025-04-06 11:02:50'),
(368, 4, 36, 'new_follow', 'App\\Models\\User', 4, 0, '2025-04-06 11:02:53', '2025-04-06 11:02:53'),
(369, 4, 36, 'new_follow', 'App\\Models\\User', 4, 0, '2025-04-06 11:04:20', '2025-04-06 11:04:20'),
(370, 4, 36, 'new_follow', 'App\\Models\\User', 4, 0, '2025-04-06 11:08:14', '2025-04-06 11:08:14'),
(373, 3, 3, 'new_like', 'App\\Models\\Post', 103, 0, '2025-04-07 08:09:27', '2025-04-07 08:09:27'),
(374, 4, 4, 'mention', 'App\\Models\\Post', 119, 0, '2025-04-21 17:25:26', '2025-04-21 17:25:26'),
(375, 28, 36, 'new_reply', 'App\\Models\\Post', 118, 0, '2025-04-22 21:55:13', '2025-04-22 21:55:13'),
(376, 28, 36, 'new_reply', 'App\\Models\\Post', 118, 0, '2025-04-22 21:55:17', '2025-04-22 21:55:17');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('rashedlb606@gmail.com', '$2y$12$s/YVxFiDx.C9S1roViy89.4mEkfaXTpmc86To6RRpRLdsNx9WWNv.', '2025-02-08 03:06:02');

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

--
-- Dumping data for table `polls`
--

INSERT INTO `polls` (`id`, `post_id`, `expires_at`, `option1_text`, `option1_votes`, `option2_text`, `option2_votes`, `option3_text`, `option3_votes`, `option4_text`, `option4_votes`, `created_at`, `updated_at`) VALUES
(7, 27, '2025-02-06 11:52:42', 'الاحمر', 56, 'الاخضر', 54, 'الاصفر', 90, 'الاسود', 10, '2025-02-06 08:09:48', '2025-02-06 08:09:48'),
(12, 39, '2025-02-06 19:21:23', 'العربية', 8, 'الانجليزية', 3, NULL, 0, NULL, 0, '2025-02-06 15:57:35', '2025-02-06 16:21:23');

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

--
-- Dumping data for table `poll_votes`
--

INSERT INTO `poll_votes` (`id`, `user_id`, `poll_id`, `option_selected`, `created_at`, `updated_at`) VALUES
(17, 2, 12, '1', '2025-02-06 16:21:23', '2025-02-06 16:21:23');

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
(27, 1, 'ما هو لونك المفضل؟', '[]', 'caee8c33-884a-428c-a268-955a3a28922f', 'poll', '2025-02-06 08:09:48', '2025-02-06 08:09:48'),
(39, 2, 'favotite languge?', '[]', '39c1a81b-c939-444e-91dd-6a5fa97aadb1', 'poll', '2025-02-06 15:57:35', '2025-02-06 15:57:35'),
(44, 1, '', '[\"posts_images\\/1738946917_post_67a639652dd233.18533368.jpeg\",\"posts_images\\/1738946917_post_67a639652e5aa1.28055302.jpeg\",\"posts_images\\/1738946917_post_67a639652eb272.77683297.jpeg\",\"posts_images\\/1738946917_post_67a639652f0253.05012163.jpeg\"]', 'dbf16b71-716d-4dcd-ad5f-45685823104f', 'normal', '2025-02-07 13:48:37', '2025-02-07 13:48:37'),
(50, 4, 'كيف الحال', '[]', 'e173943c-2060-421d-ac78-30724b30489c', 'normal', '2025-02-07 22:37:23', '2025-02-07 22:37:23'),
(51, 4, 'اخباركم', '[]', 'fa6c9720-c4c3-43ec-b088-99ed981c63bb', 'normal', '2025-02-07 22:37:31', '2025-02-07 22:37:31'),
(52, 4, 'اعلومكم', '[]', 'c3385a7b-cdfb-47aa-ae74-2c2d2eb85f7c', 'normal', '2025-02-07 22:37:35', '2025-02-07 22:37:35'),
(53, 4, 'ان شاء الله', '[]', 'a0271b88-7bf3-4426-a2b9-ce804f874ef7', 'normal', '2025-02-07 22:37:42', '2025-02-07 22:37:42'),
(54, 4, 'حسبنا الله', '[]', '843d6b02-313b-4333-99b5-a3403d9448c4', 'normal', '2025-02-07 22:37:49', '2025-02-07 22:37:49'),
(55, 4, 'نبدا', '[]', '69994587-cd4f-46c2-99eb-65a2a0476cce', 'normal', '2025-02-07 22:37:56', '2025-02-07 22:37:56'),
(56, 6, 'اهلا بكم #مسقط', '[]', 'd43d7f46-b8e4-4bce-bbed-6eea58d46ceb', 'normal', '2025-02-08 06:49:36', '2025-02-08 06:49:36'),
(57, 6, 'hi', '[]', '55ca0971-6e7c-45b1-a905-1b62209cd1bd', 'normal', '2025-02-08 06:51:18', '2025-02-08 06:51:18'),
(58, 1, '3', '[]', 'dfdb129b-f9e5-43f1-96d2-49f0e2715354', 'normal', '2025-02-16 17:12:28', '2025-02-16 17:12:28'),
(60, 14, 'good evening', '[]', '06727d9d-cd55-4127-84b0-d2df9f9df76c', 'normal', '2025-02-17 18:23:07', '2025-02-17 18:23:07'),
(101, 3, 'هلا', '[]', '68f33281-9857-4f73-9807-9145e68a4d5b', 'normal', '2025-03-14 18:39:03', '2025-03-14 18:39:03'),
(102, 3, 'مرحبا', '[]', '6f4dd904-05dd-4bf4-8f3f-1ffea425d7b6', 'normal', '2025-03-14 18:39:08', '2025-03-14 18:39:08'),
(103, 3, 'اخباركم', '[]', '7bc15b31-3940-460f-b326-affb6787bb2b', 'normal', '2025-03-14 18:39:12', '2025-03-14 18:39:12'),
(104, 3, 'ان شاء الله بخير', '[]', '296d8667-5478-43d4-adf9-081060cc81d2', 'normal', '2025-03-14 18:39:19', '2025-03-14 18:39:19'),
(105, 4, 'مرحبا', '[]', 'c5e2c55b-7850-4b55-96e9-307130160de5', 'normal', '2025-03-14 18:40:29', '2025-03-14 18:40:29'),
(106, 36, 'السلام عليكم معاكم أسامة', '[]', '4d66bcd2-caf5-4fab-bce6-cc9e14a212f1', 'normal', '2025-03-14 19:25:23', '2025-03-14 19:25:23'),
(107, 36, 'منشور ثاني لأسامة', '[]', 'be1965c2-2d58-4fb9-b6db-7d4da1676adf', 'normal', '2025-03-14 19:28:26', '2025-03-14 19:28:26'),
(108, 36, 'منشور ثالث لأسامة', '[]', '1a283a4a-13de-4ce4-a495-7f0e562f8e85', 'normal', '2025-03-14 19:33:28', '2025-03-14 19:33:28'),
(109, 36, 'منشور رابع لأسامة', '[]', '41bcc7ec-dab3-4eae-9f4c-cf3f75572fa8', 'normal', '2025-03-14 20:06:36', '2025-03-14 20:06:36'),
(112, 36, 'منشور خامس لأسامة', '[]', 'bb71cf1e-2c0d-404a-ae4f-928370c34d2d', 'normal', '2025-03-14 20:10:29', '2025-03-14 20:10:29'),
(113, 36, 'أستاذ راشد كيف حالك؟', '[]', 'ab67c00c-8a0b-495e-ad48-f6000f62430f', 'normal', '2025-03-14 20:16:43', '2025-03-14 20:16:43'),
(114, 36, 'Hello 1', '[]', '90fc5ea6-c36f-446a-9887-b867f57afed6', 'normal', '2025-03-16 19:04:24', '2025-03-16 19:04:24'),
(115, 36, 'Hello 2', '[]', '2b73dfcc-e705-424f-9a37-0e262fabe24d', 'normal', '2025-03-16 19:07:50', '2025-03-16 19:07:50'),
(116, 36, 'Hello 3', '[]', '38270973-f35c-40cc-aae5-48a90e35800b', 'normal', '2025-03-16 19:10:14', '2025-03-16 19:10:14'),
(117, 36, 'Hello 5', '[]', '92d9a069-e881-4f91-b73a-384f7cf32d01', 'normal', '2025-03-16 19:12:11', '2025-03-16 19:12:11'),
(118, 28, 'kkk', '[]', '63642266-5e50-4ec5-b622-f8d1edb21d8e', 'normal', '2025-03-26 15:52:45', '2025-03-26 15:52:45'),
(119, 4, '@rashed', '[\"posts_images\\/1745256326_post_68067f86b8d907.08089266.jpg\"]', 'a0bca1c6-7471-4620-b7b7-2b26f280cf1c', 'normal', '2025-04-21 17:25:26', '2025-04-21 17:25:26');

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

--
-- Dumping data for table `post_likes`
--

INSERT INTO `post_likes` (`id`, `user_id`, `post_id`, `created_at`, `updated_at`) VALUES
(4, 1, 44, '2025-02-07 13:49:06', '2025-02-07 13:49:06'),
(18, 4, 44, '2025-02-07 23:42:26', '2025-02-07 23:42:26'),
(19, 4, 39, '2025-02-07 23:42:30', '2025-02-07 23:42:30'),
(20, 3, 55, '2025-02-08 07:26:41', '2025-02-08 07:26:41'),
(23, 1, 27, '2025-02-12 13:55:15', '2025-02-12 13:55:15'),
(25, 11, 27, '2025-02-15 15:22:56', '2025-02-15 15:22:56'),
(28, 19, 55, '2025-02-27 11:56:45', '2025-02-27 11:56:45'),
(46, 4, 55, '2025-03-02 18:27:01', '2025-03-02 18:27:01'),
(76, 4, 27, '2025-03-03 20:45:54', '2025-03-03 20:45:54'),
(90, 4, 58, '2025-03-07 17:29:04', '2025-03-07 17:29:04'),
(127, 4, 54, '2025-03-14 18:40:44', '2025-03-14 18:40:44'),
(131, 4, 101, '2025-03-14 18:55:17', '2025-03-14 18:55:17'),
(132, 4, 102, '2025-03-14 18:55:17', '2025-03-14 18:55:17'),
(133, 4, 104, '2025-03-14 18:58:51', '2025-03-14 18:58:51'),
(134, 4, 103, '2025-03-14 19:02:10', '2025-03-14 19:02:10'),
(145, 4, 118, '2025-04-04 23:37:05', '2025-04-04 23:37:05');

-- --------------------------------------------------------

--
-- Table structure for table `replies`
--

CREATE TABLE `replies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `reply_text` text DEFAULT NULL,
  `reply_image` varchar(255) DEFAULT NULL,
  `slug_id` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `replies`
--

INSERT INTO `replies` (`id`, `user_id`, `post_id`, `reply_text`, `reply_image`, `slug_id`, `created_at`, `updated_at`) VALUES
(2, 1, 27, 'ww', NULL, 'b12448f1-38e6-4468-8d8e-e4e3c769272f', '2025-02-06 10:05:43', '2025-02-06 10:05:43'),
(20, 4, 55, 'ع بركه الله', NULL, '33a52037-ef6e-4105-87e2-cf3c1b76b87b', '2025-02-08 02:45:35', '2025-02-08 02:45:35'),
(21, 4, 55, 'يالله', NULL, '1c59b469-0f06-49b3-a21d-88d8f2107639', '2025-02-08 02:51:40', '2025-02-08 02:51:40'),
(22, 1, 51, 'الحمدلله', NULL, 'c26d3ef9-af28-48a0-b0a9-ae1376409f00', '2025-02-12 14:20:16', '2025-02-12 14:20:16'),
(24, 4, 117, 'hello', NULL, 'dfca66bf-4bde-4d78-98b3-dc46db555400', '2025-03-17 16:08:12', '2025-03-17 16:08:12'),
(25, 28, 118, 'jjjj', NULL, '6b9fe14c-2d1f-48f4-90c9-9aa378e29a08', '2025-03-26 15:52:52', '2025-03-26 15:52:52'),
(26, 4, 118, 'kkkk', NULL, '46695c11-b358-4755-9c12-365a4f7ecb82', '2025-03-26 15:53:46', '2025-03-26 15:53:46'),
(29, 36, 118, 'reply test 1', NULL, '54797aaa-f672-4475-abca-a7c9867babd7', '2025-04-22 21:55:13', '2025-04-22 21:55:13'),
(30, 36, 118, 'reply test 2', NULL, '0f55d17c-4fbf-4291-853e-43681baf00f6', '2025-04-22 21:55:17', '2025-04-22 21:55:17');

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

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('6V6DxpUDpSfPY2zSG3venbNTlIiWNa7uEm3nvzZV', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoicHJyaENQVjQ0Rk1vRnlkVHFPaklsWWxsR1BOVEdNNGFnWEZ5ZEJUZCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyMToiaHR0cDovL2xvY2FsaG9zdDo4MDAwIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1739216907),
('8TSmAzwKHmkmbB7ZCcqXhEWupYFEv62wjCEj5ii3', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36 Edg/132.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoibHhrZ3dFQUtPVGhUdlBNdGJOUGJxeTBXSFc4dWI5aWhraEhPZTNJeiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyMToiaHR0cDovL2xvY2FsaG9zdDo4MDAwIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hZG1pbi9yZWdpc3RlciI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjM7fQ==', 1739113574),
('Gn3LONYwNiGebgeZPkXMFsGHecXRJO1hABcd4Vp7', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoicVEwczgxMUhMMmFUNVplTDZhUnByeTkydGxrTTJwOXMzM3YxSkJBcSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyMToiaHR0cDovL2xvY2FsaG9zdDo4MDAwIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9sb2dpbiI7fX0=', 1739113320),
('GYmHGzLPm6kTlCOzSNjt1i25g90Ylmw5DiDPsU0x', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiMmliUVVFc05mUVU3YnhvSjUxeVBrY0lSd29ONG5rV1hsdFZMb3l4TSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyMToiaHR0cDovL2xvY2FsaG9zdDo4MDAwIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjI6e2k6MDtzOjEwOiJfb2xkX2lucHV0IjtpOjE7czo2OiJlcnJvcnMiO31zOjM6Im5ldyI7YTowOnt9fXM6MTA6Il9vbGRfaW5wdXQiO2E6Mjp7czo2OiJfdG9rZW4iO3M6NDA6IjJpYlFVRXNOZlFVN2J4b0o1MXlQa2NJUndvTjRua1dYbHRWTG95eE0iO3M6NToibG9naW4iO3M6MTU6ImFtbWFyQGdtYWlsLmNvbSI7fXM6NjoiZXJyb3JzIjtPOjMxOiJJbGx1bWluYXRlXFN1cHBvcnRcVmlld0Vycm9yQmFnIjoxOntzOjc6IgAqAGJhZ3MiO2E6MTp7czo3OiJkZWZhdWx0IjtPOjI5OiJJbGx1bWluYXRlXFN1cHBvcnRcTWVzc2FnZUJhZyI6Mjp7czoxMToiACoAbWVzc2FnZXMiO2E6MTp7czo4OiJwYXNzd29yZCI7YToxOntpOjA7czo0OToiVGhlIHBhc3N3b3JkIGZpZWxkIG11c3QgYmUgYXQgbGVhc3QgOCBjaGFyYWN0ZXJzLiI7fX1zOjk6IgAqAGZvcm1hdCI7czo4OiI6bWVzc2FnZSI7fX19fQ==', 1739216881),
('UXjxzsGn8vklM2dVVIutqNtxX1Wt65Q9tbLU1W4W', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiVDRhYzNRV2pKN3ZCS1JoTGU0SVFmSmpIVUZycVpvdUVERzNKcVdHSiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1739217069);

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
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_scheduled_for_deletion` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `remember_token`, `role`, `is_ban`, `account_privacy`, `terms_accepted`, `last_activity`, `deleted_at`, `created_at`, `updated_at`, `is_scheduled_for_deletion`) VALUES
(1, 'Nathan Petersen', 'ammar', 'ammar@gmail.com', NULL, '$2y$12$hsSU5/0phTG3xY.yIt8/ke.kWcZ/aUgjactu6pZv7oBQqYxGdHXj2', 'PllrHeBp8rTTRaMVSkoVB2OzCb8ui00fwQcbe2RmApDXuYxwvPekhhzgazH1', 'user', 'no', 'private', 1, '2025-02-20 05:05:17', NULL, '2025-02-06 00:05:55', '2025-02-20 05:05:17', 0),
(2, 'muna saif', 'muna', 'muna@gmail.com', NULL, '$2y$12$6ZMS8zuIxEYjn2zk5w6aCuJxxSBk9EDcQY0ylzsuGeCMqLMHWIzXK', 'bpIMChgiWLuYRY0k7nriGZfIAFkiU8Pv0cB2JjahlhHojmBQz8B85I00xyhj', 'supervisor', 'no', 'public', 1, '2025-02-06 16:26:13', NULL, '2025-02-06 10:53:46', '2025-04-07 08:08:10', 0),
(3, 'tadween', 'admin', 'admin@gmail.com', NULL, '$2y$12$k9C6cfjNUCUvBmGEaf8StO8Cp8Np5b9j055CO/RuRtwY5.Mqur8r.', 'ApRhAPpSvJHUZhFp9aXPtREUm0n847c8SoBJc9c6wy83Zb5UCVrdhTeS8KS6', 'admin', 'no', 'public', 1, '2025-04-07 09:09:00', NULL, '2025-02-07 04:33:17', '2025-04-07 09:09:00', 0),
(4, 'راشد', 'rashed', 'rashedlb606@gmail.com', NULL, '$2y$12$uUFP23bPz6US2miPR7wle.NxXKMmfsu/8DuS2v5NXGrvzrE8XOaoa', 'LAFfpLordApFAoKqeNCwxEyO1byUUJcbR739NkVUDQp6n1u8gOadPDSpxoTl', 'user', 'no', 'private', 1, '2025-06-06 17:22:29', NULL, '2025-02-07 19:53:43', '2025-06-06 17:22:29', 0),
(5, 'Mohamed', 'M', 'mohmed0530459@gmail.com', NULL, '$2y$12$87JWyxCckfVAVgS9sVpoaO7QNE7Us9aM6Hh6AZON/IhvF..zzVuMi', 'fdLaiZsrlfFMNyRuzO32VjAQmClwJDByTVbOWPV1KvkXIhoDWyc1DstfRhfe', 'user', 'no', 'public', 1, '2025-02-07 22:01:06', NULL, '2025-02-07 22:00:59', '2025-02-07 22:01:06', 0),
(6, 'Hussam', 'hussam', 'me@hussam.pw', NULL, '$2y$12$./OypoGSu/oifB7osrzD9OBr6rcYxPQVdK3whdqYVIG84LpjOXPv6', 'JWXST4M8TUvTasYQYAm6auy53MpH0ur4VNQ9Rr6H2aeLuHFgWUlF0rkTmnaa', 'user', 'no', 'public', 1, '2025-02-08 06:52:00', NULL, '2025-02-08 06:48:53', '2025-02-08 06:52:00', 0),
(7, 'hazem', 'elsayed', 'hazem.elsayed8@gmail.com', NULL, '$2y$12$hGbqofTvQcm9f1VczTGXeuYAN4Er3j8NPpVDkwmdhH0rYuVgdtQMG', 'ywoGB3UBFckfpLSH0ydFoqfXa7TbHBE3gPutxhc2PLngwwenqiyNMSB4HTo3', 'user', 'no', 'public', 1, '2025-02-08 07:56:32', NULL, '2025-02-08 07:56:30', '2025-02-08 07:56:32', 0),
(8, 'Ahmed Ragab', 'ragaboka', 'ragaboka543@gmail.com', NULL, '$2y$12$5xJVg8lVC76sfIqnZ/Ei8upR.HDNq8mGvN.j2Pk4aBeWiarRtr0uS', 'r3BfGzGtdSe706Efc3bCWBSkIrpm6vQRktdteVONMrFKGJEHS2FIQo2S3XAA', 'user', 'no', 'public', 1, '2025-02-08 11:41:50', NULL, '2025-02-08 08:38:08', '2025-02-08 11:41:50', 0),
(9, 'Sh', 'A', 'Shoog77@gmail.com', NULL, '$2y$12$EPnNhUi/DYE1NF9Uk/DCT.D58Al/I00ZI8uGwfpR7zJnhHbsVf1ES', 'J81XHANVoDq9R3nyr3OkQ5djREQLKCpaqvHD3fN6AAzuHxydgo2Qd401ZH94', 'user', 'no', 'public', 1, NULL, NULL, '2025-02-08 12:40:26', '2025-02-08 12:40:26', 0),
(10, 'test', 'test', 'test@gmail.com', NULL, '$2y$12$wzM/afIvSR34nExW.Wh83.KqaJfuOi4H.OyNpO4GZcdM7qw5C30Sm', 'zjRj6f97QjSFwtYI654adyGII0yHMxDU96abtuztcg7HwnR3daWMVKtNvULt', 'user', 'no', 'public', 1, '2025-02-11 09:03:48', NULL, '2025-02-11 09:03:24', '2025-02-11 09:03:48', 0),
(11, 'aa', 'aa', 'aa@gmail.com', NULL, '$2y$12$qz4hSmGlr0VV3khJuHpQpe8JsnkAwPOIXraUjgaN/7McRRQrDcvvq', '1D7hnfjwuf7IYvJimqME9GdyPU7hnBsU2kE30U3IAKPg556cR81SVCXxVdHw', 'user', 'no', 'public', 1, '2025-02-15 15:41:26', NULL, '2025-02-15 15:22:34', '2025-02-15 15:41:26', 0),
(13, 'Ahmad Ibrahim', 'ahmad', 'ahmad@gmail.com', NULL, '$2y$12$jusJtaBbPT8mvoa.3kmQu.f37uDiuWRITDWt99WkS8vrXCnA/jqO2', 'gboDy3xKrFDnM2YqzeLkwBxr938SB61fffdAml2gWdJArTFyz8z2Y2llzC84', 'user', 'no', 'public', 1, '2025-02-17 14:50:28', NULL, '2025-02-17 14:38:53', '2025-02-17 14:50:28', 0),
(14, 'Rose Moustafa', 'rose', 'meral@gmail.com', NULL, '$2y$12$wNxOPP4K70eRliRZUnWReuGDQBluBsKsZVuN8cHPt9hJjw/FQ2f7G', 'PwTcCXH8SpTQ4T3n667Y1ikSA3F6cLlA0hTcQBQdRFFVmYdd8GEt826xP0LX', 'user', 'no', 'private', 1, '2025-02-19 15:50:48', NULL, '2025-02-17 18:19:51', '2025-02-19 16:08:37', 0),
(15, 'ممم', 'pppppp', 'jdjdjdjdjj@gmail.com', NULL, '$2y$12$BAJgkV2p25zcbzFPfyQB3OeBw4dXTaIY2/ykBOmPTXPy6zx91CG4K', 'xtYNgRSrusWjeh7gse9iMqRYlOLi1rloOr2N8Z5q7ZBOm20doCOCZIlDQHO6', 'user', 'no', 'public', 1, '2025-02-20 05:44:34', NULL, '2025-02-20 05:16:13', '2025-02-20 05:44:34', 0),
(17, 'aaaa', 'aaaa', 'lslsl@gmail.com', NULL, '$2y$12$TBW.Y5TK/zNI75OmQvI3FetLktMDMAl2Pzo/9RLojLFdnPo69N352', '8nqMy2yPqjwtMQPfZSLLkbdFdMmFdn5Smq6QMJbv8hHDr0ffveWNyMc2YbPm', 'user', 'no', 'private', 1, '2025-02-20 16:28:55', NULL, '2025-02-20 16:28:53', '2025-02-20 17:03:18', 0),
(18, 'bbbb', 'bbbb', 'bbbb@gmail.com', NULL, '$2y$12$WyURRTt8PS3N1ON5locwBuqf41DmCIrR0Ub1tT012NC0lm4DBy7BK', '8IkxiptdznQYKggw6Dco6k5ChqOOVIiISozDI4dO4G8w7R0IbB8yxm0he69n', 'user', 'no', 'private', 1, '2025-02-20 17:01:31', NULL, '2025-02-20 16:30:08', '2025-02-20 17:01:31', 0),
(19, 'wwww', 'wwww', 'wwww@gmail.com', NULL, '$2y$12$OqiMm3mi0lROafU4T5mVLOnd1yiWGtcrJ7z7QRbKk4WNWjiSWE2yW', 'asj5Pr5UwFpXxpgsoDwVmoJSo29qNxryYrsZeLuRRW8ow5m8ZDwoORYUAwl8', 'user', 'no', 'private', 1, '2025-03-02 21:52:55', NULL, '2025-02-20 16:31:11', '2025-03-02 21:52:55', 0),
(20, 'oooo', 'oooo', 'oooo@gmail.com', NULL, '$2y$12$qE7n68TwbgFk0GE/OwuDROkex6p.wj/i44PSPlItlc.wdflQlM/We', 'EM6M37pDIY1myQhlvYOmRLm2wHc6HFnKO1MqNEZKxfD3owGqOVRxxxA9NFie', 'user', 'no', 'public', 1, '2025-02-20 16:33:44', NULL, '2025-02-20 16:33:40', '2025-02-20 16:33:44', 0),
(21, 'gggg', 'gggg', 'gggg@gmail.com', NULL, '$2y$12$dhcOLEBFSrsCr31r4khQgeJvP7bWhQzjDTHx.oQxOhVrOOmr4l2kO', '0ue8DkBSu0CMgDjNlClo0m4XL913FVM8GMdADNSxb1hczJBc3MtUAEe95YMB', 'user', 'no', 'public', 1, '2025-03-02 21:53:54', NULL, '2025-02-20 16:34:43', '2025-03-02 21:54:04', 0),
(22, 'uuuu', 'uuuu', 'uuuu@gmail.com', NULL, '$2y$12$Ty1q7GkvVnDjETXEvrl3AurMv4b/lyp0dtOkN6AzImNUVdhKoSxRG', 'JIb4yzFbJHmi1ugZQbGuBwaXR3a4eZhKbbwh94pYRRvn3ys4R6fSpBormsqE', 'user', 'no', 'public', 1, '2025-02-20 16:36:19', NULL, '2025-02-20 16:36:17', '2025-02-20 16:36:19', 0),
(23, 'Mohammad', 'mohammad', 'm@gmail.com', NULL, '$2y$12$oGizyojMnZq5wffy/hPuaeX0P/k5P6lYGrYLyC/d4Xho8NYNASWeq', 'ZGOMKFLaDEVSvVQWnoJZFrgJ4hj7652rAAaZG8piRsPzZJhJEVkrQvCXDIjd', 'user', 'no', 'private', 1, '2025-02-20 19:31:17', NULL, '2025-02-20 19:22:02', '2025-02-20 19:31:17', 0),
(24, 'Kholoud', 'kholoud', 'kh@gmail.com', NULL, '$2y$12$NLuKTx2DsyYIMKaBhdsuHOvrmNDX8TVsP70uYQ1lWkMDHQhdB1qcO', 'DzbHNF1eXcYPnrvVawqEwOOLgBaA5Viz2xj4XOLicQhHpzXVYbNUdFsQ9diK', 'user', 'no', 'public', 1, '2025-02-20 19:31:51', NULL, '2025-02-20 19:31:48', '2025-02-20 19:31:51', 0),
(25, 'llll', 'llll', 'llll@gmail.com', NULL, '$2y$12$qhFyHU8Nj.bKuelr1YnyOOo9lWbUQNFOwgN5m0iqbnTk/ldF36ACK', 'DTBj2Ncm0u3IOkn9HaVl3BCvPW6D46DXDyDOTHznLxOAz96q6TMldUXGoyAA', 'user', 'no', 'private', 1, '2025-02-23 09:38:41', NULL, '2025-02-23 09:29:33', '2025-02-23 09:38:41', 0),
(26, 'mmmm', 'mmmm', 'mmmm@gmail.com', NULL, '$2y$12$Bz0reFtEhbkxb4eRVl0q1OT6El3mOBYZFA0/QaPP..mjCI3VqV1VW', 'mzcrWsCV468nVBWMebjNscwyPzU1lC86CNvUjQSG1k6vZLpoiYdqdBfwX1ig', 'user', 'no', 'private', 1, '2025-02-23 15:16:47', NULL, '2025-02-23 09:32:19', '2025-02-23 15:16:47', 0),
(27, 'fahed', 'fahed', 'jfjrj@fjjr.com', NULL, '$2y$12$8m/A2d28PkEbT57o46Zj1egWWnA4tJjDnTxkHl50DZxpMHUdtwRGy', 'bDiW0gHQI9s4raBs49ET38ByadAhh5NkzNvF1ZDvNIrcScXGCvqhmV2EBJN6', 'user', 'no', 'public', 1, '2025-03-01 11:55:11', NULL, '2025-03-01 11:32:40', '2025-03-01 11:55:11', 0),
(28, 'omer', 'omer', 'kdjrj@ckdkd.com', NULL, '$2y$12$8Em/PjajTVbb64OJdkK9iu0FPDv9nvapFZhLJpqjdf.tcVh2YJrPq', '4Y6WVG9LgxnIFEThJL048g1qVhjId8BbHBZAEqxx3VPkh9YZG8mRiCheW0xS', 'user', 'no', 'public', 1, '2025-04-06 09:05:34', NULL, '2025-03-01 11:33:34', '2025-04-06 09:05:34', 0),
(29, 'saed', 'saed', 'jejrj@fjjfj.com', NULL, '$2y$12$SLBSwlVA7g4XqiPpkRzXSe8sXx0ceo4u/XZGPzBWCA1AiC99vTddm', 'xviamAMFbvEeZMbmmymbBybda0qcKl7wzsfM8sw4TW93jqPSpNm9N9zChGaV', 'user', 'no', 'public', 1, '2025-03-02 18:31:03', NULL, '2025-03-01 11:36:54', '2025-03-02 18:31:03', 0),
(30, 'nadr', 'nadr', 'nadr@fjjf.com', NULL, '$2y$12$fMK5qdHoqmfFVU7iM265ROOGkKR5kwAesZaZ0KFtwBsnhA1skm7CG', 'Fv7VbienvEAFQN2utJ1d6sPBsdRP3wBYWtUZEpol5T7r1Sh5GZcY6r69dd9k', 'user', 'no', 'private', 1, '2025-03-07 17:53:37', NULL, '2025-03-03 20:00:04', '2025-03-07 17:53:52', 0),
(31, 'mahmoud', 'mahmoud', 'mahmoud@gmail.com', NULL, '$2y$12$E.XOfC1wZmYuy/7l3SqdtOaP.fJID4sGG7jzvcnEnaZnIgFrDcgE.', 'g9XsdaDhCCsRjXTmB4fQNSguTG0sDpOBibC5IuPdnVXcayPaQb4YFpg2sIZz', 'user', 'no', 'public', 1, '2025-03-04 15:20:57', NULL, '2025-03-04 15:14:32', '2025-03-04 15:20:57', 0),
(32, 'vvvv', 'vvvv', 'vvvv@fjur.com', NULL, '$2y$12$TBNYsTNOjBEQbmmNQP3gNe8aeQX28385VvWsoFzXqYEZy/gf9eJ7e', 'RObCrRRBxA4JijZxTgARFdX7IVmnIXduvgrXoShfu37Jh5wYiUzgvlVltVWL', 'user', 'no', 'public', 1, '2025-03-07 17:42:47', NULL, '2025-03-07 17:20:29', '2025-03-07 17:42:47', 0),
(33, 'zzzz', 'zzzz', 'zzzz@jrjriir.com', NULL, '$2y$12$bmrdumpVul0PYIa7riaFue3WLO1M8BW3NwLRA5SYsuFTucGBt6zOC', 'eOqPFZRP6nRIniSo9ZlimSiPkDFp4X97PzJQMabNpOP6Sb33rJ2oDy1JNU81', 'user', 'no', 'public', 1, '2025-03-07 17:51:18', NULL, '2025-03-07 17:46:02', '2025-03-07 17:51:18', 0),
(35, 'Ddd', 'Hh', 'hh@gmail.com', NULL, '$2y$12$LSibPbLweA5EvsKx/OIPDulLSB2GOvhuxrhDTFIBbTn/37wTAwZMK', '0FJ73mM8VDR1FQSk6swMF779qX7gfUjGqPBUHzVlKPgjlGlayghXR8dDFBcS', 'user', 'no', 'public', 1, '2025-03-14 10:54:56', NULL, '2025-03-14 10:54:52', '2025-03-14 10:54:56', 0),
(36, 'Osama', 'osama', 'osama@gmail.com', NULL, '$2y$12$VkJhbsU0UpugACWI74OPpebVMbwjAhisIYIN6Pmr0NCooHGoVqmNy', 'HVzewASpNhx5tsO41hWsiXCZMu57nRjn27LutnrPJbEEfWmIfuIPON9z6xqv', 'user', 'no', 'public', 1, '2025-04-27 19:11:40', NULL, '2025-03-14 19:24:58', '2025-04-27 19:11:40', 0),
(38, 'hhh', 'qqqq', 'jeuruud@djjr.com', NULL, '$2y$12$pGASax1RyRvynJ2tX/eBJ.BoV1hDMCMXeQHw7RLEkKjAFdbMyeHDe', 'eS8w1VNwSjm5GjP8DGnYZ1DtJ9YLdFZyC7UWF5JpOKvY8ytEruDATMo3loI1', 'user', 'no', 'public', 1, '2025-04-09 09:53:11', NULL, '2025-04-09 09:52:56', '2025-04-09 09:53:11', 0);

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
(1, 1, NULL, 'background_images/1738957233_bg_67a661b17b1055.53348280.png', 'cover_images/1738957233_cover_67a661b17afcf0.51570002.jpeg', NULL, NULL, NULL, NULL, '2025-02-06 00:05:55', '2025-02-07 19:40:33'),
(2, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-06 10:53:46', '2025-02-06 10:53:46'),
(3, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-07 04:33:17', '2025-02-07 04:33:17'),
(4, 4, NULL, NULL, 'cover_images/1740400463_cover_67bc674f132528.14915507.jpeg', 'لا اله الا الله محمد رسول الله', 'male', 'السعوديه', NULL, '2025-02-07 19:53:43', '2025-04-29 19:48:52'),
(5, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-07 22:00:59', '2025-02-07 22:00:59'),
(6, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-08 06:48:53', '2025-02-08 06:48:53'),
(7, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-08 07:56:30', '2025-02-08 07:56:30'),
(8, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-08 08:38:08', '2025-02-08 08:38:08'),
(9, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-08 12:40:26', '2025-02-08 12:40:26'),
(10, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-11 09:03:24', '2025-02-11 09:03:24'),
(11, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-15 15:22:35', '2025-02-15 15:22:35'),
(13, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-17 14:38:53', '2025-02-17 14:38:53'),
(14, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-17 18:19:51', '2025-02-17 18:19:51'),
(15, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-20 05:16:13', '2025-02-20 05:16:13'),
(17, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-20 16:28:53', '2025-02-20 16:28:53'),
(18, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-20 16:30:08', '2025-02-20 16:30:08'),
(19, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-20 16:31:11', '2025-02-20 16:31:11'),
(20, 20, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-20 16:33:40', '2025-02-20 16:33:40'),
(21, 21, NULL, NULL, 'cover_images/1740400552_cover_67bc67a82fef30.54562447.jpeg', NULL, NULL, NULL, NULL, '2025-02-20 16:34:43', '2025-02-24 12:35:52'),
(22, 22, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-20 16:36:17', '2025-02-20 16:36:17'),
(23, 23, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-20 19:22:02', '2025-02-20 19:22:02'),
(24, 24, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-20 19:31:48', '2025-02-20 19:31:48'),
(25, 25, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-23 09:29:33', '2025-02-23 09:29:33'),
(26, 26, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-23 09:32:19', '2025-02-23 09:32:19'),
(27, 27, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-03-01 11:32:40', '2025-03-01 11:32:40'),
(28, 28, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-03-01 11:33:34', '2025-03-01 11:33:34'),
(29, 29, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-03-01 11:36:54', '2025-03-01 11:36:54'),
(30, 30, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-03-03 20:00:04', '2025-03-03 20:00:04'),
(31, 31, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-03-04 15:14:32', '2025-03-04 15:14:32'),
(32, 32, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-03-07 17:20:29', '2025-03-07 17:20:29'),
(33, 33, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-03-07 17:46:02', '2025-03-07 17:46:02'),
(35, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-03-14 10:54:52', '2025-03-14 10:54:52'),
(36, 36, NULL, NULL, 'cover_images/1743933194_cover_67f24f0a93f2f5.62083147.jpeg', NULL, NULL, NULL, NULL, '2025-03-14 19:24:58', '2025-04-06 09:53:14'),
(38, 38, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-04-09 09:52:56', '2025-04-09 09:52:56');

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
  ADD UNIQUE KEY `unique_follower_following` (`follower_id`,`following_id`),
  ADD KEY `follows_follower_id_foreign` (`follower_id`),
  ADD KEY `follows_following_id_foreign` (`following_id`);

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
  ADD KEY `replies_post_id_foreign` (`post_id`);

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
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_profiles`
--
ALTER TABLE `user_profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_profiles_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blocked_users`
--
ALTER TABLE `blocked_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `follows`
--
ALTER TABLE `follows`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=377;

--
-- AUTO_INCREMENT for table `polls`
--
ALTER TABLE `polls`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `poll_votes`
--
ALTER TABLE `poll_votes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `post_likes`
--
ALTER TABLE `post_likes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;

--
-- AUTO_INCREMENT for table `replies`
--
ALTER TABLE `replies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `user_profiles`
--
ALTER TABLE `user_profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

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
  ADD CONSTRAINT `replies_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `replies_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_profiles`
--
ALTER TABLE `user_profiles`
  ADD CONSTRAINT `user_profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
