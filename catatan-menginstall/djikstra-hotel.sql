-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2022 at 07:58 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `djikstra-hotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `graph`
--

CREATE TABLE `graph` (
  `id` int(11) NOT NULL,
  `start` int(2) DEFAULT NULL,
  `end` int(2) DEFAULT NULL,
  `distance` decimal(10,2) DEFAULT NULL,
  `time` int(10) DEFAULT NULL,
  `diinsertPada` timestamp NULL DEFAULT current_timestamp(),
  `diupadtePada` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `graph`
--

INSERT INTO `graph` (`id`, `start`, `end`, `distance`, `time`, `diinsertPada`, `diupadtePada`) VALUES
(80, 406, 407, '1.64', 1411, '2021-08-12 10:40:48', '2021-08-13 12:20:03'),
(81, 407, 408, '0.36', 4, '2021-08-12 10:41:10', '2021-08-13 12:21:14'),
(82, 408, 410, '1.58', 5, '2021-08-12 10:41:19', '2021-08-13 12:21:17'),
(83, 410, 409, '0.73', 4, '2021-08-12 10:41:34', '2021-08-13 12:21:27'),
(84, 409, 413, '0.60', 3, '2021-08-12 10:41:45', '2021-08-13 12:21:25'),
(85, 406, 411, '0.47', 111, '2021-08-12 10:43:10', '2021-08-13 12:19:39'),
(86, 411, 412, '1.08', 1, '2021-08-12 10:43:18', '2021-08-13 12:21:09'),
(87, 412, 405, '1.02', 3, '2021-08-12 10:43:30', '2021-08-13 12:21:11'),
(88, 405, 422, '1.99', 33, '2021-08-12 10:43:38', '2021-08-13 12:21:31'),
(89, 408, 412, '0.70', 66, '2021-08-12 10:50:59', '2021-08-13 12:21:20'),
(90, 406, 410, '3.24', 12, '2021-08-13 12:17:52', NULL),
(91, 412, 413, '0.97', 15, '2021-08-14 09:20:28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `node`
--

CREATE TABLE `node` (
  `id` int(2) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `type` enum('object','-') DEFAULT NULL,
  `lat` varchar(255) DEFAULT NULL,
  `lng` varchar(255) DEFAULT NULL,
  `desc` text DEFAULT NULL,
  `picture` text DEFAULT NULL,
  `inserted_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `node`
--

INSERT INTO `node` (`id`, `name`, `type`, `lat`, `lng`, `desc`, `picture`, `inserted_at`, `updated_at`) VALUES
(405, 'Semeru', 'object', '-6.39925655614941', '106.81332186452494', 'Gunung Semeru atau Gunung Meru adalah sebuah gunung berapi kerucut di Jawa Timur, Indonesia. Gunung Semeru merupakan gunung tertinggi di Pulau Jawa, dengan puncaknya Mahameru, 3.676 meter dari permukaan laut', '0913da84afb03000b08e7a8be97998a0.jpg', '2021-08-06 13:32:03', '2021-08-12 11:24:24'),
(406, 'A', '-', '-6.37076692939587', '106.81376817991708', '-', '-', '2021-08-06 13:32:17', '2021-08-14 08:24:47'),
(407, 'B', '-', '-6.369231515298239', '106.79900530150132', '-', '-', '2021-08-06 13:32:24', NULL),
(408, 'C', '-', '-6.38032051377904', '106.79900530150132', '-', '-', '2021-08-06 13:32:32', NULL),
(409, 'D', '-', '-6.389703325061745', '106.79059389402033', '-', '-', '2021-08-06 13:32:39', NULL),
(410, 'E', '-', '-6.379467522412696', '106.78475740721541', '-', '-', '2021-08-06 13:32:54', NULL),
(411, 'A1', '-', '-6.385267835709172', '106.8141115026703', '-', '-', '2021-08-06 13:34:28', NULL),
(412, 'A2', '-', '-6.390897488716703', '106.80449846555297', '-', '-', '2021-08-06 13:34:37', NULL),

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `inserted_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `inserted_at`, `updated_at`) VALUES
(2, 'admin', 'admin', '2021-08-05 09:23:01', '2021-08-06 14:55:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `graph`
--
ALTER TABLE `graph`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `start` (`start`,`end`) USING BTREE,
  ADD KEY `simpulMulai` (`start`) USING BTREE,
  ADD KEY `simpulAkhir` (`end`) USING BTREE;

--
-- Indexes for table `node`
--
ALTER TABLE `node`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `graph`
--
ALTER TABLE `graph`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `node`
--
ALTER TABLE `node`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=425;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `graph`
--
ALTER TABLE `graph`
  ADD CONSTRAINT `graph_ibfk_1` FOREIGN KEY (`start`) REFERENCES `node` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `graph_ibfk_2` FOREIGN KEY (`end`) REFERENCES `node` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
