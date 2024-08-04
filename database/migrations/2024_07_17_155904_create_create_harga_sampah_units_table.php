<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('harga_sampah_units', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sampah_id');
            $table->integer('harga');
            $table->timestamps();

            $table->foreign('sampah_id')->references('sampah_id')->on('data_sampahs')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('harga_sampah_units');
    }
};
