<?php
$content = '<h1>Crear Nota</h1><form method="POST"><label>Estudiante:</label><select name="estudiante" required>';
foreach ($estudiantes as $e) {
    $content .= "<option value='{$e['codigo']}'>{$e['nombre']}</option>";
}
$content .= '</select><br><label>Materia:</label><select name="materia" required>';
foreach ($materias as $m) {
    $content .= "<option value='{$m['codigo']}'>{$m['nombre']}</option>";
}
$content .= '</select><br><label>Actividad:</label><input type="text" name="actividad" required><br><label>Nota (0-5):</label><input type="number" step="0.01" min="0" max="5" name="nota" required><br><button type="submit">Crear</button></form>';
include '../views/layout.php';