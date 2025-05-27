<?php
namespace App\Controllers;
use CodeIgniter\Controller;
class panel_controller extends BaseController{

public function index(){

$logged_in = $this->request->getvar('logged_in');

$perfil_id = $this->request->getvar('perfil_id');

//Pregunta si inicio sesion
	if($is_logged){

		if ($perfil_id == 1) {
			//Poner las vistas de admin
		}else{
			//poner las vistas de cliente
		}
	}else{
//Poner las vistas de invitado
	}
}

}



?>