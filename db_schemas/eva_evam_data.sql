-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-12-2018 a las 23:06:47
-- Versión del servidor: 5.6.24
-- Versión de PHP: 5.5.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `eva_evam`
--

--
-- Volcado de datos para la tabla `aviso_tipo`
--

INSERT INTO `aviso_tipo` (`id`, `nombre`) VALUES
(1, 'Evento escolar'),
(2, 'Agenda Escolar'),
(3, 'Emergencia'),
(4, 'Boletin');

--
-- Volcado de datos para la tabla `banco_materias`
--

INSERT INTO `banco_materias` (`id`, `nombre`, `nivel_escolar_id`, `nivel_grado_id`, `creado_por`, `creado`, `actualizado`) VALUES
(8, 'EspaÃ±ol', 1, 1, NULL, '2018-12-09', '2018-12-09'),
(9, 'InglÃ©s', 1, 1, NULL, '2018-12-09', '2018-12-09'),
(10, 'MatemÃ¡ticas', 1, 1, NULL, '2018-12-09', '2018-12-09'),
(11, 'ExploraciÃ³n de la Naturaleza y Sociedad', 1, 1, NULL, '2018-12-09', '2018-12-09'),
(12, 'FormaciÃ³n CÃ­vica y Ã‰tica', 1, 1, NULL, '2018-12-09', '2018-12-09'),
(13, 'EducaciÃ³n FÃ­sica', 1, 1, NULL, '2018-12-09', '2018-12-09'),
(14, 'EducaciÃ³n ArtÃ­stica', 1, 1, NULL, '2018-12-09', '2018-12-09'),
(15, 'EspaÃ±ol', 1, 2, NULL, '2018-12-09', '2018-12-09'),
(16, 'InglÃ©s', 1, 2, NULL, '2018-12-09', '2018-12-09'),
(17, 'MatemÃ¡ticas', 1, 2, NULL, '2018-12-09', '2018-12-09'),
(18, 'ExploraciÃ³n de la Naturaleza y Sociedad', 1, 2, NULL, '2018-12-09', '2018-12-09'),
(19, 'FormaciÃ³n CÃ­vica y Ã‰tica', 1, 2, NULL, '2018-12-09', '2018-12-09'),
(20, 'EducaciÃ³n FÃ­sica', 1, 2, NULL, '2018-12-09', '2018-12-09'),
(21, 'EducaciÃ³n ArtÃ­stica', 1, 2, NULL, '2018-12-09', '2018-12-09'),
(22, 'EspaÃ±ol', 1, 3, NULL, '2018-12-09', '2018-12-09'),
(23, 'InglÃ©s', 1, 3, NULL, '2018-12-09', '2018-12-09'),
(24, 'MatemÃ¡ticas', 1, 3, NULL, '2018-12-09', '2018-12-09'),
(25, 'Ciencias Naturales', 1, 3, NULL, '2018-12-09', '2018-12-09'),
(26, 'La entidad donde vivo', 1, 3, NULL, '2018-12-09', '2018-12-09'),
(27, 'FormaciÃ³n CÃ­vica y Ã‰tica', 1, 3, NULL, '2018-12-09', '2018-12-09'),
(28, 'EducaciÃ³n FÃ­sica', 1, 3, NULL, '2018-12-09', '2018-12-09'),
(29, 'EducaciÃ³n ArtÃ­stica', 1, 3, NULL, '2018-12-09', '2018-12-09'),
(30, 'EspaÃ±ol', 1, 4, NULL, '2018-12-09', '2018-12-09'),
(31, 'InglÃ©s', 1, 4, NULL, '2018-12-09', '2018-12-09'),
(32, 'MatemÃ¡ticas', 1, 4, NULL, '2018-12-09', '2018-12-09'),
(33, 'Ciencias Naturales', 1, 4, NULL, '2018-12-09', '2018-12-09'),
(34, 'GeografÃ­a', 1, 4, NULL, '2018-12-09', '2018-12-09'),
(35, 'Historia', 1, 4, NULL, '2018-12-09', '2018-12-09'),
(36, 'FormaciÃ³n CÃ­vica y Ã‰tica', 1, 4, NULL, '2018-12-09', '2018-12-09'),
(37, 'EducaciÃ³n FÃ­sica', 1, 4, NULL, '2018-12-09', '2018-12-09'),
(38, 'EducaciÃ³n ArtÃ­stica', 1, 4, NULL, '2018-12-09', '2018-12-09'),
(39, 'EspaÃ±ol', 1, 5, NULL, '2018-12-09', '2018-12-09'),
(40, 'InglÃ©s', 1, 5, NULL, '2018-12-09', '2018-12-09'),
(41, 'MatemÃ¡ticas', 1, 5, NULL, '2018-12-09', '2018-12-09'),
(42, 'Ciencias Naturales', 1, 5, NULL, '2018-12-09', '2018-12-09'),
(43, 'GeografÃ­a', 1, 5, NULL, '2018-12-09', '2018-12-09'),
(44, 'Historia', 1, 5, NULL, '2018-12-09', '2018-12-09'),
(45, 'FormaciÃ³n CÃ­vica y Ã‰tica', 1, 5, NULL, '2018-12-09', '2018-12-09'),
(46, 'EducaciÃ³n FÃ­sica', 1, 5, NULL, '2018-12-09', '2018-12-09'),
(47, 'EducaciÃ³n ArtÃ­stica', 1, 5, NULL, '2018-12-09', '2018-12-09'),
(48, 'EspaÃ±ol', 1, 6, NULL, '2018-12-09', '2018-12-09'),
(49, 'InglÃ©s', 1, 6, NULL, '2018-12-09', '2018-12-09'),
(50, 'MatemÃ¡ticas', 1, 6, NULL, '2018-12-09', '2018-12-09'),
(51, 'Ciencias Naturales', 1, 6, NULL, '2018-12-09', '2018-12-09'),
(52, 'GeografÃ­a', 1, 6, NULL, '2018-12-09', '2018-12-09'),
(53, 'Historia', 1, 6, NULL, '2018-12-09', '2018-12-09'),
(54, 'FormaciÃ³n CÃ­vica y Ã‰tica', 1, 6, NULL, '2018-12-09', '2018-12-09'),
(55, 'EducaciÃ³n FÃ­sica', 1, 6, NULL, '2018-12-09', '2018-12-09'),
(56, 'EducaciÃ³n ArtÃ­stica', 1, 6, NULL, '2018-12-09', '2018-12-09'),
(57, 'EspaÃ±ol I', 2, 7, NULL, '2018-12-09', '2018-12-09'),
(58, 'InglÃ©s I', 2, 7, NULL, '2018-12-09', '2018-12-09'),
(59, 'MatemÃ¡ticas I', 2, 7, NULL, '2018-12-09', '2018-12-09'),
(60, 'Ciencias I (BiologÃ­a)', 2, 7, NULL, '2018-12-09', '2018-12-09'),
(61, 'GeografÃ­a de MÃ©xico y del Mundo', 2, 7, NULL, '2018-12-09', '2018-12-09'),
(62, 'EducaciÃ³n FÃ­sica I', 2, 7, NULL, '2018-12-09', '2018-12-09'),
(63, 'TecnologÃ­a I', 2, 7, NULL, '2018-12-09', '2018-12-09'),
(64, 'Artes I', 2, 7, NULL, '2018-12-09', '2018-12-09'),
(65, 'Asignatura Estatal', 2, 7, NULL, '2018-12-09', '2018-12-09'),
(66, 'TutorÃ­a', 2, 7, NULL, '2018-12-09', '2018-12-09'),
(67, 'EspaÃ±ol II', 2, 8, NULL, '2018-12-09', '2018-12-09'),
(68, 'InglÃ©s II', 2, 8, NULL, '2018-12-09', '2018-12-09'),
(69, 'MatemÃ¡ticas II', 2, 8, NULL, '2018-12-09', '2018-12-09'),
(70, 'Ciencias II (FÃ­sica)', 2, 8, NULL, '2018-12-09', '2018-12-09'),
(71, 'Historia I', 2, 8, NULL, '2018-12-09', '2018-12-09'),
(72, 'FormaciÃ³n CÃ­vica y Ã‰tica I', 2, 8, NULL, '2018-12-09', '2018-12-09'),
(73, 'EducaciÃ³n FÃ­sica II', 2, 8, NULL, '2018-12-09', '2018-12-09'),
(74, 'TecnologÃ­a II', 2, 8, NULL, '2018-12-09', '2018-12-09'),
(75, 'Artes II', 2, 8, NULL, '2018-12-09', '2018-12-09'),
(76, 'TutorÃ­a', 2, 8, NULL, '2018-12-09', '2018-12-09'),
(77, 'EspaÃ±ol III', 2, 9, NULL, '2018-12-09', '2018-12-09'),
(78, 'InglÃ©s III', 2, 9, NULL, '2018-12-09', '2018-12-09'),
(79, 'MatemÃ¡ticas III', 2, 9, NULL, '2018-12-09', '2018-12-09'),
(80, 'Ciencias III (QuÃ­mica)', 2, 9, NULL, '2018-12-09', '2018-12-09'),
(81, 'Historia II', 2, 9, NULL, '2018-12-09', '2018-12-09'),
(82, 'FormaciÃ³n CÃ­vica y Ã‰tica II', 2, 9, NULL, '2018-12-09', '2018-12-09'),
(83, 'EducaciÃ³n FÃ­sica III', 2, 9, NULL, '2018-12-09', '2018-12-09'),
(84, 'TecnologÃ­a III', 2, 9, NULL, '2018-12-09', '2018-12-09'),
(85, 'Artes III', 2, 9, NULL, '2018-12-09', '2018-12-09'),
(86, 'TutorÃ­a', 2, 9, NULL, '2018-12-09', '2018-12-09');

