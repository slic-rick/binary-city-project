-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2024 at 11:01 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `binarycity`
--

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `clientcode` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id`, `name`, `clientcode`) VALUES
(1, 'Testing', ''),
(2, 'Ericks', 'AAA001'),
(3, 'Erickson', 'ERI001'),
(4, 'Abraham', 'ABR001'),
(5, 'Binary', 'BIN001'),
(6, 'Binary', 'BIN002'),
(7, 'Stixcondse', 'STI001'),
(8, 'Stixcondse', 'STI002'),
(9, 'Erorred', 'ERO001'),
(10, 'Binary', 'BIN003'),
(11, 'WorkMan', 'WOR001'),
(12, 'News', 'NEW001'),
(13, 'Testo', 'TES001'),
(14, 'sfsdfcd', 'SFS001'),
(15, 'Yayaye', 'YAY001'),
(16, 'PUTIN', 'PUT001'),
(17, 'Itula', 'ITU001'),
(18, 'Gitty', 'GIT001'),
(19, 'Clinets', 'CLI001'),
(20, 'NANASA', 'NAN001'),
(21, 'sfhfdsjfsdf', 'SFH001'),
(22, 'Eyakulo', 'EYA001');

-- --------------------------------------------------------

--
-- Table structure for table `clientlinkcontact`
--

CREATE TABLE `clientlinkcontact` (
  `clientId` varchar(255) NOT NULL,
  `contactId` varchar(255) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clientlinkcontact`
--

INSERT INTO `clientlinkcontact` (`clientId`, `contactId`, `id`) VALUES
('fewfbhsmdfbuyefs', '1', 1),
('0', '1', 2),
('0', '1', 3),
('0', '1', 4),
('0', '1', 5),
('0', '1', 6),
('0', '1', 7),
('0', '1', 8),
('0', '1', 9),
('0', '1', 10),
('0', '1', 11),
('0', '1', 12),
('0', '1', 13),
('0', '1', 14),
('0', '1', 15),
('0', '1', 16),
('1', '0', 17),
('9', '0', 18),
('2', '0', 19),
('4', '0', 20),
('2', '0', 21),
('4', '0', 22),
('2', '0', 23),
('7', '0', 24),
('9', '0', 25),
('2', '0', 26),
('7', '0', 27),
('9', '0', 28),
('2', '0', 29),
('7', '0', 30),
('9', '0', 31),
('2', '0', 32),
('7', '0', 33),
('9', '0', 34),
('2', '0', 35),
('7', '0', 36),
('9', '0', 37),
('2', '0', 38),
('7', '0', 39),
('9', '0', 40),
('2', '0', 41),
('7', '0', 42),
('9', '0', 43),
('0', '1', 44),
('2', '0', 45),
('3', '0', 46),
('2', '0', 47),
('7', '0', 48),
('2', '0', 49);

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`name`, `surname`, `email`, `id`) VALUES
('Nghiino', 'Nambuwa', 'erickabraham63@gmail.com', 1),
('ericksd', 'abrsdfs', 'refdsfhj@gmail.com', 2),
('TIKO', 'bukwane', 'ereicsds@mail.com', 3),
('TIKO', 'bukwane', 'ereicsds@mail.com', 4),
('TIKO', 'bukwane', 'ereicsds@mail.com', 5),
('TIKO', 'bukwane', 'ereicsds@mail.com', 6),
('TIKO', 'bukwane', 'ereicsds@mail.com', 7),
('TIKO', 'bukwane', 'ereicsds@mail.com', 8),
('TIKO', 'bukwane', 'ereicsds@mail.com', 9),
('TIKO', 'bukwane', 'ereicsds@mail.com', 10),
('fssd', 'ewds', 'ewfaasfewf', 11),
('Omulong', 'dsfddaad', 'safega', 12);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `clientcode` (`clientcode`);

--
-- Indexes for table `clientlinkcontact`
--
ALTER TABLE `clientlinkcontact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `clientlinkcontact`
--
ALTER TABLE `clientlinkcontact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
