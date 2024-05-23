-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: db
-- Tiempo de generación: 23-05-2024 a las 06:37:44
-- Versión del servidor: 8.3.0
-- Versión de PHP: 8.2.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `EcoBuddy`
--

-- --------------------------------------------------------

CREATE DATABASE IF NOT EXISTS EcoBuddy;

USE EcoBuddy;

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
('53876055k', '789123456'),
('53876055k', '987654321');

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
('53876055k', 'Campaña de Concientización', '2024-11-15 09:00:00'),
('24506634P', 'Charla sobre Reciclaje', '2024-06-15 14:30:00'),
('53876055k', 'Competencia de Jardinería', '2025-02-20 17:30:00'),
('123456789', 'Evento1', '2024-05-15 10:00:00'),
('53876055k', 'Plantación de Árboles', '2024-07-05 18:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Comentario`
--

CREATE TABLE `Comentario` (
  `id` int NOT NULL,
  `fecha_hora_publicacion` datetime NOT NULL,
  `DNI_usuario_publicacion` varchar(9) NOT NULL,
  `DNI_usuario_comentario` varchar(9) NOT NULL,
  `fecha_hora` datetime NOT NULL,
  `contenido` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `Comentario`
--

INSERT INTO `Comentario` (`id`, `fecha_hora_publicacion`, `DNI_usuario_publicacion`, `DNI_usuario_comentario`, `fecha_hora`, `contenido`) VALUES
(36, '2024-05-22 17:51:09', '24506634P', '24506634P', '2024-05-22 17:52:10', 'danii: publicac9ion'),
(37, '2024-05-22 17:51:09', '24506634P', '24506633L', '2024-05-22 17:52:57', 'algo: esto es un comentario con otro usuario ');

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
('53876055k', 'Logro1'),
('24506634P', 'Logro2'),
('53876055k', 'Logro2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Evento`
--

CREATE TABLE `Evento` (
  `nombre` varchar(255) NOT NULL,
  `fecha_hora` datetime NOT NULL,
  `ubi` varchar(255) DEFAULT NULL,
  `descripcion` text,
  `estado` varchar(50) DEFAULT NULL,
  `DNI_usuario` varchar(9) DEFAULT NULL,
  `puntos_asociados` int DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `Evento`
--

INSERT INTO `Evento` (`nombre`, `fecha_hora`, `ubi`, `descripcion`, `estado`, `DNI_usuario`, `puntos_asociados`, `imagen`) VALUES
('Campaña de Concientización', '2024-11-15 09:00:00', 'Plaza Principal', 'Campaña de concientización sobre el cuidado del medio ambiente y la importancia de la sostenibilidad.', '1', '123456789', 4, NULL),
('Charla sobre Reciclaje', '2024-06-15 14:30:00', 'Centro Cultural', 'Charla educativa sobre el reciclaje y su impacto ambiental.', '1', '123456789', 8, NULL),
('cochecitoo', '2024-05-31 08:22:00', '333', '3333', '1', '53876055k', 3333, 'Assets/event_picture/prueba.jpg'),
('Competencia de Jardinería', '2025-02-20 17:30:00', 'Plaza de la Ciudad', 'Competencia entre vecinos para ver quién tiene el jardín más sostenible.', '1', '123456789', 8, NULL),
('dffcc', '2024-05-09 08:18:00', 'ddddd3ed', 'dddd', '0', '53876055k', 23, 'Assets/event_picture/ciclo.jpg'),
('Evento1', '2024-05-15 10:00:00', 'Ubicacion2', 'Descripción del evento 1', '1', '123456789', 1, NULL),
('Excursión Naturalista', '2024-10-05 18:00:00', 'Reserva Natural', 'Excursión guiada para observar la flora y fauna de la reserva natural.', '1', '123456789', 6, NULL),
('Jornada de Reciclaje', '2025-01-10 14:00:00', 'Centro de Reciclaje', 'Jornada para fomentar el reciclaje y la separación de residuos.', '1', '123456789', 6, NULL),
('Limpieza de playa', '2024-05-01 09:05:00', 'Playa de Pinedo', '', '1', '123456789', 50, NULL),
('Limpieza de rio', '2024-05-11 09:05:00', 'Playa de Cullera', 'Hay que recoger todo para que se quede limpio', '1', '123456789', 50, NULL),
('Limpieza Parque Central', '2024-05-20 10:00:00', 'Parque Central', 'Evento de limpieza comunitaria en el Parque Central.', '0', '123456789', 5, NULL),
('Plantación de Árboles', '2024-07-05 18:00:00', 'Zona Verde', 'Actividad de reforestación en la Zona Verde de la ciudad.', '1', '123456789', 7, NULL),
('Prueba nombre', '2024-05-02 12:36:00', 'Chile', 'Prueba nombre', '0', '53876055k', 45, 'Assets/event_picture/prueba.jpg'),
('Prueba regogida basura ', '2024-05-19 14:46:00', 'Catarroja', 'afjlkdfjldfkljflkasjflkjdfkljdaklfjadsklfjalksflkasjflkdsjflkdj', '0', '24506634P', 200, 'Assets/event_picture/prueba.jpg'),
('qwesdgbngf', '2024-05-31 13:26:00', 'chile', 'SADFGBDSA', '0', '53876055k', 666, NULL),
('qwesdgbngfWEFGHGFDS', '2024-05-10 13:26:00', 'chile', 'SADFGBDSA', '1', '53876055k', 666, NULL),
('recoger coches', '2024-05-16 08:51:00', 'España', NULL, '1', '123456789', 43, NULL),
('Recogida de basura ', '2024-05-30 15:39:00', 'Playa el saler', 'Recogida de basuta en playa el saler ', '1', '24506634P', 200, 'Assets/event_picture/prueba.jpg'),
('Recogida de Basura Playa', '2024-08-10 12:00:00', 'Playa Principal', 'Recogida de basura en la playa para mantener el ecosistema marino limpio.', '0', '123456789', 6, NULL),
('rfsfcbbdfs', '2024-06-09 09:16:00', 'sfcsc', 'aedfvsfadfcx', '1', '53876055k', 788, NULL),
('Taller de Compostaje', '2024-09-20 15:30:00', 'Granja Educativa', 'Taller práctico sobre cómo hacer compostaje en casa.', '1', '123456789', 5, NULL),
('Taller de Energías Renovables', '2024-12-01 11:30:00', 'Centro Comunitario', 'Taller informativo sobre el uso de energías renovables en el hogar.', '1', '123456789', 7, NULL);

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
('Logro1', 300, 'Assets/logros/DefensorDeLaBiodiversidad8.png'),
('Logro2', 200, 'Assets/logros/Echo-Heroe3.png'),
('Logro3', 400, 'Assets/logros/DefensorDeLaBiodiversidad8.png'),
('Logro4', 500, 'Assets/logros/DefensorDeLaBiodiversidad8.png'),
('Logro5', 600, 'Assets/logros/DefensorDeLaBiodiversidad8.png'),
('Logro6', 700, 'Assets/logros/DefensorDeLaBiodiversidad8.png'),
('Logro7', 800, 'Assets/logros/DefensorDeLaBiodiversidad8.png'),
('Logro8', 900, 'Assets/logros/DefensorDeLaBiodiversidad8.png'),
('Logro9', 1000, 'Assets/logros/DefensorDeLaBiodiversidad8.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Publicacion`
--

CREATE TABLE `Publicacion` (
  `fecha_hora` datetime NOT NULL,
  `DNI_usuario` varchar(9) NOT NULL,
  `contenido` text,
  `comentario_publicacion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `Publicacion`
--

INSERT INTO `Publicacion` (`fecha_hora`, `DNI_usuario`, `contenido`, `comentario_publicacion`) VALUES
('2024-05-22 17:51:09', '24506634P', 'Assets/imgPublicaciones/24506634P_DefensorDeLaBiodiversidad8.png', 'Esto es el comentario de una publicacion'),
('2024-05-22 17:51:16', '24506634P', 'Assets/imgPublicaciones/24506634P_Echo-Heroe3.png', 'afafadfaf'),
('2024-05-22 17:51:27', '24506634P', 'Assets/imgPublicaciones/24506634P_Eco-Activista7.png', 'comentario '),
('2024-05-22 17:51:35', '24506634P', 'Assets/imgPublicaciones/24506634P_Eco-Innovador5.png', 'aaaa'),
('2024-05-22 17:51:44', '24506634P', 'Assets/imgPublicaciones/24506634P_EmbajadorDelReciclaje9.png', 'aaa'),
('2024-05-22 17:51:57', '24506634P', 'Assets/imgPublicaciones/24506634P_GuardianDelAgua6.png', 'esto es otro comentario de una publicaicon\r\n'),
('2024-05-22 17:53:55', '24506633L', 'Assets/imgPublicaciones/24506633L_SembradorDeEsperanza2.png', 'publicacion subida con otro usuario '),
('2024-05-22 18:06:19', '24506633L', 'Assets/imgPublicaciones/24506633L_GuardianDelAgua6.png', 'a');

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
  `contrasena` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `Usuario`
--

INSERT INTO `Usuario` (`DNI`, `username`, `mail`, `ubi`, `puntos`, `contrasena`) VALUES
('123456789', 'usuario1', 'usuario1@example.com', 'Ubicacion1', 100, 'contrasena1'),
('24506633L', 'algo', 'algo@gmail.com', 'catarroja', 100, '$2y$10$4GIHW.HH34G7Nijq.zbeIeObqXjX3Sb54tvtCoCVXPtSPBaT6xXY6'),
('24506634P', 'danii', 'danii@gmail.com', 'catarroja', 608, '$2y$10$sZQFp12xphHS2JmT0KiHc..mXWIhJhpZslGYZZd97Rp9guaZeS62y'),
('456789123', 'usuario3', 'usuario3@example.com', 'Ubicacion3', 200, 'contrasena3'),
('53876055k', 'Felipe', 'fesalo@floridauni.es', 'valencia', 507, '$2y$10$2FD8Wz81kD7xen4ci6ukleMJuuiMxjXGSvZdMUQOUJcWwDl1JI8BS'),
('789123456', 'usuario4', 'usuario4@example.com', 'Ubicacion4', 120, 'contrasena4'),
('987654321', 'usuario2', 'usuario2@example.com', 'Ubicacion2', 150, 'contrasena2'),
('99999999P', 'prueba', 'd@gmail.com', 'catarroja', 100, '$2y$10$OKwAgxhpr3L77GipnntTEOaAZPlj.FKOz2AAD/bZvY6Qp7Tp9DRJG');

--
-- Disparadores `Usuario`
--
DELIMITER $$
CREATE TRIGGER `actualizar_puntos_trigger` AFTER UPDATE ON `Usuario` FOR EACH ROW BEGIN
    DECLARE nombre_logro VARCHAR(255);
    DECLARE puntos_umbral INT;
    DECLARE logro_existente INT;

    SET puntos_umbral = 100;

    WHILE puntos_umbral <= 1000 DO
        IF NEW.puntos >= puntos_umbral AND OLD.puntos < puntos_umbral THEN
            -- Obtén el nombre del logro correspondiente
            SELECT nombre INTO nombre_logro
            FROM Logros
            WHERE puntos_necesarios = puntos_umbral
            LIMIT 1;

            -- Verifica si el logro ya ha sido desbloqueado
            IF nombre_logro IS NOT NULL THEN
                SELECT COUNT(*) INTO logro_existente
                FROM Desbloquea
                WHERE DNI_usuario = NEW.DNI AND nombre_logro = nombre_logro;

                IF logro_existente = 0 THEN
                    -- Inserta el logro en la tabla Desbloquea
                    INSERT INTO Desbloquea (DNI_usuario, nombre_logro)
                    VALUES (NEW.DNI, nombre_logro);
                END IF;
            END IF;
        END IF;

        SET puntos_umbral = puntos_umbral + 100;
    END WHILE;
END
$$
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
  ADD PRIMARY KEY (`id`),
  ADD KEY `DNI_usuario_publicacion` (`DNI_usuario_publicacion`),
  ADD KEY `DNI_usuario_comentario` (`DNI_usuario_comentario`),
  ADD KEY `fecha_hora_publicacion` (`fecha_hora_publicacion`,`DNI_usuario_publicacion`);

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
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `Comentario`
--
ALTER TABLE `Comentario`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

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
  ADD CONSTRAINT `Comentario_ibfk_2` FOREIGN KEY (`DNI_usuario_comentario`) REFERENCES `Usuario` (`DNI`),
  ADD CONSTRAINT `Comentario_ibfk_3` FOREIGN KEY (`fecha_hora_publicacion`,`DNI_usuario_publicacion`) REFERENCES `Publicacion` (`fecha_hora`, `DNI_usuario`);

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
