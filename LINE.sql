-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2022 at 08:40 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `line`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `UserID` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `CustomerID` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Name` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Surname` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Role` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Salary` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `OT` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Picture` text CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `UserID`, `CustomerID`, `Name`, `Surname`, `Role`, `Salary`, `OT`, `Picture`) VALUES
(1, '', 'DJ0001', 'DR.JEL', 'Pannawit', 'Supervisor', '1000000', '999999', ''),
(2, 'U7d6ab1d8497e4a799721a05c0f0458d3', 'IT0231', 'นายศรัณย์สุข', 'ยิ้มย่อง', 'Programmer', '15000', '7000', 'https://profile.line-scdn.net/0he-9_oh7YOgIEJi97xdBFVThjNG9zCDxKfEAgZXMiMzovRXVdO0YiMHEhYDErQigBMRAlMSckMGYh'),
(3, NULL, 'SN11405', 'aszas', 'fdree', 'Developer', '20000', '1000', NULL),
(4, '', 'SN1414', 'กุลสตรี', 'แตงโสภา', 'In my heart', '141414', '1414', '');

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `UserID` text COLLATE utf8_unicode_ci NOT NULL,
  `Text` text COLLATE utf8_unicode_ci NOT NULL,
  `Timestamp` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`UserID`, `Text`, `Timestamp`) VALUES
('U1efbc797c7174dd636c047f5ca8eba42', 'สวัสดีครับ', '1564327729309');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
