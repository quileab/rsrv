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
  `customer_id` bigint(20) unsigned DEFAULT NULL,
  `treatment_id` bigint(20) unsigned DEFAULT NULL,
  `operator_id` bigint(20) unsigned DEFAULT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `status` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `price` decimal(10,2) unsigned DEFAULT NULL,
  `operator_price` decimal(10,2) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bookings_equipment_id_foreign` (`equipment_id`),
  KEY `bookings_user_id_foreign` (`user_id`),
  CONSTRAINT `bookings_equipment_id_foreign` FOREIGN KEY (`equipment_id`) REFERENCES `equipment` (`id`),
  CONSTRAINT `bookings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla rsrv.bookings: ~4 rows (aproximadamente)
DELETE FROM `bookings`;
/*!40000 ALTER TABLE `bookings` DISABLE KEYS */;
INSERT INTO `bookings` (`id`, `equipment_id`, `user_id`, `customer_id`, `treatment_id`, `operator_id`, `start_date`, `end_date`, `status`, `price`, `operator_price`, `created_at`, `updated_at`) VALUES
	(60, 1, 1, NULL, NULL, NULL, '2022-03-03 12:00:00', '2022-03-10 12:00:00', 'pending', 100.00, NULL, '2022-03-03 10:07:52', '2022-03-03 10:07:52'),
	(61, 1, 1, 2, 9, NULL, '2022-03-08 17:00:00', '2022-03-08 18:00:00', 'pending', 6000.00, 0.00, '2022-03-03 11:15:39', '2022-03-03 11:15:39'),
	(62, 1, 1, 2, 7, NULL, '2022-03-08 08:00:00', '2022-03-08 08:45:00', 'pending', 5500.00, 0.00, '2022-03-03 11:15:55', '2022-03-03 11:15:55'),
	(64, 1, 1, 2, 9, NULL, '2022-03-05 10:00:00', '2022-03-05 11:00:00', 'pending', 6000.00, 0.00, '2022-03-03 11:44:24', '2022-03-03 11:44:24'),
	(66, 1, 1, 2, 7, NULL, '2022-03-05 08:00:00', '2022-03-05 08:45:00', 'pending', 5500.00, 0.00, '2022-03-03 11:45:02', '2022-03-03 11:45:02'),
	(67, 1, 1, 2, 5, NULL, '2022-03-05 19:00:00', '2022-03-05 19:15:00', 'pending', 1500.00, 0.00, '2022-03-03 11:45:17', '2022-03-03 11:45:17'),
	(70, 1, 1, 2, 5, NULL, '2022-03-05 07:00:00', '2022-03-05 07:15:00', 'pending', 1500.00, 0.00, '2022-03-03 12:10:42', '2022-03-03 12:10:42'),
	(71, 1, 1, 2, 7, NULL, '2022-03-05 20:15:00', '2022-03-05 21:00:00', 'pending', 5500.00, 0.00, '2022-03-03 12:45:29', '2022-03-03 12:45:29'),
	(73, 1, 1, 2, 3, NULL, '2022-03-05 12:00:00', '2022-03-05 12:25:00', 'pending', 2000.00, 0.00, '2022-03-03 12:46:42', '2022-03-03 12:46:42'),
	(75, 1, 1, 2, 5, NULL, '2022-03-05 13:45:00', '2022-03-05 14:00:00', 'pending', 1500.00, 0.00, '2022-03-03 13:03:27', '2022-03-03 13:03:27'),
	(77, 1, 1, 2, 5, NULL, '2022-03-05 13:00:00', '2022-03-05 13:15:00', 'pending', 1500.00, 0.00, '2022-03-03 13:11:46', '2022-03-03 13:11:46'),
	(78, 1, 1, 2, 5, NULL, '2022-03-05 16:00:00', '2022-03-05 16:15:00', 'pending', 1500.00, 0.00, '2022-03-03 13:11:50', '2022-03-03 13:11:50'),
	(79, 1, 1, 2, 5, NULL, '2022-03-05 14:30:00', '2022-03-05 14:45:00', 'pending', 1500.00, 0.00, '2022-03-03 13:11:53', '2022-03-03 13:11:53'),
	(80, 1, 1, 1, 9, 3, '2022-03-05 17:00:00', '2022-03-05 18:00:00', 'pending', 6000.00, 1000.00, '2022-03-03 13:40:46', '2022-03-03 13:40:46');
