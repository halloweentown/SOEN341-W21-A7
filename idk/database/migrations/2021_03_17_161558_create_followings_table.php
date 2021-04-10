<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFollowingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    //This function creates a table for the followings. It can be called by running a migration.
    public function up()
    {
        Schema::create('followings', function (Blueprint $table) {

            //The variables of a 'followings' include an id, the name of the user being followed, and the name of the user doing the following.
            $table->id();
            $table->unsignedBigInteger('userFollowing');
            $table->unsignedBigInteger('userFollowed');
            $table->timestamps();
            //$table->foreign('userFollowing')->references('id')->on('users')->onDelete('cascade');
            //$table->foreign('userFollowed')->references('userID')->on('posts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('followings');
    }
}
