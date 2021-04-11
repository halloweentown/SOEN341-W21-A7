<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    //This function creates a tbale to hold the comments. It is called by running a migration.
    public function up()
    {
        //The variables of a comment include the post_id, text, user_name, and the avatar.
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->string('post_id');
            $table->string('text');
            $table->string('user_name');
            $table->mediumText('avatar')->nullable();
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
        Schema::dropIfExists('comments');
    }
}
