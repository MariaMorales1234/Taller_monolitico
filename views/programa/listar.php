<?php
$content = '<h1>Programas de Formación</h1>
<div style="text-align:center, margin-botton:25px">
    <a href="index.php?controller=programa&action=create" class="btn" style="text-decoration:none">+ Crear Nuevo Programa</a>
</div>
<table border="1">
<tr>
<th>Código</th>
<th>Nombre</th>
<th>Acciones</th>
</tr>';
foreach ($programas as $p) {
    $content .= "<tr><td>{$p['codigo']}</td><td>{$p['nombre']}</td>
    <td>
    <a href='index.php?controller=programa&action=edit&codigo={$p['codigo']}'>Editar</a> | 
    <a href='index.php?controller=programa&action=delete&codigo={$p['codigo']}'>Eliminar</a>
    </td>
    </tr>";
}
$content .= '</table>';
include '../views/layout.php';
?>