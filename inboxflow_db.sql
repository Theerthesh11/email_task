-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 22, 2023 at 01:22 PM
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
-- Database: `inboxflow_db`
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
  `password` varchar(255) NOT NULL,
  `phone_no` bigint(20) NOT NULL,
  `profile_status` int(10) NOT NULL DEFAULT 1,
  `profile_path` varchar(255) DEFAULT NULL,
  `last_login` date DEFAULT current_timestamp(),
  `access_given_date` date NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(30) NOT NULL,
  `created_on` date NOT NULL,
  `updated_by` varchar(30) NOT NULL,
  `updated_on` date NOT NULL DEFAULT current_timestamp(),
  `ibox_dashboard` int(11) NOT NULL DEFAULT 0,
  `admin_list` int(11) NOT NULL DEFAULT 0,
  `user_list` int(11) NOT NULL DEFAULT 0,
  `login_activity` int(11) NOT NULL DEFAULT 0,
  `access_page` int(11) NOT NULL DEFAULT 0,
  `access_given_by` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_details`
--

INSERT INTO `admin_details` (`id`, `token_id`, `emp_id`, `email`, `role`, `name`, `date_of_birth`, `username`, `password`, `phone_no`, `profile_status`, `profile_path`, `last_login`, `access_given_date`, `created_by`, `created_on`, `updated_by`, `updated_on`, `ibox_dashboard`, `admin_list`, `user_list`, `login_activity`, `access_page`, `access_given_by`) VALUES
(2, 0x35313634383946443136344634454241, 'EST061', 'dreruss@gmail.com', 'admin', 'Andre', '2002-05-25', 'dre012', '$2y$10$Vukc5F8O/w8Hq5HspESypebPaB4df6tpsJa98fNJhXRdjuFT6lOq.', 8978896778, 0, NULL, '2023-12-22', '2023-12-22', 'andre', '2023-12-22', 'andre', '2023-12-22', 0, 0, 0, 0, 0, 'dre012'),
(1, 0x30653866316132623363346435653666, 'EST062', 'trexu@gmail.com', 'superadmin', 'theerthesh', '2023-11-18', 'TrexuA01', '$2y$10$O.BmbwHeqUOyJZq6XorHPeTBoKF2A.cqh2H/PcEtbWWLUBovtFR7C', 9514309298, 0, NULL, '2023-12-22', '2023-12-22', 'trexu', '2023-12-11', 'trexu', '2023-12-20', 1, 1, 1, 1, 1, ''),
(3, 0x35313634383946443136344634464841, 'EST068', 'narine@gmail.com', 'admin', 'sunil', '2002-07-07', 'nar08', '$2y$10$rVRIgoKzViPSW6F0.YDM4eXH/YUKkB7kuirevNcb13lG6KnuiF04u', 8976796778, 1, NULL, '2023-12-22', '2023-12-22', 'sunil', '2023-12-22', 'sunil', '2023-12-22', 0, 0, 0, 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `login_activity`
--

CREATE TABLE `login_activity` (
  `emp_id` varchar(30) NOT NULL,
  `username` varchar(40) DEFAULT NULL,
  `name` varchar(40) NOT NULL,
  `role` varchar(40) NOT NULL,
  `activity` text NOT NULL,
  `login_time` datetime NOT NULL DEFAULT current_timestamp(),
  `logout_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login_activity`
--

INSERT INTO `login_activity` (`emp_id`, `username`, `name`, `role`, `activity`, `login_time`, `logout_time`) VALUES
('EST062', 'TrexuA01', 'Trex', 'superadmin', '', '2023-12-12 16:08:17', '2023-12-12 16:16:37'),
('EST062', 'TrexuA01', 'Trex', 'superadmin', '', '2023-12-12 16:08:48', '2023-12-12 16:16:37'),
('EST062', 'TrexuA01', 'Trex', 'superadmin', ', login activity, login activity, user list, user list, admin list, login activity, login activityI-Box Dashboard, login activity, login activity, login activityI-Box Dashboard, admin list, admin list, user list, login activity, login activity, admin list, admin list, login activity, login activity, profile viewed, profile viewed', '2023-12-12 16:09:36', '2023-12-12 16:16:37'),
('EST062', 'TrexuA01', 'Trex', 'superadmin', 'I-Box Dashboard, login activity, login activity, login activity, login activity, login activity, profile viewed, profile viewed', '2023-12-12 16:16:42', '2023-12-12 16:18:36'),
('EST062', 'TrexuA01', 'Trex', 'superadmin', 'I-Box Dashboard, login activity, login activityI-Box Dashboard, admin list, admin list, login activity, profile viewed, login activity, user list, profile viewed, admin list, admin listI-Box Dashboard, admin list, admin listI-Box Dashboard, login activity, login activityArraylogin activitylogin activityprofile viewedprofile viewed', '2023-12-12 16:18:40', '2023-12-12 16:59:22'),
('EST062', 'TrexuA01', 'Trex', 'superadmin', 'I-Box Dashboardprofile viewedlogin activityuser listadmin listadmin listI-Box Dashboardlogin activitylogin activityprofile viewedprofile viewed', '2023-12-12 16:59:27', '2023-12-12 17:01:09'),
('EST062', 'TrexuA01', 'Trex', 'superadmin', 'admin listadmin listadmin list, login activity, profile viewed, login activity, login activity, profile viewed, login activity, login activity, profile viewed, profile viewed', '2023-12-12 17:02:02', '2023-12-12 17:31:42'),
('EST062', 'TrexuA01', 'Trex', 'superadmin', 'I-Box Dashboard, login activity, login activity, login activity, user list, admin list, admin listI-Box DashboardI-Box Dashboard, admin list, admin list, user list, login activity, login activity, profile viewedI-Box Dashboard, admin list, admin list, user list, login activity, profile viewedI-Box Dashboard, admin list, admin list, user list, login activity, login activity, user list, login activity, profile viewed', '2023-12-12 17:31:47', NULL),
('EST062', 'TrexuA01', 'Trex', 'superadmin', '', '2023-12-12 18:02:25', NULL),
('EST062', 'TrexuA01', 'Trex', 'superadmin', '', '2023-12-13 09:40:34', NULL),
('EST062', 'TrexuA01', 'Trex', 'superadmin', '', '2023-12-13 10:08:52', NULL),
('EST062', 'TrexuA01', 'Trex', 'superadmin', '', '2023-12-13 10:25:51', '2023-12-13 10:26:40'),
('EST062', 'TrexuA01', 'Trex', 'superadmin', '', '2023-12-13 10:26:44', NULL),
('EST062', 'TrexuA01', 'Trex', 'superadmin', '', '2023-12-13 12:00:23', NULL),
('EST062', 'TrexuA01', 'Trex', 'superadmin', '', '2023-12-13 12:12:25', NULL),
('EST062', 'TrexuA01', 'Trex', 'superadmin', '', '2023-12-13 12:13:11', NULL),
('EST062', 'TrexuA01', 'Trex', 'superadmin', '', '2023-12-13 12:13:50', '2023-12-13 12:15:38'),
('EST062', 'TrexuA01', 'Trex', 'superadmin', '', '2023-12-13 12:19:24', '2023-12-13 12:56:34'),
('EST062', 'TrexuA01', 'Trex', 'superadmin', '', '2023-12-13 12:56:40', '2023-12-13 13:04:59'),
('EST062', 'TrexuA01', 'Trex', 'superadmin', '', '2023-12-13 13:05:10', NULL),
('EST062', 'TrexuA01', 'Trex', 'superadmin', '', '2023-12-13 13:10:03', NULL),
('EST062', 'TrexuA01', 'Trex', 'superadmin', 'Admin ListAdmin ListAdmin ListAdmin List', '2023-12-13 13:18:55', NULL),
('EST062', 'TrexuA01', 'Trex', 'superadmin', 'Admin ListAdmin ListAdmin ListAdmin ListAdmin ListAdmin ListAdmin ListAdmin ListAdmin List', '2023-12-13 14:41:39', NULL),
('EST062', 'TrexuA01', 'Trex', 'superadmin', 'Admin ListAdmin ListAdmin ListAdmin ListAdmin ListAdmin ListAdmin ListAdmin ListAdmin ListAdmin List', '2023-12-13 14:48:30', NULL),
('EST062', 'TrexuA01', 'Trex', 'superadmin', 'Admin ListAdmin ListAdmin ListAdmin ListAdmin ListAdmin ListAdmin ListAdmin ListAdmin ListAdmin List', '2023-12-13 14:50:37', NULL),
('EST062', 'TrexuA01', 'Trex', 'superadmin', '', '2023-12-13 15:24:10', NULL),
('EST062', 'TrexuA01', 'Trex', 'superadmin', 'Admin List', '2023-12-13 15:30:36', NULL),
('EST062', NULL, '<br /><b>Warning</b>:  Undefined variabl', 'superadmin', 'Admin List', '2023-12-13 15:52:13', NULL),
('EST062', NULL, '<br /><b>Warning</b>:  Undefined variabl', 'superadmin', 'Admin ListAdmin ListAdmin ListAdmin ListAdmin ListAdmin List', '2023-12-13 16:00:47', NULL),
('EST062', NULL, '<br /><b>Warning</b>:  Undefined variabl', 'superadmin', 'Admin ListAdmin List', '2023-12-13 17:27:51', NULL),
('EST062', NULL, '<br /><b>Warning</b>:  Undefined variabl', 'superadmin', 'Admin ListAdmin ListAdmin ListAdmin List', '2023-12-14 10:10:16', NULL),
('EST062', NULL, 'Trexu', 'superadmin', 'Admin ListAdmin List', '2023-12-18 10:54:17', NULL),
('EST062', NULL, 'Trexu', 'superadmin', 'Admin ListAdmin ListAdmin ListAdmin List', '2023-12-19 15:08:54', NULL),
('EST062', NULL, 'Trexu', 'superadmin', 'Admin ListAdmin ListAdmin ListAdmin List', '2023-12-19 15:41:59', '2023-12-19 15:52:23'),
('EST062', NULL, 'Trexu', 'superadmin', 'Admin ListAdmin ListAdmin List', '2023-12-19 16:12:24', NULL),
('EST062', NULL, 'Trexu', 'superadmin', 'Admin ListAdmin ListAdmin ListAdmin ListAdmin List', '2023-12-19 17:04:12', NULL),
('EST062', NULL, 'Trexu', 'superadmin', '', '2023-12-19 17:18:39', NULL),
('EST062', NULL, 'Trexu', 'superadmin', '', '2023-12-19 17:28:32', '2023-12-19 17:31:14'),
('EST062', NULL, 'Trexu', 'superadmin', 'Admin ListAdmin ListAdmin List', '2023-12-19 17:39:43', NULL),
('EST062', NULL, 'theerthesh', 'superadmin', 'Admin ListAdmin ListAdmin ListAdmin ListAdmin ListAdmin ListAdmin List', '2023-12-20 09:48:00', '2023-12-20 10:29:31'),
('EST062', NULL, 'theerthesh', 'superadmin', 'Admin ListAdmin ListAdmin ListAdmin ListAdmin ListAdmin ListAdmin List', '2023-12-20 11:09:36', NULL),
('EST062', 'TrexuA01', 'theerthesh', 'superadmin', '', '2023-12-21 13:03:27', NULL),
('EST062', 'TrexuA01', 'theerthesh', 'superadmin', '', '2023-12-21 15:26:15', NULL),
('EST062', 'TrexuA01', 'theerthesh', 'superadmin', '', '2023-12-21 16:13:04', NULL),
('EST062', 'TrexuA01', 'theerthesh', 'superadmin', '', '2023-12-22 10:02:11', '2023-12-22 10:07:19'),
('EST062', 'TrexuA01', 'theerthesh', 'superadmin', '', '2023-12-22 10:12:27', NULL),
('EST062', 'TrexuA01', 'theerthesh', 'superadmin', '', '2023-12-22 12:57:31', '2023-12-22 15:04:31'),
('EST061', 'dre012', 'Andre', 'admin', '', '2023-12-22 15:04:39', NULL),
('EST061', 'dre012', 'Andre', 'admin', '', '2023-12-22 15:07:40', '2023-12-22 15:09:09'),
('EST062', 'TrexuA01', 'theerthesh', 'superadmin', '', '2023-12-22 15:09:14', '2023-12-22 15:10:45'),
('EST061', 'dre012', 'Andre', 'admin', '', '2023-12-22 15:10:52', '2023-12-22 15:17:36'),
('EST062', 'TrexuA01', 'theerthesh', 'superadmin', '', '2023-12-22 15:17:42', '2023-12-22 15:17:54'),
('EST061', 'dre012', 'Andre', 'admin', '', '2023-12-22 15:18:04', '2023-12-22 15:31:59'),
('EST062', 'TrexuA01', 'theerthesh', 'superadmin', '', '2023-12-22 15:32:03', '2023-12-22 15:33:31'),
('EST061', 'dre012', 'Andre', 'admin', '', '2023-12-22 15:33:38', '2023-12-22 15:34:56'),
('EST062', 'TrexuA01', 'theerthesh', 'superadmin', '', '2023-12-22 15:35:07', '2023-12-22 15:35:47'),
('EST062', 'TrexuA01', 'theerthesh', 'superadmin', '', '2023-12-22 15:42:27', NULL),
('EST062', 'TrexuA01', 'theerthesh', 'superadmin', '', '2023-12-22 15:52:25', '2023-12-22 15:59:02'),
('EST061', 'dre012', 'Andre', 'admin', '', '2023-12-22 15:59:11', '2023-12-22 16:12:07'),
('EST062', 'TrexuA01', 'theerthesh', 'superadmin', '', '2023-12-22 16:12:14', '2023-12-22 16:13:10'),
('EST062', 'TrexuA01', 'theerthesh', 'superadmin', '', '2023-12-22 16:13:23', '2023-12-22 16:13:28'),
('EST061', 'dre012', 'Andre', 'admin', '', '2023-12-22 16:45:11', '2023-12-22 17:21:51'),
('EST062', 'TrexuA01', 'theerthesh', 'superadmin', '', '2023-12-22 17:21:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mail_list`
--

