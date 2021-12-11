<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianSikap extends Model
{   
    protected $table = 'penilaian_sikaps';
    protected $primaryKey = 'id_penilaian_sikap';
    protected $fillable = ['id_penilaian','nilai'];

    use HasFactory;
}
