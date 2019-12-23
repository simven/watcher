<?php

use App\Genre;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class GenresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('genres')->delete();
        $json = File::get('data/genres.json');
        $data = json_decode($json);
        foreach ($data as $obj) {
            Genre::create([
                'nom' => $obj->nom,
            ]);
        }
    }
}
