<?php

use App\Episode;
use App\Genre;
use App\Serie;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class SeriesTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('series')->delete();
        $json = File::get('data/baseSeries.json');
        $data = json_decode($json);
        foreach ($data as $obj) {
            $serie = Serie::create([
                'nom' => $obj->nom,
                'resume' => $obj->resume,
                'langue' => $obj->language,
                'note' => $obj->note,
                'statut' => $obj->statut,
                'premiere' => $obj->premiere,
                'urlImage' => $obj->urlImage,
                'avis' => $obj->avis,
            ]);
            $ids = [];
            foreach ($obj->genres as $genre) {
                $ids[] = Genre::where('nom', $genre)->pluck('id')->first();
            }
            $serie->genres()->attach($ids);
            foreach ($obj->episodes as $e) {
                if ($e->premiere == '0000-00-00')
                    $e->premiere = null;
                $episode = Episode::create([
                    'nom' => $e->nom,
                    'serie_id' => $serie->id,
                    'resume' => $e->resume,
                    'numero' => $e->numero,
                    'saison' => $e->saison,
                    'duree' => $e->duree,
                    'premiere' => $e->premiere,
                    'urlImage' => $e->urlImage
                ]);
            }
        }
    }
}
