

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


--
-- Base de datos: `EcoBuddy2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Amigos`
--

CREATE TABLE `Amigos` (
  `DNI_usuario` varchar(9) NOT NULL,
  `DNI_amigo` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `Amigos`
--

INSERT INTO `Amigos` (`DNI_usuario`, `DNI_amigo`) VALUES
('234567890', '345678901'),
('53876055J', '345678901'),
('234567890', '456789012'),
('345678901', '456789012'),
('53876056M', '53876060'),
('345678901', '567890123'),
('456789012', '567890123'),
('456789012', '678901234'),
('567890123', '678901234'),
('53876056M', '789012345'),
('53876056M', '890123456'),
('53876056M', '901234567');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Asiste`
--

CREATE TABLE `Asiste` (
  `DNI_usuario` varchar(9) NOT NULL,
  `nombre_evento` varchar(255) NOT NULL,
  `fecha_hora_evento` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `Asiste`
--

INSERT INTO `Asiste` (`DNI_usuario`, `nombre_evento`, `fecha_hora_evento`) VALUES
('123456789', 'Evento1', '2024-05-16 08:00:00'),
('53876056M', 'Evento1', '2024-05-16 08:00:00'),
('012345678', 'Evento10', '2024-05-25 17:00:00'),
('234567890', 'Evento2', '2024-05-17 09:00:00'),
('53876056M', 'Evento2', '2024-05-17 09:00:00'),
('345678901', 'Evento3', '2024-05-18 10:00:00'),
('567890123', 'Evento5', '2024-05-20 12:00:00'),
('53876056M', 'Evento6', '2024-05-21 13:00:00'),
('678901234', 'Evento6', '2024-05-21 13:00:00'),
('789012345', 'Evento7', '2024-05-22 14:00:00'),
('890123456', 'Evento8', '2024-05-23 15:00:00'),
('53876056M', 'Evento9', '2024-05-24 16:00:00'),
('901234567', 'Evento9', '2024-05-24 16:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Comentario`
--

CREATE TABLE `Comentario` (
  `fecha_hora_publicacion` datetime NOT NULL,
  `DNI_usuario_publicacion` varchar(9) NOT NULL,
  `DNI_usuario_comentario` varchar(9) NOT NULL,
  `fecha_hora` datetime NOT NULL,
  `contenido` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `Comentario`
--

INSERT INTO `Comentario` (`fecha_hora_publicacion`, `DNI_usuario_publicacion`, `DNI_usuario_comentario`, `fecha_hora`, `contenido`) VALUES
('2024-05-16 08:00:00', '123456789', '234567890', '2024-05-16 08:30:00', 'Comentario 1'),
('2024-05-17 09:00:00', '234567890', '345678901', '2024-05-17 09:30:00', 'Comentario 2'),
('2024-05-18 10:00:00', '345678901', '456789012', '2024-05-18 10:30:00', 'Comentario 3'),
('2024-05-19 11:00:00', '456789012', '567890123', '2024-05-19 11:30:00', 'Comentario 4'),
('2024-05-20 12:00:00', '567890123', '678901234', '2024-05-20 12:30:00', 'Comentario 5'),
('2024-05-21 13:00:00', '678901234', '789012345', '2024-05-21 13:30:00', 'Comentario 6'),
('2024-05-22 14:00:00', '789012345', '890123456', '2024-05-22 14:30:00', 'Comentario 7'),
('2024-05-23 15:00:00', '890123456', '901234567', '2024-05-23 15:30:00', 'Comentario 8'),
('2024-05-24 16:00:00', '901234567', '012345678', '2024-05-24 16:30:00', 'Comentario 9'),
('2024-05-25 17:00:00', '012345678', '123456789', '2024-05-25 17:30:00', 'Comentario 10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Desbloquea`
--

CREATE TABLE `Desbloquea` (
  `DNI_usuario` varchar(9) NOT NULL,
  `nombre_logro` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `Desbloquea`
--

INSERT INTO `Desbloquea` (`DNI_usuario`, `nombre_logro`) VALUES
('53876056M', 'Logro10'),
('53876056M', 'Logro2'),
('53876056M', 'Logro3'),
('53876056M', 'Logro4'),
('53876056M', 'Logro5'),
('53876056M', 'Logro6'),
('53876056M', 'Logro7'),
('53876056M', 'Logro8'),
('53876056M', 'Logro9');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Evento`
--

CREATE TABLE `Evento` (
  `nombre` varchar(255) NOT NULL,
  `fecha_hora` datetime NOT NULL,
  `ubi` varchar(255) DEFAULT NULL,
  `descripcion` text,
  `estado` tinyint(1) DEFAULT NULL,
  `DNI_usuario` varchar(9) DEFAULT NULL,
  `puntos_asociados` int DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `Evento`
--

INSERT INTO `Evento` (`nombre`, `fecha_hora`, `ubi`, `descripcion`, `estado`, `DNI_usuario`, `puntos_asociados`, `imagen`) VALUES
('Evento1', '2024-05-16 08:00:00', 'Ubicación 1', 'Descripción del evento 1', 1, '123456789', 50, 'Assets/img/albufera.jpg'),
('Evento10', '2024-05-25 17:00:00', 'Ubicación 10', 'Descripción del evento 10', 0, '012345678', 140, 'Assets/img/albufera.jpg'),
('Evento2', '2024-05-17 09:00:00', 'Ubicación 2', 'Descripción del evento 2', 1, '234567890', 60, 'Assets/img/albufera.jpg'),
('Evento3', '2024-05-18 10:00:00', 'Ubicación 3', 'Descripción del evento 3', 0, '345678901', 70, 'Assets/img/albufera.jpg'),
('Evento5', '2024-05-20 12:00:00', 'Ubicación 5', 'Descripción del evento 5', 0, '567890123', 90, 'Assets/img/albufera.jpg'),
('Evento6', '2024-05-21 13:00:00', 'Ubicación 6', 'Descripción del evento 6', 1, '678901234', 100, 'Assets/img/albufera.jpg'),
('Evento7', '2024-05-22 14:00:00', 'Ubicación 7', 'Descripción del evento 7', 0, '789012345', 110, 'Assets/img/albufera.jpg'),
('Evento8', '2024-05-23 15:00:00', 'Ubicación 8', 'Descripción del evento 8', 1, '890123456', 120, 'Assets/img/albufera.jpg'),
('Evento9', '2024-05-24 16:00:00', 'Ubicación 9', 'Descripción del evento 9', 1, '901234567', 130, 'Assets/img/albufera.jpg'),
('Limpiar mi coche', '2024-05-11 18:37:00', 'Casitabbbb', 'bbbbb', 0, '53876056M', 9, 'Assets/img/albufera.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Logros`
--

CREATE TABLE `Logros` (
  `nombre` varchar(255) NOT NULL,
  `puntos_necesarios` int DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `Logros`
--

INSERT INTO `Logros` (`nombre`, `puntos_necesarios`, `imagen`) VALUES
('Logro10', 1000, 'Assets/img/logros/GuardianDelPlaneta1.png'),
('Logro2', 200, 'Assets/img/logros/EmbajadorDelReciclaje9.png'),
('Logro3', 300, 'Assets/img/logros/DefensorDeLaBiodiversidad8.png'),
('Logro4', 400, 'Assets/img/logros/Eco-Activista7.png'),
('Logro5', 500, 'Assets/img/logros/GuardianDelAgua6.png'),
('Logro6', 600, 'Assets/img/logros/Eco-Innovador5.png'),
('Logro7', 700, 'Assets/img/logros/EmbajadorVerde4.png'),
('Logro8', 800, 'Assets/img/logros/Echo-Heroe3.png'),
('Logro9', 900, 'Assets/img/logros/SembradorDeEsperanza2.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Publicacion`
--

CREATE TABLE `Publicacion` (
  `fecha_hora` datetime NOT NULL,
  `DNI_usuario` varchar(9) NOT NULL,
  `contenido` text,
  `comentario_publicacion` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `Publicacion`
--

INSERT INTO `Publicacion` (`fecha_hora`, `DNI_usuario`, `contenido`, `comentario_publicacion`) VALUES
('2024-05-16 08:00:00', '123456789', 'Assets/imgPublicaciones/53876056M_fondo.jpg', NULL),
('2024-05-17 09:00:00', '234567890', 'Assets/imgPublicaciones/53876056M_fondo.jpg', NULL),
('2024-05-18 10:00:00', '345678901', 'Assets/imgPublicaciones/53876056M_fondo.jpg', NULL),
('2024-05-19 11:00:00', '456789012', 'Assets/imgPublicaciones/53876056M_fondo.jpg', NULL),
('2024-05-20 12:00:00', '567890123', 'Assets/imgPublicaciones/53876056M_fondo.jpg', NULL),
('2024-05-21 13:00:00', '678901234', 'Assets/imgPublicaciones/53876056M_fondo.jpg', NULL),
('2024-05-22 14:00:00', '789012345', 'Assets/imgPublicaciones/53876056M_fondo.jpg', NULL),
('2024-05-23 15:00:00', '890123456', 'Assets/imgPublicaciones/53876056M_fondo.jpg', NULL),
('2024-05-24 16:00:00', '901234567', 'Assets/imgPublicaciones/53876056M_fondo.jpg', NULL),
('2024-05-25 17:00:00', '012345678', 'Assets/imgPublicaciones/53876056M_fondo.jpg', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Usuario`
--

CREATE TABLE `Usuario` (
  `DNI` varchar(9) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `mail` varchar(255) DEFAULT NULL,
  `ubi` varchar(255) DEFAULT NULL,
  `puntos` int DEFAULT NULL,
  `contrasena` varchar(255) DEFAULT NULL,
  `img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `Usuario`
--

INSERT INTO `Usuario` (`DNI`, `username`, `mail`, `ubi`, `puntos`, `contrasena`, `img`) VALUES
('012345678', 'usuario10', 'usuario10@example.com', 'Ubicación 10', 550, 'contraseña10', NULL),
('123456789', 'usuario1', 'usuario1@example.com', 'Ubicación 1', 100, 'contraseña1', NULL),
('234567890', 'usuario2', 'usuario2@example.com', 'Ubicación 2', 150, 'contraseña2', NULL),
('345678901', 'usuario3', 'usuario3@example.com', 'Ubicación 3', 200, 'contraseña3', NULL),
('456789012', 'usuario4', 'usuario4@example.com', 'Ubicación 4', 250, 'contraseña4', NULL),
('53876055J', 'juanito', 'juan@pepero.com', 'Chile', 100, '123456', NULL),
('53876056M', 'Felipe', 'felipe@santamaria.com', 'Valencia', 2003, '$2y$10$iLpaNMNMp54z7KBayI7PFeB3JDOttIIqvqYYXSWX5OjU6n5nA89Wu', 'Assets/img/profile/reyna.png'),
('53876060', 'joselete', 'joselte@joselete.com', 'Chile', 100, '$2y$10$yV7da1.K.kBJLgCdh7D8.e6UFtw2QuNmLwuka10TV5jtLl13F0Gaa', NULL),
('567890123', 'usuario5', 'usuario5@example.com', 'Ubicación 5', 300, 'contraseña5', NULL),
('678901234', 'usuario6', 'usuario6@example.com', 'Ubicación 6', 350, 'contraseña6', NULL),
('789012345', 'usuario7', 'usuario7@example.com', 'Ubicación 7', 400, 'contraseña7', NULL),
('890123456', 'usuario8', 'usuario8@example.com', 'Ubicación 8', 450, 'contraseña8', NULL),
('901234567', 'usuario9', 'usuario9@example.com', 'Ubicación 9', 500, 'contraseña9', NULL);

--
-- Disparadores `Usuario`
--
DELIMITER $$

CREATE TRIGGER `after_points_update` AFTER UPDATE ON `Usuario` FOR EACH ROW 
BEGIN
    INSERT INTO Desbloquea (DNI_usuario, nombre_logro)
    SELECT NEW.DNI, l.nombre
    FROM Logros l
    WHERE l.puntos_necesarios <= NEW.puntos
    AND NOT EXISTS (
        SELECT 1 FROM Desbloquea d
        WHERE d.DNI_usuario = NEW.DNI AND d.nombre_logro = l.nombre
    );
END$$

DELIMITER ;


--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Amigos`
--
ALTER TABLE `Amigos`
  ADD PRIMARY KEY (`DNI_usuario`,`DNI_amigo`),
  ADD KEY `DNI_amigo` (`DNI_amigo`);

--
-- Indices de la tabla `Asiste`
--
ALTER TABLE `Asiste`
  ADD PRIMARY KEY (`DNI_usuario`,`nombre_evento`,`fecha_hora_evento`),
  ADD KEY `nombre_evento` (`nombre_evento`,`fecha_hora_evento`);

--
-- Indices de la tabla `Comentario`
--
ALTER TABLE `Comentario`
  ADD PRIMARY KEY (`fecha_hora_publicacion`,`DNI_usuario_publicacion`,`DNI_usuario_comentario`,`fecha_hora`),
  ADD KEY `DNI_usuario_publicacion` (`DNI_usuario_publicacion`),
  ADD KEY `DNI_usuario_comentario` (`DNI_usuario_comentario`);

--
-- Indices de la tabla `Desbloquea`
--
ALTER TABLE `Desbloquea`
  ADD PRIMARY KEY (`DNI_usuario`,`nombre_logro`),
  ADD KEY `nombre_logro` (`nombre_logro`);

--
-- Indices de la tabla `Evento`
--
ALTER TABLE `Evento`
  ADD PRIMARY KEY (`nombre`,`fecha_hora`),
  ADD KEY `DNI_usuario` (`DNI_usuario`);

--
-- Indices de la tabla `Logros`
--
ALTER TABLE `Logros`
  ADD PRIMARY KEY (`nombre`);

--
-- Indices de la tabla `Publicacion`
--
ALTER TABLE `Publicacion`
  ADD PRIMARY KEY (`fecha_hora`,`DNI_usuario`),
  ADD KEY `DNI_usuario` (`DNI_usuario`);

--
-- Indices de la tabla `Usuario`
--
ALTER TABLE `Usuario`
  ADD PRIMARY KEY (`DNI`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `Amigos`
--
ALTER TABLE `Amigos`
  ADD CONSTRAINT `Amigos_ibfk_1` FOREIGN KEY (`DNI_usuario`) REFERENCES `Usuario` (`DNI`),
  ADD CONSTRAINT `Amigos_ibfk_2` FOREIGN KEY (`DNI_amigo`) REFERENCES `Usuario` (`DNI`);

--
-- Filtros para la tabla `Asiste`
--
ALTER TABLE `Asiste`
  ADD CONSTRAINT `Asiste_ibfk_1` FOREIGN KEY (`DNI_usuario`) REFERENCES `Usuario` (`DNI`),
  ADD CONSTRAINT `Asiste_ibfk_2` FOREIGN KEY (`nombre_evento`,`fecha_hora_evento`) REFERENCES `Evento` (`nombre`, `fecha_hora`);

--
-- Filtros para la tabla `Comentario`
--
ALTER TABLE `Comentario`
  ADD CONSTRAINT `Comentario_ibfk_1` FOREIGN KEY (`DNI_usuario_publicacion`) REFERENCES `Usuario` (`DNI`),
  ADD CONSTRAINT `Comentario_ibfk_2` FOREIGN KEY (`DNI_usuario_comentario`) REFERENCES `Usuario` (`DNI`);

--
-- Filtros para la tabla `Desbloquea`
--
ALTER TABLE `Desbloquea`
  ADD CONSTRAINT `Desbloquea_ibfk_1` FOREIGN KEY (`DNI_usuario`) REFERENCES `Usuario` (`DNI`),
  ADD CONSTRAINT `Desbloquea_ibfk_2` FOREIGN KEY (`nombre_logro`) REFERENCES `Logros` (`nombre`);

--
-- Filtros para la tabla `Evento`
--
ALTER TABLE `Evento`
  ADD CONSTRAINT `Evento_ibfk_1` FOREIGN KEY (`DNI_usuario`) REFERENCES `Usuario` (`DNI`);

--
-- Filtros para la tabla `Publicacion`
--
ALTER TABLE `Publicacion`
  ADD CONSTRAINT `Publicacion_ibfk_1` FOREIGN KEY (`DNI_usuario`) REFERENCES `Usuario` (`DNI`);
COMMIT;

