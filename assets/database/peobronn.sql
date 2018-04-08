-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2018 at 04:29 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `peobronn`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_visit` (IN `in_ip` VARCHAR(64), IN `in_browser_name` VARCHAR(128), IN `in_browser_version` VARCHAR(64), IN `in_country` VARCHAR(128))  NO SQL
BEGIN
    INSERT INTO visit(ip, browser_name, browser_version, country) values (in_ip, in_browser_name, in_browser_version, in_country);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `kustuta_broneering` (IN `in_id` INT(11))  NO SQL
BEGIN
	DELETE FROM broneering WHERE id=in_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sisesta_broneering` (IN `in_email` VARCHAR(255), IN `in_pakett` ENUM('Pakett 1','Pakett 2'), IN `in_kellaaeg` ENUM('10:00 - 11:00','11:00 - 12:00','12:00 - 13:00','13:00 - 14:00','14:00 - 15:00','15:00 - 16:00','16:00 - 17:00','17:00 - 18:00','18:00 - 19:00'), IN `in_kuupäev` DATE)  NO SQL
BEGIN
	DECLARE v_kasutaja_id INT(11);
    SELECT id INTO v_kasutaja_id FROM kasutaja WHERE email=in_email;
    INSERT INTO broneering(kasutaja_id, pakett, kellaaeg, kuupäev) values (v_kasutaja_id, in_pakett, in_kellaaeg, in_kuupäev);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sisesta_kasutaja` (IN `in_email` VARCHAR(255), IN `in_eesnimi` VARCHAR(100), IN `in_perenimi` VARCHAR(100), IN `in_liik` ENUM('TAVALINE','GOOGLE','ID-KAART'), IN `in_salasõna` VARCHAR(255))  BEGIN
    INSERT INTO kasutaja(email, eesnimi, perenimi, liik, salasõna) values (in_email, in_eesnimi, in_perenimi, in_liik, in_salasõna);
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `broneering`
--

CREATE TABLE `broneering` (
  `id` int(11) NOT NULL,
  `kasutaja_id` int(11) NOT NULL,
  `pakett` enum('Pakett 1','Pakett 2') NOT NULL,
  `kellaaeg` enum('10:00 - 11:00','11:00 - 12:00','12:00 - 13:00','13:00 - 14:00','14:00 - 15:00','15:00 - 16:00','16:00 - 17:00','17:00 - 18:00','18:00 - 19:00') NOT NULL,
  `kuupäev` date NOT NULL,
  `broneerimise_aeg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `game`
--

CREATE TABLE `game` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(1023) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `game`
--

