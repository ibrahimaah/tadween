-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 27, 2025 at 11:51 AM
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
(4, 26, 27, 0, 0, '2025-03-28 06:38:38', '2025-03-28 06:38:38'),
(5, 27, 26, 0, 1, '2025-03-28 07:17:56', '2025-03-28 07:18:08'),
(7, 30, 26, 1, 0, '2025-04-16 15:51:04', '2025-04-16 15:51:04');

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
(10, 25, 26, 'hello', 0, '2025-03-23 11:13:48', '2025-03-23 11:13:48'),
(11, 26, 25, 'how is it going?', 0, '2025-03-23 11:14:30', '2025-03-23 11:14:30');

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
(12, '2025_02_06_181520_create_poll_votes_table', 2),
(13, '2025_03_19_160954_create_blocked_users_table', 3),
(15, '2025_04_07_121338_add_soft_delete_and_deletion_schedule_to_users', 4),
(16, '2025_05_02_194625_create_comments_table', 5),
(17, '2018_11_06_222923_create_transactions_table', 6),
(18, '2018_11_07_192923_create_transfers_table', 6),
(19, '2018_11_15_124230_create_wallets_table', 6),
(20, '2021_11_02_202021_update_wallets_uuid_table', 6),
(21, '2023_12_30_113122_extra_columns_removed', 6),
(22, '2023_12_30_204610_soft_delete', 6),
(23, '2024_01_24_185401_add_extra_column_in_transfer', 6),
(24, '2025_06_09_083344_add_capture_id_to_transactions_table', 7),
(26, '2025_06_09_083345_add_payment_method_to_transactions_table', 8),
(27, '2025_06_09_083346_add_status_to_transactions_table', 9);

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
(79, 15, 16, 'new_follow', 'App\\Models\\User', 15, 0, '2025-02-20 17:18:31', '2025-02-20 17:18:31'),
(80, 16, 15, 'new_follow', 'App\\Models\\User', 16, 0, '2025-02-20 17:22:44', '2025-02-20 17:22:44'),
(81, 15, 16, 'new_follow', 'App\\Models\\User', 15, 0, '2025-02-20 17:24:04', '2025-02-20 17:24:04'),
(82, 16, 15, 'new_follow', 'App\\Models\\User', 16, 0, '2025-02-20 17:33:16', '2025-02-20 17:33:16'),
(83, 15, 16, 'new_follow', 'App\\Models\\User', 15, 0, '2025-02-22 07:08:12', '2025-02-22 07:08:12'),
(84, 15, 16, 'new_follow', 'App\\Models\\User', 15, 0, '2025-02-22 07:18:04', '2025-02-22 07:18:04'),
(85, 16, 15, 'new_follow', 'App\\Models\\User', 16, 0, '2025-02-22 08:17:47', '2025-02-22 08:17:47'),
(86, 16, 15, 'new_follow', 'App\\Models\\User', 16, 0, '2025-02-22 08:20:19', '2025-02-22 08:20:19'),
(87, 16, 15, 'new_follow', 'App\\Models\\User', 16, 0, '2025-02-22 08:49:56', '2025-02-22 08:49:56'),
(88, 15, 16, 'new_follow', 'App\\Models\\User', 15, 0, '2025-02-22 10:29:12', '2025-02-22 10:29:12'),
(89, 15, 16, 'new_follow', 'App\\Models\\User', 15, 0, '2025-02-22 10:29:47', '2025-02-22 10:29:47'),
(90, 15, 16, 'new_follow', 'App\\Models\\User', 15, 0, '2025-02-22 10:29:52', '2025-02-22 10:29:52'),
(91, 16, 15, 'new_follow', 'App\\Models\\User', 16, 0, '2025-02-22 10:34:29', '2025-02-22 10:34:29'),
(92, 15, 16, 'new_follow', 'App\\Models\\User', 15, 0, '2025-02-22 10:40:08', '2025-02-22 10:40:08'),
(93, 15, 16, 'new_follow', 'App\\Models\\User', 15, 0, '2025-02-22 10:41:19', '2025-02-22 10:41:19'),
(94, 15, 16, 'new_follow', 'App\\Models\\User', 15, 0, '2025-02-22 10:42:59', '2025-02-22 10:42:59'),
(95, 16, 15, 'new_follow', 'App\\Models\\User', 16, 0, '2025-02-22 10:44:35', '2025-02-22 10:44:35'),
(96, 15, 17, 'new_follow', 'App\\Models\\User', 15, 0, '2025-02-22 10:48:15', '2025-02-22 10:48:15'),
(97, 15, 16, 'new_follow', 'App\\Models\\User', 15, 0, '2025-02-22 10:49:03', '2025-02-22 10:49:03'),
(98, 15, 17, 'new_follow', 'App\\Models\\User', 15, 0, '2025-02-22 10:50:29', '2025-02-22 10:50:29'),
(99, 16, 15, 'new_follow', 'App\\Models\\User', 16, 0, '2025-02-22 14:35:22', '2025-02-22 14:35:22'),
(100, 15, 16, 'new_follow', 'App\\Models\\User', 15, 0, '2025-02-23 06:52:52', '2025-02-23 06:52:52'),
(101, 15, 16, 'new_follow', 'App\\Models\\User', 15, 0, '2025-02-23 06:53:25', '2025-02-23 06:53:25'),
(102, 15, 16, 'new_follow', 'App\\Models\\User', 15, 0, '2025-02-23 06:55:24', '2025-02-23 06:55:24'),
(103, 15, 16, 'new_follow', 'App\\Models\\User', 15, 0, '2025-02-23 06:55:33', '2025-02-23 06:55:33'),
(104, 15, 16, 'new_follow', 'App\\Models\\User', 15, 0, '2025-02-23 06:56:08', '2025-02-23 06:56:08'),
(105, 16, 15, 'new_follow', 'App\\Models\\User', 16, 0, '2025-02-23 13:15:04', '2025-02-23 13:15:04'),
(106, 16, 15, 'new_follow', 'App\\Models\\User', 16, 0, '2025-02-23 13:15:22', '2025-02-23 13:15:22'),
(107, 16, 15, 'new_follow', 'App\\Models\\User', 16, 0, '2025-02-23 13:17:25', '2025-02-23 13:17:25'),
(108, 16, 15, 'new_follow', 'App\\Models\\User', 16, 0, '2025-02-23 13:23:08', '2025-02-23 13:23:08'),
(109, 16, 15, 'new_follow', 'App\\Models\\User', 16, 0, '2025-02-23 13:23:13', '2025-02-23 13:23:13'),
(110, 16, 15, 'new_follow', 'App\\Models\\User', 16, 0, '2025-02-23 13:25:35', '2025-02-23 13:25:35'),
(111, 16, 15, 'new_follow', 'App\\Models\\User', 16, 1, '2025-02-23 13:27:21', '2025-02-24 08:37:21'),
(112, 15, 16, 'new_follow', 'App\\Models\\User', 15, 0, '2025-02-23 13:49:51', '2025-02-23 13:49:51'),
(113, 15, 16, 'new_reply', 'App\\Models\\Post', 76, 0, '2025-02-24 08:11:29', '2025-02-24 08:11:29'),
(114, 15, 16, 'new_like', 'App\\Models\\Post', 76, 0, '2025-02-24 08:12:16', '2025-02-24 08:12:16'),
(115, 15, 16, 'new_like', 'App\\Models\\Post', 75, 0, '2025-02-24 08:12:50', '2025-02-24 08:12:50'),
(116, 15, 16, 'new_follow', 'App\\Models\\User', 15, 0, '2025-02-24 10:07:49', '2025-02-24 10:07:49'),
(117, 15, 16, 'new_reply', 'App\\Models\\Post', 77, 0, '2025-02-25 11:08:46', '2025-02-25 11:08:46'),
(118, 16, 15, 'new_follow', 'App\\Models\\User', 16, 0, '2025-02-25 12:46:41', '2025-02-25 12:46:41'),
(119, 17, 16, 'new_like', 'App\\Models\\Post', 79, 0, '2025-02-25 13:42:33', '2025-02-25 13:42:33'),
(120, 15, 16, 'new_follow', 'App\\Models\\User', 15, 0, '2025-02-25 14:03:09', '2025-02-25 14:03:09'),
(121, 15, 17, 'new_follow', 'App\\Models\\User', 15, 0, '2025-02-25 14:05:30', '2025-02-25 14:05:30'),
(122, 17, 15, 'new_follow', 'App\\Models\\User', 17, 0, '2025-02-25 14:06:32', '2025-02-25 14:06:32'),
(123, 17, 15, 'new_like', 'App\\Models\\Post', 79, 0, '2025-02-25 14:40:46', '2025-02-25 14:40:46'),
(124, 15, 18, 'new_like', 'App\\Models\\Post', 77, 0, '2025-02-25 14:42:23', '2025-02-25 14:42:23'),
(125, 16, 18, 'new_follow', 'App\\Models\\User', 16, 0, '2025-02-25 14:42:41', '2025-02-25 14:42:41'),
(126, 15, 16, 'new_like', 'App\\Models\\Post', 77, 0, '2025-02-25 14:43:20', '2025-02-25 14:43:20'),
(127, 16, 15, 'new_like', 'App\\Models\\Post', 80, 0, '2025-02-25 14:57:41', '2025-02-25 14:57:41'),
(128, 15, 18, 'new_follow', 'App\\Models\\User', 15, 0, '2025-02-25 14:58:13', '2025-02-25 14:58:13'),
(129, 16, 18, 'new_follow', 'App\\Models\\User', 16, 0, '2025-02-25 15:09:07', '2025-02-25 15:09:07'),
(130, 16, 16, 'new_like', 'App\\Models\\Post', 80, 0, '2025-02-25 15:10:04', '2025-02-25 15:10:04'),
(131, 15, 16, 'new_like', 'App\\Models\\Post', 77, 0, '2025-02-26 13:45:39', '2025-02-26 13:45:39'),
(132, 15, 18, 'new_follow', 'App\\Models\\User', 15, 0, '2025-02-26 14:33:12', '2025-02-26 14:33:12'),
(133, 16, 15, 'new_follow', 'App\\Models\\User', 16, 0, '2025-02-26 14:33:51', '2025-02-26 14:33:51'),
(134, 16, 15, 'new_like', 'App\\Models\\Post', 80, 0, '2025-02-26 14:34:18', '2025-02-26 14:34:18'),
(135, 16, 18, 'new_follow', 'App\\Models\\User', 16, 0, '2025-02-26 14:34:50', '2025-02-26 14:34:50'),
(136, 16, 16, 'new_like', 'App\\Models\\Post', 80, 0, '2025-02-26 14:35:42', '2025-02-26 14:35:42'),
(137, 16, 16, 'new_like', 'App\\Models\\Post', 73, 0, '2025-03-02 14:30:22', '2025-03-02 14:30:22'),
(138, 16, 16, 'new_like', 'App\\Models\\Post', 73, 0, '2025-03-02 14:31:00', '2025-03-02 14:31:00'),
(139, 15, 16, 'new_follow', 'App\\Models\\User', 15, 0, '2025-03-02 14:31:37', '2025-03-02 14:31:37'),
(140, 15, 16, 'new_like', 'App\\Models\\Post', 77, 0, '2025-03-02 14:31:52', '2025-03-02 14:31:52'),
(141, 15, 15, 'new_like', 'App\\Models\\Post', 77, 0, '2025-03-02 14:32:13', '2025-03-02 14:32:13'),
(142, 15, 16, 'new_like', 'App\\Models\\Post', 77, 0, '2025-03-02 14:32:15', '2025-03-02 14:32:15'),
(143, 15, 16, 'new_like', 'App\\Models\\Post', 77, 0, '2025-03-02 14:32:23', '2025-03-02 14:32:23'),
(144, 18, 15, 'new_follow', 'App\\Models\\User', 18, 0, '2025-03-02 16:07:09', '2025-03-02 16:07:09'),
(145, 16, 18, 'new_like', 'App\\Models\\Post', 80, 0, '2025-03-02 16:08:34', '2025-03-02 16:08:34'),
(146, 16, 18, 'new_like', 'App\\Models\\Post', 81, 0, '2025-03-02 16:09:47', '2025-03-02 16:09:47'),
(147, 16, 18, 'new_like', 'App\\Models\\Post', 71, 0, '2025-03-02 16:10:10', '2025-03-02 16:10:10'),
(148, 16, 16, 'new_like', 'App\\Models\\Post', 81, 0, '2025-03-02 16:11:09', '2025-03-02 16:11:09'),
(149, 15, 16, 'new_like', 'App\\Models\\Post', 84, 0, '2025-03-02 16:12:38', '2025-03-02 16:12:38'),
(150, 15, 15, 'new_like', 'App\\Models\\Post', 77, 0, '2025-03-03 10:39:24', '2025-03-03 10:39:24'),
(151, 15, 16, 'new_follow', 'App\\Models\\User', 15, 0, '2025-03-03 13:59:33', '2025-03-03 13:59:33'),
(152, 15, 15, 'new_like', 'App\\Models\\Post', 86, 0, '2025-03-03 14:00:41', '2025-03-03 14:00:41'),
(153, 16, 15, 'new_follow', 'App\\Models\\User', 16, 0, '2025-03-03 14:01:43', '2025-03-03 14:01:43'),
(154, 15, 15, 'new_like', 'App\\Models\\Post', 85, 0, '2025-03-03 14:02:39', '2025-03-03 14:02:39'),
(155, 18, 16, 'new_follow', 'App\\Models\\User', 18, 0, '2025-03-03 14:05:21', '2025-03-03 14:05:21'),
(156, 18, 16, 'new_like', 'App\\Models\\Post', 90, 0, '2025-03-03 14:07:48', '2025-03-03 14:07:48'),
(157, 18, 16, 'new_follow', 'App\\Models\\User', 18, 0, '2025-03-03 14:13:45', '2025-03-03 14:13:45'),
(158, 18, 16, 'new_like', 'App\\Models\\Post', 89, 0, '2025-03-03 14:18:36', '2025-03-03 14:18:36'),
(159, 18, 16, 'new_like', 'App\\Models\\Post', 90, 0, '2025-03-03 14:19:14', '2025-03-03 14:19:14'),
(160, 18, 16, 'new_follow', 'App\\Models\\User', 18, 0, '2025-03-03 14:20:56', '2025-03-03 14:20:56'),
(161, 18, 16, 'new_like', 'App\\Models\\Post', 89, 0, '2025-03-03 14:21:32', '2025-03-03 14:21:32'),
(162, 18, 16, 'new_like', 'App\\Models\\Post', 92, 0, '2025-03-03 14:29:27', '2025-03-03 14:29:27'),
(163, 18, 16, 'new_like', 'App\\Models\\Post', 92, 0, '2025-03-03 14:29:30', '2025-03-03 14:29:30'),
(164, 18, 16, 'new_like', 'App\\Models\\Post', 92, 0, '2025-03-03 14:30:40', '2025-03-03 14:30:40'),
(165, 18, 15, 'new_follow', 'App\\Models\\User', 18, 0, '2025-03-03 14:41:09', '2025-03-03 14:41:09'),
(166, 16, 16, 'new_like', 'App\\Models\\Post', 88, 0, '2025-03-03 18:09:39', '2025-03-03 18:09:39'),
(167, 16, 15, 'new_follow', 'App\\Models\\User', 16, 0, '2025-03-03 18:09:54', '2025-03-03 18:09:54'),
(168, 16, 16, 'new_like', 'App\\Models\\Post', 91, 0, '2025-03-03 18:10:20', '2025-03-03 18:10:20'),
(169, 16, 15, 'new_follow', 'App\\Models\\User', 16, 0, '2025-03-04 10:42:00', '2025-03-04 10:42:00'),
(170, 18, 16, 'new_follow', 'App\\Models\\User', 18, 0, '2025-03-04 10:43:40', '2025-03-04 10:43:40'),
(171, 18, 16, 'new_like', 'App\\Models\\Post', 93, 0, '2025-03-04 10:45:38', '2025-03-04 10:45:38'),
(172, 18, 15, 'new_follow', 'App\\Models\\User', 18, 0, '2025-03-04 10:45:54', '2025-03-04 10:45:54'),
(173, 18, 16, 'new_like', 'App\\Models\\Post', 94, 0, '2025-03-04 10:48:15', '2025-03-04 10:48:15'),
(174, 17, 16, 'new_follow', 'App\\Models\\User', 17, 0, '2025-03-04 10:52:06', '2025-03-04 10:52:06'),
(175, 17, 16, 'new_like', 'App\\Models\\Post', 95, 0, '2025-03-04 10:52:22', '2025-03-04 10:52:22'),
(176, 17, 15, 'new_follow', 'App\\Models\\User', 17, 0, '2025-03-04 10:52:42', '2025-03-04 10:52:42'),
(177, 16, 15, 'new_follow', 'App\\Models\\User', 16, 0, '2025-03-04 11:08:57', '2025-03-04 11:08:57'),
(178, 16, 15, 'new_follow', 'App\\Models\\User', 16, 0, '2025-03-04 11:23:33', '2025-03-04 11:23:33'),
(179, 16, 15, 'new_follow', 'App\\Models\\User', 16, 0, '2025-03-04 11:24:56', '2025-03-04 11:24:56'),
(180, 16, 15, 'new_follow', 'App\\Models\\User', 16, 0, '2025-03-04 14:16:00', '2025-03-04 14:16:00'),
(181, 19, 20, 'new_follow', 'App\\Models\\User', 19, 0, '2025-03-04 14:20:14', '2025-03-04 14:20:14'),
(182, 19, 20, 'new_follow', 'App\\Models\\User', 19, 0, '2025-03-04 14:22:42', '2025-03-04 14:22:42'),
(183, 19, 20, 'new_like', 'App\\Models\\Post', 99, 0, '2025-03-04 14:26:48', '2025-03-04 14:26:48'),
(184, 20, 21, 'new_follow', 'App\\Models\\User', 20, 0, '2025-03-04 14:27:15', '2025-03-04 14:27:15'),
(185, 21, 20, 'new_follow', 'App\\Models\\User', 21, 0, '2025-03-04 14:27:52', '2025-03-04 14:27:52'),
(186, 21, 20, 'new_like', 'App\\Models\\Post', 100, 0, '2025-03-04 14:28:33', '2025-03-04 14:28:33'),
(187, 21, 19, 'new_follow', 'App\\Models\\User', 21, 0, '2025-03-04 14:29:01', '2025-03-04 14:29:01'),
(188, 21, 20, 'new_like', 'App\\Models\\Post', 101, 0, '2025-03-04 14:29:35', '2025-03-04 14:29:35'),
(189, 20, 19, 'new_follow', 'App\\Models\\User', 20, 0, '2025-03-04 14:31:27', '2025-03-04 14:31:27'),
(190, 21, 20, 'new_like', 'App\\Models\\Post', 102, 0, '2025-03-04 14:31:57', '2025-03-04 14:31:57'),
(191, 21, 20, 'new_like', 'App\\Models\\Post', 101, 0, '2025-03-04 15:45:24', '2025-03-04 15:45:24'),
(192, 21, 20, 'new_like', 'App\\Models\\Post', 103, 0, '2025-03-04 16:07:10', '2025-03-04 16:07:10'),
(193, 21, 20, 'new_like', 'App\\Models\\Post', 100, 0, '2025-03-04 16:30:53', '2025-03-04 16:30:53'),
(194, 22, 23, 'new_like', 'App\\Models\\Post', 105, 0, '2025-03-04 17:17:08', '2025-03-04 17:17:08'),
(195, 22, 23, 'new_follow', 'App\\Models\\User', 22, 0, '2025-03-04 17:17:26', '2025-03-04 17:17:26'),
(196, 22, 23, 'new_follow', 'App\\Models\\User', 22, 0, '2025-03-04 17:21:43', '2025-03-04 17:21:43'),
(197, 22, 23, 'new_like', 'App\\Models\\Post', 107, 0, '2025-03-04 17:22:24', '2025-03-04 17:22:24'),
(198, 22, 23, 'new_follow', 'App\\Models\\User', 22, 0, '2025-03-04 17:22:42', '2025-03-04 17:22:42'),
(199, 23, 24, 'new_follow', 'App\\Models\\User', 23, 0, '2025-03-04 17:41:45', '2025-03-04 17:41:45'),
(200, 22, 23, 'new_like', 'App\\Models\\Post', 110, 0, '2025-03-04 17:42:53', '2025-03-04 17:42:53'),
(201, 22, 24, 'new_follow', 'App\\Models\\User', 22, 0, '2025-03-04 17:43:16', '2025-03-04 17:43:16'),
(202, 22, 23, 'new_like', 'App\\Models\\Post', 111, 0, '2025-03-04 17:58:27', '2025-03-04 17:58:27'),
(203, 22, 24, 'new_follow', 'App\\Models\\User', 22, 0, '2025-03-04 18:00:22', '2025-03-04 18:00:22'),
(204, 25, 26, 'new_like', 'App\\Models\\Post', 114, 0, '2025-03-08 15:24:28', '2025-03-08 15:24:28'),
(205, 25, 26, 'new_follow', 'App\\Models\\User', 25, 0, '2025-03-08 15:24:51', '2025-03-08 15:24:51'),
(206, 25, 26, 'new_like', 'App\\Models\\Post', 114, 0, '2025-03-08 16:16:33', '2025-03-08 16:16:33'),
(207, 25, 26, 'new_like', 'App\\Models\\Post', 117, 0, '2025-03-08 16:24:49', '2025-03-08 16:24:49'),
(208, 25, 26, 'new_follow', 'App\\Models\\User', 25, 0, '2025-03-08 16:25:07', '2025-03-08 16:25:07'),
(209, 25, 26, 'new_like', 'App\\Models\\Post', 116, 0, '2025-03-08 16:25:15', '2025-03-08 16:25:15'),
(210, 27, 26, 'new_like', 'App\\Models\\Post', 119, 0, '2025-03-08 16:39:20', '2025-03-08 16:39:20'),
(211, 27, 26, 'new_follow', 'App\\Models\\User', 27, 0, '2025-03-08 16:40:04', '2025-03-08 16:40:04'),
(212, 27, 26, 'new_follow', 'App\\Models\\User', 27, 0, '2025-03-08 17:56:18', '2025-03-08 17:56:18'),
(213, 27, 26, 'new_like', 'App\\Models\\Post', 120, 0, '2025-03-08 17:56:27', '2025-03-08 17:56:27'),
(214, 27, 26, 'new_follow', 'App\\Models\\User', 27, 0, '2025-03-08 17:57:22', '2025-03-08 17:57:22'),
(215, 27, 26, 'new_like', 'App\\Models\\Post', 120, 0, '2025-03-08 17:57:33', '2025-03-08 17:57:33'),
(216, 27, 26, 'new_follow', 'App\\Models\\User', 27, 0, '2025-03-08 18:06:54', '2025-03-08 18:06:54'),
(217, 27, 26, 'new_like', 'App\\Models\\Post', 119, 0, '2025-03-08 18:07:05', '2025-03-08 18:07:05'),
(218, 27, 26, 'new_follow', 'App\\Models\\User', 27, 0, '2025-03-08 18:07:22', '2025-03-08 18:07:22'),
(219, 25, 26, 'new_like', 'App\\Models\\Post', 116, 0, '2025-03-08 18:08:23', '2025-03-08 18:08:23'),
(220, 25, 26, 'new_like', 'App\\Models\\Post', 117, 0, '2025-03-08 18:08:32', '2025-03-08 18:08:32'),
(221, 25, 26, 'new_follow', 'App\\Models\\User', 25, 0, '2025-03-08 18:08:44', '2025-03-08 18:08:44'),
(222, 25, 26, 'new_like', 'App\\Models\\Post', 117, 0, '2025-03-08 18:08:46', '2025-03-08 18:08:46'),
(223, 25, 26, 'new_like', 'App\\Models\\Post', 116, 0, '2025-03-08 18:09:44', '2025-03-08 18:09:44'),
(224, 25, 26, 'new_follow', 'App\\Models\\User', 25, 0, '2025-03-08 18:09:52', '2025-03-08 18:09:52'),
(225, 27, 26, 'new_like', 'App\\Models\\Post', 120, 0, '2025-03-08 18:13:29', '2025-03-08 18:13:29'),
(226, 27, 26, 'new_follow', 'App\\Models\\User', 27, 0, '2025-03-08 18:13:37', '2025-03-08 18:13:37'),
(227, 27, 26, 'new_like', 'App\\Models\\Post', 119, 0, '2025-03-08 18:13:54', '2025-03-08 18:13:54'),
(228, 27, 26, 'new_like', 'App\\Models\\Post', 120, 0, '2025-03-08 18:37:51', '2025-03-08 18:37:51'),
(229, 27, 26, 'new_follow', 'App\\Models\\User', 27, 0, '2025-03-08 18:37:59', '2025-03-08 18:37:59'),
(230, 27, 26, 'new_like', 'App\\Models\\Post', 119, 0, '2025-03-08 18:38:06', '2025-03-08 18:38:06'),
(231, 27, 26, 'new_like', 'App\\Models\\Post', 120, 0, '2025-03-08 18:38:38', '2025-03-08 18:38:38'),
(232, 27, 26, 'new_like', 'App\\Models\\Post', 125, 0, '2025-03-09 15:24:03', '2025-03-09 15:24:03'),
(233, 26, 26, 'new_like', 'App\\Models\\Post', 124, 0, '2025-03-09 15:27:28', '2025-03-09 15:27:28'),
(234, 26, 26, 'new_like', 'App\\Models\\Post', 123, 0, '2025-03-09 15:27:41', '2025-03-09 15:27:41'),
(235, 26, 25, 'new_follow', 'App\\Models\\User', 26, 0, '2025-03-09 15:31:53', '2025-03-09 15:31:53'),
(236, 26, 25, 'new_like', 'App\\Models\\Post', 127, 0, '2025-03-09 15:33:05', '2025-03-09 15:33:05'),
(237, 27, 26, 'new_like', 'App\\Models\\Post', 128, 0, '2025-03-09 15:33:37', '2025-03-09 15:33:37'),
(238, 27, 25, 'new_follow', 'App\\Models\\User', 27, 0, '2025-03-09 15:34:09', '2025-03-09 15:34:09'),
(239, 27, 26, 'new_like', 'App\\Models\\Post', 129, 0, '2025-03-09 15:56:10', '2025-03-09 15:56:10'),
(240, 26, 12, 'new_follow', 'App\\Models\\User', 26, 0, '2025-03-09 15:57:17', '2025-03-09 15:57:17'),
(241, 27, 26, 'new_like', 'App\\Models\\Post', 131, 0, '2025-03-09 15:58:11', '2025-03-09 15:58:11'),
(242, 27, 12, 'new_follow', 'App\\Models\\User', 27, 0, '2025-03-09 15:58:36', '2025-03-09 15:58:36'),
(243, 27, 27, 'new_like', 'App\\Models\\Post', 131, 0, '2025-03-09 15:59:29', '2025-03-09 15:59:29'),
(244, 27, 26, 'new_like', 'App\\Models\\Post', 133, 0, '2025-03-09 16:00:15', '2025-03-09 16:00:15'),
(245, 27, 26, 'new_like', 'App\\Models\\Post', 132, 0, '2025-03-09 16:00:16', '2025-03-09 16:00:16'),
(246, 27, 26, 'new_like', 'App\\Models\\Post', 131, 0, '2025-03-09 16:00:17', '2025-03-09 16:00:17'),
(247, 26, 26, 'new_like', 'App\\Models\\Post', 130, 0, '2025-03-09 16:00:19', '2025-03-09 16:00:19'),
(248, 27, 12, 'new_follow', 'App\\Models\\User', 27, 0, '2025-03-09 16:00:28', '2025-03-09 16:00:28'),
(249, 27, 12, 'new_follow', 'App\\Models\\User', 27, 0, '2025-03-09 16:07:32', '2025-03-09 16:07:32'),
(250, 27, 26, 'new_like', 'App\\Models\\Post', 131, 0, '2025-03-09 16:14:04', '2025-03-09 16:14:04'),
(251, 27, 26, 'new_follow', 'App\\Models\\User', 27, 0, '2025-03-09 17:29:38', '2025-03-09 17:29:38'),
(252, 27, 26, 'new_like', 'App\\Models\\Post', 137, 0, '2025-03-09 17:30:20', '2025-03-09 17:30:20'),
(253, 26, 27, 'new_follow', 'App\\Models\\User', 26, 0, '2025-03-09 17:31:13', '2025-03-09 17:31:13'),
(254, 26, 27, 'new_like', 'App\\Models\\Post', 139, 0, '2025-03-09 17:31:55', '2025-03-09 17:31:55'),
(255, 26, 27, 'new_follow', 'App\\Models\\User', 26, 0, '2025-03-09 17:32:25', '2025-03-09 17:32:25'),
(258, 26, 27, 'new_like', 'App\\Models\\Post', 141, 0, '2025-03-09 17:34:51', '2025-03-09 17:34:51'),
(259, 26, 12, 'new_follow', 'App\\Models\\User', 26, 0, '2025-03-09 17:35:09', '2025-03-09 17:35:09'),
(260, 26, 27, 'new_like', 'App\\Models\\Post', 142, 0, '2025-03-09 17:36:05', '2025-03-09 17:36:05'),
(261, 26, 12, 'new_like', 'App\\Models\\Post', 142, 0, '2025-03-09 17:36:39', '2025-03-09 17:36:39'),
(262, 27, 26, 'new_like', 'App\\Models\\Post', 134, 0, '2025-03-10 11:33:50', '2025-03-10 11:33:50'),
(263, 25, 26, 'new_like', 'App\\Models\\Post', 143, 0, '2025-03-10 17:12:05', '2025-03-10 17:12:05'),
(264, 25, 26, 'new_like', 'App\\Models\\Post', 146, 0, '2025-03-10 17:44:05', '2025-03-10 17:44:05'),
(265, 27, 26, 'new_like', 'App\\Models\\Post', 148, 0, '2025-03-10 18:09:20', '2025-03-10 18:09:20'),
(266, 27, 25, 'new_like', 'App\\Models\\Post', 148, 0, '2025-03-10 18:10:16', '2025-03-10 18:10:16'),
(267, 27, 25, 'new_like', 'App\\Models\\Post', 150, 0, '2025-03-11 05:22:59', '2025-03-11 05:22:59'),
(268, 25, 26, 'new_follow', 'App\\Models\\User', 25, 0, '2025-03-11 05:30:07', '2025-03-11 05:30:07'),
(269, 25, 26, 'new_like', 'App\\Models\\Post', 154, 0, '2025-03-11 05:30:48', '2025-03-11 05:30:48'),
(270, 25, 26, 'new_follow', 'App\\Models\\User', 25, 0, '2025-03-11 05:47:14', '2025-03-11 05:47:14'),
(271, 25, 26, 'new_like', 'App\\Models\\Post', 155, 0, '2025-03-11 05:50:57', '2025-03-11 05:50:57'),
(272, 27, 25, 'new_like', 'App\\Models\\Post', 150, 0, '2025-03-11 05:51:27', '2025-03-11 05:51:27'),
(273, 27, 26, 'new_like', 'App\\Models\\Post', 150, 0, '2025-03-11 05:51:38', '2025-03-11 05:51:38'),
(274, 27, 26, 'new_like', 'App\\Models\\Post', 150, 0, '2025-03-11 06:17:38', '2025-03-11 06:17:38'),
(275, 27, 25, 'new_follow', 'App\\Models\\User', 27, 0, '2025-03-11 06:20:08', '2025-03-11 06:20:08'),
(276, 27, 26, 'new_follow', 'App\\Models\\User', 27, 0, '2025-03-11 06:21:36', '2025-03-11 06:21:36'),
(277, 27, 26, 'new_like', 'App\\Models\\Post', 150, 0, '2025-03-11 06:21:48', '2025-03-11 06:21:48'),
(278, 25, 26, 'new_follow', 'App\\Models\\User', 25, 0, '2025-03-11 06:44:52', '2025-03-11 06:44:52'),
(279, 27, 26, 'new_follow', 'App\\Models\\User', 27, 0, '2025-03-11 06:46:16', '2025-03-11 06:46:16'),
(280, 27, 26, 'new_like', 'App\\Models\\Post', 159, 0, '2025-03-11 06:47:16', '2025-03-11 06:47:16'),
(281, 27, 26, 'new_like', 'App\\Models\\Post', 159, 0, '2025-03-11 06:51:57', '2025-03-11 06:51:57'),
(282, 27, 26, 'new_like', 'App\\Models\\Post', 157, 0, '2025-03-11 06:53:29', '2025-03-11 06:53:29'),
(283, 27, 26, 'new_follow', 'App\\Models\\User', 27, 0, '2025-03-11 06:54:23', '2025-03-11 06:54:23'),
(284, 27, 26, 'new_like', 'App\\Models\\Post', 159, 0, '2025-03-11 06:54:32', '2025-03-11 06:54:32'),
(285, 27, 26, 'new_follow', 'App\\Models\\User', 27, 0, '2025-03-11 06:55:19', '2025-03-11 06:55:19'),
(286, 27, 26, 'new_follow', 'App\\Models\\User', 27, 0, '2025-03-11 07:03:32', '2025-03-11 07:03:32'),
(287, 27, 26, 'new_like', 'App\\Models\\Post', 159, 0, '2025-03-11 07:30:50', '2025-03-11 07:30:50'),
(288, 27, 26, 'new_like', 'App\\Models\\Post', 157, 0, '2025-03-11 07:46:24', '2025-03-11 07:46:24'),
(289, 27, 25, 'new_like', 'App\\Models\\Post', 159, 0, '2025-03-11 07:47:20', '2025-03-11 07:47:20'),
(290, 27, 25, 'new_like', 'App\\Models\\Post', 157, 0, '2025-03-11 07:47:34', '2025-03-11 07:47:34'),
(291, 27, 12, 'new_like', 'App\\Models\\Post', 159, 0, '2025-03-11 07:48:52', '2025-03-11 07:48:52'),
(293, 27, 26, 'new_like', 'App\\Models\\Post', 159, 0, '2025-03-11 07:55:39', '2025-03-11 07:55:39'),
(294, 27, 26, 'new_follow', 'App\\Models\\User', 27, 0, '2025-03-11 09:20:04', '2025-03-11 09:20:04'),
(295, 27, 26, 'new_follow', 'App\\Models\\User', 27, 0, '2025-03-11 09:50:26', '2025-03-11 09:50:26'),
(296, 27, 26, 'new_like', 'App\\Models\\Post', 159, 0, '2025-03-11 10:09:38', '2025-03-11 10:09:38'),
(297, 27, 25, 'new_follow', 'App\\Models\\User', 27, 0, '2025-03-11 10:15:06', '2025-03-11 10:15:06'),
(298, 27, 25, 'new_like', 'App\\Models\\Post', 159, 0, '2025-03-11 10:15:42', '2025-03-11 10:15:42'),
(299, 27, 25, 'new_like', 'App\\Models\\Post', 161, 0, '2025-03-11 10:28:23', '2025-03-11 10:28:23'),
(300, 27, 26, 'new_follow', 'App\\Models\\User', 27, 0, '2025-03-11 10:28:42', '2025-03-11 10:28:42'),
(301, 25, 26, 'new_follow', 'App\\Models\\User', 25, 0, '2025-03-11 10:54:11', '2025-03-11 10:54:11'),
(302, 27, 25, 'new_follow', 'App\\Models\\User', 27, 0, '2025-03-11 10:55:19', '2025-03-11 10:55:19'),
(303, 27, 25, 'new_like', 'App\\Models\\Post', 159, 0, '2025-03-11 10:55:45', '2025-03-11 10:55:45'),
(304, 27, 26, 'new_like', 'App\\Models\\Post', 159, 0, '2025-03-12 09:58:03', '2025-03-12 09:58:03'),
(305, 27, 26, 'new_like', 'App\\Models\\Post', 161, 0, '2025-03-12 10:03:14', '2025-03-12 10:03:14'),
(306, 27, 25, 'new_like', 'App\\Models\\Post', 159, 0, '2025-03-12 10:08:52', '2025-03-12 10:08:52'),
(307, 27, 25, 'new_follow', 'App\\Models\\User', 27, 0, '2025-03-12 10:09:31', '2025-03-12 10:09:31'),
(308, 27, 25, 'new_like', 'App\\Models\\Post', 161, 0, '2025-03-12 10:19:06', '2025-03-12 10:19:06'),
(309, 27, 25, 'new_like', 'App\\Models\\Post', 161, 0, '2025-03-12 10:20:35', '2025-03-12 10:20:35'),
(310, 27, 26, 'new_like', 'App\\Models\\Post', 157, 0, '2025-03-12 10:31:37', '2025-03-12 10:31:37'),
(311, 27, 25, 'new_like', 'App\\Models\\Post', 161, 0, '2025-03-12 10:41:54', '2025-03-12 10:41:54'),
(312, 27, 27, 'new_like', 'App\\Models\\Post', 162, 0, '2025-03-12 10:43:10', '2025-03-12 10:43:10'),
(313, 27, 26, 'new_like', 'App\\Models\\Post', 162, 0, '2025-03-12 10:43:18', '2025-03-12 10:43:18'),
(314, 27, 25, 'new_like', 'App\\Models\\Post', 162, 0, '2025-03-12 11:28:06', '2025-03-12 11:28:06'),
(315, 27, 25, 'new_like', 'App\\Models\\Post', 162, 0, '2025-03-12 11:29:58', '2025-03-12 11:29:58'),
(316, 27, 26, 'new_follow', 'App\\Models\\User', 27, 0, '2025-03-12 11:30:16', '2025-03-12 11:30:16'),
(317, 27, 27, 'new_like', 'App\\Models\\Post', 162, 0, '2025-03-12 11:30:50', '2025-03-12 11:30:50'),
(318, 27, 26, 'new_follow', 'App\\Models\\User', 27, 0, '2025-03-12 11:32:40', '2025-03-12 11:32:40'),
(319, 25, 25, 'new_like', 'App\\Models\\Post', 160, 0, '2025-03-12 11:36:45', '2025-03-12 11:36:45'),
(320, 26, 26, 'new_like', 'App\\Models\\Post', 163, 0, '2025-03-12 11:45:58', '2025-03-12 11:45:58'),
(321, 26, 26, 'new_like', 'App\\Models\\Post', 163, 0, '2025-03-12 11:46:04', '2025-03-12 11:46:04'),
(322, 26, 26, 'new_like', 'App\\Models\\Post', 163, 0, '2025-03-12 12:03:06', '2025-03-12 12:03:06'),
(323, 25, 26, 'new_like', 'App\\Models\\Post', 164, 0, '2025-03-12 12:04:15', '2025-03-12 12:04:15'),
(324, 25, 26, 'new_follow', 'App\\Models\\User', 25, 0, '2025-03-12 12:04:49', '2025-03-12 12:04:49'),
(325, 25, 26, 'new_like', 'App\\Models\\Post', 166, 0, '2025-03-12 12:05:39', '2025-03-12 12:05:39'),
(326, 26, 26, 'new_like', 'App\\Models\\Post', 163, 0, '2025-03-12 12:05:51', '2025-03-12 12:05:51'),
(327, 27, 25, 'new_like', 'App\\Models\\Post', 165, 0, '2025-03-12 12:06:34', '2025-03-12 12:06:34'),
(328, 27, 26, 'new_follow', 'App\\Models\\User', 27, 0, '2025-03-12 12:07:16', '2025-03-12 12:07:16'),
(329, 27, 25, 'new_follow', 'App\\Models\\User', 27, 0, '2025-03-12 12:07:46', '2025-03-12 12:07:46'),
(330, 27, 25, 'new_like', 'App\\Models\\Post', 168, 0, '2025-03-12 12:09:10', '2025-03-12 12:09:10'),
(331, 25, 26, 'new_follow', 'App\\Models\\User', 25, 0, '2025-03-13 05:11:43', '2025-03-13 05:11:43'),
(332, 25, 26, 'new_follow', 'App\\Models\\User', 25, 0, '2025-03-13 05:12:48', '2025-03-13 05:12:48'),
(333, 26, 26, 'new_like', 'App\\Models\\Post', 170, 0, '2025-03-13 05:41:34', '2025-03-13 05:41:34'),
(334, 25, 26, 'new_like', 'App\\Models\\Post', 173, 0, '2025-03-13 05:42:26', '2025-03-13 05:42:26'),
(335, 25, 26, 'new_like', 'App\\Models\\Post', 174, 0, '2025-03-13 05:45:41', '2025-03-13 05:45:41'),
(336, 25, 26, 'new_follow', 'App\\Models\\User', 25, 0, '2025-03-13 06:08:57', '2025-03-13 06:08:57'),
(337, 25, 26, 'new_like', 'App\\Models\\Post', 172, 0, '2025-03-13 06:43:14', '2025-03-13 06:43:14'),
(338, 25, 26, 'new_like', 'App\\Models\\Post', 169, 0, '2025-03-13 06:43:25', '2025-03-13 06:43:25'),
(339, 25, 26, 'new_like', 'App\\Models\\Post', 172, 0, '2025-03-13 06:53:46', '2025-03-13 06:53:46'),
(340, 27, 25, 'new_like', 'App\\Models\\Post', 171, 0, '2025-03-13 06:58:00', '2025-03-13 06:58:00'),
(341, 27, 26, 'new_follow', 'App\\Models\\User', 27, 0, '2025-03-13 06:59:12', '2025-03-13 06:59:12'),
(342, 25, 26, 'new_follow', 'App\\Models\\User', 25, 0, '2025-03-13 07:07:34', '2025-03-13 07:07:34'),
(343, 27, 25, 'new_like', 'App\\Models\\Post', 175, 0, '2025-03-13 07:08:40', '2025-03-13 07:08:40'),
(345, 25, 12, 'new_follow', 'App\\Models\\User', 25, 0, '2025-03-13 07:14:05', '2025-03-13 07:14:05'),
(346, 25, 12, 'new_like', 'App\\Models\\Post', 174, 0, '2025-03-13 07:22:09', '2025-03-13 07:22:09'),
(348, 25, 12, 'new_like', 'App\\Models\\Post', 169, 0, '2025-03-13 07:23:26', '2025-03-13 07:23:26'),
(349, 25, 26, 'new_follow', 'App\\Models\\User', 25, 0, '2025-03-13 07:57:49', '2025-03-13 07:57:49'),
(353, 26, 26, 'new_like', 'App\\Models\\Post', 179, 0, '2025-03-14 06:36:51', '2025-03-14 06:36:51'),
(354, 25, 25, 'new_like', 'App\\Models\\Post', 181, 0, '2025-03-14 06:37:29', '2025-03-14 06:37:29'),
(355, 25, 26, 'new_like', 'App\\Models\\Post', 181, 0, '2025-03-14 06:38:24', '2025-03-14 06:38:24'),
(356, 25, 26, 'new_follow', 'App\\Models\\User', 25, 0, '2025-03-14 06:38:57', '2025-03-14 06:38:57'),
(357, 25, 26, 'new_like', 'App\\Models\\Post', 182, 0, '2025-03-14 06:48:18', '2025-03-14 06:48:18'),
(358, 25, 26, 'new_like', 'App\\Models\\Post', 181, 0, '2025-03-14 06:49:49', '2025-03-14 06:49:49'),
(359, 25, 26, 'new_like', 'App\\Models\\Post', 186, 0, '2025-03-14 06:56:46', '2025-03-14 06:56:46'),
(360, 25, 26, 'new_follow', 'App\\Models\\User', 25, 0, '2025-03-14 07:02:05', '2025-03-14 07:02:05'),
(361, 27, 25, 'new_like', 'App\\Models\\Post', 184, 0, '2025-03-14 07:02:32', '2025-03-14 07:02:32'),
(362, 27, 26, 'new_follow', 'App\\Models\\User', 27, 0, '2025-03-14 07:03:20', '2025-03-14 07:03:20'),
(363, 27, 26, 'new_like', 'App\\Models\\Post', 184, 0, '2025-03-14 07:04:26', '2025-03-14 07:04:26'),
(364, 27, 26, 'new_like', 'App\\Models\\Post', 187, 0, '2025-03-14 07:05:27', '2025-03-14 07:05:27'),
(365, 26, 25, 'new_follow', 'App\\Models\\User', 26, 0, '2025-03-14 07:05:45', '2025-03-14 07:05:45'),
(366, 27, 26, 'new_like', 'App\\Models\\Post', 188, 0, '2025-03-14 07:07:17', '2025-03-14 07:07:17'),
(367, 27, 25, 'new_follow', 'App\\Models\\User', 27, 0, '2025-03-14 07:07:57', '2025-03-14 07:07:57'),
(368, 27, 25, 'new_follow', 'App\\Models\\User', 27, 0, '2025-03-14 07:08:27', '2025-03-14 07:08:27'),
(369, 27, 25, 'new_like', 'App\\Models\\Post', 189, 0, '2025-03-14 18:24:34', '2025-03-14 18:24:34'),
(370, 27, 26, 'new_follow', 'App\\Models\\User', 27, 0, '2025-03-14 18:25:23', '2025-03-14 18:25:23'),
(371, 25, 26, 'new_follow', 'App\\Models\\User', 25, 0, '2025-03-15 04:19:59', '2025-03-15 04:19:59'),
(372, 27, 25, 'new_follow', 'App\\Models\\User', 27, 0, '2025-03-15 04:20:11', '2025-03-15 04:20:11'),
(373, 27, 25, 'new_like', 'App\\Models\\Post', 192, 0, '2025-03-15 04:20:24', '2025-03-15 04:20:24'),
(374, 27, 26, 'new_follow', 'App\\Models\\User', 27, 0, '2025-03-15 04:21:06', '2025-03-15 04:21:06'),
(375, 27, 26, 'new_like', 'App\\Models\\Post', 193, 0, '2025-03-15 05:00:54', '2025-03-15 05:00:54'),
(376, 27, 25, 'new_like', 'App\\Models\\Post', 193, 0, '2025-03-15 05:01:13', '2025-03-15 05:01:13'),
(377, 27, 26, 'new_follow', 'App\\Models\\User', 27, 0, '2025-03-15 05:54:45', '2025-03-15 05:54:45'),
(378, 25, 26, 'new_follow', 'App\\Models\\User', 25, 0, '2025-03-15 06:04:13', '2025-03-15 06:04:13'),
(379, 27, 25, 'new_like', 'App\\Models\\Post', 192, 0, '2025-03-15 06:07:28', '2025-03-15 06:07:28'),
(380, 27, 26, 'new_follow', 'App\\Models\\User', 27, 0, '2025-03-15 06:27:37', '2025-03-15 06:27:37'),
(381, 27, 25, 'new_follow', 'App\\Models\\User', 27, 0, '2025-03-15 06:34:39', '2025-03-15 06:34:39'),
(382, 27, 25, 'new_like', 'App\\Models\\Post', 194, 0, '2025-03-15 06:42:09', '2025-03-15 06:42:09'),
(383, 25, 26, 'new_follow', 'App\\Models\\User', 25, 0, '2025-03-16 07:05:21', '2025-03-16 07:05:21'),
(384, 27, 25, 'new_like', 'App\\Models\\Post', 197, 0, '2025-03-16 07:05:54', '2025-03-16 07:05:54'),
(385, 27, 25, 'new_follow', 'App\\Models\\User', 27, 0, '2025-03-16 07:06:26', '2025-03-16 07:06:26'),
(386, 27, 26, 'new_follow', 'App\\Models\\User', 27, 0, '2025-03-16 07:07:01', '2025-03-16 07:07:01'),
(387, 27, 25, 'new_like', 'App\\Models\\Post', 197, 0, '2025-03-16 07:07:21', '2025-03-16 07:07:21'),
(388, 25, 25, 'new_like', 'App\\Models\\Post', 200, 0, '2025-03-16 07:09:11', '2025-03-16 07:09:11'),
(389, 27, 25, 'new_like', 'App\\Models\\Post', 201, 0, '2025-03-16 07:09:47', '2025-03-16 07:09:47'),
(390, 27, 25, 'new_follow', 'App\\Models\\User', 27, 0, '2025-03-22 11:06:53', '2025-03-22 11:06:53'),
(391, 27, 25, 'new_follow', 'App\\Models\\User', 27, 0, '2025-03-22 11:09:57', '2025-03-22 11:09:57'),
(392, 25, 12, 'new_follow', 'App\\Models\\User', 25, 0, '2025-03-23 10:58:47', '2025-03-23 10:58:47'),
(393, 26, 12, 'new_follow', 'App\\Models\\User', 26, 0, '2025-03-23 12:53:15', '2025-03-23 12:53:15'),
(395, 26, 25, 'new_follow', 'App\\Models\\User', 26, 0, '2025-03-24 14:38:36', '2025-03-24 14:38:36'),
(396, 26, 25, 'new_like', 'App\\Models\\Post', 203, 0, '2025-03-24 14:40:24', '2025-03-24 14:40:24'),
(397, 27, 26, 'new_like', 'App\\Models\\Post', 201, 0, '2025-03-24 14:42:03', '2025-03-24 14:42:03'),
(398, 27, 25, 'new_like', 'App\\Models\\Post', 201, 0, '2025-03-24 14:45:47', '2025-03-24 14:45:47'),
(399, 26, 12, 'new_follow', 'App\\Models\\User', 26, 0, '2025-03-27 04:32:53', '2025-03-27 04:32:53'),
(400, 26, 12, 'new_like', 'App\\Models\\Post', 205, 0, '2025-03-27 04:33:33', '2025-03-27 04:33:33'),
(402, 27, 12, 'new_follow', 'App\\Models\\User', 27, 0, '2025-03-27 06:42:00', '2025-03-27 06:42:00'),
(403, 27, 26, 'new_follow', 'App\\Models\\User', 27, 0, '2025-03-28 06:38:38', '2025-03-28 06:38:38'),
(404, 26, 27, 'new_follow', 'App\\Models\\User', 26, 0, '2025-03-28 07:17:56', '2025-03-28 07:17:56'),
(406, 26, 26, 'new_reply', 'App\\Models\\Post', 208, 0, '2025-04-15 14:56:19', '2025-04-15 14:56:19'),
(407, 26, 26, 'new_reply', 'App\\Models\\Post', 208, 0, '2025-04-15 14:56:28', '2025-04-15 14:56:28'),
(408, 26, 30, 'new_follow', 'App\\Models\\User', 26, 0, '2025-04-16 15:51:04', '2025-04-16 15:51:04'),
(409, 30, 30, 'new_reply', 'App\\Models\\Post', 207, 0, '2025-04-16 16:12:28', '2025-04-16 16:12:28'),
(410, 30, 30, 'new_reply', 'App\\Models\\Post', 207, 0, '2025-04-16 16:20:59', '2025-04-16 16:20:59'),
(411, 26, 26, 'new_like', 'App\\Models\\Post', 205, 0, '2025-04-19 07:50:17', '2025-04-19 07:50:17'),
(412, 26, 26, 'new_like', 'App\\Models\\Post', 209, 0, '2025-04-19 08:25:07', '2025-04-19 08:25:07'),
(413, 26, 26, 'new_like', 'App\\Models\\Post', 208, 0, '2025-04-19 08:25:12', '2025-04-19 08:25:12'),
(414, 26, 26, 'mention', 'App\\Models\\Post', 211, 0, '2025-04-19 08:38:20', '2025-04-19 08:38:20'),
(415, 27, 26, 'new_reply', 'App\\Models\\Post', 212, 0, '2025-04-20 15:42:52', '2025-04-20 15:42:52'),
(416, 27, 26, 'new_reply', 'App\\Models\\Post', 212, 0, '2025-05-05 14:39:20', '2025-05-05 14:39:20'),
(417, 30, 30, 'new_reply', 'App\\Models\\Post', 213, 0, '2025-05-07 08:29:55', '2025-05-07 08:29:55'),
(418, 30, 30, 'new_like', 'App\\Models\\Post', 214, 0, '2025-05-08 04:50:44', '2025-05-08 04:50:44'),
(419, 27, 30, 'new_reply', 'App\\Models\\Post', 212, 0, '2025-05-10 07:41:35', '2025-05-10 07:41:35'),
(420, 27, 30, 'new_like', 'App\\Models\\Post', 212, 0, '2025-05-10 08:45:10', '2025-05-10 08:45:10'),
(421, 27, 30, 'new_reply', 'App\\Models\\Post', 212, 0, '2025-05-10 08:45:22', '2025-05-10 08:45:22'),
(422, 27, 30, 'new_like', 'App\\Models\\Post', 212, 0, '2025-05-10 09:26:38', '2025-05-10 09:26:38'),
(423, 27, 30, 'new_like', 'App\\Models\\Post', 212, 0, '2025-05-10 09:28:08', '2025-05-10 09:28:08'),
(424, 27, 30, 'new_reply', 'App\\Models\\Post', 212, 0, '2025-05-10 09:43:41', '2025-05-10 09:43:41'),
(425, 30, 30, 'new_reply', 'App\\Models\\Post', 215, 0, '2025-05-11 14:27:36', '2025-05-11 14:27:36'),
(426, 30, 27, 'new_reply', 'App\\Models\\Post', 216, 0, '2025-05-11 14:42:36', '2025-05-11 14:42:36'),
(427, 30, 27, 'new_reply', 'App\\Models\\Post', 216, 0, '2025-05-11 14:42:58', '2025-05-11 14:42:58'),
(428, 30, 27, 'new_reply', 'App\\Models\\Post', 216, 0, '2025-05-11 14:43:14', '2025-05-11 14:43:14'),
(429, 30, 27, 'new_reply', 'App\\Models\\Post', 216, 0, '2025-05-11 14:43:18', '2025-05-11 14:43:18'),
(430, 30, 27, 'new_reply', 'App\\Models\\Post', 216, 0, '2025-05-11 14:44:12', '2025-05-11 14:44:12'),
(431, 30, 27, 'new_reply', 'App\\Models\\Post', 216, 0, '2025-05-11 14:47:36', '2025-05-11 14:47:36'),
(432, 30, 27, 'new_reply', 'App\\Models\\Post', 216, 0, '2025-05-11 14:48:16', '2025-05-11 14:48:16'),
(433, 30, 27, 'new_reply', 'App\\Models\\Post', 216, 0, '2025-05-11 14:49:03', '2025-05-11 14:49:03'),
(434, 30, 27, 'new_reply', 'App\\Models\\Post', 216, 0, '2025-05-11 15:14:56', '2025-05-11 15:14:56'),
(435, 30, 27, 'new_reply', 'App\\Models\\Post', 216, 0, '2025-05-11 15:15:05', '2025-05-11 15:15:05'),
(436, 30, 27, 'new_reply', 'App\\Models\\Post', 216, 0, '2025-05-11 15:40:27', '2025-05-11 15:40:27'),
(437, 30, 27, 'new_reply', 'App\\Models\\Post', 216, 0, '2025-05-11 15:40:33', '2025-05-11 15:40:33'),
(438, 30, 30, 'new_reply', 'App\\Models\\Post', 216, 0, '2025-05-12 14:38:08', '2025-05-12 14:38:08'),
(439, 30, 30, 'new_reply', 'App\\Models\\Post', 216, 0, '2025-05-12 14:39:05', '2025-05-12 14:39:05'),
(440, 30, 30, 'new_reply', 'App\\Models\\Post', 216, 0, '2025-05-12 14:49:19', '2025-05-12 14:49:19'),
(441, 30, 30, 'new_reply', 'App\\Models\\Post', 216, 0, '2025-05-12 14:49:41', '2025-05-12 14:49:41'),
(442, 30, 30, 'new_reply', 'App\\Models\\Post', 216, 0, '2025-05-12 14:50:46', '2025-05-12 14:50:46'),
(443, 30, 30, 'new_reply', 'App\\Models\\Post', 216, 0, '2025-05-12 14:51:29', '2025-05-12 14:51:29'),
(444, 30, 30, 'new_reply', 'App\\Models\\Post', 216, 0, '2025-05-12 14:54:34', '2025-05-12 14:54:34'),
(445, 30, 30, 'new_reply', 'App\\Models\\Post', 216, 0, '2025-05-12 15:28:46', '2025-05-12 15:28:46'),
(446, 30, 30, 'new_reply', 'App\\Models\\Post', 216, 0, '2025-05-12 15:28:56', '2025-05-12 15:28:56'),
(447, 30, 30, 'new_reply', 'App\\Models\\Post', 216, 0, '2025-05-12 15:32:42', '2025-05-12 15:32:42'),
(448, 30, 30, 'new_reply', 'App\\Models\\Post', 216, 0, '2025-05-12 15:32:47', '2025-05-12 15:32:47'),
(449, 30, 30, 'new_reply', 'App\\Models\\Post', 216, 0, '2025-05-12 15:32:52', '2025-05-12 15:32:52'),
(450, 30, 30, 'new_reply', 'App\\Models\\Post', 216, 0, '2025-05-12 15:34:35', '2025-05-12 15:34:35'),
(451, 30, 30, 'new_reply', 'App\\Models\\Post', 216, 0, '2025-05-12 15:34:44', '2025-05-12 15:34:44'),
(452, 30, 30, 'new_reply', 'App\\Models\\Post', 216, 0, '2025-05-12 15:34:57', '2025-05-12 15:34:57'),
(453, 30, 30, 'new_reply', 'App\\Models\\Post', 216, 0, '2025-05-13 16:07:33', '2025-05-13 16:07:33'),
(454, 30, 30, 'new_reply', 'App\\Models\\Post', 216, 0, '2025-05-13 16:07:43', '2025-05-13 16:07:43'),
(455, 30, 30, 'new_reply', 'App\\Models\\Post', 216, 0, '2025-05-13 17:03:21', '2025-05-13 17:03:21'),
(456, 30, 30, 'new_reply', 'App\\Models\\Post', 216, 0, '2025-05-13 17:15:20', '2025-05-13 17:15:20'),
(457, 30, 30, 'new_reply', 'App\\Models\\Post', 216, 0, '2025-05-13 17:15:25', '2025-05-13 17:15:25'),
(458, 30, 30, 'new_reply', 'App\\Models\\Post', 216, 0, '2025-05-13 17:15:38', '2025-05-13 17:15:38'),
(459, 30, 30, 'new_reply', 'App\\Models\\Post', 216, 0, '2025-05-16 08:11:08', '2025-05-16 08:11:08'),
(460, 30, 30, 'new_reply', 'App\\Models\\Post', 216, 0, '2025-05-16 08:11:33', '2025-05-16 08:11:33'),
(461, 30, 30, 'new_reply', 'App\\Models\\Post', 216, 0, '2025-05-16 09:13:48', '2025-05-16 09:13:48'),
(462, 30, 30, 'new_reply', 'App\\Models\\Post', 216, 0, '2025-05-16 09:14:06', '2025-05-16 09:14:06'),
(463, 30, 30, 'new_reply', 'App\\Models\\Post', 216, 0, '2025-05-16 09:14:18', '2025-05-16 09:14:18'),
(464, 30, 30, 'new_reply', 'App\\Models\\Post', 216, 0, '2025-05-16 09:16:34', '2025-05-16 09:16:34'),
(465, 30, 30, 'new_reply', 'App\\Models\\Post', 216, 0, '2025-05-16 09:17:39', '2025-05-16 09:17:39'),
(466, 30, 30, 'new_reply', 'App\\Models\\Post', 216, 0, '2025-05-16 09:17:57', '2025-05-16 09:17:57'),
(467, 30, 30, 'new_reply', 'App\\Models\\Post', 216, 0, '2025-05-16 09:18:11', '2025-05-16 09:18:11'),
(468, 30, 30, 'new_reply', 'App\\Models\\Post', 216, 0, '2025-05-16 09:18:32', '2025-05-16 09:18:32'),
(469, 30, 30, 'new_reply', 'App\\Models\\Post', 216, 0, '2025-05-16 09:20:34', '2025-05-16 09:20:34'),
(470, 30, 30, 'new_reply', 'App\\Models\\Post', 216, 0, '2025-05-16 09:21:08', '2025-05-16 09:21:08'),
(471, 30, 30, 'new_reply', 'App\\Models\\Post', 216, 0, '2025-05-16 09:22:47', '2025-05-16 09:22:47'),
(472, 30, 30, 'new_reply', 'App\\Models\\Post', 216, 0, '2025-05-16 09:22:55', '2025-05-16 09:22:55'),
(473, 30, 30, 'new_reply', 'App\\Models\\Post', 216, 0, '2025-05-16 09:23:01', '2025-05-16 09:23:01'),
(474, 30, 30, 'new_reply', 'App\\Models\\Post', 216, 0, '2025-05-16 09:24:10', '2025-05-16 09:24:10'),
(475, 30, 30, 'new_reply', 'App\\Models\\Post', 216, 0, '2025-05-16 09:26:44', '2025-05-16 09:26:44'),
(476, 30, 30, 'new_reply', 'App\\Models\\Post', 216, 0, '2025-05-16 09:27:47', '2025-05-16 09:27:47'),
(477, 30, 30, 'new_reply', 'App\\Models\\Post', 216, 0, '2025-05-16 09:29:22', '2025-05-16 09:29:22'),
(478, 30, 30, 'new_reply', 'App\\Models\\Post', 216, 0, '2025-05-16 09:29:33', '2025-05-16 09:29:33'),
(479, 30, 30, 'new_reply', 'App\\Models\\Post', 216, 0, '2025-05-16 09:31:39', '2025-05-16 09:31:39'),
(480, 30, 31, 'new_reply', 'App\\Models\\Post', 215, 0, '2025-05-16 13:48:39', '2025-05-16 13:48:39'),
(481, 30, 31, 'new_reply', 'App\\Models\\Post', 215, 0, '2025-05-16 13:54:02', '2025-05-16 13:54:02'),
(482, 30, 30, 'new_reply', 'App\\Models\\Post', 216, 0, '2025-05-18 15:33:34', '2025-05-18 15:33:34'),
(483, 30, 30, 'new_reply', 'App\\Models\\Post', 216, 0, '2025-05-18 15:35:33', '2025-05-18 15:35:33'),
(484, 30, 30, 'new_reply', 'App\\Models\\Post', 216, 0, '2025-05-18 15:46:30', '2025-05-18 15:46:30'),
(485, 30, 30, 'new_reply', 'App\\Models\\Post', 216, 0, '2025-05-18 15:46:36', '2025-05-18 15:46:36'),
(486, 30, 30, 'new_reply', 'App\\Models\\Post', 216, 0, '2025-05-18 15:53:46', '2025-05-18 15:53:46'),
(487, 30, 30, 'new_reply', 'App\\Models\\Post', 216, 0, '2025-05-18 15:56:50', '2025-05-18 15:56:50'),
(488, 30, 30, 'new_reply', 'App\\Models\\Post', 216, 0, '2025-05-18 15:56:56', '2025-05-18 15:56:56'),
(489, 30, 30, 'new_reply', 'App\\Models\\Post', 216, 0, '2025-05-18 16:53:23', '2025-05-18 16:53:23'),
(490, 30, 30, 'new_reply', 'App\\Models\\Post', 216, 0, '2025-05-18 16:54:04', '2025-05-18 16:54:04'),
(491, 30, 30, 'new_reply', 'App\\Models\\Post', 216, 0, '2025-05-18 16:57:15', '2025-05-18 16:57:15'),
(492, 30, 30, 'new_reply', 'App\\Models\\Post', 216, 0, '2025-05-18 17:01:21', '2025-05-18 17:01:21'),
(493, 30, 30, 'new_reply', 'App\\Models\\Post', 216, 0, '2025-05-18 17:14:58', '2025-05-18 17:14:58'),
(494, 30, 30, 'new_reply', 'App\\Models\\Post', 216, 0, '2025-05-18 17:15:38', '2025-05-18 17:15:38'),
(495, 30, 30, 'new_reply', 'App\\Models\\Post', 216, 0, '2025-05-18 17:15:59', '2025-05-18 17:15:59'),
(496, 30, 31, 'new_reply', 'App\\Models\\Post', 215, 0, '2025-05-18 17:16:37', '2025-05-18 17:16:37'),
(497, 30, 30, 'new_reply', 'App\\Models\\Post', 215, 0, '2025-05-18 17:17:08', '2025-05-18 17:17:08'),
(498, 30, 31, 'new_reply', 'App\\Models\\Post', 215, 0, '2025-05-18 17:18:21', '2025-05-18 17:18:21'),
(499, 4, 31, 'new_reply', 'App\\Models\\Post', 50, 0, '2025-05-19 17:16:44', '2025-05-19 17:16:44'),
(500, 4, 4, 'new_reply', 'App\\Models\\Post', 50, 0, '2025-05-19 17:17:19', '2025-05-19 17:17:19'),
(501, 4, 4, 'new_reply', 'App\\Models\\Post', 50, 0, '2025-05-20 17:28:17', '2025-05-20 17:28:17'),
(502, 4, 4, 'new_reply', 'App\\Models\\Post', 50, 0, '2025-05-20 17:29:10', '2025-05-20 17:29:10'),
(503, 4, 4, 'new_reply', 'App\\Models\\Post', 50, 0, '2025-05-20 17:30:14', '2025-05-20 17:30:14'),
(504, 4, 31, 'new_reply', 'App\\Models\\Post', 50, 0, '2025-05-20 17:32:47', '2025-05-20 17:32:47'),
(505, 4, 4, 'new_reply', 'App\\Models\\Post', 50, 0, '2025-05-20 17:33:51', '2025-05-20 17:33:51');

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
(12, 39, '2025-02-06 19:21:23', 'العربية', 8, 'الانجليزية', 3, NULL, 0, NULL, 0, '2025-02-06 15:57:35', '2025-02-06 16:21:23'),
(14, 207, '2025-04-13 13:19:27', 'Mollitia beatae even', 0, 'Qui quis mollitia co', 0, 'Earum vel quam elit', 0, 'Iste non qui ea exer', 0, '2025-04-13 07:19:27', '2025-04-13 07:19:27'),
(15, 208, '2025-04-16 14:40:30', 'سويسرا', 0, 'ألمانيا', 0, NULL, 0, NULL, 0, '2025-04-15 14:40:30', '2025-04-15 14:40:30'),
(16, 209, '2025-04-16 14:40:56', 'Dolor voluptas autem', 0, 'Nisi vero ea aute ne', 0, 'Dolor eius quibusdam', 0, 'Reprehenderit esse', 0, '2025-04-15 14:40:56', '2025-04-15 14:40:56'),
(17, 216, '2025-05-12 14:31:03', 'الأحمر', 0, 'الأخضر', 0, 'الأصفر', 0, 'الأزرق', 0, '2025-05-11 14:31:03', '2025-05-11 14:31:03');

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
(17, 2, 12, '1', '2025-02-06 16:21:23', '2025-02-06 16:21:23'),
(19, 27, 17, 'الأخضر', '2025-05-11 14:35:56', '2025-05-11 14:35:56');

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
(205, 26, 'منشور علي 1', '[]', 'dc4aecdf-0db5-4b57-bdcf-3fb74c9cadb2', 'normal', '2025-03-27 04:33:09', '2025-03-27 04:33:09'),
(206, 30, 'Quos pariatur Error', '[]', 'b42c6a0d-9567-4ae9-9bd8-e45c660b8cba', 'normal', '2025-04-13 07:19:17', '2025-04-13 07:19:17'),
(207, 30, 'Rerum similique dolo', '[]', '18e0f02d-fffe-4a3e-8b3a-de59fc93e766', 'poll', '2025-04-13 07:19:27', '2025-04-13 07:19:27'),
(208, 26, 'أفضل بلد', '[]', 'bb849486-1ef9-4037-91c2-2b699268dd68', 'poll', '2025-04-15 14:40:30', '2025-04-15 14:40:30'),
(209, 26, 'Totam expedita bland', '[]', 'db86256c-ed44-4e59-98e3-44e2d9c54480', 'poll', '2025-04-15 14:40:56', '2025-04-15 14:40:56'),
(210, 26, 'test', '[\"posts_images\\/1745062219_post_6803894b1181b6.92796274.jpeg\"]', 'ed6c22e9-4d3f-4f54-b9cf-46035073f834', 'normal', '2025-04-19 08:30:19', '2025-04-19 08:30:19'),
(211, 26, '@ali', '[\"posts_images\\/1745062700_post_68038b2c798514.68818884.jpg\"]', '01f7ff85-529b-4b46-be0f-6f56c4a70c11', 'normal', '2025-04-19 08:38:20', '2025-04-19 08:38:20'),
(212, 27, 'hello everybody', '[]', '4d86a119-353f-4bd0-a6d0-845e1130e909', 'normal', '2025-04-20 15:42:30', '2025-04-20 15:42:30'),
(215, 30, '', '[\"posts_images\\/1746881064_post_681f4a2819c0c2.84857722.jpg\"]', 'e0b79e66-8fd9-4d69-ab4e-836da093f389', 'normal', '2025-05-10 09:44:24', '2025-05-10 09:44:24'),
(216, 30, 'أجمل لون؟', '[]', 'a83c1080-e01c-4a2b-b62e-3cad775c79e5', 'poll', '2025-05-11 14:31:03', '2025-05-11 14:31:03');

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
(8, 30, 212, '2025-05-10 09:28:08', '2025-05-10 09:28:08');

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

