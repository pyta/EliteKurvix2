-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Czas wygenerowania: 12 Gru 2012, 20:45
-- Wersja serwera: 5.5.24
-- Wersja PHP: 5.3.14

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza danych: `vollserv`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `arbiters`
--

CREATE TABLE IF NOT EXISTS `arbiters` (
  `ArbiterID` int(11) NOT NULL AUTO_INCREMENT,
  `ArbiterForname` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `ArbiterSurname` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `ArbiterBornDate` date NOT NULL,
  `UserID` int(11) NOT NULL,
  `ArbiterFoto` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `ArbiterPESELNumber` varchar(11) COLLATE utf8_polish_ci NOT NULL,
  PRIMARY KEY (`ArbiterID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=4 ;

--
-- Zrzut danych tabeli `arbiters`
--

INSERT INTO `arbiters` (`ArbiterID`, `ArbiterForname`, `ArbiterSurname`, `ArbiterBornDate`, `UserID`, `ArbiterFoto`, `ArbiterPESELNumber`) VALUES
(3, 'Jan', 'Burak', '1989-07-11', 0, '89071111562.jpg', '89071111562');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `CommentID` int(11) NOT NULL AUTO_INCREMENT,
  `UserID` int(11) NOT NULL,
  `CommentContent` varchar(200) COLLATE utf8_polish_ci NOT NULL,
  `CommentAddDate` datetime NOT NULL,
  `CommentType` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `SpecyficID` int(11) NOT NULL,
  PRIMARY KEY (`CommentID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `headdata`
--

CREATE TABLE IF NOT EXISTS `headdata` (
  `headDataID` int(11) NOT NULL AUTO_INCREMENT,
  `headDataContent` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  PRIMARY KEY (`headDataID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=3 ;

--
-- Zrzut danych tabeli `headdata`
--

INSERT INTO `headdata` (`headDataID`, `headDataContent`) VALUES
(1, '<link rel="stylesheet" type="text/css" href="style.css">'),
(2, '<script type="text/javascript" src="scripts.js"></script>');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `matchdetails`
--

CREATE TABLE IF NOT EXISTS `matchdetails` (
  `MatchID` int(11) NOT NULL,
  `PlayerID` int(11) NOT NULL,
  `Presence` tinyint(1) NOT NULL,
  `AtacksAttempt` tinyint(4) NOT NULL,
  `AtacksSuccessful` tinyint(4) NOT NULL,
  `BlockAttempt` tinyint(4) NOT NULL,
  `BlockSuccessful` tinyint(4) NOT NULL,
  `Aces` int(11) NOT NULL,
  PRIMARY KEY (`MatchID`,`PlayerID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `matches`
--

CREATE TABLE IF NOT EXISTS `matches` (
  `MatchID` int(11) NOT NULL AUTO_INCREMENT,
  `MatchDate` date NOT NULL,
  `TeamID_A` int(11) NOT NULL,
  `TeamID_B` int(11) NOT NULL,
  `TeamASetWin` tinyint(4) NOT NULL,
  `TeamBSetWin` tinyint(4) NOT NULL,
  `TeamASet1` tinyint(4) NOT NULL,
  `TeamBSet1` tinyint(4) NOT NULL,
  `TeamASet2` tinyint(4) NOT NULL,
  `TeamBSet2` tinyint(4) NOT NULL,
  `TeamASet3` tinyint(4) NOT NULL,
  `TeamBSet3` tinyint(4) NOT NULL,
  `TeamASet4` tinyint(4) DEFAULT NULL,
  `TeamBSet4` tinyint(4) DEFAULT NULL,
  `TeamASet5` tinyint(4) DEFAULT NULL,
  `TeamBSet5` tinyint(4) DEFAULT NULL,
  `PitchID` int(11) NOT NULL,
  `ArbiterID` int(11) NOT NULL,
  PRIMARY KEY (`MatchID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `NewsID` int(11) NOT NULL AUTO_INCREMENT,
  `UserID` int(11) NOT NULL,
  `NewsTitle` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `NewsContent` text COLLATE utf8_polish_ci NOT NULL,
  `NewsAddDate` datetime NOT NULL,
  PRIMARY KEY (`NewsID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=6 ;

--
-- Zrzut danych tabeli `news`
--

INSERT INTO `news` (`NewsID`, `UserID`, `NewsTitle`, `NewsContent`, `NewsAddDate`) VALUES
(4, 47, 'Jakiś nowy wpis.', '<p>\r\n	Siema! Nowy wpis tu jest.<br />\r\n	kon</p>\r\n', '2012-12-02 21:28:13'),
(5, 47, 'Jakiś nowy wpis.', '<p>\r\n	Treść inny wpis.</p>\r\n', '2012-12-02 21:30:08');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pitches`
--

CREATE TABLE IF NOT EXISTS `pitches` (
  `PitchID` int(11) NOT NULL AUTO_INCREMENT,
  `PitchName` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `PitchPicture` varchar(50) COLLATE utf8_polish_ci DEFAULT NULL,
  `PitchAbout` varchar(200) COLLATE utf8_polish_ci DEFAULT NULL,
  PRIMARY KEY (`PitchID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `players`
--

CREATE TABLE IF NOT EXISTS `players` (
  `PlayerID` int(11) NOT NULL AUTO_INCREMENT,
  `PlayerForname` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `PlayerSurname` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `PlayerBornDate` date NOT NULL,
  `PlayerHeight` int(11) NOT NULL,
  `PlayerWage` int(11) NOT NULL,
  `PlayerNumber` int(11) NOT NULL,
  `TeamID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `PlayerFoto` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `PlayerPESELNumber` varchar(11) COLLATE utf8_polish_ci NOT NULL,
  PRIMARY KEY (`PlayerID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ranktable`
--

CREATE TABLE IF NOT EXISTS `ranktable` (
  `TeamID` int(11) NOT NULL,
  `PointsNumber` int(11) NOT NULL,
  PRIMARY KEY (`TeamID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `start`
--

CREATE TABLE IF NOT EXISTS `start` (
  `StartID` int(11) NOT NULL AUTO_INCREMENT,
  `StartTitle` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `StartContent` varchar(200) COLLATE utf8_polish_ci NOT NULL,
  `StartSelected` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`StartID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=6 ;

--
-- Zrzut danych tabeli `start`
--

INSERT INTO `start` (`StartID`, `StartTitle`, `StartContent`, `StartSelected`) VALUES
(5, 'Witaj!', '<p>\r\n	Witaj na stronie poświęconej amatorskiej siatk&oacute;wce.<br />\r\n	Mam nadzieje, że znajdziesz tu coś co Cię zainteresuje.</p>\r\n', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `teams`
--

CREATE TABLE IF NOT EXISTS `teams` (
  `TeamID` int(11) NOT NULL AUTO_INCREMENT,
  `TeamName` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `TeamAddDate` datetime NOT NULL,
  `PlayerID` int(11) DEFAULT NULL,
  `TeamCode` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `TeamImage` varchar(50) COLLATE utf8_polish_ci DEFAULT NULL,
  `TeamLogo` varchar(50) COLLATE utf8_polish_ci DEFAULT NULL,
  PRIMARY KEY (`TeamID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=4 ;

--
-- Zrzut danych tabeli `teams`
--

INSERT INTO `teams` (`TeamID`, `TeamName`, `TeamAddDate`, `PlayerID`, `TeamCode`, `TeamImage`, `TeamLogo`) VALUES
(2, 'sdfsd', '2012-11-29 18:22:18', NULL, 'sdfsdf', 'sdfsd.jpg', 'sdfsdLogo.jpg'),
(3, 'TestowaDruzynaA', '2012-12-09 16:38:55', NULL, 'konpijepiwonaPolanie', 'TestowaDruzynaA.jpg', 'TestowaDruzynaALogo.jpg');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `timetable`
--

CREATE TABLE IF NOT EXISTS `timetable` (
  `TimetableID` int(11) NOT NULL AUTO_INCREMENT,
  `GameData` datetime NOT NULL,
  `TeamID_A` int(11) NOT NULL,
  `TeamID_B` int(11) NOT NULL,
  `PitchID` int(11) NOT NULL,
  PRIMARY KEY (`TimetableID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `UserID` int(11) NOT NULL AUTO_INCREMENT,
  `UserLogin` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `UserPass` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `UserForname` varchar(50) COLLATE utf8_polish_ci DEFAULT NULL,
  `UserSurname` varchar(50) COLLATE utf8_polish_ci DEFAULT NULL,
  `UserMail` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `UserBornDate` date DEFAULT NULL,
  `UserAddDate` datetime NOT NULL,
  `UserType` tinyint(4) NOT NULL,
  `UserAbout` varchar(200) COLLATE utf8_polish_ci DEFAULT NULL,
  `UserAvatar` varchar(50) COLLATE utf8_polish_ci DEFAULT NULL,
  `TeamID` int(11) DEFAULT NULL,
  PRIMARY KEY (`UserID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=49 ;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`UserID`, `UserLogin`, `UserPass`, `UserForname`, `UserSurname`, `UserMail`, `UserBornDate`, `UserAddDate`, `UserType`, `UserAbout`, `UserAvatar`, `TeamID`) VALUES
(47, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Piotr', 'Ciwiś', 'pyjter.c@gmail.com', '1989-03-21', '2012-11-09 17:33:39', 1, 'Nic ciekawego.', NULL, NULL),
(48, 'kon', 'e734dc5328d5a555de5f06c7c9459667', '', '', 'kon@kon.pl', '1989-03-21', '2012-11-10 16:24:56', 0, 'Kon pije piwo na polanie. Zawsze', NULL, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
