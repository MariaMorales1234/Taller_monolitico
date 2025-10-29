<?php
require_once __DIR__ . '/../../controller/MateriaController.php';
use App\Controller\MateriaController;

$codigo = $_GET['codigo'] ?? null;

if (!$codigo) {
    die("<div class='container mt-4 alert alert-danger'>Código de materia no proporcionado.</div>");
}

$controller = new MateriaController();
$materia = $controller->show($codigo);

if (!$materia) {
    echo "
        <div class='container mt-4'>
            <div class='alert alert-danger'>Materia no encontrada.</div>
            <a href='index.php' class='btn btn-primary'>Volver</a>
        </div>
    ";
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalles de la Materia</title>
    <link rel="stylesheet" href="../../public/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    <h2>Detalles de la Materia</h2>
    <div class="card mt-3">
        <div class="card-body">
            <p><strong>Código:</strong> <?= htmlspecialchars($materia['codigo']) ?></p>
            <p><strong>Nombre:</strong> <?= htmlspecialchars($materia['nombre']) ?></p>
            <p><strong>Programa:</strong> <?= htmlspecialchars($materia['programa']) ?></p>
        </div>
    </div>

    <a href="edit.php?codigo=<?= urlencode($materia['codigo']) ?>" class="btn btn-warning mt-3">Editar</a>
    <a href="../../index.php?controller=materia&action=delete&codigo=<?= urlencode($materia['codigo']) ?>"
       class="btn btn-danger mt-3"
       onclick="return confirm('¿Seguro que deseas eliminar esta materia?');">Eliminar</a>
    <a href="index.php" class="btn btn-secondary mt-3">Volver</a>
</div>
</body>
</html>
