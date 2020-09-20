/*
SQLyog Community v12.03 (64 bit)
MySQL - 5.6.21 : Database - proj_bssp
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`proj_bssp` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `proj_bssp`;

/*Table structure for table `bssp_address` */

DROP TABLE IF EXISTS `bssp_address`;

CREATE TABLE `bssp_address` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `addressLineOne` varchar(50) DEFAULT NULL,
  `addressLineTwo` varchar(50) DEFAULT NULL,
  `postalAddress` varchar(120) DEFAULT NULL,
  `regionCode` varchar(128) DEFAULT NULL,
  `cityCode` varchar(128) DEFAULT NULL,
  `constituencyCode` varchar(128) DEFAULT NULL,
  `countryCode` varchar(128) DEFAULT NULL,
  `legalEntityId` bigint(20) DEFAULT NULL,
  `createdBy` varchar(24) DEFAULT NULL,
  `createdOn` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedBy` varchar(24) DEFAULT NULL,
  `modifiedOn` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `bssp_address` */

insert  into `bssp_address`(`id`,`addressLineOne`,`addressLineTwo`,`postalAddress`,`regionCode`,`cityCode`,`constituencyCode`,`countryCode`,`legalEntityId`,`createdBy`,`createdOn`,`modifiedBy`,`modifiedOn`) values (1,'Komasdal Gladiola','Erf 1117','P.O.Box 50016 Bachbrecht','KHOMAS','WINDHOEK',NULL,'NAM',1,NULL,'2014-12-21 19:50:19',NULL,'2014-12-21 19:51:10'),(2,'Komasdal Gladiola','Erf 1117','P.O.Box 50016 Bachbrecht','KHOMAS','WINDHOEK',NULL,'NAM',2,NULL,'2014-12-22 03:35:58',NULL,NULL);

/*Table structure for table `bssp_application_numbers_gen` */

DROP TABLE IF EXISTS `bssp_application_numbers_gen`;

CREATE TABLE `bssp_application_numbers_gen` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'Auto incremented numeric value',
  `data` varchar(4) DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `bssp_application_numbers_gen` */

/*Table structure for table `bssp_applications` */

DROP TABLE IF EXISTS `bssp_applications`;

CREATE TABLE `bssp_applications` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `applicationNumber` varchar(20) DEFAULT NULL,
  `applicationDate` date DEFAULT NULL,
  `applicationAcknowledgementDate` datetime DEFAULT NULL,
  `applicationLegalEntityId` bigint(20) DEFAULT NULL,
  `applicationLegalEntityType` varchar(30) DEFAULT NULL,
  `createdBy` varchar(24) DEFAULT NULL,
  `createdOn` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedBy` varchar(24) DEFAULT NULL,
  `modifiedOn` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_application_id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `bssp_applications` */

insert  into `bssp_applications`(`id`,`applicationNumber`,`applicationDate`,`applicationAcknowledgementDate`,`applicationLegalEntityId`,`applicationLegalEntityType`,`createdBy`,`createdOn`,`modifiedBy`,`modifiedOn`) values (1,'BSA20141200000001','2014-12-03','2014-12-23 00:00:00',1,'company',NULL,'2014-12-21 19:50:19',NULL,'2014-12-21 19:51:10');

/*Table structure for table `bssp_assignment_extensions` */

DROP TABLE IF EXISTS `bssp_assignment_extensions`;

CREATE TABLE `bssp_assignment_extensions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `assignmentExtensionPhase` varchar(30) DEFAULT NULL COMMENT '[F]irst phase , [S]econd phase',
  `assignmentExtensionDiscussionDate` date DEFAULT NULL,
  `assignmentExtendedFromDate` date DEFAULT NULL,
  `assignmentExtendedToDate` date DEFAULT NULL,
  `assignmentExtensionRemarks` varchar(1200) NOT NULL,
  `assignmentExtensionProjectNumber` varchar(20) DEFAULT NULL,
  `createdBy` varchar(24) DEFAULT NULL,
  `createdOn` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedBy` varchar(24) DEFAULT NULL,
  `modifiedOn` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_assignment_extensions_id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

/*Data for the table `bssp_assignment_extensions` */

insert  into `bssp_assignment_extensions`(`id`,`assignmentExtensionPhase`,`assignmentExtensionDiscussionDate`,`assignmentExtendedFromDate`,`assignmentExtendedToDate`,`assignmentExtensionRemarks`,`assignmentExtensionProjectNumber`,`createdBy`,`createdOn`,`modifiedBy`,`modifiedOn`) values (3,'FIRST PHASE','2014-12-19','2014-12-10','2014-12-19','Commitee Remarks','BSP20141200000001',NULL,'2014-12-23 00:33:03',NULL,NULL),(4,'SECOND PHASE','2014-12-10','2014-12-17','2014-12-25','Commitee Remarks ii','BSP20141200000001',NULL,'2014-12-23 00:33:03',NULL,NULL),(5,'FIRST PHASE','2014-12-19','2014-12-10','2014-12-19','Commitee Remarks','BSP20141200000001',NULL,'2014-12-23 00:34:49',NULL,NULL),(6,'SECOND PHASE','2014-12-10','2014-12-17','2014-12-25','Commitee Remarks ii','BSP20141200000001',NULL,'2014-12-23 00:34:49',NULL,NULL),(7,'FIRST PHASE','2014-12-19','2014-12-10','2014-12-19','Commitee Remarks','BSP20141200000001',NULL,'2014-12-23 00:36:04',NULL,NULL),(8,'SECOND PHASE','2014-12-10','2014-12-17','2014-12-25','Commitee Remarks ii','BSP20141200000001',NULL,'2014-12-23 00:36:04',NULL,NULL),(9,'FIRST PHASE','2014-12-19','2014-12-10','2014-12-19','Commitee Remarks','BSP20141200000001',NULL,'2014-12-23 00:37:36',NULL,NULL),(10,'SECOND PHASE','2014-12-10','2014-12-17','2014-12-25','Commitee Remarks ii','BSP20141200000001',NULL,'2014-12-23 00:37:36',NULL,NULL),(11,'FIRST PHASE','2014-12-19','2014-12-10','2014-12-19','Commitee Remarks','BSP20141200000001',NULL,'2014-12-23 00:38:55',NULL,NULL),(12,'SECOND PHASE','2014-12-10','2014-12-17','2014-12-25','Commitee Remarks ii','BSP20141200000001',NULL,'2014-12-23 00:38:55',NULL,NULL),(13,'FIRST PHASE','2014-12-19','2014-12-10','2014-12-19','Commitee Remarks','BSP20141200000001',NULL,'2014-12-23 09:05:24',NULL,NULL),(14,'SECOND PHASE','2014-12-10','2014-12-17','2014-12-25','Commitee Remarks ii','BSP20141200000001',NULL,'2014-12-23 09:05:24',NULL,NULL),(15,'FIRST PHASE','2014-12-19','2014-12-10','2014-12-19','Commitee Remarks','BSP20141200000001',NULL,'2014-12-23 09:35:14',NULL,NULL),(16,'SECOND PHASE','2014-12-10','2014-12-17','2014-12-25','Commitee Remarks ii','BSP20141200000001',NULL,'2014-12-23 09:35:14',NULL,NULL);

/*Table structure for table `bssp_contacts` */

DROP TABLE IF EXISTS `bssp_contacts`;

