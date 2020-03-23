-- Adminer 4.7.3 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Super Admin' COMMENT 'Super Admin|Admin',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `admins` (`id`, `email`, `password`, `name`, `phone_no`, `avatar`, `type`, `remember_token`, `created_at`, `updated_at`) VALUES
(1,	'swapon.ahamed@gmail.com',	'$2y$10$DZqSg8wdpYgDRJyAIsCRAO3PxBtVmkXn8PcvSDJWQtqHo2hcm.cdC',	'Swapon Ahamed',	'01726919674',	NULL,	'Super Admin',	'XrWBcOvVQEwyX2tjI5IRE6qfnsoZVcbF5TCT5ZXTfzBNRKybIpENEQjhspMn',	'2020-02-09 10:42:15',	'2020-02-10 01:38:44');

DROP TABLE IF EXISTS `brands`;
CREATE TABLE `brands` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `brands` (`id`, `name`, `description`, `image`, `created_at`, `updated_at`) VALUES
(5,	'Samsung',	'samsun descript Sony',	'1580463242.gif',	'2020-01-31 03:33:38',	'2020-01-31 03:34:02'),
(6,	'Sony',	'sony',	'1580480098.gif',	'2020-01-31 08:14:58',	'2020-01-31 08:14:58');

DROP TABLE IF EXISTS `carts`;
CREATE TABLE `carts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `order_id` int(10) unsigned DEFAULT NULL,
  `ip_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_quantity` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `carts` (`id`, `product_id`, `user_id`, `order_id`, `ip_address`, `product_quantity`, `created_at`, `updated_at`) VALUES
(5,	2,	20,	7,	'127.0.0.1',	2,	'2020-02-08 10:44:45',	'2020-02-08 10:47:06'),
(7,	4,	20,	8,	'127.0.0.1',	1,	'2020-02-08 10:47:13',	'2020-02-08 10:47:38'),
(16,	7,	NULL,	NULL,	'127.0.0.1',	1,	'2020-03-23 05:27:42',	'2020-03-23 05:27:42'),
(17,	4,	NULL,	NULL,	'127.0.0.1',	1,	'2020-03-23 06:15:38',	'2020-03-23 06:15:38'),
(18,	8,	NULL,	NULL,	'127.0.0.1',	1,	'2020-03-23 06:51:47',	'2020-03-23 06:51:47');

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` text COLLATE utf8mb4_unicode_ci,
  `parent_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `categories` (`id`, `name`, `description`, `image`, `parent_id`, `created_at`, `updated_at`) VALUES
(1,	'Fashion',	'Fashion',	'1580449911.jpg',	NULL,	'2020-01-30 23:51:51',	'2020-03-19 01:50:26'),
(2,	'Sunglass',	'Sunglass',	'1580453022.png',	1,	'2020-01-30 23:54:25',	'2020-01-31 00:43:42'),
(3,	'Household',	'house hold',	'1580450148.png',	NULL,	'2020-01-30 23:55:48',	'2020-01-30 23:55:48'),
(4,	'Others',	'sdsd ds',	'1580483376.jpg',	1,	'2020-01-31 09:09:36',	'2020-01-31 09:09:36');

DROP TABLE IF EXISTS `districts`;
CREATE TABLE `districts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `division_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `districts` (`id`, `name`, `division_id`, `created_at`, `updated_at`) VALUES
(2,	'Tangail',	2,	'2020-01-31 23:40:51',	'2020-01-31 23:52:23');

DROP TABLE IF EXISTS `divisions`;
CREATE TABLE `divisions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `priority` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `divisions` (`id`, `name`, `priority`, `created_at`, `updated_at`) VALUES
(2,	'Dhaka',	'1',	'2020-01-31 23:03:02',	'2020-01-31 23:03:02'),
(3,	'Rajshahi',	'2',	'2020-01-31 23:03:14',	'2020-01-31 23:03:14');

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(2,	'2014_10_12_100000_create_password_resets_table',	1),
(3,	'2019_08_19_000000_create_failed_jobs_table',	1),
(4,	'2019_11_25_175555_create_products_table',	1),
(5,	'2019_12_16_074311_create_categories_table',	1),
(6,	'2019_12_16_074410_create_brands_table',	1),
(8,	'2019_12_16_082507_create_product_images_table',	1),
(9,	'2020_01_29_170118_product_images_table',	1),
(10,	'2020_01_29_170201_drop_product_images_table',	1),
(11,	'2014_10_12_000000_create_users_table',	2),
(13,	'2020_02_01_041402_create_districts_table',	3),
(14,	'2020_02_01_041340_create_divisions_table',	4),
(16,	'2020_02_02_145430_create_carts_table',	5),
(17,	'2020_02_05_175648_create_settings_table',	6),
(18,	'2020_02_06_171841_create_payments_table',	7),
(19,	'2020_02_02_145312_create_orders_table',	8),
(20,	'2019_12_16_074526_create_admins_table',	9),
(21,	'2020_03_22_044122_sliders',	10);

DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `payment_id` int(10) unsigned DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipping_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_paid` tinyint(1) NOT NULL DEFAULT '0',
  `is_completed` tinyint(1) NOT NULL DEFAULT '0',
  `is_seen_by_admin` tinyint(1) NOT NULL DEFAULT '0',
  `transaction_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_cost` int(10) DEFAULT '60',
  `custom_discount` int(10) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `orders` (`id`, `user_id`, `payment_id`, `name`, `ip_address`, `phone_no`, `shipping_address`, `message`, `email`, `is_paid`, `is_completed`, `is_seen_by_admin`, `transaction_id`, `shipping_cost`, `custom_discount`, `created_at`, `updated_at`) VALUES
(3,	20,	2,	'swapon ahamed',	'127.0.0.1',	'01726919674',	'sdasdas',	'test',	'swapon.ahamed@gmail.com',	0,	0,	0,	'324324324',	60,	0,	'2020-02-08 10:12:43',	'2020-02-08 10:12:43'),
(4,	20,	1,	'swapon ahamed',	'127.0.0.1',	'01726919674',	'Nikunja',	'Test Cash on deli',	'swapon.ahamed@gmail.com',	1,	1,	1,	NULL,	70,	10,	'2020-02-08 10:13:10',	'2020-03-22 23:48:52'),
(5,	20,	3,	'swapon ahamed',	'127.0.0.1',	'01726919674',	'sdasdas',	'dsfds',	'swapon.ahamed@gmail.com',	0,	0,	0,	'32r324',	60,	0,	'2020-02-08 10:23:11',	'2020-02-08 10:23:11'),
(6,	20,	1,	'John Doe',	'127.0.0.1',	'01726919674',	'sdasdas',	NULL,	'swapon.ahamed@gmail.com',	0,	0,	0,	NULL,	60,	0,	'2020-02-08 10:23:53',	'2020-02-08 10:23:53'),
(7,	20,	2,	'swapon ahamed',	'127.0.0.1',	'01726919674',	'sdasdas',	NULL,	'swapon.ahamed@gmail.com',	0,	0,	0,	'4324324',	60,	0,	'2020-02-08 10:46:26',	'2020-02-08 10:46:26'),
(8,	20,	1,	'swapon ahamed',	'127.0.0.1',	'01726919674',	'sdasdas',	'dsfds',	'swapon.ahamed@gmail.com',	0,	0,	1,	NULL,	60,	0,	'2020-02-08 10:47:38',	'2020-03-22 11:00:01');

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `payments`;
CREATE TABLE `payments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `priority` tinyint(4) NOT NULL DEFAULT '1',
  `short_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'payment no.',
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'agent|personal',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `payments_short_name_unique` (`short_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `payments` (`id`, `name`, `image`, `priority`, `short_name`, `no`, `type`, `created_at`, `updated_at`) VALUES
(1,	'Cash on Delivery',	'cash_in.jpg',	1,	'cash_in',	NULL,	NULL,	'2020-02-06 17:29:23',	'2020-02-06 17:29:23'),
(2,	'bKash',	'bkash.jpg',	2,	'bkash',	'01726919674',	'personal',	'2020-02-06 17:30:59',	'2020-02-06 17:30:59'),
(3,	'Rocket',	'rocket.jpg',	3,	'rocket',	'017269196741',	'personal',	'2020-02-06 17:30:59',	'2020-02-06 17:30:59');

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(10) unsigned NOT NULL,
  `brand_id` int(10) unsigned NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '0',
  `price` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `offer_price` int(11) DEFAULT NULL,
  `admin_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `products` (`id`, `category_id`, `brand_id`, `title`, `description`, `slug`, `quantity`, `price`, `status`, `offer_price`, `admin_id`, `created_at`, `updated_at`) VALUES
(2,	1,	1,	'Samsung galaxy j7 nxt',	'test',	'test',	10,	10000,	0,	NULL,	1,	'2020-01-30 00:20:32',	'2020-01-30 00:20:32'),
(3,	1,	1,	'Samsung Galaxy Young',	'test',	'test',	10,	15000,	0,	NULL,	1,	'2020-01-30 00:23:03',	'2020-01-30 00:23:03'),
(4,	2,	5,	'Samsung galaxy',	'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum',	'samsung-galaxy-test',	10,	17000,	0,	NULL,	1,	'2020-01-30 07:51:12',	'2020-03-23 06:50:27'),
(7,	1,	6,	'Sony Camera',	'sony camera',	'sony-camera',	10,	8000,	0,	NULL,	1,	'2020-01-31 08:17:18',	'2020-01-31 08:17:18'),
(8,	4,	5,	'Titan sunglass',	'dtesfj dsjdsljs',	'titan-sunglass',	20,	5000,	0,	NULL,	1,	'2020-01-31 09:05:34',	'2020-01-31 09:55:47'),
(9,	4,	5,	'Gown',	'For Lades  cloth. Only machine wash.',	'gown',	10,	7000,	0,	NULL,	1,	'2020-03-23 06:49:13',	'2020-03-23 06:49:13');

DROP TABLE IF EXISTS `product_images`;
CREATE TABLE `product_images` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(10) unsigned NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `product_images` (`id`, `product_id`, `image`, `created_at`, `updated_at`) VALUES
(1,	1,	'1580318065.jpg',	'2020-01-29 11:14:25',	'2020-01-29 11:14:25'),
(2,	2,	'1580318083.jpg',	'2020-01-29 11:14:43',	'2020-01-29 11:14:43'),
(3,	2,	'1580318083.jpg',	'2020-01-29 11:14:43',	'2020-01-29 11:14:43'),
(4,	3,	'1580318197.jpg',	'2020-01-29 11:16:37',	'2020-01-29 11:16:37'),
(5,	3,	'1580318197.jpg',	'2020-01-29 11:16:37',	'2020-01-29 11:16:37'),
(6,	4,	'1580318327.jpg',	'2020-01-29 11:18:48',	'2020-01-29 11:18:48'),
(7,	4,	'1580365172.jpg',	'2020-01-30 00:19:32',	'2020-01-30 00:19:32'),
(8,	2,	'1580365232.jpg',	'2020-01-30 00:20:33',	'2020-01-30 00:20:33'),
(9,	3,	'1580365384.jpg',	'2020-01-30 00:23:04',	'2020-01-30 00:23:04'),
(10,	4,	'1580392272.jpg',	'2020-01-30 07:51:13',	'2020-01-30 07:51:13'),
(11,	5,	'1580392329.jpg',	'2020-01-30 07:52:09',	'2020-01-30 07:52:09'),
(12,	6,	'1580392631.jpg',	'2020-01-30 07:57:11',	'2020-01-30 07:57:11'),
(13,	7,	'1580480238.gif',	'2020-01-31 08:17:18',	'2020-01-31 08:17:18'),
(14,	8,	'1580483134.gif',	'2020-01-31 09:05:34',	'2020-01-31 09:05:34'),
(15,	9,	'1584967753.jpg',	'2020-03-23 06:49:13',	'2020-03-23 06:49:13');

DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_cost` int(10) unsigned NOT NULL DEFAULT '100',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `settings` (`id`, `email`, `phone`, `address`, `shipping_cost`, `created_at`, `updated_at`) VALUES
(1,	'test@test.com',	'017269999',	'Dhaka - 1000',	100,	'2020-02-05 18:02:40',	'2020-02-05 18:02:40');

