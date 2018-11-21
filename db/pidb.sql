-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-11-2018 a las 02:06:28
-- Versión del servidor: 10.1.35-MariaDB
-- Versión de PHP: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pidb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `albumes`
--

CREATE TABLE `albumes` (
  `IdAlbum` int(11) NOT NULL,
  `Titulo` varchar(200) NOT NULL,
  `Descripcion` text NOT NULL,
  `Usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `albumes`
--

INSERT INTO `albumes` (`IdAlbum`, `Titulo`, `Descripcion`, `Usuario`) VALUES
(1, 'Fotos Playa España', 'Este álbum es una recopilación de mis viajes a las diferentes playas de España', 3),
(2, 'Fotos Montaña Asia', 'Este álbum es una recopilación de las diferentes montañas de Asia', 4),
(3, 'Fotos Paisajes Montaña', 'Imágenes de diferentes paisajes de montaña de todo el mundo.', 3),
(4, 'Fotos Playas', 'Álbum que contiene todas las fotos de todas las playas del mundo que he visitado.', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estilos`
--

CREATE TABLE `estilos` (
  `IdEstilo` int(11) NOT NULL,
  `Nombre` varchar(200) NOT NULL,
  `Descripcion` text NOT NULL,
  `Fichero` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `estilos`
--

INSERT INTO `estilos` (`IdEstilo`, `Nombre`, `Descripcion`, `Fichero`) VALUES
(1, 'Normal', 'Este es el estilo normal de la web. Los colores empleados son los colores corporativos de la marca. Se trata de un estilo monocrom?tico, que emplea distintos tonos de naranja.', 'estilo.css'),
(2, 'Accesible', 'Se trata de una version alternativa del estilo. Las caracter?sticas que lo distinguen son: mayor tama?o de los elementos de la web y el uso de colores de alto contraste como son el blanco y el negro.', 'estilo_accesible.css');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fotos`
--

CREATE TABLE `fotos` (
  `IdFoto` int(11) NOT NULL,
  `Titulo` varchar(200) NOT NULL,
  `Descripcion` mediumtext NOT NULL,
  `Fecha` date NOT NULL,
  `Pais` int(11) NOT NULL,
  `Album` int(11) NOT NULL,
  `Fichero` varchar(500) NOT NULL,
  `Alternativo` varchar(200) NOT NULL,
  `FRegistro` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `fotos`
--

INSERT INTO `fotos` (`IdFoto`, `Titulo`, `Descripcion`, `Fecha`, `Pais`, `Album`, `Fichero`, `Alternativo`, `FRegistro`) VALUES
(1, 'Foto Playa España', 'Una imagen de una playa de España al atardecer.', '2018-11-07', 1, 1, 'imagen-muestra/paisaje.jpg', 'Playa de España al atardecer', '2018-11-21 00:37:02'),
(2, 'Imagen Montaña Asia', 'Una foto de una montaña de Pekin.', '2018-11-08', 7, 2, 'imagen-muestra/images2.jpg', 'Foto de una montaña de Pekín', '2018-11-21 01:57:16'),
(3, 'Foto Playa Francia', 'Imagen de una playa ubicada en Francia.', '2018-11-12', 4, 4, 'imagen-muestra/imagen-muestra.jpg', 'Foto de una playa francesa', '2018-11-21 01:36:18'),
(4, 'Foto Playa Europa', 'Una playa de Europa.', '2018-10-19', 5, 4, 'imagen-muestra/imagen-muestra.jpg', 'Una playa de Europa', '2018-11-21 01:51:40'),
(5, 'Foto Montaña Sudáfrica', 'Una foto de una montaña de Sudáfrica.', '2018-11-11', 14, 3, 'imagen-muestra/descarga.jpg', 'Foto de una montaña de Sudáfrica', '2018-11-21 01:44:40'),
(6, 'Foto Playa Australia', 'Imagen de una playa de Australia.', '2018-11-03', 15, 4, 'imagen-muestra/imagen-muestra.jpg', 'Foto de una playa de Australia', '2018-11-21 01:51:50'),
(7, 'Foto Playa Argentina', 'Una imagen de una playa de Argentina.', '2018-11-02', 16, 4, 'imagen-muestra/images2.jpg', 'Foto de una playa de Argentina', '2018-11-21 01:50:07'),
(8, 'Foto Montaña Japón', 'Una imagen de una montaña de Japón.', '2018-11-05', 10, 3, 'imagen-muestra/descarga.jpg', 'Foto de una montaña de Japón', '2018-11-21 01:50:10');

--
-- Disparadores `fotos`
--
DELIMITER $$
CREATE TRIGGER `comprobarLongitudAlternativo` BEFORE INSERT ON `fotos` FOR EACH ROW BEGIN
	DECLARE mensajeError VARCHAR(500);
    DECLARE alt INTEGER;
	SET alt = LENGTH(NEW.Alternativo);
	IF alt < 10 THEN
	SET mensajeError = concat('Error al insertar Alternativo: Su longitud debe de ser minimo de 10 caracteres. Longitud del texto introducido: ', alt);
	SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = mensajeError;
	END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paises`
--

CREATE TABLE `paises` (
  `IdPais` int(11) NOT NULL,
  `NomPais` varchar(200) NOT NULL,
  `Continente` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `paises`
--

INSERT INTO `paises` (`IdPais`, `NomPais`, `Continente`) VALUES
(1, 'España', 'Europa'),
(2, 'Colombia', 'Sudamérica'),
(3, 'Alemania', 'Europa'),
(4, 'Francia', 'Europa'),
(5, 'Suiza', 'Europa'),
(6, 'Suecia', 'Europa'),
(7, 'China', 'Asia'),
(8, 'Corea-Norte', 'Asia'),
(9, 'Corea-Sur', 'Asia'),
(10, 'Japón', 'Asia'),
(11, 'EE.UU', 'Norteamérica'),
(12, 'Canadá', 'Norteamérica'),
(13, 'Marruecos', 'África'),
(14, 'Sudáfrica', 'África'),
(15, 'Australia', 'Oceanía'),
(16, 'Argentina', 'Sudamérica'),
(17, 'México', 'Norteamérica'),
(18, 'Perú', 'Sudamérica');

--
-- Disparadores `paises`
--
DELIMITER $$
CREATE TRIGGER `ContinenteCorrecto` BEFORE INSERT ON `paises` FOR EACH ROW BEGIN
DECLARE mensajeError VARCHAR(500);
IF NEW.Continente = '' OR NEW.Continente NOT IN('Europa', 'Norteamérica', 'Sudamérica', 'Asia', 'Oceanía', 'África', 'Antártida') THEN
SET mensajeError = concat('Error al insertar continente: el valor de la columna Continente no puede ser cadena vacía o ", y, además, su valor debe de corresponderse con alguno de los 7 existentes. Lista de continentes: Europa, Asia, Oceanía, Norteamérica, Sudamérica, África y Antártida. (Se debe escribir el continente con los acentos que tenga). Continente especificado: ', NEW.Continente);
SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = mensajeError;
END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudes`
--

CREATE TABLE `solicitudes` (
  `IdAlbum` int(11) NOT NULL,
  `Album` int(11) NOT NULL,
  `Nombre` varchar(200) NOT NULL,
  `Titulo` varchar(200) NOT NULL,
  `Descripcion` mediumtext NOT NULL,
  `Email` varchar(200) NOT NULL,
  `d_Calle` varchar(200) NOT NULL,
  `d_Numero` int(11) NOT NULL,
  `d_CP` int(11) NOT NULL,
  `d_Pais` int(11) NOT NULL,
  `d_Localidad` varchar(200) NOT NULL,
  `d_Provincia` varchar(200) NOT NULL,
  `Color` varchar(200) NOT NULL,
  `Copias` int(11) NOT NULL,
  `Resolucion` int(11) NOT NULL,
  `Fecha` date NOT NULL,
  `IColor` tinyint(1) NOT NULL,
  `FRegistro` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `Coste` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `IdUsuario` int(11) NOT NULL,
  `NomUsuario` varchar(15) NOT NULL,
  `Clave` varchar(200) NOT NULL,
  `Email` varchar(200) NOT NULL,
  `Sexo` tinyint(4) NOT NULL,
  `FNacimiento` date NOT NULL,
  `Ciudad` varchar(200) NOT NULL,
  `Pais` int(11) NOT NULL,
  `Foto` varchar(200) NOT NULL,
  `FRegistro` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `Estilo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`IdUsuario`, `NomUsuario`, `Clave`, `Email`, `Sexo`, `FNacimiento`, `Ciudad`, `Pais`, `Foto`, `FRegistro`, `Estilo`) VALUES
(3, 'pepee1', '11111111', 'pepee1@pi.es', 1, '1998-11-08', 'Valencia', 1, './img/pepee1.png', '0000-00-00 00:00:00', 1),
(4, 'manolo2', '22222222', 'manolo2@pi.es', 2, '1998-11-09', 'San Vicente del Raspeig', 1, './img/manolo2.png', '0000-00-00 00:00:00', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `albumes`
--
ALTER TABLE `albumes`
  ADD PRIMARY KEY (`IdAlbum`),
  ADD KEY `ajena-Albumes-Usuarios` (`Usuario`);

--
-- Indices de la tabla `estilos`
--
ALTER TABLE `estilos`
  ADD PRIMARY KEY (`IdEstilo`);

--
-- Indices de la tabla `fotos`
--
ALTER TABLE `fotos`
  ADD PRIMARY KEY (`IdFoto`),
  ADD KEY `ajena_Fotos-Album` (`Album`);

--
-- Indices de la tabla `paises`
--
ALTER TABLE `paises`
  ADD PRIMARY KEY (`IdPais`);

--
-- Indices de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  ADD PRIMARY KEY (`IdAlbum`),
  ADD KEY `ajena-Solicitudes-Pais` (`d_Pais`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`IdUsuario`),
  ADD UNIQUE KEY `NomUsuario` (`NomUsuario`),
  ADD KEY `ajena-Usuario-Estilo` (`Estilo`),
  ADD KEY `ajena-Usuario-Pais` (`Pais`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `albumes`
--
ALTER TABLE `albumes`
  MODIFY `IdAlbum` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `estilos`
--
ALTER TABLE `estilos`
  MODIFY `IdEstilo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `fotos`
--
ALTER TABLE `fotos`
  MODIFY `IdFoto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `paises`
--
ALTER TABLE `paises`
  MODIFY `IdPais` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  MODIFY `IdAlbum` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `IdUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `albumes`
--
ALTER TABLE `albumes`
  ADD CONSTRAINT `ajena-Albumes-Usuarios` FOREIGN KEY (`Usuario`) REFERENCES `usuarios` (`IdUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `fotos`
--
ALTER TABLE `fotos`
  ADD CONSTRAINT `ajena_Fotos-Album` FOREIGN KEY (`Album`) REFERENCES `albumes` (`IdAlbum`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  ADD CONSTRAINT `ajena-Solicitudes-Album` FOREIGN KEY (`IdAlbum`) REFERENCES `albumes` (`IdAlbum`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ajena-Solicitudes-Pais` FOREIGN KEY (`d_Pais`) REFERENCES `paises` (`IdPais`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `ajena-Usuario-Estilo` FOREIGN KEY (`Estilo`) REFERENCES `estilos` (`IdEstilo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ajena-Usuario-Pais` FOREIGN KEY (`Pais`) REFERENCES `paises` (`IdPais`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
