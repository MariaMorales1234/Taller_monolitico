<?php
require_once __DIR__ . '/../../controller/NotaController.php';
require_once __DIR__ . '/../../controller/EstudianteController.php';
require_once __DIR__ . '/../../controller/MateriaController.php';

use App\Controller\EstudianteController;
use App\Controller\MateriaController;

$estudianteController = new EstudianteController();
$materiaController = new MateriaController();

// Obtener datos desde los modelos
$estudiantes = $estudianteController->getAll();
$materias = $materiaController->getAll();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Nueva Nota</title>
    <link rel="stylesheet" href="../../public/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    <h2>Registrar Nueva Nota</h2>

    <form action="../../index.php?controller=nota&action=store" method="POST" class="needs-validation" novalidate>
        <!-- Estudiante -->
        <div class="mb-3">
            <label for="estudiante" class="form-label">Estudiante</label>
            <select class="form-select" id="estudiante" name="estudiante" required>
                <option value="">Selecciona un estudiante</option>
                <?php foreach ($estudiantes as $est): ?>
                    <option value="<?= htmlspecialchars($est['codigo']) ?>">
                        <?= htmlspecialchars($est['nombre']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <div class="invalid-feedback">Debes seleccionar un estudiante.</div>
        </div>

        <!-- Materia -->
        <div class="mb-3">
            <label for="materia" class="form-label">Materia</label>
            <select class="form-select" id="materia" name="materia" required>
                <option value="">Selecciona una materia</option>
                <?php foreach ($materias as $mat): ?>
                    <option value="<?= htmlspecialchars($mat['codigo']) ?>">
                        <?= htmlspecialchars($mat['nombre']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <div class="invalid-feedback">Debes seleccionar una materia.</div>
        </div>

        <!-- Nota -->
        <div class="mb-3">
            <label for="nota" class="form-label">Nota (0.00 - 5.00)</label>
            <input type="number" class="form-control" id="nota" name="nota" step="0.01" min="0" max="5" required>
            <div class="invalid-feedback">La nota debe estar entre 0.00 y 5.00.</div>
        </div>

        <button type="submit" class="btn btn-success">Guardar Nota</button>
        <a href="index.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<script>
(() => {
    'use strict'
    const forms = document.querySelectorAll('.needs-validation')
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }
            form.classList.add('was-validated')
        }, false)
    })
})()
</script>
</body>
</html>
