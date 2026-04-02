<?php

namespace App\Models;

use App\Enums\PapelUsuario;
use App\Enums\StatusUsuario;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'papel', 'status', 'empresa_id'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'papel' => PapelUsuario::class,
            'status' => StatusUsuario::class,
        ];
    }

    /**
     * @return HasOne<Passageiro,User>
     */
    public function passageiro(): HasOne
    {
        return $this->hasOne(Passageiro::class);
    }

    /**
     * @return BelongsTo<Empresa,User>
     */
    public function empresa(): BelongsTo
    {
        return $this->belongsTo(Empresa::class);
    }
}
