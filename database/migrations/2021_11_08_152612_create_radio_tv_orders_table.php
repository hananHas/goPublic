<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRadioTvOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('radio_tv_orders', function (Blueprint $table) {
            $table->id();
            $table->integer('radio_tv_banner_id');
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('price');
            $table->text('notes');
            $table->integer('radio_order_id');
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
        Schema::dropIfExists('radio_tv_orders');
    }
}
