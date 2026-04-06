<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class carteira extends Model
{
    protected $table = 'carteira';
    protected $fillable = ['saldo_atual', 'saldo_verde'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

};
