<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKebutuhanPengerjaansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kebutuhan_pengerjaans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kebutuhan');
            $table->integer('biaya');
            $table->unsignedBigInteger('id_barang');
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
        Schema::dropIfExists('kebutuhan_pengerjaans');
    }
}
