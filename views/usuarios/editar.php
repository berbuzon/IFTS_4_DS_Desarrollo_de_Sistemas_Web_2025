<?php 
include __DIR__ . '/../partials/header.php';
?>

<div class="content">
    <h2><i class="fas fa-user-edit"></i> Editar Usuario</h2>
    
    <form action="procesar.php?accion=guardar" method="POST">
        <input type="hidden" name="accion" value="editar">
        <input type="hidden" name="id" value="<?= $usuario['id'] ?>">
        
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" 
                   value="<?= htmlspecialchars($usuario['nombre']) ?>" required>
        </div>
        
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" 
                   value="<?= htmlspecialchars($usuario['email']) ?>" required>
        </div>
        
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="index.php" class="btn">Cancelar</a>
        </div>
    </form>
</div>

<?php 
include __DIR__ . '/../partials/footer.php';
?>