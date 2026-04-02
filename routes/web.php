<?php

use App\Enums\TipoUsuario;
use App\Http\Controllers\AdminEmpresa\PainelController;
use App\Http\Controllers\Auth\CadastroEmpresaController;
use App\Http\Controllers\PerfilController;
use App\Http\Middleware\VerificarTipo;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('index');

Route::middleware('guest')->group(function () {
    Route::get('/registrar/empresa', [CadastroEmpresaController::class, 'formulario'])->name('registrar-empresa');
    Route::post('/registrar/empresa', [CadastroEmpresaController::class, 'cadastrar']);
});

Route::middleware(['auth', VerificarTipo::com(TipoUsuario::AdministradorEmpresa)])->group(function () {
    Route::get('/dashboard', [PainelController::class, 'exibir'])->name('admin-empresa.painel');
});

Route::middleware('auth')->group(function () {
    Route::get('/perfil', [PerfilController::class, 'editar'])->name('perfil.edit');
    Route::put('/perfil', [PerfilController::class, 'atualizar'])->name('perfil.update');
    Route::delete('/perfil', [PerfilController::class, 'excluir'])->name('perfil.destroy');
});
