-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 25, 2025 at 12:48 PM
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
(17, 47, 17, 60, '2025-05-31', 'NORMAL'),
(18, 47, 16, 545, '2025-05-31', 'NORMAL'),
(19, 47, 15, 554, '2025-05-31', 'NORMAL'),
(20, 49, 17, 5000000, '2025-05-31', 'DELETED'),
(22, 50, 16, 60, '2025-06-02', 'NORMAL'),
(23, 51, 17, 55, '2025-06-02', 'NORMAL'),
(24, 52, 17, 100, '2025-06-02', 'NORMAL'),
(25, 51, 16, 350, '2025-06-02', 'NORMAL'),
(26, 52, 16, 100, '2025-06-02', 'NORMAL'),
(28, 52, 19, 100, '2025-06-02', 'NORMAL'),
(29, 51, 19, 55, '2025-06-02', 'NORMAL'),
(30, 53, 16, 55, '2025-06-04', 'NORMAL'),
(31, 56, 16, 60, '2025-06-10', 'NORMAL');

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
(3, 'Smriti', 'gebapej287@bamsrad.com', 'Painting', 0),
(16, 'Ashok', 'alskdfj@gmail.com', 'Painting', 0);

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
(11, 'Admin', 'Admin@gmail.com', '$2y$10$psqWH.UAvGO6HKBdMW1Y8OCXxwaFyaF5ZRGa9o7wkigRhki2FpnIa', 1),
(16, 'Ashok', 'ashokranjitkar228@gmail.com', '$2y$10$p/y5j/Xa2n0rwBwGegXVkO1MZC.IBFUoarCAgsjMhWJD9iMuwXoqG', 0),
(17, 'Kelvin', 'kelvin456@gmail.com', '$2y$10$9R/SYVoQmy4g9koGdCeHh./06EpOjaqx08Wq7Hg/gdmcDTILwI1mq', 0),
(18, 'Dummy', 'dummy@gmail.com', '$2y$10$1HTZrZqxry2hAvVtwS0PH.RdNBfwe6M.cmsa.B5jheQSK5n1aWMm2', 0),
(19, 'Smriti', 'Smriti@gmail.com', '$2y$10$BjBHYREm7SJEIeP4IdWljOnjtZ80EGITuXZ9lY.iIpk87//wFy.Ki', 0);

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
  `Bid_end` datetime NOT NULL,
  `P_image` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `username`, `product_name`, `category`, `description`, `start_bid`, `Bid_end`, `P_image`, `user_id`, `product_status`) VALUES
(48, 'ronash', 'kelvin dai ko photo', 'Painting', 'description', 23123, '2025-06-24 00:00:00', 'pic/RemitPe thankyou dfs and seamless.jpg', 15, 'DELETED'),
(49, 'Ashok', 'ashok', 'Painting', 'description', 1233310, '2025-06-26 00:00:00', 'pic/shared image.jpeg', 16, 'DELETED'),
(50, 'Kelvin', 'lion', 'Painting', 'lion', 55, '2025-06-28 00:00:00', 'pic/ChatGPT Image May 28, 2025, 04_10_38 PM.png', 17, 'DELETED'),
(51, 'Dummy', 'Test (Bid Winner Ashok)', 'Painting', 'Bid Winner Ashok', 55, '2025-02-05 00:00:00', 'pic/lion.jpg', 18, 'ACTIVE'),
(52, 'Dummy', 'Test (Same Amount)', 'Painting', 'Test Same Amount ', 55, '2025-03-04 00:00:00', 'pic/mountain.jpg', 18, 'ACTIVE'),
(53, 'Dummy', 'Dummy 1', 'Painting', 'dummy 1', 50, '2032-12-17 00:00:00', 'pic/panda.jpg', 18, 'ACTIVE'),
(54, 'Dummy', 'Dummy 2', 'Painting', 'dummy 2', 50, '2032-12-17 00:00:00', 'pic/raindeer.jpg', 18, 'ACTIVE'),
(55, 'Dummy', 'lava mountain', 'Sculpture', 'digital picture of lava mountain', 100, '2025-08-14 00:00:00', 'pic/lava mountain.jpg', 18, 'ACTIVE'),
(56, 'Dummy', 'test 5', 'Painting', 'description', 55, '2025-06-11 00:00:00', 'pic/terrain.jpg', 18, 'ACTIVE'),
(57, 'Dummy', 'date and time', 'Painting', 'description', 55, '2025-07-25 17:16:00', 'pic/25th july remitpe.jpg', 18, 'ACTIVE');

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
  MODIFY `bid_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `login_data`
--
ALTER TABLE `login_data`
  MODIFY `user_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
