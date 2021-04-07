<?php

namespace App\Http\Controllers;

use App\Models\Following;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;

//ProfileController will be accessed whenever the user tries to access a user's page.
class ProfileController extends Controller
{
    //This function returns 4 variables. posts will return an array of all the posts. followings will return an array of all the followers. user will return the user whose 
    //profile has been selected. avatar will return the profile picture of the user that has been selected.
    public function index($user)
    {
        $user = User::find($user);
        $avatar = $user->avatar;
        $online = Post::all()->sortByDesc('created_at');
        $follow = Following::all();

        return view('profile', [
            'posts' => $online,
            'followings' => $follow,
            'user' => $user,
            'avatar' => $avatar,
        ]);
    }



}
