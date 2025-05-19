-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2025 at 01:37 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phpgallery`
--

-- --------------------------------------------------------

--
-- Table structure for table `bids`
--

CREATE TABLE `bids` (
  `bid_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `bid_amount` int(11) NOT NULL,
  `bid_time` date NOT NULL,
  `bid_status` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bids`
--

INSERT INTO `bids` (`bid_id`, `product_id`, `user_id`, `bid_amount`, `bid_time`, `bid_status`) VALUES
(7, 38, 3, 600, '2025-05-13', 'DELETED'),
(8, 39, 3, 500, '2025-05-13', 'NORMAL'),
(9, 40, 3, 20, '2025-05-13', 'DELETED'),
(10, 38, 4, 550, '2025-05-13', 'DELETED'),
(11, 39, 4, 6000, '2025-05-13', 'NORMAL'),
(12, 40, 4, 20, '2025-05-13', 'DELETED'),
(14, 42, 3, 9000, '2025-05-13', 'NORMAL');

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `user_id` int(11) NOT NULL,
  `username` varchar(150) NOT NULL,
  `Email` varchar(150) NOT NULL,
  `Category` varchar(150) NOT NULL,
  `Complaint` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `complaints`
--

INSERT INTO `complaints` (`user_id`, `username`, `Email`, `Category`, `Complaint`) VALUES
(2, 'ASHOK', 'gebapej287@bamsrad.com', 'Painting', 0),
(3, 'Smriti', 'gebapej287@bamsrad.com', 'Painting', 0);

-- --------------------------------------------------------

--
-- Table structure for table `login_data`
--

CREATE TABLE `login_data` (
  `user_id` int(30) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `usertype` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login_data`
--

INSERT INTO `login_data` (`user_id`, `username`, `email`, `password`, `usertype`) VALUES
(1, 'admin', 'admin@GMAIL.COM', 'admin12345', 1),
(2, 'ASHOK', 'ashokranjitkar228@gmail.com', '9841794227', 0),
(3, 'Smriti', 'admin@123.com', 'smriti123', 0),
(4, 'ronash', 'ronash@gmail.com', 'ronash12345', 0),
(5, 'RIYAZ', '_RIYAZ@GMAI.COM', 'ASDFASDF', 0),
(6, 'dhiran', 'dhiran@gmail.com', 'asdfasdf', 0),
(7, 'miti1', 'mitiman@gmail.com', '11111111', 0),
(8, 'kelvin', 'kelvin@gmail.com', 'asdfasdf', 0),
(9, 'satish', 'satish@gmail.com', 'satishsatish', 2);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `product_name` varchar(200) NOT NULL,
  `category` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `start_bid` float NOT NULL,
  `regular_price` float NOT NULL,
  `Bid_end` datetime NOT NULL,
  `P_image` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `username`, `product_name`, `category`, `description`, `start_bid`, `regular_price`, `Bid_end`, `P_image`, `user_id`, `product_status`) VALUES
(43, 'ASHOK', 'testing ', 'Painting', 'testing', 55, 66, '2025-05-17 00:00:00', 'pic/IMG_7510.JPG', 2, 'ACTIVE'),
(44, 'ASHOK', 'testing 2', 'Painting', 'testing 2', 55, 66, '2025-05-17 00:00:00', 'pic/IMG_7461.JPG', 2, 'ACTIVE');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bids`
--
ALTER TABLE `bids`
  ADD PRIMARY KEY (`bid_id`);

--
-- Indexes for table `login_data`
--
ALTER TABLE `login_data`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bids`
--
ALTER TABLE `bids`
  MODIFY `bid_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `login_data`
--
ALTER TABLE `login_data`
  MODIFY `user_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
