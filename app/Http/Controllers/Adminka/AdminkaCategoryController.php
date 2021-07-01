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
        //validation checks
        if(!$this->validatePassword($request))
        {
            return response()->json(["result" => false, "message" => "Password is not correct"], 403);
        }

        Category::create(["title" => $request->title]);

        return response()->json(["result" => true, "message" => "Created successfully"], 201);
    }

    public function update(Request $request)
    {
        //validation checks
        if(!$this->validatePassword($request))
        {
            return response()->json(["result" => false, "message" => "Password is not correct"], 403);
        }

        $category = Category::find($request->category);
        $category->update($request->only(['id', 'title']));
        
        return response()->json(["result" => true, "message" => "Updated successfully"], 200);
    }

    public function destroy(Request $request)
    {
        //validation checks
        if(!$this->validatePassword($request))
        {
            return response()->json(["result" => false, "message" => "Password is not correct"], 403);
        }

        Category::find($request->category)->delete();

        return response()->json(["result" => true, "message" => "Deleted successfully"], 200);
    }
}
