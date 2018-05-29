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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `customer_additional_info` */

insert  into `customer_additional_info`(`id`,`customerid`,`detailname`,`emailid`,`password`,`startdate`,`enddate`,`created_at`,`updated_at`) values (1,1,'Employee RNA detail','kinjalthaker51@gmail.com','kinjalcss6',NULL,NULL,'2018-05-14 12:40:18','2018-05-14 12:40:18'),(2,1,'Shram Shuvidha LIN detail','kinjal@maximaainfoways.com','kinjal',NULL,NULL,'2018-05-14 12:40:18','2018-05-14 12:40:18'),(3,1,'kinjal','kinjalthaker51@gmail.com','fdsf',NULL,NULL,'2018-05-14 12:40:18','2018-05-14 12:40:18');

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `customer_employees` */

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
  `issue_date` datetime DEFAULT NULL,
  `expiry_date` datetime DEFAULT NULL,
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
  `rate_of_wage` decimal(10,2) DEFAULT NULL,
  `no_of_work_days` int(11) DEFAULT NULL,
  `overtime_hours` decimal(10,2) DEFAULT NULL,
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
  `date_of_payment` datetime DEFAULT NULL,
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
  `date_of_loss` datetime DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `whether_show_cause_issued` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `explanation_heard_in_presence_of` text COLLATE utf8_unicode_ci,
  `no_of_emis` int(11) DEFAULT NULL,
  `first_month_year` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_month_year` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_of_complete_recovery` datetime DEFAULT NULL,
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
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `survey_no` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `pincode` int(11) DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `customers` */

insert  into `customers`(`id`,`uploadid`,`zoneid`,`companyname`,`firstname`,`lastname`,`phone`,`email`,`password`,`survey_no`,`address`,`pincode`,`state`,`created_at`,`updated_at`) values (1,35,2,NULL,'k','t',435435,NULL,NULL,'LIC1',NULL,NULL,NULL,'2018-05-04 13:24:25','2018-05-04 13:24:59'),(2,35,4,NULL,'m','t',54353,NULL,NULL,'LIC2',NULL,NULL,NULL,'2018-05-04 13:24:25','2018-05-04 13:24:59'),(3,35,3,NULL,'a','d',543535,NULL,NULL,'LIC3',NULL,NULL,NULL,'2018-05-04 13:24:25','2018-05-04 13:24:59'),(4,35,2,NULL,'y','p',6456,NULL,NULL,'LIC4',NULL,NULL,NULL,'2018-05-04 13:24:25','2018-05-04 13:24:59'),(5,35,4,NULL,'p','p',435345,NULL,NULL,'LIC5',NULL,NULL,NULL,'2018-05-04 13:24:25','2018-05-04 13:24:59'),(6,35,4,NULL,'x','x',43543,NULL,NULL,'LIC6',NULL,NULL,NULL,'2018-05-04 13:24:25','2018-05-04 13:24:59');

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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `customers_bills` */

insert  into `customers_bills`(`id`,`customerid`,`userid`,`billname`,`billno`,`bill_amount`,`created_at`,`updated_at`) values (4,6,2,'bill2','cyz39','200.00','2018-05-06 19:17:36','2018-05-06 19:17:36'),(3,6,1,'bill1','4sjt2','100.00','2018-05-06 19:17:36','2018-05-06 19:17:36'),(5,1,1,'gfh','j9q9p','100.00','2018-05-10 11:37:01','2018-05-10 11:37:01');

/*Table structure for table `customerupload` */

DROP TABLE IF EXISTS `customerupload`;

CREATE TABLE `customerupload` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `customerupload` */

