<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRewardItemsTable extends Migration
{
    public function up()
    {
        Schema::create('reward_items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('poin');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reward_items');
    }
}
