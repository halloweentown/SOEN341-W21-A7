<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    //This function creates a new table to hold the information of the posts. It is called by running a migration.
    public function up()
    {
        //The variables sent to the table are the id, the name, the avatar, the userID, the caption and the image.
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->mediumText('avatar')->nullable();
            $table->unsignedBigInteger('userID');
            $table->string('caption');
            $table->mediumText('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
