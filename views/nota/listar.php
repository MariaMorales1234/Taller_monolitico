<?php
$content = '<h1>Notas</h1>
<a href="index.php?controller=nota&action=create" class="btn">Crear Nueva Nota</a>
<table>
    <tr>
        <th>ID</th>
        <th>Estudiante</th>
        <th>Materia</th>
        <th>Actividad</th>
        <th>Nota</th>
        <th>Acciones</th>
    </tr>';
foreach ($notas as $n) {
    $content .= 
    "<tr>
        <td>{$n['id']}</td>
        <td>{$n['estudiante']}</td>
        <td>{$n['materia']}</td>
        <td>{$n['actividad']}</td>
        <td>{$n['nota']}</td>
        <td>
            <a href='index.php?controller=nota&action=edit&id={$n['id']}'>Editar</a> | 
            <a href='index.php?controller=nota&action=delete&id={$n['id']}'>Eliminar</a>
        </td>
    </tr>";
}
$content .= '</table>';
include '../views/layout.php';