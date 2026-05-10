<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class GrupoCaronaController extends Controller
{
    public function create(Request $request): View|RedirectResponse
    {
        $motorista = $request->user()->perfilMotorista;

        if (! $motorista || ! $motorista->aprovado_em) {
            return redirect()->route('motorista.home');
        }

        $passageirosDisponiveis = $this->buscarPassageirosDisponiveis($request->user());

        return view('motorista.criar', compact('passageirosDisponiveis'));
    }

    public function store(Request $request): RedirectResponse
    {
        $motorista = $request->user()->perfilMotorista;

        if (! $motorista || ! $motorista->aprovado_em) {
            return redirect()->route('motorista.home');
        }

        $passageirosDisponiveis = $this->buscarPassageirosDisponiveis($request->user());
        $idsPassageirosDisponiveis = $passageirosDisponiveis->pluck('id')->all();

        $dadosValidados = $request->validate([
            'nome' => 'required|string|max:255',
            'frequencia' => 'required|in:semanal,mensal',
            'vagas' => 'required|integer|min:1|max:4',
            'passageiros' => 'nullable|array',
            'passageiros.*' => [
                'integer',
                Rule::in($idsPassageirosDisponiveis),
            ],
        ]);

        $passageirosSelecionados = collect($dadosValidados['passageiros'] ?? [])->unique()->values();

        if ($passageirosSelecionados->count() > $dadosValidados['vagas']) {
            return back()
                ->withErrors(['passageiros' => 'Selecione no máximo a mesma quantidade de passageiros das vagas disponíveis.'])
                ->withInput();
        }

        unset($dadosValidados['passageiros']);

        $grupo = $motorista->grupos()->create($dadosValidados);
        $grupo->passageiros()->sync($passageirosSelecionados->all());

        return redirect()->route('motorista.home')
            ->with('sucesso', 'Grupo de carona criado com sucesso!');
    }

    private function buscarPassageirosDisponiveis(User $user)
    {
        return User::query()
            ->where('organizacao_id', $user->organizacao_id)
            ->whereKeyNot($user->id)
            ->whereDoesntHave('perfilMotorista')
            ->orderBy('name')
            ->get(['id', 'name', 'email']);
    }
}
