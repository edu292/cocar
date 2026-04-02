<?php

namespace App\Http\Controllers;

use App\Models\Passageiro;
use App\Services\PassageiroService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PassageiroController extends Controller
{
    public function __construct(
        private readonly PassageiroService $passageiroService
    ) {
    }

    public function formulario(): View
    {
        return view('passageiro.create');
    }

    public function cadastrar(Request $request): RedirectResponse
    {
        $request->validate([
            'cpf' => ['required', 'digits:11', 'unique:passageiros,cpf'],
        ]);

        Passageiro::create([
            'user_id' => Auth::id(),
            'cpf' => $request->cpf,
        ]);

        return redirect()
            ->route('passageiro.perfil')
            ->with('success', 'Perfil criado com sucesso!');
    }

    public function perfil(): View|RedirectResponse
    {
        $user = Auth::user();
        $passageiro = $user->passageiro;

        if (! $passageiro) {
            return redirect()->route('passageiro.create');
        }

        return view('passageiro.perfil', compact('user', 'passageiro'));
    }

    public function editar(): RedirectResponse
    {
        return redirect()->route('passageiro.perfil');
    }

    public function atualizar(Request $request): RedirectResponse
    {
        $user = Auth::user();
        $passageiro = $user->passageiro;

        if (! $passageiro) {
            return redirect()->route('passageiro.create');
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            // Ignora o próprio registro do passageiro durante a validação do CPF.
            'cpf' => ['required', 'digits:11', 'unique:passageiros,cpf,' . $passageiro->id],
        ]);

        $this->passageiroService->atualizarPerfil($user, $request->only(['name', 'cpf']));

        return redirect()
            ->route('passageiro.perfil')
            ->with('success', 'Perfil atualizado!');
    }
}
