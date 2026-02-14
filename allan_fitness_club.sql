-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 14, 2026 at 05:04 PM
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
-- Database: `allan_fitness_club`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(15) NOT NULL,
  `UserName` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `UserName`, `email`, `password`) VALUES
(1, 'shadab7055', 'shadabadmin@gmail.com', '$2y$10$Nd/Zd9M2y1htK4k40mMdheyxv5S5dq9zUqmbkSO3lGv9oRDnIpdkG'),
(2, 'harpreet123', 'harpreet@gmail.com', '$2y$10$4v42ZhpAmVaQfL9RINvyfeJRahygPfcDToXeWxhFyHMTvWzq56nNC'),
(4, 'abhijeet123', 'abhijeet@gmail.com', '$2y$10$eqxvGOiqsLz7udUc5bOZouuyGbxIfRptCmmYJ4HXkhVZ48UXdLsDa');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `userid` varchar(20) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` enum('present','absent') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `enquiries`
--

CREATE TABLE `enquiries` (
  `id` int(150) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` int(15) NOT NULL,
  `purpose` varchar(100) NOT NULL,
  `message` varchar(250) NOT NULL,
  `time` varchar(50) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `userid` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `monthly_fees` int(11) NOT NULL,
  `join_date` date NOT NULL,
  `status` enum('active','inactive') DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `userid` varchar(20) NOT NULL,
  `fee_month` varchar(7) NOT NULL,
  `amount` int(11) NOT NULL,
  `paid` int(11) DEFAULT 0,
  `pending` int(11) DEFAULT 0,
  `payment_date` date DEFAULT NULL,
  `payment_mode` varchar(20) DEFAULT NULL,
  `status` enum('paid','partial','unpaid') DEFAULT 'unpaid',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trainers`
--

CREATE TABLE `trainers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `specialization` varchar(255) DEFAULT NULL,
  `hire_date` date NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','member') DEFAULT 'member',
  `phone` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_attendance` (`userid`,`date`);

--
-- Indexes for table `enquiries`
--
ALTER TABLE `enquiries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `userid` (`userid`),
  ADD UNIQUE KEY `userid_2` (`userid`),
  ADD UNIQUE KEY `userid_3` (`userid`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `fk_payments_userid` (`userid`);

--
-- Indexes for table `trainers`
--
ALTER TABLE `trainers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `enquiries`
--
ALTER TABLE `enquiries`
  MODIFY `id` int(150) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trainers`
--
ALTER TABLE `trainers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `fk_payments_userid` FOREIGN KEY (`userid`) REFERENCES `members` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
