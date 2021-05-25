<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;

class CatalogController extends Controller
{
    public function index()
    {
        $games = Game::all();
        return view('main.catalog', [
            'games' => $games
        ]);
    }
}
