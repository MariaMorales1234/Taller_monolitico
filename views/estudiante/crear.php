<?php
use App\Controllers\ProgramaController;
include_once __DIR__ . '/../../partials/header.php';
require_once __DIR__ . '/../../controllers/ProgramaController.php';

$programaController = new ProgramaController();
$programas = $programaController->getAll();
?>

<div class="container mt-4">
    <h2>Registrar Nuevo Estudiante</h2>

    <form action="save.php" method="POST" class="needs-validation" novalidate>
        <div class="mb-3">
            <label for="codigo" class="form-label">Código</label>
            <input type="text" class="form-control" id="codigo" name="codigo" required maxlength="10">
            <div class="invalid-feedback">El código es obligatorio.</div>
        </div>

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required maxlength="100">
            <div class="invalid-feedback">El nombre es obligatorio.</div>
        </div>

        <div class="mb-3">
            <label for="correo" class="form-label">Correo electrónico</label>
            <input type="email" class="form-control" id="correo" name="correo" required maxlength="100">
            <div class="invalid-feedback">El correo es obligatorio y debe tener un formato válido.</div>
        </div>

        <div class="mb-3">
            <label for="programa" class="form-label">Programa de Formación</label>
            <select id="programa" name="programa" class="form-select" required>
                <option value="">Seleccione un programa</option>
                <?php foreach ($programas as $prog): ?>
                    <option value="<?= htmlspecialchars($prog['codigo']) ?>"><?= htmlspecialchars($prog['nombre']) ?></option>
                <?php endforeach; ?>
            </select>
            <div class="invalid-feedback">Debe seleccionar un programa.</div>
        </div>

        <button type="submit" class="btn btn-success">Guardar Estudiante</button>
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

<?php include_once __DIR__ . '/../../partials/footer.php'; ?>