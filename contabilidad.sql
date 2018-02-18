-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-02-2018 a las 05:14:41
-- Versión del servidor: 10.1.25-MariaDB
-- Versión de PHP: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `contabilidad3`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `agenciastrans`
--

CREATE TABLE `agenciastrans` (
  `codtrans` varchar(8) COLLATE utf8_bin NOT NULL,
  `nombre` varchar(50) COLLATE utf8_bin NOT NULL,
  `telefono` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `web` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `activo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `agentes`
--

CREATE TABLE `agentes` (
  `apellidos` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `ciudad` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `codagente` varchar(10) COLLATE utf8_bin NOT NULL,
  `coddepartamento` varchar(6) COLLATE utf8_bin DEFAULT NULL,
  `codpais` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `codpostal` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `direccion` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `dnicif` varchar(15) COLLATE utf8_bin NOT NULL,
  `email` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `fax` varchar(15) COLLATE utf8_bin DEFAULT NULL,
  `idprovincia` int(11) DEFAULT NULL,
  `idusuario` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `irpf` double DEFAULT NULL,
  `nombre` varchar(50) COLLATE utf8_bin NOT NULL,
  `nombreap` varchar(150) COLLATE utf8_bin DEFAULT NULL,
  `porcomision` double DEFAULT NULL,
  `provincia` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `telefono` varchar(15) COLLATE utf8_bin DEFAULT NULL,
  `seg_social` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `cargo` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `banco` varchar(34) COLLATE utf8_bin DEFAULT NULL,
  `f_alta` date DEFAULT NULL,
  `f_baja` date DEFAULT NULL,
  `f_nacimiento` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `agentes`
--

INSERT INTO `agentes` (`apellidos`, `ciudad`, `codagente`, `coddepartamento`, `codpais`, `codpostal`, `direccion`, `dnicif`, `email`, `fax`, `idprovincia`, `idusuario`, `irpf`, `nombre`, `nombreap`, `porcomision`, `provincia`, `telefono`, `seg_social`, `cargo`, `banco`, `f_alta`, `f_baja`, `f_nacimiento`) VALUES
('Pepe', '', '1', NULL, NULL, '', '', '00000014Z', '', NULL, NULL, NULL, NULL, 'Paco', NULL, 0, '', '', '', '', '', NULL, '2018-02-09', NULL),
('Carreño Lucas', '', '2', NULL, NULL, '', '', '1316972577', 'casesa97@gmail.com', NULL, NULL, NULL, NULL, 'Sergio Saul', NULL, 0, 'Manabí', '0998130188', '', '', '', '2018-02-11', NULL, '2018-02-11'),
('Flores Cedeño', '', '3', NULL, NULL, '', '', '1306304435', 'stefany.flores1512@gmail.com', NULL, NULL, NULL, NULL, 'Ingrid Stefany', NULL, 0, '', '0999999999', '', '', '', '2018-02-11', NULL, '1997-12-15'),
('Aray Pico', '', '4', NULL, NULL, '', '', '1316360534', 'anthony@gmiau.com', NULL, NULL, NULL, NULL, 'Anthony Gabriel', NULL, 0, '', '0912381623', '', '', '', '2018-02-11', NULL, '2018-02-11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `albaranescli`
--

CREATE TABLE `albaranescli` (
  `apartado` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `cifnif` varchar(30) COLLATE utf8_bin NOT NULL,
  `ciudad` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `codagente` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `codalmacen` varchar(4) COLLATE utf8_bin DEFAULT NULL,
  `codcliente` varchar(6) COLLATE utf8_bin DEFAULT NULL,
  `coddir` int(11) DEFAULT NULL,
  `coddivisa` varchar(3) COLLATE utf8_bin NOT NULL,
  `codejercicio` varchar(4) COLLATE utf8_bin NOT NULL,
  `codigo` varchar(20) COLLATE utf8_bin NOT NULL,
  `codpago` varchar(10) COLLATE utf8_bin NOT NULL,
  `codpais` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `codpostal` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `codserie` varchar(2) COLLATE utf8_bin NOT NULL,
  `direccion` varchar(100) COLLATE utf8_bin NOT NULL,
  `fecha` date NOT NULL,
  `hora` time DEFAULT '00:00:00',
  `femail` date DEFAULT NULL,
  `idalbaran` int(11) NOT NULL,
  `idfactura` int(11) DEFAULT NULL,
  `idprovincia` int(11) DEFAULT NULL,
  `irpf` double NOT NULL DEFAULT '0',
  `netosindto` double NOT NULL DEFAULT '0',
  `neto` double NOT NULL DEFAULT '0',
  `nombrecliente` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `numero` varchar(12) COLLATE utf8_bin NOT NULL,
  `numero2` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `observaciones` text COLLATE utf8_bin,
  `porcomision` double DEFAULT NULL,
  `provincia` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `ptefactura` tinyint(1) NOT NULL DEFAULT '1',
  `recfinanciero` double NOT NULL DEFAULT '0',
  `tasaconv` double NOT NULL DEFAULT '1',
  `total` double NOT NULL DEFAULT '0',
  `totaleuros` double NOT NULL DEFAULT '0',
  `totalirpf` double NOT NULL DEFAULT '0',
  `totaliva` double NOT NULL DEFAULT '0',
  `totalrecargo` double NOT NULL DEFAULT '0',
  `codtrans` varchar(8) COLLATE utf8_bin DEFAULT NULL,
  `codigoenv` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `nombreenv` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `apellidosenv` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `direccionenv` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `codpostalenv` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `ciudadenv` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `provinciaenv` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `apartadoenv` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `codpaisenv` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `numdocs` int(11) DEFAULT '0',
  `dtopor1` double NOT NULL DEFAULT '0',
  `dtopor2` double NOT NULL DEFAULT '0',
  `dtopor3` double NOT NULL DEFAULT '0',
  `dtopor4` double NOT NULL DEFAULT '0',
  `dtopor5` double NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `albaranescli`
--

INSERT INTO `albaranescli` (`apartado`, `cifnif`, `ciudad`, `codagente`, `codalmacen`, `codcliente`, `coddir`, `coddivisa`, `codejercicio`, `codigo`, `codpago`, `codpais`, `codpostal`, `codserie`, `direccion`, `fecha`, `hora`, `femail`, `idalbaran`, `idfactura`, `idprovincia`, `irpf`, `netosindto`, `neto`, `nombrecliente`, `numero`, `numero2`, `observaciones`, `porcomision`, `provincia`, `ptefactura`, `recfinanciero`, `tasaconv`, `total`, `totaleuros`, `totalirpf`, `totaliva`, `totalrecargo`, `codtrans`, `codigoenv`, `nombreenv`, `apellidosenv`, `direccionenv`, `codpostalenv`, `ciudadenv`, `provinciaenv`, `apartadoenv`, `codpaisenv`, `numdocs`, `dtopor1`, `dtopor2`, `dtopor3`, `dtopor4`, `dtopor5`) VALUES
('', '1316360534001', 'Manta', '2', 'NJK', '000001', 1, 'USD', '2018', 'GUI2018A1', 'CONT', 'ECU', '', 'A', 'Cetro de Manta', '2018-02-11', '16:56:28', NULL, 1, 5, NULL, 0, 26.79, 26.79, 'Kevin Mecias Chica', '1', '', '', 0, 'Manabí', 0, 0, 1.129, 30, 26.57219, 0, 3.21, 0, NULL, '', '', '', '', '', '', '', '', 'ECU', 0, 0, 0, 0, 0, 0),
('', '0803663665001', 'Manta', '2', 'NJK', '000002', 2, 'USD', '2018', 'GUI2018A2', 'CONT', 'ECU', '', 'A', 'Sabra dios Donde', '2018-02-11', '19:34:03', NULL, 3, NULL, NULL, 0, 134.04, 134.04, 'Valencia Riasco Steeven', '2', '', '', 0, 'Manabi', 1, 0, 1.129, 143.68, 127.26306, 0, 9.64, 0, NULL, '', '', '', '', '', '', '', '', 'ECU', 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `albaranesprov`
--

CREATE TABLE `albaranesprov` (
  `cifnif` varchar(30) COLLATE utf8_bin NOT NULL,
  `codagente` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `codalmacen` varchar(4) COLLATE utf8_bin DEFAULT NULL,
  `coddivisa` varchar(3) COLLATE utf8_bin NOT NULL,
  `codejercicio` varchar(4) COLLATE utf8_bin NOT NULL,
  `codigo` varchar(20) COLLATE utf8_bin NOT NULL,
  `codpago` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `codproveedor` varchar(6) COLLATE utf8_bin DEFAULT NULL,
  `codserie` varchar(2) COLLATE utf8_bin NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL DEFAULT '00:00:00',
  `idalbaran` int(11) NOT NULL,
  `idfactura` int(11) DEFAULT NULL,
  `irpf` double NOT NULL DEFAULT '0',
  `neto` double NOT NULL DEFAULT '0',
  `nombre` varchar(100) COLLATE utf8_bin NOT NULL,
  `numero` varchar(12) COLLATE utf8_bin NOT NULL,
  `numproveedor` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `observaciones` text COLLATE utf8_bin,
  `ptefactura` tinyint(1) NOT NULL DEFAULT '1',
  `recfinanciero` double NOT NULL DEFAULT '0',
  `tasaconv` double NOT NULL DEFAULT '1',
  `total` double NOT NULL DEFAULT '0',
  `totaleuros` double NOT NULL DEFAULT '0',
  `totalirpf` double NOT NULL DEFAULT '0',
  `totaliva` double NOT NULL DEFAULT '0',
  `totalrecargo` double NOT NULL DEFAULT '0',
  `numdocs` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `almacenes`
--

CREATE TABLE `almacenes` (
  `apartado` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `codalmacen` varchar(4) COLLATE utf8_bin NOT NULL,
  `codpais` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `codpostal` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `contacto` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `direccion` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `fax` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `idprovincia` int(11) DEFAULT NULL,
  `nombre` varchar(100) COLLATE utf8_bin NOT NULL,
  `observaciones` text COLLATE utf8_bin,
  `poblacion` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `porpvp` double DEFAULT NULL,
  `provincia` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `telefono` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `tipovaloracion` varchar(100) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `almacenes`
--

INSERT INTO `almacenes` (`apartado`, `codalmacen`, `codpais`, `codpostal`, `contacto`, `direccion`, `fax`, `idprovincia`, `nombre`, `observaciones`, `poblacion`, `porpvp`, `provincia`, `telefono`, `tipovaloracion`) VALUES
(NULL, 'ALG', 'ECU', '', 'Pepe', '', '', NULL, 'ALMACEN GENERAL', NULL, '', NULL, '', '', NULL),
(NULL, 'NJK', 'ECU', '', 'Juan', '', '', NULL, 'ALMACEN PRINCIPAL', NULL, '', NULL, '', '', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulos`
--

CREATE TABLE `articulos` (
  `factualizado` date DEFAULT NULL,
  `bloqueado` tinyint(1) DEFAULT '0',
  `equivalencia` varchar(25) COLLATE utf8_bin DEFAULT NULL,
  `idsubcuentairpfcom` int(11) DEFAULT NULL,
  `idsubcuentacom` int(11) DEFAULT NULL,
  `stockmin` double DEFAULT '0',
  `observaciones` text COLLATE utf8_bin,
  `codbarras` varchar(18) COLLATE utf8_bin DEFAULT NULL,
  `codimpuesto` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `stockfis` double DEFAULT '0',
  `stockmax` double DEFAULT '0',
  `costemedio` double DEFAULT '0',
  `preciocoste` double DEFAULT '0',
  `tipocodbarras` varchar(8) COLLATE utf8_bin DEFAULT 'Code39',
  `nostock` tinyint(1) DEFAULT '0',
  `codsubcuentacom` varchar(15) COLLATE utf8_bin DEFAULT NULL,
  `descripcion` text COLLATE utf8_bin NOT NULL,
  `codsubcuentairpfcom` varchar(15) COLLATE utf8_bin DEFAULT NULL,
  `secompra` tinyint(1) DEFAULT '1',
  `codfamilia` varchar(8) COLLATE utf8_bin DEFAULT NULL,
  `codfabricante` varchar(8) COLLATE utf8_bin DEFAULT NULL,
  `imagen` text COLLATE utf8_bin,
  `controlstock` tinyint(1) DEFAULT '0',
  `referencia` varchar(18) COLLATE utf8_bin NOT NULL,
  `tipo` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `pvp` double DEFAULT '0',
  `sevende` tinyint(1) DEFAULT '1',
  `publico` tinyint(1) DEFAULT '0',
  `partnumber` varchar(38) COLLATE utf8_bin DEFAULT NULL,
  `trazabilidad` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `articulos`
--

INSERT INTO `articulos` (`factualizado`, `bloqueado`, `equivalencia`, `idsubcuentairpfcom`, `idsubcuentacom`, `stockmin`, `observaciones`, `codbarras`, `codimpuesto`, `stockfis`, `stockmax`, `costemedio`, `preciocoste`, `tipocodbarras`, `nostock`, `codsubcuentacom`, `descripcion`, `codsubcuentairpfcom`, `secompra`, `codfamilia`, `codfabricante`, `imagen`, `controlstock`, `referencia`, `tipo`, `pvp`, `sevende`, `publico`, `partnumber`, `trazabilidad`) VALUES
('2018-02-11', 0, NULL, NULL, NULL, 0, '', '', 'EC12', 0, 0, 0, 0, 'Code39', 1, NULL, 'Producto', NULL, 1, 'VARI', 'OEM', NULL, 1, '1', 'atributos', 44.64, 1, 1, '', 1),
('2018-02-11', 0, '1', NULL, NULL, 14, '', '', 'EC12', 0, 23, 0, 0, 'Code39', 0, '', 'Producto2', '', 1, 'FAM', 'OEM', NULL, 1, '2', 'atributos', 15.59, 1, 1, '', 1),
('2018-02-11', 0, '1', NULL, NULL, 0, '', '', 'EC0', 0, 0, 0, 0, 'Code39', 0, NULL, 'Producto3', NULL, 1, 'HEMA', 'MST', NULL, 0, '3', NULL, 9.82, 1, 0, '', 0),
('2018-02-11', 0, NULL, NULL, NULL, 0, '', '', 'EC12', 7, 0, 9.7, 0, 'Code39', 0, NULL, 'Productto4', NULL, 1, 'HERM', 'MST', NULL, 0, '4', NULL, 8.92, 1, 0, NULL, 0),
('2018-02-11', 0, NULL, NULL, NULL, 1, '', '', 'EC12', 40, 7, 169.54, 0, 'Code39', 0, NULL, 'Producto 5', NULL, 1, NULL, NULL, NULL, 1, '5', NULL, 26.79, 1, 0, '', 0),
('2018-02-11', 0, NULL, NULL, NULL, 1, '', '', 'EC0', 20, 2, 197.0001, 0, 'Code39', 0, NULL, 'Producto 6', NULL, 1, NULL, NULL, NULL, 1, '6', NULL, 17.89, 1, 0, '', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulosprov`
--

CREATE TABLE `articulosprov` (
  `id` int(11) NOT NULL,
  `referencia` varchar(18) COLLATE utf8_bin DEFAULT NULL,
  `codproveedor` varchar(6) COLLATE utf8_bin NOT NULL,
  `refproveedor` varchar(25) COLLATE utf8_bin NOT NULL,
  `descripcion` text COLLATE utf8_bin,
  `precio` double DEFAULT NULL,
  `dto` double DEFAULT NULL,
  `codimpuesto` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `stock` double DEFAULT NULL,
  `nostock` tinyint(1) DEFAULT '1',
  `nombre` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `coddivisa` varchar(3) COLLATE utf8_bin DEFAULT NULL,
  `codbarras` varchar(18) COLLATE utf8_bin DEFAULT NULL,
  `partnumber` varchar(38) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `articulosprov`
--

INSERT INTO `articulosprov` (`id`, `referencia`, `codproveedor`, `refproveedor`, `descripcion`, `precio`, `dto`, `codimpuesto`, `stock`, `nostock`, `nombre`, `coddivisa`, `codbarras`, `partnumber`) VALUES
(1, '4', '000002', '4', 'Productto4', 10, 3, 'EC12', 0, 1, NULL, NULL, NULL, NULL),
(2, '5', '000002', '5', 'Producto 5', 173, 2, 'EC12', 0, 1, NULL, NULL, NULL, NULL),
(3, '6', '000002', '6', 'Producto 6', 198.99, 1, 'EC0', 0, 1, NULL, NULL, NULL, NULL),
(4, '4', '000001', '4', 'Productto4', 9.7, 0, 'EC12', 0, 1, NULL, NULL, NULL, NULL),
(5, '5', '000001', '5', 'Producto 5', 169.54, 0, 'EC12', 0, 1, NULL, NULL, NULL, NULL),
(6, '6', '000001', '6', 'Producto 6', 197.0001, 0, 'EC0', 0, 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulo_combinaciones`
--

CREATE TABLE `articulo_combinaciones` (
  `id` int(11) NOT NULL,
  `codigo` varchar(18) COLLATE utf8_bin NOT NULL,
  `codigo2` varchar(18) COLLATE utf8_bin DEFAULT NULL,
  `referencia` varchar(18) COLLATE utf8_bin NOT NULL,
  `idvalor` int(11) NOT NULL,
  `nombreatributo` varchar(100) COLLATE utf8_bin NOT NULL,
  `valor` varchar(100) COLLATE utf8_bin NOT NULL,
  `refcombinacion` varchar(18) COLLATE utf8_bin DEFAULT NULL,
  `codbarras` varchar(18) COLLATE utf8_bin DEFAULT NULL,
  `impactoprecio` double NOT NULL DEFAULT '0',
  `stockfis` double DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `articulo_combinaciones`
--

INSERT INTO `articulo_combinaciones` (`id`, `codigo`, `codigo2`, `referencia`, `idvalor`, `nombreatributo`, `valor`, `refcombinacion`, `codbarras`, `impactoprecio`, `stockfis`) VALUES
(3, '1', NULL, '2', 7, 'Color', 'Blanco', NULL, NULL, 3.5, 0),
(6, '2', NULL, '2', 3, 'Color', 'Naranja', NULL, NULL, 4, 0),
(7, '3', NULL, '2', 1, 'Color', 'Rojo', NULL, NULL, 4.59, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulo_propiedades`
--

CREATE TABLE `articulo_propiedades` (
  `name` varchar(50) COLLATE utf8_bin NOT NULL,
  `referencia` varchar(18) COLLATE utf8_bin NOT NULL,
  `text` text COLLATE utf8_bin
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `articulo_propiedades`
--

INSERT INTO `articulo_propiedades` (`name`, `referencia`, `text`) VALUES
('codsubcuentaventa', '2', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulo_trazas`
--

CREATE TABLE `articulo_trazas` (
  `id` int(11) NOT NULL,
  `referencia` varchar(18) COLLATE utf8_bin NOT NULL,
  `numserie` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `lote` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `fecha_entrada` date DEFAULT NULL,
  `fecha_salida` date DEFAULT NULL,
  `idlalbventa` int(11) DEFAULT NULL,
  `idlfacventa` int(11) DEFAULT NULL,
  `idlalbcompra` int(11) DEFAULT NULL,
  `idlfaccompra` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `atributos`
--

CREATE TABLE `atributos` (
  `codatributo` varchar(20) COLLATE utf8_bin NOT NULL,
  `nombre` varchar(100) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `atributos`
--

INSERT INTO `atributos` (`codatributo`, `nombre`) VALUES
('Color', 'Color');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `atributos_valores`
--

CREATE TABLE `atributos_valores` (
  `id` int(11) NOT NULL,
  `codatributo` varchar(20) COLLATE utf8_bin NOT NULL,
  `valor` varchar(100) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `atributos_valores`
--

INSERT INTO `atributos_valores` (`id`, `codatributo`, `valor`) VALUES
(1, 'Color', 'Rojo'),
(2, 'Color', 'Amarillo'),
(3, 'Color', 'Naranja'),
(4, 'Color', 'Verde'),
(5, 'Color', 'Rosa'),
(6, 'Color', 'Negro'),
(7, 'Color', 'Blanco');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `capitalimpagado` double DEFAULT NULL,
  `cifnif` varchar(30) COLLATE utf8_bin NOT NULL,
  `codagente` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `codcliente` varchar(6) COLLATE utf8_bin NOT NULL,
  `codcontacto` varchar(6) COLLATE utf8_bin DEFAULT NULL,
  `codcuentadom` varchar(6) COLLATE utf8_bin DEFAULT NULL,
  `codcuentarem` varchar(6) COLLATE utf8_bin DEFAULT NULL,
  `coddivisa` varchar(3) COLLATE utf8_bin DEFAULT NULL,
  `codedi` varchar(17) COLLATE utf8_bin DEFAULT NULL,
  `codgrupo` varchar(6) COLLATE utf8_bin DEFAULT NULL,
  `codpago` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `codserie` varchar(2) COLLATE utf8_bin DEFAULT NULL,
  `codsubcuenta` varchar(15) COLLATE utf8_bin DEFAULT NULL,
  `codtiporappel` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `contacto` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `copiasfactura` int(11) DEFAULT NULL,
  `debaja` tinyint(1) DEFAULT '0',
  `email` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `fax` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `fechabaja` date DEFAULT NULL,
  `fechaalta` date DEFAULT NULL,
  `idsubcuenta` int(11) DEFAULT NULL,
  `ivaincluido` tinyint(1) DEFAULT NULL,
  `nombre` varchar(100) COLLATE utf8_bin NOT NULL,
  `razonsocial` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `observaciones` text COLLATE utf8_bin,
  `recargo` tinyint(1) DEFAULT NULL,
  `regimeniva` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `riesgoalcanzado` double DEFAULT NULL,
  `riesgomax` double DEFAULT NULL,
  `telefono1` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `telefono2` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `tipoidfiscal` varchar(25) COLLATE utf8_bin NOT NULL DEFAULT 'NIF',
  `personafisica` tinyint(1) DEFAULT '1',
  `web` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `diaspago` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `codproveedor` varchar(6) COLLATE utf8_bin DEFAULT NULL,
  `codtarifa` varchar(6) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`capitalimpagado`, `cifnif`, `codagente`, `codcliente`, `codcontacto`, `codcuentadom`, `codcuentarem`, `coddivisa`, `codedi`, `codgrupo`, `codpago`, `codserie`, `codsubcuenta`, `codtiporappel`, `contacto`, `copiasfactura`, `debaja`, `email`, `fax`, `fechabaja`, `fechaalta`, `idsubcuenta`, `ivaincluido`, `nombre`, `razonsocial`, `observaciones`, `recargo`, `regimeniva`, `riesgoalcanzado`, `riesgomax`, `telefono1`, `telefono2`, `tipoidfiscal`, `personafisica`, `web`, `diaspago`, `codproveedor`, `codtarifa`) VALUES
(NULL, '1316360534001', NULL, '000001', NULL, NULL, NULL, 'USD', NULL, '000001', 'CONT', NULL, NULL, NULL, NULL, NULL, 0, 'Kevin@gmaul.com', '', NULL, '2018-02-11', NULL, NULL, 'Kevin Mecias', 'Kevin Mecias Chica', '', 0, 'General', NULL, NULL, '0999999999', '', 'R.U.C', 1, '', NULL, NULL, NULL),
(NULL, '0803663665001', NULL, '000002', NULL, NULL, NULL, 'USD', NULL, '000002', 'CONT', NULL, NULL, NULL, NULL, NULL, 0, 'riasco@yahoo.com', '', NULL, '2018-02-11', NULL, NULL, 'Steeven Valencia', 'Valencia Riasco Steeven', '', 0, 'General', NULL, NULL, '0921087316', '', 'R.U.C', 1, '', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `co_asientos`
--

CREATE TABLE `co_asientos` (
  `codejercicio` varchar(4) COLLATE utf8_bin NOT NULL,
  `codplanasiento` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `concepto` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `documento` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `editable` tinyint(1) NOT NULL,
  `fecha` date NOT NULL,
  `idasiento` int(11) NOT NULL,
  `idconcepto` varchar(4) COLLATE utf8_bin DEFAULT NULL,
  `importe` double DEFAULT NULL,
  `numero` int(11) NOT NULL,
  `tipodocumento` varchar(25) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `co_asientos`
--

INSERT INTO `co_asientos` (`codejercicio`, `codplanasiento`, `concepto`, `documento`, `editable`, `fecha`, `idasiento`, `idconcepto`, `importe`, `numero`, `tipodocumento`) VALUES
('2018', NULL, '---', '', 1, '2018-02-11', 1, '', 0, 1, NULL),
('2018', NULL, 'Factura de venta FAC2018A1 - Kevin Mecias Chica', 'FAC2018A1', 0, '2018-02-11', 2, NULL, 46.75, 2, 'Factura de cliente'),
('2018', NULL, 'Cobro Factura de venta FAC2018A1 - Kevin Mecias Chica', 'FAC2018A1', 0, '2018-02-11', 3, NULL, 46.75, 3, 'Factura de cliente'),
('2018', NULL, 'Factura rectificativa de FAC2018R1 (ventas) - Kevin Mecias Chica', 'FAC2018R1', 0, '2018-02-11', 4, NULL, 29.4, 4, 'Factura de cliente'),
('2018', NULL, 'Cobro Factura rectificativa de FAC2018R1 (ventas) - Kevin Mecias Chica', 'FAC2018R1', 0, '2018-02-11', 5, NULL, 29.4, 5, 'Factura de cliente'),
('2018', NULL, 'Factura de venta FAC2018A2 - Kevin Mecias Chica', 'FAC2018A2', 0, '2018-02-11', 6, NULL, 30, 6, 'Factura de cliente'),
('2018', NULL, 'Cobro Factura de venta FAC2018A2 - Kevin Mecias Chica', 'FAC2018A2', 0, '2018-02-11', 7, NULL, 30, 7, 'Factura de cliente'),
('2018', NULL, 'Factura de compra FAC2018A2C - Luis Velez Velez', 'FAC2018A2C', 0, '2018-02-11', 9, NULL, 2547.92, 8, 'Factura de proveedor'),
('2018', NULL, 'Pago Factura de compra FAC2018A2C - Luis Velez Velez', 'FAC2018A2C', 0, '2018-02-11', 10, NULL, 2547.92, 9, 'Factura de proveedor'),
('2018', NULL, 'Factura de compra FAC2018A1C - Javier Gilson', 'FAC2018A1C', 0, '2018-02-11', 11, NULL, 397.75, 10, 'Factura de proveedor'),
('2018', NULL, 'Pago Factura de compra FAC2018A1C - Javier Gilson', 'FAC2018A1C', 0, '2018-02-11', 12, NULL, 397.75, 11, 'Factura de proveedor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `co_codbalances08`
--

CREATE TABLE `co_codbalances08` (
  `descripcion4ba` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `descripcion4` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `nivel4` varchar(5) COLLATE utf8_bin DEFAULT NULL,
  `descripcion3` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `orden3` varchar(5) COLLATE utf8_bin DEFAULT NULL,
  `nivel3` varchar(5) COLLATE utf8_bin DEFAULT NULL,
  `descripcion2` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `nivel2` int(11) DEFAULT NULL,
  `descripcion1` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `nivel1` varchar(5) COLLATE utf8_bin DEFAULT NULL,
  `naturaleza` varchar(15) COLLATE utf8_bin NOT NULL,
  `codbalance` varchar(15) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `co_conceptospar`
--

CREATE TABLE `co_conceptospar` (
  `concepto` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `idconceptopar` varchar(4) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `co_cuentas`
--

CREATE TABLE `co_cuentas` (
  `codbalance` varchar(15) COLLATE utf8_bin DEFAULT NULL,
  `codcuenta` varchar(6) COLLATE utf8_bin NOT NULL,
  `codejercicio` varchar(4) COLLATE utf8_bin NOT NULL,
  `codepigrafe` varchar(6) COLLATE utf8_bin NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `idcuenta` int(11) NOT NULL,
  `idcuentaesp` varchar(6) COLLATE utf8_bin DEFAULT NULL,
  `idepigrafe` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `co_cuentas`
--

INSERT INTO `co_cuentas` (`codbalance`, `codcuenta`, `codejercicio`, `codepigrafe`, `descripcion`, `idcuenta`, `idcuentaesp`, `idepigrafe`) VALUES
(NULL, '1111', '2018', '111', 'CAJA GENERAL', 1, 'CAJA', 3),
(NULL, '1112', '2018', '111', 'CAJA CHICA', 2, 'CAJA', 3),
(NULL, '1113', '2018', '111', 'BANCOS', 3, '', 3),
(NULL, '1114', '2018', '111', 'INVERSIONES', 4, '', 3),
(NULL, '1121', '2018', '112', 'CUENTAS POR COBRAR CLIENTES', 5, 'CLIENT', 4),
(NULL, '1122', '2018', '112', 'CUENTAS POR COBRAR TARJETAS', 6, '', 4),
(NULL, '1131', '2018', '113', 'Otras cuentas por cobrar', 7, '', 5),
(NULL, '1133', '2018', '113', 'OTRAS POR COBRAR EMPLEADOS', 8, '', 5),
(NULL, '1134', '2018', '113', 'IMPUESTOS SRI', 9, 'ERFVEN', 5),
(NULL, '1135', '2018', '113', 'RETENCIONES Y ANTICIPOS', 10, 'ERIVEN', 5),
(NULL, '1141', '2018', '114', 'INVENTARIO', 11, 'COMPRA', 6),
(NULL, '1211', '2018', '121', 'ACTIVOS NO DEPRECIABLES', 12, '', 8),
(NULL, '1212', '2018', '121', 'ACTIVOS DEPRECIABLES', 13, '', 8),
(NULL, '1213', '2018', '121', 'DEPRECIACIÓN ACUMULADA', 14, '', 8),
(NULL, '1221', '2018', '122', 'Otras por cobrar Garantías L.P.', 15, '', 9),
(NULL, '1222', '2018', '122', 'Otras por cobrar Garantías', 16, '', 9),
(NULL, '2111', '2018', '211', 'SOBREGIRO Y PRESTAMOS', 17, '', 12),
(NULL, '2121', '2018', '212', 'PROVEEDORES', 18, 'PROVEE', 13),
(NULL, '2131', '2018', '213', 'OTRAS CUENTAS POR PAGAR', 19, '', 14),
(NULL, '2132', '2018', '213', 'OBLIGACIONES PERSONAL', 20, '', 14),
(NULL, '2133', '2018', '213', 'OBLIGACIONES FISCALES', 21, 'IVAREP', 14),
(NULL, '2134', '2018', '213', 'RETENCIONES DE IVA', 22, 'ERICOM', 14),
(NULL, '2135', '2018', '213', 'RETENCIONES EN LA FUENTE', 23, 'ERFCOM', 14),
(NULL, '2136', '2018', '213', 'OBLIGACIONES SEGURO SOCIAL', 24, '', 14),
(NULL, '2211', '2018', '221', 'PRESTAMOS', 25, '', 16),
(NULL, '311', '2018', '31', 'CAPITAL SOCIAL', 26, '', 18),
(NULL, '312', '2018', '31', 'APORTES FUTURA CAPITALIZACIÓN', 27, '', 18),
(NULL, '313', '2018', '31', 'RESERVAS', 28, '', 18),
(NULL, '331', '2018', '33', 'RESULTADOS ANTERIORES', 29, '', 19),
(NULL, '332', '2018', '33', 'RESULTADO DEL EJERCICIO', 30, '', 19),
(NULL, '411', '2018', '41', 'VENTAS', 31, 'VENTAS', 21),
(NULL, '4121', '2018', '412', 'VENTAS', 32, '', 22),
(NULL, '4122', '2018', '412', 'DEVOLUCIONES EN VENTAS', 33, '', 22),
(NULL, '4123', '2018', '412', 'OTROS INGRESOS OPERACIONALES', 34, '', 22),
(NULL, '421', '2018', '42', 'OTROS INGRESOS', 35, '', 24),
(NULL, '511', '2018', '51', 'COSTO DE PRODUCCIÓN', 36, '', 26),
(NULL, '512', '2018', '51', 'COSTO MANO DE OBRA', 37, '', 26),
(NULL, '513', '2018', '51', 'OTROS COSTOS', 38, '', 26),
(NULL, '611', '2018', '61', 'GASTOS PERSONAL ADMINISTRATIVO', 39, '', 28),
(NULL, '612', '2018', '61', 'OTROS GASTOS ADMINISTRATIVOS', 40, '', 28),
(NULL, '621', '2018', '62', 'GASTOS PERSONAL DE VENTAS', 41, '', 29),
(NULL, '622', '2018', '62', 'OTROS GASTOS VENTAS', 42, '', 29),
(NULL, '631', '2018', '63', 'GASTOS FINANCIEROS', 43, '', 30);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `co_cuentascb`
--

CREATE TABLE `co_cuentascb` (
  `desccuenta` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `codcuenta` varchar(6) COLLATE utf8_bin NOT NULL,
  `codbalance` varchar(15) COLLATE utf8_bin NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `co_cuentascbba`
--

CREATE TABLE `co_cuentascbba` (
  `desccuenta` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `codcuenta` varchar(6) COLLATE utf8_bin NOT NULL,
  `codbalance` varchar(15) COLLATE utf8_bin NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `co_cuentasesp`
--

CREATE TABLE `co_cuentasesp` (
  `codcuenta` varchar(6) COLLATE utf8_bin DEFAULT NULL,
  `codsubcuenta` varchar(15) COLLATE utf8_bin DEFAULT NULL,
  `descripcion` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `idcuentaesp` varchar(6) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `co_cuentasesp`
--

INSERT INTO `co_cuentasesp` (`codcuenta`, `codsubcuenta`, `descripcion`, `idcuentaesp`) VALUES
(NULL, NULL, 'Cuentas de acreedores', 'ACREED'),
(NULL, NULL, 'Cuentas de caja', 'CAJA'),
(NULL, NULL, 'Cuentas de diferencias negativas de cambio', 'CAMNEG'),
(NULL, NULL, 'Cuentas de diferencias positivas de cambio', 'CAMPOS'),
(NULL, NULL, 'Cuentas de clientes', 'CLIENT'),
(NULL, NULL, 'Cuentas de compras', 'COMPRA'),
(NULL, NULL, 'Devoluciones de compras', 'DEVCOM'),
(NULL, NULL, 'Devoluciones de ventas', 'DEVVEN'),
(NULL, NULL, 'Cuentas por diferencias positivas en divisa extranjera', 'DIVPOS'),
(NULL, NULL, 'Ecuador retención fuente compras', 'ERFCOM'),
(NULL, NULL, 'Ecuador retención fuente ventas', 'ERFVEN'),
(NULL, NULL, 'Ecuador retención de IVA compras', 'ERICOM'),
(NULL, NULL, 'Ecuador retención de IVA ventas', 'ERIVEN'),
(NULL, NULL, 'Cuentas por diferencias negativas de conversión a la moneda local', 'EURNEG'),
(NULL, NULL, 'Cuentas por diferencias positivas de conversión a la moneda local', 'EURPOS'),
(NULL, NULL, 'Gastos por recargo financiero', 'GTORF'),
(NULL, NULL, 'Ingresos por recargo financiero', 'INGRF'),
(NULL, NULL, 'Cuentas de retenciones IRPF', 'IRPF'),
(NULL, NULL, 'Cuentas de retenciones para proveedores IRPFPR', 'IRPFPR'),
(NULL, NULL, 'Cuentas acreedoras de IVA en la regularización', 'IVAACR'),
(NULL, NULL, 'Cuentas deudoras de IVA en la regularización', 'IVADEU'),
(NULL, NULL, 'IVA en entregas intracomunitarias U.E.', 'IVAEUE'),
(NULL, NULL, 'Cuentas de IVA repercutido', 'IVAREP'),
(NULL, NULL, 'Cuentas de IVA repercutido para clientes exentos de IVA', 'IVAREX'),
(NULL, NULL, 'Cuentas de IVA soportado UE', 'IVARUE'),
(NULL, NULL, 'Cuentas de IVA repercutido en exportaciones', 'IVARXP'),
(NULL, NULL, 'Cuentas de IVA soportado en importaciones', 'IVASIM'),
(NULL, NULL, 'Cuentas de IVA soportado', 'IVASOP'),
(NULL, NULL, 'Cuentas de IVA soportado UE', 'IVASUE'),
(NULL, NULL, 'Cuentas relativas al ejercicio previo', 'PREVIO'),
(NULL, NULL, 'Cuentas de proveedores', 'PROVEE'),
(NULL, NULL, 'Pérdidas y ganancias', 'PYG'),
(NULL, NULL, 'Cuentas de ventas', 'VENTAS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `co_epigrafes`
--

CREATE TABLE `co_epigrafes` (
  `codejercicio` varchar(4) COLLATE utf8_bin NOT NULL,
  `codepigrafe` varchar(6) COLLATE utf8_bin NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `idepigrafe` int(11) NOT NULL,
  `idgrupo` int(11) DEFAULT NULL,
  `idpadre` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `co_epigrafes`
--

INSERT INTO `co_epigrafes` (`codejercicio`, `codepigrafe`, `descripcion`, `idepigrafe`, `idgrupo`, `idpadre`) VALUES
('2018', '1', 'ACTIVOS', 1, NULL, NULL),
('2018', '11', 'ACTIVO CORRIENTE', 2, NULL, 1),
('2018', '111', 'DISPONIBLE', 3, NULL, 2),
('2018', '112', 'EXIGIBLE', 4, NULL, 2),
('2018', '113', 'OTRAS CUENTAS POR COBRAR', 5, NULL, 2),
('2018', '114', 'REALIZABLE', 6, NULL, 2),
('2018', '12', 'ACTIVO NO CORRIENTE', 7, NULL, 1),
('2018', '121', 'ACTIVO FIJO', 8, NULL, 7),
('2018', '122', 'OTROS ACTIVOS LAGO PLAZO', 9, NULL, 7),
('2018', '2', 'PASIVO', 10, NULL, NULL),
('2018', '21', 'PASIVO CORRIENTE', 11, NULL, 10),
('2018', '211', 'OBLIGACIONES FINANCIERAS CORTO PLAZO', 12, NULL, 11),
('2018', '212', 'CTAS POR PAGAR COMERCIALES', 13, NULL, 11),
('2018', '213', 'GASTOS ACUMULADOS Y OTRAS POR PAGAR', 14, NULL, 11),
('2018', '22', 'PASIVO NO CORRIENTE', 15, NULL, 10),
('2018', '221', 'OBLIGACIONES FINANCIERAS LARGO PLAZO', 16, NULL, 15),
('2018', '3', 'PATRIMONIO', 17, NULL, NULL),
('2018', '31', 'CAPITAL Y RESERVAS', 18, NULL, 17),
('2018', '33', 'RESULTADOS', 19, NULL, 17),
('2018', '4', 'INGRESOS', 20, NULL, NULL),
('2018', '41', 'INGRESOS OPERACIONALES', 21, NULL, 20),
('2018', '412', 'DEVOLUCIONES EN VENTAS', 22, NULL, 21),
('2018', '414', 'OTROS INGRESOS OPERACIONALES', 23, NULL, 21),
('2018', '42', 'INGRESOS NO OPERACIONALES', 24, NULL, 20),
('2018', '5', 'COSTOS', 25, NULL, NULL),
('2018', '51', 'COSTOS DE OPERACION', 26, NULL, 25),
('2018', '6', 'GASTOS', 27, NULL, NULL),
('2018', '61', 'GASTOS ADMINISTRACION', 28, NULL, 27),
('2018', '62', 'GASTOS DE VENTAS', 29, NULL, 27),
('2018', '63', 'GASTOS FINANCIEROS', 30, NULL, 27);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `co_gruposepigrafes`
--

CREATE TABLE `co_gruposepigrafes` (
  `codejercicio` varchar(4) COLLATE utf8_bin NOT NULL,
  `codgrupo` varchar(6) COLLATE utf8_bin NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `idgrupo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `co_partidas`
--

CREATE TABLE `co_partidas` (
  `baseimponible` double NOT NULL,
  `cifnif` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `codcontrapartida` varchar(15) COLLATE utf8_bin DEFAULT NULL,
  `coddivisa` varchar(3) COLLATE utf8_bin DEFAULT NULL,
  `codserie` varchar(2) COLLATE utf8_bin DEFAULT NULL,
  `codsubcuenta` varchar(15) COLLATE utf8_bin NOT NULL,
  `concepto` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `debe` double NOT NULL DEFAULT '0',
  `debeme` double NOT NULL,
  `documento` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `factura` double DEFAULT NULL,
  `haber` double NOT NULL DEFAULT '0',
  `haberme` double NOT NULL,
  `idasiento` int(11) NOT NULL,
  `idconcepto` varchar(4) COLLATE utf8_bin DEFAULT NULL,
  `idcontrapartida` int(11) DEFAULT NULL,
  `idpartida` int(11) NOT NULL,
  `idsubcuenta` int(11) NOT NULL,
  `iva` double NOT NULL,
  `punteada` tinyint(1) NOT NULL DEFAULT '0',
  `recargo` double NOT NULL,
  `tasaconv` double NOT NULL,
  `tipodocumento` varchar(25) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `co_partidas`
--

INSERT INTO `co_partidas` (`baseimponible`, `cifnif`, `codcontrapartida`, `coddivisa`, `codserie`, `codsubcuenta`, `concepto`, `debe`, `debeme`, `documento`, `factura`, `haber`, `haberme`, `idasiento`, `idconcepto`, `idcontrapartida`, `idpartida`, `idsubcuenta`, `iva`, `punteada`, `recargo`, `tasaconv`, `tipodocumento`) VALUES
(0, '', NULL, 'USD', NULL, '1111001', '---', 0, 0, '', NULL, 0, 0, 1, '', NULL, 1, 1, 0, 0, 0, 1.129, NULL),
(26.25, '1316360534001', '1121001', 'USD', 'A', '2133003', 'Factura de venta FAC2018A1 - Kevin Mecias Chica', 0, 0, 'FAC2018A1', 1, 3.15, 0, 2, NULL, 5, 2, 195, 12, 0, 0, 1.129, 'Factura de cliente'),
(0, '', NULL, 'USD', 'A', '4110001', 'Factura de venta FAC2018A1 - Kevin Mecias Chica', 0, 0, '', NULL, 43.6, 0, 2, NULL, NULL, 3, 355, 0, 0, 0, 1.129, NULL),
(0, '', NULL, 'USD', 'A', '1121001', 'Factura de venta FAC2018A1 - Kevin Mecias Chica', 46.75, 0, '', NULL, 0, 0, 2, NULL, NULL, 4, 5, 0, 0, 0, 1.129, NULL),
(0, '', NULL, 'USD', 'A', '1121001', 'Cobro Factura de venta FAC2018A1 - Kevin Mecias Chica', 0, 0, '', NULL, 46.75, 0, 3, NULL, NULL, 5, 5, 0, 0, 0, 1.129, NULL),
(0, '', NULL, 'USD', 'A', '1111001', 'Cobro Factura de venta FAC2018A1 - Kevin Mecias Chica', 46.75, 0, '', NULL, 0, 0, 3, NULL, NULL, 6, 1, 0, 0, 0, 1.129, NULL),
(26.25, '1316360534001', '1121001', 'USD', 'R', '2133003', 'Factura rectificativa de FAC2018R1 (ventas) - Kevin Mecias Chica', 3.15, 0, 'FAC2018R1', 1, 0, 0, 4, NULL, 5, 7, 195, 12, 0, 0, 1.129, 'Factura de cliente'),
(0, '', NULL, 'USD', 'R', '4110001', 'Factura rectificativa de FAC2018R1 (ventas) - Kevin Mecias Chica', 26.25, 0, '', NULL, 0, 0, 4, NULL, NULL, 8, 355, 0, 0, 0, 1.129, NULL),
(0, '', NULL, 'USD', 'R', '1121001', 'Factura rectificativa de FAC2018R1 (ventas) - Kevin Mecias Chica', 0, 0, '', NULL, 29.4, 0, 4, NULL, NULL, 9, 5, 0, 0, 0, 1.129, NULL),
(0, '', NULL, 'USD', 'R', '1121001', 'Cobro Factura rectificativa de FAC2018R1 (ventas) - Kevin Mecias Chica', 29.4, 0, '', NULL, 0, 0, 5, NULL, NULL, 10, 5, 0, 0, 0, 1.129, NULL),
(0, '', NULL, 'USD', 'R', '1111001', 'Cobro Factura rectificativa de FAC2018R1 (ventas) - Kevin Mecias Chica', 0, 0, '', NULL, 29.4, 0, 5, NULL, NULL, 11, 1, 0, 0, 0, 1.129, NULL),
(26.79, '1316360534001', '1121001', 'USD', 'A', '2133003', 'Factura de venta FAC2018A2 - Kevin Mecias Chica', 0, 0, 'FAC2018A2', 2, 3.21, 0, 6, NULL, 5, 12, 195, 12, 0, 0, 1.129, 'Factura de cliente'),
(0, '', NULL, 'USD', 'A', '4110001', 'Factura de venta FAC2018A2 - Kevin Mecias Chica', 0, 0, '', NULL, 26.79, 0, 6, NULL, NULL, 13, 355, 0, 0, 0, 1.129, NULL),
(0, '', NULL, 'USD', 'A', '1121001', 'Factura de venta FAC2018A2 - Kevin Mecias Chica', 30, 0, '', NULL, 0, 0, 6, NULL, NULL, 14, 5, 0, 0, 0, 1.129, NULL),
(0, '', NULL, 'USD', 'A', '1121001', 'Cobro Factura de venta FAC2018A2 - Kevin Mecias Chica', 0, 0, '', NULL, 30, 0, 7, NULL, NULL, 15, 5, 0, 0, 0, 1.129, NULL),
(0, '', NULL, 'USD', 'A', '1111001', 'Cobro Factura de venta FAC2018A2 - Kevin Mecias Chica', 30, 0, '', NULL, 0, 0, 7, NULL, NULL, 16, 1, 0, 0, 0, 1.129, NULL),
(0, '', NULL, 'USD', NULL, '1122003', '---', 0, 0, '', NULL, 0, 0, 1, '', NULL, 17, 8, 0, 0, 0, 1.129, NULL),
(1923.14, '1317038881', '2121001', 'USD', 'A', '2133003', 'Factura de compra FAC2018A2C - Luis Velez Velez', 230.78, 0, 'FAC2018A2C', 2, 0, 0, 9, NULL, 510, 18, 195, 12, 0, 0, 1.129, 'Factura de proveedor'),
(0, '', NULL, 'USD', 'A', '1141001', 'Factura de compra FAC2018A2C - Luis Velez Velez', 2317.14, 0, '', NULL, 0, 0, 9, NULL, NULL, 19, 162, 0, 0, 0, 1.129, NULL),
(0, '', NULL, 'USD', 'A', '2121001', 'Factura de compra FAC2018A2C - Luis Velez Velez', 0, 0, '', NULL, 2547.92, 0, 9, NULL, NULL, 20, 510, 0, 0, 0, 1.129, NULL),
(0, '', NULL, 'USD', 'A', '2121001', 'Pago Factura de compra FAC2018A2C - Luis Velez Velez', 2547.92, 0, '', NULL, 0, 0, 10, NULL, NULL, 21, 510, 0, 0, 0, 1.129, NULL),
(0, '', NULL, 'USD', 'A', '1111001', 'Pago Factura de compra FAC2018A2C - Luis Velez Velez', 0, 0, '', NULL, 2547.92, 0, 10, NULL, NULL, 22, 1, 0, 0, 0, 1.129, NULL),
(179.24, '1315330561', '2121002', 'USD', 'A', '2133003', 'Factura de compra FAC2018A1C - Javier Gilson', 21.51, 0, 'FAC2018A1C', 1, 0, 0, 11, NULL, 509, 23, 195, 12, 0, 0, 1.129, 'Factura de proveedor'),
(0, '', NULL, 'USD', 'A', '1141001', 'Factura de compra FAC2018A1C - Javier Gilson', 376.24, 0, '', NULL, 0, 0, 11, NULL, NULL, 24, 162, 0, 0, 0, 1.129, NULL),
(0, '', NULL, 'USD', 'A', '2121002', 'Factura de compra FAC2018A1C - Javier Gilson', 0, 0, '', NULL, 397.75, 0, 11, NULL, NULL, 25, 509, 0, 0, 0, 1.129, NULL),
(0, '', NULL, 'USD', 'A', '2121002', 'Pago Factura de compra FAC2018A1C - Javier Gilson', 397.75, 0, '', NULL, 0, 0, 12, NULL, NULL, 26, 509, 0, 0, 0, 1.129, NULL),
(0, '', NULL, 'USD', 'A', '1111001', 'Pago Factura de compra FAC2018A1C - Javier Gilson', 0, 0, '', NULL, 397.75, 0, 12, NULL, NULL, 27, 1, 0, 0, 0, 1.129, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `co_regiva`
--

CREATE TABLE `co_regiva` (
  `codejercicio` varchar(4) COLLATE utf8_bin NOT NULL,
  `codsubcuentaacr` varchar(15) COLLATE utf8_bin DEFAULT NULL,
  `codsubcuentadeu` varchar(15) COLLATE utf8_bin DEFAULT NULL,
  `fechaasiento` date NOT NULL,
  `fechafin` date NOT NULL,
  `fechainicio` date NOT NULL,
  `idasiento` int(11) NOT NULL,
  `idregiva` int(11) NOT NULL,
  `idsubcuentaacr` int(11) DEFAULT NULL,
  `idsubcuentadeu` int(11) DEFAULT NULL,
  `periodo` varchar(8) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `co_secuencias`
--

CREATE TABLE `co_secuencias` (
  `codejercicio` varchar(4) COLLATE utf8_bin NOT NULL,
  `descripcion` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `idsecuencia` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_bin NOT NULL,
  `valor` int(11) DEFAULT NULL,
  `valorout` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `co_secuencias`
--

INSERT INTO `co_secuencias` (`codejercicio`, `descripcion`, `idsecuencia`, `nombre`, `valor`, `valorout`) VALUES
('2018', 'Creado por FacturaScripts', 1, 'nasiento', NULL, 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `co_subcuentas`
--

CREATE TABLE `co_subcuentas` (
  `codcuenta` varchar(6) COLLATE utf8_bin NOT NULL,
  `coddivisa` varchar(3) COLLATE utf8_bin NOT NULL,
  `codejercicio` varchar(4) COLLATE utf8_bin NOT NULL,
  `codimpuesto` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `codsubcuenta` varchar(15) COLLATE utf8_bin NOT NULL,
  `debe` double NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `haber` double NOT NULL,
  `idcuenta` int(11) DEFAULT NULL,
  `idsubcuenta` int(11) NOT NULL,
  `iva` double NOT NULL,
  `recargo` double NOT NULL,
  `saldo` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `co_subcuentas`
--

INSERT INTO `co_subcuentas` (`codcuenta`, `coddivisa`, `codejercicio`, `codimpuesto`, `codsubcuenta`, `debe`, `descripcion`, `haber`, `idcuenta`, `idsubcuenta`, `iva`, `recargo`, `saldo`) VALUES
('1111', 'USD', '2018', NULL, '1111001', 76.75, 'Caja General - Ventas', 2975.07, 1, 1, 0, 0, -2898.32),
('1112', 'USD', '2018', NULL, '1112001', 0, 'CAJA CHICA', 0, 2, 2, 0, 0, 0),
('1113', 'USD', '2018', NULL, '1113001', 0, 'PRODUBANCO', 0, 3, 3, 0, 0, 0),
('1114', 'USD', '2018', NULL, '1114001', 0, 'INVERSIONES TEMPORALES', 0, 4, 4, 0, 0, 0),
('1121', 'USD', '2018', NULL, '1121001', 106.15, 'Kevin Mecias Chica', 106.15, 5, 5, 0, 0, 0),
('1122', 'USD', '2018', NULL, '1122001', 0, 'Diners', 0, 6, 6, 0, 0, 0),
('1122', 'USD', '2018', NULL, '1122002', 0, 'MasterCard', 0, 6, 7, 0, 0, 0),
('1122', 'USD', '2018', NULL, '1122003', 0, 'Visa', 0, 6, 8, 0, 0, 0),
('1122', 'USD', '2018', NULL, '1122004', 0, 'American Express', 0, 6, 9, 0, 0, 0),
('1122', 'USD', '2018', NULL, '1122005', 0, 'Otras Tarjetas', 0, 6, 10, 0, 0, 0),
('1131', 'USD', '2018', NULL, '1131001', 0, 'Otras por cobrar Garantías', 0, 7, 11, 0, 0, 0),
('1131', 'USD', '2018', NULL, '1131002', 0, 'Otras por cobrar', 0, 7, 12, 0, 0, 0),
('1131', 'USD', '2018', NULL, '1131003', 0, 'Anticipo Dividendos Socios', 0, 7, 13, 0, 0, 0),
('1131', 'USD', '2018', NULL, '1131004', 0, 'Anticipo de Proveedores', 0, 7, 14, 0, 0, 0),
('1133', 'USD', '2018', NULL, '1133001', 0, 'Anticipo Empleado', 0, 8, 15, 0, 0, 0),
('1133', 'USD', '2018', NULL, '1133002', 0, 'Prestamos Empleados', 0, 8, 16, 0, 0, 0),
('1133', 'USD', '2018', NULL, '1133003', 0, 'Anticipo Utilidades Empleados', 0, 8, 17, 0, 0, 0),
('1133', 'USD', '2018', NULL, '1133004', 0, 'Consumo Empleados', 0, 8, 18, 0, 0, 0),
('1133', 'USD', '2018', NULL, '1133005', 0, 'Seguro medico empleados', 0, 8, 19, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134001', 0, '306-2% Compras Locales Mat. Prima', 0, 9, 20, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134003', 0, 'IVA Retenciones Recibidas', 0, 9, 21, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134004', 0, '328-0.3% Combustibles a Distribuidores', 0, 9, 22, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134005', 0, 'Impuestos por Pagar', 0, 9, 23, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134006', 0, '329-2% Otros Bienes y Servicios', 0, 9, 24, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134007', 0, '330-25% Pagos de Dividendos Anticipados', 0, 9, 25, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134008', 0, '331-1% Energia', 0, 9, 26, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134009', 0, '331-2% Agua, y Telecom.', 0, 9, 27, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134010', 0, '332-No sujetos a Retención', 0, 9, 28, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134011', 0, '332-No sujetos a Retención', 0, 9, 29, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134012', 0, '335-2% Por Actividades de Construcción de O.M.', 0, 9, 30, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134013', 0, '340-Aplicables 1%', 0, 9, 31, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134014', 0, '505A - 22% Pago al exterior – Intereses de créditos de Instituciones Financieras del exterior', 0, 9, 32, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134015', 0, '505B - 22% Pago al exterior – Intereses de créditos de gobierno a gobierno', 0, 9, 33, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134016', 0, '505C - 22% Pago al exterior – Intereses de créditos de organismos multilaterales', 0, 9, 34, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134017', 0, '505D - 22% Pago al exterior - Intereses por financiamiento de proveedores externos', 0, 9, 35, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134018', 0, '505E - 22% Pago al exterior - Intereses de otros créditos externos', 0, 9, 36, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134019', 0, '505F - 22% Pago al exterior - Otros Intereses y Rendimientos Financieros', 0, 9, 37, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134020', 0, '509 - 22% Pago al exterior - Cánones, derechos de autor,  marcas, patentes y similares', 0, 9, 38, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134021', 0, '509A - 22% Pago al exterior - Regalías por concepto de franquicias', 0, 9, 39, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134022', 0, '510 - 22% Pago al exterior - Ganancias de capital', 0, 9, 40, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134023', 0, '511 - 22% Pago al exterior - Servicios profesionales independientes', 0, 9, 41, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134024', 0, '341-Impuesto Exportación al banano 2%', 0, 9, 42, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134026', 0, '513 - 22% Pago al exterior - Artistas', 0, 9, 43, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134027', 0, '513A - 22% Pago al exterior - Deportistas', 0, 9, 44, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134028', 0, '514 - 22% Pago al exterior - Participación de consejeros', 0, 9, 45, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134029', 0, '515 - 22% Pago al exterior - Entretenimiento Público', 0, 9, 46, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134030', 0, '516 - 22% Pago al exterior - Pensiones', 0, 9, 47, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134031', 0, '517 - 22% Pago al exterior - Reembolso de Gastos', 0, 9, 48, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134032', 0, '518 - 22% Pago al exterior - Funciones Públicas', 0, 9, 49, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134033', 0, '519 - 22% Pago al exterior - Estudiantes', 0, 9, 50, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134034', 0, '520 - 22% Pago al exterior - Otros conceptos de ingresos gravados', 0, 9, 51, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134035', 0, '342-Aplicables 8%', 0, 9, 52, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134036', 0, '520A - 22% Pago al exterior - Pago a proveedores de servicios hoteleros y turísticos en el exterior', 0, 9, 53, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134037', 0, '520B - 22% Pago al exterior - Arrendamientos mercantil internacional', 0, 9, 54, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134038', 0, '520D - 22% Pago al exterior - Comisiones por exportaciones y por promoción de turismo receptivo', 0, 9, 55, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134039', 0, '520E - 22% Pago al exterior - Por las empresas de transporte marítimo o aéreo y por empresas pesqueras de alta mar, por su actividad.', 0, 9, 56, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134040', 0, '520F - 22% Pago al exterior - Por las agencias internacionales de prensa', 0, 9, 57, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134041', 0, '520G - 22% Pago al exterior - Contratos de fletamento de naves para empresas de transporte aéreo o marítimo internacional', 0, 9, 58, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134042', 0, '521 - 5% Pago al exterior - Enajenación de derechos representativos de capital y otros derechos', 0, 9, 59, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134043', 0, '522A - 22% Pago al exterior - Servicios técnicos, administrativos o de consultoría y regalías con convenio de doble tributación', 0, 9, 60, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134044', 0, '523A - 22% Pago al exterior - Seguros y reaseguros (primas y cesiones)  con convenio de doble tributación', 0, 9, 61, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134045', 0, '524 - 22% Pago al exterior - Otros pagos al exterior no sujetos a retención', 0, 9, 62, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134046', 0, '343-Aplicables 25%', 0, 9, 63, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134047', 0, '525 - 100% Pago al exterior - Donaciones en dinero -Impuesto a la donaciones', 0, 9, 64, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134048', 0, '309-Publicidad y Comunicación 1%', 0, 9, 65, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134049', 0, '304-Honorarios Prof. y Dietas 8%', 0, 9, 66, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134050', 0, '303-Honorarios Prof. y Dietas 10%', 0, 9, 67, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134051', 0, 'Débito Bancario', 0, 9, 68, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134052', 0, '312 - 1% Transferencia de Bienes y Servicios', 0, 9, 69, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134053', 0, '301-Ret. Fte. Relación de dependencia No Supp.', 0, 9, 70, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134054', 0, '302-Relación Dependencia Super. Base', 0, 9, 71, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134055', 0, '304-2% Remuneraciones a Otros Trabajadores Aut.', 0, 9, 72, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134056', 0, '305-25% Honorarios Extranjeros por Servicios', 0, 9, 73, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134057', 0, '307-2% Por Compras Locales no Produ. Soc.', 0, 9, 74, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134058', 0, '308-Compras Bienes no sujetas a Ret.', 0, 9, 75, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134059', 0, '309-2% Por Suministros y Materiales', 0, 9, 76, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134060', 0, '310-2% Por Repuestos y Herramientas', 0, 9, 77, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134061', 0, '311-2% Por Lubricantes', 0, 9, 78, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134062', 0, '312-2% Por Activos Fijos', 0, 9, 79, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134063', 0, '313-1% Por Servicio de Transporte Privado Pas.o Carg.', 0, 9, 80, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134064', 0, '314-5% Por Regalías, Derechos de Autor', 0, 9, 81, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134065', 0, '314-8% Por Regalías, Derechos de Autor', 0, 9, 82, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134066', 0, '315-5% Por Remuneración a Deportistas', 0, 9, 83, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134067', 0, '316-8% Por Pago a Notarios,Reg.', 0, 9, 84, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134068', 0, '317-2% Por Comisiones Pagadas a Sociedades', 0, 9, 85, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134069', 0, '318-2% Por Promoción y Publicidad', 0, 9, 86, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134070', 0, '319-2% Por Arriendo Mercantil', 0, 9, 87, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134071', 0, '320-8% Arrendamiento Bienes Im.Per.Nat.', 0, 9, 88, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134072', 0, '321-5% Arrendamiento Bienes Im.Soc.', 0, 9, 89, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134073', 0, '322-2% Por Seguros y Reaseguros', 0, 9, 90, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134074', 0, '323-5% Por Rendimientos Financieros', 0, 9, 91, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134075', 0, '324-1% Por Pagos o Créditos en Emiso.Tarj.', 0, 9, 92, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134076', 0, '325-15% Loterías,Rifas, Apuestas', 0, 9, 93, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134077', 0, '326-1% Por Intereses y Comisiones', 0, 9, 94, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134078', 0, '304-8% Honorarios, Comisiones, Dietas', 0, 9, 95, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134079', 0, '307-2% Servicios predomina la mano de obra', 0, 9, 96, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134080', 0, '344-2% Aplicables', 0, 9, 97, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134081', 0, '304C - 8% Pagos a deportistas, entrenadores, árbitros, miembros del cuerpo técnico por sus actividades ejercidas como tales', 0, 9, 98, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134082', 0, '304D - 8% Pagos a artistas por sus actividades ejercidas como tales', 0, 9, 99, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134083', 0, '304E - 8% Honorarios y demás pagos por servicios de docencia', 0, 9, 100, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134084', 0, '314D - 8% Cánones, derechos de autor,  marcas, patentes y similares de acuerdo a Ley de Propiedad Intelectual – pago a sociedades', 0, 9, 101, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134085', 0, '314C - 8% Regalías por concepto de franquicias de acuerdo a Ley de Propiedad Intelectual  - pago a sociedades', 0, 9, 102, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134086', 0, '332B - 0% Compra de bienes inmuebles', 0, 9, 103, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134087', 0, '323A - 2% Por RF: depósitos Cta. Corriente', 0, 9, 104, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134088', 0, '332C - 0% Transporte público de pasajeros', 0, 9, 105, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134089', 0, '325A - 22% Dividendos anticipados préstamos accionistas, beneficiarios o participes', 0, 9, 106, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134090', 0, '332D - 0% Pagos en el país por transporte de pasajeros o transporte internacional de carga, a compañías nacionales o extranjeras de aviación o marítimas', 0, 9, 107, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134091', 0, '324B - 1% Por RF: Por inversiones entre instituciones del sistema financiero y entidades economía popular y solidaria.', 0, 9, 108, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134092', 0, '332A - 0% Enajenación de derechos representativos de capital y otros derechos exentos (mayo 2016)', 0, 9, 109, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134093', 0, '323R - 0% Por RF: Otros intereses y rendimientos financieros exentos', 0, 9, 110, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134094', 0, '323Q - 2% Por RF: Otros intereses y rendimientos financieros gravados', 0, 9, 111, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134095', 0, '323P - 2% Por RF: Intereses pagados por entidades del sector público a favor de sujetos pasivos', 0, 9, 112, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134096', 0, '323O - 0% Por RF: Intereses pagados a bancos y otras entidades sometidas al control de la Superintendencia de Bancos y de la Economía Popular y Solidaria', 0, 9, 113, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134097', 0, '323N - 0% Por RF: Inversiones en títulos valores en renta fija exentos', 0, 9, 114, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134098', 0, '323M - 2% Por RF: Inversiones en títulos valores en renta fija gravados', 0, 9, 115, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134099', 0, '323I - 2% Por RF: bonos convertible en acciones', 0, 9, 116, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134100', 0, '323H - 2% Por RF: obligaciones', 0, 9, 117, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134101', 0, '323G - 2% Por RF: inversiones (captaciones) rendimientos distintos de aquellos pagados a IFIs', 0, 9, 118, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134102', 0, '323F - 2% Por rendimientos financieros: operaciones de reporto - repos', 0, 9, 119, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134103', 0, '323E2 - 0% Por RF: depósito a plazo fijo exentos', 0, 9, 120, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134104', 0, '323E - 2% Por RF: depósito a plazo fijo  gravados', 0, 9, 121, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134105', 0, '323B1 - 2% Por RF:  depósitos Cta. Ahorros Sociedades', 0, 9, 122, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134106', 0, '332E - 0% Valores entregados por las cooperativas de transporte a sus socios', 0, 9, 123, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134107', 0, '332F - 0% Compraventa de divisas distintas al dólar de los Estados Unidos de América', 0, 9, 124, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134108', 0, '332G - 0% Pagos con tarjeta de crédito', 0, 9, 125, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134109', 0, '332H - 0% Pago al exterior tarjeta de crédito reportada por la Emisora de tarjeta de crédito, solo RECAP', 0, 9, 126, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134110', 0, '334 - 1% Enajenación de derechos representativos de capital y otros derechos no cotizados en bolsa ecuatoriana', 0, 9, 127, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134111', 0, '336 - 0.002% Por venta de combustibles a comercializadoras', 0, 9, 128, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134112', 0, '337 - 0.003% Por venta de combustibles a distribuidores', 0, 9, 129, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134113', 0, '338 - 2% Compra local de banano a productor', 0, 9, 130, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134114', 0, '339 - 100%  Liquidación impuesto único a la venta local de banano de producción propia', 0, 9, 131, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134115', 0, '343B - 1% Por actividades de construcción de obra material inmueble, urbanización, lotización o actividades similares', 0, 9, 132, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134116', 0, '344A - 2% Pago local tarjeta de crédito reportada por la Emisora de tarjeta de crédito, solo RECAP', 0, 9, 133, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134117', 0, '346A - 10% Ganancias de capital', 0, 9, 134, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134118', 0, '347 - 2% Donaciones en dinero -Impuesto a la donaciones', 0, 9, 135, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134119', 0, '348 - 10% Retención a cargo del propio sujeto pasivo por la exportación de concentrados y/o elementos metálicos', 0, 9, 136, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134120', 0, '349 - 0% Retención a cargo del propio sujeto pasivo por la comercialización de productos forestales', 0, 9, 137, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134121', 0, '500 - 22% Pago al exterior - Rentas Inmobiliarias', 0, 9, 138, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134122', 0, '501 - 22% Pago al exterior - Beneficios Empresariales', 0, 9, 139, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134123', 0, '502 - 22% Pago al exterior - Servicios Empresariales', 0, 9, 140, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134124', 0, '503 - 22% Pago al exterior - Navegación Marítima y/o aérea', 0, 9, 141, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134125', 0, '504 - 0% Pago al exterior- Dividendos distribuidos a personas naturales', 0, 9, 142, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134126', 0, '504B - 22% Pago al exterior - Anticipo dividendos (excepto paraísos fiscales o de régimen de menor imposición)', 0, 9, 143, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134127', 0, '504C - 22% Pago al exterior - Dividendos anticipados préstamos accionistas, beneficiarios o partìcipes (paraísos fiscales o regímenes de menor imposición)', 0, 9, 144, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134128', 0, '504A - 0% Pago al exterior - Dividendos a sociedades', 0, 9, 145, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134129', 0, '504D - 0% Pago al exterior - Dividendos a fideicomisos', 0, 9, 146, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134130', 0, '504F - 0% Pago al exterior - Dividendos a sociedades  (paraísos fiscales)', 0, 9, 147, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134131', 0, '504G - 0% Pago al exterior - Anticipo dividendos  (paraísos fiscales)', 0, 9, 148, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134132', 0, '504H - 13% Pago al exterior - Dividendos a fideicomisos  (paraísos fiscales)', 0, 9, 149, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134133', 0, '505 - 22% Pago al exterior - Rendimientos financieros', 0, 9, 150, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134134', 0, '512 - 22% Pago al exterior - Servicios profesionales dependientes', 0, 9, 151, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134998', 0, '327-0.2% Combustibles a Comercializadoras', 0, 9, 152, 0, 0, 0),
('1134', 'USD', '2018', NULL, '1134999', 0, 'Retenciones acumuladas de RENTA ventas', 0, 9, 153, 0, 0, 0),
('1135', 'USD', '2018', NULL, '1135001', 0, 'Retenciones del Impuesto a la Renta', 0, 10, 154, 0, 0, 0),
('1135', 'USD', '2018', NULL, '1135002', 0, 'IR Anticipo Impuesto Renta', 0, 10, 155, 0, 0, 0),
('1135', 'USD', '2018', NULL, '1135003', 0, 'Retenciones IVA  recibidas', 0, 10, 156, 0, 0, 0),
('1135', 'USD', '2018', NULL, '1135004', 0, 'RIVA 100% Honorarios', 0, 10, 157, 0, 0, 0),
('1135', 'USD', '2018', NULL, '1135005', 0, 'RIVA 100% Arriendo P Nat', 0, 10, 158, 0, 0, 0),
('1135', 'USD', '2018', NULL, '1135006', 0, 'RIVA 70% Servicios', 0, 10, 159, 0, 0, 0),
('1135', 'USD', '2018', NULL, '1135007', 0, 'RIVA 30% Bienes', 0, 10, 160, 0, 0, 0),
('1135', 'USD', '2018', NULL, '1135999', 0, 'Retenciones acumuladas de IVA ventas', 0, 10, 161, 0, 0, 0),
('1141', 'USD', '2018', NULL, '1141001', 2693.38, 'Inventario Materia Prima', 0, 11, 162, 0, 0, 2693.38),
('1141', 'USD', '2018', NULL, '1141002', 0, 'Inventario Productos en Proceso', 0, 11, 163, 0, 0, 0),
('1141', 'USD', '2018', NULL, '1141003', 0, 'Inventario Productos Terminado', 0, 11, 164, 0, 0, 0),
('1211', 'USD', '2018', NULL, '1211001', 0, 'Terrenos', 0, 12, 165, 0, 0, 0),
('1211', 'USD', '2018', NULL, '1211002', 0, 'Construcciones en Tránsito', 0, 12, 166, 0, 0, 0),
('1211', 'USD', '2018', NULL, '1211003', 0, 'Maquinaria en Tránsito', 0, 12, 167, 0, 0, 0),
('1212', 'USD', '2018', NULL, '1212001', 0, 'Edificios e Instalaciones', 0, 13, 168, 0, 0, 0),
('1212', 'USD', '2018', NULL, '1212002', 0, 'Maquinaria y Herramientas', 0, 13, 169, 0, 0, 0),
('1212', 'USD', '2018', NULL, '1212003', 0, 'Muebles y Enseres', 0, 13, 170, 0, 0, 0),
('1212', 'USD', '2018', NULL, '1212004', 0, 'Equipos Cómputo y Sistema', 0, 13, 171, 0, 0, 0),
('1212', 'USD', '2018', NULL, '1212005', 0, 'Vehículos', 0, 13, 172, 0, 0, 0),
('1213', 'USD', '2018', NULL, '1213001', 0, 'Deprec. Acum. Edificios e Instalaciones', 0, 14, 173, 0, 0, 0),
('1213', 'USD', '2018', NULL, '1213002', 0, 'Deprec. Acum. Maqu. y herramienta', 0, 14, 174, 0, 0, 0),
('1213', 'USD', '2018', NULL, '1213003', 0, 'Deprec. Acum. Muebles', 0, 14, 175, 0, 0, 0),
('1213', 'USD', '2018', NULL, '1213004', 0, 'Deprec. Acum. Equip. Comp. Y herramienta', 0, 14, 176, 0, 0, 0),
('1213', 'USD', '2018', NULL, '1213005', 0, 'Deprec. Acum. Vehículos', 0, 14, 177, 0, 0, 0),
('1221', 'USD', '2018', NULL, '1221001', 0, 'Otras por cobrar Garantías L.P.', 0, 15, 178, 0, 0, 0),
('1222', 'USD', '2018', NULL, '1222001', 0, 'Otras por cobrar Garantías', 0, 16, 179, 0, 0, 0),
('2111', 'USD', '2018', NULL, '2111001', 0, 'Obligaciones Bancarias Corto Plazo', 0, 17, 180, 0, 0, 0),
('2131', 'USD', '2018', NULL, '2131001', 0, 'Socios y Relacionados', 0, 19, 181, 0, 0, 0),
('2131', 'USD', '2018', NULL, '2131002', 0, 'Otras Cuentas por Pagar Varios', 0, 19, 182, 0, 0, 0),
('2131', 'USD', '2018', NULL, '2131003', 0, 'Sobregiro caja general', 0, 19, 183, 0, 0, 0),
('2131', 'USD', '2018', NULL, '2131004', 0, 'Anticipo Cliente', 0, 19, 184, 0, 0, 0),
('2132', 'USD', '2018', NULL, '2132001', 0, 'Sueldos Por Pagar', 0, 20, 185, 0, 0, 0),
('2132', 'USD', '2018', NULL, '2132002', 0, 'Beneficios Adicionales por Pagar', 0, 20, 186, 0, 0, 0),
('2132', 'USD', '2018', NULL, '2132003', 0, 'Liquidaciones por Pagar', 0, 20, 187, 0, 0, 0),
('2132', 'USD', '2018', NULL, '2132004', 0, 'Participación Trabajadores', 0, 20, 188, 0, 0, 0),
('2132', 'USD', '2018', NULL, '2132005', 0, 'Servicios por pagar', 0, 20, 189, 0, 0, 0),
('2132', 'USD', '2018', NULL, '2132006', 0, 'Décimo Tercer Sueldo', 0, 20, 190, 0, 0, 0),
('2132', 'USD', '2018', NULL, '2132007', 0, 'Décimo Cuarto Sueldo', 0, 20, 191, 0, 0, 0),
('2132', 'USD', '2018', NULL, '2132008', 0, 'Vacaciones', 0, 20, 192, 0, 0, 0),
('2132', 'USD', '2018', NULL, '2132009', 0, 'Otros Beneficios', 0, 20, 193, 0, 0, 0),
('2132', 'USD', '2018', NULL, '2132010', 0, '10% servicios', 0, 20, 194, 0, 0, 0),
('2133', 'USD', '2018', NULL, '2133003', 255.44, '12% IVA en Ventas por pagar', 6.36, 21, 195, 0, 0, 249.08),
('2133', 'USD', '2018', NULL, '2133004', 0, 'Ice por Pagar', 0, 21, 196, 0, 0, 0),
('2133', 'USD', '2018', NULL, '2133005', 0, 'Impuesto Verde', 0, 21, 197, 0, 0, 0),
('2133', 'USD', '2018', NULL, '2133006', 0, 'Impuesto Renta por Pagar', 0, 21, 198, 0, 0, 0),
('2134', 'USD', '2018', NULL, '2134001', 0, 'IVA 100% Prestación Serv. Profesionales', 0, 22, 199, 0, 0, 0),
('2134', 'USD', '2018', NULL, '2134002', 0, 'IVA 100% Arrendamiento de Inmuebles Per. Naturales', 0, 22, 200, 0, 0, 0),
('2134', 'USD', '2018', NULL, '2134003', 0, 'IVA 100% Compras Bien.y Serv. con Liq. Compras', 0, 22, 201, 0, 0, 0),
('2134', 'USD', '2018', NULL, '2134004', 0, 'IVA 70% Prestación de Otros Servicios', 0, 22, 202, 0, 0, 0),
('2134', 'USD', '2018', NULL, '2134005', 0, 'IVA 30% Por la Compra de Bienes', 0, 22, 203, 0, 0, 0),
('2134', 'USD', '2018', NULL, '2134006', 0, 'IVA 100% OTRAS VENTAS', 0, 22, 204, 0, 0, 0),
('2134', 'USD', '2018', NULL, '2134007', 0, 'IVA 10% Por la Compra de Bienes', 0, 22, 205, 0, 0, 0),
('2134', 'USD', '2018', NULL, '2134008', 0, 'IVA 20% Prestación de Otros Servicios', 0, 22, 206, 0, 0, 0),
('2134', 'USD', '2018', NULL, '2134009', 0, 'IVA 50% Prestación de Otros Servicios', 0, 22, 207, 0, 0, 0),
('2134', 'USD', '2018', NULL, '2134999', 0, 'Retenciones acumuladas de IVA compras', 0, 22, 208, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135001', 0, '306-2% Compras Locales Mat. Prima', 0, 23, 209, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135002', 0, '327-0.2% Combustibles a Comercializadoras', 0, 23, 210, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135003', 0, 'RFIR Empleados Relac. Dependencia', 0, 23, 211, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135004', 0, '328-0.3% Combustibles a Distribuidores', 0, 23, 212, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135005', 0, 'Impuestos por Pagar', 0, 23, 213, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135006', 0, '329-2% Otros Bienes y Servicios', 0, 23, 214, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135007', 0, '330-25% Pagos de Dividendos Anticipados', 0, 23, 215, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135008', 0, '331-1% Energia', 0, 23, 216, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135009', 0, '331-2% Agua, y Telecom.', 0, 23, 217, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135010', 0, '332-No sujetos a Retención', 0, 23, 218, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135011', 0, '332-No sujetos a Retención', 0, 23, 219, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135012', 0, '335-2% Por Actividades de Construcción de O.M.', 0, 23, 220, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135013', 0, '340-Aplicables 1%', 0, 23, 221, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135014', 0, '505A - 22% Pago al exterior – Intereses de créditos de Instituciones Financieras del exterior', 0, 23, 222, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135015', 0, '505B - 22% Pago al exterior – Intereses de créditos de gobierno a gobierno', 0, 23, 223, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135016', 0, '505C - 22% Pago al exterior – Intereses de créditos de organismos multilaterales', 0, 23, 224, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135017', 0, '505D - 22% Pago al exterior - Intereses por financiamiento de proveedores externos', 0, 23, 225, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135018', 0, '505E - 22% Pago al exterior - Intereses de otros créditos externos', 0, 23, 226, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135019', 0, '505F - 22% Pago al exterior - Otros Intereses y Rendimientos Financieros', 0, 23, 227, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135020', 0, '509 - 22% Pago al exterior - Cánones, derechos de autor,  marcas, patentes y similares', 0, 23, 228, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135021', 0, '509A - 22% Pago al exterior - Regalías por concepto de franquicias', 0, 23, 229, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135022', 0, '510 - 22% Pago al exterior - Ganancias de capital', 0, 23, 230, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135023', 0, '511 - 22% Pago al exterior - Servicios profesionales independientes', 0, 23, 231, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135024', 0, '341-Impuesto Exportación al banano 2%', 0, 23, 232, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135025', 0, '512 - 22% Pago al exterior - Servicios profesionales dependientes', 0, 23, 233, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135026', 0, '513 - 22% Pago al exterior - Artistas', 0, 23, 234, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135027', 0, '513A - 22% Pago al exterior - Deportistas', 0, 23, 235, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135028', 0, '514 - 22% Pago al exterior - Participación de consejeros', 0, 23, 236, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135029', 0, '515 - 22% Pago al exterior - Entretenimiento Público', 0, 23, 237, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135030', 0, '516 - 22% Pago al exterior - Pensiones', 0, 23, 238, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135031', 0, '517 - 22% Pago al exterior - Reembolso de Gastos', 0, 23, 239, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135032', 0, '518 - 22% Pago al exterior - Funciones Públicas', 0, 23, 240, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135033', 0, '519 - 22% Pago al exterior - Estudiantes', 0, 23, 241, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135034', 0, '520 - 22% Pago al exterior - Otros conceptos de ingresos gravados', 0, 23, 242, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135035', 0, '342-Aplicables 8%', 0, 23, 243, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135036', 0, '520A - 22% Pago al exterior - Pago a proveedores de servicios hoteleros y turísticos en el exterior', 0, 23, 244, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135037', 0, '520B - 22% Pago al exterior - Arrendamientos mercantil internacional', 0, 23, 245, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135038', 0, '520D - 22% Pago al exterior - Comisiones por exportaciones y por promoción de turismo receptivo', 0, 23, 246, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135039', 0, '520E - 22% Pago al exterior - Por las empresas de transporte marítimo o aéreo y por empresas pesqueras de alta mar, por su actividad.', 0, 23, 247, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135040', 0, '520F - 22% Pago al exterior - Por las agencias internacionales de prensa', 0, 23, 248, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135041', 0, '520G - 22% Pago al exterior - Contratos de fletamento de naves para empresas de transporte aéreo o marítimo internacional', 0, 23, 249, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135042', 0, '521 - 5% Pago al exterior - Enajenación de derechos representativos de capital y otros derechos', 0, 23, 250, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135043', 0, '522A - 22% Pago al exterior - Servicios técnicos, administrativos o de consultoría y regalías con convenio de doble tributación', 0, 23, 251, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135044', 0, '523A - 22% Pago al exterior - Seguros y reaseguros (primas y cesiones)  con convenio de doble tributación', 0, 23, 252, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135045', 0, '524 - 22% Pago al exterior - Otros pagos al exterior no sujetos a retención', 0, 23, 253, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135046', 0, '343-Aplicables 25%', 0, 23, 254, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135047', 0, '525 - 100% Pago al exterior - Donaciones en dinero -Impuesto a la donaciones', 0, 23, 255, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135048', 0, '309-Publicidad y Comunicación 1%', 0, 23, 256, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135049', 0, '304-Honorarios Prof. y Dietas 8%', 0, 23, 257, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135050', 0, '303-Honorarios Prof. y Dietas 10%', 0, 23, 258, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135051', 0, 'Débito Bancario', 0, 23, 259, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135052', 0, '312 - 1% Transferencia de Bienes y Servicios', 0, 23, 260, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135053', 0, '301-Ret. Fte. Relación de dependencia No Supp.', 0, 23, 261, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135054', 0, '302-Relación Dependencia Super. Base', 0, 23, 262, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135055', 0, '304-2% Remuneraciones a Otros Trabajadores Aut.', 0, 23, 263, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135056', 0, '305-25% Honorarios Extranjeros por Servicios', 0, 23, 264, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135057', 0, '307-2% Por Compras Locales no Produ. Soc.', 0, 23, 265, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135058', 0, '308-Compras Bienes no sujetas a Ret.', 0, 23, 266, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135059', 0, '309-2% Por Suministros y Materiales', 0, 23, 267, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135060', 0, '310-2% Por Repuestos y Herramientas', 0, 23, 268, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135061', 0, '311-2% Por Lubricantes', 0, 23, 269, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135062', 0, '312-2% Por Activos Fijos', 0, 23, 270, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135063', 0, '313-1% Por Servicio de Transporte Privado Pas.o Carg.', 0, 23, 271, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135064', 0, '314-5% Por Regalías, Derechos de Autor', 0, 23, 272, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135065', 0, '314-8% Por Regalías, Derechos de Autor', 0, 23, 273, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135066', 0, '315-5% Por Remuneración a Deportistas', 0, 23, 274, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135067', 0, '316-8% Por Pago a Notarios,Reg.', 0, 23, 275, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135068', 0, '317-2% Por Comisiones Pagadas a Sociedades', 0, 23, 276, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135069', 0, '318-2% Por Promoción y Publicidad', 0, 23, 277, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135070', 0, '319-2% Por Arriendo Mercantil', 0, 23, 278, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135071', 0, '320-8% Arrendamiento Bienes Im.Per.Nat.', 0, 23, 279, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135072', 0, '321-5% Arrendamiento Bienes Im.Soc.', 0, 23, 280, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135073', 0, '322-2% Por Seguros y Reaseguros', 0, 23, 281, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135074', 0, '323-5% Por Rendimientos Financieros', 0, 23, 282, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135075', 0, '324-1% Por Pagos o Créditos en Emiso.Tarj.', 0, 23, 283, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135076', 0, '325-15% Loterías,Rifas, Apuestas', 0, 23, 284, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135077', 0, '326-1% Por Intereses y Comisiones', 0, 23, 285, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135078', 0, '304-8% Honorarios, Comisiones, Dietas', 0, 23, 286, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135079', 0, '307-2% Servicios predomina la mano de obra', 0, 23, 287, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135080', 0, '344-2% Aplicables', 0, 23, 288, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135081', 0, '304C - 8% Pagos a deportistas, entrenadores, árbitros, miembros del cuerpo técnico por sus actividades ejercidas como tales', 0, 23, 289, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135082', 0, '304D - 8% Pagos a artistas por sus actividades ejercidas como tales', 0, 23, 290, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135083', 0, '304E - 8% Honorarios y demás pagos por servicios de docencia', 0, 23, 291, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135084', 0, '314D - 8% Cánones, derechos de autor,  marcas, patentes y similares de acuerdo a Ley de Propiedad Intelectual – pago a sociedades', 0, 23, 292, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135085', 0, '314C - 8% Regalías por concepto de franquicias de acuerdo a Ley de Propiedad Intelectual  - pago a sociedades', 0, 23, 293, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135086', 0, '332B - 0% Compra de bienes inmuebles', 0, 23, 294, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135087', 0, '323A - 2% Por RF: depósitos Cta. Corriente', 0, 23, 295, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135088', 0, '332C - 0% Transporte público de pasajeros', 0, 23, 296, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135089', 0, '325A - 22% Dividendos anticipados préstamos accionistas, beneficiarios o participes', 0, 23, 297, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135090', 0, '332D - 0% Pagos en el país por transporte de pasajeros o transporte internacional de carga, a compañías nacionales o extranjeras de aviación o marítimas', 0, 23, 298, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135091', 0, '324B - 1% Por RF: Por inversiones entre instituciones del sistema financiero y entidades economía popular y solidaria.', 0, 23, 299, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135092', 0, '332A - 0% Enajenación de derechos representativos de capital y otros derechos exentos (mayo 2016)', 0, 23, 300, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135093', 0, '323R - 0% Por RF: Otros intereses y rendimientos financieros exentos', 0, 23, 301, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135094', 0, '323Q - 2% Por RF: Otros intereses y rendimientos financieros gravados', 0, 23, 302, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135095', 0, '323P - 2% Por RF: Intereses pagados por entidades del sector público a favor de sujetos pasivos', 0, 23, 303, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135096', 0, '323O - 0% Por RF: Intereses pagados a bancos y otras entidades sometidas al control de la Superintendencia de Bancos y de la Economía Popular y Solidaria', 0, 23, 304, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135097', 0, '323N - 0% Por RF: Inversiones en títulos valores en renta fija exentos', 0, 23, 305, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135098', 0, '323M - 2% Por RF: Inversiones en títulos valores en renta fija gravados', 0, 23, 306, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135099', 0, '323I - 2% Por RF: bonos convertible en acciones', 0, 23, 307, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135100', 0, '323H - 2% Por RF: obligaciones', 0, 23, 308, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135101', 0, '323G - 2% Por RF: inversiones (captaciones) rendimientos distintos de aquellos pagados a IFIs', 0, 23, 309, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135102', 0, '323F - 2% Por rendimientos financieros: operaciones de reporto - repos', 0, 23, 310, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135103', 0, '323E2 - 0% Por RF: depósito a plazo fijo exentos', 0, 23, 311, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135104', 0, '323E - 2% Por RF: depósito a plazo fijo  gravados', 0, 23, 312, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135105', 0, '323B1 - 2% Por RF:  depósitos Cta. Ahorros Sociedades', 0, 23, 313, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135106', 0, '332E - 0% Valores entregados por las cooperativas de transporte a sus socios', 0, 23, 314, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135107', 0, '332F - 0% Compraventa de divisas distintas al dólar de los Estados Unidos de América', 0, 23, 315, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135108', 0, '332G - 0% Pagos con tarjeta de crédito', 0, 23, 316, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135109', 0, '332H - 0% Pago al exterior tarjeta de crédito reportada por la Emisora de tarjeta de crédito, solo RECAP', 0, 23, 317, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135110', 0, '334 - 1% Enajenación de derechos representativos de capital y otros derechos no cotizados en bolsa ecuatoriana', 0, 23, 318, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135111', 0, '336 - 0.002% Por venta de combustibles a comercializadoras', 0, 23, 319, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135112', 0, '337 - 0.003% Por venta de combustibles a distribuidores', 0, 23, 320, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135114', 0, '338 - 2% Compra local de banano a productor', 0, 23, 321, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135115', 0, '339 - 100%  Liquidación impuesto único a la venta local de banano de producción propia', 0, 23, 322, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135116', 0, '343B - 1% Por actividades de construcción de obra material inmueble, urbanización, lotización o actividades similares', 0, 23, 323, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135117', 0, '344A - 2% Pago local tarjeta de crédito reportada por la Emisora de tarjeta de crédito, solo RECAP', 0, 23, 324, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135118', 0, '346A - 10% Ganancias de capital', 0, 23, 325, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135119', 0, '347 - 2% Donaciones en dinero -Impuesto a la donaciones', 0, 23, 326, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135120', 0, '348 - 10% Retención a cargo del propio sujeto pasivo por la exportación de concentrados y/o elementos metálicos', 0, 23, 327, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135121', 0, '349 - 0% Retención a cargo del propio sujeto pasivo por la comercialización de productos forestales', 0, 23, 328, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135122', 0, '500 - 22% Pago al exterior - Rentas Inmobiliarias', 0, 23, 329, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135123', 0, '501 - 22% Pago al exterior - Beneficios Empresariales', 0, 23, 330, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135124', 0, '502 - 22% Pago al exterior - Servicios Empresariales', 0, 23, 331, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135127', 0, '503 - 22% Pago al exterior - Navegación Marítima y/o aérea', 0, 23, 332, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135128', 0, '504 - 0% Pago al exterior- Dividendos distribuidos a personas naturales', 0, 23, 333, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135129', 0, '504B - 22% Pago al exterior - Anticipo dividendos (excepto paraísos fiscales o de régimen de menor imposición)', 0, 23, 334, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135130', 0, '504C - 22% Pago al exterior - Dividendos anticipados préstamos accionistas, beneficiarios o partìcipes (paraísos fiscales o regímenes de menor imposición)', 0, 23, 335, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135131', 0, '504A - 0% Pago al exterior - Dividendos a sociedades', 0, 23, 336, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135132', 0, '504D - 0% Pago al exterior - Dividendos a fideicomisos', 0, 23, 337, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135134', 0, '504F - 0% Pago al exterior - Dividendos a sociedades  (paraísos fiscales)', 0, 23, 338, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135135', 0, '504G - 0% Pago al exterior - Anticipo dividendos  (paraísos fiscales)', 0, 23, 339, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135136', 0, '504H - 13% Pago al exterior - Dividendos a fideicomisos  (paraísos fiscales)', 0, 23, 340, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135137', 0, '505 - 22% Pago al exterior - Rendimientos financieros', 0, 23, 341, 0, 0, 0),
('2135', 'USD', '2018', NULL, '2135999', 0, 'Retenciones acumuladas de RENTA compras', 0, 23, 342, 0, 0, 0),
('2136', 'USD', '2018', NULL, '2136001', 0, 'Iess por Pagar', 0, 24, 343, 0, 0, 0),
('2136', 'USD', '2018', NULL, '2136002', 0, 'Fondo de Reserva por Pagar', 0, 24, 344, 0, 0, 0),
('2136', 'USD', '2018', NULL, '2136003', 0, 'Préstamo Quirografarios', 0, 24, 345, 0, 0, 0),
('2136', 'USD', '2018', NULL, '2136004', 0, 'Préstamo Hipotecarios', 0, 24, 346, 0, 0, 0),
('2211', 'USD', '2018', NULL, '2211001', 0, 'Obligación Bancarias Largo Plazo', 0, 25, 347, 0, 0, 0),
('311', 'USD', '2018', NULL, '3110001', 0, 'Capital Suscrito', 0, 26, 348, 0, 0, 0),
('311', 'USD', '2018', NULL, '3110002', 0, 'Capital Pagado', 0, 26, 349, 0, 0, 0),
('312', 'USD', '2018', NULL, '3120001', 0, 'Aporte Capital 1', 0, 27, 350, 0, 0, 0),
('313', 'USD', '2018', NULL, '3130001', 0, 'Reserva Legal', 0, 28, 351, 0, 0, 0),
('313', 'USD', '2018', NULL, '3130002', 0, 'Reserva Facultativa', 0, 28, 352, 0, 0, 0),
('331', 'USD', '2018', NULL, '3310001', 0, 'Utilidades Retenidas', 0, 29, 353, 0, 0, 0),
('332', 'USD', '2018', NULL, '3320001', 0, 'Resultado del Ejercicio', 0, 30, 354, 0, 0, 0),
('411', 'USD', '2018', NULL, '4110001', 26.25, 'Ventas Productos', 70.39, 31, 355, 0, 0, -44.14),
('4121', 'USD', '2018', NULL, '4121001', 0, 'Ventas Productos', 0, 32, 356, 0, 0, 0),
('4121', 'USD', '2018', NULL, '4121002', 0, 'Ventas otros', 0, 32, 357, 0, 0, 0),
('4122', 'USD', '2018', NULL, '4122001', 0, 'Descuento en Ventas', 0, 33, 358, 0, 0, 0),
('4122', 'USD', '2018', NULL, '4122002', 0, 'Devolución Ventas', 0, 33, 359, 0, 0, 0),
('4123', 'USD', '2018', NULL, '4123001', 0, 'OTROS INGRESOS OPERACIONES', 0, 34, 360, 0, 0, 0),
('421', 'USD', '2018', NULL, '4210001', 0, 'Otros Ingresos', 0, 35, 361, 0, 0, 0),
('511', 'USD', '2018', NULL, '5110001', 0, 'Costos de materia prima', 0, 36, 362, 0, 0, 0),
('512', 'USD', '2018', NULL, '5120001', 0, 'Costo Sueldos y Salarios', 0, 37, 363, 0, 0, 0),
('512', 'USD', '2018', NULL, '5120002', 0, 'Costo horas extras', 0, 37, 364, 0, 0, 0),
('512', 'USD', '2018', NULL, '5120003', 0, 'Costo Días completos', 0, 37, 365, 0, 0, 0),
('512', 'USD', '2018', NULL, '5120004', 0, 'Costo Fondo Reserva Iess', 0, 37, 366, 0, 0, 0),
('512', 'USD', '2018', NULL, '5120005', 0, 'Costo Eventos', 0, 37, 367, 0, 0, 0),
('512', 'USD', '2018', NULL, '5120006', 0, 'Costo Décimo Tercero', 0, 37, 368, 0, 0, 0),
('512', 'USD', '2018', NULL, '5120007', 0, 'Costo Décimo Cuarto', 0, 37, 369, 0, 0, 0),
('512', 'USD', '2018', NULL, '5120008', 0, 'Costo acuerdos de sueldo', 0, 37, 370, 0, 0, 0),
('512', 'USD', '2018', NULL, '5120009', 0, 'Costo Aporte Patronal IESS', 0, 37, 371, 0, 0, 0),
('512', 'USD', '2018', NULL, '5120010', 0, 'Costo Alimentación', 0, 37, 372, 0, 0, 0),
('512', 'USD', '2018', NULL, '5120011', 0, 'Costo Bonos', 0, 37, 373, 0, 0, 0),
('512', 'USD', '2018', NULL, '5120012', 0, 'Costo días pendientes', 0, 37, 374, 0, 0, 0),
('512', 'USD', '2018', NULL, '5120013', 0, 'Costo seguros de vida medio tiempo', 0, 37, 375, 0, 0, 0),
('512', 'USD', '2018', NULL, '5120014', 0, 'Costo Uniformes', 0, 37, 376, 0, 0, 0),
('512', 'USD', '2018', NULL, '5120015', 0, 'Costo Liquidaciones', 0, 37, 377, 0, 0, 0),
('512', 'USD', '2018', NULL, '5120016', 0, 'Costo personal en ldc', 0, 37, 378, 0, 0, 0),
('512', 'USD', '2018', NULL, '5120017', 0, 'Costos Servicios Ocasionales', 0, 37, 379, 0, 0, 0),
('512', 'USD', '2018', NULL, '5120018', 0, 'Costo capacitación', 0, 37, 380, 0, 0, 0),
('512', 'USD', '2018', NULL, '5120019', 0, 'Costos Servicios Médicos Empleados', 0, 37, 381, 0, 0, 0),
('513', 'USD', '2018', NULL, '5130001', 0, 'Costo Arriendo', 0, 38, 382, 0, 0, 0),
('513', 'USD', '2018', NULL, '5130002', 0, 'Costo Arriendo Software', 0, 38, 383, 0, 0, 0),
('513', 'USD', '2018', NULL, '5130003', 0, 'Costo mantenimiento sistemas', 0, 38, 384, 0, 0, 0),
('513', 'USD', '2018', NULL, '5130004', 0, 'Costo servicios legales', 0, 38, 385, 0, 0, 0),
('513', 'USD', '2018', NULL, '5130005', 0, 'Costo Fletes', 0, 38, 386, 0, 0, 0),
('513', 'USD', '2018', NULL, '5130006', 0, 'Costo Combustibles y lubricantes', 0, 38, 387, 0, 0, 0),
('513', 'USD', '2018', NULL, '5130007', 0, 'Costo Luz', 0, 38, 388, 0, 0, 0),
('513', 'USD', '2018', NULL, '5130008', 0, 'Costo Teléfono', 0, 38, 389, 0, 0, 0),
('513', 'USD', '2018', NULL, '5130009', 0, 'Costo Agua', 0, 38, 390, 0, 0, 0),
('513', 'USD', '2018', NULL, '5130010', 0, 'Costo Internet', 0, 38, 391, 0, 0, 0),
('513', 'USD', '2018', NULL, '5130011', 0, 'Costo Suministros', 0, 38, 392, 0, 0, 0),
('513', 'USD', '2018', NULL, '5130012', 0, 'Costo Imprenta', 0, 38, 393, 0, 0, 0),
('513', 'USD', '2018', NULL, '5130013', 0, 'Costo mantenimiento computación', 0, 38, 394, 0, 0, 0),
('513', 'USD', '2018', NULL, '5130014', 0, 'Costo mantenimiento equipos fríos', 0, 38, 395, 0, 0, 0),
('513', 'USD', '2018', NULL, '5130015', 0, 'Costo gas', 0, 38, 396, 0, 0, 0),
('513', 'USD', '2018', NULL, '5130016', 0, 'Costo Vigilancia Privada', 0, 38, 397, 0, 0, 0),
('513', 'USD', '2018', NULL, '5130017', 0, 'Costo Transporte y movilización', 0, 38, 398, 0, 0, 0),
('513', 'USD', '2018', NULL, '5130018', 0, 'Costo Depreciaciones', 0, 38, 399, 0, 0, 0),
('513', 'USD', '2018', NULL, '5130019', 0, 'Costo Impuestos y Contribuyente', 0, 38, 400, 0, 0, 0),
('513', 'USD', '2018', NULL, '5130020', 0, 'Costos Menores', 0, 38, 401, 0, 0, 0),
('611', 'USD', '2018', NULL, '6110001', 0, 'GA Gastos Sueldos y Salarios', 0, 39, 402, 0, 0, 0),
('611', 'USD', '2018', NULL, '6110002', 0, 'GA Horas Extras', 0, 39, 403, 0, 0, 0),
('611', 'USD', '2018', NULL, '6110003', 0, 'GA Días completos', 0, 39, 404, 0, 0, 0),
('611', 'USD', '2018', NULL, '6110004', 0, 'GA Gasto Fondo Reserva IESS', 0, 39, 405, 0, 0, 0),
('611', 'USD', '2018', NULL, '6110005', 0, 'GA Eventos', 0, 39, 406, 0, 0, 0),
('611', 'USD', '2018', NULL, '6110006', 0, 'GA Décimo Tercero', 0, 39, 407, 0, 0, 0),
('611', 'USD', '2018', NULL, '6110007', 0, 'GA Décimo Cuarto', 0, 39, 408, 0, 0, 0),
('611', 'USD', '2018', NULL, '6110008', 0, 'GA acuerdos de sueldo', 0, 39, 409, 0, 0, 0),
('611', 'USD', '2018', NULL, '6110009', 0, 'GA Aporte Patronal IESS', 0, 39, 410, 0, 0, 0),
('611', 'USD', '2018', NULL, '6110010', 0, 'GA Alimentación', 0, 39, 411, 0, 0, 0),
('611', 'USD', '2018', NULL, '6110011', 0, 'GA Bonos', 0, 39, 412, 0, 0, 0),
('611', 'USD', '2018', NULL, '6110012', 0, 'GA días pendientes', 0, 39, 413, 0, 0, 0),
('611', 'USD', '2018', NULL, '6110013', 0, 'GA seguro de vida medio tiempo', 0, 39, 414, 0, 0, 0),
('611', 'USD', '2018', NULL, '6110014', 0, 'GA Uniformes', 0, 39, 415, 0, 0, 0),
('611', 'USD', '2018', NULL, '6110015', 0, 'GA Gastos Liquidaciones', 0, 39, 416, 0, 0, 0),
('611', 'USD', '2018', NULL, '6110016', 0, 'GA personal en ldc', 0, 39, 417, 0, 0, 0),
('611', 'USD', '2018', NULL, '6110017', 0, 'GA Servicios Ocasionales', 0, 39, 418, 0, 0, 0),
('611', 'USD', '2018', NULL, '6110018', 0, 'GA capacitación', 0, 39, 419, 0, 0, 0),
('611', 'USD', '2018', NULL, '6110099', 0, 'Otros Menores', 0, 39, 420, 0, 0, 0),
('612', 'USD', '2018', NULL, '6120001', 0, 'GA Arriendo oficina', 0, 40, 421, 0, 0, 0),
('612', 'USD', '2018', NULL, '6120002', 0, 'GA gasto empleados', 0, 40, 422, 0, 0, 0),
('612', 'USD', '2018', NULL, '6120003', 0, 'GA de terceros', 0, 40, 423, 0, 0, 0),
('612', 'USD', '2018', NULL, '6120004', 0, 'GA servicios básicos', 0, 40, 424, 0, 0, 0),
('612', 'USD', '2018', NULL, '6120005', 0, 'GA gas', 0, 40, 425, 0, 0, 0),
('612', 'USD', '2018', NULL, '6120006', 0, 'GA gastos varios', 0, 40, 426, 0, 0, 0),
('612', 'USD', '2018', NULL, '6120007', 0, 'GA SRI retenciones', 0, 40, 427, 0, 0, 0),
('612', 'USD', '2018', NULL, '6120008', 0, 'GA IVA', 0, 40, 428, 0, 0, 0),
('612', 'USD', '2018', NULL, '6120009', 0, 'GA nutricionista', 0, 40, 429, 0, 0, 0),
('612', 'USD', '2018', NULL, '6120010', 0, 'GA depreciación', 0, 40, 430, 0, 0, 0),
('612', 'USD', '2018', NULL, '6120011', 0, 'GA soporte técnico computarizado', 0, 40, 431, 0, 0, 0),
('612', 'USD', '2018', NULL, '6120012', 0, 'GA publicidad', 0, 40, 432, 0, 0, 0),
('612', 'USD', '2018', NULL, '6120013', 0, 'GA asesoría legal', 0, 40, 433, 0, 0, 0),
('612', 'USD', '2018', NULL, '6120014', 0, 'GA vacaciones finiquitos', 0, 40, 434, 0, 0, 0),
('612', 'USD', '2018', NULL, '6120015', 0, 'GA Vigilancia Privada', 0, 40, 435, 0, 0, 0),
('612', 'USD', '2018', NULL, '6120016', 0, 'GA Mantenimiento y Limpieza', 0, 40, 436, 0, 0, 0),
('612', 'USD', '2018', NULL, '6120017', 0, 'GA Servicios Contables', 0, 40, 437, 0, 0, 0),
('612', 'USD', '2018', NULL, '6120018', 0, 'GA Honorarios', 0, 40, 438, 0, 0, 0),
('612', 'USD', '2018', NULL, '6120019', 0, 'GA Combustibles y Lubricantes', 0, 40, 439, 0, 0, 0),
('612', 'USD', '2018', NULL, '6120020', 0, 'GA Útiles Oficina y Suministros', 0, 40, 440, 0, 0, 0),
('612', 'USD', '2018', NULL, '6120021', 0, 'GA Internet, correo, otros', 0, 40, 441, 0, 0, 0),
('612', 'USD', '2018', NULL, '6120022', 0, 'GA Suscripciones y Publicaciones', 0, 40, 442, 0, 0, 0),
('612', 'USD', '2018', NULL, '6120023', 0, 'GA Impuestos, tasa y otros', 0, 40, 443, 0, 0, 0),
('612', 'USD', '2018', NULL, '6120024', 0, 'GA Cuentas Incobrables', 0, 40, 444, 0, 0, 0),
('612', 'USD', '2018', NULL, '6120025', 0, 'GA Perdida en venta de activos', 0, 40, 445, 0, 0, 0);
INSERT INTO `co_subcuentas` (`codcuenta`, `coddivisa`, `codejercicio`, `codimpuesto`, `codsubcuenta`, `debe`, `descripcion`, `haber`, `idcuenta`, `idsubcuenta`, `iva`, `recargo`, `saldo`) VALUES
('612', 'USD', '2018', NULL, '6120026', 0, 'GA Gasto Imp a la renta', 0, 40, 446, 0, 0, 0),
('612', 'USD', '2018', NULL, '6120027', 0, 'GA Gasto 15% participación trabajadores', 0, 40, 447, 0, 0, 0),
('612', 'USD', '2018', NULL, '6120028', 0, 'GA Mantenimiento vehículos', 0, 40, 448, 0, 0, 0),
('612', 'USD', '2018', NULL, '6120029', 0, 'GA No deducibles', 0, 40, 449, 0, 0, 0),
('612', 'USD', '2018', NULL, '6120030', 0, 'GA fletes', 0, 40, 450, 0, 0, 0),
('612', 'USD', '2018', NULL, '6120031', 0, 'GA Gastos Médicos Empleados', 0, 40, 451, 0, 0, 0),
('612', 'USD', '2018', NULL, '6120032', 0, 'GA Mantenimiento vehículos', 0, 40, 452, 0, 0, 0),
('612', 'USD', '2018', NULL, '6120033', 0, 'GA No deducibles', 0, 40, 453, 0, 0, 0),
('612', 'USD', '2018', NULL, '6120034', 0, 'GA Perdida por Robo Locales', 0, 40, 454, 0, 0, 0),
('612', 'USD', '2018', NULL, '6120035', 0, 'GA Gastos Médicos Empleados', 0, 40, 455, 0, 0, 0),
('612', 'USD', '2018', NULL, '6120036', 0, 'GA telefonía celular', 0, 40, 456, 0, 0, 0),
('612', 'USD', '2018', NULL, '6120037', 0, 'GA material mal estado', 0, 40, 457, 0, 0, 0),
('612', 'USD', '2018', NULL, '6120038', 0, 'GA material mal estado', 0, 40, 458, 0, 0, 0),
('612', 'USD', '2018', NULL, '6120039', 0, 'Gasto IVA', 0, 40, 459, 0, 0, 0),
('612', 'USD', '2018', NULL, '6120099', 0, 'Gastos Menores', 0, 40, 460, 0, 0, 0),
('621', 'USD', '2018', NULL, '6210001', 0, 'GV Gastos Sueldos y Salarios', 0, 41, 461, 0, 0, 0),
('621', 'USD', '2018', NULL, '6210002', 0, 'GV Horas Extras', 0, 41, 462, 0, 0, 0),
('621', 'USD', '2018', NULL, '6210003', 0, 'GV Días completos', 0, 41, 463, 0, 0, 0),
('621', 'USD', '2018', NULL, '6210004', 0, 'GV Gasto Fondo Reserva IESS', 0, 41, 464, 0, 0, 0),
('621', 'USD', '2018', NULL, '6210005', 0, 'GV Eventos', 0, 41, 465, 0, 0, 0),
('621', 'USD', '2018', NULL, '6210006', 0, 'GV Décimo Tercero', 0, 41, 466, 0, 0, 0),
('621', 'USD', '2018', NULL, '6210007', 0, 'GV Décimo Cuarto', 0, 41, 467, 0, 0, 0),
('621', 'USD', '2018', NULL, '6210008', 0, 'GV acuerdos de sueldo', 0, 41, 468, 0, 0, 0),
('621', 'USD', '2018', NULL, '6210009', 0, 'GV Aporte Patronal IESS', 0, 41, 469, 0, 0, 0),
('621', 'USD', '2018', NULL, '6210010', 0, 'GV Alimentación', 0, 41, 470, 0, 0, 0),
('621', 'USD', '2018', NULL, '6210011', 0, 'GV Bonos', 0, 41, 471, 0, 0, 0),
('621', 'USD', '2018', NULL, '6210012', 0, 'GV días pendientes', 0, 41, 472, 0, 0, 0),
('621', 'USD', '2018', NULL, '6210013', 0, 'GV seguro de vida medio tiempo', 0, 41, 473, 0, 0, 0),
('621', 'USD', '2018', NULL, '6210014', 0, 'GV Uniformes', 0, 41, 474, 0, 0, 0),
('621', 'USD', '2018', NULL, '6210015', 0, 'GV Gastos Liquidaciones', 0, 41, 475, 0, 0, 0),
('621', 'USD', '2018', NULL, '6210016', 0, 'GV personal en ldc', 0, 41, 476, 0, 0, 0),
('621', 'USD', '2018', NULL, '6210017', 0, 'GV Servicios Ocasionales', 0, 41, 477, 0, 0, 0),
('621', 'USD', '2018', NULL, '6210018', 0, 'GV capacitación', 0, 41, 478, 0, 0, 0),
('621', 'USD', '2018', NULL, '6210099', 0, 'GV Otros Menores', 0, 41, 479, 0, 0, 0),
('622', 'USD', '2018', NULL, '6220001', 0, 'GV Arriendo Locales', 0, 42, 480, 0, 0, 0),
('622', 'USD', '2018', NULL, '6220002', 0, 'GV Servicios Básicos Luz, Agua y Teléfono', 0, 42, 481, 0, 0, 0),
('622', 'USD', '2018', NULL, '6220003', 0, 'GV Vigilancia Privada', 0, 42, 482, 0, 0, 0),
('622', 'USD', '2018', NULL, '6220004', 0, 'GV Mantenimiento y Limpieza', 0, 42, 483, 0, 0, 0),
('622', 'USD', '2018', NULL, '6220005', 0, 'GV Servicios Contables', 0, 42, 484, 0, 0, 0),
('622', 'USD', '2018', NULL, '6220006', 0, 'GV Honorarios', 0, 42, 485, 0, 0, 0),
('622', 'USD', '2018', NULL, '6220007', 0, 'GV Combustibles y Lubricantes', 0, 42, 486, 0, 0, 0),
('622', 'USD', '2018', NULL, '6220008', 0, 'GV Seguros Contratados', 0, 42, 487, 0, 0, 0),
('622', 'USD', '2018', NULL, '6220009', 0, 'GV Útiles Oficina y Suministros', 0, 42, 488, 0, 0, 0),
('622', 'USD', '2018', NULL, '6220010', 0, 'GV Internet, correo, otros', 0, 42, 489, 0, 0, 0),
('622', 'USD', '2018', NULL, '6220011', 0, 'GV Suscripciones y Publicaciones', 0, 42, 490, 0, 0, 0),
('622', 'USD', '2018', NULL, '6220012', 0, 'GV Impuestos, tasa y otros', 0, 42, 491, 0, 0, 0),
('622', 'USD', '2018', NULL, '6220013', 0, 'GV Depreciaciones', 0, 42, 492, 0, 0, 0),
('622', 'USD', '2018', NULL, '6220014', 0, 'GV Amortizaciones', 0, 42, 493, 0, 0, 0),
('622', 'USD', '2018', NULL, '6220015', 0, 'GV Cuentas Incobrables', 0, 42, 494, 0, 0, 0),
('622', 'USD', '2018', NULL, '6220016', 0, 'GV Perdida en venta de activos', 0, 42, 495, 0, 0, 0),
('622', 'USD', '2018', NULL, '6220017', 0, 'GV Gasto Impuesto a la renta', 0, 42, 496, 0, 0, 0),
('622', 'USD', '2018', NULL, '6220018', 0, 'GV Gasto 15% participación trabajadores', 0, 42, 497, 0, 0, 0),
('622', 'USD', '2018', NULL, '6220019', 0, 'GV Mantenimiento vehículos', 0, 42, 498, 0, 0, 0),
('622', 'USD', '2018', NULL, '6220020', 0, 'GV No deducibles', 0, 42, 499, 0, 0, 0),
('622', 'USD', '2018', NULL, '6220021', 0, 'GV Perdida por Robo Locales', 0, 42, 500, 0, 0, 0),
('622', 'USD', '2018', NULL, '6220022', 0, 'GV Gastos Médicos Empleados', 0, 42, 501, 0, 0, 0),
('622', 'USD', '2018', NULL, '6220099', 0, 'GV Gastos Menores', 0, 42, 502, 0, 0, 0),
('631', 'USD', '2018', NULL, '6310001', 0, 'Gastos y Comisiones Bancarias', 0, 43, 503, 0, 0, 0),
('631', 'USD', '2018', NULL, '6310002', 0, 'Intereses Entidades Financieras', 0, 43, 504, 0, 0, 0),
('631', 'USD', '2018', NULL, '6310003', 0, 'Multas', 0, 43, 505, 0, 0, 0),
('631', 'USD', '2018', NULL, '6310004', 0, 'Préstamo capital', 0, 43, 506, 0, 0, 0),
('631', 'USD', '2018', NULL, '6310005', 0, 'Movimientos bancarios', 0, 43, 507, 0, 0, 0),
('1121', 'USD', '2018', NULL, '1121002', 0, 'Valencia Riasco Steeven', 0, 5, 508, 0, 0, 0),
('2121', 'USD', '2018', NULL, '2121002', 397.75, 'Javier Gilson', 397.75, 18, 509, 0, 0, 0),
('2121', 'USD', '2018', NULL, '2121001', 2547.92, 'Luis Velez Velez', 2547.92, 18, 510, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `co_subcuentascli`
--

CREATE TABLE `co_subcuentascli` (
  `codcliente` varchar(6) COLLATE utf8_bin DEFAULT NULL,
  `codejercicio` varchar(4) COLLATE utf8_bin NOT NULL,
  `codsubcuenta` varchar(15) COLLATE utf8_bin NOT NULL,
  `id` int(11) NOT NULL,
  `idsubcuenta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `co_subcuentascli`
--

INSERT INTO `co_subcuentascli` (`codcliente`, `codejercicio`, `codsubcuenta`, `id`, `idsubcuenta`) VALUES
('000001', '2018', '1121001', 1, 5),
('000002', '2018', '1121002', 2, 508);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `co_subcuentasprov`
--

CREATE TABLE `co_subcuentasprov` (
  `codejercicio` varchar(4) COLLATE utf8_bin NOT NULL,
  `codproveedor` varchar(6) COLLATE utf8_bin DEFAULT NULL,
  `codsubcuenta` varchar(15) COLLATE utf8_bin NOT NULL,
  `id` int(11) NOT NULL,
  `idsubcuenta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `co_subcuentasprov`
--

INSERT INTO `co_subcuentasprov` (`codejercicio`, `codproveedor`, `codsubcuenta`, `id`, `idsubcuenta`) VALUES
('2018', '000002', '2121002', 1, 509),
('2018', '000001', '2121001', 2, 510);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentasbanco`
--

CREATE TABLE `cuentasbanco` (
  `codsubcuenta` varchar(15) COLLATE utf8_bin DEFAULT NULL,
  `descripcion` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `iban` varchar(34) COLLATE utf8_bin DEFAULT NULL,
  `codcuenta` varchar(6) COLLATE utf8_bin NOT NULL,
  `swift` varchar(11) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentasbcocli`
--

CREATE TABLE `cuentasbcocli` (
  `descripcion` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `swift` varchar(11) COLLATE utf8_bin DEFAULT NULL,
  `ctaentidad` varchar(4) COLLATE utf8_bin DEFAULT NULL,
  `iban` varchar(34) COLLATE utf8_bin DEFAULT NULL,
  `agencia` varchar(4) COLLATE utf8_bin DEFAULT NULL,
  `entidad` varchar(4) COLLATE utf8_bin DEFAULT NULL,
  `codcliente` varchar(6) COLLATE utf8_bin NOT NULL,
  `ctaagencia` varchar(4) COLLATE utf8_bin DEFAULT NULL,
  `codcuenta` varchar(6) COLLATE utf8_bin NOT NULL,
  `cuenta` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `principal` tinyint(1) DEFAULT NULL,
  `fmandato` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentasbcopro`
--

CREATE TABLE `cuentasbcopro` (
  `agencia` varchar(4) COLLATE utf8_bin DEFAULT NULL,
  `codcuenta` varchar(6) COLLATE utf8_bin NOT NULL,
  `codproveedor` varchar(6) COLLATE utf8_bin NOT NULL,
  `ctaagencia` varchar(4) COLLATE utf8_bin DEFAULT NULL,
  `ctaentidad` varchar(4) COLLATE utf8_bin DEFAULT NULL,
  `cuenta` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `descripcion` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `entidad` varchar(4) COLLATE utf8_bin DEFAULT NULL,
  `iban` varchar(34) COLLATE utf8_bin DEFAULT NULL,
  `swift` varchar(11) COLLATE utf8_bin DEFAULT NULL,
  `principal` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dirclientes`
--

CREATE TABLE `dirclientes` (
  `codcliente` varchar(6) COLLATE utf8_bin NOT NULL,
  `codpais` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `apartado` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `idprovincia` int(11) DEFAULT NULL,
  `provincia` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `ciudad` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `codpostal` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `direccion` varchar(100) COLLATE utf8_bin NOT NULL,
  `domenvio` tinyint(1) DEFAULT NULL,
  `domfacturacion` tinyint(1) DEFAULT NULL,
  `descripcion` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `id` int(11) NOT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `dirclientes`
--

INSERT INTO `dirclientes` (`codcliente`, `codpais`, `apartado`, `idprovincia`, `provincia`, `ciudad`, `codpostal`, `direccion`, `domenvio`, `domfacturacion`, `descripcion`, `id`, `fecha`) VALUES
('000001', 'ECU', '', NULL, 'Manabí', 'Manta', '', 'Cetro de Manta', 1, 1, 'Principal', 1, '2018-02-11'),
('000002', 'ECU', '', NULL, 'Manabi', 'Manta', '', 'Sabra dios Donde', 1, 1, 'Principal', 2, '2018-02-11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dirproveedores`
--

CREATE TABLE `dirproveedores` (
  `codproveedor` varchar(6) COLLATE utf8_bin NOT NULL,
  `codpais` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `apartado` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `idprovincia` int(11) DEFAULT NULL,
  `provincia` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `ciudad` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `codpostal` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `direccion` varchar(100) COLLATE utf8_bin NOT NULL,
  `direccionppal` tinyint(1) DEFAULT NULL,
  `descripcion` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `id` int(11) NOT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `dirproveedores`
--

INSERT INTO `dirproveedores` (`codproveedor`, `codpais`, `apartado`, `idprovincia`, `provincia`, `ciudad`, `codpostal`, `direccion`, `direccionppal`, `descripcion`, `id`, `fecha`) VALUES
('000001', 'ECU', '', NULL, 'Manabí', 'Manta', '', 'Centro de Manta', 1, 'Principal', 1, '2018-02-11'),
('000002', 'ECU', '', NULL, 'Manabi', 'Manta', '', 'Alv en cuba xD', 1, 'Principal', 2, '2018-02-11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `divisas`
--

CREATE TABLE `divisas` (
  `bandera` text COLLATE utf8_bin,
  `coddivisa` varchar(3) COLLATE utf8_bin NOT NULL,
  `codiso` varchar(3) COLLATE utf8_bin DEFAULT NULL,
  `descripcion` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `simbolo` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `tasaconv` double NOT NULL,
  `tasaconv_compra` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `divisas`
--

INSERT INTO `divisas` (`bandera`, `coddivisa`, `codiso`, `descripcion`, `fecha`, `simbolo`, `tasaconv`, `tasaconv_compra`) VALUES
(NULL, 'ARS', '32', 'PESOS (ARG)', NULL, 'AR$', 16.684, 16.684),
(NULL, 'CLP', '152', 'PESOS (CLP)', NULL, 'CLP$', 704.0227, 704.0227),
(NULL, 'COP', '170', 'PESOS (COP)', NULL, 'CO$', 3140.6803, 3140.6803),
(NULL, 'DOP', '214', 'PESOS DOMINICANOS', NULL, 'RD$', 49.7618, 49.7618),
(NULL, 'EUR', '978', 'EUROS', NULL, '€', 1, 1),
(NULL, 'GBP', '826', 'LIBRAS ESTERLINAS', NULL, '£', 0.865, 0.865),
(NULL, 'HTG', '322', 'GOURDES', NULL, 'G', 72.0869, 72.0869),
(NULL, 'MXN', '484', 'PESOS (MXN)', NULL, 'MX$', 23.3678, 23.3678),
(NULL, 'PAB', '590', 'BALBOAS', NULL, 'B', 1.128, 1.128),
(NULL, 'PEN', '604', 'NUEVOS SOLES', NULL, 'S/.', 3.736, 3.736),
(NULL, 'USD', '840', 'DÓLARES EE.UU.', NULL, '$', 1.129, 1.129),
(NULL, 'VEF', '937', 'BOLÍVARES', NULL, 'Bs', 10.6492, 10.6492);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ejercicios`
--

CREATE TABLE `ejercicios` (
  `idasientocierre` int(11) DEFAULT NULL,
  `idasientopyg` int(11) DEFAULT NULL,
  `idasientoapertura` int(11) DEFAULT NULL,
  `plancontable` varchar(2) COLLATE utf8_bin DEFAULT NULL,
  `longsubcuenta` int(11) DEFAULT NULL,
  `estado` varchar(15) COLLATE utf8_bin NOT NULL,
  `fechafin` date NOT NULL,
  `fechainicio` date NOT NULL,
  `nombre` varchar(100) COLLATE utf8_bin NOT NULL,
  `codejercicio` varchar(4) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `ejercicios`
--

INSERT INTO `ejercicios` (`idasientocierre`, `idasientopyg`, `idasientoapertura`, `plancontable`, `longsubcuenta`, `estado`, `fechafin`, `fechainicio`, `nombre`, `codejercicio`) VALUES
(NULL, NULL, NULL, '08', 7, 'ABIERTO', '2018-12-31', '2018-01-01', '2018', '2018');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `administrador` varchar(100) COLLATE utf8_bin NOT NULL,
  `apartado` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `cifnif` varchar(30) COLLATE utf8_bin NOT NULL,
  `ciudad` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `codalmacen` varchar(4) COLLATE utf8_bin DEFAULT NULL,
  `codcuentarem` varchar(6) COLLATE utf8_bin DEFAULT NULL,
  `coddivisa` varchar(3) COLLATE utf8_bin DEFAULT NULL,
  `codedi` varchar(17) COLLATE utf8_bin DEFAULT NULL,
  `codejercicio` varchar(4) COLLATE utf8_bin DEFAULT NULL,
  `codpago` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `codpais` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `codpostal` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `codserie` varchar(2) COLLATE utf8_bin DEFAULT NULL,
  `contintegrada` tinyint(1) DEFAULT NULL,
  `direccion` varchar(100) COLLATE utf8_bin NOT NULL,
  `email` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `fax` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `horario` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `id` int(11) NOT NULL,
  `idprovincia` int(11) DEFAULT NULL,
  `xid` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `lema` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `logo` text COLLATE utf8_bin,
  `nombre` varchar(100) COLLATE utf8_bin NOT NULL,
  `nombrecorto` varchar(32) COLLATE utf8_bin DEFAULT NULL,
  `pie_factura` text COLLATE utf8_bin,
  `provincia` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `recequivalencia` tinyint(1) DEFAULT NULL,
  `stockpedidos` tinyint(1) DEFAULT NULL,
  `telefono` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `web` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `inicioact` date DEFAULT NULL,
  `regimeniva` varchar(20) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`administrador`, `apartado`, `cifnif`, `ciudad`, `codalmacen`, `codcuentarem`, `coddivisa`, `codedi`, `codejercicio`, `codpago`, `codpais`, `codpostal`, `codserie`, `contintegrada`, `direccion`, `email`, `fax`, `horario`, `id`, `idprovincia`, `xid`, `lema`, `logo`, `nombre`, `nombrecorto`, `pie_factura`, `provincia`, `recequivalencia`, `stockpedidos`, `telefono`, `web`, `inicioact`, `regimeniva`) VALUES
('', '', '00000014Z', '', 'NJK', NULL, 'USD', NULL, '2018', 'CONT', 'ECU', '', 'A', 1, 'C/ Falsa, 123', 'casesa97@gmail.com', '', '', 1, NULL, 'rZ9djEoaz64s7PK3uLAFgHclQ2kI1x', '', NULL, 'Empresa 5174 S.L.', 'E-5174', '', '', 0, 0, '', 'https://www.Sistema_Contable.com', '1969-12-31', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fabricantes`
--

CREATE TABLE `fabricantes` (
  `nombre` varchar(100) COLLATE utf8_bin NOT NULL,
  `codfabricante` varchar(8) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `fabricantes`
--

INSERT INTO `fabricantes` (`nombre`, `codfabricante`) VALUES
('Most Supra Technology', 'MST'),
('OEM', 'OEM');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturascli`
--

CREATE TABLE `facturascli` (
  `apartado` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `automatica` tinyint(1) DEFAULT NULL,
  `cifnif` varchar(30) COLLATE utf8_bin NOT NULL,
  `ciudad` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `codagente` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `codalmacen` varchar(4) COLLATE utf8_bin DEFAULT NULL,
  `codcliente` varchar(6) COLLATE utf8_bin DEFAULT NULL,
  `coddir` int(11) DEFAULT NULL,
  `coddivisa` varchar(3) COLLATE utf8_bin NOT NULL,
  `codejercicio` varchar(4) COLLATE utf8_bin NOT NULL,
  `codigo` varchar(20) COLLATE utf8_bin NOT NULL,
  `codigorect` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `codpago` varchar(10) COLLATE utf8_bin NOT NULL,
  `codpais` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `codpostal` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `codserie` varchar(2) COLLATE utf8_bin NOT NULL,
  `deabono` tinyint(1) DEFAULT '0',
  `direccion` varchar(100) COLLATE utf8_bin NOT NULL,
  `editable` tinyint(1) DEFAULT '0',
  `fecha` date NOT NULL,
  `vencimiento` date DEFAULT NULL,
  `femail` date DEFAULT NULL,
  `hora` time NOT NULL DEFAULT '00:00:00',
  `idasiento` int(11) DEFAULT NULL,
  `idasientop` int(11) DEFAULT NULL,
  `idfactura` int(11) NOT NULL,
  `idfacturarect` int(11) DEFAULT NULL,
  `idpagodevol` int(11) DEFAULT NULL,
  `idprovincia` int(11) DEFAULT NULL,
  `irpf` double NOT NULL DEFAULT '0',
  `netosindto` double NOT NULL DEFAULT '0',
  `neto` double NOT NULL DEFAULT '0',
  `nogenerarasiento` tinyint(1) DEFAULT NULL,
  `nombrecliente` varchar(100) COLLATE utf8_bin NOT NULL,
  `numero` varchar(12) COLLATE utf8_bin NOT NULL,
  `numero2` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `observaciones` text COLLATE utf8_bin,
  `pagada` tinyint(1) NOT NULL DEFAULT '0',
  `anulada` tinyint(1) NOT NULL DEFAULT '0',
  `porcomision` double DEFAULT NULL,
  `provincia` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `recfinanciero` double DEFAULT NULL,
  `tasaconv` double NOT NULL DEFAULT '1',
  `total` double NOT NULL DEFAULT '0',
  `totaleuros` double NOT NULL DEFAULT '0',
  `totalirpf` double NOT NULL DEFAULT '0',
  `totaliva` double NOT NULL DEFAULT '0',
  `totalrecargo` double DEFAULT NULL,
  `tpv` tinyint(1) DEFAULT NULL,
  `codtrans` varchar(8) COLLATE utf8_bin DEFAULT NULL,
  `codigoenv` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `nombreenv` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `apellidosenv` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `direccionenv` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `codpostalenv` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `ciudadenv` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `provinciaenv` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `apartadoenv` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `codpaisenv` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `idimprenta` int(11) DEFAULT NULL,
  `numdocs` int(11) DEFAULT '0',
  `dtopor1` double NOT NULL DEFAULT '0',
  `dtopor2` double NOT NULL DEFAULT '0',
  `dtopor3` double NOT NULL DEFAULT '0',
  `dtopor4` double NOT NULL DEFAULT '0',
  `dtopor5` double NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `facturascli`
--

INSERT INTO `facturascli` (`apartado`, `automatica`, `cifnif`, `ciudad`, `codagente`, `codalmacen`, `codcliente`, `coddir`, `coddivisa`, `codejercicio`, `codigo`, `codigorect`, `codpago`, `codpais`, `codpostal`, `codserie`, `deabono`, `direccion`, `editable`, `fecha`, `vencimiento`, `femail`, `hora`, `idasiento`, `idasientop`, `idfactura`, `idfacturarect`, `idpagodevol`, `idprovincia`, `irpf`, `netosindto`, `neto`, `nogenerarasiento`, `nombrecliente`, `numero`, `numero2`, `observaciones`, `pagada`, `anulada`, `porcomision`, `provincia`, `recfinanciero`, `tasaconv`, `total`, `totaleuros`, `totalirpf`, `totaliva`, `totalrecargo`, `tpv`, `codtrans`, `codigoenv`, `nombreenv`, `apellidosenv`, `direccionenv`, `codpostalenv`, `ciudadenv`, `provinciaenv`, `apartadoenv`, `codpaisenv`, `idimprenta`, `numdocs`, `dtopor1`, `dtopor2`, `dtopor3`, `dtopor4`, `dtopor5`) VALUES
('', NULL, '1316360534001', 'Manta', '2', 'NJK', '000001', 1, 'USD', '2018', 'FAC2018A1', NULL, 'CONT', 'ECU', '', 'A', 0, 'Cetro de Manta', 0, '2018-02-11', '2018-02-11', NULL, '15:08:58', 2, 3, 3, NULL, NULL, NULL, 0, 43.6, 43.6, NULL, 'Kevin Mecias Chica', '1', '', 'Primera factura...', 1, 0, 0, 'Manabí', NULL, 1.129, 46.75, 41.40833, 0, 3.15, 0, NULL, NULL, '', '', '', '', '', '', '', '', 'ECU', NULL, 0, 0, 0, 0, 0, 0),
('', NULL, '1316360534001', 'Manta', '2', 'NJK', '000001', 1, 'USD', '2018', 'FAC2018R1', 'FAC2018A1', 'CONT', 'ECU', '', 'R', 0, 'Cetro de Manta', 0, '2018-02-11', '2018-02-11', NULL, '18:05:20', 4, 5, 4, 3, NULL, NULL, 0, -26.25, -26.25, NULL, 'Kevin Mecias Chica', '1', '', '', 1, 0, 0, 'Manabí', NULL, 1.129, -29.4, -26.04074, 0, -3.15, 0, NULL, NULL, '', '', '', '', '', '', '', '', 'ECU', NULL, NULL, 0, 0, 0, 0, 0),
('', NULL, '1316360534001', 'Manta', '2', 'NJK', '000001', 1, 'USD', '2018', 'FAC2018A2', NULL, 'TARJETA', 'ECU', '', 'A', 0, 'Cetro de Manta', 0, '2018-02-11', '2018-02-11', NULL, '19:30:48', 6, 7, 5, NULL, NULL, NULL, 0, 26.79, 26.79, NULL, 'Kevin Mecias Chica', '2', '', '', 1, 0, 0, 'Manabí', NULL, 1.129, 30, 26.57219, 0, 3.21, 0, NULL, NULL, '', '', '', '', '', '', '', NULL, NULL, NULL, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturasprov`
--

CREATE TABLE `facturasprov` (
  `automatica` tinyint(1) DEFAULT NULL,
  `cifnif` varchar(30) COLLATE utf8_bin NOT NULL,
  `codagente` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `codalmacen` varchar(4) COLLATE utf8_bin DEFAULT NULL,
  `coddivisa` varchar(3) COLLATE utf8_bin NOT NULL,
  `codejercicio` varchar(4) COLLATE utf8_bin NOT NULL,
  `codigo` varchar(20) COLLATE utf8_bin NOT NULL,
  `codigorect` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `codpago` varchar(10) COLLATE utf8_bin NOT NULL,
  `codproveedor` varchar(6) COLLATE utf8_bin DEFAULT NULL,
  `codserie` varchar(2) COLLATE utf8_bin NOT NULL,
  `deabono` tinyint(1) DEFAULT '0',
  `editable` tinyint(1) DEFAULT '0',
  `fecha` date NOT NULL,
  `hora` time NOT NULL DEFAULT '00:00:00',
  `idasiento` int(11) DEFAULT NULL,
  `idasientop` int(11) DEFAULT NULL,
  `idfactura` int(11) NOT NULL,
  `idfacturarect` int(11) DEFAULT NULL,
  `idpagodevol` int(11) DEFAULT NULL,
  `irpf` double DEFAULT NULL,
  `neto` double DEFAULT NULL,
  `nogenerarasiento` tinyint(1) DEFAULT NULL,
  `nombre` varchar(100) COLLATE utf8_bin NOT NULL,
  `numero` varchar(12) COLLATE utf8_bin NOT NULL,
  `numproveedor` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `observaciones` text COLLATE utf8_bin,
  `pagada` tinyint(1) NOT NULL DEFAULT '0',
  `anulada` tinyint(1) NOT NULL DEFAULT '0',
  `recfinanciero` double DEFAULT NULL,
  `tasaconv` double NOT NULL,
  `total` double DEFAULT NULL,
  `totaleuros` double DEFAULT NULL,
  `totalirpf` double DEFAULT NULL,
  `totaliva` double DEFAULT NULL,
  `totalrecargo` double DEFAULT NULL,
  `numdocs` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `facturasprov`
--

INSERT INTO `facturasprov` (`automatica`, `cifnif`, `codagente`, `codalmacen`, `coddivisa`, `codejercicio`, `codigo`, `codigorect`, `codpago`, `codproveedor`, `codserie`, `deabono`, `editable`, `fecha`, `hora`, `idasiento`, `idasientop`, `idfactura`, `idfacturarect`, `idpagodevol`, `irpf`, `neto`, `nogenerarasiento`, `nombre`, `numero`, `numproveedor`, `observaciones`, `pagada`, `anulada`, `recfinanciero`, `tasaconv`, `total`, `totaleuros`, `totalirpf`, `totaliva`, `totalrecargo`, `numdocs`) VALUES
(NULL, '1315330561', '2', 'NJK', 'USD', '2018', 'FAC2018A1C', NULL, 'CONT', '000002', 'A', 0, 0, '2018-02-11', '16:29:59', 11, 12, 1, NULL, NULL, 0, 376.24, NULL, 'Javier Gilson', '1', '', '', 1, 0, NULL, 1.129, 397.75, 352.30292, 0, 21.51, 0, 0),
(NULL, '1317038881', '2', 'NJK', 'USD', '2018', 'FAC2018A2C', NULL, 'CONT', '000001', 'A', 0, 0, '2018-02-11', '22:24:29', 9, 10, 2, NULL, NULL, 0, 2317.14, NULL, 'Luis Velez Velez', '2', '', '', 1, 0, NULL, 1.129, 2547.92, 2256.79362, 0, 230.78, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `familias`
--

CREATE TABLE `familias` (
  `descripcion` varchar(100) COLLATE utf8_bin NOT NULL,
  `codfamilia` varchar(8) COLLATE utf8_bin NOT NULL,
  `madre` varchar(8) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `familias`
--

INSERT INTO `familias` (`descripcion`, `codfamilia`, `madre`) VALUES
('FAMILIA', 'FAM', NULL),
('HERMANA', 'HEMA', 'FAM'),
('HERMANO', 'HERM', 'FAM'),
('VARIOS', 'VARI', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formaspago`
--

CREATE TABLE `formaspago` (
  `codpago` varchar(10) COLLATE utf8_bin NOT NULL,
  `descripcion` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `genrecibos` varchar(10) COLLATE utf8_bin NOT NULL,
  `codcuenta` varchar(6) COLLATE utf8_bin DEFAULT NULL,
  `domiciliado` tinyint(1) DEFAULT NULL,
  `imprimir` tinyint(1) DEFAULT '1',
  `vencimiento` varchar(20) COLLATE utf8_bin DEFAULT '+1month'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `formaspago`
--

INSERT INTO `formaspago` (`codpago`, `descripcion`, `genrecibos`, `codcuenta`, `domiciliado`, `imprimir`, `vencimiento`) VALUES
('CONT', 'Al contado', 'Pagados', NULL, 0, 1, '+0day'),
('PAYPAL', 'PayPal', 'Pagados', NULL, 0, 1, '+0day'),
('TARJETA', 'Tarjeta de crédito', 'Pagados', NULL, 0, 1, '+0day'),
('TRANS', 'Transferencia bancaria', 'Emitidos', NULL, 0, 1, '+1month');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fs_access`
--

CREATE TABLE `fs_access` (
  `fs_user` varchar(12) COLLATE utf8_bin NOT NULL,
  `fs_page` varchar(30) COLLATE utf8_bin NOT NULL,
  `allow_delete` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `fs_access`
--

INSERT INTO `fs_access` (`fs_user`, `fs_page`, `allow_delete`) VALUES
('Shakun', 'nueva_venta', 1),
('Shakun', 'ventas_agrupar_albaranes', 1),
('Shakun', 'ventas_albaran', 1),
('Shakun', 'ventas_albaranes', 1),
('Shakun', 'ventas_articulo', 1),
('Shakun', 'ventas_articulos', 1),
('Shakun', 'ventas_atributos', 1),
('Shakun', 'ventas_cliente', 1),
('Shakun', 'ventas_cliente_articulos', 1),
('Shakun', 'ventas_clientes', 1),
('Shakun', 'ventas_clientes_opciones', 1),
('Shakun', 'ventas_fabricante', 1),
('Shakun', 'ventas_fabricantes', 1),
('Shakun', 'ventas_factura', 1),
('Shakun', 'ventas_factura_devolucion', 1),
('Shakun', 'ventas_facturas', 1),
('Shakun', 'ventas_familia', 1),
('Shakun', 'ventas_familias', 1),
('Shakun', 'ventas_grupo', 1),
('Shakun', 'ventas_imprimir', 1),
('Shakun', 'ventas_maquetar', 1),
('Shakun', 'ventas_trazabilidad', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fs_extensions2`
--

CREATE TABLE `fs_extensions2` (
  `name` varchar(50) COLLATE utf8_bin NOT NULL,
  `page_from` varchar(30) COLLATE utf8_bin NOT NULL,
  `page_to` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `type` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `text` text COLLATE utf8_bin,
  `params` varchar(100) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `fs_extensions2`
--

INSERT INTO `fs_extensions2` (`name`, `page_from`, `page_to`, `type`, `text`, `params`) VALUES
('agrupar_albaranes', 'compras_agrupar_albaranes', 'compras_albaranes', 'button', '<span class=\"glyphicon glyphicon-duplicate\"></span><span class=\"hidden-xs\">&nbsp; Agrupar</span>', ''),
('agrupar_albaranes', 'ventas_agrupar_albaranes', 'ventas_albaranes', 'button', '<span class=\"glyphicon glyphicon-duplicate\"></span><span class=\"hidden-xs\">&nbsp; Agrupar</span>', ''),
('albaranes_agente', 'compras_albaranes', 'admin_agente', 'button', '<span class=\"glyphicon glyphicon-list\" aria-hidden=\"true\"></span> &nbsp; Guias de Remision de proveedor', ''),
('albaranes_agente', 'ventas_albaranes', 'admin_agente', 'button', '<span class=\"glyphicon glyphicon-list\" aria-hidden=\"true\"></span> &nbsp; Guias de Remision de cliente', ''),
('albaranes_articulo', 'compras_albaranes', 'ventas_articulo', 'tab_button', '<span class=\"glyphicon glyphicon-list\" aria-hidden=\"true\"></span> &nbsp; Guias de Remision de proveedor', ''),
('albaranes_articulo', 'ventas_albaranes', 'ventas_articulo', 'tab_button', '<span class=\"glyphicon glyphicon-list\" aria-hidden=\"true\"></span> &nbsp; Guias de Remision de cliente', ''),
('albaranes_cliente', 'ventas_albaranes', 'ventas_cliente', 'button', '<span class=\"glyphicon glyphicon-list\" aria-hidden=\"true\"></span> &nbsp; Guias de Remision', ''),
('albaranes_proveedor', 'compras_albaranes', 'compras_proveedor', 'button', '<span class=\"glyphicon glyphicon-list\" aria-hidden=\"true\"></span> &nbsp; Guias de Remision', ''),
('articulo_subcuentas', 'articulo_subcuentas', 'ventas_articulo', 'tab', '<span class=\"glyphicon glyphicon-book\" aria-hidden=\"true\"></span><span class=\"hidden-xs\">&nbsp; Subcuentas</span>', NULL),
('btn_albaran', 'compras_actualiza_arts', 'compras_albaran', 'tab', '<span class=\"glyphicon glyphicon-share\" aria-hidden=\"true\"></span><span class=\"hidden-xs\">&nbsp; Actualizar</span>', '&doc=albaran'),
('btn_atributos', 'ventas_atributos', 'ventas_articulos', 'button', '<span class=\"glyphicon glyphicon-list-alt\" aria-hidden=\"true\"></span><span class=\"hidden-xs\">&nbsp; Atributos</span>', NULL),
('btn_balances', 'editar_balances', 'informe_contabilidad', 'button', '<span class=\"glyphicon glyphicon-wrench\"></span><span class=\"hidden-xs\">&nbsp; Balances</a>', NULL),
('btn_fabricantes', 'ventas_fabricantes', 'ventas_articulos', 'button', '<span class=\"glyphicon glyphicon-folder-open\" aria-hidden=\"true\"></span><span class=\"hidden-xs\"> &nbsp; Fabricantes</span>', NULL),
('btn_familias', 'ventas_familias', 'ventas_articulos', 'button', '<span class=\"glyphicon glyphicon-folder-open\" aria-hidden=\"true\"></span><span class=\"hidden-xs\"> &nbsp; Familias</span>', NULL),
('btn_pedido', 'compras_actualiza_arts', 'compras_pedido', 'tab', '<span class=\"glyphicon glyphicon-share\" aria-hidden=\"true\"></span><span class=\"hidden-xs\">&nbsp; Actualizar</span>', '&doc=pedido'),
('cosmo', 'admin_user', 'admin_user', 'css', 'view/css/bootstrap-cosmo.min.css', ''),
('darkly', 'admin_user', 'admin_user', 'css', 'view/css/bootstrap-darkly.min.css', ''),
('email_albaran', 'ventas_imprimir', 'ventas_albaran', 'email', 'Guia de Remision simple', '&albaran=TRUE'),
('email_albaran_proveedor', 'compras_imprimir', 'compras_albaran', 'email', 'Guia de Remision simple', '&albaran=TRUE'),
('email_factura', 'ventas_imprimir', 'ventas_factura', 'email', 'Factura simple', '&factura=TRUE&tipo=simple'),
('facturas_agente', 'compras_facturas', 'admin_agente', 'button', '<span class=\"glyphicon glyphicon-list\" aria-hidden=\"true\"></span> &nbsp; Facturas de proveedor', ''),
('facturas_agente', 'ventas_facturas', 'admin_agente', 'button', '<span class=\"glyphicon glyphicon-list\" aria-hidden=\"true\"></span> &nbsp; Facturas de cliente', ''),
('facturas_articulo', 'compras_facturas', 'ventas_articulo', 'tab_button', '<span class=\"glyphicon glyphicon-list\" aria-hidden=\"true\"></span> &nbsp; Facturas de proveedor', ''),
('facturas_articulo', 'ventas_facturas', 'ventas_articulo', 'tab_button', '<span class=\"glyphicon glyphicon-list\" aria-hidden=\"true\"></span> &nbsp; Facturas de cliente', ''),
('facturas_cliente', 'ventas_facturas', 'ventas_cliente', 'button', '<span class=\"glyphicon glyphicon-list\" aria-hidden=\"true\"></span> &nbsp; Facturas', ''),
('facturas_proveedor', 'compras_facturas', 'compras_proveedor', 'button', '<span class=\"glyphicon glyphicon-list\" aria-hidden=\"true\"></span> &nbsp; Facturas', ''),
('flatly', 'admin_user', 'admin_user', 'css', 'view/css/bootstrap-flatly.min.css', ''),
('imprimir_albaran', 'ventas_imprimir', 'ventas_albaran', 'pdf', '<span class=\"glyphicon glyphicon-print\"></span>&nbsp; Guia de Remision simple', '&albaran=TRUE'),
('imprimir_albaran_noval', 'ventas_imprimir', 'ventas_albaran', 'pdf', '<span class=\"glyphicon glyphicon-print\"></span>&nbsp; Guia de Remision sin valorar', '&albaran=TRUE&noval=TRUE'),
('imprimir_albaran_proveedor', 'compras_imprimir', 'compras_albaran', 'pdf', 'Guia de Remision simple', '&albaran=TRUE'),
('imprimir_factura', 'ventas_imprimir', 'ventas_factura', 'pdf', '<span class=\"glyphicon glyphicon-print\"></span>&nbsp; Factura simple', '&factura=TRUE&tipo=simple'),
('imprimir_factura_carta', 'ventas_imprimir', 'ventas_factura', 'pdf', '<span class=\"glyphicon glyphicon-print\"></span>&nbsp; Modelo carta', '&factura=TRUE&tipo=carta'),
('imprimir_factura_proveedor', 'compras_imprimir', 'compras_factura', 'pdf', 'Factura simple', '&factura=TRUE'),
('lumen', 'admin_user', 'admin_user', 'css', 'view/css/bootstrap-lumen.min.css', ''),
('maquetar_albaran', 'ventas_maquetar', 'ventas_albaran', 'pdf', '<i class=\"fa fa-magic\"></i>&nbsp; Maquetar', '&albaran=TRUE'),
('maquetar_factura', 'ventas_maquetar', 'ventas_factura', 'pdf', '<i class=\"fa fa-magic\"></i>&nbsp; Maquetar', '&factura=TRUE'),
('opciones_clientes', 'ventas_clientes_opciones', 'ventas_clientes', 'button', '<span class=\"glyphicon glyphicon-wrench\" aria-hidden=\"true\" title=\"Opciones para nuevos clientes\"></span><span class=\"hidden-xs\">&nbsp; Opciones</span>', NULL),
('paper', 'admin_user', 'admin_user', 'css', 'view/css/bootstrap-paper.min.css', ''),
('plan_ecuador', 'admin_ecuador', 'contabilidad_ejercicio', 'fuente', 'Plan contable de Ecuador', 'plugins/ecuador/extras/ecuador.xml'),
('sandstone', 'admin_user', 'admin_user', 'css', 'view/css/bootstrap-sandstone.min.css', ''),
('simplex', 'admin_user', 'admin_user', 'css', 'view/css/bootstrap-simplex.min.css', ''),
('spacelab', 'admin_user', 'admin_user', 'css', 'view/css/bootstrap-spacelab.min.css', ''),
('tab_devoluciones', 'compras_factura_devolucion', 'compras_factura', 'tab', '<span class=\"glyphicon glyphicon-share\" aria-hidden=\"true\"></span><span class=\"hidden-xs\">&nbsp; Devoluciones</span>', NULL),
('tab_devoluciones', 'ventas_factura_devolucion', 'ventas_factura', 'tab', '<span class=\"glyphicon glyphicon-share\" aria-hidden=\"true\"></span><span class=\"hidden-xs\">&nbsp; Devoluciones</span>', NULL),
('tab_editar_factura', 'compras_factura_devolucion', 'editar_factura_prov', 'tab', '<span class=\"glyphicon glyphicon-share\" aria-hidden=\"true\"></span><span class=\"hidden-xs\">&nbsp; Devoluciones</span>', NULL),
('tab_editar_factura', 'ventas_factura_devolucion', 'editar_factura', 'tab', '<span class=\"glyphicon glyphicon-share\" aria-hidden=\"true\"></span><span class=\"hidden-xs\">&nbsp; Devoluciones</span>', NULL),
('tab_ventas_cliente_articulos', 'ventas_cliente_articulos', 'ventas_cliente', 'tab', '<i class=\"fa fa-cubes\" aria-hidden=\"true\"></i>&nbsp; Artículos', NULL),
('united', 'admin_user', 'admin_user', 'css', 'view/css/bootstrap-united.min.css', ''),
('yeti', 'admin_user', 'admin_user', 'css', 'view/css/bootstrap-yeti.min.css', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fs_logs`
--

CREATE TABLE `fs_logs` (
  `id` int(11) NOT NULL,
  `tipo` varchar(50) COLLATE utf8_bin NOT NULL,
  `detalle` text COLLATE utf8_bin NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT '2018-02-11 05:00:00',
  `usuario` varchar(12) COLLATE utf8_bin DEFAULT NULL,
  `ip` varchar(40) COLLATE utf8_bin DEFAULT NULL,
  `alerta` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `fs_logs`
--

INSERT INTO `fs_logs` (`id`, `tipo`, `detalle`, `fecha`, `usuario`, `ip`, `alerta`) VALUES
(1, 'error', 'Archivo no encontrado. ¿Pesa más de 99 MB? Ese es el límite que tienes configurado en tu servidor.', '2018-02-11 03:22:27', 'admin', '::1', 0),
(2, 'error', 'No se encuentran subcuentas para el ejercicio 2018 ¿<a href=\"index.php?page=contabilidad_ejercicio&cod=2018\">Has importado los datos de contabilidad</a>?', '2018-02-11 03:33:58', 'admin', '::1', 0),
(3, 'error', 'Operation timed out after 5000 milliseconds with 0 out of 0 bytes received', '2018-02-11 03:45:19', NULL, NULL, 0),
(4, 'error', 'La subcuenta tiene una longitud de 7, mientras que el ejercicio tiene definida una longitud de: 10. Debeas cambiarla para evitar problemas.', '2018-02-11 03:49:55', 'admin', '::1', 0),
(5, 'error', 'Dependencias incumplidas: <b>facturacion_base</b>', '2018-02-11 04:23:51', 'admin', '::1', 0),
(6, 'error', '¡Imposible guardar el almacén!', '2018-02-11 05:08:24', 'admin', '::1', 0),
(7, 'error', 'Código de almacén no válido.', '2018-02-11 05:08:24', NULL, NULL, 0),
(8, 'error', '¡Empleado no encontrado!', '2018-02-11 07:42:00', 'admin', '::1', 0),
(9, 'error', 'No se permite Activar/Desactivar a uno mismo.', '2018-02-11 07:48:39', 'admin', '::1', 0),
(10, 'login', 'Usuario Shakun creado correctamente.', '2018-02-11 08:08:11', 'admin', '::1', 1),
(11, 'error', '¡Imposible guardar la tarifa!', '2018-02-11 14:41:23', 'admin', '::1', 0),
(12, 'error', 'Nombre de tarifa no válido. Debe tener entre 1 y 50 caracteres.', '2018-02-11 14:41:23', NULL, NULL, 0),
(13, 'msg', 'Tarifa 000001 eliminada correctamente.', '2018-02-11 16:48:53', 'admin', '::1', 0),
(14, 'login', 'Usuario Michu creado correctamente.', '2018-02-11 19:23:07', 'admin', '::1', 1),
(15, 'error', 'El usuario <a href=\"index.php?page=admin_user&snick=Michu\">ya existe</a>.', '2018-02-11 19:23:07', 'admin', '::1', 0),
(16, 'error', 'No hay suficiente stock del artículo <b>3</b>.', '2018-02-11 20:03:13', 'admin', '::1', 0),
(17, 'error', 'No hay suficiente stock del artículo <b>5</b>.', '2018-02-11 20:07:01', 'admin', '::1', 0),
(18, 'error', 'No hay suficiente stock del artículo <b>6</b>.', '2018-02-11 20:07:02', 'admin', '::1', 0),
(19, 'error', 'No hay suficiente stock del artículo <b>4</b>.', '2018-02-12 00:34:03', 'admin', '::1', 0),
(20, 'error', 'Este asiento es un posible duplicado de\n                     <a href=\'index.php?page=contabilidad_asiento&id=1\'>este otro</a>.\n                     Si no lo es, para evitar este mensaje, simplemente modifica el concepto.', '2018-02-12 02:04:01', NULL, NULL, 0),
(21, 'msg', 'Asiento eliminado correctamente. (ID: 8, 11-02-2018)', '2018-02-12 02:04:05', 'admin', '::1', 0),
(22, 'error', 'Failed to connect to raw.githubusercontent.com port 443: Timed out', '2018-02-12 03:02:01', NULL, NULL, 0),
(23, 'error', 'Failed to connect to raw.githubusercontent.com port 443: Timed out', '2018-02-12 03:02:01', NULL, NULL, 0),
(24, 'error', 'Failed to connect to raw.githubusercontent.com port 443: Timed out', '2018-02-12 03:02:02', NULL, NULL, 0),
(25, 'error', 'Failed to connect to raw.githubusercontent.com port 443: Timed out', '2018-02-12 03:23:40', NULL, NULL, 0),
(26, 'error', 'Failed to connect to raw.githubusercontent.com port 443: Timed out', '2018-02-12 03:23:40', NULL, NULL, 0),
(27, 'error', 'Failed to connect to raw.githubusercontent.com port 443: Timed out', '2018-02-12 03:23:40', NULL, NULL, 0),
(28, 'login', 'El usuario ha cerrado la sesión.', '2018-02-12 04:13:16', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fs_pages`
--

CREATE TABLE `fs_pages` (
  `name` varchar(30) COLLATE utf8_bin NOT NULL,
  `title` varchar(40) COLLATE utf8_bin NOT NULL,
  `folder` varchar(15) COLLATE utf8_bin NOT NULL,
  `version` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `show_on_menu` tinyint(1) NOT NULL DEFAULT '1',
  `important` tinyint(1) NOT NULL DEFAULT '0',
  `orden` int(11) NOT NULL DEFAULT '100'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `fs_pages`
--

INSERT INTO `fs_pages` (`name`, `title`, `folder`, `version`, `show_on_menu`, `important`, `orden`) VALUES
('admin_agente', 'Empleado', 'admin', '1', 0, 0, 100),
('admin_agentes', 'Empleados', 'admin', '1', 1, 0, 100),
('admin_almacenes', 'Almacenes', 'admin', '1', 1, 0, 100),
('admin_divisas', 'Divisas', 'admin', '1', 1, 0, 100),
('admin_ecuador', 'Ecuador', 'admin', '1', 1, 0, 100),
('admin_empresa', 'Empresa', 'admin', '1', 1, 0, 100),
('admin_home', 'Panel de control', 'admin', NULL, 1, 0, 100),
('admin_info', 'Información del sistema', 'admin', '1', 1, 0, 100),
('admin_orden_menu', 'Ordenar menú', 'admin', '1', 1, 0, 100),
('admin_paises', 'Paises', 'admin', '1', 1, 0, 100),
('admin_rol', 'Editar rol', 'admin', '1', 0, 0, 100),
('admin_user', 'Usuario', 'admin', '1', 0, 0, 100),
('admin_users', 'Usuarios', 'admin', '1', 1, 0, 100),
('articulo_subcuentas', 'Subcuentas', 'ventas', '1', 0, 0, 100),
('articulo_trazabilidad', '', 'ventas', '1', 0, 0, 100),
('base_wizard', 'Asistente de instalación', 'admin', '1', 0, 0, 100),
('compras_actualiza_arts', 'Artículos documento', 'compras', '1', 0, 0, 100),
('compras_agrupar_albaranes', 'Agrupar Guias de Remision', 'compras', '1', 0, 0, 100),
('compras_albaran', 'Guia de Remision de proveedor', 'compras', '1', 0, 0, 100),
('compras_albaranes', 'Guias de Remision', 'compras', '1', 1, 0, 100),
('compras_factura', 'Factura de proveedor', 'compras', '1', 0, 0, 100),
('compras_factura_devolucion', 'Devoluciones de factura de compra', 'compras', '1', 0, 0, 100),
('compras_facturas', 'Facturas', 'compras', '1', 1, 0, 100),
('compras_imprimir', 'imprimir', 'compras', '1', 0, 0, 100),
('compras_proveedor', 'Proveedor', 'compras', '1', 0, 0, 100),
('compras_proveedores', 'Proveedores / Acreedores', 'compras', '1', 1, 0, 100),
('compras_trazabilidad', 'Trazabilidad', 'compras', '1', 0, 0, 100),
('contabilidad_asiento', 'Asiento', 'contabilidad', '1', 0, 0, 100),
('contabilidad_asientos', 'Asientos', 'contabilidad', '1', 1, 0, 100),
('contabilidad_cuenta', 'Cuenta', 'contabilidad', '1', 0, 0, 100),
('contabilidad_cuentas', 'Cuentas', 'contabilidad', '1', 1, 0, 100),
('contabilidad_ejercicio', 'Ejercicio', 'contabilidad', '1', 0, 0, 100),
('contabilidad_ejercicios', 'Ejercicios', 'contabilidad', '1', 1, 0, 100),
('contabilidad_epigrafes', 'Grupos y epígrafes', 'contabilidad', '1', 1, 0, 100),
('contabilidad_formas_pago', 'Formas de Pago', 'contabilidad', '1', 1, 0, 100),
('contabilidad_impuestos', 'Impuestos', 'contabilidad', '1', 1, 0, 100),
('contabilidad_nuevo_asiento', 'Nuevo asiento', 'contabilidad', '1', 0, 1, 100),
('contabilidad_series', 'Series', 'contabilidad', '1', 1, 0, 100),
('contabilidad_subcuenta', 'Subcuenta', 'contabilidad', '1', 0, 0, 100),
('cuentas_especiales', 'Cuentas Especiales', 'contabilidad', '1', 0, 0, 100),
('dashboard', 'Dashboard', 'informes', '1', 1, 1, 100),
('editar_balances', 'Editar balances', 'informes', '1', 0, 0, 100),
('editar_transferencia_stock', 'Editar transferencia', 'ventas', '1', 0, 0, 100),
('informe_albaranes', 'Guias de Remision', 'informes', '1', 1, 0, 100),
('informe_articulos', 'Artículos', 'informes', '1', 1, 0, 100),
('informe_contabilidad', 'Contabilidad', 'informes', '1', 1, 0, 100),
('informe_facturas', 'Facturas', 'informes', '1', 1, 0, 100),
('nueva_compra', 'Nueva compra...', 'compras', '1', 0, 1, 100),
('nueva_venta', 'Nueva venta...', 'ventas', '1', 0, 1, 100),
('subcuenta_asociada', 'Asignar subcuenta...', 'contabilidad', '1', 0, 0, 100),
('ventas_agrupar_albaranes', 'Agrupar Guias de Remision', 'ventas', '1', 0, 0, 100),
('ventas_albaran', 'Guia de Remision de cliente', 'ventas', '1', 0, 0, 100),
('ventas_albaranes', 'Guias de Remision', 'ventas', '1', 1, 0, 100),
('ventas_articulo', 'Articulo', 'ventas', '1', 0, 0, 100),
('ventas_articulos', 'Artículos', 'ventas', '1', 1, 0, 100),
('ventas_atributos', 'Atributos de artículos', 'ventas', '1', 0, 0, 100),
('ventas_cliente', 'Cliente', 'ventas', '1', 0, 0, 100),
('ventas_cliente_articulos', 'Articulos vendidos al cliente', 'ventas', '1', 0, 0, 100),
('ventas_clientes', 'Clientes', 'ventas', '1', 1, 0, 100),
('ventas_clientes_opciones', 'Opciones', 'clientes', '1', 0, 0, 100),
('ventas_fabricante', 'Familia', 'ventas', '1', 0, 0, 100),
('ventas_fabricantes', 'Fabricantes', 'ventas', '1', 0, 0, 100),
('ventas_factura', 'Factura de cliente', 'ventas', '1', 0, 0, 100),
('ventas_factura_devolucion', 'Devoluciones de factura de venta', 'ventas', '1', 0, 0, 100),
('ventas_facturas', 'Facturas', 'ventas', '1', 1, 0, 100),
('ventas_familia', 'Familia', 'ventas', '1', 0, 0, 100),
('ventas_familias', 'Familias', 'ventas', '1', 0, 0, 100),
('ventas_grupo', 'Grupo', 'ventas', '1', 0, 0, 100),
('ventas_imprimir', 'imprimir', 'ventas', '1', 0, 0, 100),
('ventas_maquetar', 'Maquetar', 'ventas', '1', 0, 0, 100),
('ventas_trazabilidad', 'Trazabilidad', 'ventas', '1', 0, 0, 100);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fs_roles`
--

CREATE TABLE `fs_roles` (
  `codrol` varchar(20) COLLATE utf8_bin NOT NULL,
  `descripcion` varchar(200) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `fs_roles`
--

INSERT INTO `fs_roles` (`codrol`, `descripcion`) VALUES
('VNT', 'Ventas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fs_roles_access`
--

CREATE TABLE `fs_roles_access` (
  `codrol` varchar(20) COLLATE utf8_bin NOT NULL,
  `fs_page` varchar(30) COLLATE utf8_bin NOT NULL,
  `allow_delete` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `fs_roles_access`
--

INSERT INTO `fs_roles_access` (`codrol`, `fs_page`, `allow_delete`) VALUES
('VNT', 'nueva_venta', 1),
('VNT', 'ventas_agrupar_albaranes', 1),
('VNT', 'ventas_albaran', 1),
('VNT', 'ventas_albaranes', 1),
('VNT', 'ventas_articulo', 1),
('VNT', 'ventas_articulos', 1),
('VNT', 'ventas_atributos', 1),
('VNT', 'ventas_cliente', 1),
('VNT', 'ventas_cliente_articulos', 1),
('VNT', 'ventas_clientes', 1),
('VNT', 'ventas_clientes_opciones', 1),
('VNT', 'ventas_fabricante', 1),
('VNT', 'ventas_fabricantes', 1),
('VNT', 'ventas_factura', 1),
('VNT', 'ventas_factura_devolucion', 1),
('VNT', 'ventas_facturas', 1),
('VNT', 'ventas_familia', 1),
('VNT', 'ventas_familias', 1),
('VNT', 'ventas_grupo', 1),
('VNT', 'ventas_imprimir', 1),
('VNT', 'ventas_maquetar', 1),
('VNT', 'ventas_trazabilidad', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fs_roles_users`
--

CREATE TABLE `fs_roles_users` (
  `codrol` varchar(20) COLLATE utf8_bin NOT NULL,
  `fs_user` varchar(12) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `fs_roles_users`
--

INSERT INTO `fs_roles_users` (`codrol`, `fs_user`) VALUES
('VNT', 'Shakun');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fs_users`
--

CREATE TABLE `fs_users` (
  `nick` varchar(12) COLLATE utf8_bin NOT NULL,
  `password` varchar(100) COLLATE utf8_bin NOT NULL,
  `log_key` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `enabled` tinyint(1) NOT NULL DEFAULT '1',
  `codagente` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `last_login` date DEFAULT NULL,
  `last_login_time` time DEFAULT NULL,
  `last_ip` varchar(40) COLLATE utf8_bin DEFAULT NULL,
  `last_browser` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `fs_page` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `css` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `fs_users`
--

INSERT INTO `fs_users` (`nick`, `password`, `log_key`, `admin`, `enabled`, `codagente`, `last_login`, `last_login_time`, `last_ip`, `last_browser`, `fs_page`, `css`, `email`) VALUES
('Michu', '3ea578d9f92cd5990fd42e9fe1e6324bdd0527a8', NULL, 1, 1, '4', NULL, NULL, NULL, '', NULL, 'view/css/bootstrap-yeti.min.css', 'michu.alava@gmail.com'),
('Shakun', 'd6ca126ee4b2f22212e93f0277ae19a0b3dc3599', NULL, 0, 1, '3', NULL, NULL, NULL, '', 'ventas_articulos', 'view/css/bootstrap-yeti.min.css', 'shakun_1997@gmail.com'),
('admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'b65cd8de313e987a6d4a5bebcf72bbcb95f493a2', 1, 1, '2', '2018-02-11', '23:12:04', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36 OPR/50.0.2762.67', 'admin_home', 'view/css/bootstrap-cosmo.min.css', 'xederiel@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fs_vars`
--

CREATE TABLE `fs_vars` (
  `name` varchar(35) COLLATE utf8_bin NOT NULL,
  `varchar` text COLLATE utf8_bin
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `fs_vars`
--

INSERT INTO `fs_vars` (`name`, `varchar`) VALUES
('install_step', '3'),
('mail_albaran', 'Buenos días, le adjunto su #DOCUMENTO#.\r\n#FIRMA#'),
('mail_bcc', ''),
('mail_enc', ''),
('mail_factura', 'Buenos días, le adjunto su #DOCUMENTO#.\r\n#FIRMA#'),
('mail_firma', '---\r\nEnviado con -Inserte Nombre-'),
('mail_host', NULL),
('mail_mailer', NULL),
('mail_password', '23sa09ul97'),
('mail_pedido', 'Buenos días, le adjunto su #DOCUMENTO#.\n#FIRMA#'),
('mail_port', '0'),
('mail_presupuesto', 'Buenos días, le adjunto su #DOCUMENTO#.\n#FIRMA#'),
('mail_user', NULL),
('multi_almacen', '1'),
('nuevocli_cifnif_req', '1'),
('nuevocli_ciudad', '1'),
('nuevocli_ciudad_req', '0'),
('nuevocli_codgrupo', ''),
('nuevocli_codpostal', '0'),
('nuevocli_codpostal_req', '0'),
('nuevocli_direccion', '1'),
('nuevocli_direccion_req', '0'),
('nuevocli_email', '1'),
('nuevocli_email_req', '0'),
('nuevocli_pais', '1'),
('nuevocli_pais_req', '0'),
('nuevocli_provincia', '1'),
('nuevocli_provincia_req', '0'),
('nuevocli_telefono1', '1'),
('nuevocli_telefono1_req', '0'),
('nuevocli_telefono2', '0'),
('nuevocli_telefono2_req', '0'),
('numeracion_personalizada', '1'),
('print_alb', '0'),
('print_dto', '1'),
('print_formapago', '1'),
('print_ref', '1'),
('updates', 'true');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gruposclientes`
--

CREATE TABLE `gruposclientes` (
  `codgrupo` varchar(6) COLLATE utf8_bin NOT NULL,
  `nombre` varchar(100) COLLATE utf8_bin NOT NULL,
  `codtarifa` varchar(6) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `gruposclientes`
--

INSERT INTO `gruposclientes` (`codgrupo`, `nombre`, `codtarifa`) VALUES
('000001', 'Grupo 1', NULL),
('000002', 'Grupo 2', NULL),
('000003', 'Grupo 3', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `impuestos`
--

CREATE TABLE `impuestos` (
  `codimpuesto` varchar(10) COLLATE utf8_bin NOT NULL,
  `codsubcuentaacr` varchar(15) COLLATE utf8_bin DEFAULT NULL,
  `codsubcuentadeu` varchar(15) COLLATE utf8_bin DEFAULT NULL,
  `codsubcuentaivadedadue` varchar(15) COLLATE utf8_bin DEFAULT NULL,
  `codsubcuentaivadevadue` varchar(15) COLLATE utf8_bin DEFAULT NULL,
  `codsubcuentaivadeventue` varchar(15) COLLATE utf8_bin DEFAULT NULL,
  `codsubcuentaivarepexe` varchar(15) COLLATE utf8_bin DEFAULT NULL,
  `codsubcuentaivarepexp` varchar(15) COLLATE utf8_bin DEFAULT NULL,
  `codsubcuentaivarepre` varchar(15) COLLATE utf8_bin DEFAULT NULL,
  `codsubcuentaivasopagra` varchar(15) COLLATE utf8_bin DEFAULT NULL,
  `codsubcuentaivasopexe` varchar(15) COLLATE utf8_bin DEFAULT NULL,
  `codsubcuentaivasopimp` varchar(15) COLLATE utf8_bin DEFAULT NULL,
  `codsubcuentarep` varchar(15) COLLATE utf8_bin DEFAULT NULL,
  `codsubcuentasop` varchar(15) COLLATE utf8_bin DEFAULT NULL,
  `descripcion` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `idsubcuentaacr` int(11) DEFAULT NULL,
  `idsubcuentadeu` int(11) DEFAULT NULL,
  `idsubcuentaivadedadue` int(11) DEFAULT NULL,
  `idsubcuentaivadevadue` int(11) DEFAULT NULL,
  `idsubcuentaivadeventue` int(11) DEFAULT NULL,
  `idsubcuentaivarepexe` int(11) DEFAULT NULL,
  `idsubcuentaivarepexp` int(11) DEFAULT NULL,
  `idsubcuentaivarepre` int(11) DEFAULT NULL,
  `idsubcuentaivasopagra` int(11) DEFAULT NULL,
  `idsubcuentaivasopexe` int(11) DEFAULT NULL,
  `idsubcuentaivasopimp` int(11) DEFAULT NULL,
  `idsubcuentarep` int(11) DEFAULT NULL,
  `idsubcuentasop` int(11) DEFAULT NULL,
  `iva` double NOT NULL,
  `recargo` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `impuestos`
--

INSERT INTO `impuestos` (`codimpuesto`, `codsubcuentaacr`, `codsubcuentadeu`, `codsubcuentaivadedadue`, `codsubcuentaivadevadue`, `codsubcuentaivadeventue`, `codsubcuentaivarepexe`, `codsubcuentaivarepexp`, `codsubcuentaivarepre`, `codsubcuentaivasopagra`, `codsubcuentaivasopexe`, `codsubcuentaivasopimp`, `codsubcuentarep`, `codsubcuentasop`, `descripcion`, `idsubcuentaacr`, `idsubcuentadeu`, `idsubcuentaivadedadue`, `idsubcuentaivadevadue`, `idsubcuentaivadeventue`, `idsubcuentaivarepexe`, `idsubcuentaivarepexp`, `idsubcuentaivarepre`, `idsubcuentaivasopagra`, `idsubcuentaivasopexe`, `idsubcuentaivasopimp`, `idsubcuentarep`, `idsubcuentasop`, `iva`, `recargo`) VALUES
('EC0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'EC 0%', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
('EC12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'EC 12%', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineasalbaranescli`
--

CREATE TABLE `lineasalbaranescli` (
  `cantidad` double NOT NULL DEFAULT '0',
  `codimpuesto` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `descripcion` text COLLATE utf8_bin,
  `dtolineal` double DEFAULT '0',
  `dtopor` double NOT NULL DEFAULT '0',
  `dtopor2` double NOT NULL DEFAULT '0',
  `dtopor3` double NOT NULL DEFAULT '0',
  `dtopor4` double NOT NULL DEFAULT '0',
  `idalbaran` int(11) NOT NULL,
  `idlinea` int(11) NOT NULL,
  `idlineapedido` int(11) DEFAULT NULL,
  `idpedido` int(11) DEFAULT NULL,
  `irpf` double DEFAULT NULL,
  `iva` double NOT NULL DEFAULT '0',
  `porcomision` double DEFAULT NULL,
  `pvpsindto` double NOT NULL DEFAULT '0',
  `pvptotal` double NOT NULL DEFAULT '0',
  `pvpunitario` double NOT NULL DEFAULT '0',
  `recargo` double DEFAULT '0',
  `referencia` varchar(18) COLLATE utf8_bin DEFAULT NULL,
  `codcombinacion` varchar(18) COLLATE utf8_bin DEFAULT NULL,
  `orden` int(11) DEFAULT '0',
  `mostrar_cantidad` tinyint(1) DEFAULT '1',
  `mostrar_precio` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `lineasalbaranescli`
--

INSERT INTO `lineasalbaranescli` (`cantidad`, `codimpuesto`, `descripcion`, `dtolineal`, `dtopor`, `dtopor2`, `dtopor3`, `dtopor4`, `idalbaran`, `idlinea`, `idlineapedido`, `idpedido`, `irpf`, `iva`, `porcomision`, `pvpsindto`, `pvptotal`, `pvpunitario`, `recargo`, `referencia`, `codcombinacion`, `orden`, `mostrar_cantidad`, `mostrar_precio`) VALUES
(1, 'EC12', 'Producto 5', 0, 0, 0, 0, 0, 1, 1, NULL, NULL, 0, 12, NULL, 26.79, 26.79, 26.79, 0, '5', NULL, 0, 1, 1),
(3, 'EC12', 'Producto 5', 0, 0, 0, 0, 0, 3, 5, NULL, NULL, 0, 12, NULL, 80.37, 80.37, 26.79, 0, '5', NULL, 0, 1, 1),
(3, 'EC0', 'Producto 6', 0, 0, 0, 0, 0, 3, 6, NULL, NULL, 0, 0, NULL, 53.67, 53.67, 17.89, 0, '6', NULL, 0, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineasalbaranesprov`
--

CREATE TABLE `lineasalbaranesprov` (
  `cantidad` double NOT NULL DEFAULT '0',
  `codimpuesto` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `descripcion` text COLLATE utf8_bin,
  `dtolineal` double DEFAULT '0',
  `dtopor` double NOT NULL DEFAULT '0',
  `idalbaran` int(11) NOT NULL,
  `idlinea` int(11) NOT NULL,
  `idlineapedido` int(11) DEFAULT NULL,
  `idpedido` int(11) DEFAULT NULL,
  `irpf` double DEFAULT NULL,
  `iva` double NOT NULL DEFAULT '0',
  `pvpsindto` double NOT NULL DEFAULT '0',
  `pvptotal` double NOT NULL DEFAULT '0',
  `pvpunitario` double NOT NULL DEFAULT '0',
  `recargo` double DEFAULT '0',
  `referencia` varchar(18) COLLATE utf8_bin DEFAULT NULL,
  `codcombinacion` varchar(18) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineasfacturascli`
--

CREATE TABLE `lineasfacturascli` (
  `cantidad` double NOT NULL DEFAULT '0',
  `codimpuesto` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `descripcion` text COLLATE utf8_bin,
  `dtolineal` double DEFAULT '0',
  `dtopor` double NOT NULL DEFAULT '0',
  `dtopor2` double NOT NULL DEFAULT '0',
  `dtopor3` double NOT NULL DEFAULT '0',
  `dtopor4` double NOT NULL DEFAULT '0',
  `idalbaran` int(11) DEFAULT NULL,
  `idfactura` int(11) NOT NULL,
  `idlinea` int(11) NOT NULL,
  `idlineaalbaran` int(11) DEFAULT NULL,
  `irpf` double DEFAULT NULL,
  `iva` double NOT NULL,
  `porcomision` double DEFAULT NULL,
  `pvpsindto` double NOT NULL,
  `pvptotal` double NOT NULL,
  `pvpunitario` double NOT NULL,
  `recargo` double DEFAULT NULL,
  `referencia` varchar(18) COLLATE utf8_bin DEFAULT NULL,
  `codcombinacion` varchar(18) COLLATE utf8_bin DEFAULT NULL,
  `orden` int(11) DEFAULT '0',
  `mostrar_cantidad` tinyint(1) DEFAULT '1',
  `mostrar_precio` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `lineasfacturascli`
--

INSERT INTO `lineasfacturascli` (`cantidad`, `codimpuesto`, `descripcion`, `dtolineal`, `dtopor`, `dtopor2`, `dtopor3`, `dtopor4`, `idalbaran`, `idfactura`, `idlinea`, `idlineaalbaran`, `irpf`, `iva`, `porcomision`, `pvpsindto`, `pvptotal`, `pvpunitario`, `recargo`, `referencia`, `codcombinacion`, `orden`, `mostrar_cantidad`, `mostrar_precio`) VALUES
(1, 'EC12', 'Producto 5', 0, 2, 0, 0, 0, NULL, 3, 4, NULL, 0, 12, NULL, 26.79, 26.2542, 26.79, 0, '5', NULL, 3, 1, 1),
(1, 'EC0', 'Producto 6', 0, 3, 0, 0, 0, NULL, 3, 5, NULL, 0, 0, NULL, 17.89, 17.3533, 17.89, 0, '6', NULL, 2, 1, 1),
(-1, 'EC12', 'Producto 5', 0, 2, 0, 0, 0, NULL, 4, 6, NULL, 0, 12, NULL, -26.79, -26.2542, 26.79, 0, '5', NULL, 3, 1, 1),
(1, 'EC12', 'Producto 5', 0, 0, 0, 0, 0, 1, 5, 7, 1, 0, 12, NULL, 26.79, 26.79, 26.79, 0, '5', NULL, 0, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineasfacturasprov`
--

CREATE TABLE `lineasfacturasprov` (
  `cantidad` double NOT NULL,
  `codimpuesto` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `codsubcuenta` varchar(15) COLLATE utf8_bin DEFAULT NULL,
  `descripcion` text COLLATE utf8_bin,
  `dtolineal` double DEFAULT '0',
  `dtopor` double NOT NULL,
  `idalbaran` int(11) DEFAULT NULL,
  `idfactura` int(11) NOT NULL,
  `idlinea` int(11) NOT NULL,
  `idlineaalbaran` int(11) DEFAULT NULL,
  `idsubcuenta` int(11) DEFAULT NULL,
  `irpf` double DEFAULT NULL,
  `iva` double NOT NULL,
  `pvpsindto` double NOT NULL,
  `pvptotal` double DEFAULT NULL,
  `pvpunitario` double NOT NULL,
  `recargo` double DEFAULT NULL,
  `referencia` varchar(18) COLLATE utf8_bin DEFAULT NULL,
  `codcombinacion` varchar(18) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `lineasfacturasprov`
--

INSERT INTO `lineasfacturasprov` (`cantidad`, `codimpuesto`, `codsubcuenta`, `descripcion`, `dtolineal`, `dtopor`, `idalbaran`, `idfactura`, `idlinea`, `idlineaalbaran`, `idsubcuenta`, `irpf`, `iva`, `pvpsindto`, `pvptotal`, `pvpunitario`, `recargo`, `referencia`, `codcombinacion`) VALUES
(1, 'EC12', NULL, 'Productto4', 0, 3, NULL, 1, 1, NULL, NULL, 0, 12, 10, 9.7, 10, 0, '4', NULL),
(1, 'EC12', NULL, 'Producto 5', 0, 2, NULL, 1, 2, NULL, NULL, 0, 12, 173, 169.54, 173, 0, '5', NULL),
(1, 'EC0', NULL, 'Producto 6', 0, 1, NULL, 1, 3, NULL, NULL, 0, 0, 198.99, 197.0001, 198.99, 0, '6', NULL),
(6, 'EC12', NULL, 'Productto4', 0, 0, NULL, 2, 4, NULL, NULL, 0, 12, 58.2, 58.2, 9.7, 0, '4', NULL),
(11, 'EC12', NULL, 'Producto 5', 0, 0, NULL, 2, 5, NULL, NULL, 0, 12, 1864.94, 1864.94, 169.54, 0, '5', NULL),
(2, 'EC0', NULL, 'Producto 6', 0, 0, NULL, 2, 6, NULL, NULL, 0, 0, 394.0002, 394.0002, 197.0001, 0, '6', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineasivafactcli`
--

CREATE TABLE `lineasivafactcli` (
  `codimpuesto` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `idfactura` int(11) NOT NULL,
  `idlinea` int(11) NOT NULL,
  `iva` double NOT NULL DEFAULT '0',
  `neto` double NOT NULL DEFAULT '0',
  `recargo` double NOT NULL DEFAULT '0',
  `totaliva` double NOT NULL DEFAULT '0',
  `totallinea` double NOT NULL DEFAULT '0',
  `totalrecargo` double NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `lineasivafactcli`
--

INSERT INTO `lineasivafactcli` (`codimpuesto`, `idfactura`, `idlinea`, `iva`, `neto`, `recargo`, `totaliva`, `totallinea`, `totalrecargo`) VALUES
('EC12', 3, 1, 12, 26.25, 0, 3.15, 29.4, 0),
('EC0', 3, 2, 0, 17.35, 0, 0, 17.35, 0),
('EC12', 4, 3, 12, -26.25, 0, -3.15, -29.4, 0),
('EC12', 5, 4, 12, 26.79, 0, 3.21, 30, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineasivafactprov`
--

CREATE TABLE `lineasivafactprov` (
  `codimpuesto` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `idfactura` int(11) NOT NULL,
  `idlinea` int(11) NOT NULL,
  `iva` double NOT NULL DEFAULT '0',
  `neto` double NOT NULL DEFAULT '0',
  `recargo` double NOT NULL DEFAULT '0',
  `totaliva` double NOT NULL DEFAULT '0',
  `totallinea` double NOT NULL DEFAULT '0',
  `totalrecargo` double NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `lineasivafactprov`
--

INSERT INTO `lineasivafactprov` (`codimpuesto`, `idfactura`, `idlinea`, `iva`, `neto`, `recargo`, `totaliva`, `totallinea`, `totalrecargo`) VALUES
('EC12', 1, 1, 12, 179.24, 0, 21.51, 200.75, 0),
('EC0', 1, 2, 0, 197, 0, 0, 197, 0),
('EC12', 2, 3, 12, 1923.14, 0, 230.78, 2153.92, 0),
('EC0', 2, 4, 0, 394, 0, 0, 394, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineasregstocks`
--

CREATE TABLE `lineasregstocks` (
  `cantidadfin` double NOT NULL DEFAULT '0',
  `cantidadini` double NOT NULL DEFAULT '0',
  `codalmacendest` varchar(4) COLLATE utf8_bin DEFAULT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `id` int(11) NOT NULL,
  `idstock` int(11) NOT NULL,
  `motivo` text COLLATE utf8_bin,
  `nick` varchar(12) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `lineasregstocks`
--

INSERT INTO `lineasregstocks` (`cantidadfin`, `cantidadini`, `codalmacendest`, `fecha`, `hora`, `id`, `idstock`, `motivo`, `nick`) VALUES
(28, 0, 'ALG', '2018-02-11', '15:04:10', 1, 3, '', 'admin'),
(18, 0, 'ALG', '2018-02-11', '15:05:01', 2, 5, '', 'admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineastransstock`
--

CREATE TABLE `lineastransstock` (
  `cantidad` double NOT NULL,
  `descripcion` text COLLATE utf8_bin,
  `idlinea` int(11) NOT NULL,
  `idtrans` int(11) NOT NULL,
  `referencia` varchar(18) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `lineastransstock`
--

INSERT INTO `lineastransstock` (`cantidad`, `descripcion`, `idlinea`, `idtrans`, `referencia`) VALUES
(1, 'Producto', 1, 1, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paises`
--

CREATE TABLE `paises` (
  `validarprov` tinyint(1) DEFAULT NULL,
  `codiso` varchar(2) COLLATE utf8_bin DEFAULT NULL,
  `bandera` text COLLATE utf8_bin,
  `nombre` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `codpais` varchar(20) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `paises`
--

INSERT INTO `paises` (`validarprov`, `codiso`, `bandera`, `nombre`, `codpais`) VALUES
(NULL, 'AW', NULL, 'Aruba', 'ABW'),
(NULL, 'AF', NULL, 'Afganistán', 'AFG'),
(NULL, 'AO', NULL, 'Angola', 'AGO'),
(NULL, 'AI', NULL, 'Anguila', 'AIA'),
(NULL, 'AX', NULL, 'Islas Gland', 'ALA'),
(NULL, 'AL', NULL, 'Albania', 'ALB'),
(NULL, 'AD', NULL, 'Andorra', 'AND'),
(NULL, 'AN', NULL, 'Antillas Holandesas', 'ANT'),
(NULL, 'AE', NULL, 'Emiratos Árabes Unidos', 'ARE'),
(NULL, 'AR', NULL, 'Argentina', 'ARG'),
(NULL, 'AM', NULL, 'Armenia', 'ARM'),
(NULL, 'AS', NULL, 'Samoa Americana', 'ASM'),
(NULL, 'AQ', NULL, 'Antártida', 'ATA'),
(NULL, 'TF', NULL, 'Territorios Australes Franceses', 'ATF'),
(NULL, 'AG', NULL, 'Antigua y Barbuda', 'ATG'),
(NULL, 'AU', NULL, 'Australia', 'AUS'),
(NULL, 'AT', NULL, 'Austria', 'AUT'),
(NULL, 'AZ', NULL, 'Azerbaiyán', 'AZE'),
(NULL, 'BI', NULL, 'Burundi', 'BDI'),
(NULL, 'BE', NULL, 'Bélgica', 'BEL'),
(NULL, 'BJ', NULL, 'Benín', 'BEN'),
(NULL, 'BF', NULL, 'Burkina Faso', 'BFA'),
(NULL, 'BD', NULL, 'Bangladesh', 'BGD'),
(NULL, 'BG', NULL, 'Bulgaria', 'BGR'),
(NULL, 'BH', NULL, 'Bahréin', 'BHR'),
(NULL, 'BS', NULL, 'Bahamas', 'BHS'),
(NULL, 'BA', NULL, 'Bosnia y Herzegovina', 'BIH'),
(NULL, 'BY', NULL, 'Bielorrusia', 'BLR'),
(NULL, 'BZ', NULL, 'Belice', 'BLZ'),
(NULL, 'BM', NULL, 'Bermudas', 'BMU'),
(NULL, 'BO', NULL, 'Bolivia', 'BOL'),
(NULL, 'BR', NULL, 'Brasil', 'BRA'),
(NULL, 'BB', NULL, 'Barbados', 'BRB'),
(NULL, 'BN', NULL, 'Brunéi', 'BRN'),
(NULL, 'BT', NULL, 'Bhután', 'BTN'),
(NULL, 'BV', NULL, 'Isla Bouvet', 'BVT'),
(NULL, 'BW', NULL, 'Botsuana', 'BWA'),
(NULL, 'CF', NULL, 'República Centroafricana', 'CAF'),
(NULL, 'CA', NULL, 'Canadá', 'CAN'),
(NULL, 'CC', NULL, 'Islas Cocos', 'CCK'),
(NULL, 'CH', NULL, 'Suiza', 'CHE'),
(NULL, 'CL', NULL, 'Chile', 'CHL'),
(NULL, 'CN', NULL, 'China', 'CHN'),
(NULL, 'CI', NULL, 'Costa de Marfil', 'CIV'),
(NULL, 'CM', NULL, 'Camerún', 'CMR'),
(NULL, 'CD', NULL, 'República Democrática del Congo', 'COD'),
(NULL, 'CG', NULL, 'Congo', 'COG'),
(NULL, 'CK', NULL, 'Islas Cook', 'COK'),
(NULL, 'CO', NULL, 'Colombia', 'COL'),
(NULL, 'KM', NULL, 'Comoras', 'COM'),
(NULL, 'CV', NULL, 'Cabo Verde', 'CPV'),
(NULL, 'CR', NULL, 'Costa Rica', 'CRI'),
(NULL, 'CU', NULL, 'Cuba', 'CUB'),
(NULL, 'CX', NULL, 'Isla de Navidad', 'CXR'),
(NULL, 'KY', NULL, 'Islas Caimán', 'CYM'),
(NULL, 'CY', NULL, 'Chipre', 'CYP'),
(NULL, 'CZ', NULL, 'República Checa', 'CZE'),
(NULL, 'DE', NULL, 'Alemania', 'DEU'),
(NULL, 'DJ', NULL, 'Yibuti', 'DJI'),
(NULL, 'DM', NULL, 'Dominica', 'DMA'),
(NULL, 'DK', NULL, 'Dinamarca', 'DNK'),
(NULL, 'DO', NULL, 'República Dominicana', 'DOM'),
(NULL, 'DZ', NULL, 'Argelia', 'DZA'),
(NULL, 'EC', NULL, 'Ecuador', 'ECU'),
(NULL, 'EG', NULL, 'Egipto', 'EGY'),
(NULL, 'ER', NULL, 'Eritrea', 'ERI'),
(NULL, 'EH', NULL, 'Sahara Occidental', 'ESH'),
(NULL, 'ES', NULL, 'España', 'ESP'),
(NULL, 'EE', NULL, 'Estonia', 'EST'),
(NULL, 'ET', NULL, 'Etiopía', 'ETH'),
(NULL, 'FI', NULL, 'Finlandia', 'FIN'),
(NULL, 'FJ', NULL, 'Fiyi', 'FJI'),
(NULL, 'FK', NULL, 'Islas Malvinas', 'FLK'),
(NULL, 'FR', NULL, 'Francia', 'FRA'),
(NULL, 'FO', NULL, 'Islas Feroe', 'FRO'),
(NULL, 'FM', NULL, 'Micronesia', 'FSM'),
(NULL, 'GA', NULL, 'Gabón', 'GAB'),
(NULL, 'GB', NULL, 'Reino Unido', 'GBR'),
(NULL, 'GE', NULL, 'Georgia', 'GEO'),
(NULL, 'GH', NULL, 'Ghana', 'GHA'),
(NULL, 'GI', NULL, 'Gibraltar', 'GIB'),
(NULL, 'GN', NULL, 'Guinea', 'GIN'),
(NULL, 'GP', NULL, 'Guadalupe', 'GLP'),
(NULL, 'GM', NULL, 'Gambia', 'GMB'),
(NULL, 'GW', NULL, 'Guinea-Bissau', 'GNB'),
(NULL, 'GQ', NULL, 'Guinea Ecuatorial', 'GNQ'),
(NULL, 'GR', NULL, 'Grecia', 'GRC'),
(NULL, 'GD', NULL, 'Granada', 'GRD'),
(NULL, 'GL', NULL, 'Groenlandia', 'GRL'),
(NULL, 'GT', NULL, 'Guatemala', 'GTM'),
(NULL, 'GF', NULL, 'Guayana Francesa', 'GUF'),
(NULL, 'GU', NULL, 'Guam', 'GUM'),
(NULL, 'GY', NULL, 'Guyana', 'GUY'),
(NULL, 'HK', NULL, 'Hong Kong', 'HKG'),
(NULL, 'HM', NULL, 'Islas Heard y McDonald', 'HMD'),
(NULL, 'HN', NULL, 'Honduras', 'HND'),
(NULL, 'HR', NULL, 'Croacia', 'HRV'),
(NULL, 'HT', NULL, 'Haití', 'HTI'),
(NULL, 'HU', NULL, 'Hungría', 'HUN'),
(NULL, 'ID', NULL, 'Indonesia', 'IDN'),
(NULL, 'IN', NULL, 'India', 'IND'),
(NULL, 'IO', NULL, 'Territorio Británico del Océano Índico', 'IOT'),
(NULL, 'IE', NULL, 'Irlanda', 'IRL'),
(NULL, 'IR', NULL, 'Irán', 'IRN'),
(NULL, 'IQ', NULL, 'Iraq', 'IRQ'),
(NULL, 'IS', NULL, 'Islandia', 'ISL'),
(NULL, 'IL', NULL, 'Israel', 'ISR'),
(NULL, 'IT', NULL, 'Italia', 'ITA'),
(NULL, 'JM', NULL, 'Jamaica', 'JAM'),
(NULL, 'JO', NULL, 'Jordania', 'JOR'),
(NULL, 'JP', NULL, 'Japón', 'JPN'),
(NULL, 'KZ', NULL, 'Kazajstán', 'KAZ'),
(NULL, 'KE', NULL, 'Kenia', 'KEN'),
(NULL, 'KG', NULL, 'Kirguistán', 'KGZ'),
(NULL, 'KH', NULL, 'Camboya', 'KHM'),
(NULL, 'KI', NULL, 'Kiribati', 'KIR'),
(NULL, 'KN', NULL, 'San Cristóbal y Nieves', 'KNA'),
(NULL, 'KR', NULL, 'Corea del Sur', 'KOR'),
(NULL, 'KW', NULL, 'Kuwait', 'KWT'),
(NULL, 'LA', NULL, 'Laos', 'LAO'),
(NULL, 'LB', NULL, 'Líbano', 'LBN'),
(NULL, 'LR', NULL, 'Liberia', 'LBR'),
(NULL, 'LY', NULL, 'Libia', 'LBY'),
(NULL, 'LC', NULL, 'Santa Lucía', 'LCA'),
(NULL, 'LI', NULL, 'Liechtenstein', 'LIE'),
(NULL, 'LK', NULL, 'Sri Lanka', 'LKA'),
(NULL, 'LS', NULL, 'Lesotho', 'LSO'),
(NULL, 'LT', NULL, 'Lituania', 'LTU'),
(NULL, 'LU', NULL, 'Luxemburgo', 'LUX'),
(NULL, 'LV', NULL, 'Letonia', 'LVA'),
(NULL, 'MO', NULL, 'Macao', 'MAC'),
(NULL, 'MA', NULL, 'Marruecos', 'MAR'),
(NULL, 'MC', NULL, 'Mónaco', 'MCO'),
(NULL, 'MD', NULL, 'Moldavia', 'MDA'),
(NULL, 'MG', NULL, 'Madagascar', 'MDG'),
(NULL, 'MV', NULL, 'Maldivas', 'MDV'),
(NULL, 'MX', NULL, 'México', 'MEX'),
(NULL, 'MH', NULL, 'Islas Marshall', 'MHL'),
(NULL, 'MK', NULL, 'Macedonia', 'MKD'),
(NULL, 'ML', NULL, 'Malí', 'MLI'),
(NULL, 'MT', NULL, 'Malta', 'MLT'),
(NULL, 'MM', NULL, 'Myanmar', 'MMR'),
(NULL, 'ME', NULL, 'Montenegro', 'MNE'),
(NULL, 'MN', NULL, 'Mongolia', 'MNG'),
(NULL, 'MP', NULL, 'Islas Marianas del Norte', 'MNP'),
(NULL, 'MZ', NULL, 'Mozambique', 'MOZ'),
(NULL, 'MR', NULL, 'Mauritania', 'MRT'),
(NULL, 'MS', NULL, 'Montserrat', 'MSR'),
(NULL, 'MQ', NULL, 'Martinica', 'MTQ'),
(NULL, 'MU', NULL, 'Mauricio', 'MUS'),
(NULL, 'MW', NULL, 'Malaui', 'MWI'),
(NULL, 'MY', NULL, 'Malasia', 'MYS'),
(NULL, 'YT', NULL, 'Mayotte', 'MYT'),
(NULL, 'NA', NULL, 'Namibia', 'NAM'),
(NULL, 'NC', NULL, 'Nueva Caledonia', 'NCL'),
(NULL, 'NE', NULL, 'Níger', 'NER'),
(NULL, 'NF', NULL, 'Isla Norfolk', 'NFK'),
(NULL, 'NG', NULL, 'Nigeria', 'NGA'),
(NULL, 'NI', NULL, 'Nicaragua', 'NIC'),
(NULL, 'NU', NULL, 'Niue', 'NIU'),
(NULL, 'NL', NULL, 'Países Bajos', 'NLD'),
(NULL, 'NO', NULL, 'Noruega', 'NOR'),
(NULL, 'NP', NULL, 'Nepal', 'NPL'),
(NULL, 'NR', NULL, 'Nauru', 'NRU'),
(NULL, 'NZ', NULL, 'Nueva Zelanda', 'NZL'),
(NULL, 'OM', NULL, 'Omán', 'OMN'),
(NULL, 'PK', NULL, 'Pakistán', 'PAK'),
(NULL, 'PA', NULL, 'Panamá', 'PAN'),
(NULL, 'PN', NULL, 'Islas Pitcairn', 'PCN'),
(NULL, 'PE', NULL, 'Perú', 'PER'),
(NULL, 'PH', NULL, 'Filipinas', 'PHL'),
(NULL, 'PW', NULL, 'Palaos', 'PLW'),
(NULL, 'PG', NULL, 'Papúa Nueva Guinea', 'PNG'),
(NULL, 'PL', NULL, 'Polonia', 'POL'),
(NULL, 'PR', NULL, 'Puerto Rico', 'PRI'),
(NULL, 'KP', NULL, 'Corea del Norte', 'PRK'),
(NULL, 'PT', NULL, 'Portugal', 'PRT'),
(NULL, 'PY', NULL, 'Paraguay', 'PRY'),
(NULL, 'PS', NULL, 'Palestina', 'PSE'),
(NULL, 'PF', NULL, 'Polinesia Francesa', 'PYF'),
(NULL, 'QA', NULL, 'Qatar', 'QAT'),
(NULL, 'RE', NULL, 'Reunión', 'REU'),
(NULL, 'RO', NULL, 'Rumania', 'ROU'),
(NULL, 'RU', NULL, 'Rusia', 'RUS'),
(NULL, 'RW', NULL, 'Ruanda', 'RWA'),
(NULL, 'SA', NULL, 'Arabia Saudí', 'SAU'),
(NULL, 'SD', NULL, 'Sudán', 'SDN'),
(NULL, 'SN', NULL, 'Senegal', 'SEN'),
(NULL, 'SG', NULL, 'Singapur', 'SGP'),
(NULL, 'GS', NULL, 'Islas Georgias del Sur y Sandwich del Sur', 'SGS'),
(NULL, 'SH', NULL, 'Santa Helena', 'SHN'),
(NULL, 'SJ', NULL, 'Svalbard y Jan Mayen', 'SJM'),
(NULL, 'SB', NULL, 'Islas Salomón', 'SLB'),
(NULL, 'SL', NULL, 'Sierra Leona', 'SLE'),
(NULL, 'SV', NULL, 'El Salvador', 'SLV'),
(NULL, 'SM', NULL, 'San Marino', 'SMR'),
(NULL, 'SO', NULL, 'Somalia', 'SOM'),
(NULL, 'PM', NULL, 'San Pedro y Miquelón', 'SPM'),
(NULL, 'RS', NULL, 'Serbia', 'SRB'),
(NULL, 'ST', NULL, 'Santo Tomé y Príncipe', 'STP'),
(NULL, 'SR', NULL, 'Surinam', 'SUR'),
(NULL, 'SK', NULL, 'Eslovaquia', 'SVK'),
(NULL, 'SI', NULL, 'Eslovenia', 'SVN'),
(NULL, 'SE', NULL, 'Suecia', 'SWE'),
(NULL, 'SZ', NULL, 'Suazilandia', 'SWZ'),
(NULL, 'SC', NULL, 'Seychelles', 'SYC'),
(NULL, 'SY', NULL, 'Siria', 'SYR'),
(NULL, 'TC', NULL, 'Islas Turcas y Caicos', 'TCA'),
(NULL, 'TD', NULL, 'Chad', 'TCD'),
(NULL, 'TG', NULL, 'Togo', 'TGO'),
(NULL, 'TH', NULL, 'Tailandia', 'THA'),
(NULL, 'TJ', NULL, 'Tayikistán', 'TJK'),
(NULL, 'TK', NULL, 'Tokelau', 'TKL'),
(NULL, 'TM', NULL, 'Turkmenistán', 'TKM'),
(NULL, 'TL', NULL, 'Timor Oriental', 'TLS'),
(NULL, 'TO', NULL, 'Tonga', 'TON'),
(NULL, 'TT', NULL, 'Trinidad y Tobago', 'TTO'),
(NULL, 'TN', NULL, 'Túnez', 'TUN'),
(NULL, 'TR', NULL, 'Turquía', 'TUR'),
(NULL, 'TV', NULL, 'Tuvalu', 'TUV'),
(NULL, 'TW', NULL, 'Taiwán', 'TWN'),
(NULL, 'TZ', NULL, 'Tanzania', 'TZA'),
(NULL, 'UG', NULL, 'Uganda', 'UGA'),
(NULL, 'UA', NULL, 'Ucrania', 'UKR'),
(NULL, 'UM', NULL, 'Islas Ultramarinas de Estados Unidos', 'UMI'),
(NULL, 'UY', NULL, 'Uruguay', 'URY'),
(NULL, 'US', NULL, 'Estados Unidos', 'USA'),
(NULL, 'UZ', NULL, 'Uzbekistán', 'UZB'),
(NULL, 'VA', NULL, 'Ciudad del Vaticano', 'VAT'),
(NULL, 'VC', NULL, 'San Vicente y las Granadinas', 'VCT'),
(NULL, 'VE', NULL, 'Venezuela', 'VEN'),
(NULL, 'VG', NULL, 'Islas Vírgenes Británicas', 'VGB'),
(NULL, 'VI', NULL, 'Islas Vírgenes de los Estados Unidos', 'VIR'),
(NULL, 'VN', NULL, 'Vietnam', 'VNM'),
(NULL, 'VU', NULL, 'Vanuatu', 'VUT'),
(NULL, 'WF', NULL, 'Wallis y Futuna', 'WLF'),
(NULL, 'WS', NULL, 'Samoa', 'WSM'),
(NULL, 'YE', NULL, 'Yemen', 'YEM'),
(NULL, 'ZA', NULL, 'Sudáfrica', 'ZAF'),
(NULL, 'ZM', NULL, 'Zambia', 'ZMB'),
(NULL, 'ZW', NULL, 'Zimbabue', 'ZWE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `cifnif` varchar(30) COLLATE utf8_bin NOT NULL,
  `codcontacto` varchar(6) COLLATE utf8_bin DEFAULT NULL,
  `codcuentadom` varchar(6) COLLATE utf8_bin DEFAULT NULL,
  `codcuentapago` varchar(6) COLLATE utf8_bin DEFAULT NULL,
  `coddivisa` varchar(3) COLLATE utf8_bin DEFAULT NULL,
  `codpago` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `codproveedor` varchar(6) COLLATE utf8_bin NOT NULL,
  `codserie` varchar(2) COLLATE utf8_bin DEFAULT NULL,
  `codsubcuenta` varchar(15) COLLATE utf8_bin DEFAULT NULL,
  `contacto` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `fax` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `idsubcuenta` int(11) DEFAULT NULL,
  `ivaportes` double DEFAULT NULL,
  `nombre` varchar(100) COLLATE utf8_bin NOT NULL,
  `razonsocial` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `observaciones` text COLLATE utf8_bin,
  `recfinanciero` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `regimeniva` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `telefono1` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `telefono2` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `tipoidfiscal` varchar(25) COLLATE utf8_bin NOT NULL DEFAULT 'NIF',
  `web` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `acreedor` tinyint(1) DEFAULT '0',
  `personafisica` tinyint(1) DEFAULT '1',
  `debaja` tinyint(1) DEFAULT '0',
  `fechabaja` date DEFAULT NULL,
  `codcliente` varchar(6) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`cifnif`, `codcontacto`, `codcuentadom`, `codcuentapago`, `coddivisa`, `codpago`, `codproveedor`, `codserie`, `codsubcuenta`, `contacto`, `email`, `fax`, `idsubcuenta`, `ivaportes`, `nombre`, `razonsocial`, `observaciones`, `recfinanciero`, `regimeniva`, `telefono1`, `telefono2`, `tipoidfiscal`, `web`, `acreedor`, `personafisica`, `debaja`, `fechabaja`, `codcliente`) VALUES
('1317038881', NULL, NULL, NULL, 'USD', 'CONT', '000001', NULL, NULL, NULL, '', '', NULL, NULL, 'Protagonista la anaconda', 'Luis Velez Velez', 'Buena Observacion', NULL, 'General', '', '', '', '', 0, 1, 0, '2018-02-11', NULL),
('1315330561', NULL, NULL, NULL, 'USD', 'CONT', '000002', NULL, NULL, NULL, '', '', NULL, NULL, 'Kachorro', 'Javier Gilson', '', NULL, 'General', '', '', '', '', 0, 0, 0, '2018-02-11', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `secuencias`
--

CREATE TABLE `secuencias` (
  `descripcion` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `id` int(11) NOT NULL,
  `idsec` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_bin NOT NULL,
  `valor` int(11) DEFAULT NULL,
  `valorout` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `secuencias`
--

INSERT INTO `secuencias` (`descripcion`, `id`, `idsec`, `nombre`, `valor`, `valorout`) VALUES
('Secuencia del ejercicio 2018 y la serie A', 1, 1, 'nfacturacli', 1, 3),
('Secuencia del ejercicio 2018 y la serie A', 1, 2, 'nfacturaprov', 1, 3),
('Secuencia del ejercicio 2018 y la serie R', 2, 3, 'nfacturacli', 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `secuenciasejercicios`
--

CREATE TABLE `secuenciasejercicios` (
  `codejercicio` varchar(4) COLLATE utf8_bin NOT NULL,
  `codserie` varchar(2) COLLATE utf8_bin NOT NULL,
  `id` int(11) NOT NULL,
  `nalbarancli` int(11) NOT NULL,
  `nalbaranprov` int(11) NOT NULL,
  `nfacturacli` int(11) NOT NULL,
  `nfacturaprov` int(11) NOT NULL,
  `npedidocli` int(11) NOT NULL,
  `npedidoprov` int(11) NOT NULL,
  `npresupuestocli` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `secuenciasejercicios`
--

INSERT INTO `secuenciasejercicios` (`codejercicio`, `codserie`, `id`, `nalbarancli`, `nalbaranprov`, `nfacturacli`, `nfacturaprov`, `npedidocli`, `npedidoprov`, `npresupuestocli`) VALUES
('2018', 'A', 1, 1, 1, 1, 1, 1, 1, 1),
('2018', 'R', 2, 1, 1, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `series`
--

CREATE TABLE `series` (
  `irpf` double DEFAULT NULL,
  `idcuenta` int(11) DEFAULT NULL,
  `codserie` varchar(2) COLLATE utf8_bin NOT NULL,
  `descripcion` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `siniva` tinyint(1) DEFAULT NULL,
  `codcuenta` varchar(6) COLLATE utf8_bin DEFAULT NULL,
  `codejercicio` varchar(4) COLLATE utf8_bin DEFAULT NULL,
  `numfactura` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `series`
--

INSERT INTO `series` (`irpf`, `idcuenta`, `codserie`, `descripcion`, `siniva`, `codcuenta`, `codejercicio`, `numfactura`) VALUES
(0, NULL, 'A', 'SERIE A', 0, NULL, NULL, 1),
(0, NULL, 'R', 'RECTIFICATIVAS', 0, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stocks`
--

CREATE TABLE `stocks` (
  `referencia` varchar(18) COLLATE utf8_bin NOT NULL,
  `disponible` double NOT NULL,
  `stockmin` double NOT NULL DEFAULT '0',
  `reservada` double NOT NULL,
  `horaultreg` time DEFAULT '00:00:00',
  `nombre` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `pterecibir` double NOT NULL,
  `fechaultreg` date DEFAULT '2018-02-11',
  `codalmacen` varchar(4) COLLATE utf8_bin NOT NULL,
  `cantidadultreg` double NOT NULL DEFAULT '0',
  `idstock` int(11) NOT NULL,
  `cantidad` double NOT NULL DEFAULT '0',
  `stockmax` double NOT NULL DEFAULT '0',
  `ubicacion` varchar(100) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `stocks`
--

INSERT INTO `stocks` (`referencia`, `disponible`, `stockmin`, `reservada`, `horaultreg`, `nombre`, `pterecibir`, `fechaultreg`, `codalmacen`, `cantidadultreg`, `idstock`, `cantidad`, `stockmax`, `ubicacion`) VALUES
('2', 0, 0, 0, '00:00:00', 'ALMACEN GENERAL', 0, '2018-02-11', 'ALG', 0, 1, 0, 0, ''),
('2', 0, 0, 0, '00:00:00', 'ALMACEN PRINCIPAL', 0, '2018-02-11', 'NJK', 0, 2, 0, 0, ''),
('5', 28, 0, 0, '00:00:00', 'ALMACEN GENERAL', 0, '2018-02-11', 'ALG', 0, 3, 28, 0, ''),
('5', 12, 0, 0, '00:00:00', '', 0, '2018-02-11', 'NJK', 0, 4, 12, 0, NULL),
('6', 18, 0, 0, '00:00:00', 'ALMACEN GENERAL', 0, '2018-02-11', 'ALG', 0, 5, 18, 0, ''),
('6', 2, 0, 0, '00:00:00', '', 0, '2018-02-11', 'NJK', 0, 6, 2, 0, NULL),
('4', 7, 0, 0, '00:00:00', '', 0, '2018-02-11', 'NJK', 0, 7, 7, 0, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarifas`
--

CREATE TABLE `tarifas` (
  `incporcentual` double NOT NULL,
  `inclineal` double NOT NULL,
  `aplicar_a` varchar(12) COLLATE utf8_bin DEFAULT NULL,
  `nombre` varchar(50) COLLATE utf8_bin NOT NULL,
  `mincoste` tinyint(1) DEFAULT '0',
  `maxpvp` tinyint(1) DEFAULT '0',
  `codtarifa` varchar(6) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transstock`
--

CREATE TABLE `transstock` (
  `usuario` varchar(12) COLLATE utf8_bin DEFAULT NULL,
  `codalmadestino` varchar(4) COLLATE utf8_bin NOT NULL,
  `codalmaorigen` varchar(4) COLLATE utf8_bin NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `idtrans` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `transstock`
--

INSERT INTO `transstock` (`usuario`, `codalmadestino`, `codalmaorigen`, `fecha`, `hora`, `idtrans`) VALUES
('admin', 'NJK', 'ALG', '2018-02-11', '11:46:22', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `agenciastrans`
--
ALTER TABLE `agenciastrans`
  ADD PRIMARY KEY (`codtrans`);

--
-- Indices de la tabla `agentes`
--
ALTER TABLE `agentes`
  ADD PRIMARY KEY (`codagente`);

--
-- Indices de la tabla `albaranescli`
--
ALTER TABLE `albaranescli`
  ADD PRIMARY KEY (`idalbaran`),
  ADD UNIQUE KEY `uniq_codigo_albaranescli` (`codigo`),
  ADD KEY `ca_albaranescli_series2` (`codserie`),
  ADD KEY `ca_albaranescli_ejercicios2` (`codejercicio`),
  ADD KEY `ca_albaranescli_facturas` (`idfactura`);

--
-- Indices de la tabla `albaranesprov`
--
ALTER TABLE `albaranesprov`
  ADD PRIMARY KEY (`idalbaran`),
  ADD UNIQUE KEY `uniq_codigo_albaranesprov` (`codigo`),
  ADD KEY `ca_albaranesprov_series2` (`codserie`),
  ADD KEY `ca_albaranesprov_ejercicios2` (`codejercicio`),
  ADD KEY `ca_albaranesprov_facturas` (`idfactura`);

--
-- Indices de la tabla `almacenes`
--
ALTER TABLE `almacenes`
  ADD PRIMARY KEY (`codalmacen`);

--
-- Indices de la tabla `articulos`
--
ALTER TABLE `articulos`
  ADD PRIMARY KEY (`referencia`),
  ADD KEY `ca_articulos_impuestos` (`codimpuesto`),
  ADD KEY `ca_articulos_familias` (`codfamilia`),
  ADD KEY `ca_articulos_fabricantes` (`codfabricante`);

--
-- Indices de la tabla `articulosprov`
--
ALTER TABLE `articulosprov`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniq_articulo_proveedor2` (`codproveedor`,`refproveedor`);

--
-- Indices de la tabla `articulo_combinaciones`
--
ALTER TABLE `articulo_combinaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ca_articulo_combinaciones_valores` (`idvalor`),
  ADD KEY `ca_articulo_combinaciones_articulos` (`referencia`);

--
-- Indices de la tabla `articulo_propiedades`
--
ALTER TABLE `articulo_propiedades`
  ADD PRIMARY KEY (`name`,`referencia`),
  ADD KEY `ca_articulo_propiedades_articulos` (`referencia`);

--
-- Indices de la tabla `articulo_trazas`
--
ALTER TABLE `articulo_trazas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniq_codigo_articulo_trazas` (`numserie`),
  ADD KEY `ca_articulo_trazas_articulos` (`referencia`),
  ADD KEY `ca_articulo_trazas_linalbcli` (`idlalbventa`),
  ADD KEY `ca_articulo_trazas_linfaccli` (`idlfacventa`),
  ADD KEY `ca_articulo_trazas_linalbprov` (`idlalbcompra`),
  ADD KEY `ca_articulo_trazas_linfacprov` (`idlfaccompra`);

--
-- Indices de la tabla `atributos`
--
ALTER TABLE `atributos`
  ADD PRIMARY KEY (`codatributo`);

--
-- Indices de la tabla `atributos_valores`
--
ALTER TABLE `atributos_valores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ca_atributos_valores` (`codatributo`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`codcliente`),
  ADD KEY `ca_clientes_grupos` (`codgrupo`);

--
-- Indices de la tabla `co_asientos`
--
ALTER TABLE `co_asientos`
  ADD PRIMARY KEY (`idasiento`),
  ADD KEY `ca_co_asientos_ejercicios2` (`codejercicio`);

--
-- Indices de la tabla `co_codbalances08`
--
ALTER TABLE `co_codbalances08`
  ADD PRIMARY KEY (`codbalance`);

--
-- Indices de la tabla `co_conceptospar`
--
ALTER TABLE `co_conceptospar`
  ADD PRIMARY KEY (`idconceptopar`);

--
-- Indices de la tabla `co_cuentas`
--
ALTER TABLE `co_cuentas`
  ADD PRIMARY KEY (`idcuenta`),
  ADD UNIQUE KEY `uniq_codcuenta` (`codcuenta`,`codejercicio`),
  ADD KEY `ca_co_cuentas_ejercicios` (`codejercicio`),
  ADD KEY `ca_co_cuentas_epigrafes2` (`idepigrafe`);

--
-- Indices de la tabla `co_cuentascb`
--
ALTER TABLE `co_cuentascb`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `co_cuentascbba`
--
ALTER TABLE `co_cuentascbba`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `co_cuentasesp`
--
ALTER TABLE `co_cuentasesp`
  ADD PRIMARY KEY (`idcuentaesp`);

--
-- Indices de la tabla `co_epigrafes`
--
ALTER TABLE `co_epigrafes`
  ADD PRIMARY KEY (`idepigrafe`),
  ADD KEY `ca_co_epigrafes_ejercicios` (`codejercicio`),
  ADD KEY `ca_co_epigrafes_gruposepigrafes2` (`idgrupo`);

--
-- Indices de la tabla `co_gruposepigrafes`
--
ALTER TABLE `co_gruposepigrafes`
  ADD PRIMARY KEY (`idgrupo`),
  ADD KEY `ca_co_gruposepigrafes_ejercicios` (`codejercicio`);

--
-- Indices de la tabla `co_partidas`
--
ALTER TABLE `co_partidas`
  ADD PRIMARY KEY (`idpartida`),
  ADD KEY `ca_co_partidas_co_asientos2` (`idasiento`),
  ADD KEY `ca_co_partidas_subcuentas` (`idsubcuenta`);

--
-- Indices de la tabla `co_regiva`
--
ALTER TABLE `co_regiva`
  ADD PRIMARY KEY (`idregiva`);

--
-- Indices de la tabla `co_secuencias`
--
ALTER TABLE `co_secuencias`
  ADD PRIMARY KEY (`idsecuencia`),
  ADD KEY `ca_co_secuencias_ejercicios` (`codejercicio`);

--
-- Indices de la tabla `co_subcuentas`
--
ALTER TABLE `co_subcuentas`
  ADD PRIMARY KEY (`idsubcuenta`),
  ADD UNIQUE KEY `uniq_codsubcuenta` (`codsubcuenta`,`codejercicio`),
  ADD KEY `ca_co_subcuentas_ejercicios` (`codejercicio`),
  ADD KEY `ca_co_subcuentas_cuentas2` (`idcuenta`);

--
-- Indices de la tabla `co_subcuentascli`
--
ALTER TABLE `co_subcuentascli`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ca_co_subcuentascli_ejercicios` (`codejercicio`),
  ADD KEY `ca_co_subcuentascli_clientes` (`codcliente`),
  ADD KEY `ca_co_subcuentascli_subcuentas` (`idsubcuenta`);

--
-- Indices de la tabla `co_subcuentasprov`
--
ALTER TABLE `co_subcuentasprov`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ca_co_subcuentasprov_ejercicios` (`codejercicio`),
  ADD KEY `ca_co_subcuentasprov_proveedores` (`codproveedor`),
  ADD KEY `ca_co_subcuentasprov_subcuentas` (`idsubcuenta`);

--
-- Indices de la tabla `cuentasbanco`
--
ALTER TABLE `cuentasbanco`
  ADD PRIMARY KEY (`codcuenta`);

--
-- Indices de la tabla `cuentasbcocli`
--
ALTER TABLE `cuentasbcocli`
  ADD PRIMARY KEY (`codcuenta`),
  ADD KEY `ca_cuentasbcocli_clientes` (`codcliente`);

--
-- Indices de la tabla `cuentasbcopro`
--
ALTER TABLE `cuentasbcopro`
  ADD PRIMARY KEY (`codcuenta`),
  ADD KEY `ca_cuentasbcopro_proveedores` (`codproveedor`);

--
-- Indices de la tabla `dirclientes`
--
ALTER TABLE `dirclientes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ca_dirclientes_clientes` (`codcliente`);

--
-- Indices de la tabla `dirproveedores`
--
ALTER TABLE `dirproveedores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ca_dirproveedores_proveedores` (`codproveedor`);

--
-- Indices de la tabla `divisas`
--
ALTER TABLE `divisas`
  ADD PRIMARY KEY (`coddivisa`);

--
-- Indices de la tabla `ejercicios`
--
ALTER TABLE `ejercicios`
  ADD PRIMARY KEY (`codejercicio`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `fabricantes`
--
ALTER TABLE `fabricantes`
  ADD PRIMARY KEY (`codfabricante`);

--
-- Indices de la tabla `facturascli`
--
ALTER TABLE `facturascli`
  ADD PRIMARY KEY (`idfactura`),
  ADD UNIQUE KEY `uniq_codigo_facturascli` (`codigo`),
  ADD KEY `ca_facturascli_series2` (`codserie`),
  ADD KEY `ca_facturascli_ejercicios2` (`codejercicio`),
  ADD KEY `ca_facturascli_asiento2` (`idasiento`),
  ADD KEY `ca_facturascli_asientop` (`idasientop`);

--
-- Indices de la tabla `facturasprov`
--
ALTER TABLE `facturasprov`
  ADD PRIMARY KEY (`idfactura`),
  ADD UNIQUE KEY `uniq_codigo_facturasprov` (`codigo`),
  ADD KEY `ca_facturasprov_series2` (`codserie`),
  ADD KEY `ca_facturasprov_ejercicios2` (`codejercicio`),
  ADD KEY `ca_facturasprov_asiento2` (`idasiento`),
  ADD KEY `ca_facturasprov_asientop` (`idasientop`);

--
-- Indices de la tabla `familias`
--
ALTER TABLE `familias`
  ADD PRIMARY KEY (`codfamilia`);

--
-- Indices de la tabla `formaspago`
--
ALTER TABLE `formaspago`
  ADD PRIMARY KEY (`codpago`);

--
-- Indices de la tabla `fs_access`
--
ALTER TABLE `fs_access`
  ADD PRIMARY KEY (`fs_user`,`fs_page`),
  ADD KEY `fs_access_page2` (`fs_page`);

--
-- Indices de la tabla `fs_extensions2`
--
ALTER TABLE `fs_extensions2`
  ADD PRIMARY KEY (`name`,`page_from`),
  ADD KEY `ca_fs_extensions2_fs_pages` (`page_from`);

--
-- Indices de la tabla `fs_logs`
--
ALTER TABLE `fs_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `fs_pages`
--
ALTER TABLE `fs_pages`
  ADD PRIMARY KEY (`name`);

--
-- Indices de la tabla `fs_roles`
--
ALTER TABLE `fs_roles`
  ADD PRIMARY KEY (`codrol`);

--
-- Indices de la tabla `fs_roles_access`
--
ALTER TABLE `fs_roles_access`
  ADD PRIMARY KEY (`codrol`,`fs_page`),
  ADD KEY `fs_roles_access_page` (`fs_page`);

--
-- Indices de la tabla `fs_roles_users`
--
ALTER TABLE `fs_roles_users`
  ADD PRIMARY KEY (`codrol`,`fs_user`),
  ADD KEY `fs_roles_users_user` (`fs_user`);

--
-- Indices de la tabla `fs_users`
--
ALTER TABLE `fs_users`
  ADD PRIMARY KEY (`nick`),
  ADD KEY `ca_fs_users_pages` (`fs_page`);

--
-- Indices de la tabla `fs_vars`
--
ALTER TABLE `fs_vars`
  ADD PRIMARY KEY (`name`);

--
-- Indices de la tabla `gruposclientes`
--
ALTER TABLE `gruposclientes`
  ADD PRIMARY KEY (`codgrupo`);

--
-- Indices de la tabla `impuestos`
--
ALTER TABLE `impuestos`
  ADD PRIMARY KEY (`codimpuesto`);

--
-- Indices de la tabla `lineasalbaranescli`
--
ALTER TABLE `lineasalbaranescli`
  ADD PRIMARY KEY (`idlinea`),
  ADD KEY `ca_lineasalbaranescli_albaranescli2` (`idalbaran`);

--
-- Indices de la tabla `lineasalbaranesprov`
--
ALTER TABLE `lineasalbaranesprov`
  ADD PRIMARY KEY (`idlinea`),
  ADD KEY `ca_lineasalbaranesprov_albaranesprov2` (`idalbaran`);

--
-- Indices de la tabla `lineasfacturascli`
--
ALTER TABLE `lineasfacturascli`
  ADD PRIMARY KEY (`idlinea`),
  ADD KEY `ca_linea_facturascli2` (`idfactura`);

--
-- Indices de la tabla `lineasfacturasprov`
--
ALTER TABLE `lineasfacturasprov`
  ADD PRIMARY KEY (`idlinea`),
  ADD KEY `ca_linea_facturasprov2` (`idfactura`);

--
-- Indices de la tabla `lineasivafactcli`
--
ALTER TABLE `lineasivafactcli`
  ADD PRIMARY KEY (`idlinea`),
  ADD KEY `ca_lineaiva_facturascli2` (`idfactura`);

--
-- Indices de la tabla `lineasivafactprov`
--
ALTER TABLE `lineasivafactprov`
  ADD PRIMARY KEY (`idlinea`),
  ADD KEY `ca_lineaiva_facturasprov2` (`idfactura`);

--
-- Indices de la tabla `lineasregstocks`
--
ALTER TABLE `lineasregstocks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ca_lineasregstocks_stocks` (`idstock`);

--
-- Indices de la tabla `lineastransstock`
--
ALTER TABLE `lineastransstock`
  ADD PRIMARY KEY (`idlinea`),
  ADD UNIQUE KEY `uniq_referencia_transferencia` (`idtrans`,`referencia`),
  ADD KEY `ca_linea_transstock_articulos` (`referencia`);

--
-- Indices de la tabla `paises`
--
ALTER TABLE `paises`
  ADD PRIMARY KEY (`codpais`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`codproveedor`);

--
-- Indices de la tabla `secuencias`
--
ALTER TABLE `secuencias`
  ADD PRIMARY KEY (`idsec`),
  ADD KEY `ca_secuencias_secuenciasejercicios` (`id`);

--
-- Indices de la tabla `secuenciasejercicios`
--
ALTER TABLE `secuenciasejercicios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ca_secuenciasejercicios_ejercicios` (`codejercicio`);

--
-- Indices de la tabla `series`
--
ALTER TABLE `series`
  ADD PRIMARY KEY (`codserie`);

--
-- Indices de la tabla `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`idstock`),
  ADD UNIQUE KEY `uniq_stocks_almacen_referencia` (`codalmacen`,`referencia`),
  ADD KEY `ca_stocks_articulos2` (`referencia`);

--
-- Indices de la tabla `tarifas`
--
ALTER TABLE `tarifas`
  ADD PRIMARY KEY (`codtarifa`);

--
-- Indices de la tabla `transstock`
--
ALTER TABLE `transstock`
  ADD PRIMARY KEY (`idtrans`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `albaranescli`
--
ALTER TABLE `albaranescli`
  MODIFY `idalbaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `albaranesprov`
--
ALTER TABLE `albaranesprov`
  MODIFY `idalbaran` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `articulosprov`
--
ALTER TABLE `articulosprov`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `articulo_combinaciones`
--
ALTER TABLE `articulo_combinaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `articulo_trazas`
--
ALTER TABLE `articulo_trazas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `atributos_valores`
--
ALTER TABLE `atributos_valores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `co_asientos`
--
ALTER TABLE `co_asientos`
  MODIFY `idasiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `co_cuentas`
--
ALTER TABLE `co_cuentas`
  MODIFY `idcuenta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT de la tabla `co_cuentascb`
--
ALTER TABLE `co_cuentascb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `co_cuentascbba`
--
ALTER TABLE `co_cuentascbba`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `co_epigrafes`
--
ALTER TABLE `co_epigrafes`
  MODIFY `idepigrafe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT de la tabla `co_gruposepigrafes`
--
ALTER TABLE `co_gruposepigrafes`
  MODIFY `idgrupo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `co_partidas`
--
ALTER TABLE `co_partidas`
  MODIFY `idpartida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT de la tabla `co_regiva`
--
ALTER TABLE `co_regiva`
  MODIFY `idregiva` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `co_secuencias`
--
ALTER TABLE `co_secuencias`
  MODIFY `idsecuencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `co_subcuentas`
--
ALTER TABLE `co_subcuentas`
  MODIFY `idsubcuenta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=511;
--
-- AUTO_INCREMENT de la tabla `co_subcuentascli`
--
ALTER TABLE `co_subcuentascli`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `co_subcuentasprov`
--
ALTER TABLE `co_subcuentasprov`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `dirclientes`
--
ALTER TABLE `dirclientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `dirproveedores`
--
ALTER TABLE `dirproveedores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `facturascli`
--
ALTER TABLE `facturascli`
  MODIFY `idfactura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `facturasprov`
--
ALTER TABLE `facturasprov`
  MODIFY `idfactura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `fs_logs`
--
ALTER TABLE `fs_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT de la tabla `lineasalbaranescli`
--
ALTER TABLE `lineasalbaranescli`
  MODIFY `idlinea` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `lineasalbaranesprov`
--
ALTER TABLE `lineasalbaranesprov`
  MODIFY `idlinea` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `lineasfacturascli`
--
ALTER TABLE `lineasfacturascli`
  MODIFY `idlinea` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `lineasfacturasprov`
--
ALTER TABLE `lineasfacturasprov`
  MODIFY `idlinea` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `lineasivafactcli`
--
ALTER TABLE `lineasivafactcli`
  MODIFY `idlinea` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `lineasivafactprov`
--
ALTER TABLE `lineasivafactprov`
  MODIFY `idlinea` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `lineasregstocks`
--
ALTER TABLE `lineasregstocks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `lineastransstock`
--
ALTER TABLE `lineastransstock`
  MODIFY `idlinea` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `secuencias`
--
ALTER TABLE `secuencias`
  MODIFY `idsec` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `secuenciasejercicios`
--
ALTER TABLE `secuenciasejercicios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `stocks`
--
ALTER TABLE `stocks`
  MODIFY `idstock` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `transstock`
--
ALTER TABLE `transstock`
  MODIFY `idtrans` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `albaranescli`
--
ALTER TABLE `albaranescli`
  ADD CONSTRAINT `ca_albaranescli_ejercicios2` FOREIGN KEY (`codejercicio`) REFERENCES `ejercicios` (`codejercicio`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ca_albaranescli_facturas` FOREIGN KEY (`idfactura`) REFERENCES `facturascli` (`idfactura`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `ca_albaranescli_series2` FOREIGN KEY (`codserie`) REFERENCES `series` (`codserie`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `albaranesprov`
--
ALTER TABLE `albaranesprov`
  ADD CONSTRAINT `ca_albaranesprov_ejercicios2` FOREIGN KEY (`codejercicio`) REFERENCES `ejercicios` (`codejercicio`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ca_albaranesprov_facturas` FOREIGN KEY (`idfactura`) REFERENCES `facturasprov` (`idfactura`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `ca_albaranesprov_series2` FOREIGN KEY (`codserie`) REFERENCES `series` (`codserie`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `articulos`
--
ALTER TABLE `articulos`
  ADD CONSTRAINT `ca_articulos_fabricantes` FOREIGN KEY (`codfabricante`) REFERENCES `fabricantes` (`codfabricante`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `ca_articulos_familias` FOREIGN KEY (`codfamilia`) REFERENCES `familias` (`codfamilia`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `ca_articulos_impuestos` FOREIGN KEY (`codimpuesto`) REFERENCES `impuestos` (`codimpuesto`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `articulosprov`
--
ALTER TABLE `articulosprov`
  ADD CONSTRAINT `ca_articulosprov_proveedores` FOREIGN KEY (`codproveedor`) REFERENCES `proveedores` (`codproveedor`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `articulo_combinaciones`
--
ALTER TABLE `articulo_combinaciones`
  ADD CONSTRAINT `ca_articulo_combinaciones_articulos` FOREIGN KEY (`referencia`) REFERENCES `articulos` (`referencia`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ca_articulo_combinaciones_valores` FOREIGN KEY (`idvalor`) REFERENCES `atributos_valores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `articulo_propiedades`
--
ALTER TABLE `articulo_propiedades`
  ADD CONSTRAINT `ca_articulo_propiedades_articulos` FOREIGN KEY (`referencia`) REFERENCES `articulos` (`referencia`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `articulo_trazas`
--
ALTER TABLE `articulo_trazas`
  ADD CONSTRAINT `ca_articulo_trazas_articulos` FOREIGN KEY (`referencia`) REFERENCES `articulos` (`referencia`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ca_articulo_trazas_linalbcli` FOREIGN KEY (`idlalbventa`) REFERENCES `lineasalbaranescli` (`idlinea`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `ca_articulo_trazas_linalbprov` FOREIGN KEY (`idlalbcompra`) REFERENCES `lineasalbaranesprov` (`idlinea`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `ca_articulo_trazas_linfaccli` FOREIGN KEY (`idlfacventa`) REFERENCES `lineasfacturascli` (`idlinea`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `ca_articulo_trazas_linfacprov` FOREIGN KEY (`idlfaccompra`) REFERENCES `lineasfacturasprov` (`idlinea`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `atributos_valores`
--
ALTER TABLE `atributos_valores`
  ADD CONSTRAINT `ca_atributos_valores` FOREIGN KEY (`codatributo`) REFERENCES `atributos` (`codatributo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `ca_clientes_grupos` FOREIGN KEY (`codgrupo`) REFERENCES `gruposclientes` (`codgrupo`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `co_asientos`
--
ALTER TABLE `co_asientos`
  ADD CONSTRAINT `ca_co_asientos_ejercicios2` FOREIGN KEY (`codejercicio`) REFERENCES `ejercicios` (`codejercicio`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `co_cuentas`
--
ALTER TABLE `co_cuentas`
  ADD CONSTRAINT `ca_co_cuentas_ejercicios` FOREIGN KEY (`codejercicio`) REFERENCES `ejercicios` (`codejercicio`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ca_co_cuentas_epigrafes2` FOREIGN KEY (`idepigrafe`) REFERENCES `co_epigrafes` (`idepigrafe`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `co_epigrafes`
--
ALTER TABLE `co_epigrafes`
  ADD CONSTRAINT `ca_co_epigrafes_ejercicios` FOREIGN KEY (`codejercicio`) REFERENCES `ejercicios` (`codejercicio`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ca_co_epigrafes_gruposepigrafes2` FOREIGN KEY (`idgrupo`) REFERENCES `co_gruposepigrafes` (`idgrupo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `co_gruposepigrafes`
--
ALTER TABLE `co_gruposepigrafes`
  ADD CONSTRAINT `ca_co_gruposepigrafes_ejercicios` FOREIGN KEY (`codejercicio`) REFERENCES `ejercicios` (`codejercicio`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `co_partidas`
--
ALTER TABLE `co_partidas`
  ADD CONSTRAINT `ca_co_partidas_co_asientos2` FOREIGN KEY (`idasiento`) REFERENCES `co_asientos` (`idasiento`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ca_co_partidas_subcuentas` FOREIGN KEY (`idsubcuenta`) REFERENCES `co_subcuentas` (`idsubcuenta`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `co_secuencias`
--
ALTER TABLE `co_secuencias`
  ADD CONSTRAINT `ca_co_secuencias_ejercicios` FOREIGN KEY (`codejercicio`) REFERENCES `ejercicios` (`codejercicio`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `co_subcuentas`
--
ALTER TABLE `co_subcuentas`
  ADD CONSTRAINT `ca_co_subcuentas_cuentas2` FOREIGN KEY (`idcuenta`) REFERENCES `co_cuentas` (`idcuenta`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ca_co_subcuentas_ejercicios` FOREIGN KEY (`codejercicio`) REFERENCES `ejercicios` (`codejercicio`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `co_subcuentascli`
--
ALTER TABLE `co_subcuentascli`
  ADD CONSTRAINT `ca_co_subcuentascli_clientes` FOREIGN KEY (`codcliente`) REFERENCES `clientes` (`codcliente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ca_co_subcuentascli_ejercicios` FOREIGN KEY (`codejercicio`) REFERENCES `ejercicios` (`codejercicio`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ca_co_subcuentascli_subcuentas` FOREIGN KEY (`idsubcuenta`) REFERENCES `co_subcuentas` (`idsubcuenta`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `co_subcuentasprov`
--
ALTER TABLE `co_subcuentasprov`
  ADD CONSTRAINT `ca_co_subcuentasprov_ejercicios` FOREIGN KEY (`codejercicio`) REFERENCES `ejercicios` (`codejercicio`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ca_co_subcuentasprov_proveedores` FOREIGN KEY (`codproveedor`) REFERENCES `proveedores` (`codproveedor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ca_co_subcuentasprov_subcuentas` FOREIGN KEY (`idsubcuenta`) REFERENCES `co_subcuentas` (`idsubcuenta`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `cuentasbcocli`
--
ALTER TABLE `cuentasbcocli`
  ADD CONSTRAINT `ca_cuentasbcocli_clientes` FOREIGN KEY (`codcliente`) REFERENCES `clientes` (`codcliente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `cuentasbcopro`
--
ALTER TABLE `cuentasbcopro`
  ADD CONSTRAINT `ca_cuentasbcopro_proveedores` FOREIGN KEY (`codproveedor`) REFERENCES `proveedores` (`codproveedor`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `dirclientes`
--
ALTER TABLE `dirclientes`
  ADD CONSTRAINT `ca_dirclientes_clientes` FOREIGN KEY (`codcliente`) REFERENCES `clientes` (`codcliente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `dirproveedores`
--
ALTER TABLE `dirproveedores`
  ADD CONSTRAINT `ca_dirproveedores_proveedores` FOREIGN KEY (`codproveedor`) REFERENCES `proveedores` (`codproveedor`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `facturascli`
--
ALTER TABLE `facturascli`
  ADD CONSTRAINT `ca_facturascli_asiento2` FOREIGN KEY (`idasiento`) REFERENCES `co_asientos` (`idasiento`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `ca_facturascli_asientop` FOREIGN KEY (`idasientop`) REFERENCES `co_asientos` (`idasiento`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `ca_facturascli_ejercicios2` FOREIGN KEY (`codejercicio`) REFERENCES `ejercicios` (`codejercicio`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ca_facturascli_series2` FOREIGN KEY (`codserie`) REFERENCES `series` (`codserie`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `facturasprov`
--
ALTER TABLE `facturasprov`
  ADD CONSTRAINT `ca_facturasprov_asiento2` FOREIGN KEY (`idasiento`) REFERENCES `co_asientos` (`idasiento`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `ca_facturasprov_asientop` FOREIGN KEY (`idasientop`) REFERENCES `co_asientos` (`idasiento`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `ca_facturasprov_ejercicios2` FOREIGN KEY (`codejercicio`) REFERENCES `ejercicios` (`codejercicio`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ca_facturasprov_series2` FOREIGN KEY (`codserie`) REFERENCES `series` (`codserie`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `fs_access`
--
ALTER TABLE `fs_access`
  ADD CONSTRAINT `fs_access_page2` FOREIGN KEY (`fs_page`) REFERENCES `fs_pages` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fs_access_user2` FOREIGN KEY (`fs_user`) REFERENCES `fs_users` (`nick`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `fs_extensions2`
--
ALTER TABLE `fs_extensions2`
  ADD CONSTRAINT `ca_fs_extensions2_fs_pages` FOREIGN KEY (`page_from`) REFERENCES `fs_pages` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `fs_roles_access`
--
ALTER TABLE `fs_roles_access`
  ADD CONSTRAINT `fs_roles_access_page` FOREIGN KEY (`fs_page`) REFERENCES `fs_pages` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fs_roles_access_roles` FOREIGN KEY (`codrol`) REFERENCES `fs_roles` (`codrol`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `fs_roles_users`
--
ALTER TABLE `fs_roles_users`
  ADD CONSTRAINT `fs_roles_users_roles` FOREIGN KEY (`codrol`) REFERENCES `fs_roles` (`codrol`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fs_roles_users_user` FOREIGN KEY (`fs_user`) REFERENCES `fs_users` (`nick`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `fs_users`
--
ALTER TABLE `fs_users`
  ADD CONSTRAINT `ca_fs_users_pages` FOREIGN KEY (`fs_page`) REFERENCES `fs_pages` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `lineasalbaranescli`
--
ALTER TABLE `lineasalbaranescli`
  ADD CONSTRAINT `ca_lineasalbaranescli_albaranescli2` FOREIGN KEY (`idalbaran`) REFERENCES `albaranescli` (`idalbaran`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `lineasalbaranesprov`
--
ALTER TABLE `lineasalbaranesprov`
  ADD CONSTRAINT `ca_lineasalbaranesprov_albaranesprov2` FOREIGN KEY (`idalbaran`) REFERENCES `albaranesprov` (`idalbaran`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `lineasfacturascli`
--
ALTER TABLE `lineasfacturascli`
  ADD CONSTRAINT `ca_linea_facturascli2` FOREIGN KEY (`idfactura`) REFERENCES `facturascli` (`idfactura`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `lineasfacturasprov`
--
ALTER TABLE `lineasfacturasprov`
  ADD CONSTRAINT `ca_linea_facturasprov2` FOREIGN KEY (`idfactura`) REFERENCES `facturasprov` (`idfactura`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `lineasivafactcli`
--
ALTER TABLE `lineasivafactcli`
  ADD CONSTRAINT `ca_lineaiva_facturascli2` FOREIGN KEY (`idfactura`) REFERENCES `facturascli` (`idfactura`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `lineasivafactprov`
--
ALTER TABLE `lineasivafactprov`
  ADD CONSTRAINT `ca_lineaiva_facturasprov2` FOREIGN KEY (`idfactura`) REFERENCES `facturasprov` (`idfactura`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `lineasregstocks`
--
ALTER TABLE `lineasregstocks`
  ADD CONSTRAINT `ca_lineasregstocks_stocks` FOREIGN KEY (`idstock`) REFERENCES `stocks` (`idstock`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `lineastransstock`
--
ALTER TABLE `lineastransstock`
  ADD CONSTRAINT `ca_linea_transstock` FOREIGN KEY (`idtrans`) REFERENCES `transstock` (`idtrans`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ca_linea_transstock_articulos` FOREIGN KEY (`referencia`) REFERENCES `articulos` (`referencia`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `secuencias`
--
ALTER TABLE `secuencias`
  ADD CONSTRAINT `ca_secuencias_secuenciasejercicios` FOREIGN KEY (`id`) REFERENCES `secuenciasejercicios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `secuenciasejercicios`
--
ALTER TABLE `secuenciasejercicios`
  ADD CONSTRAINT `ca_secuenciasejercicios_ejercicios` FOREIGN KEY (`codejercicio`) REFERENCES `ejercicios` (`codejercicio`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `stocks`
--
ALTER TABLE `stocks`
  ADD CONSTRAINT `ca_stocks_almacenes3` FOREIGN KEY (`codalmacen`) REFERENCES `almacenes` (`codalmacen`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ca_stocks_articulos2` FOREIGN KEY (`referencia`) REFERENCES `articulos` (`referencia`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
