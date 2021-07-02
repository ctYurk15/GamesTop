<?php

namespace App\Http\Controllers\Adminka;

use App\Http\Controllers\Adminka\AdminkaController;
use Illuminate\Http\Request;
use App\Models\Comment;

class AdminkaCommentsController extends AdminkaController
{
    public function index()
    {
        $comments = Comment::all();
        return response()->json($comments, 200);
    }

    public function show(Request $request)
    {
        $comment = Comment::find($request->comment);

        //if comment with such id exists
        if($comment != null)
        {
            return response()->json($comment, 200);
        }

        return response()->json(["result" => false, "message" => "Not found comment with id {$request->comment}"], 404);
    }

    public function store(Request $request)
    {
        //validation checks
        if(!$this->validatePassword($request))
        {
            return response()->json(["result" => false, "message" => "Password is not correct"], 403);
        }

        Comment::create($request->except('password'));
        return response()->json(["result" => true, "message" => "Created successfuly!"], 201);
    }

    public function update(Request $request)
    {
        //validation checks
        if(!$this->validatePassword($request))
        {
            return response()->json(["result" => false, "message" => "Password is not correct"], 403);
        }

        $comment = Comment::find($request->comment);

        //if comment with such id exists
        if($comment != null)
        {
            $comment->update($request->except('password'));
            return response()->json(["result" => true, "message" => "Updated successfuly!"], 200);
        }

        return response()->json(["result" => false, "message" => "Not found comment with id {$request->comment}"], 404);

        
    }

    public function destroy(Request $request)
    {
        //validation checks
        if(!$this->validatePassword($request))
        {
            return response()->json(["result" => false, "message" => "Password is not correct"], 403);
        }

        $comment = Comment::find($request->comment);

        //if comment with such id exists
        if($comment != null)
        {
            $comment->delete();
            return response()->json(["result" => true, "message" => "Deleted successfuly!"], 200);
        }

        return response()->json(["result" => false, "message" => "Not found comment with id {$request->comment}"], 404);
    }
}
