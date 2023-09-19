-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-09-2023 a las 22:00:26
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
  `producto` text NOT NULL,
  `categoria` text NOT NULL,
  `precio` double NOT NULL,
  `nombre` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `datos_producto`
--

INSERT INTO `datos_producto` (`id`, `producto`, `categoria`, `precio`, `nombre`) VALUES
(1, 'helado', 'servido', 2999.99, 'Agustin'),
(2, 'torta helada', 'postres', 4999.99, 'Garfio'),
(3, 'helado', 'envasado', 2999.99, 'Luca'),
(4, 'cucurucho', 'otros', 499.99, 'Agustin'),
(5, 'helado', 'envasado', 2999.99, 'Luca');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `datos_producto`
--
ALTER TABLE `datos_producto`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `datos_producto`
--
ALTER TABLE `datos_producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
