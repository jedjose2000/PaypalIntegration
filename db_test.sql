-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 05, 2023 at 10:14 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblaccounts`
--

CREATE TABLE `tblaccounts` (
  `account_id` int(10) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblaccounts`
--

INSERT INTO `tblaccounts` (`account_id`, `username`, `password`, `email`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$10$W7YKbFixrE8/RNmojD2jyeS/KVKf1iRY8yhEzfhL0YGFVhb5nFCjK', 'jedjose2000@gmail.com', '2023-10-05 16:03:23', '2023-10-05 16:03:23'),
(2, 'jedjose2000', '$2y$10$HtFjwSa3vJRNIfHmdQzeXe.b53t30s0yGODhDIeZDPH/Ub5bvrBUi', 'jeanmagudo@yahoo.com', '2023-10-05 16:04:43', '2023-10-05 16:04:43');

-- --------------------------------------------------------

--
-- Table structure for table `tblorderhistory`
--

CREATE TABLE `tblorderhistory` (
  `orderId` int(10) NOT NULL,
  `orderDate` datetime NOT NULL,
  `accountId` int(10) NOT NULL,
  `itemName` varchar(50) NOT NULL,
  `totalPrice` double NOT NULL,
  `initialprice` double NOT NULL,
  `quantity` int(10) NOT NULL,
  `paymentType` varchar(10) NOT NULL,
  `refNum` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblorderhistory`
--

INSERT INTO `tblorderhistory` (`orderId`, `orderDate`, `accountId`, `itemName`, `totalPrice`, `initialprice`, `quantity`, `paymentType`, `refNum`) VALUES
(1, '2023-10-05 16:12:29', 1, 'Frappuccino - Cold', 1950, 150, 13, 'Paypal', '3EM22200VE826560F');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblaccounts`
--
ALTER TABLE `tblaccounts`
  ADD PRIMARY KEY (`account_id`);

--
-- Indexes for table `tblorderhistory`
--
ALTER TABLE `tblorderhistory`
  ADD PRIMARY KEY (`orderId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblaccounts`
--
ALTER TABLE `tblaccounts`
  MODIFY `account_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblorderhistory`
--
ALTER TABLE `tblorderhistory`
  MODIFY `orderId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
