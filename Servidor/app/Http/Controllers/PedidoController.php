<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\FormatoProducto;
use App\Models\Pedido;
use App\Models\PedidoFormatoProducto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PedidoController extends Controller
{
    /**
     * Listar Pedidos.
     */
    public function index(Request $request)
    {
        $query = Pedido::query();

        // Filtros
        if ($request->filled('producto')) {
            $query->whereHas('pedidoformatoproducto.formatoproducto.producto', function ($subQuery) use ($request) {
                $subQuery->where('nombre', 'like', '%' . $request->input('producto') . '%');
            });
        }

        if ($request->filled('cliente')) {
            $query->whereHas('cliente', function ($subQuery) use ($request) {
                $subQuery->where('nombre', 'like', '%' . $request->input('cliente') . '%')
                    ->orWhere('dni', 'like', '%' . $request->input('cliente') . '%');
            });
        }

        $pedidos = $query->with(['cliente', 'pedidoformatoproducto.formatoproducto.producto'])->simplePaginate(10);
        return view('pedidos.index', compact('pedidos'));
    }

    /**
     * Mostrar formulario de crear nuevo Pedido.
     */
    public function create()
    {
        $formatoproductos = FormatoProducto::all();
        $clientes = Cliente::all();
        if (session("pedido")) {
            return view("pedidos.create", [
                "formatoproductos" => $formatoproductos,
                "clientes" => $clientes,
                "pedido" => session("pedido"),
            ]);
        } else {

            return view("pedidos.create", [
                "formatoproductos" => $formatoproductos,
                "clientes" => $clientes,
            ]);
        }
    }

    /**
     * Realizar la create de el nuevo Pedido.
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
            'pedido_id' => 'nullable',
        ]);
        $estado = 'solicitado';

        // Crear el pedido 
        if (!isset($validated["pedido_id"])) {
            $pedido = Pedido::create([
                "cliente_id" => $validated["cliente_id"],
                "fecha" => $validated["fecha"],
                "estado" => $estado,
            ]);
        }

        // Crear los PedidoFormatoProducto
        $formatoproducto = FormatoProducto::find($validated["formato_producto_id"]);
        if (isset($validated["pedido_id"])) {
            PedidoFormatoProducto::create([
                "pedido_id" => $validated["pedido_id"],
                "formato_producto_id" => $formatoproducto->id,
                "cantidad" => $validated["cantidad"]
            ]);
        } else {
            PedidoFormatoProducto::create([
                "pedido_id" => $pedido->id,
                "formato_producto_id" => $formatoproducto->id,
                "cantidad" => $validated["cantidad"]
            ]);
        }

        if ($validated["mas_productos"] == "true") {
            $pedido = Pedido::latest()->first();
            return redirect(route("pedidos.create"))->with("pedido", $pedido);
        } else {
            return redirect(route("pedidos.index"));
        }
    }

    /**
     * Mostrar la información de un Pedido en especifico.
     */
    public function show(Pedido $pedido)
    {
        return view('pedidos.show', ["pedido" => $pedido]);
    }

    /**
     * Mostrar formulario de actualizar Pedido.
     */
    public function edit(Pedido $pedido)
    {
        return view("pedidos.edit", ['pedido' => $pedido]);
    }

    /**
     * Realizar el update de el Pedido seleccionado.
     */
    public function update(Request $request, Pedido $pedido)
    {
        //Validación de datos.
        $validated = $request->validate([
            'fecha' => 'required',
            'estado' => 'required'
        ]);

        $pedido->update($validated);
        return redirect(route("pedidos.show", ["pedido" => $pedido]))->with("success", "Pedido actualizado correctamente");
    }

    /**
     * Eliminar el FormatoProductoImagen seleccionado.
     */
    public function destroy(Pedido $pedido)
    {
        $pedido->delete();
        return redirect()->route('pedidos.index');
    }
}
