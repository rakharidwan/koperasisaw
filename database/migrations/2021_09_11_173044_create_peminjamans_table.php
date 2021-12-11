<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeminjamansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peminjamans', function (Blueprint $table) {
            $table->id('id_peminjaman');
            $table->foreignId('id_pinjaman')->references('id_pinjaman')->on('pinjamans')->onDelete('cascade');
            $table->foreignId('peminjam')->references('id_anggota')->on('anggotas')->onDelete('cascade');
            $table->enum('status',['Lunas','Belum Lunas']);
            $table->date('tanggal_pinjam');
            $table->date('jatuh_tempo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('peminjamans');
    }
}
