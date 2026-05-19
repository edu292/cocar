<?php

namespace Database\Seeders;

use App\Actions\Fortify\CreateNewUser;
use App\Enums\TipoUsuario;
use App\Models\Organizacao;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use function Illuminate\Support\now;

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
            'dominio_email' => 'org.com.br',
        ]);

        $org->integrantes()->create([
            'name' => 'admin',
            'email' => 'admin@org.com.br',
            'cpf' => '11111111111',
            'password' => Hash::make('SenhaForte!'),
            'tipo' => TipoUsuario::AdministradorOrganizacao,

        ]);

        $motorista = (new CreateNewUser)->create([
            'name' => 'motorista',
            'email' => 'motorista@org.com.br',
            'password' => 'SenhaForte!',
            'password_confirmation' => 'SenhaForte!',
            'cpf' => '22222222222']
        );

        $motorista->perfilMotorista()->create([
            'cnh' => '11111111111',
            'aprovado_em' => now(),
        ]);

        (new CreateNewUser)->create([
            'name' => 'user',
            'email' => 'user@org.com.br',
            'password' => 'SenhaForte!',
            'password_confirmation' => 'SenhaForte!',
            'cpf' => '33333333333']
        );

    }
}
