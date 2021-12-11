<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenilaianSikapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penilaian_sikaps', function (Blueprint $table) {
            $table->id('id_penilaian_sikap');
            $table->foreignId('id_penilaian')->references('id_penilaian')->on('penilaians')->onDelete('cascade');
            $table->string('nilai',15);
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
        Schema::dropIfExists('penilaian_sikaps');
    }
}
