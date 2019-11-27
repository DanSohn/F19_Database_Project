-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2019 at 02:29 AM
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
CREATE DATABASE order_tracker;
USE order_tracker;
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

--
-- Dumping data for table `artwork_table`
--

INSERT INTO `artwork_table` (`D_SIN`, `size`, `color`, `format`, `OrderNumber`) VALUES
(200000000, 'large', 'blue', 'capital letters', 200000),
(200000000, 'small', 'red', 'underline text', 200005);

-- --------------------------------------------------------

--
-- Table structure for table `collects_from_table`
--

CREATE TABLE `collects_from_table` (
  `SupplierName` varchar(255) NOT NULL,
  `E_SIN` int(9) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `collects_from_table`
--

INSERT INTO `collects_from_table` (`SupplierName`, `E_SIN`) VALUES
('Supplier Inc.', 300000000);

-- --------------------------------------------------------

--
-- Table structure for table `designer_specialization_table`
--

CREATE TABLE `designer_specialization_table` (
  `D_SIN` int(9) UNSIGNED NOT NULL,
  `DSpecialization` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `designer_specialization_table`
--

INSERT INTO `designer_specialization_table` (`D_SIN`, `DSpecialization`) VALUES
(200000000, 'machine learning');

-- --------------------------------------------------------

--
-- Table structure for table `has_table`
--

CREATE TABLE `has_table` (
  `InvoiceNumber` int(6) UNSIGNED NOT NULL,
  `OrderNumber` int(6) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `has_table`
--

INSERT INTO `has_table` (`InvoiceNumber`, `OrderNumber`) VALUES
(100000, 200000),
(100001, 200001);

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

--
-- Dumping data for table `installation_table`
--

INSERT INTO `installation_table` (`E_SIN`, `Location`, `Substrate`, `Status`, `OrderNumber`) VALUES
(300000000, 'Calgary', 'steel', 'in progress', 200006);

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

--
-- Dumping data for table `invoice_table`
--

INSERT INTO `invoice_table` (`InvoiceNumber`, `date`, `cost`, `status`, `C_SIN`, `OrderNumber`) VALUES
(100000, '2019-11-23', '100', 'Not Paid', 999999999, 200000),
(100001, '2019-11-23', '1500', 'Paid', 999999999, 200001);

-- --------------------------------------------------------

--
-- Table structure for table `order_table`
--

CREATE TABLE `order_table` (
  `OrderNumber` int(6) UNSIGNED NOT NULL,
  `Cost` int(10) UNSIGNED NOT NULL,
  `Quantity` int(3) UNSIGNED NOT NULL,
  `CreatedDate` date NOT NULL DEFAULT current_timestamp(),
  `length` int(3) UNSIGNED NOT NULL,
  `width` int(3) UNSIGNED NOT NULL,
  `M_SIN` int(9) UNSIGNED NOT NULL,
  `OrderStatus` enum('Request Pending','Rejected','Order Created','Collected Supplies','Preparing Artwork','Artwork Complete','In Preparation','Complete') NOT NULL DEFAULT 'Request Pending',
  `Client_SIN` int(9) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_table`
--

INSERT INTO `order_table` (`OrderNumber`, `Cost`, `Quantity`, `CreatedDate`, `length`, `width`, `M_SIN`, `OrderStatus`, `Client_SIN`) VALUES
(1, 12, 3, '2019-11-24', 2, 2, 0, 'Order Created', 999999999),
(200000, 100, 3, '2019-11-20', 10, 5, 100000000, 'Complete', 999999999),
(200001, 1500, 100, '2019-11-21', 20, 10, 100000000, 'Complete', 999999999),
(200002, 400, 10, '2019-11-23', 30, 15, 100000000, 'Order Created', 999999999),
(200003, 500, 1, '2019-11-23', 40, 20, 100000000, 'Collected Supplies', 999999999),
(200004, 1000, 2, '2019-11-15', 50, 25, 100000000, 'Preparing Artwork', 999999999),
(200005, 2000, 15, '2019-11-10', 12, 6, 100000000, 'Artwork Complete', 999999999),
(200006, 3000, 30, '2019-11-19', 100, 5, 100000000, 'In Preparation', 999999999),
(200007, 324, 9, '2019-11-25', 6, 6, 0, 'Request Pending', 999999999);

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
  `PersonType` enum('Client','Manager','Employee','Designer') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `person_table`
--

INSERT INTO `person_table` (`SIN`, `FName`, `MName`, `LName`, `PhoneNumber`, `Email`, `Address`, `City`, `PostalCode`, `Password`, `PersonType`) VALUES
(0, 'admin', 'root', 'admin', 0, 'admin', 'admin', 'admin', 'a1aa1a', '1234', 'Manager'),
(100000000, 'Peter', 'Kyoung Hwan', 'Namkoong', 4039039827, 'peternamkoong@gmail.com', '148 Wentworth Close SW', 'Calgary', 'T3H 4W1', '1234', 'Manager'),
(200000000, 'Panagiota', 'THE GREEK', 'Fytopoulou', 7809130497, 'panagiota.fytopoulou@gmail.com', '808 Willingdon Blvd SE', 'Calgary', 'T2J 2B4', '1234', 'Designer'),
(300000000, 'Daniel', '', 'Sohn', 403123234, 'daniel@gmail.com', '123 dragon city SW', 'Calgary', 'T2W 3W3', '1234', 'Employee'),
(999999998, 'Jalal', '', 'Kawash', 4030000000, 'jalal.kawash@ucalgary.ca', '471 database st.', 'Calgary', 't1a2c6', '1234', 'Client'),
(999999999, 'client', 'client', 'client', 1001001000, 'client', 'client st', 'client city', 'client', '1234', 'Client');

-- --------------------------------------------------------

--
-- Table structure for table `prepares_table`
--

CREATE TABLE `prepares_table` (
  `E_SIN` int(9) UNSIGNED NOT NULL,
  `OrderNumber` int(6) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prepares_table`
--

INSERT INTO `prepares_table` (`E_SIN`, `OrderNumber`) VALUES
(300000000, 200006);

-- --------------------------------------------------------

--
-- Table structure for table `requests_table`
--

CREATE TABLE `requests_table` (
  `OrderNumber` int(6) UNSIGNED NOT NULL,
  `E_SIN` int(9) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `requests_table`
--

INSERT INTO `requests_table` (`OrderNumber`, `E_SIN`) VALUES
(200006, 300000000);

-- --------------------------------------------------------

--
-- Table structure for table `supplier_table`
--

CREATE TABLE `supplier_table` (
  `name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier_table`
--

INSERT INTO `supplier_table` (`name`, `location`) VALUES
('Supplier Inc.', 'Calgary');

-- --------------------------------------------------------

--
-- Table structure for table `supply_table`
--

CREATE TABLE `supply_table` (
  `ItemID` int(5) UNSIGNED NOT NULL,
  `SupplierName` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `cost` int(3) UNSIGNED NOT NULL,
  `size` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `durability` varchar(255) NOT NULL,
  `M_SIN` int(9) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supply_table`
--

INSERT INTO `supply_table` (`ItemID`, `SupplierName`, `brand`, `type`, `cost`, `size`, `color`, `durability`, `M_SIN`) VALUES
(10001, 'Supplier Inc.', 'Guess', 'Dress Shirts', 80, '12', 'white', '5', 100000000),
(10002, 'Supplier Inc.', 'Fossil', 'Watch', 200, '24', 'black', '10', 100000000),
(10003, 'Supplier Inc.', 'Dan the Store Man', 'Human', 10, '48', 'green', '15', 100000000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artwork_table`
--
ALTER TABLE `artwork_table`
  ADD PRIMARY KEY (`OrderNumber`);

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
  ADD PRIMARY KEY (`ItemID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `invoice_table`
--
ALTER TABLE `invoice_table`
  MODIFY `InvoiceNumber` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100002;

--
-- AUTO_INCREMENT for table `order_table`
--
ALTER TABLE `order_table`
  MODIFY `OrderNumber` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=200008;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
