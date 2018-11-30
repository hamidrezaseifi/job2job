-- MySQL dump 10.13  Distrib 5.7.9, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: job2job
-- ------------------------------------------------------
-- Server version	5.7.12-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `j2j_application` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `comments` text,
  `cover` text,
  `createdate` datetime DEFAULT CURRENT_TIMESTAMP,
  `updatedate` datetime DEFAULT CURRENT_TIMESTAMP,
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `j2j_applicationattachment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `applicationid` int(11) NOT NULL,
  `fileurl` varchar(200) NOT NULL,
  `createdate` datetime DEFAULT CURRENT_TIMESTAMP,
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `j2j_applicationskill` (
  `applicationid` int(11) NOT NULL,
  `skillid` int(11) NOT NULL,
  PRIMARY KEY (`applicationid`,`skillid`),
  KEY `FK_SKILL_APPLICATIONSKILL_idx` (`skillid`),
  CONSTRAINT `FK_APPLICATION_APLICATIONSKILL` FOREIGN KEY (`applicationid`) REFERENCES `j2j_application` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_SKILL_APPLICATIONSKILL` FOREIGN KEY (`skillid`) REFERENCES `j2j_skills` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
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
-- Table structure for table `j2j_company`
--

DROP TABLE IF EXISTS `j2j_company`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `j2j_company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `title` varchar(80) NOT NULL,
  `email` varchar(80) NOT NULL,
  `adress` text,
  `steueid` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `logo` varchar(200) DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `FK_COMPANY_USER_idx` (`userid`),
  CONSTRAINT `FK_COMPANY_USER` FOREIGN KEY (`userid`) REFERENCES `j2j_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `j2j_company`
--

