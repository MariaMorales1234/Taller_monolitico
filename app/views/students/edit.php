<?php include_once __DIR__ .'/../partials/header.php';?>
<?php include_once __DIR__ .'/../partials/navbar.php';?>

<div class="container">
  <h2>Editar estudiante</h2>

  <?php if (isset($estudiante)): ?>
    <form action="../../controllers/EstudianteController.php?action=update" method="POST" class="formulario">
    
      <div class="campo">
        <label for="codigo">Código:</label>
        <input type="text" id="codigo" name="codigo" value="
        <?= htmlspecialchars($estudiante['codigo']) ?>" readonly>
      </div>

      <div class="campo">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="
        <?= htmlspecialchars($estudiante['nombre']) ?>" required>
      </div>

      <div class="campo">
        <label for="correo">Correo electrónico:</label>
        <input type="email" id="correo" name="correo" value="
        <?= htmlspecialchars($estudiante['correo']) ?>" required>
      </div>

      <div class="campo">
        <label for="programa">Programa de formación:</label>
        <select id="programa" name="programa" required>
          <?php foreach ($programas as $prog): ?>
            <option value="<?= $prog['id'] ?>" <?= $prog['id'] == $estudiante['programa_id'] ? 'selected' : '' ?>>
              <?= htmlspecialchars($prog['nombre']) ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="acciones-form">
        <button type="submit" class="btn">Guardar cambios</button>
        <a href="index.php" class="btn-cancelar">Cancelar</a>
      </div>
    </form>

  <?php else: ?>
    <p>No se encontró el estudiante.</p>
  <?php endif; ?>
</div>

<?php include_once __DIR__ . '/../partials/footer.php'; ?>
