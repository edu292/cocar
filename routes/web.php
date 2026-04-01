<?php

use App\Http\Controllers\PerfilController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::middleware('auth')->group(function () {
    Route::get('/home', function () {
        return view('home');
    });
    Route::get('/perfil',[perfilController::class,'edit'])->name('perfil.edit');
    Route::put('/perfil',[perfilController::class,'update'])->name('perfil.update');
});
