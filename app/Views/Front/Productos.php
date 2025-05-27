<script type="text/javascript" src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
  
<link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="assets/CSS/body.css" rel = "stylesheet">
    <link href="assets/CSS/carrusel.css" rel = "stylesheet">
    <link href="assets/CSS/card.css" rel = "stylesheet">
    <link href="assets/CSS/end-nav.css" rel = "stylesheet">
    
    <style>
  body {
    background-color: #000 !important;
    color: #fff;
  }

.card2 {
  width: 100%;                /* Que no ocupe el 100% del contenedor */
  max-width: 320px;          /* Máximo ancho en pantallas grandes */
  padding: 1rem;
  margin: 20px auto;
  border-radius: 20px;
  background-color: #000000d5;
  color: #c5ac8e;
  border: none;
  overflow: hidden;
  box-shadow:
    0 0 10px #FF4081,
    0 0 15px #FF4081,
    0 0 20px #FF4081,
    0 0 25px #FF4081;
}

/* Mejora para pantallas menores a 480px (como Pixel 7) */
@media (max-width: 480px) {
  .card2 {
    width: 85%;              /* Aún más margen en pantallas chicas */
  }
}

 .card-img {
  width: 100%;
  height: auto; /* Mantiene la proporción original de la imagen */
  border-radius: 20px; /* Redondea los bordes de la imagen */
  object-fit: cover;   /* Cubre el contenedor sin deformarse */
}


</style>
  

 <body>
    <div class="container">
        <div class="section-cards">
            <div class="row justify-content-center">
                <div class="col-sm-12 col-md-10"> <div class="row row-cols-1 row-cols-sm-2 g-4">

                        <?php 
                        // Verifica si la variable $producto existe y no está vacía
                        if(isset($producto) && !empty($producto)){
                            // Itera sobre cada producto
                            foreach ($producto as $prod) {
                                
                                $imagen_src = ''; // Inicializamos la variable para la URL de la imagen

                                // Si el campo 'img' del producto no está vacío en la DB
                                if (!empty($prod['img'])){
                                    // Construye la URL completa de la imagen usando base_url()
                                    // Asume que $prod['img'] contiene solo el nombre del archivo (ej. '1747421465_64b132b7279c9c787826.jpg')
                                    $imagen_src = base_url('assets/upload/' . $prod['img']); 
                                } else {
                                    // Si no hay imagen específica, usa la imagen por defecto
                                    $imagen_src = base_url('assets/img/CE.jpg'); // Ajusta la ruta si es necesario
                                }
                        ?>
                              <div class="col">
                                 <div class="card2">
                                     <img class="card-img" src="<?php echo $imagen_src; ?>" alt="Imagen de <?php echo $prod['Nombre'] ?? 'producto'; ?>">
                                        <div class="card-body">
                                         <p class="text-capitalize text-center"><?php echo $prod['Nombre'] ?? 'Nombre del Producto'; ?></p>

                                            <?php if(session()->get('id_Perfil') === '2'): ?>
                                            <div class="group d-flex justify-content-center">
                                              <?php
                                              echo form_open('carrito_agrega');
                                              echo form_hidden('id', $prod['ID_Pro'] ?? '');
                                              echo form_hidden('precio_vta', $prod['Precio_final'] ?? '');
                                              echo form_hidden('nombre_prod', $prod['Nombre'] ?? '');
                                              ?>
                                            <div>
                                            <?php
                                                $btn = array(
                                                 'class' => 'btn btn-secondary fuenteBotones',
                                                 'value' => 'agregar al carrito',
                                                 'name'  => 'action'
                                                );
                                                  echo form_submit($btn);
                                                  echo form_close();
                                            ?>
                                            </div>
                                            </div>
                                         <?php endif; ?>
            
                                        </div>
                                  </div>
                              </div>

                                <?php
                            } // Cierre del foreach ($producto as $prod)
                        } // Cierre del if(isset($producto) && !empty($producto))
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

