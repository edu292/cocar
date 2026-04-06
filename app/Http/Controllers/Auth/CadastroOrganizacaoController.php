<?php

namespace App\Http\Controllers\Auth;

use App\Enums\TipoUsuario;
use App\Http\Controllers\Controller;
use App\Models\Organizacao;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class CadastroOrganizacaoController extends Controller
{
    public function formulario(): View
    {
        return view('auth.cadastro-organizacao');
    }

    public function cadastrar(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'organizacao-nome' => 'required|string|max:255',
            'cnpj' => 'required|string|size:14|unique:organizacoes',
            'dominio-email' => 'required|string|max:255|unique:organizacoes',
            'administrador-nome' => 'required|string|max:255',
            'administrador-email' => 'required|string|email|max:255|unique:users,email',
            'administrador-cpf' => 'required|string|size:11',
            'password' => 'required|string|max:255|confirmed',
        ]);

        $administrador = DB::transaction(function () use ($validated): User {
            $organizacao = Organizacao::create([
                'nome' => $validated['organizacao-nome'],
                'cnpj' => $validated['cnpj'],
                'dominio_email' => $validated['dominio-email'],
            ]);

            return $organizacao->integrantes()->create([
                'name' => $validated['administrador-nome'],
                'email' => $validated['administrador-email'],
                'password' => Hash::make($validated['password']),
                'tipo' => TipoUsuario::AdministradorOrganizacao,
                'cpf' => $validated['administrador-cpf'],
            ]);
        });

        Auth::login($administrador);

        return redirect()->route('admin.painel');
    }

    public function deletar(Request $request): void
    {
        $user = $request->user();

        $user->organizacao->delete();
        DeleteUser->delete($user);
    }
}
