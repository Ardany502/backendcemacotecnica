<?php

use App\Http\Controllers\ControllerImagenes;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\UsuariosController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/////Usuarios
Route::get('/listarusuarios', [UsuariosController::class, 'getListarUsuarios']);
Route::post('/crearusuario', [UsuariosController::class, 'postCrearUsuario']);
Route::put('/actualizarusuario/{id}', [UsuariosController::class, 'putActualizarUsuario']);
Route::delete('/eliminarusuario/{id}', [UsuariosController::class, 'deleteEliminar']);


//Productos
Route::get('/listarproductos', [ProductosController::class, 'getListarProductos']);
Route::get('/listarproductosminimos', [ProductosController::class, 'getListarProductosMinimos']);
Route::get('/listarproducto/{id}', [ProductosController::class, 'getInformacionProducto']);
Route::post('/crearproducto', [ProductosController::class, 'postCrearProductos']);
Route::put('/actualizarproducto/{id}', [ProductosController::class, 'putActualizarProductos']);
Route::delete('/eliminarproductos/{id}', [ProductosController::class, 'deleteEliminarProductos']);


//Subida de Imagenes
Route::post('/subirImagen', [ControllerImagenes::class, 'postSubirimagen']);
