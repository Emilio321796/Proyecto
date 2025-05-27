<?php 
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\add;
use App\models\actualizar_carrito;
use App\models\remmove;
use App\models\muestra;
use App\models\borrarCarrito;


class Carrito_controller extends BaseController{

  public function __construct()
   {
    helper(['form', 'url', 'cart']);

    $session = session();
    $cart = \Config\Services::cart();
    $cart->contents();
  }


  public function add(){
    $cart = \Config\Services::Cart();

    $request = \Config\Services::request();
    $cart->insert(array(
        'id'     => $request->getPost('id'),
        'qty'    => 1,
        'price'  => $request->getPost('precio_vta'),
        'name'   => $request->getPost('nombre_prod'),
     ));

        return redirect()->back()->withInput();
  }

  public function actualizar_carrito(){
     $cart = \Config\Services::Cart();

     $request = \Config\Services::request();
     $cart->update(array(
        'id'     => $request->getPost('id'),
        'qty'    => 1,
        'price'  => $request->getPost('precio_vta'),
        'name'   => $request->getPost('nombre_prod'),
     ));

        return redirect()->back()->withInput();
   }




  public function remove($rowid){
   
  $cart = \Config\Services::cart();
  $request = \Config\Services::request();

    if ($rowid === "all")
    {
        $cart->destroy();
    }
      else
    {
        $cart->remove($rowid);
    }
  return redirect()->back()->withInput();
  }

  public function muestra(){
    
    helper(['form', 'url', 'cart']);
    $cart = \Config\Services::cart();
    $cart = $cart->contents();

    $dato = array('titulo' => 'confirmar compra');

    $session = session();
    $nombre = $session->get('nombre');
    $perfil_id = $session->get('perfil_id');
    $email=$session->get('email');

    echo view('Views/Front/nav-view',$dato);
    echo view('Carrito/Carrito_parte_view');
    echo view('Views/Front/end-view'); 
  }

  public function borrarCarrito() {
    $cart = \Config\Services::cart();
    $cart->destroy();
    return redirect()->to('/carrito')->with('mensaje', 'Carrito borrado exitosamente');
  }

}