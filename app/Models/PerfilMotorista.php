<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $user_id
 * @property string $cnh
 * @property string|null $aprovado_em
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Beneficio> $beneficios
 * @property-read int|null $beneficios_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\GrupoCarona> $grupos
 * @property-read int|null $grupos_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PerfilMotorista newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PerfilMotorista newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PerfilMotorista query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PerfilMotorista whereAprovadoEm($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PerfilMotorista whereCnh($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PerfilMotorista whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PerfilMotorista whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PerfilMotorista whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PerfilMotorista whereUserId($value)
 * @mixin \Eloquent
 */
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
