<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrxTransaksiCepat extends Model
{
    use HasFactory;
    protected $table = 'trx_transaksi_cepat';
    protected $primaryKey = 'id';
    protected $fillable = [
        'transaksi_id',
        'nama_produk',
        'harga_satuan',
        'kuantitas',
        'satuan_id',
        'total'
    ];
}
