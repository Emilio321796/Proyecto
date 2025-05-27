<div class="container mt-1 mb-1 d-flex justify-content-center">
	<div class="card" style="width: 75%;">
		<div class="card-header text-center">

          <h2>Alta de producto</h2>
		</div>
		
		<?php $validation = \config\services::validation();?>
        
        <form action="<?php echo base_url('/enviar-prod');?>" method="post" enctype="multipart/form-data">
         <div class="card-body" media="(max-width:568px)">	
         	<div class="mb-2">
         	    <label for="exampleFormControlInput1" class="form-label">Producto</label>	
         	    <input class="form-control" type="text" name="nombre_prod" value="<?php echo set_value('nombre del producto')?>">
            </div>

            <?php if ($validation->getError('nombre_prod')){?>
            <div class='alert alert-danger mt-2'>
            <?= $error = $validation->getError('nombre_prod'); ?>	
            </div>
        <?php }?>    
    </div>        

<div class="file">
	<label for="formGruopExampleInput">Precio</label>
	<input type="number" name="imagen">
</div>
<div class="file">
    <label for="formGruopExampleInput">Precio_final</label>
    <input type="" name="imagen">
</div>
<div class="file">
    <label for="formGruopExampleInput">Nombre</label>
    <input type="text-center" name="imagen">
</div>
<div class="file">
    <label for="formGruopExampleInput">Stock</label>
    <input type="" name="imagen">
</div>
<div class="file">
    <label for="formGruopExampleInput">Stock_min</label>
    <input type="" name="imagen">
</div>
<div class="file">
    <label for="formGruopExampleInput">categoria_id</label>
    <input type="" name="imagen">
</div>
<div class="form-group">
	<button type="submit" id="send_form" class="btn btn-seccess">enviar</button>
	<button type="reset" class="btn btn-danger">cancelar</button>
</div>
</form>
</div>
</div>

<div class="mb-3">
   <label>categorias</label>	
        <select class="form-control" name="categorias" id="categorias">
        	<option value="">Seleccionar Categoria</option>
        	    <?php foreach ($categorias as $categoria) { ?>
        	    	<option value="<?php echo $categoria['id'];?>">
        	    	<?php echo $categoria ['id'], ".", $categoria['descripcion'];} ?>
        	    	</option>	
        	    </div>	
        	    <?php if($validation->getError('categoria')) {?>
        	    <div class='alert alert-danger mt-2'>
        	    <?= $error = $validation->getError('categoria'); ?>	
        	    </div>	
        	    <?php }?>
   </select>
</div>



