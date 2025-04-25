-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: localhost    Database: demo_school
-- ------------------------------------------------------
-- Server version	8.0.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";
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

SET character_set_client = 'utf8';
SET character_set_results = 'utf8';
SET character_set_connection = 'utf8';
--
-- Table structure for table `curso`
--

DROP TABLE IF EXISTS `curso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `curso` (
  `idcurso` int NOT NULL AUTO_INCREMENT,
  `cursoCodigo` varchar(8) DEFAULT NULL,
  `nonbrecurso` varchar(45) NOT NULL,
  `abbreviation` varchar(45) DEFAULT NULL,
  `components` varchar(45) DEFAULT NULL,
  `statuscurso` enum('LIBRE','ASIGNADO') NOT NULL,
  `fechaRegistro` datetime DEFAULT NULL,
  `fechaActualizacion` datetime DEFAULT NULL,
  `tipo` enum('SEMESTRAL','TRIMESTRAL','BIMESTRAL','ELECTIVO','ESTANDAR') NOT NULL,
  PRIMARY KEY (`idcurso`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `curso`
--

LOCK TABLES `curso` WRITE;
/*!40000 ALTER TABLE `curso` DISABLE KEYS */;
INSERT INTO `curso` VALUES 
(1,'C001','DIBUJO','MATH','1','LIBRE','2024-09-27 05:06:38','2024-09-28 00:00:50','SEMESTRAL'),
(2,'C002','CALEGRAFIA','PHYS','1','LIBRE','2024-09-27 05:06:38','2024-09-28 00:01:10','TRIMESTRAL'),
(3,'C003','QUÍMICA','CHEM','2','LIBRE','2024-09-27 05:06:38','2024-09-28 00:01:40','BIMESTRAL'),
(4,'C004','AMBIENTE Y TECNOLOGIA','BIO','2','LIBRE','2024-09-27 05:06:38','2024-09-28 00:02:10','ELECTIVO'),
(5,'C005','HISTORI Y GEOGRAFIA','HIST','3','LIBRE','2024-09-27 05:06:38','2024-09-28 00:02:45','ESTANDAR'),
(6,'C006','LITERATURA','LIT','3','LIBRE','2024-09-27 05:06:38','2024-09-28 00:03:03','SEMESTRAL'),
(7,'C007','IDIOMA EXTRANGERO','LEN','1','LIBRE','2024-09-27 23:03:19','2024-09-28 00:03:23','ESTANDAR'),
(8,'C008','COMUNICACION INTEGRAL','ALG','1','LIBRE','2024-09-27 23:03:19','2024-09-28 00:03:52','SEMESTRAL');
/*!40000 ALTER TABLE `curso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `activiti`
--

