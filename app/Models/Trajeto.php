<?php

namespace App\Models;

use App\Casts\GeoJSONCast;
use App\Casts\PointCast;
use App\Enums\CaronaStatus;
use App\Enums\TrajetoStatus;
use App\ValueObjects\Point;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use stdClass;

class Trajeto extends Model
{
    public $timestamps = false;

    protected $fillable = ['origem', 'destino', 'rota', 'distancia_percorrida', 'custo_total', 'motorista'];

    protected $casts = [
        'origem' => PointCast::class,
        'destino' => PointCast::class,
        'rota' => GeoJSONCast::class,
        'localizacao_motorista' => PointCast::class,
    ];

    /**
     * @return BelongsTo<User,Carona>
     */
    public function motorista(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function pedidosCarona(): BelongsToMany
    {
        return $this->belongsToMany(PedidoCarona::class, 'caronas', 'trajeto_id', 'pedido_carona_id')->withPivot('status', 'ordem');
    }

    /**
     * @return HasMany<Carona,Trajeto>
     */
    public function caronas(): HasMany
    {
        return $this->hasMany(Carona::class);
    }

    public function iniciar(): void
    {
        $this->horario_inicio = now();
        $this->status = TrajetoStatus::EM_ANDAMENTO;
        $this->caronas()->where('status', CaronaStatus::AGUARDANDO_INICIO)->update(['status' => CaronaStatus::MOTORISTA_A_CAMINHO]);
        $this->localizacao_motorista = $this->origem;
        $this->save();
    }

    public function finalizar(): void
    {
        $this->horario_fim = now();
        $this->localizacao_motorista = $this->destino;
        $this->status = TrajetoStatus::CONCLUIDO;
        $this->caronas()->where('status', CaronaStatus::EM_ANDAMENTO)->update(['status' => CaronaStatus::CONCLUIDA]);
        $this->save();
    }

    public function atualizarRota(): void
    {
        DB::transaction(function () {
            $paradas = $this->paradas()->pluck('coord')->toArray();
            $path = 'optimized-trips/v1/mapbox/driving-traffic/'.Point::formatPoints(...$paradas);
            $res = Http::mapbox()->get($path, ['roundtrip' => 'false', 'source' => 'first', 'destination' => 'last']);
            $data = $res->json();
            $this->rota = $data['trips'][0]['geometry'];
            $this->save();

            $waypoints = $data['waypoints'];
            array_shift($waypoints);
            array_pop($waypoints);
            foreach ($waypoints as $waypoint) {
                $pedido = $this->pedidosCarona()
                    ->whereRaw('ST_DWithin(origem::geography, ST_SetSRID(ST_MakePoint(?, ?), 4326)::geography, ?)', [$waypoint['location'][0], $waypoint['location'][1], 500])
                    ->first();
                $pedido->pivot->ordem = $waypoint['waypoint_index'];
                $pedido->pivot->save();
            }
        });

    }

    /**
     * @return Collection<int,stdClass>
     */
    public function sugestoesCarona(float $dist, int $limit): Collection
    {
        return PedidoCarona::withoutGlobalScope('as_geojson')
            ->from('pedidos_carona as p')
            ->select([
                'p.*',
                DB::raw('ST_AsGeoJSON(p.origem) as origem'),
                DB::raw('ST_AsGeoJSON(p.destino) as destino'),
                DB::raw('ST_Distance(p.origem, t.rota)::float AS desvio_metros'),
            ])
            ->join('trajetos as t', function ($j) use ($dist) {
                $j->whereRaw('ST_DWithin(p.origem, t.rota, ?::float)', [$dist])
                    ->whereRaw('ST_DWithin(p.destino, t.destino, ?::float)', [$dist]);
            })
            ->where('t.id', $this->id)
            ->whereNotExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('caronas')
                    ->whereColumn('caronas.pedido_carona_id', 'p.id');
            })
            ->orderBy(DB::raw('ST_Distance(p.origem, t.rota)'))
            ->limit($limit)
            ->get();
    }

    /**
     * @return Collection<array-key,mixed>
     */
    public function paradas(): Collection
    {
        $mid = $this->caronas->map(fn ($carona) => [
            'carona_id' => $carona->id,
            'coord' => $carona->pedidoCarona->origem,
        ]);

        $mid->prepend([
            'carona_id' => null,
            'coord' => $this->origem,
        ]);

        $mid->push([
            'carona_id' => null,
            'coord' => $this->destino,
        ]);

        return $mid;
    }

    protected static function booted(): void
    {
        static::addGlobalScope('as_geojson', function ($builder) {
            $builder->addSelect([
                '*',
                DB::raw('ST_AsGeoJSON(origem) as origem'),
                DB::raw('ST_AsGeoJSON(destino) as destino'),
                DB::raw('ST_AsGeoJSON(rota) as rota'),
                DB::raw('ST_AsGeoJSON(localizacao_motorista) as localizacao_motorista'),
            ]);
        });
    }
}
