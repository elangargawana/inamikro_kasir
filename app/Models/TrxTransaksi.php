<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrxTransaksi extends Model
{
    use HasFactory;
    protected $table = 'trx_transaksi';
    protected $primaryKey = 'id';
    protected $fillable = [
        'merchant_id',
        'invoice_number',
        'pelanggan_id',
        'metode_bayar_id',
        'total',
        'total_bayar',
        'jenis_transaksi'
    ];

    public function trxTransaksiCepat()
    {
        return $this->hasMany(TrxTransaksiCepat::class, 'transaksi_id');
    }

    public function trxTransaksiPintar()
    {
        return $this->hasMany(TrxTransaksiPintar::class, 'transaksi_id');
    }
}
