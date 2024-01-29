<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Formato;
use App\Models\Pedido;
use App\Models\PedidoFormatoProducto;
use App\Models\Producto;
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
        return view('pedidos.index', ["pedidoFormatoProductos" => $pedidoFormatoProductos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $productos = Producto::all();
        $clientes = Cliente::all();
        $formatos = Formato::all();

        return view("pedidos.create")
            ->with('productos', $productos)
            ->with('clientes', $clientes)
            ->with('formatos', $formatos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        //Validacion
        $request->validate([
            'producto_id' => 'required',
            'formato_id' => 'required',
            'cliente_id' => 'required',
            'fecha' => 'required',
        ]);


        $productoId = $request->input('producto_id');
        $fecha = $request->input('fecha');
        $estado = 'solicitado';
        $clienteId = $request->input('cliente_id');
        $formatoId = $request->input('formato_id');

        // Obtener el id de FormatoPedido
        $formatoPedidoId = DB::table('formato_producto')
            ->where('producto_id', $productoId)
            ->where('formato_id', $formatoId)
            ->value('id');

        if ($formatoPedidoId) {

            DB::transaction(function () use ($fecha, $estado, $clienteId, $formatoPedidoId) {
                $pedido = Pedido::create([
                    'fecha' => $fecha,
                    'estado' => $estado,
                    'cliente_id' => $clienteId,
                ]);

                $pedido->pedidoformatoproducto()->create([
                    'formato_producto_id' => $formatoPedidoId,
                ]);
            });

            return redirect()->route('pedidos.index');
        } else {
            return redirect()->route('pedidos.create')->with('error', 'El producto que seleccionaste no esta en ese formato.');
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
