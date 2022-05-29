<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRadioSponsorshipOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('radio_sponsorship_orders', function (Blueprint $table) {
            $table->id();
            $table->integer('sponsorship_program_id');
            $table->date('date');
            $table->integer('period');
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
        Schema::dropIfExists('radio_sponsorship_orders');
    }
}
