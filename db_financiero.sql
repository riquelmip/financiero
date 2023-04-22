-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 22-04-2023 a las 15:01:55
-- Versión del servidor: 5.7.33
-- Versión de PHP: 8.0.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_financiero`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `activofijo_bienes`
--

CREATE TABLE `activofijo_bienes` (
  `codigo_correlativo` varchar(255) NOT NULL,
  `id_activofijo` varchar(255) DEFAULT NULL,
  `decripcion` text,
  `vida_util` int(11) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `activofijo_bienes`
--

INSERT INTO `activofijo_bienes` (`codigo_correlativo`, `id_activofijo`, `decripcion`, `vida_util`, `estado`) VALUES
('ELT-Camioneta-TA-001-1', 'ELT-Camioneta-TA-001', 'Bonita, gris', 6, 1),
('ELT-Computadora-ME-001-1', 'ELT-Computadora-ME-001', 'se vendio al lic peraza', 6, 3),
('ELT-Computadora-ME-001-10', 'ELT-Computadora-ME-001', 'se ha donado', 6, 2),
('ELT-Computadora-ME-001-2', 'ELT-Computadora-ME-001', 'se botarà', 6, 4),
('ELT-Computadora-ME-001-3', 'ELT-Computadora-ME-001', 'procesador i5, ram 8gb', 6, 1),
('ELT-Computadora-ME-001-4', 'ELT-Computadora-ME-001', 'procesador i5, ram 8gb', 6, 1),
('ELT-Computadora-ME-001-5', 'ELT-Computadora-ME-001', 'procesador i5, ram 8gb', 6, 1),
('ELT-Computadora-ME-001-6', 'ELT-Computadora-ME-001', 'procesador i5, ram 8gb', 6, 1),
('ELT-Computadora-ME-001-7', 'ELT-Computadora-ME-001', 'procesador i5, ram 8gb', 6, 1),
('ELT-Computadora-ME-001-8', 'ELT-Computadora-ME-001', 'procesador i5, ram 8gb', 6, 1),
('ELT-Computadora-ME-001-9', 'ELT-Computadora-ME-001', 'procesador i5, ram 8gb', 6, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `activo_fijo`
--

CREATE TABLE `activo_fijo` (
  `codigo` varchar(255) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `tipo_activo` int(11) DEFAULT NULL,
  `fecha_adquisicion` date DEFAULT NULL,
  `idproveedor` bigint(20) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `costo` double(65,2) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `activo_fijo`
--

INSERT INTO `activo_fijo` (`codigo`, `nombre`, `tipo_activo`, `fecha_adquisicion`, `idproveedor`, `cantidad`, `costo`, `img`) VALUES
('ELT-Camioneta-TA-001', 'Camioneta de Carga', 3, '2022-01-17', 4, 1, 120000.00, NULL),
('ELT-Computadora-ME-001', 'Computadora HP', 1, '2022-01-17', 4, 10, 60000.00, 'ac_d966ea363ec9f57c975121c882de78ae.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargo`
--

