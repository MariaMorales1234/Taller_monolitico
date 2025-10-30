<?php
$content = '<h1>Crear Programa</h1>
<form method="POST">
    <label>Código:</label>
        <input type="text" name="codigo" required><br>
    <label>Nombre:</label>
        <input type="text" name="nombre" required><br>
    <button type="submit">Crear</button>
</form>';

include '../views/layout.php';