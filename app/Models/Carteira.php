<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Carteira extends Model
{
    protected $fillable = [
        'user_id',
    ];

    /**
     * @return BelongsTo<User,Carteira>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
