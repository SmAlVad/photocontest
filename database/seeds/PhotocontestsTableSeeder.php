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
                'end' => '2019-08-01 00:00:00'
            ],
            [
                'name' => 'za_rulem',
                'end' => '2019-09-01 00:00:00'
            ]
        ];

        DB::table('photocontests')->insert($photocontests);
    }
}
