<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Producto_Model;
use App\Models\Categoria_model;



class Producto_controller extends Controller
{
    public function __construct()
    {
        helper(['url', 'form']);
    }

    public function index()
    {
        $productoModel = new Producto_model();
        $data['producto'] = $productoModel->orderBy('ID_Pro')->findAll();

        $dato['titulo'] = 'Crud_productos';
        echo view('Views/Front/nav-view', $dato);
        echo view('Views/Front/Productos', $data);
        echo view('Views/Front/end-view');
    }

    public function Crud()
    {
        $productoModel = new Producto_model();
        $categoriamodel = new Categoria_model();
        $data['productos'] = $productoModel->orderBy('ID_Pro')->withDeleted()->findAll();
        $data['categorias'] = $categoriamodel->withDeleted()->findAll();
        echo view('Views/Front/nav-view');
        echo view('Views/Productos/Crud_Producto', $data);
        echo view('Views/Front/end-view');
    }

    public function creaproducto()
    {
        $productoModel = new Producto_model();
        $data['obj'] = $productoModel->orderBy('id', 'DESC')->findAll();

        $dato['titulo'] = 'Alta Producto';
        echo view('View/Front/nav-view', $dato);
        echo view('View/head_view_curd');
        echo view('View/Productos', $data);
    }

