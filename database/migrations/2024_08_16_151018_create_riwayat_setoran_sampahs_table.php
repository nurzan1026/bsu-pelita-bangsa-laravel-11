<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('riwayat_setoran_sampah', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('setoran_id');
            $table->foreignId('nasabah_id')->constrained('nasabahs')->onDelete('cascade');
            $table->decimal('jumlah_setoran', 8, 2);
            $table->timestamps();
            $table->foreign('setoran_id')->references('id')->on('setorans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_setoran_sampah');
    }
};
