<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Achievment;
use App\Models\Achievment_User;
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
    
    /*
        Checks if user have all achievments he is deserves to
    */
    
    public function updateAchievments($user)
    {
        //all achievments the user received
        $achievment1_count = Achievment_User::where(['user_id' => $user->id, 'achievment_id' => 1])->get()->count();
        $achievment2_count = Achievment_User::where(['user_id' => $user->id, 'achievment_id' => 2])->get()->count();
        $achievment3_count = Achievment_User::where(['user_id' => $user->id, 'achievment_id' => 3])->get()->count();
        $achievment4_count = Achievment_User::where(['user_id' => $user->id, 'achievment_id' => 4])->get()->count();
        
        // 1st achievment - register
        if($achievment1_count == 0) //if there`s no achievments for this user, because it`s fresh user
        {
            //adding 1 achievment to user - register on the site
            Achievment_User::create([
                'user_id' => $user->id,
                'achievment_id' => 1
            ]);
        }
        // 2nd achievment - buy at least one key
        if($achievment2_count == 0 && $user->keys_purchased >= 1)
        {
            Achievment_User::create([
                'user_id' => $user->id,
                'achievment_id' => 2
            ]);
        }
        // 3rd achievment - buy at least 5 keys
        if($achievment3_count == 0 && $user->keys_purchased >= 5)
        {
            Achievment_User::create([
                'user_id' => $user->id,
                'achievment_id' => 3
            ]);
        }
        // 4rd achievment - spend at least 100 dollars
        if($achievment4_count == 0 && $user->total_wasted >= 100)
        {
            Achievment_User::create([
                'user_id' => $user->id,
                'achievment_id' => 4
            ]);
        }
        
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
        
        $this->updateAchievments($user);
        
        $closed_achievments = [];
        
        //getting all data
        $all_achievments = Achievment::all();
        $opened_achievments = $user->opened_achievments;
        
        //comparing achievments to form difference of them
        foreach($all_achievments as $a_achievment)
        {
            $found = false;
            
            foreach($opened_achievments as $o_achievment)
            {
                if($a_achievment['id'] == $o_achievment['id']) //if this achievment is compleated
                {
                    $found = true;
                    break;
                }
            }
            
            if(!$found) //if this achievment is not compleated
            {
                array_push($closed_achievments, $a_achievment);
            }
        }
        
        $closed_achievments = array_unique($closed_achievments);
        
        return view('main.home', [
            "user" => $user,
            "closed_achievments" => $closed_achievments
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
