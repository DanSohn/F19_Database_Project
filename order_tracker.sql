-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2019 at 05:11 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

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
  `ImagePath` varchar(255) NOT NULL,
  `OrderNumber` int(6) UNSIGNED NOT NULL,
  `Artwork_Status` enum('In Progress','Completed') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `artwork_table`
--

INSERT INTO `artwork_table` (`D_SIN`, `ImagePath`, `OrderNumber`, `Artwork_Status`) VALUES
(0, '', 200013, 'In Progress'),
(200000000, 'images/grey.jpg', 200014, 'Completed'),
(200000000, 'images/black.jpg', 200015, 'Completed'),
(200000000, 'images/white.jpg', 200016, 'Completed'),
(200000000, 'images/brown.jpg', 200017, 'Completed'),
(0, '', 200019, 'In Progress');

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
  `E_SIN` int(9) UNSIGNED NOT NULL,
  `Location` varchar(255) NOT NULL,
  `Substrate` varchar(255) NOT NULL,
  `Status` enum('Requested','Complete') NOT NULL DEFAULT 'Requested',
  `OrderNumber` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `installation_table`
--

INSERT INTO `installation_table` (`E_SIN`, `Location`, `Substrate`, `Status`, `OrderNumber`) VALUES
(300000000, 'Calgary', 'Wall', 'Requested', 200013),
(300000000, 'Calgary', 'Vehicle', 'Requested', 200016),
(300000000, 'Calgary', 'Wall', 'Requested', 200018),
(300000000, 'Calgary', 'Vehicle', 'Requested', 200019);

-- --------------------------------------------------------

--
-- Table structure for table `invoice_table`
--

