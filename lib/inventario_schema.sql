-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 20-10-2023
-- Versión del servidor: apache toncat.
-- Versión de PHP: 8.0.10

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- MySQL Workbench Forward Engineering
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


-- -----------------------------------------------------
-- Schema inventario
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `inventario` ;

-- -----------------------------------------------------
-- Schema inventario
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `inventario` DEFAULT CHARACTER SET utf8mb4 ;
USE `inventario` ;
 
-- --------------------------------------------------------


-- -----------------------------------------------------
-- Table `inventario`.`roles`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `inventario`.`roles` ;

CREATE TABLE IF NOT EXISTS `inventario`.`roles`(
`rol_id` INT NOT NULL AUTO_INCREMENT,
`rol` VARCHAR(30) NOT NULL DEFAULT 'cliente',
PRIMARY KEY(`rol_id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Table `inventario`.`sexo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `inventario`.`sexos` ;

CREATE TABLE IF NOT EXISTS `inventario`.`sexos`(
`sexo_id` INT NOT NULL AUTO_INCREMENT,
`sexo` VARCHAR(30) NOT NULL DEFAULT '',
PRIMARY KEY(`sexo_id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Table `inventario`.`contactos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `inventario`.`contactos` ;

CREATE TABLE IF NOT EXISTS `inventario`.`contactos`(
`contacto_id` INT NOT NULL AUTO_INCREMENT,
`direccion` VARCHAR(100) NOT NULL DEFAULT '',
`provincia` VARCHAR(20) NULL DEFAULT 'Alicante',
`ciudad` VARCHAR(20) NULL DEFAULT 'San Juan',
`c.p.` INT(6) NULL DEFAULT '03000',
`telefono`  varchar(45) NULL DEFAULT 'telefono_autor',
PRIMARY KEY(`contacto_id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Estructura de tabla para la tabla `usuario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `inventario`.`usuario` ;

CREATE TABLE IF NOT EXISTS `inventario`.`usuario` (
  `usuario_id` INT NOT NULL AUTO_INCREMENT,
  `usuario_nombre` varchar(40) NOT NULL,
  `usuario_apellido` varchar(40) NOT NULL,
  `usuario_usuario` varchar(255) NOT NULL,
  `usuario_clave` varchar(255) NOT NULL,
  `usuario_email` varchar(100) NOT NULL,
  `rol_id` INT NOT NULL DEFAULT '10',
  `sexo_id` INT NOT NULL DEFAULT '1',
  `contacto_id` INT NOT NULL DEFAULT '2',
  PRIMARY KEY (`usuario_id`),
   CONSTRAINT FOREIGN KEY (`rol_id`)
    REFERENCES `inventario`.`roles` (`rol_id`),
    CONSTRAINT FOREIGN KEY (`sexo_id`)
    REFERENCES `inventario`.`sexos` (`sexo_id`),
    CONSTRAINT FOREIGN KEY (`contacto_id`)
    REFERENCES `inventario`.`contactos` (`contacto_id`)
    ON DELETE CASCADE
    ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Estructura de tabla para la tabla `categoria`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `inventario`.`categoria` ;

CREATE TABLE IF NOT EXISTS `inventario`.`categoria` (
  `categoria_id` INT NOT NULL AUTO_INCREMENT,
  `categoria_nombre` varchar(50) NOT NULL,
  `categoria_ubicacion` varchar(150) NOT NULL DEFAULT 'almacen',
  PRIMARY KEY (`categoria_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
-- --------------------------------------------------------

-- -----------------------------------------------------
-- Estructura de tabla para la tabla `ofertas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `inventario`.`ofertas` ;

CREATE TABLE IF NOT EXISTS `inventario`.`ofertas` (
  `oferta_id` INT NOT NULL AUTO_INCREMENT,
  `oferta_nombre` varchar(50) NOT NULL,
  `oferta_descuento` decimal(30,2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`oferta_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
-- --------------------------------------------------------

-- -----------------------------------------------------
-- Estructura de tabla para la tabla `producto`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `inventario`.`producto` ;

CREATE TABLE `inventario`.`producto` (
  `producto_id` INT NOT NULL AUTO_INCREMENT,
  `producto_codigo` varchar(70)  NOT NULL DEFAULT 'codigo de barras',
  `producto_nombre` varchar(70) NOT NULL,
  `descripcion` varchar(250) NOT NULL DEFAULT 'caracteristicas del producto....', 
  `producto_precio` decimal(30,2) NOT NULL DEFAULT '0',
  `producto_stock` int NOT NULL,
  `producto_foto` varchar(500)  NOT NULL,
  `categoria_id` int NOT NULL,
  `usuario_id` int NOT NULL,
  `oferta_id` INT NOT NULL,
  `sexo_id` INT NOT NULL,
  PRIMARY KEY (`producto_id`),
  CONSTRAINT FOREIGN KEY (`usuario_id`)
    REFERENCES `inventario`.`usuario` (`usuario_id`),
  CONSTRAINT FOREIGN KEY (`categoria_id`)
    REFERENCES `inventario`.`categoria` (`categoria_id`),
   CONSTRAINT FOREIGN KEY (`oferta_id`)
    REFERENCES `inventario`.`ofertas` (`oferta_id`),
   CONSTRAINT FOREIGN KEY (`sexo_id`)
    REFERENCES `inventario`.`sexos` (`sexo_id`)
    ON DELETE CASCADE
    ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

-- -----------------------------------------------------
-- Table `bd_portal_web`.`cesta`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `inventario`.`cesta` ;

CREATE TABLE IF NOT EXISTS `inventario`.`cesta` (
  `cesta_id` INT NOT NULL AUTO_INCREMENT,
  `usuario_id` INT NOT NULL,
  `producto_id` INT NOT NULL,
  `unidades` INT NOT NULL DEFAULT '0',
  `precio_parcial` decimal(30,2) NOT NULL DEFAULT '0',
  `precio_total` decimal(30,2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`cesta_id`),
  CONSTRAINT FOREIGN KEY (`usuario_id`)
    REFERENCES `inventario`.`usuario` (`usuario_id`),
  CONSTRAINT FOREIGN KEY (`producto_id`)
    REFERENCES `inventario`.`producto` (`producto_id`)
    ON DELETE CASCADE
    ON UPDATE RESTRICT
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Volcado de datos para la tabla `roles`
-- -----------------------------------------------------
INSERT INTO `roles`(`rol_id`, `rol`) VALUES (1, 'Administrador');
INSERT INTO `roles`(`rol_id`, `rol`) VALUES (2, 'Colaborador');
INSERT INTO `roles`(`rol_id`, `rol`) VALUES (10, 'Cliente');

-- -----------------------------------------------------
-- Volcado de datos para la tabla `sexos`
-- -----------------------------------------------------
INSERT INTO `sexos`(`sexo_id`, `sexo`) VALUES (1, 'Hombre');
INSERT INTO `sexos`(`sexo_id`, `sexo`) VALUES (2, 'Mujer');

-- -----------------------------------------------------
-- Volcado de datos para la tabla `contactos`
-- -----------------------------------------------------
INSERT INTO `contactos`(`contacto_id`, `direccion`, `provincia`, `ciudad`, `c.p.`, `telefono`) VALUES (1, 'Poligono Industrial', 'Alicante', 'Alicante', 03003, 965655655);
INSERT INTO `contactos`(`contacto_id`, `direccion`, `provincia`, `ciudad`, `c.p.`, `telefono`) VALUES (2, 'C. Los Geraneos Nº56', 'Alicante', 'Elche', 03045, 965123123);


-- -----------------------------------------------------
-- Volcado de datos para la tabla `usuario`
-- -----------------------------------------------------

INSERT INTO `usuario` (`usuario_id`, `usuario_nombre`, `usuario_apellido`, `usuario_usuario`, `usuario_clave`, `usuario_email`, `rol_id`, `sexo_id`, `contacto_id`) VALUES
(1, 'Administrador', 'Principal', 'Administrador', '$2y$10$EPY9LSLOFLDDBriuJICmFOqmZdnDXxLJG8YFbog5LcExp77DBQvgC', 'admin@gmail.com', 1, 1, 1);

 INSERT INTO `usuario` (`usuario_id`, `usuario_nombre`, `usuario_apellido`, `usuario_usuario`, `usuario_clave`, `usuario_email`, `rol_id`, `sexo_id`, `contacto_id`) VALUES 
(2, 'juan', 'Palomo', 'juan456', '$2y$10$QRfp7Hgdv.YjMZ28nU2itur6lnGJ/Ve9ri1bcP5JFpGK8eCSQE/cC', 'juan@gmail.com', '2', '1', '1');



-- -----------------------------------------------------
-- Volcado de datos para la tabla `categoria`
-- -----------------------------------------------------
INSERT INTO `categoria`(`categoria_id`, `categoria_nombre`, `categoria_ubicacion`) VALUES (1, 'Anime', 'q9');
INSERT INTO `categoria`(`categoria_id`, `categoria_nombre`, `categoria_ubicacion`) VALUES (2, 'Libros', 'd7');
INSERT INTO `categoria`(`categoria_id`, `categoria_nombre`, `categoria_ubicacion`) VALUES (3, 'Juguetes', 'e8');
INSERT INTO `categoria`(`categoria_id`, `categoria_nombre`, `categoria_ubicacion`) VALUES (4, 'Ropa', 'w3');
-- -----------------------------------------------------
-- Volcado de datos para la tabla `ofertas`
-- -----------------------------------------------------
INSERT INTO `ofertas`(`oferta_id`, `oferta_nombre`, `oferta_descuento`) VALUES (1, 's/d', '0');
INSERT INTO `ofertas`(`oferta_id`, `oferta_nombre`, `oferta_descuento`) VALUES (2, 'flash', '0.25');
INSERT INTO `ofertas`(`oferta_id`, `oferta_nombre`, `oferta_descuento`) VALUES (3, '2xUNO', '0.5');


-- -----------------------------------------------------
-- Volcado de datos para la tabla `producto`
-- -----------------------------------------------------
INSERT INTO `producto`(`producto_id`, `producto_codigo`, `producto_nombre`, `descripcion`, `producto_precio`, `producto_stock`, `producto_foto`, `categoria_id`, `usuario_id`, `oferta_id`, `sexo_id`) VALUES
(1, 'anim01', 'Kanizachi', 'un regalo el cielo', 79.99, 1, 'poster01', 1, 1, 1, 2);
INSERT INTO `producto`(`producto_id`, `producto_codigo`, `producto_nombre`, `descripcion`, `producto_precio`, `producto_stock`, `producto_foto`, `categoria_id`, `usuario_id`, `oferta_id`, `sexo_id`) VALUES 
(2, 'anim02', 'Vaille', 'una solucion inesperada', 67.9, 1, 'poster02', 1, 1, 1, 2);
INSERT INTO `producto`(`producto_id`, `producto_codigo`, `producto_nombre`, `descripcion`, `producto_precio`, `producto_stock`, `producto_foto`, `categoria_id`, `usuario_id`, `oferta_id`, `sexo_id`) VALUES
(3, 'anim03', 'Motosam', 'nadie sabe parar', 39.99, 1, 'poster03', 1, 1, 1, 2);

		
-- -----------------------------------------------------
-- Volcado de datos para la tabla `cestas`
-- -----------------------------------------------------








SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';
