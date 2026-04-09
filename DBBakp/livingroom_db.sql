-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 26, 2026 at 03:04 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `livingroom_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `analytics_events`
--

CREATE TABLE `analytics_events` (
  `id` int(11) NOT NULL,
  `event_name` varchar(100) DEFAULT NULL,
  `page` varchar(255) DEFAULT NULL,
  `meta` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`meta`)),
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `analytics_events`
--

INSERT INTO `analytics_events` (`id`, `event_name`, `page`, `meta`, `ip_address`, `user_agent`, `created_at`) VALUES
(1, 'page_view', '/LRS2026/', '[]', '::1', 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Mobile Safari/537.36', '2026-01-26 12:05:17'),
(2, 'project_modal_open', '/LRS2026/', '[]', '::1', 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Mobile Safari/537.36', '2026-01-26 12:05:35'),
(3, 'page_view', '/LRS2026/', '[]', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-26 12:08:40'),
(4, 'page_view', '/LRS2026/', '[]', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-26 12:15:38'),
(5, 'project_modal_open', '/LRS2026/', '[]', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-26 12:15:40'),
(6, 'project_modal_open', '/LRS2026/', '[]', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-26 12:16:18'),
(7, 'project_form_submit', '/LRS2026/', '{\"service_type\":\"Design\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-26 12:16:29'),
(8, 'social_click', '/LRS2026/', '{\"platform\":\"instagram\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-26 12:16:47'),
(9, 'whatsapp_click', '/LRS2026/', '[]', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-26 12:16:50'),
(10, 'whatsapp_click', '/LRS2026/', '[]', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-26 12:16:57'),
(11, 'page_view', '/LRS2026/', '[]', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-26 12:56:24'),
(12, 'page_view', '/LRS2026/', '[]', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-26 12:56:52'),
(13, 'page_view', '/LRS2026/', '[]', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-26 12:56:58'),
(14, 'page_view', '/LRS2026/', '[]', '::1', 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Mobile Safari/537.36', '2026-01-26 13:18:19'),
(15, 'page_view', '/LRS2026/', '[]', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-26 13:23:00'),
(16, 'page_view', '/LRS2026/', '[]', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-26 13:23:27'),
(17, 'page_view', '/LRS2026/', '[]', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-26 13:23:30'),
(18, 'page_view', '/LRS2026/', '[]', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-26 13:23:34'),
(19, 'page_view', '/LRS2026/', '[]', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-26 13:23:38'),
(20, 'page_view', '/LRS2026/', '[]', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-26 13:26:58');

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` int(11) NOT NULL,
  `title` varchar(150) DEFAULT NULL,
  `short_desc` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `celebrities`
--

CREATE TABLE `celebrities` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
  `image` varchar(255) NOT NULL,
  `designation` varchar(150) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `sort_order` int(11) DEFAULT 0,
  `status` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `celebrities`
--

