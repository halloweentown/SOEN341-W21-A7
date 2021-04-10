<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */

    //This function is called whenever the user tries to comment.
    public function comment(Request $request){
        //print_r($request->input());

        //The comment variables are passed to $comment so that it can be sent to the database.
        $post = new post();
        $posts = Post::all()->sortByDesc('created_at');
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

        //The user is then redirected to the homepage.
        return redirect()->back();
    }


}
