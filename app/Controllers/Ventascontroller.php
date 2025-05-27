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

        echo view('Views/Front/nav-view');
        echo view('Views/ventas/carrito', $data);
        echo view('Views/Front/end-view');
    }

    // Actualizar carrito
    public function actualizar_carrito()
    {
        $cart = \Config\Services::cart();
        $data = $this->request->getPost('cart');

        foreach ($data as $item) {
            $cart->update([
                'rowid' => $item['rowid'],
                'qty'   => $item['qty']
            ]);
        }

        return redirect()->to('Views/Ventas/Mostrar_Ventas');
    }

    // Eliminar un producto del carrito
    public function eliminar_producto($rowid)
    {
        $cart = \Config\Services::cart();
        $cart->remove($rowid);

        return redirect()->to('/ventas/carrito');
    }

    // Borrar todo el carrito
    public function borrar_carrito()
    {
        $cart = \Config\Services::cart();
        $cart->destroy();

        return redirect()->to('/ventas/carrito');
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
        return redirect()->to('/ventas/carrito');
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
    $cabecera = [
        'id_Cliente'   => $session->get('cliente_id'), // Asegurate de tener esto en la sesión
        'fecha'        => date('Y-m-d H:i:s'),
        'usuario_id'   => $session->get('usuario_id'), // Asegurate también de esto
        'total_venta'  => $cart->total()
    ];

    $ventaCabeceraModel->insert($cabecera);
    $idVentaCabecera = $ventaCabeceraModel->insertID();

    // Insertar cada producto como detalle
    foreach ($carrito as $item) {
        $detalle = [
            'id_ventaCab' => $idVentaCabecera,
            'pd_id'       => $item['id'],
            'cantidad'    => $item['qty'],
            'precio'      => $item['price']
        ];
        $ventaDetalleModel->insert($detalle);
    }

    // Vaciar carrito
    $cart->destroy();

    // Redirigir con mensaje
    return redirect()->to(base_url('ventas'))->with('mensaje', '¡Venta registrada exitosamente!');
}


}
