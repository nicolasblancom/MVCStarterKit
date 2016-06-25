CREATE TABLE `mvcstarterkit`.`usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(50) NOT NULL,
  `pass` varchar(250) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `id_perfil` int(11) NOT NULL,
  `marcador` bigint(20) NOT NULL,
  `token_recordarme` varchar(250) NOT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `login` (`login`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
