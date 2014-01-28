-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 28-01-2014 a las 23:00:44
-- Versión del servidor: 5.5.27
-- Versión de PHP: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `clinica`
--
CREATE DATABASE `clinica` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `clinica`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE IF NOT EXISTS `citas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `documento` varchar(20) NOT NULL,
  `numero` varchar(15) NOT NULL,
  `nombre` varchar(90) NOT NULL,
  `entidad` varchar(120) NOT NULL,
  `tipo` varchar(120) NOT NULL,
  `fechaSolicitud` date NOT NULL,
  `fechaAsignacionPaciente` date NOT NULL,
  `fechaAsignacionSistema` date NOT NULL,
  `observaciones` text NOT NULL,
  `doctor` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `doctor` (`doctor`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`id`, `documento`, `numero`, `nombre`, `entidad`, `tipo`, `fechaSolicitud`, `fechaAsignacionPaciente`, `fechaAsignacionSistema`, `observaciones`, `doctor`) VALUES
(1, '', '1093763837', 'john andrey', 'coomeva', 'Colsulta', '0000-00-00', '0000-00-00', '2014-01-27', '', 1),
(2, '', '1058265', 'andres', 'cafesalud', 'Control', '0000-00-00', '0000-00-00', '2014-01-27', '', 3),
(3, '', '1058265', 'carlos', 'cafesalud', 'Colsulta', '0000-00-00', '0000-00-00', '2014-01-27', '', 1),
(4, '', '1025845', 'Maria', 'coomeva', 'Consulta Primera vez', '2014-01-25', '0000-00-00', '2014-01-27', '', 2),
(6, '', '10685424', 'dayana', 'saludcoop', 'Control', '2014-01-25', '2014-01-28', '0000-00-00', '', 4),
(7, '', '1093763837', 'john andrey', 'coomeva', 'Control', '2014-01-26', '2014-02-03', '0000-00-00', '', 5),
(8, '', '75867', 'prueba', 'prueba', 'prueba', '2014-01-27', '2014-01-28', '0000-00-00', '', 3),
(9, 'CC', '98646', 'prueba', 'prueba', 'prueba', '2014-01-28', '2014-01-29', '0000-00-00', '', 3),
(10, 'CC', 'prueba', 'prueba', 'prueba', 'Control Con Orden', '2014-01-28', '0000-00-00', '0000-00-00', '', 3),
(11, 'CC', '1343456', 'Maria Holguin', 'COOMEVA', 'Control sin Cita', '2014-01-28', '0000-00-00', '0000-00-00', '', 3),
(12, 'CC', '1093763837', 'john andrey', 'COOMEVA', 'Control Con Orden', '2014-01-28', '2014-01-29', '0000-00-00', '', 3),
(13, 'CC', '125666', 'prueba', 'COOMEVA', 'Consulta Primera Vez', '2014-01-28', '2014-01-29', '2014-01-29', '', 3),
(14, 'RC', '67678', 'prueba', 'COOMEVA', 'Consulta Primera Vez', '2014-01-28', '2014-01-29', '0000-00-00', '', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicos`
--

CREATE TABLE IF NOT EXISTS `medicos` (
  `idMedico` int(11) NOT NULL AUTO_INCREMENT,
  `nombreMedico` varchar(90) NOT NULL,
  PRIMARY KEY (`idMedico`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `medicos`
--

INSERT INTO `medicos` (`idMedico`, `nombreMedico`) VALUES
(1, 'medico 1'),
(2, 'medico 2'),
(3, 'medico 3'),
(4, 'medico 4'),
(5, 'medico 5');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(80) NOT NULL,
  `clave` varchar(80) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `clave`) VALUES
(1, 'invitado', '2dd44281ca02dd69e4ef8f872cf8ab0c8ffe2387'),
(2, 'invitado2', '2dd44281ca02dd69e4ef8f872cf8ab0c8ffe2387'),
(3, 'invitado3', '2dd44281ca02dd69e4ef8f872cf8ab0c8ffe2387'),
(4, 'invitado4', '2dd44281ca02dd69e4ef8f872cf8ab0c8ffe2387'),
(5, 'invitado5', '2dd44281ca02dd69e4ef8f872cf8ab0c8ffe2387');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `citas`
--
ALTER TABLE `citas`
  ADD CONSTRAINT `citas_ibfk_1` FOREIGN KEY (`doctor`) REFERENCES `medicos` (`idMedico`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
