<?php
include_once __DIR__ . '/../../partials/header.php';
require_once __DIR__ . '/../../controllers/ProgramaController.php';

$controller = new ProgramaController(); //DEFINIR ESTO EN EL CONTROLLER
$programas = $controller->getAll(); 
?>
<div class="container mt-4">
<h2>Programas de Formación</h2>
<a href="create.php" class="btn btn-primary mb-3">+ Nuevo Programa</a>
    <?php if (empty($programas)): ?>
        <div class="alert alert-info">No hay programas registrados.</div>
    <?php else: ?>
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
        <th>Código</th>
        <th>Nombre</th>
        <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($programas as $programa): ?>
        <tr>
        <td><?= htmlspecialchars($programa['codigo']) ?></td>
        <td><?= htmlspecialchars($programa['nombre']) ?></td>
        <td>
            <a href="edit.php?codigo=<?= urlencode($programa['codigo']) ?>" class="btn btn-sm btn-warning">Editar</a>
            <a href="show.php?codigo=<?= urlencode($programa['codigo']) ?>" class="btn btn-sm btn-info">Ver</a>
            <a href="delete.php?codigo=<?= urlencode($programa['codigo']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar este programa? Esta acción no se puede deshacer.');">Eliminar</a>
        </td>
        </tr>
            <?php endforeach; ?>
        </tbody>
        </table>
    <?php endif; ?>
</div>

<?php include_once __DIR__ . '/../../partials/footer.php'; ?>