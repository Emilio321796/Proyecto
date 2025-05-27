<?php
namespace App\Models;
use CodeIgniter\Model;

class Producto_Model extends Model{
	protected $table = 'producto';
	protected $primaryKey = 'ID_Pro';
	protected $allowedFields = ['Precio','Precio_final','Nombre','Stock','Stock_min','img','active'];
	
  protected $useSoftDeletes   = true;

  protected $useTimestamps    = false;
  protected $deletedField     = 'active';

  public function getBuilderProductos(){
    $db = \Config\database::connect();
    $builder = $db->table('productos');
    $builder->select('*');
    $builder->join('categorias','id_categoria = productos.categoria_id');
  }
  
  public function getProductoall(){
    $builder = $this->getBuilderProductos();
    $builder->select('*','id','DESC');
    return $this->findAll();
  }
  
  public function listarProducto(){
  	$producto = new Producto_Model();
    $data['producto'] = $productoModel -> getProductoAll();
    $dato['titulo']= 'Crud_productos';
         echo view ('Front/head_view_crud', $dato);
         echo view ('Front/nav_view', $dato);
         echo view ('Productos/producto_nuevo', $data);
         echo view ('Front/end-nav');
   }

  public function crearproducto(){
  	$categoriamodel = new categoria_model();
  	$data['categorias'] = $categoriasmodel -> getcategorias();

  	$productoModel = new Producto_model();
  	$data['obj'] = $productoModel -> getProductoall();
  	$dato['titulo']= 'Alta Producto';
      echo view ('front/head_view', $dato);
      echo view ('front/nav_view');
      echo view ('Productos/alta_productos', $data);
      echo view ('Front/end-nav');
}
  
   public function store (){
        $session=session();
        $input = $this->validate([
        	'nombre_prod' => 'required[min_length[3]]',
        	'categoria'=>'is_nor_unique[categorias.id]',
        ]);

   }
  }  