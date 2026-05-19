<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Organizacao;
use App\Models\PerfilMotorista;
use App\Enums\TipoUsuario;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $organizacao = Organizacao::create([
            'nome' => 'Empresa Teste',
            'cnpj' => '12345678900',
            'dominio_email' => 'teste.com',
        ]);

        $senhaPadrao = Hash::make('SenhaForte!');

        User::create([
            'name' => 'Admin Teste',
            'email' => 'admin@teste.com',
            'password' => $senhaPadrao,
            'cpf' => '12312312300',
            'tipo' => TipoUsuario::AdministradorOrganizacao,
            'organizacao_id' => $organizacao->id,
        ]);

        User::create([
            'name' => 'Passageiro Teste',
            'email' => 'passageiro@teste.com',
            'password' => $senhaPadrao,
            'cpf' => '12312312301',
            'tipo' => TipoUsuario::Padrao,
            'organizacao_id' => $organizacao->id,
        ]);

        $motoristaUser = User::create([
            'name' => 'Motorista Teste',
            'email' => 'motorista@teste.com',
            'password' => $senhaPadrao,
            'cpf' => '12312312302',
            'tipo' => TipoUsuario::Padrao,
            'organizacao_id' => $organizacao->id,
        ]);

        PerfilMotorista::query()->create([
            'user_id' => $motoristaUser->id,
            'cnh' => '12345678911'
        ]);
    }
}
