<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PerfilMotoristaController extends Controller
{
    public function criar(Request $request): RedirectResponse
    {
        $user = $request->user();

        $validated = $request->validate([
            'cnh' => 'required|string',
        ]);

        $user->perfilMotorista()->create([
            'cnh' => $validated['cnh'],
        ]);

        return redirect()->route('motorista.home');
    }
}
