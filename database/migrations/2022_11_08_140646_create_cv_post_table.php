<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCvPostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cv_post', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cv_id')->unsigned();
            $table->bigInteger('post_id')->unsigned();
            $table->timestamps();
            $table->foreign('cv_id')->references('id')->on('cvs');
            $table->foreign('post_id')->references('id')->on('posts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cv_post');
    }
}
