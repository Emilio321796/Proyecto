<?php 
namespace App\Models;

use CodeIgniter\Model;

class Categoria_model extends Model{
    protected $table            = 'categoria';
    protected $primaryKey       = 'id_categoria';
    protected $allowedFields    = ['ct_nombre', 'ct_descripcion', 'fecha' ,'activacion'];
    protected $useSoftDeletes   = true;
    
    protected $useTimestamps    = false;
    protected $createdField     = 'fecha';
    protected $deletedField     = 'activacion';

    protected $validationRules  = [
        "ct_nombre"         => "required|min_length[3]|max_length[50]",
        "ct_descripcion"    => "required|max_length[200]"
    ];  

    //Se generan las mensajes de validación
    protected $validationMessages = [
        "ct_nombre"         => [
            "required"      => 'Campo de nombre obligatorio',
            "min_length"    => 'El campo nombre debe tener al menos 3 caracteres',
            "max_length"    => 'El campo nombre debe tener máximo 50 caracteres'
        ],
        "ct_descripcion"    => [
            "required"      => 'El campo de descripción es obligatorio',
            "max_length"    => 'El campo de descripción debe tener máximo 200 caracteres'
        ]
    ];

    public function obtenerCategorias($buscar = null)
    {
        if ($buscar) {
            $this->where('ct_nombre LIKE', "%$buscar%");
        }
        return $this->findAll();
    }
}