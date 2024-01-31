<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Cliente;
use App\Models\FormatoProducto;
use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        switch (Auth::user()->rol) {
            case 'comercial':
                $pedidosSolicitados = Pedido::where('estado', 'solicitado')->get();
                $pedidosEnPreparacion = Pedido::where('estado', 'en_preparacion')->get();
                $pedidosEnEntrega = Pedido::where('estado', 'en_entrega')->get();
                $pedidosEntregados = Pedido::where('estado', 'entregado')->get();

                return view('home', [
                    'pedidosSolicitados' => $pedidosSolicitados,
                    'pedidosEnPreparacion' => $pedidosEnPreparacion,
                    'pedidosEnEntrega' => $pedidosEnEntrega,
                    'pedidosEntregados' => $pedidosEntregados,
                ]);
                break;

            case 'administrativo':

                $clientes = Cliente::all();
                $productos = FormatoProducto::all();
                $categorias = Categoria::all();

                return view('home', [
                    'clientes' => $clientes,
                    'productos' => $productos,
                    'categorias' => $categorias,
                ]);

                break;
            default:
                return view('home');
                break;
        }
    }
}
