-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-12-2018 a las 18:39:19
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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aviso_asig_alum`
--

CREATE TABLE IF NOT EXISTS `aviso_asig_alum` (
  `id` int(11) NOT NULL,
  `aviso_info_id` int(11) NOT NULL,
  `alumno_id` int(11) NOT NULL,
  `enterado` int(11) DEFAULT NULL,
  `fecha_enterado` datetime DEFAULT NULL,
  `creado` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aviso_asig_tutor`
--

CREATE TABLE IF NOT EXISTS `aviso_asig_tutor` (
  `id` int(11) NOT NULL,
  `aviso_info_id` int(11) NOT NULL,
  `tutor_id` int(11) NOT NULL,
  `enterado` int(11) DEFAULT NULL,
  `fecha_enterado` datetime DEFAULT NULL,
  `creado` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aviso_info`
--

CREATE TABLE IF NOT EXISTS `aviso_info` (
  `id` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `tipo_aviso_id` int(11) NOT NULL,
  `dirigido_a` int(11) DEFAULT NULL,
  `creado_por` int(11) NOT NULL,
  `perfil_creador` int(11) NOT NULL,
  `escuela_id` int(11) NOT NULL,
  `creado` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aviso_tipo`
--

CREATE TABLE IF NOT EXISTS `aviso_tipo` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `banco_bloques`
--

CREATE TABLE IF NOT EXISTS `banco_bloques` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `banco_materia_id` int(11) NOT NULL,
  `creado` date NOT NULL,
  `actualizado` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `banco_materias`
--

CREATE TABLE IF NOT EXISTS `banco_materias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `nivel_escolar_id` int(11) NOT NULL,
  `nivel_grado_id` int(11) NOT NULL,
  `creado_por` int(11) DEFAULT NULL,
  `creado` date NOT NULL,
  `actualizado` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `banco_preguntas`
--

CREATE TABLE IF NOT EXISTS `banco_preguntas` (
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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `banco_respuestas`
--

CREATE TABLE IF NOT EXISTS `banco_respuestas` (
  `id` int(11) NOT NULL,
  `nombre` text,
  `archivo` varchar(100) DEFAULT NULL,
  `correcta` int(11) NOT NULL,
  `tipo_resp` int(11) NOT NULL,
  `palabras` text,
  `banco_pregunta_id` int(11) NOT NULL,
  `creado` date NOT NULL,
  `actualizado` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `banco_subtemas`
--

CREATE TABLE IF NOT EXISTS `banco_subtemas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `banco_tema_id` int(11) NOT NULL,
  `creado` date NOT NULL,
  `actualizado` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `banco_temas`
--

CREATE TABLE IF NOT EXISTS `banco_temas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `banco_bloque_id` int(11) NOT NULL,
  `creado` date NOT NULL,
  `actualizado` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `est_exa_respuestas_tmp`
--

CREATE TABLE IF NOT EXISTS `est_exa_respuestas_tmp` (
  `id` int(11) NOT NULL,
  `alumno_id` int(11) NOT NULL,
  `exa_info_id` int(11) NOT NULL,
  `exa_info_asig_alum_id` int(11) NOT NULL,
  `pregunta_id` int(11) NOT NULL,
  `tipo_resp_id` int(11) NOT NULL,
  `respuesta_id` int(11) NOT NULL,
  `respuesta` varchar(250) DEFAULT NULL,
  `creado` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `est_exa_result_info`
--

CREATE TABLE IF NOT EXISTS `est_exa_result_info` (
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `est_exa_result_preguntas`
--

CREATE TABLE IF NOT EXISTS `est_exa_result_preguntas` (
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
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `est_exa_tiempos`
--

CREATE TABLE IF NOT EXISTS `est_exa_tiempos` (
  `id` int(11) NOT NULL,
  `exa_info_id` int(11) NOT NULL,
  `exa_info_asig_alum_id` int(11) NOT NULL,
  `alumno_id` int(11) NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fin` time DEFAULT NULL,
  `tiempo` time DEFAULT NULL,
  `creado` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `exa_info`
--

CREATE TABLE IF NOT EXISTS `exa_info` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `banco_materia_id` int(11) NOT NULL,
  `creado` date NOT NULL,
  `creado_por` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `exa_info_asig`
--

CREATE TABLE IF NOT EXISTS `exa_info_asig` (
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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `exa_info_asig_alum`
--

CREATE TABLE IF NOT EXISTS `exa_info_asig_alum` (
  `id` int(11) NOT NULL,
  `grupo_id` int(11) NOT NULL,
  `alumno_id` int(11) NOT NULL,
  `exa_info_asig_id` int(11) NOT NULL,
  `creado` date NOT NULL,
  `actualizado` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `exa_preguntas`
--

CREATE TABLE IF NOT EXISTS `exa_preguntas` (
  `id` int(11) NOT NULL,
  `banco_pregunta_id` int(11) NOT NULL,
  `exa_info_id` int(11) NOT NULL,
  `creado` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos_info`
--

CREATE TABLE IF NOT EXISTS `grupos_info` (
  `id` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `nivel_escolar_id` int(11) NOT NULL,
  `nivel_turno_id` int(11) NOT NULL,
  `nivel_grado_id` int(11) NOT NULL,
  `usuario_escuela_id` int(11) NOT NULL,
  `creado` date NOT NULL,
  `actualizado` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos_materias_profesores`
--

CREATE TABLE IF NOT EXISTS `grupos_materias_profesores` (
  `id` int(11) NOT NULL,
  `banco_materia_id` int(11) NOT NULL,
  `usuario_profesor_id` int(11) NOT NULL,
  `grupo_info_id` int(11) NOT NULL,
  `creado` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos_materia_alumnos`
--

CREATE TABLE IF NOT EXISTS `grupos_materia_alumnos` (
  `id` int(11) NOT NULL,
  `grupo_materia_profesor_id` int(11) NOT NULL,
  `usuario_alumno_id` int(11) NOT NULL,
  `creado` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo_alumnos`
--

CREATE TABLE IF NOT EXISTS `grupo_alumnos` (
  `id` int(11) NOT NULL,
  `grupo_id` int(11) NOT NULL,
  `alumno_id` int(11) NOT NULL,
  `creado` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `niveles_escolares`
--

CREATE TABLE IF NOT EXISTS `niveles_escolares` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `creado` date NOT NULL,
  `actualizado` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `niveles_grados`
--

CREATE TABLE IF NOT EXISTS `niveles_grados` (
  `id` int(11) NOT NULL,
  `nombre` varchar(5) NOT NULL,
  `nivel_escolar_id` int(11) NOT NULL,
  `creado` date NOT NULL,
  `actualizado` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `niveles_turnos`
--

CREATE TABLE IF NOT EXISTS `niveles_turnos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `creado` date NOT NULL,
  `actualizado` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_administradores`
--

CREATE TABLE IF NOT EXISTS `usuarios_administradores` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `user` varchar(20) NOT NULL,
  `pass` varchar(20) NOT NULL,
  `clave` varchar(20) NOT NULL,
  `informacion_id` int(11) NOT NULL,
  `creado` date NOT NULL,
  `actualizado` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_alumnos`
--

CREATE TABLE IF NOT EXISTS `usuarios_alumnos` (
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
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_escuelas`
--

CREATE TABLE IF NOT EXISTS `usuarios_escuelas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `user` varchar(20) NOT NULL,
  `pass` varchar(20) NOT NULL,
  `clave` varchar(20) NOT NULL,
  `informacion_id` int(11) NOT NULL,
  `nivel_escolar_id` int(11) NOT NULL,
  `creado` date NOT NULL,
  `actualizado` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_escuelas_secretarias`
--

CREATE TABLE IF NOT EXISTS `usuarios_escuelas_secretarias` (
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_informacion`
--

CREATE TABLE IF NOT EXISTS `usuarios_informacion` (
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
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_profesores`
--

CREATE TABLE IF NOT EXISTS `usuarios_profesores` (
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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_tutores`
--

CREATE TABLE IF NOT EXISTS `usuarios_tutores` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `user` varchar(20) NOT NULL,
  `pass` varchar(20) NOT NULL,
  `clave` varchar(20) NOT NULL,
  `alumno_id` int(11) NOT NULL,
  `informacion_id` int(11) NOT NULL,
  `creado` date NOT NULL,
  `actualizado` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

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
  ADD PRIMARY KEY (`id`), ADD KEY `banco_materia_id` (`banco_materia_id`);

--
-- Indices de la tabla `banco_materias`
--
ALTER TABLE `banco_materias`
  ADD PRIMARY KEY (`id`), ADD KEY `nivel_escolar_id` (`nivel_escolar_id`), ADD KEY `nivel_grado_id` (`nivel_grado_id`);

--
-- Indices de la tabla `banco_preguntas`
--
ALTER TABLE `banco_preguntas`
  ADD PRIMARY KEY (`id`), ADD KEY `banco_materia_id` (`banco_materia_id`), ADD KEY `banco_bloque_id` (`banco_bloque_id`), ADD KEY `banco_tema_id` (`banco_tema_id`), ADD KEY `banco_subtema_id` (`banco_subtema_id`);

--
-- Indices de la tabla `banco_respuestas`
--
ALTER TABLE `banco_respuestas`
  ADD PRIMARY KEY (`id`), ADD KEY `banco_pregunta_id` (`banco_pregunta_id`);

--
-- Indices de la tabla `banco_subtemas`
--
ALTER TABLE `banco_subtemas`
  ADD PRIMARY KEY (`id`), ADD KEY `banco_tema_id` (`banco_tema_id`);

--
-- Indices de la tabla `banco_temas`
--
ALTER TABLE `banco_temas`
  ADD PRIMARY KEY (`id`), ADD KEY `banco_bloque_id` (`banco_bloque_id`);

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
  ADD PRIMARY KEY (`id`), ADD KEY `nivel_escolar_id` (`nivel_escolar_id`);

--
-- Indices de la tabla `niveles_turnos`
--
ALTER TABLE `niveles_turnos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios_administradores`
--
ALTER TABLE `usuarios_administradores`
  ADD PRIMARY KEY (`id`), ADD KEY `informacion_id` (`informacion_id`);

--
-- Indices de la tabla `usuarios_alumnos`
--
ALTER TABLE `usuarios_alumnos`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `user` (`user`), ADD KEY `informacion_id` (`informacion_id`), ADD KEY `escuela_id` (`escuela_id`);

--
-- Indices de la tabla `usuarios_escuelas`
--
ALTER TABLE `usuarios_escuelas`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `user` (`user`), ADD KEY `informacion_id` (`informacion_id`);

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
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `user` (`user`), ADD KEY `informacion_id` (`informacion_id`), ADD KEY `escuela_id` (`escuela_id`);

--
-- Indices de la tabla `usuarios_tutores`
--
ALTER TABLE `usuarios_tutores`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `user` (`user`), ADD KEY `alumno_id` (`alumno_id`), ADD KEY `informacion_id` (`informacion_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `aviso_asig_alum`
--
ALTER TABLE `aviso_asig_alum`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=66;
--
-- AUTO_INCREMENT de la tabla `aviso_asig_tutor`
--
ALTER TABLE `aviso_asig_tutor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT de la tabla `aviso_info`
--
ALTER TABLE `aviso_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT de la tabla `aviso_tipo`
--
ALTER TABLE `aviso_tipo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `banco_bloques`
--
ALTER TABLE `banco_bloques`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `banco_materias`
--
ALTER TABLE `banco_materias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `banco_preguntas`
--
ALTER TABLE `banco_preguntas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de la tabla `banco_respuestas`
--
ALTER TABLE `banco_respuestas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT de la tabla `banco_subtemas`
--
ALTER TABLE `banco_subtemas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `banco_temas`
--
ALTER TABLE `banco_temas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `est_exa_respuestas_tmp`
--
ALTER TABLE `est_exa_respuestas_tmp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `est_exa_result_info`
--
ALTER TABLE `est_exa_result_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `est_exa_result_preguntas`
--
ALTER TABLE `est_exa_result_preguntas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT de la tabla `est_exa_tiempos`
--
ALTER TABLE `est_exa_tiempos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de la tabla `exa_info`
--
ALTER TABLE `exa_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `exa_info_asig`
--
ALTER TABLE `exa_info_asig`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de la tabla `exa_info_asig_alum`
--
ALTER TABLE `exa_info_asig_alum`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT de la tabla `exa_preguntas`
--
ALTER TABLE `exa_preguntas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT de la tabla `grupos_info`
--
ALTER TABLE `grupos_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `grupos_materias_profesores`
--
ALTER TABLE `grupos_materias_profesores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de la tabla `grupos_materia_alumnos`
--
ALTER TABLE `grupos_materia_alumnos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT de la tabla `grupo_alumnos`
--
ALTER TABLE `grupo_alumnos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT de la tabla `niveles_escolares`
--
ALTER TABLE `niveles_escolares`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `niveles_grados`
--
ALTER TABLE `niveles_grados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de la tabla `niveles_turnos`
--
ALTER TABLE `niveles_turnos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `usuarios_administradores`
--
ALTER TABLE `usuarios_administradores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `usuarios_alumnos`
--
ALTER TABLE `usuarios_alumnos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT de la tabla `usuarios_escuelas`
--
ALTER TABLE `usuarios_escuelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `usuarios_escuelas_secretarias`
--
ALTER TABLE `usuarios_escuelas_secretarias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `usuarios_informacion`
--
ALTER TABLE `usuarios_informacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=70;
--
-- AUTO_INCREMENT de la tabla `usuarios_profesores`
--
ALTER TABLE `usuarios_profesores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT de la tabla `usuarios_tutores`
--
ALTER TABLE `usuarios_tutores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
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
ADD CONSTRAINT `banco_materias_ibfk_1` FOREIGN KEY (`nivel_escolar_id`) REFERENCES `niveles_escolares` (`id`) ON UPDATE CASCADE,
ADD CONSTRAINT `banco_materias_ibfk_2` FOREIGN KEY (`nivel_grado_id`) REFERENCES `niveles_grados` (`id`) ON UPDATE CASCADE;

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
ADD CONSTRAINT `usuarios_alumnos_ibfk_1` FOREIGN KEY (`informacion_id`) REFERENCES `usuarios_informacion` (`id`) ON UPDATE CASCADE,
ADD CONSTRAINT `usuarios_alumnos_ibfk_2` FOREIGN KEY (`escuela_id`) REFERENCES `usuarios_escuelas` (`id`) ON UPDATE CASCADE;

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
ADD CONSTRAINT `usuarios_profesores_ibfk_2` FOREIGN KEY (`escuela_id`) REFERENCES `usuarios_escuelas` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios_tutores`
--
ALTER TABLE `usuarios_tutores`
ADD CONSTRAINT `usuarios_tutores_ibfk_1` FOREIGN KEY (`alumno_id`) REFERENCES `usuarios_alumnos` (`id`) ON UPDATE CASCADE,
ADD CONSTRAINT `usuarios_tutores_ibfk_2` FOREIGN KEY (`informacion_id`) REFERENCES `usuarios_informacion` (`id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
