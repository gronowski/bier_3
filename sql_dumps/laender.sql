-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 20. Mrz 2015 um 15:49
-- Server Version: 5.6.16
-- PHP-Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `lars`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `laender`
--

CREATE TABLE IF NOT EXISTS `laender` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `land` varchar(50) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=20 ;

--
-- Daten für Tabelle `laender`
--

INSERT INTO `laender` (`id`, `land`) VALUES
(1, 'Schweiz'),
(2, 'Deutschland'),
(3, 'Oesterreich'),
(4, 'Frankreich'),
(5, 'Belgien'),
(6, 'Tschechien'),
(7, 'Argentinien'),
(8, 'Irland'),
(9, 'Italien'),
(10, 'Kanada'),
(11, 'Mexiko'),
(12, 'Niederlande'),
(13, 'Norwegen'),
(14, 'Portugal'),
(15, 'Schottland'),
(16, 'Spanien'),
(17, 'USA'),
(18, 'Australien'),
(19, 'England');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
