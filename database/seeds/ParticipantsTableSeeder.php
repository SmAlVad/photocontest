<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Generator as Faker;

class ParticipantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $participants = [];

        for ($i = 1; $i < 11; $i++) {
            $participants[] = [
                'ip' => "192.168.1.{$i}",

                'name' => "Участник {$i}",
                'email' => "{$i}mail@yendex.ru",
                'phone' => "+7-92" . rand(1,9) . "-444-90-4" . rand(0,9)
            ];
        }

        DB::table('participants')->insert($participants);
    }
}
