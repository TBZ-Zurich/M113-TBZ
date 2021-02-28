-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 21. Feb 2017 um 22:31
-- Server Version: 5.6.16
-- PHP-Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `test`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `artikel`
--

CREATE TABLE IF NOT EXISTS `artikel` (
  `nr` int(11) NOT NULL AUTO_INCREMENT,
  `titel` char(255) DEFAULT NULL,
  `inhalt` text,
  PRIMARY KEY (`nr`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Daten für Tabelle `artikel`
--

INSERT INTO `artikel` (`nr`, `titel`, `inhalt`) VALUES
(1, 'titel1', 'das ist text'),
(2, 'titel 2', 'das ist text von inhalt 2'),
(4, 'titel 5', 'text 6'),
(6, 'Dominik Albert', 'Waldvogel '),
(5, 'handschuhe', 'das sind neue Handschuhe'),
(7, 'Artikel 2', 'ddddd'),
(8, 'ddddd', 'ffff'),
(9, '123www', 'dassqq'),
(10, '', '');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `artikel1`
--

CREATE TABLE IF NOT EXISTS `artikel1` (
  `nr` int(11) NOT NULL AUTO_INCREMENT,
  `titel` varchar(255) DEFAULT NULL,
  `artnr` int(11) DEFAULT NULL,
  `preis` decimal(10,2) DEFAULT NULL,
  `inhalt` text,
  PRIMARY KEY (`nr`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Daten für Tabelle `artikel1`
--

INSERT INTO `artikel1` (`nr`, `titel`, `artnr`, `preis`, `inhalt`) VALUES
(1, 'swa', 123, '120.00', 'Abc1234'),
(2, 'test', 12334, '100.00', 'Abc123'),
(3, 'Telefon', 1234, '120.00', 'Abc123'),
(4, 'Titel56', 56, '250.00', 'Abc123'),
(5, 'tttt', 666666, '78.00', 'das'),
(6, 'testli', 9966696, '45.00', 'das ist ein Versuch'),
(7, 'Titel', 123, '50.00', '55'),
(8, 'tt', 11, '45.00', 'tes');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `artikel2`
--

CREATE TABLE IF NOT EXISTS `artikel2` (
  `nr` int(11) NOT NULL AUTO_INCREMENT,
  `titel` varchar(255) DEFAULT NULL,
  `artnr` int(11) DEFAULT NULL,
  `preis` decimal(10,2) DEFAULT NULL,
  `inhalt` text,
  `kat` int(11) DEFAULT NULL,
  PRIMARY KEY (`nr`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Daten für Tabelle `artikel2`
--

INSERT INTO `artikel2` (`nr`, `titel`, `artnr`, `preis`, `inhalt`, `kat`) VALUES
(1, 'Tittel12', 123, '100.00', 'guten TAg', NULL),
(2, 'neunen Artikel', 124, '100.00', 'das ist ein neuer Artikel', NULL),
(3, 'Titel', 12, '45.00', 'ddd', 3),
(4, 'Titel', 1222, '45.00', 'Text', 1),
(5, '', 0, '0.00', '', 1),
(6, '', 0, '0.00', '', 1),
(7, 'Titel', 111, '45.00', 'test', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
