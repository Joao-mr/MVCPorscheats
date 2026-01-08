-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-01-2026 a las 18:52:34
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

--
-- Volcado de datos para la tabla `lineapedido`
--

INSERT INTO `lineapedido` (`id_linea`, `id_pedido`, `id_producto`, `cantidad`, `precio_unidad`, `porcentaje_descuento`, `precio_final_unidad`, `subtotal`) VALUES
(4, 4, 1, 2, 167.00, 0.00, 167.00, 334.00),
(5, 4, 2, 1, 142.00, 0.00, 142.00, 142.00),
(6, 4, 3, 1, 58.00, 0.00, 58.00, 58.00),
(7, 4, 7, 1, 174.00, 0.00, 174.00, 174.00),
(8, 4, 10, 1, 310.00, 0.00, 310.00, 310.00),
(9, 4, 13, 1, 158.00, 0.00, 158.00, 158.00),
(10, 4, 24, 1, 15.00, 0.00, 15.00, 15.00),
(11, 5, 2, 1, 142.00, 0.00, 142.00, 142.00),
(12, 5, 8, 1, 152.00, 0.00, 152.00, 152.00),
(13, 5, 14, 1, 122.00, 0.00, 122.00, 122.00),
(14, 5, 16, 1, 197.00, 0.00, 197.00, 197.00),
(15, 6, 3, 1, 58.00, 0.00, 58.00, 58.00),
(16, 6, 2, 1, 142.00, 0.00, 142.00, 142.00),
(17, 7, 3, 1, 58.00, 0.00, 58.00, 58.00),
(18, 7, 2, 1, 142.00, 0.00, 142.00, 142.00),
(19, 8, 3, 1, 58.00, 0.00, 58.00, 58.00),
(20, 8, 2, 1, 142.00, 0.00, 142.00, 142.00),
(21, 9, 3, 1, 58.00, 0.00, 58.00, 58.00),
(22, 9, 2, 1, 142.00, 0.00, 142.00, 142.00),
(23, 10, 3, 1, 58.00, 0.00, 58.00, 58.00),
(24, 10, 2, 1, 142.00, 0.00, 142.00, 142.00),
(25, 10, 1, 1, 167.00, 0.00, 167.00, 167.00),
(26, 11, 3, 1, 58.00, 0.00, 58.00, 58.00),
(27, 11, 2, 1, 142.00, 0.00, 142.00, 142.00),
(28, 11, 1, 1, 167.00, 0.00, 167.00, 167.00),
(29, 12, 3, 1, 58.00, 0.00, 58.00, 58.00),
(30, 12, 2, 2, 142.00, 0.00, 142.00, 284.00),
(31, 12, 1, 1, 167.00, 0.00, 167.00, 167.00),
(32, 13, 136, 1, 335.00, 0.00, 335.00, 335.00),
(33, 14, 136, 1, 335.00, 0.00, 335.00, 335.00),
(34, 15, 1, 1, 167.00, 0.00, 167.00, 167.00),
(35, 15, 7, 1, 174.00, 0.00, 174.00, 174.00),
(36, 15, 13, 1, 158.00, 0.00, 158.00, 158.00),
(37, 15, 14, 1, 122.00, 0.00, 122.00, 122.00),
(38, 16, 4, 1, 44.00, 0.00, 44.00, 44.00),
(39, 16, 12, 1, 148.00, 0.00, 148.00, 148.00),
(40, 16, 19, 1, 61.00, 0.00, 61.00, 61.00),
(41, 17, 4, 1, 44.00, 0.00, 44.00, 44.00),
(42, 17, 12, 1, 148.00, 0.00, 148.00, 148.00),
(43, 17, 19, 1, 61.00, 0.00, 61.00, 61.00),
(44, 18, 1, 1, 167.00, 0.00, 167.00, 167.00),
(45, 18, 2, 1, 142.00, 0.00, 142.00, 142.00),
(46, 18, 3, 1, 58.00, 0.00, 58.00, 58.00),
(47, 19, 2, 1, 142.00, 0.00, 142.00, 142.00),
(48, 19, 3, 1, 58.00, 0.00, 58.00, 58.00),
(49, 19, 5, 1, 79.00, 0.00, 79.00, 79.00),
(50, 20, 2, 1, 142.00, 0.00, 142.00, 142.00),
(51, 20, 3, 1, 58.00, 0.00, 58.00, 58.00),
(52, 20, 5, 1, 79.00, 0.00, 79.00, 79.00),
(53, 21, 2, 2, 142.00, 0.00, 142.00, 284.00),
(54, 21, 3, 1, 58.00, 0.00, 58.00, 58.00),
(55, 21, 5, 1, 79.00, 0.00, 79.00, 79.00),
(56, 21, 1, 1, 167.00, 0.00, 167.00, 167.00),
(57, 22, 2, 2, 142.00, 0.00, 142.00, 284.00),
(58, 22, 3, 1, 58.00, 0.00, 58.00, 58.00),
(59, 22, 5, 1, 79.00, 0.00, 79.00, 79.00),
(60, 22, 1, 1, 167.00, 0.00, 167.00, 167.00),
(61, 23, 30, 1, 11.00, 0.00, 11.00, 11.00),
(62, 23, 29, 1, 22.00, 0.00, 22.00, 22.00),
(63, 23, 28, 1, 18.00, 0.00, 18.00, 18.00),
(64, 24, 1, 1, 167.00, 0.00, 167.00, 167.00),
(65, 24, 2, 1, 142.00, 0.00, 142.00, 142.00),
(66, 24, 3, 1, 58.00, 0.00, 58.00, 58.00),
(67, 24, 6, 1, 91.00, 0.00, 91.00, 91.00),
(68, 24, 5, 1, 79.00, 0.00, 79.00, 79.00),
(69, 24, 4, 1, 44.00, 0.00, 44.00, 44.00),
(70, 25, 1, 1, 167.00, 0.00, 167.00, 167.00),
(71, 25, 2, 1, 142.00, 0.00, 142.00, 142.00),
(72, 25, 3, 1, 58.00, 0.00, 58.00, 58.00),
(73, 25, 6, 1, 91.00, 0.00, 91.00, 91.00),
(74, 25, 5, 1, 79.00, 0.00, 79.00, 79.00),
(75, 25, 4, 1, 44.00, 0.00, 44.00, 44.00),
(76, 26, 1, 1, 167.00, 0.00, 167.00, 167.00),
(77, 26, 2, 1, 142.00, 0.00, 142.00, 142.00),
(78, 27, 1, 1, 167.00, 0.00, 167.00, 167.00),
(79, 27, 2, 1, 142.00, 0.00, 142.00, 142.00),
(80, 27, 6, 1, 91.00, 0.00, 91.00, 91.00),
(81, 28, 1, 1, 167.00, 0.00, 167.00, 167.00),
(82, 28, 2, 1, 142.00, 0.00, 142.00, 142.00),
(83, 28, 6, 1, 91.00, 0.00, 91.00, 91.00),
(84, 29, 1, 4, 167.00, 0.00, 167.00, 668.00),
(95, 35, 136, 1, 335.00, 0.00, 335.00, 335.00),
(96, 35, 12, 1, 148.00, 0.00, 148.00, 148.00),
(97, 35, 10, 1, 310.00, 0.00, 310.00, 310.00),
(98, 36, 12, 1, 148.00, 0.00, 148.00, 148.00),
(99, 36, 11, 1, 138.00, 0.00, 138.00, 138.00),
(100, 37, 6, 2, 91.00, 0.00, 91.00, 182.00);

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

