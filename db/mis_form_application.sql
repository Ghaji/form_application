-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 18, 2015 at 05:18 PM
-- Server version: 5.5.36
-- PHP Version: 5.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mis_form_application`
--

-- --------------------------------------------------------

--
-- Table structure for table `academic_publications`
--

CREATE TABLE IF NOT EXISTS `academic_publications` (
  `publication_id` int(11) NOT NULL AUTO_INCREMENT,
  `applicant_id` int(11) NOT NULL,
  `title_of_publication` text NOT NULL,
  `institution` varchar(200) NOT NULL,
  `qualification` varchar(200) NOT NULL,
  `year_of_publication` year(4) DEFAULT '0000',
  PRIMARY KEY (`publication_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `academic_publications`
--

INSERT INTO `academic_publications` (`publication_id`, `applicant_id`, `title_of_publication`, `institution`, `qualification`, `year_of_publication`) VALUES
(1, 74, 'Stuff', 'Uni Jos', 'Bsc', 2014),
(2, 74, 'some', 'ATB', 'Bsc', 2014),
(3, 74, 'more', 'KUI', 'MSc', 2015),
(4, 75, 'PHP in robots', 'University of Jos', 'B.Sc', 2009),
(5, 75, 'cloud computing', 'University of Ilorin', 'M.Sc', 2010);

-- --------------------------------------------------------

--
-- Table structure for table `acceptance_acceptance_log`
--

CREATE TABLE IF NOT EXISTS `acceptance_acceptance_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` varchar(20) NOT NULL,
  `ResponseCode` varchar(10) NOT NULL,
  `ResponseDescription` varchar(100) NOT NULL,
  `Amount` int(6) NOT NULL,
  `returned_amount` varchar(10) NOT NULL,
  `CardNumber` varchar(20) NOT NULL,
  `MerchantReference` varchar(16) NOT NULL,
  `PaymentReference` varchar(50) NOT NULL,
  `returned_paymentreference` varchar(50) NOT NULL,
  `RetrievalReferenceNumber` varchar(30) NOT NULL,
  `Initiating_date` datetime NOT NULL,
  `Interswitch_date` datetime NOT NULL,
  `status` varchar(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `acceptance_acceptance_log`
--

INSERT INTO `acceptance_acceptance_log` (`id`, `student_id`, `ResponseCode`, `ResponseDescription`, `Amount`, `returned_amount`, `CardNumber`, `MerchantReference`, `PaymentReference`, `returned_paymentreference`, `RetrievalReferenceNumber`, `Initiating_date`, `Interswitch_date`, `status`) VALUES
(1, 'DPA141653899', 'Z1', 'Approved Successful', 25300, '2530000', '', '', '45RP141710097929', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'PGA'),
(2, 'PGA141298527', '00', 'Approved Successful', 25300, '2530000', '', '', '45RP141710097929', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'PGA'),
(4, 'PGA141287510', 'Z6', 'Approved Successful', 25300, '2530000', '', '', '45RP141710097929', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'PGA'),
(6, 'RP1417100979', '31', 'Bank Not Supported', 4000, '400000.00', '', '', '23RP141710097925', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'RPA'),
(28, 'RPA1417224111', '16', 'Approved by Financial Institution, Update Track 3', 4300, '430000.00', '', '', '11RPA141722411123', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'RPA'),
(8, 'RPA1417224285', '00', 'Approved Successful', 25300, '2530000', '', '', '45RPA141710097929', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'RPA'),
(9, 'RPA1417100790', '00', 'Approved Successful', 25300, '2530000', '', '', '45RP141710097929', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'PGA'),
(10, 'RPA1417224200', '40', 'Function not Supported', 4300, '430000.00', '', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'RPA'),
(11, 'RPA1417224201', '41', 'Lost Card, Pick-Up', 4300, '430000.00', '', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'RPA'),
(12, 'RPA1417100979', '00', 'Approved successful', 0, '0.00', '', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'PGA'),
(13, 'DPA1417100979', '06', 'Error', 4800, '480000.00', '', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'DPA'),
(17, 'RSA14764615', '00', 'Approved Successful', 25000, '25000.00', '', 'UBA|WEB|UNIJOS|8', '61RSA1476461536', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'PGA'),
(29, 'RPA1417100979', '00', 'Approved successful', 4300, '430000.00', '', '', '22RPA141710097922', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'RPA'),
(25, 'DPA0916415117', '00', 'Approved Successful', 4800, '480000.00', '', '', '66DPA091641511726', '', '', '2014-12-08 12:50:05', '0000-00-00 00:00:00', 'DPA'),
(26, 'PGA0912777118', '00', 'Approved Successful', 8900, '890000.00', '', '', '64PGA091277711896', '', '', '2014-12-09 12:30:20', '0000-00-00 00:00:00', 'PGA'),
(27, 'PGA0912534119', '00', 'Approved Successful', 8900, '890000.00', '', '', '81PGA091253411999', '', '', '2014-12-11 10:04:17', '0000-00-00 00:00:00', 'PGA');

-- --------------------------------------------------------

--
-- Table structure for table `acceptance_adm_access_code`
--

CREATE TABLE IF NOT EXISTS `acceptance_adm_access_code` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jamb_rem_no` varchar(20) NOT NULL,
  `pin` varchar(40) NOT NULL,
  `amount` varchar(15) NOT NULL,
  `payment_date` datetime NOT NULL,
  `ip_addr` varchar(20) NOT NULL,
  `payment_code` varchar(20) NOT NULL,
  `branch_code` varchar(20) NOT NULL,
  `bank_code` varchar(10) NOT NULL,
  `reg_num` varchar(13) NOT NULL,
  `full_name` varchar(60) NOT NULL,
  `status` varchar(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `acceptance_adm_access_code`
--

INSERT INTO `acceptance_adm_access_code` (`id`, `jamb_rem_no`, `pin`, `amount`, `payment_date`, `ip_addr`, `payment_code`, `branch_code`, `bank_code`, `reg_num`, `full_name`, `status`) VALUES
(1, 'DPA1416969873', '', '2500', '0000-00-00 00:00:00', '', '', '', '', 'DPA1416969873', '', 'DPA'),
(2, 'PGA1412985274', '43PGA141298527423', '450000.00', '2014-10-24 09:20:29', '', '', '', '', 'PGA1412985274', 'John Doe', 'PGA'),
(4, 'PGA1412969878', '12PGA141296987834', '200000', '0000-00-00 00:00:00', '', '', '', '', 'PGA1412969878', 'Og', 'PGA'),
(5, 'PGA1412875109', '12PGA141287510912', '10500', '0000-00-00 00:00:00', '', '', '', '', 'PGA1412875109', 'Manji Wetle', 'PGA'),
(6, 'RP1417980113', '90RP141798011383', '1500', '0000-00-00 00:00:00', '', '', '', '', 'RP1417980113', '', 'RP'),
(7, 'PGA1416969873', '14PGA141696987398', '890000.00', '2014-08-19 00:00:00', '127.0.0.1', 'code', 'branch code', '', 'PGA1416969873', 'Manji Wetle', 'RPA'),
(8, 'DPA1416862115', '12DPA1416862115io', '2500', '0000-00-00 00:00:00', '', '', '', '', 'DPA1416862115', 'Dave DPA Oguche', 'DPA'),
(9, 'RPA1417980100', 'ioRPA1417980100oi', '4300', '2014-09-02 15:45:00', '', '', '', '', 'RPA1417980100', '', 'RPA'),
(10, 'RPA1417980100', 'ioRPA1417980100oi', '4300', '2014-09-02 15:45:00', '', '', '', '', 'RPA1417980100', 'David O', 'RPA'),
(11, 'RPA1417224201', 'ooRPA1417224201oo', '430000.00', '2014-08-21 19:00:00', '', '', '', '', 'RPA1417224201', '', 'RPA'),
(33, 'RPA1417100979', '22RPA141710097922', '430000.00', '2015-02-12 22:04:00', '', '', '', '', 'RPA1417100979', 'Jane Doe', 'RPA'),
(25, 'PGA1312251116', '13PGA131225111675', '0.00.00', '0001-01-01 00:00:00', '', '', '', '', 'PGA1312251116', 'Ray bans David ', 'PGA'),
(28, 'DPA0916415117', '66DPA091641511726', '4800.00', '2014-12-08 17:21:21', '', '', '', '', 'DPA0916415117', 'Oguche David ', 'DPA'),
(29, 'PGA0912777118', '64PGA091277711896', '4800.00', '2014-12-09 12:34:21', '', '', '', '', 'PGA0912777118', 'Bello Khadijah', 'PGA'),
(30, 'PGA0912534119', '81PGA091253411999', '4800.00', '2014-12-09 12:34:21', '', '', '', '', 'PGA0912534119', 'Oguche David', 'PGA'),
(31, 'DPA1416680982', '81DPA141668098299', '4800', '2014-12-09 12:34:21', '', '', '', '', 'DPA1416680982', 'Merci Bumi', 'DPA'),
(32, 'RPA1417224111', '11RPA141722411123', '430000.00', '2015-02-12 15:21:00', '', '', '', '', 'RPA1417224111', 'James O L', 'RPA');

-- --------------------------------------------------------

--
-- Table structure for table `acceptance_log`
--

CREATE TABLE IF NOT EXISTS `acceptance_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` varchar(20) NOT NULL,
  `ResponseCode` varchar(10) NOT NULL,
  `ResponseDescription` varchar(100) NOT NULL,
  `Amount` int(6) NOT NULL,
  `returned_amount` varchar(10) NOT NULL,
  `CardNumber` varchar(20) NOT NULL,
  `MerchantReference` varchar(16) NOT NULL,
  `PaymentReference` varchar(50) NOT NULL,
  `returned_paymentreference` varchar(50) NOT NULL,
  `RetrievalReferenceNumber` varchar(30) NOT NULL,
  `Initiating_date` datetime NOT NULL,
  `Interswitch_date` datetime NOT NULL,
  `status` varchar(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `acceptance_log`
--

INSERT INTO `acceptance_log` (`id`, `student_id`, `ResponseCode`, `ResponseDescription`, `Amount`, `returned_amount`, `CardNumber`, `MerchantReference`, `PaymentReference`, `returned_paymentreference`, `RetrievalReferenceNumber`, `Initiating_date`, `Interswitch_date`, `status`) VALUES
(1, 'DPA141653899', 'Z1', 'Approved Successful', 25300, '2530000', '', '', '45RP141710097929', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'PGA'),
(2, 'PGA141298527', '00', 'Approved Successful', 25300, '2530000', '', '', '45RP141710097929', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'PGA'),
(4, 'PGA141287510', 'Z6', 'Approved Successful', 25300, '2530000', '', '', '45RP141710097929', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'PGA'),
(6, 'RP1417100979', '', 'Pending...', 8900, '890000.00', '', '', '23RP141710097925', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'RPA'),
(7, 'RP1417795184', 'Z1', 'Transaction Error', 5300, '530000', '', '', '13RP141779518484', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'PGA'),
(8, 'RPA1417224285', '00', 'Approved Successful', 25300, '2530000', '', '', '45RPA141710097929', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'RPA'),
(9, 'RPA1417100790', '00', 'Approved Successful', 25300, '2530000', '', '', '45RP141710097929', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'PGA'),
(10, 'RPA1417224200', '40', 'Function not Supported', 4300, '430000.00', '', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'RPA'),
(11, 'RPA1417224201', '41', 'Lost Card, Pick-Up', 4300, '430000.00', '', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'RPA'),
(12, 'RPA1417100979', '00', 'Approved successful', 0, '0.00', '', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'PGA'),
(13, 'DPA1417100979', '06', 'Error', 4800, '480000.00', '', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'DPA'),
(17, 'RSA14764615', '00', 'Approved Successful', 4300, '430000.00', '', 'UBA|WEB|UNIJOS|8', '61RSA1476461536', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'PGA'),
(24, 'PGA1312251116', 'Z1', 'PIN tries exceeded', 0, '0.00.00', '', '', '13PGA131225111675', '', '', '0000-00-00 00:00:00', '0001-01-01 00:00:00', 'PGA'),
(25, 'DPA0916415117', '00', 'Approved Successful', 4800, '480000.00', '', '', '66DPA091641511726', '', '', '2014-12-08 12:50:05', '0000-00-00 00:00:00', 'DPA'),
(26, 'PGA0912777118', '00', 'Approved Successful', 8900, '890000.00', '', '', '64PGA091277711896', '', '', '2014-12-09 12:30:20', '0000-00-00 00:00:00', 'PGA'),
(27, 'PGA0912534119', '00', 'Approved Successful', 8900, '890000.00', '', '', '81PGA091253411999', '', '', '2014-12-11 10:04:17', '0000-00-00 00:00:00', 'PGA');

-- --------------------------------------------------------

--
-- Table structure for table `admin_roles`
--

CREATE TABLE IF NOT EXISTS `admin_roles` (
  `admin_role_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_role_name` varchar(50) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`admin_role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `admin_roles`
--

INSERT INTO `admin_roles` (`admin_role_id`, `admin_role_name`, `status`) VALUES
(1, 'Main Administrator', 1),
(2, 'Post Graduate Administrator', 1),
(3, 'Non NUC Programmes', 1),
(4, 'Departmental Administrator', 1),
(5, 'Admission Officer', 1),
(6, 'Payment Engine Officer', 1),
(7, 'Second Level Administrator', 1),
(8, 'News Officer', 1),
(9, 'Bursary officer', 1),
(10, 'Requery Officer', 1);

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE IF NOT EXISTS `admin_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `staff_id` int(11) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(40) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `othernames` varchar(100) NOT NULL,
  `rank` varchar(100) NOT NULL,
  `last_logged_in` datetime NOT NULL,
  `edit_status` int(1) NOT NULL DEFAULT '0',
  `activated_status` int(1) NOT NULL DEFAULT '1',
  `role` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `staff_number` (`staff_id`,`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`user_id`, `staff_id`, `email`, `password`, `surname`, `othernames`, `rank`, `last_logged_in`, `edit_status`, `activated_status`, `role`, `department_id`) VALUES
(1, 1234, 'mohammeda@unijos.edu.ng', '01f302d24f0df74bceb9ce36ae35ffe7e3262330', 'Mohammed', 'Ghaji', 'Systems Programmer II', '2015-02-18 17:01:46', 1, 1, 7, 0),
(2, 4444, 'mohammedghaji@gmail.com', '01f302d24f0df74bceb9ce36ae35ffe7e3262330', 'Ahmed', 'Ghaji', 'System Programmer I', '2015-02-18 16:59:36', 1, 1, 1, 0),
(3, 1233, 'manjiwetle@yahoo.com', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 'Wetlea', 'Manji', 'ITStaff', '0000-00-00 00:00:00', 0, 0, 1, 0),
(7, 8080, 'femidotexe@gmail.com', '01f302d24f0df74bceb9ce36ae35ffe7e3262330', 'Femi', 'Femi', 'Senior Kopa', '2015-02-18 17:02:24', 1, 1, 4, 356),
(9, 4040, 'robsonclemnt@gmeail.com', '01f302d24f0df74bceb9ce36ae35ffe7e3262330', 'Robson', 'Clement', 'IT', '2014-08-26 15:22:33', 1, 1, 4, 356),
(10, 3333, 'ibrahimmara23@unijos.edu.ng', '466ee8b415995ce69e93d1fcc643ac06fb452c9a', 'Mohammed', 'Ibrahim', 'Financial Officer', '2014-09-01 10:29:55', 1, 1, 6, 0);

-- --------------------------------------------------------

--
-- Table structure for table `admission_letter_date`
--

CREATE TABLE IF NOT EXISTS `admission_letter_date` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admission_date` date NOT NULL DEFAULT '0000-00-00',
  `visible` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admission_letter_date`
--

INSERT INTO `admission_letter_date` (`id`, `admission_date`, `visible`) VALUES
(1, '2014-12-24', 1);

-- --------------------------------------------------------

--
-- Table structure for table `admission_status`
--

