<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{   
    protected $table = 'penilaians';
    protected $primaryKey = 'id_penilaian';
    protected $fillable = ['id_karyawan','tanggal_penilaian'];
  
    use HasFactory;
}
