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
  `coleUbicacion` text DEFAULT NULL,
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
 (1,'ABC',1,504,28,'LIBRE','2023-01-23','2024-09-28'),(2,'DEF',1,506,32,'LIBRE','2023-01-23','2024-09-28'),
 (3,'GHI',1,505,24,'LIBRE','2023-01-23','2024-09-28'),(4,'JKL',1,507,18,'LIBRE','2023-01-23','2024-09-28'),
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
  `ubicacion` varchar(45) DEFAULT NULL,
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

LOCK TABLES `niveles` WRITE;
/*!40000 ALTER TABLE `niveles` DISABLE KEYS */;
INSERT INTO `niveles` VALUES
 (1,'PRIMARIA',1,'2022-11-06'),(2,'SECUNDARIA',1,'2022-11-06'),
 (3,'SUPERIOR',1,'2022-11-06'),(4,'INICIAL',1,'2022-11-06');
/*!40000 ALTER TABLE `niveles` ENABLE KEYS */;
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
INSERT INTO `usuarios` VALUES (1,0,'Daniel','Daniel Danny','Chavez Torriel','$argon2i$v=19$m=65536,t=4,p=1$cWxjL1IvbVpzSTJPOGpyYQ$1go3uo+QIyOZUyjycCIgR3aoORX3hW1kb67sVVaHTIk',1,'CHAVEZ_TORIIEL-ADMINISTRADOR_202349.png','ACTIVO','admin',NULL,NULL);
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
