<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;

class TestController extends Controller
{
    public function allGames()
    {
        $games = Game::all();
        return view('test', ['games' => $games]);
    }
}
