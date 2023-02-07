<?php

namespace Database\Seeders;

use App\Models\Album;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AlbumTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $library = config('db-enrico');

        foreach($library as $record){
            $new_record = new Album();

            $new_record->title = $record['title'];
            $new_record->author = $record['author'];
            $new_record->thumb = stripslashes($record['cover_img']);
            $new_record->release_year = $record['release_year'];

            $new_record->save();
        }
    }
}
