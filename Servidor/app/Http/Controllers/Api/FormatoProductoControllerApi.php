<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FormatoProducto;
use Illuminate\Http\Request;

class FormatoProductoControllerApi extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        try {
            $formatoProductos = FormatoProducto::with(['producto.categoria', 'formato', 'imagenes'])->get();

            $data = $formatoProductos->map(function ($formatoProducto) {
                // Obtén las imágenes asociadas al formato de producto
                $imagenes = $formatoProducto->imagenes->map(function ($imagen) {
                    // Convierte el blob de la imagen a Base64
                    return $imagen->imagen;
                });

                return [
                    'id' => $formatoProducto->id,
                    'producto' => $formatoProducto->producto,
                    'formato' => $formatoProducto->formato,
                    'precio' => $formatoProducto->precio,
                    'imagenes' => $imagenes,
                ];
            });

            return response()->json(['success' => true, 'data' => $data]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
