-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               5.6.14-log - MySQL Community Server (GPL)
-- Операционная система:         Win64
-- HeidiSQL Версия:              9.5.0.5226
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Дамп структуры базы данных pet_owners
CREATE DATABASE IF NOT EXISTS `pet_owners` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `pet_owners`;

-- Дамп структуры для таблица pet_owners.breeds
CREATE TABLE IF NOT EXISTS `breeds` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='Породы';

-- Дамп данных таблицы pet_owners.breeds: ~6 rows (приблизительно)
DELETE FROM `breeds`;
/*!40000 ALTER TABLE `breeds` DISABLE KEYS */;
/*!40000 ALTER TABLE `breeds` ENABLE KEYS */;

-- Дамп структуры для таблица pet_owners.owners
CREATE TABLE IF NOT EXISTS `owners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fio` varchar(100) NOT NULL DEFAULT '0' COMMENT 'ФИО владельца',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=111 DEFAULT CHARSET=utf8 COMMENT='Владельцы';

-- Дамп данных таблицы pet_owners.owners: ~4 rows (приблизительно)
DELETE FROM `owners`;
/*!40000 ALTER TABLE `owners` DISABLE KEYS */;
/*!40000 ALTER TABLE `owners` ENABLE KEYS */;

-- Дамп структуры для таблица pet_owners.parents
CREATE TABLE IF NOT EXISTS `parents` (
  `id_parent` int(11) NOT NULL,
  `id_child` int(11) NOT NULL,
  PRIMARY KEY (`id_parent`,`id_child`),
  KEY `id_child` (`id_child`),
  KEY `id_parent` (`id_parent`),
  CONSTRAINT `FK_parents_pets` FOREIGN KEY (`id_child`) REFERENCES `pets` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='родители';

-- Дамп данных таблицы pet_owners.parents: ~3 rows (приблизительно)
DELETE FROM `parents`;
/*!40000 ALTER TABLE `parents` DISABLE KEYS */;
/*!40000 ALTER TABLE `parents` ENABLE KEYS */;

-- Дамп структуры для таблица pet_owners.pets
CREATE TABLE IF NOT EXISTS `pets` (
  `id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `gender` varchar(1) DEFAULT NULL,
  `nickname` varchar(50) DEFAULT NULL,
  `age` decimal(3,1) DEFAULT NULL,
  `breed_id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `type_id` (`type_id`),
  KEY `breed_id` (`breed_id`),
  KEY `owner_id` (`owner_id`),
  CONSTRAINT `FK_pets_breeds` FOREIGN KEY (`breed_id`) REFERENCES `breeds` (`id`),
  CONSTRAINT `FK_pets_owners` FOREIGN KEY (`owner_id`) REFERENCES `owners` (`id`),
  CONSTRAINT `FK_pets_pet_types` FOREIGN KEY (`type_id`) REFERENCES `pet_types` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Питомцы';

-- Дамп данных таблицы pet_owners.pets: ~10 rows (приблизительно)
DELETE FROM `pets`;
/*!40000 ALTER TABLE `pets` DISABLE KEYS */;
/*!40000 ALTER TABLE `pets` ENABLE KEYS */;

-- Дамп структуры для таблица pet_owners.pet_types
CREATE TABLE IF NOT EXISTS `pet_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8 COMMENT='Типы питомцев';

-- Дамп данных таблицы pet_owners.pet_types: ~3 rows (приблизительно)
DELETE FROM `pet_types`;
/*!40000 ALTER TABLE `pet_types` DISABLE KEYS */;
/*!40000 ALTER TABLE `pet_types` ENABLE KEYS */;

-- Дамп структуры для таблица pet_owners.rewards
CREATE TABLE IF NOT EXISTS `rewards` (
  `pet_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`pet_id`,`name`),
  CONSTRAINT `FK_rewards_pets` FOREIGN KEY (`pet_id`) REFERENCES `pets` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Награды';

-- Дамп данных таблицы pet_owners.rewards: ~4 rows (приблизительно)
DELETE FROM `rewards`;
/*!40000 ALTER TABLE `rewards` DISABLE KEYS */;
/*!40000 ALTER TABLE `rewards` ENABLE KEYS */;

-- Дамп структуры для таблица pet_owners.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы pet_owners.users: ~0 rows (приблизительно)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `username`, `password`) VALUES
	(1, 'user', '202cb962ac59075b964b07152d234b70');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
