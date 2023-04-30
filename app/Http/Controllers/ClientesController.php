<?php

namespace App\Http\Controllers;

use App\Models\clientes;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $clientes = clientes::all();
            return response()->json($clientes);
        }
        catch(ModelNotFoundException $ex){
            $data=[
                "respuesta"=>"400",
                "mensaje"=>"No se encontró el cliente"
            ];
            return response()->json($data);
        }
       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $request->validate([
                "nombre"=>"required",
                "telefono"=>"required"
            ]);

            $cliente = new clientes;
            $cliente->nombre = $request->nombre;
            $cliente->apellidos = $request->apellidos;
            $cliente->telefono = $request->telefono;
            $cliente->save();
        }
        catch(Exception $ex){
            $data=[
                "respuesta"=>"400",
                "mensaje"=>"No se pudo registrar al cliente"
            ];
            return response()->json($data);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($cliente_id)
    {
        try{
            $cliente = clientes::findOrFail($cliente_id);
            return response()->json($cliente);
        }catch(ModelNotFoundException $ex){
            $data=[
                "respuesta"=>"404",
                "mensaje"=>"No se encontró el cliente"
            ];
            return response()->json($data);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $cliente_id)
    {
        try{
            $request->validate([
                "nombre"=>"required",
                "telefono"=>"required"
            ]);
            $cliente=Clientes::findOrFail($cliente_id);
            $cliente->nombre = $request->nombre;
            $cliente->apellidos = $request->apellidos;
            $cliente->telefono = $request->telefono;
            $cliente->update();
        }
        catch(Exception $ex){
            $data=[
                "respuesta"=>"400",
                "mensaje"=>"No se pudo actualizar al cliente"
            ];
            return response()->json($data);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($cliente_id)
    {
        try{
            $cliente=Clientes::findOrFail($cliente_id);
            $cliente->delete();
            $data=[
                "respuesta"=>"cliente eliminado",
                "detalle cliente"=>$cliente
            ];
            return response()->json($data);
        }
        catch(Exception $ex){
            $data=[
                "respuesta"=>"400",
                "mensaje"=>"No se pudo eliminar al cliente"
            ];
            return response()->json($data);
        }
    }
}
