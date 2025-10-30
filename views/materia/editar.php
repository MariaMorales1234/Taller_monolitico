<?php
$content = '<h1>Editar Materia</h1>
<form method="POST">
    <label>Nombre:</label>
        <input type="text" name="nombre" value="' . htmlspecialchars($materia['nombre']) . '" required><br>
    <label>Programa:</label>
        <select name="programa" required>';
foreach ($programas as $p) {
    $selected = ($p['codigo'] == $materia['programa']) ? 'selected' : '';
    $content .= "<option value='{$p['codigo']}' $selected>{$p['nombre']}</option>";
}
$content .= '</select><br>
    <button type="submit">Actualizar</button>
</form>';
include '../views/layout.php';