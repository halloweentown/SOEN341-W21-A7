<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use App\Models\Follow;
use Auth;

class UserpageController extends Controller
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


   

    public function basicuser(Request $request){
        $posts = Auth::user();
        $online = Post::all()->sortByDesc('created_at');
        $onlinecomment = Comment::all();
        $onlinefollow = Follow::all();
        $username=$request->username;
        
        
        return view('userpage', ['usernametoview'=> $username,
            'posts' => $online,
            'comments'=>$onlinecomment,
            'follows'=>$onlinefollow
        ]);
    }


}