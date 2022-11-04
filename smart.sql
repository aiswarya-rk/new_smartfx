-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 04, 2022 at 12:44 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smart`
--

-- --------------------------------------------------------

--
-- Table structure for table `file_upload`
--

CREATE TABLE `file_upload` (
  `file_id` int(20) NOT NULL,
  `user_id` int(20) NOT NULL,
  `title` varchar(250) NOT NULL,
  `description` varchar(400) NOT NULL,
  `file_name` varchar(250) NOT NULL,
  `file_type` varchar(250) NOT NULL,
  `file_size` varchar(250) NOT NULL,
  `tiny_url` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `file_upload`
--

INSERT INTO `file_upload` (`file_id`, `user_id`, `title`, `description`, `file_name`, `file_type`, `file_size`, `tiny_url`) VALUES
(1, 2, 'flower', 'beautiful flowers', 'upload/1670-harry-grout-67i-shlebly-unsplash.jpg', 'image/jpeg', '2978.4951171875', 1),
(2, 2, 'Nature', 'Natural beauty', 'upload/9383-dawid-zawila-e9b5kcgcr9y-unsplash.jpg', 'image/jpeg', '1193.33984375', 0),
(3, 2, 'Resume ', 'Sample PDF File ', 'upload/8309-aiswarya_resume.pdf', 'application/pdf', '115.3662109375', 0),
(6, 2, 'Rain', 'Sample file - Gif ', 'upload/8163-camboy _ woosan _ completed.gif', 'image/gif', '2017.759765625', 0),
(8, 8, 'Tea', 'Tea cup', 'upload/4279-jasmine-huang-rsqmxacuvn0-unsplash.jpg', 'image/jpeg', '966.888671875', 0),
(9, 8, 'flower', 'flower garden', 'upload/6536-tavga-k-s-6qq9xvzyyew-unsplash.jpg', 'image/jpeg', '2504.4111328125', 1),
(10, 14, 'hi', 'hello', 'upload/5159-anton-darius-dsh833s7hts-unsplash.jpg', 'image/jpeg', '2697.5537109375', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(20) NOT NULL,
  `user_name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `conf_password` varchar(250) NOT NULL,
  `status` varchar(100) NOT NULL,
  `type` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `user_name`, `email`, `password`, `conf_password`, `status`, `type`) VALUES
(1, 'admin', 'admin@gmail.com', 'admin', 'admin', 'approved', 1),
(2, 'vipin', 'vipi@gmail.com', '12', '12', 'approved', 0),
(3, 'Aswathy', 'achu@gmail.com', 'aswathy', 'aswathy', 'pending', 0),
(6, 'Praviya', 'praviya@gmail.com', '12', '12', 'pending', 0),
(7, 'Rithu', 'rithu@gmail.com', 'rithu', 'rithu', 'pending', 0),
(8, 'Aiswarya', 'aiswarya@gmail.com', 'radhu', 'radhu', 'approved', 0),
(9, 'Praveena', 'pravi@gmail.com', 'pravi', 'pravi', 'pending', 0),
(14, 'kuttan', 'kuttan@gmail.com', 'kuttan', 'kuttan', 'approved', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `file_upload`
--
ALTER TABLE `file_upload`
  ADD PRIMARY KEY (`file_id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `file_upload`
--
ALTER TABLE `file_upload`
  MODIFY `file_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
