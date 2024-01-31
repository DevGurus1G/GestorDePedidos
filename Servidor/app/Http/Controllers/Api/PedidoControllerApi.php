<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Pedido;
use App\Models\PedidoFormatoProducto;
use Exception;
use Illuminate\Http\Request;

class PedidoControllerApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            //Validacion
            // $validated = $request->validate([
            //     'formato_productos' => 'required',
            //     'cliente' => 'required',
            //     'cantidad' => 'required',
            // ]);


            $estado = 'solicitado';

            // Obtener el cliente por código
            $cliente = Cliente::where('codigo_acceso', $request["cliente"])->firstOrFail();


            //Crear el pedido
            $pedido = Pedido::create([
                "cliente_id" => $cliente->id,
                "fecha" => now(),
                "estado" => $estado,
            ]);

            // Crear los PedidoFormatoProducto, bucle porque pueden ser varios productos para el mismo pedido
            foreach ($request["productos"] as $prod) {
                PedidoFormatoProducto::create([
                    "pedido_id" => $pedido->id,
                    "formato_producto_id" => $prod["formato_productos"],
                    "cantidad" => $prod["cantidad"],
                ]);
            }


            return response()->json(['success' => true, 'message' => "Creado correctamente"]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => "Error al crear"]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($codigo)
    {
        try {
            // Obtener el cliente por código
            $cliente = Cliente::where('codigo_acceso', $codigo)->firstOrFail();

            // Obtener todos los pedidos del cliente con sus relaciones
            $pedidos = Pedido::with([
                'cliente',
                'pedidoformatoproducto.formatoproducto.producto.categoria',
                'pedidoformatoproducto.formatoproducto.formato',
                'pedidoformatoproducto.formatoproducto.imagenes'
            ])->where('cliente_id', $cliente->id)->get();

            $result = $pedidos->map(function ($pedido) {
                return [
                    'id_pedido' => $pedido->id,
                    'fecha' => $pedido->fecha,
                    'estado' => $pedido->estado,
                    'cliente' => [
                        'id' => $pedido->cliente->id,
                        'nombre' => $pedido->cliente->nombre,
                        'dni' => $pedido->cliente->dni,
                        'codigo_acceso' => $pedido->cliente->codigo_acceso,
                    ],
                    'detalles' => $pedido->pedidoformatoproducto->map(function ($detalle) {
                        return [
                            'formato_producto_id' => $detalle->formatoproducto->id,
                            'pedido_id' => $detalle->pedido_id,
                            'cantidad' => $detalle->cantidad,
                            'formato' => $detalle->formatoproducto->formato->tipo ?? null,
                            'producto' => [
                                'id' => $detalle->formatoproducto->producto->id ?? null,
                                'nombre' => $detalle->formatoproducto->producto->nombre ?? null,
                                'categoria' => $detalle->formatoproducto->producto->categoria->nombre ?? null,
                            ],
                            'precio' => (float)$detalle->formatoproducto->precio ?? null,
                            'disponibilidad' => (bool)$detalle->formatoproducto->disponibilidad ?? null,
                            'imagenes' => $detalle->formatoproducto->imagenes->pluck('imagen_path')->toArray(),
                        ];
                    }),
                ];
            });

            return response()->json(['success' => true, 'data' => $result]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cliente $cliente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $codigo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cliente $cliente)
    {
        //
    }
}
