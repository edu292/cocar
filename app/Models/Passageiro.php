<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Passageiro extends Model
{
    protected $fillable = [
        'user_id',
        'cpf',
    ];

    /**
     * @return BelongsTo<User,$this>
     */
    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Alias para manter compatibilidade com código antigo.
     *
     * @return BelongsTo<User,$this>
     */
    public function user(): BelongsTo
    {
        return $this->usuario();
    }
}
