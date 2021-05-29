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
        
        //sorting games by categories
        if(isset($request->categories))
        {
            $sorted_games = [];
            $categories_needed = [];
            
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
        
        //sorting games by price
        if(isset($request->minPrice) || isset($request->maxPrice))
        {
            $sorted_games = [];
            
            //what prices should we use
            $minPrice = (isset($request->minPrice) && $request->minPrice != 'NaN') ? $request->minPrice : null;
            $maxPrice = (isset($request->maxPrice) && $request->maxPrice != 'NaN') ? $request->maxPrice : null;
            
            foreach($games as $game)
            {
                $fits = true;
                
                if($minPrice != null && $game->price < $minPrice) //if game is cheaper than we need
                {
                    $fits = false;
                }
                if($maxPrice != null && $game->price > $maxPrice) //if game is more expensive than we need
                {
                    $fits = false;
                }
                
                if($fits) //if price is in right range
                {
                    $sorted_games[] = $game;
                }
            }
            
            $games = $sorted_games; //refilling array with sorted by price games
        }
        
        //sending all games at once
        if($request->ajax())
        {
            return view('main.ajax.sorted-games', [
                'games' => $games
            ])->render();
            //return response()->json([$minPrice, $maxPrice]);
        }
        
        return view('main.catalog', [
            'games' => $games,
            'categories' => $all_categories
        ]);
    }
}
