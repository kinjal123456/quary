-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 16, 2018 at 11:12 AM
-- Server version: 5.7.9
-- PHP Version: 5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quary`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adminname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `modificationdate` datetime DEFAULT NULL,
  `creationdate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `adminname`, `username`, `password`, `email`, `modificationdate`, `creationdate`) VALUES
(1, 'Jayesh Pramodrai Desai', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'kinjalthaker51@gmail.com', '2018-05-01 11:37:55', '2018-05-01 11:37:58');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE IF NOT EXISTS `customers` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uploadid` int(11) DEFAULT '0',
  `zoneid` int(11) DEFAULT NULL,
  `companyname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` int(11) NOT NULL,
  `licenceno` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `survey_no` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `pincode` int(11) DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `uploadid`, `zoneid`, `companyname`, `firstname`, `lastname`, `phone`, `licenceno`, `email`, `password`, `survey_no`, `address`, `pincode`, `state`, `created_at`, `updated_at`) VALUES
(2, 1, 2, '', 'Mansi', 'thaker', 65, 'rtgre', 'm@gmail.com', 'kinjal', '', 'Tithal road', 396001, 'Gujarat', '2018-06-10 12:30:14', '2018-06-11 12:03:14'),
(24, 9, 1, NULL, 'vrunda', 'd', 543535, 'LIC3', 'k3@gmail.com', NULL, NULL, NULL, NULL, NULL, '2018-06-16 05:40:41', '2018-06-16 05:40:41'),
(22, 9, 1, 'dsfds', 'kinjal', 'thaker', 435435, 'LIC1', 'k1@gmail.com', 'kinjal', '43534', '7 shroff building, azad chowck', 396001, 'GUJARAT', '2018-06-16 05:40:41', '2018-06-16 05:42:36'),
(23, 9, 2, NULL, 'mansi', 't', 54353, 'LIC2', 'k2@gmail.com', NULL, NULL, NULL, NULL, NULL, '2018-06-16 05:40:41', '2018-06-16 05:40:41');

-- --------------------------------------------------------

--
-- Table structure for table `customers_bills`
--

DROP TABLE IF EXISTS `customers_bills`;
CREATE TABLE IF NOT EXISTS `customers_bills` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customerid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `billname` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billno` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bill_amount` decimal(10,2) DEFAULT NULL,
  `payment_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1=paument due, 2=paid',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers_bills`
--

INSERT INTO `customers_bills` (`id`, `customerid`, `userid`, `billname`, `billno`, `bill_amount`, `payment_status`, `created_at`, `updated_at`) VALUES
(5, 22, 1, 'kinjal chetankumar thaker', 'm6xvr', '45.00', 1, '2017-06-16 11:13:18', '2018-06-16 12:52:35'),
(3, 2, 1, 'Bill1', 'n8fa0', '100.00', 1, '2018-06-16 11:09:00', '2018-06-16 11:13:33'),
(6, 22, 2, 'dgfdg', 'm56o6', '45.00', 1, '2017-06-16 11:13:18', '2018-06-16 11:13:48');

-- --------------------------------------------------------

--
-- Table structure for table `customerupload`
--

