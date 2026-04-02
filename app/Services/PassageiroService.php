<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class PassageiroService
{
    public function atualizarPerfil(User $user, array $dados)
    {
        return DB::transaction(function () use ($user, $dados) {
            $user->update([
                'name' => $dados['name'],
            ]);

            // Garante que o passageiro do usuário seja atualizado sem duplicar registro.
            $user->passageiro()->updateOrCreate(
                ['user_id' => $user->id],
                ['cpf' => $dados['cpf']]
            );

            return $user;
        });
    }
}
