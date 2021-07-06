<?php

namespace App\Http\Controllers\Adminka;

use App\Http\Controllers\Adminka\AdminkaController;
use Illuminate\Http\Request;
use App\Models\Achievment_User;

class AdminkaAchievmentUserController extends AdminkaController
{
    public function index(Request $request)
    {
        $achievments_users = Achievment_User::all();
        return response()->json($achievments_users, 200);
    }

    public function show(Request $request)
    {
        $achievment_user = Achievment_User::find($request->achievment_user);

        //if achievment_user with such id exists
        if($achievment_user != null)
        {
            return response()->json($achievment_user, 200);
        }

        return response()->json(["result" => false, "message" => "Not found achievment_user with id {$request->achievment_user}"], 404);
    }

    public function store(Request $request)
    {
        //validation checks
        if(!$this->validatePassword($request))
        {
            return response()->json(["result" => false, "message" => "Password is not correct"], 403);
        }

        Achievment_User::create($request->except('password'));
        return response()->json(["result" => true, "message" => "Created successfuly!"], 201);
    }

    public function update(Request $request)
    {
        //validation checks
        if(!$this->validatePassword($request))
        {
            return response()->json(["result" => false, "message" => "Password is not correct"], 403);
        }

        $achievment_user = Achievment_User::find($request->achievment_user);

        //if achievment_user with such id exists
        if($achievment_user != null)
        {
            $achievment_user->update($request->except('password'));
            return response()->json(["result" => true, "message" => "Updated successfuly!"], 200);
        }

        return response()->json(["result" => false, "message" => "Not found achievment_user with id {$request->achievment_user}"], 404);

        
    }

    public function destroy(Request $request)
    {
        //validation checks
        if(!$this->validatePassword($request))
        {
            return response()->json(["result" => false, "message" => "Password is not correct"], 403);
        }

        $achievment_user = Achievment_User::find($request->achievment_user);

        //if achievment_user with such id exists
        if($achievment_user != null)
        {
            $achievment_user->delete();
            return response()->json(["result" => true, "message" => "Deleted successfuly!"], 200);
        }

        return response()->json(["result" => false, "message" => "Not found achievment_user with id {$request->achievment_user}"], 404);
    }
}
