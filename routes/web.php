<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\PassageiroController;


Route::get('/', function () {
    return view('index');
});

Route::middleware('auth')->group(function () {
    
    Route::get('/home', function () {
        return view('passageiro.passageiro');
    });

    Route::delete('/perfil', [PerfilController::class, 'destroy'])->name('perfil.destroy');
});

Route::middleware(['auth', 'role:passageiro'])->group(function () {
    Route::get('/passageiro/create', [PassageiroController::class, 'create'])->name('passageiro.create');
    Route::post('/passageiro', [PassageiroController::class, 'store'])->name('passageiro.store');

    Route::get('/passageiro/perfil', [PassageiroController::class, 'perfil'])->name('passageiro.perfil');

    Route::get('/passageiro/edit', [PassageiroController::class, 'edit'])->name('passageiro.edit');
    Route::put('/passageiro', [PassageiroController::class, 'update'])->name('passageiro.update');
});



