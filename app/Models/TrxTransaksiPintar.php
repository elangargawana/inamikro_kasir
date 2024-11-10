<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrxTransaksiPintar extends Model
{
    use HasFactory;
    protected $table = 'trx_transaksi_pintar';
    protected $primaryKey = 'id';
    protected $fillable = [
        'transaksi_id',
        'produk_id',
        'kuantitas',
        'total'
    ];
}
