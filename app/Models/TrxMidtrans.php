<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrxMidtrans extends Model
{
    use HasFactory;
    protected $table = 'trx_midtrans';
    protected $primaryKey = 'id';
    protected $fillable = [
        'transaksi_id',
        'status',
        'snap_token'
    ];
}
