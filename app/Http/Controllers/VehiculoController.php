<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vehiculo;

class VehiculoController extends Controller
{
    

    public function index()
    {
        $vehiculo=Vehiculo::all();
        if(!$vehiculo){
            return response()->json(['mensaje'=>'No existen vehiculos'],404);
        }
        return response()->json(['datos'=>$vehiculo],200);
    }

    public function show($id)
    {
        $vehiculo=Vehiculo::find($id);
        if(!$vehiculo){
            return response()->json(['mensaje'=>'No se encontro el vehiculo'],404);
        }
        return response()->json(['datos'=>$vehiculo],200);
    }
}
