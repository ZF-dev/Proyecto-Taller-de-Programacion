<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $usuarios = User::where('id', '!=', auth()->id())->orderBy('id', 'asc')->get();
        return view('admin.usuarios', compact('usuarios'));
    }

    public function cambiarRol(Request $request, $id)
    {
        $request->validate([
        'role' => 'required|in:user,buyer,admin'
        ]);

        $usuario = User::findOrFail($id);

        if ($usuario->id === auth()->id()) {
        return redirect()->back()->with('error', 'No podés cambiar tu propio rol.');
        }
        
        $usuario->update(['role' => $request->role]);

        return redirect()->back()->with('exito', 'Rol de usuario actualizado correctamente.');
    }

    public function destroy($id)
    {
        $usuario = User::findOrFail($id);
        $usuario->delete();

        return redirect()->back()->with('exito', 'Usuario eliminado de la base de datos.');
    }
}
