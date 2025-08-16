<?php
session_start();
require_once 'config/config.php';
require_once 'controllers/UsuarioController.php';

$accion = isset($_GET['accion']) ? $_GET['accion'] : 'index';

$controller = new UsuarioController();

// Acciones que requieren procesamiento
$accionesProcesamiento = ['guardar', 'eliminar'];

if (in_array($accion, $accionesProcesamiento) && method_exists($controller, $accion)) {
    $controller->$accion();
} else {
    header('Location: index.php');
    exit;
}
?>