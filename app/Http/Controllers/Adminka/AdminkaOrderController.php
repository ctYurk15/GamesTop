<?php

namespace App\Http\Controllers\Adminka;

use App\Http\Controllers\Adminka\AdminkaController;
use Illuminate\Http\Request;
use App\Models\Order;

class AdminkaOrderController extends AdminkaController
{
    public function index(Request $request)
    {
        $orders = Order::all();
        return response()->json($orders, 200);
    }

    public function show(Request $request)
    {
        $order = Order::find($request->order);

        //if order with such id exists
        if($order != null)
        {
            return response()->json($order, 200);
        }

        return response()->json(["result" => false, "message" => "Not found order with id {$request->order}"], 404);
    }

    public function store(Request $request)
    {
        //validation checks
        if(!$this->validatePassword($request))
        {
            return response()->json(["result" => false, "message" => "Password is not correct"], 403);
        }

        Order::create($request->except('password'));
        return response()->json(["result" => true, "message" => "Created successfuly!"], 201);
    }

    public function update(Request $request)
    {
        //validation checks
        if(!$this->validatePassword($request))
        {
            return response()->json(["result" => false, "message" => "Password is not correct"], 403);
        }

        $order = Order::find($request->order);

        //if order with such id exists
        if($order != null)
        {
            $order->update($request->except('password'));
            return response()->json(["result" => true, "message" => "Updated successfuly!"], 200);
        }

        return response()->json(["result" => false, "message" => "Not found order with id {$request->order}"], 404);

        
    }

    public function destroy(Request $request)
    {
        //validation checks
        if(!$this->validatePassword($request))
        {
            return response()->json(["result" => false, "message" => "Password is not correct"], 403);
        }

        $order = Order::find($request->order);

        //if order with such id exists
        if($order != null)
        {
            $order->delete();
            return response()->json(["result" => true, "message" => "Deleted successfuly!"], 200);
        }

        return response()->json(["result" => false, "message" => "Not found order with id {$request->order}"], 404);
    }
}
