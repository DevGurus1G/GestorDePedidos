<?php

use App\Http\Controllers\ClienteController;
use Illuminate\Http\Request;
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

// Productos
