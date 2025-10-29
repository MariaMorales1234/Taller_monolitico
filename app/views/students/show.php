<?php
include_once __DIR__ . '/../partials/header.php';

use App\Model\Entities\Estudiante;
require_once __DIR__ . '/../../model/entities/Estudiante.php';

$codigo = $_GET['codigo'] ?? null;
$estudiante = null;

if ($codigo) {
    $estudianteModel = new Estudiante();
    $estudiante = $estudianteModel->obtenerPorCodigo($codigo);
}
?>

<div class="container">
  <?php if ($estudiante): ?>
    <h2>Detalles del estudiante</h2>
    <p><strong>Código:</strong> <?= htmlspecialchars($estudiante['codigo']) ?></p>
    <p><strong>Nombre:</strong> <?= htmlspecialchars($estudiante['nombre']) ?></p>
    <p><strong>Correo:</strong> <?= htmlspecialchars($estudiante['correo']) ?></p>
    <p><strong>Programa:</strong> <?= htmlspecialchars($estudiante['programa']) ?></p>
    <a href="index.php">Volver</a>
  <?php else: ?>
    <p>No se encontró el estudiante con el código especificado.</p>
    <a href="index.php">Volver</a>
  <?php endif; ?>
</div>

<?php
include_once __DIR__ . '/../partials/footer.php';
?>