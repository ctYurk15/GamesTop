<?php

namespace App\Http\Controllers\Adminka;

use App\Http\Controllers\Adminka\AdminkaController;
use Illuminate\Http\Request;
use App\Models\Category_Game;

class AdminkaCategoryGameController extends AdminkaController
{
    public function index(Request $request)
    {
        $categories_games = Category_Game::all();
        return response()->json($categories_games, 200);
    }

    public function show(Request $request)
    {
        $category_game = Category_Game::find($request->category_game);

        //if category_game with such id exists
        if($category_game != null)
        {
            return response()->json($category_game, 200);
        }

        return response()->json(["result" => false, "message" => "Not found category_game with id {$request->category_game}"], 404);
    }

    public function store(Request $request)
    {
        //validation checks
        if(!$this->validatePassword($request))
        {
            return response()->json(["result" => false, "message" => "Password is not correct"], 403);
        }

        Category_Game::create($request->except('password'));
        return response()->json(["result" => true, "message" => "Created successfuly!"], 201);
    }

    public function update(Request $request)
    {
        //validation checks
        if(!$this->validatePassword($request))
        {
            return response()->json(["result" => false, "message" => "Password is not correct"], 403);
        }

        $category_game = Category_Game::find($request->category_game);

        //if category_game with such id exists
        if($category_game != null)
        {
            $category_game->update($request->except('password'));
            return response()->json(["result" => true, "message" => "Updated successfuly!"], 200);
        }

        return response()->json(["result" => false, "message" => "Not found category_game with id {$request->category_game}"], 404);

        
    }

    public function destroy(Request $request)
    {
        //validation checks
        if(!$this->validatePassword($request))
        {
            return response()->json(["result" => false, "message" => "Password is not correct"], 403);
        }

        $category_game = Category_Game::find($request->category_game);

        //if category_game with such id exists
        if($category_game != null)
        {
            $category_game->delete();
            return response()->json(["result" => true, "message" => "Deleted successfuly!"], 200);
        }

        return response()->json(["result" => false, "message" => "Not found category_game with id {$request->category_game}"], 404);
    }
}
