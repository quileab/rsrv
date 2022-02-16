-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         5.7.33 - MySQL Community Server (GPL)
-- SO del servidor:              Win64
-- HeidiSQL Versión:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para rsrv
CREATE DATABASE IF NOT EXISTS `rsrv` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `rsrv`;

-- Volcando estructura para tabla rsrv.bookings
CREATE TABLE IF NOT EXISTS `bookings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `equipment_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `status` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `price` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bookings_equipment_id_foreign` (`equipment_id`),
  KEY `bookings_user_id_foreign` (`user_id`),
  CONSTRAINT `bookings_equipment_id_foreign` FOREIGN KEY (`equipment_id`) REFERENCES `equipment` (`id`),
  CONSTRAINT `bookings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla rsrv.bookings: ~0 rows (aproximadamente)
DELETE FROM `bookings`;
/*!40000 ALTER TABLE `bookings` DISABLE KEYS */;
/*!40000 ALTER TABLE `bookings` ENABLE KEYS */;

-- Volcando estructura para tabla rsrv.customers
CREATE TABLE IF NOT EXISTS `customers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla rsrv.customers: ~0 rows (aproximadamente)
DELETE FROM `customers`;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;

-- Volcando estructura para tabla rsrv.equipment
CREATE TABLE IF NOT EXISTS `equipment` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `serial_number` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `manufacturer` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location_id` bigint(20) unsigned DEFAULT NULL,
  `treatment_id` bigint(20) unsigned DEFAULT NULL,
  `image_path` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `status` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla rsrv.equipment: ~0 rows (aproximadamente)
DELETE FROM `equipment`;
/*!40000 ALTER TABLE `equipment` DISABLE KEYS */;
INSERT INTO `equipment` (`id`, `name`, `description`, `serial_number`, `model`, `manufacturer`, `location_id`, `treatment_id`, `image_path`, `price`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'Velabody', 'La tecnología Velabody combina radiofrecuencia bipolar, vacuumterapia, masajes por rodillos automáticos e infrarrojo.', NULL, NULL, NULL, 1, NULL, 'https://esteticrental.com/img/01-equipo.jpg', 100.00, NULL, '2022-02-07 20:18:32', '2022-02-07 20:18:33'),
	(2, 'Criolipólisis', 'Reducción de la adiposidad localizada mediante frío extremo y vacuumterapia. Es la terapia de vanguardia para combatir esa adiposidad tan difícil de eliminar con otros métodos.', NULL, NULL, NULL, 1, NULL, 'https://esteticrental.com/img/02-equipo.jpg', 150.00, NULL, '2022-02-07 20:19:36', '2022-02-07 20:19:38'),
	(3, 'HIFU', 'Lifting facial y corporal sin cirugía. El Ultrasonido Focalizado de Alta Intensidad (HIFU) es la última tecnología para el tensado de la piel.', NULL, NULL, NULL, 1, NULL, 'https://esteticrental.com/img/hifu-estetic-rental.jpg', 180.00, NULL, '2022-02-07 20:20:34', '2022-02-07 20:20:35'),
	(4, 'Laser Depilación Definitiva', 'Este equipo cuenta una tecnología similar a la de láser, con un sistema de enfriamiento que garantiza que el tratamiento sea indoloro y tolerable. Además, el tiempo de sesión requerido por esta máquina es mucho menor al que demandan otros aparatos. ', NULL, NULL, NULL, 1, NULL, 'https://esteticrental.com/img/04-equipo.jpg', 200.00, NULL, '2022-02-07 20:21:32', '2022-02-07 20:21:33'),
	(5, 'Ondas de choque', 'Mediante el estímulo mecánico combate la Celulitis, disminuye el aspecto de la piel de naranja, alisa visiblemente la superficie y reduce el volumen del panículo adiposo.', NULL, NULL, NULL, 1, NULL, 'https://esteticrental.com/img/05-equipo.jpg', 150.00, NULL, '2022-02-07 20:22:02', '2022-02-07 20:22:03'),
	(6, 'Lipoláser', 'Proceso de fotobiomodulación que simula la demanda natural de energía del organismo, con la ventaja de poder seleccionar el depósito de adiposidad a trabajar.', NULL, NULL, NULL, 1, NULL, 'https://esteticrental.com/img/06-equipo.jpg', 180.00, NULL, '2022-02-07 20:22:44', '2022-02-07 20:22:46'),
	(7, 'Body Up', 'Neuromodulación que genera ondas de pulso magnético que estimulan la unión neuromuscular, induciendo la contracción muscular. ', NULL, NULL, NULL, 1, NULL, 'https://esteticrental.com/img/body_up.jpg', 120.00, NULL, '2022-02-07 20:23:24', '2022-02-07 20:23:25'),
	(10, '32132', '321321', '32132', '1321321', '321321', 1, NULL, 'images/01KSoYiCPxxRxZ7NgBIxiWZP9VPYr0hdJQXGgNnt.jpg', 0.00, '', '2022-02-14 00:29:40', '2022-02-14 00:29:40');
/*!40000 ALTER TABLE `equipment` ENABLE KEYS */;

