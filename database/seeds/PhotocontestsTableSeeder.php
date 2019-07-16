<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PhotocontestsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $photocontests = [
            [
                'name' => 'karapuzy',
            ],
            [
                'name' => 'za_rulem',
            ]
        ];

        DB::table('photocontests')->insert($photocontests);
    }
}
