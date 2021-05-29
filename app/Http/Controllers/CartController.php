<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\Order;
use Auth;

class CartController extends Controller
{
    public function cartSum($user_id)
    {
        $result = 0;
        
        $orders = Order::select()->where('user_id', $user_id)->get();
        
        foreach($orders as $order)
        {
            //getting count&price 
            $count = doubleval($order->count);
            $price = doubleval($order->game->price);
            
            $result += $count * $price;
        }
        
        return $result;
    }
    
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
            
            return view("main.cart", [
                "orders" => $orders,
                "authorized" => $authorized,
                "cartSum" => $this->cartSum($user_id)
            ]);
        }
        
        return view("main.cart", [
            "orders" => $orders,
            "authorized" => $authorized,
        ]);
    }
    
    public function changeCart(Request $request)
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
            
            $increaseCount = 1;
            if(isset($request->changeCount)) //if we`re changing count from cart
            {
                $increaseCount = $request->changeCount;
            }
            
            //getting current count, and increasing/decreasing it
            $newCount = $values['count'] + $increaseCount;
            
            if($newCount <= 0) //is user wants to delete order 
            {
                $order->delete();
                $result = true;
            }
            else
            {
                $order->update(['count' => $newCount]);
                $result = true;
            }
            
            $orders = Order::where('user_id', $user_id)->get();
            
            return view("main.ajax.newcart", [
                "orders" => $orders,
                "cartSum" => $this->cartSum($user_id)
            ])->render();
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
    
    public function purchase()
    {
        if(Auth::check()) //in order to avoid some bugs
        {
            $user_id = Auth::user()->id;
            $orders = Order::where('user_id', $user_id)->delete();
            
            return view("main.ajax.thanks")->render();
        }
    }
}
