/*
SQLyog Community Edition- MySQL GUI v7.11 
MySQL - 5.5.24-log : Database - quary
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE DATABASE /*!32312 IF NOT EXISTS*/`quary` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;

USE `quary`;

/*Table structure for table `admin` */

DROP TABLE IF EXISTS `admin`;

CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `modificationdate` datetime DEFAULT NULL,
  `creationdate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `admin` */

insert  into `admin`(`id`,`username`,`password`,`email`,`modificationdate`,`creationdate`) values (1,'admin','21232f297a57a5a743894a0e4a801fc3','kinjalthaker51@gmail.com','2018-05-01 11:37:55','2018-05-01 11:37:58');

/*Table structure for table `customer_additional_info` */

DROP TABLE IF EXISTS `customer_additional_info`;

CREATE TABLE `customer_additional_info` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `customer_additional_info` */

/*Table structure for table `customer_employees` */

DROP TABLE IF EXISTS `customer_employees`;

CREATE TABLE `customer_employees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customerid` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `designation` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile_no` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `customer_employees` */

insert  into `customer_employees`(`id`,`customerid`,`name`,`designation`,`mobile_no`,`created_at`,`updated_at`) values (1,1,'Anjali','Software Developer',2147483647,'2018-06-10 18:13:32','2018-06-10 18:13:32');

/*Table structure for table `customer_explosive_capacity` */

DROP TABLE IF EXISTS `customer_explosive_capacity`;

CREATE TABLE `customer_explosive_capacity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_licence_id` int(11) DEFAULT NULL COMMENT 'customer exposive id',
  `class` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `division` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `qty_at_time` int(11) DEFAULT NULL,
  `unit` int(11) DEFAULT NULL,
  `no_of_time` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `customer_explosive_capacity` */

/*Table structure for table `customer_licence_info` */

DROP TABLE IF EXISTS `customer_licence_info`;

CREATE TABLE `customer_licence_info` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `customer_licence_info` */

/*Table structure for table `customer_register_form_a_type_a` */

DROP TABLE IF EXISTS `customer_register_form_a_type_a`;

CREATE TABLE `customer_register_form_a_type_a` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customerid` int(11) DEFAULT NULL,
  `srno` int(11) DEFAULT NULL,
  `emp_code` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `firstname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` tinyint(1) DEFAULT NULL COMMENT '1=men,2=women,3=other',
  `secondname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dob` datetime DEFAULT NULL,
  `nationality` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `education` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `doj` datetime DEFAULT NULL,
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
  `date_of_exit` datetime DEFAULT NULL,
  `reason_for_exit` text COLLATE utf8_unicode_ci,
  `id_mark` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `signature_thumb_image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remark` text COLLATE utf8_unicode_ci,
  `created_by` datetime DEFAULT NULL,
  `updated_by` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `customer_register_form_a_type_a` */

/*Table structure for table `customer_register_form_a_type_b` */

DROP TABLE IF EXISTS `customer_register_form_a_type_b`;

CREATE TABLE `customer_register_form_a_type_b` (
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

/*Data for the table `customer_register_form_a_type_b` */

/*Table structure for table `customer_register_form_b` */

DROP TABLE IF EXISTS `customer_register_form_b`;

CREATE TABLE `customer_register_form_b` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `customer_register_form_b` */

/*Table structure for table `customer_register_form_c` */

DROP TABLE IF EXISTS `customer_register_form_c`;

CREATE TABLE `customer_register_form_c` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `customer_register_form_c` */

/*Table structure for table `customer_register_form_d` */

DROP TABLE IF EXISTS `customer_register_form_d`;

CREATE TABLE `customer_register_form_d` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customerid` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `relay_or_set_work` text COLLATE utf8_unicode_ci,
  `day_1` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `day_2` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `day_3` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `day_4` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `day_5` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `day_6` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `day_7` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `day_8` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `day_9` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `day_10` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `day_11` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `day_12` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `day_13` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `day_14` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `day_15` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `day_16` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `day_17` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `day_18` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `day_19` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `day_20` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `day_21` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `day_22` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `day_23` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `day_24` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `day_25` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `day_26` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `day_27` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `day_28` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `day_29` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `day_30` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `day_31` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `summary_no_of_days` int(11) DEFAULT NULL,
  `signature_of_reg_keeper` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remark_no_of_hours` text COLLATE utf8_unicode_ci,
  `created_by` datetime DEFAULT NULL,
  `updated_by` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `customer_register_form_d` */

/*Table structure for table `customers` */

DROP TABLE IF EXISTS `customers`;

CREATE TABLE `customers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `customers` */

insert  into `customers`(`id`,`uploadid`,`zoneid`,`companyname`,`firstname`,`lastname`,`phone`,`licenceno`,`email`,`password`,`survey_no`,`address`,`pincode`,`state`,`created_at`,`updated_at`) values (2,1,2,NULL,'Mansi','thaker',65,'rtgre','m@gmail.com',NULL,NULL,NULL,NULL,NULL,'2018-06-10 18:00:14','2018-06-10 18:00:14');

/*Table structure for table `customers_bills` */

DROP TABLE IF EXISTS `customers_bills`;

CREATE TABLE `customers_bills` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customerid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `billname` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billno` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bill_amount` decimal(10,2) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `customers_bills` */

insert  into `customers_bills`(`id`,`customerid`,`userid`,`billname`,`billno`,`bill_amount`,`created_at`,`updated_at`) values (2,1,1,'bill1','3unk0','100.00','2018-06-10 23:01:33','2018-06-10 23:01:33'),(3,1,2,'bill2','ttp35','200.00','2018-06-10 23:01:33','2018-06-10 23:01:33');

/*Table structure for table `customerupload` */

DROP TABLE IF EXISTS `customerupload`;

CREATE TABLE `customerupload` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `customerupload` */

insert  into `customerupload`(`id`,`filename`,`created_at`,`updated_at`) values (1,'0_15880500_1528633809.xlsx','2018-06-10 18:00:09','2018-06-10 18:00:09');

/*Table structure for table `zones` */

DROP TABLE IF EXISTS `zones`;

CREATE TABLE `zones` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `zonename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `zones` */

insert  into `zones`(`id`,`zonename`,`created_at`,`updated_at`) values (1,'Valsad','2018-06-10 17:59:11','2018-06-10 20:29:43'),(2,'Navsari','2018-06-10 17:59:54','2018-06-10 20:29:35');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
