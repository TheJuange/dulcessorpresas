<?php

use App\Http\Controllers\ProductosController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Rutas
|--------------------------------------------------------------------------
|
| Aquí es donde puede registrar rutas API para su aplicación. Estos
| las rutas son cargadas por el RouteServiceProvider y todas ellas
| asignarse al grupo de middleware "api". ¡Haz algo genial!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
/*
----PRODUCTOS-----
*/
//muestra todos los productos
Route::get('/productos',[ProductosController::class,'index']);
//muestra un producto en especifico
Route::get('producto/{producto_id}',[ProductosController::class,'show']);
//registrar un nuevo producto
Route::post('/newproducto',[ProductosController::class,'store']);
//actualiza un producto existente
Route::put('/producto/{producto_id}',[ProductosController::class,'update']);
//elimina un producto
Route::delete('producto/{producto_id}',[ProductosController::class,'destroy']);

/*
----CLIENTES----
*/
//muestra todos los clientes
Route::get('/clientes',[ClientesController::class,'index']);
//muestra un cliente en especifico
Route::get('cliente/{cliente_id}',[ClientesController::class,'show']);
//registrar un nuevo cliente
Route::post('/newcliente',[ClientesController::class,'store']);
//actualiza un cliente existente
Route::put('/cliente/{cliente_id}',[ClientesController::class,'update']);
//elimina un cliente
Route::delete('cliente/{cliente_id}',[ClientesController::class,'destroy']);