-- Volcando estructura para tabla rsrv.equipment_treatment
CREATE TABLE IF NOT EXISTS `equipment_treatment` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla rsrv.equipment_treatment: ~0 rows (aproximadamente)
DELETE FROM `equipment_treatment`;
/*!40000 ALTER TABLE `equipment_treatment` DISABLE KEYS */;
/*!40000 ALTER TABLE `equipment_treatment` ENABLE KEYS */;

-- Volcando estructura para tabla rsrv.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla rsrv.failed_jobs: ~0 rows (aproximadamente)
DELETE FROM `failed_jobs`;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

-- Volcando estructura para tabla rsrv.locations
CREATE TABLE IF NOT EXISTS `locations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla rsrv.locations: ~0 rows (aproximadamente)
DELETE FROM `locations`;
/*!40000 ALTER TABLE `locations` DISABLE KEYS */;
INSERT INTO `locations` (`id`, `name`, `address`, `phone`, `email`, `created_at`, `updated_at`) VALUES
	(2, 'Principal', 'street', '3482555555', 'email@this.com', '2022-02-16 00:18:54', '2022-02-16 00:18:54'),
	(3, 'Secundario', 'otra dirección de por ahí', '3482111111', 'estees@unemail.com', '2022-02-16 00:30:10', '2022-02-16 00:30:10');
/*!40000 ALTER TABLE `locations` ENABLE KEYS */;

-- Volcando estructura para tabla rsrv.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla rsrv.migrations: ~13 rows (aproximadamente)
DELETE FROM `migrations`;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
	(4, '2019_08_19_000000_create_failed_jobs_table', 1),
	(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(6, '2022_02_07_132616_create_sessions_table', 1),
	(7, '2022_02_07_135500_create_locations_table', 1),
	(8, '2022_02_07_135827_create_equipment_table', 1),
	(9, '2022_02_07_140242_create_bookings_table', 1),
	(10, '2022_02_15_110044_create_treatments_table', 1),
	(11, '2022_02_15_135716_create_operators_table', 1),
	(12, '2022_02_15_135838_create_customers_table', 1),
	(13, '2022_02_15_211239_create_equipment_treatment_table', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Volcando estructura para tabla rsrv.operators
CREATE TABLE IF NOT EXISTS `operators` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla rsrv.operators: ~0 rows (aproximadamente)
DELETE FROM `operators`;
/*!40000 ALTER TABLE `operators` DISABLE KEYS */;
/*!40000 ALTER TABLE `operators` ENABLE KEYS */;

-- Volcando estructura para tabla rsrv.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla rsrv.password_resets: ~0 rows (aproximadamente)
DELETE FROM `password_resets`;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Volcando estructura para tabla rsrv.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
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

-- Volcando datos para la tabla rsrv.personal_access_tokens: ~0 rows (aproximadamente)
DELETE FROM `personal_access_tokens`;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;

-- Volcando estructura para tabla rsrv.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla rsrv.sessions: ~0 rows (aproximadamente)
DELETE FROM `sessions`;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('bX8yTo7czkigLBUAFkE8QMQsLD3iRoORykXQcIbj', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.87 Safari/537.36', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoia0R1bnFkUjF6SlJvSzVqTXFCU0hMcEw1MTZqWTdGRkd0OFFlRnpjOSI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjMxOiJodHRwOi8vbG9jYWxob3N0OjgwMDAvZXF1aXBtZW50Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjE3OiJwYXNzd29yZF9oYXNoX3dlYiI7czo2MDoiJDJ5JDEwJG1IL2JHa1pRQmNveWpPZjBtWjBFcy5IRzRURXRtWmxNQlB5bXl1UmxTOG9NbXo2SWNzbDVDIjtzOjIxOiJwYXNzd29yZF9oYXNoX3NhbmN0dW0iO3M6NjA6IiQyeSQxMCRtSC9iR2taUUJjb3lqT2YwbVowRXMuSEc0VEV0bVpsTUJQeW15dVJsUzhvTW16Nkljc2w1QyI7fQ==', 1644971508);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;

-- Volcando estructura para tabla rsrv.treatments
CREATE TABLE IF NOT EXISTS `treatments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duration` int(11) NOT NULL DEFAULT '5',
  `price` decimal(8,2) NOT NULL,
  `operatorPrice` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla rsrv.treatments: ~0 rows (aproximadamente)
DELETE FROM `treatments`;
/*!40000 ALTER TABLE `treatments` DISABLE KEYS */;
/*!40000 ALTER TABLE `treatments` ENABLE KEYS */;

-- Volcando estructura para tabla rsrv.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci,
  `phone` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint(20) unsigned DEFAULT NULL,
  `profile_photo_path` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla rsrv.users: ~0 rows (aproximadamente)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `phone`, `address`, `role`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`) VALUES
	(1, 'admin', 'admin@admin.com', NULL, '$2y$10$mH/bGkZQBcoyjOf0mZ0Es.HG4TEtmZlMBPymyuRlS8oMmz6Icsl5C', NULL, NULL, NULL, NULL, 'admin', NULL, NULL, NULL, '2022-02-15 23:53:37', '2022-02-15 23:53:37');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
