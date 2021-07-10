<?php

namespace App\Http\Controllers\Adminka;

use App\Http\Controllers\Adminka\AdminkaController;
use Illuminate\Http\Request;
use App\Models\Game;

class AdminkaGameController extends AdminkaController
{
    public function index()
    {
        $games = Game::all();
        return response()->json($games, 200);
    }

    public function show(Request $request)
    {
        $game = Game::find($request->game);

        //if game with such id exists
        if($game != null)
        {
            return response()->json($game, 200);
        }

        return response()->json(["result" => false, "message" => "Not found game with id {$request->game}"], 404);
    }

    public function store(Request $request)
    {
        //validation checks
        if(!$this->validatePassword($request))
        {
            return response()->json(["result" => false, "message" => "Password is not correct"], 403);
        }

        Game::create($request->except('password'));
        return response()->json(["result" => true, "message" => "Created successfuly!"], 201);
    }

    public function update(Request $request)
    {
        //validation checks
        if(!$this->validatePassword($request))
        {
            return response()->json(["result" => false, "message" => "Password is not correct"], 403);
        }

        $game = Game::find($request->game);

        //if game with such id exists
        if($game != null)
        {
            $game->update($request->except('password'));
            return response()->json(["result" => true, "message" => "Updated successfuly!"], 200);
        }

        return response()->json(["result" => false, "message" => "Not found game with id {$request->game}"], 404);

        
    }

    public function destroy(Request $request)
    {
        //validation checks
        if(!$this->validatePassword($request))
        {
            return response()->json(["result" => false, "message" => "Password is not correct"], 403);
        }

        $game = Game::find($request->game);

        //if game with such id exists
        if($game != null)
        {
            $game->delete();
            return response()->json(["result" => true, "message" => "Deleted successfuly!"], 200);
        }

        return response()->json(["result" => false, "message" => "Not found game with id {$request->game}"], 404);
    }
}
