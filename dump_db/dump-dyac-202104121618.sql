-- MySQL dump 10.17  Distrib 10.3.25-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: 172.16.1.73    Database: dyac
-- ------------------------------------------------------
-- Server version	10.3.27-MariaDB

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
-- Table structure for table `archivo`
--

DROP TABLE IF EXISTS `archivo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `archivo` (
  `arc_id` int(11) NOT NULL AUTO_INCREMENT,
  `arc_descripcion` varchar(1000) NOT NULL,
  `arc_archivo` varchar(2000) NOT NULL,
  `arc_tipo` varchar(25) NOT NULL,
  `col_id` int(11) DEFAULT NULL,
  `tar_id` int(11) DEFAULT NULL,
  `pai_id` int(11) DEFAULT NULL,
  `arc_ubicacion` varchar(500) NOT NULL,
  `gen_id` int(11) DEFAULT NULL,
  `arc_cita` varchar(500) NOT NULL,
  `idi_id` int(11) DEFAULT NULL,
  `der_id` int(11) DEFAULT NULL,
  `arc_estadoarc` varchar(1) NOT NULL,
  `arc_estado` varchar(1) NOT NULL,
  `arc_fechaCreacion` datetime NOT NULL,
  `arc_fechaAudit` datetime NOT NULL,
  `arc_accion` varchar(1) NOT NULL,
  `arc_enlace` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`arc_id`),
  KEY `col_id` (`col_id`),
  KEY `tar_id` (`tar_id`),
  KEY `pai_id` (`pai_id`),
  KEY `gen_id` (`gen_id`),
  KEY `idi_id` (`idi_id`),
  KEY `der_id` (`der_id`),
  CONSTRAINT `archivo_ibfk_1` FOREIGN KEY (`col_id`) REFERENCES `coleccion` (`col_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `archivo_ibfk_2` FOREIGN KEY (`tar_id`) REFERENCES `tipo_archivo` (`tar_id`) ON DELETE SET NULL,
  CONSTRAINT `archivo_ibfk_3` FOREIGN KEY (`pai_id`) REFERENCES `pais` (`pai_id`) ON DELETE SET NULL,
  CONSTRAINT `archivo_ibfk_4` FOREIGN KEY (`gen_id`) REFERENCES `genero` (`gen_id`) ON DELETE SET NULL,
  CONSTRAINT `archivo_ibfk_5` FOREIGN KEY (`idi_id`) REFERENCES `idioma` (`idi_id`) ON DELETE SET NULL,
  CONSTRAINT `archivo_ibfk_6` FOREIGN KEY (`der_id`) REFERENCES `derecho` (`der_id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `archivo`
--

LOCK TABLES `archivo` WRITE;
/*!40000 ALTER TABLE `archivo` DISABLE KEYS */;
INSERT INTO `archivo` VALUES (27,'Audio de la canción','b938ebba5575004ba8966cacae31a5fe (1)2.jpg','Imagen',46,1,216,'Cuenca',1,'Cita del archivo',2,1,'A','N','2020-11-20 22:30:01','2020-11-21 14:34:48','M',0),(28,'bitacora','Ficha3.xlsx','Otro',46,4,114,'Cuenca',3,'cita',1,1,'A','N','2020-11-21 14:35:41','2020-11-22 12:40:51','M',0),(29,'beat','beat (2)3.mp3','Audio',46,2,114,'Cuenca',1,'qqq',1,1,'A','N','2020-11-22 13:39:59','2020-11-22 15:55:23','M',0),(31,'vvvv','VID-20191214-WA00015.mp4','Video',46,3,114,'Cuenca',2,'kkk',5,1,'A','N','2020-11-22 13:44:47','2021-04-09 16:55:47','M',0),(32,'lll','New Project 16.zip','Otro',46,5,114,'Cuenca',1,'JJJJJ',1,1,'P','N','2020-11-22 13:46:05','2021-02-10 12:50:35','M',0),(42,'sda','https://www.youtube.com/watch?v=STBLhpZUNnY','Url',52,3,18,'Youtube',1,'dsaxcvxv',2,1,'P','N','2021-02-25 23:16:28','2021-03-10 00:47:45','M',1),(43,'tesis','https://site.inali.gob.mx/pdf/DOCUMENTACION_LINGUISTICA.pdf','Url',54,5,216,'Cuenca, UDA',2,'cita',1,1,'A','N','2021-03-02 13:24:47','2021-03-02 13:36:55','M',1),(44,'tesis','flas 2 hsd12.mp3','Audio',54,2,216,'Cuenca, UDA',2,'cita',1,2,'A','N','2021-03-02 13:26:46','2021-03-02 13:36:32','M',0),(45,'Documentos en pdf','COMPROBANTE 202115.pdf','PDF',52,4,216,'Local',3,'Preguntas de ejemplo',2,1,'P','N','2021-03-09 23:15:37','2021-03-10 19:09:56','M',0),(46,'Ejemplo de imagen','VIDEO DE INSTALACION.wmv_snapshot_07.5514.jpg','Imagen',52,1,71,'Local',3,'dfsfs',2,1,'P','N','2021-03-09 23:42:45','2021-03-09 23:42:45','N',0),(47,'Ejemplo','A_01_logotipo_uda_015.zip','Otro',52,5,216,'Local',3,'dfdfd',2,1,'P','N','2021-03-09 23:53:07','2021-03-09 23:53:07','N',0),(49,'assas','musica-para-documentales-de-naturaleza15.mp3','Audio',52,2,216,'Local',2,'eeeeee',2,1,'P','N','2021-03-10 00:55:22','2021-03-12 00:40:33','M',0),(50,'esta buena','https://www.youtube.com/watch?v=ZGy7AK0RnbI','Url',56,11,216,'donde siempre',3,'no hay el texto',2,1,'A','N','2021-03-28 00:41:45','2021-03-28 18:48:29','M',1),(51,'hdfjdhir','_FREE Indie Pop x Alternative R&B Type Beat Sweet Memories (prod. by wavytrbl)_160k14.mp3','Audio',56,11,2,'jhdrjofjger',2,'kjruitjie5rkgojety',1,1,'A','N','2021-03-28 00:46:56','2021-03-28 00:48:57','M',0),(52,'Contaminantes','https://www.scielosp.org/article/resp/1999.v73n2/123-132/es/','Url',57,9,216,'Cuenca',1,'Citas',2,2,'A','N','2021-04-09 16:26:36','2021-04-09 16:30:18','M',0),(53,'Descripcion de video','https://www.youtube.com/watch?v=1bGOgY1CmiU','Url',57,3,55,'Indiana',3,'Cita del video ',1,1,'A','N','2021-04-09 16:33:19','2021-04-09 16:34:06','M',1);
/*!40000 ALTER TABLE `archivo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `archivo_atributoex`
--

DROP TABLE IF EXISTS `archivo_atributoex`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `archivo_atributoex` (
  `aae_id` int(11) NOT NULL AUTO_INCREMENT,
  `aex_id` int(11) DEFAULT NULL,
  `tar_id` int(11) DEFAULT NULL,
  `aae_estado` varchar(1) NOT NULL,
  `aae_fechaCreacion` datetime NOT NULL,
  `aae_fechaAudit` datetime NOT NULL,
  `aae_accion` varchar(1) NOT NULL,
  PRIMARY KEY (`aae_id`),
  KEY `aex_id` (`aex_id`),
  KEY `tar_id` (`tar_id`),
  CONSTRAINT `archivo_atributoex_ibfk_1` FOREIGN KEY (`aex_id`) REFERENCES `atributo_extra` (`aex_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `archivo_atributoex_ibfk_2` FOREIGN KEY (`tar_id`) REFERENCES `tipo_archivo` (`tar_id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `archivo_atributoex`
--

LOCK TABLES `archivo_atributoex` WRITE;
/*!40000 ALTER TABLE `archivo_atributoex` DISABLE KEYS */;
INSERT INTO `archivo_atributoex` VALUES (10,5,4,'N','2020-11-20 22:27:10','2020-11-20 22:27:10','N'),(11,6,4,'N','2020-11-20 22:27:10','2020-11-20 22:27:10','N'),(12,7,4,'N','2020-11-20 22:27:10','2020-11-20 22:27:10','N'),(13,5,5,'N','2020-11-20 22:27:38','2020-11-20 22:27:38','N'),(14,6,5,'N','2020-11-20 22:27:38','2020-11-20 22:27:38','N'),(28,3,3,'N','2021-02-23 01:09:14','2021-02-23 01:09:14','M'),(29,4,3,'N','2021-02-23 01:09:14','2021-02-23 01:09:14','M'),(30,5,3,'N','2021-02-23 01:09:14','2021-02-23 01:09:14','M'),(31,6,3,'N','2021-02-23 01:09:14','2021-02-23 01:09:14','M'),(32,7,3,'N','2021-02-23 01:09:14','2021-02-23 01:09:14','M'),(33,8,3,'N','2021-02-23 01:09:14','2021-02-23 01:09:14','M'),(34,10,3,'N','2021-02-23 01:09:14','2021-02-23 01:09:14','M'),(35,11,3,'N','2021-02-23 01:09:14','2021-02-23 01:09:14','M'),(54,3,2,'N','2021-02-25 23:32:46','2021-02-25 23:32:46','M'),(55,6,2,'N','2021-02-25 23:32:46','2021-02-25 23:32:46','M'),(56,3,NULL,'N','2021-03-02 13:54:51','2021-03-02 13:54:51','M'),(57,5,NULL,'N','2021-03-02 13:57:54','2021-03-02 13:57:54','N'),(60,7,9,'N','2021-03-12 22:24:21','2021-03-12 22:24:21','M'),(61,8,9,'N','2021-03-12 22:24:21','2021-03-12 22:24:21','M'),(62,11,9,'N','2021-03-12 22:24:21','2021-03-12 22:24:21','M'),(63,3,11,'N','2021-03-28 00:32:47','2021-03-28 00:32:47','N'),(64,5,11,'N','2021-03-28 00:32:47','2021-03-28 00:32:47','N'),(65,8,11,'N','2021-03-28 00:32:47','2021-03-28 00:32:47','N'),(66,4,1,'N','2021-04-09 12:23:53','2021-04-09 12:23:53','M'),(67,5,1,'N','2021-04-09 12:23:53','2021-04-09 12:23:53','M'),(68,6,1,'N','2021-04-09 12:23:53','2021-04-09 12:23:53','M');
/*!40000 ALTER TABLE `archivo_atributoex` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `atributo_extra`
--

DROP TABLE IF EXISTS `atributo_extra`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `atributo_extra` (
  `aex_id` int(11) NOT NULL AUTO_INCREMENT,
  `aex_nombre` varchar(30) NOT NULL,
  `aex_tipo` enum('Colección','Archivo') NOT NULL,
  `aex_descripcion` varchar(250) NOT NULL,
  `aex_estado` varchar(1) NOT NULL,
  `aex_fechaCreacion` datetime NOT NULL,
  `aex_fechaAudit` datetime NOT NULL,
  `aex_accion` varchar(1) NOT NULL,
  PRIMARY KEY (`aex_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `atributo_extra`
--

LOCK TABLES `atributo_extra` WRITE;
/*!40000 ALTER TABLE `atributo_extra` DISABLE KEYS */;
INSERT INTO `atributo_extra` VALUES (1,'Colección Extra','Colección','Atributo extra para las colecciones','N','2020-11-10 22:10:43','2020-11-10 22:10:43','N'),(2,'Creado prueba','Colección','Archivo creado prueba 2','N','2020-11-10 23:11:35','2020-11-10 23:12:31','M'),(3,'Duración','Archivo','Duración del Audio/Video.','N','2020-11-20 22:23:35','2020-11-20 22:23:35','N'),(4,'Dimensiones','Archivo','Dimensiones de la imagen.','N','2020-11-20 22:24:03','2020-11-20 22:28:17','M'),(5,'Peso','Archivo','Peso del archivo.','N','2020-11-20 22:24:22','2020-11-20 22:24:22','N'),(6,'Doi','Archivo','Doi del documento.','N','2020-11-20 22:24:59','2020-11-20 22:24:59','N'),(7,'Número de hojas','Archivo','Número de hojas de la publicación.','N','2020-11-20 22:25:32','2020-11-20 22:28:14','M'),(8,'voces','Archivo','sssss','N','2021-02-10 17:13:06','2021-02-10 17:14:39','M'),(9,'haha','Colección','haha','N','2021-02-21 18:15:12','2021-02-21 18:15:24','M'),(10,'abc','Archivo','abc','N','2021-02-21 18:16:05','2021-02-21 18:16:05','N'),(11,'1234','Archivo','125','N','2021-02-21 18:16:31','2021-03-28 00:38:19','M'),(12,'casa','Archivo','casa','N','2021-02-21 18:22:59','2021-02-21 18:22:59','N'),(13,'5678','Colección','91011','N','2021-03-28 00:39:28','2021-03-28 00:39:28','N');
/*!40000 ALTER TABLE `atributo_extra` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coleccion`
--

DROP TABLE IF EXISTS `coleccion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `coleccion` (
  `col_id` int(11) NOT NULL AUTO_INCREMENT,
  `col_titulo` varchar(50) NOT NULL,
  `col_fechaPublicacion` date NOT NULL,
  `dis_id` int(11) DEFAULT NULL,
  `col_descripcion` varchar(4000) NOT NULL,
  `col_fuente` varchar(500) NOT NULL,
  `col_estadocol` varchar(1) NOT NULL,
  `col_portada` varchar(2000) NOT NULL,
  `inv_id` int(11) DEFAULT NULL,
  `col_estado` varchar(1) NOT NULL,
  `col_estadoAudit` varchar(1) NOT NULL,
  `col_fechaCreacion` datetime NOT NULL,
  `col_fechaAudit` datetime NOT NULL,
  `col_accion` varchar(1) NOT NULL,
  PRIMARY KEY (`col_id`),
  KEY `dis_id` (`dis_id`),
  KEY `inv_id` (`inv_id`),
  CONSTRAINT `coleccion_ibfk_1` FOREIGN KEY (`dis_id`) REFERENCES `disciplina` (`dis_id`) ON DELETE SET NULL,
  CONSTRAINT `coleccion_ibfk_2` FOREIGN KEY (`inv_id`) REFERENCES `investigador` (`inv_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coleccion`
--

LOCK TABLES `coleccion` WRITE;
/*!40000 ALTER TABLE `coleccion` DISABLE KEYS */;
INSERT INTO `coleccion` VALUES (44,'Coleccion 1','2020-11-04',2,'Descripción de la colección','Fuentes de la colección.','B','FB_IMG_1584029869898_Coleccion 1_1.jpg',4,'N','N','2020-11-15 13:30:12','2020-11-18 16:01:09','M'),(45,'Ejemplo 2','2020-11-19',2,'Descripción 2','No hay fuente','N','wallpapersden.com_minecraft-minimalist-pig_2560x1440_Ejemplo 2_2.jpg',4,'N','N','2020-11-15 13:32:57','2021-02-21 18:08:01','M'),(46,'Coleccion Ejemplo','2020-11-04',4,'Su descripción aquí','Fuente de la coleccion','A','FB_IMG_1584029871719_Coleccion Ejemplo_3.jpg',4,'N','N','2020-11-17 08:18:43','2021-04-08 22:35:19','M'),(47,'Pendiente 2','2020-11-19',2,'1','543','N','28810557_1953284044713046_992072386_o_Pendiente_4.jpg',4,'N','N','2020-11-18 16:00:06','2021-02-21 18:06:51','M'),(51,'Colección de ejemplo','2021-02-10',1,'....','Fuente de la colección','A','coleccion_anonimo.jpg',4,'N','N','2021-02-10 12:43:29','2021-03-28 00:20:13','M'),(52,'Inteligencia Artificial','2021-02-24',5,'La Inteligencia artificial es el campo científico de la informática que se centra en la creación de programas y mecanismos que pueden mostrar comportamientos considerados inteligentes. En otras palabras, la IA es el concepto según el cual “las máquinas piensan como seres humanos”.\r\n\r\nNormalmente, un sistema de IA es capaz de analizar datos en grandes cantidades (big data), identificar patrones y tendencias y, por lo tanto, formular predicciones de forma automática, con rapidez y precisión. Para nosotros, lo importante es que la IA permite que nuestras experiencias cotidianas sean más inteligentes. ¿Cómo? Al integrar análisis predictivos (hablaremos sobre esto más adelante) y otras técnicas de IA en aplicaciones que utilizamos diariamente.','Internet','A','Calculator_Inteligencia Artificial_6.png',7,'N','N','2021-02-24 23:57:26','2021-04-09 16:40:12','M'),(54,'Tesis','2021-03-04',8,'tesis','tesis','A','Landscape-Color_Tesis_9.jpg',8,'N','N','2021-03-02 13:16:01','2021-03-02 13:31:59','M'),(56,'preparacion de la salchipapa','2021-03-11',2,'cortas las papas y las fries no hay misterio','fuente de los deseos','A','unnamed_preparacion de la salchipapa_8.jpg',9,'N','N','2021-03-28 00:31:10','2021-03-28 00:34:25','M'),(57,'Contaminantes','2021-04-01',2,'Dentro del campo de la investigacion los contaminantes llegan a ser un punto clave para la salud de las personas y si interaccion con la naturaleza','www.wikipedia.com','A','pexels-brandon-montrone-1179229_Contaminantes_9.jpg',10,'N','N','2021-04-09 16:21:49','2021-04-09 16:22:33','M');
/*!40000 ALTER TABLE `coleccion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coleccion_atributoex`
--

DROP TABLE IF EXISTS `coleccion_atributoex`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `coleccion_atributoex` (
  `cae_id` int(11) NOT NULL AUTO_INCREMENT,
  `aex_id` int(11) DEFAULT NULL,
  `cae_descripcion` varchar(1000) NOT NULL,
  `col_id` int(11) DEFAULT NULL,
  `cae_estado` varchar(1) NOT NULL,
  `cae_fechaCreacion` datetime NOT NULL,
  `cae_fechaAudit` datetime NOT NULL,
  `cae_accion` varchar(1) NOT NULL,
  PRIMARY KEY (`cae_id`),
  KEY `col_id` (`col_id`),
  KEY `aex_id` (`aex_id`),
  CONSTRAINT `coleccion_atributoex_ibfk_1` FOREIGN KEY (`col_id`) REFERENCES `coleccion` (`col_id`) ON DELETE SET NULL,
  CONSTRAINT `coleccion_atributoex_ibfk_2` FOREIGN KEY (`aex_id`) REFERENCES `atributo_extra` (`aex_id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coleccion_atributoex`
--

LOCK TABLES `coleccion_atributoex` WRITE;
/*!40000 ALTER TABLE `coleccion_atributoex` DISABLE KEYS */;
INSERT INTO `coleccion_atributoex` VALUES (44,1,'prueba',45,'N','2021-01-13 17:43:22','2021-01-13 17:43:22','N'),(53,1,'Por preguntar',NULL,'N','2021-01-19 11:23:15','2021-01-19 11:23:15','N'),(54,2,'Atributo ???',NULL,'N','2021-01-19 11:23:15','2021-01-19 11:23:15','N'),(55,1,'????',NULL,'N','2021-01-19 13:55:42','2021-01-19 13:55:42','N'),(57,1,'Hola',47,'N','2021-02-10 12:55:44','2021-02-10 12:55:44','N'),(58,2,'prueba',52,'N','2021-02-24 23:57:26','2021-02-24 23:57:26','N'),(62,1,'tesis',54,'N','2021-03-02 13:31:32','2021-03-02 13:31:32','N'),(63,1,'no hay',56,'N','2021-03-28 00:31:13','2021-03-28 00:31:13','N'),(68,1,'prueba 25',46,'N','2021-04-08 22:32:16','2021-04-08 22:32:16','N'),(69,13,'111',46,'N','2021-04-08 22:32:16','2021-04-08 22:32:16','N'),(70,2,'222',46,'N','2021-04-08 22:32:16','2021-04-08 22:32:16','N'),(71,9,'333',46,'N','2021-04-08 22:32:16','2021-04-08 22:32:16','N'),(72,1,'Salud',57,'N','2021-04-09 16:21:52','2021-04-09 16:21:52','N'),(73,2,'Mineria de datos',57,'N','2021-04-09 16:21:52','2021-04-09 16:21:52','N');
/*!40000 ALTER TABLE `coleccion_atributoex` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coleccion_pais`
--

DROP TABLE IF EXISTS `coleccion_pais`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `coleccion_pais` (
  `cpa_id` int(11) NOT NULL AUTO_INCREMENT,
  `pai_id` int(11) DEFAULT NULL,
  `cpa_ubicacion` varchar(500) NOT NULL,
  `col_id` int(11) DEFAULT NULL,
  `cpa_estado` varchar(1) NOT NULL,
  `cpa_fechaCreacion` datetime NOT NULL,
  `cpa_fechaAudit` datetime NOT NULL,
  `cpa_accion` varchar(1) NOT NULL,
  PRIMARY KEY (`cpa_id`),
  KEY `pai_id` (`pai_id`),
  KEY `col_id` (`col_id`),
  CONSTRAINT `coleccion_pais_ibfk_1` FOREIGN KEY (`pai_id`) REFERENCES `pais` (`pai_id`) ON DELETE SET NULL,
  CONSTRAINT `coleccion_pais_ibfk_2` FOREIGN KEY (`col_id`) REFERENCES `coleccion` (`col_id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=176 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coleccion_pais`
--

LOCK TABLES `coleccion_pais` WRITE;
/*!40000 ALTER TABLE `coleccion_pais` DISABLE KEYS */;
INSERT INTO `coleccion_pais` VALUES (150,216,'cuenca',45,'N','2021-01-13 17:43:22','2021-01-13 17:43:22','N'),(155,216,'Riobamba',NULL,'N','2021-01-19 11:23:15','2021-01-19 11:23:15','N'),(156,216,'Riobamba',NULL,'N','2021-01-19 13:55:42','2021-01-19 13:55:42','N'),(158,8,'Ecuador',51,'N','2021-02-10 12:43:29','2021-02-10 12:43:29','N'),(159,114,'cuenca',47,'N','2021-02-10 12:55:44','2021-02-10 12:55:44','N'),(160,216,'Riobamba',52,'N','2021-02-24 23:57:26','2021-02-24 23:57:26','N'),(166,216,'Cuenca',54,'N','2021-03-02 13:31:32','2021-03-02 13:31:32','N'),(167,216,'Azuay',54,'N','2021-03-02 13:31:32','2021-03-02 13:31:32','N'),(168,216,'en tu corazon bebe',56,'N','2021-03-28 00:31:13','2021-03-28 00:31:13','N'),(172,216,'Cuenca',46,'N','2021-04-08 22:32:16','2021-04-08 22:32:16','N'),(173,18,'Azuay',46,'N','2021-04-08 22:32:16','2021-04-08 22:32:16','N'),(174,140,'Prueba',46,'N','2021-04-08 22:32:16','2021-04-08 22:32:16','N'),(175,216,'Cuenca',57,'N','2021-04-09 16:21:52','2021-04-09 16:21:52','N');
/*!40000 ALTER TABLE `coleccion_pais` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coleccion_persona`
--

DROP TABLE IF EXISTS `coleccion_persona`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `coleccion_persona` (
  `cpe_id` int(11) NOT NULL AUTO_INCREMENT,
  `inv_id` int(11) DEFAULT NULL,
  `col_id` int(11) DEFAULT NULL,
  `cpe_estado` varchar(1) NOT NULL,
  `cpe_fechaCreacion` datetime NOT NULL,
  `cpe_fechaAudit` datetime NOT NULL,
  `cpe_accion` varchar(1) NOT NULL,
  PRIMARY KEY (`cpe_id`),
  KEY `col_id` (`col_id`),
  KEY `inv_id` (`inv_id`),
  CONSTRAINT `coleccion_persona_ibfk_1` FOREIGN KEY (`col_id`) REFERENCES `coleccion` (`col_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `coleccion_persona_ibfk_2` FOREIGN KEY (`inv_id`) REFERENCES `investigador` (`inv_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coleccion_persona`
--

LOCK TABLES `coleccion_persona` WRITE;
/*!40000 ALTER TABLE `coleccion_persona` DISABLE KEYS */;
INSERT INTO `coleccion_persona` VALUES (50,4,45,'N','2021-01-13 17:43:22','2021-01-13 17:43:22','N'),(58,4,54,'N','2021-03-02 13:31:32','2021-03-02 13:31:32','N'),(62,6,46,'N','2021-04-08 22:32:16','2021-04-08 22:32:16','N'),(63,7,46,'N','2021-04-08 22:32:16','2021-04-08 22:32:16','N'),(64,8,46,'N','2021-04-08 22:32:16','2021-04-08 22:32:16','N'),(65,6,57,'N','2021-04-09 16:21:52','2021-04-09 16:21:52','N'),(66,8,57,'N','2021-04-09 16:21:52','2021-04-09 16:21:52','N'),(67,7,57,'N','2021-04-09 16:21:52','2021-04-09 16:21:52','N');
/*!40000 ALTER TABLE `coleccion_persona` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contador_archivo`
--

DROP TABLE IF EXISTS `contador_archivo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contador_archivo` (
  `car_id` int(11) NOT NULL AUTO_INCREMENT,
  `car_contador` int(11) DEFAULT NULL,
  `arc_id` int(11) DEFAULT NULL,
  `car_tipo` char(18) NOT NULL,
  PRIMARY KEY (`car_id`),
  KEY `arc_id` (`arc_id`),
  CONSTRAINT `contador_archivo_ibfk_1` FOREIGN KEY (`arc_id`) REFERENCES `archivo` (`arc_id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contador_archivo`
--

LOCK TABLES `contador_archivo` WRITE;
/*!40000 ALTER TABLE `contador_archivo` DISABLE KEYS */;
/*!40000 ALTER TABLE `contador_archivo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contador_coleccion`
--

DROP TABLE IF EXISTS `contador_coleccion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contador_coleccion` (
  `cco_id` int(11) NOT NULL AUTO_INCREMENT,
  `cco_contador` int(11) DEFAULT NULL,
  `col_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`cco_id`),
  KEY `col_id` (`col_id`),
  CONSTRAINT `contador_coleccion_ibfk_1` FOREIGN KEY (`col_id`) REFERENCES `coleccion` (`col_id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contador_coleccion`
--

LOCK TABLES `contador_coleccion` WRITE;
/*!40000 ALTER TABLE `contador_coleccion` DISABLE KEYS */;
/*!40000 ALTER TABLE `contador_coleccion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `derecho`
--

DROP TABLE IF EXISTS `derecho`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `derecho` (
  `der_id` int(11) NOT NULL AUTO_INCREMENT,
  `der_nombre` varchar(50) NOT NULL,
  `der_estado` varchar(1) NOT NULL,
  `der_fechaCreacion` datetime NOT NULL,
  `der_fechaAudit` datetime NOT NULL,
  `der_accion` varchar(1) NOT NULL,
  PRIMARY KEY (`der_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `derecho`
--

LOCK TABLES `derecho` WRITE;
/*!40000 ALTER TABLE `derecho` DISABLE KEYS */;
INSERT INTO `derecho` VALUES (1,'Abierto','N','2020-11-10 21:48:51','2021-02-21 18:29:46','M'),(2,'Restringido','N','2020-11-10 21:53:48','2021-02-21 18:30:13','M');
/*!40000 ALTER TABLE `derecho` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detallearchivo_atributoex`
--

DROP TABLE IF EXISTS `detallearchivo_atributoex`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detallearchivo_atributoex` (
  `dae_id` int(11) NOT NULL AUTO_INCREMENT,
  `dae_descripcion` varchar(1000) NOT NULL,
  `arc_id` int(11) DEFAULT NULL,
  `aae_id` int(11) DEFAULT NULL,
  `aex_id` int(11) DEFAULT NULL,
  `dae_estado` varchar(1) NOT NULL,
  `dae_fechaCreacion` datetime NOT NULL,
  `dae_fechaAudit` datetime NOT NULL,
  `dae_accion` varchar(1) NOT NULL,
  PRIMARY KEY (`dae_id`),
  KEY `arc_id` (`arc_id`),
  KEY `aae_id` (`aae_id`),
  KEY `aex_id` (`aex_id`) USING BTREE,
  CONSTRAINT `detallearchivo_atributoex_ibfk_1` FOREIGN KEY (`arc_id`) REFERENCES `archivo` (`arc_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `detallearchivo_atributoex_ibfk_2` FOREIGN KEY (`aae_id`) REFERENCES `archivo_atributoex` (`aae_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=104 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detallearchivo_atributoex`
--

LOCK TABLES `detallearchivo_atributoex` WRITE;
/*!40000 ALTER TABLE `detallearchivo_atributoex` DISABLE KEYS */;
INSERT INTO `detallearchivo_atributoex` VALUES (21,'1',28,10,5,'N','2020-11-22 12:40:51','2020-11-22 12:40:51','N'),(22,'3',28,12,7,'N','2020-11-22 12:40:51','2020-11-22 12:40:51','N'),(70,'2 Mb',47,13,5,'N','2021-03-09 23:53:07','2021-03-09 23:53:07','N'),(89,'10 minutos',42,28,3,'N','2021-03-10 00:47:45','2021-03-10 00:47:45','N'),(97,'5 minutos',49,54,3,'N','2021-03-10 18:50:55','2021-03-10 18:50:55','N'),(98,'65',45,12,7,'N','2021-03-10 19:09:56','2021-03-10 19:09:56','N'),(99,'njvhj',50,65,8,'N','2021-03-28 00:41:48','2021-03-28 00:41:48','N'),(100,'kjiriht',51,65,8,'N','2021-03-28 00:46:58','2021-03-28 00:46:58','N'),(102,'1000',52,60,7,'N','2021-04-09 16:29:35','2021-04-09 16:29:35','N'),(103,'6 minutos',53,28,3,'N','2021-04-09 16:33:22','2021-04-09 16:33:22','N');
/*!40000 ALTER TABLE `detallearchivo_atributoex` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `disciplina`
--

DROP TABLE IF EXISTS `disciplina`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `disciplina` (
  `dis_id` int(11) NOT NULL AUTO_INCREMENT,
  `dis_nombre` varchar(30) NOT NULL,
  `dis_estado` varchar(1) NOT NULL,
  `dis_fechaCreacion` datetime NOT NULL,
  `dis_fechaAudit` datetime NOT NULL,
  `dis_accion` varchar(1) NOT NULL,
  PRIMARY KEY (`dis_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `disciplina`
--

LOCK TABLES `disciplina` WRITE;
/*!40000 ALTER TABLE `disciplina` DISABLE KEYS */;
INSERT INTO `disciplina` VALUES (1,'Lingüística','N','2020-11-09 19:20:43','2020-11-09 19:21:01','N'),(2,'Computación 2','N','2020-11-10 19:18:38','2021-03-28 00:30:42','M'),(4,'Matemáticas','N','2020-11-10 20:44:53','2020-11-10 20:45:12','M'),(5,'Desarrollo de Software','N','2021-01-19 14:06:32','2021-01-19 14:06:32','N'),(7,'Sociología','N','2021-02-21 18:26:54','2021-02-21 18:26:54','N'),(8,'Economía','N','2021-02-21 18:27:14','2021-02-21 18:27:14','N');
/*!40000 ALTER TABLE `disciplina` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `genero`
--

DROP TABLE IF EXISTS `genero`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `genero` (
  `gen_id` int(11) NOT NULL AUTO_INCREMENT,
  `gen_nombre` varchar(30) NOT NULL,
  `gen_estado` varchar(1) NOT NULL,
  `gen_fechaCreacion` datetime NOT NULL,
  `gen_fechaAudit` datetime NOT NULL,
  `gen_accion` varchar(1) NOT NULL,
  PRIMARY KEY (`gen_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `genero`
--

LOCK TABLES `genero` WRITE;
/*!40000 ALTER TABLE `genero` DISABLE KEYS */;
INSERT INTO `genero` VALUES (1,'Conversación','N','2020-11-10 22:10:43','2020-11-10 22:11:13','M'),(2,'Entrevista','N','2020-11-10 22:11:32','2020-11-10 22:11:32','N'),(3,'Grabación','N','2020-11-10 22:11:54','2021-02-21 18:32:07','M');
/*!40000 ALTER TABLE `genero` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `idioma`
--

DROP TABLE IF EXISTS `idioma`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `idioma` (
  `idi_id` int(11) NOT NULL AUTO_INCREMENT,
  `idi_nombre` varchar(50) NOT NULL,
  `idi_estado` varchar(1) NOT NULL,
  `idi_fechaCreacion` datetime NOT NULL,
  `idi_fechaAudit` datetime NOT NULL,
  `idi_accion` varchar(1) NOT NULL,
  PRIMARY KEY (`idi_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `idioma`
--

LOCK TABLES `idioma` WRITE;
/*!40000 ALTER TABLE `idioma` DISABLE KEYS */;
INSERT INTO `idioma` VALUES (1,'Ingles','N','2020-11-10 21:20:59','2020-11-10 21:20:59','N'),(2,'Español','N','2020-11-10 21:21:56','2021-02-21 18:36:46','M'),(3,'Persa','N','2020-11-10 21:23:12','2020-11-10 21:23:12','N'),(5,'Japonés','N','2020-11-10 21:24:06','2020-11-10 21:24:38','M');
/*!40000 ALTER TABLE `idioma` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `investigador`
--

DROP TABLE IF EXISTS `investigador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `investigador` (
  `inv_id` int(11) NOT NULL AUTO_INCREMENT,
  `usu_id` int(11) DEFAULT NULL,
  `inv_tituloProfesional` varchar(400) NOT NULL,
  `inv_descripcion` varchar(400) NOT NULL,
  `inv_twitter` varchar(250) NOT NULL,
  `inv_facebook` varchar(250) NOT NULL,
  `inv_instagram` varchar(250) NOT NULL,
  `inv_web` varchar(500) NOT NULL,
  `inv_estado` varchar(1) NOT NULL,
  `inv_fechaCreacion` datetime NOT NULL,
  `inv_fechaAudit` datetime NOT NULL,
  `inv_accion` varchar(1) NOT NULL,
  PRIMARY KEY (`inv_id`),
  KEY `usu_id` (`usu_id`),
  CONSTRAINT `investigador_ibfk_1` FOREIGN KEY (`usu_id`) REFERENCES `user` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `investigador`
--

LOCK TABLES `investigador` WRITE;
/*!40000 ALTER TABLE `investigador` DISABLE KEYS */;
INSERT INTO `investigador` VALUES (4,4,'Ing de Sistemas','La biorgrafia debe ser un poco extensa pero no lo demasiado para que se vea chevere','https://www.facebook.com/eriickdre/','https://www.facebook.com/eriickdre/','https://www.instagram.com/eriickdre/','https://www.facebook.com/eriickdre/','N','2020-11-11 00:35:52','2021-02-21 18:23:02','M'),(6,12,'ingeniero mecanico','me gustan las alitas','no hay','adrian mendez','chupalo','www.holacomoteva.com','N','2021-02-21 18:05:45','2021-02-21 18:05:45','N'),(7,16,'Ingeniero en Sistemas Informáticos','Desarrollo de Software','','','','','N','2021-02-24 23:26:35','2021-02-24 23:26:35','N'),(8,17,'ejemplo','ejemplo','','','','','N','2021-03-02 13:14:07','2021-03-02 13:14:47','M'),(9,44,'ingeniero mecanico','me gusta la salchipapa','no hay','adrian sopademacaco','caldodebolas1','www.holacomoteva.com','N','2021-03-28 00:27:01','2021-03-28 00:27:01','N'),(10,45,'Ingenieria de sistemas','Investigador','','','','','N','2021-04-09 16:12:56','2021-04-09 16:13:39','M');
/*!40000 ALTER TABLE `investigador` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu` (
  `men_id` int(11) NOT NULL AUTO_INCREMENT,
  `men_nombre` varchar(100) NOT NULL,
  `men_descripción` varchar(100) DEFAULT NULL,
  `men_icono` varchar(50) DEFAULT NULL,
  `men_color` varchar(50) DEFAULT NULL,
  `men_url` varchar(2000) DEFAULT NULL,
  `men_idPadre` int(11) DEFAULT NULL,
  `men_posicion` int(11) NOT NULL,
  `men_activo` int(11) NOT NULL,
  `men_estado` varchar(1) NOT NULL,
  `men_fechaCreacion` datetime NOT NULL,
  `men_fechaAudit` datetime NOT NULL,
  `men_accion` varchar(1) NOT NULL,
  PRIMARY KEY (`men_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu`
--

LOCK TABLES `menu` WRITE;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` VALUES (1,'Gestión de Menú','','','','',0,0,1,'N','2020-11-10 22:10:43','2020-11-10 23:06:13','M'),(2,'Menú','Permite administrar el menú del panel de administración.','bx bx-menu','pink','/menu',1,1,1,'N','2020-11-10 22:10:43','2020-11-10 22:10:43','N'),(3,'Gestión de términos','','','','',0,0,1,'N','2020-11-10 22:10:43','2021-02-09 09:20:42','M'),(4,' Disciplina','Permite administrar las disciplinas disponibles en el sitio web.','bx bx-grid-alt','pink','/disciplina',3,6,1,'N','2020-11-10 22:10:43','2021-04-09 12:42:20','M'),(5,'País','Permite administrar los paises disponibles en el sitio web.','bx bx-world','cyan','/pais',3,2,1,'N','2020-11-10 22:10:43','2020-11-10 22:10:43','N'),(6,'Idioma','Permite administrar los idiomas disponibles en el sitio web.','bx bx-font-color','green','/idioma',3,3,1,'N','2020-11-10 22:10:43','2020-11-10 22:10:43','N'),(7,'Nivel de acceso','Permite administrar los niveles de acceso disponibles.','bx bx-copyright','blue','/derecho',3,6,1,'N','2020-11-10 22:10:43','2021-02-21 18:33:31','M'),(8,'Género de Archivos','Permite administrar los géneros disponibles para los archivos del sitio web.','bx bx-conversation','pink','/genero',3,5,1,'N','2020-11-10 22:10:43','2020-11-10 22:10:43','N'),(9,'Gestión de atributos para archivos y colecciones','','','','',0,0,1,'N','2020-11-10 22:10:43','2020-11-10 22:10:43','N'),(10,'Atributos Extra','Permite administrar los atributos extra disponibles en el sitio web','bx bx-add-to-queue','pink','/atributoextra',9,1,1,'N','2020-11-10 22:10:43','2020-11-10 22:10:43','N'),(11,'Tipos de archivos','Permite administrar los tipos de archivos disponibles en el sitio web','bx bx-file','cyan','/tipoarchivo',9,2,1,'N','2020-11-10 22:10:43','2020-11-10 22:10:43','N'),(12,'Atributos Extra para Archivos','Permite administrar los roles del sistema','bx bx-columns','green','/archivoatributoex',9,4,2,'N','2020-11-10 22:10:43','2020-11-10 22:10:43','N'),(13,'Gestión de colecciones y archivos de investigador','','','','',0,0,1,'N','2020-11-10 22:10:43','2020-11-10 22:10:43','N'),(14,'Colecciones','Permite aceptar/denegar las colecciones creadas por los investigadores.','bx bx-folder-open','pink','/coleccion',13,1,1,'N','2020-11-10 22:10:43','2020-11-10 22:10:43','N'),(15,'Archivos','Permite aceptar/denegar los archivos creados por los investigadores.','bx bx-file','cyan','/archivo',13,2,1,'N','2020-11-10 22:10:43','2020-11-10 22:10:43','N'),(16,'Gestión de usuarios','','','','',0,0,1,'N','2020-11-10 22:10:43','2020-11-10 22:10:43','N'),(17,'Usuarios','Permite administrar los usuarios del sistema.','bx bx-user','pink','/user',16,1,1,'N','2020-11-10 22:10:43','2020-11-10 22:10:43','N'),(18,'Sexo de usuarios','Permite gestionar el sexo de los usuarios.','bx bx-user-pin','cyan','/usergenero',16,3,1,'N','2020-11-10 22:10:43','2021-04-09 02:42:47','M'),(19,'Gestión de preguntas frecuentes','','','','',0,0,1,'N','2021-01-30 18:31:06','2021-01-30 18:44:50','M'),(20,'Preguntas frecuentes','Permite administrar las preguntas frecuentes que tienen los clientes.','bx bx-help-circle','green','/pregunta-frecuente',19,2,1,'N','2021-01-30 18:40:15','2021-01-30 18:53:32','M');
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migration`
--

DROP TABLE IF EXISTS `migration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migration`
--

LOCK TABLES `migration` WRITE;
/*!40000 ALTER TABLE `migration` DISABLE KEYS */;
INSERT INTO `migration` VALUES ('m000000_000000_base',1600873851),('m130524_201442_init',1600873853),('m140506_102106_rbac_init',1601325625),('m170907_052038_rbac_add_index_on_auth_assignment_user_id',1601325625),('m180523_151638_rbac_updates_indexes_without_prefix',1601325627),('m190124_110200_add_verification_token_column_to_user_table',1600873853),('m200409_110543_rbac_update_mssql_trigger',1601325627);
/*!40000 ALTER TABLE `migration` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pais`
--

DROP TABLE IF EXISTS `pais`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pais` (
  `pai_id` int(11) NOT NULL AUTO_INCREMENT,
  `pai_nombre` varchar(50) NOT NULL,
  `pai_estado` varchar(1) NOT NULL,
  `pai_fechaCreacion` datetime NOT NULL,
  `pai_fechaAudit` datetime NOT NULL,
  `pai_accion` varchar(1) NOT NULL,
  PRIMARY KEY (`pai_id`)
) ENGINE=InnoDB AUTO_INCREMENT=220 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pais`
--

LOCK TABLES `pais` WRITE;
/*!40000 ALTER TABLE `pais` DISABLE KEYS */;
INSERT INTO `pais` VALUES (1,'Australia','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(2,'Austria','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(3,'Azerbaiyán','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(4,'Anguilla','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(6,'Armenia','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(7,'Bielorrusia','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(8,'Belice','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(9,'Bélgica','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(10,'Bermudas','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(11,'Bulgaria','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(12,'Brasil','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(13,'Reino Unido','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(14,'Hungría','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(15,'Vietnam','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(16,'Haiti','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(17,'Guadalupe','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(18,'Alemania','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(19,'Países Bajos, Holanda','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(20,'Grecia','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(21,'Georgia','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(22,'Dinamarca','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(23,'Egipto','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(24,'Israel','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(25,'India','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(26,'Irán','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(27,'Irlanda','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(28,'España','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(29,'Italia','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(30,'Kazajstán','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(31,'Camerún','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(32,'Canadá','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(33,'Chipre','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(34,'Kirguistán','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(35,'China','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(36,'Costa Rica','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(37,'Kuwait','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(38,'Letonia','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(39,'Libia','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(40,'Lituania','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(41,'Luxemburgo','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(42,'México','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(43,'Moldavia','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(44,'Mónaco','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(45,'Nueva Zelanda','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(46,'Noruega','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(47,'Polonia','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(48,'Portugal','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(49,'Reunión','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(50,'Rusia','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(51,'El Salvador','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(52,'Eslovaquia','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(53,'Eslovenia','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(54,'Surinam','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(55,'Estados Unidos','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(56,'Tadjikistan','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(57,'Turkmenistan','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(58,'Islas Turcas y Caicos','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(59,'Turquía','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(60,'Uganda','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(61,'Uzbekistán','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(62,'Ucrania','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(63,'Finlandia','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(64,'Francia','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(65,'República Checa','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(66,'Suiza','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(67,'Suecia','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(68,'Estonia','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(69,'Corea del Sur','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(70,'Japón','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(71,'Croacia','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(72,'Rumanía','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(73,'Hong Kong','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(74,'Indonesia','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(75,'Jordania','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(76,'Malasia','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(77,'Singapur','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(78,'Taiwan','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(79,'Bosnia y Herzegovina','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(80,'Bahamas','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(81,'Chile','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(82,'Colombia','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(83,'Islandia','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(84,'Corea del Norte','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(85,'Macedonia','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(86,'Malta','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(87,'Pakistán','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(88,'Papúa-Nueva Guinea','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(89,'Perú','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(90,'Filipinas','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(91,'Arabia Saudita','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(92,'Tailandia','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(93,'Emiratos árabes Unidos','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(94,'Groenlandia','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(95,'Venezuela','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(96,'Zimbabwe','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(97,'Kenia','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(98,'Algeria','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(99,'Líbano','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(100,'Botsuana','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(101,'Tanzania','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(102,'Namibia','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(104,'Marruecos','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(105,'Ghana','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(106,'Siria','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(107,'Nepal','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(108,'Mauritania','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(109,'Seychelles','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(110,'Paraguay','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(111,'Uruguay','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(112,'Congo (Brazzaville)','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(113,'Cuba','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(114,'Albania','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(115,'Nigeria','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(116,'Zambia','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(117,'Mozambique','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(118,'Angola','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(119,'Sri Lanka','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(120,'Etiopía','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(121,'Túnez','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(122,'Bolivia','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(123,'Panamá','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(124,'Malawi','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(125,'Liechtenstein','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(126,'Bahrein','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(127,'Barbados','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(128,'Chad','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(129,'Man, Isla de','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(130,'Jamaica','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(131,'Malí','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(132,'Madagascar','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(133,'Senegal','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(134,'Togo','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(135,'Honduras','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(136,'República Dominicana','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(137,'Mongolia','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(138,'Irak','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(139,'Sudáfrica','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(140,'Aruba','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(141,'Gibraltar','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(143,'Andorra','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(144,'Antigua y Barbuda','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(145,'Bangladesh','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(146,'Benín','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(147,'Bután','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(148,'Islas Virgenes Británicas','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(149,'Brunéi','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(150,'Burkina Faso','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(151,'Burundi','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(152,'Camboya','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(153,'Cabo Verde','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(154,'Comores','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(155,'Congo (Kinshasa)','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(156,'Cook, Islas','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(157,'Costa de Marfil','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(158,'Djibouti, Yibuti','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(159,'Timor Oriental','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(160,'Guinea Ecuatorial','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(161,'Eritrea','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(162,'Feroe, Islas','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(163,'Fiyi','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(164,'Polinesia Francesa','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(165,'Gabón','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(166,'Gambia','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(167,'Granada','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(168,'Guatemala','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(169,'Guernsey','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(170,'Guinea','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(171,'Guinea-Bissau','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(172,'Guyana','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(173,'Jersey','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(174,'Kiribati','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(175,'Laos','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(176,'Lesotho','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(177,'Liberia','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(178,'Maldivas','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(179,'Martinica','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(180,'Mauricio','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(181,'Myanmar','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(182,'Nauru','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(183,'Antillas Holandesas','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(184,'Nueva Caledonia','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(185,'Nicaragua','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(186,'Níger','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(187,'Norfolk Island','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(188,'Omán','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(189,'Isla Pitcairn','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(190,'Qatar','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(191,'Ruanda','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(192,'Santa Elena','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(193,'San Cristobal y Nevis','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(194,'Santa Lucía','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(195,'San Pedro y Miquelón','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(196,'San Vincente y Granadinas','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(197,'Samoa','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(198,'San Marino','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(199,'San Tomé y Príncipe','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(200,'Serbia y Montenegro','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(201,'Sierra Leona','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(202,'Islas Salomón','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(203,'Somalia','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(204,'Sudán','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(205,'Swazilandia','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(206,'Tokelau','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(207,'Tonga','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(208,'Trinidad y Tobago','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(209,'Tuvalu','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(210,'Vanuatu','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(211,'Wallis y Futuna','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(212,'Sáhara Occidental','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(213,'Yemen','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(214,'Puerto Rico','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(216,'Ecuador','N','2020-11-09 19:20:43','2020-11-09 19:20:43','N'),(218,'Afganistán','N','2020-11-10 21:12:00','2020-11-10 21:13:20','M');
/*!40000 ALTER TABLE `pais` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `palabra_clave`
--

DROP TABLE IF EXISTS `palabra_clave`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `palabra_clave` (
  `pcl_id` int(11) NOT NULL AUTO_INCREMENT,
  `pcl_palabraClave` varchar(100) NOT NULL,
  `col_id` int(11) DEFAULT NULL,
  `pcl_estado` varchar(1) NOT NULL,
  `pcl_fechaCreacion` datetime NOT NULL,
  `pcl_fechaAudit` datetime NOT NULL,
  `pcl_accion` varchar(1) NOT NULL,
  PRIMARY KEY (`pcl_id`),
  KEY `col_id` (`col_id`),
  CONSTRAINT `palabra_clave_ibfk_1` FOREIGN KEY (`col_id`) REFERENCES `coleccion` (`col_id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=115 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `palabra_clave`
--

LOCK TABLES `palabra_clave` WRITE;
/*!40000 ALTER TABLE `palabra_clave` DISABLE KEYS */;
INSERT INTO `palabra_clave` VALUES (86,'Ejem2',45,'N','2021-01-13 17:43:22','2021-01-13 17:43:22','N'),(87,'Ejemplo2',45,'N','2021-01-13 17:43:22','2021-01-13 17:43:22','N'),(96,'Inteligencia Artificial',NULL,'N','2021-01-19 11:23:15','2021-01-19 11:23:15','N'),(97,'IP',NULL,'N','2021-01-19 11:23:15','2021-01-19 11:23:15','N'),(98,'Ionic',NULL,'N','2021-01-19 13:55:42','2021-01-19 13:55:42','N'),(100,'Colección de ejemplo',51,'N','2021-02-10 12:43:29','2021-02-10 12:43:29','N'),(101,'Palabra 1',47,'N','2021-02-10 12:55:44','2021-02-10 12:55:44','N'),(102,'Inteligencia Artificial',52,'N','2021-02-24 23:57:26','2021-02-24 23:57:26','N'),(106,'tesis 1',54,'N','2021-03-02 13:31:32','2021-03-02 13:31:32','N'),(107,'1996',54,'N','2021-03-02 13:31:32','2021-03-02 13:31:32','N'),(111,'dyjdy',46,'N','2021-04-08 22:32:16','2021-04-08 22:32:16','N'),(112,'1996',46,'N','2021-04-08 22:32:16','2021-04-08 22:32:16','N'),(113,'palabra 2',46,'N','2021-04-08 22:32:16','2021-04-08 22:32:16','N'),(114,'Conaminantes',57,'N','2021-04-09 16:21:52','2021-04-09 16:21:52','N');
/*!40000 ALTER TABLE `palabra_clave` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pregunta_frecuente`
--

DROP TABLE IF EXISTS `pregunta_frecuente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pregunta_frecuente` (
  `pfr_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pfr_pregunta` varchar(500) NOT NULL,
  `pfr_respuesta` varchar(1000) NOT NULL,
  `pfr_estado` varchar(1) NOT NULL,
  `pfr_fechaCreacion` datetime NOT NULL,
  `pfr_fechaAudit` datetime NOT NULL,
  `pfr_accion` varchar(1) NOT NULL,
  PRIMARY KEY (`pfr_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pregunta_frecuente`
--

LOCK TABLES `pregunta_frecuente` WRITE;
/*!40000 ALTER TABLE `pregunta_frecuente` DISABLE KEYS */;
INSERT INTO `pregunta_frecuente` VALUES (1,'¿Qué es DYAC?','Documentación y Archivo Científico\r\nLa documentación es una herramienta que ha sido empleada por la lingüística descriptiva para la creación de diccionarios, gramáticas y textos sobre diferentes lenguas. Sin embargo, hace más o menos 20 años, ha surgido una nueva postura y concepción, la cual está ligada a la antropología lingüística, conocida con el nombre de lingüística de la documentación . El cambio de concepción ha significado que LD esté centrada en el discurso (Sherzer, 1987) y capturada en contextos naturales de ejecución.','N','2021-01-30 15:20:16','2021-01-30 15:20:16','N');
/*!40000 ALTER TABLE `pregunta_frecuente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rol`
--

DROP TABLE IF EXISTS `rol`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rol` (
  `rol_id` int(11) NOT NULL AUTO_INCREMENT,
  `rol_nombre` varchar(50) NOT NULL,
  `rol_estado` varchar(1) NOT NULL,
  `rol_fechaCreacion` datetime NOT NULL,
  `rol_fechaAudit` datetime NOT NULL,
  `rol_accion` varchar(1) NOT NULL,
  PRIMARY KEY (`rol_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rol`
--

LOCK TABLES `rol` WRITE;
/*!40000 ALTER TABLE `rol` DISABLE KEYS */;
INSERT INTO `rol` VALUES (1,'Administrador','N','2020-11-10 22:10:43','2020-11-10 22:10:43','N'),(2,'Investigador','N','2020-11-10 22:10:43','2020-11-10 22:10:43','N'),(3,'Usuario registrado','N','2020-11-10 22:10:43','2020-11-10 22:10:43','N');
/*!40000 ALTER TABLE `rol` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_archivo`
--

DROP TABLE IF EXISTS `tipo_archivo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_archivo` (
  `tar_id` int(11) NOT NULL AUTO_INCREMENT,
  `tar_tipo` varchar(30) NOT NULL,
  `tar_extension` varchar(30) NOT NULL,
  `tar_estado` varchar(1) NOT NULL,
  `tar_fechaCreacion` datetime NOT NULL,
  `tar_fechaAudit` datetime NOT NULL,
  `tar_accion` varchar(1) NOT NULL,
  PRIMARY KEY (`tar_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_archivo`
--

LOCK TABLES `tipo_archivo` WRITE;
/*!40000 ALTER TABLE `tipo_archivo` DISABLE KEYS */;
INSERT INTO `tipo_archivo` VALUES (1,'Imágen','jpg,png,gif','N','2020-11-20 22:26:14','2021-04-09 12:23:53','M'),(2,'Audio','mp3,wav,m4a','N','2020-11-20 22:26:31','2021-02-25 23:32:46','M'),(3,'Video','mp4,mov,wma','N','2020-11-20 22:26:51','2021-02-23 01:09:14','M'),(4,'Documento','pdf,doc,xls,pub','N','2020-11-20 22:27:10','2021-01-28 17:18:00','M'),(5,'Comprimido','zip,tar,rar','N','2020-11-20 22:27:38','2020-11-20 22:27:38','N'),(9,'PDF','pdf','N','2021-03-12 19:40:16','2021-03-12 22:24:21','M'),(10,'extra','tiff','N','2021-03-12 22:26:00','2021-03-12 22:26:00','N'),(11,'Audio prueba','MP3','N','2021-03-28 00:32:47','2021-03-28 00:32:47','N');
/*!40000 ALTER TABLE `tipo_archivo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `use_nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `use_apellido` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `uge_id` int(11) NOT NULL,
  `use_telefono` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `pai_id` int(11) NOT NULL,
  `rol_id` int(11) NOT NULL,
  `use_foto` varchar(2000) COLLATE utf8_unicode_ci NOT NULL,
  `use_estado` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `use_estadoAudit` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `use_fechaCreacion` datetime NOT NULL,
  `use_fechaAudit` datetime NOT NULL,
  `use_accion` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT 10,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `verification_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`),
  KEY `pai_id` (`pai_id`),
  KEY `rol_id` (`rol_id`),
  KEY `uge_id` (`id`),
  CONSTRAINT `FK_user` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`rol_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'Administrador','del Sitio',3,'0000000000',216,1,'usuario_anonimo.jpg','1','N','2020-11-10 23:47:24','2020-11-10 23:47:27','N','BlgLyqn9XDIPgs20BW_0LaXDvjTWd31K','$2y$13$0SZ.FO5/Ar26RcfO299zwumg3yJ0R9Dl4L2RW4Koeju4E/nUu2Dcu',NULL,'dyac.app@gmail.com',10,1600874859,1601666240,'uH3BSLOC4frifaWlsDojSxzUD7a8TYOi_1600874859'),(4,'Santiago','Cedillo',1,'0999999999',216,2,'rs_634x1024-151013043634-634.Playboy-Bunny-JR-101315_SantiagoCedillo_9.jpg','2','N','2020-11-10 23:47:38','2021-02-21 18:23:02','M','BlgLyqn9XDIPgs20BW_0LaXDvjTWd31K','$2y$13$0SZ.FO5/Ar26RcfO299zwumg3yJ0R9Dl4L2RW4Koeju4E/nUu2Dcu',NULL,'scedillo@es.uazuay.edu.ec',10,1601991567,1613949782,'uH3BSLOC4frifaWlsDojSxzUD7a8TYOi_1600874859'),(10,'Johanna','Paguay',2,'2372328',216,3,'usuario_anonimo.jpg','1','N','2021-02-03 09:16:22','2021-02-03 09:16:22','N','ic9M7jAH-EAHbdJKEK1M3mdfuKDSfgzP','$2y$13$nZKia20A0GxlhX1iJzkw/u3UiCvZN.OOGfC5hTsj6qszDiIsDJVSC',NULL,'johanna6069paguay@gmail.com',9,1612361783,1612361783,'4SE_fyCze6Z5ddHmOGJ93OGNKVomi61c_1612361783'),(11,'Johanna','Paguay',2,'2372328',216,2,'usuario_anonimo.jpg','2','N','2021-02-03 09:17:34','2021-02-21 17:56:53','M','DK4cYWm3Mprr9L6-6YaM-sBhH-Z0SAvA','$2y$13$cDv2ENWfzyGWREiKqRjPBuHt8loIW/yfGnOKQMtP2rjKtZtPbR/X6',NULL,'johanna.paguay@espoch.edu.ec',9,1612361854,1613948213,'O7BNBLh8Sszcco8PH3el5CvcYweC5KHU_1612361854'),(12,'Adrian ','Mogrovejo',1,'0967324834',216,2,'rs_634x1024-151013043634-634.Playboy-Bunny-JR-101315_Adrian Mogrovejo_9.jpg','2','N','2021-02-21 17:32:04','2021-02-21 18:05:45','M','aiFCVkAcj6azsGWoVKUWCnt2y6PLcTwJ','$2y$13$9WJ32mmjpzL3pNHlFOVy5uOXa4Z7FJqZeEElyvZ5diN9d.DG4U8yS',NULL,'adrianmogrovejo123@gmail.com',10,1613946725,1613948745,'0GRNL1HD_Nt3vW5Z2Q10Gs17HJHa0qeO_1613946725'),(14,'Raul Ninerito','Perez Mendez',1,'0989288091',155,1,'17010_Raul NineritoPerez Mendez_8.jpg','1','N','2021-02-21 17:45:08','2021-02-21 17:45:08','M','pBjSW6V1HeIJJzjKPXScTmJtOx_1gcOs','$2y$13$z0nFw2DJilA3OmhNvB9Q4eDnxjxhahgroIqepujPvlukUj4dZ1IV.',NULL,'tefamogrovejo2@gmail.com',10,1613947509,1613947509,'KQQwfnP7P7RBuocwiPlQ-W-leIN10PvL_1613947509'),(16,'Juan','Tierra',1,'0983149444',216,2,'Chat_JuanTierra_8.png','2','N','2021-02-24 23:08:49','2021-02-24 23:26:35','M','gJa-AcHHrJpv1lyQkpbrx-fKhx29t9rC','$2y$13$cBK/78hKwMHLw5VJ12Ok5OAF2tqpiBNW4GtzZMXolXNa685rki1Z.',NULL,'PresenceSystem@gmail.com',10,1614226130,1614227195,'e3xQohAJADLCUxXgtlJtXMBIkkEnOCVo_1614226130'),(17,'Erick','Cedillo',1,'0959792122',216,2,'Fondo-Super-Mario-4-700x1244_ErickCedillo_9.jpg','2','N','2021-03-02 12:32:38','2021-03-02 13:14:47','M','FT12nn7_RSZTptkB4280qEVPKxb6hKsh','$2y$13$df6FswJMPunflenmEXcCieqYJSafwuZTpPMK7wSfH6ELLLw8SkWFe',NULL,'esantycc@gmail.com',10,1614706359,1614708887,'VLXEm9IHQ3ldFZXbjuZgajXXiHZs8sGr_1614706359'),(43,'Juan','Tierra',1,'0983149444',216,2,'usuario_anonimo.jpg','2','N','2021-03-12 02:13:17','2021-03-23 10:51:19','M','ijXow4BsDU04soOQNYsvbIYNIPmIqUHW','$2y$13$jhsk2GIZdzju6rcl9mAbD.azOsU60BPMND6cC6Cq1ZJGdePIU50a.',NULL,'juan_t_l@yahoo.es',9,1615533198,1616514679,'wDPG2l0k3ZA28tOakst2i4UulaV73Y_C_1615533198'),(44,'Adrian','Mogrovejo',1,'0967324834',216,2,'unnamed_AdrianMogrovejo_11.jpg','2','N','2021-03-28 00:14:49','2021-03-28 00:27:01','M','3BvHWs2t0uqE6mAj57Hc6S2PJyVb2jIR','$2y$13$InCAFYN0lIaZseUSCid0nuflpM43EVJRf2fnWTrQaM9FRgEIdQXG6',NULL,'adrianmogrovejo567@gmail.com',10,1616908489,1616909221,'oqxVgC8NsjlmMhTkiEG0XgK5k51567l7_1616908489'),(45,'Emilio Esteban','Guzman Moyano',1,'0983111210',216,2,'16017243014_93545bb450_o_Emilio EstebanGuzman Moyano_11.jpg','2','N','2021-04-09 16:08:17','2021-04-09 16:13:39','M','RLw73oC9C97qQmuZhf-8ypeliM7Eofr9','$2y$13$v3LA0PyYfYDZ8FakopfVwOh4KcUReF0hlh7d4CzYr.2tWn/ptVFjy',NULL,'eguzmanmoyano@gmail.com',10,1618002497,1618002819,'mEjbtLmDmOwmtwhlVMoNbfj3LU24JSvG_1618002497'),(46,'Emilioq','Admin',1,'0123456789',218,1,'usuario_anonimo.jpg','1','N','2021-04-09 16:58:39','2021-04-09 16:58:39','N','CduamJIZsVg0BNYc8dXq9mqvCD70qqMb','$2y$13$HoZkA7LREpV.a.FwJjqMnuQBww/YXxUkKzlq40suX0198.OU8HJPC',NULL,'esteban43415@gmail.com',10,1618005519,1618005625,'7fDowIg79dgIxmB_iw3WWiHzzzPB4dyX_1618005519');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_genero`
--

DROP TABLE IF EXISTS `user_genero`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_genero` (
  `uge_id` int(11) NOT NULL AUTO_INCREMENT,
  `uge_nombre` varchar(100) NOT NULL,
  `uge_estado` varchar(1) NOT NULL,
  `uge_fechaCreacion` datetime NOT NULL,
  `uge_fechaAudit` datetime NOT NULL,
  `uge_accion` varchar(1) NOT NULL,
  PRIMARY KEY (`uge_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_genero`
--

LOCK TABLES `user_genero` WRITE;
/*!40000 ALTER TABLE `user_genero` DISABLE KEYS */;
INSERT INTO `user_genero` VALUES (1,'Masculino','N','2020-11-10 22:31:15','2020-11-10 22:31:15','N'),(2,'Femenino','N','2020-11-10 22:31:15','2021-02-10 11:40:22','M');
/*!40000 ALTER TABLE `user_genero` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'dyac'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-04-12 16:18:08