CREATE TABLE IF NOT EXISTS `admission_status` (
  `admission_id` int(11) NOT NULL AUTO_INCREMENT,
  `applicant_id` int(5) NOT NULL,
  `time_completed_application` int(11) NOT NULL,
  `academic_session` varchar(15) NOT NULL,
  `status` int(5) NOT NULL,
  `reason` text NOT NULL,
  PRIMARY KEY (`admission_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `admission_status`
--

INSERT INTO `admission_status` (`admission_id`, `applicant_id`, `time_completed_application`, `academic_session`, `status`, `reason`) VALUES
(1, 73, 13008, '2013/2014', 1, ''),
(2, 74, 1407802681, '2013/2014', 5, 'jasklas'),
(3, 75, 1407851681, '2013/2014', 4, ''),
(4, 77, 1407851681, '2013/2014', 1, ''),
(5, 80, 1407851681, '2013/2014', 4, 'invalid employment address.'),
(6, 79, 1407826181, '2013/2014', 4, ''),
(7, 82, 1407821681, '2013/2014', 4, ''),
(8, 88, 1407822601, '2013/2014', 4, ''),
(9, 96, 1407836281, '2013/2014', 4, ''),
(10, 84, 1407836681, '2013/2014', 4, ''),
(11, 100, 1407837681, '2013/2014', 4, ''),
(12, 85, 1407837981, '2013/2014', 4, ''),
(13, 105, 1407846680, '2013/2014', 4, ''),
(14, 101, 1407846681, '2013/2014', 4, ''),
(15, 103, 1407853681, '2013/2014', 4, ''),
(16, 83, 7854681, '2013/2014', 4, ''),
(17, 81, 1407856381, '2013/2014', 4, ''),
(18, 92, 854681, '2013/2014', 4, ''),
(19, 97, 1407, '2013/2014', 4, ''),
(20, 106, 1407856441, '2013/2014', 4, ''),
(21, 107, 1407856444, '2013/2014', 4, ''),
(22, 108, 1407856455, '2013/2014', 4, ''),
(23, 109, 1407006381, '2013/2014', 5, ''),
(25, 115, 1408703335, '2013/2014', 4, ''),
(26, 117, 1418040886, '2009/2010', 4, ''),
(27, 0, 0, '', 4, ''),
(28, 118, 1418131784, '2009/2010', 5, '');

-- --------------------------------------------------------

--
-- Table structure for table `adm_access_code`
--

CREATE TABLE IF NOT EXISTS `adm_access_code` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jamb_rem_no` varchar(20) NOT NULL,
  `pin` varchar(40) NOT NULL,
  `amount` varchar(15) NOT NULL,
  `payment_date` datetime NOT NULL,
  `ip_addr` varchar(20) NOT NULL,
  `payment_code` varchar(20) NOT NULL,
  `branch_code` varchar(20) NOT NULL,
  `bank_code` varchar(10) NOT NULL,
  `reg_num` varchar(13) NOT NULL,
  `full_name` varchar(60) NOT NULL,
  `status` varchar(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

--
-- Dumping data for table `adm_access_code`
--

INSERT INTO `adm_access_code` (`id`, `jamb_rem_no`, `pin`, `amount`, `payment_date`, `ip_addr`, `payment_code`, `branch_code`, `bank_code`, `reg_num`, `full_name`, `status`) VALUES
(1, 'DPA1416969873', '', '2500', '0000-00-00 00:00:00', '', '', '', '', 'DPA1416969873', '', 'DPA'),
(2, 'PGA1412985274', '43PGA141298527423', '8600', '2014-10-24 09:20:29', '', '', '', '', 'PGA1412985274', '', 'PGA'),
(4, 'PGA1412969878', '12PGA141296987834', '200000', '0000-00-00 00:00:00', '', '', '', '', 'PGA1412969878', 'Og', 'PGA'),
(5, 'PGA1412875109', '12PGA141287510912', '10500', '0000-00-00 00:00:00', '', '', '', '', 'PGA1412875109', 'Manji Wetle', 'PGA'),
(6, 'RP1417980113', '90RP141798011383', '1500', '0000-00-00 00:00:00', '', '', '', '', 'RP1417980113', '', 'RP'),
(7, 'PGA1416969873', '14PGA141696987398', '890000.00', '2014-08-19 00:00:00', '127.0.0.1', 'code', 'branch code', '', 'PGA1416969873', 'Manji Wetle', 'RPA'),
(8, 'DPA1416862115', '12DPA1416862115io', '2500', '0000-00-00 00:00:00', '', '', '', '', 'DPA1416862115', 'Dave DPA Oguche', 'DPA'),
(9, 'RPA1417980100', 'ioRPA1417980100oi', '4300', '2014-09-02 15:45:00', '', '', '', '', 'RPA1417980100', '', 'RPA'),
(10, 'RPA1417980100', 'ioRPA1417980100oi', '4300', '2014-09-02 15:45:00', '', '', '', '', 'RPA1417980100', 'David O', 'RPA'),
(11, 'RPA1417224201', 'ooRPA1417224201oo', '430000.00', '2014-08-21 19:00:00', '', '', '', '', 'RPA1417224201', '', 'RPA'),
(19, 'RSA14764615', '61RSA1476461536', '430000.00', '2014-09-08 13:52:46', '', '000235727439', '', '', 'RSA14764615', 'Davido Robson Femi', 'PGA'),
(25, 'PGA1312251116', '13PGA131225111675', '0.00.00', '0001-01-01 00:00:00', '', '', '', '', 'PGA1312251116', 'Ray bans David ', 'PGA'),
(28, 'DPA0916415117', '66DPA091641511726', '4800.00', '2014-12-08 17:21:21', '', '', '', '', 'DPA0916415117', 'Oguche David ', 'DPA'),
(29, 'PGA0912777118', '64PGA091277711896', '4800.00', '2014-12-09 12:34:21', '', '', '', '', 'PGA0912777118', 'Bello Khadijah', 'PGA'),
(30, 'RP1417224285', '81RP141722428599', '4500', '2014-12-09 12:34:21', '', '', '', '', 'RP1417224285', 'Julius Ameh', 'RPA'),
(31, 'DPA1416680982', '81DPA141668098299', '4800.00', '2014-12-09 12:34:21', '', '', '', '', 'DPA1416680982', 'Merci Bumi', 'DPA');

-- --------------------------------------------------------

--
-- Table structure for table `applicant_notifications`
--

CREATE TABLE IF NOT EXISTS `applicant_notifications` (
  `notification_id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `recipient_id` int(11) NOT NULL,
  `notification_date` date NOT NULL,
  `notification_time` time NOT NULL,
  `status` int(2) NOT NULL,
  PRIMARY KEY (`notification_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `applicant_notifications`
--

INSERT INTO `applicant_notifications` (`notification_id`, `sender_id`, `title`, `content`, `recipient_id`, `notification_date`, `notification_time`, `status`) VALUES
(1, 74, 'uploading of files', 'Please which files do I need to upload', 1, '2014-09-15', '16:39:00', 2),
(2, 1, 'Re:upload of files', 'Your undergraduate certificate and any other certificate. Must you must upload at least two', 74, '2014-09-15', '15:48:00', 2),
(3, 116, 'compulsory fields', 'Please can i know the compulsory tabs and fields', 1, '2014-09-15', '17:52:00', 2),
(4, 1, 'Re: uploading of files', 'In reply to the message you sent <br> &quot;Please which files do I need to upload&quot; <br><br>The compulsory uploads are certificates, and nysc certificate', 74, '2014-09-16', '12:20:00', 2),
(5, 1, 'Re: uploading of files', 'In reply to the message you sent <br>&quot;Please which files do I need to upload&quot;<br><br>Testing the reply for the second time', 74, '2014-09-16', '12:56:00', 2),
(6, 74, 'Referee email', 'This is to inform you that the referee email for my application was not sent please do help by sending...<br>', 1, '2014-09-18', '06:44:00', 2);

-- --------------------------------------------------------

--
-- Table structure for table `application_status`
--

CREATE TABLE IF NOT EXISTS `application_status` (
  `id` int(11) NOT NULL,
  `application_open_date` varchar(10) NOT NULL,
  `application_open_time` varchar(5) NOT NULL,
  `application_close_date` varchar(10) NOT NULL,
  `application_close_time` varchar(5) NOT NULL,
  `session` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `application_status`
--

INSERT INTO `application_status` (`id`, `application_open_date`, `application_open_time`, `application_close_date`, `application_close_time`, `session`) VALUES
(1, '2014-12-01', '10:59', '2015-02-24', '11:00', '2009/2010');

-- --------------------------------------------------------

--
-- Table structure for table `credits`
--

CREATE TABLE IF NOT EXISTS `credits` (
  `credit_id` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(90) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(14) NOT NULL,
  `role` varchar(50) NOT NULL,
  `passport` varchar(200) NOT NULL,
  `aboutyou` text NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`credit_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `credits`
--

INSERT INTO `credits` (`credit_id`, `fullname`, `email`, `phone`, `role`, `passport`, `aboutyou`, `status`) VALUES
(1, 'Mohammed Ahmed Ghaji', 'mohammedghaji@gmail.com', '08036338821', 'Team Leader', 'Mohammed.Ahmed.Ghaji.jpg', 'This is me just testing the testing testing testing...<br>', 'active'),
(2, 'Mohammed Halima Kega', 'halimakega@gmail.com', '08065358841', 'Database Administrator', 'Mohammed.Halima.Kega.jpg', 'This is the database administrator of the whole application<br>', 'active'),
(3, 'Mohammed Imaan Ghaji', 'imaan@gmail.com', '08045454545', 'Programmer', 'Mohammed.Imaan.Ghaji.jpg', 'This is the one <br>', 'inactive');

-- --------------------------------------------------------

--
-- Table structure for table `credit_status`
--

CREATE TABLE IF NOT EXISTS `credit_status` (
  `status_id` int(11) NOT NULL AUTO_INCREMENT,
  `status_name` varchar(50) NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `credit_status`
--

INSERT INTO `credit_status` (`status_id`, `status_name`, `status`) VALUES
(1, 'Supervisor', 'active'),
(2, 'Team Leader', 'active'),
(3, 'Programmer', 'active'),
(4, 'Database Administrator', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE IF NOT EXISTS `department` (
  `department_id` int(11) NOT NULL AUTO_INCREMENT,
  `faculty_id` int(11) NOT NULL DEFAULT '0',
  `department_name` varchar(50) NOT NULL DEFAULT '',
  `status` int(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`department_id`),
  KEY `faculty_id` (`faculty_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=452 ;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`department_id`, `faculty_id`, `department_name`, `status`) VALUES
(1, 1, 'English', 1),
(2, 1, 'History & Inter. Studies', 1),
(3, 1, 'Language and Linguistics', 1),
(4, 1, 'Religious Studies', 1),
(5, 1, 'Theatre and Communication Arts', 1),
(6, 2, 'Arts & Social Science Education', 1),
(7, 2, 'Science and Technology Education', 1),
(8, 2, 'Special Education and Rehabilitation Sciences\r', 1),
(9, 3, 'Architecture\r', 1),
(10, 3, 'Building\r', 1),
(11, 3, 'Geography and Planning\r', 1),
(12, 4, 'Law\r', 1),
(13, 5, 'Medicine\r', 1),
(14, 6, 'Botany\r', 1),
(15, 6, 'Chemistry\r', 1),
(16, 6, 'Geology and Mining\r', 1),
(17, 6, 'Mathematics\r', 1),
(18, 6, 'Microbiology\r', 1),
(19, 6, 'Physics\r', 1),
(20, 6, 'Zoology\r', 1),
(21, 7, 'Pharmacy\r', 1),
(22, 8, 'Accounting\r', 1),
(23, 8, 'Economics\r', 1),
(24, 8, 'General and Applied Psychology\r', 1),
(25, 8, 'Management Science\r', 1),
(26, 8, 'Political Science\r', 1),
(27, 8, 'Sociology\r', 1),
(28, 5, 'Biochemistry', 1),
(29, 5, 'Nursing', 1),
(30, 9, 'GS', 1),
(31, 5, 'Anatomy', 1),
(32, 5, 'Medical Laboratory Sciences', 1),
(33, 1, 'Mass Communication', 1),
(34, 6, 'Science Lab tech', 1),
(35, 2, 'Institute of Education', 1),
(36, 5, 'Human Physiology', 1),
(37, 8, 'General and Applied Psychology', 1),
(39, 8, 'Conflict Management and Peace Studies', 1),
(40, 5, 'Community Health', 1),
(41, 1, 'Mass Communication', 1),
(42, 7, 'Pharmaceutical Chemistry', 1),
(43, 7, 'Pharmaceutics and Pharmaceutical Technology', 1),
(44, 2, 'Arts Education', 1),
(45, 5, 'Obstetrics and Gynaecology', 1),
(46, 6, 'Remedial Sciences', 1),
(47, 1, 'Remedial French', 1),
(49, 10, 'Center for Continuing Education', 1),
(51, 13, 'POST UTME', 1),
(52, 14, 'DE SCREENING', 1),
(53, 1, 'ARCHEOLOGY', 1),
(54, 8, 'BANKING AND FINANCE', 1),
(55, 15, 'B.A (Ed) Administration and Planning', 1),
(56, 15, 'B.Sc (Ed) Economics', 1),
(57, 15, 'B.A (Ed) Guidance and Counselling', 1),
(58, 15, 'B.A (Ed) English', 1),
(59, 15, 'B.Sc (Ed) Geography', 1),
(60, 15, 'B.A (Ed) History', 1),
(61, 15, 'B.Sc (Ed) Integrated Science', 1),
(62, 15, 'B.A (Ed) Language Arts', 1),
(63, 15, 'B.Sc Mathematics', 1),
(64, 15, 'B.A (Ed) Religious Studies', 1),
(65, 15, 'B.Ed Social Studies', 1),
(66, 15, 'B.Sc Special Education', 1),
(67, 15, 'B.Ed Primary Education', 1),
(68, 15, 'B.Sc (Ed) Home Economics', 1),
(69, 15, 'B.Sc Public Administration', 1),
(70, 15, 'B.Sc Social Work', 1),
(71, 15, 'B.Sc Accounting', 1),
(72, 15, 'B.Sc Business Administration', 1),
(78, 16, 'Diploma in Computer Science', 1),
(79, 16, 'Diploma in Law', 1),
(80, 16, 'Diploma in Psychology', 1),
(81, 16, 'Diploma in Theathre Arts', 1),
(82, 16, 'Diploma in Centre for Continuing Education (CCE) ', 1),
(83, 17, 'Remedial Science', 1),
(84, 17, 'Prelim French', 1),
(85, 12, 'M.A. English Language', 1),
(88, 12, 'M.A. Literature in English', 1),
(89, 12, 'M.Phil English Language', 1),
(90, 12, 'M.Phil Litreature in English', 1),
(91, 12, 'Ph.D English Language', 1),
(92, 12, 'Ph.D Litreature in English', 1),
(93, 12, 'M.A. Nigerian History(Central Nigeria)', 1),
(94, 12, 'M.A. Economic History', 1),
(95, 12, 'M.Phil/Ph.D Nigerian History(Central Nigeria)', 1),
(96, 12, 'M.Phil/Ph.D Economic History', 1),
(97, 12, 'Ph.D Nigerian History(Central Nigeria)', 1),
(98, 12, 'Ph.D Economic History', 1),
(99, 12, 'M.A. Ethics and Philosophy', 1),
(100, 12, 'M.A. African Traditional Religion', 1),
(101, 12, 'M.A.Church History', 1),
(102, 12, 'M.A. New Testament', 1),
(103, 12, 'M.A. Old Testament', 1),
(104, 12, 'M.A. Arabic', 1),
(105, 12, 'M.A. Islamic Studies', 1),
(106, 12, 'M.A. Interaction of Religion', 1),
(107, 12, 'M.A. Sociology of Religion', 1),
(108, 12, 'M.Phil African Traditional Religion', 1),
(109, 12, 'M.Phil/Ph.D Church History', 1),
(110, 12, 'M.Phil/Ph.D New Testament', 1),
(111, 12, 'M.Phil/Ph.D Old Testament', 1),
(112, 12, 'M.Phil/Ph.D Interaction of Religion', 1),
(113, 12, 'M.Phil Sociology of Religions', 1),
(114, 12, 'M.Phil/Ph.D Ethics and Philosophy', 1),
(115, 12, 'Ph.D African Traditional Religion', 1),
(116, 12, 'Ph.D Church History', 1),
(117, 12, 'Ph.D New Testament', 1),
(118, 12, 'Ph.D Old Testament', 1),
(119, 12, 'Ph.D Interaction of Religion', 1),
(120, 12, 'Ph.D Sociology of Religions', 1),
(121, 12, 'M.A. Play Directing/Production', 1),
(122, 12, 'M.A. Dramatic Litreature', 1),
(123, 12, 'M.A. Play Creating', 1),
(124, 12, 'M.Phil Dramatic Litreature', 1),
(125, 12, 'M.Phil Play Creating', 1),
(126, 12, 'M.Phil Play Directing/Production', 1),
(127, 12, 'Ph.D Play Directing/Production', 1),
(128, 12, 'Ph.D Dramatic Litreature', 1),
(129, 12, 'Ph.D Play Creating', 1),
(130, 12, 'M.ED Hearing Handicap', 1),
(131, 12, 'M.ED Learning Disabilities', 1),
(132, 12, 'M.ED Visual Handicaps', 1),
(133, 12, 'M.Phil/Ph.D Hearing Handicap', 1),
(134, 12, 'M.Phil/Ph.D Learning Disabilities', 1),
(135, 12, 'M.Phil/Ph.D Visual Handicaps', 1),
(136, 12, 'Ph.D Hearing Handicap', 1),
(137, 12, 'Ph.D Learning Disabilities', 1),
(138, 12, 'Ph.D Visual Handicaps', 1),
(139, 12, 'M.ED Guidance and Counseling', 1),
(140, 12, 'M.ED Social Studies Education', 1),
(141, 12, 'M.ED Philosophy of Education', 1),
(142, 12, 'M.ED Sociology of Education', 1),
(143, 12, 'M.ED Psycology of Education', 1),
(144, 12, 'M.ED Christian Religion Education', 1),
(145, 12, 'MA.ED History and International Studies Education', 1),
(146, 12, 'M.ED Test and Measurement', 1),
(147, 12, 'M.ED Educational Administration and Planning', 1),
(148, 12, 'M.Phil Guidance and Counseling', 1),
(149, 12, 'M.Phil Social Studies Education', 1),
(150, 12, 'M.Phil Philosophy of Education', 1),
(151, 12, 'M.ED English Education', 1),
(152, 12, 'M.Phil English Education', 1),
(153, 12, 'M.Phil Sociology of Education', 1),
(154, 12, 'M.Phil/Ph.d Educational Psychology', 1),
(155, 12, 'M.Phil Christian Religion Education', 1),
(156, 12, 'M.Phil History Education', 1),
(157, 12, 'M.Phil Test and Measurement', 1),
(158, 12, 'M.Phil Educational Administration and Planning', 1),
(159, 12, 'Ph.D Guidance and Counseling', 1),
(160, 12, 'Ph.D Social Studies Education', 1),
(161, 12, 'Ph.D Philosophy of Education', 1),
(162, 12, 'Ph.D English Education', 1),
(163, 12, 'Ph.D Sociology of Education', 1),
(164, 12, 'Ph.D Psycology of Education(Child Development)', 1),
(165, 12, 'Ph.D Christian Religion Education', 1),
(166, 12, 'Ph.D History Education', 1),
(167, 12, 'Ph.D Test and Measurement', 1),
(168, 12, 'Ph.D Educational Administration and Planning', 1),
(169, 12, 'M.ED Science Education', 1),
(170, 12, 'M.ED Curriculum Planning and Development', 1),
(171, 12, 'M.Sc. Education in Biology', 1),
(172, 12, 'M.Sc. Education in Chemistry', 1),
(173, 12, 'M.Sc. Education in Physics', 1),
(174, 12, 'M.Sc. Education in Geography', 1),
(175, 12, 'M.Sc. Education in Mathematics', 1),
(176, 12, 'M.Phil Curriculum Planning and Development', 1),
(177, 12, 'M.Phil/Ph.D Science Education', 1),
(178, 12, 'M.Phil/Ph.D Education in Biology', 1),
(179, 12, 'M.Phil/Ph.D Education in Chemistry', 1),
(180, 12, 'M.Phil/Ph.D Education in Physics', 1),
(181, 12, 'M.Phil Education in Geography', 1),
(182, 12, 'M.Phil Education in Mathematics', 1),
(183, 12, 'Ph.D Science Education', 1),
(184, 12, 'Ph.D Curriculum Planning and Development', 1),
(185, 12, 'Ph.D Education in Biology', 1),
(186, 12, 'Ph.D Education in Chemistry', 1),
(187, 12, 'Ph.D Education in Physics', 1),
(188, 12, 'M.Sc. Education in Geography', 1),
(189, 12, 'Ph.D Education in Mathematics', 1),
(190, 12, 'M.Sc. Architecture', 1),
(191, 12, 'Postgraduate Diploma in Architecture (PGDARCH)', 1),
(192, 12, 'M.Sc. Construction Management', 1),
(193, 12, 'M.Sc. Construction Technology', 1),
(194, 12, 'M.Phil/Ph.D Construction Management', 1),
(195, 12, 'M.Phil/Ph.D Construction Materials', 1),
(196, 12, 'Ph.D Construction Management', 1),
(197, 12, 'Ph.D Construction Materials', 1),
(198, 12, 'M.Sc. Environmental and Resources Planning (ERP)', 1),
(199, 12, 'M.Sc. Population and Man Power Planning(PMP)', 1),
(200, 12, 'M.Sc. Urban and Regional Planning(URP)', 1),
(201, 12, 'M.Phil Environmental and Resources Planning (ERP)', 1),
(202, 12, 'M.Phil Population and Man Power Planning(PMP)', 1),
(203, 12, 'M.Phil Urban and Regional Planning(URP)', 1),
(204, 12, 'Ph.D Environmental and Resources Planning (ERP)', 1),
(205, 12, 'Ph.D Population and Man Power Planning(PMP)', 1),
(206, 12, 'Ph.D Urban and Regional Planning(URP)', 1),
(207, 12, 'Masters Programme in Law(LLM)', 1),
(208, 12, 'M.Sc. Medical Microbiology', 1),
(209, 12, 'M.Phil Medical Microbiology', 1),
(210, 12, 'M.Phil/Ph.D Law', 1),
(211, 12, 'Ph.D Medical Microbiology', 1),
(212, 12, 'M.A Law and Diplomacy', 1),
(213, 12, 'M.Phil/Ph.D Law and Diplomacy', 1),
(214, 12, 'Ph.D Law(LLM)', 1),
(215, 12, 'Ph.D Law and Diplomacy', 1),
(216, 12, 'Masters Programme of Laws in Telecommunication Law', 1),
(217, 12, 'M.Sc. Biochemistry', 1),
(218, 12, 'M.Phil Biochemistry', 1),
(219, 12, 'Ph.D Biochemistry', 1),
(220, 12, 'M.Sc. Human Physiology', 1),
(221, 12, 'M.Phil Human Physiology', 1),
(222, 12, 'Ph.D Human Physiology', 1),
(223, 12, 'M.D Human Physiology', 1),
(224, 12, 'M.Sc. Cytogenetics and Plant Breeding', 1),
(225, 12, 'M.Sc. Applied Microbiology and Plant Pathology', 1),
(226, 12, 'M.Phil / Ph.D Cytogenetics and Plant Breeding', 1),
(227, 12, 'M.Phil/Ph.D Applied Microbiology and Plant Patholo', 1),
(228, 12, 'M.Sc. Applied Analytical Chemistry', 1),
(229, 12, 'M.Sc. Applied Inorganic Chemistry', 1),
(230, 12, 'M.Sc. Applied Organic Chemistry', 1),
(231, 12, 'M.Sc. Applied Physical Chemistry', 1),
(232, 12, 'M.Phil/Ph.D Applied Analytical Chemistry', 1),
(233, 12, 'M.Phil/Ph.D Applied Inorganic Chemistry', 1),
(234, 12, 'M.Phil/Ph.D Applied Organic Chemistry', 1),
(235, 12, 'M.Phil/Ph.D Applied Physical Chemistry', 1),
(236, 12, 'Ph.D Applied Organic Chemistry', 1),
(237, 12, 'Ph.D Applied Analytical Chemistry', 1),
(238, 12, 'Ph.D Applied Inorganic Chemistry', 1),
(239, 12, 'Ph.D Applied Physical Chemistry', 1),
(240, 12, 'Postgraduate Diploma in Environmental and Industri', 1),
(241, 12, 'M.Sc. Mineral Exploration', 1),
(242, 12, 'M.Sc. Engineering Geology and Hydrogeology', 1),
(243, 12, 'M.Phil Geophysics', 1),
(244, 12, 'M.Phil Ore Geology', 1),
(245, 12, 'M.Phil Geochemistry', 1),
(246, 12, 'Ph.D Geophysics', 1),
(247, 12, 'Ph.D Ore Geology', 1),
(248, 12, 'M.Phil Geochemistry', 1),
(249, 12, 'Postgraduate Diploma in Mining Geology(PDMG)', 1),
(250, 12, 'Postgraduate Diploma in Environmental Geology(PDEG', 1),
(251, 12, 'M.Sc. Complex Analysis', 1),
(252, 12, 'M.Sc. Abstract Algebra', 1),
(253, 12, 'M.Sc. Numerical Analysis', 1),
(254, 12, 'M.Phil Numerical Analysis', 1),
(255, 12, 'M.Phil Abstract Algebra', 1),
(256, 12, 'M.Phil Complex Analysis', 1),
(257, 12, 'Ph.D Numerical Analysis', 1),
(258, 12, 'Ph.D Complex Analysis', 1),
(259, 12, 'Ph.D Abstract Algebra', 1),
(260, 12, 'Postgraduate Diploma in Statistics', 1),
(261, 12, 'M.Sc. Theoretical Solid State and Quantum Physics', 1),
(262, 12, 'M.Sc. Applied Physics(Acoustics)', 1),
(263, 12, 'M.Sc. Applied Physics(Atmospheric Physics)', 1),
(264, 12, 'M.Sc. Applied Physics(Biophysics)', 1),
(265, 12, 'M.Sc. Applied Physics(Electronics and Communicatio', 1),
(266, 12, 'M.Phil Physics(Atmospheric Aerosols and Pollution)', 1),
(267, 12, 'M.Phil Physics(Medical Physics)', 1),
(268, 12, 'M.Phil Physics(Applied Acoustics)', 1),
(269, 12, 'Ph.D Physics(Applied Acoustics)', 1),
(270, 12, 'Ph.D Physics(Medical Physics)', 1),
(271, 12, 'Ph.D Physics(Applied Acoustics)', 1),
(272, 12, 'Postgraduate Diploma in Electronics Electrical Tec', 1),
(273, 12, 'M.Sc. Applied Entomology and Parasitology', 1),
(274, 12, 'M.Sc. Applied Hybrobiology and Fisheries', 1),
(275, 12, 'M.Sc. Conservation Biology', 1),
(276, 12, 'M.Phil Parasitology', 1),
(277, 12, 'M.Phil Entomology', 1),
(278, 12, 'M.Phil Hydrobiology and Fisheries', 1),
(279, 12, 'M.Phil/Ph.D Animal Physiology', 1),
(280, 12, 'Ph.D Parasitology', 1),
(281, 12, 'Ph.D Entomology', 1),
(282, 12, 'Ph.D Hydrobiology and Fisheries', 1),
(283, 12, 'Ph.D Animal and Physiology', 1),
(284, 12, 'M.Sc. Pharmacology', 1),
(285, 12, 'M.Phil Pharmacology', 1),
(286, 12, 'Ph.D Pharmacology', 1),
(287, 12, 'M.Sc. Pharmaceutical Chemistry', 1),
(288, 12, 'M.Phil Pharmaceutical Chemistry', 1),
(289, 12, 'Ph.D Pharmaceutical Chemistry', 1),
(290, 12, 'M.Sc. Economics', 1),
(291, 12, 'M.Phil Economics', 1),
(292, 12, 'Ph.D Economics', 1),
(293, 12, 'Masters in Public Administration(MPA)', 1),
(294, 12, 'M.Sc. International Relations and Strategic Studie', 1),
(295, 12, 'M.Sc. Political Science', 1),
(296, 12, 'Ph.D International Relations and Strategic Studies', 1),
(297, 12, 'M.Phil/Ph.D Political Economy and Development Stud', 1),
(298, 12, 'M.Phil/Ph.D Public Administration', 1),
(299, 12, 'M.Sc. Clinical Psychology', 1),
(300, 12, 'M.Sc.Organizational Psychology', 1),
(301, 12, 'M.Phil/Ph.D Clinical Psychology', 1),
(302, 12, 'M.Phil/Ph.D Organizational Psychology', 1),
(303, 12, 'Ph.D Clinical Psycology', 1),
(304, 12, 'Ph.D Organizational Psycology', 1),
(305, 12, 'M.Sc. Sociology', 1),
(306, 12, 'M.Phil Sociology', 1),
(307, 12, 'M.Phil Social Work/MSSW', 1),
(308, 12, 'M.Sc. Social Work/MSSW', 1),
(309, 12, 'Ph.D Sociology', 1),
(310, 12, 'Ph.D Social Work/MSSW', 1),
(311, 12, 'Postgraduate Diploma in Social Work/PGDSW', 1),
(312, 12, 'Postgraduate Diploma in Hiv/Aids Studies', 1),
(313, 12, 'Masters in Business Administration MBA', 1),
(314, 12, 'MBA Executive', 1),
(315, 12, 'M.Phil Management Studies', 1),
(316, 12, 'Ph.D Management Studies', 1),
(317, 12, 'M.Phil/Ph.D Law(Commercial Law)', 1),
(318, 12, 'Ph.D Law (Intl Law and Jur)', 1),
(319, 12, 'Ph.D Law (Private Law)', 1),
(320, 12, 'Ph.D Law (Public Law)', 1),
(321, 12, 'Postgraduate diploma in ICT Policy and Regulations', 1),
(322, 12, 'M.A History', 1),
(323, 12, 'M.Phil/Ph.D Biochemistry', 1),
(324, 12, 'M.Phil/Ph.D Human Physiology', 1),
(325, 12, 'M.Phil/Ph.D Medical Microbiology', 1),
(326, 12, 'M.Phil/Ph.D Chemistry', 1),
(327, 12, 'M.Sc. Chemistry', 1),
(328, 12, 'M.Phil/Ph.D Applied Microbiology', 1),
(329, 12, 'M.Phil/Ph.D Conservation Biology', 1),
(330, 12, 'M.Phil/Ph.D Hydrobiology and Fishries', 1),
(331, 12, 'M.Phil/Ph.D Entomology and Parasitology', 1),
(332, 12, 'M.sc. Mathematics', 1),
(333, 12, 'M.sc. Physics', 1),
(334, 12, 'M.Phil/Ph.D Physics', 1),
(335, 12, 'M.Sc. Mineral Exploration and Mining Geology', 1),
(336, 12, 'M.Phil/Ph.D Pharmaceutical Chemistry', 1),
(337, 12, 'Postgraduate Diploma in Management Science(PGDM)', 1),
(338, 12, 'M.Phil/Ph.D Management Studies', 1),
(339, 12, 'M.Phil/Ph.D General and applied Psychology', 1),
(340, 12, 'Postgraduate diploma in Education(PGDE)', 1),
(341, 12, 'M.Phil/Ph.D Sociology of Religions', 1),
(342, 12, 'M.Phil/Ph.D African Traditional Religion', 1),
(343, 12, 'M.Phil/Ph.D Curriculum Studies Education', 1),
(344, 12, 'M.Phil/Ph.D Mathematics Education', 1),
(345, 12, 'M.Phil/Ph.D Educational Technology', 1),
(346, 12, 'M.SC.(ED) Educational Technology', 1),
(347, 12, 'M.SC.(ED) (CURRICULUM EDUCATION)', 1),
(348, 12, 'M.Phil/Ph.D English Language', 1),
(349, 12, 'M.Phil/PH.D Special Education & Rehabilitation Sci', 1),
(350, 12, 'M.Phil/Ph.D Mathematics', 1),
(351, 12, 'M.Phil/Ph D Pharmaceutical Technology', 1),
(352, 12, 'Msc Pharmaceutical Technology', 1),
(353, 12, 'MA Theatre Arts', 1),
(354, 12, 'M Phil/PhD Political Science', 1),
(355, 12, 'M Phil/PhD Theatre Arts', 1),
(356, 12, 'M Phil/PhD Educational Administration and Planning', 1),
(357, 12, 'Msc Political Economy and Developmental Studies', 1),
(358, 12, 'M Phil/PhD English Education', 1),
(359, 12, 'M Phil/PhD Sociology of Education', 1),
(360, 12, 'M Phil/PhD Guidance and Counseling', 1),
(361, 12, 'M Phil/PhD Philosophy of Education', 1),
(362, 12, 'M Phil/PhD Social Studies Education', 1),
(363, 12, 'M Phil/PhD Religion Education', 1),
(364, 12, 'M Phil/PhD History and International Studies Educa', 1),
(365, 12, 'M Phil/PhD Test and Measurement Evaluation', 1),
(366, 12, 'M.ED Religion', 1),
(367, 12, 'M.ED Economics Education', 1),
(368, 12, 'M Phil/PhD Environmental and Resources Planning (E', 1),
(369, 12, 'M Phil/PhD Urban and Regional Planning(URP)', 1),
(370, 12, 'M.Phil/PhD M.Phil Population and Man Power Plannin', 1),
(371, 12, 'Postgraduate diploma in Conflict Management and Pe', 1),
(372, 12, 'M.Phil/Ph.D Obstetrics and Gynaecology', 1),
(373, 12, 'M. ED Special Education', 1),
(374, 12, 'M.Phil/PhD Economics', 1),
(375, 12, 'M Phil/PhD Sociology', 1),
(376, 12, 'M Phil/PhD History And International Studies', 1),
(377, 12, 'M Phil/PhD Social Works', 1),
(378, 12, 'M Phil/PhD Geology and Mining', 1),
(379, 12, 'M.Phil/Ph.D Psychology of Education', 1),
(380, 12, 'M.Phil/Ph.D Pharmacology', 1),
(381, 12, 'M.Phil/Ph.D Islamic Studies', 1),
(382, 12, 'M.Phil/Ph.D International Relations and Strategic ', 1),
(383, 12, 'M.A. African History', 1),
(384, 12, 'M.Sc. Accounting And Finance', 1),
(385, 12, 'M.Phil/Ph.D Accounting And Finance', 1),
(386, 12, 'M.Sc. Conflict Management and Peace Studies', 1),
(387, 12, 'M.Sc. Applied Physics', 1),
(388, 12, 'Masters in Public Health', 1),
(389, 12, 'M.A. Mass Communication', 1),
(390, 12, 'M.Phil/Ph.D Architecture', 1),
(391, 12, 'M.Phil/Ph.D Literature in English', 1),
(392, 12, 'M. A Hausa Language', 1),
(393, 12, 'Post Graduate Diploma in Accounting(PGDA)', 1),
(394, 12, 'M.A. Languages And Linguistics', 1),
(395, 12, 'M.A. History & International Studies', 1),
(396, 12, 'M.Phil/PhD Construction Technology', 1),
(397, 12, 'M.Phil/Ph.D Mineral Exploration and Mining Geology', 1),
(398, 12, 'M.Sc. Hydrobiology And Fisheries', 1),
(399, 12, 'M.Phil/Ph.D Languages And Linguistics', 1),
(400, 12, 'M.Phil/PhD Economics Education', 1),
(401, 12, 'M.Sc. Human Anatomy', 1),
(402, 12, 'M.Phil/PhD Human Anatomy', 1),
(403, 12, 'M.ED English Education', 1),
(404, 12, 'M Phil/PhD English Education', 1),
(405, 12, 'M.A.Ed History and International Studies Education', 1),
(406, 12, 'M Phil/PhD History and International Studies Educa', 1),
(407, 12, 'M.ED Religion', 1),
(408, 12, 'M Phil/PhD Religion Education', 1),
(409, 12, 'M.Phil/PhD Geography Education', 1),
(413, 12, 'M.Ed Educational Psychology', 1),
(414, 12, 'M.Phil/Ph.D International Law and Jurisprudence', 1),
(415, 12, 'Postgraduate Reactivate (APLORI)', 1),
(417, 11, 'B.A. (Ed) Admin & Planning', 1),
(418, 11, 'B.Sc (Ed) Economics', 1),
(419, 11, 'B.A (Ed) Guidance & Counselling', 1),
(420, 11, 'B.A. (Ed) English', 1),
(421, 11, 'B.Sc (Ed) Geography', 1),
(422, 11, 'B.A. (Ed) History', 1),
(423, 11, 'B.Sc (Ed) Integrated Science', 1),
(424, 11, 'B.A. (Ed) Language Arts', 1),
(425, 11, 'B.Sc Mathematics', 1),
(426, 11, 'B.A (Ed) Religious Studies', 1),
(427, 11, 'B.Ed Social Studies', 1),
(428, 11, 'B.Sc Special Education', 1),
(429, 11, 'B.Ed Primary Education', 1),
(430, 11, 'B.Sc Ed Home Economics', 1),
(431, 11, 'B.Sc Economics', 1),
(432, 11, 'B.Sc Public Administration', 1),
(433, 11, 'B.Sc Social Work', 1),
(434, 11, 'B.Sc Accounting', 1),
(435, 11, 'B.Sc Business Administration', 1),
(436, 16, 'Certificate in Adult Education', 1),
(437, 16, 'Diploma in Mass Communication', 1),
(438, 16, 'Diploma in Accounting', 1),
(439, 16, 'Diploma in Banking and Finance', 1),
(440, 16, 'Diploma in Purchase and Supply', 1),
(441, 16, 'Diploma in Catering and Hotel Management', 1),
(442, 16, 'Diploma in Marketing', 1),
(443, 16, 'Diploma in Adult Education', 1),
(444, 16, 'A.E.O Accounts', 1),
(445, 16, 'A.E.O Administration', 1),
(446, 16, 'Diploma in Business Education', 1),
(447, 15, 'B.Sc Economics', 1),
(448, 1, 'PTTT', 1),
(449, 18, 'Mohammed', 1),
(450, 18, 'Ahmed', 1),
(451, 16, 'Diploma in Christian Studies', 1);

-- --------------------------------------------------------

--
-- Table structure for table `employment`
--

CREATE TABLE IF NOT EXISTS `employment` (
  `employment_id` int(11) NOT NULL AUTO_INCREMENT,
  `applicant_id` int(11) NOT NULL,
  `employment_detail_one` text NOT NULL,
  `employment_detail_two` text NOT NULL,
  `employment_detail_three` text NOT NULL,
  `employment_detail_four` text NOT NULL,
  PRIMARY KEY (`employment_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `employment`
--

INSERT INTO `employment` (`employment_id`, `applicant_id`, `employment_detail_one`, `employment_detail_two`, `employment_detail_three`, `employment_detail_four`) VALUES
(1, 75, 'a:3:{s:8:"employer";s:24:"Microsoft Incorporations";s:4:"year";s:4:"2013";s:7:"address";s:14:"Silicon Valley";}', 'a:3:{s:8:"employer";s:9:"Apple Inc";s:4:"year";s:4:"2013";s:7:"address";s:14:"Silicon Valley";}', '', ''),
(2, 74, 'a:3:{s:8:"employer";s:7:"uni jos";s:4:"year";s:4:"2007";s:7:"address";s:11:"Bauchi Road";}', 'a:3:{s:8:"employer";s:4:"Juth";s:4:"year";s:4:"2009";s:7:"address";s:7:"Lamingo";}', '', ''),
(3, 80, 'a:3:{s:8:"employer";s:9:"docmailer";s:4:"year";s:4:"2013";s:7:"address";s:47:"fjfjskjdfiljfkc jfkkfjssmj, jkkjs,jffjffkfjfkss";}', '', '', ''),
(4, 84, 'a:3:{s:8:"employer";s:6:"jammes";s:4:"year";s:4:"2007";s:7:"address";s:14:"in the country";}', '', '', ''),
(5, 85, 'a:3:{s:8:"employer";s:9:"mr hudson";s:4:"year";s:4:"2008";s:7:"address";s:18:"in afghanistan yyy";}', '', '', ''),
(6, 115, 'a:3:{s:8:"employer";s:19:"Lagos bus transport";s:4:"year";s:4:"2010";s:7:"address";s:13:"34 Lagos Road";}', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `exam_grade`
--

CREATE TABLE IF NOT EXISTS `exam_grade` (
  `grade_id` int(11) NOT NULL AUTO_INCREMENT,
  `grade` varchar(2) NOT NULL,
  PRIMARY KEY (`grade_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `exam_grade`
--

INSERT INTO `exam_grade` (`grade_id`, `grade`) VALUES
(1, 'A1'),
(2, 'B2'),
(3, 'B3'),
(4, 'C4'),
(5, 'C5'),
(6, 'C6'),
(7, 'D7'),
(8, 'E8'),
(9, 'F9');

-- --------------------------------------------------------

--
-- Table structure for table `exam_id`
--

CREATE TABLE IF NOT EXISTS `exam_id` (
  `exam_type_id` int(4) NOT NULL AUTO_INCREMENT,
  `exam_name` varchar(20) NOT NULL,
  PRIMARY KEY (`exam_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `exam_id`
--

INSERT INTO `exam_id` (`exam_type_id`, `exam_name`) VALUES
(1, 'WAEC'),
(2, 'NECO'),
(3, 'NTI'),
(4, 'Others'),
(5, 'IJMB O-Level'),
(6, 'NABTEB');

-- --------------------------------------------------------

--
-- Table structure for table `exam_subject`
--

CREATE TABLE IF NOT EXISTS `exam_subject` (
  `subject_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `subject_name` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`subject_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=420 ;

--
-- Dumping data for table `exam_subject`
--

INSERT INTO `exam_subject` (`subject_id`, `subject_name`) VALUES
(1, 'accounting and auditing'),
(2, 'acccounting (principles of)'),
(3, 'acconting education'),
(4, 'additional general science'),
(5, 'additional mathematics'),
(6, 'adult aducation'),
(7, 'aeroneutical engineering'),
(8, 'additional mathematics'),
(9, 'agricultural science'),
(10, 'agricultural engineering'),
(11, 'agriculture'),
(12, 'agronomy/soil science'),
(13, 'akan'),
(14, 'alternative current'),
(15, 'anal instrumental lab.mgt'),
(16, 'ancient history'),
(17, 'anatomy and physiology'),
(18, 'animal science'),
(19, 'applied economics'),
(20, 'applied electricity'),
(21, 'arabic and islamic studies'),
(22, 'arabic(classical)'),
(23, 'arabic studies'),
(24, 'arc.& gas welding'),
(25, 'architecture'),
(26, 'arithemetic'),
(27, 'arts(fine arts)'),
(28, 'auditing'),
(29, 'auto electrical work (basic motor tech)'),
(30, 'auto electricity'),
(31, 'auto ignition system'),
(32, 'auto mechanics'),
(33, 'auto wiring/ligting'),
(34, 'arts( history)'),
(35, 'arts (studio practice)'),
(36, 'bakery and confectionary'),
(37, 'banking nad finance'),
(38, 'basic catering'),
(39, 'basic construction'),
(40, 'basic electricity'),
(41, 'bible knowledge(CRK)'),
(42, 'biochemistry'),
(43, 'biology'),
(44, 'biology (alt syllabus)'),
(45, 'bleaching dying and finishing'),
(46, 'block laying & blocklaying'),
(47, 'british constituition'),
(48, 'building and quantity survey'),
(49, 'building/engineering drawing'),
(50, 'building construction'),
(51, 'business administration'),
(52, 'Business Education'),
(53, 'business management'),
(54, 'business methods'),
(55, 'business studies & mgt'),
(56, 'cable joining etc'),
(57, 'capentary and joinery'),
(58, 'capentary'),
(59, 'ceramics'),
(60, 'catering'),
(61, 'cartography'),
(62, 'charging of ref.& oil heat exchanger'),
(63, 'chemical engineering'),
(64, 'chemical technology'),
(65, 'chemical/petrochemical engineering'),
(66, 'chemistry'),
(67, 'chemistry(alt.syllabus)'),
(68, 'civil design'),
(69, 'civil engineering'),
(70, 'classical hebrew'),
(71, 'clothing and textile'),
(72, 'cold and hot water supply'),
(73, 'sanitation and drainage'),
(74, 'commerce'),
(75, 'communication'),
(76, 'communication studies'),
(77, 'community development'),
(78, 'community service & adult education'),
(79, 'computer programming'),
(80, 'computer studies'),
(81, 'concrete practice'),
(82, 'concrete work'),
(83, 'constructional and main of a/machines'),
(84, 'constructional materials'),
(85, 'control inst.insul etc'),
(86, 'cookery'),
(87, 'cookery (weac)'),
(88, 'cooperative econs'),
(89, 'cooperative studies'),
(90, 'creative/pure $ applied arts'),
(91, 'craft thery'),
(92, 'criminal law'),
(93, 'criminal procedures'),
(94, 'crop production'),
(95, 'data processing'),
(96, 'decorative painting'),
(97, 'dental technology'),
(98, 'denta theraphy'),
(99, 'dentistry'),
(100, 'direct current'),
(101, 'disorder of hair'),
(102, 'domestic science'),
(103, 'dress making(theory and practical)'),
(104, 'economic history'),
(105, 'economics'),
(106, 'edo studies'),
(107, 'ecutional arts'),
(108, 'educational social studiers'),
(109, 'education(principles & practice)'),
(110, 'educational administration'),
(111, 'efik eives'),
(112, 'elect.device and circuits'),
(113, 'elect\\elec engn'),
(114, 'electr.engr'),
(115, 'elect/elect instruments'),
(116, 'electronics'),
(117, 'elementary surveying'),
(118, 'elements of law of contradiction'),
(119, 'engine maintainance and refurb'),
(120, 'engineering science'),
(121, 'english education'),
(122, 'english (general )'),
(123, 'english language'),
(124, 'environmental science'),
(125, 'estate managementt'),
(126, 'ewe'),
(127, 'fab.eng.craft practice'),
(128, 'fante'),
(129, 'farm management'),
(130, 'fashion designs'),
(131, 'finance / financial studies'),
(132, 'fisheries'),
(133, 'fitting'),
(134, 'food tech/food and nutrition'),
(135, 'food and drink(weac)'),
(136, 'footware manufacturing'),
(137, 'forestry'),
(138, 'forestry and botany'),
(139, 'foundary 2'),
(140, 'french'),
(141, 'fulfulde'),
(142, 'furniture craft practice'),
(143, 'futher mathematics'),
(144, 'ga'),
(145, 'gas steam work and bronze welding'),
(146, 'general biology'),
(147, 'general metal work'),
(148, 'general phychology'),
(149, 'general science(additional)'),
(150, 'general work'),
(151, 'geography'),
(152, 'geology'),
(153, 'german'),
(154, 'glass tech'),
(155, 'government'),
(156, 'graphical presentation and model making'),
(157, 'graphical design'),
(158, 'graphical printing'),
(159, 'greek'),
(160, 'greek literature in transition'),
(161, 'guidance and councelling'),
(162, 'hair'),
(163, 'Hausa Language'),
(164, 'hausa literature'),
(165, 'health administration'),
(166, 'health science'),
(167, 'health technology'),
(168, 'health/hygiene & physical education'),
(169, 'hide and skin tech'),
(170, 'high speed'),
(171, 'highways'),
(172, 'hindus'),
(173, 'history'),
(174, 'history of town planning'),
(175, 'home econs/mgt/science'),
(176, 'home mgt'),
(177, 'horology'),
(178, 'horticulture'),
(179, 'hospital practice & care of pateints'),
(180, 'hotel catering'),
(181, 'hotel and catering basics course (WEAC)'),
(182, 'home management & catering'),
(183, 'human anatomy'),
(184, 'human learning'),
(185, 'hunamities'),
(186, 'hygiene & physiology'),
(187, 'idoma'),
(188, 'igala'),
(189, 'igbo language'),
(190, 'implements & machines'),
(191, 'indiane designs'),
(192, 'information managements'),
(193, 'introduction to business management'),
(194, 'insurance'),
(195, 'ika'),
(196, 'intergrated science'),
(197, 'international relation'),
(198, 'intro to foundatry patterns etc'),
(199, 'intro to agric science'),
(200, 'intro to buisiness mgt'),
(201, 'intro to cosmetology'),
(202, 'irrigation engineering'),
(203, 'islamic history'),
(204, 'islamic legal studies'),
(205, 'islamic religious know./islamic studies'),
(206, 'italian'),
(207, 'joinery'),
(208, 'journalism'),
(209, 'kanuri'),
(210, 'laboratory technician'),
(211, 'ladies textile design'),
(212, 'ladies garment const & finishing'),
(213, 'land economics'),
(214, 'land surveying'),
(215, 'language arts'),
(216, 'language education'),
(217, 'latin'),
(218, 'law'),
(219, 'law/civil'),
(220, 'law/islamic/sharia'),
(221, 'leather technology'),
(222, 'liberal studies'),
(223, 'library science'),
(224, 'linguistics'),
(225, 'local government admin'),
(226, 'logic'),
(227, 'machne printing and finishing'),
(228, 'machine woodworking'),
(229, 'machinery and plants'),
(230, 'management and int trade'),
(231, 'marine engr'),
(232, 'marine exchange transmission system'),
(233, 'marine gas cold and hot water supply'),
(234, 'marketing'),
(235, 'mass commuinication'),
(236, 'mathematics'),
(237, 'mathematics(additional)'),
(238, 'mathematics (applied)'),
(239, 'mathematics(mordern applied)'),
(240, 'mathematics (mordern)'),
(241, 'mathematics ( pure and applied )'),
(242, 'mathematics(pure)'),
(243, 'mathematics and statistics'),
(244, 'mathematics education'),
(245, 'mathematics and design'),
(246, 'mechanical engineering'),
(247, 'mech.engr.craft pracice(fitting)'),
(248, 'mech.engr.craft pracice(machining)'),
(249, 'mech./pneumatic instrument'),
(250, 'med lab tech.'),
(251, 'medical rehabilitation'),
(252, 'men''s garment const and finishing'),
(253, 'men''s textile design'),
(254, 'metal work'),
(255, 'metallurgy'),
(256, 'microbiology'),
(257, 'midwifery'),
(258, 'mineral resourses engr.'),
(259, 'mining engineering'),
(260, 'mordern hebrew'),
(261, 'motor vehicle mech.part 1'),
(262, 'motor vehicle mech.part 2'),
(263, 'motor vehicle mechanics'),
(264, 'moulding process'),
(265, 'handling and treatment'),
(266, 'music'),
(267, 'music(practical)'),
(268, 'music theory'),
(269, 'national and regional planning'),
(270, 'natural system'),
(271, 'nursing education'),
(272, 'nursing'),
(273, 'occupational theraphy/'),
(274, 'office practice'),
(275, 'optometry'),
(276, 'painter''s and decorator;s work'),
(277, 'parasitology'),
(278, 'personal health'),
(279, 'personal management'),
(280, 'petroleum engineering'),
(281, 'painting'),
(282, 'phaermaceutical tech'),
(283, 'pharmachology'),
(284, 'pharmacy'),
(285, 'philoshophy'),
(286, 'philoshophy of education growth & development'),
(287, 'photogrammetry'),
(288, 'photography'),
(289, 'physical education'),
(290, 'physics'),
(291, 'physics(alt.syllabus)'),
(292, 'physics with chemistry'),
(293, 'physics with electronics'),
(294, 'physics with mathematics'),
(295, 'physiotheraphy'),
(296, 'planning'),
(297, 'plannin g methodology'),
(298, 'plumbing'),
(299, 'plumbing and pipe fitting'),
(300, 'plumbing craft'),
(301, 'political science'),
(302, 'politics'),
(303, 'polimer technology'),
(304, 'population and urbanisation studies'),
(305, 'portuguese'),
(306, 'primary educ.'),
(307, 'principles of crops husbandary'),
(308, 'principles of refridgerator compressor'),
(309, 'printing origination'),
(310, 'printing technology'),
(311, 'production management'),
(312, 'project management'),
(313, 'phychology'),
(314, 'public accounting and auditing'),
(315, 'public administration'),
(316, 'public finance'),
(317, 'public health'),
(318, 'public relation'),
(319, 'purchasing and supply'),
(320, 'quantity surveying'),
(321, 'radio communication'),
(322, 'radio television and electronic servicing'),
(323, 'radiology'),
(324, 'ref and arircon service'),
(325, 'ref and arircon conditioning'),
(326, 'ref and arircon conditioning'),
(327, 'religious knowledge studies'),
(328, 'religious studies'),
(329, 'religious studies (christianity)'),
(330, 'religious studies (islamic)'),
(331, 'residential project'),
(332, 'rubber technology'),
(333, 'rural biology'),
(334, 'rural science'),
(335, 'rural and resource planning'),
(336, 'russian language'),
(337, 'SIWES'),
(338, 'sanitation'),
(339, 'science'),
(340, 'science and calculation tech'),
(341, 'science education'),
(342, 'science lab.tech'),
(343, 'secreterial studies'),
(344, 'service station mech.work'),
(345, 'sheet metal/struc-still etc'),
(346, 'short hand'),
(347, 'social development'),
(348, 'social policy and admin'),
(349, 'social science/studies'),
(350, 'social works'),
(351, 'sociology'),
(352, 'soil'),
(353, 'spanish'),
(354, 'special educaton'),
(355, 'special reading'),
(356, 'spinning'),
(357, 'spray/painting'),
(358, 'statistics'),
(359, 'stenography'),
(360, 'studio production'),
(361, 'surface design and printig'),
(362, 'survey(practicals)'),
(363, 'surveying(elementary)'),
(364, 'sysrem science'),
(365, 'teacher education'),
(366, 'teaching practice'),
(367, 'technical drawing'),
(368, 'technical education'),
(369, 'technology'),
(370, 'telecommunication'),
(371, 'television'),
(372, 'textile'),
(373, 'textile technology'),
(374, 'thertre arts'),
(375, 'theology'),
(376, 'town planning'),
(377, 'tourism'),
(378, 'transport planning'),
(379, 'turning.milling'),
(380, 'planning'),
(381, 'tiv'),
(382, 'tourism'),
(383, 'tractor layout undercariage'),
(384, 'transmission system'),
(385, 'typewrittng'),
(386, 'upholstery design and construction'),
(387, 'urbanisation & housing'),
(388, 'ukwani'),
(389, 'urbanisation and housing'),
(390, 'vehicle painting and trimming'),
(391, 'vb building wood and metal'),
(392, 'wood works'),
(393, 'wood turning lathes spindle'),
(394, 'muolding'),
(395, 'worlds history'),
(396, 'wall hanging'),
(397, 'walls'),
(398, 'water resourses'),
(399, 'weaving'),
(400, 'welding craft practice'),
(401, 'wild life management'),
(402, 'winding of elec m/c'),
(403, 'yoruba language'),
(404, 'zoology'),
(405, 'Literature in english'),
(406, 'arabic literature'),
(407, 'General Studies'),
(408, 'Basic English'),
(409, 'Basic Mathematics'),
(410, 'Fine Arts (Visual Arts)'),
(411, 'Visual Arts'),
(412, 'Class Teaching'),
(413, 'Financial Accounting'),
(414, 'Language and Communication Skills'),
(415, 'ICT (Information and Communication Technology)'),
(416, 'Political Economics'),
(417, 'Citizenship Education'),
(418, 'Education of the Hearing Impaired'),
(419, 'Genaral Education ');

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE IF NOT EXISTS `faculty` (
  `faculty_id` int(11) NOT NULL AUTO_INCREMENT,
  `faculty_name` varchar(50) NOT NULL DEFAULT '',
  `faculty_code` char(3) NOT NULL DEFAULT '',
  `status` int(2) NOT NULL,
  PRIMARY KEY (`faculty_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`faculty_id`, `faculty_name`, `faculty_code`, `status`) VALUES
(1, 'Arts', 'AR', 1),
(2, 'Education', 'ED', 0),
(3, 'Environmental Sciences', 'EV', 0),
(4, 'Law', 'LW', 0),
(5, 'Medical Sciences', 'MD', 0),
(6, 'Natural Sciences', 'NS', 0),
(7, 'Pharmaceutical Sciences', 'PH', 0),
(8, 'Social Sciences', 'SS', 0),
(9, 'General Studies', 'GS', 0),
(10, 'Center for Continuing Education', 'CCE', 1),
(11, 'Institute of Education', 'IOE', 0),
(12, 'Post-Graduate Programmes', 'PGA', 1),
(13, 'POST UTME', 'PU', 0),
(14, 'DE SCREENING', 'DE', 0),
(15, 'Part-Time Undergraduate', 'PTA', 1),
(16, 'Diploma Programmes', 'DPA', 1),
(17, 'Remedial Programmes', 'RPA', 1),
(18, 'Engineering', 'ENG', 0),
(19, 'Agriculture', 'AG', 0),
(20, 'Corper', 'COR', 0);

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE IF NOT EXISTS `files` (
  `file_id` int(11) NOT NULL AUTO_INCREMENT,
  `applicant_id` int(11) NOT NULL,
  `filename` varchar(30) NOT NULL,
  `type` varchar(50) NOT NULL,
  `size` int(11) NOT NULL,
  `caption` varchar(255) NOT NULL,
  PRIMARY KEY (`file_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`file_id`, `applicant_id`, `filename`, `type`, `size`, `caption`) VALUES
(1, 74, '74-degree-certificate.pdf', 'application/pdf', 90811, 'Degree Certificate'),
(2, 74, '74-degree-transcript.pdf', 'application/pdf', 90811, 'Degree Transcript'),
(3, 75, '75-thesis.pdf', 'application/pdf', 777432, 'Thesis Proposal'),
(4, 74, '74-thesis.pdf', 'application/pdf', 2055632, 'Thesis Proposal'),
(5, 118, '118-thesis.pdf', 'application/pdf', 90811, 'Thesis Proposal'),
(6, 118, '118-Document-1.pdf', 'application/pdf', 90811, 'Document 1'),
(7, 118, '118-Document-2.pdf', 'application/pdf', 90811, 'Document 2');

-- --------------------------------------------------------

--
-- Table structure for table `form_amount`
--

CREATE TABLE IF NOT EXISTS `form_amount` (
  `amount_id` int(11) NOT NULL AUTO_INCREMENT,
  `amount` varchar(15) NOT NULL,
  `student_status` varchar(3) NOT NULL,
  `pay_item_id` int(11) NOT NULL,
  `description` varchar(100) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`amount_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `form_amount`
--

INSERT INTO `form_amount` (`amount_id`, `amount`, `student_status`, `pay_item_id`, `description`, `status`) VALUES
(1, '4000', 'RPA', 105, 'Unijos Remedial Science 105', 1),
(2, '5000', 'PTA', 104, 'Unijos PT B.Ed Undergraduate 104', 1),
(3, '8600', 'PGA', 105, 'Unijos Remedial Science 105', 1),
(4, '4500', 'DPA', 107, 'Unijos ICT Programmes 107', 1);

-- --------------------------------------------------------

--
-- Table structure for table `higher_institutions`
--

CREATE TABLE IF NOT EXISTS `higher_institutions` (
  `high_id` int(11) NOT NULL AUTO_INCREMENT,
  `applicant_id` int(11) NOT NULL,
  `institution_name` varchar(200) NOT NULL,
  `registration_no` varchar(30) NOT NULL,
  `class_of_degree` varchar(20) NOT NULL,
  `year_of_attendance` varchar(4) NOT NULL,
  `graduation_year` varchar(4) NOT NULL,
  `degree_earned` varchar(10) NOT NULL,
  `cgpa` varchar(4) NOT NULL,
  `course_of_study` varchar(50) NOT NULL,
  PRIMARY KEY (`high_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `higher_institutions`
--

INSERT INTO `higher_institutions` (`high_id`, `applicant_id`, `institution_name`, `registration_no`, `class_of_degree`, `year_of_attendance`, `graduation_year`, `degree_earned`, `cgpa`, `course_of_study`) VALUES
(1, 73, '', '', '', '', '', '', '', ''),
(2, 74, 'University of Jos', 'uj/2008/ns/005', 'Second class upper', '2001', '2004', 'Bsc', '4.5', 'History'),
(3, 75, 'University of Jos', '', 'first class', '2008', '2012', 'B.Sc', '5.00', 'Computer Science'),
(4, 75, 'Massachausets Institute of Technology', '', 'A', '2012', '2013', 'M.Sc', '72%', 'Robotics & Artificial Intelligence'),
(5, 77, 'futo', '', '2.1', '2001', '2011', 'btech', '2.1', 'computer sci.'),
(6, 81, 'st.beklk;okdsf ', '', 'dsferf', '2011', '2011', 'btech', '21', 'computer sci'),
(7, 83, 'futo', '', 'skjdgkj', '2011', '2011', 'btech', '2.1', 'computer sci.'),
(8, 92, 'futo', '', '1st', '2011', '2011', 'btech', '2.1', 'computer sci'),
(9, 97, 'futo', '', '1st', '2011', '2011', 'btech', '2.1', 'computer sci.'),
(10, 100, 'national jlJLKASGDF', '', '2nd', '2011', '2011', 'btech', '2.1', 'computer sci'),
(11, 105, 'futo', '', '2nd', '2011', '2011', 'btech', '2.1', 'computer sci.'),
(12, 101, 'dhfkjandfjgnma', '', '2nd ', '2011', '2011', 'btech', '2.1', 'computer sci'),
(13, 103, 'jksdhfkjchfsd', '', 'jiakdfgiv', '2011', '2011', 'jhsdfghvio', 'cksd', 'kjdfugikrdfgi'),
(14, 106, 'kjfhgnkljsmfg wirgrfg', '', 'kjeklfdks', '2011', '2011', 'skjdgnjkrt', 'nsdn', 'okjlleasfdojke'),
(15, 107, 'shjdkfjkjlkfdlka jo9jioj', '', 'jiodljohigjoidr', '2011', '2011', 'mlkfdopgbp', 'cklj', 'iojodprdfgjiokgf'),
(16, 108, 'kahsdkfjcjksdg f', '', 'iojrsdljtfoi', '2011', '2011', 'ihjoisejsd', 'hfgf', 'isoejtsoifer'),
(17, 109, 'futo', '', '2nd', '2010', '2015', 'btech.', '4.5', 'computer science'),
(18, 118, 'Ahmadu Bello University', '', 'first', '2008', '2012', 'Bsc', '4.9', 'Computer Science');

-- --------------------------------------------------------

--
-- Table structure for table `interswitch_error_code`
--

CREATE TABLE IF NOT EXISTS `interswitch_error_code` (
  `error_id` int(11) NOT NULL AUTO_INCREMENT,
  `response_code` varchar(5) NOT NULL,
  `response_description` varchar(100) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`error_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=161 ;

--
-- Dumping data for table `interswitch_error_code`
--

INSERT INTO `interswitch_error_code` (`error_id`, `response_code`, `response_description`, `status`) VALUES
(1, '00', 'Approved successful', 1),
(2, '01', 'Refer to Financial Institution', 1),
(3, '02', 'Refer to Financial Institution, Special Condition', 1),
(4, '03', 'Invalid Merchant', 1),
(5, '04', 'Pick-up card', 1),
(6, '05', 'Do Not Honor', 1),
(7, '06', 'Error', 1),
(8, '07', 'Pick-Up Card, Special Condition', 1),
(9, '08', 'Honor with Identification', 1),
(10, '09', 'Request in Progress', 1),
(11, '10', 'Approved by Financial Institution, Partial', 1),
(12, '11', 'Approved by Financial Institution, VIP', 1),
(13, '12', 'Invalid Transaction', 1),
(14, '13', 'Invalid Amount', 1),
(17, '14', 'Invalid Card Number', 1),
(18, '15', 'No Such Financial Institution', 1),
(21, '16', 'Approved by Financial Institution, Update Track 3', 1),
(22, '17', 'Customer Cancellation', 1),
(37, '18', 'Customer Dispute', 1),
(38, '19', 'Re-enter Transaction', 1),
(39, '18', 'Customer Dispute', 1),
(40, '19', 'Re-enter Transaction', 1),
(41, '20', 'Invalid Response from Financial Institution', 1),
(42, '21', 'No Action Taken by Financial Institution', 1),
(45, '22', 'Suspected Malfunction', 1),
(46, '23', 'Unacceptable Transaction Fee', 1),
(49, '24', 'File Update not Supported', 1),
(50, '25', 'Unable to Locate Record', 1),
(53, '26', 'Duplicate Record', 1),
(54, '27', 'File Update Field Edit Error', 1),
(57, '28', 'File Update File Locked', 1),
(58, '29', 'File Update Failed', 1),
(61, '30', 'Format Error', 1),
(62, '31', 'Bank Not Supported', 1),
(65, '32', 'Completed Partially by Financial Institution', 1),
(66, '33', 'Expired Card, Pick-Up', 1),
(69, '34', 'Suspected Fraud, Pick-Up', 1),
(70, '35', 'Contact Acquirer, Pick-Up', 1),
(73, '36', 'Restricted Card, Pick-Up', 1),
(74, '37', 'Call Acquirer Security, Pick-Up', 1),
(77, '38', 'PIN Tries Exceeded, Pick-Up', 1),
(78, '39', 'No Credit Account', 1),
(81, '40', 'Function not Supported', 1),
(82, '41', 'Lost Card, Pick-Up', 1),
(85, '42', 'No Universal Account', 1),
(86, '43', 'Stolen Card, Pick-Up', 1),
(89, '44', 'No Investment Account', 1),
(90, '45', 'Insufficient Funds', 1),
(93, '53', 'No Savings Account', 1),
(94, '54', 'Expired Card', 1),
(97, '52', 'No Check Account', 1),
(98, '55', 'Incorrect PIN', 1),
(101, '56', 'No Card Record', 1),
(102, '57', 'Transaction not permitted to Cardholder', 1),
(105, '58', 'Transaction not permitted on Terminal', 1),
(106, '59', 'Suspected Fraud', 1),
(109, '60', 'Contact Acquirer', 1),
(110, '61', 'Exceeds Withdrawal Limit', 1),
(113, '62', 'Restricted Card', 1),
(114, '63', 'Security Violation', 1),
(117, '', 'Pending...', 1),
(118, '64', 'Original Amount Incorrect', 1),
(119, '65', 'Exceeds withdrawal frequency', 1),
(120, '64', 'Original Amount Incorrect', 1),
(121, '65', 'Exceeds withdrawal frequency', 1),
(122, '66', 'Call Acquirer Security', 1),
(123, '67', 'Hard Capture', 1),
(124, '66', 'Call Acquirer Security', 1),
(125, '67', 'Hard Capture', 1),
(126, '68', 'Response Received Too Late', 1),
(127, '75', 'PIN tries exceeded', 1),
(128, '68', 'Response Received Too Late', 1),
(129, '75', 'PIN tries exceeded', 1),
(130, '76', 'Reserved for Future Postilion Use', 1),
(131, '77', 'Intervene, Bank Approval Required', 1),
(132, '76', 'Reserved for Future Postilion Use', 1),
(133, '77', 'Intervene, Bank Approval Required', 1),
(134, '78', 'Intervene, Bank Approval Required for Partial Amount', 1),
(135, '90', 'Cut-off in Progress', 1),
(136, '78', 'Intervene, Bank Approval Required for Partial Amount', 1),
(137, '90', 'Cut-off in Progress', 1),
(138, '91', 'Issuer or Switch Inoperative', 1),
(139, '92', 'Routing Error', 1),
(140, '91', 'Issuer or Switch Inoperative', 1),
(141, '92', 'Routing Error', 1),
(142, '93', 'Violation of law', 1),
(143, '94', 'Duplicate Transaction', 1),
(144, '93', 'Violation of law', 1),
(145, '94', 'Duplicate Transaction', 1),
(146, '96', 'Reconcile Error', 1),
(147, '97', 'System Malfunction', 1),
(148, '98', 'Exceeds Cash Limit', 1),
(149, 'A0', 'Unexpected error', 1),
(150, 'A4', 'Transaction not permitted to card holder, via channels', 1),
(151, 'Z0', 'Transaction Status Unconfirmed', 1),
(152, 'Z1', 'Transaction Error', 1),
(153, 'Z2', 'Bank account error', 1),
(154, 'Z3', 'Bank collections account error', 1),
(155, 'Z4', 'Interface Integration Error', 1),
(156, 'Z5', 'Duplicate Reference Error', 1),
(157, 'Z6', 'Incomplete Transaction', 1),
(158, 'Z7', 'Transaction Split Pre-processing Error', 1),
(159, 'Z8', 'Invalid Card Number, via channels', 1),
(160, 'Z9', 'Transaction not permitted to card holder, via channels', 1);

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE IF NOT EXISTS `invoice` (
  `invoice_id` int(11) NOT NULL AUTO_INCREMENT,
  `applicant_id` int(11) NOT NULL,
  `amount` varchar(6) NOT NULL,
  `date` varchar(20) NOT NULL,
  PRIMARY KEY (`invoice_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=135 ;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`invoice_id`, `applicant_id`, `amount`, `date`) VALUES
(1, 74, '8600', '2015-02-09 17:11:55'),
(2, 74, '8600', '2015-02-09 17:13:02'),
(3, 74, '8600', '2015-02-09 17:13:07'),
(4, 74, '8600', '2015-02-09 21:24:33'),
(5, 74, '8600', '2015-02-09 21:32:35'),
(6, 74, '8600', '2015-02-09 21:33:19'),
(7, 74, '8600', '2015-02-09 21:34:50'),
(8, 74, '8600', '2015-02-09 21:35:40'),
(9, 74, '8600', '2015-02-09 21:36:50'),
(10, 74, '8600', '2015-02-09 21:55:08'),
(11, 74, '8600', '2015-02-09 22:00:26'),
(12, 74, '8600', '2015-02-09 22:00:55'),
(13, 74, '8600', '2015-02-09 23:23:05'),
(14, 85, '4800', '2015-02-09 23:28:18'),
(15, 85, '4500', '2015-02-09 23:29:20'),
(16, 74, '8600', '2015-02-10 11:53:20'),
(17, 74, '8600', '2015-02-11 14:57:01'),
(18, 74, '8600', '2015-02-11 15:02:48'),
(19, 74, '8600', '2015-02-11 15:03:41'),
(20, 74, '8600', '2015-02-11 15:05:37'),
(21, 74, '8600', '2015-02-11 15:06:21'),
(22, 74, '8600', '2015-02-11 15:13:25'),
(23, 74, '8600', '2015-02-11 15:16:21'),
(24, 74, '8600', '2015-02-11 15:16:28'),
(25, 74, '8600', '2015-02-11 15:16:36'),
(26, 74, '8600', '2015-02-11 15:18:29'),
(27, 74, '8600', '2015-02-11 15:18:32'),
(28, 74, '8600', '2015-02-11 15:18:34'),
(29, 74, '8600', '2015-02-11 15:18:36'),
(30, 74, '8600', '2015-02-11 15:18:39'),
(31, 74, '8600', '2015-02-11 15:20:35'),
(32, 74, '8600', '2015-02-12 09:56:46'),
(33, 74, '8600', '2015-02-12 09:58:42'),
(34, 74, '8600', '2015-02-12 10:01:08'),
(35, 74, '8600', '2015-02-12 10:16:56'),
(36, 74, '8600', '2015-02-16 13:32:58'),
(37, 74, '8600', '2015-02-16 13:36:52'),
(38, 74, '8600', '2015-02-16 13:37:03'),
(39, 74, '8600', '2015-02-16 13:45:36'),
(40, 74, '8600', '2015-02-16 13:47:11'),
(41, 74, '8600', '2015-02-16 13:47:25'),
(42, 74, '8600', '2015-02-16 14:18:25'),
(43, 74, '8600', '2015-02-16 14:34:38'),
(44, 74, '8600', '2015-02-16 14:38:57'),
(45, 74, '8600', '2015-02-16 14:40:12'),
(46, 74, '8600', '2015-02-16 14:44:39'),
(47, 74, '8600', '2015-02-16 14:49:16'),
(48, 74, '8600', '2015-02-16 14:50:04'),
(49, 74, '8600', '2015-02-16 14:50:47'),
(50, 74, '8600', '2015-02-16 14:51:12'),
(51, 74, '8600', '2015-02-16 14:53:49'),
(52, 74, '8600', '2015-02-16 14:53:55'),
(53, 74, '8600', '2015-02-16 14:54:31'),
(54, 74, '8600', '2015-02-16 14:57:58'),
(55, 74, '8600', '2015-02-16 14:58:28'),
(56, 74, '8600', '2015-02-16 15:07:34'),
(57, 74, '8600', '2015-02-16 15:07:41'),
(58, 0, '8600', '2015-02-16 15:36:06'),
(59, 0, '8600', '2015-02-16 15:43:17'),
(60, 74, '8600', '2015-02-16 15:46:38'),
(61, 74, '8600', '2015-02-16 15:46:50'),
(62, 74, '8600', '2015-02-16 15:47:43'),
(63, 74, '8600', '2015-02-16 15:49:33'),
(64, 74, '8600', '2015-02-16 15:52:42'),
(65, 74, '8600', '2015-02-16 15:54:05'),
(66, 74, '8600', '2015-02-17 09:48:38'),
(67, 74, '8600', '2015-02-17 09:51:54'),
(68, 74, '8600', '2015-02-17 09:53:02'),
(69, 74, '8600', '2015-02-17 09:53:16'),
(70, 74, '8600', '2015-02-17 09:53:42'),
(71, 74, '8600', '2015-02-17 09:55:04'),
(72, 74, '8600', '2015-02-17 09:56:19'),
(73, 74, '8600', '2015-02-17 09:56:58'),
(74, 74, '8600', '2015-02-17 09:57:22'),
(75, 74, '8600', '2015-02-17 09:57:48'),
(76, 74, '8600', '2015-02-17 09:58:56'),
(77, 74, '8600', '2015-02-17 10:00:10'),
(78, 74, '8600', '2015-02-17 10:00:35'),
(79, 74, '8600', '2015-02-17 10:01:03'),
(80, 74, '8600', '2015-02-17 10:01:22'),
(81, 74, '8600', '2015-02-17 10:02:40'),
(82, 74, '8600', '2015-02-17 10:02:53'),
(83, 74, '8600', '2015-02-17 10:03:09'),
(84, 74, '8600', '2015-02-17 10:04:44'),
(85, 74, '8600', '2015-02-17 10:04:58'),
(86, 74, '8600', '2015-02-17 10:05:08'),
(87, 74, '8600', '2015-02-17 10:05:55'),
(88, 74, '8600', '2015-02-17 10:06:09'),
(89, 74, '8600', '2015-02-17 10:06:25'),
(90, 74, '8600', '2015-02-17 10:06:55'),
(91, 74, '8600', '2015-02-17 10:07:07'),
(92, 74, '8600', '2015-02-17 10:07:10'),
(93, 74, '8600', '2015-02-17 10:12:56'),
(94, 74, '8600', '2015-02-17 10:13:27'),
(95, 74, '8600', '2015-02-17 10:15:02'),
(96, 74, '8600', '2015-02-17 10:15:06'),
(97, 74, '8600', '2015-02-17 10:15:33'),
(98, 74, '8600', '2015-02-17 10:18:02'),
(99, 74, '8600', '2015-02-17 10:21:19'),
(100, 74, '8600', '2015-02-17 10:22:17'),
(101, 74, '8600', '2015-02-17 10:23:21'),
(102, 74, '8600', '2015-02-17 10:28:27'),
(103, 74, '8600', '2015-02-17 10:28:45'),
(104, 74, '8600', '2015-02-17 10:30:12'),
(105, 74, '8600', '2015-02-17 10:33:23'),
(106, 74, '8600', '2015-02-17 10:33:28'),
(107, 74, '8600', '2015-02-17 10:33:37'),
(108, 74, '8600', '2015-02-17 10:34:27'),
(109, 74, '8600', '2015-02-17 10:34:52'),
(110, 74, '8600', '2015-02-17 10:35:03'),
(111, 74, '8600', '2015-02-17 10:35:27'),
(112, 74, '8600', '2015-02-17 10:35:34'),
(113, 74, '8600', '2015-02-17 10:40:39'),
(114, 74, '8600', '2015-02-17 10:41:15'),
(115, 74, '8600', '2015-02-17 10:43:39'),
(116, 74, '8600', '2015-02-17 10:44:02'),
(117, 74, '8600', '2015-02-17 10:44:59'),
(118, 74, '8600', '2015-02-17 10:48:01'),
(119, 74, '8600', '2015-02-17 10:48:23'),
(120, 74, '8600', '2015-02-17 10:49:13'),
(121, 74, '8600', '2015-02-17 10:49:47'),
(122, 74, '8600', '2015-02-17 10:50:39'),
(123, 74, '8600', '2015-02-17 10:52:37'),
(124, 74, '8600', '2015-02-17 10:52:54'),
(125, 74, '8600', '2015-02-17 10:53:21'),
(126, 74, '8600', '2015-02-17 10:55:06'),
(127, 74, '8600', '2015-02-17 10:56:58'),
(128, 74, '8600', '2015-02-17 11:23:29'),
(129, 74, '8600', '2015-02-17 11:29:28'),
(130, 74, '8600', '2015-02-17 11:29:43'),
(131, 74, '8600', '2015-02-17 11:59:43'),
(132, 74, '8600', '2015-02-17 12:00:27'),
(133, 74, '8600', '2015-02-18 13:02:43'),
(134, 74, '8600', '2015-02-18 16:33:50');

-- --------------------------------------------------------

--
-- Table structure for table `lga`
--

CREATE TABLE IF NOT EXISTS `lga` (
  `lga_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `state_id` int(11) NOT NULL DEFAULT '0',
  `lga_name` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`lga_id`),
  KEY `state_id` (`state_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=791 ;

--
-- Dumping data for table `lga`
--

INSERT INTO `lga` (`lga_id`, `state_id`, `lga_name`) VALUES
(1, 1, 'Aba North'),
(2, 1, 'Aba South'),
(3, 1, 'Arochukwu'),
(4, 1, 'Bende'),
(5, 1, 'Ikwuano'),
(6, 1, 'Isiala-Ngwa North'),
(7, 1, 'Isiala-Ngwa South'),
(8, 1, 'Isikwuato'),
(9, 1, 'Nneochi'),
(10, 1, 'Obi-Ngwa'),
(11, 1, 'Ohafia'),
(12, 1, 'Osisioma'),
(13, 1, 'Ugwunagbo'),
(14, 1, 'Ukwa East'),
(15, 1, 'Ukwa West'),
(16, 1, 'Umuahia North'),
(17, 1, 'Umuahia South'),
(18, 2, 'Demsa'),
(19, 2, 'Fufore'),
(20, 2, 'Genye'),
(21, 2, 'Girei'),
(22, 2, 'Gombi'),
(23, 2, 'guyuk'),
(24, 2, 'Hong'),
(25, 2, 'Jada'),
(26, 2, 'Jimeta'),
(27, 2, 'Lamurde'),
(28, 2, 'Madagali'),
(29, 2, 'Maiha'),
(30, 2, 'Mayo Belwa'),
(31, 2, 'Michika'),
(32, 2, 'Mubi North'),
(33, 2, 'Mubi South'),
(34, 2, 'Numan'),
(35, 2, 'Shelleng'),
(36, 2, 'Song'),
(37, 2, 'Toungo'),
(38, 2, 'Yola'),
(39, 3, 'Abak'),
(40, 3, 'Eastern-Obolo'),
(41, 3, 'Eket'),
(42, 3, 'Ekpe-Atani'),
(43, 3, 'Essien-Udim'),
(44, 3, 'Esit Ekit'),
(45, 3, 'Etim-Ekpo'),
(46, 3, 'Etinan'),
(47, 3, 'Ibeno'),
(48, 3, 'Ibesikp-Asitan'),
(49, 3, 'Ibiono-Ibom'),
(50, 3, 'Ika'),
(51, 3, 'Ikono'),
(52, 3, 'Ikot-Abasi'),
(53, 3, 'Ikot-Ekpene'),
(54, 3, 'Ini'),
(55, 3, 'Itu'),
(56, 3, 'Mbo'),
(57, 3, 'Mkpae-Enin'),
(58, 3, 'Nsit-Ibom'),
(59, 3, 'Nsit-Ubium'),
(60, 3, 'Obot-Akara'),
(61, 3, 'Okobo'),
(62, 3, 'Onna'),
(63, 3, 'Oron'),
(64, 3, 'Oro-Anam'),
(65, 3, 'Udung-Uko'),
(66, 3, 'Ukanefun'),
(67, 3, 'Uru Offong Oruko'),
(68, 3, 'Uruan'),
(69, 3, 'Uquo Ibene'),
(70, 3, 'Uyo'),
(71, 4, 'Aguata'),
(72, 4, 'Anambra'),
(73, 4, 'Anambra West'),
(74, 4, 'Anocha'),
(75, 4, 'Awka- North'),
(76, 4, 'Awka-South'),
(77, 4, 'Ayamelum'),
(78, 4, 'Dunukofia'),
(79, 4, 'Ekwusigo'),
(80, 4, 'Idemili-North'),
(81, 4, 'Idemili-South'),
(82, 4, 'Ihiala'),
(83, 4, 'Njikoka'),
(84, 4, 'Nnewi-North'),
(85, 4, 'Nnewi-South'),
(86, 4, 'Ogbaru'),
(87, 4, 'Onisha North'),
(88, 4, 'Onitsha South'),
(89, 4, 'Orumba North'),
(90, 4, 'Orumba South'),
(91, 4, 'Oyi'),
(92, 5, 'Alkaleri'),
(93, 5, 'Bauchi'),
(94, 5, 'Bogoro'),
(95, 5, 'Damban'),
(96, 5, 'Darazo'),
(97, 5, 'Dass'),
(98, 5, 'Gamawa'),
(99, 5, 'Ganjuwa'),
(100, 5, 'Giade'),
(101, 5, 'Itas/Gadau'),
(102, 5, 'Jama''are'),
(103, 5, 'Katagum'),
(104, 5, 'Kirfi'),
(105, 5, 'Misau'),
(106, 5, 'Ningi'),
(107, 5, 'Shira'),
(108, 5, 'Tafawa-Balewa'),
(109, 5, 'Toro'),
(110, 5, 'Warji'),
(111, 5, 'Zaki'),
(112, 6, 'Brass'),
(113, 6, 'Ekerernor'),
(114, 6, 'Kolokuma/Opokuma'),
(115, 6, 'Nembe'),
(116, 6, 'Ogbia'),
(117, 6, 'Sagbama'),
(118, 6, 'Southern-Ijaw'),
(119, 6, 'Yenegoa'),
(120, 6, 'Kembe'),
(121, 7, 'Ado'),
(122, 7, 'Agatu'),
(123, 7, 'Apa'),
(124, 7, 'Buruku'),
(125, 7, 'Gboko'),
(126, 7, 'Guma'),
(127, 7, 'Gwer-East'),
(128, 7, 'Gwer-West'),
(129, 7, 'Katsina-Ala'),
(130, 7, 'Konshisha'),
(131, 7, 'Kwande'),
(132, 7, 'Logo'),
(133, 7, 'Makurdi'),
(134, 7, 'Obi'),
(135, 7, 'Ogbadibo'),
(136, 7, 'Ohimini'),
(137, 7, 'Oju'),
(138, 7, 'Okpokwu'),
(139, 7, 'Otukpo'),
(140, 7, 'Tarkar'),
(141, 7, 'Vandeikya'),
(142, 7, 'Ukum'),
(143, 7, 'Ushongo'),
(144, 8, 'Abadan'),
(145, 8, 'Askira-Uba'),
(146, 8, 'Bama'),
(147, 8, 'Bayo'),
(148, 8, 'Biu'),
(149, 8, 'Chibok'),
(150, 8, 'Damboa'),
(151, 8, 'Dikwa'),
(152, 8, 'Gubio'),
(153, 8, 'Guzamala'),
(154, 8, 'Gwoza'),
(155, 8, 'Hawul'),
(156, 8, 'Jere'),
(157, 8, 'Kaga'),
(158, 8, 'Kala/Balge'),
(159, 8, 'Kukawa'),
(160, 8, 'Konduga'),
(161, 8, 'Kwaya-Kusar'),
(162, 8, 'Mafa'),
(163, 8, 'Magumeri'),
(164, 8, 'Maiduguri'),
(165, 8, 'Marte'),
(166, 8, 'Mobbar'),
(167, 8, 'Monguno'),
(168, 8, 'Ngala'),
(169, 8, 'Nganzai'),
(170, 8, 'Shani'),
(171, 9, 'Abi'),
(172, 9, 'Akamkpa'),
(173, 9, 'Akpabuyo'),
(174, 9, 'Bakassi'),
(175, 9, 'Bekwara'),
(176, 9, 'Biasi'),
(177, 9, 'Boki'),
(178, 9, 'Calabar-Municipal'),
(179, 9, 'Calabar-South'),
(180, 9, 'Etunk'),
(181, 9, 'Ikom'),
(182, 9, 'Obantiku'),
(183, 9, 'Ogoja'),
(184, 9, 'Ugep North'),
(185, 9, 'Yakurr'),
(186, 9, 'Yala'),
(187, 10, 'Aniocha North'),
(188, 10, 'Aniocha South'),
(189, 10, 'Bomadi'),
(190, 10, 'Burutu'),
(191, 10, 'Ethiope East'),
(192, 10, 'Ethiope West'),
(193, 10, 'Ika North East'),
(194, 10, 'Ika South'),
(195, 10, 'Isoko North'),
(196, 10, 'Isoko South'),
(197, 10, 'Ndokwa East'),
(198, 10, 'Ndokwa West'),
(199, 10, 'Okpe'),
(200, 10, 'Oshimili North'),
(201, 10, 'Oshimili South'),
(202, 10, 'Patani'),
(203, 10, 'Sapele'),
(204, 10, 'Udu'),
(205, 10, 'Ughilli North'),
(206, 10, 'Ughilli South'),
(207, 10, 'Ukwuani'),
(208, 10, 'Uvwie'),
(209, 10, 'Warri Central'),
(210, 10, 'Warri North'),
(211, 10, 'Warri South'),
(212, 11, 'Abakaliki'),
(213, 11, 'Ofikpo North'),
(214, 11, 'Ofikpo South'),
(215, 11, 'Ebonyi'),
(216, 11, 'Ezza North'),
(217, 11, 'Ezza South'),
(218, 11, 'ikwo'),
(219, 11, 'Ishielu'),
(220, 11, 'Ivo'),
(221, 11, 'Izzi'),
(222, 11, 'Ohaukwu'),
(223, 11, 'Ohaozara'),
(224, 11, 'Onicha'),
(225, 12, 'Akoko Edo'),
(226, 12, 'Egor'),
(227, 12, 'Esan Central'),
(228, 12, 'Esan North East'),
(229, 12, 'Esan South East'),
(230, 12, 'Esan West'),
(231, 12, 'Etsako-Central'),
(232, 12, 'Etsako-West'),
(233, 12, 'Igueben'),
(234, 12, 'Ikpoba-Okha'),
(235, 12, 'Oredo'),
(236, 12, 'Orhionmwon'),
(237, 12, 'Ovia North East'),
(238, 12, 'Ovia South West'),
(239, 12, 'owan east'),
(240, 12, 'Owan West'),
(241, 12, 'Umunniwonde'),
(242, 13, 'Ado Ekiti'),
(243, 13, 'Aiyedire'),
(244, 13, 'Efon'),
(245, 13, 'Ekiti-East'),
(246, 13, 'Ekiti-South West'),
(247, 13, 'Ekiti West'),
(248, 13, 'Emure'),
(249, 13, 'Ido Osi'),
(250, 13, 'Ijero'),
(251, 13, 'Ikere'),
(252, 13, 'Ikole'),
(253, 13, 'Ilejemeta'),
(254, 13, 'Irepodun/Ifelodun'),
(255, 13, 'Ise Orun'),
(256, 13, 'Moba'),
(257, 13, 'Oye'),
(258, 14, 'Aninri'),
(259, 14, 'Awgu'),
(260, 14, 'Enugu East'),
(261, 14, 'Enugu North'),
(262, 14, 'Enugu South'),
(263, 14, 'Ezeagu'),
(264, 14, 'Igbo Etiti'),
(265, 14, 'Igbo Eze North'),
(266, 14, 'Igbo Eze South'),
(267, 14, 'Isi Uzo'),
(268, 14, 'Nkanu East'),
(269, 14, 'Nkanu West'),
(270, 14, 'Nsukka'),
(271, 14, 'Oji-River'),
(272, 14, 'Udenu'),
(273, 14, 'Udi'),
(274, 14, 'Uzo Uwani'),
(275, 15, 'Akko'),
(276, 15, 'Balanga'),
(277, 15, 'Billiri'),
(278, 15, 'Dukku'),
(279, 15, 'Funakaye'),
(280, 15, 'Gombe'),
(281, 15, 'Kaltungo'),
(282, 15, 'Kwami'),
(283, 15, 'Nafada/Bajoga'),
(284, 15, 'Shomgom'),
(285, 15, 'Yamltu/Deba'),
(286, 16, 'Ahiazu-Mbaise'),
(287, 16, 'Ehime-Mbano'),
(288, 16, 'Ezinihtte'),
(289, 16, 'Ideato North'),
(290, 16, 'Ideato South'),
(291, 16, 'Ihitte/Uboma'),
(292, 16, 'Ikeduru'),
(293, 16, 'Isiala-Mbano'),
(294, 16, 'Isu'),
(295, 16, 'Mbaitoli'),
(296, 16, 'Ngor-Okpala'),
(297, 16, 'Njaba'),
(298, 16, 'Nkwerre'),
(299, 16, 'Nwangele'),
(300, 16, 'obowo'),
(301, 16, 'Oguta'),
(302, 16, 'Ohaji-Eggema'),
(303, 16, 'Okigwe'),
(304, 16, 'Onuimo'),
(305, 16, 'Orlu'),
(306, 16, 'Orsu'),
(307, 16, 'Oru East'),
(308, 16, 'Oru West'),
(309, 16, 'Owerri Municipal'),
(310, 16, 'Owerri North'),
(311, 16, 'Owerri West'),
(312, 17, 'Auyu'),
(313, 17, 'Babura'),
(314, 17, 'Birnin Kudu'),
(315, 17, 'Birniwa'),
(316, 17, 'Bosuwa'),
(317, 17, 'Buji'),
(318, 17, 'Dutse'),
(319, 17, 'Gagarawa'),
(320, 17, 'Garki'),
(321, 17, 'Gumel'),
(322, 17, 'Guri'),
(323, 17, 'Gwaram'),
(324, 17, 'Gwiwa'),
(325, 17, 'Hadejia'),
(326, 17, 'Jahun'),
(327, 17, 'Kafin Hausa'),
(328, 17, 'Kaugama'),
(329, 17, 'Kazaure'),
(330, 17, 'Kirikasanuma'),
(331, 17, 'Kiyawa'),
(332, 17, 'Maigatari'),
(333, 17, 'Malam Maduri'),
(334, 17, 'Miga'),
(335, 17, 'Ringim'),
(336, 17, 'Roni'),
(337, 17, 'Sule Tankarkar'),
(338, 17, 'Taura'),
(339, 17, 'Yankwashi'),
(340, 18, 'Birnin-Gwari'),
(341, 18, 'Chikun'),
(342, 18, 'Giwa'),
(343, 18, 'Gwagwada'),
(344, 18, 'Igabi'),
(345, 18, 'Ikara'),
(346, 18, 'Jaba'),
(347, 18, 'Jema''a'),
(348, 18, 'Kachia'),
(349, 18, 'Kaduna North'),
(350, 18, 'Kagarko'),
(351, 18, 'Kajuru'),
(352, 18, 'Kaura'),
(353, 18, 'Kauru'),
(354, 18, 'Koka/Kawo'),
(355, 18, 'Kubah'),
(356, 18, 'Kudan'),
(357, 18, 'Lere'),
(358, 18, 'Makarfi'),
(359, 18, 'Sabon Gari'),
(360, 18, 'Sanga'),
(361, 18, 'Sabo'),
(362, 18, 'Tudun-Wada/Makera'),
(363, 18, 'Zango-Kataf'),
(364, 18, 'Zaria'),
(365, 19, 'Ajingi'),
(366, 19, ' Albasu'),
(367, 19, 'Bagwai'),
(368, 19, 'Bebeji'),
(369, 19, 'Bichi'),
(370, 19, 'Bunkure'),
(371, 19, 'Dala'),
(372, 19, 'Dambatta'),
(373, 19, 'Dawakin Kudu'),
(374, 19, 'Dawakin Tofa'),
(375, 19, 'Doguwa'),
(376, 19, 'Fagge'),
(377, 19, 'Gabasawa'),
(378, 19, 'Garko'),
(379, 19, 'Garun-Mallam'),
(380, 19, 'Gaya'),
(381, 19, 'Gezawa'),
(382, 19, 'Gwale'),
(383, 19, 'Gwarzo'),
(384, 19, 'Kabo'),
(385, 19, 'Kano Municipal'),
(386, 19, 'Karaye'),
(387, 19, 'Kibiya'),
(388, 19, 'Kiru'),
(389, 19, 'Kumbotso'),
(390, 19, 'Kunchi'),
(391, 19, 'Kura'),
(392, 19, 'Madobi'),
(393, 19, 'Makoda'),
(394, 19, 'Minjibir'),
(395, 19, 'Nasarawa'),
(396, 19, 'Rano'),
(397, 19, 'Rimin Gado'),
(398, 19, 'Rogo'),
(399, 19, 'Shanono'),
(400, 19, 'Sumaila'),
(401, 19, 'Takai'),
(402, 19, 'Tarauni'),
(403, 19, 'Tofa'),
(404, 19, 'Tsanyawa'),
(405, 19, 'Tudun Wada'),
(406, 19, 'Ngogo'),
(407, 19, 'Warawa'),
(408, 19, 'Wudil'),
(409, 20, 'Bakori'),
(410, 20, 'Batagarawa'),
(411, 20, 'Batsari'),
(412, 20, 'Baure'),
(413, 20, 'Bindawa'),
(414, 20, 'Charanchi'),
(415, 20, 'Danja'),
(416, 20, 'Danjume'),
(417, 20, 'Dan-Musa'),
(418, 20, 'Daura'),
(419, 20, 'Dutsi'),
(420, 20, 'Dutsinma'),
(421, 20, 'Faskari'),
(422, 20, 'Funtua'),
(423, 20, 'Ingara'),
(424, 20, 'Jibia'),
(425, 20, 'Kafur'),
(426, 20, 'Kaita'),
(427, 20, 'Kankara'),
(428, 20, 'Kankia'),
(429, 20, 'Katsina'),
(430, 20, 'Kurfi'),
(431, 20, 'Kusada'),
(432, 20, 'Mai Adua'),
(433, 20, 'Malumfashi'),
(434, 20, 'Mani'),
(435, 20, 'Mashi'),
(436, 20, 'Matazu'),
(437, 20, 'Musawa'),
(438, 20, 'Rimi'),
(439, 20, 'Sabuwa'),
(440, 20, 'Safana'),
(441, 20, 'Sandamu'),
(442, 20, 'Zango'),
(443, 21, 'Aleira'),
(444, 21, 'Arewa'),
(445, 21, 'Argungu'),
(446, 21, 'Augie'),
(447, 21, 'Bagudo'),
(448, 21, 'Birnin-Kebbi'),
(449, 21, 'Bumza'),
(450, 21, 'Dandi'),
(451, 21, 'Danko'),
(452, 21, 'Fakai'),
(453, 21, 'Gwandu'),
(454, 21, 'Jega'),
(455, 21, 'Kalgo'),
(456, 21, 'Koko-Besse'),
(457, 21, 'Maiyama'),
(458, 21, 'Ngaski'),
(459, 21, 'Sakaba'),
(460, 21, 'Shanga'),
(461, 21, 'Suru'),
(462, 21, 'Wasagu'),
(463, 21, 'Yauri'),
(464, 21, 'Zuru'),
(465, 22, 'Adavi'),
(466, 22, 'Ajaokuta'),
(467, 22, 'Ankpa'),
(468, 22, 'Bassa'),
(469, 22, 'Dekina'),
(470, 22, 'Ibaji'),
(471, 22, 'Idah'),
(472, 22, 'Igalamela'),
(473, 22, 'Ijumu'),
(474, 22, 'Kabba/Bunu'),
(475, 22, 'Kogi'),
(476, 22, 'Lokoja'),
(477, 22, 'Mopa-Muro-Mopi'),
(478, 22, 'Ofu'),
(479, 22, 'Ogori/Magongo'),
(480, 22, 'Okehi'),
(481, 22, 'Okene'),
(482, 22, 'Olamaboro'),
(483, 22, 'Omala'),
(484, 22, 'Oyi'),
(485, 22, 'Yagba-East'),
(486, 22, 'Yagba-West'),
(487, 23, 'Asa'),
(488, 23, 'Baruten'),
(489, 23, 'Edu'),
(490, 23, 'Ekiti'),
(491, 23, 'Ifelodun'),
(492, 23, 'Ilorin East'),
(493, 23, 'Ilorin South'),
(494, 23, 'Ilorin West'),
(495, 23, 'Irepodun'),
(496, 23, 'Isin'),
(497, 23, 'Kaiama'),
(498, 23, 'Moro'),
(499, 23, 'Offa'),
(500, 23, 'Oke-Ero'),
(501, 23, 'Oyun'),
(502, 23, 'Pategi'),
(503, 24, 'Agege'),
(504, 24, 'Ajeromi-Ifelodun'),
(505, 24, 'Alimosho'),
(506, 24, 'Amuwo-Odofin'),
(507, 24, 'Apapa'),
(508, 24, 'Bagagry'),
(509, 24, 'Epe'),
(510, 24, 'Eti-Osa'),
(511, 24, 'Ibeju-Lekki'),
(512, 24, 'Ifako-Ijaiye'),
(513, 24, 'Ikeja'),
(514, 24, 'Ikorodu'),
(515, 24, 'Kosofe'),
(516, 24, 'Lagos-Island'),
(517, 24, 'Lagos-Mainland'),
(518, 24, 'Mushin'),
(519, 24, 'Ojo'),
(520, 24, 'Oshodi-Isolo'),
(521, 24, 'Shomolu'),
(522, 24, 'Suru-Lere'),
(523, 25, 'Akwanga'),
(524, 25, 'Awe'),
(525, 25, 'Doma'),
(526, 25, 'Karu'),
(527, 25, 'Keana'),
(528, 25, 'Keffi'),
(529, 25, 'Kokona'),
(530, 25, 'Lafia'),
(531, 25, 'Nassarawa'),
(532, 25, 'Nassarawa Eggon'),
(533, 25, 'Obi'),
(534, 25, 'Toto'),
(535, 25, 'Wamba'),
(536, 26, 'Agaie'),
(537, 26, 'Agwara'),
(538, 26, 'Bida'),
(539, 26, 'Borgu'),
(540, 26, 'Bosso'),
(541, 26, 'Chanchaga'),
(542, 26, 'Edati'),
(543, 26, 'Gbako'),
(544, 26, 'Gurara'),
(545, 26, 'Katcha'),
(546, 26, 'Kontagora'),
(547, 26, 'Lapai'),
(548, 26, 'Lavum'),
(549, 26, 'Magama'),
(550, 26, 'Mariga'),
(551, 26, 'Mashegu'),
(552, 26, 'Mokwa'),
(553, 26, 'Muya'),
(554, 26, 'Paikoro'),
(555, 26, 'Rafi'),
(556, 26, 'Rajau'),
(557, 26, 'Shiroro'),
(558, 26, 'Suleja'),
(559, 26, 'Tafa'),
(560, 26, 'Wushishi'),
(561, 27, 'Abeokuta -North'),
(562, 27, 'Abeokuta -South'),
(563, 27, 'Ado-Odu/Ota'),
(564, 27, 'Yewa-North'),
(565, 27, 'Yewa-South'),
(566, 27, 'Ewekoro'),
(567, 27, 'Ifo'),
(568, 27, 'Ijebu East'),
(569, 27, 'Ijebu North'),
(570, 27, 'Ijebu North-East'),
(571, 27, 'Ijebu-Ode'),
(572, 27, 'Ikenne'),
(573, 27, 'Imeko-Afon'),
(574, 27, 'Ipokia'),
(575, 27, 'Obafemi -Owode'),
(576, 27, 'Odeda'),
(577, 27, 'Odogbolu'),
(578, 27, 'Ogun-Water Side'),
(579, 27, 'Remo-North'),
(580, 27, 'Shagamu'),
(581, 28, 'Akoko-North-East'),
(582, 28, 'Akoko-North-West'),
(583, 28, 'Akoko-South-West'),
(584, 28, 'Akoko-South-East'),
(585, 28, 'Akure- South'),
(586, 28, 'Akure-North'),
(587, 28, 'Ese-Odo'),
(588, 28, 'Idanre'),
(589, 28, 'Ifedore'),
(590, 28, 'Ilaje'),
(591, 28, 'Ile-Oluji-Okeigbo'),
(592, 28, 'Irele'),
(593, 28, 'Odigbo'),
(594, 28, 'Okitipupa'),
(595, 28, 'Ondo-West'),
(596, 28, 'Ondo East'),
(597, 28, 'Ose'),
(598, 28, 'Owo'),
(599, 29, 'Atakumosa'),
(600, 29, 'Atakumosa East'),
(601, 29, 'Ayeda-Ade'),
(602, 29, 'Ayedire'),
(603, 29, 'Boluwaduro'),
(604, 29, 'Boripe'),
(605, 29, 'Ede'),
(606, 29, 'Ede North'),
(607, 29, 'Egbedore'),
(608, 29, 'Ejigbo'),
(609, 29, 'Ife'),
(610, 29, 'Ife East'),
(611, 29, 'Ife North'),
(612, 29, 'Ife South'),
(613, 29, 'Ifedayo'),
(614, 29, 'Ifelodun'),
(615, 29, 'Ila'),
(616, 29, 'Ilesha'),
(617, 29, 'Ilesha-West'),
(618, 29, 'Irepodun'),
(619, 29, 'Irewole'),
(620, 29, 'Isokun'),
(621, 29, 'Iwo'),
(622, 29, 'Obokun'),
(623, 29, 'Odo-Otin'),
(624, 29, 'Ola Oluwa'),
(625, 29, 'Olorunda'),
(626, 29, 'Ori-Ade'),
(627, 29, 'Orolu'),
(628, 29, 'Osogbo'),
(629, 30, 'Afijio'),
(630, 30, 'Akinyele'),
(631, 30, 'Atiba'),
(632, 30, 'Atisbo'),
(633, 30, 'Egbeda'),
(634, 30, 'Ibadan-Central'),
(635, 30, 'Ibadan-North-East'),
(636, 30, 'Ibadan-North-West'),
(637, 30, 'Ibadan-South-East'),
(638, 30, 'Ibadan-South West'),
(639, 30, 'Ibarapa-Central'),
(640, 30, 'Ibarapa-East'),
(641, 30, 'Ibarapa-North'),
(642, 30, 'Ido'),
(643, 30, 'Ifedayo'),
(644, 30, 'Ifeloju'),
(645, 30, 'Irepo'),
(646, 30, 'Iseyin'),
(647, 30, 'Itesiwaju'),
(648, 30, 'Iwajowa'),
(649, 30, 'Kajola'),
(650, 30, 'Lagelu'),
(651, 30, 'Odo-Oluwa'),
(652, 30, 'Ogbomoso-North'),
(653, 30, 'Ogbomosho-South'),
(654, 30, 'Olorunsogo'),
(655, 30, 'Oluyole'),
(656, 30, 'Ona-Ara'),
(657, 30, 'Orelope'),
(658, 30, 'Ori-Ire'),
(659, 30, 'Oyo East'),
(660, 30, 'Oyo West'),
(661, 30, 'saki east'),
(662, 30, 'Saki West'),
(663, 30, 'Surulere'),
(664, 31, 'Barkin Ladi'),
(665, 31, 'Bassa'),
(666, 31, 'Bokkos'),
(667, 31, 'Jos-East'),
(668, 31, 'Jos-South'),
(669, 31, 'Jos-North'),
(670, 31, 'Kanam'),
(671, 31, 'Kanke'),
(672, 31, 'Langtang North'),
(673, 31, 'Langtang South'),
(674, 31, 'Mangu'),
(675, 31, 'Mikang'),
(676, 31, 'Pankshin'),
(677, 31, 'Quan''pan'),
(678, 31, 'Riyom'),
(679, 31, 'Shendam'),
(680, 31, 'Wase'),
(681, 32, 'Abua/Odual'),
(682, 32, 'Ahoada East'),
(683, 32, 'Ahoada West'),
(684, 32, 'Akukutoru'),
(685, 32, 'Andoni'),
(686, 32, 'Asari-Toro'),
(687, 32, 'Bonny'),
(688, 32, 'Degema'),
(689, 32, 'Eleme'),
(690, 32, 'Emuoha'),
(691, 32, 'Etche'),
(692, 32, 'Gokana'),
(693, 32, 'Ikwerre'),
(694, 32, 'Khana'),
(695, 32, 'Obio/Akpor'),
(696, 32, 'Ogba/Egbama/Ndoni'),
(697, 32, 'Ogu/Bolo'),
(698, 32, 'Okrika'),
(699, 32, 'Omuma'),
(700, 32, 'Opobo/Nkoro'),
(701, 32, 'Oyigbo'),
(702, 32, 'Port-Harcourt'),
(703, 32, 'Tai'),
(704, 33, 'Binji'),
(705, 33, 'Bodinga'),
(706, 33, 'Dange-Shuni'),
(707, 33, 'Gada'),
(708, 33, 'Goronyo'),
(709, 33, 'Gudu'),
(710, 33, 'Gwadabawa'),
(711, 33, 'Illela'),
(712, 33, 'Isa'),
(713, 33, 'Kebbe'),
(714, 33, 'Kware'),
(715, 33, 'Raba'),
(716, 33, 'Sabon-Birni'),
(717, 33, 'Shagari'),
(718, 33, 'Silame'),
(719, 33, 'Sokoto North'),
(720, 33, 'Sokoto South'),
(721, 33, 'Tambuwal'),
(722, 33, 'Tanzaga'),
(723, 33, 'Tureta'),
(724, 33, 'Wamakko'),
(725, 33, 'Wurno'),
(726, 33, 'Yabo'),
(727, 34, 'Ardo Kola'),
(728, 34, 'Bali'),
(729, 34, 'Donga'),
(730, 34, 'Gashaka'),
(731, 34, 'Gassol'),
(732, 34, 'Ibi'),
(733, 34, 'Jalingo'),
(734, 34, 'Karim-Lamido'),
(735, 34, 'Kurmi'),
(736, 34, 'Lau'),
(737, 34, 'Sardauna'),
(738, 34, 'Takum'),
(739, 34, 'Ussa'),
(740, 34, 'Wukari'),
(741, 34, 'Yarro'),
(742, 34, 'Zing'),
(743, 35, 'Bade'),
(744, 35, 'Bursali'),
(745, 35, 'Damaturu'),
(746, 35, 'Fuka'),
(747, 35, 'Fune'),
(748, 35, 'Geidam'),
(749, 35, 'Gogaram'),
(750, 35, 'Gujba'),
(751, 35, 'Gulani'),
(752, 35, 'Jakusko'),
(753, 35, 'Karasuwa'),
(754, 35, 'Machina'),
(755, 35, 'Nangere'),
(756, 35, 'Nguru'),
(757, 35, 'Potiskum'),
(758, 35, 'Tarmua'),
(759, 35, 'Yunisari'),
(760, 35, 'Yusufari'),
(761, 36, 'Anka'),
(762, 36, 'Bakure'),
(763, 36, 'Bukkuyum'),
(764, 36, 'Bungudo'),
(765, 36, 'Gumi'),
(766, 36, 'Gusau'),
(767, 36, 'Isa'),
(768, 36, 'Kaura-Namoda'),
(769, 36, 'Kiyawa'),
(770, 36, 'Maradun'),
(771, 36, 'Marau'),
(772, 36, 'Shinkafa'),
(773, 36, 'Talata-Mafara'),
(774, 36, 'Tsafe'),
(775, 36, 'Zurmi'),
(776, 9, 'Obudu'),
(777, 37, 'Abaji'),
(778, 37, 'Bwari'),
(779, 37, 'Gwagwalada'),
(780, 37, 'Kuje'),
(781, 37, 'Kwali'),
(782, 37, 'Municipal'),
(783, 12, 'Etsako-East'),
(784, 16, 'Ahiazu-Mbaise'),
(785, 38, 'Foreign'),
(786, 18, 'Kaduna South'),
(787, 16, 'Aboh-Mbaise'),
(788, 9, 'Odukpani'),
(789, 9, 'Obubra'),
(790, 4, 'Anambra East');

-- --------------------------------------------------------

--
-- Table structure for table `marital`
--

CREATE TABLE IF NOT EXISTS `marital` (
  `marital_status_id` int(11) NOT NULL AUTO_INCREMENT,
  `marital_status` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`marital_status_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `marital`
--

INSERT INTO `marital` (`marital_status_id`, `marital_status`) VALUES
(1, 'Single'),
(2, 'Married');

-- --------------------------------------------------------

--
-- Table structure for table `nationality`
--

CREATE TABLE IF NOT EXISTS `nationality` (
  `country_id` int(11) NOT NULL AUTO_INCREMENT,
  `country_name` varchar(120) NOT NULL,
  PRIMARY KEY (`country_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=239 ;

--
-- Dumping data for table `nationality`
--

INSERT INTO `nationality` (`country_id`, `country_name`) VALUES
(1, 'Afghanistan'),
(2, 'Albania'),
(3, 'Algeria'),
(4, 'American Samoa'),
(5, 'Andorra'),
(6, 'Angola'),
(7, 'Anguilla'),
(8, 'Antarctica'),
(9, 'Antigua And Barbuda'),
(10, 'Argentina'),
(11, 'Armenia'),
(12, 'Aruba'),
(13, 'Australia'),
(14, 'Austria'),
(15, 'Azerbaijan'),
(16, 'Bahamas, The'),
(17, 'Bahrain'),
(18, 'Bangladesh'),
(19, 'Barbados'),
(20, 'Belarus'),
(21, 'Belgium'),
(22, 'Belize'),
(23, 'Benin'),
(24, 'Bermuda'),
(25, 'Bhutan'),
(26, 'Bolivia'),
(27, 'Bosnia and Herzegovina'),
(28, 'Botswana'),
(29, 'Bouvet Island'),
(30, 'Brazil'),
(31, 'British Indian Ocean Territory'),
(32, 'Brunei'),
(33, 'Bulgaria'),
(34, 'Burkina Faso'),
(35, 'Burundi'),
(36, 'Cambodia'),
(37, 'Cameroon'),
(38, 'Canada'),
(39, 'Cape Verde'),
(40, 'Cayman Islands'),
(41, 'Central African Republic'),
(42, 'Chad'),
(43, 'Chile'),
(44, 'China'),
(45, 'China (Hong Kong S.A.R.)'),
(46, 'China (Macau S.A.R.)'),
(47, 'Christmas Island'),
(48, 'Cocos (Keeling) Islands'),
(49, 'Colombia'),
(50, 'Comoros'),
(51, 'Congo'),
(52, 'Congo, Democractic Republic of the'),
(53, 'Cook Islands'),
(54, 'Costa Rica'),
(55, 'Cote D''Ivoire (Ivory Coast)'),
(56, 'Croatia (Hrvatska)'),
(57, 'Cuba'),
(58, 'Cyprus'),
(59, 'Czech Republic'),
(60, 'Denmark'),
(61, 'Djibouti'),
(62, 'Dominica'),
(63, 'Dominican Republic'),
(64, 'East Timor'),
(65, 'Ecuador'),
(66, 'Egypt'),
(67, 'El Salvador'),
(68, 'Equatorial Guinea'),
(69, 'Eritrea'),
(70, 'Estonia'),
(71, 'Ethiopia'),
(72, 'Falkland Islands (Islas Malvinas)'),
(73, 'Faroe Islands'),
(74, 'Fiji Islands'),
(75, 'Finland'),
(76, 'France'),
(77, 'French Guiana'),
(78, 'French Polynesia'),
(79, 'French Southern Territories'),
(80, 'Gabon'),
(81, 'Gambia, The'),
(82, 'Georgia'),
(83, 'Germany'),
(84, 'Ghana'),
(85, 'Gibraltar'),
(86, 'Greece'),
(87, 'Greenland'),
(88, 'Grenada'),
(89, 'Guadeloupe'),
(90, 'Guam'),
(91, 'Guatemala'),
(92, 'Guinea'),
(93, 'Guinea-Bissau'),
(94, 'Guyana'),
(95, 'Haiti'),
(96, 'Heard and McDonald Islands'),
(97, 'Honduras'),
(98, 'Hungary'),
(99, 'Iceland'),
(100, 'India'),
(101, 'Indonesia'),
(102, 'Iran'),
(103, 'Iraq'),
(104, 'Ireland'),
(105, 'Israel'),
(106, 'Italy'),
(107, 'Jamaica'),
(108, 'Japan'),
(109, 'Jordan'),
(110, 'Kazakhstan'),
(111, 'Kenya'),
(112, 'Kiribati'),
(113, 'Korea'),
(114, 'Korea, North'),
(115, 'Kuwait'),
(116, 'Kyrgyzstan'),
(117, 'Laos'),
(118, 'Latvia'),
(119, 'Lebanon'),
(120, 'Lesotho'),
(121, 'Liberia'),
(122, 'Libya'),
(123, 'Liechtenstein'),
(124, 'Lithuania'),
(125, 'Luxembourg'),
(126, 'Macedonia'),
(127, 'Madagascar'),
(128, 'Malawi'),
(129, 'Malaysia'),
(130, 'Maldives'),
(131, 'Mali'),
(132, 'Malta'),
(133, 'Marshall Islands'),
(134, 'Martinique'),
(135, 'Mauritania'),
(136, 'Mauritius'),
(137, 'Mayotte'),
(138, 'Mexico'),
(139, 'Micronesia'),
(140, 'Moldova'),
(141, 'Monaco'),
(142, 'Mongolia'),
(143, 'Montserrat'),
(144, 'Morocco'),
(145, 'Mozambique'),
(146, 'Myanmar'),
(147, 'Namibia'),
(148, 'Nauru'),
(149, 'Nepal'),
(150, 'Netherlands Antilles'),
(151, 'Netherlands, The'),
(152, 'New Caledonia'),
(153, 'New Zealand'),
(154, 'Nicaragua'),
(155, 'Niger'),
(156, 'Nigeria'),
(157, 'Niue'),
(158, 'Norfolk Island'),
(159, 'Northern Mariana Islands'),
(160, 'Norway'),
(161, 'Oman'),
(162, 'Pakistan'),
(163, 'Palau'),
(164, 'Panama'),
(165, 'Papua new Guinea'),
(166, 'Paraguay'),
(167, 'Peru'),
(168, 'Philippines'),
(169, 'Pitcairn Island'),
(170, 'Poland'),
(171, 'Portugal'),
(172, 'Puerto Rico'),
(173, 'Qatar'),
(174, 'Reunion'),
(175, 'Romania'),
(176, 'Russia'),
(177, 'Rwanda'),
(178, 'Saint Helena'),
(179, 'Saint Kitts And Nevis'),
(180, 'Saint Lucia'),
(181, 'Saint Pierre and Miquelon'),
(182, 'Saint Vincent And The Grenadines'),
(183, 'Samoa'),
(184, 'San Marino'),
(185, 'Sao Tome and Principe'),
(186, 'Saudi Arabia'),
(187, 'Senegal'),
(188, 'Seychelles'),
(189, 'Sierra Leone'),
(190, 'Singapore'),
(191, 'Slovakia'),
(192, 'Slovenia'),
(193, 'Solomon Islands'),
(194, 'Somalia'),
(195, 'South Africa'),
(196, 'South Georgia'),
(197, 'Spain'),
(198, 'Sri Lanka'),
(199, 'Sudan'),
(200, 'Suriname'),
(201, 'Svalbard And Jan Mayen Islands'),
(202, 'Swaziland'),
(203, 'Sweden'),
(204, 'Switzerland'),
(205, 'Syria'),
(206, 'Taiwan'),
(207, 'Tajikistan'),
(208, 'Tanzania'),
(209, 'Thailand'),
(210, 'Togo'),
(211, 'Tokelau'),
(212, 'Tonga'),
(213, 'Trinidad And Tobago'),
(214, 'Tunisia'),
(215, 'Turkey'),
(216, 'Turkmenistan'),
(217, 'Turks And Caicos Islands'),
(218, 'Tuvalu'),
(219, 'Uganda'),
(220, 'Ukraine'),
(221, 'United Arab Emirates'),
(222, 'United Kingdom'),
(223, 'United States'),
(224, 'United States Minor Outlying Islands'),
(225, 'Uruguay'),
(226, 'Uzbekistan'),
(227, 'Vanuatu'),
(228, 'Vatican City State (Holy See)'),
(229, 'Venezuela'),
(230, 'Vietnam'),
(231, 'Virgin Islands (British)'),
(232, 'Virgin Islands (US)'),
(233, 'Wallis And Futuna Islands'),
(234, 'Western Sahara'),
(235, 'Yemen'),
(236, 'Yugoslavia'),
(237, 'Zambia'),
(238, 'Zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `news_events`
--

CREATE TABLE IF NOT EXISTS `news_events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iType` tinyint(2) NOT NULL,
  `cat_id` int(5) NOT NULL,
  `hot_news` tinyint(1) NOT NULL,
  `title` varchar(50) NOT NULL,
  `display_line` varchar(200) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(300) NOT NULL,
  `position` int(5) NOT NULL,
  `visible` tinyint(1) NOT NULL,
  `archived` tinyint(1) NOT NULL,
  `author` varchar(70) NOT NULL,
  `verified_by` varchar(70) NOT NULL,
  `created_year` year(4) NOT NULL,
  `created_time` time NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

--
-- Dumping data for table `news_events`
--

INSERT INTO `news_events` (`id`, `iType`, `cat_id`, `hot_news`, `title`, `display_line`, `content`, `image`, `position`, `visible`, `archived`, `author`, `verified_by`, `created_year`, `created_time`, `last_update`) VALUES
(34, 0, 1, 1, 'Closure of Sale of Form ', '2015 Postgradute Shool  Sale of Form Will  closed  ON 23/12/2014', '				It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it \r\n accident, sometimes on purpose (injected humour and the like).\r\n		', '', 1, 1, 0, 'Mara', 'Ghaji', 2014, '02:37:12', '2014-12-11 11:31:50'),
(35, 0, 1, 1, 'Sale of Form For Diploma', '2015 Diploma Programs  for Cunsultancy', '				It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution accident, sometimes on purpose (injected humour and the like).\r\n', '', 1, 1, 0, 'Mara', 'Ghaji', 2014, '02:37:12', '2014-12-11 11:35:51'),
(37, 0, 0, 0, 'Remedial Forms now on sale', 'Remedial Forms now on sale 2015', 'Remedial Forms now on sale&nbsp;Remedial Forms now on sale&nbsp;Remedial Forms now on sale&nbsp;Remedial Forms now on sale&nbsp;Remedial Forms now on sale&nbsp;Remedial Forms now on sale', '', 0, 1, 0, 'Oguche David', 'Ghaji', 2014, '17:06:15', '2014-12-11 16:07:24'),
(39, 0, 0, 0, 'Admission Letter is Out', 'Admission Letter', 'Testing Testing&nbsp;<i>Testing</i> Testing&nbsp;<b>Testing</b> Testing&nbsp;Testing Testing', '', 0, 1, 0, 'Oguche David', 'Oguche David', 2014, '13:12:13', '2015-02-09 22:34:07');

-- --------------------------------------------------------

--
-- Table structure for table `next_of_kin`
--

CREATE TABLE IF NOT EXISTS `next_of_kin` (
  `next_kin_id` int(11) NOT NULL AUTO_INCREMENT,
  `applicant_id` int(11) NOT NULL,
  `next_of_kin_name` varchar(90) NOT NULL,
  `next_of_kin_relationship` varchar(10) NOT NULL,
  `next_of_kin_address` text NOT NULL,
  `next_of_kin_number` varchar(15) NOT NULL,
  PRIMARY KEY (`next_kin_id`),
  UNIQUE KEY `applicant_id` (`applicant_id`),
  KEY `fk_next_of_kin_personal_details1_idx` (`applicant_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `next_of_kin`
--

INSERT INTO `next_of_kin` (`next_kin_id`, `applicant_id`, `next_of_kin_name`, `next_of_kin_relationship`, `next_of_kin_address`, `next_of_kin_number`) VALUES
(1, 73, 'nextkin name', 'nextkin', 'next of kin address', '39393929294'),
(2, 74, 'Dr S Oguche', 'Papa', 'Village House, Jos', '09090909912'),
(3, 75, 'CIS ICT', 'work', 'University of Jos ICT directorate', '09128384939'),
(4, 77, 'ksdklklf odiliadila', 'friend', 'aorefk;lfakwf aliew', '07072345678'),
(5, 79, 'mash', 'brother', 'somewherein the word', '08010000000'),
(6, 80, 'dnjkkjskjsjs', 'nshhhxhhkx', ' cxhjxchjsdsjdbjsdbnbndbdbd d dbn', '02992929292'),
(7, 81, 'james asdwef', 'friend', 'jknkjfhUAD KJPOrfokczdf', '07060000000'),
(8, 82, 'jdjfjdkfjdjfjf ffhhfhkfh  fhfhhhf', 'hnfhhjdhfh', 'hsdbsdbbsbdbsbdbsbdbdbbdbdbdbdbnd', '20992298821'),
(9, 83, 'wertlkljfjkl asjdkwf', 'friend', 'ksjfjlksjfklsac jwuroewlrn', '09023445566'),
(10, 88, 'DOCBOLA', 'FREIND', 'C;CCJKCKJSKJSDJJSDJSJSDSDNXC', '40028008101'),
(11, 92, 'rinret', 'sister', 'kllstfiojsitjf ilfjliseritf ', '09023456771'),
(12, 96, 'bngbb gjyskk jusgjsiys', 'vsgfs ggfy', 'bcbcc gfgfj  jh,shhsd sdndgksdvhsd', '78493974484'),
(13, 97, 'kalrtlofs ope;riowrg', 'friend', 'iuoziguiogf sdufoiefi', '09012345678'),
(14, 84, 'littleboy', 'son', 'ss afghanistan country', '08020000000'),
(15, 100, 'mashje dygujweu weud', 'friend', 'ukaersjdis asoijfse fiakertf', '09012345678'),
(16, 85, 'my boy', 'son', 'someplacein afghan', '08030000000'),
(17, 105, 'joy', 'sister', 'kjdfkagsfkla gjiardfmrsd vukawf', '09012345678'),
(18, 101, 'manajind liiljil', 'boss', 'ukjdfkjndjkd saikdkserr', '09012345678'),
(19, 103, 'juksdgf aeurkjgmf', 'friend', 'KLDSKHGUFJKMS FUIAERI', '09012345678'),
(20, 106, 'joy', 'Friend', 'jsgfhuikjseg sieujrtf eirjtfer', '09012345678'),
(21, 107, 'hksdhfjegd', 'jgkjkvsdgj', 'kjhafkljikjrfidsf iofijeaksgf', '09012345678'),
(22, 108, 'uisdajfiljcvstdg fjesahtjf', 'friend', 'ujksfdhujke fukehjrrfef', '09012345678'),
(23, 109, 'joseph wetle', 'father', 'nipss. kuru. plateau state', '08036226727'),
(24, 113, 'joy', 'sister', 'hdjksafn.k.asdf', '08076543219'),
(25, 115, 'Mr Jones Oguche', 'Uncle', 'Somewhere close to you.', '09009009012'),
(26, 117, 'Dr S Oguche', 'Father', 'Somewhere in Jos,\r\nPlateau State,\r\nNigeria', '09011122233'),
(27, 118, 'Mrs Bello', 'Mother', 'Rayfield Mai Adiko, Jos, Plateau State', '08000200100');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `notification_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `recipient` int(11) NOT NULL,
  `notification_date` date NOT NULL,
  `notification_time` time NOT NULL,
  `status` int(2) NOT NULL,
  PRIMARY KEY (`notification_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`notification_id`, `user_id`, `title`, `content`, `recipient`, `notification_date`, `notification_time`, `status`) VALUES
(1, 2, 'hi', 'Hi, This is your first notification from me.', 7, '2014-08-25', '14:03:35', 2),
(2, 2, 'random', 'rand', 2, '2014-08-25', '14:30:19', 2),
(3, 2, 'Inactive', 'Hi, \r\n\r\nTest inactivity', 2, '2014-08-25', '14:33:35', 2),
(4, 9, 'testing Send to admin', 'Hello Admin,<br>I have so and so problem<br><br><br><br><br><br>', 2, '2014-08-25', '16:13:15', 2),
(5, 9, 'rob', 'davido how can i view what i am doing on the brower', 2, '2014-08-26', '11:42:59', 2),
(6, 2, 'Reply to previous message', 'Try using the link<br><a href="http://david-hp/mis.unijos.edu.ng/app_form_template/credit.php" target="" rel="">http://david-hp/mis.unijos.edu.ng/app_form_template/credit.php</a>', 9, '2014-08-26', '11:51:18', 2),
(7, 2, 'davido', 'Robson, How''s it going?', 9, '2014-08-26', '12:50:42', 1);

-- --------------------------------------------------------

--
-- Table structure for table `otherpublications`
--

CREATE TABLE IF NOT EXISTS `otherpublications` (
  `publication_id` int(11) NOT NULL AUTO_INCREMENT,
  `applicant_id` int(11) NOT NULL,
  `title_of_publication` text NOT NULL,
  `publisher` varchar(200) NOT NULL,
  PRIMARY KEY (`publication_id`),
  KEY `fk_publications_personal_details1_idx` (`applicant_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `otherpublications`
--

INSERT INTO `otherpublications` (`publication_id`, `applicant_id`, `title_of_publication`, `publisher`) VALUES
(1, 74, 'Theory', 'IEEE'),
(2, 74, 't2e', 'IEEE'),
(3, 74, 'T3e', 'SS'),
(4, 75, 'other publications', 'publisher');

-- --------------------------------------------------------

--
-- Table structure for table `other_programme_details`
--

CREATE TABLE IF NOT EXISTS `other_programme_details` (
  `other_details_id` int(11) NOT NULL AUTO_INCREMENT,
  `applicant_id` int(11) NOT NULL,
  `sponsor_fullname` varchar(200) NOT NULL,
  `sponsor_occupation` varchar(250) NOT NULL,
  `sponsor_address` text NOT NULL,
  `applied_to_other_institution` varchar(1) NOT NULL,
  `denied_admission` varchar(1) NOT NULL,
  `institution_name` varchar(255) NOT NULL,
  `institution_address` text NOT NULL,
  `other_details` text NOT NULL,
  `name_of_institution` varchar(255) NOT NULL,
  `address_of_institution` text NOT NULL,
  `date_of_admission` varchar(10) NOT NULL,
  `course_of_study` varchar(200) NOT NULL,
  `reasons` text NOT NULL,
  PRIMARY KEY (`other_details_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `other_programme_details`
--

INSERT INTO `other_programme_details` (`other_details_id`, `applicant_id`, `sponsor_fullname`, `sponsor_occupation`, `sponsor_address`, `applied_to_other_institution`, `denied_admission`, `institution_name`, `institution_address`, `other_details`, `name_of_institution`, `address_of_institution`, `date_of_admission`, `course_of_study`, `reasons`) VALUES
(1, 73, 'Sponsor fullname', 'occupation', 'address', '0', '', '', '', '', '', '', '', '', 'reasons for seeking'),
(2, 80, 'dsjjkkajdhsdhdsjkdsjks', 'kkjshdjdjduk,nmdfnm', 'dfhjjkdkljkdlsdjskjdlkslbjbchdhjdhunc', '0', '', '', '', '', '', '', '', '', 'jfulffjjkdsjkjd jdjsjkxsdjdd dhdjfhjfbfhk,,dhdhsd'),
(3, 79, 'mr men', 'banker', 'somewin the world ', '1', '1', 'flyingdove', 'abuja nigeria', '', 'flyintgdove', 'abuja nigeria', '2014-08-06', 'computer scienc', 'obtaon a bsc '),
(4, 82, 'NHHDHFHFH BDOSSS', 'STUDENT', 'FFHHFHHS EJKDFSNDHSD MSDDJJDDDD', '1', '1', 'ABU', 'JDKSDJSDJSDHSHD MBSDSJDH', 'BNFSDFGS BNSGGJSDS HFJHFJFHF  DBJSSSBSM S KUWKWKWW', 'FHHFHDKKF  FHHHFHFHFH ', 'NMDHJFDNFHDF JDFMXXJXHCXM', '2014-04-16', 'COMPUTER SCIENCE', 'DEVELOPMENT AND SKILL'),
(5, 88, 'NDJ GFHFJS FGGFHFHFN', 'FH FGGJHFF CBBFNF', 'gfgf  dbffjfnbf dhdvfbfbfbnhbgg gj', '0', '', '', '', '', '', '', '', '', 'fhhfg hgfffgfgf gfvfgfgfghfgf hfvhfhfvfffhgfgf'),
(6, 96, 'hfgggggk ,usskdhasjhkjsmhdks', 'hgfgxgbdsdnbhsdh sshhdddgdjdn', 'gbdfn fsjmsdgsgdbsjmzbmdbsjhsjs', '0', '', '', '', '', '', '', '', '', 'ifgsjfj;k.fdds;ofjdsjdfh ilf,di lfmhfl iahnhsh'),
(7, 84, 'my father', 'civil savant', 'inthe afghan state', '0', '', '', '', '', '', '', '', '', 'to obtain good result'),
(8, 85, 'dr father of me', 'civil savant', 'in afghanistan sa', '0', '', '', '', '', '', '', '', '', 'continuing education'),
(9, 113, 'wetle manji', 'computer scientist', 'nipss kuru', '1', '', 'nipss', 'nipss kuru', 'dgkljsg sdfikgm', 'nipss', 'nipss kuru', '2014-08-19', 'information management ', 'because i dont knw'),
(10, 115, 'Mr Jones Oguche', 'Trader', 'Somewhere close to you', '0', '', '', '', '', '', '', '', '', 'I love this program.'),
(11, 117, 'Oguche David', 'Student', 'Somewhere in Jos,\r\nPlateau State,\r\nNigeria', '0', '', '', '', '', '', '', '', '', 'I need this degree.');

-- --------------------------------------------------------

--
-- Table structure for table `other_relevant_qualifications`
--

CREATE TABLE IF NOT EXISTS `other_relevant_qualifications` (
  `other_qualifications_id` int(11) NOT NULL AUTO_INCREMENT,
  `applicant_id` int(11) NOT NULL,
  `name_of_institutions` varchar(200) NOT NULL,
  `from_year` varchar(4) NOT NULL,
  `to_year` varchar(4) NOT NULL,
  `certificate_qualification_name` varchar(200) NOT NULL,
  `grade` varchar(20) NOT NULL,
  PRIMARY KEY (`other_qualifications_id`),
  KEY `fk_other_relevant_qualifications_personal_details1_idx` (`applicant_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `other_relevant_qualifications`
--

INSERT INTO `other_relevant_qualifications` (`other_qualifications_id`, `applicant_id`, `name_of_institutions`, `from_year`, `to_year`, `certificate_qualification_name`, `grade`) VALUES
(1, 74, 'Uni Jos', '2007', '2008', 'ccna', 'A'),
(2, 73, 'Google', '2013', '2014', 'Android certification', 'B'),
(3, 74, 'Uni Jos', '2009', '2010', 'ccnp', 'A'),
(4, 75, 'IEEE', '2008', '2009', 'CCNA', 'B'),
(5, 75, 'Google', '2010', '2011', 'Android Programmer', 'A'),
(6, 80, 'zaira', '2014', '3010', 'admission', '3.5'),
(7, 82, 'MEDICIAL', '2048', '2013', 'BTECH', '4.5'),
(8, 88, 'BOLSKF HFFJGUDHD', '2013', '8481', 'BVNFNNDNDJDDHHN', '4.95'),
(9, 96, 'jfhdhfhdhfhd bfjdhfdfmhs jdbfdj', '8333', '9447', 'bnffhfhffhhfhffhhjfhhh', '4.87'),
(10, 113, 'futo', '2011', '2014', 'btech', 'a');

-- --------------------------------------------------------

--
-- Table structure for table `o_level_details`
--

CREATE TABLE IF NOT EXISTS `o_level_details` (
  `o_level_id` int(11) NOT NULL AUTO_INCREMENT,
  `applicant_id` int(11) NOT NULL,
  `subject_grade` text NOT NULL,
  `exam_number` varchar(20) NOT NULL,
  `exam_year` varchar(4) NOT NULL,
  `exam_centre` varchar(255) NOT NULL,
  `exam_type_id` int(4) NOT NULL,
  PRIMARY KEY (`o_level_id`),
  KEY `fk_o_level_details_personal_details1_idx` (`applicant_id`),
  KEY `fk_o_level_details_exam_id1_idx` (`exam_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `o_level_details`
--

INSERT INTO `o_level_details` (`o_level_id`, `applicant_id`, `subject_grade`, `exam_number`, `exam_year`, `exam_centre`, `exam_type_id`) VALUES
(1, 73, 'a:14:{s:19:"o_level_1_subject_1";s:2:"17";s:17:"o_level_1_grade_1";s:1:"4";s:19:"o_level_1_subject_2";s:2:"17";s:17:"o_level_1_grade_2";s:1:"2";s:19:"o_level_1_subject_3";s:2:"13";s:17:"o_level_1_grade_3";s:1:"3";s:19:"o_level_1_subject_4";s:1:"6";s:17:"o_level_1_grade_4";s:1:"4";s:19:"o_level_1_subject_5";s:1:"6";s:17:"o_level_1_grade_5";s:1:"2";s:19:"o_level_1_subject_6";s:3:"339";s:17:"o_level_1_grade_6";s:1:"3";s:19:"o_level_1_subject_7";s:3:"290";s:17:"o_level_1_grade_7";s:1:"1";}', '435342543534654', '2013', 'examination center', 1),
(2, 74, 'a:12:{s:19:"o_level_1_subject_1";s:3:"163";s:17:"o_level_1_grade_1";s:1:"1";s:19:"o_level_1_subject_2";s:3:"174";s:17:"o_level_1_grade_2";s:1:"1";s:19:"o_level_1_subject_3";s:3:"173";s:17:"o_level_1_grade_3";s:1:"7";s:19:"o_level_1_subject_4";s:1:"6";s:17:"o_level_1_grade_4";s:1:"4";s:19:"o_level_1_subject_5";s:2:"16";s:17:"o_level_1_grade_5";s:1:"5";s:19:"o_level_1_subject_6";s:2:"15";s:17:"o_level_1_grade_6";s:1:"1";}', '212121212', '2012', '21212212', 1),
(3, 74, 'a:18:{s:19:"o_level_2_subject_1";s:1:"1";s:17:"o_level_2_grade_1";s:1:"3";s:19:"o_level_2_subject_2";s:1:"8";s:17:"o_level_2_grade_2";s:1:"4";s:19:"o_level_2_subject_3";s:1:"3";s:17:"o_level_2_grade_3";s:1:"3";s:19:"o_level_2_subject_4";s:2:"17";s:17:"o_level_2_grade_4";s:1:"2";s:19:"o_level_2_subject_5";s:2:"56";s:17:"o_level_2_grade_5";s:1:"1";s:19:"o_level_2_subject_6";s:2:"95";s:17:"o_level_2_grade_6";s:1:"2";s:19:"o_level_2_subject_7";s:3:"128";s:17:"o_level_2_grade_7";s:1:"4";s:19:"o_level_2_subject_8";s:3:"104";s:17:"o_level_2_grade_8";s:1:"2";s:19:"o_level_2_subject_9";s:3:"207";s:17:"o_level_2_grade_9";s:1:"9";}', '22012012', '2013', '202020202020202020', 5),
(4, 73, 'a:14:{s:19:"o_level_2_subject_1";s:3:"290";s:17:"o_level_2_grade_1";s:1:"1";s:19:"o_level_2_subject_2";s:3:"236";s:17:"o_level_2_grade_2";s:1:"2";s:19:"o_level_2_subject_3";s:3:"123";s:17:"o_level_2_grade_3";s:1:"2";s:19:"o_level_2_subject_4";s:2:"43";s:17:"o_level_2_grade_4";s:1:"3";s:19:"o_level_2_subject_5";s:3:"143";s:17:"o_level_2_grade_5";s:1:"2";s:19:"o_level_2_subject_6";s:3:"151";s:17:"o_level_2_grade_6";s:1:"1";s:19:"o_level_2_subject_7";s:1:"9";s:17:"o_level_2_grade_7";s:1:"2";}', '1234567', '2013', 'University of Jos', 2),
(5, 75, 'a:14:{s:19:"o_level_1_subject_1";s:3:"290";s:17:"o_level_1_grade_1";s:1:"1";s:19:"o_level_1_subject_2";s:2:"43";s:17:"o_level_1_grade_2";s:1:"2";s:19:"o_level_1_subject_3";s:2:"66";s:17:"o_level_1_grade_3";s:1:"2";s:19:"o_level_1_subject_4";s:3:"151";s:17:"o_level_1_grade_4";s:1:"1";s:19:"o_level_1_subject_5";s:3:"236";s:17:"o_level_1_grade_5";s:1:"2";s:19:"o_level_1_subject_6";s:3:"105";s:17:"o_level_1_grade_6";s:1:"2";s:19:"o_level_1_subject_7";s:3:"123";s:17:"o_level_1_grade_7";s:1:"1";}', '01', '2008', '123', 1),
(8, 79, 'a:14:{s:19:"o_level_1_subject_1";s:3:"236";s:17:"o_level_1_grade_1";s:1:"3";s:19:"o_level_1_subject_2";s:3:"123";s:17:"o_level_1_grade_2";s:1:"1";s:19:"o_level_1_subject_3";s:1:"1";s:17:"o_level_1_grade_3";s:1:"5";s:19:"o_level_1_subject_4";s:1:"3";s:17:"o_level_1_grade_4";s:1:"5";s:19:"o_level_1_subject_5";s:1:"5";s:17:"o_level_1_grade_5";s:1:"2";s:19:"o_level_1_subject_6";s:2:"11";s:17:"o_level_1_grade_6";s:1:"1";s:19:"o_level_1_subject_7";s:2:"17";s:17:"o_level_1_grade_7";s:1:"3";}', '123456', '2008', '1234', 1),
(9, 79, 'a:12:{s:19:"o_level_2_subject_1";s:1:"3";s:17:"o_level_2_grade_1";s:1:"1";s:19:"o_level_2_subject_2";s:2:"11";s:17:"o_level_2_grade_2";s:1:"1";s:19:"o_level_2_subject_3";s:2:"14";s:17:"o_level_2_grade_3";s:1:"1";s:19:"o_level_2_subject_4";s:2:"19";s:17:"o_level_2_grade_4";s:1:"5";s:19:"o_level_2_subject_5";s:1:"4";s:17:"o_level_2_grade_5";s:1:"3";s:19:"o_level_2_subject_6";s:2:"12";s:17:"o_level_2_grade_6";s:1:"2";}', '1234567', '1234', '12345', 2),
(10, 117, 'a:12:{s:19:"o_level_1_subject_1";s:3:"105";s:17:"o_level_1_grade_1";s:1:"4";s:19:"o_level_1_subject_2";s:1:"9";s:17:"o_level_1_grade_2";s:1:"4";s:19:"o_level_1_subject_3";s:3:"236";s:17:"o_level_1_grade_3";s:1:"4";s:19:"o_level_1_subject_4";s:3:"140";s:17:"o_level_1_grade_4";s:1:"4";s:19:"o_level_1_subject_5";s:3:"123";s:17:"o_level_1_grade_5";s:1:"4";s:19:"o_level_1_subject_6";s:3:"290";s:17:"o_level_1_grade_6";s:1:"4";}', ' 4123456789', '2008', ' 4123456789121', 1),
(11, 118, 'a:14:{s:19:"o_level_1_subject_1";s:3:"236";s:17:"o_level_1_grade_1";s:1:"1";s:19:"o_level_1_subject_2";s:3:"290";s:17:"o_level_1_grade_2";s:1:"1";s:19:"o_level_1_subject_3";s:3:"123";s:17:"o_level_1_grade_3";s:1:"1";s:19:"o_level_1_subject_4";s:3:"105";s:17:"o_level_1_grade_4";s:1:"1";s:19:"o_level_1_subject_5";s:3:"140";s:17:"o_level_1_grade_5";s:1:"1";s:19:"o_level_1_subject_6";s:2:"66";s:17:"o_level_1_grade_6";s:1:"1";s:19:"o_level_1_subject_7";s:1:"9";s:17:"o_level_1_grade_7";s:1:"1";}', '12342212324', '2007', '323399088239', 1);

-- --------------------------------------------------------

--
-- Table structure for table `personal_details`
--

CREATE TABLE IF NOT EXISTS `personal_details` (
  `applicant_id` int(11) NOT NULL AUTO_INCREMENT,
  `title_id` int(11) DEFAULT NULL,
  `surname` varchar(30) DEFAULT NULL,
  `first_name` varchar(30) DEFAULT NULL,
  `middle_name` varchar(30) DEFAULT NULL,
  `password` varchar(35) DEFAULT NULL,
  `gender` varchar(6) DEFAULT NULL,
  `marital_status` int(11) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `form_id` varchar(15) DEFAULT NULL,
  `address` text,
  `lga_id` int(11) DEFAULT NULL,
  `religion_id` int(4) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `student_status` varchar(4) DEFAULT NULL,
  `academic_prizes` text,
  `country_id` int(11) DEFAULT NULL,
  `admission_id` int(4) DEFAULT NULL,
  `programme_applied_id` int(11) DEFAULT NULL,
  `mail_validation` int(1) DEFAULT '0',
  `progress` varchar(20) NOT NULL,
  `type_of_programme` varchar(2) NOT NULL,
  `date_of_registration` int(11) NOT NULL,
  PRIMARY KEY (`applicant_id`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  UNIQUE KEY `phone_number_UNIQUE` (`phone_number`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=122 ;

--
-- Dumping data for table `personal_details`
--

INSERT INTO `personal_details` (`applicant_id`, `title_id`, `surname`, `first_name`, `middle_name`, `password`, `gender`, `marital_status`, `dob`, `form_id`, `address`, `lga_id`, `religion_id`, `email`, `phone_number`, `student_status`, `academic_prizes`, `country_id`, `admission_id`, `programme_applied_id`, `mail_validation`, `progress`, `type_of_programme`, `date_of_registration`) VALUES
(73, 4, 'Davido', 'Robson', 'Femi', 'daaeb0893724461ac083047b0bbb6160', 'M', 1, '2014-07-08', 'RSA14764615', 'address of applicant', 669, 1, 'femidotexe@gmail.com', '123-4567-8901', 'PGA', 'a:2:{i:1;a:3:{s:5:"prize";s:4:"Best";s:13:"awarding_body";s:17:"University of Jos";s:4:"year";s:4:"2013";}i:2;a:3:{s:5:"prize";s:4:"Best";s:13:"awarding_body";s:17:"University of JOs";s:4:"year";s:4:"2014";}}', 156, 0, 85, 1, 'A', 'FT', 2014),
(74, 1, 'Oguche', 'David', '', 'daaeb0893724461ac083047b0bbb6160', 'M', 1, '2008-04-21', 'PGA1412985274', 'Village House, Jos', 483, 1, 'davideoguch@gmail.com', '090-3230-3313', 'PGA', 'a:1:{i:1;a:3:{s:5:"prize";s:12:"James'' Award";s:13:"awarding_body";s:16:"James Foundation";s:4:"year";s:4:"2003";}}', 156, 0, 243, 1, 'Completed', 'FT', 1906584800),
(75, 1, 'clement', 'Robson', 'fyn', 'fcea920f7412b5da7be0cf42b8c93759', 'M', 1, '2014-07-09', 'PGA1412871475', 'Address of robson', 669, 1, 'fineboyrobson@gmail.com', '080-6314-1109', 'PGA', 'a:2:{i:1;a:3:{s:5:"prize";s:15:"Olympiad winner";s:13:"awarding_body";s:8:"Olympiad";s:4:"year";s:4:"2005";}i:2;a:3:{s:5:"prize";s:23:"Best graduating student";s:13:"awarding_body";s:17:"University of Jos";s:4:"year";s:4:"2012";}}', 156, 0, 193, 1, 'Completed', 'FT', 2014),
(79, 1, 'julson1', 'mangut1', 'monday1', 'daaeb0893724461ac083047b0bbb6160', 'M', 1, '2014-08-01', 'RP1417100979', 'somewherein theworld', 666, 1, 'julsonmangut1@gmail.com', '080-1000-0000', 'RP', 'a:0:{}', 156, 0, 83, 1, 'Completed', 'FT', 0),
(80, 3, 'bola', 'femi', '', 'daaeb0893724461ac083047b0bbb6160', 'F', 2, '2014-08-01', 'DPA1416839180', 'jshdjhsdms,dja,jas.ajas,jsdjsdjd', 371, 1, 'boladoc@gmail.com', '090-0000-0000', 'DPA', 'a:1:{i:1;a:3:{s:5:"prize";s:8:"football";s:13:"awarding_body";s:4:"wase";s:4:"year";s:4:"2014";}}', 156, 0, 439, 1, 'Completed', 'FT', 0),
(81, 1, 'victor', 'james', '', 'daaeb0893724461ac083047b0bbb6160', 'M', 1, '2014-08-06', 'PGA1412599181', 'sfplf''pls''rrpgb l''a;dlf[porpe ', 348, 2, 'victorjames@yahoo.com', '070-0000-0001', 'PGA', 'a:0:{}', 156, 0, 364, 1, 'Completed', 'FT', 0),
(82, 3, 'mercy', 'bumi', '', 'daaeb0893724461ac083047b0bbb6160', 'F', 1, '2014-08-04', 'DPA1416680982', 'jjnsjsjdflsdf sfdjkbdgjsjdbs sjsjhjknsjgds', 87, 1, 'boladoc1@gmail.com', '090-0000-3333', 'DPA', 'a:1:{i:1;a:3:{s:5:"prize";s:4:"BALL";s:13:"awarding_body";s:5:"PRAZE";s:4:"year";s:4:"2015";}}', 156, 0, 439, 1, 'Completed', 'PT', 0),
(83, 1, 'manji2', 'wetle2', '', 'daaeb0893724461ac083047b0bbb6160', 'M', 2, '2014-08-06', 'PGA1412919783', 'oidsfijoieruvi iejoiguoie', 151, 2, 'manji2wetle2@yahoo.com', '070-0000-0002', 'PGA', 'a:0:{}', 156, 0, 375, 1, 'Completed', 'FT', 0),
(84, 2, 'julson2', 'mangut2', 'monday3', 'daaeb0893724461ac083047b0bbb6160', 'F', 2, '2014-07-29', 'RP1417795184', 'ss afghanistan country', 0, 2, 'julsonmangut2@gmail.com', '080-2000-0000', 'RP', 'a:1:{i:1;a:3:{s:5:"prize";s:12:"school prize";s:13:"awarding_body";s:14:"afghan schools";s:4:"year";s:4:"2010";}}', 13, 0, 83, 1, 'Completed', 'PT', 0),
(85, 3, 'julson3', 'mangut3', 'monday3', 'daaeb0893724461ac083047b0bbb6160', 'F', 2, '2014-07-10', 'RP1417224285', 'someplace in afghan', 0, 2, 'julsonmangut3@gmail.com', '080-3000-0000', 'RP', 'a:1:{i:1;a:3:{s:5:"prize";s:5:"nndvc";s:13:"awarding_body";s:13:"afghan senate";s:4:"year";s:4:"2009";}}', 1, 0, 84, 1, 'Completed', 'FT', 0),
(88, 3, 'GRACE', 'MOSES', '', '58c1a60fa43c30f665716a955938eda7', 'F', 2, '2014-03-26', 'DPA1416138288', 'DHHSLDH,SDSDHSHDHKSDDKSSBCB', 45, 1, 'boladoc2@gmail.com', '080-2344-4444', 'DPA', 'a:1:{i:1;a:3:{s:5:"prize";s:13:"FHHFKKKKEHEIE";s:13:"awarding_body";s:16:"HFHFHFHKKHRHRHRH";s:4:"year";s:4:"2030";}}', 156, 0, 451, 1, 'Completed', 'PT', 0),
(92, 1, 'manji3', 'wetle3', '', 'daaeb0893724461ac083047b0bbb6160', 'M', 1, '2014-08-06', 'PGA1412367992', 'jkiseurpounwehfw uieulserkhrg ', 365, 2, 'manji3wetle3@yahoo.com', '070-0000-0003', 'PGA', 'a:0:{}', 156, 0, 356, 1, 'Completed', 'FT', 0),
(96, 1, 'patience', 'taler', '', 'daaeb0893724461ac083047b0bbb6160', 'M', 1, '2014-08-15', 'DPA1416538996', 'hrysgs gfg3hsdghsdgsdhu.l,dvvsdgsdgs', 87, 1, 'boladoc3@gmail.com', '070-2344-4444', 'DPA', 'a:1:{i:1;a:3:{s:5:"prize";s:32:"uuf lurrhfhffkfjf;f;.f.jjfhhfhhm";s:13:"awarding_body";s:38:"hhfffhfffjfkfbfhkfbffffhfh hfbfhjfmfhf";s:4:"year";s:4:"3492";}}', 156, 0, 438, 1, 'Completed', 'PT', 0),
(97, 1, 'manji4', 'wetle4', '', 'daaeb0893724461ac083047b0bbb6160', 'M', 1, '2014-07-31', 'PGA1412401197', 'ijkldjkserjgif fnkajf', 443, 1, 'manji4wetle4@yahoo.com', '090-1234-5678', 'PGA', 'a:0:{}', 156, 0, 362, 1, 'Completed', 'FT', 0),
(100, 1, 'manji5', 'wetle5', '', 'daaeb0893724461ac083047b0bbb6160', 'M', 1, '2014-08-14', 'PGA1412850100', 'juhdoiduwirenwerh euiweukrd', 261, 1, 'manji5wetle5@yahoo.com', '090-8765-4321', 'PGA', 'a:0:{}', 156, 0, 375, 1, 'Completed', 'PT', 0),
(101, 1, 'manji6', 'wetle6', '', 'daaeb0893724461ac083047b0bbb6160', 'F', 2, '2014-07-30', 'PGA1412924101', 'jkhguhegd ujkfeuijtfjrf ', 187, 1, 'manji56wetle6@yahoo.com', '080-1234-5678', 'PGA', 'a:0:{}', 156, 0, 377, 1, 'Completed', 'FT', 0),
(103, 1, 'manji5', 'wetle5', '', 'daaeb0893724461ac083047b0bbb6160', 'M', 1, '2014-07-30', 'PGA1412810103', 'kkluirtoiwk45yetif 4w5reuiktfui5er', 258, 1, 'manji5wetle5@yahoo.co', '080-8765-4321', 'PGA', 'a:0:{}', 156, 0, 354, 1, 'Completed', 'FT', 0),
(105, 2, 'joy', 'joseph', '', 'daaeb0893724461ac083047b0bbb6160', 'F', 1, '2014-07-31', 'PGA1412111105', 'ueurouroqi34t weroiljrferaf', 191, 2, 'joyjoseph1@yahoo.com', '081-2123-3445', 'PGA', 'a:0:{}', 156, 0, 356, 1, 'Completed', 'FT', 0),
(106, 1, 'manji7', 'wetle7', '', 'daaeb0893724461ac083047b0bbb6160', 'M', 1, '2014-08-14', 'PGA1412918106', 'hjsdkhfiuwer faioerlkjtgfera fiolakerg', 286, 1, 'manji7wetle7@yahoo.com', '081-2763-6463', 'PGA', 'a:0:{}', 156, 0, 359, 1, 'Completed', 'FT', 0),
(107, 1, 'manji8', 'wetle8', '', 'daaeb0893724461ac083047b0bbb6160', 'M', 1, '2014-08-07', 'PGA1412131107', 'lkjgsfiolkjs redifolkjsreilt ukwerut', 171, 1, 'manji8wetle8@yahoo.com', '091-2364-5637', 'PGA', 'a:0:{}', 156, 0, 364, 1, 'Completed', 'FT', 0),
(108, 1, 'manji9', 'wetle9', '', 'daaeb0893724461ac083047b0bbb6160', 'M', 2, '2014-08-07', 'PGA1412242108', 'jskldsdfnejasf adushfjka fcujrsdf', 286, 1, 'manji9wetle9@yahoo.com', '091-8466-3737', 'PGA', 'a:0:{}', 156, 0, 360, 1, 'Completed', 'FT', 0),
(113, 1, 'wetle', 'manji', '', 'daaeb0893724461ac083047b0bbb6160', 'M', 2, '2014-08-19', 'RP1417980113', 'hk,;jlkl''pklk  jkjlhfg', 664, 1, 'manjiwetle@yahoo.com', '080-3622-6728', 'RP', 'a:1:{i:1;a:3:{s:5:"prize";s:18:"wryryte qytwerywey";s:13:"awarding_body";s:5:"nipss";s:4:"year";s:4:"2001";}}', 156, 0, 83, 1, 'ABCDEFGHI', 'FT', 1408461803),
(115, 1, 'Oguche', 'Dave', 'DPA', 'daaeb0893724461ac083047b0bbb6160', 'M', 1, '1993-06-01', 'DPA1416862115', 'Somewhere close to you.', 668, 1, 'davideoguche2@gmail.com', '090-3330-3311', 'DPA', 'a:0:{}', 156, 0, 440, 1, 'Completed', 'FT', 1408701535),
(116, 0, 'Ray bans', 'David', '', 'daaeb0893724461ac083047b0bbb6160', '', 0, '0000-00-00', 'PGA1312251116', '', 0, 0, 'david@fakemail.com', '09009009023', 'PGA', '', 0, 0, 354, 1, '', 'FT', 1410257556),
(117, 1, 'Oguche', 'David', '', '5f4dcc3b5aa765d61d8327deb882cf99', 'M', 1, '1992-01-01', 'DPA0916415117', 'Somewhere in Jos,\r\nPlateau State,\r\nNigeria', 317, 1, 'davideoguche7@gmail.com', '09000900912', 'DPA', 'a:0:{}', 156, 0, 78, 1, 'Completed', 'PT', 1418039296),
(118, 2, 'Bello', 'Khadijah', 'Mohammed', '8b39aec3aaa56e9a1cc12630f8e92e40', 'F', 1, '1992-04-16', 'PGA0912777118', 'Rayfield Mai Adiko, Jos, Plateau State', 674, 3, 'khadimohd@ymail.com', '09011211231', 'PGA', 'a:0:{}', 156, 0, 354, 1, 'Completed', 'PT', 1418121451),
(119, 0, 'Oguche', 'David', '', '8b39aec3aaa56e9a1cc12630f8e92e40', '', 0, '0000-00-00', 'PGA0912534119', '', 0, 0, 'davideoguhce@gmail.com', '08088877712', 'PGA', '', 0, 0, 90, 1, 'F', 'FT', 1418288346),
(120, 0, 'Mohammed', 'Ibrahim', 'Ali', '1e9e31662393160e48ee5e1bde0f893f', '', 0, '0000-00-00', '', '', 0, 0, 'ibrahimmara23@gmail.com', '08035985182', '', '', 0, 0, 0, 1, '', '', 1424252192),
(121, 0, 'david', 'david', '', 'daaeb0893724461ac083047b0bbb6160', '', 0, '0000-00-00', '', '', 0, 0, 'davideoguc@gmail.com', '09023211238', '', '', 0, 0, 0, 1, '', '', 1424254772);

-- --------------------------------------------------------

--
-- Table structure for table `photographs`
--

CREATE TABLE IF NOT EXISTS `photographs` (
  `image_id` int(11) NOT NULL AUTO_INCREMENT,
  `applicant_id` int(11) NOT NULL,
  `filename` varchar(30) NOT NULL,
  `type` varchar(50) NOT NULL,
  `size` int(11) NOT NULL,
  `caption` varchar(255) NOT NULL,
  PRIMARY KEY (`image_id`),
  UNIQUE KEY `applicant_id` (`applicant_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `photographs`
--

INSERT INTO `photographs` (`image_id`, `applicant_id`, `filename`, `type`, `size`, `caption`) VALUES
(1, 73, '73.jpg', 'image/jpeg', 61133, 'Davido Robson Femi'),
(2, 74, '74.png', 'image/png', 143780, 'Oguche David '),
(3, 75, '75.jpg', 'image/jpeg', 188870, 'clement Robson fyn'),
(4, 77, '77.jpg', 'image/jpeg', 30686, 'Manji1 Wetle1 '),
(5, 80, '80.jpg', 'image/jpeg', 12878, 'bola femi '),
(6, 79, '79.png', 'image/png', 1095833, 'julson1 mangut1 monday1'),
(7, 81, '81.jpg', 'image/jpeg', 30686, 'victor james '),
(8, 82, '82.jpg', 'image/jpeg', 1931721, 'mercy bumi '),
(9, 83, '83.jpg', 'image/jpeg', 30686, 'manji2 wetle2 '),
(10, 88, '88.jpg', 'image/jpeg', 1680969, 'GRACE MOSES '),
(11, 92, '92.jpg', 'image/jpeg', 30686, 'manji3 wetle3 '),
(12, 96, '96.jpg', 'image/jpeg', 12878, 'patience taler '),
(13, 97, '97.jpg', 'image/jpeg', 30686, 'manji4 wetle4 '),
(14, 84, '84.png', 'image/png', 225987, 'julson2 mangut2 monday3'),
(15, 100, '100.jpg', 'image/jpeg', 30686, 'manji5 wetle5 '),
(16, 85, '85.png', 'image/png', 225987, 'julson3 mangut3 monday3'),
(17, 105, '105.jpg', 'image/jpeg', 30686, 'joy joseph '),
(18, 101, '101.jpg', 'image/jpeg', 30686, 'manji6 wetle6 '),
(19, 103, '103.jpg', 'image/jpeg', 30686, 'manji5 wetle5 '),
(20, 106, '106.jpg', 'image/jpeg', 30686, 'manji7 wetle7 '),
(21, 107, '107.jpg', 'image/jpeg', 30686, 'manji8 wetle8 '),
(22, 108, '108.jpg', 'image/jpeg', 30686, 'manji9 wetle9 '),
(23, 109, '109.jpg', 'image/jpeg', 49985, 'wetle manji joseph'),
(24, 113, '113.jpg', 'image/jpeg', 30552, 'wetle manji '),
(25, 115, '115.png', 'image/png', 105052, 'Oguche Dave DPA'),
(26, 117, '117.png', 'image/png', 143780, 'Oguche David '),
(27, 118, '118.png', 'image/png', 143780, 'Bello Khadijah Mohammed');

-- --------------------------------------------------------

--
-- Table structure for table `programme_type`
--

CREATE TABLE IF NOT EXISTS `programme_type` (
  `p_id` int(3) NOT NULL AUTO_INCREMENT,
  `p_name` varchar(100) NOT NULL,
  `visible` int(1) NOT NULL,
  PRIMARY KEY (`p_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `programme_type`
--

INSERT INTO `programme_type` (`p_id`, `p_name`, `visible`) VALUES
(1, 'Diploma', 1),
(2, 'Institution of Education', 1),
(3, 'Remedial', 1),
(4, 'Part Time', 1);

-- --------------------------------------------------------

--
-- Table structure for table `reasons_inelligibility`
--

CREATE TABLE IF NOT EXISTS `reasons_inelligibility` (
  `reason_id` int(11) NOT NULL AUTO_INCREMENT,
  `reason` text NOT NULL,
  `description` text NOT NULL,
  `reason_status` tinyint(1) NOT NULL,
  PRIMARY KEY (`reason_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `reasons_inelligibility`
--

INSERT INTO `reasons_inelligibility` (`reason_id`, `reason`, `description`, `reason_status`) VALUES
(1, 'Incomplete Transcripts', 'You submitted your application without your complete transcript.', 1),
(2, 'Incomplete Application Docummentation', 'You submitted your application without some crucial documents.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `referees`
--

CREATE TABLE IF NOT EXISTS `referees` (
  `referees_id` int(11) NOT NULL AUTO_INCREMENT,
  `applicant_id` int(11) NOT NULL,
  `referee_title_id` int(11) NOT NULL,
  `referee_name` varchar(90) NOT NULL,
  `referee_email` varchar(100) NOT NULL,
  `referee_phone_number` varchar(15) NOT NULL,
  `referee_form_status` tinyint(1) NOT NULL,
  `referee_job_description` text NOT NULL,
  `referee_address` text NOT NULL,
  `referee_highest_qualification_obtained` varchar(200) NOT NULL,
  `rank_candidate` varchar(20) NOT NULL,
  `questionnaire` text NOT NULL,
  `comments_on_candidate` text NOT NULL,
  `how_long` varchar(50) NOT NULL,
  `what_capacity` varchar(100) NOT NULL,
  PRIMARY KEY (`referees_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=95 ;

--
-- Dumping data for table `referees`
--

INSERT INTO `referees` (`referees_id`, `applicant_id`, `referee_title_id`, `referee_name`, `referee_email`, `referee_phone_number`, `referee_form_status`, `referee_job_description`, `referee_address`, `referee_highest_qualification_obtained`, `rank_candidate`, `questionnaire`, `comments_on_candidate`, `how_long`, `what_capacity`) VALUES
(1, 74, 1, 'Oladeji Oluwafemi', 'femidotexe@gmail.com', '08303934936', 0, '', '', '', '', '', '', '', ''),
(2, 74, 1, 'David Oguche', 'davideoguche@gmail.com', '39309320932', 1, 'asdkljsakldjaskdk', 'kldaskdjakls', 'Bank', '100', 'a:6:{s:21:"intellectual_capactiy";s:1:"6";s:24:"capactiy_for_persistence";s:1:"6";s:23:"ability_for_imagination";s:1:"5";s:33:"promise_of_productive_scholarship";s:1:"6";s:24:"quality_of_previous_work";s:1:"6";s:24:"oral_written_expressions";s:1:"6";}', 'akdskalj;ld', 'asfk;jaskdjakls', 'askljdskalsjdklasjd'),
(3, 74, 1, 'Fineboy', 'fineboyrobson@gmail.com', '09032132112', 0, '', '', '', '', '', '', '', ''),
(4, 75, 1, 'Robson', 'fineboyrobson@gmail.com', '09389829293838', 0, '', '', '', '', '', '', '', ''),
(5, 75, 1, 'David Oguche', 'davideoguche@gmail.com', '38383892389', 1, 'asdkn;askd', 'kdakks', 'bank', '100', 'a:6:{s:21:"intellectual_capactiy";s:1:"6";s:24:"capactiy_for_persistence";s:1:"6";s:23:"ability_for_imagination";s:1:"6";s:33:"promise_of_productive_scholarship";s:1:"6";s:24:"quality_of_previous_work";s:1:"6";s:24:"oral_written_expressions";s:1:"6";}', 'adfknadk', 'asdkasjk', 'asklasnk'),
(6, 75, 1, 'Manji Wetle', 'majiwetle@yahoo.com', '32893283892893', 0, '', '', '', '', '', '', '', ''),
(7, 77, 1, 'owpefjlsf oskdf;sf', 'holiday@yahoo.com', '07034567899', 0, '', '', '', '', '', '', '', ''),
(8, 77, 3, 'jkhakff asfhkagdf', 'bigzoom@yahoo.com', '08021345678', 0, '', '', '', '', '', '', '', ''),
(9, 77, 2, 'jlasdkjfa asdfilkajgjfkl', 'harry@yahoo.com', '08023343423', 0, '', '', '', '', '', '', '', ''),
(10, 81, 3, 'joan', 'joan@yahoo.com', '090334566767', 0, '', '', '', '', '', '', '', ''),
(11, 81, 1, 'john', 'john@yahoo.com', '090345565656', 1, '', '', '', '', '', '', '', ''),
(12, 81, 1, 'iiufijef', 'ksufiafjkl@yahoo.com', '090345464545', 0, '', '', '', '', '', '', '', ''),
(13, 83, 3, 'joan', 'joan@yahoo.com', '0902123343434', 0, '', '', '', '', '', '', '', ''),
(14, 83, 1, 'job', 'job@yahoo.com', '090245565656', 0, '', '', '', '', '', '', '', ''),
(15, 83, 2, 'pee', 'pee@yahoo.com', '09012345678', 0, '', '', '', '', '', '', '', ''),
(16, 92, 1, 'job', 'job@yahoo.com', '09012345678', 0, '', '', '', '', '', '', '', ''),
(17, 92, 2, 'joan', 'joan@yahoo.com', '09012345678', 0, '', '', '', '', '', '', '', ''),
(18, 92, 3, 'jet', 'jet@yahoo.com', '09012345678', 0, '', '', '', '', '', '', '', ''),
(19, 97, 3, 'joan', 'joan@yahoo.com', '09012345678', 0, '', '', '', '', '', '', '', ''),
(20, 97, 1, 'job', 'job@yahoo.com', '09012345678', 0, '', '', '', '', '', '', '', ''),
(21, 97, 2, 'fish', 'fish@yahoo.com', '09012345678', 0, '', '', '', '', '', '', '', ''),
(22, 100, 1, 'john', 'john@yahoo.com', '09012345678', 1, '', '', '', '', '', '', '', ''),
(23, 100, 2, 'joan', 'loan@yahoo.com', '09012345678', 0, '', '', '', '', '', '', '', ''),
(24, 100, 3, 'job', 'job@yahoo.com', '09012345678', 0, '', '', '', '', '', '', '', ''),
(25, 105, 2, 'joy', 'joy@yahoo.com', '09012345678', 0, '', '', '', '', '', '', '', ''),
(26, 105, 1, 'job', 'job@yahoo.com', '09012345678', 0, '', '', '', '', '', '', '', ''),
(27, 105, 3, 'joan', 'joan@yahoo.com', '09012345678', 0, '', '', '', '', '', '', '', ''),
(28, 101, 1, 'job', 'job@yahoo.com', '09012345678', 0, '', '', '', '', '', '', '', ''),
(29, 101, 3, 'joy', 'joy@yahoo.com', '09012345678', 0, '', '', '', '', '', '', '', ''),
(30, 101, 2, 'joan', 'joan@yahoo.com', '09012345678', 0, '', '', '', '', '', '', '', ''),
(31, 103, 1, 'job', 'job@yahoo.com', '09012345678', 0, '', '', '', '', '', '', '', ''),
(32, 103, 2, 'joy', 'joy@yahoo.com', '09012345678', 0, '', '', '', '', '', '', '', ''),
(33, 103, 3, 'joan', 'joan@yahoo.com', '09012345678', 0, '', '', '', '', '', '', '', ''),
(34, 106, 2, 'joy', 'joy@yahoo.com', '09012345678', 0, '', '', '', '', '', '', '', ''),
(35, 106, 1, 'job', 'job@yahoo.com', '09012345678', 0, '', '', '', '', '', '', '', ''),
(36, 106, 3, 'joan', 'joan@yahoo.com', '09012345678', 0, '', '', '', '', '', '', '', ''),
(37, 107, 1, 'job', 'job@yahoo.com', '09012345678', 0, '', '', '', '', '', '', '', ''),
(38, 107, 2, 'joy', 'joy@yahoo.com', '09012345678', 0, '', '', '', '', '', '', '', ''),
(39, 107, 3, 'joan', 'joan@yahoo.com', '09012345678', 0, '', '', '', '', '', '', '', ''),
(40, 108, 1, 'jkhfasjkhf', 'joy@yahoo.com', '09012345678', 0, '', '', '', '', '', '', '', ''),
(41, 108, 2, 'job', 'job@yahoo.com', '09012345678', 0, '', '', '', '', '', '', '', ''),
(42, 108, 3, 'joan', 'joan@yahoo.com', '09012345768', 0, '', '', '', '', '', '', '', ''),
(43, 109, 1, 'clement robson', 'finboyrobson@gmail.com', '09012345678', 0, '', '', '', '', '', '', '', ''),
(44, 109, 1, 'mangut julson', 'julsonmangut@gmail.com', '09087654321', 0, '', '', '', '', '', '', '', ''),
(45, 109, 1, 'oguche davide', 'davideoguche@gmail.com', '09023145678', 1, 'Senior Developer at CI Corp', 'No 7, Ring Road. Pleateau State. Jos', 'Senior Lead Developer', '70', 'a:6:{s:21:"intellectual_capactiy";s:1:"4";s:24:"capactiy_for_persistence";s:1:"3";s:23:"ability_for_imagination";s:1:"5";s:33:"promise_of_productive_scholarship";s:1:"2";s:24:"quality_of_previous_work";s:1:"1";s:24:"oral_written_expressions";s:1:"6";}', 'He is very curious.', '4 Years', 'Co worker'),
(46, 118, 1, 'Oguche David ', 'davideoguche@gmail.com', '09090900012', 0, '', '', '', '', '', '', '', ''),
(47, 118, 1, 'Clement Robson', 'fineboyrobson@gmail.com', '08011122233', 0, '', '', '', '', '', '', '', ''),
(48, 118, 1, 'Emanuel', 'ema@smail.com', '09033322211', 0, '', '', '', '', '', '', '', ''),
(92, 119, 1, 'C L O', 'davideoguche@gmail.com', '08099977700', 0, '', '', '', '', '', '', '', ''),
(93, 119, 4, 'P H P', 'davideoguche@gmail.com', '08099977766', 0, '', '', '', '', '', '', '', ''),
(94, 119, 13, 'J A V A', 'davideoguche@gmail.com', '09088899966', 0, '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `registras`
--

CREATE TABLE IF NOT EXISTS `registras` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(90) NOT NULL,
  `year` varchar(4) NOT NULL,
  `signature_image` varchar(255) NOT NULL,
  `visible` tinyint(1) NOT NULL,
  `cat` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `registras`
--

INSERT INTO `registras` (`id`, `full_name`, `year`, `signature_image`, `visible`, `cat`, `created_at`, `updated_at`) VALUES
(3, 'K.A Gyang (Mrs)', '2011', 'k.a_gyang_(mrs)_signature.jpg', 1, 1, '0000-00-00 00:00:00', '2015-02-06 15:03:42'),
(4, 'James O', '2014', '', 1, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `religion`
--

CREATE TABLE IF NOT EXISTS `religion` (
  `religion_id` int(4) NOT NULL AUTO_INCREMENT,
  `religion_name` varchar(45) NOT NULL,
  PRIMARY KEY (`religion_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `religion`
--

INSERT INTO `religion` (`religion_id`, `religion_name`) VALUES
(1, 'Chrisitianity'),
(2, 'Islam'),
(3, 'Others');

-- --------------------------------------------------------

--
-- Table structure for table `requirements`
--

CREATE TABLE IF NOT EXISTS `requirements` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `p_id` int(3) NOT NULL,
  `name` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `visible` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `requirements`
--

INSERT INTO `requirements` (`id`, `p_id`, `name`, `content`, `visible`) VALUES
(1, 1, 'Diploma for CS', 'Diploma for CS 22', 1),
(2, 2, 'Institute of Education', '<b>UNIVERSITY OF JOS.</b>\r\n\r\n<br><b><span>INSTITUTE OF EDUCATION.<br></span></b><span>\r\n<b></b><br>\r\n</span>\r\n\r\n<b>SALES OF FORMS FOR THE\r\n2014 LONG VACATION-SANDWICH PROGRAMMES<br></b>&nbsp;Applications are\r\ninvited from suitably qualified candidates for the following B.A. (Ed.), B.Sc.\r\n(Ed.) sandwich (5 Long Vacation) Degree Programmes, with specialization in the\r\nfollowing courses:\r\n\r\n<br><b><br>DEGREE PROGRAMMES (5\r\nLong Vacations)</b>\r\n<br>&nbsp;1.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; B.A.(Ed.) Educational\r\nAdministration and Planning\r\n<br>&nbsp;2.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; B.Sc. (Ed.) Economics\r\n<br>&nbsp;3.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; B.A. (Ed.) English\r\n<br>&nbsp;4.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; B.Sc. (Ed.) Geography\r\n<br>&nbsp;5.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; B.A. (Ed.) Guidance\r\n&amp; Counselling\r\n<br>&nbsp;6.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; B.A. (Ed.) History\r\n&amp; International Studies\r\n<br>&nbsp;7.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; B.Sc. (Ed.) Home\r\nEconomics\r\n<br>&nbsp;8.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; B.Sc. (Ed.) Integrated\r\nScience\r\n\r\n&nbsp;', 1),
(5, 4, 'Part-Time Programme', '<b>UNIVERSITY OF JOS.</b>\r\n\r\n<b>PART-TIME PROGRAMMES.</b>\r\n\r\n<span><br>\r\n<br>\r\n</span>\r\n\r\n<b>PART-TIME\r\nPROGRAMMES ENTRY REQUIREMENTS</b>\r\n\r\n<br>Applications are\r\ninvited from suitably qualified candidates for the following B.A. (Ed.), B.Sc.\r\n(Ed.) sandwich (5 Long Vacation) Degree Programmes, with specialization in the\r\nfollowing courses:\r\n\r\n<br><span>1.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\r\nB.A. (Ed.) Administration and Planning</span>\r\n\r\n<br><span>2.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\r\nB.Sc.(Ed.) Economics</span>\r\n\r\n<br><span>3.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\r\nB.A. (Ed.) Guidance &amp; Counselling</span>\r\n\r\n<br><span>4.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\r\nB.A. (Ed.) English</span>\r\n\r\n<br><span>5.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\r\nB.Sc.(Ed.) Geography</span>\r\n\r\n<br><span>6.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\r\nB.A. (Ed.) History</span>\r\n\r\n<br><span>7.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\r\nB.Sc.(Ed.) Integrated Science</span>\r\n\r\n<br><span>8.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\r\nB.A. (Ed.) Language Arts</span>\r\n\r\n<br><span>9.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\r\nB.Sc.(Ed.) Mathematics</span>\r\n\r\n<br><span>10.&nbsp;&nbsp;&nbsp;\r\nB.A. (Ed.) Religious Studies</span>\r\n\r\n<br><span>11.&nbsp;&nbsp;&nbsp;\r\nB.(Ed.) Social Studies</span>\r\n\r\n<br><span>12.&nbsp;&nbsp;&nbsp;\r\nB.Sc Special Education</span>\r\n\r\n<br><span>13.&nbsp;&nbsp;&nbsp;\r\nB.(Ed.) Primary Education</span>\r\n\r\n<br><span>14.&nbsp;&nbsp;&nbsp;\r\nB.Sc (Ed.) Home Economics</span>\r\n\r\n<br><span>15.&nbsp;&nbsp;&nbsp;\r\nB.Sc Economics</span>\r\n\r\n<br><span>16.&nbsp;&nbsp;&nbsp;\r\nB.Sc Public Administration</span>\r\n\r\n<br><span>17.&nbsp;&nbsp;&nbsp;\r\nB.Sc Social Work</span>\r\n\r\n<br><span>18.&nbsp;&nbsp;&nbsp;\r\nB.Sc Accounting</span>\r\n\r\n<br><span>19.&nbsp;&nbsp;&nbsp;\r\nB.Sc Business Administration</span>\r\n\r\n<br><b><u><br>ADMISSION\r\nREQUIREMENTS</u></b>\r\n\r\n<br><span><b>1.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </b><b>Admission requirements\r\nfor B.A. (Ed.) Administration and Planning:</b></span>&nbsp; &nbsp;&nbsp;<br><ul><li>Candidates should pass\r\nrelevant subjects at credit or merit levels at NCE or its equivalent and must\r\nhave at least five credits in O''&nbsp;level to include English language and in area of teaching\r\nsubjects.</li></ul><span><b>2.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </b><b>Admission requirements\r\nfor B.Sc.(Ed.) Economics</b></span>\r\n&nbsp;<br><ul><li>Candidate should have\r\na minimum of merit at NCE, Diploma or IJMB with five credits to include\r\nEnglish, Mathematics &amp; Economics at O''&nbsp;level (Grade II TC,\r\nGCE O/L, SSCE)&nbsp;</li></ul><b>3.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </b><b>Admission requirements\r\nfor B.A. (Ed.) Guidance &amp; Counselling</b>&nbsp;<br><ul><li>Candidates should pass\r\nrelevant subjects at credit or merit levels at NCE or its equivalent and must\r\nhave at least five credits in O'' level to include English language and in area of teaching subject.\r\n\r\n</li></ul><b>4.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </b><b>Admission requirements\r\nfor B.A. (Ed) English</b>&nbsp; &nbsp;<br><ul><li>Candidates should pass\r\nrelevant subjects at credit or merit levels at NCE or its equivalent like two\r\nrelevant passes at Advanced level (English inclusive) and five O'' level credits to\r\ninclude English language, Literature and a pass in mathematics.&nbsp;</li></ul><b>5.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </b><b>Admission requirements\r\nfor B.Sc (Ed) Geographys</b>&nbsp; <br><ul><li>Candidates should pass\r\nrelevant subjects at credit or merit levels at NCE or have its equivalent like\r\ntwo relevant passes at Advanced level and five O'' level credits which\r\nmust include Mathematics, Geography and English.\r\n\r\n</li></ul><b>6.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </b><b>Admission requirements\r\nfor B.A.(Ed.) History</b>&nbsp;<br><ul><li>Candidates should have\r\nat least merit pass in relevant subjects at NCE or its equivalent and five O'' level credits to\r\ninclude English, History or Government.\r\n\r\n</li></ul><b>7.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </b><b>Admission requirements\r\nfor B.Sc.(Ed.) Intergrated Science</b>&nbsp;<br><ul><li>Candidates should pass\r\nrelevant subjects at credit or merit levels at NCE or have its equivalent like\r\ntwo relevant passes at Advanced level and five O'' level credits which\r\nmust include English, Mathematics, Physics and Chemistry or Biology.\r\n\r\n</li></ul><b>8.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </b><b>Admission requirements\r\nfor B.A.(Ed.) Language Arts</b>&nbsp; <br><ul><li>Candidates should pass\r\nrelevant subjects at credit or merit levels at NCE or have its equivalent like\r\ntwo relevant passes at Advanced level (English inclusive) and five O'' level Arts subjects\r\nto include English language, Literature and pass in Mathematics.\r\n\r\n</li></ul><b>9.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </b><b>Admission requirements\r\nfor B.Sc. Mathematics</b>&nbsp;<br><ul><li>Candidates should pass\r\nrelevant subjects at credit or merit levels at NCE or have its equivalent like\r\ntwo relevant passes at Advanced level and five O'' level subject to\r\ninclude English, mathematics, Physics, Chemistry or Biology.\r\n\r\n</li></ul><b>10.&nbsp;&nbsp;&nbsp; </b><b>Admission requirements\r\nfor B.A.(Ed.) Religious Studies</b>&nbsp;<br><ul><li>Candidates should pass\r\nrelevant subjects at credit or merit levels at NCE or have its equivalent at\r\nAdvanced level (Religion inclusive) and five O'' level relevant\r\nsubjects (Grade II, GCE or SSCE) to include English, CRK or IRK and a pass in\r\nMathematics.\r\n\r\n</li></ul><b>11.&nbsp;&nbsp;&nbsp; </b><b>Admission requirements\r\nfor B.Ed. Social Studies</b>&nbsp;<br><ul><li>A minimum of merit\r\npass at NCE, Diploma or IJMB is required and must have a total of five credits\r\nat O'' level to include English, History and Mathematics.\r\n\r\n</li></ul><b>12.&nbsp;&nbsp;&nbsp; </b><b>Admission requirements\r\nfor B.Sc. Special Education</b>&nbsp;<br><ul><li>Candidates Should pass\r\nrelevant subjects at credit or merit levels at NCE or its equivalent and must\r\nhave at least five credits in O'' level to include English language and in area of teaching\r\nsubjects.\r\n\r\n</li></ul><b>13.&nbsp;&nbsp;&nbsp; </b><b>Admission requirements\r\nfor B.Ed Primary Education<br></b><ul><li>Candidates should pass\r\nrelevant subjects at credit or merit levels at NCE or its equivalent and must\r\nhave at least five credits in O'' level to include English language and area of teaching\r\nsubjects.\r\n\r\n</li></ul><b>14.&nbsp;&nbsp;&nbsp; </b><b>Admission requirements\r\nfor B.Sc.(Ed.) Home Economics</b>&nbsp;<br><ul><li>Candidates should have\r\na minimum of merit at NCE, Diploma or IJMB with five credits to include\r\nEnglish, Mathematics and either Economics, Health Science or Biology at O'' level (Grade II TC,\r\nGCE O/L, SSCE).\r\n\r\n</li></ul><b>15.&nbsp;&nbsp;&nbsp; </b><b>Admission requirements\r\nfor B.Sc. Economics</b>&nbsp;<br><ul><li>Candidates should have\r\na minimum of merit at NCE, Diploma or IJMB with five credits to include\r\nEnglish, Mathematics &amp; Economics at O'' level (Grade II TC,\r\nGCE O/L, SSCE).\r\n\r\n</li></ul><b>16.&nbsp;&nbsp;&nbsp; </b><b>Admission requirements\r\nfor B.Sc Public Administration</b>&nbsp;<br><ul><li>A minimum of lower\r\ncredit at Diploma, IJMB or its equivalent in relevant fields is required and\r\nmust have five credits at O'' level, which must include Mathematics, English, Economics or\r\nFinancial Accounting.\r\n\r\n</li></ul><b>17.&nbsp;&nbsp;&nbsp; </b><b>Admission requirements\r\nfor B.Sc.(Ed.) Economics</b>&nbsp;<br><ul><li>Candidates should pass\r\nrelevant subjects at credit or merit levels at NCE or its equivalent and must\r\nhave at least five credits in O'' level to include English language and in area of teaching\r\nsubjects.\r\n\r\n</li></ul><b>18.&nbsp;&nbsp;&nbsp; </b><b>Admission requirements\r\nfor B.Sc. Social Work</b>&nbsp; &nbsp;<br><ul><li>A minimum of lower credit\r\nat Diploma, IJMB or its equivalent in relevant fields is required and must have\r\nfive credits at O'' level, which must include Mathematics , English, Economics or\r\nFinancial Accounting.\r\n\r\n</li></ul><b>19.&nbsp;&nbsp;&nbsp; </b><b>Admission requirements\r\nfor B.Sc. Accounting</b>&nbsp; <br><ul><li>A minimum of lower\r\ncredit at Diploma, IJMB or its equivalent is required and must have five\r\ncredits at O'' level, which must include, Mathematics, English, Economics or\r\nFinancial Accounting.\r\n\r\n</li></ul><b>20.&nbsp;&nbsp;&nbsp; </b><b>Admission requirements\r\nfor B.Sc. Business Administration</b>&nbsp; &nbsp; <br><ul><li>A minimum of lower\r\ncredit at Diploma, IJMB or its equivalent is required and must have five\r\ncredits at O'' level,</li></ul>&nbsp; <br><b>METHODS OF\r\nAPPLICATION</b>\r\n<br><br>Interested applicants\r\nare to visit the University website&nbsp;<a href="http://www.unijos.edu.ng/" target="_blank" rel="">www.unijos.edu.ng</a>&nbsp;and follow the link to\r\nobtain application forms at the cost of five thousand naira (N5,000.00) only\r\n<br><br>All properly filled\r\napplication forms with attachments of photocopies of credentials are to be\r\nsubmitted to:\r\n<br>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;Deputy Registrar,<br>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;Non NUC Funded Programmes,<br>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;Academic Office<br>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;University of Jos.<br>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;Bauchi Road Campus<br>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;P.M.B. 2084, Jos.<br>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;Plateau State, <br>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;Nigeria.<br><span><br>Non NUC Funded Programmes,<br>\r\nAcademic Office<br>\r\nUniversity of Jos.<br>\r\nBauchi Road Campus<br>\r\nP.M.B. 2084, Jos.<br>\r\nPlateau State, Nigeria.</span>\r\n\r\n<span>Secretary<br>\r\n<i>Institute of Education</i></span>\r\n\r\n&nbsp;', 1);

-- --------------------------------------------------------

--
-- Table structure for table `secondary_school_attended`
--

CREATE TABLE IF NOT EXISTS `secondary_school_attended` (
  `school_id` int(11) NOT NULL AUTO_INCREMENT,
  `applicant_id` int(11) NOT NULL,
  `school_name` varchar(255) NOT NULL,
  `school_address` text NOT NULL,
  `from_year` varchar(4) NOT NULL,
  `to_year` varchar(4) NOT NULL,
  PRIMARY KEY (`school_id`),
  KEY `fk_secondary_school_attended_personal_details1_idx` (`applicant_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `secondary_school_attended`
--

INSERT INTO `secondary_school_attended` (`school_id`, `applicant_id`, `school_name`, `school_address`, `from_year`, `to_year`) VALUES
(1, 73, 'school name', 'address', '2010', '2012'),
(2, 74, 'High', 'Plateau State', '1995', '2001'),
(3, 75, 'Unijos Secondary School', 'University of Jos staff school', '2000', '2006'),
(4, 75, 'Another Secondary School', 'another school along another road', '2006', '2007'),
(5, 77, 'st.bjsadkofkwpelf', 'fkapotkfpok opwe;kfkergf''kagfl`', '2033', '2012'),
(6, 80, 'atbu', 'bauchi', '2013', '2015'),
(7, 79, 'jos high school', 'jos south', '2000', '2006'),
(8, 79, 'plateau private', 'jos north', '2007', '2008'),
(9, 81, 'st biousiljdflkj', 'ksjflKLFC KLEFKLKSMFG', '2011', '2011'),
(10, 82, 'abu4038', 'zaira', '3030', '3040'),
(11, 83, 'st.ben', 'l;afkasjfksf sadjtkfa;', '2011', '2011'),
(12, 88, 'MERCYGRACE', 'BENNI CITY', '2013', '2014'),
(13, 92, 'st.bejfligk;ldf', 'm;dfgl ljoigk ', '2011', '2011'),
(14, 96, 'nfjkkdfhhdfk.d', 'fdhfdhfhdhfhhgkkmkvkvh', '7392', '4774'),
(15, 97, 'st. bmkljikdfks', 'kljsgjflkjsidf siolfiskjglf', '2011', '2011'),
(16, 84, 'an afghan schoo;', 'in the afghanistan', '2005', '2010'),
(17, 100, 'st.bejilklksfklsd', 'kldafijksgfjia', '2011', '2011'),
(18, 85, 'afghan school', 'in afgnan state', '2003', '2009'),
(19, 105, 'st. kklag;dflklaerg ', 'opero;gk;vopk5ergipser9t woeridjflkergdf', '2011', '2011'),
(20, 101, 'iqeur;tofjmkiowjer', 'ifuoirjtg', '2011', '2011'),
(21, 103, 'ljafigljsfd', 'ijsejtiferi', '2011', '2011'),
(22, 106, 'joierfj', 'iojeiorjtijire', '2011', '2011'),
(23, 107, 'klsjdljgiklsdg', 'iosrtlidjgilkjfdhg', '2011', '2011'),
(24, 108, 'fdghjlj;kn;k', 'jkjsfklmseklgkl', '2011', '2011'),
(25, 109, 'st. benedict', 'pankshin', '2003', '2009'),
(26, 113, 'futo', 'kjvkhkjfg czdjdgvmsdfg', '2009', '2011'),
(27, 113, 'st ben', 'pankshin', '2011', '2014'),
(28, 115, 'Cocin', 'State Lowcost', '2003', '2009'),
(29, 117, 'Rantya High School', 'Rantya State Lowcost, Jos, Plateau State, Nigeria', '2002', '2008'),
(30, 118, 'Bethel High School', 'Rayfield Mai Adiko, Jos, Plateau State,', '2001', '2007');

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE IF NOT EXISTS `state` (
  `state_id` int(6) NOT NULL,
  `state_name` varchar(20) NOT NULL,
  PRIMARY KEY (`state_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`state_id`, `state_name`) VALUES
(1, 'Abia'),
(2, 'Adamawa'),
(3, 'Akwa Ibom'),
(4, 'Anambra'),
(5, 'Bauchi'),
(6, 'Bayelsa'),
(7, 'Benue'),
(8, 'Borno'),
(9, 'Cross River'),
(10, 'Delta'),
(11, 'Ebonyi'),
(12, 'Edo'),
(13, 'Ekiti'),
(14, 'Enugu'),
(15, 'Gombe'),
(16, 'Imo'),
(17, 'Jigawa'),
(18, 'Kaduna'),
(19, 'Kano'),
(20, 'Katsina'),
(21, 'Kebbi'),
(22, 'Kogi'),
(23, 'Kwara'),
(24, 'Lagos'),
(25, 'Nasarawa'),
(26, 'Niger'),
(27, 'Ogun'),
(28, 'Ondo'),
(29, 'Osun'),
(30, 'Oyo'),
(31, 'Plateau'),
(32, 'Rivers'),
(33, 'Sokoto'),
(34, 'Taraba'),
(35, 'Yobe'),
(36, 'Zamfara'),
(37, 'FCT'),
(38, 'Foreign');

-- --------------------------------------------------------

--
-- Table structure for table `themes`
--

CREATE TABLE IF NOT EXISTS `themes` (
  `theme_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `institution_name` varchar(200) DEFAULT NULL,
  `institution_caption` varchar(200) DEFAULT NULL,
  `institution_text_color` varchar(10) DEFAULT NULL,
  `institution_caption_text_color` varchar(10) DEFAULT NULL,
  `header_bg_color` varchar(10) DEFAULT NULL,
  `logo_name` varchar(200) DEFAULT NULL,
  `logo_size` int(11) DEFAULT NULL,
  `logo_caption` varchar(20) DEFAULT NULL,
  `site_url` varchar(200) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `visible` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`theme_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `themes`
--

INSERT INTO `themes` (`theme_id`, `institution_name`, `institution_caption`, `institution_text_color`, `institution_caption_text_color`, `header_bg_color`, `logo_name`, `logo_size`, `logo_caption`, `site_url`, `status`, `visible`, `created_at`, `updated_at`) VALUES
(2, 'University of Jos', 'Network Information System', '#FFFFFF', '#FFFFFF', '#069', 'University.of.Jos.png', 0, 'University of Jos', 'mis.unijos.edu.ng/app_form_template', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'University of California', 'Application Portal', '#EFEFEF', '#9C9C94', '#E79439', 'University.of.California.jpg', 0, 'University of Califo', 'mis.unijos.edu.ng/app_form_template', 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `thesis_details`
--

CREATE TABLE IF NOT EXISTS `thesis_details` (
  `thesis_id` int(11) NOT NULL AUTO_INCREMENT,
  `applicant_id` int(11) NOT NULL,
  `comment_on_field` text NOT NULL,
  `thesis_topic` varchar(255) NOT NULL,
  `proposal_on_thesis` text NOT NULL,
  `thesis_attachment` varchar(50) NOT NULL,
  PRIMARY KEY (`thesis_id`),
  UNIQUE KEY `applicant_id` (`applicant_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `thesis_details`
--

INSERT INTO `thesis_details` (`thesis_id`, `applicant_id`, `comment_on_field`, `thesis_topic`, `proposal_on_thesis`, `thesis_attachment`) VALUES
(1, 74, 'ICT Stuff', 'Dummy text', 'My Thesis proposal.<br>', ''),
(2, 75, 'robotics and artificial intelligence', 'I-ROBOTS in Nigeria', '', ''),
(3, 118, 'Robotics&nbsp;Robotics&nbsp;Robotics&nbsp;Robotics&nbsp;Robotics&nbsp;Robotics&nbsp;Robotics&nbsp;Robotics&nbsp;Robotics&nbsp;Robotics&nbsp;Robotics&nbsp;Robotics&nbsp;Robotics&nbsp;Robotics&nbsp;Robotics&nbsp;Robotics&nbsp;Robotics&nbsp;Robotics&nbsp;Robotics&nbsp;Robotics&nbsp;Robotics&nbsp;Robotics&nbsp;Robotics&nbsp;Robotics&nbsp;Robotics&nbsp;Robotics&nbsp;Robotics&nbsp;Robotics&nbsp;Robotics&nbsp;Robotics&nbsp;Robotics&nbsp;Robotics&nbsp;Robotics&nbsp;Robotics&nbsp;Robotics&nbsp;RoboticsRobotics&nbsp;Robotics&nbsp;Robotics&nbsp;Robotics&nbsp;Robotics&nbsp;Robotics&nbsp;Robotics&nbsp;Robotics&nbsp;Robotics&nbsp;Robotics&nbsp;Robotics&nbsp;Robotics', 'Robotics', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `title`
--

CREATE TABLE IF NOT EXISTS `title` (
  `title_id` int(11) NOT NULL AUTO_INCREMENT,
  `title_name` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`title_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `title`
--

INSERT INTO `title` (`title_id`, `title_name`) VALUES
(1, 'Mr'),
(2, 'Ms'),
(3, 'Mrs'),
(4, 'Dr'),
(5, 'Prof'),
(6, 'Engr'),
(7, 'Arch'),
(8, 'Mallam'),
(9, 'Alh'),
(10, 'Rev'),
(11, 'Bishop'),
(12, 'Arch Bishop'),
(13, 'SAN'),
(14, 'Barr');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `lga`
--
ALTER TABLE `lga`
  ADD CONSTRAINT `lga_ibfk_1` FOREIGN KEY (`state_id`) REFERENCES `state` (`state_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
