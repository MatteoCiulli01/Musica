-- MySQL dump 10.13  Distrib 8.0.17, for Win64 (x86_64)
--
-- Host: localhost    Database: ideeinbi_musica
-- ------------------------------------------------------
-- Server version	8.0.17

create schema if not exists ideeinbi_musica;
use ideeinbi_musica;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `album`
--

DROP TABLE IF EXISTS `album`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `album` (
  `id_album` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(500) DEFAULT NULL,
  `genere` varchar(20) DEFAULT NULL,
  `anno` year(4) DEFAULT NULL,
  `url_cover` varchar(500) DEFAULT NULL,
  `cod_artista` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_album`),
  KEY `cod_artista` (`cod_artista`),
  CONSTRAINT `Album_ibfk_1` FOREIGN KEY (`cod_artista`) REFERENCES `artisti` (`id_artista`)
  ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `album`
--

LOCK TABLES `album` WRITE;
/*!40000 ALTER TABLE `album` DISABLE KEYS */;
INSERT INTO `album` VALUES (1,'test','pino',1980,'urlcover',1),(2,'test','gino',1990,'urlcover',2),(3,'test','dino',2000,'urlcover',3),(4,'L\'Album','Musica',2020,'img/album/l_album-Mauro_Lapio.png',4),(5,'Cheaptunes','Chiptune',2020,'img/album/cheaptunes-Riccardo_Degli_Esposti.png',5);
/*!40000 ALTER TABLE `album` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `artisti`
--

DROP TABLE IF EXISTS `artisti`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `artisti` (
  `id_artista` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(500) DEFAULT NULL,
  `anno` year(4) DEFAULT NULL,
  `descrizione` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id_artista`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `artisti`
--

LOCK TABLES `artisti` WRITE;
/*!40000 ALTER TABLE `artisti` DISABLE KEYS */;
INSERT INTO `artisti` VALUES (1,'bruh',1980,'cbt'),(2,'moment',1990,'deeznuts'),(3,'test',2020,'test'),(4,'Mauro Lapio',2001,'persona esistente sulla Terra.'),(5,'Riccardo Degli Esposti',2001,'<- Non aveva niente da fare');
/*!40000 ALTER TABLE `artisti` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `canzone_artista`
--

DROP TABLE IF EXISTS `canzone_artista`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `canzone_artista` (
  `id_canzoneartista` int(11) NOT NULL AUTO_INCREMENT,
  `cod_canzone` int(11) DEFAULT NULL,
  `cod_artista` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_canzoneartista`),
  KEY `cod_canzone` (`cod_canzone`),
  KEY `cod_artista` (`cod_artista`),
  CONSTRAINT `canzone_artista_ibfk_1` FOREIGN KEY (`cod_canzone`) REFERENCES `canzoni` (`id_canzone`),
  CONSTRAINT `canzone_artista_ibfk_2` FOREIGN KEY (`cod_artista`) REFERENCES `artisti` (`id_artista`)
  ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `canzone_artista`
--

LOCK TABLES `canzone_artista` WRITE;
/*!40000 ALTER TABLE `canzone_artista` DISABLE KEYS */;
INSERT INTO `canzone_artista` VALUES (1,1,4),(2,2,4),(3,3,4),(4,4,5),(5,5,4);
/*!40000 ALTER TABLE `canzone_artista` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `canzoni`
--

DROP TABLE IF EXISTS `canzoni`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `canzoni` (
  `id_canzone` int(11) NOT NULL AUTO_INCREMENT,
  `titolo` varchar(500) DEFAULT NULL,
  `durata` int(11) DEFAULT NULL,
  `genere` varchar(20) DEFAULT NULL,
  `anno` year(4) DEFAULT NULL,
  `url_canzone` varchar(500) DEFAULT NULL,
  `cod_album` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_canzone`),
  KEY `cod_album` (`cod_album`),
  CONSTRAINT `Canzoni_ibfk_1` FOREIGN KEY (`cod_album`) REFERENCES `album` (`id_album`)
  ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `canzoni`
--

LOCK TABLES `canzoni` WRITE;
/*!40000 ALTER TABLE `canzoni` DISABLE KEYS */;
INSERT INTO `canzoni` VALUES (1,'Gianna',10,'Folk epico',2020,'./songs/Gianna-Mauro_Lapio.mp3',4),(2,'Eruption',10,'Metal bello',2020,'./songs/Eruption-Mauro_Lapio.mp3',4),(3,'I Don\'t Wanna Miss a Thing',10,'Classic Rock',1998,'./songs/I_Dont_Wanna_Miss_A_Thing-Mauro_Lapio.mp3',4),(4,'8bit-tella',71,'Chiptune',2020,'./songs/8Bit_tella-Riccardo_Degli_Esposti.mp3',5),(5,'Generic 80s Rock',10,'Rock base anni \'80', 2020, './songs/Generic_80s_Rock-Mauro_Lapio.mp3',4);
/*!40000 ALTER TABLE `canzoni` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `credenziali`
--

DROP TABLE IF EXISTS `credenziali`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `credenziali` (
  `id_credenziali` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(64) NOT NULL,
  `password` varchar(128) NOT NULL,
  PRIMARY KEY (`id_credenziali`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `credenziali`
--

LOCK TABLES `credenziali` WRITE;
/*!40000 ALTER TABLE `credenziali` DISABLE KEYS */;
INSERT INTO `credenziali` VALUES (1,'admin','e908b9df1e4e4a7eea57c782277d2bea'),(2,'lezzo','a8f5f167f44f4964e6c998dee827110c');
/*!40000 ALTER TABLE `credenziali` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `utenti`
--

DROP TABLE IF EXISTS `utenti`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `utenti` (
  `id_utente` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `sesso` varchar(20) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  `cod_credenziali` int(11) NOT NULL,
  PRIMARY KEY (`id_utente`),
  KEY `cod_credenziali` (`cod_credenziali`),
  CONSTRAINT `Utenti_ibfk_1` FOREIGN KEY (`cod_credenziali`) REFERENCES `credenziali` (`id_credenziali`)
  ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `utenti`
--

LOCK TABLES `utenti` WRITE;
/*!40000 ALTER TABLE `utenti` DISABLE KEYS */;
INSERT INTO `utenti` VALUES (1,'admin@admin','admin',1,1),(2,'ciao@ciao','male',0,2);
/*!40000 ALTER TABLE `utenti` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-05-05 12:51:14