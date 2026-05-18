<?php

namespace App\Http\Controllers;

use App\Models\PedidoCarona;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PedidoCaronaController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'origem' => 'required',
            'destino' => 'required',
        ]);

        $pedidoCarona = PedidoCarona::create([
            ...$validated,
            'user_id' => $request->user()->id,
        ]);

        return to_route('pedido-carona.show', ['pedidoCarona' => $pedidoCarona->id]);
    }

    public function show(Request $request, PedidoCarona $pedidoCarona): View
    {

        return view('passageiro.mapa', compact('pedidoCarona'));
    }

    public function destroy(Request $request, PedidoCarona $pedidoCarona): RedirectResponse
    {
        $pedidoCarona->delete();

        return to_route($request->user()->homeUrl);
    }
}
