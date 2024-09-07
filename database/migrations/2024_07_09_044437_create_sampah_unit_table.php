<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSampahUnitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sampah_unit', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('account_id');
            $table->json('sampah');
            $table->timestamps();

            $table->foreign('account_id')->references('id')->on('bank_sampah_unit_accounts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sampah_unit');
    }
}
