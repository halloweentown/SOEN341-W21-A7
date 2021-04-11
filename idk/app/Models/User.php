<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

//Model for the users.
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

     //Every uesr has a name, email, password, and avatar that is assigned to them during registration.
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

     //The passwords and remember tokens are hashed in the database.
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    //This part of the code is not used in our implementation, was provided by Laravel.
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];

    //Makes it so that a user can have many posts attributed to them.
    function posts()
    {
        return $this->hasMany(Post::class)->orderBy('created_at','DESC');


    }

    //Makes it so that a user can have many comments attributed to them.
    function comments()
    {
        return $this->hasMany(Comment::class);
    }

    //A user has many people that they are following.
    function following() {
        return $this->belongsToMany(User::class, 'followings', 'userFollowing', 'userFollowed');
    }

    //A user has many followers.
    function followers() {
        return $this->belongsToMany(User::class, 'followings', 'userFollowed', 'userFollowing');
    }

/*    function follow(Post $post) {
        return $this->following()->attach($post->userID);
    }

    function unfollow(Post $post) {
        return $this->following()->detach($post->userID);
    }
*/
    //Affects the numbers of another user's followers based on if this user follows them or not.
    function isFollowing(Post $post)
    {
        return $this->following()->where('userFollowed', $post->userID)->count();
    }

    //Affects the user's follower numbers.
    function isFollowingUser(User $user)
    {
        return $this->following()->where('userFollowed', $user->id)->count();
    }

    //Makes it so that a user can only have one profile.
    function profile()
    {
        return $this->hasOne(Profile::class);
    }

}
