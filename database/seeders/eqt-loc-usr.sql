USE `rsrv`;

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

INSERT INTO `locations` (`id`, `name`, `address`, `phone`, `email`, `created_at`, `updated_at`) VALUES
	(2, 'Principal', 'street', '3482555555', 'email@this.com', '2022-02-16 00:18:54', '2022-02-16 00:18:54'),
	(3, 'Secundario', 'otra dirección de por ahí', '3482111111', 'estees@unemail.com', '2022-02-16 00:30:10', '2022-02-16 00:30:10');

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `phone`, `address`, `role`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`) VALUES
	(1, 'admin', 'admin@admin.com', NULL, '$2y$10$mH/bGkZQBcoyjOf0mZ0Es.HG4TEtmZlMBPymyuRlS8oMmz6Icsl5C', NULL, NULL, NULL, NULL, 'admin', NULL, NULL, NULL, '2022-02-15 23:53:37', '2022-02-15 23:53:37');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

