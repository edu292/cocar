<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PerfilMotorista extends Model
{
    protected $fillable = ['cnh', 'aprovado_em'];
    protected $table = 'perfis_motorista';




    // relação entre quantos motoras podem haver por usuário
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function grupos(){
        return $this->hasMany(GrupoCarona::class, "perfil_motorista_id");
    }

    public function beneficios()
    {
        return $this->belongsToMany(Beneficio::class, 'beneficio_motorista')
            ->withPivot('km_acumulado', 'status', 'atingido_em')
            ->withTimestamps();
    }
}
