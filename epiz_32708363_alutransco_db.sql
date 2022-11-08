-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql101.epizy.com
-- Generation Time: Oct 04, 2022 at 07:58 AM
-- Server version: 10.3.27-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `epiz_32708363_alutransco_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `firstname`, `lastname`, `username`, `password`) VALUES
(1, 'Nestor', 'Lucino', 'admin', '$2y$10$W8d9n.kIZD9sI7PefamHIeO.9vQIqWBi6.QJYr2fEH8l2UkY6Csey');

-- --------------------------------------------------------

--
-- Table structure for table `buses`
--

CREATE TABLE `buses` (
  `bus_id` int(11) NOT NULL,
  `bus_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `buses`
--

INSERT INTO `buses` (`bus_id`, `bus_name`) VALUES
(6, 'OLEB 8018'),
(7, 'OLEB 8108'),
(8, 'OLEB 8508'),
(9, 'OLEB 8058'),
(10, 'OLEB 8088'),
(11, 'OLEB 8068'),
(12, 'OLEB 8208'),
(13, 'RCA 31114'),
(14, 'RCA 31141'),
(15, 'ENGAÃ‘O 121'),
(16, 'ENGAÃ‘O 1120'),
(17, 'ENGAÃ‘O 1631'),
(18, 'ENGAÃ‘O 8018'),
(19, 'ENGAÃ‘O 1010'),
(20, 'ENGAÃ‘O 8038'),
(21, 'RCA 314'),
(22, 'GBP'),
(23, 'JRCJ 112'),
(24, 'WINNER 8068'),
(25, 'WINNER 8028'),
(26, 'GBP 21'),
(27, 'BENFREN 345'),
(28, 'BENFREN 422'),
(29, 'LAGRANA 8048'),
(30, 'LAGRANA 8058'),
(31, 'LAGRANA 8038');

-- --------------------------------------------------------

--
-- Table structure for table `deductions`
--

