<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{   
    protected $table = 'anggotas';
    protected $primaryKey = 'id_anggota';
    protected $fillable = ['nik','id_user','nama','tempat_lahir','tanggal_lahir','jenis_kelamin','alamat','provinsi','kabupaten_kota','kecamatan','kelurahan_desa','rt','rw','agama','status_perkawinan','pekerjaan','kewarganegaraan'];
  
    use HasFactory;
}
