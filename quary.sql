-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 04, 2018 at 09:31 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `quary`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adminname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `modificationdate` datetime DEFAULT NULL,
  `creationdate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `adminname`, `username`, `password`, `email`, `modificationdate`, `creationdate`) VALUES
(1, 'Jayesh Pramodrai Desai', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'kinjalthaker51@gmail.com', '2018-05-01 11:37:55', '2018-05-01 11:37:58');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uploadid` int(11) DEFAULT '0',
  `zoneid` int(11) DEFAULT NULL,
  `companyname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` int(20) NOT NULL,
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `uploadid`, `zoneid`, `companyname`, `firstname`, `lastname`, `phone`, `licenceno`, `email`, `password`, `survey_no`, `address`, `pincode`, `state`, `created_at`, `updated_at`) VALUES
(1, 0, 1, '', '', '', 2147483647, '', 'vaibhavraj.surat@gmail.com', '247462kk@', 'Block No 178', 'Zankhvav Wadi Road At Post Wadi Taluka Umarpada District Surat', 394440, 'Gujarat', '2018-08-09 10:20:37', '2018-08-18 10:15:09');

-- --------------------------------------------------------

--
-- Table structure for table `customers_bills`
--

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `customers_bills`
--

INSERT INTO `customers_bills` (`id`, `customerid`, `userid`, `billname`, `billno`, `bill_amount`, `payment_status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'All General works regarding Explosives Return and Other work for Period From dated 01/044/02018 to d', '7p3dm', '6000.00', 2, '2018-08-18 15:58:47', '2018-08-18 16:04:08');

-- --------------------------------------------------------

--
-- Table structure for table `customerupload`
--

CREATE TABLE IF NOT EXISTS `customerupload` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `customer_additional_info`
--

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `customer_additional_info`
--

INSERT INTO `customer_additional_info` (`id`, `customerid`, `detailname`, `emailid`, `password`, `startdate`, `enddate`, `created_at`, `updated_at`) VALUES
(2, 1, 'Shram Shuvidha LIN detail', 'vaibhavraj.surat@gmail.com', 'Karan@247462', NULL, NULL, '2018-08-09 16:08:40', '2018-08-09 16:08:40'),
(3, 1, 'Expl;osives Return', 'vaibhavraj', '#Vaibhavraj1277', NULL, NULL, '2018-08-09 16:08:40', '2018-08-09 16:08:40');

-- --------------------------------------------------------

--
-- Table structure for table `customer_employees`
--

CREATE TABLE IF NOT EXISTS `customer_employees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customerid` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `designation` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile_no` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `customer_employees`
--

INSERT INTO `customer_employees` (`id`, `customerid`, `name`, `designation`, `mobile_no`, `created_at`, `updated_at`) VALUES
(1, 1, 'Bharatbhai Bhikhu bhai yadav', 'Partner', 1234567890, '2018-08-18 15:43:47', '2018-08-18 15:43:47'),
(2, 1, 'Harendrasinh Rupsinh matediya', 'Partner', 1234567890, '2018-08-18 15:45:09', '2018-08-18 15:45:09');

-- --------------------------------------------------------

--
-- Table structure for table `customer_explosive_capacity`
--

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `customer_explosive_capacity`
--

INSERT INTO `customer_explosive_capacity` (`id`, `customerid`, `srno`, `explosive_name`, `class`, `division`, `qty_at_time`, `unit`, `no_of_time`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Nitrate Mixure', '2', '0', 150, 0, 10, '2018-08-09 16:08:40', '2018-08-09 16:08:40'),
(2, 1, 2, 'Detonators', '6', '3', 5000, 0, 10, '2018-08-09 16:08:40', '2018-08-09 16:08:40');

-- --------------------------------------------------------

--
-- Table structure for table `customer_licence_info`
--

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `customer_licence_info`
--

INSERT INTO `customer_licence_info` (`id`, `customerid`, `detail_type`, `document_key`, `licence_no`, `name`, `issue_date`, `expiry_date`, `created_at`, `updated_at`) VALUES
(1, 1, '1', 'E65296', 'E/WC/GJ/22/1277', 'BHARAT BHIKHUBHAI YADAV', '2011-12-02', '2021-03-31', '2018-08-09 16:08:40', '2018-08-18 15:56:05'),
(2, 1, '2', 'E89387', 'E/WB/GJ/30/3008', 'KALPESH DINESHBHAI TADVI', '2015-10-28', '2020-10-28', '2018-08-09 16:08:40', '2018-08-09 16:08:40'),
(3, 1, '2', 'E89391', 'E/WB/GJ/30/3276', 'KARSHAN DEVABHAI DANGAR', '2016-02-11', '2021-02-11', '2018-08-09 16:08:40', '2018-08-09 16:08:40');

-- --------------------------------------------------------

--
-- Table structure for table `customer_notes`
--

CREATE TABLE IF NOT EXISTS `customer_notes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customerid` int(11) DEFAULT NULL,
  `notes` text COLLATE utf8_unicode_ci,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `customer_register_form_a_type_a`
--

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `customer_register_form_a_type_b`
--

CREATE TABLE IF NOT EXISTS `customer_register_form_a_type_b` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customerid` int(11) NOT NULL,
  `si_no` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `token_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_of_first_appnt` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cert_of_age` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `place_of_emp` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vocational_number` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vocational_date` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nomi_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nomi_add` text COLLATE utf8_unicode_ci,
  `emergency_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `emergency_add` text COLLATE utf8_unicode_ci,
  `emergency_mobile` int(11) DEFAULT NULL,
  `remark` text COLLATE utf8_unicode_ci,
  `sign_of_mines` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` datetime NOT NULL,
  `updated_by` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='linked with register form A type A' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `customer_register_form_b`
--

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `customer_register_form_c`
--

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `customer_register_form_d`
--

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `zones`
--

CREATE TABLE IF NOT EXISTS `zones` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `zonename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `zones`
--

INSERT INTO `zones` (`id`, `zonename`, `created_at`, `updated_at`) VALUES
(1, 'SURAT', '2018-08-09 10:17:00', '2018-08-09 10:17:00'),
(2, 'NAVSARI', '2018-08-09 10:17:40', '2018-08-09 10:17:40'),
(3, 'VALSAD', '2018-08-09 10:17:52', '2018-08-09 10:17:52'),
(4, 'TAPI', '2018-08-09 10:18:05', '2018-08-09 10:18:05'),
(5, 'BHARUCH - NARMADA', '2018-08-09 10:18:30', '2018-08-09 10:18:30'),
(6, 'DAMAN - SELVASSA', '2018-08-09 10:18:42', '2018-08-09 10:18:42');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
