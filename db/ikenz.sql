-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 30, 2018 at 06:16 AM
-- Server version: 5.7.19
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ikenz`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_100000_create_password_resets_table', 1),
('2018_05_14_121639_create_users_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('sunnypatel477@gmail.com', '3241425eb2eeed7b6d42d7e37f55ca24dd5b99706e33d546ee2f2cf031af9273', '2018-05-14 07:27:11');

-- --------------------------------------------------------

--
-- Table structure for table `site_setting_option`
--

DROP TABLE IF EXISTS `site_setting_option`;
CREATE TABLE IF NOT EXISTS `site_setting_option` (
  `option_id` int(255) NOT NULL AUTO_INCREMENT,
  `option_name` varchar(200) NOT NULL,
  `option_value` longtext NOT NULL,
  `status` int(10) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL,
  PRIMARY KEY (`option_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `site_setting_option`
--

INSERT INTO `site_setting_option` (`option_id`, `option_name`, `option_value`, `status`, `created_date`, `updated_date`) VALUES
(1, 'site_title', 'palladium Hub', 1, '2018-05-22 07:26:20', '2018-05-22 10:51:04'),
(2, 'user_email', 'sunny.patel@palladiumhub.com', 1, '2018-05-22 09:46:02', '2018-05-22 10:51:04'),
(3, 'smtp_email', 'sunny.patel@palladiumhub.com', 1, '2018-05-22 09:46:02', '2018-05-22 10:51:04'),
(4, 'smtp_host', 'smtp.gmail.com', 1, '2018-05-22 09:46:02', '2018-05-22 10:51:04'),
(5, 'smtp_password', 'admin@123', 1, '2018-05-22 09:46:02', '2018-05-22 10:51:04'),
(9, 'smtp_port', '465', 1, '2018-05-22 10:45:53', '2018-05-22 10:51:04');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'sunny', 'sunnypatel477@gmail.com', '$2y$10$bWRFE7a4WgZ8Sxn5oec09OnfyQMZu6zfG.gKsuzHO/Qm38h9/eC4q', 'uyl70reI1hLhmZmegSm9VoCuOUF1wyqVkJWaIHKyeRlD8PyBaJGhqtPlRzvz', '2018-05-14 07:21:50', '2018-05-15 06:15:42'),
(2, 'admin', 'admin@admin.com', '$2y$10$jZJKwHuXuA//o2utfRq8cekzl.WUX62jS8RN69IhvhtKMOFFbDCKu', 'BwWVSivqzGfmPjcTFbal2icm0fiBzpQOYVGVXvi1cxr2xM6xzLnOzwlNklwB', '2018-05-14 07:34:18', '2018-05-15 06:16:05'),
(3, 'mukund', 'mukunt@gmail.com', '$2y$10$yCQoSMJ4ktGE16kwwTFK8OtWclZRQEOydRK8ceYb.PElk4/vZd/te', 'kjyQovFTq38KCCxvgXwxnCuso8ZgxgzO5EFy2mylOoaTI44rSai0KJWkA2z6', '2018-05-15 05:46:16', '2018-05-15 05:47:32'),
(4, 'sunny patel', 'test@gmail.com', '$2y$10$LOpHBBeWlFVFnKQZGQXdkODiKqxEGgjCUAcAvWMV8A8bjyeZigrEe', 'xMZb1gRwnu8P9gg3NFl0Usz2xYYwOCqyK0Ou85UMwAXtYlCltd7qsDhnrpGG', '2018-05-15 06:05:57', '2018-05-15 06:10:07');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
