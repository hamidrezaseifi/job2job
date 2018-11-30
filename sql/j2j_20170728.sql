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
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = utf8 */;
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
-- Table structure for table `j2j_backmessage`
--

DROP TABLE IF EXISTS `j2j_backmessage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
-- Table structure for table `j2j_candidate`
--

DROP TABLE IF EXISTS `j2j_candidate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `j2j_candidate` (
  `userid` int(11) NOT NULL,
  `title` varchar(15) DEFAULT '',
  `title2` varchar(45) DEFAULT '',
  `nationality` varchar(45) NOT NULL DEFAULT '-',
  `photo` varchar(200) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `pcode` varchar(45) DEFAULT NULL,
  `city` varchar(45) DEFAULT NULL,
  `country` varchar(45) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `cellphone` varchar(45) DEFAULT NULL,
  `tel` varchar(45) DEFAULT NULL,
  `reachability` varchar(45) DEFAULT NULL,
  `contacttime` varchar(45) DEFAULT NULL,
  `employment` smallint(6) DEFAULT '0',
  `availability` varchar(45) NOT NULL DEFAULT '',
  `jobtype` int(11) DEFAULT NULL,
  `availablefrom` datetime DEFAULT NULL,
  `desiredjobpcode` varchar(45) DEFAULT NULL,
  `desiredjobcity` varchar(45) DEFAULT NULL,
  `desiredjobcountry` varchar(45) DEFAULT NULL,
  `desiredjobregion` int(11) DEFAULT NULL,
  `desiredjobtimetype` int(11) DEFAULT NULL,
  `coverletter` text,
  `createdate` datetime NOT NULL,
  `updatedate` datetime DEFAULT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `j2j_candidate`
--

LOCK TABLES `j2j_candidate` WRITE;
/*!40000 ALTER TABLE `j2j_candidate` DISABLE KEYS */;
INSERT INTO `j2j_candidate` VALUES (9,'Herr','','iranisch',NULL,'hamidrezaseifi@gmail.com','30419','Hannover','Deutschland','Rigaer St. 29G','0049-162-2810148','0049-162-2810148','Telefon, E-Mail, ','08:00 bis  18:00',1,'Verfügber',3,'2018-07-20 17:00:00','','','',10,4,'mein anschzturt\r\nrtuzjtzi\r\nzuitzutilotzirtzu','2017-04-10 00:00:00','2017-07-27 00:00:00'),(41,'Herr','','deutsch',NULL,'qqq@ww.ds','30333','Hannover','Deutschland','dsfgsdfhb 55','1122-334-556677','999-777-886678','E-Mail, ','',1,'Aktuell nicht verfügber',0,NULL,'','','Deutschland',5,4,'sdrzdruthr','2017-07-14 21:09:13','2017-07-14 21:09:13');
/*!40000 ALTER TABLE `j2j_candidate` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `j2j_candidatefavorite`
--

DROP TABLE IF EXISTS `j2j_candidatefavorite`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
INSERT INTO `j2j_candidatefavorite` VALUES (9,25,'2017-07-26 16:25:31'),(9,28,'2017-07-13 22:25:57'),(9,29,'2017-07-13 22:25:35');
/*!40000 ALTER TABLE `j2j_candidatefavorite` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `j2j_candidatejobapply`
--

DROP TABLE IF EXISTS `j2j_candidatejobapply`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
INSERT INTO `j2j_candidatejobapply` VALUES (9,12,0,'2017-07-27 13:18:08'),(9,20,0,'2017-07-27 13:17:56'),(9,23,0,'2017-07-27 13:17:42'),(9,28,1,'2017-07-13 22:25:59'),(9,29,0,'2017-07-13 22:16:51');
/*!40000 ALTER TABLE `j2j_candidatejobapply` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `j2j_candidateskill`
--

DROP TABLE IF EXISTS `j2j_candidateskill`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `j2j_city` (
  `name` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1',
  PRIMARY KEY (`name`),
  KEY `FK_CITY_COUNTRY_idx` (`country`),
  CONSTRAINT `FK_CITY_COUNTRY` FOREIGN KEY (`country`) REFERENCES `j2j_country` (`title`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `j2j_city`
--

LOCK TABLES `j2j_city` WRITE;
/*!40000 ALTER TABLE `j2j_city` DISABLE KEYS */;
INSERT INTO `j2j_city` VALUES ('Berlin','Deutschland',1),('Düsseldorf','Deutschland',1),('Hamelin','Deutschland',1),('Hannover','Deutschland',1),('Hildesheim','Deutschland',1),('Köln','Deutschland',1);
/*!40000 ALTER TABLE `j2j_city` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `j2j_company`
--

DROP TABLE IF EXISTS `j2j_company`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `j2j_company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `companyname` varchar(80) NOT NULL,
  `companytype` int(11) DEFAULT NULL,
  `founddate` datetime DEFAULT NULL,
  `adress` text,
  `taxid` varchar(50) DEFAULT NULL,
  `homepage` varchar(200) DEFAULT '',
  `logo` varchar(200) DEFAULT NULL,
  `employeecountindex` smallint(6) DEFAULT '0',
  `status` smallint(6) NOT NULL DEFAULT '1',
  `createdate` datetime NOT NULL,
  `updatedate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `j2j_company`
--

LOCK TABLES `j2j_company` WRITE;
/*!40000 ALTER TABLE `j2j_company` DISABLE KEYS */;
INSERT INTO `j2j_company` VALUES (2,'firm name new',4,'2020-03-20 00:00:00',NULL,'99887766','hhh0000666666666',NULL,1,1,'2017-05-17 00:00:00','2017-07-12 22:53:46'),(3,'comp 2',2,'2015-01-01 00:00:00',NULL,'555555','fdthrtd',NULL,0,1,'2017-07-13 13:09:59','2017-07-13 13:09:59'),(5,'comp 3',2,'2015-01-01 00:00:00',NULL,'55555','',NULL,0,1,'2017-07-16 11:09:57','2017-07-27 12:44:29');
/*!40000 ALTER TABLE `j2j_company` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `j2j_companytype`
--

DROP TABLE IF EXISTS `j2j_companytype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `j2j_connectedcompany` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `companyid` int(11) NOT NULL,
  `name` varchar(55) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `FK_CONNECTED_COMPANY_idx` (`companyid`),
  CONSTRAINT `FK_CONNECTED_COMPANY` FOREIGN KEY (`companyid`) REFERENCES `j2j_company` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `j2j_connectedcompany`
--

LOCK TABLES `j2j_connectedcompany` WRITE;
/*!40000 ALTER TABLE `j2j_connectedcompany` DISABLE KEYS */;
INSERT INTO `j2j_connectedcompany` VALUES (5,2,'company 1',1),(6,2,'firm 2',1),(7,2,'my cc3',1),(67,5,'verb 1',1),(68,5,'verb 2',1),(69,5,'verb 3',1);
/*!40000 ALTER TABLE `j2j_connectedcompany` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `j2j_contants`
--

DROP TABLE IF EXISTS `j2j_contants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = utf8 */;
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
INSERT INTO `j2j_country` VALUES (1,'Ägypten',1),(2,'Albanien',1),(3,'Algerien',1),(4,'Andorra',1),(5,'Angola',1),(6,'Antigua und Barbuda',1),(7,'Äquatorialguinea',1),(8,'Argentinien',1),(9,'Armenien',1),(10,'Aserbaidschan',1),(11,'Äthiopien',1),(12,'Australien',1),(13,'Bahamas',1),(14,'Bahrain',1),(15,'Bangladesch',1),(16,'Barbados',1),(17,'Belgien',1),(18,'Belize',1),(19,'Benin',1),(20,'Bhutan',1),(21,'Bolivien',1),(22,'Bosnien und Herzegowina',1),(23,'Botsuana',1),(24,'Brasilien',1),(25,'Brunei',1),(26,'Bulgarien',1),(27,'Burkina Faso',1),(28,'Burundi',1),(29,'Chile',1),(30,'China',1),(31,'Costa Rica',1),(32,'Dänemark',1),(33,'Demokratische Republik Kongo',1),(34,'Deutschland',1),(35,'Dominica',1),(36,'Dominikanische Republik',1),(37,'Dschibuti',1),(38,'Ecuador',1),(39,'El Salvador',1),(40,'Elfenbeinküste',1),(41,'England',1),(42,'Eritrea',1),(43,'Estland',1),(44,'Färöer-Inseln',1),(45,'Fidschi',1),(46,'Finnland',1),(47,'Frankreich',1),(48,'Gabun',1),(49,'Gambia',1),(50,'Georgien',1),(51,'Ghana',1),(52,'Grenada',1),(53,'Griechenland',1),(54,'Grönland',1),(55,'Großbritannien',1),(56,'Guatemala',1),(57,'Guinea',1),(58,'Guinea-Bissau',1),(59,'Guyana',1),(60,'Haiti',1),(61,'Honduras',1),(62,'Hongkong',1),(63,'Indien',1),(64,'Indonesien',1),(65,'Irak ',1),(66,'Iran',1),(67,'Irland',1),(68,'Island',1),(69,'Israel',1),(70,'Italien',1),(71,'Jamaika',1),(72,'Japan',1),(73,'Jemen',1),(74,'Jordanien',1),(75,'Kambodscha',1),(76,'Kamerun',1),(77,'Kanada',1),(78,'Kap Verde',1),(79,'Kasachstan',1),(80,'Katar',1),(81,'Kenia',1),(82,'Kirgisistan',1),(83,'Kiribati',1),(84,'Kolumbien',1),(85,'Komoren',1),(86,'Kongo',1),(87,'Kosovo ',1),(88,'Kroatien',1),(89,'Kuba',1),(90,'Kuwait',1),(91,'Laos',1),(92,'Lesotho',1),(93,'Lettland',1),(94,'Libanon ',1),(95,'Liberia',1),(96,'Libyen',1),(97,'Liechtenstein',1),(98,'Litauen',1),(99,'Luxemburg',1),(100,'Macau',1),(101,'Madagaskar',1),(102,'Malawi',1),(103,'Malaysia',1),(104,'Malediven',1),(105,'Mali',1),(106,'Malta',1),(107,'Marokko',1),(108,'Marshallinseln',1),(109,'Mauretanien',1),(110,'Mauritius',1),(111,'Mazedonien',1),(112,'Mexiko',1),(113,'Mikronesien',1),(114,'Moldau',1),(115,'Monaco',1),(116,'Mongolei',1),(117,'Montenegro',1),(118,'Mosambik',1),(119,'Myanmar',1),(120,'Namibia',1),(121,'Nauru',1),(122,'Nepal',1),(123,'Neuseeland',1),(124,'Nicaragua',1),(125,'Niederlande',1),(126,'Nigeria',1),(127,'Niger ',1),(128,'Nordkorea',1),(129,'Norwegen',1),(130,'Oman',1),(131,'Österreich',1),(132,'Pakistan',1),(133,'Palästina',1),(134,'Palau',1),(135,'Panama',1),(136,'Papua-Neuguinea',1),(137,'Paraguay',1),(138,'Peru',1),(139,'Philippinen',1),(140,'Polen',1),(141,'Portugal',1),(142,'Puerto Rico',1),(143,'Republik Kongo',1),(144,'Ruanda',1),(145,'Rumänien',1),(146,'Russland',1),(147,'Salomonen',1),(148,'Sambia',1),(149,'Samoa',1),(150,'San Marino',1),(151,'São Tomé und Príncipe',1),(152,'Saudi-Arabien',1),(153,'Schottland',1),(154,'Schweden',1),(155,'Schweiz',1),(156,'Senegal ',1),(157,'Serbien',1),(158,'Seychellen',1),(159,'Sierra Leone',1),(160,'Simbabwe',1),(161,'Singapur',1),(162,'Slowakei',1),(163,'Slowenien',1),(164,'Somalia',1),(165,'Spanien',1),(166,'Sri Lanka',1),(167,'St. Kitts und Nevis',1),(168,'St. Lucia',1),(169,'St. Vincent und die Grenadinen',1),(170,'Südafrika',1),(171,'Sudan ',1),(172,'Südkorea',1),(173,'Suriname',1),(174,'Swasiland',1),(175,'Syrien',1),(176,'Tadschikistan',1),(177,'Taiwan',1),(178,'Tansania',1),(179,'Thailand',1),(180,'Tibet',1),(181,'Timor-Leste',1),(182,'Togo',1),(183,'Tonga',1),(184,'Trinidad und Tobago',1),(185,'Tschad ',1),(186,'Tschechische Republik ',1),(187,'Tunesien',1),(188,'Türkei',1),(189,'Turkmenistan',1),(190,'Tuvalu',1),(191,'Uganda',1),(192,'Ukraine',1),(193,'Ungarn',1),(194,'Uruguay',1),(195,'USA',1),(196,'Usbekistan',1),(197,'Vanuatu',1),(198,'Vatikanstadt',1),(199,'Venezuela',1),(200,'Vereinigte Arabische Emirate',1),(201,'Vietnam',1),(202,'Wales',1),(203,'Weißrussland',1),(204,'Zentralafrikanische Republik',1),(205,'Zypern',1),(206,'﻿Afghanistan',1);
/*!40000 ALTER TABLE `j2j_country` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `j2j_distance`
--

DROP TABLE IF EXISTS `j2j_distance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = utf8 */;
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
-- Table structure for table `j2j_jobposition`
--

DROP TABLE IF EXISTS `j2j_jobposition`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `j2j_jobposition` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `companyid` int(11) NOT NULL,
  `title` varchar(80) NOT NULL,
  `subtitle` varchar(500) NOT NULL,
  `postcode` varchar(20) NOT NULL,
  `city` varchar(80) NOT NULL,
  `country` varchar(80) NOT NULL,
  `comments` text,
  `jobstartdate` datetime NOT NULL,
  `duration` smallint(6) NOT NULL DEFAULT '0',
  `extends` smallint(6) NOT NULL DEFAULT '0',
  `showdate` datetime NOT NULL,
  `expiredate` datetime NOT NULL,
  `jobtype` int(11) NOT NULL DEFAULT '0',
  `vacancy` int(11) NOT NULL DEFAULT '0',
  `worktype` int(11) NOT NULL DEFAULT '0',
  `userid` int(11) NOT NULL DEFAULT '0',
  `status` smallint(6) NOT NULL DEFAULT '1',
  `createdate` datetime NOT NULL,
  `updatedate` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_COMPANY_JOBPOSITION_idx` (`companyid`),
  KEY `FK_JOBPOSITION_VACANCY_idx` (`vacancy`),
  KEY `FK_JOBPOSITION_USER_idx` (`userid`),
  KEY `FK_JOBPOSITION_JOBTYPE_idx` (`jobtype`),
  KEY `FK_JOBPOSITION_WORKTYPE_idx` (`worktype`),
  CONSTRAINT `FK_COMPANY_JOBPOSITION` FOREIGN KEY (`companyid`) REFERENCES `j2j_company` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_JOBPOSITION_JOBTYPE` FOREIGN KEY (`jobtype`) REFERENCES `j2j_jobtype` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_JOBPOSITION_USER` FOREIGN KEY (`userid`) REFERENCES `j2j_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_JOBPOSITION_VACANCY` FOREIGN KEY (`vacancy`) REFERENCES `j2j_vacancy` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `j2j_jobposition`
--

LOCK TABLES `j2j_jobposition` WRITE;
/*!40000 ALTER TABLE `j2j_jobposition` DISABLE KEYS */;
INSERT INTO `j2j_jobposition` VALUES (3,2,'bbb1','','','vvvv','Benin','wwww','2021-06-01 00:00:00',11,0,'2017-06-19 00:00:00','2017-06-29 00:00:00',3,2,0,30,1,'2017-06-19 08:56:44','2017-06-19 08:56:44'),(12,2,'Altenpfleger für modernes Rehazentrum (m/w)','','30349','Hannover','Deutschland','Kommentar 12222','2022-02-01 00:00:00',22,1,'2017-06-28 00:00:00','2017-08-23 00:00:00',1,1,4,30,1,'2017-06-20 08:46:00','2017-06-28 18:31:41'),(13,2,'Job pos 3','','','Paris','Frankreich','Beschreibung 3','2017-01-01 00:00:00',12,0,'2017-06-19 00:00:00','2017-06-30 00:00:00',1,2,0,30,2,'2017-06-19 14:28:11','2017-06-19 14:28:11'),(14,2,'Job 4 für test in list','','','Berlin','Deutschland','Beschreibung 4','2018-03-01 00:00:00',22,0,'2017-06-19 00:00:00','2017-06-28 00:00:00',2,2,0,30,2,'2017-06-19 14:28:53','2017-06-19 14:28:53'),(15,2,'Job 5555555555','','','Köln','Deutschland','Beschreibung Beschreibung Beschreibung Beschreibung\r\nBeschreibung Beschreibung\r\nBeschreibung','2018-04-01 00:00:00',17,1,'2017-06-19 00:00:00','2017-11-25 00:00:00',3,3,0,30,2,'2017-06-19 14:31:30','2017-06-19 14:31:30'),(16,2,'job 666666','','30888','Berlin','Deutschland','BeschreibungBeschreibungBeschreibungBeschreibung','2017-01-01 00:00:00',14,1,'2017-07-01 00:00:00','2017-06-30 00:00:00',1,2,2,30,2,'2017-06-19 14:32:04','2017-07-01 14:05:24'),(17,2,'Altenpfleger für modernes Rehazentrum (m/w)','','66675','Berlin','Deutschland','Beschreibung Beschreibung Beschreibung','2018-03-01 00:00:00',32,0,'2017-06-28 00:00:00','2017-07-30 00:00:00',1,1,4,30,1,'2017-06-19 14:32:29','2017-06-28 18:31:46'),(18,2,'Objektleiter technisches Gebäudemanagement (m/w)','','123456','Hamelin','Deutschland','rtzteruz','2018-01-01 00:00:00',23,0,'2017-06-28 00:00:00','2017-07-23 00:00:00',3,2,1,30,1,'2017-06-22 08:34:56','2017-06-28 18:31:37'),(19,2,'Web / Frontend Designe','','44900','Hamelin','Deutschland','fghdf','2017-01-01 00:00:00',23,0,'2017-06-28 00:00:00','2017-07-30 00:00:00',3,1,4,30,1,'2017-06-22 08:36:42','2017-06-28 18:31:33'),(20,2,'C++ Entwickler','','30455','Hannover','Deutschland','Ihre Aufgaben\r\nDies Beinhaltet Im Detail Folgende Aufgaben\r\nAls Software Entwickler (w/m) unterstützen Sie das Team bei der stetigen Weiterentwicklung von Röntgenscannern und sorgen dabei nicht nur für die selbstständige Umsetzung der Anforderungen und Aufgaben, sondern weisen sich auch durch Ihr hohes Maß an Teamfähigkeit aus.\r\nSie übernehmen die Entwicklung und Einführung bildverarbeitender Systeme\r\nSie sorgen für die Betreuung und Entwicklung der Produkte\r\nSie verantworten die Planung und stetige Weiterentwicklung der internen Mess-Software\r\nSie übernehmen die Konfiguration und Verifikation der Produkte am Standort sowie beim Kunden selbst\r\nIhr Profil\r\nSie haben Ihr Studium der Fachrichtung Informatik oder einer vergleichbaren Qualifikation erfolgreich abgeschlossen\r\nSie verfügen über fundierte Kenntnisse in C/C++ sowie erste Erfahrungen im Software Entwurf mit UML, Datenbanken und der -verarbeitung\r\nSie können idealerweise Kenntnisse in der Bildverarbeitung, Visual Studio, QT-Bibliothek, PostgreSQL, SPS, OPC und Profibus vorweisen\r\nSie runden Ihr Profil mit guten Deutsch- und Englischkenntnissen in Wort und Schrift ab\r\nUnsere Leistungen\r\nVon Beginn an bieten wir Ihnen ein attraktives Gehalt, einen unbefristeten Vertag sowie 30 Tage Urlaub.\r\nWir bieten Ihnen von Anfang an eine professionelle Rundum-Betreuung. Sowohl während der Bewerbungsphase als auch später als Mitarbeiter stehen wir Ihnen als verlässlicher Ansprechpartner zur Seite.\r\nWir legen großen Wert darauf, Ihnen Ihrer Qualifikation und persönlichen Ziele entsprechende Aus- und Weiterbildungen anzubieten.\r\nMit dem Atlastitan Gesundheitsförderprogramm unterstützen wir Sie aktiv bei der Prävention und Gesundheitsförderung.\r\nIhre Zukunft ist uns genauso wichtig wie Ihnen. Wir bieten Ihnen daher eine betriebliche Altersvorsorge, damit Sie sich um Ihre Zukunft keine Sorgen machen müssen.\r\nDarüber hinaus bieten wir regelmäßige Freizeitangebote und Mitarbeitertreffen zur aktiven Teambildung an.','2018-02-01 00:00:00',24,0,'2017-06-28 00:00:00','2017-09-30 00:00:00',3,1,4,30,1,'2017-06-22 14:55:57','2017-06-28 18:31:28'),(21,2,'Java Entwickler (w/m)','','33456','Hamelin','Deutschland','TUI InfoTec GmbH\r\nJava Entwickler (w/m)\r\nHannover\r\nKennziffer: TUIK-0055-5\r\nArbeitsbereich\r\nAgile Softwareentwicklung für touristische Fachbereiche innerhalb des Scrum Teams\r\nBranchen:Gastronomie, Hotellerie, Tourismus\r\nAnstellungsart\r\nVollzeit\r\nDie vollständige Anzeige finden Sie beim Klick auf den Onlinebewerbungs-Button oder unter folgendem Link:\r\nhttp://jobs.jobware.net/Job/005515557?jw_chl_seg=LinkedIn\r\nDetails\r\nEIN ARBEITSTAG –\r\n3.036 LÄCHELN GEZAUBERT.\r\nUnsere Visitenkarte: TUI ist Europas führender Touristikkonzern, der immer wieder Impulse für die gesamte Branche setzt. Unsere Marken umfassen das gesamte Spektrum an Dienstleistungen rund um Urlaub und Reise. Dazu gehören eine eigene Airline, Reisebüros, Hotels & Resorts, Kreuzfahrtschiffe und vieles mehr. Wir bieten Urlaub aus einer Hand, um für unsere Kunden durchgängig hohe Qualität zu schaffen! Helfen Sie uns dabei, unsere führende Marktposition durch technologischen Vorsprung weiter auszubauen.\r\nUnsere Mission ist einfach: Menschen auf der ganzen Welt Urlaub zu ermöglichen\r\nund ihnen dabei ein Lächeln aufs Gesicht zu zaubern. Ab wann zaubern Sie mit?\r\nUnsere Visitenkarte – Damit Bewerben Wir Uns Bei Ihnen\r\nTUI ist Europas führender Touristikkonzern, der immer wieder Impulse für die gesamte Branche setzt. Unsere Marken umfassen das gesamte Spektrum an Dienstleistungen rund um Urlaub und Reise. Dazu gehören eine eigene Airline, Reisebüros, Hotels & Resorts, Kreuzfahrtschiffe und vieles mehr. Wir bieten Urlaub aus einer Hand, um für unsere Kunden durchgängig hohe Qualität zu schaffen!\r\nFür Die TUI InfoTec GmbH In Hannover Suchen Wir Zum Nächstmöglichen Eintrittstermin Eine/n\r\nHelfen Sie uns dabei, unsere führende Marktposition durch technologischen Vorsprung weiter auszubauen - und entwickeln Sie neue Ideen, um Lächeln zu zaubern.\r\nJava Entwickler (w/m)\r\nIhre Aufgaben\r\nIhre Aufgaben – damit zaubern Sie Kunden ein Lächeln aufs Gesicht:\r\nAgile Softwareentwicklung für unsere touristischen Fachbereiche innerhalb unser Scrum Teams\r\nAnalyse, Bewertung und Strukturierung der fachlichen Anforderungen und effektive Auswahl von Technologien für nachhaltige technische Konzepte und Lösungen\r\nSicherstellung der Konsistenz und Lauffähigkeit der durchgeführten Softwareänderungen in den Test- und Produktionsumgebungen\r\nAbstimmung und Mitgestaltung der Architektur, Datenorganisation und Performanceparameter\r\nIhre Qualifikationen\r\nIhre Qualifikationen – damit verzaubern Sie uns:\r\nAbgeschlossenes Studium der Informatik, Medieninformatik, Wirtschaftsinformatik oder Berufsausbildung zum/r Fachinformatiker/in Anwendungsentwicklung oder eine ähnliche Qualifikation\r\nSehr gute Kenntnisse in Java 8 und relevanten Frameworks/Konzepten wie Spring, AOP, JPA2 und/oder Webservices; Erfahrung beim Design von Microservices von Vorteil\r\nBerufserfahrung in der Java Softwareentwicklung mit Git, Eclipse, Maven, Jenkins und Application Servern (insbesondere Tomcat) sowie Elasticsearch und/oder Hazelcast wünschenswert\r\nLeidenschaft und Spaß an DevOps Konzepten und der Softwareentwicklung in einem selbstorganisierten, agilen Scrum Team\r\nBegeisterungsfähige Persönlichkeit mit ausgeprägtem Teamgeist\r\nEigenverantwortliche, sorgfältige und strukturierte Arbeitsweise\r\nGute Deutsch- und Englischkenntnisse in Wort und Schrift\r\nWir ermuntern Menschen mit Behinderung sich zu bewerben.\r\nIhre Bewerbung: In der Vielfalt liegt das Lächeln der World of TUI. Darum sind wir offen für Menschen verschiedener Herkünfte, Erfahrungen und Überzeugungen. Ist das Ihre Welt? Dann freuen wir uns auf Ihre Bewerbung. Bitte bewerben Sie sich über den \'Online bewerben\'-Button.\r\nOnline bewerben\r\nOnline bewerben\r\nInfos zu Entwicklungsmöglichkeiten, Arbeitszeitmodellen\r\nund Ihrer Bewerbung: www.tui-karriere.de','2017-10-01 00:00:00',36,0,'2017-06-28 00:00:00','2017-09-16 00:00:00',3,2,4,30,1,'2017-06-22 14:57:28','2017-06-28 18:31:24'),(22,2,'Krankenschwester/Krankenpfleger','','35634','Hannover','Deutschland','Das Unternehmen Next Step Personal GmbH ist ein mittelständischer Personaldienstleister mit Hauptsitz in Helmstedt und weiteren Standorten in Hannover und Berlin.\r\nNext Step bietet seinen Kunden maßgeschneiderte Lösungen im Bereich der Personaldienstleistungen für den Pflege und Gesundheitsbereich.\r\nAls Mittler zwischen den Bedürfnissen unserer Kunden und unserer Mitarbeiter verstehen wir beide Seiten als unsere Partner.\r\nWir suchen für unsere Kunden im Großraum Hannover ausgebildete Krankenschwestern (m/w) für außerklinische Intensivpflege\r\nBeatmungspflege und Überwachung der Beatmung\r\nErhebung von Vitalwerten und Beatmungsparametern\r\nPflege des Tracheostoma / Trachealkanülenwechsel\r\nendotracheales Absaugen\r\nPortversorgung\r\nPEG Versorgung\r\nWundmanagement\r\nSchmerzmanagement\r\nAnleitung von Angehörigen in der Pflege\r\nNotfallmanagement\r\nUNSER ANGEBOT\r\neine interessante und abwechslungsreiche Tätigkeit\r\nÜbertarifliche Vergütung 16,- €/Std. zzgl Fahrtkosten\r\nZahlung von Urlaubs- und Weihnachtsgeld\r\nlangfristige Einsatzmöglichkeiten\r\npersönliche Betreuung durch unser freundliches Team\r\nPrämien die Sie sofort nutzen können\r\nFreuen Sie sich auf einen unbefristeten Arbeitsvertrag, eine Übernahmeoption\r\ndurch unseren Kunden, sowie ein nettes Arbeitsumfeld. Haben wir Ihr Interesse geweckt? Dann gehen Sie den nächsten Schritt und bewerben sie sich noch heute, gerne per E-Mail.\r\nWenn Sie sich angesprochen fühlen bewerben Sie sich doch einfach bei uns!!!\r\nWir freuen uns auf Sie','2017-09-01 00:00:00',12,1,'2017-06-28 00:00:00','2017-09-09 00:00:00',1,3,1,30,1,'2017-06-22 14:59:40','2017-06-28 18:31:19'),(23,2,'HYDRAULIK-MECHANIKER (M/W)','','30179','Hannover','Deutschland','Hier Werden Sie Arbeiten\r\nDie Produktmarke unseres Kunden steht international für moderne und wertbeständige Lösungen in der Extrusionstechnik. Das Leistungsspektrum reicht von einzelnen Extrudern mit entsprechenden Werkzeugen über Up- und Downstream-Komponenten bis hin zu automatisierten Anlagenlösungen. Verbunden mit einem individuellen Serviceangebot zeichnet sich unser Kunde als verbindlicher Systempartner insbesondere für die Großchemie, Automobil-, Bau-, Verpackungs- und Pharmaindustrie aus.\r\nFür unseren Kunden suchen wir ab sofort einen Hydraulik-Mechaniker in Hannover.\r\nDies Sind Ihre Aufgaben\r\nSie sind verantwortlich für das Verlegen der Hydraulikleitungen im Bereich des Sondermaschinenbaues.\r\nSie passen die Hydraulikleitungen an die Konturen der Anlagen an und stellen die technische Funktion sicher.\r\nDes weiteren unterstützen Sie im Sondermaschinenbau\r\nSie achten auf die Qualität und verwenden hierfür übliche Messmittel.\r\nAnschließend dokumentieren Sie Ihre Arbeit.\r\nDas Bringen Sie Mit\r\nNach Ihrer abgeschlossenen Ausbildung in einem Metallberuf konnten Sie Praxiserfahrungen im Verlegen von Hydraulikleitungen sammeln.\r\nSie sind Qualitätsbewusst.\r\nSie arbeiten gerne eigenverantwortlich.\r\nGern arbeiten Sie in einem wechselnden 2-Schicht-Betrieb (Früh- und Spätschicht).\r\nWir Garantieren Ihnen\r\nexpertum bietet Ihnen ein attraktives Gehaltspaket, das Ihre Berufserfahrung und Fähigkeiten anerkennt.\r\nSie erhalten einen unbefristeten, tariflich geregelten Arbeitsvertrag inkl. Zuschläge, Arbeitszeitkonto sowie Urlaubs- und Weihnachtsgeld.\r\nEinen professionellen Arbeits- und Gesundheitsschutz stellen wir durch regelmäßige ärztliche Vorsorgeuntersuchungen und hochwertige Schutzkleidung sicher.\r\nWir investieren in die Aus- und Weiterbildung unserer Mitarbeiter und ermöglichen bei Bedarf individuelle Fortbildungsmaßnahmen.\r\nWir sorgen für Einsätze in der Nähe Ihres Wohnorts, die auf Ihre Kenntnisse und Interessen zugeschnitten sind.\r\nSCHICKEN SIE UNS UNKOMPLIZIERT IN WENIGEN SCHRITTEN IHRE BEWERBUNG!\r\nBewerben Sie sich auf die angegebene E-Mail-Adresse oder über den Button „Jetzt Bewerben!“. Hier laden Sie einfach Ihren Lebenslauf hoch und den Rest übernimmt unser System. Keine komplizierten Formulare mehr ausfüllen! Ein persönlicher Ansprechpartner steht Ihnen bei Ihren Fragen und während des kompletten Bewerbungsprozesses unter der angegebenen Telefonnummer jederzeit gerne zur Verfügung.\r\nStarten Sie mit expertum in eine aussichtsreiche Zukunft!','2017-07-01 00:00:00',36,1,'2017-06-28 00:00:00','2017-08-12 00:00:00',3,1,4,30,1,'2017-06-22 15:02:26','2017-06-28 18:31:15'),(24,2,'Elektriker/Elektrotechniker Mechtroniker m/w','','30212','Hannover','Deutschland','Für einen weltweit agierenden Sondermaschinenbauer in Ditzingen suchen wir zum sofortigen Einsatz einen Elektriker / Elektrotechniker / Schaltschrankbauer m/w.\r\nIhre Aufgabe\r\nSie übernehmen die elektrische Konstruktion unserer Anlagen, d.h. neue Anlagen und Überarbeitung bestehender Anlagen, sowie Aufbereitung der Dokumentation für die Weiterverarbeitung der Daten in ERP, Bedienungsanleitung etc.\r\nIhr Profil\r\nausgebildete Elektro-Fachkraft (auch Techniker, Mechatroniker, etc.)\r\nSie haben Kenntnisse der einschlägigen Normen im Bereich der elektrischen Verdrahtung, Prüfung (VDE) und Maschinensicherheit\r\nsind erfahren und versiert in der Schaltschrankmontage und Automatisierungstechnik\r\nkennen sich aus i ECSCAD für die Schalt- und Klemmenpläne\r\nSie sind versiert in MS Office\r\nFühlen Sie sich angesprochen? Dann freuen wir uns über Ihre Kontaktaufnahme und Bewerbung unter Angabe Ihres frühestmöglichen Eintrittsdatums. Ihre Unterlagen sind uns ONLINE, per Post oder E-Mail bewerbung@bandtel-bps.com willkommen.\r\nFalls Sie im Zusammenhang mit diesem Inserat Fragen haben rufen Sie uns bitte unter der Telefonnummer 0711-99 31 48 - 0 an. Wir freuen uns auf Ihre Kontaktaufnahme!\r\nBandtel Business & Personal Solutions GmbH\r\nPersonalvermittlung für Fach- und Führungskräfte\r\nBandtel Business & Personal Solutions GmbH ist inhabergeführter Personaldienstleister in den Geschäftsfeldern Personalvermittlung, Personalberatung, Headhunting als auch Interim-Management, Outsourcing und Outplacement\r\nAls bundesweit aktiver Personaldienstleister für namhafte Konzerne und den gehobenen Mittelstand besetzen wir bei unseren Kunden attraktive, zukunftsweisende und entwicklungsfähige Arbeitsplätze durch unsere Bewerber.','2017-06-01 00:00:00',12,1,'2017-06-28 00:00:00','2017-08-12 00:00:00',3,2,4,30,1,'2017-06-22 15:03:58','2017-06-28 18:31:11'),(25,2,'Young Professionals (m/w) im Bereich Staffing Management - Administration','','34223','Hamelin','Deutschland','## Wir suchen Young Professionals, die\r\ndurch ihren Einsatz in anspruchsvollen Tätigkeiten ihre Fähigkeiten als Staffing Manager ausbauen möchten.\r\ngerne in kleinen schlagkräftigen und kollegialen Teams arbeiten möchten, freundschaftliche Hilfestellung suchen und bieten und sich gemeinsam an erreichten Erfolgen freuen können.\r\neine faire Balance zwischen Beruf und Privatleben wünschen.\r\ngerne Spaß haben und die Beschäftigung mit anderen Menschen mindestens genauso wichtig nehmen, wie die Auseinandersetzung mit Business Prozessen.\r\n## Ihr Hauptaufgabenbereich\r\nIn dieser vielseitigen Position berichten direkt an den Leiter Business Development und unterstützen das Recruiting Team bei der Umsetzung und Weiterentwicklung der Staffing Strategie und des Staffing-Managements der Talentschmiede.\r\nSie erstellen in Zusammenarbeit mit unseren Kunden die Kandidatensuchprofile und sind verantwortlich für die inhaltliche Gestaltung der Stellenanzeigen.\r\nSie verantworten die Schaltung der Stellenanzeigen in Medien und sozialen Netzwerken (Karriereportale, Stellenbörsen, Twitter, Facebook, LinkedIn, u.a.).\r\nSie sind die Kommunikationsschnittstelle zwischen unserem internen Recruiting, der Geschäftsführung und unseren Kunden und verantworten das übergreifende Reporting zum Status des Staffings unserer Kunden- und Projektaufträge.\r\nSie verantworten die Analyse und Optimierung von internen Business Prozessen sowie die Entwicklung und Umsetzung neuer Geschäftsideen.\r\n## Ihre Qualifikation\r\nSie haben einen der nachfolgenden Studiengänge absolviert: Wirtschaftswissenschaften, Business Administration, Management oder Marketing und haben eine Affinität zum IT-Finanzsektor.\r\nSie zeichnen sich durch ein analytisches Denkvermögen und eine hohe Zahlenaffinität aus.\r\nSie sind souverän in Ihrer Kommunikation gegenüber Kunden und dem Management.\r\nSie verbinden ein ganzheitliches Denkvermögen mit einer unternehmerischen Denkweise.\r\nSie verfügen über ein hohes Maß an Eigeninitiative, gedankliche Flexibilität und Teamfähigkeit.\r\nSie sind sicher im Umgang mit den MS-Office Anwendungen.\r\nSie haben eine schnelle Auffassungsgabe und können sich für neue Aufgaben begeistern.\r\nSie verstehen es, gegenüber unseren Kunden kompetent und serviceorientiert aufzutreten.','2017-07-01 00:00:00',36,1,'2017-06-28 00:00:00','2017-08-12 00:00:00',2,1,2,30,1,'2017-06-22 15:06:48','2017-06-28 18:31:06'),(26,2,'Fachärztin – Allgemeinmedizin (m/w) in Teilzeit','','30822','Hannover','Deutschland','Ihre Aufgaben im Wesentlichen:\r\n    medizinische und rehabilitative Betreuung und Behandlung von erkrankten Patienten\r\nSie verfügen über:\r\n    ein abgeschlossenes Medizinstudium\r\n    hohe Belastbarkeit\r\n    Freude, Einfühlungsvermögen und Engagement im Umgang mit hilfebedürftigen Menschen in\r\nihrer aktuellen Lebenssituation\r\n    eine hohe Einsatzbereitschaft und Begeisterung an der Allgemeinmedizin\r\nWas Sie erwartet:\r\n    Abwechslungsreiche und interessante Tätigkeiten\r\n    Ein festes Arbeitsverhältnis mit leistungsgerechter Vergütung sowie attraktiven Zuschlägen,\r\nbetriebliche Altersvorsorge sowie Urlaubs- und Weihnachtsgeld\r\n    Fahrtkostenzuschuss\r\n    Zuschläge für Mehr- und Wochenendarbeit\r\n    Kostenfreie arbeitsmedizinische Untersuchungen\r\n    Flexible Arbeitszeitmodelle\r\n    Unser Team als kompetenten und offenen Ansprechpartner mit jahrelanger Branchenerfahrung\r\nund medizinischen Hintergrund\r\n    Ein modernes Arbeitsumfeld mit besten Entwicklungsmöglichkeiten','2018-04-01 00:00:00',18,0,'2017-06-28 00:00:00','2017-07-20 00:00:00',1,1,4,30,1,'2017-06-27 14:19:30','2017-06-28 18:31:02'),(27,2,'Gesundheits- und Krankenpfleger (m/w) - stationäre und ambulante Pflege','','32876','Hamelin','Deutschland','Bei Job2Job übernehmen Sie anspruchsvolle Aufgaben, werden gründlich eingearbeitet und fest in\r\ndas bestehende Team integriert. Neben vielen interessanten Einblicken, gewinnen Sie an Kompetenz,\r\nwachsen an den vielfältigen Aufgaben und sammeln jede Menge Berufserfahrung.\r\nIhre Aufgaben im Wesentlichen:\r\n    Betreuung und Behandlungspflege der Patienten\r\n    Überprüfung des Gesundheitszustandes von Patienten\r\n    nach ärztlicher Verordnung Medikamente verabreichen\r\n    Erstellung von Pflegediagnosen, Pflegeplanungen und Dokumentationen\r\n    bei ärztlichen Maßnahmen assistieren\r\n    Bezugspersonen pflegerisch beraten\r\nSie verfügen über:\r\n    eine abgeschlossene Ausbildung als Gesundheits- und Krankenpfleger/in\r\n    Freude, Einfühlungsvermögen und Engagement im Umgang mit hilfebedürftigen Menschen in\r\nihrer aktuellen Lebenssituation\r\n    eine hohe Einsatzbereitschaft und zeitliche Flexibilität\r\nWas Sie erwartet:\r\n    abwechslungsreiche und interessante Tätigkeiten\r\n    ein festes Arbeitsverhältnis mit leistungsgerechter Vergütung sowie attraktiven Zuschlägen,\r\nbetriebliche Altersvorsorge sowie Urlaubs- und Weihnachtsgeld\r\n    Fahrtkostenzuschuss\r\n    Zuschläge für Mehr- und Wochenendarbeit\r\n    kostenfreie arbeitsmedizinische Untersuchungen\r\n    flexible Arbeitszeitmodelle\r\n    unser Team als kompetenten und offenen Ansprechpartner mit jahrelanger Branchenerfahrung\r\nund medizinischen Hintergrund\r\n    ein modernes Arbeitsumfeld mit besten Entwicklungsmöglichkeiten','2018-04-01 00:00:00',24,0,'2017-06-28 00:00:00','2017-07-19 00:00:00',1,2,1,30,1,'2017-06-27 14:20:58','2017-06-28 18:30:58'),(28,2,'Wir suchen Sie als Niederlassungsleiter (m/w)','','30422','Hannover','Deutschland','Als Partner für medizinische Personallösungen bauen wir unseren Geschäftsbereich in Holzminden,\r\nHannover und Hildesheim weiter aus und bieten eine langfristige Perspektive. Wenn Sie sich\r\nidealerweise im Gesundheitswesen auskennen und sich beruflich verändern wollen, sind Sie bei uns\r\nrichtig.\r\nDas bieten wir:\r\n    Selbstständiger Gestaltungsspielraum mit hohem Grad an Freiraum\r\n    Intensive Einarbeitung von erfahrenen Kollegen\r\n    Ein modernes Arbeitsumfeld mit besten Entwicklungsmöglichkeiten und einem guten Betriebsklima\r\nIhre Aufgaben im Wesentlichen:\r\n    Kundenberatung im Gesundheitsbereich: Sie beraten unsere Bestandskunden sowie Neukunden\r\nund bieten passende Bedarfslösungen an\r\n    Sie rekrutieren Pflegefachkräfte und nutzen dafür kreative und professionelle Vertriebswege, um\r\nMitarbeiter zu gewinnen\r\n    Sie erstellen Kundenangebote und kalkulieren diese selbstständig\r\n    Sie steuern Ihre Niederlassung, behalten dabei den Überblick der Wirtschaftlichkeit und sind\r\nverantwortlich für die Einhaltung von Sicherheits– und Gesundheitsstandards\r\nWir wünschen uns, dass:\r\n    Sie auch in hektischen Zeiten den Überblick behalten und dabei dienstleistungsorientiert handeln\r\n    es Ihre Stärke ist, auf Menschen aktiv zu zuzugehen\r\n    Sie über Kenntnisse im Vertrieb verfügen\r\n    Sie über sehr gute Deutschkenntnisse in Wort und Schrift verfügen\r\n    Sie eine angenehme Telefonstimme haben\r\n    Sie gute Kenntnisse der MS-Office Palette mitbringen\r\n    eine ausgeprägte Kommunikationsfähigkeit, Beharrlichkeit und Motivation besteht\r\n    Sie außerdem über eine hohe Einsatzbereitschaft und zeitliche Flexibilität verfügen\r\n    eine ausgeprägte Dienstleistungsorientierung, Zuverlässigkeit und Freude an der Arbeit für Sie\r\nselbstverständlich ist','2018-03-01 00:00:00',24,0,'2017-06-28 00:00:00','2017-07-17 00:00:00',2,3,4,30,1,'2017-06-27 14:42:18','2017-06-28 18:30:54'),(29,2,'Repräsentanten – Außendienstmitarbeiter (m/w)','','31567','Hildesheim','Deutschland','Bei Job2Job übernehmen Sie anspruchsvolle Aufgaben, werden gründlich eingearbeitet und fest in\r\ndas bestehende Team integriert. Neben vielen interessanten Einblicken, gewinnen Sie an Kompetenz,\r\nwachsen an den vielfältigen Aufgaben und sammeln jede Menge Berufserfahrung.\r\nIhre Aufgaben im Wesentlichen:\r\n    Sie repräsentieren unser Kundenunternehmen vor Ort\r\n    Sie überzeugen den Interessenten von den zu vermarktenden Dienstleistungen\r\n    Sie entwerfen Unternehmensprozesse vor Ort und können diese zielsicher repräsentieren\r\nSie verfügen über:\r\n    Eine erfolgreich abgeschlossene kaufmännische Ausbildung\r\n    Sie verfügen über gute Kenntnisse im Vertrieb\r\n    Abschlusssicherheit\r\n    Ein gepflegtes Äußeres\r\n    Sehr gute Deutschkenntnisse in Wort und Schrift\r\n    Gute Kenntnisse der MS-Office Palette\r\n    Ausgeprägte Kommunikationsfähigkeit\r\n    Beharrlichkeit und Motivation\r\n    Führerschein Klasse B\r\n    Außerdem verfügen Sie über eine hohe Einsatzbereitschaft und zeitliche Flexibilität\r\n    Eine ausgeprägte Dienstleistungsorientierung, Zuverlässigkeit und Freude an der Arbeit sind für\r\nSie selbstverständlich','2018-01-01 00:00:00',36,1,'2017-06-28 00:00:00','2017-07-31 00:00:00',2,1,4,30,1,'2017-06-27 14:43:32','2017-07-02 21:05:32'),(31,2,'my anzeige','','30444','Köln','Deutschland','sdfgsdfhsdfghdfjg','2017-08-01 00:00:00',36,1,'2017-07-13 00:00:00','2017-07-31 00:00:00',1,1,4,1,1,'2017-07-13 12:30:24','2017-07-13 12:36:12'),(34,2,'aaaaaa','','31222','Düsseldorf','Deutschland','<p><strong>sdrfsdr</strong></p><p><em><span style=\"font-size: 8px;\">sdrgdfghnfghae</span></em></p><p><u><span style=\"font-size: 30px;\">sdfgdfh</span></u></p>','2017-07-01 00:00:00',32,0,'2017-07-13 00:00:00','2017-07-31 00:00:00',1,1,1,1,1,'2017-07-13 13:02:10','2017-07-28 21:23:16'),(35,5,'anzeige test','','333333','Berlin','Deutschland','dsfgdfh','2017-10-01 00:00:00',23,0,'2017-07-16 00:00:00','2017-07-31 00:00:00',1,1,1,1,0,'2017-07-16 11:26:04','2017-07-16 11:36:02'),(51,5,'wwwwwwwwww','','333333','Hamelin','Deutschland','<p>dsfgsdfg</p><p><strong>bbbbbbbbbbb</strong></p><p><u>iiiiiiiiiiiiiiiiiii</u></p><p>uuuuuuuuuuuuuuu</p><ol><li>aaaaa</li><li>bbbbb</li><li>ccccccc</li><li>ddddd</li></ol><p><br></p><p style=\"text-align: right;\">trgdrththrtzjrtzj</p><p style=\"text-align: center;\">ztujrtzujtzuk</p><p>trzhrtzjrtzj</p><p><br></p><p><br></p>','2018-05-01 00:00:00',12,0,'2017-07-19 00:00:00','2017-07-31 00:00:00',1,1,3,30,1,'2017-07-19 21:23:10','2017-07-19 21:24:19');
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
  `skill` varchar(100) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`jobid`,`skill`),
  CONSTRAINT `FK_JOBPOSTIONSKILL_JOBPOSITION` FOREIGN KEY (`jobid`) REFERENCES `j2j_jobposition` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `j2j_jobpositionskill`
--

LOCK TABLES `j2j_jobpositionskill` WRITE;
/*!40000 ALTER TABLE `j2j_jobpositionskill` DISABLE KEYS */;
INSERT INTO `j2j_jobpositionskill` VALUES (12,'Notfallmaßnahmen','2017-06-28 18:31:41'),(19,'Web Design','2017-06-28 18:31:33'),(20,'C++','2017-06-28 18:31:28'),(21,'C++','2017-06-28 18:31:24'),(21,'Java','2017-06-28 18:31:24'),(22,'Notfallmanagement','2017-06-28 18:31:20'),(22,'PEG Versorgung','2017-06-28 18:31:20'),(22,'Wundmanagement','2017-06-28 18:31:20'),(23,'Hydraulikleitungen  Managment','2017-06-28 18:31:15'),(24,'ECSCAD','2017-06-28 18:31:11'),(25,'Staffing Strategie','2017-06-28 18:31:07'),(25,'Staffing-Managements','2017-06-28 18:31:07');
/*!40000 ALTER TABLE `j2j_jobpositionskill` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `j2j_jobtype`
--

DROP TABLE IF EXISTS `j2j_jobtype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `j2j_jobtype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(85) NOT NULL,
  `menutitle` varchar(85) DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `j2j_jobtype`
--

LOCK TABLES `j2j_jobtype` WRITE;
/*!40000 ALTER TABLE `j2j_jobtype` DISABLE KEYS */;
INSERT INTO `j2j_jobtype` VALUES (1,'MED / PHARMA','MED',1),(2,'KAUFMÄNNISCH','KAUFMÄNNISCH',1),(3,'ENGINEERING','ENGINEERING',1),(4,'SONSTIGES','SONSTIGES',1);
/*!40000 ALTER TABLE `j2j_jobtype` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `j2j_languages`
--

DROP TABLE IF EXISTS `j2j_languages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `j2j_navigation`
--

LOCK TABLES `j2j_navigation` WRITE;
/*!40000 ALTER TABLE `j2j_navigation` DISABLE KEYS */;
INSERT INTO `j2j_navigation` VALUES (1,0,'backend','en','Home','site/index',NULL,'glyphicon-home',1,'2016-09-16 13:13:52','2016-09-16 13:13:52',1),(2,0,'backend','de','erste Seite','site/index',NULL,'glyphicon-home',1,'2016-09-16 13:13:52','2016-09-16 13:13:52',1),(3,0,'backend','en','Einstellungen','#',NULL,'glyphicon-wrench',30,'2016-09-16 13:16:20','2016-09-16 13:16:20',1),(4,0,'backend','de','Einstellungen','#',NULL,'glyphicon-wrench',30,'2016-09-16 13:16:20','2016-09-16 13:16:20',1),(5,3,'backend','en','Benutzer','users/index',NULL,'glyphicon-user',1,'2016-09-16 13:19:49','2016-09-16 13:19:49',1),(6,3,'backend','en','Benutzergruppen','usergroup/index',NULL,'glyphicon-tasks',2,'2016-09-16 13:19:49','2016-09-16 13:19:49',1),(7,3,'backend','en','Skills','skills/index',NULL,'glyphicon-align-left',3,'2016-09-16 13:19:49','2016-09-16 13:19:49',1),(8,4,'backend','de','Benutzer','users/index',NULL,'glyphicon-user',1,'2016-09-16 13:19:49','2016-09-16 13:19:49',1),(9,4,'backend','de','Benutzergruppen','usergroup/index',NULL,'glyphicon-tasks',2,'2016-09-16 13:19:49','2016-09-16 13:19:49',1),(10,4,'backend','de','Fähigkeiten','skills/index',NULL,'glyphicon-align-left',3,'2016-09-16 13:19:49','2016-09-16 13:19:49',1),(11,0,'backend','en','Utils','utils/index',NULL,'glyphicon-certificate',50,'2016-09-16 13:52:07','2016-09-16 13:52:07',1),(12,0,'backend','de','Utils','utils/index',NULL,'glyphicon-certificate',50,'2016-09-16 13:52:07','2016-09-16 13:52:07',1),(13,3,'backend','en','Language','languages/index',NULL,'glyphicon-font',4,'2016-09-18 13:05:02','2016-09-18 13:05:02',1),(14,4,'backend','de','Sprache','languages/index',NULL,'glyphicon-font',4,'2016-09-18 13:05:03','2016-09-18 13:05:03',1),(15,0,'backend','en','Unternehmen','company/index',NULL,'glyphicon-modal-window',5,'2016-09-22 10:28:33','2016-09-22 10:28:33',1),(16,0,'backend','de','Unternehmen','company/index',NULL,'glyphicon-modal-window',5,'2016-09-22 10:28:33','2016-09-22 10:28:33',1),(17,0,'backend','en','Stellenanzeige','jobpos/index',NULL,'glyphicon-bullhorn',7,'2016-09-22 10:28:33','2016-09-22 10:28:33',1),(18,0,'backend','de','Stellenanzeige','jobpos/index',NULL,'glyphicon-bullhorn',7,'2016-09-22 10:28:33','2016-09-22 10:28:33',1),(19,0,'backend','en','Bewerber','candidate/index',NULL,'glyphicon-blackboard',8,'2016-09-22 10:28:33','2016-09-22 10:28:33',1),(20,0,'backend','de','Bewerber','Candidate/index',NULL,'glyphicon-blackboard',8,'2016-09-22 10:28:33','2016-09-22 10:28:33',1),(21,0,'frontend','en','Home','site/home','gotopage(\'dvhome\');','glyphicon-home',1,'0000-00-00 00:00:00','0000-00-00 00:00:00',1),(22,0,'frontend','de','erste Seite','site/home',NULL,'glyphicon-home',1,'0000-00-00 00:00:00','0000-00-00 00:00:00',1),(23,0,'frontend','en','Bewerber','site/candidate',NULL,'glyphicon-home',2,'0000-00-00 00:00:00','0000-00-00 00:00:00',1),(24,0,'frontend','de','Bewerber','site/candidate',NULL,'glyphicon-home',2,'0000-00-00 00:00:00','0000-00-00 00:00:00',1),(25,0,'frontend','en','Unternehmen','site/company',NULL,'glyphicon-home',3,'0000-00-00 00:00:00','0000-00-00 00:00:00',1),(26,0,'frontend','de','Unternehmen','site/company',NULL,'glyphicon-home',3,'0000-00-00 00:00:00','0000-00-00 00:00:00',1),(27,0,'frontend','en','Contact','site/contact',NULL,'glyphicon-home',4,'0000-00-00 00:00:00','0000-00-00 00:00:00',1),(28,0,'frontend','de','Kontakt','site/contact',NULL,'glyphicon-home',4,'0000-00-00 00:00:00','0000-00-00 00:00:00',1),(29,0,'frontend','en','about','site/about',NULL,'glyphicon-home',4,'0000-00-00 00:00:00','0000-00-00 00:00:00',1),(30,0,'frontend','de','uber uns','site/about',NULL,'glyphicon-home',4,'0000-00-00 00:00:00','0000-00-00 00:00:00',1),(31,0,'frontright','en','Home','site/index',NULL,NULL,1,'2016-09-27 11:07:03','2016-09-27 11:07:03',1),(32,0,'frontright','de','erste Seite','site/index',NULL,NULL,1,'2016-09-27 11:07:03','2016-09-27 11:07:03',1),(33,0,'frontright','en','Job Search','site/jobsearch',NULL,NULL,2,'2016-09-27 11:07:03','2016-09-27 11:07:03',1),(34,0,'frontright','de','Job Suchen','site/jobsearch',NULL,NULL,2,'2016-09-27 11:07:03','2016-09-27 11:07:03',1),(35,0,'frontright','en','Filialen','site/branches',NULL,NULL,3,'2016-09-27 11:07:03','2016-09-27 11:07:03',1),(36,0,'frontright','de','Filialen','site/branches',NULL,NULL,3,'2016-09-27 11:07:03','2016-09-27 11:07:03',1),(37,0,'frontright','en','Contact','site/contact',NULL,NULL,4,'2016-09-27 11:07:03','2016-09-27 11:07:03',1),(38,0,'frontright','de','Kontakt','site/contact',NULL,NULL,4,'2016-09-27 11:07:03','2016-09-27 11:07:03',1),(39,0,'frontright','en','Initiative Application','site/initiativeapp',NULL,NULL,5,'2016-09-27 11:07:03','2016-09-27 11:07:03',1),(40,0,'frontright','de','Initiativbewerbung','site/initiativeapp',NULL,NULL,5,'2016-09-27 11:07:03','2016-09-27 11:07:03',1),(41,3,'backend','en','Email Ready Text','emailtext/index',NULL,'glyphicon-envelope',5,'0000-00-00 00:00:00','0000-00-00 00:00:00',1),(42,4,'backend','de','E-Mail bereit Text','emailtext/index',NULL,'glyphicon-envelope',5,'0000-00-00 00:00:00','0000-00-00 00:00:00',1),(43,3,'backend','en','Message User List','tgtmsguser/index',NULL,'glyphicon-align-justify',6,'2016-09-28 12:54:12','2016-09-28 12:54:12',1),(44,4,'backend','de','Nachricht Benutzerliste','tgtmsguser/index',NULL,'glyphicon-align-justify',6,'2016-09-28 12:54:12','2016-09-28 12:54:12',1),(45,0,'backend','de','Personalentscheider','pdt/index',NULL,'glyphicon-eye-open',6,'2017-07-12 12:54:12','2017-07-12 12:54:12',1),(46,0,'backend','en','Personalentscheider','pdt/index',NULL,'glyphicon-eye-open',6,'2017-07-12 12:54:12','2017-07-12 12:54:12',1),(47,0,'backend','de','hochgeladene Dateien','upfiles/index',NULL,'glyphicon-open-file',9,'2016-09-16 13:52:07','2016-09-16 13:52:07',1),(48,0,'backend','en','hochgeladene Dateien','upfiles/index',NULL,'glyphicon-open-file',9,'2016-09-16 13:52:07','2016-09-16 13:52:07',1),(49,0,'backend','de','Bewerbungen','apply/index?status=0',NULL,'glyphicon-ok-sign',10,'2016-09-16 13:52:07','2016-09-16 13:52:07',1),(50,0,'backend','en','Bewerbungen','apply/index?status=0',NULL,'glyphicon-ok-sign',10,'2016-09-16 13:52:07','2016-09-16 13:52:07',1);
/*!40000 ALTER TABLE `j2j_navigation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `j2j_personaldecisionmaker`
--

DROP TABLE IF EXISTS `j2j_personaldecisionmaker`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
  `createdate` datetime NOT NULL,
  `updatedate` datetime DEFAULT NULL,
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
INSERT INTO `j2j_personaldecisionmaker` VALUES (30,5,'Herr','','hamid1@g.de','0049-123-45678','0054-324-1234','E-Mail, ','morgen 10 - 13',0,'2017-05-17 00:00:00','2017-07-24 14:25:35'),(36,2,'Frau','','sdfdsfg@fg.de','--','--','','',1,'2017-07-02 12:33:41','2017-07-02 12:33:41'),(38,2,'','','ff@ff.dw','11-222-33333','44-555-666666','Telefon, E-Mail, ','cccccccccccccc',0,'2017-07-12 21:27:20','2017-07-12 21:37:18'),(39,3,'Herr','','sssvvv@ff.gt','','',NULL,'',1,'2017-07-12 22:50:28','2017-07-12 22:50:28'),(40,5,'Frau','','qqqq@ee.gt','--','--','','',1,'2017-07-24 14:25:35','2017-07-24 14:25:35');
/*!40000 ALTER TABLE `j2j_personaldecisionmaker` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `j2j_postcode`
--

DROP TABLE IF EXISTS `j2j_postcode`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `j2j_postcode` (
  `code` int(11) NOT NULL,
  `city` varchar(50) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1',
  PRIMARY KEY (`code`),
  KEY `FK_POSTCODE_CITY_idx` (`city`),
  CONSTRAINT `FK_POSTCODE_CITY` FOREIGN KEY (`city`) REFERENCES `j2j_city` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `j2j_postcode`
--

LOCK TABLES `j2j_postcode` WRITE;
/*!40000 ALTER TABLE `j2j_postcode` DISABLE KEYS */;
INSERT INTO `j2j_postcode` VALUES (30179,'Hannover',1),(30212,'Hannover',1),(30349,'Hannover',1),(30419,'Hannover',1),(30422,'Hannover',1),(30444,'Köln',1),(30455,'Hannover',1),(30822,'Hannover',1),(30888,'Berlin',1),(31222,'Düsseldorf',1),(31456,'Düsseldorf',1),(31567,'Hildesheim',1),(32876,'Hamelin',1),(33456,'Hamelin',1),(34223,'Hamelin',1),(35634,'Hannover',1),(44900,'Hamelin',1),(66675,'Berlin',1),(123456,'Hamelin',1),(333333,'Berlin',1);
/*!40000 ALTER TABLE `j2j_postcode` ENABLE KEYS */;
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
  `jobtype` int(11) NOT NULL DEFAULT '1',
  `status` smallint(6) DEFAULT '1',
  `createdate` datetime NOT NULL,
  `updatedate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `j2j_skills`
--

LOCK TABLES `j2j_skills` WRITE;
/*!40000 ALTER TABLE `j2j_skills` DISABLE KEYS */;
INSERT INTO `j2j_skills` VALUES (1,0,'ENGINEERING',3,1,'2016-09-17 12:40:34','2016-09-17 12:40:34'),(2,1,'C++',3,1,'2016-09-17 12:45:26','2016-09-17 12:45:26'),(3,1,'Java',3,1,'2016-09-17 12:55:44','2016-09-17 12:55:44'),(4,1,'JavaScript',3,1,'2016-09-17 22:27:19','2016-09-17 22:27:19'),(8,1,'HTML',3,1,'2016-09-17 22:40:43','2016-09-17 22:40:43'),(9,1,'C#',3,1,'2017-03-19 21:38:16','2017-03-19 21:38:16'),(10,1,'Web Design',3,1,'2017-03-28 21:31:44','2017-03-28 21:31:44'),(11,0,'MED / PHARMA',1,1,'2017-04-08 00:00:00','2017-04-08 00:00:00'),(12,0,'KAUFMÄNNISCH',2,1,'2017-04-08 00:00:00','2017-04-08 00:00:00'),(13,1,'mm',2,0,'2017-06-07 13:17:03','2017-06-07 13:17:03'),(14,1,'ww',2,0,'2017-06-07 13:17:03','2017-06-07 13:17:03'),(15,1,'QQQQTTTTT',3,0,'2017-06-07 13:17:50','2017-06-07 13:17:50'),(24,1,'TTTT',3,0,'2017-06-20 08:56:38','2017-06-20 08:56:38'),(25,1,'WWWW',3,0,'2017-06-20 08:56:38','2017-06-20 08:56:38'),(26,1,'fdhgfd',3,0,'2017-06-20 09:23:47','2017-06-20 09:23:47'),(27,1,'ertges',3,0,'2017-06-20 09:23:47','2017-06-20 09:23:47'),(28,1,'qqq1111',1,0,'2017-06-20 09:24:19','2017-06-20 09:24:19'),(29,1,'WWW',3,0,'2017-06-20 09:25:22','2017-06-20 09:25:22'),(30,1,'PEG Versorgung',1,0,'2017-06-22 14:59:40','2017-06-22 14:59:40'),(31,1,'Wundmanagement',1,0,'2017-06-22 14:59:40','2017-06-22 14:59:40'),(32,1,'Notfallmanagement',1,0,'2017-06-22 14:59:40','2017-06-22 14:59:40'),(33,1,'Hydraulikleitungen  Managment',3,0,'2017-06-22 15:02:26','2017-06-22 15:02:26'),(34,1,'ECSCAD',3,0,'2017-06-22 15:03:58','2017-06-22 15:03:58'),(35,1,'Staffing-Managements',2,0,'2017-06-22 15:06:48','2017-06-22 15:06:48'),(36,1,'Staffing Strategie',2,0,'2017-06-22 15:06:48','2017-06-22 15:06:48'),(37,1,'Notfallmaßnahmen',1,0,'2017-06-22 15:10:38','2017-06-22 15:10:38'),(38,1,'Staffing Strategie',2,0,'2017-06-28 18:31:07','2017-06-28 18:31:07'),(39,1,'Staffing-Managements',2,0,'2017-06-28 18:31:07','2017-06-28 18:31:07'),(40,1,'ECSCAD',3,0,'2017-06-28 18:31:11','2017-06-28 18:31:11'),(41,1,'Hydraulikleitungen  Managment',3,0,'2017-06-28 18:31:15','2017-06-28 18:31:15'),(42,1,'Notfallmanagement',1,0,'2017-06-28 18:31:20','2017-06-28 18:31:20'),(43,1,'PEG Versorgung',1,0,'2017-06-28 18:31:20','2017-06-28 18:31:20'),(44,1,'Wundmanagement',1,0,'2017-06-28 18:31:20','2017-06-28 18:31:20'),(45,1,'Notfallmaßnahmen',1,0,'2017-06-28 18:31:41','2017-06-28 18:31:41'),(46,1,'QQQQTTTTT',3,0,'2017-07-18 12:21:16','2017-07-18 12:21:16'),(47,0,'SONSTIGES',4,1,'2017-07-18 12:21:16','2017-07-18 12:21:16');
/*!40000 ALTER TABLE `j2j_skills` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `j2j_targetmessageusers`
--

DROP TABLE IF EXISTS `j2j_targetmessageusers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `j2j_uploadedfiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file` varchar(200) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '0',
  `upload_date` datetime NOT NULL,
  `userid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `j2j_uploadedfiles`
--

LOCK TABLES `j2j_uploadedfiles` WRITE;
/*!40000 ALTER TABLE `j2j_uploadedfiles` DISABLE KEYS */;
INSERT INTO `j2j_uploadedfiles` VALUES (1,'/job2job/frontend/web/company_logo/5.jpg',0,'2017-07-27 12:44:30',30),(2,'/job2job/frontend/web/candidate_photo/9.jpg',0,'2017-07-27 12:44:50',9),(3,'/job2job/frontend/web/candidate_doc/9/Kündigung.pdf',0,'2017-07-27 12:45:08',9);
/*!40000 ALTER TABLE `j2j_uploadedfiles` ENABLE KEYS */;
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
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = utf8 */;
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
  `status` smallint(6) NOT NULL DEFAULT '1',
  `createdate` datetime NOT NULL,
  `updatedate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_USER_GROUP_idx` (`group`),
  KEY `FK_USER_PERMISSION_idx` (`permission`),
  CONSTRAINT `FK_USER_GROUP` FOREIGN KEY (`group`) REFERENCES `j2j_usergroup` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_USER_PERMISSION` FOREIGN KEY (`permission`) REFERENCES `j2j_userpermission` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `j2j_users`
--

LOCK TABLES `j2j_users` WRITE;
/*!40000 ALTER TABLE `j2j_users` DISABLE KEYS */;
INSERT INTO `j2j_users` VALUES (1,'hamid','$2y$13$0RxDra3j21WT65PMPZcGb.72cb8IDCNuSmaOhJZqNwmOzaG06AxRS',NULL,'-','Hamidreza','Seifi','0000-00-00 00:00:00',1,1,1,1,'2016-09-11 20:23:44','2016-09-11 20:23:44'),(3,'user','User88',NULL,'-','user','user','0000-00-00 00:00:00',1,2,2,1,'2016-09-28 13:37:22','2016-09-28 11:37:22'),(9,'hamidrezaseifi@gmail.com','$2y$13$GByBSMRqIQngWyNq49kh1u.XAcCt9J.0BhV.3JXpW5XnmLKuHDAW6',NULL,'','Hamidreza','Seifi','1977-09-11 00:00:00',3,2,2,1,'2017-04-11 00:00:00','2017-07-27 00:00:00'),(30,'hamid1@g.de','$2y$13$GByBSMRqIQngWyNq49kh1u.XAcCt9J.0BhV.3JXpW5XnmLKuHDAW6',NULL,NULL,'hamid1','sef1','1978-05-07 00:00:00',2,2,2,1,'2017-05-17 00:00:00','2017-07-24 14:25:35'),(36,'sdfdsfg@fg.de','',NULL,NULL,'Elham','Rafiei','1981-01-17 00:00:00',2,2,2,1,'2017-07-02 12:33:41','2017-07-02 12:33:41'),(38,'ff@ff.dw','$2y$13$hZvCrdAMLm3.lj6wz.sjK.bcW1hZvtUSnZOmu8OcL1evD88kFnULu',NULL,NULL,'vvvv','nnnn','2000-06-22 00:00:00',2,2,2,1,'2017-07-12 21:27:20','2017-07-12 21:37:18'),(39,'sssvvv@ff.gt','$2y$13$p6BMV.Do4snsroQCiHJ0Uu9R9Y4XFqt8dBIiM1MzeFIwCHqNkD8TC',NULL,NULL,'SSS','vvvv','1982-01-20 00:00:00',2,2,2,1,'2017-07-12 22:50:28','2017-07-12 22:50:28'),(40,'qqqq@ee.gt','',NULL,NULL,'sv2','nnnnn2','1990-01-17 00:00:00',2,2,2,1,'2017-07-24 14:25:35','2017-07-24 14:25:35'),(41,'qqq@ww.ds',NULL,NULL,NULL,'vvv','nnnn','1990-01-01 00:00:00',1,2,2,1,'2017-07-14 21:09:13','2017-07-14 21:09:13');
/*!40000 ALTER TABLE `j2j_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `j2j_vacancy`
--

DROP TABLE IF EXISTS `j2j_vacancy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `j2j_vacancy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(55) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `j2j_vacancy`
--

LOCK TABLES `j2j_vacancy` WRITE;
/*!40000 ALTER TABLE `j2j_vacancy` DISABLE KEYS */;
INSERT INTO `j2j_vacancy` VALUES (1,'Arbeitnehmerüberlassung',1),(2,'Personalfestanstellung',1),(3,'Personalrekrutierung',1);
/*!40000 ALTER TABLE `j2j_vacancy` ENABLE KEYS */;
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

--
-- Table structure for table `j2j_worktimemodel`
--

DROP TABLE IF EXISTS `j2j_worktimemodel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `j2j_worktimemodel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `j2j_worktimemodel`
--

LOCK TABLES `j2j_worktimemodel` WRITE;
/*!40000 ALTER TABLE `j2j_worktimemodel` DISABLE KEYS */;
INSERT INTO `j2j_worktimemodel` VALUES (1,'Teilzeit',1),(2,'Schichtarbeit',1),(3,'Minijob',1),(4,'Vollzeit',1);
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

-- Dump completed on 2017-07-28 22:28:11
