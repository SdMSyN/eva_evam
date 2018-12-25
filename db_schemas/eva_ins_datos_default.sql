-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-12-2018 a las 18:54:44
-- Versión del servidor: 5.6.24
-- Versión de PHP: 5.5.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `eva_ins`
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
-- Volcado de datos para la tabla `usuarios_administradores`
--

INSERT INTO `usuarios_administradores` (`id`, `nombre`, `user`, `pass`, `clave`, `informacion_id`, `creado`, `actualizado`) VALUES
(1, 'Luigi Perez Calzada', 'admin', 'admin', 'admin', 1, '2016-09-20', '2016-09-20');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
