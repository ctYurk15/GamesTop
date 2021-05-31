<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;

class MainController extends Controller
{
    public function index()
    {
        $new_games = Game::orderBy("id", "DESC")->take(4)->get();
        
        //generating random ids for games
        $random_number_array = range(1, 13);
        shuffle($random_number_array);
        $random_number_array = array_slice($random_number_array, 1, 8);
        
        $random_games = Game::whereIn("id", $random_number_array)->get();
        
        return view("main.main", [
            'new_games' => $new_games,
            'random_games' => $random_games
        ]);
    }
}
