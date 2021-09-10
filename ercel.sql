-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-08-2021 a las 21:28:38
-- Versión del servidor: 10.4.20-MariaDB
-- Versión de PHP: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ercel`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `abonos`
--

CREATE TABLE `abonos` (
  `id` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_credito` int(11) NOT NULL,
  `abono` decimal(10,0) NOT NULL,
  `fecha_abono` datetime NOT NULL,
  `atendido` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `cedula` int(11) NOT NULL,
  `correo` varchar(200) NOT NULL,
  `direccion` varchar(200) NOT NULL,
  `celular` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `cedula`, `correo`, `direccion`, `celular`) VALUES
(5, 'CLIENTE COMUN', 0, 'cliente@hotmail.com', 'SAN JOSE', '000000000'),
(8, 'SILVANA', 10000000, 'silvana22@hotmail.com', 'chinu', '30000000'),
(9, 'SARA REALES', 10000, 'sarareales@hotmail.com', 'chinu', '300000'),
(10, 'carmela soto', 25913517, 'cliente@hotmail.com', 'SAN JOSE', '33110000000'),
(11, 'katerin', 10661830, 'cliente@hotmail.com', 'SAN JOSE', '3003182167'),
(12, 'KEILA SAN JOSE', 123654789, 'cliente@hotmail.com', 'SAN JOSE', '3104940606'),
(13, 'SHIRLEY CARTAGENA', 123456789, 'cliente@hotmail.com', 'SAN MARCOS SUCRE', '3108586135'),
(14, 'LEIDY GARCIA', 1020304050, 'cliente@hotmail.com', 'SUCRE SUCRE', '3135222694'),
(15, 'YISELA SEVERICHE', 987654321, 'cliente@hotmail.com', 'SINCELEJO', '3205918153'),
(16, 'ZARETH', 789654123, 'cliente@hotmail.com', 'SINCELEJO SUCRE', '3014528979'),
(17, 'oscar ramirez', 62518432, 'cliente@hotmail.com', 'chinu', '3216454879'),
(18, 'monica de la osa', 582963147, 'cliente@hotmail.com', 'SAN JOSE', '321654789'),
(19, 'melisa marsiglia', 159357258, 'cliente@hotmail.com', 'SAN JOSE', '321456987'),
(20, 'luisa muñoz', 2147483647, 'cliente@hotmail.com', 'chinu', '3015264310'),
(21, 'YEISY HOYOS ', 1478522384, 'cliente@hotmail.com', 'SAHAGUN CORDOBA', '3106147885'),
(22, 'LEIDY MONTRROZA', 147852369, 'cliente@hotmail.com', 'chinu', '3013398454'),
(23, 'ALDAIR SIERRA', 369852147, 'cliente@hotmail.com', 'SINCELEJO SUCRE', '3046202459'),
(24, 'YOLIMA ROMERO', 64741743, 'cliente@hotmail.com', 'COROZAL', '3012821469'),
(25, 'aaaaaaaaa', 2147483647, 'eramire@hotmqiñ.com', 'chinu', '1111111111111111');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cotizaciones`
--

CREATE TABLE `cotizaciones` (
  `id` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `cliente` int(11) NOT NULL,
  `total` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `creditos`
--

CREATE TABLE `creditos` (
  `id` int(11) NOT NULL,
  `cliente` int(11) NOT NULL,
  `cajero` varchar(200) NOT NULL,
  `fecha_credito` datetime NOT NULL,
  `fecha_gasto` datetime DEFAULT NULL,
  `saldo_pendiente` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle`
--

