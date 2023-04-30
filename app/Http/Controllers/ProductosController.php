<?php

namespace App\Http\Controllers;

use App\Models\productos;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;


class ProductosController extends Controller
{
    /**
     * muestra todos los productos.
     */
    public function index()
    {
       try{
        $productos = productos::all();
        return $productos;
       }catch(ModelNotFoundException $e){
        $data=[
            "respuesta"=>"vacio",
            "error"=>"La lista de productos esta vacia"
        ];
        return response()->json($data);
       }
    }

    /**
     * crea un nuevo producto.
     */
    public function store(Request $request)
    {
        try{
            $request->validate(
               [
                "titulo"=>"required",
                "contenido"=>"required",
                "precio"=>"required",
                "ocasion"=>"required"
               ]
            );
            $producto = new productos;
            $producto->titulo = $request->titulo;
            $producto->contenido = $request->contenido;
            $producto->precio = $request->precio;
            $producto->ocasion = $request->ocasion;
            $producto->save();
            $data =[
                "respuesta"=>"Producto registrado con éxito",
                "registrado"=>$producto
            ];
            return response()->json($data);

        }catch(Exception $e){
            $data=[
                "respuesta"=>"400",
                "error"=>"No se puede guardar el producto"
            ];

            return response()->json($data);

        }
    }

    /**
     * muestra los detalles de un producto en especifico.
     */
    public function show($producto_id)
    {
        try {
            $producto = productos::findOrFail($producto_id);
            return response()->json($producto);
        } catch (ModelNotFoundException $e) {

            $data=[
                "respuesta"=>"Lista",
                "error"=>"El producto no ha sido encontrado"
            ];
            return response()->json($data);
        }
    }

    /**
     * Actualiza un producto
     */
    public function update(Request $request,$producto_id)
    {
        $request->validate([
            "titulo"=>"required",
            "contenido"=>"required",
            "precio"=>"required",
            "ocasion"=>"required"
        ]);
        try
        {
            $producto = productos::findOrFail($producto_id);
            $producto->titulo = $request->titulo;
            $producto->contenido = $request->contenido;
            $producto->precio = $request->precio;
            $producto->ocasion = $request->ocasion;
            $producto->update();
             $data =[
                 "respuesta"=>"Producto actualizado con éxito",
                 "registrado"=>$producto
             ];
             return response()->json($data);
        }catch(Exception $ex){
            $data=[
                "respuesta"=>"400",
                "error"=>"No se a podido actualizar el producto"
            ];
            return response()->json($data);
        }
    }

    /**
     * Elimina un producto en especifico
     */
    public function destroy($producto_id)
    {
        try{
            $producto=productos::findOrFail($producto_id);
            $producto->Delete();
            $data=[
                "respuesta"=>"producto eliminado",
                "detalle producto"=>$producto
            ];
            return response()->json($data);
        }
        catch(Exception $ex){
            $data=[
                "respuesta"=>"400",
                "error"=>"No se a podido eliminar el producto"
            ];
            return response()->json($data);
        }
    }
}
/*





*/