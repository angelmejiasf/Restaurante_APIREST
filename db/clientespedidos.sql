-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-02-2024 a las 12:40:07
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `clientespedidos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `IDCLIENTE` int(11) NOT NULL,
  `NOMBRE` varchar(30) DEFAULT NULL,
  `LOCALIDAD` varchar(30) DEFAULT NULL,
  `PAIS` varchar(30) DEFAULT NULL,
  `TELEFONO` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`IDCLIENTE`, `NOMBRE`, `LOCALIDAD`, `PAIS`, `TELEFONO`) VALUES
(1, 'LUIS MIGUEL MORALES SANCHEZ', 'Almeria', 'ESPAÑA', '925666777'),
(2, 'RAQUEL GARRIDO SANZ', 'Toledo', 'ESPAÑA', '12345698'),
(3, 'CESSARE LANFALONI', 'Madrid', 'ESPAÑA', '91123456'),
(4, 'MATHEO CORLEONE', 'Roma', 'ITALIA', '4356667770'),
(5, 'WILIAN STEWART', 'Londres', 'INGLATERRA', '44925666777'),
(6, 'DAVID HUTTON', 'Liverpool', 'INGLATERRA', '4435666077'),
(7, 'ALEJANDRO MARTOS', 'Madrid.', 'ESPAÑA', '91229988'),
(8, 'PEDRO SULIVAN', 'Guadalajara', 'ESPAÑA', '949444000'),
(9, 'MARIA TENAILLE', 'Milán', 'ITALIA', '439089876'),
(10, 'JUANDE SOUSA', 'Lisboa', 'PORTUGAL', '330089876'),
(11, 'MARÍA JIMÉNEZ SULIVAN', 'OPORTO', 'PORTUGAL', '3380089876'),
(12, 'ANTONIO CAMACHO', 'Barcelona', 'ESPAÑA', '925888777'),
(13, 'MARY SMIT', 'Londres', 'INGLATERRA', '446677880');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menus`
--

CREATE TABLE `menus` (
  `IDMENU` int(11) NOT NULL,
  `NOMBRE` varchar(20) NOT NULL,
  `DESCRIPCION` varchar(80) DEFAULT NULL,
  `PVP` float DEFAULT NULL,
  `FECHACREACION` date DEFAULT NULL,
  `TIPO` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `menus`
--

INSERT INTO `menus` (`IDMENU`, `NOMBRE`, `DESCRIPCION`, `PVP`, `FECHACREACION`, `TIPO`) VALUES
(1, 'Desayuno Saludable1', '', 7, '2020-09-01', 'Desayuno'),
(2, 'Continental', '', 5, '2020-09-01', 'Desayuno'),
(3, 'Desayuno completo', '', 6, '2020-09-01', 'Desayuno'),
(4, 'Lunch para reponer', '', 12, '2020-09-02', 'Lunch'),
(5, 'Comida casera 1', '', 10, '2020-09-02', 'Lunch'),
(6, 'Vegano 1 variado', '', 12, '2020-09-02', 'Lunch'),
(7, 'Menú tipo Vegano 2', '', 13, '2020-09-02', 'Lunch'),
(8, 'Menú variado 1', '', 8, '2020-09-02', 'Lunch'),
(9, 'Chips and Chicken', '', 15, '2020-09-02', 'Lunch'),
(10, 'Comida para todos 2', '', 13, '2020-09-02', 'Lunch'),
(11, 'Comida casera 2', '', 10, '2020-09-02', 'Lunch');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidosmenus`
--

CREATE TABLE `pedidosmenus` (
  `IDPEDIDOMENU` int(11) NOT NULL,
  `IDCLIENTE` int(11) NOT NULL,
  `IDMENU` int(11) NOT NULL,
  `FECHAPEDIDO` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedidosmenus`
--

INSERT INTO `pedidosmenus` (`IDPEDIDOMENU`, `IDCLIENTE`, `IDMENU`, `FECHAPEDIDO`) VALUES
(1, 1, 1, '2020-11-02'),
(2, 1, 6, '2020-11-04'),
(3, 1, 7, '2020-11-15'),
(4, 2, 2, '2020-11-03'),
(5, 2, 7, '2020-11-09'),
(6, 2, 9, '2020-11-15'),
(7, 2, 10, '2020-11-25'),
(8, 2, 11, '2020-11-26'),
(9, 3, 2, '2020-11-09'),
(10, 3, 10, '2020-11-19'),
(11, 3, 4, '2020-11-21'),
(12, 3, 3, '2020-11-25'),
(13, 3, 6, '2020-11-30'),
(14, 3, 11, '2020-12-08'),
(15, 4, 3, '2020-12-19'),
(16, 4, 5, '2020-12-21'),
(17, 4, 9, '2020-12-28'),
(18, 5, 1, '2020-12-09'),
(19, 5, 3, '2020-12-19'),
(20, 5, 5, '2020-12-21'),
(21, 5, 9, '2020-12-28'),
(22, 6, 10, '2020-12-07'),
(23, 6, 11, '2020-12-10'),
(24, 7, 6, '2020-12-22'),
(25, 7, 7, '2020-12-28'),
(26, 7, 8, '2020-12-28'),
(27, 8, 6, '2020-11-22'),
(28, 8, 7, '2020-11-24'),
(29, 8, 8, '2020-12-12'),
(30, 9, 10, '2020-12-01'),
(31, 9, 11, '2020-12-10');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`IDCLIENTE`);

--
-- Indices de la tabla `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`IDMENU`),
  ADD UNIQUE KEY `NOMBRE` (`NOMBRE`);

--
-- Indices de la tabla `pedidosmenus`
--
ALTER TABLE `pedidosmenus`
  ADD PRIMARY KEY (`IDPEDIDOMENU`),
  ADD KEY `SYSC0018473` (`IDCLIENTE`),
  ADD KEY `SYSC0018477` (`IDMENU`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pedidosmenus`
--
ALTER TABLE `pedidosmenus`
  ADD CONSTRAINT `SYSC0018473` FOREIGN KEY (`IDCLIENTE`) REFERENCES `clientes` (`IDCLIENTE`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `SYSC0018477` FOREIGN KEY (`IDMENU`) REFERENCES `menus` (`IDMENU`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
