<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Listar Categorías.
     */
    public function index(Request $request)
    {
        $query = Categoria::query();

        // Aplicar filtros
        if ($request->filled('nombre')) {
            $query->where('nombre', 'like', '%' . $request->input('nombre') . '%');
        }

        $categorias = $query->simplePaginate(10);

        return view('categorias.index', compact('categorias'));
    }

    /**
     * Mostrar formulario de crear nueva Categoría.
     */
    public function create()
    {
        return view('categorias.create');
    }

    /**
     * Realizar la create de la nueva Categoría.
     */
    public function store(Request $request)
    {
        //Validación de datos.
        $validated = $request->validate([
            "nombre" => "required|max:255",
        ]);

        Categoria::create($validated);
        return redirect(route("categorias.create"))->with('success', 'Categoria creada correctamente');
    }

    /**
     * Mostrar la información de una Categoría en especifico.
     */
    public function show(Categoria $categoria)
    {
        return view("categorias.show", ["categoria" => $categoria]);
    }

    /**
     * Mostrar formulario de actualizar Categoría.
     */
    public function edit(Categoria $categoria)
    {
        return view('categorias.edit', ["categoria" => $categoria]);
    }

    /**
     * Realizar el update de la Categoría seleccionada.
     */
    public function update(Request $request, Categoria $categoria)
    {
        //Validación de datos.
        $validated = $request->validate([
            "nombre" => "required|max:255",
        ]);

        $categoria->update($validated);
        return redirect(route('categorias.show', $categoria))->with("success", "Categoria actualizada correctamente");
    }

    /**
     * Eliminar la Categoría seleccionada.
     */
    public function destroy(Categoria $categoria)
    {
        $categoria->delete();
        return redirect(route('categorias.index'));
    }
}
