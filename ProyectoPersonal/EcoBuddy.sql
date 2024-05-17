-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 18-04-2024 a las 02:14:25
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- Creación de la base de datos `EcoBuddy`
CREATE DATABASE IF NOT EXISTS EcoBuddy;

USE EcoBuddy;

CREATE TABLE IF NOT EXISTS Usuario (
    DNI VARCHAR(9) PRIMARY KEY,
    username VARCHAR(255),
    mail VARCHAR(255),
    ubi VARCHAR(255),
    puntos INT,
    contrasena VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS Amigos (
    DNI_usuario VARCHAR(9),
    DNI_amigo VARCHAR(9),
    PRIMARY KEY (DNI_usuario, DNI_amigo),
    FOREIGN KEY (DNI_usuario) REFERENCES Usuario(DNI),
    FOREIGN KEY (DNI_amigo) REFERENCES Usuario(DNI)
);

CREATE TABLE IF NOT EXISTS Evento (
    nombre VARCHAR(255),
    fecha_hora DATETIME,
    ubi VARCHAR(255),
    descripcion TEXT,
    estado VARCHAR(50),
    DNI_usuario VARCHAR(9),
    PRIMARY KEY (nombre, fecha_hora),
    FOREIGN KEY (DNI_usuario) REFERENCES Usuario(DNI)
);

CREATE TABLE IF NOT EXISTS Asiste (
    DNI_usuario VARCHAR(9),
    nombre_evento VARCHAR(255),
    fecha_hora_evento DATETIME,
    PRIMARY KEY (DNI_usuario, nombre_evento, fecha_hora_evento),
    FOREIGN KEY (DNI_usuario) REFERENCES Usuario(DNI),
    FOREIGN KEY (nombre_evento, fecha_hora_evento) REFERENCES Evento(nombre, fecha_hora)
);

CREATE TABLE IF NOT EXISTS Publicacion (
    fecha_hora DATETIME,
    DNI_usuario VARCHAR(9),
    contenido TEXT,
    PRIMARY KEY (fecha_hora, DNI_usuario),
    FOREIGN KEY (DNI_usuario) REFERENCES Usuario(DNI)
);

CREATE TABLE IF NOT EXISTS Comentario (
    fecha_hora_publicacion DATETIME,
    DNI_usuario_publicacion VARCHAR(9),
    DNI_usuario_comentario VARCHAR(9),
    fecha_hora DATETIME,
    contenido TEXT,
    PRIMARY KEY (fecha_hora_publicacion, DNI_usuario_publicacion, DNI_usuario_comentario, fecha_hora),
    FOREIGN KEY (DNI_usuario_publicacion) REFERENCES Usuario(DNI),
    FOREIGN KEY (DNI_usuario_comentario) REFERENCES Usuario(DNI)
);

CREATE TABLE IF NOT EXISTS Logros (
    nombre VARCHAR(255) PRIMARY KEY,
    puntos_necesarios INT
);

CREATE TABLE IF NOT EXISTS Desbloquea (
    DNI_usuario VARCHAR(9),
    nombre_logro VARCHAR(255),
    PRIMARY KEY (DNI_usuario, nombre_logro),
    FOREIGN KEY (DNI_usuario) REFERENCES Usuario(DNI),
    FOREIGN KEY (nombre_logro) REFERENCES Logros(nombre)
);

-- Insertar usuarios
INSERT INTO Usuario (DNI, username, mail, ubi, puntos, contrasena)
VALUES 
    ('123456789', 'usuario1', 'usuario1@example.com', 'Ubicacion1', 100, 'contrasena1'),
    ('987654321', 'usuario2', 'usuario2@example.com', 'Ubicacion2', 150, 'contrasena2'),
    ('456789123', 'usuario3', 'usuario3@example.com', 'Ubicacion3', 200, 'contrasena3'),
    ('789123456', 'usuario4', 'usuario4@example.com', 'Ubicacion4', 120, 'contrasena4');

-- Insertar amigos para usuario1
INSERT INTO Amigos (DNI_usuario, DNI_amigo)
VALUES 
    ('123456789', '987654321'),
    ('123456789', '456789123');

-- Insertar amigos para usuario2
INSERT INTO Amigos (DNI_usuario, DNI_amigo)
VALUES 
    ('987654321', '123456789'),
    ('987654321', '789123456');

-- Insertar eventos para usuario1
INSERT INTO Evento (nombre, fecha_hora, ubi, descripcion, estado, DNI_usuario)
VALUES 
    ('Evento1', '2024-05-15 10:00:00', 'Ubicacion2', 'Descripción del evento 1', 'Activo', '123456789');

-- Insertar asistencia a eventos para usuario1
INSERT INTO Asiste (DNI_usuario, nombre_evento, fecha_hora_evento)
VALUES 
    ('123456789', 'Evento1', '2024-05-15 10:00:00');

-- Insertar publicaciones para usuario2
INSERT INTO Publicacion (fecha_hora, DNI_usuario, contenido)
VALUES 
    ('2024-05-14 15:30:00', '987654321', 'Contenido de la publicación 1'),
    ('2024-05-14 16:00:00', '987654321', 'Contenido de la publicación 2');

-- Insertar comentarios para usuario3
INSERT INTO Comentario (fecha_hora_publicacion, DNI_usuario_publicacion, DNI_usuario_comentario, fecha_hora, contenido)
VALUES 
    ('2024-05-14 15:30:00', '987654321', '456789123', '2024-05-14 16:00:00', 'Contenido del comentario 1'),
    ('2024-05-14 16:00:00', '987654321', '456789123', '2024-05-14 17:00:00', 'Contenido del comentario 2');

-- Insertar logros
INSERT INTO Logros (nombre, puntos_necesarios)
VALUES 
    ('Logro1', 50),
    ('Logro2', 100);

-- Insertar desbloqueo de logros para usuario4
INSERT INTO Desbloquea (DNI_usuario, nombre_logro)
VALUES 
    ('789123456', 'Logro1'),
    ('789123456', 'Logro2');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
