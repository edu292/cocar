<?php

namespace App\Services;

use App\Enums\StatusCarona;
use App\Enums\StatusTrajeto;
use App\Models\Carona;
use App\Models\PedidoCarona;
use App\Models\Trajeto;
use App\ValueObjects\Point;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class TrajetoService
{
    private int $gapAceitavelDistanciaWaypoint = 500;

    private int $custoKM = 2;

    public function __construct(protected PagamentoService $pagamentoService, protected MapApiService $mapApiService) {}

    public function novoTrajeto(string $origemEndereco, Point $origem, string $destinoEndereco, Point $destino, int $userID): Trajeto
    {
        $result = $this->mapApiService->obterRotaDireta($origem, $destino);
        $geometry = $result->routes[0]->geometry;

        return Trajeto::create([
            'origem_endereco' => $origemEndereco,
            'origem' => $origem,
            'destino_endereco' => $destinoEndereco,
            'destino' => $destino,
            'rota' => $geometry,
            'user_id' => $userID,
        ]);
    }

    public function iniciarTrajeto(Trajeto $trajeto): void
    {
        $trajeto->update([
            'horario_inicio' => now(),
            'localizacao_motorista' => $trajeto->origem,
            'status' => StatusTrajeto::EM_ANDAMENTO,
        ]);
    }

    public function finalizarTrajeto(Trajeto $trajeto): void
    {
        $trajeto->update([
            'horario_fim' => now(),
            'localizacao_motorista' => DB::raw('destino_coords'),
            'status' => StatusTrajeto::CONCLUIDO,
        ]);

        $trajeto->caronas()
            ->where('status', StatusCarona::EM_ANDAMENTO)
            ->update(['status' => StatusCarona::CONCLUIDA]);
    }

    public function atualizarRota(Trajeto $trajeto): void
    {
        $paradas = $this->obterParadas($trajeto)->pluck('coord')->toArray();
        $result = $this->mapApiService->obterRotaOtimizada($paradas);

        DB::transaction(function () use ($trajeto, $result) {
            $geometry = $result->routes[0]->geometry;
            $trajeto->update(['rota' => $geometry]);

            $waypoints = $result->waypoints;
            array_shift($waypoints);
            array_pop($waypoints);

            foreach ($waypoints as $waypoint) {
                $carona = $trajeto->caronas()->whereHas(PedidoCarona::class, function ($query) use ($waypoint) {
                    $query->whereRaw(
                        'ST_DWithin(origem::geography, ST_SetSRID(ST_MakePoint(?, ?), 4326)::geography, ?)',
                        [$waypoint->longitude, $waypoint->latitude, $this->gapAceitavelDistanciaWaypoint]
                    );
                })->first();
                $carona->update(['ordem_parada' => $waypoint - index]);
            }
        });
    }

    public function obterParadas(Trajeto $trajeto): Collection
    {
        $trajeto->loadMissing('caronas.pedidoCarona');
        $paradas = $this->caronas->map(fn ($carona) => [
            'carona_id' => $carona->id,
            'coord' => $carona->pedidoCarona->origem,
        ]);

        $paradas->prepend([
            'carona_id' => null,
            'coord' => $this->origem,
        ]);

        $paradas->push([
            'carona_id' => null,
            'coord' => $this->destino,
        ]);

        return $paradas;
    }

    private function calcularDistanciaCarona(Trajeto $trajeto, PedidoCarona $pedidoCarona): int
    {
        $resultado = DB::selectOne('
        SELECT ST_Length(
            ST_LineSubstring(
                :rota::geometry,
                ST_LineLocatePoint(:rota::geometry, :origem::geometry),
                ST_LineLocatePoint(:rota::geometry, :destino::geometry)
            )::geography
        ) AS distancia::INTEGER
    ', [
            'rota' => $trajeto->getRawOriginal('rota'),
            'origem' => $pedidoCarona->getRawOriginal('origem'),
            'destino' => $pedidoCarona->getRawOriginal('destino'),
        ]);

        return $resultado?->distancia ?? 0;
    }

    public function vincularPassgeiro(Trajeto $trajeto, PedidoCarona $pedidoCarona): Carona
    {
        $passageiro = $pedidoCarona->user;

        $distancia = $this->calcularDistanciaCarona($trajeto, $pedidoCarona);
        $valorReter = bcmul($this->custoKM, (string) $distancia, 2);

        return DB::transaction(function () use ($trajeto, $pedidoCarona, $passageiro, $valorReter) {

            $carona = $trajeto->caronas()->create([
                'pedido_carona_id' => $pedidoCarona->id,
                'status' => StatusCarona::AGUARDANDO_EMBARQUE,
            ]);

            $this->pagamentoService->reterValor($passageiro, $valorReter, $carona->id);

            return $carona;
        });
    }
}
