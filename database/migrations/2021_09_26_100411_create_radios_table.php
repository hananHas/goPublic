<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRadiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('radios', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('provider_id');
            $table->float('frequency',6,3);
            $table->string('type');
            $table->string('logo');
            $table->string('cover_image');
            $table->integer('recording_price');
            $table->integer('outdoor_straeming_30');
            $table->integer('outdoor_straeming_60');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('radios');
    }
}
