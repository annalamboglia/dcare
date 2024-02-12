CREATE DATABASE  IF NOT EXISTS `dcare_db` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `dcare_db`;
-- MySQL dump 10.13  Distrib 8.0.26, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: dcare_db
-- ------------------------------------------------------
-- Server version	8.0.26

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `appuntamenti`
--

DROP TABLE IF EXISTS `appuntamenti`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `appuntamenti` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(15) DEFAULT NULL,
  `cognome` varchar(20) DEFAULT NULL,
  `note` varchar(100) DEFAULT NULL,
  `datatime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `immagini`
--

DROP TABLE IF EXISTS `immagini`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `immagini` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) DEFAULT NULL,
  `path` varchar(260) DEFAULT NULL,
  `data` date DEFAULT NULL,
  `schedaOrtodontica` int DEFAULT NULL,
  `schedaOdontoiatrica` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `schedaOrtodontica_fk_idx` (`schedaOrtodontica`),
  KEY `immaginiSchedeOdontoiatriche_fk_idx` (`schedaOdontoiatrica`),
  CONSTRAINT `immaginiSchedeOdontoiatriche_fk` FOREIGN KEY (`schedaOdontoiatrica`) REFERENCES `schedeodontoiatriche` (`id`) ON DELETE CASCADE,
  CONSTRAINT `immaginiSchedeOrtodontiche_fk` FOREIGN KEY (`schedaOrtodontica`) REFERENCES `schedeortodontiche` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `noteodontoiatriche`
--

DROP TABLE IF EXISTS `noteodontoiatriche`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `noteodontoiatriche` (
  `id` int NOT NULL AUTO_INCREMENT,
  `scheda` int DEFAULT NULL,
  `ed` varchar(2) DEFAULT NULL,
  `prestazione` int DEFAULT NULL,
  `note` tinytext,
  `stato` varchar(1) DEFAULT NULL,
  `data` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `schedaodontoiatrica_fk_idx` (`scheda`),
  KEY `trattamenti_fk_idx` (`prestazione`),
  CONSTRAINT `perstazione_fk` FOREIGN KEY (`prestazione`) REFERENCES `prestazioni` (`id`) ON DELETE SET NULL,
  CONSTRAINT `schedaodontoiatrica_fk` FOREIGN KEY (`scheda`) REFERENCES `schedeodontoiatriche` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `noteortodontiche`
--

DROP TABLE IF EXISTS `noteortodontiche`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `noteortodontiche` (
  `id` int NOT NULL AUTO_INCREMENT,
  `schedaOrtodontica` int DEFAULT NULL,
  `data` date DEFAULT NULL,
  `testo` tinytext,
  PRIMARY KEY (`id`),
  KEY `scheda_fkk_idx` (`schedaOrtodontica`),
  CONSTRAINT `scheda_fkk` FOREIGN KEY (`schedaOrtodontica`) REFERENCES `schedeortodontiche` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pagamenti`
--

DROP TABLE IF EXISTS `pagamenti`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pagamenti` (
  `id` int NOT NULL AUTO_INCREMENT,
  `data` date DEFAULT NULL,
  `importo` decimal(8,2) DEFAULT NULL,
  `nota` varchar(100) DEFAULT NULL,
  `schedaOrtodontica` int DEFAULT NULL COMMENT 'On delete set null per non perdere i pagamenti',
  `schedaOdontoiatrica` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `schedaOrtodontica_fk_idx` (`schedaOrtodontica`),
  KEY `pagamento_schedaOdontoiatrica_fk_idx` (`schedaOdontoiatrica`),
  CONSTRAINT `pagamento_schedaOdontoiatrica_fk` FOREIGN KEY (`schedaOdontoiatrica`) REFERENCES `schedeodontoiatriche` (`id`) ON DELETE SET NULL,
  CONSTRAINT `schedaOrtodontica_fk` FOREIGN KEY (`schedaOrtodontica`) REFERENCES `schedeortodontiche` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `paganti`
--

DROP TABLE IF EXISTS `paganti`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `paganti` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(15) DEFAULT NULL,
  `cognome` varchar(20) DEFAULT NULL,
  `sesso` varchar(1) DEFAULT NULL,
  `cittaNascita` varchar(20) DEFAULT NULL,
  `dataNascita` date DEFAULT NULL,
  `provinciaNascita` varchar(20) DEFAULT NULL,
  `residenza` varchar(45) DEFAULT NULL,
  `provincia` varchar(20) DEFAULT NULL,
  `cap` varchar(5) DEFAULT NULL,
  `prestazioni` varchar(35) DEFAULT NULL,
  `cf` varchar(16) DEFAULT NULL,
  `paziente` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pziente_fk_idx` (`paziente`),
  CONSTRAINT `pziente_fk` FOREIGN KEY (`paziente`) REFERENCES `pazienti` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pazienti`
--

DROP TABLE IF EXISTS `pazienti`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pazienti` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(15) DEFAULT NULL,
  `cognome` varchar(20) DEFAULT NULL,
  `dataNascita` date DEFAULT NULL,
  `residenza` varchar(45) DEFAULT NULL,
  `provincia` varchar(20) DEFAULT NULL,
  `cap` varchar(5) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `cellulare` varchar(15) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `cestino` binary(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `prestazioni`
--

DROP TABLE IF EXISTS `prestazioni`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `prestazioni` (
  `id` int NOT NULL AUTO_INCREMENT,
  `codice` varchar(10) DEFAULT NULL,
  `nome` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `prezzi`
--

DROP TABLE IF EXISTS `prezzi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `prezzi` (
  `id` int NOT NULL AUTO_INCREMENT,
  `prestazione` int DEFAULT NULL,
  `valore` decimal(6,2) DEFAULT NULL,
  `data` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `prezzi_trattamenti_fk_idx` (`prestazione`),
  CONSTRAINT `prezzi_prestazioni_fk` FOREIGN KEY (`prestazione`) REFERENCES `prestazioni` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `schedeodontoiatriche`
--

DROP TABLE IF EXISTS `schedeodontoiatriche`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `schedeodontoiatriche` (
  `id` int NOT NULL AUTO_INCREMENT,
  `paziente` int DEFAULT NULL,
  `dataApertura` date DEFAULT NULL,
  `dataUltimoAccesso` date DEFAULT NULL,
  `tipoPrestazione` varchar(50) DEFAULT NULL,
  `preventivo` decimal(8,2) DEFAULT NULL,
  `chiuso` binary(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `schedeodontoiatriche_pazienti_hk_idx` (`paziente`),
  CONSTRAINT `schedeodontoiatriche_pazienti_hk` FOREIGN KEY (`paziente`) REFERENCES `pazienti` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `schedeortodontiche`
--

DROP TABLE IF EXISTS `schedeortodontiche`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `schedeortodontiche` (
  `id` int NOT NULL AUTO_INCREMENT,
  `paziente` int DEFAULT NULL,
  `dataApertura` date DEFAULT NULL,
  `dataUltimoAccesso` date DEFAULT NULL,
  `tipoPrestazione` varchar(50) DEFAULT NULL,
  `preventivo` decimal(8,2) DEFAULT NULL,
  `notaProssimoAppuntamento` varchar(50) DEFAULT NULL,
  `dataProssimoAppuntamento` date DEFAULT NULL,
  `chiuso` binary(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `paziente_fk_idx` (`paziente`),
  CONSTRAINT `paziente_fk` FOREIGN KEY (`paziente`) REFERENCES `pazienti` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nickname` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` tinyint DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nickname_UNIQUE` (`nickname`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-03-31 22:32:02
