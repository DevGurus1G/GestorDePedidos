<?php

namespace App\Http\Controllers;

use App\Models\Formato;
use Illuminate\Http\Request;

class FormatoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $formatos = Formato::all();
        return view('formatos.index', ["formatos" => $formatos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('formatos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            "tipo" => "required|max:255",
        ]);

        Formato::create($validated);
        return redirect(route("formatos.create"))->with("success", "Formato creado correctamente");
    }

    /**
     * Display the specified resource.
     */
    public function show(Formato $formato)
    {
        //
        return view('formatos.show', ["formato" => $formato]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Formato $formato)
    {
        //
        return view('formatos.edit', ["formato" => $formato]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Formato $formato)
    {
        //
        $validated = $request->validate([
            "tipo" => "required|max:255",
        ]);

        $formato->update($validated);
        return redirect(route("formatos.show", ["formato" => $formato]))->with("success", "Formato actualizado correctamente");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Formato $formato)
    {
        //
        $formato->delete();
        return redirect(route("formatos.index"));
    }
}
