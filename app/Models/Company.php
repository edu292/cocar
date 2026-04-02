<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = ['name', 'cnpj', 'email_domain'];

    public function users()
    {
        $this->hasMany(User::class);
    }
}
