<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    protected $table = 'comments';
    protected $fillable = ['text', 'user_name'];


    function posts()
    {
        return $this->belongsTo(Post::class);
    }


}
