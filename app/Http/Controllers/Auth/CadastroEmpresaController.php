<?php

namespace App\Http\Controllers\Auth;

use App\Enums\PapelUsuario;
use App\Enums\StatusUsuario;
use App\Http\Controllers\Controller;
use App\Models\Empresa;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class CadastroEmpresaController extends Controller
{
    public function formulario(): View
    {
        return view('auth.registrar-empresa');
    }

    public function cadastrar(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'empresa-nome' => ['required', 'string', 'max:255'],
            'cnpj' => ['required', 'string', 'max:14', 'unique:empresas,cnpj'],
            'dominio-email' => ['required', 'string', 'max:255', 'unique:empresas,dominio_email'],
            'administrador-nome' => ['required', 'string', 'max:255'],
            'administrador-email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'max:255', 'confirmed'],
        ]);

        $administrador = DB::transaction(function () use ($validated): User {
            $empresa = Empresa::create([
                'name' => $validated['empresa-nome'],
                'cnpj' => $validated['cnpj'],
                'dominio_email' => $validated['dominio-email'],
            ]);

            return User::create([
                'name' => $validated['administrador-nome'],
                'email' => $validated['administrador-email'],
                'password' => Hash::make($validated['password']),
                'empresa_id' => $empresa->id,
                'papel' => PapelUsuario::AdministradorEmpresa,
                'status' => StatusUsuario::Ativo,
            ]);
        });

        Auth::login($administrador);

        return redirect()->route('admin-empresa.painel');
    }
}
