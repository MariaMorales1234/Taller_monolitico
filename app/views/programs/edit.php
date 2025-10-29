<?php
use App\Controllers\ProgramaController;
include_once __DIR__ . '/../../partials/header.php';
require_once __DIR__ . '/../../controllers/ProgramaController.php';

$codigo = $_GET['codigo'] ?? null;
if (!$codigo) {
    die("Código de programa no proporcionado.");
}

$controller = new ProgramaController();
$programa = $controller->show($codigo);

if (!$programa) {
    echo '<div class="container mt-4">
            <div class="alert alert-danger">Programa no encontrado.</div>
            <a href="index.php" class="btn btn-primary">Volver</a>
          </div>';
    include_once __DIR__ . '/../../partials/footer.php';
    exit;
}

// Verificar si se puede editar (sin relaciones)
$canEdit = $controller->canUpdate($codigo);
if (!$canEdit) {
    echo '<div class="container mt-4">
            <div class="alert alert-warning">
                No se puede editar este programa porque tiene estudiantes o materias relacionadas.
            </div>
            <a href="show.php?codigo=' . urlencode($codigo) . '" class="btn btn-primary">Ver detalles</a>
            <a href="index.php" class="btn btn-secondary">Volver a la lista</a>
          </div>';
    include_once __DIR__ . '/../../partials/footer.php';
    exit;
}
?>

<div class="container mt-4">
    <h2>Editar Programa</h2>

    <form action="update.php" method="POST" class="needs-validation" novalidate>
        <input type="hidden" name="codigo" value="<?= htmlspecialchars($programa['codigo']) ?>">

        <div class="mb-3">
            <label for="codigo_display" class="form-label">Código (no editable)</label>
            <input type="text" class="form-control" id="codigo_display" value="<?= htmlspecialchars($programa['codigo']) ?>" disabled>
        </div>

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre del Programa</label>
            <input type="text" class="form-control" id="nombre" name="nombre"
                   value="<?= htmlspecialchars($programa['nombre']) ?>" required maxlength="100">
            <div class="invalid-feedback">El nombre es obligatorio.</div>
        </div>

        <button type="submit" class="btn btn-success">Actualizar Programa</button>
        <a href="show.php?codigo=<?= urlencode($programa['codigo']) ?>" class="btn btn-secondary">Cancelar</a>
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