-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 23-04-2015 a las 23:41:56
-- Versión del servidor: 5.5.41-0ubuntu0.14.04.1
-- Versión de PHP: 5.5.9-1ubuntu4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `mini`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pregunta`
--

CREATE TABLE IF NOT EXISTS `pregunta` (
  `id_pregunta` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `asunto` varchar(250) DEFAULT NULL,
  `cuerpo` text,
  `slug` varchar(250) NOT NULL,
  PRIMARY KEY (`id_pregunta`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `pregunta`
--

INSERT INTO `pregunta` (`id_pregunta`, `asunto`, `cuerpo`, `slug`) VALUES
(2, 'Pregunta de pruebaaaaa', 'lalalala esto es una prueba', 'preg1'),
(3, 'Otra pregunta', 'Esto mola!!', 'preg3'),
(4, 'hola que tal', 'ddgdfgddsfsd sdgd', 'preg12'),
(5, 'gdgdgdf', 'ewdfwefw', 'preg55665'),
(6, 'Probando slug', 'peroorororr', 'mi-slug1429819761');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
