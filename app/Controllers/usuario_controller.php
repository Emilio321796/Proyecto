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


    public function create() {
        
         $dato['titulo']='Registro'; 
        
         echo view('nav-view');
         echo view('Registrar');        
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
            'nombre' => [
            'rules' => 'required|min_length[3]',
            'errors' => [
                'required' => 'El campo Nombre es obligatorio.',
                'min_length' => 'El campo Nombre debe tener al menos 3 caracteres.'
            ]
        ],
             'apellido' => [
            'rules' => 'required|min_length[3]|max_length[25]',
            'errors' => [
                'required' => 'El campo Apellido es obligatorio.',
                'min_length' => 'El Apellido debe tener al menos 3 caracteres.',
                'max_length' => 'El Apellido no puede exceder los 25 caracteres.'
            ]
        ],
            'usuario' => [
            'rules' => 'required|min_length[3]',
            'errors' => [
                'required' => 'El campo Usuario es obligatorio.',
                'min_length' => 'El Usuario debe tener al menos 3 caracteres.'
            ]
        ],
            'email' => [
            'rules' => 'required|valid_email|is_unique[usuarios.email]',
            'errors' => [
                'required' => 'El campo Correo Electrónico es obligatorio.',
                'valid_email' => 'Ingrese un correo electrónico válido.',
                'is_unique' => 'Este correo ya está registrado.'
            ]
        ],
             'pass' => [
            'rules' => 'required|min_length[6]|max_length[20]',
            'errors' => [
                'required' => 'El campo Contraseña es obligatorio.',
                'min_length' => 'La contraseña debe tener al menos 6 caracteres.',
                'max_length' => 'La contraseña no puede exceder los 20 caracteres.'
            ]
        ]
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
    $userModel = new usuario_model();
    
    // Obtener el usuario que se quiere borrar
    $usuario = $userModel->find($id);

    // Verificar si existe y si su perfil_id es 2
    if ($usuario && $usuario['perfil_id'] == 2) {
        $userModel->update($id, ['baja' => "SI"]);
        return redirect()->back()->with('alertaExitosa', 'Usuario eliminado con éxito!');
        } else {
        return redirect()->back()->with('alertaError', 'No tiene permiso para eliminar este usuario.');
        }
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