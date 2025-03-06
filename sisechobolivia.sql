-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-02-2025 a las 19:47:26
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
-- Base de datos: `sisechobolivia`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `certificados`
--

CREATE TABLE `certificados` (
  `id_certificado` int(11) NOT NULL,
  `producto` varchar(255) NOT NULL,
  `composicion` text NOT NULL,
  `forma_id` int(11) NOT NULL,
  `medalla_id` int(11) NOT NULL,
  `fecha_emision` date NOT NULL,
  `fecha_vencimiento` date NOT NULL,
  `vigencia` varchar(50) NOT NULL,
  `documento` text NOT NULL,
  `numero_registro_sanitario` varchar(100) NOT NULL,
  `codigo_liname` varchar(100) NOT NULL,
  `ficha_tecnica` varchar(50) NOT NULL,
  `usuario_cert` varchar(255) NOT NULL,
  `estado_cert` varchar(11) NOT NULL,
  `fyh_creacion_certificado` datetime DEFAULT NULL,
  `fyh_actualizacion_certificado` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `certificados`
--

INSERT INTO `certificados` (`id_certificado`, `producto`, `composicion`, `forma_id`, `medalla_id`, `fecha_emision`, `fecha_vencimiento`, `vigencia`, `documento`, `numero_registro_sanitario`, `codigo_liname`, `ficha_tecnica`, `usuario_cert`, `estado_cert`, `fyh_creacion_certificado`, `fyh_actualizacion_certificado`) VALUES
(14, 'AZITROMICINA', '10 GRAMOS', 2, 2, '2025-02-13', '2025-02-06', '2', '2025-02-17-14-20-55-vacio.pdf', '10A', '10AB', 'habilitado', 'wilmerosco37@gmail.com', '1', '2025-02-17 02:20:55', NULL),
(15, 'WT433', '636363', 1, 1, '2025-02-05', '2025-02-08', '2', '2025-02-17-14-26-49-vacio.pdf', '3636363', '364363', 'habilitado', 'wilmerosco37@gmail.com', '1', '2025-02-17 02:26:49', NULL),
(16, '235252', '52532', 2, 2, '2025-02-07', '2025-02-28', '3', '2025-02-17-14-27-09-vacio.pdf', '25252', '2532523', 'habilitado', 'wilmerosco37@gmail.com', '1', '2025-02-17 02:27:09', NULL),
(17, '2525', '23523523523', 1, 1, '2025-02-14', '2025-03-14', '1', '2025-02-17-14-27-35-vacio.pdf', '252532', '2532525252', 'habilitado', 'wilmerosco37@gmail.com', '0', '2025-02-17 02:27:35', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formasfarmaceuticas`
--

CREATE TABLE `formasfarmaceuticas` (
  `id_forma` int(11) NOT NULL,
  `nombre_forma` varchar(255) NOT NULL,
  `fyh_creacion_forma` datetime DEFAULT NULL,
  `fyh_actualizacion_forma` datetime DEFAULT NULL,
  `estado_forma` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `formasfarmaceuticas`
--

INSERT INTO `formasfarmaceuticas` (`id_forma`, `nombre_forma`, `fyh_creacion_forma`, `fyh_actualizacion_forma`, `estado_forma`) VALUES
(1, 'CAPSULAS', '2025-02-11 12:35:00', NULL, '1'),
(2, 'COMPRIMIDOS', '2025-02-11 12:35:00', NULL, '1'),
(3, 'LIQUIDOS', '2025-02-11 12:35:00', NULL, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medallas`
--

CREATE TABLE `medallas` (
  `id_medalla` int(11) NOT NULL,
  `nombre_medalla` varchar(255) NOT NULL,
  `fyh_creacion_medalla` datetime DEFAULT NULL,
  `fyh_actualizacion_medalla` datetime DEFAULT NULL,
  `estado_medalla` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `medallas`
--

INSERT INTO `medallas` (`id_medalla`, `nombre_medalla`, `fyh_creacion_medalla`, `fyh_actualizacion_medalla`, `estado_medalla`) VALUES
(1, 'ORO', '2025-02-11 12:35:00', NULL, '1'),
(2, 'BRONCE', '2025-02-11 12:35:00', NULL, '1'),
(3, 'PLATA', '2025-02-11 12:35:00', NULL, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_rol` int(11) NOT NULL,
  `nombre_rol` varchar(255) NOT NULL,
  `fyh_creacion_rol` datetime DEFAULT NULL,
  `fyh_actualizacion_rol` datetime DEFAULT NULL,
  `estado_rol` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_rol`, `nombre_rol`, `fyh_creacion_rol`, `fyh_actualizacion_rol`, `estado_rol`) VALUES
(1, 'ADMINISTRADOR', '2025-02-11 12:35:00', NULL, '1'),
(2, 'DIRECCION TECNICA', '2025-02-11 12:35:00', NULL, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombres` varchar(255) NOT NULL,
  `apellidos` varchar(255) NOT NULL,
  `rol_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `perfil` text NOT NULL,
  `genero` varchar(255) NOT NULL,
  `fyh_creacion` datetime DEFAULT NULL,
  `fyh_actualizacion` datetime DEFAULT NULL,
  `estado` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombres`, `apellidos`, `rol_id`, `email`, `alias`, `password`, `perfil`, `genero`, `fyh_creacion`, `fyh_actualizacion`, `estado`) VALUES
(38, 'WILMER W', 'OSCO VERA', 1, 'wilmerosco37@gmail.com', 'WOSCOV', '$2y$10$Y7Gt0PEl/Xrz.zkDrTb6auRvOfwQ.pznTwYnk6Mmn3jBX0vLnVujO', '2025-02-17-14-19-22-hombre.png', 'masculino', NULL, '2025-02-17 02:19:22', '1'),
(39, 'wilmer wad', 'vera', 1, 'wilmeroafssco37@gmail.com', 'sfsfs', '$2y$10$XO6p3fnZ1nK8XtptF3HQ7eWIxByk6.vcvhLxWyIbWunU6eFQm2eae', '2025-02-17-14-19-30-hombre.png', 'masculino', '2025-02-13 12:55:02', '2025-02-17 02:19:30', '1');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `certificados`
--
ALTER TABLE `certificados`
  ADD PRIMARY KEY (`id_certificado`),
  ADD UNIQUE KEY `numero_registro_sanitario` (`numero_registro_sanitario`),
  ADD UNIQUE KEY `codigo_liname` (`codigo_liname`),
  ADD KEY `forma_id` (`forma_id`),
  ADD KEY `medalla_id` (`medalla_id`);

--
-- Indices de la tabla `formasfarmaceuticas`
--
ALTER TABLE `formasfarmaceuticas`
  ADD PRIMARY KEY (`id_forma`),
  ADD UNIQUE KEY `nombre_forma` (`nombre_forma`);

--
-- Indices de la tabla `medallas`
--
ALTER TABLE `medallas`
  ADD PRIMARY KEY (`id_medalla`),
  ADD UNIQUE KEY `nombre_medalla` (`nombre_medalla`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`),
  ADD UNIQUE KEY `nombre_rol` (`nombre_rol`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `usuario` (`alias`),
  ADD KEY `rol_id` (`rol_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `certificados`
--
ALTER TABLE `certificados`
  MODIFY `id_certificado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `formasfarmaceuticas`
--
ALTER TABLE `formasfarmaceuticas`
  MODIFY `id_forma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `medallas`
--
ALTER TABLE `medallas`
  MODIFY `id_medalla` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `certificados`
--
ALTER TABLE `certificados`
  ADD CONSTRAINT `certificados_ibfk_1` FOREIGN KEY (`forma_id`) REFERENCES `formasfarmaceuticas` (`id_forma`) ON UPDATE CASCADE,
  ADD CONSTRAINT `certificados_ibfk_2` FOREIGN KEY (`medalla_id`) REFERENCES `medallas` (`id_medalla`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id_rol`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
