<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\Category;

class CatalogController extends Controller
{
    public function index(Request $request)
    {
        $games = Game::all();
        $all_categories = Category::all();
        
        //sorting
        if(isset($request->orderBy))
        {
            if($request->orderBy == "name-a-z")
            {
                $games = Game::orderBy("name")->get();
            }
            if($request->orderBy == "name-z-a")
            {
                $games = Game::orderBy("name", "DESC")->get();
            }
            if($request->orderBy == "price-low-high")
            {
                $games = Game::orderBy("price")->get();
            }
            if($request->orderBy == "price-high-low")
            {
                $games = Game::orderBy("price", "DESC")->get();
            }
        }
        
        //sending all games at once
        if($request->ajax())
        {
            return view('main.ajax.sorted-games', [
                'games' => $games,
            ])->render();
        }
        
        return view('main.catalog', [
            'games' => $games,
            'categories' => $all_categories
        ]);
    }
}
