-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-04-2025 a las 19:04:35
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
-- Base de datos: `aldea`
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

--
-- Volcado de datos para la tabla `activiti`
--

INSERT INTO `activiti` (`idactiviti`, `yearId_act`, `curso_act`, `fechaCreatd`, `status`, `ordeperiodoTipo`, `tipo_evalu`, `User_sesion`) VALUES
(1, 1, 1, '2025-04-10', 'ACTIVO', 1, 2, 1),
(2, 1, 1, '2025-04-10', 'ACTIVO', 2, 2, 1);

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

--
-- Volcado de datos para la tabla `activ_curso`
--

INSERT INTO `activ_curso` (`actcur_id`, `activ_Id`, `actividades`, `puntajes`, `cursoid`, `fechaCreatd`, `ordenTipoeva`, `evalu_tipo`, `User_sesscion`, `yearId`) VALUES
(1, 1, 'COMPORTAMIENTO ', 50, 1, '2025-04-10', 1, '2', 1, 1),
(2, 1, 'ADAPTACION ', 30, 1, '2025-04-10', 1, '2', 1, 1),
(3, 1, 'PRIMER EXAMEN ', 20, 1, '2025-04-10', 1, '2', 1, 1),
(4, 2, 'COMPORTAMIENTO ', 50, 1, '2025-04-10', 2, '2', 1, 1),
(5, 2, 'ADAPTACION', 30, 1, '2025-04-10', 2, '2', 1, 1),
(6, 2, 'EXAMEN FINAL ', 20, 1, '2025-04-10', 2, '2', 1, 1);

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
(1, 'Pitta ', 'Victor ', 3198595, 983455074, 10001, 'M', '1988-09-30', 'ACTIVO', '2025-04-10', '2025-04-10', 'calle acaray sur c/avda campo via ', 3, 'usuarios/images.png', '0', '', 'Paraguay ', 36, 'ALTO PARANA ', 'CIUDAD DEL ESTE ', 'ASUNCION', ' oh+', '01/04/2025'),
(2, 'carlos ', 'pitta ', 32154, 98654474, 10002, '', '2018-10-02', 'ACTIVO', '2025-04-10', '2025-04-10', 'ciudad del este ', 3, 'usuarios/images.png', '1', '', 'Paraguay', 6, 'ALTO PARANA ', 'CIUDAD DEL ESTE ', 'ASUNCION', ' oh+', '01/04/2025');

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
  `telf_padre` varchar(45) NOT NULL,
  `direc_padre` varchar(45) NOT NULL,
  `email_padre` varchar(45) NOT NULL,
  `dateCreat` date DEFAULT NULL,
  `dateUpdate` date DEFAULT NULL,
  `id_Alumn` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `apoderados`
--

