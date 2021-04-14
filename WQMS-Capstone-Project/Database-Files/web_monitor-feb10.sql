-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 10, 2021 at 08:55 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web_monitor`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_inserts`
--

CREATE TABLE `data_inserts` (
  `ID` int(11) NOT NULL,
  `Value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_inserts`
--

INSERT INTO `data_inserts` (`ID`, `Value`) VALUES
(1, 'Temperature Values Inserted');

-- --------------------------------------------------------

--
-- Table structure for table `measure_flags`
--

CREATE TABLE `measure_flags` (
  `ID` int(11) NOT NULL,
  `Value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `measure_flags`
--

INSERT INTO `measure_flags` (`ID`, `Value`) VALUES
(1, 'NULL');

-- --------------------------------------------------------

--
-- Table structure for table `temperatures`
--

CREATE TABLE `temperatures` (
  `id` int(11) NOT NULL,
  `Celcius` int(11) NOT NULL,
  `Fahrenheit` int(11) NOT NULL,
  `Time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `temperatures`
--

INSERT INTO `temperatures` (`id`, `Celcius`, `Fahrenheit`, `Time`) VALUES
(1, 23, 73, '2021-02-07 01:22:55'),
(2, 23, 73, '2021-02-07 01:41:41'),
(3, 23, 73, '2021-02-07 01:42:37'),
(4, 28, 83, '2021-02-07 01:43:03'),
(5, 22, 72, '2021-02-07 22:28:48'),
(6, 22, 72, '2021-02-07 22:33:43'),
(7, 23, 73, '2021-02-07 22:44:39'),
(8, 23, 73, '2021-02-07 22:47:07'),
(9, 23, 73, '2021-02-07 22:47:33'),
(10, 22, 72, '2021-02-08 17:00:56'),
(11, 22, 72, '2021-02-08 17:01:35'),
(12, 22, 72, '2021-02-08 17:02:17'),
(13, 22, 72, '2021-02-08 17:03:15'),
(14, 22, 72, '2021-02-08 17:12:01'),
(15, 22, 72, '2021-02-08 17:12:23'),
(16, 22, 72, '2021-02-08 17:13:04'),
(17, 22, 72, '2021-02-08 17:15:35'),
(18, 22, 72, '2021-02-08 17:17:03'),
(19, 22, 72, '2021-02-08 17:19:50'),
(20, 22, 72, '2021-02-08 17:21:18'),
(21, 22, 72, '2021-02-08 17:25:16'),
(22, 22, 72, '2021-02-08 17:26:24'),
(23, 22, 72, '2021-02-08 17:27:05'),
(24, 19, 67, '2021-02-10 19:02:01'),
(25, 20, 67, '2021-02-10 19:02:40'),
(26, 20, 68, '2021-02-10 19:03:16'),
(27, 20, 68, '2021-02-10 19:04:46'),
(28, 20, 68, '2021-02-10 19:05:18'),
(29, 32, 89, '2021-02-10 19:06:22'),
(30, 30, 87, '2021-02-10 19:07:04'),
(31, 24, 75, '2021-02-10 19:09:25'),
(32, 23, 73, '2021-02-10 19:10:59'),
(33, 21, 69, '2021-02-10 19:19:44'),
(34, 21, 69, '2021-02-10 19:21:02'),
(35, 21, 69, '2021-02-10 19:21:45'),
(36, 21, 69, '2021-02-10 19:22:06'),
(37, 21, 69, '2021-02-10 19:26:27'),
(38, 21, 69, '2021-02-10 19:32:55'),
(39, 21, 69, '2021-02-10 19:33:26'),
(40, 21, 69, '2021-02-10 19:34:34'),
(41, 21, 69, '2021-02-10 19:40:13'),
(42, 21, 69, '2021-02-10 19:54:11');

-- --------------------------------------------------------

--
-- Table structure for table `turbidities`
--

CREATE TABLE `turbidities` (
  `id` int(11) NOT NULL,
  `Value` float NOT NULL,
  `Time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `turbidities`
--

INSERT INTO `turbidities` (`id`, `Value`, `Time`) VALUES
(1, 0, '2021-02-06 23:17:30'),
(2, 0, '2021-02-06 23:18:02'),
(3, 0, '2021-02-06 23:19:23'),
(4, 10, '2021-02-06 23:19:38'),
(5, 10, '2021-02-06 23:20:20'),
(6, 10, '2021-02-06 23:20:56'),
(7, 0, '2021-02-06 23:21:12'),
(8, 0, '2021-02-06 23:30:40'),
(9, 0, '2021-02-06 23:31:13'),
(10, 0, '2021-02-06 23:31:35'),
(11, 10, '2021-02-06 23:31:48'),
(12, 0, '2021-02-07 01:24:36'),
(13, 0, '2021-02-07 01:28:18'),
(14, 0, '2021-02-07 01:28:59'),
(15, 0, '2021-02-07 01:31:03'),
(16, 0, '2021-02-07 01:34:31'),
(17, 0, '2021-02-07 01:36:55'),
(18, 0, '2021-02-07 01:37:31'),
(19, 0, '2021-02-07 01:39:18'),
(20, 0, '2021-02-07 01:40:01'),
(21, 0, '2021-02-07 01:40:22'),
(22, 3.09, '2021-02-07 01:40:31'),
(23, 3.09, '2021-02-07 01:41:25'),
(24, 3.09, '2021-02-07 01:42:11'),
(25, 3.09, '2021-02-07 01:43:29'),
(26, 3.18, '2021-02-07 22:29:08'),
(27, 3.19, '2021-02-07 22:39:47'),
(28, 3.17, '2021-02-07 22:45:12'),
(29, 3.12, '2021-02-08 17:25:36'),
(30, 3.13, '2021-02-10 19:03:00'),
(31, 3.11, '2021-02-10 19:04:24'),
(32, 3.11, '2021-02-10 19:20:09'),
(33, 3.11, '2021-02-10 19:20:45'),
(34, 3.11, '2021-02-10 19:25:51');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`) VALUES
(1, 'Chris', 'chris@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055'),
(2, 'tilo', 'root', '202cb962ac59075b964b07152d234b70'),
(3, 'Nigin', 'nigin@gmail.com', 'e10adc3949ba59abbe56e057f20f883e');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_inserts`
--
ALTER TABLE `data_inserts`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `id` (`ID`);

--
-- Indexes for table `measure_flags`
--
ALTER TABLE `measure_flags`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `id` (`ID`);

--
-- Indexes for table `temperatures`
--
ALTER TABLE `temperatures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `turbidities`
--
ALTER TABLE `turbidities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_inserts`
--
ALTER TABLE `data_inserts`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `measure_flags`
--
ALTER TABLE `measure_flags`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `temperatures`
--
ALTER TABLE `temperatures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `turbidities`
--
ALTER TABLE `turbidities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
