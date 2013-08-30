-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 30, 2013 at 01:42 PM
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
(1, '1A', 7),
(2, '1B', 7),
(3, '1D', 7);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `st_id` int(11) NOT NULL AUTO_INCREMENT,
  `st_fname` varchar(255) NOT NULL,
  `st_lname` varchar(255) NOT NULL,
  `st_phone` int(10) NOT NULL,
  `st_faname` varchar(255) NOT NULL,
  `st_mname` varchar(255) NOT NULL,
  `st_queue_num` int(10) NOT NULL,
  `st_enter_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `st_leave_time` timestamp NULL DEFAULT NULL,
  `lab_id` int(11) NOT NULL,
  PRIMARY KEY (`st_id`),
  KEY `st_lab_id` (`lab_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`st_id`, `st_fname`, `st_lname`, `st_phone`, `st_faname`, `st_mname`, `st_queue_num`, `st_enter_time`, `st_leave_time`, `lab_id`) VALUES
(1, 'عبد الرحمن', 'المهايني', 934523798, '', '', 0, '2013-08-21 10:16:02', '2013-08-25 17:18:29', 1),
(2, 'عبد الله', 'النحاس', 112146490, '', '', 0, '2013-08-21 10:16:22', '2013-08-25 18:08:03', 1),
(3, 'محمد أنس', 'المهدي', 112760035, '', '', 0, '2013-08-21 10:16:44', '2013-08-25 16:41:06', 2),
(4, 'محمد', 'محمود', 7520552, '', '', 0, '2013-08-21 12:38:04', '2013-08-25 16:41:12', 2),
(5, 'بشر', 'المهايني', 955852900, '', '', 0, '2013-08-21 13:01:49', '2013-08-25 16:35:13', 3),
(6, 'عبد', 'مهايني', 334523798, '', '', 0, '2013-08-21 13:05:22', '2013-08-25 16:35:16', 3),
(7, 'يبل', 'ؤبلا', 852, '', '', 0, '2013-08-21 13:32:36', '2013-08-26 18:53:37', 1),
(8, 'يبلا', 'ءؤرلا', 8742, '', '', 0, '2013-08-21 13:32:48', NULL, 2),
(9, 'dfgh', 'fgh', 85412, '', '', 0, '2013-08-21 14:02:36', '2013-08-25 16:35:08', 3),
(10, 'أحمد', 'بقدونس', 864532, '', '', 0, '2013-08-25 16:34:36', '2013-08-26 18:53:39', 1),
(11, 'عبد الرحمن', 'المهايني', 6431, '', '', 0, '2013-08-25 16:35:33', NULL, 3),
(12, 'عغفا', 'عغلنت', 96431, '', '', 0, '2013-08-25 16:35:43', NULL, 3),
(13, 'عبد الرحمن', 'لب', 6356, '', '', 0, '2013-08-25 16:41:34', NULL, 2),
(14, 'يبل', 'بلا', 5623, '', '', 0, '2013-08-25 16:41:43', NULL, 2),
(15, 'فبلا', 'فابلتلا', 541, '', '', 0, '2013-08-25 16:42:21', NULL, 3),
(16, 'غعلتاع', 'فغعلات', 632, '', '', 0, '2013-08-25 16:42:28', NULL, 2),
(17, 'قفغفلتال', 'غفغ', 641322, '', '', 0, '2013-08-25 16:42:39', NULL, 3),
(18, 'anas', 'bakla', 966920993, '', '', 0, '2013-08-25 16:55:39', '2013-08-25 16:55:56', 1),
(19, 'fg', 'vgj', 48563, '', '', 0, '2013-08-25 17:18:58', '2013-08-26 18:53:40', 1),
(20, 'erfg', 'dfghj', 784512, '', '', 0, '2013-08-25 18:04:34', '2013-08-26 18:53:41', 1),
(21, 'fgh', 'dfg', 845, '', '', 0, '2013-08-26 16:03:49', '2013-08-26 18:53:43', 1),
(22, 'عمار', 'لقيس', 98623, '', '', 0, '2013-08-26 17:54:57', '2013-08-26 17:55:41', 2),
(23, 'بلا', 'لات', 974512, '', '', 0, '2013-08-26 18:53:51', NULL, 1),
(24, 'بلات', 'لات', 741, '', '', 0, '2013-08-26 18:53:58', NULL, 1),
(25, 'عبد الرحمن', 'المهايني', 4612, '', '', 0, '2013-08-29 17:52:10', NULL, 1),
(26, 'dfgh', 'dfgh', 8965, '', '', 0, '2013-08-29 12:37:14', NULL, 1);

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
