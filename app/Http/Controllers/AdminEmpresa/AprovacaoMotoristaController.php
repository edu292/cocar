<?php

namespace App\Http\Controllers\AdminEmpresa;

use App\Enums\PapelUsuario;
use App\Enums\StatusUsuario;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AprovacaoMotoristaController extends Controller
{
    public function aprovar(Request $request, User $user): RedirectResponse
    {
        if ($request->user()->empresa_id !== $user->empresa_id) {
            abort(403, 'O usuário não faz parte da sua empresa.');
        }

        if ($user->papel !== PapelUsuario::Motorista) {
            abort(400, 'O usuário não é um motorista.');
        }

        $user->update(['status' => StatusUsuario::Ativo]);

        return back()->with('success', 'O usuário foi aprovado e já pode realizar caronas.');
    }
}
