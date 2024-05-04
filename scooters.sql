-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2024 at 07:29 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `scooters`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(10) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`) VALUES
(1, 'admin', 'admin@admin.com', '$2y$10$0ATVgK8RPxpDsSnR7Kk7Ne/7y1/w4cIkPbrDsLNp9FK2VTubrUUDu');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `cust_id` int(11) NOT NULL,
  `cust_name` varchar(300) NOT NULL,
  `user_name` varchar(300) NOT NULL,
  `password` varchar(300) NOT NULL,
  `image` varchar(300) NOT NULL,
  `address` varchar(300) NOT NULL,
  `phone` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cust_id`, `cust_name`, `user_name`, `password`, `image`, `address`, `phone`) VALUES
(1, 'رهف محمد ', 'rahaf@gmail.com', '$2y$10$hblaxv1o/h/qSaQjBQgty.Kfzb5HbywGqXB01zlrno..pyRdTW2ly', '', 'المدينة المنورة', '55623255');

-- --------------------------------------------------------

--
-- Table structure for table `evaluation`
--

CREATE TABLE `evaluation` (
  `id` int(10) NOT NULL,
  `rate` int(10) NOT NULL,
  `comment` text NOT NULL,
  `scooter_id` int(10) NOT NULL,
  `customer_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `question_id` int(10) NOT NULL,
  `question_content` text NOT NULL,
  `question_date` date NOT NULL,
  `customer_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `rent_employee`
--

CREATE TABLE `rent_employee` (
  `employee_id` int(10) NOT NULL,
  `employee_name` varchar(300) NOT NULL,
  `employee_mail` varchar(300) NOT NULL,
  `employee_password` varchar(300) NOT NULL,
  `employee_phone` varchar(300) NOT NULL,
  `employee_address` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rent_employee`
--

INSERT INTO `rent_employee` (`employee_id`, `employee_name`, `employee_mail`, `employee_password`, `employee_phone`, `employee_address`) VALUES
(1, 'عبد العزيز محمد', 'abd@gmail..com', '$2y$10$iw/IX.SXef2A5d2vITmbDeXIPxZIheLnJQZvaxivvwivI76t2Caau', '55226333', 'المدينة');

-- --------------------------------------------------------

--
-- Table structure for table `scooter`
--

CREATE TABLE `scooter` (
  `scooter_id` int(10) NOT NULL,
  `scooter_name` varchar(255) NOT NULL,
  `scooter_type` varchar(255) NOT NULL,
  `scooter_model` varchar(255) NOT NULL,
  `scooter_color` varchar(250) NOT NULL,
  `scooter_brand` varchar(255) NOT NULL,
  `scooter_image` varchar(255) NOT NULL,
  `price_per_hour` int(10) NOT NULL,
  `description` text NOT NULL,
  `availability` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `scooter`
--

INSERT INTO `scooter` (`scooter_id`, `scooter_name`, `scooter_type`, `scooter_model`, `scooter_color`, `scooter_brand`, `scooter_image`, `price_per_hour`, `description`, `availability`) VALUES
(2, 'اسكوتر 2', 'واقف', '2011', 'اسود', 'بينيلي', 'uploads/scooters/3425917520.jpg', 10, 'اسكوتر جديد بحالة ممتازة', 'متاح');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cust_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`question_id`);

--
-- Indexes for table `rent_employee`
--
ALTER TABLE `rent_employee`
  ADD PRIMARY KEY (`employee_id`);

--
-- Indexes for table `scooter`
--
ALTER TABLE `scooter`
  ADD PRIMARY KEY (`scooter_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `cust_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `question_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rent_employee`
--
ALTER TABLE `rent_employee`
  MODIFY `employee_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `scooter`
--
ALTER TABLE `scooter`
  MODIFY `scooter_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
