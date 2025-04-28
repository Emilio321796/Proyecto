<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
    	echo view('front/nav-view.php');
        echo view('front/principal.php');
        echo view('front/end-view.php');
    }

    public function productos()
    {
      echo view('front/nav-view.php');  
      echo view('front/Productos.php');
      echo view('front/end-view.php');
    }

    public function Comercializacion()
    {
       echo view('front/nav-view.php');  
       echo view('front/Comercializacion.php');
       echo view('front/end-view.php');
    }

    public function quienessomos()
    {
       echo view('front/nav-view.php');   
       echo view('front/quienessomos.php');
       echo view('front/end-view.php');
    }

    public function consultas()
    {
       echo view('front/nav-view.php');   
       echo view('front/consultas');
       echo view('front/end-view.php');
    }

    public function terminosycondiciones ()
    {
        echo view('front/nav-view.php');
        echo view('front/terminosycondiciones.php');
        echo view('front/end-view.php');   
    }

    public function login()
    {
       echo view('front/nav-view.php');   
       echo view('front/login.php');
       echo view('front/end-view.php');
    }

}