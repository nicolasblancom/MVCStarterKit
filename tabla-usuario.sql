-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 04-05-2015 a las 12:58:14
-- Versión del servidor: 5.5.43-0ubuntu0.14.04.1
-- Versión de PHP: 5.5.9-1ubuntu4.9

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
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(50) NOT NULL,
  `pass` varchar(250) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `id_perfil` int(11) NOT NULL,
  `marcador` bigint(20) NOT NULL,
  `token_recordarme` varchar(250) NOT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `login` (`login`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `login`, `pass`, `nombre`, `id_perfil`, `marcador`, `token_recordarme`) VALUES
(1, 'miguel@desarrolloweb.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'Miguel A Alvarez', 1, 216781394851371, 'c4be99126436fa4661ce8130b124d115f1ce659b161099976b1dd9c8d6b1a805'),
(2, 'sara@desarrolloweb.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'Sara Alvarez', 1, 379901394849217, ''),
(3, 'yo@yo.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'dfddf', 2, 0, '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
