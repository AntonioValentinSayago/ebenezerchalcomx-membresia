-- database.sql
CREATE DATABASE IF NOT EXISTS church_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE church_db;

CREATE TABLE IF NOT EXISTS members (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombres VARCHAR(120) NOT NULL,
  apellido_paterno VARCHAR(120) NOT NULL,
  apellido_materno VARCHAR(120) NULL,
  edad INT NULL,
  bautizado TINYINT(1) NOT NULL DEFAULT 0,
  nivel_academico VARCHAR(80) NULL,
  fecha_conversion DATE NULL,
  ocupacion VARCHAR(120) NULL,
  cursos VARCHAR(255) NULL,
  iglesia_anterior VARCHAR(180) NULL,
  razon_salida VARCHAR(255) NULL,
  talentos_json JSON NULL,
  correo VARCHAR(160) NOT NULL,
  telefono VARCHAR(40) NULL,
  tipo_sangre VARCHAR(10) NULL,
  estado_civil VARCHAR(40) NULL,
  genero VARCHAR(40) NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY (correo)
) ENGINE=InnoDB;
