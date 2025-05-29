<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\carrito;
use App\Models\actualizar_carrito;
use App\Models\eliminar_producto;
use App\Models\borrar_carrito;
use App\Models\procesar_compra;
use App\Models\registrar_venta;



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

    // Obtener contenido del carrito
    $carrito = $cart->contents();

    // Verificar si el carrito está vacío
    if (empty($carrito)) {
        return redirect()->back()->with('mensaje', 'El carrito está vacío.');
    }

    // Instanciar modelos
    $ventaCabeceraModel = new \App\Models\Ventas_cabecera_model();
    $ventaDetalleModel  = new \App\Models\Ventas_detalle_model();

    // Insertar venta cabecera
   $usuarioId = $session->get('usuario_id'); // este debe existir en sesión

   $cabecera = [
    'fecha'       => date('Y-m-d'),
    'usuario_id'  => $usuarioId,
    'total_venta' => $cart->total()
   ];


    $ventaCabeceraModel->insert($cabecera);
    $idVentaCabecera = $ventaCabeceraModel->insertID();

    // Insertar cada producto como detalle
    foreach ($carrito as $item) {
       $detalle = [
            'venta_id'    => $idVentaCabecera,
            'producto_id' => $item['id'],
            'cantidad'    => $item['qty'],
            'Precio'      => $item['price']
        ];
        $ventaDetalleModel->insert($detalle);
    }

    // Vaciar carrito
    $cart->destroy();

    // Redirigir con mensaje
    return redirect()->to(base_url('/Ventas/Mostrar_Ventas'))->with('mensaje', '¡Venta registrada exitosamente!');
  }
}