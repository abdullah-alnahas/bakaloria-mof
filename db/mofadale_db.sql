-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 21, 2013 at 03:18 PM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mofadale_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `lab`
--

CREATE TABLE IF NOT EXISTS `lab` (
  `lab_id` int(11) NOT NULL AUTO_INCREMENT,
  `lab_name` varchar(255) NOT NULL,
  `lab_max_voloum` int(11) NOT NULL,
  PRIMARY KEY (`lab_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `lab`
--

INSERT INTO `lab` (`lab_id`, `lab_name`, `lab_max_voloum`) VALUES
(1, '1A', 25),
(2, '1B', 25),
(3, '1D', 25);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `st_id` int(11) NOT NULL AUTO_INCREMENT,
  `st_fname` varchar(255) NOT NULL,
  `st_lname` varchar(255) NOT NULL,
  `st_phone` int(10) NOT NULL,
  `st_enter_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `st_leave_time` timestamp NULL DEFAULT NULL,
  `lab_id` int(11) NOT NULL,
  PRIMARY KEY (`st_id`),
  KEY `st_lab_id` (`lab_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`st_id`, `st_fname`, `st_lname`, `st_phone`, `st_enter_time`, `st_leave_time`, `lab_id`) VALUES
(1, 'عبد الرحمن', 'المهايني', 934523798, '2013-08-21 10:16:02', NULL, 1),
(2, 'عبد الله', 'النحاس', 112146490, '2013-08-21 10:16:22', NULL, 1),
(3, 'محمد أنس', 'المهدي', 112760035, '2013-08-21 10:16:44', NULL, 2);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`lab_id`) REFERENCES `lab` (`lab_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
