-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 18.03.2022 klo 10:46
-- Palvelimen versio: 10.4.22-MariaDB
-- PHP Version: 8.1.2
SET
  SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET
  time_zone = "+00:00";
  /*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
  /*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
  /*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
  /*!40101 SET NAMES utf8mb4 */;
--
  -- Database: `imdbtesti`
  --
  -- --------------------------------------------------------
  --
  -- Rakenne taululle `arvostelut`
  --
  CREATE TABLE `arvostelut` (
    `elokuva_id` int(11) NOT NULL,
    `arvostelija` varchar(255) DEFAULT NULL,
    `tahdet` int(11) NOT NULL,
    `kommentti` varchar(255) DEFAULT NULL
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
--
  -- Vedos taulusta `arvostelut`
  --
INSERT INTO
  `arvostelut` (
    `elokuva_id`,
    `arvostelija`,
    `tahdet`,
    `kommentti`
  )
VALUES
  (1, 'Saku', 3, 'Hui pelotti ihan viitust');
-- --------------------------------------------------------
  --
  -- Rakenne taululle `elokuvat`
  --
  CREATE TABLE `elokuvat` (
    `elokuva_id` int(11) NOT NULL,
    `elokuva_nimi` varchar(255) NOT NULL,
    `elokuva_tulovuosi` int DEFAULT NULL,
    `elokuva_kesto` int(11) DEFAULT NULL,
    `elokuva_kieli` varchar(255) DEFAULT NULL,
    `ohjaaja_id` int(11) DEFAULT NULL,
    `ikaraja` int(11) NOT NULL
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
--
  -- Vedos taulusta `elokuvat`
  --
INSERT INTO
  `elokuvat` (
    `elokuva_id`,
    `elokuva_nimi`,
    `elokuva_tulovuosi`,
    `elokuva_kesto`,
    `elokuva_kieli`,
    `ohjaaja_id`,
    `ikaraja`
  )
VALUES
  (1, 'IT', 2017, 135, 'Englanti', 1, 16);
-- --------------------------------------------------------
  --
  -- Rakenne taululle `elokuva_genret`
  --
  CREATE TABLE `elokuva_genret` (
    `elokuva_id` int(11) NOT NULL,
    `gen_id` int(11) NOT NULL
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
--
  -- Vedos taulusta `elokuva_genret`
  --
INSERT INTO
  `elokuva_genret` (`elokuva_id`, `gen_id`)
VALUES
  (1, 1);
-- --------------------------------------------------------
  --
  -- Rakenne taululle `genret`
  --
  CREATE TABLE `genret` (
    `gen_id` int(11) NOT NULL,
    `gen_nimi` varchar(20) NOT NULL
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
--
  -- Vedos taulusta `genret`
  --
INSERT INTO
  `genret` (`gen_id`, `gen_nimi`)
VALUES
  (1, 'kauhu');
-- --------------------------------------------------------
  --
  -- Rakenne taululle `nayttelija`
  --
  CREATE TABLE `nayttelija` (
    `nayttelija_id` int(11) NOT NULL,
    `nayttelija_enimi` varchar(255) NOT NULL,
    `nayttelija_snimi` varchar(255) NOT NULL,
    `nayttelija_sex` varchar(2) NOT NULL
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
--
  -- Vedos taulusta `nayttelija`
  --
INSERT INTO
  `nayttelija` (
    `nayttelija_id`,
    `nayttelija_enimi`,
    `nayttelija_snimi`,
    `nayttelija_sex`
  )
VALUES
  (1, 'Bill', 'Skarsgard', 'M'),
  (2, 'Jaeden', 'Martell', 'M'),
  (3, 'Sophia', 'Lillis', 'N'),
  (4, 'Finn', 'Wolfhard', 'M');
-- --------------------------------------------------------
  --
  -- Rakenne taululle `nayttelijat`
  --
  CREATE TABLE `nayttelijat` (
    `nayttelija_id` int(11) NOT NULL,
    `elokuva_id` int(11) NOT NULL,
    `rooli` varchar(30) DEFAULT NULL
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
--
  -- Vedos taulusta `nayttelijat`
  --
INSERT INTO
  `nayttelijat` (`nayttelija_id`, `elokuva_id`, `rooli`)
VALUES
  (1, 1, 'Pennywise'),
  (2, 1, 'Bill Denbrough'),
  (3, 1, 'Beverly Marsh'),
  (4, 1, 'Richie Tozier');
-- --------------------------------------------------------
  --
  -- Rakenne taululle `ohjaaja`
  --
  CREATE TABLE `ohjaaja` (
    `ohjaaja_id` int(11) NOT NULL,
    `ohjaaja_enimi` varchar(255) DEFAULT NULL,
    `ohjaaja_snimi` varchar(255) DEFAULT NULL
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
--
  -- Vedos taulusta `ohjaaja`
  --
INSERT INTO
  `ohjaaja` (`ohjaaja_id`, `ohjaaja_enimi`, `ohjaaja_snimi`)
VALUES
  (1, 'Andy', 'Muschietti');
--
  -- Indexes for dumped tables
  --
  --
  -- Indexes for table `arvostelut`
  --
ALTER TABLE
  `arvostelut`
ADD
  KEY `elokuva_id` (`elokuva_id`);
--
  -- Indexes for table `elokuvat`
  --
ALTER TABLE
  `elokuvat`
ADD
  PRIMARY KEY (`elokuva_id`),
ADD
  KEY `ohjaaja_id` (`ohjaaja_id`);
--
  -- Indexes for table `elokuva_genret`
  --
ALTER TABLE
  `elokuva_genret`
ADD
  KEY `elokuva_id` (`elokuva_id`),
ADD
  KEY `gen_id` (`gen_id`);
--
  -- Indexes for table `genret`
  --
ALTER TABLE
  `genret`
ADD
  PRIMARY KEY (`gen_id`);
--
  -- Indexes for table `nayttelija`
  --
ALTER TABLE
  `nayttelija`
ADD
  PRIMARY KEY (`nayttelija_id`);
--
  -- Indexes for table `nayttelijat`
  --
ALTER TABLE
  `nayttelijat`
ADD
  KEY `nayttelija_id` (`nayttelija_id`);
--
  -- Indexes for table `ohjaaja`
  --
ALTER TABLE
  `ohjaaja`
ADD
  PRIMARY KEY (`ohjaaja_id`);
--
  -- AUTO_INCREMENT for dumped tables
  --
  --
  -- AUTO_INCREMENT for table `elokuvat`
  --
ALTER TABLE
  `elokuvat`
MODIFY
  `elokuva_id` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 2;
--
  -- AUTO_INCREMENT for table `genret`
  --
ALTER TABLE
  `genret`
MODIFY
  `gen_id` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 2;
--
  -- AUTO_INCREMENT for table `nayttelija`
  --
ALTER TABLE
  `nayttelija`
MODIFY
  `nayttelija_id` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 5;
--
  -- AUTO_INCREMENT for table `ohjaaja`
  --
ALTER TABLE
  `ohjaaja`
MODIFY
  `ohjaaja_id` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 2;
--
  -- Rajoitteet vedostauluille
  --
  --
  -- Rajoitteet taululle `arvostelut`
  --
ALTER TABLE
  `arvostelut`
ADD
  CONSTRAINT `arvostelut_ibfk_1` FOREIGN KEY (`elokuva_id`) REFERENCES `elokuvat` (`elokuva_id`);
--
  -- Rajoitteet taululle `elokuvat`
  --
ALTER TABLE
  `elokuvat`
ADD
  CONSTRAINT `elokuvat_ibfk_1` FOREIGN KEY (`ohjaaja_id`) REFERENCES `ohjaaja` (`ohjaaja_id`);
--
  -- Rajoitteet taululle `elokuva_genret`
  --
ALTER TABLE
  `elokuva_genret`
ADD
  CONSTRAINT `elokuva_genret_ibfk_1` FOREIGN KEY (`elokuva_id`) REFERENCES `elokuvat` (`elokuva_id`),
ADD
  CONSTRAINT `elokuva_genret_ibfk_2` FOREIGN KEY (`gen_id`) REFERENCES `genret` (`gen_id`);
--
  -- Rajoitteet taululle `nayttelijat`
  --
ALTER TABLE
  `nayttelijat`
ADD
  CONSTRAINT `nayttelijat_ibfk_1` FOREIGN KEY (`nayttelija_id`) REFERENCES `nayttelija` (`nayttelija_id`);
COMMIT;
  /*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
  /*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
  /*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;