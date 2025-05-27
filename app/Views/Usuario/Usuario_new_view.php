
  <div class="mt-2">
     <table class="table table-bordered table_secundary table-hover" id="user_list">
     <thead>
       <tr>
         <th>Id</th>
         <th>Nombre</th>
         <th>Email</th>
         <th>Perfil</th>
         <th>Baja</th>
         <th>Action</th>
       </tr>  
      </thead>
      <tbody>

        <?php if($users): ?>

        	<?php foreach($users as $user):?>

        <tr>		
        	<td><?php echo $user['id_usuario'], ?></td>
        	<td><?php echo $user['nombre'], ?></td>
            <td><?php echo $user['email'], ?></td>
            <td><?php echo $user['perfil_id'], ?></td>
            <td><?php echo $user['baja'], ?></td>
            <td>
        <a href="<?php echo base_url('edit-view/' $user['id_usuario']);?>" class= "btn btn_primary btn-sm">Editar</a>
        <a href="<?php echo base_url('deletelogico/' $user['id_usuario']);?>" class= "btn btn_primary btn-sm">Borrer</a>
        <a href="<?php echo base_url('activar/' $user['id_usuario']);?>" class= "btn btn_primary btn-sm">Activar</a>
        </td>
    </tr>
    <?php endforeach; ?>
    <?php endif; ?>
    </tbody>
   </table>
  </div      



