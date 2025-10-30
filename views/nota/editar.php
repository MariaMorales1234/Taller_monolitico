<?php
$content = '<h1>Editar Nota</h1>
<form method="POST">
    <label>Nota (0-5):</label>
        <input type="number" step="0.01" min="0" max="5" name="nota" value="' . htmlspecialchars($nota['nota']) . '" required><br>
        <button type="submit">Actualizar</button>
</form>';
include '../views/layout.php';