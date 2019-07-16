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
                'start' => '2019-06-01 00:00:00',
                'end' => '2019-08-01 00:00:00'
            ],
            [
                'name' => 'za_rulem',
                'start' => '2019-07-01 00:00:00',
                'end' => '2019-09-01 00:00:00'
            ]
        ];

        DB::table('photocontests')->insert($photocontests);
    }
}
