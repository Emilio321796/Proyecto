<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Listado de Consultas</title>
  <link href="<?= base_url('assets/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
   <link href="assets/CSS/listado_consultas.css" rel = "stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
  <h4 class="mb-4 text-center">Todas las Consultas</h4>

  <?php if (session()->getFlashdata('status')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('status') ?></div>
  <?php endif; ?>

  <div class="table-responsive">
    <table class="table table-bordered table-hover align-middle">
      <thead class="table-dark">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Nombre</th>
          <th scope="col">Apellido</th>
          <th scope="col">Email</th>
          <th scope="col">Ciudad</th>
          <th scope="col">País</th>
          <th scope="col">Comentario</th>
        </tr>
      </thead>
      <tbody>
        <?php if (! empty($consultas) && is_array($consultas)): ?>
          <?php foreach ($consultas as $consulta): ?>
            <tr>
              <th scope="row"><?= esc($consulta['id']) ?></th>
              <td><?= esc($consulta['Nombre']) ?></td>
              <td><?= esc($consulta['Apellido']) ?></td>
              <td><?= esc($consulta['Email']) ?></td>
              <td><?= esc($consulta['Ciudad']) ?></td>
              <td><?= esc($consulta['Pais']) ?></td>
              <td><?= esc($consulta['Comentario']) ?></td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="7" class="text-center">No hay consultas registradas.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>

  <div class="text-center mt-4">
    <a href="<?= base_url('inicio') ?>" class="btn btn-secondary">Volver al inicio</a>
  </div>
</div>

<script src="<?= base_url('assets/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
</body>
</html>
