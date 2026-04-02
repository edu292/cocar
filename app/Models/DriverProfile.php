<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class DriverProfile extends Model
{
    protected $fillable = ['cnh'];

    /**
     * @return HasOne<User,DriverProfile>
     */
    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }
}
