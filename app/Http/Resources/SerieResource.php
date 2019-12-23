<?php

namespace App\Http\Resources;

use App\Genre;
use Illuminate\Http\Resources\Json\JsonResource;
//use Illuminate\Http\Resources\JsonResource;
use Illuminate\Support\Facades\Log;

class SerieResource extends JsonResource {
    /**
     * Transform the resource collection into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request) {
        //Log::info($this);
        $genres = Genre::where('serie_id', $this->id)->pluck('nom');
        return [
            "id" => $this->id,
            "nom" => $this->nom,
            "resume" => $this->resume,
            "language" => $this->langue,
            "note" => $this->note,
            "statut" => $this->statut,
            "premiere" => $this->premiere,
            "urlImage" => $this->urlImage,
            "avis" => $this->avis,
            "comments" => CommentResource::collection($this->comments),
            "episodes" => EpisodeResource::collection($this->episodes),
            "genres" => $genres,
        ];

        //return parent::toArray($request);
    }
}
