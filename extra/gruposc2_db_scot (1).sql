-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-12-2015 a las 22:30:52
-- Versión del servidor: 5.6.21
-- Versión de PHP: 5.5.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `gruposc2_db_scot`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `barcos`
--

CREATE TABLE IF NOT EXISTS `barcos` (
`id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `descripcion` text,
  `naviera_id` int(5) DEFAULT NULL,
  `galeria_id` int(5) DEFAULT NULL,
  `sort` int(5) DEFAULT NULL,
  `construccion` date DEFAULT NULL,
  `remodelacion` date DEFAULT NULL,
  `bandera` varchar(100) DEFAULT NULL,
  `capacidad_max` smallint(6) DEFAULT NULL,
  `tripulantes` int(11) DEFAULT NULL,
  `cabinas_internas` smallint(6) DEFAULT NULL,
  `cabinas_externas` smallint(6) DEFAULT NULL,
  `cabinas_externas_balcon` smallint(6) DEFAULT NULL,
  `cabinas_suite_balcon` smallint(6) DEFAULT NULL,
  `cap_max_cabina` smallint(6) DEFAULT NULL,
  `restriccion_edad` varchar(250) DEFAULT NULL,
  `turnos_comida` smallint(6) DEFAULT NULL,
  `asientos_asignados` tinyint(1) DEFAULT '0',
  `horario_comida` varchar(150) DEFAULT NULL,
  `vestimenta_comedor` varchar(150) DEFAULT NULL,
  `tonelaje` int(11) DEFAULT NULL,
  `eslora` int(11) DEFAULT NULL,
  `manga` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_paquetes`
--

CREATE TABLE IF NOT EXISTS `categoria_paquetes` (
`id` smallint(6) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `convertibilidad`
--

CREATE TABLE IF NOT EXISTS `convertibilidad` (
`id` int(11) NOT NULL,
  `data` text,
  `name` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `galeria`
--

CREATE TABLE IF NOT EXISTS `galeria` (
`id` int(11) NOT NULL,
  `images` text,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hoteles`
--

CREATE TABLE IF NOT EXISTS `hoteles` (
  `id` smallint(6) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `descripcion` text,
  `ubicacion` text,
  `comodidades` text,
  `galeria_id` smallint(6) DEFAULT NULL,
  `vigencia` text,
  `regimen_id` smallint(6) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes`
--

CREATE TABLE IF NOT EXISTS `imagenes` (
`id` int(11) NOT NULL,
  `file_name` varchar(150) DEFAULT NULL,
  `type` varchar(30) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `navieras`
--

CREATE TABLE IF NOT EXISTS `navieras` (
`id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `logo_id_imagen` int(5) DEFAULT NULL,
  `descripcion` text,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticias`
--

CREATE TABLE IF NOT EXISTS `noticias` (
`id` int(11) NOT NULL,
  `descripcion` text,
  `activo` tinyint(1) DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  `creation_at` datetime DEFAULT NULL,
  `galeria_id` int(5) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paquetes`
--

CREATE TABLE IF NOT EXISTS `paquetes` (
`id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `descripcion` text,
  `dias` int(3) DEFAULT NULL,
  `noches` int(3) DEFAULT NULL,
  `activo` tinyint(4) DEFAULT NULL,
  `caducidad` date DEFAULT NULL,
  `destinos` text,
  `id_galeria` int(5) DEFAULT NULL,
  `id_tipo_promocion` int(5) DEFAULT NULL,
  `sup_categoria` tinyint(5) NOT NULL,
  `itinerario` text,
  `cat_paquete` smallint(6) DEFAULT NULL,
  `tags` tinytext,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `promociones`
--

CREATE TABLE IF NOT EXISTS `promociones` (
`id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `regimenes`
--

CREATE TABLE IF NOT EXISTS `regimenes` (
`id` smallint(6) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `super_categoria`
--

CREATE TABLE IF NOT EXISTS `super_categoria` (
`id` tinyint(4) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `super_categoria`
--

INSERT INTO `super_categoria` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'crucero', '2015-11-23 10:46:31', '0000-00-00 00:00:00'),
(2, 'aeroterrestre', '2015-11-23 10:46:31', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `suscripciones`
--

CREATE TABLE IF NOT EXISTS `suscripciones` (
  `id` int(11) NOT NULL,
  `email` varchar(150) DEFAULT NULL,
  `name` varchar(150) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_promocion`
--

CREATE TABLE IF NOT EXISTS `tipo_promocion` (
`id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `sort` int(5) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `password` varchar(60) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `barcos`
--
ALTER TABLE `barcos`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categoria_paquetes`
--
ALTER TABLE `categoria_paquetes`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `convertibilidad`
--
ALTER TABLE `convertibilidad`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `galeria`
--
ALTER TABLE `galeria`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `hoteles`
--
ALTER TABLE `hoteles`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `imagenes`
--
ALTER TABLE `imagenes`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `navieras`
--
ALTER TABLE `navieras`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `noticias`
--
ALTER TABLE `noticias`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `paquetes`
--
ALTER TABLE `paquetes`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
 ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `promociones`
--
ALTER TABLE `promociones`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `regimenes`
--
ALTER TABLE `regimenes`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `super_categoria`
--
ALTER TABLE `super_categoria`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `suscripciones`
--
ALTER TABLE `suscripciones`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_promocion`
--
ALTER TABLE `tipo_promocion`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `barcos`
--
ALTER TABLE `barcos`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `categoria_paquetes`
--
ALTER TABLE `categoria_paquetes`
MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `convertibilidad`
--
ALTER TABLE `convertibilidad`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `galeria`
--
ALTER TABLE `galeria`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `imagenes`
--
ALTER TABLE `imagenes`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `navieras`
--
ALTER TABLE `navieras`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `noticias`
--
ALTER TABLE `noticias`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `paquetes`
--
ALTER TABLE `paquetes`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `promociones`
--
ALTER TABLE `promociones`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `regimenes`
--
ALTER TABLE `regimenes`
MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `super_categoria`
--
ALTER TABLE `super_categoria`
MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `tipo_promocion`
--
ALTER TABLE `tipo_promocion`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
