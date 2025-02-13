-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-02-2025 a las 11:17:08
-- Versión del servidor: 10.4.6-MariaDB
-- Versión de PHP: 7.2.22

*
    Proyecto Golazo SL
    Autor: Tabea Hirzel
    Licencia: GNU General Public License v3.0
    Descripción: Gestión de producción para una fábrica de pelotas

    Este archivo contiene las definiciones de las tablas y las relaciones necesarias para gestionar la base de datos.
*/

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `golazo3`
--
CREATE DATABASE IF NOT EXISTS `golazo3` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `golazo3`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `maquinas`
--
-- Creación: 13-02-2025 a las 08:13:13
-- Última actualización: 13-02-2025 a las 08:41:37
--

DROP TABLE IF EXISTS `maquinas`;
CREATE TABLE IF NOT EXISTS `maquinas` (
  `no` int(11) NOT NULL COMMENT 'Parte de la clave. Según el tipo de numeración usada, podría ser la clave sin necesidad del modelo.',
  `marca` enum('MAPLAN','COLLIN','GIFFIN','TEXO') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Propiedad que aporta información. Podría ser referenciado de una tabla externa, pero se simplifica así.',
  `modelo` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Parte de la clave. Por temas de patente, en general modelos son únicos, y la marca es implícita.',
  PRIMARY KEY (`no`,`modelo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `maquinas`
--

INSERT INTO `maquinas` (`no`, `marca`, `modelo`) VALUES
(1, 'MAPLAN', 'MHF7000 - Rubber Injection'),
(2, 'COLLIN', 'P500 Rubber Mixer'),
(3, 'COLLIN', 'P300 Polymer Extruder'),
(4, 'MAPLAN', 'Injection Molder X100'),
(5, 'TEXO', 'WFX1200 Textile Weaver'),
(6, 'GIFFIN', 'Layer Laminator 350'),
(7, 'GIFFIN', 'FTX-Coater 500'),
(8, 'TEXO', 'Precision Stitcher 800'),
(9, 'MAPLAN', 'MHF7000 - Rubber Injection'),
(10, 'COLLIN', 'High-Pressure Coater XP'),
(11, 'COLLIN', 'P300 Polymer Extruder'),
(12, 'GIFFIN', 'Air Retention Tester 200'),
(13, 'TEXO', 'Precision Stitcher 800'),
(14, 'MAPLAN', 'MHF7000 - Rubber Injection');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `maquinas_tecnicos`
--
-- Creación: 13-02-2025 a las 08:02:51
-- Última actualización: 13-02-2025 a las 08:41:17
--

DROP TABLE IF EXISTS `maquinas_tecnicos`;
CREATE TABLE IF NOT EXISTS `maquinas_tecnicos` (
  `maquina_no` int(11) NOT NULL,
  `maquina_modelo` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tecnico_dni` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `inicio` datetime NOT NULL DEFAULT '2024-01-01 00:00:00',
  `fin` datetime NOT NULL DEFAULT '2024-12-31 23:59:59',
  PRIMARY KEY (`maquina_no`,`maquina_modelo`,`tecnico_dni`),
  KEY `tecnico_dni` (`tecnico_dni`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `maquinas_tecnicos`
--

INSERT INTO `maquinas_tecnicos` (`maquina_no`, `maquina_modelo`, `tecnico_dni`, `inicio`, `fin`) VALUES
(2, 'P500 Rubber Mixer', '123456789V', '2024-01-01 00:00:00', '2024-12-31 23:59:59'),
(3, 'P300 Polymer Extruder', '234567890G', '2024-01-01 00:00:00', '2024-12-31 23:59:59'),
(4, 'Injection Molder X100', '234567890G', '2024-01-01 00:00:00', '2024-12-31 23:59:59'),
(5, 'WFX1200 Textile Weaver', '345678901S', '2024-01-01 00:00:00', '2024-12-31 23:59:59'),
(6, 'Layer Laminator 350', '345678901S', '2024-01-01 00:00:00', '2024-12-31 23:59:59'),
(7, 'FTX-Coater 500', '234567890K', '2024-01-01 00:00:00', '2024-12-31 23:59:59'),
(8, 'Precision Stitcher 800', '234567890K', '2024-01-01 00:00:00', '2024-12-31 23:59:59'),
(9, 'MHF7000 - Rubber Injection', '345678901L', '2024-01-01 00:00:00', '2024-12-31 23:59:59'),
(10, 'High-Pressure Coater XP', '345678901L', '2024-01-01 00:00:00', '2024-12-31 23:59:59'),
(11, 'P300 Polymer Extruder', '345678901S', '2024-01-01 00:00:00', '2024-12-31 23:59:59'),
(12, 'Air Retention Tester 200', '345678901S', '2024-01-01 00:00:00', '2024-12-31 23:59:59'),
(13, 'Precision Stitcher 800', 'Y348292889', '2024-01-01 00:00:00', '2024-12-31 23:59:59');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `operaciones`
--
-- Creación: 13-02-2025 a las 08:02:51
-- Última actualización: 13-02-2025 a las 08:41:17
--

DROP TABLE IF EXISTS `operaciones`;
CREATE TABLE IF NOT EXISTS `operaciones` (
  `inicio` datetime NOT NULL,
  `fin` datetime NOT NULL,
  `planta` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `proceso` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `maquina_no` int(11) NOT NULL,
  `maquina_modelo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tecnico` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`inicio`,`maquina_no`,`tecnico`,`maquina_modelo`),
  KEY `maquina_no` (`maquina_no`,`maquina_modelo`),
  KEY `tecnico` (`tecnico`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `operaciones`
--

INSERT INTO `operaciones` (`inicio`, `fin`, `planta`, `proceso`, `maquina_no`, `maquina_modelo`, `tecnico`) VALUES
('2024-02-08 06:45:00', '2024-02-08 08:45:00', 'Verde', 'Recubrimiento y Estampado', 9, 'MHF7000 - Rubber Injection', '345678901L'),
('2024-02-08 07:30:00', '2024-02-08 09:30:00', 'Rojo', 'Montaje y Costura', 7, 'FTX-Coater 500', '234567890K'),
('2024-02-08 08:30:00', '2024-02-08 10:30:00', 'Azul', 'Moldeo y Formación', 3, 'P300 Polymer Extruder', '234567890G'),
('2024-02-08 08:30:00', '2024-02-08 10:30:00', 'Rojo', 'Inflado y Control de Calidad', 11, 'P300 Polymer Extruder', '345678901S'),
('2024-02-08 09:15:00', '2024-02-08 11:15:00', 'Azul', 'Moldeo y Formación', 4, 'Injection Molder X100', '234567890G'),
('2024-02-08 09:15:00', '2024-02-08 11:15:00', 'Rojo', 'Inflado y Control de Calidad', 12, 'Air Retention Tester 200', '345678901S'),
('2024-02-08 10:00:00', '2024-02-08 12:00:00', 'Blanco', 'Refuerzo y Capas', 5, 'WFX1200 Textile Weaver', '345678901S'),
('2024-02-08 15:00:00', '2024-02-08 17:00:00', 'Rojo', 'Montaje y Costura', 8, 'Precision Stitcher 800', '234567890K'),
('2024-02-08 15:00:00', '2024-02-08 17:00:00', 'Naranja', 'Mantenimiento', 13, 'Precision Stitcher 800', 'Y348292889'),
('2024-02-08 16:10:00', '2024-02-08 18:10:00', 'Amarillo', 'Preparación de Materiales', 2, 'P500 Rubber Mixer', '123456789V'),
('2024-02-08 17:20:00', '2024-02-08 19:20:00', 'Verde', 'Recubrimiento y Estampado', 10, 'High-Pressure Coater XP', '345678901L'),
('2024-02-08 19:40:00', '2024-02-08 21:40:00', 'Blanco', 'Refuerzo y Capas', 6, 'Layer Laminator 350', '345678901S');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plantas`
--
-- Creación: 13-02-2025 a las 08:02:51
-- Última actualización: 13-02-2025 a las 08:02:51
--

DROP TABLE IF EXISTS `plantas`;
CREATE TABLE IF NOT EXISTS `plantas` (
  `color` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Valor único utilizado como código para la planta.',
  `superficie` decimal(10,2) DEFAULT NULL COMMENT 'Propiedad arbitraria, no relevante para el funcionamiento de la BD.',
  `icono` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Icono opcional, añadido por la programadora para fines estéticos.',
  `tipo_pelota` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`color`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `plantas`
--

INSERT INTO `plantas` (`color`, `superficie`, `icono`, `tipo_pelota`) VALUES
('Amarillo', '250.00', '?', 'Voleibol'),
('Azul', '500.00', '⚽', 'Fútbol'),
('Blanco', '100.00', '⛳', 'Golf'),
('Naranja', '200.00', '✅', 'Todos'),
('Negro', '150.00', '✅', 'Todos'),
('Rojo', '300.00', '?', 'Baloncesto'),
('Verde', '200.00', '?', 'Tenis');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plantas_procesos`
--
-- Creación: 13-02-2025 a las 08:02:51
--

DROP TABLE IF EXISTS `plantas_procesos`;
CREATE TABLE IF NOT EXISTS `plantas_procesos` (
  `planta_color` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `proceso_nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` datetime NOT NULL COMMENT 'Fecha de inicio del proceso en la planta.',
  `end_date` datetime DEFAULT NULL COMMENT 'Fecha de fin del proceso en la planta (si aplica).',
  `inicio` datetime NOT NULL DEFAULT '2024-01-01 00:00:00',
  `fin` datetime NOT NULL DEFAULT '2024-12-31 23:59:59',
  PRIMARY KEY (`planta_color`,`proceso_nombre`),
  KEY `proceso_nombre` (`proceso_nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `plantas_procesos`
--

INSERT INTO `plantas_procesos` (`planta_color`, `proceso_nombre`, `start_date`, `end_date`, `inicio`, `fin`) VALUES
('Amarillo', 'Montaje y Costura', '0000-00-00 00:00:00', NULL, '2024-01-01 00:00:00', '2024-12-31 23:59:59'),
('Azul', 'Moldeo y Formación', '0000-00-00 00:00:00', NULL, '2024-01-01 00:00:00', '2024-12-31 23:59:59'),
('Blanco', 'Recubrimiento y Estampado', '0000-00-00 00:00:00', NULL, '2024-01-01 00:00:00', '2024-12-31 23:59:59'),
('Naranja', 'Mantenimiento', '0000-00-00 00:00:00', NULL, '2024-01-01 00:00:00', '2024-12-31 23:59:59'),
('Negro', 'Inflado y Control de Calidad', '0000-00-00 00:00:00', NULL, '2024-01-01 00:00:00', '2024-12-31 23:59:59'),
('Rojo', 'Preparación de Materiales', '0000-00-00 00:00:00', NULL, '2024-01-01 00:00:00', '2024-12-31 23:59:59'),
('Verde', 'Refuerzo y Capas', '0000-00-00 00:00:00', NULL, '2024-01-01 00:00:00', '2024-12-31 23:59:59');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `procesos`
--
-- Creación: 13-02-2025 a las 08:02:51
--

DROP TABLE IF EXISTS `procesos`;
CREATE TABLE IF NOT EXISTS `procesos` (
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'El nombre del proceso, único dentro de una planta.',
  `complejidad` enum('Baja','Media','Alta') COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Propiedad arbitraria, no relevante para el funcionamiento de la BD.',
  `planta_color` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'El color de la planta, utilizado para vincular un proceso a una planta específica.',
  PRIMARY KEY (`nombre`,`planta_color`),
  KEY `planta_color` (`planta_color`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `procesos`
--

INSERT INTO `procesos` (`nombre`, `complejidad`, `planta_color`) VALUES
('Inflado y Control de Calidad', 'Baja', 'Negro'),
('Mantenimiento', 'Baja', 'Naranja'),
('Moldeo y Formación', 'Media', 'Azul'),
('Montaje y Costura', 'Alta', 'Amarillo'),
('Preparación de Materiales', 'Alta', 'Rojo'),
('Recubrimiento y Estampado', 'Baja', 'Blanco'),
('Refuerzo y Capas', 'Media', 'Verde');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `procesos_maquinas`
--
-- Creación: 13-02-2025 a las 08:02:51
-- Última actualización: 13-02-2025 a las 08:41:17
--

DROP TABLE IF EXISTS `procesos_maquinas`;
CREATE TABLE IF NOT EXISTS `procesos_maquinas` (
  `proceso_nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `maquina_no` int(11) NOT NULL,
  `maquina_modelo` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `inicio` datetime NOT NULL DEFAULT '2024-01-01 00:00:00',
  `fin` datetime NOT NULL DEFAULT '2024-12-31 23:59:59',
  PRIMARY KEY (`proceso_nombre`,`maquina_no`,`maquina_modelo`),
  KEY `maquina_no` (`maquina_no`,`maquina_modelo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `procesos_maquinas`
--

INSERT INTO `procesos_maquinas` (`proceso_nombre`, `maquina_no`, `maquina_modelo`, `inicio`, `fin`) VALUES
('Inflado y Control de Calidad', 11, 'P300 Polymer Extruder', '2024-01-01 00:00:00', '2024-12-31 23:59:59'),
('Inflado y Control de Calidad', 12, 'Air Retention Tester 200', '2024-01-01 00:00:00', '2024-12-31 23:59:59'),
('Mantenimiento', 13, 'Precision Stitcher 800', '2024-01-01 00:00:00', '2024-12-31 23:59:59'),
('Moldeo y Formación', 3, 'P300 Polymer Extruder', '2024-01-01 00:00:00', '2024-12-31 23:59:59'),
('Moldeo y Formación', 4, 'Injection Molder X100', '2024-01-01 00:00:00', '2024-12-31 23:59:59'),
('Montaje y Costura', 7, 'FTX-Coater 500', '2024-01-01 00:00:00', '2024-12-31 23:59:59'),
('Montaje y Costura', 8, 'Precision Stitcher 800', '2024-01-01 00:00:00', '2024-12-31 23:59:59'),
('Preparación de Materiales', 2, 'P500 Rubber Mixer', '2024-01-01 00:00:00', '2024-12-31 23:59:59'),
('Recubrimiento y Estampado', 9, 'MHF7000 - Rubber Injection', '2024-01-01 00:00:00', '2024-12-31 23:59:59'),
('Recubrimiento y Estampado', 10, 'High-Pressure Coater XP', '2024-01-01 00:00:00', '2024-12-31 23:59:59'),
('Refuerzo y Capas', 5, 'WFX1200 Textile Weaver', '2024-01-01 00:00:00', '2024-12-31 23:59:59'),
('Refuerzo y Capas', 6, 'Layer Laminator 350', '2024-01-01 00:00:00', '2024-12-31 23:59:59');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tecnicos`
--
-- Creación: 13-02-2025 a las 08:02:51
-- Última actualización: 13-02-2025 a las 08:02:51
--

DROP TABLE IF EXISTS `tecnicos`;
CREATE TABLE IF NOT EXISTS `tecnicos` (
  `dni` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Debe ser único.',
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Nombre del técnico.',
  `apellido` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Apellido del técnico.',
  `fecha_nacimiento` date DEFAULT NULL COMMENT 'Fecha de nacimiento del técnico.',
  PRIMARY KEY (`dni`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tecnicos`
--

INSERT INTO `tecnicos` (`dni`, `nombre`, `apellido`, `fecha_nacimiento`) VALUES
('123456789T', 'Carlos', 'Martínez', '1982-02-12'),
('123456789V', 'Juan', 'Pérez', '1980-05-10'),
('234567890G', 'María', 'López', '1992-07-15'),
('234567890K', 'Laura', 'Gómez', '1990-05-30'),
('345678901L', 'Pedro', 'Jiménez', '1987-11-21'),
('345678901S', 'Ana', 'González', '1985-03-22'),
('Y348292889', 'Igor', 'Dobric', '2001-08-13');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `maquinas_tecnicos`
--
ALTER TABLE `maquinas_tecnicos`
  ADD CONSTRAINT `maquinas_tecnicos_ibfk_1` FOREIGN KEY (`maquina_no`,`maquina_modelo`) REFERENCES `maquinas` (`no`, `modelo`) ON DELETE CASCADE,
  ADD CONSTRAINT `maquinas_tecnicos_ibfk_2` FOREIGN KEY (`tecnico_dni`) REFERENCES `tecnicos` (`dni`) ON DELETE CASCADE;

--
-- Filtros para la tabla `operaciones`
--
ALTER TABLE `operaciones`
  ADD CONSTRAINT `operaciones_ibfk_1` FOREIGN KEY (`maquina_no`,`maquina_modelo`) REFERENCES `maquinas` (`no`, `modelo`) ON DELETE CASCADE,
  ADD CONSTRAINT `operaciones_ibfk_2` FOREIGN KEY (`tecnico`) REFERENCES `tecnicos` (`dni`) ON DELETE CASCADE;

--
-- Filtros para la tabla `plantas_procesos`
--
ALTER TABLE `plantas_procesos`
  ADD CONSTRAINT `plantas_procesos_ibfk_1` FOREIGN KEY (`planta_color`) REFERENCES `plantas` (`color`) ON DELETE CASCADE,
  ADD CONSTRAINT `plantas_procesos_ibfk_2` FOREIGN KEY (`proceso_nombre`) REFERENCES `procesos` (`nombre`) ON DELETE CASCADE;

--
-- Filtros para la tabla `procesos`
--
ALTER TABLE `procesos`
  ADD CONSTRAINT `procesos_ibfk_1` FOREIGN KEY (`planta_color`) REFERENCES `plantas` (`color`) ON DELETE CASCADE;

--
-- Filtros para la tabla `procesos_maquinas`
--
ALTER TABLE `procesos_maquinas`
  ADD CONSTRAINT `procesos_maquinas_ibfk_1` FOREIGN KEY (`proceso_nombre`) REFERENCES `procesos` (`nombre`) ON DELETE CASCADE,
  ADD CONSTRAINT `procesos_maquinas_ibfk_2` FOREIGN KEY (`maquina_no`,`maquina_modelo`) REFERENCES `maquinas` (`no`, `modelo`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
