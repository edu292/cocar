<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Empresa extends Model
{
    protected $table = 'empresas';

    protected $fillable = ['name', 'cnpj', 'dominio_email'];

    /**
     * @return HasMany<User,$this>
     */
    public function usuarios(): HasMany
    {
        return $this->hasMany(User::class, 'empresa_id');
    }
}
