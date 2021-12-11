<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianKolektif extends Model
{   
    protected $table = 'penilaian_kolektifs';
    protected $primaryKey = 'id_penilaian_kolektif';
    protected $fillable = ['id_pembayaran','id_penilaian'];
  
    use HasFactory;
}
