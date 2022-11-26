-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2022 at 10:21 AM
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
  `UserID` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `CustomerID` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Name` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Surname` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Role` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Salary` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `OT` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`UserID`, `CustomerID`, `Name`, `Surname`, `Role`, `Salary`, `OT`) VALUES
('U1efbc797c7174dd636c047f5ca8eba42', '123ABCD', 'กวนซ้น', 'แซ่เตียน', '', '', ''),
('', 'DJ0001', 'DR.JEL', 'Pannawit', 'Supervisor', '1000000', '999999'),
('U7d6ab1d8497e4a799721a05c0f0458d3', 'IT0231', 'นายศรัณย์สุข', 'ยิ้มย่อง', 'Developer', '13000', '7000'),
('', 'SN1414', 'กุลสตรี', 'แตงโสภา', 'In my heart', '141414', '1414');

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
('U1efbc797c7174dd636c047f5ca8eba42', 'สวัสดีครับ', '1564327729309'),
('U1efbc797c7174dd636c047f5ca8eba42', 'ทพสอบ', '1564327735236'),
('U1efbc797c7174dd636c047f5ca8eba42', 'Hello 1234', '1564327738324'),
('U1efbc797c7174dd636c047f5ca8eba42', 'สวัสดีครับ', '1564327924023'),
('U1efbc797c7174dd636c047f5ca8eba42', 'Yo', '1564328241209'),
('U7d6ab1d8497e4a799721a05c0f0458d3', 'salary', '1669452462345'),
('U7d6ab1d8497e4a799721a05c0f0458d3', 'register', '1669452464409'),
('U7d6ab1d8497e4a799721a05c0f0458d3', 'register', '1669452489778'),
('U7d6ab1d8497e4a799721a05c0f0458d3', 'รหัส:IT0231', '1669452494184'),
('U7d6ab1d8497e4a799721a05c0f0458d3', 'salary', '1669452500984'),
('U7d6ab1d8497e4a799721a05c0f0458d3', 'salary', '1669452558365'),
('Ub73170dfc953cda9cfc254ec2d8aafc6', 'register', '1669453110684');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`CustomerID`(5));

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`Timestamp`(15));
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
