<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnggotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anggotas', function (Blueprint $table) {
            $table->id('id_anggota');
            $table->foreignId('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->string('nik',16)->unique();
            $table->string('nama',70);
            $table->string('tempat_lahir',20);
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['P', 'W']);
            $table->text('alamat');
            $table->string('provinsi',15);
            $table->string('kabupaten_kota',15);
            $table->string('kecamatan',20);
            $table->string('kelurahan_desa',20);
            $table->string('rt',2);
            $table->string('rw',2);
            $table->string('agama',20);
            $table->string('pekerjaan',30);
            $table->string('status_perkawinan',12);
            $table->string('kewarganegaraan',25);

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
        Schema::dropIfExists('anggotas');
    }
}
