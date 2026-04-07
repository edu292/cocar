<?php

namespace App\Http\Controllers\Admin;

use App\Enums\TipoUsuario;
use App\Http\Controllers\Controller;
use App\Models\Organizacao;
use App\Models\PerfilMotorista;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PainelController extends Controller
{
    public function exibir(Request $request): View
    {
        if ($request->user()->eAdminSistema) {
            $totalOrganizacoes = Organizacao::all()->count();
            $totalUsuarios = User::all()->count();
            $totalMotoristasAtivos = PerfilMotorista::whereNotNull('aprovado_em')->count();

            return view('admin.painel-sistema', compact('totalOrganizacoes', 'totalUsuarios', 'totalMotoristasAtivos'));
        }

        $organizacao = $request->user()->organizacao;

        $stats = $organizacao->integrantes()
            ->where('tipo', TipoUsuario::Padrao)
            ->leftJoin('perfis_motorista', 'users.id', '=', 'perfis_motorista.user_id')
            ->selectRaw('
                count(*) as nao_admins,
                count(CASE WHEN perfis_motorista.aprovado_em IS NOT NULL THEN 1 END) as motoristas_ativos,
                count(CASE WHEN perfis_motorista.id IS NOT NULL AND perfis_motorista.aprovado_em IS NULL THEN 1 END) as motoristas_pendentes
            ')
            ->first();

        return view('admin.painel-organizacao', [
            'organizacao' => $organizacao,
            'totalUsuarios' => $stats->nao_admins,
            'totalMotoristasAtivos' => $stats->motoristas_ativos,
            'totalMotoristasPendentes' => $stats->motoristas_pendentes,
        ]);
    }
}
