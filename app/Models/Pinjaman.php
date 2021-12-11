<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pinjaman extends Model
{
    protected $table = 'pinjamans';
    protected $primaryKey = 'id';
    protected $fillable = ['jumlah_pinjaman','bunga','tenor','denda','cicilan'];
    
    use HasFactory;
}
