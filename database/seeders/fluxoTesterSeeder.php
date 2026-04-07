<?php

namespace Database\Seeders;

use App\Enums\TipoUsuario;
use App\Models\Organizacao;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class fluxoTesterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $org = Organizacao::create([
           'cnpj' => '12345678912345',
           'nome' => 'OrganizacaoTeste',
           'dominio_email' => 'teste@org.com.br'
        ]);
        $org ->integrantes()->create([
            'name' => 'user',
            'email' => 'user@org.com.br',
            'password' => 'SenhaForte!',
            'tipo' => TipoUsuario::Padrao,
            'cpf' => '12312312312']);

    }
}
