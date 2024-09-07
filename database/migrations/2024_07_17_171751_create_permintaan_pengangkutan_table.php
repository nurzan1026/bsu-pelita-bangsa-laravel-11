<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermintaanPengangkutanTable extends Migration
{
    public function up()
    {
        Schema::create('permintaan_pengangkutan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('account_id');
            $table->string('account_name');
            $table->json('sampah');
            $table->decimal('total_berat', 8, 2);
            $table->decimal('total_harga', 10, 2); // Tambahkan kolom ini
            $table->string('status')->default('Menunggu Konfirmasi');
            $table->date('tanggal_pengambilan')->nullable();
            $table->time('waktu_pengambilan')->nullable();
            $table->timestamps();
        
            $table->foreign('account_id')->references('id')->on('bank_sampah_unit_accounts')->onDelete('cascade');
        });
        

    }

    public function down()
    {
        Schema::dropIfExists('permintaan_pengangkutans');
    }
}
