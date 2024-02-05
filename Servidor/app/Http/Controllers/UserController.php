<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * * Listar Usuarios.
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', ["users" => $users]);
    }

    /**
     * Mostrar formulario de crear nuevo Usuario.
     */
    public function create()
    {
        $roles = ["responsable", "comercial", "administrativo"];
        return view('users.create', ["roles" => $roles]);
    }

    /**
     * Realizar la create de el nuevo Usuario.
     */
    public function store(Request $request)
    {
        //Validación de datos.
        $validated = $request->validate([
            "name" => "required|max:255",
            "email" => "required|unique:users|max:255",
            "password" => "required|min:8",
            "rol" => "required|string|max:255"
        ]);

        //Sentencia Create.
        User::create([
            "name" => $validated["name"],
            "email" => $validated["email"],
            "password" => Hash::make($validated["password"]),
            "rol" => $validated["rol"]
        ]);

        return redirect(route('users.create'))->with('success', 'Usuario creado correctamente');
    }

    /**
     * Mostrar la información de un Usuario en especifico.
     */
    public function show(User $user)
    {
        $roles = ["responsable", "comercial", "administrativo"];
        return view('users.show', ["user" => $user, "roles" => $roles]);
    }

    /**
     * Mostrar formulario de actualizar Usuario.
     */
    public function edit(User $user)
    {
        $roles = ["responsable", "comercial", "administrativo"];
        return view("users.edit", ["user" => $user, "roles" => $roles]);
    }

    /**
     * Realizar el update del Usuario seleccionado.
     */
    public function update(Request $request, User $user)
    {
        //Validación de datos.
        $validated = $request->validate([
            "name" => "required|max:255",
            "email" => "required|unique:users,email," . $user->id . "|max:255",
            "rol" => "required|string|max:255",
            "password" => "nullable|min:8",
            "perfil" => "nullable"
        ]);

        if ($request->filled("password") && strlen($request->input("password")) >= 8) {
            //Update de los datos + contraseña.
            $user->update([
                "name" => $validated["name"],
                "email" => $validated["email"],
                "password" => Hash::make($validated["password"]),
                "rol" => $validated["rol"],
            ]);
        } else {
            //Update de solo los datos.
            $user->update([
                "name" => $validated["name"],
                "email" => $validated["email"],
                "rol" => $validated["rol"],
            ]);
        }


        return redirect(route("users.show", ["user" => $user]))->with("success", "Usuario actualizado correctamente");
    }

    /**
     * Eliminar el Usuario seleccionado.
     */
    public function destroy(Request $request, User $user)
    {

        $user->delete();

        //If para determinar si estas borrando un Usuario o tu Usuario y elegir la ruta de redirección.
        if ($request->filled('perfil')) {
            return redirect(route("home"));
        } else {
            return redirect(route("users.index"));
        }
    }

    /**
     * * Mostrar datos del Perfil de Usuario.
     */
    public function indexPerfil()
    {
        //
        $user = Auth::user();
        $roles = ["responsable", "comercial", "administrativo"];
        return view('perfil.index', [
            "user" => $user,
            "roles" => $roles
        ]);
    }

    /**
     * Mostrar formulario de actualizar el Perfil del Usuario.
     */
    public function editPerfil(User $user)
    {
        //
        $roles = ["responsable", "comercial", "administrativo"];
        return view("perfil.edit", ["user" => $user, "roles" => $roles]);
    }

    /**
     * Realizar el update del Perfil del Usuario.
     */
    public function updatePerfil(Request $request, User $user)
    {
        //Validación de datos.
        $validated = $request->validate([
            "name" => "min:1|max:255",
            "email" => "min:1|unique:users,email," . $user->id . "|max:255",
            "rol" => "min:1|string|max:255",
            "passwordA" => "nullable|min:8",
            "passwordN" => "nullable|min:8",
            "confirmNP" => "nullable|min:8"
        ]);

        if ($request->filled("passwordA") && strlen($request->input("passwordA")) >= 8) {

            if ($request->filled("passwordN") && $request->filled("confirmNP") && $request->input("passwordN") == $request->input("confirmNP")) {

                //Update de la contraseña.
                if (Hash::check($request->input('passwordA'), $user->password)) {
                    $user->update([
                        "password" => Hash::make($validated["passwordN"]),
                    ]);
                } else {
                    return redirect()->back()->withInput()->withErrors(['error' => 'Contraseña Incorrecta']);
                }
            } else {
                return redirect()->back()->withInput()->withErrors(['error' => 'Introduzca la misma nueva contraseña en los dos campos.']);
            }
        } else {
            //Update de los datos personales.
            $user->update([
                "name" => $validated["name"],
                "email" => $validated["email"],
                "rol" => $validated["rol"],
            ]);
        }


        return redirect(route("perfil.index", ["user" => $user]))->with("success", "Usuario actualizado correctamente");
    }
}
