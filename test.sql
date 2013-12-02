-- MySQL dump 10.13  Distrib 5.5.23, for Win32 (x86)
--
-- Host: localhost    Database: qcm
-- ------------------------------------------------------
-- Server version	5.5.23

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
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `questions`
--

LOCK TABLES `questions` WRITE;
/*!40000 ALTER TABLE `questions` DISABLE KEYS */;
INSERT INTO `questions` VALUES (38,'Qui est le meilleur JokkoWorker du mois?'),(40,'Qui a crÃ©e FaceBook?'),(41,'Qui est le meilleur JokkoWorker du mois de mars?'),(42,'Qui est le meilleur JokkoWorker du mois de mars?'),(43,'Qui est le meilleur JokkoWorker du mois de mars?'),(44,'Qui est le meilleur JokkoWorker du mois de mars?'),(45,'Qui est le meilleur JokkoWorker du mois de mars?');
/*!40000 ALTER TABLE `questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reponses`
--

DROP TABLE IF EXISTS `reponses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reponses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` text NOT NULL,
  `id_question` int(11) NOT NULL,
  `correcte` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id_question` (`id_question`),
  CONSTRAINT `reponses_ibfk_1` FOREIGN KEY (`id_question`) REFERENCES `questions` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=88 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reponses`
--

LOCK TABLES `reponses` WRITE;
/*!40000 ALTER TABLE `reponses` DISABLE KEYS */;
INSERT INTO `reponses` VALUES (64,'Karim SY',38,1),(65,'Ludovic LIMA',38,1),(66,'Mouhammed WILANE',38,0),(70,'Zuckerberg',40,1),(71,'Steeve JOBS',40,0),(72,'Bill GATES',40,0),(73,'pathe',41,1),(74,'lamine',41,0),(75,'emmanuelle',41,0),(76,'pathe',42,1),(77,'lamine',42,0),(78,'emmanuelle',42,0),(79,'pathe',43,1),(80,'lamine',43,0),(81,'emmanuelle',43,0),(82,'pathe',44,1),(83,'lamine',44,0),(84,'emmanuelle',44,0),(85,'pathe',45,1),(86,'lamine',45,0),(87,'emmanuelle',45,0);
/*!40000 ALTER TABLE `reponses` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-12-02 16:32:30
