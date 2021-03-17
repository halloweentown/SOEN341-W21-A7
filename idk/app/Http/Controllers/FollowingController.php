<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Auth;
class FollowingController extends Controller
{
    //
    public function follow(Post $post)
    {
        Auth::user()->following()->attach($post);
        return redirect()->back();

    }

    public function unfollow(Post $post)
    {
        Auth::user()->following()->detach($post);
        return redirect()->back();
    }

}
