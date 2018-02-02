<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOpeningTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opening_times', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('monday_opening')->nullable();
            $table->string('monday_closing')->nullable();
            $table->string('tuesday_opening')->nullable();
            $table->string('tuesday_closing')->nullable();
            $table->string('wednesday_opening')->nullable();
            $table->string('wednesday_closing')->nullable();
            $table->string('thursday_opening')->nullable();
            $table->string('thursday_closing')->nullable();
            $table->string('friday_opening')->nullable();
            $table->string('friday_closing')->nullable();
            $table->string('saturday_opening')->nullable();
            $table->string('saturday_closing')->nullable();
            $table->string('sunday_opening')->nullable();
            $table->string('sunday_closing')->nullable();
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
        Schema::dropIfExists('opening_times');
    }
}
