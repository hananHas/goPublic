<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChannelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tv_channels', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('cover_image');
            $table->string('logo');
            $table->float('frequency',6,3);
            $table->tinyInteger('horizontal');
            $table->string('satellite');
            $table->integer('codec_rate');
            $table->string('error_correction_rate',10);
            $table->integer('provider_id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tv_channels');
    }
}
