<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_id = 1;
        
        for($game_id = 1; $game_id <= 2; $game_id++)
        {
            for($i = 0; $i < 10; $i++)
            {
                DB::table('comments')->insert([
                    'commentText' => Str::random(125),
                    'user_id' => $user_id,
                    'game_id' => $game_id
                ]);
            }
        }
    }
}
