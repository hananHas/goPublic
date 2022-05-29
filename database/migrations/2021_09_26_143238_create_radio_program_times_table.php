<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRadioProgramTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('radio_program_times', function (Blueprint $table) {
            $table->id();
            $table->string('day',20);
            $table->integer('day_id');
            $table->time('hour');
            $table->integer('timeable_id');
            $table->string('timeable_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('radio_program_times');
    }
}
