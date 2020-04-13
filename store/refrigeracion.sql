-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-04-2020 a las 22:51:13
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `refrigeracion`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `Id` int(11) NOT NULL,
  `Documento` int(11) NOT NULL,
  `Nombre` varchar(70) CHARACTER SET ucs2 COLLATE ucs2_spanish2_ci NOT NULL,
  `Edad` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `Telefono` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `Direccion` varchar(50) CHARACTER SET ucs2 COLLATE ucs2_spanish2_ci NOT NULL,
  `Correo` varchar(50) CHARACTER SET ucs2 COLLATE ucs2_spanish_ci NOT NULL,
  `Placa` varchar(10)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `Id` int(11) NOT NULL,
  `Cedula` int(11) NOT NULL,
  `Nombre` varchar(70) CHARACTER SET ucs2 COLLATE ucs2_spanish2_ci NOT NULL,
  `Apellido` varchar(50) CHARACTER SET ucs2 COLLATE ucs2_spanish2_ci NOT NULL,
  `Sueldo` int(11) NOT NULL,
  `Telefono` varchar(14) CHARACTER SET ucs2 COLLATE ucs2_spanish2_ci NOT NULL,
  `Cargo` varchar(50) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturacion`
--

CREATE TABLE `facturacion` (
  `Id` int(11) NOT NULL,
  `Codigo` varchar(11) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `Nombre_producto` varchar(100) CHARACTER SET ucs2 COLLATE ucs2_spanish2_ci DEFAULT NULL,
  `Cantidad` int(100) DEFAULT NULL,
  `Precio_producto` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `Precio_mantenimiento` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `Precio_reparacion` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `Precio_total` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `Fecha` datetime(6) NOT NULL,
  `Id_Clientes` int(10) NOT NULL,
  `Nombre_Cliente` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `Codigo_producto` varchar(10) NOT NULL,
  `Id_Empleados` int(10) NOT NULL,
  `Nombre _Empleados` int(50) NOT NULL,
  `Id_Servicios` int(10) NOT NULL,
  `Codigo_Servicios` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login`
--

CREATE TABLE `login` (
  `Id` int(11) NOT NULL,
  `User_name` varchar(50) CHARACTER SET ucs2 COLLATE ucs2_spanish2_ci NOT NULL,
  `Password` varchar(10) CHARACTER SET ucs2 COLLATE ucs2_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_vehiculos`
--

CREATE TABLE `productos_vehiculos` (
  `Codigo` varchar(10) NOT NULL,
  `Nombre_Producto` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `Marca` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `Valor_Producto` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro_vehiculos`
--

CREATE TABLE `registro_vehiculos` (
  `Id` int(10) NOT NULL,
  `Placa` varchar(10) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `Modelo` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `Fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `Id` int(11) NOT NULL,
  `Codigo` int(10) NOT NULL,
  `Mantenimiento` varchar(100) CHARACTER SET ucs2 COLLATE ucs2_spanish2_ci NOT NULL,
  `Reparacion` varchar(70) CHARACTER SET ucs2 COLLATE ucs2_spanish2_ci NOT NULL,
  `Venta_repuestos` varchar(70) CHARACTER SET ucs2 COLLATE ucs2_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Documento` (`Documento`),
  ADD KEY `Placa` (`Placa`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Nombre` (`Nombre`),
  ADD KEY `Cedula` (`Cedula`);

--
-- Indices de la tabla `facturacion`
--
ALTER TABLE `facturacion`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Id_Empleados` (`Id_Empleados`),
  ADD UNIQUE KEY `Codigo_Servicios` (`Codigo_Servicios`),
  ADD KEY `Codigo` (`Codigo`),
  ADD KEY `Id_Clientes` (`Id_Clientes`),
  ADD KEY `Codigo_producto` (`Codigo_producto`);

--
-- Indices de la tabla `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`Id`,`Password`),
  ADD KEY `User_name` (`User_name`);

--
-- Indices de la tabla `productos_vehiculos`
--
ALTER TABLE `productos_vehiculos`
  ADD PRIMARY KEY (`Codigo`);

--
-- Indices de la tabla `registro_vehiculos`
--
ALTER TABLE `registro_vehiculos`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Placa` (`Placa`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Codigo_Servicios` (`Codigo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `facturacion`
--
ALTER TABLE `facturacion`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `login`
--
ALTER TABLE `login`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `registro_vehiculos`
--
ALTER TABLE `registro_vehiculos`
  MODIFY `Id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `clientes_ibfk_1` FOREIGN KEY (`Placa`) REFERENCES `registro_vehiculos` (`Placa`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `facturacion`
--
ALTER TABLE `facturacion`
  ADD CONSTRAINT `facturacion_ibfk_1` FOREIGN KEY (`Id_Clientes`) REFERENCES `clientes` (`Id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `facturacion_ibfk_2` FOREIGN KEY (`Codigo_producto`) REFERENCES `productos_vehiculos` (`Codigo`) ON UPDATE CASCADE,
  ADD CONSTRAINT `facturacion_ibfk_3` FOREIGN KEY (`Id_Empleados`) REFERENCES `empleados` (`Id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `facturacion_ibfk_4` FOREIGN KEY (`Codigo_Servicios`) REFERENCES `servicios` (`Id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `login_ibfk_1` FOREIGN KEY (`Id`) REFERENCES `empleados` (`Id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

/*
--INSERT INTO clientes (Documento, Nombre, Edad, Telefono, Direccion, Correo, Placa) VALUES 
--      (123312, 'alexander duque', '36', '3043548394', 'calle 13 # 47-28', 'alexanderd@hotmail.com', 'CFR231K'),
--      (123750, 'andres felipe', '21', '3128299659', 'calle14# 41-36', 'felipe12@hotmail.com', 'VES254D'),
--      (587901, 'juan carlos luna', '48', '3127335675', 'cra 17 bis#25-18', 'juankl17@hotmail.com', 'KVA20B');

-- INSERT INTO empleados (Cedula, Nombre, Apellido, Sueldo, Telefono, Cargo) VALUES
--    (1143830484, 'yurani andrea', 'duque santa', 2000000, '3117717780', 'ingeniera de procesos y sistemas'),
--    (1057583923, 'jeinner herley', 'gomez escamilla', 2000000, '3143049585', 'ingeniero electrico y mecanico'),
--    (16788787, 'juan carlos', 'luna', 4000000, '3127335675', 'gerente general'),
--    (1143830134, 'oscar', 'velosa', 1250000, '3103930256', 'auxiliar tecnico');

-- INSERT INTO login (Id, User_name, Password) VALUES 
--    (1, 'yurani261', '12345678'),
--    (2, 'jeinner168', '12345678'),
--    (3, 'juanca961', '12345678'),
--    (4, 'oscar717', '12345678');
*/

