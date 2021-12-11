<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Simpanan extends Model
{   
    protected $table = 'simpanans';
    protected $primaryKey = 'id';
    protected $fillable = ['id_anggota','kredit','debit','saldo','tanggal_transaksi','jenis_transaksi'];

    use HasFactory;
}
