-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2023 at 02:12 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `email_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_details`
--

CREATE TABLE `admin_details` (
  `id` int(11) NOT NULL,
  `token_id` binary(1) NOT NULL,
  `emp_id` varchar(10) NOT NULL,
  `email` varchar(70) NOT NULL,
  `role` varchar(20) NOT NULL,
  `name` varchar(40) NOT NULL,
  `date_of_birth` date NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(11) NOT NULL,
  `phone_no` bigint(20) NOT NULL,
  `profile_status` int(10) NOT NULL DEFAULT 1,
  `profile_path` varchar(255) DEFAULT NULL,
  `created_by` varchar(30) NOT NULL,
  `created_on` date NOT NULL,
  `updated_by` varchar(30) NOT NULL,
  `updated_on` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mail_list`
--

CREATE TABLE `mail_list` (
  `id` int(11) NOT NULL,
  `token_id` binary(1) NOT NULL,
  `mail_no` varchar(30) NOT NULL,
  `sender_email` varchar(40) NOT NULL,
  `username` varchar(30) NOT NULL,
  `reciever_email` varchar(40) NOT NULL,
  `cc` varchar(40) DEFAULT NULL,
  `bcc` varchar(40) DEFAULT NULL,
  `subject` text NOT NULL,
  `notes` text NOT NULL,
  `attachment` blob DEFAULT NULL,
  `date_of_sending` date NOT NULL DEFAULT current_timestamp(),
  `mail_status` varchar(20) NOT NULL,
  `inbox_status` varchar(20) NOT NULL DEFAULT 'unread',
  `starred` varchar(20) DEFAULT 'no',
  `archived` varchar(30) DEFAULT 'no',
  `label` varchar(20) DEFAULT NULL,
  `spam` varchar(10) NOT NULL DEFAULT 'no',
  `updated_by` varchar(40) NOT NULL,
  `created_by` varchar(40) NOT NULL,
  `updated_on` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mail_list`
--

INSERT INTO `mail_list` (`id`, `token_id`, `mail_no`, `sender_email`, `username`, `reciever_email`, `cc`, `bcc`, `subject`, `notes`, `attachment`, `date_of_sending`, `mail_status`, `inbox_status`, `starred`, `archived`, `label`, `spam`, `updated_by`, `created_by`, `updated_on`) VALUES
(1, 0x0e, 'TH021', 'theertheshest@gmail.com', 'theerthesh234', 'theertheshwaranthangaraj@gmail.com', '', '', 'first mail', 'hiii', NULL, '2023-12-10', 'sent', 'read', 'no', 'no', NULL, 'no', 'theerthesh234', 'theerthesh234', '2023-12-10');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `id` int(11) NOT NULL,
  `token_id` binary(16) NOT NULL,
  `email` varchar(70) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `date_of_birth` date NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(11) NOT NULL,
  `profile_status` int(11) NOT NULL DEFAULT 1,
  `profile_path` varchar(255) DEFAULT NULL,
  `date_of_uploading` date DEFAULT NULL,
  `phone_no` bigint(20) NOT NULL,
  `last_login` date DEFAULT NULL,
  `created_by` varchar(30) NOT NULL,
  `created_on` date NOT NULL,
  `updated_by` varchar(30) NOT NULL,
  `updated_on` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`id`, `token_id`, `email`, `name`, `date_of_birth`, `username`, `password`, `profile_status`, `profile_path`, `date_of_uploading`, `phone_no`, `last_login`, `created_by`, `created_on`, `updated_by`, `updated_on`) VALUES
