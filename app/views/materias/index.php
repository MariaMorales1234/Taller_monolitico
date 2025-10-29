<?php
use App\Controllers\MateriaController;
require_once __DIR__ . '/../../controllers/MateriaController.php';

$controller = new MateriaController();
$materias = $controller->getAll(); // ✅ método correcto
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Materias</title>
    <link rel="stylesheet" href="../../public/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    <h2>Materias Registradas</h2>
    <a href="create.php" class="btn btn-primary mb-3">+ Nueva Materia</a>

    <?php if (empty($materias)): ?>
        <div class="alert alert-info">No hay materias registradas.</div>
    <?php else: ?>
    <table class="table table-bordered">
        <thead class="table-light">
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
                    <a href="edit.php?codigo=<?= urlencode($materia['codigo']) ?>" class="btn btn-warning btn-sm">Editar</a>
                    <a href="../../index.php?controller=materia&action=delete&codigo=<?= urlencode($materia['codigo']) ?>"
                       class="btn btn-danger btn-sm"
                       onclick="return confirm('¿Seguro que deseas eliminar esta materia?');">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>
</div>
</body>
</html>
