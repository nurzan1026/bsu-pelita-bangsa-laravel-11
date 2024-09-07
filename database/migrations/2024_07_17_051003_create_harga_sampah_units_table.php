<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('harga_sampah_units', function (Blueprint $table) {
            $table->id();
            $table->string('waste_id');
            $table->string('price');
            $table->timestamps();
    
            $table->foreign('waste_id')->references('id')->on('data_sampahs')->onDelete('cascade');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('harga_sampah_units');
    }
};
