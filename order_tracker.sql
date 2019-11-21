-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 21, 2019 at 08:19 AM
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
-- Database: `order_tracker`
--

-- --------------------------------------------------------

--
-- Table structure for table `artwork_table`
--

CREATE TABLE `artwork_table` (
  `D_SIN` int(9) UNSIGNED NOT NULL,
  `size` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `format` varchar(255) NOT NULL,
  `OrderNumber` int(6) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `client_table`
--

CREATE TABLE `client_table` (
  `SIN` int(9) UNSIGNED NOT NULL,
  `M_SIN` int(9) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `collects_from_table`
--

CREATE TABLE `collects_from_table` (
  `SupplierName` varchar(255) NOT NULL,
  `E_SIN` int(9) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `designer_specialization_table`
--

CREATE TABLE `designer_specialization_table` (
  `D_SIN` int(9) UNSIGNED NOT NULL,
  `DSpecialization` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `designer_table`
--

CREATE TABLE `designer_table` (
  `SIN` int(9) UNSIGNED NOT NULL,
  `Experience` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `employee_table`
--

CREATE TABLE `employee_table` (
  `SIN` int(9) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `has_table`
--

CREATE TABLE `has_table` (
  `InvoiceNumber` int(6) UNSIGNED NOT NULL,
  `OrderNumber` int(6) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `installation_table`
--

CREATE TABLE `installation_table` (
  `E_SIN` int(9) NOT NULL,
  `Location` varchar(255) NOT NULL,
  `Substrate` varchar(255) NOT NULL,
  `Status` varchar(255) NOT NULL,
  `OrderNumber` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_table`
--

CREATE TABLE `invoice_table` (
  `InvoiceNumber` int(6) UNSIGNED NOT NULL,
  `date` varchar(255) NOT NULL,
  `cost` varchar(255) NOT NULL,
  `status` enum('Paid','Not Paid') NOT NULL DEFAULT 'Not Paid',
  `C_SIN` int(9) UNSIGNED NOT NULL,
  `OrderNumber` int(6) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `manager_table`
--

CREATE TABLE `manager_table` (
  `SIN` int(9) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `SIN` int(9) NOT NULL,
  `FName` varchar(255) NOT NULL,
  `MName` varchar(255) NOT NULL,
  `LName` varchar(255) NOT NULL,
  `PhoneNumber` bigint(20) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `City` varchar(255) NOT NULL,
  `PostalCode` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `PersonType` enum('Client','Worker','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `person_table`
--

INSERT INTO `person_table` (`SIN`, `FName`, `MName`, `LName`, `PhoneNumber`, `Email`, `Address`, `City`, `PostalCode`, `Password`, `PersonType`) VALUES
(111222, 'Daniel', '', 'Sohn', 403, 'daniel@gmail.com', '123 dragon city SW', 'Calgary', 'T2W 3W3', '$2y$10$iQvlYnzXS8dRw7VuSKsTJuvtStc28O7mkZSTpU2VXE59LwoHofIHK', ''),
(9876543, 'Panagiota', '', 'Fytopoulou', 7809130497, 'panagiota.fytopoulou@gmail.com', '808 Willingdon Blvd SE', 'Calgary', 'T2J 2B4', '$2y$10$McthJYBKBvT8UADGmCRCDeSZG.6v0DpTTH63pkfOmt/yP9GcA4fqC', ''),
(111222333, 'Peter', 'Kyoung Hwan', 'Namkoong', 4039039827, 'peternamkoong@gmail.com', '148 Wentworth Close SW', 'Calgary', 'T3H 4W1', '$2y$10$m4hTL4clHrN13w7j6CEkYOI8h8IWQ/kwP6r9sKfLu11HbujruOfAC', '');

-- --------------------------------------------------------

--
-- Table structure for table `prepares_table`
--

CREATE TABLE `prepares_table` (
  `E_SIN` int(9) UNSIGNED NOT NULL,
  `OrderNumber` int(6) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `requests_table`
--

CREATE TABLE `requests_table` (
  `OrderNumber` int(6) UNSIGNED NOT NULL,
  `E_SIN` int(9) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `supplier_table`
--

CREATE TABLE `supplier_table` (
  `name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `supply_table`
--

CREATE TABLE `supply_table` (
  `SupplierName` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `cost` int(3) UNSIGNED NOT NULL,
  `size` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `durability` varchar(255) NOT NULL,
  `M_SIN` int(9) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `worker_table`
--

CREATE TABLE `worker_table` (
  `SIN` int(9) UNSIGNED NOT NULL,
  `WorkerType` enum('Manager','Employee','Designer','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artwork_table`
--
ALTER TABLE `artwork_table`
  ADD PRIMARY KEY (`D_SIN`);

--
-- Indexes for table `client_table`
--
ALTER TABLE `client_table`
  ADD PRIMARY KEY (`SIN`);

--
-- Indexes for table `collects_from_table`
--
ALTER TABLE `collects_from_table`
  ADD PRIMARY KEY (`SupplierName`,`E_SIN`);

--
-- Indexes for table `designer_specialization_table`
--
ALTER TABLE `designer_specialization_table`
  ADD PRIMARY KEY (`D_SIN`,`DSpecialization`);

--
-- Indexes for table `designer_table`
--
ALTER TABLE `designer_table`
  ADD PRIMARY KEY (`SIN`);

--
-- Indexes for table `employee_table`
--
ALTER TABLE `employee_table`
  ADD PRIMARY KEY (`SIN`);

--
-- Indexes for table `has_table`
--
ALTER TABLE `has_table`
  ADD PRIMARY KEY (`InvoiceNumber`,`OrderNumber`);

--
-- Indexes for table `installation_table`
--
ALTER TABLE `installation_table`
  ADD PRIMARY KEY (`E_SIN`);

--
-- Indexes for table `invoice_table`
--
ALTER TABLE `invoice_table`
  ADD PRIMARY KEY (`InvoiceNumber`);

--
-- Indexes for table `manager_table`
--
ALTER TABLE `manager_table`
  ADD PRIMARY KEY (`SIN`);

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

--
-- Indexes for table `prepares_table`
--
ALTER TABLE `prepares_table`
  ADD PRIMARY KEY (`E_SIN`,`OrderNumber`);

--
-- Indexes for table `requests_table`
--
ALTER TABLE `requests_table`
  ADD PRIMARY KEY (`OrderNumber`,`E_SIN`);

--
-- Indexes for table `supplier_table`
--
ALTER TABLE `supplier_table`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `supply_table`
--
ALTER TABLE `supply_table`
  ADD PRIMARY KEY (`SupplierName`);

--
-- Indexes for table `worker_table`
--
ALTER TABLE `worker_table`
  ADD PRIMARY KEY (`SIN`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
