<?php
$session = session();
$nombre = $session->get('nombre');
$perfil= $session->get('perfil_id');?>

  <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/headers/">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/album/">
  <link href="/docs/5.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

<nav class="navbar Sticky-top navbar-expand-lg navbar-dark  bk-dark">
   <div class="container-fluid">
   <a class="navbar-brand" href="#"></a>
   <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" araia-label="toggle navigation">
   <span class="navbar-toggler-icon"></span>	
   </button>
         <?php if($perfil == 1): ?>
         	<div class="btn btn-info active btnUser btn-sm">
         	<a href="">Usuario: <?php echo session('nombre'); ?> </a></div>
<div class="collapse navbar-collapse" id="navbarSupportedContent">
  <ul class="navar-nav me-auto mb-2 mb-lg-0">	
  	<li class="nav-item">
  	   <a class="nav-link active" arial-current="page" href="<?php echo base_url('prueba');?>">Home</a>	
    </li>
    <li class="nav-item">
     <a class="nav-link" href="<?php echo base_url('users-list');?>">CRUD Usurarios</a>
    </li>
    <li class="nav-item">
     <a class="nav-link" href="<?php echo base_url('Productocontroller');?>">CRUD productos</a>
    </li>
    <li class="navar-item">
     <a class="navar-link" href="<?php echo base_url('ventas');?>" tabindex="-1" aria-disable="true">Muestra Ventas</a>	
    </li>  	
    <li class="navar-item">
     <a class="navar-link" href="<?php echo base_url('listar-consultas');?>" tabindex="-1" aria-disable="true">Consultas</a>	
    </li>  	
    <li class="navar-item">
     <a class="navar-link" href="<?php echo base_url('logout');?>" tabindex="-1" aria-disable="true">Cerrar Sessión</a>
    </li>  	
   </ul> 	
  </div>
  
  <?php elseif ($perfil == 2): ?>
  	<div class="btn btn-info active btnUser btn-sm">
  	<a href="">CLIENTE: <?php echo session('nombre'); ?></a>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
  <ul class="navar-nav me-auto mb-2 mb-lg-0">	
  	<li class="nav-item">
  	   <a class="nav-link active" arial-current="page" href="<?php echo base_url('prueba');?>">Home</a>	
    </li>
    <li class="nav-item">
     <a class="nav-link" href="<?php echo base_url('Productos');?>">Productos</a>
    </li>
    <li class="nav-item">
     <a class="nav-link" href="<?php echo base_url('Comercializacion');?>">Comercializacion</a>
    </li>
    <li class="navar-item">
     <a class="navar-link" href="<?php echo base_url('¿Quienes somos?');?>" tabindex="-1" aria-disable="true">¿Quienes somos?</a>	
    </li>  	
    <li class="navar-item">
     <a class="navar-link" href="<?php echo base_url('Consultas');?>" tabindex="-1" aria-disable="true">Consultas</a>	
    </li>  	
    <li class="navar-item">
     <a class="navar-link" href="<?php echo base_url('logout');?>" tabindex="-1" aria-disable="true">Cerrar Sessión</a>
    </li>  	
   </ul> 	
  </div>		
</div>
</div>
</nav>

  


