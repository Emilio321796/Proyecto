<div class="container my-5">
    <h3 class="mb-4 text-center">Historial de Ventas</h3>

    <?php if (!empty($ventas)): ?>
        <?php $totalGeneral = 0; ?>
        <div class="table-responsive">
            <table class="table table-bordered table-hover text-center align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>ID Venta</th>
                        <th>Fecha</th>
                        <th>Producto</th>
                        <th>Precio Unitario</th>
                        <th>Cantidad</th>
                        <th>Subtotal</th>
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
                                    <td><?= date('d-m-Y', strtotime($venta['fecha'])) ?></td>
                                    <td><?= esc($detalle['producto_nombre']) ?></td>
                                    <td>$<?= number_format($detalle['Precio'], 2) ?></td>
                                    <td><?= $detalle['cantidad'] ?></td>
                                    <td>$<?= number_format($subtotal, 2) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td><?= $venta['id'] ?></td>
                                <td><?= date('d-m-Y', strtotime($venta['fecha'])) ?></td>
                                <td colspan="4">No hay detalles para esta venta</td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </tbody>
                <tfoot class="table-success">
                    <tr>
                        <th colspan="5" class="text-end">Total General:</th>
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
