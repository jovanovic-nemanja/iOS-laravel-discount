-- Adminer 4.2.5 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_photo` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sign_date` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `categories` (`id`, `category_name`, `parent`, `category_photo`, `slug`, `sign_date`, `created_at`, `updated_at`) VALUES
(2,	'HOTELS',	NULL,	'V1avF1Z4S7WoP6jNCRkitR5bzxvhpkSOp8T2US08.png',	'restaurant',	'2020-11-15 12:56:43',	'2020-11-15 03:56:43',	'2020-12-09 13:55:25'),
(3,	'Clinic',	NULL,	'oldCq4Zk9PDFNvSzIUJFqU5XdkoLBBVLGaK8kxnO.png',	'clinic',	'2020-11-15 05:56:36',	'2020-11-15 08:56:36',	'2020-12-06 18:10:37'),
(4,	'Supermarket',	NULL,	'FnthXeRGLCnemSmofm25cDxmOpG7vJ8b8x9kPEr5.png',	'supermarket',	'2020-11-15 05:56:50',	'2020-11-15 08:56:50',	'2020-12-06 18:12:10');

DROP TABLE IF EXISTS `discounts`;
CREATE TABLE `discounts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(2048) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount_photo` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `sign_date` datetime NOT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `discounts` (`id`, `title`, `description`, `discount_photo`, `vendor_id`, `sign_date`, `status`, `created_at`, `updated_at`) VALUES
(19,	'LADIES NIGHT',	'LADIES NIGHT\r\n\r\nTuesday 6:00pm to 10:00pm\r\nQwerty\r\nLAST DRINK IS FREE',	'mwOROeZMPQXw0HPFKiHWNWeJijQhCGZfjGpTO0BE.jpeg',	8,	'2020-12-09 01:27:25',	0,	'2020-12-09 13:27:25',	'2020-12-09 13:27:25'),
(20,	'HOTEL ROOM DISCOUNT',	'GET 25% DISCOUNT ON HOTEL STAY THIS HOLIDAY SEASON',	'tGvucZVgYqE8SIc4y5pomt6RfgE1lqgg2i44IVSD.jpeg',	8,	'2020-12-09 01:31:13',	0,	'2020-12-09 13:31:13',	'2020-12-09 13:31:14'),
(21,	'Kayak Discount',	'30AED only for Kayak rental',	'3DDjDerSoCfUOQ68fPwqdpd7A5EmE2AQFXIUL2Oc.jpeg',	12,	'2020-12-09 01:37:26',	0,	'2020-12-09 13:37:26',	'2020-12-09 13:37:26'),
(23,	'Direct discount',	'Direct discount',	'a71qnhy07l85S6aUDbBHpeTroJVJ2G8oI3GYKix5.png',	14,	'2020-12-09 02:28:48',	0,	'2020-12-09 14:28:48',	'2020-12-09 14:28:48');

DROP TABLE IF EXISTS `email_verify`;
CREATE TABLE `email_verify` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `verify_code` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `email_verify` (`id`, `email`, `verify_code`, `created_at`, `updated_at`) VALUES
(1,	'james@gmail.com',	123123,	NULL,	NULL),
(2,	'web.anon2019@gmail.com',	506625,	'2020-11-23 18:50:29',	'2020-11-23 18:50:29'),
(3,	'jovanovic.nemanja.1029@gmail.com',	910741,	'2020-11-30 15:16:36',	'2020-11-30 15:16:36'),
(4,	'brhor106@gmail.com',	719653,	'2020-12-02 17:21:56',	'2020-12-02 17:21:56'),
(5,	'nebiyu@solarisdubai.com',	181300,	'2020-12-02 18:59:42',	'2020-12-02 18:59:42'),
(6,	'addina77@gmail.com',	236568,	'2020-12-03 06:11:41',	'2020-12-03 06:11:41'),
(8,	'nebiyu@gmail.com',	678758,	'2020-12-03 14:12:55',	'2020-12-06 08:08:53'),
(55,	'bozokrkeljas0504@gmail.com',	722829,	'2020-12-09 12:48:38',	'2020-12-09 13:27:13'),
(56,	'nebiyue@yahoo.com',	153636,	'2020-12-09 13:08:06',	'2020-12-09 13:11:17'),
(57,	'nebiyu@mambodubai.com',	318688,	'2020-12-09 13:13:15',	'2020-12-11 11:25:17'),
(59,	'Saba.grujic.thunder@gmail.com',	183281,	'2020-12-09 14:05:44',	'2020-12-09 14:05:44'),
(60,	'sava.grujic.thunder@gmail.com',	393487,	'2020-12-09 14:06:24',	'2020-12-09 14:06:24'),
(64,	'king.fullstack.727@yandex.com',	564925,	'2020-12-11 09:50:21',	'2020-12-11 10:31:13'),
(65,	'bozokrkeljasm@gmail.com',	387270,	'2020-12-14 09:40:28',	'2020-12-14 09:40:28');

