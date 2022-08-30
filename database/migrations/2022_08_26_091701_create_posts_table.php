<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('employer_id')->unsigned();
            $table->string('title');
            $table->longText('description');
            $table->integer('number_applicants');
            $table->integer('min_salary');
            $table->integer('max_salary');
            $table->date('start_date');
            $table->date('end_date');
            $table->boolean('is_pinned')->default(false);
            $table->foreign('employer_id')->references('id')->on('employers');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('posts');
    }
}