DROP TABLE IF EXISTS `sliders`;
CREATE TABLE `sliders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `button_text` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `button_linke` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prioriy` tinyint(3) unsigned NOT NULL DEFAULT '10',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `sliders` (`id`, `title`, `image`, `button_text`, `button_linke`, `prioriy`, `created_at`, `updated_at`) VALUES
(2,	'Banner One',	'1584966985.jpg',	'Facebook',	'https://facebook.com',	1,	'2020-03-21 23:48:59',	'2020-03-23 06:36:25'),
(3,	'Banner Two',	'1584967012.jpg',	'Twitter',	'https://twitter.com',	2,	'2020-03-22 00:26:03',	'2020-03-23 06:36:52'),
(4,	'Banner Three',	'1584967045.png',	'Linkdin',	'https://linkdin.com',	3,	'2020-03-22 00:26:37',	'2020-03-23 06:37:25');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `street_address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `division_id` int(10) unsigned NOT NULL COMMENT 'Division table id',
  `district_id` int(10) unsigned NOT NULL COMMENT 'District table id',
  `ip_address` text COLLATE utf8mb4_unicode_ci,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shippint_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '0=inactive|1=active|2=banned',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_phone_no_unique` (`phone_no`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `password`, `phone_no`, `email`, `street_address`, `division_id`, `district_id`, `ip_address`, `avatar`, `shippint_address`, `email_verified_at`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(17,	'swapon',	'ahamed',	'swaponahamed',	'$2y$10$DZqSg8wdpYgDRJyAIsCRAO3PxBtVmkXn8PcvSDJWQtqHo2hcm.cdC',	'343242',	'manirujjamanakash@gmail.com',	'Nikinja',	2,	2,	NULL,	NULL,	NULL,	NULL,	1,	NULL,	'2020-02-01 09:57:30',	'2020-02-01 10:23:10'),
(20,	'swapon',	'ahamed',	'swaponahamed2',	'$2y$10$M6jmV4Z6274HxCxdvMoz9OR/4o/o67tRkO3JCrcD8wsOu1wy28d6G',	'01726919674',	'swapon.ahamed@gmail.com',	'Nikinja',	2,	2,	'127.0.0.1',	NULL,	'sdasdas',	NULL,	1,	NULL,	'2020-02-01 09:57:30',	'2020-02-02 08:49:11');

-- 2020-03-23 13:57:48
