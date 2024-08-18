<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenarikanPoinTable extends Migration
{
    public function up()
    {
        Schema::create('penarikan_poin', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->enum('opsi', ['minyak', 'sembako']);
            $table->integer('jumlah');
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('penarikan_poin');
    }
}

