-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-05-2026 a las 04:32:20
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
-- Base de datos: `clinica_muelitas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `CitNumero` int(11) NOT NULL,
  `CitFecha` date NOT NULL,
  `CitHora` time NOT NULL,
  `CitPaciente` varchar(20) NOT NULL,
  `CitMedico` varchar(20) NOT NULL,
  `CitConsultorio` int(11) NOT NULL,
  `CitEstado` varchar(20) NOT NULL,
  `CitObservaciones` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`CitNumero`, `CitFecha`, `CitHora`, `CitPaciente`, `CitMedico`, `CitConsultorio`, `CitEstado`, `CitObservaciones`) VALUES
(5, '2026-05-03', '11:20:00', '1106228736', '1106227843', 2, 'Cancelada', 'Ninguna'),
(6, '2026-05-04', '09:40:00', '1106228736', '1106227843', 2, 'Solicitada', 'Ninguna');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consultorios`
--

CREATE TABLE `consultorios` (
  `ConNumero` int(11) NOT NULL,
  `ConNombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `consultorios`
--

INSERT INTO `consultorios` (`ConNumero`, `ConNombre`) VALUES
(2, 'cirujia dental');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horas`
--

CREATE TABLE `horas` (
  `hora` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `horas`
--

INSERT INTO `horas` (`hora`) VALUES
('08:00:00'),
('08:20:00'),
('08:40:00'),
('09:00:00'),
('09:20:00'),
('09:40:00'),
('10:00:00'),
('10:20:00'),
('10:40:00'),
('11:00:00'),
('11:20:00'),
('11:40:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicos`
--

CREATE TABLE `medicos` (
  `MedIdentificacion` varchar(20) NOT NULL,
  `MedNombres` varchar(50) NOT NULL,
  `MedApellidos` varchar(50) NOT NULL,
  `MedUsuId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `medicos`
--

INSERT INTO `medicos` (`MedIdentificacion`, `MedNombres`, `MedApellidos`, `MedUsuId`) VALUES
('1106227843', 'Sebastian', 'Sierra Mirquez', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientes`
--

CREATE TABLE `pacientes` (
  `PacIdentificacion` varchar(20) NOT NULL,
  `PacNombres` varchar(50) NOT NULL,
  `PacApellidos` varchar(50) NOT NULL,
  `PacFechaNacimiento` date NOT NULL,
  `PacSexo` varchar(1) NOT NULL,
  `PacTelefono` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `pacientes`
--

INSERT INTO `pacientes` (`PacIdentificacion`, `PacNombres`, `PacApellidos`, `PacFechaNacimiento`, `PacSexo`, `PacTelefono`) VALUES
('1', 'leo', 'river', '2015-11-11', 'F', ''),
('1106228736', 'Juanito', 'Perez', '2001-01-01', 'M', '3112012253'),
('111', 'si', 'so', '2026-05-03', 'M', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tratamientos`
--

CREATE TABLE `tratamientos` (
  `TraNumero` int(10) UNSIGNED NOT NULL,
  `TraFechaAsignado` date NOT NULL,
  `TraDescripcion` text NOT NULL,
  `TraFechaInicio` date NOT NULL,
  `TraFechaFin` date NOT NULL,
  `TraObservaciones` text NOT NULL,
  `TraPaciente` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `tratamientos`
--

INSERT INTO `tratamientos` (`TraNumero`, `TraFechaAsignado`, `TraDescripcion`, `TraFechaInicio`, `TraFechaFin`, `TraObservaciones`, `TraPaciente`) VALUES
(1, '2015-10-29', 'Tratamiento para las muelas cordales', '2015-10-29', '2015-11-27', 'Finalizo muy bien', 'Manuel'),
(2, '2015-10-29', 'Tratamiento para las muelas cordales', '2015-10-29', '2015-11-27', 'Finalizo muy bien', 'Manuel');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `UsuId` int(11) NOT NULL,
  `UsuCorreo` varchar(100) NOT NULL,
  `UsuPassword` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`UsuId`, `UsuCorreo`, `UsuPassword`) VALUES
(1, 'sierramirquezsebastian@gmail.com', '$2y$10$STItLw9EQkzySBII4894wuk9XOuQPvlRixMSW3wf1cBT5XbVm/Shq');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`CitNumero`),
  ADD KEY `CitMedico` (`CitMedico`),
  ADD KEY `CitConsultorio` (`CitConsultorio`),
  ADD KEY `CitPaciente` (`CitPaciente`);

--
-- Indices de la tabla `consultorios`
--
ALTER TABLE `consultorios`
  ADD PRIMARY KEY (`ConNumero`);

--
-- Indices de la tabla `medicos`
--
ALTER TABLE `medicos`
  ADD PRIMARY KEY (`MedIdentificacion`),
  ADD UNIQUE KEY `MedUsuId` (`MedUsuId`);

--
-- Indices de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`PacIdentificacion`);

--
-- Indices de la tabla `tratamientos`
--
ALTER TABLE `tratamientos`
  ADD PRIMARY KEY (`TraNumero`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`UsuId`),
  ADD UNIQUE KEY `UsuCorreo` (`UsuCorreo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `CitNumero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tratamientos`
--
ALTER TABLE `tratamientos`
  MODIFY `TraNumero` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `UsuId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `citas`
--
ALTER TABLE `citas`
  ADD CONSTRAINT `citas_ibfk_1` FOREIGN KEY (`CitMedico`) REFERENCES `medicos` (`MedIdentificacion`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `citas_ibfk_2` FOREIGN KEY (`CitConsultorio`) REFERENCES `consultorios` (`ConNumero`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `citas_ibfk_3` FOREIGN KEY (`CitPaciente`) REFERENCES `pacientes` (`PacIdentificacion`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `medicos`
--
ALTER TABLE `medicos`
  ADD CONSTRAINT `medicos_ibfk_usuario` FOREIGN KEY (`MedUsuId`) REFERENCES `usuarios` (`UsuId`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
