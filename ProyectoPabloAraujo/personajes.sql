-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-01-2024 a las 09:06:33
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
-- Base de datos: `proyecto_pablo_araujo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personajes`
--

CREATE TABLE `personajes` (
  `nombre` varchar(30) NOT NULL,
  `elemento` enum('Fuego','Hielo','Viento','Imaginario','Cuantico','Fisico','Rayo') NOT NULL,
  `via` enum('Destruccion','Erudicion','Caceria','Abundancia','Armonia','Nihilidad','Conservacion') NOT NULL,
  `imagen` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `personajes`
--

INSERT INTO `personajes` (`nombre`, `elemento`, `via`, `imagen`) VALUES
('Asta', 'Fuego', 'Armonia', 'asta.jpg'),
('Blade', 'Viento', 'Destruccion', 'blade.jpg'),
('Himeko', 'Fuego', 'Erudicion', 'himeko.jpg'),
('Kafka', 'Rayo', 'Nihilidad', 'kafka.jpg'),
('Luocha', 'Imaginario', 'Abundancia', 'luocha.jpg'),
('Silver Wolf', 'Cuantico', 'Nihilidad', '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `personajes`
--
ALTER TABLE `personajes`
  ADD PRIMARY KEY (`nombre`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