DROP TABLE IF EXISTS `customerupload`;
CREATE TABLE IF NOT EXISTS `customerupload` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customerupload`
--

INSERT INTO `customerupload` (`id`, `filename`, `created_at`, `updated_at`) VALUES
(1, '0_15880500_1528633809.xlsx', '2018-06-10 18:00:09', '2018-06-10 18:00:09'),
(9, '0_47214900_1529127636.xlsx', '2018-06-16 11:10:36', '2018-06-16 11:10:36');

-- --------------------------------------------------------

--
-- Table structure for table `customer_additional_info`
--

DROP TABLE IF EXISTS `customer_additional_info`;
CREATE TABLE IF NOT EXISTS `customer_additional_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customerid` int(11) DEFAULT NULL,
  `detailname` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emailid` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `startdate` datetime DEFAULT NULL,
  `enddate` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_additional_info`
--

INSERT INTO `customer_additional_info` (`id`, `customerid`, `detailname`, `emailid`, `password`, `startdate`, `enddate`, `created_at`, `updated_at`) VALUES
(1, 2, 'Employee RNA detail', 'kinjalthaker51@gmail.com', 'gdfgdf', NULL, NULL, '2018-06-11 17:33:42', '2018-06-11 17:33:42'),
(2, 2, 'Shram Shuvidha LIN detail', 'kinjalthaker51@gmail.com', 'dfg', NULL, NULL, '2018-06-11 17:33:42', '2018-06-11 17:33:42'),
(3, 3, 'Employee RNA detail', 'kinjalthaker51@gmail.com', 'kinjal', NULL, NULL, '2018-06-12 11:57:37', '2018-06-12 11:57:37'),
(4, 3, 'Shram Shuvidha LIN detail', 'mansi@gmail.com', 'mansi', NULL, NULL, '2018-06-12 11:57:37', '2018-06-12 11:57:37');

-- --------------------------------------------------------

--
-- Table structure for table `customer_employees`
--

DROP TABLE IF EXISTS `customer_employees`;
CREATE TABLE IF NOT EXISTS `customer_employees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customerid` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `designation` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile_no` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `customer_employees`
--

INSERT INTO `customer_employees` (`id`, `customerid`, `name`, `designation`, `mobile_no`, `created_at`, `updated_at`) VALUES
(8, 22, 'kinjal', 'developer', 2147483647, '2018-06-16 11:12:36', '2018-06-16 11:12:36'),
(4, 2, 'kinjal', 'developer', 2147483647, '2018-06-11 12:39:08', '2018-06-11 12:39:08'),
(5, 2, 'Mansi', 'developer', 2147483647, '2018-06-11 12:39:08', '2018-06-11 12:39:08'),
(6, 16, 'kinjal', 'developer', 2147483647, '2018-06-16 11:03:20', '2018-06-16 11:03:20'),
(7, 16, 'Mansi', 'developer', 2147483647, '2018-06-16 11:03:20', '2018-06-16 11:03:20'),
(9, 22, 'Mansi', 'developer', 2147483647, '2018-06-16 11:12:36', '2018-06-16 11:12:36');

-- --------------------------------------------------------

--
-- Table structure for table `customer_explosive_capacity`
--

