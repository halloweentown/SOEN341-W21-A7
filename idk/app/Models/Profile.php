<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//A model for the user profile.
class Profile extends Model
{
    use HasFactory;

    //Makes it so that every profile belongs to a specific user.
    function user()
    {
        return $this->belongsTo(User::class);
    }
}
