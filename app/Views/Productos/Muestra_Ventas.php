<link rel="stylesheet" href="<?= base_url('assets/CSS/muestra_ventas.css') ?>">

<div class="container my-5">
    <h2 class="text-center mb-5 text-primary">🧾 Ventas realizadas</h2>

    <?php if (session()->getFlashdata('error_stock')): ?>
        <div class="alert alert-danger text-center shadow-sm">
            <?= session()->getFlashdata('error_stock') ?>
        </div>
    <?php endif; ?>

    <?php foreach ($ventas as $venta): ?>
        <div class="card mb-4 border-0 shadow-sm rounded-4">
            <div class="card-header bg-gradient bg-primary text-white rounded-top-4">
                <div class="d-flex justify-content-between align-items-center">
                    <span><strong>🆔 Venta:</strong> <?= $venta['id'] ?></span>
                    <span><strong>🕒 Fecha:</strong> <?= $venta['fecha'] ?></span>
                    <span><strong>💰 Total:</strong> $<?= number_format($venta['total_venta'], 2) ?></span>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover mb-0 align-middle">
                        <thead class="table-light text-center">
                            <tr>
                                <th>📦 Producto</th>
                                <th>💲 Precio</th>
                                <th>🔢 Cantidad</th>
                                <th>⚙️ Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($venta['detalles'] as $detalle): ?>
                                <tr class="text-center">
                                    <td><?= $detalle['producto_nombre'] ?? 'Sin nombre' ?></td>
                                    <td>$<?= number_format($detalle['Precio'], 2) ?></td>
                                    <td><?= $detalle['cantidad'] ?></td>
                                    <td>
                                        <form action="<?= base_url('ventas/borrarDetalle/' . $detalle['id']) ?>" method="post" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este detalle?');">
                <button type="submit" class="btn btn-outline-danger btn-sm">
                    <i class="bi bi-trash"></i> Borrar
                </button>
            </form>
                                        <!-- Puedes agregar más acciones aquí -->
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
