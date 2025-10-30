<?php
$content = '<h1>Editar Estudiante</h1>
<form method="POST">
<label>Nombre:</label>
<input type="text" name="nombre" value="' . htmlspecialchars($estudiante['nombre']) . '" required>
<br>
<label>Email:</label>
<input type="email" name="email" value="' . htmlspecialchars($estudiante['email']) . '" required>
<br>
<label>Programa:</label><select name="programa" required>';
foreach ($programas as $p) {
    $selected = ($p['codigo'] == $estudiante['programa']) ? 'selected' : '';
    $content .= "<option value='{$p['codigo']}' $selected>{$p['nombre']}</option>";
}
$content .= '</select>
<br>
<button type="submit">Actualizar</button>
</form>';
include '../views/layout.php';
?>