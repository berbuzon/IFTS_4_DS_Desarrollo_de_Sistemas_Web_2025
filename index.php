<?php
session_start();
require_once 'config/config.php';
require_once 'controllers/UsuarioController.php';

// Manejar acciones
$accion = isset($_GET['accion']) ? $_GET['accion'] : 'index';

$controller = new UsuarioController();

// Ejecutar acción correspondiente
if (method_exists($controller, $accion)) {
    $controller->$accion();
} else {
    $controller->index();
}
?>