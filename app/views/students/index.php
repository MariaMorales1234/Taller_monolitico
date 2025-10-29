<?php include_once __DIR__ . '/../partials/header.php'; ?>
<?php include_once __DIR__ . '/../partials/navbar.php'; ?>

<div class="container">
<div class="toolStudents">
    <h2>Gestión de Estudiantes</h2>
    <div class="acciones">
    <form method="POST" action="">
      <input type="text" name="buscar" placeholder="Buscar estudiante...">
      <button type="submit">Buscar</button>
      </form>
      <a href="create.php" class="btn-add">Nuevo Estudiante</a>
    </div>
  </div>

  <table class="tabla-estudiantes">
    <thead>
      <tr>
      <th>Código</th>
      <th>Nombre</th>
      <th>Correo</th>
      <th>Programa</th>
      <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
  <?php if (!empty($estudiantes)): ?>
  <?php foreach ($estudiantes as $est): ?>
    <tr>
      <td><?= htmlspecialchars($est['codigo']) ?></td>
      <td><?= htmlspecialchars($est['nombre']) ?></td>
      <td><?= htmlspecialchars($est['correo']) ?></td>
      <td><?= htmlspecialchars($est['programa']) ?></td>
        <td>
          <a href="show.php?codigo=<?= $est['codigo'] ?>" class="btn-show">Ver</a>
          <a href="edit.php?codigo=<?= $est['codigo'] ?>" class="btn-edit">Editar</a>
          <a href="delete.php?codigo=<?= $est['codigo'] ?>" class="btn-delete" onclick="return confirm('¿Seguro que deseas eliminar este estudiante?')">Eliminar</a>
        </td>
      </tr>
  <?php endforeach; ?>
  <?php else: ?>
    <tr><td colspan="5">No hay estudiantes registrados</td></tr>
    <?php endif; ?>
    </tbody>
  </table>
</div>
<?php include_once __DIR__ . '/../partials/footer.php'; ?>
