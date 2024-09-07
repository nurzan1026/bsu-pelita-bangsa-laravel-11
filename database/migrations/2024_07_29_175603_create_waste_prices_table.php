<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWastePricesTable extends Migration
{
    public function up()
    {
        Schema::create('waste_prices', function (Blueprint $table) {
            $table->id();
            $table->string('waste_id');
            $table->string('price');
            $table->timestamps();

            $table->foreign('waste_id')->references('id')->on('data_sampahs')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('waste_prices');
    }
}
