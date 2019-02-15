-- Crear la base de datos --
CREATE DATABASE caja;

-- Usar la base de datos --
USE caja;

-- Crear la tabla de usuarios del sistema --
CREATE TABLE usuario(
  	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  	nombre VARCHAR(60) NOT NULL,
    password VARCHAR(250) NOT NULL,
    gerente INT NOT NULL,
    tipo INT NOT NULL
);

-- Crear la tabla de registros --
CREATE TABLE registro(
  	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
   	fecha VARCHAR(60) DEFAULT NULL,
  	nombre VARCHAR(60) DEFAULT NULL,
  	prospecto INT DEFAULT NULL,
  	llamada INT DEFAULT NULL,
  	cita INT DEFAULT NULL,
  	solicitud INT DEFAULT NULL,
  	solicitudp INT DEFAULT NULL
);