CREATE DATABASE IF NOT EXISTS EcoBuddy2;

USE EcoBuddy2;

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
    estado TINYINT(1),
    DNI_usuario VARCHAR(9),
    puntos_asociados INT, 
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

DELIMITER //

CREATE TRIGGER after_points_update
AFTER UPDATE ON Usuario
FOR EACH ROW
BEGIN
    DECLARE done INT DEFAULT 0;
    DECLARE logro_nombre VARCHAR(255);
    DECLARE cur CURSOR FOR
        SELECT nombre
        FROM Logros
        WHERE puntos_necesarios <= NEW.puntos;

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;

    OPEN cur;

    read_loop: LOOP
        FETCH cur INTO logro_nombre;
        IF done THEN
            LEAVE read_loop;
        END IF;

    
        IF NOT EXISTS (SELECT 1 FROM Desbloquea WHERE DNI_usuario = NEW.DNI AND nombre_logro = logro_nombre) THEN
            INSERT INTO Desbloquea (DNI_usuario, nombre_logro) VALUES (NEW.DNI, logro_nombre);
        END IF;
    END LOOP;

    CLOSE cur;
END;
//

DELIMITER ;