DROP TABLE IF EXISTS `general_settings`;
CREATE TABLE `general_settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `site_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `app_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `site_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_subtitle` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_desc` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_footer` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `general_settings` (`id`, `site_name`, `app_name`, `site_title`, `site_subtitle`, `site_desc`, `site_footer`, `created_at`, `updated_at`) VALUES
(1,	'Dubai Girl',	'Dubai Girl',	'Dubai Girl',	'Dubai Girl Marketplace',	'Dubai Girl',	'© Copyright 2020 - City of UAE Dubai. All rights reserved.',	'2020-11-14 10:39:37',	'2020-11-15 08:57:21');

DROP TABLE IF EXISTS `localization_settings`;
CREATE TABLE `localization_settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `language` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `localization_settings` (`id`, `language`, `currency`, `created_at`, `updated_at`) VALUES
(1,	'AED',	'AED',	'2020-11-14 10:39:37',	'2020-11-15 02:58:34');

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1,	'2020_11_14_182951_create_users_table',	1),
(2,	'2020_11_14_183133_create_password_resets_table',	1),
(3,	'2020_11_14_183334_create_vendors_table',	1),
(4,	'2020_11_14_183857_create_roles_table',	1),
(5,	'2020_11_14_183951_create_role_user_table',	1),
(6,	'2020_11_14_184053_create_general_settings_table',	1),
(7,	'2020_11_14_191508_create_localization_settings_table',	1),
(8,	'2020_11_14_191753_create_categories_table',	1),
(9,	'2020_11_14_191932_create_discounts_table',	1),
(10,	'2020_11_18_172245_create_email_verify_table',	2),
(11,	'2020_12_03_075800_create_video_table',	3);

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1,	'admin',	'2020-11-14 10:39:36',	'2020-11-14 10:39:36'),
(2,	'vendor',	'2020-11-14 10:39:36',	'2020-11-14 10:39:36'),
(3,	'buyer',	'2020-11-14 10:39:36',	'2020-11-14 10:39:36');

