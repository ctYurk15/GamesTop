<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;

class GamePageController extends Controller
{
    public function show($id)
    {
        $game = Game::where('id', $id)->first();
        return view('main.gamepage', [
            'game' => $game
        ]);
    }
}
