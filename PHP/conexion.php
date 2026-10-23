<?php
$servidor = 'localhost:3307';
$usuario = 'root';
$password = '';
//ya no pasamos $basedatos como parametro al constructor de mysqli

// 1.Conectamos al servidor sin especificar BD. Sin cuarto parametro, conecta al servidor MySQL sin seleccionar ninguna BD 
$conexion = new mysqli($servidor, $usuario, $password);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// 2.Crear la BD si no existe y seleccionarla
$conexion->query("CREATE DATABASE IF NOT EXISTS gamecrypt_db");
$conexion->select_db("gamecrypt_db");
//La primera vez que cualquier archivo hace include conexion.php, en ese momento PHP ejecuta create database if not exists,
//y la base de datos la crea automaticamente. Si la base de datos ya existe, no da error y no hace nada


// Crear tabla usuarios si no existe
$conexion->query("CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    telefono VARCHAR(20),
    fecha_nacimiento DATE,
    genero VARCHAR(30),
    nivel VARCHAR(50),
    mensaje TEXT,
    rol VARCHAR(10) DEFAULT 'usuario',
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");

// Resetear AUTO_INCREMENT a 1 para que los ids empiecen desde 1
// Solo afecta si la tabla se acaba de crear vacía
$conexion->query("ALTER TABLE usuarios AUTO_INCREMENT = 1");

// Crear usuario admin por defecto si no existe
$conexion->query("INSERT IGNORE INTO usuarios (nombre, email, password, rol) 
    VALUES ('Admin', 'admin@gamecrypt.com', 'admin123', 'admin')");
?>