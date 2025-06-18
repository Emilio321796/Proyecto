<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
    	  echo view('Views/Front/nav-view');
        echo view('Views/Front/principal');
        echo view('Views/Front/end-view');
    }

    public function productos()
    {
      echo view('Views/Front/nav-view');  
      echo view('Views/Front/Productos');
      echo view('Views/Front/end-view');
    }

    public function Comercializacion()
    {
       echo view('Views/Front/nav-view');  
       echo view('Views/Front/Comercializacion');
       echo view('Views/Front/end-view');
    }

    public function quienessomos()
    {
       echo view('Views/Front/nav-view');   
       echo view('Views/Front/quienessomos');
       echo view('Views/Front/end-view');
    }

    public function consultas()
    {
       echo view('Views/Front/nav-view');   
       echo view('Views/Front/consultas');
       echo view('Views/Front/end-view');
    }

    public function terminosycondiciones ()
    {
        echo view('Views/Front/nav-view');
        echo view('Views/Front/terminosycondiciones');
        echo view('Views/Front/end-view');   
    }
    
    public function Login ()
    {
        echo view('Views/Front/nav-view');
        echo view('Views/Front/Login');

    }

     public function Registrar (){
        echo view('nav-view.php');
        echo view('Registrar.php');
    }

    public function faqs()
    {
        echo view('Views/Front/nav-view');
        echo view('Front/FAQs');
    }
    

}