-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2023 at 01:37 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

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
  `token_id` binary(16) NOT NULL,
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
  `last_login` date DEFAULT current_timestamp(),
  `created_by` varchar(30) NOT NULL,
  `created_on` date NOT NULL,
  `updated_by` varchar(30) NOT NULL,
  `updated_on` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_details`
--

INSERT INTO `admin_details` (`id`, `token_id`, `emp_id`, `email`, `role`, `name`, `date_of_birth`, `username`, `password`, `phone_no`, `profile_status`, `profile_path`, `last_login`, `created_by`, `created_on`, `updated_by`, `updated_on`) VALUES
(1, 0x0e8f1a2b3c4d5e6f7a8d9b1c2e3f4a5d, 'EST062', 'trexu@gmail.com', 'superadmin', 'Trex', '2023-12-11', 'TrexuA01', '1234', 9898980078, 0, NULL, '2023-12-12', 'trexu', '2023-12-11', 'trexu', '2023-12-12');

-- --------------------------------------------------------

--
-- Table structure for table `login_activity`
--

CREATE TABLE `login_activity` (
  `emp_id` varchar(30) NOT NULL,
  `name` varchar(40) NOT NULL,
  `role` varchar(40) NOT NULL,
  `activity` text NOT NULL,
  `login_time` datetime NOT NULL DEFAULT current_timestamp(),
  `logout_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login_activity`
--

INSERT INTO `login_activity` (`emp_id`, `name`, `role`, `activity`, `login_time`, `logout_time`) VALUES
('EST062', 'Trex', 'superadmin', '', '2023-12-12 16:08:17', '2023-12-12 16:16:37'),
('EST062', 'Trex', 'superadmin', '', '2023-12-12 16:08:48', '2023-12-12 16:16:37'),
('EST062', 'Trex', 'superadmin', ', login activity, login activity, user list, user list, admin list, login activity, login activityI-Box Dashboard, login activity, login activity, login activityI-Box Dashboard, admin list, admin list, user list, login activity, login activity, admin list, admin list, login activity, login activity, profile viewed, profile viewed', '2023-12-12 16:09:36', '2023-12-12 16:16:37'),
('EST062', 'Trex', 'superadmin', 'I-Box Dashboard, login activity, login activity, login activity, login activity, login activity, profile viewed, profile viewed', '2023-12-12 16:16:42', '2023-12-12 16:18:36'),
('EST062', 'Trex', 'superadmin', 'I-Box Dashboard, login activity, login activityI-Box Dashboard, admin list, admin list, login activity, profile viewed, login activity, user list, profile viewed, admin list, admin listI-Box Dashboard, admin list, admin listI-Box Dashboard, login activity, login activityArraylogin activitylogin activityprofile viewedprofile viewed', '2023-12-12 16:18:40', '2023-12-12 16:59:22'),
('EST062', 'Trex', 'superadmin', 'I-Box Dashboardprofile viewedlogin activityuser listadmin listadmin listI-Box Dashboardlogin activitylogin activityprofile viewedprofile viewed', '2023-12-12 16:59:27', '2023-12-12 17:01:09'),
('EST062', 'Trex', 'superadmin', 'admin listadmin listadmin list, login activity, profile viewed, login activity, login activity, profile viewed, login activity, login activity, profile viewed, profile viewed', '2023-12-12 17:02:02', '2023-12-12 17:31:42'),
('EST062', 'Trex', 'superadmin', 'I-Box Dashboard, login activity, login activity, login activity, user list, admin list, admin listI-Box DashboardI-Box Dashboard, admin list, admin list, user list, login activity, login activity, profile viewedI-Box Dashboard, admin list, admin list, user list, login activity, profile viewedI-Box Dashboard, admin list, admin list, user list, login activity, login activity, user list, login activity, profile viewed', '2023-12-12 17:31:47', NULL),
('EST062', 'Trex', 'superadmin', '', '2023-12-12 18:02:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mail_list`
--

