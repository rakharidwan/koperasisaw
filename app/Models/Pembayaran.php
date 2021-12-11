<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{   
    protected $table = 'pembayarans';
    protected $primaryKey = 'id_pembayaran';
    protected $fillable = ['kolektif','id_peminjaman','tanggal_pembayaran','total_pembayaran','terlambat','denda_pembayaran'];
  
    use HasFactory;
}
