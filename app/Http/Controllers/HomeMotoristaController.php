<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class HomeMotoristaController extends Controller
{
    public function mostrar(Request $request): View
    {
        $perfilMotorista = $request->user()->perfilMotorista;
        if (! $perfilMotorista) {
            return view('motorista.cadastro');
        }

        if (! $perfilMotorista->aprovado_em) {
            return view('motorista.pendente');
        }

        return view('motorista.home');
    }
}
