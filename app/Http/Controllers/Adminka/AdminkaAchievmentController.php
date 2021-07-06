<?php

namespace App\Http\Controllers\Adminka;

use App\Http\Controllers\Adminka\AdminkaController;
use Illuminate\Http\Request;
use App\Models\Achievment;

class AdminkaAchievmentController extends AdminkaController
{
    public function index(Request $request)
    {
        $achievments = Achievment::all();
        return response()->json($achievments, 200);
    }

    public function show(Request $request)
    {
        $achievment = Achievment::find($request->achievment);

        //if achievment with such id exists
        if($achievment != null)
        {
            return response()->json($achievment, 200);
        }

        return response()->json(["result" => false, "message" => "Not found achievment with id {$request->achievment}"], 404);
    }

    public function store(Request $request)
    {
        //validation checks
        if(!$this->validatePassword($request))
        {
            return response()->json(["result" => false, "message" => "Password is not correct"], 403);
        }

        Achievment::create($request->except('password'));
        return response()->json(["result" => true, "message" => "Created successfuly!"], 201);
    }

    public function update(Request $request)
    {
        //validation checks
        if(!$this->validatePassword($request))
        {
            return response()->json(["result" => false, "message" => "Password is not correct"], 403);
        }

        $achievment = Achievment::find($request->achievment);

        //if achievment with such id exists
        if($achievment != null)
        {
            $achievment->update($request->except('password'));
            return response()->json(["result" => true, "message" => "Updated successfuly!"], 200);
        }

        return response()->json(["result" => false, "message" => "Not found achievment with id {$request->achievment}"], 404);

        
    }

    public function destroy(Request $request)
    {
        //validation checks
        if(!$this->validatePassword($request))
        {
            return response()->json(["result" => false, "message" => "Password is not correct"], 403);
        }

        $achievment = Achievment::find($request->achievment);

        //if achievment with such id exists
        if($achievment != null)
        {
            $achievment->delete();
            return response()->json(["result" => true, "message" => "Deleted successfuly!"], 200);
        }

        return response()->json(["result" => false, "message" => "Not found achievment with id {$request->achievment}"], 404);
    }
}