CREATE TABLE `bssp_contacts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `contactFirstName` varchar(128) DEFAULT NULL,
  `contactMiddleName` varchar(128) DEFAULT NULL,
  `contactLastName` varchar(128) DEFAULT NULL,
  `contactPosition` varchar(256) DEFAULT NULL,
  `contactTitle` varchar(128) DEFAULT NULL,
  `legalEntityId` bigint(20) DEFAULT NULL,
  `createdOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createdBy` varchar(24) DEFAULT NULL,
  `modifiedBy` varchar(24) DEFAULT NULL,
  `modifiedOn` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `bssp_contacts` */

insert  into `bssp_contacts`(`id`,`contactFirstName`,`contactMiddleName`,`contactLastName`,`contactPosition`,`contactTitle`,`legalEntityId`,`createdOn`,`createdBy`,`modifiedBy`,`modifiedOn`) values (1,'Amarion','Amarion','Amolo','General Manager','Dr',1,'2014-12-21 19:50:19',NULL,NULL,'2014-12-21 19:51:10');

/*Table structure for table `bssp_employment_creation` */

DROP TABLE IF EXISTS `bssp_employment_creation`;

CREATE TABLE `bssp_employment_creation` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `employmentNumberOfMales` int(11) DEFAULT NULL,
  `employmentNumberOfFemales` int(11) DEFAULT NULL,
  `employmentDateOfEmployment` date NOT NULL,
  `employmentRemarks` varchar(1200) DEFAULT NULL,
  `projectNumber` varchar(20) NOT NULL,
  `createdBy` varchar(24) DEFAULT NULL,
  `createdOn` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedBy` varchar(24) DEFAULT NULL,
  `modifiedOn` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_bssp_employment_creation` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

/*Data for the table `bssp_employment_creation` */

insert  into `bssp_employment_creation`(`id`,`employmentNumberOfMales`,`employmentNumberOfFemales`,`employmentDateOfEmployment`,`employmentRemarks`,`projectNumber`,`createdBy`,`createdOn`,`modifiedBy`,`modifiedOn`) values (1,12,12,'2014-12-23',NULL,'BSP20141200000001',NULL,'2014-12-23 00:37:36',NULL,NULL),(2,14,45,'2014-12-25',NULL,'BSP20141200000001',NULL,'2014-12-23 00:37:36',NULL,NULL),(3,45,41,'2014-12-25',NULL,'BSP20141200000001',NULL,'2014-12-23 00:37:37',NULL,NULL),(4,12,12,'2014-12-23',NULL,'BSP20141200000001',NULL,'2014-12-23 00:38:55',NULL,NULL),(5,14,45,'2014-12-25',NULL,'BSP20141200000001',NULL,'2014-12-23 00:38:55',NULL,NULL),(6,45,41,'2014-12-25',NULL,'BSP20141200000001',NULL,'2014-12-23 00:38:55',NULL,NULL),(7,12,NULL,'2014-12-29',NULL,'BSP20141200000001',NULL,'2014-12-23 00:38:55',NULL,NULL),(8,12,12,'2014-12-23',NULL,'BSP20141200000001',NULL,'2014-12-23 09:05:24',NULL,NULL),(9,14,45,'2014-12-25',NULL,'BSP20141200000001',NULL,'2014-12-23 09:05:24',NULL,NULL),(10,12,12,'2014-12-23',NULL,'BSP20141200000001',NULL,'2014-12-23 09:35:14',NULL,NULL),(11,14,45,'2014-12-25',NULL,'BSP20141200000001',NULL,'2014-12-23 09:35:14',NULL,NULL),(12,45,41,'2014-12-25',NULL,'BSP20141200000001',NULL,'2014-12-23 09:35:14',NULL,NULL),(13,12,NULL,'2014-12-29',NULL,'BSP20141200000001',NULL,'2014-12-23 09:35:14',NULL,NULL);

/*Table structure for table `bssp_legal_entities` */

DROP TABLE IF EXISTS `bssp_legal_entities`;

CREATE TABLE `bssp_legal_entities` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `firstName` varchar(45) DEFAULT NULL,
  `middleName` varchar(45) DEFAULT NULL,
  `lastName` varchar(45) DEFAULT NULL,
  `dateOfBirth` date DEFAULT NULL,
  `passportNumber` varchar(15) DEFAULT NULL,
  `identityNumber` varchar(15) DEFAULT NULL,
  `companyName` varchar(256) DEFAULT NULL,
  `companyRegistrationNumber` varchar(30) DEFAULT NULL,
  `entityType` varchar(30) DEFAULT NULL COMMENT '[I]ndividual , [C]ompany',
  `entityCategory` varchar(30) DEFAULT NULL COMMENT '[P]romoter , [S]ponsor',
  `emailAddress` varchar(128) DEFAULT NULL,
  `telephoneNumber` varchar(24) DEFAULT NULL,
  `mobileNumber` varchar(24) DEFAULT NULL,
  `faxNumber` varchar(24) DEFAULT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT '1',
  `remarks` text,
  `createdOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createdBy` varchar(24) DEFAULT NULL,
  `modifiedBy` varchar(24) DEFAULT NULL,
  `modifiedOn` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_identityNumber` (`identityNumber`),
  KEY `idx_passportNumber` (`passportNumber`),
  KEY `idx_registrationNumber` (`companyRegistrationNumber`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `bssp_legal_entities` */

insert  into `bssp_legal_entities`(`id`,`firstName`,`middleName`,`lastName`,`dateOfBirth`,`passportNumber`,`identityNumber`,`companyName`,`companyRegistrationNumber`,`entityType`,`entityCategory`,`emailAddress`,`telephoneNumber`,`mobileNumber`,`faxNumber`,`isActive`,`remarks`,`createdOn`,`createdBy`,`modifiedBy`,`modifiedOn`) values (1,NULL,NULL,NULL,NULL,NULL,NULL,'Amarion INC 2017','CY/2014/2089','company','promoter','jadejuliette2000@gmail.com','+264814774999','+264814774999','+264814774999',1,NULL,'2014-12-21 19:50:18','SYSTEM',NULL,'2014-12-21 19:51:10'),(2,NULL,NULL,NULL,NULL,NULL,NULL,'Nam Solar Energy','CY/2014/2000','company','consultant','jadejuliette2000@gmail.com','+264814774999','+264814774999','+264814774999',1,NULL,'2014-12-22 03:35:58','SYSTEM',NULL,NULL);

/*Table structure for table `bssp_master_budget_numbers_gen` */

DROP TABLE IF EXISTS `bssp_master_budget_numbers_gen`;

CREATE TABLE `bssp_master_budget_numbers_gen` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'Auto incremented numeric value',
  `year` year(4) DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `bssp_master_budget_numbers_gen` */

/*Table structure for table `bssp_master_budgets` */

DROP TABLE IF EXISTS `bssp_master_budgets`;

CREATE TABLE `bssp_master_budgets` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(20) DEFAULT NULL,
  `name` varchar(256) DEFAULT NULL,
  `period` varchar(12) DEFAULT NULL,
  `amount` decimal(12,0) DEFAULT NULL,
  `description` varchar(256) DEFAULT NULL,
  `GLAccount` varchar(50) DEFAULT NULL,
  `createdBy` varchar(24) DEFAULT NULL,
  `createdOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedBy` varchar(24) DEFAULT NULL,
  `modifiedOn` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `bssp_master_budgets` */

insert  into `bssp_master_budgets`(`id`,`code`,`name`,`period`,`amount`,`description`,`GLAccount`,`createdBy`,`createdOn`,`modifiedBy`,`modifiedOn`) values (1,'BSB20132014','BSSP Master Budget 2014','2013-2014','21000000','BSSP Master Budget 2014',NULL,'SYSTEM','2014-12-22 03:34:54',NULL,NULL);

/*Table structure for table `bssp_project_budget_numbers_gen` */

DROP TABLE IF EXISTS `bssp_project_budget_numbers_gen`;

CREATE TABLE `bssp_project_budget_numbers_gen` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'Auto incremented numeric value',
  `year` year(4) DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

/*Data for the table `bssp_project_budget_numbers_gen` */

/*Table structure for table `bssp_project_budgets` */

DROP TABLE IF EXISTS `bssp_project_budgets`;

CREATE TABLE `bssp_project_budgets` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `budgetNumber` varchar(20) DEFAULT NULL,
  `budgetName` varchar(120) DEFAULT NULL,
  `budgetAmount` decimal(12,0) DEFAULT NULL,
  `budgetOutstandingAmount` decimal(12,0) DEFAULT '0',
  `budgetDateOfApproval` date DEFAULT NULL,
  `budgetRemarks` text,
  `masterBudgetNumber` varchar(20) DEFAULT NULL,
  `projectNumber` varchar(20) DEFAULT NULL,
  `createdBy` varchar(24) DEFAULT NULL,
  `createdOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedBy` varchar(24) DEFAULT NULL,
  `modifiedOn` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `bssp_project_budgets` */

insert  into `bssp_project_budgets`(`id`,`budgetNumber`,`budgetName`,`budgetAmount`,`budgetOutstandingAmount`,`budgetDateOfApproval`,`budgetRemarks`,`masterBudgetNumber`,`projectNumber`,`createdBy`,`createdOn`,`modifiedBy`,`modifiedOn`) values (2,'BSPB20141200000018',NULL,'10000000',NULL,'2014-12-17',NULL,'BSB20132014','BSP20141200000001',NULL,'2014-12-23 00:33:03',NULL,NULL),(3,'BSPB20141200000019',NULL,'10000000',NULL,'2014-12-17',NULL,'BSB20132014','BSP20141200000001',NULL,'2014-12-23 00:34:49',NULL,NULL),(4,'BSPB20141200000020',NULL,'10000000',NULL,'2014-12-17',NULL,'BSB20132014','BSP20141200000001',NULL,'2014-12-23 00:36:04',NULL,NULL),(5,'BSPB20141200000021',NULL,'10000000',NULL,'2014-12-17',NULL,'BSB20132014','BSP20141200000001',NULL,'2014-12-23 00:37:36',NULL,NULL),(6,'BSPB20141200000022',NULL,'10000000',NULL,'2014-12-17',NULL,'BSB20132014','BSP20141200000001',NULL,'2014-12-23 00:38:55',NULL,NULL),(7,'BSPB20141200000023',NULL,'10000000',NULL,'2014-12-17',NULL,'BSB20132014','BSP20141200000001',NULL,'2014-12-23 09:05:24',NULL,NULL),(8,'BSPB20141200000024',NULL,'10000000',NULL,'2014-12-17',NULL,'BSB20132014','BSP20141200000001',NULL,'2014-12-23 09:35:14',NULL,NULL);

/*Table structure for table `bssp_project_consultant` */

DROP TABLE IF EXISTS `bssp_project_consultant`;

CREATE TABLE `bssp_project_consultant` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `legalEntityId` varchar(20) NOT NULL,
  `projectNumber` varchar(20) NOT NULL,
  `principleConsultantName` varchar(256) DEFAULT NULL,
  `MouPsSignedDate` date DEFAULT NULL,
  `consultantId` varchar(20) DEFAULT NULL,
  `status` varchar(15) DEFAULT 'Active',
  `createdBy` varchar(24) DEFAULT NULL,
  `createdOn` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedBy` varchar(24) DEFAULT NULL,
  `modifiedOn` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `bssp_project_consultant` */

insert  into `bssp_project_consultant`(`id`,`legalEntityId`,`projectNumber`,`principleConsultantName`,`MouPsSignedDate`,`consultantId`,`status`,`createdBy`,`createdOn`,`modifiedBy`,`modifiedOn`) values (2,'1','BSP20141200000001','Oswald Amolo','2014-12-10','2','Active',NULL,'2014-12-23 00:33:03',NULL,NULL),(3,'1','BSP20141200000001','Oswald Amolo','2014-12-10','2','Active',NULL,'2014-12-23 00:34:49',NULL,NULL),(4,'1','BSP20141200000001','Oswald Amolo','2014-12-10','2','Active',NULL,'2014-12-23 00:36:04',NULL,NULL),(5,'1','BSP20141200000001','Oswald Amolo','2014-12-10','2','Active',NULL,'2014-12-23 00:37:36',NULL,NULL),(6,'1','BSP20141200000001','Oswald Amolo','2014-12-10','2','Active',NULL,'2014-12-23 00:38:54',NULL,NULL),(7,'1','BSP20141200000001','Oswald Amolo','2014-12-10','2','Active',NULL,'2014-12-23 09:05:24',NULL,NULL),(8,'1','BSP20141200000001','Oswald Amolo','2014-12-10','2','Active',NULL,'2014-12-23 09:35:14',NULL,NULL);

/*Table structure for table `bssp_project_implementation` */

DROP TABLE IF EXISTS `bssp_project_implementation`;

CREATE TABLE `bssp_project_implementation` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `implementationDateOfIssueToPromoters` date DEFAULT NULL,
  `implementationReportType` varchar(1200) NOT NULL,
  `implementationSourceOfFunds` varchar(1200) NOT NULL,
  `implementationRemarks` varchar(1200) DEFAULT NULL,
  `projectNumber` varchar(20) DEFAULT NULL,
  `createdBy` varchar(24) DEFAULT NULL,
  `createdOn` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedBy` varchar(24) DEFAULT NULL,
  `modifiedOn` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_implementation_id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `bssp_project_implementation` */

insert  into `bssp_project_implementation`(`id`,`implementationDateOfIssueToPromoters`,`implementationReportType`,`implementationSourceOfFunds`,`implementationRemarks`,`projectNumber`,`createdBy`,`createdOn`,`modifiedBy`,`modifiedOn`) values (1,'2014-12-18','BUSINESS PLANS','MTI BSSP','Implementation Remarks','BSP20141200000001',NULL,'2014-12-23 00:33:03',NULL,NULL),(2,'2014-12-18','BUSINESS PLANS','MTI BSSP','Implementation Remarks','BSP20141200000001',NULL,'2014-12-23 00:34:49',NULL,NULL),(3,'2014-12-18','BUSINESS PLANS','MTI BSSP','Implementation Remarks','BSP20141200000001',NULL,'2014-12-23 00:36:04',NULL,NULL),(4,'2014-12-18','BUSINESS PLANS','MTI BSSP','Implementation Remarks','BSP20141200000001',NULL,'2014-12-23 00:37:36',NULL,NULL),(5,'2014-12-18','BUSINESS PLANS','MTI BSSP','Implementation Remarks','BSP20141200000001',NULL,'2014-12-23 00:38:55',NULL,NULL),(6,'2014-12-18','BUSINESS PLANS','MTI BSSP','Implementation Remarks','BSP20141200000001',NULL,'2014-12-23 09:05:24',NULL,NULL),(7,'2014-12-18','BUSINESS PLANS','MTI BSSP','Implementation Remarks','BSP20141200000001',NULL,'2014-12-23 09:35:14',NULL,NULL);

/*Table structure for table `bssp_project_numbers_gen` */

DROP TABLE IF EXISTS `bssp_project_numbers_gen`;

CREATE TABLE `bssp_project_numbers_gen` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'Auto incremented numeric value',
  `year` year(4) DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `bssp_project_numbers_gen` */

/*Table structure for table `bssp_project_payment_installments` */

DROP TABLE IF EXISTS `bssp_project_payment_installments`;

CREATE TABLE `bssp_project_payment_installments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `installmentAmount` decimal(12,0) DEFAULT NULL,
  `installmentPhase` varchar(30) NOT NULL COMMENT '[F]irst Instalment , [S]econd Installement , [T]hird Instalment',
  `installmentDateOfPayment` date DEFAULT NULL,
  `installmentBudgetNumber` varchar(20) NOT NULL,
  `createdBy` varchar(24) DEFAULT NULL,
  `createdOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedBy` varchar(24) DEFAULT NULL,
  `modifiedOn` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

/*Data for the table `bssp_project_payment_installments` */

insert  into `bssp_project_payment_installments`(`id`,`installmentAmount`,`installmentPhase`,`installmentDateOfPayment`,`installmentBudgetNumber`,`createdBy`,`createdOn`,`modifiedBy`,`modifiedOn`) values (1,'2500000','first','2014-12-10','BSPB20141200000016',NULL,'2014-12-22 12:13:22',NULL,NULL),(2,'2500000','second','2014-12-11','BSPB20141200000016',NULL,'2014-12-22 12:13:22',NULL,NULL),(6,'5000000','first','2014-12-19','BSPB20141200000018',NULL,'2014-12-23 00:33:03',NULL,NULL),(7,'2500000','second','2014-12-10','BSPB20141200000018',NULL,'2014-12-23 00:33:03',NULL,NULL),(8,'2000000','third','2014-12-10','BSPB20141200000018',NULL,'2014-12-23 00:33:03',NULL,NULL),(9,'5000000','first','2014-12-19','BSPB20141200000019',NULL,'2014-12-23 00:34:49',NULL,NULL),(10,'2500000','second','2014-12-10','BSPB20141200000019',NULL,'2014-12-23 00:34:49',NULL,NULL),(11,'2000000','third','2014-12-10','BSPB20141200000019',NULL,'2014-12-23 00:34:49',NULL,NULL),(12,'5000000','first','2014-12-19','BSPB20141200000020',NULL,'2014-12-23 00:36:04',NULL,NULL),(13,'2500000','second','2014-12-10','BSPB20141200000020',NULL,'2014-12-23 00:36:04',NULL,NULL),(14,'2000000','third','2014-12-10','BSPB20141200000020',NULL,'2014-12-23 00:36:04',NULL,NULL),(15,'5000000','first','2014-12-19','BSPB20141200000021',NULL,'2014-12-23 00:37:36',NULL,NULL),(16,'2500000','second','2014-12-10','BSPB20141200000021',NULL,'2014-12-23 00:37:36',NULL,NULL),(17,'2000000','third','2014-12-10','BSPB20141200000021',NULL,'2014-12-23 00:37:36',NULL,NULL),(18,'5000000','first','2014-12-19','BSPB20141200000022',NULL,'2014-12-23 00:38:55',NULL,NULL),(19,'2500000','second','2014-12-10','BSPB20141200000022',NULL,'2014-12-23 00:38:55',NULL,NULL),(20,'2000000','third','2014-12-10','BSPB20141200000022',NULL,'2014-12-23 00:38:55',NULL,NULL),(21,'5000000','first','2014-12-19','BSPB20141200000023',NULL,'2014-12-23 09:05:24',NULL,NULL),(22,'2500000','second','2014-12-10','BSPB20141200000023',NULL,'2014-12-23 09:05:24',NULL,NULL),(23,'2000000','third','2014-12-10','BSPB20141200000023',NULL,'2014-12-23 09:05:24',NULL,NULL),(24,'5000000','first','2014-12-19','BSPB20141200000024',NULL,'2014-12-23 09:35:14',NULL,NULL),(25,'2500000','second','2014-12-10','BSPB20141200000024',NULL,'2014-12-23 09:35:14',NULL,NULL),(26,'2000000','third','2014-12-10','BSPB20141200000024',NULL,'2014-12-23 09:35:14',NULL,NULL);

/*Table structure for table `bssp_projects` */

DROP TABLE IF EXISTS `bssp_projects`;

CREATE TABLE `bssp_projects` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `number` varchar(20) NOT NULL,
  `name` varchar(80) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `status` varchar(15) DEFAULT 'Active',
  `discussionDate` date DEFAULT NULL,
  `startDate` date DEFAULT NULL,
  `endDate` date DEFAULT NULL,
  `applicationNumber` varchar(20) DEFAULT NULL,
  `requestNumber` varchar(20) DEFAULT NULL,
  `createdBy` varchar(24) DEFAULT NULL,
  `createdOn` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedBy` varchar(24) DEFAULT NULL,
  `modifiedOn` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `bssp_projects` */

insert  into `bssp_projects`(`id`,`number`,`name`,`description`,`status`,`discussionDate`,`startDate`,`endDate`,`applicationNumber`,`requestNumber`,`createdBy`,`createdOn`,`modifiedBy`,`modifiedOn`) values (1,'BSP20141200000001','Business Plans - Textile and Garment','Business Plans - Textile and Garment','NEW',NULL,'2014-12-11','2014-12-11','BSA20141200000001','BSR20141200000001','SYSTEM','2014-12-21 20:02:53',NULL,NULL);

/*Table structure for table `bssp_request_numbers_gen` */

DROP TABLE IF EXISTS `bssp_request_numbers_gen`;

CREATE TABLE `bssp_request_numbers_gen` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'Auto incremented numeric value',
  `year` year(4) DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `bssp_request_numbers_gen` */

/*Table structure for table `bssp_requests` */

DROP TABLE IF EXISTS `bssp_requests`;

CREATE TABLE `bssp_requests` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `requestNumber` varchar(20) DEFAULT NULL,
  `requestType` varchar(128) DEFAULT NULL,
  `requestPriotityArea` varchar(256) DEFAULT NULL,
  `requestBusinessActivity` varchar(1024) DEFAULT NULL,
  `requestStatus` varchar(28) DEFAULT NULL,
  `requestRemarks` varchar(128) DEFAULT NULL,
  `applicationNumber` varchar(20) DEFAULT NULL,
  `createdBy` varchar(24) DEFAULT NULL,
  `createdOn` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedBy` varchar(24) DEFAULT NULL,
  `modifiedOn` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_bssp_request_id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `bssp_requests` */

insert  into `bssp_requests`(`id`,`requestNumber`,`requestType`,`requestPriotityArea`,`requestBusinessActivity`,`requestStatus`,`requestRemarks`,`applicationNumber`,`createdBy`,`createdOn`,`modifiedBy`,`modifiedOn`) values (1,'BSR20141200000001','Business Plans','Textile and Garment','Business Activity One','APPROVED','Priority Area','BSA20141200000001',NULL,'2014-12-21 19:50:19',NULL,'2014-12-21 20:02:53'),(2,'BSR20141200000002','Feasibility Study and Business Plan','Horticulture','Business Activity Two','PENDING','New Application','BSA20141200000001',NULL,'2014-12-21 19:50:19',NULL,'2014-12-21 19:51:11'),(3,'BSR20141200000003','Training','Gemstone cutting and polishing','Business Activity Three','PENDING','New Application','BSA20141200000001',NULL,'2014-12-21 19:50:20',NULL,'2014-12-21 19:51:11');

/*Table structure for table `bssp_resolutions` */

DROP TABLE IF EXISTS `bssp_resolutions`;

CREATE TABLE `bssp_resolutions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `resolutionDiscussionDate` date DEFAULT NULL,
  `resolutionDiscussionStatus` varchar(120) NOT NULL DEFAULT 'PENDING',
  `resolutionCorespondenceDate` date DEFAULT NULL,
  `resolutionRemarks` varchar(4000) DEFAULT NULL,
  `resolution_requestNumber` varchar(20) DEFAULT NULL,
  `createdBy` varchar(24) DEFAULT NULL,
  `createdOn` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedBy` varchar(24) DEFAULT NULL,
  `modifiedOn` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_resolutions_id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `bssp_resolutions` */

insert  into `bssp_resolutions`(`id`,`resolutionDiscussionDate`,`resolutionDiscussionStatus`,`resolutionCorespondenceDate`,`resolutionRemarks`,`resolution_requestNumber`,`createdBy`,`createdOn`,`modifiedBy`,`modifiedOn`) values (1,'2014-12-10','APPROVED','2014-12-24','Priority Area','BSR20141200000001',NULL,'2014-12-21 20:02:53',NULL,NULL);

/*Table structure for table `budgets` */

DROP TABLE IF EXISTS `budgets`;

CREATE TABLE `budgets` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(120) DEFAULT NULL,
  `name` varchar(256) DEFAULT NULL,
  `period` varchar(12) DEFAULT NULL,
  `amount` decimal(12,0) DEFAULT NULL,
  `description` varchar(256) DEFAULT NULL,
  `GLAccount` varchar(50) DEFAULT NULL,
  `createdBy` varchar(24) DEFAULT NULL,
  `createdOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedBy` varchar(24) DEFAULT NULL,
  `modifiedOn` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `budgets` */

/*Table structure for table `country` */

DROP TABLE IF EXISTS `country`;

CREATE TABLE `country` (
  `code` char(3) NOT NULL DEFAULT '',
  `name` char(52) NOT NULL DEFAULT '',
  `continent` enum('Asia','Europe','North America','Africa','Oceania','Antarctica','South America') NOT NULL DEFAULT 'Asia',
  `region` char(26) NOT NULL DEFAULT '',
  `surfaceArea` float(10,2) NOT NULL DEFAULT '0.00',
  `indep_year` smallint(6) DEFAULT NULL,
  `population` int(11) NOT NULL DEFAULT '0',
  `local_name` char(45) NOT NULL DEFAULT '',
  `government_form` char(45) NOT NULL DEFAULT '',
  `capital` int(11) DEFAULT NULL,
  `code2` char(2) NOT NULL DEFAULT '',
  PRIMARY KEY (`code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `country` */

insert  into `country`(`code`,`name`,`continent`,`region`,`surfaceArea`,`indep_year`,`population`,`local_name`,`government_form`,`capital`,`code2`) values ('ABW','Aruba','North America','Caribbean',193.00,NULL,103000,'Aruba','Nonmetropolitan Territory of The Netherlands',129,'AW'),('AFG','Afghanistan','Asia','Southern and Central Asia',652090.00,1919,22720000,'Afganistan/Afqanestan','Islamic Emirate',1,'AF'),('AGO','Angola','Africa','Central Africa',1246700.00,1975,12878000,'Angola','Republic',56,'AO'),('AIA','Anguilla','North America','Caribbean',96.00,NULL,8000,'Anguilla','Dependent Territory of the UK',62,'AI'),('ALB','Albania','Europe','Southern Europe',28748.00,1912,3401200,'ShqipÃ«ria','Republic',34,'AL'),('AND','Andorra','Europe','Southern Europe',468.00,1278,78000,'Andorra','Parliamentary Coprincipality',55,'AD'),('ANT','Netherlands Antilles','North America','Caribbean',800.00,NULL,217000,'Nederlandse Antillen','Nonmetropolitan Territory of The Netherlands',33,'AN'),('ARE','United Arab Emirates','Asia','Middle East',83600.00,1971,2441000,'Al-Imarat al-Â´Arabiya al-Muttahida','Emirate Federation',65,'AE'),('ARG','Argentina','South America','South America',2780400.00,1816,37032000,'Argentina','Federal Republic',69,'AR'),('ARM','Armenia','Asia','Middle East',29800.00,1991,3520000,'Hajastan','Republic',126,'AM'),('ASM','American Samoa','Oceania','Polynesia',199.00,NULL,68000,'Amerika Samoa','US Territory',54,'AS'),('ATA','Antarctica','Antarctica','Antarctica',13120000.00,NULL,0,'Â–','Co-administrated',NULL,'AQ'),('ATF','French Southern territories','Antarctica','Antarctica',7780.00,NULL,0,'Terres australes franÃ§aises','Nonmetropolitan Territory of France',NULL,'TF'),('ATG','Antigua and Barbuda','North America','Caribbean',442.00,1981,68000,'Antigua and Barbuda','Constitutional Monarchy',63,'AG'),('AUS','Australia','Oceania','Australia and New Zealand',7741220.00,1901,18886000,'Australia','Constitutional Monarchy, Federation',135,'AU'),('AUT','Austria','Europe','Western Europe',83859.00,1918,8091800,'Ã–sterreich','Federal Republic',1523,'AT'),('AZE','Azerbaijan','Asia','Middle East',86600.00,1991,7734000,'AzÃ¤rbaycan','Federal Republic',144,'AZ'),('BDI','Burundi','Africa','Eastern Africa',27834.00,1962,6695000,'Burundi/Uburundi','Republic',552,'BI'),('BEL','Belgium','Europe','Western Europe',30518.00,1830,10239000,'BelgiÃ«/Belgique','Constitutional Monarchy, Federation',179,'BE'),('BEN','Benin','Africa','Western Africa',112622.00,1960,6097000,'BÃ©nin','Republic',187,'BJ'),('BFA','Burkina Faso','Africa','Western Africa',274000.00,1960,11937000,'Burkina Faso','Republic',549,'BF'),('BGD','Bangladesh','Asia','Southern and Central Asia',143998.00,1971,129155000,'Bangladesh','Republic',150,'BD'),('BGR','Bulgaria','Europe','Eastern Europe',110994.00,1908,8190900,'Balgarija','Republic',539,'BG'),('BHR','Bahrain','Asia','Middle East',694.00,1971,617000,'Al-Bahrayn','Monarchy (Emirate)',149,'BH'),('BHS','Bahamas','North America','Caribbean',13878.00,1973,307000,'The Bahamas','Constitutional Monarchy',148,'BS'),('BIH','Bosnia and Herzegovina','Europe','Southern Europe',51197.00,1992,3972000,'Bosna i Hercegovina','Federal Republic',201,'BA'),('BLR','Belarus','Europe','Eastern Europe',207600.00,1991,10236000,'Belarus','Republic',3520,'BY'),('BLZ','Belize','North America','Central America',22696.00,1981,241000,'Belize','Constitutional Monarchy',185,'BZ'),('BMU','Bermuda','North America','North America',53.00,NULL,65000,'Bermuda','Dependent Territory of the UK',191,'BM'),('BOL','Bolivia','South America','South America',1098581.00,1825,8329000,'Bolivia','Republic',194,'BO'),('BRA','Brazil','South America','South America',8547403.00,1822,170115000,'Brasil','Federal Republic',211,'BR'),('BRB','Barbados','North America','Caribbean',430.00,1966,270000,'Barbados','Constitutional Monarchy',174,'BB'),('BRN','Brunei','Asia','Southeast Asia',5765.00,1984,328000,'Brunei Darussalam','Monarchy (Sultanate)',538,'BN'),('BTN','Bhutan','Asia','Southern and Central Asia',47000.00,1910,2124000,'Druk-Yul','Monarchy',192,'BT'),('BVT','Bouvet Island','Antarctica','Antarctica',59.00,NULL,0,'BouvetÃ¸ya','Dependent Territory of Norway',NULL,'BV'),('BWA','Botswana','Africa','Southern Africa',581730.00,1966,1622000,'Botswana','Republic',204,'BW'),('CAF','Central African Republic','Africa','Central Africa',622984.00,1960,3615000,'Centrafrique/BÃª-AfrÃ®ka','Republic',1889,'CF'),('CAN','Canada','North America','North America',9970610.00,1867,31147000,'Canada','Constitutional Monarchy, Federation',1822,'CA'),('CCK','Cocos (Keeling) Islands','Oceania','Australia and New Zealand',14.00,NULL,600,'Cocos (Keeling) Islands','Territory of Australia',2317,'CC'),('CHE','Switzerland','Europe','Western Europe',41284.00,1499,7160400,'Schweiz/Suisse/Svizzera/Svizra','Federation',3248,'CH'),('CHL','Chile','South America','South America',756626.00,1810,15211000,'Chile','Republic',554,'CL'),('CHN','China','Asia','Eastern Asia',9572900.00,-1523,1277558000,'Zhongquo','People\'sRepublic',1891,'CN'),('CIV','CÃ´te dÂ’Ivoire','Africa','Western Africa',322463.00,1960,14786000,'CÃ´te dÂ’Ivoire','Republic',2814,'CI'),('CMR','Cameroon','Africa','Central Africa',475442.00,1960,15085000,'Cameroun/Cameroon','Republic',1804,'CM'),('COD','Congo, The Democratic Republic of the','Africa','Central Africa',2344858.00,1960,51654000,'RÃ©publique DÃ©mocratique du Congo','Republic',2298,'CD'),('COG','Congo','Africa','Central Africa',342000.00,1960,2943000,'Congo','Republic',2296,'CG'),('COK','Cook Islands','Oceania','Polynesia',236.00,NULL,20000,'The Cook Islands','Nonmetropolitan Territory of New Zealand',583,'CK'),('COL','Colombia','South America','South America',1138914.00,1810,42321000,'Colombia','Republic',2257,'CO'),('COM','Comoros','Africa','Eastern Africa',1862.00,1975,578000,'Komori/Comores','Republic',2295,'KM'),('CPV','Cape Verde','Africa','Western Africa',4033.00,1975,428000,'Cabo Verde','Republic',1859,'CV'),('CRI','Costa Rica','North America','Central America',51100.00,1821,4023000,'Costa Rica','Republic',584,'CR'),('CUB','Cuba','North America','Caribbean',110861.00,1902,11201000,'Cuba','Socialistic Republic',2413,'CU'),('CXR','Christmas Island','Oceania','Australia and New Zealand',135.00,NULL,2500,'Christmas Island','Territory of Australia',1791,'CX'),('CYM','Cayman Islands','North America','Caribbean',264.00,NULL,38000,'Cayman Islands','Dependent Territory of the UK',553,'KY'),('CYP','Cyprus','Asia','Middle East',9251.00,1960,754700,'KÃ½pros/Kibris','Republic',2430,'CY'),('CZE','Czech Republic','Europe','Eastern Europe',78866.00,1993,10278100,'Â¸esko','Republic',3339,'CZ'),('DEU','Germany','Europe','Western Europe',357022.00,1955,82164700,'Deutschland','Federal Republic',3068,'DE'),('DJI','Djibouti','Africa','Eastern Africa',23200.00,1977,638000,'Djibouti/Jibuti','Republic',585,'DJ'),('DMA','Dominica','North America','Caribbean',751.00,1978,71000,'Dominica','Republic',586,'DM'),('DNK','Denmark','Europe','Nordic Countries',43094.00,800,5330000,'Danmark','Constitutional Monarchy',3315,'DK'),('DOM','Dominican Republic','North America','Caribbean',48511.00,1844,8495000,'RepÃºblica Dominicana','Republic',587,'DO'),('DZA','Algeria','Africa','Northern Africa',2381741.00,1962,31471000,'Al-JazaÂ’ir/AlgÃ©rie','Republic',35,'DZ'),('ECU','Ecuador','South America','South America',283561.00,1822,12646000,'Ecuador','Republic',594,'EC'),('EGY','Egypt','Africa','Northern Africa',1001449.00,1922,68470000,'Misr','Republic',608,'EG'),('ERI','Eritrea','Africa','Eastern Africa',117600.00,1993,3850000,'Ertra','Republic',652,'ER'),('ESH','Western Sahara','Africa','Northern Africa',266000.00,NULL,293000,'As-Sahrawiya','Occupied by Marocco',2453,'EH'),('ESP','Spain','Europe','Southern Europe',505992.00,1492,39441700,'EspaÃ±a','Constitutional Monarchy',653,'ES'),('EST','Estonia','Europe','Baltic Countries',45227.00,1991,1439200,'Eesti','Republic',3791,'EE'),('ETH','Ethiopia','Africa','Eastern Africa',1104300.00,-1000,62565000,'YeItyopÂ´iya','Republic',756,'ET'),('FIN','Finland','Europe','Nordic Countries',338145.00,1917,5171300,'Suomi','Republic',3236,'FI'),('FJI','Fiji Islands','Oceania','Melanesia',18274.00,1970,817000,'Fiji Islands','Republic',764,'FJ'),('FLK','Falkland Islands','South America','South America',12173.00,NULL,2000,'Falkland Islands','Dependent Territory of the UK',763,'FK'),('FRA','France','Europe','Western Europe',551500.00,843,59225700,'France','Republic',2974,'FR'),('FRO','Faroe Islands','Europe','Nordic Countries',1399.00,NULL,43000,'FÃ¸royar','Part of Denmark',901,'FO'),('FSM','Micronesia, Federated States of','Oceania','Micronesia',702.00,1990,119000,'Micronesia','Federal Republic',2689,'FM'),('GAB','Gabon','Africa','Central Africa',267668.00,1960,1226000,'Le Gabon','Republic',902,'GA'),('GBR','United Kingdom','Europe','British Islands',242900.00,1066,59623400,'United Kingdom','Constitutional Monarchy',456,'GB'),('GEO','Georgia','Asia','Middle East',69700.00,1991,4968000,'Sakartvelo','Republic',905,'GE'),('GHA','Ghana','Africa','Western Africa',238533.00,1957,20212000,'Ghana','Republic',910,'GH'),('GIB','Gibraltar','Europe','Southern Europe',6.00,NULL,25000,'Gibraltar','Dependent Territory of the UK',915,'GI'),('GIN','Guinea','Africa','Western Africa',245857.00,1958,7430000,'GuinÃ©e','Republic',926,'GN'),('GLP','Guadeloupe','North America','Caribbean',1705.00,NULL,456000,'Guadeloupe','Overseas Department of France',919,'GP'),('GMB','Gambia','Africa','Western Africa',11295.00,1965,1305000,'The Gambia','Republic',904,'GM'),('GNB','Guinea-Bissau','Africa','Western Africa',36125.00,1974,1213000,'GuinÃ©-Bissau','Republic',927,'GW'),('GNQ','Equatorial Guinea','Africa','Central Africa',28051.00,1968,453000,'Guinea Ecuatorial','Republic',2972,'GQ'),('GRC','Greece','Europe','Southern Europe',131626.00,1830,10545700,'EllÃ¡da','Republic',2401,'GR'),('GRD','Grenada','North America','Caribbean',344.00,1974,94000,'Grenada','Constitutional Monarchy',916,'GD'),('GRL','Greenland','North America','North America',2166090.00,NULL,56000,'Kalaallit Nunaat/GrÃ¸nland','Part of Denmark',917,'GL'),('GTM','Guatemala','North America','Central America',108889.00,1821,11385000,'Guatemala','Republic',922,'GT'),('GUF','French Guiana','South America','South America',90000.00,NULL,181000,'Guyane franÃ§aise','Overseas Department of France',3014,'GF'),('GUM','Guam','Oceania','Micronesia',549.00,NULL,168000,'Guam','US Territory',921,'GU'),('GUY','Guyana','South America','South America',214969.00,1966,861000,'Guyana','Republic',928,'GY'),('HKG','Hong Kong','Asia','Eastern Asia',1075.00,NULL,6782000,'Xianggang/Hong Kong','Special Administrative Region of China',937,'HK'),('HMD','Heard Island and McDonald Islands','Antarctica','Antarctica',359.00,NULL,0,'Heard and McDonald Islands','Territory of Australia',NULL,'HM'),('HND','Honduras','North America','Central America',112088.00,1838,6485000,'Honduras','Republic',933,'HN'),('HRV','Croatia','Europe','Southern Europe',56538.00,1991,4473000,'Hrvatska','Republic',2409,'HR'),('HTI','Haiti','North America','Caribbean',27750.00,1804,8222000,'HaÃ¯ti/Dayti','Republic',929,'HT'),('HUN','Hungary','Europe','Eastern Europe',93030.00,1918,10043200,'MagyarorszÃ¡g','Republic',3483,'HU'),('IDN','Indonesia','Asia','Southeast Asia',1904569.00,1945,212107000,'Indonesia','Republic',939,'ID'),('IND','India','Asia','Southern and Central Asia',3287263.00,1947,1013662000,'Bharat/India','Federal Republic',1109,'IN'),('IOT','British Indian Ocean Territory','Africa','Eastern Africa',78.00,NULL,0,'British Indian Ocean Territory','Dependent Territory of the UK',NULL,'IO'),('IRL','Ireland','Europe','British Islands',70273.00,1921,3775100,'Ireland/Ã‰ire','Republic',1447,'IE'),('IRN','Iran','Asia','Southern and Central Asia',1648195.00,1906,67702000,'Iran','Islamic Republic',1380,'IR'),('IRQ','Iraq','Asia','Middle East',438317.00,1932,23115000,'Al-Â´Iraq','Republic',1365,'IQ'),('ISL','Iceland','Europe','Nordic Countries',103000.00,1944,279000,'Ãsland','Republic',1449,'IS'),('ISR','Israel','Asia','Middle East',21056.00,1948,6217000,'YisraÂ’el/IsraÂ’il','Republic',1450,'IL'),('ITA','Italy','Europe','Southern Europe',301316.00,1861,57680000,'Italia','Republic',1464,'IT'),('JAM','Jamaica','North America','Caribbean',10990.00,1962,2583000,'Jamaica','Constitutional Monarchy',1530,'JM'),('JOR','Jordan','Asia','Middle East',88946.00,1946,5083000,'Al-Urdunn','Constitutional Monarchy',1786,'JO'),('JPN','Japan','Asia','Eastern Asia',377829.00,-660,126714000,'Nihon/Nippon','Constitutional Monarchy',1532,'JP'),('KAZ','Kazakstan','Asia','Southern and Central Asia',2724900.00,1991,16223000,'Qazaqstan','Republic',1864,'KZ'),('KEN','Kenya','Africa','Eastern Africa',580367.00,1963,30080000,'Kenya','Republic',1881,'KE'),('KGZ','Kyrgyzstan','Asia','Southern and Central Asia',199900.00,1991,4699000,'Kyrgyzstan','Republic',2253,'KG'),('KHM','Cambodia','Asia','Southeast Asia',181035.00,1953,11168000,'KÃ¢mpuchÃ©a','Constitutional Monarchy',1800,'KH'),('KIR','Kiribati','Oceania','Micronesia',726.00,1979,83000,'Kiribati','Republic',2256,'KI'),('KNA','Saint Kitts and Nevis','North America','Caribbean',261.00,1983,38000,'Saint Kitts and Nevis','Constitutional Monarchy',3064,'KN'),('KOR','South Korea','Asia','Eastern Asia',99434.00,1948,46844000,'Taehan MinÂ’guk (Namhan)','Republic',2331,'KR'),('KWT','Kuwait','Asia','Middle East',17818.00,1961,1972000,'Al-Kuwayt','Constitutional Monarchy (Emirate)',2429,'KW'),('LAO','Laos','Asia','Southeast Asia',236800.00,1953,5433000,'Lao','Republic',2432,'LA'),('LBN','Lebanon','Asia','Middle East',10400.00,1941,3282000,'Lubnan','Republic',2438,'LB'),('LBR','Liberia','Africa','Western Africa',111369.00,1847,3154000,'Liberia','Republic',2440,'LR'),('LBY','Libyan Arab Jamahiriya','Africa','Northern Africa',1759540.00,1951,5605000,'Libiya','Socialistic State',2441,'LY'),('LCA','Saint Lucia','North America','Caribbean',622.00,1979,154000,'Saint Lucia','Constitutional Monarchy',3065,'LC'),('LIE','Liechtenstein','Europe','Western Europe',160.00,1806,32300,'Liechtenstein','Constitutional Monarchy',2446,'LI'),('LKA','Sri Lanka','Asia','Southern and Central Asia',65610.00,1948,18827000,'Sri Lanka/Ilankai','Republic',3217,'LK'),('LSO','Lesotho','Africa','Southern Africa',30355.00,1966,2153000,'Lesotho','Constitutional Monarchy',2437,'LS'),('LTU','Lithuania','Europe','Baltic Countries',65301.00,1991,3698500,'Lietuva','Republic',2447,'LT'),('LUX','Luxembourg','Europe','Western Europe',2586.00,1867,435700,'Luxembourg/LÃ«tzebuerg','Constitutional Monarchy',2452,'LU'),('LVA','Latvia','Europe','Baltic Countries',64589.00,1991,2424200,'Latvija','Republic',2434,'LV'),('MAC','Macao','Asia','Eastern Asia',18.00,NULL,473000,'Macau/Aomen','Special Administrative Region of China',2454,'MO'),('MAR','Morocco','Africa','Northern Africa',446550.00,1956,28351000,'Al-Maghrib','Constitutional Monarchy',2486,'MA'),('MCO','Monaco','Europe','Western Europe',1.50,1861,34000,'Monaco','Constitutional Monarchy',2695,'MC'),('MDA','Moldova','Europe','Eastern Europe',33851.00,1991,4380000,'Moldova','Republic',2690,'MD'),('MDG','Madagascar','Africa','Eastern Africa',587041.00,1960,15942000,'Madagasikara/Madagascar','Federal Republic',2455,'MG'),('MDV','Maldives','Asia','Southern and Central Asia',298.00,1965,286000,'Dhivehi Raajje/Maldives','Republic',2463,'MV'),('MEX','Mexico','North America','Central America',1958201.00,1810,98881000,'MÃ©xico','Federal Republic',2515,'MX'),('MHL','Marshall Islands','Oceania','Micronesia',181.00,1990,64000,'Marshall Islands/Majol','Republic',2507,'MH'),('MKD','Macedonia','Europe','Southern Europe',25713.00,1991,2024000,'Makedonija','Republic',2460,'MK'),('MLI','Mali','Africa','Western Africa',1240192.00,1960,11234000,'Mali','Republic',2482,'ML'),('MLT','Malta','Europe','Southern Europe',316.00,1964,380200,'Malta','Republic',2484,'MT'),('MMR','Myanmar','Asia','Southeast Asia',676578.00,1948,45611000,'Myanma Pye','Republic',2710,'MM'),('MNG','Mongolia','Asia','Eastern Asia',1566500.00,1921,2662000,'Mongol Uls','Republic',2696,'MN'),('MNP','Northern Mariana Islands','Oceania','Micronesia',464.00,NULL,78000,'Northern Mariana Islands','Commonwealth of the US',2913,'MP'),('MOZ','Mozambique','Africa','Eastern Africa',801590.00,1975,19680000,'MoÃ§ambique','Republic',2698,'MZ'),('MRT','Mauritania','Africa','Western Africa',1025520.00,1960,2670000,'Muritaniya/Mauritanie','Republic',2509,'MR'),('MSR','Montserrat','North America','Caribbean',102.00,NULL,11000,'Montserrat','Dependent Territory of the UK',2697,'MS'),('MTQ','Martinique','North America','Caribbean',1102.00,NULL,395000,'Martinique','Overseas Department of France',2508,'MQ'),('MUS','Mauritius','Africa','Eastern Africa',2040.00,1968,1158000,'Mauritius','Republic',2511,'MU'),('MWI','Malawi','Africa','Eastern Africa',118484.00,1964,10925000,'Malawi','Republic',2462,'MW'),('MYS','Malaysia','Asia','Southeast Asia',329758.00,1957,22244000,'Malaysia','Constitutional Monarchy, Federation',2464,'MY'),('MYT','Mayotte','Africa','Eastern Africa',373.00,NULL,149000,'Mayotte','Territorial Collectivity of France',2514,'YT'),('NAM','Namibia','Africa','Southern Africa',824292.00,1990,1726000,'Namibia','Republic',2726,'NA'),('NCL','New Caledonia','Oceania','Melanesia',18575.00,NULL,214000,'Nouvelle-CalÃ©donie','Nonmetropolitan Territory of France',3493,'NC'),('NER','Niger','Africa','Western Africa',1267000.00,1960,10730000,'Niger','Republic',2738,'NE'),('NFK','Norfolk Island','Oceania','Australia and New Zealand',36.00,NULL,2000,'Norfolk Island','Territory of Australia',2806,'NF'),('NGA','Nigeria','Africa','Western Africa',923768.00,1960,111506000,'Nigeria','Federal Republic',2754,'NG'),('NIC','Nicaragua','North America','Central America',130000.00,1838,5074000,'Nicaragua','Republic',2734,'NI'),('NIU','Niue','Oceania','Polynesia',260.00,NULL,2000,'Niue','Nonmetropolitan Territory of New Zealand',2805,'NU'),('NLD','Netherlands','Europe','Western Europe',41526.00,1581,15864000,'Nederland','Constitutional Monarchy',5,'NL'),('NOR','Norway','Europe','Nordic Countries',323877.00,1905,4478500,'Norge','Constitutional Monarchy',2807,'NO'),('NPL','Nepal','Asia','Southern and Central Asia',147181.00,1769,23930000,'Nepal','Constitutional Monarchy',2729,'NP'),('NRU','Nauru','Oceania','Micronesia',21.00,1968,12000,'Naoero/Nauru','Republic',2728,'NR'),('NZL','New Zealand','Oceania','Australia and New Zealand',270534.00,1907,3862000,'New Zealand/Aotearoa','Constitutional Monarchy',3499,'NZ'),('OMN','Oman','Asia','Middle East',309500.00,1951,2542000,'Â´Uman','Monarchy (Sultanate)',2821,'OM'),('PAK','Pakistan','Asia','Southern and Central Asia',796095.00,1947,156483000,'Pakistan','Republic',2831,'PK'),('PAN','Panama','North America','Central America',75517.00,1903,2856000,'PanamÃ¡','Republic',2882,'PA'),('PCN','Pitcairn','Oceania','Polynesia',49.00,NULL,50,'Pitcairn','Dependent Territory of the UK',2912,'PN'),('PER','Peru','South America','South America',1285216.00,1821,25662000,'PerÃº/Piruw','Republic',2890,'PE'),('PHL','Philippines','Asia','Southeast Asia',300000.00,1946,75967000,'Pilipinas','Republic',766,'PH'),('PLW','Palau','Oceania','Micronesia',459.00,1994,19000,'Belau/Palau','Republic',2881,'PW'),('PNG','Papua New Guinea','Oceania','Melanesia',462840.00,1975,4807000,'Papua New Guinea/Papua Niugini','Constitutional Monarchy',2884,'PG'),('POL','Poland','Europe','Eastern Europe',323250.00,1918,38653600,'Polska','Republic',2928,'PL'),('PRI','Puerto Rico','North America','Caribbean',8875.00,NULL,3869000,'Puerto Rico','Commonwealth of the US',2919,'PR'),('PRK','North Korea','Asia','Eastern Asia',120538.00,1948,24039000,'Choson Minjujuui InÂ´min Konghwaguk (Bukhan)','Socialistic Republic',2318,'KP'),('PRT','Portugal','Europe','Southern Europe',91982.00,1143,9997600,'Portugal','Republic',2914,'PT'),('PRY','Paraguay','South America','South America',406752.00,1811,5496000,'Paraguay','Republic',2885,'PY'),('PSE','Palestine','Asia','Middle East',6257.00,NULL,3101000,'Filastin','Autonomous Area',4074,'PS'),('PYF','French Polynesia','Oceania','Polynesia',4000.00,NULL,235000,'PolynÃ©sie franÃ§aise','Nonmetropolitan Territory of France',3016,'PF'),('QAT','Qatar','Asia','Middle East',11000.00,1971,599000,'Qatar','Monarchy',2973,'QA'),('REU','RÃ©union','Africa','Eastern Africa',2510.00,NULL,699000,'RÃ©union','Overseas Department of France',3017,'RE'),('ROM','Romania','Europe','Eastern Europe',238391.00,1878,22455500,'RomÃ¢nia','Republic',3018,'RO'),('RUS','Russian Federation','Europe','Eastern Europe',17075400.00,1991,146934000,'Rossija','Federal Republic',3580,'RU'),('RWA','Rwanda','Africa','Eastern Africa',26338.00,1962,7733000,'Rwanda/Urwanda','Republic',3047,'RW'),('SAU','Saudi Arabia','Asia','Middle East',2149690.00,1932,21607000,'Al-Â´Arabiya as-SaÂ´udiya','Monarchy',3173,'SA'),('SDN','Sudan','Africa','Northern Africa',2505813.00,1956,29490000,'As-Sudan','Islamic Republic',3225,'SD'),('SEN','Senegal','Africa','Western Africa',196722.00,1960,9481000,'SÃ©nÃ©gal/Sounougal','Republic',3198,'SN'),('SGP','Singapore','Asia','Southeast Asia',618.00,1965,3567000,'Singapore/Singapura/Xinjiapo/Singapur','Republic',3208,'SG'),('SGS','South Georgia and the South Sandwich Islands','Antarctica','Antarctica',3903.00,NULL,0,'South Georgia and the South Sandwich Islands','Dependent Territory of the UK',NULL,'GS'),('SHN','Saint Helena','Africa','Western Africa',314.00,NULL,6000,'Saint Helena','Dependent Territory of the UK',3063,'SH'),('SJM','Svalbard and Jan Mayen','Europe','Nordic Countries',62422.00,NULL,3200,'Svalbard og Jan Mayen','Dependent Territory of Norway',938,'SJ'),('SLB','Solomon Islands','Oceania','Melanesia',28896.00,1978,444000,'Solomon Islands','Constitutional Monarchy',3161,'SB'),('SLE','Sierra Leone','Africa','Western Africa',71740.00,1961,4854000,'Sierra Leone','Republic',3207,'SL'),('SLV','El Salvador','North America','Central America',21041.00,1841,6276000,'El Salvador','Republic',645,'SV'),('SMR','San Marino','Europe','Southern Europe',61.00,885,27000,'San Marino','Republic',3171,'SM'),('SOM','Somalia','Africa','Eastern Africa',637657.00,1960,10097000,'Soomaaliya','Republic',3214,'SO'),('SPM','Saint Pierre and Miquelon','North America','North America',242.00,NULL,7000,'Saint-Pierre-et-Miquelon','Territorial Collectivity of France',3067,'PM'),('STP','Sao Tome and Principe','Africa','Central Africa',964.00,1975,147000,'SÃ£o TomÃ© e PrÃ­ncipe','Republic',3172,'ST'),('SUR','Suriname','South America','South America',163265.00,1975,417000,'Suriname','Republic',3243,'SR'),('SVK','Slovakia','Europe','Eastern Europe',49012.00,1993,5398700,'Slovensko','Republic',3209,'SK'),('SVN','Slovenia','Europe','Southern Europe',20256.00,1991,1987800,'Slovenija','Republic',3212,'SI'),('SWE','Sweden','Europe','Nordic Countries',449964.00,836,8861400,'Sverige','Constitutional Monarchy',3048,'SE'),('SWZ','Swaziland','Africa','Southern Africa',17364.00,1968,1008000,'kaNgwane','Monarchy',3244,'SZ'),('SYC','Seychelles','Africa','Eastern Africa',455.00,1976,77000,'Sesel/Seychelles','Republic',3206,'SC'),('SYR','Syria','Asia','Middle East',185180.00,1941,16125000,'Suriya','Republic',3250,'SY'),('TCA','Turks and Caicos Islands','North America','Caribbean',430.00,NULL,17000,'The Turks and Caicos Islands','Dependent Territory of the UK',3423,'TC'),('TCD','Chad','Africa','Central Africa',1284000.00,1960,7651000,'Tchad/Tshad','Republic',3337,'TD'),('TGO','Togo','Africa','Western Africa',56785.00,1960,4629000,'Togo','Republic',3332,'TG'),('THA','Thailand','Asia','Southeast Asia',513115.00,1350,61399000,'Prathet Thai','Constitutional Monarchy',3320,'TH'),('TJK','Tajikistan','Asia','Southern and Central Asia',143100.00,1991,6188000,'ToÃ§ikiston','Republic',3261,'TJ'),('TKL','Tokelau','Oceania','Polynesia',12.00,NULL,2000,'Tokelau','Nonmetropolitan Territory of New Zealand',3333,'TK'),('TKM','Turkmenistan','Asia','Southern and Central Asia',488100.00,1991,4459000,'TÃ¼rkmenostan','Republic',3419,'TM'),('TMP','East Timor','Asia','Southeast Asia',14874.00,NULL,885000,'Timor Timur','Administrated by the UN',1522,'TP'),('TON','Tonga','Oceania','Polynesia',650.00,1970,99000,'Tonga','Monarchy',3334,'TO'),('TTO','Trinidad and Tobago','North America','Caribbean',5130.00,1962,1295000,'Trinidad and Tobago','Republic',3336,'TT'),('TUN','Tunisia','Africa','Northern Africa',163610.00,1956,9586000,'Tunis/Tunisie','Republic',3349,'TN'),('TUR','Turkey','Asia','Middle East',774815.00,1923,66591000,'TÃ¼rkiye','Republic',3358,'TR'),('TUV','Tuvalu','Oceania','Polynesia',26.00,1978,12000,'Tuvalu','Constitutional Monarchy',3424,'TV'),('TWN','Taiwan','Asia','Eastern Asia',36188.00,1945,22256000,'TÂ’ai-wan','Republic',3263,'TW'),('TZA','Tanzania','Africa','Eastern Africa',883749.00,1961,33517000,'Tanzania','Republic',3306,'TZ'),('UGA','Uganda','Africa','Eastern Africa',241038.00,1962,21778000,'Uganda','Republic',3425,'UG'),('UKR','Ukraine','Europe','Eastern Europe',603700.00,1991,50456000,'Ukrajina','Republic',3426,'UA'),('UMI','United States Minor Outlying Islands','Oceania','Micronesia/Caribbean',16.00,NULL,0,'United States Minor Outlying Islands','Dependent Territory of the US',NULL,'UM'),('URY','Uruguay','South America','South America',175016.00,1828,3337000,'Uruguay','Republic',3492,'UY'),('USA','United States','North America','North America',9363520.00,1776,278357000,'United States','Federal Republic',3813,'US'),('UZB','Uzbekistan','Asia','Southern and Central Asia',447400.00,1991,24318000,'Uzbekiston','Republic',3503,'UZ'),('VAT','Holy See (Vatican City State)','Europe','Southern Europe',0.40,1929,1000,'Santa Sede/CittÃ  del Vaticano','Independent Church State',3538,'VA'),('VCT','Saint Vincent and the Grenadines','North America','Caribbean',388.00,1979,114000,'Saint Vincent and the Grenadines','Constitutional Monarchy',3066,'VC'),('VEN','Venezuela','South America','South America',912050.00,1811,24170000,'Venezuela','Federal Republic',3539,'VE'),('VGB','Virgin Islands, British','North America','Caribbean',151.00,NULL,21000,'British Virgin Islands','Dependent Territory of the UK',537,'VG'),('VIR','Virgin Islands, U.S.','North America','Caribbean',347.00,NULL,93000,'Virgin Islands of the United States','US Territory',4067,'VI'),('VNM','Vietnam','Asia','Southeast Asia',331689.00,1945,79832000,'ViÃªt Nam','Socialistic Republic',3770,'VN'),('VUT','Vanuatu','Oceania','Melanesia',12189.00,1980,190000,'Vanuatu','Republic',3537,'VU'),('WLF','Wallis and Futuna','Oceania','Polynesia',200.00,NULL,15000,'Wallis-et-Futuna','Nonmetropolitan Territory of France',3536,'WF'),('WSM','Samoa','Oceania','Polynesia',2831.00,1962,180000,'Samoa','Parlementary Monarchy',3169,'WS'),('YEM','Yemen','Asia','Middle East',527968.00,1918,18112000,'Al-Yaman','Republic',1780,'YE'),('YUG','Yugoslavia','Europe','Southern Europe',102173.00,1918,10640000,'Jugoslavija','Federal Republic',1792,'YU'),('ZAF','South Africa','Africa','Southern Africa',1221037.00,1910,40377000,'South Africa','Republic',716,'ZA'),('ZMB','Zambia','Africa','Eastern Africa',752618.00,1964,9169000,'Zambia','Republic',3162,'ZM'),('ZWE','Zimbabwe','Africa','Eastern Africa',390757.00,1980,11669000,'Zimbabwe','Republic',4068,'ZW');

/*Table structure for table `deposits` */

DROP TABLE IF EXISTS `deposits`;

CREATE TABLE `deposits` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(12) DEFAULT NULL,
  `received` decimal(10,2) DEFAULT NULL,
  `refunded` decimal(10,2) DEFAULT NULL,
  `auctionId` bigint(20) DEFAULT NULL,
  `buyerId` bigint(20) DEFAULT NULL,
  `createdBy` varchar(24) DEFAULT NULL,
  `createdOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedBy` varchar(24) DEFAULT NULL,
  `modifiedOn` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `deposits` */

/*Table structure for table `extensions` */

DROP TABLE IF EXISTS `extensions`;

CREATE TABLE `extensions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `phase` varchar(30) DEFAULT NULL COMMENT '[F]irst phase , [S]econd phase',
  `discussionDate` date DEFAULT NULL,
  `extendedToDate` date DEFAULT NULL,
  `remarks` varchar(1200) NOT NULL,
  `projectNumber` varchar(15) DEFAULT NULL,
  `createdBy` varchar(24) DEFAULT NULL,
  `createdOn` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedBy` varchar(24) DEFAULT NULL,
  `modifiedOn` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_assignment_extensions_id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `extensions` */

/*Table structure for table `funds_payment` */

DROP TABLE IF EXISTS `funds_payment`;

CREATE TABLE `funds_payment` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `fundsId` bigint(20) DEFAULT NULL,
  `paymentId` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `funds_payment` */

/*Table structure for table `implementation` */

DROP TABLE IF EXISTS `implementation`;

CREATE TABLE `implementation` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `discussionDate` date DEFAULT NULL,
  `dateIssuedToPromoters` date DEFAULT NULL,
  `reportType` varchar(1200) NOT NULL,
  `sourceOfFunds` varchar(1200) NOT NULL,
  `numberOfMaleEmployed` int(11) DEFAULT NULL,
  `numberOfFemaleEmployed` int(11) DEFAULT NULL,
  `implementationRemarks` varchar(1200) NOT NULL,
  `projectNumber` varchar(15) DEFAULT NULL,
  `createdBy` varchar(24) DEFAULT NULL,
  `createdOn` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedBy` varchar(24) DEFAULT NULL,
  `modifiedOn` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_implementation_id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `implementation` */

/*Table structure for table `payments` */

DROP TABLE IF EXISTS `payments`;

CREATE TABLE `payments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `amount` decimal(12,0) DEFAULT NULL,
  `phase` varchar(30) NOT NULL COMMENT '[F]irst Instalment , [S]econd Installement , [T]hird Instalment',
  `dateOfPayment` date DEFAULT NULL,
  `fundsId` bigint(20) NOT NULL,
  `remarks` text,
  `createdBy` varchar(24) DEFAULT NULL,
  `createdOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedBy` varchar(24) DEFAULT NULL,
  `modifiedOn` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `payments` */

/*Table structure for table `permissions` */

DROP TABLE IF EXISTS `permissions`;

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_role` int(11) NOT NULL,
  `id_resource` int(11) NOT NULL,
  `permission` enum('allow','deny') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `permissions` */

insert  into `permissions`(`id`,`id_role`,`id_resource`,`permission`) values (1,3,1,'allow'),(2,1,2,'allow'),(3,2,3,'deny');

/*Table structure for table `ref_cities_towns` */

DROP TABLE IF EXISTS `ref_cities_towns`;

CREATE TABLE `ref_cities_towns` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(128) DEFAULT NULL,
  `name` varchar(128) DEFAULT NULL,
  `isActive` tinyint(1) DEFAULT '1',
  `description` varchar(128) DEFAULT NULL,
  `regionCode` varchar(128) DEFAULT NULL,
  `createdBy` varchar(24) DEFAULT NULL,
  `createdOn` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedBy` varchar(24) DEFAULT NULL,
  `modifiedOn` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=148 DEFAULT CHARSET=utf8;

/*Data for the table `ref_cities_towns` */

insert  into `ref_cities_towns`(`id`,`code`,`name`,`isActive`,`description`,`regionCode`,`createdBy`,`createdOn`,`modifiedBy`,`modifiedOn`) values (2,'KATIMA MULILO','KATIMA MULILO',1,NULL,'ZAMBEZI',NULL,NULL,NULL,NULL),(3,'CHINCHIMANI','CHINCHIMANI',1,NULL,'ZAMBEZI',NULL,NULL,NULL,NULL),(4,'KONGOLA','KONGOLA',1,NULL,'ZAMBEZI',NULL,NULL,NULL,NULL),(5,'LINYANTI','LINYANTI',1,NULL,'ZAMBEZI',NULL,NULL,NULL,NULL),(6,'MAFUTA','MAFUTA',1,NULL,'ZAMBEZI',NULL,NULL,NULL,NULL),(7,'SANGWALI','SANGWALI',1,NULL,'ZAMBEZI',NULL,NULL,NULL,NULL),(8,'SIBINDA','SIBINDA',0,NULL,'ZAMBEZI',NULL,NULL,NULL,NULL),(9,'BUKALO','BUKALO',1,NULL,'ZAMBEZI',NULL,NULL,NULL,NULL),(10,'LUSESE','LUSESE',1,NULL,'ZAMBEZI',NULL,NULL,NULL,NULL),(11,'NGOMA','NGOMA',1,NULL,'ZAMBEZI',NULL,NULL,NULL,NULL),(12,'KARIBIB','KARIBIB',1,NULL,'ERONGO',NULL,NULL,NULL,NULL),(13,'NAMPOL OKOMBAHE','NAMPOL OKOMBAHE',1,NULL,'ERONGO',NULL,NULL,NULL,NULL),(14,'HENTIESBAAI','HENTIESBAAI',1,NULL,'ERONGO',NULL,NULL,NULL,NULL),(15,'OMATJETTE','OMATJETTE',1,NULL,'ERONGO',NULL,NULL,NULL,NULL),(16,'OTJIMBINGWE','OTJIMBINGWE',1,NULL,'ERONGO',NULL,NULL,NULL,NULL),(17,'SWAKOPMUND','SWAKOPMUND',1,NULL,'ERONGO',NULL,NULL,NULL,NULL),(18,'USAKOS','USAKOS',0,NULL,'ERONGO',NULL,NULL,NULL,NULL),(19,'WALVIS BAY','WALVIS BAY',1,NULL,'ERONGO',NULL,NULL,NULL,NULL),(20,'WLOTZKASBAKEN','WLOTZKASBAKEN',1,NULL,'ERONGO',NULL,NULL,NULL,NULL),(21,'ARANOS','ARANOS',1,NULL,'HARDAP',NULL,NULL,NULL,NULL),(22,'GIBEON','GIBEON',1,NULL,'HARDAP',NULL,NULL,NULL,NULL),(23,'GOCHAS','GOCHAS',1,NULL,'HARDAP',NULL,NULL,NULL,NULL),(24,'KALKRAND','KALKRAND',1,NULL,'HARDAP',NULL,NULL,NULL,NULL),(25,'MALTAH','MALTAH',1,NULL,'HARDAP',NULL,NULL,NULL,NULL),(26,'MARIENTAL','MARIENTAL',1,NULL,'HARDAP',NULL,NULL,NULL,NULL),(27,'REHOBOTH','REHOBOTH',1,NULL,'HARDAP',NULL,NULL,NULL,NULL),(28,'STAMPRIET','STAMPRIET',1,NULL,'HARDAP',NULL,NULL,NULL,NULL),(29,'DUINEVELD','DUINEVELD',1,NULL,'HARDAP',NULL,NULL,NULL,NULL),(30,'HOACHANAS','HOACHANAS',1,NULL,'HARDAP',NULL,NULL,NULL,NULL),(31,'KLEIN AUB','KLEIN AUB',1,NULL,'HARDAP',NULL,NULL,NULL,NULL),(32,'RIETOOG','RIETOOG',1,NULL,'HARDAP',NULL,NULL,NULL,NULL),(33,'SCHLIP','SCHLIP',1,NULL,'HARDAP',NULL,NULL,NULL,NULL),(34,'AMPER-BO','AMPER-BO',1,NULL,'HARDAP',NULL,NULL,NULL,NULL),(35,'KRIES','KRIES',1,NULL,'HARDAP',NULL,NULL,NULL,NULL),(36,'UIBIS','UIBIS',1,NULL,'HARDAP',NULL,NULL,NULL,NULL),(37,'AROAB','AROAB',1,NULL,'KARAS',NULL,NULL,NULL,NULL),(38,'BERSEBA','BERSEBA',1,NULL,'KARAS',NULL,NULL,NULL,NULL),(39,'BETHANIE','BETHANIE',1,NULL,'KARAS',NULL,NULL,NULL,NULL),(40,'GRUNAU','GRUNAU',1,NULL,'KARAS',NULL,NULL,NULL,NULL),(41,'KARASBURG','KARASBURG',1,NULL,'KARAS',NULL,NULL,NULL,NULL),(42,'KEETMANSHOOP','KEETMANSHOOP',1,NULL,'KARAS',NULL,NULL,NULL,NULL),(43,'KOES','KOES',1,NULL,'KARAS',NULL,NULL,NULL,NULL),(44,'LUDERITZ','LUDERITZ',1,NULL,'KARAS',NULL,NULL,NULL,NULL),(45,'NOORDOEWER','NOORDOEWER',1,NULL,'KARAS',NULL,NULL,NULL,NULL),(46,'ORANJEMUND','ORANJEMUND',1,NULL,'KARAS',NULL,NULL,NULL,NULL),(47,'ROSH PINAH','ROSH PINAH',1,NULL,'KARAS',NULL,NULL,NULL,NULL),(48,'TSES','TSES',1,NULL,'KARAS',NULL,NULL,NULL,NULL),(49,'ARIAMSVLEI','ARIAMSVLEI',1,NULL,'KARAS',NULL,NULL,NULL,NULL),(50,'AUS','AUS',1,NULL,'KARAS',NULL,NULL,NULL,NULL),(51,'AUSSENKEHR','AUSSENKEHR',1,NULL,'KARAS',NULL,NULL,NULL,NULL),(52,'WARMBAD','WARMBAD',1,NULL,'KARAS',NULL,NULL,NULL,NULL),(53,'RUNDU','RUNDU',1,NULL,'KAVANGO',NULL,NULL,NULL,NULL),(54,'DIVUNDU','DIVUNDU',1,NULL,'KAVANGO',NULL,NULL,NULL,NULL),(55,'KAPAKO','KAPAKO',1,NULL,'KAVANGO',NULL,NULL,NULL,NULL),(56,'KAYENGONA','KAYENGONA',1,NULL,'KAVANGO',NULL,NULL,NULL,NULL),(57,'MABUSHE','MABUSHE',1,NULL,'KAVANGO',NULL,NULL,NULL,NULL),(58,'MUKWE','MUKWE',1,NULL,'KAVANGO',NULL,NULL,NULL,NULL),(59,'MURORO-MASHARI','MURORO-MASHARI',1,NULL,'KAVANGO',NULL,NULL,NULL,NULL),(60,'MURURANI-GATE','MURURANI-GATE',1,NULL,'KAVANGO',NULL,NULL,NULL,NULL),(61,'NDIYONA','NDIYONA',1,NULL,'KAVANGO',NULL,NULL,NULL,NULL),(62,'NKAMAGORO','NKAMAGORO',1,NULL,'KAVANGO',NULL,NULL,NULL,NULL),(63,'NKURENKURU (KAHENGE)','NKURENKURU (KAHENGE)',1,NULL,'KAVANGO',NULL,NULL,NULL,NULL),(64,'OMEGA','OMEGA',1,NULL,'KAVANGO',NULL,NULL,NULL,NULL),(65,'WINDHOEK','WINDHOEK',1,NULL,'KHOMAS',NULL,NULL,NULL,NULL),(66,'GROOT AUB','GROOT AUB',1,NULL,'KHOMAS',NULL,NULL,NULL,NULL),(67,'ARIS','ARIS',1,NULL,'KHOMAS',NULL,NULL,NULL,NULL),(68,'DORDABIS','DORDABIS',1,NULL,'KHOMAS',NULL,NULL,NULL,NULL),(69,'KAPPSFARM','KAPPSFARM',1,NULL,'KHOMAS',NULL,NULL,NULL,NULL),(70,'KAMANJAB','KAMANJAB',0,NULL,'KUNENE',NULL,NULL,NULL,NULL),(71,'KHORIXAS','KHORIXAS',1,NULL,'KUNENE',NULL,NULL,NULL,NULL),(72,'OPUWO','OPUWO',1,NULL,'KUNENE',NULL,NULL,NULL,NULL),(73,'OUTJO','OUTJO',1,NULL,'KUNENE',NULL,NULL,NULL,NULL),(74,'SESFONTEIN','SESFONTEIN',1,NULL,'KUNENE',NULL,NULL,NULL,NULL),(75,'FRANSFONTEIN','FRANSFONTEIN',1,NULL,'KUNENE',NULL,NULL,NULL,NULL),(76,'OKANGWATI','OKANGWATI',1,NULL,'KUNENE',NULL,NULL,NULL,NULL),(77,'EENHANA','EENHANA',1,NULL,'OHANGWENA',NULL,NULL,NULL,NULL),(78,'ENDOLA','ENDOLA',1,NULL,'OHANGWENA',NULL,NULL,NULL,NULL),(79,'ENGELA-OMAFU','ENGELA-OMAFU',1,NULL,'OHANGWENA',NULL,NULL,NULL,NULL),(80,'EPEMBE','EPEMBE',1,NULL,'OHANGWENA',NULL,NULL,NULL,NULL),(81,'ODIBO','ODIBO',1,NULL,'OHANGWENA',NULL,NULL,NULL,NULL),(82,'OHAINGU','OHAINGU',1,NULL,'OHANGWENA',NULL,NULL,NULL,NULL),(83,'OHANGWENA','OHANGWENA',1,NULL,'OHANGWENA',NULL,NULL,NULL,NULL),(84,'OKAMBEBE','OKAMBEBE',1,NULL,'OHANGWENA',NULL,NULL,NULL,NULL),(85,'OKONGO','OKONGO',1,NULL,'OHANGWENA',NULL,NULL,NULL,NULL),(86,'OMUNDAUNGILO','OMUNDAUNGILO',1,NULL,'OHANGWENA',NULL,NULL,NULL,NULL),(87,'OMUNGWELUME','OMUNGWELUME',1,NULL,'OHANGWENA',NULL,NULL,NULL,NULL),(88,'ONDOBE','ONDOBE',1,NULL,'OHANGWENA',NULL,NULL,NULL,NULL),(89,'ONGENGA','ONGENGA',1,NULL,'OHANGWENA',NULL,NULL,NULL,NULL),(90,'ONGHA','ONGHA',1,NULL,'OHANGWENA',NULL,NULL,NULL,NULL),(91,'ONGULA YA NETANGA','ONGULA YA NETANGA',1,NULL,'OHANGWENA',NULL,NULL,NULL,NULL),(92,'ONUNO','ONUNO',1,NULL,'OHANGWENA',NULL,NULL,NULL,NULL),(93,'OSHANGO','OSHANGO',1,NULL,'OHANGWENA',NULL,NULL,NULL,NULL),(94,'HELAO NAFIDI','HELAO NAFIDI',1,NULL,'OHANGWENA',NULL,NULL,NULL,NULL),(95,'OMAUNI','OMAUNI',1,NULL,'OHANGWENA',NULL,NULL,NULL,NULL),(96,'OSHIKUNDE','OSHIKUNDE',1,NULL,'OHANGWENA',NULL,NULL,NULL,NULL),(97,'EPUKIRO POST 3','EPUKIRO POST 3',0,NULL,'OMAHEKE',NULL,NULL,NULL,NULL),(98,'GOBABIS','GOBABIS',1,NULL,'OMAHEKE',NULL,NULL,NULL,NULL),(99,'LEONARDVILLE','LEONARDVILLE',1,NULL,'OMAHEKE',NULL,NULL,NULL,NULL),(100,'OTJINENE','OTJINENE',1,NULL,'OMAHEKE',NULL,NULL,NULL,NULL),(101,'WITVLEI','WITVLEI',1,NULL,'OMAHEKE',NULL,NULL,NULL,NULL),(102,'AMINUIS','AMINUIS',1,NULL,'OMAHEKE',NULL,NULL,NULL,NULL),(103,'BUITEPOS','BUITEPOS',1,NULL,'OMAHEKE',NULL,NULL,NULL,NULL),(104,'ONDEROMBAPA','ONDEROMBAPA',1,NULL,'OMAHEKE',NULL,NULL,NULL,NULL),(105,'SUMMERDOWN','SUMMERDOWN',1,NULL,'OMAHEKE',NULL,NULL,NULL,NULL),(106,'TALISMANUS','TALISMANUS',1,NULL,'OMAHEKE',NULL,NULL,NULL,NULL),(107,'BEN-HUR','BEN-HUR',1,NULL,'OMAHEKE',NULL,NULL,NULL,NULL),(108,'CORRIDOR','CORRIDOR',1,NULL,'OMAHEKE',NULL,NULL,NULL,NULL),(109,'EISEB','EISEB',1,NULL,'OMAHEKE',NULL,NULL,NULL,NULL),(110,'OMITARA','OMITARA',1,NULL,'OMAHEKE',NULL,NULL,NULL,NULL),(111,'OKAHAO','OKAHAO',1,NULL,'OMUSATI',NULL,NULL,NULL,NULL),(112,'OKALONGO','OKALONGO',1,NULL,'OMUSATI',NULL,NULL,NULL,NULL),(113,'ONESI','ONESI',1,NULL,'OMUSATI',NULL,NULL,NULL,NULL),(114,'TSANDI','TSANDI',1,NULL,'OMUSATI',NULL,NULL,NULL,NULL),(115,'OGONGO','OGONGO',1,NULL,'OMUSATI',NULL,NULL,NULL,NULL),(116,'ONAWA','ONAWA',1,NULL,'OMUSATI',NULL,NULL,NULL,NULL),(117,'OSHIKUKU','OSHIKUKU',1,NULL,'OMUSATI',NULL,NULL,NULL,NULL),(118,'OUTAPI','OUTAPI',1,NULL,'OMUSATI',NULL,NULL,NULL,NULL),(119,'RUACANA-OSHIFO','RUACANA-OSHIFO',1,NULL,'OMUSATI',NULL,NULL,NULL,NULL),(120,'ONDANGWA','ONDANGWA',1,NULL,'OSHANA',NULL,NULL,NULL,NULL),(121,'ONGWEDIVA','ONGWEDIVA',1,NULL,'OSHANA',NULL,NULL,NULL,NULL),(122,'OSHAKATI','OSHAKATI',1,NULL,'OSHANA',NULL,NULL,NULL,NULL),(123,'EHEKE','EHEKE',1,NULL,'OSHANA',NULL,NULL,NULL,NULL),(124,'UUKWANGULA','UUKWANGULA',1,NULL,'OSHANA',NULL,NULL,NULL,NULL),(125,'OSHIVELO','OSHIVELO',1,NULL,'OSHIKOTO',NULL,NULL,NULL,NULL),(126,'TSUMEB','TSUMEB',1,NULL,'OSHIKOTO',NULL,NULL,NULL,NULL),(127,'OKATOPE','OKATOPE',1,NULL,'OSHIKOTO',NULL,NULL,NULL,NULL),(128,'OMUTHIYA','OMUTHIYA',1,NULL,'OSHIKOTO',NULL,NULL,NULL,NULL),(129,'ONANKALI','ONANKALI',1,NULL,'OSHIKOTO',NULL,NULL,NULL,NULL),(130,'ONAYENA','ONAYENA',1,NULL,'OSHIKOTO',NULL,NULL,NULL,NULL),(131,'ONETHINDI','ONETHINDI',1,NULL,'OSHIKOTO',NULL,NULL,NULL,NULL),(132,'ONIIPA','ONIIPA',1,NULL,'OSHIKOTO',NULL,NULL,NULL,NULL),(133,'ONYAANYA','ONYAANYA',1,NULL,'OSHIKOTO',NULL,NULL,NULL,NULL),(134,'OSHIGAMBO','OSHIGAMBO',1,NULL,'OSHIKOTO',NULL,NULL,NULL,NULL),(135,'GROOTFONTEIN','GROOTFONTEIN',1,NULL,'OTJOZONDJUPA',NULL,NULL,NULL,NULL),(136,'KALKFELD','KALKFELD',1,NULL,'OTJOZONDJUPA',NULL,NULL,NULL,NULL),(137,'OKAKARARA','OKAKARARA',1,NULL,'OTJOZONDJUPA',NULL,NULL,NULL,NULL),(138,'OTAVI','OTAVI',1,NULL,'OTJOZONDJUPA',NULL,NULL,NULL,NULL),(139,'OTJIWARONGO','OTJIWARONGO',1,NULL,'OTJOZONDJUPA',NULL,NULL,NULL,NULL),(140,'COBLENZ','COBLENZ',1,NULL,'OTJOZONDJUPA',NULL,NULL,NULL,NULL),(141,'OKAHANDJA','OKAHANDJA',1,NULL,'OTJOZONDJUPA',NULL,NULL,NULL,NULL),(142,'OKAMATAPATI','OKAMATAPATI',1,NULL,'OTJOZONDJUPA',NULL,NULL,NULL,NULL),(143,'OKATJORUU','OKATJORUU',1,NULL,'OTJOZONDJUPA',NULL,NULL,NULL,NULL),(144,'OKONDJATU','OKONDJATU',1,NULL,'OTJOZONDJUPA',NULL,NULL,NULL,NULL),(145,'OVITOTO','OVITOTO',1,NULL,'OTJOZONDJUPA',NULL,NULL,NULL,NULL),(146,'TSUMKWE','TSUMKWE',1,NULL,'OTJOZONDJUPA',NULL,NULL,NULL,NULL),(147,'GAM','GAM',1,NULL,'OTJOZONDJUPA',NULL,NULL,NULL,NULL);

/*Table structure for table `ref_constituences` */

DROP TABLE IF EXISTS `ref_constituences`;

CREATE TABLE `ref_constituences` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(128) DEFAULT NULL,
  `name` varchar(128) DEFAULT NULL,
  `description` varchar(128) DEFAULT NULL,
  `isActive` tinyint(1) DEFAULT '1',
  `cityTownCode` varchar(128) DEFAULT NULL,
  `createdBy` varchar(24) DEFAULT NULL,
  `createdOn` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedBy` varchar(24) DEFAULT NULL,
  `modifiedOn` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=148 DEFAULT CHARSET=utf8;

/*Data for the table `ref_constituences` */

insert  into `ref_constituences`(`id`,`code`,`name`,`description`,`isActive`,`cityTownCode`,`createdBy`,`createdOn`,`modifiedBy`,`modifiedOn`) values (2,'KATIMA MULILO URBAN','KATIMA MULILO URBAN','KATIMA MULILO URBAN',1,'KATIMA MULILO',NULL,'2014-12-02 02:33:16',NULL,NULL),(3,'SIBINDA','SIBINDA','SIBINDA',1,'CHINCHIMANI',NULL,'2014-12-02 02:33:16',NULL,NULL),(4,'LINYANTI','LINYANTI','LINYANTI',1,'KONGOLA',NULL,'2014-12-02 02:33:16',NULL,NULL),(5,'LINYANTI','LINYANTI','LINYANTI',1,'LINYANTI',NULL,'2014-12-02 02:33:16',NULL,NULL),(6,'KATIMA MULILO RURAL','KATIMA MULILO RURAL','KATIMA MULILO RURAL',1,'MAFUTA',NULL,'2014-12-02 02:33:16',NULL,NULL),(7,'LINYANTI','LINYANTI','LINYANTI',1,'SANGWALI',NULL,'2014-12-02 02:33:16',NULL,NULL),(8,'LINYANTI','LINYANTI','LINYANTI',1,'SIBINDA',NULL,'2014-12-02 02:33:16',NULL,NULL),(9,'KATIMA MULILO RURAL','KATIMA MULILO RURAL','KATIMA MULILO RURAL',1,'BUKALO',NULL,'2014-12-02 02:33:16',NULL,NULL),(10,'KABE','KABE','KABE',1,'LUSESE',NULL,'2014-12-02 02:33:16',NULL,NULL),(11,'KATIMA MULILO RURAL','KATIMA MULILO RURAL','KATIMA MULILO RURAL',1,'NGOMA',NULL,'2014-12-02 02:33:16',NULL,NULL),(12,'KARIBIB','KARIBIB','KARIBIB',1,'KARIBIB',NULL,'2014-12-02 02:33:16',NULL,NULL),(13,'DAURES','DAURES','DAURES',1,'NAMPOL OKOMBAHE',NULL,'2014-12-02 02:33:16',NULL,NULL),(14,'ARANDIS','ARANDIS','ARANDIS',1,'HENTIESBAAI',NULL,'2014-12-02 02:33:16',NULL,NULL),(15,'DAURES','DAURES','DAURES',1,'OMATJETTE',NULL,'2014-12-02 02:33:16',NULL,NULL),(16,'KARIBIB','KARIBIB','KARIBIB',1,'OTJIMBINGWE',NULL,'2014-12-02 02:33:16',NULL,NULL),(17,'SWAKOPMUND','SWAKOPMUND','SWAKOPMUND',1,'SWAKOPMUND',NULL,'2014-12-02 02:33:16',NULL,NULL),(18,'KARIBIB','KARIBIB','KARIBIB',1,'USAKOS',NULL,'2014-12-02 02:33:16',NULL,NULL),(19,'WALVIS BAY URBAN','WALVIS BAY URBAN','WALVIS BAY URBAN',1,'WALVIS BAY',NULL,'2014-12-02 02:33:16',NULL,NULL),(20,'ARANDIS','ARANDIS','ARANDIS',1,'WLOTZKASBAKEN',NULL,'2014-12-02 02:33:16',NULL,NULL),(21,'MARIENTAL RURAL','MARIENTAL RURAL','MARIENTAL RURAL',1,'ARANOS',NULL,'2014-12-02 02:33:16',NULL,NULL),(22,'GIBEON','GIBEON','GIBEON',1,'GIBEON',NULL,'2014-12-02 02:33:16',NULL,NULL),(23,'MARIENTAL RURAL','MARIENTAL RURAL','MARIENTAL RURAL',1,'GOCHAS',NULL,'2014-12-02 02:33:16',NULL,NULL),(24,'REHOBOTH RURAL','REHOBOTH RURAL','REHOBOTH RURAL',1,'KALKRAND',NULL,'2014-12-02 02:33:16',NULL,NULL),(25,'GIBEON','GIBEON','GIBEON',1,'MALTAH',NULL,'2014-12-02 02:33:16',NULL,NULL),(26,'MARIENTAL URBAN','MARIENTAL URBAN','MARIENTAL URBAN',1,'MARIENTAL',NULL,'2014-12-02 02:33:16',NULL,NULL),(27,'REHOBOTH URBAN EAST','REHOBOTH URBAN EAST','REHOBOTH URBAN EAST',1,'REHOBOTH',NULL,'2014-12-02 02:33:16',NULL,NULL),(28,'MARIENTAL RURAL','MARIENTAL RURAL','MARIENTAL RURAL',1,'STAMPRIET',NULL,'2014-12-02 02:33:16',NULL,NULL),(29,'REHOBOTH RURAL','REHOBOTH RURAL','REHOBOTH RURAL',1,'DUINEVELD',NULL,'2014-12-02 02:33:16',NULL,NULL),(30,'MARIENTAL RURAL','MARIENTAL RURAL','MARIENTAL RURAL',1,'HOACHANAS',NULL,'2014-12-02 02:33:16',NULL,NULL),(31,'REHOBOTH RURAL','REHOBOTH RURAL','REHOBOTH RURAL',1,'KLEIN AUB',NULL,'2014-12-02 02:33:16',NULL,NULL),(32,'REHOBOTH RURAL','REHOBOTH RURAL','REHOBOTH RURAL',1,'RIETOOG',NULL,'2014-12-02 02:33:16',NULL,NULL),(33,'REHOBOTH RURAL','REHOBOTH RURAL','REHOBOTH RURAL',1,'SCHLIP',NULL,'2014-12-02 02:33:16',NULL,NULL),(34,'GIBEON','GIBEON','GIBEON',1,'AMPER-BO',NULL,'2014-12-02 02:33:16',NULL,NULL),(35,'GIBEON','GIBEON','GIBEON',1,'KRIES',NULL,'2014-12-02 02:33:16',NULL,NULL),(36,'GIBEON','GIBEON','GIBEON',1,'UIBIS',NULL,'2014-12-02 02:33:16',NULL,NULL),(37,'KEETMANSHOOP RURAL','KEETMANSHOOP RURAL','KEETMANSHOOP RURAL',1,'AROAB',NULL,'2014-12-02 02:33:16',NULL,NULL),(38,'BERSEBA','BERSEBA','BERSEBA',1,'BERSEBA',NULL,'2014-12-02 02:33:16',NULL,NULL),(39,'BERSEBA','BERSEBA','BERSEBA',1,'BETHANIE',NULL,'2014-12-02 02:33:16',NULL,NULL),(40,'KARASBURG','KARASBURG','KARASBURG',1,'GRUNAU',NULL,'2014-12-02 02:33:16',NULL,NULL),(41,'KARASBURG','KARASBURG','KARASBURG',1,'KARASBURG',NULL,'2014-12-02 02:33:16',NULL,NULL),(42,'KEETMANSHOOP URBAN','KEETMANSHOOP URBAN','KEETMANSHOOP URBAN',1,'KEETMANSHOOP',NULL,'2014-12-02 02:33:16',NULL,NULL),(43,'KEETMANSHOOP RURAL','KEETMANSHOOP RURAL','KEETMANSHOOP RURAL',1,'KOES',NULL,'2014-12-02 02:33:16',NULL,NULL),(44,'LUDERITZ','LUDERITZ','LUDERITZ',1,'LUDERITZ',NULL,'2014-12-02 02:33:16',NULL,NULL),(45,'KARASBURG','KARASBURG','KARASBURG',1,'NOORDOEWER',NULL,'2014-12-02 02:33:16',NULL,NULL),(46,'ORANGEMUND','ORANGEMUND','ORANGEMUND',1,'ORANJEMUND',NULL,'2014-12-02 02:33:16',NULL,NULL),(47,'ORANGEMUND','ORANGEMUND','ORANGEMUND',1,'ROSH PINAH',NULL,'2014-12-02 02:33:16',NULL,NULL),(48,'BERSEBA','BERSEBA','BERSEBA',1,'TSES',NULL,'2014-12-02 02:33:16',NULL,NULL),(49,'KARASBURG','KARASBURG','KARASBURG',1,'ARIAMSVLEI',NULL,'2014-12-02 02:33:16',NULL,NULL),(50,'L','L','L',1,'AUS',NULL,'2014-12-02 02:33:16',NULL,NULL),(51,'KARASBURG','KARASBURG','KARASBURG',1,'AUSSENKEHR',NULL,'2014-12-02 02:33:16',NULL,NULL),(52,'KARASBURG','KARASBURG','KARASBURG',1,'WARMBAD',NULL,'2014-12-02 02:33:16',NULL,NULL),(53,'RUNDU URBAN','RUNDU URBAN','RUNDU URBAN',1,'RUNDU',NULL,'2014-12-02 02:33:16',NULL,NULL),(54,'MUKWE','MUKWE','MUKWE',1,'DIVUNDU',NULL,'2014-12-02 02:33:16',NULL,NULL),(55,'KAPAKO','KAPAKO','KAPAKO',1,'KAPAKO',NULL,'2014-12-02 02:33:16',NULL,NULL),(56,'RUNDU RURAL EAST','RUNDU RURAL EAST','RUNDU RURAL EAST',1,'KAYENGONA',NULL,'2014-12-02 02:33:16',NULL,NULL),(57,'MASHARE','MASHARE','MASHARE',1,'MABUSHE',NULL,'2014-12-02 02:33:16',NULL,NULL),(58,'MUKWE','MUKWE','MUKWE',1,'MUKWE',NULL,'2014-12-02 02:33:16',NULL,NULL),(59,'MASHARE','MASHARE','MASHARE',1,'MURORO-MASHARI',NULL,'2014-12-02 02:33:16',NULL,NULL),(60,'KAHENGE','KAHENGE','KAHENGE',1,'MURURANI-GATE',NULL,'2014-12-02 02:33:16',NULL,NULL),(61,'NDIYONA','NDIYONA','NDIYONA',1,'NDIYONA',NULL,'2014-12-02 02:33:16',NULL,NULL),(62,'KAPAKO','KAPAKO','KAPAKO',1,'NKAMAGORO',NULL,'2014-12-02 02:33:16',NULL,NULL),(63,'MPUNGU','MPUNGU','MPUNGU',1,'NKURENKURU (KAHENGE)',NULL,'2014-12-02 02:33:16',NULL,NULL),(64,'MUKWE','MUKWE','MUKWE',1,'OMEGA',NULL,'2014-12-02 02:33:16',NULL,NULL),(65,'WINDHOEK EAST','WINDHOEK EAST','WINDHOEK EAST',1,'WINDHOEK',NULL,'2014-12-02 02:33:16',NULL,NULL),(66,'WINDHOEK RURAL','WINDHOEK RURAL','WINDHOEK RURAL',1,'GROOT AUB',NULL,'2014-12-02 02:33:16',NULL,NULL),(67,'WINDHOEK RURAL','WINDHOEK RURAL','WINDHOEK RURAL',1,'ARIS',NULL,'2014-12-02 02:33:16',NULL,NULL),(68,'WINDHOEK RURAL','WINDHOEK RURAL','WINDHOEK RURAL',1,'DORDABIS',NULL,'2014-12-02 02:33:16',NULL,NULL),(69,'WINDHOEK RURAL','WINDHOEK RURAL','WINDHOEK RURAL',1,'KAPPSFARM',NULL,'2014-12-02 02:33:16',NULL,NULL),(70,'KAMANJAB','KAMANJAB','KAMANJAB',1,'KAMANJAB',NULL,'2014-12-02 02:33:16',NULL,NULL),(71,'KHORIXAS','KHORIXAS','KHORIXAS',1,'KHORIXAS',NULL,'2014-12-02 02:33:16',NULL,NULL),(72,'OPUWO','OPUWO','OPUWO',1,'OPUWO',NULL,'2014-12-02 02:33:16',NULL,NULL),(73,'OUTJO','OUTJO','OUTJO',1,'OUTJO',NULL,'2014-12-02 02:33:16',NULL,NULL),(74,'SESFONTEIN','SESFONTEIN','SESFONTEIN',1,'SESFONTEIN',NULL,'2014-12-02 02:33:16',NULL,NULL),(75,'KHORIXAS','KHORIXAS','KHORIXAS',1,'FRANSFONTEIN',NULL,'2014-12-02 02:33:16',NULL,NULL),(76,'EPUPA','EPUPA','EPUPA',1,'OKANGWATI',NULL,'2014-12-02 02:33:16',NULL,NULL),(77,'EENHANA','EENHANA','EENHANA',1,'EENHANA',NULL,'2014-12-02 02:33:16',NULL,NULL),(78,'ENDOLA','ENDOLA','ENDOLA',1,'ENDOLA',NULL,'2014-12-02 02:33:16',NULL,NULL),(79,'ENGELA','ENGELA','ENGELA',1,'ENGELA-OMAFU',NULL,'2014-12-02 02:33:16',NULL,NULL),(80,'EPEMBE','EPEMBE','EPEMBE',1,'EPEMBE',NULL,'2014-12-02 02:33:16',NULL,NULL),(81,'OSHIKANGO','OSHIKANGO','OSHIKANGO',1,'ODIBO',NULL,'2014-12-02 02:33:16',NULL,NULL),(82,'ENGELA','ENGELA','ENGELA',1,'OHAINGU',NULL,'2014-12-02 02:33:16',NULL,NULL),(83,'OHANGWENA','OHANGWENA','OHANGWENA',1,'OHANGWENA',NULL,'2014-12-02 02:33:16',NULL,NULL),(84,'ONGENGA','ONGENGA','ONGENGA',1,'OKAMBEBE',NULL,'2014-12-02 02:33:16',NULL,NULL),(85,'OKONGO','OKONGO','OKONGO',1,'OKONGO',NULL,'2014-12-02 02:33:16',NULL,NULL),(86,'OMUNDAUNGILO','OMUNDAUNGILO','OMUNDAUNGILO',1,'OMUNDAUNGILO',NULL,'2014-12-02 02:33:16',NULL,NULL),(87,'ONGENGA','ONGENGA','ONGENGA',1,'OMUNGWELUME',NULL,'2014-12-02 02:33:16',NULL,NULL),(88,'ONDOBE','ONDOBE','ONDOBE',1,'ONDOBE',NULL,'2014-12-02 02:33:16',NULL,NULL),(89,'ONGENGA','ONGENGA','ONGENGA',1,'ONGENGA',NULL,'2014-12-02 02:33:16',NULL,NULL),(90,'ENDOLA','ENDOLA','ENDOLA',1,'ONGHA',NULL,'2014-12-02 02:33:16',NULL,NULL),(91,'OMULONGA','OMULONGA','OMULONGA',1,'ONGULA YA NETANGA',NULL,'2014-12-02 02:33:16',NULL,NULL),(92,'OHANGWENA','OHANGWENA','OHANGWENA',1,'ONUNO',NULL,'2014-12-02 02:33:16',NULL,NULL),(93,'OMULONGA','OMULONGA','OMULONGA',1,'OSHANGO',NULL,'2014-12-02 02:33:16',NULL,NULL),(94,'OSHIKANGO','OSHIKANGO','OSHIKANGO',1,'HELAO NAFIDI',NULL,'2014-12-02 02:33:16',NULL,NULL),(95,'OKONGO','OKONGO','OKONGO',1,'OMAUNI',NULL,'2014-12-02 02:33:16',NULL,NULL),(96,'EPEMBE','EPEMBE','EPEMBE',1,'OSHIKUNDE',NULL,'2014-12-02 02:33:16',NULL,NULL),(97,'EPUKIRO','EPUKIRO','EPUKIRO',1,'EPUKIRO POST 3',NULL,'2014-12-02 02:33:16',NULL,NULL),(98,'GOBABIS','GOBABIS','GOBABIS',1,'GOBABIS',NULL,'2014-12-02 02:33:16',NULL,NULL),(99,'AMINUIS','AMINUIS','AMINUIS',1,'LEONARDVILLE',NULL,'2014-12-02 02:33:16',NULL,NULL),(100,'OTJINENE','OTJINENE','OTJINENE',1,'OTJINENE',NULL,'2014-12-02 02:33:16',NULL,NULL),(101,'STEINHAUSEN','STEINHAUSEN','STEINHAUSEN',1,'WITVLEI',NULL,'2014-12-02 02:33:16',NULL,NULL),(102,'AMINUIS','AMINUIS','AMINUIS',1,'AMINUIS',NULL,'2014-12-02 02:33:16',NULL,NULL),(103,'KALAHARI','KALAHARI','KALAHARI',1,'BUITEPOS',NULL,'2014-12-02 02:33:16',NULL,NULL),(104,'AMINUIS','AMINUIS','AMINUIS',1,'ONDEROMBAPA',NULL,'2014-12-02 02:33:16',NULL,NULL),(105,'STEINHAUSEN','STEINHAUSEN','STEINHAUSEN',1,'SUMMERDOWN',NULL,'2014-12-02 02:33:16',NULL,NULL),(106,'OTJOMBINDE','OTJOMBINDE','OTJOMBINDE',1,'TALISMANUS',NULL,'2014-12-02 02:33:16',NULL,NULL),(107,'KALAHARI','KALAHARI','KALAHARI',1,'BEN-HUR',NULL,'2014-12-02 02:33:16',NULL,NULL),(108,'AMINUIS','AMINUIS','AMINUIS',1,'CORRIDOR',NULL,'2014-12-02 02:33:16',NULL,NULL),(109,'OTJOMBINDE','OTJOMBINDE','OTJOMBINDE',1,'EISEB',NULL,'2014-12-02 02:33:16',NULL,NULL),(110,'STEINHAUSEN','STEINHAUSEN','STEINHAUSEN',1,'OMITARA',NULL,'2014-12-02 02:33:16',NULL,NULL),(111,'OKAHAO','OKAHAO','OKAHAO',1,'OKAHAO',NULL,'2014-12-02 02:33:16',NULL,NULL),(112,'OKALONGO','OKALONGO','OKALONGO',1,'OKALONGO',NULL,'2014-12-02 02:33:16',NULL,NULL),(113,'ONESI','ONESI','ONESI',1,'ONESI',NULL,'2014-12-02 02:33:16',NULL,NULL),(114,'TSANDI','TSANDI','TSANDI',1,'TSANDI',NULL,'2014-12-02 02:33:16',NULL,NULL),(115,'OGONGO','OGONGO','OGONGO',1,'OGONGO',NULL,'2014-12-02 02:33:16',NULL,NULL),(116,'ANAMULENGE','ANAMULENGE','ANAMULENGE',1,'ONAWA',NULL,'2014-12-02 02:33:16',NULL,NULL),(117,'OSHIKUKU','OSHIKUKU','OSHIKUKU',1,'OSHIKUKU',NULL,'2014-12-02 02:33:16',NULL,NULL),(118,'OUTAPI','OUTAPI','OUTAPI',1,'OUTAPI',NULL,'2014-12-02 02:33:16',NULL,NULL),(119,'RUACANA','RUACANA','RUACANA',1,'RUACANA-OSHIFO',NULL,'2014-12-02 02:33:16',NULL,NULL),(120,'ONDANGWA','ONDANGWA','ONDANGWA',1,'ONDANGWA',NULL,'2014-12-02 02:33:16',NULL,NULL),(121,'ONGWEDIVA','ONGWEDIVA','ONGWEDIVA',1,'ONGWEDIVA',NULL,'2014-12-02 02:33:16',NULL,NULL),(122,'OSHAKATI EAST','OSHAKATI EAST','OSHAKATI EAST',1,'OSHAKATI',NULL,'2014-12-02 02:33:16',NULL,NULL),(123,'ONDANGWA','ONDANGWA','ONDANGWA',1,'EHEKE',NULL,'2014-12-02 02:33:16',NULL,NULL),(124,'OKATANA','OKATANA','OKATANA',1,'UUKWANGULA',NULL,'2014-12-02 02:33:16',NULL,NULL),(125,'GUINAS','GUINAS','GUINAS',1,'OSHIVELO',NULL,'2014-12-02 02:33:16',NULL,NULL),(126,'TSUMEB','TSUMEB','TSUMEB',1,'TSUMEB',NULL,'2014-12-02 02:33:16',NULL,NULL),(127,'ONYAANYA','ONYAANYA','ONYAANYA',1,'OKATOPE',NULL,'2014-12-02 02:33:16',NULL,NULL),(128,'OMUTHIYAGWIIPUNDI','OMUTHIYAGWIIPUNDI','OMUTHIYAGWIIPUNDI',1,'OMUTHIYA',NULL,'2014-12-02 02:33:16',NULL,NULL),(129,'ONYAANYA','ONYAANYA','ONYAANYA',1,'ONANKALI',NULL,'2014-12-02 02:33:16',NULL,NULL),(130,'ONAYENA','ONAYENA','ONAYENA',1,'ONAYENA',NULL,'2014-12-02 02:33:16',NULL,NULL),(131,'ONIIPA','ONIIPA','ONIIPA',1,'ONETHINDI',NULL,'2014-12-02 02:33:16',NULL,NULL),(132,'ONIIPA','ONIIPA','ONIIPA',1,'ONIIPA',NULL,'2014-12-02 02:33:16',NULL,NULL),(133,'ONYAANYA','ONYAANYA','ONYAANYA',1,'ONYAANYA',NULL,'2014-12-02 02:33:16',NULL,NULL),(134,'ONIIPA','ONIIPA','ONIIPA',1,'OSHIGAMBO',NULL,'2014-12-02 02:33:16',NULL,NULL),(135,'GROOTFONTEIN','GROOTFONTEIN','GROOTFONTEIN',1,'GROOTFONTEIN',NULL,'2014-12-02 02:33:16',NULL,NULL),(136,'OTJIWARONGO','OTJIWARONGO','OTJIWARONGO',1,'KALKFELD',NULL,'2014-12-02 02:33:16',NULL,NULL),(137,'OKAKARARA','OKAKARARA','OKAKARARA',1,'OKAKARARA',NULL,'2014-12-02 02:33:16',NULL,NULL),(138,'OTAVI','OTAVI','OTAVI',1,'OTAVI',NULL,'2014-12-02 02:33:16',NULL,NULL),(139,'OTJIWARONGO','OTJIWARONGO','OTJIWARONGO',1,'OTJIWARONGO',NULL,'2014-12-02 02:33:16',NULL,NULL),(140,'OKAKARARA','OKAKARARA','OKAKARARA',1,'COBLENZ',NULL,'2014-12-02 02:33:16',NULL,NULL),(141,'OKAHANDJA','OKAHANDJA','OKAHANDJA',1,'OKAHANDJA',NULL,'2014-12-02 02:33:16',NULL,NULL),(142,'OKAKARARA','OKAKARARA','OKAKARARA',1,'OKAMATAPATI',NULL,'2014-12-02 02:33:16',NULL,NULL),(143,'OKAKARARA','OKAKARARA','OKAKARARA',1,'OKATJORUU',NULL,'2014-12-02 02:33:16',NULL,NULL),(144,'OKAKARARA','OKAKARARA','OKAKARARA',1,'OKONDJATU',NULL,'2014-12-02 02:33:16',NULL,NULL),(145,'OMATAKO','OMATAKO','OMATAKO',1,'OVITOTO',NULL,'2014-12-02 02:33:16',NULL,NULL),(146,'TSUMKWE','TSUMKWE','TSUMKWE',1,'TSUMKWE',NULL,'2014-12-02 02:33:16',NULL,NULL),(147,'TSUMKWE','TSUMKWE','TSUMKWE',1,'GAM',NULL,'2014-12-02 02:33:16',NULL,NULL);

/*Table structure for table `ref_regions` */

DROP TABLE IF EXISTS `ref_regions`;

CREATE TABLE `ref_regions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(128) DEFAULT NULL,
  `name` varchar(128) DEFAULT NULL,
  `description` varchar(128) DEFAULT NULL,
  `isActive` tinyint(1) DEFAULT '1',
  `countryCode` char(3) DEFAULT 'NAM',
  `createdBy` varchar(24) DEFAULT NULL,
  `createdOn` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedBy` varchar(24) DEFAULT NULL,
  `modifiedOn` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

/*Data for the table `ref_regions` */

insert  into `ref_regions`(`id`,`code`,`name`,`description`,`isActive`,`countryCode`,`createdBy`,`createdOn`,`modifiedBy`,`modifiedOn`) values (1,'KARAS','!KARAS REGION','!KARAS REGION',1,'NAM','JBlac','2014-12-01 23:16:47',NULL,NULL),(2,'ERONGO','ERONGO REGION','ERONGO REGION',1,'NAM','JBlac','2014-12-01 23:16:47',NULL,NULL),(3,'HARDAP','HARDAP REGION','HARDAP REGION',1,'NAM','JBlac','2014-12-01 23:16:47',NULL,NULL),(4,'KAVANGO EAST','KAVANGO EAST REGION','KAVANGO EAST REGION',1,'NAM','JBlac','2014-12-01 23:16:47',NULL,NULL),(5,'KAVANGO WEST','KAVANGO WEST REGION','KAVANGO WEST REGION',1,'NAM','JBlac','2014-12-01 23:16:47',NULL,NULL),(6,'KHOMAS','KHOMAS REGION','KHOMAS REGION',1,'NAM','JBlac','2014-12-01 23:16:47',NULL,NULL),(7,'KUNENE','KUNENE REGION','KUNENE REGION',1,'NAM','JBlac','2014-12-01 23:16:47',NULL,NULL),(8,'OHANGWENA','OHANGWENA REGION','OHANGWENA REGION',1,'NAM','JBlac','2014-12-01 23:16:47',NULL,NULL),(9,'OMAHEKE','OMAHEKE REGION','OMAHEKE REGION',1,'NAM','JBlac','2014-12-01 23:16:47',NULL,NULL),(10,'OMUSATI','OMUSATI REGION','OMUSATI REGION',1,'NAM','JBlac','2014-12-01 23:16:47',NULL,NULL),(11,'OSHANA','OSHANA REGION','OSHANA REGION',1,'NAM','JBlac','2014-12-01 23:16:47',NULL,NULL),(12,'OSHIKOTO','OSHIKOTO REGION','OSHIKOTO REGION',1,'NAM','JBlac','2014-12-01 23:16:47',NULL,NULL),(13,'OTJOZONDJUPA','OTJOZONDJUPA REGION','OTJOZONDJUPA REGION',1,'NAM','JBlac','2014-12-01 23:16:47',NULL,NULL),(14,'ZAMBEZI','ZAMBEZI REGION','ZAMBEZI REGION',1,'NAM','JBlac','2014-12-01 23:16:47',NULL,NULL);

/*Table structure for table `resolutions` */

DROP TABLE IF EXISTS `resolutions`;

CREATE TABLE `resolutions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `discussionDate` date DEFAULT NULL,
  `discussionStatus` varchar(120) NOT NULL,
  `corespondenceDate` date DEFAULT NULL,
  `requestType` varchar(256) NOT NULL,
  `consultantId` bigint(20) NOT NULL,
  `principleConsultant` varchar(128) DEFAULT NULL,
  `fundsId` bigint(20) DEFAULT NULL,
  `remarks` varchar(4000) DEFAULT NULL,
  `projectId` bigint(20) DEFAULT NULL,
  `projectNumber` char(12) DEFAULT NULL,
  `applicationId` bigint(20) DEFAULT NULL,
  `applicationNumber` char(12) NOT NULL,
  `requestNumber` char(12) DEFAULT NULL,
  `createdBy` varchar(24) DEFAULT NULL,
  `createdOn` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedBy` varchar(24) DEFAULT NULL,
  `modifiedOn` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_resolutions_id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `resolutions` */

/*Table structure for table `resources` */

DROP TABLE IF EXISTS `resources`;

CREATE TABLE `resources` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `resource` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `resources` */

insert  into `resources`(`id`,`resource`) values (1,'*/*/*'),(3,'home/index/menu'),(2,'home/*/*');

/*Table structure for table `roles` */

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(40) NOT NULL,
  `id_parent` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `roles` */

insert  into `roles`(`id`,`role`,`id_parent`) values (3,'admin',0),(2,'user',1),(1,'guest',0);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(40) NOT NULL,
  `password` varchar(128) NOT NULL,
  `id_role` int(11) NOT NULL,
  `ldap` tinyint(1) NOT NULL DEFAULT '0',
  `firstname` varchar(80) DEFAULT NULL,
  `lastname` varchar(80) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `createdBy` varchar(24) DEFAULT NULL,
  `createdOn` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedBy` varchar(24) DEFAULT NULL,
  `modifiedOn` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `firstname` (`firstname`),
  KEY `lastname` (`lastname`),
  KEY `username` (`username`),
  KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `users` */

insert  into `users`(`id`,`username`,`password`,`id_role`,`ldap`,`firstname`,`lastname`,`email`,`status`,`createdBy`,`createdOn`,`modifiedBy`,`modifiedOn`) values (1,'admin','8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918 ',3,0,'Administrator','',NULL,1,NULL,'2014-11-11 08:42:28',NULL,NULL),(2,'jade','ed64662ef2d8425bc7654e5d7a09fee0788b72ec',2,0,'Jade Juliette','',NULL,1,NULL,'2014-11-11 08:42:28',NULL,NULL),(3,'bssp','6ab17fbc7a95154b692d9c84cb253ad0989028cb9f8aff828bc9941557d29b1c ',2,0,'BSSP','User','innocent.blacius@gmail.com',1,'SYSTEM','2014-11-11 08:55:11',NULL,'2014-11-11 19:56:32');

/*Table structure for table `bssp_address_v` */

DROP TABLE IF EXISTS `bssp_address_v`;

/*!50001 DROP VIEW IF EXISTS `bssp_address_v` */;
/*!50001 DROP TABLE IF EXISTS `bssp_address_v` */;

/*!50001 CREATE TABLE  `bssp_address_v`(
 `addressId` smallint(5) unsigned ,
 `addressLineOne` varchar(50) ,
 `addressLineTwo` varchar(50) ,
 `postalAddress` varchar(120) ,
 `regionCode` varchar(128) ,
 `cityCode` varchar(128) ,
 `constituencyCode` varchar(128) ,
 `countryCode` varchar(128) ,
 `legalEntityId` bigint(20) 
)*/;

/*Table structure for table `bssp_applications_legal_entity_v` */

DROP TABLE IF EXISTS `bssp_applications_legal_entity_v`;

/*!50001 DROP VIEW IF EXISTS `bssp_applications_legal_entity_v` */;
/*!50001 DROP TABLE IF EXISTS `bssp_applications_legal_entity_v` */;

/*!50001 CREATE TABLE  `bssp_applications_legal_entity_v`(
 `applicationId` bigint(20) unsigned ,
 `applicationNumber` varchar(20) ,
 `applicationLegalEntityType` varchar(30) ,
 `applicationDate` varchar(10) ,
 `applicationAcknowledgementDate` varchar(10) ,
 `applicationLegalEntityId` bigint(20) ,
 `requestId` bigint(20) unsigned ,
 `requestNumber` varchar(20) ,
 `requestType` varchar(128) ,
 `requestPriotityArea` varchar(256) ,
 `requestBusinessActivity` varchar(1024) ,
 `requestStatus` varchar(28) ,
 `requestRemarks` varchar(128) ,
 `entityType` varchar(30) ,
 `applicantName` varchar(289) 
)*/;

/*Table structure for table `bssp_applications_v` */

DROP TABLE IF EXISTS `bssp_applications_v`;

/*!50001 DROP VIEW IF EXISTS `bssp_applications_v` */;
/*!50001 DROP TABLE IF EXISTS `bssp_applications_v` */;

/*!50001 CREATE TABLE  `bssp_applications_v`(
 `applicationId` bigint(20) unsigned ,
 `applicationNumber` varchar(20) ,
 `applicationDate` varchar(10) ,
 `applicationAcknowledgementDate` varchar(10) ,
 `applicationLegalEntityId` bigint(20) ,
 `requestId` bigint(20) unsigned ,
 `requestNumber` varchar(20) ,
 `requestType` varchar(128) ,
 `requestPriotityArea` varchar(256) ,
 `requestBusinessActivity` varchar(1024) ,
 `requestStatus` varchar(28) ,
 `requestRemarks` varchar(128) ,
 `firstName` varchar(45) ,
 `middleName` varchar(45) ,
 `lastName` varchar(45) ,
 `dateOfBirth` varchar(10) ,
 `passportNumber` varchar(15) ,
 `identityNumber` varchar(15) ,
 `companyName` varchar(256) ,
 `companyRegistrationNumber` varchar(30) ,
 `applicantName` varchar(289) ,
 `entityType` varchar(30) ,
 `emailAddress` varchar(128) ,
 `telephoneNumber` varchar(24) ,
 `mobileNumber` varchar(24) ,
 `faxNumber` varchar(24) 
)*/;

/*Table structure for table `bssp_contact_v` */

DROP TABLE IF EXISTS `bssp_contact_v`;

/*!50001 DROP VIEW IF EXISTS `bssp_contact_v` */;
/*!50001 DROP TABLE IF EXISTS `bssp_contact_v` */;

/*!50001 CREATE TABLE  `bssp_contact_v`(
 `contactId` bigint(20) unsigned ,
 `contactFirstName` varchar(128) ,
 `contactMiddleName` varchar(128) ,
 `contactLastName` varchar(128) ,
 `contactPosition` varchar(256) ,
 `contactTitle` varchar(128) ,
 `legalEntityId` bigint(20) 
)*/;

/*Table structure for table `bssp_employment_creation_v` */

DROP TABLE IF EXISTS `bssp_employment_creation_v`;

/*!50001 DROP VIEW IF EXISTS `bssp_employment_creation_v` */;
/*!50001 DROP TABLE IF EXISTS `bssp_employment_creation_v` */;

/*!50001 CREATE TABLE  `bssp_employment_creation_v`(
 `employmentCreationId` bigint(20) unsigned ,
 `employmentNumberOfMales` int(11) ,
 `employmentNumberOfFemales` int(11) ,
 `employmentDateOfEmployment` varchar(10) ,
 `employmentRemarks` varchar(1200) ,
 `projectNumber` varchar(20) 
)*/;

/*Table structure for table `bssp_legal_entities_dataset_v` */

DROP TABLE IF EXISTS `bssp_legal_entities_dataset_v`;

/*!50001 DROP VIEW IF EXISTS `bssp_legal_entities_dataset_v` */;
/*!50001 DROP TABLE IF EXISTS `bssp_legal_entities_dataset_v` */;

/*!50001 CREATE TABLE  `bssp_legal_entities_dataset_v`(
 `id` bigint(20) unsigned ,
 `firstName` varchar(45) ,
 `middleName` varchar(45) ,
 `lastName` varchar(45) ,
 `dateOfBirth` date ,
 `passportNumber` varchar(15) ,
 `identityNumber` varchar(15) ,
 `companyName` varchar(256) ,
 `companyRegistrationNumber` varchar(30) ,
 `entityType` varchar(30) ,
 `entityCategory` varchar(30) ,
 `emailAddress` varchar(128) ,
 `telephoneNumber` varchar(24) ,
 `mobileNumber` varchar(24) ,
 `faxNumber` varchar(24) ,
 `addressId` smallint(5) unsigned ,
 `addressLineOne` varchar(50) ,
 `addressLineTwo` varchar(50) ,
 `postalAddress` varchar(120) ,
 `regionCode` varchar(128) ,
 `cityCode` varchar(128) ,
 `constituencyCode` varchar(128) ,
 `countryCode` varchar(128) ,
 `legalEntityId` bigint(20) 
)*/;

/*Table structure for table `bssp_legal_entities_v` */

DROP TABLE IF EXISTS `bssp_legal_entities_v`;

/*!50001 DROP VIEW IF EXISTS `bssp_legal_entities_v` */;
/*!50001 DROP TABLE IF EXISTS `bssp_legal_entities_v` */;

/*!50001 CREATE TABLE  `bssp_legal_entities_v`(
 `legalEntityName` varchar(289) ,
 `id` bigint(20) unsigned ,
 `entityType` varchar(30) ,
 `entityCategory` varchar(30) 
)*/;

/*Table structure for table `bssp_master_budgets_lov_v` */

DROP TABLE IF EXISTS `bssp_master_budgets_lov_v`;

/*!50001 DROP VIEW IF EXISTS `bssp_master_budgets_lov_v` */;
/*!50001 DROP TABLE IF EXISTS `bssp_master_budgets_lov_v` */;

/*!50001 CREATE TABLE  `bssp_master_budgets_lov_v`(
 `label` varchar(279) ,
 `value` varchar(20) 
)*/;

/*Table structure for table `bssp_project_budget_details_v` */

DROP TABLE IF EXISTS `bssp_project_budget_details_v`;

/*!50001 DROP VIEW IF EXISTS `bssp_project_budget_details_v` */;
/*!50001 DROP TABLE IF EXISTS `bssp_project_budget_details_v` */;

/*!50001 CREATE TABLE  `bssp_project_budget_details_v`(
 `budgetNumber` varchar(20) ,
 `budgetAmount` decimal(12,0) ,
 `paidAmount` decimal(34,0) ,
 `autstandingAmount` decimal(35,0) ,
 `projectNumber` varchar(20) ,
 `masterBudgetNumber` varchar(20) 
)*/;

/*Table structure for table `bssp_project_budget_lov_v` */

DROP TABLE IF EXISTS `bssp_project_budget_lov_v`;

/*!50001 DROP VIEW IF EXISTS `bssp_project_budget_lov_v` */;
/*!50001 DROP TABLE IF EXISTS `bssp_project_budget_lov_v` */;

/*!50001 CREATE TABLE  `bssp_project_budget_lov_v`(
 `budgetNumber` varchar(20) ,
 `budget` varchar(136) 
)*/;

/*Table structure for table `bssp_project_implementation_v` */

DROP TABLE IF EXISTS `bssp_project_implementation_v`;

/*!50001 DROP VIEW IF EXISTS `bssp_project_implementation_v` */;
/*!50001 DROP TABLE IF EXISTS `bssp_project_implementation_v` */;

/*!50001 CREATE TABLE  `bssp_project_implementation_v`(
 `implementationId` bigint(20) unsigned ,
 `implementationDateOfIssueToPromoters` varchar(10) ,
 `implementationReportType` varchar(1200) ,
 `implementationSourceOfFunds` varchar(1200) ,
 `implementationRemarks` varchar(1200) ,
 `projectNumber` varchar(20) 
)*/;

/*Table structure for table `bssp_projects_v` */

DROP TABLE IF EXISTS `bssp_projects_v`;

/*!50001 DROP VIEW IF EXISTS `bssp_projects_v` */;
/*!50001 DROP TABLE IF EXISTS `bssp_projects_v` */;

/*!50001 CREATE TABLE  `bssp_projects_v`(
 `id` bigint(20) ,
 `number` varchar(20) ,
 `name` varchar(80) ,
 `description` varchar(255) ,
 `status` varchar(15) ,
 `startDate` varchar(10) ,
 `endDate` varchar(10) ,
 `applicationNumber` varchar(20) ,
 `requestNumber` varchar(20) 
)*/;

/*Table structure for table `bssp_requests_projects_v` */

DROP TABLE IF EXISTS `bssp_requests_projects_v`;

/*!50001 DROP VIEW IF EXISTS `bssp_requests_projects_v` */;
/*!50001 DROP TABLE IF EXISTS `bssp_requests_projects_v` */;

/*!50001 CREATE TABLE  `bssp_requests_projects_v`(
 `requestId` bigint(20) unsigned ,
 `requestNumber` varchar(20) ,
 `requestType` varchar(128) ,
 `requestPriotityArea` varchar(256) ,
 `requestBusinessActivity` varchar(1024) ,
 `requestStatus` varchar(28) ,
 `requestRemarks` varchar(128) ,
 `applicationNumber` varchar(20) ,
 `projectId` bigint(20) ,
 `projectNumber` varchar(20) ,
 `projectName` varchar(80) ,
 `projectDescription` varchar(255) ,
 `projectStatus` varchar(15) ,
 `discussionDate` date ,
 `startDate` varchar(10) ,
 `endDate` varchar(10) 
)*/;

/*Table structure for table `bssp_requests_v` */

DROP TABLE IF EXISTS `bssp_requests_v`;

/*!50001 DROP VIEW IF EXISTS `bssp_requests_v` */;
/*!50001 DROP TABLE IF EXISTS `bssp_requests_v` */;

/*!50001 CREATE TABLE  `bssp_requests_v`(
 `requestId` bigint(20) unsigned ,
 `requestNumber` varchar(20) ,
 `requestType` varchar(128) ,
 `requestPriotityArea` varchar(256) ,
 `requestBusinessActivity` varchar(1024) ,
 `requestStatus` varchar(28) ,
 `requestRemarks` varchar(128) ,
 `applicationNumber` varchar(20) 
)*/;

/*Table structure for table `bssp_resolution_application_requests_v` */

DROP TABLE IF EXISTS `bssp_resolution_application_requests_v`;

/*!50001 DROP VIEW IF EXISTS `bssp_resolution_application_requests_v` */;
/*!50001 DROP TABLE IF EXISTS `bssp_resolution_application_requests_v` */;

/*!50001 CREATE TABLE  `bssp_resolution_application_requests_v`(
 `applicationId` bigint(20) unsigned ,
 `applicationNumber` varchar(20) ,
 `applicationDate` varchar(10) ,
 `applicationAcknowledgementDate` varchar(10) ,
 `applicationLegalEntityId` bigint(20) ,
 `requestId` bigint(20) unsigned ,
 `requestNumber` varchar(20) ,
 `requestType` varchar(128) ,
 `requestPriotityArea` varchar(256) ,
 `requestBusinessActivity` varchar(1024) ,
 `requestStatus` varchar(28) ,
 `requestRemarks` varchar(128) ,
 `firstName` varchar(45) ,
 `middleName` varchar(45) ,
 `lastName` varchar(45) ,
 `dateOfBirth` varchar(10) ,
 `passportNumber` varchar(15) ,
 `identityNumber` varchar(15) ,
 `companyName` varchar(256) ,
 `companyRegistrationNumber` varchar(30) ,
 `applicantName` varchar(289) ,
 `entityType` varchar(30) ,
 `emailAddress` varchar(128) ,
 `telephoneNumber` varchar(24) ,
 `mobileNumber` varchar(24) ,
 `faxNumber` varchar(24) ,
 `resolutionId` bigint(20) unsigned ,
 `resolutionDiscussionDate` varchar(10) ,
 `resolutionDiscussionStatus` varchar(120) ,
 `resolutionCorespondenceDate` varchar(10) ,
 `resolutionRemarks` varchar(4000) ,
 `resolution_requestNumber` varchar(20) 
)*/;

/*Table structure for table `bssp_resolutions_v` */

DROP TABLE IF EXISTS `bssp_resolutions_v`;

/*!50001 DROP VIEW IF EXISTS `bssp_resolutions_v` */;
/*!50001 DROP TABLE IF EXISTS `bssp_resolutions_v` */;

/*!50001 CREATE TABLE  `bssp_resolutions_v`(
 `resolutionId` bigint(20) unsigned ,
 `resolutionDiscussionDate` varchar(10) ,
 `resolutionDiscussionStatus` varchar(120) ,
 `resolutionCorespondenceDate` varchar(10) ,
 `resolutionRemarks` varchar(4000) ,
 `resolution_requestNumber` varchar(20) 
)*/;

/*Table structure for table `city_towns_lov_v` */

DROP TABLE IF EXISTS `city_towns_lov_v`;

/*!50001 DROP VIEW IF EXISTS `city_towns_lov_v` */;
/*!50001 DROP TABLE IF EXISTS `city_towns_lov_v` */;

/*!50001 CREATE TABLE  `city_towns_lov_v`(
 `region` varchar(128) ,
 `value` varchar(128) ,
 `label` varchar(128) 
)*/;

/*Table structure for table `constituences_lov_v` */

DROP TABLE IF EXISTS `constituences_lov_v`;

/*!50001 DROP VIEW IF EXISTS `constituences_lov_v` */;
/*!50001 DROP TABLE IF EXISTS `constituences_lov_v` */;

/*!50001 CREATE TABLE  `constituences_lov_v`(
 `town` varchar(128) ,
 `value` varchar(128) ,
 `label` varchar(128) 
)*/;

/*Table structure for table `countries_lov_v` */

DROP TABLE IF EXISTS `countries_lov_v`;

/*!50001 DROP VIEW IF EXISTS `countries_lov_v` */;
/*!50001 DROP TABLE IF EXISTS `countries_lov_v` */;

/*!50001 CREATE TABLE  `countries_lov_v`(
 `code` char(3) ,
 `name` char(52) 
)*/;

/*Table structure for table `regions_lov_v` */

DROP TABLE IF EXISTS `regions_lov_v`;

/*!50001 DROP VIEW IF EXISTS `regions_lov_v` */;
/*!50001 DROP TABLE IF EXISTS `regions_lov_v` */;

/*!50001 CREATE TABLE  `regions_lov_v`(
 `value` varchar(128) ,
 `label` varchar(128) 
)*/;

/*View structure for view bssp_address_v */

/*!50001 DROP TABLE IF EXISTS `bssp_address_v` */;
/*!50001 DROP VIEW IF EXISTS `bssp_address_v` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `bssp_address_v` AS (select `bssp_address`.`id` AS `addressId`,`bssp_address`.`addressLineOne` AS `addressLineOne`,`bssp_address`.`addressLineTwo` AS `addressLineTwo`,`bssp_address`.`postalAddress` AS `postalAddress`,`bssp_address`.`regionCode` AS `regionCode`,`bssp_address`.`cityCode` AS `cityCode`,`bssp_address`.`constituencyCode` AS `constituencyCode`,`bssp_address`.`countryCode` AS `countryCode`,`bssp_address`.`legalEntityId` AS `legalEntityId` from `bssp_address`) */;

/*View structure for view bssp_applications_legal_entity_v */

/*!50001 DROP TABLE IF EXISTS `bssp_applications_legal_entity_v` */;
/*!50001 DROP VIEW IF EXISTS `bssp_applications_legal_entity_v` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `bssp_applications_legal_entity_v` AS select `ba`.`id` AS `applicationId`,`ba`.`applicationNumber` AS `applicationNumber`,`ba`.`applicationLegalEntityType` AS `applicationLegalEntityType`,date_format(`ba`.`applicationDate`,'%d/%m/%Y') AS `applicationDate`,date_format(`ba`.`applicationAcknowledgementDate`,'%d/%m/%Y') AS `applicationAcknowledgementDate`,`ba`.`applicationLegalEntityId` AS `applicationLegalEntityId`,`br`.`id` AS `requestId`,`br`.`requestNumber` AS `requestNumber`,`br`.`requestType` AS `requestType`,`br`.`requestPriotityArea` AS `requestPriotityArea`,`br`.`requestBusinessActivity` AS `requestBusinessActivity`,`br`.`requestStatus` AS `requestStatus`,`br`.`requestRemarks` AS `requestRemarks`,`le`.`entityType` AS `entityType`,coalesce(if((concat_ws(' ',`le`.`firstName`,`le`.`middleName`,`le`.`lastName`) = ''),NULL,concat_ws(' ',`le`.`firstName`,`le`.`middleName`,`le`.`lastName`)),if((concat_ws(' ',`le`.`companyName`,`le`.`companyRegistrationNumber`) = ''),NULL,concat_ws(' - ',`le`.`companyName`,`le`.`companyRegistrationNumber`))) AS `applicantName` from ((`bssp_applications` `ba` join `bssp_legal_entities` `le` on((`ba`.`applicationLegalEntityId` = `le`.`id`))) join `bssp_requests` `br` on((`br`.`applicationNumber` = `ba`.`applicationNumber`))) order by `ba`.`applicationNumber` */;

/*View structure for view bssp_applications_v */

/*!50001 DROP TABLE IF EXISTS `bssp_applications_v` */;
/*!50001 DROP VIEW IF EXISTS `bssp_applications_v` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `bssp_applications_v` AS select `ba`.`id` AS `applicationId`,`ba`.`applicationNumber` AS `applicationNumber`,date_format(`ba`.`applicationDate`,'%d/%m/%Y') AS `applicationDate`,date_format(`ba`.`applicationAcknowledgementDate`,'%d/%m/%Y') AS `applicationAcknowledgementDate`,`ba`.`applicationLegalEntityId` AS `applicationLegalEntityId`,`br`.`id` AS `requestId`,`br`.`requestNumber` AS `requestNumber`,`br`.`requestType` AS `requestType`,`br`.`requestPriotityArea` AS `requestPriotityArea`,`br`.`requestBusinessActivity` AS `requestBusinessActivity`,`br`.`requestStatus` AS `requestStatus`,`br`.`requestRemarks` AS `requestRemarks`,`le`.`firstName` AS `firstName`,`le`.`middleName` AS `middleName`,`le`.`lastName` AS `lastName`,date_format(`le`.`dateOfBirth`,'%d/%m/%Y') AS `dateOfBirth`,`le`.`passportNumber` AS `passportNumber`,`le`.`identityNumber` AS `identityNumber`,`le`.`companyName` AS `companyName`,`le`.`companyRegistrationNumber` AS `companyRegistrationNumber`,coalesce(if((concat_ws(' ',`le`.`firstName`,`le`.`middleName`,`le`.`lastName`) = ''),NULL,concat_ws(' ',`le`.`firstName`,`le`.`middleName`,`le`.`lastName`)),if((concat_ws(' ',`le`.`companyName`,`le`.`companyRegistrationNumber`) = ''),NULL,concat_ws(' - ',`le`.`companyName`,`le`.`companyRegistrationNumber`))) AS `applicantName`,`le`.`entityType` AS `entityType`,`le`.`emailAddress` AS `emailAddress`,`le`.`telephoneNumber` AS `telephoneNumber`,`le`.`mobileNumber` AS `mobileNumber`,`le`.`faxNumber` AS `faxNumber` from ((`bssp_applications` `ba` join `bssp_legal_entities` `le` on((`ba`.`applicationLegalEntityId` = `le`.`id`))) join `bssp_requests` `br` on((`br`.`applicationNumber` = `ba`.`applicationNumber`))) order by `ba`.`applicationNumber` */;

/*View structure for view bssp_contact_v */

/*!50001 DROP TABLE IF EXISTS `bssp_contact_v` */;
/*!50001 DROP VIEW IF EXISTS `bssp_contact_v` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `bssp_contact_v` AS select `bssp_contacts`.`id` AS `contactId`,`bssp_contacts`.`contactFirstName` AS `contactFirstName`,`bssp_contacts`.`contactMiddleName` AS `contactMiddleName`,`bssp_contacts`.`contactLastName` AS `contactLastName`,`bssp_contacts`.`contactPosition` AS `contactPosition`,`bssp_contacts`.`contactTitle` AS `contactTitle`,`bssp_contacts`.`legalEntityId` AS `legalEntityId` from `bssp_contacts` */;

/*View structure for view bssp_employment_creation_v */

/*!50001 DROP TABLE IF EXISTS `bssp_employment_creation_v` */;
/*!50001 DROP VIEW IF EXISTS `bssp_employment_creation_v` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `bssp_employment_creation_v` AS select `bssp_employment_creation`.`id` AS `employmentCreationId`,`bssp_employment_creation`.`employmentNumberOfMales` AS `employmentNumberOfMales`,`bssp_employment_creation`.`employmentNumberOfFemales` AS `employmentNumberOfFemales`,date_format(`bssp_employment_creation`.`employmentDateOfEmployment`,'%d/%m/%Y') AS `employmentDateOfEmployment`,`bssp_employment_creation`.`employmentRemarks` AS `employmentRemarks`,`bssp_employment_creation`.`projectNumber` AS `projectNumber` from `bssp_employment_creation` order by `bssp_employment_creation`.`projectNumber` desc */;

/*View structure for view bssp_legal_entities_dataset_v */

/*!50001 DROP TABLE IF EXISTS `bssp_legal_entities_dataset_v` */;
/*!50001 DROP VIEW IF EXISTS `bssp_legal_entities_dataset_v` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `bssp_legal_entities_dataset_v` AS (select `le`.`id` AS `id`,`le`.`firstName` AS `firstName`,`le`.`middleName` AS `middleName`,`le`.`lastName` AS `lastName`,`le`.`dateOfBirth` AS `dateOfBirth`,`le`.`passportNumber` AS `passportNumber`,`le`.`identityNumber` AS `identityNumber`,`le`.`companyName` AS `companyName`,`le`.`companyRegistrationNumber` AS `companyRegistrationNumber`,`le`.`entityType` AS `entityType`,`le`.`entityCategory` AS `entityCategory`,`le`.`emailAddress` AS `emailAddress`,`le`.`telephoneNumber` AS `telephoneNumber`,`le`.`mobileNumber` AS `mobileNumber`,`le`.`faxNumber` AS `faxNumber`,`a`.`id` AS `addressId`,`a`.`addressLineOne` AS `addressLineOne`,`a`.`addressLineTwo` AS `addressLineTwo`,`a`.`postalAddress` AS `postalAddress`,`a`.`regionCode` AS `regionCode`,`a`.`cityCode` AS `cityCode`,`a`.`constituencyCode` AS `constituencyCode`,`a`.`countryCode` AS `countryCode`,`a`.`legalEntityId` AS `legalEntityId` from (`bssp_legal_entities` `le` join `bssp_address` `a` on((`le`.`id` = `a`.`legalEntityId`)))) */;

/*View structure for view bssp_legal_entities_v */

/*!50001 DROP TABLE IF EXISTS `bssp_legal_entities_v` */;
/*!50001 DROP VIEW IF EXISTS `bssp_legal_entities_v` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `bssp_legal_entities_v` AS (select coalesce(if((concat_ws(' ',`le`.`firstName`,`le`.`middleName`,`le`.`lastName`) = ''),NULL,concat_ws(' ',`le`.`firstName`,`le`.`middleName`,`le`.`lastName`)),if((concat_ws(' ',`le`.`companyName`,`le`.`companyRegistrationNumber`) = ''),NULL,concat_ws(' - ',`le`.`companyName`,`le`.`companyRegistrationNumber`))) AS `legalEntityName`,`le`.`id` AS `id`,`le`.`entityType` AS `entityType`,`le`.`entityCategory` AS `entityCategory` from `bssp_legal_entities` `le` where (`le`.`entityCategory` is not null)) */;

/*View structure for view bssp_master_budgets_lov_v */

/*!50001 DROP TABLE IF EXISTS `bssp_master_budgets_lov_v` */;
/*!50001 DROP VIEW IF EXISTS `bssp_master_budgets_lov_v` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `bssp_master_budgets_lov_v` AS (select concat_ws(' : ',`bssp_master_budgets`.`code`,`bssp_master_budgets`.`name`) AS `label`,`bssp_master_budgets`.`code` AS `value` from `bssp_master_budgets` where (`bssp_master_budgets`.`code` is not null)) */;

/*View structure for view bssp_project_budget_details_v */

/*!50001 DROP TABLE IF EXISTS `bssp_project_budget_details_v` */;
/*!50001 DROP VIEW IF EXISTS `bssp_project_budget_details_v` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `bssp_project_budget_details_v` AS select `bssp_project_budgets`.`budgetNumber` AS `budgetNumber`,`bssp_project_budgets`.`budgetAmount` AS `budgetAmount`,(select sum(`bssp_project_payment_installments`.`installmentAmount`) from `bssp_project_payment_installments` where (`bssp_project_payment_installments`.`installmentBudgetNumber` = `bssp_project_budgets`.`budgetNumber`)) AS `paidAmount`,(`bssp_project_budgets`.`budgetAmount` - (select sum(`bssp_project_payment_installments`.`installmentAmount`) from `bssp_project_payment_installments` where (`bssp_project_payment_installments`.`installmentBudgetNumber` = `bssp_project_budgets`.`budgetNumber`))) AS `autstandingAmount`,`bssp_project_budgets`.`projectNumber` AS `projectNumber`,`bssp_project_budgets`.`masterBudgetNumber` AS `masterBudgetNumber` from (`bssp_project_budgets` join `bssp_project_payment_installments` on((`bssp_project_budgets`.`budgetNumber` = `bssp_project_payment_installments`.`installmentBudgetNumber`))) group by `bssp_project_budgets`.`projectNumber` */;

/*View structure for view bssp_project_budget_lov_v */

/*!50001 DROP TABLE IF EXISTS `bssp_project_budget_lov_v` */;
/*!50001 DROP VIEW IF EXISTS `bssp_project_budget_lov_v` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `bssp_project_budget_lov_v` AS (select `bssp_project_budgets`.`budgetNumber` AS `budgetNumber`,concat_ws(' - ',`bssp_project_budgets`.`budgetName`,`bssp_project_budgets`.`budgetAmount`) AS `budget` from `bssp_project_budgets`) */;

/*View structure for view bssp_project_implementation_v */

/*!50001 DROP TABLE IF EXISTS `bssp_project_implementation_v` */;
/*!50001 DROP VIEW IF EXISTS `bssp_project_implementation_v` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `bssp_project_implementation_v` AS select `bssp_project_implementation`.`id` AS `implementationId`,date_format(`bssp_project_implementation`.`implementationDateOfIssueToPromoters`,'%d/%m/%Y') AS `implementationDateOfIssueToPromoters`,`bssp_project_implementation`.`implementationReportType` AS `implementationReportType`,`bssp_project_implementation`.`implementationSourceOfFunds` AS `implementationSourceOfFunds`,`bssp_project_implementation`.`implementationRemarks` AS `implementationRemarks`,`bssp_project_implementation`.`projectNumber` AS `projectNumber` from `bssp_project_implementation` order by `bssp_project_implementation`.`projectNumber` desc */;

/*View structure for view bssp_projects_v */

/*!50001 DROP TABLE IF EXISTS `bssp_projects_v` */;
/*!50001 DROP VIEW IF EXISTS `bssp_projects_v` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `bssp_projects_v` AS select `bssp_projects`.`id` AS `id`,`bssp_projects`.`number` AS `number`,ucase(`bssp_projects`.`name`) AS `name`,`bssp_projects`.`description` AS `description`,`bssp_projects`.`status` AS `status`,date_format(`bssp_projects`.`startDate`,'%d/%m/%Y') AS `startDate`,date_format(`bssp_projects`.`endDate`,'%d/%m/%Y') AS `endDate`,`bssp_projects`.`applicationNumber` AS `applicationNumber`,`bssp_projects`.`requestNumber` AS `requestNumber` from `bssp_projects` order by `bssp_projects`.`number` desc */;

/*View structure for view bssp_requests_projects_v */

/*!50001 DROP TABLE IF EXISTS `bssp_requests_projects_v` */;
/*!50001 DROP VIEW IF EXISTS `bssp_requests_projects_v` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `bssp_requests_projects_v` AS select `r`.`id` AS `requestId`,`r`.`requestNumber` AS `requestNumber`,ucase(`r`.`requestType`) AS `requestType`,ucase(`r`.`requestPriotityArea`) AS `requestPriotityArea`,`r`.`requestBusinessActivity` AS `requestBusinessActivity`,`r`.`requestStatus` AS `requestStatus`,`r`.`requestRemarks` AS `requestRemarks`,`r`.`applicationNumber` AS `applicationNumber`,`p`.`id` AS `projectId`,`p`.`number` AS `projectNumber`,ucase(`p`.`name`) AS `projectName`,`p`.`description` AS `projectDescription`,`p`.`status` AS `projectStatus`,`p`.`discussionDate` AS `discussionDate`,date_format(`p`.`startDate`,'%d/%m/%Y') AS `startDate`,date_format(`p`.`endDate`,'%d/%m/%Y') AS `endDate` from (`bssp_requests` `r` join `bssp_projects` `p` on((`r`.`requestNumber` = `p`.`requestNumber`))) order by `p`.`number` */;

/*View structure for view bssp_requests_v */

/*!50001 DROP TABLE IF EXISTS `bssp_requests_v` */;
/*!50001 DROP VIEW IF EXISTS `bssp_requests_v` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `bssp_requests_v` AS (select `bssp_requests`.`id` AS `requestId`,`bssp_requests`.`requestNumber` AS `requestNumber`,`bssp_requests`.`requestType` AS `requestType`,`bssp_requests`.`requestPriotityArea` AS `requestPriotityArea`,`bssp_requests`.`requestBusinessActivity` AS `requestBusinessActivity`,`bssp_requests`.`requestStatus` AS `requestStatus`,`bssp_requests`.`requestRemarks` AS `requestRemarks`,`bssp_requests`.`applicationNumber` AS `applicationNumber` from `bssp_requests`) */;

/*View structure for view bssp_resolution_application_requests_v */

/*!50001 DROP TABLE IF EXISTS `bssp_resolution_application_requests_v` */;
/*!50001 DROP VIEW IF EXISTS `bssp_resolution_application_requests_v` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `bssp_resolution_application_requests_v` AS select `ba`.`id` AS `applicationId`,`ba`.`applicationNumber` AS `applicationNumber`,date_format(`ba`.`applicationDate`,'%d/%m/%Y') AS `applicationDate`,date_format(`ba`.`applicationAcknowledgementDate`,'%d/%m/%Y') AS `applicationAcknowledgementDate`,`ba`.`applicationLegalEntityId` AS `applicationLegalEntityId`,`br`.`id` AS `requestId`,`br`.`requestNumber` AS `requestNumber`,`br`.`requestType` AS `requestType`,`br`.`requestPriotityArea` AS `requestPriotityArea`,`br`.`requestBusinessActivity` AS `requestBusinessActivity`,`br`.`requestStatus` AS `requestStatus`,`br`.`requestRemarks` AS `requestRemarks`,`le`.`firstName` AS `firstName`,`le`.`middleName` AS `middleName`,`le`.`lastName` AS `lastName`,date_format(`le`.`dateOfBirth`,'%d/%m/%Y') AS `dateOfBirth`,`le`.`passportNumber` AS `passportNumber`,`le`.`identityNumber` AS `identityNumber`,`le`.`companyName` AS `companyName`,`le`.`companyRegistrationNumber` AS `companyRegistrationNumber`,coalesce(if((concat_ws(' ',`le`.`firstName`,`le`.`middleName`,`le`.`lastName`) = ''),NULL,concat_ws(' ',`le`.`firstName`,`le`.`middleName`,`le`.`lastName`)),if((concat_ws(' ',`le`.`companyName`,`le`.`companyRegistrationNumber`) = ''),NULL,concat_ws(' - ',`le`.`companyName`,`le`.`companyRegistrationNumber`))) AS `applicantName`,`le`.`entityType` AS `entityType`,`le`.`emailAddress` AS `emailAddress`,`le`.`telephoneNumber` AS `telephoneNumber`,`le`.`mobileNumber` AS `mobileNumber`,`le`.`faxNumber` AS `faxNumber`,`r`.`id` AS `resolutionId`,date_format(`r`.`resolutionDiscussionDate`,'%d/%m/%Y') AS `resolutionDiscussionDate`,`r`.`resolutionDiscussionStatus` AS `resolutionDiscussionStatus`,date_format(`r`.`resolutionCorespondenceDate`,'%d/%m/%Y') AS `resolutionCorespondenceDate`,`r`.`resolutionRemarks` AS `resolutionRemarks`,`r`.`resolution_requestNumber` AS `resolution_requestNumber` from (((`bssp_applications` `ba` join `bssp_legal_entities` `le` on((`ba`.`applicationLegalEntityId` = `le`.`id`))) join `bssp_requests` `br` on((`br`.`applicationNumber` = `ba`.`applicationNumber`))) join `bssp_resolutions` `r` on((`r`.`resolution_requestNumber` = `br`.`requestNumber`))) order by `ba`.`applicationNumber` */;

/*View structure for view bssp_resolutions_v */

/*!50001 DROP TABLE IF EXISTS `bssp_resolutions_v` */;
/*!50001 DROP VIEW IF EXISTS `bssp_resolutions_v` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `bssp_resolutions_v` AS (select `bssp_resolutions`.`id` AS `resolutionId`,date_format(`bssp_resolutions`.`resolutionDiscussionDate`,'%d/%m/%Y') AS `resolutionDiscussionDate`,`bssp_resolutions`.`resolutionDiscussionStatus` AS `resolutionDiscussionStatus`,date_format(`bssp_resolutions`.`resolutionCorespondenceDate`,'%d/%m/%Y') AS `resolutionCorespondenceDate`,`bssp_resolutions`.`resolutionRemarks` AS `resolutionRemarks`,`bssp_resolutions`.`resolution_requestNumber` AS `resolution_requestNumber` from `bssp_resolutions`) */;

/*View structure for view city_towns_lov_v */

/*!50001 DROP TABLE IF EXISTS `city_towns_lov_v` */;
/*!50001 DROP VIEW IF EXISTS `city_towns_lov_v` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `city_towns_lov_v` AS (select `ref_cities_towns`.`regionCode` AS `region`,`ref_cities_towns`.`code` AS `value`,`ref_cities_towns`.`name` AS `label` from `ref_cities_towns`) */;

/*View structure for view constituences_lov_v */

/*!50001 DROP TABLE IF EXISTS `constituences_lov_v` */;
/*!50001 DROP VIEW IF EXISTS `constituences_lov_v` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `constituences_lov_v` AS (select `ref_constituences`.`cityTownCode` AS `town`,`ref_constituences`.`code` AS `value`,`ref_constituences`.`name` AS `label` from `ref_constituences`) */;

/*View structure for view countries_lov_v */

/*!50001 DROP TABLE IF EXISTS `countries_lov_v` */;
/*!50001 DROP VIEW IF EXISTS `countries_lov_v` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `countries_lov_v` AS (select `country`.`code` AS `code`,`country`.`name` AS `name` from `country`) */;

/*View structure for view regions_lov_v */

/*!50001 DROP TABLE IF EXISTS `regions_lov_v` */;
/*!50001 DROP VIEW IF EXISTS `regions_lov_v` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `regions_lov_v` AS (select `ref_regions`.`code` AS `value`,`ref_regions`.`name` AS `label` from `ref_regions`) */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
