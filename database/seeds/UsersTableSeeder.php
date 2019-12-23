<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Robert Duchmol',
            'email' => 'robert.duchmol@domain.fr',
            'email_verified_at' => now(),
            'password' => '$2y$10$Vd0DNeMXTPof8fT2XoiEuuBi.13ictNwuOXHTCDWS.JDMOA4DEPGa', // secret
            'remember_token' => Str::random(10),
            'administrateur' => true,
            'avatar' => 'storage/avatar/duchmol.png'
        ]);
        User::create([
            'name' => 'Julie Nobel',
            'email' => 'julie.nobel@domain.fr',
            'email_verified_at' => now(),
            'password' => '$2y$10$Vd0DNeMXTPof8fT2XoiEuuBi.13ictNwuOXHTCDWS.JDMOA4DEPGa', // secret
            'remember_token' => Str::random(10),
            'administrateur' => false,
            'avatar' => 'storage/avatar/nobel.png'
        ]);

    }
}
