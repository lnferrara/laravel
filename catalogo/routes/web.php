<?php

use App\Http\Controllers\MarcaController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use App\Models\Producto;
use Illuminate\Support\Facades\Route;
use League\CommonMark\Parser\MarkdownParser;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/',[ProductoController::class,'portada']);

/*EJEMPLO-- MARCAS Route::get('/adminMarcas', [controlador , callback]) */

Route::get('/adminMarcas', [MarcaController::class, 'index']); /* -> muestra todos los datos de la tabla */
Route::get('/agregarMarca', [MarcaController::class, 'create']); /* -> muestra formulario*/
Route::post('/agregarMarca', [MarcaController::class, 'store']); /* -> ingresa datos del formulario y guarda en BBDD*/
Route::get('/modificarMarca/{id}', [MarcaController::class, 'edit']);
Route::patch('/modificarMarca', [MarcaController::class, 'update']);
Route::get('/eliminarMarca/{id}', [MarcaController::class, 'confirmarBaja']);
Route::delete('/eliminarMarca', [MarcaController::class, 'destroy']);



/* CATEGORIAS */

Route::get('/adminCategorias', [CategoriaController::class, 'index']);
Route::get('/agregarCategoria', [CategoriaController::class, 'create']);
Route::post('/agregarCategoria', [CategoriaController::class, 'store']);
Route::get('/modificarCategoria/{id}',[CategoriaController::class,'edit']);


###Productos

Route::get('/adminProductos', [ProductoController::class, 'index']);
Route::get('/agregarProducto', [ProductoController::class, 'create']);
Route::post('/agregarProducto', [ProductoController::class, 'store']);
Route::get('/modificarProducto/{id}', [ProductoController::class, 'edit']);
Route::patch('/modificarProducto', [ProductoController::class, 'update']);
Route::get('/eliminarProducto/{id}', [ProductoController::class, 'confirmarBaja']);
Route::delete('/eliminarProducto', [ProductoController::class, 'destroy']);
