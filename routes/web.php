<?php

use App\Actions\Fortify\DeleteUser;
use App\Enums\TipoUsuario;
use App\Http\Controllers\Admin\OrganizacaoController;
use App\Http\Controllers\Admin\PainelController;
use App\Http\Controllers\Admin\TriagemMotoristaController;
use App\Http\Controllers\Admin\UsuarioController;
use App\Http\Controllers\Auth\CadastroOrganizacaoController;
use App\Http\Controllers\CarteiraController;
use App\Http\Controllers\HomeMotoristaController;
use App\Http\Controllers\PerfilMotoristaController;
use App\Http\Middleware\VerificarTipo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('index');

Route::middleware('guest')->group(function () {
    Route::get('/cadastro/organizacao', [CadastroOrganizacaoController::class, 'formulario'])->name('cadastro-organizacao');
    Route::post('/organizacoes', [CadastroOrganizacaoController::class, 'cadastrar'])->name('organizacao.criar');
});

Route::middleware(['auth', VerificarTipo::sendo(TipoUsuario::AdministradorOrganizacao, TipoUsuario::AdministradorSistema)])->prefix('/dashboard')->group(function () {
    Route::get('/', [PainelController::class, 'exibir'])->name('admin.painel');
    Route::get('triagem-motorista', [TriagemMotoristaController::class, 'exibir'])->name('admin.triagem-motoristas');
    Route::post('triagem-motorista/{perfilMotorista}/rejeitar', [TriagemMotoristaController::class, 'rejeitar'])->name('triagem-motoristas.rejeitar');
    Route::post('triagem-motorista/{perfilMotorista}/aprovar', [TriagemMotoristaController::class, 'aprovar'])->name('triagem-motoristas.aprovar');
    Route::get('usuarios', [UsuarioController::class, 'exibir'])->name('admin.usuarios');
    Route::get('cadastro', fn () => view('admin.configuracoes'))->name('admin.meu-cadastro');
    Route::put('cadastro/{organizacao}', [OrganizacaoController::class, 'alterar'])->name('organizacoes.alterar');
    Route::get('organizacoes', [OrganizacaoController::class, 'listar'])->name('admin.organizacoes');
    Route::delete('cadastro', [CadastroOrganizacaoController::class, 'deletar'])->name('admin.meu-cadastro.deletar');
});

Route::middleware(['auth', VerificarTipo::sendo(TipoUsuario::Padrao)])->group(function () {
    Route::post('/motorista', [PerfilMotoristaController::class, 'criar'])->name('motorista.cadastro');
    Route::get('/home/motorista', [HomeMotoristaController::class, 'mostrar'])->name('motorista.home');
    Route::get('/home/', fn () => view('passageiro.home'))->name('home');
    Route::get('/perfil', fn () => view('usuario.perfil'))->name('usuario.perfil');
    Route::delete('/deletar-conta', function (Request $request, DeleteUser $deleter) {
        $deleter->delete($request->user());

        return redirect('/')->with('status', 'Conta deletada com sucesso.');
    })->name('usuario.deletar');

    Route::get('/carteira', [CarteiraController::class, 'exibir'])->name('usuario.carteira');
    Route::put('/carteira', [CarteiraController::class, 'inserir'])->name('usuario.carteira.inserir');
});
