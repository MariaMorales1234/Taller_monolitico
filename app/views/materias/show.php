<?php
include_once __DIR__ . '/../../partials/header.php';
require_once __DIR__ . '/../../controllers/MateriaController.php';

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
?>
<div class="container mt-4">
    <h2>Detalles de la Materia</h2>
    <div class="card">
    <div class="card-body">
        <p><strong>Código:</strong> <?= htmlspecialchars($materia['codigo']) ?></p>
        <p><strong>Nombre:</strong> <?= htmlspecialchars($materia['nombre']) ?></p>
        <p><strong>Programa:</strong> <?= htmlspecialchars($materia['programa']) ?></p>
        </div>
    </div>
    <div class="mt-3">
        <a href="edit.php?codigo=<?= urlencode($materia['codigo']) ?>" class="btn btn-warning">Editar</a>
        <a href="index.php" class="btn btn-secondary">Volver a la lista</a>
        <a href="delete.php?codigo=<?= urlencode($materia['codigo']) ?>" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar esta materia? Esta acción no se puede deshacer.');">Eliminar</a>
    </div>
</div>

<?php include_once __DIR__ . '/../../partials/footer.php'; ?>