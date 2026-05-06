<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GrupoCarona extends Model
{

    protected $table = 'grupos_carona';
    protected $fillable = [
        'perfil_motorista_id',
        'nome',
        'frequencia',
        'vagas',
    ];

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
