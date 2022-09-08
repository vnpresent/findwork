<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCvsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cvs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('applicant_id')->unsigned();
            $table->text('image');
            $table->string('name');
            $table->date('birthday');
            $table->text('address');
            $table->text('email');
            $table->text('phone');
            $table->json('literacy');
            $table->json('work_experience');
            $table->json('skill');
            $table->json('activities');
            $table->foreign('applicant_id')->references('id')->on('applicants');
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
        Schema::dropIfExists('cvs');
    }
}
