-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-11-2023 a las 12:55:30
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `almacent`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `codigo` varchar(50) NOT NULL,
  `descripcion` text NOT NULL,
  `precio_compra` decimal(10,2) NOT NULL,
  `precio_venta` decimal(10,2) NOT NULL,
  `cantidad` int(11) NOT NULL DEFAULT 0,
  `foto` varchar(100) DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `ventas` int(11) NOT NULL DEFAULT 0,
  `id_medida` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `id_proveedor` int(11) NOT NULL,
  `ubicacion` varchar(100) NOT NULL,
  `dia` int(11) NOT NULL,
  `mes` int(11) NOT NULL,
  `lapso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `codigo`, `descripcion`, `precio_compra`, `precio_venta`, `cantidad`, `foto`, `estado`, `fecha`, `hora`, `ventas`, `id_medida`, `id_categoria`, `id_proveedor`, `ubicacion`, `dia`, `mes`, `lapso`) VALUES
(1, 'TP-REY', 'TAPER REYWARE 1 KG', '0.00', '0.00', 259, NULL, 1, '2023-10-27', '12:15:45', 151, 2, 3, 1, '00000001', 0, 0, 0),
(2, 'JE-BASA', 'JARRA ELÉCTRICA 2.5 LT', '0.00', '0.00', 0, NULL, 1, '2023-10-07', '00:00:00', 0, 3, 1, 1, '00000002', 0, 0, 0),
(3, 'BE-REY', 'BANCO EVEREST 2 PASOS', '0.00', '0.00', 0, NULL, 1, '2023-10-12', '00:00:00', 1, 1, 5, 1, '00000003', 0, 0, 0),
(4, 'RP-BASA', 'RALLADOR DE PLÁSTICO', '0.00', '0.00', 0, NULL, 1, '2023-10-07', '00:00:00', 0, 1, 7, 2, '00000004', 0, 0, 0),
(5, 'MF-REY', 'MATAMOSCA FLORAL', '0.00', '0.00', 0, NULL, 1, '2023-10-07', '00:00:00', 0, 1, 8, 1, '00000005', 0, 0, 0),
(6, 'CMS-REY', 'CAJA MÓVIL SUPREMA # 40', '0.00', '0.00', 0, NULL, 1, '2023-10-07', '00:00:00', 0, 3, 9, 1, '00000006', 0, 0, 0),
(7, 'T-UTILIT', 'TAPER 1200 ML', '0.00', '0.00', 0, NULL, 1, '2023-10-07', '00:00:00', 0, 3, 3, 3, '00000007', 0, 0, 0),
(8, 'DR-REY', 'DESPENSERO REAL GIGANTE * 3 NIVELES CON RUEDA', '0.00', '0.00', 2, NULL, 1, '2023-10-07', '00:00:00', 0, 2, 10, 1, '00000008', 0, 0, 0),
(9, 'CG-REY', 'CESTO GABY CON TAPA', '0.00', '0.00', 0, NULL, 1, '2023-10-07', '00:00:00', 0, 3, 11, 1, '00000009', 0, 0, 0),
(10, 'CM-REY', 'COLADOR MULTIUSO', '0.00', '0.00', 0, NULL, 1, '2023-10-07', '00:00:00', 0, 3, 12, 1, '000000010', 0, 0, 0),
(11, 'HC-DAYR', 'HISOPO CON BASE HANDY CLEAN', '0.00', '0.00', 0, NULL, 1, '2023-04-30', '00:00:00', 0, 1, 13, 4, '000000011', 0, 0, 0),
(12, 'CO-QPLA', 'CAJA ORGANIZADORA #90', '0.00', '0.00', 0, NULL, 1, '2023-08-03', '00:00:00', 0, 1, 7, 2, '000000011', 0, 0, 0),
(13, 'BS-REY', 'BANDEJA SNAK', '0.00', '0.00', 0, NULL, 1, '2023-08-03', '00:00:00', 0, 1, 14, 1, '000000013', 0, 0, 0),
(14, 'PF-REY', 'PORTACEPILLO FAMILIAR', '0.00', '0.00', 1, NULL, 1, '2023-08-04', '00:00:00', 0, 3, 15, 1, '000000014', 0, 0, 0),
(15, 'EH-REY', 'ENVASE HERMETICO 1.5 LT CON TAPA ROSCA', '0.00', '0.00', 1, NULL, 1, '2023-08-04', '00:00:00', 0, 3, 16, 1, '000000015', 0, 0, 0),
(16, 'TM-DAYR', 'TRAPEADOR MICROFIBRA', '0.00', '0.00', 0, NULL, 1, '2023-08-03', '00:00:00', 0, 1, 26, 1, '000000016', 0, 0, 0),
(17, 'TB-DAYR', 'TAPETE BIENVENIDO', '0.00', '0.00', 0, NULL, 1, '2023-08-03', '00:00:00', 0, 1, 17, 4, '000000017', 0, 0, 0),
(18, 'BB-BASA', 'BAÑERA BALLENITA FELIZ BASA', '0.00', '0.00', 2, NULL, 1, '2023-09-15', '00:00:00', 1, 3, 18, 5, '000000018', 0, 0, 0),
(19, 'CC-BOTI', 'CONDIMENTERO', '0.00', '0.00', 0, NULL, 1, '2023-08-03', '00:00:00', 0, 3, 19, 6, '000000019', 0, 0, 0),
(20, 'TT-KING', 'TETERA', '0.00', '0.00', 0, NULL, 1, '2023-08-03', '00:00:00', 0, 3, 20, 7, '000000020', 0, 0, 0),
(21, 'AJ-COAS', 'AJICERO', '0.00', '0.00', 0, NULL, 1, '2023-08-03', '00:00:00', 0, 1, 5, 1, '000000021', 0, 0, 0),
(22, 'FR-BOTI', 'FRASCO REPOSTERO PRACTICO 4 LT', '0.00', '0.00', 0, NULL, 1, '2023-08-03', '00:00:00', 0, 3, 21, 6, '000000022', 0, 0, 0),
(23, 'PL-REY', 'PORTARROLLO DE LUXE', '0.00', '0.00', 0, NULL, 1, '2023-08-03', '00:00:00', 0, 1, 22, 1, '000000023', 0, 0, 0),
(24, 'ER-COAS', 'ESPEJO ROSE', '0.00', '0.00', 0, NULL, 1, '2023-08-03', '00:00:00', 0, 1, 23, 8, '000000024', 0, 0, 0),
(25, 'AA-REY', 'AZUCARERO ACRÍLICO', '0.00', '0.00', 0, NULL, 1, '2023-08-03', '00:00:00', 0, 1, 24, 5, '000000025', 0, 0, 0),
(26, 'NP-REY', 'NECESER NADINE PORTATIL', '0.00', '0.00', 0, NULL, 1, '2023-08-03', '00:00:00', 0, 1, 27, 1, '000000026', 0, 0, 0),
(27, 'RF-REY', 'REPOSTERO FRANCÉS #10', '0.00', '0.00', 0, NULL, 1, '2023-08-03', '00:00:00', 0, 3, 28, 1, '000000027', 0, 0, 0),
(28, 'JR-BASA', 'JARRA TROPICAL 4.5 LT', '0.00', '0.00', 0, NULL, 1, '2023-08-03', '00:00:00', 0, 3, 1, 5, '000000028', 0, 0, 0),
(29, 'MF-REY', 'MACETA DURA FASHION # 6', '0.00', '0.00', 0, NULL, 1, '2023-08-03', '00:00:00', 0, 3, 29, 1, '000000029', 0, 0, 0),
(30, 'PM-DAYR', 'PAÑO MICROFIBRA', '0.00', '0.00', 0, NULL, 1, '2023-08-03', '00:00:00', 0, 1, 30, 4, '000000030', 0, 0, 0),
(31, 'SM-REY', 'SILLA MODERNA CAOBA', '0.00', '0.00', 0, NULL, 1, '2023-08-03', '00:00:00', 0, 2, 31, 1, '000000031', 0, 0, 0),
(32, 'MC-REY', 'MESA REDONDA CARAL', '0.00', '0.00', 0, NULL, 1, '2023-08-03', '00:00:00', 0, 1, 32, 1, '000000032', 0, 0, 0),
(33, 'ST-REY', 'SET TRAPEADOR ESCURRIDOR GIGANTE MÁGICO', '0.00', '0.00', 0, NULL, 1, '2023-08-03', '00:00:00', 0, 3, 26, 1, '000000033', 0, 0, 0),
(34, 'EG-POLI', 'ESQUINERO CON GAVETERO', '0.00', '0.00', 0, NULL, 1, '2023-08-03', '00:00:00', 0, 2, 33, 2, '000000034', 0, 0, 0),
(35, 'PB-DAYR', 'PVC BATH MAT OVALADO - BAÑO', '0.00', '0.00', 0, NULL, 1, '2023-08-03', '00:00:00', 0, 2, 34, 4, '000000035', 0, 0, 0),
(36, 'EC-DAYR', 'ESCOBA SÚPER CHINITA', '0.00', '0.00', 0, NULL, 1, '2023-08-03', '00:00:00', 0, 1, 35, 4, '000000036', 0, 0, 0),
(37, 'CC-REY', 'CAJA COSECHERA 40 LT', '0.00', '0.00', 0, NULL, 1, '2023-08-03', '00:00:00', 0, 3, 9, 2, '000000037', 0, 0, 0),
(38, 'BT-REY', 'BATEA', '0.00', '0.00', 0, NULL, 1, '2023-08-03', '00:00:00', 0, 3, 36, 1, '000000038', 0, 0, 0),
(39, 'SC-REY', 'SÚPER CUBIERTO CUCHARA', '0.00', '0.00', 0, NULL, 1, '2023-08-03', '00:00:00', 0, 2, 37, 2, '000000039', 0, 0, 0),
(40, 'BH-BASA', 'BOLOS BUEN HOGAR CON TAPA JUEGO * 4', '0.00', '0.00', 1, NULL, 1, '2023-08-04', '00:00:00', 0, 2, 38, 1, '000000040', 0, 0, 0),
(41, 'CT-REY', 'CANASTILLA TAVARUA MODELO RATAN', '0.00', '0.00', 0, NULL, 1, '2023-08-03', '00:00:00', 0, 2, 39, 1, '000000041', 0, 0, 0),
(42, 'SH-BOTI', 'SORBETERO HAWAIANO', '0.00', '0.00', 0, NULL, 1, '2023-08-03', '00:00:00', 0, 1, 40, 6, '000000042', 0, 0, 0),
(43, 'US-REY', 'UTILITARIO SALSA', '0.00', '0.00', 0, NULL, 1, '2023-08-03', '00:00:00', 0, 3, 37, 1, '000000043', 0, 0, 0),
(44, 'TH-REY', 'TAPER HERMETIC 1.1 LITROS CON VALVULA', '0.00', '0.00', 0, NULL, 1, '2023-08-03', '00:00:00', 0, 1, 8, 1, '000000044', 0, 0, 0),
(45, 'PG-REY', 'PORTAVAJILLA GRANDE MISTURA', '0.00', '0.00', 0, NULL, 1, '2023-08-03', '00:00:00', 0, 3, 41, 1, '000000045', 0, 0, 0),
(46, 'JR-REY', 'JARRA REYWARE 1 LT', '0.00', '0.00', 0, NULL, 1, '2023-08-03', '00:00:00', 0, 3, 1, 1, '000000046', 0, 0, 0),
(47, 'BT-BASA', 'BOTELLA TRITAN 830 ML', '0.00', '0.00', 0, NULL, 1, '2023-08-03', '00:00:00', 0, 3, 42, 5, '000000047', 0, 0, 0),
(48, 'LI-HUDE', 'LIMPIAVIDRIO INDUSTRIAL', '0.00', '0.00', 0, NULL, 1, '2023-08-03', '00:00:00', 0, 5, 43, 9, '000000048', 0, 0, 0),
(49, 'PA-REY', 'PAPELERA AUTOMÁTICA CLIN', '0.00', '0.00', 0, NULL, 1, '2023-08-03', '00:00:00', 0, 3, 44, 1, '000000049', 0, 0, 0),
(50, 'EL-BASA', 'EXPRIMIDOR DE LIMON', '0.00', '0.00', 0, NULL, 1, '2023-08-03', '00:00:00', 0, 3, 36, 1, '000000050', 0, 0, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_categoria` (`id_categoria`),
  ADD KEY `id_medida` (`id_medida`),
  ADD KEY `id_proveedor` (`id_proveedor`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id`),
  ADD CONSTRAINT `productos_ibfk_2` FOREIGN KEY (`id_medida`) REFERENCES `medidas` (`id`),
  ADD CONSTRAINT `productos_ibfk_3` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
