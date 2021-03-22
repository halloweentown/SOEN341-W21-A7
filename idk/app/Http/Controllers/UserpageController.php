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

    public function index()
    {
        /*
        after linking posts to user accounts, use this below $posts = Auth::user()->posts;
        */
       $posts = Auth::user();

       $online = Post::all()->sortByDesc('created_at');
        $onlinecomment = Comment::all();
        $onlinefollow = Follow::all();
        

        return view('home', [
            'posts' => $online,
            'comments'=>$onlinecomment,
            'follows'=>$onlinefollow
        ]);


    }
   

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
    
    public function follow(Request $request){

        $onlinefollow = Follow::all();
        $online = Post::all()->sortByDesc('created_at');
        $follow= new Follow;
        $follows = Follow::all();
        $follow->beingfollowed = $request -> postname;
        $follow->following = Auth::user()->name;
        $follow->save();
        $username=$request->username;
        $onlinecomment = Comment::all();

        
        
        return view('userpage', ['usernametoview'=> $username,
            'posts' => $online,
            'comments'=>$onlinecomment,
            'follows'=>$onlinefollow
        ]);
        
    }

    public function save(Request $request){
        //print_r($request->input());
        $online = Post::all()->sortByDesc('created_at');
        $post = new post();
        $posts = Post::all()->sortByDesc('created_at');
        $comment = new Comment;
        $comments = Comment::all();
        $comment->text = $request->body;
        $comment->post_id = $request ->postid;
        $comment->user_name = Auth::user()->name;
        $comment->avatar = Auth::user()->avatar;
        $comment->save();
        $username=$request->username;
        $onlinecomment = Comment::all();
        $onlinefollow = Follow::all();

        /*
        * return view('home', [
           'post' => $post,
           'posts'=>$posts,
           'comments'=>$comments,
           'comment'=>$comment
       ]);
       */

      return view('userpage', ['usernametoview'=> $username,
      'posts' => $online,
      'comments'=>$onlinecomment,
      'follows'=>$onlinefollow
  ]);
    }

}