DROP TABLE IF EXISTS `role_user`;
CREATE TABLE `role_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `role_user` (`id`, `user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1,	1,	1,	'2020-11-14 10:39:36',	'2020-11-14 10:39:36'),
(5,	6,	3,	'2020-11-16 00:19:12',	'2020-11-16 00:19:12'),
(9,	11,	3,	'2020-12-02 19:01:28',	'2020-12-02 19:01:28'),
(10,	12,	3,	'2020-12-03 06:14:58',	'2020-12-03 06:14:58'),
(11,	13,	3,	'2020-12-03 17:24:42',	'2020-12-03 17:24:42'),
(12,	14,	3,	'2020-12-04 16:42:19',	'2020-12-04 16:42:19'),
(13,	15,	3,	'2020-12-04 19:42:18',	'2020-12-04 19:42:18'),
(23,	25,	3,	'2020-12-04 20:58:05',	'2020-12-04 20:58:05'),
(24,	26,	3,	'2020-12-04 21:00:04',	'2020-12-04 21:00:04'),
(25,	27,	3,	'2020-12-04 21:01:09',	'2020-12-04 21:01:09'),
(26,	28,	3,	'2020-12-04 21:06:39',	'2020-12-04 21:06:39'),
(27,	29,	3,	'2020-12-05 03:12:19',	'2020-12-05 03:12:19'),
(28,	30,	3,	'2020-12-05 03:26:00',	'2020-12-05 03:26:00'),
(29,	31,	3,	'2020-12-05 03:38:46',	'2020-12-05 03:38:46'),
(30,	32,	3,	'2020-12-05 03:47:59',	'2020-12-05 03:47:59'),
(31,	33,	3,	'2020-12-05 03:55:59',	'2020-12-05 03:55:59'),
(33,	35,	3,	'2020-12-05 04:12:56',	'2020-12-05 04:12:56'),
(34,	36,	3,	'2020-12-05 06:11:38',	'2020-12-05 06:11:38'),
(35,	37,	3,	'2020-12-05 06:13:11',	'2020-12-05 06:13:11'),
(36,	38,	3,	'2020-12-05 06:34:00',	'2020-12-05 06:34:00'),
(37,	39,	3,	'2020-12-05 09:35:28',	'2020-12-05 09:35:28'),
(38,	40,	3,	'2020-12-05 20:40:39',	'2020-12-05 20:40:39'),
(39,	41,	3,	'2020-12-06 08:10:48',	'2020-12-06 08:10:48'),
(40,	42,	3,	'2020-12-08 02:01:21',	'2020-12-08 02:01:21'),
(41,	43,	3,	'2020-12-08 16:33:49',	'2020-12-08 16:33:49'),
(42,	44,	3,	'2020-12-09 13:34:00',	'2020-12-09 13:34:00'),
(43,	45,	3,	'2020-12-09 13:51:25',	'2020-12-09 13:51:25'),
(44,	46,	3,	'2020-12-09 14:07:15',	'2020-12-09 14:07:15'),
(45,	47,	3,	'2020-12-11 11:26:36',	'2020-12-11 11:26:36'),
(46,	48,	3,	'2020-12-12 06:36:49',	'2020-12-12 06:36:49'),
(47,	49,	3,	'2020-12-14 09:43:15',	'2020-12-14 09:43:15');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userUniqueId` int(11) DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook_id` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google_id` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` int(11) DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `block` int(11) DEFAULT NULL,
  `birthday` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sign_date` datetime NOT NULL,
  `remarks` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `username`, `userUniqueId`, `email`, `photo`, `instagram_id`, `facebook_id`, `google_id`, `email_verified_at`, `password`, `block`, `birthday`, `address`, `sign_date`, `remarks`, `remember_token`, `created_at`, `updated_at`) VALUES
(1,	'Admin',	NULL,	'admin@gmail.com',	NULL,	NULL,	NULL,	NULL,	1,	'$2y$10$vyj9SUowNZ9tVQWs.dWqzu7B5FXiJBwPC.0cN/OMaotbk32k5hMFC',	-1,	'1985-10-19',	'Dubai 11',	'2020-11-14 07:11:36',	'administrator2',	'oGZxjkF393ntJVtllCElPols78GHwwAEVAdRGf7d98qDi86eF6SP7ZC8wVMt',	'2020-11-14 10:39:36',	'2020-11-15 08:53:21'),
(6,	'Ana',	100006,	'jovanovic.nemanja.1029@gmail.com',	'Qv5Org4H7XkEgxvgdbmrupNZFC6ZWkqe3ZhbIgua.jpeg',	'192481',	NULL,	NULL,	NULL,	'$2y$10$CmCNAwNfa/R/ZTModVcVdOStgtzLq8kZQz4Q57sGm.6HJJ7umSKhC',	-1,	'1999-10-29',	'Serbia Beograd',	'2020-11-16 09:19:12',	'test user',	NULL,	'2020-11-16 00:19:12',	'2020-12-13 06:49:51'),
(11,	'nebiyu',	1000011,	'nebiyu@solarisdubai.com',	'iCUThq9kN3FdD98Z8OuJqAsvkgzoHxbrDZcoxlID.jpeg',	NULL,	NULL,	NULL,	NULL,	'$2y$10$RSjrBwqkHBdlEYruuxAlGuXzrnKfCIEAhSaKn3bz/an5yyMbL8c5S',	-1,	NULL,	'1315',	'2020-12-02 07:01:28',	NULL,	NULL,	'2020-12-02 19:01:28',	'2020-12-12 09:32:08'),
(12,	'Adiam',	1000012,	'addina77@gmail.com',	'Rv72upugrIhVlgjIa1mbZsyUSt4zJjOplWnK5Dsy.jpeg',	NULL,	NULL,	NULL,	NULL,	'$2y$10$zOFcNBs0s0r6FXLXbVTKdeHEGWw8suvNV3lAUtEBYJelq5Vd7b11.',	-1,	NULL,	'1234',	'2020-12-03 06:14:58',	NULL,	NULL,	'2020-12-03 06:14:58',	'2020-12-12 09:32:40'),
(41,	'nebiyu',	1000041,	'nebiyu@gmail.com',	'5m9YNAqXLPjJQwgdVKXj7fLaVOVRYyYl6tWStRD9.jpeg',	NULL,	NULL,	NULL,	NULL,	'$2y$10$Y5e3wKLVNIGaU3F4Vl1gYuGOqWrBwV0IFQgbeHuKtS2VDACSwjtEG',	-1,	NULL,	'we',	'2020-12-06 08:10:48',	NULL,	NULL,	'2020-12-06 08:10:48',	'2020-12-12 09:34:33'),
(47,	'add',	1000047,	'nebiyu@mambodubai.com',	'WSxYBA5K5bd5N2xtqJ0AeQdpJvm55qignl5Cntz0.jpeg',	NULL,	NULL,	NULL,	NULL,	'$2y$10$1ViI5x5hGsBvRmoSX6GulOUkeG87Thdk4opZNMy7ix0ryPphxzJMe',	-1,	NULL,	'-23',	'2020-12-11 11:26:36',	NULL,	NULL,	'2020-12-11 11:26:36',	'2020-12-12 09:35:35'),
(49,	'Bozo',	1000049,	'bozokrkeljasm@gmail.com',	'dNDnB3qWnEB5rDH6RJpnFWilkEZBoopDaTcla6gZ.jpeg',	NULL,	NULL,	NULL,	NULL,	'$2y$10$i/a7D5AvcapgoT8U8yK2LukoxbNoctkSKL1lOKEPvYLRhNgEYvZH.',	0,	'Dec 14, 2020',	'wee',	'2020-12-14 09:43:15',	NULL,	NULL,	'2020-12-14 09:43:15',	'2020-12-14 09:43:15');

DROP TABLE IF EXISTS `vendors`;
CREATE TABLE `vendors` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `vendorname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendorUniqueId` int(11) DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) DEFAULT NULL,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sign_date` datetime NOT NULL,
  `remarks_vendor` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `vendors_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `vendors` (`id`, `vendorname`, `vendorUniqueId`, `email`, `category_id`, `phone`, `status`, `location`, `photo`, `instagram_id`, `facebook_id`, `sign_date`, `remarks_vendor`, `created_at`, `updated_at`) VALUES
(8,	'Media ONe',	200008,	'mediaone@gmail.com',	2,	'12345',	0,	'adsfass',	'vVgrsBdn2xb7AvBbuvye42vXVOVvtdvLyQmXRu41.png',	'https://www.instagram.com/mediaonehotel/',	'https://www.facebook.com/Media-one-535196743185997/',	'2020-12-05 05:47:22',	'Media ONe Hotel',	'2020-12-05 05:47:22',	'2020-12-12 09:37:11'),
(12,	'Le Méridien Mina Seyahi Beach Resort & Marina',	2000012,	'admin@gmail.com',	2,	'1234',	0,	'1234',	'xLYodxgJZAxJOshQfx8SgDQiXnTDeKH9rgz8TogF.png',	'A',	'A',	'2020-12-09 01:33:52',	'A',	'2020-12-09 13:33:52',	'2020-12-12 09:37:44'),
(14,	'Spinneys',	2000014,	'spinneys@gmail.com',	4,	'8888888888',	0,	'UAE',	'XbNSqtVhUU6UUw7TL4GwZNZZKN9Ywn3PoUhweKw9.jpeg',	'https://www.instagram.com/',	'https://www.facebook.com/',	'2020-12-09 02:16:13',	'spinneys',	'2020-12-09 14:16:13',	'2020-12-12 09:41:10');

DROP TABLE IF EXISTS `video`;
CREATE TABLE `video` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `link` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `video` (`id`, `link`, `active`, `created_at`, `updated_at`) VALUES
(1,	'2Y3xtkvtgCuK9xPWWmWI85LxJGzRmfwT4MO3DayM.mp4',	1,	NULL,	'2020-12-09 20:06:46');

-- 2020-12-15 20:37:56
