<?php
require_once __DIR__ . '/../config/config.php';

class UsuarioModel {
    private $conexion;

    public function __construct() {
        $this->conexion = conectarDB();
    }

    // Obtener todos los usuarios con paginación
    public function obtenerUsuarios($pagina = 1, $porPagina = 5, $busqueda = '') {
        $inicio = ($pagina - 1) * $porPagina;
        
        if (!empty($busqueda)) {
            $sql = "SELECT * FROM usuarios 
                    WHERE nombre LIKE ? OR email LIKE ? 
                    ORDER BY fecha_registro DESC 
                    LIMIT ?, ?";
            $busquedaParam = "%$busqueda%";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bind_param("ssii", $busquedaParam, $busquedaParam, $inicio, $porPagina);
        } else {
            $sql = "SELECT * FROM usuarios 
                    ORDER BY fecha_registro DESC 
                    LIMIT ?, ?";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bind_param("ii", $inicio, $porPagina);
        }
        
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }

    // Contar total de usuarios para paginación
    public function contarUsuarios($busqueda = '') {
        if (!empty($busqueda)) {
            $sql = "SELECT COUNT(*) as total FROM usuarios 
                    WHERE nombre LIKE ? OR email LIKE ?";
            $busquedaParam = "%$busqueda%";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bind_param("ss", $busquedaParam, $busquedaParam);
        } else {
            $sql = "SELECT COUNT(*) as total FROM usuarios";
            $stmt = $this->conexion->prepare($sql);
        }
        
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado->fetch_assoc()['total'];
    }

    // Obtener un usuario por ID
    public function obtenerUsuarioPorId($id) {
        $sql = "SELECT * FROM usuarios WHERE id = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado->fetch_assoc();
    }

    // Crear un nuevo usuario
    public function crearUsuario($nombre, $email) {
        $sql = "INSERT INTO usuarios (nombre, email) VALUES (?, ?)";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("ss", $nombre, $email);
        return $stmt->execute();
    }

    // Actualizar un usuario
    public function actualizarUsuario($id, $nombre, $email) {
        $sql = "UPDATE usuarios SET nombre = ?, email = ? WHERE id = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("ssi", $nombre, $email, $id);
        return $stmt->execute();
    }

    // Eliminar un usuario
    public function eliminarUsuario($id) {
        $sql = "DELETE FROM usuarios WHERE id = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>