-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-06-2016 a las 12:19:10
-- Versión del servidor: 5.7.9
-- Versión de PHP: 5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `couchinn`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anuncio`
--

DROP TABLE IF EXISTS `anuncio`;
CREATE TABLE IF NOT EXISTS `anuncio` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Capacidad` int(11) NOT NULL,
  `Titulo` tinytext COLLATE utf8_spanish_ci NOT NULL,
  `Descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  `Fecha` datetime NOT NULL,
  `ID_tipo_hospedaje` int(11) NOT NULL,
  `ID_ciudad` int(11) NOT NULL,
  `ID_usuario` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `ID_usuario` (`ID_usuario`),
  KEY `ID_ciudad` (`ID_ciudad`),
  KEY `ID_tipo_hospedaje` (`ID_tipo_hospedaje`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calificacion`
--

DROP TABLE IF EXISTS `calificacion`;
CREATE TABLE IF NOT EXISTS `calificacion` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `comentario` text COLLATE utf8_spanish_ci NOT NULL,
  `puntaje` int(11) NOT NULL,
  `ID_reserva` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `ID_reserva` (`ID_reserva`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudad`
--

DROP TABLE IF EXISTS `ciudad`;
CREATE TABLE IF NOT EXISTS `ciudad` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `ID_provincia` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `ID_provincia` (`ID_provincia`)
) ENGINE=InnoDB AUTO_INCREMENT=27858 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagen`
--

DROP TABLE IF EXISTS `imagen`;
CREATE TABLE IF NOT EXISTS `imagen` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `enlace` tinytext COLLATE utf8_spanish_ci NOT NULL,
  `ID_anuncio` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `ID_anuncio` (`ID_anuncio`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago`
--

DROP TABLE IF EXISTS `pago`;
CREATE TABLE IF NOT EXISTS `pago` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `monto` double NOT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `precio`
--

DROP TABLE IF EXISTS `precio`;
CREATE TABLE IF NOT EXISTS `precio` (
  `Valor` double NOT NULL DEFAULT '50',
  UNIQUE KEY `Valor` (`Valor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pregunta`
--

DROP TABLE IF EXISTS `pregunta`;
CREATE TABLE IF NOT EXISTS `pregunta` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` datetime NOT NULL,
  `texto` text COLLATE utf8_spanish_ci NOT NULL,
  `ID_anuncio` int(11) NOT NULL,
  `ID_usuario` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `ID_usuario` (`ID_usuario`),
  KEY `ID_anuncio` (`ID_anuncio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincia`
--

DROP TABLE IF EXISTS `provincia`;
CREATE TABLE IF NOT EXISTS `provincia` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Nombre` (`Nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserva`
--

DROP TABLE IF EXISTS `reserva`;
CREATE TABLE IF NOT EXISTS `reserva` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_aceptacion` date NOT NULL,
  `ID_solicitud` int(11) NOT NULL,
  `ID_calificacion_visitante` int(11) DEFAULT NULL,
  `ID_calificacion_dueño` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID_solicitud` (`ID_solicitud`),
  UNIQUE KEY `ID_calificacion_visitante` (`ID_calificacion_visitante`),
  UNIQUE KEY `ID_calificacion_dueño` (`ID_calificacion_dueño`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuesta`
--

DROP TABLE IF EXISTS `respuesta`;
CREATE TABLE IF NOT EXISTS `respuesta` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` datetime NOT NULL,
  `texto` text COLLATE utf8_spanish_ci NOT NULL,
  `ID_pregunta` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID_pregunta` (`ID_pregunta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_reserva`
--

DROP TABLE IF EXISTS `solicitud_reserva`;
CREATE TABLE IF NOT EXISTS `solicitud_reserva` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_solicitud` datetime NOT NULL,
  `estado` enum('aceptada','rechazada','pendiente') COLLATE utf8_spanish_ci NOT NULL,
  `cantidad_personas` int(11) NOT NULL,
  `comentario` text COLLATE utf8_spanish_ci NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `ID_reserva` int(11) DEFAULT NULL,
  `ID_anuncio` int(11) NOT NULL,
  `ID_usuario` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID_reserva` (`ID_reserva`),
  KEY `ID_anuncio` (`ID_anuncio`),
  KEY `ID_usuario` (`ID_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_hospedaje`
--

DROP TABLE IF EXISTS `tipo_hospedaje`;
CREATE TABLE IF NOT EXISTS `tipo_hospedaje` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `Deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Nombre` (`Nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `Apellido` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `Telefono` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `Username` varchar(12) COLLATE utf8_spanish_ci NOT NULL,
  `Tipo` enum('admin','premium','banned','common') COLLATE utf8_spanish_ci NOT NULL DEFAULT 'common',
  `Email` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `ID_pago` int(11) DEFAULT NULL,
  `Contraseña` char(255) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Username` (`Username`),
  UNIQUE KEY `Email` (`Email`),
  UNIQUE KEY `ID_pago` (`ID_pago`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `anuncio`
--
ALTER TABLE `anuncio`
  ADD CONSTRAINT `anuncio_ibfk_1` FOREIGN KEY (`ID_tipo_hospedaje`) REFERENCES `tipo_hospedaje` (`ID`),
  ADD CONSTRAINT `anuncio_ibfk_2` FOREIGN KEY (`ID_ciudad`) REFERENCES `ciudad` (`ID`),
  ADD CONSTRAINT `anuncio_ibfk_3` FOREIGN KEY (`ID_usuario`) REFERENCES `usuario` (`ID`);

--
-- Filtros para la tabla `calificacion`
--
ALTER TABLE `calificacion`
  ADD CONSTRAINT `calificacion_ibfk_1` FOREIGN KEY (`ID_reserva`) REFERENCES `reserva` (`ID`);

--
-- Filtros para la tabla `ciudad`
--
ALTER TABLE `ciudad`
  ADD CONSTRAINT `ciudad_ibfk_1` FOREIGN KEY (`ID_provincia`) REFERENCES `provincia` (`ID`);

--
-- Filtros para la tabla `imagen`
--
ALTER TABLE `imagen`
  ADD CONSTRAINT `imagen_ibfk_1` FOREIGN KEY (`ID_anuncio`) REFERENCES `anuncio` (`ID`);

--
-- Filtros para la tabla `pregunta`
--
ALTER TABLE `pregunta`
  ADD CONSTRAINT `pregunta_ibfk_1` FOREIGN KEY (`ID_anuncio`) REFERENCES `anuncio` (`ID`),
  ADD CONSTRAINT `pregunta_ibfk_2` FOREIGN KEY (`ID_usuario`) REFERENCES `usuario` (`ID`);

--
-- Filtros para la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD CONSTRAINT `reserva_ibfk_1` FOREIGN KEY (`ID_solicitud`) REFERENCES `solicitud_reserva` (`ID`),
  ADD CONSTRAINT `reserva_ibfk_2` FOREIGN KEY (`ID_calificacion_visitante`) REFERENCES `calificacion` (`ID`),
  ADD CONSTRAINT `reserva_ibfk_3` FOREIGN KEY (`ID_calificacion_dueño`) REFERENCES `calificacion` (`ID`);

--
-- Filtros para la tabla `respuesta`
--
ALTER TABLE `respuesta`
  ADD CONSTRAINT `respuesta_ibfk_1` FOREIGN KEY (`ID_pregunta`) REFERENCES `pregunta` (`ID`);

--
-- Filtros para la tabla `solicitud_reserva`
--
ALTER TABLE `solicitud_reserva`
  ADD CONSTRAINT `solicitud_reserva_ibfk_1` FOREIGN KEY (`ID_reserva`) REFERENCES `reserva` (`ID`),
  ADD CONSTRAINT `solicitud_reserva_ibfk_2` FOREIGN KEY (`ID_anuncio`) REFERENCES `anuncio` (`ID`),
  ADD CONSTRAINT `solicitud_reserva_ibfk_3` FOREIGN KEY (`ID_usuario`) REFERENCES `usuario` (`ID`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`ID_pago`) REFERENCES `pago` (`ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
