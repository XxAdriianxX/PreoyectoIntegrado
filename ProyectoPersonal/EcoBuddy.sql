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
CREATE DATABASE IF NOT EXISTS `EcoBuddy` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish2_ci;
USE `EcoBuddy`;

-- Creación de la tabla de usuarios
CREATE TABLE IF NOT EXISTS `Usuario` (
  `Id` INT AUTO_INCREMENT PRIMARY KEY,
  `Username` VARCHAR(255) NOT NULL,
  `Mail` VARCHAR(255) NOT NULL,
  `Ubicacion` VARCHAR(255),
  `Puntos` INT
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- Creación de la tabla de eventos
CREATE TABLE IF NOT EXISTS `Eventos` (
  `Id` INT AUTO_INCREMENT PRIMARY KEY,
  `Descripcion` VARCHAR(255) NOT NULL,
  `Ubicacion` VARCHAR(255),
  `Fecha` DATE,
  `Hora` TIME,
  `IdUsuarioCreador` INT,
  `Estado` ENUM('finalizado', 'en progreso'),
  `Nombre` VARCHAR(255),
  FOREIGN KEY (`IdUsuarioCreador`) REFERENCES `Usuario`(`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- Creación de la tabla de comentarios
CREATE TABLE IF NOT EXISTS `Comentarios` (
  `Id` INT AUTO_INCREMENT PRIMARY KEY,
  `IdUsuario` INT,
  `IdPublicacion` INT,
  `FechaHora` DATETIME,
  `Contenido` TEXT,
  FOREIGN KEY (`IdUsuario`) REFERENCES `Usuario`(`Id`),
  FOREIGN KEY (`IdPublicacion`) REFERENCES `Publicaciones`(`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- Creación de la tabla de publicaciones
CREATE TABLE IF NOT EXISTS `Publicaciones` (
  `Id` INT AUTO_INCREMENT PRIMARY KEY,
  `IdUsuario` INT,
  `Contenido` TEXT,
  `FechaHora` DATETIME,
  FOREIGN KEY (`IdUsuario`) REFERENCES `Usuario`(`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- Creación de la tabla de recompensas
CREATE TABLE IF NOT EXISTS `Recompensas` (
  `Id` INT AUTO_INCREMENT PRIMARY KEY,
  `Nombre` VARCHAR(255) NOT NULL,
  `PuntosNecesarios` INT
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- Fin de la transacción
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
