-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         5.7.36 - MySQL Community Server (GPL)
-- SO del servidor:              Win64
-- HeidiSQL Versión:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para noabs
DROP DATABASE IF EXISTS `noabs3`;
CREATE DATABASE IF NOT EXISTS `noabs3` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;
USE `noabs3`;

-- Volcando estructura para tabla noabs.admins
DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_user_id_unique` (`user_id`),
  CONSTRAINT `admins_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla noabs.admins: ~2 rows (aproximadamente)
DELETE FROM `admins`;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` (`id`, `user_id`, `created_at`, `updated_at`) VALUES
	(1, 1, '2018-09-05 22:11:50', '2018-09-05 22:11:50'),
	(2, 32, '2018-10-24 21:50:17', '2018-10-24 21:50:17');
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;

-- Volcando estructura para tabla noabs.gestors
DROP TABLE IF EXISTS `gestors`;
CREATE TABLE IF NOT EXISTS `gestors` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `institucion_id` int(10) unsigned NOT NULL,
  `activo` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `gestors_user_id_unique` (`user_id`),
  KEY `gestors_institucion_id_foreign` (`institucion_id`),
  CONSTRAINT `gestors_institucion_id_foreign` FOREIGN KEY (`institucion_id`) REFERENCES `institucions` (`id`),
  CONSTRAINT `gestors_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla noabs.gestors: ~8 rows (aproximadamente)
DELETE FROM `gestors`;
/*!40000 ALTER TABLE `gestors` DISABLE KEYS */;
/*!40000 ALTER TABLE `gestors` ENABLE KEYS */;

-- Volcando estructura para tabla noabs.institucions
DROP TABLE IF EXISTS `institucions`;
CREATE TABLE IF NOT EXISTS `institucions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `departamento` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_final` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla noabs.institucions: ~10 rows (aproximadamente)
DELETE FROM `institucions`;
/*!40000 ALTER TABLE `institucions` DISABLE KEYS */;
INSERT INTO `institucions` (`id`, `nombre`, `departamento`, `direccion`, `telefono`, `fecha_inicio`, `fecha_final`, `created_at`, `updated_at`) VALUES
	(1, 'CECAR', 'Cordoba', 'Sevilla', '3015735780', '2018-09-01', '2022-06-30', '2018-09-05 22:11:49', '2022-04-10 19:21:19');
/*!40000 ALTER TABLE `institucions` ENABLE KEYS */;

