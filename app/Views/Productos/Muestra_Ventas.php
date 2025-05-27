     <h3>Lista de productos</h3>
                                <br>
                                <div class="table-responsive">
                                    <table class="table" id="TablaProd">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th scope="col">Producto</th>
                                                <th scope="col">Precio</th>
                                                <th scope="col">Cantidad</th>
                                                <th scope="col">Acciones</th>


                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($productos as $producto) {
                                                $_id = $producto['pd_id'];
                                                $nombre = $producto['nombre'];
                                                $precio = $producto['precio'];
                                            ?>

                                                <tr>

                                                    <td>
                                                        <img src="    <?php if (empty($producto["pd_img"])) {

                                                                            // Asegúrate de que la ruta sea correcta y accesible desde el navegador
                                                                            echo base_url('assets/img/descarga.png'); // Usa barras normales
                                                                        } else {
                                                                            echo base_url('assets/img/catalogo/' . $producto['pd_img']);
                                                                        } ?>" class="d-block w-100" style="height:50px ; width: 50px; object-fit: contain; overflow: hidden;" />

                                                    </td>

                                                    <td>
                                                        <?php echo $nombre; ?>
                                                    </td>

                                                    <td>

                                                        <?php echo $producto['cantidad'] ?>
                                                    </td>


                                                    <td>
                                                        <!-- Botón Editar -->
                                                        <div class="btn-group">

                                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editarModal" data-producto-id="<?= $producto['pd_id'] ?>" data-producto-nombre="<?= $producto['pd_nombre'] ?>" data-producto-descripcion="<?= $producto['pd_descripcion'] ?>" data-producto-precio="<?= $producto['pd_precio'] ?>" data-producto-descuento="<?= $producto['pd_descuento'] ?>" data-producto-cantidad="<?= $producto['pd_cantidad'] ?>" data-producto-categoria="<?= $producto['ct_id'] ?>">
                                                                Editar
                                                            </button>
                                                            <?php if ($producto['pd_activo'] == 1) { ?>
                                                                <a type="button" class="btn btn-success" href="<?php echo base_url('administrador/darAltaProducto/' . $_id); ?>" value="<?php echo $_id ?>">
                                                                    Activar
                                                                </a>

                                                            <?php } else { ?>
                                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#eliminaModal" data-producto-id="<?= $producto['pd_id'] ?>">
                                                                    Eliminar
                                                                </button>
                                                        </div>


                                                        <!-- Modal Editar -->
                                                        <div class="modal fade" id="editarModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editarModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-md">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h1 class="modal-title fs-5" id="editarModalLabel">Editar Producto</h1>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form method="post" action="<?php echo base_url('administrador/actualizarProducto') ?>" enctype="multipart/form-data">
                                                                            <div class="form mb-3">
                                                                                <input type="text" class="form-control" name="pd_nombre" id="pd_nombre" placeholder="Nombre del Producto">
                                                                            </div>
                                                                            <div class="form mb-3">
                                                                                <input type="text" class="form-control" name="pd_descripcion" id="pd_descripcion" placeholder="Descripcion del Producto">
                                                                            </div>
                                                                            <div class="container p-0">
                                                                                <div class="row">
                                                                                    <div class="col">
                                                                                        <div class="form mb-3">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col">
                                                                                        <div class="form mb-3">                                           
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form mb-3">
                                                                                <select class="form-control me-4 mb-2 flex-fill" name="ct_id" id="ct_id">
                                                                                    <option value="">Seleccionar Categoría</option>
                                                                                    <?php foreach ($categorias as $categoria) : ?>
                                                                                        <option value="<?= $categoria['id'] ?>"><?= $categoria['ct_nombre'] ?></option>
                                                                                    <?php endforeach; ?>
                                                                                </select>
                                                                            </div>
                                                                            <div class="container p-0">
                                                                                <div class="row">
                                                                                    <div class="col">
                                                                                        <div class="form mb-3">
                                                                                            
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col">
                                                                                        <div class="form mb-3">
                                                                                            
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                                                <input type="hidden" id="pd_id" name="pd_id">
                                                                                <div class="d-flex justify-content-center">
                                                                                    <button type='submit' class='btn text-title btn-warning'>
                                                                                        Editar
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>




                                                        <div class="modal fade" id="eliminaModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="eliminaModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-sm">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h1 class="modal-title fs-5" id="eliminaModalLabel">Alerta</h1>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        ¿Desea eliminar el artículo?
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>

                                                                        <form method="get" action="<?php base_url("administrador/borrarProducto/") ?>">
                                                                            <input type="hidden" id="pd_id" name="pd_id" value="<?php echo $producto['pd_id']; ?>">
                                                                            <div class="d-flex justify-content-center">
                                                                                <button type='submit' class='btn text-title btn-danger'>
                                                                                    <svg width="24" height="24" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">                                                
                                                                                    </svg>
                                                                                    Eliminar
                                                                                </button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php } ?>



                                                    </td>
                                                </tr>
                                            <?php
                                            } ?>

                                        </tbody>

                                    </table>

                                </div>

                            </div>
                        </div>