<?php

namespace App\Models;

use App\Casts\PointCast;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\DB;

class PedidoCarona extends Model
{
    protected $table = 'pedidos_carona';

    protected $fillable = ['origem', 'destino', 'user_id'];

    protected $casts = [
        'origem' => PointCast::class,
        'destino' => PointCast::class,
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
                DB::raw('ST_AsGeoJSON(origem) as origem'),
                DB::raw('ST_AsGeoJSON(destino) as destino'),
            ]);
        });
    }
}
