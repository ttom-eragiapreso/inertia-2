<?php

namespace Database\Seeders;

use App\Models\Album;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AlbumUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i < 50; $i++){

            $user = User::inRandomOrder()->first();

            $album_id = Album::inRandomOrder()->first()->id;

            $user->albums()->attach($album_id);

        }
    }
}
