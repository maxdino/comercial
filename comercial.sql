-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-12-2017 a las 07:47:35
-- Versión del servidor: 10.1.19-MariaDB
-- Versión de PHP: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `comercial`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `descripcion`, `estado`) VALUES
(1, 'PANTALON', 1),
(2, 'POLO', 1),
(3, 'CAMISA', 1),
(4, 'SHORT', 1),
(5, 'BIVIRI', 1),
(6, 'CHAVO', 1),
(7, 'TORERO', 1),
(8, 'COLCHAS', 1),
(9, 'SABANA', 1),
(10, 'MEDIAS', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--

CREATE TABLE `marcas` (
  `id_marcas` int(11) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `marcas`
--

INSERT INTO `marcas` (`id_marcas`, `descripcion`, `estado`) VALUES
(1, 'MARSH', 1),
(2, 'BROKLING', 1),
(3, 'PALKO', 1),
(4, 'BRIPPERS', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulo`
--

CREATE TABLE `modulo` (
  `id_modulo` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `url` varchar(100) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `id_padre` int(11) DEFAULT NULL,
  `modulo_padre` varchar(100) DEFAULT NULL,
  `icono` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `modulo`
--

INSERT INTO `modulo` (`id_modulo`, `nombre`, `url`, `estado`, `id_padre`, `modulo_padre`, `icono`) VALUES
(1, 'MANTENIMIENTO', '#', 1, 0, 'MODULO_PADRE', NULL),
(2, 'COMPRAS', '#', 1, 0, 'MODULO_PADRE', NULL),
(3, 'VENTAS', '#', 1, 0, 'MODULO_PADRE', NULL),
(4, 'SEGURIDAD', '#', 1, 0, 'MODULO_PADRE', NULL),
(5, 'PERFIL', 'Perfil_c', 1, 4, 'SEGURIDAD', NULL),
(6, 'MODULOS', 'Modulos_c', 1, 4, 'SEGURIDAD', NULL),
(7, 'PERSONAL', 'Personal_c', 1, 4, 'SEGURIDAD', NULL),
(8, 'MARCAS', 'Marcas_c', 1, 1, 'MANTENIMIENTO', NULL),
(9, 'ACCESO A MODULOS', 'Acceso_modulo_c', 1, 4, 'SEGURIDAD', NULL),
(10, 'CATEGORIA', 'Categoria_c', 1, 1, 'MANTENIMIENTO', NULL),
(11, 'PRODUCTOS', 'Productos_c', 1, 2, 'COMPRAS', NULL),
(12, 'TALLAS', 'Tallas_c', 1, 1, 'MANTENIMIENTO', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil_usuario`
--

CREATE TABLE `perfil_usuario` (
  `id_perfil_usuario` int(11) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `perfil_usuario`
--

INSERT INTO `perfil_usuario` (`id_perfil_usuario`, `descripcion`, `estado`) VALUES
(1, 'GENERAL', 1),
(2, 'ADMINISTRADOR', 1),
(3, 'SECRETARIA', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `id_modulo` int(11) NOT NULL,
  `id_perfil_usuario` int(11) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`id_modulo`, `id_perfil_usuario`, `estado`) VALUES
(5, 1, 1),
(6, 1, 1),
(7, 1, 1),
(8, 1, 1),
(8, 2, 1),
(9, 1, 1),
(10, 1, 1),
(10, 2, 1),
(11, 1, 1),
(12, 1, 1),
(12, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_productos` int(11) NOT NULL,
  `descripcion` varchar(150) NOT NULL,
  `id_marcas` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_tallas`
--

CREATE TABLE `productos_tallas` (
  `id_productos` int(11) NOT NULL,
  `id_tallas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tallas`
--

CREATE TABLE `tallas` (
  `id_tallas` int(11) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tallas`
--

INSERT INTO `tallas` (`id_tallas`, `descripcion`, `estado`) VALUES
(1, '0', 1),
(2, '1', 1),
(3, '2', 1),
(4, '3', 1),
(5, '4', 1),
(6, '5', 1),
(7, '6', 1),
(8, '7', 1),
(9, '8', 1),
(10, '9', 1),
(11, '10', 1),
(12, '12', 1),
(13, '14', 1),
(14, '14 1/2', 1),
(15, '15', 1),
(16, '15 1/2', 1),
(17, '16', 1),
(18, '16 1/2', 1),
(19, '17', 1),
(20, '17 1/2', 1),
(21, '26', 1),
(22, '27', 1),
(23, '28', 1),
(24, '29', 1),
(25, '30', 1),
(26, '31', 1),
(27, '32', 1),
(28, '33', 1),
(29, '34', 1),
(30, '35', 1),
(31, '36', 1),
(32, '37', 1),
(33, '38', 1),
(34, '40', 1),
(35, '42', 1),
(36, '44', 1),
(37, '46', 1),
(38, 'XS', 1),
(39, 'S', 1),
(40, 'M', 1),
(41, 'L', 1),
(42, 'XL', 1),
(43, 'XXL', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nick` varchar(60) NOT NULL,
  `clave` varchar(60) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `id_perfil_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nick`, `clave`, `nombre`, `id_perfil_usuario`) VALUES
(1, 'max', '1234', 'MAX DINO HILARIO ARROYO', 1),
(2, 'jose_max', 'jose2017', 'JOSE MAX HILARIO ARROYO', 2),
(3, 'max_h', 'max2017', 'MAX F. HILARIO ARROYO', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`id_marcas`);

--
-- Indices de la tabla `modulo`
--
ALTER TABLE `modulo`
  ADD PRIMARY KEY (`id_modulo`);

--
-- Indices de la tabla `perfil_usuario`
--
ALTER TABLE `perfil_usuario`
  ADD PRIMARY KEY (`id_perfil_usuario`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id_modulo`,`id_perfil_usuario`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_productos`);

--
-- Indices de la tabla `productos_tallas`
--
ALTER TABLE `productos_tallas`
  ADD PRIMARY KEY (`id_productos`,`id_tallas`);

--
-- Indices de la tabla `tallas`
--
ALTER TABLE `tallas`
  ADD PRIMARY KEY (`id_tallas`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `marcas`
--
ALTER TABLE `marcas`
  MODIFY `id_marcas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `modulo`
--
ALTER TABLE `modulo`
  MODIFY `id_modulo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `perfil_usuario`
--
ALTER TABLE `perfil_usuario`
  MODIFY `id_perfil_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_productos` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tallas`
--
ALTER TABLE `tallas`
  MODIFY `id_tallas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
