<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenilaianKolektifsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penilaian_kolektifs', function (Blueprint $table) {
            $table->id('id_penilaian_kolektif');
            $table->foreignId('id_penilaian')->references('id_penilaian')->on('penilaians')->onDelete('cascade');
            $table->foreignId('id_pembayaran')->references('id_pembayaran')->on('pembayarans')->onDelete('cascade');
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
        Schema::dropIfExists('penilaian_kolektifs');
    }
}
