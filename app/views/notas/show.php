<?php
require_once __DIR__ . '/../../controller/NotaController.php';
use App\Controller\NotaController;

$materia = $_GET['materia'] ?? null;
$estudiante = $_GET['estudiante'] ?? null;
$actividad = $_GET['actividad'] ?? null; // 🔹 se agrega este parámetro

if (!$materia || !$estudiante || !$actividad) {
    die("⚠️ No se proporcionaron los parámetros necesarios (materia, estudiante y actividad).");
}

$controller = new NotaController();
$nota = $controller->obtenerNota($materia, $estudiante, $actividad); // 🔹 coherente con edit.php

if (!$nota) {
    echo '<div class="container mt-4"><div class="alert alert-danger">Nota no encontrada.</div><a href="index.php" class="btn btn-primary">Volver</a></div>';
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalles de la Nota</title>
    <link rel="stylesheet" href="../../public/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    <h2>Detalles de la Nota</h2>

    <div class="card">
        <div class="card-body">
            <p><strong>Estudiante:</strong> <?= htmlspecialchars($nota['nombre_estudiante'] ?? $nota['estudiante']) ?></p>
            <p><strong>Materia:</strong> <?= htmlspecialchars($nota['nombre_materia'] ?? $nota['materia']) ?></p>
            <p><strong>Actividad:</strong> <?= htmlspecialchars($nota['actividad']) ?></p>
            <p><strong>Nota:</strong> <?= number_format($nota['nota'], 2) ?></p>
        </div>
    </div>

    <div class="mt-3">
        <a href="edit.php?materia=<?= urlencode($nota['materia']) ?>&estudiante=<?= urlencode($nota['estudiante']) ?>&actividad=<?= urlencode($nota['actividad']) ?>" class="btn btn-warning">Editar</a>
        <a href="index.php" class="btn btn-secondary">Volver a la lista</a>
        <a href="delete.php?materia=<?= urlencode($nota['materia']) ?>&estudiante=<?= urlencode($nota['estudiante']) ?>&actividad=<?= urlencode($nota['actividad']) ?>" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar esta nota? Esta acción no se puede deshacer.');">Eliminar</a>
    </div>
</div>
</body>
</html>