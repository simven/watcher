<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Genre extends Model
{
    /**
     * Un genre a plusieurs séries.
     */
    public function series(): BelongsToMany
    {
        return $this->belongsToMany(Serie::class);
    }
}
