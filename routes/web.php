<?php

use App\Enums\PapelUsuario;
use App\Http\Controllers\AdminEmpresa\PainelController;
use App\Http\Controllers\Auth\CadastroEmpresaController;
use App\Http\Controllers\PassageiroController;
use App\Http\Controllers\PerfilController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('inicio');

Route::middleware('guest')->group(function () {
    Route::get('/registrar/empresa', [CadastroEmpresaController::class, 'formulario'])->name('registrar-empresa');
    Route::post('/registrar/empresa', [CadastroEmpresaController::class, 'cadastrar']);
});

Route::middleware(['auth', 'papel:administrador_empresa'])->group(function () {
    Route::get('/dashboard', [PainelController::class, 'exibir'])->name('admin-empresa.painel');
});

Route::middleware('auth')->group(function () {
    Route::get('/home', function () {
        $user = request()->user();

        return match ($user->papel) {
            PapelUsuario::AdministradorEmpresa => redirect()->route('admin-empresa.painel'),
            PapelUsuario::Passageiro => view('passageiro.passageiro'),
            PapelUsuario::Motorista => view('motorista.home_motorista'),
            default => redirect()->route('inicio'),
        };
    })->name('home');

    Route::get('/perfil', [PerfilController::class, 'editar'])->name('perfil.edit');
    Route::put('/perfil', [PerfilController::class, 'atualizar'])->name('perfil.update');
    Route::delete('/perfil', [PerfilController::class, 'excluir'])->name('perfil.destroy');
});

Route::middleware(['auth', 'papel:passageiro'])->group(function () {
    Route::get('/passageiro/create', [PassageiroController::class, 'formulario'])->name('passageiro.create');
    Route::post('/passageiro', [PassageiroController::class, 'cadastrar'])->name('passageiro.store');
    Route::get('/passageiro/perfil', [PassageiroController::class, 'perfil'])->name('passageiro.perfil');
    Route::get('/passageiro/edit', [PassageiroController::class, 'editar'])->name('passageiro.edit');
    Route::put('/passageiro', [PassageiroController::class, 'atualizar'])->name('passageiro.update');
});
