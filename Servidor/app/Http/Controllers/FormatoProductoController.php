<?php

namespace App\Http\Controllers;

use App\Models\Formato;
use App\Models\FormatoProducto;
use App\Models\FormatoProductoImagen;
use App\Models\Producto;
use Illuminate\Http\Request;

class FormatoProductoController extends Controller
{
    /**
     * Listar FormatosProducto.
     */
    public function index(Request $request)
    {

        $query = FormatoProducto::query();

        //Filtros.
        if ($request->filled('formato')) {
            $query->where(function ($subquery) use ($request) {
                $subquery->whereHas('formato', function ($q) use ($request) {
                    $q->where('tipo', 'like', '%' . $request->input('formato') . '%');
                });
            });
        }

        if ($request->filled('producto')) {
            $query->where(function ($subquery) use ($request) {
                $subquery->whereHas('producto', function ($q) use ($request) {
                    $q->where('nombre', 'like', '%' . $request->input('producto') . '%');
                });
            });
        }

        $formatoproductos = $query->simplePaginate(10);
        return view("formatoproductos.index", compact("formatoproductos"));
    }

    /**
     * Mostrar formulario de crear nuevo FormatoProducto.
     */
    public function create()
    {
        $productos = Producto::all();
        $formatos = Formato::all();
        return view("formatoproductos.create", [
            "productos" => $productos,
            "formatos" => $formatos
        ]);
    }

    /**
     * Realizar la create de el nuevo FormatoProducto.
     */
    public function store(Request $request)
    {
        //Validación de datos.
        $validated = $request->validate([
            "producto_id" => "required|exists:productos,id",
            "formato_id" => "required|exists:formatos,id",
            "precio" => "required|numeric",
            "imagenes" => "required"
        ]);
        if ($request->input("disponibilidad") == true) {
            $formatoproducto = new FormatoProducto([
                'precio' => $validated['precio'],
                'disponibilidad' => $request->input('disponibilidad')
            ]);
        } else {
            $formatoproducto = new FormatoProducto([
                'precio' => $validated['precio'],
                'disponibilidad' => false
            ]);
        }

        $producto = Producto::find($request->input("producto_id"));
        $formato = Formato::find($request->input("formato_id"));

        $formatoproducto->producto()->associate($producto);
        $formatoproducto->formato()->associate($formato);

        $formatoproducto->save();

        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $imagen) {
                $binaryData = file_get_contents($imagen);
                $base64 = base64_encode($binaryData);
                FormatoProductoImagen::create([
                    'formato_producto_id' => $formatoproducto->id,
                    'imagen' => $base64,
                ]);
            }
        }
        return redirect(route("formatoproductos.index"));
    }

    /**
     * Mostrar la información de un FormatoProducto en especifico.
     */
    public function show(FormatoProducto $formatoproducto)
    {
        $productos = Producto::all();
        $formatos = Formato::all();
        return view('formatoproductos.show', ["formatoproducto" => $formatoproducto, "formatos" => $formatos, "productos" => $productos]);
    }

    /**
     *  Mostrar formulario de actualizar FormatoProducto.
     */
    public function edit(FormatoProducto $formatoproducto)
    {
        $productos = Producto::all();
        $formatos = Formato::all();
        return view('formatoproductos.edit', ["formatoproducto" => $formatoproducto, "formatos" => $formatos, "productos" => $productos]);
    }

    /**
     * Realizar el update de el FormatoProducto seleccionado.
     */
    public function update(Request $request, FormatoProducto $formatoproducto)
    {
        //Validación de datos.
        $validated = $request->validate([
            "producto_id" => "required|exists:productos,id",
            "formato_id" => "required|exists:formatos,id",
            "precio" => "required|numeric",
        ]);
        if ($request->input("disponibilidad") == true) {
            $formatoprod = [
                'producto_id' => $validated['producto_id'],
                'formato_id' => $validated['formato_id'],
                'precio' => $validated['precio'],
                'disponibilidad' => $request->input('disponibilidad')
            ];
        } else {
            $formatoprod = [
                'producto_id' => $validated['producto_id'],
                'formato_id' => $validated['formato_id'],
                'precio' => $validated['precio'],
                'disponibilidad' => false
            ];
        }

        $formatoproducto->update($formatoprod);
        return redirect()->back()->with("success", "Producto actualizado correctamente");
    }

    /**
     * Eliminar el FormatoProducto seleccionado.
     */
    public function destroy(FormatoProducto $formatoproducto)
    {
        $formatoproducto->delete();
        return redirect(route('formatoproductos.index'));
    }
}
