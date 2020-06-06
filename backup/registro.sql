-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-01-2019 a las 12:56:50
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
-- Base de datos: `registro`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ofertas`
--

CREATE TABLE `ofertas` (
  `Producto` text COLLATE utf8_spanish_ci NOT NULL,
  `Cantidad` text COLLATE utf8_spanish_ci NOT NULL,
  `Descuento` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ofertas`
--

INSERT INTO `ofertas` (`Producto`, `Cantidad`, `Descuento`) VALUES
('P20180806184548', '4', '50'),
('P20180806184514', '4', '50');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `ID` text COLLATE utf8_spanish_ci NOT NULL,
  `usuario` text COLLATE utf8_spanish_ci NOT NULL,
  `producto` text COLLATE utf8_spanish_ci NOT NULL,
  `direccion` text COLLATE utf8_spanish_ci NOT NULL,
  `anotaciones` text COLLATE utf8_spanish_ci NOT NULL,
  `estado` int(11) NOT NULL,
  `seguimiento` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`ID`, `usuario`, `producto`, `direccion`, `anotaciones`, `estado`, `seguimiento`) VALUES
('V20180824185649', 'U20180814122117', 'P20180806184548x1x1x8x4|P20180806184514x1x1x2x1|P20180806184440x10x2x4x10', 'EspaÃ±a|Huelva|Huelva|21003|Avda. Guatemala|huelva', '', 2, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `ID` text COLLATE utf8_spanish_ci NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  `categoria` text COLLATE utf8_spanish_ci NOT NULL,
  `precio` text COLLATE utf8_spanish_ci NOT NULL,
  `existencias` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`ID`, `nombre`, `descripcion`, `categoria`, `precio`, `existencias`) VALUES
('P20180806184440', 'Gamboides', 'La gamba aberronchada', 'Gambas', '4', '25'),
('P20180806184514', 'Gambonideos', 'La gamba blanca de florida', 'Gambas', '2', '25'),
('P20180806184548', 'Cigalcico', 'La cigala del mar aberroncho', 'Cigala', '8', '25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sesiones`
--

CREATE TABLE `sesiones` (
  `sesion` text COLLATE utf8_spanish_ci NOT NULL,
  `usuario` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `sesiones`
--

INSERT INTO `sesiones` (`sesion`, `usuario`) VALUES
('S20180805120013', 'U20180805115844'),
('S20180805161525', 'U20180805115844'),
('S20180805175401', 'U20180805115844'),
('S20180809142210', 'U20180805115844'),
('S20180809170617', 'U20180805115844'),
('S20180809170649', 'U20180805115844'),
('S20180809171836', 'U20180805115844'),
('S20180809173252', 'U20180809173242'),
('S20180809173519', 'U20180809173512'),
('S20180812180536', 'U20180809173512'),
('S20180812181008', 'U20180809173512'),
('S20180812181128', 'U20180809173512'),
('S20180812181210', 'U20180809173512'),
('S20180812181243', 'U20180809173512'),
('S20180812181323', 'U20180809173512'),
('S20180814081955', 'U20180809173512'),
('S20180814123033', 'U20180814122117'),
('S20180816101217', 'U20180814122117'),
('S20180816111208', 'U20180816111200'),
('S20180816120725', 'U20180816111200'),
('S20180816185356', 'U20180816111200'),
('S20180816185628', 'U20180814122117'),
('S20180816190026', 'U20180816111200'),
('S20180816190616', 'U20180814122117'),
('S20180816204328', 'U20180816204310'),
('S20180816222407', 'U20180816204310'),
('S20180820163836', 'U20180814122117'),
('S20180824162844', 'U20180814122117'),
('S20180824162913', 'U20180814122117');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `ID` text COLLATE utf8_spanish_ci NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `apellido` text COLLATE utf8_spanish_ci NOT NULL,
  `email` text COLLATE utf8_spanish_ci NOT NULL,
  `hash` text COLLATE utf8_spanish_ci NOT NULL,
  `empresa` text COLLATE utf8_spanish_ci NOT NULL,
  `direccion` text COLLATE utf8_spanish_ci NOT NULL,
  `cesta` text COLLATE utf8_spanish_ci NOT NULL,
  `telefono` text COLLATE utf8_spanish_ci NOT NULL,
  `dni` text COLLATE utf8_spanish_ci NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`ID`, `nombre`, `apellido`, `email`, `hash`, `empresa`, `direccion`, `cesta`, `telefono`, `dni`, `estado`) VALUES
('U20180816204310', 'Borja_Live', 'pineda', 'borjainlive@gmail.com', '65a99bb7a3115fdede20da98b08a370f', 'NAN', 'EspaÃ±a|Huelva|Huelva|21003|Avda. Guatemala|huelva', '', '638708459', '49279661E', 2),
('U20180814122117', 'Borja', 'Live', 'viewer', '', 'Liveployers', 'EspaÃ±a|Huelva|Huelva|21003|Avda. Guatemala|huelva', '', '690182845', '49279661E', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vars`
--

CREATE TABLE `vars` (
  `clave` text COLLATE utf8_spanish_ci NOT NULL,
  `valor` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `vars`
--

INSERT INTO `vars` (`clave`, `valor`) VALUES
('escaparate2', 'P20180806184514'),
('escaparate3', 'P20180806184440'),
('escaparate1', 'P20180806184548'),
('escaparate4', 'P20180806184548'),
('V20180806184913', '15'),
('V20180814164434', ''),
('V20180814164604', ''),
('costeEnvio', '15'),
('costeCocedura', '1.5'),
('V20180815105759', '10'),
('V20180816084102', '15'),
('V20180816190735', ''),
('V20180816211245', ''),
('V20180816222450', ''),
('cesta', '1'),
('V20180824182107', ''),
('V20180824181437', ''),
('V20180824183513', ''),
('V20180824184252', ''),
('V20180824184959', ''),
('V20180824185649', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
