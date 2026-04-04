<?php

namespace App\Http\Controllers\Admin;

use App\Enums\TipoUsuario;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function exibir(Request $request): View
    {
        $user = $request->user();
        $query = match ($user->tipo) {
            TipoUsuario::AdministradorOrganizacao => $user->organizacao->integrantes(),
            TipoUsuario::AdministradorSistema => User::query(),
            default => null,
        };

        $users = $query->comStatusMotorista()
            ->when($request->pesquisa, fn ($q, $v) => $q->where(fn ($sq) => $sq->where('name', 'like', "%{$v}%")->orWhere('email', 'like', "%{$v}%")))
            ->when($request->tipo, function ($q, $tipo) {
                match ($tipo) {
                    'admin-sistema' => $q->where('tipo', TipoUsuario::AdministradorSistema),
                    'admin-organizacao' => $q->where('tipo', TipoUsuario::AdministradorOrganizacao),
                    'motorista' => $q->whereHas('perfilMotorista'),
                    'passageiro' => $q->where('tipo', TipoUsuario::Padrao)->whereDoesntHave('perfilMotorista'),
                    default => $q,
                };
            })
            ->when($request->input('status-motorista'), function ($q, $status) {
                match ($status) {
                    'aprovado' => $q->whereHas('perfilMotorista', fn ($sq) => $sq->whereNotNull('aprovado_em')),
                    'pendente' => $q->whereHas('perfilMotorista', fn ($sq) => $sq->whereNull('aprovado_em')),
                    default => $q,
                };
            })->get();

        return view('admin.usuarios', compact('users'));
    }
}