--
-- Volcado de datos para la tabla `niveles_escolares`
--

INSERT INTO `niveles_escolares` (`id`, `nombre`, `creado`, `actualizado`) VALUES
(1, 'Primaria', '2016-09-19', '2016-09-19'),
(2, 'Secundaria', '2016-09-19', '2016-09-19'),
(3, 'Nivel Medio Superior', '2016-09-19', '2016-09-19');

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

--
-- Volcado de datos para la tabla `niveles_turnos`
--

INSERT INTO `niveles_turnos` (`id`, `nombre`, `creado`, `actualizado`) VALUES
(1, 'Matutino', '2016-09-19', '2016-09-19'),
(2, 'Vespertino', '2016-09-19', '2016-09-19');

--
-- Volcado de datos para la tabla `paquetes`
--

INSERT INTO `paquetes` (`id`, `nombre`, `cant_alum`, `costo`) VALUES
(1, 'Free', 7, 0.00),
(2, 'Basico', 100, 89.00),
(3, 'Medio', 250, 149.99),
(4, 'Avanzado', 500, 189.00);

--
-- Volcado de datos para la tabla `usuarios_administradores`
--

INSERT INTO `usuarios_administradores` (`id`, `nombre`, `user`, `pass`, `clave`, `informacion_id`, `creado`, `actualizado`) VALUES
(2, 'Luigi Perez Calzada', 'gianbros', 'Cf3g6d4Ag7', 'gianbros', 70, '2018-12-09', '2018-12-09');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
