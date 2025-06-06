<?php
namespace App\Controllers;
Use App\Models\usuario_model;
use CodeIgniter\Controller;

class usuario_controller extends Controller{

    public function __construct(){
           helper(['form', 'url']);

    }

    public function index(){
        $usuarios = new usuario_model();
$data['usuarios'] = $usuarios->findAll();
        echo view('Front/nav-view');
        echo view('Views/Usuario/Usuario_Crud',$data);
        echo view('Front/end-view');

    }


   public function create()
{
    $request = \Config\Services::request();
    $data = [
        'Nombre'    => $request->getPost('Nombre'),
        'Usuario'   => $request->getPost('Usuario'),
        'Email'     => $request->getPost('Email'),
        'Password'  => password_hash($request->getPost('Password'), PASSWORD_DEFAULT),
        'id_Perfil' => 2
    ];

    $model = new \App\Models\usuario_model();  // o como se llame tu modelo
    $model->insert($data);

    return redirect()->to('/')->with('msg', 'Registro exitoso');
}


 public function actualizarDatos()
 {
    $user = new usuario_model();
     $nuevosDatos = $this->request->getPost();
     $datosActuales = $this->request->getVar('id_usuario');
     $usuariosTab['usuario'] = $user->where('id_usuario', $datosActuales)->first();



     // Realizar la actualización solo si los datos son diferentes
     if ($user->update($datosActuales, $nuevosDatos)) {
         return redirect()->back()->with('alertaExitosa', 'Modificación Exitosa!');
     } else {
         $usuariosTab['titulo'] = 'Modificar Usuario';
         $usuariosTab['validation'] = $user->errors();

         return redirect()->back()->with('alertaExitosa',$usuariosTab, 'No se modifico el usuario');
 
     }
 }
 
    public function formValidation() {
             
        $input = $this->validate([
            'nombre'   => 'required|min_length[3]',
            'apellido' => 'required|min_length[3]|max_length[25]',
            'usuario'  => 'required|min_length[3]',
            'email'    => 'required|min_length[4]|max_length[100]|valid_email|is_unique[usuarios.email]',
            'pass'     => 'required|min_length[3]|max_length[10]'
        ],
        
       );
        $formModel = new usuario_model();
     
        if (!$input) {
               $data['titulo']='Registro'; 
                echo view('Front/nav-view');
                echo view('Registrar', ['validation' => $this->validator]);
                echo view('Front/end-view');

        } else {
            $formModel->save([
                'Nombre' => $this->request->getVar('nombre'),
                'Apellido'=> $this->request->getVar('apellido'),
                'Usuario'=> $this->request->getVar('usuario'),
                'Email'=> $this->request->getVar('email'),
                'pass' => password_hash($this->request->getVar('pass'), PASSWORD_DEFAULT),
                'perfil_id' => 2,
              //password_hash() crea un nuevo hash de contraseña usando un algoritmo de hash de único sentido.
            ]);  
             
            // Flashdata funciona solo en redirigir la función en el controlador en la vista de carga.
               session()->setFlashdata('success', 'Usuario registrado con exito');
                return redirect()->to('/Registrar');
              // return $this->response->redirect('/registro');
      
        }
    }

        // Se realiza la eliminación lógica del usuario
        public function borrar($id = null)
        {
            $user = new usuario_model();
            $user->update($id, ['baja' => "SI"]);
            // Se redireccion a la tabla de consulta de los usuarios
            return redirect()->back()->with('alertaExitosa', 'Usuario Eliminado con Exito!');
        }
    

        public function editar($id = null){
            $user = new usuario_model();
            $data['usuario'] = $user->find($id);

            echo view('Front/nav-view');
            echo view('Views/Usuario/Edit_usuario', $data);
            echo view('Front/end-view');
        }
    
    
        // Al usuario eliminado logicamente, se le da de alta
        public function alta($id = null)
        {
            $user = new usuario_model();
            $user->update($id, ['baja' => "NO"]);
            // Se redireccion a la tabla de consulta de los usuarios
            return redirect()->back()->with('alertaExitosa', 'Usuario Reincorporado!');
        }
}