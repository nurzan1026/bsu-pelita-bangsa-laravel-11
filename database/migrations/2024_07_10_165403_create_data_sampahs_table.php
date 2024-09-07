<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataSampahsTable extends Migration
{
    public function up()
    {
        Schema::create('data_sampahs', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('kategori');
            $table->string('jenis');
            $table->string('foto')->nullable();
            $table->integer('poin')->nullable();
            $table->text('info')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('data_sampahs');
    }
}
