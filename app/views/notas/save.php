<?php
require_once __DIR__ . '/../../controller/NotaController.php';
use App\Controller\NotaController;

$controller = new NotaController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Recuperar y limpiar los datos
    $estudiante = trim($_POST['estudiante'] ?? '');
    $materia    = trim($_POST['materia'] ?? '');
    $actividad  = trim($_POST['actividad'] ?? '');
    $nota       = $_POST['nota'] ?? null;

    // Validaciones básicas
    if ($estudiante === '' || $materia === '' || $actividad === '' || $nota === null) {
        echo "<script>alert('Todos los campos son obligatorios.'); window.history.back();</script>";
        exit;
    }

    if (!is_numeric($nota) || $nota < 0 || $nota > 5) {
        echo "<script>alert('La nota debe estar entre 0.00 y 5.00.'); window.history.back();</script>";
        exit;
    }

    // Guardar la nota
    $ok = $controller->store($estudiante, $materia, $actividad, (float)$nota);

    if ($ok) {
        echo "<script>alert('Nota registrada correctamente.'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Error al registrar la nota. Es posible que ya exista una nota con esos datos.'); window.history.back();</script>";
    }

} else {
    echo "<script>alert('Acceso no permitido.'); window.location.href='index.php';</script>";
}
