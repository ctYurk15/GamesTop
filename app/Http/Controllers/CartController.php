<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\Order;
use Auth;

class CartController extends Controller
{
    public function show()
    {
        $orders = null;
        $authorized = false;
        
        if(Auth::check())
        {
            //if user is loggined we have things to show   
            $user_id = Auth::user()->id;
            $orders = Order::where('user_id', $user_id)->get();
            
            $authorized = true;
        }
        
        return view("main.cart", [
            "orders" => $orders,
            "authorized" => $authorized
        ]);
    }
    
    public function addToCart(Request $request)
    {
        $user_id = Auth::user()->id;
        $game_id = Game::where('name', $request->gamename)->first()->id;
        
        $result = false;
        
        /* 
            If order with this game is already exists, we need only to increase it 
            Else we need to create new order
        */
        
        $order = Order::where('game_id', $game_id)->where('user_id', $user_id)->first();
        
        if($order != null)
        {
            $values = $order->toArray(); //I dont know how I can get `count` column in another way
            
            //getting current count, and increasing it
            $newCount = $values['count'] + 1;
            $order->update(['count' => $newCount]);
            
            $result = true;
        }
        else
        {
            //creating new order
            $order = new Order;
            
            $order->game_id = $game_id;
            $order->user_id = $user_id;
            $order->count = 1;
            
            $order->save();
            
            $result = true;
        }
        
        return response()->json($result);
    }
}
