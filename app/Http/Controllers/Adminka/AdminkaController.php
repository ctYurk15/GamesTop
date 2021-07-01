<?php

namespace App\Http\Controllers\Adminka;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

class AdminkaController extends Controller
{
    protected $password = "123456";

    //checking if password is ok
    public function validatePassword(Request $request)
    {
        $rules = array('password' => 'required|in:'.$this->password);
        $validated = Validator::make($request->all(), $rules);

        if($validated->fails())
        {
            return false;
        }

        return true;
    }
}
