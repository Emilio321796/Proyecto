<?php 
namespace App\Models;

use CodeIgniter\Model;

class Ventas_cabecera_model extends Model {
    protected $table            = 'venta_cabecera';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['fecha', 'usuario_id', 'total_venta'];

    public function get_ventas_cabecera()
    {
        $query = $this->db->table($this->table);
        $query->select($this->table . '.*, usuarios.Nombre, usuarios.Apellido, usuarios.Usuario');
        $query->join('usuarios', 'usuarios.id_usuarios = ' . $this->table . '.usuario_id');
        $query->orderBy($this->table . '.fecha', 'ASC');
        return $query->get()->getResultArray();
    }

    public function get_ventas_por_fecha($fecha_inicio, $fecha_fin)
    {
        $query = $this->db->table($this->table);
        $query->select($this->table . '.*, usuarios.Nombre, usuarios.Apellido, usuarios.Usuario');
        $query->join('usuarios', 'usuarios.id_usuarios = ' . $this->table . '.usuario_id');
        $query->where($this->table . '.fecha >=', $fecha_inicio);
        $query->where($this->table . '.fecha <=', $fecha_fin);
        $query->orderBy($this->table . '.fecha', 'ASC');
        return $query->get()->getResultArray();
    }

    public function mostrar()
    {
    $db = \Config\Database::connect();

    $builder = $db->table('usuarios U');
    $builder->select('VC.id AS id_venta, U.Nombre, U.Apellido, U.Email, VC.fecha, P.nombre AS producto');
    $builder->join('venta_cabecera VC', 'U.id_usuario = VC.usuario_id', 'inner');
    $builder->join('venta_detalle VD', 'VD.venta_id = VC.id', 'inner');
    $builder->join('producto P', 'VD.producto_id = P.ID_Pro', 'inner');

    $query = $builder->get();
    $ventas = $query->getResultArray();
    echo view('Front/nav-view');
    echo view('Productos/Muestra_Ventas', ['ventas' => $ventas]);
    }

    

}