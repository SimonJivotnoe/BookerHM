-- phpMyAdmin SQL Dump
-- version 4.0.10
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 20 2015 г., 12:12
-- Версия сервера: 5.5.38-log
-- Версия PHP: 5.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `booker`
--

-- --------------------------------------------------------

--
-- Структура таблицы `APPOINTMENTS`
--

CREATE TABLE IF NOT EXISTS `APPOINTMENTS` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(30) NOT NULL,
  `room_id` varchar(30) NOT NULL,
  `start_time_ms` bigint(20) NOT NULL,
  `end_time_ms` bigint(20) NOT NULL,
  `recurrent` int(255) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=239 ;

--
-- Дамп данных таблицы `APPOINTMENTS`
--

INSERT INTO `APPOINTMENTS` (`id`, `user_id`, `room_id`, `start_time_ms`, `end_time_ms`, `recurrent`, `description`) VALUES
(222, '9', '1', 1429513200000, 1429515000000, 222, ''),
(223, '9', '1', 1430118000000, 1430119800000, 222, ''),
(224, '9', '1', 1430722800000, 1430724600000, 222, ''),
(225, '9', '1', 1431327600000, 1431329400000, 222, ''),
(226, '9', '1', 1431932400000, 1431934200000, 222, ''),
(227, '9', '1', 1429563600000, 1429608600000, 227, ''),
(228, '9', '1', 1430773200000, 1430818200000, 227, ''),
(229, '9', '2', 1429513200000, 1429515000000, 0, ''),
(230, '9', '3', 1429513200000, 1429515000000, 0, ''),
(231, '9', '3', 1429563600000, 1429608600000, 231, ''),
(232, '9', '3', 1430168400000, 1430213400000, 231, ''),
(233, '9', '3', 1430773200000, 1430818200000, 231, ''),
(234, '9', '1', 1429527600000, 1429536600000, 0, ''),
(235, '3', '1', 1429650000000, 1429651800000, 0, ''),
(236, '9', '1', 1429686000000, 1429705800000, 0, ''),
(237, '3', '1', 1430881200000, 1430904600000, 237, ''),
(238, '3', '1', 1432090800000, 1432114200000, 237, '');

-- --------------------------------------------------------

--
-- Структура таблицы `EMPLOYEES`
--

CREATE TABLE IF NOT EXISTS `EMPLOYEES` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_pass` varchar(255) NOT NULL,
  `user_mail` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Дамп данных таблицы `EMPLOYEES`
--

INSERT INTO `EMPLOYEES` (`user_id`, `role`, `user_name`, `user_pass`, `user_mail`) VALUES
(3, '', 'user2', '2222', 'user2@mail.ru'),
(9, '', 'user1', '1111', 'user1@mail.ru'),
(777, 'admin', 'boss', 'boss', 'boss@mail.ru');

-- --------------------------------------------------------

--
-- Структура таблицы `rooms`
--

CREATE TABLE IF NOT EXISTS `rooms` (
  `room_id` int(11) NOT NULL AUTO_INCREMENT,
  `room_name` varchar(255) NOT NULL,
  PRIMARY KEY (`room_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `rooms`
--

INSERT INTO `rooms` (`room_id`, `room_name`) VALUES
(1, 'BoardRoom1'),
(2, 'BoardRoom2'),
(3, 'BoardRoom3');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