INSERT INTO `celebrities` (`id`, `name`, `image`, `designation`, `instagram`, `website`, `sort_order`, `status`, `created_at`, `updated_at`) VALUES
(1, '333', 'celeb_696665f93e8a1.png', 'Actor', NULL, NULL, 0, 1, '2026-01-13 15:34:17', NULL),
(2, 'dasdsad33', 'celeb_6966660511199.png', 'Influencer', NULL, NULL, 0, 1, '2026-01-13 15:34:29', NULL),
(3, 'adsdasdadad', 'celeb_69666617a4bf5.png', 'Artist', NULL, NULL, 0, 1, '2026-01-13 15:34:47', NULL),
(4, 'dasdsad', 'celeb_69666626ced1b.png', 'Artist', NULL, NULL, 0, 1, '2026-01-13 15:35:02', NULL),
(5, 'RFGY', 'celeb_696666399c15e.png', 'Artist', 'https://www.asasas.com', 'https://www.asasas.com', 2, 1, '2026-01-13 15:35:21', '2026-01-13 15:51:28'),
(6, 'numindstech.com', 'celeb_696b28e63b226.png', 'asdsa', '', '', 2, 1, '2026-01-17 06:15:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `name`, `logo`) VALUES
(4, '333', 'client_69664b727ecf3.png'),
(5, 'asdasd', 'client_69664f21e0db8.png'),
(6, 'asdasd', 'client_69664f2a43d78.png'),
(7, 'adsdasd', 'client_69664f3224338.png'),
(8, 'dasdsad', 'client_69664f3a273c2.png'),
(9, 'adsdasdadad', 'client_69664f43d7cd2.png'),
(10, 'dasdsad33', 'client_69665860d4a33.png'),
(11, 'adsdasd5645', 'client_6966586bab1a2.png'),
(12, 'numindstech.com', 'client_696a201fe1536.png'),
(13, '123654', 'client_6972661411f84.png');

-- --------------------------------------------------------

--
-- Table structure for table `hero_settings`
--

CREATE TABLE `hero_settings` (
  `id` int(11) NOT NULL DEFAULT 1,
  `hero_image` varchar(255) NOT NULL,
  `particles_enabled` tinyint(1) DEFAULT 0,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hero_settings`
--

INSERT INTO `hero_settings` (`id`, `hero_image`, `particles_enabled`, `updated_at`) VALUES
(1, 'hero_1769349490.jpg', 1, '2026-01-25 13:58:10');

-- --------------------------------------------------------

--
-- Table structure for table `homepage_stories`
--

CREATE TABLE `homepage_stories` (
  `id` int(11) NOT NULL,
  `wp_post_id` int(11) NOT NULL,
  `position` int(11) DEFAULT 0,
  `is_active` tinyint(1) DEFAULT 1,
  `is_featured` tinyint(1) DEFAULT 0,
  `weekly_rotation` tinyint(1) DEFAULT 1,
  `clicks` int(11) DEFAULT 0,
  `last_rotated` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `homepage_stories`
--

INSERT INTO `homepage_stories` (`id`, `wp_post_id`, `position`, `is_active`, `is_featured`, `weekly_rotation`, `clicks`, `last_rotated`, `created_at`) VALUES
(1, 4132, 0, 1, 1, 0, 0, NULL, '2026-01-22 15:25:01'),
(2, 4191, 0, 0, 0, 1, 0, NULL, '2026-01-22 15:25:01'),
(3, 4094, 0, 1, 1, 0, 0, NULL, '2026-01-22 15:25:01'),
(4, 3936, 0, 0, 0, 1, 0, NULL, '2026-01-22 15:25:01'),
(5, 4059, 0, 0, 0, 0, 0, NULL, '2026-01-22 15:25:02'),
(6, 3968, 0, 0, 0, 0, 0, NULL, '2026-01-22 15:25:02'),
(7, 3947, 0, 0, 0, 0, 0, NULL, '2026-01-22 15:25:02'),
(8, 3878, 0, 0, 0, 0, 0, NULL, '2026-01-22 15:25:02'),
(9, 3810, 0, 0, 0, 0, 0, NULL, '2026-01-22 15:25:02'),
(10, 3788, 0, 0, 0, 0, 0, NULL, '2026-01-22 15:25:02'),
(11, 3744, 0, 0, 0, 0, 0, NULL, '2026-01-22 15:25:02'),
(12, 3695, 0, 0, 0, 1, 0, NULL, '2026-01-22 15:25:02'),
(13, 3581, 0, 0, 0, 1, 0, NULL, '2026-01-22 15:25:02'),
(14, 3599, 0, 0, 0, 0, 0, NULL, '2026-01-22 15:25:02'),
(15, 3558, 0, 0, 0, 0, 0, NULL, '2026-01-22 15:25:02'),
(16, 3196, 0, 0, 0, 0, 0, NULL, '2026-01-22 15:25:02'),
(17, 3438, 0, 0, 0, 0, 0, NULL, '2026-01-22 15:25:02'),
(18, 3409, 0, 0, 0, 0, 0, NULL, '2026-01-22 15:25:02'),
(19, 3365, 0, 0, 0, 0, 0, NULL, '2026-01-22 15:25:02'),
(20, 3327, 0, 0, 0, 1, 0, NULL, '2026-01-22 15:25:02'),
(21, 3294, 0, 0, 0, 0, 0, NULL, '2026-01-22 15:25:02'),
(22, 3246, 0, 0, 0, 0, 0, NULL, '2026-01-22 15:25:02'),
(23, 3176, 0, 0, 0, 0, 0, NULL, '2026-01-22 15:25:02'),
(24, 2694, 0, 0, 0, 0, 0, NULL, '2026-01-22 15:25:02'),
(25, 2982, 0, 0, 0, 0, 0, NULL, '2026-01-22 15:25:02'),
(26, 2698, 0, 0, 0, 1, 0, NULL, '2026-01-22 15:25:02'),
(27, 2565, 0, 0, 0, 1, 0, NULL, '2026-01-22 15:25:02'),
(28, 2450, 0, 0, 0, 0, 0, NULL, '2026-01-22 15:25:02'),
(29, 2436, 0, 1, 1, 0, 0, NULL, '2026-01-22 15:25:02'),
(30, 2423, 0, 0, 0, 1, 0, NULL, '2026-01-22 15:25:02');

-- --------------------------------------------------------

--
-- Table structure for table `instagram_reels`
--

CREATE TABLE `instagram_reels` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(150) DEFAULT NULL,
  `reel_url` varchar(255) NOT NULL,
  `sort_order` int(11) DEFAULT 0,
  `status` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `instagram_reels`
--

INSERT INTO `instagram_reels` (`id`, `title`, `reel_url`, `sort_order`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Teston', 'https://www.instagram.com/reel/DRuFGZYjiam/', 3, 1, '2026-01-16 11:24:27', NULL),
(2, 'aaa', 'https://www.instagram.com/reel/DPqgHGgEgAU/', 2, 1, '2026-01-16 11:35:53', NULL),
(3, '4', 'https://www.instagram.com/reel/DPwJnGuElqF/', 1, 1, '2026-01-16 11:36:10', NULL),
(4, 'asdas', 'https://www.instagram.com/reel/DPAtVnAEojX/', 0, 1, '2026-01-16 11:36:31', NULL),
(5, 'dsaaa', 'https://www.instagram.com/reel/DNp9Ni0Sxy3/', 4, 1, '2026-01-16 11:36:49', NULL),
(6, 'zxczxc', 'https://www.instagram.com/reel/DNp9Ni0Sxy3/', 6, 1, '2026-01-16 11:37:36', NULL),
(7, '5', 'https://www.instagram.com/reel/DNp9Ni0Sxy3/', 5, 1, '2026-01-16 11:37:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `portfolio`
--

CREATE TABLE `portfolio` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `tags` varchar(255) DEFAULT NULL,
  `seo_title` varchar(255) DEFAULT NULL,
  `seo_description` varchar(255) DEFAULT NULL,
  `seo_keywords` varchar(255) DEFAULT NULL,
  `views` int(11) DEFAULT 0,
  `status` tinyint(4) DEFAULT 1,
  `sort_order` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `portfolio`
--

INSERT INTO `portfolio` (`id`, `title`, `slug`, `category`, `description`, `image`, `tags`, `seo_title`, `seo_description`, `seo_keywords`, `views`, `status`, `sort_order`, `created_at`) VALUES
(1, 'zzz', 'zzz', 'social', 'zzz', 'portfolio_696a671ceafb2.jpg', 'zzz', 'zzz', 'zzz', '0', 0, 1, 1, '2026-01-16 16:28:12'),
(2, 'aa', 'aa', 'logo', 'aaa', 'portfolio_696a67beba6e6.jpg', 'aaa', 'aa', 'aaa', '0', 0, 1, 2, '2026-01-16 16:30:54'),
(3, 'cccc', 'cccc', 'logo', 'ccc', 'portfolio_696a6842cb55e.jpeg', 'cc', 'cc', 'ccccccccccccccc', '0', 0, 1, 1, '2026-01-16 16:33:06'),
(4, 'asdsad', 'asdsad', 'menu', 'asdsadsad', 'portfolio_696a823a359c6.jpg', 'asdsad', 'adssad', 'dasdsad', '0', 10, 1, 0, '2026-01-16 18:23:54'),
(5, 'asdasdas', 'asdasdas', 'social', 'adsasdsad', 'portfolio_696a82632f33f.jpg', 'dsadsad', 'adsdsad', 'asdsada', '0', 2, 1, 9, '2026-01-16 18:24:35'),
(6, 'zcxcxzc', 'zcxcxzc', 'social', 'xczvxczv', 'portfolio_696a8289ce31b.jpg', 'xczvxzcv', 'vxczv', 'xzcvxzcvxzcxvcz', '0', 0, 1, 0, '2026-01-16 18:25:13'),
(7, 'xzcvxcz', 'xzcvxcz', 'print', 'vxczv', 'portfolio_696a829710345.webp', 'vxczv', 'v', 'xczvxczvxzcv', '0', 0, 1, 0, '2026-01-16 18:25:27');

-- --------------------------------------------------------

--
-- Table structure for table `project_leads`
--

CREATE TABLE `project_leads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(120) NOT NULL,
  `business_name` varchar(180) DEFAULT NULL,
  `service_type` enum('Design','Video Production','Editing','Branding','Other') NOT NULL,
  `remarks` text DEFAULT NULL,
  `source_page` varchar(255) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `status` enum('New','Contacted','InProgress','Closed','Spam') DEFAULT 'New',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `email` varchar(120) DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `preferred_time` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `project_leads`
--

INSERT INTO `project_leads` (`id`, `name`, `business_name`, `service_type`, `remarks`, `source_page`, `user_agent`, `ip_address`, `status`, `created_at`, `updated_at`, `email`, `phone`, `preferred_time`) VALUES
(7, 'mind', 'sss', 'Design', 'sss3d', 'http://localhost/lrs2026/', 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Mobile Safari/537.36', '::1', 'Spam', '2026-01-20 15:19:36', '2026-01-22 15:04:47', 'mindplus0@gmail.com', '99999999999', 'Afternoon (12pm–4pm)'),
(8, 'Minhz', 'Numinds', 'Design', '12344', 'http://localhost/lrs2026/', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '::1', 'New', '2026-01-22 17:54:17', NULL, 'm@d.com', '635241087', 'Afternoon (12pm–4pm)'),
(17, '333', 'Numinds', 'Video Production', '1224', 'http://localhost/lrs2026/', 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Mobile Safari/537.36', '::1', 'New', '2026-01-22 18:17:53', NULL, 'm@d.com', '7845121478', 'Morning (10am–12pm)'),
(18, 'asdasd', 'Numinds', 'Design', '', 'http://localhost/lrs2026/', 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Mobile Safari/537.36', '::1', 'New', '2026-01-22 18:21:02', NULL, 'm@d.com', '7845121478', 'Afternoon (12pm–4pm)'),
(19, 'asdasd', 'Numinds', 'Video Production', '32121', 'http://localhost/LRS2026/', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '::1', 'New', '2026-01-26 10:33:25', NULL, 'm@d.com', '9836194203', 'Morning (10am–12pm)'),
(20, 'asdasd', 'Numinds', 'Design', '11', 'http://localhost/LRS2026/', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '::1', 'New', '2026-01-26 10:34:31', NULL, 'm@d.com', '7845121478', 'Morning (10am–12pm)'),
(21, 'asdasd', 'Numinds', 'Design', 'sfsbkg', 'http://localhost/LRS2026/', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '::1', 'InProgress', '2026-01-26 10:39:26', '2026-01-26 12:16:00', 'm@d.com', '7845121478', 'Morning (10am–12pm)'),
(22, 'asdasd', 'Numinds', 'Design', 'dhfdhf', 'http://localhost/LRS2026/', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '::1', 'New', '2026-01-26 12:16:29', NULL, 'm@d.com', '7845121478', 'Morning (10am–12pm)');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL,
  `rating` tinyint(4) NOT NULL DEFAULT 5,
  `review` text NOT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `name`, `image`, `rating`, `review`, `is_active`, `created_at`) VALUES
(1, 'Rohit Sharma', 'user1.jpg', 5, 'Outstanding creative team. The production quality and attention to detail exceeded expectations. Highly recommended.', 0, '2026-01-25 17:09:12'),
(2, 'Ananya Mehta', 'user2.jpg', 5, 'Cinematic visuals, smooth execution, and extremely professional delivery. One of the best agencies we\'ve worked with.', 1, '2026-01-25 17:09:12'),
(3, 'Vikas Patel', 'user3.jpg', 4, 'Creative concepts backed by strong execution. Timelines were respected and communication was smooth throughout.', 1, '2026-01-25 17:09:12'),
(4, 'Neha Kapoor', 'review_6976607aca6aa.jpg', 5, 'Their branding sense is top-notch. The final output looked premium and perfectly aligned with our brand vision.s', 1, '2026-01-25 17:09:12'),
(5, 'Arjun Malhotrae', 'review_697660851bd6f.jpg', 4, 'From ideation to execution, everything felt seamless. The team understands modern content and audience psychology.', 1, '2026-01-25 17:09:12'),
(6, 'Pritam Verma', 'user6.jpg', 4, 'Great experience overall. The visuals were stunning and delivery was on time. Would definitely collaborate again.', 1, '2026-01-25 17:09:12');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(150) NOT NULL,
  `bg_color` varchar(20) NOT NULL,
  `sort_order` int(11) DEFAULT 0,
  `status` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `title`, `bg_color`, `sort_order`, `status`, `created_at`, `updated_at`) VALUES
(1, 'aaa', '#1fbbc7', 0, 1, '2026-01-13 17:21:49', NULL),
(2, 'www', '#1a7f86', 0, 1, '2026-01-13 17:22:00', NULL),
(3, 'Video', '#4a1985', 1, 1, '2026-01-22 18:01:18', NULL),
(4, 'Production', '#8cc610', 0, 1, '2026-01-25 18:30:08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `service_items`
--

CREATE TABLE `service_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `service_id` int(10) UNSIGNED NOT NULL,
  `item_name` varchar(150) NOT NULL,
  `sort_order` int(11) DEFAULT 0,
  `status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service_items`
--

INSERT INTO `service_items` (`id`, `service_id`, `item_name`, `sort_order`, `status`) VALUES
(1, 1, 'www', 0, 1),
(2, 1, 'ww', 0, 1),
(3, 3, 'asd', 0, 1),
(4, 3, 'lop', 0, 1),
(5, 4, 'hugbugu', 0, 1),
(6, 4, 'ghugugu', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

CREATE TABLE `site_settings` (
  `id` int(11) NOT NULL DEFAULT 1,
  `short_tagline` varchar(255) DEFAULT NULL,
  `hero_image` varchar(255) DEFAULT NULL,
  `particles_enabled` tinyint(1) DEFAULT 1,
  `business_email` varchar(150) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `whatsapp` varchar(50) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `facebook_url` varchar(255) DEFAULT NULL,
  `facebook_enabled` tinyint(1) DEFAULT 1,
  `instagram_url` varchar(255) DEFAULT NULL,
  `instagram_enabled` tinyint(1) DEFAULT 1,
  `linkedin_url` varchar(255) DEFAULT NULL,
  `linkedin_enabled` tinyint(1) DEFAULT 1,
  `youtube_url` varchar(255) DEFAULT NULL,
  `youtube_enabled` tinyint(1) DEFAULT 1,
  `twitter_url` varchar(255) DEFAULT NULL,
  `twitter_enabled` tinyint(1) DEFAULT 0,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL,
  `google_verification` varchar(255) DEFAULT NULL,
  `facebook_pixel` varchar(100) DEFAULT NULL,
  `google_analytics` varchar(100) DEFAULT NULL,
  `activity_logs` tinyint(1) DEFAULT 1,
  `maintenance_mode` tinyint(1) DEFAULT 0,
  `maintenance_message` text DEFAULT NULL,
  `enable_hero` tinyint(1) DEFAULT 1,
  `enable_services` tinyint(1) DEFAULT 1,
  `enable_clients` tinyint(1) DEFAULT 1,
  `enable_celebrities` tinyint(1) DEFAULT 1,
  `enable_video_gallery` tinyint(1) DEFAULT 1,
  `enable_portfolio` tinyint(1) DEFAULT 1,
  `enable_instafeed` tinyint(1) DEFAULT 1,
  `enable_reviews` tinyint(1) DEFAULT 1,
  `enable_stories` tinyint(1) DEFAULT 1,
  `enable_featured_in` tinyint(1) DEFAULT 1,
  `enable_team` tinyint(1) DEFAULT 1,
  `enable_cta` tinyint(1) DEFAULT 1,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`id`, `short_tagline`, `hero_image`, `particles_enabled`, `business_email`, `phone`, `whatsapp`, `address`, `facebook_url`, `facebook_enabled`, `instagram_url`, `instagram_enabled`, `linkedin_url`, `linkedin_enabled`, `youtube_url`, `youtube_enabled`, `twitter_url`, `twitter_enabled`, `meta_title`, `meta_description`, `meta_keywords`, `google_verification`, `facebook_pixel`, `google_analytics`, `activity_logs`, `maintenance_mode`, `maintenance_message`, `enable_hero`, `enable_services`, `enable_clients`, `enable_celebrities`, `enable_video_gallery`, `enable_portfolio`, `enable_instafeed`, `enable_reviews`, `enable_stories`, `enable_featured_in`, `enable_team`, `enable_cta`, `updated_at`) VALUES
(1, 'Let’s Start a Brand New Story', 'hero_1769357865.jpg', 1, 'a@w.com2', '9836194203', '919836194203', 'Living Room Storiez\r\nBE 102, Shantipally, Rajdanga, Kasba\r\nKolkata:700107, West Bengal, India', 'https://www.facebook.com/livingroomstoriez14', 1, 'https://www.instagram.com/livingroomstoriez14/', 1, 'https://in.linkedin.com/company/living-room-storiez', 1, 'https://www.youtube.com/@livingroomstoriez1487/videos', 1, '0', 0, 'LivingRoomStoriez -Offical Website', 'sdfdsf', 'dfsfds', 'dsffds', 'sdffds', 'dfsfds', 0, 0, 'Site is Under Maintenance2', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, '2026-01-26 07:52:07');

-- --------------------------------------------------------

--
-- Table structure for table `story_controls`
--

CREATE TABLE `story_controls` (
  `id` int(11) NOT NULL,
  `wp_post_id` int(11) NOT NULL,
  `wp_category_id` int(11) NOT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `is_featured` tinyint(1) DEFAULT 0,
  `clicks` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `story_controls`
--

INSERT INTO `story_controls` (`id`, `wp_post_id`, `wp_category_id`, `is_active`, `is_featured`, `clicks`, `created_at`) VALUES
(1, 4132, 1, 0, 0, 0, '2026-01-22 16:00:59'),
(2, 4191, 1, 0, 0, 0, '2026-01-22 16:00:59'),
(3, 4094, 1, 0, 0, 0, '2026-01-22 16:00:59'),
(4, 3936, 37, 1, 0, 0, '2026-01-22 16:00:59'),
(5, 4059, 70, 1, 0, 0, '2026-01-22 16:00:59'),
(6, 3968, 70, 0, 0, 0, '2026-01-22 16:00:59'),
(7, 3947, 22, 1, 0, 0, '2026-01-22 16:00:59'),
(8, 3878, 70, 1, 0, 0, '2026-01-22 16:00:59'),
(9, 3810, 70, 1, 0, 0, '2026-01-22 16:00:59'),
(10, 3788, 70, 1, 1, 0, '2026-01-22 16:00:59'),
(11, 3744, 37, 1, 0, 0, '2026-01-22 16:00:59'),
(12, 3695, 70, 1, 0, 0, '2026-01-22 16:00:59'),
(13, 3581, 70, 1, 0, 0, '2026-01-22 16:00:59'),
(14, 3599, 70, 1, 0, 0, '2026-01-22 16:00:59'),
(15, 3558, 70, 0, 0, 0, '2026-01-22 16:00:59'),
(16, 3196, 67, 0, 0, 0, '2026-01-22 16:00:59'),
(17, 3438, 37, 1, 1, 0, '2026-01-22 16:00:59'),
(18, 3409, 37, 1, 0, 0, '2026-01-22 16:00:59'),
(19, 3365, 37, 0, 0, 0, '2026-01-22 16:00:59'),
(20, 3327, 60, 0, 0, 0, '2026-01-22 16:00:59'),
(21, 3294, 37, 0, 0, 0, '2026-01-22 16:00:59'),
(22, 3246, 40, 0, 0, 0, '2026-01-22 16:00:59'),
(23, 3176, 37, 0, 0, 0, '2026-01-22 16:00:59'),
(24, 2694, 40, 0, 0, 0, '2026-01-22 16:00:59'),
(25, 2982, 40, 0, 0, 0, '2026-01-22 16:00:59'),
(26, 2698, 44, 0, 0, 0, '2026-01-22 16:00:59'),
(27, 2565, 40, 0, 0, 0, '2026-01-22 16:00:59'),
(28, 2450, 37, 0, 0, 0, '2026-01-22 16:00:59'),
(29, 2436, 27, 0, 0, 0, '2026-01-22 16:00:59'),
(30, 2423, 27, 0, 0, 0, '2026-01-22 16:00:59'),
(31, 2399, 22, 0, 0, 0, '2026-01-22 16:00:59');

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
  `designation` varchar(150) NOT NULL,
  `image` varchar(255) NOT NULL,
  `sort_order` int(11) DEFAULT 0,
  `status` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`id`, `name`, `designation`, `image`, `sort_order`, `status`, `created_at`, `updated_at`) VALUES
(1, 'asdasd', 'Artist', 'team_69666e26b3339.png', 1, 1, '2026-01-13 16:09:10', NULL),
(2, 'RFGY', 'Artist', 'team_69666e36ec1c3.png', 2, 1, '2026-01-13 16:09:26', NULL),
(3, 'Zaheer Alam', 'CEO', 'team_696b294a7f015.jpg', 0, 1, '2026-01-13 16:29:19', '2026-01-17 06:16:42'),
(4, 'aaaa', 'aaa', 'team_696b295bac6f7.png', 3, 1, '2026-01-17 06:16:59', NULL),
(5, 'asasas', 'sasasa', 'team_696b296a47a56.png', 0, 1, '2026-01-17 06:17:14', NULL),
(6, 'asasa', 'assas', 'team_696b2976eee3c.jpg', 3, 1, '2026-01-17 06:17:26', NULL),
(7, 'asasa', 'sasasa', 'team_696b29877d396.jpg', 4, 1, '2026-01-17 06:17:43', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','editor') DEFAULT 'admin',
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `is_active`, `created_at`) VALUES
(1, 'LRSAdmin', '$2y$10$KP7aFuCvZUyak6CRerQtqOTyZsh1gYFPq4MoCwRuMXkxn2r1Kdw76', 'admin', 1, '2026-01-25 13:19:42'),
(2, 'LRSEditor', '$2y$10$wJxso0bd4dbD/f1bAXoh2O9SsyH0e3i5raxpPFMlcWwCzcjhylaAG', 'editor', 1, '2026-01-25 13:20:04');

-- --------------------------------------------------------

--
-- Table structure for table `youtube_shorts`
--

CREATE TABLE `youtube_shorts` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(150) DEFAULT NULL,
  `video_id` varchar(50) NOT NULL,
  `sort_order` int(11) DEFAULT 0,
  `status` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `youtube_shorts`
--

INSERT INTO `youtube_shorts` (`id`, `title`, `video_id`, `sort_order`, `status`, `created_at`, `updated_at`) VALUES
(1, 'aa', 'LXyMDEM-sF8', 3, 1, '2026-01-16 11:42:33', NULL),
(2, '1234', 'KIJF90PDuUk', 0, 1, '2026-01-16 11:42:44', NULL),
(3, 'qwqeeq', 'hmNcmB-cnhA', 2, 1, '2026-01-16 11:43:00', NULL),
(4, 'sadas', '1sTW59ifJaE', 1, 1, '2026-01-16 11:43:21', NULL),
(5, 'qwq', 'zsMuG6SmQMk', 3, 1, '2026-01-16 11:43:35', NULL),
(6, 'weqr3', 'aDdsk7yRGgY', 4, 1, '2026-01-16 11:43:50', NULL),
(7, 'qweqeq', '7pj8fPQ5CUY', 5, 1, '2026-01-16 11:44:04', NULL),
(8, 'zXZzxc', 'dlijJgk1Y-A', 6, 1, '2026-01-16 11:44:21', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `analytics_events`
--
ALTER TABLE `analytics_events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `celebrities`
--
ALTER TABLE `celebrities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hero_settings`
--
ALTER TABLE `hero_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homepage_stories`
--
ALTER TABLE `homepage_stories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `wp_post_id` (`wp_post_id`);

--
-- Indexes for table `instagram_reels`
--
ALTER TABLE `instagram_reels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `portfolio`
--
ALTER TABLE `portfolio`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `project_leads`
--
ALTER TABLE `project_leads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_items`
--
ALTER TABLE `service_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `service_id` (`service_id`);

--
-- Indexes for table `site_settings`
--
ALTER TABLE `site_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `story_controls`
--
ALTER TABLE `story_controls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `youtube_shorts`
--
ALTER TABLE `youtube_shorts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `analytics_events`
--
ALTER TABLE `analytics_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `celebrities`
--
ALTER TABLE `celebrities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `homepage_stories`
--
ALTER TABLE `homepage_stories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `instagram_reels`
--
ALTER TABLE `instagram_reels`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `portfolio`
--
ALTER TABLE `portfolio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `project_leads`
--
ALTER TABLE `project_leads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `service_items`
--
ALTER TABLE `service_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `story_controls`
--
ALTER TABLE `story_controls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `youtube_shorts`
--
ALTER TABLE `youtube_shorts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `service_items`
--
ALTER TABLE `service_items`
  ADD CONSTRAINT `service_items_ibfk_1` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
