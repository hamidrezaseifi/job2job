-- MySQL dump 10.13  Distrib 5.7.9, for Win64 (x86_64)
--
-- Host: localhost    Database: job2job
-- ------------------------------------------------------
-- Server version	5.6.12-log

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
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `j2j_candidate`
--

LOCK TABLES `j2j_candidate` WRITE;
/*!40000 ALTER TABLE `j2j_candidate` DISABLE KEYS */;
INSERT INTO `j2j_candidate` VALUES (9,'Herr','','iranisch',NULL,'hamidrezaseifi@gmail.com','30419','Hannover','Deutschland','Rigaer St. 29G','0049-162-2810148','0049-162-2810148','','08:00 bis  18:00',1,'Verfügber',3,NULL,'30419','Hannover','Deutschland',10,4,'mein ansch','2017-04-10 00:00:00','2017-06-07 00:00:00'),(23,'','','-',NULL,'sdfsd@rtdrt.de',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2017-05-15 00:00:00',NULL),(24,'','','-',NULL,'sdfsd@rtdrt.de',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2017-05-15 00:00:00',NULL),(25,'','','-',NULL,'hamidreza@gm.de',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2017-05-17 00:00:00',NULL),(26,'','','-',NULL,'hamidreza@gm.de',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2017-05-17 00:00:00',NULL);
/*!40000 ALTER TABLE `j2j_candidate` ENABLE KEYS */;
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
INSERT INTO `j2j_candidateskill` VALUES (9,'QQQQTTTTT','2017-06-07 13:17:50');
/*!40000 ALTER TABLE `j2j_candidateskill` ENABLE KEYS */;
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
  `companytype` int(11) NOT NULL,
  `founddate` datetime NOT NULL,
  `adress` text,
  `steueid` varchar(50) NOT NULL,
  `logo` varchar(200) DEFAULT NULL,
  `connectedcompanies` varchar(100) NOT NULL,
  `employeecount` int(11) NOT NULL DEFAULT '0',
  `status` smallint(6) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `j2j_company`
--

LOCK TABLES `j2j_company` WRITE;
/*!40000 ALTER TABLE `j2j_company` DISABLE KEYS */;
INSERT INTO `j2j_company` VALUES (2,'firm',0,'2017-05-07 00:00:00',NULL,'',NULL,'',0,1,'2017-05-17 00:00:00',NULL);
/*!40000 ALTER TABLE `j2j_company` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `j2j_company_users`
--

DROP TABLE IF EXISTS `j2j_company_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `j2j_company_users` (
  `companyid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  PRIMARY KEY (`companyid`,`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `j2j_company_users`
--

LOCK TABLES `j2j_company_users` WRITE;
/*!40000 ALTER TABLE `j2j_company_users` DISABLE KEYS */;
INSERT INTO `j2j_company_users` VALUES (2,30),(2,31);
/*!40000 ALTER TABLE `j2j_company_users` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `j2j_companytype`
--

LOCK TABLES `j2j_companytype` WRITE;
/*!40000 ALTER TABLE `j2j_companytype` DISABLE KEYS */;
INSERT INTO `j2j_companytype` VALUES (1,'Form 1',1),(2,'Form 2',1),(3,'Form 3',1),(4,'Form 4',1);
/*!40000 ALTER TABLE `j2j_companytype` ENABLE KEYS */;
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
  PRIMARY KEY (`id`)
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
  `title` varchar(500) NOT NULL,
  `subtitle` varchar(500) NOT NULL,
  `postcode` varchar(20) DEFAULT NULL,
  `city` varchar(80) DEFAULT NULL,
  `country` varchar(80) DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1',
  `createdate` datetime NOT NULL,
  `updatedate` datetime NOT NULL,
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
  `skill` varchar(100) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`jobid`),
  CONSTRAINT `FK_JOBPOSTIONSKILL_JOBPOSITION` FOREIGN KEY (`jobid`) REFERENCES `j2j_jobposition` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `j2j_jobtype`
--

