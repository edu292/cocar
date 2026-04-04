<?php

namespace Database\Seeders;

use App\Enums\TipoUsuario;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSistemaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Cocar CEO',
            'email' => 'admin@cocar.com.br',
            'password' => Hash::make('senha123'),
            'cpf' => '16354399074',
            'tipo' => TipoUsuario::AdministradorSistema,
        ]);
    }
}
