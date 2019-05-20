<?php

namespace App\Http\Controllers;
use App\Chat;
use App\User;
use App\Friend;

use Auth;
use Illuminate\Http\Request;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
 $friends=Friend::where('user_id',Auth::user()->id)->orWhere('friend_id',Auth::user()->id)->get();
        foreach($friends as $friend ){
            $user=User::find($friend->id);
            $friend->name=$user->name;
        }
        return view('chat.index')->withFriends($friends);
    }
    
}
