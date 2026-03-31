<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/home', function () {
    return view('home');
});

Route::post('/home', function (){
    return 'botão excluir';
});

Route::get('/user/{id}', [UserController::class, 'show']);
Route::post('/logout', [UserController::class, 'logout'])->name('logout');
