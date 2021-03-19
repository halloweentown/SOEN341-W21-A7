<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{

    protected $table = 'followers';
    protected $fillable = ['beingfollowed', 'following'];

    /*
    function posts()
    {
        return $this->belongsTo(Post::class);
    }
*/

}