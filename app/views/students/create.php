<?php include_once __DIR__ .'/../partials/header.php';?>
<?php include_once __DIR__ .'/../partials/navbar.php';?>

<div class="container">
  <h2>Registrar nuevo estudiante</h2>

  <form action="../../controllers/EstudianteController.php?action=store" method="POST" class="formulario">
    <div class="campo">
      <label for="codigo">Código:</label>
      <input type="text" id="codigo" name="codigo" required>
    </div>

    <div class="campo">
      <label for="nombre">Nombre:</label>
      <input type="text" id="nombre" name="nombre" required>
    </div>

    <div class="campo">
      <label for="correo">Correo electrónico:</label>
      <input type="email" id="correo" name="correo" required>
    </div>

    <div class="campo">
      <label for="programa">Programa de formación:</label>
      <select id="programa" name="programa" required>
        <option value="">Seleccione un programa</option>
        <?php foreach ($programas as $prog): ?>
          <option value="<?= $prog['id'] ?>"><?= htmlspecialchars($prog['nombre']) ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="acciones-form">
      <button type="submit" class="btn">Guardar</button>
      <a href="index.php" class="btn-cancelar">Cancelar</a>
    </div>
  </form>
</div>

<?php include_once __DIR__ . '/../partials/footer.php'; ?>