(32, 0x0a1b2c3d4e5f6a7b8c9d0e1f2a3b4c5d, 'sender9@example.com', 'Sender Nine', '1998-06-28', 'user9', 'password9', 1, NULL, NULL, 6667778888, NULL, 'admin', '2023-11-15', 'admin', '2023-11-15'),
(40, 0x0c4d5e6f7a8d9b1c2e3f4a5d6e7f8a9d, 'sender8@example.com', 'Sender Eight', '1989-12-05', 'user8', 'password8', 1, NULL, NULL, 2223334444, NULL, 'admin', '2023-11-15', 'admin', '2023-11-15'),
(43, 0x0d9c8e7f5b2a4d1e3f6c7b8a2d5e4f8c, 'sender5@example.com', 'Sender Five', '1987-07-25', 'user5', 'password5', 1, NULL, NULL, 4445556666, NULL, 'admin', '2023-11-15', 'admin', '2023-11-15'),
(52, 0x0e8f1a2b3c4d5e6f7a8d9b1c2e3f4a4d, 'theertheshest@gmail.com', 'theerthesh', '2023-11-18', 'theerthesh234', 'def', 1, NULL, NULL, 9514309298, '2023-12-10', 'theerthesh', '2023-11-08', 'theerthesh', '2023-12-10'),
(45, 0x0e8f1a2b3c4d5e6f7a8d9b1c2e3f4a5d, 'sender7@example.com', 'Sender Seven', '1984-09-18', 'user7', 'password7', 1, NULL, NULL, 7779993333, NULL, 'admin', '2023-11-15', 'admin', '2023-11-15'),
(48, 0x0f5b9a4c7d3e8f2b6c9a5d4e8c7b2a4d, 'sender4@example.com', 'Sender Four', '1992-11-10', 'user4', 'password4', 1, NULL, NULL, 9998887777, NULL, 'admin', '2023-11-15', 'admin', '2023-11-15'),
(33, 0xa2b3c4d5e6f7a8b9c0d1e2f3a4b5c600, 'sender19@example.com', 'Sender Nineteen', '1999-07-29', 'user19', 'password19', 1, NULL, NULL, 3334445555, NULL, 'admin', '2023-11-15', 'admin', '2023-11-15'),
(34, 0xa4b5c6d7e8f9a0b1c2d3e4f5a6b7c800, 'sender13@example.com', 'Sender Thirteen', '1983-07-14', 'user13', 'password13', 1, NULL, NULL, 9998887777, NULL, 'admin', '2023-11-15', 'admin', '2023-11-15'),
(35, 0xa9b2e74c2d8a45f69e6e7b1f89a32342, 'sender2@example.com', 'theerthesh', '1985-02-15', 'user2', 'password2', 0, NULL, NULL, 9889097890, NULL, 'admin', '2023-11-15', 'admin', '2023-11-15'),
(36, 0xb1a2d3e4f5c6b7a8d9e0f1a2b3c4d5e6, 'sender6@example.com', 'Sender Six', '1995-04-03', 'user6', 'password6', 1, NULL, NULL, 1110002222, NULL, 'admin', '2023-11-15', 'admin', '2023-11-15'),
(37, 0xb5c6d7e8f9a1b2c3d4e5f6a7b8c9d000, 'sender11@example.com', 'Sender Eleven', '1986-08-22', 'user11', 'password11', 1, NULL, NULL, 8889990000, NULL, 'admin', '2023-11-15', 'admin', '2023-11-15'),
(38, 0xb8c9d0e1f2a3b4c5d6e7f8a9b0c1d200, 'sender16@example.com', 'Sender Sixteen', '1980-10-20', 'user16', 'password16', 1, NULL, NULL, 7779993333, NULL, 'admin', '2023-11-15', 'admin', '2023-11-15'),
(39, 0xc3f8d1e9b7a54e61a0c321b2e4f6c7d8, 'sender3@example.com', 'Sender Three', '1988-05-20', 'user3', 'password3', 1, NULL, NULL, 5551234567, NULL, 'admin', '2023-11-15', 'admin', '2023-11-15'),
(41, 0xc5d6e7f8a9b0c1d2e3f4a5d6e7f8a900, 'sender14@example.com', 'Sender Fourteen', '1996-12-01', 'user14', 'password14', 1, NULL, NULL, 5551234567, NULL, 'admin', '2023-11-15', 'admin', '2023-11-15'),
(42, 0xd1e2f3a4b5c6d7e8f9a0b1c2d3e4f500, 'sender17@example.com', 'Sender Seventeen', '1994-05-03', 'user17', 'password17', 1, NULL, NULL, 2223334444, NULL, 'admin', '2023-11-15', 'admin', '2023-11-15'),
(44, 0xe5f6a7b8c9d0e1f2a3b4c5d6e7f8a900, 'sender18@example.com', 'Sender Eighteen', '1981-11-16', 'user18', 'password18', 1, NULL, NULL, 6667778888, NULL, 'admin', '2023-11-15', 'admin', '2023-11-15'),
(46, 0xe9f0a1b2c3d4e5f6a7b8c9d0e1f2a300, 'sender12@example.com', 'Sender Twelve', '1997-02-09', 'user12', 'password12', 1, NULL, NULL, 4445556666, NULL, 'admin', '2023-11-15', 'admin', '2023-11-15'),
(49, 0xf6a7b8c9d0e1f2a3b4c5d6e7f8a9d000, 'sender10@example.com', 'Sender Ten', '1993-03-15', 'user10', 'password10', 1, NULL, NULL, 3334445555, NULL, 'admin', '2023-11-15', 'admin', '2023-11-15'),
(50, 0xf7a8b9c0d1e2f3a4b5c6d7e8f9a0b100, 'sender20@example.com', 'Sender Twenty', '1987-12-14', 'user20', 'password20', 1, NULL, NULL, 8889990000, NULL, 'admin', '2023-11-15', 'admin', '2023-11-15'),
(51, 0xf9a0b1c2d3e4f5a6b7c8d9e0f1a2b300, 'sender15@example.com', 'Sender Fifteen', '1982-04-07', 'user15', 'password15', 1, NULL, NULL, 1112223333, NULL, 'admin', '2023-11-15', 'admin', '2023-11-15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_details`
--
ALTER TABLE `admin_details`
  ADD PRIMARY KEY (`token_id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `mail_list`
--
ALTER TABLE `mail_list`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`token_id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_details`
--
ALTER TABLE `admin_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mail_list`
--
ALTER TABLE `mail_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
