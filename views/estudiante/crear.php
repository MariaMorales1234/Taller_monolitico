<?php
$content = '<h1>Crear Estudiante</h1>
<form method="POST">
<label>Código:</label>
<input type="text" name="codigo" required>
<br>
<label>Nombre:</label>
<input type="text" name="nombre" required>
<br>
<label>Email:</label>
<input type="email" name="email" required>
<br>
<label>Programa:</label>
<select name="programa" required>';
foreach ($programas as $p) {
    $content .= "<option value='{$p['codigo']}'>{$p['nombre']}</option>";
}
$content .= '</select>
<br>
<button type="submit">Crear</button>
</form>';
include '../views/layout.php';
?>