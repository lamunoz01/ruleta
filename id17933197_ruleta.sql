-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 14-11-2021 a las 17:52:29
-- Versión del servidor: 10.5.12-MariaDB
-- Versión de PHP: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `id17933197_ruleta`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `apuestas`
--

CREATE TABLE `apuestas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ronda` int(11) NOT NULL,
  `jugador` int(11) NOT NULL,
  `numero_apuesta` int(11) NOT NULL,
  `valor_apuesta` double(10,2) NOT NULL,
  `resultado` double(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jugadores`
--

CREATE TABLE `jugadores` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellido` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `identificacion` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `saldo` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `jugadores`
--

INSERT INTO `jugadores` (`id`, `nombre`, `apellido`, `identificacion`, `saldo`) VALUES
(3, 'Laura', 'Ahumada', '54645654', 15000.00),
(5, 'Pepito', 'Perez', '3454353', 78954.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `numeros`
--

CREATE TABLE `numeros` (
  `numero` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(7) COLLATE utf8mb4_unicode_ci NOT NULL,
  `orden` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `numeros`
--

INSERT INTO `numeros` (`numero`, `color`, `orden`) VALUES
('0', '#00ff00', 0),
('1', '#FF0000', 12),
('10', '#000000', 3),
('11', '#000000', 15),
('12', '#FF0000', 27),
('13', '#000000', 4),
('14', '#FF0000', 16),
('15', '#000000', 28),
('16', '#FF0000', 5),
('17', '#000000', 17),
('18', '#FF0000', 29),
('19', '#FF0000', 6),
('2', '#000000', 24),
('20', '#000000', 18),
('21', '#FF0000', 30),
('22', '#000000', 7),
('23', '#FF0000', 19),
('24', '#000000', 31),
('25', '#FF0000', 8),
('26', '#000000', 20),
('27', '#FF0000', 32),
('28', '#000000', 9),
('29', '#000000', 21),
('3', '#FF0000', 36),
('30', '#FF0000', 33),
('31', '#000000', 10),
('32', '#FF0000', 22),
('33', '#000000', 34),
('34', '#FF0000', 11),
('35', '#000000', 23),
('36', '#FF0000', 35),
('4', '#000000', 1),
('5', '#FF0000', 13),
('6', '#000000', 25),
('7', '#FF0000', 2),
('8', '#000000', 14),
('9', '#FF0000', 26);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rondas`
--

CREATE TABLE `rondas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `resultado` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `rondas`
--

INSERT INTO `rondas` (`id`, `resultado`) VALUES
(1, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `apuestas`
--
ALTER TABLE `apuestas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `jugadores`
--
ALTER TABLE `jugadores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `numeros`
--
ALTER TABLE `numeros`
  ADD PRIMARY KEY (`numero`);

--
-- Indices de la tabla `rondas`
--
ALTER TABLE `rondas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `apuestas`
--
ALTER TABLE `apuestas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `jugadores`
--
ALTER TABLE `jugadores`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `rondas`
--
ALTER TABLE `rondas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
