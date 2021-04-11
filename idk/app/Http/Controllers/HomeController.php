<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Following;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
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

     //Default function when the user logs in or attempts to access the home page.
    public function index()
    {
        /*
        after linking posts to user accounts, use this below $posts = Auth::user()->posts;
        */

        //This function will return an array of posts, comments, and followers.
        $posts = Auth::user();
        $online = Post::all()->sortByDesc('created_at');
        $onlinecomment = Comment::all();
        $follow = Following::all();

        return view('home', [
            'posts' => $online,
            'comments'=>$onlinecomment,
            'followings' => $follow,
        ]);


    }
/*
    public function uploadPost(Request $request){
        if($request->hasFile('image')){
            $request->image->store('images', 'public');
            return 'Uploaded!';
        }
        //$request->image->store('images', 'public');
        User::find(1)->update(['avatar'=>'personalPic']);
        return 'Uploaded avatar!';

    }

*/


    //This function is called when a user tries to make a post.
    public function post(Request $request)
    {
        $post = new post();
        $posts = Post::all()->sortByDesc('created_at');

        //The different variables of the post are passed to be sent to the database.
        $post->name = Auth::user()->name;
        $post->avatar = Auth::user()->avatar;
        $post->userID = Auth::user()->id;
        $post->caption = $request->input('body');
        $post->image = $request->input('image');

        if($request->hasfile('image')){
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename=time().'.'. $extension;
            $file->move('uploads/post/', $filename);
            $post->image = $filename;
        }else{
            return redirect()->back();

        }

        $post->save();

        //The user is redirected back to the home page.
        return redirect()->back();



    }




}
