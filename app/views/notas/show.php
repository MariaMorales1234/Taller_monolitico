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
    <h2>Detalles de la Nota</h2>

<div class="card">
<div class="card-body">
    <p><strong>Estudiante:</strong> <?= htmlspecialchars($nota['estudiante']) ?></p>
    <p><strong>Materia:</strong> <?= htmlspecialchars($nota['materia']) ?></p>
    <p><strong>Nota:</strong> <?= number_format($nota['nota'], 2) ?></p>
</div>
</div>

<div class="mt-3">
    <a href="edit.php?id=<?= urlencode($nota['id']) ?>" class="btn btn-warning">Editar</a>
    <a href="index.php" class="btn btn-secondary">Volver a la lista</a>
    <a href="delete.php?id=<?= urlencode($nota['id']) ?>" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar esta nota? Esta acción no se puede deshacer.');">Eliminar</a>
</div>
</div>
<?php include_once __DIR__ . '/../../partials/footer.php'; ?>