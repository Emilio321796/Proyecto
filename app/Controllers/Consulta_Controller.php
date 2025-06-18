<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Consulta_model;

class Consulta_Controller extends BaseController
{
    // Muestra el formulario de consulta
    public function index()
    {
        return view('Front/consultas'); // Asegurate de tener esta vista creada
    }

    // Guarda la consulta en la base de datos
    public function guardar()
    {
        helper(['form']);

        // Validaciones
        $rules = [
            'nombre'     => 'required|min_length[3]',
            'apellido'   => 'required|min_length[3]',
            'email'      => 'required|valid_email',
            'ciudad'     => 'required',
            'pais'       => 'required',
            'comentario' => 'required|min_length[5]'
        ];

        if (!$this->validate($rules)) {
            return view('Front/consultas', [
                'validation' => $this->validator
            ]);
        }

        $model = new Consulta_model();

        $data = [
            'nombre'     => $this->request->getPost('nombre'),
            'apellido'   => $this->request->getPost('apellido'),
            'email'      => $this->request->getPost('email'),
            'ciudad'     => $this->request->getPost('ciudad'),
            'pais'       => $this->request->getPost('pais'),
            'comentario' => $this->request->getPost('comentario'),
             
        ];

        $model->save($data);

        return redirect()->to(site_url('consultas'))->with('msg', 'Consulta enviada correctamente.');

    }

    public function listar()
    {

    $model = new Consulta_model();
    $data['consultas'] = $model->findAll();
        
        echo view('Front/nav-view');
        echo view('Consultas/Lista_Consulta', $data); // Asegurate de que esta vista exista
    }

   public function atender_consulta($id = null)
    {
        $consultasM = new consulta_model();
        $consultasM->getConsulta($id);
        $consultasM->update($id, ['respuesta' => 'SI']);
        return redirect()->to(base_url('Consultas/listar'));
    }

     public function eliminar_consulta($id = null)
    {
        $model = new consulta_model();
        $model->getConsulta($id);
        $model->delete($id);
        return redirect()->to(base_url('Consultas/listar'));
    }

}
