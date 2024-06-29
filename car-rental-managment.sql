-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 29, 2024 at 11:09 AM
-- Server version: 8.0.30
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `car-rental-managment`
--

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE IF NOT EXISTS `clients` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `ice` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agency_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `cin` varchar(12) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `clients_email_unique` (`email`),
  KEY `clients_agency_id_foreign` (`agency_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `name`, `phone`, `email`, `address`, `ice`, `agency_id`, `created_at`, `updated_at`, `cin`, `city`, `type`) VALUES
(5, 'YASSIR FRI', '0627183035', 'yassirfri318@gmail.com', NULL, NULL, 2, '2024-06-15 17:33:51', '2024-06-15 17:33:51', NULL, NULL, NULL),
(6, 'ziad', '0627183035', 'ziadfri318@gmail.com', NULL, NULL, 2, '2024-06-15 17:34:04', '2024-06-15 17:34:04', NULL, NULL, NULL),
(8, 'Ayman', '0627183035', 'aymanyouss@test.com', NULL, NULL, 4, '2024-06-19 12:55:52', '2024-06-19 12:55:52', NULL, NULL, NULL),
(9, 'Ayman', '0627183035', 'yassirfri8@gmail.com', 'Lot 660, Hay Moulay Rachid, Ben Guerir 43150', NULL, 2, '2024-06-21 21:23:23', '2024-06-21 21:23:23', 'AE306679', 'Bengrir', 'personne physique');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mechanical_states`
--

DROP TABLE IF EXISTS `mechanical_states`;
CREATE TABLE IF NOT EXISTS `mechanical_states` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `last_oil_change` date DEFAULT NULL,
  `mileage` int DEFAULT NULL,
  `tire_condition` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `brake_condition` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `engine_condition` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `technical_inspection` date DEFAULT NULL,
  `last_tax_pay` date NOT NULL,
  `technical_inspection_comment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `vehicle_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `mechanical_states_vehicle_id_foreign` (`vehicle_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mechanical_states`
--

INSERT INTO `mechanical_states` (`id`, `last_oil_change`, `mileage`, `tire_condition`, `brake_condition`, `engine_condition`, `technical_inspection`, `last_tax_pay`, `technical_inspection_comment`, `comment`, `created_at`, `updated_at`, `vehicle_id`) VALUES
(1, '2024-06-25', 150000, NULL, NULL, NULL, NULL, '2024-06-18', NULL, NULL, '2024-06-25 09:25:22', '2024-06-25 09:25:22', 19);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_06_09_174920_add_google_id_to_users_table', 2),
(6, '2024_06_10_195651_create_vehicles_table', 3),
(7, '2024_06_10_195918_create_rentals_table', 3),
(8, '2024_06_11_153038_create_clients_table', 4),
(9, '2024_06_11_223114_add_agency_id_to_vehicles_table', 5),
(12, '2024_06_11_223653_add_agency_id_2_to_vehicles_table', 6),
(13, '2024_06_12_113552_add_role_to_users_table', 7),
(14, '2024_06_13_095621_remove_renter_name_from_rentals_table', 8),
(15, '2024_06_15_144441_create_payments_table', 9),
(16, '2024_06_15_145759_add_payment_id_to_rentals_table', 9),
(17, '2024_06_15_152241_add_agency_id_to_clients_table', 10),
(18, '2024_06_15_193656_create_vehicle_models_table', 11),
(19, '2024_06_15_200910_create_mechanical_states_table', 11),
(20, '2024_06_15_201105_update_vehicles_table', 11),
(23, '2024_06_16_001853_update_vehicles_table_remove_fields_and_model', 12),
(24, '2024_06_16_003041_update_vehicles_table_remove_name', 13),
(25, '2024_06_16_141829_add_vehicle_id_to_mechanical_states_table', 14),
(26, '2024_06_19_085051_add_fields_to_vehicles_and_users_tables', 15),
(27, '2024_06_25_143342_create_notifications_table', 16);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `read` tinyint(1) NOT NULL DEFAULT '0',
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_user_id_foreign` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
CREATE TABLE IF NOT EXISTS `payments` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `amount` decimal(10,2) NOT NULL,
  `date_of_payment` date NOT NULL,
  `method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `amount`, `date_of_payment`, `method`, `created_at`, `updated_at`) VALUES
(8, '2100.00', '2024-06-21', 'CASH', '2024-06-22 12:05:42', '2024-06-22 12:05:42'),
(9, '2100.00', '2024-06-29', 'CASH', '2024-06-22 12:16:53', '2024-06-22 12:16:53'),
(10, '8000.00', '2024-06-26', 'CASH', '2024-06-25 09:41:59', '2024-06-25 09:41:59');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rentals`
--

DROP TABLE IF EXISTS `rentals`;
CREATE TABLE IF NOT EXISTS `rentals` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `vehicle_id` bigint UNSIGNED NOT NULL DEFAULT '2',
  `client_id` bigint UNSIGNED NOT NULL DEFAULT '1',
  `payment_id` bigint UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `rentals_vehicle_id_foreign` (`vehicle_id`),
  KEY `rentals_client_id_foreign` (`client_id`),
  KEY `rentals_payment_id_foreign` (`payment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rentals`
--

INSERT INTO `rentals` (`id`, `start_date`, `end_date`, `created_at`, `updated_at`, `vehicle_id`, `client_id`, `payment_id`) VALUES
(16, '2024-06-22', '2024-06-29', '2024-06-22 12:16:53', '2024-06-22 12:16:53', 18, 9, 9);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'agency',
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `google_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `city`, `zip_code`, `address`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `google_id`) VALUES
(1, 'yassir', 'yassirfri318@gmail.com', 'admin', NULL, NULL, NULL, NULL, '$2y$10$.5N4joP9e3kNasAyJYz1MuGBZIZ9lk7fusE50WlwcomD3dp40hIAy', NULL, '2024-06-12 11:02:11', '2024-06-12 11:02:11', NULL),
(2, 'yassir', 'ziadfri318@gmail.com', 'agency', 'Rabat', NULL, NULL, NULL, '$2y$10$WV7DT4chN6riADfbGeZPVui/kKsHFqE65LiwasW9slVzEk4kKbpV6', NULL, '2024-06-12 18:28:06', '2024-06-12 18:28:06', NULL),
(4, 'YASSIR', 'test@test.com', 'agency', 'Bengrir', '43150', 'Lot 660, Hay Moulay Rachid, Ben Guerir 43150', NULL, '$2y$10$aAMNEU4zy4J7aZ4vR/h8Ye.TwMeNdasBhAPimJm0TCCchj.toL5EC', NULL, '2024-06-19 09:42:32', '2024-06-19 10:03:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

DROP TABLE IF EXISTS `vehicles`;
CREATE TABLE IF NOT EXISTS `vehicles` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `availability` tinyint(1) NOT NULL DEFAULT '1',
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `agency_id` bigint UNSIGNED NOT NULL DEFAULT '1',
  `model_id` bigint UNSIGNED DEFAULT NULL,
  `mechanical_state_id` bigint UNSIGNED DEFAULT NULL,
  `plate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tax_value` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `vehicles_agency_id_foreign` (`agency_id`),
  KEY `vehicles_model_id_foreign` (`model_id`),
  KEY `vehicles_mechanical_state_id_foreign` (`mechanical_state_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`id`, `availability`, `price`, `created_at`, `updated_at`, `agency_id`, `model_id`, `mechanical_state_id`, `plate`, `tax_value`) VALUES
(14, 0, '300.00', '2024-06-19 10:21:42', '2024-06-19 12:56:42', 4, 3, NULL, '11119-a', NULL),
(15, 1, '300.00', '2024-06-19 12:54:27', '2024-06-19 12:54:27', 4, 8, NULL, '15649816', NULL),
(16, 1, '300.00', '2024-06-19 12:54:53', '2024-06-19 12:54:53', 4, 7, NULL, '419897465156-a', NULL),
(18, 0, '8000.00', '2024-06-22 12:04:41', '2024-06-22 12:16:53', 2, 8, NULL, '1222125-bac', NULL),
(19, 1, '800.00', '2024-06-25 09:25:22', '2024-06-25 12:18:05', 2, 7, 1, '78954656-b-4', 1500);

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_models`
--

DROP TABLE IF EXISTS `vehicle_models`;
CREATE TABLE IF NOT EXISTS `vehicle_models` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `constructor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `number_of_seats` int DEFAULT NULL,
  `horsepower` int DEFAULT NULL,
  `top_speed` int DEFAULT NULL,
  `price` int DEFAULT NULL,
  `year` int DEFAULT NULL,
  `fuel_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transmission` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `drive_train` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fuel_consumption` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trunk_size` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vehicle_models`
--

INSERT INTO `vehicle_models` (`id`, `type`, `name`, `constructor`, `image`, `number_of_seats`, `horsepower`, `top_speed`, `price`, `year`, `fuel_type`, `transmission`, `drive_train`, `fuel_consumption`, `trunk_size`, `created_at`, `updated_at`) VALUES
(1, 'sedan', 'Ford Mustang', 'Ford', 'mustang.jpg', 4, 310, 145, 38000, 2024, 'gas', 'automatic', 'rear wheel drive', '25', '13 cubic feet', NULL, NULL),
(2, 'sedan', 'Chevrolet Camaro', 'Chevrolet', 'camaro.jpg', 4, 295, 160, 35000, 2024, 'gas', 'automatic', 'rear wheel drive', '22', '11 cubic feet', NULL, NULL),
(3, 'sedan', 'Dodge Challenger', 'Dodge', 'challenger.jpg', 4, 375, 180, 40000, 2024, 'gas', 'automatic', 'rear wheel drive', '20', '16 cubic feet', NULL, NULL),
(4, 'sedan', 'Nissan GTR', 'Nissan', 'gtr.jpg', 2, 565, 205, 105000, 2024, 'premium gas', 'automatic', 'all wheel drive', '15', '8.4 cubic feet', NULL, NULL),
(5, 'sedan', 'Toyota Supra', 'Toyota', 'supra.jpg', 2, 382, 180, 50000, 2024, 'gas', 'automatic', 'rear wheel drive', '22', '10 cubic feet', NULL, NULL),
(6, 'sedan', 'Porsche 911', 'Porsche', '911.jpg', 2, 450, 205, 90000, 2024, 'premium gas', 'automatic', 'rear wheel drive', '18', '4.4 cubic feet', NULL, NULL),
(7, 'sedan', 'Lamborghini Aventador', 'Lamborghini', 'aventador.jpg', 2, 730, 217, 400000, 2024, 'premium gas', 'automatic', 'all wheel drive', '12', '8 cubic feet', NULL, NULL),
(8, 'sedan', 'Ferrari 488 GTB', 'Ferrari', '488gtb.jpg', 2, 660, 205, 250000, 2024, 'premium gas', 'automatic', 'rear wheel drive', '15', '7.9 cubic feet', NULL, NULL),
(9, 'sedan', 'McLaren 720S', 'McLaren', '720s.jpg', 2, 710, 212, 300000, 2024, 'premium gas', 'automatic', 'rear wheel drive', '15', '7.2 cubic feet', NULL, NULL),
(10, 'sedan', 'Bugatti Chiron', 'Bugatti', 'chiron.jpg', 2, 1500, 261, 5000000, 2024, 'premium gas', 'automatic', 'all wheel drive', '14', '8.6 cubic feet', NULL, NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `clients_agency_id_foreign` FOREIGN KEY (`agency_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `mechanical_states`
--
ALTER TABLE `mechanical_states`
  ADD CONSTRAINT `mechanical_states_vehicle_id_foreign` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rentals`
--
ALTER TABLE `rentals`
  ADD CONSTRAINT `rentals_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `rentals_payment_id_foreign` FOREIGN KEY (`payment_id`) REFERENCES `payments` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `rentals_vehicle_id_foreign` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD CONSTRAINT `vehicles_agency_id_foreign` FOREIGN KEY (`agency_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `vehicles_mechanical_state_id_foreign` FOREIGN KEY (`mechanical_state_id`) REFERENCES `mechanical_states` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `vehicles_model_id_foreign` FOREIGN KEY (`model_id`) REFERENCES `vehicle_models` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
