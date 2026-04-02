<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class PerfilController extends Controller
{
    public function editar(): View
    {
        $user = Auth::user();

        return view('perfil.edit', compact('user'));
    }

    public function atualizar(Request $request): RedirectResponse
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
        ]);

        $dados = $request->only(['name', 'email']);

        if ($request->filled('password')) {
            $dados['password'] = Hash::make($request->password);
        }

        $user->update($dados);

        return redirect()
            ->back()
            ->with('success', 'Perfil atualizado com sucesso!');
    }

    public function excluir(Request $request): RedirectResponse
    {
        $user = Auth::user();

        Auth::logout();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')
            ->with('success', 'Perfil excluído com sucesso!');
    }
}
