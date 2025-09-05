<?php
// C:\xampp\htdocs\proyecto_pruebalocalhost/IFTS_4_DS_Desarrollo_de_Sistemas_Web_2025\config.php

define('DB_HOST', 'localhost');
define('DB_PORT', 3307);
define('DB_USER', 'root');
define('DB_PASS', ''); // Usa tu contraseña real
define('DB_NAME', 'prueba');

function conectarDB() {
    $conexion = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
    
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }
    
    $conexion->set_charset("utf8");
    return $conexion;
}
?>