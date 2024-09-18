-- Crear la base de datos
CREATE DATABASE IF NOT EXISTS ioasyste_eva2;

USE ioasyste_eva2;

-- Crear la tabla Cuidadores
CREATE TABLE IF NOT EXISTS Cuidadores (
    idCuidador INT AUTO_INCREMENT PRIMARY KEY,
    Nombre VARCHAR(50) NOT NULL,
    Especialidad VARCHAR(50) NOT NULL,
    Telefono VARCHAR(20),
    Email VARCHAR(100) UNIQUE
);

-- Crear la tabla Niños
CREATE TABLE IF NOT EXISTS Ninios (
    idNinio INT AUTO_INCREMENT PRIMARY KEY,
    Nombre VARCHAR(50) NOT NULL,
    Apellido VARCHAR(50) NOT NULL,
    Fecha_nacimiento DATE NOT NULL,
    Alergias TEXT,
    idCuidador INT,
    FOREIGN KEY (idCuidador) REFERENCES Cuidadores(idCuidador) ON DELETE
    SET
        NULL
);

-- Crear la tabla Asignaciones
CREATE TABLE IF NOT EXISTS Asignaciones (
    asignacion_id INT AUTO_INCREMENT PRIMARY KEY,
    idNinio INT,
    idCuidador INT,
    Motivo VARCHAR(200) NOT NULL,
    Fecha_asignacion DATE NOT NULL,
    FOREIGN KEY (idNinio) REFERENCES Ninios(idNinio) ON DELETE CASCADE,
    FOREIGN KEY (idCuidador) REFERENCES Cuidadores(idCuidador) ON DELETE CASCADE
);

-- Opcional: Agregar índices para mejorar el rendimiento de las consultas
CREATE INDEX idx_idNinio ON Asignaciones(idNinio);

CREATE INDEX idx_idCuidador ON Asignaciones(idCuidador);