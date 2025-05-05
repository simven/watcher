<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Episode extends Model
{
    /**
     * Un épisode est lié à une série.
     */
    public function serie(): BelongsTo
    {
        return $this->belongsTo(Serie::class, "serie_id");
    }

    /**
     * Un épisode a été vu par plusieurs utilisateurs.
     */
    public function seen(): BelongsToMany
    {
        return $this->belongsToMany(User::class,'seen');
    }
}
