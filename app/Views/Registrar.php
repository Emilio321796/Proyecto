<form class="card p-4 shadow-lg mx-auto" style="max-width: 700px;" action="<?= base_url('Crear') ?>" method="post">
  <h3 class="text-center mb-4 text-primary">Acreditate</h3>
  
  <div class="row g-3">
    <!-- Nombre -->
    <div class="col-sm-6">
      <label for="nombre" class="form-label">Nombre</label>
      <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese el nombre" required>
      <?php if ($validation->getError('nombre')): ?>
        <div class="text-danger small"><?= $validation->getError('nombre') ?></div>
      <?php endif; ?>
    </div>

    <!-- Apellido -->
    <div class="col-sm-6">
      <label for="apellido" class="form-label">Apellido</label>
      <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Ingrese el apellido" required>
      <?php if ($validation->getError('apellido')): ?>
        <div class="text-danger small"><?= $validation->getError('apellido') ?></div>
      <?php endif; ?>
    </div>

    <!-- Usuario -->
    <div class="col-12">
      <label for="usuario" class="form-label">Usuario</label>
      <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Ingrese su nombre de usuario" required>
      <?php if ($validation->getError('usuario')): ?>
        <div class="text-danger small"><?= $validation->getError('usuario') ?></div>
      <?php endif; ?>
    </div>

    <!-- Email -->
    <div class="col-12">
      <label for="email" class="form-label">Correo Electrónico</label>
      <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com" required>
      <?php if ($validation->getError('email')): ?>
        <div class="text-danger small"><?= $validation->getError('email') ?></div>
      <?php endif; ?>
    </div>

    <!-- Contraseña -->
    <div class="col-12">
      <label for="pass" class="form-label">Contraseña</label>
      <input type="password" class="form-control" id="pass" name="pass" placeholder="Ingrese la contraseña" required>
      <?php if ($validation->getError('pass')): ?>
        <div class="text-danger small"><?= $validation->getError('pass') ?></div>
      <?php endif; ?>
    </div>


  <!-- Confirmar Contraseña -->
  <div class="col-12">
    <label for="confirmar_pass" class="form-label">Confirmar Contraseña</label>
    <input type="password" class="form-control" id="confirmar_pass" name="confirmar_pass" placeholder="Repita la contraseña" required>
  <?php if ($validation->getError('confirmar_pass')): ?>
    <div class="text-danger small"><?= $validation->getError('confirmar_pass') ?></div>
  <?php endif; ?>
  </div>
</div>
  <!-- Botón -->
  <div class="text-center mt-4 d-flex justify-content-center gap-3">
      <button class="btn btn-primary w-25" type="submit">Registrarse</button>
      <a href="<?= base_url('login') ?>" class="btn btn-secondary w-25">Cancelar</a>
  </div>
</form>
