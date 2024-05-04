-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2024 at 04:24 AM
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
(1, 'رهف محمد ', 'rahaf@gmail.com', '$2y$10$hblaxv1o/h/qSaQjBQgty.Kfzb5HbywGqXB01zlrno..pyRdTW2ly', '', 'المدينة المنورة', '55623255'),
(3, 'asmaa', 'asmaa@gmail.com', '$2y$10$.NCiN1z/xOpFSzzvpjp0J.OFzn18OeVT388BsCCqqF2HArYfYSZiq', '', 'hgl]dkm', '888888'),
(4, 'ايمان ', 'eman@gmail.com', '$2y$10$H1DoTaTcxnSDLtaUfCrupumDxvfgZ.JCPVy8qY2yTZCbl3A/fvvI2', '', 'المدينة المنورة', '8888888888'),
(5, 'younis', 'yo@gmail.com', '$2y$10$zeJLdDFPeAl23nmvFgvd6.9Zj3doBM0JSMgot5WtWCvO5W6GGo1xq', '', 'المدينة المنورة', '55623255'),
(6, 'tota', 'tota@gmail.com', '$2y$10$UFkMxjQ9pMe6ri0u9mlcg.12vd6q6e0DszGecIXkpcpO.RQr8VmKG', '', 'المدينة المنورة', '8520852'),
(7, 'mariam', 'mariam@gmail.com', '$2y$10$EqAfZLl4Uvw6lwgt/PoC1ez9ablBuxQ98rxaUNaop5mBxp58IK0KS', '', 'المدينة المنورة', '8520852'),
(8, 'ahmed', 'ah@gmail.com', '$2y$10$yPfGh5.hqZI7szLx59YEGujSuZA/KkyTCo3538IB3EpyF40jdBeMC', '', 'hgl]dkm', '8520852'),
(9, 'mohamed', 'mohamed@gmail.com', '$2y$10$UDrGVfAYUEYUuXxlcU10xe/hjgZ7TlDiENYZXxW9.LTg1U8aiAiDW', '', 'المدينة المنورة', '8520852');

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

--
-- Dumping data for table `evaluation`
--

INSERT INTO `evaluation` (`id`, `rate`, `comment`, `scooter_id`, `customer_id`) VALUES
(1, 2, '', 6, 1),
(2, 3, 'جيد', 2, 1),
(3, 3, 'جيد', 6, 3);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `question_id` int(10) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `subject` varchar(300) NOT NULL,
  `question_content` text NOT NULL,
  `question_date` date NOT NULL,
  `customer_id` int(10) NOT NULL,
  `question_answer` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`question_id`, `customer_name`, `email`, `phone`, `subject`, `question_content`, `question_date`, `customer_id`, `question_answer`) VALUES
(1, 'رهف محمد', 'rahaf@gmail.com', '+966552255', 'تأجير الاسكوتر الاحمر', 'هل يمكن التأجير لفترات كبيرة', '2024-04-19', 1, 'لا يمكن'),
(2, 'رهف محمد احمد', 'rahaf@gmail.com', '775', '', '', '2024-04-23', 1, 'jjjjj'),
(3, 'رهف محمد احمد', 'rahaf@gmail.com', '85252', 'اسكوتر 22', 'ئءؤرالاتىنةموكزظيبلاتنمكط\r\n', '2024-04-23', 1, 'mmmm'),
(5, 'ااااا', 'w@gmail.cok', '410', 'اااااااااا', 'لالالالالالالالالالالالالالالالالا', '2024-04-30', 0, ''),
(6, 'hhhh', 'asmaa@gmail.com', '777', 'nnnn', 'xcvbnmlooo', '2024-05-01', 3, 'bbbb'),
(7, 'nnnnn', 'asmaa@gmail.com', '777777777777', 'jjjjjjjjjjjjjjjjjjj', 'mmmmmmmmmmmmm', '2024-05-03', 3, ''),
(8, 'kkkkkkkkk', 'w@gmail.cok', '5555555555555', 'jjjjjjjjjjjjjj', 'jjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjj', '2024-05-03', 3, ''),
(9, 'ىىىىىىىىى', 'sahar@gmail.com', '8888888888888888888', 'نننننننننننننننننن', 'ننننننننننننننننن', '2024-05-03', 3, '');

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
(1, 'عبد العزيز محمد', 'abd@gmail.com', '$2y$10$ZvDwf6dtQIcRa.QY0Tngo.S0RyUvIEiFUsejy89XKpu1yIcYEvid6', '55226333', 'المدينة'),
(3, 'عبد الله', 'abdul@gmail.com', '$2y$10$q0tL1uZ.gCZ/MxWM.Sq07ejc.cBRaV8VOLaND/xmLjmTEwbbLZzz.', '9665222855', 'المدينة');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `reservation_id` int(10) NOT NULL,
  `reservation_date` date NOT NULL,
  `from_time` time DEFAULT NULL,
  `to_time` time DEFAULT NULL,
  `total_price` double NOT NULL DEFAULT 0,
  `status` enum('new','accepted','refused','ended','confirmed','received','handed') NOT NULL DEFAULT 'new',
  `scooter_id` int(10) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `rated` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`reservation_id`, `reservation_date`, `from_time`, `to_time`, `total_price`, `status`, `scooter_id`, `customer_id`, `rated`) VALUES
