-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 04, 2024 at 02:05 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

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
  `bid_time` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bids`
--

INSERT INTO `bids` (`bid_id`, `product_id`, `user_id`, `bid_amount`, `bid_time`) VALUES
(1, 0, 0, 49, '0000-00-00'),
(2, 0, 3, 50, '0000-00-00'),
(3, 0, 3, 90, '2024-04-04'),
(4, 0, 3, 90, '2024-04-04'),
(5, 0, 3, 90, '2024-04-04'),
(6, 27, 3, 999999, '2024-04-04');

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
(9, 'satish', 'satish@gmail.com', 'satishsatish', 0);

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
(27, 'admin', 'damn', 'Painting', 'description', 33, 44, '2024-04-28 20:58:00', 'pic/IMG_5102.JPG', 1, ''),
(28, 'admin', 'patan', 'Painting', 'description', 45, 55, '2024-04-27 20:59:00', 'pic/IMG_5084.JPG', 1, ''),
(29, 'admin', 'patan', 'Fine Art', 'description', 60, 60, '2024-04-28 21:00:00', 'pic/IMG_4980.JPG', 1, ''),
(30, 'admin', 'basantapur', 'Painting', 'description', 33, 44, '2024-04-19 21:01:00', 'pic/IMG_5099.JPG', 1, ''),
(31, 'admin', 'ronash', 'Painting', 'description', 33, 22, '2024-04-03 22:17:00', 'pic/IMG_5066.JPG', 1, ''),
(32, 'admin', 'ronash', 'Painting', 'description', 55, 66, '2024-04-12 00:00:00', 'pic/IMG_5144.JPG', 1, ''),
(33, 'admin', 'damn', 'Painting', 'description', 44, 444, '2024-04-19 00:00:00', 'pic/IMG_4993.JPG', 1, ''),
(34, 'admin', 'ohm', 'Painting', 'description', 33, 44, '2024-04-27 00:00:00', 'pic/IMG_4990.JPG', 1, ''),
(36, 'Smriti', 'ronash', 'Painting', 'description', 44, 55, '2024-04-27 00:00:00', 'pic/IMG_4991.JPG', 3, 'ACTIVE');

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
  MODIFY `bid_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `login_data`
--
ALTER TABLE `login_data`
  MODIFY `user_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
