<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Factura de Compra</title>
    <link href="<?= base_url('assets/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container my-5">
    <div class="card shadow">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0 text-center">Factura de Compra</h4>
        </div>
        <div class="card-body">
            <p><strong>Fecha:</strong> <?= esc($venta['fecha']) ?></p>
            <p><strong>ID Venta:</strong> <?= esc($venta['id']) ?></p>
            <p><strong>Usuario:</strong> <?= esc($venta['nombre_usuario']) ?></p>

            <div class="table-responsive mt-4">
                <table class="table table-bordered table-hover text-center align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio Unitario</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                   <tbody>
                        <?php foreach ($detalle as $item): ?>
                        <tr>
                                <td><?= esc($item['Nombre']) ?></td>
                                <td><?= esc($item['cantidad']) ?></td>
                                <td>$<?= number_format($item['Precio'], 2, ',', '.') ?></td>
                                <td>$<?= number_format($item['Precio'] * $item['cantidad'], 2, ',', '.') ?></td>
                        </tr>
                    <?php endforeach; ?>

                        <tr>
                            <td colspan="4" style="background-color: transparent; height: 10px; border: none;"></td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="3" class="text-end">TOTAL</th>
                            <th>$<?= number_format($total, 2, ',', '.') ?></th>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="text-center mt-4">
                <a href="<?= base_url('/Productos') ?>" class="btn btn-primary">Seguir Comprando</a>
                <a href="<?= base_url('/post-venta') ?>" class="btn btn-secondary">Ver Historial</a>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url('assets/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
</body>
</html>
