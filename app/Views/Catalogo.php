<div class="container colorF">
    <div class="row">
        <div class="col-md-1"></div>

        <div class="col">
            <div class="row">
                <div class="col-md-12">

                    <?php if (!$producto) { ?>
                    <div class="container-fluid">
                        <div class="well">
                            <h2 class="text-center tit">"no hay productos"</h2>
                        </div>
                    </div>
                    <?php } else { ?>
                    <div class="container-fluid">
                        <div class="well">
                            <h2 class="text-center tit">Lista de Productos</h2>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Descripción</th>
                                        <th>Precio</th>
                                        <th>Cantidad</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($producto as $item) { ?>
                                    <tr>
                                        <td><?php echo $item['id']; ?></td>
                                        <td><?php echo $item['nombre']; ?></td>
                                        <td><?php echo $item['descripcion']; ?></td>
                                        <td><?php echo $item['precio']; ?></td>
                                        <td><?php echo $item['cantidad']; ?></td>
                                        <td>
                                            <a href="<?php echo base_url('productos/edit/'.$item['id']); ?>" class="btn btn-warning">Editar</a>
                                            <a href="<?php echo base_url('productos/delete/'.$item['id']); ?>" class="btn btn-danger">Eliminar</a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <?php } ?>

                </div>
            </div>
        </div>
    </div>
</div>
