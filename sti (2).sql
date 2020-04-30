-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 01-07-2019 a las 17:18:02
-- Versión del servidor: 5.7.26-0ubuntu0.18.04.1
-- Versión de PHP: 7.2.19-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sti`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno`
--

CREATE TABLE `alumno` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `numero_lista` int(11) NOT NULL DEFAULT '0',
  `id_grupo` bigint(20) UNSIGNED NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `alumno`
--

INSERT INTO `alumno` (`id`, `foto`, `id_user`, `numero_lista`, `id_grupo`, `deleted`, `created_at`, `updated_at`) VALUES
(1, '1560310870.png', 6, 1, 4, 1, '2019-05-27 01:10:55', '2019-06-12 03:41:10'),
(2, '1559796989.png', 7, 2, 4, 0, '2019-05-27 01:15:16', '2019-06-06 04:56:29'),
(3, 'nofoto.png', 8, 8, 4, 0, '2019-05-27 01:16:11', '2019-05-27 01:16:11'),
(4, 'nofoto.png', 9, 17, 4, 0, '2019-06-06 13:10:28', '2019-06-06 13:10:28'),
(5, '1559833518.jpg', 10, 31, 4, 0, '2019-06-06 14:59:39', '2019-06-06 15:05:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrera`
--

CREATE TABLE `carrera` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `carrera`
--

INSERT INTO `carrera` (`id`, `nombre`, `deleted`) VALUES
(1, 'Programación', 0),
(2, 'Computación ofi', 0),
(3, 'Ofimatica', 1),
(4, 'Laboratorista', 1),
(5, 'Computación Inteligente', 0),
(6, 'Otra carrera', 0),
(7, 'Otra nueva', 0),
(8, 'carrera nueva', 0),
(9, 'agregar otra', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo`
--

CREATE TABLE `grupo` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `grado` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '1',
  `grupo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `generacion_inicio` year(4) NOT NULL,
  `generacion_fin` year(4) NOT NULL,
  `turno` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_institucion` bigint(20) UNSIGNED NOT NULL,
  `id_maestro` bigint(20) UNSIGNED NOT NULL,
  `id_carrera` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `grupo`
--

INSERT INTO `grupo` (`id`, `grado`, `grupo`, `generacion_inicio`, `generacion_fin`, `turno`, `id_institucion`, `id_maestro`, `id_carrera`) VALUES
(4, '1', 'A', 2015, 2015, 'V', 1, 2, 7),
(5, '1', 'A', 2011, 2012, 'M', 2, 2, 1),
(6, '1', 'B', 2015, 2020, 'V', 8, 2, 1),
(7, '1', 'H', 2015, 2015, 'M', 1, 2, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `institucion`
--

CREATE TABLE `institucion` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `institucion`
--

INSERT INTO `institucion` (`id`, `nombre`, `deleted`) VALUES
(1, 'universidad autonoma de ags', 0),
(2, 'cbtis', 0),
(8, 'prueba', 1),
(9, 'unid ags', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `maestros`
--

CREATE TABLE `maestros` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `telefono` char(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `maestros`
--

INSERT INTO `maestros` (`id`, `telefono`, `foto`, `created_at`, `updated_at`, `id_user`) VALUES
(1, '4487951236', '1553784090civic.jpg.jpg', '2019-03-28 20:41:30', '2019-03-28 20:41:30', 2),
(2, '4478951236', NULL, '2019-03-28 21:28:58', '2019-03-28 21:28:58', 3),
(3, '2365478919', NULL, '2019-04-07 21:29:31', '2019-04-07 21:29:31', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `maestros_instituciones`
--

CREATE TABLE `maestros_instituciones` (
  `id` int(11) NOT NULL,
  `id_institucion` bigint(20) UNSIGNED NOT NULL,
  `id_maestro` bigint(20) UNSIGNED NOT NULL,
  `deleted` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `maestros_instituciones`
--

INSERT INTO `maestros_instituciones` (`id`, `id_institucion`, `id_maestro`, `deleted`) VALUES
(26, 1, 1, 1),
(27, 2, 1, 0),
(28, 8, 1, 0),
(29, 9, 1, 0),
(30, 1, 2, 1),
(31, 2, 2, 0),
(32, 8, 2, 0),
(33, 9, 2, 0),
(34, 1, 3, 0),
(35, 8, 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(15, '2014_10_12_000000_create_users_table', 1),
(16, '2014_10_12_100000_create_password_resets_table', 1),
(17, '2019_03_17_201153_create_alumnos_table', 1),
(18, '2019_03_17_204652_create_tests_table', 2),
(19, '2019_03_17_205410_create_maestros_table', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resultados_test`
--

CREATE TABLE `resultados_test` (
  `id` bigint(20) NOT NULL,
  `id_alumno` bigint(20) NOT NULL,
  `num_pregunta` int(11) NOT NULL,
  `respuesta` int(11) NOT NULL,
  `test` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `correcta` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `resultados_test`
--

INSERT INTO `resultados_test` (`id`, `id_alumno`, `num_pregunta`, `respuesta`, `test`, `created_at`, `updated_at`, `correcta`) VALUES
(309, 1, 1, 1, 1, '2019-06-06 03:43:21', '2019-06-06 03:43:21', 1),
(310, 1, 2, 2, 1, '2019-06-06 03:43:21', '2019-06-06 03:43:21', 1),
(311, 1, 3, 1, 1, '2019-06-06 03:43:21', '2019-06-06 03:43:21', 1),
(312, 1, 4, 2, 1, '2019-06-06 03:43:21', '2019-06-06 03:43:21', 1),
(313, 1, 5, 1, 1, '2019-06-06 03:43:21', '2019-06-06 03:43:21', 1),
(314, 1, 6, 2, 1, '2019-06-06 03:43:21', '2019-06-06 03:43:21', 1),
(315, 1, 7, 1, 1, '2019-06-06 03:43:21', '2019-06-06 03:43:21', 1),
(316, 1, 8, 2, 1, '2019-06-06 03:43:22', '2019-06-06 03:43:22', 1),
(317, 1, 9, 1, 1, '2019-06-06 03:43:22', '2019-06-06 03:43:22', 1),
(318, 1, 10, 1, 1, '2019-06-06 03:43:22', '2019-06-06 03:43:22', 1),
(319, 1, 11, 2, 1, '2019-06-06 03:43:22', '2019-06-06 03:43:22', 1),
(320, 1, 12, 1, 1, '2019-06-06 03:43:22', '2019-06-06 03:43:22', 1),
(321, 1, 13, 1, 1, '2019-06-06 03:43:22', '2019-06-06 03:43:22', 1),
(322, 1, 14, 1, 1, '2019-06-06 03:43:22', '2019-06-06 03:43:22', 1),
(323, 1, 15, 2, 1, '2019-06-06 03:43:22', '2019-06-06 03:43:22', 1),
(324, 1, 16, 1, 1, '2019-06-06 03:43:22', '2019-06-06 03:43:22', 1),
(325, 1, 17, 2, 1, '2019-06-06 03:43:22', '2019-06-06 03:43:22', 1),
(326, 1, 18, 1, 1, '2019-06-06 03:43:22', '2019-06-06 03:43:22', 1),
(327, 1, 19, 2, 1, '2019-06-06 03:43:22', '2019-06-06 03:43:22', 1),
(328, 1, 20, 1, 1, '2019-06-06 03:43:22', '2019-06-06 03:43:22', 1),
(329, 1, 21, 2, 1, '2019-06-06 03:43:22', '2019-06-06 03:43:22', 1),
(330, 1, 22, 1, 1, '2019-06-06 03:43:22', '2019-06-06 03:43:22', 1),
(331, 1, 23, 2, 1, '2019-06-06 03:43:23', '2019-06-06 03:43:23', 1),
(332, 1, 24, 1, 1, '2019-06-06 03:43:23', '2019-06-06 03:43:23', 1),
(333, 1, 25, 2, 1, '2019-06-06 03:43:23', '2019-06-06 03:43:23', 1),
(334, 1, 26, 1, 1, '2019-06-06 03:43:23', '2019-06-06 03:43:23', 1),
(335, 1, 27, 2, 1, '2019-06-06 03:43:23', '2019-06-06 03:43:23', 1),
(336, 1, 28, 1, 1, '2019-06-06 03:43:23', '2019-06-06 03:43:23', 1),
(337, 1, 29, 2, 1, '2019-06-06 03:43:23', '2019-06-06 03:43:23', 1),
(338, 1, 30, 1, 1, '2019-06-06 03:43:23', '2019-06-06 03:43:23', 1),
(339, 1, 31, 2, 1, '2019-06-06 03:43:23', '2019-06-06 03:43:23', 1),
(340, 1, 32, 1, 1, '2019-06-06 03:43:23', '2019-06-06 03:43:23', 1),
(341, 1, 33, 2, 1, '2019-06-06 03:43:23', '2019-06-06 03:43:23', 1),
(342, 1, 34, 1, 1, '2019-06-06 03:43:23', '2019-06-06 03:43:23', 1),
(343, 1, 35, 2, 1, '2019-06-06 03:43:23', '2019-06-06 03:43:23', 1),
(344, 1, 36, 2, 1, '2019-06-06 03:43:24', '2019-06-06 03:43:24', 1),
(345, 1, 37, 1, 1, '2019-06-06 03:43:24', '2019-06-06 03:43:24', 1),
(346, 1, 38, 2, 1, '2019-06-06 03:43:24', '2019-06-06 03:43:24', 1),
(347, 1, 39, 2, 1, '2019-06-06 03:43:24', '2019-06-06 03:43:24', 1),
(348, 1, 40, 1, 1, '2019-06-06 03:43:24', '2019-06-06 03:43:24', 1),
(349, 1, 41, 2, 1, '2019-06-06 03:43:24', '2019-06-06 03:43:24', 1),
(350, 1, 42, 1, 1, '2019-06-06 03:43:24', '2019-06-06 03:43:24', 1),
(351, 1, 43, 2, 1, '2019-06-06 03:43:24', '2019-06-06 03:43:24', 1),
(352, 1, 44, 1, 1, '2019-06-06 03:43:24', '2019-06-06 03:43:24', 1),
(379, 1, 1, 1, 2, '2019-06-06 04:42:26', '2019-06-06 04:42:26', 1),
(380, 1, 2, 3, 2, '2019-06-06 04:42:27', '2019-06-06 04:42:27', 1),
(381, 1, 3, 3, 2, '2019-06-06 04:42:27', '2019-06-06 04:42:27', 0),
(382, 1, 4, 3, 2, '2019-06-06 04:42:27', '2019-06-06 04:42:27', 0),
(383, 1, 5, 1, 2, '2019-06-06 04:42:27', '2019-06-06 04:42:27', 0),
(384, 1, 6, 3, 2, '2019-06-06 04:42:27', '2019-06-06 04:42:27', 0),
(385, 1, 7, 4, 2, '2019-06-06 04:42:27', '2019-06-06 04:42:27', 0),
(386, 1, 8, 1, 2, '2019-06-06 04:42:27', '2019-06-06 04:42:27', 0),
(387, 1, 9, 3, 2, '2019-06-06 04:42:27', '2019-06-06 04:42:27', 1),
(388, 1, 10, 3, 2, '2019-06-06 04:42:27', '2019-06-06 04:42:27', 0),
(389, 1, 11, 2, 2, '2019-06-06 04:42:27', '2019-06-06 04:42:27', 1),
(390, 1, 12, 1, 2, '2019-06-06 04:42:27', '2019-06-06 04:42:27', 0),
(391, 1, 13, 1, 2, '2019-06-06 04:42:27', '2019-06-06 04:42:27', 0),
(392, 1, 14, 3, 2, '2019-06-06 04:42:27', '2019-06-06 04:42:27', 1),
(393, 1, 15, 2, 2, '2019-06-06 04:42:27', '2019-06-06 04:42:27', 1),
(394, 1, 16, 2, 2, '2019-06-06 04:42:27', '2019-06-06 04:42:27', 1),
(395, 1, 17, 3, 2, '2019-06-06 04:42:27', '2019-06-06 04:42:27', 0),
(396, 1, 18, 2, 2, '2019-06-06 04:42:27', '2019-06-06 04:42:27', 0),
(397, 1, 19, 3, 2, '2019-06-06 04:42:27', '2019-06-06 04:42:27', 0),
(398, 1, 20, 3, 2, '2019-06-06 04:42:27', '2019-06-06 04:42:27', 0),
(399, 1, 21, 2, 2, '2019-06-06 04:42:28', '2019-06-06 04:42:28', 0),
(400, 1, 22, 2, 2, '2019-06-06 04:42:28', '2019-06-06 04:42:28', 0),
(401, 1, 23, 3, 2, '2019-06-06 04:42:28', '2019-06-06 04:42:28', 0),
(402, 1, 24, 2, 2, '2019-06-06 04:42:28', '2019-06-06 04:42:28', 0),
(403, 1, 25, 1, 2, '2019-06-06 04:42:28', '2019-06-06 04:42:28', 0),
(404, 1, 26, 2, 2, '2019-06-06 04:42:28', '2019-06-06 04:42:28', 0),
(405, 2, 1, 1, 1, '2019-06-06 08:13:40', '2019-06-06 08:13:40', 1),
(406, 2, 2, 2, 1, '2019-06-06 08:13:40', '2019-06-06 08:13:40', 1),
(407, 2, 3, 1, 1, '2019-06-06 08:13:40', '2019-06-06 08:13:40', 1),
(408, 2, 4, 1, 1, '2019-06-06 08:13:40', '2019-06-06 08:13:40', 1),
(409, 2, 5, 1, 1, '2019-06-06 08:13:40', '2019-06-06 08:13:40', 1),
(410, 2, 6, 1, 1, '2019-06-06 08:13:40', '2019-06-06 08:13:40', 1),
(411, 2, 7, 1, 1, '2019-06-06 08:13:40', '2019-06-06 08:13:40', 1),
(412, 2, 8, 1, 1, '2019-06-06 08:13:40', '2019-06-06 08:13:40', 1),
(413, 2, 9, 1, 1, '2019-06-06 08:13:40', '2019-06-06 08:13:40', 1),
(414, 2, 10, 1, 1, '2019-06-06 08:13:40', '2019-06-06 08:13:40', 1),
(415, 2, 11, 1, 1, '2019-06-06 08:13:40', '2019-06-06 08:13:40', 1),
(416, 2, 12, 1, 1, '2019-06-06 08:13:41', '2019-06-06 08:13:41', 1),
(417, 2, 13, 1, 1, '2019-06-06 08:13:41', '2019-06-06 08:13:41', 1),
(418, 2, 14, 1, 1, '2019-06-06 08:13:41', '2019-06-06 08:13:41', 1),
(419, 2, 15, 1, 1, '2019-06-06 08:13:41', '2019-06-06 08:13:41', 1),
(420, 2, 16, 1, 1, '2019-06-06 08:13:41', '2019-06-06 08:13:41', 1),
(421, 2, 17, 1, 1, '2019-06-06 08:13:41', '2019-06-06 08:13:41', 1),
(422, 2, 18, 1, 1, '2019-06-06 08:13:41', '2019-06-06 08:13:41', 1),
(423, 2, 19, 1, 1, '2019-06-06 08:13:41', '2019-06-06 08:13:41', 1),
(424, 2, 20, 1, 1, '2019-06-06 08:13:41', '2019-06-06 08:13:41', 1),
(425, 2, 21, 1, 1, '2019-06-06 08:13:42', '2019-06-06 08:13:42', 1),
(426, 2, 22, 1, 1, '2019-06-06 08:13:42', '2019-06-06 08:13:42', 1),
(427, 2, 23, 1, 1, '2019-06-06 08:13:42', '2019-06-06 08:13:42', 1),
(428, 2, 24, 1, 1, '2019-06-06 08:13:42', '2019-06-06 08:13:42', 1),
(429, 2, 25, 1, 1, '2019-06-06 08:13:42', '2019-06-06 08:13:42', 1),
(430, 2, 26, 1, 1, '2019-06-06 08:13:42', '2019-06-06 08:13:42', 1),
(431, 2, 27, 1, 1, '2019-06-06 08:13:42', '2019-06-06 08:13:42', 1),
(432, 2, 28, 1, 1, '2019-06-06 08:13:42', '2019-06-06 08:13:42', 1),
(433, 2, 29, 1, 1, '2019-06-06 08:13:42', '2019-06-06 08:13:42', 1),
(434, 2, 30, 1, 1, '2019-06-06 08:13:42', '2019-06-06 08:13:42', 1),
(435, 2, 31, 1, 1, '2019-06-06 08:13:42', '2019-06-06 08:13:42', 1),
(436, 2, 32, 1, 1, '2019-06-06 08:13:42', '2019-06-06 08:13:42', 1),
(437, 2, 33, 1, 1, '2019-06-06 08:13:42', '2019-06-06 08:13:42', 1),
(438, 2, 34, 1, 1, '2019-06-06 08:13:42', '2019-06-06 08:13:42', 1),
(439, 2, 35, 1, 1, '2019-06-06 08:13:42', '2019-06-06 08:13:42', 1),
(440, 2, 36, 1, 1, '2019-06-06 08:13:42', '2019-06-06 08:13:42', 1),
(441, 2, 37, 1, 1, '2019-06-06 08:13:42', '2019-06-06 08:13:42', 1),
(442, 2, 38, 1, 1, '2019-06-06 08:13:43', '2019-06-06 08:13:43', 1),
(443, 2, 39, 1, 1, '2019-06-06 08:13:43', '2019-06-06 08:13:43', 1),
(444, 2, 40, 1, 1, '2019-06-06 08:13:43', '2019-06-06 08:13:43', 1),
(445, 2, 41, 1, 1, '2019-06-06 08:13:43', '2019-06-06 08:13:43', 1),
(446, 2, 42, 1, 1, '2019-06-06 08:13:43', '2019-06-06 08:13:43', 1),
(447, 2, 43, 1, 1, '2019-06-06 08:13:43', '2019-06-06 08:13:43', 1),
(448, 2, 44, 1, 1, '2019-06-06 08:13:43', '2019-06-06 08:13:43', 1),
(501, 4, 1, 1, 1, '2019-06-06 13:14:44', '2019-06-06 13:14:44', 1),
(502, 4, 2, 2, 1, '2019-06-06 13:14:44', '2019-06-06 13:14:44', 1),
(503, 4, 3, 1, 1, '2019-06-06 13:14:44', '2019-06-06 13:14:44', 1),
(504, 4, 4, 2, 1, '2019-06-06 13:14:44', '2019-06-06 13:14:44', 1),
(505, 4, 5, 1, 1, '2019-06-06 13:14:44', '2019-06-06 13:14:44', 1),
(506, 4, 6, 2, 1, '2019-06-06 13:14:44', '2019-06-06 13:14:44', 1),
(507, 4, 7, 1, 1, '2019-06-06 13:14:44', '2019-06-06 13:14:44', 1),
(508, 4, 8, 1, 1, '2019-06-06 13:14:44', '2019-06-06 13:14:44', 1),
(509, 4, 9, 2, 1, '2019-06-06 13:14:44', '2019-06-06 13:14:44', 1),
(510, 4, 10, 1, 1, '2019-06-06 13:14:44', '2019-06-06 13:14:44', 1),
(511, 4, 11, 2, 1, '2019-06-06 13:14:44', '2019-06-06 13:14:44', 1),
(512, 4, 12, 1, 1, '2019-06-06 13:14:44', '2019-06-06 13:14:44', 1),
(513, 4, 13, 2, 1, '2019-06-06 13:14:44', '2019-06-06 13:14:44', 1),
(514, 4, 14, 2, 1, '2019-06-06 13:14:44', '2019-06-06 13:14:44', 1),
(515, 4, 15, 2, 1, '2019-06-06 13:14:44', '2019-06-06 13:14:44', 1),
(516, 4, 16, 1, 1, '2019-06-06 13:14:44', '2019-06-06 13:14:44', 1),
(517, 4, 17, 2, 1, '2019-06-06 13:14:44', '2019-06-06 13:14:44', 1),
(518, 4, 18, 1, 1, '2019-06-06 13:14:44', '2019-06-06 13:14:44', 1),
(519, 4, 19, 2, 1, '2019-06-06 13:14:44', '2019-06-06 13:14:44', 1),
(520, 4, 20, 1, 1, '2019-06-06 13:14:45', '2019-06-06 13:14:45', 1),
(521, 4, 21, 2, 1, '2019-06-06 13:14:45', '2019-06-06 13:14:45', 1),
(522, 4, 22, 1, 1, '2019-06-06 13:14:45', '2019-06-06 13:14:45', 1),
(523, 4, 23, 2, 1, '2019-06-06 13:14:45', '2019-06-06 13:14:45', 1),
(524, 4, 24, 2, 1, '2019-06-06 13:14:45', '2019-06-06 13:14:45', 1),
(525, 4, 25, 1, 1, '2019-06-06 13:14:45', '2019-06-06 13:14:45', 1),
(526, 4, 26, 2, 1, '2019-06-06 13:14:45', '2019-06-06 13:14:45', 1),
(527, 4, 27, 2, 1, '2019-06-06 13:14:45', '2019-06-06 13:14:45', 1),
(528, 4, 28, 1, 1, '2019-06-06 13:14:45', '2019-06-06 13:14:45', 1),
(529, 4, 29, 2, 1, '2019-06-06 13:14:45', '2019-06-06 13:14:45', 1),
(530, 4, 30, 1, 1, '2019-06-06 13:14:45', '2019-06-06 13:14:45', 1),
(531, 4, 31, 2, 1, '2019-06-06 13:14:45', '2019-06-06 13:14:45', 1),
(532, 4, 32, 1, 1, '2019-06-06 13:14:45', '2019-06-06 13:14:45', 1),
(533, 4, 33, 2, 1, '2019-06-06 13:14:45', '2019-06-06 13:14:45', 1),
(534, 4, 34, 1, 1, '2019-06-06 13:14:45', '2019-06-06 13:14:45', 1),
(535, 4, 35, 2, 1, '2019-06-06 13:14:45', '2019-06-06 13:14:45', 1),
(536, 4, 36, 1, 1, '2019-06-06 13:14:45', '2019-06-06 13:14:45', 1),
(537, 4, 37, 2, 1, '2019-06-06 13:14:45', '2019-06-06 13:14:45', 1),
(538, 4, 38, 1, 1, '2019-06-06 13:14:45', '2019-06-06 13:14:45', 1),
(539, 4, 39, 2, 1, '2019-06-06 13:14:45', '2019-06-06 13:14:45', 1),
(540, 4, 40, 1, 1, '2019-06-06 13:14:45', '2019-06-06 13:14:45', 1),
(541, 4, 41, 2, 1, '2019-06-06 13:14:45', '2019-06-06 13:14:45', 1),
(542, 4, 42, 1, 1, '2019-06-06 13:14:45', '2019-06-06 13:14:45', 1),
(543, 4, 43, 2, 1, '2019-06-06 13:14:46', '2019-06-06 13:14:46', 1),
(544, 4, 44, 1, 1, '2019-06-06 13:14:46', '2019-06-06 13:14:46', 1),
(545, 4, 1, 3, 2, '2019-06-06 13:16:39', '2019-06-06 13:16:39', 0),
(546, 4, 2, 2, 2, '2019-06-06 13:16:39', '2019-06-06 13:16:39', 0),
(547, 4, 3, 4, 2, '2019-06-06 13:16:39', '2019-06-06 13:16:39', 1),
(548, 4, 4, 2, 2, '2019-06-06 13:16:39', '2019-06-06 13:16:39', 1),
(549, 4, 5, 3, 2, '2019-06-06 13:16:39', '2019-06-06 13:16:39', 1),
(550, 4, 6, 4, 2, '2019-06-06 13:16:39', '2019-06-06 13:16:39', 0),
(551, 4, 7, 2, 2, '2019-06-06 13:16:39', '2019-06-06 13:16:39', 0),
(552, 4, 8, 2, 2, '2019-06-06 13:16:39', '2019-06-06 13:16:39', 1),
(553, 4, 9, 2, 2, '2019-06-06 13:16:39', '2019-06-06 13:16:39', 0),
(554, 4, 10, 4, 2, '2019-06-06 13:16:39', '2019-06-06 13:16:39', 1),
(555, 4, 11, 2, 2, '2019-06-06 13:16:39', '2019-06-06 13:16:39', 1),
(556, 4, 12, 1, 2, '2019-06-06 13:16:39', '2019-06-06 13:16:39', 0),
(557, 4, 13, 3, 2, '2019-06-06 13:16:39', '2019-06-06 13:16:39', 0),
(558, 4, 14, 3, 2, '2019-06-06 13:16:39', '2019-06-06 13:16:39', 1),
(559, 4, 15, 1, 2, '2019-06-06 13:16:39', '2019-06-06 13:16:39', 0),
(560, 4, 16, 1, 2, '2019-06-06 13:16:39', '2019-06-06 13:16:39', 0),
(561, 4, 17, 2, 2, '2019-06-06 13:16:39', '2019-06-06 13:16:39', 1),
(562, 4, 18, 2, 2, '2019-06-06 13:16:39', '2019-06-06 13:16:39', 0),
(563, 4, 19, 3, 2, '2019-06-06 13:16:39', '2019-06-06 13:16:39', 0),
(564, 4, 20, 4, 2, '2019-06-06 13:16:40', '2019-06-06 13:16:40', 0),
(565, 4, 21, 3, 2, '2019-06-06 13:16:40', '2019-06-06 13:16:40', 1),
(566, 4, 22, 2, 2, '2019-06-06 13:16:40', '2019-06-06 13:16:40', 0),
(567, 4, 23, 2, 2, '2019-06-06 13:16:40', '2019-06-06 13:16:40', 0),
(568, 4, 24, 3, 2, '2019-06-06 13:16:40', '2019-06-06 13:16:40', 0),
(569, 4, 25, 1, 2, '2019-06-06 13:16:40', '2019-06-06 13:16:40', 0),
(570, 4, 26, 2, 2, '2019-06-06 13:16:40', '2019-06-06 13:16:40', 0),
(571, 5, 1, 2, 2, '2019-06-06 15:02:07', '2019-06-06 15:02:07', 0),
(572, 5, 2, 2, 2, '2019-06-06 15:02:07', '2019-06-06 15:02:07', 0),
(573, 5, 3, 3, 2, '2019-06-06 15:02:07', '2019-06-06 15:02:07', 0),
(574, 5, 4, 3, 2, '2019-06-06 15:02:07', '2019-06-06 15:02:07', 0),
(575, 5, 5, 1, 2, '2019-06-06 15:02:07', '2019-06-06 15:02:07', 0),
(576, 5, 6, 2, 2, '2019-06-06 15:02:07', '2019-06-06 15:02:07', 1),
(577, 5, 7, 4, 2, '2019-06-06 15:02:07', '2019-06-06 15:02:07', 0),
(578, 5, 8, 2, 2, '2019-06-06 15:02:07', '2019-06-06 15:02:07', 1),
(579, 5, 9, 1, 2, '2019-06-06 15:02:07', '2019-06-06 15:02:07', 0),
(580, 5, 10, 2, 2, '2019-06-06 15:02:07', '2019-06-06 15:02:07', 0),
(581, 5, 11, 4, 2, '2019-06-06 15:02:07', '2019-06-06 15:02:07', 0),
(582, 5, 12, 3, 2, '2019-06-06 15:02:07', '2019-06-06 15:02:07', 0),
(583, 5, 13, 2, 2, '2019-06-06 15:02:07', '2019-06-06 15:02:07', 0),
(584, 5, 14, 3, 2, '2019-06-06 15:02:07', '2019-06-06 15:02:07', 1),
(585, 5, 15, 2, 2, '2019-06-06 15:02:07', '2019-06-06 15:02:07', 1),
(586, 5, 16, 1, 2, '2019-06-06 15:02:07', '2019-06-06 15:02:07', 0),
(587, 5, 17, 2, 2, '2019-06-06 15:02:07', '2019-06-06 15:02:07', 1),
(588, 5, 18, 2, 2, '2019-06-06 15:02:07', '2019-06-06 15:02:07', 0),
(589, 5, 19, 3, 2, '2019-06-06 15:02:07', '2019-06-06 15:02:07', 0),
(590, 5, 20, 2, 2, '2019-06-06 15:02:07', '2019-06-06 15:02:07', 1),
(591, 5, 21, 2, 2, '2019-06-06 15:02:07', '2019-06-06 15:02:07', 0),
(592, 5, 22, 4, 2, '2019-06-06 15:02:07', '2019-06-06 15:02:07', 0),
(593, 5, 23, 3, 2, '2019-06-06 15:02:08', '2019-06-06 15:02:08', 0),
(594, 5, 24, 2, 2, '2019-06-06 15:02:08', '2019-06-06 15:02:08', 0),
(595, 5, 25, 2, 2, '2019-06-06 15:02:08', '2019-06-06 15:02:08', 0),
(596, 5, 26, 4, 2, '2019-06-06 15:02:08', '2019-06-06 15:02:08', 0),
(597, 5, 1, 1, 1, '2019-06-06 15:04:58', '2019-06-06 15:04:58', 1),
(598, 5, 2, 2, 1, '2019-06-06 15:04:58', '2019-06-06 15:04:58', 1),
(599, 5, 3, 1, 1, '2019-06-06 15:04:58', '2019-06-06 15:04:58', 1),
(600, 5, 4, 2, 1, '2019-06-06 15:04:58', '2019-06-06 15:04:58', 1),
(601, 5, 5, 1, 1, '2019-06-06 15:04:58', '2019-06-06 15:04:58', 1),
(602, 5, 6, 2, 1, '2019-06-06 15:04:58', '2019-06-06 15:04:58', 1),
(603, 5, 7, 1, 1, '2019-06-06 15:04:58', '2019-06-06 15:04:58', 1),
(604, 5, 8, 2, 1, '2019-06-06 15:04:58', '2019-06-06 15:04:58', 1),
(605, 5, 9, 1, 1, '2019-06-06 15:04:58', '2019-06-06 15:04:58', 1),
(606, 5, 10, 2, 1, '2019-06-06 15:04:58', '2019-06-06 15:04:58', 1),
(607, 5, 11, 1, 1, '2019-06-06 15:04:58', '2019-06-06 15:04:58', 1),
(608, 5, 12, 2, 1, '2019-06-06 15:04:58', '2019-06-06 15:04:58', 1),
(609, 5, 13, 1, 1, '2019-06-06 15:04:58', '2019-06-06 15:04:58', 1),
(610, 5, 14, 2, 1, '2019-06-06 15:04:59', '2019-06-06 15:04:59', 1),
(611, 5, 15, 1, 1, '2019-06-06 15:04:59', '2019-06-06 15:04:59', 1),
(612, 5, 16, 2, 1, '2019-06-06 15:04:59', '2019-06-06 15:04:59', 1),
(613, 5, 17, 2, 1, '2019-06-06 15:04:59', '2019-06-06 15:04:59', 1),
(614, 5, 18, 1, 1, '2019-06-06 15:04:59', '2019-06-06 15:04:59', 1),
(615, 5, 19, 2, 1, '2019-06-06 15:04:59', '2019-06-06 15:04:59', 1),
(616, 5, 20, 1, 1, '2019-06-06 15:04:59', '2019-06-06 15:04:59', 1),
(617, 5, 21, 2, 1, '2019-06-06 15:04:59', '2019-06-06 15:04:59', 1),
(618, 5, 22, 1, 1, '2019-06-06 15:04:59', '2019-06-06 15:04:59', 1),
(619, 5, 23, 1, 1, '2019-06-06 15:04:59', '2019-06-06 15:04:59', 1),
(620, 5, 24, 2, 1, '2019-06-06 15:04:59', '2019-06-06 15:04:59', 1),
(621, 5, 25, 1, 1, '2019-06-06 15:04:59', '2019-06-06 15:04:59', 1),
(622, 5, 26, 2, 1, '2019-06-06 15:04:59', '2019-06-06 15:04:59', 1),
(623, 5, 27, 2, 1, '2019-06-06 15:04:59', '2019-06-06 15:04:59', 1),
(624, 5, 28, 2, 1, '2019-06-06 15:04:59', '2019-06-06 15:04:59', 1),
(625, 5, 29, 1, 1, '2019-06-06 15:04:59', '2019-06-06 15:04:59', 1),
(626, 5, 30, 2, 1, '2019-06-06 15:04:59', '2019-06-06 15:04:59', 1),
(627, 5, 31, 1, 1, '2019-06-06 15:04:59', '2019-06-06 15:04:59', 1),
(628, 5, 32, 2, 1, '2019-06-06 15:04:59', '2019-06-06 15:04:59', 1),
(629, 5, 33, 1, 1, '2019-06-06 15:04:59', '2019-06-06 15:04:59', 1),
(630, 5, 34, 1, 1, '2019-06-06 15:04:59', '2019-06-06 15:04:59', 1),
(631, 5, 35, 2, 1, '2019-06-06 15:05:00', '2019-06-06 15:05:00', 1),
(632, 5, 36, 1, 1, '2019-06-06 15:05:00', '2019-06-06 15:05:00', 1),
(633, 5, 37, 2, 1, '2019-06-06 15:05:00', '2019-06-06 15:05:00', 1),
(634, 5, 38, 1, 1, '2019-06-06 15:05:00', '2019-06-06 15:05:00', 1),
(635, 5, 39, 1, 1, '2019-06-06 15:05:00', '2019-06-06 15:05:00', 1),
(636, 5, 40, 2, 1, '2019-06-06 15:05:00', '2019-06-06 15:05:00', 1),
(637, 5, 41, 1, 1, '2019-06-06 15:05:00', '2019-06-06 15:05:00', 1),
(638, 5, 42, 2, 1, '2019-06-06 15:05:00', '2019-06-06 15:05:00', 1),
(639, 5, 43, 1, 1, '2019-06-06 15:05:00', '2019-06-06 15:05:00', 1),
(640, 5, 44, 2, 1, '2019-06-06 15:05:00', '2019-06-06 15:05:00', 1),
(641, 2, 1, 3, 2, '2019-06-12 03:48:46', '2019-06-12 03:48:46', 0),
(642, 2, 2, 4, 2, '2019-06-12 03:48:46', '2019-06-12 03:48:46', 0),
(643, 2, 3, 2, 2, '2019-06-12 03:48:46', '2019-06-12 03:48:46', 0),
(644, 2, 4, 1, 2, '2019-06-12 03:48:47', '2019-06-12 03:48:47', 0),
(645, 2, 5, 2, 2, '2019-06-12 03:48:47', '2019-06-12 03:48:47', 0),
(646, 2, 6, 3, 2, '2019-06-12 03:48:47', '2019-06-12 03:48:47', 0),
(647, 2, 7, 1, 2, '2019-06-12 03:48:47', '2019-06-12 03:48:47', 1),
(648, 2, 8, 2, 2, '2019-06-12 03:48:47', '2019-06-12 03:48:47', 1),
(649, 2, 9, 2, 2, '2019-06-12 03:48:47', '2019-06-12 03:48:47', 0),
(650, 2, 10, 3, 2, '2019-06-12 03:48:47', '2019-06-12 03:48:47', 0),
(651, 2, 11, 1, 2, '2019-06-12 03:48:47', '2019-06-12 03:48:47', 0),
(652, 2, 12, 4, 2, '2019-06-12 03:48:47', '2019-06-12 03:48:47', 0),
(653, 2, 13, 2, 2, '2019-06-12 03:48:47', '2019-06-12 03:48:47', 0),
(654, 2, 14, 3, 2, '2019-06-12 03:48:47', '2019-06-12 03:48:47', 1),
(655, 2, 15, 4, 2, '2019-06-12 03:48:47', '2019-06-12 03:48:47', 0),
(656, 2, 16, 4, 2, '2019-06-12 03:48:47', '2019-06-12 03:48:47', 0),
(657, 2, 17, 3, 2, '2019-06-12 03:48:47', '2019-06-12 03:48:47', 0),
(658, 2, 18, 3, 2, '2019-06-12 03:48:47', '2019-06-12 03:48:47', 1),
(659, 2, 19, 4, 2, '2019-06-12 03:48:47', '2019-06-12 03:48:47', 0),
(660, 2, 20, 3, 2, '2019-06-12 03:48:47', '2019-06-12 03:48:47', 0),
(661, 2, 21, 3, 2, '2019-06-12 03:48:47', '2019-06-12 03:48:47', 1),
(662, 2, 22, 3, 2, '2019-06-12 03:48:47', '2019-06-12 03:48:47', 0),
(663, 2, 23, 4, 2, '2019-06-12 03:48:47', '2019-06-12 03:48:47', 0),
(664, 2, 24, 3, 2, '2019-06-12 03:48:47', '2019-06-12 03:48:47', 0),
(665, 2, 25, 3, 2, '2019-06-12 03:48:48', '2019-06-12 03:48:48', 1),
(666, 2, 26, 3, 2, '2019-06-12 03:48:48', '2019-06-12 03:48:48', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `lastname`, `type`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Alejandro', 'Santillán', '1', 'aledgar.2710@gmail.com', NULL, '$2y$10$3f42JEe4iZIMypfqAU60Ju0bwHH5T4ewxBmA4WHFINmGZmpseCwDq', 'JoxzmS63H1Mgl3Agciw0ebdI134Rq4o9SNdBChUSiQOrVWC6mnNWBOLld48m', '2019-03-18 03:02:11', '2019-03-18 03:02:11'),
(2, 'Lalo', 'Oliva', '2', 'laop@gmail.com', NULL, '$2y$10$JEJhF2iVimfu9/TJdBnwuOTaIBDKs3Cji.6qj1EGuTIehF2XQxNYO', NULL, '2019-03-28 20:41:30', '2019-04-04 19:14:47'),
(3, 'Miguel', 'Meza', '2', 'mezam@gmail.com', NULL, '$2y$10$i2tANuxdYHTdgGSAMzuivu87SUZkHZkA4dwZsmQDKbMP3rnclndCm', NULL, '2019-03-28 21:28:58', '2019-03-28 21:28:58'),
(4, 'El Alejandro', 'Santillán', '2', 'elalejandro@gmail.com', NULL, '$2y$10$xBNrqWBuRzTWoH779eQeGOwa63mq/ILS85zUKezx7DkRTIxOR/IJW', NULL, '2019-04-07 21:29:31', '2019-04-07 21:29:31'),
(5, 'Alejandro', 'Martínez', '3', 'alejmtz@gmail.com', NULL, '123456789', NULL, '2019-05-27 01:10:05', '2019-05-27 01:10:05'),
(6, 'Alejandrito', 'Martínez', '3', 'alej@gmail.com', NULL, '$2y$10$R6QCI6vfW5343BG0jR1lb.I15KzxnFmihWfbNeBk0XdJhIlqnRCbm', NULL, '2019-05-27 01:10:55', '2019-05-27 18:19:07'),
(7, 'Mary', 'Ulloa', '3', 'mulloa@gmail.com', NULL, '$2y$10$R6QCI6vfW5343BG0jR1lb.I15KzxnFmihWfbNeBk0XdJhIlqnRCbm', NULL, '2019-05-27 01:15:16', '2019-06-06 04:44:25'),
(8, 'Pancho', 'Ramirez', '3', 'pe@gmail.com', NULL, '123456789', NULL, '2019-05-27 01:16:11', '2019-05-27 01:16:11'),
(9, 'Poncho', 'Perez', '3', 'ponco@gmail.com', NULL, '$2y$10$8gbWTg1xJiyGpShDNIj/tOUvGGQlFrjzrWLGstwPCGRXPN5cYO76e', NULL, '2019-06-06 13:10:28', '2019-06-06 13:10:28'),
(10, 'Gordita', 'Bonita', '3', 'gordita@gmail.com', NULL, '$2y$10$APXCiDXfQXL0S/cxgn6M2.8IZjnY7hvSJo7TT14Krw8bZGn8r5ybW', NULL, '2019-06-06 14:59:39', '2019-06-06 14:59:39');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD PRIMARY KEY (`id`),
  ADD KEY `alumno_id_user_foreign` (`id_user`),
  ADD KEY `alumno_id_grupo_foreign` (`id_grupo`);

--
-- Indices de la tabla `carrera`
--
ALTER TABLE `carrera`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `grupo`
--
ALTER TABLE `grupo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `grupo_id_institucion_foreign` (`id_institucion`),
  ADD KEY `fk_maestro_grupo` (`id_maestro`),
  ADD KEY `grupo_id_carrera_index` (`id_carrera`);

--
-- Indices de la tabla `institucion`
--
ALTER TABLE `institucion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `maestros`
--
ALTER TABLE `maestros`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_mto` (`id_user`);

--
-- Indices de la tabla `maestros_instituciones`
--
ALTER TABLE `maestros_instituciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_maestro_mi` (`id_maestro`),
  ADD KEY `fk_instituciones_mi` (`id_institucion`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `resultados_test`
--
ALTER TABLE `resultados_test`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumno`
--
ALTER TABLE `alumno`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `carrera`
--
ALTER TABLE `carrera`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `grupo`
--
ALTER TABLE `grupo`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `institucion`
--
ALTER TABLE `institucion`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `maestros`
--
ALTER TABLE `maestros`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `maestros_instituciones`
--
ALTER TABLE `maestros_instituciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT de la tabla `resultados_test`
--
ALTER TABLE `resultados_test`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=667;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD CONSTRAINT `alumno_id_grupo_foreign` FOREIGN KEY (`id_grupo`) REFERENCES `grupo` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `alumno_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `grupo`
--
ALTER TABLE `grupo`
  ADD CONSTRAINT `fk_maestro_grupo` FOREIGN KEY (`id_maestro`) REFERENCES `maestros` (`id`),
  ADD CONSTRAINT `grupo_id_institucion_foreign` FOREIGN KEY (`id_institucion`) REFERENCES `institucion` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `maestros`
--
ALTER TABLE `maestros`
  ADD CONSTRAINT `fk_user_mto` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `maestros_instituciones`
--
ALTER TABLE `maestros_instituciones`
  ADD CONSTRAINT `fk_instituciones_mi` FOREIGN KEY (`id_institucion`) REFERENCES `institucion` (`id`),
  ADD CONSTRAINT `fk_maestro_mi` FOREIGN KEY (`id_maestro`) REFERENCES `maestros` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;