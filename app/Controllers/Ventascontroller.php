<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Ventas_cabecera_model;
use App\Models\Ventas_detalle_model;


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

    // Obtener contenido del carrito
    $carrito = $cart->contents();

    // Verificar si el carrito está vacío
    if (empty($carrito)) {
        return redirect()->back()->with('mensaje', 'El carrito está vacío.');
    }

    // Insertar venta
   $usuarioId = $session->get('id_usuario');

    $ventaCabeceraModel = new \App\Models\Ventas_cabecera_model();
    $ventaDetalleModel  = new \App\Models\Ventas_detalle_model();
    $productoModel = new \App\Models\Producto_Model();

    $session = session();
    $total = 0;
    foreach ($cartItems as $item) {
        $total += $item['price'] * $item['qty'];
    }

    $cabecera = [
        'fecha'       => date('Y-m-d'),
        'usuario_id'  => $usuarioId,
        'total_venta' => $cart->total()
    ];

    $ventaCabeceraModel->insert($cabecera);
    $idVentaCabecera = $ventaCabeceraModel->insertID();

    foreach ($carrito as $item) {
        $producto = $productoModel->find($item['id']);

    if ($producto && isset($producto['Stock'])) {
        $stockActual = (int)$producto['Stock'];
        $cantidadVendida = (int)$item['qty'];

     if ($stockActual < $cantidadVendida) {
    session()->setFlashdata('error_stock', 'No hay stock suficiente para el producto: ' . $producto['Nombre']);
    return redirect()->to(base_url('/carrito'));
}

        $detalle = [
            'venta_id'    => $idVentaCabecera,
            'producto_id' => $item['id'],
            'cantidad'    => $item['qty'],
            'Precio'      => $item['price'],
            'subtotal'   => $item['price'] * $item['qty']
        ];
        $ventaDetalleModel->insert($detalle);
   
         
            // Actualizar stock
               $nuevoStock = $stockActual - $cantidadVendida;
            $productoModel->update($item['id'], ['Stock' => $nuevoStock]);
       }
       $cart->destroy(); // si usás $cart = \Config\Services::cart();
       return redirect()->to(base_url('/carrito'))->with('success', 'Compra realizada con éxito.');
    }
  }

  public function mostrar()
{
    $ventaCabeceraModel = new \App\Models\Ventas_cabecera_model();
    $ventaDetalleModel  = new \App\Models\Ventas_detalle_model();
    $productoModel = new \App\Models\Producto_Model();
    $db = \Config\Database::connect();

      

    // Traer todas las cabeceras
    $ventas = $ventaCabeceraModel->findAll();

    foreach ($ventas as &$venta) {
        $venta_id = $venta['id'];

        // Traer detalles con JOIN a productos
        $builder = $db->table('venta_detalle vd');
        $builder->select('vd.*, p.nombre AS producto_nombre');
        $builder->join('producto p', 'p.ID_Pro = vd.producto_id');  // Cambia 'id' si es 'pd_id'
        $builder->where('vd.venta_id', $venta_id);

        $venta['detalles'] = $builder->get()->getResultArray();
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

    $ventaModel = new \App\Models\Ventas_cabecera_model();
    $detalleModel = new \App\Models\Ventas_detalle_model();

    echo "Usuario en sesión: $usuario_id<br>";
    // Obtener todas las ventas del usuario
    $ventas = $ventaModel->where('usuario_id', $usuario_id)->findAll();

    // Para cada venta, obtener sus detalles
    foreach ($ventas as &$venta) {
        $venta['detalles'] = $detalleModel->obtenerDetallesPorVentaId($venta['id']);
    }
   echo view('Front/nav-view');
   echo view('/post-venta', ['ventas' => $ventas]);
}

    public function factura($id = null)
    {
    // Validar ID
    if (!is_numeric($id) || $id <= 0) {
        return redirect()->to(base_url('/'))->with('error', 'ID de venta inválido.');
    }

    // Cargar modelos
    $ventaCabeceraModel = new \App\Models\Ventas_cabecera_model();
    $ventaDetalleModel  = new \App\Models\Ventas_detalle_model();

    // Buscar la venta
    $venta = $ventaCabeceraModel
        ->join("usuarios", "usuarios.id_usuario = venta_cabecera.usuario_idlo")
        ->where('id_ventaCab', $id)
        ->first();

    if (!$venta) {
        return redirect()->to(base_url('/'))->with('error', 'Venta no encontrada.');
    }

    // Buscar detalles
    $detalle_compra = $ventaDetalleModel
        ->where('id_ventaCab', $id)
        ->join('producto', 'producto.ID_Pro = venta_detalle.id')
        ->findAll();


    if (!$venta || empty($detalles)) {
        return redirect()->to(base_url('/'))->with('error', 'Venta no encontrada.');
    }

    // Cargar FPDF
    require_once APPPATH . 'ThirdParty/fpdf/fpdf.php';
    $pdf = new \FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(0, 10, 'Factura - Sabores Express', 0, 1, 'C');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, 'Fecha: ' . date('d/m/Y', strtotime($venta['fecha'])), 0, 1);
    $pdf->Cell(0, 10, 'Factura N°: ' . $venta['id'], 0, 1);
    $pdf->Ln(5);

    // Tabla de productos
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(70, 10, 'Producto', 1);
    $pdf->Cell(30, 10, 'Precio', 1);
    $pdf->Cell(30, 10, 'Cantidad', 1);
    $pdf->Cell(50, 10, 'Subtotal', 1);
    $pdf->Ln();

    $pdf->SetFont('Arial', '', 12);
    foreach ($detalles as $d) {
        $subtotal = $d['Precio'] * $d['cantidad'];
        $pdf->Cell(70, 10, utf8_decode($d['producto_nombre']), 1);
        $pdf->Cell(30, 10, '$' . number_format($d['Precio'], 2), 1);
        $pdf->Cell(30, 10, $d['cantidad'], 1);
        $pdf->Cell(50, 10, '$' . number_format($subtotal, 2), 1);
        $pdf->Ln();
    }

    // Total
    $pdf->Ln(5);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(130, 10, 'Total Pagado:', 1);
    $pdf->Cell(50, 10, '$' . number_format($venta['total_venta'], 2), 1);
    $pdf->Ln();

    // Mostrar PDF
    $pdf->Output('I', 'Factura_' . $venta['id'] . '.pdf');
    exit();
}


  
}
