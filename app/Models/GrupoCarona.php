<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// MODIFICADO: Adicionado use para o Builder
use Illuminate\Database\Eloquent\Builder;

/**
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $perfil_motorista_id
 * @property string $nome
 * @property string $frequencia
 * @property int $vagas
 * @property array<array-key, mixed>|null $dias_semana
 * @property array<array-key, mixed>|null $dias_mes
 * @property-read \App\Models\PerfilMotorista $motorista
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $passageiros
 * @property-read int|null $passageiros_count
 * @method static Builder<static>|GrupoCarona newModelQuery()
 * @method static Builder<static>|GrupoCarona newQuery()
 * @method static Builder<static>|GrupoCarona query()
 * @method static Builder<static>|GrupoCarona whereCreatedAt($value)
 * @method static Builder<static>|GrupoCarona whereDiasMes($value)
 * @method static Builder<static>|GrupoCarona whereDiasSemana($value)
 * @method static Builder<static>|GrupoCarona whereFrequencia($value)
 * @method static Builder<static>|GrupoCarona whereId($value)
 * @method static Builder<static>|GrupoCarona whereNome($value)
 * @method static Builder<static>|GrupoCarona wherePerfilMotoristaId($value)
 * @method static Builder<static>|GrupoCarona whereUpdatedAt($value)
 * @method static Builder<static>|GrupoCarona whereVagas($value)
 * @mixin \Eloquent
 */
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
