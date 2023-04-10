-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 05, 2023 at 06:52 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sched_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(25) NOT NULL,
  `dept_id` int(25) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `dept_id`, `username`, `email`, `password`) VALUES
(3, 0, 'adminxx', 'admin.edu.evsu.com', '$2y$10$bFJUZ2ZjpRTrf8dAr6A2Uu4pI0WAA6W20PaIzHHoU9GrxtfdPUgiO'),
(4, 1, 'Engineering', 'adminEngi@edu.evsu.com', '$2y$10$S4F9I2EN9ukrfTf0KBC5KO5dq5RA.X.rHqmZZ4KE.15u2iDeZsil2'),
(5, 2, 'Technology', 'admin_tech@edu_evsu.com', '$2y$10$M/ZaczpR9IoZHxUD9mA4Iu9JKECtuflRkEs5MjtolvgmWvUZ8S4IW');

-- --------------------------------------------------------

--
-- Table structure for table `archive`
--

CREATE TABLE `archive` (
  `rq_id` int(25) NOT NULL,
  `st_uid` int(25) NOT NULL,
  `rq_cert` int(11) NOT NULL,
  `dept_id` int(25) DEFAULT NULL,
  `course_id` int(25) NOT NULL,
  `app_type` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `a_gender` varchar(255) NOT NULL,
  `a_phone` varchar(255) NOT NULL,
  `edu_status` varchar(255) NOT NULL,
  `rq_schedule` varchar(255) NOT NULL,
  `request_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `archive`
--

INSERT INTO `archive` (`rq_id`, `st_uid`, `rq_cert`, `dept_id`, `course_id`, `app_type`, `full_name`, `a_gender`, `a_phone`, `edu_status`, `rq_schedule`, `request_status`) VALUES
(77, 4, 1008, 2, 9, 'authorize', 'brent philip l ortega', 'Male', '2147483647', 'Graduate', '2022-12-23T20:11', 'Released'),
(79, 4, 3818, 2, 9, 'personal', '', '', '0', 'Graduate', '2022-12-22T19:16', 'Released');

-- --------------------------------------------------------

--
-- Table structure for table `calendar`
--

CREATE TABLE `calendar` (
  `id` int(25) NOT NULL,
  `app_uid` int(25) NOT NULL,
  `event_type` varchar(255) NOT NULL,
  `event_date` date NOT NULL,
  `event_length` int(25) NOT NULL,
  `event_category` int(25) NOT NULL,
  `dept_id` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `calendar`
--

INSERT INTO `calendar` (`id`, `app_uid`, `event_type`, `event_date`, `event_length`, `event_category`, `dept_id`) VALUES
(109, 3, 'holiday', '2022-12-15', 1, 1, 1),
(110, 3, 'christmas', '2022-12-25', 1, 3, 1),
(149, 3, 'cod', '0000-00-00', 1, 2, 1),
(151, 3, 'holiday', '2022-12-28', 2, 2, 1),
(153, 78, 'request', '2022-12-22', 1, 4, 2);

-- --------------------------------------------------------

--
-- Table structure for table `certifications`
--

CREATE TABLE `certifications` (
  `id` int(25) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(25) NOT NULL,
  `dept_id` int(25) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `dept_id`, `name`, `description`) VALUES
(1, 1, 'Bachelor of Science in Chemical Engineering (BSChE)', ''),
(2, 1, 'Bachelor of Science in Civil Engineering (BSCE)', ''),
(3, 1, 'Bachelor of Science in Electronics Engineering (BSECE)', ''),
(4, 1, 'Bachelor of Science in Electrical Engineering (BSEE)', ''),
(5, 1, 'Bachelor of Science in Geodetic Engineering (BSGE)', ''),
(6, 1, 'Bachelor of Science in Mechanical Engineering (BSME)', ''),
(7, 1, 'Bachelor of Science in Industrial Engineering (BSIE)', ''),
(8, 1, 'Bachelor of Science in Information Technology (BSIT)', ''),
(9, 2, 'Bachelor of Science in Hospitality Management (BSHM)', ''),
(10, 2, 'Bachelor of Science in Nutrition & Dietetics (BSND)', ''),
(12, 0, '', ''),
(13, 2, 'Bachelor of Science in Industrial Technology with major in: Civil Construction', '');

-- --------------------------------------------------------

--
-- Table structure for table `deppartment`
--

CREATE TABLE `deppartment` (
  `id` int(25) NOT NULL,
  `dept` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `deppartment`
--

INSERT INTO `deppartment` (`id`, `dept`, `description`) VALUES
(1, 'Engineering', ''),
(2, 'Technology', ''),
(12, '', ''),
(13, 'Education', ''),
(14, 'Business and Entrepreneurship', ''),
(15, 'Arts and Sciences', ''),
(16, 'Architecture and Allied Discipline', '');

-- --------------------------------------------------------

--
-- Table structure for table `request_options`
--

CREATE TABLE `request_options` (
  `id` int(25) NOT NULL,
  `rq_id` int(25) NOT NULL,
  `cert_id` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `request_options`
--

INSERT INTO `request_options` (`id`, `rq_id`, `cert_id`) VALUES
(124, 52, 1),
(128, 8850, 1),
(129, 8850, 8),
(130, 6457, 1),
(131, 6457, 8);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `st_id` int(25) NOT NULL,
  `dept_id` int(25) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`st_id`, `dept_id`, `username`, `email`, `password`, `user_name`) VALUES
(3, 1, '2019-35780', 'markel@gmail.com', '$2y$10$LvLdtmdE2l5I4KzhisaIV.o5vy19hpEyvAPe7m1tI3vmbpmYbSxEW', 'markel'),
(4, 2, '2019-87544', 'zackYChan@gmail.com', '$2y$10$lkdDf8dPND.gOblpr3R8EOa85lNcshqJQNK04Z1KKZj.zSOS/kf0y', 'zackChan'),
(5, 15, '2019-53894', 'brentagetrophil@gmail.com', '$2y$10$OubpJOkdch4JX2fG245.A.tlMe0LNMD5YYozb30Qb5t77D.g31796', 'brenyy'),
(6, 2, '1990-65478', 'brentagetrophil@gmail.com', '$2y$10$MK29bVSLb2sHu0p3yXI1p.55DJAvIet4p/K8tfGNv5ebr6CQKNNBm', 'brent bayot');

-- --------------------------------------------------------

--
-- Table structure for table `st_profile`
--

CREATE TABLE `st_profile` (
  `id` int(25) NOT NULL,
  `st_uid` int(25) NOT NULL,
  `course_id` int(25) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `middle` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `st_profile`
--

INSERT INTO `st_profile` (`id`, `st_uid`, `course_id`, `lname`, `fname`, `middle`, `gender`, `address`, `email`, `phone`) VALUES
(12, 3, 1, 'robert', 'hanze', 's', 'male', 'brgy san roque tanauan leyte', 'hanzeSolo@gmail.com', 2147483647),
(13, 4, 9, 'jackerberg', 'mark', 'l.', 'male', 'brgy san roque tanauan leyte', 'brentagetrophil@gmail.com', 2147483647);

-- --------------------------------------------------------

--
-- Table structure for table `st_request`
--

CREATE TABLE `st_request` (
  `rq_id` int(25) NOT NULL,
  `st_uid` int(25) NOT NULL,
  `rq_cert` int(11) NOT NULL,
  `dept_id` int(25) DEFAULT NULL,
  `course_id` int(25) NOT NULL,
  `app_type` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `a_gender` varchar(255) NOT NULL,
  `a_phone` int(12) NOT NULL,
  `edu_status` varchar(255) NOT NULL,
  `rq_schedule` varchar(255) NOT NULL,
  `request_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `st_request`
--

INSERT INTO `st_request` (`rq_id`, `st_uid`, `rq_cert`, `dept_id`, `course_id`, `app_type`, `full_name`, `a_gender`, `a_phone`, `edu_status`, `rq_schedule`, `request_status`) VALUES
(78, 4, 775, 2, 10, 'personal', '', '', 0, '2nd year', '2022-12-22T21:23', 'on process...'),
(80, 4, 9479, 2, 9, 'personal', '', '', 0, 'Graduate', '2022-12-24T23:16', 'pending...');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `archive`
--
ALTER TABLE `archive`
  ADD PRIMARY KEY (`rq_id`);

--
-- Indexes for table `calendar`
--
ALTER TABLE `calendar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `certifications`
--
ALTER TABLE `certifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deppartment`
--
ALTER TABLE `deppartment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request_options`
--
ALTER TABLE `request_options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`st_id`);

--
-- Indexes for table `st_profile`
--
ALTER TABLE `st_profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `st_request`
--
ALTER TABLE `st_request`
  ADD PRIMARY KEY (`rq_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `archive`
--
ALTER TABLE `archive`
  MODIFY `rq_id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `calendar`
--
ALTER TABLE `calendar`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=155;

--
-- AUTO_INCREMENT for table `certifications`
--
ALTER TABLE `certifications`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `deppartment`
--
ALTER TABLE `deppartment`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `request_options`
--
ALTER TABLE `request_options`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `st_id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `st_profile`
--
ALTER TABLE `st_profile`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `st_request`
--
ALTER TABLE `st_request`
  MODIFY `rq_id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
