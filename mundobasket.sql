-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-11-2023 a las 19:42:34
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mundobasket`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_pedido`
--

CREATE TABLE `detalle_pedido` (
  `id_detalle` int(11) NOT NULL,
  `id_pedido` int(11) DEFAULT NULL,
  `id_producto` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detalle_pedido`
--

INSERT INTO `detalle_pedido` (`id_detalle`, `id_pedido`, `id_producto`) VALUES
(1, 1, 8),
(2, 1, 7),
(3, 1, 6),
(4, 1, 5),
(5, 1, 5),
(6, 1, 5),
(7, 1, 3),
(8, 2, 2),
(9, 2, 2),
(10, 2, 3),
(11, 3, 6),
(12, 3, 6),
(13, 3, 3),
(14, 3, 4),
(15, 4, 3),
(16, 4, 4),
(17, 4, 8),
(18, 4, 11),
(19, 4, 12),
(20, 4, 6),
(21, 4, 6),
(22, 4, 5),
(23, 5, 2),
(24, 5, 4),
(25, 5, 9),
(26, 5, 7),
(27, 5, 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos`
--

CREATE TABLE `grupos` (
  `id_grupo` int(11) NOT NULL,
  `nombre` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `grupos`
--

INSERT INTO `grupos` (`id_grupo`, `nombre`) VALUES
(1, 'Camisetas temporada 23/24'),
(2, 'Camisetas city edition 23/24'),
(3, 'Accesorios'),
(4, 'Ropa de calle'),
(5, 'Objetos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id_pedido` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `fecha_pedido` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id_pedido`, `id_usuario`, `fecha_pedido`) VALUES
(1, 1, '2023-11-20'),
(2, 2, '2023-11-20'),
(3, 1, '2023-11-21'),
(4, 1000, '2023-11-23'),
(5, 1, '2023-11-23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `nombre` varchar(256) DEFAULT NULL,
  `descripcion` varchar(625) DEFAULT NULL,
  `imagen` varchar(256) DEFAULT NULL,
  `talla` varchar(4) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `id_grupo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `nombre`, `descripcion`, `imagen`, `talla`, `stock`, `precio`, `id_grupo`) VALUES
(1, 'Camiseta Memphis Grizzlies', 'Camiseta local temporada 23/24 - Ja Morant 12', '<img src=\"img/1.jpg\" />', 'XL', 30, '89.00', 1),
(2, 'Camiseta Minnesota Timberwolves', 'Camiseta city edition - Anthony Edwards 1', '<img src=\"img/2.jpg\" />', 'M', 5, '115.00', 2),
(3, 'Camiseta Golden State Warriors', 'Camiseta visitante temporada 23/24 - Chris Paul 3', '<img src=\"img/3.jpg\" />', 'L', 45, '94.00', 1),
(4, 'Casiseta Houston Rockets', 'Camiseta city edition - Jalen Green 4', '<img src=\"img/4.jpg\" />', 'XL', 10, '110.00', 2),
(5, 'Cinta NBA', 'Cinta para la cabeza oficial NBA', '<img src=\"img/5.jpg\" />', NULL, 100, '35.00', 3),
(6, 'Muñequera', 'Muñequeras verdes originales NBA. Talla única para todos.', '<img src=\"img/6.jpg\" />', NULL, 95, '14.00', 3),
(7, 'Calentador LA Lakers', 'Calentador negro LA Lakers oficial temporada 23/24.', '<img src=\"img/7.jpg\" />', 'S', 44, '19.00', 3),
(8, 'Sudadera San Antonio Spurs', 'Sudadera gris modelo San Antonio Spurs', '<img src=\"img/8.jpg\" />', 'M', 35, '54.00', 4),
(9, 'Pantalones Knicks', 'Pantalones cortos grises verano New York Knicks', '<img src=\"img/9.jpg\" />', 'XXL', 16, '24.00', 4),
(10, 'Camiseta Suns', 'Camiseta gris de calle Phoenix Suns vista en jugadores de la actual plantilla.', '<img src=\"img/10.jpg\" />', 'M', 28, '40.00', 4),
(11, 'Pelota NBA', 'Pelota reglamentaria NBA utilizada en la actual temporada', '<img src=\"img/11.jpg\" />', NULL, 120, '29.00', 5),
(12, 'Canasta', 'Canasta completa de medida ajustable hasta altura reglamentaria en NBA.', '<img src=\"img/12.jpg\" />', NULL, 75, '46.00', 5),
(16, 'Camiseta LA Lakers', 'Camiste visitante temporada 23/24 - Lebron James 23', '<img src=\"img/13.jpg\" />', 'XS', 21, '140.00', 1),
(17, 'Camiseta Miami Heat', 'Camiste visitante 23/24 - Jimmy Butler 22', '<img src=\"img/14.jpg\" />', 'XL', 34, '89.99', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `contraseña` varchar(16) DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `apellido1` varchar(255) DEFAULT NULL,
  `apellido2` varchar(255) DEFAULT NULL,
  `telefono` int(11) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `username`, `contraseña`, `nombre`, `apellido1`, `apellido2`, `telefono`, `direccion`) VALUES
(1, 'gabrielgs', '123', 'Gabriel', 'Gutierrez', 'Segovia', 976606455, 'C/Amposta'),
(2, 'juanito_', '123', 'Juan', 'Perez', 'Sanchez', 3336534, 'C/Longitud'),
(1000, 'admin', 'admin', 'admin', NULL, NULL, NULL, NULL),
(1001, 'michaelSC', '123', 'Michael', 'Scofield', 'Jose', 976854321, 'C/Carcel');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  ADD PRIMARY KEY (`id_detalle`),
  ADD KEY `id_pedido` (`id_pedido`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD PRIMARY KEY (`id_grupo`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `id_grupo` (`id_grupo`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `grupos`
--
ALTER TABLE `grupos`
  MODIFY `id_grupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1002;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  ADD CONSTRAINT `detalle_pedido_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id_pedido`),
  ADD CONSTRAINT `detalle_pedido_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`);

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_grupo`) REFERENCES `grupos` (`id_grupo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
