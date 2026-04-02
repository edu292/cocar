<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Passageiro extends Model
{
    protected $fillable = [
        'user_id',
        'cpf',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

/**   
 * public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'id_empresa');
    }
**/
}
