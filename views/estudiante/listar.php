<?php
use App\Controllers\EstudianteController;
require_once __DIR__ . '/../../controllers/EstudianteController.php';
$controller = new EstudianteController();
$estudiantes = $controller->getAll(); 
?>
<link rel="stylesheet" href="../../public/index.css">
<div class="container mt-4">
    <h2>Gestión de Estudiantes</h2>

    <div class="d-flex justify-content-between mb-3">
        <form method="POST" action="" class="d-flex" role="search">
            <input type="text" name="buscar" class="form-control me-2" placeholder="Buscar estudiante...">
            <button type="submit" class="btn btn-outline-primary">Buscar</button>
        </form>
        <a href="create.php" class="btn btn-primary">+ Nuevo Estudiante</a>
    </div>

    <?php if (empty($estudiantes)): ?>
        <div class="alert alert-info">No hay estudiantes registrados.</div>
    <?php else: ?>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Programa</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($estudiantes as $est): ?>
                    <tr>
                        <td><?= htmlspecialchars($est['codigo']) ?></td>
                        <td><?= htmlspecialchars($est['nombre']) ?></td>
                        <td><?= htmlspecialchars($est['correo']) ?></td>
                        <td><?= htmlspecialchars($est['programa']) ?></td>
                        <td>
                            <a href="show.php?codigo=<?= urlencode($est['codigo']) ?>" class="btn btn-sm btn-info">Ver</a>
                            <a href="edit.php?codigo=<?= urlencode($est['codigo']) ?>" class="btn btn-sm btn-warning">Editar</a>
                            <a href="delete.php?codigo=<?= urlencode($est['codigo']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Seguro que deseas eliminar este estudiante?');">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?php include_once __DIR__ . '/../../partials/footer.php'; ?>