-- MySQL dump 10.13  Distrib 8.0.33, for Win64 (x86_64)
--
-- Host: localhost    Database: bienesraices_crud
-- ------------------------------------------------------
-- Server version	8.0.33

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
-- Table structure for table `propiedades`
--

DROP TABLE IF EXISTS `propiedades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `propiedades` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titulo` varchar(45) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `imagen` varchar(200) DEFAULT NULL,
  `descripcion` longtext,
  `habitaciones` int DEFAULT NULL,
  `wc` int DEFAULT NULL,
  `estacionamiento` int DEFAULT NULL,
  `creado` date DEFAULT NULL,
  `vendedores_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_propiedades_vendedores_idx` (`vendedores_id`),
  CONSTRAINT `fk_propiedades_vendedores` FOREIGN KEY (`vendedores_id`) REFERENCES `vendedores` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `propiedades`
--

LOCK TABLES `propiedades` WRITE;
/*!40000 ALTER TABLE `propiedades` DISABLE KEYS */;
INSERT INTO `propiedades` VALUES (3,'Casa en el bosque',10000.00,'7edbe4a889911e3ae191aa0cdd4481d9.jpg','Casa de la playaCasa de la playaCasa de la playaCasa de la playaCasa de la playaCasa de la playaCasa de la playaCasa de la playaCasa de la playaCasa de la playaCasa de la playaCasa de la playaCasa de la playaCasa de la playaCasa de la playaCasa de la playaCasa de la playaCasa de la playaCasa de la playaCasa de la playaCasa de la playa',5,5,5,'2023-05-04',1),(7,'Cabaña en el bosque',1500000.00,'6b94ab4acb1559c312685ac50780233a.jpg','Casa de la playaCasa de la playaCasa de la playaCasa de la playaCasa de la playaCasa de la playaCasa de la playaCasa de la playaCasa de la playaCasa de la playaCasa de la playaCasa de la playaCasa de la playaCasa de la playaCasa de la playaCasa de la playaCasa de la playaCasa de la playaCasa de la playaCasa de la playaCasa de la playa',3,3,3,'2023-05-04',1),(8,'Casa de la playa',120.00,'f63baaeccd5d1eb0e3c648603b97911c.jpg','Casa de la playaCasa de la playaCasa de la playaCasa de la playaCasa de la playaCasa de la playaCasa de la playaCasa de la playaCasa de la playaCasa de la playaCasa de la playaCasa de la playaCasa de la playaCasa de la playaCasa de la playaCasa de la playaCasa de la playaCasa de la playaCasa de la playaCasa de la playaCasa de la playa',3,2,1,'2023-05-06',1),(9,'Cabaña en el bosque',120000.00,'d5e855d5dfbef5e6b70fe7de4a5ddc11.jpg','Cabaña en el bosqueCabaña en el bosqueCabaña en el bosqueCabaña en el bosqueCabaña en el bosqueCabaña en el bosqueCabaña en el bosqueCabaña en el bosqueCabaña en el bosqueCabaña en el bosqueCabaña en el bosqueCabaña en el bosqueCabaña en el bosqueCabaña en el bosqueCabaña en el bosqueCabaña en el bosque',3,3,3,'2023-05-06',1),(10,'Casa normal',450000.00,'530fad86989a81a5d091ada36e9529ae.jpg','Casa de la playaCasa de la playaCasa de la playaCasa de la playaCasa de la playaCasa de la playaCasa de la playaCasa de la playaCasa de la playaCasa de la playaCasa de la playaCasa de la playaCasa de la playaCasa de la playaCasa de la playaCasa de la playaCasa de la playaCasa de la playaCasa de la playaCasa de la playaCasa de la playa',3,3,3,'2023-05-06',2),(11,'Casa elegante',500000.00,'3ca6a1a685b20595fca6acb5226223ae.jpg','Casa de la playaCasa de la playaCasa de la playaCasa de la playaCasa de la playaCasa de la playaCasa de la playaCasa de la playaCasa de la playaCasa de la playaCasa de la playaCasa de la playaCasa de la playaCasa de la playaCasa de la playaCasa de la playaCasa de la playaCasa de la playaCasa de la playaCasa de la playaCasa de la playa',3,3,3,'2023-05-06',2),(22,'Hermosa casa en la playa',100.00,'6ace2b8827ba61266e5dcd06e2a75801.jpg','Hermosa casa en la playaHermosa casa en la playaHermosa casa en la playaHermosa casa en la playaHermosa casa en la playa',2,2,5,'2023-05-10',1),(29,'Casa de la montaña',2.00,'b3a1539fd3988c2240a52f72a2995ae5.jpg','Casa prueba(ActuSQLCasa prueba(ActuSQLCasa prueba(ActuSQLCasa prueba(ActuSQLCasa prueba(ActuSQL',1,1,1,'2023-05-13',1);
/*!40000 ALTER TABLE `propiedades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(45) DEFAULT NULL,
  `password` char(60) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (2,'correo@correo.com','$2y$10$ZGmBopAxEYtFZc9UWE4yye82PxMeeg1zEuCEIDosLtG4W0yIbDmny');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vendedores`
--

DROP TABLE IF EXISTS `vendedores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vendedores` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `apellido` varchar(45) DEFAULT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vendedores`
--

LOCK TABLES `vendedores` WRITE;
/*!40000 ALTER TABLE `vendedores` DISABLE KEYS */;
INSERT INTO `vendedores` VALUES (1,'Fernando','Joachin','9995683452'),(2,'Roberto','Castillo','9993459761'),(4,'Franco','Gonzalez','9998697542');
/*!40000 ALTER TABLE `vendedores` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-05-13  4:26:49
