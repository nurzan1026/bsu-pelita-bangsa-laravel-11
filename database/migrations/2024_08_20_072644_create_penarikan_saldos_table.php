<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenarikanSaldosTable extends Migration
{
    public function up()
    {
        Schema::create('penarikan_saldos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nasabah_id')->constrained('nasabahs')->onDelete('cascade');
            $table->date('tanggal');
            $table->integer('jumlah');
            $table->string('status')->default('Pending');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('penarikan_saldos');
    }
}
