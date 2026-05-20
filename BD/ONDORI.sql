-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 08-05-2026 a las 16:48:09
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ONDORI`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Administradores`
--

CREATE TABLE `Administradores` (
  `ID_Admin` int(11) NOT NULL,
  `Nombre` varchar(100) DEFAULT NULL,
  `Email` varchar(150) DEFAULT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `Administradores`
--

INSERT INTO `Administradores` (`ID_Admin`, `Nombre`, `Email`, `Password`) VALUES
(1, 'Admin Ondori', 'admin@ondori.com', '$2y$12$CkOK0JPGBXheX.241POMee72/yLPaFYVoKa.6leBiFi0k14JTaKhy'),
(2, 'Soporte Técnico', 'soporte@ondori.com', '1234'),
(3, 'Gerente Ventas', 'ventas@ondori.com', '1234'),
(4, 'Carlos García', 'carlos.garcia@email.com', '$2y$12$UUtZ4BkCD44eQ5.zT7VLIuHwRbX7/b/YzAyxhyaip33XX3oig8ABK');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Categorias`
--

CREATE TABLE `Categorias` (
  `ID_Categoria` int(11) NOT NULL,
  `Nombre_Categoria` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `Categorias`
--

INSERT INTO `Categorias` (`ID_Categoria`, `Nombre_Categoria`) VALUES
(1, 'Hombre'),
(2, 'Mujer'),
(3, 'Ofertas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Direccion`
--

CREATE TABLE `Direccion` (
  `ID_direccion` int(11) NOT NULL,
  `ID_USUario` int(11) DEFAULT NULL,
  `Calle` varchar(150) DEFAULT NULL,
  `Numero` varchar(20) DEFAULT NULL,
  `Ciudad` varchar(100) DEFAULT NULL,
  `Pais` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `Direccion`
--

INSERT INTO `Direccion` (`ID_direccion`, `ID_USUario`, `Calle`, `Numero`, `Ciudad`, `Pais`) VALUES
(1, 1, 'Av. Siempre Viva', '742', 'Springfield', 'España'),
(2, 2, 'Calle Mayor', '15', 'Madrid', 'España'),
(3, 3, 'Boulevard de los Sueños', '101', 'Barcelona', 'España');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Hombre`
--

CREATE TABLE `Hombre` (
  `id_producto` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `tipoRopa` varchar(100) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL,
  `talla` varchar(100) DEFAULT 'S, M, L, XL',
  `precio` decimal(10,2) DEFAULT NULL,
  `stock` int(11) DEFAULT 0,
  `foto` varchar(255) DEFAULT NULL,
  `ID_Categoria` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `Hombre`
--

INSERT INTO `Hombre` (`id_producto`, `nombre`, `descripcion`, `tipoRopa`, `color`, `talla`, `precio`, `stock`, `foto`, `ID_Categoria`) VALUES
(4, 'Sudadera Oversize Marrón', 'Sudadera de algodón orgánico con acabado premium.', 'Sudadera', 'Marrón', 'S, M, L, XL', 38.99, 15, 'img/hombre/sudadera_marron.jpg', 1),
(5, 'Chaqueta Bomber Marrón', 'Chaqueta ligera ideal para entretiempo.', 'Chaqueta', 'Marrón', 'M, L, XL', 55.00, 10, 'img/hombre/chaqueta_marron.jpg', 1),
(6, 'Sudadera Black Edition', 'Sudadera negra con logo bordado en el pecho y sudaderra rosa con logo bordado en el pecho', 'Sudadera', 'Negro', 'S, M, L, XL', 42.50, 20, 'img/hombre/sudadera_negra_1.jpg', 1),
(7, 'Sudadera Urban Night', 'Sudadera negra con capucha y cordones ajustables.', 'Sudadera', 'Negro', 'M, L, XL', 42.50, 18, 'img/hombre/sudadera_negra_2.jpg', 1),
(8, 'Camiseta Kenia Special', 'Edición limitada con estampado inspirado en Nairobi.', 'Camiseta', 'Arena', 'S, M', 24.95, 30, 'img/hombre/camiseta_kenia.jpg', 1),
(9, 'Sudadera Pure White', 'Sudadera blanca minimalista de tacto suave.', 'Sudadera', 'Blanco', 'L, XL', 39.99, 12, 'img/hombre/sudadera_blanca.jpg', 1),
(12, 'Camiseta Ondori Logo Signature', 'Camiseta negra premium de corte exclusivo con el logo oficial de Ondori estampado en el pecho.', 'Camiseta', 'Negro', 'S, M, L, XL', 29.99, 15, 'img/hombre/camiseta_ondori_logo.jpg', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Mujer`
--

CREATE TABLE `Mujer` (
  `id_producto` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `tipoRopa` varchar(50) DEFAULT NULL,
  `color` varchar(30) DEFAULT NULL,
  `talla` varchar(50) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `stock` int(11) DEFAULT 0,
  `foto` varchar(255) DEFAULT NULL,
  `ID_Categoria` int(11) DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `Mujer`
--

INSERT INTO `Mujer` (`id_producto`, `nombre`, `descripcion`, `tipoRopa`, `color`, `talla`, `precio`, `stock`, `foto`, `ID_Categoria`) VALUES
(1, 'Vestido Floral Verano', 'Vestido corto con estampado de flores.', 'Vestido', 'Floral', 'S, M, L', 25.00, 30, 'img/mujer/vestido_floral.jpg', 2),
(2, 'Blusa de Seda', 'Blusa elegante para oficina o eventos.', 'Blusa', 'Seda Natural', 'M, L, XL', 42.00, 15, 'img/mujer/blusa_seda.jpg', 2),
(3, 'Leggings Deportivos', 'Ideales para yoga y entrenamiento intenso.', 'Pantalón', 'Negro', 'S, M, L', 18.99, 40, 'img/mujer/leggings.jpg', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Ofertas`
--

CREATE TABLE `Ofertas` (
  `id_producto` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `stock` int(11) DEFAULT 0,
  `foto` varchar(255) DEFAULT NULL,
  `ID_Categoria` int(11) DEFAULT 3
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `Ofertas`
--

INSERT INTO `Ofertas` (`id_producto`, `nombre`, `descripcion`, `precio`, `stock`, `foto`, `ID_Categoria`) VALUES
(1, 'Pack 3 Calcetines', 'Calcetines deportivos en oferta 2x1.', 5.99, 100, 'img/ofertas/calcetines.jpg', 3),
(2, 'Gafas de Sol Retro', 'Protección UV400, modelo temporada pasada.', 12.50, 25, 'img/ofertas/gafas_retro.jpg', 3),
(3, 'Sudadera con Capucha', 'Últimas unidades en color gris.', 19.99, 8, 'img/ofertas/sudadera_gris.jpg', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Pedidos`
--

CREATE TABLE `Pedidos` (
  `ID_Pedido` int(11) NOT NULL,
  `ID_Usuario` int(11) NOT NULL,
  `Fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `Total` decimal(10,2) NOT NULL,
  `Estado` enum('Pendiente','Pagado','Enviado','Cancelado') DEFAULT 'Pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Pedido_Detalles`
--

CREATE TABLE `Pedido_Detalles` (
  `ID_Detalle` int(11) NOT NULL,
  `ID_Pedido` int(11) NOT NULL,
  `ID_Producto` int(11) NOT NULL,
  `Tabla_Origen` enum('Hombre','Mujer','Ofertas') NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Precio_Unitario` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Usuarios`
--

CREATE TABLE `Usuarios` (
  `ID_USUario` int(11) NOT NULL,
  `Nombre` varchar(100) DEFAULT NULL,
  `Apellido` varchar(100) DEFAULT NULL,
  `Email` varchar(150) DEFAULT NULL,
  `Telefono` varchar(20) DEFAULT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `Usuarios`
--

INSERT INTO `Usuarios` (`ID_USUario`, `Nombre`, `Apellido`, `Email`, `Telefono`, `Password`) VALUES
(1, 'Carlos', 'García', 'carlos.garcia@email.com', '123456789', '$2y$12$QPMDqal8GxbXtD0Gv/3jleUij1P.LoPTgUYRmXSWrX18eRzaj5PPu'),
(2, 'Lucía', 'Fernández', 'lucia.fer@email.com', '987654321', '$2y$12$ccei03Pc7RwwUghyOzIXMuk7q05AVz/06HhnEx3jOS4YpbF5mrgoa'),
(3, 'Roberto', 'Pérez', 'roberto.p@email.com', '555444333', '$2y$12$4tXKs8mImzuN0AHlDzZNveYn2k0o4yMye5OKidfynvsJ6jctz66QW');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Administradores`
--
ALTER TABLE `Administradores`
  ADD PRIMARY KEY (`ID_Admin`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indices de la tabla `Categorias`
--
ALTER TABLE `Categorias`
  ADD PRIMARY KEY (`ID_Categoria`);

--
-- Indices de la tabla `Direccion`
--
ALTER TABLE `Direccion`
  ADD PRIMARY KEY (`ID_direccion`),
  ADD KEY `FK_Direccion_Usuario` (`ID_USUario`);

--
-- Indices de la tabla `Hombre`
--
ALTER TABLE `Hombre`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `FK_Hombre_Cat` (`ID_Categoria`);

--
-- Indices de la tabla `Mujer`
--
ALTER TABLE `Mujer`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `FK_Mujer_Cat` (`ID_Categoria`);

--
-- Indices de la tabla `Ofertas`
--
ALTER TABLE `Ofertas`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `FK_Ofertas_Cat` (`ID_Categoria`);

--
-- Indices de la tabla `Pedidos`
--
ALTER TABLE `Pedidos`
  ADD PRIMARY KEY (`ID_Pedido`),
  ADD KEY `FK_Pedidos_Usuarios` (`ID_Usuario`);

--
-- Indices de la tabla `Pedido_Detalles`
--
ALTER TABLE `Pedido_Detalles`
  ADD PRIMARY KEY (`ID_Detalle`),
  ADD KEY `FK_Detalles_Pedidos` (`ID_Pedido`);

--
-- Indices de la tabla `Usuarios`
--
ALTER TABLE `Usuarios`
  ADD PRIMARY KEY (`ID_USUario`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `Administradores`
--
ALTER TABLE `Administradores`
  MODIFY `ID_Admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `Categorias`
--
ALTER TABLE `Categorias`
  MODIFY `ID_Categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `Direccion`
--
ALTER TABLE `Direccion`
  MODIFY `ID_direccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `Hombre`
--
ALTER TABLE `Hombre`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `Mujer`
--
ALTER TABLE `Mujer`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `Ofertas`
--
ALTER TABLE `Ofertas`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `Pedidos`
--
ALTER TABLE `Pedidos`
  MODIFY `ID_Pedido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Pedido_Detalles`
--
ALTER TABLE `Pedido_Detalles`
  MODIFY `ID_Detalle` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Usuarios`
--
ALTER TABLE `Usuarios`
  MODIFY `ID_USUario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `Direccion`
--
ALTER TABLE `Direccion`
  ADD CONSTRAINT `FK_Direccion_Usuario` FOREIGN KEY (`ID_USUario`) REFERENCES `Usuarios` (`ID_USUario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Usuario_Direccion_Nueva` FOREIGN KEY (`ID_USUario`) REFERENCES `Usuarios` (`ID_USUario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Relacion_Direccion_Usuario` FOREIGN KEY (`ID_USUario`) REFERENCES `Usuarios` (`ID_USUario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Hombre`
--
ALTER TABLE `Hombre`
  ADD CONSTRAINT `FK_Hombre_Cat` FOREIGN KEY (`ID_Categoria`) REFERENCES `Categorias` (`ID_Categoria`);

--
-- Filtros para la tabla `Mujer`
--
ALTER TABLE `Mujer`
  ADD CONSTRAINT `FK_Mujer_Cat` FOREIGN KEY (`ID_Categoria`) REFERENCES `Categorias` (`ID_Categoria`);

--
-- Filtros para la tabla `Ofertas`
--
ALTER TABLE `Ofertas`
  ADD CONSTRAINT `FK_Ofertas_Cat` FOREIGN KEY (`ID_Categoria`) REFERENCES `Categorias` (`ID_Categoria`);

--
-- Filtros para la tabla `Pedidos`
--
ALTER TABLE `Pedidos`
  ADD CONSTRAINT `FK_Pedidos_Usuarios` FOREIGN KEY (`ID_Usuario`) REFERENCES `Usuarios` (`ID_USUario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Pedido_Detalles`
--
ALTER TABLE `Pedido_Detalles`
  ADD CONSTRAINT `FK_Detalles_Pedidos` FOREIGN KEY (`ID_Pedido`) REFERENCES `Pedidos` (`ID_Pedido`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
