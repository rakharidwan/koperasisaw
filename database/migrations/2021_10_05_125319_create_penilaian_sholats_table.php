<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenilaianSholatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penilaian_sholats', function (Blueprint $table) {
            $table->id('id_penilaian_sholat');
            $table->foreignId('id_penilaian')->references('id_penilaian')->on('penilaians')->onDelete('cascade');
            $table->string('subuh',1)->nullable();
            $table->string('dzuhur',1)->nullable();
            $table->string('ashar',1)->nullable();
            $table->string('maghrib',1)->nullable();
            $table->string('isya',1)->nullable();
            $table->string('sunnah',1)->nullable();

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
        Schema::dropIfExists('penilaian_sholats');
    }
}
