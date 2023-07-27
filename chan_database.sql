-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 25, 2023 at 05:00 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chan_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `item_id` bigint(20) UNSIGNED DEFAULT NULL,
  `quantityC` bigint(20) NOT NULL,
  `sellprice` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`user_id`, `item_id`, `quantityC`, `sellprice`) VALUES
(2, 1, 1, 4939);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cat_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `cat_name`, `created_at`, `updated_at`) VALUES
(1, 'culpa', '2023-07-21 19:20:53', '2023-07-21 19:20:53'),
(2, 'Special', '2023-07-21 19:20:53', '2023-07-23 16:40:14'),
(5, 'Cons', '2023-07-21 19:20:53', '2023-07-22 21:35:03'),
(6, 'Computer', '2023-07-22 20:44:20', '2023-07-22 20:44:20'),
(7, 'Handimans', '2023-07-22 20:47:49', '2023-07-22 22:57:54');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `img_pathC` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `customer_name`, `contact`, `address`, `img_pathC`, `created_at`, `updated_at`, `user_id`) VALUES
(1, 'Dave Merc Adlawans', '09784237847238', 'Upper Bicutan Taguig City', 'DEFAULT', '2023-07-21 17:16:41', '2023-07-24 05:04:31', 1),
(2, 'Aira Nicole', '09238482432', 'New Lower', 'DEFAULT', '2023-07-21 19:28:51', '2023-07-23 22:32:47', 2),
(3, 'Darwin Penaflors', '09784237847238', 'Lupi Sanfernando Cam Sur', 'DEFAULT', '2023-07-23 20:47:17', '2023-07-23 22:31:02', 4),
(4, 'John Paul Dellova', '09893984', 'Makati', 'DEFAULT', '2023-07-23 20:50:49', '2023-07-23 20:50:49', 5);

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
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `sellprice` bigint(20) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `img_path` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `sup_id` bigint(20) UNSIGNED DEFAULT NULL,
  `cat_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `item_name`, `sellprice`, `description`, `img_path`, `sup_id`, `cat_id`, `created_at`, `updated_at`) VALUES
(1, 'magnam styles', 4939, 'On Stock', 'default.jpg', 1, 2, '2022-10-15 08:38:08', '2023-07-24 06:48:05'),
(2, 'Junction Box', 300, 'On Stock', 'default.jpg', 3, 2, '2022-11-07 02:14:16', '2023-07-24 06:41:19'),
(4, 'Gulong ng palad', 400, 'On Stock', 'default.jpg', 3, 5, '2023-02-28 19:55:06', '2023-07-24 06:48:22'),
(8, 'qui', 1889, 'On Stock', 'default.jpg', 5, 5, '2022-09-25 06:54:07', '2023-07-24 06:39:32'),
(12, 'Martilyo', 300, 'On Stock', 'NONE', 2, 2, '2023-07-22 04:17:21', '2023-07-24 06:41:11'),
(19, 'Gatas', 400, 'On Stock', 'NONE', 5, 6, '2023-07-24 05:55:51', '2023-07-24 06:41:00');

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `collection_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `disk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `conversions_disk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
(1, 'App\\Models\\Item', 11, '4bb8e745-339c-4b01-982f-06ae81dcf1f7', 'images', '64bbc810eac73_sample2', '64bbc810eac73_sample2.png', 'image/png', 'public', 'public', 141876, '[]', '[]', '[]', '[]', 1, '2023-07-22 04:14:12', '2023-07-22 04:14:12'),
(2, 'App\\Models\\Item', 12, 'd3df7e8c-5814-4be6-971f-d85e836d1ad7', 'images', '64bbc8ce703d1_sample2', '64bbc8ce703d1_sample2.png', 'image/png', 'public', 'public', 141876, '[]', '[]', '[]', '[]', 1, '2023-07-22 04:17:21', '2023-07-22 04:17:21'),
(14, 'App\\Models\\Item', 3, '7a39c0e5-2b8e-46b4-977f-504b878a5a46', 'images', '64bc031179750_DRR', '64bc031179750_DRR.png', 'image/png', 'public', 'public', 92399, '[]', '[]', '{\"thumb\":true}', '[]', 1, '2023-07-22 08:25:55', '2023-07-22 08:25:55'),
(15, 'App\\Models\\Item', 3, '9846680b-ce82-4a21-8707-cc6c58d82491', 'images', '64bc0311e2377_Screenshot 2023-02-08 074653', '64bc0311e2377_Screenshot-2023-02-08-074653.jpg', 'image/jpeg', 'public', 'public', 458787, '[]', '[]', '{\"thumb\":true}', '[]', 2, '2023-07-22 08:25:55', '2023-07-22 08:25:56'),
(16, 'App\\Models\\Item', 4, 'b9e68280-1037-4e0b-a06e-0e73a710b16a', 'images', '64bc03b6ad5c0_SDRAM', '64bc03b6ad5c0_SDRAM.png', 'image/png', 'public', 'public', 90601, '[]', '[]', '{\"thumb\":true}', '[]', 1, '2023-07-22 08:28:46', '2023-07-22 08:28:46'),
(17, 'App\\Models\\Item', 4, 'cb2acef5-4604-4ec0-9f70-691b00929398', 'images', '64bc03b71cb71_RDRAM', '64bc03b71cb71_RDRAM.png', 'image/jpeg', 'public', 'public', 8589, '[]', '[]', '{\"thumb\":true}', '[]', 2, '2023-07-22 08:28:46', '2023-07-22 08:28:47'),
(18, 'App\\Models\\Item', 5, '13621696-5265-4c78-a7df-deac4451ec17', 'images', '64bc7442c568a_Arduino_Logo.svg', '64bc7442c568a_Arduino_Logo.svg.png', 'image/png', 'public', 'public', 38158, '[]', '[]', '{\"thumb\":true}', '[]', 1, '2023-07-22 16:28:54', '2023-07-22 16:28:56'),
(19, 'App\\Models\\Item', 5, '3079e0cd-0238-4bc6-b359-6251aab869fb', 'images', '64bc74432c2e0_png-transparent-arduino-macos-bigsur-icon-thumbnail', '64bc74432c2e0_png-transparent-arduino-macos-bigsur-icon-thumbnail.png', 'image/png', 'public', 'public', 13409, '[]', '[]', '{\"thumb\":true}', '[]', 2, '2023-07-22 16:28:56', '2023-07-22 16:28:56'),
(20, 'App\\Models\\Item', 17, 'b9910fd9-54a9-4803-af45-e6383b69ef3c', 'images', '64bc7568916fe_EDO RAM png', '64bc7568916fe_EDO-RAM-png.png', 'image/png', 'public', 'public', 74046, '[]', '[]', '{\"thumb\":true}', '[]', 1, '2023-07-22 16:33:48', '2023-07-22 16:33:48'),
(21, 'App\\Models\\Item', 17, '8ed1c692-89fc-4dfb-8305-2a1c24f56ec2', 'images', '64bc7568df1c1_SDRAM', '64bc7568df1c1_SDRAM.png', 'image/png', 'public', 'public', 90601, '[]', '[]', '{\"thumb\":true}', '[]', 2, '2023-07-22 16:33:48', '2023-07-22 16:33:49'),
(26, 'App\\Models\\Item', 8, 'be2fdadc-8f7a-4e1f-909b-cb7ea544bd82', 'images', '64bde1a0690ea_Arduino_Logo.svg', '64bde1a0690ea_Arduino_Logo.svg.png', 'image/png', 'public', 'public', 38158, '[]', '[]', '{\"thumb\":true}', '[]', 1, '2023-07-23 18:27:48', '2023-07-23 18:27:50'),
(27, 'App\\Models\\Item', 2, '0e44b350-aca6-473e-b491-7c1e001d9337', 'images', '64bde1d823331_Arduino_Logo.svg', '64bde1d823331_Arduino_Logo.svg.png', 'image/png', 'public', 'public', 38158, '[]', '[]', '{\"thumb\":true}', '[]', 1, '2023-07-23 18:28:42', '2023-07-23 18:28:43'),
(28, 'App\\Models\\Item', 2, 'b5880128-42ba-4910-829d-818a4236a9b6', 'images', '64bde1d8d38f4_347019', '64bde1d8d38f4_347019.jpg', 'image/jpeg', 'public', 'public', 561210, '[]', '[]', '{\"thumb\":true}', '[]', 2, '2023-07-23 18:28:43', '2023-07-23 18:28:44'),
(29, 'App\\Models\\Item', 2, '1aeae299-4a02-48d9-8b8c-9d6b61529a18', 'images', '64bde1d9a257b_347015', '64bde1d9a257b_347015.jpg', 'image/jpeg', 'public', 'public', 1662294, '[]', '[]', '{\"thumb\":true}', '[]', 3, '2023-07-23 18:28:44', '2023-07-23 18:28:44'),
(30, 'App\\Models\\Customer', 3, '00eb76d5-44dd-4b7a-91b9-cbb02877e5e5', 'images', '64be02534b7e1_Index 2', '64be02534b7e1_Index-2.jpg', 'image/jpeg', 'public', 'public', 109170, '[]', '[]', '{\"thumb\":true}', '[]', 1, '2023-07-23 20:47:18', '2023-07-23 20:47:21'),
(31, 'App\\Models\\Customer', 3, '7afe7dcb-d405-47f3-8981-c8eb8b4a0f74', 'images', '64be0253ae94e_Epilogue II', '64be0253ae94e_Epilogue-II.jpg', 'image/jpeg', 'public', 'public', 718891, '[]', '[]', '{\"thumb\":true}', '[]', 2, '2023-07-23 20:47:21', '2023-07-23 20:47:22'),
(32, 'App\\Models\\Customer', 4, '02466d27-8aaa-45d9-b0df-a1797d18149d', 'images', '64be032630da0_Index 2', '64be032630da0_Index-2.jpg', 'image/jpeg', 'public', 'public', 109170, '[]', '[]', '{\"thumb\":true}', '[]', 1, '2023-07-23 20:50:49', '2023-07-23 20:50:49'),
(33, 'App\\Models\\Customer', 4, 'bedf4eea-403a-4a32-b02e-a945fb053ea1', 'images', '64be032693059_Epilogue II', '64be032693059_Epilogue-II.jpg', 'image/jpeg', 'public', 'public', 718891, '[]', '[]', '{\"thumb\":true}', '[]', 2, '2023-07-23 20:50:49', '2023-07-23 20:50:50'),
(34, 'App\\Models\\Customer', 2, '04744a7c-d3da-4ea6-9fd8-43363d91cf90', 'images', '64be1b0ce1d80_Aira', '64be1b0ce1d80_Aira.png', 'image/png', 'public', 'public', 145253, '[]', '[]', '{\"thumb\":true}', '[]', 1, '2023-07-23 22:32:47', '2023-07-23 22:32:47'),
(42, 'App\\Models\\Item', 19, '1d3a37d6-1856-4f1f-9263-3c40f368f0a5', 'images', '64be82e363e34_TOC-diagram-Visual-Table-of-Content-VTOC-diagram-shows-the-menu-contained-in-the-game', '64be82e363e34_TOC-diagram-Visual-Table-of-Content-VTOC-diagram-shows-the-menu-contained-in-the-game.png', 'image/png', 'public', 'public', 31557, '[]', '[]', '{\"thumb\":true}', '[]', 1, '2023-07-24 05:55:51', '2023-07-24 05:55:51'),
(43, 'App\\Models\\Item', 19, '23d25328-4f3e-48ff-bc42-e0fe77fa013e', 'images', '64be82e3c3f55_3-s2.0-B9780128096406000118-f10-28-9780128096406', '64be82e3c3f55_3-s2.0-B9780128096406000118-f10-28-9780128096406.jpg', 'image/jpeg', 'public', 'public', 45951, '[]', '[]', '{\"thumb\":true}', '[]', 2, '2023-07-24 05:55:51', '2023-07-24 05:55:51');

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
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2023_04_06_073802_create_customers_table', 1),
(7, '2023_04_06_145309_create_suppliers_table', 1),
(8, '2023_04_07_035043_create_categories_table', 1),
(9, '2023_04_07_065547_create_payment_methods_table', 1),
(10, '2023_04_12_132400_create_items_table', 1),
(11, '2023_04_12_132555_add_user_id_to_customers_table', 1),
(12, '2023_04_14_110817_create_shippers_table', 1),
(13, '2023_04_14_111048_create_orders_table', 1),
(14, '2023_04_16_061854_create_carts_table', 1),
(15, '2023_04_18_130205_add_description_to_items_table', 1),
(16, '2023_04_19_155129_create_orderlines_table', 1),
(17, '2023_05_01_200152_create_samples_table', 1),
(18, '2023_07_22_012742_add_usertype_to_users_table', 2),
(19, '2023_07_22_024600_create_stocks_table', 3),
(20, '2023_07_22_111252_create_media_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `orderlines`
--

CREATE TABLE `orderlines` (
  `item_id` bigint(20) UNSIGNED DEFAULT NULL,
  `orderinfo_id` bigint(20) UNSIGNED DEFAULT NULL,
  `quantity` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orderlines`
--

INSERT INTO `orderlines` (`item_id`, `orderinfo_id`, `quantity`) VALUES
(1, 1, 2),
(4, 2, 1),
(1, 3, 2),
(2, 3, 1),
(1, 4, 1),
(2, 4, 1),
(1, 5, 2),
(2, 5, 2),
(1, 6, 2),
(2, 6, 2),
(1, 7, 2),
(2, 7, 2),
(1, 8, 2),
(2, 8, 2),
(1, 9, 2),
(2, 9, 2),
(1, 10, 2),
(2, 10, 2),
(1, 11, 2),
(2, 11, 2),
(1, 12, 2),
(2, 12, 2),
(1, 13, 2),
(2, 13, 2),
(1, 14, 2),
(2, 14, 2),
(1, 15, 2),
(2, 15, 2),
(1, 16, 2),
(2, 16, 2),
(1, 17, 2),
(2, 17, 2),
(1, 18, 2),
(2, 18, 2),
(1, 19, 2),
(2, 19, 2),
(1, 20, 2),
(2, 20, 2),
(1, 21, 2),
(2, 21, 2),
(1, 22, 1),
(2, 22, 2),
(1, 23, 2),
(4, 23, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cus_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ship_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` enum('Processing','Shipped','Delivered','Cancelled','For Delivery') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Processing',
  `pm_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `cus_id`, `ship_id`, `status`, `pm_id`, `created_at`, `updated_at`) VALUES
(1, 2, 2, 'Delivered', 2, '2023-07-21 19:30:56', '2023-07-21 19:50:21'),
(2, 1, 1, 'Delivered', 2, '2023-07-21 19:49:33', '2023-07-21 19:50:39'),
(3, 2, 2, 'Delivered', 4, '2023-07-21 19:51:46', '2023-07-21 19:53:05'),
(4, 2, 5, 'Delivered', 4, '2023-07-23 02:10:25', '2023-07-23 06:13:00'),
(5, 2, 2, 'Delivered', 4, '2023-07-23 02:11:03', '2023-07-23 17:05:02'),
(6, 2, 2, 'Delivered', 4, '2023-07-23 02:19:52', '2023-07-24 06:49:04'),
(7, 2, 2, 'Shipped', 4, '2023-07-23 02:19:54', '2023-07-23 17:24:55'),
(8, 2, 2, 'Shipped', 4, '2023-07-23 02:19:55', '2023-07-23 06:14:22'),
(9, 2, 2, 'Cancelled', 4, '2023-07-23 02:19:57', '2023-07-23 17:45:00'),
(10, 2, 2, 'Shipped', 4, '2023-07-23 02:20:14', '2023-07-23 17:25:04'),
(11, 2, 2, 'Shipped', 2, '2023-07-23 02:22:31', '2023-07-23 17:47:02'),
(12, 2, 2, 'Cancelled', 2, '2023-07-23 02:22:52', '2023-07-23 17:54:48'),
(13, 2, 2, 'Shipped', 2, '2023-07-23 02:23:06', '2023-07-23 17:47:09'),
(14, 2, 2, 'Cancelled', 2, '2023-07-23 02:24:08', '2023-07-23 18:10:43'),
(15, 2, 2, 'Shipped', 4, '2023-07-23 02:31:56', '2023-07-23 17:47:21'),
(16, 2, 2, 'Shipped', 4, '2023-07-23 02:32:38', '2023-07-24 06:48:57'),
(17, 2, 2, 'Cancelled', 4, '2023-07-23 02:32:53', '2023-07-23 17:54:53'),
(18, 2, 2, 'For Delivery', 4, '2023-07-23 02:35:40', '2023-07-24 06:48:42'),
(19, 2, 1, 'Processing', 2, '2023-07-23 02:39:26', '2023-07-23 02:39:26'),
(20, 2, 2, 'Processing', 4, '2023-07-23 02:39:52', '2023-07-23 02:39:52'),
(21, 2, 2, 'Processing', 2, '2023-07-23 02:40:45', '2023-07-23 02:40:45'),
(22, 2, 2, 'For Delivery', 4, '2023-07-23 03:03:36', '2023-07-23 17:46:35'),
(23, 1, 1, 'Processing', 5, '2023-07-24 01:05:50', '2023-07-24 01:05:50');

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
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Methods` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_methods`
--

INSERT INTO `payment_methods` (`id`, `Methods`, `created_at`, `updated_at`) VALUES
(2, 'MasterCard', '2023-01-29 11:33:27', '2022-12-15 14:38:03'),
(4, 'Visa', '2023-03-06 01:25:49', '2022-11-11 17:10:56'),
(5, 'Discover Card', '2023-03-19 20:13:54', '2023-02-13 04:11:46'),
(10, 'American Express', '2022-10-04 04:06:39', '2022-09-15 07:31:52'),
(11, 'Paymaya Card', '2023-07-24 00:08:46', '2023-07-24 00:08:46');

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
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `samples`
--

CREATE TABLE `samples` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shippers`
--

CREATE TABLE `shippers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shippers`
--

INSERT INTO `shippers` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Palawans', '2023-05-18 12:29:54', '2023-07-24 06:49:34'),
(2, 'UPS', '2022-08-31 12:12:01', '2023-03-22 04:52:07'),
(5, 'DHL', '2022-11-04 14:27:22', '2023-03-08 02:00:58'),
(6, 'LBC', '2023-07-24 00:51:48', '2023-07-24 00:51:48');

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`item_id`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 194, NULL, NULL),
(2, 162, NULL, NULL),
(4, 198, NULL, NULL),
(8, 120, NULL, NULL),
(12, 200, NULL, NULL),
(19, 100, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sup_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `sup_contact` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `sup_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `sup_email` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `sup_name`, `sup_contact`, `sup_address`, `sup_email`, `created_at`, `updated_at`) VALUES
(1, 'Miss Emilie Pacocha', '0928374023', '39694 Mylene CircleLake Jessika', 'rutherford@hotmail.com', '2022-12-02 04:36:39', '2023-07-24 05:34:53'),
(2, 'Omer Cartwright', '+1-609-834-0457', '3875 Roberts Plaza\nRebeccaville, ND 53426-7258', 'tkiehn@predovic.com', '2022-11-21 16:21:50', '2023-01-27 16:06:59'),
(3, 'Ms. Bettye Hahn', '(360) 732-1966', '2390 Sporer Extension Suite 965\nWest Florianmouth, ID 99961', 'avis.grimes@jones.net', '2023-02-25 08:35:03', '2022-08-22 07:49:54'),
(4, 'Prof. Johnpaul Leuschke PhD', '+14096745854', '50062 Kihn Drive\nViviennehaven, KS 11681', 'brionna99@gusikowski.biz', '2023-01-11 01:20:16', '2022-12-03 18:06:18'),
(5, 'Lula Vandervort', '+1 (435) 932-3862', '88005 Hermann Heights Apt. 327\nShannyfort, MI 18807', 'yasmeen.lynch@yahoo.com', '2023-06-03 13:32:56', '2022-12-01 20:46:33');

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
  `usertype` enum('Admin','User') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'User',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `usertype`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Dave Merc Adlawans', 'adlawandavemerc98@gmail.com', NULL, '$2y$10$dZrUU1Bkl/Wx9K0JYlHfVuZHUeKPI9VrV6vbbt.tUPwDEMRtVCREm', 'Admin', NULL, '2023-07-21 17:16:12', '2023-07-24 05:04:31'),
(2, 'Aira Nicole', 'airanicole@gmail.com', NULL, '$2y$10$VPutdbUqcKlHXL6TMhXd6ebUlnL9/fUffSx7v1VDRrPEFwzsiq4Xu', 'Admin', NULL, '2023-07-21 19:28:27', '2023-07-23 22:32:47'),
(4, 'Darwin Penaflors', 'darwin@gmail.com', NULL, '$2y$10$jFfHfK8WT3WOJIO8xAlRrub0SOBs9WVNZxHr/1YEMQ69.ygXqdvK6', 'User', NULL, '2023-07-23 20:47:17', '2023-07-23 22:31:02'),
(5, 'John Paul Dellova', 'paul@gmail.com', NULL, '$2y$10$r97yDASQxsJLHfzvoXlCnOPeUg4AaYu8/EsWkqZIaZ3EIHXq15/Hu', 'Admin', NULL, '2023-07-23 20:50:49', '2023-07-23 20:50:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD KEY `carts_user_id_index` (`user_id`),
  ADD KEY `carts_item_id_index` (`item_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customers_user_id_index` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `items_sup_id_index` (`sup_id`),
  ADD KEY `items_cat_id_index` (`cat_id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `media_uuid_unique` (`uuid`),
  ADD KEY `media_model_type_model_id_index` (`model_type`,`model_id`),
  ADD KEY `media_order_column_index` (`order_column`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orderlines`
--
ALTER TABLE `orderlines`
  ADD KEY `orderlines_item_id_index` (`item_id`),
  ADD KEY `orderlines_orderinfo_id_index` (`orderinfo_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_cus_id_index` (`cus_id`),
  ADD KEY `orders_ship_id_index` (`ship_id`),
  ADD KEY `orders_pm_id_index` (`pm_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `samples`
--
ALTER TABLE `samples`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shippers`
--
ALTER TABLE `shippers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
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
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `samples`
--
ALTER TABLE `samples`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shippers`
--
ALTER TABLE `shippers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`),
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_cat_id_foreign` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `items_sup_id_foreign` FOREIGN KEY (`sup_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orderlines`
--
ALTER TABLE `orderlines`
  ADD CONSTRAINT `orderlines_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orderlines_orderinfo_id_foreign` FOREIGN KEY (`orderinfo_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_cus_id_foreign` FOREIGN KEY (`cus_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `orders_pm_id_foreign` FOREIGN KEY (`pm_id`) REFERENCES `payment_methods` (`id`),
  ADD CONSTRAINT `orders_ship_id_foreign` FOREIGN KEY (`ship_id`) REFERENCES `shippers` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
