<?php

namespace App\Http\Controllers\Adminka;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Developer;

class AdminkaDevController extends Controller
{
    //TEMPORARY SOLUTION!
    private $password = "12345";

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
        if($request->password != null && $request->password == $this->password)
        {
            Developer::create(["title" => $request->title]);
            return response()->json(["result" => true, "message" => "Created successfuly!"], 201);
        }

        return response()->json(["result" => false, "message" => "Password is not correct"], 403);
    }

    public function update(Request $request)
    {
        if($request->password != null && $request->password == $this->password)
        {
            $developer = Developer::find($request->developer);
            $developer->update($request->only(['id', 'title']));
        
            return response()->json(["result" => true, "message" => "Updated successfuly!"], 200);
        }

        return response()->json(["result" => false, "message" => "Password is not correct"], 403);
    }

    public function destroy(Request $request)
    {
        if($request->password != null && $request->password == $this->password)
        {
            Developer::find($request->developer)->delete();
        
            return response()->json(["result" => true, "message" => "Deleted successfuly!"], 200);
        }

        return response()->json(["result" => false, "message" => "Password is not correct"], 403);
    }
}
