
<!DOCTYPE html>
<html>
  <head>
<link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/CSS/body.css" rel = "stylesheet">
    <link href="assets/CSS/carrusel.css" rel = "stylesheet">
    <link href="assets/CSS/consultas.css" rel = "stylesheet">
    <link href="assets/CSS/end-nav.css" rel = "stylesheet">

  <meta charset="UTF-8">
  <title>Formulario de Consulta</title>
  
  </head>

   
<body class="bg-light">

<div class="container mt-5">
  <div class="card shadow-lg col-md-8 mx-auto">
    <div class="card-header bg-dark text-white">
      <h4>Realizar una Consulta</h4>
    </div>

    <div class="card-body">

      <?php if (session()->getFlashdata('msg')): ?>
        <div class="alert alert-success">
          <?= session()->getFlashdata('msg') ?>
        </div>
      <?php endif; ?>

      <?php if (isset($validation)): ?>
        <div class="alert alert-danger">
          <?= $validation->listErrors() ?>
        </div>
      <?php endif; ?>

      <form id="consultaForm" action="<?= base_url('guardar-consultas') ?>" method="post" novalidate>

        <div class="row mb-3">
          <div class="col">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" name="nombre" value="<?= old('nombre') ?>" required>
          </div>
          <div class="col">
            <label for="apellido" class="form-label">Apellido</label>
            <input type="text" class="form-control" name="apellido" value="<?= old('apellido') ?>" required>
          </div>
        </div>

        <div class="mb-3">
          <label for="email" class="form-label">Correo Electrónico</label>
          <input type="email" class="form-control" name="email" value="<?= old('email') ?>" required>
        </div>

        <div class="row mb-3">
          <div class="col">
            <label for="ciudad" class="form-label">Ciudad</label>
            <input type="text" class="form-control" name="ciudad" value="<?= old('ciudad') ?>" required>
          </div>
          <div class="col">
            <label for="pais" class="form-label">País</label>
            <input type="text" class="form-control" name="pais" value="<?= old('pais') ?>" required>
          </div>
        </div>

        <div class="mb-3">
          <label for="comentario" class="form-label">Comentario</label>
          <textarea class="form-control" name="comentario" rows="4" required><?= old('comentario') ?></textarea>
        </div>

       <div class="d-flex justify-content-between">
        <button type="button" class="btn btn-secondary" onclick="document.getElementById('consultaForm').reset()">Limpiar</button>
        <button type="submit" class="btn btn-primary">Enviar Consulta</button>
       </div>

      </form>
    </div>
  </div>
</div>



</body>
</html>