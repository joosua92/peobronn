-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 26, 2018 at 07:19 PM
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

--
-- Dumping data for table `broneering`
--

INSERT INTO `broneering` (`id`, `kasutaja_id`, `pakett`, `kellaaeg`, `kuupäev`, `broneerimise_aeg`) VALUES
(1, 2, 'Pakett 2', '12:00 - 13:00', '2018-03-01', '2018-03-26 16:03:46');

-- --------------------------------------------------------

--
-- Table structure for table `kasutaja`
--

CREATE TABLE `kasutaja` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `eesnimi` varchar(100) NOT NULL,
  `perenimi` varchar(100) NOT NULL,
  `liik` enum('TAVALINE','GOOGLE','ID-KAART') NOT NULL,
  `salasõna` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kasutaja`
--

INSERT INTO `kasutaja` (`id`, `email`, `eesnimi`, `perenimi`, `liik`, `salasõna`) VALUES
(1, 'ergo.nigola@gmail.com', 'Ergo', 'Nigola', 'GOOGLE', ''),
(2, 'ergo@ergo.ee', 'ergo', 'ergo', 'TAVALINE', '$2y$10$GmO5yqWn2W7/hAycTOWENOzXLjokhEJwIDSZg5V86Col3cAvZ..ty');

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
-- Stand-in structure for view `view_kasutaja`
-- (See below for the actual view)
--
CREATE TABLE `view_kasutaja` (
`id` int(11)
,`email` varchar(255)
,`eesnimi` varchar(100)
,`perenimi` varchar(100)
,`liik` enum('TAVALINE','GOOGLE','ID-KAART')
,`salasõna` varchar(255)
);

-- --------------------------------------------------------

--
-- Structure for view `view_broneering`
--
DROP TABLE IF EXISTS `view_broneering`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_broneering`  AS  select `broneering`.`id` AS `id`,`broneering`.`kasutaja_id` AS `kasutaja_id`,`broneering`.`pakett` AS `pakett`,`broneering`.`kellaaeg` AS `kellaaeg`,`broneering`.`kuupäev` AS `kuupäev`,`broneering`.`broneerimise_aeg` AS `broneerimise_aeg` from `broneering` ;

-- --------------------------------------------------------

--
-- Structure for view `view_kasutaja`
--
DROP TABLE IF EXISTS `view_kasutaja`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_kasutaja`  AS  select `kasutaja`.`id` AS `id`,`kasutaja`.`email` AS `email`,`kasutaja`.`eesnimi` AS `eesnimi`,`kasutaja`.`perenimi` AS `perenimi`,`kasutaja`.`liik` AS `liik`,`kasutaja`.`salasõna` AS `salasõna` from `kasutaja` ;

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
-- Indexes for table `kasutaja`
--
ALTER TABLE `kasutaja`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `broneering`
--
ALTER TABLE `broneering`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kasutaja`
--
ALTER TABLE `kasutaja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
