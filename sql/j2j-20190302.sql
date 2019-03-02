-- MySQL dump 10.13  Distrib 8.0.13, for Win64 (x86_64)
--
-- Host: localhost    Database: job2job
-- ------------------------------------------------------
-- Server version	8.0.13

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `j2j_application`
--

DROP TABLE IF EXISTS `j2j_application`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `j2j_application` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `comments` text,
  `cover` text,
  `createdate` datetime NOT NULL,
  `updatedate` datetime NOT NULL,
  `photo` varchar(200) DEFAULT NULL,
  `workpermission` smallint(6) DEFAULT '1',
  `email` varchar(55) NOT NULL,
  `tel` varchar(80) NOT NULL,
  `adress` text,
  `status` smallint(6) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `FK_APPLICATION_USER_idx` (`userid`),
  KEY `FK_APPLICATION_WORKPERMISSION_idx` (`workpermission`),
  CONSTRAINT `FK_APPLICATION_USER` FOREIGN KEY (`userid`) REFERENCES `j2j_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_APPLICATION_WORKPERMISSION` FOREIGN KEY (`workpermission`) REFERENCES `j2j_workpermission` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `j2j_application`
--

LOCK TABLES `j2j_application` WRITE;
/*!40000 ALTER TABLE `j2j_application` DISABLE KEYS */;
/*!40000 ALTER TABLE `j2j_application` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `j2j_applicationattachment`
--

DROP TABLE IF EXISTS `j2j_applicationattachment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `j2j_applicationattachment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `applicationid` int(11) NOT NULL,
  `fileurl` varchar(200) NOT NULL,
  `createdate` datetime DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `FK_APPLICATION_ATTACHMENT_idx` (`applicationid`),
  CONSTRAINT `FK_APPLICATION_ATTACHMENT` FOREIGN KEY (`applicationid`) REFERENCES `j2j_application` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `j2j_applicationattachment`
--

LOCK TABLES `j2j_applicationattachment` WRITE;
/*!40000 ALTER TABLE `j2j_applicationattachment` DISABLE KEYS */;
/*!40000 ALTER TABLE `j2j_applicationattachment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `j2j_applicationskill`
--

DROP TABLE IF EXISTS `j2j_applicationskill`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `j2j_applicationskill` (
  `applicationid` int(11) NOT NULL,
  `skillid` int(11) NOT NULL,
  `createdate` datetime NOT NULL,
  PRIMARY KEY (`applicationid`,`skillid`),
  KEY `FK_SKILL_APLICATIONSKILL_idx` (`skillid`),
  CONSTRAINT `FK_APPLICATION_APLICATIONSKILL` FOREIGN KEY (`applicationid`) REFERENCES `j2j_application` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_SKILL_APLICATIONSKILL` FOREIGN KEY (`skillid`) REFERENCES `j2j_skills` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `j2j_applicationskill`
--

LOCK TABLES `j2j_applicationskill` WRITE;
/*!40000 ALTER TABLE `j2j_applicationskill` DISABLE KEYS */;
/*!40000 ALTER TABLE `j2j_applicationskill` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `j2j_backlog`
--

DROP TABLE IF EXISTS `j2j_backlog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `j2j_backlog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `logdesc` varchar(2000) NOT NULL DEFAULT 'Keine Kommentar',
  `logdate` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_BACKLOG_USER_idx` (`userid`),
  CONSTRAINT `FK_BACKLOG_USER` FOREIGN KEY (`userid`) REFERENCES `j2j_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `j2j_backlog`
--

LOCK TABLES `j2j_backlog` WRITE;
/*!40000 ALTER TABLE `j2j_backlog` DISABLE KEYS */;
/*!40000 ALTER TABLE `j2j_backlog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `j2j_backmessage`
--

DROP TABLE IF EXISTS `j2j_backmessage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `j2j_backmessage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `title` varchar(100) DEFAULT '(no title)',
  `message` varchar(400) NOT NULL DEFAULT '(no message)',
  `words` varchar(200) NOT NULL DEFAULT '-',
  `status` smallint(6) DEFAULT '0',
  `createdate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_BACKMESSAGE_USER_idx` (`userid`),
  CONSTRAINT `FK_BACKMESSAGE_USER` FOREIGN KEY (`userid`) REFERENCES `j2j_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `j2j_backmessage`
--

LOCK TABLES `j2j_backmessage` WRITE;
/*!40000 ALTER TABLE `j2j_backmessage` DISABLE KEYS */;
INSERT INTO `j2j_backmessage` VALUES (1,1,'dfgds','dfgds','-',0,'2016-09-28 10:08:54');
/*!40000 ALTER TABLE `j2j_backmessage` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `j2j_branch`
--

DROP TABLE IF EXISTS `j2j_branch`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `j2j_branch` (
  `id` int(11) NOT NULL,
  `title` varchar(80) DEFAULT NULL,
  `shortcut` varchar(45) NOT NULL DEFAULT '-',
  `image` varchar(200) DEFAULT NULL,
  `logo` varchar(200) NOT NULL DEFAULT '-',
  `status` smallint(6) NOT NULL DEFAULT '1',
  `created` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  `updated` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  PRIMARY KEY (`id`),
  UNIQUE KEY `shortcut_UNIQUE` (`shortcut`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `j2j_branch`
--

LOCK TABLES `j2j_branch` WRITE;
/*!40000 ALTER TABLE `j2j_branch` DISABLE KEYS */;
INSERT INTO `j2j_branch` VALUES (1,'Gesundheitswesen','med','/web/images/branch-med.jpg','/web/images/parma-logo.png',1,'2018-07-12 18:37:07.482775','2018-07-12 18:37:07.482775'),(2,'Kaufmännischer Sektor','commercial','/web/images/branch-buss.jpg','/web/images/finanz-logo.png',1,'2018-07-12 18:39:19.062952','2018-07-12 18:39:19.062952'),(3,'Industrie und Handwerk','industry','/web/images/branch-industry.png','/web/images/engin-logo.png',1,'2018-07-12 18:39:19.062952','2018-07-12 18:39:19.062952'),(4,'Ingenieurwesen und Technik','engineering','/web/images/branch-eng.pn','/web/images/engin-logo.png',1,'2018-07-12 18:39:19.062952','2018-07-12 18:39:19.062952'),(5,'Lager und Logistik','logistic','/web/images/branch-logistic.png','/web/images/engin-logo.png',1,'2018-07-12 18:39:19.063950','2018-07-12 18:39:19.063950'),(6,'Produktion und Gewerbe','production','/web/images/branch-production.png','/web/images/engin-logo.png',1,'2018-07-12 18:39:19.063950','2018-07-12 18:39:19.063950');
/*!40000 ALTER TABLE `j2j_branch` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `j2j_callrequest`
--

DROP TABLE IF EXISTS `j2j_callrequest`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `j2j_callrequest` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL DEFAULT '0',
  `tel` varchar(45) NOT NULL,
  `name` varchar(100) NOT NULL,
  `message` varchar(2000) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1',
  `createdate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `j2j_callrequest`
--

LOCK TABLES `j2j_callrequest` WRITE;
/*!40000 ALTER TABLE `j2j_callrequest` DISABLE KEYS */;
INSERT INTO `j2j_callrequest` VALUES (1,30,'0054-324-1234','sef1, hamid1','mmmmmmm',0,'2017-08-01 15:00:31'),(2,30,'0054-324-1234','sef1, hamid1','nnnnnnnnnnnn',0,'2017-08-01 15:01:09'),(3,9,'0049-162-2810148','Seifi, Hamidreza','adrtdtrhertj',0,'2017-08-01 15:01:31'),(4,9,'0049-162-2810148','Seifi, Hamidreza','dfdf\r\ndfthezjntz\r\nwertrewurezjte',0,'2017-08-01 15:01:37'),(5,30,'0054-324-1234','sef1, hamid1','sdhdfjnwrt',0,'2017-08-01 15:02:03'),(6,30,'0054-324-1234','sef1, hamid1','',0,'2017-08-01 17:34:24'),(7,30,'0054-324-1234','sef1, hamid1','tttttttttttttttt',0,'2017-08-01 17:40:45'),(8,30,'0054-324-1234','sef1, hamid1','',0,'2017-08-01 17:49:55'),(9,30,'0054-324-1234','sef1, hamid1','',0,'2017-08-01 17:49:59'),(10,30,'0054-324-1234','sef1, hamid1','',0,'2017-08-01 17:51:03'),(11,30,'0054-324-1234','sef1, hamid1','dfghfg',0,'2017-08-01 18:06:35'),(12,30,'0054-324-1234','sef1, hamid1','',0,'2017-08-01 18:06:58'),(13,30,'0054-324-1234','sef1, hamid1','',0,'2017-08-01 18:36:15'),(14,9,'0049-162-2810148','Seifi, Hamidreza','sdfgsdfh',0,'2017-08-01 18:36:34'),(15,0,'','','',0,'2017-08-11 16:48:32'),(16,0,'','','',0,'2017-08-11 16:48:40'),(17,0,'35645','trgert','frghrgjh',0,'2017-08-11 16:48:50');
/*!40000 ALTER TABLE `j2j_callrequest` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `j2j_candidate`
--

DROP TABLE IF EXISTS `j2j_candidate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `j2j_candidate` (
  `userid` int(11) NOT NULL,
  `title` varchar(15) DEFAULT '',
  `title2` varchar(45) DEFAULT '',
  `nationality` varchar(45) NOT NULL DEFAULT '-',
  `photo` varchar(200) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `homenumber` varchar(15) DEFAULT NULL,
  `street` varchar(45) DEFAULT NULL,
  `pcode` varchar(45) DEFAULT NULL,
  `city` varchar(45) DEFAULT NULL,
  `country` varchar(45) DEFAULT NULL,
  `address1` varchar(200) DEFAULT NULL,
  `cellphone` varchar(45) DEFAULT NULL,
  `tel` varchar(45) DEFAULT NULL,
  `reachability` varchar(45) DEFAULT NULL,
  `contacttime` varchar(45) DEFAULT NULL,
  `employment` smallint(6) DEFAULT '0',
  `availability` varchar(45) NOT NULL DEFAULT '',
  `branch` int(11) NOT NULL,
  `availablefrom` datetime DEFAULT NULL,
  `desiredjobpcode` varchar(45) DEFAULT NULL,
  `desiredjobcity` varchar(45) DEFAULT NULL,
  `desiredjobcountry` varchar(45) DEFAULT NULL,
  `desiredjobregion` int(11) DEFAULT NULL,
  `coverletter` text,
  `workpermission` smallint(6) NOT NULL DEFAULT '0',
  `workpermissionlimit` date DEFAULT NULL,
  `createdate` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  `updatedate` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  PRIMARY KEY (`userid`),
  CONSTRAINT `FK_CANDIDATE_USER` FOREIGN KEY (`userid`) REFERENCES `j2j_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `j2j_candidate`
--

LOCK TABLES `j2j_candidate` WRITE;
/*!40000 ALTER TABLE `j2j_candidate` DISABLE KEYS */;
INSERT INTO `j2j_candidate` VALUES (9,'Herr','','iranisch',NULL,'hamidrezaseifi@gmail.com',NULL,NULL,'30419','Hannover','Deutschland','Rigaer St. 29G','0049-162-2810148','0049-162-2810148','Telefon, E-Mail, ','08:00 bis  18:00',1,'Verfügber',3,'2018-07-20 17:00:00','','','',10,'mein anschzturt\r\nrtuzjtzi\r\nzuitzutilotzirtzu',1,NULL,'2017-04-09 22:00:00.000000','2019-03-01 23:00:00.000000'),(84,'Frau','','-',NULL,'bewerber@b.de','','','','',NULL,'',NULL,'',NULL,NULL,0,'',3,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,'2018-11-01 14:23:35.304494','2018-11-01 14:23:35.304494');
/*!40000 ALTER TABLE `j2j_candidate` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `j2j_candidatefavorite`
--

DROP TABLE IF EXISTS `j2j_candidatefavorite`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `j2j_candidatefavorite` (
  `userid` int(11) NOT NULL,
  `jobposid` int(11) NOT NULL,
  `createdate` datetime NOT NULL,
  PRIMARY KEY (`userid`,`jobposid`),
  KEY `FK_CANDIDATEFAV_JOBPOS_idx` (`jobposid`),
  CONSTRAINT `FK_CANDIDATEFAV_JOBPOS` FOREIGN KEY (`jobposid`) REFERENCES `j2j_jobposition` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_CANDIDATEFAV_USER` FOREIGN KEY (`userid`) REFERENCES `j2j_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `j2j_candidatefavorite`
--

LOCK TABLES `j2j_candidatefavorite` WRITE;
/*!40000 ALTER TABLE `j2j_candidatefavorite` DISABLE KEYS */;
/*!40000 ALTER TABLE `j2j_candidatefavorite` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `j2j_candidatejobapply`
--

DROP TABLE IF EXISTS `j2j_candidatejobapply`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `j2j_candidatejobapply` (
  `userid` int(11) NOT NULL,
  `jobposid` int(11) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '0',
  `createdate` datetime NOT NULL,
  PRIMARY KEY (`userid`,`jobposid`),
  KEY `FK_CANDIDATEJOBAPPLY_JOBPOS_idx` (`jobposid`),
  CONSTRAINT `FK_CANDIDATEJOBAPPLY_JOBPOS` FOREIGN KEY (`jobposid`) REFERENCES `j2j_jobposition` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_CANDIDATEJOBAPPLY_USER` FOREIGN KEY (`userid`) REFERENCES `j2j_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `j2j_candidatejobapply`
--

LOCK TABLES `j2j_candidatejobapply` WRITE;
/*!40000 ALTER TABLE `j2j_candidatejobapply` DISABLE KEYS */;
/*!40000 ALTER TABLE `j2j_candidatejobapply` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `j2j_candidateskill`
--

DROP TABLE IF EXISTS `j2j_candidateskill`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `j2j_candidateskill` (
  `candidateid` int(11) NOT NULL,
  `skill` varchar(100) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`candidateid`,`skill`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `j2j_candidateskill`
--

LOCK TABLES `j2j_candidateskill` WRITE;
/*!40000 ALTER TABLE `j2j_candidateskill` DISABLE KEYS */;
INSERT INTO `j2j_candidateskill` VALUES (9,'C++','2017-07-18 12:21:16'),(9,'QQQQTTTTT','2017-07-18 12:21:16');
/*!40000 ALTER TABLE `j2j_candidateskill` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `j2j_city`
--

DROP TABLE IF EXISTS `j2j_city`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `j2j_city` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL DEFAULT 'Deutschland',
  `status` smallint(6) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `FK_CITY_COUNTRY_idx` (`country`),
  CONSTRAINT `FK_CITY_COUNTRY` FOREIGN KEY (`country`) REFERENCES `j2j_country` (`title`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12332 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `j2j_city`
--

LOCK TABLES `j2j_city` WRITE;
/*!40000 ALTER TABLE `j2j_city` DISABLE KEYS */;
/*!40000 ALTER TABLE `j2j_city` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `j2j_company`
--

DROP TABLE IF EXISTS `j2j_company`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `j2j_company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `companyname` varchar(80) NOT NULL,
  `companytype` int(11) DEFAULT NULL,
  `founddate` datetime DEFAULT NULL,
  `homenumber` varchar(15) DEFAULT NULL,
  `street` varchar(45) DEFAULT NULL,
  `city` varchar(45) DEFAULT NULL,
  `pcode` varchar(15) DEFAULT NULL,
  `adress1` varchar(200) DEFAULT NULL,
  `taxid` varchar(50) DEFAULT NULL,
  `homepage` varchar(200) DEFAULT '',
  `logo` varchar(200) DEFAULT NULL,
  `employeecountindex` smallint(6) DEFAULT '0',
  `isjob2job` smallint(6) NOT NULL DEFAULT '0',
  `status` smallint(6) NOT NULL DEFAULT '1',
  `createdate` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
  `updatedate` timestamp(6) NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `j2j_company`
--

LOCK TABLES `j2j_company` WRITE;
/*!40000 ALTER TABLE `j2j_company` DISABLE KEYS */;
INSERT INTO `j2j_company` VALUES (18,'firma 2',0,'2000-01-01 00:00:00','','','','',NULL,NULL,'',NULL,0,0,1,'2018-11-01 14:25:42.681018',NULL);
/*!40000 ALTER TABLE `j2j_company` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `j2j_companytype`
--

DROP TABLE IF EXISTS `j2j_companytype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `j2j_companytype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `j2j_companytype`
--

LOCK TABLES `j2j_companytype` WRITE;
/*!40000 ALTER TABLE `j2j_companytype` DISABLE KEYS */;
INSERT INTO `j2j_companytype` VALUES (1,'Einzelunternehmen',1),(2,'GmbH',1),(3,'UG',1),(4,'OHG',1),(5,'GbR',1),(6,'KG',1),(7,'AG',1);
/*!40000 ALTER TABLE `j2j_companytype` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `j2j_connectedcompany`
--

DROP TABLE IF EXISTS `j2j_connectedcompany`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `j2j_connectedcompany` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `companyid` int(11) NOT NULL,
  `name` varchar(55) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `FK_CONNECTED_COMPANY_idx` (`companyid`),
  CONSTRAINT `FK_CONNECTED_COMPANY` FOREIGN KEY (`companyid`) REFERENCES `j2j_company` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `j2j_connectedcompany`
--

LOCK TABLES `j2j_connectedcompany` WRITE;
/*!40000 ALTER TABLE `j2j_connectedcompany` DISABLE KEYS */;
/*!40000 ALTER TABLE `j2j_connectedcompany` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `j2j_contants`
--

DROP TABLE IF EXISTS `j2j_contants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `j2j_contants` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(100) NOT NULL,
  `language` varchar(55) NOT NULL,
  `const_type` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `j2j_contants`
--

LOCK TABLES `j2j_contants` WRITE;
/*!40000 ALTER TABLE `j2j_contants` DISABLE KEYS */;
INSERT INTO `j2j_contants` VALUES (2,'Doktor','DE','title2'),(3,'Professor','DE','title2'),(5,'Herr','DE','title'),(6,'Frau','DE','title');
/*!40000 ALTER TABLE `j2j_contants` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `j2j_country`
--

DROP TABLE IF EXISTS `j2j_country`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `j2j_country` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `title_UNIQUE` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=207 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `j2j_country`
--

LOCK TABLES `j2j_country` WRITE;
/*!40000 ALTER TABLE `j2j_country` DISABLE KEYS */;
/*!40000 ALTER TABLE `j2j_country` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `j2j_distance`
--

DROP TABLE IF EXISTS `j2j_distance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `j2j_distance` (
  `title` varchar(50) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1',
  PRIMARY KEY (`title`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `j2j_distance`
--

LOCK TABLES `j2j_distance` WRITE;
/*!40000 ALTER TABLE `j2j_distance` DISABLE KEYS */;
INSERT INTO `j2j_distance` VALUES ('10',1),('15',1),('20',1),('5',1),('50',1);
/*!40000 ALTER TABLE `j2j_distance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `j2j_education`
--

DROP TABLE IF EXISTS `j2j_education`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `j2j_education` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `applicationid` int(11) NOT NULL,
  `degree` int(11) NOT NULL,
  `field` varchar(45) NOT NULL,
  `univercity` varchar(45) NOT NULL,
  `country` varchar(45) NOT NULL,
  `createdate` datetime NOT NULL,
  `updatedate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `j2j_education`
--

LOCK TABLES `j2j_education` WRITE;
/*!40000 ALTER TABLE `j2j_education` DISABLE KEYS */;
/*!40000 ALTER TABLE `j2j_education` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `j2j_emailtext`
--

DROP TABLE IF EXISTS `j2j_emailtext`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `j2j_emailtext` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL DEFAULT '-',
  `text` text,
  `texttype` varchar(45) DEFAULT 'email',
  `status` smallint(6) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `j2j_emailtext`
--

LOCK TABLES `j2j_emailtext` WRITE;
/*!40000 ALTER TABLE `j2j_emailtext` DISABLE KEYS */;
INSERT INTO `j2j_emailtext` VALUES (1,'First Test Text','Ready Text for Email 1\r\nReady Text for Email 2\r\nReady Text for Email 3\r\nReady Text for Email 4\r\n','email',1);
/*!40000 ALTER TABLE `j2j_emailtext` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `j2j_frontlog`
--

DROP TABLE IF EXISTS `j2j_frontlog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `j2j_frontlog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `logdesc` varchar(2000) NOT NULL DEFAULT 'Keine Kommentar',
  `iscandidate` smallint(6) NOT NULL DEFAULT '1',
  `logdate` datetime NOT NULL,
  PRIMARY KEY (`id`,`userid`),
  KEY `FK_FRONTLOG_USER_idx` (`userid`),
  CONSTRAINT `FK_FRONTLOG_USER` FOREIGN KEY (`userid`) REFERENCES `j2j_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `j2j_frontlog`
--

LOCK TABLES `j2j_frontlog` WRITE;
/*!40000 ALTER TABLE `j2j_frontlog` DISABLE KEYS */;
INSERT INTO `j2j_frontlog` VALUES (1,9,'JobFav:53',1,'2017-10-07 15:54:18'),(2,9,'JobApply:53',1,'2017-10-07 15:54:20'),(3,9,'JobFav:52',1,'2017-10-07 15:54:23'),(4,9,'JobApply:52',1,'2017-10-07 15:54:25'),(5,9,'JobFav:29',1,'2017-10-07 15:54:27'),(6,9,'JobApply:29',1,'2017-10-07 15:54:29'),(7,9,'JobFav:28',1,'2017-10-07 15:54:31'),(8,9,'JobFav:26',1,'2017-10-07 15:54:35'),(9,9,'JobFav:21',1,'2017-10-07 15:54:38'),(10,9,'JobFav:22',1,'2017-10-07 15:54:40'),(11,9,'JobApply:22',1,'2017-10-07 15:54:40'),(12,9,'JobApply:21',1,'2017-10-07 15:54:42'),(13,9,'JobApply:26',1,'2017-10-07 15:54:44'),(14,9,'JobFav:23',1,'2017-10-07 15:54:49'),(15,9,'JobApply:23',1,'2017-10-07 15:54:51'),(16,9,'JobApply:25',1,'2017-10-07 15:55:05'),(19,9,'JobApply:53',1,'2017-10-13 16:30:14'),(20,9,'JobFav:14',1,'2017-10-13 16:30:45'),(21,9,'JobApply:14',1,'2017-10-13 16:30:47');
/*!40000 ALTER TABLE `j2j_frontlog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `j2j_jobposition`
--

DROP TABLE IF EXISTS `j2j_jobposition`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `j2j_jobposition` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `companyid` int(11) NOT NULL,
  `title` varchar(80) NOT NULL,
  `subtitle` varchar(500) NOT NULL,
  `postcode` varchar(20) NOT NULL,
  `city` varchar(80) NOT NULL,
  `country` varchar(80) NOT NULL DEFAULT 'Deutschland',
  `comments` text,
  `jobstartdate` datetime NOT NULL,
  `duration` smallint(6) NOT NULL DEFAULT '0',
  `extends` smallint(6) NOT NULL DEFAULT '0',
  `showdate` datetime NOT NULL,
  `expiredate` datetime NOT NULL,
  `branch` int(11) NOT NULL,
  `vacancy` int(11) NOT NULL DEFAULT '0',
  `worktype` int(11) NOT NULL DEFAULT '0',
  `userid` int(11) NOT NULL DEFAULT '0',
  `status` smallint(6) NOT NULL DEFAULT '1',
  `createdate` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  `updatedate` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  PRIMARY KEY (`id`),
  KEY `FK_COMPANY_JOBPOSITION_idx` (`companyid`),
  KEY `FK_JOBPOSITION_VACANCY_idx` (`vacancy`),
  KEY `FK_JOBPOSITION_USER_idx` (`userid`),
  KEY `FK_JOBPOSITION_WORKTYPE_idx` (`worktype`),
  KEY `FK_JOBPOSITION_BRANCH_idx` (`branch`),
  CONSTRAINT `FK_COMPANY_JOBPOSITION` FOREIGN KEY (`companyid`) REFERENCES `j2j_company` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_JOBPOSITION_BRANCH` FOREIGN KEY (`branch`) REFERENCES `j2j_branch` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_JOBPOSITION_USER` FOREIGN KEY (`userid`) REFERENCES `j2j_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_JOBPOSITION_VACANCY` FOREIGN KEY (`vacancy`) REFERENCES `j2j_vacancy` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `j2j_jobposition`
--

LOCK TABLES `j2j_jobposition` WRITE;
/*!40000 ALTER TABLE `j2j_jobposition` DISABLE KEYS */;
INSERT INTO `j2j_jobposition` VALUES (2,18,'test job 1','test job 1','30419','Hannover','Deutschland',NULL,'2019-01-01 00:00:00',0,0,'2019-01-01 00:00:00','2019-10-01 00:00:00',1,1,1,1,1,'2018-11-27 19:11:37.822673','2018-11-27 19:11:37.822673'),(3,18,'test job 2','test job 2','30556','Hannover','Deutschland',NULL,'2019-01-01 00:00:00',0,0,'2019-01-01 00:00:00','2019-10-01 00:00:00',1,1,1,1,1,'2018-11-27 19:12:23.965168','2018-11-27 19:12:23.965168'),(4,18,'test job 3','test job 3','30011','Köln','Deutschland',NULL,'2019-01-01 00:00:00',0,0,'2019-01-01 00:00:00','2019-10-01 00:00:00',1,1,1,1,1,'2018-11-27 19:13:05.685724','2018-11-27 19:13:05.685724'),(5,18,'test job 4','test job 1','30556','Hameln','Deutschland',NULL,'2018-11-30 19:01:35',0,0,'2018-11-30 19:01:35','2018-12-30 19:01:35',2,2,2,1,1,'2018-11-30 18:01:35.430581','2018-11-30 18:01:35.430581'),(6,18,'test job 5','test job 1','30011','Köln','Deutschland',NULL,'2018-11-30 19:01:35',0,0,'2018-11-30 19:01:35','2018-12-30 19:01:35',3,2,3,1,1,'2018-11-30 18:01:35.441592','2018-11-30 18:01:35.441592'),(7,18,'test job 6','test job 1','30123','Hannover','Deutschland',NULL,'2018-11-30 19:01:35',0,0,'2018-11-30 19:01:35','2018-12-30 19:01:35',4,2,4,1,1,'2018-11-30 18:01:35.441945','2018-11-30 18:01:35.441945'),(8,18,'test job 7','test job 1','30223','Hannover','Deutschland',NULL,'2018-11-30 19:01:35',0,0,'2018-11-30 19:01:35','2018-12-30 19:01:35',5,3,5,1,1,'2018-11-30 18:01:35.442265','2018-11-30 18:01:35.442265'),(9,18,'test job 8','test job 1','30011','Hameln','Deutschland',NULL,'2018-11-30 19:01:35',0,0,'2018-11-30 19:01:35','2018-12-30 19:01:35',6,3,2,1,1,'2018-11-30 18:01:35.442599','2018-11-30 18:01:35.442599'),(10,18,'test job 9','test job 1','30419','Hannover','Deutschland',NULL,'2018-11-30 19:01:35',0,0,'2018-11-30 19:01:35','2018-12-30 19:01:35',1,2,2,1,1,'2018-11-30 18:01:35.442876','2018-11-30 18:01:35.442876'),(11,18,'test job 10','test job 1','30419','Hannover','Deutschland',NULL,'2018-11-30 19:01:35',0,0,'2018-11-30 19:01:35','2018-12-30 19:01:35',2,2,2,1,1,'2018-11-30 18:01:35.443145','2018-11-30 18:01:35.443145'),(12,18,'test job 11','test job 1','30123','Köln','Deutschland',NULL,'2018-11-30 19:01:35',0,0,'2018-11-30 19:01:35','2018-12-30 19:01:35',3,1,2,1,1,'2018-11-30 18:01:35.443422','2018-11-30 18:01:35.443422'),(13,18,'test job 12','test job 1','30223','Hannover','Deutschland',NULL,'2018-11-30 19:01:35',0,0,'2018-11-30 19:01:35','2018-12-30 19:01:35',4,1,3,1,1,'2018-11-30 18:01:35.443621','2018-11-30 18:01:35.443621'),(14,18,'test job 13','test job 1','30011','Hannover','Deutschland',NULL,'2018-11-30 19:01:35',0,0,'2018-11-30 19:01:35','2018-12-30 19:01:35',5,3,4,1,1,'2018-11-30 18:01:35.443821','2018-11-30 18:01:35.443821'),(15,18,'test job 14','test job 1','30123','Hameln','Deutschland',NULL,'2018-11-30 19:01:35',0,0,'2018-11-30 19:01:35','2018-12-30 19:01:35',6,1,5,1,1,'2018-11-30 18:01:35.444022','2018-11-30 18:01:35.444022'),(16,18,'test job 15','test job 1','30419','Hannover','Deutschland',NULL,'2018-11-30 19:01:35',14,0,'2018-11-30 19:01:35','2018-12-30 19:01:35',1,2,3,1,1,'2018-11-30 18:01:35.444224','2018-11-30 18:01:35.444224'),(17,18,'test job 16','test job 1','30223','Hannover','Deutschland',NULL,'2018-11-30 19:01:35',0,0,'2018-11-30 19:01:35','2018-12-30 19:01:35',2,3,3,1,1,'2018-11-30 18:01:35.444425','2018-11-30 18:01:35.444425'),(18,18,'test job 17','test job 1','30123','Hameln','Deutschland',NULL,'2018-11-30 19:01:35',0,0,'2018-11-30 19:01:35','2018-12-30 19:01:35',3,1,4,1,1,'2018-11-30 18:01:35.444597','2018-11-30 18:01:35.444597'),(19,18,'test job 18','test job 1','30419','Hannover','Deutschland',NULL,'2018-11-30 19:01:35',0,0,'2018-11-30 19:01:35','2018-12-30 19:01:35',4,2,4,1,1,'2018-11-30 18:01:35.444769','2018-11-30 18:01:35.444769'),(20,18,'test job 19','test job 1','30419','Hannover','Deutschland',NULL,'2018-11-30 19:01:35',0,0,'2018-11-30 19:01:35','2018-12-30 19:01:35',5,3,5,1,1,'2018-11-30 18:01:35.444941','2018-11-30 18:01:35.444941'),(21,18,'test job 20','test job 1','30011','Hannover','Deutschland',NULL,'2018-11-30 19:01:35',0,0,'2018-11-30 19:01:35','2018-12-30 19:01:35',6,1,2,1,2,'2018-11-30 18:01:35.445112','2018-11-30 18:01:35.445112'),(22,18,'test job 21','test job 1','30419','Hameln','Deutschland',NULL,'2018-11-30 19:01:35',0,0,'2018-11-30 19:01:35','2018-12-30 19:01:35',1,2,2,1,1,'2018-11-30 18:01:35.445282','2018-11-30 18:01:35.445282'),(23,18,'test job 22','test job 1','30223','Hannover','Deutschland',NULL,'2018-11-30 19:01:35',0,0,'2018-11-30 19:01:35','2018-12-30 19:01:35',2,3,3,1,1,'2018-11-30 18:01:35.445452','2018-11-30 18:01:35.445452'),(24,18,'test job 23','test job 1','30223','Hannover','Deutschland',NULL,'2018-11-30 19:01:35',0,0,'2018-11-30 19:01:35','2018-12-30 19:01:35',3,1,3,1,1,'2018-11-30 18:01:35.445623','2018-11-30 18:01:35.445623'),(25,18,'test job 24','test job 1','30011','Hannover','Deutschland',NULL,'2018-11-30 19:01:35',0,0,'2018-11-30 19:01:35','2018-12-30 19:01:35',4,2,4,1,1,'2018-11-30 18:01:35.445794','2018-11-30 18:01:35.445794'),(26,18,'test job 25','test job 1','30419','Hannover','Deutschland',NULL,'2018-11-30 19:01:35',0,0,'2018-11-30 19:01:35','2018-12-30 19:01:35',5,3,5,1,1,'2018-11-30 18:01:35.445966','2018-11-30 18:01:35.445966'),(27,18,'test job 26','test job 1','30223','Hameln','Deutschland',NULL,'2018-11-30 19:01:35',0,0,'2018-11-30 19:01:35','2018-12-30 19:01:35',6,2,5,1,1,'2018-11-30 18:01:35.446137','2018-11-30 18:01:35.446137'),(28,18,'test job 27','test job 1','30223','Hannover','Deutschland',NULL,'2018-11-30 19:01:35',0,0,'2018-11-30 19:01:35','2018-12-30 19:01:35',2,2,2,1,1,'2018-11-30 18:01:35.446316','2018-11-30 18:01:35.446316'),(29,18,'test job 28','test job 1','30011','Hameln','Deutschland',NULL,'2018-11-30 19:01:35',0,0,'2018-11-30 19:01:35','2018-12-30 19:01:35',3,3,3,1,1,'2018-11-30 18:01:35.446538','2018-11-30 18:01:35.446538'),(37,18,'my new job','','23456','Hamburg','Deutschland','keine notiz!!!','2019-03-01 00:00:00',6,1,'2019-02-24 19:05:27','2020-03-13 00:00:00',2,3,4,85,1,'2019-02-24 18:05:27.069890','2019-02-24 18:05:27.069890');
/*!40000 ALTER TABLE `j2j_jobposition` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `j2j_jobpositionseen`
--

DROP TABLE IF EXISTS `j2j_jobpositionseen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `j2j_jobpositionseen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jobpos` int(11) NOT NULL,
  `ip` varchar(45) NOT NULL,
  `seenuserid` int(11) NOT NULL DEFAULT '0',
  `createdate` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_JOBPOSSEEN_JOBPOSITION_idx` (`jobpos`),
  CONSTRAINT `FK_JOBPOSSEEN_JOBPOSITION` FOREIGN KEY (`jobpos`) REFERENCES `j2j_jobposition` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `j2j_jobpositionseen`
--

LOCK TABLES `j2j_jobpositionseen` WRITE;
/*!40000 ALTER TABLE `j2j_jobpositionseen` DISABLE KEYS */;
/*!40000 ALTER TABLE `j2j_jobpositionseen` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `j2j_jobpositionskill`
--

DROP TABLE IF EXISTS `j2j_jobpositionskill`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `j2j_jobpositionskill` (
  `jobid` int(11) NOT NULL,
  `skill` varchar(100) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`jobid`,`skill`),
  CONSTRAINT `FK_JOBPOSTIONSKILL_JOBPOSITION` FOREIGN KEY (`jobid`) REFERENCES `j2j_jobposition` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `j2j_jobpositionskill`
--

LOCK TABLES `j2j_jobpositionskill` WRITE;
/*!40000 ALTER TABLE `j2j_jobpositionskill` DISABLE KEYS */;
INSERT INTO `j2j_jobpositionskill` VALUES (2,'C++','2018-11-29 00:25:45'),(2,'ENGINEERING','2018-11-29 00:25:45'),(2,'Java','2018-11-29 00:25:45'),(2,'JavaScript','2018-11-29 00:25:45'),(3,'C#','2018-11-29 00:25:45'),(3,'HTML','2018-11-29 00:25:45'),(3,'Java','2018-11-29 00:26:04'),(3,'JavaScript','2018-11-29 00:25:45'),(3,'Web Design','2018-11-29 00:25:45'),(4,'ENGINEERING','2018-11-29 00:25:45'),(4,'HTML','2018-11-29 00:25:45'),(4,'Java','2018-11-29 00:25:45'),(4,'Web Design','2018-11-29 00:25:45'),(5,'C#','2018-11-30 19:04:43'),(5,'JavaScript','2018-11-30 19:04:43'),(5,'Web Design','2018-11-30 19:04:43'),(6,'ECSCAD','2018-11-30 19:06:17'),(6,'KAUFMÄNNISCH','2018-11-30 19:06:17'),(6,'Staffing Strategie','2018-11-30 19:06:17'),(7,'C++','2018-11-30 19:11:26'),(7,'ENGINEERING','2018-11-30 19:11:26'),(7,'Softwareentwicklung','2018-11-30 19:11:26'),(8,'C#','2018-11-30 19:04:52'),(8,'JavaScript','2018-11-30 19:04:52'),(8,'Web Design','2018-11-30 19:04:52'),(9,'Java','2018-11-30 19:15:12'),(9,'JavaScript','2018-11-30 19:15:12'),(9,'Softwareentwicklung','2018-11-30 19:15:12'),(10,'C++','2018-11-30 19:11:51'),(10,'ENGINEERING','2018-11-30 19:11:51'),(10,'Softwareentwicklung','2018-11-30 19:11:51'),(11,'Hydraulikleitungen  Managment','2018-11-30 19:12:51'),(11,'Notfallmanagement','2018-11-30 19:12:50'),(11,'Wundmanagement','2018-11-30 19:12:51'),(12,'C#','2018-11-30 19:05:00'),(12,'JavaScript','2018-11-30 19:05:00'),(12,'Web Design','2018-11-30 19:05:00'),(13,'ECSCAD','2018-11-30 19:06:29'),(13,'KAUFMÄNNISCH','2018-11-30 19:06:28'),(13,'Staffing Strategie','2018-11-30 19:06:29'),(14,'C++','2018-11-30 19:11:58'),(14,'ENGINEERING','2018-11-30 19:11:58'),(14,'Softwareentwicklung','2018-11-30 19:11:58'),(15,'Java','2018-11-30 19:14:56'),(15,'JavaScript','2018-11-30 19:14:56'),(15,'Softwareentwicklung','2018-11-30 19:14:56'),(16,'Hydraulikleitungen  Managment','2018-11-30 19:13:09'),(16,'Notfallmanagement','2018-11-30 19:13:09'),(16,'Wundmanagement','2018-11-30 19:13:09'),(17,'Java','2018-11-30 19:14:41'),(17,'JavaScript','2018-11-30 19:14:41'),(17,'Softwareentwicklung','2018-11-30 19:14:41'),(18,'C#','2018-11-30 19:05:06'),(18,'JavaScript','2018-11-30 19:05:06'),(18,'Web Design','2018-11-30 19:05:06'),(19,'ECSCAD','2018-11-30 19:06:35'),(19,'KAUFMÄNNISCH','2018-11-30 19:06:35'),(19,'Staffing Strategie','2018-11-30 19:06:35'),(20,'Java','2018-11-30 19:14:09'),(20,'JavaScript','2018-11-30 19:14:09'),(20,'Softwareentwicklung','2018-11-30 19:14:09'),(21,'Java','2018-11-30 19:14:13'),(21,'JavaScript','2018-11-30 19:14:13'),(21,'Softwareentwicklung','2018-11-30 19:14:13'),(22,'C++','2018-11-30 19:12:04'),(22,'ENGINEERING','2018-11-30 19:12:04'),(22,'Softwareentwicklung','2018-11-30 19:12:04'),(23,'Hydraulikleitungen  Managment','2018-11-30 19:13:17'),(23,'Notfallmanagement','2018-11-30 19:13:17'),(23,'Wundmanagement','2018-11-30 19:13:17'),(24,'Java','2018-11-30 19:14:26'),(24,'JavaScript','2018-11-30 19:14:25'),(24,'Softwareentwicklung','2018-11-30 19:14:26'),(25,'C#','2018-11-30 19:05:15'),(25,'JavaScript','2018-11-30 19:05:15'),(25,'Web Design','2018-11-30 19:05:15'),(26,'ECSCAD','2018-11-30 19:06:44'),(26,'KAUFMÄNNISCH','2018-11-30 19:06:44'),(26,'Staffing Strategie','2018-11-30 19:06:44'),(27,'Hydraulikleitungen  Managment','2018-11-30 19:13:23'),(27,'Notfallmanagement','2018-11-30 19:13:23'),(27,'Wundmanagement','2018-11-30 19:13:23'),(28,'Hydraulikleitungen  Managment','2018-11-30 19:13:33'),(28,'Notfallmanagement','2018-11-30 19:13:33'),(28,'Wundmanagement','2018-11-30 19:13:33'),(29,'ECSCAD','2018-11-30 19:07:54'),(29,'KAUFMÄNNISCH','2018-11-30 19:07:54'),(29,'Staffing Strategie','2018-11-30 19:07:54'),(29,'Staffing-Managements','2018-11-30 19:07:54'),(37,'ECSCAD','2019-02-24 19:05:27'),(37,'JavaScript','2019-02-24 19:05:27');
/*!40000 ALTER TABLE `j2j_jobpositionskill` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `j2j_jobpositiontasks`
--

DROP TABLE IF EXISTS `j2j_jobpositiontasks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `j2j_jobpositiontasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jobid` int(11) NOT NULL,
  `task` varchar(4000) NOT NULL,
  `createdate` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  `updatedate` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  PRIMARY KEY (`id`),
  KEY `FK_JOBPOSITION_TASK_idx` (`jobid`),
  CONSTRAINT `FK_JOBPOSITION_TASK` FOREIGN KEY (`jobid`) REFERENCES `j2j_jobposition` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `j2j_jobpositiontasks`
--

LOCK TABLES `j2j_jobpositiontasks` WRITE;
/*!40000 ALTER TABLE `j2j_jobpositiontasks` DISABLE KEYS */;
INSERT INTO `j2j_jobpositiontasks` VALUES (3,37,'aufgabe 1','2019-02-24 18:05:27.196286','2019-02-24 18:05:27.196286'),(4,37,'aufgabe 2','2019-02-24 18:05:27.199781','2019-02-24 18:05:27.199781'),(5,37,'aufgabe 3','2019-02-24 18:05:27.205325','2019-02-24 18:05:27.205325');
/*!40000 ALTER TABLE `j2j_jobpositiontasks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `j2j_languages`
--

DROP TABLE IF EXISTS `j2j_languages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `j2j_languages` (
  `id` varchar(45) NOT NULL,
  `index` int(11) NOT NULL DEFAULT '0',
  `title` varchar(45) NOT NULL,
  `photourl` varchar(200) DEFAULT NULL,
  `baseurl` varchar(45) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1',
  `createdate` datetime NOT NULL,
  `updatedate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `j2j_languages`
--

LOCK TABLES `j2j_languages` WRITE;
/*!40000 ALTER TABLE `j2j_languages` DISABLE KEYS */;
INSERT INTO `j2j_languages` VALUES ('de',1,'Deutsch','/web/images/flag_de.png','/de',0,'2016-09-16 13:07:42','2016-09-16 13:07:42'),('en',2,'English','/web/images/flag_us.png','/en',0,'2016-09-16 13:07:42','2016-09-16 13:07:42'),('fr',3,'French','/web/images/flag_fr.png','/fr',0,'2016-11-04 16:32:21','2016-11-04 16:32:21'),('nl',4,'Dutch','/web/images/flag_nd.png','/nd',0,'2016-11-04 16:51:13','2016-11-04 16:51:13');
/*!40000 ALTER TABLE `j2j_languages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `j2j_nationality`
--

DROP TABLE IF EXISTS `j2j_nationality`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `j2j_nationality` (
  `title` varchar(50) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1',
  PRIMARY KEY (`title`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `j2j_nationality`
--

LOCK TABLES `j2j_nationality` WRITE;
/*!40000 ALTER TABLE `j2j_nationality` DISABLE KEYS */;
INSERT INTO `j2j_nationality` VALUES ('',1),('ägyptisch',1),('albanisch',1),('algerisch',1),('amerikanisch',1),('andorranisch',1),('angolanisch',1),('antiguanisch',1),('äquatorialguineisch',1),('argentinisch',1),('armenisch',1),('aserbaidschanisch',1),('äthiopisch',1),('australisch',1),('bahamaisch',1),('bahrainisch',1),('bangladeschisch',1),('barbadisch',1),('belgisch',1),('belizisch',1),('beninisch',1),('bhutanisch',1),('bolivianisch',1),('bosnisch',1),('botsuanisch',1),('brasilianisch',1),('britisch',1),('bruneiisch',1),('bulgarisch',1),('burkinisch',1),('burundisch',1),('chilenisch',1),('chinesisch',1),('costa-ricanisch',1),('dänisch',1),('deutsch',1),('dominicanisch',1),('dominikanisch',1),('dschibutisch',1),('ecuadorianisch',1),('englisch',1),('eritreisch',1),('estnisch',1),('fidschianisch',1),('finnisch',1),('französisch',1),('gabunisch',1),('gambisch',1),('georgisch',1),('ghanaisch',1),('grenadisch',1),('griechisch',1),('grönländisch',1),('guatemaltekisch',1),('guinea-bissauisch',1),('guineisch',1),('guyanisch',1),('haitianisch',1),('herzegowinisch',1),('honduranisch',1),('indisch',1),('indonesisch',1),('irakisch',1),('iranisch',1),('irisch',1),('isländisch',1),('israelisch',1),('italienisch',1),('ivorisch',1),('jamaikanisch',1),('japanisch',1),('jemenitisch',1),('jordanisch',1),('kambodschanisch',1),('kamerunisch',1),('kanadisch',1),('kapverdisch ',1),('kasachisch',1),('katarisch',1),('kenianisch',1),('kirgisisch',1),('kiribatisch',1),('kolumbianisch',1),('komorisch',1),('kongolesisch',1),('kosovarisch',1),('kroatisch',1),('kubanisch',1),('kuwaitisch',1),('laotisch',1),('lesothisch',1),('lettisch',1),('libanesisch',1),('liberianisch',1),('libysch',1),('liechtensteinisch',1),('litauisch',1),('lucianisch',1),('luxemburgisch',1),('madagassisch',1),('malawisch',1),('malaysisch',1),('maledivisch',1),('malisch',1),('maltesisch',1),('marokkanisch',1),('marshallisch',1),('mauretanisch',1),('mauritisch',1),('mazedonisch',1),('mexikanisch',1),('mikronesisch',1),('moldauisch',1),('monegassisch',1),('mongolisch',1),('montenegrinisch',1),('mosambikanisch',1),('myanmarisch',1),('namibisch',1),('nauruisch',1),('nepalesisch',1),('neuseeländisch',1),('nicaraguanisch',1),('niederländisch',1),('nigerianisch',1),('nigrisch',1),('nordkoreanisch',1),('norwegisch',1),('omanisch',1),('österreichisch',1),('pakistanisch',1),('palästinensisch',1),('palauisch',1),('panamaisch',1),('papua-neuguineisch',1),('paraguayisch',1),('peruanisch',1),('philippinisch',1),('polnisch',1),('portugiesisch',1),('puerto-ricanisch',1),('ruandisch',1),('rumänisch',1),('russisch',1),('salomonisch',1),('salvadorianisch',1),('sambisch',1),('samoanisch',1),('san-marinesisch',1),('são-toméisch',1),('saudi-arabisch',1),('schottisch',1),('schwedisch',1),('schweizerisch',1),('senegalesisch',1),('serbisch',1),('seychellisch',1),('sierra-leonisch',1),('simbabwisch',1),('singapurisch',1),('slowakisch',1),('slowenisch',1),('somalisch',1),('spanisch',1),('sri-lankisch',1),('südafrikanisch',1),('sudanesisch',1),('südkoreanisch',1),('surinamisch',1),('swasiländisch',1),('syrisch',1),('tadschikisch',1),('taiwanisch',1),('tansanisch',1),('thailändisch',1),('tibetisch',1),('timoresisch',1),('togoisch',1),('tongaisch',1),('tschadisch',1),('tschechisch',1),('tunesisch',1),('türkisch',1),('turkmenisch',1),('tuvaluisch',1),('ugandisch',1),('ukrainisch',1),('ungarisch',1),('uruguayisch',1),('usbekisch',1),('vanuatuisch',1),('vatikanisch',1),('venezolanisch',1),('vietnamesisch',1),('vincentisch',1),('walisisch',1),('weißrussisch ',1),('zentralafrikanisch',1),('zyprisch',1),('﻿afghanisch',1);
/*!40000 ALTER TABLE `j2j_nationality` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `j2j_navigation`
--

DROP TABLE IF EXISTS `j2j_navigation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `j2j_navigation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parentid` int(11) DEFAULT '0',
  `app` varchar(45) NOT NULL DEFAULT 'backend',
  `language` varchar(45) NOT NULL DEFAULT 'en',
  `title` varchar(45) NOT NULL,
  `url` varchar(45) NOT NULL DEFAULT '#',
  `onclick` varchar(200) DEFAULT NULL,
  `image` varchar(200) DEFAULT NULL,
  `position` smallint(6) NOT NULL DEFAULT '1',
  `createdate` datetime NOT NULL,
  `updatedate` datetime NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `FK_NAVIGATION_LANGUAGE_idx` (`language`),
  CONSTRAINT `FK_NAVIGATION_LANGUAGE` FOREIGN KEY (`language`) REFERENCES `j2j_languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `j2j_navigation`
--

LOCK TABLES `j2j_navigation` WRITE;
/*!40000 ALTER TABLE `j2j_navigation` DISABLE KEYS */;
INSERT INTO `j2j_navigation` VALUES (1,0,'backend','en','Home','site/index',NULL,'glyphicon-home',1,'2016-09-16 13:13:52','2016-09-16 13:13:52',1),(2,0,'backend','de','erste Seite','site/index',NULL,'glyphicon-home',1,'2016-09-16 13:13:52','2016-09-16 13:13:52',1),(3,0,'backend','en','Einstellungen','#',NULL,'glyphicon-wrench',30,'2016-09-16 13:16:20','2016-09-16 13:16:20',1),(4,0,'backend','de','Einstellungen','#',NULL,'glyphicon-wrench',30,'2016-09-16 13:16:20','2016-09-16 13:16:20',1),(5,3,'backend','en','Benutzer','users/index',NULL,'glyphicon-user',1,'2016-09-16 13:19:49','2016-09-16 13:19:49',1),(6,3,'backend','en','Benutzergruppen','usergroup/index',NULL,'glyphicon-tasks',2,'2016-09-16 13:19:49','2016-09-16 13:19:49',1),(7,3,'backend','en','Skills','skills/index',NULL,'glyphicon-align-left',3,'2016-09-16 13:19:49','2016-09-16 13:19:49',1),(8,4,'backend','de','Benutzer','users/index',NULL,'glyphicon-user',1,'2016-09-16 13:19:49','2016-09-16 13:19:49',1),(9,4,'backend','de','Benutzergruppen','usergroup/index',NULL,'glyphicon-tasks',2,'2016-09-16 13:19:49','2016-09-16 13:19:49',1),(10,4,'backend','de','Fähigkeiten','skills/index',NULL,'glyphicon-align-left',3,'2016-09-16 13:19:49','2016-09-16 13:19:49',1),(11,0,'backend','en','Utils','utils/index',NULL,'glyphicon-certificate',50,'2016-09-16 13:52:07','2016-09-16 13:52:07',1),(12,0,'backend','de','Utils','utils/index',NULL,'glyphicon-certificate',50,'2016-09-16 13:52:07','2016-09-16 13:52:07',1),(13,3,'backend','en','Language','languages/index',NULL,'glyphicon-font',4,'2016-09-18 13:05:02','2016-09-18 13:05:02',1),(14,4,'backend','de','Sprache','languages/index',NULL,'glyphicon-font',4,'2016-09-18 13:05:03','2016-09-18 13:05:03',1),(15,0,'backend','en','Unternehmen','company/index',NULL,'glyphicon-modal-window',5,'2016-09-22 10:28:33','2016-09-22 10:28:33',1),(16,0,'backend','de','Unternehmen','company/index',NULL,'glyphicon-modal-window',5,'2016-09-22 10:28:33','2016-09-22 10:28:33',1),(17,0,'backend','en','Stellenanzeige','jobpos/index',NULL,'glyphicon-bullhorn',7,'2016-09-22 10:28:33','2016-09-22 10:28:33',1),(18,0,'backend','de','Stellenanzeige','jobpos/index',NULL,'glyphicon-bullhorn',7,'2016-09-22 10:28:33','2016-09-22 10:28:33',1),(19,0,'backend','en','Bewerber','candidate/index',NULL,'glyphicon-blackboard',8,'2016-09-22 10:28:33','2016-09-22 10:28:33',1),(20,0,'backend','de','Bewerber','Candidate/index',NULL,'glyphicon-blackboard',8,'2016-09-22 10:28:33','2016-09-22 10:28:33',1),(21,0,'frontend','en','Home','site/home','gotopage(\'dvhome\');','glyphicon-home',1,'0000-00-00 00:00:00','0000-00-00 00:00:00',1),(22,0,'frontend','de','erste Seite','site/home',NULL,'glyphicon-home',1,'0000-00-00 00:00:00','0000-00-00 00:00:00',1),(23,0,'frontend','en','Bewerber','site/candidate',NULL,'glyphicon-home',2,'0000-00-00 00:00:00','0000-00-00 00:00:00',1),(24,0,'frontend','de','Bewerber','site/candidate',NULL,'glyphicon-home',2,'0000-00-00 00:00:00','0000-00-00 00:00:00',1),(25,0,'frontend','en','Unternehmen','site/company',NULL,'glyphicon-home',3,'0000-00-00 00:00:00','0000-00-00 00:00:00',1),(26,0,'frontend','de','Unternehmen','site/company',NULL,'glyphicon-home',3,'0000-00-00 00:00:00','0000-00-00 00:00:00',1),(27,0,'frontend','en','Contact','site/contact',NULL,'glyphicon-home',4,'0000-00-00 00:00:00','0000-00-00 00:00:00',1),(28,0,'frontend','de','Kontakt','site/contact',NULL,'glyphicon-home',4,'0000-00-00 00:00:00','0000-00-00 00:00:00',1),(29,0,'frontend','en','about','site/about',NULL,'glyphicon-home',4,'0000-00-00 00:00:00','0000-00-00 00:00:00',1),(30,0,'frontend','de','uber uns','site/about',NULL,'glyphicon-home',4,'0000-00-00 00:00:00','0000-00-00 00:00:00',1),(31,0,'frontright','en','Home','site/index',NULL,NULL,1,'2016-09-27 11:07:03','2016-09-27 11:07:03',1),(32,0,'frontright','de','erste Seite','site/index',NULL,NULL,1,'2016-09-27 11:07:03','2016-09-27 11:07:03',1),(33,0,'frontright','en','Job Search','site/jobsearch',NULL,NULL,2,'2016-09-27 11:07:03','2016-09-27 11:07:03',1),(34,0,'frontright','de','Job Suchen','site/jobsearch',NULL,NULL,2,'2016-09-27 11:07:03','2016-09-27 11:07:03',1),(35,0,'frontright','en','Filialen','site/branches',NULL,NULL,3,'2016-09-27 11:07:03','2016-09-27 11:07:03',1),(36,0,'frontright','de','Filialen','site/branches',NULL,NULL,3,'2016-09-27 11:07:03','2016-09-27 11:07:03',1),(37,0,'frontright','en','Contact','site/contact',NULL,NULL,4,'2016-09-27 11:07:03','2016-09-27 11:07:03',1),(38,0,'frontright','de','Kontakt','site/contact',NULL,NULL,4,'2016-09-27 11:07:03','2016-09-27 11:07:03',1),(39,0,'frontright','en','Initiative Application','site/initiativeapp',NULL,NULL,5,'2016-09-27 11:07:03','2016-09-27 11:07:03',1),(40,0,'frontright','de','Initiativbewerbung','site/initiativeapp',NULL,NULL,5,'2016-09-27 11:07:03','2016-09-27 11:07:03',1),(41,3,'backend','en','Email Ready Text','emailtext/index',NULL,'glyphicon-envelope',5,'0000-00-00 00:00:00','0000-00-00 00:00:00',1),(42,4,'backend','de','E-Mail bereit Text','emailtext/index',NULL,'glyphicon-envelope',5,'0000-00-00 00:00:00','0000-00-00 00:00:00',1),(43,3,'backend','en','Message User List','tgtmsguser/index',NULL,'glyphicon-align-justify',6,'2016-09-28 12:54:12','2016-09-28 12:54:12',1),(44,4,'backend','de','Nachricht Benutzerliste','tgtmsguser/index',NULL,'glyphicon-align-justify',6,'2016-09-28 12:54:12','2016-09-28 12:54:12',1),(45,0,'backend','de','Personalentscheider','pdt/index',NULL,'glyphicon-eye-open',6,'2017-07-12 12:54:12','2017-07-12 12:54:12',1),(46,0,'backend','en','Personalentscheider','pdt/index',NULL,'glyphicon-eye-open',6,'2017-07-12 12:54:12','2017-07-12 12:54:12',1),(47,0,'backend','de','hochgeladene Dateien','upfiles/index',NULL,'glyphicon-open-file',9,'2016-09-16 13:52:07','2016-09-16 13:52:07',1),(48,0,'backend','en','hochgeladene Dateien','upfiles/index',NULL,'glyphicon-open-file',9,'2016-09-16 13:52:07','2016-09-16 13:52:07',1),(49,0,'backend','de','Bewerbungen','apply/index?status=0',NULL,'glyphicon-ok-sign',10,'2016-09-16 13:52:07','2016-09-16 13:52:07',1),(50,0,'backend','en','Bewerbungen','apply/index?status=0',NULL,'glyphicon-ok-sign',10,'2016-09-16 13:52:07','2016-09-16 13:52:07',1),(51,0,'backend','de','Rückruf Antrag','callrequest/index?status=0',NULL,'glyphicon-earphone',11,'2016-09-16 13:52:07','2016-09-16 13:52:07',1),(52,0,'backend','en','Rückruf Antrag','callrequest/index?status=0',NULL,'glyphicon-earphone',11,'2016-09-16 13:52:07','2016-09-16 13:52:07',1),(53,0,'backend','de','Geschehen','events/index',NULL,'glyphicon-list-alt',12,'2016-09-16 13:52:07','2016-09-16 13:52:07',1),(54,0,'backend','en','Geschehen','events/index',NULL,'glyphicon-list-alt',12,'2016-09-16 13:52:07','2016-09-16 13:52:07',1);
/*!40000 ALTER TABLE `j2j_navigation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `j2j_personaldecisionmaker`
--

DROP TABLE IF EXISTS `j2j_personaldecisionmaker`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `j2j_personaldecisionmaker` (
  `userid` int(11) NOT NULL,
  `companyid` int(11) NOT NULL,
  `title` varchar(15) DEFAULT '',
  `title2` varchar(45) DEFAULT '',
  `email` varchar(100) NOT NULL,
  `cellphone` varchar(45) DEFAULT NULL,
  `tel` varchar(45) DEFAULT NULL,
  `reachability` varchar(45) DEFAULT NULL,
  `contacttime` varchar(45) DEFAULT NULL,
  `isdeputy` smallint(6) NOT NULL DEFAULT '1',
  `createdate` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  `updatedate` timestamp(6) NULL DEFAULT CURRENT_TIMESTAMP(6),
  PRIMARY KEY (`userid`),
  KEY `FK_PERSONALDECMAKER_USER_idx` (`userid`),
  CONSTRAINT `FK_PERSONALDECMAKER_USER` FOREIGN KEY (`userid`) REFERENCES `j2j_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `j2j_personaldecisionmaker`
--

LOCK TABLES `j2j_personaldecisionmaker` WRITE;
/*!40000 ALTER TABLE `j2j_personaldecisionmaker` DISABLE KEYS */;
INSERT INTO `j2j_personaldecisionmaker` VALUES (85,18,'Frau','','firma@f.de',NULL,'',NULL,NULL,0,'2018-10-31 23:00:00.000000','2018-11-01 14:25:42.689028');
/*!40000 ALTER TABLE `j2j_personaldecisionmaker` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `j2j_postcode`
--

DROP TABLE IF EXISTS `j2j_postcode`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `j2j_postcode` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(45) DEFAULT NULL,
  `city` varchar(45) DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14957 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `j2j_postcode`
--

LOCK TABLES `j2j_postcode` WRITE;
/*!40000 ALTER TABLE `j2j_postcode` DISABLE KEYS */;
/*!40000 ALTER TABLE `j2j_postcode` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `j2j_recommendation`
--

DROP TABLE IF EXISTS `j2j_recommendation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `j2j_recommendation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iscandidate` smallint(6) NOT NULL DEFAULT '1',
  `title` varchar(200) NOT NULL,
  `recommendation` text,
  `updated` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `j2j_recommendation`
--

LOCK TABLES `j2j_recommendation` WRITE;
/*!40000 ALTER TABLE `j2j_recommendation` DISABLE KEYS */;
INSERT INTO `j2j_recommendation` VALUES (1,1,'Maria B., Buchhalterin','Ich habe Job2Job als zuverlässigen Arbeitgeber kennengelernt. Unsere Zusammenarbeit ist geprägt von gegenseitigem Vertrauen und Respekt.','2019-01-26 20:32:36.129126'),(2,1,'Lea W., Gesundheits- und Krankenpflegerin','Die viel diskutierte „Zeitarbeit“ ermöglichte mir wertvolle Einblicke in die Arbeitsbereiche der Pflege. Mit Frau Mohr hatte ich zudem immer eine verlässliche Partnerin im Rücken, die in all meinen Entscheidungen hinter mit stand. ','2019-01-26 20:32:36.138045'),(3,1,'XXX, Gesundheits- und Krankenpflegerin für Intensivpflege und Anästhesie','Ich kam aus einer Festanstellung heraus als Krankenschwester zu Job2Job mit dem Wunsch mich beruflich weiterzuentwickeln. In der Folge konnte ich unkompliziert eine Weiterbildung zur Fachkrankenschwester für Intensivpflege und Anästhesie absolvieren. Dank meiner neuen Qualifikation und der Möglichkeit verschiedene Betriebe kennenzulernen, fühle ich mich heute deutlich sicherer und selbstbewusster bei der Ausübung meiner Arbeit.  ','2019-01-26 20:32:36.138475'),(4,1,'XXX, Beruf','Job2Job hat mich Vertrauen gelehrt. Nicht nur in einen zuverlässigen Arbeitsvermittler, sondern vor allem in mich selbst und meine Fähigkeiten. ','2019-01-26 20:32:36.138835'),(5,0,'XXX, Firma – Branche/Tätigkeitsschwerpunkt ','„Zügig, unkompliziert, partnerschaftlich – einen besseren Partner kann man sich nicht wünschen. Die zwei von Ihnen vermittelten Mitarbeiten leisten im Kommissionsbereich und im Retourenlager hervorragende Arbeit. Bei zukünftigen Personalengpässe werden wir uns garantiert wieder von Job2Job unterstützen lassen.“','2019-01-26 20:30:10.660570'),(6,0,'XXX, Firma – entwickelt und produziert Automobile und Nutzfahrzeuge ','„Job2Job hat uns ebenso qualifiziertes wie hochmotiviertes Personal vermittelt. Und das ohne lange Vorlaufzeit – ein wichtiges Erfolgskriterium in unserer Branche. Enger persönlicher Kontakt und eine unkomplizierte, flexible Betreuung runden Ihren Service ab. Absolute Empfehlung!“  ','2019-01-26 20:30:10.664498'),(7,0,'XXX, Firma – Branche','„Dank der Job2Job GmbH können wir seit Jahren jede Stelle kurzfristig mit sehr gutem Personal besetzen. Einige der Mitarbeiter, die wir übernommen haben, gehören mittlerweile zu unserem langjährigen Stammpersonal. Das ist wohl die beste Empfehlung.“  ','2019-01-26 20:30:10.665102'),(8,0,'XXX, Firma – Branche','„In Folge der guten Erfahrungen und der langjährigen Zusammenarbeit haben wir die Job2Job GmbH mit der Entwicklung eines Bewerbermanagement-Konzepts für unser gesamtes überregionales Vertriebssystem beauftragt. Dieses konnten wir 2018 einführen – mit durchschlagendem Erfolg!“','2019-01-26 20:30:10.665608'),(9,0,'XXX, Firma – Branche','„Auf eines können wir uns bei Job2Job seit vielen Jahren verlassen: die sofortige und zuverlässige Beschaffung von gut ausgebildeten Arbeitskräften. Die Folge: Wir konnten unseren eigenen Personalbereich verschlanken und damit kosteneffizienter aufstellen.“','2019-01-26 20:30:10.666211'),(10,1,'XXX, Beruf (vielleicht auch Mutter/Vater mit langer Abwesenheit vom Arbeitsmarkt?) ','Job2Job vermittelte mir innerhalb eines Monats meine erste Stelle – und das obwohl meine letzte Anstellung X Jahre zurück lag. Ein tolles Gefühl auf dem Arbeitsmarkt wieder gebraucht zu werden. ','2019-01-26 20:32:36.139151');
/*!40000 ALTER TABLE `j2j_recommendation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `j2j_skills`
--

DROP TABLE IF EXISTS `j2j_skills`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `j2j_skills` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parentid` int(11) NOT NULL DEFAULT '0',
  `title` varchar(80) NOT NULL,
  `status` smallint(6) DEFAULT '1',
  `createdate` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  `updatedate` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `j2j_skills`
--

LOCK TABLES `j2j_skills` WRITE;
/*!40000 ALTER TABLE `j2j_skills` DISABLE KEYS */;
INSERT INTO `j2j_skills` VALUES (1,0,'ENGINEERING',1,'2016-09-17 10:40:34.000000','2016-09-17 10:40:34.000000'),(2,1,'C++',1,'2016-09-17 10:45:26.000000','2016-09-17 10:45:26.000000'),(3,1,'Java',1,'2016-09-17 10:55:44.000000','2016-09-17 10:55:44.000000'),(4,1,'JavaScript',1,'2016-09-17 20:27:19.000000','2016-09-17 20:27:19.000000'),(8,1,'HTML',1,'2016-09-17 20:40:43.000000','2016-09-17 20:40:43.000000'),(9,1,'C#',1,'2017-03-19 20:38:16.000000','2017-03-19 20:38:16.000000'),(10,1,'Web Design',1,'2017-03-28 19:31:44.000000','2017-03-28 19:31:44.000000'),(11,0,'MED / PHARMA',1,'2017-04-07 22:00:00.000000','2017-04-07 22:00:00.000000'),(12,0,'KAUFMÄNNISCH',1,'2017-04-07 22:00:00.000000','2017-04-07 22:00:00.000000'),(30,1,'PEG Versorgung',1,'2017-06-22 12:59:40.000000','2017-06-22 12:59:40.000000'),(31,1,'Wundmanagement',1,'2017-06-22 12:59:40.000000','2017-06-22 12:59:40.000000'),(32,1,'Notfallmanagement',1,'2017-06-22 12:59:40.000000','2017-06-22 12:59:40.000000'),(33,1,'Hydraulikleitungen  Managment',1,'2017-06-22 13:02:26.000000','2017-06-22 13:02:26.000000'),(34,1,'ECSCAD',1,'2017-06-22 13:03:58.000000','2017-06-22 13:03:58.000000'),(35,1,'Staffing-Managements',1,'2017-06-22 13:06:48.000000','2017-06-22 13:06:48.000000'),(36,1,'Staffing Strategie',1,'2017-06-22 13:06:48.000000','2017-06-22 13:06:48.000000'),(37,1,'Notfallmaßnahmen',1,'2017-06-22 13:10:38.000000','2017-06-22 13:10:38.000000'),(47,0,'SONSTIGES',1,'2017-07-18 10:21:16.000000','2017-07-18 10:21:16.000000'),(48,1,'Softwareentwicklung',1,'2018-11-30 18:10:41.162509','2018-11-30 18:10:41.162509');
/*!40000 ALTER TABLE `j2j_skills` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `j2j_targetmessageusers`
--

DROP TABLE IF EXISTS `j2j_targetmessageusers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `j2j_targetmessageusers` (
  `userid` int(11) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1',
  PRIMARY KEY (`userid`),
  CONSTRAINT `FK_TARGETMESSAGEUSERS_USERS` FOREIGN KEY (`userid`) REFERENCES `j2j_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `j2j_targetmessageusers`
--

LOCK TABLES `j2j_targetmessageusers` WRITE;
/*!40000 ALTER TABLE `j2j_targetmessageusers` DISABLE KEYS */;
INSERT INTO `j2j_targetmessageusers` VALUES (1,1),(3,1);
/*!40000 ALTER TABLE `j2j_targetmessageusers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `j2j_uploadedfiles`
--

DROP TABLE IF EXISTS `j2j_uploadedfiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `j2j_uploadedfiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file` varchar(200) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '0',
  `upload_date` datetime NOT NULL,
  `userid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `j2j_uploadedfiles`
--

LOCK TABLES `j2j_uploadedfiles` WRITE;
/*!40000 ALTER TABLE `j2j_uploadedfiles` DISABLE KEYS */;
INSERT INTO `j2j_uploadedfiles` VALUES (3,'/job2job/frontend/web/candidate_doc/9/Kündigung.pdf',0,'2017-07-27 12:45:08',9),(4,'/job2job/frontend/web/candidate_doc/9/ES-U-3xxx-x.pdf',0,'2017-12-15 11:57:42',9),(5,'/job2job/frontend/web/candidate_doc/9/IPT1-FP.pdf',0,'2017-12-15 11:58:41',9);
/*!40000 ALTER TABLE `j2j_uploadedfiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `j2j_usergroup`
--

DROP TABLE IF EXISTS `j2j_usergroup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `j2j_usergroup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1',
  `createdate` datetime NOT NULL,
  `updatedate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `j2j_usergroup`
--

LOCK TABLES `j2j_usergroup` WRITE;
/*!40000 ALTER TABLE `j2j_usergroup` DISABLE KEYS */;
INSERT INTO `j2j_usergroup` VALUES (1,'Administrators',1,'2016-09-16 12:49:46','2016-09-20 12:57:38'),(2,'Frontend',1,'2016-09-18 12:46:45','2017-04-03 11:34:31');
/*!40000 ALTER TABLE `j2j_usergroup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `j2j_usergroupnavgation`
--

DROP TABLE IF EXISTS `j2j_usergroupnavgation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `j2j_usergroupnavgation` (
  `groupid` int(11) NOT NULL,
  `navigationid` int(11) NOT NULL,
  `readright` smallint(6) NOT NULL DEFAULT '0',
  `editright` smallint(6) NOT NULL DEFAULT '0',
  `deleteright` smallint(6) NOT NULL DEFAULT '0',
  `printright` smallint(6) NOT NULL DEFAULT '0',
  `status` smallint(6) NOT NULL DEFAULT '1',
  `createdate` datetime NOT NULL,
  PRIMARY KEY (`groupid`,`navigationid`),
  KEY `FK_NVIGATIONGROUP_NAVIGATION_idx` (`navigationid`),
  CONSTRAINT `FK_NVIGATIONGROUP_GROUP` FOREIGN KEY (`groupid`) REFERENCES `j2j_usergroup` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_NVIGATIONGROUP_NAVIGATION` FOREIGN KEY (`navigationid`) REFERENCES `j2j_navigation` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `j2j_usergroupnavgation`
--

LOCK TABLES `j2j_usergroupnavgation` WRITE;
/*!40000 ALTER TABLE `j2j_usergroupnavgation` DISABLE KEYS */;
INSERT INTO `j2j_usergroupnavgation` VALUES (1,1,1,0,0,0,1,'2016-09-20 14:57:38'),(1,2,1,0,0,0,1,'2016-09-20 14:57:38'),(1,3,1,0,0,0,1,'2016-09-20 14:57:38'),(1,4,1,0,0,0,1,'2016-09-20 14:57:38'),(1,5,1,0,0,0,1,'2016-09-20 14:57:38'),(1,6,1,0,0,0,1,'2016-09-20 14:57:38'),(1,7,1,0,0,0,1,'2016-09-20 14:57:38'),(1,8,1,0,0,0,1,'2016-09-20 14:57:38'),(1,9,1,0,0,0,1,'2016-09-20 14:57:38'),(1,10,1,1,0,0,1,'2016-09-20 14:57:38'),(1,11,1,0,0,0,1,'2016-09-20 14:57:39'),(1,12,1,0,0,0,1,'2016-09-20 14:57:39'),(1,13,1,0,0,0,1,'2016-09-20 14:57:39'),(1,14,1,0,0,0,1,'2016-09-20 14:57:39');
/*!40000 ALTER TABLE `j2j_usergroupnavgation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `j2j_userpermission`
--

DROP TABLE IF EXISTS `j2j_userpermission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `j2j_userpermission` (
  `id` int(11) NOT NULL,
  `title` varchar(45) DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `j2j_userpermission`
--

LOCK TABLES `j2j_userpermission` WRITE;
/*!40000 ALTER TABLE `j2j_userpermission` DISABLE KEYS */;
INSERT INTO `j2j_userpermission` VALUES (1,'Administrator',1),(2,'User',1);
/*!40000 ALTER TABLE `j2j_userpermission` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `j2j_users`
--

DROP TABLE IF EXISTS `j2j_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `j2j_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uname` varchar(45) NOT NULL,
  `password_hash` varchar(255) DEFAULT NULL,
  `password_reset_token` varchar(255) DEFAULT NULL,
  `auth_key` varchar(32) DEFAULT NULL,
  `fname` varchar(45) NOT NULL,
  `lname` varchar(45) NOT NULL,
  `bdate` datetime DEFAULT NULL,
  `usertype` smallint(6) NOT NULL DEFAULT '1',
  `group` int(11) NOT NULL DEFAULT '-1',
  `permission` int(11) NOT NULL DEFAULT '2',
  `receive_backend_email` smallint(6) NOT NULL DEFAULT '1',
  `status` smallint(6) NOT NULL DEFAULT '1',
  `createdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedate` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_USER_GROUP_idx` (`group`),
  KEY `FK_USER_PERMISSION_idx` (`permission`),
  CONSTRAINT `FK_USER_GROUP` FOREIGN KEY (`group`) REFERENCES `j2j_usergroup` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_USER_PERMISSION` FOREIGN KEY (`permission`) REFERENCES `j2j_userpermission` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `j2j_users`
--

LOCK TABLES `j2j_users` WRITE;
/*!40000 ALTER TABLE `j2j_users` DISABLE KEYS */;
INSERT INTO `j2j_users` VALUES (1,'hamid','$2y$13$0RxDra3j21WT65PMPZcGb.72cb8IDCNuSmaOhJZqNwmOzaG06AxRS',NULL,'-','Hamidreza','Seifi','0000-00-00 00:00:00',1,1,1,1,1,'2016-09-11 20:23:44','2016-09-11 20:23:44'),(3,'user','User88',NULL,'-','user','user','0000-00-00 00:00:00',1,2,2,1,1,'2016-09-28 13:37:22','2016-09-28 11:37:22'),(9,'hamidrezaseifi@gmail.com','$2y$13$WPd863BIGCmT150Ica.fwOccES7v/BJZO.xPI8Ci4hyPPcEpoOMKm',NULL,'','Hamidrez','Seifi','1977-09-11 00:00:00',3,2,2,1,1,'2017-04-11 00:00:00','2019-03-02 00:00:00'),(84,'bewerber@b.de','$2y$13$bhKbf35YzYQmvVceJ4Lcy.KfJVe3FlicLUfyylagRzGHFdFbnB0l2',NULL,NULL,'bewerber','bewerber','2018-11-01 00:00:00',3,2,2,1,1,'2018-11-01 14:23:35','2018-11-01 15:24:02'),(85,'firma@f.de','$2y$13$OpHewtaipJy3RomoGHjF3.HF3E5Vjp.nYCYyQhgsWouSoRaqQeoZO',NULL,NULL,'firma','firma','2018-11-01 00:00:00',2,2,2,1,1,'2018-11-01 14:25:42','2018-12-26 13:17:16'),(86,'admin','$2y$13$v08Dlvij8hdgOyOVkoVZYOTwJ4YqFpQMCC8zTQBVZPz2B5L7IhB8.',NULL,NULL,'admin','admin',NULL,1,1,1,1,1,'2018-12-06 21:12:06','2018-12-06 21:12:06');
/*!40000 ALTER TABLE `j2j_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `j2j_vacancy`
--

DROP TABLE IF EXISTS `j2j_vacancy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `j2j_vacancy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(55) NOT NULL,
  `link` varchar(45) NOT NULL DEFAULT '-',
  `status` smallint(6) NOT NULL DEFAULT '1',
  `updated` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `j2j_vacancy`
--

LOCK TABLES `j2j_vacancy` WRITE;
/*!40000 ALTER TABLE `j2j_vacancy` DISABLE KEYS */;
INSERT INTO `j2j_vacancy` VALUES (1,'Arbeitnehmerüberlassung','temporarywork',1,'2018-12-26 11:58:10.222504'),(2,'Personalfestanstellung','-',0,'2018-12-26 11:58:25.683911'),(3,'Personalrekrutierung','personalrecruitment',1,'2018-12-26 11:58:10.223988'),(4,'Personalübernahme','personaladoption',1,'2018-12-26 11:58:10.223473');
/*!40000 ALTER TABLE `j2j_vacancy` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `j2j_workexperience`
--

DROP TABLE IF EXISTS `j2j_workexperience`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `j2j_workexperience` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `applicationid` int(11) NOT NULL,
  `company` varchar(100) NOT NULL,
  `fromdate` varchar(20) NOT NULL,
  `todate` varchar(20) NOT NULL,
  `country` varchar(45) NOT NULL,
  `city` varchar(45) NOT NULL,
  `position` varchar(45) NOT NULL,
  `comments` text,
  `createdate` datetime NOT NULL,
  `updatedate` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_APPLICATION_WORKEXPERIENCE_idx` (`applicationid`),
  CONSTRAINT `FK_APPLICATION_WORKEXPERIENCE` FOREIGN KEY (`applicationid`) REFERENCES `j2j_application` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `j2j_workexperience`
--

LOCK TABLES `j2j_workexperience` WRITE;
/*!40000 ALTER TABLE `j2j_workexperience` DISABLE KEYS */;
/*!40000 ALTER TABLE `j2j_workexperience` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `j2j_workpermission`
--

DROP TABLE IF EXISTS `j2j_workpermission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `j2j_workpermission` (
  `id` smallint(6) NOT NULL,
  `title` varchar(55) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `j2j_workpermission`
--

LOCK TABLES `j2j_workpermission` WRITE;
/*!40000 ALTER TABLE `j2j_workpermission` DISABLE KEYS */;
/*!40000 ALTER TABLE `j2j_workpermission` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `j2j_worktimemodel`
--

DROP TABLE IF EXISTS `j2j_worktimemodel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `j2j_worktimemodel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `j2j_worktimemodel`
--

LOCK TABLES `j2j_worktimemodel` WRITE;
/*!40000 ALTER TABLE `j2j_worktimemodel` DISABLE KEYS */;
INSERT INTO `j2j_worktimemodel` VALUES (1,'Teilzeit',1),(2,'Schichtarbeit',1),(3,'Minijob',1),(4,'Vollzeit',1),(5,'Freiberuflich',0);
/*!40000 ALTER TABLE `j2j_worktimemodel` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-03-02 14:39:06
