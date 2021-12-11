<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{   
    protected $table = 'peminjamans';
    protected $primaryKey = 'id_peminjaman';
    protected $fillable = ['id_pinjaman','peminjam','tanggal_pinjam','jatuh_tempo','status'];
    

    use HasFactory;
}
