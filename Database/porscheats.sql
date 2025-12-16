-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-12-2025 a las 12:09:10
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `porscheats`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `favoritos`
--

CREATE TABLE `favoritos` (
  `id_usuario` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `fecha_guardado` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineapedido`
--

CREATE TABLE `lineapedido` (
  `id_linea` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL DEFAULT 1,
  `precio_unidad` decimal(10,2) NOT NULL,
  `porcentaje_descuento` decimal(5,2) DEFAULT 0.00,
  `precio_final_unidad` decimal(10,2) NOT NULL,
  `subtotal` decimal(12,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logacciones`
--

CREATE TABLE `logacciones` (
  `id_log` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `accion` varchar(100) NOT NULL,
  `detalles` text DEFAULT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oferta`
--

CREATE TABLE `oferta` (
  `id_oferta` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `tipo_descuento` enum('porcentaje','fijo') NOT NULL DEFAULT 'porcentaje',
  `valor_descuento` decimal(10,2) DEFAULT NULL,
  `cantidad_minima` int(11) DEFAULT NULL,
  `activa` tinyint(1) NOT NULL DEFAULT 1,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oferta_producto`
--

CREATE TABLE `oferta_producto` (
  `id_oferta` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `porcentaje_descuento` decimal(5,2) DEFAULT 0.00,
  `precio_promocional` decimal(10,2) DEFAULT NULL,
  `fecha_asignacion` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `id_pedido` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_oferta` int(11) DEFAULT NULL,
  `fecha_pedido` datetime NOT NULL DEFAULT current_timestamp(),
  `metodo_pago` varchar(50) DEFAULT NULL,
  `direccion_entrega` varchar(255) DEFAULT NULL,
  `estado` enum('pendiente','pagado','entregado','cancelado') NOT NULL DEFAULT 'pendiente',
  `importe_total` decimal(12,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `caracteristica` varchar(255) DEFAULT NULL,
  `precio_unidad` decimal(10,2) NOT NULL,
  `categoria` varchar(80) DEFAULT NULL,
  `disponibilidad` tinyint(1) NOT NULL DEFAULT 1,
  `imagen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `nombre`, `descripcion`, `caracteristica`, `precio_unidad`, `categoria`, `disponibilidad`, `imagen`) VALUES
(1, '911 Experience – Filete con trufa negra', 'Filete premium sellado al punto con crema de trufa negra y reducción de vino tinto.', '4,1s · 290g · 394 kcal · 98% satisfacción', 167.00, 'primeros', 1, 'platos/primeros/carnetrufada.png\r\n'),
(2, '718 Essence – Tataki de Atún con Caviar', 'Tataki de atún rojo con perlas de caviar y emulsión de yuzu.', '4,5s · 210g · 312 kcal · 96% satisfacción', 142.00, 'primeros', 1, 'primeros/tataki_atun.png'),
(3, 'Macan Green – Ensalada de brotes y almendras', 'Mezcla de brotes frescos, almendras tostadas y vinagreta cítrica.', '3,2s · 180g · 185 kcal · 92% satisfacción', 58.00, 'primeros', 1, 'primeros/ensalada_brotes.png'),
(4, 'Panamera Cream – Crema de calabaza y jengibre', 'Crema suave de calabaza con jengibre fresco y aceite de oliva premium.', '4,0s · 250g · 220 kcal · 94% satisfacción', 44.00, 'primeros', 1, 'primeros/crema_calabaza.png'),
(5, 'Cayenne Fusion – Gyozas de pato glaseado', 'Gyozas rellenas de pato, lacadas en reducción de soja y miel.', '3,8s · 6 unidades · 305 kcal · 95% satisfacción', 79.00, 'primeros', 1, 'primeros/gyozas_pato.png'),
(6, 'Boxster Fire – Carpaccio de buey', 'Finas láminas de buey madurado con parmesano y aceite trufado.', '3,6s · 160g · 278 kcal · 96% satisfacción', 91.00, 'primeros', 1, 'primeros/carpaccio_buey.png'),
(7, 'Panamera Deluxe – Solomillo al Vino Tinto', 'Solomillo con champiñones franceses y láminas de oro comestible.', '4,3s · 260g · 645 kcal · 95% satisfacción', 174.00, 'segundos', 1, 'segundos/solomillo_vino.png'),
(8, 'Taycan Gold Risotto', 'Costillas de cerdo cocinadas 12 horas con reducción miel-mostaza.', '6,2s · 380g · 645 kcal · 95% satisfacción', 152.00, 'segundos', 1, 'segundos/risotto_cerdo.png'),
(9, 'Cayman Red – Magret de pato', 'Magret con salsa de frutos rojos y quinoa especiada.', '4,9s · 240g · 520 kcal · 96% satisfacción', 129.00, 'segundos', 1, 'segundos/magret_pato.png'),
(10, 'Turbo Flame – Lomo de Wagyu flambeado', 'Wagyu japonés A5 flambeado con whisky y mantequilla cítrica.', '3,7s · 280g · 790 kcal · 99% satisfacción', 310.00, 'segundos', 1, 'segundos/wagyu_flambeado.png'),
(11, 'Carrera Blue – Bacalao confitado', 'Bacalao con pilpil suave y aceite ahumado.', '4,4s · 300g · 390 kcal · 94% satisfacción', 138.00, 'segundos', 1, 'segundos/bacalao_confitado.png'),
(12, 'Speedster Grill – Costillar BBQ gourmet', 'Costillar a baja temperatura con salsa BBQ artesana.', '6,0s · 450g · 860 kcal · 97% satisfacción', 148.00, 'segundos', 1, 'segundos/costillar_bbq.png'),
(13, 'Taycan Sweet – Mousse de chocolate con oro', 'Mousse belga con oro comestible y cacao tostado.', '4,8s · 180g · 412 kcal · 99% satisfacción', 158.00, 'postres', 1, 'postres/mousse_oro.png'),
(14, '911 Turbo – Soufflé de vainilla al ron', 'Soufflé de vainilla bourbon con ron añejo.', '5,1s · 210g · 389 kcal · 98% satisfacción', 122.00, 'postres', 1, 'postres/souffle_vainilla.png'),
(15, 'Taycan Gold – Champagne de trufa blanca', 'Champagne con notas terrosas y final sedoso.', '3,9s · 150ml · 12,5% alcohol · 99% satisfacción', 220.00, 'bebidas', 1, 'postres/champagne_trufa.png'),
(16, '911 Spirit – Cóctel de ron y cítricos', 'Cóctel de ron añejo con oro líquido.', '4,2s · 180ml · 18% alcohol · 97% satisfacción', 197.00, 'bebidas', 1, 'postres/cocktail_ron.png'),
(17, 'Carrera Frost – Helado artesanal de vainilla negra', 'Vainilla negra con crumble de chocolate.', '3,2s · 160g · 285 kcal · 95% satisfacción', 42.00, 'postres', 1, 'postres/helado_vainilla.png'),
(18, 'Macan Cloud – Tiramisú cremoso', 'Tiramisú con cacao premium y crema ligera.', '4,1s · 200g · 470 kcal · 96% satisfacción', 55.00, 'postres', 1, 'postres/tiramisu.png'),
(19, 'Cayenne Velvet – Cheesecake de frutos rojos', 'Cheesecake horneado con frutos rojos frescos.', '4,6s · 220g · 510 kcal · 97% satisfacción', 61.00, 'postres', 1, 'postres/cheesecake.png'),
(20, 'Panamera Dark – Brownie caliente', 'Brownie fundente con nueces tostadas.', '3,7s · 180g · 540 kcal · 98% satisfacción', 49.00, 'postres', 1, 'postres/brownie.png'),
(21, 'Boxster Citrus – Mousse de limón y jengibre', 'Mousse ligera con notas cítricas.', '3,8s · 170g · 290 kcal · 94% satisfacción', 52.00, 'postres', 1, 'postres/mousse_limon.png'),
(22, 'Spyder Cream – Crème brûlée clásica', 'Vainilla fresca y caramelización perfecta.', '4,0s · 190g · 320 kcal · 97% satisfacción', 64.00, 'postres', 1, 'postres/creme_brulee.png'),
(23, 'Turbo Boost – Espresso doble', 'Café de origen etíope con tostado intenso.', '2,1s · 60ml · 0 kcal · 98% satisfacción', 12.00, 'bebidas', 1, 'bebidas/espresso.png'),
(24, 'Panamera White – Latte cremosa', 'Café suave con leche vaporizada.', '2,5s · 300ml · 160 kcal · 94% satisfacción', 15.00, 'bebidas', 1, 'bebidas/latte.png'),
(25, 'Cayenne Fire – Infusión de jengibre', 'Infusión caliente con limón y jengibre fresco.', '3,1s · 250ml · 22 kcal · 96% satisfacción', 14.00, 'bebidas', 1, 'bebidas/infusion_jengibre.png'),
(26, 'Boxster Ice – Limonada premium', 'Limonada artesanal con hierbabuena.', '1,9s · 330ml · 110 kcal · 95% satisfacción', 10.00, 'bebidas', 1, 'bebidas/limonada.png'),
(27, 'Macan Fresh – Agua mineral', 'Agua natural de manantial.', '1,0s · 500ml · 0 kcal · 97% satisfacción', 4.00, 'bebidas', 1, 'bebidas/agua.png'),
(28, 'GT3 Punch – Mocktail tropical', 'Cítricos y frutas tropicales sin alcohol.', '2,8s · 300ml · 140 kcal · 96% satisfacción', 18.00, 'bebidas', 1, 'bebidas/mocktail.png'),
(29, 'Turbo Red – Vino tinto reserva', 'Vino de crianza con notas especiadas.', '3,5s · 150ml · 14% alcohol · 96% satisfacción', 22.00, 'bebidas', 1, 'bebidas/vino_tinto.png'),
(30, 'Carrera Gold – Cerveza artesanal', 'Cerveza rubia premium.', '2,2s · 330ml · 120 kcal · 92% satisfacción', 11.00, 'bebidas', 1, 'bebidas/cerveza.png'),
(31, 'Cayman Chocolate Sphere', 'Delicada esfera de chocolate oscuro con corazón fundente, servida sobre base crujiente y acompañada de helado artesanal de vainilla bourbon. Un contraste preciso entre temperatura y textura inspirado en el Porsche Cayman.', '3,5 s · 165 g · 510 kcal · 97% satisfacción', 47.00, 'Postres', 1, NULL),
(32, 'Porsche 911 Vanilla Precision', 'Mousse de vainilla natural de textura sedosa sobre crumble crujiente de mantequilla', '3,2 s · 150 g · 460 kcal · 96% satisfacción', 45.00, 'Postres', 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellidos` varchar(100) DEFAULT NULL,
  `telefono` varchar(25) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `email` varchar(150) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `rol` enum('cliente','admin') NOT NULL DEFAULT 'cliente',
  `fecha_registro` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre`, `apellidos`, `telefono`, `direccion`, `email`, `contrasena`, `rol`, `fecha_registro`) VALUES
(1, 'Polba', 'balaguer', '617892989', 'Papiol', 'polba@gmail.com', '$2y$10$PefbcOkrBH8a20XRoPJiIunHWb20/cPfTly27WUtowNwZQtXTVpMu', 'cliente', '2025-12-10 20:38:35'),
(6, 'Joao', '', '', '', 'joao@gmail.com', '$2y$10$L5RmthuH1MyTjxep46jWie1LgvWdVXAsauSvTb3fXoHeHbkAvF9w6', '', '2025-12-10 20:46:14'),
(7, 'koko', '', '', '', 'koko@gmail.com', '$2y$10$69P2zCIXt3GMY4Y2Ae6YsedTtDzN76FQge4ZjEhrvp22grZN7i3eO', '', '2025-12-11 15:40:28'),
(8, 'prueba', '', '', '', 'prueba@gmail.com', '$2y$10$tsnHyye0McF60TnKhUnUu.mt1XG7Z6a4szvuF/ycU02k52eQyJHw.', 'cliente', '2025-12-11 15:48:46'),
(14, 'joao', '', '', '', 'joaoinho@gmail.com', '$2y$10$/n8zml.edw.4LEoWyaAR7.xGwa9LLMtHBh8bXCkcFAC6dmZpRUm8K', 'cliente', '2025-12-11 17:40:13'),
(15, 'Admin', NULL, NULL, NULL, 'admin@gmail.com', '$2y$10$abcdefghijklmnopqrstuv', 'admin', '2025-12-16 12:08:09');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `favoritos`
--
ALTER TABLE `favoritos`
  ADD PRIMARY KEY (`id_usuario`,`id_producto`),
  ADD KEY `fk_favoritos_producto` (`id_producto`);

--
-- Indices de la tabla `lineapedido`
--
ALTER TABLE `lineapedido`
  ADD PRIMARY KEY (`id_linea`),
  ADD KEY `fk_linea_pedido` (`id_pedido`),
  ADD KEY `fk_linea_producto` (`id_producto`);

--
-- Indices de la tabla `logacciones`
--
ALTER TABLE `logacciones`
  ADD PRIMARY KEY (`id_log`),
  ADD KEY `fk_log_usuario` (`id_usuario`);

--
-- Indices de la tabla `oferta`
--
ALTER TABLE `oferta`
  ADD PRIMARY KEY (`id_oferta`);

--
-- Indices de la tabla `oferta_producto`
--
ALTER TABLE `oferta_producto`
  ADD PRIMARY KEY (`id_oferta`,`id_producto`),
  ADD KEY `fk_oferta_producto_producto` (`id_producto`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `fk_pedido_usuario` (`id_usuario`),
  ADD KEY `fk_pedido_oferta` (`id_oferta`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `lineapedido`
--
ALTER TABLE `lineapedido`
  MODIFY `id_linea` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `logacciones`
--
ALTER TABLE `logacciones`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `oferta`
--
ALTER TABLE `oferta`
  MODIFY `id_oferta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `favoritos`
--
ALTER TABLE `favoritos`
  ADD CONSTRAINT `fk_favoritos_producto` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_favoritos_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE;

--
-- Filtros para la tabla `lineapedido`
--
ALTER TABLE `lineapedido`
  ADD CONSTRAINT `fk_linea_pedido` FOREIGN KEY (`id_pedido`) REFERENCES `pedido` (`id_pedido`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_linea_producto` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`) ON DELETE CASCADE;

--
-- Filtros para la tabla `logacciones`
--
ALTER TABLE `logacciones`
  ADD CONSTRAINT `fk_log_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE;

--
-- Filtros para la tabla `oferta_producto`
--
ALTER TABLE `oferta_producto`
  ADD CONSTRAINT `fk_oferta_producto_oferta` FOREIGN KEY (`id_oferta`) REFERENCES `oferta` (`id_oferta`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_oferta_producto_producto` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`) ON DELETE CASCADE;

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `fk_pedido_oferta` FOREIGN KEY (`id_oferta`) REFERENCES `oferta` (`id_oferta`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_pedido_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
