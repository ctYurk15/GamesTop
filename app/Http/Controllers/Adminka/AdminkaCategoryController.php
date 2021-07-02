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

        //if category with such id exists
        if($category != null)
        {
            return response()->json($category, 200);
        }

        return response()->json(["result" => false, "message" => "Not found category with id {$request->category}"], 404);
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

        //if category with such id exists
        if($category != null)
        {
            $category->update($request->only(['id', 'title']));
            return response()->json(["result" => true, "message" => "Updated successfully"], 200);
        }

        return response()->json(["result" => false, "message" => "Not found category with id {$request->category}"], 404);
    }

    public function destroy(Request $request)
    {
        //validation checks
        if(!$this->validatePassword($request))
        {
            return response()->json(["result" => false, "message" => "Password is not correct"], 403);
        }

        $category = Category::find($request->category);

        //if category with such id exists
        if($category != null)
        {
            $category->delete();
            return response()->json(["result" => true, "message" => "Deleted successfully"], 200);
        }

        return response()->json(["result" => false, "message" => "Not found category with id {$request->category}"], 404);
    }
}
