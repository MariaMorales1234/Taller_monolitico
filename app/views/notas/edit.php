<?php
include_once __DIR__ . '/../../partials/header.php';
require_once __DIR__ . '/../../controllers/NotaController.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    die("ID de nota no proporcionado.");
}
$controller = new NotaController();
$nota = $controller->show($id);
if (!$nota) {
    echo '<div class="container mt-4"><div class="alert alert-danger">Nota no encontrada.</div><a href="index.php" class="btn btn-primary">Volver</a></div>';
    include_once __DIR__ . '/../../partials/footer.php';
    exit;
}
?>
<div class="container mt-4">
    <h2>Editar Nota</h2>

<form action="update.php" method="POST" class="needs-validation" novalidate>
    <input type="hidden" name="id" value="<?= htmlspecialchars($nota['id']) ?>">
    <input type="hidden" name="estudiante" value="<?= htmlspecialchars($nota['estudiante']) ?>">
    <input type="hidden" name="materia" value="<?= htmlspecialchars($nota['materia']) ?>">

<div class="mb-3">
    <label for="estudiante_display" class="form-label">Estudiante (no editable)</label>
    <input type="text" class="form-control" id="estudiante_display" value="<?= htmlspecialchars($nota['estudiante']) ?>" disabled>
</div>

<div class="mb-3">
    <label for="materia_display" class="form-label">Materia (no editable)</label>
    <input type="text" class="form-control" id="materia_display" value="<?= htmlspecialchars($nota['materia']) ?>" disabled>
</div>

<div class="mb-3">
    <label for="nota" class="form-label">Nota (0.00 - 4.99)</label>
    <input type="number" class="form-control" id="nota" name="nota" step="0.01" min="0.01" max="4.99" value="<?= number_format($nota['nota'], 2) ?>" required>
    <div class="invalid-feedback">La nota debe ser entre 0.01 y 4.99.</div>
</div>

<button type="submit" class="btn btn-success">Actualizar Nota</button>
<a href="show.php?id=<?= urlencode($nota['id']) ?>" class="btn btn-secondary">Cancelar</a>
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