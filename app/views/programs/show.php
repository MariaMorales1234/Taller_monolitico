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
    echo '<div class="container mt-4"><div class="alert alert-danger">Programa no encontrado.</div><a href="index.php" class="btn btn-primary">Volver</a></div>';
    include_once __DIR__ . '/../../partials/footer.php';
    exit;
}
?>

<div class="container mt-4">
    <h2>Detalles del Programa</h2>

    <div class="card">
        <div class="card-body">
            <p><strong>Código:</strong> <?= htmlspecialchars($programa['codigo']) ?></p>
            <p><strong>Nombre:</strong> <?= htmlspecialchars($programa['nombre']) ?></p>
        </div>
    </div>

    <div class="mt-3">
        <a href="edit.php?codigo=<?= urlencode($programa['codigo']) ?>" class="btn btn-warning">Editar</a>
        <a href="index.php" class="btn btn-secondary">Volver a la lista</a>
        <a href="delete.php?codigo=<?= urlencode($programa['codigo']) ?>" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este programa? Esta acción no se puede deshacer.');">Eliminar</a>
    </div>
</div>

<?php include_once __DIR__ . '/../../partials/footer.php'; ?>