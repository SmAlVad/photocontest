<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $images = [];

        for ($i = 1; $i < 11; $i++) {
            $images[] = [
                'photocontest_id' => 1,
                'participant_id' => $i,
                'file_name' => $i . '.jpg',
                'mime' => 'image/jpg',
                'ext' => 'jpg',
                'size' => rand(100, 300),
                'description' => 'Описание фотографии',
                'like' => rand(0,300),
                'is_active' => rand(0,1)
            ];
        }

        DB::table('images')->insert($images);
    }
}
