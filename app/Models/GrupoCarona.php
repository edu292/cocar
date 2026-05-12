<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// MODIFICADO: Adicionado use para o Builder
use Illuminate\Database\Eloquent\Builder;

class GrupoCarona extends Model
{

    protected $table = 'grupos_carona';
    protected $fillable = [
        'perfil_motorista_id',
        'nome',
        'frequencia',
        'vagas',
    ];

    // MODIFICADO: Adicionado Global Scope para filtrar pela organização do usuário logado
    protected static function booted()
    {
        static::addGlobalScope('organizacao', function (Builder $builder) {
            if (auth()->check()) {
                $user = auth()->user();
                if ($user->organizacao_id) {
                    $builder->whereHas('motorista.user', function ($query) use ($user) {
                        $query->where('organizacao_id', $user->organizacao_id);
                    });
                }
            }
        });
    }

    public function motorista()
    {
        return $this->belongsTo(PerfilMotorista::class, "perfil_motorista_id");
    }
    public function passageiros()
    {
        return $this->belongsToMany(User::class)
            ->withTimestamps();
    }
}
