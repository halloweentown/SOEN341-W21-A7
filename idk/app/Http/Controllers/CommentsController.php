<?php

namespace App\Http\Controllers;

use App\Models\Comment;
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

    //This controller is never accessed.
    public function store(Request $request,$post)
    {
        $this->validate($request,[
           'comment' => 'required'
        ]);

        $comment = new Comment();
        $comment->user_id = Auth::id();
        $comment->post_id = $post;
        $comment->comment = $request->comment;
        $comment->save();
        return redirect()->home();
    }


}
