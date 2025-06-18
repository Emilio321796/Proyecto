<?php 
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\add;
use App\models\actualizar_carrito;
use App\models\remmove;
use App\models\muestra;
use App\models\borrarCarrito;
use App\models\sumar;
use App\models\restar;
use App\models\comprar;

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
    return redirect()->to('/carrito')->with('carrito_vacio', 'Carrito borrado exitosamente');
  }

  public function sumar($rowid)
{
    $cart = \Config\Services::cart();
    $item = $cart->getItem($rowid);

    if ($item) {
        $cart->update([
            'rowid' => $rowid,
            'qty'   => $item['qty'] + 1
        ]);
    }

    return redirect()->back();
}

public function restar($rowid)
{
    $cart = \Config\Services::cart();
    $item = $cart->getItem($rowid);

    if ($item && $item['qty'] > 1) {
        $cart->update([
            'rowid' => $rowid,
            'qty'   => $item['qty'] - 1
        ]);
    } elseif ($item) {
        $cart->remove($rowid);
    }

    return redirect()->back();
}

public function comprar()
{
    $cart = \Config\Services::cart();
    $cartItems = $cart->contents();

    if (empty($cartItems)) {
        return redirect()->to('/carrito')->with('mensaje', 'El carrito está vacío');
    }
    
    

    // Cargar modelos
    $ventasCabeceraModel = new \App\Models\Ventas_cabecera_model();
    $ventasDetalleModel = new \App\Models\Ventas_detalle_model();

    // Obtener datos de sesión del usuario
    $session = session();
    $cliente = $session->get('nombre') ?? 'Invitado';

    // Calcular total
    $total = 0;
    foreach ($cartItems as $item) {
        $total += $item['price'] * $item['qty'];
    }

    // Guardar cabecera
    $cabeceraData = [
        'fecha'       => date('Y-m-d H:i:s'),
        'usuario_id'  => $session->get('id_usuario'),
        'total_venta' => $total
    ];
    $ventasCabeceraModel->insert($cabeceraData);
    $ventaId = $ventasCabeceraModel->insertID();

    // Guardar detalles
    foreach ($cartItems as $item) {
        $detalleData = [
            'venta_id' => $ventaId,
            'producto_id' => $item['id'],
            'cantidad' => $item['qty'],
            'Precio'   => $item['price'],
            'subtotal' => $item['price'] * $item['qty']
        ];
        $ventasDetalleModel->insert($detalleData);
    }

    // Vaciar el carrito
    $cart->destroy();
     
     
    return redirect()->to(site_url("Ventas/factura/$ventaId"));
   }

    public function resumenCompra()
    {
    $cart = \Config\Services::cart();
    $contenido = $cart->contents();

    if (empty($contenido)) {
        return redirect()->to('/carrito')->with('mensaje', 'El carrito está vacío.');
    }

    $total = 0;
    foreach ($contenido as $item) {
        $total += $item['price'] * $item['qty'];
    }

    return view('Front/nav-view')
        . view('resumen-compra', ['cart' => $contenido, 'total' => $total]);
    }

    /*public function finalizarCompra()
    {
    $session = session();
    $usuario_id = $session->get('id_usuario');
    $cart = \Config\Services::cart();

    if (!$usuario_id || empty($cart->contents())) {
        return redirect()->to('/carrito')->with('mensaje', 'No hay productos en el carrito o no hay sesión activa.');
    }

    $contenido = $cart->contents();
    $total = 0;

    foreach ($contenido as $item) {
        $total += $item['price'] * $item['qty'];
    }

    $ventaModel = new \App\Models\Ventas_cabecera_model();
    $detalleModel = new \App\Models\Ventas_detalle_model();

    // Insertar en venta_cabecera
    $cabecera_id = $ventaModel->insert([
        'fecha' => date('Y-m-d'),
        'usuario_id' => $usuario_id,
        'total_venta' => $total
    ]);

    // Insertar los detalles
    foreach ($contenido as $item) {
        $detalleModel->insert([
            'venta_id' => $cabecera_id,
            'producto_id' => $item['id'],
            'cantidad' => $item['qty'],
            'Precio' => $item['price']
        ]);
    }

    // Vaciar el carrito
    $cart->destroy();

    return redirect()->to('/carrito')->with('success', '¡Compra finalizada correctamente!');
    }*/
}