-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-06-2021 a las 22:54:28
-- Versión del servidor: 10.4.19-MariaDB
-- Versión de PHP: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tol`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `categoria_id` int(10) NOT NULL COMMENT 'Campo Auto incrementado',
  `categoria_nombre` varchar(50) COLLATE utf8_spanish2_ci NOT NULL COMMENT 'Nombre que se asigna a la cotegoria',
  `categoria_descripcion` text COLLATE utf8_spanish2_ci NOT NULL COMMENT 'Breve descripción de la categoria',
  `categoria_estado` varchar(20) COLLATE utf8_spanish2_ci NOT NULL COMMENT 'Disponibilidad de la categoria: Habilitada o Inhabilitada'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci COMMENT='En esta tabla se almacena los datos de la categorias que tendrán los productos';

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`categoria_id`, `categoria_nombre`, `categoria_descripcion`, `categoria_estado`) VALUES
(1, 'Tecnología', 'Toda la tecnología', 'Habilitada'),
(2, 'Audio', 'Todo Tipo de Audio', 'Habilitada'),
(3, 'Video', 'Todo lo de video', 'Habilitada'),
(4, 'Ropa', 'Todo con respecto a ropa', 'Habilitada'),
(5, 'Zapatos', 'Todo tipo de Zapatos', 'Habilitada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `cliente_id` int(10) NOT NULL COMMENT 'Campo Autoincrementado',
  `cliente_nombre` varchar(37) COLLATE utf8_spanish2_ci NOT NULL COMMENT 'Primer y Segundo Nombre del Cliente',
  `cliente_apellido` varchar(37) COLLATE utf8_spanish2_ci NOT NULL COMMENT 'Apellidos del Cliente',
  `cliente_genero` varchar(10) COLLATE utf8_spanish2_ci NOT NULL COMMENT 'Genero: Masculino y Femenino',
  `cliente_telefono` varchar(22) COLLATE utf8_spanish2_ci NOT NULL COMMENT 'Teléfono o Celular del Cliente',
  `cliente_municipio` varchar(30) COLLATE utf8_spanish2_ci NOT NULL COMMENT 'Municipio donde reside el cliente',
  `cliente_departamento` varchar(30) COLLATE utf8_spanish2_ci NOT NULL COMMENT 'Departamento donde reside el cliente',
  `cliente_direccion` varchar(70) COLLATE utf8_spanish2_ci NOT NULL COMMENT 'Dirección completa del cliente',
  `cliente_email` varchar(50) COLLATE utf8_spanish2_ci NOT NULL COMMENT 'correo electrónico del cliente',
  `cliente_clave` varchar(535) COLLATE utf8_spanish2_ci NOT NULL COMMENT 'clave encriptada del cliente',
  `cliente_foto` varchar(200) COLLATE utf8_spanish2_ci NOT NULL COMMENT 'fotografía o avatar del cliente',
  `cliente_cuenta_estado` varchar(17) COLLATE utf8_spanish2_ci NOT NULL COMMENT 'Estado de la cuenta del cliente Activa o Deshabilitada',
  `cliente_cuenta_verificada` varchar(17) COLLATE utf8_spanish2_ci NOT NULL COMMENT 'Cuenta verificada o no verificada'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`cliente_id`, `cliente_nombre`, `cliente_apellido`, `cliente_genero`, `cliente_telefono`, `cliente_municipio`, `cliente_departamento`, `cliente_direccion`, `cliente_email`, `cliente_clave`, `cliente_foto`, `cliente_cuenta_estado`, `cliente_cuenta_verificada`) VALUES
(1, 'Ricardo', 'Herrera', 'Masculino', '22223456', 'Santa Tecla', 'Santa Tecla', 'Residencial San Rafael', 'hlopez.ricardo@gmail.com', 'dDdwMXhPVS9wNDZuUHlKUVdMdnBXQT09', 'Avatar_default_male.png', 'Activa', 'No verificada'),
(2, 'Enrique', 'Lopez', 'Masculino', '77777777', 'San Salvador', 'San Salvador', 'Senda J', 'ricardo.enrique@gmail.com', 'T1ZyUXBYZnRjWW56RXVvZ09UZDRBQT09', 'Avatar_default_male.png', 'Activa', 'Verificada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `empresa_id` int(3) NOT NULL COMMENT 'Campo de Autoincremento',
  `empresa_tipo_documento` varchar(20) COLLATE utf8_spanish2_ci NOT NULL COMMENT 'Documento de respaldo para persona natural o jurídica',
  `empresa_numero_documento` varchar(35) COLLATE utf8_spanish2_ci NOT NULL COMMENT 'Número de documento de respaldo',
  `empresa_nombre` varchar(90) COLLATE utf8_spanish2_ci NOT NULL COMMENT 'Nombre de la Empresa',
  `empresa_telefono` varchar(20) COLLATE utf8_spanish2_ci NOT NULL COMMENT 'Teléfono o Celular de la empresa',
  `empresa_email` varchar(50) COLLATE utf8_spanish2_ci NOT NULL COMMENT 'correo electrónico de la empresa',
  `empresa_direccion` varchar(100) COLLATE utf8_spanish2_ci NOT NULL COMMENT 'Dirección Completa de la empresa',
  `empresa_logo` varchar(100) COLLATE utf8_spanish2_ci NOT NULL COMMENT 'Logotipo de la Empresa',
  `empresa_cuenta` int(50) NOT NULL COMMENT 'Cuenta bancaria de la empresa',
  `empresa_banco` varchar(100) COLLATE utf8_spanish2_ci NOT NULL COMMENT 'Nombre de la institución bancaria',
  `empresa_liquidacion` varchar(100) COLLATE utf8_spanish2_ci NOT NULL COMMENT 'Período de Liquidación de la empresa',
  `empresa_documento` varchar(100) COLLATE utf8_spanish2_ci NOT NULL COMMENT 'Documento legal de la empresa',
  `empresa_impuesto_nombre` varchar(10) COLLATE utf8_spanish2_ci NOT NULL COMMENT 'Nombre del tipo de impuesto',
  `empresa_impuesto_porcentaje` int(3) NOT NULL COMMENT 'Porcentaje del impuesto',
  `empresa_factura_impuestos` varchar(3) COLLATE utf8_spanish2_ci NOT NULL COMMENT 'Si el impuesto se presentara en la factura. Si o No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`empresa_id`, `empresa_tipo_documento`, `empresa_numero_documento`, `empresa_nombre`, `empresa_telefono`, `empresa_email`, `empresa_direccion`, `empresa_logo`, `empresa_cuenta`, `empresa_banco`, `empresa_liquidacion`, `empresa_documento`, `empresa_impuesto_nombre`, `empresa_impuesto_porcentaje`, `empresa_factura_impuestos`) VALUES
(1, 'NCR', '79234', 'ITS', '77777777', 'itsconsultoressv@gmail.com', 'Residencial San Rafael Senda 4 Sur', '', 12345678, 'Banco de Credito ', 'Del 25 al 30 de cada mes', '', 'iva', 13, 'Si');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `favorito`
--

CREATE TABLE `favorito` (
  `favorito_id` int(15) NOT NULL COMMENT 'Campo de Autoincremento',
  `favorito_fecha` date NOT NULL COMMENT 'Fecha de registro del producto favorito',
  `cliente_id` int(10) NOT NULL COMMENT 'Llave cliente',
  `producto_id` int(20) NOT NULL COMMENT 'Llave producto'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `producto_id` int(20) NOT NULL COMMENT 'Campo de Autoincremento',
  `producto_codigo` varchar(50) COLLATE utf8_spanish2_ci NOT NULL COMMENT 'Código de control del producto',
  `producto_sku` varchar(50) COLLATE utf8_spanish2_ci NOT NULL COMMENT 'Codigo estandar para el control del producto',
  `producto_nombre` varchar(200) COLLATE utf8_spanish2_ci NOT NULL COMMENT 'Nombre del producto',
  `producto_descripcion` varchar(535) COLLATE utf8_spanish2_ci NOT NULL COMMENT 'Descripción del producto',
  `producto_stock` int(10) NOT NULL COMMENT 'Cantidad de productos disponibles',
  `producto_precio_venta` decimal(30,2) NOT NULL COMMENT 'Precio de venta al cliente',
  `producto_tipo` varchar(10) COLLATE utf8_spanish2_ci NOT NULL COMMENT 'Clasificación de producto',
  `producto_presentacion` varchar(30) COLLATE utf8_spanish2_ci NOT NULL COMMENT 'Unidades por producto',
  `producto_marca` varchar(50) COLLATE utf8_spanish2_ci NOT NULL COMMENT 'Nombre de la marca del producto',
  `producto_modelo` varchar(70) COLLATE utf8_spanish2_ci NOT NULL COMMENT 'Nombre del modelo del producto',
  `producto_estado` varchar(20) COLLATE utf8_spanish2_ci NOT NULL COMMENT 'Estado del producto:Activo o Inactivo',
  `producto_portada` varchar(300) COLLATE utf8_spanish2_ci NOT NULL COMMENT 'Imagen del producto',
  `categoria_id` int(10) NOT NULL COMMENT 'Id de la tabla de categoría '
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`producto_id`, `producto_codigo`, `producto_sku`, `producto_nombre`, `producto_descripcion`, `producto_stock`, `producto_precio_venta`, `producto_tipo`, `producto_presentacion`, `producto_marca`, `producto_modelo`, `producto_estado`, `producto_portada`, `categoria_id`) VALUES
(6, 'sfsdfs', '3123dsfsd', 'Smart reloj', 'fdsfdsf', 2, '3.99', '', '', '', '', 'Activo', '', 1),
(7, 'TV001', 'sdfdseweq', 'TV SMART', 'fsdfsfds', 2, '23.00', '', '', '', '', 'Activo', 'smart.jpg', 2),
(9, 'CL001', 'dfsdl2032', 'Celular Samsung', 'Esto es una descripción del producto', 7, '120.00', '', '', '', '', 'Activo', 'celular.jpg', 1),
(10, 'TC001', 'sdsad1231', 'Teclado', 'Teclado Estándar con conector USB', 4, '10.99', '', '', '', '', 'Activo', 'teclado.jpg', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `usuario_id` int(10) NOT NULL COMMENT 'Campo de Autoincremento',
  `usuario_nombre` varchar(37) COLLATE utf8_spanish2_ci NOT NULL COMMENT 'Nombre de usuario del Sistema',
  `usuario_apellido` varchar(37) COLLATE utf8_spanish2_ci NOT NULL COMMENT 'Apellido del usuario del sistema',
  `usuario_telefono` varchar(22) COLLATE utf8_spanish2_ci NOT NULL COMMENT 'Teléfono del usuario del sistema ',
  `usuario_genero` varchar(10) COLLATE utf8_spanish2_ci NOT NULL COMMENT 'Genero del usuario:Masculino o Femenino',
  `usuario_cargo` varchar(20) COLLATE utf8_spanish2_ci NOT NULL COMMENT 'Cargo del usuario ejm Administrador',
  `usuario_usuario` varchar(30) COLLATE utf8_spanish2_ci NOT NULL COMMENT 'Tipo de usuario',
  `usuario_email` varchar(50) COLLATE utf8_spanish2_ci NOT NULL COMMENT 'correo electrónico  del usuario del sistema',
  `usuario_clave` varchar(535) COLLATE utf8_spanish2_ci NOT NULL COMMENT 'Contraseña del usuario del sistema',
  `usuario_cuenta_estado` varchar(17) COLLATE utf8_spanish2_ci NOT NULL COMMENT 'Estado: Habilitado o Deshabilitado',
  `usuario_foto` varchar(200) COLLATE utf8_spanish2_ci NOT NULL COMMENT 'Imagen o Avatar del usuario del sistema'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`usuario_id`, `usuario_nombre`, `usuario_apellido`, `usuario_telefono`, `usuario_genero`, `usuario_cargo`, `usuario_usuario`, `usuario_email`, `usuario_clave`, `usuario_cuenta_estado`, `usuario_foto`) VALUES
(1, 'Administrador', 'Principal', '00000000', 'Masculino', 'Administrador', 'Administrador', 'admin@admin.com', 'K1hvdkhOR2hvQ1pzK2V1STJPaGlwQT09', 'Activa', 'Avatar_Male_2.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `venta_id` int(20) NOT NULL COMMENT 'Campo de Autoincremento',
  `venta_codigo` varchar(200) COLLATE utf8_spanish2_ci NOT NULL COMMENT 'Codigo de identificación de ventas',
  `venta_fecha` date NOT NULL COMMENT 'Fecha de la venta',
  `venta_hora` varchar(17) COLLATE utf8_spanish2_ci NOT NULL COMMENT 'Hora de la venta',
  `venta_estado` varchar(50) COLLATE utf8_spanish2_ci NOT NULL COMMENT 'Estado de la venta: realizada o pendiente',
  `venta_impuesto_nombre` varchar(10) COLLATE utf8_spanish2_ci NOT NULL COMMENT 'Nombre del impuesto',
  `venta_impuesto_porcentaje` int(3) NOT NULL COMMENT 'Porcentaje del impuesto',
  `venta_subtotal` decimal(30,2) NOT NULL COMMENT 'Subtotal de la venta',
  `venta_impuestos` decimal(30,2) NOT NULL COMMENT 'Valor del impuesto',
  `venta_total` decimal(30,2) NOT NULL COMMENT 'Total de venta',
  `venta_utilidad` decimal(30,2) NOT NULL COMMENT 'Cobro de utilidad por venta',
  `cliente_id` int(10) NOT NULL COMMENT 'Id de cliente',
  `usuario_id` int(10) NOT NULL COMMENT 'Id de Usuario',
  `empresa_id` int(3) NOT NULL COMMENT 'Id de Empresa'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`venta_id`, `venta_codigo`, `venta_fecha`, `venta_hora`, `venta_estado`, `venta_impuesto_nombre`, `venta_impuesto_porcentaje`, `venta_subtotal`, `venta_impuestos`, `venta_total`, `venta_utilidad`, `cliente_id`, `usuario_id`, `empresa_id`) VALUES
(1, '0000001', '2021-06-14', '16:00', 'pendiente', 'iva', 13, '100.00', '13.00', '113.00', '5.00', 1, 1, 1),
(3, '000001', '2021-06-14', '16:00', 'pendiente', 'iva', 13, '100.00', '13.00', '113.00', '5.00', 1, 1, 1),
(5, '000002', '2021-06-14', '14:00', 'pendiente', 'iva', 13, '200.00', '26.00', '226.00', '10.00', 2, 1, 1),
(6, '000003', '2021-06-14', '15:00', 'realizada', 'iva', 13, '300.00', '39.00', '339.00', '15.00', 2, 1, 1),
(7, '000004', '2021-06-14', '17:00', 'realizada', 'iva', 13, '300.00', '39.00', '339.00', '15.00', 2, 1, 1),
(8, '000005', '2021-06-14', '17:00', 'realizada', 'iva', 13, '300.00', '39.00', '339.00', '15.00', 2, 1, 1),
(9, '000006', '2021-06-15', '17:00', 'realizada', 'iva', 13, '100.00', '13.00', '113.00', '5.00', 2, 1, 1),
(10, '000007', '2021-06-13', '17:00', 'pendiente', 'iva', 13, '100.00', '13.00', '113.00', '5.00', 2, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta_detalle`
--

