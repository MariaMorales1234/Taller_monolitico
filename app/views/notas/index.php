<?php
use App\Controllers\NotaController;
require_once __DIR__ . '/../../controllers/NotaController.php';

$controller = new NotaController();
$notas = $controller->getAll(); // Método que retorna todas las notas
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Notas Registradas</title>
    <link rel="stylesheet" href="../../public/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    <h2>Notas Registradas</h2>
    <a href="create.php" class="btn btn-primary mb-3">+ Nueva Nota</a>

    <?php if (empty($notas)): ?>
        <div class="alert alert-info">No hay notas registradas.</div>
    <?php else: ?>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Estudiante</th>
                    <th>Materia</th>
                    <th>Actividad</th>
                    <th>Nota</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($notas as $nota): ?>
                <tr>
                    <td><?= htmlspecialchars($nota['estudiante']) ?></td>
                    <td><?= htmlspecialchars($nota['materia']) ?></td>
                    <td><?= htmlspecialchars($nota['actividad']) ?></td>
                    <td><?= number_format($nota['nota'], 2) ?></td>
                    <td>
                        <a href="edit.php?materia=<?= urlencode($nota['materia']) ?>&estudiante=<?= urlencode($nota['estudiante']) ?>&actividad=<?= urlencode($nota['actividad']) ?>" class="btn btn-sm btn-warning">Editar</a>
                        <a href="show.php?materia=<?= urlencode($nota['materia']) ?>&estudiante=<?= urlencode($nota['estudiante']) ?>&actividad=<?= urlencode($nota['actividad']) ?>" class="btn btn-sm btn-info">Ver</a>
                        <a href="delete.php?materia=<?= urlencode($nota['materia']) ?>&estudiante=<?= urlencode($nota['estudiante']) ?>&actividad=<?= urlencode($nota['actividad']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar esta nota? Esta acción no se puede deshacer.');">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
</body>
</html>
