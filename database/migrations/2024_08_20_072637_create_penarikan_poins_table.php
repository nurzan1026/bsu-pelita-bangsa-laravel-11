<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenarikanPoinsTable extends Migration
{
    public function up()
    {
        Schema::create('penarikan_poins', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nasabah_id')->constrained('nasabahs')->onDelete('cascade');
            $table->foreignId('reward_item_id')->constrained('reward_items')->onDelete('cascade');
            $table->date('tanggal');
            $table->string('status')->default('Pending');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('penarikan_poins');
    }
}
