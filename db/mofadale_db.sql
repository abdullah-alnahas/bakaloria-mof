-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 04, 2013 at 09:54 AM
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
-- Table structure for table `counter`
--

CREATE TABLE IF NOT EXISTS `counter` (
  `counter_id` int(11) NOT NULL AUTO_INCREMENT,
  `counter_value` int(11) NOT NULL,
  `counter_last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`counter_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- Dumping data for table `counter`
--

INSERT INTO `counter` (`counter_id`, `counter_value`, `counter_last_update`) VALUES
(1, 60, '2013-09-04 06:06:02');

-- --------------------------------------------------------

--
-- Table structure for table `lab`
--

CREATE TABLE IF NOT EXISTS `lab` (
  `lab_id` int(11) NOT NULL AUTO_INCREMENT,
  `lab_name` varchar(255) NOT NULL,
  `lab_max_voloum` int(11) NOT NULL,
  PRIMARY KEY (`lab_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `lab`
--

INSERT INTO `lab` (`lab_id`, `lab_name`, `lab_max_voloum`) VALUES
(1, '1C', 15),
(2, '1F', 15);

-- --------------------------------------------------------

--
-- Table structure for table `pc`
--

CREATE TABLE IF NOT EXISTS `pc` (
  `pc_id` int(11) NOT NULL AUTO_INCREMENT,
  `pc_name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `pc_availability` tinyint(1) NOT NULL DEFAULT '1',
  `pc_is_working` tinyint(1) NOT NULL DEFAULT '0',
  `lab_id` int(11) NOT NULL,
  PRIMARY KEY (`pc_id`),
  KEY `pc_lab_id` (`lab_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=31 ;

--
-- Dumping data for table `pc`
--

INSERT INTO `pc` (`pc_id`, `pc_name`, `pc_availability`, `pc_is_working`, `lab_id`) VALUES
(1, 'PC-1', 1, 0, 1),
(2, 'PC-2', 0, 1, 1),
(3, 'PC-3', 0, 1, 1),
(4, 'PC-4', 0, 1, 1),
(5, 'PC-5', 0, 1, 1),
(6, 'PC-6', 0, 1, 1),
(7, 'PC-7', 1, 0, 1),
(8, 'PC-8', 1, 0, 1),
(9, 'PC-9', 1, 0, 1),
(10, 'PC-10', 1, 0, 1),
(11, 'PC-11', 0, 1, 1),
(12, 'PC-12', 1, 0, 1),
(13, 'PC-13', 1, 0, 1),
(14, 'PC-14', 0, 1, 1),
(15, 'PC-15', 1, 0, 1),
(16, 'PC-1', 0, 1, 2),
(17, 'PC-2', 0, 1, 2),
(18, 'PC-3', 0, 1, 2),
(19, 'PC-4', 0, 1, 2),
(20, 'PC-5', 1, 0, 2),
(21, 'PC-6', 1, 0, 2),
(22, 'PC-7', 1, 0, 2),
(23, 'PC-8', 1, 0, 2),
(24, 'PC-9', 1, 0, 2),
(25, 'PC-10', 1, 0, 2),
(26, 'PC-11', 1, 0, 2),
(27, 'PC-12', 1, 0, 2),
(28, 'PC-13', 1, 0, 2),
(29, 'PC-14', 1, 0, 2),
(30, 'PC-15', 1, 0, 2);

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
  `pc_id` int(11) NOT NULL,
  PRIMARY KEY (`st_id`),
  KEY `st_lab_id` (`lab_id`),
  KEY `pc_id` (`pc_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=101 ;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`st_id`, `st_fname`, `st_lname`, `st_phone`, `st_faname`, `st_mname`, `st_queue_num`, `st_enter_time`, `st_leave_time`, `lab_id`, `pc_id`) VALUES
(52, 'kjg', 'kg', 87, 'hg', 'hg', 7, '2013-09-03 03:21:10', '2013-09-03 03:58:07', 1, 2),
(53, 'kjg', 'kjg', 87, 'jg', 'kjg', 97, '2013-09-03 03:57:16', '2013-09-03 04:00:12', 1, 2),
(54, 'kjg', 'hg', 7, 'jhg', 'hg', 87, '2013-09-03 04:00:32', '2013-09-03 04:44:51', 1, 2),
(55, 'h', 'jbh', 9, 'jh', 'jk', 4, '2013-09-03 04:00:42', '2013-09-03 04:44:54', 1, 3),
(56, 'jhg', 'hjg', 87, 'h', 'hg', 1, '2013-09-03 04:00:53', '2013-09-03 04:44:55', 2, 16),
(57, 'jb', 'mh', 87, 'hhgg', 'mh', 879, '2013-09-03 04:01:35', '2013-09-03 04:44:56', 2, 17),
(60, 'jhb', 'jh', 8, 'jkg', 'jkhg', 87, '2013-09-03 04:05:08', '2013-09-03 04:44:57', 1, 11),
(61, 'kjh', 'jkh', 98, 'kkj', 'jb', 8, '2013-09-03 04:05:25', '2013-09-03 04:44:59', 2, 18),
(62, 'kjug', 'kjhg', 87, 'hj', 'jh', 7, '2013-09-03 04:42:58', '2013-09-03 04:45:00', 2, 19),
(63, 'jhg', 'jhg', 87, 'jhf', 'hf', 7, '2013-09-03 04:45:08', '2013-09-03 05:12:12', 1, 2),
(64, 'jkhg', 'kjhg', 98, 'jjhf', 'hjf', 9, '2013-09-03 04:45:17', '2013-09-03 04:47:36', 2, 16),
(65, 'kjhg', 'jkg', 897, 'hjg', 'h', 5, '2013-09-03 04:45:27', '2013-09-03 04:47:34', 1, 3),
(66, 'lkih', 'jg', 82, 'jhg', 'h', 1, '2013-09-03 04:45:37', '2013-09-03 06:14:46', 2, 17),
(67, 'kjg', 'j', 8, 'gj', 'hg', 1, '2013-09-03 04:45:46', '2013-09-03 05:44:14', 1, 11),
(68, 'kjg', 'hg', 9, 'jhf', 'f', 5, '2013-09-03 04:46:08', '2013-09-03 06:14:47', 2, 18),
(69, 'j', 'h', 9, 'jhg', 'jhf', 2, '2013-09-03 04:46:16', '2013-09-03 06:04:29', 2, 19),
(70, 'jkg', 'jh', 9, 'jhf', 'hf', 1, '2013-09-03 04:47:47', '2013-09-03 06:00:01', 1, 3),
(71, 'jhg', 'jhf', 87, 'jhf', 'jhf', 4, '2013-09-03 05:11:46', '2013-09-03 05:12:08', 2, 16),
(72, 'jh', 'kjhg', 87, 'hg', 'jh', 4, '2013-09-03 05:12:21', '2013-09-03 06:00:03', 1, 2),
(73, 'jkg', 'hg', 8, 'jh', 'g', 5, '2013-09-03 05:12:42', '2013-09-03 06:14:48', 2, 16),
(74, 'hjgj', 'hjgj', 7, 'hjf', 'ghf', 7, '2013-09-03 05:20:30', '2013-09-03 06:14:37', 1, 4),
(75, 'kjg', 'kjg', 6, 'h', 'g', 787, '2013-09-03 05:20:41', '2013-09-03 06:04:19', 1, 5),
(76, 'kgu', 'jjhg', 87, 'jhg', 'jhg', 7, '2013-09-03 05:51:02', '2013-09-03 06:14:38', 1, 6),
(77, 'kjg', 'hg', 7, 'jhg', 'hjg', 8, '2013-09-03 05:51:14', '2013-09-03 06:14:40', 1, 11),
(78, 'jkh', 'jh', 8, 'jh', 'jg', 6, '2013-09-03 05:52:33', '2013-09-03 06:04:26', 1, 14),
(79, 'تنا', 'نتا', 87, 'تا', 'نتا', 7, '2013-09-03 06:00:20', '2013-09-03 06:14:41', 1, 2),
(80, 'تا', 'نتل', 87, 'نتال', 'تال', 4, '2013-09-03 06:00:30', '2013-09-03 06:04:23', 1, 3),
(81, 'ljh', 'jh', 87, 'kjkh', 'jkg', 7, '2013-09-03 06:04:39', '2013-09-03 06:14:50', 2, 19),
(82, 'klh', 'kjh', 7, 'jh', 'jhj', 7, '2013-09-03 06:04:53', '2013-09-03 06:14:42', 1, 3),
(83, 'lkj', 'kj', 7, 'khkjh', 'kjh', 9, '2013-09-03 06:05:05', '2013-09-03 06:14:43', 1, 5),
(84, 'klh', 'kh', 87, 'kjh', 'kjh', 6, '2013-09-03 06:05:13', '2013-09-03 06:14:45', 1, 14),
(85, 'kjh', 'jkhg', 87, 'kjgk', 'jh', 87, '2013-09-03 06:15:00', '2013-09-03 07:03:07', 1, 2),
(86, 'jkh', 'jg', 7, 'hjg', 'jg', 8, '2013-09-03 06:15:11', '2013-09-03 07:03:45', 2, 16),
(88, 'بشر', 'المهايني', 54, 'جهاد', 'ندى', 4, '2013-09-03 06:50:20', NULL, 2, 17),
(89, 'حازم ', 'المهايني', 58, 'جهاد', 'ندى', 5, '2013-09-03 06:51:24', '2013-09-03 06:58:13', 1, 4),
(90, 'وسيم', 'المهايني', 547, 'جهاد', 'ندى', 4, '2013-09-03 06:54:22', NULL, 2, 18),
(91, 'حازم', 'المهايني', 87, 'جهاد', 'ندى', 45, '2013-09-03 06:56:49', NULL, 1, 5),
(92, 'كنان', 'المهايني', 87, 'أنس', 'خلود', 4, '2013-09-03 06:59:01', NULL, 1, 4),
(93, 'لؤي', 'المهايني', 654, 'أنس', 'خلود', 8, '2013-09-03 06:59:19', NULL, 2, 19),
(94, 'كرم', 'المهايني', 587, 'محمد', 'هبة', 45, '2013-09-03 07:01:03', NULL, 1, 6),
(95, 'جود', 'المهايني', 87, 'محمد', 'هبة', 1, '2013-09-03 07:01:21', NULL, 1, 11),
(96, 'كرم', 'أبو حرب', 875, 'مجد', 'مونيكا', 4, '2013-09-03 07:01:52', NULL, 1, 14),
(97, 'هنا', 'أبو حرب', 874, 'مجد', 'مونيكا', 49, '2013-09-03 07:03:30', NULL, 1, 2),
(98, 'دانيا', 'أبو حرب', 874, 'مجد', 'مونيكا', 16, '2013-09-03 07:04:04', NULL, 2, 16),
(99, 'hg', 'hjg', 64, 'hg', 'hj', 4, '2013-09-04 05:08:45', '2013-09-04 05:09:19', 1, 3),
(100, 'عبد الرحمن', 'المهايني', 54, 'جهاد', 'ندى', 1, '2013-09-04 05:10:13', NULL, 1, 3);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pc`
--
ALTER TABLE `pc`
  ADD CONSTRAINT `pc_ibfk_1` FOREIGN KEY (`lab_id`) REFERENCES `lab` (`lab_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_2` FOREIGN KEY (`pc_id`) REFERENCES `pc` (`pc_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`lab_id`) REFERENCES `lab` (`lab_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
