<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Listado de Consultas</title>
  <link href="<?= base_url('assets/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets/CSS/listado_consultas.css') ?>" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5 px-3 px-md-5">
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
      <th scope="col">Comentario</th>
      <th scope="col">Se respondió</th>
      <th scope="col">Acciones</th>
    </tr>
  </thead>
  <tbody>
    <?php if (!empty($consultas) && is_array($consultas)): ?>
      <?php foreach ($consultas as $consulta): ?>
        <tr>
          <th scope="row"><?= esc($consulta['id']) ?></th>
          <td><?= esc($consulta['Nombre']) ?></td>
          <td><?= esc($consulta['Apellido']) ?></td>
          <td><?= esc($consulta['Email']) ?></td>
          <td><?= esc($consulta['Ciudad']) ?></td>
          <td><?= esc($consulta['Comentario']) ?></td>
          <td><?= esc($consulta['respuesta']) ?></td>
          <td>
            <?php if ($consulta['respuesta'] === 'NO'): ?>
              <a href="<?= base_url('Consultas/atender_consulta/' . $consulta['id']) ?>" class="btn btn-success btn-sm">
                Atender
              </a>
            <?php else: ?>
              <a href="<?= base_url('Consultas/eliminar_consulta/' . $consulta['id']) ?>" 
                 class="btn btn-danger btn-sm" 
                 onclick="return confirm('¿Estás seguro de eliminar esta consulta?')">
                Eliminar
              </a>
            <?php endif; ?>

            
          </td>
        </tr>
      <?php endforeach; ?>
    <?php else: ?>
      <tr>
        <td colspan="8" class="text-center">No hay consultas registradas.</td>
      </tr>
    <?php endif; ?>
  </tbody>
</table>



  </div>  
</div>

<script src="<?= base_url('assets/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
</body>
</html>


