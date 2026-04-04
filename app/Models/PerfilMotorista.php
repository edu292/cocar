<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PerfilMotorista extends Model
{
    protected $table = 'perfis_motorista';

    protected $fillable = ['cnh', 'aprovado_em'];

    /**
     * @return BelongsTo<User,PerfilMotorista>
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
