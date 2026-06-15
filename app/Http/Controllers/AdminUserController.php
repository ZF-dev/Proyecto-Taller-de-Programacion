<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Venta;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminUserController extends Controller
{
    public function index()
    {
        $usuarios = User::where('id', '!=', 1)
            ->orderBy('role', 'asc')
            ->orderBy('name')
            ->paginate(15);

        return view('Usuarios', compact('usuarios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role'     => ['required', Rule::in(['admin', 'user'])],
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
        ]);

        return redirect()->back()->with('success', 'Usuario registrado con éxito.');
    }

    public function cambiarRol(Request $request, $id)
    {
        $request->validate([
            'role' => ['required', Rule::in(['admin', 'user'])]
        ]);

        $usuario = User::findOrFail($id);
        
        if ($usuario->id === auth()->id()) {
            return redirect()->back()->with('error', 'No podés cambiar tu propio rol desde tu propia sesión.');
        }

        $usuario->update(['role' => $request->role]);

        return redirect()->back()->with('success', "Rol actualizado a de manera exitosa.");
    }

    public function destroy($id)
    {
        $usuario = User::findOrFail($id);

        if ($usuario->id === auth()->id()) {
            return redirect()->back()->with('error', 'No podés eliminar tu propia cuenta en sesión activa.');
        }

        $usuario->delete();

        return redirect()->back()->with('success', 'Cuenta desvinculada del sistema de forma permanente.');
    }

    public function mostrarPerfil()
    {
        $usuario = auth()->user();

        $compras = Venta::where('user_id', $usuario->id)
            ->with('items')
            ->orderByDesc('created_at')
            ->get();

        return view('mostrarPerfil', compact('usuario', 'compras'));
    }

    public function actualizarPerfil(Request $request)
    {
        $usuario = User::findOrFail(auth()->id());

        $request->validate([
            'name'             => 'sometimes|required|string|max:255',
            'dni'              => 'sometimes|required|numeric|digits_between:7,9',
            'fecha_nacimiento' => 'sometimes|required|date',
            'email'            => 'sometimes|required|email|unique:users,email,' . $usuario->id,
        ]);

        $usuario->update($request->only(['name', 'dni', 'fecha_nacimiento', 'email']));

        return redirect()->route('verPerfil')->with('success', 'Perfil actualizado con éxito.');
    }
}

