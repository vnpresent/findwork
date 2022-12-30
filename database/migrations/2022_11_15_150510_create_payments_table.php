<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employer_id');
            $table->string('order_id')->unique();
            $table->integer('payment_type');
            $table->unsignedBigInteger('amount');
            $table->text('link');
            $table->integer('status');
            $table->unsignedBigInteger('manager_id')->nullable();
            $table->timestamps();
            $table->foreign('employer_id')->references('id')->on('employers');
            $table->foreign('manager_id')->references('id')->on('managers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
