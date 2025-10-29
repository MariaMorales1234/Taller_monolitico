<?php
include_once __DIR__ . '/../../partials/header.php';
require_once __DIR__ . '/../../controllers/MateriaController.php';
require_once __DIR__ . '/../../controllers/ProgramaController.php';

$codigo = $_GET['codigo'] ?? null;
if (!$codigo) {
die("Código de materia no proporcionado.");
}
$controller = new MateriaController();
$materia = $controller->show($codigo);

if (!$materia) {
    echo '<div class="container mt-4"><div class="alert alert-danger">Materia no encontrada.</div><a href="index.php" class="btn btn-primary">Volver</a></div>';
    include_once __DIR__ . '/../../partials/footer.php';
    exit;
}

// Verificar si se puede editar (sin notas ni estudiantes relacionados)
$canEdit = $controller->canUpdate($codigo);
if (!$canEdit) {
    echo '<div class="container mt-4">';
    echo '<div class="alert alert-warning">No se puede editar esta materia porque tiene notas o estudiantes relacionados.</div>';
    echo '<a href="show.php?codigo=' . urlencode($codigo) . '" class="btn btn-primary">Ver detalles</a>';
    echo '<a href="index.php" class="btn btn-secondary">Volver a la lista</a>';
    echo '</div>';
    include_once __DIR__ . '/../../partials/footer.php';
    exit;
}
$programaController = new ProgramaController();
$programas = $programaController->getAll();
?>
<div class="container mt-4">
    <h2>Editar Materia</h2>
<form action="update.php" method="POST" class="needs-validation" novalidate>
    <input type="hidden" name="codigo" value="<?= htmlspecialchars($materia['codigo']) ?>">

<div class="mb-3">
        <label for="codigo_display" class="form-label">Código (no editable)</label>
        <input type="text" class="form-control" id="codigo_display" value="<?= htmlspecialchars($materia['codigo']) ?>" disabled>
</div>

<div class="mb-3">
        <label for="nombre" class="form-label">Nombre de la Materia</label>
        <input type="text" class="form-control" id="nombre" name="nombre" value="<?= htmlspecialchars($materia['nombre']) ?>" required maxlength="100">
        <div class="invalid-feedback">El nombre es obligatorio.</div>
        </div>

<div class="mb-3">
        <label for="programa" class="form-label">Programa de Formación</label>
        <select class="form-select" id="programa" name="programa" required>
        <option value="">Selecciona un programa</option>
        <?php foreach ($programas as $prog): ?>
        <option value="<?= htmlspecialchars($prog['codigo']) ?>" <?= $prog['codigo'] == $materia['programa'] ? 'selected' : '' ?>><?= htmlspecialchars($prog['nombre']) ?></option>
            <?php endforeach; ?>
            </select>
            <div class="invalid-feedback">Debes seleccionar un programa.</div>
</div>

<button type="submit" class="btn btn-success">Actualizar Materia</button>
<a href="show.php?codigo=<?= urlencode($materia['codigo']) ?>" class="btn btn-secondary">Cancelar</a>
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