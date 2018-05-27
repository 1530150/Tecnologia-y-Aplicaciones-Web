-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 26-05-2018 a las 05:23:16
-- Versión del servidor: 10.1.28-MariaDB
-- Versión de PHP: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_tutorias`
--
CREATE DATABASE IF NOT EXISTS `db_tutorias` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE `db_tutorias`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `matricula` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `carrera` int(11) DEFAULT NULL,
  `tutor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`matricula`, `nombre`, `carrera`, `tutor`) VALUES
('1530150', 'Brian Elí Becerra Hernández', 1, 1),
('1530326', 'Angela Judith Carrizales Pérez', 1, 1),
('1530438', 'Leonardo Daniel Alonso Cepeda', 1, 1),
('asds', 'ssdsda', 3, 2),
('sdasd', 'asdasd', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos_tutoria`
--

CREATE TABLE `alumnos_tutoria` (
  `alumno` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `tutoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `alumnos_tutoria`
--

INSERT INTO `alumnos_tutoria` (`alumno`, `tutoria`) VALUES
('1530150', 16),
('1530150', 20),
('1530326', 16),
('1530438', 17),
('1530438', 20),
('asds', 18),
('asds', 19),
('sdasd', 19);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carreras`
--

CREATE TABLE `carreras` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `carreras`
--

INSERT INTO `carreras` (`id`, `nombre`) VALUES
(1, 'Ingeniería en Tecnologías de la Información'),
(3, 'Ingeniería en Mecatrónica');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesores`
--

CREATE TABLE `profesores` (
  `numEmpleado` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nivel` int(11) NOT NULL,
  `email` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `password` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `carrera` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `profesores`
--

INSERT INTO `profesores` (`numEmpleado`, `nombre`, `nivel`, `email`, `password`, `carrera`) VALUES
(1, 'Jorge Omar Jasso Luna', 0, 'ojassol@upv.edu.mx', 'ojassol', 1),
(2, 'Mario Humberto Rodríguez Chávez', 0, 'mrodriguezc@upv.edu.mx', 'mario123', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tutorias`
--

CREATE TABLE `tutorias` (
  `id` int(11) NOT NULL,
  `tutor` int(11) DEFAULT NULL,
  `fecha` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `hora` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tipo_tutoria` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `descripcion` varchar(300) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tutorias`
--

INSERT INTO `tutorias` (`id`, `tutor`, `fecha`, `hora`, `tipo_tutoria`, `descripcion`) VALUES
(16, 1, '2018-05-19', '12:30', 'Grupal', 'naams'),
(17, 1, '2018-05-19', '12:39', 'Individual', 'sddad'),
(18, 2, '2018-05-13', '3.2', 'Individual', 'ñlñlñlñl'),
(19, 2, '2018-05-20', '2:30', 'Grupal', 'lksldkñlk'),
(20, 1, '', '', 'Grupal', '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`matricula`),
  ADD KEY `carrera` (`carrera`),
  ADD KEY `tutor` (`tutor`);

--
-- Indices de la tabla `alumnos_tutoria`
--
ALTER TABLE `alumnos_tutoria`
  ADD PRIMARY KEY (`alumno`,`tutoria`),
  ADD KEY `tutoria` (`tutoria`);

--
-- Indices de la tabla `carreras`
--
ALTER TABLE `carreras`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `profesores`
--
ALTER TABLE `profesores`
  ADD PRIMARY KEY (`numEmpleado`),
  ADD KEY `carrera` (`carrera`);

--
-- Indices de la tabla `tutorias`
--
ALTER TABLE `tutorias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tutor` (`tutor`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carreras`
--
ALTER TABLE `carreras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `profesores`
--
ALTER TABLE `profesores`
  MODIFY `numEmpleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tutorias`
--
ALTER TABLE `tutorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD CONSTRAINT `alumnos_ibfk_1` FOREIGN KEY (`carrera`) REFERENCES `carreras` (`id`),
  ADD CONSTRAINT `alumnos_ibfk_2` FOREIGN KEY (`tutor`) REFERENCES `profesores` (`numEmpleado`);

--
-- Filtros para la tabla `alumnos_tutoria`
--
ALTER TABLE `alumnos_tutoria`
  ADD CONSTRAINT `alumnos_tutoria_ibfk_1` FOREIGN KEY (`alumno`) REFERENCES `alumnos` (`matricula`),
  ADD CONSTRAINT `alumnos_tutoria_ibfk_2` FOREIGN KEY (`tutoria`) REFERENCES `tutorias` (`id`);

--
-- Filtros para la tabla `profesores`
--
ALTER TABLE `profesores`
  ADD CONSTRAINT `profesores_ibfk_1` FOREIGN KEY (`carrera`) REFERENCES `carreras` (`id`);

--
-- Filtros para la tabla `tutorias`
--
ALTER TABLE `tutorias`
  ADD CONSTRAINT `tutorias_ibfk_2` FOREIGN KEY (`tutor`) REFERENCES `profesores` (`numEmpleado`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
