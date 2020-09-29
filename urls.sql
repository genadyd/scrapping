-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Сен 29 2020 г., 14:22
-- Версия сервера: 5.7.30-0ubuntu0.16.04.1
-- Версия PHP: 7.2.31-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- db: `scrapping`
--

-- --------------------------------------------------------

--
-- table `urls`
--

CREATE TABLE `urls` (
  `id` int(100) NOT NULL,
  `app_id` int(100) NOT NULL,
  `parent_id` int(100) NOT NULL,
  `status` int(3) NOT NULL,
  `counter` int(100) NOT NULL,
  `redirect` tinyint(1) NOT NULL DEFAULT '0',
  `url` text NOT NULL,
  `real_url` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--

--

--
-- idexes `urls`
--
ALTER TABLE `urls`
  ADD PRIMARY KEY (`id`);

--

--

--
-- AUTO_INCREMENT  `urls`
--
ALTER TABLE `urls`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
