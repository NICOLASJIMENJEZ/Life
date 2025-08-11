-- MySQL dump 10.13  Distrib 8.0.40, for Win64 (x86_64)
--
-- Host: localhost    Database: life_gym
-- ------------------------------------------------------
-- Server version	8.4.3

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
-- Table structure for table `clases`
--

DROP TABLE IF EXISTS `clases`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `clases` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cliente` varchar(100) NOT NULL,
  `grupo` varchar(100) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `descripcion` text NOT NULL,
  `tiempo_descanso` varchar(50) NOT NULL,
  `video` text,
  `imagen1` varchar(255) DEFAULT NULL,
  `imagen2` varchar(255) DEFAULT NULL,
  `imagen3` varchar(255) DEFAULT NULL,
  `fecha_creacion` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clases`
--

LOCK TABLES `clases` WRITE;
/*!40000 ALTER TABLE `clases` DISABLE KEYS */;
INSERT INTO `clases` VALUES (1,'Nicolas','Torso','pecho completo','ssssssss','3 minutos','https://www.youtube.com/watch?v=91MpFsZI9VA&list=RD91MpFsZI9VA&start_radio=1','Captura de pantalla 2024-03-22 151951.png','','','2025-07-17'),(2,'carlos','Torso','pecho completo','ddddddd','3 minutos','https://www.youtube.com/watch?v=91MpFsZI9VA&list=RD91MpFsZI9VA&start_radio=1','Captura de pantalla 2024-03-22 151951.png','','','2025-07-17'),(3,'Nicolas','Torso','pecho completo','jpkj´jkój','3 minutos','https://www.youtube.com/watch?v=91MpFsZI9VA&list=RD91MpFsZI9VA&start_radio=1','111.png','','','2025-07-17'),(4,'sandra','Inferior','Pierna Completa','sentadilla 3x10\r\nhacka 4x15\r\nextenciones 3x10','3 minutos','https://www.youtube.com/watch?v=91MpFsZI9VA&list=RD91MpFsZI9VA&start_radio=1','','','','2025-07-17'),(5,'angela','Torso','Pierna Completa','sentadilla\r\nhack\r\nextenciones','3 minutos','https://www.youtube.com/watch?v=91MpFsZI9VA&list=RD91MpFsZI9VA&start_radio=1','','','','2025-07-22');
/*!40000 ALTER TABLE `clases` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contactos`
--

DROP TABLE IF EXISTS `contactos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contactos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mensaje` text NOT NULL,
  `fecha_envio` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contactos`
--

LOCK TABLES `contactos` WRITE;
/*!40000 ALTER TABLE `contactos` DISABLE KEYS */;
INSERT INTO `contactos` VALUES (1,'Nicolas','nicolasjimenezguzman1@gmail.com','holaa','2025-05-03 20:08:14'),(2,'jesus','jesus@email.com','hola','2025-05-03 21:39:07'),(3,'estebans','esteban@gmail.com','hola','2025-05-03 21:40:00'),(4,'daniela','daniela@gmail.com','hola','2025-05-03 21:41:50'),(5,'silvia','silvia@gmail.com','hola','2025-05-03 21:43:03'),(6,'andrea','andrrea@gmail.com','hola','2025-05-03 21:45:01'),(7,'jessica','jessica@gmail.com','hmjnxfnfs','2025-05-03 21:46:55'),(8,'luisa','luisa@gmail.com','hoila','2025-05-03 21:48:16'),(9,'luis','luis@gmail.com','hmjnxfnfs','2025-05-03 21:51:42'),(10,'daniielita','danni@gmail.com','hgolaa','2025-05-03 21:54:16'),(11,'jesus','esteban@gmail.com','hmjnxfnfs','2025-05-03 21:56:27'),(12,'Nicolas','nicolasjimenezguzman1@gmail.com','hmjnxfnfs','2025-05-03 22:01:40'),(13,'jose','jose@gmail.com','tytu','2025-05-04 00:12:24'),(14,'luis','luis@gmail.com','frfr','2025-05-06 16:07:07'),(15,'jesus','esteban@gmail.com','hola','2025-05-10 00:12:13'),(16,'jesus','esteban@gmail.com','tytu','2025-05-10 01:07:19'),(17,'Carlos Alberto','carlosestrada@gmail.com','hola me podrias regalar informacion sobre ubicacion y demas planes o personalizados','2025-05-12 15:52:39'),(18,'pepito andres','pepitoandres@gmail.com','Hola quiero mas informacion sobre planes y perzonalisados','2025-05-12 17:26:01'),(19,'pepito andres','pepitoandres@gmail.com','hola','2025-06-26 19:39:11'),(20,'pepito andres','pepitoandres@gmail.com','hola','2025-06-26 19:39:37'),(21,'Nicolas','nicolasjimenezguzman1@gmail.com','Hola buenas tarde quiero mas informacion sobre los planes','2025-06-26 21:53:56'),(22,'Nicolas','nicolasjimenezguzman1@gmail.com','hola quiero mas info','2025-07-17 01:05:23');
/*!40000 ALTER TABLE `contactos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pagos`
--

DROP TABLE IF EXISTS `pagos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pagos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cliente_id` int NOT NULL,
  `monto` decimal(10,2) NOT NULL,
  `metodo_pago` varchar(50) NOT NULL,
  `fecha_pago` datetime NOT NULL,
  `estado_pago` varchar(20) DEFAULT 'Pendiente',
  `plan_id` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pagos`
--

LOCK TABLES `pagos` WRITE;
/*!40000 ALTER TABLE `pagos` DISABLE KEYS */;
INSERT INTO `pagos` VALUES (1,1193228149,50000.00,'Pendiente','2025-05-10 01:48:34','En proceso',NULL),(2,1193228149,50000.00,'Pendiente','2025-05-10 03:06:55','En proceso',NULL),(3,1,50000.00,'Pendiente','2025-05-12 18:05:16','En proceso',NULL);
/*!40000 ALTER TABLE `pagos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `planes`
--

DROP TABLE IF EXISTS `planes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `planes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `descripcion` text NOT NULL,
  `precio` decimal(10,0) NOT NULL DEFAULT '70000',
  `duracion` int NOT NULL DEFAULT '30',
  `creado_en` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `planes`
--

LOCK TABLES `planes` WRITE;
/*!40000 ALTER TABLE `planes` DISABLE KEYS */;
INSERT INTO `planes` VALUES (1,'Plan Básico','Acceso a todos los servicios básicos del gimnasio. Incluye asesoramiento básico con instructores.',50000,30,'2025-05-09 23:11:14'),(2,'Plan Avanzado','Acceso a todos los servicios, asesoramiento con instructores y entrenamientos personalizados.',80000,45,'2025-05-09 23:11:14'),(3,'Plan Premium','Acceso completo a todos los servicios del gimnasio, asesoramiento, entrenamientos personalizados y acceso ilimitado a clases grupales.',120000,60,'2025-05-09 23:11:14');
/*!40000 ALTER TABLE `planes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reportes`
--

DROP TABLE IF EXISTS `reportes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reportes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `peso` decimal(5,2) DEFAULT NULL,
  `estatura` decimal(4,2) DEFAULT NULL,
  `edad` int DEFAULT NULL,
  `carga_pecho` int DEFAULT NULL,
  `carga_sentadilla` int DEFAULT NULL,
  `carga_biceps` int DEFAULT NULL,
  `carga_triceps` int DEFAULT NULL,
  `carga_hombro` int DEFAULT NULL,
  `fecha_reporte` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reportes`
--

LOCK TABLES `reportes` WRITE;
/*!40000 ALTER TABLE `reportes` DISABLE KEYS */;
INSERT INTO `reportes` VALUES (8,'carlos',80.00,1.69,45,45,20,10,10,20,'2025-07-16 20:05:42'),(9,'carlos',80.00,1.69,45,45,20,10,10,20,'2025-07-16 20:08:07'),(10,'carlos',80.00,1.69,45,45,20,10,10,20,'2025-07-16 20:10:27'),(11,'carlos',85.00,1.69,45,50,90,20,50,30,'2025-07-16 20:16:07'),(12,'carlos',85.00,1.69,45,50,90,20,50,30,'2025-07-16 20:20:39'),(13,'daniel',90.00,1.90,20,50,10,10,50,90,'2025-07-16 20:27:03'),(14,'daniel',80.00,1.90,20,60,20,20,100,90,'2025-07-16 20:27:38'),(15,'Sandra',70.00,1.68,48,10,10,10,10,10,'2025-07-17 01:03:50'),(16,'Sandra',60.00,1.68,48,20,20,20,20,20,'2025-07-17 01:04:37'),(17,'angela',60.00,1.67,25,20,20,20,20,20,'2025-07-22 19:24:39'),(18,'angela',50.00,1.67,25,25,25,25,25,20,'2025-07-22 19:24:57');
/*!40000 ALTER TABLE `reportes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'usuario'),(2,'administrador');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `telefono` varchar(50) NOT NULL,
  `fechaNacimiento` date DEFAULT NULL,
  `identificacion` bigint NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fecha_registro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `rol_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `identificacion` (`identificacion`),
  UNIQUE KEY `email` (`email`),
  KEY `fk_usuarios_roles` (`rol_id`),
  CONSTRAINT `fk_usuarios_roles` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (43,'andres','estrada','32145678921','2002-07-20',1236548789,'andres@gmail.com','$2y$10$/UYCCzNSrVLQ1GX1XsryF.6.s3052359KToedTZssfQ1JkbzinumG','2025-06-26 21:38:29',2),(44,'Nicolas','Jimenez','3168771073','2002-07-20',1193228149,'nicolasjimenezguzman1@gmail.com','$2y$10$wVZ6gK7wFzPUJ9aH1C2UvuZUdcgJ3BCWfciO.kT.wH1KU5bwAQMnS','2025-06-26 21:57:30',2),(45,'carlota','jimenez','325645987','2002-07-20',1236547889,'carlota@gmail.com','$2y$10$P80lm2MOvvT0FbBTSqGdAO/8Z0VZDMltdt0WS7gOo.4Wl/9AGlrcu','2025-07-08 18:40:20',1),(46,'sandra Elizabeth','Guzman ','3174910020','1977-02-20',36753350,'sandraguzman@gmail.com','$2y$10$Ms5FjdHxU2MBtJnP4/OCremFgYCh/vXTBoXbDpYJAuJ/X.V9D3VN2','2025-07-16 22:17:16',1),(47,'angela yovanna','jimenez guzman ','3225840242','2000-11-10',1004214601,'angela@gmail.com','$2y$10$9bKKUN9a5KFFTMcDnkdo2uBF6b9GDZZqrJ.Wv.bVL7tGeEAvRFpHu','2025-07-22 19:21:42',1);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-07-23 16:34:23