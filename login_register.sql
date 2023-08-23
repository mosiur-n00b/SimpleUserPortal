-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 23, 2023 at 11:41 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `login_register`
--

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `email`, `password`) VALUES
(1, 'mosiur.n00b@gmail.com', 'password'),
(2, 'mosiur.n00b@gmail.com', 'ihyfdgithtig3r'),
(3, 'thechotomasum@gmail.com', '$2y$10$E8COls1.76oS/ZOwu0KmDOpVWbnNL7JmIJh3HfAT/k7uVHiTZTdg6');

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `id` int(11) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `birthdate` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`id`, `firstName`, `lastName`, `address`, `phone`, `email`, `birthdate`, `password`) VALUES
(1, 'mosiur', 'rahman', 'Dhaka, BD', '01860483115', 'mosiur.n00b@gmail.com', '2023-08-10', '$2y$10$sOpW3B.EY8nuE8eEX2ujzuTayhMgpcGFVd0kzgI65wwT6i58Our9S'),
(2, 'mosiur', 'rahman', 'Dhaka, BD', '01860483115', 'thechotomasum@gmail.com', '2023-08-08', '$2y$10$PT/.c.uDaDkabgmHQ0smm.tSmwHdxzPBUwc7lNmewnH0Kkwg0pz46'),
(3, 'mosiur', 'rahman', 'Dhaka, BD', '01815429701', 'mrmbd93@gmail.com', '2023-08-16', '$2y$10$nOHwMmsCImmXUcmlDFNiJusIWom/XbfQJ4aDqmKRsti/ZjaJki1Bi'),
(4, 'mosiur', 'rahman', 'Dhaka, BD', '01860483115', 'admin@gmail.com', '2023-08-09', '$2y$10$HsPzgGDHtnnhepOG7laQT.IpfNrXn8TlozjjwbgBgaodFvKL1QBeO'),
(5, 'mosiur', 'rahman', 'Dhaka, BD', '01860483115', 'mosiur@gmail.com', '1997-09-18', '$2y$10$VrWAKaOVm/zDt.gbcUMbU.YMPgJcrPRhmeR6VRgLUDVBKFFsUyDEq'),
(6, 'dipak', 'roy', 'Chittagong, BD', '01815429701', 'dipakroy@yahoo.com', '2000-05-09', '$2y$10$yL2EbUjMrdLKrXcB7XwIMezM1kpOndgFmcYVddU6EJPH6Fwafg60G'),
(7, 'kallu', 'lallu', 'lukaku', '01815429687', 'lukaku@yahoo.com', '1966-06-07', '$2y$10$TWQbWf99IzNruF0alHjFUurdHfAxKhg5B9H2u3/SZHUyWZwYaQ9NC');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
