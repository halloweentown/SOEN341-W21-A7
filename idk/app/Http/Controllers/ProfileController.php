<?php

namespace App\Http\Controllers;

use App\Models\Following;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;

class ProfileController extends Controller
{
    //
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
