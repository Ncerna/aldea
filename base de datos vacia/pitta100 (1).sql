-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-03-2025 a las 20:42:08
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pitta100`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `activiti`
--

CREATE TABLE `activiti` (
  `idactiviti` int(11) NOT NULL,
  `yearId_act` int(11) NOT NULL,
  `curso_act` int(11) NOT NULL,
  `fechaCreatd` date NOT NULL,
  `status` enum('ACTIVO','INACTIVO') NOT NULL,
  `ordeperiodoTipo` int(11) DEFAULT NULL,
  `tipo_evalu` int(11) DEFAULT NULL,
  `User_sesion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `activ_curso`
--

CREATE TABLE `activ_curso` (
  `actcur_id` int(11) NOT NULL,
  `activ_Id` int(11) NOT NULL,
  `actividades` varchar(255) NOT NULL,
  `puntajes` int(11) NOT NULL,
  `cursoid` int(11) NOT NULL,
  `fechaCreatd` date NOT NULL,
  `ordenTipoeva` int(11) DEFAULT NULL,
  `evalu_tipo` varchar(255) DEFAULT NULL,
  `User_sesscion` int(11) DEFAULT NULL,
  `yearId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno`
--

CREATE TABLE `alumno` (
  `idalumno` int(11) NOT NULL,
  `apellidos` varchar(45) DEFAULT NULL,
  `alumnonombre` varchar(45) DEFAULT NULL,
  `dni` int(11) DEFAULT NULL,
  `telefono` int(11) DEFAULT NULL,
  `codigo` int(11) DEFAULT NULL,
  `sexo` char(1) DEFAULT NULL,
  `fnacimiento` date DEFAULT NULL,
  `stadoalumno` enum('ACTIVO','INACTIVO') NOT NULL,
  `fechaRegisto` date DEFAULT NULL,
  `fechaUpdate` date DEFAULT NULL,
  `direccion` varchar(45) DEFAULT NULL,
  `rolalumno` int(11) NOT NULL,
  `alumno_foto` text DEFAULT NULL,
  `bajaAlumn` enum('1','0') NOT NULL,
  `mail` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `province` varchar(255) DEFAULT NULL,
  `municipality` varchar(255) DEFAULT NULL,
  `others` varchar(255) DEFAULT NULL,
  `planeStudy` varchar(255) DEFAULT NULL,
  `especiality` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `alumno`
--

INSERT INTO `alumno` (`idalumno`, `apellidos`, `alumnonombre`, `dni`, `telefono`, `codigo`, `sexo`, `fnacimiento`, `stadoalumno`, `fechaRegisto`, `fechaUpdate`, `direccion`, `rolalumno`, `alumno_foto`, `bajaAlumn`, `mail`, `country`, `age`, `province`, `municipality`, `others`, `planeStudy`, `especiality`) VALUES
(1, 'Pitta', 'Victor', 3198595, 983455074, 1001, 'M', '1988-06-30', 'ACTIVO', '2025-03-25', '2025-03-25', 'CDE', 3, 'usuarios/images.png', '1', 'PITTA100@GMAIL.COM', 'Paraguay', 36, 'ALTO PARANA ', 'CIUDAD DEL ESTE', 'ASUNCION', '', ''),
(2, 'nelson', 'feliu', 3629444, 98645574, 1002, 'M', '1988-06-05', 'ACTIVO', '2025-03-25', '2025-03-25', 'tobati', 3, 'usuarios/images.png', '1', 'neljafel@gmail.com', 'paraguay', 36, 'cprdillera', 'tobati', 'asunxcion', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `apoderados`
--

CREATE TABLE `apoderados` (
  `idApoderado` int(11) NOT NULL,
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
  `id_Alumn` int(11) DEFAULT NULL,
  `telf_padre` varchar(45) DEFAULT NULL,
  `direc_padre` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `apoderados`
--

INSERT INTO `apoderados` (`idApoderado`, `paderNombre`, `PadreApellidos`, `padreDni`, `madreNombres`, `madreApellidos`, `madreDni`, `cole_procedente`, `coleUbicacion`, `coleCodigo`, `dateCreat`, `dateUpdate`, `id_Alumn`, `telf_padre`, `direc_padre`) VALUES
(1, 'Virgilio', 'Pitta Rodriguez', '555888', 'Catalina Concepcion Maria ', 'Gomez Zorrilla ', '3369855', '', '', '', '2025-03-25', '2025-03-25', 1, '000000', 'CDE '),
(2, 'fidelino ', 'felio', '2225558', 'victoriana ', 'vargas ', '3369855', '', '', '', '2025-03-25', '2025-03-25', 2, '06548877', 'tractorista/tovati');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia`
--

CREATE TABLE `asistencia` (
  `IdAsisten` int(10) UNSIGNED NOT NULL,
  `idalumno_asi` int(11) NOT NULL,
  `Fechas` date NOT NULL,
  `Est_Asis` tinyint(1) NOT NULL,
  `idgrado` int(11) DEFAULT NULL,
  `idnivel` int(11) DEFAULT NULL,
  `idseccion` varchar(10) DEFAULT NULL,
  `yearid` int(11) DEFAULT NULL,
  `userSesion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aula`
--

CREATE TABLE `aula` (
  `idaula` int(11) NOT NULL,
  `nombreaula` varchar(45) NOT NULL,
  `piso` int(11) NOT NULL,
  `numero` int(11) NOT NULL,
  `aforro` int(11) NOT NULL,
  `status` enum('LIBRE','OCUPADO') DEFAULT NULL,
  `dateCreat` date NOT NULL,
  `dateUpdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `aula`
--

INSERT INTO `aula` (`idaula`, `nombreaula`, `piso`, `numero`, `aforro`, `status`, `dateCreat`, `dateUpdate`) VALUES
(1, 'ABC', 1, 504, 28, 'LIBRE', '2023-01-23', '2024-09-28'),
(2, 'DEF', 1, 506, 32, 'LIBRE', '2023-01-23', '2024-09-28'),
(3, 'GHI', 1, 505, 24, 'LIBRE', '2023-01-23', '2024-09-28'),
(4, 'JKL', 1, 507, 18, 'LIBRE', '2023-01-23', '2024-09-28'),
(5, 'MNO', 1, 508, 22, 'LIBRE', '2023-01-23', '2023-01-23'),
(6, 'PQR', 1, 509, 20, 'LIBRE', '2023-01-23', '2023-01-23'),
(7, 'STU', 1, 502, 26, 'LIBRE', '2023-01-23', '2023-01-23'),
(8, 'VWX', 1, 509, 21, 'LIBRE', '2023-01-23', '2023-01-23'),
(9, 'XYZ', 1, 501, 26, 'LIBRE', '2023-01-23', '2023-01-23'),
(10, 'AAB', 2, 404, 21, 'LIBRE', '2023-01-24', '2023-01-24'),
(11, 'AAC', 2, 405, 26, 'LIBRE', '2023-01-24', '2023-01-24'),
(12, 'AAD', 2, 406, 25, 'LIBRE', '2023-01-24', '2023-01-24'),
(13, 'AAE', 2, 407, 26, 'LIBRE', '2023-01-24', '2023-01-24'),
(14, 'AAF', 2, 408, 22, 'LIBRE', '2023-01-24', '2023-01-24'),
(15, 'AAG', 2, 409, 20, 'LIBRE', '2023-01-24', '2023-01-24'),
(16, 'AAH', 2, 500, 24, 'LIBRE', '2023-01-24', '2023-01-24'),
(17, 'AAI', 2, 501, 23, 'LIBRE', '2023-01-24', '2023-01-24'),
(18, 'AAJ', 2, 502, 28, 'LIBRE', '2023-01-24', '2023-01-24'),
(19, 'AAK', 2, 503, 21, 'LIBRE', '2023-01-24', '2023-01-24'),
(20, 'INI I', 1, 701, 12, 'LIBRE', '2023-01-24', '2023-01-24'),
(21, 'INI II', 1, 702, 18, 'LIBRE', '2023-01-24', '2023-01-24'),
(22, 'INI III', 1, 703, 19, 'LIBRE', '2023-01-24', '2023-01-24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoryentry`
--

CREATE TABLE `categoryentry` (
  `id` int(11) NOT NULL,
  `categoryentry` varchar(255) DEFAULT NULL,
  `date_create` date DEFAULT NULL,
  `date_update` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoryexit`
--

CREATE TABLE `categoryexit` (
  `id` int(11) NOT NULL,
  `categoryexit` varchar(255) DEFAULT NULL,
  `date_create` date DEFAULT NULL,
  `date_update` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colegio`
--

CREATE TABLE `colegio` (
  `idColegio` int(11) NOT NULL,
  `nameColegio` varchar(255) DEFAULT NULL,
  `telefColegio` int(11) DEFAULT NULL,
  `emailColegio` varchar(45) DEFAULT NULL,
  `ubicacion` varchar(45) DEFAULT NULL,
  `logoColegio` text DEFAULT NULL,
  `escudoPais` text DEFAULT NULL,
  `bannerColegio` text DEFAULT NULL,
  `idiomaColegio` varchar(45) DEFAULT NULL,
  `colorSidebar` varchar(45) DEFAULT NULL,
  `colorHeader` varchar(45) DEFAULT NULL,
  `yearCeation` date DEFAULT NULL,
  `descrition` text DEFAULT NULL,
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
  `dateUpdate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `colegio`
--

INSERT INTO `colegio` (`idColegio`, `nameColegio`, `telefColegio`, `emailColegio`, `ubicacion`, `logoColegio`, `escudoPais`, `bannerColegio`, `idiomaColegio`, `colorSidebar`, `colorHeader`, `yearCeation`, `descrition`, `ugel`, `municipio`, `txt_ep`, `txt_code`, `federal`, `txt_cdcee`, `denomination`, `identity`, `directors`, `dateCreate`, `dateUpdate`) VALUES
(1, 'COLEGIO NACIONAL', 964706345, 'saep@gmail.com', 'AV. PRINCIPAL 123', 'logotipo290924055943.jpg', 'pais290924055943.jpg', 'banner.png', 'Español', '#FFFFFF', '#000000', '2020-01-01', 'Un colegio que brinda educación de calidad.', 'UGEL 123', 'LIMA', 'Texto EP', 'Texto Code', 'Federal', 'Texto CDCEE', 'Denominación', 'Identidad', 'DIRECTOR', '2024-09-01', '2024-09-27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `collaborations`
--

CREATE TABLE `collaborations` (
  `id` int(11) NOT NULL,
  `name_people` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `number_ci` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `payment` varchar(255) DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `criterio`
--

CREATE TABLE `criterio` (
  `idboletNota` int(11) NOT NULL,
  `criteriosEvaluacion` text NOT NULL,
  `curso_id` int(11) NOT NULL,
  `grado_id` int(11) NOT NULL,
  `yearEscolar_id` int(11) NOT NULL,
  `idnivel` int(11) DEFAULT NULL,
  `fechRegistro` date NOT NULL,
  `userSession` int(11) DEFAULT NULL,
  `fechaUpdate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso`
--

CREATE TABLE `curso` (
  `idcurso` int(11) NOT NULL,
  `cursoCodigo` varchar(8) DEFAULT NULL,
  `nonbrecurso` varchar(45) NOT NULL,
  `abbreviation` varchar(45) DEFAULT NULL,
  `components` varchar(45) DEFAULT NULL,
  `statuscurso` enum('LIBRE','ASIGNADO') NOT NULL,
  `fechaRegistro` datetime DEFAULT NULL,
  `fechaActualizacion` datetime DEFAULT NULL,
  `tipo` enum('SEMESTRAL','TRIMESTRAL','BIMESTRAL','ELECTIVO','ESTANDAR') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docentes`
--

CREATE TABLE `docentes` (
  `id_docente` int(11) NOT NULL,
  `nombres` varchar(45) NOT NULL,
  `apellidos` varchar(45) DEFAULT NULL,
  `dni` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  `codigo` varchar(45) DEFAULT NULL,
  `rolDocente` int(11) DEFAULT NULL,
  `nivelId` int(11) DEFAULT NULL,
  `tipo_docente` enum('CONTRATADO','NOMBRADO') DEFAULT NULL,
  `estado_baja` enum('1','0') NOT NULL,
  `createDate` date DEFAULT NULL,
  `updateDate` date DEFAULT NULL,
  `userSession` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docente_curso`
--

CREATE TABLE `docente_curso` (
  `iddocenteCurso` int(11) NOT NULL,
  `idDocente` int(11) DEFAULT NULL,
  `idGrado` int(11) DEFAULT NULL,
  `idCursos` int(11) DEFAULT NULL,
  `idyear` int(11) DEFAULT NULL,
  `Seccion` varchar(25) DEFAULT NULL,
  `idSession` int(11) DEFAULT NULL,
  `createDate` date DEFAULT NULL,
  `updateDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docente_grados`
--

CREATE TABLE `docente_grados` (
  `iddocentGrados` int(11) NOT NULL,
  `docenteId` int(11) DEFAULT NULL,
  `gradoId` int(11) DEFAULT NULL,
  `nivelgradiId` int(11) DEFAULT NULL,
  `idseccion` varchar(45) DEFAULT NULL,
  `yearId` int(11) DEFAULT NULL,
  `sesionId` int(11) DEFAULT NULL,
  `createDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entry`
--

CREATE TABLE `entry` (
  `identry` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `payment` varchar(255) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `dateoperation` date DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `exits`
--

CREATE TABLE `exits` (
  `idexit` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `payment` varchar(255) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `dateoperation` date DEFAULT NULL,
  `beneficiary` varchar(255) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `fixedcoste_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `faseescolar`
--

CREATE TABLE `faseescolar` (
  `fase_id` int(11) NOT NULL,
  `idyearE` int(11) NOT NULL,
  `fase_nombre` varchar(45) DEFAULT NULL,
  `FechaInicial` date DEFAULT NULL,
  `FechaFinal` date DEFAULT NULL,
  `stdfase` enum('ACTIVO','INACTIVO') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `faseescolar`
--

INSERT INTO `faseescolar` (`fase_id`, `idyearE`, `fase_nombre`, `FechaInicial`, `FechaFinal`, `stdfase`) VALUES
(1, 1, 'FASE REGULAR', '2025-11-30', '2025-02-15', 'ACTIVO'),
(2, 1, 'FASE RECUPERACION', '2025-12-22', '2025-12-01', 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `feepayments`
--

CREATE TABLE `feepayments` (
  `id` int(11) NOT NULL,
  `paymentPlan_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `year_id` int(11) DEFAULT NULL,
  `grade_id` int(11) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `orderType` int(11) DEFAULT NULL,
  `status_payment` tinyint(1) DEFAULT 1,
  `payment_date` datetime DEFAULT NULL,
  `next_date` datetime DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fixedcoste`
--

CREATE TABLE `fixedcoste` (
  `idfixed` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_create` date DEFAULT NULL,
  `date_update` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grado`
--

CREATE TABLE `grado` (
  `idgrado` int(11) NOT NULL,
  `gradonombre` varchar(45) NOT NULL,
  `aula_id` int(11) NOT NULL,
  `turno_id` int(11) NOT NULL,
  `nivel_id` int(11) DEFAULT NULL,
  `vacantes` int(11) DEFAULT NULL,
  `seccion` varchar(45) DEFAULT NULL,
  `fechaRegistro` datetime DEFAULT NULL,
  `fechaActualizacion` datetime DEFAULT NULL,
  `gradostatus` enum('ACTIVO','INACTIVO') DEFAULT NULL,
  `year_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grado_curso`
--

CREATE TABLE `grado_curso` (
  `idgrado_curso` int(11) NOT NULL,
  `grado_id` int(11) NOT NULL,
  `curso_id` int(11) NOT NULL,
  `yearEscolar` int(11) NOT NULL,
  `Idseccion` varchar(45) DEFAULT NULL,
  `dateRegistro` date DEFAULT NULL,
  `dateUpdate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario25`
--

CREATE TABLE `horario25` (
  `idhorario` int(11) NOT NULL,
  `gradoId` int(11) DEFAULT NULL,
  `turnoId` int(11) DEFAULT NULL,
  `nivelId` int(11) DEFAULT NULL,
  `seccionId` varchar(45) DEFAULT NULL,
  `jornadId` int(11) DEFAULT NULL,
  `yearId` int(11) DEFAULT NULL,
  `aula_id` int(11) DEFAULT NULL,
  `datecreat` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario_curso`
--

CREATE TABLE `horario_curso` (
  `cursohoraId` int(11) NOT NULL,
  `idtd` int(11) NOT NULL,
  `idhora` int(11) NOT NULL,
  `idcurso` int(11) NOT NULL,
  `dia` int(11) NOT NULL,
  `gradoid` int(11) NOT NULL,
  `turnoId` int(11) DEFAULT NULL,
  `nivelId` int(11) DEFAULT NULL,
  `seccionId` varchar(45) DEFAULT NULL,
  `idjornada` int(11) DEFAULT NULL,
  `idyear` int(11) DEFAULT NULL,
  `FechRegistro` datetime DEFAULT NULL,
  `statushorario` enum('ACTIVO','INACTIVO') NOT NULL,
  `idhoraio` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jornadas`
--

CREATE TABLE `jornadas` (
  `IdJornas` int(11) NOT NULL,
  `IdJornYear` int(11) NOT NULL,
  `tunoid` int(11) NOT NULL,
  `gradoid` int(11) NOT NULL,
  `nivelGrado` int(11) DEFAULT NULL,
  `seccionjor` varchar(45) DEFAULT NULL,
  `idAula` int(11) DEFAULT NULL,
  `Horainicio` time NOT NULL,
  `horafinal` time NOT NULL,
  `createDate` date NOT NULL,
  `status` enum('ACTIVO','INACTIVO') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jornas_horas`
--

CREATE TABLE `jornas_horas` (
  `HorJor_id` int(11) NOT NULL,
  `jorna_ID` int(11) NOT NULL,
  `Hora_inicio` time NOT NULL,
  `hora_final` time NOT NULL,
  `createDate` date NOT NULL,
  `gradoId` int(11) DEFAULT NULL,
  `yearId` int(11) DEFAULT NULL,
  `nivelGrado_id` int(11) DEFAULT NULL,
  `seccionHor` varchar(45) DEFAULT NULL,
  `turnoId` int(11) DEFAULT NULL,
  `aulaId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `keys_students`
--

CREATE TABLE `keys_students` (
  `id_keys` int(11) NOT NULL,
  `id_students` int(11) NOT NULL,
  `keys_text` text DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `keys_students`
--

INSERT INTO `keys_students` (`id_keys`, `id_students`, `keys_text`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '20250325154356', 1, '2025-03-25 14:43:56', '2025-03-25 14:43:56'),
(2, 2, '20250325184140', 1, '2025-03-25 17:41:40', '2025-03-25 17:41:40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libretanotas`
--

CREATE TABLE `libretanotas` (
  `idLibretaNotas` int(11) NOT NULL,
  `idalumno` int(11) DEFAULT NULL,
  `id_curso` int(11) DEFAULT NULL,
  `di_year` int(11) DEFAULT NULL,
  `calificacions` int(11) DEFAULT NULL,
  `id_Criterio` int(11) DEFAULT NULL,
  `gradoId` int(11) DEFAULT NULL,
  `niveiId` int(11) DEFAULT NULL,
  `tipoEva` int(11) DEFAULT NULL,
  `creteDte` date DEFAULT NULL,
  `userSession` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `matricula`
--

CREATE TABLE `matricula` (
  `idmatricula` int(11) NOT NULL,
  `Id_alumno` int(11) NOT NULL,
  `Id_grado` int(11) NOT NULL,
  `Id_aula` int(11) NOT NULL,
  `Id_turno` int(11) NOT NULL,
  `Id_nivls` int(11) NOT NULL,
  `cargoPago` enum('NO','SI') DEFAULT NULL,
  `year_id` int(11) NOT NULL,
  `seccion` varchar(45) DEFAULT NULL,
  `cargoMatricula` double DEFAULT NULL,
  `creatDate` date DEFAULT NULL,
  `updateDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `niveles`
--

CREATE TABLE `niveles` (
  `idniveles` int(11) NOT NULL,
  `nombreNivell` varchar(45) NOT NULL,
  `yearNivel` int(11) DEFAULT NULL,
  `createDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `niveles`
--

INSERT INTO `niveles` (`idniveles`, `nombreNivell`, `yearNivel`, `createDate`) VALUES
(1, 'PRIMARIA', 1, '2022-11-06'),
(2, 'SECUNDARIA', 1, '2022-11-06'),
(3, 'SUPERIOR', 1, '2022-11-06'),
(4, 'INICIAL', 1, '2022-11-06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notas`
--

CREATE TABLE `notas` (
  `idnotas` int(11) NOT NULL,
  `gradoid` int(11) NOT NULL,
  `cursoid` int(11) NOT NULL,
  `alumnoid` int(11) NOT NULL,
  `seccionid` varchar(45) NOT NULL,
  `cargaacadId` int(11) DEFAULT NULL,
  `ordentipo` int(11) DEFAULT NULL,
  `tipoevaluacionid` int(11) NOT NULL,
  `nota_alum` decimal(10,2) NOT NULL,
  `idnivel` int(11) DEFAULT NULL,
  `yearid` int(11) DEFAULT NULL,
  `usersession` int(11) DEFAULT NULL,
  `createDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notasalfabetico`
--

CREATE TABLE `notasalfabetico` (
  `idLibretaNotas` int(11) NOT NULL,
  `idalumno` int(11) DEFAULT NULL,
  `id_curso` int(11) DEFAULT NULL,
  `di_year` int(11) DEFAULT NULL,
  `calificacions` varchar(3) DEFAULT NULL,
  `id_Criterio` int(11) DEFAULT NULL,
  `gradoId` int(11) DEFAULT NULL,
  `niveiId` int(11) DEFAULT NULL,
  `tipoEva` int(11) DEFAULT NULL,
  `creteDte` date DEFAULT NULL,
  `userSession` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paymentplan`
--

CREATE TABLE `paymentplan` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `status` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `paymentplan`
--

INSERT INTO `paymentplan` (`id`, `name`, `code`, `amount`, `status`, `created_at`, `updated_at`) VALUES
(1, 'X PENCIONES', 'STD001', 200.00, 1, '2024-09-27 05:06:40', '2024-09-28 05:21:37'),
(2, 'X MATRÍCULA', 'PRM001', 10.00, 1, '2024-09-27 05:06:40', '2024-09-28 05:21:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `periodo`
--

CREATE TABLE `periodo` (
  `id_periodo` int(11) NOT NULL,
  `year_id` int(11) NOT NULL,
  `tipo_periodo` int(11) NOT NULL,
  `ordenTipo_periodo` int(11) DEFAULT NULL,
  `fech_inicio` date NOT NULL,
  `fech_final` date NOT NULL,
  `p_stado` enum('ACTIVO','INACTIVO') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pettycash`
--

CREATE TABLE `pettycash` (
  `idpetty` int(11) NOT NULL,
  `pettycashname` varchar(255) NOT NULL,
  `amountmax` decimal(10,2) NOT NULL,
  `amountmin` decimal(10,2) NOT NULL,
  `iscurrent` tinyint(4) NOT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `date_create` date DEFAULT NULL,
  `date_update` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ponderados`
--

CREATE TABLE `ponderados` (
  `idpond` int(11) NOT NULL,
  `alumno_id` int(11) DEFAULT NULL,
  `curso_id` int(11) DEFAULT NULL,
  `notaacum` decimal(10,2) DEFAULT NULL,
  `susty` decimal(10,2) DEFAULT NULL,
  `grado_id` int(11) DEFAULT NULL,
  `ordentio` int(11) DEFAULT NULL,
  `tipo_id` int(11) DEFAULT NULL,
  `year_id` int(11) DEFAULT NULL,
  `nivel_id` int(11) DEFAULT NULL,
  `seccion` varchar(45) DEFAULT NULL,
  `userseccion` int(11) DEFAULT NULL,
  `cretedate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `procedente`
--

CREATE TABLE `procedente` (
  `id` int(11) NOT NULL,
  `id_Alumno` int(11) DEFAULT NULL,
  `procedente` text DEFAULT NULL,
  `localitation` text DEFAULT NULL,
  `ep_data` text DEFAULT NULL,
  `year` text DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `procedente`
--

INSERT INTO `procedente` (`id`, `id_Alumno`, `procedente`, `localitation`, `ep_data`, `year`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '', '', '', '', 1, '2025-03-25 14:43:56', '2025-03-25 17:25:55'),
(2, 1, '', '', '', '', 1, '2025-03-25 14:43:56', '2025-03-25 17:25:55'),
(3, 1, '', '', '', '', 1, '2025-03-25 14:43:56', '2025-03-25 17:25:55'),
(4, 1, '', '', '', '', 1, '2025-03-25 14:43:56', '2025-03-25 17:25:55'),
(5, 1, '', '', '', '', 1, '2025-03-25 14:43:56', '2025-03-25 17:25:55'),
(6, 1, '', '', '', '', 1, '2025-03-25 14:43:56', '2025-03-25 17:25:55'),
(7, 2, '', '', '', '', 1, '2025-03-25 17:41:39', '2025-03-25 17:43:18'),
(8, 2, '', '', '', '', 1, '2025-03-25 17:41:39', '2025-03-25 17:43:18'),
(9, 2, '', '', '', '', 1, '2025-03-25 17:41:40', '2025-03-25 17:43:18'),
(10, 2, '', '', '', '', 1, '2025-03-25 17:41:40', '2025-03-25 17:43:18'),
(11, 2, '', '', '', '', 1, '2025-03-25 17:41:40', '2025-03-25 17:43:18'),
(12, 2, '', '', '', '', 1, '2025-03-25 17:41:40', '2025-03-25 17:43:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registopagos`
--

CREATE TABLE `registopagos` (
  `idregistropagos` int(11) NOT NULL,
  `alumno_id` int(11) DEFAULT NULL,
  `tipo` enum('MATRÍCULA','PENCION') DEFAULT NULL,
  `year_id` int(11) DEFAULT NULL,
  `motoPago` double DEFAULT NULL,
  `stadoPago` enum('PAGADO','PENDIENTE') DEFAULT NULL,
  `fechasPagados` date DEFAULT NULL,
  `prox_pago` date DEFAULT NULL,
  `dateoperation` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `rol_id` int(11) NOT NULL,
  `rol_nombre` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`rol_id`, `rol_nombre`) VALUES
(1, 'ADMINISTRADOR'),
(2, 'DOCENTE'),
(3, 'ALUMNO'),
(4, 'APODERADO'),
(5, 'FUNCIONARIO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stadopenciones`
--

CREATE TABLE `stadopenciones` (
  `idstadop` int(11) NOT NULL,
  `entidad` int(11) DEFAULT NULL,
  `ultimoPagofecha` date DEFAULT NULL,
  `proximoPagoFecha` date DEFAULT NULL,
  `stado` enum('PAGADO','PAGO PENDIENTE') DEFAULT NULL,
  `userSesion` int(11) DEFAULT NULL,
  `createDate` date DEFAULT NULL,
  `updateDate` date DEFAULT NULL,
  `yeayid` int(11) DEFAULT NULL,
  `aplicargo` enum('NO','SI') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoevaluacion`
--

CREATE TABLE `tipoevaluacion` (
  `tipo_id` int(11) NOT NULL,
  `tipo_nombre` varchar(255) NOT NULL,
  `t_stado` enum('ACTIVO','INACTIVO') DEFAULT NULL,
  `of_rank` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipoevaluacion`
--

INSERT INTO `tipoevaluacion` (`tipo_id`, `tipo_nombre`, `t_stado`, `of_rank`, `created_at`, `updated_at`) VALUES
(1, 'SOLO NOTAS FINALES', 'ACTIVO', 1, '2024-09-27 05:06:40', '2024-09-27 05:06:40'),
(2, 'PERIODO BIMESTRAL', 'ACTIVO', 2, '2024-09-27 05:06:40', '2024-09-27 05:06:40'),
(3, 'PERIODO TRIMESTRAL', 'ACTIVO', 3, '2024-09-27 05:06:40', '2024-09-27 05:06:40'),
(4, 'PERIODO SEMESTRAL', 'ACTIVO', 4, '2024-09-27 05:06:40', '2024-09-27 05:06:40'),
(12, 'PERIODO_MODULAR', 'ACTIVO', 5, '2025-01-01 14:36:33', '2025-03-25 14:39:13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turnos`
--

CREATE TABLE `turnos` (
  `turno_id` int(11) NOT NULL,
  `turno_nombre` varchar(45) NOT NULL,
  `stadoturno` enum('ACTIVO','INACTIVO') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `turnos`
--

INSERT INTO `turnos` (`turno_id`, `turno_nombre`, `stadoturno`) VALUES
(1, 'MAÑANA', 'ACTIVO'),
(2, 'NOCHE', 'ACTIVO'),
(3, 'TARDE', 'ACTIVO'),
(4, 'VESPERTINO', 'ACTIVO'),
(5, 'MATURDINO', 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turnos_hora`
--

CREATE TABLE `turnos_hora` (
  `turHora_id` int(11) NOT NULL,
  `Id_year` int(11) NOT NULL,
  `inicioHora` varchar(45) NOT NULL,
  `finHora` varchar(45) NOT NULL,
  `idturno` int(11) NOT NULL,
  `stad` enum('ACTIVO','INACTIVO') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `turnos_hora`
--

INSERT INTO `turnos_hora` (`turHora_id`, `Id_year`, `inicioHora`, `finHora`, `idturno`, `stad`) VALUES
(1, 1, '15:00', '18:00', 3, 'ACTIVO'),
(2, 1, '08:00', '22:00', 2, 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `usu_id` int(11) NOT NULL,
  `identidad` int(11) DEFAULT NULL,
  `usu_usuario` varchar(45) DEFAULT NULL,
  `usu_nombre` varchar(30) DEFAULT NULL,
  `usu_apellidos` varchar(45) DEFAULT NULL,
  `usu_contrasena` char(255) DEFAULT NULL,
  `rol_id` int(11) DEFAULT NULL,
  `imagen` text DEFAULT NULL,
  `usu_estatus` enum('ACTIVO','INACTIVO') NOT NULL,
  `toke_loguin` text DEFAULT NULL,
  `date_sessio` date DEFAULT NULL,
  `session_fallidos` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usu_id`, `identidad`, `usu_usuario`, `usu_nombre`, `usu_apellidos`, `usu_contrasena`, `rol_id`, `imagen`, `usu_estatus`, `toke_loguin`, `date_sessio`, `session_fallidos`) VALUES
(1, 0, 'Daniel', 'Daniel Danny', 'Chavez Torriel', '$argon2i$v=19$m=65536,t=4,p=1$cWxjL1IvbVpzSTJPOGpyYQ$1go3uo+QIyOZUyjycCIgR3aoORX3hW1kb67sVVaHTIk', 1, 'CHAVEZ_TORIIEL-ADMINISTRADOR_202349.png', 'ACTIVO', 'admin', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `yearscolar`
--

CREATE TABLE `yearscolar` (
  `id_year` int(11) NOT NULL,
  `fechainicio` date NOT NULL,
  `fechafin` date NOT NULL,
  `cierramatricula` date NOT NULL,
  `tipoevaluacion` varchar(45) NOT NULL,
  `yearScolar` varchar(45) NOT NULL,
  `stadoyear` enum('ACTIVO','INACTIVO') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `yearscolar`
--

INSERT INTO `yearscolar` (`id_year`, `fechainicio`, `fechafin`, `cierramatricula`, `tipoevaluacion`, `yearScolar`, `stadoyear`) VALUES
(1, '2025-01-15', '2025-12-24', '2025-03-06', 'NOTAS FINALES', '2025', 'ACTIVO');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `activiti`
--
ALTER TABLE `activiti`
  ADD PRIMARY KEY (`idactiviti`),
  ADD KEY `act_curs_idx` (`curso_act`);

--
-- Indices de la tabla `activ_curso`
--
ALTER TABLE `activ_curso`
  ADD PRIMARY KEY (`actcur_id`),
  ADD KEY `avt_punt_idx` (`activ_Id`);

--
-- Indices de la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD PRIMARY KEY (`idalumno`);

--
-- Indices de la tabla `apoderados`
--
ALTER TABLE `apoderados`
  ADD PRIMARY KEY (`idApoderado`),
  ADD KEY `alumn_apo_idx` (`id_Alumn`);

--
-- Indices de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD PRIMARY KEY (`IdAsisten`),
  ADD KEY `alum_asist_idx` (`idalumno_asi`);

--
-- Indices de la tabla `aula`
--
ALTER TABLE `aula`
  ADD PRIMARY KEY (`idaula`);

--
-- Indices de la tabla `categoryentry`
--
ALTER TABLE `categoryentry`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categoryexit`
--
ALTER TABLE `categoryexit`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `colegio`
--
ALTER TABLE `colegio`
  ADD PRIMARY KEY (`idColegio`);

--
-- Indices de la tabla `collaborations`
--
ALTER TABLE `collaborations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `criterio`
--
ALTER TABLE `criterio`
  ADD PRIMARY KEY (`idboletNota`);

--
-- Indices de la tabla `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`idcurso`);

--
-- Indices de la tabla `docentes`
--
ALTER TABLE `docentes`
  ADD PRIMARY KEY (`id_docente`),
  ADD UNIQUE KEY `dni_UNIQUE` (`dni`),
  ADD UNIQUE KEY `codigo_UNIQUE` (`codigo`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`);

--
-- Indices de la tabla `docente_curso`
--
ALTER TABLE `docente_curso`
  ADD PRIMARY KEY (`iddocenteCurso`);

--
-- Indices de la tabla `docente_grados`
--
ALTER TABLE `docente_grados`
  ADD PRIMARY KEY (`iddocentGrados`);

--
-- Indices de la tabla `entry`
--
ALTER TABLE `entry`
  ADD PRIMARY KEY (`identry`);

--
-- Indices de la tabla `exits`
--
ALTER TABLE `exits`
  ADD PRIMARY KEY (`idexit`);

--
-- Indices de la tabla `faseescolar`
--
ALTER TABLE `faseescolar`
  ADD PRIMARY KEY (`fase_id`);

--
-- Indices de la tabla `feepayments`
--
ALTER TABLE `feepayments`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `fixedcoste`
--
ALTER TABLE `fixedcoste`
  ADD PRIMARY KEY (`idfixed`);

--
-- Indices de la tabla `grado`
--
ALTER TABLE `grado`
  ADD PRIMARY KEY (`idgrado`);

--
-- Indices de la tabla `grado_curso`
--
ALTER TABLE `grado_curso`
  ADD PRIMARY KEY (`idgrado_curso`);

--
-- Indices de la tabla `horario25`
--
ALTER TABLE `horario25`
  ADD PRIMARY KEY (`idhorario`);

--
-- Indices de la tabla `horario_curso`
--
ALTER TABLE `horario_curso`
  ADD PRIMARY KEY (`cursohoraId`);

--
-- Indices de la tabla `jornadas`
--
ALTER TABLE `jornadas`
  ADD PRIMARY KEY (`IdJornas`),
  ADD KEY `year_jorn_idx` (`IdJornYear`),
  ADD KEY `year_grad_idx` (`gradoid`),
  ADD KEY `year_turn_idx` (`tunoid`);

--
-- Indices de la tabla `jornas_horas`
--
ALTER TABLE `jornas_horas`
  ADD PRIMARY KEY (`HorJor_id`),
  ADD KEY `jor_hor_idx` (`jorna_ID`);

--
-- Indices de la tabla `keys_students`
--
ALTER TABLE `keys_students`
  ADD PRIMARY KEY (`id_keys`);

--
-- Indices de la tabla `libretanotas`
--
ALTER TABLE `libretanotas`
  ADD PRIMARY KEY (`idLibretaNotas`);

--
-- Indices de la tabla `matricula`
--
ALTER TABLE `matricula`
  ADD PRIMARY KEY (`idmatricula`),
  ADD KEY `alum_matr_idx` (`Id_alumno`);

--
-- Indices de la tabla `niveles`
--
ALTER TABLE `niveles`
  ADD PRIMARY KEY (`idniveles`);

--
-- Indices de la tabla `notas`
--
ALTER TABLE `notas`
  ADD PRIMARY KEY (`idnotas`),
  ADD KEY `grado_alum_idx` (`gradoid`);

--
-- Indices de la tabla `notasalfabetico`
--
ALTER TABLE `notasalfabetico`
  ADD PRIMARY KEY (`idLibretaNotas`);

--
-- Indices de la tabla `paymentplan`
--
ALTER TABLE `paymentplan`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `periodo`
--
ALTER TABLE `periodo`
  ADD PRIMARY KEY (`id_periodo`);

--
-- Indices de la tabla `pettycash`
--
ALTER TABLE `pettycash`
  ADD PRIMARY KEY (`idpetty`);

--
-- Indices de la tabla `ponderados`
--
ALTER TABLE `ponderados`
  ADD PRIMARY KEY (`idpond`);

--
-- Indices de la tabla `procedente`
--
ALTER TABLE `procedente`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `registopagos`
--
ALTER TABLE `registopagos`
  ADD PRIMARY KEY (`idregistropagos`),
  ADD KEY `alum_pago_idx` (`alumno_id`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`rol_id`);

--
-- Indices de la tabla `stadopenciones`
--
ALTER TABLE `stadopenciones`
  ADD PRIMARY KEY (`idstadop`),
  ADD KEY `alun_stad_idx` (`entidad`);

--
-- Indices de la tabla `tipoevaluacion`
--
ALTER TABLE `tipoevaluacion`
  ADD PRIMARY KEY (`tipo_id`);

--
-- Indices de la tabla `turnos`
--
ALTER TABLE `turnos`
  ADD PRIMARY KEY (`turno_id`);

--
-- Indices de la tabla `turnos_hora`
--
ALTER TABLE `turnos_hora`
  ADD PRIMARY KEY (`turHora_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`usu_id`),
  ADD KEY `usuarios_ibfk_1` (`rol_id`);

--
-- Indices de la tabla `yearscolar`
--
ALTER TABLE `yearscolar`
  ADD PRIMARY KEY (`id_year`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `activiti`
--
ALTER TABLE `activiti`
  MODIFY `idactiviti` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `activ_curso`
--
ALTER TABLE `activ_curso`
  MODIFY `actcur_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `alumno`
--
ALTER TABLE `alumno`
  MODIFY `idalumno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `apoderados`
--
ALTER TABLE `apoderados`
  MODIFY `idApoderado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  MODIFY `IdAsisten` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `aula`
--
ALTER TABLE `aula`
  MODIFY `idaula` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `categoryentry`
--
ALTER TABLE `categoryentry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `categoryexit`
--
ALTER TABLE `categoryexit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `colegio`
--
ALTER TABLE `colegio`
  MODIFY `idColegio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `collaborations`
--
ALTER TABLE `collaborations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `criterio`
--
ALTER TABLE `criterio`
  MODIFY `idboletNota` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `curso`
--
ALTER TABLE `curso`
  MODIFY `idcurso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `docentes`
--
ALTER TABLE `docentes`
  MODIFY `id_docente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `docente_curso`
--
ALTER TABLE `docente_curso`
  MODIFY `iddocenteCurso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `docente_grados`
--
ALTER TABLE `docente_grados`
  MODIFY `iddocentGrados` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `entry`
--
ALTER TABLE `entry`
  MODIFY `identry` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `exits`
--
ALTER TABLE `exits`
  MODIFY `idexit` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `faseescolar`
--
ALTER TABLE `faseescolar`
  MODIFY `fase_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `feepayments`
--
ALTER TABLE `feepayments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `fixedcoste`
--
ALTER TABLE `fixedcoste`
  MODIFY `idfixed` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `grado`
--
ALTER TABLE `grado`
  MODIFY `idgrado` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `grado_curso`
--
ALTER TABLE `grado_curso`
  MODIFY `idgrado_curso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `horario25`
--
ALTER TABLE `horario25`
  MODIFY `idhorario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `horario_curso`
--
ALTER TABLE `horario_curso`
  MODIFY `cursohoraId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `jornadas`
--
ALTER TABLE `jornadas`
  MODIFY `IdJornas` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `jornas_horas`
--
ALTER TABLE `jornas_horas`
  MODIFY `HorJor_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `keys_students`
--
ALTER TABLE `keys_students`
  MODIFY `id_keys` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `libretanotas`
--
ALTER TABLE `libretanotas`
  MODIFY `idLibretaNotas` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `matricula`
--
ALTER TABLE `matricula`
  MODIFY `idmatricula` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `niveles`
--
ALTER TABLE `niveles`
  MODIFY `idniveles` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `notas`
--
ALTER TABLE `notas`
  MODIFY `idnotas` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `notasalfabetico`
--
ALTER TABLE `notasalfabetico`
  MODIFY `idLibretaNotas` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `paymentplan`
--
ALTER TABLE `paymentplan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `periodo`
--
ALTER TABLE `periodo`
  MODIFY `id_periodo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pettycash`
--
ALTER TABLE `pettycash`
  MODIFY `idpetty` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ponderados`
--
ALTER TABLE `ponderados`
  MODIFY `idpond` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `procedente`
--
ALTER TABLE `procedente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `registopagos`
--
ALTER TABLE `registopagos`
  MODIFY `idregistropagos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `rol_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `stadopenciones`
--
ALTER TABLE `stadopenciones`
  MODIFY `idstadop` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipoevaluacion`
--
ALTER TABLE `tipoevaluacion`
  MODIFY `tipo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `turnos`
--
ALTER TABLE `turnos`
  MODIFY `turno_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `turnos_hora`
--
ALTER TABLE `turnos_hora`
  MODIFY `turHora_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `usu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `yearscolar`
--
ALTER TABLE `yearscolar`
  MODIFY `id_year` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `activiti`
--
ALTER TABLE `activiti`
  ADD CONSTRAINT `act_curs` FOREIGN KEY (`curso_act`) REFERENCES `curso` (`idcurso`);

--
-- Filtros para la tabla `activ_curso`
--
ALTER TABLE `activ_curso`
  ADD CONSTRAINT `avt_punt` FOREIGN KEY (`activ_Id`) REFERENCES `activiti` (`idactiviti`);

--
-- Filtros para la tabla `apoderados`
--
ALTER TABLE `apoderados`
  ADD CONSTRAINT `alumn_apo` FOREIGN KEY (`id_Alumn`) REFERENCES `alumno` (`idalumno`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD CONSTRAINT `alum_asist` FOREIGN KEY (`idalumno_asi`) REFERENCES `alumno` (`idalumno`);

--
-- Filtros para la tabla `jornadas`
--
ALTER TABLE `jornadas`
  ADD CONSTRAINT `year_grad` FOREIGN KEY (`gradoid`) REFERENCES `grado` (`idgrado`),
  ADD CONSTRAINT `year_jorn` FOREIGN KEY (`IdJornYear`) REFERENCES `yearscolar` (`id_year`),
  ADD CONSTRAINT `year_turn` FOREIGN KEY (`tunoid`) REFERENCES `turnos` (`turno_id`);

--
-- Filtros para la tabla `jornas_horas`
--
ALTER TABLE `jornas_horas`
  ADD CONSTRAINT `hor_jor` FOREIGN KEY (`jorna_ID`) REFERENCES `jornadas` (`IdJornas`);

--
-- Filtros para la tabla `matricula`
--
ALTER TABLE `matricula`
  ADD CONSTRAINT `alum_matr` FOREIGN KEY (`Id_alumno`) REFERENCES `alumno` (`idalumno`);

--
-- Filtros para la tabla `notas`
--
ALTER TABLE `notas`
  ADD CONSTRAINT `grado_alum` FOREIGN KEY (`gradoid`) REFERENCES `grado` (`idgrado`);

--
-- Filtros para la tabla `registopagos`
--
ALTER TABLE `registopagos`
  ADD CONSTRAINT `alum_pago` FOREIGN KEY (`alumno_id`) REFERENCES `alumno` (`idalumno`) ON DELETE CASCADE;

--
-- Filtros para la tabla `stadopenciones`
--
ALTER TABLE `stadopenciones`
  ADD CONSTRAINT `alun_stad` FOREIGN KEY (`entidad`) REFERENCES `alumno` (`idalumno`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`rol_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