CREATE TABLE `venta_detalle` (
  `venta_detalle_id` int(20) NOT NULL,
  `venta_detalle_cantidad` int(10) NOT NULL,
  `venta_detalle_precio_venta` decimal(30,2) NOT NULL,
  `venta_detalle_total` decimal(30,2) NOT NULL,
  `venta_detalle_utilidad` decimal(30,2) NOT NULL,
  `venta_detalle_descripcion` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `venta_codigo` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `producto_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `venta_detalle`
--

INSERT INTO `venta_detalle` (`venta_detalle_id`, `venta_detalle_cantidad`, `venta_detalle_precio_venta`, `venta_detalle_total`, `venta_detalle_utilidad`, `venta_detalle_descripcion`, `venta_codigo`, `producto_id`) VALUES
(0, 2, '30.00', '60.00', '3.00', '', '000001', 9),
(0, 2, '20.00', '40.00', '2.00', '', '000001', 10);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`categoria_id`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`cliente_id`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`empresa_id`);

--
-- Indices de la tabla `favorito`
--
ALTER TABLE `favorito`
  ADD PRIMARY KEY (`favorito_id`),
  ADD KEY `cliente_id` (`cliente_id`),
  ADD KEY `producto_id` (`producto_id`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`producto_id`),
  ADD KEY `categoria_id` (`categoria_id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usuario_id`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`venta_id`),
  ADD UNIQUE KEY `venta_codigo` (`venta_codigo`),
  ADD KEY `cliente_id` (`cliente_id`),
  ADD KEY `empresa_id` (`empresa_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `venta_detalle`
--
ALTER TABLE `venta_detalle`
  ADD KEY `venta_codigo` (`venta_codigo`),
  ADD KEY `producto_id` (`producto_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `categoria_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Campo Auto incrementado', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `cliente_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Campo Autoincrementado', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `empresa_id` int(3) NOT NULL AUTO_INCREMENT COMMENT 'Campo de Autoincremento', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `favorito`
--
ALTER TABLE `favorito`
  MODIFY `favorito_id` int(15) NOT NULL AUTO_INCREMENT COMMENT 'Campo de Autoincremento';

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `producto_id` int(20) NOT NULL AUTO_INCREMENT COMMENT 'Campo de Autoincremento', AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usuario_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Campo de Autoincremento', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `venta_id` int(20) NOT NULL AUTO_INCREMENT COMMENT 'Campo de Autoincremento', AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `favorito`
--
ALTER TABLE `favorito`
  ADD CONSTRAINT `favorito_ibfk_1` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`producto_id`),
  ADD CONSTRAINT `favorito_ibfk_2` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`cliente_id`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`categoria_id`);

--
-- Filtros para la tabla `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `venta_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`cliente_id`),
  ADD CONSTRAINT `venta_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`usuario_id`),
  ADD CONSTRAINT `venta_ibfk_3` FOREIGN KEY (`empresa_id`) REFERENCES `empresa` (`empresa_id`);

--
-- Filtros para la tabla `venta_detalle`
--
ALTER TABLE `venta_detalle`
  ADD CONSTRAINT `venta_detalle_ibfk_1` FOREIGN KEY (`venta_codigo`) REFERENCES `venta` (`venta_codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `venta_detalle_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`producto_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
