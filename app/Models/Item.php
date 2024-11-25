<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Item extends Model
{
    protected $fillable = [
        'name',
        'link',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
