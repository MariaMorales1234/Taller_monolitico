<?php
require_once __DIR__ . '/../../controller/MateriaController.php';
use App\Controller\MateriaController;

$codigo = $_GET['codigo'] ?? null;

if (!$codigo) {
    die("<div class='container mt-4 alert alert-danger'>Código de materia no proporcionado.</div>");
}

$controller = new MateriaController();
$materia = $controller->show($codigo);

if (!$materia) {
    echo "
        <div class='container mt-4'>
            <div class='alert alert-danger'>Materia no encontrada.</div>
            <a href='index.php' class='btn btn-primary'>Volver</a>
        </div>
    ";
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalles de la Materia</title>
    <link rel="stylesheet" href="../../public/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    <h2>Detalles de la Materia</h2>
    <div
