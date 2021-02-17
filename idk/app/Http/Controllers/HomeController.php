<?php

namespace App\Http\Controllers;

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
        
        return view('home', [
            'posts' => $online
        ]);
        
        
    }

    public function store(Request $request)
    {
        $post = new post();
        $posts = Post::all();

        $post->name = Auth::user()->name; 
        $post->caption = $request->input('body');
        $post->image = $request->input('image');

        if($request->hasfile('image')){
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename=time().'.'. $extension;
            $file->move('uploads/post/', $filename);
            $post->image = $filename;
        }else{
            return $request;
            $post->image='';
        }

        $post->save();
        
        return view('home', [
            'post' => $post,
            'posts'=>$posts
        ]);
        
    }
    
}