INSERT INTO `game` (`id`, `title`, `description`, `image`) VALUES
(1, 'Serious Sam VR: The First Encounter', 'Vanakooli shooter nüüd VR-is. Tunne end Sam-ina ja päästa maailm.', 'serioussam.jpg'),
(2, 'Space Pirate Trainer', 'Ole kosmosepiraat. Vali relvad, pane end valmis ja võitle end parimate hulka!', 'spacepirate.jpg'),
(3, 'Superhot', 'First person shooter, kus mäng liigub aind siis edasi kui Sa ise liigud. Vaata kaugele jõuad.', 'supahot.png'),
(4, 'theBlu', 'Sukeldu ookeani sügavustesse ja saa unustamatu seiklus.', 'theblu.jpg'),
(5, 'Robo Recall', 'Kehasta agenti, kelle ülesanne on rikki läinud robotid tagasi tuua.', 'roborecall.png'),
(6, 'Resident Evil VII', 'Resident Evil on tagasi ja hirmsaim kui enne.', 'REVII.jpg'),
(7, 'Rec Room', 'Võimalus suhelda virtuaalmaailmas teiste inimestega. Mängida nendega tennist, paintballi ja muid mänge!', 'recroom.jpg'),
(8, 'Ice Lakes', 'Moodne kalapüügisimulaator, kus saab õppida tundma kalade käitumist seoses aastaaegade ja ilmaga.', 'icelakes.png'),
(9, 'Arizona Sunshine', 'Zombie Apocalypse VR-s. Jookse ise reaalselt ringi apokalüptilises maailmas ja jää ellu.', 'arizonasun.jpg'),
(10, 'Hover Junkers', 'Ehita endale oma hõljukloss. Põikle vastaste kuulide eest ja võitle ellujäämise nimel.', 'hoverjunk.png'),
(11, 'Dirt Rally', 'Dirt Rally', 'dirt.jpg'),
(12, 'Fruit Ninja VR', 'Sama hea vana Fruit Ninja ainult, et VR-s!', 'fruitn.jpg'),
(13, 'Farlands', 'Mine uurimismissioonile väikese tulnukate planeedile.', 'farlands.png'),
(14, 'Nvidia Funhouse', 'Virtuaalne karnevali/lõbustuspargi külastus koos erinevate mängudega.', 'funhouse.jpg'),
(15, 'Tilt Brush', 'Avasta oma kunstianne uuesti virtuaalmaailmas. Võimalus väljendada oma mõtteid mitmel viisil.', 'tilt.png'),
(16, 'Raw Data', 'Võitle tulevikus maailma omava korporatsiooni vastu. Pane end proovile robotite vastu.', 'rawdata.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `kasutaja`
--

CREATE TABLE `kasutaja` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `eesnimi` varchar(100) NOT NULL,
  `perenimi` varchar(100) NOT NULL,
  `liik` enum('TAVALINE','GOOGLE','SMART-ID') NOT NULL,
  `salasõna` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_broneering`
-- (See below for the actual view)
--
CREATE TABLE `view_broneering` (
`id` int(11)
,`kasutaja_id` int(11)
,`pakett` enum('Pakett 1','Pakett 2')
,`kellaaeg` enum('10:00 - 11:00','11:00 - 12:00','12:00 - 13:00','13:00 - 14:00','14:00 - 15:00','15:00 - 16:00','16:00 - 17:00','17:00 - 18:00','18:00 - 19:00')
,`kuupäev` date
,`broneerimise_aeg` timestamp
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_game`
-- (See below for the actual view)
--
CREATE TABLE `view_game` (
`id` int(11)
,`title` varchar(255)
,`description` varchar(1023)
,`image` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_kasutaja`
-- (See below for the actual view)
--
CREATE TABLE `view_kasutaja` (
`id` int(11)
,`email` varchar(255)
,`eesnimi` varchar(100)
,`perenimi` varchar(100)
,`liik` enum('TAVALINE','GOOGLE','SMART-ID')
,`salasõna` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_visit`
-- (See below for the actual view)
--
CREATE TABLE `view_visit` (
`id` int(11)
,`time` timestamp
,`ip` varchar(64)
,`browser_name` varchar(128)
,`browser_version` varchar(64)
,`country` varchar(128)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_visit_browsers`
-- (See below for the actual view)
--
CREATE TABLE `view_visit_browsers` (
`browser_name` varchar(128)
,`count` bigint(21)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_visit_countries`
-- (See below for the actual view)
--
CREATE TABLE `view_visit_countries` (
`country` varchar(128)
,`count` bigint(21)
);

-- --------------------------------------------------------

--
-- Table structure for table `visit`
--

CREATE TABLE `visit` (
  `id` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ip` varchar(64) NOT NULL,
  `browser_name` varchar(128) NOT NULL,
  `browser_version` varchar(64) NOT NULL,
  `country` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `visit`
--

INSERT INTO `visit` (`id`, `time`, `ip`, `browser_name`, `browser_version`, `country`) VALUES
(23, '2018-04-02 15:54:36', '::1', 'Firefox', '59.0', NULL),
(24, '2018-04-02 15:59:50', '::1', 'Chrome', '65.0.3325.181', 'Estonia'),
(25, '2018-04-02 16:00:01', '::1', 'Chrome', '65.0.3325.181', 'Estonia'),
(26, '2018-04-05 09:41:32', '::1', 'Chrome', '65.0.3325.181', NULL);

-- --------------------------------------------------------

--
-- Structure for view `view_broneering`
--
DROP TABLE IF EXISTS `view_broneering`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_broneering`  AS  select `broneering`.`id` AS `id`,`broneering`.`kasutaja_id` AS `kasutaja_id`,`broneering`.`pakett` AS `pakett`,`broneering`.`kellaaeg` AS `kellaaeg`,`broneering`.`kuupäev` AS `kuupäev`,`broneering`.`broneerimise_aeg` AS `broneerimise_aeg` from `broneering` ;

-- --------------------------------------------------------

--
-- Structure for view `view_game`
--
DROP TABLE IF EXISTS `view_game`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_game`  AS  select `game`.`id` AS `id`,`game`.`title` AS `title`,`game`.`description` AS `description`,`game`.`image` AS `image` from `game` ;

-- --------------------------------------------------------

--
-- Structure for view `view_kasutaja`
--
DROP TABLE IF EXISTS `view_kasutaja`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_kasutaja`  AS  select `kasutaja`.`id` AS `id`,`kasutaja`.`email` AS `email`,`kasutaja`.`eesnimi` AS `eesnimi`,`kasutaja`.`perenimi` AS `perenimi`,`kasutaja`.`liik` AS `liik`,`kasutaja`.`salasõna` AS `salasõna` from `kasutaja` ;

-- --------------------------------------------------------

--
-- Structure for view `view_visit`
--
DROP TABLE IF EXISTS `view_visit`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_visit`  AS  select `visit`.`id` AS `id`,`visit`.`time` AS `time`,`visit`.`ip` AS `ip`,`visit`.`browser_name` AS `browser_name`,`visit`.`browser_version` AS `browser_version`,`visit`.`country` AS `country` from `visit` ;

-- --------------------------------------------------------

--
-- Structure for view `view_visit_browsers`
--
DROP TABLE IF EXISTS `view_visit_browsers`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_visit_browsers`  AS  select `visit`.`browser_name` AS `browser_name`,count(`visit`.`browser_name`) AS `count` from `visit` group by `visit`.`browser_name` ;

-- --------------------------------------------------------

--
-- Structure for view `view_visit_countries`
--
DROP TABLE IF EXISTS `view_visit_countries`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_visit_countries`  AS  select `visit`.`country` AS `country`,count(`visit`.`country`) AS `count` from `visit` group by `visit`.`country` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `broneering`
--
ALTER TABLE `broneering`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_kuupäev_kellaaeg` (`kellaaeg`,`kuupäev`),
  ADD KEY `kasutaja_id` (`kasutaja_id`);

--
-- Indexes for table `game`
--
ALTER TABLE `game`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kasutaja`
--
ALTER TABLE `kasutaja`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `visit`
--
ALTER TABLE `visit`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `broneering`
--
ALTER TABLE `broneering`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `game`
--
ALTER TABLE `game`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `kasutaja`
--
ALTER TABLE `kasutaja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `visit`
--
ALTER TABLE `visit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `broneering`
--
ALTER TABLE `broneering`
  ADD CONSTRAINT `broneering_to_kasutaja_fk` FOREIGN KEY (`kasutaja_id`) REFERENCES `kasutaja` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