/*!40000 ALTER TABLE `bookings` ENABLE KEYS */;

-- Volcando estructura para tabla rsrv.customers
CREATE TABLE IF NOT EXISTS `customers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pid` int(11) DEFAULT NULL,
  `address` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location_id` bigint(20) unsigned DEFAULT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla rsrv.customers: ~5 rows (aproximadamente)
DELETE FROM `customers`;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` (`id`, `name`, `pid`, `address`, `phone`, `email`, `location_id`, `user_id`, `created_at`, `updated_at`) VALUES
	(1, 'Perez María', NULL, 'San Martín 1520, Reconquista', '3482535487', 'permari@gmail.com', 2, NULL, '2022-02-17 21:44:18', '2022-02-17 21:44:18'),
	(2, 'Gomez Erminda', NULL, 'Chacabuco 2000', '3482 554335', 'gomezer@gmail.com', 3, 1, '2022-02-20 19:47:12', '2022-02-28 20:37:10'),
	(3, 'Gonzalez, Araceli', NULL, 'Buenos Aires', '113216541', 'agonzalez@hotmail.com', 2, 1, '2022-02-28 20:36:30', '2022-02-28 20:36:30'),
	(4, 'Ardohain Carolina', NULL, 'Algún lugar', '113216541', 'pampita@gmail.com', 4, 1, '2022-03-02 21:13:49', '2022-03-02 21:13:49'),
	(5, 'Gomez Juana', NULL, '25 de Mayo 2282 ', '3482 582480', 'juango@gmail.com', 4, 1, '2022-03-02 22:06:56', '2022-03-02 22:06:56');
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla rsrv.equipment: ~8 rows (aproximadamente)
DELETE FROM `equipment`;
/*!40000 ALTER TABLE `equipment` DISABLE KEYS */;
INSERT INTO `equipment` (`id`, `name`, `description`, `serial_number`, `model`, `manufacturer`, `location_id`, `treatment_id`, `image_path`, `price`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'Velabody', 'La tecnología Velabody combina radiofrecuencia bipolar, vacuumterapia, masajes por rodillos automáticos e infrarrojo.', NULL, NULL, NULL, 2, NULL, 'https://esteticrental.com/img/01-equipo.jpg', 100.00, NULL, '2022-02-07 20:18:32', '2022-02-28 21:57:31'),
	(2, 'Criolipólisis', 'Reducción de la adiposidad localizada mediante frío extremo y vacuumterapia. Es la terapia de vanguardia para combatir esa adiposidad tan difícil de eliminar con otros métodos.', NULL, NULL, NULL, 1, NULL, 'https://esteticrental.com/img/02-equipo.jpg', 150.00, NULL, '2022-02-07 20:19:36', '2022-02-07 20:19:38'),
	(3, 'HIFU', 'Lifting facial y corporal sin cirugía. El Ultrasonido Focalizado de Alta Intensidad (HIFU) es la última tecnología para el tensado de la piel.', NULL, NULL, NULL, 1, NULL, 'https://esteticrental.com/img/hifu-estetic-rental.jpg', 180.00, NULL, '2022-02-07 20:20:34', '2022-02-07 20:20:35'),
	(4, 'Laser Depilación Definitiva', 'Este equipo cuenta una tecnología similar a la de láser, con un sistema de enfriamiento que garantiza que el tratamiento sea indoloro y tolerable. Además, el tiempo de sesión requerido por esta máquina es mucho menor al que demandan otros aparatos. ', NULL, NULL, NULL, 1, NULL, 'https://esteticrental.com/img/04-equipo.jpg', 200.00, NULL, '2022-02-07 20:21:32', '2022-02-07 20:21:33'),
	(5, 'Ondas de choque', 'Mediante el estímulo mecánico combate la Celulitis, disminuye el aspecto de la piel de naranja, alisa visiblemente la superficie y reduce el volumen del panículo adiposo.', NULL, NULL, NULL, 1, NULL, 'https://esteticrental.com/img/05-equipo.jpg', 150.00, NULL, '2022-02-07 20:22:02', '2022-02-07 20:22:03'),
	(6, 'Lipoláser', 'Proceso de fotobiomodulación que simula la demanda natural de energía del organismo, con la ventaja de poder seleccionar el depósito de adiposidad a trabajar.', NULL, NULL, NULL, 1, NULL, 'https://esteticrental.com/img/06-equipo.jpg', 180.00, NULL, '2022-02-07 20:22:44', '2022-02-07 20:22:46'),
	(7, 'Body Up', 'Neuromodulación que genera ondas de pulso magnético que estimulan la unión neuromuscular, induciendo la contracción muscular. ', NULL, NULL, NULL, 1, NULL, 'https://esteticrental.com/img/body_up.jpg', 120.00, NULL, '2022-02-07 20:23:24', '2022-02-07 20:23:25'),
	(11, '546546', '321321', '654654', '654654', '6546546', 2, NULL, 'public/images/w6UZiCPgEcfZVHpwTdcGGdUX3fEeRLEdlViOTqOd.jpg', 0.00, '', '2022-02-17 21:59:22', '2022-02-17 21:59:22');
