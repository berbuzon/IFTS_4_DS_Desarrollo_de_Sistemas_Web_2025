<?php
require_once __DIR__ . '/../models/UsuarioModel.php';

class UsuarioController {
    private $model;
    
    public function __construct() {
        $this->model = new UsuarioModel();
    }
    
    public function index() {
        // Parámetros de paginación y búsqueda
        $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
        $porPagina = 5;
        $busqueda = isset($_GET['busqueda']) ? trim($_GET['busqueda']) : '';
        
        // Obtener usuarios
        $usuarios = $this->model->obtenerUsuarios($pagina, $porPagina, $busqueda);
        
        // Calcular total de páginas
        $totalUsuarios = $this->model->contarUsuarios($busqueda);
        $totalPaginas = ceil($totalUsuarios / $porPagina);
        
        // Incluir vista
        require_once __DIR__ . '/../views/usuarios/index.php';
    }
    
    public function crear() {
        // Incluir vista de creación
        require_once __DIR__ . '/../views/usuarios/crear.php';
    }
    
    public function editar() {
        if (!isset($_GET['id'])) {
            header('Location: index.php');
            exit;
        }
        
        $id = (int)$_GET['id'];
        $usuario = $this->model->obtenerUsuarioPorId($id);
        
        if (!$usuario) {
            header('Location: index.php');
            exit;
        }
        
        // Incluir vista de edición
        require_once __DIR__ . '/../views/usuarios/editar.php';
    }
    
    public function guardar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = trim($_POST['nombre']);
            $email = trim($_POST['email']);
            $accion = $_POST['accion'];
            
            if (empty($nombre) || empty($email)) {
                $_SESSION['error'] = 'Nombre y email son obligatorios';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['error'] = 'El email no es válido';
            } else {
                if ($accion === 'crear') {
                    $exito = $this->model->crearUsuario($nombre, $email);
                    $mensaje = $exito ? 'Usuario creado con éxito' : 'Error al crear usuario';
                } elseif ($accion === 'editar') {
                    $id = (int)$_POST['id'];
                    $exito = $this->model->actualizarUsuario($id, $nombre, $email);
                    $mensaje = $exito ? 'Usuario actualizado con éxito' : 'Error al actualizar usuario';
                }
                
                if (isset($exito) && $exito) {
                    $_SESSION['exito'] = $mensaje;
                    header('Location: index.php');
                    exit;
                } else {
                    $_SESSION['error'] = $mensaje;
                }
            }
            
            // Redirigir según la acción
            if ($accion === 'crear') {
                header('Location: crear.php');
            } else {
                header('Location: editar.php?id=' . $_POST['id']);
            }
            exit;
        }
        
        header('Location: index.php');
        exit;
    }
    
    public function eliminar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
            $id = (int)$_POST['id'];
            $exito = $this->model->eliminarUsuario($id);
            
            if ($exito) {
                $_SESSION['exito'] = 'Usuario eliminado con éxito';
            } else {
                $_SESSION['error'] = 'Error al eliminar usuario';
            }
        }
        
        header('Location: index.php');
        exit;
    }
}
?>