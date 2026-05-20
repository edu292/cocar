<?php

namespace App\Http\Controllers;

use App\Models\PedidoCarona;
use App\Services\PagamentoService;
use App\Services\PedidoCaronaService;
use App\ValueObjects\Point;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class PedidoCaronaController extends Controller
{
    public function estimativa(Request $request, PedidoCaronaService $service): Response
    {
        $validated = $request->validate([
            'origem_coords' => 'required',
            'destino_coords' => 'required',
        ]);

        $estimativa = $service->estimativaCusto(
            Point::from($validated['origem_coords']),
            Point::from($validated['destino_coords']),
            $request->user()
        );

        return response(view('passageiro.estimativa', compact('estimativa')));
    }

    public function store(Request $request, PedidoCaronaService $service): RedirectResponse
    {
        $validated = $request->validate([
            'origem_coords' => 'required',
            'origem_endereco' => 'required',
            'destino_coords' => 'required',
            'destino_endereco' => 'required',
        ]);
        $validated['origem_coords'] = Point::from($validated['origem_coords']);
        $validated['destino_coords'] = Point::from($validated['destino_coords']);

        $pedidoCarona = $service->novoPedido(
            $validated,
            $request->user(),
        );

        return to_route('pedido-carona.show', ['pedidoCarona' => $pedidoCarona->id]);
    }

    public function show(Request $request, PedidoCarona $pedidoCarona, PagamentoService $pagamentoService): View
    {
        return view('passageiro.mapa', compact('pedidoCarona'));
    }

    public function destroy(Request $request, PedidoCarona $pedidoCarona): RedirectResponse
    {
        $pedidoCarona->delete();

        return to_route($request->user()->homeUrl());
    }
}
