-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 16, 2022 at 10:01 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `binary_city_task_dec_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `id` int(10) NOT NULL,
  `client_code` varchar(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id`, `client_code`, `name`, `email`) VALUES
(14, 'Shu010', 'Rumbie Ruzivo', 'shupieruzivo@gmail.com'),
(19, 'Kud018', 'Kudzanai Madziva', 'kudzanaimadziva@gmail.com'),
(22, 'Kud021', 'Kudzie', 'kudziemadziva@gmail.com'),
(23, 'Kud022', 'Kudzai', 'kudzai@gmail.com'),
(24, 'Jus023', 'Justin Phiri', 'justinphiri@gmail.com'),
(25, 'Tsw024', 'TswanaSale', 'shupieruzivo@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `name`, `surname`, `email`) VALUES
(1, 'Kudzai', 'Madziva', 'kudziemadziva@gmail.com'),
(2, 'Tinashe', 'Joward', 'tj@gmail.com'),
(3, 'Kudzanai', 'Madziva', 'kudzanaimadziva@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `linked`
--

CREATE TABLE `linked` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `linked`
--

INSERT INTO `linked` (`id`, `client_id`, `contact_id`) VALUES
(1, 0, 1),
(2, 0, 1),
(3, 10, 1),
(4, 11, 0),
(5, 12, 0),
(6, 13, 0),
(7, 14, 0),
(8, 15, 0),
(9, 16, 0),
(10, 17, 1),
(11, 17, 4),
(12, 17, 1),
(13, 17, 6),
(14, 18, 0),
(15, 19, 1),
(16, 20, 1),
(17, 20, 2),
(18, 21, 1),
(19, 22, 0),
(20, 23, 1),
(21, 23, 2),
(22, 24, 0),
(23, 25, 2),
(24, 25, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `linked`
--
ALTER TABLE `linked`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `linked`
--
ALTER TABLE `linked`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
