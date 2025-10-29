<?php
include_once __DIR__ . '/../../partials/header.php';
require_once __DIR__ . '/../../controllers/MateriaController.php';

$controller = new MateriaController();
$materias = $controller->getAll(); // Obtenemos todas las materias
?>

<div class="container mt-4">
    <h2>Materias Registradas</h2>
    <a href="create.php" class="btn btn-primary mb-3">+ Nueva Materia</a>

    <?php if (empty($materias)): ?>
        <div class="alert alert-info">No hay materias registradas.</div>
    <?php else: ?>
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>Código</th>
            <th>Nombre</th>
            <th>Programa</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($materias as $materia): ?>
            <tr>
            <td><?= htmlspecialchars($materia['codigo']) ?></td>
            <td><?= htmlspecialchars($materia['nombre']) ?></td>
            <td><?= htmlspecialchars($materia['programa']) ?></td>
            <td>
        <a href="edit.php?codigo=<?= urlencode($materia['codigo']) ?>" class="btn btn-sm btn-warning">Editar</a>
        <a href="show.php?codigo=<?= urlencode($materia['codigo']) ?>" class="btn btn-sm btn-info">Ver</a>
        <a href="delete.php?codigo=<?= urlencode($materia['codigo']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar esta materia? Esta acción no se puede deshacer.');">Eliminar</a>
    </td>
    </tr>
    <?php endforeach; ?>
    </tbody>
    </table>
    <?php endif; ?>
</div>

<?php include_once __DIR__ . '/../../partials/footer.php'; ?>