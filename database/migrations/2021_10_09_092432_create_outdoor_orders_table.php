<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOutdoorOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outdoor_orders', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id');
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('duration');
            $table->string('orderable');
            $table->integer('orderable_id');
            $table->integer('price');
            $table->text('notes');
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
        Schema::dropIfExists('outdoor_orders');
    }
}
