-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 30, 2020 at 02:40 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blue-mountain`
--
CREATE DATABASE IF NOT EXISTS `blue-mountain` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `blue-mountain`;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
CREATE TABLE `projects` (
  `pro_id` int(11) NOT NULL,
  `pro_name` varchar(50) NOT NULL,
  `pro_country` varchar(50) NOT NULL,
  `pro_region` varchar(50) NOT NULL,
  `pro_apdate` date NOT NULL,
  `pro_cdate` date NOT NULL,
  `pro_teamleader` varchar(50) NOT NULL,
  `pro_tpc` varchar(50) NOT NULL,
  `pro_ca` varchar(50) NOT NULL,
  `pro_lat` float(10,6) NOT NULL,
  `pro_lng` float(10,6) NOT NULL,
  `pro_note` varchar(512) NOT NULL,
  `pro_datentime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `pro_imgurl1` varchar(255) NOT NULL,
  `pro_imgurl2` varchar(255) NOT NULL,
  `pro_imgurl3` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `uid` int(11) NOT NULL,
  `ufname` varchar(50) NOT NULL,
  `ulname` varchar(50) NOT NULL,
  `uemail` varchar(255) NOT NULL,
  `upassword` varchar(255) NOT NULL,
  `utype` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`pro_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `pro_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
