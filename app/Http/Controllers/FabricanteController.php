<?php

namespace App\Http\Controllers;

use App\Fabricante;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FabricanteController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth.basic', ['only' => ['store', 'update', 'destroy']]);
    }

    public function index()
    {
        return response()->json(["datos" => Fabricante::all()], 200);
    }

    public function create()
    {
        return "Mostrando el menú para crear un fabricante";
    }

    public function show($id)
    {

        $fabricante = Fabricante::find($id);
        if (!$fabricante) {
            return response()->json(['mensaje' => 'No se encontro al fabricante'], 404);
        }
        return response()->json(['datos' => $fabricante], 200);
    }

    public function edit($id)
    {
        return "Mostrando el formulario para editar el fabricante id $id";
    }

    public function update(Request $request, $id)
    {
        $metodo = $request->method();
        $fabricante = Fabricante::find($id);
        //return $fabricante;
        $nombre = $request->get('nombre');
        $telefono = $request->get('telefono');
        $flag = false;
        if ($metodo === "PATCH") {

            if ($nombre != null && $nombre != "") {
                $fabricante->nombre = $nombre;
                $flag = true;
            }

            if ($telefono != null && $telefono != "") {
                $fabricante->telefono = $telefono;
                $flag = true;
            }
            if ($flag) {
                $fabricante->save();
                return response()->json(['mensaje' => 'El fabricante fue editado'], 202);
            }
            return response()->json(['mensaje' => 'No se han guardado los cambios'], 200);

        }

        if (!$nombre || !$telefono) {
            return response()->json(['mensaje' => 'Datos incompletos'], 422);
        }
        $fabricante->nombre = $nombre;
        $fabricante->telefono = $telefono;
        $fabricante->save();
        return response()->json(['mensaje' => 'El fabricante fue editado'], 202);

    }

    public function store(Request $request)
    {
        if (!$request->get('nombre') || !$request->get('telefono')) {
            return response()->json(['mensaje' => 'Datos incompletos'], 422);
        }
        Fabricante::create($request->all());
        return response()->json(['mensaje' => 'El fabricante ha sido creado'], 202);

    }

    public function destroy($id)
    {
        $fabricante=Fabricante::find($id);
        
        if(!$fabricante){
            return response()->json(['mensaje' => 'El fabricante no se encuentra'], 404);
        }
        $vehiculos=$fabricante->vehiculos;
        
        if(sizeof($vehiculos)>0){
            return response()->json(['mensaje' => 'El fabricante posee vehiculos y no se puede eliminar'], 404);
        }

        $fabricante->delete();
        return response()->json(['mensaje' => 'El fabricante ha sido eliminado'], 200);
    }

}
