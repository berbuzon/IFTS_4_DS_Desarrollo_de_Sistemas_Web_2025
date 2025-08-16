<?php 
include __DIR__ . '/../partials/header.php';
?>

<div class="content">
    <div class="search-bar">
        <form action="index.php" method="GET">
            <input type="hidden" name="accion" value="index">
            <input type="text" name="busqueda" placeholder="Buscar usuarios..." 
                   value="<?= isset($_GET['busqueda']) ? htmlspecialchars($_GET['busqueda']) : '' ?>">
            <button type="submit"><i class="fas fa-search"></i></button>
        </form>
    </div>
    
    <?php if (!empty($usuarios)): ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Fecha Registro</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $usuario): ?>
                    <tr>
                        <td><?= $usuario['id'] ?></td>
                        <td><?= htmlspecialchars($usuario['nombre']) ?></td>
                        <td><?= htmlspecialchars($usuario['email']) ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($usuario['fecha_registro'])) ?></td>
                        <td class="actions">
                            <a href="index.php?accion=editar&id=<?= $usuario['id'] ?>" class="btn btn-edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="procesar.php?accion=eliminar" method="POST" class="inline-form">
                                <input type="hidden" name="id" value="<?= $usuario['id'] ?>">
                                <button type="submit" class="btn btn-delete" onclick="return confirm('¿Estás seguro?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
        <!-- Paginación -->
        <?php if ($totalPaginas > 1): ?>
            <div class="pagination">
                <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
                    <a href="index.php?accion=index&pagina=<?= $i ?><?= !empty($busqueda) ? '&busqueda=' . urlencode($busqueda) : '' ?>" 
                       class="<?= $pagina === $i ? 'active' : '' ?>">
                        <?= $i ?>
                    </a>
                <?php endfor; ?>
            </div>
        <?php endif; ?>
    <?php else: ?>
        <div class="no-results">
            <p>No se encontraron usuarios</p>
        </div>
    <?php endif; ?>
</div>

<?php 
include __DIR__ . '/../partials/footer.php';
?>