LOCK TABLES `j2j_jobtype` WRITE;
/*!40000 ALTER TABLE `j2j_jobtype` DISABLE KEYS */;
INSERT INTO `j2j_jobtype` VALUES (1,'MED / PHARMA','MED',1),(2,'KAUFMÄNNISCH','KAUFMÄNNISCH',1),(3,'ENGINEERING','ENGINEERING',1);
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
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `j2j_navigation`
--

LOCK TABLES `j2j_navigation` WRITE;
/*!40000 ALTER TABLE `j2j_navigation` DISABLE KEYS */;
INSERT INTO `j2j_navigation` VALUES (1,0,'backend','en','Home','site/index',NULL,'glyphicon-home',1,'2016-09-16 13:13:52','2016-09-16 13:13:52',1),(2,0,'backend','de','erste Seite','site/index',NULL,'glyphicon-home',1,'2016-09-16 13:13:52','2016-09-16 13:13:52',1),(3,0,'backend','en','Settings','#',NULL,'glyphicon-wrench',30,'2016-09-16 13:16:20','2016-09-16 13:16:20',1),(4,0,'backend','de','Einstellungen','#',NULL,'glyphicon-wrench',30,'2016-09-16 13:16:20','2016-09-16 13:16:20',1),(5,3,'backend','en','Users','users/index',NULL,'glyphicon-user',1,'2016-09-16 13:19:49','2016-09-16 13:19:49',1),(6,3,'backend','en','User Groups','usergroup/index',NULL,'glyphicon-tasks',2,'2016-09-16 13:19:49','2016-09-16 13:19:49',1),(7,3,'backend','en','Skills','skills/index',NULL,'glyphicon-align-left',3,'2016-09-16 13:19:49','2016-09-16 13:19:49',1),(8,4,'backend','de','Benutzer','users/index',NULL,'glyphicon-user',1,'2016-09-16 13:19:49','2016-09-16 13:19:49',1),(9,4,'backend','de','Benutzergruppen','usergroup/index',NULL,'glyphicon-tasks',2,'2016-09-16 13:19:49','2016-09-16 13:19:49',1),(10,4,'backend','de','Fähigkeiten','skills/index',NULL,'glyphicon-align-left',3,'2016-09-16 13:19:49','2016-09-16 13:19:49',1),(11,0,'backend','en','Utils','utils/index',NULL,'glyphicon-certificate',50,'2016-09-16 13:52:07','2016-09-16 13:52:07',1),(12,0,'backend','de','Utils','utils/index',NULL,'glyphicon-certificate',50,'2016-09-16 13:52:07','2016-09-16 13:52:07',1),(13,3,'backend','en','Language','languages/index',NULL,'glyphicon-font',4,'2016-09-18 13:05:02','2016-09-18 13:05:02',1),(14,4,'backend','de','Sprache','languages/index',NULL,'glyphicon-font',4,'2016-09-18 13:05:03','2016-09-18 13:05:03',1),(15,0,'backend','en','Company','company/index',NULL,'glyphicon-modal-window',5,'2016-09-22 10:28:33','2016-09-22 10:28:33',1),(16,0,'backend','de','Unternehmer','company/index',NULL,'glyphicon-modal-window',5,'2016-09-22 10:28:33','2016-09-22 10:28:33',1),(17,0,'backend','en','Job Position','jobpos/index',NULL,'glyphicon-bullhorn',6,'2016-09-22 10:28:33','2016-09-22 10:28:33',1),(18,0,'backend','de','Job Position','jobpos/index',NULL,'glyphicon-bullhorn',6,'2016-09-22 10:28:33','2016-09-22 10:28:33',1),(19,0,'backend','en','Candidate','application/index',NULL,'glyphicon-blackboard',7,'2016-09-22 10:28:33','2016-09-22 10:28:33',1),(20,0,'backend','de','Bewerber','application/index',NULL,'glyphicon-blackboard',7,'2016-09-22 10:28:33','2016-09-22 10:28:33',1),(21,0,'frontend','en','Home','site/home','gotopage(\'dvhome\');','glyphicon-home',1,'0000-00-00 00:00:00','0000-00-00 00:00:00',1),(22,0,'frontend','de','erste Seite','site/home',NULL,'glyphicon-home',1,'0000-00-00 00:00:00','0000-00-00 00:00:00',1),(23,0,'frontend','en','Candidate','site/candidate',NULL,'glyphicon-home',2,'0000-00-00 00:00:00','0000-00-00 00:00:00',1),(24,0,'frontend','de','Bewerber','site/candidate',NULL,'glyphicon-home',2,'0000-00-00 00:00:00','0000-00-00 00:00:00',1),(25,0,'frontend','en','Company','site/company',NULL,'glyphicon-home',3,'0000-00-00 00:00:00','0000-00-00 00:00:00',1),(26,0,'frontend','de','Unternehmer','site/company',NULL,'glyphicon-home',3,'0000-00-00 00:00:00','0000-00-00 00:00:00',1),(27,0,'frontend','en','Contact','site/contact',NULL,'glyphicon-home',4,'0000-00-00 00:00:00','0000-00-00 00:00:00',1),(28,0,'frontend','de','Kontakt','site/contact',NULL,'glyphicon-home',4,'0000-00-00 00:00:00','0000-00-00 00:00:00',1),(29,0,'frontend','en','about','site/about',NULL,'glyphicon-home',4,'0000-00-00 00:00:00','0000-00-00 00:00:00',1),(30,0,'frontend','de','uber uns','site/about',NULL,'glyphicon-home',4,'0000-00-00 00:00:00','0000-00-00 00:00:00',1),(31,0,'frontright','en','Home','site/index',NULL,NULL,1,'2016-09-27 11:07:03','2016-09-27 11:07:03',1),(32,0,'frontright','de','erste Seite','site/index',NULL,NULL,1,'2016-09-27 11:07:03','2016-09-27 11:07:03',1),(33,0,'frontright','en','Job Search','site/jobsearch',NULL,NULL,2,'2016-09-27 11:07:03','2016-09-27 11:07:03',1),(34,0,'frontright','de','Job Suchen','site/jobsearch',NULL,NULL,2,'2016-09-27 11:07:03','2016-09-27 11:07:03',1),(35,0,'frontright','en','Branches','site/branches',NULL,NULL,3,'2016-09-27 11:07:03','2016-09-27 11:07:03',1),(36,0,'frontright','de','Filialen','site/branches',NULL,NULL,3,'2016-09-27 11:07:03','2016-09-27 11:07:03',1),(37,0,'frontright','en','Contact','site/contact',NULL,NULL,4,'2016-09-27 11:07:03','2016-09-27 11:07:03',1),(38,0,'frontright','de','Kontakt','site/contact',NULL,NULL,4,'2016-09-27 11:07:03','2016-09-27 11:07:03',1),(39,0,'frontright','en','Initiative Application','site/initiativeapp',NULL,NULL,5,'2016-09-27 11:07:03','2016-09-27 11:07:03',1),(40,0,'frontright','de','Initiativbewerbung','site/initiativeapp',NULL,NULL,5,'2016-09-27 11:07:03','2016-09-27 11:07:03',1),(41,3,'backend','en','Email Ready Text','emailtext/index',NULL,'glyphicon-envelope',5,'0000-00-00 00:00:00','0000-00-00 00:00:00',1),(42,4,'backend','de','E-Mail bereit Text','emailtext/index',NULL,'glyphicon-envelope',5,'0000-00-00 00:00:00','0000-00-00 00:00:00',1),(43,3,'backend','en','Message User List','tgtmsguser/index',NULL,'glyphicon-align-justify',6,'2016-09-28 12:54:12','2016-09-28 12:54:12',1),(44,4,'backend','de','Nachricht Benutzerliste','tgtmsguser/index',NULL,'glyphicon-align-justify',6,'2016-09-28 12:54:12','2016-09-28 12:54:12',1);
/*!40000 ALTER TABLE `j2j_navigation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `j2j_personaldecisionmaker`
--

DROP TABLE IF EXISTS `j2j_personaldecisionmaker`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `j2j_personaldecisionmaker` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `companyid` int(11) NOT NULL,
  `title` varchar(15) DEFAULT '',
  `title2` varchar(45) DEFAULT '',
  `fname` varchar(45) NOT NULL,
  `lname` varchar(45) NOT NULL,
  `email` varchar(100) NOT NULL,
  `cellphone` varchar(45) DEFAULT NULL,
  `tel` varchar(45) DEFAULT NULL,
  `reachability` varchar(45) DEFAULT NULL,
  `contacttime` varchar(45) DEFAULT NULL,
  `bdate` datetime NOT NULL,
  `isfirst` smallint(6) NOT NULL DEFAULT '1',
  `status` smallint(6) DEFAULT '1',
  `createdate` datetime NOT NULL,
  `updatedate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_PERSONALDECMAKER_USER_idx` (`userid`),
  CONSTRAINT `FK_PERSONALDECMAKER_USER` FOREIGN KEY (`userid`) REFERENCES `j2j_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `j2j_personaldecisionmaker`
--

LOCK TABLES `j2j_personaldecisionmaker` WRITE;
/*!40000 ALTER TABLE `j2j_personaldecisionmaker` DISABLE KEYS */;
INSERT INTO `j2j_personaldecisionmaker` VALUES (1,30,2,'','','','','hhhhh@ff.dr',NULL,NULL,NULL,NULL,'2017-05-07 00:00:00',1,1,'2017-05-17 00:00:00',NULL);
/*!40000 ALTER TABLE `j2j_personaldecisionmaker` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `j2j_skills`
--

LOCK TABLES `j2j_skills` WRITE;
/*!40000 ALTER TABLE `j2j_skills` DISABLE KEYS */;
INSERT INTO `j2j_skills` VALUES (1,0,'ENGINEERING',3,1,'2016-09-17 12:40:34','2016-09-17 12:40:34'),(2,1,'C++',3,1,'2016-09-17 12:45:26','2016-09-17 12:45:26'),(3,1,'Java',3,1,'2016-09-17 12:55:44','2016-09-17 12:55:44'),(4,1,'JavaScript',3,1,'2016-09-17 22:27:19','2016-09-17 22:27:19'),(8,1,'HTML',3,1,'2016-09-17 22:40:43','2016-09-17 22:40:43'),(9,1,'C#',3,1,'2017-03-19 21:38:16','2017-03-19 21:38:16'),(10,1,'Web Design',3,1,'2017-03-28 21:31:44','2017-03-28 21:31:44'),(11,0,'MED / PHARMA',1,1,'2017-04-08 00:00:00','2017-04-08 00:00:00'),(12,0,'KAUFMÄNNISCH',2,1,'2017-04-08 00:00:00','2017-04-08 00:00:00'),(13,1,'mm',2,0,'2017-06-07 13:17:03','2017-06-07 13:17:03'),(14,1,'ww',2,0,'2017-06-07 13:17:03','2017-06-07 13:17:03'),(15,1,'QQQQTTTTT',3,0,'2017-06-07 13:17:50','2017-06-07 13:17:50');
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `j2j_uploadedfiles`
--

