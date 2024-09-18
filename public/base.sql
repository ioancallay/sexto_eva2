-- Crear la base de datos
CREATE DATABASE IF NOT EXISTS ioasyste_eva2;

USE ioasyste_eva2;

-- Crear la tabla Niños
CREATE TABLE IF NOT EXISTS Ninios (
    idNinio INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    apellido VARCHAR(50) NOT NULL,
    fecha_nacimiento DATE NOT NULL,
    alergias TEXT
);

-- Crear la tabla Cuidadores
CREATE TABLE IF NOT EXISTS Cuidadores (
    idCuidador INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    especialidad VARCHAR(50) NOT NULL,
    telefono VARCHAR(20),
    email VARCHAR(100) UNIQUE
);

-- Crear la tabla Asignaciones
CREATE TABLE IF NOT EXISTS Asignaciones (
    asignacion_id INT AUTO_INCREMENT PRIMARY KEY,
    idNinio INT,
    idCuidador INT,
    fecha_asignacion DATE NOT NULL,
    FOREIGN KEY (idNinio) REFERENCES Niños(idNinio) ON DELETE CASCADE,
    FOREIGN KEY (idCuidador) REFERENCES Cuidadores(idCuidador) ON DELETE CASCADE
);

-- Opcional: Agregar índices para mejorar el rendimiento de las consultas
CREATE INDEX idx_idNinio ON Asignaciones(idNinio);

CREATE INDEX idx_idCuidador ON Asignaciones(idCuidador);