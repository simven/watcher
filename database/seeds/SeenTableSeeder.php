<?php

use App\Episode;
use App\User;
use Illuminate\Database\Seeder;

class SeenTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users_id = User::all('id')->pluck('id')->toArray();
        $episodes_id = Episode::all('id')->pluck('id')->toArray();

        $faker = Faker\Factory::create('fr_FR');
        $echantillonsEpisodes = $faker->randomElements($episodes_id, $faker->numberBetween(100,300),false);
        foreach ($users_id as $id) {
            $echantillonsEpisodes = $faker->randomElements($episodes_id, $faker->numberBetween(100,300),false);
            $user = User::find($id);
            $user->seen()->attach($echantillonsEpisodes);
        }
    }
}
