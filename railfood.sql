-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 22, 2018 at 01:10 PM
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

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `train_no`, `user_id`, `food_id`, `total_no`, `price`, `total_price`, `add_date`) VALUES
(5, '12381', 2, 10, 1, 60, 60, '2018-08-22'),
(7, '12381', 2, 12, 3, 40, 120, '2018-08-22'),
(6, '12381', 2, 13, 1, 55, 55, '2018-08-22');

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
(1, 1, '12381', 'Example', 'Example text.......................................................................................................................................................................................................................................................................', '2018-08-21', '12:12:29', 0, '');

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
(4, '12382', 'PLAIN RICE', NULL, 'veg, lunch', 30, 'default.jpg'),
(5, '12381', 'SANDWICH', 'a healthy & testy food with creamy cheese', 'breakfast,veg', 50, '../food/sandwich.jpg'),
(6, '12381', 'tea', 'Normal Tea', 'snacks', 20, '../food/tea.jpg'),
(7, '12381', 'COFFEE', 'normal  coffee', 'snacks', 30, '../food/COFFEE.jpg'),
(8, '12381', 'PAAV-VAJI', 'masala pow', 'breakfast', 35, '../food/PAAV-VAJI.jpg'),
(9, '12381', 'SAMOOSA', 'normal samoosa', 'snacks', 25, '../food/SAMOOSA.jpg'),
(10, '12381', 'RICE', 'veg rice,non veg rice', 'lunch(veg/non veg),dinner(veg/non veg)', 60, '../food/RICE.jpg'),
(11, '12381', 'BIRYANI', 'chicken/mutton', 'lunch,dinner', 120, '../food/BIRYANI.jpg'),
(12, '12381', 'IDLI', 'normal idli', 'breakfast', 40, '../food/IDLI.jpg'),
(13, '12381', 'DOSA', 'plane & masala dosa', 'snacks', 55, '../food/DOSA.jpg'),
(14, '12381', 'SOFT DRINKS', 'all kind of soft drinks', 'snacks', 30, '../food/SOFT DRINKS.jpg');

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
(1, '12381', '1', 1, 1, 135, 135, '2018-08-16', '17:36:33', NULL, 'E7', '35', 0),
(2, '12381', '1', 2, 2, 20, 40, '2018-08-16', '17:36:33', NULL, 'E7', '35', 1),
(3, '12381', '2', 10, 2, 60, 120, '2018-08-22', '13:59:06', NULL, 'E7', '35', 1),
(4, '12381', '2', 11, 1, 120, 120, '2018-08-22', '14:04:42', NULL, 'C5', '49', 2),
(5, '12381', '2', 10, 2, 60, 120, '2018-08-22', '14:40:37', NULL, 'E7', '49', 0),
(6, '12381', '2', 11, 1, 120, 120, '2018-08-22', '14:40:37', NULL, 'E7', '49', 0);

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
(3, '12381', 2, '2018-08-21'),
(5, '12381', 10, '2018-08-22'),
(6, '12381', 11, '2018-08-22'),
(7, '12381', 12, '2018-08-22'),
(8, '12381', 13, '2018-08-22');

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
(1, 'Kousik Mitra', 'kousikmitra12@gmail.com', '8b01bb02da6b4dc4873f124d679861a4', '8145169168', 'Bagnan'),
(2, 'Sankha Ghosh', 'sankharaj@gmail.com', 'bc2104ac8914711f2e9d0c1cf4283b2d', '9564690930', 'PAnskura');

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
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `complain`
--
ALTER TABLE `complain`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
  MODIFY `food_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `order_food`
--
ALTER TABLE `order_food`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `todaymenu`
--
ALTER TABLE `todaymenu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `train_route`
--
ALTER TABLE `train_route`
  MODIFY `train_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12861;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
