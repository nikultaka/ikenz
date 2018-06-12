-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2018 at 11:07 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mukund`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(250) NOT NULL,
  `email` varchar(20) NOT NULL,
  `password` varchar(250) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`, `status`) VALUES
(1, 'mukundrana@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 1);

-- --------------------------------------------------------

--
-- Table structure for table `gold_price`
--

CREATE TABLE `gold_price` (
  `id` int(10) NOT NULL,
  `gold_price` float NOT NULL,
  `cgst` float NOT NULL,
  `sgst` float NOT NULL,
  `igst` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gold_price`
--

INSERT INTO `gold_price` (`id`, `gold_price`, `cgst`, `sgst`, `igst`) VALUES
(1, 10000, 1, 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `id` int(200) NOT NULL,
  `item_name` varchar(250) NOT NULL,
  `item_des` varchar(250) NOT NULL,
  `item_quantity` int(250) NOT NULL,
  `is_delete` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id`, `item_name`, `item_des`, `item_quantity`, `is_delete`) VALUES
(1, 'Ring', 'Silver', 0, 1),
(2, 'Ring Gold', 'Gold', 4, 0),
(24, 'Test name', 'test description testing', 1, 0),
(25, 'Bracelate', 'Gold', 2, 0),
(27, 'abc', 'xyz', 45, 1),
(34, 'abc', 'xyz', 4, 0),
(35, 'abc', 'xyz', 4, 1),
(36, 'abc', 'xyz', 4, 1),
(37, 'abc', 'xyz', 45, 1),
(38, 'xyz', 'abc', 3, 1),
(39, 'fd', '    \r\n         dsf                   ', 1, 0),
(40, 'Ring Gold', 'Gold', 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(250) NOT NULL,
  `customer_id` int(250) NOT NULL,
  `sub_total` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `cgst` decimal(10,2) NOT NULL,
  `sgst` decimal(10,2) NOT NULL,
  `igst` decimal(10,2) NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `customer_id`, `sub_total`, `total`, `cgst`, `sgst`, `igst`, `created_date`) VALUES
(1, 1, '122220.00', '126000.00', '1260.00', '2520.00', '0.00', '2018-05-26 13:23:44'),
(2, 1, '114570.00', '120600.00', '0.00', '2412.00', '3618.00', '2018-05-26 13:24:23'),
(3, 1, '57285.00', '60300.00', '0.00', '1206.00', '1809.00', '2018-05-26 13:26:42');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(250) NOT NULL,
  `order_id` int(250) NOT NULL,
  `item_id` int(250) NOT NULL,
  `item_gram` decimal(5,2) NOT NULL,
  `item_price` decimal(10,2) NOT NULL,
  `labour_charge` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `item_id`, `item_gram`, `item_price`, `labour_charge`) VALUES
(1, 1, 1, '1.00', '20000.00', '1000.00'),
(2, 1, 2, '2.00', '40000.00', '2000.00'),
(3, 1, 24, '3.00', '60000.00', '3000.00'),
(4, 2, 1, '1.00', '20000.00', '100.00'),
(5, 2, 2, '2.00', '40000.00', '200.00'),
(6, 2, 25, '3.00', '60000.00', '300.00'),
(7, 3, 25, '1.00', '20000.00', '100.00'),
(8, 3, 24, '2.00', '40000.00', '200.00');

-- --------------------------------------------------------

--
-- Table structure for table `user_management`
--

CREATE TABLE `user_management` (
  `id` int(250) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone_no` int(10) NOT NULL,
  `gst_no` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_management`
--

INSERT INTO `user_management` (`id`, `first_name`, `last_name`, `email`, `phone_no`, `gst_no`) VALUES
(1, 'mukund', 'rana', 'mukund@gmail.com', 1234567894, '12345'),
(4, 'abc', 'xyz', 'hg@h.comm', 2147483647, 'ggb'),
(20, 'mukund', 'rana', 'mukund@gmail.comm', 2147483647, '12345'),
(23, 'yugu', 'j', 'mukund1@gmail.com', 1234567890, 'dsfsdgds');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gold_price`
--
ALTER TABLE `gold_price`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_management`
--
ALTER TABLE `user_management`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `gold_price`
--
ALTER TABLE `gold_price`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_management`
--
ALTER TABLE `user_management`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
