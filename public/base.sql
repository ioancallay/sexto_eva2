-- Crear la base de datos
CREATE DATABASE IF NOT EXISTS ioasyste_eva2;

USE ioasyste_eva2;

-- Crear la tabla Niños
CREATE TABLE IF NOT EXISTS Ninios (
    ninio_id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    apellido VARCHAR(50) NOT NULL,
    fecha_nacimiento DATE NOT NULL,
    alergias TEXT
);

-- Crear la tabla Cuidadores
CREATE TABLE IF NOT EXISTS Cuidadores (
    cuidador_id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    especialidad VARCHAR(50) NOT NULL,
    telefono VARCHAR(20),
    email VARCHAR(100) UNIQUE
);

-- Crear la tabla Asignaciones
CREATE TABLE IF NOT EXISTS Asignaciones (
    asignacion_id INT AUTO_INCREMENT PRIMARY KEY,
    ninio_id INT,
    cuidador_id INT,
    fecha_asignacion DATE NOT NULL,
    FOREIGN KEY (ninio_id) REFERENCES Niños(ninio_id) ON DELETE CASCADE,
    FOREIGN KEY (cuidador_id) REFERENCES Cuidadores(cuidador_id) ON DELETE CASCADE
);

-- Opcional: Agregar índices para mejorar el rendimiento de las consultas
CREATE INDEX idx_ninio_id ON Asignaciones(ninio_id);

CREATE INDEX idx_cuidador_id ON Asignaciones(cuidador_id);