LOCK TABLES `j2j_uploadedfiles` WRITE;
/*!40000 ALTER TABLE `j2j_uploadedfiles` DISABLE KEYS */;
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
  `bdate` datetime NOT NULL,
  `usertype` smallint(6) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `group` int(11) NOT NULL DEFAULT '-1',
  `permission` int(11) NOT NULL DEFAULT '2',
  `status` smallint(6) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `FK_USER_GROUP_idx` (`group`),
  KEY `FK_USER_PERMISSION_idx` (`permission`),
  CONSTRAINT `FK_USER_GROUP` FOREIGN KEY (`group`) REFERENCES `j2j_usergroup` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_USER_PERMISSION` FOREIGN KEY (`permission`) REFERENCES `j2j_userpermission` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `j2j_users`
--

LOCK TABLES `j2j_users` WRITE;
/*!40000 ALTER TABLE `j2j_users` DISABLE KEYS */;
INSERT INTO `j2j_users` VALUES (1,'hamid','$2y$13$0RxDra3j21WT65PMPZcGb.72cb8IDCNuSmaOhJZqNwmOzaG06AxRS',NULL,'-','Hamidreza','Seifi','0000-00-00 00:00:00',1,'2016-09-11 20:23:44','2016-09-11 20:23:44',1,1,1),(2,'test','Elec77',NULL,'-','test','test','0000-00-00 00:00:00',1,'2016-09-28 13:36:18','2016-09-28 11:36:18',2,2,1),(3,'user','User88',NULL,'-','user','user','0000-00-00 00:00:00',1,'2016-09-28 13:37:22','2016-09-28 11:37:22',2,2,1),(4,'puya','Elec73',NULL,'-','Puya','Mrs','0000-00-00 00:00:00',1,'2017-03-19 21:36:38','2017-03-19 21:36:37',2,2,1),(5,'ghbcvbn','$2y$13$s27WypAdBuwljOmF3aE2v.YiQgXXfGhcpLtfKp9RcoQlks9CPQYi.',NULL,'-','fgfgh','dfgdf','0000-00-00 00:00:00',1,'2017-03-28 21:30:34','2017-03-28 21:30:34',1,2,1),(9,'hamidrezaseifi@gmail.com','$2y$13$GByBSMRqIQngWyNq49kh1u.XAcCt9J.0BhV.3JXpW5XnmLKuHDAW6',NULL,'','Hamidreza','Seifi','1977-09-11 00:00:00',3,'2017-04-11 00:00:00','2017-06-06 00:00:00',2,2,1),(21,'sdfsd@rtdrt.de','',NULL,NULL,'cghbfg','fghfg','2017-05-14 00:00:00',3,'2017-05-15 00:00:00','2017-05-15 21:30:34',2,2,4),(22,'sdfsd@rtdrt.de','',NULL,NULL,'cghbfg','fghfg','2017-05-14 00:00:00',3,'2017-05-15 00:00:00','2017-05-15 21:31:28',2,2,4),(23,'sdfsd@rtdrt.de','',NULL,NULL,'cghbfg','fghfg','2017-05-14 00:00:00',3,'2017-05-15 00:00:00','2017-05-15 21:31:45',2,2,4),(24,'sdfsd@rtdrt.de','',NULL,NULL,'cghbfg','fghfg','2017-05-14 00:00:00',3,'2017-05-15 00:00:00','2017-05-15 21:32:29',2,2,4),(26,'hamidreza@gm.de','',NULL,NULL,'hamid','sef','2017-05-03 00:00:00',3,'2017-05-17 00:00:00','2017-05-17 19:53:16',2,2,4),(30,'hamid1@g.de','$2y$13$GByBSMRqIQngWyNq49kh1u.XAcCt9J.0BhV.3JXpW5XnmLKuHDAW6',NULL,NULL,'hamid1','sef1','2017-05-07 00:00:00',2,'2017-05-17 00:00:00','2017-05-17 20:01:27',2,2,1),(31,'hamid1@g.de','$2y$13$GByBSMRqIQngWyNq49kh1u.XAcCt9J.0BhV.3JXpW5XnmLKuHDAW6',NULL,NULL,'hamid2','sef2','2017-05-07 00:00:00',2,'2017-05-17 00:00:00','2017-05-17 20:01:27',2,2,1);
/*!40000 ALTER TABLE `j2j_users` ENABLE KEYS */;
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
INSERT INTO `j2j_worktimemodel` VALUES (1,'Teilzeit',1),(2,'Telearbeit',1),(3,'Minijob',1),(4,'Vollzeit',1);
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

-- Dump completed on 2017-06-07 16:22:33
