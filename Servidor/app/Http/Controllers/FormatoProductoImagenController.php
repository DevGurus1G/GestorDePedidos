<?php

namespace App\Http\Controllers;

use App\Models\FormatoProductoImagen;
use Illuminate\Http\Request;

class FormatoProductoImagenController extends Controller
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
    public function show(string $id)
    {
        //
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
    public function update(Request $request, string $formatoProductImagen)
    {
        //

        $imagen = FormatoProductoImagen::find($formatoProductImagen);
        $validated = $request->validate([
            "imagen" => "required"
        ]);
        $binaryData = file_get_contents($request->file("imagen"));
        $base64 = base64_encode($binaryData);
        $imagen->update([
            "imagen" => $base64
        ]);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $formatoProductoImagen)
    {
        //
        FormatoProductoImagen::destroy($formatoProductoImagen);
        return redirect(route("formatoproductos.index"));
    }
}
