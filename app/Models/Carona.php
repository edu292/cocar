<?php

namespace App\Models;

use App\Enums\CaronaStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Carona extends Model
{
    protected $fillable = ['status', 'ordem'];

    protected $casts = ['status' => CaronaStatus::class];

    /**
     * @return BelongsTo<Trajeto,Carona>
     */
    public function trajeto(): BelongsTo
    {
        return $this->belongsTo(Trajeto::class, 'trajeto_id');
    }

    /**
     * @return BelongsTo<PedidoCarona,Carona>
     */
    public function pedidoCarona(): BelongsTo
    {
        return $this->belongsTo(PedidoCarona::class, 'pedido_carona_id');
    }
}
