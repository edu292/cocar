<?php

namespace App\Http\Controllers\AdminEmpresa;

use App\Enums\PapelUsuario;
use App\Enums\StatusUsuario;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PainelController extends Controller
{
    public function exibir(Request $request): View
    {
        $empresa = $request->user()->empresa;

        $totalUsuarios = $empresa->usuarios()->count();
        $totalMotoristas = $empresa->usuarios()
            ->where('papel', PapelUsuario::Motorista)
            ->where('status', StatusUsuario::Ativo)
            ->count();

        $totalMotoristasPendentes = $empresa->usuarios()
            ->where('papel', PapelUsuario::Motorista)
            ->where('status', StatusUsuario::PendenteAprovacao)
            ->count();

        return view('admin-empresa.index', [
            'empresa' => $empresa,
            'totalUsuarios' => $totalUsuarios,
            'totalMotoristas' => $totalMotoristas,
            'totalMotoristasPendentes' => $totalMotoristasPendentes,
        ]);
    }
}
