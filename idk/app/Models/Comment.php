<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//This is the model for comments.
class Comment extends Model
{
    //The parts that can be filled are text, username, and avatar, they are passed to the table in MySQL
    protected $table = 'comments';
    protected $fillable = ['text', 'user_name', 'avatar'];

    //Makes it so that the comments belong to unique posts.
    function posts()
    {
        return $this->belongsTo(Post::class);
    }


}
