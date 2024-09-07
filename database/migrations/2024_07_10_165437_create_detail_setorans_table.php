<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('detail_setorans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('setoran_id')->constrained()->onDelete('cascade');
            $table->string('waste_id');
            $table->foreign('waste_id')->references('id')->on('data_sampahs')->onDelete('cascade');
            $table->decimal('berat', 8, 2);
            $table->integer('poin');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_setorans');
    }
};
