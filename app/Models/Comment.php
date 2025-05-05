<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    /**
     * Un commentaire est écrit par un utilisateur.
     */
    public function utilisateur(): BelongsTo
    {
        return $this->belongsTo(User::class, "user_id");
    }

    /**
     * Un commentaire est dédié à une série.
     */
    public function serie(): BelongsTo
    {
        return $this->belongsTo(Serie::class, "serie_id");
    }
}