CREATE TABLE `mail_list` (
  `id` int(11) NOT NULL,
  `token_id` binary(16) NOT NULL,
  `mail_no` varchar(30) NOT NULL,
  `sender_email` varchar(40) NOT NULL,
  `sender_name` varchar(30) NOT NULL,
  `reciever_email` varchar(40) NOT NULL,
  `reciever_name` varchar(40) NOT NULL,
  `cc` varchar(40) DEFAULT NULL,
  `bcc` varchar(40) DEFAULT NULL,
  `subject` text NOT NULL,
  `notes` text DEFAULT NULL,
  `attachment` blob DEFAULT NULL,
  `date_of_sending` date NOT NULL DEFAULT current_timestamp(),
  `mail_status` varchar(20) NOT NULL,
  `inbox_status` varchar(20) NOT NULL DEFAULT 'unread',
  `starred` varchar(20) NOT NULL DEFAULT 'no',
  `archived` varchar(30) NOT NULL DEFAULT 'no',
  `label` varchar(20) DEFAULT NULL,
  `spam` varchar(10) NOT NULL DEFAULT 'no',
  `updated_by` varchar(40) NOT NULL,
  `created_by` varchar(40) NOT NULL,
  `updated_on` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mail_list`
--

INSERT INTO `mail_list` (`id`, `token_id`, `mail_no`, `sender_email`, `sender_name`, `reciever_email`, `reciever_name`, `cc`, `bcc`, `subject`, `notes`, `attachment`, `date_of_sending`, `mail_status`, `inbox_status`, `starred`, `archived`, `label`, `spam`, `updated_by`, `created_by`, `updated_on`) VALUES
(1, 0x30653866316132623363346435653666, 'TH021', 'theertheshest@gmail.com', 'Theertheshest', 'theertheshwaranthangaraj@gmail.com', 'Theertheshwaranthangaraj', '', '', 'first mail', 'hiii', NULL, '2023-12-10', 'sent', 'read', 'no', 'no', NULL, 'no', 'theerthesh234', 'theerthesh234', '2023-12-10'),
(2, 0x30653866316132623363346435653666, 'TH001', 'theertheshest@gmail.com', 'Theertheshest', 'theertheshwaranthangaraj@gmail.com', 'Theertheshwaranthangaraj', ' ', ' ', 'hi', 'this is first mail', 0x20, '2023-11-14', 'sent', 'read', 'yes', 'yes', NULL, 'no', 'theerthesh', 'theerthesh', '2023-11-14'),
(3, 0x30613162326333643465356636613762, 'TH002', 'trexcity@gmail.com', 'Trexcity', 'theertheshest@gmail.com', 'Theertheshest', NULL, NULL, 'Subject 1', 'This is the first mail sent', NULL, '2023-11-15', 'delete', 'read', 'yes', 'yes', NULL, 'no', 'user1', 'user1', '2023-11-15'),
(4, 0x30653866316132623363346435653666, 'TH003', 'theertheshest@gmail.com', 'Theertheshest', 'trexcity@gmail.com', 'Trexcity', NULL, NULL, 'Subject 2', 'This is the second mail sent', NULL, '2023-11-15', 'sent', 'read', 'yes', 'no', NULL, 'no', 'user2', 'user2', '2023-11-15'),
(5, 0x30613162326333643465356636613762, 'TH004', 'trexcity@gmail.com', 'Trexcity', 'theerthesh@gmail.com', 'Theerthesh', NULL, NULL, 'Subject 3', 'This is the third mail sent', NULL, '2023-11-15', 'sent', 'unread', 'no', 'no', NULL, 'no', 'user3', 'user3', '2023-11-15'),
(6, 0x30653866316132623363346435653666, 'TH005', 'theertheshest@gmail.com', 'Theertheshest', 'trexcity@gmail.com', 'Trexcity', NULL, NULL, 'Subject 4', 'This is the fourth mail sent', NULL, '2023-11-15', 'sent', 'read', 'no', 'no', NULL, 'no', 'user4', 'user4', '2023-11-15'),
(7, 0x30653866316132623363346435653666, 'TH007', 'theertheshest@gmail.com', 'Theertheshest', 'trexcity@gmail.com', 'Trexcity', NULL, NULL, 'Subject 6', 'This is the sixth mail sent', NULL, '2023-11-15', 'sent', 'read', 'no', 'no', NULL, 'no', 'user6', 'user6', '2023-11-15'),
(8, 0x30613162326333643465356636613762, 'TH008', 'trexcity@gmail.com', 'Trexcity', 'theertheshest@gmail.com', 'Theertheshest', NULL, NULL, 'Subject 7', 'This is the seventh mail sent', NULL, '2023-11-15', 'delete', 'read', 'yes', 'yes', NULL, 'no', 'user7', 'user7', '2023-11-15'),
(9, 0x30653866316132623363346435653666, 'TH009', 'theertheshest@gmail.com', 'Theertheshest', 'trexcity@example.com', 'trexcity', NULL, NULL, 'Subject 8', 'This is the eighth mail sent', NULL, '2023-11-15', 'sent', 'read', 'no', 'no', NULL, 'no', 'user8', 'user8', '2023-11-15'),
(10, 0x30653866316132623363346435653666, 'TH011', 'theertheshest@gmail.com', 'Theertheshest', 'trexcity@gmail.com', 'Trexcity', NULL, NULL, 'Subject 10', 'This is the tenth mail sent', NULL, '2023-11-15', 'sent', 'read', 'no', 'no', NULL, 'no', 'user10', 'user10', '2023-11-15'),
(11, 0x30653866316132623363346435653666, 'TH013', 'theertheshest@gmail.com', 'Theertheshest', 'trexcity@gmail.com', 'Trexcity', NULL, NULL, 'Subject 12', 'This is the twelfth mail sent', NULL, '2023-11-15', 'sent', 'unread', 'no', 'no', 'sample2', 'no', 'user12', 'user12', '2023-11-15'),
(12, 0x30653866316132623363346435653666, 'TH014', 'theertheshest@gmail.com', 'Theertheshest', 'trexcity@example.com', 'Trexcity', NULL, NULL, 'Subject 13', 'This is the thirteenth mail sent', NULL, '2023-11-15', 'sent', 'unread', 'no', 'no', NULL, 'no', 'user13', 'user13', '2023-11-15'),
(13, 0x30613162326333643465356636613762, 'TH015', 'trexcity@gmail.com', 'Trexcity', 'theertheshest@gmail.com', 'Theertheshest', NULL, NULL, 'Subject 14', 'This is the fourteenth mail sent', NULL, '2023-11-15', 'sent', 'read', 'yes', 'yes', NULL, 'no', 'user14', 'user14', '2023-11-15'),
(14, 0x30653866316132623363346435653666, 'TH016', 'theertheshest@gmail.com', 'Theertheshest', 'trexcity@gmail.com', 'Trexcity', NULL, NULL, 'Subject 15', 'This is the fifteenth mail sent', NULL, '2023-11-15', 'sent', 'read', 'no', 'no', NULL, 'no', 'user15', 'user15', '2023-11-15'),
(15, 0x30653866316132623363346435653666, 'TH017', 'theertheshest@gmail.com', 'Theertheshest', 'trexcity@gmail.com', 'Trexcity', NULL, NULL, 'Subject 16', 'This is the sixteenth mail sent', NULL, '2023-11-15', 'sent', 'read', 'yes', 'no', NULL, 'no', 'user16', 'user16', '2023-11-15'),
(16, 0x30653866316132623363346435653666, 'TH019', 'theertheshest@gmail.com', 'Theertheshest', 'trexcity@gmail.com', 'Trexcity', NULL, NULL, 'Subject 18', 'This is the eighteenth mail sent', NULL, '2023-11-15', 'sent', 'read', 'no', 'no', NULL, 'no', 'user18', 'user18', '2023-11-15'),
(17, 0x30653866316132623363346435653666, 'TH031', 'theertheshest@gmail.com', 'Theertheshest', 'smaha24cse@gmail.com', 'Smahacse', '', '', 'third mail', 'khhkjhkjhkj', NULL, '2023-12-11', 'sent', 'read', 'no', 'no', NULL, 'no', 'theerthesh234', 'theerthesh234', '2023-12-11'),
(18, 0x30653866316132623363346435653666, 'TH035', 'theertheshest@gmail.com', 'Theertheshest', 'theertheshwaranthangaraj@gmail.com', 'Theertheshwaranthangaraj', '', '', 'third mail', 'axasx', NULL, '2023-12-13', 'sent', 'read', 'no', 'no', NULL, 'no', 'theerthesh234', 'theerthesh234', '2023-12-13'),
(19, 0x30653866316132623363346435653666, 'TH041', 'theertheshest@gmail.com', 'Theertheshest', 'theertheshwaran@gmail.com', 'Theertheshwaran', '', '', 'sample mail', '12345', NULL, '2023-12-14', 'sent', 'read', 'yes', 'no', NULL, 'no', 'theerthesh234', 'theerthesh234', '2023-12-14'),
(20, 0x30653866316132623363346435653666, 'TH071', 'theertheshest@gmail.com', 'Theertheshest', 'theertheshwaranthangaraj@gmail.com', 'Theertheshwaranthangaraj', '', '', 'third mail', 'asdsdss', NULL, '2023-12-15', 'sent', 'unread', 'no', 'no', NULL, 'no', 'theerthesh234', 'theerthesh234', '2023-12-15'),
(21, 0x30653866316132623363346435653666, 'TH080', 'theertheshest@gmail.com', 'Theertheshest', 'trexcity@gmail.com', 'Trexcity', '', '', 'sample mail', 'iuoiu', NULL, '2023-12-15', 'sent', 'unread', 'no', 'no', NULL, 'no', 'theerthesh234', 'theerthesh234', '2023-12-15'),
(22, 0x30653866316132623363346435653666, 'TH098', 'theertheshest@gmail.com', 'Theertheshest', 'theertheshest@gmail.com', 'Theertheshest', '', '', 'third mail', '', NULL, '2023-12-15', 'delete', 'read', 'yes', 'no', NULL, 'yes', 'theerthesh234', 'theerthesh234', '2023-12-15'),
(23, 0x30653866316132623363346435653666, 'TH078', 'theertheshest@gmail.com', 'Theertheshest', 'theertheshest@gmail.com', 'Theertheshest', '', '', 'sample mail', '', NULL, '2023-12-15', 'sent', 'read', 'yes', 'no', NULL, 'yes', 'theerthesh234', 'theerthesh234', '2023-12-15'),
(24, 0x30653866316132623363346435653666, 'TH039', 'theertheshest@gmail.com', 'Theertheshest', 'theertheshest@gmail.com', 'Theertheshest', '', '', 'third mail', 'scZXZX', NULL, '2023-12-18', 'delete', 'read', 'yes', 'no', NULL, 'no', 'theerthesh234', 'theerthesh234', '2023-12-18'),
(25, 0x30653866316132623363346435653666, 'TH948FB', 'theertheshest@gmail.com', 'Theertheshest', 'theertheshwaranthangaraj@gmail.com', 'Theertheshwaranthangaraj', '', '', 'sample mail', 'jkjklkjk', NULL, '2023-12-18', 'sent', 'read', 'no', 'no', NULL, 'no', 'theerthesh234', 'theerthesh234', '2023-12-18'),
(26, 0x61343235363339313037346234396534, 'TH41E02', 'theer@gmail.com', 'Theer', 'theertheshest@gmail.com', 'Theertheshest', '', '', 'third mail', 'hi is it working?', NULL, '2023-12-18', 'sent', 'read', 'yes', 'no', NULL, 'no', 'theer347', 'theer347', '2023-12-18'),
(27, 0x61343235363339313037346234396534, 'TH089FD', 'theer@gmail.com', 'Theer', 'theertheshest@gmail.com', 'Theertheshest', '', '', 'second entry', 'now is it showing', NULL, '2023-12-18', 'sent', 'read', 'yes', 'no', NULL, 'no', 'theer347', 'theer347', '2023-12-18'),
(28, 0x30653866316132623363346435653666, 'TH7E193', 'theertheshest@gmail.com', 'Theertheshest', 'theer@gmail.com', 'Theer', '', '', 'sample mail', 'hi bro', NULL, '2023-12-18', 'sent', 'unread', 'no', 'no', NULL, 'no', 'theerthesh234', 'theerthesh234', '2023-12-18'),
(29, 0x30653866316132623363346435653666, 'TH74318', 'theertheshest@gmail.com', 'Theertheshest', 'theertheshwaranthangaraj@gmail.com', 'Theertheshwaranthangaraj', '', '', 'third mail', 'scscscscscscscsdcs', NULL, '2023-12-19', 'sent', 'read', 'no', 'no', NULL, 'no', 'theerthesh234', 'theerthesh234', '2023-12-19'),
(30, 0x30653866316132623363346435653666, 'TH03CD9', 'theertheshest@gmail.com', 'Theertheshest', 'theertheshwaranthangaraj@gmail.com', 'Theertheshwaranthangaraj', 'smaha24cse@gmail.com', 'theertheshest@gmail.com', 'hi', 'hello', NULL, '2023-12-19', 'sent', 'unread', 'no', 'no', NULL, 'no', 'theerthesh234', 'theerthesh234', '2023-12-19'),
(31, 0x30653866316132623363346435653666, 'THA9B03', 'theertheshest@gmail.com', 'Theertheshest', 'theertheshwaranthangaraj@gmail.com', 'Theertheshwaranthangaraj', 'smaha24cse@gmail.com', 'theertheshest@gmail.com', 'hi', 'hello', NULL, '2023-12-19', 'sent', 'unread', 'no', 'no', NULL, 'no', 'theerthesh234', 'theerthesh234', '2023-12-19'),
(32, 0x30653866316132623363346435653666, 'TH0783E', 'theertheshest@gmail.com', 'Theertheshest', 'theertheshwaranthangaraj@gmail.com', 'Theertheshwaranthangaraj', '', '', 'second entry', 'feddddsv', NULL, '2023-12-19', 'sent', 'unread', 'no', 'no', NULL, 'no', 'theerthesh234', 'theerthesh234', '2023-12-19'),
(33, 0x30653866316132623363346435653666, 'TH2A671', 'theertheshest@gmail.com', 'Theertheshest', 'theertheshwaranthangaraj@gmail.com', 'Theertheshwaranthangaraj', '', '', 'first entry', 'ddcq', NULL, '2023-12-19', 'sent', 'unread', 'no', 'no', NULL, 'no', 'theerthesh234', 'theerthesh234', '2023-12-19'),
(34, 0x30653866316132623363346435653666, 'TH4170E', 'theertheshest@gmail.com', 'Theertheshest', 'theertheshwaranthangaraj@gmail.com', 'Theertheshwaranthangaraj', 'smaha24cse@gmail.com', 'theertheshest@gmail.com', 'first entry', 'hi hello\r\n', NULL, '2023-12-19', 'sent', 'read', 'no', 'no', NULL, 'no', 'theerthesh234', 'theerthesh234', '2023-12-19'),
(35, 0x30653866316132623363346435653666, 'THB64D9', 'theertheshest@gmail.com', 'Theertheshest', 'theertheshwaranthangaraj@gmail.com', 'Theertheshwaranthangaraj', '', '', 'first entry', 'jiiiiii', NULL, '2023-12-21', 'sent', 'read', 'no', 'no', NULL, 'no', 'theerthesh234', 'theerthesh234', '2023-12-21'),
(36, 0x30653866316132623363346435653666, 'TH316FC', 'theertheshest@gmail.com', 'Theertheshest', 'theertheshwaranthangaraj@gmail.com', 'Theertheshwaranthangaraj', '', '', 'first entry', 'jiiiiii', NULL, '2023-12-21', 'sent', 'unread', 'no', 'no', NULL, 'no', 'theerthesh234', 'theerthesh234', '2023-12-21'),
(37, 0x30653866316132623363346435653666, 'TH4A07C', 'theertheshest@gmail.com', 'Theertheshest', 'theertheshwaranthangaraj@gmail.com', 'Theertheshwaranthangaraj', '', '', 'first entry', 'jiiiiii', NULL, '2023-12-21', 'sent', 'unread', 'no', 'no', NULL, 'no', 'theerthesh234', 'theerthesh234', '2023-12-21'),
(38, 0x30653866316132623363346435653666, 'THF9B35', 'theertheshest@gmail.com', 'Theertheshest', 'theertheshwaranthangaraj@gmail.com', 'Theertheshwaranthangaraj', '', '', 'third mail', 'fvdfv', NULL, '2023-12-21', 'sent', 'unread', 'no', 'no', NULL, 'no', 'theerthesh234', 'theerthesh234', '2023-12-21'),
(39, 0x30653866316132623363346435653666, 'TH6B743', 'theertheshest@gmail.com', 'Theertheshest', 'theertheshwaranthangaraj@gmail.com', 'Theertheshwaranthangaraj', '', '', 'third mail', 'fvdfv', NULL, '2023-12-21', 'sent', 'read', 'no', 'no', NULL, 'no', 'theerthesh234', 'theerthesh234', '2023-12-21'),
(40, 0x30653866316132623363346435653666, 'TH6B12E', 'theertheshest@gmail.com', 'Theertheshest', 'theertheshwaranthangaraj@gmail.com', 'Theertheshwaranthangaraj', '', '', 'sample mail', 'hi', NULL, '2023-12-21', 'sent', 'read', 'no', 'no', NULL, 'no', 'theerthesh234', 'theerthesh234', '2023-12-21');

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
  `password` varchar(255) NOT NULL,
  `profile_status` int(11) NOT NULL DEFAULT 1,
  `profile_path` varchar(255) DEFAULT NULL,
  `date_of_uploading` date DEFAULT NULL,
  `trash_delete` varchar(40) NOT NULL DEFAULT 'no',
  `phone_no` bigint(20) NOT NULL,
  `last_login` date NOT NULL,
  `created_by` varchar(30) NOT NULL,
  `created_on` date NOT NULL,
  `updated_by` varchar(30) NOT NULL,
  `updated_on` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`id`, `token_id`, `email`, `name`, `date_of_birth`, `username`, `password`, `profile_status`, `profile_path`, `date_of_uploading`, `trash_delete`, `phone_no`, `last_login`, `created_by`, `created_on`, `updated_by`, `updated_on`) VALUES
(78, 0x30383137364432333036323834334430, 'ttf@gmail.com', 'Vasan', '2023-09-06', 'ttf235', '$2y$10$UnckVDqYo0h9mzIfPa5azehnbBl0WDr6AwzREmEM99BuVBYcPAgDC', 1, NULL, NULL, 'no', 7889678789, '2023-12-19', 'vasan', '2023-12-19', 'vasan', '2023-12-19'),
(32, 0x30613162326333643465356636613762, 'trexcity@gmail.com', 'Trexcity', '1998-06-28', 'user9', '$2y$10$7Y.Sz0.1WJpj28apbYZ2VOXQDEcinvBdFVbeqhMq9kZwcuAJZLcSq', 0, NULL, NULL, 'no', 6667778888, '2023-12-19', 'admin', '2023-11-15', 'admin', '2023-12-19'),
(52, 0x30653866316132623363346435653666, 'theertheshest@gmail.com', 'Theertheshest', '2023-11-18', 'theerthesh234', '$2y$10$rHcxF/zvtO0g3N/6PftnPu9ejCauKyF6tK5qq9iDbiCuXaycQZeLW', 0, NULL, NULL, 'yes', 9514309298, '2023-12-22', 'theerthesh', '2023-11-08', 'theerthesh', '2023-12-20'),
(70, 0x61316336323839343133303834303166, 'monkey@gmail.com', 'Luffy', '2023-12-13', 'luffy123', '$2y$10$heDRAVHGxdWorECD0AbB/uoud/DZf6DUTR.T2BnLdlEWR.9s6ZC6ynono', 1, NULL, NULL, 'no', 9876895612, '2023-12-18', 'luffy', '2023-12-18', 'luffy', '2023-12-18'),
(53, 0x61343235363339313037346234396534, 'theer@gmail.com', 'Theer', '2023-12-07', 'theer347', '$2y$10$UH8l4prjDc83c0KGAKKddeyUfk8u8TiNkQb/mV39aiDO7FRo9dIK.', 0, NULL, NULL, 'no', 9678990092, '2023-12-18', 'theerthesh', '2023-12-18', 'theerthesh', '2023-12-18');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mail_list`
--
ALTER TABLE `mail_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

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
