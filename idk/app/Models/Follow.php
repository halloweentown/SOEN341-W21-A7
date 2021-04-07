<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    //This model has 2 variables which can be altered by the user. beingfollowed and following are sent to the database to be used later. The variables will allow us to see 
    // who follows who.
    protected $table = 'followers';
    protected $fillable = ['beingfollowed', 'following'];

    /*
    function posts()
    {
        return $this->belongsTo(Post::class);
    }
*/

}