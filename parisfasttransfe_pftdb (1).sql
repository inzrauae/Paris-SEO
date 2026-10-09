-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 27, 2026 at 11:21 AM
-- Server version: 11.4.13-MariaDB
-- PHP Version: 8.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `parisfasttransfe_pftdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `ref` varchar(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `pickup` varchar(255) DEFAULT NULL,
  `pickupaddr` varchar(255) DEFAULT NULL,
  `dropoff` varchar(255) DEFAULT NULL,
  `dropoffaddr` varchar(255) DEFAULT NULL,
  `trip` varchar(20) DEFAULT 'One Way',
  `pax` int(11) DEFAULT 1,
  `babyseat` varchar(50) DEFAULT NULL,
  `flight` varchar(50) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` varchar(20) DEFAULT NULL,
  `return_pickupaddr` varchar(255) DEFAULT NULL,
  `return_dropoff` varchar(255) DEFAULT NULL,
  `return_date` date DEFAULT NULL,
  `return_time` varchar(20) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT 0.00,
  `notes` text DEFAULT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'New',
  `emailSent` tinyint(1) DEFAULT 0,
  `created` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `ref`, `name`, `email`, `phone`, `pickup`, `pickupaddr`, `dropoff`, `dropoffaddr`, `trip`, `pax`, `babyseat`, `flight`, `date`, `time`, `return_pickupaddr`, `return_dropoff`, `return_date`, `return_time`, `price`, `notes`, `status`, `emailSent`, `created`) VALUES
(1, 'PFT-5271', 'testing 001', 'test1@gmail.com', '+9412345678', 'Paris', 'paris', 'Disneyland', 'disneyland', 'Return', 7, '1', 'test train', '2026-07-19', '01:30 AM', 'disneyland', 'paris', '2026-07-20', '12:45 PM', 220.00, 's', 'New', 0, '2026-07-09 16:45:20'),
(2, 'PFT-8159', 'test1', 'test1@gmail.com', '+941244566', 'Paris', 'paris', 'Disneyland', 'disneyland', 'Return', 5, '0', 'test 1', '2026-07-12', '12:15 PM', 'disneyland', 'paris', '2026-07-13', '12:30 PM', 210.00, 'test1', 'Confirmed', 0, '2026-07-10 05:12:45');

-- --------------------------------------------------------

--
-- Table structure for table `rates`
--

CREATE TABLE `rates` (
  `id` int(11) NOT NULL,
  `from_loc` varchar(50) NOT NULL,
  `to_loc` varchar(50) NOT NULL,
  `label` varchar(255) NOT NULL,
  `active` tinyint(1) DEFAULT 1,
  `prices` text DEFAULT NULL,
  `created` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rates`
--

INSERT INTO `rates` (`id`, `from_loc`, `to_loc`, `label`, `active`, `prices`, `created`) VALUES
(1, 'CDG', 'DISNEYLAND', 'CDG TO Disneyland', 1, '{\"3\":80,\"4\":85,\"5\":90,\"6\":90,\"7\":90,\"8\":105,\"9\":170,\"10\":170,\"11\":170,\"12\":180,\"13\":180,\"14\":180,\"15\":185,\"16\":210,\"17\":270,\"18\":270,\"19\":270,\"20\":275,\"21\":275}', '2026-07-10 10:02:42'),
(2, 'ORLY', 'DISNEYLAND', 'Orly TO Disneyland', 1, '{\"3\":85,\"4\":90,\"5\":90,\"6\":100,\"7\":105,\"8\":110,\"9\":180,\"10\":180,\"11\":185,\"12\":195,\"13\":200,\"14\":200,\"15\":210,\"16\":215,\"17\":275,\"18\":280,\"19\":290,\"20\":295,\"21\":300}', '2026-07-10 10:02:42'),
(3, 'BEAUVAIS', 'DISNEYLAND', 'Beauvais Airport TO Disneyland', 1, '{\"3\":160,\"4\":165,\"5\":175,\"6\":180,\"7\":185,\"8\":185,\"9\":330,\"10\":335,\"11\":355,\"12\":350,\"13\":355,\"14\":360,\"15\":365,\"16\":365,\"17\":490,\"18\":490,\"19\":535,\"20\":535,\"21\":535}', '2026-07-10 10:02:42'),
(4, 'CDG', 'PARIS', 'CDG TO Paris', 1, '{\"3\":80,\"4\":90,\"5\":90,\"6\":95,\"7\":100,\"8\":105,\"9\":185,\"10\":185,\"11\":185,\"12\":190,\"13\":190,\"14\":195,\"15\":200,\"16\":210,\"17\":290,\"18\":295,\"19\":300,\"20\":300,\"21\":300}', '2026-07-10 10:02:42'),
(5, 'BEAUVAIS', 'PARIS', 'Beauvais TO Paris', 1, '{\"3\":160,\"4\":165,\"5\":165,\"6\":170,\"7\":175,\"8\":180,\"9\":330,\"10\":335,\"11\":360,\"12\":360,\"13\":360,\"14\":365,\"15\":370,\"16\":375,\"17\":515,\"18\":545,\"19\":545,\"20\":545,\"21\":545}', '2026-07-10 10:02:42'),
(6, 'DISNEYLAND', 'PARIS', 'Disneyland TO Paris', 1, '{\"3\":90,\"4\":90,\"5\":105,\"6\":105,\"7\":115,\"8\":120,\"9\":180,\"10\":185,\"11\":285,\"12\":215,\"13\":220,\"14\":225,\"15\":230,\"16\":295,\"17\":295,\"18\":295,\"19\":295,\"20\":295,\"21\":295}', '2026-07-10 10:02:42'),
(7, 'ORLY', 'PARIS', 'Orly TO Paris', 1, '{\"3\":75,\"4\":75,\"5\":85,\"6\":90,\"7\":95,\"8\":100,\"9\":175,\"10\":175,\"11\":175,\"12\":180,\"13\":180,\"14\":185,\"15\":190,\"16\":200,\"17\":270,\"18\":270,\"19\":275,\"20\":280,\"21\":285}', '2026-07-10 10:02:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rates`
--
ALTER TABLE `rates`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rates`
--
ALTER TABLE `rates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
