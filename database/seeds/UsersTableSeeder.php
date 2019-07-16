<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Александр Семашко',
                'email' => 'san@2x2.su',
                'password' => bcrypt('zeuWae3a')
            ],
            [
                'name' => 'Серебренникова Нина',
                'email' => 'snm@2x2.su',
                'password' => bcrypt('eePie9ei')
            ]
        ];

        DB::table('users')->insert($users);
    }
}