CREATE TABLE `invoice_table` (
  `InvoiceNumber` int(6) UNSIGNED ZEROFILL NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `cost` varchar(255) NOT NULL,
  `status` enum('Paid','Not Paid') NOT NULL DEFAULT 'Not Paid',
  `C_SIN` int(9) UNSIGNED NOT NULL,
  `OrderNumber` int(6) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice_table`
--

INSERT INTO `invoice_table` (`InvoiceNumber`, `date`, `cost`, `status`, `C_SIN`, `OrderNumber`) VALUES
(100002, '2019-12-02', '800', 'Paid', 300000000, 200015);

-- --------------------------------------------------------

--
-- Table structure for table `order_table`
--

CREATE TABLE `order_table` (
  `OrderNumber` int(6) UNSIGNED ZEROFILL NOT NULL,
  `Cost` int(10) UNSIGNED NOT NULL,
  `Quantity` int(3) UNSIGNED NOT NULL,
  `CreatedDate` date NOT NULL DEFAULT current_timestamp(),
  `length` int(3) UNSIGNED NOT NULL,
  `width` int(3) UNSIGNED NOT NULL,
  `M_SIN` int(9) UNSIGNED NOT NULL,
  `OrderStatus` enum('Requested','Approved','Rejected','Design Complete','Order Prepared','Completed') NOT NULL DEFAULT 'Requested',
  `Client_SIN` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_table`
--

INSERT INTO `order_table` (`OrderNumber`, `Cost`, `Quantity`, `CreatedDate`, `length`, `width`, `M_SIN`, `OrderStatus`, `Client_SIN`) VALUES
(200013, 500, 5, '2019-12-02', 10, 10, 100000000, 'Approved', 999999999),
(200014, 1152, 2, '2019-12-02', 24, 24, 100000000, 'Completed', 999999999),
(200015, 800, 10, '2019-12-02', 20, 4, 100000000, 'Completed', 999999999),
(200016, 48, 2, '2019-12-02', 24, 1, 100000000, 'Order Prepared', 400000000),
(200017, 2000, 10, '2019-12-02', 20, 10, 100000000, 'Order Prepared', 400000000),
(200018, 780, 6, '2019-12-02', 10, 13, 100000000, 'Rejected', 400000000),
(200019, 484, 1, '2019-12-02', 22, 22, 100000000, 'Approved', 400000000);

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
(100000000, 'Peter', 'Kyoung Hwan', 'Namkoong', 4039039827, 'manager', '148 Wentworth Close SW', 'Calgary', 'T3H 4W1', '1234', 'Manager'),
(200000000, 'Panagiota', '', 'Fytopoulou', 7809130497, 'designer', 'Design Street NW', 'Calgary', 'D3S I5N', '1234', 'Designer'),
(300000000, 'Daniel', '', 'Sohn', 403123234, 'employee', '123 Dragon City SW', 'Calgary', 'T2W 3W3', '1234', 'Employee'),
(400000000, 'Abdelghani', '', 'Guerbas', 4038835480, 'client2', 'Client Avenue SW', 'Calgary', 'T2E 7R5', '1234', 'Client'),
(999999999, 'Jalal', '', 'Kawash', 1001001000, 'client1', 'Client Street SW', 'Calgary', 'T2E 6R1', '1234', 'Client');

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
  `location` varchar(255) NOT NULL,
  `Website` varchar(255) NOT NULL,
  `Phone Number` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier_table`
--

INSERT INTO `supplier_table` (`name`, `location`, `Website`, `Phone Number`) VALUES
('Dans Supplies', 'Toronto', 'dansohn.github.io', 1000001258),
('Supplier Inc.', 'Calgary', 'facebook.com/nkggraphics', 1234567890);

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
(1044, 'Suppliers Inc.', '3M', 'Vinyl', 5, '6', 'White', '5', 100000000),
(1045, 'Suppliers Inc.', '3M', 'Vinyl', 5, '6', 'Black', '5', 100000000),
(1046, 'Suppliers Inc.', '3M', 'Vinyl', 5, '6', 'Yellow', '5', 100000000),
(1047, 'Suppliers Inc.', '3M', 'Vinyl', 5, '6', 'Orange', '5', 100000000),
(1048, 'Suppliers Inc.', '3M', 'Vinyl', 5, '6', 'Red', '5', 100000000),
(1049, 'Suppliers Inc.', '3M', 'Vinyl', 5, '6', 'Pink', '5', 100000000),
(1050, 'Suppliers Inc.', '3M', 'Vinyl', 5, '6', 'Purple', '5', 100000000),
(1051, 'Suppliers Inc.', '3M', 'Vinyl', 5, '6', 'Blue', '5', 100000000),
(1052, 'Suppliers Inc.', '3M', 'Vinyl', 5, '6', 'Green', '5', 100000000),
(1053, 'Suppliers Inc.', '3M', 'Vinyl', 5, '6', 'Brown', '5', 100000000),
(1054, 'Suppliers Inc.', '3M', 'Vinyl', 5, '6', 'Gray', '5', 100000000),
(1055, 'Suppliers Inc.', '3M', 'Vinyl', 9, '12', 'White', '5', 100000000),
(1056, 'Suppliers Inc.', '3M', 'Vinyl', 9, '12', 'Black', '5', 100000000),
(1057, 'Suppliers Inc.', '3M', 'Vinyl', 9, '12', 'Yellow', '5', 100000000),
(1058, 'Suppliers Inc.', '3M', 'Vinyl', 9, '12', 'Orange', '5', 100000000),
(1059, 'Suppliers Inc.', '3M', 'Vinyl', 9, '12', 'Red', '5', 100000000),
(1060, 'Suppliers Inc.', '3M', 'Vinyl', 9, '12', 'Pink', '5', 100000000),
(1061, 'Suppliers Inc.', '3M', 'Vinyl', 9, '12', 'Purple', '5', 100000000),
(1062, 'Suppliers Inc.', '3M', 'Vinyl', 9, '12', 'Blue', '5', 100000000),
(1063, 'Suppliers Inc.', '3M', 'Vinyl', 9, '12', 'Green', '5', 100000000),
(1064, 'Suppliers Inc.', '3M', 'Vinyl', 9, '12', 'Brown', '5', 100000000),
(1065, 'Suppliers Inc.', '3M', 'Vinyl', 9, '12', 'Gray', '5', 100000000),
(1066, 'Suppliers Inc.', '3M', 'Vinyl', 16, '24', 'White', '5', 100000000),
(1067, 'Suppliers Inc.', '3M', 'Vinyl', 16, '24', 'Black', '5', 100000000),
(1068, 'Suppliers Inc.', '3M', 'Vinyl', 16, '24', 'Yellow', '5', 100000000),
(1069, 'Suppliers Inc.', '3M', 'Vinyl', 16, '24', 'Orange', '5', 100000000),
(1070, 'Suppliers Inc.', '3M', 'Vinyl', 16, '24', 'Red', '5', 100000000),
(1071, 'Suppliers Inc.', '3M', 'Vinyl', 16, '24', 'Pink', '5', 100000000),
(1072, 'Suppliers Inc.', '3M', 'Vinyl', 16, '24', 'Purple', '5', 100000000),
(1073, 'Suppliers Inc.', '3M', 'Vinyl', 16, '24', 'Blue', '5', 100000000),
(1074, 'Suppliers Inc.', '3M', 'Vinyl', 16, '24', 'Green', '5', 100000000),
(1075, 'Suppliers Inc.', '3M', 'Vinyl', 16, '24', 'Brown', '5', 100000000),
(1076, 'Suppliers Inc.', '3M', 'Vinyl', 16, '24', 'Gray', '5', 100000000),
(1077, 'Suppliers Inc.', '3M', 'Vinyl', 30, '48', 'White', '5', 100000000),
(1078, 'Suppliers Inc.', '3M', 'Vinyl', 30, '48', 'Black', '5', 100000000),
(1079, 'Suppliers Inc.', '3M', 'Vinyl', 30, '48', 'Yellow', '5', 100000000),
(1080, 'Suppliers Inc.', '3M', 'Vinyl', 30, '48', 'Orange', '5', 100000000),
(1081, 'Suppliers Inc.', '3M', 'Vinyl', 30, '48', 'Red', '5', 100000000),
(1082, 'Suppliers Inc.', '3M', 'Vinyl', 30, '48', 'Pink', '5', 100000000),
(1083, 'Suppliers Inc.', '3M', 'Vinyl', 30, '48', 'Purple', '5', 100000000),
(1084, 'Suppliers Inc.', '3M', 'Vinyl', 30, '48', 'Blue', '5', 100000000),
(1085, 'Suppliers Inc.', '3M', 'Vinyl', 30, '48', 'Green', '5', 100000000),
(1086, 'Suppliers Inc.', '3M', 'Vinyl', 30, '48', 'Brown', '5', 100000000),
(1087, 'Suppliers Inc.', '3M', 'Vinyl', 30, '48', 'Gray', '5', 100000000),
(1088, 'Suppliers Inc.', '3M', 'Vinyl', 10, '6', 'White', '10', 100000000),
(1089, 'Suppliers Inc.', '3M', 'Vinyl', 10, '6', 'Black', '10', 100000000),
(1090, 'Suppliers Inc.', '3M', 'Vinyl', 10, '6', 'Yellow', '10', 100000000),
(1091, 'Suppliers Inc.', '3M', 'Vinyl', 10, '6', 'Orange', '10', 100000000),
(1092, 'Suppliers Inc.', '3M', 'Vinyl', 10, '6', 'Red', '10', 100000000),
(1093, 'Suppliers Inc.', '3M', 'Vinyl', 10, '6', 'Pink', '10', 100000000),
(1094, 'Suppliers Inc.', '3M', 'Vinyl', 10, '6', 'Purple', '10', 100000000),
(1095, 'Suppliers Inc.', '3M', 'Vinyl', 10, '6', 'Blue', '10', 100000000),
(1096, 'Suppliers Inc.', '3M', 'Vinyl', 10, '6', 'Green', '10', 100000000),
(1097, 'Suppliers Inc.', '3M', 'Vinyl', 10, '6', 'Brown', '10', 100000000),
(1098, 'Suppliers Inc.', '3M', 'Vinyl', 10, '6', 'Gray', '10', 100000000),
(1099, 'Suppliers Inc.', '3M', 'Vinyl', 18, '12', 'White', '10', 100000000),
(1100, 'Suppliers Inc.', '3M', 'Vinyl', 18, '12', 'Black', '10', 100000000),
(1101, 'Suppliers Inc.', '3M', 'Vinyl', 18, '12', 'Yellow', '10', 100000000),
(1102, 'Suppliers Inc.', '3M', 'Vinyl', 18, '12', 'Orange', '10', 100000000),
(1103, 'Suppliers Inc.', '3M', 'Vinyl', 18, '12', 'Red', '10', 100000000),
(1104, 'Suppliers Inc.', '3M', 'Vinyl', 18, '12', 'Pink', '10', 100000000),
(1105, 'Suppliers Inc.', '3M', 'Vinyl', 18, '12', 'Purple', '10', 100000000),
(1106, 'Suppliers Inc.', '3M', 'Vinyl', 18, '12', 'Blue', '10', 100000000),
(1107, 'Suppliers Inc.', '3M', 'Vinyl', 18, '12', 'Green', '10', 100000000),
(1108, 'Suppliers Inc.', '3M', 'Vinyl', 18, '12', 'Brown', '10', 100000000),
(1109, 'Suppliers Inc.', '3M', 'Vinyl', 18, '12', 'Gray', '10', 100000000),
(1110, 'Suppliers Inc.', '3M', 'Vinyl', 32, '24', 'White', '10', 100000000),
(1111, 'Suppliers Inc.', '3M', 'Vinyl', 32, '24', 'Black', '10', 100000000),
(1112, 'Suppliers Inc.', '3M', 'Vinyl', 32, '24', 'Yellow', '10', 100000000),
(1113, 'Suppliers Inc.', '3M', 'Vinyl', 32, '24', 'Orange', '10', 100000000),
(1114, 'Suppliers Inc.', '3M', 'Vinyl', 32, '24', 'Red', '10', 100000000),
(1115, 'Suppliers Inc.', '3M', 'Vinyl', 32, '24', 'Pink', '10', 100000000),
(1116, 'Suppliers Inc.', '3M', 'Vinyl', 32, '24', 'Purple', '10', 100000000),
(1117, 'Suppliers Inc.', '3M', 'Vinyl', 32, '24', 'Blue', '10', 100000000),
(1118, 'Suppliers Inc.', '3M', 'Vinyl', 32, '24', 'Green', '10', 100000000),
(1119, 'Suppliers Inc.', '3M', 'Vinyl', 32, '24', 'Brown', '10', 100000000),
(1120, 'Suppliers Inc.', '3M', 'Vinyl', 32, '24', 'Gray', '10', 100000000),
(1121, 'Suppliers Inc.', '3M', 'Vinyl', 60, '48', 'White', '10', 100000000),
(1122, 'Suppliers Inc.', '3M', 'Vinyl', 60, '48', 'Black', '10', 100000000),
(1123, 'Suppliers Inc.', '3M', 'Vinyl', 60, '48', 'Yellow', '10', 100000000),
(1124, 'Suppliers Inc.', '3M', 'Vinyl', 60, '48', 'Orange', '10', 100000000),
(1125, 'Suppliers Inc.', '3M', 'Vinyl', 60, '48', 'Red', '10', 100000000),
(1126, 'Suppliers Inc.', '3M', 'Vinyl', 60, '48', 'Pink', '10', 100000000),
(1127, 'Suppliers Inc.', '3M', 'Vinyl', 60, '48', 'Purple', '10', 100000000),
(1128, 'Suppliers Inc.', '3M', 'Vinyl', 60, '48', 'Blue', '10', 100000000),
(1129, 'Suppliers Inc.', '3M', 'Vinyl', 60, '48', 'Green', '10', 100000000),
(1130, 'Suppliers Inc.', '3M', 'Vinyl', 60, '48', 'Brown', '10', 100000000),
(1131, 'Suppliers Inc.', '3M', 'Vinyl', 60, '48', 'Gray', '10', 100000000),
(1132, 'Suppliers Inc.', '3M', 'Vinyl', 15, '6', 'White', '15', 100000000),
(1133, 'Suppliers Inc.', '3M', 'Vinyl', 15, '6', 'Black', '15', 100000000),
(1134, 'Suppliers Inc.', '3M', 'Vinyl', 15, '6', 'Yellow', '15', 100000000),
(1135, 'Suppliers Inc.', '3M', 'Vinyl', 15, '6', 'Orange', '15', 100000000),
(1136, 'Suppliers Inc.', '3M', 'Vinyl', 15, '6', 'Red', '15', 100000000),
(1137, 'Suppliers Inc.', '3M', 'Vinyl', 15, '6', 'Pink', '15', 100000000),
(1138, 'Suppliers Inc.', '3M', 'Vinyl', 15, '6', 'Purple', '15', 100000000),
(1139, 'Suppliers Inc.', '3M', 'Vinyl', 15, '6', 'Blue', '15', 100000000),
(1140, 'Suppliers Inc.', '3M', 'Vinyl', 15, '6', 'Green', '15', 100000000),
(1141, 'Suppliers Inc.', '3M', 'Vinyl', 15, '6', 'Brown', '15', 100000000),
(1142, 'Suppliers Inc.', '3M', 'Vinyl', 15, '6', 'Gray', '15', 100000000),
(1143, 'Suppliers Inc.', '3M', 'Vinyl', 27, '12', 'White', '15', 100000000),
(1144, 'Suppliers Inc.', '3M', 'Vinyl', 27, '12', 'Black', '15', 100000000),
(1145, 'Suppliers Inc.', '3M', 'Vinyl', 27, '12', 'Yellow', '15', 100000000),
(1146, 'Suppliers Inc.', '3M', 'Vinyl', 27, '12', 'Orange', '15', 100000000),
(1147, 'Suppliers Inc.', '3M', 'Vinyl', 27, '12', 'Red', '15', 100000000),
(1148, 'Suppliers Inc.', '3M', 'Vinyl', 27, '12', 'Pink', '15', 100000000),
(1149, 'Suppliers Inc.', '3M', 'Vinyl', 27, '12', 'Purple', '15', 100000000),
(1150, 'Suppliers Inc.', '3M', 'Vinyl', 27, '12', 'Blue', '15', 100000000),
(1151, 'Suppliers Inc.', '3M', 'Vinyl', 27, '12', 'Green', '15', 100000000),
(1152, 'Suppliers Inc.', '3M', 'Vinyl', 27, '12', 'Brown', '15', 100000000),
(1153, 'Suppliers Inc.', '3M', 'Vinyl', 27, '12', 'Gray', '15', 100000000),
(1154, 'Suppliers Inc.', '3M', 'Vinyl', 48, '24', 'White', '15', 100000000),
(1155, 'Suppliers Inc.', '3M', 'Vinyl', 48, '24', 'Black', '15', 100000000),
(1156, 'Suppliers Inc.', '3M', 'Vinyl', 48, '24', 'Yellow', '15', 100000000),
(1157, 'Suppliers Inc.', '3M', 'Vinyl', 48, '24', 'Orange', '15', 100000000),
(1158, 'Suppliers Inc.', '3M', 'Vinyl', 48, '24', 'Red', '15', 100000000),
(1159, 'Suppliers Inc.', '3M', 'Vinyl', 48, '24', 'Pink', '15', 100000000),
(1160, 'Suppliers Inc.', '3M', 'Vinyl', 48, '24', 'Purple', '15', 100000000),
(1161, 'Suppliers Inc.', '3M', 'Vinyl', 48, '24', 'Blue', '15', 100000000),
(1162, 'Suppliers Inc.', '3M', 'Vinyl', 48, '24', 'Green', '15', 100000000),
(1163, 'Suppliers Inc.', '3M', 'Vinyl', 48, '24', 'Brown', '15', 100000000),
(1164, 'Suppliers Inc.', '3M', 'Vinyl', 48, '24', 'Gray', '15', 100000000),
(1165, 'Suppliers Inc.', '3M', 'Vinyl', 90, '48', 'White', '15', 100000000),
(1166, 'Suppliers Inc.', '3M', 'Vinyl', 90, '48', 'Black', '15', 100000000),
(1167, 'Suppliers Inc.', '3M', 'Vinyl', 90, '48', 'Yellow', '15', 100000000),
(1168, 'Suppliers Inc.', '3M', 'Vinyl', 90, '48', 'Orange', '15', 100000000),
(1169, 'Suppliers Inc.', '3M', 'Vinyl', 90, '48', 'Red', '15', 100000000),
(1170, 'Suppliers Inc.', '3M', 'Vinyl', 90, '48', 'Pink', '15', 100000000),
(1171, 'Suppliers Inc.', '3M', 'Vinyl', 90, '48', 'Purple', '15', 100000000),
(1172, 'Suppliers Inc.', '3M', 'Vinyl', 90, '48', 'Blue', '15', 100000000),
(1173, 'Suppliers Inc.', '3M', 'Vinyl', 90, '48', 'Green', '15', 100000000),
(1174, 'Suppliers Inc.', '3M', 'Vinyl', 90, '48', 'Brown', '15', 100000000),
(1175, 'Suppliers Inc.', '3M', 'Vinyl', 90, '48', 'Gray', '15', 100000000),
(1176, 'Dannies Supplies', '3M', 'Vinyl', 5, '6', 'White', '5', 100000000),
(1177, 'Dannies Supplies', '3M', 'Vinyl', 5, '6', 'Black', '5', 100000000),
(1178, 'Dannies Supplies', '3M', 'Vinyl', 5, '6', 'Yellow', '5', 100000000),
(1179, 'Dannies Supplies', '3M', 'Vinyl', 5, '6', 'Orange', '5', 100000000),
(1180, 'Dannies Supplies', '3M', 'Vinyl', 5, '6', 'Red', '5', 100000000),
(1181, 'Dannies Supplies', '3M', 'Vinyl', 5, '6', 'Pink', '5', 100000000),
(1182, 'Dannies Supplies', '3M', 'Vinyl', 5, '6', 'Purple', '5', 100000000),
(1183, 'Dannies Supplies', '3M', 'Vinyl', 5, '6', 'Blue', '5', 100000000),
(1184, 'Dannies Supplies', '3M', 'Vinyl', 5, '6', 'Green', '5', 100000000),
(1185, 'Dannies Supplies', '3M', 'Vinyl', 5, '6', 'Brown', '5', 100000000),
(1186, 'Dannies Supplies', '3M', 'Vinyl', 5, '6', 'Gray', '5', 100000000),
(1187, 'Dannies Supplies', '3M', 'Vinyl', 9, '12', 'White', '5', 100000000),
(1188, 'Dannies Supplies', '3M', 'Vinyl', 9, '12', 'Black', '5', 100000000),
(1189, 'Dannies Supplies', '3M', 'Vinyl', 9, '12', 'Yellow', '5', 100000000),
(1190, 'Dannies Supplies', '3M', 'Vinyl', 9, '12', 'Orange', '5', 100000000),
(1191, 'Dannies Supplies', '3M', 'Vinyl', 9, '12', 'Red', '5', 100000000),
(1192, 'Dannies Supplies', '3M', 'Vinyl', 9, '12', 'Pink', '5', 100000000),
(1193, 'Dannies Supplies', '3M', 'Vinyl', 9, '12', 'Purple', '5', 100000000),
(1194, 'Dannies Supplies', '3M', 'Vinyl', 9, '12', 'Blue', '5', 100000000),
(1195, 'Dannies Supplies', '3M', 'Vinyl', 9, '12', 'Green', '5', 100000000),
(1196, 'Dannies Supplies', '3M', 'Vinyl', 9, '12', 'Brown', '5', 100000000),
(1197, 'Dannies Supplies', '3M', 'Vinyl', 9, '12', 'Gray', '5', 100000000),
(1198, 'Dannies Supplies', '3M', 'Vinyl', 16, '24', 'White', '5', 100000000),
(1199, 'Dannies Supplies', '3M', 'Vinyl', 16, '24', 'Black', '5', 100000000),
(1200, 'Dannies Supplies', '3M', 'Vinyl', 16, '24', 'Yellow', '5', 100000000),
(1201, 'Dannies Supplies', '3M', 'Vinyl', 16, '24', 'Orange', '5', 100000000),
(1202, 'Dannies Supplies', '3M', 'Vinyl', 16, '24', 'Red', '5', 100000000),
(1203, 'Dannies Supplies', '3M', 'Vinyl', 16, '24', 'Pink', '5', 100000000),
(1204, 'Dannies Supplies', '3M', 'Vinyl', 16, '24', 'Purple', '5', 100000000),
(1205, 'Dannies Supplies', '3M', 'Vinyl', 16, '24', 'Blue', '5', 100000000),
(1206, 'Dannies Supplies', '3M', 'Vinyl', 16, '24', 'Green', '5', 100000000),
(1207, 'Dannies Supplies', '3M', 'Vinyl', 16, '24', 'Brown', '5', 100000000),
(1208, 'Dannies Supplies', '3M', 'Vinyl', 16, '24', 'Gray', '5', 100000000),
(1209, 'Dannies Supplies', '3M', 'Vinyl', 30, '48', 'White', '5', 100000000),
(1210, 'Dannies Supplies', '3M', 'Vinyl', 30, '48', 'Black', '5', 100000000),
(1211, 'Dannies Supplies', '3M', 'Vinyl', 30, '48', 'Yellow', '5', 100000000),
(1212, 'Dannies Supplies', '3M', 'Vinyl', 30, '48', 'Orange', '5', 100000000),
(1213, 'Dannies Supplies', '3M', 'Vinyl', 30, '48', 'Red', '5', 100000000),
(1214, 'Dannies Supplies', '3M', 'Vinyl', 30, '48', 'Pink', '5', 100000000),
(1215, 'Dannies Supplies', '3M', 'Vinyl', 30, '48', 'Purple', '5', 100000000),
(1216, 'Dannies Supplies', '3M', 'Vinyl', 30, '48', 'Blue', '5', 100000000),
(1217, 'Dannies Supplies', '3M', 'Vinyl', 30, '48', 'Green', '5', 100000000),
(1218, 'Dannies Supplies', '3M', 'Vinyl', 30, '48', 'Brown', '5', 100000000),
(1219, 'Dannies Supplies', '3M', 'Vinyl', 30, '48', 'Gray', '5', 100000000),
(1220, 'Dannies Supplies', '3M', 'Vinyl', 10, '6', 'White', '10', 100000000),
(1221, 'Dannies Supplies', '3M', 'Vinyl', 10, '6', 'Black', '10', 100000000),
(1222, 'Dannies Supplies', '3M', 'Vinyl', 10, '6', 'Yellow', '10', 100000000),
(1223, 'Dannies Supplies', '3M', 'Vinyl', 10, '6', 'Orange', '10', 100000000),
(1224, 'Dannies Supplies', '3M', 'Vinyl', 10, '6', 'Red', '10', 100000000),
(1225, 'Dannies Supplies', '3M', 'Vinyl', 10, '6', 'Pink', '10', 100000000),
(1226, 'Dannies Supplies', '3M', 'Vinyl', 10, '6', 'Purple', '10', 100000000),
(1227, 'Dannies Supplies', '3M', 'Vinyl', 10, '6', 'Blue', '10', 100000000),
(1228, 'Dannies Supplies', '3M', 'Vinyl', 10, '6', 'Green', '10', 100000000),
(1229, 'Dannies Supplies', '3M', 'Vinyl', 10, '6', 'Brown', '10', 100000000),
(1230, 'Dannies Supplies', '3M', 'Vinyl', 10, '6', 'Gray', '10', 100000000),
(1231, 'Dannies Supplies', '3M', 'Vinyl', 18, '12', 'White', '10', 100000000),
(1232, 'Dannies Supplies', '3M', 'Vinyl', 18, '12', 'Black', '10', 100000000),
(1233, 'Dannies Supplies', '3M', 'Vinyl', 18, '12', 'Yellow', '10', 100000000),
(1234, 'Dannies Supplies', '3M', 'Vinyl', 18, '12', 'Orange', '10', 100000000),
(1235, 'Dannies Supplies', '3M', 'Vinyl', 18, '12', 'Red', '10', 100000000),
(1236, 'Dannies Supplies', '3M', 'Vinyl', 18, '12', 'Pink', '10', 100000000),
(1237, 'Dannies Supplies', '3M', 'Vinyl', 18, '12', 'Purple', '10', 100000000),
(1238, 'Dannies Supplies', '3M', 'Vinyl', 18, '12', 'Blue', '10', 100000000),
(1239, 'Dannies Supplies', '3M', 'Vinyl', 18, '12', 'Green', '10', 100000000),
(1240, 'Dannies Supplies', '3M', 'Vinyl', 18, '12', 'Brown', '10', 100000000),
(1241, 'Dannies Supplies', '3M', 'Vinyl', 18, '12', 'Gray', '10', 100000000),
(1242, 'Dannies Supplies', '3M', 'Vinyl', 32, '24', 'White', '10', 100000000),
(1243, 'Dannies Supplies', '3M', 'Vinyl', 32, '24', 'Black', '10', 100000000),
(1244, 'Dannies Supplies', '3M', 'Vinyl', 32, '24', 'Yellow', '10', 100000000),
(1245, 'Dannies Supplies', '3M', 'Vinyl', 32, '24', 'Orange', '10', 100000000),
(1246, 'Dannies Supplies', '3M', 'Vinyl', 32, '24', 'Red', '10', 100000000),
(1247, 'Dannies Supplies', '3M', 'Vinyl', 32, '24', 'Pink', '10', 100000000),
(1248, 'Dannies Supplies', '3M', 'Vinyl', 32, '24', 'Purple', '10', 100000000),
(1249, 'Dannies Supplies', '3M', 'Vinyl', 32, '24', 'Blue', '10', 100000000),
(1250, 'Dannies Supplies', '3M', 'Vinyl', 32, '24', 'Green', '10', 100000000),
(1251, 'Dannies Supplies', '3M', 'Vinyl', 32, '24', 'Brown', '10', 100000000),
(1252, 'Dannies Supplies', '3M', 'Vinyl', 32, '24', 'Gray', '10', 100000000),
(1253, 'Dannies Supplies', '3M', 'Vinyl', 60, '48', 'White', '10', 100000000),
(1254, 'Dannies Supplies', '3M', 'Vinyl', 60, '48', 'Black', '10', 100000000),
(1255, 'Dannies Supplies', '3M', 'Vinyl', 60, '48', 'Yellow', '10', 100000000),
(1256, 'Dannies Supplies', '3M', 'Vinyl', 60, '48', 'Orange', '10', 100000000),
(1257, 'Dannies Supplies', '3M', 'Vinyl', 60, '48', 'Red', '10', 100000000),
(1258, 'Dannies Supplies', '3M', 'Vinyl', 60, '48', 'Pink', '10', 100000000),
(1259, 'Dannies Supplies', '3M', 'Vinyl', 60, '48', 'Purple', '10', 100000000),
(1260, 'Dannies Supplies', '3M', 'Vinyl', 60, '48', 'Blue', '10', 100000000),
(1261, 'Dannies Supplies', '3M', 'Vinyl', 60, '48', 'Green', '10', 100000000),
(1262, 'Dannies Supplies', '3M', 'Vinyl', 60, '48', 'Brown', '10', 100000000),
(1263, 'Dannies Supplies', '3M', 'Vinyl', 60, '48', 'Gray', '10', 100000000),
(1264, 'Dannies Supplies', '3M', 'Vinyl', 15, '6', 'White', '15', 100000000),
(1265, 'Dannies Supplies', '3M', 'Vinyl', 15, '6', 'Black', '15', 100000000),
(1266, 'Dannies Supplies', '3M', 'Vinyl', 15, '6', 'Yellow', '15', 100000000),
(1267, 'Dannies Supplies', '3M', 'Vinyl', 15, '6', 'Orange', '15', 100000000),
(1268, 'Dannies Supplies', '3M', 'Vinyl', 15, '6', 'Red', '15', 100000000),
(1269, 'Dannies Supplies', '3M', 'Vinyl', 15, '6', 'Pink', '15', 100000000),
(1270, 'Dannies Supplies', '3M', 'Vinyl', 15, '6', 'Purple', '15', 100000000),
(1271, 'Dannies Supplies', '3M', 'Vinyl', 15, '6', 'Blue', '15', 100000000),
(1272, 'Dannies Supplies', '3M', 'Vinyl', 15, '6', 'Green', '15', 100000000),
(1273, 'Dannies Supplies', '3M', 'Vinyl', 15, '6', 'Brown', '15', 100000000),
(1274, 'Dannies Supplies', '3M', 'Vinyl', 15, '6', 'Gray', '15', 100000000),
(1275, 'Dannies Supplies', '3M', 'Vinyl', 27, '12', 'White', '15', 100000000),
(1276, 'Dannies Supplies', '3M', 'Vinyl', 27, '12', 'Black', '15', 100000000),
(1277, 'Dannies Supplies', '3M', 'Vinyl', 27, '12', 'Yellow', '15', 100000000),
(1278, 'Dannies Supplies', '3M', 'Vinyl', 27, '12', 'Orange', '15', 100000000),
(1279, 'Dannies Supplies', '3M', 'Vinyl', 27, '12', 'Red', '15', 100000000),
(1280, 'Dannies Supplies', '3M', 'Vinyl', 27, '12', 'Pink', '15', 100000000),
(1281, 'Dannies Supplies', '3M', 'Vinyl', 27, '12', 'Purple', '15', 100000000),
(1282, 'Dannies Supplies', '3M', 'Vinyl', 27, '12', 'Blue', '15', 100000000),
(1283, 'Dannies Supplies', '3M', 'Vinyl', 27, '12', 'Green', '15', 100000000),
(1284, 'Dannies Supplies', '3M', 'Vinyl', 27, '12', 'Brown', '15', 100000000),
(1285, 'Dannies Supplies', '3M', 'Vinyl', 27, '12', 'Gray', '15', 100000000),
(1286, 'Dannies Supplies', '3M', 'Vinyl', 48, '24', 'White', '15', 100000000),
(1287, 'Dannies Supplies', '3M', 'Vinyl', 48, '24', 'Black', '15', 100000000),
(1288, 'Dannies Supplies', '3M', 'Vinyl', 48, '24', 'Yellow', '15', 100000000),
(1289, 'Dannies Supplies', '3M', 'Vinyl', 48, '24', 'Orange', '15', 100000000),
(1290, 'Dannies Supplies', '3M', 'Vinyl', 48, '24', 'Red', '15', 100000000),
(1291, 'Dannies Supplies', '3M', 'Vinyl', 48, '24', 'Pink', '15', 100000000),
(1292, 'Dannies Supplies', '3M', 'Vinyl', 48, '24', 'Purple', '15', 100000000),
(1293, 'Dannies Supplies', '3M', 'Vinyl', 48, '24', 'Blue', '15', 100000000),
(1294, 'Dannies Supplies', '3M', 'Vinyl', 48, '24', 'Green', '15', 100000000),
(1295, 'Dannies Supplies', '3M', 'Vinyl', 48, '24', 'Brown', '15', 100000000),
(1296, 'Dannies Supplies', '3M', 'Vinyl', 48, '24', 'Gray', '15', 100000000),
(1297, 'Dannies Supplies', '3M', 'Vinyl', 90, '48', 'White', '15', 100000000),
(1298, 'Dannies Supplies', '3M', 'Vinyl', 90, '48', 'Black', '15', 100000000),
(1299, 'Dannies Supplies', '3M', 'Vinyl', 90, '48', 'Yellow', '15', 100000000),
(1300, 'Dannies Supplies', '3M', 'Vinyl', 90, '48', 'Orange', '15', 100000000),
(1301, 'Dannies Supplies', '3M', 'Vinyl', 90, '48', 'Red', '15', 100000000),
(1302, 'Dannies Supplies', '3M', 'Vinyl', 90, '48', 'Pink', '15', 100000000),
(1303, 'Dannies Supplies', '3M', 'Vinyl', 90, '48', 'Purple', '15', 100000000),
(1304, 'Dannies Supplies', '3M', 'Vinyl', 90, '48', 'Blue', '15', 100000000),
(1305, 'Dannies Supplies', '3M', 'Vinyl', 90, '48', 'Green', '15', 100000000),
(1306, 'Dannies Supplies', '3M', 'Vinyl', 90, '48', 'Brown', '15', 100000000),
(1307, 'Dannies Supplies', '3M', 'Vinyl', 90, '48', 'Gray', '15', 100000000);

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
  ADD PRIMARY KEY (`OrderNumber`);

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
  MODIFY `InvoiceNumber` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100003;

--
-- AUTO_INCREMENT for table `order_table`
--
ALTER TABLE `order_table`
  MODIFY `OrderNumber` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=200020;

--
-- AUTO_INCREMENT for table `supply_table`
--
ALTER TABLE `supply_table`
  MODIFY `ItemID` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1308;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
