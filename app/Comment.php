<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    // A comment is written by an user
    public function utilisateur() {
        return $this->belongsTo("App\User", "user_id");
    }

    // A comment is dedicated to a serie
    public function serie() {
        return $this->belongsTo("App\Serie", "serie_id");
    }
}
