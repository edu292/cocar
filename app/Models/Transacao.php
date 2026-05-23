<?php

namespace App\Models;

use App\Enums\StatusTransacao;
use App\Enums\TipoTransacao;
use DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $user_id
 * @property int $carona_id
 * @property string $tipo
 * @property string $status
 * @property numeric $valor
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transacao newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transacao newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transacao query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transacao whereCaronaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transacao whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transacao whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transacao whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transacao whereTipo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transacao whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transacao whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transacao whereValor($value)
 *
 * @property int|null $pedido_carona_id
 * @property int|null $trajeto_id
 * @property-read PedidoCarona|null $pedidoCarona
 * @property-read Trajeto|null $trajeto
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transacao wherePedidoCaronaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transacao whereTrajetoId($value)
 * @method static Builder<static>|Transacao withContextAndLedger()
 *
 * @mixin \Eloquent
 */
class Transacao extends Model
{
    protected $table = 'transacoes';

    protected $fillable = ['user_id', 'pedido_carona_id', 'tipo', 'status', 'trajeto_id', 'valor'];

    protected $casts = [
        'tipo' => TipoTransacao::class,
        'status' => StatusTransacao::class,
    ];

    /**
     * @return BelongsTo<PedidoCarona,Transacao>
     */
    public function pedidoCarona(): BelongsTo
    {
        return $this->belongsTo(PedidoCarona::class);
    }

    /**
     * @return BelongsTo<Trajeto,Transacao>
     */
    public function trajeto(): BelongsTo
    {
        return $this->belongsTo(Trajeto::class);
    }

    /**
     * @param  Builder<Model>  $query
     * @return Builder<Model>
     */
    public function scopeWithContextAndLedger(Builder $query): Builder
    {
        $query->with([
            'pedidoCarona.carona',
            'trajeto',
        ]);

        $rawCaseSql = "
        CASE 
            WHEN tipo IN ('deposito', 'reembolso', 'estorno') THEN valor
            WHEN tipo IN ('retencao', 'liquidacao') THEN -valor
            ELSE 0
        END
    ";

        $query->addSelect([
            'transacoes.*',
            'saldo_historico' => DB::raw("SUM($rawCaseSql) OVER (PARTITION BY user_id ORDER BY updated_at ASC, id ASC) as saldo_historico"),
        ])->orderBy('updated_at', 'desc');

        return $query;
    }
}
