<?php

namespace App\Http\Controllers\AdminEmpresa;

use App\Enums\TipoUsuario;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PainelController extends Controller
{
    public function exibir(Request $request): View
    {
        $empresa = $request->user()->empresa;

        $stats = $empresa->usuarios()
            ->selectRaw('count(case when role != ? then 1 end) as nao_admins', [TipoUsuario::Funcionario])
            ->selectRaw('count(case when role = ? and status = ? then 1 end) as motoristas_ativos', [TipoUsuario::Funcionario])
            ->selectRaw('count(case when role = ? and status = ? then 1 end) as motoristas_pendentes', [TipoUsuario::Funcionario])
            ->first();

        return view('admin-empresa.index', [
            'empresa' => $empresa,
            'totalUsuarios' => $stats->nao_admins,
            'totalMotoristasAtivos' => $stats->motoristas_ativos,
            'totalMotoristasPendentes' => $stats->motoristas_pendentes,
        ]);
    }
}
