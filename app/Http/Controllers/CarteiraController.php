<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CarteiraController extends Controller
{
    public function exibir(Request $request): View
    {
        $carteira = $request->user()->carteira;

        return view('usuario.carteira', compact('carteira'));
    }

    public function inserir(Request $request): RedirectResponse
    {
        $validated = $request->validate(
            ['valor' => 'required|min:0|decimal:0,2 ']
        );

        $carteira = $request->user()->carteira;
        $carteira->saldo += $validated['valor'];
        $carteira->save();

        return back();
    }
}
