<div class="container my-5">
    <div class="alert alert-success text-center shadow-sm">
        <p class="mb-1">Tu pedido ha sido procesado correctamente.</p>
    </div>


    <div class="card shadow-sm rounded-4 border-0">
        <div class="card-header bg-primary text-white rounded-top-4">
            <div class="d-flex justify-content-between align-items-center">
                <span><strong>ID Venta:</strong> <?= $venta['id'] ?></span>
                <span><strong>Fecha:</strong> <?= date('d-m-Y ', strtotime($venta['fecha'])) ?></span>
                <span><strong>Total:</strong> $<?= number_format($venta['total_venta'], 2) ?></span>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered table-hover mb-0 text-center align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Producto</th>
                            <th>Precio Unitario</th>
                            <th>Cantidad</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($detalles)): ?>
                            <?php $ultimoDetalle = end($detalles); ?>
                    <tbody>
                        <tr>
                            <td><?= esc($ultimoDetalle['producto_nombre']) ?></td>
                            <td>$<?= number_format($ultimoDetalle['Precio'], 2) ?></td>
                            <td><?= $ultimoDetalle['cantidad'] ?></td>
                            <td>$<?= number_format($ultimoDetalle['Precio'] * $ultimoDetalle['cantidad'], 2) ?></td>
                        </tr>
                    </tbody>
                        <?php else: ?>
                    <tbody>
                        <tr>
                            <td colspan="4">No hay detalles para mostrar.</td>
                        </tr>
                    </tbody>
                        <?php endif; ?>
               
                    <tfoot class="table-success">
                        <tr>
                            <th colspan="3" class="text-end">Total Pagado</th>
                            <th>$<?= number_format($venta['total_venta'], 2) ?></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <div class="text-center mt-4">
       <a href="<?= base_url('/post-venta/' . $venta['id']) ?>" class="btn btn-success">Ver resumen</a>
       <a href="<?= base_url('factura/' . $venta['id']) ?>" class="btn btn-success">Descargar Factura</a>

    </div>
</div>
