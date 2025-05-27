<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
   <link href="assets/CSS/lista_usuarios.css" rel = "stylesheet">
</head>
<body>

<div class="container">
    <div class="custom-card">
        <h1><i class="fas fa-users"></i> Lista de Usuarios</h1>

        <?php if (session()->getFlashdata('mensaje')): ?>
            <div class="alert alert-success text-center"><?= session()->getFlashdata('mensaje') ?></div>
        <?php endif; ?>

        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle text-center">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Email</th>
                        <th>Usuario</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($usuarios as $usuario) : ?>
                        <tr>
                            <td><?= esc($usuario['id_usuario']) ?></td>
                            <td><?= esc($usuario['Nombre']) ?></td>
                            <td><?= esc($usuario['Apellido']) ?></td>
                            <td><?= esc($usuario['Email']) ?></td>
                            <td><?= esc($usuario['Usuario']) ?></td>
                            <td>
                                <a href="editUsuario/<?= $usuario['id_usuario'] ?>" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Editar
                                </a>
                                <?php if ($usuario['baja'] == "NO") { ?>
                                    <a href="borrarUsuario/<?= $usuario['id_usuario'] ?>" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash-alt"></i> Eliminar
                                    </a>
                                <?php } else { ?>
                                    <a href="darAltaUsuario/<?= $usuario['id_usuario'] ?>" class="btn btn-success btn-sm">
                                        <i class="fas fa-user-check"></i> Dar de alta
                                    </a>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
