<?php

namespace App\Http\Controllers\Adminka;

use App\Http\Controllers\Adminka\AdminkaController;
use Illuminate\Http\Request;
use App\Models\Developer;

class AdminkaDevController extends AdminkaController
{
    public function index(Request $request)
    {
        $developers = Developer::all();
        return response()->json($developers, 200);
    }

    public function show(Request $request)
    {
        $developer = Developer::find($request->developer);
        return response()->json($developer, 200);
    }

    public function store(Request $request)
    {
        //validation checks
        if(!$this->validatePassword($request))
        {
            return response()->json(["result" => false, "message" => "Password is not correct"], 403);
        }

        Developer::create(["title" => $request->title]);
        return response()->json(["result" => true, "message" => "Created successfuly!"], 201);
    }

    public function update(Request $request)
    {
        //validation checks
        if(!$this->validatePassword($request))
        {
            return response()->json(["result" => false, "message" => "Password is not correct"], 403);
        }

        $developer = Developer::find($request->developer);
        $developer->update($request->only(['id', 'title']));
    
        return response()->json(["result" => true, "message" => "Updated successfuly!"], 200);
    }

    public function destroy(Request $request)
    {
        //validation checks
        if(!$this->validatePassword($request))
        {
            return response()->json(["result" => false, "message" => "Password is not correct"], 403);
        }

        Developer::find($request->developer)->delete();
        
        return response()->json(["result" => true, "message" => "Deleted successfuly!"], 200);
    }
}
