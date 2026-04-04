<?php

namespace App\Models;

use App\Enums\TipoUsuario;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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

    public function eAdminOrganizacao(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->tipo == TipoUsuario::AdministradorOrganizacao
        );

    }

    protected function eAdminSistema(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->tipo == TipoUsuario::AdministradorSistema
        );
    }

    /**
     * @param  Builder<Model>  $query
     */
    public function scopeComStatusMotorista(Builder $query, ?string $filtroStatus = null): Builder
    {
        $query->withExists(['perfilMotorista as e_motorista'])
            ->withExists(['perfilMotorista as foi_aprovado' => function ($q) {
                $q->whereNotNull('aprovado_em');
            }]);

        return $query->when($filtroStatus, fn ($q) => match ($filtroStatus) {
            'aprovado' => $q->whereHas('perfilMotorista', fn ($sq) => $sq->whereNotNull('aprovado_em')),
            'pendente' => $q->whereHas('perfilMotorista', fn ($sq) => $sq->whereNull('aprovado_em')),
            default => $q,
        });
    }

    /**
     * @param  Builder<Model>  $query
     */
    public function scopePorTipo(Builder $query, ?string $tipo): Builder
    {
        return $query->when($tipo, function ($q) use ($tipo) {
            match ($tipo) {
                'admin-sistema' => $q->where('tipo', TipoUsuario::AdministradorSistema),
                'admin-organizacao' => $q->where('tipo', TipoUsuario::AdministradorOrganizacao),
                'motorista' => $q->whereHas('perfilMotorista'),
                'passageiro' => $q->where('tipo', TipoUsuario::Padrao)
                    ->whereDoesntHave('perfilMotorista'),
                default => $q,
            };
        });
    }

    public function homeUrl(): string
    {
        return match ($this->tipo) {
            TipoUsuario::AdministradorOrganizacao => 'admin.painel',
            TipoUsuario::AdministradorSistema => 'admin.painel',
            TipoUsuario::Padrao => 'home'
        };
    }
}
