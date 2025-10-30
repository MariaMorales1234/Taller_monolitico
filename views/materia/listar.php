<?php
$content = '<h1>Materias</h1>
<a href="index.php?controller=materia&action=create">Crear Nueva Materia</a>
<table>
    <tr>
        <th>Código</th>
        <th>Nombre</th>
        <th>Programa</th>
        <th>Acciones</th>
    </tr>';
foreach ($materias as $m) {
    $content .= "<tr>
                    <td>{$m['codigo']}</td>
                    <td>{$m['nombre']}</td>
                    <td>{$m['programa']}</td>
                    <td>
                        <a href='index.php?controller=materia&action=edit&codigo={$m['codigo']}'>Editar</a> | <a href='index.php?controller=materia&action=delete&codigo={$m['codigo']}'>Eliminar</a>
                    </td>
                </tr>";
}
$content .= '</table>';
include '../views/layout.php';