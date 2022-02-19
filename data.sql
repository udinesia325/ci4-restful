-- MariaDB dump 10.19  Distrib 10.6.4-MariaDB, for Android (aarch64)
--
-- Host: localhost    Database: bani_yas
-- ------------------------------------------------------
-- Server version	10.6.4-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `login`
--
CREATE DATABASE `bani_yas`;

DROP TABLE IF EXISTS `login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `login` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login`
--

LOCK TABLES `login` WRITE;
/*!40000 ALTER TABLE `login` DISABLE KEYS */;
INSERT INTO `login` VALUES (1,'admin','admin','21232f297a57a5a743894a0e4a801fc3','admin','logout');
/*!40000 ALTER TABLE `login` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `place`
--

DROP TABLE IF EXISTS `place`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `place` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `latitude` int(11) NOT NULL,
  `longitude` int(11) NOT NULL,
  `x` int(11) NOT NULL,
  `y` int(11) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `place`
--

LOCK TABLES `place` WRITE;
/*!40000 ALTER TABLE `place` DISABLE KEYS */;
INSERT INTO `place` VALUES (6,'London',92728227,6272277,766,155,'burj.jpg','new York city'),(7,'London',92728227,6272277,766,155,'burj.jpg','new York city'),(8,'Borobudur',92728,627216,7671,1558,'borobudur.jpg','candi situs keajaiban dunia');
/*!40000 ALTER TABLE `place` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `schedule`
--

DROP TABLE IF EXISTS `schedule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `schedule` (
  `id_schedule` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(25) NOT NULL,
  `line` int(11) DEFAULT NULL,
  `from_place_id` int(11) NOT NULL,
  `to_place_id` int(11) NOT NULL,
  `departure_time` time DEFAULT NULL,
  `arrival_time` time NOT NULL,
  `distance` int(11) NOT NULL,
  `speed` int(11) NOT NULL,
  PRIMARY KEY (`id_schedule`),
  KEY `from_place_id` (`from_place_id`),
  KEY `to_place_id` (`to_place_id`),
  CONSTRAINT `fk_from_place` FOREIGN KEY (`from_place_id`) REFERENCES `place` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_to_place` FOREIGN KEY (`to_place_id`) REFERENCES `place` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `schedule`
--

LOCK TABLES `schedule` WRITE;
/*!40000 ALTER TABLE `schedule` DISABLE KEYS */;
INSERT INTO `schedule` VALUES (3,'bus',3,6,8,'13:40:00','13:50:00',90,70),(4,'bus',3,8,6,'13:40:00','15:10:00',70,60);
/*!40000 ALTER TABLE `schedule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `selection`
--

DROP TABLE IF EXISTS `selection`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `selection` (
  `id_selection` int(11) NOT NULL AUTO_INCREMENT,
  `from_place_id` int(11) NOT NULL,
  `to_place_id` int(11) NOT NULL,
  `id_schedule` int(11) NOT NULL,
  PRIMARY KEY (`id_selection`),
  KEY `from_place_id` (`from_place_id`),
  KEY `to_place_id` (`to_place_id`),
  KEY `id_schedule` (`id_schedule`),
  CONSTRAINT `fk_schedule_id` FOREIGN KEY (`id_schedule`) REFERENCES `schedule` (`id_schedule`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_selection_from_place` FOREIGN KEY (`from_place_id`) REFERENCES `place` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_selection_to_place` FOREIGN KEY (`to_place_id`) REFERENCES `place` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `selection`
--

LOCK TABLES `selection` WRITE;
/*!40000 ALTER TABLE `selection` DISABLE KEYS */;
INSERT INTO `selection` VALUES (1,8,6,4);
/*!40000 ALTER TABLE `selection` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-02-19 15:54:59
