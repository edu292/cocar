<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Organizacao extends Model
{
    protected $table = 'organizacoes';

    protected $fillable = ['nome', 'cnpj', 'dominio_email'];

    /**
     * @return HasMany<User,$this>
     */
    public function integrantes(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
