<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Auth;

//This controller is accesed whenever the user tries to either follow or unfollow a user.
class FollowingController extends Controller
{
    //This function is used whenever a user is followed, it will send that the current user is trying to follow a user that they selected to the database. 
    //You can only follow users other than yourself that you are not already following.
    public function follow(Post $post)
    {
        Auth::user()->following()->attach($post);
        return redirect()->back();

    }

    //This function is used to unfollow a user. It will make the database remove the entry that has the relationship of this user following the selected user.
    //You can only unfollow a user other than yourself that you already following.
    public function unfollow(Post $post)
    {
        Auth::user()->following()->detach($post);
        return redirect()->back();
    }

}
