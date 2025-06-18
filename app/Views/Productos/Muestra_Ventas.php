<link rel="stylesheet" href="<?= base_url('assets/CSS/muestra_ventas.css') ?>">

<div class="container my-5">
    <h2 class="text-center mb-5 text-primary">🧾 Ventas realizadas</h2>

    <?php if (session()->getFlashdata('error_stock')): ?>
        <div class="alert alert-danger text-center shadow-sm">
            <?= session()->getFlashdata('error_stock') ?>
        </div>
    <?php endif; ?>

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark text-center">
                <tr>
                    <th> ID Venta</th>
                    <th> Fecha</th>
                    <th> Usuario</th>
                    <th> Producto</th>
                    <th> Precio</th>
                    <th> Cantidad</th>
                    <th> Subtotal</th>
                    <th> Acciones</th>
                </tr>
            </thead>
            <tbody>
    <?php 
    $totalGeneral = 0;
    foreach ($ventas as $venta): 
        foreach ($venta['detalles'] as $detalle): 
            $subtotal = $detalle['Precio'] * $detalle['cantidad'];
            $totalGeneral += $subtotal;
    ?>
        <tr class="text-center">
            <td><?= $venta['id'] ?></td>
            <td><?= $venta['fecha'] ?></td>
            <td><?= $venta['Nombre'] ?></td>
            <td><?= $detalle['producto_nombre'] ?? 'Sin nombre' ?></td>
            <td>$<?= number_format($detalle['Precio'], 2) ?></td>
            <td><?= $detalle['cantidad'] ?></td>
            <td>$<?= number_format($subtotal, 2) ?></td>
            <td>
                <form action="<?= base_url('ventas/borrarDetalle/' . $detalle['id']) ?>" method="post" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este detalle?');">
                    <button type="submit" class="btn btn-outline-danger btn-sm">
                        <i class="bi bi-trash"></i> Borrar
                    </button>
                </form>
            </td>
        </tr>
    <?php 
        endforeach;
    endforeach; 
    ?>
</tbody>

            <tfoot>
                <tr class="table-secondary text-center fw-bold">
                    <td class="text-start" colspan="6">TOTAL GENERAL:</td>
                    <td class="text-start" olspan="2">$<?= number_format($totalGeneral, 2) ?></td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