(4, '2024-04-26', '23:34:00', '23:34:00', 0, 'ended', 6, 1, 1),
(5, '2024-04-29', '12:00:00', '15:00:00', 30, 'ended', 2, 1, 1),
(8, '2024-05-03', '09:30:00', '11:30:00', 24, 'ended', 4, 1, 0),
(10, '2024-05-01', '12:00:00', '13:00:00', 15, 'refused', 5, 1, 0),
(11, '2024-05-01', '12:30:00', '13:30:00', 15, 'ended', 5, 1, 0),
(12, '2024-05-01', '10:00:00', '11:00:00', 10, 'ended', 6, 3, 1),
(13, '2024-05-01', '10:00:00', '11:00:00', 10, 'ended', 6, 3, 0),
(15, '2024-05-10', '10:00:00', '12:00:00', 24, 'refused', 4, 3, 0),
(16, '2024-05-02', '12:00:00', '01:00:00', 132, 'accepted', 4, 3, 0),
(18, '2024-05-01', '10:00:00', '11:00:00', 10, 'new', 6, 3, 0),
(19, '2024-05-03', '10:00:00', '12:00:00', 20, 'ended', 6, 1, 0);

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
  `availability` varchar(255) NOT NULL,
  `reserved` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `scooter`
--

INSERT INTO `scooter` (`scooter_id`, `scooter_name`, `scooter_type`, `scooter_model`, `scooter_color`, `scooter_brand`, `scooter_image`, `price_per_hour`, `description`, `availability`, `reserved`) VALUES
(2, 'اسكوتر 2', 'واقف', '2011', 'اسود', 'بينيلي', 'uploads/scooters/3425917520.jpg', 10, 'اسكوتر جديد بحالة ممتازة', '0', 0),
(4, 'اسكوتر جديد', 'هوجان', '2016', 'احمر', 'بينيلي', 'uploads/scooters/3427074442.jpg', 12, 'اسكوتر جديد بحالة ممتازة يتميز بالسرعة', '1', 0),
(5, 'اسكوتر حديث', 'واقف', '2016', 'ازرق', 'بينيلي', 'uploads/scooters/3427751442.jpg', 15, 'اسكوتر جديد بحالة ممتازة يتميز بالسرعة', '1', 0),
(6, 'sss', 'nnnnfnf', 'jdjdjjdjd', 'nndndn', 'kdkdkd', 'uploads/scooters/3428148284.jpg', 10, 'ldldld', '1', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cust_id`);

--
-- Indexes for table `evaluation`
--
ALTER TABLE `evaluation`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`reservation_id`);

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
  MODIFY `cust_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `evaluation`
--
ALTER TABLE `evaluation`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `question_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `rent_employee`
--
ALTER TABLE `rent_employee`
  MODIFY `employee_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `reservation_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `scooter`
--
ALTER TABLE `scooter`
  MODIFY `scooter_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
