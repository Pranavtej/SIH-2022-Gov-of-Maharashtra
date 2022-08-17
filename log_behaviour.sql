-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 17, 2022 at 05:43 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test2`
--

-- --------------------------------------------------------

--
-- Table structure for table `log_behaviour`
--

CREATE TABLE `log_behaviour` (
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `student_id` varchar(20) NOT NULL,
  `teacher_id` varchar(20) NOT NULL,
  `purpose` varchar(120) NOT NULL,
  `points` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `log_behaviour`
--

INSERT INTO `log_behaviour` (`timestamp`, `student_id`, `teacher_id`, `purpose`, `points`) VALUES
('2022-08-17 12:33:10', 'ST1000', 'TE0001', 'attentiveness in the class', 50),
('2022-08-17 12:33:56', 'ST1000', 'TE0001', 'behaviour good', 150),
('2022-08-17 12:37:16', 'ST1000', 'TE0001', 'behaviour good', 150),
('2022-08-17 12:43:26', 'ST1059', 'TE0008', 'good behaviour', 50),
('2022-08-17 12:47:16', 'ST1000', 'TE0001', 'Not so attentive in the class', 50);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `log_behaviour`
--
ALTER TABLE `log_behaviour`
  ADD PRIMARY KEY (`timestamp`,`student_id`,`teacher_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
