<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use Auth;

class CartController extends Controller
{
    public function show()
    {
        return view("main.cart");
    }
    
    public function addToCart(Request $request)
    {
        $user_id = Auth::user()->id;
        $game = Game::where('name', $request->gamename)->first();
        
        //\Cart::
        
        return response()->json($game);
    }
}
