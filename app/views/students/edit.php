<?php
include_once __DIR__ . '/../../partials/header.php';
require_once __DIR__ . '/../../controllers/EstudianteController.php';
require_once __DIR__ . '/../../controllers/ProgramaController.php';

$codigo = $_GET['codigo'] ?? null;
if (!$codigo) {
    die("<div class='container mt-4 alert alert-danger'>Código de estudiante no proporcionado.</div>");
}

$controller = new EstudianteController();
$estudiante = $controller->show($codigo);

if (!$estudiante) {
    echo '<div class="container mt-4"><div class="alert alert-danger">Estudiante no encontrado.</div><a href="index.php" class="btn btn-primary">Volver</a></div>';
    include_once __DIR__ . '/../../partials/footer.php';
    exit;
}

// Obtener programas disponibles
$programaController = new ProgramaController();
$programas = $programaController->getAll();
?>

<div class="container mt-4">
    <h2>Editar Estudiante</h2>

    <form action="update.php" method="POST" class="needs-validation" novalidate>
        <input type="hidden" name="codigo" value="<?= htmlspecialchars($estudiante['codigo']) ?>">

        <div class="mb-3">
            <label for="codigo_display" class="form-label">Código (no editable)</label>
            <input type="text" class="form-control" id="codigo_display" value="<?= htmlspecialchars($estudiante['codigo']) ?>" disabled>
        </div>

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="<?= htmlspecialchars($estudiante['nombre']) ?>" required maxlength="100">
            <div class="invalid-feedback">El nombre es obligatorio.</div>
        </div>

        <div class="mb-3">
            <label for="correo" class="form-label">Correo electrónico</label>
            <input type="email" class="form-control" id="correo" name="correo" value="<?= htmlspecialchars($estudiante['correo']) ?>" required maxlength="100">
            <div class="invalid-feedback">Debe ingresar un correo válido.</div>
        </div>

        <div class="mb-3">
            <label for="programa" class="form-label">Programa de Formación</label>
            <select id="programa" name="programa" class="form-select" required>
                <option value="">Seleccione un programa</option>
                <?php foreach ($programas as $prog): ?>
                    <option value="<?= htmlspecialchars($prog['codigo']) ?>" 
                        <?= $prog['codigo'] == $estudiante['programa'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($prog['nombre']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <div class="invalid-feedback">Debe seleccionar un programa.</div>
        </div>

        <button type="submit" class="btn btn-success">Actualizar Estudiante</button>
        <a href="show.php?codigo=<?= urlencode($estudiante['codigo']) ?>" class="btn btn-secondary">Cancelar</a>
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

<?php include_once __DIR__ . '/../../partials/footer.php'; ?>