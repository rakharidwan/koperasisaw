<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSimpanansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('simpanans', function (Blueprint $table) {
            $table->id('id_simpanan');
            $table->foreignId('id_anggota')->references('id_anggota')->on('anggotas')->onDelete('cascade');
            $table->string('kredit',9)->nullable();
            $table->string('debit',9)->nullable();
            $table->string('saldo',9);
            $table->date('tanggal_transaksi');
            $table->string('jenis_transaksi',12);

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
        Schema::dropIfExists('simpanans');
    }
}
