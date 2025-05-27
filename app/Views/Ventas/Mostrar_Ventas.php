<div class="container mt-5">
    <h2 class="text-center">Resumen de Ventas</h2>
    <table class="table table-hover table-bordered">
        <thead>
            <tr>
                <th>ID Venta</th>
                <th>Total Vendido</th>
                <th>Total Productos</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($ventas)): ?>
                <?php foreach ($ventas as $venta): ?>
                    <tr>
                        <td><?php echo $venta['id']; ?></td>
                        <td>$<?php echo number_format($venta['total'], 2); ?></td>
                        <td><?php echo $venta['total_productos']; ?></td>
                        <td><?php echo date('d-m-Y H:i:s', strtotime($venta['fecha'])); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" class="text-center">No hay ventas registradas</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
