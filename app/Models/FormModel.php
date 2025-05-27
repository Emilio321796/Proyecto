<?php

namespace App\Controllers;

use App\Models\ConsultaModel;
use CodeIgniter\Controller;

class Consultas extends Controller
{
    public function index()
    {
        return view('consulta_form');
    }

    public function guardar()
    {
        $model = new ConsultaModel();

        $data = [
            'nombre'    => $this->request->getPost('firstName'),
            'apellido'  => $this->request->getPost('lastName'),
            'email'     => $this->request->getPost('email'),
            'ciudad'    => $this->request->getPost('address'),
            'pais'      => $this->request->getPost('country'),
            'comentario'=> $this->request->getPost('exampleFormControlTextarea1'),
        ];

        $model->save($data);

        return redirect()->to('/consultas')->with('status', 'Consulta guardada exitosamente!');
    }
}
