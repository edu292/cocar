<?php

namespace Database\Seeders;

use App\Actions\Fortify\CreateNewUser;
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

        Organizacao::create([
           'cnpj' => '12345678912345',
           'nome' => 'OrganizacaoTeste',
           'dominio_email' => 'org.com.br'
        ]);


        (new CreateNewUser())->create([
            'name' => 'user',
            'email' => 'user@org.com.br',
            'password' => 'SenhaForte!',
            'password_confirmation' => 'SenhaForte!',
            'cpf' => '12312312312']
        );
    }
}
