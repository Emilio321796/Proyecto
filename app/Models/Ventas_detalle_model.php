<?php 
namespace App\Models;

use CodeIgniter\Model;

class Ventas_detalle_model extends Model{
    protected $table            = 'venta_detalle';
    
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['venta_id', 'producto_id', 'cantidad', 'Precio'];

   
   public function obtenerDetallesPorVentaId($venta_id)
   {
    return $this->select('venta_detalle.*, producto.Nombre AS producto_nombre')
                ->join('producto', 'producto.ID_Pro = venta_detalle.producto_id')
                ->where('venta_detalle.venta_id', $venta_id)
                ->findAll();
   }

    public function getDetalleVenta($venta_id)
    {
        return $this->db->table('venta_detalle vd')
            ->select('vd.cantidad, vd.Precio, p.Nombre as nombre_usuario')
            ->join('producto p', 'p.ID_Pro = vd.producto_id')
            ->where('vd.venta_id', $venta_id)
            ->get()
            ->getResultArray();
    }

}