LOCK TABLES `j2j_company` WRITE;
/*!40000 ALTER TABLE `j2j_company` DISABLE KEYS */;
/*!40000 ALTER TABLE `j2j_company` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `j2j_education`
--

DROP TABLE IF EXISTS `j2j_education`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `j2j_education` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `applicationid` int(11) NOT NULL,
  `degree` int(11) NOT NULL,
  `field` varchar(45) NOT NULL,
  `univercity` varchar(45) NOT NULL,
  `country` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_APPLICATION_EDUCATION_idx` (`applicationid`),
  CONSTRAINT `FK_APPLICATION_EDUCATION` FOREIGN KEY (`applicationid`) REFERENCES `j2j_application` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
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
-- Table structure for table `j2j_jobposition`
--

DROP TABLE IF EXISTS `j2j_jobposition`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `j2j_jobposition` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `companyid` int(11) NOT NULL,
  `title` varchar(500) NOT NULL,
  `subtitle` varchar(500) NOT NULL,
  `postcode` varchar(20) DEFAULT NULL,
  `city` varchar(80) DEFAULT NULL,
  `country` varchar(80) DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `FK_COMPANY_JOBPOSITION_idx` (`companyid`),
  CONSTRAINT `FK_COMPANY_JOBPOSITION` FOREIGN KEY (`companyid`) REFERENCES `j2j_company` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `j2j_jobposition`
--

LOCK TABLES `j2j_jobposition` WRITE;
/*!40000 ALTER TABLE `j2j_jobposition` DISABLE KEYS */;
/*!40000 ALTER TABLE `j2j_jobposition` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `j2j_jobpositionskill`
--

DROP TABLE IF EXISTS `j2j_jobpositionskill`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `j2j_jobpositionskill` (
  `jobid` int(11) NOT NULL,
  `skillid` int(11) NOT NULL,
  PRIMARY KEY (`jobid`,`skillid`),
  KEY `FK_JOBPOSTIONSKILL_SKILL_idx` (`skillid`),
  CONSTRAINT `FK_JOBPOSTIONSKILL_JOBPOSITION` FOREIGN KEY (`jobid`) REFERENCES `j2j_jobposition` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_JOBPOSTIONSKILL_SKILL` FOREIGN KEY (`skillid`) REFERENCES `j2j_skills` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `j2j_jobpositionskill`
--

LOCK TABLES `j2j_jobpositionskill` WRITE;
/*!40000 ALTER TABLE `j2j_jobpositionskill` DISABLE KEYS */;
/*!40000 ALTER TABLE `j2j_jobpositionskill` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `j2j_navigation`
--

DROP TABLE IF EXISTS `j2j_navigation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `j2j_navigation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parentid` int(11) DEFAULT NULL,
  `title` varchar(45) NOT NULL,
  `url` varchar(45) NOT NULL DEFAULT '#',
  `image` varchar(200) DEFAULT NULL,
  `app` varchar(20) NOT NULL DEFAULT 'front',
  `status` smallint(6) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `j2j_navigation`
--

LOCK TABLES `j2j_navigation` WRITE;
/*!40000 ALTER TABLE `j2j_navigation` DISABLE KEYS */;
/*!40000 ALTER TABLE `j2j_navigation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `j2j_skills`
--

DROP TABLE IF EXISTS `j2j_skills`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `j2j_skills` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parentid` int(11) NOT NULL DEFAULT '0',
  `title` varchar(80) NOT NULL,
  `status` smallint(6) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `j2j_skills`
--

LOCK TABLES `j2j_skills` WRITE;
/*!40000 ALTER TABLE `j2j_skills` DISABLE KEYS */;
/*!40000 ALTER TABLE `j2j_skills` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `j2j_usergroup`
--

DROP TABLE IF EXISTS `j2j_usergroup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `j2j_usergroup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `j2j_usergroup`
--

LOCK TABLES `j2j_usergroup` WRITE;
/*!40000 ALTER TABLE `j2j_usergroup` DISABLE KEYS */;
INSERT INTO `j2j_usergroup` VALUES (1,'Administrators',1);
/*!40000 ALTER TABLE `j2j_usergroup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `j2j_usergroupnavgation`
--

DROP TABLE IF EXISTS `j2j_usergroupnavgation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `j2j_usergroupnavgation` (
  `groupid` int(11) NOT NULL,
  `navigationid` int(11) NOT NULL,
  `readright` smallint(6) NOT NULL DEFAULT '0',
  `editright` smallint(6) NOT NULL DEFAULT '0',
  `deleteright` smallint(6) NOT NULL DEFAULT '0',
  `printright` smallint(6) NOT NULL DEFAULT '0',
  `status` smallint(6) NOT NULL DEFAULT '1',
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
/*!40000 ALTER TABLE `j2j_usergroupnavgation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `j2j_users`
--

DROP TABLE IF EXISTS `j2j_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `j2j_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uname` varchar(45) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `password_reset_token` varchar(255) DEFAULT NULL,
  `auth_key` varchar(32) NOT NULL,
  `fname` varchar(45) NOT NULL,
  `lname` varchar(45) NOT NULL,
  `iscompany` smallint(6) NOT NULL DEFAULT '1',
  `isbackend` smallint(6) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `group` int(11) NOT NULL DEFAULT '-1',
  `permission` int(11) NOT NULL DEFAULT '1',
  `status` smallint(6) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `FK_USER_GROUP_idx` (`group`),
  CONSTRAINT `FK_USER_GROUP` FOREIGN KEY (`group`) REFERENCES `j2j_usergroup` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `j2j_users`
--

LOCK TABLES `j2j_users` WRITE;
/*!40000 ALTER TABLE `j2j_users` DISABLE KEYS */;
INSERT INTO `j2j_users` VALUES (1,'hamid','$2y$13$0RxDra3j21WT65PMPZcGb.72cb8IDCNuSmaOhJZqNwmOzaG06AxRS',NULL,'----','Hamidreza','Seifi',1,1,'2016-09-11 20:23:44','2016-09-11 20:23:44',1,1,1);
/*!40000 ALTER TABLE `j2j_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `j2j_workexperience`
--

DROP TABLE IF EXISTS `j2j_workexperience`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
  `createdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
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
/*!40101 SET character_set_client = utf8 */;
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
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-09-11 23:02:31
