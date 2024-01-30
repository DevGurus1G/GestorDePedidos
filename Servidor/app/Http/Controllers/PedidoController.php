<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\FormatoProducto;
use App\Models\Pedido;
use App\Models\PedidoFormatoProducto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $pedidoFormatoProductos = PedidoFormatoProducto::all();
        // dd($pedidoFormatoProductos[0]->formatoproducto()->first()->producto->nombre);
        return view('pedidos.index', ["pedidoFormatoProductos" => $pedidoFormatoProductos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $formatoproductos = FormatoProducto::all();
        $clientes = Cliente::all();

        return view("pedidos.create", [
            "formatoproductos" => $formatoproductos,
            "clientes" => $clientes
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        //Validacion
        $validated = $request->validate([
            'formato_producto_id' => 'required',
            'cliente_id' => 'required',
            'fecha' => 'required',
        ]);
        $estado = 'solicitado';

        // Crear el pedido 

        $pedido = Pedido::create([
            "cliente_id" => $validated["cliente_id"],
            "fecha" => $validated["fecha"],
            "estado" => $estado
        ]);

        // Crear los PedidoFormatoProducto

        $formatoproducto = FormatoProducto::find($validated["formato_producto_id"]);

        $pedidoFormatoProducto = PedidoFormatoProducto::create([
            "pedido_id" => $pedido->id,
            "formato_producto_id" => $formatoproducto->id
        ]);

        return redirect(route("pedidos.index"));
    }

    /**
     * Display the specified resource.
     */
    public function show(PedidoFormatoProducto $pedidoFormatoProducto)
    {
        return view('pedidos.show', ["pedido" => $pedidoFormatoProducto]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pedido $pedido)
    {
        //
        return view("pedidos.edit", ['pedido' => $pedido]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pedido $pedido)
    {
        $validated = $request->validate([
            'fecha' => 'required',
            'estado' => 'required'
        ]);

        $pedido->update($validated);

        return redirect(route("pedidos.show", ["pedido" => $pedido]))->with("success", "Pedido actualizado correctamente");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pedido $pedido)
    {
        //
        $pedido->delete();
        return redirect()->route('pedidos.index');
    }
}
