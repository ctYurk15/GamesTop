<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        $user = User::where("id", $user_id)->first();
        return view('main.home', [
            "user" => $user
        ]);
    }
    
    public function changeUserData(Request $request)
    {
        $user_id = Auth::user()->id;
        $user = User::where("id", $user_id)->first();
        
        $result = [];
        $result_login = "";
        $result_password = "";
        
        //new values
        $newlogin = $request->newlogin;
        $newpass = $request->newpass;
        
        //for login
        if($newlogin != null) //if new login is not null
        {
            $count = User::where("name", $newlogin)->get()->count();
             
            if($count > 0) //if there`s already user with that login
            {   
                $result_login = 'This login is already taken. Try another';
            }
            else //we can safely set new login
            {
                $user->update(["name" => $newlogin]);
                $result_login = true;
            }
        }
        
        //for password
        if($newpass != null)
        {
            if(strlen($newpass) < 8)
            {
                $result_password = "Password needs to have at least 8 characters";
            }
            else
            {
                $user->update(["password" => Hash::make($newpass)]);
                $result_password = true;
            }
        }
        
        $result = [
            "result_login" => $result_login,
            "result_password" => $result_password
        ];
        
        return response()->json($result);
    }
}
