<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
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

        // Pasa los productos a la vista
        return view('clientes.index', compact('clientes'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view("clientes.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

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
     * Display the specified resource.
     */
    public function show(Cliente $cliente)
    {
        return view("clientes.show", ["cliente" => $cliente]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cliente $cliente)
    {
        //
        return view("clientes.edit", ["cliente" => $cliente]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cliente $cliente)
    {
        //
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
     * Remove the specified resource from storage.
     */
    public function destroy(Cliente $cliente)
    {
        //
        $cliente->delete();
        return redirect(route("clientes.index"));
    }
}
