<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Listar Productos.
     */
    public function index()
    {
        $productos = Producto::all();
        return view("productos.index", ["productos" => $productos]);
    }

    /**
     * Mostrar formulario de crear nuevo Producto.
     */
    public function create()
    {
        $categorias = Categoria::all();
        return view("productos.create", ["categorias" => $categorias]);
    }

    /**
     * Realizar la create de el nuevo Producto.
     */
    public function store(Request $request)
    {
        //Validación de datos.
        $validated = $request->validate([
            "nombre" => "required|max:255",
            "categoria_id" => "required|exists:categorias,id",
        ]);

        //Create del nombre
        $producto = new Producto([
            'nombre' => $validated['nombre'],
        ]);

        //create de la categoría.
        $categoria = Categoria::find($request->input('categoria_id'));

        $categoria->productos()->save($producto);

        return redirect()->route('productos.create')->with('success', 'Producto creado exitosamente.');
    }


    /**
     * Mostrar la información de un Producto en especifico.
     */
    public function show(Producto $producto)
    {
        $categorias = Categoria::all();
        return view('productos.show', ["producto" => $producto, "categorias" => $categorias]);
    }

    /**
     * Mostrar formulario de actualizar Producto.
     */
    public function edit(Producto $producto)
    {
        $categorias = Categoria::all();
        return view("productos.edit", ["producto" => $producto, "categorias" => $categorias]);
    }

    /**
     * Realizar el update de el Producto seleccionado.
     */
    public function update(Request $request, Producto $producto)
    {
        //Validacion de datos.
        $validated = $request->validate([
            "nombre" => "required|max:255",
            "categoria_id" => "required|exists:categorias,id",
        ]);

        //Update del nombre del producto.
        $producto->update([
            'nombre' => $validated['nombre'],
        ]);

        //Update de la categría del producto.
        if ($producto->categoria_id != $request->input('categoria_id')) {
            $categoria = Categoria::find($request->input('categoria_id'));
            $producto->categoria()->associate($categoria);
            $producto->save();
        }

        return redirect()->route('productos.show', $producto)->with('success', 'Producto actualizado exitosamente.');
    }


    /**
     * Eliminar el Producto seleccionado.
     */
    public function destroy(Producto $producto)
    {
        $producto->delete();
        return redirect()->route('productos.index');
    }
}
