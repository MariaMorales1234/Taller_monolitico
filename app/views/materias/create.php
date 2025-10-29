<?php
include_once __DIR__ . '/../../partials/header.php';
require_once __DIR__ . '/../../controllers/ProgramaController.php';

$controller = new ProgramaController();
$programas = $controller->getAll(); // Obtenemos todos los programas para el select
?>

<div class="container mt-4">
    <h2>Registrar Nueva Materia</h2>

    <form action="save.php" method="POST" class="needs-validation" novalidate>
    <div class="mb-3">
        <label for="codigo" class="form-label">Código de la Materia</label>
        <input type="text" class="form-control" id="codigo" name="codigo" required maxlength="10">
        <div class="invalid-feedback">El código es obligatorio.</div>
    </div>
    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre de la Materia</label>
        <input type="text" class="form-control" id="nombre" name="nombre" required maxlength="100">
        <div class="invalid-feedback">El nombre es obligatorio.</div>
    </div>
    <div class="mb-3">
        <label for="programa" class="form-label">Programa de Formación</label>
        <select class="form-select" id="programa" name="programa" required>
            <option value="">Selecciona un programa</option>
            <?php foreach ($programas as $prog): ?>
            <option value="<?= htmlspecialchars($prog['codigo']) ?>"><?= htmlspecialchars($prog['nombre']) ?></option>
        <?php endforeach; ?>
    </select>
    <div class="invalid-feedback">Debes seleccionar un programa.</div>
    </div>
    <button type="submit" class="btn btn-success">Guardar Materia</button>
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