-- Adminer 5.3.0 MariaDB 11.4.4-MariaDB-ubu2204 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

CREATE DATABASE `notes` /*!40100 DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci */;
USE `notes`;

CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `color` varchar(7) DEFAULT '#007bff',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO `categories` (`id`, `name`, `color`, `created_at`) VALUES
(5,	'001',	'#ff1414',	'2025-08-07 08:51:01')
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `name` = VALUES(`name`), `color` = VALUES(`color`), `created_at` = VALUES(`created_at`);

CREATE TABLE `notes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `content` text NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `is_important` tinyint(1) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `notes_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO `notes` (`id`, `title`, `content`, `category_id`, `is_important`, `created_at`, `updated_at`) VALUES
(1,	'kelapa',	'saya suka kelapa',	5,	0,	'2025-08-07 08:52:41',	'2025-08-07 08:52:41')
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `title` = VALUES(`title`), `content` = VALUES(`content`), `category_id` = VALUES(`category_id`), `is_important` = VALUES(`is_important`), `created_at` = VALUES(`created_at`), `updated_at` = VALUES(`updated_at`);

-- 2025-08-08 01:32:59 UTC
