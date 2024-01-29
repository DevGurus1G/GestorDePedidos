<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\FormatoController;
use App\Http\Controllers\FormatoProductoController;
use App\Http\Controllers\FormatoProductoImagenController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::controller(ProductoController::class)->group(function () {
    Route::get('productos', "index")->name('productos.index');
    Route::post('productos', "store")->name('productos.store');
    Route::get("productos/create", "create")->name('productos.create');
    Route::get('productos/{producto}', "show")->name('productos.show');
    Route::delete("productos/{producto}", "destroy")->name('productos.destroy');
    Route::get('productos/{producto}/edit', "edit")->name('productos.edit');
    Route::put("productos/{producto}", "update")->name('productos.update');
});

Route::controller(FormatoController::class)->group(function () {
    Route::get('formatos', "index")->name('formatos.index');
    Route::post('formatos', "store")->name('formatos.store');
    Route::get("formatos/create", "create")->name('formatos.create');
    Route::get('formatos/{formato}', "show")->name('formatos.show');
    Route::delete("formatos/{formato}", "destroy")->name('formatos.destroy');
    Route::get('formatos/{formato}/edit', "edit")->name('formatos.edit');
    Route::put("formatos/{formato}", "update")->name('formatos.update');
});

Route::controller(PedidoController::class)->group(function () {
    Route::get('pedidos', "index")->name('pedidos.index');
    Route::post('pedidos', "store")->name('pedidos.store');
    Route::get("pedidos/create", "create")->name('pedidos.create');
    Route::get('pedidos/{pedido}', "show")->name('pedidos.show');
    Route::delete("pedidos/{pedido}", "destroy")->name('pedidos.destroy');
    Route::get('pedidos/{pedido}/edit', "edit")->name('pedidos.edit');
    Route::put("pedidos/{pedido}", "update")->name('pedidos.update');
});
// Cliente ----------------------------------------------------------------
Route::controller(ClienteController::class)->group(function () {
    Route::get('clientes', "index")->name('clientes.index');
    Route::post('clientes', "store")->name('clientes.store');
    Route::get("clientes/create", "create")->name('clientes.create');
    Route::get('clientes/{cliente}', "show")->name('clientes.show');
    Route::delete("clientes/{cliente}", "destroy")->name('clientes.destroy');
    Route::get('clientes/{cliente}/edit', "edit")->name('clientes.edit');
    Route::put("clientes/{cliente}", "update")->name('clientes.update');
});
// Categoria ----------------------------------------------------------------

Route::controller(CategoriaController::class)->group(function () {
    Route::get('categorias', "index")->name('categorias.index');
    Route::post('categorias', "store")->name('categorias.store');
    Route::get("categorias/create", "create")->name('categorias.create');
    Route::get('categorias/{categoria}', "show")->name('categorias.show');
    Route::delete("categorias/{categoria}", "destroy")->name('categorias.destroy');
    Route::get('categorias/{categoria}/edit', "edit")->name('categorias.edit');
    Route::put("categorias/{categoria}", "update")->name('categorias.update');
});

// ProductoFormato ----------------------------------------------------------

Route::controller(FormatoProductoController::class)->group(function () {
    Route::get('formatoproductos', "index")->name('formatoproductos.index');
    Route::post('formatoproductos', "store")->name('formatoproductos.store');
    Route::get("formatoproductos/create", "create")->name('formatoproductos.create');
    Route::get('formatoproductos/{formatoproducto}', "show")->name('formatoproductos.show');
    Route::delete("formatoproductos/{formatoproducto}", "destroy")->name('formatoproductos.destroy');
    Route::get('formatoproductos/{formatoproducto}/edit', "edit")->name('formatoproductos.edit');
    Route::put("formatoproductos/{formatoproducto}", "update")->name('formatoproductos.update');
});

// Users ----------------------------------------------------------

Route::controller(UserController::class)->group(function () {
    Route::get('users', "index")->name('users.index');
    Route::post('users', "store")->name('users.store');
    Route::get("users/create", "create")->name('users.create');
    Route::get('users/{user}', "show")->name('users.show');
    Route::delete("users/{user}", "destroy")->name('users.destroy');
    Route::get('users/{user}/edit', "edit")->name('users.edit');
    Route::put("users/{user}", "update")->name('users.update');
});


// Para las imagenes --------------------------------------------------------

Route::controller(FormatoProductoImagenController::class)->group(function () {
    Route::delete('productos_imagenes/{imagen}', "destroy")->name('productos_imagenes.destroy');
});