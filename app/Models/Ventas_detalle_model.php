<?php 
namespace App\Models;

use CodeIgniter\Model;

class modelo_ventaDetalle extends Model{
    protected $table            = 'ventas_detalle';
    
    protected $primaryKey       = 'id_ventaDet';
    protected $allowedFields    = ['id_ventaCab', 'pd_id', 'cantidad', 'precio'];
}