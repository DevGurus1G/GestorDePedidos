<?php

namespace App\Http\Controllers;

use App\Models\FormatoProductoImagen;
use Illuminate\Http\Request;

class FormatoProductoImagenController extends Controller
{
    /**
     * Listar FormatoProductoImagenes.
     */
    public function index()
    {
        //Vacío.
    }

    /**
     * Mostrar formulario de crear nuevo FormatoProductoImagen.
     */
    public function create()
    {
        //Vacío.
    }

    /**
     * Realizar la create de el nuevo FormatoProductoImagen.
     */
    public function store(Request $request)
    {
        //Vacío.
    }

    /**
     * Mostrar la información de un FormatoProductoimagen en especifico.
     */
    public function show(string $id)
    {
        //Vacío.
    }

    /**
     * Mostrar formulario de actualizar FormatoProductoImagen.
     */
    public function edit(string $id)
    {
        //Vacío.
    }

    /**
     * Realizar el update de el FormatoProductoImagen seleccionado.
     */
    public function update(Request $request, string $formatoProductImagen)
    {
        $imagen = FormatoProductoImagen::find($formatoProductImagen);

        //Validación de datos.
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
     * Eliminar el FormatoProductoImagen seleccionado.
     */
    public function destroy(string $formatoProductoImagen)
    {
        FormatoProductoImagen::destroy($formatoProductoImagen);
        return redirect(route("formatoproductos.index"));
    }
}
