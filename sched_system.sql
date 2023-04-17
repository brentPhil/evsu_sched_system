-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2023 at 01:07 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

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
-- Table structure for table `authorizedpersonnel`
--

CREATE TABLE `authorizedpersonnel` (
  `AuthorizedPersonnelID` int(11) NOT NULL,
  `AuthorizedPersonnelName` varchar(255) DEFAULT NULL,
  `AuthorizedAddress` varchar(255) DEFAULT NULL,
  `AuthorizedPerson_IDPic` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `authorizedpersonnel`
--

INSERT INTO `authorizedpersonnel` (`AuthorizedPersonnelID`, `AuthorizedPersonnelName`, `AuthorizedAddress`, `AuthorizedPerson_IDPic`) VALUES
(7, 'merns luora', 'brgy san roque tanauan leyte', 'uploads/325439610_1166478680925644_337658592216281962_n.jpg'),
(8, 'Brent Philip Ortega', 'brgy san roque tanauan leyte', 'uploads/IMG_20230304_185937_530.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `authorizedpersonnel_archive`
--

CREATE TABLE `authorizedpersonnel_archive` (
  `AuthorizedPersonnelID` int(11) NOT NULL,
  `AuthorizedPersonnelName` varchar(255) DEFAULT NULL,
  `AuthorizedAddress` varchar(255) DEFAULT NULL,
  `AuthorizedPerson_IDPic` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `event_category` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `calendar`
--

INSERT INTO `calendar` (`id`, `app_uid`, `event_type`, `event_date`, `event_length`, `event_category`) VALUES
(181, 19, 'request', '2023-04-27', 1, 4);

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
(16, 'Architecture and Allied Discipline', ''),
(17, 'Education', '');

-- --------------------------------------------------------

--
-- Table structure for table `documentmapping`
--

CREATE TABLE `documentmapping` (
  `id` int(11) NOT NULL,
  `RequestID` int(11) DEFAULT NULL,
  `DocumentID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `documentmapping`
--

INSERT INTO `documentmapping` (`id`, `RequestID`, `DocumentID`) VALUES
(58, 19, 1),
(59, 19, 2);

-- --------------------------------------------------------

--
-- Table structure for table `documentmapping_archive`
--

CREATE TABLE `documentmapping_archive` (
  `id` int(11) NOT NULL,
  `RequestID` int(11) DEFAULT NULL,
  `DocumentID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `documentmapping_archive`
--

INSERT INTO `documentmapping_archive` (`id`, `RequestID`, `DocumentID`) VALUES
(56, 18, 1),
(57, 18, 2);

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `DocumentID` int(11) NOT NULL,
  `DocumentName` varchar(255) DEFAULT NULL,
  `DocumentDescription` text DEFAULT NULL,
  `DocumentImage` varchar(255) DEFAULT 'default.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`DocumentID`, `DocumentName`, `DocumentDescription`, `DocumentImage`) VALUES
(1, 'Transcript', 'Official record of student’s academic history.', 'default.jpg'),
(2, 'Diploma', 'Official document certifying that student has completed degree requirements.', 'default.jpg'),
(3, 'Enrollment Verification', 'Official proof of student’s enrollment status.', 'default.jpg'),
(4, 'Degree Verification', 'Official proof of student’s degree completion.', 'default.jpg'),
(5, 'Grade Report', 'Official record of student’s grades in a particular term.', 'default.jpg'),
(6, 'Course Description', 'Official description of a course offered by the institution.', 'default.jpg'),
(8, 'Financial Aid Verification', 'Official proof of student’s financial aid status.', 'default.jpg'),
(9, 'Student ID Card', 'Official identification card for the student.', 'default.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `RequestID` int(11) NOT NULL,
  `RequestType` varchar(50) DEFAULT NULL,
  `StudentID` int(11) DEFAULT NULL,
  `StudentFullName` varchar(255) DEFAULT NULL,
  `StudentEmail` varchar(255) DEFAULT NULL,
  `StudentAddress` varchar(255) DEFAULT NULL,
  `StudentGender` varchar(50) DEFAULT NULL,
  `StudentPhone` varchar(20) DEFAULT NULL,
  `Department` varchar(255) DEFAULT NULL,
  `Course` varchar(255) DEFAULT NULL,
  `Education` varchar(255) DEFAULT NULL,
  `Schedule` varchar(255) DEFAULT NULL,
  `AuthorizedPersonnelID` int(11) DEFAULT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `RequestStatus` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`RequestID`, `RequestType`, `StudentID`, `StudentFullName`, `StudentEmail`, `StudentAddress`, `StudentGender`, `StudentPhone`, `Department`, `Course`, `Education`, `Schedule`, `AuthorizedPersonnelID`, `CreatedAt`, `RequestStatus`) VALUES
(19, 'authorized', 11, 'denzy, joebe M.', 'jackalatern@gmail.com', 'brgy san roque tanauan leyte', 'male', '2147483647', 'Technology', 'Bachelor of Science in Industrial Technology with major in: Civil Construction', 'undergraduate', '2023-04-27', 8, '2023-04-17 00:09:52', '0');

-- --------------------------------------------------------

--
-- Table structure for table `request_archive`
--

CREATE TABLE `request_archive` (
  `RequestID` int(11) NOT NULL,
  `RequestType` varchar(50) DEFAULT NULL,
  `StudentID` int(11) DEFAULT NULL,
  `StudentFullName` varchar(255) DEFAULT NULL,
  `StudentEmail` varchar(255) DEFAULT NULL,
  `StudentAddress` varchar(255) DEFAULT NULL,
  `StudentGender` varchar(50) DEFAULT NULL,
  `StudentPhone` varchar(20) DEFAULT NULL,
  `Department` varchar(255) DEFAULT NULL,
  `Course` varchar(255) DEFAULT NULL,
  `Education` varchar(255) DEFAULT NULL,
  `Schedule` varchar(255) DEFAULT NULL,
  `AuthorizedPersonnelID` int(11) DEFAULT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `RequestStatus` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `request_archive`
--

INSERT INTO `request_archive` (`RequestID`, `RequestType`, `StudentID`, `StudentFullName`, `StudentEmail`, `StudentAddress`, `StudentGender`, `StudentPhone`, `Department`, `Course`, `Education`, `Schedule`, `AuthorizedPersonnelID`, `CreatedAt`, `RequestStatus`) VALUES
(18, 'personal', 11, 'denzy, joebe M.', 'jackalatern@gmail.com', 'brgy san roque tanauan leyte', 'male', '2147483647', 'Technology', '', '', '2023-04-27', NULL, '2023-04-17 00:03:25', 'canceled');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `st_id` int(25) NOT NULL,
  `dept_id` int(25) NOT NULL,
  `student_id` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`st_id`, `dept_id`, `student_id`, `password`, `user_name`) VALUES
(11, 2, '2019-35780', '$2y$10$xcez3GkoWJGFcfMTbc4Dbe4Je4JUpK6lM1Xho/U.eM4.T9EV68YtW', 'jackFrozen');

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
(13, 4, 9, 'jackerberg', 'mark', 'l.', 'male', 'brgy san roque tanauan leyte', 'brentagetrophil@gmail.com', 2147483647),
(14, 7, 8, 'frozen2', 'jack', 'M', 'male', 'brgy san roque tanauan leyte', 'jackalatern@gmail.com', 2147483647),
(15, 9, 0, 'brent.agetro@gmail.com', 'Brent Philip Jr. Front End Developer Ortega', 'Brent Philip Jr. Front End Developer Ortega', 'male', 'brgy san roque tanauan leyte', 'brent.agetro@gmail.com', 2147483647),
(16, 11, 13, 'denzy', 'joebe', 'M', 'male', 'brgy san roque tanauan leyte', 'jackalatern@gmail.com', 2147483647);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `authorizedpersonnel`
--
ALTER TABLE `authorizedpersonnel`
  ADD PRIMARY KEY (`AuthorizedPersonnelID`);

--
-- Indexes for table `authorizedpersonnel_archive`
--
ALTER TABLE `authorizedpersonnel_archive`
  ADD PRIMARY KEY (`AuthorizedPersonnelID`);

--
-- Indexes for table `calendar`
--
ALTER TABLE `calendar`
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
-- Indexes for table `documentmapping`
--
ALTER TABLE `documentmapping`
  ADD PRIMARY KEY (`id`),
  ADD KEY `DocumentID` (`DocumentID`),
  ADD KEY `documentmapping_ibfk_1` (`RequestID`);

--
-- Indexes for table `documentmapping_archive`
--
ALTER TABLE `documentmapping_archive`
  ADD PRIMARY KEY (`id`),
  ADD KEY `DocumentID` (`DocumentID`),
  ADD KEY `documentmapping_ibfk_1` (`RequestID`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`DocumentID`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`RequestID`),
  ADD KEY `AuthorizedPersonnelID` (`AuthorizedPersonnelID`),
  ADD KEY `StudentID` (`StudentID`);

--
-- Indexes for table `request_archive`
--
ALTER TABLE `request_archive`
  ADD PRIMARY KEY (`RequestID`),
  ADD KEY `AuthorizedPersonnelID` (`AuthorizedPersonnelID`),
  ADD KEY `StudentID` (`StudentID`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `authorizedpersonnel`
--
ALTER TABLE `authorizedpersonnel`
  MODIFY `AuthorizedPersonnelID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `authorizedpersonnel_archive`
--
ALTER TABLE `authorizedpersonnel_archive`
  MODIFY `AuthorizedPersonnelID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `calendar`
--
ALTER TABLE `calendar`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=182;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `deppartment`
--
ALTER TABLE `deppartment`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `documentmapping`
--
ALTER TABLE `documentmapping`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `documentmapping_archive`
--
ALTER TABLE `documentmapping_archive`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `RequestID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `request_archive`
--
ALTER TABLE `request_archive`
  MODIFY `RequestID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `st_id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `st_profile`
--
ALTER TABLE `st_profile`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `documentmapping`
--
ALTER TABLE `documentmapping`
  ADD CONSTRAINT `documentmapping_ibfk_1` FOREIGN KEY (`RequestID`) REFERENCES `request` (`RequestID`),
  ADD CONSTRAINT `documentmapping_ibfk_2` FOREIGN KEY (`DocumentID`) REFERENCES `documents` (`DocumentID`);

--
-- Constraints for table `request`
--
ALTER TABLE `request`
  ADD CONSTRAINT `request_ibfk_2` FOREIGN KEY (`StudentID`) REFERENCES `student` (`st_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
