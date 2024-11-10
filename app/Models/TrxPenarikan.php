<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrxPenarikan extends Model
{
    use HasFactory;
    protected $table = 'trx_penarikan';
    protected $primaryKey = 'id';
    protected $fillable = [
        'merchant_id',
        'bank_id',
        'jumlah_penarikan'
    ];
}
