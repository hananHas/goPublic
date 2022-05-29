<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTvOutdoorStreamingOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tv_outdoor_streaming_orders', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->integer('period');
            $table->string('presenter_type');
            $table->integer('price');
            $table->text('notes');
            $table->integer('tv_order_id');
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
        Schema::dropIfExists('tv_outdoor_streaming_orders');
    }
}
