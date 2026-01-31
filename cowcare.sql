-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 16, 2026 at 04:57 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cowcare`
--

-- --------------------------------------------------------

--
-- Table structure for table `cows`
--

CREATE TABLE `cows` (
  `id` int(11) NOT NULL,
  `tag_no` varchar(50) DEFAULT NULL,
  `breed` varchar(50) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `health_status` varchar(100) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cows`
--

INSERT INTO `cows` (`id`, `tag_no`, `breed`, `age`, `health_status`, `user_id`) VALUES
(2, '001', 'Gir', 14, 'Healthy', NULL),
(4, '006', 'HF', 12, 'Healthy', NULL),
(5, '151', 'Gir', 13, 'Sick', 2),
(6, '312', 'Gir', 19, 'Sick', 2);

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` int(11) NOT NULL,
  `expense_type` varchar(100) DEFAULT NULL,
  `amount` decimal(8,2) DEFAULT NULL,
  `record_date` date DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `expense_type`, `amount`, `record_date`, `user_id`) VALUES
(1, 'Cleaning', 4500.00, '2026-01-15', NULL),
(2, 'Cleaning', 2000.00, '2026-01-15', NULL),
(3, 'Cleaning', 2000.00, '2026-01-15', 2),
(4, 'Cleaning', 2000.00, '2026-01-16', 2);

-- --------------------------------------------------------

--
-- Table structure for table `feed_records`
--

CREATE TABLE `feed_records` (
  `id` int(11) NOT NULL,
  `feed_type` varchar(100) DEFAULT NULL,
  `quantity_kg` decimal(6,2) DEFAULT NULL,
  `cost` decimal(8,2) DEFAULT NULL,
  `record_date` date DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feed_records`
--

INSERT INTO `feed_records` (`id`, `feed_type`, `quantity_kg`, `cost`, `record_date`, `user_id`) VALUES
(1, 'gavat', 15.00, 1900.00, '2026-01-15', NULL),
(2, 'Water', 15.00, 300.00, '2026-01-15', NULL),
(3, 'Grass', 18.00, 1100.00, '2026-01-15', NULL),
(4, 'Grass', 12.00, 950.00, '2026-01-16', NULL),
(5, '', 0.00, 1100.00, '2026-01-15', 2),
(6, 'Grass', 12.00, 1200.00, '2026-01-15', 2),
(7, 'Grass', 10.00, 1000.00, '2026-01-16', 2);

-- --------------------------------------------------------

--
-- Table structure for table `health_records`
--

CREATE TABLE `health_records` (
  `id` int(11) NOT NULL,
  `cow_id` int(11) DEFAULT NULL,
  `disease` varchar(100) DEFAULT NULL,
  `treatment` varchar(200) DEFAULT NULL,
  `record_date` date DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `health_records`
--

INSERT INTO `health_records` (`id`, `cow_id`, `disease`, `treatment`, `record_date`, `user_id`) VALUES
(1, 2, 'Fever', 'Injection', '2026-01-15', 1),
(2, 2, 'Diarrehea', 'Proper dosage of medicine', '2026-01-15', 1),
(3, 5, 'Diarrehea', 'Proper dosage of medicine', '2026-01-15', 1),
(4, 6, 'Fever', 'Injection', '2026-01-15', 1),
(5, 6, 'Fever', 'Antibiotic for 3 days', '2026-01-16', 1),
(6, 5, 'Fever', 'Injection', '2026-01-15', 1),
(7, 6, 'Diarrehea', 'Dosage for 3 days', '2026-01-08', 1),
(8, 5, 'Fever', 'Injection', '2026-01-15', 2),
(9, 6, 'Diarrehea', 'Dosage for 3 days', '2026-01-08', 2);

-- --------------------------------------------------------

--
-- Table structure for table `milk_records`
--

CREATE TABLE `milk_records` (
  `id` int(11) NOT NULL,
  `cow_id` int(11) DEFAULT NULL,
  `milk_liters` decimal(5,2) DEFAULT NULL,
  `record_date` date DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `milk_records`
--

INSERT INTO `milk_records` (`id`, `cow_id`, `milk_liters`, `record_date`, `user_id`) VALUES
(1, 2, 14.50, '2026-01-15', 1),
(2, NULL, 999.99, '2026-01-16', 1),
(3, NULL, 24.00, '2026-01-15', 1),
(4, NULL, 29.00, '2026-01-16', 1),
(5, NULL, 29.00, '2026-01-15', 1),
(6, NULL, 28.00, '2026-01-15', 2),
(7, NULL, 32.00, '2026-01-16', 2),
(8, NULL, 29.00, '2026-01-15', 2),
(9, NULL, 33.00, '2026-01-16', 2),
(10, 6, 34.00, '2026-01-15', 2),
(11, 6, 27.00, '2026-01-16', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('admin','staff') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`) VALUES
(1, 'Admin', 'admin@cowcare.com', '0192023a7bbd73250516f069df18b500', 'admin'),
(2, 'Yadnesh Saindane', 'yadneshsaindane7@gmail.com', 'cedb9edf96de8d2530bf5bf834adfa69', 'staff');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cows`
--
ALTER TABLE `cows`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feed_records`
--
ALTER TABLE `feed_records`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `health_records`
--
ALTER TABLE `health_records`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `milk_records`
--
ALTER TABLE `milk_records`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `cows`
--
ALTER TABLE `cows`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `feed_records`
--
ALTER TABLE `feed_records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `health_records`
--
ALTER TABLE `health_records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `milk_records`
--
ALTER TABLE `milk_records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
