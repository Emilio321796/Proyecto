<?php
   namespace App\Controllers;
   use App\Models\Usuarios_model;
   use App\Models\Consulta_model;
   use CodeIgniter\Controller;


    class Usuario_crud_controller extends Controller
    {
    	public function __construct()
        {
            helper(['url', 'form']);
    	}
    	
    	public function index(){

    		$userModel = new Usuarios_model();
    		$data['users'] = $userModel->orderBy('id_usuario', 'DESC')->findAll();

    		$dato['titulo'] = 'Crud_usuarios';

    		//echo view ('front/head_view_crud', $dato);
    		echo view ('Views/Front/nav_view');
    		echo view ('Views/Usuario/Usuario_new_view', $data);
    		echo view ('Views/Front/end-view');
    	}

    	public function create(){
    		$userModel = new Usuarios_Model();
    		$data['user_obj'] = $userModel->orderBy('id_usuario', 'DESC')->findAll();

    		$dato['titulo'] = 'Alta Usuario';
    		//echo view ('front/head_view_crud',$dato);
    		echo view ('Views/Front/nav_view',$dato);
    		echo view ('Views/Usuario/Usuario_new_view', $data);
    	    echo view ('Views/Front/end-view');	
    	}

    	public function store (){
            $input = $this->validate([
            	'nombre' => 'required|min_length[3]',
                'apellido' => 'required|min_length[3]|max_length[25]',
                'email' => 'required|min_length[4]|max_length[100]|valid_email|is_unique[usuarios.email]',
                'usuario' => 'required|min_length[3]',
                'pass' => 'required|min_length[3]|max_length[10]',
                  ]);
            $userModel = new Usuarios_model();

            if(!$input){
            	$data['titulo']= 'Modificacion';
            	//echo view ('Front/head_view', $data);
            	echo view ('ViewsFront/nav-view', $data);
            	echo view ('Views/Usuario/Usuario_crud', ['validation' => $this->validator]);
            }else{
                
                $data = [
                	'nombre' => $this->request->getVar('nombre'),
                    'apellido' => $this->request->getVar('apellido'),
                    'usuario' => $this->request->getVar('usuario'),
                    'email' => $this->request->getVar('email'),
                    'pass' => $this->request->getVar('pass', PASSWORD_DEFAULT)
                     ];

                     $userModel->insert($data);
                     return $this->response->redirect(site_url('user-list'));
                    }
                }

                public function singleUser($id = null){
                	$userModel = new Usuarios_Model();
                	$data['user_obj'] = $userModel->where('id_usuario', $id)->first();

                	$dato['titulo']='Crud_usuarios';
                	//echo view ('Front/head_view_crud', $dato);
                	echo view ('Views/Front/nav_view');
                	echo view ('Views/Front/end-view');
                }

                public function update(){
                	$userModel = new Usuarios_Model();
                	$id = $this->request->getVar('id');

                	 $data = [
                	'nombre' => $this->request->getVar('nombre'),
                    'apellido' => $this->request->getVar('apellido'),
                    'usuario' => $this->request->getVar('usuario'),
                    'email' => $this->request->getVar('email'),
                    'perfil_id' => $this->request->getVar('perfil'), 
                     ];

                     $userModel->insert($data);
                     return $this->response->redirect(site_url('user-list'));
                    }
                
                public function delete($id = null){
                    $userModel = new Usuarios_Model();
                    $data['usuario'] = $userModel->where ('id_usuario', $id) ->delete($id);
                    return $this->response->redirect(site_url('users-list'));
                }

                public function deletelogico ($id = null){
                	$userModel = new Usuarios_Model();
                	$data['baja'] = $userModel->where('id_usuario', $id) ->first();
                	$data['baja'] = 'SI';
                	$userModel->update($id, $data);
                    return $this->response->redirect(site_url('users-list'));
                }

                public function activar ($id = null){
                    $userModel = new Usuarios_Model();
                    $data['baja'] = $userModel->where('id_usuario',$id)->first();
                    $data['baja'] = 'NO';
                    $userModel->update($id, $data);

                    return $this->response->redirect(site_url('users-list'));
                }

                public function listar_consultas(){
                    $consultas = new consulta_model();
                    $data['consultas'] = $consutlas->getConsultas();
                    $dato['consultas'] = $consultas->getConsultas();
                    $dato['titulo'] = 'Gestion-Consultas';

                    //echo view ('front/head_view_crud', $dato);
                    echo view ('Views/Front/nav_view');
                    echo view ('Views/Consultas/Lista_Consulta', $data);
                    echo view ('Views/Front/end-view');
                }

                public function atender_consulta($id = null){
                    $consultasM = new Consulta_model();
                    $consultasM->gerConsulta($id);
                    $consultasM->update($id, ['respuesta' => 'SI']);

                    return redirect()->to(base-url('Lista_Consulta'));
                }
                 
                public function eliminar_consulta($id = null){
                    $model = new consulta_model();
                    $model->getConsulta($id);
                    $model->delete($id);

                    return redirect()->to(base_url('Lista_Consulta'));

                }


 }     