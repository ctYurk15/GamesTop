<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Support\Facades\DB;
use Auth;

class GamePageController extends Controller
{
    public function show($alias)
    {
        $game = Game::where('alias', $alias)->first();
        
        return view('main.gamepage', [
            'game' => $game
        ]);
    }
    
    public function addComment(Request $request)
    {
        //getting received data
        $commentText = $request->commentText;
        $gamename = $request->gamename;
        
        //getting ids 
        $user_id = Auth::user()->id;
        $game_id = Game::where('name', $gamename)->first()->id;
        
        //creating new comment
        $newComment = new Comment;
        $newComment->commentText = $commentText;
        $newComment->game_id = $game_id;
        $newComment->user_id = $user_id;
        $newComment->save();
        
        $all_comments = Comment::where('game_id', $game_id)->get();
        
        return view('main.ajax.comments', [
            'comments' => $all_comments
        ])->render();
    }
}
