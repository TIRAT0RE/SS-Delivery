-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Время создания: Dec 18 2021, 23:02
-- Версия сервера: 8.0.24
-- Версия PHP: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


-- --------------------------------------------------------


CREATE TABLE IF NOT EXISTS `districts` (
  `id` int NOT NULL,
  `name` varchar(16) NOT NULL,
  `price_from` int NOT NULL,
  `price_to` int NOT NULL,
  PRIMARY KEY (`id`)
);

INSERT INTO `districts` (`id`, `name`, `price_from`, `price_to`) VALUES
(1, 'Голосіївський', 100, 1350),
(2, 'Оболонський', 150, 250),
(3, 'Печерський', 200, 600),
(4, 'Подільський', 80, 300),
(5, 'Святошинський', 200, 1000),
(6, 'Солом’янський', 100, 1500),
(7, 'Шевченківський', 200, 1000),
(8, 'Дарницький', 200, 1000),
(9, 'Деснянський', 200, 1000),
(10, 'Дніпровський', 200, 1000);


-- --------------------------------------------------------


CREATE TABLE IF NOT EXISTS `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `district_id` int NOT NULL,
  `customer_name` varchar(32) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address` varchar(512) NOT NULL,
  `price` int NOT NULL,
  `courier_name` varchar(32) DEFAULT NULL,
  `transport` varchar(32) DEFAULT NULL,
  `is_urgent` varchar(3) DEFAULT 'no' CHECK (`is_urgent` IN ('yes', 'no')),
  `status` varchar(15) DEFAULT 'Not accepted',
  `accepted_time` TIMESTAMP NULL DEFAULT NULL,
  `completed_time` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
);


INSERT INTO `orders` (`district_id`, `customer_name`, `phone`, `address`, `price`, `courier_name`, `transport`, `is_urgent`, `status`, `accepted_time`, `completed_time`) VALUES
(1, 'Test name', '380971111111', 'Test address', 100, NULL, NULL, 'no', 'Not accepted', NULL, NULL);

CREATE TABLE IF NOT EXISTS `couriers` (
  `id` int NOT NULL,
  `name` varchar(32) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `login` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `completed_amount` int DEFAULT 0,
  PRIMARY KEY (`id`)
);

INSERT INTO `couriers` (`id`, `name`, `phone`, `login`, `password`, `completed_amount`) VALUES
(1, 'Кесіль Станіслав', '0972143333', 'kesilstas', 'stas123', 0),
(2, 'Мартікян Сурен', '0972143334', 'martikiansuren', 'suren123', 0);


ALTER TABLE `districts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

DELIMITER //
CREATE TRIGGER after_order_accepted
BEFORE UPDATE ON orders
FOR EACH ROW
BEGIN
    IF NEW.status = 'Accepted' AND OLD.status != 'Accepted' THEN
        SET NEW.accepted_time = NOW();
    END IF;
END;
//

DELIMITER //
CREATE TRIGGER after_order_completed
BEFORE UPDATE ON orders
FOR EACH ROW
BEGIN
    IF NEW.status = 'Completed' AND OLD.status != 'Completed' THEN
        SET NEW.completed_time = NOW();
    END IF;
END;
//

DELIMITER ;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
