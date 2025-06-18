<head>
  <style>

    body {
        background-color: #2c2f33;
        color: #f8f9fa;
        font-family: 'Segoe UI', sans-serif;
    }

    #carrito {
        margin-top: 50px;
        margin-bottom: 100px;
    }

    .cart .heading h2 {
        font-weight: bold;
        color: #ffc107;
    }

    .table-container {
        background-color: #e9ecef;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
        max-width: 1000px;
        margin: auto;
    }

    table.table {
        margin: 0;
    }

    .btn-primary, .btn-warning, .btn-danger {
        margin: 3px;
    }

    .alert-success {
        background-color: #198754;
        color: white;
        border: none;
    }
  </style>
</head>


<div class="container-fluid" id="carrito">
    <div class="cart">
        <div class="heading">
            
             <?php if (session()->getFlashdata('error_stock')): ?>
             <div class="alert alert-danger text-center"><?= session()->getFlashdata('error_stock') ?></div>
             <?php endif; ?>

        <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success text-center"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>

            <h2 id="h3" align="center">Producto en tu carrito</h2>
        </div>
        <div class="text" align="center">
            <?php
            $session = session();
            $cart = \Config\Services::cart();
            $cart = $cart->contents();
            if (empty($cart)) {
                echo 'Para agregar productos al carrito click en '; ?>
                
                    <a class="btn btn-warning text-dark mt-2" href="<?php echo base_url('/Productos') ?>">
                    <i class="fa-solid fa-circle-chevron-left"></i>
                    Catálogo
                    </a>
                      <br> 
                   
            <?php } ?>
        </div>
    </div>

    <?php if (session()->getFlashdata('mensaje')): ?>
    <div class='alert alert-success alert-dismissible fade show text-center mb-3 w-50 mx-auto' role='alert'>
        <h4 class=''><?= session()->getFlashdata('mensaje') ?></h4>
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='close'></button>
    </div>
<?php endif; ?>

    <?php if ($cart) { ?>
       <div class="table-container">
            <?php echo form_open('carrito_actualiza'); ?>
        <div class="table-responsive">
                <table class="table table-hover table-dark text-center">
                    <thead class="table-dark">
                       <tr>
                         <th>ID</th>
                         <th>Nombre del Producto</th>
                         <th>Precio</th>
                         <th>Cantidad</th>
                         <th>Total</th>
                         <th>Cancelar</th>
                       </tr>
                    </thead>
                    <tbody>
                    <?php
                    $gran_total = 0;
                    $i = 1;
                    foreach ($cart as $item) {
                        echo form_hidden('cart[' . $item['id'] . '][id]', $item['id']);
                        echo form_hidden('cart[' . $item['id'] . '][rowid]', $item['rowid']);
                        echo form_hidden('cart[' . $item['id'] . '][name]', $item['name']);
                        echo form_hidden('cart[' . $item['id'] . '][price]', $item['price']);
                        echo form_hidden('cart[' . $item['id'] . '][qty]', $item['qty']);
                        $subtotal = $item['price'] * $item['qty'];
                        $gran_total += $subtotal;
                    ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $item['name'] ?></td>
                            <td>$<?= number_format($item['price'], 2) ?></td>
                            <td>
                              <div class="d-flex justify-content-center align-items-center gap-2">
                                <!-- Botón Restar -->
                                <a href="<?= base_url('carrito/restar/' . $item['rowid']) ?>" class="btn btn-sm btn-outline-light px-2">−</a>

                                <!-- Cantidad actual -->
                                <span><?= $item['qty'] ?></span>

                                <!-- Botón Sumar -->
                                <a href="<?= base_url('carrito/sumar/' . $item['rowid']) ?>" class="btn btn-sm btn-outline-light px-2">+</a>
                              </div>
                            </td>
                            <td>$<?= number_format($subtotal, 2) ?></td>
                           <td>
                                <?php $path = '<img src=' . base_url('assets/img/carrito.jpg') . ' width="35px" height="30px">';
                                echo anchor('carrito_eliminar/' . $item['rowid'], $path); ?>
                            </td>
                        </tr>
                    <?php } ?>
                    <tr class="table-success">
                        <td colspan="4"><strong>Total</strong></td>
                        <td colspan="2"><strong>$<?= number_format($gran_total, 2) ?></strong></td>
                    </tr>
                    </tbody>
                </table>
        </div>

        <div class="text-center mt-4">
             <div class="d-flex justify-content-center gap-3">
               <?= form_open('borrar_carrito', ['class' => 'd-inline']) ?>
                  <button type="submit" class="btn btn-danger">Borrar Carrito</button>
               <?= form_close() ?>

            <form action="<?= base_url('carrito-comprar') ?>" method="post" class="d-inline">
              <button type="submit" class="btn btn-success">Comprar</button>
            </form>
              </div>
        </div>

        <?php echo form_close(); ?>
    </div>
<?php } ?>

</div>


<script>
    console.log('Carrito cargado');
</script>