/*!40000 ALTER TABLE `equipment` ENABLE KEYS */;

-- Volcando estructura para tabla rsrv.equipment_treatment
CREATE TABLE IF NOT EXISTS `equipment_treatment` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `equipment_id` bigint(20) unsigned NOT NULL,
  `treatment_id` bigint(20) unsigned NOT NULL,
  `notes` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(8,2) DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla rsrv.equipment_treatment: ~16 rows (aproximadamente)
DELETE FROM `equipment_treatment`;
/*!40000 ALTER TABLE `equipment_treatment` DISABLE KEYS */;
INSERT INTO `equipment_treatment` (`id`, `equipment_id`, `treatment_id`, `notes`, `price`, `duration`, `created_at`, `updated_at`) VALUES
	(28, 6, 4, NULL, NULL, NULL, NULL, NULL),
	(30, 1, 3, NULL, NULL, NULL, NULL, NULL),
	(32, 6, 9, NULL, NULL, NULL, NULL, NULL),
	(34, 3, 5, NULL, NULL, NULL, NULL, NULL),
	(35, 3, 6, NULL, NULL, NULL, NULL, NULL),
	(39, 4, 1, NULL, NULL, NULL, NULL, NULL),
	(40, 4, 7, NULL, NULL, NULL, NULL, NULL),
	(41, 1, 9, NULL, NULL, NULL, NULL, NULL),
	(42, 1, 5, NULL, NULL, NULL, NULL, NULL),
	(43, 1, 7, NULL, NULL, NULL, NULL, NULL),
	(44, 5, 4, NULL, NULL, NULL, NULL, NULL),
	(45, 5, 8, NULL, NULL, NULL, NULL, NULL),
	(46, 5, 6, NULL, NULL, NULL, NULL, NULL),
	(47, 5, 3, NULL, NULL, NULL, NULL, NULL),
	(48, 2, 10, NULL, NULL, NULL, NULL, NULL),
	(49, 4, 11, NULL, NULL, NULL, NULL, NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla rsrv.locations: ~3 rows (aproximadamente)
DELETE FROM `locations`;
/*!40000 ALTER TABLE `locations` DISABLE KEYS */;
INSERT INTO `locations` (`id`, `name`, `address`, `phone`, `email`, `created_at`, `updated_at`) VALUES
	(2, 'Principal', 'street', '3482555555', 'email@this.com', '2022-02-16 00:18:54', '2022-02-16 00:18:54'),
	(3, 'Secundario', 'otra dirección de por ahí', '3482111111', 'estees@unemail.com', '2022-02-16 00:30:10', '2022-02-16 00:30:10'),
	(4, 'Estética Consentidas', '9 de Julio 2100', '3482555555', 'consentidas@gmail.com', '2022-03-02 21:10:55', '2022-03-02 21:10:55');
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
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pid` int(11) DEFAULT NULL,
  `address` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla rsrv.operators: ~0 rows (aproximadamente)
DELETE FROM `operators`;
/*!40000 ALTER TABLE `operators` DISABLE KEYS */;
INSERT INTO `operators` (`id`, `name`, `pid`, `address`, `phone`, `email`, `location_id`, `created_at`, `updated_at`) VALUES
	(1, 'Operador Uno', NULL, 'Maquinaria 432', '3482545877', 'operauno@gmail.com', 2, '2022-02-17 21:53:54', '2022-02-17 21:53:54'),
	(2, 'Op. Depilación', NULL, 'San Martin 654', '3482 555444', 'depil@gmail.com', NULL, '2022-03-03 13:29:48', '2022-03-03 13:33:02'),
	(3, 'Op. Vacuumterapia', NULL, 'Belgrano 987', '3482 666555', 'vacuum@gmail.com', NULL, '2022-03-03 13:34:04', '2022-03-03 13:34:04');
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

-- Volcando datos para la tabla rsrv.sessions: ~2 rows (aproximadamente)
DELETE FROM `sessions`;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('qIgQhlcHdpCBdFCD1bysT4xsI0yo5wbZDFWFW0C8', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36', 'YToxMDp7czo2OiJfdG9rZW4iO3M6NDA6Im4wMjdiSWVGcVQ3aWNMMU9tdEVra3NJcEQ3cWJiRUJGaUtxY3pzWlQiO3M6MzoidXJsIjthOjA6e31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozMDoiaHR0cDovL2xvY2FsaG9zdDo4MDAwL2NhbGVuZGFyIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjE3OiJwYXNzd29yZF9oYXNoX3dlYiI7czo2MDoiJDJ5JDEwJG1IL2JHa1pRQmNveWpPZjBtWjBFcy5IRzRURXRtWmxNQlB5bXl1UmxTOG9NbXo2SWNzbDVDIjtzOjIxOiJwYXNzd29yZF9oYXNoX3NhbmN0dW0iO3M6NjA6IiQyeSQxMCRtSC9iR2taUUJjb3lqT2YwbVowRXMuSEc0VEV0bVpsTUJQeW15dVJsUzhvTW16Nkljc2w1QyI7czo5OiJlcXVpcG1lbnQiO086MjA6IkFwcFxNb2RlbHNcRXF1aXBtZW50IjozMDp7czoxMzoiACoAY29ubmVjdGlvbiI7czo1OiJteXNxbCI7czo4OiIAKgB0YWJsZSI7czo5OiJlcXVpcG1lbnQiO3M6MTM6IgAqAHByaW1hcnlLZXkiO3M6MjoiaWQiO3M6MTA6IgAqAGtleVR5cGUiO3M6MzoiaW50IjtzOjEyOiJpbmNyZW1lbnRpbmciO2I6MTtzOjc6IgAqAHdpdGgiO2E6MDp7fXM6MTI6IgAqAHdpdGhDb3VudCI7YTowOnt9czoxOToicHJldmVudHNMYXp5TG9hZGluZyI7YjowO3M6MTA6IgAqAHBlclBhZ2UiO2k6MTU7czo2OiJleGlzdHMiO2I6MTtzOjE4OiJ3YXNSZWNlbnRseUNyZWF0ZWQiO2I6MDtzOjI4OiIAKgBlc2NhcGVXaGVuQ2FzdGluZ1RvU3RyaW5nIjtiOjA7czoxMzoiACoAYXR0cmlidXRlcyI7YToxMzp7czoyOiJpZCI7aToxO3M6NDoibmFtZSI7czo4OiJWZWxhYm9keSI7czoxMToiZGVzY3JpcHRpb24iO3M6MTE5OiJMYSB0ZWNub2xvZ8OtYSBWZWxhYm9keSBjb21iaW5hIHJhZGlvZnJlY3VlbmNpYSBiaXBvbGFyLCB2YWN1dW10ZXJhcGlhLCBtYXNhamVzIHBvciByb2RpbGxvcyBhdXRvbcOhdGljb3MgZSBpbmZyYXJyb2pvLiI7czoxMzoic2VyaWFsX251bWJlciI7TjtzOjU6Im1vZGVsIjtOO3M6MTI6Im1hbnVmYWN0dXJlciI7TjtzOjExOiJsb2NhdGlvbl9pZCI7aToyO3M6MTI6InRyZWF0bWVudF9pZCI7TjtzOjEwOiJpbWFnZV9wYXRoIjtzOjQzOiJodHRwczovL2VzdGV0aWNyZW50YWwuY29tL2ltZy8wMS1lcXVpcG8uanBnIjtzOjU6InByaWNlIjtzOjY6IjEwMC4wMCI7czo2OiJzdGF0dXMiO047czoxMDoiY3JlYXRlZF9hdCI7czoxOToiMjAyMi0wMi0wNyAyMDoxODozMiI7czoxMDoidXBkYXRlZF9hdCI7czoxOToiMjAyMi0wMi0yOCAyMTo1NzozMSI7fXM6MTE6IgAqAG9yaWdpbmFsIjthOjEzOntzOjI6ImlkIjtpOjE7czo0OiJuYW1lIjtzOjg6IlZlbGFib2R5IjtzOjExOiJkZXNjcmlwdGlvbiI7czoxMTk6IkxhIHRlY25vbG9nw61hIFZlbGFib2R5IGNvbWJpbmEgcmFkaW9mcmVjdWVuY2lhIGJpcG9sYXIsIHZhY3V1bXRlcmFwaWEsIG1hc2FqZXMgcG9yIHJvZGlsbG9zIGF1dG9tw6F0aWNvcyBlIGluZnJhcnJvam8uIjtzOjEzOiJzZXJpYWxfbnVtYmVyIjtOO3M6NToibW9kZWwiO047czoxMjoibWFudWZhY3R1cmVyIjtOO3M6MTE6ImxvY2F0aW9uX2lkIjtpOjI7czoxMjoidHJlYXRtZW50X2lkIjtOO3M6MTA6ImltYWdlX3BhdGgiO3M6NDM6Imh0dHBzOi8vZXN0ZXRpY3JlbnRhbC5jb20vaW1nLzAxLWVxdWlwby5qcGciO3M6NToicHJpY2UiO3M6NjoiMTAwLjAwIjtzOjY6InN0YXR1cyI7TjtzOjEwOiJjcmVhdGVkX2F0IjtzOjE5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', 1646314846);
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla rsrv.treatments: ~10 rows (aproximadamente)
DELETE FROM `treatments`;
/*!40000 ALTER TABLE `treatments` DISABLE KEYS */;
INSERT INTO `treatments` (`id`, `name`, `duration`, `price`, `operatorPrice`, `created_at`, `updated_at`) VALUES
	(1, 'Depilación definitiva full-body', 120, 2000.00, 1000.00, '2022-02-17 21:51:46', '2022-02-17 21:51:46'),
	(2, 'Exfoliación con punta de diamante', 20, 2000.00, 0.00, '2022-02-21 22:35:48', '2022-02-21 22:35:48'),
	(3, 'Vacunterapia o endermología', 25, 2000.00, 500.00, '2022-02-21 22:38:08', '2022-02-21 22:38:08'),
	(4, 'Hidrolipoclasia + cavitación', 30, 1800.00, 450.00, '2022-02-21 22:39:01', '2022-02-21 22:39:01'),
	(5, 'Radiofrecuencia', 15, 1500.00, 300.00, '2022-02-21 22:40:35', '2022-02-21 22:40:35'),
	(6, 'Presoterapia', 35, 3000.00, 450.00, '2022-02-21 22:41:09', '2022-02-21 22:41:09'),
	(7, 'IPL (Luz Pulsada Intensa)', 45, 5500.00, 1000.00, '2022-02-21 22:41:51', '2022-02-21 22:41:51'),
	(8, 'Venus Freeze MP2', 25, 3000.00, 500.00, '2022-02-21 22:45:44', '2022-02-21 22:45:44'),
	(9, 'VelaShape', 60, 6000.00, 1000.00, '2022-02-21 22:46:16', '2022-02-21 22:46:16'),
	(10, 'Criolipolisis', 15, 2000.00, 1200.00, '2022-03-02 22:09:33', '2022-03-02 22:09:33'),
	(11, 'WD40', 10, 500.00, 100.00, '2022-03-02 22:51:01', '2022-03-02 22:51:01');
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
