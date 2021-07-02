<?php

namespace App\Http\Controllers\Adminka;

use App\Http\Controllers\Adminka\AdminkaController;
use Illuminate\Http\Request;
use App\Models\Gamekey;

class AdminkaGamekeyController extends AdminkaController
{
    public function index()
    {
        $gamekeys = Gamekey::all();
        return response()->json($gamekeys, 200);
    }

    public function show(Request $request)
    {
        $gamekey = Gamekey::find($request->gamekey);

        //if gamekey with such id exists
        if($gamekey != null)
        {
            return response()->json($gamekey, 200);
        }

        return response()->json(["result" => false, "message" => "Not found gamekey with id {$request->gamekey}"], 404);
    }

    public function store(Request $request)
    {
        //validation checks
        if(!$this->validatePassword($request))
        {
            return response()->json(["result" => false, "message" => "Password is not correct"], 403);
        }

        Gamekey::create($request->only(['id', 'game_id', 'code']));
        return response()->json(["result" => true, "message" => "Created successfuly!"], 201);
    }

    public function update(Request $request)
    {
        //validation checks
        if(!$this->validatePassword($request))
        {
            return response()->json(["result" => false, "message" => "Password is not correct"], 403);
        }

        $gamekey = Gamekey::find($request->gamekey);

        //if gamekey with such id exists
        if($gamekey != null)
        {
            $gamekey->update($request->only(['id', 'game_id', 'code']));
            return response()->json(["result" => true, "message" => "Updated successfuly!"], 200);
        }

        return response()->json(["result" => false, "message" => "Not found gamekey with id {$request->gamekey}"], 404);
    }

    public function destroy(Request $request)
    {
        //validation checks
        if(!$this->validatePassword($request))
        {
            return response()->json(["result" => false, "message" => "Password is not correct"], 403);
        }

        $gamekey = Gamekey::find($request->gamekey);
        
        //if gamekey with such id exists
        if($gamekey != null)
        {
            $gamekey->delete();
            return response()->json(["result" => true, "message" => "Deleted successfuly!"], 200);
        }

        return response()->json(["result" => false, "message" => "Not found gamekey with id {$request->gamekey}"], 404);
    }
}
