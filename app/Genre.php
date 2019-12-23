<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    // A genre has many series
    public function series() {
        return $this->belongsToMany("App\Serie");
    }
}
