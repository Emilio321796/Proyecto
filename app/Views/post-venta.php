
<head>
      <link rel="stylesheet" href="<?= base_url('assets/css/post-venta.css') ?>">

    
</head>


<div class="container my-5">
    <h3 class="mb-4 text-center">Historial de Ventas</h3>

    <?php if (!empty($ventas)): ?>
        <?php $totalGeneral = 0; ?>
        <div class="table-responsive">
    
            <table class="table table-bordered table-hover text-center align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>ID Venta</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Email</th>
                        <th>Fecha</th>
                        <th>Producto</th>
                        <th>Subtotal</th>
                        <th>Opcion</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($ventas as $venta): ?>
                        <?php if (!empty($venta['detalles'])): ?>
                            <?php foreach ($venta['detalles'] as $detalle): ?>
                                <?php 
                                    $subtotal = $detalle['Precio'] * $detalle['cantidad']; 
                                    $totalGeneral += $subtotal;
                                ?>
                                <tr>
                                    <td><?= $venta['id'] ?></td>
                                    <td><?= esc($venta['nombre_usuario']) ?></td>
                                    /<td><?= esc($venta['apellido_usuario']) ?></td>
                                    <td><?= esc($venta['email_usuario']) ?></td>
                                    <td><?= date('d-m-Y', strtotime($venta['fecha'])) ?></td>
                                    <td><?= esc($detalle['producto_nombre']) ?></td>
                                    <td>$<?= number_format($subtotal, 2) ?></td>
                                    <td>
                                    <a href="<?= base_url('factura/' . $venta['id']) ?>" class="btn btn-info btn-sm">Ver Detalle</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                               <td><?= $venta['id'] ?></td>
                               <td><?= esc($ventas['nombre_usuario'] ?? '---') ?></td>
                               <td><?= esc($ventas['apellido_usuario'] ?? '---') ?></td>
                               <td><?= esc($ventas['email_usuario'] ?? '---') ?></td>
                               <td><?= date('d-m-Y', strtotime($venta['fecha'])) ?></td>
                               <td colspan="2">No hay detalles para esta venta</td>
                               <td>
                                 <a href="<?= base_url('factura/' . $venta['id']) ?>" class="btn btn-info btn-sm">Ver Detalle</a>
                               </td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </tbody>
                <tfoot class="table-success">
                    <tr>
                        <th colspan="6" class="text-end">Total General:</th>
                        <th>$<?= number_format($totalGeneral, 2) ?></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    <?php else: ?>
        <div class="alert alert-warning text-center">
            No se encontraron ventas registradas.
        </div>
    <?php endif; ?>
</div>
