<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrxSaldo extends Model
{
    use HasFactory;
    protected $table = 'trx_saldo';
    protected $primaryKey = 'id';
    protected $fillable = [
        'merchant_id',
        'jenis',
        'transaksi_id',
        'penarikan_id',
        'nominal',
        'saldo_awal',
        'saldo_akhir'
    ];
}
