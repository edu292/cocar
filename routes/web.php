<?php

use App\Http\Controllers\Auth\CompanyRegistrationController;
use App\Http\Controllers\CompanyAdmin\DashboardController;
use App\Http\Controllers\PassageiroController;
use App\Http\Controllers\PerfilController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::middleware('guest')->group(function () {
    Route::get('/register/company', [CompanyRegistrationController::class, 'create'])->name('register-company');
    Route::post('register/company', [CompanyRegistrationController::class, 'store']);
});

Route::middleware(['auth', 'role:company-admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
});

Route::middleware('auth')->group(function () {
    Route::get('/home', function () {
        return view('passageiro.passageiro');
    });

    Route::delete('/perfil', [PerfilController::class, 'destroy'])->name('perfil.destroy');
});

Route::middleware(['auth', 'role:rider'])->group(function () {
    Route::get('/passageiro/create', [PassageiroController::class, 'create'])->name('passageiro.create');
    Route::post('/passageiro', [PassageiroController::class, 'store'])->name('passageiro.store');

    Route::get('/passageiro/perfil', [PassageiroController::class, 'perfil'])->name('passageiro.perfil');

    Route::get('/passageiro/edit', [PassageiroController::class, 'edit'])->name('passageiro.edit');
    Route::put('/passageiro', [PassageiroController::class, 'update'])->name('passageiro.update');
});
