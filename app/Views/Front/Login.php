
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet"> 
 <link href="assets/CSS/carousel.css" rel="stylesheet">
  <link href="assets/CSS/body.css" rel="stylesheet">

</head>

<body>
  <div class="container mt-5 mb-5 d-flex justify-content-center">
  <div class="card bg-dark text-white w-50">
    <div class="card-header text-center bg-dark border-0">
      <h2 class="text-white">Iniciar sesión</h2>
    </div>

    <!-- Mensaje de Error -->
    <?php if(session()->getFlashdata('msg')):?>
      <div class="alert alert-warning text-center">
        <?= session()->getFlashdata('msg') ?>
      </div>
    <?php endif; ?>  

    <!-- Formulario de login -->
    <form method="post" action="<?= base_url('/enviarlogin') ?>">
      <div class="card-body text-center">

        <div class="mb-3">
          <label for="email" class="form-label">Correo</label>
          <input name="email" type="text" class="form-control" placeholder="Correo" required>
        </div>

        <div class="mb-3">
          <label for="pass" class="form-label">Contraseña</label>
          <input name="pass" type="password" class="form-control" placeholder="Contraseña" required>
        </div>

        <div class="d-flex justify-content-center gap-2 my-3">
          <button type="submit" class="btn btn-success px-4">Ingresar</button>
          <a href="<?= base_url('login') ?>" class="btn btn-danger px-4">Cancelar</a>
        </div>

        <span>¿Aún no se registró? <a href="<?= base_url('/Registrar') ?>" class="text-info">Registrarse aquí</a></span>

      </div>
    </form>
  </div>
</div>

</body>
   
  