DROP TABLE IF EXISTS `customer_explosive_capacity`;
CREATE TABLE IF NOT EXISTS `customer_explosive_capacity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customerid` int(11) NOT NULL,
  `srno` int(11) NOT NULL DEFAULT '0',
  `explosive_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `class` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `division` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `qty_at_time` int(11) DEFAULT NULL,
  `unit` int(11) DEFAULT NULL,
  `no_of_time` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `customer_explosive_capacity`
--

INSERT INTO `customer_explosive_capacity` (`id`, `customerid`, `srno`, `explosive_name`, `class`, `division`, `qty_at_time`, `unit`, `no_of_time`, `created_at`, `updated_at`) VALUES
(2, 2, 1, '1', 'valsad', 'valsad', 1, 1, 6, '2018-06-11 18:23:04', '2018-06-11 18:23:04'),
(3, 3, 1, 'dg', 'dgf', 'fdg', 1, 1, 1, '2018-06-12 11:57:37', '2018-06-12 11:57:37');

-- --------------------------------------------------------

--
-- Table structure for table `customer_licence_info`
--

DROP TABLE IF EXISTS `customer_licence_info`;
CREATE TABLE IF NOT EXISTS `customer_licence_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customerid` int(11) DEFAULT NULL,
  `detail_type` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '1) Exposive licence occupier detail 2) Short fire permit detail',
  `document_key` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `licence_no` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `issue_date` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `expiry_date` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `customer_licence_info`
--

INSERT INTO `customer_licence_info` (`id`, `customerid`, `detail_type`, `document_key`, `licence_no`, `name`, `issue_date`, `expiry_date`, `created_at`, `updated_at`) VALUES
(1, 2, '1', 'gdfg', 'dg', 'dfd', '06/21/2018', '06/20/2018', '2018-06-11 17:33:42', '2018-06-11 18:23:04'),
(2, 3, '1', 'sf', 'sdf', 'sdf', '06/19/2018', '06/18/2018', '2018-06-12 11:57:37', '2018-06-12 11:57:37');

-- --------------------------------------------------------

--
-- Table structure for table `customer_register_form_a_type_a`
--

DROP TABLE IF EXISTS `customer_register_form_a_type_a`;
CREATE TABLE IF NOT EXISTS `customer_register_form_a_type_a` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customerid` int(11) DEFAULT NULL,
  `srno` int(11) DEFAULT NULL,
  `emp_code` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `firstname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` tinyint(1) DEFAULT NULL COMMENT '1=men,2=women,3=other',
  `secondname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dob` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nationality` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `education` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `doj` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `designation` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `category_address` text COLLATE utf8_unicode_ci COMMENT '1=HS,2=S,3=SS,4=US',
  `emp_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile` int(10) DEFAULT NULL,
  `uan` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pan` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `esic_ip` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lwf` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `aadhaar_no` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bank_ac_no` int(20) DEFAULT NULL,
  `bank` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `branch_ifsc_code` int(20) DEFAULT NULL,
  `present_address` text COLLATE utf8_unicode_ci,
  `permenent_address` text COLLATE utf8_unicode_ci,
  `service_book_no` int(11) DEFAULT NULL,
  `date_of_exit` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reason_for_exit` text COLLATE utf8_unicode_ci,
  `id_mark` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `signature_thumb_image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remark` text COLLATE utf8_unicode_ci,
  `created_by` datetime DEFAULT NULL,
  `updated_by` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `customer_register_form_a_type_a`
--

INSERT INTO `customer_register_form_a_type_a` (`id`, `customerid`, `srno`, `emp_code`, `firstname`, `lastname`, `gender`, `secondname`, `dob`, `nationality`, `education`, `doj`, `designation`, `category_address`, `emp_type`, `mobile`, `uan`, `pan`, `esic_ip`, `lwf`, `aadhaar_no`, `bank_ac_no`, `bank`, `branch_ifsc_code`, `present_address`, `permenent_address`, `service_book_no`, `date_of_exit`, `reason_for_exit`, `id_mark`, `photo`, `signature_thumb_image`, `remark`, `created_by`, `updated_by`) VALUES
(1, 3, 1, '', '', '', 0, '', '', 'Indian', '', '', '', '0', '', 0, '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', NULL, NULL, '', '2018-06-15 11:47:19', '2018-06-15 11:47:19'),
(2, 2, 1, '', '', '', 0, '', '', 'Indian', '', '', '', '0', '', 0, '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', NULL, NULL, '', '2018-06-16 12:40:23', '2018-06-16 12:40:23');

-- --------------------------------------------------------

--
-- Table structure for table `customer_register_form_a_type_b`
--

DROP TABLE IF EXISTS `customer_register_form_a_type_b`;
CREATE TABLE IF NOT EXISTS `customer_register_form_a_type_b` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customerid` int(11) DEFAULT NULL,
  `si_no` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `token_no_issued` int(11) DEFAULT NULL,
  `date_of_first_appointment` datetime DEFAULT NULL,
  `certificate_of_age_fitness` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `place_of_emp` tinyint(1) DEFAULT NULL COMMENT '1=underground,2=open cast, 3=surface',
  `vocational_training_no` int(11) DEFAULT NULL,
  `vocational_training_date` datetime DEFAULT NULL,
  `nominee_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nominee_address` text COLLATE utf8_unicode_ci,
  `emergencies_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `emergencies_address` text COLLATE utf8_unicode_ci,
  `emergencies_mobile` int(11) DEFAULT NULL,
  `signature_of_managers` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remark` text COLLATE utf8_unicode_ci,
  `created_by` datetime DEFAULT NULL,
  `updated_by` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer_register_form_b`
--

DROP TABLE IF EXISTS `customer_register_form_b`;
CREATE TABLE IF NOT EXISTS `customer_register_form_b` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customerid` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rate_of_wage` int(11) DEFAULT NULL,
  `no_of_work_days` int(11) DEFAULT NULL,
  `overtime_hours` int(11) DEFAULT NULL,
  `basic` int(11) DEFAULT NULL,
  `special_basic` int(11) DEFAULT NULL,
  `da` int(11) DEFAULT NULL,
  `overtime_payments` int(11) DEFAULT NULL,
  `hra` int(11) DEFAULT NULL,
  `others` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `pf` int(11) DEFAULT NULL,
  `esic` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `society` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `income_tax` int(11) DEFAULT NULL,
  `insurance` int(11) DEFAULT NULL,
  `others_deduction` int(11) DEFAULT NULL,
  `recoveries` int(11) DEFAULT NULL,
  `total_deduction` int(11) DEFAULT NULL,
  `net_payment` int(11) DEFAULT NULL,
  `emp_share_pf_welfare` int(11) DEFAULT NULL,
  `receipt_by_emp_bank_trans_id` int(11) DEFAULT NULL,
  `date_of_payment` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remark` text COLLATE utf8_unicode_ci,
  `created_by` datetime DEFAULT NULL,
  `updated_by` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `customer_register_form_b`
