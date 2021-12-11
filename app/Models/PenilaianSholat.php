<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianSholat extends Model
{  
    protected $table = 'penilaian_sholats';
    protected $primaryKey = 'id_penilaian_sholat';
    protected $fillable = ['id_penilaian','subuh','dzuhur','ashar','maghrib','isya','sunnah','created_at'];
  
    use HasFactory;
}