insert  into `customerupload`(`id`,`filename`,`created_at`,`updated_at`) values (1,'0_63279000_1525341476.xlsx','2018-05-03 15:27:56','2018-05-03 15:27:56'),(2,'0_46440200_1525341581.xlsx','2018-05-03 15:29:41','2018-05-03 15:29:41'),(3,'0_45516000_1525341813.xlsx','2018-05-03 15:33:33','2018-05-03 15:33:33'),(4,'0_99945200_1525341925.xlsx','2018-05-03 15:35:25','2018-05-03 15:35:26'),(5,'0_44126800_1525342272.xlsx','2018-05-03 15:41:12','2018-05-03 15:41:12'),(6,'0_06930100_1525342431.xlsx','2018-05-03 15:43:51','2018-05-03 15:43:51'),(7,'0_94880300_1525343715.xlsx','2018-05-03 16:05:15','2018-05-03 16:05:15'),(8,'0_00164200_1525343746.xlsx','2018-05-03 16:05:45','2018-05-03 16:05:46'),(15,'0_81668000_1525345026.xlsx','2018-05-03 16:27:06','2018-05-03 16:27:06'),(16,'0_94369700_1525350803.xlsx','2018-05-03 18:03:23','2018-05-03 18:03:23'),(17,'0_64800800_1525416990.xlsx','2018-05-04 12:26:30','2018-05-04 12:26:30'),(19,'0_54776300_1525417122.xlsx','2018-05-04 12:28:42','2018-05-04 12:28:42'),(20,'0_06447300_1525417206.xlsx','2018-05-04 12:30:06','2018-05-04 12:30:06'),(21,'0_59101200_1525419358.xlsx','2018-05-04 13:05:58','2018-05-04 13:05:58'),(22,'0_97775200_1525419473.xlsx','2018-05-04 13:07:53','2018-05-04 13:07:53'),(23,'0_44628900_1525419569.xlsx','2018-05-04 13:09:29','2018-05-04 13:09:29'),(24,'0_73173000_1525419609.xlsx','2018-05-04 13:10:09','2018-05-04 13:10:09'),(25,'0_11222600_1525419677.xlsx','2018-05-04 13:11:17','2018-05-04 13:11:17'),(26,'0_90680700_1525419785.xlsx','2018-05-04 13:13:05','2018-05-04 13:13:05'),(27,'0_60123900_1525419861.xlsx','2018-05-04 13:14:21','2018-05-04 13:14:21'),(28,'0_51176600_1525419940.xlsx','2018-05-04 13:15:40','2018-05-04 13:15:40'),(29,'0_17229900_1525420022.xlsx','2018-05-04 13:17:02','2018-05-04 13:17:02'),(30,'0_89676400_1525420053.xlsx','2018-05-04 13:17:33','2018-05-04 13:17:33'),(31,'0_51484100_1525420117.xlsx','2018-05-04 13:18:37','2018-05-04 13:18:37'),(32,'0_73343000_1525420187.xlsx','2018-05-04 13:19:47','2018-05-04 13:19:47'),(33,'0_15710000_1525420288.xlsx','2018-05-04 13:21:28','2018-05-04 13:21:28'),(34,'0_72189400_1525420460.xlsx','2018-05-04 13:24:20','2018-05-04 13:24:20'),(35,'0_05851100_1525420495.xlsx','2018-05-04 13:24:55','2018-05-04 13:24:55');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`password`,`remember_token`,`created_at`,`updated_at`) values (1,'admin','kinjalthaker51@gmail.com','$2y$10$Qq.wkmMzmKV4UxG4XUz.6uxKFDwocAZyuJYpyPw4rynC9Mqi1PX/y','zSINRcqDSVxUcX3MZ8pVM3TmA4wIiCVmBQh25lFcL7sTvVaMmMi2vQJosfoH','2018-04-30 10:06:08','2018-04-30 10:06:08');

/*Table structure for table `zones` */

DROP TABLE IF EXISTS `zones`;

CREATE TABLE `zones` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `zonename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `zones` */

insert  into `zones`(`id`,`zonename`,`created_at`,`updated_at`) values (2,'Valsad','2018-05-02 12:56:28','2018-05-02 12:58:04'),(3,'Vapi','2018-05-02 12:58:14','2018-05-02 12:58:14'),(4,'Navsari','2018-05-02 12:58:39','2018-05-02 12:58:39');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
