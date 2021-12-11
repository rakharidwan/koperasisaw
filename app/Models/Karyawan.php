<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{   
    protected $table = 'karyawans';
    protected $primaryKey = 'id_karyawan';
    protected $fillable = ['nik','id_user','nama','tempat_lahir','tanggal_lahir','jenis_kelamin','alamat','provinsi','kabupaten_kota','kecamatan','kelurahan_desa','rt','rw','agama','status_perkawinan','pekerjaan','kewarganegaraan'];
  
    use HasFactory;
}
