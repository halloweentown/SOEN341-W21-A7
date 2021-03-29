<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//This is a model for all the posts.
class Post extends Model
{
    //The parts that can be sent to the database are the name, avatar, userID, image and the caption.
    protected $table = 'posts';
    protected $fillable = ['name', 'avatar', 'userID','image','caption'];

    //Makes so that every posts belongs to a specific user.
    function user(){
        return $this->belongsTo(User::class);
    }

    //Makes it so that every post has many comments linked to it.
    function comments(){
        return $this->hasMany(Comment::class);
    }
}