--

INSERT INTO `customer_register_form_b` (`id`, `customerid`, `name`, `rate_of_wage`, `no_of_work_days`, `overtime_hours`, `basic`, `special_basic`, `da`, `overtime_payments`, `hra`, `others`, `total`, `pf`, `esic`, `society`, `income_tax`, `insurance`, `others_deduction`, `recoveries`, `total_deduction`, `net_payment`, `emp_share_pf_welfare`, `receipt_by_emp_bank_trans_id`, `date_of_payment`, `remark`, `created_by`, `updated_by`) VALUES
(1, 2, 'gdf', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, '', '', '2018-06-16 12:46:45', '2018-06-16 12:46:45');

-- --------------------------------------------------------

--
-- Table structure for table `customer_register_form_c`
--

DROP TABLE IF EXISTS `customer_register_form_c`;
CREATE TABLE IF NOT EXISTS `customer_register_form_c` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customerid` int(11) DEFAULT NULL,
  `si_no` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `recovery_type` tinyint(1) DEFAULT NULL COMMENT '1=demage,2=loss,3=fine,4=advance,5=loans',
  `particulars` text COLLATE utf8_unicode_ci,
  `date_of_loss` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `whether_show_cause_issued` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `explanation_heard_in_presence_of` text COLLATE utf8_unicode_ci,
  `no_of_emis` int(11) DEFAULT NULL,
  `first_month_year` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_month_year` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_of_complete_recovery` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remark` text COLLATE utf8_unicode_ci,
  `created_by` datetime DEFAULT NULL,
  `updated_by` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `customer_register_form_c`
--

INSERT INTO `customer_register_form_c` (`id`, `customerid`, `si_no`, `name`, `recovery_type`, `particulars`, `date_of_loss`, `amount`, `whether_show_cause_issued`, `explanation_heard_in_presence_of`, `no_of_emis`, `first_month_year`, `last_month_year`, `date_of_complete_recovery`, `remark`, `created_by`, `updated_by`) VALUES
(1, 2, 1, 'gdfg', 0, '', '', 0, '', '', 0, '', '', '', '', '2018-06-16 12:47:19', '2018-06-16 12:47:19');

-- --------------------------------------------------------

--
-- Table structure for table `customer_register_form_d`
--

