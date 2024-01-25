<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $clientes = Cliente::all();
        return view("clientes.index", ["clientes" => $clientes]);
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
            "codigo_acceso" => "required|max:8"
        ]);
        Cliente::create($validated);
        return redirect(route("clientes.create"))->with("success", "Cliente creado correctamente");
    }

    /**
     * Display the specified resource.
     */
    public function show(Cliente $cliente)
    {
        //
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
            "codigo_acceso" => "required|max:8"
        ]);
        $cliente->update($validated);
        return redirect(route('clientes.show' , ["cliente" => $cliente]))->with("success", "El cliente ha sido actualizado correctamente");
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
