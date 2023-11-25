-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-11-2023 a las 14:45:03
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
-- Estructura de tabla para la tabla `abonos`
--

CREATE TABLE `abonos` (
  `id` int(11) NOT NULL,
  `abono` decimal(10,2) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `apertura` int(11) NOT NULL DEFAULT 1,
  `id_credito` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `abonos`
--

INSERT INTO `abonos` (`id`, `abono`, `fecha`, `apertura`, `id_credito`, `id_usuario`) VALUES
(1, '800.00', '2022-09-24 15:30:41', 0, 2, 1),
(2, '800.00', '2022-09-24 15:30:41', 0, 2, 1),
(3, '4200.00', '2022-09-24 15:30:41', 0, 2, 1),
(4, '4.00', '2023-04-11 14:12:17', 1, 3, 1),
(5, '0.00', '2023-04-11 14:30:43', 1, 3, 1),
(6, '9.80', '2023-04-11 14:44:57', 1, 5, 1),
(7, '0.20', '2023-04-11 14:45:31', 1, 5, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acceso`
--

CREATE TABLE `acceso` (
  `id` int(11) NOT NULL,
  `evento` varchar(30) NOT NULL,
  `ip` varchar(50) NOT NULL,
  `detalle` text NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `acceso`
--

INSERT INTO `acceso` (`id`, `evento`, `ip`, `detalle`, `fecha`) VALUES
(1, 'Cierre de Sesión', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/105.0.5195.127 Safari/537.36', '2022-09-23 22:26:10'),
(2, 'Inicio de Sesión', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/105.0.5195.127 Safari/537.36', '2022-09-23 22:26:21'),
(3, 'Inicio de Sesión', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/105.0.5195.127 Safari/537.36', '2022-09-23 22:26:22'),
(4, 'Inicio de Sesión', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/105.0.5195.127 Safari/537.36', '2022-09-24 14:45:18'),
(5, 'Inicio de Sesión', '192.168.100.181', 'Mozilla/5.0 (Linux; Android 12; 2109119DG) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/105.0.0.0 Mobile Safari/537.36', '2022-09-24 16:19:35'),
(6, 'Inicio de Sesión', '192.168.100.203', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/105.0.5195.127 Safari/537.36', '2022-09-24 16:21:31'),
(7, 'Inicio de Sesión', '192.168.100.181', 'Mozilla/5.0 (Linux; Android 12; 2109119DG) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/105.0.0.0 Mobile Safari/537.36', '2022-09-24 17:36:30'),
(8, 'Inicio de Sesión', '192.168.100.203', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/105.0.5195.127 Safari/537.36', '2022-10-06 15:17:29'),
(9, 'Inicio de Sesión', '192.168.100.203', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/105.0.5195.127 Safari/537.36', '2022-10-06 15:17:31'),
(10, 'Inicio de Sesión', '192.168.100.203', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/105.0.5195.127 Safari/537.36', '2022-10-06 15:17:33'),
(11, 'Inicio de Sesión', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/105.0.5195.127 Safari/537.36', '2022-10-06 15:18:39'),
(12, 'Cierre de Sesión', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/105.0.5195.127 Safari/537.36', '2022-10-07 15:01:02'),
(13, 'Inicio de Sesión', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/105.0.5195.127 Safari/537.36', '2022-10-07 15:01:30'),
(14, 'Inicio de Sesión', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/105.0.5195.127 Safari/537.36', '2022-10-08 22:26:48'),
(15, 'Inicio de Sesión', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/105.0.5195.127 Safari/537.36', '2022-10-11 15:13:07'),
(16, 'Cierre de Sesión', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/105.0.5195.127 Safari/537.36', '2022-10-11 17:21:52'),
(17, 'Inicio de Sesión', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/105.0.5195.127 Safari/537.36', '2022-10-11 17:22:08'),
(18, 'Inicio de Sesión', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/105.0.5195.127 Safari/537.36', '2022-10-12 15:36:10'),
(19, 'Inicio de Sesión', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/105.0.5195.127 Safari/537.36', '2022-10-13 15:06:38'),
(20, 'Inicio de Sesión', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/105.0.5195.127 Safari/537.36', '2022-10-14 15:22:37'),
(21, 'Inicio de Sesión', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/105.0.5195.127 Safari/537.36', '2022-10-15 15:33:33'),
(22, 'Cierre de Sesión', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/105.0.5195.127 Safari/537.36', '2022-10-15 21:19:09'),
(23, 'Inicio de Sesión', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/105.0.5195.127 Safari/537.36', '2022-10-15 21:19:23'),
(24, 'Inicio de Sesión', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/105.0.5195.127 Safari/537.36', '2022-10-16 01:03:29'),
(25, 'Inicio de Sesión', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/105.0.5195.127 Safari/537.36', '2022-10-17 19:09:30'),
(26, 'Inicio de Sesión', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/105.0.5195.127 Safari/537.36', '2022-10-19 15:10:02'),
(27, 'Cierre de Sesión', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/105.0.5195.127 Safari/537.36', '2022-10-19 22:45:40'),
(28, 'Inicio de Sesión', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/105.0.5195.127 Safari/537.36', '2022-10-19 22:45:53'),
(29, 'Inicio de Sesión', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/106.0.5249.103 Safari/537.36', '2022-10-20 16:05:02'),
(30, 'Inicio de Sesión', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/106.0.5249.103 Safari/537.36', '2022-10-21 14:58:38'),
(31, 'Inicio de Sesión', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/106.0.5249.103 Safari/537.36', '2022-10-22 19:47:25'),
(32, 'Inicio de Sesión', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/106.0.5249.103 Safari/537.36', '2022-10-25 14:28:57'),
(33, 'Inicio de Sesión', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/106.0.5249.103 Safari/537.36', '2022-10-26 15:15:27'),
(34, 'Inicio de Sesión', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/106.0.5249.119 Safari/537.36', '2022-11-02 14:40:12'),
(35, 'Inicio de Sesión', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/106.0.5249.119 Safari/537.36', '2022-11-05 20:04:53'),
(36, 'Inicio de Sesión', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.5414.120 Safari/537.36', '2023-03-07 15:52:04'),
(37, 'Inicio de Sesión', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.5414.120 Safari/537.36', '2023-03-07 17:39:21'),
(38, 'Inicio de Sesión', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.5414.120 Safari/537.36', '2023-03-08 15:38:39'),
(39, 'Inicio de Sesión', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.5414.120 Safari/537.36', '2023-03-09 16:57:53'),
(40, 'Cierre de Sesión', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.5414.120 Safari/537.36', '2023-03-09 20:13:51'),
(41, 'Inicio de Sesión', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.5414.120 Safari/537.36', '2023-03-09 20:23:10'),
(42, 'Inicio de Sesión', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.5414.120 Safari/537.36', '2023-03-10 15:29:47'),
(43, 'Inicio de Sesión', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.5414.120 Safari/537.36', '2023-03-11 18:08:05'),
(44, 'Inicio de Sesión', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.5481.178 Safari/537.36', '2023-03-21 20:32:39'),
(45, 'Inicio de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.5563.147 Safari/537.36', '2023-04-11 13:45:28'),
(46, 'Inicio de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.5563.147 Safari/537.36', '2023-04-13 15:17:28'),
(47, 'Cierre de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.5563.147 Safari/537.36', '2023-04-13 15:30:05'),
(48, 'Inicio de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.5563.147 Safari/537.36', '2023-04-14 17:40:08'),
(49, 'Inicio de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.5563.147 Safari/537.36', '2023-04-20 23:34:59'),
(50, 'Inicio de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.21452.134 Safari/537.36 Avast/114.0.21452.134', '2023-07-04 15:23:44'),
(51, 'Inicio de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.21608.199 Safari/537.36 Avast/114.0.21608.199', '2023-07-15 20:41:15'),
(52, 'Cierre de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.21608.199 Safari/537.36 Avast/114.0.21608.199', '2023-07-15 21:13:35'),
(53, 'Inicio de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.21608.199 Safari/537.36 Avast/114.0.21608.199', '2023-07-15 21:13:46'),
(54, 'Cierre de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.21608.199 Safari/537.36 Avast/114.0.21608.199', '2023-07-15 21:15:08'),
(55, 'Inicio de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.21608.199 Safari/537.36 Avast/114.0.21608.199', '2023-07-15 21:16:21'),
(56, 'Cierre de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.21608.199 Safari/537.36 Avast/114.0.21608.199', '2023-07-15 21:16:50'),
(57, 'Inicio de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.21608.199 Safari/537.36 Avast/114.0.21608.199', '2023-07-15 21:19:58'),
(58, 'Cierre de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.21608.199 Safari/537.36 Avast/114.0.21608.199', '2023-07-15 21:35:15'),
(59, 'Inicio de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', '2023-07-15 21:40:12'),
(60, 'Inicio de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36', '2023-07-28 14:47:05'),
(61, 'Cierre de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36', '2023-07-28 14:52:10'),
(62, 'Inicio de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36', '2023-07-28 14:52:20'),
(63, 'Cierre de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36', '2023-07-28 14:53:37'),
(64, 'Inicio de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36', '2023-07-28 14:55:48'),
(65, 'Inicio de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36', '2023-07-29 14:19:02'),
(66, 'Inicio de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36', '2023-08-01 21:17:42'),
(67, 'Inicio de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36', '2023-08-03 15:39:24'),
(68, 'Cierre de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36', '2023-08-03 18:00:03'),
(69, 'Inicio de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36', '2023-08-03 18:00:24'),
(70, 'Inicio de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36', '2023-08-03 18:05:27'),
(71, 'Inicio de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.21929.110 Safari/537.36 Avast/115.0.21929.110', '2023-08-03 18:07:04'),
(72, 'Cierre de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36', '2023-08-03 18:17:22'),
(73, 'Cierre de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36', '2023-08-03 18:19:28'),
(74, 'Inicio de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36', '2023-08-03 18:19:36'),
(75, 'Inicio de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36', '2023-08-04 14:31:12'),
(76, 'Inicio de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36', '2023-08-04 19:22:33'),
(77, 'Inicio de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36', '2023-08-05 21:15:05'),
(78, 'Inicio de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36', '2023-08-08 14:32:39'),
(79, 'Inicio de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36', '2023-08-12 22:20:15'),
(80, 'Inicio de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36', '2023-08-17 23:19:13'),
(81, 'Inicio de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36 Avast/116.0.0.0', '2023-09-08 18:53:48'),
(82, 'Cierre de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36 Avast/116.0.0.0', '2023-09-08 19:13:28'),
(83, 'Inicio de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36 Avast/116.0.0.0', '2023-09-08 19:13:36'),
(84, 'Inicio de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36', '2023-09-08 20:10:29'),
(85, 'Inicio de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36 Avast/116.0.0.0', '2023-09-15 18:38:38'),
(86, 'Inicio de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36 Avast/116.0.0.0', '2023-09-23 21:04:21'),
(87, 'Inicio de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36 Avast/116.0.0.0', '2023-09-26 16:20:15'),
(88, 'Cierre de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36 Avast/116.0.0.0', '2023-09-26 16:21:20'),
(89, 'Inicio de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36 Avast/116.0.0.0', '2023-09-26 16:21:25'),
(90, 'Cierre de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36 Avast/116.0.0.0', '2023-09-26 18:03:57'),
(91, 'Inicio de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36 Avast/116.0.0.0', '2023-09-26 18:04:18'),
(92, 'Cierre de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36 Avast/116.0.0.0', '2023-09-26 18:06:20'),
(93, 'Inicio de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36 Avast/116.0.0.0', '2023-09-29 18:41:07'),
(94, 'Cierre de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36 Avast/116.0.0.0', '2023-09-30 22:41:06'),
(95, 'Inicio de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36 Avast/116.0.0.0', '2023-09-30 22:41:15'),
(96, 'Inicio de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36 Avast/116.0.0.0', '2023-10-05 17:31:52'),
(97, 'Inicio de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36 Avast/116.0.0.0', '2023-10-05 22:12:48'),
(98, 'Inicio de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/117.0.0.0 Safari/537.36', '2023-10-07 16:37:39'),
(99, 'Inicio de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36 Avast/116.0.0.0', '2023-10-07 22:36:54'),
(100, 'Cierre de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36 Avast/116.0.0.0', '2023-10-10 20:09:16'),
(101, 'Inicio de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36 Avast/116.0.0.0', '2023-10-10 20:24:07'),
(102, 'Inicio de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36 Avast/116.0.0.0', '2023-10-11 15:00:50'),
(103, 'Inicio de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36 Avast/116.0.0.0', '2023-10-12 14:50:03'),
(104, 'Inicio de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36', '2023-10-12 23:50:38'),
(105, 'Inicio de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/117.0.0.0 Safari/537.36 Avast/117.0.0.0', '2023-10-13 14:57:29'),
(106, 'Inicio de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36', '2023-10-13 21:24:31'),
(107, 'Inicio de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/117.0.0.0 Safari/537.36 Avast/117.0.0.0', '2023-10-14 14:15:01'),
(108, 'Inicio de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/117.0.0.0 Safari/537.36 Avast/117.0.0.0', '2023-10-22 00:32:24'),
(109, 'Inicio de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/117.0.0.0 Safari/537.36 Avast/117.0.0.0', '2023-10-24 20:59:01'),
(110, 'Cierre de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/117.0.0.0 Safari/537.36 Avast/117.0.0.0', '2023-10-24 20:59:35'),
(111, 'Inicio de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36', '2023-10-24 21:05:00'),
(112, 'Inicio de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/117.0.0.0 Safari/537.36 Avast/117.0.0.0', '2023-10-24 22:13:22'),
(113, 'Inicio de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/117.0.0.0 Safari/537.36 Avast/117.0.0.0', '2023-10-25 16:31:34'),
(114, 'Inicio de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/117.0.0.0 Safari/537.36 Avast/117.0.0.0', '2023-10-25 16:31:41'),
(115, 'Inicio de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/117.0.0.0 Safari/537.36 Avast/117.0.0.0', '2023-10-25 16:32:27'),
(116, 'Inicio de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Avast/118.0.0.0', '2023-10-26 15:48:04'),
(117, 'Inicio de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Avast/118.0.0.0', '2023-10-26 19:01:52'),
(118, 'Inicio de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Avast/118.0.0.0', '2023-10-27 00:18:36'),
(119, 'Inicio de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Avast/118.0.0.0', '2023-10-27 14:51:09'),
(120, 'Inicio de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Avast/118.0.0.0', '2023-10-28 00:03:57'),
(121, 'Inicio de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Avast/118.0.0.0', '2023-10-28 14:53:14'),
(122, 'Inicio de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Avast/118.0.0.0', '2023-10-28 17:52:01'),
(123, 'Inicio de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Avast/118.0.0.0', '2023-10-28 23:23:56'),
(124, 'Cierre de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Avast/118.0.0.0', '2023-10-28 23:24:02'),
(125, 'Inicio de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Avast/118.0.0.0', '2023-10-28 23:24:22'),
(126, 'Inicio de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Avast/118.0.0.0', '2023-10-28 23:24:24'),
(127, 'Inicio de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Avast/118.0.0.0', '2023-10-28 23:26:15'),
(128, 'Inicio de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Avast/118.0.0.0', '2023-10-28 23:26:17'),
(129, 'Inicio de Sesión', '192.168.100.73', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Avast/118.0.0.0', '2023-10-28 23:27:31'),
(130, 'Inicio de Sesión', '192.168.100.73', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Avast/118.0.0.0', '2023-10-29 01:21:36'),
(131, 'Cierre de Sesión', '192.168.100.73', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Avast/118.0.0.0', '2023-10-29 01:30:28'),
(132, 'Inicio de Sesión', '192.168.100.73', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Avast/118.0.0.0', '2023-10-29 01:30:41'),
(133, 'Inicio de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Avast/118.0.0.0', '2023-10-29 01:33:13'),
(134, 'Inicio de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Avast/118.0.0.0', '2023-10-31 16:50:40'),
(135, 'Inicio de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Avast/118.0.0.0', '2023-11-02 22:04:57'),
(136, 'Inicio de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Avast/118.0.0.0', '2023-11-03 14:20:30'),
(137, 'Cierre de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Avast/118.0.0.0', '2023-11-03 21:43:35'),
(138, 'Inicio de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Avast/118.0.0.0', '2023-11-03 21:43:45'),
(139, 'Inicio de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36', '2023-11-03 22:03:15'),
(140, 'Inicio de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36', '2023-11-03 22:05:54'),
(141, 'Inicio de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36', '2023-11-03 22:27:09'),
(142, 'Inicio de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36', '2023-11-03 23:32:26'),
(143, 'Inicio de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Avast/118.0.0.0', '2023-11-04 14:32:49'),
(144, 'Inicio de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Avast/118.0.0.0', '2023-11-04 17:13:46'),
(145, 'Inicio de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Avast/118.0.0.0', '2023-11-04 17:49:23'),
(146, 'Cierre de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Avast/118.0.0.0', '2023-11-04 18:45:19'),
(147, 'Inicio de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Avast/118.0.0.0', '2023-11-04 18:45:35'),
(148, 'Inicio de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Avast/118.0.0.0', '2023-11-04 22:54:43'),
(149, 'Inicio de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Avast/118.0.0.0', '2023-11-04 23:02:51'),
(150, 'Inicio de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Avast/118.0.0.0', '2023-11-04 23:20:55'),
(151, 'Inicio de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Avast/118.0.0.0', '2023-11-05 00:20:37'),
(152, 'Inicio de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Avast/118.0.0.0', '2023-11-06 20:27:48'),
(153, 'Inicio de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Avast/118.0.0.0', '2023-11-07 15:54:28'),
(154, 'Inicio de Sesión', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Avast/118.0.0.0', '2023-11-07 15:55:23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `apartados`
--

CREATE TABLE `apartados` (
  `id` int(11) NOT NULL,
  `productos` longtext NOT NULL,
  `fecha_create` date NOT NULL,
  `fecha_apartado` datetime NOT NULL,
  `fecha_retiro` datetime NOT NULL,
  `abono` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `color` varchar(15) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `id_cliente` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `apartados`
--

INSERT INTO `apartados` (`id`, `productos`, `fecha_create`, `fecha_apartado`, `fecha_retiro`, `abono`, `total`, `color`, `estado`, `id_cliente`, `id_usuario`) VALUES
(1, '[{\"id\":1,\"nombre\":\"LAPTOP HP CORI I7 NVIDIA\",\"precio\":\"5800.00\",\"cantidad\":\"1\"}]', '2022-09-24', '2022-09-24 10:06:34', '2022-09-24 23:59:59', '5800.00', '5800.00', '#eb0000', 0, 1, 1),
(2, '[{\"id\":1,\"nombre\":\"LAPTOP HP CORI I7 NVIDIA\",\"precio\":\"5800.00\",\"cantidad\":\"5\"}]', '2022-09-24', '2022-09-24 10:12:25', '2022-09-24 23:59:59', '29000.00', '29000.00', '#00bd8e', 0, 1, 1),
(3, '[{\"id\":1,\"nombre\":\"LAPTOP HP CORI I7 NVIDIA\",\"precio\":\"5800.00\",\"cantidad\":1}]', '2022-10-20', '2022-10-20 12:51:52', '2022-10-20 23:59:59', '6.00', '5800.00', '#000000', 1, 3, 1),
(4, '[{\"id\":1,\"nombre\":\"TACHO SUPER REY #140 LT\",\"precio\":\"5.00\",\"cantidad\":\"2\"}]', '2023-03-11', '2023-03-11 16:09:18', '2023-03-11 23:59:59', '5.00', '10.00', '#000000', 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cajas`
--

CREATE TABLE `cajas` (
  `id` int(11) NOT NULL,
  `monto_inicial` decimal(10,2) NOT NULL,
  `fecha_apertura` date NOT NULL,
  `fecha_cierre` date DEFAULT NULL,
  `monto_final` decimal(10,2) DEFAULT NULL,
  `total_ventas` int(11) DEFAULT NULL,
  `egresos` decimal(10,2) DEFAULT NULL,
  `gastos` decimal(10,2) DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cajas`
--

INSERT INTO `cajas` (`id`, `monto_inicial`, `fecha_apertura`, `fecha_cierre`, `monto_final`, `total_ventas`, `egresos`, `gastos`, `estado`, `id_usuario`) VALUES
(1, '10505000.00', '2022-09-23', '2022-09-24', '58000.00', 4, '50.00', '50.00', 0, 1),
(2, '2000000.00', '2022-09-24', NULL, NULL, NULL, NULL, NULL, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `categoria` varchar(100) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `categoria`, `fecha`, `estado`) VALUES
(1, 'JARRA', '2023-08-03 18:11:34', 1),
(2, 'TACHO', '2023-08-03 17:57:29', 1),
(3, 'TAPER', '2023-08-03 17:57:21', 1),
(4, 'gf', '2023-08-03 18:06:04', 0),
(5, 'BANCO', '2023-08-03 18:46:17', 1),
(6, 'RALLADOR', '2023-08-03 18:47:37', 1),
(7, 'ARTICULO DE HOGAR', '2023-08-03 18:47:55', 1),
(8, 'MATAMOSCA', '2023-08-03 18:49:35', 1),
(9, 'CAJA', '2023-08-03 18:50:50', 1),
(10, 'DESPENSERO', '2023-08-03 18:55:58', 1),
(11, 'CESTO', '2023-08-03 18:56:12', 1),
(12, 'COLADOR', '2023-08-03 18:56:19', 1),
(13, 'HISOPO', '2023-08-03 18:56:32', 1),
(14, 'BADEJA', '2023-08-03 18:56:42', 1),
(15, 'PORTACEPILLO', '2023-08-03 18:56:51', 1),
(16, 'ENVASE', '2023-08-03 18:57:00', 1),
(17, 'TAPETE', '2023-08-03 18:57:07', 1),
(18, 'BAÑERA', '2023-08-03 18:57:16', 1),
(19, 'CONDIMENTERO', '2023-08-03 18:57:25', 1),
(20, 'TETERA', '2023-08-03 18:57:33', 1),
(21, 'FRASCO', '2023-08-03 18:57:37', 1),
(22, 'PORTARROLLO', '2023-08-03 18:57:56', 1),
(23, 'ESPEJO', '2023-08-03 18:58:03', 1),
(24, 'AZUCARERO', '2023-08-03 18:58:11', 1),
(25, 'DAYR', '2023-08-03 19:04:09', 0),
(26, 'TRAPEADOR', '2023-08-03 19:12:55', 1),
(27, 'NECESER', '2023-08-03 19:25:06', 1),
(28, 'REPOSTERO', '2023-08-03 19:25:17', 1),
(29, 'MACETA', '2023-08-03 19:25:25', 1),
(30, 'PAÑO', '2023-08-03 19:25:33', 1),
(31, 'SILLA', '2023-08-03 19:25:42', 1),
(32, 'MESA', '2023-08-03 19:25:51', 1),
(33, 'ESQUINERO', '2023-08-03 19:26:16', 1),
(34, 'PVC', '2023-08-03 19:28:01', 1),
(35, 'ESCOBA', '2023-08-03 19:28:10', 1),
(36, 'BATEA', '2023-08-03 19:28:16', 1),
(37, 'UTILITARIO', '2023-08-03 19:28:24', 1),
(38, 'BOLOS', '2023-08-03 19:28:32', 1),
(39, 'CANASTILLA', '2023-08-03 19:28:38', 1),
(40, 'SORBETERO', '2023-08-03 19:28:46', 1),
(41, 'PORTAVAJILLA', '2023-08-03 19:29:05', 1),
(42, 'BOTELLA', '2023-08-03 19:42:19', 1),
(43, 'LIMPIAVIDRIO', '2023-08-03 19:43:03', 1),
(44, 'PAPELERA', '2023-08-03 19:46:01', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `identidad` varchar(50) NOT NULL,
  `num_identidad` varchar(15) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `direccion` varchar(255) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `identidad`, `num_identidad`, `nombre`, `telefono`, `correo`, `direccion`, `fecha`, `estado`) VALUES
(1, 'DNI', '41758696', 'Guillermo Vera Montes', '925812547', 'guillermo@gmail.com', '<p>Lima</p>', '2023-08-12 22:26:21', 1),
(2, 'DNI', '74586395', 'Julián Morales Vita', '915423345', 'julian@gmail.com', '<p>Lima</p>', '2023-08-12 22:26:02', 1),
(3, 'DNI', '42586385', 'Elena Milla Sifuentes', '32423432', 'elena@gmail.com', '<p>Lima</p>', '2023-08-12 22:26:13', 1),
(4, 'DNI', '32524152', 'Victoria Torres Camones', '954753852', 'victoria@gmail.com', '<p>Lima</p>', '2023-08-12 22:25:39', 1),
(5, 'DNI', '52418547', 'Juana Villavicencios Ramirez', '985471582', 'juana@gmail.com', '<p>Lima</p>', '2023-08-12 22:26:58', 1),
(6, 'DNI', '58741236', 'Marisol Rubina Huaraz', '985471236', 'marisol@gmail.com', '<p>Lima</p>', '2023-08-12 22:28:03', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `id` int(11) NOT NULL,
  `productos` longtext NOT NULL,
  `cantidad` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `serie` varchar(20) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `apertura` int(11) NOT NULL DEFAULT 1,
  `id_proveedor` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `compras`
--

INSERT INTO `compras` (`id`, `productos`, `cantidad`, `total`, `fecha`, `hora`, `serie`, `estado`, `apertura`, `id_proveedor`, `id_usuario`) VALUES
(2, 'BAÑERA BALLENITA FELIZ BASA', 1, '0.00', '2023-10-31', '12:10:32', '00000021', 1, 1, 1, 1),
(3, 'BAÑERA BALLENITA FELIZ BASA', 1, '0.00', '2023-10-31', '12:36:10', '00000022', 1, 1, 1, 1),
(4, 'TAPER REYWARE 1 KG', 1, '0.00', '2023-10-31', '12:37:01', '00000023', 1, 1, 1, 1),
(5, 'TAPER 1200 ML', 50, '0.00', '2023-10-31', '12:37:32', '00000024', 1, 1, 1, 1),
(6, 'TAPER REYWARE 1 KG', 9, '0.00', '2023-11-04', '18:24:42', '00000022', 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

CREATE TABLE `configuracion` (
  `id` int(11) NOT NULL,
  `ruc` varchar(15) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `telefono` varchar(50) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `direccion` text NOT NULL,
  `mensaje` text NOT NULL,
  `impuesto` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `configuracion`
--

INSERT INTO `configuracion` (`id`, `ruc`, `nombre`, `telefono`, `correo`, `direccion`, `mensaje`, `impuesto`) VALUES
(1, '20602895093', 'CASA DE LOS PLÁSTICOS', '918235459', 'mc@gmail.com', 'HUARAZ', '<p>GRACIAS POR SU PREFERENCIA...</p>', 18);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consolidado_tpi`
--

CREATE TABLE `consolidado_tpi` (
  `id` int(11) NOT NULL,
  `codigo` varchar(60) NOT NULL,
  `descripcion` varchar(60) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `resultado` decimal(10,2) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `consolidado_tpi`
--

INSERT INTO `consolidado_tpi` (`id`, `codigo`, `descripcion`, `fecha_inicio`, `fecha_fin`, `resultado`, `fecha`, `hora`, `estado`) VALUES
(1, 'MR-REY ', 'Taper Reyware 1 kg', '2023-05-01', '2023-07-07', '53.57', '2023-07-08', '09:00:00', 1),
(2, 'JE-BASA', 'Jarra electrica 2.5 litros', '2023-05-01', '2023-07-07', '49.84', '2023-07-08', '09:05:51', 1),
(3, 'BE-REY ', 'Banco everest 2 pasos', '2023-05-01', '2023-07-07', '40.23', '2023-07-08', '09:10:51', 1),
(4, 'RP-BASA', 'Rallador plastico', '2023-05-01', '2023-07-07', '40.91', '2023-07-08', '09:15:51', 1),
(5, 'MF-REY ', 'Matamosca floral ', '2023-05-01', '2023-07-07', '39.63', '2023-07-08', '09:20:51', 1),
(6, 'CS-REY ', 'Caja movil suprema # 40 ', '2023-05-01', '2023-07-07', '55.79', '2023-07-08', '09:25:51', 1),
(7, 'TU-UTIL', 'Taper 1200 ml', '2023-05-01', '2023-07-07', '49.11', '2023-07-08', '09:35:51', 1),
(8, 'DR-REY ', 'Despensero real gigante x 3 niveles con rueda', '2023-05-01', '2023-07-07', '56.14', '2023-07-08', '09:40:51', 1),
(9, 'CG-REY ', 'Cesto gaby con tapa', '2023-05-01', '2023-07-07', '48.72', '2023-07-08', '09:45:51', 1),
(10, 'CM-REY', 'Colador multiuso', '2023-05-01', '2023-07-07', '44.57', '2023-07-08', '09:50:51', 1),
(11, 'HC-REY ', 'Hisopo con base handy clean ', '2023-05-01', '2023-07-07', '51.92', '2023-07-08', '09:55:51', 1),
(12, 'RP-BASA', 'Rallador plastico', '2023-05-01', '2023-07-07', '42.92', '2023-07-08', '10:00:51', 1),
(13, 'BS-REY ', 'Bandeja snak', '2023-05-01', '2023-07-07', '43.90', '2023-07-08', '10:05:51', 1),
(14, 'PF-REY ', 'Portacepillo familiar', '2023-05-01', '2023-07-07', '41.47', '2023-07-08', '10:10:51', 1),
(15, 'EH-REY ', 'Envase hermetico 1.5 litros con rosca', '2023-05-01', '2023-07-07', '56.67', '2023-07-08', '10:15:51', 1),
(16, 'TM-DAYR', 'Trapeador microfibra ', '2023-05-01', '2023-07-07', '57.62', '2023-07-08', '10:20:51', 1),
(17, 'TB-DAYR', 'Tapete bienvenido ', '2023-05-01', '2023-07-07', '39.88', '2023-07-08', '10:25:51', 1),
(18, 'BF-BASA', 'Bañera ballenita feliz basa', '2023-05-01', '2023-07-07', '35.57', '2023-07-08', '10:30:51', 1),
(19, 'CD-BOTI', 'Condimentero', '2023-05-01', '2023-07-07', '48.31', '2023-07-08', '10:35:51', 1),
(20, 'TT-KING', 'Tetera', '2023-05-01', '2023-07-07', '42.66', '2023-07-08', '10:40:51', 1),
(21, 'AJ-REY ', 'Ajicero', '2023-05-01', '2023-07-07', '53.83', '2023-07-08', '10:45:51', 1),
(22, 'FR-REY ', 'Frasco repostero practico 4 litro', '2023-05-01', '2023-07-07', '41.39', '2023-07-08', '10:50:51', 1),
(23, 'PL-REY ', 'Portarollo de luxe', '2023-05-01', '2023-07-07', '50.10', '2023-07-08', '10:55:51', 1),
(24, 'ER-COS ', 'Espejo rose ', '2023-05-01', '2023-07-07', '45.07', '2023-07-08', '11:00:51', 1),
(25, 'AA-REY ', 'Azucarero acrilico', '2023-05-01', '2023-07-07', '58.82', '2023-07-08', '11:05:51', 1),
(26, 'NP-REY ', 'Neceser nadine portatil ', '2023-05-01', '2023-07-07', '30.09', '2023-07-08', '11:10:51', 1),
(27, 'RF-UTIL', 'Repostero frances #10', '2023-05-01', '2023-07-07', '37.07', '2023-07-08', '11:15:51', 1),
(28, 'JT-REY ', 'Jarra tropical 4.5 lt ', '2023-05-01', '2023-07-07', '35.59', '2023-07-08', '11:20:51', 1),
(29, 'MF-REY ', 'Maceta dura fashion #6', '2023-05-01', '2023-07-07', '39.08', '2023-07-08', '11:25:51', 1),
(30, 'PM-REY ', 'Paño microfibra ', '2023-05-01', '2023-07-07', '53.93', '2023-07-08', '11:30:51', 1),
(31, 'MR-REY ', 'Silla moderna caoba', '2023-05-01', '2023-07-07', '54.58', '2023-07-08', '11:35:51', 1),
(32, 'JE-BASA', 'Mesa redonda caral ', '2023-05-01', '2023-07-07', '30.38', '2023-07-08', '11:40:51', 1),
(33, 'BE-REY ', 'Set trapeador escurridor gigante magico', '2023-05-01', '2023-07-07', '30.07', '2023-07-08', '11:45:51', 1),
(34, 'RP-BASA', 'Esquinero con gabetero', '2023-05-01', '2023-07-07', '41.21', '2023-07-08', '11:50:51', 1),
(35, 'MF-REY ', 'PVC Bath mat ovalado - baño ', '2023-05-01', '2023-07-07', '42.36', '2023-07-08', '11:55:51', 1),
(36, 'CS-REY ', 'Escoba súper chinita', '2023-05-01', '2023-07-07', '43.70', '2023-07-08', '12:00:51', 1),
(37, 'TU-UTIL', 'Caja cosechera 40 LT', '2023-05-01', '2023-07-07', '43.61', '2023-07-08', '12:05:51', 1),
(38, 'DR-REY ', 'Batea', '2023-05-04', '2023-07-07', '47.89', '2023-07-08', '12:10:51', 1),
(39, 'CG-REY ', 'Super cubierto cuchara', '2023-05-01', '2023-07-07', '55.09', '2023-07-08', '12:10:51', 1),
(40, 'CM-REY ', 'Bolos buen hogar con tapa juego x 4', '2023-05-01', '2023-07-07', '59.35', '2023-07-08', '12:15:51', 1),
(41, 'CT-REY ', 'Canastilla tavarua modelo ratan', '2023-05-01', '2023-07-07', '58.76', '2023-07-08', '12:20:51', 1),
(42, 'SH-BASA', 'Sorbetero hawaiano- kalidad ', '2023-05-01', '2023-07-07', '49.63', '2023-07-08', '12:25:51', 1),
(43, 'US-REY ', 'Utilitario salsa', '2023-05-01', '2023-07-07', '60.05', '2023-07-08', '12:30:51', 1),
(44, 'TH-BASA', 'Taper hermetic 1.1 litros con valvula ', '2023-05-01', '2023-07-07', '56.48', '2023-07-08', '12:35:51', 1),
(45, 'PM-REY ', 'Portavajilla grande mistura', '2023-05-01', '2023-07-07', '48.12', '2023-07-08', '12:40:51', 1),
(46, 'JR-REY ', 'Jarra Reyware 1 LT', '2023-05-01', '2023-07-07', '51.97', '2023-07-08', '12:45:51', 1),
(47, 'BT-BASA', 'Botella tritan 830 ml', '2023-05-01', '2023-07-07', '58.20', '2023-07-08', '12:50:51', 1),
(48, 'LI-HUDE', 'Limpiavidrios industrial', '2023-05-01', '2023-07-07', '48.63', '2023-07-08', '12:55:51', 1),
(49, 'PC-REY ', 'Papelera automatica clin', '2023-05-01', '2023-07-07', '55.16', '2023-07-08', '13:00:51', 1),
(50, 'LI-COAS', 'Limosnero', '2023-05-01', '2023-07-07', '56.18', '2023-07-08', '13:05:51', 1),
(51, 'MR-REY ', 'Taper Reyware 1 kg', '2023-07-10', '2023-09-12', '72.67', '2023-09-13', '09:00:00', 1),
(52, 'JE-BASA', 'Jarra electrica 2.5 litros', '2023-07-10', '2023-09-12', '64.81', '2023-09-13', '09:05:51', 1),
(53, 'BE-REY ', 'Banco everest 2 pasos', '2023-07-10', '2023-09-12', '60.48', '2023-09-13', '09:10:51', 1),
(54, 'RP-BASA', 'Rallador plastico', '2023-07-10', '2023-09-12', '63.35', '2023-09-13', '09:15:51', 1),
(55, 'MF-REY ', 'Matamosca floral ', '2023-07-10', '2023-09-12', '62.99', '2023-09-13', '09:20:51', 1),
(56, 'CS-REY ', 'Caja movil suprema # 40 ', '2023-07-10', '2023-09-12', '66.27', '2023-09-13', '09:25:51', 1),
(57, 'TU-UTIL', 'Taper 1200 ml', '2023-07-10', '2023-09-12', '61.93', '2023-09-13', '09:35:51', 1),
(58, 'DR-REY ', 'Despensero real gigante x 3 niveles con rueda', '2023-07-10', '2023-09-12', '83.33', '2023-09-13', '09:40:51', 1),
(59, 'CG-REY ', 'Cesto gaby con tapa', '2023-07-10', '2023-09-12', '78.13', '2023-09-13', '09:45:51', 1),
(60, 'CM-REY', 'Colador multiuso', '2023-07-10', '2023-09-12', '70.68', '2023-09-13', '09:50:51', 1),
(61, 'HC-REY ', 'Hisopo con base handy clean ', '2023-07-10', '2023-09-12', '79.32', '2023-09-13', '09:55:51', 1),
(62, 'RP-BASA', 'Rallador plastico', '2023-07-10', '2023-09-12', '71.23', '2023-09-13', '10:00:51', 1),
(63, 'BS-REY ', 'Bandeja snak', '2023-07-10', '2023-09-12', '66.21', '2023-09-13', '10:05:51', 1),
(64, 'PF-REY ', 'Portacepillo familiar', '2023-07-10', '2023-09-12', '67.36', '2023-09-13', '10:10:51', 1),
(65, 'EH-REY ', 'Envase hermetico 1.5 litros con rosca', '2023-07-10', '2023-09-12', '75.14', '2023-09-13', '10:15:51', 1),
(66, 'TM-DAYR', 'Trapeador microfibra ', '2023-07-10', '2023-09-12', '57.42', '2023-09-13', '10:20:51', 1),
(67, 'TB-DAYR', 'Tapete bienvenido ', '2023-07-10', '2023-09-12', '56.55', '2023-09-13', '10:25:51', 1),
(68, 'BF-BASA', 'Bañera ballenita feliz basa', '2023-07-10', '2023-09-12', '67.94', '2023-09-13', '10:30:51', 1),
(69, 'CD-BOTI', 'Condimentero', '2023-07-10', '2023-09-12', '70.06', '2023-09-13', '10:35:51', 1),
(70, 'TT-KING', 'Tetera', '2023-07-10', '2023-09-12', '76.67', '2023-09-13', '10:40:51', 1),
(71, 'AJ-REY ', 'Ajicero', '2023-07-10', '2023-09-12', '76.13', '2023-09-13', '10:45:51', 1),
(72, 'FR-REY ', 'Frasco repostero practico 4 litro', '2023-07-10', '2023-09-12', '70.87', '2023-09-13', '10:50:51', 1),
(73, 'PL-REY ', 'Portarollo de luxe', '2023-07-10', '2023-09-12', '75.53', '2023-09-13', '10:55:51', 1),
(74, 'ER-COS ', 'Espejo rose ', '2023-07-10', '2023-09-12', '72.68', '2023-09-13', '11:00:51', 1),
(75, 'AA-REY ', 'Azucarero acrilico', '2023-07-10', '2023-09-12', '76.48', '2023-09-13', '11:05:51', 1),
(76, 'NP-REY ', 'Neceser nadine portatil ', '2023-07-10', '2023-09-12', '68.40', '2023-09-13', '11:10:51', 1),
(77, 'RF-UTIL', 'Repostero frances #10', '2023-07-10', '2023-09-12', '71.85', '2023-09-13', '11:15:51', 1),
(78, 'JT-REY ', 'Jarra tropical 4.5 lt ', '2023-07-10', '2023-09-12', '72.86', '2023-09-13', '11:20:51', 1),
(79, 'MF-REY ', 'Maceta dura fashion #6', '2023-07-10', '2023-09-12', '77.42', '2023-09-13', '11:25:51', 1),
(80, 'PM-REY ', 'Paño microfibra ', '2023-07-10', '2023-09-12', '65.11', '2023-09-13', '11:30:51', 1),
(81, 'MR-REY ', 'Silla moderna caoba', '2023-07-10', '2023-09-12', '73.83', '2023-09-13', '11:35:51', 1),
(82, 'JE-BASA', 'Mesa redonda caral ', '2023-07-10', '2023-09-12', '72.05', '2023-09-13', '11:40:51', 1),
(83, 'BE-REY ', 'Set trapeador escurridor gigante magico', '2023-07-10', '2023-09-12', '67.09', '2023-09-13', '11:45:51', 1),
(84, 'RP-BASA', 'Esquinero con gabetero', '2023-07-10', '2023-09-12', '78.45', '2023-09-13', '11:50:51', 1),
(85, 'MF-REY ', 'PVC Bath mat ovalado - baño ', '2023-07-10', '2023-09-12', '73.92', '2023-09-13', '11:55:51', 1),
(86, 'CS-REY ', 'Escoba súper chinita', '2023-07-10', '2023-09-12', '82.02', '2023-09-13', '12:00:51', 1),
(87, 'TU-UTIL', 'Caja cosechera 40 LT', '2023-07-10', '2023-09-12', '76.30', '2023-09-13', '12:05:51', 1),
(88, 'DR-REY ', 'Batea', '2023-07-10', '2023-09-12', '83.10', '2023-09-13', '12:10:51', 1),
(89, 'CG-REY ', 'Super cubierto cuchara', '2023-07-10', '2023-09-12', '69.27', '2023-09-13', '12:10:51', 1),
(90, 'CM-REY ', 'Bolos buen hogar con tapa juego x 4', '2023-07-10', '2023-09-12', '83.33', '2023-09-13', '12:15:51', 1),
(91, 'CT-REY ', 'Canastilla tavarua modelo ratan', '2023-07-10', '2023-09-12', '77.63', '2023-09-13', '12:20:51', 1),
(92, 'SH-BASA', 'Sorbetero hawaiano- kalidad ', '2023-07-10', '2023-09-12', '62.59', '2023-09-13', '12:25:51', 1),
(93, 'US-REY ', 'Utilitario salsa', '2023-07-10', '2023-09-12', '82.88', '2023-09-13', '12:30:51', 1),
(94, 'TH-BASA', 'Taper hermetic 1.1 litros con valvula ', '2023-07-10', '2023-09-12', '74.37', '2023-09-13', '12:35:51', 1),
(95, 'PM-REY ', 'Portavajilla grande mistura', '2023-07-10', '2023-09-12', '76.36', '2023-09-13', '12:40:51', 1),
(96, 'JR-REY ', 'Jarra Reyware 1 LT', '2023-07-10', '2023-09-12', '80.52', '2023-09-13', '12:45:51', 1),
(97, 'BT-BASA', 'Botella tritan 830 ml', '2023-07-10', '2023-09-12', '76.15', '2023-09-13', '12:50:51', 1),
(98, 'LI-HUDE', 'Limpiavidrios industrial', '2023-07-10', '2023-09-12', '81.99', '2023-09-13', '12:55:51', 1),
(99, 'PC-REY ', 'Papelera automatica clin', '2023-07-10', '2023-09-12', '83.56', '2023-09-13', '13:00:51', 1),
(100, 'LI-COAS', 'Limosnero', '2023-07-10', '2023-09-12', '83.14', '2023-09-13', '13:05:51', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cotizaciones`
--

CREATE TABLE `cotizaciones` (
  `id` int(11) NOT NULL,
  `productos` longtext NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `metodo` varchar(20) NOT NULL,
  `validez` varchar(30) NOT NULL,
  `descuento` decimal(10,2) NOT NULL DEFAULT 0.00,
  `id_cliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `creditos`
--

CREATE TABLE `creditos` (
  `id` int(11) NOT NULL,
  `monto` decimal(10,2) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `id_venta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `creditos`
--

INSERT INTO `creditos` (`id`, `monto`, `fecha`, `hora`, `estado`, `id_venta`) VALUES
(1, '5800.00', '2022-09-23', '17:31:54', 2, 2),
(2, '5800.00', '2022-09-23', '18:00:21', 0, 4),
(3, '25.00', '2023-04-11', '08:58:05', 0, 23),
(4, '50.00', '2023-04-11', '09:35:36', 0, 24),
(5, '10.00', '2023-04-11', '09:37:02', 0, 25);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_apartado`
--

CREATE TABLE `detalle_apartado` (
  `id` int(11) NOT NULL,
  `monto` decimal(10,2) NOT NULL,
  `fecha` datetime NOT NULL,
  `apertura` int(11) NOT NULL DEFAULT 1,
  `id_apartado` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detalle_apartado`
--

INSERT INTO `detalle_apartado` (`id`, `monto`, `fecha`, `apertura`, `id_apartado`, `id_usuario`) VALUES
(1, '5800.00', '0000-00-00 00:00:00', 0, 1, 1),
(2, '29000.00', '0000-00-00 00:00:00', 0, 2, 1),
(3, '6.00', '0000-00-00 00:00:00', 1, 3, 1),
(4, '5.00', '0000-00-00 00:00:00', 1, 4, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gastos`
--

CREATE TABLE `gastos` (
  `id` int(11) NOT NULL,
  `monto` decimal(10,2) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `foto` varchar(150) DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `apertura` int(11) NOT NULL DEFAULT 1,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `gastos`
--

INSERT INTO `gastos` (`id`, `monto`, `descripcion`, `foto`, `fecha`, `apertura`, `id_usuario`) VALUES
(1, '50.00', '<p>PAGO DE LUZ Y AGUA</p>', 'assets/images/gastos/20220923165012.jpg', '2022-09-24 15:30:41', 0, 1),
(2, '150.00', '<p>RECIBO DE LUZ</p>', NULL, '2022-09-24 15:35:38', 1, 1),
(3, '800.00', '<p>RENTA DE LA CASA</p>', NULL, '2022-09-24 20:41:24', 1, 1),
(4, '8500.00', '<p>SIN DESCRIPCION</p>', NULL, '2022-09-24 20:41:59', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_cantidad`
--

CREATE TABLE `historial_cantidad` (
  `codigo` varchar(60) NOT NULL,
  `descripcion` varchar(60) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `historial_cantidad`
--

INSERT INTO `historial_cantidad` (`codigo`, `descripcion`, `cantidad`, `fecha`, `hora`) VALUES
('TP-REY', 'TAPER REYWARE 1 KG', 300, '2023-10-27', '12:15:45'),
('000000018', 'BAÑERA BALLENITA FELIZ BASA', 0, '2023-09-15', '00:00:00'),
('000000018', 'BAÑERA BALLENITA FELIZ BASA', 1, '2023-09-15', '00:00:00'),
('000000018', 'BAÑERA BALLENITA FELIZ BASA', 1, '2023-09-15', '00:00:00'),
('000000018', 'BAÑERA BALLENITA FELIZ BASA', 1, '2023-09-15', '00:00:00'),
('TP-REY', 'TAPER REYWARE 1 KG', 250, '2023-10-27', '12:15:45'),
('T-UTILIT', 'TAPER 1200 ML', 0, '2023-10-07', '00:00:00'),
('T-UTILIT', 'TAPER 1200 ML', 50, '2023-10-07', '00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `id` int(11) NOT NULL,
  `movimiento` varchar(100) NOT NULL,
  `accion` varchar(20) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `stock_actual` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_producto` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `inventario`
--

INSERT INTO `inventario` (`id`, `movimiento`, `accion`, `cantidad`, `stock_actual`, `fecha`, `id_producto`, `id_usuario`) VALUES
(1, 'Venta N°: 1', 'Entrada', 2, -2, '2022-09-23 22:30:47', 1, 1),
(2, 'Venta N°: 2', 'Entrada', 1, -3, '2022-09-23 22:31:54', 1, 1),
(3, 'Venta N°: 3', 'Entrada', 3, -6, '2022-09-23 22:41:05', 1, 1),
(4, 'Devolución de Venta N°: 1', 'Entrada', 2, -4, '2022-09-23 22:46:08', 1, 1),
(5, 'Devolución de Venta N°: 2', 'Entrada', 1, 51, '2022-09-23 22:54:51', 1, 1),
(6, 'Venta N°: 4', 'Entrada', 1, 50, '2022-09-23 23:00:21', 1, 1),
(7, 'Apartado N°: 1', 'Salida', 1, 49, '2022-09-24 15:06:34', 1, 1),
(8, 'Apartado N°: 2', 'Salida', 5, 44, '2022-09-24 15:12:25', 1, 1),
(9, 'Venta N°: 5', 'Entrada', 46, -2, '2022-09-24 15:34:13', 1, 1),
(10, 'Compra N°: 1', 'Entrada', 1, -1, '2022-09-24 15:34:54', 1, 1),
(11, 'Ajuste de Inventario: Entrada', 'Entrada', 150, 149, '2022-09-24 15:42:09', 1, 1),
(12, 'Ajuste de Inventario: Entrada', 'Entrada', 5, 154, '2022-09-24 15:42:51', 1, 1),
(13, 'Apartado N°: 3', 'Salida', 1, 9, '2022-10-20 17:51:52', 1, 1),
(14, 'Compra N°: 2', 'Entrada', 25, 25, '2023-03-10 18:19:59', 3, 1),
(15, 'Venta N°: 6', 'Entrada', 3, 2, '2023-03-11 20:41:02', 1, 1),
(16, 'Venta N°: 6', 'Entrada', 3, 22, '2023-03-11 20:41:02', 3, 1),
(17, 'Venta N°: 7', 'Entrada', 2, 0, '2023-03-11 20:45:19', 1, 1),
(18, 'Venta N°: 7', 'Entrada', 2, 20, '2023-03-11 20:45:19', 3, 1),
(19, 'Venta N°: 8', 'Entrada', 2, -2, '2023-03-11 20:45:50', 1, 1),
(20, 'Venta N°: 8', 'Entrada', 2, 18, '2023-03-11 20:45:50', 3, 1),
(21, 'Venta N°: 9', 'Entrada', 1, 17, '2023-03-11 20:49:31', 3, 1),
(22, 'Venta N°: 10', 'Entrada', 1, 16, '2023-03-11 20:49:40', 3, 1),
(23, 'Compra N°: 3', 'Entrada', 5, 55, '2023-03-11 20:52:06', 1, 1),
(24, 'Venta N°: 11', 'Entrada', 1, 54, '2023-03-11 20:55:18', 1, 1),
(25, 'Venta N°: 12', 'Entrada', 1, 53, '2023-03-11 20:56:12', 1, 1),
(26, 'Venta N°: 13', 'Entrada', 1, 15, '2023-03-11 20:57:00', 3, 1),
(27, 'Venta N°: 13', 'Entrada', 1, 52, '2023-03-11 20:57:00', 1, 1),
(28, 'Apartado N°: 4', 'Salida', 2, 50, '2023-03-11 21:09:18', 1, 1),
(29, 'Venta N°: 14', 'Entrada', 1, 49, '2023-03-25 19:05:27', 1, 1),
(30, 'Venta N°: 14', 'Entrada', 1, 14, '2023-03-25 19:05:27', 3, 1),
(31, 'Venta N°: 15', 'Entrada', 2, 12, '2023-03-25 19:42:33', 3, 1),
(32, 'Venta N°: 15', 'Entrada', 1, 48, '2023-03-25 19:42:33', 1, 1),
(33, 'Venta N°: 16', 'Entrada', 3, 9, '2023-03-25 20:05:29', 3, 1),
(34, 'Venta N°: 16', 'Entrada', 1, 47, '2023-03-25 20:05:29', 1, 1),
(35, 'Venta N°: 17', 'Entrada', 1, 46, '2023-03-25 20:11:37', 1, 1),
(36, 'Venta N°: 17', 'Entrada', 1, 8, '2023-03-25 20:11:37', 3, 1),
(37, 'Venta N°: 18', 'Entrada', 1, 45, '2023-03-25 20:20:08', 1, 1),
(38, 'Venta N°: 18', 'Entrada', 1, 7, '2023-03-25 20:20:08', 3, 1),
(39, 'Venta N°: 19', 'Entrada', 1, 44, '2023-03-25 20:31:25', 1, 1),
(40, 'Venta N°: 19', 'Entrada', 1, 6, '2023-03-25 20:31:25', 3, 1),
(41, 'Venta N°: 20', 'Entrada', 1, 43, '2023-03-25 20:38:43', 1, 1),
(42, 'Venta N°: 20', 'Entrada', 3, 3, '2023-03-25 20:38:43', 3, 1),
(43, 'Venta N°: 21', 'Entrada', 2, 41, '2023-03-25 20:42:05', 1, 1),
(44, 'Venta N°: 21', 'Entrada', 2, 1, '2023-03-25 20:42:05', 3, 1),
(45, 'Venta N°: 22', 'Entrada', 1, 40, '2023-03-25 20:43:04', 1, 1),
(46, 'Venta N°: 22', 'Entrada', 1, 0, '2023-03-25 20:43:04', 3, 1),
(47, 'Venta N°: 23', 'Entrada', 5, 35, '2023-04-11 13:58:05', 1, 1),
(48, 'Venta N°: 24', 'Entrada', 10, 25, '2023-04-11 14:35:36', 1, 1),
(49, 'Venta N°: 25', 'Entrada', 2, 23, '2023-04-11 14:37:02', 1, 1),
(50, 'Venta N°: 26', 'Entrada', 6, 17, '2023-04-11 15:09:22', 1, 1),
(51, 'Compra N°: 4', 'Entrada', 1, 1, '2023-08-04 19:23:20', 14, 1),
(52, 'Compra N°: 5', 'Entrada', 1, 1, '2023-08-04 19:24:28', 8, 1),
(53, 'Compra N°: 6', 'Entrada', 1, 2, '2023-08-04 19:25:35', 8, 1),
(54, 'Compra N°: 6', 'Entrada', 1, 1, '2023-08-04 19:25:35', 15, 1),
(55, 'Compra N°: 6', 'Entrada', 1, 1, '2023-08-04 19:25:35', 18, 1),
(56, 'Compra N°: 6', 'Entrada', 1, 1, '2023-08-04 19:25:35', 40, 1),
(57, 'Venta N°: 27', 'Entrada', 1, 0, '2023-09-15 20:00:49', 18, 1),
(58, 'Venta N°: 28', 'Entrada', 1, 99, '2023-09-15 20:03:45', 1, 1),
(59, 'Venta N°: 1', 'Entrada', 1, 98, '2023-09-15 20:05:45', 1, 1),
(60, 'Venta N°: 2', 'Entrada', 1, 97, '2023-09-15 20:06:47', 1, 1),
(61, 'Venta N°: 3', 'Entrada', 1, 96, '2023-09-15 20:09:45', 1, 1),
(62, 'Venta N°: 4', 'Entrada', 1, 95, '2023-09-15 20:15:46', 1, 1),
(63, 'Venta N°: 5', 'Entrada', 1, 94, '2023-09-15 20:32:01', 1, 1),
(64, 'Venta N°: 6', 'Entrada', 1, 93, '2023-09-15 20:33:10', 1, 1),
(65, 'Venta N°: 7', 'Entrada', 1, 92, '2023-09-15 20:34:30', 1, 1),
(66, 'Venta N°: 8', 'Entrada', 1, 91, '2023-09-15 20:37:41', 1, 1),
(67, 'Venta N°: 9', 'Entrada', 1, 90, '2023-09-15 20:38:36', 1, 1),
(68, 'Venta N°: 10', 'Entrada', 1, 89, '2023-09-15 20:39:36', 1, 1),
(69, 'Venta N°: 11', 'Entrada', 1, 88, '2023-09-15 20:40:09', 1, 1),
(70, 'Venta N°: 12', 'Entrada', 1, 87, '2023-09-15 20:40:47', 1, 1),
(71, 'Venta N°: 13', 'Entrada', 1, 86, '2023-09-15 20:41:20', 1, 1),
(72, 'Venta N°: 14', 'Entrada', 1, 85, '2023-09-15 20:42:16', 1, 1),
(73, 'Venta N°: 15', 'Entrada', 1, 84, '2023-09-15 20:43:02', 1, 1),
(74, 'Venta N°: 16', 'Entrada', 1, 83, '2023-09-15 20:43:36', 1, 1),
(75, 'Venta N°: 17', 'Entrada', 5, 78, '2023-09-15 20:55:55', 1, 1),
(76, 'Venta N°: 18', 'Entrada', 1, 77, '2023-09-23 21:21:35', 1, 1),
(77, 'Venta N°: 19', 'Entrada', 1, -1, '2023-10-12 17:21:08', 3, 1),
(78, 'Venta N°: 20', 'Entrada', 1, 76, '2023-10-12 17:23:45', 1, 1),
(79, 'Venta N°: 21', 'Entrada', 6, 70, '2023-10-12 17:24:16', 1, 1),
(80, 'Venta N°: 22', 'Salida', 10, 60, '2023-10-12 17:26:58', 1, 1),
(81, 'Pedido N°: 23', 'Salida', 10, 50, '2023-10-12 17:28:11', 1, 1),
(82, 'Ingreso N°: 7', 'Entrada', 1, 51, '2023-10-12 17:37:55', 1, 1),
(83, 'Ingreso N°: 8', 'Entrada', 9, 60, '2023-10-12 17:38:48', 1, 1),
(84, 'Pedido N°: 24', 'Salida', 1, 99, '2023-10-12 20:54:40', 52, 1),
(85, 'Pedido N°: 25', 'Salida', 9, 90, '2023-10-12 21:00:07', 52, 1),
(86, 'Pedido N°: 26', 'Salida', 10, 80, '2023-10-12 21:01:06', 52, 1),
(87, 'Pedido N°: 27', 'Salida', 70, 10, '2023-10-12 21:03:50', 52, 1),
(88, 'Ingreso N°: 2', 'Entrada', 50, 350, '2023-10-29 01:41:51', 1, 1),
(89, 'Pedido N°: 1', 'Salida', 50, 300, '2023-10-29 01:42:48', 1, 1),
(90, 'Pedido N°: 1', 'Salida', 50, 250, '2023-10-29 01:46:30', 1, 1),
(91, 'Ingreso N°: 2', 'Entrada', 1, 1, '2023-10-31 17:10:32', 18, 1),
(92, 'Ingreso N°: 3', 'Entrada', 1, 2, '2023-10-31 17:36:10', 18, 1),
(93, 'Ingreso N°: 4', 'Entrada', 1, 251, '2023-10-31 17:37:01', 1, 1),
(94, 'Ingreso N°: 5', 'Entrada', 50, 50, '2023-10-31 17:37:32', 7, 1),
(95, 'Ingreso N°: 6', 'Entrada', 9, 260, '2023-11-04 23:24:42', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `irs`
--

CREATE TABLE `irs` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(38) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `resultado` decimal(10,2) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `irs`
--

INSERT INTO `irs` (`id`, `descripcion`, `fecha_inicio`, `fecha_fin`, `resultado`, `fecha`, `hora`, `estado`) VALUES
(1, 'Taper Reyware 1 kg', '2023-05-01', '2023-07-07', '5.75', '2023-07-08', '09:00:00', 1),
(2, 'Jarra electrica 2.5 litros', '2023-05-01', '2023-07-07', '9.68', '2023-07-08', '09:05:51', 1),
(3, 'Banco everest 2 pasos', '2023-05-01', '2023-07-07', '7.74', '2023-07-08', '09:10:51', 1),
(4, 'Rallador plastico', '2023-05-01', '2023-07-07', '10.20', '2023-07-08', '09:15:51', 1),
(5, 'Matamosca floral ', '2023-05-01', '2023-07-07', '8.91', '2023-07-08', '09:20:51', 1),
(6, 'Caja movil suprema # 40 ', '2023-05-01', '2023-07-07', '4.82', '2023-07-08', '09:25:51', 1),
(7, 'Taper 1200 ml', '2023-05-01', '2023-07-07', '7.04', '2023-07-08', '09:35:51', 1),
(8, 'Despensero real gigante x 3 niveles co', '2023-05-01', '2023-07-07', '3.92', '2023-07-08', '09:40:51', 1),
(9, 'Cesto gaby con tapa', '2023-05-01', '2023-07-07', '4.76', '2023-07-08', '09:45:51', 1),
(10, 'Colador multiuso', '2023-05-01', '2023-07-07', '7.10', '2023-07-08', '09:50:51', 1),
(11, 'Hisopo con base handy clean ', '2023-05-01', '2023-07-07', '4.93', '2023-07-08', '09:55:51', 1),
(12, 'Rallador plastico', '2023-05-01', '2023-07-07', '8.12', '2023-07-08', '10:00:51', 1),
(13, 'Bandeja snak', '2023-05-01', '2023-07-07', '9.79', '2023-07-08', '10:05:51', 1),
(14, 'Portacepillo familiar', '2023-05-01', '2023-07-07', '10.44', '2023-07-08', '10:10:51', 1),
(15, 'Envase hermetico 1.5 litros con rosca', '2023-05-01', '2023-07-07', '4.50', '2023-07-08', '10:15:51', 1),
(16, 'Trapeador microfibra ', '2023-05-01', '2023-07-07', '6.17', '2023-07-08', '10:20:51', 1),
(17, 'Tapete bienvenido ', '2023-05-01', '2023-07-07', '8.50', '2023-07-08', '10:25:51', 1),
(18, 'Bañera ballenita feliz basa', '2023-05-01', '2023-07-07', '6.55', '2023-07-08', '10:30:51', 1),
(19, 'Condimentero', '2023-05-01', '2023-07-07', '9.33', '2023-07-08', '10:35:51', 1),
(20, 'Tetera', '2023-05-01', '2023-07-07', '6.91', '2023-07-08', '10:40:51', 1),
(21, 'Ajicero', '2023-05-01', '2023-07-07', '5.75', '2023-07-08', '10:45:51', 1),
(22, 'Frasco repostero practico 4 litro', '2023-05-01', '2023-07-07', '11.33', '2023-07-08', '10:50:51', 1),
(23, 'Portarollo de luxe', '2023-05-01', '2023-07-07', '6.12', '2023-07-08', '10:55:51', 1),
(24, 'Espejo rose ', '2023-05-01', '2023-07-07', '8.25', '2023-07-08', '11:00:51', 1),
(25, 'Azucarero acrilico', '2023-05-01', '2023-07-07', '4.45', '2023-07-08', '11:05:51', 1),
(26, 'Neceser nadine portatil ', '2023-05-01', '2023-07-07', '8.63', '2023-07-08', '11:10:51', 1),
(27, 'Repostero frances #10', '2023-05-01', '2023-07-07', '10.50', '2023-07-08', '11:15:51', 1),
(28, 'Jarra tropical 4.5 lt ', '2023-05-01', '2023-07-07', '12.12', '2023-07-08', '11:20:51', 1),
(29, 'Maceta dura fashion #6', '2023-05-01', '2023-07-07', '9.20', '2023-07-08', '11:25:51', 1),
(30, 'Paño microfibra ', '2023-05-01', '2023-07-07', '7.42', '2023-07-08', '11:30:51', 1),
(31, 'Silla moderna caoba', '2023-05-01', '2023-07-07', '7.47', '2023-07-08', '11:35:51', 1),
(32, 'Mesa redonda caral ', '2023-05-01', '2023-07-07', '9.15', '2023-07-08', '11:40:51', 1),
(33, 'Set trapeador escurridor gigante magic', '2023-05-01', '2023-07-07', '13.30', '2023-07-08', '11:45:51', 1),
(34, 'Esquinero con gabetero', '2023-05-01', '2023-07-07', '7.52', '2023-07-08', '11:50:51', 1),
(35, 'PVC Bath mat ovalado - baño ', '2023-05-01', '2023-07-07', '10.38', '2023-07-08', '11:55:51', 1),
(36, 'Escoba súper chinita', '2023-05-01', '2023-07-07', '4.77', '2023-07-08', '12:00:51', 1),
(37, 'Caja cosechera 40 LT', '2023-05-01', '2023-07-07', '5.04', '2023-07-08', '12:05:51', 1),
(38, 'Batea', '2023-05-01', '2023-07-07', '4.60', '2023-07-08', '12:10:51', 1),
(39, 'Super cubierto cuchara', '2023-05-01', '2023-07-07', '8.10', '2023-07-08', '12:10:51', 1),
(40, 'Bolos buen hogar con tapa juego x 4', '2023-05-01', '2023-07-07', '3.65', '2023-07-08', '12:15:51', 1),
(41, 'Canastilla tavarua modelo ratan', '2023-05-01', '2023-07-07', '3.84', '2023-07-08', '12:20:51', 1),
(42, 'Sorbetero hawaiano- kalidad ', '2023-05-01', '2023-07-07', '6.00', '2023-07-08', '12:25:51', 1),
(43, 'Utilitario salsa', '2023-05-01', '2023-07-07', '3.16', '2023-07-08', '12:30:51', 1),
(44, 'Taper hermetic 1.1 litros con valvula ', '2023-05-01', '2023-07-07', '4.55', '2023-07-08', '12:35:51', 1),
(45, 'Portavajilla grande mistura', '2023-05-01', '2023-07-07', '5.57', '2023-07-08', '12:40:51', 1),
(46, 'Jarra Reyware 1 LT', '2023-05-01', '2023-07-07', '4.46', '2023-07-08', '12:45:51', 1),
(47, 'Botella tritan 830 ml', '2023-05-01', '2023-07-07', '3.93', '2023-07-08', '12:50:51', 1),
(48, 'Limpiavidrios industrial', '2023-05-01', '2023-07-07', '4.05', '2023-07-08', '12:55:51', 1),
(49, 'Papelera automatica clin', '2023-05-01', '2023-07-07', '3.09', '2023-07-08', '13:00:51', 1),
(50, 'Limosnero', '2023-05-01', '2023-07-07', '3.11', '2023-07-08', '13:05:51', 1),
(51, 'Taper Reyware 1 kg', '2023-07-10', '2023-09-18', '11.56', '2023-09-19', '09:00:00', 1),
(52, 'Jarra electrica 2.5 litros', '2023-07-10', '2023-09-18', '18.73', '2023-09-19', '09:05:51', 1),
(53, 'Banco everest 2 pasos', '2023-07-10', '2023-09-18', '15.08', '2023-09-19', '09:10:51', 1),
(54, 'Rallador plastico', '2023-07-10', '2023-09-18', '22.53', '2023-09-19', '09:15:51', 1),
(55, 'Matamosca floral ', '2023-07-10', '2023-09-18', '19.73', '2023-09-19', '09:20:51', 1),
(56, 'Caja movil suprema # 40 ', '2023-07-10', '2023-09-18', '11.74', '2023-09-19', '09:25:51', 1),
(57, 'Taper 1200 ml', '2023-07-10', '2023-09-18', '14.37', '2023-09-19', '09:35:51', 1),
(58, 'Despensero real gigante x 3 niveles co', '2023-07-10', '2023-09-18', '8.01', '2023-09-19', '09:40:51', 1),
(59, 'Cesto gaby con tapa', '2023-07-10', '2023-09-18', '9.94', '2023-09-19', '09:45:51', 1),
(60, 'Colador multiuso', '2023-07-10', '2023-09-18', '14.94', '2023-09-19', '09:50:51', 1),
(61, 'Hisopo con base handy clean ', '2023-07-10', '2023-09-18', '9.54', '2023-09-19', '09:55:51', 1),
(62, 'Rallador plastico', '2023-07-10', '2023-09-18', '17.00', '2023-09-19', '10:00:51', 1),
(63, 'Bandeja snak', '2023-07-10', '2023-09-18', '18.82', '2023-09-19', '10:05:51', 1),
(64, 'Portacepillo familiar', '2023-07-10', '2023-09-18', '15.81', '2023-09-19', '10:10:51', 1),
(65, 'Envase hermetico 1.5 litros con rosca', '2023-07-10', '2023-09-18', '9.73', '2023-09-19', '10:15:51', 1),
(66, 'Trapeador microfibra ', '2023-07-10', '2023-09-18', '12.45', '2023-09-19', '10:20:51', 1),
(67, 'Tapete bienvenido ', '2023-07-10', '2023-09-18', '12.26', '2023-09-19', '10:25:51', 1),
(68, 'Bañera ballenita feliz basa', '2023-07-10', '2023-09-18', '9.19', '2023-09-19', '10:30:51', 1),
(69, 'Condimentero', '2023-07-10', '2023-09-18', '19.45', '2023-09-19', '10:35:51', 1),
(70, 'Tetera', '2023-07-10', '2023-09-18', '10.97', '2023-09-19', '10:40:51', 1),
(71, 'Ajicero', '2023-07-10', '2023-09-18', '11.47', '2023-09-19', '10:45:51', 1),
(72, 'Frasco repostero practico 4 litro', '2023-07-10', '2023-09-18', '23.01', '2023-09-19', '10:50:51', 1),
(73, 'Portarollo de luxe', '2023-07-10', '2023-09-18', '12.11', '2023-09-19', '10:55:51', 1),
(74, 'Espejo rose ', '2023-07-10', '2023-09-18', '16.69', '2023-09-19', '11:00:51', 1),
(75, 'Azucarero acrilico', '2023-07-10', '2023-09-18', '9.15', '2023-09-19', '11:05:51', 1),
(76, 'Neceser nadine portatil ', '2023-07-10', '2023-09-18', '13.90', '2023-09-19', '11:10:51', 1),
(77, 'Repostero frances #10', '2023-07-10', '2023-09-18', '15.47', '2023-09-19', '11:15:51', 1),
(78, 'Jarra tropical 4.5 lt ', '2023-07-10', '2023-09-18', '17.52', '2023-09-19', '11:20:51', 1),
(79, 'Maceta dura fashion #6', '2023-07-10', '2023-09-18', '13.16', '2023-09-19', '11:25:51', 1),
(80, 'Paño microfibra ', '2023-07-10', '2023-09-18', '15.35', '2023-09-19', '11:30:51', 1),
(81, 'Silla moderna caoba', '2023-07-10', '2023-09-18', '15.57', '2023-09-19', '11:35:51', 1),
(82, 'Mesa redonda caral ', '2023-07-10', '2023-09-18', '13.49', '2023-09-19', '11:40:51', 1),
(83, 'Set trapeador escurridor gigante magic', '2023-07-10', '2023-09-18', '25.65', '2023-09-19', '11:45:51', 1),
(84, 'Esquinero con gabetero', '2023-07-10', '2023-09-18', '13.21', '2023-09-19', '11:50:51', 1),
(85, 'PVC Bath mat ovalado - baño ', '2023-07-10', '2023-09-18', '21.03', '2023-09-19', '11:55:51', 1),
(86, 'Escoba súper chinita', '2023-07-10', '2023-09-18', '9.37', '2023-09-19', '12:00:51', 1),
(87, 'Caja cosechera 40 LT', '2023-07-10', '2023-09-18', '9.74', '2023-09-19', '12:05:51', 1),
(88, 'Batea', '2023-07-10', '2023-09-18', '9.46', '2023-09-19', '12:10:51', 1),
(89, 'Super cubierto cuchara', '2023-07-10', '2023-09-18', '17.14', '2023-09-19', '12:10:51', 1),
(90, 'Bolos buen hogar con tapa juego x 4', '2023-07-10', '2023-09-18', '7.36', '2023-09-19', '12:15:51', 1),
(91, 'Canastilla tavarua modelo ratan', '2023-07-10', '2023-09-18', '7.82', '2023-09-19', '12:20:51', 1),
(92, 'Sorbetero hawaiano- kalidad ', '2023-07-10', '2023-09-18', '12.15', '2023-09-19', '12:25:51', 1),
(93, 'Utilitario salsa', '2023-07-10', '2023-09-18', '7.17', '2023-09-19', '12:30:51', 1),
(94, 'Taper hermetic 1.1 litros con valvula ', '2023-07-10', '2023-09-18', '10.05', '2023-09-19', '12:35:51', 1),
(95, 'Portavajilla grande mistura', '2023-07-10', '2023-09-18', '11.12', '2023-09-19', '12:40:51', 1),
(96, 'Jarra Reyware 1 LT', '2023-07-10', '2023-09-18', '9.11', '2023-09-19', '12:45:51', 1),
(97, 'Botella tritan 830 ml', '2023-07-10', '2023-09-18', '7.90', '2023-09-19', '12:50:51', 1),
(98, 'Limpiavidrios industrial', '2023-07-10', '2023-09-18', '8.33', '2023-09-19', '12:55:51', 1),
(99, 'Papelera automatica clin', '2023-07-10', '2023-09-18', '6.31', '2023-09-19', '13:00:51', 1),
(100, 'Limosnero', '2023-07-10', '2023-09-18', '6.49', '2023-09-19', '13:05:51', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medidas`
--

CREATE TABLE `medidas` (
  `id` int(11) NOT NULL,
  `medida` varchar(100) NOT NULL,
  `nombre_corto` varchar(10) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `medidas`
--

INSERT INTO `medidas` (`id`, `medida`, `nombre_corto`, `fecha`, `estado`) VALUES
(1, 'GRAMOS', 'GR', '2022-09-23 21:20:39', 1),
(2, 'KILOS', 'KL', '2022-09-23 21:21:26', 1),
(3, 'LITROS', 'LT', '2023-08-03 18:11:58', 1),
(4, 'tt', 'tt', '2023-08-03 18:05:52', 0),
(5, 'CENTÍMETRO', 'CM', '2023-08-03 19:45:09', 1),
(6, 'uuu', '2222', '2023-11-05 01:01:17', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesas`
--

CREATE TABLE `mesas` (
  `id` int(11) NOT NULL,
  `tiempo` varchar(50) NOT NULL,
  `monto` decimal(10,2) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `cliente` varchar(50) NOT NULL,
  `fecha` datetime NOT NULL,
  `mesa` varchar(30) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `mesas`
--

INSERT INTO `mesas` (`id`, `tiempo`, `monto`, `estado`, `cliente`, `fecha`, `mesa`, `id_cliente`, `id_usuario`) VALUES
(1, '30 MINUTOS', '3.00', 1, 'CLIENTE FRECUENTE', '2022-11-05 03:48:17', 'MESA 1', 1, 1);

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
(1, 'TP-REY', 'TAPER REYWARE 1 KG', '0.00', '0.00', 260, NULL, 1, '2023-10-27', '12:15:45', 150, 2, 3, 1, '00000001', 0, 0, 0),
(2, 'JE-BASA', 'JARRA ELÉCTRICA 2.5 LT', '0.00', '0.00', 0, NULL, 1, '2023-10-07', '00:00:00', 0, 3, 1, 1, '00000002', 0, 0, 0),
(3, 'BE-REY', 'BANCO EVEREST 2 PASOS', '0.00', '0.00', -1, NULL, 1, '2023-10-12', '00:00:00', 1, 1, 5, 1, '00000003', 0, 0, 0),
(4, 'RP-BASA', 'RALLADOR DE PLÁSTICO', '0.00', '0.00', 0, NULL, 1, '2023-10-07', '00:00:00', 0, 1, 7, 2, '00000004', 0, 0, 0),
(5, 'MF-REY', 'MATAMOSCA FLORAL', '0.00', '0.00', 0, NULL, 1, '2023-10-07', '00:00:00', 0, 1, 8, 1, '00000005', 0, 0, 0),
(6, 'CMS-REY', 'CAJA MÓVIL SUPREMA # 40', '0.00', '0.00', 0, NULL, 1, '2023-10-07', '00:00:00', 0, 3, 9, 1, '00000006', 0, 0, 0),
(7, 'T-UTILIT', 'TAPER 1200 ML', '0.00', '0.00', 0, NULL, 1, '2023-10-07', '00:00:00', 0, 3, 3, 3, '00000007', 0, 0, 0),
(8, 'DR-REY', 'DESPENSERO REAL GIGANTE * 3 NIVELES CON RUEDA', '0.00', '0.00', 2, NULL, 1, '2023-10-07', '00:00:00', 0, 2, 10, 1, '00000008', 0, 0, 0),
(9, 'CG-REY', 'CESTO GABY CON TAPA', '0.00', '0.00', 0, NULL, 1, '2023-10-07', '00:00:00', 0, 3, 11, 1, '00000009', 0, 0, 0),
(10, 'CM-REY', 'COLADOR MULTIUSO', '0.00', '0.00', 0, NULL, 1, '2023-10-07', '00:00:00', 0, 3, 12, 1, '000000010', 0, 0, 0),
(11, 'HC-DAYR', 'HISOPO CON BASE HANDY CLEAN', '0.00', '0.00', 0, NULL, 1, '2023-04-30', '00:00:00', 0, 1, 13, 4, '000000011', 0, 0, 0),
(12, '000000012', 'RALLADOR DE PLÁSTICO', '0.00', '0.00', 0, NULL, 1, '2023-08-03', '00:00:00', 0, 1, 7, 2, '000000011', 0, 0, 0),
(13, '000000013', 'BANDEJA SNAK', '0.00', '0.00', 0, NULL, 1, '2023-08-03', '00:00:00', 0, 1, 14, 1, '000000013', 0, 0, 0),
(14, '000000014', 'PORTACEPILLO FAMILIAR', '0.00', '0.00', 1, NULL, 1, '2023-08-04', '00:00:00', 0, 3, 15, 1, '000000014', 0, 0, 0),
(15, '000000015', 'ENVASE HERMETICO 1.5 LT CON TAPA ROSCA', '0.00', '0.00', 1, NULL, 1, '2023-08-04', '00:00:00', 0, 3, 16, 1, '000000015', 0, 0, 0),
(16, '000000016', 'TRAPEADOR MICROFIBRA', '0.00', '0.00', 0, NULL, 1, '2023-08-03', '00:00:00', 0, 1, 26, 1, '000000016', 0, 0, 0),
(17, '000000017', 'TAPETE BIENVENIDO', '0.00', '0.00', 0, NULL, 1, '2023-08-03', '00:00:00', 0, 1, 17, 4, '000000017', 0, 0, 0),
(18, '000000018', 'BAÑERA BALLENITA FELIZ BASA', '0.00', '0.00', 2, NULL, 1, '2023-09-15', '00:00:00', 1, 3, 18, 5, '000000018', 0, 0, 0),
(19, '000000019', 'CONDIMENTERO', '0.00', '0.00', 0, NULL, 1, '2023-08-03', '00:00:00', 0, 3, 19, 6, '000000019', 0, 0, 0),
(20, '000000020', 'TETERA', '0.00', '0.00', 0, NULL, 1, '2023-08-03', '00:00:00', 0, 3, 20, 7, '000000020', 0, 0, 0),
(21, '000000021', 'BANCO EVEREST 2 PASOS', '0.00', '0.00', 0, NULL, 1, '2023-08-03', '00:00:00', 0, 1, 5, 1, '000000021', 0, 0, 0),
(22, '000000022', 'FRASCO REPOSTERO PRACTICO 4 LT', '0.00', '0.00', 0, NULL, 1, '2023-08-03', '00:00:00', 0, 3, 21, 6, '000000022', 0, 0, 0),
(23, '000000023', 'PORTARROLLO DE LUXE', '0.00', '0.00', 0, NULL, 1, '2023-08-03', '00:00:00', 0, 1, 22, 1, '000000023', 0, 0, 0),
(24, '000000024', 'ESPEJO ROSE', '0.00', '0.00', 0, NULL, 1, '2023-08-03', '00:00:00', 0, 1, 23, 8, '000000024', 0, 0, 0),
(25, '000000025', 'AZUCARERO ACRÍLICO', '0.00', '0.00', 0, NULL, 1, '2023-08-03', '00:00:00', 0, 1, 24, 5, '000000025', 0, 0, 0),
(26, '000000026', 'NECESER NADINE PORTATIL', '0.00', '0.00', 0, NULL, 1, '2023-08-03', '00:00:00', 0, 1, 27, 1, '000000026', 0, 0, 0),
(27, '000000027', 'REPOSTERO FRANCÉS #10', '0.00', '0.00', 0, NULL, 1, '2023-08-03', '00:00:00', 0, 3, 28, 1, '000000027', 0, 0, 0),
(28, '000000028', 'JARRA TROPICAL 4.5 LT', '0.00', '0.00', 0, NULL, 1, '2023-08-03', '00:00:00', 0, 3, 1, 5, '000000028', 0, 0, 0),
(29, '000000029', 'MACETA DURA FASHION # 6', '0.00', '0.00', 0, NULL, 1, '2023-08-03', '00:00:00', 0, 3, 29, 1, '000000029', 0, 0, 0),
(30, '000000030', 'PAÑO MICROFIBRA', '0.00', '0.00', 0, NULL, 1, '2023-08-03', '00:00:00', 0, 1, 30, 4, '000000030', 0, 0, 0),
(31, '000000031', 'SILLA MODERNA CAOBA', '0.00', '0.00', 0, NULL, 1, '2023-08-03', '00:00:00', 0, 2, 31, 1, '000000031', 0, 0, 0),
(32, '000000032', 'MESA REDONDA CARAL', '0.00', '0.00', 0, NULL, 1, '2023-08-03', '00:00:00', 0, 1, 32, 1, '000000032', 0, 0, 0),
(33, '000000033', 'SET TRAPEADOR ESCURRIDOR GIGANTE MÁGICO', '0.00', '0.00', 0, NULL, 1, '2023-08-03', '00:00:00', 0, 3, 26, 1, '000000033', 0, 0, 0),
(34, '000000034', 'ESQUINERO CON GAVETERO', '0.00', '0.00', 0, NULL, 1, '2023-08-03', '00:00:00', 0, 2, 33, 2, '000000034', 0, 0, 0),
(35, '000000035', 'PVC BATH MAT OVALADO - BAÑO', '0.00', '0.00', 0, NULL, 1, '2023-08-03', '00:00:00', 0, 2, 34, 4, '000000035', 0, 0, 0),
(36, '000000036', 'ESCOBA SÚPER CHINITA', '0.00', '0.00', 0, NULL, 1, '2023-08-03', '00:00:00', 0, 1, 35, 4, '000000036', 0, 0, 0),
(37, '000000037', 'CAJA COSECHERA 40 LT', '0.00', '0.00', 0, NULL, 1, '2023-08-03', '00:00:00', 0, 3, 9, 2, '000000037', 0, 0, 0),
(38, '000000038', 'BATEA', '0.00', '0.00', 0, NULL, 1, '2023-08-03', '00:00:00', 0, 3, 36, 1, '000000038', 0, 0, 0),
(39, '000000039', 'SÚPER CUBIERTO CUCHARA', '0.00', '0.00', 0, NULL, 1, '2023-08-03', '00:00:00', 0, 2, 37, 2, '000000039', 0, 0, 0),
(40, '000000040', 'BOLOS BUEN HOGAR CON TAPA JUEGO * 4', '0.00', '0.00', 1, NULL, 1, '2023-08-04', '00:00:00', 0, 2, 38, 1, '000000040', 0, 0, 0),
(41, '000000041', 'CANASTILLA TAVARUA MODELO RATAN', '0.00', '0.00', 0, NULL, 1, '2023-08-03', '00:00:00', 0, 2, 39, 1, '000000041', 0, 0, 0),
(42, '000000042', 'SORBETERO HAWAIANO', '0.00', '0.00', 0, NULL, 1, '2023-08-03', '00:00:00', 0, 1, 40, 6, '000000042', 0, 0, 0),
(43, '000000043', 'UTILITARIO SALSA', '0.00', '0.00', 0, NULL, 1, '2023-08-03', '00:00:00', 0, 3, 37, 1, '000000043', 0, 0, 0),
(44, '000000044', 'MATAMOSCA FLORAL', '0.00', '0.00', 0, NULL, 1, '2023-08-03', '00:00:00', 0, 1, 8, 1, '000000044', 0, 0, 0),
(45, '000000045', 'PORTAVAJILLA GRANDE MISTURA', '0.00', '0.00', 0, NULL, 1, '2023-08-03', '00:00:00', 0, 3, 41, 1, '000000045', 0, 0, 0),
(46, '000000046', 'JARRA REYWARE 1 LT', '0.00', '0.00', 0, NULL, 1, '2023-08-03', '00:00:00', 0, 3, 1, 1, '000000046', 0, 0, 0),
(47, '000000047', 'BOTELLA TRITAN 830 ML', '0.00', '0.00', 0, NULL, 1, '2023-08-03', '00:00:00', 0, 3, 42, 5, '000000047', 0, 0, 0),
(48, '000000048', 'LIMPIAVIDRIO INDUSTRIAL', '0.00', '0.00', 0, NULL, 1, '2023-08-03', '00:00:00', 0, 5, 43, 9, '000000048', 0, 0, 0),
(49, '000000049', 'PAPELERA AUTOMÁTICA CLIN', '0.00', '0.00', 0, NULL, 1, '2023-08-03', '00:00:00', 0, 3, 44, 1, '000000049', 0, 0, 0),
(50, '000000050', 'BATEA', '0.00', '0.00', 0, NULL, 1, '2023-08-03', '00:00:00', 0, 3, 36, 1, '000000050', 0, 0, 0),
(51, 'PR-PRUEBA', 'PRUEBA', '0.01', '0.01', 0, 'assets/images/productos/20231012154516.jpg', 1, '2023-10-12', '15:45:16', 0, 1, 8, 1, '000000111', 0, 0, 0),
(52, 'PROD-PRUEBA', 'PRODUCTO DE PRUEBA', '0.01', '0.01', 10, 'assets/images/productos/20231012155156.jpg', 1, '2023-10-12', '15:51:56', 90, 1, 18, 1, '000000005', 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `id` int(11) NOT NULL,
  `ruc` varchar(15) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `telefono` varchar(50) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`id`, `ruc`, `nombre`, `telefono`, `correo`, `direccion`, `fecha`, `estado`) VALUES
(1, '10723087495', 'REY', '95656532', 'REY@GMAIL.COM', '<p>Lima - Perú</p>', '2023-08-03 18:54:51', 1),
(2, '10734561782', 'POLINPLAST', '915324586', 'POLINPLAST@GMAIL.COM', '<p>Lima - Perú</p>', '2023-08-03 18:54:26', 1),
(3, '10258362405', 'UTILIT', '954852123', 'UTILIT@GMAIL.COM', '<p>Lima - Perú</p>', '2023-08-03 18:54:33', 1),
(4, '10222352845', 'DAYR', '985473552', 'DAYR@GMAIL.COM', '<p>Lima - Perú</p>', '2023-08-03 19:05:02', 1),
(5, '10528468355', 'BASA', '985123457', 'BASA@GMAIL.COM', '<p>Lima - Perú</p>', '2023-08-03 19:15:55', 1),
(6, '10472552475', 'BOTIPLAST', '985245325', 'BOTIPLAST@GMAIL.COM', '<p>Lima - Perú</p>', '2023-08-03 19:17:55', 1),
(7, '10457585855', 'KING', '941235756', 'KING@GMAIL.COM', '<p>Lima - Perú</p>', '2023-08-03 19:19:24', 1),
(8, '10528574585', 'COASPA', '985412365', 'COASPA@GMAIL.COM', '<p>Lima - Perú</p>', '2023-08-03 19:23:16', 1),
(9, '10524785635', 'HUDE', '985471236', 'HUDE@GMAIL.COM', '<p>Lima - Perú</p>', '2023-08-03 19:44:04', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prueba`
--

CREATE TABLE `prueba` (
  `id` int(11) NOT NULL,
  `producto` varchar(255) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `prueba`
--

INSERT INTO `prueba` (`id`, `producto`, `cantidad`, `fecha`) VALUES
(1, 'Producto A', 50, '2023-01-15'),
(2, 'Producto A', 30, '2023-01-20'),
(3, 'Producto A', 40, '2023-02-10'),
(4, 'Producto B', 60, '2023-02-25'),
(5, 'Producto B', 70, '2023-05-12'),
(6, 'Producto B', 55, '2023-05-28'),
(7, 'Producto B', 70, '2023-05-12'),
(8, 'Producto B', 55, '2023-05-28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stock_fisico`
--

CREATE TABLE `stock_fisico` (
  `id` int(11) NOT NULL,
  `codigo` varchar(10) NOT NULL,
  `descripcion` varchar(60) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `razon` varchar(60) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `stock_fisico`
--

INSERT INTO `stock_fisico` (`id`, `codigo`, `descripcion`, `cantidad`, `razon`, `fecha`, `hora`, `estado`) VALUES
(1, 'MR-REY ', 'Taper Reyware 1 kg', 300, 'Para Actualizar', '2023-05-01', '09:05:51', 1),
(2, 'JE-BASA', 'Jarra electrica 2.5 litros', 36, 'Para Actualizar', '2023-05-01', '09:15:51', 1),
(3, 'BE-REY ', 'Banco everest 2 pasos', 144, 'Para Actualizar', '2023-05-01', '09:25:51', 1),
(4, 'RP-BASA', 'Rallador plastico', 216, 'Para Actualizar', '2023-05-01', '09:35:51', 1),
(5, 'MF-REY ', 'Matamosca floral ', 600, 'Para Actualizar', '2023-05-01', '09:45:51', 1),
(6, 'CS-REY ', 'Caja movil suprema # 40 ', 48, 'Para Actualizar', '2023-05-01', '09:55:51', 1),
(7, 'TU-UTIL', 'Taper 1200 ml', 600, 'Para Actualizar', '2023-05-01', '09:56:51', 1),
(8, 'DR-REY ', 'Despensero real gigante x 3 niveles con rueda', 192, 'Para Actualizar', '2023-05-01', '09:57:51', 1),
(9, 'CG-REY ', 'Cesto gaby con tapa', 96, 'Para Actualizar', '2023-05-01', '09:58:51', 1),
(10, 'CM-REY', 'Colador multiuso ', 144, 'Para Actualizar', '2023-05-01', '09:59:51', 1),
(11, 'HC-REY ', 'Hisopo con base handy clean ', 144, 'Para Actualizar', '2023-05-02', '09:05:51', 1),
(12, 'RP-BASA', 'Rallador plastico', 144, 'Para Actualizar', '2023-05-02', '09:15:51', 1),
(13, 'BS-REY ', 'Bandeja snak', 96, 'Para Actualizar', '2023-05-02', '09:25:51', 1),
(14, 'PF-REY ', 'Portacepillo familiar', 96, 'Para Actualizar', '2023-05-02', '09:35:51', 1),
(15, 'EH-REY ', 'Envase hermetico 1.5 litros con rosca', 344, 'Para Actualizar', '2023-05-02', '09:45:51', 1),
(16, 'TM-DAYR', 'Trapeador microfibra ', 600, 'Para Actualizar', '2023-05-02', '09:55:51', 1),
(17, 'TB-DAYR', 'Tapete bienvenido ', 75, 'Para Actualizar', '2023-05-02', '09:56:51', 1),
(18, 'BF-BASA', 'Bañera ballenita feliz basa', 48, 'Para Actualizar', '2023-05-02', '09:57:51', 1),
(19, 'CD-BOTI', 'Condimentero', 144, 'Para Actualizar', '2023-05-02', '09:58:51', 1),
(20, 'TT-KING', 'Tetera', 48, 'Para Actualizar', '2023-05-02', '09:59:51', 1),
(21, 'AJ-REY ', 'Ajicero', 144, 'Para Actualizar', '2023-05-03', '09:05:51', 1),
(22, 'FR-REY ', 'Frasco repostero practico 4 litro', 96, 'Para Actualizar', '2023-05-03', '09:15:51', 1),
(23, 'PL-REY ', 'Portarollo de luxe', 96, 'Para Actualizar', '2023-05-03', '09:25:51', 1),
(24, 'ER-COS ', 'Espejo rose ', 96, 'Para Actualizar', '2023-05-03', '09:35:51', 1),
(25, 'AA-REY ', 'Azucarero acrilico', 240, 'Para Actualizar', '2023-05-03', '09:45:51', 1),
(26, 'NP-REY ', 'Neceser nadine portatil ', 96, 'Para Actualizar', '2023-05-03', '09:55:51', 1),
(27, 'RF-UTIL', 'Repostero frances #10', 96, 'Para Actualizar', '2023-05-03', '09:56:51', 1),
(28, 'JT-REY ', 'Jarra tropical 4.5 lt ', 72, 'Para Actualizar', '2023-05-03', '09:57:51', 1),
(29, 'MF-REY ', 'Maceta dura fashion #6', 72, 'Para Actualizar', '2023-05-03', '09:58:51', 1),
(30, 'PM-REY ', 'Paño microfibra ', 600, 'Para Actualizar', '2023-05-03', '09:59:51', 1),
(31, 'MR-REY ', 'Silla moderna caoba', 360, 'Para Actualizar', '2023-05-04', '09:05:51', 1),
(32, 'JE-BASA', 'Mesa redonda caral ', 96, 'Para Actualizar', '2023-05-04', '09:15:51', 1),
(33, 'BE-REY ', 'Set trapeador escurridor gigante magico', 48, 'Para Actualizar', '2023-05-04', '09:25:51', 1),
(34, 'RP-BASA', 'Esquinero con gabetero', 96, 'Para Actualizar', '2023-05-04', '09:35:51', 1),
(35, 'MF-REY ', 'PVC Bath mat ovalado - baño ', 72, 'Para Actualizar', '2023-05-04', '09:45:51', 1),
(36, 'CS-REY ', 'Escoba súper chinita', 48, 'Para Actualizar', '2023-05-04', '09:55:51', 1),
(37, 'TU-UTIL', 'Caja cosechera 40 LT', 48, 'Para Actualizar', '2023-05-04', '09:56:51', 1),
(38, 'DR-REY ', 'Batea', 180, 'Para Actualizar', '2023-05-04', '09:57:51', 1),
(39, 'CG-REY ', 'Super cubierto cuchara', 600, 'Para Actualizar', '2023-05-04', '09:58:51', 1),
(40, 'CM-REY ', 'Bolos buen hogar con tapa juego x 4', 144, 'Para Actualizar', '2023-05-04', '09:59:51', 1),
(41, 'CT-REY ', 'Canastilla tavarua modelo ratan', 144, 'Para Actualizar', '2023-05-05', '09:05:51', 1),
(42, 'SH-BASA', 'Sorbetero hawaiano- kalidad ', 600, 'Para Actualizar', '2023-05-05', '09:15:51', 1),
(43, 'US-REY ', 'Utilitario salsa', 144, 'Para Actualizar', '2023-05-05', '09:25:51', 1),
(44, 'TH-BASA', 'Taper hermetic 1.1 litros con valvula ', 360, 'Para Actualizar', '2023-05-05', '09:35:51', 1),
(45, 'PM-REY ', 'Portavajilla grande mistura', 96, 'Para Actualizar', '2023-05-05', '09:45:51', 1),
(46, 'JR-REY ', 'Jarra Reyware 1 LT', 96, 'Para Actualizar', '2023-05-05', '09:55:51', 1),
(47, 'BT-BASA', 'Botella tritan 830 ml', 216, 'Para Actualizar', '2023-05-05', '09:56:51', 1),
(48, 'LI-HUDE', 'Limpiavidrios industrial', 144, 'Para Actualizar', '2023-05-05', '09:57:51', 1),
(49, 'PC-REY ', 'Papelera automatica clin', 144, 'Para Actualizar', '2023-05-05', '09:58:51', 1),
(50, 'LI-COAS', 'Limosnero', 168, 'Para Actualizar', '2023-05-05', '09:59:51', 1),
(51, 'TR-REY ', 'Taper Reyware 1 kg', 448, 'Para Actualizar', '2023-05-08', '09:05:51', 1),
(52, 'JE-BASA', 'Jarra electrica 2.5 litros', 85, 'Para Actualizar', '2023-05-08', '09:15:51', 1),
(53, 'BE-REY ', 'Banco everest 2 pasos', 178, 'Para Actualizar', '2023-05-08', '09:25:51', 1),
(54, 'RP-BASA', 'Rallador plastico', 304, 'Para Actualizar', '2023-05-08', '09:35:51', 1),
(55, 'MF-REY ', 'Matamosca floral ', 810, 'Para Actualizar', '2023-05-08', '09:45:51', 1),
(56, 'CS-REY ', 'Caja movil suprema # 40 ', 75, 'Para Actualizar', '2023-05-08', '09:55:51', 1),
(57, 'TU-UTIL', 'Taper 1200 ml', 910, 'Para Actualizar', '2023-05-08', '09:56:51', 1),
(58, 'DR-REY ', 'Despensero real gigante x 3 niveles con rueda', 256, 'Para Actualizar', '2023-05-08', '09:57:51', 1),
(59, 'CG-REY ', 'Cesto gaby con tapa', 120, 'Para Actualizar', '2023-05-08', '09:58:51', 1),
(60, 'CM-REY ', 'Colador multiuso ', 173, 'Para Actualizar', '2023-05-08', '09:59:51', 1),
(61, 'HC-REY ', 'Hisopo con base handy clean ', 193, 'Para Actualizar', '2023-05-09', '09:05:51', 1),
(62, 'RP-BASA', 'Rallador plastico', 158, 'Para Actualizar', '2023-05-09', '09:15:51', 1),
(63, 'BS-REY ', 'Bandeja snak', 208, 'Para Actualizar', '2023-05-09', '09:25:51', 1),
(64, 'PF-REY ', 'Portacepillo familiar', 203, 'Para Actualizar', '2023-05-09', '09:35:51', 1),
(65, 'EH-REY ', 'Envase hermetico 1.5 litros con rosca', 512, 'Para Actualizar', '2023-05-09', '09:45:51', 1),
(66, 'TM-REY ', 'Trapeador microfibra ', 999, 'Para Actualizar', '2023-05-09', '09:55:51', 1),
(67, 'TB-DAYR', 'Tapete bienvenido ', 157, 'Para Actualizar', '2023-05-09', '09:56:51', 1),
(68, 'BF-BASA', 'Bañera ballenita feliz basa', 107, 'Para Actualizar', '2023-05-09', '09:57:51', 1),
(69, 'CF-BOTI', 'Condimentero', 219, 'Para Actualizar', '2023-05-09', '09:58:51', 1),
(70, 'TT-KING', 'Tetera', 63, 'Para Actualizar', '2023-05-09', '09:59:51', 1),
(71, 'AJ-BOTI', 'Ajicero', 194, 'Para Actualizar', '2023-05-10', '09:05:51', 1),
(72, 'FR-REY ', 'Frasco repostero practico 4 litro', 115, 'Para Actualizar', '2023-05-10', '09:15:51', 1),
(73, 'PL-REY ', 'Portarollo de luxe', 126, 'Para Actualizar', '2023-05-10', '09:25:51', 1),
(74, 'ER-COAS', 'Espejo rose ', 120, 'Para Actualizar', '2023-05-10', '09:35:51', 1),
(75, 'AA-REY ', 'Azucarero acrilico', 388, 'Para Actualizar', '2023-05-10', '09:45:51', 1),
(76, 'NP-REY ', 'Neceser nadine portatil ', 110, 'Para Actualizar', '2023-05-10', '09:55:51', 1),
(77, 'RF-REY ', 'Repostero frances #10', 127, 'Para Actualizar', '2023-05-10', '09:56:51', 1),
(78, 'JT-BASA', 'Jarra tropical 4.5 lt ', 102, 'Para Actualizar', '2023-05-10', '09:57:51', 1),
(79, 'MF-REY ', 'Maceta dura fashion #6', 104, 'Para Actualizar', '2023-05-10', '09:58:51', 1),
(80, 'PM-DAYR', 'Paño microfibra ', 914, 'Para Actualizar', '2023-05-10', '09:59:51', 1),
(81, 'SM-REY ', 'Silla moderna caoba', 570, 'Para Actualizar', '2023-05-11', '09:05:51', 1),
(82, 'MR-REY ', 'Mesa redonda caral ', 118, 'Para Actualizar', '2023-05-11', '09:15:51', 1),
(83, 'ST-REY ', 'Set trapeador escurridor gigante magico', 66, 'Para Actualizar', '2023-05-11', '09:25:51', 1),
(84, 'EG-POLI', 'Esquinero con gabetero', 126, 'Para Actualizar', '2023-05-11', '09:35:51', 1),
(85, 'PV-DAYR', 'PVC Bath mat ovalado - baño ', 92, 'Para Actualizar', '2023-05-11', '09:45:51', 1),
(86, 'EC-DAYR', 'Escoba súper chinita', 62, 'Para Actualizar', '2023-05-11', '09:55:51', 1),
(87, 'CC-REY ', 'Caja cosechera 40 LT', 64, 'Para Actualizar', '2023-05-11', '09:56:51', 1),
(88, 'BT-REY ', 'Batea', 232, 'Para Actualizar', '2023-05-11', '09:57:51', 1),
(89, 'SC-REY ', 'Super cubierto cuchara', 900, 'Para Actualizar', '2023-05-11', '09:58:51', 1),
(90, 'BB-BASA', 'Bolos buen hogar con tapa juego x 4', 220, 'Para Actualizar', '2023-05-11', '09:59:51', 1),
(91, 'CT-REY ', 'Canastilla tavarua modelo ratan', 208, 'Para Actualizar', '2023-05-12', '09:05:51', 1),
(92, 'SH-BOTI', 'Sorbetero hawaiano- kalidad ', 890, 'Para Actualizar', '2023-05-12', '09:15:51', 1),
(93, 'US-REY ', 'Utilitario salsa', 223, 'Para Actualizar', '2023-05-12', '09:25:51', 1),
(94, 'TH-REY ', 'Taper hermetic 1.1 litros con valvula ', 450, 'Para Actualizar', '2023-05-12', '09:35:51', 1),
(95, 'PM-REY ', 'Portavajilla grande mistura', 105, 'Para Actualizar', '2023-05-12', '09:45:51', 1),
(96, 'JR-REY ', 'Jarra Reyware 1 LT', 143, 'Para Actualizar', '2023-05-12', '09:55:51', 1),
(97, 'BT-BASA', 'Botella tritan 830 ml', 288, 'Para Actualizar', '2023-05-12', '09:56:51', 1),
(98, 'LI-REY ', 'Limpiavidrios industrial', 163, 'Para Actualizar', '2023-05-12', '09:57:51', 1),
(99, 'PC-REY ', 'Papelera automatica clin', 188, 'Para Actualizar', '2023-05-12', '09:58:51', 1),
(100, 'LM-BAS', 'Limosnero', 219, 'Para Actualizar', '2023-05-12', '09:59:51', 1),
(101, 'TR-REY ', 'Taper Reyware 1 kg', 614, 'Para Actualizar', '2023-05-15', '09:05:51', 1),
(102, 'JE-BASA', 'Jarra electrica 2.5 litros', 134, 'Para Actualizar', '2023-05-15', '09:15:51', 1),
(103, 'BE-REY ', 'Banco everest 2 pasos', 212, 'Para Actualizar', '2023-05-15', '09:25:51', 1),
(104, 'RP-BASA', 'Rallador plastico', 392, 'Para Actualizar', '2023-05-15', '09:35:51', 1),
(105, 'MF-REY ', 'Matamosca floral ', 894, 'Para Actualizar', '2023-05-15', '09:45:51', 1),
(106, 'CS-REY ', 'Caja movil suprema # 40 ', 88, 'Para Actualizar', '2023-05-15', '09:55:51', 1),
(107, 'TU-UTIL', 'Taper 1200 ml', 990, 'Para Actualizar', '2023-05-15', '09:56:51', 1),
(108, 'DR-REY ', 'Despensero real gigante x 3 niveles con rueda', 315, 'Para Actualizar', '2023-05-15', '09:57:51', 1),
(109, 'CG-REY ', 'Cesto gaby con tapa', 140, 'Para Actualizar', '2023-05-15', '09:58:51', 1),
(110, 'CM-REY ', 'Colador multiuso ', 206, 'Para Actualizar', '2023-05-15', '09:59:51', 1),
(111, 'HC-REY ', 'Hisopo con base handy clean ', 235, 'Para Actualizar', '2023-05-16', '09:05:51', 1),
(112, 'RP-BASA', 'Rallador plastico', 197, 'Para Actualizar', '2023-05-16', '09:15:51', 1),
(113, 'BS-REY ', 'Bandeja snak', 204, 'Para Actualizar', '2023-05-16', '09:25:51', 1),
(114, 'PF-BASA', 'Portacepillo familiar', 184, 'Para Actualizar', '2023-05-16', '09:35:51', 1),
(115, 'EH-REY ', 'Envase hermetico 1.5 litros con rosca', 610, 'Para Actualizar', '2023-05-16', '09:45:51', 1),
(116, 'TM-DAYR', 'Trapeador microfibra ', 1319, 'Para Actualizar', '2023-05-16', '09:55:51', 1),
(117, 'TB-DAYR', 'Tapete bienvenido ', 233, 'Para Actualizar', '2023-05-16', '09:56:51', 1),
(118, 'BF-BASA', 'Bañera ballenita feliz basa', 90, 'Para Actualizar', '2023-05-16', '09:57:51', 1),
(119, 'CD-BOTI', 'Condimentero', 228, 'Para Actualizar', '2023-05-16', '09:58:51', 1),
(120, 'TT-KING', 'Tetera', 77, 'Para Actualizar', '2023-05-16', '09:59:51', 1),
(121, 'AJ-BOTI', 'Ajicero', 238, 'Para Actualizar', '2023-05-17', '09:05:51', 1),
(122, 'FR-REY ', 'Frasco repostero practico 4 litro', 134, 'Para Actualizar', '2023-05-17', '09:15:51', 1),
(123, 'PL-REY ', 'Portarollo de luxe', 156, 'Para Actualizar', '2023-05-17', '09:25:51', 1),
(124, 'ER-COAS', 'Espejo rose ', 154, 'Para Actualizar', '2023-05-17', '09:35:51', 1),
(125, 'AA-REY ', 'Azucarero acrilico', 510, 'Para Actualizar', '2023-05-17', '09:45:51', 1),
(126, 'NP-REY ', 'Neceser nadine portatil ', 139, 'Para Actualizar', '2023-05-17', '09:55:51', 1),
(127, 'RF-REY ', 'Repostero frances #10', 159, 'Para Actualizar', '2023-05-17', '09:56:51', 1),
(128, 'JR-BASA', 'Jarra tropical 4.5 lt ', 109, 'Para Actualizar', '2023-05-17', '09:57:51', 1),
(129, 'MF-REY ', 'Maceta dura fashion #6', 138, 'Para Actualizar', '2023-05-17', '09:58:51', 1),
(130, 'PM-DAYR', 'Paño microfibra ', 1144, 'Para Actualizar', '2023-05-17', '09:59:51', 1),
(131, 'SM-REY ', 'Silla moderna caoba', 630, 'Para Actualizar', '2023-05-18', '09:05:51', 1),
(132, 'MR-REY ', 'Mesa redonda caral ', 140, 'Para Actualizar', '2023-05-18', '09:15:51', 1),
(133, 'ST-REY ', 'Set trapeador escurridor gigante magico', 68, 'Para Actualizar', '2023-05-18', '09:25:51', 1),
(134, 'EG-REY ', 'Esquinero con gabetero', 136, 'Para Actualizar', '2023-05-18', '09:35:51', 1),
(135, 'PV-DAYR', 'PVC Bath mat ovalado - baño ', 118, 'Para Actualizar', '2023-05-18', '09:45:51', 1),
(136, 'EC-DAYR', 'Escoba súper chinita', 76, 'Para Actualizar', '2023-05-18', '09:55:51', 1),
(137, 'CC-REY ', 'Caja cosechera 40 LT', 66, 'Para Actualizar', '2023-05-18', '09:56:51', 1),
(138, 'BT-REY ', 'Batea', 300, 'Para Actualizar', '2023-05-18', '09:57:51', 1),
(139, 'SC-REY ', 'Super cubierto cuchara', 1110, 'Para Actualizar', '2023-05-18', '09:58:51', 1),
(140, 'BH-BASA', 'Bolos buen hogar con tapa juego x 4', 286, 'Para Actualizar', '2023-05-18', '09:59:51', 1),
(141, 'CT-REY ', 'Canastilla tavarua modelo ratan', 241, 'Para Actualizar', '2023-05-19', '09:05:51', 1),
(142, 'SH-BOTI', 'Sorbetero hawaiano- kalidad ', 1080, 'Para Actualizar', '2023-05-19', '09:15:51', 1),
(143, 'US-REY ', 'Utilitario salsa', 294, 'Para Actualizar', '2023-05-19', '09:25:51', 1),
(144, 'TH-REY ', 'Taper hermetic 1.1 litros con valvula ', 610, 'Para Actualizar', '2023-05-19', '09:35:51', 1),
(145, 'PM-REY ', 'Portavajilla grande mistura', 139, 'Para Actualizar', '2023-05-19', '09:45:51', 1),
(146, 'JR-REY ', 'Jarra Reyware 1 LT', 167, 'Para Actualizar', '2023-05-19', '09:55:51', 1),
(147, 'BT-BASA', 'Botella tritan 830 ml', 376, 'Para Actualizar', '2023-05-19', '09:56:51', 1),
(148, 'LI-HUDE', 'Limpiavidrios industrial', 212, 'Para Actualizar', '2023-05-19', '09:57:51', 1),
(149, 'PA-REY ', 'Papelera automatica clin', 246, 'Para Actualizar', '2023-05-19', '09:58:51', 1),
(150, 'LM-COAS', 'Limosnero', 286, 'Para Actualizar', '2023-05-19', '09:59:51', 1),
(151, 'JR-REY ', 'Taper Reyware 1 kg', 454, 'Para Actualizar', '2023-05-22', '09:05:51', 1),
(152, 'JE-BASA', 'Jarra electrica 2.5 litros', 172, 'Para Actualizar', '2023-05-22', '09:15:51', 1),
(153, 'BE-REY ', 'Banco everest 2 pasos', 261, 'Para Actualizar', '2023-05-22', '09:25:51', 1),
(154, 'RP-BASA', 'Rallador plastico', 453, 'Para Actualizar', '2023-05-22', '09:35:51', 1),
(155, 'MF-REY ', 'Matamosca floral ', 934, 'Para Actualizar', '2023-05-22', '09:45:51', 1),
(156, 'CS-REY ', 'Caja movil suprema # 40 ', 90, 'Para Actualizar', '2023-05-22', '09:55:51', 1),
(157, 'TU-UTIL', 'Taper 1200 ml', 960, 'Para Actualizar', '2023-05-22', '09:56:51', 1),
(158, 'DR-REY ', 'Despensero real gigante x 3 niveles con rueda', 367, 'Para Actualizar', '2023-05-22', '09:57:51', 1),
(159, 'CG-REY ', 'Cesto gaby con tapa', 166, 'Para Actualizar', '2023-05-22', '09:58:51', 1),
(160, 'CM-REY ', 'Colador multiuso ', 230, 'Para Actualizar', '2023-05-22', '09:59:51', 1),
(161, 'HC-DAYR', 'Hisopo con base handy clean ', 254, 'Para Actualizar', '2023-05-23', '09:05:51', 1),
(162, 'RP-BASA', 'Rallador plastico', 236, 'Para Actualizar', '2023-05-23', '09:15:51', 1),
(163, 'BE-REY ', 'Bandeja snak', 202, 'Para Actualizar', '2023-05-23', '09:25:51', 1),
(164, 'PF-REY ', 'Portacepillo familiar', 192, 'Para Actualizar', '2023-05-23', '09:35:51', 1),
(165, 'EH-REY ', 'Envase hermetico 1.5 litros con rosca', 698, 'Para Actualizar', '2023-05-23', '09:45:51', 1),
(166, 'TM-DAYR', 'Trapeador microfibra ', 1409, 'Para Actualizar', '2023-05-23', '09:55:51', 1),
(167, 'TB-DAYR', 'Tapete bienvenido ', 225, 'Para Actualizar', '2023-05-23', '09:56:51', 1),
(168, 'BF-BASA', 'Bañera ballenita feliz basa', 94, 'Para Actualizar', '2023-05-23', '09:57:51', 1),
(169, 'CD-BOTI', 'Condimentero', 243, 'Para Actualizar', '2023-05-23', '09:58:51', 1),
(170, 'TT-KING', 'Tetera', 82, 'Para Actualizar', '2023-05-23', '09:59:51', 1),
(171, 'AJ-COAS', 'Ajicero', 290, 'Para Actualizar', '2023-05-24', '09:05:51', 1),
(172, 'FR-REY ', 'Frasco repostero practico 4 litro', 154, 'Para Actualizar', '2023-05-24', '09:15:51', 1),
(173, 'PL-REY ', 'Portarollo de luxe', 182, 'Para Actualizar', '2023-05-24', '09:25:51', 1),
(174, 'ER-CASP', 'Espejo rose ', 180, 'Para Actualizar', '2023-05-24', '09:35:51', 1),
(175, 'AA-REY ', 'Azucarero acrilico', 612, 'Para Actualizar', '2023-05-24', '09:45:51', 1),
(176, 'NP-REY ', 'Neceser nadine portatil ', 123, 'Para Actualizar', '2023-05-24', '09:55:51', 1),
(177, 'RF-REY ', 'Repostero frances #10', 171, 'Para Actualizar', '2023-05-24', '09:56:51', 1),
(178, 'JT-BASA', 'Jarra tropical 4.5 lt ', 85, 'Para Actualizar', '2023-05-24', '09:57:51', 1),
(179, 'MF-REY ', 'Maceta dura fashion #6', 142, 'Para Actualizar', '2023-05-24', '09:58:51', 1),
(180, 'PM-DAYR ', 'Paño microfibra ', 1244, 'Para Actualizar', '2023-05-24', '09:59:51', 1),
(181, 'SC-REY ', 'Silla moderna caoba', 720, 'Para Actualizar', '2023-05-25', '09:05:51', 1),
(182, 'MC-REY ', 'Mesa redonda caral ', 144, 'Para Actualizar', '2023-05-25', '09:15:51', 1),
(183, 'ST-REY ', 'Set trapeador escurridor gigante magico', 65, 'Para Actualizar', '2023-05-25', '09:25:51', 1),
(184, 'EG-POLI', 'Esquinero con gabetero', 164, 'Para Actualizar', '2023-05-25', '09:35:51', 1),
(185, 'PV-DAYR', 'PVC Bath mat ovalado - baño ', 106, 'Para Actualizar', '2023-05-25', '09:45:51', 1),
(186, 'EC-DAYR', 'Escoba súper chinita', 70, 'Para Actualizar', '2023-05-25', '09:55:51', 1),
(187, 'CC-REY ', 'Caja cosechera 40 LT', 70, 'Para Actualizar', '2023-05-25', '09:56:51', 1),
(188, 'BT-REY ', 'Batea', 362, 'Para Actualizar', '2023-05-25', '09:57:51', 1),
(189, 'SC-REY ', 'Super cubierto cuchara', 1130, 'Para Actualizar', '2023-05-25', '09:58:51', 1),
(190, 'BH-BASA', 'Bolos buen hogar con tapa juego x 4', 320, 'Para Actualizar', '2023-05-25', '09:59:51', 1),
(191, 'TR-REY ', 'Canastilla tavarua modelo ratan', 296, 'Para Actualizar', '2023-05-26', '09:05:51', 1),
(192, 'JE-BASA', 'Sorbetero hawaiano- kalidad ', 1200, 'Para Actualizar', '2023-05-26', '09:15:51', 1),
(193, 'BE-REY ', 'Utilitario salsa', 344, 'Para Actualizar', '2023-05-26', '09:26:51', 1),
(194, 'RP-BASA', 'Taper hermetic 1.1 litros con valvula ', 740, 'Para Actualizar', '2023-05-26', '09:35:51', 1),
(195, 'MF-REY ', 'Portavajilla grande mistura', 181, 'Para Actualizar', '2023-05-26', '09:45:51', 1),
(196, 'CS-REY ', 'Jarra Reyware 1 LT', 189, 'Para Actualizar', '2023-05-26', '09:55:51', 1),
(197, 'TU-UTIL', 'Botella tritan 830 ml', 470, 'Para Actualizar', '2023-05-26', '09:56:51', 1),
(198, 'DR-REY ', 'Limpiavidrios industrial', 233, 'Para Actualizar', '2023-05-26', '09:57:51', 1),
(199, 'CG-REY ', 'Papelera automatica clin', 290, 'Para Actualizar', '2023-05-26', '09:58:51', 1),
(200, 'CM-REY ', 'Limosnero', 349, 'Para Actualizar', '2023-05-26', '09:59:51', 1),
(201, 'TR-REY ', 'Taper Reyware 1 kg', 484, 'Para Actualizar', '2023-05-29', '09:05:51', 1),
(202, 'JE-BASA', 'Jarra electrica 2.5 litros', 142, 'Para Actualizar', '2023-05-29', '09:15:51', 1),
(203, 'BE-REY ', 'Banco everest 2 pasos', 275, 'Para Actualizar', '2023-05-29', '09:26:51', 1),
(204, 'RP-BASA', 'Rallador plastico', 303, 'Para Actualizar', '2023-05-29', '09:35:51', 1),
(205, 'MF-REY ', 'Matamosca floral ', 934, 'Para Actualizar', '2023-05-29', '09:45:51', 1),
(206, 'CS-REY ', 'Caja movil suprema # 40 ', 106, 'Para Actualizar', '2023-05-29', '09:55:51', 1),
(207, 'TU-UTIL', 'Taper 1200 ml', 1160, 'Para Actualizar', '2023-05-29', '09:56:51', 1),
(208, 'DR-REY ', 'Despensero real gigante x 3 niveles con rueda', 433, 'Para Actualizar', '2023-05-29', '09:57:51', 1),
(209, 'CG-REY ', 'Cesto gaby con tapa', 183, 'Para Actualizar', '2023-05-29', '09:58:51', 1),
(210, 'CM-REY ', 'Colador multiuso ', 263, 'Para Actualizar', '2023-05-29', '09:59:51', 1),
(211, 'HC-DAYR', 'Hisopo con base handy clean ', 318, 'Para Actualizar', '2023-05-30', '09:05:51', 1),
(212, 'RP-BASA', 'Rallador plastico', 275, 'Para Actualizar', '2023-05-30', '09:15:51', 1),
(213, 'BS-REY ', 'Bandeja snak', 186, 'Para Actualizar', '2023-05-30', '09:26:51', 1),
(214, 'PF-REY ', 'Portacepillo familiar', 198, 'Para Actualizar', '2023-05-30', '09:35:51', 1),
(215, 'EH-REY ', 'Envase hermetico 1.5 litros con rosca', 502, 'Para Actualizar', '2023-05-30', '09:45:51', 1),
(216, 'TM-DAYR', 'Trapeador microfibra ', 1549, 'Para Actualizar', '2023-05-30', '09:55:51', 1),
(217, 'TB-DAYR', 'Tapete bienvenido ', 212, 'Para Actualizar', '2023-05-30', '09:56:51', 1),
(218, 'BF-BASA', 'Bañera ballenita feliz basa', 88, 'Para Actualizar', '2023-05-30', '09:57:51', 1),
(219, 'CD-BOTI', 'Condimentero', 283, 'Para Actualizar', '2023-05-30', '09:58:51', 1),
(220, 'TT-KING', 'Tetera', 103, 'Para Actualizar', '2023-05-30', '09:59:51', 1),
(221, 'AJ-BOTI', 'Ajicero', 364, 'Para Actualizar', '2023-05-31', '09:05:51', 1),
(222, 'FR-REY ', 'Frasco repostero practico 4 litro', 180, 'Para Actualizar', '2023-05-31', '09:15:51', 1),
(223, 'PL-REY ', 'Portarollo de luxe', 206, 'Para Actualizar', '2023-05-31', '09:26:51', 1),
(224, 'ER-COAS', 'Espejo rose ', 190, 'Para Actualizar', '2023-05-31', '09:35:51', 1),
(225, 'AA-REY ', 'Azucarero acrilico', 452, 'Para Actualizar', '2023-05-31', '09:45:51', 1),
(226, 'NP-REY ', 'Neceser nadine portatil ', 136, 'Para Actualizar', '2023-05-31', '09:55:51', 1),
(227, 'RF-REY ', 'Repostero frances #10', 189, 'Para Actualizar', '2023-05-31', '09:56:51', 1),
(228, 'JT-BASA', 'Jarra tropical 4.5 lt ', 117, 'Para Actualizar', '2023-05-31', '09:57:51', 1),
(229, 'MF-REY ', 'Maceta dura fashion #6', 158, 'Para Actualizar', '2023-05-31', '09:58:51', 1),
(230, 'PM-DAYR', 'Paño microfibra ', 1414, 'Para Actualizar', '2023-05-31', '09:59:51', 1),
(231, 'SC-REY ', 'Silla moderna caoba', 880, 'Para Actualizar', '2023-06-01', '09:05:51', 1),
(232, 'MC-REY ', 'Mesa redonda caral ', 157, 'Para Actualizar', '2023-06-01', '09:15:51', 1),
(233, 'ST-REY ', 'Set trapeador escurridor gigante magico', 69, 'Para Actualizar', '2023-06-01', '09:26:51', 1),
(234, 'EG-POLI', 'Esquinero con gabetero', 206, 'Para Actualizar', '2023-06-01', '09:35:51', 1),
(235, 'PV-DAYR', 'PVC Bath mat ovalado - baño ', 130, 'Para Actualizar', '2023-06-01', '09:45:51', 1),
(236, 'EC-DAYR', 'Escoba súper chinita', 78, 'Para Actualizar', '2023-06-01', '09:55:51', 1),
(237, 'CC-REY ', 'Caja cosechera 40 LT', 80, 'Para Actualizar', '2023-06-01', '09:56:51', 1),
(238, 'BT-REY ', 'Batea', 422, 'Para Actualizar', '2023-06-01', '09:57:51', 1),
(239, 'SC-REY ', 'Super cubierto cuchara', 1260, 'Para Actualizar', '2023-06-01', '09:58:51', 1),
(240, 'BH-BASA', 'Bolos buen hogar con tapa juego x 4', 356, 'Para Actualizar', '2023-06-01', '09:59:51', 1),
(241, 'CT-REY ', 'Canastilla tavarua modelo ratan', 350, 'Para Actualizar', '2023-06-02', '09:05:51', 1),
(242, 'SH-BOTI', 'Sorbetero hawaiano- kalidad ', 1230, 'Para Actualizar', '2023-06-02', '09:15:51', 1),
(243, 'US-REY ', 'Utilitario salsa', 400, 'Para Actualizar', '2023-06-02', '09:26:51', 1),
(244, 'TH-REY ', 'Taper hermetic 1.1 litros con valvula ', 890, 'Para Actualizar', '2023-06-02', '09:35:51', 1),
(245, 'PM-REY ', 'Portavajilla grande mistura', 205, 'Para Actualizar', '2023-06-02', '09:45:51', 1),
(246, 'JR-REY ', 'Jarra Reyware 1 LT', 211, 'Para Actualizar', '2023-06-02', '09:55:51', 1),
(247, 'BT-BASA', 'Botella tritan 830 ml', 551, 'Para Actualizar', '2023-06-02', '09:56:51', 1),
(248, 'LI-HUDE', 'Limpiavidrios industrial', 287, 'Para Actualizar', '2023-06-02', '09:57:51', 1),
(249, 'PC-REY ', 'Papelera automatica clin', 349, 'Para Actualizar', '2023-06-02', '09:58:51', 1),
(250, 'LM-COAS', 'Limosnero', 417, 'Para Actualizar', '2023-06-02', '09:59:51', 1),
(251, 'TR-REY ', 'Taper Reyware 1 kg', 574, 'Para Actualizar', '2023-06-05', '09:05:51', 1),
(252, 'JE-BASA', 'Jarra electrica 2.5 litros', 166, 'Para Actualizar', '2023-06-05', '09:15:51', 1),
(253, 'BE-REY ', 'Banco everest 2 pasos', 309, 'Para Actualizar', '2023-06-05', '09:26:51', 1),
(254, 'RP-BASA', 'Rallador plastico', 349, 'Para Actualizar', '2023-06-05', '09:35:51', 1),
(255, 'MF-REY ', 'Matamosca floral', 964, 'Para Actualizar', '2023-06-05', '09:45:51', 1),
(256, 'CS-REY ', 'Caja movil suprema # 40 ', 130, 'Para Actualizar', '2023-06-05', '09:55:51', 1),
(257, 'TU-UTIL', 'Taper 1200 ml', 1380, 'Para Actualizar', '2023-06-05', '09:56:51', 1),
(258, 'DR-REY ', 'Despensero real gigante x 3 niveles con rueda', 509, 'Para Actualizar', '2023-06-05', '09:57:51', 1),
(259, 'CG-REY ', 'Cesto gaby con tapa', 217, 'Para Actualizar', '2023-06-05', '09:58:51', 1),
(260, 'CM-REY ', 'Colador multiuso', 303, 'Para Actualizar', '2023-06-05', '09:59:51', 1),
(261, 'HC-DAYR', 'Hisopo con base handy clean ', 338, 'Para Actualizar', '2023-06-06', '09:05:51', 1),
(262, 'RP-COAS', 'Rallador plastico', 299, 'Para Actualizar', '2023-06-06', '09:15:51', 1),
(263, 'BS-REY ', 'Bandeja snak', 286, 'Para Actualizar', '2023-06-06', '09:26:51', 1),
(264, 'PF-REY ', 'Portacepillo familiar', 184, 'Para Actualizar', '2023-06-06', '09:35:51', 1),
(265, 'EH-REY ', 'Envase hermetico 1.5 litros con rosca', 676, 'Para Actualizar', '2023-06-06', '09:45:51', 1),
(266, 'TM-REY ', 'Trapeador microfibra ', 1569, 'Para Actualizar', '2023-06-06', '09:55:51', 1),
(267, 'TB-DAYR', 'Tapete bienvenido ', 214, 'Para Actualizar', '2023-06-06', '09:56:51', 1),
(268, 'BF-BASA', 'Bañera ballenita feliz basa', 120, 'Para Actualizar', '2023-06-06', '09:57:51', 1),
(269, 'CD-BOTI', 'Condimentero', 319, 'Para Actualizar', '2023-06-06', '09:58:51', 1),
(270, 'TT-KING', 'Tetera', 107, 'Para Actualizar', '2023-06-06', '09:59:51', 1),
(271, 'AJ-COAS', 'Ajicero', 393, 'Para Actualizar', '2023-06-07', '09:05:51', 1),
(272, 'FR-REY ', 'Frasco repostero practico 4 litro', 190, 'Para Actualizar', '2023-06-07', '09:15:51', 1),
(273, 'PL-REY ', 'Portarollo de luxe', 230, 'Para Actualizar', '2023-06-07', '09:26:51', 1),
(274, 'ER-COAS', 'Espejo rose ', 202, 'Para Actualizar', '2023-06-07', '09:35:51', 1),
(275, 'AA-REY ', 'Azucarero acrilico', 462, 'Para Actualizar', '2023-06-07', '09:45:51', 1),
(276, 'NP-REY ', 'Neceser nadine portatil ', 148, 'Para Actualizar', '2023-06-07', '09:55:51', 1),
(277, 'RF-REY ', 'Repostero frances #10', 201, 'Para Actualizar', '2023-06-07', '09:56:51', 1),
(278, 'JT-BASA', 'Jarra tropical 4.5 lt ', 215, 'Para Actualizar', '2023-06-07', '09:57:51', 1),
(279, 'MF-REY ', 'Maceta dura fashion #6', 178, 'Para Actualizar', '2023-06-07', '09:58:51', 1),
(280, 'PM-DAYR', 'Paño microfibra ', 1514, 'Para Actualizar', '2023-06-07', '09:59:51', 1),
(281, 'SC-REY ', 'Silla moderna caoba', 900, 'Para Actualizar', '2023-06-08', '09:05:51', 1),
(282, 'MC-REY ', 'Mesa redonda caral ', 165, 'Para Actualizar', '2023-06-08', '09:15:51', 1),
(283, 'ST-REY ', 'Set trapeador escurridor gigante magico', 67, 'Para Actualizar', '2023-06-08', '09:26:51', 1),
(284, 'EG-POLI', 'Esquinero con gabetero', 234, 'Para Actualizar', '2023-06-08', '09:35:51', 1),
(285, 'PV-DAYR', 'PVC Bath mat ovalado - baño ', 152, 'Para Actualizar', '2023-06-08', '09:45:51', 1),
(286, 'EC-DAYR', 'Escoba súper chinita', 86, 'Para Actualizar', '2023-06-08', '09:55:51', 1),
(287, 'CC-REY ', 'Caja cosechera 40 LT', 90, 'Para Actualizar', '2023-06-08', '09:56:51', 1),
(288, 'BT-REY ', 'Batea', 462, 'Para Actualizar', '2023-06-08', '09:57:51', 1),
(289, 'SC-REY ', 'Super cubierto cuchara', 910, 'Para Actualizar', '2023-06-08', '09:58:51', 1),
(290, 'BH-BASA', 'Bolos buen hogar con tapa juego x 4', 434, 'Para Actualizar', '2023-06-08', '09:59:51', 1),
(291, 'CT-REY ', 'Canastilla tavarua modelo ratan', 416, 'Para Actualizar', '2023-06-09', '09:05:51', 1),
(292, 'SH-BOTI', 'Sorbetero hawaiano- kalidad ', 1350, 'Para Actualizar', '2023-06-09', '09:15:51', 1),
(293, 'US-REY ', 'Utilitario salsa', 446, 'Para Actualizar', '2023-06-09', '09:26:51', 1),
(294, 'TH-REY ', 'Taper hermetic 1.1 litros con valvula ', 1020, 'Para Actualizar', '2023-06-09', '09:35:51', 1),
(295, 'PM-REY ', 'Portavajilla grande mistura', 218, 'Para Actualizar', '2023-06-09', '09:45:51', 1),
(296, 'JR-REY ', 'Jarra Reyware 1 LT', 243, 'Para Actualizar', '2023-06-09', '09:55:51', 1),
(297, 'BT-BASA', 'Botella tritan 830 ml', 633, 'Para Actualizar', '2023-06-09', '09:56:51', 1),
(298, 'LI-HUDE ', 'Limpiavidrios industrial', 337, 'Para Actualizar', '2023-06-09', '09:57:51', 1),
(299, 'PC-REY ', 'Papelera automatica clin', 385, 'Para Actualizar', '2023-06-09', '09:58:51', 1),
(300, 'LM-COAS', 'Limosnero', 489, 'Para Actualizar', '2023-06-09', '09:59:51', 1),
(301, 'TR-REY ', 'Taper Reyware 1 kg', 654, 'Para Actualizar', '2023-06-12', '09:05:51', 1),
(302, 'JE-BASA', 'Jarra electrica 2.5 litros', 141, 'Para Actualizar', '2023-06-12', '09:15:51', 1),
(303, 'BE-REY ', 'Banco everest 2 pasos', 303, 'Para Actualizar', '2023-06-12', '09:26:51', 1),
(304, 'RP-BASA', 'Rallador plastico', 280, 'Para Actualizar', '2023-06-12', '09:35:51', 1),
(305, 'MF-REY ', 'Matamosca floral ', 514, 'Para Actualizar', '2023-06-12', '09:45:51', 1),
(306, 'CS-REY ', 'Caja movil suprema # 40 ', 144, 'Para Actualizar', '2023-06-12', '09:55:51', 1),
(307, 'TU-UTIL', 'Taper 1200 ml', 1480, 'Para Actualizar', '2023-06-12', '09:56:51', 1),
(308, 'DR-REY ', 'Despensero real gigante x 3 niveles con rueda', 577, 'Para Actualizar', '2023-06-12', '09:57:51', 1),
(309, 'CG-REY ', 'Cesto gaby con tapa', 233, 'Para Actualizar', '2023-06-12', '09:58:51', 1),
(310, 'CM-REY ', 'Colador multiuso ', 323, 'Para Actualizar', '2023-06-12', '09:59:51', 1),
(311, 'HC-DAYR', 'Hisopo con base handy clean ', 383, 'Para Actualizar', '2023-06-13', '09:05:51', 1),
(312, 'RP-BASA', 'Rallador plastico', 313, 'Para Actualizar', '2023-06-13', '09:15:51', 1),
(313, 'BE-REY ', 'Bandeja snak', 262, 'Para Actualizar', '2023-06-13', '09:26:51', 1),
(314, 'RP-BASA', 'Portacepillo familiar', 290, 'Para Actualizar', '2023-06-13', '09:35:51', 1),
(315, 'EH-REY ', 'Envase hermetico 1.5 litros con rosca', 760, 'Para Actualizar', '2023-06-13', '09:45:51', 1),
(316, 'TM-DAYR', 'Trapeador microfibra ', 1159, 'Para Actualizar', '2023-06-13', '09:55:51', 1),
(317, 'TB-DAYR', 'Tapete bienvenido ', 206, 'Para Actualizar', '2023-06-13', '09:56:51', 1),
(318, 'BF-BASA', 'Bañera ballenita feliz basa', 112, 'Para Actualizar', '2023-06-13', '09:57:51', 1),
(319, 'CD-COAS', 'Condimentero', 355, 'Para Actualizar', '2023-06-13', '09:58:51', 1),
(320, 'TT-KING', 'Tetera', 115, 'Para Actualizar', '2023-06-13', '09:59:51', 1),
(321, 'TR-REY ', 'Ajicero', 421, 'Para Actualizar', '2023-06-14', '09:05:51', 1),
(322, 'JE-BASA', 'Frasco repostero practico 4 litro', 215, 'Para Actualizar', '2023-06-14', '09:15:51', 1),
(323, 'BE-REY ', 'Portarollo de luxe', 242, 'Para Actualizar', '2023-06-14', '09:26:51', 1),
(324, 'RP-BASA', 'Espejo rose ', 208, 'Para Actualizar', '2023-06-14', '09:35:51', 1),
(325, 'MF-REY ', 'Azucarero acrilico', 564, 'Para Actualizar', '2023-06-14', '09:45:51', 1),
(326, 'CS-REY ', 'Neceser nadine portatil ', 246, 'Para Actualizar', '2023-06-14', '09:55:51', 1),
(327, 'TU-UTIL', 'Repostero frances #10', 185, 'Para Actualizar', '2023-06-14', '09:56:51', 1),
(328, 'DR-REY ', 'Jarra tropical 4.5 lt ', 215, 'Para Actualizar', '2023-06-14', '09:57:51', 1),
(329, 'CG-REY ', 'Maceta dura fashion #6', 162, 'Para Actualizar', '2023-06-14', '09:58:51', 1),
(330, 'CM-REY ', 'Paño microfibra ', 1214, 'Para Actualizar', '2023-06-14', '09:59:51', 1),
(331, 'SC-REY ', 'Silla moderna caoba', 780, 'Para Actualizar', '2023-06-15', '09:05:51', 1),
(332, 'MC-REY ', 'Mesa redonda caral ', 153, 'Para Actualizar', '2023-06-15', '09:15:51', 1),
(333, 'ST-REY ', 'Set trapeador escurridor gigante magico', 69, 'Para Actualizar', '2023-06-15', '09:26:51', 1),
(334, 'EG-POLI', 'Esquinero con gabetero', 208, 'Para Actualizar', '2023-06-15', '09:35:51', 1),
(335, 'PV-DAYR', 'PVC Bath mat ovalado - baño ', 174, 'Para Actualizar', '2023-06-15', '09:45:51', 1),
(336, 'EC-DAYR', 'Escoba súper chinita', 94, 'Para Actualizar', '2023-06-15', '09:55:51', 1),
(337, 'CC-REY ', 'Caja cosechera 40 LT', 102, 'Para Actualizar', '2023-06-15', '09:56:51', 1),
(338, 'BT-REY ', 'Batea', 518, 'Para Actualizar', '2023-06-15', '09:57:51', 1),
(339, 'SC-REY ', 'Super cubierto cuchara', 1190, 'Para Actualizar', '2023-06-15', '09:58:51', 1),
(340, 'BH-BASA', 'Bolos buen hogar con tapa juego x 4', 338, 'Para Actualizar', '2023-06-15', '09:59:51', 1),
(341, 'CT-REY ', 'Canastilla tavarua modelo ratan', 452, 'Para Actualizar', '2023-06-16', '09:05:51', 1),
(342, 'SH-BOTI', 'Sorbetero hawaiano- kalidad ', 1570, 'Para Actualizar', '2023-06-16', '09:15:51', 1),
(343, 'US-REY ', 'Utilitario salsa', 486, 'Para Actualizar', '2023-06-16', '09:26:51', 1),
(344, 'TH-REY ', 'Taper hermetic 1.1 litros con valvula ', 780, 'Para Actualizar', '2023-06-16', '09:35:51', 1),
(345, 'PM-REY ', 'Portavajilla grande mistura', 242, 'Para Actualizar', '2023-06-16', '09:45:51', 1),
(346, 'JR-REY ', 'Jarra Reyware 1 LT', 265, 'Para Actualizar', '2023-06-16', '09:55:51', 1),
(347, 'BT-BASA', 'Botella tritan 830 ml', 681, 'Para Actualizar', '2023-06-16', '09:56:51', 1),
(348, 'LI-HUDE', 'Limpiavidrios industrial', 385, 'Para Actualizar', '2023-06-16', '09:57:51', 1),
(349, 'PC-REY ', 'Papelera automatica clin', 431, 'Para Actualizar', '2023-06-16', '09:58:51', 1),
(350, 'LM-COAS', 'Limosnero', 543, 'Para Actualizar', '2023-06-16', '09:59:51', 1),
(351, 'TR-REY ', 'Taper Reyware 1 kg', 694, 'Para Actualizar', '2023-06-19', '09:05:51', 1),
(352, 'JE-BASA', 'Jarra electrica 2.5 litros', 129, 'Para Actualizar', '2023-06-19', '09:15:51', 1),
(353, 'BE-REY ', 'Banco everest 2 pasos', 315, 'Para Actualizar', '2023-06-19', '09:26:51', 1),
(354, 'RP-BASA', 'Rallador plastico', 346, 'Para Actualizar', '2023-06-19', '09:35:51', 1),
(355, 'MF-REY ', 'Matamosca floral ', 804, 'Para Actualizar', '2023-06-19', '09:45:51', 1),
(356, 'CS-REY ', 'Caja movil suprema # 40 ', 144, 'Para Actualizar', '2023-06-19', '09:55:51', 1),
(357, 'TU-UTIL', 'Taper 1200 ml', 1640, 'Para Actualizar', '2023-06-19', '09:56:51', 1),
(358, 'DR-REY ', 'Despensero real gigante x 3 niveles con rueda', 433, 'Para Actualizar', '2023-06-19', '09:57:51', 1),
(359, 'CG-REY ', 'Cesto gaby con tapa', 249, 'Para Actualizar', '2023-06-19', '09:58:51', 1),
(360, 'CM-REY', 'Colador multiuso ', 337, 'Para Actualizar', '2023-06-19', '09:59:51', 1),
(371, 'HC-DAYR', 'Hisopo con base handy clean ', 427, 'Para Actualizar', '2023-06-20', '09:05:51', 1),
(372, 'RP-BASA', 'Rallador plastico', 319, 'Para Actualizar', '2023-06-20', '09:15:51', 1),
(373, 'BS-REY ', 'Bandeja snak', 226, 'Para Actualizar', '2023-06-20', '09:26:51', 1),
(374, 'PF-REY ', 'Portacepillo familiar', 248, 'Para Actualizar', '2023-06-20', '09:35:51', 1),
(375, 'EH-REY ', 'Envase hermetico 1.5 litros con rosca', 580, 'Para Actualizar', '2023-06-20', '09:45:51', 1),
(376, 'EC-DAYR', 'Trapeador microfibra ', 1249, 'Para Actualizar', '2023-06-20', '09:55:51', 1),
(377, 'TB-DAYR', 'Tapete bienvenido ', 228, 'Para Actualizar', '2023-06-20', '09:56:51', 1),
(378, 'BF-BASA', 'Bañera ballenita feliz basa', 136, 'Para Actualizar', '2023-06-20', '09:57:51', 1),
(379, 'CD-BOTI', 'Condimentero', 361, 'Para Actualizar', '2023-06-20', '09:58:51', 1),
(380, 'TT-KING', 'Tetera', 111, 'Para Actualizar', '2023-06-20', '09:59:51', 1),
(381, 'AJ-COAS', 'Ajicero', 451, 'Para Actualizar', '2023-06-21', '09:05:51', 1),
(382, 'FR-REY ', 'Frasco repostero practico 4 litro', 197, 'Para Actualizar', '2023-06-21', '09:15:51', 1),
(383, 'PL-REY ', 'Portarollo de luxe', 266, 'Para Actualizar', '2023-06-21', '09:26:51', 1),
(384, 'ER-COAS', 'Espejo rose ', 212, 'Para Actualizar', '2023-06-21', '09:35:51', 1),
(385, 'AA-REY ', 'Azucarero acrilico', 660, 'Para Actualizar', '2023-06-21', '09:45:51', 1),
(386, 'NP-REY ', 'Neceser nadine portatil ', 244, 'Para Actualizar', '2023-06-21', '09:55:51', 1),
(387, 'RF-REY ', 'Repostero frances #10', 245, 'Para Actualizar', '2023-06-21', '09:56:51', 1),
(388, 'JT-BASA', 'Jarra tropical 4.5 lt ', 219, 'Para Actualizar', '2023-06-21', '09:57:51', 1),
(389, 'MF-REY ', 'Maceta dura fashion #6', 180, 'Para Actualizar', '2023-06-21', '09:58:51', 1),
(390, 'PM-DAYR', 'Paño microfibra ', 1284, 'Para Actualizar', '2023-06-21', '09:59:51', 1),
(391, 'SC-REY ', 'Silla moderna caoba', 860, 'Para Actualizar', '2023-06-22', '09:05:51', 1),
(392, 'MC-REY ', 'Mesa redonda caral ', 217, 'Para Actualizar', '2023-06-22', '09:15:51', 1),
(393, 'ST-REY ', 'Set trapeador escurridor gigante magico', 73, 'Para Actualizar', '2023-06-22', '09:26:51', 1),
(394, 'EG-POLI', 'Esquinero con gabetero', 198, 'Para Actualizar', '2023-06-22', '09:35:51', 1),
(395, 'PV-DAYR', 'PVC Bath mat ovalado - baño ', 160, 'Para Actualizar', '2023-06-22', '09:45:51', 1),
(396, 'EC-DAYR', 'Escoba súper chinita', 108, 'Para Actualizar', '2023-06-22', '09:55:51', 1),
(397, 'CC-REY ', 'Caja cosechera 40 LT', 114, 'Para Actualizar', '2023-06-22', '09:56:51', 1),
(398, 'BT-REY ', 'Batea', 368, 'Para Actualizar', '2023-06-22', '09:57:51', 1),
(399, 'SC-REY ', 'Super cubierto cuchara', 1180, 'Para Actualizar', '2023-06-22', '09:58:51', 1),
(400, 'BH-BASA', 'Bolos buen hogar con tapa juego x 4', 380, 'Para Actualizar', '2023-06-22', '09:59:51', 1),
(401, 'CT-REY ', 'Canastilla tavarua modelo ratan', 500, 'Para Actualizar', '2023-06-23', '09:05:51', 1),
(402, 'SH-REY ', 'Sorbetero hawaiano- kalidad ', 1620, 'Para Actualizar', '2023-06-23', '09:15:51', 1),
(403, 'US-BOTI', 'Utilitario salsa', 518, 'Para Actualizar', '2023-06-23', '09:26:51', 1),
(404, 'TH-REY ', 'Taper hermetic 1.1 litros con valvula ', 920, 'Para Actualizar', '2023-06-23', '09:35:51', 1),
(405, 'PM-REY ', 'Portavajilla grande mistura', 264, 'Para Actualizar', '2023-06-23', '09:45:51', 1),
(406, 'JR-REY ', 'Jarra Reyware 1 LT', 281, 'Para Actualizar', '2023-06-23', '09:55:51', 1),
(407, 'BT-BASA', 'Botella tritan 830 ml', 517, 'Para Actualizar', '2023-06-23', '09:56:51', 1),
(408, 'LI-HUDE', 'Limpiavidrios industrial', 419, 'Para Actualizar', '2023-06-23', '09:57:51', 1),
(409, 'PC-REY ', 'Papelera automatica clin', 470, 'Para Actualizar', '2023-06-23', '09:58:51', 1),
(410, 'LM-REY ', 'Limosnero', 563, 'Para Actualizar', '2023-06-23', '09:59:51', 1),
(411, 'TR-REY ', 'Taper Reyware 1 kg', 724, 'Para Actualizar', '2023-06-26', '09:05:51', 1),
(412, 'JE-REY ', 'Jarra electrica 2.5 litros', 135, 'Para Actualizar', '2023-06-26', '09:15:51', 1),
(413, 'BE-REY ', 'Banco everest 2 pasos', 255, 'Para Actualizar', '2023-06-26', '09:26:51', 1),
(414, 'RP-REY ', 'Rallador plastico', 382, 'Para Actualizar', '2023-06-26', '09:35:51', 1),
(415, 'MF-REY ', 'Matamosca floral ', 804, 'Para Actualizar', '2023-06-26', '09:45:51', 1),
(416, 'CS-REY ', 'Caja movil suprema # 40 ', 146, 'Para Actualizar', '2023-06-26', '09:55:51', 1),
(417, 'TU-UTIL', 'Taper 1200 ml', 1590, 'Para Actualizar', '2023-06-26', '09:56:51', 1),
(418, 'DR-REY ', 'Despensero real gigante x 3 niveles con rueda', 499, 'Para Actualizar', '2023-06-26', '09:57:51', 1),
(419, 'CG-REY ', 'Cesto gaby con tapa', 261, 'Para Actualizar', '2023-06-26', '09:58:51', 1),
(420, 'CM-REY', 'Colador multiuso ', 331, 'Para Actualizar', '2023-06-26', '09:59:51', 1),
(421, 'HC-DAYR', 'Hisopo con base handy clean ', 439, 'Para Actualizar', '2023-06-27', '09:05:51', 1),
(422, 'RP-BASA', 'Rallador plastico', 325, 'Para Actualizar', '2023-06-27', '09:15:51', 1),
(423, 'BS-REY ', 'Bandeja snak', 286, 'Para Actualizar', '2023-06-27', '09:26:51', 1),
(424, 'PF-REY ', 'Portacepillo familiar', 286, 'Para Actualizar', '2023-06-27', '09:35:51', 1),
(425, 'EH-REY ', 'Envase hermetico 1.5 litros con rosca', 654, 'Para Actualizar', '2023-06-27', '09:45:51', 1),
(426, 'TM-REY ', 'Trapeador microfibra ', 1339, 'Para Actualizar', '2023-06-27', '09:55:51', 1),
(427, 'TB-DAYR', 'Tapete bienvenido ', 234, 'Para Actualizar', '2023-06-27', '09:56:51', 1),
(428, 'BF-BASA', 'Bañera ballenita feliz basa', 196, 'Para Actualizar', '2023-06-27', '09:57:51', 1),
(429, 'CD-BOTI', 'Condimentero', 357, 'Para Actualizar', '2023-06-27', '09:58:51', 1),
(430, 'TT-KING', 'Tetera', 128, 'Para Actualizar', '2023-06-27', '09:59:51', 1),
(431, 'AJ-COAS', 'Ajicero', 475, 'Para Actualizar', '2023-06-28', '09:05:51', 1),
(432, 'FR-REY ', 'Frasco repostero practico 4 litro', 185, 'Para Actualizar', '2023-06-28', '09:15:51', 1),
(433, 'PL-REY ', 'Portarollo de luxe', 248, 'Para Actualizar', '2023-06-28', '09:26:51', 1),
(434, 'ER-REY ', 'Espejo rose ', 200, 'Para Actualizar', '2023-06-28', '09:35:51', 1),
(435, 'AA-REY ', 'Azucarero acrilico', 720, 'Para Actualizar', '2023-06-28', '09:45:51', 1),
(436, 'NP-REY ', 'Neceser nadine portatil ', 252, 'Para Actualizar', '2023-06-28', '09:55:51', 1),
(437, 'RF-REY ', 'Repostero frances #10', 275, 'Para Actualizar', '2023-06-28', '09:56:51', 1),
(438, 'JT-BASA', 'Jarra tropical 4.5 lt ', 207, 'Para Actualizar', '2023-06-28', '09:57:51', 1),
(439, 'MF-REY ', 'Maceta dura fashion #6', 174, 'Para Actualizar', '2023-06-28', '09:58:51', 1),
(440, 'PM-DAYR', 'Paño microfibra ', 1314, 'Para Actualizar', '2023-06-28', '09:59:51', 1),
(441, 'SC-REY ', 'Silla moderna caoba', 780, 'Para Actualizar', '2023-06-29', '09:05:51', 1),
(442, 'MC-REY ', 'Mesa redonda caral ', 265, 'Para Actualizar', '2023-06-29', '09:15:51', 1),
(443, 'ST-REY ', 'Set trapeador escurridor gigante magico', 61, 'Para Actualizar', '2023-06-29', '09:26:51', 1),
(444, 'EG-POLI', 'Esquinero con gabetero', 186, 'Para Actualizar', '2023-06-29', '09:35:51', 1),
(445, 'PV-DAYR', 'PVC Bath mat ovalado - baño ', 122, 'Para Actualizar', '2023-06-29', '09:45:51', 1),
(446, 'EC-DAYR', 'Escoba súper chinita', 120, 'Para Actualizar', '2023-06-29', '09:55:51', 1),
(447, 'CC-REY ', 'Caja cosechera 40 LT', 120, 'Para Actualizar', '2023-06-29', '09:56:51', 1),
(448, 'BT-REY ', 'Batea', 548, 'Para Actualizar', '2023-06-29', '09:57:51', 1),
(449, 'SC-REY ', 'Super cubierto cuchara', 820, 'Para Actualizar', '2023-06-29', '09:58:51', 1),
(450, 'BH-BASA', 'Bolos buen hogar con tapa juego x 4', 406, 'Para Actualizar', '2023-06-29', '09:59:51', 1),
(451, 'CT-REY ', 'Canastilla tavarua modelo ratan', 408, 'Para Actualizar', '2023-06-30', '09:05:51', 1),
(452, 'SH-BOTI', 'Sorbetero hawaiano- kalidad ', 1680, 'Para Actualizar', '2023-06-30', '09:15:51', 1),
(453, 'US-REY ', 'Utilitario salsa', 550, 'Para Actualizar', '2023-06-30', '09:26:51', 1),
(454, 'TH-REY', 'Taper hermetic 1.1 litros con valvula ', 970, 'Para Actualizar', '2023-06-30', '09:35:51', 1),
(455, 'PM-REY ', 'Portavajilla grande mistura', 273, 'Para Actualizar', '2023-06-30', '09:45:51', 1),
(456, 'JR-REY ', 'Jarra Reyware 1 LT', 301, 'Para Actualizar', '2023-06-30', '09:55:51', 1),
(457, 'BT-BASA', 'Botella tritan 830 ml', 585, 'Para Actualizar', '2023-06-30', '09:56:51', 1),
(458, 'LI-HUDE', 'Limpiavidrios industrial', 454, 'Para Actualizar', '2023-06-30', '09:57:51', 1),
(459, 'PC-REY ', 'Papelera automatica clin', 516, 'Para Actualizar', '2023-06-30', '09:58:51', 1),
(460, 'LM-BASA', 'Limosnero', 598, 'Para Actualizar', '2023-06-30', '09:59:51', 1),
(461, 'TR-REY ', 'Taper Reyware 1 kg', 744, 'Para Actualizar', '2023-07-03', '09:05:51', 1),
(462, 'JE-BASA', 'Jarra electrica 2.5 litros', 141, 'Para Actualizar', '2023-07-03', '09:15:51', 1),
(463, 'BE-REY ', 'Banco everest 2 pasos', 349, 'Para Actualizar', '2023-07-03', '09:26:51', 1),
(464, 'RP-BASA', 'Rallador plastico', 318, 'Para Actualizar', '2023-07-03', '09:35:51', 1),
(465, 'MF-REY ', 'Matamosca floral ', 954, 'Para Actualizar', '2023-07-03', '09:45:51', 1),
(466, 'CS-REY ', 'Caja movil suprema # 40 ', 146, 'Para Actualizar', '2023-07-03', '09:55:51', 1),
(467, 'TU-UTIL', 'Taper 1200 ml', 1290, 'Para Actualizar', '2023-07-03', '09:56:51', 1),
(468, 'DR-REY ', 'Despensero real gigante x 3 niveles con rueda', 547, 'Para Actualizar', '2023-07-03', '09:57:51', 1),
(469, 'CG-REY ', 'Cesto gaby con tapa', 281, 'Para Actualizar', '2023-07-03', '09:58:51', 1),
(470, 'CM-REY ', 'Colador multiuso ', 335, 'Para Actualizar', '2023-07-03', '09:59:51', 1),
(471, 'HC-DAYR', 'Hisopo con base handy clean ', 445, 'Para Actualizar', '2023-07-04', '09:05:51', 1),
(472, 'RP-BASA', 'Rallador plastico', 325, 'Para Actualizar', '2023-07-04', '09:15:51', 1),
(473, 'BS-REY ', 'Bandeja snak', 232, 'Para Actualizar', '2023-07-04', '09:26:51', 1),
(474, 'PF-REY ', 'Portacepillo familiar', 204, 'Para Actualizar', '2023-07-04', '09:35:51', 1),
(475, 'EH-REY ', 'Envase hermetico 1.5 litros con rosca', 738, 'Para Actualizar', '2023-07-04', '09:45:51', 1),
(476, 'TM-DAYR', 'Trapeador microfibra ', 1379, 'Para Actualizar', '2023-07-04', '09:55:51', 1),
(477, 'TB-DAYR ', 'Tapete bienvenido ', 282, 'Para Actualizar', '2023-07-04', '09:56:51', 1),
(478, 'BF-BASA', 'Bañera ballenita feliz basa', 232, 'Para Actualizar', '2023-07-04', '09:57:51', 1),
(479, 'CD-BOTI ', 'Condimentero', 297, 'Para Actualizar', '2023-07-04', '09:58:51', 1),
(480, 'TT-KING', 'Tetera', 152, 'Para Actualizar', '2023-07-04', '09:59:51', 1),
(481, 'AJ-COAS', 'Ajicero', 409, 'Para Actualizar', '2023-07-05', '09:05:51', 1),
(482, 'FR-REY ', 'Frasco repostero practico 4 litro', 176, 'Para Actualizar', '2023-07-05', '09:15:51', 1),
(483, 'PL-REY ', 'Portarollo de luxe', 260, 'Para Actualizar', '2023-07-05', '09:26:51', 1),
(484, 'ER-COAS', 'Espejo rose ', 194, 'Para Actualizar', '2023-07-05', '09:35:51', 1),
(485, 'AA-REY', 'Azucarero acrilico', 732, 'Para Actualizar', '2023-07-05', '09:45:51', 1),
(486, 'NP-REY', 'Neceser nadine portatil ', 276, 'Para Actualizar', '2023-07-05', '09:55:51', 1),
(487, 'RF-REY ', 'Repostero frances #10', 275, 'Para Actualizar', '2023-07-05', '09:56:51', 1),
(488, 'JT-BASA', 'Jarra tropical 4.5 lt ', 243, 'Para Actualizar', '2023-07-05', '09:57:51', 1),
(489, 'MF-REY ', 'Maceta dura fashion #6', 180, 'Para Actualizar', '2023-07-05', '09:58:51', 1),
(490, 'PM-DAYR', 'Paño microfibra ', 1164, 'Para Actualizar', '2023-07-05', '09:59:51', 1),
(491, 'SC-REY ', 'Silla moderna caoba', 610, 'Para Actualizar', '2023-07-06', '09:05:51', 1),
(492, 'MC-REY ', 'Mesa redonda caral ', 283, 'Para Actualizar', '2023-07-06', '09:15:51', 1),
(493, 'ST-REY ', 'Set trapeador escurridor gigante magico', 77, 'Para Actualizar', '2023-07-06', '09:26:51', 1),
(494, 'EG-POLI', 'Esquinero con gabetero', 234, 'Para Actualizar', '2023-07-06', '09:35:51', 1),
(495, 'PV-DAYR', 'PVC Bath mat ovalado - baño ', 126, 'Para Actualizar', '2023-07-06', '09:45:51', 1),
(496, 'EC-DAYR', 'Escoba súper chinita', 140, 'Para Actualizar', '2023-07-06', '09:55:51', 1),
(497, 'CC-REY ', 'Caja cosechera 40 LT', 132, 'Para Actualizar', '2023-07-06', '09:56:51', 1),
(498, 'BT-REY ', 'Batea', 554, 'Para Actualizar', '2023-07-06', '09:57:51', 1),
(499, 'SC-REY ', 'Super cubierto cuchara', 730, 'Para Actualizar', '2023-07-06', '09:58:51', 1),
(500, 'BH-BASA', 'Bolos buen hogar con tapa juego x 4', 450, 'Para Actualizar', '2023-07-06', '09:59:51', 1),
(501, 'CT-REY ', 'Canastilla tavarua modelo ratan', 455, 'Para Actualizar', '2023-07-07', '09:05:51', 1),
(502, 'SH-BOTI', 'Sorbetero hawaiano- kalidad ', 1600, 'Para Actualizar', '2023-07-07', '09:15:51', 1),
(503, 'US-REY ', 'Utilitario salsa', 580, 'Para Actualizar', '2023-07-07', '09:26:51', 1),
(504, 'TH-REY ', 'Taper hermetic 1.1 litros con valvula ', 1080, 'Para Actualizar', '2023-07-07', '09:35:51', 1),
(505, 'PM-REY ', 'Portavajilla grande mistura', 279, 'Para Actualizar', '2023-07-07', '09:45:51', 1),
(506, 'JR-REY ', 'Jarra Reyware 1 LT', 321, 'Para Actualizar', '2023-07-07', '09:55:51', 1),
(507, 'BT-BASA', 'Botella tritan 830 ml', 641, 'Para Actualizar', '2023-07-07', '09:56:51', 1),
(508, 'LI-HUDE', 'Limpiavidrios industrial', 473, 'Para Actualizar', '2023-07-07', '09:57:51', 1),
(509, 'PC-REY ', 'Papelera automatica clin', 562, 'Para Actualizar', '2023-07-07', '09:58:51', 1),
(510, 'LI-BASA', 'Limosnero', 656, 'Para Actualizar', '2023-07-07', '09:59:51', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tpi`
--

CREATE TABLE `tpi` (
  `id` int(11) NOT NULL,
  `codigo` varchar(10) NOT NULL,
  `descripcion` varchar(38) NOT NULL,
  `resultado` decimal(10,2) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tpi`
--

INSERT INTO `tpi` (`id`, `codigo`, `descripcion`, `resultado`, `cantidad`, `fecha`, `hora`, `estado`) VALUES
(1, 'CMS-REY', 'CAJA MÓVIL SUPREMA # 40', '36.67', 300, '2023-10-10', '17:14:30', 1),
(2, 'MATAMOSCA ', 'MATAMOSCA FLORAL', '66.67', 300, '2023-10-10', '17:15:24', 1),
(3, 'CMS-REY', 'CAJA MÓVIL SUPREMA # 40', '33.04', 448, '2023-10-11', '17:29:46', 1),
(4, 'CMS-REY', 'CAJA MÓVIL SUPREMA # 40', '51.14', 614, '2023-10-12', '17:29:47', 1),
(5, 'CMS-REY', 'CAJA MÓVIL SUPREMA # 40', '100.00', 404, '2023-10-13', '17:29:50', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `perfil` varchar(100) DEFAULT NULL,
  `clave` varchar(200) NOT NULL,
  `token` varchar(100) DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `estado` int(11) NOT NULL DEFAULT 1,
  `rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `correo`, `telefono`, `direccion`, `perfil`, `clave`, `token`, `fecha`, `estado`, `rol`) VALUES
(1, 'Marisol Cecilia', 'Robles Trejo', 'mc@gmail.com', '918235459', 'Huaraz', NULL, '$2y$10$F9IxgwueB4M9WwPp8oe.6OM.7wRQMXyHN8OzfKRnFT3NS5ebpcCp2', NULL, '2023-07-28 14:52:01', 1, 1),
(2, 'Hellen', 'Bueno Aires', 'hb@gmail.com', '234234432', 'Lima', NULL, '$2y$10$VGe65swNAU8nIR1PbuEbduI1H1mW00hN8q.0Q4PwKngX9V9IfDGr6', NULL, '2023-07-28 16:20:08', 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` int(11) NOT NULL,
  `productos` longtext NOT NULL,
  `cantidad` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `metodo` varchar(15) NOT NULL,
  `descuento` decimal(10,2) DEFAULT NULL,
  `serie` varchar(20) NOT NULL,
  `pago` decimal(10,2) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `apertura` int(11) NOT NULL DEFAULT 1,
  `id_cliente` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id`, `productos`, `cantidad`, `total`, `fecha`, `hora`, `metodo`, `descuento`, `serie`, `pago`, `estado`, `apertura`, `id_cliente`, `id_usuario`) VALUES
(1, 'TAPER REYWARE 1 KG', 50, '0.00', '2023-10-28', '20:46:30', 'PEDIDO', '0.00', '00000001', '0.00', 1, 1, 4, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `abonos`
--
ALTER TABLE `abonos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_credito` (`id_credito`);

--
-- Indices de la tabla `acceso`
--
ALTER TABLE `acceso`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `apartados`
--
ALTER TABLE `apartados`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Indices de la tabla `cajas`
--
ALTER TABLE `cajas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_proveedor` (`id_proveedor`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `consolidado_tpi`
--
ALTER TABLE `consolidado_tpi`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cotizaciones`
--
ALTER TABLE `cotizaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Indices de la tabla `creditos`
--
ALTER TABLE `creditos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_venta` (`id_venta`);

--
-- Indices de la tabla `detalle_apartado`
--
ALTER TABLE `detalle_apartado`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `gastos`
--
ALTER TABLE `gastos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_producto` (`id_producto`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `irs`
--
ALTER TABLE `irs`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `medidas`
--
ALTER TABLE `medidas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mesas`
--
ALTER TABLE `mesas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_categoria` (`id_categoria`),
  ADD KEY `id_medida` (`id_medida`),
  ADD KEY `id_proveedor` (`id_proveedor`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `prueba`
--
ALTER TABLE `prueba`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `stock_fisico`
--
ALTER TABLE `stock_fisico`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tpi`
--
ALTER TABLE `tpi`
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
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `abonos`
--
ALTER TABLE `abonos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `acceso`
--
ALTER TABLE `acceso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=155;

--
-- AUTO_INCREMENT de la tabla `apartados`
--
ALTER TABLE `apartados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `cajas`
--
ALTER TABLE `cajas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `consolidado_tpi`
--
ALTER TABLE `consolidado_tpi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT de la tabla `cotizaciones`
--
ALTER TABLE `cotizaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `creditos`
--
ALTER TABLE `creditos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `detalle_apartado`
--
ALTER TABLE `detalle_apartado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `gastos`
--
ALTER TABLE `gastos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT de la tabla `irs`
--
ALTER TABLE `irs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT de la tabla `medidas`
--
ALTER TABLE `medidas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `mesas`
--
ALTER TABLE `mesas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `prueba`
--
ALTER TABLE `prueba`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `stock_fisico`
--
ALTER TABLE `stock_fisico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=511;

--
-- AUTO_INCREMENT de la tabla `tpi`
--
ALTER TABLE `tpi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `abonos`
--
ALTER TABLE `abonos`
  ADD CONSTRAINT `abonos_ibfk_1` FOREIGN KEY (`id_credito`) REFERENCES `creditos` (`id`);

--
-- Filtros para la tabla `apartados`
--
ALTER TABLE `apartados`
  ADD CONSTRAINT `apartados_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`);

--
-- Filtros para la tabla `cajas`
--
ALTER TABLE `cajas`
  ADD CONSTRAINT `cajas_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `compras`
--
ALTER TABLE `compras`
  ADD CONSTRAINT `compras_ibfk_1` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id`),
  ADD CONSTRAINT `compras_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `cotizaciones`
--
ALTER TABLE `cotizaciones`
  ADD CONSTRAINT `cotizaciones_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`);

--
-- Filtros para la tabla `creditos`
--
ALTER TABLE `creditos`
  ADD CONSTRAINT `creditos_ibfk_1` FOREIGN KEY (`id_venta`) REFERENCES `ventas` (`id`);

--
-- Filtros para la tabla `gastos`
--
ALTER TABLE `gastos`
  ADD CONSTRAINT `gastos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD CONSTRAINT `inventario_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`),
  ADD CONSTRAINT `inventario_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `mesas`
--
ALTER TABLE `mesas`
  ADD CONSTRAINT `mesas_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id`),
  ADD CONSTRAINT `productos_ibfk_2` FOREIGN KEY (`id_medida`) REFERENCES `medidas` (`id`),
  ADD CONSTRAINT `productos_ibfk_3` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id`);

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`),
  ADD CONSTRAINT `ventas_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
