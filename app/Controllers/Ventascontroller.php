<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Ventas_cabecera_model;
use App\Models\Ventas_detalle_model;
use App\Models\Producto_Model;

class Ventascontroller extends Controller
{
    public function __construct()
    {
        helper(['form', 'url']);
    }

    // Mostrar carrito
    public function carrito()
    {
        $session = session();
        $cart = \Config\Services::cart();
        $data['cart'] = $cart->contents();

        echo view('Front/nav-view');
        echo view('Ventas/Mostrar_Ventas', $data);
        echo view('Front/end-view');
    }

    // Actualizar carrito
    public function actualizar_carrito()
    {
        $cart = \Config\Services::cart();
        $data = $this->request->getPost('cart');

        if (is_array($data) && count($data) > 0) {
            foreach ($data as $item) {
                $cart->update([
                    'rowid' => $item['rowid'],
                    'qty'   => $item['qty']
                ]);
            }
             }

        return redirect()->to('Ventas/Mostrar_Ventas');
    }

    // Eliminar un producto del carrito
    public function eliminar_producto($rowid)
    {
        $cart = \Config\Services::cart();
        $cart->remove($rowid);

        return redirect()->to('/Ventas/Mostrar_Ventas');
    }

    // Borrar todo el carrito
    public function borrar_carrito()
    {
        $cart = \Config\Services::cart();
        $cart->destroy();

        return redirect()->to('/Ventas/Mostrar_Ventas');
    }

    // Procesar la compra
    public function procesar_compra()
    {
        $cart = \Config\Services::cart();
        $ventaModel = new VentaModel();

        $ventaData = [
            'total' => $cart->total(),
            'fecha' => date('Y-m-d H:i:s'),
        ];

        $ventaId = $ventaModel->insert($ventaData);

        foreach ($cart->contents() as $item) {
            $ventaModel->insertDetalle([
                'venta_id'     => $ventaId,
                'producto_id'  => $item['id'],
                'cantidad'     => $item['qty'],
                'precio'       => $item['price'],
                'subtotal'     => $item['subtotal'],
            ]);
        }

        $cart->destroy();

        session()->setFlashdata('mensaje', 'Compra realizada con éxito');
        return redirect()->to('/Ventas/Mostrar_Ventas');
    }

   public function registrar_venta()
{
    $cart = \Config\Services::cart();
    $session = session();
    $cartItems = $cart->contents();

    // Verificar si hay un usuario en sesión
    if (!$session->has('id_usuario')) {
        return redirect()->to('/')->with('mensaje', 'Debe iniciar sesión para comprar.');
    }

    // Verificar si el carrito está vacío
    if (empty($cartItems)) {
        return redirect()->back()->with('mensaje', 'El carrito está vacío.');
    }

    // Cargar modelos
    $usuarioId = $session->get('id_usuario');
    $ventaCabeceraModel = new \App\Models\Ventas_cabecera_model();
    $ventaDetalleModel  = new \App\Models\Ventas_detalle_model();
    $productoModel      = new \App\Models\Producto_Model();

    // Verificar stock de todos los productos antes de registrar la venta
    foreach ($cartItems as $item) {
        $producto = $productoModel->find($item['id']);

        if (!$producto || !isset($producto['Stock'])) {
            return redirect()->to('/carrito')->with('mensaje', 'Producto no encontrado: ' . $item['name']);
        }

        if ((int)$producto['Stock'] < (int)$item['qty']) {
            return redirect()->to('/carrito')->with('mensaje', 'No hay stock suficiente para: ' . $producto['Nombre']);
        }
    }

    // Insertar cabecera de venta
    $cabecera = [
        'fecha'       => date('Y-m-d'),
        'usuario_id'  => $usuarioId,
        'total_venta' => $cart->total()
    ];

    $ventaCabeceraModel->insert($cabecera);
    $idVentaCabecera = $ventaCabeceraModel->insertID();

    // Insertar detalle de cada producto y actualizar stock
    foreach ($cartItems as $item) {
        $producto = $productoModel->find($item['id']);
        $cantidadVendida = (int)$item['qty'];
        $nuevoStock = (int)$producto['Stock'] - $cantidadVendida;

        // Insertar detalle
        $detalle = [
            'venta_id'    => $idVentaCabecera,
            'producto_id' => $item['id'],
            'cantidad'    => $cantidadVendida,
            'Precio'      => $item['price'],
            'subtotal'    => $item['price'] * $cantidadVendida
        ];
        $ventaDetalleModel->insert($detalle);

        // Actualizar stock
        $productoModel->update($item['id'], ['Stock' => $nuevoStock]);
    }

    // Vaciar el carrito y redirigir a factura
    $cart->destroy();
    return redirect()->to(base_url("Ventas/factura/$idVentaCabecera"));
}


