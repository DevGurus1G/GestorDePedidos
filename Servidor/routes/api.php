<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\Api\ClienteControllerApi;
use App\Http\Controllers\Api\FormatoProductoControllerApi;
use App\Http\Controllers\Api\PedidoControllerApi;
use App\Mail\RecuperarMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Clientes ----------------------------------------------------------------
Route::controller(ClienteController::class)->group(function () {
    Route::post('clientes', "store")->name('clientes.store');
    Route::get('clientes/{cliente}', "show")->name('clientes.show');
    Route::delete("clientes/{cliente}", "delete")->name('clientes.delete');
    Route::put("clientes/{cliente}", "update")->name('clientes.update');
});

// FormatoProductos
Route::controller(FormatoProductoControllerApi::class)->group(function () {
    Route::get('productos', "show")->name('formatoProductos.show');
});

// FormatoProductos
Route::controller(ClienteControllerApi::class)->group(function () {
    // Route::get('/login/{codigo}', "show")->name('clienteApi.show');
    // Route::get('/cliente/{codigo}', "show")->name('clienteApi.show');
    // Route::post('/cliente/update/{codigo}', "update");
    Route::post("recuperar", "recuperar");
    // function () {
    //     Mail::to("ikerunai.zambrano@gmail.com")
    //         ->send(new RecuperarMail());
    //     return response()->json(["mensaje" => "Enviado"]);
    // }
});

//Pedidos
Route::controller(PedidoControllerApi::class)->group(function () {
    Route::get('/pedidos/{codigo}', "show")->name('pedidosApi.show');
    Route::post('/pedidos/crear', "store")->name('pedidosApi.store');
});
