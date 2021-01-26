-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 17, 2021 at 05:54 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stock`
--

-- --------------------------------------------------------

--
-- Table structure for table `addstock`
--

CREATE TABLE `addstock` (
  `id` int(11) NOT NULL,
  `stockname` varchar(100) NOT NULL,
  `quantity` float NOT NULL,
  `stockexchange` varchar(100) NOT NULL,
  `marketprice` float NOT NULL,
  `products` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `addstock`
--

INSERT INTO `addstock` (`id`, `stockname`, `quantity`, `stockexchange`, `marketprice`, `products`, `username`) VALUES
(2, 'sanjay', 1, 'NSE', 44, '1', ''),
(3, 'sanjay', 1, 'NSE', 44, '1', ''),
(4, 'sanjay', 1, 'BSE', 67, '1', ''),
(5, 'sanjay', 1, 'BSE', 67, '1', ''),
(7, 'alvas pharma', 2000, 'BSE', 456.7, 'Delivery', ''),
(8, 'alvas pharma', 2000, 'BSE', 456.7, 'Delivery', ''),
(9, 'sbi', 500, 'BSE', 306, 'Delivery', ''),
(10, 'sbi', 500, 'BSE', 306, 'Delivery', 'growmore'),
(11, 'sbi', 12, 'NSE', 201, 'Delivery', 'growmore'),
(12, 'alvas pharma', 2060, 'NSE', 78, 'Delivery', 'growmore'),
(13, 'Sun pharma ', 5000000, 'BSE', 567.98, 'Delivery', 'growmore'),
(14, 'ITC', 10, 'NSE', 210, 'Delivery', 'growmore'),
(15, 'ITC', 10, 'NSE', 210, 'Delivery', 'growmore'),
(16, 'ITC', 10, 'NSE', 210, 'Delivery', 'growmore'),
(17, 'ITC', 10, 'NSE', 210, 'Delivery', 'growmore'),
(18, 'ITC', 10, 'NSE', 210, 'Delivery', 'growmore'),
(19, 'ITC', 10, 'NSE', 210, 'Delivery', 'growmore'),
(20, 'ITC', 10, 'NSE', 210, 'Delivery', 'growmore'),
(21, 'ITC', 10, 'NSE', 210, 'Delivery', 'growmore'),
(22, 'ITC', 10, 'NSE', 210, 'Delivery', 'growmore'),
(23, 'ITC', 10, 'NSE', 210, 'Delivery', 'growmore'),
(24, 'ITC', 10, 'NSE', 210, 'Delivery', 'growmore'),
(25, 'ITC', 10, 'NSE', 210, 'Delivery', 'growmore');

-- --------------------------------------------------------

--
-- Stand-in structure for view `bseinvestment`
-- (See below for the actual view)
--
CREATE TABLE `bseinvestment` (
`sum(marketprice)` double
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `NSE`
-- (See below for the actual view)
--
CREATE TABLE `NSE` (
`sum(marketprice)` double
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `nseinvestvment`
-- (See below for the actual view)
--
CREATE TABLE `nseinvestvment` (
`COUNT(id)` bigint(21)
);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(150) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `fname`, `lname`, `gender`, `mobile`, `address`, `email`, `username`, `password`) VALUES
(1, 'sanjay', 'mahto', 'male', '636091821', 'hi how are u bhootnike', 'sanjay.sm347@gmail.com', 'sanjay', 'hisanjay'),
(3, 'ajay', 'mahto', 'Male', '7878787878', 'fdhkhklmnvkj', 'aj.@347.com', 'ak', 'hiak'),
(4, 'shivraj', 'nandyal', 'Male', '6767676767', 'kbncxnvlm;l', 'ak@aj234gmail.com', 'sk', 'hisk'),
(5, 'praveen', 'm', 'Male', '8095914071', 'bangolre', 'praveen@gmail.com', 'praveen12', 'praveen'),
(6, 'Harshad', 'mehta', 'Male', '8095914071', 'bangalore', 'pk@gmail.com', 'growmore', 'money');

-- --------------------------------------------------------

--
-- Structure for view `bseinvestment`
--
DROP TABLE IF EXISTS `bseinvestment`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `bseinvestment`  AS SELECT sum(`addstock`.`marketprice`) AS `sum(marketprice)` FROM `addstock` WHERE `addstock`.`stockexchange` = 'BSE' ;

-- --------------------------------------------------------

--
-- Structure for view `NSE`
--
DROP TABLE IF EXISTS `NSE`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `NSE`  AS SELECT sum(`addstock`.`marketprice`) AS `sum(marketprice)` FROM `addstock` WHERE `addstock`.`stockexchange` = 'NSE' ;

-- --------------------------------------------------------

--
-- Structure for view `nseinvestvment`
--
DROP TABLE IF EXISTS `nseinvestvment`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `nseinvestvment`  AS SELECT count(`addstock`.`id`) AS `COUNT(id)` FROM `addstock` WHERE `addstock`.`stockexchange` = 'NSE' ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addstock`
--
ALTER TABLE `addstock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addstock`
--
ALTER TABLE `addstock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
