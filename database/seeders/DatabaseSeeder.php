<?php

namespace Database\Seeders;

use App\Models\Tweet;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create()->each(
            function ($user) {
                $user->tweets()->saveMany(Tweet::factory(5)->make());
            }// * Pour chaque utilisateurs créer, lui attribuer 5 tweets
        );
    }
}
