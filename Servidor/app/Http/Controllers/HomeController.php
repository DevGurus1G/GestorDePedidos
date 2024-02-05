<?php

namespace App\Http\Controllers;

use App\Charts\Estadistica;
use App\Models\Categoria;
use App\Models\Cliente;
use App\Models\FormatoProducto;
use App\Models\Pedido;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
     * * Mostrar el Home de la pagina.
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
            case 'responsable':

                DB::statement("SET lc_time_names = 'es_ES'");

                // Mostrar estadisticas  de Productos por Pedido

                $chartPP = new Estadistica;

                $pedidoProducto = DB::table('VistaProductosPorPedido')->limit(10)->get();

                $etiquetas = $pedidoProducto->map(function ($item) {
                    return '';
                });

                $chartPP->labels($etiquetas);

                $datos = $pedidoProducto->pluck('cantidad_pedidos')->toArray();

                $chartPP->dataset("Productos más Pedido", "bar", $datos)->color('black');


                // Mostrar estadisticas de Ingresos por Mes

                $chartIM = new Estadistica;

                $ingresosMes = DB::table('VistaIngresosPorMes')->get();

                $etiquetas = $ingresosMes->map(function ($item) {
                    return $item->mes;
                });

                $chartIM->labels($etiquetas);

                $datos = $ingresosMes->pluck('ingresos')->toArray();

                $chartIM->dataset("Ingresos por Mes", "line", $datos)->color('black');

                // Mostrar estadisticas de Pedidos por Mes

                $chartPM = new Estadistica;

                $pedidosMes = DB::table('VistaPedidosPorMes')->get();

                $etiquetas = $pedidosMes->map(function ($item) {
                    return $item->mes;
                });

                $chartPM->labels($etiquetas);

                $datos = $pedidosMes->pluck('cantidad_pedidos')->toArray();

                $chartPM->dataset("Pedidos por Mes", "doughnut", $datos)->color('black');

                DB::statement("SET lc_time_names = 'en_US'");

                return view('home', compact('chartPP', 'chartIM', 'chartPM'));

                break;
            default:
                return view('home');
                break;
        }
    }
}
