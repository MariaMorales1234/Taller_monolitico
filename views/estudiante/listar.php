<?php
$content = '<h1>Estudiantes</h1>
<a href="index.php?controller=estudiante&action=create" class="btn">Crear Nuevo Estudiante</a>
<table>
<tr>
<th>Código</th>
<th>Nombre</th>
<th>Email</th>
<th>Programa</th>
<th>Acciones</th>
</tr>';
foreach ($estudiantes as $e) {
    $content .= "
    <tr>
        <td>{$e['codigo']}</td>
        <td>{$e['nombre']}</td>
        <td>{$e['email']}</td>
        <td>{$e['programa']}</td>
        <td>
            <a href='index.php?controller=estudiante&action=edit&codigo={$e['codigo']}'>Editar</a> |
            <a href='index.php?controller=estudiante&action=delete&codigo={$e['codigo']}'>Eliminar</a>
        </td>
    </tr>";
}
$content .= '</table>';
include '../views/layout.php';
?>