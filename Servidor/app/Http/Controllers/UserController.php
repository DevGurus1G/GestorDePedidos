<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $users = User::all();
        return view('users.index', ["users" => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $roles = ["responsable", "comercial", "administrativo"];
        return view('users.create', ["roles" => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            "name" => "required|max:255",
            "email" => "required|unique:users|max:255",
            "password" => "required|min:8",
            "rol" => "required|string|max:255"
        ]);

        User::create([
            "name" => $validated["name"],
            "email" => $validated["email"],
            "password" => Hash::make($validated["password"]),
            "rol" => $validated["rol"]
        ]);

        return redirect(route('users.create'))->with('success', 'Usuario creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
        $roles = ["responsable", "comercial", "administrativo"];
        return view('users.show', ["user" => $user, "roles" => $roles]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
        $roles = ["responsable", "comercial", "administrativo"];
        return view("users.edit", ["user" => $user, "roles" => $roles]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            "name" => "required|max:255",
            "email" => "required|unique:users,email," . $user->id . "|max:255",
            "rol" => "required|string|max:255",
            "password" => "nullable|min:8",
        ]);

        if ($request->filled("password") && strlen($request->input("password")) >= 8) {
            $user->update([
                "name" => $validated["name"],
                "email" => $validated["email"],
                "password" => Hash::make($validated["password"]),
                "rol" => $validated["rol"],
            ]);
        } else {
            $user->update([
                "name" => $validated["name"],
                "email" => $validated["email"],
                "rol" => $validated["rol"],
            ]);
        }

        return redirect(route("users.show", ["user" => $user]))->with("success", "Usuario actualizado correctamente");
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
        $user->delete();
        return redirect(route("users.index"));
    }

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

    public function editPerfil(User $user)
    {
        //
        $roles = ["responsable", "comercial", "administrativo"];
        return view("perfil.edit", ["user" => $user, "roles" => $roles]);
    }
}
