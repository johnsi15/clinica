-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 26-01-2014 a las 23:04:59
-- Versión del servidor: 5.6.12-log
-- Versión de PHP: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `clinica`
--
CREATE DATABASE IF NOT EXISTS `clinica` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `clinica`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE IF NOT EXISTS `citas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cedula` varchar(15) NOT NULL,
  `nombre` varchar(90) NOT NULL,
  `entidad` varchar(120) NOT NULL,
  `tipo` varchar(120) NOT NULL,
  `fechaSolicitud` date NOT NULL,
  `fechaAsignacionPaciente` date NOT NULL,
  `fechaAsignacionSistema` date NOT NULL,
  `observaciones` text NOT NULL,
  `doctor` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `doctor` (`doctor`),
  KEY `doctor_idx` (`doctor`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`id`, `cedula`, `nombre`, `entidad`, `tipo`, `fechaSolicitud`, `fechaAsignacionPaciente`, `fechaAsignacionSistema`, `observaciones`, `doctor`) VALUES
(1, '1093763837', 'john andrey', 'coomeva', 'Colsulta', '0000-00-00', '0000-00-00', '2014-01-27', '', 1),
(2, '1058265', 'andres', 'cafesalud', 'Control', '0000-00-00', '0000-00-00', '2014-01-27', '', 3),
(3, '1058265', 'carlos', 'cafesalud', 'Colsulta', '0000-00-00', '0000-00-00', '2014-01-27', '', 1),
(4, '1025845', 'Maria', 'coomeva', 'Consulta Primera vez', '2014-01-25', '0000-00-00', '2014-01-27', '', 2),
(6, '10685424', 'dayana', 'saludcoop', 'Control', '2014-01-25', '2014-01-28', '0000-00-00', '', 4),
(7, '1093763837', 'john andrey', 'coomeva', 'Control', '2014-01-26', '2014-02-03', '0000-00-00', '', 5);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `clave`) VALUES
(1, 'invitado', '7c4a8d09ca3762af61e59520943dc26494f8941b');

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
