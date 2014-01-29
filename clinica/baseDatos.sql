-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 29-01-2014 a las 19:22:19
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`id`, `documento`, `numero`, `nombre`, `entidad`, `tipo`, `fechaSolicitud`, `fechaAsignacionPaciente`, `fechaAsignacionSistema`, `observaciones`, `doctor`) VALUES
(1, '', '1093763837', 'john andrey', 'coomeva', 'Colsulta', '0000-00-00', '0000-00-00', '2014-01-27', '', 1),
(2, '', '1058265', 'andres', 'cafesalud', 'Control', '0000-00-00', '0000-00-00', '2014-01-27', '', 3),
(3, '', '1058265', 'carlos', 'cafesalud', 'Colsulta', '0000-00-00', '0000-00-00', '2014-01-27', '', 1),
(4, '', '1025845', 'Maria', 'coomeva', 'Consulta Primera vez', '2014-01-25', '0000-00-00', '2014-01-27', '', 2),
(7, '', '1093763837', 'john andrey', 'coomeva', 'Control', '2014-01-26', '2014-02-03', '0000-00-00', '', 5),
(8, '', '75867', 'prueba', 'prueba', 'prueba', '2014-01-27', '2014-01-28', '0000-00-00', '', 3),
(9, 'CC', '98646', 'prueba', 'prueba', 'prueba', '2014-01-28', '2014-01-29', '0000-00-00', '', 3),
(10, 'CC', 'prueba', 'prueba', 'prueba', 'Control Con Orden', '2014-01-28', '0000-00-00', '0000-00-00', '', 3),
(11, 'CC', '1343456', 'Maria Holguin', 'COOMEVA', 'Control sin Cita', '2014-01-28', '0000-00-00', '0000-00-00', '', 3),
(12, 'CC', '1093763837', 'john andrey', 'COOMEVA', 'Control Con Orden', '2014-01-28', '2014-01-29', '0000-00-00', '', 3),
(13, 'CC', '125666', 'prueba', 'COOMEVA', 'Consulta Primera Vez', '2014-01-28', '2014-01-29', '2014-01-29', '', 3),
(14, 'RC', '67678', 'prueba', 'COOMEVA', 'Consulta Primera Vez', '2014-01-28', '2014-01-29', '0000-00-00', '', 4),
(15, 'CC', '1093763837', 'john andrey', 'ECOOSOS', 'Control Con Orden', '2014-01-29', '2014-01-30', '0000-00-00', '', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicos`
--

CREATE TABLE IF NOT EXISTS `medicos` (
  `idMedico` int(11) NOT NULL AUTO_INCREMENT,
  `nombreMedico` varchar(90) NOT NULL,
  PRIMARY KEY (`idMedico`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Volcado de datos para la tabla `medicos`
--

INSERT INTO `medicos` (`idMedico`, `nombreMedico`) VALUES
(1, 'DRA. MARTHA JANICE RODRIGUEZ QUINTERO'),
(2, 'DR. RAFAEL GARCIA AMARIS'),
(3, 'DR. PABLO EMILIO CORREA MONTAÃ‘EZ'),
(4, 'DRA. ANGELA SOFIA ESPINEL CHAVES'),
(5, 'DR. JUAN JOSE VANEGAS ACEVEDO'),
(6, 'DR. ALVARO EDUARDO GUTIERREZ BONILLA'),
(7, 'DRA. MARIA DEL PILAR MORA URBINA'),
(8, 'DRA. GIOVANNA VILLAMIZAR REAL'),
(9, 'DRA. SILVIA CAROLINA FLOREZ FAILLACE'),
(10, 'DR. MAURICIO GARCIA'),
(11, 'DR. FERNANDO CIANCI'),
(12, 'DRA. ADRIANA AMADO'),
(13, 'DR. JAVIER JIMENEZ DUARTE'),
(14, 'DRA. ANA MARIA MORALES'),
(15, 'DR. MARCUCCI RICARDO');

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