--
-- Dumping data for table `replies`
--

INSERT INTO `replies` (`id`, `user_id`, `post_id`, `parent_id`, `reply_text`, `reply_image`, `slug_id`, `created_at`, `updated_at`) VALUES
(2, 1, 27, NULL, 'ww', NULL, 'b12448f1-38e6-4468-8d8e-e4e3c769272f', '2025-02-06 10:05:43', '2025-02-06 10:05:43'),
(25, 26, 208, NULL, 'Provident sunt aut', NULL, '20332ae0-42c8-4ddc-b75b-bbcc7a044bff', '2025-04-15 14:56:19', '2025-04-15 14:56:19'),
(26, 26, 208, NULL, 'Molestiae sit labori', NULL, '47778f1d-705e-415f-8ce4-23027d538732', '2025-04-15 14:56:28', '2025-04-15 14:56:28'),
(27, 30, 207, NULL, 'Beatae non quo labor', NULL, 'bd049d12-5894-45cc-93b6-134843975d69', '2025-04-16 16:12:28', '2025-04-16 16:12:28'),
(29, 26, 212, NULL, 'hello mr eskandar', NULL, '04c2f003-6fca-4834-aaff-40b82f537234', '2025-04-20 15:42:52', '2025-04-20 15:42:52'),
(30, 26, 212, NULL, 'Quia non tempora occ', NULL, '9f04b616-daa6-4b25-b73d-40ef17066aa6', '2025-05-05 14:39:20', '2025-05-05 14:39:20'),
(34, 30, 212, NULL, '', 'replies_images/1746881021_reply_681f49fdb0e363.58132669.jpeg', 'faabbed7-d06d-40b1-bc89-39f6ee5dc538', '2025-05-10 09:43:41', '2025-05-10 09:43:41'),
(35, 30, 215, NULL, 'Reprehenderit volupt', NULL, '2b2daa00-667a-47a2-b837-13b9bf01e50c', '2025-05-11 14:27:36', '2025-05-11 14:27:36'),
(38, 27, 216, NULL, 'Molestias voluptas a', NULL, '2b94aa29-47b3-42a2-8d1c-11659e0ebd5a', '2025-05-11 14:43:14', '2025-05-11 14:43:14'),
(39, 27, 216, NULL, 'Et cillum velit quia', NULL, '11e892ff-6b01-4d85-98a3-7dd033106b7d', '2025-05-11 14:43:18', '2025-05-11 14:43:18'),
(40, 27, 216, NULL, 'a', NULL, '3141b300-5b99-43c2-99fc-f7b8d3bd7286', '2025-05-11 14:44:12', '2025-05-11 14:44:12'),
(41, 27, 216, NULL, 'Ab nobis dolor bland', NULL, '7b6ff18f-6d7c-4069-9f5f-6ca8b0bcd9e7', '2025-05-11 14:47:36', '2025-05-11 14:47:36'),
(42, 27, 216, NULL, 'Ad quisquam perferen', NULL, 'c7c45126-9b3d-479e-b030-55ef77b73f44', '2025-05-11 14:48:16', '2025-05-11 14:48:16'),
(43, 27, 216, NULL, 'Architecto numquam a', NULL, '467818c1-0af5-49f8-8663-d07cfe1b158b', '2025-05-11 14:49:03', '2025-05-11 14:49:03'),
(44, 27, 216, NULL, 'Exercitation ex adip', NULL, 'da827c54-9610-4701-bbac-41c8324521a3', '2025-05-11 15:14:55', '2025-05-11 15:14:55'),
(45, 27, 216, NULL, 'Eligendi ipsum lorem', NULL, 'ca9c0e68-59d9-4819-8260-ecf6e4b80a45', '2025-05-11 15:15:05', '2025-05-11 15:15:05'),
(46, 27, 216, NULL, 'Veritatis aut dolore', NULL, '990ee746-7c87-43e5-9a39-8d5bba3188c2', '2025-05-11 15:40:27', '2025-05-11 15:40:27'),
(47, 27, 216, NULL, '', 'replies_images/1746988833_image_6820ef211b83f6.82840932.png', 'd2da8bb9-7096-4943-a113-c788a4e80803', '2025-05-11 15:40:33', '2025-05-11 15:40:33'),
(48, 30, 216, NULL, 'Eum perspiciatis ex', NULL, '9bfc449f-ae05-4b6f-bf2e-8bf05888fa17', '2025-05-12 14:38:07', '2025-05-12 14:38:07'),
(49, 30, 216, NULL, 'Suscipit id labore e', NULL, 'ff484535-cbfc-48a4-9252-02a4fc30aae4', '2025-05-12 14:39:05', '2025-05-12 14:39:05'),
(50, 30, 216, NULL, 'Sunt corporis tempor', NULL, '7fcbfe4c-19d4-4be1-9288-27fbad5d6522', '2025-05-12 14:49:19', '2025-05-12 14:49:19'),
(51, 30, 216, NULL, 'aaa', NULL, '83cbe8ad-4be3-404d-9e1e-598ac2b3ac4a', '2025-05-12 14:49:41', '2025-05-12 14:49:41'),
(52, 30, 216, NULL, 'Soluta provident si', NULL, '7b15f102-417b-4ab3-9117-ca4f2f6f9b12', '2025-05-12 14:50:46', '2025-05-12 14:50:46'),
(53, 30, 216, NULL, 'aa', NULL, 'f3c75a75-3466-4da6-82dd-4e57407a863c', '2025-05-12 14:51:29', '2025-05-12 14:51:29'),
(55, 30, 216, NULL, '🤣🤣🤣', NULL, '07fc6b34-d9b4-44a0-845e-382eda083445', '2025-05-12 15:28:46', '2025-05-12 15:28:46'),
(56, 30, 216, NULL, '', 'replies_images/1747074536_image_68223de84a8195.95253999.png', 'd1dcc71e-7fd5-4c1a-a673-f956bbe59573', '2025-05-12 15:28:56', '2025-05-12 15:28:56'),
(57, 30, 216, NULL, 'Pariatur Iste quisq', NULL, '3defb284-026e-4592-9954-0384c8430d28', '2025-05-12 15:32:42', '2025-05-12 15:32:42'),
(58, 30, 216, NULL, '😁', NULL, '7d961a11-b0dd-4ec8-9055-09ef3dba4418', '2025-05-12 15:32:47', '2025-05-12 15:32:47'),
(59, 30, 216, NULL, '', 'replies_images/1747074772_image_68223ed49ae043.53438334.png', '68daa5c5-d057-42f3-8aeb-1e18569eefe7', '2025-05-12 15:32:52', '2025-05-12 15:32:52'),
(60, 30, 216, NULL, 'Error similique temp', NULL, '5470ad03-41ce-405f-9477-7d71e417231b', '2025-05-12 15:34:35', '2025-05-12 15:34:35'),
(61, 30, 216, NULL, '', 'replies_images/1747074884_image_68223f44014322.23724577.png', '36d60d9f-cb2a-473e-9169-abd0eddc8c63', '2025-05-12 15:34:44', '2025-05-12 15:34:44'),
(62, 30, 216, NULL, 'Est aliquip earum ul', NULL, 'c5b35d4c-5197-44ad-9037-85937be269c8', '2025-05-12 15:34:57', '2025-05-12 15:34:57'),
(63, 30, 216, NULL, 'Tempora voluptatem', NULL, 'a79dde28-1c37-4018-8e82-192242543ca9', '2025-05-13 16:07:33', '2025-05-13 16:07:33'),
(64, 30, 216, NULL, '', 'replies_images/1747163262_image_6823987ee2d5d7.22189627.png', 'c2d89a93-21fe-49ad-8ee3-a31609cc1ef1', '2025-05-13 16:07:42', '2025-05-13 16:07:42'),
(65, 30, 216, NULL, 'Similique dignissimo', NULL, '6ccdd259-09e7-41cf-8706-0e91e4aa2d58', '2025-05-13 17:03:21', '2025-05-13 17:03:21'),
(66, 30, 216, NULL, 'Sed explicabo Enim', NULL, '180ea08f-3313-4d76-b45d-f8dddc68f748', '2025-05-13 17:15:20', '2025-05-13 17:15:20'),
(67, 30, 216, NULL, '1', NULL, 'f4cdd77c-0b47-4958-80c3-8124d0843d21', '2025-05-13 17:15:25', '2025-05-13 17:15:25'),
(69, 30, 216, NULL, 'testi', NULL, 'c5b1dd32-1ed6-4893-bd93-75948a64d491', '2025-05-16 08:11:08', '2025-05-16 08:11:08'),
(70, 30, 216, 69, 'testi chid', NULL, '22e50f75-136c-42b4-a2e7-3cbffc6056b4', '2025-05-16 08:11:33', '2025-05-16 08:11:33'),
(71, 30, 216, NULL, 'Illo veniam possimu', NULL, 'b23d4f14-86a4-42a2-b8e9-bfa3e822d640', '2025-05-16 09:13:48', '2025-05-16 09:13:48'),
(72, 30, 216, NULL, 'Illo veniam possimu', NULL, '9fbfd6de-38de-4f9f-9753-00ec1001fbed', '2025-05-16 09:14:06', '2025-05-16 09:14:06'),
(73, 30, 216, NULL, 'Illo veniam possimu', NULL, '3f88bd91-01ad-48bf-b7d5-c657ea393eea', '2025-05-16 09:14:18', '2025-05-16 09:14:18'),
(84, 30, 216, NULL, 'tettttttttttt', NULL, '5b9de005-9fe3-4658-a4d9-7301ace80b7f', '2025-05-16 09:24:09', '2025-05-16 09:24:09'),
(85, 30, 216, NULL, 'Et laudantium solut', NULL, '0585a69c-5d02-4ffb-9207-f69b3a3caa66', '2025-05-16 09:26:44', '2025-05-16 09:26:44'),
(86, 30, 216, NULL, 'aaa', NULL, '38116c6f-de72-4a79-823b-b129cd0b0619', '2025-05-16 09:27:47', '2025-05-16 09:27:47'),
(87, 30, 216, NULL, 'Dolores blanditiis c', NULL, '70017f34-2a88-447c-ad57-c1ee308afab8', '2025-05-16 09:29:22', '2025-05-16 09:29:22'),
(88, 30, 216, NULL, 'Quod est in rerum of', NULL, '5907a7b5-d9c9-4e99-8a9b-32d7fdbe4db9', '2025-05-16 09:29:33', '2025-05-16 09:29:33'),
(89, 30, 216, NULL, 'Molestias architecto', NULL, 'c70a7ea6-6e41-4919-a04f-2cf5f3c3ce87', '2025-05-16 09:31:39', '2025-05-16 09:31:39'),
(91, 31, 215, NULL, 'أجمل مدينة في التااااريخ', NULL, 'dd7612dc-8282-4c2d-9008-6857093a9bca', '2025-05-16 13:54:02', '2025-05-16 13:54:02'),
(92, 30, 216, NULL, 'Dolorem ad recusanda', NULL, '2b1c043e-6f4f-424c-8033-1d31a0979f8a', '2025-05-18 15:33:34', '2025-05-18 15:33:34'),
(93, 30, 216, NULL, '', 'replies_images/1747593332_image_682a2874c76b24.85612214.png', '97368c68-d63f-4802-8ec4-6abc18dda3fc', '2025-05-18 15:35:32', '2025-05-18 15:35:32'),
(94, 30, 216, NULL, 'Praesentium ex dolor', NULL, 'd9df4ce5-6445-47ec-b905-efdd6f5abb7d', '2025-05-18 15:46:29', '2025-05-18 15:46:29'),
(95, 30, 216, NULL, '', 'replies_images/1747593996_image_682a2b0c11bac1.26958436.png', '4445b2ee-7fb8-42b2-bf0c-a3ad58c51371', '2025-05-18 15:46:36', '2025-05-18 15:46:36'),
(96, 30, 216, NULL, 'aaaaa', NULL, '225506b4-8d65-4a47-afff-955f8a24c118', '2025-05-18 15:53:46', '2025-05-18 15:53:46'),
(97, 30, 216, NULL, 'Qui qui impedit rei', NULL, '2e5199f3-4f59-4599-b516-2791ff835dfc', '2025-05-18 15:56:50', '2025-05-18 15:56:50'),
(98, 30, 216, NULL, '', 'replies_images/1747594616_image_682a2d78213ff1.01354800.png', '30f7ab4d-5dcc-4748-853c-694d0261f4d6', '2025-05-18 15:56:56', '2025-05-18 15:56:56'),
(99, 30, 216, 95, 'Et qui odit est labo', NULL, '6c7527fc-a6b4-4612-85af-f60de78821f0', '2025-05-18 16:53:23', '2025-05-18 16:53:23'),
(100, 30, 216, 99, 'wwwwwwwwww', NULL, '586403ac-7122-485d-8a89-eb9fa35cc8db', '2025-05-18 16:54:04', '2025-05-18 16:54:04'),
(101, 30, 216, 100, 'Magna in obcaecati i', NULL, 'b51963cf-6903-4964-a9fb-6feee22e8548', '2025-05-18 16:57:15', '2025-05-18 16:57:15'),
(102, 30, 216, 95, 'test', NULL, '461ed344-7700-45c6-a8bd-969f727fa393', '2025-05-18 17:01:21', '2025-05-18 17:01:21'),
(103, 30, 216, 101, 'that is right', NULL, '495124dd-ce69-4d8a-af09-c327ed0b3a6e', '2025-05-18 17:14:58', '2025-05-18 17:14:58'),
(104, 30, 216, NULL, 'Eius aliquip nisi lo', NULL, 'b4d4ea1f-e154-4854-9324-f4fdd4ac30a6', '2025-05-18 17:15:38', '2025-05-18 17:15:38'),
(105, 30, 216, 96, 'bbbb', NULL, '4fd93a01-7309-450c-af11-e00a40b51bde', '2025-05-18 17:15:59', '2025-05-18 17:15:59'),
(106, 31, 215, NULL, 'wow', NULL, '34a30603-e6d7-4f2e-929c-c784356f015d', '2025-05-18 17:16:37', '2025-05-18 17:16:37'),
(107, 30, 215, 106, 'yes wow', NULL, 'b4caecb7-6b3e-47af-b273-ef7c5104d8c5', '2025-05-18 17:17:08', '2025-05-18 17:17:08'),
(108, 31, 215, 106, 'wow num 2', NULL, 'c32c77ef-efd5-4a3a-b193-6be7e324d69c', '2025-05-18 17:18:21', '2025-05-18 17:18:21'),
(109, 31, 50, NULL, 'الحمدلله بخير انت كيفك', NULL, '9fd3c8aa-0b2d-4c48-a6d3-34aa2faac9c0', '2025-05-19 17:16:43', '2025-05-19 17:16:43'),
(110, 4, 50, 109, 'الحمدلله', NULL, '3e57ea3d-2183-4f2a-addc-ac45160725b2', '2025-05-19 17:17:19', '2025-05-19 17:17:19'),
(111, 4, 50, NULL, 'Explicabo Deleniti', NULL, 'ef26d2f2-3814-40ff-bc8c-fdf3fcd988b7', '2025-05-20 17:28:17', '2025-05-20 17:28:17'),
(112, 4, 50, 109, 'Et sed laborum Debi', NULL, 'a5b9d8f5-dcf1-4e43-b4fa-51e5c6e487b2', '2025-05-20 17:29:10', '2025-05-20 17:29:10'),
(113, 4, 50, 111, 'مرحبا', NULL, '3162c85a-b3ee-4347-85ef-2e1e8be49685', '2025-05-20 17:30:14', '2025-05-20 17:30:14'),
(114, 31, 50, NULL, 'تمام', NULL, 'a84cd701-add0-4fe0-be2b-1e892da29d4d', '2025-05-20 17:32:47', '2025-05-20 17:32:47'),
(115, 4, 50, 114, 'دوما إن شاء الله', NULL, '5af837fb-4416-4d43-b651-7afb4e6eda07', '2025-05-20 17:33:51', '2025-05-20 17:33:51');

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
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `payable_type` varchar(255) NOT NULL,
  `payable_id` bigint(20) UNSIGNED NOT NULL,
  `wallet_id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('deposit','withdraw') NOT NULL,
  `amount` decimal(64,0) NOT NULL,
  `confirmed` tinyint(1) NOT NULL,
  `meta` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`meta`)),
  `uuid` char(36) NOT NULL,
  `capture_id` varchar(255) DEFAULT NULL,
  `payment_method` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT 'PENDING',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `payable_type`, `payable_id`, `wallet_id`, `type`, `amount`, `confirmed`, `meta`, `uuid`, `capture_id`, `payment_method`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'App\\Models\\User', 31, 1, 'deposit', 1000, 1, '[]', '0197b09e-dbb2-72ae-af08-d062e37ce488', '1KN03292F5225551J', 'Debit/Credit card', 'COMPLETED', '2025-06-27 06:01:30', '2025-06-27 06:01:30', NULL),
(2, 'App\\Models\\User', 31, 1, 'withdraw', -20, 1, '{\"transfer_note_en\":\"Transfer from @<a class=\'text-reset text-decoration-none\' href=\'http:\\/\\/localhost:8000\\/osama\'>osama<\\/a> to @<a class=\'text-reset text-decoration-none\' href=\'http:\\/\\/localhost:8000\\/rashed\'>rashed<\\/a>\",\"transfer_note_ar\":\"\\u062a\\u062d\\u0648\\u064a\\u0644 \\u0645\\u0646 @<a class=\'text-reset text-decoration-none\' href=\'http:\\/\\/localhost:8000\\/osama\'>osama<\\/a> \\u0625\\u0644\\u0649 @<a class=\'text-reset text-decoration-none\' href=\'http:\\/\\/localhost:8000\\/rashed\'>rashed<\\/a>\"}', '0197b09f-4c95-728e-8cee-ac290437a2ae', NULL, NULL, 'PENDING', '2025-06-27 06:01:59', '2025-06-27 06:01:59', NULL),
(3, 'App\\Models\\User', 4, 2, 'deposit', 20, 1, '{\"transfer_note_en\":\"Transfer from @<a class=\'text-reset text-decoration-none\' href=\'http:\\/\\/localhost:8000\\/osama\'>osama<\\/a> to @<a class=\'text-reset text-decoration-none\' href=\'http:\\/\\/localhost:8000\\/rashed\'>rashed<\\/a>\",\"transfer_note_ar\":\"\\u062a\\u062d\\u0648\\u064a\\u0644 \\u0645\\u0646 @<a class=\'text-reset text-decoration-none\' href=\'http:\\/\\/localhost:8000\\/osama\'>osama<\\/a> \\u0625\\u0644\\u0649 @<a class=\'text-reset text-decoration-none\' href=\'http:\\/\\/localhost:8000\\/rashed\'>rashed<\\/a>\"}', '0197b09f-4c95-728e-8cee-ac2904fefe91', NULL, NULL, 'PENDING', '2025-06-27 06:01:59', '2025-06-27 06:01:59', NULL),
(4, 'App\\Models\\User', 31, 1, 'withdraw', -20, 1, '{\"transfer_note_en\":\"Transfer from @<a class=\'text-reset text-decoration-none\' href=\'http:\\/\\/localhost:8000\\/osama\'>osama<\\/a> to @<a class=\'text-reset text-decoration-none\' href=\'http:\\/\\/localhost:8000\\/rashed\'>rashed<\\/a>\",\"transfer_note_ar\":\"\\u062a\\u062d\\u0648\\u064a\\u0644 \\u0645\\u0646 @<a class=\'text-reset text-decoration-none\' href=\'http:\\/\\/localhost:8000\\/osama\'>osama<\\/a> \\u0625\\u0644\\u0649 @<a class=\'text-reset text-decoration-none\' href=\'http:\\/\\/localhost:8000\\/rashed\'>rashed<\\/a>\"}', '0197b09f-8cba-731f-9658-a5a4c30d0827', NULL, NULL, 'PENDING', '2025-06-27 06:02:15', '2025-06-27 06:02:15', NULL),
(5, 'App\\Models\\User', 4, 2, 'deposit', 20, 1, '{\"transfer_note_en\":\"Transfer from @<a class=\'text-reset text-decoration-none\' href=\'http:\\/\\/localhost:8000\\/osama\'>osama<\\/a> to @<a class=\'text-reset text-decoration-none\' href=\'http:\\/\\/localhost:8000\\/rashed\'>rashed<\\/a>\",\"transfer_note_ar\":\"\\u062a\\u062d\\u0648\\u064a\\u0644 \\u0645\\u0646 @<a class=\'text-reset text-decoration-none\' href=\'http:\\/\\/localhost:8000\\/osama\'>osama<\\/a> \\u0625\\u0644\\u0649 @<a class=\'text-reset text-decoration-none\' href=\'http:\\/\\/localhost:8000\\/rashed\'>rashed<\\/a>\"}', '0197b09f-8cba-731f-9658-a5a4c35cc6e8', NULL, NULL, 'PENDING', '2025-06-27 06:02:15', '2025-06-27 06:02:15', NULL);

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

--
-- Dumping data for table `transfers`
--

INSERT INTO `transfers` (`id`, `from_id`, `to_id`, `status`, `status_last`, `deposit_id`, `withdraw_id`, `discount`, `fee`, `extra`, `uuid`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 2, 'transfer', NULL, 3, 2, 0, 0, NULL, '0197b09f-4dfa-715c-b18f-932791ad7a5a', '2025-06-27 06:01:59', '2025-06-27 06:01:59', NULL),
(2, 1, 2, 'transfer', NULL, 5, 4, 0, 0, NULL, '0197b09f-8d49-73e5-b723-5c867b02fcc6', '2025-06-27 06:02:15', '2025-06-27 06:02:15', NULL);

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
(1, 'Nathan Petersen', 'nader', 'ammar@gmail.com', NULL, '$2y$12$hsSU5/0phTG3xY.yIt8/ke.kWcZ/aUgjactu6pZv7oBQqYxGdHXj2', 'PllrHeBp8rTTRaMVSkoVB2OzCb8ui00fwQcbe2RmApDXuYxwvPekhhzgazH1', 'user', 'no', 'private', 1, '2025-02-17 15:17:53', '2025-02-06 00:05:55', '2025-02-17 15:17:53', NULL, 0),
(2, 'muna saif', 'muna', 'muna@gmail.com', NULL, '$2y$12$6ZMS8zuIxEYjn2zk5w6aCuJxxSBk9EDcQY0ylzsuGeCMqLMHWIzXK', 'bpIMChgiWLuYRY0k7nriGZfIAFkiU8Pv0cB2JjahlhHojmBQz8B85I00xyhj', 'user', 'no', 'public', 1, '2025-02-06 16:26:13', '2025-02-06 10:53:46', '2025-02-06 16:26:13', NULL, 0),
(3, 'tadween', 'admin', 'admin@gmail.com', NULL, '$2y$12$k9C6cfjNUCUvBmGEaf8StO8Cp8Np5b9j055CO/RuRtwY5.Mqur8r.', 'XpXxJ9fXQIAvrcXyitmOcRkA8vNhpGmfHR1K95s60fpQp4y8SnxGa58e4WUT', 'admin', 'no', 'public', 1, '2025-06-09 03:51:53', '2025-02-07 04:33:17', '2025-06-09 03:51:53', NULL, 0),
(4, 'راشد', 'rashed', 'rashedlb606@gmail.com', NULL, '$2y$12$cP1z.q32518MFT4DUxdBlORVB2Ja8QfZRGKM912xsnZXM22nr7tia', 'c9p81MyvUkNH4uNoTY4z7kRfJLvj3jwSLcnt9r2rdcj28mG0eC6mMckvbY8r', 'user', 'no', 'public', 1, '2025-06-23 15:32:06', '2025-02-07 19:53:43', '2025-06-23 15:32:06', NULL, 0),
(5, 'Mohamed', 'M', 'mohmed0530459@gmail.com', NULL, '$2y$12$87JWyxCckfVAVgS9sVpoaO7QNE7Us9aM6Hh6AZON/IhvF..zzVuMi', 'fdLaiZsrlfFMNyRuzO32VjAQmClwJDByTVbOWPV1KvkXIhoDWyc1DstfRhfe', 'user', 'no', 'public', 1, '2025-02-07 22:01:06', '2025-02-07 22:00:59', '2025-02-07 22:01:06', NULL, 0),
(6, 'Hussam', 'hussam', 'me@hussam.pw', NULL, '$2y$12$./OypoGSu/oifB7osrzD9OBr6rcYxPQVdK3whdqYVIG84LpjOXPv6', 'JWXST4M8TUvTasYQYAm6auy53MpH0ur4VNQ9Rr6H2aeLuHFgWUlF0rkTmnaa', 'user', 'no', 'public', 1, '2025-02-08 06:52:00', '2025-02-08 06:48:53', '2025-02-08 06:52:00', NULL, 0),
(7, 'hazem', 'elsayed', 'hazem.elsayed8@gmail.com', NULL, '$2y$12$hGbqofTvQcm9f1VczTGXeuYAN4Er3j8NPpVDkwmdhH0rYuVgdtQMG', 'ywoGB3UBFckfpLSH0ydFoqfXa7TbHBE3gPutxhc2PLngwwenqiyNMSB4HTo3', 'user', 'no', 'public', 1, '2025-02-08 07:56:32', '2025-02-08 07:56:30', '2025-02-08 07:56:32', NULL, 0),
(8, 'Ahmed Ragab', 'ragaboka', 'ragaboka543@gmail.com', NULL, '$2y$12$5xJVg8lVC76sfIqnZ/Ei8upR.HDNq8mGvN.j2Pk4aBeWiarRtr0uS', 'r3BfGzGtdSe706Efc3bCWBSkIrpm6vQRktdteVONMrFKGJEHS2FIQo2S3XAA', 'user', 'no', 'public', 1, '2025-02-08 11:41:50', '2025-02-08 08:38:08', '2025-02-08 11:41:50', NULL, 0),
(9, 'Sh', 'A', 'Shoog77@gmail.com', NULL, '$2y$12$EPnNhUi/DYE1NF9Uk/DCT.D58Al/I00ZI8uGwfpR7zJnhHbsVf1ES', 'J81XHANVoDq9R3nyr3OkQ5djREQLKCpaqvHD3fN6AAzuHxydgo2Qd401ZH94', 'user', 'no', 'public', 1, NULL, '2025-02-08 12:40:26', '2025-02-08 12:40:26', NULL, 0),
(10, 'test', 'test', 'test@gmail.com', NULL, '$2y$12$wzM/afIvSR34nExW.Wh83.KqaJfuOi4H.OyNpO4GZcdM7qw5C30Sm', 'zjRj6f97QjSFwtYI654adyGII0yHMxDU96abtuztcg7HwnR3daWMVKtNvULt', 'user', 'no', 'public', 1, '2025-02-11 09:03:48', '2025-02-11 09:03:24', '2025-02-11 09:03:48', NULL, 0),
(11, 'aa', 'aa', 'aa@gmail.com', NULL, '$2y$12$qz4hSmGlr0VV3khJuHpQpe8JsnkAwPOIXraUjgaN/7McRRQrDcvvq', '1D7hnfjwuf7IYvJimqME9GdyPU7hnBsU2kE30U3IAKPg556cR81SVCXxVdHw', 'user', 'no', 'public', 1, '2025-02-15 15:41:26', '2025-02-15 15:22:34', '2025-02-15 15:41:26', NULL, 0),
(13, 'Ahmad Ibrahim', 'ahmad', 'ahmad@gmail.com', NULL, '$2y$12$jusJtaBbPT8mvoa.3kmQu.f37uDiuWRITDWt99WkS8vrXCnA/jqO2', 'gboDy3xKrFDnM2YqzeLkwBxr938SB61fffdAml2gWdJArTFyz8z2Y2llzC84', 'user', 'no', 'public', 1, '2025-02-17 14:50:28', '2025-02-17 14:38:53', '2025-02-17 14:50:28', NULL, 0),
(14, 'Rose Moustafa', 'rose', 'meral@gmail.com', NULL, '$2y$12$wNxOPP4K70eRliRZUnWReuGDQBluBsKsZVuN8cHPt9hJjw/FQ2f7G', 'CfUKpvK372ub7xVW3sRRu7lWrdhHvK0fpNtlXa4x60V1CBv7tBU7fwsTcZsl', 'user', 'no', 'private', 1, '2025-02-20 17:16:24', '2025-02-17 18:19:51', '2025-02-20 17:16:24', NULL, 0),
(15, 'ماهر الحميدي', 'maher', 'maher@gmail.com', NULL, '$2y$12$cP1z.q32518MFT4DUxdBlORVB2Ja8QfZRGKM912xsnZXM22nr7tia', 'JOvzkLG0gOI7UTf4Ox12CNUaHq5kbVWagnwoJp9GuP9PMXkEXVCsPGZKT5Ci', 'user', 'no', 'private', 1, '2025-06-23 15:10:40', '2025-02-20 17:17:41', '2025-06-23 15:10:40', NULL, 0),
(16, 'Fadi', 'fadii', 'fadii@gmail.com', NULL, '$2y$12$y1JJu7ySvnjt2WsKJq2a1.cJxaW5fk7u5R/Ziz1GuCPSsmT2w5rre', 'A4fwsHaGJpFokIrCRiqYeAYX8i8NFNZlMRJD8FvDmjjtPPC6gc7p2iBcCdtg', 'user', 'no', 'private', 1, '2025-03-04 14:17:01', '2025-02-20 17:18:14', '2025-03-04 14:17:01', NULL, 0),
(17, 'Mohammad Saker', 'saker', 'saker@gmail.com', NULL, '$2y$12$kJmAgY.u8JaTXO6L0i4kKeMYSp9m9gqn00T4IMBP4ZGB.KLPLCx0K', 'Vm364x2KvoZs1jXgRrlIXH19jVEpm3B8m7t4kdlYVzJ3ogevAzzPZgrvVBiU', 'user', 'no', 'private', 1, '2025-03-04 10:51:55', '2025-02-22 07:17:00', '2025-03-04 10:51:55', NULL, 0),
(18, 'عبير', 'abeer', 'abeer@gmail.com', NULL, '$2y$12$cy7NPVVTWRkxA7ORpMz7ceWTr3mCSHDIr7pXFC6gPqkpqMaMXfhIC', '7rLnTg0dD05sUSgdlNkzBdUVfnKU9wjrFrBQLy6jJJI0UAbvU9CEVyWsZzpH', 'user', 'no', 'private', 1, '2025-03-04 12:03:50', '2025-02-25 14:41:55', '2025-03-04 12:04:09', NULL, 0),
(19, 'Bassam Mohammad', 'bassam', 'bassam@gmail.com', NULL, '$2y$12$QTLJ95xv1g1vL3HGc32OOuLg4KqAuWyCyPSSNuYK/I.divGvLpB7C', 'lgLU9PbkRgrZyH9KD82qVmZ9YsNh71fbXaa4E07WyXh7paPUDKsg0Syt0Ttb', 'user', 'no', 'private', 1, '2025-03-04 17:06:15', '2025-03-04 14:17:52', '2025-03-04 17:06:15', NULL, 0),
(20, 'Mahmoud Mohammad', 'mahmoud', 'mahmoud@gmail.com', NULL, '$2y$12$z.I7tWdzIiKKv51NXn9Js.3I2ehrAxWZ0wzKUuceAOBUwHw7Bbu.m', 'cu2Heiwnoly8grAfwdqxKstp88KvpmPREbd25aUPj8AWFE5gmpjTKiKE4WbY', 'user', 'no', 'public', 1, '2025-03-04 16:30:53', '2025-03-04 14:19:09', '2025-03-04 16:30:53', NULL, 0),
(21, 'Rahaf Mohammad', 'rahaf', 'rahaf@gmail.com', NULL, '$2y$12$m.Xph1sn71P4ufOnTOPPW.sHZnWIOfuSG0eLYkBzQDL65.WZOo2sm', 'P88zgnCvvw2CkBccLHOzebji6dXi8Z4kawkGlrshpg8yvsm55wChOr0eoN1y', 'user', 'no', 'public', 1, '2025-03-04 16:06:22', '2025-03-04 14:26:26', '2025-03-04 16:06:22', NULL, 0),
(22, 'Tammam Hammoud', 'tammam', 'tammam@gmail.com', NULL, '$2y$12$s/xSSX45JjZQLpNOBcJuZe.VUC5ypOdS5AleKwP3DrFnB4PepoKnG', 's3oYgLl5LtxsGfBf1459l2OYdihisodJAXyHYCjaJzIgjeP4tmW3R5oY7YsK', 'user', 'no', 'private', 1, '2025-03-04 17:59:32', '2025-03-04 17:14:57', '2025-03-04 17:59:32', NULL, 0),
(23, 'Adham Jannoud', 'adham', 'adham@gmail.com', NULL, '$2y$12$qLUHVcJLT7aBY57DTiO3.uhmNhGEHmlORiP.IU63dHk1t3t/jEKtq', 'd6B4WSf3xFurU5Cg9ZN57g7n96muZ9WK3pLsjEgOHEaK7EvNZaeqmnqoOfvP', 'user', 'no', 'public', 1, '2025-03-04 17:58:27', '2025-03-04 17:16:00', '2025-03-04 17:58:27', NULL, 0),
(24, 'Ragad', 'ragad', 'ragad@gmail.com', NULL, '$2y$12$BQV2O6rqxgANUJoojDWjEO6S56VqH0i0qLr2LNElJ.fGVhT/IcDMm', '9RJu20Ow2B7IrzRcxQOdmTk4kviqbdPIUmO6quP2QEnJJ9WGZn3Moa0xXret', 'user', 'no', 'public', 1, '2025-03-04 18:00:43', '2025-03-04 17:40:54', '2025-03-04 18:00:43', NULL, 0),
(25, 'Muhia Ibrahim', 'muhia', 'muhia@gmail.com', NULL, '$2y$12$BOHDS/ICk9EB9qgLOR7vu.vfpeDvANntUgzwZczAQhymE8w41vWWO', 'up792p9nzrz23Auk1C4KLPdZ6TBTpTe1b8U0JIDALu2PO7mMTe0vkMVJbN72', 'user', 'no', 'public', 1, '2025-04-13 06:19:52', '2025-03-08 15:13:07', '2025-04-13 06:19:52', NULL, 0),
(26, 'Ali Ibrahim', 'ali', 'ali@gmail.com', NULL, '$2y$12$ZKd/6gjKhqvirvIPSUgARO2wc4IgeOLzc0A1DtsYN9FtX6zn8GmBW', 'hh4hYm4NzBvcgR5PFRzPyGdXYIm9NjViwL2AzbMWVE6Jm0kWIA3lOkQE69lE', 'user', 'no', 'private', 1, '2025-05-05 17:03:40', '2025-03-08 15:14:27', '2025-05-05 17:03:40', NULL, 0),
(27, 'Eskandar Ali', 'eskandar', 'e@gmail.com', NULL, '$2y$12$LAYASSZVjl2w5E0e5HInqeJ7Z.tn9IrF/mH/XNStGQ8DmmGcpFxcm', 'ot3XM27Rj6dAakL460YHzBgZQSCqGehnfSAhDQdgqxAP1Qml0f30rJyLZJ7A', 'user', 'no', 'public', 1, '2025-05-11 15:40:37', '2025-03-08 16:38:22', '2025-05-11 15:40:37', NULL, 0),
(30, 'Ibrahim M', 'ibrahim', 'ibrahim@gmail.com', NULL, '$2y$12$J1eViQEQzdxGEEALfuw36.EPNmYCd/UGAZx8kzIf3UzmLw3akiC8.', 'GRbFOrLqg74Fk24XaLtldFcEA9d4FV6C1GMfLGAGZPl92X4PEcncoAOCs0FJ', 'user', 'no', 'public', 1, '2025-05-18 17:17:30', '2025-04-13 06:53:39', '2025-05-18 17:17:30', NULL, 0),
(31, 'Osama', 'osama', 'osama@gmail.com', NULL, '$2y$12$g4vqym4sQztws0iY8CZ0oeax2r9HrNk3phI60pzUr2GCUdR3nEW3u', 'db3IYoCF6PdzQUqd78dyKr9MmkQEcR8UdaHWiS5SAoo5S2qi7SszYaMgZwda', 'user', 'no', 'public', 1, '2025-06-27 06:02:26', '2025-05-16 13:48:05', '2025-06-27 06:02:26', NULL, 0);

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
(4, 4, NULL, NULL, 'cover_images/1738967496_cover_67a689c8da6879.88457705.jpg', 'تطبيق تدوين يرحب بكم', 'male', NULL, NULL, '2025-02-07 19:53:43', '2025-02-08 02:55:01'),
(5, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-07 22:00:59', '2025-02-07 22:00:59'),
(6, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-08 06:48:53', '2025-02-08 06:48:53'),
(7, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-08 07:56:30', '2025-02-08 07:56:30'),
(8, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-08 08:38:08', '2025-02-08 08:38:08'),
(9, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-08 12:40:26', '2025-02-08 12:40:26'),
(10, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-11 09:03:24', '2025-02-11 09:03:24'),
(11, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-15 15:22:35', '2025-02-15 15:22:35'),
(13, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-17 14:38:53', '2025-02-17 14:38:53'),
(14, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-17 18:19:51', '2025-02-17 18:19:51'),
(15, 15, NULL, 'background_images/1740326388_bg_67bb45f4747290.27752143.jpg', 'cover_images/1740492054_cover_67bdcd162d0451.04319670.jpg', NULL, NULL, NULL, NULL, '2025-02-20 17:17:41', '2025-02-25 11:00:54'),
(16, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-20 17:18:14', '2025-02-20 17:18:14'),
(17, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-22 07:17:00', '2025-02-22 07:17:00'),
(18, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-25 14:41:55', '2025-02-25 14:41:55'),
(19, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-03-04 14:17:53', '2025-03-04 14:17:53'),
(20, 20, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-03-04 14:19:09', '2025-03-04 14:19:09'),
(21, 21, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-03-04 14:26:26', '2025-03-04 14:26:26'),
(22, 22, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-03-04 17:14:58', '2025-03-04 17:14:58'),
(23, 23, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-03-04 17:16:01', '2025-03-04 17:16:01'),
(24, 24, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-03-04 17:40:54', '2025-03-04 17:40:54'),
(25, 25, NULL, NULL, 'cover_images/1743933297_cover_67f24f7149be92.17394939.jpg', NULL, 'male', 'سوريا', 'دمشق', '2025-03-08 15:13:07', '2025-04-06 06:54:57'),
(26, 26, NULL, 'background_images/1745775520_bg_680e6ba0da46d3.95620194.jpg', NULL, NULL, 'male', 'سوريا', 'دمشق', '2025-03-08 15:14:27', '2025-04-27 14:38:40'),
(27, 27, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-03-08 16:38:23', '2025-03-08 16:38:23'),
(30, 30, NULL, NULL, 'cover_images/1747389783_cover_68270d57f07e54.41827754.jpg', NULL, 'male', NULL, NULL, '2025-04-13 06:53:39', '2025-05-16 07:03:04'),
(31, 31, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-05-16 13:48:05', '2025-05-16 13:48:05');

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
(1, 'App\\Models\\User', 31, 'Default Wallet', 'default', '0197b09e-db76-71ca-8c62-38e045b8de02', NULL, '[]', 960, 2, '2025-06-27 06:01:30', '2025-06-27 06:02:15', NULL),
(2, 'App\\Models\\User', 4, 'Default Wallet', 'default', '0197b09f-4c85-73cc-80c9-a65b18606cf0', NULL, '[]', 40, 2, '2025-06-27 06:01:59', '2025-06-27 06:02:15', NULL);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=506;

--
-- AUTO_INCREMENT for table `polls`
--
ALTER TABLE `polls`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `poll_votes`
--
ALTER TABLE `poll_votes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=217;

--
-- AUTO_INCREMENT for table `post_likes`
--
ALTER TABLE `post_likes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `replies`
--
ALTER TABLE `replies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transfers`
--
ALTER TABLE `transfers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `user_profiles`
--
ALTER TABLE `user_profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `wallets`
--
ALTER TABLE `wallets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
-- Constraints for table `user_profiles`
--
ALTER TABLE `user_profiles`
  ADD CONSTRAINT `user_profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
