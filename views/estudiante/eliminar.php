<?php
$content = '<h1>Eliminar Estudiante</h1>
<p>¿Estás seguro de eliminar el estudiante?</p>
<form method="POST">
<button type="submit" name="confirm" value="yes">Sí</button> 
<button type="submit" name="confirm" value="no">No</button>
</form>';
include '../views/layout.php';
?>