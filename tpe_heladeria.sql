-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-09-2023 a las 20:26:23
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
-- Base de datos: `tpe_heladeria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_producto`
--

CREATE TABLE `datos_producto` (
  `id` int(11) NOT NULL,
  `producto` varchar(255) NOT NULL,
  `categoria` varchar(255) NOT NULL,
  `precio` double NOT NULL,
  `cliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `datos_producto`
--

INSERT INTO `datos_producto` (`id`, `producto`, `categoria`, `precio`, `cliente`) VALUES
(1, 'helado', 'servido', 2999.99, 1),
(2, 'torta helada', 'postres', 4999.99, 2),
(3, 'helado', 'envasado', 2999.99, 3),
(4, 'cucurucho', 'otros', 499.99, 1),
(5, 'helado', 'envasado', 2999.99, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nombres`
--

CREATE TABLE `nombres` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(255) NOT NULL,
  `edad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `nombres`
--

INSERT INTO `nombres` (`id`, `nombre`, `apellido`, `edad`) VALUES
(1, 'Agustin', 'gutierrez', 21),
(2, 'Garfio', 'ramirez', 23),
(3, 'Luca', 'garcia', 22),
(4, 'Agustin', 'rebord', 23),
(5, 'Luca', 'fonseca', 34);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `datos_producto`
--
ALTER TABLE `datos_producto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cliente` (`cliente`);

--
-- Indices de la tabla `nombres`
--
ALTER TABLE `nombres`
  ADD PRIMARY KEY (`id`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `datos_producto`
--
ALTER TABLE `datos_producto`
  ADD CONSTRAINT `datos_producto_ibfk_1` FOREIGN KEY (`cliente`) REFERENCES `nombres` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
