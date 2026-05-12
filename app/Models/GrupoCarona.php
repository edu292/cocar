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
        'dias_semana', // MODIFICADO: adicionado suporte ao campo array
        'dias_mes',    // MODIFICADO: adicionado suporte ao campo array
        'vagas',
    ];

    // MODIFICADO: Casts para interpretar campos JSON como Array
    protected function casts(): array
    {
        return [
            'dias_semana' => 'array',
            'dias_mes' => 'array',
        ];
    }

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

    // MODIFICADO: Helper para formatar a saída de frequência dinamicamente nas Views
    public function frequenciaFormatada(): string
    {
        if ($this->frequencia === 'semanal' && !empty($this->dias_semana)) {
            $mapa = ['seg' => 'Seg', 'ter' => 'Ter', 'qua' => 'Qua', 'qui' => 'Qui', 'sex' => 'Sex', 'sab' => 'Sáb', 'dom' => 'Dom'];
            $dias = array_map(fn($d) => $mapa[$d] ?? $d, $this->dias_semana);
            return 'Semanal (' . implode(', ', $dias) . ')';
        }
        
        if ($this->frequencia === 'mensal' && !empty($this->dias_mes)) {
            $dias = $this->dias_mes;
            sort($dias);
            return 'Mensal (Dias ' . implode(', ', $dias) . ')';
        }
        
        return ucfirst($this->frequencia);
    }
}