--
-- Volcado de datos para la tabla `oferta`
--

INSERT INTO `oferta` (`id_oferta`, `nombre`, `descripcion`, `tipo_descuento`, `valor_descuento`, `cantidad_minima`, `activa`, `fecha_inicio`, `fecha_fin`) VALUES
(1, 'Pack 3 platos', '10% a partir de 3 productos', 'porcentaje', 10.00, 3, 1, '2026-01-07', NULL);

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

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`id_pedido`, `id_usuario`, `id_oferta`, `fecha_pedido`, `metodo_pago`, `direccion_entrega`, `estado`, `importe_total`) VALUES
(1, 8, NULL, '2026-01-04 12:56:50', 'tarjeta', 'Por definir', 'pendiente', 167.00),
(2, 8, NULL, '2026-01-04 12:56:55', 'tarjeta', 'Por definir', 'pendiente', 167.00),
(3, 8, NULL, '2026-01-04 12:57:53', 'tarjeta', 'Por definir', 'pendiente', 167.00),
(4, 8, NULL, '2026-01-04 13:01:45', 'tarjeta', 'Por definir', 'pendiente', 1191.00),
(5, 8, NULL, '2026-01-04 13:07:02', 'tarjeta', 'Por definir', 'pendiente', 613.00),
(6, 8, NULL, '2026-01-04 13:08:24', 'tarjeta', 'Por definir', 'pendiente', 200.00),
(7, 8, NULL, '2026-01-04 13:13:42', 'tarjeta', 'Por definir', 'pendiente', 200.00),
(8, 8, NULL, '2026-01-04 13:14:29', 'tarjeta', 'Por definir', 'pendiente', 200.00),
(9, 8, NULL, '2026-01-04 13:16:41', 'tarjeta', 'Por definir', 'pendiente', 200.00),
(10, 8, NULL, '2026-01-04 13:18:56', 'tarjeta', 'Por definir', 'pendiente', 367.00),
(11, 8, NULL, '2026-01-04 13:32:55', 'tarjeta', 'Por definir', 'pendiente', 367.00),
(12, 8, NULL, '2026-01-04 13:33:16', 'tarjeta', 'Por definir', 'pendiente', 509.00),
(13, 8, NULL, '2026-01-05 12:17:36', 'tarjeta', 'Por definir', 'pendiente', 335.00),
(14, 8, NULL, '2026-01-05 12:41:33', 'tarjeta', 'Por definir', 'pendiente', 335.00),
(15, 8, NULL, '2026-01-05 13:35:15', 'tarjeta', 'Por definir', 'pendiente', 621.00),
(16, 15, NULL, '2026-01-05 13:45:47', 'tarjeta', 'Por definir', 'pendiente', 253.00),
(17, 15, NULL, '2026-01-05 13:46:35', 'tarjeta', 'Por definir', 'pendiente', 253.00),
(18, 15, NULL, '2026-01-05 13:51:47', 'tarjeta', 'Por definir', 'pendiente', 367.00),
(19, 8, NULL, '2026-01-05 14:12:31', 'tarjeta', 'Por definir', 'pendiente', 279.00),
(20, 8, NULL, '2026-01-05 14:14:11', 'tarjeta', 'Por definir', 'pendiente', 279.00),
(21, 8, NULL, '2026-01-05 14:22:30', 'tarjeta', 'Por definir', 'pendiente', 588.00),
(22, 8, NULL, '2026-01-05 14:22:46', 'tarjeta', 'Por definir', 'pendiente', 588.00),
(23, 8, NULL, '2026-01-05 14:28:00', 'tarjeta', 'Por definir', 'pendiente', 51.00),
(24, 8, NULL, '2026-01-05 14:43:24', 'tarjeta', 'Por definir', 'pendiente', 581.00),
(25, 8, NULL, '2026-01-05 14:45:36', 'tarjeta', 'Por definir', 'pendiente', 581.00),
(26, 8, NULL, '2026-01-05 14:47:42', 'tarjeta', 'Por definir', 'pendiente', 309.00),
(27, 8, NULL, '2026-01-06 11:58:07', 'tarjeta', 'Por definir', 'pendiente', 400.00),
(28, 8, NULL, '2026-01-06 12:07:12', 'tarjeta', 'Por definir', 'pendiente', 400.00),
(29, 1, NULL, '2026-01-06 12:13:29', 'tarjeta', 'Por definir', 'pendiente', 668.00),
(30, 15, NULL, '2026-01-07 00:47:14', 'tarjeta', 'Por definir', 'pagado', 1000.00),
(35, 8, 1, '2026-01-07 15:04:55', 'tarjeta', 'Por definir', 'pagado', 713.70),
(36, 15, NULL, '2026-01-07 17:18:36', 'tarjeta', 'Por definir', 'pagado', 286.00),
(37, 15, NULL, '2026-01-08 14:41:06', 'tarjeta', 'Por definir', 'pendiente', 182.00);

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
(1, 'Filete premium con trufa negra 911 Experience', 'Filete premium sellado al punto con crema de trufa negra y reducción de vino tinto.', '4,1s · 290g · 394 kcal · 98% satisfacción', 167.00, 'primeros', 1, 'platos/primeros/911-experience-filete-con-trufa-negra.webp'),
(2, '718 essence tataki de atun con caviar', 'Atún rojo sellado brevemente para preservar su textura y sabor, acompañado de caviar selecto que aporta un toque salino y sofisticado. ', '4,5s · 210g · 312 kcal · 96% satisfacción', 142.00, 'primeros', 1, 'platos/primeros/718-essence-tataki-de-atun-con-caviar.webp'),
(3, 'Macan green ensalada de brotes y almendras', 'Mezcla de brotes frescos, almendras tostadas y vinagreta cítrica.', '3,2s · 180g · 185 kcal · 92% satisfacción', 58.00, 'primeros', 1, 'platos/primeros/macan-green-ensalada-de-brotes-y-almendras.webp'),
(4, 'Panamera cream crema de calabaza y jengibre', 'Crema suave de calabaza con jengibre fresco y aceite de oliva premium', '4,0s · 250g · 220 kcal · 94% satisfacción', 44.00, 'primeros', 1, 'platos/primeros/panamera-cream-crema-de-calabaza-y-jengibre.webp'),
(5, 'Cayenne Fusion Gyozas de pato glaseado', 'Gyozas rellenas de pato, lacadas en reducción de soja y miel.', '3,8s · 6 unidades · 305 kcal · 95% satisfacción', 79.00, 'primeros', 1, 'platos/primeros/cayenne-fusion-gyozas-de-pato-glaseado.webp'),
(6, 'Boxster Fire Carpaccio de buey', 'Finas láminas de buey de primera calidad, aderezadas con un aliño suave que realza su sabor natural.', '3,6s · 160g · 278 kcal · 96% satisfacción', 91.00, 'primeros', 1, 'platos/primeros/boxster-fire-carpaccio-de-buey.webp'),
(7, 'Panamera Deluxe  Solomillo al Vino Tinto', 'Solomillo con champiñones franceses y láminas de oro comestible.', '4,3s · 260g · 645 kcal · 95% satisfacción', 174.00, 'segundos', 1, 'platos/segundos/panamera-deluxe-solomillo-al-vino-tinto.webp'),
(8, 'Taycan Gold Risotto', 'Costillas de cerdo cocinadas 12 horas con reducción miel-mostaza.', '6,2s · 380g · 645 kcal · 95% satisfacción', 152.00, 'segundos', 1, 'platos/segundos/taycan-gold-risotto.webp'),
(9, 'Cayman Red Magret de pato', 'Magret con salsa de frutos rojos y quinoa especiada.', '4,9s · 240g · 520 kcal · 96% satisfacción', 129.00, 'segundos', 1, 'platos/segundos/cayman-red-magret-de-pato.webp'),
(10, 'Turbo Flame – Lomo de Wagyu flambeado', 'Wagyu japonés A5 flambeado con whisky y mantequilla cítrica.', '3,7s · 280g · 790 kcal · 99% satisfacción', 310.00, 'segundos', 1, 'platos/segundos/turbo-flame-lomo-de-wagyu-flambeado.webp'),
(11, 'Carrera Blue Bacalao confitado', 'Bacalao con pilpil suave y aceite ahumado.', '4,4s · 300g · 390 kcal · 94% satisfacción', 138.00, 'segundos', 1, 'platos/segundos/carrera-blue-bacalao-confitado.webp'),
(12, 'Speedster Grill Costillar BBQ gourmet', 'Costillar a baja temperatura con salsa BBQ artesana.', '6,0s · 450g · 860 kcal · 97% satisfacción', 148.00, 'segundos', 1, 'platos/segundos/speedster-grill-costillar-bbq-gourmet.webp'),
(13, 'Taycan Sweet Mousse de chocolate con oro', 'Mousse belga con oro comestible y cacao tostado.', '4,8s · 180g · 412 kcal · 99% satisfacción', 158.00, 'postres', 1, 'platos/postres/taycan-sweet-mousse-de-chocolate-con-oro.webp'),
(14, '911 Turbo Souffle de vainilla al ron', 'Soufflé de vainilla bourbon con ron añejo.', '5,1s · 210g · 389 kcal · 98% satisfacción', 122.00, 'postres', 1, 'platos/postres/911-turbo-souffle-de-vainilla-al-ron.webp'),
(15, 'Taycan Gold Champagne de trufa blanca', 'Champagne con notas terrosas y final sedoso.', '3,9s · 150ml · 12,5% alcohol · 99% satisfacción', 220.00, 'bebidas', 1, 'platos/bebidas/taycan-gold-champagne-de-trufa-blanca.webp'),
(16, '911 Spirit Cóctel de ron y cítricos', 'Cóctel de ron añejo con oro líquido.', '4,2s · 180ml · 18% alcohol · 97% satisfacción', 197.00, 'bebidas', 1, 'platos/bebidas/911-spirit-coctel-de-ron-y-citricos.webp'),
(17, 'Carrera Frost Helado artesanal de vainilla negra', 'Vainilla negra con crumble de chocolate.', '3,2s · 160g · 285 kcal · 95% satisfacción', 42.00, 'postres', 1, 'platos/postres/carrera-frost-helado-de-vainilla-negra.webp'),
(18, 'Macan Cloud Tiramisú cremoso', 'Tiramisú con cacao premium y crema ligera.', '4,1s · 200g · 470 kcal · 96% satisfacción', 55.00, 'postres', 1, 'platos/postres/macan-cloud-tiramisu-cremoso.webp'),
(19, 'Cayenne Velvet Cheesecake de frutos rojos', 'Cheesecake horneado con frutos rojos frescos.', '4,6s · 220g · 510 kcal · 97% satisfacción', 61.00, 'postres', 1, 'platos/postres/cayenne-velvet-cheesecake-de-frutos-rojos.webp'),
(20, 'Panamera Dark Brownie caliente', 'Brownie fundente con nueces tostadas.', '3,7s · 180g · 540 kcal · 98% satisfacción', 49.00, 'postres', 1, 'platos/postres/panamera-dark-brownie-caliente.webp'),
(21, 'Boxster Citrus Mousse de limón y jengibre', 'Mousse ligera con notas cítricas.', '3,8s · 170g · 290 kcal · 94% satisfacción', 52.00, 'postres', 1, 'platos/postres/boxster-citrus-mousse-de-limon-y-jengibre.webp'),
(22, 'Spyder Cream – Crème brûlée clásica', 'Vainilla fresca y caramelización perfecta.', '4,0s · 190g · 320 kcal · 97% satisfacción', 64.00, 'postres', 1, 'platos/postres/spyder-cream-creme-brulee-clasica.webp'),
(23, 'Turbo Boost Espresso doble', 'Café de origen etíope con tostado intenso.', '2,1s · 60ml · 0 kcal · 98% satisfacción', 12.00, 'bebidas', 1, 'platos/bebidas/turbo-boost-espresso-doble.webp'),
(24, 'Panamera White Latte cremosa', 'Café suave con leche vaporizada.', '2,5s · 300ml · 160 kcal · 94% satisfacción', 15.00, 'bebidas', 1, 'platos/bebidas/panamera-white-latte-cremosa.webp'),
(25, 'Cayenne Fire Infusión de jengibre', 'Infusión caliente con limón y jengibre fresco.', '3,1s · 250ml · 22 kcal · 96% satisfacción', 14.00, 'bebidas', 1, 'platos/bebidas/cayenne-fire-infusion-de-jengibre.webp'),
(26, 'Boxster Ice Limonada premium', 'Limonada artesanal con hierbabuena.', '1,9s · 330ml · 110 kcal · 95% satisfacción', 10.00, 'bebidas', 1, 'platos/bebidas/boxster-ice-limonada-premium.webp'),
(27, 'Macan Fresh Agua mineral', 'Agua natural de manantial.', '1,0s · 500ml · 0 kcal · 97% satisfacción', 4.00, 'bebidas', 1, 'platos/bebidas/macan-fresh-agua-mineral.webp'),
(28, 'GT3 Punch Mocktail tropical', 'Cítricos y frutas tropicales sin alcohol.', '2,8s · 300ml · 140 kcal · 96% satisfacción', 18.00, 'bebidas', 1, 'platos/bebidas/gt3-punch-mocktail-tropical.webp'),
(29, 'Turbo Red Vino tinto reserva', 'Vino de crianza con notas especiadas.', '3,5s · 150ml · 14% alcohol · 96% satisfacción', 22.00, 'bebidas', 1, 'platos/bebidas/turbo-red-vino-tinto-reserva.webp'),
(30, 'Carrera Gold Cerveza artesanal', 'Cerveza rubia premium.', '2,2s · 330ml · 120 kcal · 92% satisfacción', 11.00, 'bebidas', 1, 'platos/bebidas/carrera-gold-cerveza-artesanal.webp'),
(31, 'Cayman Chocolate Sphere', 'Delicada esfera de chocolate oscuro con corazón fundente.', '3,5 s · 165 g · 510 kcal · 97% satisfacción', 47.00, 'postres', 1, 'platos/postres/cayman-chocolate-sphere.webp'),
(32, 'Porsche 911 Vanilla Precision', 'Mousse de vainilla natural de textura sedosa sobre crumble crujiente de mantequilla', '3,2 s · 150 g · 460 kcal · 96% satisfacción', 45.00, 'postres', 1, 'platos/postres/porsche-911-vanilla-precision.webp'),
(136, 'Kobe Apex Solomillo Imperial', 'Solomillo de auténtico Kobe japonés A5 marcado a la brasa y terminado con sal mineral ahumada.', '4,1 s · 260 g · 820 kcal · 98% satisfacción', 335.00, 'segundos', 1, 'platos/segundos/kobe-apex-solomillo-imperial.webp');

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
(8, 'prueba', '', '', '', 'prueba@gmail.com', '$2y$10$tsnHyye0McF60TnKhUnUu.mt1XG7Z6a4szvuF/ycU02k52eQyJHw.', 'cliente', '2025-12-11 15:48:46'),
(15, 'Admin', NULL, NULL, NULL, 'admin@gmail.com', '$2y$10$PbX1ExcjZaIIwMkisA452.b1.4m.UrDUPVV9eHgz5x0M2p3iSk0ki', 'admin', '2025-12-16 12:08:09'),
(17, 'joao', 'meneses', '731993193', 'Barcelona', 'joao1@jo.com', '$2y$10$qJcdJNQkW4ukU5xl0f97HOmZd95pMLg8SADwdsyBdz4r0otZvaVQe', 'cliente', '2026-01-07 17:21:13'),
(18, 'a', '', '', '', 'a@a.com', '$2y$10$PtRLwnkW9a5Ilvbw1aI1XuJkwtDQYu2t296t00lRCTC3NO2jl/gDK', 'cliente', '2026-01-08 14:08:23');

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
  MODIFY `id_linea` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT de la tabla `logacciones`
--
ALTER TABLE `logacciones`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `oferta`
--
ALTER TABLE `oferta`
  MODIFY `id_oferta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

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
