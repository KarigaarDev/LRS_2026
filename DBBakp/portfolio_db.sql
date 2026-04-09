-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 30, 2026 at 11:25 AM
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
(1, 'zzz', 'zzz', 'social', 'zzz', 'portfolio_696a671ceafb2.jpg', 'zzz', 'zzz', 'zzz', '0', 18, 1, 1, '2026-01-16 16:28:12'),
(2, 'aa', 'aa', 'logo', 'aaa', 'portfolio_696a67beba6e6.jpg', 'aaa', 'aa', 'aaa', '0', 0, 1, 2, '2026-01-16 16:30:54'),
(3, 'cccc', 'cccc', 'logo', 'ccc', 'portfolio_696a6842cb55e.jpeg', 'cc', 'cc', 'ccccccccccccccc', '0', 0, 1, 1, '2026-01-16 16:33:06'),
(4, 'asdsad', 'asdsad', 'menu', 'asdsadsad', 'portfolio_696a823a359c6.jpg', 'asdsad', 'adssad', 'dasdsad', '0', 10, 1, 0, '2026-01-16 18:23:54'),
(5, 'asdasdas', 'asdasdas', 'social', 'adsasdsad', 'portfolio_696a82632f33f.jpg', 'dsadsad', 'adsdsad', 'asdsada', '0', 29, 1, 9, '2026-01-16 18:24:35'),
(6, 'zcxcxzc', 'zcxcxzc', 'social', 'xczvxczv', 'portfolio_696a8289ce31b.jpg', 'xczvxzcv', 'vxczv', 'xzcvxzcvxzcxvcz', '0', 1, 1, 0, '2026-01-16 18:25:13'),
(7, 'xzcvxcz', 'xzcvxcz', 'print', 'vxczv', 'portfolio_696a829710345.webp', 'vxczv', 'v', 'xczvxczvxzcv', '0', 0, 1, 0, '2026-01-16 18:25:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `portfolio`
--
ALTER TABLE `portfolio`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `portfolio`
--
ALTER TABLE `portfolio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
