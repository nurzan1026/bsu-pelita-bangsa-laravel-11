<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailSetoransTable extends Migration
{
    public function up()
    {
        Schema::create('detail_setorans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('setoran_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('sampah_id'); // Pastikan ini adalah unsignedBigInteger
            $table->foreign('sampah_id')->references('sampah_id')->on('data_sampahs')->onDelete('cascade');
            $table->decimal('berat', 8, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('detail_setorans');
    }
}
