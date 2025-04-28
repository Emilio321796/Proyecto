
<link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/CSS/body.css" rel = "stylesheet">
    <link href="assets/CSS/carrusel.css" rel = "stylesheet">
    <link href ="assets/CSS/end-nav.css" rel = "stylesheet">
    <link href ="assets/CSS/card.css" rel = "stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<body>
<div class="container mt-5 mb-5 d-flex justify-content-center">
        <div class="card" style="width: 50%;">
            <div class="card-header2 text-center" style="background-color: hsl(60, 3.20%, 6.10%);">
                <h2>Iniciar sesión</h2>
            </div>
            <form method="post" action="<?php echo base_url('/enviarlogin') ?>">
                <div class="card-body" style="background-color:rgb(54, 50, 44);">
                    <div class="col-12 mb-2">
                        <label for="exampleFormControlInput1" class="form-label">Correo</label>
                        <input name="email" type="text" class="form-control" placeholder="correo">
                    </div>
                    <div class="col-12 mb-2">
                        <label for="exampleFormControlInput1" class="form-label">Password</label>
                        <input name="pass" type="password" class="form-control" placeholder="contraseña">
                    </div>
                    <button type="submit" value="Ingresar" class="btn btn-success">Ingresar</button>
                    <a href="<?php echo base_url('Login'); ?>" class="btn btn-danger">Cancelar</a>
                    <br>
                    <span>¿Aún no se registró? <a href="<?php echo base_url('/Registrar'); ?>">Registrarse aquí</a></span>
                </div>
            </form>
        </div>
    </div>

  <link href = "assets/bootstrap/js/bootstrap.bundle.min.js"> 
</body>