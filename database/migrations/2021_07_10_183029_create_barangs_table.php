<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nomor_seri');
            $table->string('tipe');
            $table->date('tanggal_masuk');
            $table->unsignedBigInteger('id_konsumen');
            $table->enum('status_barang',['Selesai','Proses pengerjaan','Belum dikerjakan','Tidak bisa dikerjakan']);
            $table->date('tanggal_selesai')->nullable();
            $table->integer('harga_pengerjaan')->nullable();
            $table->timestamps();
            $table->string('deskripsi',1000);
            $table->foreign('id_konsumen')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barangs');
    }
}
