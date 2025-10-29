<?php
require_once __DIR__ . '/../../controllers/MateriaController.php';
use App\Controller\MateriaController;

$codigo = $_GET['codigo'] ?? null;
if (!$codigo) die("Código no proporcionado.");

$controller = new MateriaController();
$materia = $controller->show($codigo);

if (!$materia) die("Materia no encontrada.");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Materia</title>
    <link rel="stylesheet" href="../../public/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    <h2>Editar Materia</h2>

    <form action="index.php?controller=materia&action=update" method="POST" class="needs-validation" novalidate>
        <input type="hidden" name="codigo" value="<?= htmlspecialchars($materia['codigo']) ?>">

        <div class="mb-3">
            <label class="form-label">Código</label>
            <input type="text" class="form-control" value="<?= htmlspecialchars($materia['codigo']) ?>" disabled>
        </div>

        <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" class="form-control" name="nombre" value="<?= htmlspecialchars($materia['nombre']) ?>" required>
        </div>

        <button type="submit" class="btn btn-success">Actualizar</button>
        <a href="index.php?controller=materia&action=index" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
</body>
</html>