  public function mostrar()
{
    //$ventaCabeceraModel = new \App\Models\Ventas_cabecera_model();
    //$ventaDetalleModel  = new \App\Models\Ventas_detalle_model();
    //$productoModel = new \App\Models\Producto_Model();
    $db = \Config\Database::connect();

      

    // Traer todas las cabeceras
    $builder = $db->table('venta_cabecera vc');
    $builder->select('vc.*, u.Nombre, u.Apellido, u.Email');
    $builder->join('usuarios u', 'u.id_usuario = vc.usuario_id', 'left');
    $ventas = $builder->get()->getResultArray();

    foreach ($ventas as &$venta) {
        $venta_id = $venta['id'];

        // Traer detalles con JOIN a productos
        $detalleBuilder = $db->table('venta_detalle vd');
        $detalleBuilder->select('vd.*, p.nombre AS producto_nombre');
        $detalleBuilder->join('producto p', 'p.ID_Pro = vd.producto_id');  
        $detalleBuilder->where('vd.venta_id', $venta_id);

        $venta['detalles'] = $detalleBuilder->get()->getResultArray();
    }

     echo view('Front/nav-view');
    echo view('Productos/Muestra_Ventas', ['ventas' => $ventas]);
   }

    public function borrarDetalle($id)
    {
    $ventaDetalleModel = new \App\Models\Ventas_detalle_model();
    $productoModel = new \App\Models\Producto_model();

    $detalle = $ventaDetalleModel->find($id);

    if ($detalle) {
        // Recuperar el producto para devolver el stock
        $producto = $productoModel->find($detalle['producto_id']);
        if ($producto) {
            $nuevoStock = $producto['Stock'] + $detalle['cantidad'];
            $productoModel->update($producto['ID_Pro'], ['Stock' => $nuevoStock]);
        }

        $ventaDetalleModel->delete($id);
        return redirect()->back()->with('success', 'Detalle de venta eliminado y stock actualizado.');
    }

    return redirect()->back()->with('error', 'No se encontró el detalle.');
    }

   public function reiniciarStock()
    {
     $productoModel = new \App\Models\Producto_Model();
     $productos = $productoModel->findAll();

     foreach ($productos as $producto) {
        $productoModel->update($producto['ID_Pro'], ['Stock' => 10]); // o cualquier valor inicial
     }

      session()->setFlashdata('success', 'Stock reiniciado correctamente.');
      return redirect()->to('/Crud_Producto'); // o donde quieras redirigir
    }

    public function ventasUsuario()
    {
    $usuario_id = session()->get('id_usuario');

    $db = \Config\Database::connect();
    $detalleModel = new \App\Models\Ventas_detalle_model();

    
    $builder = $db->table('venta_cabecera vc');
    $builder->select('vc.*, u.Nombre as nombre_usuario, u.Apellido as apellido_usuario, u.Email as email_usuario');
    $builder->join('usuarios u', 'u.id_usuario = vc.usuario_id', 'inner');
    $builder->where('vc.usuario_id', $usuario_id);
    $ventas = $builder->get()->getResultArray();

   
    foreach ($ventas as &$venta) {
        $venta['detalles'] = $detalleModel->obtenerDetallesPorVentaId($venta['id']);
    }

    echo view('Front/nav-view');
    echo view('post-venta', ['ventas' => $ventas]);
    }

 public function factura($id)
{
    $db = \Config\Database::connect();

    // Modelo de cabecera y detalle
    $cabecera = $db->table('venta_cabecera vc')
                   ->select('vc.*, u.Nombre as nombre_usuario')
                   ->join('usuarios u', 'vc.usuario_id = u.id_usuario')
                   ->where('vc.id', $id)
                   ->get()
                   ->getRowArray();

    $detalleModel = new \App\Models\Ventas_detalle_model();

    $detalle = $detalleModel->where('venta_id', $id)
                            ->join('producto', 'producto.ID_Pro = venta_detalle.producto_id')
                            ->select('producto.Nombre, venta_detalle.*')
                            ->findAll();
    
    $total = 0;
    foreach ($detalle as $item) {
        $total += $item['cantidad'] * $item['Precio']; // asumiendo que 'Precio' está en $item
    } 

    return view('Ventas/factura', [
        'venta' => $cabecera,
        'detalle' => $detalle,
        'total'   => $total
    ]);
}



}
