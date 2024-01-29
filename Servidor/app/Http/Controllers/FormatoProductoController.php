<?php

namespace App\Http\Controllers;

use App\Models\Formato;
use App\Models\FormatoProducto;
use App\Models\FormatoProductoImagen;
use App\Models\Producto;
use Illuminate\Http\Request;

class FormatoProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        // $query = FormatoProducto::query();

        // if ($request->filled('formato')) {
        //     $query->where('formato_id', 'like', '%' . $request->input('formato') . '%');
        // }

        // if ($request->filled('producto')) {
        //     $query->where('producto_id', 'like', '%' . $request->input('producto') . '%');
        // }


        $formatoproductos = FormatoProducto::simplePaginate(8);
        return view("formatoproductos.index", compact("formatoproductos"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $productos = Producto::all();
        $formatos = Formato::all();
        return view("formatoproductos.create", [
            "productos" => $productos,
            "formatos" => $formatos
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            "producto_id" => "required|exists:productos,id",
            "formato_id" => "required|exists:formatos,id",
            "precio" => "required|numeric",
            "imagenes" => "required"
        ]);
        if ($request->input("disponibilidad") == true) {
            $formatoproducto = new FormatoProducto([
                'precio' => $request->input('precio'),
                'disponibilidad' => $request->input('disponibilidad')
            ]);
        } else {
            $formatoproducto = new FormatoProducto([
                'precio' => $request->input('precio'),
                'disponibilidad' => false
            ]);
        }

        $producto = Producto::find($request->input("producto_id"));
        $formato = Formato::find($request->input("formato_id"));

        $formatoproducto->producto()->associate($producto);
        $formatoproducto->formato()->associate($formato);

        $formatoproducto->save();
        // dd($request->file("imagenes"));
        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $imagen) {
                $binaryData = file_get_contents($imagen);
                $base64 = base64_encode($binaryData);
                FormatoProductoImagen::create([
                    'formato_producto_id' => $formatoproducto->id,
                    'imagen' => $base64,
                ]);
            }
        }
        return redirect(route("formatoproductos.index"));
    }

    /**
     * Display the specified resource.
     */
    public function show(FormatoProducto $formatoproducto)
    {
        //
        $productos = Producto::all();
        $formatos = Formato::all();
        return view('formatoproductos.show', ["formatoproducto" => $formatoproducto, "formatos" => $formatos, "productos" => $productos]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FormatoProducto $formatoproducto)
    {
        //
        $productos = Producto::all();
        $formatos = Formato::all();
        return view('formatoproductos.edit', ["formatoproducto" => $formatoproducto, "formatos" => $formatos, "productos" => $productos]);
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
