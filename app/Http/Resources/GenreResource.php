<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

//use Illuminate\Http\Resources\Json\ResourceCollection;

class GenreResource extends JsonResource {
    /**
     * Transform the resource collection into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request) {
        return [
            "nom" => $this->nom
        ];

    }

    // A genre has many series
    public
    function series() {
        return $this->belongsToMany("App\Serie");
    }
}
