<?php

namespace App\Http\Controllers;

use App\Models\PedidoCarona;
use App\Models\Trajeto;
use App\Services\SugestaoCaronaService;
use App\Services\TrajetoService;
use App\ValueObjects\Point;
use Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TrajetoController extends Controller
{
    public function store(Request $request, TrajetoService $trajetoService): RedirectResponse
    {
        $validated = $request->validate([
            'origem-coords' => 'required',
            'origem-endereco' => 'required',
            'destino-coords' => 'required',
            'destino-endereco' => 'required',
        ]);

        $trajeto = $trajetoService->novoTrajeto(
            origemEndereco: $validated['origem-endereco'],
            origem: Point::from($validated['origem-coords']),
            destino: Point::from($validated['destino-coords']),
            destinoEndereco: $validated['destino-endereco'],
            userID: Auth::id()
        );

        return to_route('trajeto.show', ['trajeto' => $trajeto->id]);
    }

    public function show(Request $request, Trajeto $trajeto): Response
    {
        return response()
            ->view('motorista.mapa', compact('trajeto'))
            ->header('Hx-Trigger-After-Settle', 'atualizarRota');
    }

    public function rota(Request $request, Trajeto $trajeto, TrajetoService $trajetoService)
    {
        $trajeto->paradas = $trajetoService->obterParadas($trajeto);

        return json_encode($trajeto);
    }

    public function sugestoesCarona(Request $request, int $trajetoID, SugestaoCaronaService $sugestaoCaronaService): Response
    {
        $sugestoes = $sugestaoCaronaService->obterSugestoesParaTrajeto($trajetoID);

        return response()
            ->view('motorista.sugestoes-carona', compact('sugestoes'))
            ->header('Hx-Trigger-After-Settle', 'hidratarSugestoesCarona');
    }

    public function carona(Request $request, Trajeto $trajeto, PedidoCarona $pedidoCarona, TrajetoService $trajetoService): Response
    {
        if (! carona) {
            $trajetoService->atualizarRota($trajeto);
        }

        return response('')->header('Hx-Trigger', 'atualizarRota');
    }

    public function iniciar(Request $request, Trajeto $trajeto, TrajetoService $trajetoService): void
    {
        $trajetoService->iniciarTrajeto($trajeto);
    }

    public function finalizar(Request $request, Trajeto $trajeto, TrajetoService $trajetoService): void
    {
        $trajetoService->finalizarTrajeto($trajeto);
    }

    public function embarcar(Request $request, Trajeto $trajeto, PedidoCarona $pedidoCarona, TrajetoService $trajetoService): void
    {
        $trajetoService->vincularPassgeiro($trajeto, $pedidoCarona);
    }
}