CREATE TABLE `detalle` (
  `id` int(11) NOT NULL,
  `venta` int(11) NOT NULL,
  `refproducto` varchar(200) NOT NULL,
  `producto` varchar(200) NOT NULL,
  `detallesMarca` varchar(200) NOT NULL,
  `stock` int(11) NOT NULL,
  `precio_compra` decimal(10,0) NOT NULL,
  `subtotal` decimal(10,0) NOT NULL,
  `descuento` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallescotizacion`
--

CREATE TABLE `detallescotizacion` (
  `id` int(11) NOT NULL,
  `venta` int(11) NOT NULL,
  `refproducto` int(11) NOT NULL,
  `producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `comentario` varchar(200) NOT NULL,
  `subtotal` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detallescotizacion`
--

INSERT INTO `detallescotizacion` (`id`, `venta`, `refproducto`, `producto`, `cantidad`, `comentario`, `subtotal`) VALUES
(1, 1, 0, 61, 2, 'Nada', '20000'),
(2, 2, 0, 85, 9, 'Nada', '-12000'),
(3, 3, 0, 38, 6, 'Nada', '60000'),
(4, 4, 0, 65, 53, 'Nada', '130000'),
(5, 4, 0, 77, 64, 'Nada', '34000'),
(6, 4, 0, 12, 2, 'Nada', '70000'),
(7, 4, 0, 13, 2, 'Nada', '35000'),
(8, 4, 0, 6, 4, 'Nada', '55000'),
(9, 4, 0, 98, 8, 'Nada', '42000'),
(10, 4, 0, 66, 19, 'Nada', '65000'),
(11, 4, 0, 128, 1, 'Nada', '60000'),
(12, 5, 0, 65, 53, 'Nada', '130000'),
(13, 5, 0, 77, 64, 'Nada', '34000'),
(14, 5, 0, 13, 2, 'Nada', '35000'),
(15, 5, 0, 12, 2, 'Nada', '70000'),
(16, 5, 0, 6, 4, 'Nada', '55000'),
(17, 5, 0, 98, 8, 'Nada', '42000'),
(18, 5, 0, 66, 19, 'Nada', '65000'),
(19, 5, 0, 128, 1, 'Nada', '60000'),
(20, 6, 0, 43, 9, 'Nada', '64000'),
(21, 6, 0, 97, 7, 'Nada', '35000'),
(22, 6, 0, 77, 62, 'Nada', '34000'),
(23, 6, 0, 65, 47, 'Nada', '60000'),
(24, 7, 0, 22, 105, 'Nada', '120000'),
(25, 7, 0, 134, 1, 'Nada', '50000'),
(26, 7, 0, 135, 1, 'Nada', '29000'),
(27, 7, 0, 31, 30, 'Nada', '32000'),
(28, 7, 0, 113, 16, 'Nada', '60000'),
(29, 8, 0, 59, 7, 'Nada', '28000'),
(30, 9, 0, 59, 7, 'Nada', '28000');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `egresos`
--

CREATE TABLE `egresos` (
  `id` int(11) NOT NULL,
  `comentario` varchar(200) NOT NULL,
  `valor` decimal(10,0) NOT NULL,
  `fecha` datetime NOT NULL,
  `usuario` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `egresos`
--

INSERT INTO `egresos` (`id`, `comentario`, `valor`, `fecha`, `usuario`) VALUES
(4, 'plan separe carmela soto 2020', '35000', '2021-01-18 15:30:06', 'Andreina Sierra Guzman  '),
(5, 'plan separe sara seales 2020', '20000', '2021-01-18 15:30:55', 'Andreina Sierra Guzman  '),
(6, 'plan separe silvana 2020', '20000', '2021-01-18 15:31:19', 'Andreina Sierra Guzman  '),
(13, 'trasferencia bermuda', '45000', '2021-01-28 11:04:53', 'Andreina Sierra Guzman  '),
(14, 'trasferencia leidy garcia', '67000', '2021-01-28 11:05:36', 'Andreina Sierra Guzman  '),
(15, 'trasferencia sindy suarez', '100000', '2021-01-28 15:48:43', 'Andreina Sierra Guzman  '),
(16, 'TRASFERENCIA YEISI HOYOS 29-01-2021', '126000', '2021-01-29 16:54:19', 'Andreina Sierra Guzman  ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `negocio`
--

CREATE TABLE `negocio` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `nit` varchar(200) NOT NULL,
  `celular` varchar(20) NOT NULL,
  `direccion` varchar(200) NOT NULL,
  `correo` varchar(200) NOT NULL,
  `meta` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `negocio`
--

INSERT INTO `negocio` (`id`, `nombre`, `nit`, `celular`, `direccion`, `correo`, `meta`) VALUES
(1, 'ERCEL', '100000000', '300000', 'SAHAGUN', 'ercel@gmail.com', '2000000');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `talla` varchar(200) DEFAULT NULL,
  `nombre` varchar(200) NOT NULL,
  `detallesMarca` varchar(200) DEFAULT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_compra` decimal(10,0) NOT NULL,
  `precio_venta` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `fecha` datetime NOT NULL,
  `valorFactura` decimal(10,0) NOT NULL,
  `flete` decimal(10,0) DEFAULT NULL,
  `proveedor` varchar(200) NOT NULL,
  `medioPago` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`id`, `descripcion`, `fecha`, `valorFactura`, `flete`, `proveedor`, `medioPago`) VALUES
(4, 'confeccion', '2021-01-28 17:18:27', '220000', '0', 'yalitza', 'Efectivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `usuario` varchar(200) NOT NULL,
  `password` varchar(100) NOT NULL,
  `acceso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `usuario`, `password`, `acceso`) VALUES
(3, 'Andreina Sierra Guzman  ', 'administrador', '$2y$15$U7wUW6DLA4f4dVrOOOsN2OBawg7idV/smp97p9CDL2NmY5xZiwnhu', 1),
(4, 'vendedor', 'vendedor', '$2y$15$oU.uoud3diG1p8kL.LOynOJeixBoD1lPzR3azQrTehMD3q4WBI.6q', 2),
(5, 'Jose Mercado Diaz ', 'josediaz', '$2y$15$S9rEKQmWldE.cDsioSeLIOoR8GpQ3KnHa.cLu/sb08vsAtHoCs2vC', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `cliente` int(11) NOT NULL,
  `total` decimal(10,0) NOT NULL,
  `acreditado` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `abonos`
--
ALTER TABLE `abonos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cotizaciones`
--
ALTER TABLE `cotizaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `creditos`
--
ALTER TABLE `creditos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle`
--
ALTER TABLE `detalle`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detallescotizacion`
--
ALTER TABLE `detallescotizacion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `egresos`
--
ALTER TABLE `egresos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `negocio`
--
ALTER TABLE `negocio`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `abonos`
--
ALTER TABLE `abonos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `cotizaciones`
--
ALTER TABLE `cotizaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `creditos`
--
ALTER TABLE `creditos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `detalle`
--
ALTER TABLE `detalle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=179;

--
-- AUTO_INCREMENT de la tabla `detallescotizacion`
--
ALTER TABLE `detallescotizacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `egresos`
--
ALTER TABLE `egresos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `negocio`
--
ALTER TABLE `negocio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