INSERT INTO `apoderados` (`idApoderado`, `paderNombre`, `PadreApellidos`, `padreDni`, `madreNombres`, `madreApellidos`, `madreDni`, `cole_procedente`, `coleUbicacion`, `coleCodigo`, `telf_padre`, `direc_padre`, `email_padre`, `dateCreat`, `dateUpdate`, `id_Alumn`) VALUES
(1, 'virgilio ', 'Pitta Rpdriguez', '505888', 'catalina ', 'Gomez Zorrilla ', '369852', 'INMACULADA ', 'CENTRO ', '02212', '0983455074', 'tobati', 'virgilio@gmail.com', '2025-04-10', '2025-04-10', 1),
(2, 'carlos ', 'portillo', '654877', 'alfojona', 'morales ', '325645', '', '', '', '0983455074', 'tobati', 'virgilio@gmail.com', '2025-04-10', '2025-04-10', 2);

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
(1, '1PA1', 1, 504, 28, 'LIBRE', '2023-01-23', '2024-09-28'),
(2, '1PA2', 1, 506, 32, 'LIBRE', '2023-01-23', '2024-09-28'),
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
(22, 'INI III', 1, 703, 19, 'OCUPADO', '2023-01-24', '2023-01-24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autorizados`
--

CREATE TABLE `autorizados` (
  `idAutorizado` int(11) NOT NULL,
  `nombre_autorizado1` varchar(45) DEFAULT NULL,
  `apellido_autorizado1` varchar(45) DEFAULT NULL,
  `parentesco_autorizado1` varchar(45) DEFAULT NULL,
  `nombre_autorizado2` varchar(45) DEFAULT NULL,
  `apellido_autorizado2` varchar(45) DEFAULT NULL,
  `parentesco_autorizado2` varchar(45) DEFAULT NULL,
  `id_Alumn` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `autorizados`
--

INSERT INTO `autorizados` (`idAutorizado`, `nombre_autorizado1`, `apellido_autorizado1`, `parentesco_autorizado1`, `nombre_autorizado2`, `apellido_autorizado2`, `parentesco_autorizado2`, `id_Alumn`) VALUES
(1, 'lucia ', 'echague', 'cunada ', 'perico ', 'echague', 'cundo', 2);

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

--
-- Volcado de datos para la tabla `criterio`
--

INSERT INTO `criterio` (`idboletNota`, `criteriosEvaluacion`, `curso_id`, `grado_id`, `yearEscolar_id`, `idnivel`, `fechRegistro`, `userSession`, `fechaUpdate`) VALUES
(1, 'COMPORTAMIENTO ', 1, 1, 1, 4, '2025-04-10', NULL, NULL),
(2, 'ADAPTACION', 1, 1, 1, 4, '2025-04-10', NULL, NULL),
(3, 'CANTRO ', 1, 1, 1, 4, '2025-04-10', NULL, NULL),
(4, 'COMPANERISMO ', 1, 1, 1, 4, '2025-04-10', NULL, NULL);

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

--
-- Volcado de datos para la tabla `curso`
--

INSERT INTO `curso` (`idcurso`, `cursoCodigo`, `nonbrecurso`, `abbreviation`, `components`, `statuscurso`, `fechaRegistro`, `fechaActualizacion`, `tipo`) VALUES
(1, 'C001', 'CLASES DE CANTO ', 'CC', '1', 'LIBRE', '2025-04-10 17:12:54', '2025-04-10 17:12:54', 'SEMESTRAL'),
(2, 'C002', 'COMPORTAMIENTO ', 'CTO', '1', 'LIBRE', '2025-04-10 17:13:38', '2025-04-10 17:13:38', 'SEMESTRAL');

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
  `tipo_docente` enum('CONTRATADO','NOMBRADO','HORAS') DEFAULT NULL,
  `estado_baja` enum('1','0') NOT NULL,
  `matricula` varchar(50) DEFAULT NULL,
  `cargo_mec` varchar(100) DEFAULT NULL,
  `cargo_int` varchar(100) DEFAULT NULL,
  `clase_cargo` varchar(100) DEFAULT NULL,
  `turno` varchar(50) DEFAULT NULL,
  `nivel_mec` varchar(100) DEFAULT NULL,
  `titulos_obtenidos` text DEFAULT NULL,
  `identificacion_aldea` varchar(100) DEFAULT NULL,
  `estado_civil` varchar(50) DEFAULT NULL,
  `lugar_nacimiento` varchar(100) DEFAULT NULL,
  `cargo_aldea` varchar(100) DEFAULT NULL,
  `nivel_grado` varchar(100) DEFAULT NULL,
  `createDate` date DEFAULT NULL,
  `updateDate` date DEFAULT NULL,
  `userSession` int(11) DEFAULT NULL,
  `fecha_ingreso` date DEFAULT NULL,
  `nacionalidad` varchar(50) DEFAULT NULL,
  `antiguedad` varchar(50) DEFAULT NULL,
  `antiguedad_docencia` varchar(50) DEFAULT NULL,
  `renuncia` varchar(10) DEFAULT NULL,
  `tipo_contrato` varchar(50) DEFAULT NULL,
  `observaciones` text DEFAULT NULL,
  `foto_docente` varchar(255) DEFAULT NULL,
  `cv_docente` varchar(255) DEFAULT NULL,
  `titulo_docente` varchar(255) DEFAULT NULL,
  `constancia_docente` varchar(255) DEFAULT NULL,
  `capacitaciones_docente` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `docentes`
--

INSERT INTO `docentes` (`id_docente`, `nombres`, `apellidos`, `dni`, `email`, `telefono`, `codigo`, `rolDocente`, `nivelId`, `tipo_docente`, `estado_baja`, `matricula`, `cargo_mec`, `cargo_int`, `clase_cargo`, `turno`, `nivel_mec`, `titulos_obtenidos`, `identificacion_aldea`, `estado_civil`, `lugar_nacimiento`, `cargo_aldea`, `nivel_grado`, `createDate`, `updateDate`, `userSession`, `fecha_ingreso`, `nacionalidad`, `antiguedad`, `antiguedad_docencia`, `renuncia`, `tipo_contrato`, `observaciones`, `foto_docente`, `cv_docente`, `titulo_docente`, `constancia_docente`, `capacitaciones_docente`) VALUES
(12, 'VICTOR ', 'PITTA ', '3198595', 'sebas@gmail.com', '0983455074 ', '1001', 2, 1, 'CONTRATADO', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-04-12', NULL, NULL, '2025-04-01', 'paraguaya ', '2', '3', 'NO ', 'A PLAZO FIJO', 'AZSDFSADFASD', 'foto_3198595_20250412_133833.png', 'cv_3198595_20250412_133833.pdf', 'titulo_3198595_20250412_133833.pdf', 'constancia_3198595_20250412_133833.pdf', 'capacitacion_3198595_20250412_133833.pdf'),
(13, '', '', '', '', '', '', 2, 0, '', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-04-12', NULL, NULL, '0000-00-00', '', '', '', '', '', '', '', '', '', '', ''),
(14, 'PAO ', 'MALTECE ', '2225588', 'malte@gmail.com', '0983455074', '1005', 2, 1, 'CONTRATADO', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-04-12', NULL, NULL, '2025-04-10', 'paraguaya ', '2', '3', 'NO ', 'INDETERMINADO', 'PREDETERMINADO ', 'foto_2225588_20250412_135739.png', 'cv_2225588_20250412_135739.pdf', 'titulo_2225588_20250412_135739.pdf', 'constancia_2225588_20250412_135739.pdf', 'capacitacion_2225588_20250412_135739.pdf'),
(15, 'CARLOS ', 'PERALTA ', '333666', 'peralta@gmail.com', '0983455074 ', '10041', 2, 1, 'NOMBRADO', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-04-12', NULL, NULL, '2025-04-11', 'paraguaya ', '2', '6', 'NO', 'A PLAZO FIJO', 'VAMOS A LOGRAR ', 'foto_333666_20250412_140140.png', 'cv_333666_20250412_140140.pdf', 'titulo_333666_20250412_140140.pdf', 'constancia_333666_20250412_140140.pdf', 'capacitacion_333666_20250412_140140.pdf'),
(16, 'PULO ', 'TUPAPA', '321654', 'pupio@gmail.com', '0983455074', '1003', 2, 1, 'CONTRATADO', '1', 'adhj22', 'Profesor/a de Ciencias Naturales ', 'EEB ', '3º Grado ', 'manana  ', '3° Grado EEB ', 'saSDFAWSEFARS ', 'SAD222', 'Soltero/a', 'ASUNCIN ', 'Profesor/a de Grado ', 'EEB ', '2025-04-12', '2025-04-14', NULL, '2025-04-03', 'paraguaya ', '3', '5', 'NO', 'INDETERMINADO', 'SE PUDO', 'foto_321654_20250414_111348.png', 'cv_321654_20250414_111348.pdf', 'titulo_321654_20250414_111348.pdf', 'constancia_321654_20250414_111348.pdf', 'capacitacion_321654_20250414_111348.pdf'),
(17, 'EMILCE ', 'DURE SOSA ', '31985999', 'pitta100@gmail.com', '0983455074', '10023', 2, 1, 'CONTRATADO', '1', 'adhj22', 'Profesor/a de Ciencias Naturales', 'EEB', '3º Grado', 'manana ', '3° Grado EEB', 'saSDFAWSEFARS', 'SAD222', 'Soltero/a', 'ASUNCIN', 'Profesor/a de Grado', 'EEB', '2025-04-14', NULL, NULL, '2025-04-01', 'paraguaya', '4', '5', 'NO ', 'A PLAZO FIJO', 'ASDSFAWSEFWE', 'foto_31985999_20250414_090309.png', 'cv_31985999_20250414_090309.pdf', 'titulo_31985999_20250414_090309.pdf', 'constancia_31985999_20250414_090309.pdf', 'capacitacion_31985999_20250414_090309.pdf');

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

--
-- Volcado de datos para la tabla `docente_curso`
--

INSERT INTO `docente_curso` (`iddocenteCurso`, `idDocente`, `idGrado`, `idCursos`, `idyear`, `Seccion`, `idSession`, `createDate`, `updateDate`) VALUES
(1, 1, 1, 1, 1, 'A', NULL, NULL, '2025-04-10'),
(2, 1, 1, 2, 1, 'A', NULL, NULL, '2025-04-10');

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

--
-- Volcado de datos para la tabla `docente_grados`
--

INSERT INTO `docente_grados` (`iddocentGrados`, `docenteId`, `gradoId`, `nivelgradiId`, `idseccion`, `yearId`, `sesionId`, `createDate`) VALUES
(1, 1, 1, 4, 'A', 1, 0, '2025-04-10');

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
(1, 1, 'FASE REGULAR', '2025-02-05', '2025-11-25', 'ACTIVO'),
(2, 1, 'FASE RECUPERACION', '2025-11-26', '2025-12-30', 'ACTIVO');

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

--
-- Volcado de datos para la tabla `grado`
--

INSERT INTO `grado` (`idgrado`, `gradonombre`, `aula_id`, `turno_id`, `nivel_id`, `vacantes`, `seccion`, `fechaRegistro`, `fechaActualizacion`, `gradostatus`, `year_id`) VALUES
(1, 'PRIMER GRADO TURNO MANANA A ', 22, 1, 4, 18, 'A', '2025-04-10 17:11:09', '2025-04-10 17:11:09', 'ACTIVO', 1);

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

--
-- Volcado de datos para la tabla `grado_curso`
--

INSERT INTO `grado_curso` (`idgrado_curso`, `grado_id`, `curso_id`, `yearEscolar`, `Idseccion`, `dateRegistro`, `dateUpdate`) VALUES
(1, 1, 1, 1, 'A', '2025-04-10', '2025-04-10'),
(2, 1, 2, 1, 'A', '2025-04-10', '2025-04-10');

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
(1, 1, '20250410145727', 1, '2025-04-10 12:57:27', '2025-04-10 12:57:27'),
(2, 2, '20250410210125', 1, '2025-04-10 19:01:25', '2025-04-10 19:01:25');

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

--
-- Volcado de datos para la tabla `matricula`
--

INSERT INTO `matricula` (`idmatricula`, `Id_alumno`, `Id_grado`, `Id_aula`, `Id_turno`, `Id_nivls`, `cargoPago`, `year_id`, `seccion`, `cargoMatricula`, `creatDate`, `updateDate`) VALUES
(1, 2, 1, 22, 1, 4, 'SI', 1, 'A', 350000, '2025-04-10', '2025-04-10');

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

--
-- Volcado de datos para la tabla `periodo`
--

INSERT INTO `periodo` (`id_periodo`, `year_id`, `tipo_periodo`, `ordenTipo_periodo`, `fech_inicio`, `fech_final`, `p_stado`) VALUES
(1, 1, 2, 1, '2025-02-02', '2025-06-06', 'ACTIVO'),
(2, 1, 2, 2, '2025-07-01', '2025-11-20', 'ACTIVO');

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
(1, 1, '', '', '', '', 1, '2025-04-10 12:57:27', '2025-04-10 18:46:55'),
(2, 1, '', '', '', '', 1, '2025-04-10 12:57:27', '2025-04-10 18:46:55'),
(3, 1, '', '', '', '', 1, '2025-04-10 12:57:27', '2025-04-10 18:46:55'),
(4, 1, '', '', '', '', 1, '2025-04-10 12:57:27', '2025-04-10 18:46:55'),
(5, 1, '', '', '', '', 1, '2025-04-10 12:57:27', '2025-04-10 18:46:55'),
(6, 1, '', '', '', '', 1, '2025-04-10 12:57:27', '2025-04-10 18:46:55'),
(7, 2, '', '', '', '', 1, '2025-04-10 19:01:25', '2025-04-10 19:02:24'),
(8, 2, '', '', '', '', 1, '2025-04-10 19:01:25', '2025-04-10 19:02:24'),
(9, 2, '', '', '', '', 1, '2025-04-10 19:01:25', '2025-04-10 19:02:24'),
(10, 2, '', '', '', '', 1, '2025-04-10 19:01:25', '2025-04-10 19:02:24'),
(11, 2, '', '', '', '', 1, '2025-04-10 19:01:25', '2025-04-10 19:02:24'),
(12, 2, '', '', '', '', 1, '2025-04-10 19:01:25', '2025-04-10 19:02:24');

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

--
-- Volcado de datos para la tabla `registopagos`
--

INSERT INTO `registopagos` (`idregistropagos`, `alumno_id`, `tipo`, `year_id`, `motoPago`, `stadoPago`, `fechasPagados`, `prox_pago`, `dateoperation`) VALUES
(1, 2, 'MATRÍCULA', 1, 350000, 'PAGADO', '2025-04-10', '2025-05-10', '2025-04-10');

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

--
-- Volcado de datos para la tabla `stadopenciones`
--

INSERT INTO `stadopenciones` (`idstadop`, `entidad`, `ultimoPagofecha`, `proximoPagoFecha`, `stado`, `userSesion`, `createDate`, `updateDate`, `yeayid`, `aplicargo`) VALUES
(1, 2, '2025-04-10', '2025-05-10', 'PAGADO', 1, '2025-04-10', '2025-04-10', 1, 'SI');

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
(4, 'PERIODO SEMESTRAL', 'ACTIVO', 4, '2024-09-27 05:06:40', '2024-09-27 05:06:40');

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
(5, 1, '07:00', '11:45', 1, 'ACTIVO'),
(6, 1, '13:00', '17:00', 3, 'ACTIVO');

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
(1, '2025-02-02', '2025-12-30', '2025-05-10', 'NOTAS FINALES', '2025', 'ACTIVO');

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
-- Indices de la tabla `autorizados`
--
ALTER TABLE `autorizados`
  ADD PRIMARY KEY (`idAutorizado`),
  ADD KEY `id_Alumn` (`id_Alumn`);

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
  MODIFY `idactiviti` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `activ_curso`
--
ALTER TABLE `activ_curso`
  MODIFY `actcur_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
-- AUTO_INCREMENT de la tabla `autorizados`
--
ALTER TABLE `autorizados`
  MODIFY `idAutorizado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `idboletNota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `curso`
--
ALTER TABLE `curso`
  MODIFY `idcurso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `docentes`
--
ALTER TABLE `docentes`
  MODIFY `id_docente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `docente_curso`
--
ALTER TABLE `docente_curso`
  MODIFY `iddocenteCurso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `docente_grados`
--
ALTER TABLE `docente_grados`
  MODIFY `iddocentGrados` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `idgrado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `grado_curso`
--
ALTER TABLE `grado_curso`
  MODIFY `idgrado_curso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `idmatricula` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id_periodo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `idregistropagos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `rol_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `stadopenciones`
--
ALTER TABLE `stadopenciones`
  MODIFY `idstadop` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tipoevaluacion`
--
ALTER TABLE `tipoevaluacion`
  MODIFY `tipo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `turnos`
--
ALTER TABLE `turnos`
  MODIFY `turno_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `turnos_hora`
--
ALTER TABLE `turnos_hora`
  MODIFY `turHora_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
-- Filtros para la tabla `autorizados`
--
ALTER TABLE `autorizados`
  ADD CONSTRAINT `autorizados_ibfk_1` FOREIGN KEY (`id_Alumn`) REFERENCES `alumno` (`idalumno`);

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

CREATE TABLE messages (
    id INT AUTO_INCREMENT PRIMARY KEY,  -- ID único del mensaje
    sender_id INT NOT NULL,  -- ID del usuario que envía el mensaje
    recipient_id INT NULL,  -- ID del usuario destinatario, NULL para mensajes masivos
    subject VARCHAR(255) NOT NULL,  -- Asunto del mensaje
    content TEXT NOT NULL,  -- Contenido del mensaje
    is_approved TINYINT DEFAULT 0,  -- Estado del mensaje (0=pendiente, 1=aprobado, 2=rechazado, 3=oculto)
    status TINYINT DEFAULT 1,  -- Tipo de envío (1=activo, 0=borado)
    send_type TINYINT DEFAULT 1,  -- Tipo de envío (1=individual, 2=masivo)
    parent_message_id INT NULL,  -- ID del mensaje original al que se responde, NULL si no es respuesta
    parent_comment_id INT NULL,  -- ID del mensaje al que se responde como comentario, NULL si no es comentario
    approver_id INT NULL,  -- ID del administrador que aprobó el mensaje (si es necesario)
    likes_count INT DEFAULT 0,  -- Número total de "likes" que ha recibido el mensaje
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,  -- Fecha de creación del mensaje
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,  -- Fecha de última actualización
    
    -- Relaciones con la tabla `users`
    FOREIGN KEY (sender_id) REFERENCES usuarios(usu_id),
    FOREIGN KEY (recipient_id) REFERENCES usuarios(usu_id),
    FOREIGN KEY (approver_id) REFERENCES usuarios(usu_id),
    FOREIGN KEY (parent_message_id) REFERENCES messages(id),  -- Relación con el mensaje original
    FOREIGN KEY (parent_comment_id) REFERENCES messages(id)  -- Relación con el comentario
);



CREATE TABLE message_recipients (
    id INT AUTO_INCREMENT PRIMARY KEY,  -- ID único del destinatario del mensaje
    message_id INT NOT NULL,  -- Referencia al mensaje en la tabla `messages`
    user_id INT NOT NULL,  -- ID del usuario destinatario
    status TINYINT DEFAULT 1,  -- Estado del mensaje para el destinatario (0=eliminado, 1=activo)
    is_read TINYINT DEFAULT 0,  -- Si el destinatario ha leído el mensaje (0=no leído, 1=leído)
    is_favorite TINYINT DEFAULT 0,  -- Si el destinatario ha marcado el mensaje como favorito (0=no, 1=sí)
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,  -- Fecha de creación del registro
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,  -- Fecha de última actualización
    
    -- Relaciones con las tablas `messages` y `users`
    FOREIGN KEY (message_id) REFERENCES messages(id),
    FOREIGN KEY (user_id) REFERENCES usuarios(usu_id)
   
);

CREATE TABLE events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    start_date DATETIME NOT NULL,
    end_date DATETIME NOT NULL,
    location VARCHAR(512) DEFAULT NULL,
    is_virtual BOOLEAN DEFAULT FALSE,
    virtual_link VARCHAR(512) DEFAULT NULL,
    organizer_id INT DEFAULT NULL, -- Creator user ID
    is_approved TINYINT DEFAULT 0, -- 0 = pending, 1 = approved
    approver_id INT DEFAULT NULL,  -- Admin who approved
    status TINYINT DEFAULT 1,      -- 1 = active, 0 = deleted
    background_color VARCHAR(20) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (organizer_id) REFERENCES usuarios(usu_id)
);
CREATE TABLE event_recipients (
    id INT AUTO_INCREMENT PRIMARY KEY,
    event_id INT NOT NULL,
    recipient_type ENUM('individual', 'grade', 'role', 'public') NOT NULL,
    recipient_id INT NULL, -- NULL para 'public'
    status TINYINT DEFAULT 1,  -- 1=Activo, 0=Eliminado
    is_read TINYINT DEFAULT 0, -- 0=No leído, 1=Leído
    is_favorite TINYINT DEFAULT 0, -- 0=No favorito, 1=Favorito
    
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    FOREIGN KEY (event_id) REFERENCES events(id),
    INDEX idx_recipient (recipient_type, recipient_id)
);



CREATE TABLE attachments (
    id INT AUTO_INCREMENT PRIMARY KEY,  -- ID único del archivo adjunto
    message_id INT DEFAULT NULL,  -- Referencia al mensaje en la tabla `messages`
    event_id INT DEFAULT NULL,   
    file_name VARCHAR(255) NOT NULL,  -- Nombre del archivo adjunto
    file_type TEXT NOT NULL,  -- tipo de archivo
    file_path VARCHAR(512) NOT NULL,  -- Ruta donde se guarda el archivo en el servidor
    isFavorite TINYINT DEFAULT 0,
    status TINYINT DEFAULT 1,  -- Estado del archivo (0=eliminado, 1=activo)
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,  -- Fecha de creación del adjunto
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,  -- Fecha de última actualización
    
    -- Relación con la tabla `messages`
    FOREIGN KEY (message_id) REFERENCES messages(id),
     FOREIGN KEY (event_id) REFERENCES events(id)
);
CREATE TABLE message_details (
    id INT AUTO_INCREMENT PRIMARY KEY,  -- ID único del detalle del mensaje
    message_id INT NOT NULL,  -- Referencia al mensaje en la tabla `messages`
    recipient_id INT NOT NULL,  -- ID del destinatario
    is_read TINYINT DEFAULT 0,  -- Estado del mensaje para el destinatario (0=pendiente, 1=leído, 2=eliminado)
    status TINYINT DEFAULT 0,
    read_at TIMESTAMP NULL,  -- Fecha y hora en que el destinatario leyó el mensaje
    deleted TINYINT DEFAULT 0,  -- Si el destinatario eliminó el mensaje (0=no, 1=sí)
    is_favorite TINYINT DEFAULT 0,  -- Si el destinatario ha marcado el mensaje como favorito (0=no, 1=sí)
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,  -- Fecha de creación del registro
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,  -- Fecha de última actualización
    
    -- Relaciones con las tablas `messages` y `users`
    FOREIGN KEY (message_id) REFERENCES messages(id),
    FOREIGN KEY (recipient_id) REFERENCES usuarios(usu_id)
);
CREATE TABLE user_favorites (
    id INT AUTO_INCREMENT PRIMARY KEY,                -- Identificador único (opcional)
    event_id INT NOT NULL,                             -- ID del evento
    user_id INT NOT NULL,                              -- ID del usuario
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,    -- Fecha de creación
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,  -- Fecha de actualización
    
    -- Restricción para evitar duplicados
    UNIQUE KEY unique_favorite (event_id, user_id)     -- Asegura que cada usuario tenga un solo favorito por evento
);


COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
