<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\FormatoProducto;
use App\Models\Pedido;
use App\Models\PedidoFormatoProducto;
use Illuminate\Http\Request;


class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $pedidos = Pedido::all();
        // dd($pedidos[0]->pedidoformatoproducto->id);
        // dd($pedidos[0]->pedidoformatoproducto->first()->id);
        return view('pedidos.index', ["pedidos" => $pedidos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Pedido $pedido)
    {
        //
        $formatoproductos = FormatoProducto::all();
        $clientes = Cliente::all();

        return view("pedidos.create", [
            "formatoproductos" => $formatoproductos,
            "clientes" => $clientes,
            "pedido" => $pedido
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
            'cantidad' => 'required',
            'mas_productos' => 'required',
        ]);
        $estado = 'solicitado';

        // Crear el pedido 

        $pedido = Pedido::create([
            "cliente_id" => $validated["cliente_id"],
            "fecha" => $validated["fecha"],
            "estado" => $estado,
        ]);

        // Crear los PedidoFormatoProducto

        $formatoproducto = FormatoProducto::find($validated["formato_producto_id"]);

        PedidoFormatoProducto::create([
            "pedido_id" => $pedido->id,
            "formato_producto_id" => $formatoproducto->id,
            "cantidad" => $validated["cantidad"]
        ]);

        if ($validated["mas_productos"] == true) {
            return redirect(route("pedidos.create", ["pedido" => $pedido]));
        } else {
            return redirect(route("pedidos.index"));
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Pedido $pedido)
    {
        return view('pedidos.show', ["pedido" => $pedido]);
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
