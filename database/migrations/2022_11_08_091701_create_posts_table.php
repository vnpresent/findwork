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
            $table->bigInteger('work_id')->unsigned();
            $table->bigInteger('level_id')->unsigned();
            $table->bigInteger('experience_id')->unsigned();
            $table->bigInteger('degree_id')->unsigned();
            $table->bigInteger('working_form_id')->unsigned();
            $table->tinyInteger('sex');
            $table->bigInteger('city_id')->unsigned();
            $table->string('address');
            $table->integer('min_salary');
            $table->integer('max_salary');
            $table->integer('number_applicants');
            $table->longText('description');
            $table->longText('benefit');
            $table->date('end_date');
            $table->boolean('is_pinned')->default(false);
            $table->tinyInteger('status');
            $table->text('note')->nullable();
            $table->unsignedBigInteger('manager_id')->nullable();
            $table->timestamps();

            $table->foreign('employer_id')->references('id')->on('employers');
            $table->foreign('level_id')->references('id')->on('levels');
            $table->foreign('work_id')->references('id')->on('works');
            $table->foreign('degree_id')->references('id')->on('degrees');
            $table->foreign('experience_id')->references('id')->on('experiences');
            $table->foreign('working_form_id')->references('id')->on('working_forms');
            $table->foreign('city_id')->references('id')->on('cities');
            $table->foreign('manager_id')->references('id')->on('managers');
        });
    }

    public function down()
    {
        Schema::dropIfExists('posts');
    }
}

