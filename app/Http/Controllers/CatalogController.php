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
        
        $game_categories = [];
        $categories_needed = [];
        
        if(isset($request->categories))
        {
            $sorted_games = [];
            $categories_needed = (is_array($request->categories)) ? $request->categories : array($request->categories);
            
            foreach($games as $game) //checking every game
            {
                //getting array of cetegories related to the game
                $game_categories = [];
                
                foreach($game->categories as $category)
                {
                    array_push($game_categories, $category->title);
                }
                
                if(array_intersect($categories_needed, $game_categories)) //this game does not have categories we need
                {
                    $sorted_games[] = $game;
                }
            }
            
            $games = $sorted_games; //refilling array with sorted by categories games
        }
        
        //sending all games at once
        if($request->ajax())
        {
            return view('main.ajax.sorted-games', [
                'games' => $games,
            ])->render();
            //return response()->json($categories_needed);
        }
        
        return view('main.catalog', [
            'games' => $games,
            'categories' => $all_categories
        ]);
    }
}
