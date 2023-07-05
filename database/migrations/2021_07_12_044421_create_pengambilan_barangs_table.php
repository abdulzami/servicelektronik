<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengambilanBarangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengambilan_barangs', function (Blueprint $table) {
            $table->id('id_pengambilan');
            $table->unsignedBigInteger('id_barang');
            $table->date('tanggal_pengambilan');
            $table->timestamps();
            $table->foreign('id_barang')->references('id')->on('barangs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengambilan_barangs');
    }
}
