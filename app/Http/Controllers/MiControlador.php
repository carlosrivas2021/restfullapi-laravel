<?php

namespace App\Http\Controllers;

use App\MiModelo;

class MiControlador extends Controller{
    

    public function index()
    {
        $modelo = new MiModelo();
        $resultado = $modelo->saludar("Carlos");
        return view("prueba.index", ["saludo"=>$resultado]);
    }
}