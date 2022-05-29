<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdsPanelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads_panels', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image');
            $table->text('description');
            $table->integer('price');
            $table->integer('printing_price');
            $table->integer('agency_price');
            $table->integer('ads_net_id')->nullable();
            $table->integer('area_id');
            $table->integer('company_id');
            $table->integer('type_id');
            $table->string('size');
            $table->integer('view_field');
            $table->tinyInteger('lighting');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ads_panels');
    }
}
