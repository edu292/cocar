<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beneficio extends Model
{
    use HasFactory;

    protected $fillable = [
        'organizacao_id',
        'nome',
        'descricao',
        'meta_km',
    ];

    public function organizacao()
    {
        return $this->belongsTo(Organizacao::class);
    }
    public function motoristas()
    {
        return $this->belongsToMany(PerfilMotorista::class, 'beneficio_motorista')
            ->withPivot('km_acumulado', 'status', 'atingido_em')
            ->withTimestamps();
    }
}
