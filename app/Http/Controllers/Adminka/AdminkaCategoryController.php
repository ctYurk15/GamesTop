<?php

namespace App\Http\Controllers\Adminka;

use App\Http\Controllers\Adminka\AdminkaController;
use Illuminate\Http\Request;
use App\Models\Category;

class AdminkaCategoryController extends AdminkaController
{
    public function index()
    {
        $categories = Category::all();
        return response()->json($categories, 200);
    }

    public function show(Request $request)
    {
        $category = Category::find($request->category);
        return response()->json($category, 200);
    }

    public function store(Request $request)
    {
        if($request->password != null && $request->password == $this->password)
        {
            Category::create(["title" => $request->title]);
            return response()->json(["result" => true, "message" => "Created successfully"], 201);
        }

        return response()->json(["result" => false, "message" => "Password is not correct"], 403);
    }

    public function update(Request $request)
    {
        if($request->password != null && $request->password == $this->password)
        {
            $category = Category::find($request->category);
            $category->update($request->only(['id', 'title']));
            
            return response()->json(["result" => true, "message" => "Updated successfully"], 200);
        }

        return response()->json(["result" => false, "message" => "Password is not correct"], 403);
    }

    public function destroy(Request $request)
    {
        if($request->password != null && $request->password == $this->password)
        {
            Category::find($request->category)->delete();
            return response()->json(["result" => true, "message" => "Deleted successfully"], 200);
        }

        return response()->json(["result" => false, "message" => "Password is not correct"], 403);
    }
}
