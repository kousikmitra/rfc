-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 23, 2018 at 02:29 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `railfood`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `u_id` varchar(11) NOT NULL,
  `password` varchar(100) NOT NULL,
  `train_no` varchar(8) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`u_id`, `password`, `train_no`, `name`) VALUES
('admin', 'admin', '12381', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `train_no` varchar(8) NOT NULL,
  `user_id` int(11) NOT NULL,
  `food_id` int(11) NOT NULL,
  `total_no` int(11) NOT NULL,
  `price` float NOT NULL,
  `total_price` float NOT NULL,
  `add_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `complain`
--

CREATE TABLE `complain` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `train_no` varchar(8) NOT NULL,
  `complain_name` text NOT NULL,
  `complain_text` text NOT NULL,
  `complain_date` date NOT NULL,
  `complain_time` time NOT NULL,
  `status` int(11) NOT NULL,
  `response` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `complain`
--

INSERT INTO `complain` (`id`, `user_id`, `train_no`, `complain_name`, `complain_text`, `complain_date`, `complain_time`, `status`, `response`) VALUES
(1, 1, '12381', 'Example', 'Example text.......................................................................................................................................................................................................................................................................', '2018-08-21', '12:12:29', 0, ''),
(2, 1, '12381', 'Complain Example', 'This is a complain', '2018-08-22', '19:31:20', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `food_id` int(11) NOT NULL,
  `train_no` varchar(10) NOT NULL,
  `food_name` varchar(100) NOT NULL,
  `food_desc` text,
  `food_category` varchar(100) NOT NULL,
  `food_price` float NOT NULL,
  `food_image` varchar(100) NOT NULL DEFAULT 'default.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`food_id`, `train_no`, `food_name`, `food_desc`, `food_category`, `food_price`, `food_image`) VALUES
(1, '12381', 'VEG FRIED RICE', 'Mixed Veg Fried Rice', 'veg, lunch, dinner', 140, '../food/default.jpg'),
(2, '12381', 'WATER 1lt', NULL, '', 20, '../food/default.jpg'),
(4, '12382', 'PLAIN RICE', NULL, 'veg, lunch', 30, 'default.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `forgotpass`
--

CREATE TABLE `forgotpass` (
  `email` varchar(30) NOT NULL,
  `otp` varchar(5) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `order_food`
--

CREATE TABLE `order_food` (
  `order_id` int(11) NOT NULL,
  `train_no` varchar(8) NOT NULL,
  `user_id` varchar(10) NOT NULL,
  `food_id` int(11) NOT NULL,
  `total_no` float NOT NULL,
  `price` float NOT NULL,
  `total_price` float NOT NULL,
  `order_date` date NOT NULL,
  `order_time` time NOT NULL,
  `pnr` varchar(15) DEFAULT NULL,
  `coach_no` varchar(5) DEFAULT NULL,
  `seat_no` varchar(5) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_food`
--

INSERT INTO `order_food` (`order_id`, `train_no`, `user_id`, `food_id`, `total_no`, `price`, `total_price`, `order_date`, `order_time`, `pnr`, `coach_no`, `seat_no`, `status`) VALUES
(1, '12381', '1', 1, 1, 135, 135, '2018-08-22', '17:36:33', NULL, 'E7', '35', 0),
(2, '12381', '1', 2, 2, 20, 40, '2018-08-22', '17:36:33', NULL, 'E7', '35', 1);

-- --------------------------------------------------------

--
-- Table structure for table `todaymenu`
--

CREATE TABLE `todaymenu` (
  `id` int(11) NOT NULL,
  `train_no` varchar(8) NOT NULL,
  `food_id` int(11) NOT NULL,
  `today` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `todaymenu`
--

INSERT INTO `todaymenu` (`id`, `train_no`, `food_id`, `today`) VALUES
(3, '12381', 2, '2018-08-21');

-- --------------------------------------------------------

--
-- Table structure for table `train_route`
--

CREATE TABLE `train_route` (
  `train_no` int(11) NOT NULL,
  `train_name` varchar(50) NOT NULL,
  `src` varchar(8) NOT NULL,
  `dest` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `train_route`
--

INSERT INTO `train_route` (`train_no`, `train_name`, `src`, `dest`) VALUES
(12301, 'Howrah - New Delhi Rajdhani Express (via Gaya)', 'HWH', 'NDLS'),
(12381, 'Poorva Express (via Gaya) (PT)', 'HWH', 'NDLS'),
(12387, 'Howrah - Puri Superfast Express', 'HWH', 'PURI'),
(12860, 'Gitanjali Express (PT)', 'HWH', 'CSTM');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `u_id` int(11) NOT NULL,
  `u_name` varchar(30) NOT NULL,
  `u_email` varchar(30) NOT NULL,
  `u_password` varchar(100) NOT NULL,
  `u_phone` varchar(10) NOT NULL,
  `u_address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`u_id`, `u_name`, `u_email`, `u_password`, `u_phone`, `u_address`) VALUES
(1, 'Sankha Ghosh', 'sankharaj@gmail.com', '8b01bb02da6b4dc4873f124d679861a4', '8b01bb02da', 'Bagnan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`u_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`train_no`,`user_id`,`food_id`),
  ADD UNIQUE KEY `cart_id` (`cart_id`);

--
-- Indexes for table `complain`
--
ALTER TABLE `complain`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`food_id`);

--
-- Indexes for table `forgotpass`
--
ALTER TABLE `forgotpass`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `order_food`
--
ALTER TABLE `order_food`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `todaymenu`
--
ALTER TABLE `todaymenu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `train_route`
--
ALTER TABLE `train_route`
  ADD PRIMARY KEY (`train_no`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`u_id`),
  ADD UNIQUE KEY `u_email` (`u_email`),
  ADD UNIQUE KEY `u_phone` (`u_phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `complain`
--
ALTER TABLE `complain`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
  MODIFY `food_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `order_food`
--
ALTER TABLE `order_food`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `todaymenu`
--
ALTER TABLE `todaymenu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `train_route`
--
ALTER TABLE `train_route`
  MODIFY `train_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12861;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
