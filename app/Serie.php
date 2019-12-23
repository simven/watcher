<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    protected $fillable = [
        'nom',
    ];

    // A serie has many episodes
    public function episodes() {
        return $this->hasMany("App\Episode", "serie_id");
    }

    // A serie has many comments
    public function comments() {
        return $this->hasMany("App\Comment", "serie_id");
    }

    // A serie has many genres
    public function genres() {
        return $this->belongsToMany("App\Genre", 'genre_serie');
    }

}
