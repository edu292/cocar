<?php

namespace App\Models;

use App\Enums\TipoUsuario;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'tipo', 'organizacao_id', 'cpf'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'tipo' => TipoUsuario::class,
        ];
    }

    /**
     * @return BelongsTo<Organizacao,User>
     */
    public function Organizacao(): BelongsTo
    {
        return $this->belongsTo(Organizacao::class);
    }

    /**
     * @return HasOne<PerfilMotorista,User>
     */
    public function perfilMotorista(): HasOne
    {
        return $this->hasOne(PerfilMotorista::class);
    }

    /**
     * @param  Builder<Model>  $query
     */
    public function scopeComStatusMotorista(Builder $query): void
    {
        $query->withExists(['perfilMotorista as e_motorista'])
            ->withExists(['perfilMotorista as foi_aprovado' => function ($q) {
                $q->whereNotNull('aprovado_em');
            }]);
    }

    public function homeUrl()
    {
        return match ($this->tipo) {
            TipoUsuario::AdministradorOrganizacao => 'admin.painel',
            TipoUsuario::AdministradorSistema => 'admin.painel',
            TipoUsuario::Padrao => 'home'
        };
    }
}
