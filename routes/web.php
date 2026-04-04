<?php

use App\Enums\TipoUsuario;
use App\Http\Controllers\Admin\PainelController;
use App\Http\Controllers\Admin\TriagemMotoristaController;
use App\Http\Controllers\Admin\UsuarioController;
use App\Http\Controllers\Auth\CadastroOrganizacaoController;
use App\Http\Controllers\HomeMotoristaController;
use App\Http\Controllers\PerfilMotoristaController;
use App\Http\Middleware\VerificarTipo;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('index');

Route::middleware('guest')->group(function () {
    Route::get('/cadastro/organizacao', [CadastroOrganizacaoController::class, 'formulario'])->name('cadastro-organizacao');
    Route::post('/cadastro/organizacao', [CadastroOrganizacaoController::class, 'cadastrar']);
});

Route::middleware(['auth', VerificarTipo::sendo(TipoUsuario::AdministradorOrganizacao, TipoUsuario::AdministradorSistema)])->prefix('/dashboard')->group(function () {
    Route::get('/', [PainelController::class, 'exibir'])->name('admin.painel');
    Route::get('triagem-motorista', [TriagemMotoristaController::class, 'exibir'])->name('admin.triagem-motoristas');
    Route::post('/triagem-motorista/{perfilMotorista}/aprovar', [TriagemMotoristaController::class, 'aprovar'])->name('triagem-motoristas.aprovar');
    Route::get('usuarios', [UsuarioController::class, 'exibir'])->name('admin.usuarios');
});

Route::middleware(['auth', VerificarTipo::sendo(TipoUsuario::Padrao)])->group(function () {
    Route::post('/motorista', [PerfilMotoristaController::class, 'criar'])->name('motorista.cadastro');
    Route::get('/home/', fn () => view('passageiro.home'))->name('home');
    Route::get('/home/motorista', [HomeMotoristaController::class, 'mostrar'])->name('motorista.home');
    Route::get('/perfil', fn () => view('usuario.perfil'))->name('usuario.perfil');
});
