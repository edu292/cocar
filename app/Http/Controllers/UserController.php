<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function logout(Request $request)
    {
        // Desloga o usuário autenticado
        User::logout();

        // Invalida a sessão atual do servidor
        $request->session()->invalidate();

        // Gera um novo token CSRF para a próxima sessão
        $request->session()->regenerateToken();

        // Redireciona para a home ou login
        return redirect('/login');
    }
}
