<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;

class GamePageController extends Controller
{
    public function show($alias)
    {
        $game = Game::where('alias', $alias)->first();
        return view('main.gamepage', [
            'game' => $game
        ]);
    }
}