DROP TABLE IF EXISTS `activiti`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `activiti` (
  `idactiviti` int NOT NULL AUTO_INCREMENT,
  `yearId_act` int NOT NULL,
  `curso_act` int NOT NULL,
  `fechaCreatd` date NOT NULL,
  `status` enum('ACTIVO','INACTIVO') NOT NULL,
  `ordeperiodoTipo` int DEFAULT NULL,
  `tipo_evalu` int DEFAULT NULL,
  `User_sesion` int DEFAULT NULL,
  PRIMARY KEY (`idactiviti`),
  KEY `act_curs_idx` (`curso_act`),
  CONSTRAINT `act_curs` FOREIGN KEY (`curso_act`) REFERENCES `curso` (`idcurso`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activiti`
--

LOCK TABLES `activiti` WRITE;
/*!40000 ALTER TABLE `activiti` DISABLE KEYS */;
INSERT INTO activiti (yearId_act, curso_act, fechaCreatd, status, ordeperiodoTipo, tipo_evalu, User_sesion) VALUES
(1, 1, '2024-09-01', 'ACTIVO', 1, 4, 1),
(1, 1, '2024-09-02', 'ACTIVO', 2, 4, 1),
(1, 1, '2024-09-03', 'ACTIVO', 3, 4, 1),
(1, 1, '2024-09-04', 'ACTIVO', 4, 4, 1),
(1, 2, '2024-09-01', 'ACTIVO', 1, 4, 1),
(1, 2, '2024-09-02', 'ACTIVO', 2, 4, 1),
(1, 2, '2024-09-03', 'ACTIVO', 3, 4, 1),
(1, 2, '2024-09-04', 'ACTIVO', 4, 4, 1),
(1, 3, '2024-09-01', 'ACTIVO', 1, 4, 1),
(1, 3, '2024-09-02', 'ACTIVO', 2, 4, 1),
(1, 3, '2024-09-03', 'ACTIVO', 3, 4, 1),
(1, 3, '2024-09-04', 'ACTIVO', 4, 4, 1),
(1, 4, '2024-09-01', 'ACTIVO', 1, 4, 1),
(1, 4, '2024-09-02', 'ACTIVO', 2, 4, 1),
(1, 4, '2024-09-03', 'ACTIVO', 3, 4, 1),
(1, 4, '2024-09-04', 'ACTIVO', 4, 4, 1),
(1, 5, '2024-09-01', 'ACTIVO', 1, 4, 1),
(1, 5, '2024-09-02', 'ACTIVO', 2, 4, 1),
(1, 5, '2024-09-03', 'ACTIVO', 3, 4, 1),
(1, 5, '2024-09-04', 'ACTIVO', 4, 4, 1),
(1, 6, '2024-09-01', 'ACTIVO', 1, 4, 1),
(1, 6, '2024-09-02', 'ACTIVO', 2, 4, 1),
(1, 6, '2024-09-03', 'ACTIVO', 3, 4, 1),
(1, 6, '2024-09-04', 'ACTIVO', 4, 4, 1),
(1, 7, '2024-09-01', 'ACTIVO', 1, 4, 1),
(1, 7, '2024-09-02', 'ACTIVO', 2, 4, 1),
(1, 7, '2024-09-03', 'ACTIVO', 3, 4, 1),
(1, 7, '2024-09-04', 'ACTIVO', 4, 4, 1),
(1, 8, '2024-09-01', 'ACTIVO', 1, 4, 1),
(1, 8, '2024-09-02', 'ACTIVO', 2, 4, 1),
(1, 8, '2024-09-03', 'ACTIVO', 3, 4, 1),
(1, 8, '2024-09-04', 'ACTIVO', 4, 4, 1);
/*!40000 ALTER TABLE `activiti` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `activ_curso`
--

DROP TABLE IF EXISTS `activ_curso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `activ_curso` (
  `actcur_id` int NOT NULL AUTO_INCREMENT,
  `activ_Id` int NOT NULL,
  `actividades` varchar(255) NOT NULL,
  `puntajes` int NOT NULL,
  `cursoid` int NOT NULL,
  `fechaCreatd` date NOT NULL,
  `ordenTipoeva` int DEFAULT NULL,
  `evalu_tipo` varchar(255) DEFAULT NULL,
  `User_sesscion` int DEFAULT NULL,
  `yearId` int NOT NULL,
  PRIMARY KEY (`actcur_id`),
  KEY `avt_punt_idx` (`activ_Id`),
  CONSTRAINT `avt_punt` FOREIGN KEY (`activ_Id`) REFERENCES `activiti` (`idactiviti`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activ_curso`
--

LOCK TABLES `activ_curso` WRITE;
/*!40000 ALTER TABLE `activ_curso` DISABLE KEYS */;
INSERT INTO activ_curso (activ_Id, actividades, puntajes, cursoid, fechaCreatd, ordenTipoeva, evalu_tipo, User_sesscion, yearId) VALUES
(1, 'EXAMEN-01', 20, 1, '2024-09-15', 1, '4', 1, 1),
(1, 'PRACTICA-01', 20, 1, '2024-09-16', 1, '4', 1, 1),
(1, 'TRABAJO-01', 20, 1, '2024-09-17', 1, '4', 1, 1),
(1, 'PARCIAL-01', 20, 1, '2024-09-18', 1, '4', 1, 1),
(1, 'EXAMEN-02', 20, 1, '2024-09-19', 1, '4', 1, 1),
(2, 'EXAMEN-01', 20, 1, '2024-09-15', 2, '4', 1, 1),
(2, 'PRACTICA-01', 20, 1, '2024-09-16', 2, '4', 1, 1),
(2, 'TRABAJO-01', 20, 1, '2024-09-17', 2, '4', 1, 1),
(2, 'PARCIAL-01', 20, 1, '2024-09-18', 2, '4', 1, 1),
(2, 'EXAMEN-02', 20, 1, '2024-09-19', 2, '4', 1, 1),
(3, 'EXAMEN-01', 20, 1, '2024-09-15', 3, '4', 1, 1),
(3, 'PRACTICA-01', 20, 1, '2024-09-16', 3, '4', 1, 1),
(3, 'TRABAJO-01', 20, 1, '2024-09-17', 3, '4', 1, 1),
(3, 'PARCIAL-01', 20, 1, '2024-09-18', 3, '4', 1, 1),
(3, 'EXAMEN-02', 20, 1, '2024-09-19', 3, '4', 1, 1),
(4, 'EXAMEN-01', 20, 1, '2024-09-15', 4, '4', 1, 1),
(4, 'PRACTICA-01', 20, 1, '2024-09-16', 4, '4', 1, 1),
(4, 'TRABAJO-01', 20, 1, '2024-09-17', 4, '4', 1, 1),
(4, 'PARCIAL-01', 20, 1, '2024-09-18', 4, '4', 1, 1),
(4, 'EXAMEN-02', 20, 1, '2024-09-19', 4, '4', 1, 1),
(5, 'EXAMEN-01', 20, 2, '2024-09-15', 1, '4', 1, 1),
(5, 'PRACTICA-01', 20, 2, '2024-09-16', 1, '4', 1, 1),
(5, 'TRABAJO-01', 20, 2, '2024-09-17', 1, '4', 1, 1),
(5, 'PARCIAL-01', 20, 2, '2024-09-18', 1, '4', 1, 1),
(5, 'EXAMEN-02', 20, 2, '2024-09-19', 1, '4', 1, 1),
(6, 'PRACTICA-02', 20, 2, '2024-09-20', 2, '4', 1, 1),
(6, 'TRABAJO-02', 20, 2, '2024-09-21', 2, '4', 1, 1),
(6, 'PARCIAL-02', 20, 2, '2024-09-22', 2, '4', 1, 1),
(6, 'EXAMEN-03', 20, 2, '2024-09-23', 2, '4', 1, 1),
(6, 'PRACTICA-03', 20, 2, '2024-09-24', 2, '4', 1, 1),
(7, 'PRACTICA-02', 20, 2, '2024-09-20', 3, '4', 1, 1),
(7, 'TRABAJO-02', 20, 2, '2024-09-21', 3, '4', 1, 1),
(7, 'PARCIAL-02', 20, 2, '2024-09-22', 3, '4', 1, 1),
(7, 'EXAMEN-03', 20, 2, '2024-09-23', 3, '4', 1, 1),
(7, 'PRACTICA-03', 20, 2, '2024-09-24', 3, '4', 1, 1),
(8, 'PRACTICA-02', 20, 2, '2024-09-20', 4, '4', 1, 1),
(8, 'TRABAJO-02', 20, 2, '2024-09-21', 4, '4', 1, 1),
(8, 'PARCIAL-02', 20, 2, '2024-09-22', 4, '4', 1, 1),
(8, 'EXAMEN-03', 20, 2, '2024-09-23', 4, '4', 1, 1),
(8, 'PRACTICA-03', 20, 2, '2024-09-24', 4, '4', 1, 1),
(9, 'EXAMEN-01', 20, 3, '2024-09-15', 1, '4', 1, 1),
(9, 'PRACTICA-01', 20, 3, '2024-09-16', 1, '4', 1, 1),
(9, 'TRABAJO-01', 20, 3, '2024-09-17', 1, '4', 1, 1),
(9, 'PARCIAL-01', 20, 3, '2024-09-18', 1, '4', 1, 1),
(9, 'EXAMEN-02', 20, 3, '2024-09-19', 1, '4', 1, 1),
(10, 'PRACTICA-02', 20, 3, '2024-09-20', 2, '4', 1, 1),
(10, 'TRABAJO-02', 20, 3, '2024-09-21', 2, '4', 1, 1),
(10, 'PARCIAL-02', 20, 3, '2024-09-22', 2, '4', 1, 1),
(10, 'EXAMEN-03', 20, 3, '2024-09-23', 2, '4', 1, 1),
(10, 'PRACTICA-03', 20, 3, '2024-09-24', 2, '4', 1, 1),
(11, 'PRACTICA-02', 20, 3, '2024-09-20', 3, '4', 1, 1),
(11, 'TRABAJO-02', 20, 3, '2024-09-21', 3, '4', 1, 1),
(11, 'PARCIAL-02', 20, 3, '2024-09-22', 3, '4', 1, 1),
(11, 'EXAMEN-03', 20, 3, '2024-09-23', 3, '4', 1, 1),
(11, 'PRACTICA-03', 20, 3, '2024-09-24', 3, '4', 1, 1),
(12, 'PRACTICA-02', 20, 3, '2024-09-20', 4, '4', 1, 1),
(12, 'TRABAJO-02', 20, 3, '2024-09-21', 4, '4', 1, 1),
(12, 'PARCIAL-02', 20, 3, '2024-09-22', 4, '4', 1, 1),
(12, 'EXAMEN-03', 20, 3, '2024-09-23', 4, '4', 1, 1),
(12, 'PRACTICA-03', 20, 3, '2024-09-24', 4, '4', 1, 1),
(13, 'EXAMEN-01', 20, 4, '2024-09-15', 1, '4', 1, 1),
(13, 'PRACTICA-01', 20, 4, '2024-09-16', 1, '4', 1, 1),
(13, 'TRABAJO-01', 20, 4, '2024-09-17', 1, '4', 1, 1),
(13, 'PARCIAL-01', 20, 4, '2024-09-18', 1, '4', 1, 1),
(13, 'EXAMEN-02', 20, 4, '2024-09-19', 1, '4', 1, 1),
(14, 'PRACTICA-02', 20, 4, '2024-09-20', 2, '4', 1, 1),
(14, 'TRABAJO-02', 20, 4, '2024-09-21', 2, '4', 1, 1),
(14, 'PARCIAL-02', 20, 4, '2024-09-22', 2, '4', 1, 1),
(14, 'EXAMEN-03', 20, 4, '2024-09-23', 2, '4', 1, 1),
(14, 'PRACTICA-03', 20, 4, '2024-09-24', 2, '4', 1, 1),
(15, 'PRACTICA-02', 20, 4, '2024-09-20', 3, '4', 1, 1),
(15, 'TRABAJO-02', 20, 4, '2024-09-21', 3, '4', 1, 1),
(15, 'PARCIAL-02', 20, 4, '2024-09-22', 3, '4', 1, 1),
(15, 'EXAMEN-03', 20, 4, '2024-09-23', 3, '4', 1, 1),
(15, 'PRACTICA-03', 20, 4, '2024-09-24', 3, '4', 1, 1),
(16, 'PRACTICA-02', 20, 4, '2024-09-20', 4, '4', 1, 1),
(16, 'TRABAJO-02', 20, 4, '2024-09-21', 4, '4', 1, 1),
(16, 'PARCIAL-02', 20, 4, '2024-09-22', 4, '4', 1, 1),
(16, 'EXAMEN-03', 20, 4, '2024-09-23', 4, '4', 1, 1),
(16, 'PRACTICA-03', 20, 4, '2024-09-24', 4, '4', 1, 1),
(17, 'EXAMEN-01', 20, 5, '2024-09-15', 1, '4', 1, 1),
(17, 'PRACTICA-01', 20, 5, '2024-09-16', 1, '4', 1, 1),
(17, 'TRABAJO-01', 20, 5, '2024-09-17', 1, '4', 1, 1),
(17, 'PARCIAL-01', 20, 5, '2024-09-18', 1, '4', 1, 1),
(17, 'EXAMEN-02', 20, 5, '2024-09-19', 1, '4', 1, 1),
(18, 'PRACTICA-02', 20, 5, '2024-09-20', 2, '4', 1, 1),
(18, 'TRABAJO-02', 20, 5, '2024-09-21', 2, '4', 1, 1),
(18, 'PARCIAL-02', 20, 5, '2024-09-22', 2, '4', 1, 1),
(18, 'EXAMEN-03', 20, 5, '2024-09-23', 2, '4', 1, 1),
(18, 'PRACTICA-03', 20, 5, '2024-09-24', 2, '4', 1, 1),
(19, 'TRABAJO-03', 20, 5, '2024-09-25', 3, '4', 1, 1),
(19, 'PARCIAL-03', 20, 5, '2024-09-26', 3, '4', 1, 1),
(19, 'EXAMEN-04', 20, 5, '2024-09-27', 3, '4', 1, 1),
(19, 'PRACTICA-04', 20, 5, '2024-09-28', 3, '4', 1, 1),
(19, 'TRABAJO-04', 20, 5, '2024-09-29', 3, '4', 1, 1),
(20, 'PARCIAL-04', 20, 5, '2024-09-30', 4, '4', 1, 1),
(20, 'EXAMEN-05', 20, 5, '2024-10-01', 4, '4', 1, 1),
(20, 'PRACTICA-05', 20, 5, '2024-10-02', 4, '4', 1, 1),
(20, 'TRABAJO-05', 20, 5, '2024-10-03', 4, '4', 1, 1),
(20, 'PARCIAL-05', 20, 5, '2024-10-04', 4, '4', 1, 1),
(21, 'EXAMEN-01', 20, 6, '2024-09-15', 1, '4', 1, 1),
(21, 'PRACTICA-01', 20, 6, '2024-09-16', 1, '4', 1, 1),
(21, 'TRABAJO-01', 20, 6, '2024-09-17', 1, '4', 1, 1),
(21, 'EXAMEN-02', 20, 6, '2024-09-18', 1, '4', 1, 1),
(21, 'PRACTICA-02', 20, 6, '2024-09-19', 1, '4', 1, 1),
(22, 'TRABAJO-01', 20, 6, '2024-09-20', 2, '4', 1, 1),
(22, 'EXAMEN-03', 20, 6, '2024-09-21', 2, '4', 1, 1),
(22, 'PRACTICA-03', 20, 6, '2024-09-22', 2, '4', 1, 1),
(22, 'TRABAJO-02', 20, 6, '2024-09-23', 2, '4', 1, 1),
(22, 'EXAMEN-04', 20, 6, '2024-09-24', 2, '4', 1, 1),
(23, 'PRACTICA-04', 20, 6, '2024-09-25', 3, '4', 1, 1),
(23, 'TRABAJO-03', 20, 6, '2024-09-26', 3, '4', 1, 1),
(23, 'EXAMEN-05', 20, 6, '2024-09-27', 3, '4', 1, 1),
(23, 'PRACTICA-05', 20, 6, '2024-09-28', 3, '4', 1, 1),
(23, 'TRABAJO-04', 20, 6, '2024-09-29', 3, '4', 1, 1),
(24, 'EXAMEN-06', 20, 6, '2024-09-30', 4, '4', 1, 1),
(24, 'PRACTICA-06', 20, 6, '2024-10-01', 4, '4', 1, 1),
(24, 'TRABAJO-05', 20, 6, '2024-10-02', 4, '4', 1, 1),
(24, 'EXAMEN-07', 20, 6, '2024-10-03', 4, '4', 1, 1),
(24, 'PRACTICA-07', 20, 6, '2024-10-04', 4, '4', 1, 1),
(25, 'EXAMENS', 20, 7, '2024-09-30', 1, '4', 1, 1),
(25, 'PRACTICAS', 20, 7, '2024-10-01', 1, '4', 1, 1),
(25, 'TRABAJOS', 20, 7, '2024-10-02', 1, '4', 1, 1),
(25, 'EXAMENS', 20, 7, '2024-10-03', 1, '4', 1, 1),
(25, 'PRACTICAS', 20, 7, '2024-10-04', 1, '4', 1, 1),
(26, 'EXAMENS', 20, 7, '2024-09-30', 2, '4', 1, 1),
(26, 'PRACTICAS', 20, 7, '2024-10-01', 2, '4', 1, 1),
(26, 'TRABAJOS', 20, 7, '2024-10-02', 2, '4', 1, 1),
(26, 'EXAMENS', 20, 7, '2024-10-03', 2, '4', 1, 1),
(26, 'PRACTICAS', 20, 7, '2024-10-04', 2, '4', 1, 1),
(27, 'EXAMENS', 20, 7, '2024-09-30', 3, '4', 1, 1),
(27, 'PRACTICAS', 20, 7, '2024-10-01', 3, '4', 1, 1),
(27, 'TRABAJOS', 20, 7, '2024-10-02', 3, '4', 1, 1),
(27, 'EXAMENS', 20, 7, '2024-10-03', 3, '4', 1, 1),
(27, 'PRACTICAS', 20, 7, '2024-10-04', 3, '4', 1, 1),
(28, 'EXAMENS', 20, 7, '2024-09-30', 4, '4', 1, 1),
(28, 'PRACTICAS', 20, 7, '2024-10-01', 4, '4', 1, 1),
(28, 'TRABAJOS', 20, 7, '2024-10-02', 4, '4', 1, 1),
(28, 'EXAMENS', 20, 7, '2024-10-03', 4, '4', 1, 1),
(28, 'PRACTICAS', 20, 7, '2024-10-04', 4, '4', 1, 1),
(29, 'EXAMENS', 20, 8, '2024-09-30', 1, '4', 1, 1),
(29, 'PRACTICAS', 20, 8, '2024-10-01', 1, '4', 1, 1),
(29, 'TRABAJOS', 20, 8, '2024-10-02', 1, '4', 1, 1),
(29, 'EXAMENS', 20, 8, '2024-10-03', 1, '4', 1, 1),
(29, 'PRACTICAS', 20, 8, '2024-10-04', 1, '4', 1, 1),
(30, 'EXAMENS', 20, 8, '2024-09-30', 2, '4', 1, 1),
(30, 'PRACTICAS', 20, 8, '2024-10-01', 2, '4', 1, 1),
(30, 'TRABAJOS', 20, 8, '2024-10-02', 2, '4', 1, 1),
(30, 'EXAMENS', 20, 8, '2024-10-03', 2, '4', 1, 1),
(30, 'PRACTICAS', 20, 8, '2024-10-04', 2, '4', 1, 1),
(31, 'EXAMENS', 20, 8, '2024-09-30', 3, '4', 1, 1),
(31, 'PRACTICAS', 20, 8, '2024-10-01', 3, '4', 1, 1),
(31, 'TRABAJOS', 20, 8, '2024-10-02', 3, '4', 1, 1),
(31, 'EXAMENS', 20, 8, '2024-10-03', 3, '4', 1, 1),
(31, 'PRACTICAS', 20, 8, '2024-10-04', 3, '4', 1, 1),
(32, 'EXAMENS', 20, 8, '2024-09-30', 4, '4', 1, 1),
(32, 'PRACTICAS', 20, 8, '2024-10-01', 4, '4', 1, 1),
(32, 'TRABAJOS', 20, 8, '2024-10-02', 4, '4', 1, 1),
(32, 'EXAMENS', 20, 8, '2024-10-03', 4, '4', 1, 1),
(32, 'PRACTICAS', 20, 8, '2024-10-04', 4, '4', 1, 1);
/*!40000 ALTER TABLE `activ_curso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `alumno`
--

DROP TABLE IF EXISTS `alumno`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `alumno` (
  `idalumno` int NOT NULL AUTO_INCREMENT,
  `apellidos` varchar(45) DEFAULT NULL,
  `alumnonombre` varchar(45) DEFAULT NULL,
  `dni` int DEFAULT NULL,
  `telefono` int DEFAULT NULL,
  `codigo` int DEFAULT NULL,
  `sexo` char(1) DEFAULT NULL,
  `fnacimiento` date DEFAULT NULL,
  `stadoalumno` enum('ACTIVO','INACTIVO') NOT NULL,
  `fechaRegisto` date DEFAULT NULL,
  `fechaUpdate` date DEFAULT NULL,
  `direccion` varchar(45) DEFAULT NULL,
  `rolalumno` int NOT NULL,
  `alumno_foto` text,
  `bajaAlumn` enum('1','0') NOT NULL,
  `mail` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `age` int DEFAULT NULL,
  `province` varchar(255) DEFAULT NULL,
  `municipality` varchar(255) DEFAULT NULL,
  `others` varchar(255) DEFAULT NULL,
  `planeStudy` varchar(255) DEFAULT NULL,
  `especiality` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idalumno`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alumno`
--

LOCK TABLES `alumno` WRITE;
/*!40000 ALTER TABLE `alumno` DISABLE KEYS */;
INSERT INTO alumno (apellidos, alumnonombre, dni, telefono, codigo, sexo, fnacimiento, stadoalumno, fechaRegisto, fechaUpdate, direccion, rolalumno, alumno_foto, bajaAlumn, mail, country, age, province, municipality, others, planeStudy, especiality) VALUES
('GONZALEZ PEREZ', 'JUAN', 12345678, 987654321, 1001, 'M', '2000-01-15', 'ACTIVO', '2024-09-01', NULL, '123 Main St', 3, 'usuarios/images.png', '1', 'juan.gonzalez@example.com', 'MEXICO', 24, 'MADRID', 'MADRID', 'lugar-nacimiento', 'COMPUTER SCIENCE', 'SOFTWARE ENGINEERING'),
('HERNANDEZ RAMIREZ', 'MARIA', 87654321, 123456789, 1002, 'F', '1999-05-22', 'ACTIVO', '2024-09-02', NULL, '456 Elm St', 3, 'usuarios/images.png', '1', 'maria.hernandez@example.com', 'VENEZUELA', 25, 'BARCELONA', 'BARCELONA', 'lugar-nacimiento', 'BUSINESS ADMINISTRATION', 'MARKETING'),
('LOPEZ GARCIA', 'CARLOS', 11223344, 987654320, 1003, 'M', '2001-02-10', 'ACTIVO', '2024-09-03', NULL, '789 Pine St', 3, 'usuarios/images.png', '1', 'carlos.lopez@example.com', 'COLOMBIA', 23, 'CALI', 'VALLE', 'lugar-nacimiento', 'MECHANICAL ENGINEERING', 'DESIGN'),
('MARTINEZ FERRER', 'LAURA', 22334455, 123456789, 1004, 'F', '1998-06-15', 'ACTIVO', '2024-09-04', NULL, '321 Oak St', 3, 'usuarios/images.png', '1', 'laura.martinez@example.com', 'PERU', 26, 'LIMA', 'LIMA', 'lugar-nacimiento', 'MEDICINE', 'SURGERY'),
('TORO JIMENEZ', 'ANDRES', 33445566, 987654321, 1005, 'M', '1997-03-25', 'ACTIVO', '2024-09-05', NULL, '654 Cedar St', 3, 'usuarios/images.png', '1', 'andres.toro@example.com', 'ARGENTINA', 27, 'BUENOS AIRES', 'FEDERAL', 'lugar-nacimiento', 'LAW', 'CRIMINAL LAW'),
('MARTINEZ PULIDO', 'ISABEL', 44556677, 123456789, 1006, 'F', '2000-12-30', 'ACTIVO', '2024-09-06', NULL, '987 Maple St', 3, 'usuarios/images.png', '1', 'isabel.martinez@example.com', 'CHILE', 24, 'SANTIAGO', 'METROPOLITANA', 'lugar-nacimiento', 'ARCHITECTURE', 'URBAN PLANNING'),
('GARCIA HERRERA', 'PABLO', 55667788, 987654321, 1007, 'M', '1999-08-05', 'ACTIVO', '2024-09-07', NULL, '159 Birch St', 3, 'usuarios/images.png', '1', 'pablo.garcia@example.com', 'ECUADOR', 25, 'QUITO', 'PICHINCHA', 'lugar-nacimiento', 'ELECTRICAL ENGINEERING', 'POWER SYSTEMS'),
('FLORES MARTINEZ', 'NATALIA', 66778899, 123456789, 1008, 'F', '2002-11-11', 'ACTIVO', '2024-09-08', NULL, '753 Spruce St', 3, 'usuarios/images.png', '1', 'natalia.flores@example.com', 'BOLIVIA', 22, 'LA PAZ', 'LA PAZ', 'lugar-nacimiento', 'DENTISTRY', 'ORTHODONTICS'),
('CASTILLO MUÑOZ', 'DIEGO', 77889900, 987654321, 1009, 'M', '2003-04-20', 'ACTIVO', '2024-09-09', NULL, '852 Fir St', 3, 'usuarios/images.png', '1', 'diego.castillo@example.com', 'URUGUAY', 21, 'MONTEVIDEO', 'MONTEVIDEO', 'lugar-nacimiento', 'PHYSICS', 'ASTROPHYSICS');

/*!40000 ALTER TABLE `alumno` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `apoderados`
--

DROP TABLE IF EXISTS `apoderados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `apoderados` (
  `idApoderado` int NOT NULL AUTO_INCREMENT,
  `paderNombre` varchar(45) DEFAULT NULL,
  `PadreApellidos` varchar(45) DEFAULT NULL,
  `padreDni` varchar(45) DEFAULT NULL,
  `madreNombres` varchar(45) DEFAULT NULL,
  `madreApellidos` varchar(45) DEFAULT NULL,
  `madreDni` varchar(45) DEFAULT NULL,
  `cole_procedente` varchar(255) DEFAULT NULL,
  `coleUbicacion` varchar(45) DEFAULT NULL,
  `coleCodigo` varchar(255) DEFAULT NULL,
  `dateCreat` date DEFAULT NULL,
  `dateUpdate` date DEFAULT NULL,
  `id_Alumn` int DEFAULT NULL,
  PRIMARY KEY (`idApoderado`),
  KEY `alumn_apo_idx` (`id_Alumn`),
  CONSTRAINT `alumn_apo` FOREIGN KEY (`id_Alumn`) REFERENCES `alumno` (`idalumno`) ON DELETE CASCADE ON UPDATE CASCADE
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `apoderados`
--

LOCK TABLES `apoderados` WRITE;
/*!40000 ALTER TABLE `apoderados` DISABLE KEYS */;
/*!40000 ALTER TABLE `apoderados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `asistencia`
--

DROP TABLE IF EXISTS `asistencia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `asistencia` (
  `IdAsisten` int unsigned NOT NULL AUTO_INCREMENT,
  `idalumno_asi` int NOT NULL,
  `Fechas` date NOT NULL,
  `Est_Asis` tinyint(1) NOT NULL,
  `idgrado` int DEFAULT NULL,
  `idnivel` int DEFAULT NULL,
  `idseccion` varchar(10) DEFAULT NULL,
  `yearid` int DEFAULT NULL,
  `userSesion` int DEFAULT NULL,
  PRIMARY KEY (`IdAsisten`),
  KEY `alum_asist_idx` (`idalumno_asi`),
  CONSTRAINT `alum_asist` FOREIGN KEY (`idalumno_asi`) REFERENCES `alumno` (`idalumno`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asistencia`
--

LOCK TABLES `asistencia` WRITE;
/*!40000 ALTER TABLE `asistencia` DISABLE KEYS */;
/*!40000 ALTER TABLE `asistencia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `aula`
--

DROP TABLE IF EXISTS `aula`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `aula` (
  `idaula` int NOT NULL AUTO_INCREMENT,
  `nombreaula` varchar(45) NOT NULL,
  `piso` int NOT NULL,
  `numero` int NOT NULL,
  `aforro` int NOT NULL,
  `status` enum('LIBRE','OCUPADO') DEFAULT NULL,
  `dateCreat` date NOT NULL,
  `dateUpdate` date NOT NULL,
  PRIMARY KEY (`idaula`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aula`
--

LOCK TABLES `aula` WRITE;
/*!40000 ALTER TABLE `aula` DISABLE KEYS */;
INSERT INTO `aula` VALUES
 (1,'ABC',1,504,28,'OCUPADO','2023-01-23','2024-09-28'),(2,'DEF',1,506,32,'OCUPADO','2023-01-23','2024-09-28'),
 (3,'GHI',1,505,24,'OCUPADO','2023-01-23','2024-09-28'),(4,'JKL',1,507,18,'OCUPADO','2023-01-23','2024-09-28'),
 (5,'MNO',1,508,22,'LIBRE','2023-01-23','2023-01-23'),(6,'PQR',1,509,20,'LIBRE','2023-01-23','2023-01-23'),
 (7,'STU',1,502,26,'LIBRE','2023-01-23','2023-01-23'),(8,'VWX',1,509,21,'LIBRE','2023-01-23','2023-01-23'),
 (9,'XYZ',1,501,26,'LIBRE','2023-01-23','2023-01-23'),(10,'AAB',2,404,21,'LIBRE','2023-01-24','2023-01-24'),
 (11,'AAC',2,405,26,'LIBRE','2023-01-24','2023-01-24'),(12,'AAD',2,406,25,'LIBRE','2023-01-24','2023-01-24'),
 (13,'AAE',2,407,26,'LIBRE','2023-01-24','2023-01-24'),(14,'AAF',2,408,22,'LIBRE','2023-01-24','2023-01-24'),
 (15,'AAG',2,409,20,'LIBRE','2023-01-24','2023-01-24'),(16,'AAH',2,500,24,'LIBRE','2023-01-24','2023-01-24'),
 (17,'AAI',2,501,23,'LIBRE','2023-01-24','2023-01-24'),(18,'AAJ',2,502,28,'LIBRE','2023-01-24','2023-01-24'),
 (19,'AAK',2,503,21,'LIBRE','2023-01-24','2023-01-24'),(20,'INI I',1,701,12,'LIBRE','2023-01-24','2023-01-24'),
 (21,'INI II',1,702,18,'LIBRE','2023-01-24','2023-01-24'),(22,'INI III',1,703,19,'LIBRE','2023-01-24','2023-01-24');
/*!40000 ALTER TABLE `aula` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `colegio`
--

DROP TABLE IF EXISTS `colegio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `colegio` (
  `idColegio` int NOT NULL AUTO_INCREMENT,
  `nameColegio` varchar(255) DEFAULT NULL,
  `telefColegio` int DEFAULT NULL,
  `emailColegio` varchar(45) DEFAULT NULL,
  `ubicacion` text DEFAULT NULL,
  `logoColegio` text,
  `escudoPais` text,
  `bannerColegio` text,
  `idiomaColegio` varchar(45) DEFAULT NULL,
  `colorSidebar` varchar(45) DEFAULT NULL,
  `colorHeader` varchar(45) DEFAULT NULL,
  `yearCeation` date DEFAULT NULL,
  `descrition` text,
  `ugel` varchar(45) DEFAULT NULL,
  `municipio` varchar(255) DEFAULT NULL,
  `txt_ep` varchar(255) DEFAULT NULL,
  `txt_code` varchar(255) DEFAULT NULL,
  `federal` varchar(255) DEFAULT NULL,
  `txt_cdcee` varchar(255) DEFAULT NULL,
  `denomination` varchar(255) DEFAULT NULL,
  `identity` varchar(255) DEFAULT NULL,
  `directors` varchar(255) DEFAULT NULL,
  `dateCreate` date DEFAULT NULL,
  `dateUpdate` date DEFAULT NULL,
  PRIMARY KEY (`idColegio`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `colegio`
--

LOCK TABLES `colegio` WRITE;
/*!40000 ALTER TABLE `colegio` DISABLE KEYS */;
INSERT INTO `colegio` VALUES (1,'COLEGIO NACIONAL',964706345,'saep@gmail.com','AV. PRINCIPAL 123','logotipo290924055943.jpg','pais290924055943.jpg','banner.png','Español','#FFFFFF','#000000','2020-01-01','Un colegio que brinda educación de calidad.','UGEL 123','LIMA','Texto EP','Texto Code','Federal','Texto CDCEE','Denominación','Identidad','DIRECTOR','2024-09-01','2024-09-27');
/*!40000 ALTER TABLE `colegio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `niveles`
--

DROP TABLE IF EXISTS `niveles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `niveles` (
  `idniveles` int NOT NULL AUTO_INCREMENT,
  `nombreNivell` varchar(45) NOT NULL,
  `yearNivel` int DEFAULT NULL,
  `createDate` date DEFAULT NULL,
  PRIMARY KEY (`idniveles`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `niveles`
--

LOCK TABLES niveles WRITE;
/*!40000 ALTER TABLE niveles DISABLE KEYS */;
INSERT INTO niveles VALUES
 (1,'PRIMARIA',1,'2022-11-06'),(2,'SECUNDARIA',1,'2022-11-06'),
 (3,'SUPERIOR',1,'2022-11-06'),(4,'INICIAL',1,'2022-11-06');
/*!40000 ALTER TABLE niveles ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `criterio`
--

DROP TABLE IF EXISTS `criterio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `criterio` (
  `idboletNota` int NOT NULL AUTO_INCREMENT,
  `criteriosEvaluacion` text NOT NULL,
  `curso_id` int NOT NULL,
  `grado_id` int NOT NULL,
  `yearEscolar_id` int NOT NULL,
  `idnivel` int DEFAULT NULL,
  `fechRegistro` date NOT NULL,
  `userSession` int DEFAULT NULL,
  `fechaUpdate` date DEFAULT NULL,
  PRIMARY KEY (`idboletNota`)
) ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `criterio`
--

LOCK TABLES `criterio` WRITE;
/*!40000 ALTER TABLE `criterio` DISABLE KEYS */;
INSERT INTO criterio (idboletNota, criteriosEvaluacion, curso_id, grado_id, yearEscolar_id, idnivel, fechRegistro, userSession, fechaUpdate) VALUES
(1,'Construye su identidad.',1,1,1,4,'2025-01-01',1,'2025-01-01'),
(2,'Convive y participa democráticamente en la busqueda del bien común.',1,1,1,4,'2025-01-01',1,'2025-01-01'),
(3,'Construe interpretaciones históricas. ',1,1,1,4,'2025-01-01',1,'2025-01-01'),
(4,'Gestiona responsablemente el espacio y el ambiente.',2,1,1,4,'2025-01-01',1,'2025-01-01'),
(5,'Gestiona responsablemente los recursos económicos.',2,1,1,4,'2025-01-01',1,'2025-01-01'),
(6,'Se desenvuelve de manera autónoma a través de su motricidad. ',2,1,1,4,'2025-01-01',1,'2025-01-01'),

(7,'Asume una vida saludable. ',3,2,1,1,'2025-01-01',1,'2025-01-01'),
(8,'Interactua a través de sus habilidades sociomotrices.',3,2,1,1,'2025-01-01',1,'2025-01-01'),
(9,'Se comunica oralmente en su lengua materna.',3,2,1,1,'2025-01-01',1,'2025-01-01'),
(10,'Resuelve problemas de gestión de datos e incertidumbre.',4,2,1,1,'2025-01-01',1,'2025-01-01'),
(11,'Escribe diversos tipos de texto en su lengua materna.',4,2,1,1,'2025-01-01',1,'2025-01-01'),
(13,'Se comunica oralmente en castellano como segunda lengua.',4,2,1,1,'2025-01-01',1,'2025-01-01'),

(14,'Lee diversos tipos de textos escritos en castellano como segunda lengua.',5,3,1,2,'2025-01-01',1,'2025-01-01'),
(15,'Escribe diversos tipos de textos en castellano como segunda lengua.',5,3,1,2,'2025-01-01',1,'2025-01-01'),
(16,'Aprecia de manera crítica manifestaciones artístico - culturales.',5,3,1,2,'2025-01-01',1,'2025-01-01'),
(17,'Crea proyectos desde los lenguajes artísticos. ',6,3,1,2,'2025-01-01',1,'2025-01-01'),
(18,'Castellano como segunda lengua  Se comunica oralmente en castellano como segunda lengua. ',6,3,1,2,'2025-01-01',1,'2025-01-01'),
(19,'Indaga mediante métodos científicos para construir sus conocimiento. ',6,3,1,2,'2025-01-01',1,'2025-01-01'),

(20,'Escribe diversos tipos de texto en castellano como segunda lengua. ',7,4,1,3,'2025-01-01',1,'2025-01-01'),
(21,'Resuelve problemas de cantidad.',7,4,1,3,'2025-01-01',1,'2025-01-01'),
(22,'Resuelve problemas de regularidad.',7,4,1,3,'2025-01-01',1,'2025-01-01'),
(24,'Indaga mediante métodos científicos para construir sus conocimientos.',8,4,1,3,'2025-01-01',1,'2025-01-01'),
(25,'Explica el mundo físico basándose en conocimientos sobre los seres vivos',8,4,1,3,'2025-01-01',1,'2025-01-01'),
(26,' Aprecia de manera crítica manifestaciones artístico',8,4,1,3,'2025-01-01',1,'2025-01-01');


/*!40000 ALTER TABLE `criterio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `docente_curso`
--

DROP TABLE IF EXISTS `docente_curso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `docente_curso` (
  `iddocenteCurso` int NOT NULL AUTO_INCREMENT,
  `idDocente` int DEFAULT NULL,
  `idGrado` int DEFAULT NULL,
  `idCursos` int DEFAULT NULL,
  `idyear` int DEFAULT NULL,
  `Seccion` varchar(25) DEFAULT NULL,
  `idSession` int DEFAULT NULL,
  `createDate` date DEFAULT NULL,
  `updateDate` date DEFAULT NULL,
  PRIMARY KEY (`iddocenteCurso`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `docente_curso`
--

LOCK TABLES `docente_curso` WRITE;
/*!40000 ALTER TABLE `docente_curso` DISABLE KEYS */;
INSERT INTO `docente_curso` VALUES
 (1,1,1,1,1,'A',NULL,'2024-09-27',NULL),(2,1,1,2,1,'A',NULL,'2024-09-27',NULL),
 (3,2,2,3,1,'B',NULL,'2024-09-27',NULL),(4,2,2,4,1,'B',NULL,'2024-09-27',NULL),
 (5,3,3,5,1,'C',NULL,'2024-09-27',NULL),(6,3,3,6,1,'C',NULL,'2024-09-27',NULL),
 (7,4,4,7,1,'D',NULL,NULL,'2024-09-27'),(8,4,4,8,1,'D',NULL,NULL,'2024-09-27');
/*!40000 ALTER TABLE `docente_curso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `docente_grados`
--

DROP TABLE IF EXISTS `docente_grados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `docente_grados` (
  `iddocentGrados` int NOT NULL AUTO_INCREMENT,
  `docenteId` int DEFAULT NULL,
  `gradoId` int DEFAULT NULL,
  `nivelgradiId` int DEFAULT NULL,
  `idseccion` varchar(45) DEFAULT NULL,
  `yearId` int DEFAULT NULL,
  `sesionId` int DEFAULT NULL,
  `createDate` date DEFAULT NULL,
  PRIMARY KEY (`iddocentGrados`)
) ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `docente_grados`
--

LOCK TABLES `docente_grados` WRITE;
/*!40000 ALTER TABLE `docente_grados` DISABLE KEYS */;
INSERT INTO `docente_grados` VALUES
 (1,1,1,4,'A',1,0,'2024-09-27'),
 (2,2,2,1,'B',1,0,'2024-09-27'),
 (3,3,3,2,'C',1,0,'2024-09-27'),
 (4,4,4,3,'D',1,0,'2024-09-27');
/*!40000 ALTER TABLE `docente_grados` ENABLE KEYS */;
UNLOCK TABLES;




--
-- Table structure for table `docentes`
--

DROP TABLE IF EXISTS `docentes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `docentes` (
  `id_docente` int NOT NULL AUTO_INCREMENT,
  `nombres` varchar(45) NOT NULL,
  `apellidos` varchar(45) DEFAULT NULL,
  `dni` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  `codigo` varchar(45) DEFAULT NULL,
  `rolDocente` int DEFAULT NULL,
  `nivelId` int DEFAULT NULL,
  `tipo_docente` enum('CONTRATADO','NOMBRADO') DEFAULT NULL,
  `estado_baja` enum('1','0') NOT NULL,
  `createDate` date DEFAULT NULL,
  `updateDate` date DEFAULT NULL,
  `userSession` int DEFAULT NULL,
  PRIMARY KEY (`id_docente`),
  UNIQUE KEY `dni_UNIQUE` (`dni`),
  UNIQUE KEY `codigo_UNIQUE` (`codigo`),
  UNIQUE KEY `email_UNIQUE` (`email`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `docentes`
--

LOCK TABLES `docentes` WRITE;
/*!40000 ALTER TABLE `docentes` DISABLE KEYS */;
INSERT INTO `docentes` VALUES 
(1,'DANTE','OCHOA DALTONN','58542357','dante@gamil.com','6780654','0634520',2,4,'CONTRATADO','1','2023-01-23','2024-09-27',NULL),
(2,'ANA MELVA','DIONICIO GONZALES','44895603','César@gamil.com','6780654','00202394',2,1,'CONTRATADO','1','2023-01-23',NULL,NULL),
(3,'CÉSAR EDUARDO','IDROGO MARIÑO','70015802','Edgar@gamil.com','6780654','00202395',2,2,'CONTRATADO','1','2023-01-23',NULL,NULL),
(4,'JORGE ANDRÉS',' LECCA   VELÁSQUEZ','71870975','Eliza@gamil.com','6780654','00202396',2,3,'CONTRATADO','1','2023-01-23','2024-09-27',NULL);
/*!40000 ALTER TABLE `docentes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `faseescolar`
--

DROP TABLE IF EXISTS `faseescolar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `faseescolar` (
  `fase_id` int NOT NULL AUTO_INCREMENT,
  `idyearE` int NOT NULL,
  `fase_nombre` varchar(45) DEFAULT NULL,
  `FechaInicial` date DEFAULT NULL,
  `FechaFinal` date DEFAULT NULL,
  `stdfase` enum('ACTIVO','INACTIVO') DEFAULT NULL,
  PRIMARY KEY (`fase_id`)
) ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faseescolar`
--

LOCK TABLES `faseescolar` WRITE;
/*!40000 ALTER TABLE `faseescolar` DISABLE KEYS */;
INSERT INTO `faseescolar` VALUES (1,1,'FASE REGULAR','2025-09-27','2025-02-27','ACTIVO'),
(2,1,'FASE RECUPERACION','2025-12-27','2025-10-27','ACTIVO');
/*!40000 ALTER TABLE `faseescolar` ENABLE KEYS */;
UNLOCK TABLES;


--
-- Table structure for table `grado`
--

DROP TABLE IF EXISTS `grado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `grado` (
  `idgrado` int NOT NULL AUTO_INCREMENT,
  `gradonombre` varchar(45) NOT NULL,
  `aula_id` int NOT NULL,
  `turno_id` int NOT NULL,
  `nivel_id` int DEFAULT NULL,
  `vacantes` int DEFAULT NULL,
  `seccion` varchar(45) DEFAULT NULL,
  `fechaRegistro` datetime DEFAULT NULL,
  `fechaActualizacion` datetime DEFAULT NULL,
  `gradostatus` enum('ACTIVO','INACTIVO') DEFAULT NULL,
  `year_id` int DEFAULT NULL,
  PRIMARY KEY (`idgrado`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grado`
--

LOCK TABLES `grado` WRITE;
/*!40000 ALTER TABLE `grado` DISABLE KEYS */;
INSERT INTO `grado` VALUES 
(1,'PRIMERO GRADO ',1,5,4,28,'A','2024-09-27 05:06:39','2024-09-27 00:15:27','ACTIVO',1),
(2,'PRIMER GRADO ',2,1,1,26,'B','2024-09-27 05:06:39','2024-09-27 00:15:38','ACTIVO',1),
(3,'PRIMER GRADO ',3,1,2,23,'C','2024-09-27 05:06:39','2024-09-27 00:15:47','ACTIVO',1),
(4,'PRIMER GRADO',4,1,3,25,'D','2024-09-27 05:06:39','2024-09-27 00:15:58','ACTIVO',1);
/*!40000 ALTER TABLE `grado` ENABLE KEYS */;
UNLOCK TABLES;



--
-- Table structure for table `grado_curso`
--

DROP TABLE IF EXISTS `grado_curso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `grado_curso` (
  `idgrado_curso` int NOT NULL AUTO_INCREMENT,
  `grado_id` int NOT NULL,
  `curso_id` int NOT NULL,
  `yearEscolar` int NOT NULL,
  `Idseccion` varchar(45) DEFAULT NULL,
  `dateRegistro` date DEFAULT NULL,
  `dateUpdate` date DEFAULT NULL,
  PRIMARY KEY (`idgrado_curso`)
) ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grado_curso`
--

LOCK TABLES `grado_curso` WRITE;
/*!40000 ALTER TABLE `grado_curso` DISABLE KEYS */;
INSERT INTO `grado_curso` VALUES (1,1,1,1,'A','2024-09-27','2024-09-27'),(2,1,2,1,'A','2024-09-27','2024-09-27'),
(3,2,3,1,'B','2024-09-27','2024-09-27'),(4,2,4,1,'B','2024-09-27','2024-09-27'),(5,3,5,1,'C','2024-09-27','2024-09-27'),
(6,3,6,1,'C','2024-09-27','2024-09-27'),(7,4,7,1,'D','2024-09-27','2024-09-27'),(8,4,8,1,'D','2024-09-27','2024-09-27');
/*!40000 ALTER TABLE `grado_curso` ENABLE KEYS */;
UNLOCK TABLES;





--
-- Table structure for table `horario25`
--

DROP TABLE IF EXISTS `horario25`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `horario25` (
  `idhorario` int NOT NULL AUTO_INCREMENT,
  `gradoId` int DEFAULT NULL,
  `turnoId` int DEFAULT NULL,
  `nivelId` int DEFAULT NULL,
  `seccionId` varchar(45) DEFAULT NULL,
  `jornadId` int DEFAULT NULL,
  `yearId` int DEFAULT NULL,
  `aula_id` int DEFAULT NULL,
  `datecreat` date DEFAULT NULL,
  PRIMARY KEY (`idhorario`)
) ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `horario25`
--

LOCK TABLES `horario25` WRITE;
/*!40000 ALTER TABLE `horario25` DISABLE KEYS */;
INSERT INTO `horario25` VALUES (1,1,4,4,'A',1,1,1,'2024-09-27'),
(2,2,1,1,'B',2,1,2,'2024-09-27'),(3,3,1,2,'C',3,1,3,'2024-09-27'),
(4,4,1,3,'D',4,1,4,'2024-09-27');
/*!40000 ALTER TABLE `horario25` ENABLE KEYS */;
UNLOCK TABLES;



--
-- Table structure for table `horario_curso`
--

DROP TABLE IF EXISTS `horario_curso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `horario_curso` (
  `cursohoraId` int NOT NULL AUTO_INCREMENT,
  `idtd` int NOT NULL,
  `idhora` int NOT NULL,
  `idcurso` int NOT NULL,
  `dia` int NOT NULL,
  `gradoid` int NOT NULL,
  `turnoId` int DEFAULT NULL,
  `nivelId` int DEFAULT NULL,
  `seccionId` varchar(45) DEFAULT NULL,
  `idjornada` int DEFAULT NULL,
  `idyear` int DEFAULT NULL,
  `FechRegistro` datetime DEFAULT NULL,
  `statushorario` enum('ACTIVO','INACTIVO') NOT NULL,
  `idhoraio` int DEFAULT NULL,
  PRIMARY KEY (`cursohoraId`)
) ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `horario_curso`
--

LOCK TABLES `horario_curso` WRITE;
/*!40000 ALTER TABLE `horario_curso` DISABLE KEYS */;
INSERT INTO `horario_curso` VALUES (1,72,7,1,2,1,4,4,'A',1,1,'2024-09-27 23:58:45','ACTIVO',1),
(2,12,11,2,2,1,4,4,'A',1,1,'2024-09-27 23:58:45','ACTIVO',1),(3,41,14,4,1,2,1,1,'B',2,1,'2024-09-27 23:59:11','ACTIVO',2),
(4,64,16,3,4,2,1,1,'B',2,1,'2024-09-27 23:59:11','ACTIVO',2),(5,12,21,6,2,3,1,2,'C',3,1,'2024-09-27 23:59:33','ACTIVO',3),
(6,94,19,5,4,3,1,2,'C',3,1,'2024-09-27 23:59:33','ACTIVO',3),(7,44,24,8,4,4,1,3,'D',4,1,'2024-09-27 23:59:56','ACTIVO',4),
(8,41,24,7,1,4,1,3,'D',4,1,'2024-09-27 23:59:56','ACTIVO',4);
/*!40000 ALTER TABLE `horario_curso` ENABLE KEYS */;
UNLOCK TABLES;


--
-- Table structure for table `yearscolar`
--

DROP TABLE IF EXISTS `yearscolar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `yearscolar` (
  `id_year` int NOT NULL AUTO_INCREMENT,
  `fechainicio` date NOT NULL,
  `fechafin` date NOT NULL,
  `cierramatricula` date NOT NULL,
  `tipoevaluacion` varchar(45) NOT NULL,
  `yearScolar` varchar(45) NOT NULL,
  `stadoyear` enum('ACTIVO','INACTIVO') DEFAULT NULL,
  PRIMARY KEY (`id_year`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yearscolar`
--

LOCK TABLES `yearscolar` WRITE;
/*!40000 ALTER TABLE `yearscolar` DISABLE KEYS */;
INSERT INTO `yearscolar` VALUES (1,'2025-01-01','2025-12-01','2025-03-01','PERIODOS','2025','ACTIVO');
/*!40000 ALTER TABLE `yearscolar` ENABLE KEYS */;
UNLOCK TABLES;


--
-- Table structure for table `turnos`
--

DROP TABLE IF EXISTS `turnos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `turnos` (
  `turno_id` int NOT NULL AUTO_INCREMENT,
  `turno_nombre` varchar(45) NOT NULL,
  `stadoturno` enum('ACTIVO','INACTIVO') DEFAULT NULL,
  PRIMARY KEY (`turno_id`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `turnos`
--

LOCK TABLES `turnos` WRITE;
/*!40000 ALTER TABLE `turnos` DISABLE KEYS */;
INSERT INTO `turnos` VALUES (1,'MAÑANA','ACTIVO'),(2,'NOCHE','ACTIVO'),(3,'TARDE','ACTIVO'),(4,'VESPERTINO','ACTIVO'),
(5,'MATURDINO','ACTIVO');
/*!40000 ALTER TABLE `turnos` ENABLE KEYS */;
UNLOCK TABLES;


--
-- Table structure for table `jornadas`
--

DROP TABLE IF EXISTS `jornadas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jornadas` (
  `IdJornas` int NOT NULL AUTO_INCREMENT,
  `IdJornYear` int NOT NULL,
  `tunoid` int NOT NULL,
  `gradoid` int NOT NULL,
  `nivelGrado` int DEFAULT NULL,
  `seccionjor` varchar(45) DEFAULT NULL,
  `idAula` int DEFAULT NULL,
  `Horainicio` time NOT NULL,
  `horafinal` time NOT NULL,
  `createDate` date NOT NULL,
  `status` enum('ACTIVO','INACTIVO') DEFAULT NULL,
  PRIMARY KEY (`IdJornas`),
  KEY `year_jorn_idx` (`IdJornYear`),
  KEY `year_grad_idx` (`gradoid`),
  KEY `year_turn_idx` (`tunoid`),
  CONSTRAINT `year_grad` FOREIGN KEY (`gradoid`) REFERENCES `grado` (`idgrado`),
  CONSTRAINT `year_jorn` FOREIGN KEY (`IdJornYear`) REFERENCES `yearscolar` (`id_year`),
  CONSTRAINT `year_turn` FOREIGN KEY (`tunoid`) REFERENCES `turnos` (`turno_id`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jornadas`
--

LOCK TABLES `jornadas` WRITE;
/*!40000 ALTER TABLE `jornadas` DISABLE KEYS */;
INSERT INTO `jornadas` VALUES 
(1,1,4,1,4,'A',1,'06:00:00','10:00:00','2024-09-27','ACTIVO'),
(2,1,1,2,1,'B',2,'08:00:00','13:00:00','2024-09-27','ACTIVO'),
(3,1,1,3,2,'C',3,'08:00:00','13:00:00','2024-09-27','ACTIVO'),
(4,1,1,4,3,'D',4,'08:00:00','13:00:00','2024-09-27','ACTIVO');
/*!40000 ALTER TABLE `jornadas` ENABLE KEYS */;
UNLOCK TABLES;


--
-- Table structure for table `jornas_horas`
--

DROP TABLE IF EXISTS `jornas_horas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jornas_horas` (
  `HorJor_id` int NOT NULL AUTO_INCREMENT,
  `jorna_ID` int NOT NULL,
  `Hora_inicio` time NOT NULL,
  `hora_final` time NOT NULL,
  `createDate` date NOT NULL,
  `gradoId` int DEFAULT NULL,
  `yearId` int DEFAULT NULL,
  `nivelGrado_id` int DEFAULT NULL,
  `seccionHor` varchar(45) DEFAULT NULL,
  `turnoId` int DEFAULT NULL,
  `aulaId` int DEFAULT NULL,
  PRIMARY KEY (`HorJor_id`),
  KEY `jor_hor_idx` (`jorna_ID`),
  CONSTRAINT `hor_jor` FOREIGN KEY (`jorna_ID`) REFERENCES `jornadas` (`IdJornas`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jornas_horas`
--

LOCK TABLES `jornas_horas` WRITE;
/*!40000 ALTER TABLE `jornas_horas` DISABLE KEYS */;
INSERT INTO `jornas_horas` VALUES (7,1,'06:00:00','06:30:00','2024-09-27',1,1,4,'A',4,1),
(8,1,'06:30:00','07:00:00','2024-09-27',1,1,4,'A',4,1),(9,1,'07:00:00','07:30:00','2024-09-27',1,1,4,'A',4,1),
(10,1,'07:30:00','08:00:00','2024-09-27',1,1,4,'A',4,1),(11,1,'08:00:00','08:30:00','2024-09-27',1,1,4,'A',4,1),
(12,1,'08:30:00','09:00:00','2024-09-27',1,1,4,'A',4,1),(13,1,'09:00:00','10:00:00','2024-09-27',1,1,4,'A',4,1),
(14,2,'08:00:00','09:00:00','2024-09-27',2,1,1,'B',1,2),(15,2,'09:00:00','10:00:00','2024-09-27',2,1,1,'B',1,2),
(16,2,'10:00:00','11:00:00','2024-09-27',2,1,1,'B',1,2),(17,2,'11:00:00','12:00:00','2024-09-27',2,1,1,'B',1,2),
(18,2,'12:00:00','13:00:00','2024-09-27',2,1,1,'B',1,2),(19,3,'08:00:00','09:00:00','2024-09-27',3,1,2,'C',1,3),
(20,3,'09:00:00','10:00:00','2024-09-27',3,1,2,'C',1,3),(21,3,'10:00:00','11:00:00','2024-09-27',3,1,2,'C',1,3),
(22,3,'11:00:00','12:00:00','2024-09-27',3,1,2,'C',1,3),(23,3,'12:00:00','13:00:00','2024-09-27',3,1,2,'C',1,3),
(24,4,'08:00:00','09:00:00','2024-09-27',4,1,3,'D',1,4),(25,4,'09:00:00','09:30:00','2024-09-27',4,1,3,'D',1,4),
(26,4,'09:30:00','10:00:00','2024-09-27',4,1,3,'D',1,4),(27,4,'10:00:00','11:00:00','2024-09-27',4,1,3,'D',1,4),
(28,4,'11:00:00','12:00:00','2024-09-27',4,1,3,'D',1,4),(29,4,'12:00:00','13:00:00','2024-09-27',4,1,3,'D',1,4);
/*!40000 ALTER TABLE `jornas_horas` ENABLE KEYS */;
UNLOCK TABLES;



--
-- Table structure for table `libretanotas`
--

DROP TABLE IF EXISTS `libretanotas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `libretanotas` (
  `idLibretaNotas` int NOT NULL AUTO_INCREMENT,
  `idalumno` int DEFAULT NULL,
  `id_curso` int DEFAULT NULL,
  `di_year` int DEFAULT NULL,
  `calificacions` int DEFAULT NULL,
  `id_Criterio` int DEFAULT NULL,
  `gradoId` int DEFAULT NULL,
  `niveiId` int DEFAULT NULL,
  `tipoEva` int DEFAULT NULL,
  `creteDte` date DEFAULT NULL,
  `userSession` int DEFAULT NULL,
  PRIMARY KEY (`idLibretaNotas`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `libretanotas`
--

LOCK TABLES `libretanotas` WRITE;
/*!40000 ALTER TABLE `libretanotas` DISABLE KEYS */;
/*!40000 ALTER TABLE `libretanotas` ENABLE KEYS */;
UNLOCK TABLES;



--
-- Table structure for table `matricula`
--

DROP TABLE IF EXISTS `matricula`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `matricula` (
  `idmatricula` int NOT NULL AUTO_INCREMENT,
  `Id_alumno` int NOT NULL,
  `Id_grado` int NOT NULL,
  `Id_aula` int NOT NULL,
  `Id_turno` int NOT NULL,
  `Id_nivls` int NOT NULL,
  `cargoPago` enum('NO','SI') DEFAULT NULL,
  `year_id` int NOT NULL,
  `seccion` varchar(45) DEFAULT NULL,
  `cargoMatricula` double DEFAULT NULL,
  `creatDate` date DEFAULT NULL,
  `updateDate` date DEFAULT NULL,
  PRIMARY KEY (`idmatricula`),
  KEY `alum_matr_idx` (`Id_alumno`),
  CONSTRAINT `alum_matr` FOREIGN KEY (`Id_alumno`) REFERENCES `alumno` (`idalumno`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `matricula`
--

LOCK TABLES `matricula` WRITE;
/*!40000 ALTER TABLE `matricula` DISABLE KEYS */;
INSERT INTO `matricula` VALUES (1,1,1,1,5,4,'SI',1,'A',0,'2024-09-27','2024-09-27'),(2,2,1,1,5,4,'SI',1,'A',0,'2024-09-27','2024-09-27'),
(3,3,2,2,1,1,'SI',1,'B',0,'2024-09-27','2024-09-27'),(4,4,2,2,1,1,'SI',1,'B',0,'2024-09-27','2024-09-27'),
(5,5,3,3,1,2,'SI',1,'C',0,'2024-09-27','2024-09-27'),(6,6,3,3,1,2,'SI',1,'C',0,'2024-09-27','2024-09-27'),
(7,7,4,4,1,3,'SI',1,'D',0,'2024-09-27','2024-09-27'),(8,8,4,4,1,3,'SI',1,'D',0,'2024-09-27','2024-09-27');
/*!40000 ALTER TABLE `matricula` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categoryentry`
--

DROP TABLE IF EXISTS `categoryentry`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categoryentry` (
  `id` int NOT NULL AUTO_INCREMENT,
  `categoryentry` varchar(255) DEFAULT NULL,
  `date_create` date DEFAULT NULL,
  `date_update` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoryentry`
--

LOCK TABLES `categoryentry` WRITE;
/*!40000 ALTER TABLE `categoryentry` DISABLE KEYS */;
INSERT INTO `categoryentry` VALUES (1,'DONACIONES','2023-11-10','2023-11-10'),(2,'INVESTIGACION','2023-11-10','2023-11-10'),
(3,'ALQUILERES','2023-11-10','2023-11-10'),(4,'ACTIVIDADES COMUNITARIOS','2023-11-10','2023-11-10'),
(5,'FOTOCOPIAS','2023-11-10','2023-11-10'),(6,'KIOSCO','2023-11-10','2023-11-10');
/*!40000 ALTER TABLE `categoryentry` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categoryexit`
--

DROP TABLE IF EXISTS `categoryexit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categoryexit` (
  `id` int NOT NULL AUTO_INCREMENT,
  `categoryexit` varchar(255) DEFAULT NULL,
  `date_create` date DEFAULT NULL,
  `date_update` date DEFAULT NULL,
  PRIMARY KEY (`id`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoryexit`
--

LOCK TABLES `categoryexit` WRITE;
/*!40000 ALTER TABLE `categoryexit` DISABLE KEYS */;
INSERT INTO `categoryexit` VALUES (1,'SALARIO PERSONAL','2023-11-10','2023-11-10'),
(2,'SALARIO DOCENTES','2023-11-10','2023-11-10'),(3,'MARKETING','2023-11-10','2023-11-10'),
(4,'MANTENIMIENTOS ','2023-11-10','2023-11-10'),(5,'GASTOS FIJOS','2023-11-10','2023-11-11'),
(6,'TRANSPORTE','2023-11-10','2023-11-10');
/*!40000 ALTER TABLE `categoryexit` ENABLE KEYS */;
UNLOCK TABLES;



--
-- Table structure for table `collaborations`
--

DROP TABLE IF EXISTS `collaborations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `collaborations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name_people` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `number_ci` varchar(255) DEFAULT NULL,
  `description` text,
  `payment` varchar(255) DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `category_id` int DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `collaborations`
--

LOCK TABLES `collaborations` WRITE;
/*!40000 ALTER TABLE `collaborations` DISABLE KEYS */;
/*!40000 ALTER TABLE `collaborations` ENABLE KEYS */;
UNLOCK TABLES;







--
-- Table structure for table `entry`
--

DROP TABLE IF EXISTS `entry`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `entry` (
  `identry` int NOT NULL AUTO_INCREMENT,
  `description` text,
  `payment` varchar(255) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `dateoperation` date DEFAULT NULL,
  `category_id` int DEFAULT NULL,
  PRIMARY KEY (`identry`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entry`
--

LOCK TABLES `entry` WRITE;
/*!40000 ALTER TABLE `entry` DISABLE KEYS */;
/*!40000 ALTER TABLE `entry` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exits`
--

DROP TABLE IF EXISTS `exits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `exits` (
  `idexit` int NOT NULL AUTO_INCREMENT,
  `description` text,
  `payment` varchar(255) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `dateoperation` date DEFAULT NULL,
  `beneficiary` varchar(255) DEFAULT NULL,
  `category_id` int NOT NULL,
  `fixedcoste_id` int DEFAULT NULL,
  PRIMARY KEY (`idexit`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exits`
--

LOCK TABLES `exits` WRITE;
/*!40000 ALTER TABLE `exits` DISABLE KEYS */;
/*!40000 ALTER TABLE `exits` ENABLE KEYS */;
UNLOCK TABLES;



--
-- Table structure for table `feepayments`
--

DROP TABLE IF EXISTS `feepayments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `feepayments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `paymentPlan_id` int DEFAULT NULL,
  `student_id` int DEFAULT NULL,
  `year_id` int DEFAULT NULL,
  `grade_id` int DEFAULT NULL,
  `type_id` int DEFAULT NULL,
  `orderType` int DEFAULT NULL,
  `status_payment` tinyint(1) DEFAULT '1',
  `payment_date` datetime DEFAULT NULL,
  `next_date` datetime DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `feepayments`
--

LOCK TABLES `feepayments` WRITE;
/*!40000 ALTER TABLE `feepayments` DISABLE KEYS */;
/*!40000 ALTER TABLE `feepayments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fixedcoste`
--

DROP TABLE IF EXISTS `fixedcoste`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fixedcoste` (
  `idfixed` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `date_create` date DEFAULT NULL,
  `date_update` date DEFAULT NULL,
  PRIMARY KEY (`idfixed`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fixedcoste`
--

LOCK TABLES `fixedcoste` WRITE;
/*!40000 ALTER TABLE `fixedcoste` DISABLE KEYS */;
INSERT INTO `fixedcoste` VALUES (1,'ALQUILER','2023-11-10','2023-11-10'),(2,'ELECTROCENTRO','2023-11-10','2023-11-10'),
(3,'SERVICIO DE AGUA POTABLE','2023-11-10','2023-11-10'),(4,'INPUESTO','2023-11-10','2023-11-10'),
(5,'TELEFONO','2023-11-10','2023-11-10'),(6,'NETWORK','2023-11-10','2023-11-10');
/*!40000 ALTER TABLE `fixedcoste` ENABLE KEYS */;
UNLOCK TABLES;








--
-- Table structure for table `keys_students`
--

DROP TABLE IF EXISTS `keys_students`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `keys_students` (
  `id_keys` int NOT NULL AUTO_INCREMENT,
  `id_students` int NOT NULL,
  `keys_text` text,
  `status` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_keys`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `keys_students`
--

LOCK TABLES `keys_students` WRITE;
/*!40000 ALTER TABLE `keys_students` DISABLE KEYS */;
INSERT INTO `keys_students` VALUES (1,1,'120240928025544',1,'2024-09-28 02:55:37','2024-09-28 02:55:44'),
(2,2,'220240928025545',1,'2024-09-28 02:55:37','2024-09-28 02:55:45'),
(3,3,'320240928025545',1,'2024-09-28 02:55:37','2024-09-28 02:55:45'),
(4,4,'420240928025545',1,'2024-09-28 02:55:37','2024-09-28 02:55:45'),
(5,5,'520240928025545',1,'2024-09-28 02:55:37','2024-09-28 02:55:45'),(6,6,'620240928025545',1,'2024-09-28 02:55:37','2024-09-28 02:55:45'),
(7,7,'720240928025545',1,'2024-09-28 02:55:37','2024-09-28 02:55:45'),(8,8,'820240928025545',1,'2024-09-28 02:55:37','2024-09-28 02:55:45'),
(9,9,'920240928025545',1,'2024-09-28 02:55:37','2024-09-28 02:55:45');
/*!40000 ALTER TABLE `keys_students` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notas`
--

DROP TABLE IF EXISTS `notas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notas` (
  `idnotas` int NOT NULL AUTO_INCREMENT,
  `gradoid` int NOT NULL,
  `cursoid` int NOT NULL,
  `alumnoid` int NOT NULL,
  `seccionid` varchar(45) NOT NULL,
  `cargaacadId` int DEFAULT NULL,
  `ordentipo` int DEFAULT NULL,
  `tipoevaluacionid` int NOT NULL,
  `nota_alum` decimal(10,2) NOT NULL,
  `idnivel` int DEFAULT NULL,
  `yearid` int DEFAULT NULL,
  `usersession` int DEFAULT NULL,
  `createDate` date DEFAULT NULL,
  PRIMARY KEY (`idnotas`),
  KEY `grado_alum_idx` (`gradoid`),
  CONSTRAINT `grado_alum` FOREIGN KEY (`gradoid`) REFERENCES `grado` (`idgrado`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notas`
--

LOCK TABLES `notas` WRITE;
/*!40000 ALTER TABLE `notas` DISABLE KEYS */;
/*!40000 ALTER TABLE `notas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notasalfabetico`
--

DROP TABLE IF EXISTS `notasalfabetico`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notasalfabetico` (
  `idLibretaNotas` int NOT NULL AUTO_INCREMENT,
  `idalumno` int DEFAULT NULL,
  `id_curso` int DEFAULT NULL,
  `di_year` int DEFAULT NULL,
  `calificacions` varchar(3) DEFAULT NULL,
  `id_Criterio` int DEFAULT NULL,
  `gradoId` int DEFAULT NULL,
  `niveiId` int DEFAULT NULL,
  `tipoEva` int DEFAULT NULL,
  `creteDte` date DEFAULT NULL,
  `userSession` int DEFAULT NULL,
  PRIMARY KEY (`idLibretaNotas`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notasalfabetico`
--

LOCK TABLES `notasalfabetico` WRITE;
/*!40000 ALTER TABLE `notasalfabetico` DISABLE KEYS */;

/*!40000 ALTER TABLE `notasalfabetico` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `paymentplan`
--

DROP TABLE IF EXISTS `paymentplan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `paymentplan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `status` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `paymentplan`
--

LOCK TABLES `paymentplan` WRITE;
/*!40000 ALTER TABLE `paymentplan` DISABLE KEYS */;
INSERT INTO `paymentplan` VALUES (1,'X PENCIONES','STD001',200.00,1,'2024-09-27 05:06:40','2024-09-28 05:21:37'),
(2,'X MATRÍCULA','PRM001',10.00,1,'2024-09-27 05:06:40','2024-09-28 05:21:21');
/*!40000 ALTER TABLE `paymentplan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `periodo`
--

DROP TABLE IF EXISTS `periodo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `periodo` (
  `id_periodo` int NOT NULL AUTO_INCREMENT,
  `year_id` int NOT NULL,
  `tipo_periodo` int NOT NULL,
  `ordenTipo_periodo` int DEFAULT NULL,
  `fech_inicio` date NOT NULL,
  `fech_final` date NOT NULL,
  `p_stado` enum('ACTIVO','INACTIVO') DEFAULT NULL,
  PRIMARY KEY (`id_periodo`)
) ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `periodo`
--

LOCK TABLES `periodo` WRITE;
/*!40000 ALTER TABLE `periodo` DISABLE KEYS */;
INSERT INTO `periodo` VALUES (1,1,4,1,'2025-01-27','2025-03-27','ACTIVO'),(2,1,4,2,'2025-05-27','2025-07-27','ACTIVO'),
(3,1,4,3,'2025-08-01','2025-09-27','ACTIVO'),(4,1,4,4,'2025-11-27','2025-12-27','ACTIVO');
/*!40000 ALTER TABLE `periodo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pettycash`
--

DROP TABLE IF EXISTS `pettycash`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pettycash` (
  `idpetty` int NOT NULL AUTO_INCREMENT,
  `pettycashname` varchar(255) NOT NULL,
  `amountmax` decimal(10,2) NOT NULL,
  `amountmin` decimal(10,2) NOT NULL,
  `iscurrent` tinyint NOT NULL,
  `status` tinyint DEFAULT NULL,
  `date_create` date DEFAULT NULL,
  `date_update` date DEFAULT NULL,
  PRIMARY KEY (`idpetty`)
) ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pettycash`
--

LOCK TABLES `pettycash` WRITE;
/*!40000 ALTER TABLE `pettycash` DISABLE KEYS */;
INSERT INTO `pettycash` VALUES (1,'caja chica',2000.00,50.00,1,1,'2023-11-10','2024-09-28');
/*!40000 ALTER TABLE `pettycash` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ponderados`
--

DROP TABLE IF EXISTS `ponderados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ponderados` (
  `idpond` int NOT NULL AUTO_INCREMENT,
  `alumno_id` int DEFAULT NULL,
  `curso_id` int DEFAULT NULL,
  `notaacum` decimal(10,2) DEFAULT NULL,
  `susty` decimal(10,2) DEFAULT NULL,
  `grado_id` int DEFAULT NULL,
  `ordentio` int DEFAULT NULL,
  `tipo_id` int DEFAULT NULL,
  `year_id` int DEFAULT NULL,
  `nivel_id` int DEFAULT NULL,
  `seccion` varchar(45) DEFAULT NULL,
  `userseccion` int DEFAULT NULL,
  `cretedate` date DEFAULT NULL,
  PRIMARY KEY (`idpond`)
) ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ponderados`
--

LOCK TABLES `ponderados` WRITE;
/*!40000 ALTER TABLE `ponderados` DISABLE KEYS */;
/*!40000 ALTER TABLE `ponderados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `procedente`
--

DROP TABLE IF EXISTS `procedente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `procedente` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_Alumno` int DEFAULT NULL,
  `procedente` text,
  `localitation` text,
  `ep_data` text,
  `year` text,
  `status` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `procedente`
--

LOCK TABLES `procedente` WRITE;
/*!40000 ALTER TABLE `procedente` DISABLE KEYS */;
/*!40000 ALTER TABLE `procedente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `registopagos`
--

DROP TABLE IF EXISTS `registopagos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `registopagos` (
  `idregistropagos` int NOT NULL AUTO_INCREMENT,
  `alumno_id` int DEFAULT NULL,
  `tipo` enum('MATRÍCULA','PENCION') DEFAULT NULL,
  `year_id` int DEFAULT NULL,
  `motoPago` double DEFAULT NULL,
  `stadoPago` enum('PAGADO','PENDIENTE') DEFAULT NULL,
  `fechasPagados` date DEFAULT NULL,
  `prox_pago` date DEFAULT NULL,
  `dateoperation` date DEFAULT NULL,
  PRIMARY KEY (`idregistropagos`),
  KEY `alum_pago_idx` (`alumno_id`),
  CONSTRAINT `alum_pago` FOREIGN KEY (`alumno_id`) REFERENCES `alumno` (`idalumno`) ON DELETE CASCADE
) ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registopagos`
--

LOCK TABLES `registopagos` WRITE;
/*!40000 ALTER TABLE `registopagos` DISABLE KEYS */;
INSERT INTO `registopagos` VALUES (1,1,'MATRÍCULA',1,0,'PAGADO','2024-09-27','2024-10-27','2024-09-27'),
(2,2,'MATRÍCULA',1,0,'PAGADO','2024-09-27','2024-10-27','2024-09-27'),
(3,3,'MATRÍCULA',1,0,'PAGADO','2024-09-27','2024-10-27','2024-09-27'),(4,4,'MATRÍCULA',1,0,'PAGADO','2024-09-27','2024-10-27','2024-09-27'),
(5,5,'MATRÍCULA',1,0,'PAGADO','2024-09-27','2024-10-27','2024-09-27'),(6,6,'MATRÍCULA',1,0,'PAGADO','2024-09-27','2024-10-27','2024-09-27'),
(7,7,'MATRÍCULA',1,0,'PAGADO','2024-09-27','2024-10-27','2024-09-27'),(8,8,'MATRÍCULA',1,0,'PAGADO','2024-09-27','2024-10-27','2024-09-27');
/*!40000 ALTER TABLE `registopagos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rol`
--

DROP TABLE IF EXISTS `rol`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rol` (
  `rol_id` int NOT NULL AUTO_INCREMENT,
  `rol_nombre` varchar(45) NOT NULL,
  PRIMARY KEY (`rol_id`)
) ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rol`
--

LOCK TABLES `rol` WRITE;
/*!40000 ALTER TABLE `rol` DISABLE KEYS */;
INSERT INTO `rol` VALUES (1,'ADMINISTRADOR'),(2,'DOCENTE'),(3,'ALUMNO'),(4,'APODERADO'),(5,'FUNCIONARIO');
/*!40000 ALTER TABLE `rol` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stadopenciones`
--

DROP TABLE IF EXISTS `stadopenciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `stadopenciones` (
  `idstadop` int NOT NULL AUTO_INCREMENT,
  `entidad` int DEFAULT NULL,
  `ultimoPagofecha` date DEFAULT NULL,
  `proximoPagoFecha` date DEFAULT NULL,
  `stado` enum('PAGADO','PAGO PENDIENTE') DEFAULT NULL,
  `userSesion` int DEFAULT NULL,
  `createDate` date DEFAULT NULL,
  `updateDate` date DEFAULT NULL,
  `yeayid` int DEFAULT NULL,
  `aplicargo` enum('NO','SI') DEFAULT NULL,
  PRIMARY KEY (`idstadop`),
  KEY `alun_stad_idx` (`entidad`),
  CONSTRAINT `alun_stad` FOREIGN KEY (`entidad`) REFERENCES `alumno` (`idalumno`)
) ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stadopenciones`
--

LOCK TABLES `stadopenciones` WRITE;
/*!40000 ALTER TABLE `stadopenciones` DISABLE KEYS */;
INSERT INTO `stadopenciones` VALUES (1,1,'2024-09-27','2024-10-27','PAGADO',1,'2024-09-27','2024-09-27',1,'SI'),
(2,2,'2024-09-27','2024-10-27','PAGADO',1,'2024-09-27','2024-09-27',1,'SI'),
(3,3,'2024-09-27','2024-10-27','PAGADO',1,'2024-09-27','2024-09-27',1,'SI'),
(4,4,'2024-09-27','2024-10-27','PAGADO',1,'2024-09-27','2024-09-27',1,'SI'),
(5,5,'2024-09-27','2024-10-27','PAGADO',1,'2024-09-27','2024-09-27',1,'SI'),
(6,6,'2024-09-27','2024-10-27','PAGADO',1,'2024-09-27','2024-09-27',1,'SI'),
(7,7,'2024-09-27','2024-10-27','PAGADO',1,'2024-09-27','2024-09-27',1,'SI'),
(8,8,'2024-09-27','2024-10-27','PAGADO',1,'2024-09-27','2024-09-27',1,'SI');
/*!40000 ALTER TABLE `stadopenciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipoevaluacion`
--

DROP TABLE IF EXISTS `tipoevaluacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tipoevaluacion` (
  `tipo_id` int NOT NULL AUTO_INCREMENT,
  `tipo_nombre` varchar(255) NOT NULL,
  `t_stado` enum('ACTIVO','INACTIVO') DEFAULT NULL,
  `of_rank` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`tipo_id`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipoevaluacion`
--

LOCK TABLES `tipoevaluacion` WRITE;
/*!40000 ALTER TABLE `tipoevaluacion` DISABLE KEYS */;
INSERT INTO `tipoevaluacion` VALUES (1,'SOLO NOTAS FINALES','ACTIVO',1,'2024-09-27 05:06:40','2024-09-27 05:06:40'),
(2,'PERIODO BIMESTRAL','ACTIVO',2,'2024-09-27 05:06:40','2024-09-27 05:06:40'),
(3,'PERIODO TRIMESTRAL','ACTIVO',3,'2024-09-27 05:06:40','2024-09-27 05:06:40'),
(4,'PERIODO SEMESTRAL','ACTIVO',4,'2024-09-27 05:06:40','2024-09-27 05:06:40');
/*!40000 ALTER TABLE `tipoevaluacion` ENABLE KEYS */;
UNLOCK TABLES;



--
-- Table structure for table `turnos_hora`
--

DROP TABLE IF EXISTS `turnos_hora`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `turnos_hora` (
  `turHora_id` int NOT NULL AUTO_INCREMENT,
  `Id_year` int NOT NULL,
  `inicioHora` varchar(45) NOT NULL,
  `finHora` varchar(45) NOT NULL,
  `idturno` int NOT NULL,
  `stad` enum('ACTIVO','INACTIVO') DEFAULT NULL,
  PRIMARY KEY (`turHora_id`)
) ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `turnos_hora`
--

LOCK TABLES `turnos_hora` WRITE;
/*!40000 ALTER TABLE `turnos_hora` DISABLE KEYS */;
INSERT INTO `turnos_hora` VALUES (3,1,'08:00','13:00',1,'ACTIVO'),(4,1,'06:00','10:00',4,'ACTIVO');
/*!40000 ALTER TABLE `turnos_hora` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `usu_id` int NOT NULL AUTO_INCREMENT,
  `identidad` int DEFAULT NULL,
  `usu_usuario` varchar(45) DEFAULT NULL,
  `usu_nombre` varchar(30) DEFAULT NULL,
  `usu_apellidos` varchar(45) DEFAULT NULL,
  `usu_contrasena` char(255) DEFAULT NULL,
  `rol_id` int DEFAULT NULL,
  `imagen` text,
  `usu_estatus` enum('ACTIVO','INACTIVO') NOT NULL,
  `toke_loguin` text,
  `date_sessio` date DEFAULT NULL,
  `session_fallidos` int DEFAULT NULL,
  PRIMARY KEY (`usu_id`),
  KEY `usuarios_ibfk_1` (`rol_id`),
  CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`rol_id`) ON DELETE RESTRICT ON UPDATE CASCADE
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,0,'Daniel','Daniel Danny','Chavez Torriel','$argon2i$v=19$m=65536,t=4,p=1$cWxjL1IvbVpzSTJPOGpyYQ$1go3uo+QIyOZUyjycCIgR3aoORX3hW1kb67sVVaHTIk',1,'CHAVEZ_TORIIEL-ADMINISTRADOR_202349.png','ACTIVO','admin',NULL,NULL),
(10,1,'dante','DANTE','OCHOA DALTONN','$argon2i$v=19$m=65536,t=4,p=1$SWxrM3V2SDdYOGNpM2xGYg$qE4AeW8loyDybBzdn0ap+WSGIVgH1asXChwW+oJiAKU',2,'OCHOA DALTONN-DOCENTE_202438.jpg','ACTIVO','admin',NULL,NULL),
(11,2,'maria','MARIA','HERNANDEZ RAMIREZ','$argon2i$v=19$m=65536,t=4,p=1$aUpTMnY2VllxYkFzN2hINA$98kCkNtmD2DYrenECnrjCxeA1R6VTjCwqlatYYXE90I',3,'','ACTIVO','admin',NULL,NULL);
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

-- Dump completed on 2024-09-28  0:34:56
