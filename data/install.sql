CREATE DATABASE IF NOT EXISTS recipebook;

USE recipebook;

CREATE TABLE IF NOT EXISTS `recipes` (
  `id` int(255) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ingredients` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `recipe` longtext COLLATE utf8_unicode_ci NOT NULL,
  `source` varchar(500) COLLATE utf8_unicode_ci,
  `image_path` varchar(255) COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `categories` (
    `id` int(12) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
    `color` varchar(7) COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `recipe_categories` (
    `recipe_id` int(12) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `category_id` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;