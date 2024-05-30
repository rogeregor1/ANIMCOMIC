-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 30-05-2024 a las 23:08:16
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `inventario2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `categoria_id` int(11) NOT NULL,
  `categoria_nombre` varchar(50) NOT NULL,
  `categoria_ubicacion` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`categoria_id`, `categoria_nombre`, `categoria_ubicacion`) VALUES
(1, 'juguetes', 'q9'),
(2, 'libros', 'e8'),
(3, 'anime', 'w3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cesta`
--

CREATE TABLE `cesta` (
  `cesta_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `unidades` int(11) NOT NULL DEFAULT 0,
  `precio_parcial` decimal(30,2) NOT NULL DEFAULT 0.00,
  `precio_total` decimal(30,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contactos`
--

CREATE TABLE `contactos` (
  `contacto_id` int(11) NOT NULL,
  `direccion` varchar(100) NOT NULL DEFAULT '',
  `provincia` varchar(20) DEFAULT 'Alicante',
  `ciudad` varchar(20) DEFAULT 'San_Juan',
  `c.p.` int(6) DEFAULT 3000,
  `telefono` varchar(45) DEFAULT 'telefono_autor'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `contactos`
--

INSERT INTO `contactos` (`contacto_id`, `direccion`, `provincia`, `ciudad`, `c.p.`, `telefono`) VALUES
(1, 'Poligono Industrial', 'Alicante', 'Alicante', 3003, '965655655');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ofertas`
--

CREATE TABLE `ofertas` (
  `oferta_id` int(11) NOT NULL,
  `oferta_nombre` varchar(50) NOT NULL,
  `oferta_descuento` decimal(30,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `ofertas`
--

INSERT INTO `ofertas` (`oferta_id`, `oferta_nombre`, `oferta_descuento`) VALUES
(1, 's/d', 0.00),
(2, 'flash', 25.00),
(3, '2xUNO', 50.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `producto_id` int(11) NOT NULL,
  `producto_codigo` varchar(70) NOT NULL,
  `producto_nombre` varchar(70) NOT NULL,
  `descripcion` varchar(250) DEFAULT 'caracteristicas del producto....',
  `producto_precio` decimal(30,2) NOT NULL DEFAULT 0.00,
  `producto_stock` int(11) NOT NULL,
  `producto_foto` varchar(500) NOT NULL,
  `categoria_id` int(11) NOT NULL DEFAULT 1,
  `usuario_id` int(11) NOT NULL,
  `oferta_id` int(11) NOT NULL DEFAULT 1,
  `sexo_id` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`producto_id`, `producto_codigo`, `producto_nombre`, `descripcion`, `producto_precio`, `producto_stock`, `producto_foto`, `categoria_id`, `usuario_id`, `oferta_id`, `sexo_id`) VALUES
(36, 'jug454', 'Batman', 'caracteristicas del producto....', 43.00, 8, 'Batman_581.jpg', 1, 1, 1, 1),
(37, 'anim565', 'Titere', 'caracteristicas del producto....', 54.00, 1, 'Titere_409.jpg', 3, 1, 1, 1),
(39, 'lib544', 'El Principito', 'caracteristicas del producto....', 34.00, 35, 'El_Principito_881.jpg', 2, 1, 1, 1),
(40, 'anim533', 'Soledad', 'caracteristicas del producto....', 36.00, 2, 'Soledad_67.jpg', 3, 1, 1, 1),
(41, 'anim277', 'Candy', 'caracteristicas del producto....', 73.00, 2, 'Candy_475.jpg', 3, 1, 1, 1),
(42, 'anim299', 'Trilce', 'caracteristicas del producto....', 39.00, 2, 'Trilce_203.jpg', 3, 1, 1, 1),
(43, 'anim989', 'Group', 'caracteristicas del producto....', 73.00, 1, 'Group_595.jpg', 3, 1, 1, 1),
(44, 'jug334', 'stick', 'caracteristicas del producto....', 24.00, 4, 'stick_437.jpg', 1, 1, 1, 1),
(45, 'jug339', 'Capi', 'caracteristicas del producto....', 32.00, 1, 'Capi_291.jpg', 1, 1, 1, 1),
(46, 'jug444', 'celebro', 'caracteristicas del producto....', 31.00, 4, 'celebro_307.jpg', 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `rol_id` int(11) NOT NULL,
  `rol` varchar(30) NOT NULL DEFAULT 'cliente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`rol_id`, `rol`) VALUES
(1, 'Administrador'),
(2, 'Colaborador'),
(3, 'Cliente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sexos`
--

CREATE TABLE `sexos` (
  `sexo_id` int(11) NOT NULL,
  `sexo` varchar(30) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `sexos`
--

INSERT INTO `sexos` (`sexo_id`, `sexo`) VALUES
(1, 'Hombre'),
(2, 'Mujer');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `usuario_id` int(11) NOT NULL,
  `usuario_nombre` varchar(40) DEFAULT NULL,
  `usuario_apellido` varchar(40) DEFAULT NULL,
  `usuario_usuario` varchar(255) NOT NULL DEFAULT 'username',
  `usuario_clave` varchar(255) NOT NULL,
  `usuario_email` varchar(100) NOT NULL,
  `rol_id` int(3) NOT NULL DEFAULT 3,
  `sexo_id` int(11) DEFAULT 1,
  `contacto_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`usuario_id`, `usuario_nombre`, `usuario_apellido`, `usuario_usuario`, `usuario_clave`, `usuario_email`, `rol_id`, `sexo_id`, `contacto_id`) VALUES
(1, 'Administrador', 'Principal', 'admin666AD', '$2y$10$mmdo0EQa8mjvc1zqYwApSebFCl8tzPAX61b0N4mfKX1y2X2q63V1e', 'admin@gmail.com', 1, 1, 1),
(2, 'juan', 'palomo', 'juan456JP', '$2y$10$XwFYiD6.sMKYJH4F6dglv.NA22RHY.wCrYFYgooEWS5nTI.fyroJ6', 'juan@gmail.com', 2, 2, 1),
(3, 'roger', 'hurtado', 'roger123RH', '$2y$10$.ZOadHf0m5nqYREGvT4Dge4UxqRHw/uZpS4s0BTfOoh1OakQeZxhK', 'roger@gmail.com', 3, 1, NULL),
(116, 'perico', 'leon', 'perico987', '$2y$10$txD2faIK9nSo5qZxv6AOQ./7cgd4jQ9sdFhMrtcYh8r.dW.2wkjDq', 'perico@gmail.com', 3, 1, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`categoria_id`);

--
-- Indices de la tabla `cesta`
--
ALTER TABLE `cesta`
  ADD PRIMARY KEY (`cesta_id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `producto_id` (`producto_id`);

--
-- Indices de la tabla `contactos`
--
ALTER TABLE `contactos`
  ADD PRIMARY KEY (`contacto_id`);

--
-- Indices de la tabla `ofertas`
--
ALTER TABLE `ofertas`
  ADD PRIMARY KEY (`oferta_id`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`producto_id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `categoria_id` (`categoria_id`),
  ADD KEY `oferta_id` (`oferta_id`),
  ADD KEY `sexo_id` (`sexo_id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`rol_id`);

--
-- Indices de la tabla `sexos`
--
ALTER TABLE `sexos`
  ADD PRIMARY KEY (`sexo_id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usuario_id`),
  ADD KEY `rol_id` (`rol_id`),
  ADD KEY `sexo_id` (`sexo_id`),
  ADD KEY `contacto_id` (`contacto_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `categoria_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `cesta`
--
ALTER TABLE `cesta`
  MODIFY `cesta_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `contactos`
--
ALTER TABLE `contactos`
  MODIFY `contacto_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `ofertas`
--
ALTER TABLE `ofertas`
  MODIFY `oferta_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `producto_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `rol_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `sexos`
--
ALTER TABLE `sexos`
  MODIFY `sexo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usuario_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cesta`
--
ALTER TABLE `cesta`
  ADD CONSTRAINT `cesta_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`usuario_id`),
  ADD CONSTRAINT `cesta_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`producto_id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`usuario_id`),
  ADD CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`categoria_id`),
  ADD CONSTRAINT `producto_ibfk_3` FOREIGN KEY (`oferta_id`) REFERENCES `ofertas` (`oferta_id`),
  ADD CONSTRAINT `producto_ibfk_4` FOREIGN KEY (`sexo_id`) REFERENCES `sexos` (`sexo_id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`rol_id`),
  ADD CONSTRAINT `usuario_ibfk_2` FOREIGN KEY (`sexo_id`) REFERENCES `sexos` (`sexo_id`),
  ADD CONSTRAINT `usuario_ibfk_3` FOREIGN KEY (`contacto_id`) REFERENCES `contactos` (`contacto_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;