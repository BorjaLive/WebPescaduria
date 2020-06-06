-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-01-2019 a las 12:56:38
-- Versión del servidor: 10.1.32-MariaDB
-- Versión de PHP: 5.6.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `trazabilidad`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `Nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `Direccion` text COLLATE utf8_spanish_ci NOT NULL,
  `Poblacion` text COLLATE utf8_spanish_ci NOT NULL,
  `DNI` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`Nombre`, `Direccion`, `Poblacion`, `DNI`) VALUES
('Restaurante micolor S.L', 'C. Alfonso XIII', 'Huelva', '49289661E'),
('Demigrantes C.L', 'Avd. Guatemala', 'Jibraleon', '1233333333A'),
('Puta made S.L.', 'Mi culo', 'El infierno', 'nopeE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entradas`
--

CREATE TABLE `entradas` (
  `ID` text COLLATE utf8_spanish_ci NOT NULL,
  `Fecha` text COLLATE utf8_spanish_ci NOT NULL,
  `Genero` text COLLATE utf8_spanish_ci NOT NULL,
  `Kg` text COLLATE utf8_spanish_ci NOT NULL,
  `Escandallo` text COLLATE utf8_spanish_ci NOT NULL,
  `Proveedor` text COLLATE utf8_spanish_ci NOT NULL,
  `Barco` text COLLATE utf8_spanish_ci NOT NULL,
  `Marea` text COLLATE utf8_spanish_ci NOT NULL,
  `Envase` text COLLATE utf8_spanish_ci NOT NULL,
  `Etiquetado` text COLLATE utf8_spanish_ci NOT NULL,
  `Caducidad` text COLLATE utf8_spanish_ci NOT NULL,
  `Aspecto` text COLLATE utf8_spanish_ci NOT NULL,
  `Temperatura` text COLLATE utf8_spanish_ci NOT NULL,
  `Restante` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `entradas`
--

INSERT INTO `entradas` (`ID`, `Fecha`, `Genero`, `Kg`, `Escandallo`, `Proveedor`, `Barco`, `Marea`, `Envase`, `Etiquetado`, `Caducidad`, `Aspecto`, `Temperatura`, `Restante`) VALUES
('18_400', '23/08/18', 'Rabonizecus', '50', '90-100', 'Mariscolastico', 'Mariscal 4', '1/19', 'Plastico', 'Decente', 'Un aÃ±o', 'B', '-18', '35'),
('18_200', '08/22/18', 'Abaliensis', '25', '80-90', 'Dimarosa', 'Voyager', '4/18', 'Plastico', 'Decente', 'Un aÃ±o', 'B', '-20', '15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas`
--

CREATE TABLE `facturas` (
  `ID` text COLLATE utf8_spanish_ci NOT NULL,
  `Fecha` text COLLATE utf8_spanish_ci NOT NULL,
  `Nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `Direccion` text COLLATE utf8_spanish_ci NOT NULL,
  `Poblacion` text COLLATE utf8_spanish_ci NOT NULL,
  `DNI` text COLLATE utf8_spanish_ci NOT NULL,
  `Productos` text COLLATE utf8_spanish_ci NOT NULL,
  `Suma` text COLLATE utf8_spanish_ci NOT NULL,
  `IVA` text COLLATE utf8_spanish_ci NOT NULL,
  `RE` text COLLATE utf8_spanish_ci NOT NULL,
  `Total` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `Nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `Barcos` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`Nombre`, `Barcos`) VALUES
('Mariscolastico', 'Mariscal 3|Mariscal 2|Mariscal 1|Mariscal 4'),
('Dimarosa', 'Venera 7|Voyager'),
('gambas 58', 'Mariscal 3|Borja Live|B0vEren');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salidas`
--

CREATE TABLE `salidas` (
  `Entrada` text COLLATE utf8_spanish_ci NOT NULL,
  `Fecha` text COLLATE utf8_spanish_ci NOT NULL,
  `Genero` text COLLATE utf8_spanish_ci NOT NULL,
  `Escandallo` text COLLATE utf8_spanish_ci NOT NULL,
  `Kg` text COLLATE utf8_spanish_ci NOT NULL,
  `Proveedor` text COLLATE utf8_spanish_ci NOT NULL,
  `Barco` text COLLATE utf8_spanish_ci NOT NULL,
  `Marea` text COLLATE utf8_spanish_ci NOT NULL,
  `ID` text COLLATE utf8_spanish_ci NOT NULL,
  `Envase` text COLLATE utf8_spanish_ci NOT NULL,
  `Etiquetado` text COLLATE utf8_spanish_ci NOT NULL,
  `Caducidad` text COLLATE utf8_spanish_ci NOT NULL,
  `Aspecto` text COLLATE utf8_spanish_ci NOT NULL,
  `Temperatura` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ultimos`
--

CREATE TABLE `ultimos` (
  `tipo` text COLLATE utf8_spanish_ci NOT NULL,
  `ultimo` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ultimos`
--

INSERT INTO `ultimos` (`tipo`, `ultimo`) VALUES
('', ''),
('entrada', '18_418'),
('salida', '18_026'),
('factura', '18_007');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
