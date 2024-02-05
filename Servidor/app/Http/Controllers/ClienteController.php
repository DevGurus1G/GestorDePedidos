<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Listar Clientes.
     */
    public function index(Request $request)
    {
        $query = Cliente::query();

        // Aplicar filtros
        if ($request->filled('nombre')) {
            $query->where('nombre', 'like', '%' . $request->input('nombre') . '%');
        }

        if ($request->filled('dni')) {
            $query->where('dni', 'like', '%' . $request->input('dni') . '%');
        }

        $clientes = $query->simplePaginate(10);

        return view('clientes.index', compact('clientes'));
    }


    /**
     * Mostrar formulario de crear nuevo Cliente.
     */
    public function create()
    {
        return view("clientes.create");
    }

    /**
     * Realizar la create de el nuevo Cliente.
     */
    public function store(Request $request)
    {
        //Validación de datos.
        $validated = $request->validate([
            "nombre" => "required|max:255",
            "dni" => "required|max:9",
            "codigo_acceso" => "required|max:8",
            "calle" => "required|max:255"
        ]);

        Cliente::create($validated);
        return redirect(route("clientes.create"))->with("success", "Cliente creado correctamente");
    }

    /**
     * Mostrar la información de un Cliente en especifico.
     */
    public function show(Cliente $cliente)
    {
        return view("clientes.show", ["cliente" => $cliente]);
    }

    /**
     * Mostrar formulario de actualizar Cliente.
     */
    public function edit(Cliente $cliente)
    {
        return view("clientes.edit", ["cliente" => $cliente]);
    }

    /**
     * Realizar el update de el Cliente seleccionado.
     */
    public function update(Request $request, Cliente $cliente)
    {
        //Validación de datos.
        $validated = $request->validate([
            "nombre" => "required|max:255",
            "dni" => "required|min:9|max:9",
            "codigo_acceso" => "required|max:8",
            "calle" => "required|max:255"

        ]);

        $cliente->update($validated);
        return redirect(route("clientes.create"))->with("success", "Cliente actualizado correctamente");
    }

    /**
     * Eliminar el Cliente seleccionado.
     */
    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
        return redirect(route("clientes.index"));
    }
}
