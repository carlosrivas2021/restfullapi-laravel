<?php

namespace App\Http\Controllers;

use App\Fabricante;
use App\Vehiculo;
use Illuminate\Http\Request;

class FabricanteVehiculoController extends Controller
{
    // public function showAll()
    // {
    //     return "Mostrando todos los Vehiculos";
    // }
    public function __construct()
    {
        $this->middleware('auth.basic');
    }

    public function index($id)
    {
        $fabricante = Fabricante::find($id);
        $vehiculos = $fabricante->vehiculos;
        if (!$vehiculos) {
            return response()->json(['mensaje' => 'No existen vehiculos'], 404);
        }
        return response()->json(['datos' => $vehiculos], 200);

    }

    public function create($id)
    {
        return "Mostrando formulario para crear vehiculo del fabricante $id";
    }

    public function show($idFabricante, $idVehiculo)
    {
        return "Mostrando vehiculo $idVehiculo del fabricante $idFabricante";
    }

    public function edit($idFabricante, $idVehiculo)
    {
        return "Mostrando formulario para editar vehiculo $idVehiculo del fabricante $idFabricante";
    }
    public function update(Request $request, $idFabricante, $idVehiculo)
    {
        $metodo = $request->method();
        $fabricante = Fabricante::find($idFabricante);
        if (!$fabricante) {
            return response()->json(['mensaje' => 'No se encuentra el fabricante'], 404);
        }
        $vehiculo = $fabricante->vehiculos()->find($idVehiculo);
        if (!$vehiculo) {
            return response()->json(['mensaje' => 'No se encuentra el vehiculo para este fabricante'], 404);
        }
        $color = $request->get('color');
        $potencia = $request->get('potencia');
        $cilindraje = $request->get('cilindraje');
        $peso = $request->get('peso');
        $flag = false;
        if ($metodo === "PATCH") {

            if ($color != null && $color != "") {
                $vehiculo->color = $color;
                $flag = true;
            }

            if ($potencia != null && $potencia != "") {
                $vehiculo->potencia = $potencia;
                $flag = true;
            }
            if ($cilindraje != null && $cilindraje != "") {
                $vehiculo->cilindraje = $cilindraje;
                $flag = true;
            }
            if ($peso != null && $peso != "") {
                $vehiculo->peso = $peso;
                $flag = true;
            }

            if ($flag) {
                $vehiculo->save();
                return response()->json(['mensaje' => 'El vehiculo fue editado'], 202);
            }
            return response()->json(['mensaje' => 'No se han guardado los cambios'], 200);
        }

        if (!$color || !$potencia || !$cilindraje || !$peso) {
            return response()->json(['mensaje' => 'Datos incompletos'], 422);
        }
        $vehiculo->color = $color;
        $vehiculo->potencia = $potencia;
        $vehiculo->cilindraje = $cilindraje;
        $vehiculo->peso = $peso;
        $vehiculo->save();
        return response()->json(['mensaje' => 'El fabricante fue editado'], 202);
    }
    public function destroy($idFabricante, $idVehiculo)
    {
        $fabricante=Fabricante::find($idFabricante);
        if(!$fabricante){
            return response()->json(['mensaje' => 'El fabricante no se encuentra'], 404);
        }
        $vehiculo=$fabricante->vehiculos()->find($idVehiculo);
        if(!$vehiculo){
            return response()->json(['mensaje' => 'El vehiculo no esta asociado a este fabricante'], 404);
        }

        $vehiculo->delete();
        return response()->json(['mensaje' => 'El vehiculo ha sido eliminado'], 200);
    }

    public function store(Request $request, $id)
    {
        if (!$request->get('color') || !$request->get('cilindraje') || !$request->get('peso') || !$request->get('potencia')) {
            return response()->json(['mensaje' => 'Datos incompletos'], 422);
        }

        $fabricante = Fabricante::find($id);
        if (!$fabricante) {
            return response()->json(['mensaje' => 'Datos invalidos'], 404);
        }

        Vehiculo::create([
            'color' => $request->get('color'),
            'cilindraje' => $request->get('cilindraje'),
            'peso' => $request->get('peso'),
            'potencia' => $request->get('potencia'),
            'fabricante_id' => $id,
        ]);
        return response()->json(['mensaje' => 'El vehiculo se ha insertado'], 201);

    }

}
