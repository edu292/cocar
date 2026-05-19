<?php

namespace App\Http\Controllers;

use App\Enums\CaronaStatus;
use App\Models\Carona;
use App\Models\Trajeto;
use App\ValueObjects\Point;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;

class TrajetoController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'origem' => 'required',
            'destino' => 'required',
        ]);

        $origem = Point::from($validated['origem']);
        $destino = Point::from($validated['destino']);

        $res = Http::mapbox()->get('/directions/v5/mapbox/driving-traffic/'.Point::formatPoints($origem, $destino));
        $rota = $res->json('routes.0.geometry');

        $trajeto = Trajeto::create([
            'origem' => $origem,
            'destino' => $destino,
            'rota' => $rota,
            'motorista' => $request->user()->id,
        ]);

        return to_route('trajeto.show', ['trajeto' => $trajeto->id]);
    }

    public function show(Request $request, Trajeto $trajeto): Response
    {
        return response()
            ->view('motorista.mapa', compact('trajeto'))
            ->header('Hx-Trigger-After-Settle', 'atualizarRota');
    }

    public function rota(Request $request, Trajeto $trajeto)
    {
        $trajeto->paradas = $trajeto->paradas();

        return json_encode($trajeto);
    }

    public function sugestoesCarona(Request $request, Trajeto $trajeto): Response
    {
        $sugestoes = $trajeto->sugestoesCarona(5000, 24);

        return response()->view('motorista.sugestoes-carona', compact('sugestoes'))->header('Hx-Trigger-After-Settle', 'hidratarSugestoesCarona');
    }

    public function carona(Request $request, Trajeto $trajeto, int $pedidoID): Response
    {
        $trajeto->pedidosCarona()->attach($pedidoID);
        $trajeto->atualizarRota();

        return response('')->header('Hx-Trigger', 'atualizarRota');
    }

    public function iniciar(Request $request, Trajeto $trajeto): void
    {
        $trajeto->iniciar();
    }

    public function finalizar(Request $request, Trajeto $trajeto): void
    {
        $trajeto->finalizar();
    }

    public function embarcar(Request $request, int $trajetoID, int $caronaID): void
    {
        $carona = Carona::with(['trajeto', 'pedidoCarona'])
            ->where('trajeto_id', $trajetoID)
            ->findOrFail($caronaID);

        $carona->trajeto->localizacao_motorista = $carona->pedidoCarona->origem;
        $carona->trajeto->save();

        $carona->status = CaronaStatus::EM_ANDAMENTO;
        $carona->save();
    }
}
