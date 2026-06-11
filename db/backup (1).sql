CREATE DATABASE  IF NOT EXISTS `porto_alternativo` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `porto_alternativo`;
-- MySQL dump 10.13  Distrib 8.0.45, for macos15 (x86_64)
--
-- Host: localhost    Database: porto_alternativo
-- ------------------------------------------------------
-- Server version	9.7.0

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
SET @MYSQLDUMP_TEMP_LOG_BIN = @@SESSION.SQL_LOG_BIN;
SET @@SESSION.SQL_LOG_BIN= 0;

--
-- GTID state at the beginning of the backup 
--

SET @@GLOBAL.GTID_PURGED=/*!80000 '+'*/ '5e4c9702-3e26-11f1-ab16-d44e0c52765b:1-1768';

--
-- Table structure for table `categorias`
--

DROP TABLE IF EXISTS `categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categorias` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nome` (`nome`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias`
--

LOCK TABLES `categorias` WRITE;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` VALUES (1,'Associações Culturais'),(3,'Clubbing'),(2,'Salas de Concertos');
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `evento_categoria`
--

DROP TABLE IF EXISTS `evento_categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `evento_categoria` (
  `evento_id` int NOT NULL,
  `categoria_id` int NOT NULL,
  PRIMARY KEY (`evento_id`,`categoria_id`),
  KEY `categoria_id` (`categoria_id`),
  CONSTRAINT `evento_categoria_ibfk_1` FOREIGN KEY (`evento_id`) REFERENCES `eventos` (`id`) ON DELETE CASCADE,
  CONSTRAINT `evento_categoria_ibfk_2` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `evento_categoria`
--

LOCK TABLES `evento_categoria` WRITE;
/*!40000 ALTER TABLE `evento_categoria` DISABLE KEYS */;
INSERT INTO `evento_categoria` VALUES (3,1),(5,1),(7,1),(8,1),(9,1),(10,1),(13,1),(14,1),(1,2),(6,2),(11,2),(12,2),(2,3),(4,3),(15,3),(16,3);
/*!40000 ALTER TABLE `evento_categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `eventos`
--

DROP TABLE IF EXISTS `eventos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `eventos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `descricao` text COLLATE utf8mb4_unicode_ci,
  `imagem` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bilheteira` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `local_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `local_id` (`local_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `eventos_ibfk_1` FOREIGN KEY (`local_id`) REFERENCES `locais` (`id`) ON DELETE CASCADE,
  CONSTRAINT `eventos_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eventos`
--

LOCK TABLES `eventos` WRITE;
/*!40000 ALTER TABLE `eventos` DISABLE KEYS */;
INSERT INTO `eventos` VALUES (1,'Travo (Concerto)','2026-04-30','22:30:00','Apresentação do novo álbum da banda de Braga num dos palcos mais icónicos do Porto.','assets/images/eventos/travo-planob.avif','https://www.seetickets.com/pt/event/travo/plano-b/12345',7,NULL),(2,'Rival Consoles','2026-05-01','21:00:00','O produtor britânico traz a sua eletrónica orgânica à Sala Suggia.','assets/images/eventos/rival-consoles-cdm.webp','https://www.casadamusica.com/pt/agenda/rival-consoles',4,NULL),(3,'Microvolumes 4.82','2026-05-02','18:30:00','Performance de música experimental focada em pequenos sons e texturas acústicas.','assets/images/eventos/microvolumes-sonoscopia.png','https://sonoscopia.pt/',1,NULL),(4,'Hayes: Nørbak + Cravo','2026-05-02','23:55:00','A editora Hayes assume o túnel com techno de precisão.','assets/images/eventos/hayes-gare.webp','https://shotgun.live/pt-pt/venues/gare-porto',6,NULL),(5,'Parpar','2026-05-07','21:30:00','Explorações sonoras e texturas contemporâneas num concerto intimista.','assets/images/eventos/parpar-maushabitos.jpg','https://loja.maushabitos.com/',2,NULL),(6,'Calcutá','2026-05-15','21:30:00','Teresa Castro apresenta o novo trabalho num ambiente etéreo.','assets/images/eventos/calcuta-passos.jpg','https://www.bol.pt/',5,NULL),(7,'THISPAGE + QUERMESSE','2026-05-22','22:00:00','Concerto duplo focado em texturas instrumentais.','assets/images/eventos/thispage-rca.webp','https://www.espacoagra.pt/',3,NULL),(8,'Pedro Melo Alves','2026-05-07','18:45:00','Projeto entre música urbana e experimental.','assets/images/eventos/pedro-melo-alves-lovers.avif','https://dice.fm/',2,NULL),(9,'José Venditti','2026-05-07','22:00:00','Concerto com imagens ao vivo.','assets/images/eventos/jose-venditti-rca.jpg','https://www.bol.pt/',3,NULL),(10,'Nuno Campos + José Pedro Coelho','2026-05-05','21:00:00','Jazz de vanguarda e improvisação.','assets/images/eventos/nuno-campos-maus-habitos.webp','https://www.maushabitos.com/',2,NULL),(11,'Steve Gunn','2026-05-08','22:30:00','Guitarrista norte-americano em concerto intimista.','assets/images/eventos/steve-gunn-understage.avif','https://www.teatromunicipaldoporto.pt/',4,NULL),(12,'Non Talkers','2026-05-08','21:30:00','Indie folk europeu no Coliseu.','assets/images/eventos/non-talkers-coliseu-ageas.webp','https://www.coliseu.pt/',5,NULL),(13,'Conna Haraway + Aires','2026-05-09','22:00:00','DJ set experimental e ambient.','assets/images/eventos/conna-haraway-rca.avif','https://rcaporto.bol.pt/',3,NULL),(14,'APUROS #15','2026-05-09','16:00:00','Programa de rádio ao vivo e música experimental.','assets/images/eventos/apuros-lovers.avif','https://dice.fm/',2,NULL),(15,'2.º Aniversário Time Out Market','2026-05-09','15:00:00','Festa com música non-stop e gastronomia.','assets/images/eventos/aniversario-timeout-market.webp','https://www.timeout.com/',3,NULL),(16,'Shelter Clubbing','2026-05-09','23:59:00','Clubbing noturno no Porto.','assets/images/eventos/shelter-clubbing.avif','https://www.agenda-porto.pt/',3,NULL);
/*!40000 ALTER TABLE `eventos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `locais`
--

DROP TABLE IF EXISTS `locais`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `locais` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `morada` text COLLATE utf8mb4_unicode_ci,
  `imagem` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descricao` text COLLATE utf8mb4_unicode_ci,
  `site` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coordenadas` text COLLATE utf8mb4_unicode_ci,
  `user_id` int DEFAULT NULL,
  `category_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `fk_locais_categoria` (`category_id`),
  CONSTRAINT `fk_locais_categoria` FOREIGN KEY (`category_id`) REFERENCES `categorias` (`id`),
  CONSTRAINT `locais_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `locais`
--

LOCK TABLES `locais` WRITE;
/*!40000 ALTER TABLE `locais` DISABLE KEYS */;
INSERT INTO `locais` VALUES (1,'Sonoscopia','Rua de Silva Porto 217, 4250-469 Porto, Portugal','assets/images/locais/associacoes-culturais/sonoscopia.jpg','Associação focada na criação, investigação e promoção de música experimental e arte sonora.','https://sonoscopia.pt/','https://www.google.com/maps/embed?...',NULL,1),(2,'Lovers & Lollypops','Rua de S. Victor 143A, 4000-515 Porto, Portugal','assets/images/locais/associacoes-culturais/lovers-lollypop.jpg','Editora e promotora cultural independente.','https://www.loversandlollypops.net/','https://www.google.com/maps/embed?...',NULL,1),(3,'Apuro','Rua dos Mártires da Liberdade 308 3º, 4050-359 Porto, Portugal','assets/images/locais/associacoes-culturais/apuro.jpg','Associação cultural e filantrópica.','https://www.apuro.pt/','https://www.google.com/maps/embed?...',NULL,1),(4,'Casa da Música','Avenida da Boavista 604, Porto','assets/images/locais/salas-concertos/casa-da-musica.jpg','Sala de concertos de referência nacional.','https://www.casadamusica.com/','https://www.google.com/maps/embed?...',NULL,2),(5,'Coliseu do Porto AGEAS','Rua de Passos Manuel 137, Porto','assets/images/locais/salas-concertos/coliseu-porto-ageas.jpg','Sala histórica de espetáculos.','https://www.coliseu.pt/','https://www.google.com/maps/embed?...',NULL,2),(6,'Hard Club','Praça do Infante D. Henrique, Porto','assets/images/locais/salas-concertos/hard-club.jpg','Sala de concertos e clubbing.','https://www.hardclubporto.com/','https://www.google.com/maps/embed?...',NULL,3),(7,'Plano B','Rua de Cândido dos Reis 30, Porto','assets/images/locais/clubbing/plano-b.jpg','Clube noturno e espaço cultural.','https://planobporto.net/','https://www.google.com/maps/embed?...',NULL,3),(8,'Pérola Negra','Rua de Gonçalo Cristóvão 284, Porto','assets/images/locais/clubbing/perola-negra.jpg','Clube noturno.','https://www.instagram.com/perolanegraporto/','https://www.google.com/maps/embed?...',NULL,3);
/*!40000 ALTER TABLE `locais` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','admin@admin.com','$2y$10$wWmbUEciot1oGncSsKWMyuAD5O3kL9cqGGObRRZ.qfFuya5nJvgQO','2026-06-10 19:52:45');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
SET @@SESSION.SQL_LOG_BIN = @MYSQLDUMP_TEMP_LOG_BIN;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-06-11  1:17:34
