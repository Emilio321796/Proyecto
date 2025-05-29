


<div class="modal-content bg-dark text-white">
  <form action="<?= base_url('Crear') ?>" method="post" class="needs-validation" novalidate>
    <div class="modal-header bg-dark text-white">
      <h5 class="modal-title" id="registerModalLabel">Acreditate</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
    </div>

          <div class="modal-body">
            <div class="row g-3">
              <div class="col-sm-6">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
                <?= $validation->showError('nombre', 'alert'); ?>
              </div>
              <div class="col-sm-6">
                <label for="apellido" class="form-label">Apellido</label>
                <input type="text" class="form-control" id="apellido" name="apellido" required>
                <?= $validation->showError('apellido', 'alert'); ?>
              </div>
              <div class="col-12">
                <label for="usuario" class="form-label">Usuario</label>
                <input type="text" class="form-control" id="usuario" name="usuario" required>
                <?= $validation->showError('usuario', 'alert'); ?>
              </div>
              <div class="col-12">
                <label for="email" class="form-label">Correo electrónico</label>
                <input type="email" class="form-control" id="email" name="email" required>
                <?= $validation->showError('email', 'alert'); ?>
              </div>
              <div class="col-12">
                <label for="pass" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="pass" name="pass" required>
                <?= $validation->showError('pass', 'alert'); ?>
              </div>
            </div>
          </div>

          <div class="modal-footer d-flex justify-content-center">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Registrarse</button>
          </div>
        </form>
      </div>
   

  <!-- Bootstrap JS y tu script -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
  // Este script debe ir después del HTML para que el botón ya exista en el DOM
  document.getElementById('btnRegistrate').addEventListener('click', function () {
    var modal = new bootstrap.Modal(document.getElementById('registerModal'));
    modal.show();
  });
</script>
</body>


