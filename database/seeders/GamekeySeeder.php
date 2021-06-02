<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class GamekeySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($game = 13; $game <= 22; $game++)
        {
            for($index = 0; $index < 10; $index++)
            {
                DB::table('gamekeys')->insert([
                    'code' => "AAAA{$index}-AAAAA-AAAAA-AAAAA-AAAAA",
                    'game_id' => $game
                ]);
            }
        }
    }
}
