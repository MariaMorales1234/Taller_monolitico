<?php
require_once __DIR__ . '/../../controller/MateriaController.php';
require_once __DIR__ . '/../../controller/ProgramaController.php';

use App\Controllers\MateriaController;
use App\Controllers\ProgramaController;

$programaController = new ProgramaController();
$programas = $programaController->getAll(); // ✅ Método correcto
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Nueva Materia</title>
    <link rel="stylesheet" href="../../public/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    <h2>Registrar Nueva Materia</h2>

    <form action="index.php?controller=materia&action=store" method="POST" class="needs-validation" novalidate>
        <div class="mb-3">
            <label for="codigo" class="form-label">Código de la Materia</label>
            <input type="text" class="form-control" id="codigo" name="codigo" required maxlength="10">
        </div>

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre de la Materia</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required maxlength="100">
        </div>

        <div class="mb-3">
            <label for="programa_id" class="form-label">Programa de Formación</label>
            <select class="form-select" id="programa_id" name="programa_id" required>
                <option value="">Selecciona un programa</option>
                <?php foreach ($programas as $prog): ?>
                    <option value="<?= htmlspecialchars($prog['id']) ?>">
                        <?= htmlspecialchars($prog['nombre']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Guardar Materia</button>
        <a href="index.php?controller=materia&action=index" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
</body>
</html>
