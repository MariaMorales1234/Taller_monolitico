<?php
include_once __DIR__ . '/../../partials/header.php';

use App\Model\Entities\Estudiante;
require_once __DIR__ . '/../../model/entities/Estudiante.php';

$codigo = $_GET['codigo'] ?? null;

if (!$codigo) {
    die("<div class='container mt-4 alert alert-danger'>Código de estudiante no proporcionado.</div>");
}

$estudianteModel = new Estudiante();
$estudiante = $estudianteModel->obtenerPorCodigo($codigo);

if (!$estudiante) {
    echo "
        <div class='container mt-4'>
            <div class='alert alert-danger'>Estudiante no encontrado.</div>
            <a href='index.php' class='btn btn-primary mt-3'>Volver</a>
        </div>
    ";
    include_once __DIR__ . '/../../partials/footer.php';
    exit;
}
?>

<div class="container mt-4">
    <h2>Detalles del Estudiante</h2>

    <div class="card">
        <div class="card-body">
            <p><strong>Código:</strong> <?= htmlspecialchars($estudiante['codigo']) ?></p>
            <p><strong>Nombre:</strong> <?= htmlspecialchars($estudiante['nombre']) ?></p>
            <p><strong>Correo:</strong> <?= htmlspecialchars($estudiante['correo']) ?></p>
            <p><strong>Programa:</strong> <?= htmlspecialchars($estudiante['programa']) ?></p>
        </div>
    </div>

    <div class="mt-3">
        <a href="edit.php?codigo=<?= urlencode($estudiante['codigo']) ?>" class="btn btn-warning">Editar</a>
        <a href="index.php" class="btn btn-secondary">Volver a la lista</a>
        <a href="delete.php?codigo=<?= urlencode($estudiante['codigo']) ?>" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este estudiante? Esta acción no se puede deshacer.');">Eliminar</a>
    </div>
</div>

<?php include_once __DIR__ . '/../../partials/footer.php'; ?>