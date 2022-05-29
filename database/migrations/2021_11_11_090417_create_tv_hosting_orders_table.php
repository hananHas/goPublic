<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTvHostingOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tv_hosting_orders', function (Blueprint $table) {
            $table->id();
            $table->integer('program_id');
            $table->date('hosting_date');
            $table->integer('hosting_period');
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
        Schema::dropIfExists('tv_hosting_orders');
    }
}
