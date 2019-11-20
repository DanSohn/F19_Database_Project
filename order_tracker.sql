-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2019 at 10:36 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `order tracker`
--

-- --------------------------------------------------------

--
-- Table structure for table `order_table`
--

CREATE TABLE `order_table` (
  `OrderNumber` int(6) UNSIGNED NOT NULL,
  `Cost` int(10) UNSIGNED NOT NULL,
  `Quantity` int(3) UNSIGNED NOT NULL,
  `CreatedDate` date NOT NULL DEFAULT current_timestamp(),
  `M_SIN` int(9) UNSIGNED NOT NULL,
  `OrderStatus` enum('Order Created','Collected Supplies','Preparing Artwork','Artwork Complete','In Preparation','Complete') NOT NULL DEFAULT 'Order Created'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `person_table`
--

CREATE TABLE `person_table` (
  `SIN` int(11) NOT NULL,
  `FName` varchar(255) NOT NULL,
  `MName` varchar(255) NOT NULL,
  `LName` varchar(255) NOT NULL,
  `PhoneNumber` bigint(20) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `City` varchar(255) NOT NULL,
  `PostalCode` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `PersonType` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `person_table`
--

INSERT INTO `person_table` (`SIN`, `FName`, `MName`, `LName`, `PhoneNumber`, `Email`, `Address`, `City`, `PostalCode`, `Password`, `PersonType`) VALUES
(111222, 'Daniel', '', 'Sohn', 403, 'daniel@gmail.com', '123 dragon city SW', 'Calgary', 'T2W 3W3', '$2y$10$iQvlYnzXS8dRw7VuSKsTJuvtStc28O7mkZSTpU2VXE59LwoHofIHK', ''),
(9876543, 'Panagiota', '', 'Fytopoulou', 7809130497, 'panagiota.fytopoulou@gmail.com', '808 Willingdon Blvd SE', 'Calgary', 'T2J 2B4', '$2y$10$McthJYBKBvT8UADGmCRCDeSZG.6v0DpTTH63pkfOmt/yP9GcA4fqC', ''),
(111222333, 'Peter', 'Kyoung Hwan', 'Namkoong', 4039039827, 'peternamkoong@gmail.com', '148 Wentworth Close SW', 'Calgary', 'T3H 4W1', '$2y$10$m4hTL4clHrN13w7j6CEkYOI8h8IWQ/kwP6r9sKfLu11HbujruOfAC', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `order_table`
--
ALTER TABLE `order_table`
  ADD PRIMARY KEY (`OrderNumber`);

--
-- Indexes for table `person_table`
--
ALTER TABLE `person_table`
  ADD PRIMARY KEY (`SIN`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