DROP TABLE IF EXISTS `customer_register_form_d`;
CREATE TABLE IF NOT EXISTS `customer_register_form_d` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customerid` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `relay_or_set_work` text COLLATE utf8_unicode_ci,
  `day_1` tinyint(1) DEFAULT NULL,
  `day_2` tinyint(1) DEFAULT NULL,
  `day_3` tinyint(1) DEFAULT NULL,
  `day_4` tinyint(1) DEFAULT NULL,
  `day_5` tinyint(1) DEFAULT NULL,
  `day_6` tinyint(1) DEFAULT NULL,
  `day_7` tinyint(1) DEFAULT NULL,
  `day_8` tinyint(1) DEFAULT NULL,
  `day_9` tinyint(1) DEFAULT NULL,
  `day_10` tinyint(1) DEFAULT NULL,
  `day_11` tinyint(1) DEFAULT NULL,
  `day_12` tinyint(1) DEFAULT NULL,
  `day_13` tinyint(1) DEFAULT NULL,
  `day_14` tinyint(1) DEFAULT NULL,
  `day_15` tinyint(1) DEFAULT NULL,
  `day_16` tinyint(1) DEFAULT NULL,
  `day_17` tinyint(1) DEFAULT NULL,
  `day_18` tinyint(1) DEFAULT NULL,
  `day_19` tinyint(1) DEFAULT NULL,
  `day_20` tinyint(1) DEFAULT NULL,
  `day_21` tinyint(1) DEFAULT NULL,
  `day_22` tinyint(1) DEFAULT NULL,
  `day_23` tinyint(1) DEFAULT NULL,
  `day_24` tinyint(1) DEFAULT NULL,
  `day_25` tinyint(1) DEFAULT NULL,
  `day_26` tinyint(1) DEFAULT NULL,
  `day_27` tinyint(1) DEFAULT NULL,
  `day_28` tinyint(1) DEFAULT NULL,
  `day_29` tinyint(1) DEFAULT NULL,
  `day_30` tinyint(1) DEFAULT NULL,
  `day_31` tinyint(1) DEFAULT NULL,
  `summary_no_of_days` int(11) DEFAULT NULL,
  `signature_of_reg_keeper` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remark_no_of_hours` text COLLATE utf8_unicode_ci,
  `created_by` datetime DEFAULT NULL,
  `updated_by` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `customer_register_form_d`
--

INSERT INTO `customer_register_form_d` (`id`, `customerid`, `name`, `relay_or_set_work`, `day_1`, `day_2`, `day_3`, `day_4`, `day_5`, `day_6`, `day_7`, `day_8`, `day_9`, `day_10`, `day_11`, `day_12`, `day_13`, `day_14`, `day_15`, `day_16`, `day_17`, `day_18`, `day_19`, `day_20`, `day_21`, `day_22`, `day_23`, `day_24`, `day_25`, `day_26`, `day_27`, `day_28`, `day_29`, `day_30`, `day_31`, `summary_no_of_days`, `signature_of_reg_keeper`, `remark_no_of_hours`, `created_by`, `updated_by`) VALUES
(1, 3, 'kinjal.thaker@1rivet.com', '', 1, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '', '', '2018-06-15 15:44:56', '2018-06-15 15:44:56'),
(2, 3, 'kinjal', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '', '', '2018-06-15 15:49:54', '2018-06-15 15:49:54'),
(3, 3, 'dsf', '', 1, 2, 3, 2, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '', '', '2018-06-15 15:50:18', '2018-06-15 15:50:18'),
(4, 2, 'dgdf', 'dfg', 1, 2, 2, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'dfg', 'dfg', '2018-06-16 12:48:08', '2018-06-16 12:48:09');

-- --------------------------------------------------------

--
-- Table structure for table `zones`
--

DROP TABLE IF EXISTS `zones`;
CREATE TABLE IF NOT EXISTS `zones` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `zonename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `zones`
--

INSERT INTO `zones` (`id`, `zonename`, `created_at`, `updated_at`) VALUES
(1, 'Valsad', '2018-06-10 12:29:11', '2018-06-10 14:59:43'),
(2, 'Navsari', '2018-06-10 12:29:54', '2018-06-10 14:59:35');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