CREATE TABLE `mail_list` (
  `id` int(11) NOT NULL,
  `token_id` binary(16) NOT NULL,
  `mail_no` varchar(30) NOT NULL,
  `sender_email` varchar(40) NOT NULL,
  `name` varchar(30) NOT NULL,
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

INSERT INTO `mail_list` (`id`, `token_id`, `mail_no`, `sender_email`, `name`, `reciever_email`, `cc`, `bcc`, `subject`, `notes`, `attachment`, `date_of_sending`, `mail_status`, `inbox_status`, `starred`, `archived`, `label`, `spam`, `updated_by`, `created_by`, `updated_on`) VALUES
(1, 0x0e8f1a2b3c4d5e6f7a8d9b1c2e3f4a4d, 'TH021', 'theertheshest@gmail.com', 'Theerthesh', 'theertheshwaranthangaraj@gmail.com', '', '', 'first mail', 'hiii', NULL, '2023-12-10', 'sent', 'read', 'no', 'no', NULL, 'no', 'theerthesh234', 'theerthesh234', '2023-12-10'),
(2, 0x0e8f1a2b3c4d5e6f7a8d9b1c2e3f4a4d, 'TH001', 'theertheshest@gmail.com', 'Theerthesh', 'theertheshwaranthangaraj@gmail.com', ' ', ' ', 'hi', 'this is first mail', 0x20, '2023-11-14', 'sent', 'read', 'no', 'no', NULL, '', 'theerthesh', 'theerthesh', '2023-11-14'),
(3, 0x0a1b2c3d4e5f6a7b8c9d0e1f2a3b4c5d, 'TH002', 'trexcity@gmail.com', 'Trexu', 'theertheshest@gmail.com', NULL, NULL, 'Subject 1', 'This is the first mail sent', NULL, '2023-11-15', 'sent', 'read', 'no', 'no', NULL, '', 'user1', 'user1', '2023-11-15'),
(4, 0x0e8f1a2b3c4d5e6f7a8d9b1c2e3f4a4d, 'TH003', 'theertheshest@gmail.com', 'Theerthesh', 'trexcity@gmail.com', NULL, NULL, 'Subject 2', 'This is the second mail sent', NULL, '2023-11-15', 'sent', 'read', 'yes', 'no', NULL, '', 'user2', 'user2', '2023-11-15'),
(5, 0x0a1b2c3d4e5f6a7b8c9d0e1f2a3b4c5d, 'TH004', 'trexcity@gmail.com', 'Trexu', 'theertheshest@gmail.com', NULL, NULL, 'Subject 3', 'This is the third mail sent', NULL, '2023-11-15', 'sent', 'read', 'no', 'no', NULL, '', 'user3', 'user3', '2023-11-15'),
(6, 0x0e8f1a2b3c4d5e6f7a8d9b1c2e3f4a4d, 'TH005', 'theertheshest@gmail.com', 'Theerthesh', 'trexcity@gmail.com', NULL, NULL, 'Subject 4', 'This is the fourth mail sent', NULL, '2023-11-15', 'sent', 'read', 'yes', 'yes', NULL, '', 'user4', 'user4', '2023-11-15'),
(7, 0x0e8f1a2b3c4d5e6f7a8d9b1c2e3f4a4d, 'TH007', 'theertheshest@gmail.com', 'Theerthesh', 'trexcity@gmail.com', NULL, NULL, 'Subject 6', 'This is the sixth mail sent', NULL, '2023-11-15', 'sent', 'read', 'yes', 'no', NULL, '', 'user6', 'user6', '2023-11-15'),
(8, 0x0a1b2c3d4e5f6a7b8c9d0e1f2a3b4c5d, 'TH008', 'trexcity@gmail.com', 'Trexu', 'theertheshest@gmail.com', NULL, NULL, 'Subject 7', 'This is the seventh mail sent', NULL, '2023-11-15', 'sent', 'read', 'yes', 'no', NULL, '', 'user7', 'user7', '2023-11-15'),
(9, 0x0e8f1a2b3c4d5e6f7a8d9b1c2e3f4a4d, 'TH009', 'theertheshest@gmail.com', 'Theerthesh', 'receiver8@example.com', NULL, NULL, 'Subject 8', 'This is the eighth mail sent', NULL, '2023-11-15', 'sent', 'unread', 'yes', 'no', NULL, '', 'user8', 'user8', '2023-11-15'),
(10, 0x0e8f1a2b3c4d5e6f7a8d9b1c2e3f4a4d, 'TH011', 'theertheshest@gmail.com', 'Theerthesh', 'trexcity@gmail.com', NULL, NULL, 'Subject 10', 'This is the tenth mail sent', NULL, '2023-11-15', 'draft', 'read', 'no', 'no', NULL, '', 'user10', 'user10', '2023-11-15'),
(11, 0x0e8f1a2b3c4d5e6f7a8d9b1c2e3f4a4d, 'TH013', 'theertheshest@gmail.com', 'Theerthesh', 'trexcity@gmail.com', NULL, NULL, 'Subject 12', 'This is the twelfth mail sent', NULL, '2023-11-15', 'sent', 'read', 'yes', 'yes', 'sample2', '', 'user12', 'user12', '2023-11-15'),
(12, 0x0e8f1a2b3c4d5e6f7a8d9b1c2e3f4a4d, 'TH014', 'theertheshest@gmail.com', 'Theerthesh', 'receiver13@example.com', NULL, NULL, 'Subject 13', 'This is the thirteenth mail sent', NULL, '2023-11-15', 'sent', 'read', 'no', 'no', NULL, '', 'user13', 'user13', '2023-11-15'),
(13, 0x0a1b2c3d4e5f6a7b8c9d0e1f2a3b4c5d, 'TH015', 'trexcity@gmail.com', 'Trexu', 'theertheshest@gmail.com', NULL, NULL, 'Subject 14', 'This is the fourteenth mail sent', NULL, '2023-11-15', 'sent', 'read', 'no', 'no', NULL, '', 'user14', 'user14', '2023-11-15'),
(14, 0x0e8f1a2b3c4d5e6f7a8d9b1c2e3f4a4d, 'TH016', 'theertheshest@gmail.com', 'Theerthesh', 'trexcity@gmail.com', NULL, NULL, 'Subject 15', 'This is the fifteenth mail sent', NULL, '2023-11-15', 'sent', 'read', 'no', 'yes', NULL, '', 'user15', 'user15', '2023-11-15'),
(15, 0x0e8f1a2b3c4d5e6f7a8d9b1c2e3f4a4d, 'TH017', 'theertheshest@gmail.com', 'Theerthesh', 'trexcity@gmail.com', NULL, NULL, 'Subject 16', 'This is the sixteenth mail sent', NULL, '2023-11-15', 'sent', 'read', 'no', 'no', NULL, '', 'user16', 'user16', '2023-11-15'),
(16, 0x0e8f1a2b3c4d5e6f7a8d9b1c2e3f4a4d, 'TH019', 'theertheshest@gmail.com', 'Theerthesh', 'trexcity@gmail.com', NULL, NULL, 'Subject 18', 'This is the eighteenth mail sent', NULL, '2023-11-15', 'sent', 'read', 'no', 'yes', NULL, '', 'user18', 'user18', '2023-11-15'),
(17, 0x0e8f1a2b3c4d5e6f7a8d9b1c2e3f4a4d, 'TH031', 'theertheshest@gmail.com', 'theerthesh', 'smaha24cse@gmail.com', '', '', 'third mail', 'khhkjhkjhkj', NULL, '2023-12-11', 'sent', 'read', 'no', 'yes', NULL, 'no', 'theerthesh234', 'theerthesh234', '2023-12-11');

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
(32, 0x0a1b2c3d4e5f6a7b8c9d0e1f2a3b4c5d, 'trexcity@gmail.com', 'Sender Nine', '1998-06-28', 'user9', 'password9', 1, NULL, NULL, 6667778888, NULL, 'admin', '2023-11-15', 'admin', '2023-11-15'),
(40, 0x0c4d5e6f7a8d9b1c2e3f4a5d6e7f8a9d, 'sender8@example.com', 'Sender Eight', '1989-12-05', 'user8', 'password8', 1, NULL, NULL, 2223334444, NULL, 'admin', '2023-11-15', 'admin', '2023-11-15'),
(43, 0x0d9c8e7f5b2a4d1e3f6c7b8a2d5e4f8c, 'sender5@example.com', 'Sender Five', '1987-07-25', 'user5', 'password5', 1, NULL, NULL, 4445556666, NULL, 'admin', '2023-11-15', 'admin', '2023-11-15'),
(52, 0x0e8f1a2b3c4d5e6f7a8d9b1c2e3f4a4d, 'theertheshest@gmail.com', 'theerthesh', '2023-11-18', 'theerthesh234', 'def', 0, NULL, NULL, 9514309298, '2023-12-10', 'theerthesh', '2023-11-08', 'theerthesh', '2023-12-12'),
(45, 0x0e8f1a2b3c4d5e6f7a8d9b1c2e3f4a5d, 'sender7@example.com', 'Sender Seven', '1984-09-18', 'user7', 'password7', 0, NULL, NULL, 7779993333, NULL, 'admin', '2023-11-15', 'admin', '2023-11-15'),
(48, 0x0f5b9a4c7d3e8f2b6c9a5d4e8c7b2a4d, 'sender4@example.com', 'Sender Four', '1992-11-10', 'user4', 'password4', 1, NULL, NULL, 9998887777, NULL, 'admin', '2023-11-15', 'admin', '2023-11-15'),
(33, 0xa2b3c4d5e6f7a8b9c0d1e2f3a4b5c600, 'sender19@example.com', 'Sender Nineteen', '1999-07-29', 'user19', 'password19', 1, NULL, NULL, 3334445555, NULL, 'admin', '2023-11-15', 'admin', '2023-11-15'),
(34, 0xa4b5c6d7e8f9a0b1c2d3e4f5a6b7c800, 'sender13@example.com', 'Sender Thirteen', '1983-07-14', 'user13', 'password13', 1, NULL, NULL, 9998887777, NULL, 'admin', '2023-11-15', 'admin', '2023-11-15'),
(35, 0xa9b2e74c2d8a45f69e6e7b1f89a32342, 'sender2@example.com', 'theerthesh', '1985-02-15', 'user2', 'password2', 1, NULL, NULL, 9889097890, NULL, 'admin', '2023-11-15', 'admin', '2023-11-15'),
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
  ADD PRIMARY KEY (`emp_id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `token_id` (`token_id`);

--
-- Indexes for table `login_activity`
--
ALTER TABLE `login_activity`
  ADD KEY `login_activity_ibfk_1` (`emp_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mail_list`
--
ALTER TABLE `mail_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `login_activity`
--
ALTER TABLE `login_activity`
  ADD CONSTRAINT `login_activity_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `admin_details` (`emp_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
