<section>
<?php
    if (session()->getFlashdata('alertaExitosa')) {
        echo
        '<p class="alert text-center mt-4 col-lg-8 col-md-8 col-sm-8 mx-auto w-50 h4" role="alert">
                                 
                                        ' . session()->getFlashdata('alertaExitosa') . '
                                    </p>';
    }
    ?>


<head>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container-custom {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        h2 {
            color: #343a40;
            margin-bottom: 20px;
            text-align: center;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            font-weight: bold;
            color: #495057;
            display: block;
            margin-bottom: 5px;
        }
        .form-group input,
        .form-group select {
            width: 100%;
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #ced4da;
            box-sizing: border-box;
        }
        .form-group input[type="file"] {
            padding: 3px;
        }
        .btn-group {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
        }
        .btn {
            padding: 10px 20px;
            border-radius: 4px;
        }
        .table img {
            height: 50px;
            width: 50px;
            object-fit: contain;
            overflow: hidden;
        }
    </style>
</head>
<body>
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="container-custom col-md-12">
                <h2>Editar producto</h2>
                <?php $validation = \Config\Services::validation(); ?>
                <form class="form" action="<?php echo base_url('/editar-prod'); ?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="Precio">Precio</label>
                        <input type="number" name="Precio" id="Precio" class="form-control" value="<?= $producto['Precio'] ?? '' ?>">
                    </div>
                    <div class="form-group">
                        <label for="Precio_final">Precio Final</label>
                        <input type="number" name="Precio_final" id="Precio_final" class="form-control" value="<?php echo $producto['Precio_final'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="Nombre">Nombre</label>
                        <input type="text" name="Nombre" id="Nombre" class="form-control" value="<?php echo $producto['Nombre'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="Stock">Stock</label>
                        <input type="number" name="Stock" id="Stock" class="form-control" value="<?php echo $producto['Stock'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="Stock_min">Stock Mínimo</label>
                        <input type="number" name="Stock_min" id="Stock_min" class="form-control" value="<?php echo $producto['Stock_min'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Imagen anterior</label>
                        <img src="<?php echo base_url('assets/upload/') . $producto['img'] ?>" class="d-block w-100" alt="Imagen anterior del producto">
                    </div>
                    <div class="form-group">
                        <label for="Imagen">Agregue una imagen</label>
                        <input type="file" name="Imagen" id="Imagen" class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="categoria_id">Categorías</label>
                        <select class="form-control" name="categoria_id" id="categoria_id">
                            <option value="">Seleccionar Categoría</option>
                            <?php foreach ($categorias as $categoria) {
                                if ($categoria['activacion'] != 1) { ?>
                                    <option value="<?php echo $categoria['id_categoria'] ?>"><?php echo $categoria['ct_nombre'] ?></option>
                            <?php }
                            } ?>
                        </select>
                        <input type="hidden" name="ID_Pro" id="ID_Pro" value="<?php echo $producto['ID_Pro'] ?>">
                    </div>
                    <div class="btn-group">
                        <button type="submit" id="send_form" class="btn btn-success">Enviar</button>
                        <a href="<?= base_url('Crud_Producto') ?>" class="btn btn-danger">Cancelar</a>                    
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-SqaqClZSKg4oJ/pPim91H7+KEi5K9E/2y/nQvIuwEOB5N0xFwMmkT2R/hsJFv3KD" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-XE+CnWGL4Ev6VxK/8L+XK5+gD+YRM2CvdXkqZoELmHzSkrL+HCtkbE+g/3k4zG2z" crossorigin="anonymous"></script>
</body>

