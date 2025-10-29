<?php
include_once __DIR__ . '/../../partials/header.php';
require_once __DIR__ . '/../../controllers/EstudianteController.php';
require_once __DIR__ . '/../../controllers/MateriaController.php';


$materiaController = new MateriaController();
$materias = $materiaController->getAll();
?>
<div class="container mt-4">
<h2>Registrar Nueva Nota</h2>
<form action="save.php" method="POST" class="needs-validation" novalidate>
    <div class="mb-3">
        <label for="estudiante" class="form-label">Estudiante</label>
        <select class="form-select" id="estudiante" name="estudiante" required>
        <option value="">Selecciona un estudiante</option>
        <?php foreach ($estudiantes as $est): ?>
            <option value="<?= htmlspecialchars($est['codigo']) ?>"><?= htmlspecialchars($est['nombre']) ?></option>
            <?php endforeach; ?>
        </select>
        <div class="invalid-feedback">Debes seleccionar un estudiante.</div>
    </div>

    <div class="mb-3">
        <label for="materia" class="form-label">Materia</label>
        <select class="form-select" id="materia" name="materia" required>
            <option value="">Selecciona una materia</option>
            <?php foreach ($materias as $mat): ?>
            <option value="<?= htmlspecialchars($mat['codigo']) ?>"><?= htmlspecialchars($mat['nombre']) ?></option>
            <?php endforeach; ?>
            </select>
            <div class="invalid-feedback">Debes seleccionar una materia.</div>
    </div>

    <div class="mb-3">
        <label for="nota" class="form-label">Nota (0.00 - 4.99)</label>
        <input type="number" class="form-control" id="nota" name="nota" step="0.01" min="0.01" max="4.99" required>
            
    <div class="invalid-feedback">La nota debe ser entre 0.01 y 4.99.</div>
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
<?php include_once __DIR__ . '/../../partials/footer.php'; ?>