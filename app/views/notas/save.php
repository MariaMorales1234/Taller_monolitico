<?php
require_once __DIR__ . '/../../controller/NotaController.php';
use App\Controller\NotaController;

// Crear instancia del controlador
$controller = new NotaController();

// Validar que el formulario llegó por método POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Recuperar datos del formulario
    $estudiante = $_POST['estudiante'] ?? null;
    $materia    = $_POST['materia'] ?? null;
    $actividad  = $_POST['actividad'] ?? null;
    $nota       = $_POST['nota'] ?? null;

    // Validaciones básicas
    if (empty($estudiante) || empty($materia) || empty($actividad) || $nota === null) {
        echo "<script>alert('Todos los campos son obligatorios.'); window.history.back();</script>";
        exit;
    }

    if ($nota < 0 || $nota > 5) {
        echo "<script>alert('La nota debe estar entre 0.00 y 5.00.'); window.history.back();</script>";
        exit;
    }

    // Intentar guardar la nota
    $ok = $controller->store($estudiante, $materia, $actividad, $nota);

    if ($ok) {
        echo "<script>alert('Nota registrada correctamente.'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Error al registrar la nota. Verifique los datos.'); window.history.back();</script>";
    }

} else {
    echo "<script>alert('Acceso no permitido.'); window.location.href='index.php';</script>";
}
?>
