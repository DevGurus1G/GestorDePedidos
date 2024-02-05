<?php

namespace App\Http\Controllers;

use App\Models\Formato;
use Illuminate\Http\Request;

class FormatoController extends Controller
{
    /**
     * Listar Formatos.
     */
    public function index()
    {
        $formatos = Formato::all();
        return view('formatos.index', ["formatos" => $formatos]);
    }

    /**
     * Mostrar formulario de crear nuevo Formato.
     */
    public function create()
    {
        return view('formatos.create');
    }

    /**
     * Realizar la create de el nuevo Formato.
     */
    public function store(Request $request)
    {
        //Validación de datos.
        $validated = $request->validate([
            "tipo" => "required|max:255",
        ]);

        Formato::create($validated);
        return redirect(route("formatos.create"))->with("success", "Formato creado correctamente");
    }

    /**
     * Mostrar la información de un Cliente en especifico.
     */
    public function show(Formato $formato)
    {
        return view('formatos.show', ["formato" => $formato]);
    }

    /**
     * Mostrar formulario de actualizar Cliente.
     */
    public function edit(Formato $formato)
    {
        return view('formatos.edit', ["formato" => $formato]);
    }

    /**
     * Realizar el update de el Cliente seleccionado.
     */
    public function update(Request $request, Formato $formato)
    {
        //Validación de datos.
        $validated = $request->validate([
            "tipo" => "required|max:255",
        ]);

        $formato->update($validated);
        return redirect(route("formatos.show", ["formato" => $formato]))->with("success", "Formato actualizado correctamente");
    }

    /**
     * Eliminar el Cliente seleccionado.
     */
    public function destroy(Formato $formato)
    {
        $formato->delete();
        return redirect(route("formatos.index"));
    }
}
