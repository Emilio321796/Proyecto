<div>
	<?php if (session()->getFlashdata('success')){
		echo "<div class='mt-3 mb-3 ms-3 me-3 h4 text-center alert alert-success alert-dismissible'>
		<button type='button' class='bnt-close' data-bs-dismiss='alert'></button>" . session()->getFlashdata('success') ."
		</div>";
	} ?>

	<div>
		<div class="d-flex justify-content-end">
			<a href="<?php echo site_url('/produ-form')?>" class="btn btn-success btn-sm mt-1">Agregar</a>
			<a href="<?php echo site_url('/Eliminados')?>" class="btn btn-success btn-sm mt-1">Eliminados</a>
		</div>
	
	<div class="mt-3">
	  <div class="table-resposive">
	  	<table class="table table-success table-striped" id="users-list">
	  		<thead>
	  			<tr>
	  				<th>ID</th>
	  				<th>Producto</th>
	  				<th>Precio</th>
	  				<th>Precio-venta</th>
	  				<th>Stock</th>
	  				<th>Imagen</th>
	  				<th>Accion</th>
	  			</tr>
	  		</thead>
		<tbody>
			<?php if($producto): ?>

				<?php foreach($producto as $prod): ?>
					<?php $eliminado = $prod['eliminado'];?>
					   <?php if ($eliminado == 'NO'):?>

				 <tr>
				 <td><?php echo $prod['id'];?></td>
                 <td><?php echo $prod['nombre_prod'];?></td>
                 <td><?php echo $prod['precio'];?></td>
                 <td><?php echo $prod['precio_venta'];?></td>
                 <td><?php echo $prod['stock'];?></td>
                 <?php $imagen=$prod ['imagen']; ?>
                 <?php $id = $prod['id'];?>

                    <td><img height="70px" width="85px" src="<?=base_url()?>/assets/uploads/<?=$imagen?>"></td>     
                      <td>
              	      <a href="<?php echo base_url('editar/'.$id);?>" class="btn btn-primary btn-sm mt-1">Editar</a>
              	      <a href="<?php echo base_url('borrar/'.$id);?>" class="btn btn-primary btn-sm mt-1">Borrar</a>
                    </td>
                </tr>
            
               <?php endif; ?>
              <?php endforeach; ?>
             <?php endif; ?>
        </tbody>
        </table>
	</div>	
   </div>
  </div>
 </div>