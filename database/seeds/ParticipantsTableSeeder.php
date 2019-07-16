<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            ];
        }

        DB::table('participants')->insert($participants);
    }
}