    public function agregarCategoria(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $categoria_model     = new Categoria_model();
    
            $reglasValidacion   = $this->validate(
                [
                    "ct_nombre"         => "required|min_length[3]|max_length[50]",
                    "ct_descripcion"    => "required|max_length[200]"
                ],
                [
                    "ct_nombre"         => [
                        "required"      => 'Campo de nombre obligatorio',
                        "min_length"    => 'El campo nombre debe tener al menos 3 caracteres',
                        "max_length"    => 'El campo nombre debe tener máximo 50 caracteres'
                    ],
                    "ct_descripcion"    => [
                        "required"      => 'El campo de descripción es obligatorio',
                        "max_length"    => 'El campo de descripción debe tener máximo 200 caracteres'
                    ]
                ]
            );
            if ($reglasValidacion) {
                $datosPost              = $this->request->getPost();

                $categoria_model->save($datosPost);
                
                return redirect()->back()->with('alertaExitosa', 'categoria agregada');
            } else {
                return redirect()->back()->with('alertaExitosa', 'categoria no agregada');
            }
        }
    }

   public function editar($id = null){
    $producto = new Producto_Model();
    $categorias = new Categoria_model(); 
    $data['producto'] = $producto->find($id);
    $data['categorias'] = $categorias->withDeleted()->findAll();

    if ($data['producto'] === null) {
        // Producto no encontrado, podés redirigir o mostrar error
        return redirect()->to(base_url('Crud_Producto'))->with('error', 'Producto no encontrado.');

    } 

    echo view('Views/Front/nav-view');
    echo view('Views/Productos/Editar_Productos', $data);
    echo view('Views/Front/end-view');
    }

    

    public function cargarNuevoProducto()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $producto_model     = new Producto_Model();
            $img_nueva          = $this->request->getFile('Imagen');
            $reglasValidacion   = $this->validate(
                [
                    "Precio"         => "required",
                    "Precio_final"   => "required",
                    "Nombre"         => "required|min_length[3]",
                    "Stock"          => "required",
                    "Stock_min"      => "required",
                    "img"            => "uploaded[Imagen]|is_image[Imagen]|max_size[Imagen,4096]",
                    "categoria_id"   => "required"
                ],

                [
                    "Precio"         => [
                        "required"      => 'EL precio del producto es obligatorio',
                    ],
                    "Precio_final"         => [
                        "required"      => 'El precio final del producto es obligatorio',
                    ],
                    "Nombre"         => [
                        "required"      => 'Campo de nombre es obligatorio',
                        "min_length"    =>  'Debe ingresar mas de 3 caracteres',
                    ],
                    "Stock"             => [
                        "required"      => 'Campo de stock es obligatorio',
                    ],
                    "Stock_min"       => [
                        "required"      => 'El stock minimo es obligatorio',
                    ],
                    "img"            => [
                        "uploaded"      => 'Debe cargar una imagen',
                        "is_image"      => 'Se debe ingresar una imagen jpg/png',
                        "max_size"      => 'El máximo tamaño es de 4096',
                    ],
                    "categoria_id"       => [
                        "required"      => 'El campo de categoria es obligatorio'
                    ]
                ]
            );
            if ($reglasValidacion) {
                $datosPost              = $this->request->getPost();
                $nombre_img             = $img_nueva->getRandomName();
                $datosPost['img'] = $nombre_img;
                $producto_model->save($datosPost);
                $img_nueva->move(ROOTPATH . 'assets\upload/', $nombre_img);

                return redirect()->back()->with('alertaExitosa', 'Producto agregado exitosamente!');
            } else {
                return redirect()->back()->with('alertaExitosa', 'Producto no agregado!');
            }
        }
    }


    // Borrar producto
    public function borrarProducto($id = null)
    {
        // Verifica si el ID es válido
        if (!is_numeric($id)) {
            return redirect()->back()->with('alertaError', 'ID de producto inválido.');
        }

        // Intenta borrar el producto de manera lógica
        $productos = new Producto_Model();
        // Verifica si el producto existe antes de intentar borrarlo
        $producto = $productos->find($id);
        if ($producto) {
            if ($productos->delete($id)) {
                // Redirecciona a la tabla de productos con mensaje de éxito
                return redirect()->back()->with('alertaExitosa', 'Producto eliminado con éxito!');
            } else {
                // Si la eliminación falla, envía un mensaje de error
                return redirect()->back()->with('alertaError', 'Error al eliminar el producto.');
            }
        } else {
            // Si el producto no existe, envía un mensaje de error
            return redirect()->back()->with('alertaError', 'Producto no encontrado.');
        }
    }



    // Se da de alta el producto eliminado lógicamente
    public function darAltaProducto($id = null)
    {
        $productos = new Producto_Model();
        $productos->update($id, ["active" => NULL]);
        return redirect()->back()->with('alertaExitosa', 'Producto Dado de Alta con Exito!');
    }

    public function deleteproducto($id)
    {
        $productoModel = new producto_Model();
        $data['eliminado'] = $productoModel->where('id', $id->first());
        $data['eliminado'] = 'SI';
        $productoModel->update($id, $data);
        return $this->response->redirect(site_url('crear'));
    }

    public function eliminado()
    {
        $productoModel = new producto_Model();
        $data['producto'] = $productoModel->getProductoAll();
        $dato['titulo'] = 'Crud_producto';
        echo view('nav-view', $dato);
        echo view('');
        echo view('end-view');
    }

    public function actualizarProducto()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $producto_model     = new Producto_Model();
            $img_nueva          = $this->request->getFile('Imagen');
            $reglasValidacion   = $this->validate(
                [
                    "Precio"         => "permit_empty",
                    "Precio_final"   => "permit_empty",
                    "Nombre"         => "permit_empty|min_length[3]",
                    "Stock"          => "permit_empty",
                    "Stock_min"      => "permit_empty",
                    "img"            => "uploaded[Imagen]|is_image[Imagen]|max_size[Imagen,4096]",
                    "categoria_id"   => "permit_empty"
                ],

                [
                    "Precio"         => [
                        "permit_empty"      => 'EL precio del producto es obligatorio',
                    ],
                    "Precio_final"         => [
                        "permit_empty"      => 'El precio final del producto es obligatorio',
                    ],
                    "Nombre"         => [
                        "permit_empty"      => 'Campo de nombre es obligatorio',
                        "min_length"    =>  'Debe ingresar mas de 3 caracteres',
                    ],
                    "Stock"             => [
                        "permit_empty"      => 'Campo de stock es obligatorio',
                    ],
                    "Stock_min"       => [
                        "permit_empty"      => 'El stock minimo es obligatorio',
                    ],
                    "img"            => [
                        "uploaded"      => 'Debe cargar una imagen',
                        "is_image"      => 'Se debe ingresar una imagen jpg/png',
                        "max_size"      => 'El máximo tamaño es de 4096',
                    ],
                    "categoria_id"       => [
                        "permit_empty"      => 'El campo de categoria es obligatorio'
                    ]
                ]
            );
            if ($reglasValidacion) {
                $datosPost              = $this->request->getPost();
                $nombre_img             = $img_nueva->getRandomName();
                $datosPost['img'] = $nombre_img;
                $producto_model->update($this->request->getVar('ID_Pro'), $datosPost);
                $img_nueva->move(ROOTPATH . 'assets\upload/', $nombre_img);

                return redirect()->back()->with('alertaExitosa', 'Producto editado');
            } else {
                return redirect()->back()->with('alertaExitosa', 'Producto no editado');
            }
        }
    }

    
























    /*
     public function store (){
     	$input = $this->validate([
         'Precio' => 'required',
         'Precio_final' => 'is_not_unique[categorias.id]',
         'Nombre' => 'required|min_length[2]',
         'Stock' => 'required',
         'Stock_min' => 'required',
        ]);
     
     $productoModel = new Producto_model();

     if (!$input){
     	   $dato ['titulo']= 'Alta';
     	   echo view ('front/head_view',$dato);
     	   echo view ('front/nav_view');
     	   echo view ('back/producto/producto_nuevo_view',['validation' => $this->validator]);  
     	
     	} else {
              
           $img = $this->request->getFile('imagen');
           $nombre_aleatorio = $img -> getRandomName();
           $img->move(rootpath.'assets/img', $nombre_aleatorio);

           $data = [
           	     'nombre_prod' => $this->request->getVar('nombre_prod'),
                 'imagen' => $img->getName(),
                 'categoria_id' => $this->request->getVar('categoria'),
                 'precio' => $this->request->getVar('precio'),
                 'precio_vta' => $this->request->getVar('precio_vta'),
                 'stock => $this->request->getVar('stock'),
                 'stock_min => $this->request->getVar('stock_min'),






           ]
         $producto = new Producto_Model();
         $producto->insert($data);

         return $this->response->redirect(site_url('crear'));
     }


   }
   */
}
