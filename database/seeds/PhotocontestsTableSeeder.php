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
                'start' => '2019-08-14 00:00:00',
                'end' => '2019-09-14 23:59:59'
            ]
        ];

        DB::table('photocontests')->insert($photocontests);
    }
}
