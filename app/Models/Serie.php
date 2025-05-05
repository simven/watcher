<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Serie extends Model
{
    protected $fillable = [
        'nom',
    ];

    /**
     * Une série a plusieurs épisodes.
     */
    public function episodes(): HasMany
    {
        return $this->hasMany(Episode::class, 'serie_id');
    }

    /**
     * Une série a plusieurs commentaires.
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'serie_id');
    }

    /**
     * Une série appartient à plusieurs genres.
     */
    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class, 'genre_serie');
    }
}
