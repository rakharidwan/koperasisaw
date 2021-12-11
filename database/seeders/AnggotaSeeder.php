<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Anggota;


class AnggotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('anggotas')->delete();
        $anggota = [[
            'id_user' => '14',
            'nik' => '0021040124124214',
            'nama' => 'Kurnia',
            'tempat_lahir' => 'Bandung',
            'tanggal_lahir' => '1982-11-01',
            'jenis_kelamin' => 'P',
            'alamat' => 'Jl. Pasir Kawung No.21',
            'provinsi' => 'Jawa Barat',
            'kabupaten_kota' => 'Bandung',
            'kecamatan' => 'Cileunyi',
            'kelurahan_desa' => 'Pasir Kawung',
            'rt' => '6',
            'rw' => '9',
            'agama' => 'Islam',
            'pekerjaan' => 'Pegawai Negeri',
            'status_perkawinan' => 'Belum Kawin',
            'kewarganegaraan' => 'Indonesia',
        ],[
            'id_user' => '15',
            'nik' => '0021074721412421',
            'nama' => 'Asep',
            'tempat_lahir' => 'Bandung',
            'tanggal_lahir' => '1982-02-24',
            'jenis_kelamin' => 'P',
            'alamat' => 'Komp. Permata Biru Blok D No.26',
            'provinsi' => 'Jawa Barat',
            'kabupaten_kota' => 'Bandung',
            'kecamatan' => 'Cileunyi',
            'kelurahan_desa' => 'Cibiru',
            'rt' => '1',
            'rw' => '5',
            'agama' => 'Islam',
            'pekerjaan' => 'Buruh',
            'status_perkawinan' => 'Kawin',
            'kewarganegaraan' => 'Indonesia',
        ],];
        Anggota::insert($anggota);
    }
}
