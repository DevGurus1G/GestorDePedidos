<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Pedido;
use App\Models\PedidoFormatoProducto;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view("pedidos.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $productos = Producto::all();
        $clientes = Cliente::all();

        return view("pedidos.create")
            ->with('productos', $productos)
            ->with('clientes', $clientes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Validacion
        $request->validate([
            'fecha' => 'required|date_format:d/m/Y',
        ]);

        $productoId = $request->input('producto_id');
        $fecha = $request->input('fecha');
        $estado = 'solictado';
        $clienteId = $request->input('cliente_id');

        DB::transaction(function () use ($fecha, $estado, $clienteId, $productoId) {
            $pedido = Pedido::create([
                'fecha' => $fecha,
                'estado' => $estado,
                'cliente_id' => $clienteId,
            ]);

            $pedido->formatoProducto()->create([
                'formato_producto_id' => $productoId,
            ]);
        });
    }

    /**
     * Display the specified resource.
     */
    public function show(Pedido $pedido)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pedido $pedido)
    {
        //
        return view("pedidos.edit");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pedido $pedido)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pedido $pedido)
    {
        //
    }
}
