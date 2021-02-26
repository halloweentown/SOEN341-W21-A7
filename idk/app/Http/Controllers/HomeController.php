<?php

namespace App\Http\Controllers;

use App\Models\Comment;
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

    public function index()
    {
        /*
        after linking posts to user accounts, use this below $posts = Auth::user()->posts;
        */
       $posts = Auth::user();

       $online = Post::all();
        $onlinecomment = Comment::all();

        return view('home', [
            'posts' => $online,
            'comments'=>$onlinecomment,
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



    public function store(Request $request)
    {
        $post = new post();
        $posts = Post::all();


        $post->name = Auth::user()->name;
        $post->avatar = Auth::user()->avatar;
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

        return redirect()->back();



    }

    public function save(Request $request){
        //print_r($request->input());

        $post = new post();
        $posts = Post::all();
        $comment = new Comment;
        $comments = Comment::all();
        $comment->text = $request->body;
        $comment->post_id = $request ->postid;
        $comment->user_name = Auth::user()->name;
        $comment->avatar = Auth::user()->avatar;
        $comment->save();

        /*
        * return view('home', [
           'post' => $post,
           'posts'=>$posts,
           'comments'=>$comments,
           'comment'=>$comment
       ]);
       */

        return redirect()->back();
    }


}
