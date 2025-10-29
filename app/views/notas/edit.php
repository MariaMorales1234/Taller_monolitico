<?php
use App\Controllers\NotaController;
require_once __DIR__ . '/../../controllers/NotaController.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    die("<div class='container mt-4 alert alert-danger'>ID de nota no proporcionado.</div>");
}

$controller = new NotaController();
$nota = $controller->show($id);

if (!$nota) {
    echo '<div class="container mt-4"><div class="alert alert-danger">Nota no encontrada.</div><a href="index.php" class="btn btn-primary">Volver</a></div>';
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Nota</title>
    <link rel="stylesheet" href="../../public/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    <h2>Editar Nota</h2>

    <form action="../../index.php?controller=nota&action=update" method="POST" class="needs-validation" novalidate>
        <input type="hidden" name="id" value="<?= htmlspecialchars($nota['id']) ?>">

        <div class="mb-3">
            <label class="form-label">Estudiante</label>
            <input type="text" class="form-control" 
                   value="<?= htmlspecialchars($nota['nombre_estudiante'] ?? $nota['estudiante']) ?>" disabled>
        </div>

        <div class="mb-3">
            <label class="form-label">Materia</label>
            <input type="text" class="form-control" 
                   value="<?= htmlspecialchars($nota['nombre_materia'] ?? $nota['materia']) ?>" disabled>
        </div>

        <div class="mb-3">
            <label for="nota" class="form-label">Nota (0.00 - 5.00)</label>
            <input type="number" class="form-control" id="nota" name="nota" 
                   step="0.01" min="0" max="5" 
                   value="<?= number_format($nota['nota'], 2) ?>" required>
            <div class="invalid-feedback">La nota debe estar entre 0.00 y 5.00.</div>
        </div>

        <button type="submit" class="btn btn-success">Actualizar Nota</button>
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
