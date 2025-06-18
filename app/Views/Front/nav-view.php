<?php
$session = session();
$nombre = $session->get('nombre');
$perfil = $session->get('perfil_id');
$logged = $session->get('logged_in');

    $session = session();
    $cart = \Config\Services::cart();
    $cart->contents();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>
    <!-- Bootstrap 4 CSS -->
    <link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">
    <!-- Estilos personalizados -->
    <link href="<?php echo base_url('assets/CSS/estilo.css') ?>" type="text/css" rel="stylesheet">
    <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.bundle.min.js') ?>" type="text/javascript"></script>
</head>
<body>
       
        <?php if($logged){?>
<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <?php if($perfil == 1){?>
            <div class="btn btn-info active btnUser btn-sm">
                <a href="#">Admin: <?php echo $nombre; ?></a>
            </div>
        <?php }else{?>
    <div class="d-flex justify-content-center" style="align-items: center">
                <p style="font-size: 12px"> <span style="color: blue">Cliente: <?php echo $nombre; ?></span></p>
    </div>      
        <?php }?>


            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    


        <?php if ($perfil == 1){ ?>
   

                    <li class="nav-item">
                        <a class="nav-link fs-5" href="<?php echo base_url('Crud_Usuario'); ?>">CRUD Usuarios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-5" href="<?php echo base_url('Crud_Producto'); ?>">CRUD productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-5" href="<?php echo base_url('ventas'); ?>" tabindex="-1" aria-disabled="true">Muestra Ventas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-5" href="<?php echo base_url('listar-consultas'); ?>" tabindex="-1" aria-disabled="true">Consultas</a>
                    </li>


       <?php  } else { 


    $cont = $cart->totalItems();?>

                    <li class="nav-item">
                        <a class="nav-link fs-5 active" aria-current="page" href="<?php echo base_url('inicio'); ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-5" href="<?php echo base_url('Productos'); ?>">Productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-5" href="<?php echo base_url('Carrito'); ?>">Carrito <span style="color: green"><?php echo $cont ?></span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-5" href="<?php echo base_url('post-venta'); ?>">Resumen Venta</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-5" href="<?php echo base_url('quienessomos'); ?>" tabindex="-1" aria-disabled="true">¿Quienes somos?</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-5" href="<?php echo base_url('consultas'); ?>" tabindex="-1" aria-disabled="true">Consultas</a>
                    </li>

 <?php }?>

                    <li class="nav-item">
                        <a class="nav-link fs-5" href="<?php echo base_url('Logout'); ?>" tabindex="-1" aria-disabled="true">Cerrar Sesión</a>
                    </li>

                </ul>
            </div>
    </div>
</nav>
<?php } else {?>
<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>


            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link fs-5 active" aria-current="page" href="<?php echo base_url('inicio'); ?>">Home</a>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link fs-5" href="<?php echo base_url('Productos'); ?>">Productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-5" href="<?php echo base_url('quienessomos'); ?>" tabindex="-1" aria-disabled="true">¿Quienes somos?</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-5" href="<?php echo base_url('consultas'); ?>" tabindex="-1" aria-disabled="true">Consultas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-5" href="<?php echo base_url('Login'); ?>" tabindex="-1" aria-disabled="true">Iniciar Sesion</a>
                    </li>


                </ul>
            </div>
     
     
  
    </div>
</nav>



<?php } ?>

<!-- Bootstrap 4 JavaScript -->
<!-- jQuery primero, luego Popper, luego Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