CREATE TABLE `deductions` (
  `deduc_id` int(11) NOT NULL,
  `description` varchar(100) NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `deductions`
--

INSERT INTO `deductions` (`deduc_id`, `description`, `amount`) VALUES
(1, 'SSS/Philhealth/Pagibig', 500);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `emp_id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `middlename` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`emp_id`, `firstname`, `middlename`, `lastname`, `address`, `contact`, `type`) VALUES
(6, 'Orlando', '', 'Albay', '', '', 3),
(7, 'Ariel', '', 'Alegonza', '', '', 3),
(8, 'Ipong', '', '-', '', '', 1),
(9, 'Roderick', '', '-', '', '', 1),
(10, 'Aldrin', '', '-', '', '', 1),
(11, 'Dante', '', '-', '', '', 1),
(12, 'Armand', '', '-', '', '', 1),
(13, 'Tyson', '', '-', '', '', 1),
(14, 'Eugene', '', '-', '', '', 1),
(15, 'Jasper', '', '-', '', '', 1),
(16, 'Reynaldo', '', '-', '', '', 1),
(17, 'Fernand', '', '-', '', '', 1),
(18, 'Jeofren', '', '-', '', '', 2),
(19, 'Artchie', '', '-', '', '', 2),
(20, 'Joel', '', '-', '', '', 2),
(21, 'Christian', '', '-', '', '', 2),
(22, 'Michael', '', '-', '', '', 2),
(23, 'Mac', '', '-', '', '', 2),
(24, 'Pablito', '', '-', '', '', 2),
(25, 'Nestor', '', '-', '', '', 2),
(26, 'Jojo', '', '-', '', '', 2),
(27, 'Eric', '', '-', '', '', 2),
(28, 'NiÃ±o', '', '-', '', '', 1),
(29, 'Anes', '', '-', '', '', 1),
(30, 'Genry', '', '-', '', '', 1),
(31, 'Anthony', '', '-', '', '', 1),
(32, 'Jonas', '', '-', '', '', 1),
(33, 'Madriaga', '', '-', '', '', 1),
(34, 'Jorge', '', '-', '', '', 1),
(35, 'Romeo', '', '-', '', '', 1),
(36, 'Denver', '', '-', '', '', 1),
(37, 'Piolo', '', '-', '', '', 1),
(38, 'Ariel', '', '-', '', '', 2),
(39, 'Dody', '', '-', '', '', 2),
(40, 'John', '', '-', '', '', 2),
(41, 'Dominador', '', '-', '', '', 2),
(42, 'Alex', '', '-', '', '', 2),
(43, 'Cesar', '', '-', '', '', 2),
(44, 'Biboy', '', '-', '', '', 2),
(45, 'Wilfredo', '', '-', '', '', 2),
(46, 'Paul', '', '-', '', '', 2),
(47, 'JB', '', '-', '', '', 2),
(48, 'Tano', '', '-', '', '', 1),
(49, 'Danny', '', '-', '', '', 2),
(50, 'Jero', '', '-', '', '', 1),
(51, 'Ryan', '', '-', '', '', 2),
(52, 'Aris', '', '-', '', '', 1),
(53, 'Renato', '', '-', '', '', 2),
(54, 'JC', '', '-', '', '', 1),
(55, 'Daguio', '', '-', '', '', 2),
(56, 'Robert', '', '-', '', '', 1),
(57, 'Edson', '', '-', '', '', 2),
(58, 'Traceton', '', '-', '', '', 1),
(59, 'Jomier', '', '-', '', '', 2);

-- --------------------------------------------------------

--
-- Table structure for table `trips`
--

CREATE TABLE `trips` (
  `trip_id` int(11) NOT NULL,
  `bus_id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `conductor_id` int(11) NOT NULL,
  `dispatcher_id` int(11) NOT NULL,
  `earnings` float DEFAULT NULL,
  `maintenance` float DEFAULT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `trips`
--

INSERT INTO `trips` (`trip_id`, `bus_id`, `driver_id`, `conductor_id`, `dispatcher_id`, `earnings`, `maintenance`, `date`) VALUES
(15, 6, 8, 18, 6, 14500, 1250, '2022-10-02'),
(16, 7, 9, 19, 7, 8500, 525, '2022-10-02'),
(17, 16, 28, 38, 6, 17500, 350, '2022-10-02'),
(18, 27, 12, 44, 6, 6500, 450, '2022-10-03'),
(19, 16, 10, 49, 6, 10000, 500, '2022-10-03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `buses`
--
ALTER TABLE `buses`
  ADD PRIMARY KEY (`bus_id`);

--
-- Indexes for table `deductions`
--
ALTER TABLE `deductions`
  ADD PRIMARY KEY (`deduc_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`emp_id`);

--
-- Indexes for table `trips`
--
ALTER TABLE `trips`
  ADD PRIMARY KEY (`trip_id`),
  ADD KEY `driver_id` (`driver_id`),
  ADD KEY `bus_id` (`bus_id`),
  ADD KEY `trips_ibfk_3` (`conductor_id`),
  ADD KEY `dispatcher_id` (`dispatcher_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `buses`
--
ALTER TABLE `buses`
  MODIFY `bus_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `deductions`
--
ALTER TABLE `deductions`
  MODIFY `deduc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `emp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `trips`
--
ALTER TABLE `trips`
  MODIFY `trip_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `trips`
--
ALTER TABLE `trips`
  ADD CONSTRAINT `trips_ibfk_1` FOREIGN KEY (`bus_id`) REFERENCES `buses` (`bus_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `trips_ibfk_2` FOREIGN KEY (`driver_id`) REFERENCES `employees` (`emp_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `trips_ibfk_3` FOREIGN KEY (`conductor_id`) REFERENCES `employees` (`emp_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `trips_ibfk_4` FOREIGN KEY (`dispatcher_id`) REFERENCES `employees` (`emp_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
