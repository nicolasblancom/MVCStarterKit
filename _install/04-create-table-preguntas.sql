CREATE TABLE `mvcstarterkit`.`pregunta` (
  `id_pregunta` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `asunto` varchar(250) DEFAULT NULL,
  `cuerpo` text,
  `slug` varchar(250) NOT NULL,
  PRIMARY KEY (`id_pregunta`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;
