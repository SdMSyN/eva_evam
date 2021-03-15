-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-03-2021 a las 17:31:13
-- Versión del servidor: 10.1.30-MariaDB
-- Versión de PHP: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `eva_evam`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aviso_asig_alum`
--

CREATE TABLE `aviso_asig_alum` (
  `id` int(11) NOT NULL,
  `aviso_info_id` int(11) NOT NULL,
  `alumno_id` int(11) NOT NULL,
  `enterado` int(11) DEFAULT NULL,
  `fecha_enterado` datetime DEFAULT NULL,
  `creado` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `aviso_asig_alum`
--

INSERT INTO `aviso_asig_alum` (`id`, `aviso_info_id`, `alumno_id`, `enterado`, `fecha_enterado`, `creado`) VALUES
(1, 1, 1, NULL, NULL, '2020-04-21'),
(2, 1, 2, NULL, NULL, '2020-04-21'),
(3, 1, 3, NULL, NULL, '2020-04-21'),
(4, 2, 1, NULL, NULL, '2020-04-21'),
(5, 2, 2, NULL, NULL, '2020-04-21'),
(6, 2, 3, NULL, NULL, '2020-04-21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aviso_asig_tutor`
--

CREATE TABLE `aviso_asig_tutor` (
  `id` int(11) NOT NULL,
  `aviso_info_id` int(11) NOT NULL,
  `tutor_id` int(11) NOT NULL,
  `enterado` int(11) DEFAULT NULL,
  `fecha_enterado` datetime DEFAULT NULL,
  `creado` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `aviso_asig_tutor`
--

INSERT INTO `aviso_asig_tutor` (`id`, `aviso_info_id`, `tutor_id`, `enterado`, `fecha_enterado`, `creado`) VALUES
(1, 2, 1, NULL, NULL, '2020-04-21'),
(2, 2, 2, NULL, NULL, '2020-04-21'),
(3, 2, 3, NULL, NULL, '2020-04-21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aviso_info`
--

CREATE TABLE `aviso_info` (
  `id` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `tipo_aviso_id` int(11) NOT NULL,
  `dirigido_a` int(11) DEFAULT NULL,
  `creado_por` int(11) NOT NULL,
  `perfil_creador` int(11) NOT NULL,
  `profesor_id` int(11) NOT NULL,
  `creado` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `aviso_info`
--

INSERT INTO `aviso_info` (`id`, `nombre`, `tipo_aviso_id`, `dirigido_a`, `creado_por`, `perfil_creador`, `profesor_id`, `creado`) VALUES
(1, 'Aviso 1', 4, 1, 3, 2, 3, '2020-04-21'),
(2, 'Aviso', 2, 3, 3, 2, 3, '2020-04-21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aviso_tipo`
--

CREATE TABLE `aviso_tipo` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `aviso_tipo`
--

INSERT INTO `aviso_tipo` (`id`, `nombre`) VALUES
(1, 'Evento escolar'),
(2, 'Agenda Escolar'),
(3, 'Emergencia'),
(4, 'Boletin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `banco_bloques`
--

CREATE TABLE `banco_bloques` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `banco_materia_id` int(11) NOT NULL,
  `creado` date NOT NULL,
  `actualizado` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `banco_bloques`
--

INSERT INTO `banco_bloques` (`id`, `nombre`, `banco_materia_id`, `creado`, `actualizado`) VALUES
(1, 'EspaÃ±ol 5', 87, '2019-01-05', '2019-01-05'),
(2, 'EspaÃ±ol 6', 87, '2019-01-05', '2019-01-05'),
(3, 'InglÃ©s', 87, '2019-01-05', '2019-01-05'),
(4, 'MatemÃ¡ticas 5', 88, '2019-01-05', '2019-01-05'),
(5, 'MatemÃ¡ticas 6', 88, '2019-01-05', '2019-01-05'),
(6, 'Ciencias naturales 5', 89, '2019-01-05', '2019-01-05'),
(7, 'Ciencias naturales 6', 89, '2019-01-05', '2019-01-05'),
(8, 'Historia 5', 90, '2019-01-05', '2019-01-05'),
(9, 'Historia 6', 90, '2019-01-05', '2019-01-05'),
(10, 'GeografÃ­a 5', 90, '2019-01-05', '2019-01-05'),
(11, 'GeografÃ­a 6', 90, '2019-01-05', '2019-01-05'),
(12, 'FCE 5', 90, '2019-01-05', '2019-01-05'),
(13, 'FCE 6', 90, '2019-01-05', '2019-01-05'),
(14, 'EspaÃ±ol 1', 91, '2019-01-05', '2019-01-05'),
(15, 'EspaÃ±ol 2', 91, '2019-01-05', '2019-01-05'),
(16, 'EspaÃ±ol 3', 91, '2019-01-05', '2019-01-05'),
(17, 'InglÃ©s 1', 91, '2019-01-05', '2019-01-05'),
(18, 'InglÃ©s 2', 91, '2019-01-05', '2019-01-05'),
(19, 'InglÃ©s 3', 91, '2019-01-05', '2019-01-05'),
(20, 'MatemÃ¡ticas 1', 92, '2019-01-05', '2019-01-05'),
(21, 'MatemÃ¡ticas 2', 92, '2019-01-05', '2019-01-05'),
(22, 'MatemÃ¡ticas 3', 92, '2019-01-05', '2019-01-05'),
(23, 'BiologÃ­a', 93, '2019-01-05', '2019-01-05'),
(24, 'FÃ­sica', 93, '2019-01-05', '2019-01-05'),
(25, 'QuÃ­mica', 93, '2019-01-05', '2019-01-05'),
(26, 'Historia 1', 94, '2019-01-05', '2019-01-05'),
(27, 'Historia 2', 94, '2019-01-05', '2019-01-05'),
(28, 'Historia 3', 94, '2019-01-05', '2019-01-05'),
(29, 'GeografÃ­a', 94, '2019-01-05', '2019-01-05'),
(30, 'FCE 1', 94, '2019-01-05', '2019-01-05'),
(31, 'FCE 2', 94, '2019-01-05', '2019-01-05'),
(32, 'FCE 3', 94, '2019-01-05', '2019-01-05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `banco_materias`
--

CREATE TABLE `banco_materias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `nivel_escolar_id` int(11) NOT NULL,
  `creado_por` int(11) DEFAULT NULL,
  `creado` date NOT NULL,
  `actualizado` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `banco_materias`
--

INSERT INTO `banco_materias` (`id`, `nombre`, `nivel_escolar_id`, `creado_por`, `creado`, `actualizado`) VALUES
(87, 'Lenguaje y comunicaciÃ³n', 1, NULL, '2019-01-05', '2019-01-05'),
(88, 'Pensamiento matemÃ¡tico', 1, NULL, '2019-01-05', '2019-01-05'),
(89, 'Ciencias experimentales', 1, NULL, '2019-01-05', '2019-01-05'),
(90, 'Ciencias Sociales', 1, NULL, '2019-01-05', '2019-01-05'),
(91, 'Lenguaje y comunicaciÃ³n', 2, NULL, '2019-01-05', '2019-01-05'),
(92, 'Pensamiento matemÃ¡tico', 2, NULL, '2019-01-05', '2019-01-05'),
(93, 'Ciencias experimentales', 2, NULL, '2019-01-05', '2019-01-05'),
(94, 'Ciencias sociales', 2, NULL, '2019-01-05', '2019-01-05'),
(95, 'ComunicaciÃ³n', 3, NULL, '2019-01-05', '2019-01-05'),
(96, 'MatemÃ¡ticas', 3, NULL, '2019-01-05', '2019-01-05'),
(97, 'Ciencias experimentales', 3, NULL, '2019-01-05', '2019-01-05'),
(98, 'Ciencias sociales', 3, NULL, '2019-01-05', '2019-01-05'),
(99, 'Humanidades', 3, NULL, '2019-01-05', '2019-01-05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `banco_preguntas`
--

CREATE TABLE `banco_preguntas` (
  `id` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `archivo` varchar(100) DEFAULT NULL,
  `valor_preg` int(11) NOT NULL,
  `tipo_resp` int(11) NOT NULL,
  `superior_id` int(11) DEFAULT NULL,
  `banco_materia_id` int(11) DEFAULT NULL,
  `banco_bloque_id` int(11) DEFAULT NULL,
  `banco_tema_id` int(11) DEFAULT NULL,
  `banco_subtema_id` int(11) DEFAULT NULL,
  `creado_por_id` int(11) DEFAULT NULL,
  `perfil_creador` int(11) NOT NULL,
  `compartir` int(11) NOT NULL,
  `activo` int(11) NOT NULL,
  `creado` date NOT NULL,
  `actualizado` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `banco_preguntas`
--

INSERT INTO `banco_preguntas` (`id`, `nombre`, `archivo`, `valor_preg`, `tipo_resp`, `superior_id`, `banco_materia_id`, `banco_bloque_id`, `banco_tema_id`, `banco_subtema_id`, `creado_por_id`, `perfil_creador`, `compartir`, `activo`, `creado`, `actualizado`) VALUES
(1, 'Convierte 3/4 a decimal:', NULL, 1, 3, NULL, 92, 20, NULL, NULL, 2, 10, 1, 0, '2019-01-08', '2019-01-08'),
(2, '3/4 x 1/2', NULL, 1, 1, NULL, 92, 21, 2, 1, 2, 10, 1, 0, '2019-01-08', '2019-01-08'),
(3, 'Convierte 1/2 a decimal', NULL, 1, 3, NULL, 92, 20, 1, NULL, 2, 10, 1, 0, '2019-01-18', '2019-01-18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `banco_respuestas`
--

CREATE TABLE `banco_respuestas` (
  `id` int(11) NOT NULL,
  `nombre` text,
  `archivo` varchar(100) DEFAULT NULL,
  `correcta` int(11) NOT NULL,
  `tipo_resp` int(11) NOT NULL,
  `palabras` text,
  `banco_pregunta_id` int(11) NOT NULL,
  `creado` date NOT NULL,
  `actualizado` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `banco_respuestas`
--

INSERT INTO `banco_respuestas` (`id`, `nombre`, `archivo`, `correcta`, `tipo_resp`, `palabras`, `banco_pregunta_id`, `creado`, `actualizado`) VALUES
(1, '', NULL, 0, 3, '0.75', 1, '2019-01-08', '2019-01-08'),
(2, '3/8', NULL, 1, 1, '', 2, '2019-01-08', '2019-01-08'),
(3, '4/6', NULL, 0, 1, '', 2, '2019-01-08', '2019-01-08'),
(4, '6/4', NULL, 0, 1, '', 2, '2019-01-08', '2019-01-08'),
(5, '', NULL, 0, 3, '0.5', 3, '2019-01-18', '2019-01-18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `banco_subtemas`
--

CREATE TABLE `banco_subtemas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `banco_tema_id` int(11) NOT NULL,
  `creado` date NOT NULL,
  `actualizado` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `banco_subtemas`
--

INSERT INTO `banco_subtemas` (`id`, `nombre`, `banco_tema_id`, `creado`, `actualizado`) VALUES
(1, 'Propias', 2, '2019-01-08', '2019-01-08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `banco_temas`
--

CREATE TABLE `banco_temas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `banco_bloque_id` int(11) NOT NULL,
  `creado` date NOT NULL,
  `actualizado` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `banco_temas`
--

INSERT INTO `banco_temas` (`id`, `nombre`, `banco_bloque_id`, `creado`, `actualizado`) VALUES
(1, 'NÃºmeros', 20, '2019-01-08', '2019-01-08'),
(2, 'MultiplicaciÃ³n de fracciones', 21, '2019-01-08', '2019-01-08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `est_exa_respuestas_tmp`
--

CREATE TABLE `est_exa_respuestas_tmp` (
  `id` int(11) NOT NULL,
  `alumno_id` int(11) NOT NULL,
  `exa_info_id` int(11) NOT NULL,
  `exa_info_asig_alum_id` int(11) NOT NULL,
  `pregunta_id` int(11) NOT NULL,
  `tipo_resp_id` int(11) NOT NULL,
  `respuesta_id` int(11) NOT NULL,
  `respuesta` varchar(250) DEFAULT NULL,
  `creado` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `est_exa_respuestas_tmp`
--

INSERT INTO `est_exa_respuestas_tmp` (`id`, `alumno_id`, `exa_info_id`, `exa_info_asig_alum_id`, `pregunta_id`, `tipo_resp_id`, `respuesta_id`, `respuesta`, `creado`) VALUES
(7, 3, 1, 6, 1, 3, 1, '0.75', '2019-01-18 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `est_exa_result_info`
--

CREATE TABLE `est_exa_result_info` (
  `id` int(11) NOT NULL,
  `exa_info_id` int(11) NOT NULL,
  `exa_info_asig_alum_id` int(11) NOT NULL,
  `alumno_id` int(11) NOT NULL,
  `num_pregs` int(11) NOT NULL,
  `preg_contestadas` int(11) NOT NULL,
  `preg_no_contestadas` int(11) NOT NULL,
  `resp_buenas` int(11) NOT NULL,
  `resp_malas` int(11) NOT NULL,
  `valor_exa` int(11) NOT NULL,
  `valor_exa_alum` int(11) NOT NULL,
  `calificacion` float NOT NULL,
  `porcentaje` float NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fin` time NOT NULL,
  `creado` date NOT NULL,
  `actualizado` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `est_exa_result_info`
--

INSERT INTO `est_exa_result_info` (`id`, `exa_info_id`, `exa_info_asig_alum_id`, `alumno_id`, `num_pregs`, `preg_contestadas`, `preg_no_contestadas`, `resp_buenas`, `resp_malas`, `valor_exa`, `valor_exa_alum`, `calificacion`, `porcentaje`, `hora_inicio`, `hora_fin`, `creado`, `actualizado`) VALUES
(1, 1, 4, 1, 5, 5, 0, 2, 3, 5, 2, 4, 40, '09:40:00', '09:40:00', '2019-01-18', '2019-01-18'),
(2, 1, 5, 2, 5, 5, 0, 0, 5, 5, 0, 0, 0, '09:42:00', '10:12:00', '2019-01-18', '2019-01-18'),
(3, 1, 6, 3, 5, 0, 5, 0, 0, 5, 0, 0, 0, '10:15:00', '10:19:00', '2019-01-18', '2019-01-18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `est_exa_result_preguntas`
--

CREATE TABLE `est_exa_result_preguntas` (
  `id` int(11) NOT NULL,
  `exa_info_id` int(11) NOT NULL,
  `exa_info_asig_alum_id` int(11) NOT NULL,
  `alumno_id` int(11) NOT NULL,
  `pregunta_id` int(11) NOT NULL,
  `tipo_resp_id` int(11) NOT NULL,
  `respuesta_id` int(11) NOT NULL,
  `respuesta` varchar(250) NOT NULL,
  `exa_result_info_id` int(11) NOT NULL,
  `calificacion` float NOT NULL,
  `creado` date NOT NULL,
  `actualizado` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `est_exa_result_preguntas`
--

INSERT INTO `est_exa_result_preguntas` (`id`, `exa_info_id`, `exa_info_asig_alum_id`, `alumno_id`, `pregunta_id`, `tipo_resp_id`, `respuesta_id`, `respuesta`, `exa_result_info_id`, `calificacion`, `creado`, `actualizado`) VALUES
(1, 1, 4, 1, 1, 3, 1, '.7', 1, 0, '2019-01-18', '2019-01-18'),
(2, 1, 4, 1, 1, 3, 1, '.7', 1, 0, '2019-01-18', '2019-01-18'),
(3, 1, 4, 1, 2, 1, 0, '2', 1, 1, '2019-01-18', '2019-01-18'),
(4, 1, 4, 1, 3, 3, 5, '.5', 1, 0, '2019-01-18', '2019-01-18'),
(5, 1, 4, 1, 2, 1, 0, '2', 1, 1, '2019-01-18', '2019-01-18'),
(6, 1, 5, 2, 1, 3, 1, '.75', 2, 0, '2019-01-18', '2019-01-18'),
(7, 1, 5, 2, 1, 3, 1, '.75', 2, 0, '2019-01-18', '2019-01-18'),
(8, 1, 5, 2, 2, 1, 0, '3', 2, 0, '2019-01-18', '2019-01-18'),
(9, 1, 5, 2, 3, 3, 5, 'm', 2, 0, '2019-01-18', '2019-01-18'),
(10, 1, 5, 2, 2, 1, 0, '3', 2, 0, '2019-01-18', '2019-01-18'),
(11, 1, 6, 3, 1, 3, 0, '', 3, 2, '2019-01-18', '2019-01-18'),
(12, 1, 6, 3, 1, 3, 0, '', 3, 2, '2019-01-18', '2019-01-18'),
(13, 1, 6, 3, 2, 1, 0, '', 3, 2, '2019-01-18', '2019-01-18'),
(14, 1, 6, 3, 3, 3, 0, '', 3, 2, '2019-01-18', '2019-01-18'),
(15, 1, 6, 3, 2, 1, 0, '', 3, 2, '2019-01-18', '2019-01-18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `est_exa_tiempos`
--

CREATE TABLE `est_exa_tiempos` (
  `id` int(11) NOT NULL,
  `exa_info_id` int(11) NOT NULL,
  `exa_info_asig_alum_id` int(11) NOT NULL,
  `alumno_id` int(11) NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fin` time DEFAULT NULL,
  `tiempo` time DEFAULT NULL,
  `creado` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `est_exa_tiempos`
--

INSERT INTO `est_exa_tiempos` (`id`, `exa_info_id`, `exa_info_asig_alum_id`, `alumno_id`, `hora_inicio`, `hora_fin`, `tiempo`, `creado`) VALUES
(1, 1, 4, 1, '09:40:00', '09:40:00', NULL, '2019-01-18'),
(2, 1, 5, 2, '09:42:00', '10:12:00', NULL, '2019-01-18'),
(3, 1, 6, 3, '10:15:00', '10:19:00', NULL, '2019-01-18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `exa_info`
--

CREATE TABLE `exa_info` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `banco_materia_id` int(11) NOT NULL,
  `creado` date NOT NULL,
  `creado_por` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `exa_info`
--

INSERT INTO `exa_info` (`id`, `nombre`, `banco_materia_id`, `creado`, `creado_por`) VALUES
(1, 'Parcial I', 92, '2019-01-08', 3),
(2, 'Ejemplo_prof3', 91, '2020-08-10', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `exa_info_asig`
--

CREATE TABLE `exa_info_asig` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `grupo_materia_profesor_id` int(11) NOT NULL,
  `inicio` datetime NOT NULL,
  `fin` datetime NOT NULL,
  `mostrar_resultado` datetime DEFAULT NULL,
  `tiempo` time NOT NULL,
  `aleatorio` int(11) NOT NULL,
  `exa_info_id` int(11) NOT NULL,
  `creado` date NOT NULL,
  `actualizado` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `exa_info_asig`
--

INSERT INTO `exa_info_asig` (`id`, `nombre`, `grupo_materia_profesor_id`, `inicio`, `fin`, `mostrar_resultado`, `tiempo`, `aleatorio`, `exa_info_id`, `creado`, `actualizado`) VALUES
(2, 'Tarea 3', 1, '2019-01-18 00:01:00', '2019-01-18 23:59:00', '0000-00-00 00:00:00', '00:05:00', 1, 1, '2019-01-18', '2019-01-18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `exa_info_asig_alum`
--

CREATE TABLE `exa_info_asig_alum` (
  `id` int(11) NOT NULL,
  `grupo_id` int(11) NOT NULL,
  `alumno_id` int(11) NOT NULL,
  `exa_info_asig_id` int(11) NOT NULL,
  `creado` date NOT NULL,
  `actualizado` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `exa_info_asig_alum`
--

INSERT INTO `exa_info_asig_alum` (`id`, `grupo_id`, `alumno_id`, `exa_info_asig_id`, `creado`, `actualizado`) VALUES
(4, 1, 1, 2, '2019-01-18', '2019-01-18'),
(5, 1, 2, 2, '2019-01-18', '2019-01-18'),
(6, 1, 3, 2, '2019-01-18', '2019-01-18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `exa_preguntas`
--

CREATE TABLE `exa_preguntas` (
  `id` int(11) NOT NULL,
  `banco_pregunta_id` int(11) NOT NULL,
  `exa_info_id` int(11) NOT NULL,
  `creado` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `exa_preguntas`
--

INSERT INTO `exa_preguntas` (`id`, `banco_pregunta_id`, `exa_info_id`, `creado`) VALUES
(1, 1, 1, '2019-01-08'),
(2, 1, 1, '2019-01-18'),
(3, 2, 1, '2019-01-18'),
(4, 3, 1, '2019-01-18'),
(5, 2, 1, '2019-01-18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos_info`
--

CREATE TABLE `grupos_info` (
  `id` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `nivel_escolar_id` int(11) NOT NULL,
  `nivel_turno_id` int(11) NOT NULL,
  `nivel_grado_id` int(11) NOT NULL,
  `usuario_profesor_id` int(11) NOT NULL,
  `creado` date NOT NULL,
  `actualizado` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `grupos_info`
--

INSERT INTO `grupos_info` (`id`, `nombre`, `nivel_escolar_id`, `nivel_turno_id`, `nivel_grado_id`, `usuario_profesor_id`, `creado`, `actualizado`) VALUES
(1, 'A', 2, 1, 8, 3, '2019-01-08', '2019-01-08'),
(2, 'ElectrÃ³nica', 2, 2, 7, 6, '2019-01-08', '2019-01-08'),
(3, 'ElectrÃ³nica', 2, 1, 9, 6, '2019-01-08', '2019-01-08'),
(4, 'A', 2, 1, 8, 3, '2019-01-18', '2019-01-18'),
(5, 'A', 2, 1, 8, 3, '2019-01-18', '2019-01-18'),
(6, 'F', 2, 1, 7, 5, '2020-08-10', '2020-08-10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos_materias_profesores`
--

CREATE TABLE `grupos_materias_profesores` (
  `id` int(11) NOT NULL,
  `banco_materia_id` int(11) NOT NULL,
  `usuario_profesor_id` int(11) NOT NULL,
  `grupo_info_id` int(11) NOT NULL,
  `creado` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `grupos_materias_profesores`
--

INSERT INTO `grupos_materias_profesores` (`id`, `banco_materia_id`, `usuario_profesor_id`, `grupo_info_id`, `creado`) VALUES
(1, 92, 3, 1, '2019-01-08'),
(2, 92, 6, 2, '2019-01-08'),
(3, 92, 6, 3, '2019-01-08'),
(4, 92, 3, 4, '2019-01-18'),
(5, 92, 3, 5, '2019-01-18'),
(6, 91, 5, 6, '2020-08-10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos_materia_alumnos`
--

CREATE TABLE `grupos_materia_alumnos` (
  `id` int(11) NOT NULL,
  `grupo_materia_profesor_id` int(11) NOT NULL,
  `usuario_alumno_id` int(11) NOT NULL,
  `creado` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `grupos_materia_alumnos`
--

INSERT INTO `grupos_materia_alumnos` (`id`, `grupo_materia_profesor_id`, `usuario_alumno_id`, `creado`) VALUES
(1, 1, 1, '2019-01-08'),
(2, 1, 2, '2019-01-08'),
(3, 1, 3, '2019-01-08'),
(4, 3, 5, '2019-01-08'),
(5, 3, 6, '2019-01-08'),
(6, 3, 7, '2019-01-08'),
(7, 3, 8, '2019-01-09'),
(8, 1, 9, '2020-08-10'),
(9, 6, 10, '2020-08-10'),
(10, 6, 8, '2020-08-10'),
(11, 1, 11, '2020-08-13'),
(12, 1, 12, '2020-08-13'),
(13, 1, 13, '2020-08-13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo_alumnos`
--

CREATE TABLE `grupo_alumnos` (
  `id` int(11) NOT NULL,
  `grupo_id` int(11) NOT NULL,
  `alumno_id` int(11) NOT NULL,
  `creado` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `grupo_alumnos`
--

INSERT INTO `grupo_alumnos` (`id`, `grupo_id`, `alumno_id`, `creado`) VALUES
(1, 1, 1, '2019-01-08'),
(2, 1, 2, '2019-01-08'),
(3, 1, 3, '2019-01-08'),
(4, 3, 5, '2019-01-08'),
(5, 3, 6, '2019-01-08'),
(6, 3, 7, '2019-01-08'),
(7, 3, 8, '2019-01-09'),
(8, 1, 9, '2020-08-10'),
(9, 6, 10, '2020-08-10'),
(10, 6, 8, '2020-08-10'),
(11, 1, 11, '2020-08-13'),
(12, 1, 12, '2020-08-13'),
(13, 1, 13, '2020-08-13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `niveles_escolares`
--

CREATE TABLE `niveles_escolares` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `creado` date NOT NULL,
  `actualizado` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `niveles_escolares`
--

INSERT INTO `niveles_escolares` (`id`, `nombre`, `creado`, `actualizado`) VALUES
(1, 'Primaria', '2016-09-19', '2016-09-19'),
(2, 'Secundaria', '2016-09-19', '2016-09-19'),
(3, 'Nivel Medio Superior', '2016-09-19', '2016-09-19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `niveles_grados`
--

CREATE TABLE `niveles_grados` (
  `id` int(11) NOT NULL,
  `nombre` varchar(5) NOT NULL,
  `nivel_escolar_id` int(11) NOT NULL,
  `creado` date NOT NULL,
  `actualizado` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `niveles_grados`
--

INSERT INTO `niveles_grados` (`id`, `nombre`, `nivel_escolar_id`, `creado`, `actualizado`) VALUES
(1, '1ro', 1, '2016-09-19', '2016-09-19'),
(2, '2do', 1, '2016-09-19', '2016-09-19'),
(3, '3ro', 1, '2016-09-19', '2016-09-19'),
(4, '4to', 1, '2016-09-19', '2016-09-19'),
(5, '5to', 1, '2016-09-19', '2016-09-19'),
(6, '6to', 1, '2016-09-19', '2016-09-19'),
(7, '1ro', 2, '2016-09-19', '2016-09-19'),
(8, '2do', 2, '2016-09-19', '2016-09-19'),
(9, '3ro', 2, '2016-09-19', '2016-09-19'),
(10, '1ro', 3, '2016-09-19', '2016-09-19'),
(11, '2do', 3, '2016-09-19', '2016-09-19'),
(12, '3ro', 3, '2016-09-19', '2016-09-19'),
(13, '4to', 3, '2016-09-19', '2016-09-19'),
(14, '5to', 3, '2016-09-19', '2016-09-19'),
(15, '6to', 3, '2016-09-19', '2016-09-19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `niveles_turnos`
--

CREATE TABLE `niveles_turnos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `creado` date NOT NULL,
  `actualizado` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `niveles_turnos`
--

INSERT INTO `niveles_turnos` (`id`, `nombre`, `creado`, `actualizado`) VALUES
(1, 'Matutino', '2016-09-19', '2016-09-19'),
(2, 'Vespertino', '2016-09-19', '2016-09-19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paquetes`
--

CREATE TABLE `paquetes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `cant_alum` int(11) NOT NULL,
  `costo` float(7,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `paquetes`
--

INSERT INTO `paquetes` (`id`, `nombre`, `cant_alum`, `costo`) VALUES
(1, 'Free', 10, 0.00),
(2, 'Basico', 100, 89.00),
(3, 'Medio', 250, 149.99),
(4, 'Avanzado', 500, 189.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_administradores`
--

CREATE TABLE `usuarios_administradores` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `user` varchar(20) NOT NULL,
  `pass` varchar(20) NOT NULL,
  `clave` varchar(20) NOT NULL,
  `informacion_id` int(11) NOT NULL,
  `creado` date NOT NULL,
  `actualizado` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios_administradores`
--

INSERT INTO `usuarios_administradores` (`id`, `nombre`, `user`, `pass`, `clave`, `informacion_id`, `creado`, `actualizado`) VALUES
(2, 'Luigi Perez Calzada', 'gianbros', 'Cf3g6d4Ag7', 'gianbros', 89, '2018-12-09', '2018-12-09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_alumnos`
--

CREATE TABLE `usuarios_alumnos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `user` varchar(20) NOT NULL,
  `pass` varchar(20) NOT NULL,
  `clave` varchar(20) NOT NULL,
  `informacion_id` int(11) NOT NULL,
  `profesor_id` int(11) NOT NULL,
  `creado` date NOT NULL,
  `actualizado` date NOT NULL,
  `activo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios_alumnos`
--

INSERT INTO `usuarios_alumnos` (`id`, `nombre`, `user`, `pass`, `clave`, `informacion_id`, `profesor_id`, `creado`, `actualizado`, `activo`) VALUES
(1, 'Benitez Zarate  Sara', 'sbenitezz', '5f3d1', 'sbenitezz', 93, 3, '2019-01-08', '2019-01-08', 1),
(2, 'Cano Pluma Areli', 'acanop', '88f26', 'acanop', 95, 3, '2019-01-08', '2019-01-08', 1),
(3, 'Mendez Sanchez Ruben', 'rmendezs', 'bf06b', 'rmendezs', 97, 3, '2019-01-08', '2019-01-08', 1),
(5, 'Medina Sanchez Ruben', 'rmedinas', '5f317', 'rmedinas', 101, 6, '2019-01-08', '2019-01-08', 1),
(6, 'Benitez Perez Sara', 'sbenitezp', 'b0a41', 'sbenitezp', 103, 6, '2019-01-08', '2019-01-08', 1),
(7, 'Castillo Pluma Areli', 'acastillop', '21fee', 'acastillop', 105, 6, '2019-01-08', '2019-01-08', 1),
(8, 'Moran Cruz Enrique', 'emoranc6', '91a11', 'emoranc6', 107, 6, '2019-01-09', '2019-01-09', 1),
(9, 'Medina Sanchez Sara', 'smedinas7', 'be064', 'smedinas7', 110, 3, '2020-08-10', '2020-08-10', 1),
(10, 'Conde Perez Karen', 'kcondep8', '365cf', 'kcondep8', 112, 5, '2020-08-10', '2020-08-10', 1),
(11, 'OROZCO Sanchez EDUARDO', 'eorozcos9', '066cd', 'eorozcos9', 114, 3, '2020-08-13', '2020-08-13', 1),
(12, 'AMEZCUA Sanchez NINA SOFIA', 'namezcuas10', 'c0a49', 'namezcuas10', 116, 3, '2020-08-13', '2020-08-13', 1),
(13, 'HERNANDEZ PEREZ JOSE ANGEL', 'jhernandezp11', '62342', 'jhernandezp11', 118, 3, '2020-08-13', '2020-08-13', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_escuelas`
--

CREATE TABLE `usuarios_escuelas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `user` varchar(20) NOT NULL,
  `pass` varchar(20) NOT NULL,
  `clave` varchar(20) NOT NULL,
  `informacion_id` int(11) NOT NULL,
  `nivel_escolar_id` int(11) NOT NULL,
  `creado` date NOT NULL,
  `actualizado` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_escuelas_secretarias`
--

CREATE TABLE `usuarios_escuelas_secretarias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `user` varchar(20) NOT NULL,
  `pass` varchar(20) NOT NULL,
  `clave` varchar(20) NOT NULL,
  `informacion_id` int(11) NOT NULL,
  `escuela_id` int(11) NOT NULL,
  `creado` date NOT NULL,
  `actualizado` date NOT NULL,
  `activo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_informacion`
--

CREATE TABLE `usuarios_informacion` (
  `id` int(11) NOT NULL,
  `calle` varchar(100) DEFAULT NULL,
  `numero` varchar(10) DEFAULT NULL,
  `colonia` varchar(100) DEFAULT NULL,
  `municipio` varchar(50) DEFAULT NULL,
  `cp` int(5) DEFAULT NULL,
  `estado` varchar(50) DEFAULT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  `celular` varchar(10) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `facebook` varchar(100) DEFAULT NULL,
  `twitter` varchar(50) DEFAULT NULL,
  `foto_perfil` varchar(100) DEFAULT NULL,
  `creado` date NOT NULL,
  `actualizado` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios_informacion`
--

INSERT INTO `usuarios_informacion` (`id`, `calle`, `numero`, `colonia`, `municipio`, `cp`, `estado`, `telefono`, `celular`, `correo`, `facebook`, `twitter`, `foto_perfil`, `creado`, `actualizado`) VALUES
(89, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'eva.jpg', '2018-12-28', '2018-12-28'),
(90, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 'algo@hot.com', NULL, NULL, 'eva.jpg', '2018-12-28', '2018-12-28'),
(91, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 'prof2@hot.com', NULL, NULL, 'eva.jpg', '2019-01-06', '2019-01-06'),
(92, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 'prof3@hot.com', NULL, NULL, 'eva.jpg', '2019-01-06', '2019-01-06'),
(93, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'eva.jpg', '2019-01-08', '2019-01-08'),
(94, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'eva.jpg', '2019-01-08', '2019-01-08'),
(95, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'eva.jpg', '2019-01-08', '2019-01-08'),
(96, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'eva.jpg', '2019-01-08', '2019-01-08'),
(97, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'eva.jpg', '2019-01-08', '2019-01-08'),
(98, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'eva.jpg', '2019-01-08', '2019-01-08'),
(99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 'tecnica1@hotmail.com', NULL, NULL, 'eva.jpg', '2019-01-08', '2019-01-08'),
(100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'eva.jpg', '2019-01-08', '2019-01-08'),
(101, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'eva.jpg', '2019-01-08', '2019-01-08'),
(102, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'eva.jpg', '2019-01-08', '2019-01-08'),
(103, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'eva.jpg', '2019-01-08', '2019-01-08'),
(104, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'eva.jpg', '2019-01-08', '2019-01-08'),
(105, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'eva.jpg', '2019-01-08', '2019-01-08'),
(106, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'eva.jpg', '2019-01-08', '2019-01-08'),
(107, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'eva.jpg', '2019-01-09', '2019-01-09'),
(108, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'eva.jpg', '2019-01-09', '2019-01-09'),
(109, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', 'r@d.com', NULL, NULL, 'eva.jpg', '2020-07-23', '2020-07-23'),
(110, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'eva.jpg', '2020-08-10', '2020-08-10'),
(111, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'eva.jpg', '2020-08-10', '2020-08-10'),
(112, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'eva.jpg', '2020-08-10', '2020-08-10'),
(113, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'eva.jpg', '2020-08-10', '2020-08-10'),
(114, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'eva.jpg', '2020-08-13', '2020-08-13'),
(115, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'eva.jpg', '2020-08-13', '2020-08-13'),
(116, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'eva.jpg', '2020-08-13', '2020-08-13'),
(117, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'eva.jpg', '2020-08-13', '2020-08-13'),
(118, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'eva.jpg', '2020-08-13', '2020-08-13'),
(119, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'eva.jpg', '2020-08-13', '2020-08-13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_profesores`
--

CREATE TABLE `usuarios_profesores` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `user` varchar(20) NOT NULL,
  `pass` varchar(20) NOT NULL,
  `clave` varchar(20) NOT NULL,
  `informacion_id` int(11) NOT NULL,
  `escuela_id` int(11) DEFAULT NULL,
  `creado` date NOT NULL,
  `actualizado` date NOT NULL,
  `activo` int(11) NOT NULL,
  `paquete_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios_profesores`
--

INSERT INTO `usuarios_profesores` (`id`, `nombre`, `user`, `pass`, `clave`, `informacion_id`, `escuela_id`, `creado`, `actualizado`, `activo`, `paquete_id`) VALUES
(3, 'Paula HernÃ¡ndez GonzÃ¡lez', 'prof1', 'prof1', 'prof11', 90, NULL, '2018-12-28', '2018-12-28', 1, 1),
(4, 'profe dos two', 'prof2', 'prof2', '2', 91, NULL, '2019-01-06', '2019-01-06', 1, 1),
(5, 'Prof Tres Three', 'prof3@hot.com', 'prof3', 'prof3@hot.com3', 92, NULL, '2019-01-06', '2019-01-06', 1, 3),
(6, 'Enrique', 'tecnica1@hotmail.com', 'tecnica1', 'tecnica1@hotmail.com', 99, NULL, '2019-01-08', '2019-01-08', 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_tutores`
--

CREATE TABLE `usuarios_tutores` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `user` varchar(20) NOT NULL,
  `pass` varchar(20) NOT NULL,
  `clave` varchar(20) NOT NULL,
  `alumno_id` int(11) NOT NULL,
  `informacion_id` int(11) NOT NULL,
  `creado` date NOT NULL,
  `actualizado` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios_tutores`
--

INSERT INTO `usuarios_tutores` (`id`, `nombre`, `user`, `pass`, `clave`, `alumno_id`, `informacion_id`, `creado`, `actualizado`) VALUES
(1, 'Benitez Zarate  Sara', 'sbenitezzt', 'f0b47', 'sbenitezzt', 1, 94, '2019-01-08', '2019-01-08'),
(2, 'Cano Pluma Areli', 'acanopt', '12b52', 'acanopt', 2, 96, '2019-01-08', '2019-01-08'),
(3, 'Mendez Sanchez Ruben', 'rmendezst', '4b655', 'rmendezst', 3, 98, '2019-01-08', '2019-01-08'),
(4, 'Medina Sanchez Ruben', 'rmedinast', 'a21c1', 'rmedinast', 5, 102, '2019-01-08', '2019-01-08'),
(5, 'Benitez Perez Sara', 'sbenitezpt', 'c2145', 'sbenitezpt', 6, 104, '2019-01-08', '2019-01-08'),
(6, 'Castillo Pluma Areli', 'acastillopt', '08abe', 'acastillopt', 7, 106, '2019-01-08', '2019-01-08'),
(7, 'Moran Cruz Enrique', 'emoranc6t', '71263', 'emoranc6t', 8, 108, '2019-01-09', '2019-01-09'),
(8, 'Medina Sanchez Sara', 'smedinas7t', 'e5765', 'smedinas7t', 9, 111, '2020-08-10', '2020-08-10'),
(9, 'Conde Perez Karen', 'kcondep8t', '391df', 'kcondep8t', 10, 113, '2020-08-10', '2020-08-10'),
(10, 'OROZCO Sanchez EDUARDO', 'eorozcos9t', 'cbb20', 'eorozcos9t', 11, 115, '2020-08-13', '2020-08-13'),
(11, 'AMEZCUA Sanchez NINA SOFIA', 'namezcuas10t', '1301e', 'namezcuas10t', 12, 117, '2020-08-13', '2020-08-13'),
(12, 'HERNANDEZ PEREZ JOSE ANGEL', 'jhernandezp11t', '9de61', 'jhernandezp11t', 13, 119, '2020-08-13', '2020-08-13');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `aviso_asig_alum`
--
ALTER TABLE `aviso_asig_alum`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `aviso_asig_tutor`
--
ALTER TABLE `aviso_asig_tutor`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `aviso_info`
--
ALTER TABLE `aviso_info`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `aviso_tipo`
--
ALTER TABLE `aviso_tipo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `banco_bloques`
--
ALTER TABLE `banco_bloques`
  ADD PRIMARY KEY (`id`),
  ADD KEY `banco_materia_id` (`banco_materia_id`);

--
-- Indices de la tabla `banco_materias`
--
ALTER TABLE `banco_materias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nivel_escolar_id` (`nivel_escolar_id`);

--
-- Indices de la tabla `banco_preguntas`
--
ALTER TABLE `banco_preguntas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `banco_materia_id` (`banco_materia_id`),
  ADD KEY `banco_bloque_id` (`banco_bloque_id`),
  ADD KEY `banco_tema_id` (`banco_tema_id`),
  ADD KEY `banco_subtema_id` (`banco_subtema_id`);

--
-- Indices de la tabla `banco_respuestas`
--
ALTER TABLE `banco_respuestas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `banco_pregunta_id` (`banco_pregunta_id`);

--
-- Indices de la tabla `banco_subtemas`
--
ALTER TABLE `banco_subtemas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `banco_tema_id` (`banco_tema_id`);

--
-- Indices de la tabla `banco_temas`
--
ALTER TABLE `banco_temas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `banco_bloque_id` (`banco_bloque_id`);

--
-- Indices de la tabla `est_exa_respuestas_tmp`
--
ALTER TABLE `est_exa_respuestas_tmp`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `est_exa_result_info`
--
ALTER TABLE `est_exa_result_info`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `est_exa_result_preguntas`
--
ALTER TABLE `est_exa_result_preguntas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `est_exa_tiempos`
--
ALTER TABLE `est_exa_tiempos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `exa_info`
--
ALTER TABLE `exa_info`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `exa_info_asig`
--
ALTER TABLE `exa_info_asig`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `exa_info_asig_alum`
--
ALTER TABLE `exa_info_asig_alum`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `exa_preguntas`
--
ALTER TABLE `exa_preguntas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `grupos_info`
--
ALTER TABLE `grupos_info`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `grupos_materias_profesores`
--
ALTER TABLE `grupos_materias_profesores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `grupos_materia_alumnos`
--
ALTER TABLE `grupos_materia_alumnos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `grupo_alumnos`
--
ALTER TABLE `grupo_alumnos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `niveles_escolares`
--
ALTER TABLE `niveles_escolares`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `niveles_grados`
--
ALTER TABLE `niveles_grados`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nivel_escolar_id` (`nivel_escolar_id`);

--
-- Indices de la tabla `niveles_turnos`
--
ALTER TABLE `niveles_turnos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `paquetes`
--
ALTER TABLE `paquetes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios_administradores`
--
ALTER TABLE `usuarios_administradores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `informacion_id` (`informacion_id`);

--
-- Indices de la tabla `usuarios_alumnos`
--
ALTER TABLE `usuarios_alumnos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user` (`user`),
  ADD KEY `informacion_id` (`informacion_id`);

--
-- Indices de la tabla `usuarios_escuelas`
--
ALTER TABLE `usuarios_escuelas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user` (`user`),
  ADD KEY `informacion_id` (`informacion_id`);

--
-- Indices de la tabla `usuarios_escuelas_secretarias`
--
ALTER TABLE `usuarios_escuelas_secretarias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios_informacion`
--
ALTER TABLE `usuarios_informacion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios_profesores`
--
ALTER TABLE `usuarios_profesores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user` (`user`),
  ADD KEY `informacion_id` (`informacion_id`),
  ADD KEY `escuela_id` (`escuela_id`),
  ADD KEY `paquete_id` (`paquete_id`);

--
-- Indices de la tabla `usuarios_tutores`
--
ALTER TABLE `usuarios_tutores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user` (`user`),
  ADD KEY `alumno_id` (`alumno_id`),
  ADD KEY `informacion_id` (`informacion_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `aviso_asig_alum`
--
ALTER TABLE `aviso_asig_alum`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `aviso_asig_tutor`
--
ALTER TABLE `aviso_asig_tutor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `aviso_info`
--
ALTER TABLE `aviso_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `aviso_tipo`
--
ALTER TABLE `aviso_tipo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `banco_bloques`
--
ALTER TABLE `banco_bloques`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `banco_materias`
--
ALTER TABLE `banco_materias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT de la tabla `banco_preguntas`
--
ALTER TABLE `banco_preguntas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `banco_respuestas`
--
ALTER TABLE `banco_respuestas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `banco_subtemas`
--
ALTER TABLE `banco_subtemas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `banco_temas`
--
ALTER TABLE `banco_temas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `est_exa_respuestas_tmp`
--
ALTER TABLE `est_exa_respuestas_tmp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `est_exa_result_info`
--
ALTER TABLE `est_exa_result_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `est_exa_result_preguntas`
--
ALTER TABLE `est_exa_result_preguntas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `est_exa_tiempos`
--
ALTER TABLE `est_exa_tiempos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `exa_info`
--
ALTER TABLE `exa_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `exa_info_asig`
--
ALTER TABLE `exa_info_asig`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `exa_info_asig_alum`
--
ALTER TABLE `exa_info_asig_alum`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `exa_preguntas`
--
ALTER TABLE `exa_preguntas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `grupos_info`
--
ALTER TABLE `grupos_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `grupos_materias_profesores`
--
ALTER TABLE `grupos_materias_profesores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `grupos_materia_alumnos`
--
ALTER TABLE `grupos_materia_alumnos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `grupo_alumnos`
--
ALTER TABLE `grupo_alumnos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `niveles_escolares`
--
ALTER TABLE `niveles_escolares`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `niveles_grados`
--
ALTER TABLE `niveles_grados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `niveles_turnos`
--
ALTER TABLE `niveles_turnos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `paquetes`
--
ALTER TABLE `paquetes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios_administradores`
--
ALTER TABLE `usuarios_administradores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios_alumnos`
--
ALTER TABLE `usuarios_alumnos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `usuarios_escuelas`
--
ALTER TABLE `usuarios_escuelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios_escuelas_secretarias`
--
ALTER TABLE `usuarios_escuelas_secretarias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios_informacion`
--
ALTER TABLE `usuarios_informacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT de la tabla `usuarios_profesores`
--
ALTER TABLE `usuarios_profesores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `usuarios_tutores`
--
ALTER TABLE `usuarios_tutores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `banco_bloques`
--
ALTER TABLE `banco_bloques`
  ADD CONSTRAINT `banco_bloques_ibfk_1` FOREIGN KEY (`banco_materia_id`) REFERENCES `banco_materias` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `banco_materias`
--
ALTER TABLE `banco_materias`
  ADD CONSTRAINT `banco_materias_ibfk_1` FOREIGN KEY (`nivel_escolar_id`) REFERENCES `niveles_escolares` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `banco_preguntas`
--
ALTER TABLE `banco_preguntas`
  ADD CONSTRAINT `banco_preguntas_ibfk_1` FOREIGN KEY (`banco_materia_id`) REFERENCES `banco_materias` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `banco_preguntas_ibfk_2` FOREIGN KEY (`banco_bloque_id`) REFERENCES `banco_bloques` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `banco_preguntas_ibfk_3` FOREIGN KEY (`banco_tema_id`) REFERENCES `banco_temas` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `banco_preguntas_ibfk_4` FOREIGN KEY (`banco_subtema_id`) REFERENCES `banco_subtemas` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `banco_respuestas`
--
ALTER TABLE `banco_respuestas`
  ADD CONSTRAINT `banco_respuestas_ibfk_1` FOREIGN KEY (`banco_pregunta_id`) REFERENCES `banco_preguntas` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `banco_subtemas`
--
ALTER TABLE `banco_subtemas`
  ADD CONSTRAINT `banco_subtemas_ibfk_1` FOREIGN KEY (`banco_tema_id`) REFERENCES `banco_temas` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `banco_temas`
--
ALTER TABLE `banco_temas`
  ADD CONSTRAINT `banco_temas_ibfk_1` FOREIGN KEY (`banco_bloque_id`) REFERENCES `banco_bloques` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `niveles_grados`
--
ALTER TABLE `niveles_grados`
  ADD CONSTRAINT `niveles_grados_ibfk_1` FOREIGN KEY (`nivel_escolar_id`) REFERENCES `niveles_escolares` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios_administradores`
--
ALTER TABLE `usuarios_administradores`
  ADD CONSTRAINT `usuarios_administradores_ibfk_1` FOREIGN KEY (`informacion_id`) REFERENCES `usuarios_informacion` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios_alumnos`
--
ALTER TABLE `usuarios_alumnos`
  ADD CONSTRAINT `usuarios_alumnos_ibfk_1` FOREIGN KEY (`informacion_id`) REFERENCES `usuarios_informacion` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios_escuelas`
--
ALTER TABLE `usuarios_escuelas`
  ADD CONSTRAINT `usuarios_escuelas_ibfk_1` FOREIGN KEY (`informacion_id`) REFERENCES `usuarios_informacion` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios_profesores`
--
ALTER TABLE `usuarios_profesores`
  ADD CONSTRAINT `usuarios_profesores_ibfk_1` FOREIGN KEY (`informacion_id`) REFERENCES `usuarios_informacion` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `usuarios_profesores_ibfk_2` FOREIGN KEY (`escuela_id`) REFERENCES `usuarios_escuelas` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `usuarios_profesores_ibfk_3` FOREIGN KEY (`paquete_id`) REFERENCES `paquetes` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios_tutores`
--
ALTER TABLE `usuarios_tutores`
  ADD CONSTRAINT `usuarios_tutores_ibfk_1` FOREIGN KEY (`alumno_id`) REFERENCES `usuarios_alumnos` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `usuarios_tutores_ibfk_2` FOREIGN KEY (`informacion_id`) REFERENCES `usuarios_informacion` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
