<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailDaurUlangsTable extends Migration
{
    public function up()
    {
        Schema::create('detail_daur_ulangs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('daur_ulang_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('sampah_id')->constrained('data_sampahs')->onDelete('cascade');
            $table->decimal('berat', 8, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('detail_daur_ulangs');
    }
}
