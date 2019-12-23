<?php

use App\Comment;
use App\Serie;
use App\User;
use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users_id = User::all('id')->pluck('id')->toArray();
        $series_id = Serie::all('id')->pluck('id')->toArray();
        $faker = Faker\Factory::create('fr_FR');
        factory(Comment::class, 100)->make()
            ->each(function($comment) use($users_id, $series_id,$faker){
                $comment->serie_id = $faker->randomElement($series_id);
                $comment->user_id = $faker->randomElement($users_id);
                $comment->save();
            });
    }
}
