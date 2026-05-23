<?php

namespace App\Services;

use App\Models\PedidoCarona;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class SugestaoCaronaService
{
    private int $distanciaMaximaSugestaoCarona = 5000;

    private int $limiteSugestoesCarona = 24;

    /**
     * @return Collection<int,Model>
     */
    public function obterSugestoesParaTrajeto(int $trajetoID): Collection
    {
        return PedidoCarona::withoutGlobalScope('as_geojson')
            ->from('pedidos_carona as p')
            ->select([
                'p.*',
                DB::raw('ST_AsGeoJSON(p.origem) as origem'),
                DB::raw('ST_AsGeoJSON(p.destino) as destino'),
                DB::raw('ST_Distance(p.origem, t.rota)::float AS desvio_metros'),
            ])
            ->join('trajetos as t', function ($j) {
                $j->whereRaw('ST_DWithin(p.origem, t.rota, ?::float)', [$this->distanciaMaximaSugestaoCarona])
                    ->whereRaw('ST_DWithin(p.destino, t.destino, ?::float)', [$this->distanciaMaximaSugestaoCarona]);
            })
            ->where('t.id', $trajetoID)
            ->whereNotExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('caronas')
                    ->whereColumn('caronas.pedido_carona_id', 'p.id');
            })
            ->orderBy(DB::raw('ST_Distance(p.origem, t.rota)'))
            ->limit($this->limiteSugestoesCarona)
            ->get();
    }
}
