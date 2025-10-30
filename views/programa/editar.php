<?php
$content = '<h1>Editar Programa</h1>
<form method="POST">
    <label>Nombre:</label>
        <input type="text" name="nombre" value="' . htmlspecialchars($programa['nombre']) . '" required>
        <br>
    <button type="submit">Actualizar</button>
</form>';
include '../views/layout.php';