-- Volcando estructura para tabla noabs.migrations
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla noabs.migrations: 7 rows
DELETE FROM `migrations`;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2018_08_29_195406_create_institucions_table', 1),
	(3, '2018_08_29_195424_create_admins_table', 1),
	(4, '2018_08_29_195436_create_gestors_table', 1),
	(5, '2018_08_29_195450_create_ninos_table', 1),
	(6, '2018_08_29_195513_create_respuesta_ninos_table', 1),
	(7, '2018_09_20_161137_create_preguntas_table', 2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Volcando estructura para tabla noabs.ninos
DROP TABLE IF EXISTS `ninos`;
CREATE TABLE IF NOT EXISTS `ninos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sexo` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `institucion_id` int(10) unsigned NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `departamento` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `activo` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ninos_user_id_unique` (`user_id`),
  KEY `ninos_institucion_id_foreign` (`institucion_id`),
  CONSTRAINT `ninos_institucion_id_foreign` FOREIGN KEY (`institucion_id`) REFERENCES `institucions` (`id`),
  CONSTRAINT `ninos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=334 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla noabs.ninos: ~333 rows (aproximadamente)
DELETE FROM `ninos`;
/*!40000 ALTER TABLE `ninos` DISABLE KEYS */;
/*!40000 ALTER TABLE `ninos` ENABLE KEYS */;

-- Volcando estructura para tabla noabs.preguntas
DROP TABLE IF EXISTS `preguntas`;
CREATE TABLE IF NOT EXISTS `preguntas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pregunta` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contexto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla noabs.preguntas: 15 rows
DELETE FROM `preguntas`;
/*!40000 ALTER TABLE `preguntas` DISABLE KEYS */;
INSERT INTO `preguntas` (`id`, `pregunta`, `contexto`, `created_at`, `updated_at`) VALUES
	(13, '¿Cómo ya somos amigos me puedes mandar una foto o video tuyo al desnudo? ', 'Técnologico', NULL, NULL),
	(12, '¿Oye quieres que salgamos a pasear en mi auto? ', 'Social', NULL, NULL),
	(11, 'Hola mucho gusto, he visto tu perfil, podrías agregarme como tu amigo. ', 'Técnologico', NULL, NULL),
	(10, 'Ven conmigo, te voy a mostrar un lugar secreto del colegio. ', 'Escolar', NULL, NULL),
	(9, 'Ven te voy a enseñar y dar muchas cosas, si me tocas o yo toco todo tu cuerpo.', 'Escolar', NULL, NULL),
	(8, 'Oye acompáñame al baño, quiero enseñarte algo.', 'Escolar', NULL, NULL),
	(7, '¡Hey! ¿Tienes Facebook, Instagram, WhatsApp, u otra red social?', 'Técnologico', NULL, NULL),
	(6, '¿Hola, a dónde vas?, te invito a entrar a mi casa, tengo muchos dulces y videojuegos.', 'Social', NULL, NULL),
	(5, '¿Oye, no le digas a nadie el secreto que tenemos tu y yo?', 'Familiar', NULL, NULL),
	(4, '¿Al ingresar a estas páginas te agrada el contenido?', 'Técnologico', NULL, NULL),
	(3, '¿Quieres darle clic y navegar en estas páginas?', 'Técnologico', NULL, NULL),
	(2, '¿Oye te interesan las páginas con contenidos para adultos?', 'Técnologico', NULL, NULL),
	(1, '¿Cuándo estemos solos me dejas acariciarte y tocarte?', 'Familiar', NULL, NULL),
	(14, 'Ven, siéntate conmigo, vamos a pasarla bien entre los dos.', 'Social', NULL, NULL),
	(15, '¿Voy a verte mientras te bañas o te cambias de ropa?', 'Familiar', NULL, NULL);
/*!40000 ALTER TABLE `preguntas` ENABLE KEYS */;

-- Volcando estructura para tabla noabs.respuesta_ninos
DROP TABLE IF EXISTS `respuesta_ninos`;
CREATE TABLE IF NOT EXISTS `respuesta_ninos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nino_id` int(10) unsigned NOT NULL,
  `fecha_realizacion` date NOT NULL,
  `r1` int(11) NOT NULL,
  `r2` int(11) NOT NULL,
  `r3` int(11) NOT NULL,
  `r4` int(11) NOT NULL,
  `r5` int(11) NOT NULL,
  `r6` int(11) NOT NULL,
  `r7` int(11) NOT NULL,
  `r8` int(11) NOT NULL,
  `r9` int(11) NOT NULL,
  `r10` int(11) NOT NULL,
  `r11` int(11) NOT NULL,
  `r12` int(11) NOT NULL,
  `r13` int(11) NOT NULL,
  `r14` int(11) NOT NULL,
  `r15` int(11) NOT NULL,
  `r16` int(11) DEFAULT NULL,
  `r17` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `respuesta_ninos_nino_id_foreign` (`nino_id`),
  CONSTRAINT `respuesta_ninos_nino_id_foreign` FOREIGN KEY (`nino_id`) REFERENCES `ninos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=318 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla noabs.respuesta_ninos: ~302 rows (aproximadamente)
DELETE FROM `respuesta_ninos`;
/*!40000 ALTER TABLE `respuesta_ninos` DISABLE KEYS */;
/*!40000 ALTER TABLE `respuesta_ninos` ENABLE KEYS */;

-- Volcando estructura para tabla noabs.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombres` varchar(90) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellidos` varchar(90) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(90) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=391 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla noabs.users: ~343 rows (aproximadamente)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `nombres`, `apellidos`, `username`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Andres', 'Bertel', 'admin1', 'andres.bertel@hotmail.com', '$2y$10$N83Y0FL3RTVicEgz5KM05uMTWYh4iBY8EWpbXi25fEgcJfOp4OhSy', '7X1hIgvHBwhlFCJBfBLUqOjmdcGm0PFNc1F9vNNooF9PsEyzOZZ3opEqGcx4', '2018-09-05 22:11:50', '2018-09-05 22:11:50'),
	(32, 'Usuario', 'Admin', 'admin', 'lesly.bravol@cecar.edu.co', '$2y$10$hQA83a3oi8OhUR/2WL7QZetPSQnCFZoWdpSL4dbmT3MWL0gCF5yYG', NULL, '2018-10-24 21:50:17', '2018-10-24 21:50:17');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
