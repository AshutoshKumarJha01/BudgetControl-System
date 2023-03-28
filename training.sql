-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 04, 2021 at 10:50 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `training`
--

-- --------------------------------------------------------

--
-- Table structure for table `income_detail`
--

CREATE TABLE `income_detail` (
  `id` int(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `details` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `balance` varchar(20) NOT NULL,
  `dat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `income_detail`
--

INSERT INTO `income_detail` (`id`, `user_id`, `category`, `details`, `amount`, `balance`, `dat`) VALUES
(1, 0, 'Investment', 'Company', '2000', '', '2021-10-02'),
(2, 0, 'Investment', 'Company', '2000', '', '2021-10-02'),
(3, 3, 'Investment', 'Movies', '2000', '2000', '2021-10-02'),
(4, 3, 'Scholarship', 'it company', '3400', '5400', '2021-10-19');

-- --------------------------------------------------------

--
-- Table structure for table `spend_detail`
--

CREATE TABLE `spend_detail` (
  `id` int(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `details` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `balance` varchar(20) NOT NULL,
  `dat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_budget`
--

CREATE TABLE `user_budget` (
  `s_no` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `from_date` datetime NOT NULL,
  `to_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_budget`
--

INSERT INTO `user_budget` (`s_no`, `user_id`, `amount`, `from_date`, `to_date`) VALUES
(1, 3, 20000, '2021-10-01 00:00:00', '2021-10-31 02:45:00');

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `id` int(5) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `currency` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`id`, `name`, `email`, `password`, `currency`) VALUES
(2, 'sujit', 'sujit@gmail.com', '$2y$10$T8vA8qvDLI5ER0ypyH.fp.1I97uvn6KyBctTvmrlD8uoRiX5gCE9.', 'INR'),
(3, 'ajeet', 'ajeet@gmail.com', '$2y$10$VcpSNnKwtE/ieMw5kTFB/u4S4N39Y/nhQeoXbYn03ziOIVHUC/1c6', 'USD'),
(5, 'Raja Kumar', 'raja123@gmail.com', '$2y$10$BhoVI5ZRuvYP1evD/wM5XekO9Diopv6.gfUntNuyBCjRMyF5omgOa', 'INR'),
(6, 'Chandal', 'chandal123@gmail.com', '$2y$10$og9gjdNeilKVPxzNru5pJO6Rx1SvnL6Qv93j0phA80hvgWAzfyTjm', 'INR'),
(7, 'aman', 'aman123@gmail.com', '$2y$10$x1WBR3fjFxJVf5qQFCR4KuqVhK4owCrXb.RzpSuflZ2W.ilNrOLoa', 'INR'),
(8, 'aman', 'aman@gmail.com', '$2y$10$ECkK7OMUisbiI7UO.vNok.B2mCvn7OtVQB14jcamcsHTCk/UICuHe', 'INR'),
(9, '', '', '$2y$10$JPrINKENMUPUbs7Fh/j1rOEv2FW46hMju3g2s8TdRc4RiRdyLmzca', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `income_detail`
--
ALTER TABLE `income_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `spend_detail`
--
ALTER TABLE `spend_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user_budget`
--
ALTER TABLE `user_budget`
  ADD PRIMARY KEY (`s_no`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `income_detail`
--
ALTER TABLE `income_detail`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `spend_detail`
--
ALTER TABLE `spend_detail`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_budget`
--
ALTER TABLE `user_budget`
  MODIFY `s_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `spend_detail`
--
ALTER TABLE `spend_detail`
  ADD CONSTRAINT `spend_detail_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `spend_detail` (`id`);

--
-- Constraints for table `user_budget`
--
ALTER TABLE `user_budget`
  ADD CONSTRAINT `user_budget_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_info` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
