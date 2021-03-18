<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    function posts()
    {
        return $this->hasMany(Post::class)->orderBy('created_at','DESC');


    }

    function comments()
    {
        return $this->hasMany(Comment::class);
    }

    function following() {
        return $this->belongsToMany(User::class, 'followings', 'userFollowing', 'userFollowed');
    }

/*    function follow(Post $post) {
        return $this->following()->attach($post->userID);
    }

    function unfollow(Post $post) {
        return $this->following()->detach($post->userID);
    }
*/
    function isFollowing(Post $post)
    {
        return $this->following()->where('userFollowed', $post->userID)->count();
    }



}
