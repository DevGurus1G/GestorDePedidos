<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $productos = Producto::all();
        return view("productos.index", ["productos" => $productos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categorias = Categoria::all();
        return view("productos.create", ["categorias" => $categorias]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            "nombre" => "required|max:255",
            "categoria_id" => "required|exists:categorias,id",
        ]);

        $producto = new Producto([
            'nombre' => $request->input('nombre'),
        ]);

        $categoria = Categoria::find($request->input('categoria_id'));

        $categoria->productos()->save($producto);

        return redirect()->route('productos.create')->with('success', 'Producto creado exitosamente.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        //
        $categorias = Categoria::all();
        return view('productos.show', ["producto" => $producto, "categorias" => $categorias]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
        //
        $categorias = Categoria::all();

        return view("productos.edit", ["producto" => $producto, "categorias" => $categorias]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Producto $producto)
    {
        $validated = $request->validate([
            "nombre" => "required|max:255",
            "categoria_id" => "required|exists:categorias,id",
        ]);

        $producto->update([
            'nombre' => $request->input('nombre'),
        ]);

        if ($producto->categoria_id != $request->input('categoria_id')) {
            $categoria = Categoria::find($request->input('categoria_id'));
            $producto->categoria()->associate($categoria);
            $producto->save();
        }

        return redirect()->route('productos.show', $producto)->with('success', 'Producto actualizado exitosamente.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        //
        $producto->delete();
        return redirect()->route('productos.index');
    }


}
