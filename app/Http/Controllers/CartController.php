<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\Gamekey;
use App\Models\Order;
use App\Models\User;
use Auth;
use Mail;
use App;
use App\Mail\GamesTopPurchaseEmail;

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
        $keys_count = Gamekey::where("game_id", $game_id)->get()->count();
        
        $result = false;
        
        /* 
            If order with this game is already exists, we need only to increase it 
            Else we need to create new order
        */
        
        $order = Order::where('game_id', $game_id)->where('user_id', $user_id)->first();
        
        if($order != null)
        {
            //how big we want to change cart
            $increaseCount = 1;
            if(isset($request->changeCount)) //if we`re changing count from cart
            {
                $increaseCount = $request->changeCount;
            }
            
            if($increaseCount + $order->count <= $keys_count)
            {
                $values = $order->toArray(); //I dont know how I can get `count` column in another way
            
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
            else return response()->json(false);
        }
        else
        {
            if($keys_count >= 1) //if we still have enough keys
            {
                //creating new order
                $order = new Order;

                $order->game_id = $game_id;
                $order->user_id = $user_id;
                $order->count = 1;

                $order->save();

                $result = true;
            }
            
            return response()->json(["Result" => $result]);
        }
        
    }
    
    public function purchase()
    {
        if(Auth::check()) //in order to avoid some bugs
        {
            $user_id = Auth::user()->id;
            $user = User::where("id", $user_id)->first();
            
            $orders = Order::where('user_id', $user_id)->get();
            
            //for user statistics
            $total_keys_purchasing = 0;
            $total_money_wasting = 0;
            
            //we will store gamekeys_here
            $keys = [];
            
            //calculating stats and deleting orders
            foreach($orders as $order)
            {
                //stats for user
                $total_keys_purchasing += $order->count;
                $total_money_wasting += $order->count * $order->game->price;
                
                //stats for game
                $new_total_keys_purchased = $order->game->purchase_count + $total_keys_purchasing;
                $order->game->update([
                    "purchase_count" => $new_total_keys_purchased
                ]);
                
                //adding gamekey to temp array and deleting it
                $gamekeys = Gamekey::where("game_id", $order->game->id)->get();
                for($i = 0; $i < $total_keys_purchasing; $i++)
                {
                    $current_key = $gamekeys[$i];
                    array_push($keys, [
                        "game" => $order->game->name,
                        "code" => $current_key->code
                    ]);
                    $current_key->delete();
                }
                
                $order->delete();
            }
            
            //updating user stats
            $new_total_keys = $user->keys_purchased + $total_keys_purchasing;
            $new_total_wasted = $user->total_wasted + $total_money_wasting;
            
            $user->update([
                "keys_purchased" => $new_total_keys,
                "total_wasted" => $new_total_wasted
            ]);
            
            //sending mail
            Mail::send(new GamesTopPurchaseEmail($user->email, $keys));
            
            return view("main.ajax.thanks")->render();
        }
    }
}
