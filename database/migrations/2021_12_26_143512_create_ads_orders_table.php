<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdsOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads_orders', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id');
            $table->integer('indoor')->default(0);
            $table->date('date');
            $table->integer('period');
            $table->string('orderable_type');
            $table->integer('orderable_id');
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
        Schema::dropIfExists('ads_orders');
    }
}