CREATE TABLE `cargo` (
  `idcargo` bigint(20) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `cargo`
--

INSERT INTO `cargo` (`idcargo`, `nombre`) VALUES
(1, 'Gerente'),
(5, 'Vendedor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `idcategoria` bigint(20) NOT NULL,
  `nombre` varchar(100) NOT NULL COMMENT 'º',
  `tasainteres` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`idcategoria`, `nombre`, `tasainteres`) VALUES
(5, 'Vivienda', 10.5),
(6, 'aaa', 12.3),
(7, 'ELECTRODOMESTICOS', 9.5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `codigo_cliente_natural` varchar(20) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `dui` varchar(10) NOT NULL,
  `estado` tinyint(4) NOT NULL,
  `telefono` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`codigo_cliente_natural`, `nombre`, `apellido`, `dui`, `estado`, `telefono`) VALUES
('5', 'Maria Carmen', 'Auxiliadora del Carmen', '01667222-3', 1, '7772-7777');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `idcompra` bigint(20) NOT NULL,
  `dia` int(11) NOT NULL,
  `mes` int(11) NOT NULL,
  `anio` int(11) NOT NULL,
  `credito` double DEFAULT NULL,
  `estado` tinyint(4) NOT NULL,
  `monto` double NOT NULL,
  `idproveedor` bigint(20) NOT NULL,
  `idusuario` bigint(20) NOT NULL,
  `fecha_credito` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `compra`
--

INSERT INTO `compra` (`idcompra`, `dia`, `mes`, `anio`, `credito`, `estado`, `monto`, `idproveedor`, `idusuario`, `fecha_credito`) VALUES
(7, 2, 11, 2021, 0, 0, 111.2, 4, 1, '0000-00-00'),
(8, 2, 11, 2021, 0, 0, 2.18, 4, 1, '0000-00-00'),
(9, 2, 11, 2021, 0, 0, 19.5, 4, 1, '0000-00-00'),
(10, 17, 1, 2022, 0, 0, 102140, 4, 1, '0000-00-00'),
(11, 17, 1, 2022, 0, 0, 600, 4, 1, '0000-00-00'),
(12, 17, 1, 2022, 0, 0, 50, 4, 1, '0000-00-00'),
(13, 17, 1, 2022, 0, 0, 3780, 4, 1, '0000-00-00'),
(14, 17, 1, 2022, 0, 0, 10, 4, 1, '0000-00-00'),
(15, 17, 1, 2022, 0, 0, 1000, 4, 1, '0000-00-00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallecompra`
--

CREATE TABLE `detallecompra` (
  `iddetalle` bigint(20) NOT NULL,
  `idcompra` bigint(20) NOT NULL,
  `idproducto` bigint(20) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `preciocompra` double NOT NULL,
  `precioventa` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `detallecompra`
--

INSERT INTO `detallecompra` (`iddetalle`, `idcompra`, `idproducto`, `cantidad`, `preciocompra`, `precioventa`) VALUES
(8, 7, 5, 20, 5.56, 6.116),
(9, 8, 5, 2, 1.09, 1.199),
(10, 9, 6, 15, 1.3, 1.43),
(11, 10, 9, 50, 500, 550),
(12, 10, 10, 24, 15, 16.5),
(13, 10, 11, 46, 360, 396),
(14, 10, 12, 22, 250, 275),
(15, 10, 13, 32, 300, 330),
(16, 10, 14, 12, 400, 440),
(17, 10, 15, 42, 500, 550),
(18, 10, 16, 12, 350, 385),
(19, 10, 17, 12, 350, 385),
(20, 10, 18, 12, 350, 385),
(21, 10, 19, 12, 560, 616),
(22, 11, 9, 1, 600, 660),
(23, 12, 10, 1, 50, 55),
(24, 13, 10, 1, 20, 22),
(25, 13, 11, 1, 400, 440),
(26, 13, 12, 1, 400, 440),
(27, 13, 13, 1, 400, 440),
(28, 13, 14, 1, 500, 550),
(29, 13, 15, 1, 560, 616),
(30, 13, 16, 1, 300, 330),
(31, 13, 19, 1, 400, 440),
(32, 13, 18, 1, 400, 440),
(33, 13, 17, 1, 400, 440),
(34, 14, 5, 1, 10, 11),
(35, 15, 20, 2, 500, 550);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleventa`
--

CREATE TABLE `detalleventa` (
  `iddetalle` bigint(20) NOT NULL,
  `idventa` bigint(20) NOT NULL,
  `idproducto` bigint(20) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `formapago` tinyint(4) DEFAULT NULL,
  `total` double DEFAULT NULL,
  `estadopago` int(11) DEFAULT NULL,
  `cuota` double DEFAULT NULL,
  `meses` int(11) DEFAULT NULL,
  `estado_embargo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `detalleventa`
--

INSERT INTO `detalleventa` (`iddetalle`, `idventa`, `idproducto`, `cantidad`, `formapago`, `total`, `estadopago`, `cuota`, `meses`, `estado_embargo`) VALUES
(36, 36, 20, 1, 2, 569.76, 2, 71.22, 8, 0),
(37, 37, 6, 2, 1, 2800, NULL, NULL, NULL, 0),
(38, 37, 9, 1, 1, 660, NULL, NULL, NULL, 0),
(39, 38, 10, 2, 1, 44, NULL, NULL, NULL, 0),
(40, 39, 11, 1, 2, 465.48, 0, 38.79, 12, 0),
(41, 40, 9, 1, 1, 660, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `idempleado` bigint(20) NOT NULL,
  `dui` varchar(10) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `nit` varchar(19) NOT NULL,
  `direccion` text NOT NULL,
  `telefono` varchar(9) NOT NULL,
  `dia` int(11) NOT NULL,
  `mes` int(11) NOT NULL,
  `anio` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  `idcargo` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`idempleado`, `dui`, `nombre`, `apellido`, `nit`, `direccion`, `telefono`, `dia`, `mes`, `anio`, `estado`, `idcargo`) VALUES
(1, '01667277-6', 'Super Admin', '', '0000-010103-100-1', 'Calle El matadragon', '2333-3333', 10, 12, 2003, 1, 1),
(19, '01777373-7', 'William Antonio', 'Del Cid Mejia', '0001-012781-300-2', 'Reparto Los Naranjos, #167 Calle El Naranjo', '2273-8330', 17, 12, 2003, 2, 5),
(20, '01777374-7', 'Juan Eduardo', 'Mendez Juarez', '0001-012781-300-3', 'San Salvador', '2333-3223', 17, 12, 2003, 1, 5),
(21, '23487324-3', 'Maria', 'Guevara', '1345-134545-345-3', 'San Vicente', '7583-5200', 12, 12, 2000, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagen`
--

CREATE TABLE `imagen` (
  `id` bigint(20) NOT NULL,
  `productoid` bigint(20) NOT NULL,
  `img` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `imagen`
--

INSERT INTO `imagen` (`id`, `productoid`, `img`) VALUES
(27, 9, 'pro_0de9fff462643c82b1c352d8b68c76a0.jpg'),
(28, 10, 'pro_16c38ed47d4f7375f1b546a073bf48e6.jpg'),
(29, 11, 'pro_e6491969c5c91bfdeb3252deef5159d8.jpg'),
(30, 12, 'pro_21a6915be34b195e5101484f5c2ee401.jpg'),
(31, 13, 'pro_081f32c09c4c6188ef4bf543d652e121.jpg'),
(32, 14, 'pro_7152fbaa8c98fce53e5254686cba7c2e.jpg'),
(33, 15, 'pro_e9702978d4e28878c30555e860fd6e38.jpg'),
(34, 16, 'pro_bf8a22ac47b4e50e0886c03ed8017191.jpg'),
(35, 17, 'pro_96a1024adaef701c2de462d227925328.jpg'),
(36, 18, 'pro_8d89534c864eeb0ad210d49fda2668f5.jpg'),
(37, 19, 'pro_db68b837c7552dc3c84c5bf3a49b6703.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca`
--

CREATE TABLE `marca` (
  `idmarca` bigint(20) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `estado` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `marca`
--

INSERT INTO `marca` (`idmarca`, `nombre`, `estado`) VALUES
(7, 'HERMEX', 1),
(8, 'SAMSUMG', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulo`
--

CREATE TABLE `modulo` (
  `idmodulo` bigint(20) NOT NULL,
  `titulo` varchar(50) COLLATE utf8mb4_swedish_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_swedish_ci NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `modulo`
--

INSERT INTO `modulo` (`idmodulo`, `titulo`, `descripcion`, `estado`) VALUES
(1, 'Inicio', 'Pantalla Principal', 1),
(2, 'Usuarios', 'Usuarios del sistema', 1),
(3, 'Roles de Usuario', 'Roles de Usuario del Sistema', 1),
(4, 'Empleados', 'Registrar, Editar y/o Eliminar empleados', 1),
(5, 'Compras', 'Compras', 1),
(6, 'Inventario', 'Inventario', 1),
(7, 'Ventas', 'Ventas', 1),
(8, 'Clientes', 'Clientes', 1),
(9, 'Productos', 'Productos', 1),
(10, 'Proveedores', 'Proveedores', 1),
(11, 'Marca', 'Marca de los productos', 1),
(12, 'Unidad de Medida', 'Unidad de Medida', 1),
(13, 'Categoria', 'Cateoria', 1),
(14, 'Cargos', 'Cargos', 1),
(15, 'Activo fijo', '', 1),
(16, 'Creditos', '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagocuota`
--

CREATE TABLE `pagocuota` (
  `idpagocuota` bigint(20) NOT NULL,
  `iddetalle` bigint(20) NOT NULL,
  `mes` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `fechapago` date NOT NULL,
  `cuota` double NOT NULL,
  `capital` double NOT NULL,
  `intereses` double NOT NULL,
  `abonocapital` double NOT NULL,
  `totalabono` double NOT NULL,
  `saldofinal` double NOT NULL,
  `estado` int(11) DEFAULT NULL,
  `mora` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `pagocuota`
--

INSERT INTO `pagocuota` (`idpagocuota`, `iddetalle`, `mes`, `fecha`, `fechapago`, `cuota`, `capital`, `intereses`, `abonocapital`, `totalabono`, `saldofinal`, `estado`, `mora`) VALUES
(97, 36, 0, '0000-00-00', '0000-00-00', 0, 0, 0, 0, 0, 569.76, 1, 0),
(98, 36, 1, '2022-01-17', '2022-01-17', 71.22, 66.71, 4.51, 0, 71.22, 503.05, 1, 0),
(99, 36, 2, '2022-02-17', '2022-01-17', 71.22, 67.24, 3.98, 0, 71.22, 435.81, 1, 0),
(100, 36, 3, '2022-03-17', '2022-01-17', 71.22, 67.77, 3.45, 0, 71.22, 368.04, 1, 0),
(101, 36, 3, '2022-03-17', '2022-01-17', 71.22, 100, 0, 100, 100, 199.73, 1, 0),
(102, 36, 4, '2022-04-17', '0000-00-00', 71.22, 68.31, 2.91, 0, 71.22, 299.73, 0, 0),
(103, 40, 0, '0000-00-00', '0000-00-00', 0, 0, 0, 0, 0, 465.48, 1, 0),
(104, 40, 1, '2022-01-17', '2022-01-17', 38.79, 34.72, 4.07, 0, 38.79, 430.76, 1, 0),
(105, 40, 2, '2022-02-17', '0000-00-00', 38.79, 35.02, 3.77, 0, 38.79, 395.74, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `idpermiso` bigint(20) NOT NULL,
  `rolid` bigint(20) NOT NULL,
  `moduloid` bigint(20) NOT NULL,
  `leer` int(11) NOT NULL DEFAULT '0',
  `escribir` int(11) NOT NULL DEFAULT '0',
  `actualizar` int(11) NOT NULL DEFAULT '0',
  `eliminar` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`idpermiso`, `rolid`, `moduloid`, `leer`, `escribir`, `actualizar`, `eliminar`) VALUES
(293, 14, 1, 1, 0, 0, 0),
(294, 14, 2, 0, 0, 0, 0),
(295, 14, 3, 0, 0, 0, 0),
(296, 14, 4, 1, 0, 0, 0),
(297, 14, 5, 1, 0, 0, 0),
(298, 14, 6, 0, 0, 0, 0),
(299, 14, 7, 0, 0, 0, 0),
(300, 14, 8, 1, 0, 0, 0),
(301, 14, 9, 1, 0, 0, 0),
(302, 14, 10, 1, 0, 0, 0),
(303, 14, 11, 1, 0, 0, 0),
(304, 14, 12, 1, 0, 0, 0),
(305, 14, 13, 1, 0, 0, 0),
(306, 14, 14, 1, 0, 0, 0),
(307, 1, 1, 1, 1, 1, 1),
(308, 1, 2, 1, 1, 1, 1),
(309, 1, 3, 1, 1, 1, 1),
(310, 1, 4, 1, 1, 1, 1),
(311, 1, 5, 1, 1, 1, 1),
(312, 1, 6, 1, 1, 1, 1),
(313, 1, 7, 1, 1, 1, 1),
(314, 1, 8, 1, 1, 1, 1),
(315, 1, 9, 1, 1, 1, 1),
(316, 1, 10, 1, 1, 1, 1),
(317, 1, 11, 1, 1, 1, 1),
(318, 1, 12, 1, 1, 1, 1),
(319, 1, 13, 1, 1, 1, 1),
(320, 1, 14, 1, 1, 1, 1),
(321, 1, 15, 1, 1, 1, 1),
(322, 1, 16, 1, 1, 1, 1),
(323, 17, 1, 1, 0, 0, 0),
(324, 17, 2, 1, 0, 0, 0),
(325, 17, 3, 1, 0, 0, 0),
(326, 17, 4, 0, 0, 0, 0),
(327, 17, 5, 0, 0, 0, 0),
(328, 17, 6, 0, 0, 0, 0),
(329, 17, 7, 0, 0, 0, 0),
(330, 17, 8, 0, 0, 0, 0),
(331, 17, 9, 0, 0, 0, 0),
(332, 17, 10, 0, 0, 0, 0),
(333, 17, 11, 0, 0, 0, 0),
(334, 17, 12, 0, 0, 0, 0),
(335, 17, 13, 0, 0, 0, 0),
(336, 17, 14, 0, 0, 0, 0),
(337, 17, 15, 0, 0, 0, 0),
(338, 17, 16, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `idproducto` bigint(20) NOT NULL,
  `codigobarra` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `estado` tinyint(4) NOT NULL,
  `stock` int(11) NOT NULL,
  `imagen` varchar(100) NOT NULL,
  `idmarca` bigint(20) NOT NULL,
  `idcategoria` bigint(20) NOT NULL,
  `idunidadmedida` bigint(20) NOT NULL,
  `precio` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`idproducto`, `codigobarra`, `descripcion`, `estado`, `stock`, `imagen`, `idmarca`, `idcategoria`, `idunidadmedida`, `precio`) VALUES
(5, '00001', 'GOLPEADOR PARA PUERTA T/LEON', 1, 100, '', 7, 5, 4, 11),
(6, '00002', 'JALADERA PARA MUEBLE', 1, 95, '', 7, 5, 4, 1400),
(7, '00004', 'Lavadora', 0, 0, '', 7, 5, 4, NULL),
(8, '00005', 'Mabe Refrigeradora Extreme Inox', 0, 0, '', 7, 5, 4, NULL),
(9, '00006', 'Mabe Refrigeradora Extreme Inox', 1, 47, '', 7, 5, 4, 660),
(10, '00007', 'Mastertech Licuadora', 1, 24, '', 7, 5, 4, 22),
(11, '00008', 'Whirlpool Refrigeradora', 1, 46, '', 7, 5, 4, 440),
(12, '00009', 'Whirlpool Cocina eléctrica', 1, 23, '', 7, 5, 4, 440),
(13, '000010', 'Samsung Televisor Smart TV 50\'\'', 1, 33, '', 7, 5, 4, 440),
(14, '000011', 'Samsung Aire acondicionado Inverter', 1, 13, '', 7, 5, 4, 550),
(15, '000012', 'Whirlpool Lavadora / 8MWTW1934MJM', 1, 43, '', 7, 5, 4, 616),
(16, '000013', 'Moval Moveis Ropero / DAKAR5CASW', 1, 13, '', 7, 5, 4, 330),
(17, '000014', 'Regina Cama / COMFORPLUSMA / Matrimonial', 1, 13, '', 7, 5, 4, 440),
(18, '000015', 'Serta Cama / ADVANCEMEDIN / Imperial', 1, 13, '', 7, 5, 4, 440),
(19, '000016', 'Mabe Refrigeradora Extreme Inox / RMP400FJNU / 14 Pies', 1, 13, '', 7, 5, 4, 440),
(20, '00020', 'LAVADORA SAMSUMG', 1, 1, '', 8, 7, 4, 550);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `idproveedor` bigint(20) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `direccion` text NOT NULL,
  `estado` tinyint(4) NOT NULL,
  `telefono` varchar(9) NOT NULL,
  `contacto_vendedor` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`idproveedor`, `nombre`, `direccion`, `estado`, `telefono`, `contacto_vendedor`) VALUES
(4, 'ACACESPROMAC, DE R.L.', 'SAN SALVADOR, SAN SALVADOR', 1, '2521-0000', 'Alexander Fleming'),
(5, 'ACACESPROMAC, DE R.L.', 'SAN SALVADOR, SAN SALVADOR', 1, '2521-0000', 'Alexander Fleming');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `idrol` bigint(20) NOT NULL,
  `nombrerol` varchar(50) COLLATE utf8mb4_swedish_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_swedish_ci NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`idrol`, `nombrerol`, `descripcion`, `estado`) VALUES
(1, 'Administrador', 'Administrador', 1),
(14, 'Gerente', 'Mas funciones', 1),
(15, 'Vendedor', 'Descripción', 1),
(16, 'fh', 'fh', 0),
(17, 'nuevo', 'nuevo', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_configuracion`
--

CREATE TABLE `tbl_configuracion` (
  `id_configuracion` int(11) NOT NULL,
  `tiempo_incobrable` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `tbl_configuracion`
--

INSERT INTO `tbl_configuracion` (`id_configuracion`, `tiempo_incobrable`) VALUES
(1, '90 dias');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_embargo`
--

CREATE TABLE `tbl_embargo` (
  `id_embargo` int(11) NOT NULL,
  `pdf_embargo` varchar(255) NOT NULL,
  `persona_pn` varchar(255) DEFAULT NULL,
  `persona_pj` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `tbl_embargo`
--

INSERT INTO `tbl_embargo` (`id_embargo`, `pdf_embargo`, `persona_pn`, `persona_pj`) VALUES
(18, 'PN-001.pdf', 'PN-001', NULL),
(19, 'PN-001.pdf', 'PN-001', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_fiador`
--

CREATE TABLE `tbl_fiador` (
  `id_fiador` int(11) NOT NULL,
  `nombre_fiador` varchar(255) NOT NULL,
  `direccion_fiador` varchar(255) NOT NULL,
  `dui_fiador` varchar(10) NOT NULL,
  `telefono_fiador` varchar(9) DEFAULT NULL,
  `boleta_de_pago` varchar(255) NOT NULL,
  `persona_natural` varchar(255) DEFAULT NULL,
  `persona_juridica` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `tbl_fiador`
--

INSERT INTO `tbl_fiador` (`id_fiador`, `nombre_fiador`, `direccion_fiador`, `dui_fiador`, `telefono_fiador`, `boleta_de_pago`, `persona_natural`, `persona_juridica`) VALUES
(5, 'Luis ortega', 'San Vicente', '86354785-6', '34567889', '86354785-6.pdf', 'PN-001', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_persona_juridica`
--

CREATE TABLE `tbl_persona_juridica` (
  `codigo_persona_juridica` varchar(15) NOT NULL,
  `nombre_empresa_persona_juridica` varchar(255) NOT NULL,
  `direccion_persona_juridica` varchar(255) NOT NULL,
  `idtelefono_persona_juridica` varchar(255) NOT NULL,
  `idbalancegeneral_persona_juridica` varchar(255) DEFAULT NULL,
  `idestadoresultado_persona_juridica` varchar(255) DEFAULT NULL,
  `categoria` varchar(255) DEFAULT NULL,
  `ventas_netas` double(255,2) DEFAULT NULL,
  `activos_corrientes` double(255,2) DEFAULT NULL,
  `inventarios` double(255,2) DEFAULT NULL,
  `costos_de_ventas` double(255,2) DEFAULT NULL,
  `pasivos_corrientes` double(255,2) DEFAULT NULL,
  `cuentas_cobrar` double(255,2) DEFAULT NULL,
  `incobrable_persona_juridica` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `tbl_persona_juridica`
--

INSERT INTO `tbl_persona_juridica` (`codigo_persona_juridica`, `nombre_empresa_persona_juridica`, `direccion_persona_juridica`, `idtelefono_persona_juridica`, `idbalancegeneral_persona_juridica`, `idestadoresultado_persona_juridica`, `categoria`, `ventas_netas`, `activos_corrientes`, `inventarios`, `costos_de_ventas`, `pasivos_corrientes`, `cuentas_cobrar`, `incobrable_persona_juridica`) VALUES
('PJ-001', 'Thermo Plast s.a de c.v', 'San Salvador', '75385493', 'PJ-001balancegeneral.pdf', 'PJ-001estadoresultado.pdf', 'A', 40000.00, 35000.00, 45000.00, 60000.00, 50000.00, 40799.00, NULL),
('PJ-002', 'SigmaQ Specialty Products', 'San Vicente', '34567890', 'PJ-002balancegeneral.pdf', 'PJ-002estadoresultado.pdf', 'B', 36000.00, 43777.00, 37777.00, 377777.00, 373737.00, 3636.00, NULL),
('PJ-003', 'Empresas Industriales San Benito', 'San Vicente', '75835200', 'PJ-003balancegeneral.pdf', 'PJ-003estadoresultado.pdf', 'C', 234564.00, 245656.00, 25655.00, 256356.00, 2356.00, 2565.00, NULL),
('PJ-004', 'Industrias Verde Global S.A. de C.V. El Salvador', 'San Vicente', '75835200', 'PJ-004balancegeneral.pdf', 'PJ-004estadoresultado.pdf', 'D', 254625.00, 24562546.00, 25623456.00, 54656.00, 56456.00, 45455.00, NULL),
('PJ-005', 'CHACALACA S.V', 'San Vicente', '753648697', 'PJ-005balancegeneral.pdf', 'PJ-005estadoresultado.pdf', 'D', 45000.00, 35000.00, 34000.00, 23000.00, 50000.00, 56000.00, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_persona_natural`
--

CREATE TABLE `tbl_persona_natural` (
  `codigo_persona_natural` varchar(15) NOT NULL,
  `nombre_persona_natural` varchar(50) NOT NULL,
  `apellido_persona_natural` varchar(50) NOT NULL,
  `direccion_persona_natural` varchar(255) NOT NULL,
  `telefono_persona_natural` varchar(9) NOT NULL,
  `dui_persona_natural` varchar(10) NOT NULL,
  `estado_civil_persona_natural` varchar(10) NOT NULL,
  `lugar_trabajo_persona_natural` varchar(255) NOT NULL,
  `ingreso_persona_natural` float(255,2) NOT NULL,
  `egresos_persona_natural` float(255,2) NOT NULL,
  `id_boleta_de_pago__persona_natural` varchar(100) DEFAULT NULL,
  `categoria` varchar(255) DEFAULT NULL,
  `incobrable_persona_natural` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `tbl_persona_natural`
--

INSERT INTO `tbl_persona_natural` (`codigo_persona_natural`, `nombre_persona_natural`, `apellido_persona_natural`, `direccion_persona_natural`, `telefono_persona_natural`, `dui_persona_natural`, `estado_civil_persona_natural`, `lugar_trabajo_persona_natural`, `ingreso_persona_natural`, `egresos_persona_natural`, `id_boleta_de_pago__persona_natural`, `categoria`, `incobrable_persona_natural`) VALUES
('PN-001', 'Riquelmi', 'Palacios', 'San Vicente', '75835200', '97653463-5', 'Soltero', 'San Vicente', 1000.00, 900.00, 'PN-001.pdf', 'A', NULL),
('PN-002', 'William', 'Del cid', 'San Salvador', '87654332', '96264783-5', 'Acompañado', 'San Salvador', 1000.00, 900.00, 'PN-002.pdf', 'B', NULL),
('PN-003', 'Vladimir', 'Barrera', 'Zacatecoluca', '76538474', '08943686-5', 'Casado', 'Zacatecoluca', 1000.00, 900.00, 'PN-003.pdf', 'C', NULL),
('PN-004', 'Mishel', 'Rodriguez', 'San Salvador', '7654386', '97457306-8', 'Casada', 'San Salvador', 1000.00, 900.00, 'PN-004.pdf', 'D', NULL),
('PN-005', 'Eli', 'Henriquez', 'San Vicente', '3456789', '04758694-6', 'Soltero', 'San Vicente', 1300.00, 950.00, 'PN-005.pdf', 'D', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_activofijo`
--

CREATE TABLE `tipo_activofijo` (
  `idtipoactivo` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `codigo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `tipo_activofijo`
--

INSERT INTO `tipo_activofijo` (`idtipoactivo`, `nombre`, `codigo`) VALUES
(1, 'Mobiliario y Equipo', 'ME'),
(2, 'Terrenos', 'TE'),
(3, 'Transporte', 'TA'),
(4, 'Software', 'SW');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidadmedida`
--

CREATE TABLE `unidadmedida` (
  `idunidad` bigint(20) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `unidadmedida`
--

INSERT INTO `unidadmedida` (`idunidad`, `nombre`) VALUES
(4, 'Unidad');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` bigint(20) NOT NULL,
  `email_usuario` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `contrasena` varchar(75) COLLATE utf8mb4_swedish_ci NOT NULL,
  `idempleado` bigint(20) DEFAULT NULL,
  `token` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `rolid` bigint(20) NOT NULL,
  `datecreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estado` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `email_usuario`, `contrasena`, `idempleado`, `token`, `rolid`, `datecreated`, `estado`) VALUES
(1, 'admin', 'b0aad50a487a562d3eed26bb582740883639c1e0fbcf723683fa773beab97c54', 1, '', 1, '2021-08-11 16:22:35', 1),
(17, '12', '3641faba9e314792dc078f8a012e38c1388f404c2356548c5edc31c9eab76257', 20, '', 1, '2021-11-02 15:42:21', 0),
(18, 'riccieripalacios@gmail.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 1, '', 1, '2021-12-30 18:42:36', 1),
(22, 'riccieripalacios9@gmail.com', '19b467c33178175ae13a0b79d91850dc557a3f74b0b7111386104f320b8170ab', 20, '', 1, '2022-01-17 15:23:03', 0),
(23, 'mishel@gmail.com', 'be58362980a8a22c859963db565f9d21d031525852e11140c79a30cc78431854', 21, '', 17, '2022-01-17 15:59:39', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `idventa` bigint(20) NOT NULL,
  `dia` int(11) NOT NULL,
  `mes` int(11) NOT NULL,
  `anio` int(11) NOT NULL,
  `monto` double NOT NULL,
  `estado` tinyint(4) NOT NULL,
  `idusuario` bigint(20) NOT NULL,
  `subtotal` double DEFAULT NULL,
  `iva` double DEFAULT NULL,
  `idclientejuridico` varchar(15) DEFAULT NULL,
  `idclientenat` varchar(15) DEFAULT NULL,
  `tipocliente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`idventa`, `dia`, `mes`, `anio`, `monto`, `estado`, `idusuario`, `subtotal`, `iva`, `idclientejuridico`, `idclientenat`, `tipocliente`) VALUES
(36, 17, 1, 2022, 643.83, 1, 1, 569.76, 74.07, NULL, 'PN-001', 1),
(37, 17, 1, 2022, 3909.8, 1, 1, 3460, 449.8, NULL, 'PN-001', 1),
(38, 17, 1, 2022, 49.72, 1, 1, 44, 5.72, 'PJ-001', NULL, 2),
(39, 17, 1, 2022, 525.99, 1, 1, 465.48, 60.51, NULL, 'PN-001', 1),
(40, 17, 1, 2022, 745.8, 1, 1, 660, 85.8, NULL, 'PN-001', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `activofijo_bienes`
--
ALTER TABLE `activofijo_bienes`
  ADD PRIMARY KEY (`codigo_correlativo`) USING BTREE,
  ADD KEY `fk_idactivofijo` (`id_activofijo`) USING BTREE;

--
-- Indices de la tabla `activo_fijo`
--
ALTER TABLE `activo_fijo`
  ADD PRIMARY KEY (`codigo`) USING BTREE,
  ADD KEY `fk_tipo_activo` (`tipo_activo`) USING BTREE,
  ADD KEY `fk_idproveedor` (`idproveedor`) USING BTREE;

--
-- Indices de la tabla `cargo`
--
ALTER TABLE `cargo`
  ADD PRIMARY KEY (`idcargo`) USING BTREE;

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idcategoria`) USING BTREE;

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`codigo_cliente_natural`) USING BTREE;

--
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`idcompra`) USING BTREE,
  ADD KEY `fk_compraprov` (`idproveedor`) USING BTREE,
  ADD KEY `fk_usucompra` (`idusuario`) USING BTREE;

--
-- Indices de la tabla `detallecompra`
--
ALTER TABLE `detallecompra`
  ADD PRIMARY KEY (`iddetalle`) USING BTREE,
  ADD KEY `fk_compra` (`idcompra`) USING BTREE,
  ADD KEY `fk_productocompra` (`idproducto`) USING BTREE;

--
-- Indices de la tabla `detalleventa`
--
ALTER TABLE `detalleventa`
  ADD PRIMARY KEY (`iddetalle`) USING BTREE,
  ADD KEY `fk_productoventa` (`idventa`) USING BTREE,
  ADD KEY `fk_ventaprod` (`idproducto`) USING BTREE;

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`idempleado`) USING BTREE,
  ADD KEY `fk_cargo` (`idcargo`) USING BTREE;

--
-- Indices de la tabla `imagen`
--
ALTER TABLE `imagen`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `fk_imagenprod` (`productoid`) USING BTREE;

--
-- Indices de la tabla `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`idmarca`) USING BTREE;

--
-- Indices de la tabla `modulo`
--
ALTER TABLE `modulo`
  ADD PRIMARY KEY (`idmodulo`) USING BTREE;

--
-- Indices de la tabla `pagocuota`
--
ALTER TABLE `pagocuota`
  ADD PRIMARY KEY (`idpagocuota`) USING BTREE,
  ADD KEY `fk_venta_credito` (`iddetalle`) USING BTREE;

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`idpermiso`) USING BTREE,
  ADD KEY `rolid` (`rolid`) USING BTREE,
  ADD KEY `moduloid` (`moduloid`) USING BTREE;

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`idproducto`) USING BTREE,
  ADD KEY `fk_marcaprod` (`idmarca`) USING BTREE,
  ADD KEY `fk_unidadmprod` (`idunidadmedida`) USING BTREE,
  ADD KEY `fk_categoria` (`idcategoria`) USING BTREE;

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`idproveedor`) USING BTREE;

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`idrol`) USING BTREE;

--
-- Indices de la tabla `tbl_configuracion`
--
ALTER TABLE `tbl_configuracion`
  ADD PRIMARY KEY (`id_configuracion`) USING BTREE;

--
-- Indices de la tabla `tbl_embargo`
--
ALTER TABLE `tbl_embargo`
  ADD PRIMARY KEY (`id_embargo`) USING BTREE,
  ADD KEY `fk_pn` (`persona_pn`) USING BTREE,
  ADD KEY `fk_pj` (`persona_pj`) USING BTREE;

--
-- Indices de la tabla `tbl_fiador`
--
ALTER TABLE `tbl_fiador`
  ADD PRIMARY KEY (`id_fiador`) USING BTREE,
  ADD KEY `fk_personanatural` (`persona_natural`) USING BTREE,
  ADD KEY `fk_personajuridica` (`persona_juridica`) USING BTREE;

--
-- Indices de la tabla `tbl_persona_juridica`
--
ALTER TABLE `tbl_persona_juridica`
  ADD PRIMARY KEY (`codigo_persona_juridica`) USING BTREE;

--
-- Indices de la tabla `tbl_persona_natural`
--
ALTER TABLE `tbl_persona_natural`
  ADD PRIMARY KEY (`codigo_persona_natural`) USING BTREE;

--
-- Indices de la tabla `tipo_activofijo`
--
ALTER TABLE `tipo_activofijo`
  ADD PRIMARY KEY (`idtipoactivo`) USING BTREE;

--
-- Indices de la tabla `unidadmedida`
--
ALTER TABLE `unidadmedida`
  ADD PRIMARY KEY (`idunidad`) USING BTREE;

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`) USING BTREE,
  ADD KEY `rolid` (`rolid`) USING BTREE,
  ADD KEY `fk_empleado` (`idempleado`) USING BTREE;

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`idventa`) USING BTREE,
  ADD KEY `fk_usuventa` (`idusuario`) USING BTREE,
  ADD KEY `fk_clientjuri` (`idclientejuridico`) USING BTREE,
  ADD KEY `fk_clientenat` (`idclientenat`) USING BTREE;

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cargo`
--
ALTER TABLE `cargo`
  MODIFY `idcargo` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idcategoria` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `idcompra` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `detallecompra`
--
ALTER TABLE `detallecompra`
  MODIFY `iddetalle` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `detalleventa`
--
ALTER TABLE `detalleventa`
  MODIFY `iddetalle` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `idempleado` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `imagen`
--
ALTER TABLE `imagen`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de la tabla `marca`
--
ALTER TABLE `marca`
  MODIFY `idmarca` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `modulo`
--
ALTER TABLE `modulo`
  MODIFY `idmodulo` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `pagocuota`
--
ALTER TABLE `pagocuota`
  MODIFY `idpagocuota` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `idpermiso` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=339;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `idproducto` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `idproveedor` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `idrol` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `tbl_configuracion`
--
ALTER TABLE `tbl_configuracion`
  MODIFY `id_configuracion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tbl_embargo`
--
ALTER TABLE `tbl_embargo`
  MODIFY `id_embargo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `tbl_fiador`
--
ALTER TABLE `tbl_fiador`
  MODIFY `id_fiador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `unidadmedida`
--
ALTER TABLE `unidadmedida`
  MODIFY `idunidad` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `idventa` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `activofijo_bienes`
--
ALTER TABLE `activofijo_bienes`
  ADD CONSTRAINT `fk_idactivofijo` FOREIGN KEY (`id_activofijo`) REFERENCES `activo_fijo` (`codigo`);

--
-- Filtros para la tabla `activo_fijo`
--
ALTER TABLE `activo_fijo`
  ADD CONSTRAINT `fk_idproveedor` FOREIGN KEY (`idproveedor`) REFERENCES `proveedor` (`idproveedor`),
  ADD CONSTRAINT `fk_tipo_activo` FOREIGN KEY (`tipo_activo`) REFERENCES `tipo_activofijo` (`idtipoactivo`);

--
-- Filtros para la tabla `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `fk_compraprov` FOREIGN KEY (`idproveedor`) REFERENCES `proveedor` (`idproveedor`),
  ADD CONSTRAINT `fk_usucompra` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`);

--
-- Filtros para la tabla `detallecompra`
--
ALTER TABLE `detallecompra`
  ADD CONSTRAINT `fk_compra` FOREIGN KEY (`idcompra`) REFERENCES `compra` (`idcompra`),
  ADD CONSTRAINT `fk_compraprod` FOREIGN KEY (`idproducto`) REFERENCES `producto` (`idproducto`);

--
-- Filtros para la tabla `detalleventa`
--
ALTER TABLE `detalleventa`
  ADD CONSTRAINT `fk_venta` FOREIGN KEY (`idventa`) REFERENCES `venta` (`idventa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ventaprod` FOREIGN KEY (`idproducto`) REFERENCES `producto` (`idproducto`);

--
-- Filtros para la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD CONSTRAINT `fk_cargo` FOREIGN KEY (`idcargo`) REFERENCES `cargo` (`idcargo`);

--
-- Filtros para la tabla `imagen`
--
ALTER TABLE `imagen`
  ADD CONSTRAINT `fk_imagenprod` FOREIGN KEY (`productoid`) REFERENCES `producto` (`idproducto`);

--
-- Filtros para la tabla `pagocuota`
--
ALTER TABLE `pagocuota`
  ADD CONSTRAINT `fk_venta_credito` FOREIGN KEY (`iddetalle`) REFERENCES `detalleventa` (`iddetalle`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD CONSTRAINT `permisos_ibfk_1` FOREIGN KEY (`rolid`) REFERENCES `rol` (`idrol`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permisos_ibfk_2` FOREIGN KEY (`moduloid`) REFERENCES `modulo` (`idmodulo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `fk_categoria` FOREIGN KEY (`idcategoria`) REFERENCES `categoria` (`idcategoria`),
  ADD CONSTRAINT `fk_marcaprod` FOREIGN KEY (`idmarca`) REFERENCES `marca` (`idmarca`),
  ADD CONSTRAINT `fk_unidadmprod` FOREIGN KEY (`idunidadmedida`) REFERENCES `unidadmedida` (`idunidad`);

--
-- Filtros para la tabla `tbl_embargo`
--
ALTER TABLE `tbl_embargo`
  ADD CONSTRAINT `fk_pj` FOREIGN KEY (`persona_pj`) REFERENCES `tbl_persona_juridica` (`codigo_persona_juridica`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pn` FOREIGN KEY (`persona_pn`) REFERENCES `tbl_persona_natural` (`codigo_persona_natural`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbl_fiador`
--
ALTER TABLE `tbl_fiador`
  ADD CONSTRAINT `fk_personajuridica` FOREIGN KEY (`persona_juridica`) REFERENCES `tbl_persona_juridica` (`codigo_persona_juridica`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_personanatural` FOREIGN KEY (`persona_natural`) REFERENCES `tbl_persona_natural` (`codigo_persona_natural`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_empleado` FOREIGN KEY (`idempleado`) REFERENCES `empleado` (`idempleado`),
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`rolid`) REFERENCES `rol` (`idrol`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `fk_clientenat` FOREIGN KEY (`idclientenat`) REFERENCES `tbl_persona_natural` (`codigo_persona_natural`),
  ADD CONSTRAINT `fk_clientjuri` FOREIGN KEY (`idclientejuridico`) REFERENCES `tbl_persona_juridica` (`codigo_persona_juridica`),
  ADD CONSTRAINT `fk_usuventa` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
