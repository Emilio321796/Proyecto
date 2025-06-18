<head>
    <link rel="stylesheet" href="<?= base_url('assets/css/crud_producto.css') ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    
</head>


<section class="container mt-5 mb-5">
    <?php if (session()->getFlashdata('alertaExitosa')) : ?>
        <div class="alert alert-success text-center col-lg-8 mx-auto">
            <?= session()->getFlashdata('alertaExitosa') ?>
        </div>
    <?php endif; ?>

    <div class="row g-4">
        <!-- Alta de Producto -->
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h4 class="card-title mb-4 text-center">📦 Alta de Producto</h4>
                    <form action="<?= base_url('/enviar-prod'); ?>" method="POST" enctype="multipart/form-data">
                        <?php $validation = \Config\Services::validation(); ?>
                        <?php foreach (['Precio', 'Precio_final', 'Nombre', 'Stock', 'Stock_min'] as $campo): ?>
                            <div class="mb-3">
                                <label for="<?= $campo ?>" class="form-label"><?= str_replace('_', ' ', $campo) ?></label>
                                <input type="<?= is_numeric($campo) ? 'number' : 'text' ?>" name="<?= $campo ?>" id="<?= $campo ?>" class="form-control">
                            </div>
                        <?php endforeach; ?>

                        <div class="mb-3">
                            <label for="Imagen" class="form-label">Imagen</label>
                            <input type="file" name="Imagen" id="Imagen" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="categoria_id" class="form-label">Categoría</label>
                            <select class="form-select" name="categoria_id" id="categoria_id">
                                <option value="">Seleccionar Categoría</option>
                                <?php foreach ($categorias as $categoria): ?>
                                    <?php if ($categoria['activacion'] != 1): ?>
                                        <option value="<?= $categoria['id_categoria'] ?>"><?= $categoria['ct_nombre'] ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-success"><i class="bi bi-check-circle"></i> Enviar</button>
                            <button type="reset" class="btn btn-secondary"><i class="bi bi-x-circle"></i> Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Añadir Categoría -->
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h4 class="card-title mb-4 text-center"> Añadir Categoría</h4>
                    <form action="<?= base_url('/enviar-cat'); ?>" method="POST">
                        <div class="mb-3">
                            <label for="ct_nombre" class="form-label">Nombre</label>
                            <input type="text" name="ct_nombre" id="ct_nombre" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="ct_descripcion" class="form-label">Descripción</label>
                            <input type="text" name="ct_descripcion" id="ct_descripcion" class="form-control">
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-success"><i class="bi bi-check-circle"></i> Enviar</button>
                            <button type="reset" class="btn btn-secondary"><i class="bi bi-x-circle"></i> Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Lista de productos -->
<div class="mt-5 card shadow-sm">
    <div class="card-body">
        <h4 class="card-title mb-3 text-center">📝 Lista de productos</h4>

        <!-- 🔁 Botón Reiniciar Stock -->
        <div class="mb-3 text-end">
              <form action="<?= base_url('ventas/reiniciarStock') ?>" method="post" onsubmit="return confirm('¿Estás seguro que deseas reiniciar el stock de todos los productos?');">
                <button type="submit" class="btn btn-warning">Reiniciar Stock</button>
              </form>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle text-center">
                <thead class="table-dark">
                    <tr>
                        <th>Imagen</th>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($productos as $producto): ?>
                        <tr>
                            <td>
                                <img src="<?= base_url('assets/upload/' . $producto['img']); ?>" alt="Imagen" style="height: 50px; width: 50px; object-fit: contain;">
                            </td>
                            <td><?= esc($producto['Nombre']) ?></td>
                            <td>$<?= number_format($producto['Precio_final'], 2) ?></td>
                            <td><?= esc($producto['Stock']) ?></td>
                            <td>
                                <div class="btn-group">
                                    <!-- Botón editar -->
                                    <a href="<?= base_url('editarProd/' . $producto['ID_Pro']) ?>" class="btn btn-warning btn-sm" role="button" title="Editar">
                                       <i class="bi bi-pencil-square"></i>
                                    </a>


                                    <!-- Botón de alta/baja -->
                                    <?php if ($producto['active'] == 1): ?>
                                        <a class="btn btn-success btn-sm" href="<?= base_url('darAltaProducto/' . $producto['ID_Pro']) ?>" title="Activo">
                                            <i class="bi bi-toggle-on"></i>
                                        </a>
                                    <?php else: ?>
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#eliminaModal" data-producto-id="<?= $producto['ID_Pro'] ?>" title="Eliminar">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


    

    <!-- Modal Eliminar -->
    <div class="modal fade" id="eliminaModal" tabindex="-1" aria-labelledby="eliminaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Eliminar Producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center">
                    ¿Desea eliminar el producto?
                </div>
                <div class="modal-footer justify-content-center">
                    <form method="get">
                        <input type="hidden" id="ID_Pro" name="ID_Pro">
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    const eliminaModal = document.getElementById('eliminaModal');
    eliminaModal.addEventListener('show.bs.modal', function(event) {
        const button = event.relatedTarget;
        const productoId = button.getAttribute('data-producto-id');
        const form = eliminaModal.querySelector('form');
        form.action = `<?= base_url('borrarProducto/') ?>${productoId}`;
        form.querySelector('#ID_Pro').value = productoId;
    });
</script>
