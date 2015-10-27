-- phpMyAdmin SQL Dump
-- version 3.3.9.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 06, 2014 at 09:53 AM
-- Server version: 5.5.9
-- PHP Version: 5.3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mis_admission`
--

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `faculty_id` int(11) NOT NULL AUTO_INCREMENT,
  `faculty_name` varchar(50) NOT NULL DEFAULT '',
  `faculty_code` char(3) NOT NULL DEFAULT '',
  `status` int(2) NOT NULL,
  PRIMARY KEY (`faculty_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` VALUES(1, 'Arts', 'AR', 0);
INSERT INTO `faculty` VALUES(2, 'Education', 'ED', 0);
INSERT INTO `faculty` VALUES(3, 'Environmental Sciences', 'EV', 0);
INSERT INTO `faculty` VALUES(4, 'Law', 'LW', 0);
INSERT INTO `faculty` VALUES(5, 'Medical Sciences', 'MD', 0);
INSERT INTO `faculty` VALUES(6, 'Natural Sciences', 'NS', 0);
INSERT INTO `faculty` VALUES(7, 'Pharmaceutical Sciences', 'PH', 0);
INSERT INTO `faculty` VALUES(8, 'Social Sciences', 'SS', 0);
INSERT INTO `faculty` VALUES(9, 'General Studies', 'GS', 0);
INSERT INTO `faculty` VALUES(10, 'Center for Continuing Education', 'CCE', 0);
INSERT INTO `faculty` VALUES(11, 'Institute of Education', 'IOE', 0);
INSERT INTO `faculty` VALUES(12, 'Post-Graduate Programmes', 'PG', 1);
INSERT INTO `faculty` VALUES(13, 'POST UTME', 'PU', 0);
INSERT INTO `faculty` VALUES(14, 'DE SCREENING', 'DE', 0);
INSERT INTO `faculty` VALUES(15, 'Part-Time Undergraduate', 'PT', 1);
INSERT INTO `faculty` VALUES(16, 'Diploma Programmes', 'DP', 1);
INSERT INTO `faculty` VALUES(17, 'Remedial Programmes', 'RP', 1);
INSERT INTO `faculty` VALUES(18, 'Engineering', 'ENG', 0);
INSERT INTO `faculty` VALUES(19, 'Agriculture', 'AG', 0);
INSERT INTO `faculty` VALUES(20, 'Corper', 'COR', 0);
