-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 12-05-2018 a las 17:11:25
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
-- Base de datos: `equipoUPV`
--
CREATE DATABASE IF NOT EXISTS `equipoUPV` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `equipoUPV`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jugadores`
--

CREATE TABLE `jugadores` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `equipo` varchar(30) NOT NULL,
  `posicion` varchar(30) DEFAULT NULL,
  `carrera` varchar(50) DEFAULT NULL,
  `email` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `jugadores`
--

INSERT INTO `jugadores` (`id`, `nombre`, `equipo`, `posicion`, `carrera`, `email`) VALUES
(2, 'José Ruiz Ortiz', 'Basquetbol', 'Base', 'Ingeniería en Mecatrónica', '1530192@upv.edu.mx'),
(5, 'José Márquez Gómez', 'Basquetbol', 'Escolta', 'Licenciatura en Administración y Gestión de PYMES', '1630481@upv.edu.mx'),
(5, 'Pedro García Peralta', 'Fútbol', 'Portero', 'Ingeniería en Sistemas Automotrices', '1430321@upv.edu.mx'),
(8, 'Carlos Carreón Vázquez', 'Basquetbol', 'Alero', 'Licenciatura en Administración y Gestión de PYMES', '1630086@upv.edu.mx'),
(8, 'Sergio Ortiz Lucio', 'Fútbol', 'Defensa', 'Ingeniería en Mecatrónica', '1530213@upv.edu.mx'),
(9, 'Luis Gerardo Ruiz López', 'Fútbol', 'Delantero', 'Ingeniería en Mecatrónica', '1330214@upv.edu.mx'),
(11, 'Héctor Coronado Maldonado', 'Basquetbol', 'Ala-pívot', 'Ingeniería en Mecatrónica', '1630021@upv.edu.mx'),
(12, 'Juan Pérez Mejía', 'Fútbol', 'Defensa', 'Ingeniería en Tecnologías de Manufactura', '1430381@upv.edu.mx'),
(16, 'Ricardo Antonio Tejada Ordoñez', 'Basquetbol', 'Pívot', 'Ingeniería en Tecnologías de Manufactura', '1630109@upv.edu.mx'),
(19, 'Brian Elí Becerra Hernández', 'Fútbol', 'Medio', 'Ingeniería en Tecnologías de la Información', '1530150@upv.edu.mx');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `jugadores`
--
ALTER TABLE `jugadores`
  ADD PRIMARY KEY (`id`,`equipo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
