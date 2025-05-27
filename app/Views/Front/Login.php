
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/CSS/body.css" rel="stylesheet">
    <link href="assets/CSS/carrusel.css" rel="stylesheet">
    <link href="assets/CSS/end-nav.css" rel="stylesheet">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <body>
  <div class="container mt-5 mb-5 d-flex justify-content-center">
    <div class="card rounded-3 shadow-lg col-12 col-sm-10 col-md-8 col-lg-6 p-0" style="background-color: #f9f9f9;">
      <div class="card-header text-center" style="background-color: hsl(60, 3.20%, 6.10%); border-radius: 1rem;">
        <h2>Iniciar sesión</h2>

        <?php if(session()->getFlashdata('msg')): ?>
          <div class="alert alert-warning">
            <?= session()->getFlashdata('msg') ?>
          </div>
        <?php endif; ?> 

        <form method="post" action="<?= base_url('/enviarlogin') ?>">
          <div class="card-body" style="background-color: rgb(54, 50, 44); border-radius: 1rem;">
            <div class="col-12 mb-2">
              <label for="email" class="form-label text-white">Correo</label>
              <input name="email" type="text" class="form-control rounded-3" placeholder="correo">
            </div>
            <div class="col-12 mb-2">
              <label for="pass" class="form-label text-white">Password</label>
              <input name="pass" type="password" class="form-control rounded-3" placeholder="contraseña">
            </div>

            <div class="d-flex justify-content-between gap-2 mt-3">
              <button type="submit" class="btn btn-secondary w-50 rounded-3 py-2">Ingresar</button>
              <button type="button" class="btn btn-secondary w-50 rounded-3 py-2" data-bs-dismiss="modal">Cancelar</button>
            </div>
            <br>
            <span class="text-white">¿Aún no se registró? 
              <a href="#" data-bs-toggle="modal" data-bs-target="#registerModal">Registrarse aquí</a>
            </span>
          </div>
        </form>
      </div>
    </div>
  </div>

  