<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTvTimePricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tv_time_prices', function (Blueprint $table) {
            $table->id();
            $table->integer('tv_time_id');
            $table->integer('period');
            $table->integer('price_before');
            $table->integer('price_within');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tv_time_prices');
    }
}
