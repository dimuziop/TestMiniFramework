-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-03-2018 a las 01:34:48
-- Versión del servidor: 10.1.26-MariaDB
-- Versión de PHP: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `testapidatabase`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `item_id` int(11) NOT NULL,
  `item_name` varchar(100) DEFAULT NULL,
  `item_description` longtext,
  `item_size` varchar(255) DEFAULT NULL,
  `item_cost` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`item_id`, `item_name`, `item_description`, `item_size`, `item_cost`) VALUES
(3, 'test item 1', 'Description oh tje first item', '120*60', 560),
(4, 'item 2', 'Description oh tje second item', '250*6', 1200),
(5, 'te', 'tesdt item 4', '125*9', 1260),
(6, 'test', 'tesdt item 4', '125*9', 1260),
(7, 'test', 'tesdt item 4', '125*9', 1260),
(8, 'test', 'tesdt item 4', '125*9', 1260),
(9, 'test', 'tesdt item 4', '125*9', 1260),
(10, 'test', 'tesdt item 4', '125*9', 1260),
(11, 'test', 'tesdt item 4', '125*9', 1260),
(12, 'test', 'tesdt item 4', '125*9', 1260),
(13, 'test', 'tesdt item 4', '125*9', 1260),
(14, 'test', 'tesdt item 4', '125*9', 1260),
(15, 'test', 'tesdt item 4', '125*9', 1260),
(16, 'test', 'tesdt item 4', '125*9', 1260),
(17, 'te', 'tesdt item 4', '125*9', 1260),
(18, 'te', 'tesdt item 4', '125*9', 1260);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`item_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
