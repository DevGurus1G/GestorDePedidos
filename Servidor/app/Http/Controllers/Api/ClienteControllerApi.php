<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\RecuperarMail;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ClienteControllerApi extends Controller
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
    public function show($codigo)
    {
        // Validar que el código tenga 8 dígitos numéricos
        // if (!preg_match('/^\d{8}$/', $codigo)) {
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'Formato de código incorrecto.',
        //     ], 400);
        // }

        // Buscar el cliente por el código de acceso
        $cliente = Cliente::where('codigo_acceso', $codigo)->first();

        if ($cliente) {
            // Cliente encontrado, devolver los datos
            return response()->json([
                'success' => true,
                'cliente' => $cliente,
            ]);
        } else {
            // Cliente no encontrado, devolver un mensaje de error
            return response()->json([
                'success' => false,
                'message' => 'Código incorrecto. Inténtalo de nuevo.',
            ], 401);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cliente $cliente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $codigo)
    {
        // Buscar el cliente por el código de acceso
        $cliente = Cliente::where('codigo_acceso', $codigo)->first();

        if ($cliente) {
            $cliente->update($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Cliente actualizado correctamente.',
            ]);
        } else {
            // Cliente no encontrado, devolver un mensaje de error
            return response()->json([
                'success' => false,
                'message' => 'Código incorrecto. No se pudo actualizar el cliente.',
            ], 401);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cliente $cliente)
    {
        //
    }
    public function recuperar(Request $request)
    {
        $datos = $request->json()->all();
        $cliente = Cliente::where('dni', $datos["dni"])->first(); // Usar first() para obtener una instancia, no solo el constructor de consulta

        if ($cliente) {
            try {
                $recuperarMail = new RecuperarMail($cliente);
                Mail::to($datos["email"])->send($recuperarMail);

                return response()->json([
                    "enviado" => true
                ]);
            } catch (\Exception $e) {
                // Manejar errores de correo electrónico
                return response()->json([
                    "enviado" => false,
                    "error" => $e->getMessage()
                ], 500); // Código HTTP 500 para indicar un error interno del servidor
            }
        }

        return response()->json([
            "enviado" => false
        ]);
    }

}
