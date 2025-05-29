
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/CSS/body.css" rel="stylesheet">
  <link href="assets/CSS/carrusel.css" rel="stylesheet">
  <link href="assets/CSS/end-nav.css" rel="stylesheet">
</head>

<body>
  <div class="container mt-5 mb-5 d-flex justify-content-center">
    <div class="card rounded-3 shadow-lg col-12 col-sm-10 col-md-8 col-lg-6 p-0" style="background-color: #f9f9f9;">
      <div class="card-header text-center bg-dark rounded-top">
        <h2 class="text-white">Iniciar sesión</h2>
        <?php if(session()->getFlashdata('msg')): ?>
          <div class="alert alert-warning">
            <?= session()->getFlashdata('msg') ?>
          </div>
        <?php endif; ?>
      </div>
      <form method="post" id="formLogin" action="<?= base_url('/enviarlogin') ?>">
        <div class="card-body bg-dark text-white rounded-bottom">
          <div class="mb-3">
            <label for="email" class="form-label d-block text-center w-150">Correo</label>
            <input id="email" name="email" type="text" class="form-control rounded-3" placeholder="ingrese el correo">
          </div>
          <div class="mb-3">
            <label for="pass" class="form-label d-block text-center w-150">Contraseña</label>
            <input id="pass" name="pass" type="password" class="form-control rounded-3" placeholder="ingrese la contraseña">
          </div>
          <div class="d-flex justify-content-between gap-2 mt-3">
            <button type="submit" class="btn btn-secondary w-50 rounded-3 py-2">Ingresar</button>
            <button type="button" class="btn btn-secondary w-50 rounded-3 py-2" onclick="document.getElementById('formLogin').reset();">Cancelar</button>
          </div>
          <br>
          <span class="text-white">¿Aún no se registró?
            <a href="#" data-bs-toggle="modal" data-bs-target="#registerModal">Registrarse aquí</a>
          </span>
        </div>
      </form>
    </div>
  </div>

  <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
