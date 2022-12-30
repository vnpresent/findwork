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
            $table->string('name');
            $table->string('position');
            $table->json('profile');
            $table->string('objective')->nullable();
//            $table->json('skills')->nullable();
            $table->json('work_experience')->nullable();
            $table->json('education')->nullable();
            $table->json('activities')->nullable();
            $table->json('certifications')->nullable();
            $table->foreign('applicant_id')->references('id')->on('applicants');
            $table->softDeletes();
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
