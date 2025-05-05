<?php

namespace App\Http\Resources;

use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SerieResource extends JsonResource {
    /**
     * Transform the resource collection into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray(Request $request): array
    {
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
