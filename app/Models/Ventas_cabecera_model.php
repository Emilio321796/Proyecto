<?php 
namespace App\Models;

use CodeIgniter\Model;
/*
class Ventas_cabecera_model extends Model{
    protected $table            = 'venta_cabecera';
    
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['id_Cliente', 'fecha', 'usuario_id', 'total_venta'];

    public function get_ventas_cabecera()
    {
        $query = $this->db->table('venta_cabecera');
        $query->select('venta_cabecera_model.*, usuarios.Nombre, usuarios.Apellido, usuarios.Usuario');
        $query->join('usuarios', 'usuarios.id_usuarios = venta_cabecera.id_Cliente');
        $query->orderBy('venta_cabecera.fecha', 'ASC'); // Ordenar por fecha de forma ascendente
        
        
        return $query->get()->getResultArray();
    }
    public function get_ventas_por_fecha($fecha_inicio, $fecha_fin)
    {
        $query = $this->db->table('venta_cabecera');
        $query->select('venta_cabecera.*, usuarios.us_nombre, usuarios.us_apellido, usuarios.us_correo');
        $query->join('usuarios', 'usuarios.us_id = venta_cabecera.id_Cliente');
        $query->where('venta_cabecera.fecha_Venta >=', $fecha_inicio);
        $query->where('venta_cabecera.fecha_Venta <=', $fecha_fin);
        $query->orderBy('venta_cabecera.fecha_Venta', 'ASC'); // Ordenar por fecha de forma ascendente
        return $query->get()->getResultArray();
    }
}

*/




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
}