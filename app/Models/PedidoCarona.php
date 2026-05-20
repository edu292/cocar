<?php

namespace App\Models;

use App\Casts\PointCast;
use App\Enums\StatusCarona;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

/**
 * @property int $id
 * @property int $user_id
 * @property mixed $origem
 * @property mixed $destino
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Carona|null $carona
 * @property-read User $user
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PedidoCarona newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PedidoCarona newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PedidoCarona query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PedidoCarona whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PedidoCarona whereDestino($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PedidoCarona whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PedidoCarona whereOrigem($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PedidoCarona whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PedidoCarona whereUserId($value)
 *
 * @property string $endereco
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PedidoCarona whereEndereco($value)
 *
 * @property string $endereco_origem
 * @property string $endereco_destino
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PedidoCarona whereEnderecoDestino($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PedidoCarona whereEnderecoOrigem($value)
 *
 * @mixin \Eloquent
 */
class PedidoCarona extends Model
{
    protected $table = 'pedidos_carona';

    protected $fillable = ['origem_coords', 'origem_endereco', 'destino_coords', 'destino_endereco', 'user_id'];

    protected $casts = [
        'origem_coords' => PointCast::class,
        'destino_coords' => PointCast::class,
    ];

    /**
     * @return BelongsTo<User,PedidoCarona>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return HasOne<Carona,PedidoCarona>
     */
    public function carona(): HasOne
    {
        return $this->hasOne(Carona::class, 'pedido_carona_id');
    }

    public static function booted(): void
    {
        static::addGlobalScope('as_geojson', function ($builder) {
            $builder->addSelect([
                '*',
                DB::raw('ST_AsGeoJSON(origem_coords) as origem_coords'),
                DB::raw('ST_AsGeoJSON(destino_coords) as destino_coords'),
            ]);
        });
    }

    public function distanciaPercorrida(int $trajetoID): int
    {
        $query = '
        SELECT ST_Length(
            ST_LineSubstring(
                t.rota::geometry,
                ST_LineLocatePoint(t.rota::geometry, ST_GeomFromGeoJSON(:origem)),
                ST_LineLocatePoint(t.rota::geometry, ST_GeomFromGeoJSON(:destino))
            )::geography
        ) as distance_meters::INTEGER
        FROM trajetos t
        WHERE t.id = :trajeto_id
    ';

        $resultado = DB::selectOne($query, [
            'origem' => $this->origem,
            'destino' => $this->destino,
            'trajeto_id' => $trajetoID,
        ]);

        return $resultado->distance_meters ?? 0;
    }

    public function status(): StatusCarona
    {
        if (! $this->carona) {
            return StatusCarona::PROCURANDO_MOTORISTA;
        }

        return $this->carona->status;
    }
}
