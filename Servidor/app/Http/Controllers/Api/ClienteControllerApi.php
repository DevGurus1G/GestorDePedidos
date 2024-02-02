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
        try {
            //Validacion
            $validated = $request->validate([
                "nombre" => "required|max:255",
                "dni" => "required|max:9",
                "calle" => "required|max:255",
                "email" => "required|email",
            ]);

            function generarCodigo($nombre)
            {
                // Obtener las 3 primeras letras del nombre
                $tresPrimerasLetras = strtoupper(substr($nombre, 0, 3));

                do {
                    // Generar 4 números aleatorios
                    $cuatroNumerosAleatorios = mt_rand(1000, 9999);

                    // Combinar las letras y números con un guion
                    $codigoGenerado = $tresPrimerasLetras . "-" . $cuatroNumerosAleatorios;

                    // Verificar si el código ya existe en la base de datos
                    $existente = Cliente::where('codigo_acceso', $codigoGenerado)->exists();
                } while ($existente);

                return $codigoGenerado;
            }

            $codigo = generarCodigo($validated["nombre"]);

            //Verificar si existe un cliente con ese dni:
            $clienteExistente = Cliente::where('dni', $validated['dni'])->first();

            if ($clienteExistente) {
                return response()->json(['success' => false, 'message' => 'Ya existe un cliente con el mismo DNI.']);
            }

            //Crear el pedido
            $cliente = Cliente::create([
                "nombre" => $validated["nombre"],
                "dni" => $validated["dni"],
                "codigo_acceso" => $codigo,
                "calle" => $validated["calle"]
            ]);

            $recuperarMail = new RecuperarMail($cliente);
            Mail::to($validated["email"])->send($recuperarMail);

            return response()->json(['success' => true, 'message' => "Creado correctamente"]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => "Error al crear" . $e->getMessage()]);
        }
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
